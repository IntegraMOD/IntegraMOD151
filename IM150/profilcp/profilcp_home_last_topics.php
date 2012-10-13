<?php
/***************************************************************************
 *                            profilcp_home_last_topics.php
 *                            -----------------------------
 *	begin				: 24/10/2003
 *	copyright			: Ptirhiik
 *	email				: admin@rpgnet-fr.com
 *
 *	version				: 1.0.0 - 24/10/2003
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
$topics_last_previous_days = array(0, 1, 7, 14, 30, 90, 180, 364);
$topics_last_previous_days_text = array($lang['PCP_topics_last_visit'], $lang['1_Day'], $lang['7_Days'], $lang['2_Weeks'], $lang['1_Month'], $lang['3_Months'], $lang['6_Months'], $lang['1_Year']);

//-------------------------------------------
//
//	Subscribed topics
//
//-------------------------------------------
if ($process == 'pre')
{
	// get page parm
	$topics_last_page_size = (isset($board_config['user_topics_last_per_page'])) ? intval($board_config['user_topics_last_per_page']) : 0;
	$topics_last_total = 0;
	$topics_last_start = 0;

	if ($topics_last_page_size > 0)
	{
		// get the current page
		$topics_last_start = 0;
		if ( isset($HTTP_POST_VARS['topics_last_start']) || isset($HTTP_GET_VARS['startlt']) )
		{
			$topics_last_start = isset($HTTP_GET_VARS['startlt']) ? intval($HTTP_GET_VARS['startlt']) : intval($HTTP_POST_VARS['topics_last_start']);
		}

		// get the selection days
		$lt_msg_days = 0;
		if (isset($HTTP_POST_VARS['lt_msg_days']) || isset($HTTP_GET_VARS['ltmsgd']) )
		{
			$lt_msg_days = isset($HTTP_POST_VARS['lt_msg_days']) ? intval($HTTP_POST_VARS['lt_msg_days']) : intval($HTTP_GET_VARS['ltmsgd']);
		}

		// select days option
		if ( !isset($topics_last_previous_days[$lt_msg_days]) )
		{
			$lt_msg_days = 0;
		}

		// get floor time
		$topics_last_floor = time();
		if ( $lt_msg_days == 0 )
		{
			$topics_last_floor = $view_userdata['user_lastvisit'];
		}
		else
		{
			$topics_last_floor = time() - (24 * 3600 * $topics_last_previous_days[$lt_msg_days]);
		}

		// get forums list
		$is_auth = array();
		$is_auth = auth(AUTH_READ, AUTH_LIST_ALL, $userdata, $forum_row);
		$s_forum_ids = '';
		while ( list($key, $data) = @each($is_auth) )
		{
			if ( $data['auth_read'] )
			{
				$s_forum_ids .= ( empty($s_forum_ids) ? '' : ', ' ) . $key;
			}
		}

		// get the number of topics watched
		$topics_last_total = 0;
		if ( !empty($s_forum_ids) )
		{
			if (($userdata['user_level'] != ADMIN && $userdata['user_level'] != MOD) || !$is_auth['auth_delayedpost'])
			{
				$current_time = time();
				$limit_topics_time = " AND (t.topic_time <= $current_time OR t.topic_poster = " . $userdata['user_id'] . ")";
			}

			$sql = "SELECT t.*, u.username, u.user_id, u2.username as user2, u2.user_id as id2, p.post_username, p2.post_username AS post_username2, p2.post_time, f.forum_name
					FROM " . TOPICS_TABLE . " t, " . USERS_TABLE . " u, " . POSTS_TABLE . " p, " . POSTS_TABLE . " p2, " . USERS_TABLE . " u2, " . FORUMS_TABLE . " f
					WHERE t.forum_id IN ($s_forum_ids)
						AND f.forum_id = t.forum_id
						AND t.topic_poster = u.user_id
						AND p.post_id = t.topic_first_post_id
						AND p2.post_id = t.topic_last_post_id
						AND u2.user_id = p2.poster_id 
						AND	p2.post_time >= $topics_last_floor
						$limit_topics_time
					ORDER BY t.topic_type DESC, p2.post_time DESC";
			if ( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not query watched topics information', '', __LINE__, __FILE__, $sql);
			}
			$topics_last_total = $db->sql_numrows($result);
			$topics_last_sql = $sql;
		}

		// pagination fields
		if ( $topics_last_start >= $topics_last_total )
		{
			$topics_last_start = $topics_last_total - 1;
		}
		if ( $topics_last_start < 0 )
		{
			$topics_last_start = 0;
		}
		$s_pagination_fields .= "&ltmsgd=$lt_msg_days";
		$s_pagination_fields .= "&startlt=$topics_last_start";
	}
}

if ( ($process == 'post') && ($topics_last_page_size > 0) )
{
	// read the topics watched
	$topic_rowset = array();
	if ($topics_last_total > 0)
	{
		$sql = $topics_last_sql . " LIMIT $topics_last_start, $topics_last_page_size";
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
	$select_lt_msg_days = '';
	for($i = 0; $i < count($topics_last_previous_days); $i++)
	{
		$selected = ( $lt_msg_days == $i ) ? ' selected="selected"' : '';
		$select_lt_msg_days .= '<option value="' . $i . '"' . $selected . '>' . $topics_last_previous_days_text[$i] . '</option>';
	}
	$select_lt_msg_days = sprintf('<select name="lt_msg_days">%s</select>', $select_lt_msg_days);
	$footer = $lang['Submit_period'] . ':&nbsp;' . $select_lt_msg_days;
	$footer .= '&nbsp;<input type="submit" class="liteoption" name="submitperiod" value="' . $lang['Go'] . '" />';

	// save template state
	$sav_tpl = $template->_tpldata;

	// send the list
	$list_title = $lang['PCP_topics_last'];
	$split_type = true;
	$display_nav_tree = true;
	$inbox = false;
	topic_list('_topics_last_box', 'topics_list_box', $topic_rowset, $list_title, $split_type, $display_nav_tree, $footer, $inbox);

	// get back the result
	$res = $template->_tpldata['.'][0]['_topics_last_box'];

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
	$s_hidden_fields .= '<input type="hidden" name="topics_last_start" value="' . $topics_last_start . '" />';

	// fix pagination display bug
	if ($topics_last_total == 0)
	{
		$topics_last_total = 1;
	}

	// remove the current paginations data (will be added by the generate_pagination() func)
	$w_pagination = str_replace( "&startlt=$topics_last_start", '', $s_pagination_fields );

	// send the pagination sentence to display
	$template->assign_block_vars('right_part.box.pagination', array(
		/* Topics Since :: Altered
		'PAGINATION'	=> generate_pagination("./profile.$phpEx?$w_pagination", $topics_last_total, $topics_last_page_size, $topics_last_start, true, 'startlt'),*/
		'PAGINATION'	=> generate_pagination($_SERVER["SCRIPT_URL"]."?$w_pagination", $topics_last_total, $topics_last_page_size, $topics_last_start, true, 'startlt'),
		'PAGE_NUMBER'	=> sprintf($lang['Page_of'], ( floor( $topics_last_start / $topics_last_page_size ) + 1 ), ceil( $topics_last_total / $topics_last_page_size )), 
		)
	);
}

?>
