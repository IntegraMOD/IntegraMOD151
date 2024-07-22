<?php
/***************************************************************************
 *							   album_constants.php
 *                            -------------------
 *   begin                : Saturday, February 01, 2003
 *   copyright            : (C) 2003 Smartor
 *   email                : smartor_xp@hotmail.com
 *
 *   $Id: album_constants.php,v 1.0.4 2003/02/23 20:50:48 ngoctu Exp $
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
 *
 *   MODIFICATION:
 *   	-inserted few extra session handlings
 *   	-inserted SP table constant
 *   	-inserted medium thumb path constant
 *
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
}

if (defined('PAGE_ALBUM'))
{
	return;
}

define('PAGE_ALBUM', -50);	// for Session Handling
define('PAGE_ALBUM_PERSONAL', -51);
define('PAGE_ALBUM_PICTURE', -52);
define('PAGE_ALBUM_SEARCH', -53);

//define('PERSONAL_GALLERY', 0); // pic_cat_id <- do NOT change this value
define('ALBUM_NAV_ARROW','&nbsp;&raquo;&nbsp;');
define('ALBUM_DATA_ALREADY_READ', -127);

define('ALBUM_ROOT_CATEGORY', -1);
define('ALBUM_PUBLIC_GALLERY', 0);

// special album jumpbox/selection values
define('ALBUM_JUMPBOX_SEPERATOR', -99999900);
define('ALBUM_JUMPBOX_DELETE', -99999901);
define('ALBUM_JUMPBOX_USERS_GALLERY', -99999902);
define('ALBUM_JUMPBOX_PUBLIC_GALLERY', -99999903);

// permission rights defined flags
define('ALBUM_AUTH_VIEW', 1);
define('ALBUM_AUTH_UPLOAD', 2);
define('ALBUM_AUTH_CREATE_PERSONAL', 2);
define('ALBUM_AUTH_RATE', 4);
define('ALBUM_AUTH_COMMENT', 8);
define('ALBUM_AUTH_EDIT', 16);
define('ALBUM_AUTH_DELETE', 32);
define('ALBUM_AUTH_MODERATOR', 64);
define('ALBUM_AUTH_MANAGE_PERSONAL_CATEGORIES', 128);

// special 'predefined' combinations
define('ALBUM_AUTH_ALL', 255);
define('ALBUM_AUTH_VIEW_AND_UPLOAD', 3);

// used to indicate if you are going to read both public & personal album categories
define('ALBUM_READ_ALL_CATEGORIES', 512);
define('ALBUM_CREATE_CAT_ID_LIST', 1024);

// select/jumpbox defined flags
define('ALBUM_SELECTBOX_INCLUDE_ALL', 1);
define('ALBUM_SELECTBOX_INCLUDE_ROOT', 2);
define('ALBUM_SELECTBOX_DELETING', 4);
define('ALBUM_SELECTBOX_ALL', 7); // all three options
define('ALBUM_SELECTBOX_PUBLIC_HEADER', 8);
define('ALBUM_VIEW_ALL', 'all');
define('ALBUM_VIEW_ALL_PICS', 'allpics');
define('ALBUM_VIEW_LIST', 'list');
define('ALBUM_VIEW_NORMAL', '');
define('ALBUM_LISTTYPE_PICTURES', 'pic');
define('ALBUM_LISTTYPE_COMMENTS', 'comment');
define('ALBUM_LISTTYPE_RATINGS', 'rating');

define('ALBUM_INCLUDE_PARENT_ID', true);
define('ALBUM_EXCLUDE_PARENT_ID', false);


// User Levels for Album system <- do NOT change these values
define('ALBUM_ANONYMOUS', -1);
define('ALBUM_GUEST', -1);

define('ALBUM_USER', 0);
define('ALBUM_ADMIN', 1);
define('ALBUM_MOD', 2);
define('ALBUM_PRIVATE', 3);


// Path (trailing slash required)
define('ALBUM_UPLOAD_PATH', 'album_mod/upload/');
define('ALBUM_OTF_PATH', 'album_mod/upload/otf/');
define('ALBUM_CACHE_PATH', 'album_mod/upload/cache/');
define('ALBUM_MED_CACHE_PATH', 'album_mod/upload/med_cache/');
define('ALBUM_WM_CACHE_PATH', 'album_mod/upload/wm_cache/');
define('ALBUM_WM_FILE', 'album_mod/mark_fap.png');

?>
