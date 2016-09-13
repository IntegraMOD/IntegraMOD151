<?php
/***************************************************************************
 *                            album_picm.php
 *                            -------------------
 *   started            : Saturday, January 18, 2004
 *   copyright          : © Volodymyr (CLowN) Skoryk
 *   email              : blaatimmy72@yahoo.com
 *	 version            : 1.5
 *
 *   original work by smartor album_thumbnail.php
 *	 jan 13 .. added how many times this picture was viewed...(med thumb or full pic)
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
// Watermark - BEGIN
include($album_root_path . 'album_watermark.'.$phpEx);
// Watermark - END

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_ALBUM);
init_userprefs($userdata);
//
// End session management
//


//
// Get general album information
//
include($album_root_path . 'album_common.'.$phpEx);


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
	die('No pics specified');
}

// ------------------------------------
// Get this pic info and current Category Info
// ------------------------------------
$sql = "SELECT p.*, c.*
		FROM ". ALBUM_TABLE ." AS p, ". ALBUM_CAT_TABLE ."  AS c
		WHERE p.pic_id = '$pic_id'
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

if( empty($thispic) or !file_exists(ALBUM_UPLOAD_PATH . $pic_filename) )
{
	message_die(GENERAL_ERROR, $lang['Pic_not_exist']);
}

// ------------------------------------
// Check the permissions
// ------------------------------------
$album_user_access = album_permissions($album_user_id, $cat_id, ALBUM_AUTH_VIEW, $thispic);

if ($album_user_access['view'] == 0)
{
	die($lang['Not_Authorised']);
}


// ------------------------------------
// Check Pic Approval
// ------------------------------------

if ($userdata['user_level'] != ADMIN)
{
	if( ($thispic['cat_approval'] == ADMIN) or (($thispic['cat_approval'] == MOD) and !$album_user_access['moderator']) )
	{
		if ($thispic['pic_approval'] != 1)
		{
			die($lang['Not_Authorised']);
		}
	}
}


// ------------------------------------
// Check hotlink
// ------------------------------------

if( ($album_config['hotlink_prevent'] == 1) and (isset($HTTP_SERVER_VARS['HTTP_REFERER'])) )
{
	$check_referer = explode('?', $HTTP_SERVER_VARS['HTTP_REFERER']);
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

		if( (strstr($check_referer, $good_referers[$i])) and ($good_referers[$i] != '') )
		{
			$errored = FALSE;
		}
	}

	if ($errored)
	{
		die($lang['Not_Authorised']);
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
		header("Content-Disposition: filename=mid_" . ereg_replace("[^A-Za-z0-9]", "_", $thispic['pic_title']) . $pic_filetype);
		readfile(ALBUM_UPLOAD_PATH . $pic_filename);
		exit;
	}
	if ($album_config['show_gif_mid_thumb'] == 1)
	{
		header('Content-type: image/gif');
		header("Content-Disposition: filename=" . ereg_replace("[^A-Za-z0-9]", "_", $thispic['pic_title']) . $pic_filetype);
		readfile(ALBUM_UPLOAD_PATH . $pic_filename);
		exit;
	}
	else
	{
		header('Content-type: image/jpeg');
		header("Content-Disposition: filename=mid_" . ereg_replace("[^A-Za-z0-9]", "_", $thispic['pic_title']) . $pic_filetype);
		readfile($images['no_thumbnail']);
		exit;
	}
}
else
{
	// --------------------------------
	// Check thumbnail cache. If cache is available we will SEND & EXIT
	// --------------------------------

	if( ($album_config['midthumb_cache'] == 1) && ($pic_thumbnail != '') && file_exists(ALBUM_MED_CACHE_PATH . $pic_thumbnail) )
	{
		switch ($pic_filetype)
		{
			case '.gif':
			case '.jpg':
      case '.jpeg':
				header('Content-type: image/jpeg');
				header("Content-Disposition: filename=mid_" . preg_replace("[^A-Za-z0-9]", "_", $thispic['pic_title']) . $pic_filetype);
				break;
			case '.png':
				header('Content-type: image/png');
				header("Content-Disposition: filename=mid_" . preg_replace("[^A-Za-z0-9]", "_", $thispic['pic_title']) . $pic_filetype);
				break;
		}

		if ( ($album_config['use_watermark'] == 1) && ($userdata['user_level'] != ADMIN) && (file_exists(ALBUM_WM_CACHE_PATH . $pic_thumbnail)) )
		{
			readfile(ALBUM_WM_CACHE_PATH . $pic_thumbnail);
			exit;
		}
		else
		{
			readfile(ALBUM_MED_CACHE_PATH . $pic_thumbnail);
			exit;
		}
	}


	// --------------------------------
	// Hmm, cache is empty. Try to re-generate!
	// --------------------------------

	$pic_size = @getimagesize(ALBUM_UPLOAD_PATH . $pic_filename);
	$pic_width = $pic_size[0];
	$pic_height = $pic_size[1];

	$gd_errored = false;
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

	$src = @$read_function(ALBUM_UPLOAD_PATH . $pic_filename);

	if (!$src)
	{
		$gd_errored = true;
		$pic_thumbnail = '';
	}
	elseif( ($pic_width > $album_config['midthumb_width']) || ($pic_height > $album_config['midthumb_height']) )
	{
		if ($pic_width > $pic_height)
		{
			$thumbnail_width = $album_config['midthumb_width'];
			$thumbnail_height = $album_config['midthumb_width'] * ($pic_height/$pic_width);
		}
		else
		{
			$thumbnail_height = $album_config['midthumb_height'];
			$thumbnail_width = $album_config['midthumb_height'] * ($pic_width/$pic_height);
		}
		if ($album_config['gd_version'] != 3)
		{
			if( ($pic_filetype != '.gif') && ($album_config['use_watermark'] == 1) && ($userdata['user_level'] != ADMIN) && 
				( (!$userdata['session_logged_in']) || ($album_config['wut_users'] == 1)) )
			{
				$thumb_path = ALBUM_WM_CACHE_PATH;
				$wm_sourcefile = ALBUM_UPLOAD_PATH . $thispic['pic_filename'];
				$wm_insertfile = ALBUM_WM_FILE;
				$wm_position  = $album_config['disp_watermark_at'];
				$wm_transition = 50;
				$thumbnail = mergeResizePics($wm_sourcefile, $wm_insertfile, $thumbnail_width, $thumbnail_height, $wm_position, $wm_transition, $pic_filetype);
			}
			else
			{
				$thumb_path = ALBUM_MED_CACHE_PATH;
				$thumbnail = ($album_config['gd_version'] == 1) ? @imagecreate($thumbnail_width, $thumbnail_height) : @imagecreatetruecolor($thumbnail_width, $thumbnail_height);
				$resize_function = ($album_config['gd_version'] == 1) ? 'imagecopyresized' : 'imagecopyresampled';
				@$resize_function($thumbnail, $src, 0, 0, 0, 0, $thumbnail_width, $thumbnail_height, $pic_width, $pic_height);
			}
		}
		else
		{
			copy ( $src, $thumbnail );
			@chmod ($outthumb, 0666);
			$syscmd = "'c:\ImageMagick\mogrify.exe' -size $thumbnail_width x $thumbnail_height -quality 70 -geometry $thumbnail_width x $thumbnail_height $thumbnail ";
		}
	}
	else
	{
		// MG Watermark - BEGIN
		if( ($pic_filetype != '.gif') && ($album_config['use_watermark'] == 1) && ($userdata['user_level'] != ADMIN) &&
			( (!$userdata['session_logged_in']) || ($album_config['wut_users'] == 1)) )
		{
			$wm_sourcefile_id = $src;
			$wm_sourcefile = ALBUM_UPLOAD_PATH . $pic_filename;
			$wm_insertfile = ALBUM_WM_FILE;
			$wm_position  = $album_config['disp_watermark_at'];
			$wm_transition = 50;
			$src = mergePics($wm_sourcefile, $wm_insertfile, $wm_position, $wm_transition, $pic_filetype);
		}
		// MG Watermark - END
		$thumbnail = $src;
	}

	if (!$gd_errored)
	{
		if ( ($album_config['midthumb_cache'] == 1) )
		{
			// Re-generate successfully. Write it to disk!

			$pic_thumbnail = $pic_filename;

			switch ($pic_filetype)
			{
				case '.gif':
				case '.jpg':
					@imagejpeg($thumbnail, $thumb_path . $pic_thumbnail, $album_config['thumbnail_quality']);
					break;
				case '.png':
					@imagepng($thumbnail, $thumb_path . $pic_thumbnail);
					break;
			}

			@chmod($thumb_path . $pic_thumbnail, 0777);
		}
		@unlink($pic_thumbnail);
		// After write to disk, donot forget to send to browser also

		switch ($pic_filetype)
		{
			case '.gif':
			case '.jpg':
				@imagejpeg($thumbnail, NULL, $album_config['thumbnail_quality']);
				break;
			case '.png':
				@imagepng($thumbnail);
				break;
		}

		exit;
	}
	else
	{
		// It seems you have not GD installed :(
		if($pic_filetype = '.jpg')
		{
			if ($album_config['show_img_no_gd'] == 1)
			{
				header('Content-type: image/jpeg');
				header("Content-Disposition: filename=mid_" . ereg_replace("[^A-Za-z0-9]", "_", $thispic['pic_title']) . $pic_filetype);
				readfile(ALBUM_UPLOAD_PATH . $pic_filename);
				exit;
			}
			else
			{
				header('Content-type: image/jpeg');
				header("Content-Disposition: filename=mid_" . ereg_replace("[^A-Za-z0-9]", "_", $thispic['pic_title']) . $pic_filetype);
				readfile($images['no_thumbnail']);
				exit;
			}
		}
		elseif($pic_filetype != '.png')
		{
			if ($album_config['show_img_no_gd'] == 1)
			{
				header('Content-type: image/png');
				header("Content-Disposition: filename=mid_" . ereg_replace("[^A-Za-z0-9]", "_", $thispic['pic_title']) . $pic_filetype);
				readfile(ALBUM_UPLOAD_PATH . $pic_filename);
				exit;
			}
			else
			{
				header('Content-type: image/jpeg');
				header("Content-Disposition: filename=mid_" . ereg_replace("[^A-Za-z0-9]", "_", $thispic['pic_title']) . $pic_filetype);
				readfile($images['no_thumbnail']);
				exit;
			}
		}
		elseif($pic_filetype != '.gif')
		{
			if ($album_config['show_img_no_gd'] == 1)
			{
				header('Content-type: image/gif');
				header("Content-Disposition: filename=mid_" . ereg_replace("[^A-Za-z0-9]", "_", $thispic['pic_title']) . $pic_filetype);
				readfile(ALBUM_UPLOAD_PATH . $pic_filename);
				exit;
			}
			else
			{
				header('Content-type: image/jpeg');
				header("Content-Disposition: filename=mid_" . ereg_replace("[^A-Za-z0-9]", "_", $thispic['pic_title']) . $pic_filetype);
				readfile($images['no_thumbnail']);
				exit;
			}
		}
		else
		{
			header('Content-type: image/jpeg');
			header("Content-Disposition: filename=mid_" . ereg_replace("[^A-Za-z0-9]", "_", $thispic['pic_title']) . $pic_filetype);
			readfile($images['no_thumbnail']);
			exit;
		}
	}
}


// +-------------------------------------------------------------+
// |  Powered by Photo Album 2.x.x (c) 2002-2003 Smartor         |
// |  with Volodymyr (CLowN) Skoryk's Service Pack 1 © 2003-2004 |
// +-------------------------------------------------------------+

?>
