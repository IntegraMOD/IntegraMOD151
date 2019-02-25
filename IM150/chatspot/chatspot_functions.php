<?php

/***************************************************************************
 *							chatspot_functions.php
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
		- contains all PHP functions shared between the various frames in phpBBChatSpot
		- eventually this may be split up into multiple files to provide for better organization
	************************************************************************************************************************ */

if( !defined( 'IN_PHPBB' ) )
{
	die("Hacking attempt");
}

/*error_reporting( E_ERROR | E_WARNING | E_PARSE );

include_once( $phpbb_root_path . 'config.' . $phpEx );*/

$table_chatspot_messages_name = $table_prefix . 'chatspot_messages';
$table_chatspot_sessions_name = $table_prefix . 'chatspot_sessions';
$table_chatspot_rooms_name = $table_prefix . 'chatspot_rooms';
$default_room_id = $chatspot_config[ 'default_room_id' ];

define( 'AWAY', 0 );
define( 'ACTIVE', 1 );

function get_room_name( $room_id )
{
	global $db, $table_chatspot_rooms_name;
	
	$sql = "SELECT room_name FROM $table_chatspot_rooms_name 
		WHERE
			room_id = $room_id";

	if( !$result = $db->sql_query( $sql ) )
		die( "SQL Error while retrieving room name" );

	if( !$row = $db->sql_fetchrow( $result ) )
	{
		$db->sql_freeresult( $result );
		return NULL; // room does not exist
	}

	$db->sql_freeresult( $result );

	return $row[ 'room_name' ];
}

function get_room_id( $room_name )
{
	global $db, $table_chatspot_rooms_name;
	
	$sql = "SELECT room_id FROM $table_chatspot_rooms_name 
		WHERE
			room_name = '$room_name'";

	if( !$result = $db->sql_query( $sql ) )
		die( "SQL Error while retrieving room id for '" . $room_name . "'" );

	if( !$row = $db->sql_fetchrow( $result ) )
	{
		$db->sql_freeresult( $result );
		return -1; // room does not exist
	}

	$db->sql_freeresult( $result );

	return $row[ 'room_id' ];
}

function parse_message( $msg, $msg_type )
{
	global $board_config, $userdata, $chatspot_config;
	
/* MESSAGE TYPES
	0 - reg msg
	1 - priv msg
	2 - system msg
	3 - broadcast
	4 - action
	5 - arrival/departure
	6 - kick
	7 - new room created
*/

	$msg = trim( $msg );
	
	if( $msg_type == 6 )
	{
		$kicked_string = explode( ",", $msg );
		
		$username_kicked = $kicked_string[ 1 ];
		$room_name_kicked = $kicked_string[ 2 ];

		$msg = sprintf($lang['User_kicked_from'],$username_kicked,$room_name_kicked);
	}
			
/* BBCode
	[i][/i]
	[u][/u]
	[b][/b]
	[size=1-6][/size]
	[color=#000000][/color]
*/

	if( $chatspot_config[ 'allow_bbcode' ] )
	{
		$match = array();

		while( eregi( "\[size=[1-6]\]", $msg, $match ) )
		{
			$found = $match[ 0 ];
	
			if( $found != "" )
			{
				$sub = substr( $match[ 0 ], 6, 1 );
				if( $msg_type != 4 ) // don't allow 'size' in an action
					$msg = eregi_replace( "\[size=$sub\]", "<font size=\"$sub\">", $msg );
				else
					$msg = eregi_replace( "\[size=$sub\]", "", $msg );
			}
		}

		$match[ 0 ] = "";

		while( eregi( "\[color=.......\]", $msg, $match ) )
		{
			$found = $match[ 0 ];
		
			if( $found != "" )
			{
				$sub = substr( $match[ 0 ], 7, 7 );
				if( $msg_type != 4 ) // don't allow 'color' in an action
					$msg = eregi_replace( "\[color=$sub\]", "<font color=\"$sub\">", $msg );
				else
					$msg = eregi_replace( "\[color=$sub\]", "", $msg );
			}
		}
		
		if( $msg_type != 4 )
		{	
			$msg = eregi_replace( "\[/color\]", "</font>", $msg );
			$msg = eregi_replace( "\[/size\]", "</font>", $msg );
		}
		else
		{
			$msg = eregi_replace( "\[/color\]", "", $msg );
			$msg = eregi_replace( "\[/size\]", "", $msg );
		}

		$msg = eregi_replace( "\[i\]", "<i>", $msg );
		$msg = eregi_replace( "\[/i\]", "</i>", $msg );
		$msg = eregi_replace( "\[b\]", "<b>", $msg );
		$msg = eregi_replace( "\[/b\]", "</b>", $msg );
		$msg = eregi_replace( "\[u\]", "<u>", $msg );
		$msg = eregi_replace( "\[/u\]", "</u>", $msg );
	}

		// make URLs clickable
	if( $msg_type == 0 || $msg_type == 1 ) // regular or private message
	{
		$msg_beginning = substr( $msg, 0, 22 ); // remove font colour tag, otherwise make_clickable() won't work sometimes

		$msg = make_URLS_clickable( substr( $msg, 22 ) );
	
		$msg = $msg_beginning . $msg;	
	}
	
		// Smilies
	$msg = smilies_pass( $msg );
	$msg = preg_replace( '/images\/smiles/', '../images/smiles', $msg );
	
	return $msg;
}

