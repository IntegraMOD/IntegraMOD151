<?php
/***************************************************************************
 *                              topic_review.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 *
 ***************************************************************************/

function topic_review($topic_id, $is_inline_review)
{
	global $db, $board_config, $template, $lang, $images, $theme, $phpEx, $phpbb_root_path;
	global $userdata, $user_ip;
	global $orig_word, $replacement_word;
	global $starttime;

  //evolver time fix #1//	
  if ( isset($userdata['user_timezone']) )
  {
    $usersummertime = 0;
    $boardsummertime = 0;
    if($userdata['user_summer_time']) $usersummertime = 1;
    if($board_config['summer_time']) $boardsummertime = 1;

    $zonedifference = (($board_config['real_board_timezone'] + $boardsummertime) - ($board_config['board_timezone'] + $usersummertime));
  }
  else
  {
  $zonedifference = 0;
  }
  $zonediffseconds = ($zonedifference * 3600);	
	
//-- mod : post icon -------------------------------------------------------------------------------
//-- add
	global $icones;
//-- fin mod : post icon ---------------------------------------------------------------------------
//-- mod : profile cp ------------------------------------------------------------------------------
//-- add
	global $admin_level, $level_prior;
//-- fin mod : profile cp --------------------------------------------------------------------------
//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
	global $tree;
//-- fin mod : categories hierarchy ----------------------------------------------------------------
//-- mod : qbar ------------------------------------------------------------------------------------
//-- add
	global $qbar_maps;
//-- fin mod : qbar --------------------------------------------------------------------------------
//-- mod : sub-template ----------------------------------------------------------------------------
//-- add
	global $sub_template_key_image, $sub_templates;
//-- fin mod : sub-template ------------------------------------------------------------------------

	if ( !$is_inline_review )
	{
      if ( !isset($topic_id) || !$topic_id)
      {
         message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');
      }
		//
		// Get topic info ...
		//
//-- mod : calendar --------------------------------------------------------------------------------
// here we added
//	, t.topic_calendar_time, t.topic_calendar_duration, t.topic_first_post_id
//-- modify
		$sql = "SELECT t.topic_title, t.topic_calendar_time, t.topic_calendar_duration, t.topic_first_post_id, f.forum_id, f.auth_view, f.auth_read, f.auth_post, f.auth_reply, f.auth_edit, f.auth_delete, f.auth_sticky, f.auth_announce, f.auth_pollcreate, f.auth_vote, f.auth_attachments, f.auth_delayedpost 
			FROM " . TOPICS_TABLE . " t, " . FORUMS_TABLE . " f 
			WHERE t.topic_id = $topic_id
				AND f.forum_id = t.forum_id";
//-- fin mod : calendar ----------------------------------------------------------------------------
		$tmp = '';
		attach_setup_viewtopic_auth($tmp, $sql);
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain topic information', '', __LINE__, __FILE__, $sql);
		}

		if ( !($forum_row = $db->sql_fetchrow($result)) )
		{
			message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');
		}
		$db->sql_freeresult($result);

		$forum_id = $forum_row['forum_id'];
		$topic_title = $forum_row['topic_title'];
//-- mod : calendar --------------------------------------------------------------------------------
//-- add
		$topic_calendar_time = intval($forum_row['topic_calendar_time']);
		$topic_first_post_id = intval($forum_row['topic_first_post_id']);
		$topic_calendar_duration = intval($forum_row['topic_calendar_duration']);
//-- fin mod : calendar ----------------------------------------------------------------------------
		
		//
		// Start session management
		//
		$userdata = session_pagestart($user_ip, $forum_id);
		init_userprefs($userdata);
		//
		// End session management
		//

		$is_auth = array();
		$is_auth = auth(AUTH_ALL, $forum_id, $userdata, $forum_row);

		if ( !$is_auth['auth_read'] )
		{
			message_die(GENERAL_MESSAGE, sprintf($lang['Sorry_auth_read'], $is_auth['auth_read_type']));
		}
	}

	//
	// Define censored word matches
	//
	if ( empty($orig_word) && empty($replacement_word) )
	{
		$orig_word = array();
		$replacement_word = array();

		obtain_word_list($orig_word, $replacement_word);
	}

	//
	// Dump out the page header and load viewtopic body template
	//
	if ( !$is_inline_review )
	{
		$gen_simple_header = TRUE;

		$page_title = $lang['Topic_review'] . ' - ' . $topic_title;
		include($phpbb_root_path . 'includes/page_header.'.$phpEx);

		$template->set_filenames(array(
			'reviewbody' => 'posting_topic_review.tpl')
		);
	}

	//
	// Go ahead and pull all data for this topic
	//
	$sql = "SELECT u.username, u.user_id, p.*,  pt.post_text, pt.post_subject, pt.bbcode_uid
		FROM " . POSTS_TABLE . " p, " . USERS_TABLE . " u, " . POSTS_TEXT_TABLE . " pt
		WHERE p.topic_id = $topic_id
			AND p.poster_id = u.user_id
			AND p.post_id = pt.post_id
		ORDER BY p.post_time DESC
		LIMIT " . $board_config['posts_per_page'];
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain post/user information', '', __LINE__, __FILE__, $sql);
	}

	init_display_review_attachments($is_auth);

