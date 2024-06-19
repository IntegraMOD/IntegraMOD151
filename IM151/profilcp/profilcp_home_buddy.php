<?php
/***************************************************************************
 *                            profilcp_home_buddy.php
 *                            -----------------------
 *	begin				: 26/09/2003
 *	copyright			: Ptirhiik
 *	email				: admin@rpgnet-fr.com
 *
 *	version				: 1.0.0 - 26/09/2003
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 *
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
	exit;
}

if ( !empty($setmodules) ) return;

if ( !empty($set_homemodules) )
{
	$file = basename(__FILE__);
	$home_modules['pos'][] = 'left';
	$home_modules['sort'][] = 10;
	$home_modules['url'][] = $file;
	return;
}

// functions
//-------------------------------------------
//
//	build a buddy list box
//
//-------------------------------------------
if ( !function_exists('box_buddy_list') )
{
	function box_buddy_list($friend=false, $yours=false, $tpl='')
	{
		global $db, $template, $lang, $images, $phpEx, $board_config;
		global $s_hidden_fields, $s_pagination_fields;
		global $_POST, $_GET;
		global $userdata, $view_userdata;
		global $admin_level, $level_prior;
		global $sub_template_key_image, $sub_templates;
		global $tree;
		$list_title = '??';
		if ($friend && $yours)
		{
			$list_title = $lang['Friend_list'];
		}
		else if ($friend && !$yours)
		{
			$list_title = $lang['Friend_list_of'];
		}
		else if (!$friend && $yours)
		{
			$list_title = $lang['Ignore_list'];
		}
		else
		{
			$list_title = $lang['Ignore_list_of'];
		}

		// floor time for active
		$floor = time() - 300;

		// check the buddy list type
		$view_user_id = $view_userdata['user_id'];
		if ($yours)
		{
			$sql_your_id = "b.user_id = $view_user_id";
			$sql_listed_ids = "u.user_id = b.buddy_id";
		}
		else
		{
			$sql_your_id = "b.buddy_id=$view_user_id";
			$sql_listed_ids = "u.user_id=b.user_id";
		}
		if ($friend)
		{
			$sql_friend = "b.buddy_ignore=0";
		}
		else
		{
			$sql_friend = "b.buddy_ignore=1";
		}

		// online
		$sql = "SELECT b.*, u.user_id AS user_user_id, u.*
				FROM " . BUDDYS_TABLE . " b, " . USERS_TABLE . " u
				WHERE $sql_listed_ids
					AND $sql_your_id
					AND $sql_friend
				ORDER BY username";
		if ( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain Buddy online list information', '', __LINE__, __FILE__, $sql);
		}

		// read buddy rows
		$offlines = array();
    $buddy_rowset = array();
		while ($row = $db->sql_fetchrow($result))
		{
			$row['online']	= ( intval($row['user_session_time']) >= $floor );
			if ( $row['online'] )
			{
				$buddy_rowset[]	= $row;
			}
			else
			{
				$offlines[] = $row;
			}
		}
		// re-add offlines
		for ($i=0; $i < count($offlines); $i++)
		{
			$buddy_rowset[]	= $offlines[$i];
		}

		// save template state
		$sav_tpl = $template->_tpldata;

		// init
		if (empty($tpl))
		{
			$tpl = './profilcp/buddy_box';
		}

		// choose template
		$template->set_filenames(array(
			$tpl => $tpl . '.tpl')
		);

		// constants
		$template->assign_vars(array(
			'L_LIST_NAME'	=> $list_title,
			'NOBODY'		=> $lang['Nobody'],
			)
		);
		if ( empty($buddy_rowset) )
		{
			$template->assign_block_vars('nobody', array());
		}

		// list
		for ($i=0; $i < count($buddy_rowset); $i++)
		{
			$w_user_id = $buddy_rowset[$i]['user_user_id'];
			if ( ($last_status != $buddy_rowset[$i]['online']) || ($i == 0) )
			{
				$template->assign_block_vars('online', array(
					'L_ONLINE' => ( $buddy_rowset[$i]['online'] ) ? $lang['Online'] : $lang['Offline'],
					)
				);
			}
			$last_status = $buddy_rowset[$i]['online'];

			// birthday	
			$real_display = ( $userdata['user_allow_real'] && $buddy_rowset[$i]['user_allow_real'] && ( ($buddy_rowset[$i]['user_viewreal'] == YES) || ( ($buddy_rowset[$i]['user_viewreal'] == FRIEND_ONLY) && $friend ) ) );
			$birthday_img = '';
			if ($real_display)
			{
				$temp_url = append_sid("privmsg.$phpEx?mode=post&amp;" . POST_USERS_URL . "=$w_user_id");
				$birthday_img = ( intval(substr($buddy_rowset[$i]['user_birthday'], 4, 4)) == date('md', cal_date(time(),$board_config['board_timezone'])) ) ? '<a href="' . $temp_url . '"><img src="' . $images['icon_birthday'] . '" border="0" alt="' . $lang['Happy_birthday'] . '" title="' . $lang['Happy_birthday'] . '" /></a>' : '';
			}

			$template->assign_block_vars('online.buddy', array(
				'VISIBLE_IMG'	=> ($buddy_rowset[$i]['buddy_visible']) ? $images['icon_visible'] : $images['icon_not_visible'],
				'VISIBLE'		=> ($buddy_rowset[$i]['buddy_visible']) ? $lang['Always_visible'] : $lang['Not_always_visible'],
				'USERNAME'		=> $buddy_rowset[$i]['username'],
				'U_PROFILE'		=> append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$w_user_id"),
				'BIRTHDAY'		=> $birthday_img,
				)
			);
			if ($friend && $yours)
			{
				$template->assign_block_vars('online.buddy.visible', array());
			}
		}

		// transfert to a var
		$template->assign_var_from_handle('_box', $tpl);
		$res = $template->_tpldata['.'][0]['_box'];

		// restore template saved state
		$template->_tpldata = $sav_tpl;

		return $res;
	}
}

//-------------------------------------------
//
//	Buddy lists
//
//-------------------------------------------
// only a post process (no init)
if ($process == 'post')
{
	// your Friend list
	/* PCP Extra :: Altered
	if (isset($board_config['buddy_friend_display']) && (intval($board_config['buddy_friend_display']) == 1) )*/
	if (isset($board_config['user_buddy_friend_display']) && (intval($board_config['user_buddy_friend_display']) == 1) )
	{
		$friend = true;
		$yours = true;
		$box_buddy_list = box_buddy_list($friend, $yours);
		if (!$left_part)
		{
			$template->assign_block_vars('left_part', array());
			$left_part = true;
		}
		$template->assign_block_vars('left_part.box', array(
			'BOX' => $box_buddy_list,
			)
		);
	}

	// your ignore list
	/* PCP Extra :: Altered
	if (isset($board_config['buddy_ignore_display']) && (intval($board_config['buddy_ignore_display']) == 1) )*/
	if (isset($board_config['user_buddy_ignore_display']) && (intval($board_config['user_buddy_ignore_display']) == 1) )
	{
		$friend = false;
		$yours = true;
		$box_buddy_list = box_buddy_list($friend, $yours);
		if (!$left_part)
		{
			$template->assign_block_vars('left_part', array());
			$left_part = true;
		}
		$template->assign_block_vars('left_part.box', array(
			'BOX' => $box_buddy_list,
			)
		);
	}

	// you are Friend of
	/* PCP Extra :: Altered
	if (isset($board_config['buddy_friend_of_display']) && (intval($board_config['buddy_friend_of_display']) == 1) )*/
	if (isset($board_config['user_buddy_friend_of_display']) && (intval($board_config['user_buddy_friend_of_display']) == 1) )
	{
		$friend = true;
		$yours = false;
		$box_buddy_list = box_buddy_list($friend, $yours);
		if (!$left_part)
		{
			$template->assign_block_vars('left_part', array());
			$left_part = true;
		}
		$template->assign_block_vars('left_part.box', array(
			'BOX' => $box_buddy_list,
			)
		);
	}

	// you are ignored by
	/* PCP Extra :: Altered
	if (isset($board_config['buddy_ignored_by_display']) && (intval($board_config['buddy_ignored_by_display']) == 1) )*/
	if (isset($board_config['user_buddy_ignored_by_display']) && (intval($board_config['user_buddy_ignored_by_display']) == 1) )
	{
		$friend = false;
		$yours = false;
		$box_buddy_list = box_buddy_list($friend, $yours);
		if (!$left_part)
		{
			$template->assign_block_vars('left_part', array());
			$left_part = true;
		}
		$template->assign_block_vars('left_part.box', array(
			'BOX' => $box_buddy_list,
			)
		);
	}
}

?>