function make_URLS_clickable( $text ) // this was copied from bbcode.php and modified
{
	// pad it with a space so we can match things at the start of the 1st line.
	$ret = ' ' . $text;

	// matches an "xxxx://yyyy" URL at the start of a line, or after a space. 
	// xxxx can only be alpha characters. 
	// yyyy is anything up to the first space, newline, comma, double quote or < 
	$ret = preg_replace("#(^|[\n ])([\w]+?://[^ \"\n\r\t<]*)#is", "\\1<a href=\"\\2\" onFocus=\"javascript:window.parent.scripts.reset_focus(); return false;\" target=\"_blank\">\\2</a>", $ret); 

	// matches a "www|ftp.xxxx.yyyy[/zzzz]" kinda lazy URL thing 
	// Must contain at least 2 dots. xxxx contains either alphanum, or "-" 
	// zzzz is optional.. will contain everything up to the first space, newline, 
	// comma, double quote or <. 
	$ret = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r<]*)#is", "\\1<a href=\"http://\\2\" onFocus=\"javascript:window.parent.scripts.reset_focus(); return false;\" target=\"_blank\">\\2</a>", $ret); 

	// matches an email@domain type address at the start of a line, or after a space.
	// Note: Only the followed chars are valid; alphanums, "-", "_" and or ".".
	$ret = preg_replace("#(^|[\n ])([a-z0-9&\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i", "\\1<a href=\"mailto:\\2@\\3\" onFocus=\"javascript:window.parent.scripts.reset_focus(); return false;\">\\2@\\3</a>", $ret);

	// Remove our padding..
	$ret = substr($ret, 1);

	return($ret);
}

function build_frames( $room_id, $room_name )
{
	global $userdata, $userdata, $chatspot_config, $board_config, $lang, $phpEx;
	
	$username = $userdata[ 'username' ];
	$user_id = $userdata[ 'user_id' ];

	echo "<html>\n";
	echo "<head>\n";
	echo "<title>phpBBChatSpot [$username] - [$room_name]</title>\n";
	echo "<meta http-equiv='Content-Type' content='text/html'; charset=" . $lang[ 'ENCODING' ] . ">\n";
	echo "<meta http-equiv='Content-Style-Type' content='text/css'>";
	echo "<meta name='author' content='Project Dream Views; icedawg'>";
	echo "<meta name='copyright' content='&copy; 2004 Project Dream Views; http://www.dreamviews.com/chatspot'>";
	echo "<link rel='stylesheet' href='" . $chatspot_config[ 'stylesheet' ] . "' type='text/css'>\n";
	echo "</head>\n";

// Check User Session
	if( !$userdata[ 'session_logged_in' ] )
	{
		echo "<body>".$lang['Please_login']."</body></html>";
		exit();
	}
	
	echo "<frameset rows='0,30,*,36,0,0' framespacing='0' frameborder='NO' border='0' onUnload=\"window.open('" . append_sid( 'chatspot_drop.' . $phpEx . '?room=' . $room_id . '&amp;room_name=' . $room_name . '&amp;user_id=' . $user_id . '&amp;username=' . htmlspecialchars( $username, ENT_QUOTES ) ) . "', 'drop_" . $room_id . "', 'scrollbars=no, width=225, height=60')\">\n";
	echo "<frame src='" . append_sid( 'javascript.' . $phpEx . '?room=' . $room_id . '&amp;room_name=' . $room_name  . '&amp;user_id=' . $user_id . '&amp;username=' . htmlspecialchars( $username, ENT_QUOTES ) ) . "' scrolling='no' name='scripts' marginwidth='0' marginheight='0'>\n";
	echo "<frame src='" . append_sid( 'chatspot_title.' . $phpEx . '?room_name=' . $room_name . ( $userdata[ 'user_level' ] == ADMIN ? '&amp;admin=1' : '' ) ) . "' scrolling='no' name='title' noresize marginwidth='0' marginheight='0'>\n";
	echo "<frameset cols='150,*'>\n";
	echo "<frame src='" . append_sid( 'clear_window.' . $phpEx ) . "' scrolling='yes' name='online_view' marginwidth='0' marginheight='0'>\n";
	echo "<frame src='" . append_sid( 'clear_window.' . $phpEx ) . "' scrolling='yes' name='message_view' marginwidth='0' marginheight='0'>\n";
	echo "</frameset>\n";
	echo "<frame src='" . append_sid( 'message_send.' . $phpEx . '?room=' . $room_id ) . "' scrolling='no' name='sender' noresize marginwidth='0' marginheight='0'>\n";
	echo "<frame src='" . append_sid( 'message_interpreter.' . $phpEx . '?room=' . $room_id ) . "' scrolling='no' name='message_interpret' marginwidth='0' marginheight='0'>\n";
	echo "<frame src='" . append_sid( 'message_control.' . $phpEx . '?room=' . $room_id . '&amp;user_id=' . $user_id ) . "' scrolling='no' name='message_control' marginwidth='0' marginheight='0'>\n";
	echo "</frameset>\n";

	echo "<noframes>\n";
	echo "<body>".$lang['No_Frames']."</body>\n";
	echo "</noframes>\n";
	
	echo "</html>\n";
	
	return $room_name;
}

