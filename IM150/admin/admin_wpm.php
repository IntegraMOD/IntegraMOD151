<?php
/***************************************************************************
 *				 admin_wpm.php
 *			     --------------------
 *   copyright	  : (C) 2003, 2004 Duvelske
 *   email		  : duvelske@planet.nl
 *	 version mod  : 1.08
 *	 For updates please visit: http://www.vitrax.vze.com
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/
if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['General']['PM_Settings'] = $filename;
	return;
}

define('IN_PHPBB', true);

$phpbb_root_path = '../';
require($phpbb_root_path . 'extension.inc');
require("pagestart.$phpEx");
include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_admin_wpm.' . $phpEx);


if( $_POST['mode'] == 'update' )
{

	$vars = array('active_wpm');
	$sql = array();

	for( $i = 0; $i < count($vars); $i++ )
	{
		$value = str_replace("\'", "''", $_POST[$vars[$i]]);
		$value = trim($value);
		$value = addslashes($value);
		$sql[] = "UPDATE " . WPM . "
			SET value = '$value'
			WHERE name = '" . $vars[$i] . "'";
	}

	for( $i = 0; $i < count($sql); $i++ )
	{
		if ( !($result = $db->sql_query($sql[$i])) )
		{
			message_die(GENERAL_ERROR, $lang['update_error'], "", __LINE__, __FILE__, $sql[$i]);
		}
	}
		$temp_data = get_userdata($_POST['wpm_username']);
	$_POST['wpm_userid'] = $temp_data['user_id'];
	if( !$temp_data )
		{
			message_die(GENERAL_ERROR, $lang['not_existing_user'], "", __LINE__, __FILE__, $sql[$i]);
		}
	$vars = array('wpm_username', 'wpm_userid');
	for( $i = 0; $i < count($vars); $i++ )
	{
		$value = str_replace("\'", "''", $_POST[$vars[$i]]);
		$value = trim($value);
		$value = addslashes($value);
		$sql[] = "UPDATE " . WPM . "
			SET value = '$value'
			WHERE name = '" . $vars[$i] . "'";
	}

	for( $i = 0; $i < count($sql); $i++ )
	{
		if ( !($result = $db->sql_query($sql[$i])) )
		{
			message_die(GENERAL_ERROR, $lang['update_error'], "", __LINE__, __FILE__, $sql[$i]);
		}
	}
	$vars = array('wpm_subject', 'wpm_message');
	for( $i = 0; $i < count($vars); $i++ )
	{
		$value = str_replace("\'", "'", $_POST[$vars[$i]]);
		if(empty($value))
		{
			message_die(GENERAL_MESSAGE, sprintf($lang['empty_data'], '<a href="' . append_sid(basename(__FILE__)) . '">', '</a>'), $lang['wpm']);
		}
		$value = trim($value);
		$value = addslashes($value);
		$sql[] = "UPDATE " . WPM . "
			SET value = '$value'
			WHERE name = '" . $vars[$i] . "'";
	}

	for( $i = 0; $i < count($sql); $i++ )
	{
		if ( !($result = $db->sql_query($sql[$i])) )
		{
			message_die(GENERAL_ERROR, $lang['update_error'], "", __LINE__, __FILE__, $sql[$i]);
		}
	}
	
	message_die(GENERAL_MESSAGE, sprintf($lang['updated_return_settings'], '<a href="' . append_sid(basename(__FILE__)) . '">', '</a>'), $lang['wpm']);
}
$swpm_config = array();

$sql = "SELECT *
	FROM " . WPM;
if(!$result = $db->sql_query($sql))
{
	message_die(GENERAL_ERROR, $lang['update_error'], "", __LINE__, __FILE__, $sql);
}
else
{
	while($row = $db->sql_fetchrow($result))
	{
		$wpm_config[$row['name']] = $row['value'];
	}
}
$template->set_filenames(array(
	'body' => 'admin/wpm_body.tpl')
);

$s_hidden_fields = '<input type="hidden" name="mode" value="update" />';

$template->assign_vars(array(
	'L_WPM' => $lang['wpm'],
	'L_WPM_EXPLAIN' => $lang['wpm_explain'],
	'L_WPM_ACTIVE' => $lang['wpm_active'],
	'L_WPM_NAME' => $lang['wpm_name'],
	'L_WPM_SUBJECT' => $lang['wpm_subject'],
	'L_WPM_MESSAGE' => $lang['wpm_message'],
	'L_SUBMIT' => $lang['Submit'],
	'L_RESET' => $lang['Reset'],
	'L_YES' => $lang['Yes'],
	'L_NO' => $lang['No'],

	'WPM_ACTIVE_YES' => ( $wpm_config['active_wpm'] ? 'CHECKED' : '' ),
	'WPM_ACTIVE_NO' => ( !$wpm_config['active_wpm'] ? 'CHECKED' : '' ),	
	'WPM_SUBJECT' => stripslashes( $wpm_config['wpm_subject'] ), 
	'WPM_MESSAGE' => stripslashes( $wpm_config['wpm_message'] ),
	'WPM_VERSION' => $wpm_config['wpm_version'],
	'WPM_USERNAME' => $wpm_config['wpm_username'],

	'S_HIDDEN_FIELDS' => $s_hidden_fields,
	'S_WACTION' => append_sid(basename(__FILE__)))
);
$template->pparse('body');
?>