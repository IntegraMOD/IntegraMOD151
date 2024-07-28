<?php
/***************************************************************************
 *                            profilcp_home_buddy.php
 *                            -----------------------
 *	begin				: 26/09/2003
 *	copyright			: Ptirhiik
 *	email				: admin@rpgnet-fr.com
 *
 *	version				: 1.0.1 - 23/10/2003
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

if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
	exit;
}

if ( !empty($setmodules) ) return;

if ( !empty($set_homemodules) )
{
	$file = basename(__FILE__);
	$home_modules['pos'][] = 'right';
	$home_modules['sort'][] = 10;
	$home_modules['url'][] = $file;
	return;
}


// constants
$previous_days = array(0, 1, 7, 14, 30, 90, 180, 364);
$previous_days_text = array($lang['All_Posts'], $lang['1_Day'], $lang['7_Days'], $lang['2_Weeks'], $lang['1_Month'], $lang['3_Months'], $lang['6_Months'], $lang['1_Year']);

//-------------------------------------------
//
//	Subscribed topics
//
//-------------------------------------------
if ($process == 'pre')
{
	// get page parm
	$topics_watched_page_size = (isset($board_config['user_watched_topics_per_page'])) ? intval($board_config['user_watched_topics_per_page']) : 0;
	$topics_watched_total = 0;
	$topics_watched_start = 0;

	if ($topics_watched_page_size > 0)
	{
		// get the current page
		$topics_watched_start = 0;
		if ( isset($_POST['topics_watched_start']) || isset($_GET['startwt']) )
		{
			$topics_watched_start = isset($_GET['startwt']) ? intval($_GET['startwt']) : intval($_POST['topics_watched_start']);
		}

		// get the selection days
		$msg_days = 1;
		if (isset($_POST['msg_days']) || isset($_GET['msgd']) )
		{
			$msg_days = isset($_POST['msg_days']) ? intval($_POST['msg_days']) : intval($_GET['msgd']);
		}

		// get the selected topics
		$select_unwatched = array();
		if ( isset($_POST['select_unwatch']) )
		{
			$w_unwatched = $_POST['select_unwatch'];
			for ($i=0; $i < count($w_unwatched); $i++)
			{
				$type = substr($w_unwatched[$i], 0, 1);
				$id = intval(substr($w_unwatched[$i], 1));
				if ($id != 0)
				{
					$select_unwatched[] = $type . $id;
				}
			}
		}

		// get the unwatched button
		$submit_unwatched = isset($_POST['submit_unwatched']);

		// unwatched topics
		if ( $submit_unwatched && !empty($select_unwatched) )
		{
			$s_topic_ids = '';
			for ($i=0; $i < count($select_unwatched); $i++)
			{
				$s_topic_ids .= ( empty($s_topic_ids) ? '' : ', ' ) . intval(substr($select_unwatched[$i], 1));
			}
			$sql = "DELETE FROM " . TOPICS_WATCH_TABLE . " WHERE user_id=$view_user_id AND topic_id IN ($s_topic_ids)";
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not unwatched topics', '', __LINE__, __FILE__, $sql);
			}
		}

		// select days option
		if ( !isset($previous_days[$msg_days]) )
		{
			$msg_days = 0;
		}
		$floor = ($msg_days == 0) ? 0 : time() - (24 * 3600 * $previous_days[$msg_days]);

		// get forums list
		$is_auth = array();
		$is_auth = auth(AUTH_READ, AUTH_LIST_ALL, $userdata, ( isset($forum_row) ? $forum_row : NULL ) );
		$s_forum_ids = '';
		// V: also compute forums where the user is allowed to see delayed posts
		$allowed_delayedpost_ids = array();
    foreach ($is_auth as $key => $data)
		{
			if ( $data['auth_read'] )
			{
				$s_forum_ids .= ( empty($s_forum_ids) ? '' : ', ' ) . $key;
				if ($data['auth_delayedpost'])
				{
					$allowed_delayedpost_ids[] = $key;
				}
			}
		}

		// get the number of topics watched
		$topics_watched_total = 0;
		if ( !empty($s_forum_ids) )
		{
			if (($userdata['user_level'] != ADMIN && $userdata['user_level'] != MOD))
			{
				$current_time = time();
				$limit_topics_time = " AND ((t.topic_time <= $current_time OR t.topic_poster = " . $userdata['user_id'] . ")";
				if (!empty($allowed_delayedpost_ids))
				{
					$allowed_delayedpost_ids .= " OR f.forum_id IN (" . implode(", ", $allowed_delayedpost_ids) . ")";
				}
				$limit_topics_time .= ")";
			}

			$sql = "SELECT t.*, u.username, u.user_id, u2.username as user2, u2.user_id as id2, p.post_username, p2.post_username AS post_username2, p2.post_time, f.forum_name
					FROM " . TOPICS_TABLE . " t, " . USERS_TABLE . " u, " . POSTS_TABLE . " p, " . POSTS_TABLE . " p2, " . USERS_TABLE . " u2, " . TOPICS_WATCH_TABLE . " w, " . FORUMS_TABLE . " f
					WHERE t.topic_id = w.topic_id
						AND t.forum_id IN ($s_forum_ids)
						AND f.forum_id = t.forum_id
						AND w.user_id = $view_user_id
						AND t.topic_poster = u.user_id
						AND p.post_id = t.topic_first_post_id
						AND p2.post_id = t.topic_last_post_id
						AND u2.user_id = p2.poster_id 
						AND	p2.post_time >= $floor
						$limit_topics_time
					ORDER BY t.topic_type DESC, p2.post_time DESC";
			if ( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not query watched topics information', '', __LINE__, __FILE__, $sql);
			}
			$topics_watched_total = $db->sql_numrows($result);
			$topics_watched_sql = $sql;
		}

		// pagination fields
		if ( $topics_watched_start >= $topics_watched_total )
		{
			$topics_watched_start = $topics_watched_total - 1;
		}
		if ( $topics_watched_start < 0 )
		{
			$topics_watched_start = 0;
		}
		$s_pagination_fields .= "&msgd=$msg_days";
		$s_pagination_fields .= "&startwt=$topics_watched_start";
	}
}

if ( ($process == 'post') && ($topics_watched_page_size > 0) )
{
	// read the topics watched
	$topic_rowset = array();
	if ($topics_watched_total > 0)
	{
		$sql = $topics_watched_sql . " LIMIT $topics_watched_start, $topics_watched_page_size";
		if ( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not query watched topics information', '', __LINE__, __FILE__, $sql);
		}
		while ($row = $db->sql_fetchrow($result) ) 
		{
			$row['topic_id'] = POST_TOPIC_URL . $row['topic_id'];
			$topic_rowset[] = $row;
		}
	}

	// Build select box
	$select_msg_days = '';
	for($i = 0; $i < count($previous_days); $i++)
	{
		$selected = ( $msg_days == $i ) ? ' selected="selected"' : '';
		$select_msg_days .= '<option value="' . $i . '"' . $selected . '>' . $previous_days_text[$i] . '</option>';
	}
	$select_msg_days = sprintf('<select name="msg_days">%s</select>', $select_msg_days);
	$footer = $lang['Submit_period'] . ':&nbsp;' . $select_msg_days;
	$footer .= '&nbsp;<input type="submit" class="liteoption" name="submitperiod" value="' . $lang['Go'] . '" />';
	if ( !empty($topic_rowset) )
	{
		$footer .= '&nbsp;&nbsp;&nbsp;<input type="submit" name="submit_unwatched" class="liteoption" value="' . $lang['Stop_watching_selected_topics'] . '" />';
	}

	// save template state
	$sav_tpl = $template->_tpldata;

	// send the list
	$list_title = $lang['New_subscribed_topic'];
	$split_type = true;
	$display_nav_tree = true;
	$inbox = false;
	$select_field = 'select_unwatch';
	$select_type = 1;
	$select_formname = 'post';
	topic_list('_topics_watched_box', 'topics_list_box', $topic_rowset, $list_title, $split_type, $display_nav_tree, $footer, $inbox, $select_field, $select_type, $select_formname, $select_unwatched);

	// get back the result
	$res = $template->_tpldata['.'][0]['_topics_watched_box'];

	// restore template saved state
	$template->_tpldata = $sav_tpl;

	// init right part of the home panel
	if ( !$right_part )
	{
		$template->assign_block_vars('right_part', array());
		$right_part = true;
	}

	// send result to template
	$template->assign_block_vars('right_part.box', array(
		'BOX' => $res,
		)
	);

	// hidden fields
	$s_hidden_fields .= '<input type="hidden" name="topics_watched_start" value="' . $topics_watched_start . '" />';

	// fix pagination display bug
	if ($topics_watched_total == 0)
	{
		$topics_watched_total = 1;
	}

	// remove the current paginations data (will be added by the generate_pagination() func)
	$w_pagination = str_replace( "&startwt=$topics_watched_start", '', $s_pagination_fields );

	// send the pagination sentence to display
	$template->assign_block_vars('right_part.box.pagination', array(
		'PAGINATION'	=> generate_pagination("./profile.$phpEx?$w_pagination", $topics_watched_total, $topics_watched_page_size, $topics_watched_start, true, 'startwt'),
		'PAGE_NUMBER'	=> sprintf($lang['Page_of'], ( floor( $topics_watched_start / $topics_watched_page_size ) + 1 ), ceil( $topics_watched_total / $topics_watched_page_size )), 
		)
	);
}

?>
