<?php
/***************************************************************************
 *                             album_showpage.php
 *                            -------------------
 *   begin                : Wednesday, February 05, 2003
 *   copyright            : (C) 2003 Smartor
 *   email                : smartor_xp@hotmail.com
 *
 *   $Id: album_comment.php,v 2.0.8 2003/03/14 07:08:15 ngoctu Exp $
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
 *	 version            : 1.5.1
 *
 *	 MODIFICATIONS:
 *		-renamed page to album_showpage.php
 *		-combined rating and comment system to page
 *		-added smilies, user avatar, contact buttons and made layout have forum type look
 *		-made the page use midthumbnail...enabled/desabled via admin panel
 *		-and more tweaks..
 *
 *      - in 1.5.1 fixed a little problem with how pagenation works
 *
 ***************************************************************************/

if( isset($_GET['mode']) && $_GET['mode'] == 'smilies' )
{
	define('IN_PHPBB', true);
	$phpbb_root_path = './';
	include($phpbb_root_path . 'extension.inc');
	include($phpbb_root_path . 'common.' . $phpEx);
	include($phpbb_root_path . 'album_mod/clown_album_functions.' . $phpEx);

	generate_smilies_album('window', PAGE_ALBUM_PICTURE);
	exit;
}

define('IN_PHPBB', true);
define('IN_CASHMOD', true);
define('CM_VIEWTOPIC', true);
$phpbb_root_path = './';
$album_root_path = $phpbb_root_path . 'album_mod/';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/functions_validate.' . $phpEx);
include($phpbb_root_path . 'profilcp/functions_profile.'.$phpEx);

// Start session management
$userdata = session_pagestart($user_ip, PAGE_ALBUM_PICTURE);
init_userprefs($userdata);
// End session management

// Get general album information
include($album_root_path . 'album_common.' . $phpEx);
include_once($phpbb_root_path . 'album_mod/album_bbcode.' . $phpEx);

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
	if( isset($_GET['comment_id']) )
	{
		$comment_id = intval($_GET['comment_id']);
	}
	elseif( isset($_POST['comment_id']) )
	{
		$comment_id = intval($_POST['comment_id']);
	}
	else
	{
		message_die(GENERAL_ERROR, 'Bad request');
	}
}

// Midthumb & Full Pic
if( isset($_GET['full']) || isset($_POST['full']) )
{
	$picm = false;
	$full_size_param = '&amp;full=true';
}
else
{
	if ($album_config['midthumb_use'] == 1)
	{
		$picm = true;
		$full_size_param = '';
	}
	else
	{
		$picm = false;
		$full_size_param = '&amp;full=true';
	}
}

// ------------------------------------
// TEMPLATE ASSIGNEMENT
// ------------------------------------
if ((isset($_GET['slideshow']) && (intval($_GET['slideshow']) > 0)) || (isset($_POST['slideshow']) && (intval($_POST['slideshow']) > 0)))
{
	$gen_simple_header = true;
	$show_template = 'album_slideshow_body.tpl';
	$nuffimage_pic = ( $picm == false ) ? 'album_pic.' : 'album_picm.';
}
else
{
	//$show_template = 'album_showpage_body.tpl';
	if ( (isset($_GET['nuffimage']) || isset($_POST['nuffimage'])) & ($album_config['enable_nuffimage'] == 1) )
	{
		include($album_root_path . 'album_nuffimage_box.' . $phpEx);
		$template->assign_var_from_handle('NUFFIMAGE_BOX', 'nuffimage_box');
		$show_template = 'album_pic_nuffed_body.tpl';
		$nuffimage_vars = '&amp;nuffimage=true';
		$nuffimage_pic = 'album_pic_nuffed.';
		$nuff_http_full_string = $nuff_http['full_string'];
		$template->assign_block_vars('disable_pic_nuffed', array(
			'L_PIC_UNNUFFED_CLICK' => $lang['Nuff_UnClick'],
			'U_PIC_UNNUFFED_CLICK' => append_sid(album_append_uid("album_showpage." . $phpEx . "?pic_id=" . $pic_id . $full_size_param)),
			)
		);
	}
	else
	{
		$show_template = 'album_showpage_body.tpl';
		$nuffimage_vars = '';
		$nuffimage_pic = ( $picm == false ) ? 'album_pic.' : 'album_picm.';
		$nuff_http_full_string = '';
	}
}


// ------------------------------------
// PREVIOUS & NEXT
// ------------------------------------
if( isset($_GET['mode']) )
{
	//if( ($_GET['mode'] == 'next') && ($no_next_pic == false) )
	if($_GET['mode'] == 'next')
	{
		//$pic_id = $next_pic_id[0];
		$sql_where = 'AND n.pic_id > c.pic_id';
		$sql_order = 'ORDER BY n.pic_id ASC LIMIT 1';

	}

	//if( ($_GET['mode'] == 'prev') && ($no_prev_pic == false) )
	if($_GET['mode'] == 'prev')
	{
		//$pic_id = $prev_pic_id[0];
		$sql_where = 'AND n.pic_id < c.pic_id';
		$sql_order = 'ORDER BY n.pic_id DESC LIMIT 1';
	}

	$sql = "SELECT n.pic_id, n.pic_cat_id, n.pic_user_id, n.pic_time
			FROM ". ALBUM_TABLE ." as n, ". ALBUM_TABLE ." AS c
			WHERE c.pic_id = $pic_id
				$sql_where
				AND n.pic_cat_id = c.pic_cat_id
				$sql_order";
}
else
{
	$sql = "SELECT pic_id, pic_cat_id, pic_user_id, pic_time
			FROM ". ALBUM_TABLE ."
			WHERE pic_id = $pic_id";
}

if( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not query pic information', '', __LINE__, __FILE__, $sql);
}

