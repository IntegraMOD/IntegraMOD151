<?php
/***************************************************************************
 *                            album_thumbnail.php
 *                            -------------------
 *   begin                : Wednesday, February 05, 2003
 *   copyright            : (C) 2003 Smartor
 *   email                : smartor_xp@hotmail.com
 *
 *   $Id: album_thumbnail.php,v 2.0.6 2003/03/02 13:44:46 ngoctu Exp $
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
include($phpbb_root_path . 'common.'.$phpEx);

// Start session management
$userdata = session_pagestart($user_ip, PAGE_ALBUM);
init_userprefs($userdata);
// End session management

// Get general album information
include($album_root_path . 'album_common.'.$phpEx);

// ------------------------------------
// Check the request
// ------------------------------------

if( isset($_GET['pic_id']) )
{
	$pic_id = intval($_GET['pic_id']);
}
elseif( isset($_POST['pic_id']) )
{
	$pic_id = intval($_POST['pic_id']);
}
else
{
	die('No pics specified');
}

// ------------------------------------
// Get this pic info and current category info
// ------------------------------------

$sql = "SELECT p.*, c.*
		FROM ". ALBUM_TABLE ." AS p, ". ALBUM_CAT_TABLE ." AS c
		WHERE pic_id = '$pic_id'
			AND c.cat_id = p.pic_cat_id";
			
if( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not query pic information', '', __LINE__, __FILE__, $sql);
}

$thispic = $db->sql_fetchrow($result);

$cat_id = $thispic['pic_cat_id'];
$album_user_id = $thispic['cat_user_id'];

$pic_filetype = substr($thispic['pic_filename'], strlen($thispic['pic_filename']) - 4, 4);
$pic_filename = $thispic['pic_filename'];
$pic_thumbnail = $thispic['pic_thumbnail'];

if( empty($thispic) || !file_exists(ALBUM_UPLOAD_PATH . $pic_filename) )
{
	message_die(GENERAL_ERROR, $lang['Pic_not_exist']);
}

// ------------------------------------
// Check the permissions
// ------------------------------------
$album_user_access = album_permissions($album_user_id, $cat_id, ALBUM_AUTH_VIEW, $thispic);

if ($album_user_access['view'] == 0)
{
	message_die(GENERAL_ERROR, $lang['Not_Authorised']);
}


// ------------------------------------
// Check Pic Approval
// ------------------------------------

if ($userdata['user_level'] != ADMIN)
{
	if( ($thispic['cat_approval'] == ADMIN) || (($thispic['cat_approval'] == MOD) && !$album_user_access['moderator']) )
	{
		if ($thispic['pic_approval'] != 1)
		{
			message_die(GENERAL_ERROR, $lang['Not_Authorised']);
		}
	}
}

// ------------------------------------
// Check hotlink
// ------------------------------------

if( ($album_config['hotlink_prevent'] == 1) && (isset($_SERVER['HTTP_REFERER'])) )
{
	$check_referer = explode('?', $_SERVER['HTTP_REFERER']);
	$check_referer = trim($check_referer[0]);

	$good_referers = array();

	if ($album_config['hotlink_allowed'] != '')
	{
		$good_referers = explode(',', $album_config['hotlink_allowed']);
	}

	$good_referers[] = $board_config['server_name'] . $board_config['script_path'];

	$errored = TRUE;

	for ($i = 0; $i < count($good_referers); $i++)
	{
		$good_referers[$i] = trim($good_referers[$i]);

		if( (strstr($check_referer, $good_referers[$i])) && ($good_referers[$i] != '') )
		{
			$errored = FALSE;
		}
	}

	if ($errored)
	{
		message_die(GENERAL_ERROR, $lang['Not_Authorised']);
	}
}

/*
+----------------------------------------------------------
| Main work here...
+----------------------------------------------------------
*/

// ------------------------------------
// Send Thumbnail to browser
// ------------------------------------

