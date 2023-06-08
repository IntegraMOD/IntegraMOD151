<?php
/***************************************************************************
 *                              album_delete.php
 *                            -------------------
 *   begin                : Wednesday, February 05, 2003
 *   copyright            : (C) 2003 Smartor
 *   email                : smartor_xp@hotmail.com
 *
 *   $Id: album_delete.php,v 2.0.5 2003/04/03 21:08:42 ngoctu Exp $
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
	message_die(GENERAL_ERROR, 'No pics specified');
}

//--- Album Category Hierarchy : begin
//--- version : 1.1.0
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

$cat_id = $thispic['cat_id'];
$album_user_id = $thispic['cat_user_id'];

$pic_filename = $thispic['pic_filename'];
$pic_thumbnail = $thispic['pic_thumbnail'];

if( empty($thispic) )
{
	message_die(GENERAL_ERROR, $lang['Pic_not_exist']);
}

// ------------------------------------
// Check the permissions
// ------------------------------------
$album_user_access = album_permissions($album_user_id, $cat_id, ALBUM_AUTH_DELETE, $thispic);
//--- Album Category Hierarchy : end

if ($album_user_access['delete'] == 0)
{
	if (!$userdata['session_logged_in'])
	{
		redirect(append_sid(LOGIN_MG . "?redirect=album_delete.$phpEx?pic_id=$pic_id"));
	}
	else
	{
		message_die(GENERAL_ERROR, $lang['Not_Authorised']);
	}
}
else
{	
	if( (!$album_user_access['moderator']) && ($userdata['user_level'] != ADMIN) )
	{
		if ($thispic['pic_user_id'] != $userdata['user_id'])
		{
			message_die(GENERAL_ERROR, $lang['Not_Authorised']);
		}
	}
}



/*
+----------------------------------------------------------
| Main work here...
+----------------------------------------------------------
*/

if( !isset($_POST['confirm']) )
{
	// --------------------------------
	// If user give up deleting...
	// --------------------------------
	if( isset($_POST['cancel']) )
	{
		redirect(append_sid(album_append_uid("album_cat.$phpEx?cat_id=$cat_id", true)));
		exit;
	}

	//
	// Start output of page
	//
	$page_title = $lang['Album'];
	include($phpbb_root_path . 'includes/page_header.'.$phpEx);

	$template->set_filenames(array(
		'body' => 'confirm_body.tpl')
	);

	$template->assign_vars(array(
		'MESSAGE_TITLE' => $lang['Confirm'],

		'MESSAGE_TEXT' => $lang['Album_delete_confirm'],

		'L_NO' => $lang['No'],
		'L_YES' => $lang['Yes'],

		'S_CONFIRM_ACTION' => append_sid(album_append_uid("album_delete.$phpEx?pic_id=$pic_id")),
		)
	);

	//
	// Generate the page
	//
	$template->pparse('body');

	include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
}
else
{
	// --------------------------------
	// It's confirmed. First delete all comments
	// --------------------------------
	$sql = "DELETE FROM ". ALBUM_COMMENT_TABLE ."
			WHERE comment_pic_id = '$pic_id'";
	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not delete related comments', '', __LINE__, __FILE__, $sql);
	}


	// --------------------------------
	// Delete all ratings
	// --------------------------------
	$sql = "DELETE FROM ". ALBUM_RATE_TABLE ."
			WHERE rate_pic_id = '$pic_id'";
	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not delete related ratings', '', __LINE__, __FILE__, $sql);
	}


	// --------------------------------
	// Delete cached thumbnail
	// --------------------------------
	if(($thispic['pic_thumbnail'] != '') and @file_exists(ALBUM_CACHE_PATH . $thispic['pic_thumbnail']))
	{
		@unlink(ALBUM_CACHE_PATH . $thispic['pic_thumbnail']);
	}


	// --------------------------------
	// Delete File
	// --------------------------------
	@unlink(ALBUM_UPLOAD_PATH . $thispic['pic_filename']);


	// --------------------------------
	// Delete DB entry
	// --------------------------------
	$sql = "DELETE FROM ". ALBUM_TABLE ."
			WHERE pic_id = '$pic_id'";
	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not delete DB entry', '', __LINE__, __FILE__, $sql);
	}


	// --------------------------------
	// Complete... now send a message to user
	// --------------------------------

	$message = $lang['Pics_deleted_successfully'];

	$template->assign_vars(array(
		'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid(album_append_uid("album_cat.$phpEx?cat_id=$cat_id")) . '">')
	);

	if ($album_user_id == ALBUM_PUBLIC_GALLERY)
	{
		$message .= "<br /><br />" . sprintf($lang['Click_return_category'], "<a href=\"" . append_sid(album_append_uid("album_cat.$phpEx?cat_id=$cat_id")) . "\">", "</a>");
	}
	else
	{
		$message .= "<br /><br />" . sprintf($lang['Click_return_personal_gallery'], "<a href=\"" . append_sid(album_append_uid("album.$phpEx")) . "\">", "</a>");
	}

	$message .= "<br /><br />" . sprintf($lang['Click_return_album_index'], "<a href=\"" . append_sid(album_append_uid("album.$phpEx")) . "\">", "</a>");

	message_die(GENERAL_MESSAGE, $message);

}


// +------------------------------------------------------+
// |  Powered by Photo Album 2.x.x (c) 2002-2003 Smartor  |
// +------------------------------------------------------+

?>