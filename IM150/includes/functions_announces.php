<?php

/***************************************************************************
 *                            functions_announces.php
 *                            -----------------------
 *	begin			: 10/09/2003
 *	copyright		: Ptirhiik
 *	email			: admin@rpgnet-fr.com
 *	version			: 1.0.1 - 13/09/2003
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

include_once($phpbb_root_path . 'includes/functions_topics_list.'. $phpEx);

function get_announces_title($start, $duration)
{
	global $lang, $board_config;

	$display_announce_dates = intval($board_config['announcement_date_display']);

	if ( empty($start) || ($duration < 0) || ($display_announce_dates == 0) ) return $res;

	$end = mktime(0,0,0, date('m', $start), date('d', $start)+$duration, date('Y', $start));
	$res = sprintf($lang['Announces_from_to'], date( $lang['DATE_FORMAT'], $start), date( $lang['DATE_FORMAT'], $end));

	return $res;
}

function announces_prune($force_prune=false)
{
	global $db, $board_config;

	// do we prune the announces ?
	$today_time = time();
	$today = mktime(0,0,0, date('m', $today_time), date('d', $today_time)+1, date('Y', $today_time))-1;
	$do_prune = false;

	// last prune date
	if (!isset($board_config['announcement_last_prune']) || (intval($board_config['announcement_last_prune']) < $today) || $force_prune)
	{
		$do_prune = true;
		if (!isset($board_config['announcement_last_prune']))
		{
			$sql = "INSERT INTO " . CONFIG_TABLE . " (config_name, config_value) VALUES('announcement_last_prune', '$today')";
			if( !$db->sql_query($sql) ) message_die(GENERAL_ERROR, 'Could not insert key announcement_last_prune into the config table', '', __LINE__, __FILE__, $sql);
		}
		else
		{
			$sql = "UPDATE " . CONFIG_TABLE . " SET config_value = '$today' WHERE config_name= 'announcement_last_prune'";
			if( !$db->sql_query($sql) ) message_die(GENERAL_ERROR, 'Could not update key announcement_last_prune in the config table', '', __LINE__, __FILE__, $sql);
		}
		$board_config['announcement_last_prune'] = $today;
	}

	// is the prune function activated ?
	$default_duration = isset($board_config['announcement_duration']) ? intval($board_config['announcement_duration']) : 7;
	if ($default_duration <= 0) $do_prune = false;

	// process fix and prune
	if ($do_prune)
	{
		// fix announces duration
		$default_duration = isset($board_config['announcement_duration']) ? intval($board_config['announcement_duration']) : 7;
		$sql = "UPDATE " . TOPICS_TABLE . " 
				SET topic_announce_duration = $default_duration 
				WHERE topic_announce_duration = 0 
					AND (topic_type=" . POST_ANNOUNCE . " OR topic_type=" . POST_GLOBAL_ANNOUNCE .")";
		if( !($result = $db->sql_query($sql)) ) message_die(GENERAL_ERROR, 'Could not update topic duration list', '', __LINE__, __FILE__, $sql);

		// prune announces
		$prune_strategy = isset($board_config['announcement_prune_strategy']) ? intval($board_config['announcement_prune_strategy']) : POST_NORMAL;
		$sql = "UPDATE " . TOPICS_TABLE . " 
				SET topic_type = $prune_strategy 
				WHERE (topic_announce_duration > -1) 
					AND ( (topic_time + topic_announce_duration * 86400) <= $today )
					AND (topic_type=" . POST_ANNOUNCE . " OR topic_type=" . POST_GLOBAL_ANNOUNCE .")";
		if( !($result = $db->sql_query($sql)) ) message_die(GENERAL_ERROR, 'Could not update topic type to prune announcements', '', __LINE__, __FILE__, $sql);
	}
}

function announces_from_forums($cur='Root', $force_prune=false)
{
	global $db, $template, $board_config, $userdata, $phpEx, $lang, $images, $HTTP_COOKIE_VARS;
	global $tree;
	global $topic_rank_set, $rating_config, $phpbb_root_path, $table_prefix; 
	// fix and prune announces
	announces_prune($force_prune);

	// get the start point
	$type = POST_CAT_URL;
	$id = 0;
	if ($cur != 'Root')
	{
		$type = substr($cur, 0, 1);
		$id = intval(substr($cur, 1));
		if ($id == 0) $type = POST_CAT_URL;
	}

	// configuration
	$announce_index = isset($board_config['announcement_display']) ? intval($board_config['announcement_display']) : true;
	$announce_forum = isset($board_config['announcement_display_forum']) ? intval($board_config['announcement_display_forum']) : true;
	$announce = ( (($type == POST_CAT_URL) && $announce_index) || (($type == POST_FORUM_URL) && $announce_forum) );
	if (!$announce) return false;

	// read the forums authorized
	$cat_hierarchy = function_exists(get_auth_keys);
	$auth_forum_ids = array();
	$tree_forum_ids = array();
	if (!$cat_hierarchy)
	{
		// standard read
		$is_auth = array();
		$is_auth = auth(AUTH_ALL, AUTH_LIST_ALL, $userdata);

		// get the list of authorized forums except the current one
		while (list($forum_id, $forum_auth) = each($is_auth))
		{
			if ( $forum_auth['auth_read'] && ($cur != POST_FORUM_URL . $forum_id) )
			{
				$auth_forum_ids[] = $forum_id;
			}
		}

		// no forums authed, return an error
		if (empty($auth_forum_ids)) return false;

		// get forums of the category
		$cat_id = 0;
		if ($type == POST_FORUM_URL)
		{
			// get the category
			$sql = "SELECT * FROM " . FORUMS_TABLE . " WHERE forum_id=$id";
			if ( !($result = $db->sql_query($sql)) ) message_die(GENERAL_ERROR, 'Could not obtain forum information', '', __LINE__, __FILE__, $sql);
			if ($row = $db->sql_fetchrow($result))
			{
				$cat_id = $row['cat_id'];
			}
		}

		// get the forums authed belonging to the category
		$sql_where = 'forum_id IN (' . implode(', ', $auth_forum_ids) . ')';
		if ($cat_id != 0)
		{
			$sql_where .= " AND cat_id=$cat_id";
		}
		$sql = "SELECT * FROM " . FORUMS_TABLE . " WHERE $sql_where";
		if ( !($result = $db->sql_query($sql)) ) message_die(GENERAL_ERROR, 'Could not obtain forum information', '', __LINE__, __FILE__, $sql);
		while ($row = $db->sql_fetchrow($result))
		{
			$tree_forum_ids[] = $row['forum_id'];
		}
	}
	else
	{
		// get the current item selected
		$cid = $type . $id;

		// get the list of authorized forums except the current one
		for ($i=0; $i < count($tree['id']); $i++)
		{
			$fid = $tree['type'][$i] . $tree['id'][$i];
			if ( ($fid != $cid) && ($tree['type'][$i] == POST_FORUM_URL) && $tree['auth'][$fid]['auth_read'] )
			{
				$auth_forum_ids[] = $tree['id'][$i];
			}
		}

		// no forums authed, return an error
		if (empty($auth_forum_ids)) return false;

		// get auth key
            if($cur != 'Root'){
            $keys = array();
            $keys = get_auth_keys($cur, true, -1, -1, 'auth_read');
            $tree_forum_ids = array();
            for ($i=1; $i < count($keys['id']); $i++)
            {
                $idx = $keys['idx'][$i];
                $fid = $keys['id'][$i];
                if ( ($fid != $cid) && ($tree['type'][$idx] == POST_FORUM_URL) && $tree['auth'][$fid]['auth_read'] )
                {
                    $tree_forum_ids[] = $tree['id'][$idx];
                }
            }
        } 	

		// go to root on this branch
		if (isset($tree['main'][ $tree['keys'][$cur] ]))
		{
			$fid = $tree['main'][ $tree['keys'][$cur] ];
			while ($fid != 'Root')
			{
				$idx = $tree['keys'][$fid];
				if ( ($fid != $cur) && ($tree['type'][$idx] == POST_FORUM_URL) && ($tree['auth'][$fid]['auth_read']) )
				{
					$tree_forum_ids[] = $tree['id'][$idx];
				}
				$fid = isset($tree['main'][$idx]) ? $tree['main'][$idx] : 'Root';
			}
		}
	}

	// select global
	$sql_where = '(t.topic_type=' . POST_GLOBAL_ANNOUNCE . ' AND t.forum_id IN (' . implode(', ', $auth_forum_ids) . '))';

	// select annonces
	if (!empty($tree_forum_ids))
	{
		$sql_where .= ' OR (t.topic_type=' . POST_ANNOUNCE . ' AND t.forum_id IN (' . implode(', ', $tree_forum_ids) . '))';
	}

    $current_time = time(); 
    $limit_topics_time = 'AND ('; 
    for ($i=0; $i < count($auth_forum_ids); $i++) { 
        $is_auth = $tree['auth'][POST_FORUM_URL . $auth_forum_ids[$i]]; 
        if ($i<>0){ 
            $limit_topics_time .= ' OR  '; 
        } 
        if (($userdata['user_level'] != ADMIN && !$is_auth['auth_mod']) || !$is_auth['auth_delayedpost']) { 
            $limit_topics_time .= '(f.forum_id = '.$auth_forum_ids[$i].' AND (t.topic_time <= '.$current_time.' OR t.topic_poster = ' . $userdata['user_id'] . '))'; 
        } else { 
            $limit_topics_time .= '(f.forum_id = '.$auth_forum_ids[$i].')'; 
        } 
    } 
    $limit_topics_time .= ')';

	// get topics data
	$sql = "SELECT t.*, u.username, u.user_id, u2.username as user2, u2.user_id as id2, p.post_time, p.post_username, f.forum_name
			FROM " . TOPICS_TABLE . " t, " . USERS_TABLE . " u, " . POSTS_TABLE . " p, " . USERS_TABLE . " u2, " . FORUMS_TABLE . " f
			WHERE ($sql_where)
				AND t.topic_poster = u.user_id
				AND p.post_id = t.topic_last_post_id
				AND p.poster_id = u2.user_id
				AND f.forum_id = t.forum_id
				$limit_topics_time
			ORDER BY t.topic_type DESC, p.post_time DESC ";
	if ( !($result = $db->sql_query($sql)) ) message_die(GENERAL_ERROR, 'Could not obtain topic information', '', __LINE__, __FILE__, $sql);
	while ($row = $db->sql_fetchrow($result))
	{
		$row['topic_id'] = POST_TOPIC_URL . $row['topic_id'];
		$topic_rowset[] = $row;
	}
	$db->sql_freeresult($result);
	if (count($topic_rowset) <= 0) return false;

	// send the list
	$footer = '';
	$allow_split_type = (intval($board_config['announcement_split']) == 1);
	$display_nav_tree = (intval($board_config['announcement_forum']) == 1);
	$inbox = false;
	    if(!count($topic_rank_set)){ 
        if(!$RATING_PATH){ 
            define('RATING_PATH', $phpbb_root_path.'mods/rating/'); 
        } 
        include_once(RATING_PATH.'functions_rating.'.$phpEx); 
        if(!$rating_config){ 
            $rating_config = get_rating_config('1'); 
        } 
        if ( $rating_config[1] == 1 ) { 
            $topic_rank_set = array(); 
            get_rating_ranks(); 
        } 
    } 
    topic_list('BOARD_ANNOUNCES', 'topics_list_box', $topic_rowset, $lang['Board_announcement'], $allow_split_type, $display_nav_tree, $footer, $inbox, '', 0, '', array(), $topic_rank_set);
}

?>