if( ($pic_filetype != '.jpg') && ($pic_filetype != '.png') && ($pic_filetype != '.gif'))
{
	// --------------------------------
	// GD does not support GIF so we must SEND a premade No-thumbnail pic then EXIT
	// --------------------------------
	if ($album_config['show_img_no_gd'] == 1)
	{
		header('Content-type: image/gif');
		header("Content-Disposition: filename=thumb_" . ereg_replace("[^A-Za-z0-9]", "_", $thispic['pic_title']) . $pic_filetype);
		readfile(ALBUM_UPLOAD_PATH . $pic_filename);
		exit;
	}
	else
	{
		header('Content-type: image/jpeg');
		header("Content-Disposition: filename=thumb_" . ereg_replace("[^A-Za-z0-9]", "_", $thispic['pic_title']) . $pic_filetype);
		readfile($images['no_thumbnail']);
		exit;
	}
}
else
{
	// --------------------------------
	// Check thumbnail cache. If cache is available we will SEND & EXIT
	// --------------------------------

	if( ($album_config['thumbnail_cache'] == 1) && ($pic_thumbnail != '') && file_exists(ALBUM_CACHE_PATH . $pic_thumbnail) )
	{
		switch ($pic_filetype)
		{
			case '.gif':
			case '.jpg':
				header('Content-type: image/jpeg');
				header("Content-Disposition: filename=thumb_" . ereg_replace("[^A-Za-z0-9]", "_", $thispic['pic_title']) . $pic_filetype);
				break;
			case '.png':
				header('Content-type: image/png');
				header("Content-Disposition: filename=thumb_" . ereg_replace("[^A-Za-z0-9]", "_", $thispic['pic_title']) . $pic_filetype);
				break;
		}

		readfile(ALBUM_CACHE_PATH . $pic_thumbnail);
		exit;
	}


	// --------------------------------
	// Hmm, cache is empty. Try to re-generate!
	// --------------------------------

	$pic_size = @getimagesize(ALBUM_UPLOAD_PATH . $pic_filename);
	$pic_width = $pic_size[0];
	$pic_height = $pic_size[1];

	$gd_errored = FALSE;
	switch ($pic_filetype)
	{
		case '.gif':
			$read_function = 'imagecreatefromgif';
			$pic_filetype = '.jpg';
			break;
		case '.jpg':
			$read_function = 'imagecreatefromjpeg';
			break;
		case '.png':
			$read_function = 'imagecreatefrompng';
			break;
	}

	$src = @$read_function(ALBUM_UPLOAD_PATH  . $pic_filename);

	if (!$src)
	{
		$gd_errored = TRUE;
		$pic_thumbnail = '';
	}
	elseif( ($pic_width > $album_config['thumbnail_size']) || ($pic_height > $album_config['thumbnail_size']) )
	{
		// ----------------------------
		// Resize it
		// ----------------------------

		if ($pic_width > $pic_height)
		{
			$thumbnail_width = $album_config['thumbnail_size'];
			$thumbnail_height = $album_config['thumbnail_size'] * ($pic_height/$pic_width);
		}
		else
		{
			$thumbnail_height = $album_config['thumbnail_size'];
			$thumbnail_width = $album_config['thumbnail_size'] * ($pic_width/$pic_height);
		}

		if( $album_config['show_pic_size_on_thumb'] == 1)
		{
			$thumbnail = ($album_config['gd_version'] == 1) ? @imagecreate($thumbnail_width, $thumbnail_height + 16) : @imagecreatetruecolor($thumbnail_width, $thumbnail_height + 16);
		}
		else
		{
			$thumbnail = ($album_config['gd_version'] == 1) ? @imagecreate($thumbnail_width, $thumbnail_height) : @imagecreatetruecolor($thumbnail_width, $thumbnail_height);
		}

		$resize_function = ($album_config['gd_version'] == 1) ? 'imagecopyresized' : 'imagecopyresampled';

		@$resize_function($thumbnail, $src, 0, 0, 0, 0, $thumbnail_width, $thumbnail_height, $pic_width, $pic_height);

		if( $album_config['show_pic_size_on_thumb'] == 1)
		{
			$dimension_font = 1;
			$dimension_filesize = filesize(ALBUM_UPLOAD_PATH . $pic_filename);
			$dimension_string = intval($pic_width) . "x" . intval($pic_height) . "(" . intval($dimension_filesize/1024) . "KB)";
			$dimension_colour = ImageColorAllocate($thumbnail,255,255,255);
			$dimension_height = imagefontheight($dimension_font);
			$dimension_width = imagefontwidth($dimension_font) * strlen($dimension_string);
			$dimension_x = ($thumbnail_width - $dimension_width) / 2;
			$dimension_y = $thumbnail_height + ((16 - $dimension_height) / 2);
			imagestring($thumbnail, 1, $dimension_x, $dimension_y, $dimension_string, $dimension_colour);
		}
	}
	else
	{
		$thumbnail = $src;
	}

	if (!$gd_errored)
	{
		if ($album_config['thumbnail_cache'] == 1)
		{
			// ------------------------
			// Re-generate successfully. Write it to disk!
			// ------------------------

			$pic_thumbnail = $pic_filename;

			switch ($pic_filetype)
			{
				case '.gif':
				case '.jpg':
					@imagejpeg($thumbnail, ALBUM_CACHE_PATH . $pic_thumbnail, $album_config['thumbnail_quality']);
					break;
				case '.png':
					@imagepng($thumbnail, ALBUM_CACHE_PATH . $pic_thumbnail);
					break;
			}

			@chmod(ALBUM_CACHE_PATH . $pic_thumbnail, 0777);
		}


		// ----------------------------
		// After write to disk, donot forget to send to browser also
		// ----------------------------

		switch ($pic_filetype)
		{
			case '.gif':
			case '.jpg':
				@imagejpeg($thumbnail, '', $album_config['thumbnail_quality']);
				break;
			case '.png':
				@imagepng($thumbnail);
				break;
		}

		exit;
	}
	else
	{
		// ----------------------------
		// It seems you have not GD installed :(
		// ----------------------------
		if($pic_filetype = '.jpg')
		{
			if ($album_config['show_img_no_gd'] == 1)
			{
				header('Content-type: image/jpeg');
				header("Content-Disposition: filename=thumb_" . ereg_replace("[^A-Za-z0-9]", "_", $thispic['pic_title']) . $pic_filetype);
				readfile(ALBUM_UPLOAD_PATH . $pic_filename);
				exit;
			}
			else
			{
				header('Content-type: image/jpeg');
				header("Content-Disposition: filename=thumb_" . ereg_replace("[^A-Za-z0-9]", "_", $thispic['pic_title']) . $pic_filetype);
				readfile($images['no_thumbnail']);
				exit;
			}
		}
		elseif($pic_filetype != '.png')
		{
			if ($album_config['show_img_no_gd'] == 1)
			{
				header('Content-type: image/png');
				header("Content-Disposition: filename=thumb_" . ereg_replace("[^A-Za-z0-9]", "_", $thispic['pic_title']) . $pic_filetype);
				readfile(ALBUM_UPLOAD_PATH . $pic_filename);
				exit;
			}
			else
			{
				header('Content-type: image/jpeg');
				header("Content-Disposition: filename=thumb_" . ereg_replace("[^A-Za-z0-9]", "_", $thispic['pic_title']) . $pic_filetype);
				readfile($images['no_thumbnail']);
				exit;
			}
		}
		elseif($pic_filetype != '.gif')
		{
			if ($album_config['show_img_no_gd'] == 1)
			{
				header('Content-type: image/gif');
				header("Content-Disposition: filename=thumb_" . ereg_replace("[^A-Za-z0-9]", "_", $thispic['pic_title']) . $pic_filetype);
				readfile(ALBUM_UPLOAD_PATH . $pic_filename);
				exit;
			}
			else
			{
				header('Content-type: image/jpeg');
				header("Content-Disposition: filename=thumb_" . ereg_replace("[^A-Za-z0-9]", "_", $thispic['pic_title']) . $pic_filetype);
				readfile($images['no_thumbnail']);
				exit;
			}
		}
		else
		{
			header('Content-type: image/jpeg');
			header("Content-Disposition: filename=thumb_" . ereg_replace("[^A-Za-z0-9]", "_", $thispic['pic_title']) . $pic_filetype);
			readfile($images['no_thumbnail']);
			exit;
		}
	}
}


// +------------------------------------------------------+
// |  Powered by Photo Album 2.x.x (c) 2002-2003 Smartor  |
// +------------------------------------------------------+

?>