function is_in_room( $user_id, $room_id )
{
	global $db, $table_chatspot_sessions_name;
	
	$sql = "SELECT * FROM $table_chatspot_sessions_name 
		WHERE
			user_id = '$user_id' AND 
			room_id = '$room_id'";

	if( !$result = $db->sql_query( $sql ) )
		die( "SQL Error while retrieving online information" );

	if( !$row = $db->sql_fetchrow( $result ) )
	{
		$db->sql_freeresult( $result );
		return FALSE;
	}
	
	$db->sql_freeresult( $result );

	return TRUE;
}

function number_rooms_user_in()
{
	global $db, $table_chatspot_sessions_name, $userdata;
	
	$user_id = $userdata[ 'user_id' ];

	$sql = "SELECT COUNT(room_id) AS num_rooms FROM $table_chatspot_sessions_name 
		WHERE
			user_id = '$user_id'";

	if( !$result = $db->sql_query( $sql ) )
		die( "SQL Error while retrieving online information" );

	if( !$row = $db->sql_fetchrow( $result ) )
	{
		$db->sql_freeresult( $result );
		return 0;
	}

	$db->sql_freeresult( $result );

	return $row[ 'num_rooms' ];
}

function is_user_in_any_room()
{
	return number_rooms_user_in() > 0;	
}

function get_user_id( $username )
{
	global $table_chatspot_sessions_name, $db;
	
	$sql = "SELECT user_id FROM $table_chatspot_sessions_name 
		WHERE
			username = '$username'";

	if( !$result = $db->sql_query( $sql ) )
		die( "SQL Error while retrieving user information" );

	if( !$row = $db->sql_fetchrow( $result ) )
	{
		$db->sql_freeresult( $result );
		return 0;
	}
	
	$db->sql_freeresult( $result );
		
	return $row[ 'user_id' ];
}

function get_username( $user_id )
{
	global $table_chatspot_sessions_name, $db;
	
	$sql = "SELECT username FROM $table_chatspot_sessions_name 
		WHERE
			user_id = '$user_id'";

	if( !$result = $db->sql_query( $sql ) )
		die( "SQL Error while retrieving user information" );

	if( !$row = $db->sql_fetchrow( $result ) )
	{
		$db->sql_freeresult( $result );
		return NULL;
	}
	
	$db->sql_freeresult( $result );
	
	return $row[ 'username' ];
}

function is_room_permanent( $room_id )
{
	global $db, $table_chatspot_rooms_name;
	
	$sql = "SELECT room_type FROM $table_chatspot_rooms_name 
		WHERE 
			room_id = '$room_id'";

	if( !$result = $db->sql_query( $sql ) )
		die( "SQL Error in function is_room_permanent(): SELECT" );

	if( !$row = $db->sql_fetchrow( $result ) )
		die( "SQL Error while retrieving room information" );
	
	if( $row[ 'room_type' ] == 0 )
	{
		$db->sql_freeresult( $result );
		return FALSE;
	}
	else
	{
		$db->sql_freeresult( $result );
		return TRUE;
	}
}

function is_user_in_required_group( $group_required )
{
	global $table_chatspot_rooms_name, $table_prefix, $userdata, $db;
	
	$user_id = $userdata[ 'user_id' ];
	
	$sql = "SELECT group_id, user_id FROM " . $table_prefix . "user_group 
		WHERE 
			group_id = '$group_required' 
		AND user_id = '$user_id'";

	if( !( $result = $db->sql_query( $sql ) ) )
		die( "SQL Error in function is_user_in_required_group()" );

	if( !$db->sql_fetchrow( $result ) )
	{
		$db->sql_freeresult( $result );
		return FALSE;
	}
	
	$db->sql_freeresult( $result );
			
	return TRUE;
}

