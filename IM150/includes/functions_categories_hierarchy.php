<?php
/***************************************************************************
 *							functions_categories_hierarchy.php
 *							----------------------------------
 *	begin			: 21/10/2003
 *	copyright		: Ptirhiik
 *	email			: ptirhiik@clanmckeen.com
 *
 *	Version			: 1.0.2 - 12/11/2003
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
	die("Hacking attempt");
}
//--------------------------------------------------------------------------------------------------
//
// CACHE_* : comment these ones if you doesn't want to use the caches
// --------
//--------------------------------------------------------------------------------------------------
define('CACHE_TREE', true);
define('CACHE_WORDS', true);
define('CACHE_THEMES', true);

//--------------------------------------------------------------------------------------------------
//
// $nav_separator : used in the navigation sentence : ie Forum Index -> MainCat -> Forum -> Topic
// --------------
//--------------------------------------------------------------------------------------------------
$nav_separator = "&nbsp;&raquo;&nbsp;";

//--------------------------------------------------------------------------------------------------
//
// board_stats : update the board stats (topics, posts and users)
// -----------
//--------------------------------------------------------------------------------------------------
function board_stats()
{
	global $db, $board_config;

	// max users
	$sql = "SELECT COUNT(user_id) AS user_total FROM " . USERS_TABLE . " WHERE user_id > ". ANONYMOUS;
	if ( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Couldn\'t access users table', '', __LINE__, __FILE__, $sql);
	}
	$row = $db->sql_fetchrow($result);
	$max_users = intval( $row['user_total'] );

	// update
	if ( $board_config['max_users'] != $max_users )
	{
		$board_config['max_users'] = $max_users;
		$sql = "UPDATE " . CONFIG_TABLE . " 
					SET config_value = " . $board_config['max_users'] . " 
					WHERE config_name = 'max_users'";
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Couldn\'t update config table', '', __LINE__, __FILE__, $sql);
		}
	}

	// topics and posts
	$sql = "SELECT SUM(forum_topics) AS topic_total, SUM(forum_posts) AS post_total FROM " . FORUMS_TABLE;
	if ( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Couldn\'t access forums table', '', __LINE__, __FILE__, $sql);
	}
	$row = $db->sql_fetchrow($result);
	$max_topics = intval( $row['topic_total'] );
	$max_posts = intval( $row['post_total'] );

	// update
	if ( $board_config['max_topics'] != $max_topics )
	{
		$board_config['max_topics'] = $max_topics;
		$sql = "UPDATE " . CONFIG_TABLE . " 
					SET config_value = " . $board_config['max_topics'] . " 
					WHERE config_name = 'max_topics'";
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Couldn\'t update config table', '', __LINE__, __FILE__, $sql);
		}
	}
	if ( $board_config['max_posts'] != $max_posts )
	{
		$board_config['max_posts'] = $max_posts;
		$sql = "UPDATE " . CONFIG_TABLE . " 
					SET config_value = " . $board_config['max_posts'] . " 
					WHERE config_name = 'max_posts'";
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Couldn\'t update config table', '', __LINE__, __FILE__, $sql);
		}
	}
}

//--------------------------------------------------------------------------------------------------
//
// $tree : designed to get all the hierarchy
// ------
//
//	indexes :
//		- id : full designation : ie Root, f3, c20
//		- idx : rank order
//
//	$tree['keys'][id]			=> idx,
//	$tree['auth'][id]			=> auth_value array : ie tree['auth'][id]['auth_view'],
//	$tree['sub'][id]			=> array of sub-level ids,
//	$tree['main'][idx]			=> parent id,
//	$tree['type'][idx]			=> type of the row, can be 'c' for categories or 'f' for forums,
//	$tree['id'][idx]			=> value of the row id : cat_id for cats, forum_id for forums,
//	$tree['data'][idx]			=> db table row,
//	$tree['unread_topics'][idx]	=> boolean value to true if there is new topics
//--------------------------------------------------------------------------------------------------
$tree = array();

//--------------------------------------------------------------------------------------------------
//
// get_object_lang() : return the translated value of field depending on row type in the hierarchy
//
//--------------------------------------------------------------------------------------------------
function get_object_lang($cur, $field, $all=false)
{
	global $board_config, $lang, $tree;
	$res	= '';
	$ch_this	= $tree['keys'][$cur];
	$type	= $tree['type'][$ch_this];
	if ($cur == 'Root')
	{
		switch($field)
		{
			case 'name':
				if (isset($lang[$board_config['sitename']]))
				{
					$res = sprintf($lang['Forum_Index'], $lang[$board_config['sitename']]);
				}
				else
				{
					$res = sprintf($lang['Forum_Index'], $board_config['sitename']);
				}
				break;
			case 'desc':
				if (isset($lang[$board_config['site_desc']]))
				{
					$res = $lang[$board_config['site_desc']];
				}
				else
				{
					$res = $board_config['site_desc'];
				}
				break;
		}
	}
	else
	{
		switch($field)
		{
			case 'name':
				$field = ($type == POST_CAT_URL) ? 'cat_title' : 'forum_name';
				break;
			case 'desc':
				$field = ($type == POST_CAT_URL) ? 'cat_desc' : 'forum_desc';
				break;
		}
		$res = ($tree['auth'][$cur]['auth_view'] || $all) ? $tree['data'][$ch_this][$field] : '';
		if (isset($lang[$res])) $res = $lang[$res];
	}
	return $res;
}

//--------------------------------------------------------------------------------------------------
//
// cache_words() : buid the cache words file
//
//--------------------------------------------------------------------------------------------------
function cache_words()
{
	global $tree, $phpbb_root_path, $phpEx, $userdata, $db;

	if ( !defined('CACHE_WORDS') )
	{
		return;
	}

	// template
	include_once($phpbb_root_path . 'includes/template.' . $phpEx);
	$template = new Template($phpbb_root_path);

	$template->set_filenames(array(
		'def_words' => 'includes/cache_tpls/def_words_def.tpl')
	);

	$template->assign_vars(array(
		'TIME'		=> date('Y-m-d H:i:s', time()) . ' (GMT)',
		'USERNAME'	=> $userdata['username'],
		)
	);

	$sql = "SELECT word, replacement FROM  " . WORDS_TABLE;
	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not get censored words from database', '', __LINE__, __FILE__, $sql);
	}
	while ( $row = $db->sql_fetchrow($result) )
	{
		$template->assign_block_vars('word', array(
			'WORD'			=> str_replace( "'", "\'", $row['word']),
			'REPLACEMENT'	=> str_replace( "'", "\'", $row['replacement']),
			)
		);
	}

	// transfert to a var
	$template->assign_var_from_handle('def_words', 'def_words');
	$res = "<?php\n" . $template->_tpldata['.'][0]['def_words'] . "\n?>";

	// output to file
	$fname = $phpbb_root_path . './includes/def_words.' . $phpEx;
	@chmod($fname, 0666);
	$handle = @fopen($fname, 'w');
	@fwrite($handle, $res);
	@fclose($handle);
}

//--------------------------------------------------------------------------------------------------
//
// cache_themes() : buid the cache theme file
//
//--------------------------------------------------------------------------------------------------
function cache_themes()
{
	global $tree, $phpbb_root_path, $phpEx, $userdata, $db;

	if ( !defined('CACHE_THEMES') )
	{
		return;
	}

	// template
	include_once($phpbb_root_path . 'includes/template.' . $phpEx);
	$template = new Template($phpbb_root_path);

	$template->set_filenames(array(
		'def_themes' => 'includes/cache_tpls/def_themes_def.tpl')
	);

	$template->assign_vars(array(
		'TIME'		=> date('Y-m-d H:i:s', time()) . ' (GMT)',
		'USERNAME'	=> $userdata['username'],
		)
	);

	$sql = "SELECT * FROM  " . THEMES_TABLE;
	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not read themes table', '', __LINE__, __FILE__, $sql);
	}
	while ( $row = $db->sql_fetchrow($result) )
	{
		$id = $row['themes_id'];
		$cells = array();
		@reset($row);
		while ( list($key, $value) = @each($row) )
		{
			$nkey = intval($key);
			if ( $key != "$nkey" )
			{
				$cells[] = sprintf( "'%s' => '%s'", str_replace("'", "\'", $key), str_replace("'", "\'", $value));
			}
		}
		$s_cells = empty($cells) ? '' : implode(', ', $cells);

		$template->assign_block_vars('theme', array(
			'ID'		=> $id,
			'CELLS'		=> $s_cells,
			)
		);
	}

	// transfert to a var
	$template->assign_var_from_handle('def_themes', 'def_themes');
	$res = "<?php\n" . $template->_tpldata['.'][0]['def_themes'] . "\n?>";

	// output to file
	$fname = $phpbb_root_path . './includes/def_themes.' . $phpEx;
	@chmod($fname, 0666);
	$handle = @fopen($fname, 'w');
	@fwrite($handle, $res);
	@fclose($handle);
}

//--------------------------------------------------------------------------------------------------
//
// cache_tree() : buid the cache tree file
//
//--------------------------------------------------------------------------------------------------
function cache_tree_output()
{
	global $tree, $phpbb_root_path, $phpEx, $userdata;

	if ( !defined('CACHE_TREE') )
	{
		return;
	}

	// template
	include_once($phpbb_root_path . 'includes/template.' . $phpEx);
	$template = new Template($phpbb_root_path);

	$template->set_filenames(array(
		'def_tree' => 'includes/cache_tpls/def_tree_def.tpl')
	);

	$template->assign_vars(array(
		'TIME'		=> date('Y-m-d H:i:s', time()) . ' (GMT)',
		'USERNAME'	=> $userdata['username'],
		)
	);

	// keys
	$cells = array();
	@reset($tree['keys']);
	while ( list($key, $value) = @each($tree['keys']) )
	{
		$cells[] = sprintf("'%s' => %s", $key, $value);
	}
	$keys = @implode(', ', $cells);

	// types
	$cells = array();
	for ( $i = 0; $i < count($tree['type']); $i++ )
	{
		$cells[] = sprintf("'%s'", $tree['type'][$i]);
	}
	$types = @implode(', ', $cells);

	// ids
	$cells = array();
	for ( $i = 0; $i < count($tree['id']); $i++ )
	{
		$cells[] = sprintf("'%s'", $tree['id'][$i]);
	}
	$ids = @implode(', ', $cells);

	// mains
	$cells = array();
	for ( $i = 0; $i < count($tree['main']); $i++ )
	{
		$cells[] = sprintf("'%s'", $tree['main'][$i]);
	}
	$mains = @implode(', ', $cells);

	$template->assign_vars(array(
		'KEYS'	=> $keys,
		'TYPES'	=> $types,
		'IDS'	=> $ids,
		'MAINS'	=> $mains,
		)
	);

	// data
	for ($i = 0; $i < count($tree['data']); $i++ )
	{
		$template->assign_block_vars('data', array());

		@reset($tree['data'][$i]);
		while ( list($key, $value) = @each($tree['data'][$i]) )
		{
			$nkey = intval($key);
			if ( $key != "$nkey" )
			{
				$template->assign_block_vars('data.field', array(
					'FIELD_NAME'	=> $key,
					'FIELD_VALUE'	=> str_replace("\n", "' . \"\\n\" . '", str_replace("\r\n", "' . \"\\r\\n\" . '", str_replace("'", "\'", $value))),
					)
				);
			}
		}
	}

	// subs
	@reset($tree['sub']);
	while ( list($main, $data) = @each($tree['sub']) )
	{
		$cells = array();
		for ( $i = 0; $i < count($data); $i++ )
		{
			$cells[] = sprintf("'%s'", $data[$i]);
		}
		$subs = @implode(', ', $cells);
		$template->assign_block_vars('sub', array(
			'THIS'	=> $main,
			'SUBS'	=> $subs,
			)
		);
	}

	// moderators
	@reset($tree['mods']);
	while ( list($idx, $data) = @each($tree['mods']) )
	{
		$s_user_ids = empty($data['user_id']) ? '' : implode(', ', $data['user_id']);
		$s_group_ids = empty($data['group_id']) ? '' : implode(', ', $data['group_id']);
		$s_usernames = '';
		for ( $j = 0; $j < count($data['username']); $j++ )
		{
			$s_usernames .= ( empty($s_usernames) ? '' : ', ' ) . sprintf("'%s'", str_replace("'", "\'", $data['username'][$j]));
		}
		$s_group_names = '';
		for ( $j = 0; $j < count($data['group_name']); $j++ )
		{
			$s_group_names .= ( empty($s_group_names) ? '' : ', ' ) . sprintf("'%s'", str_replace("'", "\'", $data['group_name'][$j]));
		}
		$template->assign_block_vars('mods', array(
			'IDX'			=> $idx,
			'USER_IDS'		=> $s_user_ids,
			'USERNAMES'		=> $s_usernames,
			'GROUP_IDS'		=> $s_group_ids,
			'GROUP_NAMES'	=> $s_group_names,
			)
		);
	}

	// transfert to a var
	$template->assign_var_from_handle('def_tree', 'def_tree');
	$res = "<?php\n" . $template->_tpldata['.'][0]['def_tree'] . "\n?>";

	// output to file
	$fname = $phpbb_root_path . './includes/def_tree.' . $phpEx;
	@chmod($fname, 0666);
	$handle = @fopen($fname, 'w');
	@fwrite($handle, $res);
	@fclose($handle);
}

function cache_tree_level($main, &$parents, &$cats, &$forums)
{
	global $tree;

	// read all parents
	$tree_level = array();

	// get the forums of the level
	for ($i=0; $i < count($parents[POST_FORUM_URL][$main]); $i++)
	{
		$idx = $parents[POST_FORUM_URL][$main][$i];
		$tree_level['type'][]	= POST_FORUM_URL;
		$tree_level['id'][]		= $forums[$idx]['forum_id'];
		$tree_level['sort'][]	= $forums[$idx]['forum_order'];
		$tree_level['data'][]	= $forums[$idx];
	}

	// add the categories of this level
	for ($i=0; $i < count($parents[POST_CAT_URL][$main]); $i++)
	{
		$idx = $parents[POST_CAT_URL][$main][$i];
		$tree_level['type'][]	= POST_CAT_URL;
		$tree_level['id'][]		= $cats[$idx]['cat_id'];
		$tree_level['sort'][]	= $cats[$idx]['cat_order'];
		$tree_level['data'][]	= $cats[$idx];
	}

	// sort the level
	@array_multisort($tree_level['sort'], $tree_level['type'], $tree_level['id'], $tree_level['data']);

	// add the tree_level to the tree
	$order = 0;
	for ($i=0; $i < count($tree_level['data']); $i++)
	{
		$ch_this = count($tree['data']);
		$key = $tree_level['type'][$i] . $tree_level['id'][$i];
		$order = $order + 10;
		$tree['keys'][$key] = $ch_this;
		$tree['main'][]		= $main;
		$tree['type'][]		= $tree_level['type'][$i];
		$tree['id'][]		= $tree_level['id'][$i];
		$tree['data'][]		= $tree_level['data'][$i];
		$tree['sub'][$main][] = $key;

		cache_tree_level($key, $parents, $cats, $forums);
	}
}

function cache_tree($write=false)
{
	global $db, $tree, $userdata, $phpbb_root_path, $phpEx, $board_config;

	// extended auth compliancy
	$sql_extend_auth = '';
	if ( defined('EXTEND_AUTH_INSTALLED') )
	{
		$sql_extend_auth = ' AND aa.auth_type = ' . POST_FORUM_URL;
	}

	$parents = array();

	// read categories
	$cats = array();
	$sql = "SELECT * FROM " . CATEGORIES_TABLE . " ORDER BY cat_order, cat_id";
	if ( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Couldn\'t access list of Categories', '', __LINE__, __FILE__, $sql);
	}
	while ($row = $db->sql_fetchrow($result))
	{
		if ($row['cat_main'] == $row['cat_id'])
		{
			$row['cat_main'] = 0;
		}
		if ( empty($row['cat_main_type']) )
		{
			$row['cat_main_type'] = POST_CAT_URL;
			$row['cat_order'] = $row['cat_order'] + 9000000;
		}
		$row['main'] = ($row['cat_main'] == 0) ? 'Root' : $row['cat_main_type'] . $row['cat_main'];
		$idx = count($cats);
		$cats[$idx] = $row;
		$parents[POST_CAT_URL][ $row['main'] ][] = $idx;
	}

	// read forums
	$sql = "SELECT * FROM " . FORUMS_TABLE . " ORDER BY forum_order, forum_id";
	if ( !$result = $db->sql_query($sql) ) message_die(GENERAL_ERROR, "Couldn't access list of Forums", "", __LINE__, __FILE__, $sql);
	while ($row = $db->sql_fetchrow($result))
	{
		$main_type = (empty($row['main_type'])) ? POST_CAT_URL : $row['main_type'];
		$row['main'] = ($row['cat_id'] == 0) ? 'Root' : $main_type . $row['cat_id'];
		$idx = count($forums);
		$forums[$idx] = $row;
		$parents[POST_FORUM_URL][ $row['main'] ][] = $idx;
	}

	// build the tree
	$tree = array();
	cache_tree_level('Root', $parents, $cats, $forums);

	//
	// Obtain list of moderators of each forum
	// First users, then groups ... broken into two queries
	//
	$sql = "SELECT aa.forum_id, u.user_id, u.username 
			FROM " . AUTH_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g, " . USERS_TABLE . " u
			WHERE aa.auth_mod = " . TRUE . " 
				AND g.group_single_user = 1 
				AND ug.group_id = aa.group_id 
				AND g.group_id = aa.group_id 
				AND u.user_id = ug.user_id 
				$sql_extend_auth
			GROUP BY u.user_id, u.username, aa.forum_id 
			ORDER BY aa.forum_id, u.user_id";
	if ( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not query forum moderator information', '', __LINE__, __FILE__, $sql);
	}
	while( $row = $db->sql_fetchrow($result) )
	{
		$idx = $tree['keys'][ POST_FORUM_URL . $row['forum_id'] ];
		$tree['mods'][$idx]['user_id'][] = $row['user_id'];
		$tree['mods'][$idx]['username'][] = $row['username'];
	}

	$sql = "SELECT aa.forum_id, g.group_id, g.group_name 
			FROM " . AUTH_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g 
			WHERE aa.auth_mod = " . TRUE . " 
				AND g.group_single_user = 0 
				AND g.group_type <> " . GROUP_HIDDEN . "
				AND ug.group_id = aa.group_id 
				AND g.group_id = aa.group_id 
				$sql_extend_auth
			GROUP BY g.group_id, g.group_name, aa.forum_id 
			ORDER BY aa.forum_id, g.group_id";
	if ( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not query forum moderator information', '', __LINE__, __FILE__, $sql);
	}
	while( $row = $db->sql_fetchrow($result) )
	{
		$idx = $tree['keys'][ POST_FORUM_URL . $row['forum_id'] ];
		$tree['mods'][$idx]['group_id'][] = $row['group_id'];
		$tree['mods'][$idx]['group_name'][] = $row['group_name'];
	}

	if ($write)
	{
		cache_tree_output();
	}
}

//--------------------------------------------------------------------------------------------------
//
// read_tree() : read the tables and fill the hierarchical tree
//
//--------------------------------------------------------------------------------------------------
function read_tree($force=false)
{
	global $db, $userdata, $board_config, $HTTP_COOKIE_VARS;
	global $tree;
	global $phpbb_root_path, $phpEx;

	// get censored words
	$orig_word = array();
	$remplacement_word = array();
	obtain_word_list($orig_word, $replacement_word);

//-- mod : keep unread -----------------------------------------------------------------------------
//-- delete
//	// read the user cookie
//	$tracking_topics	= ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_t']) ) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'] . "_t"]) : array();
//	$tracking_forums	= ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f']) ) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'] . "_f"]) : array();
//	$tracking_all		= ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f_all']) ) ? intval($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f_all']) : -1;
//-- fin mod : keep unread -------------------------------------------------------------------------

	// extended auth compliancy
	$sql_extend_auth = '';
	if ( defined('EXTEND_AUTH_INSTALLED') )
	{
		$sql_extend_auth = ' AND aa.auth_type = ' . POST_FORUM_URL;
	}

	// try the cache
	$use_cache_file = false;
	if ( defined('CACHE_TREE') )
	{
		$cache_file = $phpbb_root_path . 'includes/def_tree.' . $phpEx;
		@include($cache_file);
		if ( empty($tree) || $force)
		{
			cache_tree(true);
			@include($cache_file);
		}
		if ( !empty($tree) )
		{
			$use_cache_file = true;
		}
	}
	else
	{
		cache_tree();
	}

	// read the last post
	$sql = "SELECT forum_id, forum_last_post_id FROM " . FORUMS_TABLE;
	if ( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Couldn\'t access list of last posts from forums', '', __LINE__, __FILE__, $sql);
	}
	$s_last_posts = '';
	$last_posts = array();
	while ( $row = $db->sql_fetchrow($result) )
	{
		if ( !empty($row['forum_last_post_id']) )
		{
			$last_posts[ $row['forum_last_post_id'] ] = $row['forum_id'];
			$s_last_posts .= ( empty($s_last_posts) ? '' : ', ' ) . $row['forum_last_post_id'];
		}
	}
	$sql_last_posts = empty($s_last_posts) ? '' : " OR p.post_id IN ($s_last_posts)";

	// read the last or unread posts
//-- mod : keep unread -----------------------------------------------------------------------------
//-- delete
//	$user_lastvisit = $userdata['session_logged_in'] ? $userdata['user_lastvisit'] : 99999999999;
//-- add
	// get last visit for guest
	if ( !$userdata['session_logged_in'] )
	{
		$userdata['user_lastvisit'] = $board_config['guest_lastvisit'];
	}
	$user_lastvisit = $userdata['user_lastvisit'];

	// unreads
	$sql_unreads = '';
	if ( !empty($board_config['tracking_unreads']) )
	{
		// get the unreads topic id
		@reset($board_config['tracking_unreads']);
		while ( list($id, $time) = @each($board_config['tracking_unreads']) )
		{
			// don't add obsolete cookies
			if ( ($time > intval($board_config['tracking_all'])) && ($time > intval($board_config['tracking_topics'][$id])) )
			{
				$sql_unreads .= ( empty($sql_unreads) ? '' : ', ' ) . $id;
			}
		}
		if ( !empty($sql_unreads) )
		{
			$sql_unreads = " OR p.topic_id IN ($sql_unreads)";
		}
	}

	// prepare the result
	$new_unreads = array();
//-- fin mod : keep unread -------------------------------------------------------------------------
//-- mod : keep unread -----------------------------------------------------------------------------
// here we added
//	 $sql_unreads
//-- modify
$sql = "SELECT p.forum_id, p.topic_id, p.post_time, p.post_username, u.username, u.user_id, t.topic_last_post_id, t.topic_title 
                FROM (((" . POSTS_TABLE . " p 
                    LEFT JOIN " . TOPICS_TABLE . " t ON t.topic_id = p.topic_id AND t.forum_id = p.forum_id AND t.topic_moved_id = 0) 
                    LEFT JOIN " . USERS_TABLE . " u ON u.user_id = p.poster_id ) 
                    LEFT OUTER JOIN ".APPROVE_POSTS_TABLE." ap ON ap.post_id = p.post_id ) 
                WHERE ( p.post_time > $user_lastvisit $sql_last_posts $sql_unreads ) 
                     AND p.post_id = t.topic_last_post_id 
                     AND p.post_time < ".time()." 
                     AND ap.post_id IS NULL";
//-- fin mod : keep unread -------------------------------------------------------------------------
	if ( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Couldn\'t access list of unread posts from forums', '', __LINE__, __FILE__, $sql);
	}
	$new_topic_data = array();
	while ($row = $db->sql_fetchrow($result))
	{
//-- mod : keep unread -----------------------------------------------------------------------------
//-- delete
//		if ( $row['post_time'] > $user_lastvisit )
//		{
//-- add
		// get some ids
		$topic_id = $row['topic_id'];
		$forum_id = $row['forum_id'];

		// check the validity of the cookies : forum
		if ( isset($board_config['tracking_forums'][$forum_id]) )
		{
			if ( !empty($board_config['tracking_all']) && ($board_config['tracking_all'] >= $board_config['tracking_forums'][$forum_id]) )
			{
				unset($board_config['tracking_forums'][$forum_id]);
			}
		}

		// topic cookie still valid ?
		if ( isset($board_config['tracking_topics'][$topic_id]) )
		{
			if ( 
				( !empty($board_config['tracking_all']) && ($board_config['tracking_all'] >= $board_config['tracking_topics'][$topic_id]) ) ||
				( isset($board_config['tracking_forums'][$forum_id]) && ($board_config['tracking_forums'][$forum_id] >= $board_config['tracking_topics'][$topic_id]) )
			)
			{
				unset($board_config['tracking_topics'][$topic_id]);
			}
		}

		// unread cookie still valid ?
		if ( isset($board_config['tracking_unreads'][$topic_id]) )
		{
			if ( 
				( !empty($board_config['tracking_all']) && ($board_config['tracking_all'] >= $board_config['tracking_unreads'][$topic_id]) ) ||
				( isset($board_config['tracking_forums'][$forum_id]) && ($board_config['tracking_forums'][$forum_id] >= $board_config['tracking_unreads'][$topic_id]) ) ||
				( isset($board_config['tracking_topics'][$topic_id]) && ($board_config['tracking_topics'][$topic_id] >= $board_config['tracking_unreads'][$topic_id]) )
			)
			{
				unset($board_config['tracking_unreads'][$topic_id]);
			}
		}

		// have we got a last visit time for this topic
		$topic_last_read = intval($board_config['tracking_unreads'][$topic_id]);
		if ( !empty($board_config['tracking_all']) && ($board_config['tracking_all'] > $topic_last_read) )
		{
			$topic_last_read = $board_config['tracking_all'];
		}
		if ( isset($board_config['tracking_forums'][$forum_id]) && ($board_config['tracking_forums'][$forum_id] > $topic_last_read) )
		{
			$topic_last_read = $board_config['tracking_forums'][$forum_id];
		}
		if ( isset($board_config['tracking_topics'][$topic_id]) && ($board_config['tracking_topics'][$topic_id] > $topic_last_read) )
		{
			$topic_last_read = $board_config['tracking_topics'][$topic_id];
		}
		if ( empty($topic_last_read) )
		{
			$topic_last_read = $userdata['user_lastvisit'];
		}

		// check the topic last visit time
		if ( $row['post_time'] > $topic_last_read )
		{
			$new_unreads[$topic_id] = $topic_last_read;
//-- fin mod : keep unread -------------------------------------------------------------------------
			$new_topic_data[ $row['forum_id'] ][ $row['topic_id'] ] = $row['post_time'];
		}
		if ( isset($last_posts[ $row['topic_last_post_id'] ]) )
		{
			// topic title censor
			if ( count($orig_word) )
			{
				$row['topic_title'] = preg_replace($orig_word, $replacement_word, $row['topic_title']);
			}

			// store the added columns
			$idx = $tree['keys'][POST_FORUM_URL . $row['forum_id'] ];
			@reset($row);
			while ( list($key, $value) = @each($row) )
			{
				$nkey = intval($key);
				if ( $key != "$nkey" )
				{
					$tree['data'][$idx][$key] = $row[$key];
				}
			}
		}
	}

//-- mod : keep unread -----------------------------------------------------------------------------
//-- add
	// update the unread topics from the list readed
	$board_config['tracking_unreads'] = $new_unreads;

	// except the cookies
	write_cookies($userdata);
//-- fin mod : keep unread -------------------------------------------------------------------------

	// set the unread flag
	$tree['unread_topics'] = array();
	for ($i=0; $i < count($tree['data']); $i++)
	{
		if ( $tree['type'][$i] == POST_FORUM_URL )
		{
			// get the last post time per forums
			$forum_id = $tree['id'][$i];
			$unread_topics = false;
			if ( !empty($new_topic_data[$forum_id]) )
			{
				$forum_last_post_time = 0;
				@reset($new_topic_data[$forum_id]);
				while( list($check_topic_id, $check_post_time) = @each($new_topic_data[$forum_id]) )
				{
//-- mod : keep unread -----------------------------------------------------------------------------
//-- delete
//					if ( empty($tracking_topics[$check_topic_id]) )
//					{
//-- fin mod : keep unread -------------------------------------------------------------------------
						$unread_topics = true;
						$forum_last_post_time = max($check_post_time, $forum_last_post_time);
//-- mod : keep unread -----------------------------------------------------------------------------
//-- delete
//					}
//					else
//					{
//						if ( $tracking_topics[$check_topic_id] < $check_post_time )
//						{
//							$unread_topics = true;
//							$forum_last_post_time = max($check_post_time, $forum_last_post_time);
//						}
//					}
//				}
//
//				// is there a cookie for this forum ?
//				if ( !empty($tracking_forums[$forum_id]) )
//				{
//					if ( $tracking_forums[$forum_id] > $forum_last_post_time )
//					{
//						$unread_topics = false;
//					}
//				}
//
//				// is there a cookie for all forums ?
//				if ( $tracking_all > $forum_last_post_time )
//				{
//					$unread_topics = false;
//-- fin mod : keep unread -------------------------------------------------------------------------
				}
			}

			// store the result
			$tree['unread_topics'][$i] = $unread_topics;
		}
	}

	return;
}

//--------------------------------------------------------------------------------------------------
//
// set_tree_user_auth() : enhance each row with auths and other things : use get_user_tree() as entry point
//
//--------------------------------------------------------------------------------------------------
function set_tree_user_auth()
{
	global $board_config, $userdata, $lang;
	global $tree;

	// read the tree from the bottom
	for ($i = count($tree['data']) - 1; $i >= 0; $i--)
	{
		//---------------------
		// full ids
		//---------------------
		$cur = $tree['type'][$i] . $tree['id'][$i];
		$main = $tree['main'][$i];
		$main_idx = ($main == 'Root') ? -1 : $tree['keys'][$main];

		//---------------------
		// auth view
		//---------------------
		$auth_view = false;
		if ( isset($tree['auth'][$cur]['auth_view']) )
		{
			// forum auth
			$auth_view = $tree['auth'][$cur]['auth_view'];
		}
		else if ( isset($tree['auth'][$cur]['tree.auth_view']) )
		{
			// categorie auth : get the sub level one
			$auth_view = $tree['auth'][$cur]['tree.auth_view'];
		}
		$tree['auth'][$cur]['auth_view'] = $auth_view;
		if ( !isset($tree['auth'][$cur]['tree.auth_view']) )
		{
			$tree['auth'][$cur]['tree.auth_view'] = $auth_view;
		}

		// grant the main level
		if ($main != 'Root')
		{
			$tree['auth'][$main]['tree.auth_view'] = ($tree['auth'][$main]['tree.auth_view'] || $tree['auth'][$cur]['tree.auth_view']);
		}

		//---------------------
		// auth read
		//---------------------
		$auth_read = false;
		if ( isset($tree['auth'][$cur]['auth_read']) )
		{
			// forum auth
			$auth_read = $tree['auth'][$cur]['auth_read'];
		}
		$tree['auth'][$cur]['auth_read'] = $auth_read;

		//---------------------
		// forum information
		//---------------------
		// locked status
		$locked = true;
		if ( isset($tree['data'][$i]['forum_status']) )
		{
			// forum info
			$locked = ($tree['data'][$i]['forum_status'] == FORUM_LOCKED);
		}
		else if ( isset($tree['data'][$i]['tree.locked']) )
		{
			// category info : get the sub levels one
			$locked = $tree['data'][$i]['tree.locked'];
		}
		$tree['data'][$i]['locked'] = $locked;

		// force lock status if no sub levels
		if ( !isset($tree['data'][$i]['tree.locked']) )
		{
			$tree['data'][$i]['tree.locked'] = $locked;
		}
		$tree['data'][$i]['tree.locked'] = ($tree['data'][$i]['tree.locked'] && $locked);

		// number of posts and topics
		if (!isset($tree['data'][$i]['tree.forum_posts']))
		{
			$tree['data'][$i]['tree.forum_posts'] = 0;
			$tree['data'][$i]['tree.forum_topics'] = 0;
		}
		if ($auth_view)
		{
			$tree['data'][$i]['tree.forum_posts'] += $tree['data'][$i]['forum_posts'];
			$tree['data'][$i]['tree.forum_topics'] += $tree['data'][$i]['forum_topics'];
		}

		// grant the main level
		if ($main != 'Root')
		{
			if ( !isset($tree['data'][$main_idx]['tree.locked']) )
			{
				$tree['data'][$main_idx]['tree.locked'] = $tree['data'][$i]['tree.locked'];
			}
			$tree['data'][$main_idx]['tree.locked'] = ($tree['data'][$main_idx]['tree.locked'] && $tree['data'][$i]['tree.locked']);

			// number of posts and topics
			if (!isset($tree['data'][$main_idx]['tree.forum_posts']))
			{
				$tree['data'][$main_idx]['tree.forum_posts'] = 0;
				$tree['data'][$main_idx]['tree.forum_topics'] = 0;
			}
			if ($auth_view)
			{
				$tree['data'][$main_idx]['tree.forum_posts'] += $tree['data'][$i]['tree.forum_posts'];
				$tree['data'][$main_idx]['tree.forum_topics'] += $tree['data'][$i]['tree.forum_topics'];
			}
		}

		//---------------------
		// last post
		//---------------------
		if ($auth_read)
		{
			// fill the sub
			if ( empty($tree['data'][$i]['tree.topic_last_post_id']) || ($tree['data'][$i]['post_time'] > $tree['data'][$i]['tree.post_time']) )
			{
				$tree['data'][$i]['tree.topic_last_post_id']	= $tree['data'][$i]['topic_last_post_id'];
				$tree['data'][$i]['tree.post_time']				= $tree['data'][$i]['post_time'];
				$tree['data'][$i]['tree.post_user_id']			= $tree['data'][$i]['user_id'];
				$tree['data'][$i]['tree.post_username']			= ($tree['data'][$i]['user_id'] != ANONYMOUS) ? $tree['data'][$i]['username'] : ( (!empty($tree['data'][$i]['post_username'])) ? $tree['data'][$i]['post_username'] : $lang['Guest'] );
				$tree['data'][$i]['tree.topic_title']			= $tree['data'][$i]['topic_title'];
				$tree['data'][$i]['tree.unread_topics']			= $tree['unread_topics'][$i];
			}
		}

		// grant the main level
		if ($main != 'Root')
		{
			if ( empty($tree['data'][$main_idx]['tree.topic_last_post_id']) || ($tree['data'][$i]['tree.post_time'] > $tree['data'][$main_idx]['tree.post_time']) )
			{
				$tree['data'][$main_idx]['tree.topic_last_post_id']	= $tree['data'][$i]['tree.topic_last_post_id'];
				$tree['data'][$main_idx]['tree.post_time']			= $tree['data'][$i]['tree.post_time'];
				$tree['data'][$main_idx]['tree.post_user_id']		= $tree['data'][$i]['tree.post_user_id'];
				$tree['data'][$main_idx]['tree.post_username']		= $tree['data'][$i]['tree.post_username'];
				$tree['data'][$main_idx]['tree.topic_title']		= $tree['data'][$i]['tree.topic_title'];
				$tree['data'][$main_idx]['tree.unread_topics']		= $tree['data'][$i]['tree.unread_topics'];
			}
		}
	}
}

//--------------------------------------------------------------------------------------------------
//
// get_user_tree() : generate the hierarchy tree - called in init_userprefs()
//
//--------------------------------------------------------------------------------------------------
function get_user_tree(&$userdata)
{
	global $tree;

	if (empty($tree)) read_tree();

	// read the user auth if requiered
	if (empty($tree['auth']))
	{
		$tree['auth'] = array();
		$wauth = auth(AUTH_ALL, AUTH_LIST_ALL, $userdata);
		if (!empty($wauth))
		{
			reset($wauth);
			while (list($key, $data) = each($wauth))
			{
				$tree['auth'][POST_FORUM_URL . $key] = $data;
			}
		}

		// enhanced each level
		set_tree_user_auth();
	}

	return;
}

//--------------------------------------------------------------------------------------------------
//
// get_auth_keys() : return an array() with only the viewable row id
// returned array :
//		$keys['keys'][id]		=> n,
//		$keys['id'][n]			=> id (used by $tree),
//		$keys['real_level'][n]	=> level in this auth-tree (root=-1),
//		$keys['level'][n]		=> level adjust for display (sub-level=parent level under certain conditions)
//		$keys['idx'][n]			=> idx (used by $tree)
//--------------------------------------------------------------------------------------------------
function get_auth_keys($cur='Root', $all=false, $level=-1, $max=-1, $auth_key='auth_view')
{
	global $board_config;
	global $tree;

	$keys = array();
	$last_i = -1;

	// add the level
	if ( ($cur == 'Root') || $tree['auth'][$cur][$auth_key] || $all)
	{
		// push the level
		if (($max < 0) || ($level < $max) || (($level==$max) && ((substr($tree['main'][$tree['keys'][$cur]], 0, 1) == POST_CAT_URL) || ($tree['main'][$tree['keys'][$cur]] == 'Root') )))
		{
			// if child of cat, align the level on the parent one
			$orig_level = $level;
			if (!$all)
			{
				if (($level > 0) && ((substr($cur, 0, 1) == POST_FORUM_URL) || (intval($board_config['sub_forum']) > 0)) && (substr($tree['main'][$tree['keys'][$cur]], 0, 1) == POST_CAT_URL)) $level = $level-1;
			}

			// store this level
			$last_i++;
			$keys['keys'][$cur]				= $last_i;
			$keys['id'][$last_i]			= $cur;
			$keys['real_level'][$last_i]	= $orig_level;
			$keys['level'][$last_i]			= $level;
			$keys['idx'][$last_i]			= (isset($tree['keys'][$cur]) ? $tree['keys'][$cur] : -1);

			// get sub-levels
			for ($i=0; $i < count($tree['sub'][$cur]); $i++)
			{
				$tkeys = array();
				$tkeys = get_auth_keys($tree['sub'][$cur][$i], $all, $orig_level+1, $max, $auth_key);

				// add sub-levels
				for ($j=0; $j < count($tkeys['id']); $j++)
				{
					$last_i++;
					$keys['keys'][$tkeys['id'][$j]] = $last_i;
					$keys['id'][$last_i]			= $tkeys['id'][$j];
					$keys['real_level'][$last_i]	= $tkeys['real_level'][$j];
					$keys['level'][$last_i]			= $tkeys['level'][$j];
					$keys['idx'][$last_i]			= $tkeys['idx'][$j];
				}
			}
		}
	}

	return $keys;
}

//--------------------------------------------------------------------------------------------------
//
// get_max_depth() : return the maximum level in the branch of the tree
//
//--------------------------------------------------------------------------------------------------
function get_max_depth($cur='Root', $all=false, $level=-1, &$keys, $max=-1)
{
	global $tree;
	if (empty($keys['id']))
	{
		$keys = array();
		$keys = get_auth_keys($cur, $all);
	}

	$max_level = 0;
	for ($i=0; $i < count($keys['id']); $i++)
	{
		if ($keys['level'][$i] > $max_level)
		{
			$max_level = $keys['level'][$i];
		}
	}
	return $max_level;
}

//-------------------------------------------------------------------------------------------------- 
// 
// get_tree_option() : return a drop down menu list of <option></option> 
// 
//-------------------------------------------------------------------------------------------------- 
function get_tree_option($cur='', $all=false) 
{ 
   global $tree, $lang; 

   $keys = array(); 
   $keys = get_auth_keys('Root', $all); 
   $last_level = -1; 

   for ($i=0; $i < count($keys['id']); $i++) 
   { 
      // only get object that are not forum links type 
      if ( ($tree['type'][ $keys['idx'][$i] ] != POST_FORUM_URL) || empty($tree['data'][ $keys['idx'][$i] ]['forum_link']) ) 
      { 
         $level = $keys['real_level'][$i]; 

         $inc = ''; 
         for ($k = 0; $k < $level; $k++) 
         { 
            $inc .= "[*$k*]&nbsp;&nbsp;&nbsp;"; 
         } 

         if ($level < $last_level) 
         { 
         //insert spacer if level goes down 
            $res .='<option value="-1">' . $inc . '|&nbsp;&nbsp;&nbsp;</option>'; 
         // make valid lines solid 
            $res = str_replace("[*$level*]", "|", $res); 

         // erase all unnessecary lines 
            for ($k = $level + 1; $k < $last_level; $k++) 
            { 
               $res = str_replace("[*$k*]", "&nbsp;", $res); 
            } 
             
         } elseif ($level == 0 && $last_level == -1) $res .='<option value="-1">|</option>'; 

         $last_level = $level; 

         $selected = ($cur == $keys['id'][$i]) ? ' selected="selected"' : ''; 
         $res .= '<option value="' . $keys['id'][$i] . '"' .  $selected . '>'; 

         // name 
         $name = get_object_lang($keys['id'][$i], 'name', $all); 

         if ($keys['level'][$i] >=0) $res .= $inc . '|--'; 

         $res .= $name . '</option>'; 
      } 
   } 

   // erase all unnessecary lines 
   for ($k = 0; $k < $last_level; $k++) 
   { 
      $res = str_replace("[*$k*]", "&nbsp;", $res); 
   } 

   return $res; 
}

//--------------------------------------------------------------------------------------------------
//
// build_index() : display a level and its sublevels : use dislay_index() as entry point
//
//--------------------------------------------------------------------------------------------------
function build_index($cur='Root', $cat_break=false, &$forum_moderators, $real_level=-1, $max_level=-1, &$keys)
{
	global $template, $phpEx, $board_config, $lang, $images, $db, $userdata;
	global $tree;
	//
	// init
	//
	$display = false;

	// get the sub_forum switch value
	$sub_forum = intval($board_config['sub_forum']);
	if (($sub_forum == 2) && defined('IN_VIEWFORUM'))
	{
		$sub_forum = 1;
	}
	$pack_first_level = ($sub_forum == 2);

	// verify the cat_break parm
	if (($cur != 'Root') && ($real_level == -1)) $cat_break = false;

	// display the level
	$ch_this = isset($tree['keys'][$cur]) ? $tree['keys'][$cur] : -1;

	//
	// display each kind of row
	//

	// root level head
	if ($real_level == -1)
	{
		// get max inc level
		$max = -1;
		if ($sub_forum == 2) $max = 0;
		if ($sub_forum == 1) $max = 1;
		$keys = array();
		$keys = get_auth_keys($cur, false, -1, $max);
		$max_level = get_max_depth($cur, false, -1, $keys, $max);
	}

	// table header
	if (($board_config['split_cat'] && $cat_break && ($real_level==0)) || ((!$board_config['split_cat'] || !$cat_break) && ($real_level==-1)))
	{
		// if break, get the local max level
		if ($board_config['split_cat'] && $cat_break && ($real_level==0))
		{
			$max_level = 0;
			// the array is sorted
			$start = false;
			$stop = false;
			for ($i=0; ($i < count($keys['id']) && !$stop); $i++)
			{
				if ( $start && ($tree['main'][$keys['idx'][$i]] == $tree['main'][$ch_this]))
				{
					$stop = true;
					$break;
				}
				if ($keys['id'][$i] == $cur) $start = true;
				if ($start && !$stop && ($keys['level'][$i] > $max_level)) $max_level = $keys['level'][$i];
			}
		}
		$template->assign_block_vars('catrow', array());
		$template->assign_block_vars('catrow.tablehead', array(
			'L_FORUM'	=> ($ch_this < 0) ? $lang['Forum'] : get_object_lang($cur, 'name'),
			'INC_SPAN'	=> $max_level+2,
			)
		);
	}

	// get the level
	$level = $keys['level'][$keys['keys'][$cur]];

	// sub-forum view management
	$pull_down = true;
	if ($sub_forum > 0)
	{
		$pull_down = false;
		if (($real_level==0) && ($sub_forum == 1)) $pull_down = true;
	}

	if ($level >=0 )
	{
		// cat header row
		if ( ($tree['type'][$ch_this] == POST_CAT_URL) && $pull_down)
		{
			// display a cat row
			$cat = $tree['data'][$ch_this];
			$cat_id = $tree['id'][$ch_this];

			// get the class colors
			$class_cat	= "cat";
			$class_cat		= "cat";
			$class_rowpic	= "rowpic";

			// send to template
			$template->assign_block_vars('catrow', array());
			$template->assign_block_vars('catrow.cat', array(
				'CAT_TITLE'			=> get_object_lang($cur, 'name'),
				'CAT_DESC'			=> ereg_replace('<[^>]+>', '', get_object_lang($cur, 'desc')),

				'CLASS_cat'		=> $class_cat,
				'CLASS_CAT'			=> $class_cat,
				'CLASS_ROWPIC'		=> $class_rowpic,
				'INC_SPAN'			=> $max_level - $level+2,

				'U_VIEWCAT'			=> append_sid("index.$phpEx?" . POST_CAT_URL . "=$cat_id"),
				)
			);


			// add indentation to the display
			for ($k=1; $k <= $level; $k++)
			{
				$template->assign_block_vars('catrow.cat.inc', array(
					'INC_CLASS' => ($k % 2) ?  'row1' : 'row2',
					)
				);
			}

			// something displayed
			$display = true;
		}
	}

	// forum header row
	if ($level >= 0)
	{
		if ( ($tree['type'][$ch_this] == POST_FORUM_URL) || (($tree['type'][$ch_this] == POST_CAT_URL) && !$pull_down))
		{
			// get the data
			$data	= $tree['data'][$ch_this];
			$id		= $tree['id'][$ch_this];
			$type	= $tree['type'][$ch_this];
			$sub	= (!empty($tree['sub'][$cur]) && $tree['auth'][$cur]['tree.auth_view']);

			// specific to the data type
			$title	= get_object_lang($cur, 'name');
			$desc	= get_object_lang($cur, 'desc');

			// specific to something attached
			if ($sub)
			{
				$i_new		= $images['category_new'];
				$a_new		= $lang['New_posts'];
				$i_norm		= $images['category'];
				$a_norm		= $lang['No_new_posts'];
				$i_locked	= $images['category_locked'];
				$a_locked	= $lang['Forum_locked'];
			}
			else
			{
				$i_new		= $images['forum_new'];
				$a_new		= $lang['New_posts'];
				$i_norm		= $images['forum'];
				$a_norm		= $lang['No_new_posts'];
				$i_locked	= $images['forum_locked'];
				$a_locked	= $lang['Forum_locked'];
			}

			// forum link type
			if (($tree['type'][$ch_this] == POST_FORUM_URL) && !empty($tree['data'][$ch_this]['forum_link']))
			{
				$i_new		= $images['link'];
				$a_new		= $lang['Forum_link'];
				$i_norm		= $images['link'];
				$a_norm		= $lang['Forum_link'];
				$i_locked	= $images['link'];
				$a_locked	= $lang['Forum_link'];
			}

			// front icon
			$folder_image = ( $data['tree.unread_topics'] ) ? $i_new : $i_norm;
			$folder_alt   = ( $data['tree.unread_topics'] ) ? $a_new : $a_norm;
			if ($data['tree.locked'])
			{
				$folder_image	= $i_locked;
				$folder_alt		= $a_locked;
			}

			// moderators list
			$l_moderators	= '';
			$moderator_list = '';
			if ($type == POST_FORUM_URL)
			{
				if ( count($forum_moderators[$id]) > 0 )
				{
					$l_moderators = ( count($forum_moderators[$id]) == 1 ) ? $lang['Moderator'] : $lang['Moderators'];
					$moderator_list = implode(', ', $forum_moderators[$id]);
				}
			}

			// last post
			$last_post = $lang['No_Posts'];
			if ( $data['tree.topic_last_post_id'] )
			{
				// resize
				$topic_title = $data['tree.topic_title'];
				if ( strlen($topic_title) > (intval($board_config['last_topic_title_length'])-3) ) $topic_title = substr($topic_title, 0, intval($board_config['last_topic_title_length'])) . '...';
				$topic_title = '<a href="' . append_sid("viewtopic.$phpEx?"  . POST_POST_URL . "=" . $data['tree.topic_last_post_id']) . '#' . $data['tree.topic_last_post_id'] . '" title="' . $data['tree.topic_title'] . '">' . $topic_title . '</a><br />';

//-- mod : today at   yesterday at ------------------------------------------------------------------------ 
//-- add 
                $last_post_time = create_date_day($board_config['default_dateformat'], $data['tree.post_time'], $board_config['board_timezone']); 
//-- end mod : today at   yesterday at ------------------------------------------------------------------------ 
				$last_post  = (($board_config['last_topic_title']) ? $topic_title : '');
				$last_post .= $last_post_time . '<br />';
				$last_post .= ( $data['tree.post_user_id'] == ANONYMOUS ) ? $data['tree.post_username'] . ' ' : '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '='  . $data['tree.post_user_id']) . '">' . $data['tree.post_username'] . '</a> ';
				$last_post .= '<a href="' . append_sid("viewtopic.$phpEx?"  . POST_POST_URL . '=' . $data['tree.topic_last_post_id']) . '#' . $data['tree.topic_last_post_id'] . '"><img src="' . $images['icon_latest_reply'] . '" border="0" alt="' . $lang['View_latest_post'] . '" title="' . $lang['View_latest_post'] . '" /></a>';
			}

			// links to sub-levels
			$links = '';
			if ( $sub && ( !$pull_down || ( ($type == POST_FORUM_URL) && ($sub_forum > 0) ) ) && (intval($board_config['sub_level_links']) > 0) )
			{
				for ($j=0; $j < count($tree['sub'][$cur]); $j++) if ($tree['auth'][ $tree['sub'][$cur][$j] ]['auth_view'])
				{
					$wcur	= $tree['sub'][$cur][$j];
					$wthis	= $tree['keys'][$wcur];
					$wdata	= $tree['data'][$wthis];
					$wname	= get_object_lang($wcur, 'name');
					$wdesc	= get_object_lang($wcur, 'desc');
					switch($tree['type'][$wthis])
					{
						case POST_FORUM_URL:
							$wpgm = append_sid("./viewforum.$phpEx?" . POST_FORUM_URL . '=' . $tree['id'][$wthis]);
							break;
						case POST_CAT_URL:
							$wpgm = append_sid("./index.$phpEx?" . POST_CAT_URL . '=' . $tree['id'][$wthis]);
							break;
						default:
							$wpgm = append_sid("./index.$phpEx");
							break;
					}
					$link = '';
					$wdesc = ereg_replace('<[^>]+>', '', $wdesc);
					if ($wname != '') $link = '<a href="' . $wpgm . '" title="' . $wdesc . '" class="gensmall">' . $wname . '</a>';

					if (intval($board_config['sub_level_links']) == 2)
					{
						$wsub = (!empty($tree['sub'][$wcur]) && $tree['auth'][$wcur]['tree.auth_view']);

						// specific to something attached
						if ($wsub)
						{
							$wi_new		= $images['icon_minicat_new'];
							$wa_new		= $lang['New_posts'];
							$wi_norm	= $images['icon_minicat'];
							$wa_norm	= $lang['No_new_posts'];
							$wi_locked	= $images['icon_minicat_locked'];
							$wa_locked	= $lang['Forum_locked'];
						}
						else
						{
							$wi_new		= $images['icon_minipost_new'];
							$wa_new		= $lang['icon_minipost'];
							$wi_norm	= $images['icon_minipost'];
							$wa_norm	= $lang['No_new_posts'];
							$wi_locked	= $images['icon_minipost_lock'];
							$wa_locked	= $lang['Forum_locked'];
						}

						// forum link type
						if (($tree['type'][$wthis] == POST_FORUM_URL) && !empty($wdata['forum_link']))
						{
							$wi_new		= $images['icon_minilink'];
							$wa_new		= $lang['Forum_link'];
							$wi_norm	= $images['icon_minilink'];
							$wa_norm	= $lang['Forum_link'];
							$wi_locked	= $images['icon_minilink'];
							$wa_locked	= $lang['Forum_link'];
						}

						// front icon
						$wfolder_image	= ( $wdata['tree.unread_topics'] ) ? $wi_new : $wi_norm;
						$wfolder_alt	= ( $wdata['tree.unread_topics'] ) ? $wa_new : $wa_norm;
						if ($wdata['tree.locked'])
						{
							$wfolder_image	= $wi_locked;
							$wfolder_alt	= $wa_locked;
						}
						$wlast_post  = '<a href="' . append_sid("./viewtopic.$phpEx?"  . POST_POST_URL . '=' . $wdata['tree.topic_last_post_id']) . '#' . $wdata['tree.topic_last_post_id'] . '">';
						$wlast_post .= '<img src="' . $wfolder_image . '" border="0" alt="' . $wfolder_alt . '" title="' . $wfolder_alt . '" align="middle" /></a>';
					}
					if ($link != '') $links .= (($links != '') ? ', ' : '') . $wlast_post . $link;
				}
			}

			// forum icon
			$icon_img = empty($data['icon']) ? '' : ( isset($images[ $data['icon'] ]) ? $images[ $data['icon'] ] : $data['icon'] );

//
// Begin Approve_Mod Block : 1
//
							$approve_mod = array();
							$approve_sql = "SELECT enabled, approve_moderators, forum_hide_unapproved_posts, forum_hide_unapproved_topics
								FROM " . APPROVE_FORUMS_TABLE . " 
								WHERE forum_id = " . intval($id) . " LIMIT 0,1"; 
							if ( !($approve_result = $db->sql_query($approve_sql)) ) 
							{ 
								message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
							} 
							if ( $approve_row = $db->sql_fetchrow($approve_result) ) 
							{    
								if ( intval($approve_row['enabled']) == 1 )
								{
									$approve_mod = $approve_row;
									$approve_mod['enabled'] = true;
								}
							}
							if ( $approve_mod['enabled'] )
							{
								if ( $data['tree.post_user_id'] == ANONYMOUS || $approve_mod['forum_hide_unapproved_posts'] || $approve_mod['forum_hide_unapproved_topics'] )
								{
									
									$approve_mod['moderators'] = explode('|', get_moderators_user_id_of_forum($id));
									
									if ( !in_array($userdata['user_id'], $approve_mod['moderators']) && $tree['auth'][$cur]['tree.auth_view'] && $last_post != $lang['No_Posts'] )
									{
										$approve_sql = "SELECT * 
											FROM " . APPROVE_POSTS_TABLE . " 
											WHERE post_id = " . intval($data['tree.topic_last_post_id']) . " 
											LIMIT 0,1"; 
										if ( !$approve_result = $db->sql_query($approve_sql) ) 
										{ 
											message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
										}	
										$approve_row = $db->sql_fetchrow($approve_result);
										if ( intval($approve_row['post_id']) == intval($data['tree.topic_last_post_id']) )
										{
											if ( $approve_mod['forum_hide_unapproved_posts'] || $approve_mod['forum_hide_unapproved_topics'] )
											{
												$approve_sql = "SELECT p.post_id, p.poster_id, p.post_time, p.post_username, u.username, u.user_id, t.topic_title, t.topic_last_post_id 
													FROM " . POSTS_TABLE . " p, " . USERS_TABLE . " u, " . TOPICS_TABLE . " t
													WHERE p.forum_id = " . intval($id) . "
													AND u.user_id = p.poster_id 
													AND t.topic_id = p.topic_id
													ORDER BY p.post_time DESC";
												if ( !($approve_result = $db->sql_query($approve_sql)) ) 
												{ 
													message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
												} 
												while( $approve_row = $db->sql_fetchrow($approve_result) )
												{
													$approve_sql = "SELECT * FROM " . APPROVE_POSTS_TABLE . " 
														WHERE post_id = " . intval($approve_row['post_id']) . " 
														LIMIT 0,1";
													if ( !($approve_result2 = $db->sql_query($approve_sql)) ) 
													{ 
														message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
													} 
													$approve_row2 = $db->sql_fetchrow($approve_result2);
													if ( !$approve_row2['post_id'] )
													{
														// resize
														$topic_title = $approve_row['topic_title'];
														if ( strlen($topic_title) > (intval($board_config['last_topic_title_length'])-3) ) $topic_title = substr($topic_title, 0, intval($board_config['last_topic_title_length'])) . '...';
														$topic_title = '<a href="' . append_sid("viewtopic.$phpEx?"  . POST_POST_URL . "=" . $approve_row['topic_last_post_id']) . '#' . $approve_row['topic_last_post_id'] . '" title="' . $approve_row['topic_title'] . '">' . $topic_title . '</a><br />';

														$last_post  = (($board_config['last_topic_title']) ? $topic_title : '');
														$last_post_time = create_date($board_config['default_dateformat'], $approve_row['post_time'], $board_config['board_timezone']);
														$last_post .= $last_post_time . '<br />';

														$last_post .= ( $approve_row['user_id'] == ANONYMOUS ) ? ( ($approve_row['post_username'] != '' ) ? $approve_row['post_username'] . ' ' : $lang['Guest'] . ' ' ) : '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '='  . $approve_row['poster_id']) . '">' . $approve_row['username'] . '</a> ';
														
														$last_post .= '<a href="' . append_sid("viewtopic.$phpEx?"  . POST_POST_URL . '=' . $approve_row['post_id']) . '#' . $approve_row['post_id'] . '"><img src="' . $images['icon_latest_reply'] . '" border="0" alt="' . $lang['View_latest_post'] . '" title="' . $lang['View_latest_post'] . '" /></a>';
														break;
													}
												}		
											}
											else
											{
												$last_post = $last_post_time . '<br />';
												$last_post .= $lang['Guest'] . '  ' . '<a href="' . append_sid("viewforum.$phpEx?"  . POST_FORUM_URL . '=' . $data['tree.forum_id']) . '"><img src="' . $images['icon_latest_reply'] . '" border="0" alt="' . $lang['View_latest_post'] . '" title="' . $lang['View_latest_post'] . '" /></a>';
											}
										}
									}
								}
							}
//
// End Approve_Mod Block : 1
//

			// send to template
			$template->assign_block_vars('catrow', array());
			$template->assign_block_vars('catrow.forumrow',	array(
				'FORUM_FOLDER_IMG'		=> $folder_image, 
				'ICON_IMG'				=> $icon_img,
				'FORUM_NAME'			=> $title,
				'FORUM_DESC'			=> $desc,
				'POSTS'					=> $data['tree.forum_posts'],
				'TOPICS'				=> $data['tree.forum_topics'],
				'LAST_POST'				=> $last_post,
				'MODERATORS'			=> $moderator_list,
				'L_MODERATOR'			=> empty($moderator_list) ? '' : ( empty($l_moderators) ? '<br />' : '<br /><b>' . $l_moderators . ':</b>&nbsp;' ),
				'L_LINKS'				=> empty($links) ? '' : ( empty($lang['Subforums']) ? '<br />' : '<br /><b>' . $lang['Subforums'] . ':</b>&nbsp;' ),
				'LINKS'					=> $links,
				'L_FORUM_FOLDER_ALT'	=> $folder_alt, 
				'U_VIEWFORUM'			=> ($type == POST_FORUM_URL) ? append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$id") : append_sid("index.$phpEx?" . POST_CAT_URL . "=$id"),
				
				'INC_SPAN'				=> $max_level- $level+1,
				'INC_CLASS'				=> ( !($level % 2) ) ? 'row1' : 'row2',
				)
			);

			// display icon
			if ( !empty($icon_img) )
			{
				$template->assign_block_vars('catrow.forumrow.forum_icon', array());
			}

			// add indentation to the display
			for ($k=1; $k <= $level; $k++)
			{
				$template->assign_block_vars('catrow.forumrow.inc', array(
					'INC_CLASS' => ($k % 2) ?  'row1' : 'row2',
					)
				);
			}

			// forum link type
			if (($tree['type'][$ch_this] == POST_FORUM_URL) && !empty($tree['data'][$ch_this]['forum_link']))
			{
				$s_hit_count = '';
				if ($tree['data'][$ch_this]['forum_link_hit_count'])
				{
					$s_hit_count = sprintf($lang['Forum_link_visited'], $tree['data'][$ch_this]['forum_link_hit']);
				}
				$template->assign_block_vars('catrow.forumrow.forum_link', array(
					'HIT_COUNT' => $s_hit_count,
					)
				);
			}
			else
			{
				$template->assign_block_vars('catrow.forumrow.forum_link_no', array());
			}

			// something displayed
			$display = true;
		}
	}

	// display sub-levels
	for ($i=0; $i < count($tree['sub'][$cur]); $i++) if (!empty($keys['keys'][$tree['sub'][$cur][$i]]))
	{
		$wdisplay = build_index($tree['sub'][$cur][$i], $cat_break, $forum_moderators, $level+1, $max_level, $keys);
		if ($wdisplay) $display = true;
	}

	if ($level >=0 )
	{
		// forum footer row
		if ($tree['type'][$ch_this] == POST_FORUM_URL)
		{
		}
	}

	if ($level >=0 )
	{
		// cat footer
		if ( ($tree['type'][$ch_this] == POST_CAT_URL) && $pull_down)
		{
			$template->assign_block_vars('catrow', array());
			$template->assign_block_vars('catrow.catfoot', array('INC_SPAN' => $max_level - $level+5));

			// add indentation to the display
			for ($k=1; $k <= $level; $k++)
			{
				$template->assign_block_vars('catrow.catfoot.inc', array(
					'INC_SPAN' => $max_level - $level+5,
					'INC_CLASS' => ($k % 2) ?  'row1' : 'row2',
					)
				);
			}
		}
	}

	// root level footer
	if (($board_config['split_cat'] && $cat_break && $real_level==0) || ((!$board_config['split_cat'] || !$cat_break) && $real_level==-1))
	{
		$template->assign_block_vars('catrow', array());
		$template->assign_block_vars('catrow.tablefoot', array());
	}

	return $display;
}

//--------------------------------------------------------------------------------------------------
//
// display_index() : display the index using the tpl var {BOARD_INDEX}, return true if the index is not empty
//
//--------------------------------------------------------------------------------------------------
function display_index($cur='Root')
{
	global $board_config, $template, $userdata, $lang, $db, $nav_links, $phpEx;
	global $images, $nav_separator, $nav_cat_desc;
	global $tree;

	$template->set_filenames(array(
		'index' => 'index_box.tpl')
	);

	// moderators list
	$forum_moderators = array();
	@reset($tree['mods']);
	while ( list($idx, $data) = @each($tree['mods']) )
	{
		if ( $tree['type'][$idx] == POST_FORUM_URL )
		{
			for ( $i = 0; $i < count($data['user_id']); $i++ )
			{
				$forum_moderators[ $tree['id'][$idx] ][] = '<a href="' . append_sid("./profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $data['user_id'][$i]) . '">' . $data['username'][$i] . '</a>';
			}
			for ( $i = 0; $i < count($data['group_id']); $i++ )
			{
				$forum_moderators[ $tree['id'][$idx] ][] = '<a href="' . append_sid("./groupcp.$phpEx?" . POST_GROUPS_URL . "=" . $data['group_id'][$i]) . '">' . $data['group_name'][$i] . '</a>';
			}
		}
	}

	// let's dump all of this on the template
	$keys = array();
	$display = build_index($cur, $board_config['split_cat'], $forum_moderators, -1, -1, $keys);

	// constants
	$template->assign_vars(array(
		'L_FORUM' => $lang['Forum'],
		'L_TOPICS' => $lang['Topics'],
		'L_POSTS' => $lang['Posts'],
		'L_LASTPOST' => $lang['Last_Post'],
		)
	);
	$template->assign_vars(array(
		'SPACER'		=> $images['spacer'],
		'NAV_SEPARATOR' => $nav_separator,
		'NAV_CAT_DESC'	=> $nav_cat_desc,
		'NAV_CURRENT'   => get_object_lang($cur, 'name'), // Correct Titles :: Added
		)
	);
	if ($display) $template->assign_var_from_handle('BOARD_INDEX', 'index');

	return $display;
}

//--------------------------------------------------------------------------------------------------
//
// make_cat_nav_tree() : build the nav sentence
//
//--------------------------------------------------------------------------------------------------
function make_cat_nav_tree($cur, $pgm='', $nav_class='nav')
{
	global $phpbb_root_path, $phpEx, $db;
	global $global_orig_word, $global_replacement_word;
	global $nav_separator;
	global $tree;

	// get topic or post level
	$type = substr($cur, 0, 1);
	$id = intval(substr($cur,1));
	$topic_title = '';
	$fcur = '';
	switch ($type)
	{
		case POST_TOPIC_URL:
			$sql = "SELECT forum_id, topic_title 
						FROM " . TOPICS_TABLE . " WHERE topic_id = $id";
			if ( !($result = $db->sql_query($sql)) ) message_die(GENERAL_ERROR, 'Could not query topics information', '', __LINE__, __FILE__, $sql);
			if ($row = $db->sql_fetchrow($result))
			{
				$fcur = POST_FORUM_URL . $row['forum_id'];
				$topic_title = $row['topic_title'];
				$orig_word = array();
				$remplacement_word = array();
				obtain_word_list($orig_word, $replacement_word);
				if ( count($orig_word) )
				{
					$topic_title = preg_replace($orig_word, $replacement_word, $topic_title);
				}
			}
			break;
		case POST_POST_URL:
			$sql = "SELECT t.forum_id, t.topic_title 
						FROM " . POSTS_TABLE . " p, " . TOPICS_TABLE . " t 
						WHERE t.topic_id=p.topic_id AND post_id = $id";
			if ( !($result = $db->sql_query($sql)) ) message_die(GENERAL_ERROR, 'Could not query posts information', '', __LINE__, __FILE__, $sql);
			if ($row = $db->sql_fetchrow($result))
			{
				$fcur = POST_FORUM_URL . $row['forum_id'];
				$topic_title = $row['topic_title'];
				$orig_word = array();
				$remplacement_word = array();
				obtain_word_list($orig_word, $replacement_word);
				if ( count($orig_word) )
				{
					$topic_title = preg_replace($orig_word, $replacement_word, $topic_title);
				}
			}
			break;
	}

	// keep the compliancy with prec versions
	if (!isset($tree['keys'][$cur])) $cur = isset($tree['keys'][POST_CAT_URL . $cur]) ? POST_CAT_URL . $cur : $cur;

	// find the object
	$ch_this = isset($tree['keys'][$cur]) ? $tree['keys'][$cur] : -1;

	$res = '';
	while (($ch_this >= 0) || ($fcur != ''))
	{
		$type = (substr($fcur, 0, 1) != '') ? substr($cur, 0, 1) : $tree['type'][$ch_this];
		switch($type)
		{
			case POST_CAT_URL:
				$field_name		= get_object_lang($cur, 'name');
				$param_type		= POST_CAT_URL;
				$param_value	= $tree['id'][$ch_this];
				$pgm_name		= "index.$phpEx";
				break;
			case POST_FORUM_URL:
				$field_name		= get_object_lang($cur, 'name');
				$param_type		= POST_FORUM_URL;
				$param_value	= $tree['id'][$ch_this];
				$pgm_name		= "viewforum.$phpEx";
				break;
			case POST_TOPIC_URL:
				$field_name		= $topic_title;
				$param_type		= POST_TOPIC_URL;
				$param_value	= $id;
				$pgm_name		= "viewtopic.$phpEx";
				break;
			case POST_POST_URL:
				$field_name		= $topic_title;
				$param_type		= POST_POST_URL;
				$param_value	= $id . '#' . $id;
				$pgm_name		= "viewtopic.$phpEx";
				break;
			default :
				$field_name		= '';
				$param_type		= '';
				$param_value	= '';
				$pgm_name		= "index.$phpEx";
				break;
		}
		if ($pgm != '') $pgm_name = "$pgm.$phpEx";

		if (!empty($field_name)) $res = '<a href="' . append_sid('./' . $pgm_name . (($field_name != '') ? "?$param_type=$param_value" : '')) . '" class="' . $nav_class . '">' . $field_name . '</a>' . (($res != '') ? $nav_separator . $res : '');

		// find parent object
		if ($fcur != '')
		{
			$cur	= $fcur;
			$pgm	= '';
			$fcur	= '';
			$topic_title = '';
		}
		else
		{
			$cur = $tree['main'][$ch_this];
		}
		$ch_this = isset($tree['keys'][$cur]) ? $tree['keys'][$cur] : -1;
	}

	return $res;
}

//--------------------------------------------------------------------------------------------------
//
// jumpbox() : replace the original phpBB make_jumpbox()
//
//--------------------------------------------------------------------------------------------------
function jumpbox($action, $match_forum_id = 0)
{
	global $template, $userdata, $lang, $db, $nav_links, $phpEx, $SID;
	global $links;

	// build the jumpbox
	$boxstring  = '<select name="selected_id" onchange="if(this.options[this.selectedIndex].value != -1){ forms[\'jumpbox\'].submit() }">';
	$boxstring .= '<option value="-1">' . $lang['Select_forum'] . '</option><option value="-1"></option>' . get_tree_option(POST_FORUM_URL . $match_forum_id);
	$boxstring .= '</select>';

	// add SID if missing
	if ( !empty($SID) )
	{
		$boxstring .= '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';
	}

	// dump this to template
	$template->set_filenames(array(
		'jumpbox' => 'jumpbox.tpl')
	);
	$template->assign_vars(array(
		'L_GO' => $lang['Go'],
		'L_JUMP_TO' => $lang['Jump_to'],
		'L_SELECT_FORUM' => $lang['Select_forum'],

		'S_JUMPBOX_SELECT' => $boxstring,
		'S_JUMPBOX_ACTION' => append_sid($action))
	);
	$template->assign_var_from_handle('JUMPBOX', 'jumpbox');

	return;
}

//--------------------------------------------------------------------------------------------------
//
// selectbox() : replace the original phpBB function_admin/make_forum_select()
//
//--------------------------------------------------------------------------------------------------
function selectbox($box_name, $ignore_forum = false, $select_forum = '', $all=false)
{
	$s_id = ($select_forum != '') ? POST_FORUM_URL . $select_forum : '';
	$s_list = get_tree_option($select_forum, $all);
	$res = '<select name="' . $box_name . '">' . $s_list . '</select>';
	return $res;
}

?>
