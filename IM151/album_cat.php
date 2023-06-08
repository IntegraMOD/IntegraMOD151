<?php
/***************************************************************************
 *                               album_cat.php
 *                            -------------------
 *   begin                : Tuesday, February 04, 2003
 *   copyright            : (C) 2003 Smartor
 *   email                : smartor_xp@hotmail.com
 *
 *   $Id: album_cat.php,v 2.0.7 2003/03/15 10:16:56 ngoctu Exp $
 *
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
 *		-fixed links to link to album_showpage.php
 *
 *
 ***************************************************************************/

/***************************************************************************
 *                            MODIFICATIONS
 *                           ---------------
 * copyright    : © IdleVoid
 * email        : idlevoid@slater.dk
 * file version : 1.1.8
 * release      : 1.3.0
 *
 ***************************************************************************/

define('IN_PHPBB', true);
$phpbb_root_path = './';
$album_root_path = $phpbb_root_path . 'album_mod/';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_ALBUM_PICTURE);
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
// Check $album_user_id
// ------------------------------------
if( isset($_POST['user_id']) )
{
	$album_user_id = intval($_POST['user_id']);
}
elseif( isset($_GET['user_id']) )
{
	$album_user_id = intval($_GET['user_id']);
}
else
{
	// if no user_id was supplied then we aren't going to show a personal gallery category
	$album_user_id = ALBUM_PUBLIC_GALLERY;
}
if( isset($_POST['cat_id']) )
{
	$cat_id = intval($_POST['cat_id']);
}
elseif( isset($_GET['cat_id']) )
{
	$cat_id = intval($_GET['cat_id']);
}
else
{
	message_die(GENERAL_ERROR, 'No categories specified');
}

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

//
// END check request
//

// if requested gallery is the root category of the public categories, OR
// the category is the root category of the personal gallery -
// then show root album instead
if (($cat_id <= (ALBUM_ROOT_CATEGORY + 1)) || (album_get_personal_root_id($album_user_id) == $cat_id))
{
	if ($cat_id == ALBUM_JUMPBOX_PUBLIC_GALLERY) 
	{
		redirect(append_sid(album_append_uid("album.$phpEx")));
	}

	if ($cat_id == ALBUM_JUMPBOX_USERS_GALLERY)
	{
		redirect(append_sid(album_append_uid("album_personal_index.$phpEx")));
	}
	redirect(append_sid(album_append_uid("album.$phpEx")));
}

// ------------------------------------
// Get this cat info
// ------------------------------------
$thiscat = array(); // this category
$catrows = array(); // all categories for jumpbox
$auth_data  = array(); // the authothentication data for current category for current user

if ($album_user_id != ALBUM_PUBLIC_GALLERY && !album_check_user_exists($album_user_id))
{
	redirect(append_sid(album_append_uid("album.$phpEx")));
}

$read_options = ($album_view_mode == ALBUM_VIEW_LIST ) ? ALBUM_READ_ALL_CATEGORIES|ALBUM_AUTH_VIEW : ALBUM_AUTH_VIEW;
$catrows = album_read_tree($album_user_id, $read_options);

// check if the category exists in the album_tree data
if (!array_key_exists($cat_id, $album_data['keys']) )
{
	message_die(GENERAL_MESSAGE, $lang['Category_not_exist']);
}

$thiscat = $album_data ['data'][ $album_data ['keys'][$cat_id] ];
$total_pics = $thiscat['count'];
$auth_data = album_get_auth_data($cat_id);


// ------------------------------------
// Check permissions
// ------------------------------------
if( !$auth_data['view'] )
{
	if (!$userdata['session_logged_in'])
	{
		//redirect(append_sid(LOGIN_MG . "?redirect=album_cat.$phpEx&cat_id=$cat_id"));
		redirect(append_sid(album_append_uid(LOGIN_MG . "?redirect=album_cat.$phpEx&cat_id=$cat_id")));
	}
	else
	{
		message_die(GENERAL_ERROR, $lang['Not_Authorised']);
	}
}
//
// END check permissions
//
// ------------------------------------
// Build the list of allowed sub category id's
// ------------------------------------
$subcats = array();
$allowed_cat = $cat_id;
album_get_sub_cat_ids($cat_id, $subcats);
for ($i = 0; $i < count($subcats); $i++)
{
	$allowed_cat .= ',' . $subcats[$i];
}
//
// END cat info
//