function room_access_check( $room_id, $password, $skip_logistics = FALSE )
{			
	global $chatspot_config, $userdata;
	
	$user_id = $userdata[ 'user_id' ];
	
	if( !$skip_logistics )
	{
		if( is_in_room( $user_id, $room_id ) )
			return 1;
	
		if( number_rooms_user_in() >= $chatspot_config[ 'max_rooms' ] )
			return 2;
	}

		// allow moderators and administrators to go where they please
	if( $userdata[ 'user_level' ] == MOD || $userdata[ 'user_level' ] == ADMIN )
		return 0;

	$room_access_required = get_room_access_required( $room_id );

	$group_required = $room_access_required[ 'room_access' ];

	if( $group_required )
	{
		if( !is_user_in_required_group( $group_required ) )
			return 3;
	}

	$room_pword = $room_access_required[ 'room_password' ];
		
	if( $room_pword != '' )
	{
		if( $password == '' )
			return 4;
		if( $room_pword != $password )
			return 5;
	}

	return 0;
}

function get_room_access_required( $room_id )
{
	global $table_chatspot_rooms_name, $db;

	$sql = "SELECT room_password, room_access FROM $table_chatspot_rooms_name 
		WHERE 
			room_id = $room_id";

	if( !( $result = $db->sql_query( $sql ) ) )
		die( "SQL Error in function get_room_access_required()" );

	$access_reqd = $db->sql_fetchrow( $result );
	
	$db->sql_freeresult( $result );

	return( $access_reqd );
}

function is_room_empty( $room_id )
{
	global $db, $table_chatspot_sessions_name;
	
	$sql = "SELECT * FROM $table_chatspot_sessions_name 
		WHERE 
			room_id = '$room_id'";

	if( !$result = $db->sql_query( $sql ) )
		die( "SQL Error while retrieving room information" );

	if( !$row = $db->sql_fetchrow( $result ) )
	{
		$db->sql_freeresult( $result );
		return TRUE;
	}

	$db->sql_freeresult( $result );
	
	return FALSE;
}

function write_msg( $msg_type, $room_id, $username, $msg, $to_user_id = 0 )
{
	global $table_chatspot_messages_name, $userdata, $db;

	$user_id = $userdata[ 'user_id' ];

	if( $msg_type == 5 || $msg_type == 6 || $msg_type == 7 ) // arrival/departure, kick, or new room created
		$from_user_id = 0;
	else
		$from_user_id = $user_id;

    $sql_values = [
        'room_id' => $room_id,
        'username' => $username,
        'msg' => $msg,
        'msg_type' => $msg_type,
        'timestamp' => time(),
        'to_user_id' => $to_user_id,
        'from_user_id' => $from_user_id,
    ];
    $sql = $db->sql_build_insert($table_chatspot_messages_name, $sql_values);
    $db->sql_query($sql, false, false, 'Could not write_msg() in chatspot', __LINE__, __FILE__);
}

function is_room_name_okay( $room_name )
{
	for( $j = 0; $j < strlen( $room_name ); $j++ )
	{
		if( $room_name[ $j ] < '0' || ( $room_name[ $j ] > '9' && $room_name[ $j ] < 'A' ) || ( $room_name[ $j ] > 'Z' && $room_name[ $j ] < 'a' &&
			$room_name[ $j ] != '_' ) || $room_name[ $j ] > 'z' )
			return FALSE;
	}

	return TRUE;	
}

function join_room( $room_id, $initialize = FALSE )
{
	global $table_chatspot_sessions_name, $userdata, $db;

	$user_id = $userdata[ 'user_id' ];
	$username = $userdata[ 'username' ];

	if( $initialize )
	{
		$sql = "DELETE FROM " . $table_chatspot_sessions_name . " 
			WHERE user_id = '$user_id'";
	}
	else // just clear a session for this room if it exists
	{
		$sql = "DELETE FROM " . $table_chatspot_sessions_name . " 
			WHERE user_id = '$user_id' AND 
			room_id = '$room_id'";
	}

	if( !$result = $db->sql_query( $sql ) )
		die( "SQL Error in function join_room(): DELETE" );

		// create the session
	update_session( ACTIVE, $room_id );
}

