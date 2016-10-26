<?php

/***************************************************************************
 *                            mod_calendar.php
 *                            ------------------------
 *	begin			: 10/08/2003
 *	copyright		: Ptirhiik
 *	email			: admin@rpgnet-fr.com
 *	version			: 1.0.1 - 14/09/2003
 *
 *	mod version		: calendar v 1.0.0
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
$mod_name = 'Calendar';
$config_fields = array(

	'calendar_display_open' => array(
		'lang_key'	=> 'Calendar_display_open',
		'type'		=> 'LIST_RADIO',
		'default'	=> 'No',
		'user'		=> 'user_calendar_display_open',
		'values'	=> $list_yes_no,
		),

	'calendar_header_cells' => array(
		'lang_key'	=> 'Calendar_header_cells',
		'type'		=> 'TINYINT',
		'default'	=> 7,
		'user'		=> 'user_calendar_header_cells',
		),

	'calendar_title_length' => array(
		'lang_key'	=> 'Calendar_title_length',
		'type'		=> 'TINYINT',
		'default'	=> 30,
		),

	'calendar_text_length' => array(
		'lang_key'	=> 'Calendar_text_length',
		'type'		=> 'SMALLINT',
		'default'	=> 200,
		),

	'calendar_nb_row' => array(
		'lang_key'	=> 'Calendar_nb_row',
		'type'		=> 'TINYINT',
		'user'		=> 'user_calendar_nb_row',
		'default'	=> 5,
		),

	'calendar_birthday' => array(
		'lang_key'	=> 'Calendar_birthday',
		'type'		=> 'LIST_RADIO',
		'user'		=> 'user_calendar_birthday',
		'default'	=> 'Yes',
		'hide'		=> (!isset($lang['Happy_birthday']) || !isset($userdata['user_birthday'])),
		'values'	=> $list_yes_no,
		),

	'calendar_forum' => array(
		'lang_key'	=> 'Calendar_forum',
		'type'		=> 'LIST_RADIO',
		'user'		=> 'user_calendar_forum',
		'default'	=> 'Yes',
		'values'	=> $list_yes_no,
		),
);

// init config table
init_board_config($mod_name, $config_fields);

?>