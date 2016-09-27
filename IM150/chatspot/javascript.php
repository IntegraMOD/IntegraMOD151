<?php

/***************************************************************************
 *							javascript.php
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
		- acts as a liasion between the other frames that constitute phpBBChatSpot.
		- multiple purposes, including assisting in proper synchronization (see comments below)
	************************************************************************************************************************ */

define( 'CHATSPOT', true );
define( 'IN_PHPBB', true );
$phpbb_root_path = './../';
include_once( $phpbb_root_path . 'extension.inc' );
include_once( $phpbb_root_path . 'chatspot/chatspot_config.' . $phpEx );

if( isset( $_GET[ 'room' ] ) )
	$room_id = $_GET[ 'room' ];
else
	exit();

if( isset( $_GET[ 'room_name' ] ) )
	$room_name = $_GET[ 'room_name' ];
else
	exit();

if( isset( $_GET[ 'user_id' ] ) )
	$user_id = $_GET[ 'user_id' ];
else
	exit();
	
if( isset( $_GET[ 'username' ] ) )
	$username = $_GET[ 'username' ];
else
	exit();
?>

<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $chatspot_config[ 'charset' ]; ?>">
<link rel="stylesheet" href="<?php echo $chatspot_config['stylesheet']?>" type="text/css">
</head>

<script language="JavaScript">
<!--
var colour = 0;

// determines which row colour to use when displaying messages
function get_colour()
{
	colour = ( colour + 1 ) % 2;
	return colour;
}

function set_cookie( name, value, expire_time )
{
	document.cookie = name + "=" + escape(value) + "; expires=" + expire_time.toGMTString();
}

var control_loaded = false;

// the next two functions are to compensate for a possible exploit regarding pressing ESC after rejoining upon being kicked; without this the
// user could avoid the kicked message and still send messages.
function page_loaded()
{
	control_loaded = true;
}

function did_page_load()
{
	return control_loaded;
}

var is_kicked = false;

// the next two functions are to compensate for another possible exploit when being kicked
function is_user_kicked()
{
	return is_kicked;
}

function kick_user()
{
	is_kicked = true;
}

var is_shutting_down = false;

// the next two functions are to compensate for a possible synchronization issue that can happen when the user types /quit and it is
// interrupted by an automatic refresh.
function is_user_shutting_down()
{
	return is_shutting_down;	
}

function shut_down()
{
	is_shutting_down = true;	
}

var store_loc_sender = '';
var store_loc_control = '';

function clear_frames()
{
		// store the location of message_control and send in case they contain a session ID
	if( store_loc_control == '' )
	{
		store_loc_sender = "" + window.parent.sender.location;
		store_loc_control = "" + window.parent.message_control.location;
	}

	window.parent.message_control.location='clear_window.<?php echo$phpEx; ?>'; 
	window.parent.online_view.location='clear_window.<?php echo$phpEx; ?>';	
	window.parent.sender.location='clear_window.<?php echo$phpEx; ?>'; 
}

function restore_frames()
{
	if( is_session_expired() )
		return;

	if( store_loc_control == '' )
	{
		store_loc_sender = "" + window.parent.sender.location;
		store_loc_control = "" + window.parent.message_control.location;
	}
		
	window.parent.sender.location = store_loc_sender;
	window.parent.online_view.location='clear_window.<?php echo$phpEx; ?>'; 
	window.parent.message_view.location='clear_window.<?php echo$phpEx; ?>'; 

	if( are_cookies_enabled() )
	{
		var cookie_time = new Date();
		cookie_time.setTime( cookie_time.getTime() + 144000000 ); // longer (because on client side)...in case client's side clock is off.
	
		set_cookie( 'room_<?php echo $room_id; ?>_msg_id', 0, cookie_time );

		window.parent.message_control.location = store_loc_control;
	}
	else
	{
		reset_page_variables();

		window.parent.message_control.location	= build_URL();
	}
}

var cookies_enabled = true;

function are_cookies_enabled()
{
	return cookies_enabled;
}

var message_id = 0;
var last_active_time = 0;
var session_id = '';
var user_id = 0;

// store all necessary variables when cookies are not available
function store_page_variables( msg_id, last_active, session, user )
{
	cookies_enabled = false;
	
	message_id = msg_id;
	set_last_active_time( last_active );
	session_id = session;
	user_id = user;	
}

function set_last_active_time( active_time )
{
	if( active_time > last_active_time ) // used so that message_interpreter can update the last active time
		last_active_time = active_time;
}

function get_last_active_time()
{
	return last_active_time;
}

// for users w/o cookies
function build_URL()
{
	return '<?php echo $phpbb_root_path; ?>' + 'chatspot/message_control.<?php echo$phpEx; ?>?room=<?php echo $room_id; ?>&user_id=' + user_id + 
		'&msg=' + message_id + '&active=' + last_active_time + session_id;
}

var update_online_time = 0;

function reset_page_variables()
{
	message_id = 0;
	update_online_time = 0;	
}

function time_to_update_list( current_time, update_flag )
{
	if( ( update_online_time + 300 ) < current_time || update_flag ) // 5 minute intervals or upon user leaving/joining
	{
		update_online_time = current_time;
		return true;
	}
	else
		return false;
}

function leave_room()
{
	window.parent.message_view.location='chatspot_drop.<?php echo$phpEx; ?>?room=<?php echo $room_id; ?>&room_name=<?php echo $room_name; ?>' +
		'&user_id=<?php echo $user_id; ?>&username=<?php echo $username; ?>';

	window.parent.title.location='clear_window.<?php echo$phpEx; ?>'; 
}

function join_room( room_name )
{
	window.parent.sender.document.post.sent.value = "/join " + room_name;
	window.parent.sender.document.post.submit();
	reset_focus();
}

function reset_focus()
{
	window.parent.sender.focus();
	window.parent.sender.document.post.message.focus();
}

function private_msg( username )
{
	reset_focus();
	window.parent.sender.document.post.message.value = "/p " + username + " ";
}

var session_expired = false; // this is added just in case...

function is_session_expired()
{
	return session_expired;
}

function expire_session()
{
	session_expired = true;	
}
// -->
</script>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" link="#006699">
</body>
</html>