$row = $db->sql_fetchrow($result);

if( empty($row) )
{
	message_die(GENERAL_ERROR, $lang['Pic_not_exist']);
}

$pic_id_old = $pic_id;
$pic_id_tmp = $row['pic_id'];
$pic_cat_id_tmp = $row['pic_cat_id'];
$pic_time_tmp = $row['pic_time'];
$pic_user_id_tmp = $row['pic_user_id'];
$db->sql_freeresult($result);

if( isset($_GET['mode']) )
{
	if ( ($_GET['mode'] == 'next') || ($_GET['mode'] == 'prev') )
	{
		$pic_id = $pic_id_tmp;
	}
}

if ($album_config['show_pics_nav'] == 1)
{
	$template->assign_block_vars('pics_nav', array(
		'L_PICS_NAV' => $lang['Pics_Nav'],
		'L_PICS_NAV_NEXT' => $lang['Pics_Nav_Next'],
		'L_PICS_NAV_PREV' => $lang['Pics_Nav_Prev'],
		)
	);
}
// NEXT
$sql = "SELECT pic_id, pic_time
		FROM " . ALBUM_TABLE . " AS a
		WHERE a.pic_id > " . $pic_id_tmp . "
			AND a.pic_cat_id = " . $pic_cat_id_tmp . "
			AND a.pic_approval = 1
		ORDER BY pic_id ASC LIMIT 2";

if( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not query pic information', '', __LINE__, __FILE__, $sql);
}

//$row = $db->sql_fetchrow($result);
$next_pic_count = $db->sql_numrows($result);
$next_pic_rows = $db->sql_fetchrowset($result);
$db->sql_freeresult($result);

if ($next_pic_count == 0)
{
	$no_next_pic = true;

	$sql = "SELECT pic_id
			FROM " . ALBUM_TABLE . " AS a
			WHERE a.pic_cat_id = " . $pic_cat_id_tmp . "
				AND a.pic_approval = 1
			ORDER BY pic_id ASC LIMIT 1";

	if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not query pic information', '', __LINE__, __FILE__, $sql);
	}

	$row = $db->sql_fetchrow($result);
	$first_pic_id = $row['pic_id'];
	$db->sql_freeresult($result);
}
else
{
	$no_next_pic = false;
	//for($i = 0; $i < $next_pic_count; $i++)
	for($i = $next_pic_count - 1; $i >= 0; $i--)
	{
		$next_pic_id[$i] = $next_pic_rows[$i]['pic_id'];
		$template->assign_block_vars('pics_nav.next', array(
			'U_PICS_THUMB' => append_sid(album_append_uid("album_thumbnail." . $phpEx . "?pic_id=" . $next_pic_id[$i])),
			'U_PICS_LINK' => append_sid(album_append_uid("album_showpage." . $phpEx . "?pic_id=" . $next_pic_id[$i] . $full_size_param . $nuffimage_vars)),
			)
		);
	}
}

//PREV
$sql = "SELECT pic_id, pic_time
		FROM " . ALBUM_TABLE . " AS a
		WHERE a.pic_id < " . $pic_id_tmp . "
			AND a.pic_cat_id = " . $pic_cat_id_tmp . "
			AND a.pic_approval = 1
		ORDER BY pic_id DESC LIMIT 2";

if( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not query pic information', '', __LINE__, __FILE__, $sql);
}

//$row = $db->sql_fetchrow($result);
$prev_pic_count = $db->sql_numrows($result);
$prev_pic_rows = $db->sql_fetchrowset($result);
$db->sql_freeresult($result);

if ($prev_pic_count == 0)
{
	$no_prev_pic = true;

	$sql = "SELECT pic_id
			FROM " . ALBUM_TABLE . " AS a
			WHERE a.pic_cat_id = " . $pic_cat_id_tmp . "
				AND a.pic_approval = 1
			ORDER BY pic_id DESC LIMIT 1";

	if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not query pic information', '', __LINE__, __FILE__, $sql);
	}

	$row = $db->sql_fetchrow($result);
	$last_pic_id = $row['pic_id'];
	$db->sql_freeresult($result);
}
else
{
	$no_prev_pic = false;
	for($i = 0; $i < $prev_pic_count; $i++)
	//for($i = $prev_pic_count - 1; $i >= 0; $i--)
	{
		$prev_pic_id[$i] = $prev_pic_rows[$i]['pic_id'];
		$template->assign_block_vars('pics_nav.prev', array(
			'U_PICS_THUMB' => append_sid(album_append_uid("album_thumbnail." . $phpEx . "?pic_id=" . $prev_pic_id[$i])),
			'U_PICS_LINK' => append_sid(album_append_uid("album_showpage." . $phpEx . "?pic_id=" . $prev_pic_id[$i] . $full_size_param . $nuffimage_vars)),
			)
		);
	}
}