// ------------------------------------
// Build Auth List
// ------------------------------------
$auth_list = album_build_auth_list($album_user_id, $cat_id);
//
// END Auth List
//


// ------------------------------------
// Build Moderators List
// ------------------------------------

$grouprows = array();
$moderators_list = '';

if ($album_user_id == ALBUM_PUBLIC_GALLERY && $thiscat['cat_moderator_groups'] != '')
{
	// Get the namelist of moderator usergroups
	$sql = "SELECT group_id, group_name, group_type, group_single_user
			FROM " . GROUPS_TABLE . "
			WHERE group_single_user <> 1
				AND group_type <> ". GROUP_HIDDEN ."
				AND group_id IN (". $thiscat['cat_moderator_groups'] .")
			ORDER BY group_name ASC";
	if ( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not get group list', '', __LINE__, __FILE__, $sql);
	}

	while( $row = $db->sql_fetchrow($result) )
	{
		$grouprows[] = $row;
	}

	if( count($grouprows) > 0 )
	{
		for ($j = 0; $j < count($grouprows); $j++)
		{
			$group_link = '<a href="'. append_sid("groupcp.$phpEx?". POST_GROUPS_URL .'='. $grouprows[$j]['group_id']) .'">'. $grouprows[$j]['group_name'] .'</a>';

			$moderators_list .= ($moderators_list == '') ? $group_link : ', ' . $group_link;
		}
	}
}

//
// END Moderator List
//

// Update the naVigation tree
$album_nav_cat_desc = album_make_nav_tree($cat_id, "album_cat.$phpEx", "nav" , $album_user_id);
if ($album_nav_cat_desc != '')
{
	$album_nav_cat_desc = ALBUM_NAV_ARROW . $album_nav_cat_desc;
}

$cat_desc = album_get_object_lang($cat_id, 'desc');