function join_additional_room( $room_name, $password = '' )
{
	global $db, $chatspot_config, $userdata, $room_id, $phpbb_root_path, $phpEx, $lang;
	
	$user_id = $userdata[ 'user_id' ];
	
	if( !is_room_name_okay( $room_name ) )
	{
		display_message_immediately( $lang['Room_name_error'] );
		return;
	}

	if( !is_room_name_okay( $password ) ) // use same check for password
	{
		display_message_immediately( $lang['Password_error']  );
		return;
	}

	$new_room_id = get_room_id( $room_name );
	
	$already_in_room = FALSE;

	if( $new_room_id == -1 ) // room does not exist; create!
	{
		if( number_rooms_user_in() >= $chatspot_config[ 'max_rooms' ] )
		{
			display_message_immediately( $lang['Max_rooms_error'] );
			return;
		}

		$new_room_id = create_room( $room_name, $password, $user_id );

		if( !$new_room_id == -1 )
			die( "ERROR creating new room!" );

		write_msg( 7, -1, _CHATSPOT_SYSTEM_MSG, sprintf($lang['User_created_room'],$userdata[ 'username' ],$room_name));
	}
	else
	{
		switch( room_access_check( $new_room_id, $password ) )
		{
			case 0 : // access granted
				break;
				
			case 1 : // the user is already in that room
				$already_in_room = TRUE;
				break;

			case 2 : // the user is in his or her maximum allowed number of rooms
				display_message_immediately( $lang['Max_rooms_error'] );
				return;

			case 3 : // user is not in necessary group
				display_message_immediately( $lang['Group_error'] );
				return;
				
			case 4 : // user did not supply a necessary password
				display_message_immediately( $lang['Password_protected_error'] );
				return;
				
			case 5 : // the password supplied by the user is invalid
				display_message_immediately( $lang['Password_invalid_error'] );
				return;
		
			default : // should never happen
				return;
		}			
	}
			
		// include create=$room_name just in case it should happen that the room is being purged just before this user joins...that way it'll 
		// be recreated if it doesn't exist.
	$room_path = $phpbb_root_path . "chatspot/chatspot." . $phpEx . "?room=$new_room_id&amp;password=$password&amp;create=$room_name";

	if( $already_in_room )
	{
		display_message_immediately( sprintf($lang['Open_room'],$room_name,"javascript:void(0);\" onFocus='javascript:window.parent.scripts.reset_focus(); return false;' onClick=\"javascript:window.open('$room_path','$room_name','scrollbars=no,resizable=yes,width=640,height=550'); return false;"));
	}
	else
	{	
		display_message_immediately( sprintf($lang['Open_room'],$room_name,"javascript:void(0);\" onFocus='javascript:window.parent.scripts.reset_focus(); return false;' onClick=\"javascript:window.open('$room_path','$room_name','scrollbars=no,resizable=yes,width=640,height=550'); return false;"));

		echo "<script language='JavaScript'>window.open('$room_path','$room_name','scrollbars=no,resizable=yes,width=640,height=550' )</script>";
	}
}

function create_room( $room_name, $password, $user_id, $type = 0, $group_id = 0 )
{
	global $db, $table_chatspot_rooms_name, $room_id;

	$sql = "INSERT INTO $table_chatspot_rooms_name (room_name, room_password, room_creator_id, room_access, room_type) 
		VALUES ('$room_name', '$password', '$user_id', '$group_id', '$type')";
			
	if( !$result = $db->sql_query( $sql ) )
		die( "SQL Error in function create_room()" );

	return get_room_id( $room_name );
}

function change_room_password( $room_id, $new_password )
{
	global $table_chatspot_rooms_name, $db, $userdata, $lang;
	
	$user_id = $userdata[ 'user_id' ];
	
	$creator_id = get_room_creator( $room_id );

	if( $creator_id == $user_id || $userdata[ 'user_level' ] == MOD || $userdata[ 'user_level' ] == ADMIN )
	{
        $sql_values = ['room_password' => $new_password];
        $sql = $db->sql_build_update($table_chatspot_rooms_name, $sql_values) . "WHERE room_id = " . intval($room_id);
        $db->sql_query($sql, false, false, "Cannot change password change_room_password in chatspot", __LINE__, __FILE__);

		if( $new_password == '' )
			display_message_immediately( $lang['Password_cleared'] );
		else
			display_message_immediately(  );
	}
	else
	{
		display_message_immediately( $lang['Creator_error'] );
		return;
	}
}

function get_room_creator( $room_id )
{
	global $table_chatspot_rooms_name, $db;

	$sql = "SELECT room_creator_id FROM " . $table_chatspot_rooms_name . "
		WHERE 
			room_id = '$room_id'";
			
	if( !$result = $db->sql_query( $sql ) )
		die( "SQL Error in function get_room_creator(): SELECT" );
		
	$row = $db->sql_fetchrow( $result );

	$room_creator = $row[ 'room_creator_id' ];
	$db->sql_freeresult( $result );

	return $room_creator;
}

