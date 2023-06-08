<?php

/***************************************************************************
 *							message_control.php
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
		- polls messages from the database and appends them to the message_view (main) window of phpBBChatSpot
		- updates the online_view (left) window of phpBBChatSpot on 5 minute intervals or when users leave/join or rooms 
		  are created
		- also ensures the user's phpBBChatSpot session is still valid
		- determines whether cookies can be used or not
		- additional coding to prevent kick-exploit
	************************************************************************************************************************ */

define( 'CHATSPOT', true );
define( 'IN_PHPBB', true );
$phpbb_root_path = './../';
include_once( $phpbb_root_path . 'extension.inc' );
include_once( $phpbb_root_path . 'chatspot/chatspot_config.' . $phpEx );
include_once( $phpbb_root_path . 'includes/bbcode.' . $phpEx );

if( !isset( $_GET[ 'user_id' ] ) )
{
	display_error($lang['Cannot_determine_user_id'] );

	exit();
}
else
	$user_id = $_GET[ 'user_id' ];

if( isset( $_GET[ 'room' ] ) )
	$room_id = $_GET[ 'room' ];
else
{
	display_error( $lang['Cannot_determine_room_id'] );

	remove_session( $user_id );

	exit();
}

if( !$userdata[ 'session_logged_in' ] )
{
	display_error( $lang['Login_to_join_chat'] );

	$sql = "SELECT username FROM " . USERS_TABLE . " 
		WHERE
			user_id = '$user_id'";
			
	if( ( $result = $db->sql_query( $sql ) ) )
	{
		$row = $db->sql_fetchrow( $result );
		
		$username = $row[ 'username' ];
		
		$db->sql_freeresult( $result );

		if( !empty( $username ) )
			write_msg( 5, $room_id, _CHATSPOT_SYSTEM_MSG, sprintf($lang['User_logged_out'],$username));
	}	

	remove_session( $user_id );

	exit();
}

if( !isset( $_COOKIE[ 'room_' . $room_id . '_msg_id' ] ) || !isset( $_COOKIE[ 'last_active' ] ) ||
	strstr( $HTTP_USER_AGENT, 'Netscape' ) )
{
	$cookies_enabled = 0; // 0 and 1 used so that compatible with JavaScript
	
	if( isset( $_GET[ 'sid' ] ) )
		$SID = '&sid=' . $_GET[ 'sid' ]; // javascript doesn't seem to like '&amp;' in the URL string.
	else
		$SID = '';

	$message_id = ( isset( $_GET[ 'msg' ] ) ? $_GET[ 'msg' ] : 0 );
	$last_active_time = ( isset( $_GET[ 'active' ] ) ? $_GET[ 'active' ] : time() );
}	
else
{
	$cookies_enabled = 1;
	
	$message_id = $_COOKIE[ 'room_' . $room_id . '_msg_id' ];
	$last_active_time = $_COOKIE[ 'last_active' ];
}

if( ( $last_active_time + $chatspot_config[ 'inactive_time' ] ) < time() )
{
	display_error( $lang['Chat_session_expired'] );
	
	$username = $userdata[ 'username' ];
	
	write_msg( 5, $room_id, _CHATSPOT_SYSTEM_MSG, sprintf($lang['User_logged_out'],$username));
	
	remove_session( $user_id );
	
	exit();
}

if( $message_id == 0 )
	$initialize_flag = TRUE;
else
	$initialize_flag = FALSE;

		// must be called before any headers are sent, otherwise the cookie cannot be modified
$messages = poll_messages( $room_id, $message_id );

?>

<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $lang['ENCODING']; ?>">

<link rel="stylesheet" href="<?php echo $chatspot_config['stylesheet']?>" type="text/css">

<script language="JavaScript">
<!--

	// hacking check
