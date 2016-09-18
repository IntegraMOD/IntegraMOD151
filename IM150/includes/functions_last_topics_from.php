<?php

/***************************************************************************
 *                          functions_last_topics_from.php
 *                          ------------------------------
 *	begin				: 19/10/2003
 *	copyright			: Ptirhiik
 *	email				: admin@rpgnet-fr.com
 *
 *	version				: 1.0.0 - 19/10/2003
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

if (!defined('IN_PHPBB'))
{
	die('Hacking attempt');
}

function last_topics_from($view_userdata, $last_started_box='', $last_replied_box='', $last_ended_box='')
{
	global $db, $template, $board_config, $userdata, $phpEx, $lang, $images, $_COOKIE;
	global $tree;

	include_once($phpbb_root_path . './includes/functions_topics_list.' . $phpEx);

	// fix some default values
	if (empty($last_started_box))
	{
		$last_started_box = 'BOARD_TOPICS_FROM_STARTED';
	}
	if (empty($last_replied_box))
	{
		$last_replied_box = 'BOARD_TOPICS_FROM_REPLIED';
	}
	if (empty($last_ended_box))
	{
		$last_ended_box = 'BOARD_TOPICS_FROM_ENDED';
	}

	// get the user viewed
	$view_user_id = $view_userdata['user_id'];
	if ($view_user_id == ANONYMOUS) return false;

	// display
	$to_display = array();
	$to_display[0]		= isset($board_config['last_topics_from_started']) ? intval($board_config['last_topics_from_started']) : 0;
	$to_display[1]		= isset($board_config['last_topics_from_replied']) ? intval($board_config['last_topics_from_replied']) : 0;
	$to_display[2]		= isset($board_config['last_topics_from_ended']) ? intval($board_config['last_topics_from_ended']) : 0;
	$split_type			= isset($board_config['last_topics_from_split']) ? (intval($board_config['last_topics_from_split']) == 1) : false;
	$display_nav_tree	= isset($board_config['last_topics_from_forum']) ? (intval($board_config['last_topics_from_forum']) == 1) : false;

	// ACP config says : do not display - who am I to say the contrary ? ;)
	$sum = 0;
	for ($k=0; $k < count($to_display); $k++)
	{
		$sum = $sum + $to_display[$k];
	}
	if ($sum <= 0) return false;

	// read the forums authorized
	$cat_hierarchy = function_exists(get_auth_keys);
	$forum_ids = array();
	if (!$cat_hierarchy)
	{
		// standard read
		$is_auth = array();
		$is_auth = auth(AUTH_ALL, AUTH_LIST_ALL, $userdata);

		// get the list of authorized forums
		while (list($forum_id, $forum_auth) = each($is_auth))
		{
			if ( $forum_auth['auth_read'])
			{
				$forum_ids[] = $forum_id;
			}
		}
	}
	else
	{
		// compliency with categories hierarchy v2 mod
		// get auth key
		$keys = array();
		$keys = get_auth_keys('Root', true, -1, -1, 'auth_read');
		for ($i=1; $i < count($keys['id']); $i++)
		{
			if ( ($tree['type'][$keys['idx'][$i]] == POST_FORUM_URL) && ($tree['auth'][ $keys['id'][$i] ]['auth_read']) )
			{
				$forum_ids[] = $tree['id'][$keys['idx'][$i]];
			}
		}
	}

	// no forums allowed to the viewer, say goodbye :)
	if (count($forum_ids) <= 0) return false;

	// get the list of forum for selection
	$sql_forums = 't.forum_id IN (' . implode(', ', $forum_ids) . ')';

	// ok, process the last replied topics
	$topic_rowset = array();
	for ($k = 0; $k < count($to_display); $k++) if ($to_display[$k] > 0)
	{
		$title = '??';
		switch ( $k )
		{
			case 0:
				// started by
				$sql_filter = "t.topic_poster = $view_user_id";
				$title = sprintf($lang['Topic_last_started'], $view_userdata['username']);
				$box = $last_started_box;
				break;
			case 1:
				// replied by
				$sql = "SELECT DISTINCT p.topic_id FROM " . POSTS_TABLE . " p, " . TOPICS_TABLE . " t
						WHERE 
							$sql_forums
							AND t.topic_id = p.topic_id
							AND p.poster_id = $view_user_id
						GROUP BY p.topic_id
						ORDER BY p.post_time DESC
						LIMIT 0, " . $to_display[$k];
				if (!$result = $db->sql_query($sql))
				{
					message_die(GENERAL_ERROR, 'Could not obtain users post informations', '', __LINE__, __FILE__, $sql);
				}
				$topic_ids = array();
				while ($row = $db->sql_fetchrow($result))
				{
					$topic_ids[] = $row['topic_id'];
				}
				$db->sql_freeresult($result);
				$sql_filter = 't.topic_id = -1';
				if (!empty($topic_ids))
				{
					$sql_filter = 't.topic_id IN (' . implode(', ', $topic_ids) . ')';
				}
				$title = sprintf($lang['Topic_last_replied'], $view_userdata['username']);
				$box = $last_replied_box;
				break;
			case 2:
				// ended by
				$sql_filter = "u2.user_id = $view_user_id";
				$title = sprintf($lang['Topic_last_ended'], $view_userdata['username']);
				$box = $last_ended_box;
				break;
			default:
				message_die(GENERAL_ERROR, 'Wrong setup in the process for $k=' . $k, '', __LINE__, __FILE__, $sql);
				break;
		} // end switch

		if (($userdata['user_level'] != ADMIN && $userdata['user_level'] != MOD) || !$is_auth['auth_delayedpost'])
		{
			$current_time = time();
			$limit_topics_time = " AND (t.topic_time <= $current_time OR t.topic_poster = " . $userdata['user_id'] . ")";
		}

		// get topics data
		$topic_rowset = array();
		$sql = "SELECT t.*, u.username, u.user_id, u2.username as user2, u2.user_id as id2, p.post_time, p.post_username, f.forum_name
				FROM " . TOPICS_TABLE . " t, " . USERS_TABLE . " u, " . POSTS_TABLE . " p, " . USERS_TABLE . " u2, " . FORUMS_TABLE . " f
				WHERE 
					$sql_forums
					AND t.topic_poster = u.user_id
					AND p.post_id = t.topic_last_post_id
					AND p.poster_id = u2.user_id
					AND $sql_filter
					AND f.forum_id = t.forum_id
					$limit_topics_time
				ORDER BY t.topic_type DESC, p.post_time DESC
				LIMIT 0, " . $to_display[$k];
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain topic information', '', __LINE__, __FILE__, $sql);
		}
		while ($row = $db->sql_fetchrow($result))
		{
			$row['topic_id'] = POST_TOPIC_URL . $row['topic_id'];
			$topic_rowset[] = $row;
		}
		$db->sql_freeresult($result);

		// send this to box
		$split_type = true;
		$display_nav_tree = true;
		$footer = '';
		$inbox = false;
		topic_list($box, 'topics_list_box', $topic_rowset, $title, $split_type, $display_nav_tree, $footer, $inbox );
	} // end for $k = type of display
}

?>