// ------------------------------------
// IMAGES ARRAY
// SLIDESHOW SCRIPTS
// ------------------------------------
if ( $album_config['slideshow_script'] == 1 )
{
	$template->assign_block_vars('switch_slideshow_scripts', array());

	$pic_link = ( $picm == false ) ? 'album_pic.' : 'album_picm.';

	$sql = "SELECT *
			FROM " . ALBUM_TABLE . " AS a
			WHERE a.pic_cat_id = " . $pic_cat_id_tmp . "
				AND a.pic_approval = 1
			ORDER BY pic_id ASC";

	if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not query pic information', '', __LINE__, __FILE__, $sql);
	}

	$total_pic_count = $db->sql_numrows($result);
	$total_pic_rows = $db->sql_fetchrowset($result);
	$db->sql_freeresult($result);

	$pic_list = '';
	$tit_list = '';
	$des_list = '';

	for($i = 0; $i < $total_pic_count; $i++)
	{
		$pic_list .= 'Pic[' . $i . '] = \'' . append_sid(album_append_uid($pic_link . $phpEx . "?pic_id=" . $total_pic_rows[$i]['pic_id']), true) . '\'; ' . "\n";
		$tit_list .= 'Tit[' . $i . '] = \'' . $total_pic_rows[$i]['pic_title'] . '\'; ' . "\n";
		$des_list .= 'Des[' . $i . '] = \'' . $total_pic_rows[$i]['pic_desc'] . '\'; ' . "\n";
		/*
		$pic_list .= 'Pic[' . $i . '] = \'' . ALBUM_UPLOAD_PATH . $total_pic_rows[$i]['pic_filename'] . '\'; ' . "\n";
		*/
	}

	$template->assign_vars(array(
		'PIC_LIST' => $pic_list,
		'TIT_LIST' => $tit_list,
		'DES_LIST' => $des_list,
		)
	);
}


// ------------------------------------
// SPECIAL FX
// ------------------------------------
if ($album_config['enable_nuffimage'] == 1)
{
	$template->assign_block_vars('pic_nuffed_enabled', array(
		'L_PIC_NUFFED_CLICK' => $lang['Nuff_Click'],
		'U_PIC_NUFFED_CLICK' => append_sid(album_append_uid("album_showpage." . $phpEx . "?pic_id=" . $pic_id . $full_size_param . '&amp;nuffimage=true')),
		)
	);
}
else
{
	$template->assign_block_vars('switch_slideshow_no_scripts', array());
}


// ------------------------------------
// Get $pic_id from $comment_id
// ------------------------------------

if( isset($comment_id) && $album_config['comment'] == 1 )
{
	$sql = "SELECT comment_id, comment_pic_id
			FROM ". ALBUM_COMMENT_TABLE ."
			WHERE comment_id = '$comment_id'";

	if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not query comment and pic information', '', __LINE__, __FILE__, $sql);
	}

	$row = $db->sql_fetchrow($result);

	if( empty($row) )
	{
		message_die(GENERAL_ERROR, 'This comment does not exist');
	}

	$pic_id = $row['comment_pic_id'];
}

// ------------------------------------
// Get this pic info and current category info
// ------------------------------------

$sql = "SELECT p.*, ac.*, u.user_id, u.username, u.user_session_time, u.user_group_id, u.user_rank, r.rate_pic_id, AVG(r.rate_point) AS rating, COUNT( DISTINCT c.comment_id) AS comments_count
		FROM ". ALBUM_CAT_TABLE ." AS ac, ". ALBUM_TABLE ." AS p
			LEFT JOIN ". USERS_TABLE ." AS u ON p.pic_user_id = u.user_id
			LEFT JOIN ". ALBUM_COMMENT_TABLE ." AS c ON p.pic_id = c.comment_pic_id
			LEFT JOIN ". ALBUM_RATE_TABLE ." AS r ON p.pic_id = r.rate_pic_id
		WHERE pic_id = '$pic_id'
			AND ac.cat_id = p.pic_cat_id
		GROUP BY p.pic_id
		LIMIT 1";

if( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not query pic information', '', __LINE__, __FILE__, $sql);
}
$thispic = $db->sql_fetchrow($result);

$cat_id = ($thispic['pic_cat_id'] != 0) ? $thispic['pic_cat_id'] : $thispic['cat_id'];
$album_user_id = $thispic['cat_user_id'];

$total_comments = $thispic['comments_count'];
$comments_per_page = $board_config['posts_per_page'];

if( empty($thispic) )
{
	message_die(GENERAL_ERROR, $lang['Pic_not_exist'] . $lang['Nav_Separator'] . $pic_id);
}

// ------------------------------------
// Check the permissions
// ------------------------------------
$check_permissions = ALBUM_AUTH_VIEW|ALBUM_AUTH_RATE|ALBUM_AUTH_COMMENT|ALBUM_AUTH_EDIT|ALBUM_AUTH_DELETE;
$auth_data = album_permissions($album_user_id, $cat_id, $check_permissions, $thispic);

if ( $auth_data['view'] == 0 )
{
	if ( !$userdata['session_logged_in'] )
	{
		redirect(append_sid(LOGIN_MG . "?redirect=album_showpage.$phpEx&amp;pic_id=$pic_id"));
		exit;
	}
	else
	{
		message_die(GENERAL_ERROR, $lang['Not_Authorised']);
	}
}
// ------------------------------------
//RATING:  Additional Check: if this user already rated
// ------------------------------------

if( $userdata['session_logged_in'] )
{
	$sql = "SELECT *
			FROM ". ALBUM_RATE_TABLE ."
			WHERE rate_pic_id = '$pic_id'
				AND rate_user_id = '". $userdata['user_id'] ."'
			LIMIT 1";

	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not query rating information', '', __LINE__, __FILE__, $sql);
	}

	if ($db->sql_numrows($result) > 0)
	{
		$already_rated = true;
	}
	else
	{
		$already_rated = false;
	}
}
else
{
	$already_rated = false;
}

/*
+----------------------------------------------------------
| Main work here...
+----------------------------------------------------------
*/
album_read_tree($album_user_id);
$album_nav_cat_desc = album_make_nav_tree($cat_id, "album_cat.$phpEx", "nav" , $album_user_id);
if ($album_nav_cat_desc != '')
{
	$album_nav_cat_desc = ALBUM_NAV_ARROW . $album_nav_cat_desc;
}