if( !window.parent.message_control )
{
	alert( 'HACKING ATTEMPT' );
	document.location = 'http://www.synergyprofessional.com/';
}
else
{
	var parent_location = "" + window.parent.location;
	var this_location = "" + window.location;
	
	var url_index = parent_location.indexOf( 'chatspot.<?php echo $phpEx; ?>' );
	var url_required = parent_location.substring( 0, url_index )

	if( ( parent_location == this_location ) || ( this_location.substring( 0, url_index ) != url_required ) || url_index < 0 )
	{
		alert( 'HACKING ATTEMPT' );
		document.location = 'http://www.synergyprofessional.com/';
	}
}

var timerID;

function begin_page()
{
	// this kick check is for users who are able to avoid having their window automatically close upon being kicked; this is possible 
	// and was proven to me by another user.
	if( window.parent.scripts.is_user_kicked() )
	{
		alert( "<?php echo $lang['Kicked_you']; ?>" );
		document.close();
	}
	else if( window.parent.scripts.is_user_shutting_down() ) // see javascript.php for details of why this is required
	{
		// done in opposite order so that this page isn't removed from memory before leave_room() is called
		window.parent.scripts.leave_room();
		window.parent.scripts.clear_frames();
	}
	else
	{
		// this ensures the user doesn't press ESC to avoid the kick message upon joining the room (thus allowing him/her to still send messages)
		window.parent.scripts.page_loaded();
		
		if( <?php echo $cookies_enabled; ?> )
			timerID = setTimeout( 'location.reload();', <?php echo $chatspot_config[ 'refresh_time' ] * 1000; ?> );
		else
		{
			window.parent.scripts.store_page_variables( <?php echo $message_id; ?>, <?php echo $last_active_time; ?>, 
				'<?php echo $SID; ?>', <?php echo $user_id; ?> );
				
			timerID = setTimeout( "location.href='" + window.parent.scripts.build_URL() + "';", <?php echo $chatspot_config[ 'refresh_time' ] * 1000; ?> );
		}
	}
}
//-->
</script>

</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="javascript:begin_page(); return false;">

<?php

show_msgs( $room_id, $messages, $initialize_flag );

?>

</body>
</html>

<?php

function poll_messages( $room_id, &$message_id )
{
	global $cookies_enabled;
	
	$messages = get_messages( $room_id, $message_id );
	
	if( $cookies_enabled )
		setcookie( 'room_' . $room_id . '_msg_id', $message_id, time() + 7200 );

	return $messages;
}

function show_msgs( $room_id, $messages, $initialize_flag )
{
	global $chatspot_config, $userdata;
	
	$user_id = $userdata[ 'user_id' ];

	if( $initialize_flag ) // output message view headers
	{
		clear_chat_window();
		$update_online_flag = 1; // 1 or 0 for javascript compatibility
	}
	else
		$update_online_flag = 0;

	$display_own_messages = $initialize_flag;
	
	for( $i = 0; $i < count( $messages ); $i++ )
	{
		$msg = $messages[ $i ];
		
			// don't display user's own messages unless refreshing; this is because the user's own messages are
			// immediately displayed on the screen upon being sent.
			// private messages and broadcasts are always displayed...this will lead to them being repeated upon
			// joining new rooms, but that isn't that big of a deal.
			// 'room creation' notices are supressed during a refresh (this makes sure the notice about the room
			// that the user has just created doesn't appear in that room upon that user joining that room).
		if( ( $msg[ 'from_user_id' ] == $user_id && !$display_own_messages && $msg[ 'msg_type' ] != 1 
			&& $msg[ 'msg_type' ] != 3 ) || ( $initialize_flag && $msg[ 'msg_type' ] == 7 ) )
			continue;
		
		if( $msg[ 'msg_type' ] == 6 ) // kick
		{
			$pos_marker = strpos( $msg[ 'msg' ], "," );
		
			$user_id_kicked = substr( $msg[ 'msg' ], 0, $pos_marker );

			if( $user_id_kicked == $user_id ) // this user was kicked!
			{
				echo "\n<script language='JavaScript'>\n";
				echo "<!--\n";
				echo "window.parent.scripts.kick_user();\n";
				echo "window.parent.scripts.clear_frames();\n";
				echo "window.parent.scripts.leave_room();\n";
				echo "//-->\n";
				echo "</script>\n";
				exit();
			}
		}

		$message = parse_message( $msg[ 'msg' ], $msg[ 'msg_type' ] );
			
		display_message_immediately( $message, $msg[ 'msg_type' ], $msg[ 'username' ], $msg[ 'to_user_id' ], $msg[ 'time' ] );

		if( $msg[ 'msg_type' ] == 5 || $msg[ 'msg_type' ] == 7 ) // user has arrived/left or a room has been created
			$update_online_flag = 1;
	}
	
	update_online( $room_id, $update_online_flag );
}

