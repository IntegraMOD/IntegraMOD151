<?php
/***************************************************************************
 *                           blocks_imp_album.php
 *                            -------------------
 *   begin                : Tuesday, May 04, 2004
 *   copyright            : (C) 2004 masterdavid - Ronald John David
 *							block originally from Kooky < kooky@altern.org > 
							http://perso.edeign.com/kooky/
 *   website              : http://www.integramod.com
 *   email                : webmaster@integramod.com
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

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

if(!function_exists('imp_album_block_func'))
{
	function imp_album_block_func()
	{
		global $template, $phpbb_root_path, $phpEx, $db, $board_config, $lang, $portal_config;

		$album_root_path = $phpbb_root_path . 'album_mod/';
	
		include($album_root_path . 'album_common.'.$phpEx);

		$sql = "SELECT c.*, COUNT(p.pic_id) AS count
				FROM ". ALBUM_CAT_TABLE ." AS c
					LEFT JOIN ". ALBUM_TABLE ." AS p ON c.cat_id = p.pic_cat_id
				".(($portal_config['md_pics_all'] == '1') ? '' : 'WHERE cat_id <> 0')."
				GROUP BY cat_id
				ORDER BY cat_order ASC";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not query categories list', '', __LINE__, __FILE__, $sql);
		}
		$catrows = array();

		while( $row = $db->sql_fetchrow($result) )
		{
			$album_user_access = album_user_access($row['cat_id'], $row, 1, 0, 0, 0, 0, 0); // VIEW
			if ($album_user_access['view'] == 1)
			{
				$catrows[] = $row;
			}
		}
		if ( $portal_config['md_pics_all'] == '1' )
		{
			$allowed_cat = '0'; // For Recent Public Pics below
		}
		else
		{
			$allowed_cat = ''; 
		}

		//
		// $catrows now stores all categories which this user can view. Dump them out!
		//
		for ($i = 0; $i < count($catrows); $i++)
		{
			// Build allowed category-list (for recent pics after here)
			$allowed_cat .= ($allowed_cat == '') ? $catrows[$i]['cat_id'] : ',' . $catrows[$i]['cat_id'];

			// Get Last Pic of this Category
			if ($catrows[$i]['count'] == 0)
			{
				//
				// Oh, this category is empty
				//
				$last_pic_info = $lang['No_Pics'];
				$u_last_pic = '';
				$last_pic_title = '';
			}
			else
			{
				// Check Pic Approval
				if ( ($catrows[$i]['cat_approval'] == ALBUM_ADMIN) or ($catrows[$i]['cat_approval'] == ALBUM_MOD) )
				{
					$pic_approval_sql = 'AND p.pic_approval = 1'; // Pic Approval ON
				}
				else
				{
					$pic_approval_sql = ''; // Pic Approval OFF
				}
			}
			// END of Last Pic
		}

		// Recent Public Pics
		if ( $portal_config['md_pics_all'] == '1' )
		{
			$pics_allowed = '0';
		}
		else
		{
			$pics_allowed = '';
		}

		if ( $allowed_cat != $pics_allowed )
		{
			$CategoryID = $portal_config['md_cat_id'];

			if ( $portal_config['md_pics_sort'] == '1' )
			{
				if ( $CategoryID != 0 )
				{
					$sql = "SELECT p.pic_id, p.pic_title, p.pic_desc, p.pic_user_id, p.pic_user_ip, p.pic_username, p.pic_time, p.pic_cat_id, p.pic_view_count, u.user_id, u.username, r.rate_pic_id, AVG(r.rate_point) AS rating, COUNT(DISTINCT c.comment_id) AS comments
						FROM ". ALBUM_TABLE ." AS p
							LEFT JOIN ". USERS_TABLE ." AS u ON p.pic_user_id = u.user_id
							LEFT JOIN ". ALBUM_CAT_TABLE ." AS ct ON p.pic_cat_id = ct.cat_id
							LEFT JOIN ". ALBUM_RATE_TABLE ." AS r ON p.pic_id = r.rate_pic_id
							LEFT JOIN ". ALBUM_COMMENT_TABLE ." AS c ON p.pic_id = c.comment_pic_id
						WHERE p.pic_cat_id IN ($allowed_cat) AND ( p.pic_approval = 1 OR ct.cat_approval = 0 ) AND pic_cat_id IN ($CategoryID)
						GROUP BY p.pic_id
						ORDER BY RAND()
						LIMIT ". $portal_config['md_pics_number'];
				}
				else
				{
					$sql = "SELECT p.pic_id, p.pic_title, p.pic_desc, p.pic_user_id, p.pic_user_ip, p.pic_username, p.pic_time, p.pic_cat_id, p.pic_view_count, u.user_id, u.username, r.rate_pic_id, AVG(r.rate_point) AS rating, COUNT(DISTINCT c.comment_id) AS comments
						FROM ". ALBUM_TABLE ." AS p
							LEFT JOIN ". USERS_TABLE ." AS u ON p.pic_user_id = u.user_id
							LEFT JOIN ". ALBUM_CAT_TABLE ." AS ct ON p.pic_cat_id = ct.cat_id
							LEFT JOIN ". ALBUM_RATE_TABLE ." AS r ON p.pic_id = r.rate_pic_id
							LEFT JOIN ". ALBUM_COMMENT_TABLE ." AS c ON p.pic_id = c.comment_pic_id
						WHERE p.pic_cat_id IN ($allowed_cat) AND ( p.pic_approval = 1 OR ct.cat_approval = 0 )
						GROUP BY p.pic_id
						ORDER BY RAND()
						LIMIT ". $portal_config['md_pics_number'];
					}
			}
			else if ( $portal_config['md_pics_sort'] == '0' )
			{
				if ( $CategoryID != 0 )
				{
					$sql = "SELECT p.pic_id, p.pic_title, p.pic_desc, p.pic_user_id, p.pic_user_ip, p.pic_username, p.pic_time, p.pic_cat_id, p.pic_view_count, u.user_id, u.username, r.rate_pic_id, AVG(r.rate_point) AS rating, COUNT(DISTINCT c.comment_id) AS comments
						FROM ". ALBUM_TABLE ." AS p
							LEFT JOIN ". USERS_TABLE ." AS u ON p.pic_user_id = u.user_id
							LEFT JOIN ". ALBUM_CAT_TABLE ." AS ct ON p.pic_cat_id = ct.cat_id
							LEFT JOIN ". ALBUM_RATE_TABLE ." AS r ON p.pic_id = r.rate_pic_id
							LEFT JOIN ". ALBUM_COMMENT_TABLE ." AS c ON p.pic_id = c.comment_pic_id
						WHERE p.pic_cat_id IN ($allowed_cat) AND ( p.pic_approval = 1 OR ct.cat_approval = 0 ) AND pic_cat_id IN ($CategoryID)
						GROUP BY p.pic_id
						ORDER BY pic_time DESC
						LIMIT ". $portal_config['md_pics_number'];
				}
				else
				{
					$sql = "SELECT p.pic_id, p.pic_title, p.pic_desc, p.pic_user_id, p.pic_user_ip, p.pic_username, p.pic_time, p.pic_cat_id, p.pic_view_count, u.user_id, u.username, r.rate_pic_id, AVG(r.rate_point) AS rating, COUNT(DISTINCT c.comment_id) AS comments
						FROM ". ALBUM_TABLE ." AS p
							LEFT JOIN ". USERS_TABLE ." AS u ON p.pic_user_id = u.user_id
							LEFT JOIN ". ALBUM_CAT_TABLE ." AS ct ON p.pic_cat_id = ct.cat_id
							LEFT JOIN ". ALBUM_RATE_TABLE ." AS r ON p.pic_id = r.rate_pic_id
							LEFT JOIN ". ALBUM_COMMENT_TABLE ." AS c ON p.pic_id = c.comment_pic_id
						WHERE p.pic_cat_id IN ($allowed_cat) AND ( p.pic_approval = 1 OR ct.cat_approval = 0 )
						GROUP BY p.pic_id
						ORDER BY pic_time DESC
						LIMIT ". $portal_config['md_pics_number'];
				}
			}
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not query recent pics information', '', __LINE__, __FILE__, $sql);
			}
			$recentrow = array();

			while( $row = $db->sql_fetchrow($result) )
			{
				$recentrow[] = $row;
			}

			if (count($recentrow) > 0)
			{
				for ($i = 0; $i < count($recentrow); $i += $album_config['cols_per_page'])
				{
					$template->assign_block_vars('recent_pics', array());

					for ($j = $i; $j < ($i + $album_config['cols_per_page']); $j++)
					{
						if ( $j >= count($recentrow) )
						{
							break;
						}

						if (!$recentrow[$j]['rating'])
						{
							$recentrow[$j]['rating'] = $lang['Not_rated'];
						}
						else
						{
							$recentrow[$j]['rating'] = round($recentrow[$j]['rating'], 2);
						}

						if( ($recentrow[$j]['user_id'] == ALBUM_GUEST) or ($recentrow[$j]['username'] == '') )
						{
							$recent_poster = ($recentrow[$j]['pic_username'] == '') ? $lang['Guest'] : $recentrow[$j]['pic_username'];
						}
						else
						{
							$recent_poster = '<a href="'. append_sid("profile.$phpEx?mode=viewprofile&amp;". POST_USERS_URL .'='. $recentrow[$j]['user_id']) .'">'. $recentrow[$j]['username'] .'</a>';
						}

						$template->assign_block_vars('recent_pics.recent_detail', array(
							'U_PIC' => ($album_config['fullpic_popup']) ? append_sid("album_pic.$phpEx?pic_id=". $recentrow[$j]['pic_id']) : append_sid("album_showpage.$phpEx?pic_id=". $recentrow[$j]['pic_id']),
							'THUMBNAIL' => append_sid("album_thumbnail.$phpEx?pic_id=". $recentrow[$j]['pic_id']),
							'DESC' => $recentrow[$j]['pic_desc'],
							'TITLE' => $recentrow[$j]['pic_title'],
							'POSTER' => $recent_poster,
							'TIME' => create_date($board_config['default_dateformat'], $recentrow[$j]['pic_time'], $board_config['board_timezone']),
							'VIEW' => $recentrow[$j]['pic_view_count'],
							'RATING' => ($album_config['rate'] == 1) ? ( $lang['Rating'] . ': ' . $recentrow[$j]['rating'] . '<br />') : '',
							'COMMENTS' => ($album_config['comment'] == 1) ? ( $lang['Comments'] . ': ' . $recentrow[$j]['comments'] . '<br />') : '')
						);
					}
				}
			}
			else
			{
				// No Pics Found
				$template->assign_block_vars('no_pics', array());
			}
		}
		else
		{
			// No Cats Found
			$template->assign_block_vars('no_pics', array());
		}
		// End add  - Photo Album Block

		$template->assign_vars(array(
			// Start add - Photo Album Block
			'S_COL_WIDTH' => (100/$album_config['cols_per_page']) . '%',
			'TARGET_BLANK' => ($album_config['fullpic_popup']) ? 'target="_blank"' : '',
			'L_NO_PICS' => $lang['No_Pics'],
			'L_PIC_TITLE' => $lang['Pic_Title'],
			'L_VIEW' => $lang['View'],
			'L_POSTER' => $lang['Poster'],
			'L_POSTED' => $lang['Posted'],
			'U_ALBUM' => append_sid('album.' . $phpEx),
			'L_ALBUM' => $lang['Album']
			// End add - Photo Album Block
			)
		);


	}
}
else
{
	echo "Only one album block can be activated on each portal page.  Please deactivate all but one.";
}

imp_album_block_func();
?>