// ------------------------------------
// Build the thumbnail page
// ------------------------------------

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
		case 'pic_time':
			$sort_method = 'pic_time';
			break;
		case 'pic_title':
			$sort_method = 'pic_title';
			break;
		case 'username':
			$sort_method = 'username';
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
else if( isset($_POST['sort_method']) )
{
	switch ($_POST['sort_method'])
	{
		case 'pic_time':
			$sort_method = 'pic_time';
			break;
		case 'pic_title':
			$sort_method = 'pic_title';
			break;
		case 'username':
			$sort_method = 'username';
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

// ------------------------------------
// additional sorting options
// ------------------------------------

$sort_rating_option = '';
$sort_username_option = '';
$sort_comments_option = '';
$sort_new_comment_option = '';
if( $album_config['rate'] == 1 )
{
	$sort_rating_option = '<option value="rating" ';
	$sort_rating_option .= ($sort_method == 'rating') ? 'selected="selected"' : '';
	$sort_rating_option .= '>' . $lang['Rating'] .'</option>';
}
if( $album_config['comment'] == 1 )
{
	$sort_comments_option = '<option value="comments" ';
	$sort_comments_option .= ($sort_method == 'comments') ? 'selected="selected"' : '';
	$sort_comments_option .= '>' . $lang['Comments'] .'</option>';

	$sort_new_comment_option = '<option value="new_comment" ';
	$sort_new_comment_option .= ($sort_method == 'new_comment') ? 'selected="selected"' : '';
	$sort_new_comment_option .= '>' . $lang['New_Comment'] .'</option>';
}

if( $album_user_id == ALBUM_PUBLIC_GALLERY )
{
	$sort_username_option = '<option value="username" ';
	$sort_username_option .= ($sort_method == 'pic_user_id') ? 'selected="selected"' : '';
	$sort_username_option .= '>' . $lang['Sort_Username'] .'</option>';
}

// ------------------------------------
// Build Jumpbox
// ------------------------------------
$album_jumpbox = album_build_jumpbox($cat_id, $album_user_id);
//
// END build jumpbox
//

$upload_img = $images['upload_pic'];
$upload_link = append_sid(album_append_uid("album_upload.$phpEx?cat_id=$cat_id"));
$upload_full_link = '<a href="' . $upload_link . '"><img src="' . $upload_img .'" border="0" alt="' . $lang['Upload_Pic'] . '" title="' . $lang['Upload_Pic'] . '" align="absmiddle" /></a>';

$download_img = $images['download_pic'];
$download_link = append_sid(album_append_uid('album_download.' . $phpEx . '?cat_id=' . $cat_id . ( ($sort_method != '') ? '&sort_method=' . $sort_method : '' ) . ( ($sort_order != '') ? '&sort_order=' . $sort_order : '' ) . ( ($start != '') ? '&start=' . $start : '' )));
$download_full_link = '<a href="' . $download_link . '"><img src="' . $download_img . '" border="0" alt="' . $lang['Download_page'] . '" title="' . $lang['Download_page'] . '" align="absmiddle" /></a>';

if( $auth_data['upload'] == true && empty($enable_picture_upload_switch) )
{
	$enable_picture_upload_switch = true;
	$template->assign_block_vars('enable_picture_upload', array());
}

// Enable download only for own personal galleries
//if ($thiscat['cat_user_id'] == $userdata['user_id'])
if( (($userdata['user_level'] == ADMIN) || (($album_config['show_download'] == 1) && ($auth_data['upload'] == true)) || (($album_config['show_download'] == 2)) ) && ($total_pics > 0))
{
	$enable_picture_download_switch = true;
	$template->assign_block_vars('enable_picture_download', array());
}

// Start output of page

//$page_title = $lang['Album'];
$page_title = $thiscat['cat_title'];

if ($album_user_id == ALBUM_PUBLIC_GALLERY)
{
	if( empty($moderators_list) )
	{
		$moderators_list = $lang['None'];
	}	
	
	include($phpbb_root_path . 'includes/page_header.'.$phpEx);
	
	$template->set_filenames(array(
		'body' => 'album_cat_body.tpl'
		)
	);

	if ($total_pics > 0)
	{
		album_build_picture_table($album_user_id, $cat_id, $thiscat, $auth_data, $start, $sort_method, $sort_order, $total_pics);
		
		if ($album_config['show_recent_in_subcats'] == 1)
		{
			album_build_recent_pics($allowed_cat);
		}
		if ($album_config['disp_mostv'] == 1)
		{
			album_build_most_viewed_pics($allowed_cat);
		}
	}
	else
	{
		// ------------------------------------
		// Build Recent Public Pics
		// ------------------------------------
		if ($has_sub_cats && $album_config['show_recent_instead_of_nopics'] == 1)
		{
			album_build_recent_pics($allowed_cat);
		}
		else
		{
			$template->assign_block_vars('index_pics_block', array());
			$template->assign_block_vars('index_pics_block.no_pics', array());
		}
	}
	// END thumbnails table

	album_read_tree($album_user_id);
	$album_nav_cat_desc = album_make_nav_tree($cat_id, "album_cat.$phpEx", "nav" , $album_user_id);
	if ($album_nav_cat_desc != '')
	{
		$album_nav_cat_desc = ALBUM_NAV_ARROW . $album_nav_cat_desc;
	}

	// Maybe we should also add a new check to see if user really can upload or not
	// this is not even in the original code by smartor
	
	$template->assign_vars(array(
		'ALBUM_NAV' => $album_nav_cat_desc,
		'L_ALBUM' => $lang['Album'],
	
		'U_VIEW_CAT' => append_sid(album_append_uid("album_cat.$phpEx?cat_id=$cat_id")),
		'CAT_TITLE' => $thiscat['cat_title'],
		'CAT_DESC' => $cat_desc,
		//'CAT_DESC' => $thiscat['cat_des'],
	
		'ALBUM_NAVIGATION_ARROW' => ALBUM_NAV_ARROW,
		'NAV_CAT_DESC' => $album_nav_cat_desc,
	
		'L_MODERATORS' => $lang['Moderators'],
		'MODERATORS' => $moderators_list,
	
		'L_UPLOAD_PIC' => $lang['Upload_Pic'],
		'U_UPLOAD_PIC' => $upload_link,
		'UPLOAD_PIC_IMG' => $upload_img,
		'UPLOAD_FULL_LINK' => $upload_full_link,
	
		'L_DOWNLOAD_PICS' => $lang['Download_pics'],
		'L_DOWNLOAD_PAGE' => $lang['Download_page'],
		'U_DOWNLOAD' => $download_link,
		'DOWNLOAD_PIC_IMG' => $download_img,
		'DOWNLOAD_FULL_LINK' => $download_full_link,

		'L_CATEGORY' => $lang['Category'],
	
		//'SLIDESHOW' => $slideshow_link_full,

		'L_NO_PICS' => $lang['No_Pics'],
		'L_RECENT_PUBLIC_PICS' => $lang['Recent_Public_Pics'],
		'L_HI_RATINGS' => $lang['Highest_Rated_Pictures'],
		'L_MOST_VIEWED' => $lang['Most_Viewed_Pictures'],
	
		'S_COLS' => $album_config['cols_per_page'],
		'S_COL_WIDTH' => (100/$album_config['cols_per_page']) . '%',
	
		'L_VIEW' => $lang['View'],
		'L_POSTER' => $lang['Pic_Poster'],
		//'L_POSTER' => $lang['Poster'],
		'L_POSTED' => $lang['Posted'],
	
		'ALBUM_JUMPBOX' => $album_jumpbox,
	
		'S_ALBUM_ACTION' => append_sid(album_append_uid("album_cat.$phpEx?cat_id=$cat_id")),
	
		'TARGET_BLANK' => ($album_config['fullpic_popup']) ? 'target="_blank"' : '',
	
		'L_SELECT_SORT_METHOD' => $lang['Select_sort_method'],
		'L_ORDER' => $lang['Order'],
		'L_SORT' => $lang['Sort'],
	
		'L_TIME' => $lang['Time'],
		'L_PIC_ID' => $lang['Pic_ID'],
		'L_PIC_TITLE' => $lang['Pic_Image'],
		//'L_PIC_TITLE' => $lang['Pic_Title'],
	
		'SORT_TIME' => ($sort_method == 'pic_time') ? 'selected="selected"' : '',
		'SORT_PIC_TITLE' => ($sort_method == 'pic_title') ? 'selected="selected"' : '',
		'SORT_VIEW' => ($sort_method == 'pic_view_count') ? 'selected="selected"' : '',
	
		'SORT_RATING_OPTION' => $sort_rating_option,
		'SORT_COMMENTS_OPTION' => $sort_comments_option,
		'SORT_NEW_COMMENT_OPTION' => $sort_new_comment_option,
		'SORT_USERNAME_OPTION' => $sort_username_option,
	
		'L_ASC' => $lang['Sort_Ascending'],
		'L_DESC' => $lang['Sort_Descending'],
	
		'SORT_ASC' => ($sort_order == 'ASC') ? 'selected="selected"' : '',
		'SORT_DESC' => ($sort_order == 'DESC') ? 'selected="selected"' : '',
	
		'S_AUTH_LIST' => $auth_list
		)
	);	
}
else
{
	include($album_root_path . 'album_personal.' . $phpEx);
}

$template->assign_block_vars('index_pics_block.enable_gallery_title', array());

if (empty($album_view_mode))
{
	$show_personal_gallery_link = ($album_config['show_personal_gallery_link'] == 1) ? true : false;
	album_display_index($album_user_id, $cat_id, true, $show_personal_gallery_link, true);
}


//
// Generate the page
//
$template->pparse('body');

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);


// +-------------------------------------------------------------+
// |  Powered by Photo Album 2.x.x (c) 2002-2003 Smartor         |
// |  with Volodymyr (CLowN) Skoryk's Service Pack 1 © 2003-2004 |
// +-------------------------------------------------------------+

?>