// 
// Begin Approve_Mod Block : 12
// 
	$approve_mod = array(); 
	$approve_sql = "SELECT * FROM " . APPROVE_FORUMS_TABLE . " 
		WHERE forum_id = " . intval($forum_id); 
	if ( !($approve_result = $db->sql_query($approve_sql)) ) 
	{ 
		message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
	} 
	if ( $approve_mod = $db->sql_fetchrow($approve_result) ) 
	{    
		if ( intval($approve_mod['enabled']) == 1)
		{
			$approve_mod['enabled'] = true;	
		}
	}
	$approve_mod['moderators'] = explode('|', get_moderators_user_id_of_forum($forum_id));
// 
// End Approve_Mod Block : 12
// 

	//
	// Okay, let's do the loop, yeah come on baby let's do the loop
	// and it goes like this ...
	//
	if ( $row = $db->sql_fetchrow($result) )
	{
		//Begin Lo-Fi Mod
		global $lofi;
		//End Lo-Fi Mod

		$mini_post_img = $images['icon_minipost'];
		$mini_post_alt = $lang['Post'];

		$i = 0;
		do
		{
			//evolver time fix #2//
	        $poster_id = $row['user_id'];
			$poster = $row['username'];
		    $posttime= $row['post_time']-$zonediffseconds;
			$post_date = create_date($board_config['default_dateformat'], $posttime, $board_config['board_timezone']);          
			//$post_date = create_date($board_config['default_dateformat'], $row['post_time'], $board_config['board_timezone']); 

			//
			// Handle anon users posting with usernames
			//
			if( $poster_id == ANONYMOUS && $row['post_username'] != '' )
			{
				$poster = $row['post_username'];
				$poster_rank = $lang['Guest'];
			}
			elseif ( $poster_id == ANONYMOUS )
			{
				$poster = $lang['Guest'];
				$poster_rank = '';
			}

			$post_subject = ( $row['post_subject'] != '' ) ? $row['post_subject'] : '';

			$message = $row['post_text'];
			$bbcode_uid = $row['bbcode_uid'];

			$message = preg_replace("#\[web:$bbcode_uid\]#si", '[align=center:'.$bbcode_uid.'][size=9:'.$bbcode_uid.']( ', $message);
			$message = preg_replace("#\[web height=([0-9]?[0-9]?[0-9]):$bbcode_uid\]#si", '[align=center:'.$bbcode_uid.'][size=9:'.$bbcode_uid.']( ', $message);
			$message = preg_replace("#\[/\web:$bbcode_uid]#si", ' )[/size:'.$bbcode_uid.'][/align:'.$bbcode_uid.']', $message);

			if ( strpos($message, '.script') !== false)
			{
				$message = str_replace(".script", "script", $message);
			}

			$plain_message = $row['post_text'];
			$plain_message = preg_replace('/\:(([a-z0-9]:)?)' . $bbcode_uid . '/s', '', $plain_message);
			$plain_message = str_replace('<', '&lt;', $plain_message);
			$plain_message = str_replace('>', '&gt;', $plain_message);
			$plain_message = str_replace('<br />', "\n", $plain_message);

			$orig_word = array();
			$replacement_word = array();
			obtain_word_list($orig_word, $replacement_word);

			if ( !empty($orig_word) )
			{
				$plain_message = ( !empty($plain_message) ) ? preg_replace($orig_word, $replacement_word, $plain_message) : '';
			}
			$plain_message = addslashes($plain_message);
			$plain_message = str_replace("\n", "\\n", $plain_message);

			//
			// If the board has HTML off but the post has HTML
			// on then we process it, else leave it alone
			//
			if ( !$board_config['allow_html'] && $row['enable_html'] )
			{
				$message = preg_replace('#(<)([\/]?.*?)(>)#is', '&lt;\2&gt;', $message);
			}

			if ( $bbcode_uid != "" )
			{
				$message = ( $board_config['allow_bbcode'] ) ? bbencode_second_pass($message, $bbcode_uid) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $message);
			}

			$message = make_clickable($message);

			if ( count($orig_word) )
			{
				$post_subject = preg_replace($orig_word, $replacement_word, $post_subject);
				$message = preg_replace($orig_word, $replacement_word, $message);
			}

			//Begin Lo-Fi Mod
			if ( $board_config['allow_smilies'] && $row['enable_smilies'] && !$lofi )
			//End Lo-Fi Mod
			{
				$message = smilies_pass($message);
			}

			$message = str_replace("\n", '<br />', $message);

//-- mod : calendar --------------------------------------------------------------------------------
//-- add
			if (!empty($topic_calendar_time) && ($topic_first_post_id == $row['post_id']))
			{
				$post_subject .= get_calendar_title($topic_calendar_time, $topic_calendar_duration);
			}
//-- fin mod : calendar ----------------------------------------------------------------------------
//-- mod : post icon -------------------------------------------------------------------------------
//-- add
			$post_subject = get_icon_title($row['post_icon']) . '&nbsp;' . $post_subject;
//-- fin mod : post icon ---------------------------------------------------------------------------
			//
			// Again this will be handled by the templating
			// code at some point
			//
			$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
			$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

// 
// Begin Approve_Mod Block : 13
// 		
		if ( $approve_mod['enabled'] )
		{
			$approve_mod['posts_awaiting'] = false;
			$approve_sql = "SELECT * FROM " . APPROVE_POSTS_TABLE . " 
				WHERE post_id = " . intval($row['post_id']) . " 
				LIMIT 0,1"; 
			if ( !($approve_result = $db->sql_query($approve_sql)) ) 
			{ 
				message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
			} 
			if ( $approve_row = $db->sql_fetchrow($approve_result) ) 
			{ 
				if ( intval($approve_row['post_id']) == intval($row['post_id']) )
				{
					$approve_mod['posts_awaiting'] = true;
				}  
			} 
			if ( $approve_mod['posts_awaiting'] )
			{
				if ( in_array($userdata['user_id'], $approve_mod['moderators']) || $is_auth['auth_mod'] ) 
				{ 
					$post_subject = $post_subject . "<br/>[ " . $lang['approve_post_is_awaiting'] . " ]";
				}
				else
				{
					if ( $approve_mod['forum_hide_unapproved_posts'] ) 
					{
						continue;
					}
					else
					{
						$post_subject = "[ " . $lang['approve_post_is_awaiting'] . " ]";
						$message = $post_subject;
					}
				}
			}
		}
// 
// End Approve_Mod Block : 13
//

			$template->assign_block_vars('postrow', array(
				'ROW_COLOR' => '#' . $row_color, 
				'ROW_CLASS' => $row_class, 

				'MINI_POST_IMG' => $mini_post_img, 
				'POSTER_NAME' => $poster, 
				'POST_DATE' => $post_date, 
				'POST_SUBJECT' => $post_subject, 
				'MESSAGE' => $message,
				'U_POST_ID' => $row['post_id'],
				'PLAIN_MESSAGE' => str_replace(chr(13), '', $plain_message),
					
				'L_MINI_POST_ALT' => $mini_post_alt)
			);
			display_review_attachments($row['post_id'], $row['post_attachment'], $is_auth);

			$i++;
		}
		while ( $row = $db->sql_fetchrow($result) );
	}
	else
	{
		message_die(GENERAL_MESSAGE, 'Topic_post_not_exist', '', __LINE__, __FILE__, $sql);
	}
	$db->sql_freeresult($result);

	$template->assign_vars(array(
		'L_AUTHOR' => $lang['Author'],
		'L_MESSAGE' => $lang['Message'],
		'L_POSTED' => $lang['Posted'],
		'L_POST_SUBJECT' => $lang['Post_subject'],
		'L_QUICK_QUOTE' => $lang['Quote'],
		'L_TOPIC_REVIEW' => $lang['Topic_review'])
	);

	if ( !$is_inline_review )
	{
		$template->pparse('reviewbody');
		
	}
}

?>
