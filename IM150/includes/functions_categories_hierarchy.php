<?php
/***************************************************************************
 *							functions_categories_hierarchy.php
 *							----------------------------------
 *	begin			: 21/10/2003
 *	copyright		: Ptirhiik
 *	email			: ptirhiik@clanmckeen.com
 *
 *	Version			: 1.0.7 - 20/07/2004
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
// $nav_separator : used in the navigation sentence : ie Forum Index -> MainCat -> Forum -> Topic
//
//--------------------------------------------------------------------------------------------------
$nav_separator = "&nbsp;&raquo;&nbsp;";

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
	$this_key	= $tree['keys'][$cur];
	$type	= $tree['type'][$this_key];
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
		$res = ($tree['auth'][$cur]['auth_view'] || $all) ? $tree['data'][$this_key][$field] : '';
		if (isset($lang[$res])) $res = $lang[$res];
	}
	return $res;
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
	$replacement_word = array();
	obtain_word_list($orig_word, $replacement_word);

	// read the user cookie
	$tracking_topics	= ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_t']) ) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'] . "_t"]) : array();
	$tracking_forums	= ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f']) ) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'] . "_f"]) : array();
	$tracking_all		= ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f_all']) ) ? intval($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f_all']) : -1;

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

	// read the user auth and the last post of each forums
	if ( $userdata['session_logged_in'] )
	{
		$sql_select = ', a.*, ug.user_id';
		$sql_from = "LEFT JOIN " . AUTH_ACCESS_TABLE . " a ON a.forum_id = f.forum_id )
					LEFT JOIN " . USER_GROUP_TABLE . " ug ON ug.group_id = a.group_id AND ug.user_id = " . intval($userdata['user_id']) . " AND ug.user_pending=0 )";
	}
	else
	{
		$sql_select = '';
		$sql_from = '))';
	}
	$sql = "SELECT f.forum_id AS forum_id_main, f.forum_last_post_id $sql_select
				FROM ((" . FORUMS_TABLE . " f $sql_from";
	if ( !$result = $db->sql_query($sql, false, "forum_sql") )
	{
		message_die(GENERAL_ERROR, 'Couldn\'t access list of last posts from forums', '', __LINE__, __FILE__, $sql);
	}

	$u_access = array();
	$s_last_posts = '';
	$last_posts = array();
	while ( $row = $db->sql_fetchrow($result) )
	{
		// get the last post
		if ( !empty($row['forum_last_post_id']) && !isset($last_posts[ $row['forum_last_post_id'] ]) )
		{
			$last_posts[ $row['forum_last_post_id'] ] = $row['forum_id_main'];
			$s_last_posts .= ( empty($s_last_posts) ? '' : ', ' ) . $row['forum_last_post_id'];
		}

		// get the access auth
		if ( $userdata['session_logged_in'] && ($row['user_id'] == $userdata['user_id']) )
		{
			$u_access[ $row['forum_id_main'] ] = $row;
		}
	}
	$db->sql_freeresult($result);

	$userdata['user_forums_auth'] = $u_access;
	$sql_last_posts = empty($s_last_posts) ? '' : " OR p.post_id IN ($s_last_posts)";

	// read the last or unread posts
	$user_lastvisit = $userdata['session_logged_in'] ? $userdata['user_lastvisit'] : 99999999999;

	$sql = "SELECT p.forum_id, p.topic_id, p.post_time, p.post_username, u.username, u.user_id, u.user_level, t.topic_last_post_id, t.topic_title
				FROM " . POSTS_TABLE . " p, " . TOPICS_TABLE . " t, " . USERS_TABLE . " u
				WHERE ( p.post_time > $user_lastvisit $sql_last_posts )
						AND p.post_id = t.topic_last_post_id
						AND t.topic_id = p.topic_id AND t.forum_id = p.forum_id AND t.topic_moved_id = 0
						AND u.user_id = p.poster_id";
//-- mod : Advanced Group Color Management -------------------------------------
//-- add
if (!defined('IN_INSTALL'))
{
	$sql = str_replace('SELECT ', 'SELECT u.user_group_id, u.user_session_time, ', $sql);
}
//-- fin mod : Advanced Group Color Management ---------------------------------
	if ( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Couldn\'t access list of unread posts from forums', '', __LINE__, __FILE__, $sql);
	}
	$new_topic_data = array();
	while ($row = $db->sql_fetchrow($result))
	{
		if ( $row['post_time'] > $user_lastvisit )
		{
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
					if ( empty($tracking_topics[$check_topic_id]) )
					{
						$unread_topics = true;
						$forum_last_post_time = max($check_post_time, $forum_last_post_time);
					}
					else
					{
						if ( $tracking_topics[$check_topic_id] < $check_post_time )
						{
							$unread_topics = true;
							$forum_last_post_time = max($check_post_time, $forum_last_post_time);
						}
					}
				}

				// is there a cookie for this forum ?
				if ( !empty($tracking_forums[$forum_id]) )
				{
					if ( $tracking_forums[$forum_id] > $forum_last_post_time )
					{
						$unread_topics = false;
					}
				}

				// is there a cookie for all forums ?
				if ( $tracking_all > $forum_last_post_time )
				{
					$unread_topics = false;
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
				$tree['data'][$i]['tree.user_group_id']			= $tree['data'][$i]['user_group_id'];
				$tree['data'][$i]['tree.user_session_time']		= $tree['data'][$i]['user_session_time'];
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
				$tree['data'][$main_idx]['tree.user_group_id']		= $tree['data'][$i]['tree.user_group_id'];
				$tree['data'][$main_idx]['tree.user_session_time']	= $tree['data'][$i]['tree.user_session_time'];
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
// get_auth_keys() : return an array() with only the row id verifying the auth asked
// returned array :
//		$keys['keys'][id]		=> n,
//		$keys['id'][n]			=> id (used by $tree),
//		$keys['real_level'][n]	=> level in this auth-tree (root=-1),
//		$keys['level'][n]		=> level adjust for display (sub-level=parent level under certain conditions)
//		$keys['idx'][n]			=> idx (used by $tree)
//--------------------------------------------------------------------------------------------------
function get_auth_keys($cur='Root', $all=false, $level=-1, $max=-1, $auth_key='auth_view', $align_level = 0)
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
				if (($level > 0) && ((substr($cur, 0, 1) == POST_FORUM_URL) || (intval($board_config['sub_forum']) > 0)) && (substr($tree['main'][$tree['keys'][$cur]], 0, 1) == POST_CAT_URL))
				{
					$align_level++;   
				}
				$level = $level-$align_level;
			}

			// store this level
			$last_i++;
			$keys['keys'][$cur]				= $last_i;
			$keys['id'][$last_i]			= $cur;
			$keys['real_level'][$last_i]	= $orig_level;
			$keys['level'][$last_i]			= $level;
			$keys['idx'][$last_i]			= (isset($tree['keys'][$cur]) ? $tree['keys'][$cur] : -1);

			// get sub-levels
      $tree_count = $tree['sub'][$cur] ? count($tree['sub'][$cur]) : 0;
			for ($i=0; $i < $tree_count; $i++)
			{
				$tkeys = array();
				$tkeys = get_auth_keys($tree['sub'][$cur][$i], $all, $orig_level+1, $max, $auth_key, $align_level);

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

//-- mod : new jumpbox by flashdagger --------------------------------------------------------------
//-- delete
//--------------------------------------------------------------------------------------------------
//
// get_tree_option() : return a drop down menu list of <option></option>
//
//--------------------------------------------------------------------------------------------------
//function get_tree_option($cur='', $all=false)
//{
//	global $tree, $lang;
//
//	$keys = array();
//	$keys = get_auth_keys('Root', $all);
//	$res = '';
//	for ($i=0; $i < count($keys['id']); $i++)
//	{
//		// only get object that are not forum links type
//		if ( ($tree['type'][ $keys['idx'][$i] ] != POST_FORUM_URL) || empty($tree['data'][ $keys['idx'][$i] ]['forum_link']) || $all)
//		{
//			$selected = ($cur == $keys['id'][$i]) ? ' selected="selected"' : '';
//			$res .= '<option value="' . $keys['id'][$i] . '"' .  $selected . '>';
//
//			// name
//			$name = get_object_lang($keys['id'][$i], 'name', $all);
//
//			// increment
//			$inc = '';
//			for ($k=1; $k <= $keys['real_level'][$i]; $k++)
//			{
//				$inc .= '|&nbsp;&nbsp;&nbsp;';
//			}
//			if ($keys['level'][$i] >=0) $inc .= '|--';
//			$name = $inc . $name;
//
//			$res .= $name . '</option>';
//		}
//	}
//	return $res;
//}
//-- add
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
//-- fin mod : new jumpbox by flashdagger ----------------------------------------------------------

//--------------------------------------------------------------------------------------------------
//
// build_index() : display a level and its sublevels : use dislay_index() as entry point
//
//--------------------------------------------------------------------------------------------------
function build_index($cur='Root', $cat_break=false, &$forum_moderators, $real_level=-1, $max_level=-1, &$keys)
{
	global $template, $phpEx, $board_config, $lang, $images;
	global $tree;
	global $agcm_color;
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
	$this_key = isset($tree['keys'][$cur]) ? $tree['keys'][$cur] : -1;

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
				if ( $start && ($tree['main'][$keys['idx'][$i]] == $tree['main'][$this_key]))
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
			'L_FORUM'	=> ($this_key < 0) ? $lang['Forum'] : get_object_lang($cur, 'name'),
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
		if ( ($tree['type'][$this_key] == POST_CAT_URL) && $pull_down)
		{
			// display a cat row
			$cat = $tree['data'][$this_key];
			$cat_id = $tree['id'][$this_key];

			// get the class colors
			$class_catLeft	= "catLeft";
			$class_cat		= "cat";
			$class_rowpic	= "rowpic";

			// send to template
			$template->assign_block_vars('catrow', array());
			$template->assign_block_vars('catrow.cathead', array(
				'CAT_TITLE'			=> get_object_lang($cur, 'name'),
				'CAT_DESC'			=> preg_replace('/<[^>]+>/', '', get_object_lang($cur, 'desc')),

				'CLASS_CATLEFT'		=> $class_catLeft,
				'CLASS_CAT'			=> $class_cat,
				'CLASS_ROWPIC'		=> $class_rowpic,
				'INC_SPAN'			=> $max_level - $level+2,

				'U_VIEWCAT'			=> append_sid("index.$phpEx?" . POST_CAT_URL . "=$cat_id"),
				)
			);


			// add indentation to the display
			for ($k=1; $k <= $level; $k++)
			{
				$template->assign_block_vars('catrow.cathead.inc', array(
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
		if ( ($tree['type'][$this_key] == POST_FORUM_URL) || (($tree['type'][$this_key] == POST_CAT_URL) && !$pull_down))
		{
			// get the data
			$data	= $tree['data'][$this_key];
			$id		= $tree['id'][$this_key];
			$type	= $tree['type'][$this_key];
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
			if (($tree['type'][$this_key] == POST_FORUM_URL) && !empty($tree['data'][$this_key]['forum_link']))
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
				if ( $forum_moderators[$id] && count($forum_moderators[$id]) > 0 )
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

				$last_post_time = create_date($board_config['default_dateformat'], $data['tree.post_time'], $board_config['board_timezone']);
				$last_post  = (($board_config['last_topic_title']) ? $topic_title : '');
				$last_post .= $last_post_time . '<br />';
        // Rebuild a fake userdata array for the last poster. Pass the user_id for the founder color.
        $last_poster_userdata = array(
          'user_id' => $data['tree.post_user_id'],
          'user_level' => $data['user_level'],
        );
				$last_post .= ( $data['tree.post_user_id'] == ANONYMOUS ) ? $agcm_color->get_user_color($data['user_group_id'], $data['user_session_time'], $data['tree.post_username']) . ' ' : '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '='  . $data['tree.post_user_id']) . '" class="'.$agcm_color->get_user_color($data['user_group_id'], $data['user_session_time']).'">' . $data['tree.post_username'] . '</a> ';
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
					$wdesc = preg_replace('/<[^>]+>/', '', $wdesc);
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
						if ( $tree['type'][$wthis] == POST_FORUM_URL && (!empty($wdata['forum_link']) OR empty($wdata['tree.topic_last_post_id'])))
						{
							$wlast_post  = '<a href="' . append_sid("./viewforum.$phpEx?"  . POST_FORUM_URL . '=' . $wdata['forum_id']) . '">';
						}
						else if ($tree['type'][$wthis] == POST_CAT_URL && empty($wdata['tree.topic_last_post_id']))
						{
							$wlast_post  = '<a href="' . append_sid("index.$phpEx?"  . POST_CAT_URL . '=' . $wdata['cat_id']) . '">';
						}
						else
						{
							$wlast_post  = '<a href="' . append_sid("./viewtopic.$phpEx?"  . POST_POST_URL . '=' . $wdata['tree.topic_last_post_id']) . '#' . $wdata['tree.topic_last_post_id'] . '">';
						}
						$wlast_post .= '<img src="' . $wfolder_image . '" border="0" alt="' . $wfolder_alt . '" title="' . $wfolder_alt . '" align="middle" /></a>';
					}
					if ($link != '') $links .= (($links != '') ? ', ' : '') . $wlast_post . $link;
				}
			}

			// forum icon
			$icon_img = empty($data['icon']) ? '' : ( isset($images[ $data['icon'] ]) ? $images[ $data['icon'] ] : $data['icon'] );

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
			if (($tree['type'][$this_key] == POST_FORUM_URL) && !empty($tree['data'][$this_key]['forum_link']))
			{
				$s_hit_count = '';
				if ($tree['data'][$this_key]['forum_link_hit_count'])
				{
					$s_hit_count = sprintf($lang['Forum_link_visited'], $tree['data'][$this_key]['forum_link_hit']);
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
  $tree_count = $tree['sub'][$cur] ? count($tree['sub'][$cur]) : 0;
	for ($i=0; $i < $tree_count; $i++) if (!empty($keys['keys'][$tree['sub'][$cur][$i]]))
	{
		$wdisplay = build_index($tree['sub'][$cur][$i], $cat_break, $forum_moderators, $level+1, $max_level, $keys);
		if ($wdisplay) $display = true;
	}

	if ($level >=0 )
	{
		// forum footer row
		if ($tree['type'][$this_key] == POST_FORUM_URL)
		{
		}
	}

	if ($level >=0 )
	{
		// cat footer
		if ( ($tree['type'][$this_key] == POST_CAT_URL) && $pull_down)
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
	global $agcm_color;

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
				$forum_moderators[ $tree['id'][$idx] ][] = '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $data['user_id'][$i]) . '" class="' . $agcm_color->get_user_color($data['user_group_id'][$i], $data['user_session_time'][$i]) . '">' . $data['username'][$i] . '</a>';
			}
			for ( $i = 0; $i < count($data['group_id']); $i++ )
			{
				$forum_moderators[ $tree['id'][$idx] ][] = '<a href="' . append_sid("./groupcp.$phpEx?" . POST_GROUPS_URL . "=" . $data['group_id'][$i]) . '">' . $data['group_name'][$i] . '</a>';
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
function make_cat_nav_tree($cur, $pgm='', $nav_class='nav', $topic_title='', $forum_id=0)
{
	global $phpbb_root_path, $phpEx, $db;
	global $global_orig_word, $global_replacement_word;
	global $nav_separator;
	global $tree;

	// get topic or post level
	$type = substr($cur, 0, 1);
	$id = intval(substr($cur,1));
	$fcur = '';
	switch ($type)
	{
		case POST_TOPIC_URL:
			if ( empty($forum_id) || empty($topic_title) )
			{
				$sql = "SELECT forum_id, topic_title 
							FROM " . TOPICS_TABLE . " WHERE topic_id = $id";
				if ( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not query topics information', '', __LINE__, __FILE__, $sql);
				}
				if ( $row = $db->sql_fetchrow($result) )
				{
					$topic_title = $row['topic_title'];
					$forum_id = $row['forum_id'];
				}
			}
			else
			{
				$row = array();
				$row['topic_title'] = $topic_title;
				$row['forum_id'] = $forum_id;
			}
			if ( !empty($forum_id) )
			{
				$fcur = POST_FORUM_URL . $row['forum_id'];
				$topic_title = $row['topic_title'];
				$orig_word = array();
				$replacement_word = array();
				obtain_word_list($orig_word, $replacement_word);
				if ( count($orig_word) )
				{
					$topic_title = preg_replace($orig_word, $replacement_word, $topic_title);
				}
			}
			break;
		case POST_POST_URL:
			if ( empty($forum_id) || empty($topic_title) )
			{
				$sql = "SELECT t.forum_id, t.topic_title 
							FROM " . POSTS_TABLE . " p, " . TOPICS_TABLE . " t 
							WHERE t.topic_id=p.topic_id AND post_id = $id";
				if ( !($result = $db->sql_query($sql)) ) message_die(GENERAL_ERROR, 'Could not query posts information', '', __LINE__, __FILE__, $sql);
				if ( !$row = $db->sql_fetchrow($result) )
				{
					$row['forum_id'] = 0;
					$row['topic_title'] = '';
				}
			}
			else
			{
				$row['forum_id'] = $forum_id;
				$row['topic_title'] = $topic_title;
			}
			if ( !empty($forum_id) && !empty($topic_title) )
			{
				$fcur = POST_FORUM_URL . $row['forum_id'];
				$topic_title = $row['topic_title'];
				$orig_word = array();
				$replacement_word = array();
				obtain_word_list($orig_word, $replacement_word);
				if ( count($orig_word) )
				{
					$topic_title = preg_replace($orig_word, $replacement_word, $topic_title);
				}
			}
			break;
	}

	// keep the compliancy with prec versions
	if (!isset($tree['keys'][$cur]))
	{
		$cur = isset($tree['keys'][POST_CAT_URL . $cur]) ? POST_CAT_URL . $cur : $cur;
	}

	// find the object
	$this_key = isset($tree['keys'][$cur]) ? $tree['keys'][$cur] : -1;

	$res = '';
	while (($this_key >= 0) || ($fcur != ''))
	{
		$type = (substr($fcur, 0, 1) != '') ? substr($cur, 0, 1) : $tree['type'][$this_key];
		switch($type)
		{
			case POST_CAT_URL:
				$field_name		= get_object_lang($cur, 'name');
				$param_type		= POST_CAT_URL;
				$param_value	= $tree['id'][$this_key];
				$pgm_name		= "index.$phpEx";
				break;
			case POST_FORUM_URL:
				$field_name		= get_object_lang($cur, 'name');
				$param_type		= POST_FORUM_URL;
				$param_value	= $tree['id'][$this_key];
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
			$cur = $tree['main'][$this_key];
		}
		$this_key = isset($tree['keys'][$cur]) ? $tree['keys'][$cur] : -1;
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