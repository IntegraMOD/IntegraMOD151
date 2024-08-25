<?php
/***************************************************************************
 *							admin_forums_extend.php
 *							-----------------------
 *	begin			: 06/11/2003
 *	copyright		: Ptirhiik
 *	email			: Ptirhiik@clanmckeen.com
 *
 *	version			: 1.0.2 - 23/06/2004
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

define('IN_PHPBB', 1);
define('CT_SECLEVEL', 'MEDIUM');
$ct_ignorepvar = array('create','delete','name','icon');
if ( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['Forums']['Manage_extend'] = $file;
	return;
}

//
// Load default header
//
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
include($phpbb_root_path . 'includes/functions_admin.'.$phpEx);

include_once($phpbb_root_path . 'includes/lite.'.$phpEx);
$options = array(
    'cacheDir' => $phpbb_root_path . 'var_cache/',
);

$var_cache = new Cache_Lite($options);

$var_cache->clean('forum');

//--------------------------------
//
//	constants
//
//--------------------------------
define('POST_FLINK_URL', 'l');

// auth list : put in this file all the auth fields description
include( $phpbb_root_path . './includes/def_auth.' . $phpEx );

// fields presents in forums table, except auths ones :
//		table_field => form_field
$forums_fields_list = array(
	'forum_id'				=> 'id',
	'main_type'				=> 'main_type',
	'cat_id'				=> 'main_id',
	'forum_order'			=> 'order',
	'forum_name'			=> 'name',
	'forum_desc'			=> 'desc',
	'forum_status'			=> 'status',
	'prune_enable'			=> 'prune_enable',
	'forum_link'			=> 'link',
	'forum_link_internal'	=> 'link_internal',
	'forum_link_hit_count'	=> 'link_hit_count',
	'forum_link_hit'		=> 'link_hit',
	'icon'					=> 'icon',
);

// fields presents in categories table :
//		table_field => form_field
$categories_fields_list = array( 
	'cat_id'				=> 'id',
	'cat_main_type'			=> 'main_type',
	'cat_main'				=> 'main_id',
	'cat_order'				=> 'order',
	'cat_title'				=> 'name',
	'cat_desc'				=> 'desc',
	'icon'					=> 'icon',
);

// type of the form fields
$fields_type = array(
	'type'					=> 'VARCHAR',
	'id'					=> 'INTEGER',
	'main_type'				=> 'VARCHAR',
	'main_id'				=> 'INTEGER',
	'order'					=> 'INTEGER',
	'name'					=> 'VARCHAR',
	'desc'					=> 'HTML',
	'icon'					=> 'HTML',
	'status'				=> 'INTEGER',
	'prune_enable' => 'INTEGER',
	'enable'				=> 'INTEGER',
	'link'					=> 'HTML',
	'link_internal'			=> 'INTEGER',
	'link_hit_count'		=> 'INTEGER',
	'link_hit'				=> 'INTEGER',
);

// list for pull down menu and check of values :
//		value => lang key entry
$forum_type_list = array(
	POST_CAT_URL		=> 'Category', 
	POST_FORUM_URL		=> 'Forum', 
	POST_FLINK_URL		=> 'Forum_link'
);

// forum status
//		value => lang key entry
$forum_status_list = array(
	FORUM_UNLOCKED		=> 'Status_unlocked', 
	FORUM_LOCKED		=> 'Status_locked'
);

$return_msg = '';

// check the presence of the field allowing to attach forums to forums
$sql = "SELECT main_type FROM " . FORUMS_TABLE . " LIMIT 0, 1";
if ( $db->sql_query($sql) )
{
	define('SUB_FORUM_ATTACH', true);
}

// some compliancy
$sql = "SELECT forum_display_sort, forum_display_order FROM " . FORUMS_TABLE . " LIMIT 0, 1";
if ( $db->sql_query($sql) && function_exists('get_forum_display_sort_option') )
{
	define('TOPIC_DISPLAY_ORDER', true);
	$forums_fields_list['forum_display_sort'] = 'forum_display_sort';
	$forums_fields_list['forum_display_order'] = 'forum_display_order';
	$fields_type['forum_display_sort'] = 'INTEGER';
	$fields_type['forum_display_order'] = 'INTEGER';
}

// prune functions
include( $phpbb_root_path . './includes/prune.' . $phpEx);

// return message after update
if (empty($selected_id)) $selected_id = '';
$return_msg .= '<br /><br />' . sprintf($lang['Click_return_forumadmin'], '<a href="' . append_sid("./admin_forums_extend.$phpEx?selected_id=$selected_id") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid("./index.$phpEx?pane=right") . '">', '</a>');

//--------------------------------
//
//	functions
//
//--------------------------------
function admin_add_error( $msg )
{
	global $error, $error_msg, $lang;

	$error = true;
	$error_msg .= ( empty($error_msg) ? '<br />' : '<br /><br />' ) . ( isset($lang[$msg]) ? $lang[$msg] : $msg );
}

function admin_get_nav_cat_desc($cur='')
{
	global $nav_separator;

	$nav_cat_desc = make_cat_nav_tree($cur, 'admin_forums_extend');
	if ( !empty($nav_cat_desc) )
	{
		$nav_cat_desc = $nav_separator . $nav_cat_desc;
	}
	return $nav_cat_desc;
}

function delete_item( $old, $new='', $topic_dest='' )
{
	global $db;

	// no changes
	if ( $old == $new ) return;

	// old type and id
	$old_type = substr($old, 0, 1);
	$old_id = intval(substr($old, 1));

	// new type and id
	$new_type = substr($new, 0, 1);
	$new_id = intval( substr($new, 1) );
	if ( ($new_id == 0) || !in_array($new_type, array(POST_FORUM_URL, POST_CAT_URL)) )
	{
		$new_type = POST_CAT_URL;
		$new_id = 0;
	}

	// topic dest
	$dst_type = substr($topic_dest, 0, 1);
	$dst_id = intval(substr($topic_dest, 1));
	if ( ($dst_id == 0) || ($dst_type != POST_FORUM_URL) )
	{
		$topic_dest = '';
	}

	// re-attach all the content to the new id
	if ( !empty($new) )
	{
		// forums
		if ( defined('SUB_FORUM_ATTACH') )
		{
			$sql = "UPDATE " . FORUMS_TABLE . "
						SET main_type = '$new_type', cat_id = $new_id
						WHERE main_type = '$old_type' AND cat_id = $old_id";
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Couldn\'t update forum attachement', '', __LINE__, __FILE__, $sql);
			}
		}
		// if old type was a forum, it can't have sub-forums attached wthout the parent type field
		else if ( $old_type == POST_CAT_URL )
		{
			if ( ($new_type == POST_CAT_URL) && ($new_id != 0) )
			{
				$sql = "UPDATE " . FORUMS_TABLE . "
							SET cat_id = $new_id
							WHERE cat_id = $old_id";
				if ( !$db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Couldn\'t update forum attachement', '', __LINE__, __FILE__, $sql);
				}
			}
			else if ( ($new_type == POST_FORUM_URL) || ($new_id == 0) )
			{
				// check if forum attached
				$sql = "SELECT * FROM " . FORUMS_TABLE . " WHERE cat_id = $old_id LIMIT 0, 1";
				if ( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Couldn\'t read forums attachement', '', __LINE__, __FILE__, $sql);
				}
				if ( $row = $db->sql_fetchrow($result) )
				{
					message_die(GENERAL_ERROR, 'Attempt to attach a forum to root index or to a forum');
				}
			}
		}

		// categories
		$sql = "UPDATE " . CATEGORIES_TABLE . "
					SET cat_main_type = '$new_type', cat_main = $new_id
					WHERE cat_main_type = '$old_type' AND cat_main = $old_id";
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Couldn\'t update categories attachement', '', __LINE__, __FILE__, $sql);
		}
	}

	// topics move
	if ( !empty($topic_dest) && ($dst_type == POST_FORUM_URL) )
	{
		if ( ($dst_type == POST_FORUM_URL) && ($old_type == POST_FORUM_URL) )
		{
			// topics
			$sql = "UPDATE " . TOPICS_TABLE . " SET forum_id = $dst_id WHERE forum_id = $old_id";
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Couldn\'t move topics to other forum', '', __LINE__, __FILE__, $sql);
			}

			// posts
			$sql = "UPDATE " . POSTS_TABLE . " SET forum_id = $dst_id WHERE forum_id = $old_id";
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Couldn't move posts to other forum", "", __LINE__, __FILE__, $sql);
			}
			sync('forum', $dst_id);
		}
	}

	// all what is attached to a forum
	if ( $old_type == POST_FORUM_URL )
	{
		// read current moderators for the old forum
		$sql = "SELECT ug.user_id FROM " . AUTH_ACCESS_TABLE . " a, " . USER_GROUP_TABLE . " ug
					WHERE a.forum_id = $old_id
						AND a.auth_mod = 1
						AND ug.group_id = a.group_id";
		if( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Couldn\'t obtain moderator list', '', __LINE__, __FILE__, $sql);
		}
		$user_ids = array();
		while ( $row = $db->sql_fetchrow($result) )
		{
			$user_ids[] = $row['user_id'];
		}

		// remove moderator status for those ones
		if ( !empty($user_ids) )
		{
			$old_moderators = implode(', ', $user_ids);

			// check which ones remain moderators
			$sql = "SELECT ug.user_id FROM " . AUTH_ACCESS_TABLE . " a, " . USER_GROUP_TABLE . " ug
						WHERE a.forum_id <> $old_id
							AND a.auth_mod = 1
							AND ug.group_id = a.group_id
							AND ug.user_id IN ($old_moderators)";
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Couldn\'t obtain moderator list', '', __LINE__, __FILE__, $sql);
			}
			$user_ids = array();
			while ( $row = $db->sql_fetchrow($result) )
			{
				$user_ids[] = $row['user_id'];
			}
			$new_moderators = empty($user_ids) ? '' : implode(', ', $user_ids);

			// update users status
			$sql = "UPDATE " . USERS_TABLE . " 
						SET user_level = " . USER . " 
						WHERE user_id IN ($old_moderators)
							AND user_level <> " . ADMIN;
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Couldn\'t update users mod level', '', __LINE__, __FILE__, $sql);
			}
			if ( !empty($new_moderators) )
			{
				$sql = "UPDATE " . USERS_TABLE . " 
							SET user_level = " . MOD . " 
							WHERE user_id IN ($new_moderators)
							AND user_level <> " . ADMIN;
				if ( !$db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Couldn\'t update users mod level', '', __LINE__, __FILE__, $sql);
				}
			}
		}

		// remove auth for the old forum
		$sql = "DELETE FROM " . AUTH_ACCESS_TABLE . " WHERE forum_id = $old_id";
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Couldn\'t remove from auth table', '', __LINE__, __FILE__, $sql);
		}

		// prune table
		$sql = "DELETE FROM " . PRUNE_TABLE . " WHERE forum_id = $old_id";
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Couldn\'t remove from prune table old forum type', '', __LINE__, __FILE__, $sql);
		}

		// polls
		$sql = "SELECT v.vote_id FROM " . VOTE_DESC_TABLE . " v, " . TOPICS_TABLE . " t 
					WHERE t.forum_id = $old_id
						AND v.topic_id = t.topic_id";
		if ( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Couldn\'t obtain list of vote ids', '', __LINE__, __FILE__, $sql);
		}
		$vote_ids = array();
		while ( $row = $db->sql_fetchrow($result) )
		{
			$vote_ids[] = $row['vote_id'];
		}
		$s_vote_ids = empty($vote_ids) ? '' : implode(', ', $vote_ids);
		if ( !empty($s_vote_ids) )
		{
			$sql = "DELETE FROM " . VOTE_RESULTS_TABLE . " WHERE vote_id IN ($s_vote_ids)";
			if ( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Couldn\'t remove from vote results table', '', __LINE__, __FILE__, $sql);
			}
			$sql = "DELETE FROM " . VOTE_USERS_TABLE . " WHERE vote_id IN ($s_vote_ids)";
			if ( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Couldn\'t remove from vote results table', '', __LINE__, __FILE__, $sql);
			}
			$sql = "DELETE FROM " . VOTE_DESC_TABLE . " WHERE vote_id IN ($s_vote_ids)";
			if ( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Couldn\'t remove from vote desc table', '', __LINE__, __FILE__, $sql);
			}
		}

		// topics
		prune($old_id, 0, true); // Delete everything from forum
	}

	// delete the old one
	if ( $old_type == POST_FORUM_URL )
	{
		$sql = "DELETE FROM " . FORUMS_TABLE . " WHERE forum_id = $old_id";
	}
	else
	{
		$sql = "DELETE FROM " . CATEGORIES_TABLE . " WHERE cat_id = $old_id";
	}
	if ( !$db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Couldn\'t delete old forum/category', '', __LINE__, __FILE__, $sql);
	}
}

function reorder_tree()
{
	global $tree, $db;

	// read the tree
	read_tree(true);

	// update with new order
	$order = 0;
	for ($i = 0; $i < count($tree['data']); $i++ )
	{
		if ( !empty($tree['id'][$i]) )
		{
			$order += 10;
			if ( $tree['type'][$i] == POST_FORUM_URL )
			{
				$sql = "UPDATE " . FORUMS_TABLE . " 
							SET forum_order = $order
							WHERE forum_id = " . intval($tree['id'][$i]);
			}
			else
			{
				$sql = "UPDATE " . CATEGORIES_TABLE . " 
							SET cat_order = $order
							WHERE cat_id = " . intval($tree['id'][$i]);
			}
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Couldn\'t reorder forums/categories table', '', __LINE__, __FILE__, $sql);
			}
		}
	}

	// re-read the tree
	cache_tree(true);
	board_stats();
	$db->clear_cache('');
}

//--------------------------------
//
//	get parms
//
//--------------------------------
// mode
$mode = '';
if ( isset($_POST['mode']) || isset($_GET['mode']) )
{
	$mode = isset($_POST['mode']) ? $_POST['mode'] : $_GET['mode'];
}
if ( !empty($mode) && !in_array( $mode, array('edit', 'create', 'delete', 'moveup', 'movedw', 'resync') ) )
{
	$mode = '';
}

// selected id : current displayed id
$selected_id = '';
if ( isset($_POST['selected_id']) || isset($_GET['selected_id']) )
{
	$selected_id = isset($_POST['selected_id']) ? $_POST['selected_id'] : $_GET['selected_id'];
}
$type = substr($selected_id, 0, 1);
$id = intval( substr($selected_id, 1) );
if ( isset($_POST[POST_FORUM_URL]) || isset($_GET[POST_FORUM_URL]) )
{
	$type = POST_FORUM_URL;
	$id = isset($_POST[POST_FORUM_URL]) ? intval($_POST[POST_FORUM_URL]) : intval($_GET[POST_FORUM_URL]);
}
if ( isset($_POST[POST_CAT_URL]) || isset($_GET[POST_CAT_URL]) )
{
	$type = POST_CAT_URL;
	$id = isset($_POST[POST_CAT_URL]) ? intval($_POST[POST_CAT_URL]) : intval($_GET[POST_CAT_URL]);
}
if ( !in_array( $type, array(POST_CAT_URL, POST_FORUM_URL) ) || ($id == 0) )
{
	$type = POST_CAT_URL;
	$id = 0;
}
$selected_id = $type . $id;

// check if the selected id is a valid one
if ( !isset($tree['keys'][$selected_id]) )
{
	$selected_id = 'Root';
}

// work id
$fid = '';
if ( isset($_POST['fid']) || isset($_GET['fid']) )
{
	$fid = isset($_POST['fid']) ? $_POST['fid'] : $_GET['fid'];
}
$type = substr($fid, 0, 1);
$id = intval( substr($fid, 1) );
$fid = $type . $id;

// check buttons
$edit_forum = isset($_POST['edit']);
$create_forum = isset($_POST['create']);
$delete_forum = isset($_POST['delete']);
$resync_forum = isset($_POST['resync']);

$submit = isset($_POST['update']);
$cancel = isset($_POST['cancel']);

if ( $edit_forum || $delete_forum || $resync_forum )
{
	$fid = $selected_id;
}

// check when the fid is required if it is a valid one
if ( !isset($tree['keys'][$fid]) && ( $edit_forum || $delete_forum || ($mode == 'edit') || ($mode == 'create') || ($mode == 'moveup') || ($mode == 'movedw') || ($mode == 'resync') ) )
{
	$fid = '';
	$edit_forum = false;
	$delete_forum = false;
	if ( !in_array($mode, array('create', 'resync')) && !$create_forum && !$resync_forum )
	{
		$mode = '';
	}
}

// convert buttons to mode
if ( $edit_forum )
{
	$mode = 'edit';
}
if ( $delete_forum )
{
	$mode = 'delete';
}
if ( $create_forum )
{
	$mode = 'create';
	$fid = '';
}
if ( $resync_forum )
{
	$mode = 'resync';
}

if ( $mode == 'delete' )
{
	$delete_forum = true;
}

// reset the selected id
if ( isset($tree['keys'][$fid]) && !empty($tree['main'][ $tree['keys'][$fid] ]) )
{
	$selected_id = $tree['main'][ $tree['keys'][$fid] ];
}

//--------------------------------
//
//	process
//
//--------------------------------
// move up/down
if ( ($mode == 'moveup') || ($mode == 'movedw') )
{
	$prec = '';
	$next = '';
	$main = $tree['main'][ $tree['keys'][$fid] ];
	for ( $i = 0; $i < count($tree['sub'][$main]); $i++ )
	{
		$prec = ( $i == 0 ) ? $main : $tree['sub'][$main][$i-1];
		$found = ( $tree['sub'][$main][$i] == $fid );
		if ( $found )
		{
			$next = ( ($i+1) < count($tree['sub'][$main]) ) ? $tree['sub'][$main][$i+1] : $tree['sub'][$main][$i];
			break;
		}
	}
	if ( $found )
	{
		// moving up/down
		$ref = ($mode == 'moveup') ? $prec : $next;
		$inc = ($mode == 'moveup') ? -5 : +5;
		if ( ( ($mode == 'moveup') && ($ref != $main) ) || ( ($mode == 'movedw') && ($ref != $fid) ) )
		{
			$idx = $tree['keys'][$ref];
			if ( $tree['type'][$idx] == POST_FORUM_URL )
			{
				$order = $tree['data'][$idx]['forum_order'] + $inc;
			}
			else
			{
				$order = $tree['data'][$idx]['cat_order'] + $inc;
			}

			// update the current one
			if ( substr($fid, 0, 1) == POST_FORUM_URL )
			{
				$sql = "UPDATE " . FORUMS_TABLE . " 
							SET forum_order = $order
							WHERE forum_id = " . intval(substr($fid, 1));
			}
			else
			{
				$sql = "UPDATE " . CATEGORIES_TABLE . " 
							SET cat_order = $order
							WHERE cat_id = " . intval(substr($fid, 1));
			}
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Couldn\'t update order in categories/forums table', '', __LINE__, __FILE__, $sql);
			}
		}
	}

	// reorder
	reorder_tree();

	// add topics count and various informations
	get_user_tree($userdata);
	$mode = '';
}

// resync
if ( $mode == 'resync' )
{
	$tkeys = array();
	$tkeys = get_auth_keys($fid, true);
	for ( $i = 0; $i < count($tkeys['id']); $i++ )
	{
		$wid = $tkeys['id'][$i];
		if ( substr($wid, 0, 1) == POST_FORUM_URL )
		{
			sync('forum', intval(substr($wid, 1)) );
		}
	}

	// reorder
	reorder_tree();

	// end message
	$message = $lang['Forums_updated'] . $return_msg;
	message_die(GENERAL_MESSAGE, $message);
	exit;
}

// handle edition
if ( ($mode == 'edit') || ($mode == 'create') || ($mode == 'delete') )
{
	$this_key = isset($tree['keys'][$fid]) ? $fid : '';  
	$idx = isset($tree['keys'][$fid]) ? $tree['keys'][$fid] : '';
	$item = array();
	//-------------------------
	// get values from memory
	//-------------------------
	// get type and id
	$old_type = empty($this_key) ? POST_FORUM_URL : substr($fid, 0, 1);
	$old_id = empty($this_key) ? 0 : intval(substr($fid, 1));

	// choose the appropriate list of field (forums or categories table)
	switch ($old_type)
	{
		case POST_FORUM_URL:
			$fields_list = 'forums_fields_list';
			break;
		case POST_CAT_URL:
			$fields_list = 'categories_fields_list';
			break;
		default:
			$fields_list = 'forums_fields_list';
			break;
	}

	// get value from the tree for all fields in the list
	foreach ($$fields_list as $table_field => $process_field)
	{
		$item[$process_field] = empty($this_key) ? '' : trim($tree['data'][$idx][$table_field]);
	}

	// add fields not present in the list or having a special treatment
	$item['type'] = $old_type;

	// parent id
	$item['main'] = empty($this_key) ? $selected_id : $item['main_type'] . $item['main_id'];
	$item['main_type'] = substr($item['main'], 0, 1);
	$item['main_id'] = intval( substr($item['main'], 1) );
	if ( (intval($item['main_id']) == 0) || !in_array($item['main_type'], array(POST_CAT_URL, POST_FORUM_URL)) )
	{
		$item['main'] = 'Root';
		$item['main_type'] = POST_CAT_URL;
		$item['main_id'] = 0;
	}

	// position : added field
	$item['position'] = $item['main'];
	$found = false;
	if ( !empty($this_key) )
	{
		for ( $i = 0; isset($tree['sub'][ $item['main'] ]) && $i < count($tree['sub'][ $item['main'] ]); $i++ )
		{
			$item['position'] = ( $i == 0 ) ? $item['main'] : $tree['sub'][ $item['main'] ][$i-1];
			$found = ( $tree['sub'][ $item['main'] ][$i] == $fid );
			if ( $found )
			{
				break;
			}
		}
	}
	if ( !$found && !empty($tree['sub'][ $item['main'] ]) )
	{
		$i = count($tree['sub'][ $item['main'] ]);
		$item['position'] = $tree['sub'][ $item['main'] ][$i-1];
	}

	// move topic : added field
	$item['move'] = '';

	// links specific
	if ( !empty($item['link']) && ($item['type'] == POST_FORUM_URL) )
	{
		$item['type'] = POST_FLINK_URL;
	}

	// prune information
	$row = array();
	if ( !empty($this_key) && ($item['type'] == POST_FORUM_URL) )
	{
		// read the auto-prune table
		$sql = "SELECT * FROM " . PRUNE_TABLE . " WHERE forum_id = " . $item['id'];
		if ( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Auto-Prune: Couldn\'t read auto_prune table.', '', __LINE__, __FILE__, $sql);
		}
		if ( !$row = $db->sql_fetchrow($result) )
		{
			$row = array();
		}
	}
	$item['prune_days'] = empty($row) ? 7 : $row['prune_days'];
	$item['prune_freq'] = empty($row) ? 1 : $row['prune_freq'];

	// auth
	$forum_auth = array();

	// initiate with the first preset (public)
	$i = 0;
	foreach ($field_names as $auth_key => $auth_name)
	{
		$auth_value = isset($simple_auth_ary[0][$i]) ? $simple_auth_ary[0][$i] : AUTH_ADMIN;
		$forum_auth[$auth_key] = $auth_value;
		$i++;
	}

	// get the value from memory
	// (not set for create)
	if (!$create_forum && !empty($idx))
	{
		foreach ($tree['data'][$idx] as $key => $value)
		{
			if ( substr($key, 0, strlen('auth_')) == 'auth_' )
			{
				$forum_auth[$key] = $value;
			}
		}
	}

	//-------------------------
	// get values from form
	//-------------------------
	// type
	$item['type'] = isset($_POST['type']) ? $_POST['type'] : $item['type'];
	if ( !isset($forum_type_list[ $item['type'] ]) )
	{
		$item['type'] = POST_FORUM_URL;
	}

	// choose the appropriate list of field (forums or categories table)
	switch ($item['type'])
	{
		case POST_FLINK_URL:
		case POST_FORUM_URL:
			$fields_list = 'forums_fields_list';
			break;
		case POST_CAT_URL:
			$fields_list = 'categories_fields_list';
			break;
		default:
			$fields_list = 'forums_fields_list';
			break;
	}

	// get value from form
	foreach ($$fields_list as $table_field => $process_field)
	{
		if ( isset($_POST[$process_field]) )
		{
			// get field from form
			$form_field = $_POST[$process_field];
			switch (( isset($fields_type[$process_field]) ? $fields_type[$process_field] : '' ))
			{
				case 'INTEGER':
					$form_field = intval($form_field);
					break;
				case 'HTML':
					$form_field = trim(stripslashes($form_field));
					break;
				default:
					$form_field = trim(stripslashes(htmlspecialchars($form_field)));
					break;
			}
			// store
			$item[$process_field] = $form_field;
		}
	}

	// parent id
	$item['main'] = isset($_POST['main']) ? $_POST['main'] : $item['main'];
	$item['main_type'] = substr($item['main'], 0, 1);
	$item['main_id'] = intval( substr($item['main'], 1) );
	if ( ($item['main_id'] == 0) || !in_array($item['main_type'], array(POST_CAT_URL, POST_FORUM_URL)) )
	{
		$item['main'] = 'Root';
		$item['main_type'] = POST_CAT_URL;
		$item['main_id'] = 0;
	}
	else
	{
		$item['main'] = $item['main_type'] . $item['main_id'];
	}

	// position
	if ( isset($_POST['position']) )
	{
		$type = substr($_POST['position'], 0, 1);
		$id = intval( substr($_POST['position'], 1) );
		if ( !in_array($type, array(POST_FORUM_URL, POST_CAT_URL)) || ($id == 0) )
		{
			$item['position'] = 'Root';
		}
		else
		{
			$item['position'] = $type . $id;
		}
	}

	// move topics
	if ( isset($_POST['move']) )
	{
		$type = substr($_POST['move'], 0, 1);
		$id = intval(substr($_POST['move'], 1));
		if ( ($type != POST_FORUM_URL) || ($id == 0) )
		{
			$item['move'] = '';
		}
		else
		{
			$item['move'] = $type . $id;
		}
	}

	// status
	if ( !isset($item['status']) || !isset($forum_status_list[ $item['status'] ]) )
	{
		foreach ($forum_status_list as $status => $value)
		{
			break; // Just populate $status => $value
		}
		$item['status'] = $status;
	}

	// auth
	foreach ($forum_auth as $key => $value)
	{
		if ( isset($_POST[$key]) )
		{
			$forum_auth[$key] = intval($_POST[$key]);
		}
	}

	// check a preset choose
	$forum_preset = -1;
	if ( isset($_POST['preset_choice']) && ( intval($_POST['preset_choice']) == 1 ) )
	{
		if ( isset($simple_auth_ary[ intval($_POST['forum_preset']) ]) )
		{
			$forum_preset = intval($_POST['forum_preset']);
			$preset_data = $simple_auth_ary[$forum_preset];
			$i = 0;
			foreach ($field_names as $field_key => $field_lang)
			{
				$forum_auth[$field_key] = $preset_data[$i];
				$i++;
			}
		}
	}
	else
	{
		// try to identify a preset
		foreach ($simple_auth_ary as $preset_key => $preset_data)
		{
			$matched = true;
			$i = 0;
			foreach ($field_names as $field_key => $field_lang)
			{
				$matched = ( $forum_auth[$field_key] == $preset_data[$i] );
				if ( !$matched )
				{
					break;
				}
				$i++;
			}
			if ( $matched )
			{
				$forum_preset = $preset_key;
				break;
			}
		}
	}

	//-------------------------
	// process
	//-------------------------
	if ( $cancel )
	{
		$mode = '';
	}
	else if ( $submit )
	{
		// do some check
		$error = false;
		$error_msg = '';

		// forum name
		if ( empty($item['name']) )
		{
			admin_add_error( 'Forum_name_missing' );
		}

		// check move dest
		if ( !empty($item['move']) )
		{
			$type = substr($item['move'], 0, 1);
			$id = intval(substr($item['move'], 1));
			$werror = false;
			if ( ($type != POST_FORUM_URL) || ($id == 0) )
			{
				$werror = true;
			}
			else if ( !isset($tree['keys'][ $type . $id ]) )
			{
				$werror = true;
			}
			else if ( !empty($tree['data'][ $tree['keys'][ $type . $id ] ]['forum_link']) )
			{
				$werror = true;
			}
			if ( $werror )
			{
				admin_add_error( 'Nowhere_to_move' );
			}
		}

		// force to choose a dest for attached items if delete
		if ( $delete_forum )
		{
			if ( empty($item['move']) && !empty($tree['sub'][$fid]) )
			{
				admin_add_error( 'Nowhere_to_move' );
			}
			else
			{
				$item['type'] = substr($item['move'], 0, 1);
				$item['id'] = intval(substr($item['move'], 1));
			}
		}

		// forum main
		if ( !defined('SUB_FORUM_ATTACH') )
		{
			if ( ($item['main_type'] != POST_CAT_URL) || ( ($item['main'] == 'Root') && ($item['type'] != POST_CAT_URL) ) )
			{
				admin_add_error( (($item['main'] == 'Root') ? 'Attach_root_wrong' : 'Attach_forum_wrong') );
			}
		}

		// recursive attachment
		if ( !empty($fid) )
		{
			$main = $item['main'];
			while ( $main != 'Root' )
			{
				if ( $main == $fid )
				{
					admin_add_error( 'Recursive_attachment' );
					break;
				}
				$main = $tree['main'][ $tree['keys'][$main] ];
			}
		}

		// recursive dest
		if ( !empty($item['move']) && $delete_forum )
		{
			$main = $item['move'];
			while ( $main != 'Root' )
			{
				if ( $main == $fid )
				{
					admin_add_error( 'Recursive_attachment' );
					break;
				}
				$main = $tree['main'][ $tree['keys'][$main] ];
			}
		}

		// category check
		if ( $item['type'] == POST_CAT_URL )
		{
		}

		// forum link type check
		if ( $item['type'] == POST_FLINK_URL )
		{
			// is the link ok ?
			if ( empty($item['link']) )
			{
				admin_add_error( 'Link_missing' );
			}

			// is there something already attached to the forum
			if ( !empty($fid) )
			{
				// forums and cats
				if ( !empty($tree['sub'][$fid]) )
				{
					admin_add_error( 'Forum_link_with_attachment_deny' );
				}
			}
		}

		// forums
		if ( $item['type'] == POST_FORUM_URL )
		{
			// prune
			if ( $item['prune_enable'] )
			{
				if ( empty($item['prune_days']) || empty($item['prune_freq']) )
				{
					admin_add_error( 'Set_prune_data' );
				}
			}

			// sub levels
			if ( !defined('SUB_FORUM_ATTACH') && !empty($tree['sub'][ $fid ]) )
			{
				// check if forum attached
				$found = false;
				for ( $i = 0; $i < count($tree['sub'][ $fid ]); $i++ )
				{
					$found = ( $tree['type'][ $tree['keys'][ $tree['sub'][$fid][$i] ] ] == POST_FORUM_URL );
					if ( $found )
					{
						break;
					}
				}
				if ( $found )
				{
					admin_add_error( 'Forum_with_attachment_denied' );
				}
			}
		}

		// check content
		if ( ($old_type == POST_FORUM_URL) && ($item['type'] != POST_FORUM_URL) )
		{
			// check if topics are present
			$sql = "SELECT * FROM " . TOPICS_TABLE . " WHERE forum_id = $old_id LIMIT 0, 1";
			if ( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Couldn\'t access topics table', '', __LINE__, __FILE__, $sql);
			}
			if ($row = $db->sql_fetchrow($result))
			{
				$move_found = empty($item['move']); // empty = delete
				if ( !empty($item['move']) )
				{
					$type = substr($item['move'], 0, 1);
					$id = intval(substr($item['move'], 1));
					if ( $type == POST_FORUM_URL )
					{
						if ( isset($tree['keys'][ $item['move'] ] ) && ($item['move'] != $fid) )
						{
							$move_found = true;
						}
					}
				}
				if ( !$move_found )
				{
					if ( $new_type == POST_CAT_URL )
					{
						admin_add_error( 'Category_with_topics_deny' );
					}
					else if ( $new_type == POST_FLINK_URL )
					{
						admin_add_error( 'Forum_link_with_topics_deny' );
					}
					else
					{
						admin_add_error( 'Nowhere_to_move' );
					}
				}
			}
		}

		// send errors
		if ( $error )
		{
			$selected_id = $item['main'];
			$error_msg .= $return_msg;
			message_die(GENERAL_MESSAGE, $error_msg);
		}

		// get an order
		$item['order'] = 0;
		if ( !empty($item['position']) && ($item['position'] != 'Root') )
		{ // V: check me
			$order_idx = $tree['keys'][ $item['position'] ];
			$item['order'] = ($tree['type'][$order_idx] == POST_CAT_URL) ? $tree['data'][$order_idx]['cat_order'] : $tree['data'][$order_idx]['forum_order'];
		}
		$item['order'] += 5;

		// get an id
		$item['type'] = ($item['type'] == POST_FLINK_URL) ? POST_FORUM_URL : $item['type'];
		$new_item = false;
		if ( ( empty($fid) || ($old_type != $item['type']) ) && !$delete_forum)
		{
			$new_item = true;
			$item['id'] = 0;
			if ( $item['type'] == POST_FORUM_URL )
			{
				$sql = "SELECT MAX(forum_id) AS max_id FROM " . FORUMS_TABLE;
			}
			else
			{
				$sql = "SELECT MAX(cat_id) AS max_id FROM " . CATEGORIES_TABLE;
			}
			if ( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Couldn\'t get order number from forums/categories table', '', __LINE__, __FILE__, $sql);
			}
			if ( $row = $db->sql_fetchrow($result) )
			{
				$item['id'] = $row['max_id'];
			}
			$item['id']++;
		}

		if ( !$delete_forum )
		{
			// update
			$fields_list = ( $item['type'] == POST_FORUM_URL ) ? 'forums_fields_list' : 'categories_fields_list';
			$sql_fields = '';
			$sql_values = '';
			$sql_update = '';

			// regular fields
			foreach ($$fields_list as $table_field => $process_field)
			{
				if ( ( $table_field != 'main_type' || defined('SUB_FORUM_ATTACH') || ($item['type'] != POST_FORUM_URL) ) && isset($item[$process_field]) )
				{
					$table_value = ($fields_type[$process_field] == 'INTEGER') ? intval($item[$process_field]) : sprintf("'%s'", str_replace("\'", "''", str_replace('\"', '"', addslashes($item[$process_field]))));
					$sql_fields .= ( empty($sql_fields) ? '' : ', ' ) . $table_field;
					$sql_values .= ( empty($sql_values) ? '' : ', ' ) . $table_value;
					$sql_update .= ( empty($sql_update) ? '' : ', ' ) . $table_field . '=' . $table_value;
				}
			}

			// auth fields
			if ( $item['type'] == POST_FORUM_URL )
			{
				foreach ($forum_auth as $table_field => $auth_value)
				{
					$table_value = intval($auth_value);
					$sql_fields .= ( empty($sql_fields) ? '' : ', ' ) . $table_field;
					$sql_values .= ( empty($sql_values) ? '' : ', ' ) . $table_value;
					$sql_update .= ( empty($sql_update) ? '' : ', ' ) . $table_field . '=' . $table_value;
				}
			}

			// build the final sql request
			$table = ($item['type'] == POST_FORUM_URL) ? FORUMS_TABLE : CATEGORIES_TABLE;
			$index_field = ($item['type'] == POST_FORUM_URL) ? 'forum_id' : 'cat_id';
			$index_value = intval($item['id']);
			if ( $new_item )
			{
				$sql = "INSERT INTO $table ($sql_fields) VALUES($sql_values)";
			}
			else
			{
				$sql = "UPDATE $table SET $sql_update WHERE $index_field=$index_value";
			}
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Couldn\'t update forums/categories table', '', __LINE__, __FILE__, $sql);
			}
		}

		// prune table
		if ( $item['type'] == POST_FORUM_URL )
		{
			if ( !$item['prune_enable'] || $delete_forum )
			{
				$sql = "DELETE FROM " . PRUNE_TABLE . " WHERE forum_id = " . intval($item['id']);
				if ( !$db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Couldn\'t remove from prune table the forum', '', __LINE__, __FILE__, $sql);
				}
			}
			else
			{
				$sql = "SELECT * FROM " . PRUNE_TABLE . " WHERE forum_id = " . intval($item['id']);
				if ( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Couldn\'t access prune table', '', __LINE__, __FILE__, $sql);
				}
				$item['prune_days'] = $_POST['prune_days'];
				$item['prune_freq'] = $_POST['prune_freq'];
				if( $db->sql_numrows($result) > 0 )
				{
					$sql = "UPDATE " . PRUNE_TABLE . " 
								SET prune_days = " . intval($item['prune_days']) . ",
									prune_freq = " . intval($item['prune_freq']) . "
								WHERE forum_id = " . intval($item['id']);
				}
				else
				{
					$sql = "INSERT INTO " . PRUNE_TABLE . " 
								(
									forum_id,
									prune_days, 
									prune_freq
								)
								VALUES(
									" . intval($item['id']) . ",
									" . intval($item['prune_days']) . ", 
									" . intval($item['prune_freq']) . "
								)";
				}
				if ( !$db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Couldn\'t update prune table', '', __LINE__, __FILE__, $sql);
				}
			}
		}

		// clean previous if new created
		if ( $new_item || $delete_forum )
		{
			delete_item( $fid, $item['type'] . $item['id'], $item['move'] );
		}

		// reorder
		reorder_tree();

		// end message
		$selected_id = $item['main'];
		$message = $lang['Forums_updated'] . $return_msg;
		message_die(GENERAL_MESSAGE, $message);
		exit;
	}
	else
	{
		// template
		$template->set_filenames(array(
			'body' => 'admin/forum_extend_edit_body.tpl')
		);

		// header
		$template->assign_vars(array(
			'L_TITLE'							=> $lang['Edit_forum'],
			'L_TITLE_EXPLAIN'					=> $lang['Forum_edit_delete_explain'],

			'L_TYPE'							=> $lang['Forum_type'],
			'L_NAME'							=> $lang['Forum_name'],
			'L_DESC'							=> $lang['Forum_desc'],
			'L_MAIN'							=> $lang['Category_attachment'],
			'L_POSITION'						=> $lang['Position_after'],
			'L_STATUS'							=> $lang['Forum_status'],
			'L_MOVE'							=> $lang['Move_contents'],
			'L_ICON'							=> $lang['icon'],
			'L_ICON_EXPLAIN'					=> $lang['icon_explain'],

			'L_PRUNE_ENABLE'					=> $lang['Forum_pruning'],
			'L_ENABLED'							=> $lang['Enabled'],
			'L_PRUNE_DAYS'						=> $lang['prune_days'],
			'L_PRUNE_FREQ'						=> $lang['prune_freq'],

			'L_LINK'							=> $lang['Forum_link'],
			'L_FORUM_LINK'						=> $lang['Forum_link_url'],
			'L_FORUM_LINK_EXPLAIN'				=> $lang['Forum_link_url_explain'],
			'L_FORUM_LINK_INTERNAL'				=> $lang['Forum_link_internal'],
			'L_FORUM_LINK_INTERNAL_EXPLAIN'		=> $lang['Forum_link_internal_explain'],
			'L_FORUM_LINK_HIT_COUNT'			=> $lang['Forum_link_hit_count'],
			'L_FORUM_LINK_HIT_COUNT_EXPLAIN'	=> $lang['Forum_link_hit_count_explain'],

			'L_AUTH'							=> $lang['Auth_Control_Forum'],
			'L_PRESET'							=> $lang['Presets'],

			'L_SUBMIT'							=> $delete_forum ? $lang['Delete'] : $lang['Submit'],
			'L_CANCEL'							=> $lang['Cancel'],
			'L_REFRESH'							=> $lang['Refresh'],

			'L_YES'								=> $lang['Yes'],
			'L_NO'								=> $lang['No'],
			'L_DAYS'							=> $lang['Days'],
			)
		);

		// type select list
		$s_type_opt = '';
		foreach ($forum_type_list as $key => $value)
		{
			$selected = ( $item['type'] == $key ) ? ' selected="selected"' : '';
			$s_type_opt .= '<option value="' . $key . '"' . $selected . '>' . $lang[$value] . '</option>';
		}

		// status select list
		$s_status_opt = '';
		foreach ($forum_status_list as $key => $value)
		{
			$selected = ( $item['status'] == $key ) ? ' selected="selected"' : '';
			$s_status_opt .= '<option value="' . $key . '"' . $selected . '>' . $lang[$value] . '</option>';
		}

		// presets list
		$s_presets = '';
		$selected = ( $forum_preset < 0) ? ' selected="selected"' : '';
		$s_presets .= '<option value="-1"' . $selected . '>' . $lang['None'] . '</option>';
		$i = 0;
		foreach ($simple_auth_ary as $preset_key => $preset_data)
		{
			$selected = ($preset_key == $forum_preset) ? ' selected="selected"' : '';
			$s_presets .= '<option value="' . $preset_key . '"' . $selected . '>' . $simple_auth_types[$i] . '</option>';
			$i++;
		}

		// position list
		$selected = ($item['position'] == $item['main']) ? ' selected="selected"' : '';
		$s_pos_opt = '<option value="' . $item['main'] . '"' . $selected . '>' . get_object_lang($item['main'], 'name', true) . '</option>';
		for ( $i = 0; isset($tree['sub'][ $item['main'] ]) && $i < count($tree['sub'][ $item['main'] ]); $i++ )
		{
			if ( $tree['sub'][ $item['main'] ][$i] != $fid )
			{
				$selected = ($tree['sub'][ $item['main'] ][$i] == $item['position']) ? ' selected="selected"' : '';
				$s_pos_opt .= '<option value="' . $tree['sub'][ $item['main'] ][$i] . '"' . $selected . '>|--&nbsp;' . get_object_lang($tree['sub'][ $item['main'] ][$i], 'name', true) . '</option>';
			}
		}

		// place to move topics and attachements
		$s_move_opt = get_tree_option('--', true);
		$s_move_opt = '<option value="" selected="selected">' . $lang['Delete_all_posts'] . '</option>' . $s_move_opt;

		// icon
		$icon_img = empty($item['icon']) ? '' : '<br /><img src="' . ( isset($images[ $item['icon'] ]) ? $phpbb_root_path . $images[ $item['icon'] ] : $item['icon'] ) . '" border="0" alt="' . $item['icon'] . '" title="' . $item['icon'] . '" />';

		// vars
		$template->assign_vars(array(
			'S_TYPE_OPT'		=> $s_type_opt,
			'NAME'				=> str_replace("''", "'", $item['name']),
			'DESC'				=> str_replace("''", "'", $item['desc']),
			'S_FORUMS_OPT'		=> get_tree_option($item['main'], true),
			'S_POS_OPT'			=> $s_pos_opt,
			'S_STATUS_OPT'		=> $s_status_opt,
			'S_MOVE_OPT'		=> $s_move_opt,
			'ICON'				=> $item['icon'],
			'ICON_IMG'			=> $icon_img,

			'PRUNE_DISPLAY'		=> !empty($item['prune_enable']) ? '' : 'none',
			'PRUNE_ENABLE_YES'	=> !empty($item['prune_enable']) ? 'checked="checked"' : '',
			'PRUNE_ENABLE_NO'	=> empty($item['prune_enable']) ? 'checked="checked"' : '',
			'PRUNE_DAYS'		=> $item['prune_days'],
			'PRUNE_FREQ'		=> $item['prune_freq'],
			'FORUM_LINK'		=> ( isset($item['link']) ? $item['link'] : '' ) ,

			'LINK_INTERNAL_YES'	=> !empty($item['link_internal']) ? 'checked="checked"' : '',
			'LINK_INTERNAL_NO'	=> empty($item['link_internal']) ? 'checked="checked"' : '',
			'LINK_COUNT_YES'	=> !empty($item['link_hit_count']) ? 'checked="checked"' : '',
			'LINK_COUNT_NO'		=> empty($item['link_hit_count']) ? 'checked="checked"' : '',

			'S_PRESET_OPT'		=> $s_presets,
			'AUTH_SPAN'			=> ($item['type'] == POST_FORUM_URL) ? 4 : 1,
			)
		);

		// some switches
		if ( $item['type'] == POST_CAT_URL )
		{
			$template->assign_block_vars('category', array());
		}
		else
		{
			$template->assign_block_vars('no_category', array());
		}
		if ( $item['type'] == POST_FORUM_URL )
		{
			$template->assign_block_vars('forum', array());
		}
		else
		{
			$template->assign_block_vars('no_forum', array());
		}
		if ( $item['type'] == POST_FLINK_URL )
		{
			$template->assign_block_vars('link', array());
		}
		else
		{
			$template->assign_block_vars('no_link', array());
		}
		if ( in_array($item['type'], array(POST_FORUM_URL, POST_FLINK_URL)) )
		{
			$template->assign_block_vars('forum_link', array());
			if ( $item['type'] == POST_FLINK_URL )
			{
				$template->assign_block_vars('forum_link.link', array());
			}
			else
			{
				$template->assign_block_vars('forum_link.no_link', array());
			}
		}

		// place to move topics
		if ( $delete_forum || ( ($old_type == POST_FORUM_URL) && ($item['type'] != POST_FORUM_URL) ) )
		{
			// check if any topics in this forum
			$topics = false;
			$sql = "SELECT * FROM " . TOPICS_TABLE . " WHERE forum_id = $old_id LIMIT 0, 1";
			if ( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Couldn\'t access topics table', '', __LINE__, __FILE__, $sql);
			}
			if ($row = $db->sql_fetchrow($result))
			{
				$topics = true;
			}
			if ( $topics || !empty($tree['sub'][$fid]) )
			{
				$template->assign_block_vars('move', array());
			}
		}

		// auth
		if ( $item['type'] != POST_CAT_URL )
		{
			// list of auth
			$offset = 3;
			$color_line = false;
			foreach ($forum_auth as $key => $value)
			{
				// forum link only use the auth view
				if ( ($item['type'] == POST_FORUM_URL) || ($key == 'auth_view') )
				{
					$s_auth_opt = '';
					for ( $i = 0; $i < count($forum_auth_const); $i++)
					{
						$auth_key = $forum_auth_const[$i];
						$auth_value = $forum_auth_levels[$i];
						$selected = ($auth_key == $value) ? ' selected="selected"' : '';
						$s_auth_opt .= '<option value="' . $auth_key . '"' . $selected . '>' . ( isset($lang['Forum_' . $auth_value]) ? $lang['Forum_' . $auth_value] : $auth_value ) . '</option>';
					}

					// try to find a legend
					$l_key = $key;
					if ( isset($field_names[$key]) )
					{
						$l_key = $field_names[$key];
					}
					else
					{
						$l_key = ucfirst(str_replace('_', ' ', substr($key, strlen('auth_'))));
					}

					// new line
					$offset++;
					if ( $offset > 3 )
					{
						$color_line = !$color_line;
						$template->assign_block_vars('forum_link.auth', array() );
						$offset = 0;
						$color = !$color_line;
					}
					$color = !$color;
					$template->assign_block_vars('forum_link.auth.cell', array(
						'COLOR'			=> $color ? 'row1' : 'row2',
						'L_AUTH'		=> isset($lang[$l_key]) ? $lang[$l_key] : $l_key,
						'AUTH'			=> $key,
						'S_AUTH_OPT'	=> $s_auth_opt,
						)
					);
				}
			}

			// finish the line
			if ( ($item['type'] == POST_FORUM_URL) && ($offset < 3) )
			{
				$template->assign_block_vars('forum_link.auth.empty', array(
					'SPAN'	=> 3 - $offset,
					)
				);
			}
		}

		// topic display order
		if ( defined('TOPIC_DISPLAY_ORDER') && ($item['type'] != POST_CAT_URL) )
		{
			$forum_display_sort_list = get_forum_display_sort_option($item['forum_display_sort'], 'list', 'sort');
			$forum_display_order_list = get_forum_display_sort_option($item['forum_display_order'], 'list', 'order');
			$template->assign_vars(array(
				'L_FORUM_DISPLAY_SORT'			=> $lang['Sort_by'],
				'S_FORUM_DISPLAY_SORT_LIST'		=> $forum_display_sort_list,
				'S_FORUM_DISPLAY_ORDER_LIST'	=> $forum_display_order_list,
				)
			);
			$template->assign_block_vars('forum.topic_display_order', array());
		}

		// footer
		$s_hidden_fields = '';
		$s_hidden_fields .= '<input type="hidden" name="mode" value="' . $mode . '" />';
		$s_hidden_fields .= '<input type="hidden" name="selected_id" value="' . $selected_id . '" />';
		$s_hidden_fields .= '<input type="hidden" name="fid" value="' . $fid . '" />';
		$template->assign_vars(array(
			'L_INDEX'			=> sprintf($lang['Forum_Index'], $board_config['sitename']),
			'NAV_CAT_DESC'		=> admin_get_nav_cat_desc($selected_id),
			'S_HIDDEN_FIELDS'	=> $s_hidden_fields,

			'U_INDEX'			=> append_sid("./admin_forums_extend.$phpEx"),
			'S_ACTION'			=> append_sid("./admin_forums_extend.$phpEx"),
			)
		);
	}
}

// display the main list
if ( $mode == '' )
{
	// template
	$template->set_filenames(array(
		'body' => 'admin/forum_extend_body.tpl')
	);

	// header
	$template->assign_vars(array(
		'L_TITLE'			=> $lang['Forum_admin'],
		'L_TITLE_EXPLAIN'	=> $lang['Forum_admin_explain'],

		'L_ICON'			=> $lang['icon'],
		'L_ICON_EXPLAIN'	=> $lang['icon_explain'],
		'L_FORUM'			=> get_object_lang($selected_id, 'name', true),
		'L_TOPICS'			=> $lang['Topics'],
		'L_POSTS'			=> $lang['Posts'],
		'L_ACTION'			=> $lang['Action'],

		'L_EDIT'			=> $lang['Edit'],
		'L_DELETE'			=> $lang['Delete'],
		'L_MOVEUP'			=> $lang['Move_up'],
		'L_MOVEDW'			=> $lang['Move_down'],
		'IMG_MOVEUP'		=> $phpbb_root_path . $images['up_arrow'],
		'IMG_MOVEDW'		=> $phpbb_root_path . $images['down_arrow'],
		'L_RESYNC'			=> $lang['Resync'],

		'L_CREATE_FORUM'	=> $lang['Create_forum'],
		'L_EDIT_FORUM'		=> $lang['Edit_forum'],
		'L_DELETE_FORUM'	=> $lang['Forum_delete'],
		'L_RESYNC_FORUM'	=> $lang['Resync'],

		'NO_SUBFORUMS'		=> $lang['No_subforums'],
		)
	);
	if ( $selected_id != 'Root' )
	{
		$template->assign_block_vars( 'no_root', array() );
	}
	else
	{
		$template->assign_block_vars( 'root', array() );
	}

	$color = false;
	for ($i=0; isset($tree['sub'][$selected_id]) && $i < count($tree['sub'][$selected_id]); $i++)
	{
		$this_key = $tree['sub'][$selected_id][$i];
		$idx = $tree['keys'][$this_key];

		// get data for this level
		$folder = $images['forum'];
		$l_folder = $lang['Forum'];
		if ( isset($tree['data'][$idx]['forum_status']) && $tree['data'][$idx]['forum_status'] == FORUM_LOCKED)
		{
			$folder = $images['forum_locked'];
			$l_folder = $lang['Forum_locked'];
		}
		if ( ($tree['type'][$idx] == POST_CAT_URL) || !empty($tree['sub'][$this_key]) )
		{
			$folder = $images['category'];
			$l_folder = $lang['Category'];
			if (isset($tree['data'][$idx]['forum_status']) && $tree['data'][$idx]['forum_status'] == FORUM_LOCKED)
			{
				$folder = $images['category_locked'];
				$l_folder = $lang['Category_locked'];
			}
		}
		if ( !empty($tree['data'][$idx]['forum_link']) )
		{
			$folder = $images['link'];
			$l_folder = $lang['Forum_link'];
		}

		// is there some sub-levels for this level ?
		$sub = isset($tree['sub'][$this_key]);
		$links = '';
		for ($j = 0; isset($tree['sub'][$this_key]) && $j < count($tree['sub'][$this_key]); $j++ )
		{
			$sub_this = $tree['sub'][$this_key][$j];
			$sub_idx = $tree['keys'][$sub_this];

			// sub folder icon
			$sub_folder = $images['icon_minipost'];
			$sub_l_folder = $lang['Forum'];
			if ( $tree['data'][$sub_idx]['forum_status'] == FORUM_LOCKED)
			{
				$sub_folder = $images['icon_minipost_lock'];
				$sub_l_folder = $lang['Forum_locked'];
			}
			if ( ($tree['type'][$sub_idx] == POST_CAT_URL) || !empty($tree['sub'][$sub_this]) )
			{
				$sub_folder = $images['icon_minicat'];
				$sub_l_folder = $lang['Category'];
				if ( $tree['data'][$sub_idx]['forum_status'] == FORUM_LOCKED)
				{
					$sub_folder = $images['icon_minicat_locked'];
					$sub_l_folder = $lang['Category_locked'];
				}
			}
			if ( !empty($tree['data'][$sub_idx]['forum_link']) )
			{
				$sub_folder = $images['icon_minilink'];
				$sub_l_folder = $lang['Forum_link'];
			}

			// sub level link
			$sub_folder = $phpbb_root_path . $sub_folder;
			$link = '<a href="' . append_sid("./admin_forums_extend.$phpEx?selected_id=$sub_this") . '" class="gensmall" title="' . preg_replace('/<[^>]+>/', '', get_object_lang($sub_this, 'desc', true)) . '">';
			$link .= '<img src="' . $sub_folder . '" border="0" alt="' . $sub_l_folder . '" title="' . $sub_l_folder . '" align="middle" />';
			$link .= '&nbsp;' . get_object_lang($sub_this, 'name', true) . '</a>';
			$links .= ( empty($links) ? '' : ', ' ) . $link;
		}

		$icon = $icon_img = '';
		if ( !empty($tree['data'][$idx]['icon']) )
		{
			$icon = $tree['data'][$idx]['icon'];
			$icon_img = $icon;
			if ( isset($images[$icon_img]) )
			{
				$icon_img = $phpbb_root_path . $images[$icon_img];
			}
		}
		$color = !$color;
		$template->assign_block_vars('row', array(
			'COLOR'			=> $color ? 'row1' : 'row2',
			'FOLDER'		=> $phpbb_root_path . $folder,
			'L_FOLDER'		=> $l_folder,
			'ICON_IMG'		=> $icon_img,
			'ICON'			=> $icon,
			'FORUM_NAME'	=> get_object_lang($this_key, 'name', true),
			'FORUM_DESC'	=> get_object_lang($this_key, 'desc', true),
			'TOPICS'		=> $tree['data'][$idx]['tree.forum_topics'],
			'POSTS'			=> $tree['data'][$idx]['tree.forum_posts'],
			'LINKS'			=> empty($links) ? '' : '<br /><b>' . $lang['Subforums'] . ':&nbsp;</b>' . $links,

			'U_FORUM'		=> append_sid("./admin_forums_extend.$phpEx?selected_id=$this_key"),
			'U_EDIT'		=> append_sid("./admin_forums_extend.$phpEx?mode=edit&fid=$this_key"),
			'U_DELETE'		=> append_sid("./admin_forums_extend.$phpEx?mode=delete&fid=$this_key"),
			'U_RESYNC'		=> append_sid("./admin_forums_extend.$phpEx?mode=resync&fid=$this_key"),
			'U_MOVEUP'		=> append_sid("./admin_forums_extend.$phpEx?mode=moveup&fid=$this_key"),
			'U_MOVEDW'		=> append_sid("./admin_forums_extend.$phpEx?mode=movedw&fid=$this_key"),
			)
		);

		if ( !empty($icon) )
		{
			$template->assign_block_vars('row.forum_icon', array());
		}
	}

	// no subforums
	if ( empty($tree['sub'][$selected_id]) )
	{
		$template->assign_block_vars( 'empty', array() );
	}

	// footer
	$s_hidden_fields = '';
	$s_hidden_fields .= '<input type="hidden" name="selected_id" value="' . $selected_id . '" />';
	$template->assign_vars(array(
		'L_INDEX'			=> sprintf($lang['Forum_Index'], $board_config['sitename']),
		'NAV_CAT_DESC'		=> admin_get_nav_cat_desc($selected_id),
		'S_HIDDEN_FIELDS'	=> $s_hidden_fields,

		'U_INDEX'			=> append_sid("./admin_forums_extend.$phpEx"),
		'S_ACTION'			=> append_sid("./admin_forums_extend.$phpEx"),
		)
	);
}

// dump
$template->pparse('body');
include('./page_footer_admin.'.$phpEx);
$var_cache->clean('forum');
