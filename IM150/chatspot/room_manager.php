<?php

/***************************************************************************
 *							room_manager.php
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
		- handles the room management data sent from chatspot_rooms; simply updates, creates, or deletes rooms.
	************************************************************************************************************************ */

define( 'CHATSPOT', true );
define( 'IN_PHPBB', true );
$phpbb_root_path = './../';
include_once( $phpbb_root_path . 'extension.inc' );
include_once( $phpbb_root_path . 'chatspot/chatspot_config.' . $phpEx );

// Check User Session
if( !$userdata[ 'session_logged_in' ] )
	exit();

if( $userdata[ 'user_level' ] != ADMIN )
{
	echo '<html><head></head><body>'.$lang['Access_denied'].'</body></html>';
	exit();
}

if( isset( $_GET[ 'sid' ] ) )
	$SID = '?sid=' . $_GET[ 'sid' ];
else
	$SID = '';

if( !isset( $_GET[ 'room_id' ] ) || !isset( $_GET[ 'room_name' ] ) || !isset( $_GET[ 'password' ] ) ||
	!isset( $_GET[ 'access' ] ) )
	die( 'Not all parameters present.' );
else
{
	$room_id = $_GET[ 'room_id' ];
	$room_name = $_GET[ 'room_name' ];
	$password = $_GET[ 'password' ];
	$group_id = $_GET[ 'access' ];
}
?>

<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $lang['ENCODING']; ?>">

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
							<tr><th>phpBBChatSpot - <?php echo $lang['Room_management_response']; ?></th></tr>
						</table>
					</td>
				</tr>
				<tr height="100%">
					<td align="left" valign="top">
					
<?php
	$error = FALSE;
	
	if( $room_id > -1 && empty( $room_name ) ) // delete room
	{
		$sql = "DELETE FROM $table_chatspot_rooms_name 
			WHERE
				room_id = '$room_id'";

		if( !( $result = $db->sql_query( $sql ) ) )
			echo $lang['Room_delete_error'];
		else
			echo $lang['Room_delete_success'];				
	}
	else
	{
		if( !is_room_name_okay( $room_name ) || $room_name == '' )
		{
			$error = TRUE;
			echo $lang['Room_name_error'];
		}

		if( !is_room_name_okay( $password ) )
		{
			$error = TRUE;
			echo $lang['Password_error'];
		}

		if( !$error )
		{
			if( $room_id == -1 ) // create
			{
				if( get_room_id( $room_name ) != -1 )
					echo $lang['Room_exists'];
				else
				{					
					if( create_room( $room_name, $password, 0, 1, $group_id ) > 0 )
					{
						echo $lang['Room_create_success'];
						write_msg( 7, -1, _CHATSPOT_SYSTEM_MSG, sprintf($lang['User_created_room'],$userdata[ 'username' ],$room_name));
					}
					else
						echo $lang['Room_create_error'];
				}
			}
			else // update
			{
				$sql = "UPDATE $table_chatspot_rooms_name 
					SET
						room_name = '$room_name', 
						room_password = '$password', 
						room_access = '$group_id' 
					WHERE
						room_id = '$room_id'";
					
				if( !( $result = $db->sql_query( $sql ) ) )
					echo $lang['Room_update_error'];
				else
					echo $lang['Room_update_success'];				
			}		
		}
	}
?>
					
		</td></tr>
		<tr>
		<td>
		
		<a href="javascript:void(0);" onClick="javascript:window.parent.message_view.location='chatspot_rooms.<?php echo $phpEx . $SID; ?>'; return false;"><?php echo $lang['Return_2_management'] ?></a>
		</td>
		</tr>
		</table>
		</td>
	</tr>
</table>
</body>
</html>