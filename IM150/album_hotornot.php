<?php
/***************************************************************************
 *                             album_hotornot.php
 *                            -------------------
 *   started            : Saturday, January 18, 2004
 *   copyright          : © Volodymyr (CLowN) Skoryk
 *   email              : blaatimmy72@yahoo.com
 *	 version            : 1.5
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

include($album_root_path . 'album_common.'.$phpEx);

if ( isset($HTTP_POST_VARS['hon_rating']) )
{
	$rate_point = intval($HTTP_POST_VARS['hon_rating']);
}
elseif ( isset($HTTP_GET_VARS['hon_rating']) )
{
	$rate_point = intval($HTTP_GET_VARS['hon_rating']);
}
else
{
	$rate_point = 0;
}

//if user havent rated a picture, show page, else update database
if ($rate_point < 1 || $rate_point > 10)
{
	// ------------------------------------
	// get a random pic from album
	// ------------------------------------
	if ($album_config['hon_rate_where'] == '')
	{
		$sql = "SELECT `pic_id`  FROM " . ALBUM_TABLE . " ORDER BY RAND() LIMIT 1";
	}
	else
	{
		$sql = "SELECT `pic_id`  FROM " . ALBUM_TABLE . " WHERE pic_cat_id IN (" . $album_config['hon_rate_where'] . ") ORDER BY RAND() LIMIT 1";
	}
	
	if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not query pic information', '', __LINE__, __FILE__, $sql);
	}
	$pic_id_temp = $db->sql_fetchrow($result);
	$pic_id = $pic_id_temp['pic_id'];


	// ------------------------------------
	// Get this pic info and current category info
	// ------------------------------------
	$rating_from = ($album_config['hon_rate_sep'] == 1) ? 'AVG(r.rate_hon_point) AS rating' : 'AVG(r.rate_point) AS rating';

	//--- Album Category Hierarchy : begin
	//--- version : <= 1.1.0
	$sql = "SELECT p.*, cat.*,  u.user_id, u.username, r.rate_pic_id, " . $rating_from . ", COUNT(DISTINCT c.comment_id) AS comments
			FROM ". ALBUM_CAT_TABLE ."  AS cat, ". ALBUM_TABLE ." AS p
				LEFT JOIN ". USERS_TABLE ." AS u ON p.pic_user_id = u.user_id
				LEFT JOIN ". ALBUM_RATE_TABLE ." AS r ON p.pic_id = r.rate_pic_id
				LEFT JOIN ". ALBUM_COMMENT_TABLE ." AS c ON p.pic_id = c.comment_pic_id
			WHERE pic_id = '$pic_id'
				AND cat.cat_id = p.pic_cat_id
			GROUP BY p.pic_id";
	//--- Album Category Hierarchy : end

	if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not query pic information', '', __LINE__, __FILE__, $sql);
	}
	$thispic = $db->sql_fetchrow($result);

	$cat_id = $thispic['pic_cat_id'];
	$album_user_id = $thispic['cat_user_id'];

	if( empty($thispic) or !file_exists(ALBUM_UPLOAD_PATH . $pic_filename) )
	{
		message_die(GENERAL_ERROR, $lang['Pic_not_exist']);
	}

	// ------------------------------------
	// Check the permissions
	// ------------------------------------
	if ($album_config['hon_rate_users'] == 0)
	{
		$album_user_access = album_permissions($album_user_id, $cat_id, ALBUM_AUTH_VIEW, $thispic);

		if ($album_user_access['view'] == 0)
		{
			if (!$userdata['session_logged_in'])
			{
				redirect(append_sid(LOGIN_MG . "?redirect=album_hotornot.$phpEx"));
			}
			else
			{
				message_die(GENERAL_ERROR, $lang['Not_Authorised']);
			}
		}
	}



	// ------------------------------------
	// Check Pic Approval
	// ------------------------------------

	if ($userdata['user_level'] != ADMIN)
	{
		if( ($thiscat['cat_approval'] == ADMIN) or (($thiscat['cat_approval'] == MOD) and !$album_user_access['moderator']) )
		{
			if ($thispic['pic_approval'] != 1)
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

	//
	// Start output of page
	//
	$page_title = $lang['Album'];
	include($phpbb_root_path . 'includes/page_header.'.$phpEx);

	$template->set_filenames(array(
		'body' => 'album_hon.tpl')
	);

	if( ($thispic['pic_user_id'] == ALBUM_GUEST) or ($thispic['username'] == '') )
	{
		$poster = ($thispic['pic_username'] == '') ? $lang['Guest'] : $thispic['pic_username'];
	}
	else
	{
		$poster = '<a href="'. append_sid("profile.$phpEx?mode=viewprofile&amp;". POST_USERS_URL .'='. $thispic['user_id']) .'">'. $thispic['username'] .'</a>';
	}

	//deside how user wants to show their rating
	$image_rating = ImageRating($thispic['rating']);
		
	//hot or not rating
	if ( CanRated($pic_id, $userdata['user_id']))
	{
		$template->assign_block_vars('hon_rating', array());	
			
		for ($i = 0; $i < $album_config['rate_scale']; $i++)
		{
			$template->assign_block_vars('hon_rating.hon_row', array(
				'VALUE' => ($i + 1)));
		}
	}
	else
	{
		$template->assign_block_vars('hon_rating_cant', array());
	}
	
	$template->assign_vars(array(
		'CAT_TITLE' => $thiscat['cat_title'],
		'U_VIEW_CAT' => append_sid(album_append_uid("album_cat.$phpEx?cat_id=$cat_id")),

		'U_PIC' => append_sid(album_append_uid("album_pic.$phpEx?pic_id=$pic_id")),

		'PIC_TITLE' => $thispic['pic_title'],
		'PIC_DESC' => nl2br($thispic['pic_desc']),

		'POSTER' => $poster,

		'PIC_TIME' => create_date($board_config['default_dateformat'], $thispic['pic_time'], $board_config['board_timezone']),

		'PIC_VIEW' => $thispic['pic_view_count'],

		'PIC_RATING' => $image_rating,

		'PIC_COMMENTS' => $thispic['comments'],

		'U_COMMENT' => append_sid(album_append_uid("album_showpage.$phpEx?pic_id=$pic_id")),
		
		'PIC_ID' => $pic_id,
		'PICTURE_ID' => $pic_id,

		'L_PLEASE_RATE_IT' => $lang['Please_Rate_It'],
		'L_ALREADY_RATED' => $lang['Already_rated'],

		'L_PIC_ID' => $lang['Pic_ID'],
		'L_RATING' => $lang['Rating'],
		'L_PIC_TITLE' => $lang['Pic_Title'] . $album_config['clown_rateType'],
		'L_PIC_DESC' => $lang['Pic_Desc'],
		'L_POSTER' => $lang['Pic_Poster'],
		'L_POSTED' => $lang['Posted'],
		'L_VIEW' => $lang['View'],
		'L_COMMENTS' => $lang['Comments'])
	);

	if ($album_config['rate'])
	{
		$template->assign_block_vars('rate_switch', array());
	}

	if ($album_config['comment'])
	{
		$template->assign_block_vars('comment_switch', array());
	}

	//
	// Generate the page
	//
	$template->pparse('body');

	include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
}
else
{
	$rate_user_id = $userdata['user_id'];
	$rate_user_ip = $userdata['session_ip'];
	$pic_id = ( isset($HTTP_POST_VARS['pic_id']) || isset($HTTP_GET_VARS['pic_id']) ) ? (isset($HTTP_POST_VARS['pic_id'])) ? $HTTP_POST_VARS['pic_id'] : $HTTP_GET_VARS['pic_id'] : 0;
		
	if ($album_config['hon_rate_sep'] == 1)
	{
		$sql = "INSERT INTO ". ALBUM_RATE_TABLE ." (rate_pic_id, rate_user_id, rate_user_ip, rate_hon_point)
				VALUES ('$pic_id', '$rate_user_id', '$rate_user_ip', '$rate_point')";
	}
	else
	{
		$sql = "INSERT INTO ". ALBUM_RATE_TABLE ." (rate_pic_id, rate_user_id, rate_user_ip, rate_point)
				VALUES ('$pic_id', '$rate_user_id', '$rate_user_ip', '$rate_point')";
	}
	
	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not insert new rating', '', __LINE__, __FILE__, $sql);
	}
	
	// --------------------------------
	// Complete... now send a message to user
	// --------------------------------

	$template->assign_vars(array(
		'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid(album_append_uid("album_hotornot.$phpEx")) . '">')
	);
	$message = "Your rating has been entered successfully.<br /><br />To rate more pictures click <a href='append_sid(album_append_uid('album_hotornot.$phpEx'))'>here</a> to do so.<br /><br />" . sprintf($lang['Click_return_album_index'], "<a href=\"" . append_sid(album_append_uid("album.$phpEx")) . "\">", "</a>");
	message_die(GENERAL_MESSAGE, $message);
}


// +-------------------------------------------------------------+
// |  Powered by Photo Album 2.x.x (c) 2002-2003 Smartor         |
// |  with Volodymyr (CLowN) Skoryk's Service Pack 1 © 2003-2004 |
// +-------------------------------------------------------------+

?>