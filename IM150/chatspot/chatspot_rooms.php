<?php

/***************************************************************************
 *							chatspot_rooms.php
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
		- provides a graphic user interface for admins to manage permanent rooms
		- data from here is POSTed to room_manager.php
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

if( isset( $HTTP_GET_VARS[ 'sid' ] ) )
	$SID = '?sid=' . $HTTP_GET_VARS[ 'sid' ];
else
	$SID = '';

// build list of groups
$sql = "SELECT group_id, group_name 
	FROM " . GROUPS_TABLE . " g 
	WHERE group_single_user <> " . TRUE . " 
	ORDER BY g.group_name";

if( !( $result = $db->sql_query( $sql ) ) )
	die( 'SQL Error: Unable to retrieve group information.' );

$groups = array();

$group_string = '<option value="0" onChange="">'.$lang['None'].'</option>';

for( $i = 0; $row = $db->sql_fetchrow( $result ); $i++ )
{
	$groups[ $i ][ 'group_id' ] = $row[ 'group_id' ];
	$groups[ $i ][ 'group_name' ] = $row[ 'group_name' ];
	
	$group_string .= '<option value="' . $row[ 'group_id' ] . '" onChange="">' . $row[ 'group_name' ] . '</option>';
}

$db->sql_freeresult( $result );	
?>

<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $chatspot_config[ 'charset' ]; ?>">

<link rel="stylesheet" href="<?php echo $chatspot_config['stylesheet']?>" type="text/css">

<script language="JavaScript">
<!--

function get_group_id( access_index )
{
	if( access_index != 0 )
	{
		<?php
		
		for( $i = 0; !empty( $groups[ $i ] ); $i++ )
		{
			echo "if( ( access_index - 1 ) == $i )";
			echo "return " . $groups[ $i ][ 'group_id' ] . ";\n";
		}
		?>
	}
	
	return 0;
}

function check_params( room_name, room_password )
{
	if( room_name == "" )
	{
		alert( "<?php echo $lang['Enter_room_name']; ?>" );
		return false;
	}

	if( room_name.indexOf( ' ' ) != -1 )
	{
		alert( "<?php echo $lang['Room_name_error']; ?>" );
		return false;
	}

	if( room_password.indexOf( ' ' ) != -1 )
	{
		alert( "<?php echo $lang['Password_error']; ?>" );
		return false;
	}
	
	return true;	
}

function room_manager( room_id, room_name, room_password, room_access )
{
	var build_URL = 'room_manager.<?php echo $phpEx; ?>?room_id=' + room_id + '&room_name=' + room_name + '&password=' + 
		room_password + '&access=' + room_access;

	window.parent.message_view.location = build_URL;
}

function create_room()
{
	var room_name = document.post.room_name_new.value;
	var room_password = document.post.password_new.value;
	
	if( !check_params( room_name, room_password ) )
		return;

	var room_access = get_group_id( document.post.access_new.selectedIndex );
	
	room_manager( -1, room_name, room_password, room_access );
}

function delete_room( room_id )
{
	room_manager( room_id, '', '', 0 );	
}

function update_room( room_id, room_name, room_password, access_index )
{
	var room_access = get_group_id( access_index );

	if( !check_params( room_name, room_password ) )
		return;

	room_manager( room_id, room_name, room_password, room_access );
}
// -->
</script>

</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" link="#006699">

<table class="formarea" width="100%" height="100%">
	<tr>
		<td>
			<table class="formarea" width="100%" height="100%">
				<tr>
					<td>
						<table class="formarea" width="100%" height="100%">
							<tr><th>phpBBChatSpot - <? echo $lang['Room_management']; ?></th></tr>
						</table>
					</td>
				</tr>
				<tr height="100%">
					<td align="left" valign="top">
		<? echo $lang['Permanent_rooms']; ?>
		<center><form name="post" action="" target="" method="POST" onsubmit="">

			<table cellspacing="0" cellpadding="5" width="90%" border="0">
				<tr><td align="center" class="table0"><b><? echo $lang['Room_Name']; ?></b></td><td align="center" class="table1"><b><? echo $lang['Password']; ?></b></td><td align="center" class="table0"><b><? $lang['Group_access']; ?></b></td><td align="center" class="table1"><b><? echo $lang['Control']; ?></b></td></tr>
<?php

$sql = "SELECT room_name, room_id, room_password, room_access FROM $table_chatspot_rooms_name 
	WHERE
		room_type = '1' 
		ORDER BY room_id ASC";
		
if( !( $result = $db->sql_query( $sql ) ) )
	die( 'Unable to retrieve room information.' );

while( $row = $db->sql_fetchrow( $result ) )
{
	$room_id = $row[ 'room_id' ];
	
	$pos_marker = strpos( $group_string, 'value="' . $row[ 'room_access' ] . '"' );

	$string_begin = substr( $group_string, 0, $pos_marker );
	
	$this_group_string = $string_begin . 'selected ' . substr( $group_string, $pos_marker );

	echo '<tr><td class="table0" align="center"><input type="text" name="room_name_' . $room_id . '" size="15" maxlength="20" value="' . $row[ 'room_name' ] . '" onFocus="" class="roommanage"></td>' . "\n" .
				'<td class="table1" align="center"><input type="text" name="password_' . $room_id . '" size="15" maxlength="20" value="' . $row[ 'room_password' ] . '" onFocus="" class="roommanage"></td>' . "\n" .
				'<td class="table0" align="center"><select name="access_' . $room_id . '" class="drop_down">' . $this_group_string . '</select></td>' . "\n" .
				'<td class="table1" align="center"><button name="update_' . $room_id . '" type="button" onClick="javascript:update_room(' . $room_id . ', document.post.room_name_' . $room_id . '.value, document.post.password_' . $room_id . '.value, document.post.access_' . $room_id . '.selectedIndex ); return false;" class="button">'.$lang['Update'].'</button>';

	if( $room_id != $chatspot_config[ 'default_room_id' ] )
		echo '<br /><br /><button name="delete_' . $room_id . '" type="button" onClick="javascript:delete_room(' . $room_id . '); return false;" class="button">'.$lang['Delete'].'</button></td></tr>' . "\n";
}

$db->sql_freeresult( $result );

?>
<tr><td class="table0" align="center"><input type="text" name="room_name_new" size="15" maxlength="20" value="" onFocus="" class="roommanage"></td>
				<td class="table1" align="center"><input type="text" name="password_new" size="15" maxlength="20" value="" onFocus="" class="roommanage"></td>
				<td class="table0" align="center"><select name="access_new" class="drop_down"><?php echo $group_string; ?></select></td>
				<td class="table1" align="center"><button name="create_new" type="button" onClick="javascript:create_room(); return false;" class="button"><? echo $lang['Create']; ?></button></td></tr>

		</table></form></center></td>
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