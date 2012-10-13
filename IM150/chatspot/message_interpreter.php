<?php

/***************************************************************************
 *							message_interpreter.php
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
		- data from message_send.php is POSTed to this file
		- sent messages are parsed here to look for commands
		- messages are inserted into the database to be received by other users
		- the user's phpBBChatSpot session is updated whenever a message is POSTed to this file
	************************************************************************************************************************ */

if( isset( $HTTP_POST_VARS[ 'sent' ] ) ) // check for this at the very beginning so we can halt page load if it's not present
{
	$message = trim( $HTTP_POST_VARS[ 'sent' ] );
	$colour = trim( $HTTP_POST_VARS[ 'color' ] );
	
	if( empty( $message ) )
		exit();
}
else
	exit();
	
define( 'CHATSPOT', true );
define( 'IN_PHPBB', true );
$phpbb_root_path = './../';
include_once( $phpbb_root_path . 'extension.inc' );
include_once( $phpbb_root_path . 'chatspot/chatspot_config.' . $phpEx );

include_once( $phpbb_root_path . 'includes/bbcode.' . $phpEx );
include_once( $phpbb_root_path . 'chatspot/user_invite.' . $phpEx );

// Check User Session
if( !$userdata[ 'session_logged_in' ] )
	exit();

if( isset( $HTTP_GET_VARS[ 'room' ] ) )
	$room_id = $HTTP_GET_VARS[ 'room' ];
else
	die($lang['Cannot_determine_room_id'] );

// must set these again because phpBB 2.0.10 unsets global variables in common.php
	$message = trim( $HTTP_POST_VARS[ 'sent' ] );
	$colour = trim( $HTTP_POST_VARS[ 'color' ] );
?>

<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $lang['ENCODING']; ?>">

<link rel="stylesheet" href="<?php echo $chatspot_config['stylesheet']?>" type="text/css">

<script language="JavaScript">
<!--

	// hacking check
if( !window.parent.message_interpret )
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

	// update phpBBChatSpot session (client side)
var current_time = <?php echo time(); ?>;

if( window.parent.scripts.are_cookies_enabled() )
{
	var cookie_time = new Date();
	
	cookie_time.setTime( ( current_time * 1000 ) + 7200000 ); // uses server's time.
	
	window.parent.scripts.set_cookie( 'last_active', current_time, cookie_time );
}
else
	window.parent.scripts.set_last_active_time( current_time );	

// -->
</script>

</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<?php
	add_msg( $room_id, $message, $colour );
?>

</body>
</html>

<?php

