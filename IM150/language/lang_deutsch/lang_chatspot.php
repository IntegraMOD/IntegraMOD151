<?php

/***************************************************************************
 *                          lang_chatspot.php [English]
 *                              -------------------
 *   begin                : Tuesday, June 29, 2004
 *   copyright            : (C) 2004 masterdavid - Ronald John David
 *   website			  : http://www.integramod.com
 *   email                : webmaster@integramod.com
 *
 *   note: removing the original copyright is illegal even you have modified
 *         the code.  Just append yours if you have modified it.
 ***************************************************************************/


/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

// General
$lang['Return_2_chat'] = 'Return to chat';
$lang['Access_denied'] = 'ACCESS DENIED';
$lang['Room_name_error'] = 'You can only use alphanumeric characters (a-z and 0-9) and the underscore in room names.';
$lang['Password_error'] = 'You can only use alphanumeric characters (a-z and 0-9) and the underscore in passwords.';
$lang['Cannot_determine_user_id'] = 'ERROR:  Cannot determine user id.';
$lang['Cannot_determine_room_id'] = 'ERROR:  Cannot determine room id.';
$lang['Enter_room_name'] = 'Please enter a room name.'; 
$lang['Group_error'] = 'The requested room requires special group membership; access denied.';
$lang['Password_protected_error'] = 'The requested room is password protected; access denied.';
$lang['Password_invalid_error'] = 'Supplied password is invalid; access denied.';
$lang['Kicked_you'] = 'You have been kicked from this room.';
$lang['User_created_room'] = '<b>%s</b> has created the room <b>%s</b> on'; // username has created the room roomname on

// chatspot.php
$lang['Invalid_room_name'] = 'Invalid room name supplied.';
$lang['Cannot_find_room'] = 'Cannot find room.';
$lang['User_has_joined'] = '<b>%s</b> has joined room <b>%s</b> on'; // username has joined room roomname on

// config
$lang['System_msg'] = 'System Msg';

// drop
$lang['Cannot_determine_room_name'] = 'ERROR:  Cannot determine room name.';
$lang['Cannot_determine_username'] = 'ERROR:  Cannot determine username.';
$lang['Leaving_room'] = 'Leaving room...';
$lang['Log_out'] = 'Log out';
$lang['Left_room'] = 'You left the room \'%s\'.'; // You left teh room 'roomname'.
$lang['Logged_out'] = 'You have successfully logged out from phpBBChatSpot.';

// fuctions
$lang['User_kicked_from'] = '<b>%s</b> was kicked from <b>%s</b> on'; // username was kikked from roomname
$lang['Please_login'] = 'Please login to the forum to use chat.';
$lang['No_Frames'] = 'Your browser does not support frames. Please use Internet Explorer for best results.';
$lang['Max_rooms_error'] = 'You have reached the maximum allowed number of rooms.';
$lang['Already_in_room'] = 'The session list indicates that you are already in the room \'<b>%s</b>\'. If this is incorrect, click <a href="%s">here</a> to join that room.'; // room name & url inclusion
$lang['Open_room'] = 'If a window does not pop up in a few moments for the room \'<b>%s</b>\', click <a href="%s">here</a>'; // room name & url inclusion
$lang['Password_cleared'] = 'The password for this room has been cleared.'; 
$lang['Password_changed'] = 'The password for this room has been changed.'; 
$lang['Creator_error'] = 'You are not the creator of this room; permission denied.'; 
$lang['User_left_room'] = '<b>%s</b> has left the room <b>%s</b> on'; // username has left the room roomname on

// rooms
$lang['None'] = 'None'; 
$lang['Room_management'] = 'Room Management'; 
$lang['Permanent_rooms'] = '<b><u>Permanent Rooms</u></b><br />
		<br />
		This control panel allows you to manage permanent rooms in phpBBChatSpot.  Please keep in mind that users can still create their own temporary rooms.<br />
		<br />All current permanent rooms are listed below.  Please note that you can only modify (or add) one room at a time.  When done modifying a particular room press the \'<b>Update</b>\' button that corresponds to that room; when creating a new room press the \'<b>Add</b>\' button after entering the new room\'s data.<br />
		<br />
		You cannot delete the primary (default) room.<br />
		<br />'; 
