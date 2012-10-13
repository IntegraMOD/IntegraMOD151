<?php
/***************************************************************************
*                               album_pic_nuffed.php
*                            -------------------
*   begin                : 2005/11/10
*   copyright            : Mighty Gorgon
*   email                : mightygorgon@mightygorgon.com
*
*   $Id: album_pic_nuffed.php, v 1.0.0 2005/11/10
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

define('IN_PHPBB', true);
$phpbb_root_path = './';
$album_root_path = $phpbb_root_path . 'album_mod/';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.' . $phpEx);
require($album_root_path . 'album_nuffimage.' . $phpEx);

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

$nuff_http = nuff_http_vars();

$Image = new NuffImage();
$Image->ReadSourceFile(ALBUM_UPLOAD_PATH . $pic_filename);

if( (($nuff_http['nuff_sepia'] == 1) || ($nuff_http['nuff_bw'] == 1) || ($nuff_http['nuff_blur'] == 1) || ($nuff_http['nuff_scatter'] == 1)) && ($album_config['enable_sepia_bw'] == 1) )
{

	( ($nuff_http['nuff_resize_w'] == 0) || ($nuff_http['nuff_resize_w'] > 200) ) ? ($nuff_http['nuff_resize_w'] = 200) : false;
	( ($nuff_http['nuff_resize_h'] == 0) || ($nuff_http['nuff_resize_h'] > 150) ) ? ($nuff_http['nuff_resize_h'] = 150) : false;

	$Image->Resize($nuff_http['nuff_resize_w'], $nuff_http['nuff_resize_h']);

	//Apply sepia filter (best to resize before this)
	($nuff_http['nuff_sepia'] == 1) ? $Image->Sepia() : false ;

	//Apply grayscale filter (best to resize before this)
	($nuff_http['nuff_bw'] == 1) ? $Image->Grayscale() : false;

	//Apply blur filter (best to resize before this)
	($nuff_http['nuff_blur'] == 1) ? $Image->Blur(10, 10) : false;

	//Apply scatter filter (best to resize before this)
	($nuff_http['nuff_scatter'] == 1) ? $Image->Scatter(3) : false;

}
else
{
	if ($nuff_http['nuff_resize'] == 1)
	{
		$Image->Resize($nuff_http['nuff_resize_w'], $nuff_http['nuff_resize_h']);
	}
}

//Apply pixelate filter
($nuff_http['nuff_pixelate'] == 1) ? $Image->Pixelate(4) : false;

//Apply stereogram (best to resize before this)
($nuff_http['nuff_stereogram'] == 1) ? $Image->Stereogram(1) : false;

//Apply infrared filter
($nuff_http['nuff_infrared'] == 1) ? $Image->Infrared() : false;

//Apply tint filter
($nuff_http['nuff_tint'] == 1) ? $Image->Tint(160, 0, 0) : false;

//Apply interlace filter
($nuff_http['nuff_interlace'] == 1) ? $Image->Interlace() : false;

//Apply screen filter
($nuff_http['nuff_screen'] == 1) ? $Image->Screen() : false;

//Mirror image [1=horizontal, 2=vertical, 3=both]
($nuff_http['nuff_mirror'] == 1) ? $Image->Flip(1) : false;

//Flip image [1=horizontal, 2=vertical, 3=both]
($nuff_http['nuff_flip'] == 1) ? $Image->Flip(2) : false;

//Rotate anti-clockwise degrees (transparency lost)
if( $nuff_http['nuff_rotation_d'] > 0 )
{
	($nuff_http['nuff_rotation'] == 1) ? $Image->Rotate($nuff_http['nuff_rotation_d']) : false;
}

//WatermarkPos(file, Pos, Size)
if( ($pic_filetype != '.gif') && ($album_config['use_watermark'] == 1) && ($userdata['user_level'] != ADMIN) &&
	( (!$userdata['session_logged_in']) || ($album_config['wut_users'] == 1)) )
{
	$wm_insertfile = ALBUM_WM_FILE;
	$wm_position  = ( ($album_config['disp_watermark_at'] > 0) && ($album_config['disp_watermark_at'] < 10) ) ? $album_config['disp_watermark_at'] : 5;
	$wm_transition = 50;
	$Image->WatermarkPos($wm_insertfile, $wm_position, 50);
}

//$Image->SendToFile("cache/test2"); //Write image to file

//JPG Compression
( ($nuff_http['nuff_recompress'] == 0) || ($nuff_http['nuff_recompress_r'] = 0) ) ? ($nuff_http['nuff_recompress_r'] = 75) : false;

$Image->SendToBrowser($pic_title, $pic_filetype, '', '_nuffed', $nuff_http['nuff_recompress_r']);
$Image->Destroy(); //Destroy whole class including GD image in memory.


?> 