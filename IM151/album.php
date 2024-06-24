<?php
/***************************************************************************
 *                                album.php
 *                            -------------------
 *   begin                : Tuesday, February 04, 2003
 *   copyright            : (C) 2003 Smartor
 *   email                : smartor_xp@hotmail.com
 *
 *   $Id: album.php,v 2.0.7 2003/03/15 10:16:30 ngoctu Exp $
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
 *		-added images to rating, insted of number for rating
 *		-added random pictures
 *		-added highest rated pictures (@ MarkFulton.com)
 *		-coment # for categories
 *		-last comment in categories
 *
 ***************************************************************************/

/***************************************************************************
 *                            MODIFICATIONS
 *                           ---------------
 *     copyright            : (C) 2004 IdleVoid
 *     email                : idlevoid@slater.dk
 *     file version         : 1.0.8
 *     release              : 1.3.0
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
// Check $album_user_id
// ------------------------------------
if (isset ($_POST['user_id']))
{
	$album_user_id = intval($_POST['user_id']);
}
elseif (isset ($_GET['user_id']))
{
	$album_user_id = intval($_GET['user_id']);
}
else
{
	// if no user_id was supplied then we aren't going to show a personal gallery category
	$album_user_id = ALBUM_PUBLIC_GALLERY;
}

$album_view_mode = '';
if ($album_user_id != ALBUM_PUBLIC_GALLERY)
{
	$cat_id = ALBUM_ROOT_CATEGORY;
	
	if (isset ($_POST['mode']))
	{
		$album_view_mode = strtolower($_POST['mode']);
	}
	elseif (isset ($_GET['mode']))
	{
		$album_view_mode = strtolower($_GET['mode']);
	}
	// make sure that it only contains some valid value
	switch ($album_view_mode)
	{
		case ALBUM_VIEW_ALL:
			$album_view_mode = ALBUM_VIEW_ALL;
			break;
		case ALBUM_VIEW_LIST:
			$album_view_mode = ALBUM_VIEW_LIST;
			break;
		default:
			$album_view_mode = '';
	}

	if (isset ($_POST['cat_id']))
	{
		$cat_id = intval($_POST['cat_id']);
	}
	elseif (isset ($_GET['cat_id']))
	{
		$cat_id = intval($_GET['cat_id']);
	}

	if ($album_user_id < 1)
	{
		if (!$userdata['session_logged_in'])
		{
			redirect(append_sid(album_append_uid(LOGIN_MG . "?redirect=album.$phpEx", true)));
		}
		else
		{
			$album_user_id = $userdata['user_id'];
			redirect(append_sid(album_append_uid("album.$phpEx", true)));
		}
	}

	if ($cat_id != ALBUM_ROOT_CATEGORY && $cat_id != album_get_personal_root_id($album_user_id))
	{
		redirect(append_sid(album_append_uid("album_cat.$phpEx" . album_build_url_parameters($_GET), false)));
	}
}
else
{
	$cat_id = null;
}

$catrows = array ();
$options = ($album_view_mode == ALBUM_VIEW_LIST ) ? ALBUM_READ_ALL_CATEGORIES|ALBUM_AUTH_VIEW : ALBUM_AUTH_VIEW;
$catrows = album_read_tree($album_user_id, $options);

album_read_tree($album_user_id);
$album_nav_cat_desc = album_make_nav_tree($cat_id, "album_cat.$phpEx", "nav" , $album_user_id);
if ($album_nav_cat_desc != '')
{
	$album_nav_cat_desc = ALBUM_NAV_ARROW . $album_nav_cat_desc;
}
// --------------------------------
// Build allowed category-list (for recent pics after here)
// $catrows array now stores all categories which this user can view.
// --------------------------------
$allowed_cat = ''; // For Recent Public Pics below
for ($i = 0; $i < (isset($catrows) ? count($catrows) : 0); $i ++)
{
	// --------------------------------
	// build list of allowd category id's
	// --------------------------------
	$allowed_cat .= ($allowed_cat == '') ? $catrows[$i]['cat_id'] : ','.$catrows[$i]['cat_id'];
}
//
// END of Categories Index
//

// ------------------------------------
// Build the sort method and sort order
// information
// ------------------------------------

if (isset ($_GET['start']))
{
	$start = intval($_GET['start']);
}
elseif (isset ($_POST['start']))
{
	$start = intval($_POST['start']);
}
else
{
	$start = 0;
}

if (isset ($_GET['sort_method']))
{
	switch ($_GET['sort_method'])
	{
		case 'pic_time' :
			$sort_method = 'pic_time';
			break;
		case 'pic_title' :
			$sort_method = 'pic_title';
			break;
		case 'username' :
			$sort_method = 'username';
			break;
		case 'pic_view_count' :
			$sort_method = 'pic_view_count';
			break;
		case 'rating' :
			$sort_method = 'rating';
			break;
		case 'comments' :
			$sort_method = 'comments';
			break;
		case 'new_comment' :
			$sort_method = 'new_comment';
			break;
		default :
			$sort_method = $album_config['sort_method'];
	}
}
elseif (isset ($_POST['sort_method']))
{
	switch ($_POST['sort_method'])
	{
		case 'pic_time' :
			$sort_method = 'pic_time';
			break;
		case 'pic_title' :
			$sort_method = 'pic_title';
			break;
		case 'username' :
			$sort_method = 'username';
			break;
		case 'pic_view_count' :
			$sort_method = 'pic_view_count';
			break;
		case 'rating' :
			$sort_method = 'rating';
			break;
		case 'comments' :
			$sort_method = 'comments';
			break;
		case 'new_comment' :
			$sort_method = 'new_comment';
			break;
		default :
			$sort_method = $album_config['sort_method'];
	}
}
else
{
	$sort_method = $album_config['sort_method'];
}

if (isset ($_GET['sort_order']))
{
	switch ($_GET['sort_order'])
	{
		case 'ASC' :
			$sort_order = 'ASC';
			break;
		case 'DESC' :
			$sort_order = 'DESC';
			break;
		default :
			$sort_order = $album_config['sort_order'];
	}
}
elseif (isset ($_POST['sort_order']))
{
	switch ($_POST['sort_order'])
	{
		case 'ASC' :
			$sort_order = 'ASC';
			break;
		case 'DESC' :
			$sort_order = 'DESC';
			break;
		default :
			$sort_order = $album_config['sort_order'];
	}
}
else
{
	$sort_order = $album_config['sort_order'];
}

// ------------------------------------
// additional sorting options
// ------------------------------------
if ($album_user_id != ALBUM_PUBLIC_GALLERY)
{
	$sort_rating_option = '';
	$sort_comments_option = '';
	$sort_new_comment_option = '';

	if ($album_config['rate'] == 1)
	{
		$sort_rating_option = '<option value="rating" ';
		$sort_rating_option .= ($sort_method == 'rating') ? 'selected="selected"' : '';
		$sort_rating_option .= '>'.$lang['Rating'].'</option>';
	}
	if ($album_config['comment'] == 1)
	{
		$sort_comments_option = '<option value="comments" ';
		$sort_comments_option .= ($sort_method == 'comments') ? 'selected="selected"' : '';
		$sort_comments_option .= '>'.$lang['Comments'].'</option>';

		$sort_new_comment_option = '<option value="new_comment" ';
		$sort_new_comment_option .= ($sort_method == 'new_comment') ? 'selected="selected"' : '';
		$sort_new_comment_option .= '>'.$lang['New_Comment'].'</option>';
	}
}

/*
+----------------------------------------------------------
| Start output the page
+----------------------------------------------------------
*/

