<?php

/***************************************************************************
 *							chatspot_title.php
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
		- displays all the available links at the top of phpBBChatSpot
		- displays name of chat & current room
		- provides link to room management for admins
	************************************************************************************************************************ */

define( 'CHATSPOT', true );
define( 'IN_PHPBB', true );
$phpbb_root_path = './../';
include_once( $phpbb_root_path . 'extension.inc' );
include_once( $phpbb_root_path . 'chatspot/chatspot_config.' . $phpEx );

if( isset( $_GET[ 'room_name' ] ) )
	$room_name = $_GET[ 'room_name' ];
else
	exit();
	
// this can't be hacked simply by manually entering &admin=1 to the URL because the room management page checks to
// see if the user is really an admin or not; the admin variable is only used to show the link to that page.
if( isset( $_GET[ 'admin' ] ) )
	$is_admin = TRUE;
else
	$is_admin = FALSE;
	
if( isset( $_GET[ 'sid' ] ) )
	$SID = '?sid=' . $_GET[ 'sid' ];
else
	$SID = '';
?>

<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $chatspot_config[ 'charset' ]; ?>">

<link rel="stylesheet" href="<?php echo $chatspot_config['stylesheet']?>" type="text/css">

</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" link="#006699">

<table class="formarea" width="100%">
	<tr>
		<td>
		<table class="formarea" width="100%">
		<tr>
		<td align="left" nowrap><?php echo $cfg_chatname; ?>&nbsp;&nbsp;<b>[<?php echo $room_name; ?>]</b></td>
		<td align="right"><a href="javascript:void(0);" onClick="javascript:window.parent.scripts.restore_frames(); return false;"><?php echo $lang['Refresh_Chat']?></a>&nbsp;|&nbsp;<a href="javascript:void(0);" onClick="javascript:window.parent.scripts.clear_frames(); window.parent.message_view.location='chatspot_help.<?php echo $phpEx; ?>'; return false;"><?php echo $lang['Help']; ?></a>&nbsp;|&nbsp;<a href="javascript:void(0);" onClick="javascript:window.parent.scripts.clear_frames(); window.parent.message_view.location='chatspot_about.<?php echo $phpEx; ?>'; return false;"><?php echo $lang['About']; ?></a>&nbsp;<?php if( $is_admin ) echo '|&nbsp;<a href="javascript:void(0);" style="color:red;" onClick="javascript:window.parent.scripts.clear_frames(); window.parent.message_view.location=\'chatspot_rooms.' .$phpEx . $SID . '\'; return false;">Rooms</a>&nbsp;'; ?>|&nbsp;<a href="javascript:void(0);" style="color:red;" onClick="javascript:window.parent.scripts.shut_down(); window.parent.scripts.clear_frames(); javascript:window.parent.scripts.leave_room(); return false;"><b>[<?php echo $lang['Close']; ?>]</b></a></td>
		</tr>
		</table>
		</td>
	</tr>
</table>
</body>
</html>