function get_users_in_room( $room_id )
{
	global $table_chatspot_sessions_name, $chatspot_config, $db;

	$expire_time = time() - $chatspot_config[ 'inactive_time' ];

		// $room_id == -1 means return sessions in all rooms
	$room_string = ( $room_id == -1 ) ? '' : "room_id = '" . $room_id . "' AND ";
	
	  // use the forum's online session list to ensure chat's session list is valid
	if( $chatspot_config[ 'check_board_sessions' ] )
	{
		if( !empty( $room_string ) )
			$room_string = 'c.' . $room_string;

		$sql = "SELECT c.username, c.user_id, c.room_id, c.last_status, c.last_active 
			FROM " . $table_chatspot_sessions_name . " c, " . SESSIONS_TABLE . " s 
			WHERE " .
				$room_string .			
				" c.last_active >= '" . $expire_time . "' AND 
				c.user_id = s.session_user_id AND
				s.session_time >= '" . ( time() - 300 ) . "' 
			ORDER BY c.username ASC, c.room_id ASC";
	}
	else // don't use the forum's online session list
	{
		$sql = "SELECT username, user_id, room_id, last_status, last_active 
			FROM " . $table_chatspot_sessions_name . " 
			WHERE " .
				$room_string .
				" last_active >= '" . $expire_time . "' 
			ORDER BY username ASC, room_id ASC";
	}

	if( !$result = $db->sql_query( $sql ) )
		die( "SQL Error in function get_users_in_room()" );

	$online_users = array();

	$auto_away_time = time() - $chatspot_config[ 'auto_away' ];

	for( $i = 0; $row = $db->sql_fetchrow( $result ); $i++ )
	{
		if( $i > 0 && $row[ 'user_id' ] == $online_users[ $i -1 ][ 'user_id' ] && 
			$row[ 'room_id' ] == $online_users[ $i -1 ][ 'room_id' ] ) // skip duplicates (happens due to sessions on forum)
		{
			$i--;
			continue;
		}

		$online_users[ $i ] = array();
		$online_users[ $i ][ 'username' ] = ( $row[ 'last_status' ] == AWAY || $row[ 'last_active' ] < $auto_away_time ) ? 
			"<i>" . $row[ 'username' ] . "</i>" : $row[ 'username' ];
			
		$online_users[ $i ][ 'user_id' ] = $row[ 'user_id' ];
		$online_users[ $i ][ 'room_id' ] = $row[ 'room_id' ];
	}
	
	$db->sql_freeresult( $result );

	return $online_users;
}

function leave_room( $room_id, $room_name )
{
	global $table_chatspot_rooms_name, $table_chatspot_sessions_name, $userdata, $db;

	$user_id = $userdata[ 'user_id' ];
	$username = $userdata[ 'username' ];

	$sql = "DELETE FROM $table_chatspot_sessions_name 
		WHERE 
			user_id = '$user_id' AND 
			room_id = '$room_id'";

	if( !$result = $db->sql_query( $sql ) )
		die( "SQL Error in function leave_room(): DELETE" );

	// this has been commented out to reduce queries; rooms will now persist until they are purged when a user joins any room.
/*	if( is_room_empty( $room_id ) && !is_room_permanent( $room_id ) )
	{
		$sql = "DELETE FROM $table_chatspot_rooms_name 
			WHERE 
				room_id = '$room_id'";

		if( !$result = $db->sql_query( $sql ) )
			die( "SQL Error in function leave_room(): DELETE2" );
	}
	else */
		write_msg( 5, $room_id, _CHATSPOT_SYSTEM_MSG, sprintf($lang['User_left_room'],$username,$room_name) );
}

function get_messages( $room_id, &$message_id )
{
	global $chatspot_config, $table_chatspot_messages_name, $db, $userdata;

	$user_id = $userdata[ 'user_id' ];

	$sql = "SELECT message_id, username, msg, msg_type, timestamp, to_user_id, from_user_id FROM " . $table_chatspot_messages_name . " 
		WHERE
			( ( room_id = '$room_id' AND to_user_id = '0' ) OR 
			( room_id = '-1' AND ( to_user_id = '$user_id' OR to_user_id = '0' OR from_user_id = '$user_id' ) ) ) AND 
			message_id > '$message_id' 
			ORDER BY message_id ASC";

	if( !$result = $db->sql_query( $sql ) )
	{
		return;
//		die( "SQL Error in function get_messages()" );
	}

	$output = array();

	$j;
	$last_message_id;
	
	for( $j = 0; $row = $db->sql_fetchrow( $result, MYSQL_ASSOC ); $j++ )
	{
		$output[ $j ] = array( 'username' => stripslashes( $row[ 'username' ] ),
			'msg'	=> stripslashes( $row[ 'msg' ] ),
			'msg_type' => stripslashes( $row[ 'msg_type' ] ),
			'time' => stripslashes( $row[ 'timestamp' ] ),
			'to_user_id' => stripslashes( $row[ 'to_user_id' ] ), 
			'from_user_id' => stripslashes( $row[ 'from_user_id' ] ) 
		);

		$last_message_id = $row[ 'message_id' ];
	}

	if( $last_message_id )
		$message_id = $last_message_id;

	$db->sql_freeresult( $result );

	return $output;
}

