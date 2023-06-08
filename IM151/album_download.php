<?php
/***************************************************************************
 *                            album_download.php
 *                            -------------------
 *   begin                : Thursday, April 14, 2005
 *   copyright            : (C) 2005 chadsmith
 *   email                : snowblades83@hotmail.com
 *
 *   $Id: album_download.php,v 1.00.0.00 2005/04/14 19:32:04 chadsmith Exp $
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
include($album_root_path . 'archive.'.$phpEx);

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
// Get the request
// ------------------------------------

$auth_view = 0;
if( isset($_GET['cat_id']) )
{
	$cat_id = intval($_GET['cat_id']);
	$album_user_access = album_user_access($cat_id, $thiscat, 1, 0, 0, 0, 0, 0); // VIEW
	$auth_view = $album_user_access['view'];
	//$auth_view = ($userdata['user_level'] == ADMIN);
}
elseif( isset($_GET['user_id']) )
{
	$user_id = intval($_GET['user_id']);
	$cat_id = PERSONAL_GALLERY . " AND pic_user_id = $user_id";
	$personal_gallery_access = personal_gallery_access(1, 0);
	$auth_view = $personal_gallery_access['view'];
	//$auth_view = ( ($userdata['user_id'] == $user_id) || ($userdata['user_level'] > 0) ) ? 1 : 0;
}

if( isset($_GET['start']) )
{
	$start = intval($_GET['start']);
}
elseif( isset($_POST['start']) )
{
	$start = intval($_POST['start']);
}
else
{
	$start = 0;
}

if( isset($_GET['sort_method']) )
{
	switch ($_GET['sort_method'])
	{
		case 'pic_title':
			$sort_method = 'pic_title';
			break;
		case 'pic_view_count':
			$sort_method = 'pic_view_count';
			break;
		case 'rating':
			$sort_method = 'rating';
			break;
		case 'comments':
			$sort_method = 'comments';
			break;
		case 'new_comment':
			$sort_method = 'new_comment';
			break;
		default:
			$sort_method = $album_config['sort_method'];
	}
}
elseif( isset($_POST['sort_method']) )
{
	switch ($_POST['sort_method'])
	{
		case 'pic_title':
			$sort_method = 'pic_title';
			break;
		case 'pic_view_count':
			$sort_method = 'pic_view_count';
			break;
		case 'rating':
			$sort_method = 'rating';
			break;
		case 'comments':
			$sort_method = 'comments';
			break;
		case 'new_comment':
			$sort_method = 'new_comment';
			break;
		default:
			$sort_method = $album_config['sort_method'];
	}
}
else
{
	$sort_method = $album_config['sort_method'];
}

if( isset($_GET['sort_order']) )
{
	switch ($_GET['sort_order'])
	{
		case 'ASC':
			$sort_order = 'ASC';
			break;
		case 'DESC':
			$sort_order = 'DESC';
			break;
		default:
			$sort_order = $album_config['sort_order'];
	}
}
elseif( isset($_POST['sort_order']) )
{
	switch ($_POST['sort_order'])
	{
		case 'ASC':
			$sort_order = 'ASC';
			break;
		case 'DESC':
			$sort_order = 'DESC';
			break;
		default:
			$sort_order = $album_config['sort_order'];
	}
}
else
{
	$sort_order = $album_config['sort_order'];
}

$pics_per_page = $album_config['rows_per_page'] * $album_config['cols_per_page'];

// ------------------------------------
// Check authorization
// ------------------------------------

if ( (!$auth_view) || (($album_config['show_download'] == 0) && ($userdata['user_level'] != ADMIN)))
{
	message_die(GENERAL_ERROR, $lang['No_Download_auth']);
}
//
// END check request
//

// ------------------------------------
// Count Pics
// ------------------------------------

$sql = "SELECT COUNT(pic_id) AS count
		FROM ". ALBUM_TABLE ."
		WHERE pic_cat_id = $cat_id";
if( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not count pics', '', __LINE__, __FILE__, $sql);
}

$row = $db->sql_fetchrow($result);

$total_pics = $row['count'];


// ------------------------------------
// Build archive
// ------------------------------------

if ($total_pics > 0)
{
	$limit_sql = ($start == 0) ? $pics_per_page : $start .','. $pics_per_page; 
	$sql = "SELECT pic_filename
			FROM ". ALBUM_TABLE ."
			WHERE pic_cat_id = $cat_id
			ORDER BY $sort_method $sort_order
			LIMIT $limit_sql";
	if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not query pics information', '', __LINE__, __FILE__, $sql);
	}

	// ------------------------------------
	// If you wish to use a format other than zip uncomment the necessary line, "archive" can also be renamed
	// ------------------------------------

	$archive = new zip_file("archive.zip"); // save as zip
	// $archive = new tar_file("archive.tar"); // save as tar
	// $archive = new gzip_file("archive.tgz"); // save as gzip

	$archive->set_options(array('inmemory'=>1,'storepaths'=>0,'comment'=>"Archived photos from " . $board_config['sitename']));
	$DLpics = array();
	while( $row = $db->sql_fetchrow($result) )
	{
		$DLpics[] = $row;
	}

	for ($num = 0; $num < count($DLpics); $num++)
	{
		$archive->add_files(ALBUM_UPLOAD_PATH . $DLpics[$num]['pic_filename']);
	}
	$archive->create_archive();
	$archive->download_file();

}
else
{
	message_die(GENERAL_ERROR, 'There are no pictures to download');
}
?>