<?php

/***************************************************************************
 *							message_send.php
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
		- provides an interface for users to send messages; this appears in the bottom frame of phpBBChatSpot
		- basic checking of input and also deploys flood control
		- data from this form is POSTed to message_interpreter.php
	************************************************************************************************************************ */

define( 'CHATSPOT', true );
define( 'IN_PHPBB', true );
$phpbb_root_path = './../';
include_once( $phpbb_root_path . 'extension.inc' );
include_once( $phpbb_root_path . 'chatspot/chatspot_config.' . $phpEx );

if( isset( $HTTP_GET_VARS[ 'room' ] ) )
	$room_id = $HTTP_GET_VARS[ 'room' ];
else
	die( "ERROR:  Cannot determine room id." );
	
if( isset( $HTTP_GET_VARS[ 'sid' ] ) )
	$SID = '&amp;sid=' . $HTTP_GET_VARS[ 'sid' ];
else
	$SID = '';
?>

<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $chatspot_config[ 'charset' ]; ?>">

<link rel="stylesheet" href="<?php echo $chatspot_config[ 'stylesheet' ]?>" type="text/css">

<script language="JavaScript">
<!--
	// hacking check
if( !window.parent.sender )
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

	if( ( parent_location == this_location ) || ( this_location.substring( 0, url_index ) != url_required ) || ( url_index < 0 ) )
	{
		alert( 'HACKING ATTEMPT' );
		document.location = 'http://www.synergyprofessional.com/';
	}
}

var send_time = '';
var invite_time = '';

function check_flood_control()
{
	var cur_time = new Date();
	
	if( send_time == '' )
	{
		send_time = cur_time;
		return false;
	}
	
	if( cur_time.getTime() - send_time.getTime() < <?php echo $chatspot_config[ 'flood_time' ] * 1000; ?> )
		return true;

	send_time = cur_time;	
	return false;
}

function check_invite( user_input )
{
	if( user_input.toLowerCase().indexOf( "/invite" ) == -1 )
		return false;

	var cur_time = new Date();

	if( invite_time == '' )
	{
		invite_time = cur_time;
		return false;
	}
	
	if( cur_time.getTime() - invite_time.getTime() < <?php echo $chatspot_config[ 'invite_time' ] * 1000; ?> )
		return true;

	invite_time = cur_time;	
	return false;
}

function set_colour( colour )
{
	document.post.color.value = colour;
	document.post.colour_selected.style.background = "#" + colour;
	window.parent.scripts.reset_focus();
}

function clear_form()
{
	document.post.message.value = "";
	document.post.sent.value = "";
	
	window.parent.scripts.reset_focus();
}

function submit_msg()
{
	if( window.parent.scripts.is_session_expired() )
	{
		clear_form();
		return false;
	}
		
	if( check_flood_control() )
	{
		clear_form();
		alert( '<?php echo sprintf($lang['Command_ignored'],$chatspot_config[ 'flood_time' ]); ?>' );
		return false;
	}
	
	if( window.parent.scripts.is_user_kicked() )
	{
		clear_form();
		alert( "<?php echo $lang['Kicked_you']; ?>" );
		return false;
	}

	if( !window.parent.scripts.did_page_load() )
	{
		clear_form();
		alert( "<?php echo $lang['Loading_error']; ?>" );
		return false;
	}
	
	if( check_invite( "" + document.post.message.value ) )
	{
		clear_form();
		alert( '<?php echo sprintf($lang['Invite_Flood'],$chatspot_config[ 'invite_time' ]); ?>' );
		return false
	}

	if( ( "" + document.post.message.value ) == "" )
	{
		clear_form();
		return false;
	}

	document.post.sent.value = document.post.message.value;
	document.post.message.value = "";

	window.parent.scripts.reset_focus();
	return true;
}
// -->
</script>

</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" link="#006699" onLoad="javascript:set_colour( '000000' ); return false;">

<form name="post" action="<?php echo 'message_interpreter.' . $phpEx . '?room=' . $room_id . $SID; ?>" target="message_interpret" method="POST" autocomplete=off onsubmit="return submit_msg()">

<input type="hidden" name="color" value="000000">
<input type="hidden" name="sent" value="">

<table class="formarea" width="100%">
	<tr>
		<td><table class="formarea" width="100%">
	<tr height="23" valign="middle">
	<td align="left"><a href="javascript:void(0);" onClick="window.open('../posting.php?mode=smilies', '_chatspotsmilies', 'HEIGHT=300,resizable=yes,scrollbars=yes,WIDTH=275');"><?php echo $lang['Smilies']; ?></a></td>
	<td align="right">
		<table cellspacing="0" cellpadding="0" border="0">
			<tr height="18" valign="middle">
				<td align="left">
					<table cellspacing="0" cellpadding="0" border="1">
						<tr height="18" valign="middle">
<?php

// the colour code is courtesy X7 Chat, and has been modified slightly

$printcolors = "";
$r = 240; $g = 0; $b = 0; $k = 1; $last = FALSE;

while( $k != 0 )
{
	if( $r == 240 && $b == 0 )
		$g += 20;
	
	if( $g == 240 && $b == 0 )
		$r -= 20;

	if( $r == 0 && $g == 240 )
		$b += 20;

	if( $b == 240 && $r == 0 )
		$g -= 20;
	
	if( $g == 0 && $b == 240 )
		$r += 20;

	if( $r == 240 && $g == 0 )
	{
		$b -= 20;
		$last = TRUE;
	}
	
	if( $r == 240 && $g == 0 && $b == 0 && $last )
		$k = 0;

	$rh = dechex( $r );
	if( strlen( $rh ) < 2 )
		$rh = "0" . $rh;

	$gh = dechex( $g );
	if( strlen( $gh ) < 2 )
		$gh = "0" . $gh;

	$bh = dechex( $b );
	if( strlen( $bh ) < 2 )
		$bh = "0" . $bh;

	$value = $rh . $gh . $bh;
	
	$printcolors .= "<td bgcolor=\"#$value\" width=\"1\" onClick=\"javascript:set_colour('$value'); return false;\"><img src=\"spacer.gif\" height=\"1\" width=\"1\"></td>";
}

$printcolors .= "<td bgcolor=\"#EEEEEE\" width=\"1\" onClick=\"javascript:set_colour('EEEEEE'); return false;\"><img src=\"spacer.gif\" height=\"1\" width=\"1\"></td>";
$printcolors .= "<td bgcolor=\"#000000\" width=\"1\" onClick=\"javascript:set_colour('000000'); return false;\"><img src=\"spacer.gif\" height=\"1\" width=\"1\"></td>";

echo $printcolors;
?>
						</tr>
					</table>
				</td>
				<td>&nbsp;&nbsp;&nbsp;</td>
				<td><input type="text" name="colour_selected" size="1" readonly="true" class="colourbox"></td>
				<td>&nbsp;&nbsp;&nbsp;</td>
				<td align="right"><input type="text" name="message" size="35" maxlength="<?php echo $chatspot_config['max_msg_len']; ?>" value="" onFocus="" class="editbox"></td><td align="right">&nbsp;</td><td align="right"><input type="submit" name="submit_button" value="Send" class="button"></td>
			</tr>
			</table>
		</td>
	</tr>
</table></td></tr>
</table>
</form>

</body>
</html>
