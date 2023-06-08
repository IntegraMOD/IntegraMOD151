<?php

/***************************************************************************
 *                            mod_categories_hierarchy.php
 *                            ----------------------------
 *	begin			: 10/08/2003
 *	copyright		: Ptirhiik
 *	email			: admin@rpgnet-fr.com
 *	version			: 1.0.0 - 10/08/2003
 *
 *	mod version		: categories hierarchy v 2.0.4
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
$mod_name = 'Hierarchy_setting';
$config_fields = array(

	'sub_forum' => array(
		'lang_key'	=> 'Use_sub_forum',
		'explain'	=> 'Index_packing_explain',
		'type'		=> 'LIST_RADIO',
		'default'	=> 'Medium',
		'user'		=> 'user_sub_forum',
		'values'	=> array(
			'None'		=> 0,
			'Medium'	=> 1,
			'Full'		=> 2,
			),
		),

	'split_cat' => array(
		'lang_key'	=> 'Split_categories',
		'type'		=> 'LIST_RADIO',
		'default'	=> 'Yes',
		'user'		=> 'user_split_cat',
		'values'	=> $list_yes_no,
		),

	'last_topic_title' => array(
		'lang_key'	=> 'Use_last_topic_title',
		'type'		=> 'LIST_RADIO',
		'default'	=> 'Yes',
		'user'		=> 'user_last_topic_title',
		'values'	=> $list_yes_no,
		),

	'last_topic_title_length' => array(
		'lang_key'	=> 'Last_topic_title_length',
		'type'		=> 'TINYINT',
		'default'	=> 24,
		),

	'sub_level_links' => array(
		'lang_key'	=> 'Sub_level_links',
		'explain'	=> 'Sub_level_links_explain',
		'type'		=> 'LIST_RADIO',
		'default'	=> 'With_pics',
		'user'		=> 'user_sub_level_links',
		'values'	=> array(
			'No'		=> 0,
			'Yes'		=> 1,
			'With_pics'	=> 2,
			),
		),

	'display_viewonline' => array(
		'lang_key'	=> 'Display_viewonline',
		'type'		=> 'LIST_RADIO',
		'default'	=> 'Always',
		'user'		=> 'user_display_viewonline',
		'values'	=> array(
			'Never'				=> 0,
			'Root_index_only'	=> 1,
			'Always'			=> 2,
			),
		),
	'max_posts' => array(
		'lang_key'	=> 'max_posts',
		'type'		=> 'INT',
		'default'	=> '0',
		'hide'		=> true,
		),

	'max_topics' => array(
		'lang_key'	=> 'max_topics',
		'type'		=> 'INT',
		'default'	=> '0',
		'hide'		=> true,
		),

	'max_users' => array(
		'lang_key'	=> 'max_users',
		'type'		=> 'INT',
		'default'	=> '0',
		'hide'		=> true,
		),
);

// init config table
init_board_config($mod_name, $config_fields);

?>