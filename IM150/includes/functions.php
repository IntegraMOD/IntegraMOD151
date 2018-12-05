<?php
/***************************************************************************
 *                               functions.php
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


// Security update 02 September 2006 starts // 
if (!defined('IN_PHPBB'))	die("Hack Attemp# 25");
// Assume IN_PHPBB is set before calling any function in functions.php (include...) //
// then the next line is all that is needed to stop hacks //
/*
$phpEx = 'php';
$pass = 0;
if($phpbb_root_path == './' || $phpbb_root_path == '../' || $phpbb_root_path == './../' || $phpbb_root_path == ''  || $phpbb_root_path == ' ') $pass=1;
 
if(strlen($phpbb_root_path) > 5) $pass=0;
 
if($pass == 0) 
{
 die('Hacking attempt #32... Details Logged'); 
 exit;
}
*/
// Security update 02 September 2006 ends // 
	
//-- mod : cache -----------------------------------------------------------------------------------
//-- add
include_once( $phpbb_root_path . './includes/functions_cache.' . $phpEx);
//-- fin mod : cache -------------------------------------------------------------------------------
	
//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
include_once( $phpbb_root_path . './includes/functions_categories_hierarchy.' . $phpEx );
//-- fin mod : categories hierarchy ----------------------------------------------------------------

/**
 * A count function that's null-safe.
 * Added for migration of Integramod to PHP7.
 */
function count_safe($o)
{
  return $o ? count($o) : 0;
}

//-- mod : post icon -------------------------------------------------------------------------------
//-- add
function get_icon_title($icon, $empty=0, $topic_type=-1, $admin=false)
{
	global $lang, $images, $phpEx, $phpbb_root_path;

	// get icons parameters
	include($phpbb_root_path . './includes/def_icons.' . $phpEx);

	// admin path
	$admin_path = ($admin) ? '../' : './';

	// alignment
	switch ($empty)
	{
		case 1:
			$align= 'middle';
			break;
		case 2:
			$align= 'bottom';
			break;
		default:
			$align = 'absbottom';
			break;
	}

	// find the icon
	$found = false;
	$icon_map = -1;
	for ($i=0; ($i < count($icones)) && !$found; $i++)
	{
		if ($icones[$i]['ind'] == $icon)
		{
			$found = true;
			$icon_map = $i;
		}
	}

	// icon not found : try a default value
	if (!$found || ($found && empty($icones[$icon_map]['img'])))
	{
		$change = true;
		switch($topic_type)
		{
			case POST_NORMAL:
				$icon = $icon_defined_special['POST_NORMAL']['icon'];
				break;
			case POST_STICKY:
				$icon = $icon_defined_special['POST_STICKY']['icon'];
				break;
			case POST_ANNOUNCE:
				$icon = $icon_defined_special['POST_ANNOUNCE']['icon'];
				break;
			case POST_GLOBAL_ANNOUNCE:
				$icon = $icon_defined_special['POST_GLOBAL_ANNOUNCE']['icon'];
				break;
			case POST_BIRTHDAY:
				$icon = $icon_defined_special['POST_BIRTHDAY']['icon'];
				break;
			case POST_CALENDAR:
				$icon = $icon_defined_special['POST_CALENDAR']['icon'];
				break;
			case POST_PICTURE:
				$icon = $icon_defined_special['POST_PICTURE']['icon'];
				break;
			case POST_ATTACHMENT:
				$icon = $icon_defined_special['POST_ATTACHEMENT']['icon'];
				break;
			default:
				$change=false;
				break;
		}

		// a default icon has been sat
		if ($change)
		{
			// find the icon
			$found = false;
			$icon_map = -1;
			for ($i=0; ($i < count($icones)) && !$found; $i++)
			{
				if ($icones[$i]['ind'] == $icon)
				{
					$found = true;
					$icon_map = $i;
				}
			}
		}
	}

	// build the icon image
	if (!$found || ($found && empty($icones[$icon_map]['img'])))
	{
		switch ($empty)
		{
			case 0:
				$res = '';
				break;
			case 1:
				$res = '<img width="20" align="' . $align . '" src="' . $admin_path . $images['spacer'] . '" alt="" border="0">';
				break;
			case 2:
				$res = isset($lang[ $icones[$icon_map]['alt'] ]) ? $lang[ $icones[$icon_map]['alt'] ] : $icones[$icon_map]['alt'];
				break;
		}
	}
	else
	{
		$res = '<img align="' . $align . '" src="' . ( isset($images[ $icones[$icon_map]['img'] ]) ? $admin_path . $images[ $icones[$icon_map]['img'] ] : $admin_path . $icones[$icon_map]['img'] ) . '" alt="' . ( isset($lang[ $icones[$icon_map]['alt'] ]) ? $lang[ $icones[$icon_map]['alt'] ] : $icones[$icon_map]['alt'] ) . '" border="0">';
	}

	return $res;
}
//-- fin mod : post icon ---------------------------------------------------------------------------

//-- mod : keep unread -----------------------------------------------------------------------------
//-- add
// maximum number of items (topic_id) per cookie
define('MAX_COOKIE_ITEM', 300);
define('KEEP_UNREAD_DB', true);

function read_cookies($userdata)
{
	global $board_config, $_COOKIE;

	// do we use the tracking ?
	if ( !isset($board_config['keep_unreads']) )
	{
		$board_config['keep_unreads'] = true;
	}
	if ( !isset($board_config['keep_unreads_db']) )
	{
		$board_config['keep_unreads_db'] = KEEP_UNREAD_DB;
	}

	// do we use database to store data ?
	if ( !$userdata['session_logged_in'] || !$board_config['keep_unreads'] )
	{
		$board_config['keep_unreads_db'] = false;
	}

	// cookies name
	$user_id = $userdata['user_id'];
	if ( $user_id == ANONYMOUS )
	{
		$user_id = '_';
	}
	$base_name = $board_config['cookie_name'] . '_' . $user_id;

	// get the anonymous last visit date
	if ( !$userdata['session_logged_in'] )
	{
		$board_config['guest_lastvisit'] = intval($_COOKIE[$base_name . '_lastvisit']);
		if ( $board_config['guest_lastvisit'] < (time()-300) )
		{
			$board_config['guest_lastvisit'] = time();
			setcookie($base_name . '_lastvisit', intval($board_config['guest_lastvisit']), $current_time + 31536000, $board_config['cookie_path'], $board_config['cookie_domain'], $board_config['cookie_secure']);
		}
	}

	// read the user cookies
	$board_config['tracking_all']		= isset($_COOKIE[$base_name . '_f_all']) ? intval($_COOKIE[$base_name . '_f_all']) : 0;
	$board_config['tracking_forums']	= isset($_COOKIE[$base_name . '_f']) ? unserialize($_COOKIE[$base_name . '_f']) : array();
	$board_config['tracking_topics']	= isset($_COOKIE[$base_name . '_t']) ? unserialize($_COOKIE[$base_name . '_t']) : array();

	// get the unreads topics
	$board_config['tracking_unreads'] = array();
	if ( $board_config['keep_unreads'] )
	{
		if ( !$board_config['keep_unreads_db'] )
		{
			$board_config['tracking_unreads'] = isset($_COOKIE[$base_name . '_u']) ? unserialize($_COOKIE[$base_name . '_u']) : array();

			// the tracking floor (min time value) allows to reduce the size of the time data, so the size of the cookie
			$tracking_floor = intval($_COOKIE[$base_name . '_uf']);
			if ( $tracking_floor > 0 )
			{
				@reset( $board_config['tracking_unreads'] );
				while ( list($topic_id, $topic_time) = @each($board_config['tracking_unreads']) )
				{
					$board_config['tracking_unreads'][$topic_id] += $tracking_floor;
				}
			}
		}
		else if ( $userdata['session_logged_in'] )
		{
			// we don't use serialized data to gain some digits
			$w_unreads = empty($userdata['user_unread_topics']) ? array() : explode(';', $userdata['user_unread_topics']);
			$tracking_floor = intval($w_unreads[0]);
			for ( $i = 1; $i < count($w_unreads); $i++ )
			{
				$topic_data = explode(':', $w_unreads[$i]);
				$board_config['tracking_unreads'][ intval($topic_data[0]) ] = intval($topic_data[1]) + $tracking_floor;
			}
		}
	}

	define('COOKIE_READ', true);
}

function write_cookies($userdata)
{
	global $board_config, $_COOKIE, $db;

	// do we use the tracking ?
	if ( !isset($board_config['keep_unreads']) )
	{
		$board_config['keep_unreads'] = true;
	}
	if ( !isset($board_config['keep_unreads_db']) )
	{
		$board_config['keep_unreads_db'] = KEEP_UNREAD_DB;
	}

	// do we use database to store data ?
	if ( !$userdata['session_logged_in'] || !$board_config['keep_unreads'] )
	{
		$board_config['keep_unreads_db'] = false;
	}

	// check if the cookie has been read (prevent any erase)
	if ( !defined('COOKIE_READ') )
	{
		return;
	}

	// current time
	$current_time = time();

	// cookies name
	$user_id = $userdata['user_id'];
	if ( $user_id == ANONYMOUS )
	{
		$user_id = '_';
	}
	$base_name = $board_config['cookie_name'] . '_' . $user_id;

	// check cookie sizes
	if ( count($board_config['tracking_topics']) > MAX_COOKIE_ITEM )
	{
		asort($board_config['tracking_topics']);
		$nb = count($board_config['tracking_topics']) - MAX_COOKIE_ITEM;
		while ( ($nb > 0) && ( list($id, $time) = @each($board_config['tracking_topics']) ) )
		{
			unset($board_config['tracking_topics'][$id]);
		}
	}
	if ( $board_config['keep_unreads'] )
	{
		// sort the unread array
		if ( !empty($board_config['tracking_unreads']) )
		{
			asort($board_config['tracking_unreads']);
		}
		if ( count($board_config['tracking_unreads']) > MAX_COOKIE_ITEM )
		{
			$nb = count($board_config['tracking_unreads']) - MAX_COOKIE_ITEM;
			while ( ($nb > 0) && ( list($id, $time) = @each($board_config['tracking_unreads']) ) )
			{
				unset($board_config['tracking_unreads'][$id]);
			}
		}
	}

	// except the cookies
	@setcookie($base_name . '_f_all', intval($board_config['tracking_all']), 0, $board_config['cookie_path'], $board_config['cookie_domain'], $board_config['cookie_secure']);
	@setcookie($base_name . '_f', serialize($board_config['tracking_forums']), 0, $board_config['cookie_path'], $board_config['cookie_domain'], $board_config['cookie_secure']);
	@setcookie($base_name . '_t', serialize($board_config['tracking_topics']), 0, $board_config['cookie_path'], $board_config['cookie_domain'], $board_config['cookie_secure']);

	// store the unread topics
	$sql = '';
	if ( $board_config['keep_unreads'] )
	{
		// the array is already sorted
		$tracking_floor = 0;
		$tracking_unreads = $board_config['tracking_unreads'];
		if ( !empty($tracking_unreads) )
		{
			// get the first then substract the value to each
			$first_found = false;
			@reset($tracking_unreads);
			while ( list($topic_id, $topic_time) = @each($tracking_unreads) )
			{
				if ( !$first_found )
				{
					$tracking_floor = intval($topic_time);
					$first_found = true;
				}
				$tracking_unreads[$topic_id] -= $tracking_floor;
			}
		}

		if ( !$board_config['keep_unreads_db'] )
		{
			@setcookie($base_name . '_uf', intval($tracking_floor), time() + 31536000, $board_config['cookie_path'], $board_config['cookie_domain'], $board_config['cookie_secure']);
			@setcookie($base_name . '_u', serialize($tracking_unreads), time() + 31536000, $board_config['cookie_path'], $board_config['cookie_domain'], $board_config['cookie_secure']);

			// erase the users table to prevent a timewrap if the user reactivate the unreads database storage
			if ( !empty($userdata['user_unread_topics']) && $userdata['session_logged_in'] )
			{
				$sql = "UPDATE " . USERS_TABLE . "
							SET user_unread_topics = NULL
							WHERE user_id = " . intval($userdata['user_id']);
			}
		}
		else if ( $userdata['session_logged_in'] )
		{
			@reset($tracking_unreads);
			while ( list($topic_id, $topic_time) = @each($tracking_unreads) )
			{
				if ( !empty($topic_id) )
				{
					if ( empty($sql) )
					{
						$sql = intval($tracking_floor);
					}
					$sql .= ';' . intval($topic_id) . ':' . intval($topic_time);
				}
			}
			if ( !empty($sql) )
			{
				$sql = "UPDATE " . USERS_TABLE . "
							SET user_unread_topics = '$sql'
							WHERE user_id = " . intval($userdata['user_id']);
			}
			else
			{
				$sql = "UPDATE " . USERS_TABLE . "
							SET user_unread_topics = NULL
							WHERE user_id = " . intval($userdata['user_id']);
			}
		}
	}
	if ( !empty($sql) )
	{
		if ( !$db->sql_query($sql) )
		{
			message_die(CRITICAL_ERROR, 'Failed to update users table for unread topics', '', __LINE__, __FILE__, $sql);
		}
	}
}
//-- fin mod : keep unread -------------------------------------------------------------------------

