<?php

/***************************************************************************
 *							chatspot_drop.php
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
		- handles leaving a current room (i.e. dropping a session)
		- this file is loaded automatically when a chat window is closed (assuming the user does not have a pop-up blocker)
		- this file is also loaded when the [CLOSE] link is clicked, or when /quit or /leave is used
		- to ensure code isn't unnecessarily executed twice, this file checks to see if a session is currently still active
		  (because a user could press [CLOSE] to close and then also have this window pop-up afterwards)
		- the user_id and username are now sent to this file via the URL; this saves database queries, speeds up execution, and 
		  doesn't really cost anything because even if this can be exploited, there is nothing critical performed in this file;
		  however, since user data is not collected the language cannot be determined, so $lang cannot be used.
	************************************************************************************************************************ */

define( 'CHATSPOT', true );
define( 'IN_PHPBB', true );
$phpbb_root_path = './../';
include_once( $phpbb_root_path . 'extension.inc' );
include_once( $phpbb_root_path . 'chatspot/chatspot_config.' . $phpEx );

$userdata = array();

if( isset( $_GET[ 'room' ] ) )
	$room_id = $_GET[ 'room' ];
else
	die( $lang['Cannot_determine_room_id'] );

if( isset( $_GET[ 'room_name' ] ) )
	$room_name = $_GET[ 'room_name' ];
else
	die( $lang['Cannot_determine_room_name'] );

if( isset( $_GET[ 'user_id' ] ) )
	$userdata[ 'user_id' ] = $_GET[ 'user_id' ];
else
	die( $lang['Cannot_determine_user_id'] );

if( isset( $_GET[ 'username' ] ) )
	$userdata[ 'username' ] = $_GET[ 'username' ];
else
	die( $lang['Cannot_determine_username'] );

	// check to see if user is actually still in a room
if( is_in_room( $userdata[ 'user_id' ], $room_id ) )
{
	leave_room( $room_id, $room_name );

	echo "<html>\n";
	echo "<head>\n";
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=" . $chatspot_config[ 'charset' ] . "\">\n";
	echo "<meta http-equiv=\"refresh\" content=\"3; URL=javascript:top.close()\">\n";
	echo "<link rel=\"stylesheet\" href=\"" . $chatspot_config[ 'stylesheet' ] . "\" type=\"text/css\">\n";

	$in_room = is_user_in_any_room();

	if( $in_room )
		echo "<title>".$lang['Leaving_room']."</title>\n";
	else
		echo "<title>".$lang['Log_out']."</title>\n";

	echo "</head>\n";
	echo "<body leftmargin=\"0\" topmargin=\"0\" marginwidth=\"0\" marginheight=\"0\" link=\"#006699\">\n";
	echo "<div align=\"center\"><span class=\"chatspot\">\n";

	if( $in_room )
		echo "<br /><p><b>" . $userdata[ 'username' ] . "</b><br />".sprintf($lang['Left_room'],$room_name)."</p>\n";
	else
		echo "<br /><p><b>" . $userdata[ 'username' ] . "</b><br />".$lang['Logged_out']."</p>\n";

	echo "</span></div>\n";

	echo "</body>\n";
	echo "</html>\n";
}
else // user must have already logged out
{
	echo "<html>\n";
	echo "<head>\n";
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=" . $chatspot_config[ 'charset' ] . "\">\n";
	echo "<link rel=\"stylesheet\" href=\"" . $chatspot_config[ 'stylesheet' ] . "\" type=\"text/css\">\n";
	echo "</head>\n";
	echo "<body leftmargin=\"0\" topmargin=\"0\" marginwidth=\"0\" marginheight=\"0\" link=\"#006699\" onLoad=\"javascript:top.close(); return false;\">\n";
	echo "</body>";
	echo "</html>";

	exit();
}
?>