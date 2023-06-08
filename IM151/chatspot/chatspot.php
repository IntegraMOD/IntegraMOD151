<?php

/***************************************************************************
 *							chatspot.php
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
		- main entry point of phpBBChatSpot
		- checks for commands provided via URL to properly deploy phpBBChatSpot
		- performs a security check upon joining room
		- sets cookies (that may or may not be used in message_control.php, depending on whether the user can support
		  cookies or not)
	************************************************************************************************************************ */

define( 'CHATSPOT', true );
define( 'IN_PHPBB', true );
$phpbb_root_path = './../';
include_once( $phpbb_root_path . 'extension.inc' );
include_once( $phpbb_root_path . 'chatspot/chatspot_config.' . $phpEx );

// Check User Session
if (!$userdata['session_logged_in'])
{
	redirect(append_sid("login.$phpEx?redirect=chatspot/chatspot.$phpEx?cat_id=$cat_id"));
}

$username = $userdata[ 'username' ];
$user_id = $userdata[ 'user_id' ];

if( isset( $_GET[ 'initialize' ] ) )
	$initialize = TRUE;
else
	$initialize = FALSE;

if( isset( $_GET[ 'password' ] ) )
	$password = $_GET[ 'password' ];
else
	$password = '';

if( isset( $_GET[ 'room' ] ) )
	$room_id = $_GET[ 'room' ];
else
	$room_id = $chatspot_config[ 'default_room_id' ];

if( ( $room_name = get_room_name( $room_id ) ) == NULL )
{
	if( isset( $_GET[ 'create' ] ) )
	{
		$room_name = $_GET[ 'create' ];
		
		if( !is_room_name_okay( $room_name ) )
		{
			echo '<html><head></head><body>'.$lang['Invalid_room_name'].'</body></html>';
			exit();
		}
			
		$room_id = create_room( $room_name, $password, $user_id );
	}
	else
	{
		echo '<html><head></head><body>'.$lang['Cannot_find_room'].'</body></html>';
		exit();
	}	
}
else
{
	$skip_logistics = TRUE;

	if( room_access_check( $room_id, $password, $skip_logistics ) != 0 ) // HACKING ATTEMPT
	{
		echo '<html><head></head><body>'.$lang['Access_denied'].'</body></html>';
		exit();	
	}
}

	// don't bother checking to see if these cookies were actually set; if cookies are not working in message_control these values will
	// be appended to the URL to accomplish the same thing.
setcookie( 'room_' . $room_id . '_msg_id', 0, time() + 7200 );
setcookie( 'last_active', time(), time() + 7200 );

purge_all_expired( $room_id );

build_frames( $room_id, $room_name );

join_room( $room_id, $initialize );

write_msg( 5, $room_id, _CHATSPOT_SYSTEM_MSG, sprintf($lang['User_has_joined'],$username,$room_name));
?>
