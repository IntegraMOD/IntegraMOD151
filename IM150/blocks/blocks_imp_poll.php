<?php
/***************************************************************************
 *                           blocks_imp_poll.php
 *                            -------------------
 *   begin                : Saturday, March 20, 2004
 *   copyright            : (C) 2004 masterdavid - Ronald John David
 *   website              : http://www.integramod.com
 *   email                : webmaster@integramod.com
 *
 *   note: removing the original copyright is illegal even you have modified
 *         the code.  Just append yours if you have modified it.
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

if(!function_exists(imp_poll_block_func))
{
	function imp_poll_block_func()
	{
		global $template, $portal_config, $db, $userdata, $images, $lang, $phpEx;

		$template->assign_block_vars('PORTAL_POLL', array());

		$sql = 'SELECT
			  t.*, vd.*
			FROM 
			  ' . TOPICS_TABLE . ' AS t,
			  ' . VOTE_DESC_TABLE . ' AS vd
			WHERE
			  t.forum_id IN (' . $portal_config['md_poll_forum_id'] . ') AND
			  t.topic_status <> 1 AND
			  t.topic_status <> 2 AND
			  t.topic_vote = 1 AND
			  t.topic_id = vd.topic_id
			ORDER BY
			  t.topic_time DESC 
			LIMIT
			  0,1';


		if(!$result = $db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, "Couldn't obtain poll information.", "", __LINE__, __FILE__, $sql);
		}

		//	if(!$total_posts = $db->sql_numrows($result))
		//	{
		//		message_die(GENERAL_MESSAGE, $lang['No_posts_topic']);
		//	}

		if($total_posts = $db->sql_numrows($result))
		{
		$pollrow = $db->sql_fetchrowset($result);
		$db->sql_freeresult($result);

		$topic_id = $pollrow[0]['topic_id'] ;

			$sql = "SELECT vd.vote_id, vd.vote_text, vd.vote_start, vd.vote_length, vr.vote_option_id, vr.vote_option_text, vr.vote_result
				FROM " . VOTE_DESC_TABLE . " vd, " . VOTE_RESULTS_TABLE . " vr
				WHERE vd.topic_id = $topic_id
					AND vr.vote_id = vd.vote_id
				ORDER BY vr.vote_option_id ASC";
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Couldn't obtain vote data for this topic", "", __LINE__, __FILE__, $sql);
			}

			if( $vote_options = $db->sql_numrows($result) )
			{
				$vote_info = $db->sql_fetchrowset($result);

				$vote_id = $vote_info[0]['vote_id'];
				$vote_title = $vote_info[0]['vote_text'];

				$sql = "SELECT vote_id
					FROM " . VOTE_USERS_TABLE . "
					WHERE vote_id = $vote_id
						AND vote_user_id = " . $userdata['user_id'];
				if( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, "Couldn't obtain user vote data for this topic", "", __LINE__, __FILE__, $sql);
				}

				$user_voted = ( $db->sql_numrows($result) ) ? TRUE : 0;

				if( isset($HTTP_GET_VARS['vote']) || isset($HTTP_POST_VARS['vote']) )
				{
					$view_result = ( ( ( isset($HTTP_GET_VARS['vote']) ) ? $HTTP_GET_VARS['vote'] : $HTTP_POST_VARS['vote'] ) == "viewresult" ) ? TRUE : 0;
				}
				else
				{
					$view_result = 0;
				}

				$poll_expired = ( $vote_info[0]['vote_length'] ) ? ( ( $vote_info[0]['vote_start'] + $vote_info[0]['vote_length'] < time() ) ? TRUE : 0 ) : 0;

				if( $user_voted || $view_result || $poll_expired || $forum_row['topic_status'] == TOPIC_LOCKED )
				{

					$template->set_filenames(array(
						"pollbox" => "portal_poll_result.tpl")
					);

					$vote_results_sum = 0;

					for($i = 0; $i < $vote_options; $i++)
					{
						$vote_results_sum += $vote_info[$i]['vote_result'];
					}

					$vote_graphic = 0;
					$vote_graphic_max = count($images['voting_graphic']);

					for($i = 0; $i < $vote_options; $i++)
					{
						$vote_percent = ( $vote_results_sum > 0 ) ? $vote_info[$i]['vote_result'] / $vote_results_sum : 0;
						$portal_vote_graphic_length = round($vote_percent * $portal_config['md_poll_bar_length']);

						$vote_graphic_img = $images['voting_graphic'][$vote_graphic];
						$vote_graphic_img_left = $images['voting_graphic_left'];
						$vote_graphic_img_right = $images['voting_graphic_right'];
						$vote_graphic = ($vote_graphic < $vote_graphic_max - 1) ? $vote_graphic + 1 : 0;

						if( count($orig_word) )
						{
							$vote_info[$i]['vote_option_text'] = preg_replace($orig_word, $replacement_word, $vote_info[$i]['vote_option_text']);
						}

						$template->assign_block_vars("poll_option", array(
							"POLL_OPTION_CAPTION" => $vote_info[$i]['vote_option_text'],
							"POLL_OPTION_RESULT" => $vote_info[$i]['vote_result'],
							"POLL_OPTION_PERCENT" => sprintf("%.1d%%", ($vote_percent * 100)),

							"POLL_OPTION_IMG" => $vote_graphic_img,
							"POLL_OPTION_IMG_WIDTH" => $portal_vote_graphic_length/1)
						);
					}

					$template->assign_vars(array(
						"L_TOTAL_VOTES" => $lang['Total_votes'],
						"TOTAL_VOTES" => $vote_results_sum,
						"POLL_OPTION_IMG_L" => $vote_graphic_img_left,
						"POLL_OPTION_IMG_R" => $vote_graphic_img_right,
						"L_VIEW_RESULTS" => $lang['View_results'], 
						"U_VIEW_RESULTS" => append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&postdays=$post_days&postorder=$post_order&vote=viewresult"))
					);

				}
				else
				{
					$template->set_filenames(array(
						"pollbox" => "portal_poll_ballot.tpl")
					);

					for($i = 0; $i < $vote_options; $i++)
					{
						if( count($orig_word) )
						{
							$vote_info[$i]['vote_option_text'] = preg_replace($orig_word, $replacement_word, $vote_info[$i]['vote_option_text']);
						}

						$template->assign_block_vars("poll_option", array(
							"POLL_OPTION_ID" => $vote_info[$i]['vote_option_id'],
							"POLL_OPTION_CAPTION" => $vote_info[$i]['vote_option_text'])		
						);
					}
					$template->assign_vars(array(
						"LOGIN_TO_VOTE" => '<b><a href="' . append_sid("login.$phpEx?redirect=portal.$phpEx") . '">' . $lang['Login_to_vote'] . '</a><b>')
					);

					$s_hidden_fields = '<input type="hidden" name="topic_id" value="' . $topic_id . '"><input type="hidden" name="mode" value="vote">';
				}

				if( count($orig_word) )
				{
					$vote_title = preg_replace($orig_word, $replacement_word, $vote_title);
				}

				$template->assign_vars(array(
					"POLL_QUESTION" => $vote_title,
					"L_SUBMIT_VOTE" => $lang['Submit_vote'],
					"S_HIDDEN_FIELDS" => ( !empty($s_hidden_fields) ) ? $s_hidden_fields : "",
					"S_POLL_ACTION" => append_sid("posting.$phpEx?" . POST_TOPIC_URL . "=$topic_id"))
				);

				$template->assign_var_from_handle("PORTAL_POLL", "pollbox");
			}
		}
	}
}

imp_poll_block_func();
?>