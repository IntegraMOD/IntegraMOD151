<?php

/***************************************************************************
 *                            functions_mods_settings.php
 *                            ---------------------------
 *	begin			: 10/08/2003
 *	copyright		: Ptirhiik
 *	email			: admin@rpgnet-fr.com
 *	version			: 1.0.4 - 26/09/2003
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
// Hack Fixes  280806 //
if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt #23');
}
// Hack Fixes  280806 //

// some standard lists
$list_yes_no = array('Yes' => 1, 'No' => 0);

//---------------------------------------------------------------
//
//	mods_settings_get_lang() : translation keys
//
//---------------------------------------------------------------
function mods_settings_get_lang($key)
{
	global $lang;
	return ( (!empty($key) && isset($lang[$key])) ? $lang[$key] : $key );
}

//---------------------------------------------------------------
//
//	init_board_config_key() : add a key and its value to the board config table
//
// V: added sanitization
//
//---------------------------------------------------------------
function init_board_config_key($key, $value, $force=false)
{
	global $db, $board_config;

	$sql_values = array(
		'config_name' => $key,
		'config_value' => $value,
	);
	if (!isset($board_config[$key]))
	{
		$board_config[$key] = $value;
		$sql = $db->sql_build_insert(CONFIG_TABLE, $sql_values);
		$db->sql_query($sql, false, false, 'Could not add key ' . $key . ' in config table', __LINE__, __FILE__);

		$db->clear_cache('board_config');
	}
	else if ($force)
	{
		$board_config[$key] = $value;
		$sql = $db->sql_build_update(CONFIG_TABLE, $sql_values) . " WHERE config_name='$key'";
		$db->sql_query($sql, false, false, 'Could not update key ' . $key . ' in config table', __LINE__, __FILE__);

		$db->clear_cache('board_config');
	}
}

//---------------------------------------------------------------
//
//	user_board_config_key() : get the user choice if defined
//
//---------------------------------------------------------------
function user_board_config_key($key, $user_field='', $over_field='')
{
	global $board_config, $userdata;

	// get the user fields name if not given
	if (empty($user_field))
	{
		$user_field = 'user_' . $key;
	}

	// get the overwrite allowed switch name if not given
	if (empty($over_field))
	{
		$over_field = $key . '_over';
	}

	// does the key exists ?
	if (!isset($board_config[$key])) return;

	// does the user field exists ?
	if (!isset($userdata[$user_field])) return;

	// does the overwrite switch exists ?
	if (!isset($board_config[$over_field]))
	{
		$board_config[$over_field] = 0; // no overwrite
	}

	// overwrite with the user data only if not overwrite sat, not anonymous, and logged in
	if (!intval($board_config[$over_field]) && ($userdata['user_id'] != ANONYMOUS) && $userdata['session_logged_in'])
	{
		$board_config[$key] = $userdata[$user_field];
	}
	else
	{
		$userdata[$user_field] = $board_config[$key];
	}
}

//---------------------------------------------------------------
//
//	init_board_config() : get the user choice if defined
//
//---------------------------------------------------------------
function init_board_config($mod_name, $config_fields, $sub_name='', $sub_sort=0, $mod_sort=0, $menu_name='Preferences', $menu_sort=0)
{
	global $mods;
	global $db, $board_config;

  foreach ($config_fields as $config_key => $config_data)
	{
		if (!array_key_exists('default', $config_data))
		{ // V: some keys (...like "username") have no default. Prevent warnings here.
		  // Really, they ought *not* to be created as board config keys...
			$config_data['default'] = NULL;
		}
		if (!isset($config_data['user_only']) || !$config_data['user_only'])
		{
			// create the key value
			init_board_config_key($config_key, ( isset($config_data['values'][ $config_data['default'] ]) ? $config_data['values'][ $config_data['default'] ] : $config_data['default']) );
			if (!empty($config_data['user']))
			{
				// create the "overwrite user choice" value
				init_board_config_key($config_key . '_over', 0);

				// get user choice value
				user_board_config_key($config_key, $config_data['user']);
			}
		}

		// deliever it for input only if not hidden
		if (empty($config_data['hide']))
		{
			$mods[$menu_name]['data'][$mod_name]['data'][$sub_name]['data'][$config_key] = $config_data;

			// sort values : overwrite only if not yet provided
			if (empty($mods[$menu_name]['sort']) || ($mods[$menu_name]['sort'] == 0) )
			{
				$mods[$menu_name]['sort'] = $menu_sort;
			}
			if (empty($mods[$menu_name]['data'][$mod_name]['sort']) || ($mods[$menu_name]['data'][$mod_name]['sort'] == 0) )
			{
				$mods[$menu_name]['data'][$mod_name]['sort'] = $mod_sort;
			}
			if (empty($mods[$menu_name]['data'][$mod_name]['data'][$sub_name]['sort']) || ($mods[$menu_name]['data'][$mod_name]['data'][$sub_name]['sort'] == 0) )
			{
				$mods[$menu_name]['data'][$mod_name]['data'][$sub_name]['sort'] = $sub_sort;
			}
		}
	}
}

?>
