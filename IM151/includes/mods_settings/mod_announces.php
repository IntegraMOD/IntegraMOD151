<?php

/***************************************************************************
 *                            mod_announces.php
 *                            -----------------
 *	begin			: 10/08/2003
 *	copyright		: Ptirhiik
 *	email			: admin@rpgnet-fr.com
 *	version			: 1.0.1 - 28/10/2003
 *
 *	mod version		: Announces  v 3.0.1
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
$sub_name = 'Board_announcement';
$config_fields = array(

	'announcement_date_display' => array(
		'lang_key'	=> 'announcement_date_display',
		'type'		=> 'LIST_RADIO',
		'default'	=> 'Yes',
		'user'		=> 'user_announcement_date_display',
		'values'	=> $list_yes_no,
		),

	'announcement_display' => array(
		'lang_key'	=> 'announcement_display',
		'type'		=> 'LIST_RADIO',
		'default'	=> 'Yes',
		'user'		=> 'user_announcement_display',
		'values'	=> $list_yes_no,
		),

	'announcement_display_forum' => array(
		'lang_key'	=> 'announcement_display_forum',
		'type'		=> 'LIST_RADIO',
		'default'	=> 'Yes',
		'user'		=> 'user_announcement_display_forum',
		'values'	=> $list_yes_no,
		),

	'announcement_split' => array(
		'lang_key'	=> 'announcement_split',
		'type'		=> 'LIST_RADIO',
		'default'	=> 'Yes',
		'user'		=> 'user_announcement_split',
		'values'	=> $list_yes_no,
		),

	'announcement_forum' => array(
		'lang_key'	=> 'announcement_forum',
		'type'		=> 'LIST_RADIO',
		'default'	=> 'Yes',
		'user'		=> 'user_announcement_forum',
		'values'	=> $list_yes_no,
		),

	'announcement_duration' => array(
		'lang_key'	=> 'announcement_duration',
		'explain'	=> 'announcement_duration_explain',
		'type'		=> 'TINYINT',
		'default'	=> 7,
		),

	'announcement_prune_strategy' => array(
		'lang_key'	=> 'announcement_prune_strategy',
		'explain'	=> 'announcement_prune_strategy_explain',
		'type'		=> 'LIST_DROP',
		'default'	=> 'Post_Normal',
		'values'	=> array(
			'Post_Normal'	=> POST_NORMAL,
			'Post_Sticky'	=> POST_STICKY,
			),
		),
);

// init config table
init_board_config($mod_name, $config_fields, $sub_name);

?>