function get_db_stat($mode)
{
//-- mod : cache -----------------------------------------------------------------------------------
//-- add
	global $board_config;

	// first inits
	if ( !isset($board_config['max_users']) || !isset($board_config['record_last_user_id']) || !isset($board_config['record_last_username']) )
	{
		users_stats();
		cache_birthday();
	}
	if ( !isset($board_config['max_posts']) || !isset($board_config['max_topics']) )
	{
		board_stats();
	}
	switch ( $mode )
	{
		case 'usercount':
			return intval($board_config['max_users']);
			break;
		case 'newestuser':
      $row = array(
        'user_id' => intval($board_config['record_last_user_id']),
        'username' => $board_config['record_last_username'],
        'user_group_id' => $board_config['record_last_user_group_id'],
        'user_session_time' => $board_config['record_user_session_time'],
      );
			return $row;
			break;
		case 'postcount':
			return intval($board_config['max_posts']);
			break;
		case 'topiccount':
			return intval($board_config['max_topics']);
			break;
	}
//-- fin mod : cache -------------------------------------------------------------------------------

	global $db, $board_config, $phpbb_root_path, $phpEx;
	if ( empty($board_config['max_posts']) 
		|| empty($board_config['max_users']) 
		|| empty($board_config['max_topics'])) {
			board_stats();
	}
	switch( $mode )
	{
		case 'usercount':
			return $board_config['max_users'];
			break;

		case 'newestuser':
			$sql = "SELECT user_id, username, user_group_id, user_session_time 
				FROM " . USERS_TABLE . "
				WHERE user_id <> " . ANONYMOUS . "
				ORDER BY user_id DESC
				LIMIT 1";
			if ( !($result = $db->sql_query($sql)) ){
		return false;
	}
	$row = $db->sql_fetchrow($result);
			return $row;
			break;

		case 'postcount':
			return $board_config['max_posts'];
			break;
			
		case 'topiccount':
			return $board_config['max_topics'];
			break;
	}

	return false;
}

// added at phpBB 2.0.11 to properly format the username
function phpbb_clean_username($username)
{
	$username = substr(htmlspecialchars(str_replace("\'", "'", trim($username))), 0, 25);
	$username = phpbb_rtrim($username, "\\");
	$username = str_replace("'", "\'", $username);

   return $username;
}

/**
* This function is a wrapper for ltrim, as charlist is only supported in php >= 4.1.0
* Added in phpBB 2.0.18
*/
function phpbb_ltrim($str, $charlist = false)
{
	if ($charlist === false)
	{
		return ltrim($str);
	}
	
	$php_version = explode('.', PHP_VERSION);

	// php version < 4.1.0
	if ((int) $php_version[0] < 4 || ((int) $php_version[0] == 4 && (int) $php_version[1] < 1))
	{
		while ($str{0} == $charlist)
		{
			$str = substr($str, 1);
		}
	}
	else
	{
		$str = ltrim($str, $charlist);
	}

	return $str;
}

/**
* Our own generator of random values
* This uses a constantly changing value as the base for generating the values
* The board wide setting is updated once per page if this code is called
* With thanks to Anthrax101 for the inspiration on this one
* Added in phpBB 2.0.20
*/
function dss_rand()
{
	global $db, $board_config, $dss_seeded;

	$val = $board_config['rand_seed'] . microtime();
	$val = md5($val);
	$board_config['rand_seed'] = md5($board_config['rand_seed'] . $val . 'a');
   
	if($dss_seeded !== true)
	{
		$sql = "UPDATE " . CONFIG_TABLE . " SET
			config_value = '" . $board_config['rand_seed'] . "'
			WHERE config_name = 'rand_seed'";
		
		if( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Unable to reseed PRNG", "", __LINE__, __FILE__, $sql);
		}

		$dss_seeded = true;
	}

	return substr($val, 4, 16);
}


// added at phpBB 2.0.12 to fix a bug in PHP 4.3.10 (only supporting charlist in php >= 4.1.0)
function phpbb_rtrim($str, $charlist = false)
{
	if ($charlist === false)
	{
		return rtrim($str);
	}
	
	$php_version = explode('.', PHP_VERSION);

	// php version < 4.1.0
	if ((int) $php_version[0] < 4 || ((int) $php_version[0] == 4 && (int) $php_version[1] < 1))
	{
		while ($str{strlen($str)-1} == $charlist)
		{
			$str = substr($str, 0, strlen($str)-1);
		}
	}
	else
	{
		$str = rtrim($str, $charlist);
	}

	return $str;
}


//
// Get Userdata, $user can be username or user_id. If force_str is true, the username will be forced.
//
function get_userdata($user, $force_str = false)
{
	global $db;

	if (!is_numeric($user) || $force_str)
	{
		$user = phpbb_clean_username($user);
	}
	else
	{
		$user = intval($user);
	}

	$sql = "SELECT *
		FROM " . USERS_TABLE . " 
		WHERE ";
	$sql .= ( ( is_integer($user) ) ? "user_id = $user" : "username = '" .  str_replace("\'", "''", $user) . "'" ) . " AND user_id <> " . ANONYMOUS;
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Tried obtaining data for a non-existent user', '', __LINE__, __FILE__, $sql);
	}

	return ( $row = $db->sql_fetchrow($result) ) ? $row : false;
}

function make_jumpbox($action, $match_forum_id = 0)
{
	global $template, $userdata, $lang, $db, $nav_links, $phpEx, $SID;

//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
	return jumpbox($action, $match_forum_id);
//-- fin mod : categories hierarchy ----------------------------------------------------------------

//	$is_auth = auth(AUTH_VIEW, AUTH_LIST_ALL, $userdata);

	$sql = "SELECT c.cat_id, c.cat_title, c.cat_order
		FROM " . CATEGORIES_TABLE . " c, " . FORUMS_TABLE . " f
		WHERE f.cat_id = c.cat_id
		GROUP BY c.cat_id, c.cat_title, c.cat_order
		ORDER BY c.cat_order";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Couldn't obtain category list.", "", __LINE__, __FILE__, $sql);
	}
	
	$category_rows = array();
	while ( $row = $db->sql_fetchrow($result) )
	{
		$category_rows[] = $row;
	}

	if ( $total_categories = count($category_rows) )
	{
		$sql = "SELECT *
			FROM " . FORUMS_TABLE . "
			ORDER BY cat_id, forum_order";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain forums information', '', __LINE__, __FILE__, $sql);
		}

		$boxstring = '<select name="' . POST_FORUM_URL . '" onchange="if(this.options[this.selectedIndex].value != -1){ forms[\'jumpbox\'].submit() }"><option value="-1">' . $lang['Select_forum'] . '</option>';

		$forum_rows = array();
		while ( $row = $db->sql_fetchrow($result) )
		{
			$forum_rows[] = $row;
		}

		if ( $total_forums = count($forum_rows) )
		{
			for($i = 0; $i < $total_categories; $i++)
			{
				$boxstring_forums = '';
				for($j = 0; $j < $total_forums; $j++)
				{
					if ( $forum_rows[$j]['cat_id'] == $category_rows[$i]['cat_id'] && $forum_rows[$j]['auth_view'] <= AUTH_REG )
					{

//					if ( $forum_rows[$j]['cat_id'] == $category_rows[$i]['cat_id'] && $is_auth[$forum_rows[$j]['forum_id']]['auth_view'] )
//					{
						$selected = ( $forum_rows[$j]['forum_id'] == $match_forum_id ) ? 'selected="selected"' : '';
						$boxstring_forums .=  '<option value="' . $forum_rows[$j]['forum_id'] . '"' . $selected . '>' . $forum_rows[$j]['forum_name'] . '</option>';

						//
						// Add an array to $nav_links for the Mozilla navigation bar.
						// 'chapter' and 'forum' can create multiple items, therefore we are using a nested array.
						//
						$nav_links['chapter forum'][$forum_rows[$j]['forum_id']] = array (
							'url' => append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=" . $forum_rows[$j]['forum_id']),
							'title' => $forum_rows[$j]['forum_name']
						);
								
					}
				}

				if ( $boxstring_forums != '' )
				{
					$boxstring .= '<option value="-1">&nbsp;</option>';
					$boxstring .= '<option value="-1">' . $category_rows[$i]['cat_title'] . '</option>';
					$boxstring .= '<option value="-1">----------------</option>';
					$boxstring .= $boxstring_forums;
				}
			}
		}

		$boxstring .= '</select>';
	}
	else
	{
		$boxstring .= '<select name="' . POST_FORUM_URL . '" onchange="if(this.options[this.selectedIndex].value != -1){ forms[\'jumpbox\'].submit() }"></select>';
	}

// Let the jumpbox work again in sites having additional session id checks.
//   if ( !empty($SID) )
//   {
      $boxstring .= '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';
//   } 

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

