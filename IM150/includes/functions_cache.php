<?php
/***************************************************************************
 *							functions_cache.php
 *							----------------------
 *	begin			: 15/12/2003
 *	copyright		: Ptirhiik
 *	email			: ptirhiik@clanmckeen.com
 *
 *	version			: 1.0.2 - 20/07/2004
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

if (!defined('IN_PHPBB'))
{
	die('Hacking attempt');
}
include_once($phpbb_root_path . 'includes/template.' . $phpEx);

define('CACHE_WORDS', true);
define('CACHE_THEMES', true);
define('CACHE_SMILIES', true);
define('CACHE_RANKS', true);
define('CACHE_BIRTHDAY', true);
define('CACHE_TREE', true);

//--------------------------------------------------------------------------------------------------
//
// users_stats : update the board users stats into config table
//
//--------------------------------------------------------------------------------------------------
function users_stats()
{
	global $board_config, $userdata;
	global $phpbb_root_path, $phpEx, $db;

	// read registered users info (number and last)
	$sql = "SELECT user_id, username
				FROM " . USERS_TABLE . " 
				WHERE user_id > 0
				ORDER BY user_id DESC";
	if ( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Couldn\'t access users table', '', __LINE__, __FILE__, $sql);
	}
	$max_users = $db->sql_numrows($result);
	$last_user = $db->sql_fetchrow($result);

	// is there a change in the number ?
	if ( intval($board_config['max_users']) != $max_users )
	{
		if ( isset($board_config['max_users']) )
		{
			$board_config['max_users'] = $max_users;
			$sql = "UPDATE " . CONFIG_TABLE . " 
						SET config_value = " . intval($board_config['max_users']) . " 
						WHERE config_name = 'max_users'";
		}
		else
		{
			$board_config['max_users'] = $max_users;
			$sql = "INSERT INTO " . CONFIG_TABLE . " 
						(config_name, config_value)
						VALUES( 'max_users', " . intval($board_config['max_users']) . ")";
		}
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Couldn\'t update/create config table', '', __LINE__, __FILE__, $sql);
		}
	}

	// is there a change in the last user ?
	if ( ($last_user['user_id'] != $board_config['record_last_user_id']) || ($last_user['username'] != $board_config['record_last_username']) )
	{
		// last user id
		if ( isset($board_config['record_last_user_id']) )
		{
			$board_config['record_last_user_id'] = $last_user['user_id'];
			$sql = "UPDATE " . CONFIG_TABLE . " 
						SET config_value = " . intval($board_config['record_last_user_id']) . " 
						WHERE config_name = 'record_last_user_id'";
		}
		else
		{
			$board_config['record_last_user_id'] = $last_user['user_id'];
			$sql = "INSERT INTO " . CONFIG_TABLE . " 
						(config_name, config_value)
						VALUES( 'record_last_user_id', " . intval($board_config['record_last_user_id']) . ")";
		}
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Couldn\'t update/create config table', '', __LINE__, __FILE__, $sql);
		}

		// last username
		if ( isset($board_config['record_last_username']) )
		{
			$board_config['record_last_username'] = $last_user['username'];
			$sql = "UPDATE " . CONFIG_TABLE . " 
						SET config_value = '" . str_replace("\'", "''", $board_config['record_last_username']) . "'
						WHERE config_name = 'record_last_username'";
		}
		else
		{
			$board_config['record_last_username'] = $last_user['username'];
			$sql = "INSERT INTO " . CONFIG_TABLE . " 
						(config_name, config_value)
						VALUES( 'record_last_username', '" . str_replace("\'", "''", $board_config['record_last_username']) . "')";
		}
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Couldn\'t update/create config table', '', __LINE__, __FILE__, $sql);
		}
	}
}

//--------------------------------------------------------------------------------------------------
//
// board_stats : update the board stats (topics & posts) into config table
//
//--------------------------------------------------------------------------------------------------
function board_stats()
{
	global $db, $board_config;

	// read topics and posts info
	$sql = "SELECT SUM(forum_topics) AS topic_total, SUM(forum_posts) AS post_total 
				FROM " . FORUMS_TABLE;
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
		if ( isset($board_config['max_topics']) )
		{
			$board_config['max_topics'] = $max_topics;
			$sql = "UPDATE " . CONFIG_TABLE . " 
						SET config_value = " . intval($board_config['max_topics']) . " 
						WHERE config_name = 'max_topics'";
		}
		else
		{
			$board_config['max_topics'] = $max_topics;
			$sql = "INSERT INTO " . CONFIG_TABLE . " 
						(config_name, config_value)
						VALUES('max_topics', " . intval($board_config['max_topics']) . ")";
		}
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Couldn\'t update config table', '', __LINE__, __FILE__, $sql);
		}
	}
	if ( $board_config['max_posts'] != $max_posts )
	{
		if ( isset($board_config['max_posts']) )
		{
			$board_config['max_posts'] = $max_posts;
			$sql = "UPDATE " . CONFIG_TABLE . " 
						SET config_value = " . intval($board_config['max_posts']) . " 
						WHERE config_name = 'max_posts'";
		}
		else
		{
			$board_config['max_posts'] = $max_posts;
			$sql = "INSERT INTO " . CONFIG_TABLE . " 
						(config_name, config_value)
						VALUES('max_posts', " . intval($board_config['max_posts']) . ")";
		}
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Couldn\'t update config table', '', __LINE__, __FILE__, $sql);
		}
	}
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
	$cache_path = 'includes/';
	$cache_file = 'def_tree';
	$handle = @fopen($phpbb_root_path . $cache_path . $cache_file . '.' . $phpEx, 'w');
	@flock($fp, LOCK_EX);
	@fwrite($handle, $res);
	@flock($fp, LOCK_UN);
	@fclose($handle);
	@umask(0000);
	@chmod($phpbb_root_path . $cache_path . $cache_file . '.' . $phpEx, 0666);
}

function cache_tree_level($main, &$parents, &$cats, &$forums, $level=-1)
{
	global $tree;

	// read all parents
	$tree_level = array();

	// increment the cur level
	$level++;

	// get the forums of the level
	for ($i=0; $i < count($parents[POST_FORUM_URL][$main]); $i++)
	{
		$idx = $parents[POST_FORUM_URL][$main][$i];
		$forums[$idx]['tree_level'] = $level;
		$tree_level['type'][]	= POST_FORUM_URL;
		$tree_level['id'][]		= $forums[$idx]['forum_id'];
		$tree_level['sort'][]	= $forums[$idx]['forum_order'];
		$tree_level['data'][]	= $forums[$idx];
	}

	// add the categories of this level
	for ($i=0; $i < count($parents[POST_CAT_URL][$main]); $i++)
	{
		$idx = $parents[POST_CAT_URL][$main][$i];
		$cats[$idx]['tree_level'] = $level;
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
		$this_key = count($tree['data']);
		$key = $tree_level['type'][$i] . $tree_level['id'][$i];
		$order = $order + 10;
		$tree['keys'][$key] = $this_key;
		$tree['main'][]		= $main;
		$tree['type'][]		= $tree_level['type'][$i];
		$tree['id'][]		= $tree_level['id'][$i];
		$tree['data'][]		= $tree_level['data'][$i];
		$tree['sub'][$main][] = $key;

		cache_tree_level($key, $parents, $cats, $forums, $level);
	}
}

function cache_tree($write=false)
{
	global $db, $tree, $userdata, $phpbb_root_path, $phpEx, $board_config;

	// verify categories hierarchy v 2.0.5 and + installed
	if ( !defined('CATEGORIES_HIERARCHY_INSTALLED') )
	{
		return;
	}

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
// cache_words() : build the cache words file
//
//--------------------------------------------------------------------------------------------------
function cache_words()
{
	global $phpbb_root_path, $phpEx, $db;

	if ( !defined('CACHE_WORDS') )
	{
		return;
	}
	cache_generic('def_words_def', 'def_words', WORDS_TABLE, 'word_id');
}

//--------------------------------------------------------------------------------------------------
//
// cache_themes() : build the cache theme file
//
//--------------------------------------------------------------------------------------------------
function cache_themes()
{
	global $phpbb_root_path, $phpEx, $db;

	if ( !defined('CACHE_THEMES') )
	{
		return;
	}
	cache_generic('def_themes_def', 'def_themes', THEMES_TABLE, 'themes_id');
}

//--------------------------------------------------------------------------------------------------
//
// cache_smilies() : build the cache smilies file
//
//--------------------------------------------------------------------------------------------------
function cache_smilies()
{
	global $phpbb_root_path, $phpEx, $db;

	if ( !defined('CACHE_SMILIES') )
	{
		return;
	}
	cache_generic('def_smilies_def', 'def_smilies', SMILIES_TABLE, 'smilies_id');
}

//--------------------------------------------------------------------------------------------------
//
// cache_ranks() : build the cache ranks file
//
//--------------------------------------------------------------------------------------------------
function cache_ranks()
{
	global $phpbb_root_path, $phpEx, $db;

	if ( !defined('CACHE_RANKS') )
	{
		return;
	}
	cache_generic('def_ranks_def', 'def_ranks', RANKS_TABLE, 'rank_id');
}

//--------------------------------------------------------------------------------------------------
//
// cache_birthday() : build the cache birthday file
//
//--------------------------------------------------------------------------------------------------
function cache_birthday()
{
	global $phpbb_root_path, $phpEx, $db;

	if ( !defined('CACHE_BIRTHDAY') || !defined('PCP_INSTALLED') )
	{
		return;
	}
	$sql_where = "WHERE user_id <> " . ANONYMOUS . " AND user_active = 1 AND RIGHT(user_birthday, 4) = " . date( "md", time() );
	cache_generic('def_birthday_def', 'def_birthday', USERS_TABLE, 'user_id', $sql_where);
}

//--------------------------------------------------------------------------------------------------
//
// cache_generic() : generic cache process
//
//--------------------------------------------------------------------------------------------------
function cache_generic($cache_tpl, $cache_file, $table, $key_field, $sql_where='')
{
	global $phpbb_root_path, $phpEx, $db, $userdata;

	// template
	$template = new Template($phpbb_root_path);

	$template->set_filenames(array(
		'cache' => 'includes/cache_tpls/' . $cache_tpl . '.tpl')
	);

	$time = time();
	$template->assign_vars(array(
		'TIME'		=> date('Y-m-d H:i:s', $time) . ' (GMT)',
		'DAY'		=> mktime(0, 0, 0, date('m', $time), date('d', $time), date('Y', $time) ),
		'USERNAME'	=> $userdata['username'],
		)
	);

	$sql = "SELECT * FROM $table $sql_where";
	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not read ' . $table . ' table', '', __LINE__, __FILE__, $sql);
	}
	while ( $row = $db->sql_fetchrow($result) )
	{
		$id = $row[$key_field];
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

		$template->assign_block_vars('cache_row', array(
			'ID'		=> sprintf("'%s'", str_replace("'", "\'", $id)),
			'CELLS'		=> $s_cells,
			)
		);
	}

	// transfert to a var
	$template->assign_var_from_handle('cache', 'cache');
	$res = "<?php\n" . $template->_tpldata['.'][0]['cache'] . "\n?>";

	// output to file
	$cache_path = 'includes/';
	$handle = @fopen($phpbb_root_path . $cache_path . $cache_file . '.' . $phpEx, 'w');
	@flock($fp, LOCK_EX);
	@fwrite($handle, $res);
	@flock($fp, LOCK_UN);
	@fclose($handle);
	@umask(0000);
	@chmod($phpbb_root_path . $cache_path . $cache_file . '.' . $phpEx, 0666);
}

?>