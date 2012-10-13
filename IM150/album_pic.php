<?php
/***************************************************************************
*                               album_pic.php
*                            -------------------
*   begin                : Wednesday, February 05, 2003
*   copyright            : (C) 2003 Smartor
*   email                : smartor_xp@hotmail.com
*
*   $Id: album_pic.php,v 2.0.5 2003/02/28 14:33:12 ngoctu Exp $
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

  /***************************************************************************
 *                            MODIFICATIONS
 *                           ---------------
 *   started            : Saturday, January 18, 2004
 *   copyright          : © Volodymyr (CLowN) Skoryk
 *   email              : blaatimmy72@yahoo.com
 *	 version            : 1.5
 *
 *	 MODIFICATIONS:
 *		-added watermark support
 *
 *
 ***************************************************************************/

define('IN_PHPBB', true);
$phpbb_root_path = './';
$album_root_path = $phpbb_root_path . 'album_mod/';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.' . $phpEx);

include($album_root_path . 'album_watermark.' . $phpEx);

// Start session management
$userdata = session_pagestart($user_ip, PAGE_ALBUM);
init_userprefs($userdata);
// End session management


// Get general album information
include($album_root_path . 'album_common.' . $phpEx);

// ------------------------------------
// Check the request
// ------------------------------------
if( isset($HTTP_GET_VARS['pic_id']) )
{
	$pic_id = intval($HTTP_GET_VARS['pic_id']);
}
elseif( isset($HTTP_POST_VARS['pic_id']) )
{
	$pic_id = intval($HTTP_POST_VARS['pic_id']);
}
else
{
	message_die(GENERAL_MESSAGE, 'No pics specified');
}


// ------------------------------------
// Get this pic info and current category info
// ------------------------------------
$sql = "SELECT p.*, c.*
		FROM ". ALBUM_TABLE ." AS p, ". ALBUM_CAT_TABLE ." AS c
		WHERE pic_id = '$pic_id'
			AND c.cat_id = p.pic_cat_id";

if( !$result = $db->sql_query($sql) )
{
	message_die(GENERAL_ERROR, 'Could not query pic information', '', __LINE__, __FILE__, $sql);
}

$thispic = $db->sql_fetchrow($result);
$db->sql_freeresult($result);

$cat_id = $thispic['pic_cat_id'];
$album_user_id = $thispic['cat_user_id'];

$pic_filetype = substr($thispic['pic_filename'], strlen($thispic['pic_filename']) - 4, 4);
$pic_filename = $thispic['pic_filename'];
$pic_title = $thispic['pic_title'];
$pic_thumbnail = $thispic['pic_thumbnail'];

if( empty($thispic) || !file_exists(ALBUM_UPLOAD_PATH . $pic_filename) )
{
	message_die(GENERAL_MESSAGE, $lang['Pic_not_exist']);
}


// ------------------------------------
// Check the permissions
// ------------------------------------
$album_user_access = album_permissions($album_user_id, $cat_id, ALBUM_AUTH_VIEW, $thispic);
if( $album_user_access['view'] == 0 )
{
	message_die(GENERAL_MESSAGE, $lang['Not_Authorised']);
}


// ------------------------------------
// Check Pic Approval
// ------------------------------------

if( $userdata['user_level'] != ADMIN )
{
	if( ($thispic['cat_approval'] == ADMIN) || (($thispic['cat_approval'] == MOD) && !$album_user_access['moderator']) )
	{
		if( $thispic['pic_approval'] != 1 )
		{
			message_die(GENERAL_MESSAGE, $lang['Not_Authorised']);
		}
	}
}


// ------------------------------------
// Check hotlink
// ------------------------------------
if( ($album_config['hotlink_prevent'] == 1) && (isset($HTTP_SERVER_VARS['HTTP_REFERER'])) )
{
	$check_referer = explode('?', $HTTP_SERVER_VARS['HTTP_REFERER']);
	$check_referer = trim($check_referer[0]);

	$good_referers = array();

	if ($album_config['hotlink_allowed'] != '')
	{
		$good_referers = explode(',', $album_config['hotlink_allowed']);
	}

	$good_referers[] = $board_config['server_name'] . $board_config['script_path'];

	$errored = true;

	for ($i = 0; $i < count($good_referers); $i++)
	{
		$good_referers[$i] = trim($good_referers[$i]);

		if( (strstr($check_referer, $good_referers[$i])) && ($good_referers[$i] != '') )
		{
			$errored = false;
		}
	}

	if( $errored )
	{
		message_die(GENERAL_MESSAGE, $lang['Not_Authorised']);
	}
}


/*
+----------------------------------------------------------
| Main work here...
+----------------------------------------------------------
*/


// ------------------------------------
// Increase view counter
// ------------------------------------
$sql = "UPDATE ". ALBUM_TABLE ."
		SET pic_view_count = pic_view_count + 1
		WHERE pic_id = '$pic_id'";
if( !$result = $db->sql_query($sql) )
{
	message_die(GENERAL_ERROR, 'Could not update pic information', '', __LINE__, __FILE__, $sql);
}


// ------------------------------------
// Okay, now we can send image to the browser
// ------------------------------------
switch( $pic_filetype )
{
	case '.png':
		header('Content-type: image/png');
		header("Content-Disposition: filename=" . ereg_replace("[^A-Za-z0-9]", "_", $pic_title) . $pic_filetype);
		break;

	case '.gif':
		header('Content-type: image/gif');
		header("Content-Disposition: filename=" . ereg_replace("[^A-Za-z0-9]", "_", $pic_title) . $pic_filetype);
		break;

	case '.jpg':
		header('Content-type: image/jpeg');
		header("Content-Disposition: filename=" . ereg_replace("[^A-Za-z0-9]", "_", $pic_title) . $pic_filetype);
		break;

	default:
		message_die(GENERAL_MESSAGE, 'The filename data in the DB was corrupted');
}


// --------------------------------------------------------
// Okay, now we insert the watermark for unregistered users
// --------------------------------------------------------
if( ($pic_filetype != '.gif') && ($album_config['use_watermark'] == 1) && ($userdata['user_level'] != ADMIN) &&
	( (!$userdata['session_logged_in']) || ($album_config['wut_users'] == 1)) )
{
	$wm_sourcefile = ALBUM_UPLOAD_PATH . $pic_filename;
	$wm_insertfile = ALBUM_WM_FILE;
	$wm_position  = $album_config['disp_watermark_at'];
	$wm_transition = 50;
	mergePics($wm_sourcefile, $wm_insertfile, $wm_position, $wm_transition, $pic_filetype);
}
else
{
	readfile(ALBUM_UPLOAD_PATH . $pic_filename);
}
//exit;


// +-------------------------------------------------------------+
// |  Powered by Photo Album 2.x.x (c) 2002-2003 Smartor         |
// |  with Volodymyr (CLowN) Skoryk's Service Pack 1 © 2003-2004 |
// +-------------------------------------------------------------+

?> 