<?php

 /***************************************************************************
 *                           admin_auto_lang.php
 *                            -------------------
 *   begin                : Fri, Aug 1, 2003
 *   copyright            : (C) 2003 Herbalite
 *   email                :
 *
 *   $Id: admin_auto_lang.php,v 1.1.1 2003/11/04 15:41:17 Herbalite Exp $
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
 ***************************************************************************/

define('IN_PHPBB', 1);

if ( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['General']['Auto_language_detection'] = $filename;
	return;
}

//
// Functions
// Code from language_select in function_selects
function gather_languages ($dirname = 'language')
{
	global $phpbb_root_path;
	$dir = opendir(@phpbb_realpath($phpbb_root_path . $dirname));

	$lang = array();
	while ( $file = readdir($dir) )
	{
		if ( preg_match('#^lang_#i', $file) && !is_file(phpbb_realpath($phpbb_root_path . $dirname . '/' . $file)) && !is_link($phpbb_root_path . @phpbb_realpath($dirname . '/' . $file)) )
		{
			$filename = trim(str_replace('lang_', '', $file));
			$displayname = preg_replace("/^(.*?)_(.*)$/", "\\1 [ \\2 ]", $filename);
			$displayname = preg_replace("/\[(.*?)_(.*)\]/", "[ \\1 - \\2 ]", $displayname);
			$lang[$filename] = $displayname;
		}
	}

	closedir($dir);

	@asort($lang);
	return $lang;
};
// Pre 4.1.0 does not have array_key_exists function. From php.net user contributions
function arrayKeyExists($key, $search) {
	return ((in_array($key, array_keys($search))) ? true : false);
}
//
// End functions
//

//
// Load default header
//
$phpbb_root_path = './../';
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
require($phpbb_root_path . 'includes/functions_selects.' . $phpEx);

// Initialize vars
$lang_code = '';
$lang_lang  = '';
$auto_lang_list = array();
$auto_lang_check = array();
$auto_lang_language = array();
$new_language = '';
$lang_check = '';
$langs = gather_languages();
// Extracting existing entries so we don't run the risk validating other entries in $board_config
$language_codes = array();
reset ($board_config);
$needle = 'auto_lang_';
$needle_length = strlen($needle);
foreach ($board_config as $key => $value)
{
	if ((strstr($key, $needle)))
	{
		$language_codes[$key] = $value;
	}
}
reset ($board_config);

