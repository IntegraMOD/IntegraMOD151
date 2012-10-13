<?php

/***************************************************************************
 *							chatspot_about.php
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
		- displays information regarding phpBBChatSpot's creation
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
							<tr><th>phpBBChatSpot - About</th></tr>
						</table>
					</td>
				</tr>
				<tr height="100%">
					<td align="left">
		<b><u>phpBBChatSpot v1.0.0</u></b><br />
		<br />
		(c) 2004 Project Dream Views
		<br />
		<br />Created by icedawg; August 28, 2004.  Official support forum can be found here:  <a href="http://www.dreamviews.com/chatspot/" target="_blank">Dream Views</a>.<br />
		<br />
		<b><u>What is phpBBChatSpot?</u></b><br />
		<br />
		phpBBChatSpot is a multi-room chat system that combines a number of technologies, including PHP, JavaScript, and DHTML.  It was built upon the original ChatBox foundation created by Smartor and maintained by Wooly Spud; their website can be found <a href="http://smartor.is-root.com/index.php">here</a>.  The original ChatBox was designed to be integrated with the phpBB bulletin board system which was created by the <a href="http://www.phpbb.com" target="_blank">phpBB</a> Group.<br />
		<br />
		<b><u>Improvements over ChatBox v3.0.2</u></b><br />
		<br />
		<ul>
			<li>Almost completely rewritten.</li>
			<li>Added support for simultaneous multiple rooms, including password-protected rooms and membership-only rooms.  Admins can create and modify permanent rooms (via a provided room management screen) and users can create their own temporary rooms.</li>
			<li>The display of messages and online users has been completely redone to allow a smooth, flicker-free update of new messages; the annoying 'click' sound in Internet Explorer has also been suppressed during automatic refreshes.</li>
			<li>Bandwidth is now conserved with phpBBChatSpot because only <i>new</i> messages are sent to the clients, whereas ChatBox used to send all messages over-and-over.</li>
			<li>The online user display list now only updates itself every 5 minutes (like phpBB's) or after a user joins or leaves; this saves bandwidth as well (and prevents repeated-flickering in Mozilla Firefox); chat messages are updated every 5 seconds by default.</li>
			<li>Private messaging now exists.</li>
			<li>Session management has been completely redone.  If enabled, phpBBChatSpot will compare its online list with the forum's to ensure all displayed sessions are active.  Expired sessions are hidden and only purged upon joining a room, to reduce unnecessary database queries.</li>
			<li>Expired sessions are no longer deleted via users who are browsing the forum; this saves queries and prevents delays.</li>
			<li>The colour selection mechanism is now graphical.</li>
			<li>Flood control was added.</li>
			<li>BBCode support was added.</li>
			<li>URLs and email addresses are now automatically parsed.</li>
			<li>The following commands were added:  <b>away</b>, <b>invite</b>, <b>join</b>, <b>kill</b>, <b>leave</b>, <b>mass</b>, <b>me</b>, <b>names</b>, <b>password</b>, <b>pm</b>, <b>purge</b>, <b>refresh</b>.</li>
			<li>The following commands were rewritten:  <b>clear</b>, <b>kick</b>.</li>
			<li>Moderators now have permission to perform some tasks that only Administrators could do before.</li>
			<li>Some data is now stored in cookies to reduce database queries; if the user has cookies disabled phpBBChatSpot will compensate for this transparently.</li>
			<li>Security precautions have been added.</li>
			<li>Some synchronization issues addressed, including having user's own messages immediately displayed upon being sent to prevent collision during refresh.</li>
			<li>Now completely supports users with pop-up blockers (via the <b>[CLOSE]</b> link, the <b>leave</b> command, and a link that will be displayed upon attempting to join rooms).</li>
			<li>Now has the capability to use multiple database user accounts to ensure that query quotas are not exceeded (and are separate from the forum).</li>
			<li>Should now be completely compatible with Internet Explorer, Netscape, Mozilla Firefox, and Opera; it is very likely to be compatible with other new browsers as well, but so far it has only been officially tested in those four.</li>
			<li>Additional minor changes made throughout, including HTML tag errors corrected.</li>
		</ul>
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