function update_online( $room_id, $update_online_flag )
{
	global $chatspot_config, $lang;

	$user_list = '';

	echo "<script language='JavaScript'>";
	echo "<!--\n";
	echo "if( window.parent.scripts.time_to_update_list( " . time() . ", $update_online_flag ) )";
	echo "{\n";
	echo "with(window.parent.online_view.document){\n";
	echo "write('<html>');";
	echo "write('<head>');";
	echo "write('<meta http-equiv=\"Content-Type\" content=\"text/html; charset=" . $lang['ENCODING'] . "\">');";
	echo "write('<meta http-equiv=\"content-language\" content=\"en\">');";
	echo "write('<link rel=\"stylesheet\" href=\"" . $chatspot_config['stylesheet'] . "\" type=\"text/css\">');";
	echo "write('</head>');";
	echo "write('<body leftmargin=\"2\" topmargin=\"2\" marginwidth=\"0\" marginheight=\"0\" link=\"#006699\">');";
	echo "write('<div align=\"left\"><span class=\"chatspot\">' );\n";
	echo "write('" . htmlspecialchars( display_online_users( $room_id, $user_list ) ) . "');\n";
	echo "write('" . htmlspecialchars( display_available_rooms( $room_id, $user_list ) ) . "');\n";
	echo "write('</span></div>');\n";
	echo "write('</body>');\n";
	echo "write('</html>');\n";
	echo "close();";
	echo "}\n";
	echo "}\n";
	echo "//-->";
	echo "</script>";
}

function display_available_rooms( $room_id, $user_list )
{
	global $table_chatspot_rooms_name, $userdata, $db, $chatspot_config;

	$sql = "SELECT * FROM " . $table_chatspot_rooms_name . " 
		ORDER BY room_name ASC";

	if( !$result = $db->sql_query( $sql ) )
		die( "SQL Error in function display_available_rooms()" );

	$user_counts = array();

	if( $chatspot_config[ 'display_num_users_in_rooms' ] )
	{
		for( $i = 0; !empty( $user_list[ $i ] ); $i++ )
		{
			$id = $user_list[ $i ][ 'room_id' ];
		
			if( empty( $user_counts[ 'room_' . $id ] ) )
				$user_counts[ 'room_' . $id ] = 1;
			else
				$user_counts[ 'room_' . $id ] += 1;
		}
	}	

	$rooms = "<table cellpadding='2' cellspacing='0' border='0' width='100%' class='table0'><tr><td class='chatspot'><b>Rooms</b>:</td></tr></table><table cellpadding='2' cellspacing='0' border='0' width='100%' class='table1'><tr><td class='chatspot'>";

	while( $row = $db->sql_fetchrow( $result ) )
	{
		$id = $row[ 'room_id' ];
		
		$users_in_room = empty( $user_counts[ 'room_' . $id ] ) ? '' : ' (' . $user_counts[ 'room_' . $id ] . ')';

		if( $row[ 'room_id' ] == $room_id )
		{
			$rooms .= "<b><font color='#006699'>[" . $row[ 'room_name' ] . ']</font></b>' . $users_in_room . '<br />';
			continue;		
		}
		
		if( !$row[ 'room_access' ] ) // user does not need to be in a special group to join room
		{
			if( !$row[ 'room_password' ] ) // room does not require password
				$rooms .= "<a href='javascript:void(0);' onClick=\"window.parent.scripts.join_room('" . $row[ 'room_name' ] . "');\">" . $row[ 'room_name' ] . "</a>$users_in_room<br />";
			else
				$rooms .= "<font color='#ff0000'>" . $row[ 'room_name' ] . '</font>' . $users_in_room . '<br />';
			continue;		
		}

		if( $userdata[ 'user_level' ] == MOD || $userdata[ 'user_level' ] == ADMIN || is_user_in_required_group( $row[ 'room_access' ] ) )
			$rooms .= "<span class='grouplink'><a href='javascript:void(0);' class='grouplink' onClick=\"javascript:window.parent.scripts.join_room('" . $row[ 'room_name' ] . "'); return false;\">" . $row[ 'room_name' ] . "</a></span>$users_in_room<br />";
	}
	
	$rooms .= "</td></tr></table>";

	$db->sql_freeresult( $result );

	return $rooms;
}

