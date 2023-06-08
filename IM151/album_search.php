<?php
/***************************************************************************
 *                            album_search.php
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

 /***************************************************************************
 *
 *   Change Log:
 *
 *		1.5.0
 *			-fixed bug in searching personal galleries
 *
 *		1.4.0
 *			-made search of personal galleries possible
 *
 *		1.3.0
 *			-totally rewrote search.php and templet file to use phpbbs
 *			 template system
 *			-fixed bug in mysql query line
 *			-implemented use of $_GET and $_POST
 *
 *		1.2.0
 *			-fixed session problem,and php opening tag before comments bug
 *
 *		1.1.0
 *			-fixed bug were username and picture name were rewerced in the
 *			 template
 *
 *		1.0.0
 *			-initial release
 *
 ***************************************************************************/

define('IN_PHPBB', true);
$phpbb_root_path = './';
$album_root_path = $phpbb_root_path . 'album_mod/';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

// Start session management
//
	$userdata = session_pagestart($user_ip, PAGE_ALBUM);
	init_userprefs($userdata);
//
// End session management


	$page_title = $lang['Search'];	
	include($phpbb_root_path . 'includes/page_header.'.$phpEx);

	$template->set_filenames(array(
		'body' => 'album_search_body.tpl')
	);
	include($album_root_path . 'album_common.'.$phpEx);
	
	if (( isset($_POST['search']) || isset($_GET['search']) ) && ( $_POST['search'] != '' || $_GET['search'] != '' ))
	{
		$template->assign_block_vars('switch_search_results', array());
		
		if ( isset($_POST['mode']) )
		{
			$m = $_POST['mode'];
		}
		elseif ( isset($_GET['mode']) )
		{
			$m = $_GET['mode'];
		}
		else
		{
			message_die(GENERAL_ERROR, 'Bad request');
		}
			
		if ( isset($_POST['search']) )
		{
			$s = $_POST['search'];
		}
		elseif ( isset($_GET['search']) )
		{
			$s = $_GET['search'];
		}
			
		if ($m == 'user')
		{
			$where = 'p.pic_username';
		}
		elseif ($m == 'name')
		{
			$where = 'p.pic_title';
		}
		elseif ($m == 'desc')
		{
			$where = 'p.pic_desc';
		}
		else
		{
			message_die(GENERAL_ERROR, 'Bad request');
		}
		
		// --------------------------------
		// Pagination
		// --------------------------------

		// Number of matches displayed
		$pics_per_page = $album_config['rows_per_page'] * $album_config['cols_per_page'];
		if ($pics_per_page == 0)
		{
			$pics_per_page = 20;
		}
		//$pics_per_page = 4;
		
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

		// ------------------------------------
		// Count pic matches
		// ------------------------------------

		if ( ($album_config['personal_gallery_view'] == -1) || ($userdata['user_level'] == ADMIN))
		{
			$search_pg = '';
		}
		else
		{
			$search_pg = 'AND c.cat_user_id = 0';
		}
		$limit_sql = ($start == 0) ? $pics_per_page : $start . ',' . $pics_per_page;
		$count_sql = "SELECT COUNT(pic_id) AS count
									FROM " . ALBUM_TABLE . ' AS p,' . ALBUM_CAT_TABLE . " AS c
									WHERE p.pic_approval = 1
									AND " . $where .  " LIKE '%" . $s . "%'
									" . $search_pg . "
									AND p.pic_cat_id = c.cat_id";
			
		if( !($result = $db->sql_query($count_sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not count '.$m, '', __LINE__, __FILE__, $count_sql);
		}

		$row = $db->sql_fetchrow($result);

		$total_pics = $row['count'];	

		$sql = "SELECT p.pic_id, p.pic_title, p.pic_desc, p.pic_user_id, p.pic_username, p.pic_time, p.pic_cat_id, p.pic_approval, c.cat_id, c.cat_title, c.cat_user_id
				FROM " . ALBUM_TABLE . ' AS p,' . ALBUM_CAT_TABLE . " AS c
				WHERE p.pic_approval = 1
					AND " . $where .  " LIKE '%" . $s . "%'
					AND p.pic_cat_id = c.cat_id
					" . $search_pg . "
				ORDER BY p.pic_time DESC LIMIT ".$limit_sql."";
					
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, "Couldn't obtain a list of matching information (searching for: $search)", "", __LINE__, __FILE__, $sql);
		}
		
		$numres = 0;
		
		if ( $row = $db->sql_fetchrow($result) )
		{
			$in = array();
			do
			{
				if ( !in_array($row['pic_id'], $in) )
				{
					$album_user_id = $row['cat_user_id'];
					$cat_id = $row['cat_id'];
					//$cat_id = album_get_personal_root_id($album_user_id);

					$check_permissions = ALBUM_AUTH_VIEW|ALBUM_AUTH_RATE|ALBUM_AUTH_COMMENT|ALBUM_AUTH_EDIT|ALBUM_AUTH_DELETE;
					$auth_data = album_permissions($album_user_id, $cat_id, $check_permissions, $row);
					//$auth_data = album_get_auth_data($cat_id);

					//if( !$auth_data['view'] )
					if ( $auth_data['view'] >= 0 )
					{
						$template->assign_block_vars('switch_search_results.search_results', array(
							'L_USERNAME' => $row['pic_username'],
							'U_PROFILE' => append_sid('profile.' . $phpEx . '?mode=viewprofile&u=' . $row['pic_user_id']),

							'L_CAT' => ($row['cat_user_id'] != ALBUM_PUBLIC_GALLERY ) ? $lang['Users_Personal_Galleries'] : $row['cat_title'],
							'U_CAT' => ($row['cat_id'] == $cat_id) ? append_sid(album_append_uid('album_cat.' . $phpEx . '?cat_id=' . $row['cat_id'])) : append_sid(album_append_uid('album.' . $phpEx)),

							'L_PIC' => $row['pic_title'],
							'U_PIC' => ($album_config['fullpic_popup'] == 1) ? append_sid(album_append_uid('album_pic.' . $phpEx . '?pic_id=' . $row['pic_id'])) : append_sid(album_append_uid('album_showpage.' . $phpEx . '?pic_id=' . $row['pic_id'])),
							'THUMBNAIL' => append_sid(album_append_uid('album_thumbnail.' . $phpEx . '?pic_id=' . $row['pic_id'])),
							'DESC' => $row['pic_desc'],
							'L_TIME' => create_date($board_config['default_dateformat'], $row['pic_time'], $board_config['board_timezone'])
							)
						);

						$in[$numres] = $row['pic_id'];
						$numres++;
					}
				}
			}
			while( $row = $db->sql_fetchrow($result) );
	
			$template->assign_vars(array(
				'L_NRESULTS' => $numres,
				'L_TRESULTS' => $total_pics,
				'IMG_FOLDER' => $images['folder'],
				'L_TCATEGORY' => $lang['Pic_Cat'],
				'L_TTITLE' => $lang['Pic_Image'],
				'L_TSUBMITER' => $lang['Author'],
				'L_TSUBMITED' => $lang['Time']
				)
			);
		}
		else
		{
			message_die(GENERAL_MESSAGE, $lang['No_search_match']);
		}
	}
	else
	{
		$template->assign_block_vars('switch_search', array());
	}
	
	// --------------------------------
	// Pagination
	// --------------------------------

	$template->assign_vars(array(
		'PAGINATION' => generate_pagination(append_sid(album_append_uid("album_search." . $phpEx . "?mode=" . $m . "&amp;search=" . $s)), $total_pics, $pics_per_page, $start),
		'PAGE_NUMBER' => sprintf($lang['Page_of'], (floor($start / $pics_per_page) + 1), ceil($total_pics / $pics_per_page))
		)
	);

	$template->pparse('body');
	include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
	
// +-------------------------------------------------------------+
// |  Powered by Photo Album 2.x.x (c) 2002-2003 Smartor         |
// |  with Volodymyr (CLowN) Skoryk's Service Pack 1 © 2003-2004 |
// +-------------------------------------------------------------+
		
?>