// Edit or delete requests
if (isset ($_POST['edit']) || isset ($_POST['delete']))
{
	$auto_lang_list = (isset($_POST['auto_lang_list']) && is_array($_POST['auto_lang_list'])) ? $_POST['auto_lang_list'] : array();
	$auto_lang_check = (isset($_POST['auto_lang_check']) && is_array($_POST['auto_lang_check'])) ? $_POST['auto_lang_check'] : array();
	$auto_lang_language = (isset($_POST['auto_lang_language']) && is_array($_POST['auto_lang_language'])) ? $_POST['auto_lang_language'] : array();

	foreach ($auto_lang_list as $a_list)
	{
		$a_list = intval($a_list);
		if (!empty($auto_lang_check[$a_list]))
		{
			$lang_check = strtolower(trim($auto_lang_check[$a_list]));
			if (!arrayKeyExists($lang_check, $language_codes))
			{
				message_die (GENERAL_ERROR, sprintf($lang['auto_lang_notexists_lc'], $lang_check), '', __LINE__, __FILE__, '');
			}

			if (isset ($_POST['delete']))
			{
				$sql = 'DELETE FROM ' . CONFIG_TABLE . "
							WHERE config_name='" . str_replace("\'", "''", $lang_check) . "'";
			}
			else
			{
				// Check that the language folder exists.
				$new_language = strtolower(trim($auto_lang_language[$a_list]));
				if (empty ($new_language))
				{
					// Keep this code, in case someone decides to create a template using input tag instead of select tag (list boxes)
					continue; // Ignore empty entries, A user could have enabled the checkbox accidentially
				}
				if (!arrayKeyExists($new_language, $langs))
				{
					message_die (GENERAL_ERROR, sprintf ($lang['auto_lang_not_exist'], $new_language), '', __LINE__, __FILE__, '');
				}

				$sql = 'UPDATE ' . CONFIG_TABLE . "
							SET config_value = '" . str_replace("\'", "''", $new_language) . "'
							WHERE config_name = '" . str_replace("\'", "''", $lang_check) . "'";
			}
			if (!$db->sql_query($sql))
			{
				message_die (GENERAL_ERROR, "Couldn't update configuration table", '', __LINE__, __FILE__, $sql);
			}
			// Update $board_config as well, so the changes will be shown immediately
			if (isset ($_POST['delete']))
			{
				unset ($board_config[$lang_check]);
				unset ($language_codes[$lang_check]);
			}
			else
			{
				$board_config[$lang_check] = $new_language;
				$language_codes[$lang_check] = $new_language;
			}
		}
	}
}
else if ( isset($_POST['new']) )
{
	// Add a new entry to the config table

	$lang_code = (isset ($_POST['auto_lang_new_entry']) ? $_POST['auto_lang_new_entry'] : (isset ($_GET['auto_lang_new_entry']) ? $_GET['auto_lang_new_entry'] : '') );
	$lang_code = strtolower(trim($lang_code));
	$lang_lang = (isset ($_POST['language']) ? $_POST['language'] : '');
	$lang_lang = strtolower(trim($lang_lang));

	if (empty ($lang_code) || empty ($lang_lang))
	{
		message_die (GENERAL_ERROR, $lang['auto_lang_empty_lc'], '' ,__LINE__, __FILE__, '');
	}

	// Check language codes (Only alphanumerical chars and the minus sign are standard)
	if (preg_match('#[^a-z0-9\-]+#', $lang_code))
	{
		message_die (GENERAL_ERROR, $lang['auto_lang_invalid_characters'], '', __LINE__, __FILE__, '');
	}
	if (isset($board_config['auto_lang_' . $lang_code]))
	{
		message_die (GENERAL_ERROR, sprintf ($lang['auto_lang_exists_lc'], $lang_code), '' ,__LINE__, __FILE__, '');
	}
	if (arrayKeyExists($lang_language, $langs))
	{
		message_die (GENERAL_ERROR, sprintf ($lang['auto_lang_not_exist'], $lang_language), '', __LINE__, __FILE__, '');
	}
	$sql = "INSERT INTO " . CONFIG_TABLE . "
				SET config_name = 'auto_lang_" . str_replace ("\'", "''", $lang_code) . "', config_value= '" . str_replace ("\'", "''", $lang_lang) . "'";

	if (!$db->sql_query ($sql))
	{
		message_die (GENERAL_ERROR, "Couldn't update configuration table", '', __LINE__, __FILE__, $sql);
	}

	// Add it to $board_config as well, so the changes will be shown immediately
	$board_config['auto_lang_' . $lang_code] = $lang_lang;
	$language_codes['auto_lang_' . $lang_code] = $lang_lang;
}
// Display overview page

reset ($language_codes);
ksort ($language_codes);
reset ($language_codes);

$cnt = 0;
foreach ($language_codes as $key => $value)
{
	$template->assign_block_vars ('row', array (
		'S_AUTOLANG_CNT' => $cnt,
		'S_AUTOLANG_CODE' => str_replace('auto_lang_','',stripslashes($key)),
		'S_AUTOLANG_CHECK' => stripslashes($key),
		'S_AUTOLANG_SELECT' => language_select (stripslashes($value), 'auto_lang_language['.$cnt.']')
	));
	$cnt++;
}

$template->set_filenames(array(
	'body' => 'admin/auto_language_body.tpl')
);

$template->assign_vars( array(
	'L_AUTOLANG_TITLE' => $lang['auto_lang_title'],
	'L_AUTOLANG_EXPLAIN' => $lang['auto_lang_explain'],

	'L_AUTOLANG_CODE' => $lang['auto_lang_language_code'],
	'L_AUTOLANG_EDIT_SELECTED' => $lang['Edit'],
	'L_AUTOLANG_NEW' => $lang['Add_new'],
	'L_AUTOLANG_SELECT' => $lang['auto_lang_language_select'],
	'L_AUTOLANG_CHECK' => $lang['auto_lang_language_check'],
	'L_AUTOLANG_REMOVE_SELECTED' => $lang['Remove_selected'],

	'S_AUTOLANG_ACTION' => append_sid('admin_auto_lang.php'),
	'S_AUTOLANG_SELECT' => language_select ($lang_lang),
	'S_HIDDEN_FIELDS' => '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />',

	'U_AUTO_LANG_CODE' => $lang_code
));

$template->pparse('body');

include('./page_footer_admin.'.$phpEx);

?>