function add_msg( $room_id, $msg, $colour )
{
	global $chatspot_config, $userdata, $phpbb_root_path, $phpEx, $lang;
	
	$username = $userdata[ 'username' ];

		// update phpBBChatSpot session (server side)
	update_session();

	$username = stripslashes( htmlspecialchars( $username, ENT_QUOTES ) );
	$msg = htmlspecialchars( $msg );

	$msg_type = 0;
	
	$to_user_id = 0;
	$skip_formatting = FALSE;
	$skip_immediate_display = FALSE;

	if( empty( $msg ) )
		return;

	$cmds = explode( ' ', $msg );
	
	switch( trim( strtolower( $cmds[ 0 ] ) ) )
	{
		case '/kick' : // MOD COMMAND
			if( $userdata[ 'user_level' ] != MOD && $userdata[ 'user_level' ] != ADMIN && get_room_creator( $room_id ) != $userdata[ 'user_id' ] )
				return;

			if( !$cmds[ 1 ] )
			{
				display_message_immediately( $lang['Kick_missing_name'] );
				return;
			}
			
			$username_to_kick = trim( substr( $msg, 6 ) );
			
			$user_id_to_kick = 0;
			
			if( !( $user_id_to_kick = get_user_id( $username_to_kick ) ) )
			{
				display_message_immediately( sprintf($lang['User_not_online'],$username_to_kick) );
				return;
			}

			if( !is_in_room( $user_id_to_kick, $room_id ) )
			{
				display_message_immediately( sprintf($lang['User_not_in_room'],$username_to_kick));
				return;
			}

			$msg_type = 6;

			$msg = $user_id_to_kick . ',' . $username_to_kick . ',' . get_room_name( $room_id );
			
			$skip_formatting = TRUE;
			$skip_immediate_display = TRUE;
			
			break;

		case '/kill' :
			if( $userdata[ 'user_level' ] != MOD && $userdata[ 'user_level' ] != ADMIN )
				return;
		
			if( !$cmds[ 1 ] )
			{
				display_message_immediately( $lang['Kill_missing_name'] );
				return;
			}
			
			$username_to_kill = trim( substr( $msg, 6 ) );

			if( !( $user_id_to_kill = get_user_id( $username_to_kill ) ) )
			{
				display_message_immediately(sprintf($lang['User_not_online'],$username_to_kill));
				return;
			}
			
			remove_session( $user_id_to_kill );
			
			display_message_immediately( sprintf($lang['User_killed'],$username_to_kill));
		
			return;

		case '/mass' : // MOD COMMAND
			if( $userdata[ 'user_level' ] != MOD && $userdata[ 'user_level' ] != ADMIN )
				return;

			if( !$cmds[ 1 ] )
			{
				display_message_immediately( $lang['Include_message'] );
				return;
			}
			
			$room_id = -1;
			
			$msg_type = 3;

			$msg = trim( substr( $msg, 6 ) );
			
			$skip_formatting = TRUE;
			$skip_immediate_display = TRUE;

			break;

		case '/purge' : // MOD COMMAND
			if( $userdata[ 'user_level' ] != MOD && $userdata[ 'user_level' ] != ADMIN )
				return;

			if( !empty( $cmds[ 1 ] ) )
			{
				if( trim( strtolower( $cmds[ 1 ] ) ) == "all" )
					$all = TRUE; // even purge the non-expired messages
				else
					$all = FALSE;
			}

			purge_all_expired( $room_id, $all );
			display_message_immediately( $lang['Purge_complete'] );

			return;

		case '/away' :
			update_session( AWAY );

			display_message_immediately( $lang['Marked_away'] );
			return;

		case '/clear' :
			clear_chat_window();
			return;
		
		case '/invite' :
			if( !$cmds[ 1 ] )
			{
				display_message_immediately( $lang['Invite_missing_name'] );
				return;
			}
		
			$to_username = trim( substr( $msg, 8 ) );

			if( !is_user_online( $to_username ) )
			{
				display_message_immediately( sprintf($lang['Invite_user_away'],$to_username) );
				return;
			}

			if( get_user_id( $to_username ) )
			{
				display_message_immediately( sprintf($lang['Invite_user_present'],$to_username,$to_username));
				return;
			}

			$room_access_required = get_room_access_required( $room_id );
			
			$room_pword = $room_access_required[ 'room_password' ];
			
			if( $room_pword == "" )
				$password_string = "";
			else
				$password_string = "&amp;password=$room_pword";

			if( !invite_user( $to_username, $userdata[ 'user_id' ], $userdata[ 'username' ], "chatspot/chatspot." . $phpEx . "?initialize=1&amp;room=" . $room_id . $password_string, get_room_name( $room_id ) ) )
				display_message_immediately( sprintf($lang['Invite_error'],$to_username));
			else
				display_message_immediately( sprintf($lang['Invite_succeed'],$to_username));

			return;

		case '/j' :
		case '/join' :
			if( !$cmds[ 1 ] )
			{
				display_message_immediately( $lang['Enter_room_name'] );
				return;
			}
			
			$room_name = trim( substr( $cmds[ 1 ], 0, 20 ) ); // make sure room name max of 20 characters

			if( !empty( $cmds[ 2 ] ) )
				$password = trim( substr( $cmds[ 2 ], 0, 20 ) ); // make sure password max of 20 characters
			else
				$password = '';
		
			join_additional_room( $room_name, $password );
			return;
			
		case '/leave' :
		case '/q' :
		case '/quit' :
			echo "\n<script language='JavaScript'>\n";
			echo "<!--\n";
			echo "window.parent.scripts.shut_down();\n";
			echo "window.parent.scripts.clear_frames();\n";
			echo "window.parent.scripts.leave_room();\n";
			echo "//-->\n";
			echo "</script>\n";
			return;		
			
		case '/me' :
			$msg_type = 4;
			
			$msg = trim( substr( $msg, 4 ) );
	
			$skip_formatting = TRUE;
		
			break;

		case '/names' :
			if( !$cmds[ 1 ] )
			{
				display_message_immediately( $lang['Names_room_missing'] );
				return;
			}

			$room_name = trim( substr( $cmds[ 1 ], 0, 20 ) ); // make sure room name max of 20 characters

			if( ( $room_id_to_list = get_room_id( $room_name ) ) == -1 )
			{
				display_message_immediately( sprintf($lang['Room_not_exist'],$room_name));
				return;
			}

			if( !empty( $cmds[ 2 ] ) )
				$password = trim( substr( $cmds[ 2 ], 0, 20 ) ); // make sure password max of 20 characters
			else
				$password = '';

			$ret = room_access_check( $room_id_to_list, $password, TRUE );
			
			switch( $ret )
			{
				case 3 : // user is not in necessary group
					display_message_immediately( $lang['Group_error']);
					return;
				
				case 4 : // user did not supply a necessary password
					display_message_immediately( $lang['Password_protected_error'] );
					return;
				
				case 5 : // the password supplied by the user is invalid
					display_message_immediately( $lang['Password_invalid_error'] );
					return;
			
				default : 
					break;
			}			

			$users = get_users_in_room( $room_id_to_list );
			
			$online = sprintf($lang['Users_in_room'],$room_name);
			
			$i = 0;
			
			for( ; !empty( $users[ $i ] ); $i++ )
				$online .= $users[ $i ][ 'username' ] . ", ";
				
			$online = rtrim( $online, ", " );

			if( $i == 0 )
				$online .= '[NO ONE]';
			
			$online .= '.';
				
			display_message_immediately( $online );
			return;

		case '/password' :
			if( !$cmds[ 1 ] )
				$new_password = '';
			else
				$new_password = trim( substr( $cmds[ 1 ], 0, 20 ) ); // make sure new password max of 20 characters

			change_room_password( $room_id, $new_password );
			return;

		case '/p' :
		case '/pm' :
		case '/private' :
		case '/msg' :
		case '/message' :
			if( !$cmds[ 1 ] )
			{
				display_message_immediately( $lang['Pm_missing_name'] );
				return;
			}
			
			if( !$cmds[ 2 ] )
			{
				display_message_immediately( $lang['Missing_Message'] );
				return;
			}

			$msg_type = 1;
			$skip_immediate_display = TRUE;

			$find_user = trim( $cmds[ 1 ] );
			$to_user_id = 0;
			$to_username = '';
			
			for( $i = 0, $j = 0; $i < 3 && !empty( $cmds[ $j + 2 ] ); $i++, $j++ )
			{
				if( ( $find_user_id = get_user_id( $find_user ) ) == 0 ) // not found, so try concatenating the next token
				{
					if( $to_username != '' )
						break;
						
					$find_user .= ' ' . trim( $cmds[ $j + 2 ] );
				}
				else // found, but try concatentating the next token in case of duplicate matches for first part
				{
					$to_username = $find_user;
					$to_user_id = $find_user_id;
					
					$find_user .= ' ' . trim( $cmds[ $j + 2 ] );
					$i--; // make sure will go through the loop one more time
				}
			}

			if( $to_user_id == 0 )
			{
				// when displaying output, assume the name had no spaces; this is not really a big deal because whomever this person is trying to PM is not on
				display_message_immediately( sprintf($lang['User_not_online'],trim( $cmds[ 1 ] )).' '.$lang['Message_not_send']);
				return;
			}

			$pos_marker = strpos( $msg, $to_username );
			
			$pos_marker += strlen( $to_username ) + 1;
			
			$msg = substr( $msg, $pos_marker );
			
			$room_id = -1;

			break;

		case '/refresh' :
			echo "\n<script language='JavaScript'>\n";
			echo "<!--\n";
			echo "window.parent.scripts.restore_frames();\n";
			echo "//-->\n";
			echo "</script>\n";
			return;

		default :
			if( $cmds[ 0 ][ 0 ] == "/" )
			{
				display_message_immediately( sprintf($lang['Command_ignored'],trim( $cmds[ 0 ] )));
				return;
			}
			else
				break;
	}

	if( strlen( $msg ) > $chatspot_config[ 'max_msg_len' ] )
	{
		$msg = substr( $msg, 0, $chatspot_config[ 'max_msg_len' ] + 1 );
	}
	
	if( !$skip_formatting )
		$msg = "<font color='#" . $colour . "'>" . $msg . "</font>";
	
	write_msg( $msg_type, $room_id, $username, $msg, $to_user_id );

	if( !$skip_immediate_display )
	{
		$msg = parse_message( $msg, $msg_type );
		display_message_immediately( $msg, $msg_type, $username, $to_user_id );
	}
}

?>