<?php

/***************************************************************************
 *							chatspot_config.php
 *							-------------------
 *	last updated      : August 28, 2004
 *	copyright         : (c) 2004 Project Dream Views; icedawg
 *	email             : phpbbchatspot@dreamviews.com
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

/* **[DESCRIPTION]*********************************************************************************************************
		- contains parameters set by the admin for phpBBChatSpot's functionality
	************************************************************************************************************************ */

if( !defined( 'IN_PHPBB' ) )
{
	die( "Hacking attempt" );
}

include_once( $phpbb_root_path . 'common.' . $phpEx );

error_reporting  (E_ERROR | E_WARNING | E_PARSE); // This will NOT report uninitialized variables
set_magic_quotes_runtime(0); // Disable magic_quotes_runtime

if(!defined('CHAT_CONFIG_ONLY')){
	//
	// Start session management
	//
	$userdata = session_pagestart($user_ip, PAGE_INDEX);
	init_userprefs($userdata);
	//
	// End session management
	//
}

include_once( $phpbb_root_path . 'chatspot/chatspot_functions.' . $phpEx );
$langfile = $phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_chatspot.' . $phpEx;
if(file_exists($langfile)){
	include_once($langfile);
}
define( "_CHATSPOT_SYSTEM_MSG", $lang['System_msg'] );

$cfg_chatname = $board_config['sitename']; // adjust this to display the name of your forum or whatever.

$chatspot_config = array( 

	'check_board_sessions' => '1', // 1 - compare online list with current board sessions; 0 - don't check board's sessions
	
	'display_num_users_in_rooms' => '1', // 1 - count and display users in each room; 0 - don't display user counts
	
	'allow_bbcode' => '1', // allow users to use [b], [i], [u], [color], and [size].

	'announce_room_creations' => '1', // make an announcement in chat upon the creation of a new room.

	'refresh_time'	=>	'10', // new messages are polled from the database after this time (in seconds); use 10 seconds or so to reduce queries

	'delete_time' => '600', // messages are purged from the database after this time (in seconds); 600 = 10 minutes

	'inactive_time' => '1200', // user's session is terminated after this long of inactivity (in seconds); 1200 = 20 minutes

	'auto_away' => '600', // user is marked away after this length of time (in seconds); 600 = 10 minutes

	'max_msg_len' => '400', // in characters

	'flood_time' => '1.5', // in seconds

	'invite_time' => '20', // in seconds

	'default_room_id' => '1', // this should generally be left at 1
	
	'max_rooms' => '5', // the max number of rooms a user can be in simultaneously

	'charset' => $lang['ENCODING'], //'iso-8859-1', // board variable initialization is not present on some pages to reduce database queries, so this cannot be
										// retrieved from the board on those pages (like chatspot_title, _help, _about, etc.)
	
	'stylesheet' => 'chatspot.css'
);

?>