if( !isset($_POST['comment']) && !isset($_POST['rating']) )
{
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
					Comments Screen
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

	// ------------------------------------
	// Get the comments thread
	// Beware: when this script was called with comment_id (without start)
	// ------------------------------------
	if ( $album_config['comment'] == 1 )
	{
		if( !isset($comment_id) )
		{
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
		}
		else
		{
			// We must do a query to co-ordinate this comment
			$sql = "SELECT COUNT(comment_id) AS count
					FROM ". ALBUM_COMMENT_TABLE ."
					WHERE comment_pic_id = $pic_id
						AND comment_id < $comment_id";

			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not obtain comments information from the database', '', __LINE__, __FILE__, $sql);
			}

			$row = $db->sql_fetchrow($result);

			if( !empty($row) )
			{
				$start = floor( $row['count'] / $comments_per_page ) * $comments_per_page;
			}
			else
			{
				$start = 0;
			}
		}

		if( isset($_GET['sort_order']) )
		{
			switch ($_GET['sort_order'])
			{
				case 'ASC':
					$sort_order = 'ASC';
					break;
				default:
					$sort_order = 'DESC';
			}
		}
		elseif( isset($_POST['sort_order']) )
		{
			switch ($_POST['sort_order'])
			{
				case 'ASC':
					$sort_order = 'ASC';
					break;
				default:
					$sort_order = 'DESC';
			}
		}
		else
		{
			$sort_order = 'ASC';
		}

		if ($total_comments > 0)
		{
			$template->assign_block_vars('coment_switcharo_top', array());
			
			$limit_sql = ($start == 0) ? $comments_per_page : $start .','. $comments_per_page;

			$sql = "SELECT c.*,u.*, u.user_id
				FROM ". ALBUM_COMMENT_TABLE ." AS c
					LEFT JOIN ". USERS_TABLE ." AS u ON c.comment_user_id = u.user_id
				WHERE c.comment_pic_id = '$pic_id'
				ORDER BY c.comment_id $sort_order
				LIMIT $limit_sql";

			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not obtain comments information from the database', '', __LINE__, __FILE__, $sql);
			}

			$commentrow = array();

			$buddy_userids = [];
			while( $row = $db->sql_fetchrow($result) )
			{
				$commentrow[] = $row;
				if ($row['user_id'] != ALBUM_GUEST && $row['username'] != '')
				{
					$buddy_userids[] = $row['user_id'];
				}
			}

			$buddys = [];
			if (!empty($userdata['user_logged_in']))
			{
				$sql = "SELECT * FROM " . BUDDYS_TABLE .
					" WHERE user_id = " . $userdata['user_id'] .
					" OR " . $db->sql_in_set('buddy_id', $buddys, false, true);
				$result = $db->sql_query($sql, false, false, 'Error fetching buddies', __LINE__, __FILE__);

				while ($row = $db->sql_fetchrow($result))
				{
					$buddys[ $row['buddy_id']	] = $row;
				}
				$db->sql_freeresult($result);
			}


			for ($i = 0; $i < count($commentrow); $i++)
			{
				if( ($commentrow[$i]['user_id'] == ALBUM_GUEST) || ($commentrow[$i]['username'] == '') )
				{
					$poster = ($commentrow[$i]['comment_username'] == '') ? $lang['Guest'] : $commentrow[$i]['comment_username'];
				}
				else
				{
					$poster = '<a href="'. append_sid("profile.$phpEx?mode=viewprofile&amp;". POST_USERS_URL .'='. $commentrow[$i]['user_id']) .'">'. $commentrow[$i]['username'] .'</a>';
				}

				if ($commentrow[$i]['comment_edit_count'] > 0)
				{
					$sql = "SELECT c.comment_id, c.comment_edit_user_id, u.user_id, u.username
							FROM ". ALBUM_COMMENT_TABLE ." AS c
								LEFT JOIN ". USERS_TABLE ." AS u ON c.comment_edit_user_id = u.user_id
							WHERE c.comment_id = '".$commentrow[$i]['comment_id']."'
							LIMIT 1";

					if( !$result = $db->sql_query($sql) )
					{
						message_die(GENERAL_ERROR, 'Could not obtain last edit information from the database', '', __LINE__, __FILE__, $sql);
					}

					$lastedit_row = $db->sql_fetchrow($result);

					$edit_info = ($commentrow[$i]['comment_edit_count'] == 1) ? $lang['Edited_time_total'] : $lang['Edited_times_total'];

					$edit_info = '<br /><br />&raquo;&nbsp;'. sprintf($edit_info, $lastedit_row['username'], create_date($board_config['default_dateformat'], $commentrow[$i]['comment_edit_time'], $board_config['board_timezone']), $commentrow[$i]['comment_edit_count']) .'<br />';
				}
				else
				{
					$edit_info = '';
				}

				$album_panel = '';
				if (isset($buddys[ $commentrow[$i]['user_id'] ]))
				{
					$rowbuddy = $buddys[ $commentrow[$i]['user_id'] ];
					$commentrow[$i]['user_friend']		= $rowbuddy['buddy_friend'];
					$commentrow[$i]['user_visible']		= $rowbuddy['buddy_visible'];
					$commentrow[$i]['user_my_friend']	= $rowbuddy['buddy_my_friend'];
					$commentrow[$i]['user_my_ignore']	= $rowbuddy['buddy_my_ignore'];
				}
				$commentrow[$i]['user_online']		= ( $commentrow[$i]['user_session_time'] >= (time()-300) );
				$commentrow[$i]['user_pm'] = 1;

				$album_panel	= pcp_output_panel('PHPBB.viewcomment.album', $commentrow[$i]);
				$buttons_panel	= pcp_output_panel('PHPBB.viewcomment.buttons', $commentrow[$i]);
			
				// Smilies
				global $bbcode;
				$html_on = ( $userdata['user_allowhtml'] && $board_config['allow_html'] ) ? 1 : 0 ;
				$bbcode_on = ( $userdata['user_allowbbcode'] && $board_config['allow_bbcode'] ) ? 1 : 0 ;
				$smilies_on = ( $userdata['user_allowsmile'] && $board_config['allow_smilies'] ) ? 1 : 0 ;
				$bbcode->allow_html = $html_on;
				$bbcode->allow_bbcode = $bbcode_on;
				$bbcode->allow_smilies = $smilies_on;
				
				// V: TODO this somehow gets double encoded? We probably need to do something when saving
				$commentrow[$i]['comment_text'] = $bbcode->parse($commentrow[$i]['comment_text']);
				
				$template->assign_block_vars('commentrow', array(
					'ID' => $commentrow[$i]['comment_id'],
					'PANEL_INFO' => $album_panel,
					'AUTHOR_PANEL'	=> !empty($commentrow[$i]['user_my_ignore']) ? $ignore_panel : $album_panel,
					'BUTTONS_PANEL'	=> $buttons_panel,
					'IGNORE_IMG'	=> ( isset($ignore_buttons) ? $ignore_buttons : '' ),
					'MINI_POST_IMG' => $images['icon_minipost'],
					'U_MINI_POST' => 'album_showpage.' . $phpEx . '?pic_id=' . $pic_id .'#'. $commentrow[$i]['comment_id'],
					'POSTER_NAME' => $poster,
					'TIME' => create_date($board_config['default_dateformat'], $commentrow[$i]['comment_time'], $board_config['board_timezone']),
					'IP' => ($userdata['user_level'] == ADMIN) ? '<a href="http://www.nic.com/cgi-bin/whois.cgi?query=' . decode_ip($commentrow[$i]['comment_user_ip']) . '" target="_blank">' . decode_ip($commentrow[$i]['comment_user_ip']) .'</a><br />' : '',

					'TEXT' => $commentrow[$i]['comment_text'],
					'EDIT_INFO' => $edit_info,

					'EDIT' => ( ( $auth_data['edit'] && ($commentrow[$i]['comment_user_id'] == $userdata['user_id']) ) || ($auth_data['moderator'] && ($thispic['cat_edit_level'] != ALBUM_ADMIN) ) || ($userdata['user_level'] == ADMIN) ) ? '<a href="'. append_sid(album_append_uid("album_comment_edit.$phpEx?comment_id=". $commentrow[$i]['comment_id'])) .'"><img src="' . $images['icon_edit'] . '" alt="' . $lang['Edit_delete_post'] . '" title="' . $lang['Edit_delete_post'] . '" border="0" /></a>' : '',

					'DELETE' => ( ( $auth_data['delete'] && ($commentrow[$i]['comment_user_id'] == $userdata['user_id']) ) || ($auth_data['moderator'] && ($thispic['cat_delete_level'] != ALBUM_ADMIN) ) || ($userdata['user_level'] == ADMIN) ) ? '<a href="'. append_sid(album_append_uid("album_comment_delete.$phpEx?comment_id=". $commentrow[$i]['comment_id'])) .'"><img src="' . $images['icon_delpost'] . '" alt="' . $lang['Delete_post'] . '" title="' . $lang['Delete_post'] . '" border="0" /></a>' : ''

					)
				);
			}

			$template->assign_block_vars('switch_comment', array());

			$template->assign_vars(array(
				'PAGINATION' => generate_pagination(append_sid(album_append_uid("album_showpage.$phpEx?pic_id=$pic_id&amp;sort_order=$sort_order")), $total_comments, $comments_per_page, $start),
				'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $comments_per_page ) + 1 ), ceil( $total_comments / $comments_per_page ))
				)
			);
			$template->assign_block_vars('coment_switcharo_bottom', array());
		}
	}

	// Start output of page
	$page_title = $lang['Album'];

	include($phpbb_root_path . 'includes/page_header.'.$phpEx);
	$template->set_filenames(array(
		'body' => $show_template)
	);

	if( ($thispic['pic_user_id'] == ALBUM_GUEST) || ($thispic['username'] == '') )
	{
		$poster = ($thispic['pic_username'] == '') ? $lang['Guest'] : $thispic['pic_username'];
	}
	else
	{
		$username = $agcm_color->get_user_color($thispic['user_group_id'], $thispic['user_session_time'], $thispic['username']);
		$poster = '<a href="'. append_sid("profile.$phpEx?mode=viewprofile&amp;". POST_USERS_URL .'='. $thispic['user_id']) .'">' . $username . '</a>';
	}

	//---------------------------------
	// Comment Posting Form
	//---------------------------------
	
	if ( $auth_data['comment'] == 1 && $album_config['comment'] == 1 )
	{
		$template->assign_block_vars('switch_comment_post', array());

		if( !$userdata['session_logged_in'] )
		{
			$template->assign_block_vars('switch_comment_post.logout', array());
		}
		//begin shows smilies
		$max_smilies = 20;

		$sql = 'SELECT emoticon, code, smile_url
						FROM ' . SMILIES_TABLE . '
						ORDER BY smilies_id LIMIT ' . $max_smilies;

		if (!$result = $db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, "Couldn't retrieve smilies list", '', __LINE__, __FILE__, $sql);
		}
		$smilies_count = $db->sql_numrows($result);
		$smilies_data = $db->sql_fetchrowset($result);

		for ($i = 1; $i < $smilies_count+1; $i++)
		{
			$template->assign_block_vars('switch_comment_post.smilies', array(
					'CODE' => $smilies_data[$i - 1]['code'],
					'URL' => $board_config['smilies_path'] . '/' . $smilies_data[$i - 1]['smile_url'],
					'DESC' => $smilies_data[$i - 1]['emoticon']
				)
			);

			if ( is_integer($i / 5) )
			{
				$template->assign_block_vars('switch_comment_post.smilies.new_col', array());
			}
		}
	}
	
	// Rating System
	if ( $album_config['rate'] == 1 )
	{
		$image_rating = ImageRating($thispic['rating']);
		$template->assign_block_vars('rate_switch', array());

		if ( $auth_data['rate'] == 1 && !$already_rated )
		{
			$template->assign_block_vars('rate_switch.rate_row', array());
			for ( $i = 0; $i < $album_config['rate_scale']; $i++ )
			{
				$template->assign_block_vars('rate_switch.rate_row.rate_scale_row', array(
					'POINT' => ($i + 1)
					)
				);
			}
		}
	}

	// Mighty Gorgon - Slideshow - BEGIN
	if ( ((isset($_GET['slideshow']) && (intval($_GET['slideshow']) > 0)) || (isset($_POST['slideshow']) && (intval($_POST['slideshow']) > 0))) )
	{
		$template->assign_block_vars('switch_slideshow', array());
		$slideshow_delay = (isset($_GET['slideshow']) ? intval($_GET['slideshow']) : intval($_POST['slideshow']));
		$slideshow_select = '';
		$slideshow_onoff = $lang['Slideshow_Off'];
		$slideshow_link = append_sid(album_append_uid("album_showpage." . $phpEx . "?pic_id=" . $pic_id));
		$slideshow_link_full = '<a href="' . $slideshow_link . '">' . $lang['Slideshow_Off'] . '</a>';
		$next_pic = ($no_next_pic == false) ? '<a href="' . append_sid(album_append_uid("album_showpage." . $phpEx . "?pic_id=" . $pic_id . $full_size_param . "&amp;mode=next&amp;slideshow=" . $slideshow_delay)) . '#TopPic"><img src="' . $images['icon_right_arrow3'] . '" title="' . $lang['Next_Pic'] . '" border="0" alt="' . $lang['Next_Pic'] . '" align="absmiddle" /></a>' : '';
		$prev_pic = ($no_prev_pic == false) ? '<a href="' . append_sid(album_append_uid("album_showpage." . $phpEx . "?pic_id=" . $pic_id . $full_size_param . "&amp;mode=prev&amp;slideshow=" . $slideshow_delay)) . '#TopPic"><img src="' . $images['icon_left_arrow3'] . '" title="' . $lang['Prev_Pic'] . '" border="0" alt="' . $lang['Prev_Pic'] . '" align="absmiddle" /></a>' : '';
		$next_pic_url = ($no_next_pic == false) ? append_sid(album_append_uid("album_showpage." . $phpEx . "?pic_id=" . $pic_id . $full_size_param . "&amp;mode=next&amp;slideshow=" . $slideshow_delay)) . "#TopPic" : append_sid(album_append_uid("album_showpage." . $phpEx . "?pic_id=" . $first_pic_id . $full_size_param)) . "#TopPic";
		$prev_pic_url = ($no_prev_pic == false) ? append_sid(album_append_uid("album_showpage." . $phpEx . "?pic_id=" . $pic_id . $full_size_param . "&amp;mode=prev&amp;slideshow=" . $slideshow_delay)) . "#TopPic" : append_sid(album_append_uid("album_showpage." . $phpEx . "?pic_id=" . $last_pic_id . $full_size_param)) . "#TopPic";
	}
	else
	{
		if ($album_config['show_slideshow'] == 1)
		{
			$template->assign_block_vars('switch_slideshow_enabled', array());
		}
		//$slideshow_delay = 5;
		$slideshow_select = $lang['Slideshow_Delay'] . ':&nbsp;';
		$slideshow_select .= '<select name="slideshow">';
		$slideshow_select .= '<option value="1">1 Sec</option>';
		$slideshow_select .= '<option value="3">3 Sec</option>';
		$slideshow_select .= '<option value="5" selected="selected">5 Sec</option>';
		$slideshow_select .= '<option value="7">7 Sec</option>';
		$slideshow_select .= '<option value="10">10 Sec</option>';
		$slideshow_select .= '</select>&nbsp;';
		$slideshow_onoff = $lang['Slideshow_On'];
		//$slideshow_link = append_sid(album_append_uid("album_showpage." . $phpEx . "?pic_id=" . $pic_id . "&amp;full=true&amp;slideshow=" . $slideshow_delay));
		$slideshow_link = append_sid(album_append_uid("album_showpage." . $phpEx . "?pic_id=" . $pic_id . "&amp;full=true"));
		$slideshow_link_full = '<a href="' . $slideshow_link . '">' . $lang['Slideshow_On'] . '</a>';
		$next_pic = ($no_next_pic == false) ? '<a href="' . append_sid(album_append_uid("album_showpage." . $phpEx . "?pic_id=" . $pic_id . $full_size_param . "&amp;mode=next" . $nuffimage_vars)) . '#TopPic"><img src="' . $images['icon_left_arrow3'] . '" title="' . $lang['Next_Pic'] . '" border="0" alt="' . $lang['Next_Pic'] . '" align="absmiddle" /></a>' : '';
		$prev_pic = ($no_prev_pic == false) ? '<a href="' . append_sid(album_append_uid("album_showpage." . $phpEx . "?pic_id=" . $pic_id . $full_size_param . "&amp;mode=prev" . $nuffimage_vars)) . '#TopPic"><img src="' . $images['icon_right_arrow3'] . '" title="' . $lang['Prev_Pic'] . '" border="0" alt="' . $lang['Prev_Pic'] . '" align="absmiddle" /></a>' : '';
	}

	$slideshow_refresh = $slideshow_refresh_meta = '';
	if ( $album_config['slideshow_script'] == 1 )
	{
		$slideshow_refresh = '</body><body onload="runSlideShow()">';
	}
	else if (!empty($slideshow_delay) && !empty($next_pic_url)) // V: can this ever be present?
	{
		$slideshow_refresh = '</body><head><meta http-equiv="refresh" content="' . $slideshow_delay .  ';url=' . $next_pic_url . '"></head><body>';
		$slideshow_refresh_meta = '<meta http-equiv="refresh" content="' . $slideshow_delay .  ';url=' . $next_pic_url . '">';
	}
	// Mighty Gorgon - Slideshow - END

	// Mighty Gorgon - Pic Size - BEGIN
	$pic_size = @getimagesize(ALBUM_UPLOAD_PATH . $thispic['pic_filename']);
	$pic_width = $pic_size[0];
	$pic_height = $pic_size[1];
	$pic_filesize = filesize(ALBUM_UPLOAD_PATH . $thispic['pic_filename']);
	// Mighty Gorgon - Pic Size - END

	$template->assign_vars(array(
		'CAT_TITLE' => $thispic['cat_title'],
		'U_VIEW_CAT' => append_sid(album_append_uid("album_cat.$phpEx?cat_id=$cat_id")),
		'ALBUM_NAVIGATION_ARROW' => ALBUM_NAV_ARROW,
		'NAV_CAT_DESC' => $album_nav_cat_desc,

		'U_PIC' => append_sid(album_append_uid($nuffimage_pic . $phpEx . "?pic_id=" . $pic_id . $full_size_param . $nuff_http_full_string)),
		'U_PIC_L1' => ( $picm == false ) ? '' : '<a href="album_showpage.' . $phpEx . '?full=true&pic_id=' . $pic_id . $nuffimage_vars . '">',
		'U_PIC_L2' => ( $picm == false ) ? '' : '</a>',
		'U_PIC_CLICK' => ( $picm == false ) ? '' : $lang['Click_enlarge'],
		'U_PIC_THUMB' => append_sid(album_append_uid("album_thumbnail." . $phpEx . "?pic_id=" . $pic_id)),

		'NEXT_PIC' => $next_pic,
		'PREV_PIC' => $prev_pic,

		// Mighty Gorgon - Slideshow - BEGIN
		'L_SLIDESHOW' => $lang['Slideshow'],
		'L_SLIDESHOW_DELAY' => $lang['Slideshow_Delay'],
		'L_SLIDESHOW_ONOFF' => $slideshow_onoff,
		'SLIDESHOW_SELECT' => $slideshow_select,
		'SLIDESHOW_DELAY' => ( isset($slideshow_delay) ? $slideshow_delay : '' ),
		'U_SLIDESHOW' => $slideshow_link,
		'U_SLIDESHOW_FULL' => $slideshow_link_full,
		'U_SLIDESHOW_REFRESH' => $slideshow_refresh,
		'U_SLIDESHOW_REFRESH_META' => $slideshow_refresh_meta,
		// Mighty Gorgon - Slideshow - END

		// Mighty Gorgon - Pic Size - BEGIN
		'L_PIC_DETAILS' => $lang['Pic_Details'],
		'L_PIC_SIZE' => $lang['Pic_Size'],
		'L_PIC_TYPE' => $lang['Pic_Type'],
		'PIC_SIZE' => $pic_width . ' x ' . $pic_height . ' (' . intval($pic_filesize/1024) . 'KB)',
		'PIC_TYPE' => strtoupper(substr($thispic['pic_filename'], strlen($thispic['pic_filename']) - 3, 3)),
		// Mighty Gorgon - Pic Size - END

		'PIC_RATING' => $image_rating . ( $already_rated ? ('&nbsp;(' . $lang['Already_rated'] . ')') : ''),
		
		'PIC_ID' => $pic_id,
		'PIC_BBCODE' => '[albumimg]' . $pic_id . '[/albumimg]',
		'PIC_TITLE' => $thispic['pic_title'],
		'PIC_DESC' => nl2br($thispic['pic_desc']),

		'POSTER' => $poster,

		'PIC_TIME' => create_date($board_config['default_dateformat'], $thispic['pic_time'], $board_config['board_timezone']),
		'PIC_VIEW' => $thispic['pic_view_count'],
		'PIC_COMMENTS' => $total_comments,

		'TARGET_BLANK' => ($album_config['fullpic_popup']) ? 'target="_blank"' : '',

		'L_PIC_ID' => $lang['Pic_ID'],
		'L_PIC_BBCODE' => $lang['Pic_BBCode'],
		'L_PIC_TITLE' => $lang['Pic_Image'],
		'L_PIC_DESC' => $lang['Pic_Desc'],
		'L_POSTER' => $lang['Pic_Poster'],
		'L_POSTED' => $lang['Posted'],
		'L_VIEW' => $lang['View'],
		'L_COMMENTS' => $lang['Comments'],
		'L_RATING' => $lang['Rating'],

		'L_POST_YOUR_COMMENT' => $lang['Post_your_comment'],
		'L_MESSAGE' => $lang['Message'],
		'L_USERNAME' => $lang['Username'],
		'L_COMMENT_NO_TEXT' => $lang['Comment_no_text'],
		'L_COMMENT_TOO_LONG' => $lang['Comment_too_long'],
		'L_MAX_LENGTH' => $lang['Max_length'],
		'S_MAX_LENGTH' => $album_config['desc_length'],

		'L_ORDER' => $lang['Order'],
		'L_SORT' => $lang['Sort'],
		'L_ASC' => $lang['Sort_Ascending'],
		'L_DESC' => $lang['Sort_Descending'],
		'L_BACK_TO_TOP' => $lang['Back_to_top'],

		'SORT_ASC' => ($sort_order == 'ASC') ? 'selected="selected"' : '',
		'SORT_DESC' => ($sort_order == 'DESC') ? 'selected="selected"' : '',

		'L_SUBMIT' => $lang['Submit'],

		'S_ALBUM_ACTION' => append_sid(album_append_uid('album_showpage.' . $phpEx . '?pic_id=' . $pic_id)),
		
		// Rating
		'S_RATE_MSG' => ( !$userdata['session_logged_in'] && $auth_data['rate'] == 0 ) ? $lang['Login_To_Vote'] : ( ( $already_rated ) ? $lang['Already_rated'] : $lang['Please_Rate_It'] ),
		'L_CURRENT_RATING' => $lang['Current_Rating'],
		'L_PLEASE_RATE_IT' => $lang['Please_Rate_It']
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
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
				Comment Or Rate Submited
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

	// ------------------------------------
	// Check the permissions: COMMENT
	// ------------------------------------

	if ( $album_config['comment'] == 0 && $album_config['rate'] == 0 )
	{
		message_die(GENERAL_ERROR, $lang['Not_Authorised']);
	}
	if ( $auth_data['comment'] == 0 && $auth_data['rate'] == 0 )
	{
		if ( !$userdata['session_logged_in'] )
		{
			redirect(append_sid(LOGIN_MG . "?redirect=album_showpage.$phpEx&amp;pic_id=$pic_id"));
		}
		else
		{
			message_die(GENERAL_ERROR, $lang['Not_Authorised']);
		}
	}

	// Comment System
	if ( $album_config['comment'] == 1 && $auth_data['comment'] == 1 )
	{
		$comment_text = str_replace("\'", "''", htmlspecialchars(substr(trim($_POST['comment']), 0, $album_config['desc_length'])));

		$comment_username = (!$userdata['session_logged_in']) ? str_replace("\'", "''", substr(htmlspecialchars(trim($_POST['comment_username'])), 0, 32)) : str_replace("'", "''", htmlspecialchars(trim($userdata['username'])));

		// Check Pic Locked
		if( ($thispic['pic_lock'] == 1) && (!$auth_data['moderator']) )
		{
			message_die(GENERAL_ERROR, $lang['Pic_Locked']);
		}

		// Check username for guest posting
		if (!$userdata['session_logged_in'])
		{
			if ($comment_username != '')
			{
				$result = validate_username($comment_username);
				if ( $result['error'] )
				{
					message_die(GENERAL_MESSAGE, $result['error_msg']);
				}
			}
		}


		// Prepare variables
		$comment_time = time();
		$comment_user_id = $userdata['user_id'];
		$comment_user_ip = $userdata['session_ip'];

		// Get $comment_id
		$sql = "SELECT MAX(comment_id) AS max
				FROM ". ALBUM_COMMENT_TABLE;

		if( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not found comment_id', '', __LINE__, __FILE__, $sql);
		}

		$row = $db->sql_fetchrow($result);

		$comment_id = $row['max'] + 1;

		// Insert into DB
		// If user only rated, but didn't enter a comment... only update rating
		if ( $comment_text != '' )
		{
			$sql = "INSERT INTO ". ALBUM_COMMENT_TABLE ." (comment_id, comment_pic_id, comment_cat_id, comment_user_id, comment_username, comment_user_ip, comment_time, comment_text)
					VALUES ('$comment_id', '$pic_id', '$cat_id', '$comment_user_id', '$comment_username', '$comment_user_ip', '$comment_time', '$comment_text')";
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not insert new entry', '', __LINE__, __FILE__, $sql);
			}
		}
	}
	
	// Rating System
	if ( ($album_config['rate'] == 1) && ($auth_data['rate'] == 1) && ($userdata['session_logged_in']) )
	{
		// Check Pic Locked
		if( ($thispic['pic_lock'] == 1) && (!$auth_data['moderator']) )
		{
			message_die(GENERAL_ERROR, $lang['Pic_Locked']);
		}

		//$rate_point = intval($_POST['rating']);
		
		if (isset($_POST['rating']))
		{
			$rate_point = intval($_POST['rating']);
		}
		elseif (isset($_GET['rating']))
		{
			$rate_point = intval($_GET['rating']);
		}
		else
		{
			$rate_point = -1;
		}

		if ($rate_point != -1)//if user didnt vote, dont update database
		{
			if( ($rate_point <= 0) || ($rate_point > $album_config['rate_scale']) )
			{
				message_die(GENERAL_ERROR, 'Bad submitted value - ' . $rate_point);
			}

			$rate_user_id = $userdata['user_id'];
			$rate_user_ip = $userdata['session_ip'];
			
			$sql = "INSERT INTO ". ALBUM_RATE_TABLE ." (rate_pic_id, rate_user_id, rate_user_ip, rate_point)
					VALUES ('$pic_id', '$rate_user_id', '$rate_user_ip', '$rate_point')";

			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not insert new rating', '', __LINE__, __FILE__, $sql);
			}
		}
	}

	// --------------------------------
	// Complete... now send a message to user
	// --------------------------------

	$template->assign_vars(array(
		'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid(album_append_uid("album_showpage.$phpEx?pic_id=$pic_id")) . '">'
		)
	);

	$message = $lang['Stored'] . "<br /><br />" . sprintf($lang['Click_view_message'], "<a href=\"" . append_sid(album_append_uid("album_showpage.$phpEx?pic_id=$pic_id ")) . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_album_index'], "<a href=\"" . append_sid(album_append_uid("album.$phpEx")) . "\">", "</a>");

	message_die(GENERAL_MESSAGE, $message);
}


// +-------------------------------------------------------------+
// |  Powered by Photo Album 2.x.x (c) 2002-2003 Smartor         |
// |  with Volodymyr (CLowN) Skoryk's Service Pack 1 © 2003-2004 |
// +-------------------------------------------------------------+
?>