function clear_chat_window()
{
	global $lang, $chatspot_config;
	
	echo "<script language='JavaScript'>";
	echo "var wmsg = function (msg) { window.parent.message_view.document.write(msg); };\n";
	echo "close();";
	echo "wmsg('<html>');";
	echo "wmsg('<head>');";
	echo "wmsg('<meta http-equiv=\"Content-Type\" content=\"text/html; charset=" . $lang['ENCODING'] . "\">');";
	echo "wmsg('<meta http-equiv=\"content-language\" content=\"en\">');";
	echo "wmsg('<link rel=\"stylesheet\" href=\"" . $chatspot_config['stylesheet'] . "\" type=\"text/css\">');";
	echo "wmsg('</head>');";
	echo "wmsg('<body leftmargin=\"0\" topmargin=\"0\" marginwidth=\"0\" marginheight=\"0\">');";
	echo "</script>";
}

function display_message_immediately( $msg, $msg_type = 2, $username = '', $to_user_id = 0, $time = 0 )
{
	global $userdata, $board_config, $chatspot_config;
	
	$user_id = $userdata[ 'user_id' ];
	
	if( $time == 0 )
		$time = time();
	
	if( $msg_type == 0 || $msg_type == 1 || $msg_type == 3 )
	{
		$username = "<a href='javascript:void(0)' onClick='javascript:window.parent.scripts.private_msg( \"$username\" ); return false;'>" . $username . "</a>";
		$message_time = " <span class=\'time\'>[" . create_date( "g:ia", $time, $userdata[ 'user_timezone' ] ) . "]</span>";
	}

	if( $msg_type == 7 && !$chatspot_config[ 'announce_room_creations' ] )
		return;
	
	echo "<script language='JavaScript'>\n";
	echo "var wmsg = function (msg) { window.parent.message_view.document.write(msg); };\n";
	echo "wmsg( '<table cellpadding=\"2\" cellspacing=\"0\" border=\"0\" width=\"100%\" class=\"table' + window.parent.scripts.get_colour() + ' \">' );";

/* MESSAGE TYPES
	0 - reg msg
	1 - priv msg
	2 - system msg
	3 - broadcast
	4 - action
	5 - arrival/departure
	6 - kick
	7 - new room created
*/

	switch( $msg_type )
	{
		case 0 : // reg message
			echo "wmsg( '<tr><td class=\"chatspot\"><b>" . addcslashes( stripslashes( $username ) , "'") . "</b>$message_time: " . addcslashes( stripslashes( $msg ) , "'") . "</td></tr>' );";
			break;
			
		case 1 : // private message
			if( $to_user_id == $user_id ) // private message to this user
				echo "wmsg( '<tr><td class=\"chatspot\"><b>" . addcslashes( stripslashes( $username ) , "'") . "</b>$message_time <span style=\'color: red\'>[<b>PRIVATE</b>]</span>: <i>" . addcslashes( stripslashes( $msg ) , "'") . "</i></td></tr>' );";
			else // private message from this user
				echo "wmsg( '<tr><td class=\"chatspot\"><b>" . addcslashes( stripslashes( $username ) , "'") . "</b>$message_time <span style=\'color: red\'>[<b>TO:  " . addcslashes( stripslashes( get_username( $to_user_id ) ) , "'") . "</b>]</span>: <i>" . addcslashes( stripslashes( $msg ) , "'") . "</i></td></tr>' );";
			break;
			
		case 2 : // system message
		case 7 : // new room created
		echo "wmsg( '<tr><td class=\"chatspot\"><b>" . _CHATSPOT_SYSTEM_MSG . "</b>: <i><span style=\'color: red\'>" . addcslashes( stripslashes( $msg ) , "'") . "</span></i></td></tr>' );";
			break;

		case 3 : // broadcasted message
			echo "wmsg( '<tr><td class=\"chatspot\"><b>" . addcslashes( stripslashes( $username ) , "'") . "</b>$message_time <span style=\'color: red\'>[<b>BROADCASTED MESSAGE</b>]</span>: <i>" . addcslashes( stripslashes( $msg ) , "'") . "</i></td></tr>' );";
			break;
		
		case 4 : // action
			echo "wmsg( '<tr><td class=\"chatspot\"><span style=\'color: purple\'><i><b>" . addcslashes( stripslashes( $username ) , "'") . "</b> " . addcslashes( stripslashes( $msg ) , "'") . "</i></span></td></tr>' );";
			break;

		case 5 : // arrival/departure
			echo "wmsg( '<tr><td class=\"chatspot\"><b>" . _CHATSPOT_SYSTEM_MSG . "</b>: <i><span style=\'color: blue\'>" . addcslashes( stripslashes( $msg ) , "'") . ' ' . create_date( $board_config[ 'default_dateformat' ], $time, $userdata[ 'user_timezone' ] ) . "</span></i></td></tr>' );";
			break;

		case 6 : // kick
			echo "wmsg( '<tr><td class=\"chatspot\"><b>" . _CHATSPOT_SYSTEM_MSG . "</b>: <i><span style=\'color: red\'>" . addcslashes( stripslashes( $msg ) , "'") . ' ' . create_date( $board_config[ 'default_dateformat' ], $time, $userdata[ 'user_timezone' ] ) . "</span></i></td></tr>' );";
			break;
	}
		
	echo "wmsg( '</table>' );";
	

	echo "if(typeof(scrollBy) != \"undefined\"){\n";
	echo "window.parent.message_view.window.scrollBy(0, 65000);\n";
	echo "}else{\n";
	echo "window.parent.message_view.window.scroll(0, 65000);\n";
	echo "}\n"; 
	echo "</script>";
}

