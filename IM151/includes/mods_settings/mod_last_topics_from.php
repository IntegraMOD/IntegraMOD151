<?php

/***************************************************************************
 *                            mod_last_topics_from.php
 *                            ------------------------
 *	begin			: 10/08/2003
 *	copyright		: Ptirhiik
 *	email			: admin@rpgnet-fr.com
 *	version			: 1.0.0 - 16/09/2003
 *
 *	mod version		: last topics from  v 1.0.2
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
$mod_name = 'Topic_last_settings';
$config_fields = array(

	'last_topics_from_started' => array(
		'lang_key'	=> 'Topic_last_started_title',
		'explain'	=> 'Topic_last_started_explain',
		'type'		=> 'TINYINT',
		'default'	=> 3,
		'user'		=> 'user_last_topics_from_started',
		),

	'last_topics_from_replied' => array(
		'lang_key'	=> 'Topic_last_replied_title',
		'explain'	=> 'Topic_last_replied_explain',
		'type'		=> 'TINYINT',
		'default'	=> 3,
		'user'		=> 'user_last_topics_from_replied',
		),

	'last_topics_from_ended' => array(
		'lang_key'	=> 'Topic_last_ended_title',
		'explain'	=> 'Topic_last_ended_explain',
		'type'		=> 'TINYINT',
		'default'	=> 3,
		'user'		=> 'user_last_topics_from_ended',
		),

	'last_topics_from_split' => array(
		'lang_key'	=> 'Topic_last_split',
		'explain'	=> 'Topic_last_split_explain',
		'type'		=> 'LIST_RADIO',
		'default'	=> 'Yes',
		'user'		=> 'user_last_topics_from_split',
		'values'	=> $list_yes_no,
		),

	'last_topics_from_forum' => array(
		'lang_key'	=> 'Topic_last_forum',
		'explain'	=> 'Topic_last_forum_explain',
		'type'		=> 'LIST_RADIO',
		'default'	=> 'Yes',
		'user'		=> 'user_last_topics_from_forum',
		'values'	=> $list_yes_no,
		),
);

// init config table
init_board_config($mod_name, $config_fields);

?>