//
// Initialise user settings on page load
function init_userprefs($userdata)
{
	// BEGIN Style Select MOD
	global $_GET, $_POST, $_COOKIE;
	// END Style Select MOD
	global $is_called;
	if ( $is_called == FALSE )
	{
		global $board_config, $theme, $images;
		global $template, $lang, $phpEx, $phpbb_root_path, $db;
		global $nav_links;
		global $db;

	//-- mod : profile cp ------------------------------------------------------------------------------
	//-- add
		global $admin_level, $level_prior, $level_desc;
		global $values_list, $tables_linked, $classes_fields, $user_maps, $user_fields;
		global $list_yes_no;

		include_once( $phpbb_root_path . './profilcp/functions_profile.' . $phpEx);
	//-- fin mod : profile cp --------------------------------------------------------------------------
		if ( $userdata['user_id'] != ANONYMOUS )
		{

			if ( !empty($userdata['user_lang']))
			{
				$default_lang = phpbb_ltrim(basename(phpbb_rtrim($userdata['user_lang'])), "'");
			}

			if ( !empty($userdata['user_dateformat']) )
			{
				$board_config['default_dateformat'] = $userdata['user_dateformat'];
			}

			if ( isset($userdata['user_timezone']) )
			{
				$board_config['real_board_timezone'] = $board_config['board_timezone']; // copy real timezone for board2usertime
				$board_config['board_timezone'] = $userdata['user_timezone'];
			}
				if ( isset($userdata['user_fdow']) )
				{
					$board_config['board_fdow'] = $userdata['user_fdow'];
				}
		}

	else
	{
		$default_lang = phpbb_ltrim(basename(phpbb_rtrim($board_config['default_lang'])), "'");
	}

	if ( !file_exists(@phpbb_realpath($phpbb_root_path . 'language/lang_' . $default_lang . '/lang_main.'.$phpEx)) )
	{
		if ( $userdata['user_id'] != ANONYMOUS )
		{
			// For logged in users, try the board default language next
			$default_lang = phpbb_ltrim(basename(phpbb_rtrim($board_config['default_lang'])), "'");
		}
		else
		{
			// For guests it means the default language is not present, try english
			// This is a long shot since it means serious errors in the setup to reach here,
			// but english is part of a new install so it's worth us trying
			$default_lang = 'english';
		}

		if ( !file_exists(@phpbb_realpath($phpbb_root_path . 'language/lang_' . $default_lang . '/lang_main.'.$phpEx)) )
		{
			message_die(CRITICAL_ERROR, 'Could not locate valid language pack');
		}
	}

	// If we've had to change the value in any way then let's write it back to the database
	// before we go any further since it means there is something wrong with it
	if ( $userdata['user_id'] != ANONYMOUS && $userdata['user_lang'] !== $default_lang )
	{
		$sql = 'UPDATE ' . USERS_TABLE . "
			SET user_lang = '" . $default_lang . "'
			WHERE user_lang = '" . $userdata['user_lang'] . "'";

		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(CRITICAL_ERROR, 'Could not update user language info');
		}

		$userdata['user_lang'] = $default_lang;
	}
	elseif ( $userdata['user_id'] == ANONYMOUS && $board_config['default_lang'] !== $default_lang )
	{
		$sql = 'UPDATE ' . CONFIG_TABLE . "
			SET config_value = '" . $default_lang . "'
			WHERE config_name = 'default_lang'";

		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(CRITICAL_ERROR, 'Could not update user language info');
		}
	}

	$board_config['default_lang'] = $default_lang;

	//-- mod : mods settings ---------------------------------------------------------------------------
	//-- add
		global $db, $mods, $userdata;

      //
      // GET THE TIME TODAY AND YESTERDAY
      //
      /*$today_ary = explode('|', create_date('m|d|Y', time(),$board_config['board_timezone']));
      $board_config['time_today'] = gmmktime(0 - $board_config['board_timezone'] - $board_config['summer_time'],0,0,$today_ary[0],$today_ary[1],$today_ary[2]); */
      $today_ary = explode('|', create_date('m|d|Y', time(),$board_config['board_timezone']));
      $time_today_used = mktime(0,0,0,$today_ary[0],$today_ary[1],$today_ary[2]);
      $board_config['time_today'] = $time_today_used;
      if ( isset($userdata['user_timezone']) )
         {
                        $zonedifference = $board_config['real_board_timezone'] - $board_config['board_timezone'];

                        $usersummertime = 0;
                        $boardsummertime = 0;
                        if($userdata['user_summer_time']) $usersummertime = 1;
                        if($board_config['summer_time']) $boardsummertime = 1;

                        $zonedifference = (($board_config['real_board_timezone'] + $boardsummertime) - ($board_config['board_timezone'] + $usersummertime));
                        $board_config['time_today'] = $time_today_used + ($zonedifference * 3600);
         }
                $board_config['time_yesterday'] = $board_config['time_today'] - 86400;
      //unset($today_ary);
      //-- end mod : today at   yesterday at updates by evolver				
		
		
		
		
		
		

		//	get all the mods settings
		$dir = @opendir($phpbb_root_path . 'includes/mods_settings');
		while( $file = @readdir($dir) )
		{
			if( preg_match("/^mod_.*?\." . $phpEx . "$/", $file) )
			{
				include_once($phpbb_root_path . 'includes/mods_settings/' . $file);
			}
		}
		@closedir($dir);
	//-- fin mod : mods settings -----------------------------------------------------------------------

		include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_main.' . $phpEx);
		include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_cback_ctracker.' . $phpEx);
		if ( defined('IN_CASHMOD') )
		{
			if ( !file_exists(@phpbb_realpath($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_cash.'.$phpEx)) )
			{
				include($phpbb_root_path . 'language/lang_english/lang_cash.' . $phpEx);
			}
			else
			{
				include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_cash.' . $phpEx);
			}
		}
		include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_news.' . $phpEx);

		if ( defined('IN_ADMIN') )
		{
			if( !file_exists(@phpbb_realpath($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_admin.'.$phpEx)) )
			{
				$board_config['default_lang'] = 'english';
			}

			include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_admin.' . $phpEx);
			include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_admin_captcha.' . $phpEx);
		}

	//-- mod : keep unread -----------------------------------------------------------------------------
	//-- add
		read_cookies($userdata);
	//-- fin mod : keep unread -------------------------------------------------------------------------

	//-- mod : categories hierarchy --------------------------------------------------------------------
	//-- add
		global $tree;
		if (empty($tree['auth'])) get_user_tree($userdata);
	//-- fin mod : categories hierarchy ----------------------------------------------------------------
	//-- mod : language settings -----------------------------------------------------------------------
	//-- add
		include($phpbb_root_path . './includes/lang_extend_mac.' . $phpEx);
	//-- fin mod : language settings -------------------------------------------------------------------

		include_attach_lang();

	//***********************************************************************//	
	// Temporarily disabled due to hack will re enable once fix is available //
	//***********************************************************************//					
	
	//
	// Set up style
	//
	// BEGIN Style Select MOD
	
	// Security update 02 September 2006 B starts// 
	if ( (int)isset($_POST['STYLE_URL']) || (int)isset($_GET['STYLE_URL']) ) 
	{
		(int)$style = urldecode( (isset($_POST[STYLE_URL])) ? $_POST[STYLE_URL] : (int)$_GET[STYLE_URL] );
		if($style == 0) { die('Hacking attempt'); }
		if ( $theme = setup_style((int)$style) )
		{
			setcookie($board_config['cookie_name'] . '_style', $style, time() + 31536000, $board_config['cookie_path'], $board_config['cookie_domain'], $board_config['cookie_secure']);
			return;
		}
	}

  $style_key = $board_config['cookie_name'] . '_style';
	if ( isset($_COOKIE[$style_key]) )
	{
		$style = $_COOKIE[$style_key];
		if ( $theme = setup_style((int)$style) )
		{
			return;
		}
    else
    {
      setcookie($style_key, "", time()-3600);
      unset($_COOKIE[$style_key]);
    }
	}
// Security update 02 September 2006 B ends// 

	// END Style Select MOD
	
	//	if ( !$board_config['override_user_style'] )
	//	{
	//		if ( $userdata['user_id'] != ANONYMOUS && $userdata['user_style'] > 0 )
	//		{
	//			if ( $theme = setup_style($userdata['user_style']) )
	//			{
	//				return;
	//			}
	//		}
	//	}

	//	$theme = setup_style($board_config['default_style']);

		//
		// Mozilla navigation bar
		// Default items that should be valid on all pages.
		// Defined here to correctly assign the Language Variables
		// and be able to change the variables within code.
		//
		$nav_links['top'] = array ( 
			'url' => append_sid($phpbb_root_path . 'index.' . $phpEx),
			'title' => sprintf($lang['Forum_Index'], $board_config['sitename'])
		);
		$nav_links['search'] = array ( 
			'url' => append_sid($phpbb_root_path . 'search.' . $phpEx),
			'title' => $lang['Search']
		);
		$nav_links['help'] = array ( 
			'url' => append_sid($phpbb_root_path . 'faq.' . $phpEx),
			'title' => $lang['FAQ']
		);
		$nav_links['author'] = array ( 
			'url' => append_sid($phpbb_root_path . 'memberlist.' . $phpEx),
			'title' => $lang['Memberlist']
		);

		//
		// Add bookmarks to Navigation bar
		//
		if ($userdata['session_logged_in'] && $board_config['max_link_bookmarks'] > 0)
		{
			$auth_sql = '';
			$is_auth_ary = auth(AUTH_READ, AUTH_LIST_ALL, $userdata); 

			$ignore_forum_sql = '';
			while( list($key, $value) = each($is_auth_ary) )
			{
				if ( !$value['auth_read'] )
				{
					$ignore_forum_sql .= ( ( $ignore_forum_sql != '' ) ? ', ' : '' ) . $key;
				}
			}

			if ( $ignore_forum_sql != '' )
			{
				$auth_sql .= ( $auth_sql != '' ) ? " AND f.forum_id NOT IN ($ignore_forum_sql) " : "f.forum_id NOT IN ($ignore_forum_sql) ";
			}
			if ( $auth_sql != '' )
			{
				$sql = "SELECT t.topic_id, t.topic_title, f.forum_id
					FROM " . TOPICS_TABLE . "  t, " . BOOKMARK_TABLE . " b, " . FORUMS_TABLE . " f, " . POSTS_TABLE . " p
					WHERE t.topic_id = b.topic_id
						AND t.forum_id = f.forum_id
						AND t.topic_last_post_id = p.post_id
						AND b.user_id = " . $userdata['user_id'] . "
						AND $auth_sql
					ORDER BY p.post_time DESC
					LIMIT " . (intval($board_config['max_link_bookmarks']) + 1);
			}
			else
			{
				$sql = "SELECT t.topic_id, t.topic_title
					FROM " . TOPICS_TABLE . " t, " . BOOKMARK_TABLE . " b, " . POSTS_TABLE . " p
					WHERE t.topic_id = b.topic_id
						AND t.topic_last_post_id = p.post_id
						AND b.user_id = " . $userdata['user_id'] . "
					ORDER BY p.post_time DESC
					LIMIT " . (intval($board_config['max_link_bookmarks']) + 1);
			}
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not obtain post ids', '', __LINE__, __FILE__, $sql);
			}
			$post_rows = array();
			while ( $row = $db->sql_fetchrow($result) )
			{
				$post_rows[] = $row;
			}
			$db->sql_freeresult($result);

			if ( $total_posts = count($post_rows) )
			{
				//
				// Define censored word matches
				//
				$orig_word = array();
				$replacement_word = array();
				obtain_word_list($orig_word, $replacement_word);

				for($i = 0; $i < min($total_posts, $board_config['max_link_bookmarks']); $i++)
				{
					$topic_title = ( count($orig_word) ) ? preg_replace($orig_word, $replacement_word, $post_rows[$i]['topic_title']) : $post_rows[$i]['topic_title'];
					//
					// Add an array to $nav_links for the Mozilla navigation bar.
					// 'bookmarks' can create multiple items, therefore we are using a nested array.
					//
					$nav_links['bookmark'][$i] = array (
						'url' => append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=" . $post_rows[$i]['topic_id']),
						'title' => $topic_title
					);
				}
				if ($total_posts > $board_config['max_link_bookmarks'])
				{
					$start = intval($board_config['max_link_bookmarks'] / $board_config['topics_per_page']) * $board_config['topics_per_page'];
					$nav_links['bookmark'][$i] = array (
						'url' => append_sid("search.$phpEx?search_id=bookmarks&start=$start"),
						'title' => $lang['More_bookmarks']
					);
				}
			}
		}

#======================================================================= |
#==== Start: == phpBB Security ========================================= |
#==== v1.0.2 =========================================================== |
#====					
include_once($phpbb_root_path .'includes/phpbb_security.'. $phpEx);
phpBBSecurity_Elimination($board_config[phpBBSecurity_AdminConfigName()], $board_config[phpBBSecurity_ModConfigName()], $userdata['user_id']);
#====
#==== Author: aUsTiN [austin@phpbb-amod.com] [http://phpbb-amod.com] === |
#==== End: ==== phpBB Security ========================================= |	
#======================================================================= |

		//
		// Set up style
		//
		if ( !$board_config['override_user_style'] )
		{
			if ( $userdata['user_id'] != ANONYMOUS && $userdata['user_style'] > 0 )
			{
				if ( $theme = setup_style($userdata['user_style']) )
				{
					return;
				}
			}
		}

		$theme = setup_style($board_config['default_style']);

		return;
	}
}

function setup_style($style)
{
	global $db, $board_config, $template, $images, $phpbb_root_path, $var_cache, $portal_config, $current_template_path;
//-- mod : Advanced Group Color Management -------------------------------------
//-- add
	global $agcm_color;
//-- fin mod : Advanced Group Color Management ---------------------------------

	// BEGIN Style Select MOD
	if ( intval($style) == 0 )
	{
		$sql = "SELECT themes_id
				FROM " . THEMES_TABLE . "
				WHERE style_name = '$style'";
		if( ($result = $db->sql_query($sql)) && ($row = $db->sql_fetchrow($result)) )
		{
			$style = $row['themes_id'];
		}
		else
		{
			message_die(GENERAL_ERROR, "Hacking attempt (logged)... Could not find style name $style.");
		}
	}
	// END Style Select MOD

//-- mod : cache -----------------------------------------------------------------------------------
//-- add
	global $phpEx, $themes_style;

	if ( defined('CACHE_THEMES') )
	{
		@include( $phpbb_root_path . './includes/def_themes.' . $phpEx );
		if ( empty($themes_style) )
		{
			cache_themes();
			include( $phpbb_root_path . './includes/def_themes.' . $phpEx );
		}
	}
	if ( !empty($themes_style[$style]) )
	{
		$row = $themes_style[$style];
	}
	else
	{
//-- fin mod : cache -------------------------------------------------------------------------------

		$sql = 'SELECT *
			FROM ' . THEMES_TABLE . '
			WHERE themes_id = ' . (int) $style;
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(CRITICAL_ERROR, 'Could not query database for theme info');
		}

		if ( !($row = $db->sql_fetchrow($result)) )
		{
			// We are trying to setup a style which does not exist in the database
			// Try to fallback to the board default (if the user had a custom style)
			// and then any users using this style to the default if it succeeds
			if ( $style != $board_config['default_style'])
			{
				$sql = 'SELECT *
					FROM ' . THEMES_TABLE . '
					WHERE themes_id = ' . (int) $board_config['default_style'];
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(CRITICAL_ERROR, 'Could not query database for theme info');
				}

				if ( $row = $db->sql_fetchrow($result) )
				{
					$db->sql_freeresult($result);
	
					$sql = 'UPDATE ' . USERS_TABLE . '
						SET user_style = ' . (int) $board_config['default_style'] . "
						WHERE user_style = $style";
					if ( !($result = $db->sql_query($sql)) )
					{
						message_die(CRITICAL_ERROR, 'Could not update user theme info');
					}
          return false;
				}
				else
				{
					message_die(CRITICAL_ERROR, "Could not get theme data for themes_id [$style]");
				}
			}
			else
			{	
				message_die(CRITICAL_ERROR, "Could not get theme data for themes_id [$style]");
			}
		}

		else
		{
			message_die(CRITICAL_ERROR, "Could not get theme data for themes_id [$style]");
		}
//-- mod : cache -----------------------------------------------------------------------------------
//-- add
	}
//-- fin mod : cache -------------------------------------------------------------------------------

	$template_path = 'templates/' ;
	$template_name = $row['template_name'] ;

	$template = new Template($phpbb_root_path . $template_path . $template_name);

	if ( $template )
	{
		$current_template_path = $template_path . $template_name;
		@include($phpbb_root_path . $template_path . $template_name . '/' . $template_name . '.cfg');

		if ( !defined('TEMPLATE_CONFIG') )
		{
			message_die(CRITICAL_ERROR, "Could not open $template_name template config file", '', __LINE__, __FILE__);
		}

		$img_lang = ( file_exists(@phpbb_realpath($phpbb_root_path . $current_template_path . '/images/lang_' . $board_config['default_lang'])) ) ? $board_config['default_lang'] : 'english';

		while( list($key, $value) = @each($images) )
		{
			if ( !is_array($value) )
			{
				$images[$key] = str_replace('{LANG}', 'lang_' . $img_lang, $value);
			}
		}
	}

//-- mod : Advanced Group Color Management -------------------------------------
//-- add
	$agcm_color->read_theme($style);
//-- fin mod : Advanced Group Color Management ---------------------------------
	return $row;
}

function encode_ip($dotquad_ip)
{
	$ip_sep = explode('.', $dotquad_ip);
	return sprintf('%02x%02x%02x%02x', $ip_sep[0], $ip_sep[1], $ip_sep[2], $ip_sep[3]);
}

function decode_ip($int_ip)
{
	$hexipbang = explode('.', chunk_split($int_ip, 2, '.'));
	return hexdec($hexipbang[0]). '.' . hexdec($hexipbang[1]) . '.' . hexdec($hexipbang[2]) . '.' . hexdec($hexipbang[3]);
}

//
// Create calendar timestamp from timezone
//
function cal_date($gmepoch, $tz)
{
	$time = $gmepoch;
	board2usertime($time);
	return $time;
/*	 global $board_config;

//-- mod : profile cp ------------------------------------------------------------------------------
//-- add
   global $userdata, $db;

   if ( !isset($board_config['summer_time']) )
   {
      $board_config['summer_time'] = false;
      $sql = "INSERT INTO " . CONFIG_TABLE . " (config_name,config_value) VALUES('summer_time','0')";
      if ( !($result = $db->sql_query($sql)) ) message_die(GENERAL_ERROR, 'Could not add key summer_time in config table', '', __LINE__, __FILE__, $sql);
   }
   $switch_summer_time = ( $userdata['user_summer_time'] && $board_config['summer_time'] ) ? true : false;
   if ($switch_summer_time) $tz++;
//-- fin mod : profile cp --------------------------------------------------------------------------

   return $gmepoch + (3600 * $tz);*/
}

//
// Create date/time from format and timezone
//
/*function create_date($format, $gmepoch, $tz)
{
	global $board_config, $lang;
	static $translate;

//-- mod : profile cp ------------------------------------------------------------------------------
//-- add
	global $userdata, $db;

	if ( !isset($board_config['summer_time']) )
	{
		$board_config['summer_time'] = false;
		$sql = "INSERT INTO " . CONFIG_TABLE . " (config_name,config_value) VALUES('summer_time','0')";
		if ( !($result = $db->sql_query($sql)) ) message_die(GENERAL_ERROR, 'Could not add key summer_time in config table', '', __LINE__, __FILE__, $sql);
	}
	$switch_summer_time = ( $userdata['user_summer_time'] && $board_config['summer_time'] ) ? true : false;
	if ($switch_summer_time) $tz++;
//-- fin mod : profile cp --------------------------------------------------------------------------

	if ( empty($translate) && $board_config['default_lang'] != 'english' )
	{
		@reset($lang['datetime']);
		while ( list($match, $replace) = @each($lang['datetime']) )
		{
			$translate[$match] = $replace;
		}
	}

	return ( !empty($translate) ) ? strtr(@gmdate($format, $gmepoch + (3600 * $tz)), $translate) : @gmdate($format, $gmepoch + (3600 * $tz));
}*/
function create_date($format, $post, $tz) {
	global $board_config, $lang;
	$time = $post;
	board2usertime($time);
	// windows date bug... if error return is not set
	// default to what unix do => set date to 31 dec 1901 
  //           win should do => set date to 01 jan 1970 01:00:00 am but gives error
	if ($time < 0){
		// When formatting dates without D or l meaning mon or monday we can use a trick by faking the year... 
		if(strrpos($format,'D')===false and strrpos($format,'l')===false){
			// Make the format on year 1970
			$fakedate = mktime(1,0,0,1,1,1970); // one hour added :: substract later
			$year = 31536000; //3600*24*365;
			$years_less = 0 - ($time/$year); // make positive :: wrong if 31/12 :: extra year...
			$years_corr = round($years_less); // round the number of years
			$year_submitted = 1970-$years_corr;
			// how many leap years in between 1971 and submitted year?
			$leaps = 0;
			for($l=$year_submitted; $l <= 1970; $l++){
				if(($l/4) == intval($l/4)){
					$leaps++;
				}
			}
			$leaptime = $leaps*(86400);
			// so much time since jan 1st :: time is negative so add the years_corr*year
			$timeinyear = intval($time+($years_corr*$year)); 
			// add leap year days
			$timeinyear = $timeinyear+$leaptime;
			$fakedate = $fakedate + $timeinyear;
			$formatted = ( $board_config['default_lang'] == 'english' ) ? date($format,$fakedate) : strtr(date($format,$fakedate), $lang['datetime']) ;
			if(strpos($formatted,'1970') === false){
				if(strpos($formatted,'1969') === false){
					if(strpos($formatted,'1971') === false){
						// unknown date :: something must have gone wrong
						$time = 0;
					}else{
						$fakeyear = 1971;
						$year_submitted = $year_submitted+1;
					}
				} else {
					// 1969 is returned on leap years... 
					$fakeyear = 1969;
					$year_submitted = $year_submitted-1;
				}
			}else{
				// normal date :: returns 1970
				$fakeyear = 1970;
			}
			$leapcal = $year_submitted/4;
			if($leapcal == intval($leapcal)){
				$endoffeb = mktime(23,59,59,2,28,1970);
				if($fakedate > $endoffeb){
					// if leap year, substract 1 day if after 28/02...
					$fakeleapdate = $fakedate - 86400;
					$formatted = ( $board_config['default_lang'] == 'english' ) ? date($format,$fakeleapdate) : strtr(date($format,$fakeleapdate), $lang['datetime']) ;
					if(fakedate < mktime(23,59,59,3,1,1970)){
						// should be 29 !!!
						$formatted = str_replace('28', '29', $formatted);
					}
				}
			}
			$out = str_replace($fakeyear, $year_submitted, $formatted);
			return $out;
		} else {
			$time = 0;
		}
	}
	//return date($format,$time);
	//return ( $board_config['default_lang'] == 'english' ) ? date($format,$time) : strtr(date($format,$time), $lang['datetime']) ;
	 return ( $board_config['default_lang'] == 'english' || !is_array($lang['datetime']) ) ? date($format,$time) : strtr(date($format,$time), $lang['datetime']) ;
}

//-- mod : today at   yesterday at ------------------------------------------------------------------------ 
//-- add 
// 
// Create date/time/day from format and timezone 
// 
function create_date_day($format, $gmepoch, $tz) 
{ 
   global $board_config, $lang; 

	if ( time() < $gmepoch)
	{
		$date_day = sprintf($lang['Future'], create_date($board_config['default_dateformat'], $gmepoch, $tz)); 
	}
	else if ( $board_config['time_today'] < $gmepoch) 
	{ 
	   $date_day = sprintf($lang['Today_at'], create_date($board_config['default_timeformat'], $gmepoch, $tz)); 
	} 
	  else if ( $board_config['time_yesterday'] < $gmepoch) 
	{ 
	   $date_day = sprintf($lang['Yesterday_at'], create_date($board_config['default_timeformat'], $gmepoch, $tz)); 
	} else {
		$date_day = create_date($format, $gmepoch, $tz);
	} 

   return $date_day; 
} 
//-- end mod : today at   yesterday at ------------------------------------------------------------------------ 

//
// Pagination routine, generates
// page number sequence
//
//-- mod : profile cp ------------------------------------------------------------------------------
// here we added
//	, $start_field='start'
//-- modify
function generate_pagination($base_url, $num_items, $per_page, $start_item, $add_prevnext_text = TRUE, $start_field='start')
{
	global $lang;

	$total_pages = ceil($num_items/$per_page);

	if ( $total_pages == 1 )
	{
		return '';
	}

	$on_page = floor($start_item / $per_page) + 1;

	$page_string = '';
	if ( $total_pages > 10 )
	{
		$init_page_max = ( $total_pages > 3 ) ? 3 : $total_pages;

		for($i = 1; $i < $init_page_max + 1; $i++)
		{
//-- mod : profile cp ------------------------------------------------------------------------------
// here we replaced
//	start
// with
//	$start_field
//-- modify
			$page_string .= ( $i == $on_page ) ? '<b>' . $i . '</b>' : '<a href="' . append_sid($base_url . "&amp;$start_field=" . ( ( $i - 1 ) * $per_page ) ) . '">' . $i . '</a>';
//-- fin mod : profile cp --------------------------------------------------------------------------

			if ( $i <  $init_page_max )
			{
				$page_string .= ", ";
			}
		}

		if ( $total_pages > 3 )
		{
			if ( $on_page > 1  && $on_page < $total_pages )
			{
				$page_string .= ( $on_page > 5 ) ? ' ... ' : ', ';

				$init_page_min = ( $on_page > 4 ) ? $on_page : 5;
				$init_page_max = ( $on_page < $total_pages - 4 ) ? $on_page : $total_pages - 4;

				for($i = $init_page_min - 1; $i < $init_page_max + 2; $i++)
				{
//-- mod : profile cp ------------------------------------------------------------------------------
// here we replaced
//	start
// with
//	$start_field
//-- modify
					$page_string .= ($i == $on_page) ? '<b>' . $i . '</b>' : '<a href="' . append_sid($base_url . "&amp;$start_field=" . ( ( $i - 1 ) * $per_page ) ) . '">' . $i . '</a>';
//-- fin mod : profile cp --------------------------------------------------------------------------

					if ( $i <  $init_page_max + 1 )
					{
						$page_string .= ', ';
					}
				}

				$page_string .= ( $on_page < $total_pages - 4 ) ? ' ... ' : ', ';
			}
			else
			{
				$page_string .= ' ... ';
			}

		for($i = $total_pages - 2; $i < $total_pages + 1; $i++)
			{
//-- mod : profile cp ------------------------------------------------------------------------------
// here we replaced
//	start
// with
//	$start_field
//-- modify
				$page_string .= ( $i == $on_page ) ? '<b>' . $i . '</b>'  : '<a href="' . append_sid($base_url . "&amp;$start_field=" . ( ( $i - 1 ) * $per_page ) ) . '">' . $i . '</a>';
//-- fin mod : profile cp --------------------------------------------------------------------------
				if( $i <  $total_pages )
				{
					$page_string .= ", ";
				}
			}
		}
	}
else
	{
		for($i = 1; $i < $total_pages + 1; $i++)
		{
//-- mod : profile cp ------------------------------------------------------------------------------
// here we replaced
//	start
// with
//	$start_field
//-- modify
			$page_string .= ( $i == $on_page ) ? '<b>' . $i . '</b>' : '<a href="' . append_sid($base_url . "&amp;$start_field=" . ( ( $i - 1 ) * $per_page ) ) . '">' . $i . '</a>';
//-- fin mod : profile cp --------------------------------------------------------------------------
			if ( $i <  $total_pages )
			{
				$page_string .= ', ';
			}
		}
	}

	if ( $add_prevnext_text )
	{
		if ( $on_page > 1 )
		{
//-- mod : profile cp ------------------------------------------------------------------------------
// here we replaced
//	start
// with
//	$start_field
//-- modify
			$page_string = ' <a href="' . append_sid($base_url . "&amp;$start_field=" . ( ( $on_page - 2 ) * $per_page ) ) . '">' . $lang['Previous'] . '</a>&nbsp;&nbsp;' . $page_string;
//-- fin mod : profile cp --------------------------------------------------------------------------

		}

if ( $on_page < $total_pages )
		{
//-- mod : profile cp ------------------------------------------------------------------------------
// here we replaced
//	start
// with
//	$start_field
//-- modify
			$page_string .= '&nbsp;&nbsp;<a href="' . append_sid($base_url . "&amp;$start_field=" . ( $on_page * $per_page ) ) . '">' . $lang['Next'] . '</a>';
//-- fin mod : profile cp --------------------------------------------------------------------------

		}

	}

	$page_string = $lang['Goto_page'] . ' ' . $page_string;

	return $page_string;
}

//
// This does exactly what preg_quote() does in PHP 4-ish
// If you just need the 1-parameter preg_quote call, then don't bother using this.
//
function phpbb_preg_quote($str, $delimiter)
{
	$text = preg_quote($str);
	$text = str_replace($delimiter, '\\' . $delimiter, $text);
	
	return $text;
}

//
// Obtain list of naughty words and build preg style replacement arrays for use by the
// calling script, note that the vars are passed as references this just makes it easier
// to return both sets of arrays
//
function obtain_word_list(&$orig_word, &$replacement_word)
{
	global $db;

//-- mod : cache -----------------------------------------------------------------------------------
//-- add
	global $phpbb_root_path, $phpEx;

	// not processed yet
	if ( empty($orig_word) )
	{
		// take them from the cache
		if ( defined('CACHE_WORDS') )
		{
			@include($phpbb_root_path . './includes/def_words.' . $phpEx);
			if ( !isset($censored_words) )
			{
				$censored_words = array();
				cache_words();
				include($phpbb_root_path . './includes/def_words.' . $phpEx);
			}

			// convert
			$orig_word = array();
			$replacement_word = array();
			@reset($censored_words);
			while ( list($word_id, $row) = @each($censored_words) )
			{
				$orig_word[] = '#\b(' . str_replace('\*', '\w*?', phpbb_preg_quote($row['word'], '#')) . ')\b#i';
				$replacement_word[] = $row['replacement'];
			}
		}
		else
		{
			// get them from the database
			$sql = "SELECT * FROM  " . WORDS_TABLE;
			if ( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not get censored words from database', '', __LINE__, __FILE__, $sql);
			}
			// get the data
			$censored_words = array();
			while ( $row = $db->sql_fetchrow($result) )
			{
				$orig_word[] = '#\b(' . str_replace('\*', '\w*?', phpbb_preg_quote($row['word'], '#')) . ')\b#i';
				$replacement_word[] = $row['replacement'];
			}
		}
	}

	// end the function
	return true;
//-- fin mod : cache -------------------------------------------------------------------------------

	//
	// Define censored word matches
	//
	$sql = "SELECT word, replacement
		FROM  " . WORDS_TABLE;
	if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not get censored words from database', '', __LINE__, __FILE__, $sql);
	}

	if ( $row = $db->sql_fetchrow($result) )
	{
		do 
		{
			$orig_word[] = '#\b(' . str_replace('\*', '\w*?', preg_quote($row['word'], '#')) . ')\b#i';
			$replacement_word[] = $row['replacement'];
		}
		while ( $row = $db->sql_fetchrow($result) );
	}
	return true;
}

