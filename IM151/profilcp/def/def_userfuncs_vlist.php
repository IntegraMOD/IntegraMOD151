<?php
/***************************************************************************
 *						def_userfuncs_vlist.php
 *						-----------------------
 *	begin			: 07/10/2003
 *	copyright		: Ptirhiik
 *	email			: admin@rpgnet-fr.com
 *
 *	version			: 1.0.0 - 10/10/2003
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

//-------------------------------------------
//
//	languages installed
//
//-------------------------------------------
function get_langs_list()
{
	global $phpbb_root_path;

	// read all the language available
	$dir_lang = opendir($phpbb_root_path . './language');
	$langs = array();
	$langs_name = array();
	while ( $file_lang = readdir($dir_lang) )
	{
		if ( preg_match('#^lang_#i', $file_lang) && !is_file($phpbb_root_path . './language/' . $file_lang) && !is_link($phpbb_root_path . './language/' . $file_lang) )
		{
			$filename_lang = trim(str_replace('lang_', '', $file_lang));
			$displayname_lang = preg_replace("/^(.*?)_(.*)$/", "\\1 [ \\2 ]", $filename_lang);
			$displayname_lang = preg_replace("/\[(.*?)_(.*)\]/", "[ \\1 - \\2 ]", $displayname_lang);

			// store the result
			$langs[$filename_lang] = array( 'txt' => ucwords($displayname_lang) );
			$langs_name[] = ucwords($displayname_lang);
		}
	}
	closedir($dir_lang);
	@array_multisort($langs_name, $langs);

	return $langs;
}

//-------------------------------------------
//
//	timezone available
//
//-------------------------------------------
function get_timezones_list()
{
	global $lang;

	$tz = array('-12', '-11', '-10', '-9', '-8', '-7', '-6', '-5', '-4', '-3.5', '-3', '-2', '-1', '0', '1', '2', '3', '3.5', '4', '4.5', '5', '5.5', '6', '6.5', '7', '8', '9', '9.5', '10', '11', '12', '13' );

	$timezones = array();
	for ($i = 0; $i < count($tz); $i++)
	{
		$timezones[ $tz[$i] ] = array( 'txt' => $tz[$i], 'img' => 'tz_' . $tz[$i] );
	}

	return $timezones;
}

function get_auth_list(){
	global $phpbb_root_path, $phpEx, $board_config;
	include_once($phpbb_root_path . './includes/def_auth.' . $phpEx );
	@reset($field_names);
	while (list($auth_id, $auth_description) = @each($field_names) )	{
		$auths[$auth_id] = array( 'txt' => $auth_id, 'img' => '');
	}
	return $auths;
}

// AGCM Advanced Group Color Mod
function get_group_list()
{
	global $db, $userdata;

	$sql = 'SELECT group_id
			FROM ' . GROUPS_TABLE . '
			WHERE group_color = 1
				AND group_id = ' . GROUP_REGISTERED;
	$result = $db->sql_query($sql, false, __LINE__, __FILE__);
	if ( $row = $db->sql_fetchrow($result) )
	{
		$list_color[GROUP_REGISTERED] = array('txt' => 'Group_registered');
	}
	$db->sql_freeresult($result);

	$sql = 'SELECT g.group_id, g.group_name 
			FROM ' . USER_GROUP_TABLE . ' ug, ' . GROUPS_TABLE . ' g 
			WHERE ug.user_id = ' . intval($userdata['user_id']) . '
				AND g.group_id = ug.group_id 
				AND g.group_color = 1 
				AND ug.user_pending <> 1 
			ORDER BY g.group_weight ASC';
	$result = $db->sql_query($sql, false, __LINE__, __FILE__);

	while ( $group_data = $db->sql_fetchrow($result) )
	{
		$list_color[ intval($group_data['group_id']) ] = array( 'txt' => $group_data['group_name'] );
	}

	$db->sql_freeresult($result);
	return $list_color;
}
?>
