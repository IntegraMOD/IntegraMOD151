<?php

/***************************************************************************
 *						mod_profile_control_panel.php
 *						-----------------------------
 *	begin			: 10/08/2003
 *	copyright		: Ptirhiik
 *	email			: admin@rpgnet-fr.com
 *
 *	version			: 1.0.3 - 31/10/2003
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

include_once($phpbb_root_path . './includes/functions_mods_settings.' . $phpEx);

//-------------------------------------------
//
//	list of values for direct usage
//
//-------------------------------------------
$list_yes_no = array('Yes' => 1, 'No' => 0);
$list_yes_no_friend = array('Yes' => 1, 'No' => 0, 'Friend_only' => 2);

//-------------------------------------------
//
//	get all maps relative to profile_prefer and preferences
//
//-------------------------------------------
// first pass : get main maps
$w_maps = array();
foreach ($user_maps as $map_name => $map_data)
{
	$map_tree = explode('.', $map_name);
	if ( ($map_tree[0] == 'PCP') && !empty($map_data['custom']) && ($map_data['custom'] == 1) )
	{
		// get this map
		$map_tree = explode('.', $map_name);
		$w_maps['name'][] = $map_name;
		$w_maps['depth'][] = count($map_tree)-1;
	}
}

// second pass : get sub maps
foreach ($user_maps as $map_name => $map_data)
{
	for ( $i=0; $i < count($w_maps['name']); $i++ )
	{
		if ( substr($map_name, 0, strlen($w_maps['name'][$i])) == $w_maps['name'][$i] )
		{
			// we must stay within 3 sub levels
			$map_tree = explode('.', $map_name);
			if ( ( (count($map_tree) - 1 - $w_maps['depth'][$i]) < 3 ) && ( (count($map_tree) - 1 - $w_maps['depth'][$i]) > 0 ) )
			{
				// map name
				$start = $w_maps['depth'][$i];
				$map_root = '';
				for ( $j=0; $j < $start; $j++ )
				{
					if ( !empty($map_tree[$j]) )
					{
						$map_root .= ( empty($map_root) ? '' : '.' ) . $map_tree[$j];
					}
				}

				// get the menu name entries
				$menu = array();
				for ( $j=0; $j < 3; $j++ )
				{
					$local_name = '';
					$local_sort = 0;
					if ( !empty($map_tree[ $j + $start ]) )
					{
						$map_root .= '.' . $map_tree[ $j + $start ];
						$local_name = pcp_get_mods_setting_menu('title', $map_root);
						if ( ($j==0) && in_array($w_maps['name'][$i], array('PCP.profil.Preferences', 'PCP.profil.profile_prefer')) )
						{
							$local_name = $map_tree[$start];
						}
						$local_sort = pcp_get_mods_setting_menu('order', $map_root);
					}
					$menu[$j]['name'] = $local_name;
					$menu[$j]['sort'] = $local_sort;
				}

				// init config table
				$config_fields	= pcp_get_mods_setting_config_fields($map_name);
				if ( !empty($config_fields) )
				{
					init_board_config($menu[1]['name'], $config_fields, $menu[2]['name'], $menu[2]['sort'], $menu[1]['sort'], $menu[0]['name'], $menu[0]['sort']);
				}
				break;
			}
		}
	}
}

//-------------------------------------------
//
//	DATEFMT format service functions :
//	---------------------------------
//		mods_settings_get_datefmt() : return the datefmt input fields definition
//		mods_settings_check_datefmt() : check and format the datefmt fields value
//
//-------------------------------------------
if (!function_exists('mods_settings_get_datefmt'))
{
	function mods_settings_get_datefmt($field, $value)
	{
		global $board_config, $lang, $userdata;

		// define a set of date presentation
		$timeset = array(
			'D m d, Y g:i a', 
			'D d-m-Y, G:i', 
			'M Y, D d, g:i a', 
			'D d M Y, G:i', 
			'd M Y h:i a', 
			'd M Y, G:i',
			'D M d, Y g:i a',
			'D M d, Y G:i',
		);

		// build the date format list
		$s_time = '<select name="timeformat" onChange="' . $field . '.value=this.options[this.selectedIndex].value;">';
		$time = time();
		$found = false;
		for ($i=0; $i < count($timeset); $i++)
		{
			$selected = ($value == $timeset[$i]) ? ' selected="selected"' : '';
			if ($selected != '') $found = true;
			$s_time .= '<option value="' . $timeset[$i] . '"' . $selected . '>' . create_date($timeset[$i], $time, $userdata['user_timezone']) . '</option>';
		}
		$selected = ( !$found ) ? ' selected="selected"' : '';
		$s_time .= '<option value=""' . $selected . '>' . $lang['Other'] . '</option></select>';

		$res = $s_time . '&nbsp;<input type="text" name="' . $field . '" value="' . $value . '" maxlength="14" class="post" />';

		return $res;
	}
}

if (!function_exists('mods_settings_check_datefmt'))
{
	function mods_settings_check_datefmt($field, $value)
	{
		global $error, $error_msg, $lang;

		$res = trim(str_replace("\'", "''", htmlspecialchars($value)));
		return $res;
	}
}

//-------------------------------------------
//
//	URL format service functions :
//	---------------------------------
//		mods_settings_get_url() : return the url input fields definition
//		mods_settings_check_url() : check and format the url fields value
//
//-------------------------------------------
if (!function_exists('mods_settings_get_url'))
{
	function mods_settings_get_url($field, $value)
	{
		global $board_config, $lang, $userdata;

		$res = '<input type="text" name="' . $field . '" value="' . $value . '" size="25" maxlength="255" class="post" />';

		return $res;
	}
}

if (!function_exists('mods_settings_check_url'))
{
	function mods_settings_check_url($field, $value)
	{
		global $error, $error_msg, $lang;

		$url = trim(str_replace("\'", "''", htmlspecialchars($value)));
		if ( !empty($url) )
		{
			if (!preg_match('#^http[s]?:\/\/#i', $url))
			{
				$url = 'http://' . $url;
			}

			if (!preg_match('#^http[s]?\\:\\/\\/[a-z0-9\-]+\.([a-z0-9\-]+\.)?[a-z]+#i', $url))
			{
				$url = '';
				$error = true;
				$error_msg = (empty($error_msg) ? '' : '<br />') . $lang['Incomplete_URL'];
			}
		}
		return $url;
	}
}

//-------------------------------------------
//
//	BIRTHDAY format service functions :
//	---------------------------------
//		mods_settings_get_birthday() : return the birthday input fields definition
//		mods_settings_check_birthday() : check and format the birthday fields value
//
//-------------------------------------------
if (!function_exists('mods_settings_get_birthday'))
{
	function mods_settings_get_birthday($field, $value)
	{
		global $board_config, $lang, $userdata;

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

		$year = intval(substr($value, 0, 4));
		$month = intval(substr($value, 4, 2));
		$day = intval(substr($value, 6, 2));

		// day list
		$s_birthday_day = '';
		for ($i=0; $i <= 31; $i++)
		{
			$select = ( $day == $i ) ? ' selected="selected"' : '';
			$s_birthday_day .= '<option value="' . $i . '"' . $select . '>' . ( ($i == 0) ? ' -- ' : (($i < 10) ? '0' . $i : $i) ) . '</option>';
		}
		$s_birthday_day = sprintf('<select name="' . $field . '_day">%s</select>', $s_birthday_day);

		// month list
		$s_birthday_month = '';
		for ($i=0; $i <= 12; $i++)
		{
			$select = ( $month == $i ) ? ' selected="selected"' : '';
			$s_birthday_month .= '<option value="' . $i . '"' . $select . '>' . $months[$i] . '</option>';
		}
		$s_birthday_month = sprintf('<select name="' . $field . '_month">%s</select>', $s_birthday_month);

		// year list
		$s_birthday_year = '';
		$select = ( $year == 0 ) ? ' selected="selected"' : '';
		$s_birthday_year .= '<option value="0"' . $select . '> ---- </option>';
		for ($i=1900; $i <= date('Y', time()); $i++)
		{
			$select = ( $year == $i) ? ' selected="selected"' : '';
			$s_birthday_year .= '<option value="' . $i . '"' . $select . '>' . $i . '</option>';
		}
		$s_birthday_year = sprintf('<select name="' . $field . '_year">%s</select>', $s_birthday_year);

		$res = $s_birthday_day . $s_birthday_month . $s_birthday_year . '<input type="hidden" name="' . $field . '" value="' . $value . '" />';

		return $res;
	}
}

if (!function_exists('mods_settings_check_birthday'))
{
	function mods_settings_check_birthday($field, $value)
	{
		global $error, $error_msg, $lang;
		global $_POST;

		$day = intval($_POST[$field . '_day']);
		$month = intval($_POST[$field . '_month']);
		$year = intval($_POST[$field . '_year']);

		if (empty($day) || empty($month) || empty($year) ) return 0;

		$valid = checkdate($month, $day, $year);
		if (!$valid)
		{
			$res = 0;
			$error = true;
			$error_msg .= (empty($error_msg) ? '' : '<br />') . sprintf($lang['Date_error'], $day, $month, $year);
		}
		else
		{
			$res = $year * 10000 + $month * 100 + $day;
		}
		return $res;
	}
}

//-------------------------------------------
//
//	ICQ format service functions :
//	---------------------------------
//		mods_settings_get_icq() : return the icq input fields definition
//		mods_settings_check_icq() : check and format the icq fields value
//
//-------------------------------------------
if (!function_exists('mods_settings_get_icq'))
{
	function mods_settings_get_icq($field, $value)
	{
		global $board_config, $lang, $userdata;

		$res = '<input type="text" name="' . $field . '" value="' . $value . '" size="10" maxlength="15" class="post" />';

		return $res;
	}
}

if (!function_exists('mods_settings_check_icq'))
{
	function mods_settings_check_icq($field, $value)
	{
		global $error, $error_msg, $lang;

		$res = trim(str_replace("\'", "''", htmlspecialchars($value)));

		// ICQ number has to be only numbers.
		if (!preg_match('/^[0-9]+$/', $res))
		{
			$res = '';
		}
		return $res;
	}
}

//-------------------------------------------
//
//	MESSENGER format service functions :
//	-----------------------------------
//		mods_settings_get_messenger() : return the messengers input fields definition
//		mods_settings_check_messenger() : check and format the messengers fields value
//
//-------------------------------------------
if (!function_exists('mods_settings_get_messenger'))
{
	function mods_settings_get_messenger($field, $value)
	{
		global $board_config, $lang, $userdata;

		$res = '<input type="text" name="' . $field . '" value="' . $value . '" size="20" maxlength="255" class="post" />';

		return $res;
	}
}

if (!function_exists('mods_settings_check_messenger'))
{
	function mods_settings_check_messenger($field, $value)
	{
		global $error, $error_msg, $lang;

		$res = trim(str_replace("\'", "''", htmlspecialchars($value)));
		return $res;
	}
}

//-------------------------------------------
//
//	MSNM format service functions :
//	---------------------------------
//		mods_settings_get_msnm() : return the MSNM input fields definition
//		mods_settings_check_msnm() : check and format the MSNM fields value
//
//-------------------------------------------
if (!function_exists('mods_settings_get_msnm'))
{
	function mods_settings_get_msnm($field, $value)
	{
		global $board_config, $lang, $userdata;

		$res = '<input type="text" name="' . $field . '" value="' . $value . '" size="20" maxlength="255" class="post" />';

		return $res;
	}
}

if (!function_exists('mods_settings_check_msnm'))
{
	function mods_settings_check_msnm($field, $value)
	{
		global $error, $error_msg, $lang, $db;

		$email = trim(str_replace("\'", "''", htmlspecialchars($value)));
		$banned = false;
		if (!empty($email))
		{
			if (preg_match('/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*?[a-z]+$/is', $email))
			{
				$sql = "SELECT ban_email
					FROM " . BANLIST_TABLE;
				if ($result = $db->sql_query($sql))
				{
					while ( ($row = $db->sql_fetchrow($result)) && !$banned)
					{
						$match_email = str_replace('*', '.*?', $row['ban_email']);
						if (preg_match('/^' . $match_email . '$/is', $email))
						{
							$banned = true;
						}
					}
				}
				$db->sql_freeresult($result);
			}
		}
		if ($banned)
		{
			$email = '';
			$error = true;
			$error_msg = (empty($error_msg) ? '' : '<br />') .$lang['Email_banned'];
		}
		return $email;
	}
}

//-------------------------------------------
//
//	Delete a user service functions :
//	---------------------------------
//		mods_settings_get_delete_user() : return the button input field
//		mods_settings_check_delete_user() : perform the delete
//
//-------------------------------------------
if (!function_exists('mods_settings_get_delete_user'))
{
	function mods_settings_get_delete_user($field, $value)
	{
		global $board_config, $lang, $userdata, $view_userdata;

		$res = '<input type="submit" name="' . $field . '" value="' . $lang['User_delete'] . '" class="liteoption" />';

		return $res;
	}
}

if (!function_exists('mods_settings_check_delete_user'))
{
	function mods_settings_check_delete_user($field, $value)
	{
		global $error, $error_msg, $lang, $db, $userdata, $view_userdata;

		// check auth
		if ( ($userdata['user_id'] == $view_userdata['user_id']) && ($view_userdata['user_level'] == ADMIN) )
		{
			$error = true;
			$error_msg = $lang['User_self_delete'];
		}
		else
		{
			$view_user_id = $view_userdata['user_id'];
			$replace_user_id = $userdata['user_id'];
			if ($replace_user_id == $view_user_id)
			{
				// get an admin user id
				$sql = "SELECT user_id FROM " . USERS_TABLE . " WHERE user_id <> $view_user_id AND user_level = " . ADMIN . " AND user_active = 1";
				if ( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not obtain admin user information', '', __LINE__, __FILE__, $sql);
				}
				$row = $db->sql_fetchrow($sql);
				if ( empty($row['user_id']) )
				{
					message_die(GENERAL_ERROR, 'Could not obtain another admin user');
				}
				else
				{
					$replace_user_id = $row['user_id'];
				}
			}

			// single user group
			$sql = "SELECT g.group_id 
					FROM " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g  
					WHERE ug.user_id = $view_user_id 
						AND g.group_id = ug.group_id 
						AND g.group_single_user = 1";
			if ( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not obtain group information for this user', '', __LINE__, __FILE__, $sql);
			}
			$row = $db->sql_fetchrow($result);

			// poster name
			$username = str_replace("''", "'", $view_userdata['username'] );
			$username = str_replace("'", "\'", $username);
			$sql = "UPDATE " . POSTS_TABLE . "
					SET poster_id = " . DELETED . ", post_username = '$username' 
					WHERE poster_id = $view_user_id";
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not update posts for this user', '', __LINE__, __FILE__, $sql);
			}

			// topic poster name
			$sql = "UPDATE " . TOPICS_TABLE . "
					SET topic_poster = " . DELETED . " 
					WHERE topic_poster = $view_user_id";
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not update topics for this user', '', __LINE__, __FILE__, $sql);
			}

			// vote
			$sql = "UPDATE " . VOTE_USERS_TABLE . "
					SET vote_user_id = " . DELETED . "
					WHERE vote_user_id = $view_user_id";
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not update votes for this user', '', __LINE__, __FILE__, $sql);
			}

			// multi-user groups
			$sql = "SELECT group_id
					FROM " . GROUPS_TABLE . "
					WHERE group_moderator = $view_user_id";
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not select groups where user was moderator', '', __LINE__, __FILE__, $sql);
			}
			while ( $row_group = $db->sql_fetchrow($result) )
			{
				$group_moderator[] = $row_group['group_id'];
			}
			if ( count($group_moderator) )
			{
				$update_moderator_id = implode(', ', $group_moderator);
				
				$sql = "UPDATE " . GROUPS_TABLE . "
						SET group_moderator = $replace_user_id
						WHERE group_moderator IN ($update_moderator_id)";
				if ( !$db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not update group moderators', '', __LINE__, __FILE__, $sql);
				}
			}

			// groups
			$sql = "DELETE FROM " . GROUPS_TABLE . " WHERE group_id = " . $row['group_id'];
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete group for this user', '', __LINE__, __FILE__, $sql);
			}

			// auth
			$sql = "DELETE FROM " . AUTH_ACCESS_TABLE . " WHERE group_id = " . $row['group_id'];
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete group for this user', '', __LINE__, __FILE__, $sql);
			}

			// topic subscribed
			$sql = "DELETE FROM " . TOPICS_WATCH_TABLE . " WHERE user_id = $view_user_id";
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete user from topic watch table', '', __LINE__, __FILE__, $sql);
			}

			// banlist
			$sql = "DELETE FROM " . BANLIST_TABLE . " WHERE ban_userid = $view_user_id";
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete user from banlist table', '', __LINE__, __FILE__, $sql);
			}

			// privmsg
			$sql = "SELECT privmsgs_id
					FROM " . PRIVMSGS_TABLE . "
					WHERE privmsgs_from_userid = $view_user_id 
						OR privmsgs_to_userid = $view_user_id";
			if ( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not select all users private messages', '', __LINE__, __FILE__, $sql);
			}

			// This little bit of code directly from the private messaging section.
			while ( $row_privmsgs = $db->sql_fetchrow($result) )
			{
				$privmsg_list[] = $row_privmsgs['privmsgs_id'];
			}
			if ( count($privmsg_list) > 0 )
			{
				$delete_sql_id = implode(', ', $privmsg_list);

				$sql = "DELETE FROM " . PRIVMSGS_TEXT_TABLE . " WHERE privmsgs_text_id IN ($delete_sql_id)";
				if ( !$db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not delete private message text', '', __LINE__, __FILE__, $sql);
				}

				$sql = "DELETE FROM " . PRIVMSGS_TABLE . " WHERE privmsgs_id IN ($delete_sql_id)";
				if ( !$db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not delete private message info', '', __LINE__, __FILE__, $sql);
				}
			}

			// user group
			$sql = "DELETE FROM " . USER_GROUP_TABLE . " WHERE user_id = $view_user_id";
			if( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete user from user_group table', '', __LINE__, __FILE__, $sql);
			}

			// user
			$sql = "DELETE FROM " . USERS_TABLE . " WHERE user_id = $view_user_id";
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete user', '', __LINE__, __FILE__, $sql);
			}

			//--------------------------------------------------------------------------------
			// Prillian - Begin Code Addition
			//
			if (defined('PRILLIAN_INSTALLED')){
				$sql = 'DELETE FROM ' . IM_PREFS_TABLE . '
					WHERE user_id = ' . $view_user_id;
				if( !$db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not delete user IM prefs', '', __LINE__, __FILE__, $sql);
				}
	
				$sql = 'DELETE FROM ' . CONTACT_TABLE . '
					WHERE user_id = ' . $view_user_id . '
					OR contact_id = ' . $view_user_id;
				if( !$db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not delete user Contact List entries', '', __LINE__, __FILE__, $sql);
				}
			}
			//
			// Prillian - End Code Addition
			//--------------------------------------------------------------------------------

			// send message
			$error = true;
			$error_msg = $lang['User_deleted'];
		}

		return '';
	}
}
if (!function_exists('mods_get_username'))
{
	function mods_get_username($field, $value)
	{
		global $is_guest, $board_config;
		// guest value is anonymous... make it blank!
		if($is_guest){
			$value = '';
		}
		// only display username on registering and when changing is allowed
		if ( $is_guest || $board_config['allow_namechange'] || defined('IN_ADMIN')){
		$username = '<input type="text" maxlength="255" size="45" class="post" name="'.$field.'" value="'.$value.'">';
		} else {
			$username = '<input type="hidden" class="post" name="'.$field.'" value="'.$value.'"><strong>'.$value.'</strong>';
		}
		return $username;
	}
}

if (!function_exists('mods_check_username'))
{
	function mods_check_username($field, $value)
	{
		global $error, $error_msg, $is_guest, $view_userdata, $username_changed;
		
		// correct username
		$username = trim(htmlspecialchars($value));
		$username_changed = false;
		if (!defined('IN_ADMIN')){
		if($username){
			if ( $is_guest || (strtolower($username) != strtolower($view_userdata[$field])) ){
				$result = validate_username($username);
				if ( $result['error'] ) {
					$error = true;
					$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $result['error_msg'];
				} else {
					$username_changed = true;
				}
			}
		}
		}
		return $username;
	}
}

if (!function_exists('mods_get_email'))
{
	function mods_get_email($field, $value)
	{
		global $view_userdata, $lang, $board_config, $lang, $is_guest;
		
		if($board_config['require_activation'] != USER_ACTIVATION_NONE){
			if ($is_guest){
				if ( $board_config['require_activation'] == USER_ACTIVATION_SELF ){
					$message = $lang['Email_confirm_guest'];
				} else if ( $board_config['require_activation'] == USER_ACTIVATION_ADMIN ){
					$message = $lang['Email_confirm_guest_admin'];
				}
			} else {
				if ( $board_config['require_activation'] == USER_ACTIVATION_SELF ){
					$message = $lang['Email_confirm'];
				} else if ( $board_config['require_activation'] == USER_ACTIVATION_ADMIN ){
					$message = $lang['Email_confirm_admin'];
				}
			}
			$email = '<i><span class="gensmall">'.$message.'</span></i><br>';
		}
		// build the html select statement
		$email .= '<input type="text" maxlength="255" size="45" class="post" name="'.$field.'" value="'.$value.'">';

		return $email;
	}
}

if (!function_exists('mods_check_email'))
{
	function mods_check_email($field, $value)
	{
		global $error, $error_msg, $is_guest, $view_userdata, $email_changed;

		$email = trim(htmlspecialchars($value));
		$email_changed = false;
		if($email && !defined('IN_ADMIN')){
			if ( $is_guest || (strtolower($email) != strtolower($view_userdata[$field])) ){
				$result = validate_email($email);
				if ( $result['error'] )
				{
					$error = true;
					$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $result['error_msg'];
				} else {
					$email_changed = true;
				}
			}
		}
		return $email;
	}
}

if (!function_exists('mods_get_email_confirm'))
{
	function mods_get_email_confirm($field, $value)
	{
		global $view_userdata, $config;

		// build the html select statement
		if(defined('IN_ADMIN')){
			$value = $config['user_email'];
		} else {
		$value = $view_userdata['user_email'];
		}
		$confirm = '<input type="text" maxlength="255" size="45" class="post" name="'.$field.'" value="'.$value.'">';

		return $confirm;
	}
}

if (!function_exists('mods_check_email_confirm'))
{
	function mods_check_email_confirm($field, $value)
	{
		global $_POST, $lang, $error, $error_msg;
		
		$email = trim(htmlspecialchars($_POST['user_email']));
		$email_confirm = trim(htmlspecialchars($value));
		if(!defined('IN_ADMIN')){
		if ( strtolower($email_confirm) != strtolower($email)){
			$error = true;
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['profilcp_email_not_matching'];
		}
		}
		return $email_confirm;
	}
}

if (!function_exists('mods_get_confirm_code'))
{
    function mods_get_confirm_code($field, $value)
    {
		global $userdata, $lang, $db, $phpEx, $board_config;

		$confirm_image = '';
        if (!defined('IN_ADMIN'))
		{
			$sql = 'SELECT session_id
					FROM ' . SESSIONS_TABLE;

			if (!($result = $db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, $lang['ctracker_error_updating_userdata'], '', __LINE__, __FILE__, $sql);
			}

			if ($row = $db->sql_fetchrow($result))
			{
				$confirm_sql = '';
				do
				{
					$confirm_sql .= (($confirm_sql != '') ? ', ' : '') . "'" . $row['session_id'] . "'";
				}
				while ($row = $db->sql_fetchrow($result));

				$sql = 'DELETE FROM ' .  CONFIRM_TABLE . "
					WHERE session_id NOT IN ($confirm_sql)";
				if (!$db->sql_query($sql))
				{
					message_die(GENERAL_ERROR, $lang['ctracker_code_dbconn'], '', __LINE__, __FILE__, $sql);
				}
			}

			$db->sql_freeresult($result);

			$sql = 'SELECT COUNT(session_id) AS attempts
				FROM ' . CONFIRM_TABLE . "
				WHERE session_id = '" . $userdata['session_id'] . "'";

			if (!($result = $db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, $lang['ctracker_code_dbconn'], '', __LINE__, __FILE__, $sql);
			}

			if ($row = $db->sql_fetchrow($result))
			{
				// CTracker uses 3 by default, which is insanely low
				if ($row['attempts'] > 15)
				{
					message_die(GENERAL_MESSAGE, $lang['ctracker_code_count']);
				}
			}
			$db->sql_freeresult($result);

			// Generate the required confirmation code
			// NB 0 (zero) could get confused with O (the letter) so we make change it
			// Generate the required confirmation code
			$code_length = mt_rand(4, 6);
			$code = dss_rand();
			$code = strtoupper(base_convert($code, 16, 35));
			$code = str_replace('I', '', $code); // The letter I could get confused with the letter J and the number 1 (one) so we remove it
			$code = str_replace('0', '', $code); // NB 0 (zero) could get confused with O (the letter) so we remove it
			$code = substr($code, 2, $code_length);

			$confirm_id = md5(uniqid($user_ip));

			$sql = 'INSERT INTO ' . CONFIRM_TABLE . " (confirm_id, session_id, code)
				VALUES ('$confirm_id', '". $userdata['session_id'] . "', '$code')";

			if (!$db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, $lang['ctracker_code_dbconn'], '', __LINE__, __FILE__, $sql);
			}

			unset($code);
			$confirm_image = sprintf($lang['Confirm_code_impaired'], '<a href="mailto:' . $board_config['board_email'] . '">', '</a>');
			$confirm_image .= '<img src="' . append_sid("profile.$phpEx?mode=confirm&amp;id=$confirm_id") . '" alt="" title="" />';
	        $confirm_image .= '<br /><input type="text" class="post" style="width:200px" name="'.$field.'" size="10" maxlength="10" />'; 
			$confirm_image .= '<input type="hidden" name="confirm_id" value="' . $confirm_id . '" />';
		}
		return $confirm_image;
	}
}

if (!function_exists('mods_check_confirm_code'))
{
	function mods_check_confirm_code($field, $value)
	{
		global $error, $error_msg, $userdata, $lang, $db, $_POST;

		if ( empty($_POST['confirm_id']) )
		{
			$error = TRUE;
			$error_msg = ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['ctracker_login_wrong'];
		}
		else
		{
			$confirm_id = trim(htmlspecialchars($_POST['confirm_id']));
			$confirm_code = trim(htmlspecialchars($value));

			if (!preg_match('/^[A-Za-z0-9]+$/', $confirm_id))
			{
				$confirm_id = '';
			}

			$sql = 'SELECT code
				FROM ' . CONFIRM_TABLE . "
				WHERE confirm_id = '$confirm_id'
					AND session_id = '" . $userdata['session_id'] . "'";

			if (!($result = $db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, $lang['ctracker_code_dbconn'], __LINE__, __FILE__, $sql);
			}

			if ($row = $db->sql_fetchrow($result))
			{
				if ($row['code'] != $confirm_code)
				{
					$error = TRUE;
					$error_msg = ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['ctracker_login_wrong'];
				}
				else
				{
					$sql = 'DELETE FROM ' . CONFIRM_TABLE . "
						WHERE confirm_id = '$confirm_id'
							AND session_id = '" . $userdata['session_id'] . "'";

					if (!$db->sql_query($sql))
					{
						message_die(GENERAL_ERROR, $lang['ctracker_code_dbconn'], __LINE__, __FILE__, $sql);
					}
				}
			}
			else
			{
				$error = TRUE;
				$error_msg = ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['ctracker_login_wrong'];
			}
			$db->sql_freeresult($result);
		}
		return $confirm_code;
	}
}

if (!function_exists('mods_get_password')) 
{ 
    function mods_get_password($field, $value) 
    { 
        global $is_guest, $lang; 
        // only show extra info if not guest 
        if(strtolower($field) == 'user_password' && !$is_guest){ 
            $pass = '<i><span class="gensmall">'.$lang['password_if_changed'].'</span></i><br>'; 
        } else if (strtolower($field) == 'user_password_confirm' && !$is_guest){ 
            $pass = '<i><span class="gensmall">'.$lang['password_confirm_if_changed'].'</span></i><br>'; 
        } 
        $pass .= '<input type="password" maxlength="32" size="45" class="post" name="'.$field.'" value="">'; 
        if($is_guest){ 
            $pass .= $lang['Required_field']; 
        } 
        return $pass; 
    } 
}

if (!function_exists('mods_check_password'))
{
	function mods_check_password($field, $value)
	{
		global $is_guest, $lang, $error, $error_msg, $db, $view_userdata, $board_config, $username, $profile_security, $ctracker_config;
	
		$pass = trim(htmlspecialchars($value));
		$pass_length = $board_config['phpBBSecurity_password_min_length'];
		$pass_length_check = isset($board_config['phpBBSecurity_use_password_length']);
		$pass_match = isset($board_config['phpBBSecurity_use_password_match']);
		if ($is_guest && empty($pass)) {
			$error = true;
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . sprintf($lang['Required_Error'],$lang['Password']);
		}
		if ( strlen($pass) > 32 )	{
			$error = true;
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Password_long'];
		}
		if ( (strlen($pass) < $pass_length) && ($pass_length_check == 1) && !empty($pass) ){
			$error = true;
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . sprintf($lang['PS_pass_length_error'],$pass_length);
		}
		if ( (strlen($pass) < $ctracker_config->settings['pw_complex_min']) && ($ctracker_config->settings['pw_complex'] == 1) && !empty($pass) ){
			$error = true;
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . sprintf($lang['ctracker_info_password_minlng'], $ctracker_config->settings['pw_complex_min'], strlen($pass));
		}
		// Password complexity
		if ( $ctracker_config->settings['pw_complex'] == 1 && !empty($pass) )
		{
			$p_patterns 	= '';
			$active_pw_prot = '';
			$p_pass     	= $pass;

			switch ( $ctracker_config->settings['pw_complex_mode'] )
			{
				case 1: $p_patterns 	= '/^.*(?=.+)(?=.*\\d).*$/'; // [0-9]
						$active_pw_prot = $lang['ctracker_info_password_cmplx_1'];
						break;

				case 2: $p_patterns 	= '/^.*(?=.+)(?=.*[a-z]).*$/'; // [a-z]
						$active_pw_prot = $lang['ctracker_info_password_cmplx_2'];
						break;

				case 3: $p_patterns 	= '/^.*(?=.+)(?=.*[A-Z]).*$/'; // [A-Z]
						$active_pw_prot = $lang['ctracker_info_password_cmplx_3'];
						break;

				case 4: $p_patterns 	= '/^.*(?=.+)(?=.*\\d)(?=.*[a-z]).*$/'; // [0-9][a-z]
						$active_pw_prot = $lang['ctracker_info_password_cmplx_1'] . ', ' . $lang['ctracker_info_password_cmplx_2'];
						break;

				case 5: $p_patterns 	= '/^.*(?=.+)(?=.*\\d)(?=.*[A-Z]).*$/'; // [0-9][A-Z]
						$active_pw_prot = $lang['ctracker_info_password_cmplx_1'] . ', ' . $lang['ctracker_info_password_cmplx_3'];
						break;

				case 6: $p_patterns 	= '/^.*(?=.+)(?=.*\\d)(?=.*[a-z])(?=.*[A-Z]).*$/'; // [0-9][a-z][A-Z]
						$active_pw_prot = $lang['ctracker_info_password_cmplx_1'] . ', ' . $lang['ctracker_info_password_cmplx_2'] . ', ' . $lang['ctracker_info_password_cmplx_3'];
						break;

				case 7: $p_patterns 	= '/^.*(?=.+)(?=.*\\d)(?=.\\W).*$/'; // [0-9][*]
						$active_pw_prot = $lang['ctracker_info_password_cmplx_1'] . ', ' . $lang['ctracker_info_password_cmplx_4'];
						break;

				case 8: $p_patterns 	= '/^.*(?=.+)(?=.*\\d)(?=.*[a-z])(?=.*\\W).*$/'; // [0-9][a-z][*]
						$active_pw_prot = $lang['ctracker_info_password_cmplx_1'] . ', ' . $lang['ctracker_info_password_cmplx_2'] . ', ' . $lang['ctracker_info_password_cmplx_4'];
						break;

				case 9: $p_patterns 	= '/^.*(?=.+)(?=.*\\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\\W).*$/'; // [0-9][a-z][A-Z][*]
						$active_pw_prot = $lang['ctracker_info_password_cmplx_1'] . ', ' . $lang['ctracker_info_password_cmplx_2'] . ', ' . $lang['ctracker_info_password_cmplx_3'] . ', ' . $lang['ctracker_info_password_cmplx_4'];
						break;
			}

			if ( !preg_match($p_patterns, $p_pass) )
			{
				$error = true;
				$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . sprintf(sprintf($lang['ctracker_info_password_cmplx'], $active_pw_prot));
			}
		}
		if ( ($username == $pass) && ($pass_match == 1) ){
			$error = TRUE;
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['PS_pass_match_error'];
		}
		if (!$error && !empty($pass)) {
			$pass = md5($pass);
			$profile_security->pw_create_date($view_userdata['user_id']);
		} else if (!$is_guest){
			// go get the password for update :: otherwise password is updated to blank
			$sql = "Select $field FROM " . USERS_TABLE . " WHERE user_id = '" . $view_userdata['user_id'] . "'";
			if ( !$result = $db->sql_query($sql) ) {
				message_die(GENERAL_ERROR, 'Could not retrieve user password', '', __LINE__, __FILE__, $sql);
			}
			$row = $db->sql_fetchrow($result);
			$pass = $row[$field];
			$db->sql_freeresult($result);
		}
		return $pass;
	}
}

if (!function_exists('mods_check_password_confirm'))
{
	function mods_check_password_confirm($field, $value)
	{
		global $is_guest, $lang, $error, $error_msg, $_POST;
	
		$pass = trim(htmlspecialchars($_POST['user_password']));
		$pass_confirm = trim(htmlspecialchars($value));
		if ($is_guest && empty($pass_confirm)) {
			$error = true;
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . sprintf($lang['Required_Error'],$lang['Confirm_password']);
		}
		if ( $pass != $pass_confirm) {
			$error = true;
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Password_mismatch'];
		}
		return md5($pass_confirm);
	}
}

if (!function_exists('mods_get_user_rules')) 
{ 
    function mods_get_user_rules($field, $value) 
    { 
        global $db, $lang, $is_guest; 
         
        $sql = "SELECT * FROM " . RULES_TABLE; 
    if( !($result = $db->sql_query($sql)) ) { 
        message_die(GENERAL_ERROR, 'Could not obtain the rules', '', __LINE__, __FILE__, $sql); 
        } 
        if ($row=$db->sql_fetchrow($result)) { 
        $rules = $row["rules"]; 
      $rules_date = create_date($lang['DATE_FORMAT'], $row['date'], $board_config['board_timezone']); 
        } 
        $ret = '('.$rules_date.')<br>'; 
		$ret .=  $rules;
        if ( $value > $row['date'] && !$is_guest){ 
            $ret .= '<input type="hidden" name="'.$field.'" value="'.$value.'" >'; 
        } else { 
            $ret .= '<hr />'; 
            // also send hidden! if not checked it will return "" else it returns the 1 
            // if not send the check will not execute! 
            $ret .= '<input type="hidden" name="'.$field.'" value="">'; 
            $ret .= '<span class="gensmall">'.$lang['Agree_rules'].'</span><br><input type="checkbox" name="'.$field.'" value="1">'; 
      } 
        return $ret; 
    } 
}

if (!function_exists('mods_check_user_rules'))
{
	function mods_check_user_rules($field, $value)
	{
		if($value){
			return time();
		} else {
			return $value;
		}
	}
}

if (!function_exists('mods_get_phpBBSecurity_question')) 
{ 
    function mods_get_phpBBSecurity_question($field, $value) 
    { 
        global $lang, $is_guest, $board_config; 
        if($value == '' || $is_guest || $board_config['phpBBSecurity_Allow_Change'] || defined('IN_ADMIN')){ 
            // first timer 
            $ret = '<input type="text" name="'.$field.'" value="'.$value.'" class="post" size="45">'; 
        } else { 
            // already set 
            $ret = '<strong>'.$value.'</strong><input type="hidden" name="'.$field.'" value="'.$value.'" >'; 
        } 
        return $ret; 
    } 
} 

if (!function_exists('mods_check_phpBBSecurity_question')) 
{ 
    function mods_check_phpBBSecurity_question($field, $value) 
    { 
        return trim($value); 
    } 
} 

if (!function_exists('mods_get_phpBBSecurity_answer')) 
{ 
    function mods_get_phpBBSecurity_answer($field, $value) 
    { 
        global $lang, $is_guest, $board_config; 
        if($value == '' || $is_guest || $board_config['phpBBSecurity_Allow_Change'] || defined('IN_ADMIN')){ 
            // first timer 
            $ret = '<i><span class="gensmall">'.$lang['PS_security_a_exp_empty'].'</span></i><br>'; 
            $ret .= '<input type="text" name="'.$field.'" value="'.$value.'" class="post" size="45">'; 
        } else { 
            // already set 
            $ret = '<i><span class="gensmall">'.$lang['PS_security_a_exp_submitted'].'</span></i><br>'; 
            $ret .= '<strong>'.$value.'</strong><input type="hidden" name="'.$field.'" value="'.$value.'" >'; 
        } 
        return $ret; 
    } 
} 

if (!function_exists('mods_check_phpBBSecurity_answer')) 
{ 
    function mods_check_phpBBSecurity_answer($field, $value) 
    { 
        global $view_userdata; 
        if ($value == $view_userdata['phpBBSecurity_answer'] || trim($value) == ''){ 
            // already encrypted or empty 
            return trim($value); 
        } else { 
            return md5(trim($value)); 
        } 
    } 
}

if (!function_exists('mods_get_security_option')) 
{ 
    function mods_get_security_option($field, $value) 
    { 
				global $board_config, $lang;
        return '<input type="checkbox" name="'.$field.'" value="1">'; 
    } 
} 

if (!function_exists('mods_check_force_security')) 
{ 
    function mods_check_force_security($field, $value) 
    { 
			global $db, $board_config, $view_userdata;
			if($value && !defined('IN_ADMIN')){
				$q = "UPDATE ". USERS_TABLE ."
			  SET phpBBSecurity_login_tries = '".$board_config['phpBBSecurity_login_limit']."', phpBBSecurity_pm_sent = '1'
			  WHERE user_id = '".$view_userdata['user_id']."'";
				$db->sql_query($q);				
			}
      return $value; 
    } 
}

if (!function_exists('mods_check_reset_security')) 
{ 
    function mods_check_reset_security($field, $value) 
    { 
			global $db, $board_config, $view_userdata;
			if($value && !defined('IN_ADMIN')){
				$q = "UPDATE ". USERS_TABLE ."
			  SET phpBBSecurity_login_tries = '0', phpBBSecurity_pm_sent = '0'
			  WHERE user_id = '".$view_userdata['user_id']."'";
				$db->sql_query($q);				
			}
      return $value; 
    } 
}
if (!function_exists('mods_check_clear_security')) 
{ 
    function mods_check_clear_security($field, $value) 
    { 
			global $db, $view_userdata;
			if($value && !defined('IN_ADMIN')){
				$q = "UPDATE ". USERS_TABLE ."
			  SET phpBBSecurity_answer = '', phpBBSecurity_question = ''
			  WHERE user_id = '".$view_userdata['user_id']."'";
				$db->sql_query($q);				
			}
      return $value; 
    } 
}
?>