//
// This is general replacement for die(), allows templated
// output in users (or default) language, etc.
//
// $msg_code can be one of these constants:
//
// GENERAL_MESSAGE : Use for any simple text message, eg. results 
// of an operation, authorisation failures, etc.
//
// GENERAL ERROR : Use for any error which occurs _AFTER_ the 
// common.php include and session code, ie. most errors in 
// pages/functions
//
// CRITICAL_MESSAGE : Used when basic config data is available but 
// a session may not exist, eg. banned users
//
// CRITICAL_ERROR : Used when config data cannot be obtained, eg
// no database connection. Should _not_ be used in 99.5% of cases
//
function message_die($msg_code, $msg_text = '', $msg_title = '', $err_line = '', $err_file = '', $sql = '')
{
	global $db, $template, $board_config, $theme, $lang, $phpEx, $phpbb_root_path, $nav_links, $gen_simple_header, $images;
	global $userdata, $user_ip, $session_length;
	global $starttime;
//-- mod : Advanced Group Color Management -------------------------------------
//-- add
	global $agcm_color;
//-- fin mod : Advanced Group Color Management ---------------------------------
	global $_COOKIE;
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
//-- fix
	global $sub_template_key_image, $sub_templates;
//-- fin mod : sub-template ------------------------------------------------------------------------
	global $nav_separator; 
	
//+MOD: Fix message_die for multiple errors MOD
	static $msg_history;
	if( !isset($msg_history) )
	{
		$msg_history = array();
	}
	$msg_history[] = array(
		'msg_code'	=> $msg_code,
		'msg_text'	=> $msg_text,
		'msg_title'	=> $msg_title,
		'err_line'	=> $err_line,
		'err_file'	=> $err_file,
		'sql'		=> $sql
	);
//-MOD: Fix message_die for multiple errors MOD
	
	if(defined('HAS_DIED'))
	{
//+MOD: Fix message_die for multiple errors MOD

		//
		// This message is printed at the end of the report.
		// Of course, you can change it to suit your own needs. ;-)
		//
		$custom_error_message = 'Please, contact the %swebmaster%s. Thank you.';
		if ( !empty($board_config) && !empty($board_config['board_email']) )
		{
			$custom_error_message = sprintf($custom_error_message, '<a href="mailto:' . $board_config['board_email'] . '">', '</a>');
		}
		else
		{
			$custom_error_message = sprintf($custom_error_message, '', '');
		}
		echo "<html>\n<body>\n<b>Critical Error!</b><br />\nmessage_die() was called multiple times.<br />&nbsp;<hr />";
		for( $i = 0; $i < count($msg_history); $i++ )
		{
			echo '<b>Error #' . ($i+1) . "</b>\n<br />\n";
			if( !empty($msg_history[$i]['msg_title']) )
			{
				echo '<b>' . $msg_history[$i]['msg_title'] . "</b>\n<br />\n";
			}
			echo $msg_history[$i]['msg_text'] . "\n<br /><br />\n";
			if( !empty($msg_history[$i]['err_line']) )
			{
				echo '<b>Line :</b> ' . $msg_history[$i]['err_line'] . '<br /><b>File :</b> ' . $msg_history[$i]['err_file'] . "</b>\n<br />\n";
			}
			if( !empty($msg_history[$i]['sql']) )
			{
				echo '<b>SQL :</b> ' . $msg_history[$i]['sql'] . "\n<br />\n";
			}
			echo "&nbsp;<hr />\n";
		}
		echo $custom_error_message . '<hr /><br clear="all">';
		die("</body>\n</html>");
//-MOD: Fix message_die for multiple errors MOD
	}
	
	define('HAS_DIED', 1);
	

	$sql_store = $sql;
	//
	// Get SQL error if we are debugging. Do this as soon as possible to prevent 
	// subsequent queries from overwriting the status of sql_error()
	//
	if ( DEBUG && ( $msg_code == GENERAL_ERROR || $msg_code == CRITICAL_ERROR ) )
	{
		$sql_error = $db->sql_error();

		$debug_text = '';

		if ( $sql_error['message'] != '' )
		{
			$debug_text .= '<br /><br />SQL Error : ' . $sql_error['code'] . ' ' . $sql_error['message'];
		}

		if ( $sql_store != '' )
		{
			$debug_text .= "<br /><br />$sql_store";
		}

		if ( $err_line != '' && $err_file != '' )
		{
			$debug_text .= '<br /><br />Line : ' . $err_line . '<br />File : ' . basename($err_file);
		}
	}

	if( empty($userdata) && ( $msg_code == GENERAL_MESSAGE || $msg_code == GENERAL_ERROR ) )
	{
		$userdata = session_pagestart($user_ip, PAGE_INDEX);
		init_userprefs($userdata);
	}

	//
	// If the header hasn't been output then do it
	//
	if ( !defined('HEADER_INC') && $msg_code != CRITICAL_ERROR )
	{
		if ( empty($lang) )
		{
			if ( !empty($board_config['default_lang']) )
			{
				include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_main.'.$phpEx);
			}
			else
			{
				include($phpbb_root_path . 'language/lang_english/lang_main.'.$phpEx);
			}
//-- mod : language settings -----------------------------------------------------------------------
//-- add
			include($phpbb_root_path . './includes/lang_extend_mac.' . $phpEx);
//-- fin mod : language settings -------------------------------------------------------------------

		}

		if ( empty($template) || empty($theme) )
		{
			(int)$theme = setup_style($board_config['default_style']);
		}

		//
		// Load the Page Header
		//
		if ( !defined('IN_ADMIN') && !defined('HEADER_INC') )
		{
			include($phpbb_root_path . 'includes/page_header.'.$phpEx);
		}
		else
		{
			include($phpbb_root_path . 'admin/page_header_admin.'.$phpEx);
		}
	}

	switch($msg_code)
	{
		case GENERAL_MESSAGE:
			if ( $msg_title == '' )
			{
				$msg_title = $lang['Information'];
			}
			break;

		case CRITICAL_MESSAGE:
			if ( $msg_title == '' )
			{
				$msg_title = $lang['Critical_Information'];
			}
			break;

		case GENERAL_ERROR:
			if ( $msg_text == '' )
			{
				$msg_text = $lang['An_error_occured'];
			}

			if ( $msg_title == '' )
			{
				$msg_title = $lang['General_Error'];
			}
			break;

		case CRITICAL_ERROR:
			//
			// Critical errors mean we cannot rely on _ANY_ DB information being
			// available so we're going to dump out a simple echo'd statement
			//
			include($phpbb_root_path . 'language/lang_english/lang_main.'.$phpEx);

			if ( $msg_text == '' )
			{
				$msg_text = $lang['A_critical_error'];
			}

			if ( $msg_title == '' )
			{
				$msg_title = 'phpBB : <b>' . $lang['Critical_Error'] . '</b>';
			}
			break;
	}

	//
	// Add on DEBUG info if we've enabled debug mode and this is an error. This
	// prevents debug info being output for general messages should DEBUG be
	// set TRUE by accident (preventing confusion for the end user!)
	//
	if ( DEBUG && ( $msg_code == GENERAL_ERROR || $msg_code == CRITICAL_ERROR ) )
	{
		if ( $debug_text != '' )
		{
			$msg_text = $msg_text . '<br /><br /><b><u>DEBUG MODE</u></b>' . $debug_text;
		}
	}

	if ( $msg_code != CRITICAL_ERROR )
	{
		if ( !empty($lang[$msg_text]) )
		{
			$msg_text = $lang[$msg_text];
		}

		if ( !defined('IN_ADMIN') )
		{
			$template->set_filenames(array(
				'message_body' => 'message_body.tpl')
			);
		}
		else
		{
			$template->set_filenames(array(
				'message_body' => 'admin/admin_message_body.tpl')
			);
		}

		$template->assign_vars(array(
			'MESSAGE_TITLE' => $msg_title,
			'MESSAGE_TEXT' => $msg_text)
		);
//--------------------------------------------------------------------------------
// Prillian - Begin Code Addition
//
		if ( $gen_simple_header )
		{
			$template->assign_vars(array('U_INDEX' => '', 'L_INDEX' => ''));
		}
//
// Prillian - End Code Addition
//--------------------------------------------------------------------------------

		$template->pparse('message_body');

		if ( !defined('IN_ADMIN') )
		{
			include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
		}
		else
		{
			include($phpbb_root_path . 'admin/page_footer_admin.'.$phpEx);
		}
	}
	else
	{
		echo "<html>\n<body>\n" . $msg_title . "\n<br /><br />\n" . $msg_text . "</body>\n</html>";
	}

	exit;
}