function update_session( $status = ACTIVE, $room_id = -1 )
{
	global $table_chatspot_sessions_name, $userdata, $db;

	$user_id = $userdata[ 'user_id' ];
	$username = $userdata[ 'username' ];

	if( $room_id != -1 ) // this is the case when the session is missing
	{
        $sql_values = [
            'user_id' => $user_id,
            'username' => $username,
            'room_id' => $room_id,
            'last_active' => time(),
            'last_status' => ACTIVE,
        ];
        $sql = $db->sql_build_insert($table_chatspot_sessions_name, $sql_values);
	}
	else
	{
        $sql_values = [
            'last_active' => time(),
            'last_status' => $status,
        ];
        $sql = $db->sql_build_update($table_chatspot_sessions_name, $sql_values) . " WHERE user_id = " . intval($user_id);
	}
    $db->sql_query($sql, false, false, 'Cannot update_session() in chatspot', __LINE__, __FILE__);
}

function remove_session( $user_id )
{
	global $table_chatspot_sessions_name, $db;

	$sql = "DELETE FROM " . $table_chatspot_sessions_name . " 
		WHERE
			user_id = '" . $user_id . "'";

	if( !$result = $db->sql_query( $sql ) )
		return;
}

function purge_all_expired( $room_id, $all = FALSE )
{
	// Delete old messages -- this has been consolidated into one query executed by delete_old_messages() so that less database queries are required
	delete_old_messages( $all );

	purge_ghosts( $room_id );
}

function delete_old_messages( $all = FALSE )
{
	global $db, $chatspot_config, $table_chatspot_messages_name;
	
	if( !$all )
	{
		$sql = "DELETE FROM " . $table_chatspot_messages_name . " 
			WHERE timestamp < '" . ( time() - $chatspot_config[ 'delete_time' ] ) . "'";
	}
	else
	{
		$sql = "DELETE FROM " . $table_chatspot_messages_name . " 
			WHERE timestamp < '" . ( time() - 15 ) . "'"; // leave messages from last 15 seconds in case users still polling them
	}

	if( !$result = $db->sql_query( $sql ) )
		die( "SQL Error in function delete_old_messages()" );
}

function purge_ghosts( $not_this_room = 0 )
{
	global $db, $table_chatspot_sessions_name, $table_chatspot_rooms_name, $chatspot_config;
	
	$sql = "DELETE FROM " . $table_chatspot_sessions_name . " WHERE last_active < '" . ( time() - $chatspot_config[ 'inactive_time' ] ) . "'";

	if( !$result = $db->sql_query( $sql ) )
		die( "SQL Error in function purge_ghosts() 1" );

	// remove empty rooms

	$sql = "SELECT DISTINCT room_id FROM " . $table_chatspot_sessions_name . " 
		ORDER BY room_id ASC";

	if( !$result = $db->sql_query( $sql ) )
		die( "SQL Error in function purge_ghosts() 2" );

	$valid_rooms = array();

	for( $i = 0; $row = $db->sql_fetchrow( $result ); $i++ )
		$valid_rooms[ $i ] = $row[ 'room_id' ];

	$db->sql_freeresult( $result );

	$sql = "SELECT room_id FROM " . $table_chatspot_rooms_name . " 
		WHERE room_type = '0' AND 
		room_id <> '" . $not_this_room . "' 
		ORDER BY room_id ASC";

	if( !$result = $db->sql_query( $sql ) )
		die( "SQL Error in function purge_ghosts() 3" );

	$delete_list = '';

	while( $row = $db->sql_fetchrow( $result ) )
	{
		if( !array_search( $row[ 'room_id' ], $valid_rooms ) )
			$delete_list .= "'" . $row[ 'room_id' ] . "', ";
	}

	$db->sql_freeresult( $result );

	$delete_list = rtrim( $delete_list, ", " );

	if( $delete_list )
	{
		$sql = "DELETE FROM " . $table_chatspot_rooms_name . " 
			WHERE room_id IN ( " . $delete_list . " )";

		if( !$result = $db->sql_query( $sql ) )
			die( "SQL Error in function purge_ghosts() 4" );
	}
}
?>