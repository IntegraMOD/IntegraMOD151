<?php

/***************************************************************************
 *							chatspot_front.php
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
		- called by the forum's index.php file
		- simply polls all the current chatters from phpBBChatSpot's session list; invisible and dead sessions will not be 
		  returned
		- deletion of ghosts is now performed by phpBBChatSpot upon joining rooms
	************************************************************************************************************************ */

if( !defined( 'IN_PHPBB' ) )
{
	die("Hacking attempt");
}

//include_once( $phpbb_root_path . 'config.' . $phpEx );
define('CHAT_CONFIG_ONLY', 1);
include_once( $phpbb_root_path . 'chatspot/chatspot_config.' . $phpEx );

$table_chatspot_sessions_name = $table_prefix . 'chatspot_sessions';

$expire_time = time() - $chatspot_config[ 'inactive_time' ];

$sql = "SELECT DISTINCT user_id, username FROM " . $table_chatspot_sessions_name . " 
	WHERE last_active >= '" . $expire_time . "' 
	ORDER BY username ASC";

if( $result = $db->sql_query( $sql ) )
{
	$num_users_in_chat = $db->sql_numrows( $result ); // return this

	$users_in_chat = '';

	while( $row = $db->sql_fetchrow( $result ) )
	{
		//if( strstr( $online_userlist, $row[ 'username' ] ) )  // invisible users will not be shown, nor will dead sessions
			$users_in_chat .= $row[ 'username' ] . ", ";
	}

	$users_in_chat = rtrim( $users_in_chat, ", " ); // return this

	$db->sql_freeresult( $result );
}

?>