$lang['Room_Name'] = 'Room Name'; 
$lang['Group_access'] = 'Group Access'; 
$lang['Control'] = 'Control';
$lang['Create'] = 'Create';

// title
$lang['Refresh_Chat'] = 'Refresh Chat'; 
$lang['Help'] = 'Help'; 
$lang['About'] = 'About'; 
$lang['Close'] = 'CLOSE';

// control
$lang['User_logged_out'] = '<b>%s</b> has logged out of the forum on'; // username 
$lang['User_logged_out'] = '<b>%s</b>\'s session has expired on'; // username 

// interpreter
$lang['Kick_missing_name'] = 'Please state the user\'s name whom you wish to kick.';
$lang['User_not_online'] = 'The user <b>%s</b> is not online.'; // username
$lang['User_not_in_room'] = 'The user <b>%s</b> is not in this room.'; // username

$lang['User_killed'] = '<b>%s</b>\'s session has been terminated.'; // username
$lang['Include_message'] = 'Please include a message to send to all rooms.';
$lang['Purge_complete'] = 'Purge complete.';
$lang['Marked_away'] = 'You have been marked as away.';
$lang['Invite_missing_name'] = 'Please state the name of the user you want to invite to this room.';
$lang['Invite_user_away'] = 'The user <b>%s</b> is not currently on the forum; invitation not sent.'; // username
$lang['Invite_user_present'] = 'The user <b>%s</b> is already in chat; use <b>/p %s</b> to send him or her a private message.'; // username + username
$lang['Invite_error'] = 'There was an error while attempting to invite <b>%s</b>'; // username
$lang['Invite_succeed'] = '<b>%s</b> has been invited to join this room in chat.'; // username
$lang['Names_room_missing'] = 'Please include a room name in which to list the names of the users.';
$lang['Room_not_exist'] = 'The room <b>%s</b> does not exist.'; // roomname
$lang['Users_in_room'] = 'The following users are in the room <b>%s</b>:  '; // roomname
$lang['Pm_missing_name'] = 'Please include the user\'s name to whom you wish to send a private message.';
$lang['Missing_Message'] = 'Please include the message you wish to send that user.';
$lang['Message_not_send'] = 'message not sent.';
$lang['Command_ignored'] = 'The command <b>%s</b> is not valid; ignored.'; // command

// send
$lang['Command_ignored'] = 'Flood control: you cannot send more than one message in %s seconds.'; // config seconds
$lang['Loading_error'] = 'The message controller did not finish loading.  Try waiting a couple seconds, or clicking on the \'Refresh Chat\' link, or exiting and coming back.';
$lang['Invite_Flood'] = 'Invite flood control:  you cannot invite more than one person in %s seconds.'; // config seconds

// manager
$lang['Room_management_response'] = 'Room Management Response';
$lang['Room_delete_error'] = 'There was an unknown error while deleting the requested room.';
$lang['Room_delete_success'] = 'The requested room has been deleted successfully.';
$lang['Room_exists'] = 'ERROR:  The room <b>%s</b> already exists.'; // roomname
$lang['Room_create_success'] = 'The requested room has been created successfully.';
$lang['Room_create_error'] = 'There was an unknown error while creating the requested room.';
$lang['Room_update_error'] = 'There was an unknown error while updating the requested room.';
$lang['Room_update_success'] = 'The requested room has been updated successfully.';


// invite
$lang['Inviting_you'] = '%s is inviting you to enter chat'; //username
$lang['Pm_invite'] = '%s wants you to join the room %s. <a href="%s">Click here to join.</a>'; // username + roomname + link
?>