//
// This function is for compatibility with PHP 4.x's realpath()
// function.  In later versions of PHP, it needs to be called
// to do checks with some functions.  Older versions of PHP don't
// seem to need this, so we'll just return the original value.
// dougk_ff7 <October 5, 2002>
function phpbb_realpath($path)
{
	global $phpbb_root_path, $phpEx;

	return (!@function_exists('realpath') || !@realpath($phpbb_root_path . 'includes/functions.'.$phpEx)) ? $path : @realpath($path);
}

function redirect($url)
{
	global $db, $board_config;

	if (!empty($db))
	{
		$db->sql_close();
	}

	if (strstr(urldecode($url), "\n") || strstr(urldecode($url), "\r") || strstr(urldecode($url), ';url'))
	{
		message_die(GENERAL_ERROR, 'Tried to redirect to potentially insecure url.');
	}

	$server_protocol = ($board_config['cookie_secure']) ? 'https://' : 'http://';
	$server_name = preg_replace('#^\/?(.*?)\/?$#', '\1', trim($board_config['server_name']));
	$server_port = ($board_config['server_port'] <> 80) ? ':' . trim($board_config['server_port']) : '';
	$script_name = preg_replace('#^\/?(.*?)\/?$#', '\1', trim($board_config['script_path']));
	$script_name = ($script_name == '') ? $script_name : '/' . $script_name;
	$url = preg_replace('#^\/?(.*?)\/?$#', '/\1', trim($url));

	// Redirect via an HTML form for PITA webservers
	if (@preg_match('/Microsoft|WebSTAR|Xitami/', getenv('SERVER_SOFTWARE')))
	{
		header('Refresh: 0; URL=' . $server_protocol . $server_name . $server_port . $script_name . $url);
		echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><head><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><meta http-equiv="refresh" content="0; url=' . $server_protocol . $server_name . $server_port . $script_name . $url . '"><title>Redirect</title></head><body><div align="center">If your browser does not support meta redirection please click <a href="' . $server_protocol . $server_name . $server_port . $script_name . $url . '">HERE</a> to be redirected</div></body></html>';
		exit;
	}

	// Behave as per HTTP/1.1 spec for others
	header('Location: ' . $server_protocol . $server_name . $server_port . $script_name . $url);
	exit;
}

