<?php

/***************************************************************************
 *							chatspot_help.php
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
		- simply displays a help file listing all commands and whatnot in phpBBChatSpot
	************************************************************************************************************************ */

define( 'CHATSPOT', true );
define( 'IN_PHPBB', true );
$phpbb_root_path = './../';
include_once( $phpbb_root_path . 'extension.inc' );
include_once( $phpbb_root_path . 'chatspot/chatspot_config.' . $phpEx );

?>

<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $chatspot_config[ 'charset' ]; ?>">

<link rel="stylesheet" href="<?php echo $chatspot_config['stylesheet']?>" type="text/css">

</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" link="#006699">

<table class="formarea" width="100%" height="100%">
	<tr>
		<td>
		<table class="formarea" width="100%" height="100%">
			<tr>
				<td>
					<table class="formarea" width="100%" height="100%">
						<tr><th>phpBBChatSpot - Help</th></tr>
					</table>
				</td>
			</tr>
			<tr height="100%">
				<td align="left" valign="top" >
		<b><u>Regular chatting</u></b><br />
		<br />
		Enter your message into the text field (located next to the 'Send' button) and either press [ENTER] or click Send; you may have to click your mouse in the text box first to give it focus.<br />
		<br />
		<b><u>The following commands can be typed into the text field while chatting:</u></b><br />
		<br />

		<center><table cellspacing="0" cellpadding="5" width="90%" border="0"> 
		<tr><td class="table0" width="20%" align="center"><b>/away</b></td><td class="table0" align="left">Adjusts your online status so that you're shown as being away:  your name will be italicized in the online list.  Sending a message afterwards will revert your status.</td></tr>
		<tr><td class="table1" width="20%" align="center"><b>/clear</b></td><td class="table1" align="left">Simply clears all the messages from the screen.</td></tr>
		<tr><td class="table0" width="20%" align="center"><b>/invite</b></td><td class="table0" align="left">Sends a PM via the board to a specified user who is on the forum but <i>not</i> currently in chat to invite him or her to the room you are in.  If the room is password protected the password will be included in the URL sent to the user.  If the user you specify is already in chat, simply use <b>/pm</b> to send him or her a message to invite him or her to the room you are in.</td></tr>
		<tr><td class="table1" width="20%" align="center"><b>/join</b></td><td class="table1" align="left">Joins a specified room.  If the room you specify requires a password you must supply it after the room name.  If the room you specify does not exist, it will be created for you; room names can only be 20 characters and one word (with optional underscores).  See note below regarding pop-up blockers.</td></tr>
		<tr><td class="table0" width="20%" align="center"><b>/kick</b></td><td class="table0" align="left">Kicks a specified user from the current room.  This command will only work if you are the creator of the current room, or you have moderator permissions.  A kick will persist until the expired messages are purged; use <b>/purge all</b> to force an immediate purge.</td></tr>
		<tr><td class="table1" width="20%" align="center"><b>/kill</b></td><td class="table1" align="left">Kills a user's session.  This command will only work if you have moderator permissions.  This is essentially to accelerate the removal of dead sessions; if the user specified has an active session it will be restored when his or her online list updates.</td></tr>
		<tr><td class="table0" width="20%" align="center"><b>/leave or /quit</b></td><td class="table0" align="left">Leaves the current room.  If that room happens to be the only room you are in, then you are logged out of phpBBChatSpot.</td></tr>
		<tr><td class="table1" width="20%" align="center"><b>/mass</b></td><td class="table1" align="left">Broadcasts the specified message to all existing rooms.  This command will only work if you have moderator permissions.</td></tr>
		<tr><td class="table0" width="20%" align="center"><b>/me</b></td><td class="table0" align="left">Performs the specified action; this command mimics the IRC one.</td></tr>
		<tr><td class="table1" width="20%" align="center"><b>/names</b></td><td class="table1" align="left">Returns all the names of the users in the specified room.  If that room requires a password you must specify it after the room name.</td></tr>
		<tr><td class="table0" width="20%" align="center"><b>/password</b></td><td class="table0" align="left">Changes the current password of the current room to the one you specify.  This command will only work if you are the creator of the current room, or you have moderator permissions.  If you do not specify a password the current room's password will be cleared.</td></tr>
		<tr><td class="table1" width="20%" align="center"><b>/pm or /private</b></td><td class="table1" align="left">Sends a private message to the specified user.</td></tr>
		<tr><td class="table0" width="20%" align="center"><b>/purge</b></td><td class="table0" align="left">Forces the immediate purge of all expired messages, sessions, and rooms; otherwise this is performed automatically every time a user joins a room.  This command will only work if you have moderator permissions.</td></tr>
		<tr><td class="table1" width="20%" align="center"><b>/purge all</b></td><td class="table1" align="left">Forces the immediate purge of <b>all</b> messages (except for those sent in the last 15 seconds), sessions, and rooms.</td></tr>
		<tr><td class="table0" width="20%" align="center"><b>/refresh</b></td><td class="table0" align="left">Mimics the '<b>Refresh Chat</b>' link at the top; simply redisplays all the active messages, the online users, and the available rooms.</td></tr>
		</table></center>
		<br />
		<b><u>Online users display</u></b><br />
		<br />
		The users in the current room will appear in the left-hand panel.  Clicking on a user's name in that frame will pop up a window showing his or her forum profile; clicking on a user's name in the chat frame will allow you to send him or her a private message.  If the user is away his or her name will appear in italics in the left frame.  Please note that in order to conserve bandwidth (and prevent flickering in some browsers) the online user display is only updated every 5 minutes, or after a user joins or leaves the current room, or after a new room is created.<br />
		<br />
		<b><u>Available rooms display</u></b><br />
		<br />
		The list of available rooms appears below the online user list.  If the room name shows up as red, a password is required.  If the room name shows up as bright blue, special group membership <i>that you already possess</i> is required.  Clicking on a room name (of a non-password protected room) will automatically join that room; see note below regarding pop-up blockers.  As with the online user display, the available rooms list is only updated every 5 minutes or after a user joins or leaves the current room or after a new room is created (explained immediately above).  This means that the counts-of-users in rooms are only updated at that time.  Refreshing chat (via <b>/refresh</b> or the '<b>Refresh Chat</b>' link) will update the list before the set time.<br />
		<br />
		<b><u>Joining rooms</u></b><br />
		<br />
		As discussed above, you can join rooms that already exist by clicking on their names on the left-hand side of phpBBChatSpot.  To create a new room simply type <b>/join</b> and then the name of the room that you want to create.  If you want to create a private room, follow the room's name with a password.  The room will persist for as long as it is occupied; if the room is empty it is automatically purged after a user joins any room (which signals to phpBBChatSpot that it should perform some maintenance tasks, including purging empty rooms).  When you create a room you have access to both the <b>/kick</b> and <b>/password</b> commands (discussed above).<br />
		<br />
		<b><u>Using BBCode</u></b><br />
		<br />
		If enabled, you can use [i][/i], [b][/b], [u][/u], [size=1-6][/size], and [color=#000000][/color] to format your text as you like.<br />
		<br />
		<b><u>Email addresses and URLs</u></b><br />
		<br />
		Email addresses and URLs will be automatically parsed by phpBBChatSpot; there is no need to append any HTML tags.<br />
		<br />
		<b><u>Using smilies</u></b><br />
		<br />
		Smilies can be used in phpBBChatSpot just like on the forum.  Simply type the smiley code into the text box and it will be displayed when sent.  If you don't know the smiley code then click the 'Smilies' link at the bottom and select the appropriate smiley.<br />
		<br />
		<b><u>Changing text colour</u></b><br />
		<br />
		In addition to using [color], you can also simply click on the multi-colour bar to select a colour for your sent messages.<br />
		<br />
		<b><u>Pop-up blockers</u></b><br />
		<br />
		If you have a pop-up blocker deployed (or you have a browser that has one built-in, such as <i>Mozilla Firefox</i>) you will have to use phpBBChatSpot a little differently than other users.  Instead of using the 'X' to close the window when leaving a room, please either use the <b>[CLOSE]</b> link or the <b>/leave</b> command; doing so will ensure your session is immediately purged.  Also, when you click a room's name on the left hand side or use <b>/join</b>, the window that should pop-up will obviously not do so for you.  Instead, a message will appear in the current room and tell you to click a supplied link; this will allow you to join additional rooms.<br />
		<br />
		<b><u>Inactivity time-out and automatic away</u></b><br />
		<br />
		There is an inactivity timer built-in to phpBBChatSpot, and the admin on this forum has it set at <b><?php echo ( $chatspot_config[ 'inactive_time' ] / 60 ); ?> minutes</b>.  If you are inactive for that period of time your session will be terminated; this is simply to ensure that the current list of chatters is accurate.  Before that happens if you are inactive for <b><?php echo ( $chatspot_config[ 'auto_away' ] / 60 ); ?> minutes</b> you will be automatically marked as 'away.'<br />
		<br />
		<b><u>Cookies and sessions</u></b><br />
		<br />
		By default phpBBChatSpot uses cookies to help manage sessions and reduce database queries.  If you do not have cookies enabled (or you use Netscape which seems to poorly handle cookies when multiple instances of the same page are using them) then phpChatSpot will compensate for this and append necessary variables to URLs.  Please note, however, that in that case your sessions (i.e. presence in rooms) are independent from one another and if you are inactive in one for too long, you will be removed from that room.<br />
		<br />
		<b><u>General chat issues</u></b><br />
		<br />
		Keep in mind that due to browser compatibility issues, synchronization issues, and latency due to server load phpBBChatSpot will not always work exactly as intended.  If you cannot resolve a recurring issue, please feel free to visit phpBBChatSpot's official support forum:  <a href="http://www.dreamviews.com/chatspot" target="_blank">Dream Views</a>.<br />
		<br />
		</td>
		</tr>
		<tr>
		<td>
		<a href="javascript:void(0);" onClick="javascript:window.parent.scripts.restore_frames(); return false;"><? echo $lang['Return_2_chat']; ?></a>
		</td>
		</tr>
		</table>
		</td>
	</tr>
</table>
</body>
</html>