$page_title = $lang['Album'];

// is it a public gallery ?
if ($album_user_id == ALBUM_PUBLIC_GALLERY)
{
	include($phpbb_root_path . 'includes/page_header.'.$phpEx);

	$template->set_filenames(array(
		'body' => 'album_index_body.tpl')
	);

	$cols = ($album_config['img_cols'] == 0 ? 4 : $album_config['img_cols']);
	$cols_width = (100/$cols) . '%';

	// Recent Public Pics
	if ($album_config['disp_late'] == 1)
	{
		album_build_recent_pics($allowed_cat);
	}

	// Highest Rated Pics
	if ($album_config['disp_high'] == 1)
	{
		album_build_highest_rated_pics($allowed_cat);
	}
	
	// Most Viewed Pics
	if ($album_config['disp_mostv'] == 1)
	{
		album_build_most_viewed_pics($allowed_cat);
	}

	//Random Pics
	if ($album_config['disp_rand'] == 1)
	{
		album_build_random_pics($allowed_cat);
	}

	$template->assign_vars(array(
		'ALBUM_NAV' => $album_nav_cat_desc,
		'S_COLS' => $cols,
		'S_COL_WIDTH' => $cols_width,
		'TARGET_BLANK' => ($album_config['fullpic_popup']) ? 'target="_blank"' : '',
		'L_RAND_PICS' => $lang['Random_Pictures'],
		'L_HI_RATINGS' => $lang['Highest_Rated_Pictures'],
		'L_RECENT_PUBLIC_PICS' => $lang['Recent_Public_Pics'],
		'L_MOST_VIEWED' => $lang['Most_Viewed_Pictures'],
		'L_NO_PICS' => $lang['No_Pics'],
		'L_PIC_TITLE' => $lang['Pic_Image'],
		'L_PIC_ID' => $lang['Pic_ID'],
		'L_VIEW' => $lang['View'],
		'L_POSTER' => $lang['Pic_Poster'],
		'L_POSTED' => $lang['Posted']
		)
	);
}
// it's a personal gallery, and in the root folder
else
{
	if ($album_view_mode == ALBUM_VIEW_LIST)
	{
		include ($album_root_path . 'album_memberlist.' . $phpEx);
	}
	else
	{
		// include our special personal gallery files
		// this file holds all the code to handle personal galleries
		// except moderation and management of personal gallery categories.
		include ($album_root_path . 'album_personal.' . $phpEx);
	}
}

if (empty($album_view_mode))
{
	album_display_index($album_user_id, ALBUM_ROOT_CATEGORY, true, true, true);
}

// Generate the page
$template->pparse('body');

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);


?>