// Mighty Gorgon - Full Album Pack - BEGIN
//--- FLAG operation functions
function setFlag($flags, $flag)
{
	return $flags | $flag;
}
function clearFlag($flags, $flag)
{
	return ($flags & ~$flag);
}
function checkFlag($flags, $flag)
{
	return (($flags & $flag) == $flag) ? true : false;
}
// Mighty Gorgon - Full Album Pack - END

function serverload() {	
	
	//Ian D. Brooks
	
	global $db, $table_prefix;
	$tablename = $table_prefix . "serverload";  //Change the table prefix if you use one other than phpbb
	
	$duration = "300"; 	// How many seconds load will represent.
	                    // Change the time representation in overall_footer.tpl to match this

	// Delete old page counts
	$sql = "DELETE FROM $tablename WHERE time < " . (time()-$duration);
	if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not delete Server Load entries', '', __LINE__, __FILE__, $sql);
	}
       
	// Insert the current page count
	
	$sql = "INSERT INTO $tablename (time) VALUES (" . time() . ") ";
	
        if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not uppdate Server Load entries', '', __LINE__, __FILE__, $sql);
	}

	// Get page count (number of rows in the table)
	
	$sql = "SELECT time FROM $tablename";
	
     if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain Server Load entries', '', __LINE__, __FILE__, $sql);
	}
	
        return $db->sql_numrows($result);

} // END FUNCTION serverload