function display_online_users( $room_id, &$user_list )
{
	global $userdata, $chatspot_config, $phpEx;
	
	$user_id = $userdata[ 'user_id' ];

	$online = "<table cellpadding='2' cellspacing='0' border='0' width='100%' class='table0'><tr><td class='chatspot'><b>Users in Room</b>:</td></tr></table><table cellpadding='2' cellspacing='0' border='0' width='100%' class='table1'><tr><td class='chatspot'>";

	if( $chatspot_config[ 'display_num_users_in_rooms' ] )
		$user_list = get_users_in_room( -1 );
	else
		$user_list = get_users_in_room( $room_id );

	$session_found = FALSE;

	for( $i = 0; !empty( $user_list[ $i ] ); $i++ )
	{
		if( $user_list[ $i ][ 'room_id' ] != $room_id )
			continue;

		$online .= "<a target='_blank' onFocus='javascript:window.parent.scripts.reset_focus(); return false;' href='../profile." . $phpEx . "?mode=viewprofile&u=" . $user_list[ $i ][ 'user_id' ] . "'>" . $user_list[ $i ][ 'username' ] . "</a><br />";
	
		if( $user_list[ $i ][ 'user_id' ] == $user_id )
			$session_found = TRUE;
	}

	$online .= "</td></tr></table>";
	
	if( !$session_found )
		update_session( ACTIVE, $room_id ) ;

	return $online;
}

function display_error( $err_msg )
{
	global $chatspot_config, $lang;
	
	echo "<html><head></head><body>";
	echo "<script language='JavaScript'>";
	echo "<!--\n";
	echo "window.parent.scripts.expire_session();\n";
	echo "window.parent.scripts.clear_frames();\n";
	echo "with(window.parent.message_view.document){\n";
	echo "close();";
	echo "open();";
	echo "write('<!doctype html public \"-//w3c//dtd html 4.0 transitional//en\">');";
	echo "write('<html>');";
	echo "write('<head>');";
	echo "write('<meta http-equiv=\"Content-Type\" content=\"text/html; charset=" . $lang['ENCODING'] . "\">');";
	echo "write('<meta http-equiv=\"content-language\" content=\"en\">');";
	echo "write('<link rel=\"stylesheet\" href=\"" . $chatspot_config['stylesheet'] . "\" type=\"text/css\">');";
	echo "write('</head>');";
	echo "write('<body leftmargin=\"0\" topmargin=\"0\" marginwidth=\"0\" marginheight=\"0\">');";
	echo "write('" . $err_msg . "');";
	echo "write('</body>');";
	echo "write('</html>');";
	echo "}\n";
	echo "//-->";
	echo "</script>";
	echo "</body></html>";
}

?>