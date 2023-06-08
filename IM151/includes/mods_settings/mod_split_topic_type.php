<?php

/***************************************************************************
 *                            mod_split_topic_type.php
 *                            ------------------------
 *	begin			: 10/08/2003
 *	copyright		: Ptirhiik
 *	email			: admin@rpgnet-fr.com
 *	version			: 1.0.1 - 11/09/2003
 *
 *	mod version		: split topic type  v 1.0.5
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

// service functions
include_once( $phpbb_root_path . 'includes/functions_mods_settings.' . $phpEx );

// mod definition
$mod_name = 'Announce_settings';
$sub_name = 'Split_settings';
$config_fields = array(

	'split_global_announce' => array(
		'lang_key'	=> 'split_global_announce',
		'type'		=> 'LIST_RADIO',
		'default'	=> 'Yes',
		'user'		=> 'user_split_global_announce',
		'values'	=> $list_yes_no,
		'hide'		=> empty($lang['Post_Global_Announcement']),
		),

	'split_announce' => array(
		'lang_key'	=> 'split_announce',
		'type'		=> 'LIST_RADIO',
		'default'	=> 'Yes',
		'user'		=> 'user_split_announce',
		'values'	=> $list_yes_no,
		),

	'split_sticky' => array(
		'lang_key'	=> 'split_sticky',
		'type'		=> 'LIST_RADIO',
		'default'	=> 'Yes',
		'user'		=> 'user_split_sticky',
		'values'	=> $list_yes_no,
		),

	'split_topic_split' => array(
		'lang_key'	=> 'split_topic_split',
		'type'		=> 'LIST_RADIO',
		'default'	=> 'No',
		'user'		=> 'user_split_topic_split',
		'values'	=> $list_yes_no,
		),
);

// init config table
init_board_config($mod_name, $config_fields, $sub_name);

?>