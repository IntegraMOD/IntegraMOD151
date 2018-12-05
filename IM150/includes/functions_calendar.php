<?php

/***************************************************************************
 *                            functions_calendar.php
 *                            ----------------------
 *	begin			: 02/08/2003
 *	copyright		: Ptirhiik
 *	email			: admin@rpgnet-fr.com
 *	version			: 1.1.7 - 15/09/2003
 *
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

include_once($phpbb_root_path . './includes/functions_post.' . $phpEx);
include_once($phpbb_root_path . './includes/bbcode.' . $phpEx);

// function select
function calendar_get_tree_option($cur='')
{
	global $db, $userdata, $lang;

	// init
	if ( empty($cur) || ($cur == 'Root') )
	{
		$cur = POST_CAT_URL . 0;
	}
	$type = substr($cur, 0, 1);
	$id = intval(substr($cur, 1));
	if ( ($id == 0) || !in_array($type, array(POST_CAT_URL, POST_FORUM_URL)) )
	{
		$type = POST_CAT_URL;
		$id = 0;
	}
	$cur = $type . $id;

	// init res
	$selected = ($cur == POST_CAT_URL . 0) ? ' selected="selected"' : '';
	$res = '<option value="Root"' . $selected . '>' . $lang['Forum_index'] . '</option>';

	// get auth read
	$is_auth = auth(AUTH_ALL, AUTH_LIST_ALL, $userdata);
	$forum_ids = array();
	while ( list($forum_id, $auth) = each($is_auth) )
	{
		if ($auth['auth_read'] && $auth['auth_view'])
		{
			$forum_ids[] = $forum_id;
		}
	}
	if (empty($forum_ids)) return $res;

	// list of forums authed
	$s_forum_list = implode(', ', $forum_ids);
	$sql = "SELECT f.cat_id, c.cat_title, f.forum_id, f.forum_name
				FROM " . FORUMS_TABLE . " AS f, " . CATEGORIES_TABLE . " AS c
				WHERE c.cat_id = f.cat_id 
					AND f.forum_id IN ($s_forum_list)
				ORDER BY cat_order, cat_title, forum_order, forum_name";
	if ( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Couldn not obtain forums/categories informations', '', __LINE__, __FILE__, $sql);
	}
	$cat_id = -1;
	$first = true;
	while ($row = $db->sql_fetchrow($result))
	{
		// category
		if ( ($row['cat_id'] != $cat_id) || $first )
		{
			$first = false;
			$cat_id = $row['cat_id'];
			$fid = POST_CAT_URL . $row['cat_id'];
			$selected = ($cur == $fid) ? ' selected="selected"' : '';
			$res .= sprintf('<option value="%s"%s>|--[ %s ]</option>', $fid, $selected, str_replace("''", "\'", $row['cat_title']) );
		}

		// forum
		$fid = POST_FORUM_URL . $row['forum_id'];
		$selected = ($cur == $fid) ? ' selected="selected"' : '';
		$res .= sprintf('<option value="%s"%s>|&nbsp;&nbsp;&nbsp;|--- %s</option>', $fid, $selected, str_replace("''", "\'", $row['forum_name']) );
	}

	return $res;
}

function calendar_forum_select($selected_id='')
{
	global $db, $userdata, $lang;

	$forum_list = '<select name="selected_id" onchange="forms[\'_calendar\'].submit();">' . calendar_get_tree_option($selected_id) . '</select>';

	return $forum_list;
}

// translate a date for display
function date_dsp($format, $date)
{
	global $board_config, $lang;
	static $translate;
	// correct timezone and summertime
	//board2usertime($date); 

	if ( empty($translate) && $board_config['default_lang'] != 'english' )
	{
		@reset($lang['datetime']);
		while ( list($match, $replace) = @each($lang['datetime']) )
		{
			$translate[$match] = $replace;
		}
	}
	return ( !empty($translate) ) ? strtr(date($format, $date), $translate) : date($format, $date);
}

function get_calendar_title_date($calendar_start, $calendar_duration)
{
	global $lang, $images, $phpbb_root_path, $phpEx, $board_config, $userdata;
	if (empty($calendar_start)) return '';
	board2usertime($calendar_start);
	// get the component of the date and duration
	$year	= 0;
	$month	= 0;
	$day	= 0;
	$hour	= 0;
	$min	= 0;
	$d_day	= 0;
	$d_hour	= 0;
	$d_min	= 0;
	if (!empty($calendar_start))
	{
		$year	= intval( date('Y', $calendar_start) );
		$month	= intval( date('m', $calendar_start) );
		$day	= intval( date('d', $calendar_start) );
		$hour	= intval( date('H', $calendar_start) );
		$min	= intval( date('i', $calendar_start) );
		if ( !empty($calendar_duration) )
		{
			$d_dur = intval($calendar_duration);
			$d_day = intval($d_dur / 86400);
			$d_dur = $d_dur - 86400 * $d_day;
			$d_hour = intval($d_dur / 3600);
			$d_dur = $d_dur - 3600 * $d_hour;
			$d_min = intval($d_dur / 60);
		}
	}

	// quit if no date
	if ( empty($year) || empty($month) || empty($day) ) return '';

	// raz duration less than 1 day if no time for event start
	if (empty($hour) && empty($min))
	{
		$d_hour = 0;
		$d_min = 0;
	}

	// add the time to start date if present
	$fmt_start = $lang['DATE_FORMAT'];
	if (!empty($hour))
	{
		$fmt_start = $board_config['default_dateformat'];
	}

	// add the time to end date if duration
	$fmt_end = $lang['DATE_FORMAT'];
	if ( !empty($hour) || !empty($d_hour) )
	{
		$fmt_end = $board_config['default_dateformat'];
	}

	// apply it to dates
	$date_start		= date_dsp($fmt_start, $calendar_start);
	$date_end		= date_dsp($fmt_end, $calendar_start + $calendar_duration);

	// add period to the title
	$calendar_icon	= '<a href="' . append_sid( $phpbb_root_path . "./calendar.$phpEx?start=" . date( 'Ymd', $calendar_start)). '"><img src="' . $images['icon_calendar'] . '" hspace="3" border="0" align="top" alt="' . $lang['Calendar_event'] . '" /></a>';
	if (empty($calendar_duration))
	{
		$res = sprintf($lang['Calendar_time'], $date_start);
	}
	else
	{
		$res = sprintf($lang['Calendar_from_to'], $date_start, $date_end);
	}

	return $res;
}

function get_calendar_title($calendar_start, $calendar_duration)
{
	if (empty($calendar_start)) return '';

	$calendar_title = get_calendar_title_date($calendar_start, $calendar_duration);
	if (empty($calendar_title)) return '';

	// send back the full title
	$res = '<span class="gensmall"><br />' . $calendar_title . '</span>';
	return $res;
}

//------------------------------------------------------------------
// Event management : all events are stored in the array events
// ----------------
//	structure of this array :
//
//
//		event_id : letter + id : ie u2 = User, user_id=2
//
//		event_author_id :			id of the author of the event (for topic : topic poster)
//		event_author :				name of the event author
//		event_time :				date-time of the event creation
//
//		event_last_author_id :		for topics : author id of the last reply
//		event_last_author :			for topics : author name of the last reply
//		event_last_time :			for topics : date-time of creation of the last reply
//
//		event_replies :				for topics : number of replies
//		event_views :				for topics : number of views
//		event_type :				for topics : topic type
//		event_vote :				for topics : poll present
//		event_status :				for topics : topic status
//		event_moved_id :			for topics : topic moved id
//		event_last_id :				for topics : last post id
//		event_forum_id :			for topics : forum id
//
//		event_icon :				icon for the event title
//		event_title :				title of the event
//		event_short_title			short title of the event (according to the number of char allowed)
//		event_message :				full message (will be used as the overview flying window)
//		event_calendar_time :		start date-time of the event
//		event_calendar_duration :	duration of the event (in seconds)
//
//		event_link :				link to what should be called when clicking to the link
//		event_txt_class :			class of CSS used to display the title in the calendar cells
//		event_type_icon :			icon set to recognize a type of event in the calendar (full HTML <img src="...)
//------------------------------------------------------------------

//
// topics
//
function get_event_topics(&$events, &$number, $start_date, $end_date, $limit=false, $start=0, $max_limit=-1, $fid='')
{
	global $template, $lang, $images, $userdata, $board_config, $db, $phpbb_root_path, $phpEx;
	global $tree;

	// Define censored word matches
	$orig_word = array();
	$replacement_word = array();
	obtain_word_list($orig_word, $replacement_word);

	// get some parameter
	$topic_title_length = isset($board_config['calendar_title_length']) ? intval($board_config['calendar_title_length']) : 30;
	$topic_text_length = isset($board_config['calendar_text_length']) ? intval($board_config['calendar_text_length']) : 200;
	if ($max_limit < 0)
	{
		$max_limit = $board_config['topics_per_page'];
	}

	// get the forums authorized (compliency with categories hierarchy v2 mod)
	$cat_hierarchy = function_exists('get_auth_keys');
	$s_forums_ids = '';
	if (!$cat_hierarchy)
	{
		// standard read
		$is_auth = array();
		$is_auth = auth(AUTH_ALL, AUTH_LIST_ALL, $userdata);

		// forum or cat asked
		$is_ask = array();
		if ( ($fid == 'Root') || ($fid == POST_CAT_URL . 0) ) $fid = '';
		if (!empty($fid))
		{
			$type = substr($fid, 0, 1);
			$id = intval(substr($fid, 1));
			if ($type == POST_CAT_URL)
			{
				$sql = "SELECT forum_id FROM " . FORUMS_TABLE . " WHERE cat_id=$id";
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Could not obtain forums informations', '', __LINE__, __FILE__, $sql);
				}
				while ($row = $db->sql_fetchrow($result))
				{
					$is_ask[$row['forum_id']] = true;
				}
			}
			else if ($type == POST_FORUM_URL)
			{
				$is_ask[$id] = true;
			}
			else return;
		}

		// get the list of authorized forums
		while (list($forum_id, $forum_auth) = each($is_auth))
		{
			if ( $forum_auth['auth_read'] && (empty($fid) || isset($is_ask[$forum_id])) )
			{
				$s_forum_ids .= (empty($s_forum_ids) ? '' : ', ') . $forum_id;
			}
		}
	}
	else
	{
		if ( empty($fid) || ($fid == POST_CAT_URL . 0) ) $fid = 'Root';

		// get auth key
		$keys = array();
		$keys = get_auth_keys($fid, true, -1, -1, 'auth_read');
		for ($i=0; $i < count($keys['id']); $i++)
		{
			if ( ($tree['type'][$keys['idx'][$i]] == POST_FORUM_URL) && $tree['auth'][ $keys['id'][$i] ]['auth_read'] )
			{
				$s_forum_ids .= (empty($s_forum_ids) ? '' : ', ') . $tree['id'][$keys['idx'][$i]];
			}
		}
	}

	// no forums authed, return
	if (empty($s_forum_ids)) return;

	// select topics
	$sql_forums_field = '';
	$sql_forums_file = '';
	$sql_forums_match = '';
	if (!$cat_hierarchy)
	{
		$sql_forums_field = ', f.forum_name';
		$sql_forums_file = ', ' . FORUMS_TABLE . ' AS f';
		$sql_forums_match = ' AND f.forum_id = t.forum_id';
	}
//	$sql = "SELECT 
//					t.*,
//					p.poster_id, p.post_username, p.enable_bbcode, p.enable_html, p.enable_smilies,
//					u.username,
//					pt.post_text, pt.bbcode_uid,
//					lp.poster_id AS lp_poster_id,
//					lu.username AS lp_username,
//					lp.post_username AS lp_post_username,
//					lp.post_time AS lp_post_time
//					$sql_forums_field
//			FROM " . TOPICS_TABLE . " AS t, " . POSTS_TABLE . " AS p, " . POSTS_TEXT_TABLE . " AS pt, " . USERS_TABLE . " AS u, " . POSTS_TABLE . " AS lp, " . USERS_TABLE . " lu $sql_forums_file
//			WHERE 
//					t.forum_id IN ($s_forum_ids)
//				AND p.post_id	= t.topic_first_post_id
//				AND pt.post_id	= t.topic_first_post_id
//				AND u.user_id	= p.poster_id
//				AND lp.post_id	= t.topic_last_post_id
//				AND lu.user_id	= lp.poster_id
//				AND t.topic_calendar_time < $end_date
//				AND (t.topic_calendar_time + t.topic_calendar_duration) >= $start_date
//				AND t.topic_status <> " . TOPIC_MOVED . "
//				$sql_forums_match
//			ORDER BY
//				t.topic_calendar_time, t.topic_calendar_duration DESC, t.topic_last_post_id DESC";
//
//

	$sql = "SELECT 
					t.*,
					p.poster_id, p.post_username, p.enable_bbcode, p.enable_html, p.enable_smilies,
					u.username,
					pt.post_text, pt.bbcode_uid,
					lp.poster_id AS lp_poster_id,
					lu.username AS lp_username,
					lp.post_username AS lp_post_username,
					lp.post_time AS lp_post_time
					$sql_forums_field
			FROM " . TOPICS_TABLE . " AS t, " . POSTS_TABLE . " AS p, " . POSTS_TEXT_TABLE . " AS pt, " . USERS_TABLE . " AS u, " . POSTS_TABLE . " AS lp, " . USERS_TABLE . " lu $sql_forums_file
			WHERE 
					t.forum_id IN ($s_forum_ids)
				AND p.post_id	= t.topic_first_post_id
				AND pt.post_id	= t.topic_first_post_id
				AND u.user_id	= p.poster_id
				AND lp.post_id	= t.topic_last_post_id
				AND lu.user_id	= lp.poster_id
				AND t.topic_calendar_time < $end_date
				AND t.topic_calendar_repeat = '    ' 
				AND (t.topic_calendar_time + t.topic_calendar_duration) >= $start_date
				AND t.topic_status <> " . TOPIC_MOVED . "
				$sql_forums_match
			ORDER BY
				t.topic_calendar_time, t.topic_calendar_duration DESC, t.topic_last_post_id DESC";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain topics information', '', __LINE__, __FILE__, $sql);
	}

	// get the number of occurences
	$number = $db->sql_numrows($result);

	// if limit per page asked, limit the number of results
	if ($limit)
	{
		$sql .= " LIMIT $start, $max_limit";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain topics information', '', __LINE__, __FILE__, $sql);
		}
	}

	// read the items
	while ($row = $db->sql_fetchrow($result))
	{
		// prepare the message
		$topic_author_id			= $row['poster_id'];
		$topic_author 				= ($row['poster_id'] == ANONYMOUS) ? $row['post_username'] : $row['username'];
		$topic_time					= $row['topic_time'];

		$topic_last_author_id		= $row['lp_poster_id'];
		$topic_last_author			= ($row['lp_poster_id'] == ANONYMOUS) ? $row['lp_post_username'] : $row['lp_username'];
		$topic_last_time			= $row['lp_post_time'];
		
		$topic_views				= $row['topic_views'];
		$topic_replies				= $row['topic_replies'];

		$topic_icon					= $row['topic_icon'];
		$topic_title 				= $row['topic_title'];
		$message					= $row['post_text'];
		$bbcode_uid					= $row['bbcode_uid'];
		$topic_calendar_time		= $row['topic_calendar_time'];
		$topic_calendar_duration	= $row['topic_calendar_duration'];
		$topic_link					= append_sid($phpbb_root_path . "./viewtopic.$phpEx?" . POST_TOPIC_URL . "=" . $row['topic_id']);

		// censor topic_title
		if ( count($orig_word) )
		{
			$topic_title = preg_replace($orig_word, $replacement_word, $topic_title);
			$message = str_replace('\"', '"', substr(preg_replace_callback('#(\>(((?>([^><]+|(?R)))*)\<))#s',function ($matches) use ($orig_word, $replacement_word) {
				return preg_replace($orig_word, $replacement_word, $matches[0]);
			}, '>' . $message . '<'), 1, -1));
		}
		$short_title = (strlen($topic_title) > $topic_title_length + 3) ? substr($topic_title, 0, $topic_title_length) . '...' : $topic_title;
		$dsp_topic_icon = '';
		if (function_exists(get_icon_title))
		{
			$dsp_topic_icon = get_icon_title($topic_icon, 0, POST_CALENDAR);
		}

		// parse the message
		$message = substr($message, 0, $topic_text_length);

		// remove HTML if not allowed
		if ( !$board_config['allow_html'] && $row['enable_html'] )
		{
			$message = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $message);
		}
		// Parse bbcodes
		if ( $board_config['allow_bbcode'] && ($bbcode_uid != '') )
		{
			$message = ( $board_config['allow_bbcode'] ) ? bbencode_second_pass($message, $bbcode_uid) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $message);
		}
		// Parse smilies
		if ( $board_config['allow_smilies'] )
		{
			$message = smilies_pass($message);
		}

		// get the date format
		$fmt = $lang['DATE_FORMAT'];
		if (!empty($topic_calendar_duration))
		{
			$fmt = $board_config['default_dateformat'];
		}

		// replace \n with <br />
		$message = preg_replace("/[\n\r]{1,2}/", '<br />', $message);

		// build the overview
		$sav_tpl = $template->_tpldata;
		$det_handler = '_overview_topic_' . $row['topic_id'];
		$template->set_filenames(array(
			$det_handler => 'calendar_overview_topic.tpl')
		);

		$nav_desc = '';
		if ($cat_hierarchy)
		{
			$nav_desc = make_cat_nav_tree(POST_FORUM_URL . $row['forum_id'], '', 'gensmall');
		}
		else
		{
			$nav_desc = '<a href="' . append_sid($phpbb_root_path . "./viewforum.$phpEx?" . POST_FORUM_URL . '=' . $row['forum_id']) . '" class="gensmall">' . $row['forum_name'] . '</a>';
		}
		$template->assign_vars(array(
			'L_CALENDAR_EVENT'	=> $lang['Calendar_event'],
			'L_AUTHOR'			=> $lang['Author'],
			'L_TOPIC_DATE'		=> $lang['Date'],
			'L_FORUM'			=> $lang['Forum'],
			'L_VIEWS'			=> $lang['Views'],
			'L_REPLIES'			=> $lang['Replies'],
			'TOPIC_TITLE'		=> $dsp_topic_icon . '&nbsp;' . smilies_pass($topic_title),
			'CALENDAR_EVENT'	=> get_calendar_title_date($topic_calendar_time, $topic_calendar_duration),
			'AUTHOR'			=> $topic_author,
			'TOPIC_DATE'		=> create_date($userdata['user_dateformat'], $topic_time, $board_config['board_timezone']),
			'NAV_DESC'			=> $nav_desc,
			'MESSAGE'			=> $message,
			'VIEWS'				=> $topic_views,
			'REPLIES'			=> $topic_replies,
			)
		);

		$template->assign_var_from_handle('_calendar_overview', $det_handler);
		$message = $template->_tpldata['.'][0]['_calendar_overview'];
		$template->_tpldata = $sav_tpl;

		// remove \n remaining from the template
		$message = preg_replace("/[\n\r]{1,2}/", '', $message);

		// store only the new values
		$new_row = array();
		$new_row['event_id']				= POST_TOPIC_URL . $row['topic_id'];

		$new_row['event_author_id']			= $topic_author_id;
		$new_row['event_author']			= $topic_author;
		$new_row['event_time']				= $topic_time;
		
		$new_row['event_last_author_id']	= $topic_last_author_id;
		$new_row['event_last_author']		= $topic_last_author;
		$new_row['event_last_time']			= $topic_last_time;

		$new_row['event_replies']			= $topic_replies;
		$new_row['event_views']				= $topic_views;
		$new_row['event_type']				= $row['topic_type'];
		$new_row['event_vote']				= $row['topic_vote'];
		$new_row['event_status']			= $row['topic_status'];
		$new_row['event_moved_id']			= $row['topic_moved_id'];
		$new_row['event_last_id']			= $row['topic_last_post_id'];
		$new_row['event_forum_id']			= $row['forum_id'];
		$new_row['event_forum_name']		= $row['forum_name'];

		$new_row['event_icon']				= $topic_icon;
		$new_row['event_title']				= smilies_pass($topic_title);
		$new_row['event_short_title']		= smilies_pass($short_title);
		$new_row['event_message']			= $message;
		$new_row['event_calendar_time']		= $topic_calendar_time;
		$new_row['event_calendar_duration']	= $topic_calendar_duration;
		$new_row['event_link']				= $topic_link;
		$new_row['event_txt_class']			= 'genmed';
		$new_row['event_type_icon']			= '<img src="' . $images['icon_tiny_topic'] . '" border="0" align="middle" hspace="2" />';
		
		$events[] = $new_row;
	}
}

//
// birthday (only with PCP)
//
function get_event_PCP_birthday(&$events, &$number, $start_date, $end_date, $limit=false, $start=0, $max_limit=-1)
{
	global $template, $lang, $images, $userdata, $board_config, $db, $phpbb_root_path, $phpEx;
	global $tree;
	global $agcm_color;

	// init results
	$number = 0;
	if ($max_limit < 0)
	{
		$max_limit = $board_config['topics_per_page'];
	}

	// add birthday events (only with Profile Control Panel) for logged people eyes
	if ($board_config['calendar_birthday'] && isset($lang['Happy_birthday']) && isset($userdata['user_birthday']) && ($userdata['user_id'] != ANONYMOUS))
	{
		// get start month
		$sql_where = '';
		$work_date = $start_date;
		while ( intval(date('Ym', $work_date)) <= intval(date('Ym', $end_date)) )
		{
			$start_month = date('md', $work_date );
			$end_month = date('m', $work_date) . '99';
			if ( intval(date('Ym', $work_date)) == intval(date('Ym', $end_date)) )
			{
				$end_month = date('md', $end_date);
			}
			$sql_where .= !empty($sql_where) ? ' OR' : '';
			$sql_where .= " ( RIGHT(u.user_birthday, 4) >= $start_month AND RIGHT(u.user_birthday, 4) < $end_month )";

			// go to next month
			$work_year = intval(date('Y', $work_date));
			$work_month = intval(date('m', $work_date));
			$work_month++;
			if ($work_month > 12)
			{
				$work_month = 1;
				$work_year++;
			}
			$work_date = mktime( 0,0,0, $work_month, 01, $work_year );
		}

		// select now profiles
		if (!empty($sql_where))
		{
			$user_id = $userdata['user_id'];
			$sql = "SELECT u.*, 
							(CASE WHEN b.buddy_ignore = 0 THEN 1 ELSE 0 END) as user_friend,
							i.buddy_ignore AS user_ignore,
							b.buddy_visible AS user_visible
						FROM ((" . USERS_TABLE . " AS u 
						LEFT JOIN " . BUDDYS_TABLE . " AS b	ON b.user_id=u.user_id AND b.buddy_id=$user_id)
						LEFT JOIN " . BUDDYS_TABLE . " AS i ON i.user_id=$user_id AND i.buddy_id=u.user_id)
						WHERE u.user_id <> " . ANONYMOUS . " 
							AND u.user_birthday <> 0 
							AND u.user_birthday <> '' 
							AND ( $sql_where )
						ORDER BY username";
			if ( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not read user table to get birthday today info', '', __LINE__, __FILE__, $sql);
			}

			// get the number of occurences
			$number = $db->sql_numrows($result);

			// if limit per page asked, limit the number of results
			if ($limit)
			{
				$sql .= " LIMIT $start, $max_limit";
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Could not obtain topics information', '', __LINE__, __FILE__, $sql);
				}
			}

			// read users
			while ($row = $db->sql_fetchrow($result))
			{
				// user info
				$user_id		= $row['user_id'];
				$username		= $agcm_color->get_user_color($row['user_group_id'], $row['user_session_time'], $row['username']);
				$user_birthday	= $row['user_birthday'];

				// get user relational status
				$ignore			= $row['user_ignore'];
				$friend			= $row['user_friend'];
				$always_visible = $row['user_visible'];

				// get the status of each info
				$real_display	= ( !$ignore && $userdata['user_allow_real'] && $row['user_allow_real'] && ( ($row['user_viewreal'] == YES) || ( ($row['user_viewreal'] == FRIEND_ONLY) && $friend ) ) );

				// take care of admin status
				if ( is_admin($userdata) || ($user_id == $userdata['user_id']) )
				{
					$real_display = true;
				}

				if ($real_display)
				{
					$txt_class = get_user_level_class($row['user_level'], 'genmed', $row);
					if ($row['user_allow_viewonline'] != YES)
					{
						$username = '<i>' . $username . '</i>';
					}
					$username_link = append_sid($phpbb_root_path . "./profile.$phpEx?mode=viewprofile&" . POST_USERS_URL . "=$user_id");

					$event_month	= intval(substr($user_birthday, 4, 2));
					$event_day		= intval(substr($user_birthday, 6, 2));
					$start_month	= intval(date('m', $start_date));
					$event_year		= intval(date('Y', $start_date));
					if ($event_month < $start_month) $event_year++;
					$event_time = mktime( 0,0,0, $event_month, $event_day, $event_year );

					// build the overview
					$sav_tpl = $template->_tpldata;
					$det_handler = '_overview_profil_' . $user_id;
					$template->set_filenames(array(
						$det_handler => 'calendar_overview_profil.tpl')
					);

					$age = $event_year - intval(substr($user_birthday, 0, 4));
					if ( intval(substr($user_birthday, 4, 4)) > intval(date('md', $event_time)) ) $age--;
					if ($age <= 0) $age = '';

					// avatar
					$avatar_display = ( $userdata['user_viewavatar'] && $row['user_allowavatar'] );
					if ( is_admin($userdata)|| ($view_user_id == $user_id) )
					{
						$avatar_display = true;
					}
					$avatar = '';
					if ( $avatar_display && $row['user_avatar_type'] )
					{
						switch( $row['user_avatar_type'] )
						{
							case USER_AVATAR_UPLOAD:
								$avatar = ( $board_config['allow_avatar_upload'] ) ? '<img src="' . $board_config['avatar_path'] . '/' . $row['user_avatar'] . '" alt="" border="0" />' : '';
								break;
							case USER_AVATAR_REMOTE:
								$avatar = ( $board_config['allow_avatar_remote'] ) ? '<img src="' . $row['user_avatar'] . '" alt="" border="0" />' : '';
								break;
							case USER_AVATAR_GALLERY:
								$avatar = ( $board_config['allow_avatar_local'] ) ? '<img src="' . $board_config['avatar_gallery_path'] . '/' . $row['user_avatar'] . '" alt="" border="0" />' : '';
								break;
						}
					}

					$template->assign_vars(array(
						'L_TITLE'		=> $lang['Happy_birthday'],
						'L_USERNAME2'	=> $username,
						'TXT_CLASS'		=> $txt_class,
						'L_AGE'			=> $lang['Age'],
						'AVATAR'		=> $avatar,
						'AGE'			=> $age,
						)
					);

					$template->assign_var_from_handle('_calendar_overview', $det_handler);
					$message = $template->_tpldata['.'][0]['_calendar_overview'];
					$template->_tpldata = $sav_tpl;

					// remove \n remaining from the template
					$message = preg_replace("/[\n\r]{1,2}/", '', $message);

					// store only the new values
					$new_row = array();
					$new_row['event_id']				= POST_USERS_URL . $user_id;

					$new_row['event_author_id']			= $user_id;
					$new_row['event_author']			= $username;
					$new_row['event_time']				= $event_time;

					$new_row['event_last_author_id']	= '';
					$new_row['event_last_author']		= '';
					$new_row['event_last_time']			= '';

					$new_row['event_replies']			= '';
					$new_row['event_views']				= '';
					$new_row['event_type']				= POST_BIRTHDAY;
					$new_row['event_vote']				= '';
					$new_row['event_status']			= '';
					$new_row['event_moved_id']			= '';
					$new_row['event_last_id']			= '';
					$new_row['event_forum_id']			= '';
					$new_row['event_forum_name']		= '';

					$new_row['event_icon']				= '';
					$new_row['event_title']				= $username;
					$new_row['event_short_title']		= $username;
					$new_row['event_message']			= $message;
					$new_row['event_calendar_time']		= $event_time;
					$new_row['event_calendar_duration']	= '';
					$new_row['event_link']				= $username_link;
					$new_row['event_txt_class']			= $txt_class;
					$new_row['event_type_icon']			= '<img src="' . $images['icon_tiny_profile'] . '" border="0" align="absbottom" hspace="2" />';

					$events[] = $new_row;
				}
			}
		}
	}
}

///////////////////////////////////////////////////////
// Recurring events
// 
///////////////////////////////////////////////////////
function get_recurring_events(&$events, &$number, $start_date, $end_date, $limit=false, $start=0, $max_limit=-1, $fid='', $sched=false)
{
	global $template, $lang, $images, $userdata, $board_config, $db, $phpbb_root_path, $phpEx;
	global $tree;

	// Define censored word matches
	$orig_word = array();
	$replacement_word = array();
	obtain_word_list($orig_word, $replacement_word);

	// get some parameter
	$topic_title_length = isset($board_config['calendar_title_length']) ? intval($board_config['calendar_title_length']) : 30;
	$topic_text_length = isset($board_config['calendar_text_length']) ? intval($board_config['calendar_text_length']) : 200;
	if ($max_limit < 0)
	{
		$max_limit = $board_config['topics_per_page'];
	}

	// get the forums authorized (compliency with categories hierarchy v2 mod)
	$cat_hierarchy = function_exists('get_auth_keys');
	$s_forums_ids = '';
	if (!$cat_hierarchy)
	{
		// standard read
		$is_auth = array();
		$is_auth = auth(AUTH_ALL, AUTH_LIST_ALL, $userdata);

		// forum or cat asked
		$is_ask = array();
		if ( ($fid == 'Root') || ($fid == POST_CAT_URL . 0) ) $fid = '';
		if (!empty($fid))
		{
			$type = substr($fid, 0, 1);
			$id = intval(substr($fid, 1));
			if ($type == POST_CAT_URL)
			{
				$sql = "SELECT forum_id FROM " . FORUMS_TABLE . " WHERE cat_id=$id";
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Could not obtain forums informations', '', __LINE__, __FILE__, $sql);
				}
				while ($row = $db->sql_fetchrow($result))
				{
					$is_ask[$row['forum_id']] = true;
				}
			}
			else if ($type == POST_FORUM_URL)
			{
				$is_ask[$id] = true;
			}
			else return;
		}

		// get the list of authorized forums
		while (list($forum_id, $forum_auth) = each($is_auth))
		{
			if ( $forum_auth['auth_read'] && (empty($fid) || isset($is_ask[$forum_id])) )
			{
				$s_forum_ids .= (empty($s_forum_ids) ? '' : ', ') . $forum_id;
			}
		}
	}
	else
	{
		if ( empty($fid) || ($fid == POST_CAT_URL . 0) ) $fid = 'Root';

		// get auth key
		$keys = array();
		$keys = get_auth_keys($fid, true, -1, -1, 'auth_read');
		for ($i=0; $i < count($keys['id']); $i++)
		{
			if ( ($tree['type'][$keys['idx'][$i]] == POST_FORUM_URL) && $tree['auth'][ $keys['id'][$i] ]['auth_read'] )
			{
				$s_forum_ids .= (empty($s_forum_ids) ? '' : ', ') . $tree['id'][$keys['idx'][$i]];
			}
		}
	}

	// no forums authed, return
	if (empty($s_forum_ids)) return;

	// select topics
	$sql_forums_field = '';
	$sql_forums_file = '';
	$sql_forums_match = '';
	if (!$cat_hierarchy)
	{
		$sql_forums_field = ', f.forum_name';
		$sql_forums_file = ', ' . FORUMS_TABLE . ' AS f';
		$sql_forums_match = ' AND f.forum_id = t.forum_id';
	}

	$sql = "SELECT 
					t.*,
					p.poster_id, p.post_username, p.enable_bbcode, p.enable_html, p.enable_smilies,
					u.username,
					pt.post_text, pt.bbcode_uid,
					lp.poster_id AS lp_poster_id,
					lu.username AS lp_username,
					lp.post_username AS lp_post_username,
					lp.post_time AS lp_post_time
					$sql_forums_field
			FROM " . TOPICS_TABLE . " AS t, " . POSTS_TABLE . " AS p, " . POSTS_TEXT_TABLE . " AS pt, " . USERS_TABLE . " AS u, " . POSTS_TABLE . " AS lp, " . USERS_TABLE . " lu $sql_forums_file
			WHERE 
					t.forum_id IN ($s_forum_ids)
				AND p.post_id	= t.topic_first_post_id
				AND pt.post_id	= t.topic_first_post_id
				AND u.user_id	= p.poster_id
				AND lp.post_id	= t.topic_last_post_id
				AND lu.user_id	= lp.poster_id
				AND t.topic_calendar_repeat != '    ' 
				AND t.topic_status <> " . TOPIC_MOVED . "
				$sql_forums_match
			ORDER BY
				t.topic_calendar_time, t.topic_calendar_duration DESC, t.topic_last_post_id DESC";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain topics information', '', __LINE__, __FILE__, $sql);
	}

	// get the number of occurences
	$number = $db->sql_numrows($result);

	// if limit per page asked, limit the number of results
	if ($limit)
	{
		$sql .= " LIMIT $start, $max_limit";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain topics information', '', __LINE__, __FILE__, $sql);
		}
	}

	// read the items
	while ($row = $db->sql_fetchrow($result))
	{
		// prepare the message
		$topic_author_id			= $row['poster_id'];
		$topic_author 				= ($row['poster_id'] == ANONYMOUS) ? $row['post_username'] : $row['username'];
		$topic_time					= $row['topic_time'];

		$topic_last_author_id		= $row['lp_poster_id'];
		$topic_last_author			= ($row['lp_poster_id'] == ANONYMOUS) ? $row['lp_post_username'] : $row['lp_username'];
		$topic_last_time			= $row['lp_post_time'];
		
		$topic_views				= $row['topic_views'];
		$topic_replies				= $row['topic_replies'];

		$topic_icon					= $row['topic_icon'];
		$topic_title 				= $row['topic_title'];
		$message					= $row['post_text'];
		$bbcode_uid					= $row['bbcode_uid'];
		$topic_calendar_time		= $row['topic_calendar_time'];
		$topic_calendar_duration	= $row['topic_calendar_duration'];
		$topic_link					= append_sid($phpbb_root_path . "./viewtopic.$phpEx?" . POST_TOPIC_URL . "=" . $row['topic_id']);
 
 		// censor topic_title
		if ( count($orig_word) )
		{
			$topic_title = preg_replace($orig_word, $replacement_word, $topic_title);
			$message = str_replace('\"', '"', substr(preg_replace_callback('#(\>(((?>([^><]+|(?R)))*)\<))#s',function ($matches) use ($orig_word, $replacement_word) {
				return preg_replace($orig_word, $replacement_word, $matches[0]);
			}, '>' . $message . '<'), 1, -1));
		}
		$short_title = (strlen($topic_title) > $topic_title_length + 3) ? substr($topic_title, 0, $topic_title_length) . '...' : $topic_title;
		$dsp_topic_icon = '';
		if (function_exists(get_icon_title))
		{
			$dsp_topic_icon = get_icon_title($topic_icon, 0, POST_CALENDAR);
		}

		// parse the message
		if( strlen( $message ) > $topic_text_length ){
		$message = substr($message, 0, $topic_text_length);
		for ($i = $topic_text_length-1; $i>0; $i--){
			if( substr( $message, $i, 1 ) == " ") {
				$message = substr( $message, 0, $i );
				$message .= '<div align=right><span class=genmed><i>More...</i></span>';
				break;
				}
			}
		}

		// remove HTML if not allowed
		if ( !$board_config['allow_html'] && $row['enable_html'] )
		{
			$message = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $message);
		}
		// Parse bbcodes
		if ( $board_config['allow_bbcode'] && ($bbcode_uid != '') )
		{
			$message = ( $board_config['allow_bbcode'] ) ? bbencode_second_pass($message, $bbcode_uid) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $message);
		}
		// Parse smilies
		if ( $board_config['allow_smilies'] )
		{
			$message = smilies_pass($message);
		}

		// get the date format
		$fmt = $lang['DATE_FORMAT'];
		if (!empty($topic_calendar_duration))
		{
			$fmt = $board_config['default_dateformat'];
		}

		$topic_calendar_time = $row['topic_calendar_time'];
		$topic_calendar_repeat = $row['topic_calendar_repeat'];
		$repeat_type = substr( $topic_calendar_repeat, 0, 2 );
		$event_time='';

		if( $start_date < $topic_calendar_time ) {
			$work_date 		= $topic_calendar_time;
		} else {
			$work_date 		= $start_date;
		}

		$temp_end_date = ($row['topic_calendar_duration']==0) ? $end_date : $row['topic_calendar_time'] + $row['topic_calendar_duration'];

		while ($work_date <= $temp_end_date)
		{
		// getting ready ...
			$message1 = $message;
			$event_time='';
			$event_year	= intval(date('Y', $work_date));
			$event_month = intval(date('m', $work_date));
			$event_day = intval(date('d', $work_date));
			$event_hour = intval( date('H', $topic_calendar_time) );
			$event_min	= intval( date('i', $topic_calendar_time) );
				
			$valid_repeat_type=FALSE;
			switch( $repeat_type )
			{
				case 'DD':
			//	DAILY events
				$valid_repeat_type = TRUE;
				$tmp =  mktime( 0,0,0, $event_month, $event_day, $event_year ) - mktime( 0,0,0, intval(date('m', $topic_calendar_time)), intval(date('d', $topic_calendar_time)), intval(date('Y', $topic_calendar_time)) ) ;
       			$tmp = floor($tmp/60/60/24);
				$tmp = $tmp / intval(substr($topic_calendar_repeat,2,2));		
	
				if(intval($tmp)!= $tmp) {
					$work_date = mktime( $event_hour, $event_min, 0, $event_month, $event_day+1, $event_year );	
						break;
					}

				$event_time = mktime( $event_hour, $event_min, 0, $event_month, $event_day, $event_year );	
				$calendar_event = "Every ".intval(substr($topic_calendar_repeat,2,2)). " day(s)";
				if( date( 'g:ia', $event_time ) != '12:00am' ) $calendar_event .= ", at ".date( 'g:ia', $event_time );
// move on
				$work_date = mktime( $event_hour, $event_min, 0, $event_month , $event_day + intval(substr($topic_calendar_repeat,2,2)), $event_year );	
				break;

				case 'MY':
			// same daY every nn months
			// in this case the work_date has to be on the first of the current month
				$valid_repeat_type = TRUE;
				$work_date = mktime( $event_hour, $event_min, 0, $event_month, 1, $event_year );
				$event_day = intval(date('d', $topic_calendar_time));
				$tmp = (intval(date('m', $work_date))-intval(date('m', $topic_calendar_time)))/intval(substr($topic_calendar_repeat,2,2));

				if(intval($tmp)!= $tmp) {
					// move 1 month up and try again (calendar box ...)
					$work_date = mktime( $event_hour, $event_min, 0, $event_month+1, 1, $event_year );	
						break;
					}

				$tmp = (intval(date('d', $topic_calendar_time )/7)+1)*7+1;
				if( intval(date('w', $work_date )) <= intval(date('w', $topic_calendar_time)) ) { $tmp = $tmp-7; } 
				$event_day = $tmp + intval(date('w', $topic_calendar_time)) - intval(date('w', $work_date ));
				$event_time = mktime( $event_hour, $event_min, 0, $event_month, $event_day, $event_year );	
				
				if ($event_time < $start_date ){
					//try 1 month later (calendar box ...)
					$event_time = '';
					$work_date = mktime( $event_hour, $event_min, 0, $event_month+1, $event_day, $event_year );	
					break;
				}

				$weekday = date('l', $topic_calendar_time );
				$calendar_event = "Every ".(intval(date('d', $topic_calendar_time )/7)+1);
				if ( (intval(date('d', $topic_calendar_time )/7)+1) == 1 ) { $sub='st';}
				if ( (intval(date('d', $topic_calendar_time )/7)+1) == 2 ) { $sub='nd';}
				if ( (intval(date('d', $topic_calendar_time )/7)+1) == 3 ) { $sub='rd';}
				if ( (intval(date('d', $topic_calendar_time )/7)+1) == 4 ) { $sub='th';}
	
				$calendar_event .= $sub;
				$calendar_event .= " ". $weekday ." of each ";
				if (intval(substr($topic_calendar_repeat,2,2)) != 1 ) {	
				$calendar_event .= intval(substr($topic_calendar_repeat,2,2));
				}
				$calendar_event .= " month"; 
				if( date( 'g:ia', $event_time ) != '12:00am' ) $calendar_event .= ", at ".date( 'g:ia', $event_time );

// move on
				$work_date = mktime( $event_hour, $event_min, 0, $event_month + intval(substr($topic_calendar_repeat,2,2)), $event_day, $event_year );	
				break;

				case 'MT':
			// same daTe every nn months
				$valid_repeat_type = TRUE;
				$tmp = (intval(date('n', $work_date))-intval(date('n', $topic_calendar_time)))/intval(substr($topic_calendar_repeat,2,2));

				if(intval($tmp)!= $tmp) {
					// move 1 month up and try again (calendar box ...)
					$work_date = mktime( $event_hour, $event_min, 0, $event_month+1, 1, $event_year );	
						break;
					}

				$event_day 		= intval(date('d', $topic_calendar_time ));
				$event_time = mktime( $event_hour, $event_min, 0, $event_month, $event_day, $event_year );	

				if ($event_time < $start_date ){
					//try 1 month later ...
					$event_time = '';
					$work_date = mktime( $event_hour, $event_min, 0, $event_month+1, $event_day, $event_year );	
					break;
					}
					
				$calendar_event = "Every " .intval(date('d', $topic_calendar_time )); 
				if ( intval(date('d', $topic_calendar_time )) == 1 ) { $sub='st';}
				if ( intval(date('d', $topic_calendar_time )) == 2 ) { $sub='nd';}
				if ( intval(date('d', $topic_calendar_time )) == 3 ) { $sub='rd';}
				if ( intval(date('d', $topic_calendar_time )) > 3 ) { $sub='th';}
				$calendar_event .= $sub;
				$calendar_event .= " day of each ";	
				if (intval(substr($topic_calendar_repeat,2,2)) != 1 ) {	
					$calendar_event .= intval(substr($topic_calendar_repeat,2,2));
					}
				$calendar_event .= " month"; 
				if( date( 'g:ia', $event_time ) != '12:00am' ) $calendar_event .= ", at ".date( 'g:ia', $event_time );

// move on
				$work_date = mktime( $event_hour, $event_min, 0, $event_month + intval(substr($topic_calendar_repeat,2,2)), $event_day, $event_year );	
				
				break;

				case 'YY':
			// same day in the year every nn years
			//	checking whether this is the right year
				$valid_repeat_type = TRUE;
				$tmp= (intval(date('Y', $work_date))-intval(date('Y', $topic_calendar_time)))/intval(substr($topic_calendar_repeat,2,2));
				if(intval($tmp)!= $tmp) {
				// move 1 year up and try again (calendar box ...)
					$work_date = mktime( $event_hour, $event_min, 0, $event_month, 1, $event_year+1 );	
					break;
					}

				$event_year		= intval(date('Y', $work_date));
				$event_month 	= intval(date('m', $work_date));
				$event_day 		= intval(date('d', $topic_calendar_time ));
				
			// correct month:
				if ( intval(date('m', $work_date)) != intval(date('m', $topic_calendar_time ))) {
					$work_date = mktime( $event_hour, $event_min, 0, $event_month + 1, $event_day, $event_year );	
					break;
				}
		

				$event_time = mktime( $event_hour, $event_min, 0, $event_month, $event_day, $event_year );	

				if ($event_time < $start_date ){
					//try 1 year later ...
					$event_time = '';
					$work_date = mktime( $event_hour, $event_min, 0, $event_month, $event_day, $event_year+1 );	
					break;
					}

				$calendar_event = "Every ". date( 'd M' , $event_time ) .", each ";
				if (intval(substr($topic_calendar_repeat,2,2)) != 1 ) $calendar_event .= intval(substr($topic_calendar_repeat,2,2));
				$calendar_event .= " year"; 
				if( date( 'g:ia', $event_time ) != '12:00am' ) $calendar_event .= ", at ".date( 'g:ia', $event_time );

// replace {yyyy} with the actual number of years between now and yyyy
				$search = eregi("{(.*)}", $message1, $message2);
				$repl = intval($event_year) - intval($message2[1]);
				$message1 = str_replace( "{".$message2[1]."}", $repl , $message1);

// move on
				$work_date = mktime( $event_hour, $event_min, 0, $event_month, $event_day, $event_year + intval(substr($topic_calendar_repeat,2,2)) );	
				break;
				
				case 'WW':
				$valid_repeat_type = TRUE;
				$repeat_type = 'DD';
				$tmp = intval(substr($topic_calendar_repeat,2,2))*7;
				$topic_calendar_repeat = 'DD'.substr('00'.$tmp,-2);
				break;
				
				default:
				$work_date = mktime( $event_hour, $event_min, 0, $event_month, $event_day, $event_year + 1 );	
				break;
				
			}

//------------------------------------- END OF REPEAT TYPES			
//  BUILDING OF THE EVENT:

			if ($event_time!='')
			{

		// replace \n with <br />
				$message1 = preg_replace("/[\n\r]{1,2}/", '<br />', $message1);

		// build the overview
				$sav_tpl = $template->_tpldata;
				$det_handler = '_overview_repeat_' . $user_id;

				$template->set_filenames(array(
					$det_handler => 'calendar_overview_repeat.tpl')
					);

					
				$nav_desc = '';
				if ($cat_hierarchy)
				{
					$nav_desc = make_cat_nav_tree(POST_FORUM_URL . $row['forum_id'], '', 'gensmall');
				}
					else
				{
					$nav_desc = '<a href="' . append_sid($phpbb_root_path . "./viewforum.$phpEx?" . POST_FORUM_URL . '=' . $row['forum_id']) . '" class="gensmall">' . $row['forum_name'] . '</a>';
				}

				$template->assign_vars(array(
					'EVENT_TITLE'		=> $topic_title,
					'L_CALENDAR_EVENT'	=> $lang['Calendar_event'],
					'RPT'				=> $lang['Repeat_mode'],
					'L_AUTHOR'			=> $lang['Author'],
					'L_FORUM'			=> $lang['Forum'],
					'L_VIEWS'			=> $lang['Views'],
					'L_REPLIES'			=> $lang['Replies'],
					'CALENDAR_EVENT'	=> get_calendar_title_date($topic_calendar_time, $topic_calendar_duration) . ' [ ' . $calendar_event . ' ]',
					'AUTHOR'			=> $topic_author,
					'VIEWS'				=> $topic_views,
					'REPLIES'			=> $topic_replies,
					'NAV_DESC'			=> $nav_desc,
					'MESSAGE'			=> $message1,
					)
				);

				$template->assign_var_from_handle('_calendar_overview', $det_handler);
				$message1 = $template->_tpldata['.'][0]['_calendar_overview'];
				$template->_tpldata = $sav_tpl;

			// remove \n remaining from the template
				$message1 = preg_replace("/[\n\r]{1,2}/", '', $message1);

			// store only the new values
				$new_row = array();
				$new_row['event_id']				= POST_TOPIC_URL . $row['topic_id'];
				$new_row['event_author_id']			= $topic_author_id;
				$new_row['event_author']			= $topic_author;
				$new_row['event_time']				= $event_time;
				$new_row['event_last_author_id']	= $topic_last_author_id;
				$new_row['event_last_author']		= $topic_last_author;
				$new_row['event_last_time']			= $topic_last_time;

				$new_row['event_replies']			= $topic_replies;
				$new_row['event_views']				= $topic_views;
				$new_row['event_type']				= $row['topic_type'];
				$new_row['event_vote']				= $row['topic_vote'];
				$new_row['event_status']			= $row['topic_status'];
				$new_row['event_moved_id']			= $row['topic_moved_id'];
				$new_row['event_last_id']			= $row['topic_last_post_id'];
				$new_row['event_forum_id']			= $row['forum_id'];
				$new_row['event_forum_name']		= $row['forum_name'];
				$new_row['event_icon']				= $topic_icon;
				$new_row['event_title']				= smilies_pass($topic_title);
				$new_row['event_short_title']		= smilies_pass($short_title);
				$new_row['event_calendar_duration']	= ($valid_repeat_type) ? 0 : $topic_calendar_duration;
				$new_row['event_calendar_repeat']	= $topic_calendar_repeat;
				$new_row['event_link']				= $topic_link;	
				$new_row['event_txt_class']			= 'genmed';
				$new_row['event_message']			= $message1;
				$new_row['event_calendar_time']		= $event_time;
				$new_row['event_type_icon']			= '<img src="' . $images['icon_tiny_repeat'] . '" border="0" align="absbottom" hspace="2" />';

				$events[] = $new_row;
				
			}
		}
	}
}

// end recurring events 

function display_calendar($main_template, $nb_days=0, $start=0, $fid='')
{
	global $template, $lang, $images, $userdata, $board_config, $db, $phpbb_root_path, $phpEx;
	global $tree;
	static $handler;
	if (empty($handler))
	{
		$handler = 1;
	}
	else
	{
		$handler++;
	}

	$day_of_week = array(
			$lang['datetime']['Sunday'],
			$lang['datetime']['Monday'],
			$lang['datetime']['Tuesday'],
			$lang['datetime']['Wednesday'],
			$lang['datetime']['Thursday'],
			$lang['datetime']['Friday'],
			$lang['datetime']['Saturday'],
		);
	$months = array( 
			' ------------ ',
			$lang['datetime']['January'], 
			$lang['datetime']['February'], 
			$lang['datetime']['March'],
			$lang['datetime']['April'],
			$lang['datetime']['May'],
			$lang['datetime']['June'],
			$lang['datetime']['July'],
			$lang['datetime']['August'],
			$lang['datetime']['September'],
			$lang['datetime']['October'],
			$lang['datetime']['November'],
			$lang['datetime']['December'],
		);

	// get some parameter
	$first_day_of_week = isset($board_config['board_fdow']) ? intval($board_config['board_fdow']) : 1;
	$nb_row_per_cell = isset($board_config['calendar_nb_row']) ? intval($board_config['calendar_nb_row']) : 5;

	// get the start date - calendar doesn't go before 1971
	$cur_date = (empty($start) || (intval(date('Y', $start)) < 1971) ) ? cal_date(time(),$board_config['board_timezone']) : $start;
	$cur_date = mktime( 0,0,0, intval(date('m', $cur_date)), intval(date('d', $cur_date)), intval(date('Y', $cur_date)) );

	// the full month is displayed
	if (empty($nb_days))
	{
		// set indicator
		$full_month = true;

		// set the start day on the start of the month
		$start_date = mktime( 0,0,0, intval(date('m', $cur_date)), 01, intval(date('Y', $cur_date)) );

		// get the day number set as start of the display
		$cfg_week_day_start = $first_day_of_week;

		// get the number of blank cells
		$start_inc = intval(date('w', $start_date )) - $cfg_week_day_start;
		if ($start_inc < 0)
		{
			$start_inc = 7 + $start_inc;
		}

		//  get the end date
		$year = intval(date('Y', $start_date));
		$month = intval(date('m', $start_date))+1;
		if ($month > 12)
		{
			$year++;
			$month = 1;
		}
		$end_date = mktime( 0,0,0, $month, 01, $year);

		// set the number of cells per line
		$nb_cells = 7;

		// get the number of rows
		$nb_rows = intval( ($start_inc + intval(($end_date - $start_date) / 86400)) / $nb_cells ) + 1;
	}
	else
	{
		// set indicator
		$full_month = false;

		// set the start date to the day before the date selected
		$start_date = mktime( 0,0,0, date('m', $cur_date), date('d', $cur_date)-1, date('Y', $cur_date));

		// get the day number set as start of the week
		$cfg_week_day_start = intval(date('w', $start_date));

		// get the numbe of blank cells
		$start_inc = 0;

		// get the end date
		$end_date = mktime( 0,0,0, date('m', $start_date), date('d', $start_date) + $nb_days, date('Y', $start_date));

		// set the number of cells per line
		$nb_cells = $nb_days;

		// set the number of rows
		$nb_rows = 1;
	}

	//
	// Ok, let's get the various events :)
	//
	$events = array();
	$number = 0;
	/* correct the start date... 
	 * user selected start, so transfer user 2 board time...
	 * before fetching events etc from the db... */
	user2boardtime($start_date);
	user2boardtime($end_date);
	// topics
	get_event_topics($events, $number, $start_date, $end_date, false, 0, -1, $fid);

	// recurring events
	get_recurring_events($events, $number, $start_date, $end_date);

	// birthday
	get_event_PCP_birthday($events, $number, $start_date, $end_date);

	/* reset the start date... */
	board2usertime($start_date);
	board2usertime($end_date);
	
	//
	// And now display them
	//

	// build a list per date
	$map = array();
	for ($i=0; $i < count($events); $i++)
	{
		$event_time = $events[$i]['event_calendar_time'];
		board2usertime($event_time);
		// adjust the event period to the start of day
		$event_time_end = $event_time + $events[$i]['event_calendar_duration'];
		$event_end = mktime( 0,0,0, intval(date('m', $event_time_end)), intval(date('d', $event_time_end)), intval(date('Y', $event_time_end)) );
		$event_start = mktime( 0,0,0, intval(date('m', $event_time)), intval(date('d', $event_time)), intval(date('Y', $event_time)) );

		if ($event_start < $start_date)
		{
			$event_start = $start_date;
		}
		if ($event_end > $end_date)
		{
			$event_end = $end_date;
		}

		// search a free day map offset in the start day
		$event_id = $events[$i]['event_id'];
		$offset_date = $event_start;
		$map_offset = count($map[$event_start]);
		$found = false;
		for ($k=0; ($k < count($map[$event_start])) && !$found; $k++)
		{
			if ($map[$event_start][$k] == -1)
			{
				$found = true;
				$map_offset = $k;
			}
		}

		// mark the offset as used for the whole event period
		$offset_date = $event_start;
		while ($offset_date <= $event_end)
		{
			for ($l=count($map[$offset_date]); $l <= $map_offset; $l++)
			{
				$map[$offset_date][$l] = -1;
			}
			$map[$offset_date][$map_offset] = $i;
			$offset_date = mktime( 0,0,0, date('m', $offset_date), date('d', $offset_date)+1, date('Y', $offset_date));
		}
	}

	// template
	$template->set_filenames(array(
		'_calendar_body' . $handler => 'calendar_box.tpl')
	);

	// buid select list for month
	$month = intval(date('m', $start_date));
	$s_month = '<select name="start_month" onchange="forms[\'_calendar\'].submit();" }>';
	for ($i=1; $i < count($months); $i++)
	{
		$selected = ($month == $i) ? ' selected="selected"' : '';
		$s_month .= '<option value="' . $i . '"' . $selected . '>' . $months[$i] . '</option>';
	}
	$s_month .= '</select>';

	// buid select list for year
	$year = intval(date('Y', $start_date));
	$s_year = '<select name="start_year" onchange="forms[\'_calendar\'].submit();">';
	for ($i=1971; $i < 2070; $i++)
	{
		$selected = ($year == $i) ? ' selected="selected"' : '';
		$s_year .= '<option value="' . $i . '"' . $selected . '>' . $i . '</option>';
	}
	$s_year .= '</select>';

	// build a forum select list
	$cat_hierarchy = function_exists('get_auth_keys');
	if (!$cat_hierarchy)
	{
		$s_forum_list = '<select name="selected_id" onchange="forms[\'_calendar\'].submit();">' . calendar_get_tree_option($fid) . '</select>';
	}
	else
	{
		$s_forum_list = '<select name="selected_id" onchange="forms[\'_calendar\'].submit();">' . get_tree_option($fid) . '</select>';
	}

	// header
	$template->assign_vars(array(
		'UP_ARROW'			=> $images['up_arrow'],
		'DOWN_ARROW'		=> $images['down_arrow'],
		'TOGGLE_ICON'		=> intval($board_config['calendar_display_open']) ? $images['up_arrow'] : $images['down_arrow'],
		'TOGGLE_STATUS'		=> intval($board_config['calendar_display_open']) ? '' : 'none',
		)
	);
	$prec = (date('Ym', $start_date) > 197101) ? date('Ymd', mktime(0,0,0, date('m', $start_date)-1, 01, date('Y', $start_date)) ) : date('Ymd', $start_date);
	$next = date( 'Ymd', mktime(0,0,0, date('m', $start_date)+1, 01, date('Y', $start_date)) );
	$template->assign_block_vars('_calendar_box', array(
		'L_CALENDAR'      => '<a href="' . append_sid($phpbb_root_path . "./calendar.$phpEx?start=" . date( 'Ymd', cal_date(time(),$board_config['board_timezone']))) . '"><img src="' . $images['icon_calendar'] . '" hspace="3" border="0" align="top" alt="' . $lang['Calendar_event'] . '" /></a>' . $lang['Calendar'],
		'L_CALENDAR_TXT'	=> $lang['Calendar'],
		'SPAN_ALL'			=> $nb_cells,
		'S_MONTH'			=> $s_month,
		'S_YEAR'			=> $s_year,
		'S_FORUM_LIST'		=> $s_forum_list,
		'L_GO'				=> $lang['Go'],
		'ACTION'			=> append_sid($phpbb_root_path . "./calendar.$phpEx"),
		'U_PREC'			=> append_sid("./calendar.$phpEx?start=$prec&fid=$fid"),
		'U_NEXT'			=> append_sid("./calendar.$phpEx?start=$next&fid=$fid"),
		)
	);
	if ($full_month)
	{
		$template->assign_block_vars('_calendar_box.switch_full_month', array());
		$offset = $cfg_week_day_start;
		for ($j=0; $j < $nb_cells; $j++)
		{
			if ($offset >= count($day_of_week)) $offset = 0;
			$template->assign_block_vars('_calendar_box.switch_full_month._cell', array(
				'WIDTH'		=> floor(100 / $nb_cells),
				'L_DAY'		=> $day_of_week[$offset],
				)
			);
			$offset++;
		}
	}
	else
	{
		$template->assign_block_vars('_calendar_box.switch_full_month_no', array());
	}

	// display
	$offset_date = mktime( 0,0,0, date('m', $start_date), date('d', $start_date) - $start_inc, date('Y', $start_date));

	for ($i=0; $i < $nb_rows; $i++)
	{
		$template->assign_block_vars('_calendar_box._row', array());
		for ($j=0; $j < $nb_cells; $j++)
		{
			$span = 1;

			// date less than start
			if ( intval(date('Ymd', $offset_date)) < intval(date('Ymd', $start_date)) )
			{
				// compute the cell to span
				$span = $start_inc;
				$j = $start_inc-1;
				$offset_date = mktime( 0,0,0, date('m', $start_date), date('d', $start_date)-1, date('Y', $start_date));
			}

			// date greater than last
			if ( intval(date('Ymd', $offset_date)) >= intval(date('Ymd', $end_date)) )
			{
				// compute the cell to span
				$span = $nb_cells-$j;
				$j = $nb_cells;
			}

			$format = ( intval(date('Ymd', $offset_date)) == intval(date('Ymd', cal_date(time(),$board_config['board_timezone']))) ) ? '<b>%s</b>' : '%s';
			$template->assign_block_vars('_calendar_box._row._cell', array(
				'WIDTH'		=> floor(100 / $nb_cells),
				'SPAN'		=> $span,
				'DATE'		=> sprintf( $format, date_dsp( ($full_month ? '' : 'D ') . $lang['DATE_FORMAT'], $offset_date)),
				'U_DATE'	=> append_sid($phpbb_root_path . "./calendar_scheduler.$phpEx?d=" . $offset_date . "&fid=$fid"),
				)
			);
			// blank cells
			if ( (intval(date('Ymd', $offset_date)) >= intval(date('Ymd', $start_date))) && (intval(date('Ymd', $offset_date)) < intval(date('Ymd', $end_date))) )
			{
				$template->assign_block_vars('_calendar_box._row._cell.switch_filled', array(
					'EVENT_DATE'	=> $offset_date,
					'TOGGLE_STATUS'	=> 'none',
					'TOGGLE_ICON'	=> $images['down_arrow'],
					)
				);

				// send events
				$more = false;
        $map_offset_date = ( $map[$offset_date] ? count($map[$offset_date]) : 0 );
				$over = $map_offset_date > $nb_row_per_cell;
				for ($k=0; $k < $map_offset_date; $k++)
				{
					// we are just over the limit
					if ( $over && ($k == $nb_row_per_cell) )
					{
						$more = true;
						$template->assign_block_vars('_calendar_box._row._cell.switch_filled._event._more_header', array());
					}

					$ind = $map[$offset_date][$k];
					$template->assign_block_vars('_calendar_box._row._cell.switch_filled._event', array(
						'U_EVENT'		=> $events[$ind]['event_link'],
						'EVENT_TYPE'	=> $events[$ind]['event_type_icon'],
						'EVENT_TITLE'	=> $events[$ind]['event_short_title'],
						'EVENT_CLASS'	=> $events[$ind]['event_txt_class'],
						'EVENT_MESSAGE'	=> str_replace(array('"', '\''), array('&quot;', '\\\''), $events[$ind]['event_message']),
						)
					);
					$flag = ( $over && ($k == $nb_row_per_cell-1) );
					if ($ind > -1)
					{
						$template->assign_block_vars('_calendar_box._row._cell.switch_filled._event.switch_event', array());
						if ($flag)
						{
							$template->assign_block_vars('_calendar_box._row._cell.switch_filled._event.switch_event._more', array());
						}
						else
						{
							$template->assign_block_vars('_calendar_box._row._cell.switch_filled._event.switch_event._more_no', array());
						}
					}
					else
					{
						$template->assign_block_vars('_calendar_box._row._cell.switch_filled._event.switch_event_no', array());
						if ($flag)
						{
							$template->assign_block_vars('_calendar_box._row._cell.switch_filled._event.switch_event_no._more', array());
						}
						else
						{
							$template->assign_block_vars('_calendar_box._row._cell.switch_filled._event.switch_event_no._more_no', array());
						}
					}

					if (($k == count($map[$offset_date])-1) && $more)
					{
						$template->assign_block_vars('_calendar_box._row._cell.switch_filled._event._more_footer', array());
					}
				}
			}
			else
			{
				$template->assign_block_vars('_calendar_box._row._cell.switch_filled_no', array());
			}
			$offset_date = mktime( 0,0,0, date('m', $offset_date), date('d', $offset_date)+1, date('Y', $offset_date));
		}
	}

	// fill the main template
	$template->assign_var_from_handle($main_template, '_calendar_body' . $handler);
}

?>