// 
// Part of bot MOD: This function checks whether the user agent or ip is
// listed as a bot and returns true otherwise false.
// 
function is_robot() 
{ 
	global $db, $_SERVER, $table_prefix;

	// define bots table - for the users who are to lazy to edit constants.php hehehe!
	define('BOTS_TABLE', $table_prefix . "bots");

	// get required user data
	$user_ip = $_SERVER['REMOTE_ADDR'];
	$user_agent = $_SERVER['HTTP_USER_AGENT'];

	// get bot table data
	$sql = "SELECT bot_agent, bot_ip, bot_id, bot_visits, last_visit, bot_pages 
	FROM " . BOTS_TABLE;

	if ( !($result = $db->sql_query($sql, false, 'bots')) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain bot data.', '', __LINE__, __FILE__, $sql);
	}

	$update_bot = false;
	// loop through bots table
	while ($row = $db->sql_fetchrow($result))
	{
		// clear vars
		$agent_match = 0;
		$ip_match = 0;

		// check for user agent match
		foreach (explode('|', $row['bot_agent']) as $bot_agent)
		{
			if ($row['bot_agent'] && $bot_agent != '' && preg_match('#' . preg_quote($bot_agent, '#') . '#i', $user_agent)) $agent_match = 1;
		}

		// check for ip match
		foreach (explode('|', $row['bot_ip']) as $bot_ip)
		{
			if ($row['bot_ip'] && $bot_ip != '' && strpos($user_ip, $bot_ip) === 0)
			{
				$ip_match = 1;
				break;
			}
		}

		// if both ip and agent matched update table and return true
		if ($agent_match == 1 && $ip_match == 1)
		{
			// get time - seconds from epoch
			$today = time();

			$last_visits = explode('|', $row['last_visit']);

			// if half an hour has passed since last visit
			if (($today - (($last_visits[0] == '') ? 0 : $last_visits[0])) > 1800)
			{
				for ($i = ((4 > sizeof($last_visits)) ? sizeof($last_visits) : 4); $i >= 0; $i--)
				{
					if ($last_visits[$i-1] != '') $last_visits[$i] = $last_visits[$i-1];
				}

				// increment the new visit counter
				$row['bot_visits']++;

				// clear prior indexed pages
				$row['bot_pages'] = 1;
			} else {
				// add to indexed pages
				$row['bot_pages']++;
			}

			$last_visits[0] = $today;

			// compress it all together
			$last_visit = implode("|", $last_visits);

			// update table
			$sql = "UPDATE " . BOTS_TABLE . " 
			SET last_visit='$last_visit', bot_visits='" . $row['bot_visits'] . "', bot_pages='" . $row['bot_pages'] . "'
			WHERE bot_id = " . $row['bot_id'];

			if ( !($result2 = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Couldn\'t update data in bots table.', '', __LINE__, __FILE__, $sql);
			}
			$db->clear_cache('bots');

			return true;

		} 
		else 
		{
			if ($agent_match == 1 || $ip_match == 1)

			{

				// get data from table
				$sql = "SELECT pending_" . ((!$agent_match) ? 'agent' : 'ip') . " 
				FROM " . BOTS_TABLE . " 
				WHERE bot_id = " . $row['bot_id'];

				if ( !($result2 = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Could not obtain bot data.', '', __LINE__, __FILE__, $sql);
				}

				$row2 = $db->sql_fetchrow($result2);

				// add ip/agent to the list
				$pending_array = (( $row2['pending_' . ((!$agent_match) ? 'agent' : 'ip')] ) ? explode('|', $row2['pending_' . ((!$agent_match) ? 'agent' : 'ip')]) : array());

				$found = 0;

				if ( sizeof($pending_array) )
				{
					foreach ($pending_array as $bot_data)
					{
						if ($bot_data == ((!$agent_match) ? $user_agent : $user_ip)) $found = 1;
					}
				}

				if ($found == 0) $pending_array[] = ((!$agent_match) ? $user_agent : $user_ip);
				$pending = implode("|", $pending_array);

				// update table
				$sql = "UPDATE " . BOTS_TABLE . " 
				SET pending_" . ((!$agent_match) ? 'agent' : 'ip') . "='$pending'
				WHERE bot_id = " . $row['bot_id'];

				if ( !($result2 = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Couldn\'t update data in bots table.', '', __LINE__, __FILE__, $sql);
				}
				$update_bot = true;
			}		
		}

	}
	if ($update_bot)
		$db->clear_cache('bots');
	$db->sql_freeresult($result);

	return false;
}
function lw_convert_period_basis($pbasis)
{
	$grp_period_basis = '';
	if(strcasecmp($pbasis, 'D') == 0 )
	{
		$grp_period_basis = 'Day(s)';
	}
	if(strcasecmp($pbasis, 'W') == 0 )
	{
		$grp_period_basis = 'Week(s)';
	}
	if(strcasecmp($pbasis, 'M') == 0 )
	{
		$grp_period_basis = 'Month(s)';
	}
	if(strcasecmp($pbasis, 'Y') == 0 )
	{
		$grp_period_basis = 'Year(s)';
	}
	return $grp_period_basis;
}
function lw_check_membership(&$userinfo)
{
	global $db;

	$result = 0;
	if($userinfo['user_level'] != ADMIN && $userinfo['user_level'] != MOD )
	{
		$sql = "SELECT * FROM " . GROUPS_TABLE . " WHERE group_type = " . GROUP_PAYMENT . " AND group_amount > 0 AND group_moderator <> " . $userinfo['user_id'];
		if ( !($result = $db->sql_query($sql)) )
		{
			return $result;
		}
		$group_infos = array();
		if( ($group_info = $db->sql_fetchrow($result)) )
		{
			do
			{
				$group_infos[] = $group_info;
			}
			while( $group_info = $db->sql_fetchrow($result) );
		}
		$groupwhere = '';
		for($i = 0; $i < count($group_infos); $i++)
		{
			if($i == 0)
			{
				$groupwhere .= "(";
			}
			$groupwhere .= "group_id = " . $group_infos[$i]['group_id'];
			if($i < (count($group_infos) - 1))
			{
				$groupwhere .= " OR ";
			}
			else
			{
				$groupwhere .= ") AND user_id = " . $userinfo['user_id'] . " AND ug_expire_date < " . time();
			}
		}
		if(strlen($groupwhere) > 0)
		{
			$sql = "DELETE FROM " . USER_GROUP_TABLE . " WHERE $groupwhere";
			if( !($result = $db->sql_query($sql)) )
			{
				//do nothing
				return $result;
			}
		}



	}
	$result = 1;

	return $result;
}
function lw_grap_sys_paypal_acct()
{

	global $board_config;

		//get payment account, use business account first, if not exist, then choose personal account
		$paypalaccount = "";
		if(strlen($board_config['paypal_p_acct']) <= 0 && strlen($board_config['paypal_b_acct']) <= 0)
		{
			return $paypalaccount;
		}
		if(isset($board_config['paypal_b_acct']) && strlen($board_config['paypal_b_acct']) > 0)
		{
			$paypalaccount = $board_config['paypal_b_acct'];
		}
		else
		{
			$paypalaccount = $board_config['paypal_p_acct'];
		}
		return $paypalaccount;
}

function lw_cal_cash_exchange_rate($currency, $configuration)
{
	$convertor = 1.0;
	if(strcasecmp($currency, 'USD') == 0)
	{
		$convertor = $configuration['usd_to_primary'];
	}
	else if(strcasecmp($currency, 'EUR') == 0)
	{
		$convertor = $configuration['eur_to_primary'];
	}
	else if(strcasecmp($currency, 'GBP') == 0)
	{
		$convertor = $configuration['gbp_to_primary'];
	}
	else if(strcasecmp($currency, 'CAD') == 0)
	{
		$convertor = $configuration['cad_to_primary'];
	}
	else if(strcasecmp($currency, 'JPY') == 0)
	{
		$convertor = $configuration['jpy_to_primary'];
	}
	if($convertor <= 0)
	{
		$convertor = 1.0;
	}
	return $convertor;
}
function last_donors()
{
	global $db, $phpEx, $theme, $lang, $board_config;
	// Show All
	$count = 0;
	$sql = "SELECT COUNT(*) FROM " . ACCT_HIST_TABLE . " WHERE comment LIKE 'donate from%' GROUP BY user_id";
	if ( !($result = $db->sql_query($sql, false, 'acct_hist')) )
	{
		message_die(GENERAL_ERROR, 'Could not query forum donors information', '', __LINE__, __FILE__, $sql);
	}
	if($row = $db->sql_fetchrow($result))
	{
		$count = $row['COUNT(*)'];		
	}
	$db->sql_freeresult($result);
	
	$orderby = "ORDER BY date DESC";
	$selectcolums = "MAX(a.lw_date) as date, SUM(a.lw_money) as lw_money, a.MNY_CURRENCY, u.*";
	if(intval($board_config['list_top_donors']) == 1)
	{
		$orderby = "ORDER BY lw_money DESC";
		$selectcolums = "SUM(a.lw_money) as lw_money, MAX(a.lw_date) as date, a.MNY_CURRENCY, u.*";
	}	
	
	$str_input = intval($board_config['dislay_x_donors']);
		
	$sql = "SELECT $selectcolums from " . ACCT_HIST_TABLE . " a, " . USERS_TABLE . " u where a.comment like 'donate from%' AND u.user_id = a.user_id group by a.user_id"
	 	.  " $orderby LIMIT $str_input";
	if ( !($result = $db->sql_query($sql, false, 'acct_hist_users')) )
	{
		message_die(GENERAL_ERROR, 'Could not query forum donors information', '', __LINE__, __FILE__, $sql);
	}
	$last_donors = '';

	while( $row = $db->sql_fetchrow($result) )
	{
				$style_color = '';
				if ( $row['user_level'] == ADMIN )
				{
					$row['username'] = '<b>' . $row['username'] . '</b>';
					$style_color = 'style="color:#' . $theme['fontcolor3'] . '"';
				}
				else if ( $row['user_level'] == MOD )
				{
					$row['username'] = '<b>' . $row['username'] . '</b>';
					$style_color = 'style="color:#' . $theme['fontcolor2'] . '"';
				}
		if($row['user_id'] == ANONYMOUS)
		{
			$last_donors .= '<b>' . $lang['LW_ANONYMOUS_DONOR'] . '</b>(' . $row['MNY_CURRENCY'] . sprintf("%.2f", $row['lw_money']) . '), ';
		}
		else
		{
			$last_donors .= '<b><a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $row['user_id']) . '"' . $style_color .'>' . $row['username'] . '</a></b>(' . $row['MNY_CURRENCY'] . sprintf("%.2f", $row['lw_money']) . '), ';
		}
	}
	$db->sql_freeresult($result);
	if($count > $str_input)
	{
		$last_donors .= '<a href="' . append_sid("lwdonors.$phpEx?mode=viewall") . '"' . $style_color .'>' . $lang['LW_MORE_DONORS'] . '</a>';
	}
	if($count == 0)
	{
		$last_donors = $lang['LW_NO_DONORS_YET'];
	}
  return $last_donors;
}
function user2boardtime(&$usertime){ 
	global $board_config, $db, $userdata; 
	if(!isset($board_config['real_board_timezone'])){
		$sql = "select config_value from ".CONFIG_TABLE." where config_name = 'board_timezone'"; 
		if(!$result = $db->sql_query($sql) ) { 
				message_die(GENERAL_ERROR, 'Could not retrieve board_timezone', '', __LINE__, __FILE__, $sql); 
		} 
		$row = $db->sql_fetchrow($result); 
		$board_config['real_board_timezone'] = $row['config_value'];
	}
	$zonediff = $board_config['real_board_timezone'] - $board_config['board_timezone']; 
	$usersummer = 0;
	$boardsummer = 0;
	$summer = 0;
	if($userdata['user_summer_time']) $usersummer = 1;
	if($board_config['summer_time']) $boardsummer = 1;
	if($boardsummer != $usersummer){
		$summer = $boardsummer - $usersummer;
	}
	$zonediff = $zonediff + $summer;
	$zonediff = $zonediff * 3600; 
	$usertime = $usertime + $zonediff; 
} 

function board2usertime(&$usertime){ 
	global $board_config, $db, $userdata; 
	if(!isset($board_config['real_board_timezone'])){
		$board_config['real_board_timezone'] = $board_config['board_timezone'];
	}
	$zonediff = $board_config['board_timezone'] - $board_config['real_board_timezone']; 
	$usersummer = 0;
	$boardsummer = 0;
	$summer = 0;
	if($userdata['user_summer_time']) $usersummer = 1;
	if($board_config['summer_time']) $boardsummer = 1;
	if($boardsummer != $usersummer){
		$summer = $usersummer - $boardsummer;
	}
	$zonediff = $zonediff + $summer;
	$zonediff = $zonediff * 3600; 
	$usertime = $usertime + $zonediff; 
} 

/* Start Page Views, Queries Today & Queries Top By aUsTiN (http://austin-inc.com/Blend) */

function UpdatePageView()
	{
	global $db, $table_prefix;
	
		$q1 = "UPDATE ". $table_prefix ."page_view_count
			   SET views = views + 1";
		$r1 = $db -> sql_query($q1);	
	return;	
	}
	
function SelectPageViewDate()
	{
	global $db, $table_prefix;
	
		$q = "SELECT *
		      FROM ". $table_prefix ."page_view_count";
		$r		= $db -> sql_query($q);
		$row 	= $db -> sql_fetchrow($r);		
		$pvd 	= $row['date'];	
	
	return $pvd;	
	}
		
function PageViewsToday()
	{
	global $db, $table_prefix;
	
		$q = "SELECT *
		      FROM ". $table_prefix ."page_view_count";
		$r		= $db -> sql_query($q);
		$row 	= $db -> sql_fetchrow($r);		
		$pvv 	= $row['views'];	
	
	return $pvv;	
	}
			
function ResetPageViews($date)		
	{
	global $db, $table_prefix;
		
		$q1 = "UPDATE ". $table_prefix ."page_view_count
			   SET views = '1', date = '$date'";
		$r1 = $db -> sql_query($q1);
		
	return;	
	}
	
function SelectQueries()
	{
	global $db, $table_prefix;
	
		$q = "SELECT *
		      FROM ". $table_prefix ."todays_queries";
		$r		= $db -> sql_query($q);
		$row 	= $db -> sql_fetchrow($r);		
		$tqd 	= $row['date'];
		$otq1 	= $row['total'];
		$otq	= number_format($otq1);
				
		$q = "SELECT *
		      FROM ". $table_prefix ."top_queries";
		$r		= $db -> sql_query($q);
		$row 	= $db -> sql_fetchrow($r);		
		$top_1 	= $row['total'];
		$top_d 	= $row['day'];
		$set	= strftime("%b. %d, %Y @ %H:%M:%S", $top_d);
		$top_q 	= number_format($top_1); 				
						
		$show_in_footer_today 	= "Todays DB Queries: $otq";
		$show_in_footer_top		= "Highest Query Load: $top_q Queries On $set"; 		
		$show_data				= $show_in_footer_today ."/". $show_in_footer_top ."/". $tqd;
	return $show_data;	
	}	
	
function UpdateQueryCount($excuted_queries)
	{
	global $db, $table_prefix;
	
		$q1 = "UPDATE ". $table_prefix ."todays_queries
			   SET total = total + $excuted_queries";
		$r1 = $db -> sql_query($q1);	
	return;
	}
	
function UpdateQueryTop($tqt, $excuted_queries)
	{
	global $db, $table_prefix;
	
		$q1 = "UPDATE ". $table_prefix ."top_queries
			   SET total = '$tqt', day = '". time() ."'";
		$r1 = $db -> sql_query($q1);
			
	return;
	}
		
function ResetTodaysQueries($excuted_queries, $date)
	{
	global $db, $table_prefix;
	
		$q1 = "UPDATE ". $table_prefix ."todays_queries
			   SET total = '$excuted_queries', date = '$date'";
		$r1 = $db -> sql_query($q1);
			
	return;
	}
			
function QueryDateCheck()
	{
	global $db, $table_prefix;

		$q = "SELECT total
		      FROM ". $table_prefix ."todays_queries";
		$r		= $db -> sql_query($q);
		$row 	= $db -> sql_fetchrow($r);		
		$tqt 	= $row['total'];
		
		$q = "SELECT *
		      FROM ". $table_prefix ."top_queries";
		$r		= $db -> sql_query($q);
		$row 	= $db -> sql_fetchrow($r);		
		$tq 	= $row['total'];
		$qd		= $row['day'];
		
		$show_data = "$tqt,$tq,$qd";
	return $show_data;	
	}	
	
/* Finished Page Views, Queries Today & Queries Top By aUsTiN (http://austin-inc.com/Blend) */
// Michaelo June 2006 //
function search_mysqldump()
{
	
   $mysqldump = '';
      
   $exe = ((defined('PHP_OS')) && (preg_match('#win#i', PHP_OS))) ? '.exe' : '';

   $mysqldump_home = getenv("MYSQL_HOME");
   
   if (empty($mysqldump_home))
   {
         
      $locations = array("C:\Program Files\MySQL\MySQL Server 4.1\bin", "C:/Program Files/XAMPP/MYSQL/BIN", 'C:/XAMPP/XAMPP/MYSQL/BIN', "C:\Program Files\MySQL\MySQL", 'C:/WINDOWS/', 'C:/WINNT/', 'C:/WINDOWS/SYSTEM/', 'C:/WINNT/SYSTEM/', 'C:/WINDOWS/SYSTEM32/', 'C:/WINNT/SYSTEM32/', '/usr/bin/', '/usr/sbin/', '/usr/local/bin/', '/usr/local/sbin/', '/opt/', '/usr/mysql/', '/usr/bin/mysql/');
      $path_locations = str_replace('\\', '/', (explode(($exe) ? ';' : ':', getenv('PATH'))));   
         
      $locations = array_merge($path_locations, $locations);

      foreach ($locations as $location)
      {
         // The path might not end properly, fudge it
         if (substr($location, -1, 1) !== '/')
         {
            $location .= '/';
         }

         if (@is_readable($location . 'mysqldump' . $exe) && @filesize($location . 'mysqldump' . $exe) > 1000)
         {
            $mysqldump = str_replace('\\', '/', $location);
            continue;
         }
      }
   }
   else
   {
      $mysqldump = str_replace('\\', '/', $mysqldump_home);
   }
   return $mysqldump;
} 	

function bbcode_box()
{
	global $template, $board_config, $phpbb_root_path, $phpEx;
	include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_bbcode_box.' . $phpEx);

	$template->set_filenames(array(
		'bbcode_box' => $current_template_path . 'bbcode_box.tpl')
	);

	$template->assign_vars(array(
		'L_ROOT' => $phpbb_root_path,
		'L_BBCODE_RTL_HELP' => $lang['bbcode_rtl_help'],
		'L_BBCODE_LTR_HELP' => $lang['bbcode_ltr_help'],
		'L_BBCODE_PLAIN_HELP' => $lang['bbcode_plain_help'],
		'L_BBCODE_FC_HELP' => $lang['bbcode_fc_help'],
		'L_BBCODE_FS_HELP' => $lang['bbcode_fs_help'],
		'L_BBCODE_FT_HELP' => $lang['bbcode_ft_help'],
		'L_BBCODE_RIGHT_HELP' => $lang['bbcode_right_help'],
		'L_BBCODE_LEFT_HELP' => $lang['bbcode_left_help'],
		'L_BBCODE_CENTER_HELP' => $lang['bbcode_center_help'],
		'L_BBCODE_JUSTIFY_HELP' => $lang['bbcode_justify_help'],
		'L_BBCODE_B_HELP' => $lang['bbcode_b_help'],
		'L_BBCODE_I_HELP' => $lang['bbcode_i_help'],
		'L_BBCODE_U_HELP' => $lang['bbcode_u_help'],
		'L_BBCODE_STRIKE_HELP' => $lang['bbcode_strike_help'],
		'L_BBCODE_SUP_HELP' => $lang['bbcode_sup_help'],
		'L_BBCODE_SUB_HELP' => $lang['bbcode_sub_help'],
		'L_BBCODE_GRAD_HELP' => $lang['bbcode_grad_help'],
		'L_BBCODE_FADE_HELP' => $lang['bbcode_fade_help'],
		'L_BBCODE_LIST_HELP' => $lang['bbcode_list_help'],
		'L_BBCODE_MARQR_HELP' => $lang['bbcode_marqr_help'],
		'L_BBCODE_MARQL_HELP' => $lang['bbcode_marql_help'],
		'L_BBCODE_MARQU_HELP' => $lang['bbcode_marqu_help'],
		'L_BBCODE_MARQD_HELP' => $lang['bbcode_marqd_help'],
		'L_BBCODE_QUOTE_HELP' => $lang['bbcode_quote_help'],
		'L_BBCODE_CODE_HELP' => $lang['bbcode_code_help'],
		'L_BBCODE_PHP_HELP' => $lang['bbcode_php_help'],
		'L_BBCODE_SPOIL_HELP' => $lang['bbcode_spoil_help'],
		'L_BBCODE_ANCHOR_HELP' => $lang['bbcode_anchor_help'],
		'L_BBCODE_URL_HELP' => $lang['bbcode_url_help'],
		'L_BBCODE_YOUTUBE_HELP' => $lang['bbcode_youtube_help'],
		'L_BBCODE_MAIL_HELP' => $lang['bbcode_mail_help'],
		'L_BBCODE_GOTOPOST_HELP' => $lang['bbcode_goto_help'],
		'L_BBCODE_IMG_HELP' => $lang['bbcode_img_help'],
		'L_BBCODE_STREAM_HELP' => $lang['bbcode_stream_help'],
		'L_BBCODE_RAM_HELP' => $lang['bbcode_ram_help'],
		'L_BBCODE_WEB_HELP' => $lang['bbcode_web_help'],
		'L_BBCODE_VIDEO_HELP' => $lang['bbcode_video_help'],
		'L_BBCODE_FLASH_HELP' => $lang['bbcode_flash_help'],
		'L_BBCODE_SPELL_HELP' => $lang['bbcode_spell_help'],
		'L_BBCODE_HR_HELP' => $lang['bbcode_hr_help'],
		'L_BBCODE_YOU_HELP' => $lang['bbcode_you_help'],
		'L_BBCODE_TAB_HELP' => $lang['bbcode_tab_help'],
		'L_BBCODE_NBSP_HELP' => $lang['bbcode_nbsp_help'],
		'L_BBCODE_SEARCH_HELP' => $lang['bbcode_search_help'],
		'L_BBCODE_GOOGLE_HELP' => $lang['bbcode_google_help'],
		'L_BBCODE_TABLE_HELP' => $lang['bbcode_table_help'],
		'L_BBCODE_TIP_HELP' => $lang['bbcode_tip_help'],

		'L_BBCODE_TYPE_MESSAGE' => $lang['bbcode_type_message'],
		'L_BBCODE_CONFIRM' => $lang['bbcode_confirm'],
		'L_BBCODE_SELECT' => $lang['bbcode_select_text'],
		'L_BBCODE_LESS_120' => $lang['bbcode_less_120'],
		'L_BBCODE_NOT_AVAILABLE' => $lang['bbcode_not_available'],
		'L_BBCODE_LIST_BOX' => $lang['bbcode_list_box'],
		'L_BBCODE_LISTBOX_OPTIONS' => $lang['bbcode_listbox_options'],
		'L_BBCODE_LISTBOX_ITEM' => $lang['bbcode_listbox_item'],
		'L_BBCODE_NO_LISTBOX_ITEM' => $lang['bbcode_no_listbox_item'],
		'L_BBCODE_ANCHORNAME' => $lang['bbcode_anchorname'],
		'L_BBCODE_NO_ANCHORNAME' => $lang['bbcode_no_anchorname'],
		'L_BBCODE_BAD_ANCHORNAME' => $lang['bbcode_bad_anchorname'],
		'L_BBCODE_NO_URL' => $lang['bbcode_enter_url'],
		'L_BBCODE_ENTER_URL' => $lang['bbcode_no_url'],
		'L_BBCODE_ENTER_PAGENAME' => $lang['bbcode_enter_pagename'],
		'L_BBCODE_NO_PAGENAME' => $lang['bbcode_no_pagename'],
		'L_BBCODE_ENTER_YOUTUBE' => $lang['bbcode_enter_youtube'],
		'L_BBCODE_NO_YOUTUBE' => $lang['bbcode_no_youtube'],
		'L_BBCODE_ENTER_EMAIL' => $lang['bbcode_enter_email'],
		'L_BBCODE_NO_EMAIL' => $lang['bbcode_no_email'],
		'L_BBCODE_POSTNUMBER' => $lang['bbcode_postnumber'],
		'L_BBCODE_NO_POSTNUMBER' => $lang['bbcode_no_postnumber'],
		'L_BBCODE_ANCHORNAME2' => $lang['bbcode_anchorname2'],
		'L_BBCODE_ENTER_SEARCHTEXT' => $lang['bbcode_enter_searchtext'],
		'L_BBCODE_NO_SEARCHTEXT' => $lang['bbcode_no_searchtext'],

		)
	);

	$template->assign_var_from_handle('JAVASCRIPT_BBCODE_BOX', 'bbcode_box');

}
?>