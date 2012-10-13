<?php
/***************************************************************************
 *							level_list.php
 *							--------------
 *   begin                : Sunday, Dec 12, 2004
 *   copyright            : (C) 2004 kooky
 *   email                : kooky@altern.org
 *
 *   $Id: level_list.php, v1.02.2.00 2005/05/21 12:15:49 kooky Exp $
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
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_LEVEL_LIST);
init_userprefs($userdata);
//
// End session management
//

$start = ( isset($HTTP_GET_VARS['start']) ) ? intval($HTTP_GET_VARS['start']) : 0;

if ( isset($HTTP_GET_VARS['level']) || isset($HTTP_POST_VARS['level']) )
{
	$level = ( isset($HTTP_POST_VARS['level']) ) ? htmlspecialchars($HTTP_POST_VARS['level']) : htmlspecialchars($HTTP_GET_VARS['level']);
}
else
{
	if ( $founder )
	{
		$level = '100';
	}
	else if ( $admin )
	{
		$level = '1';
	}
	else if ($main_mod)
	{
		$level = '3';
	}
	else if ($mod)
	{
		$level = '2';
	}
	else if ($support)
	{
		$level = '4';
	}
	else if ($vip)
	{
		$level = '5';
	}
	else if ($bot)
	{
		$level = '99';
	}
	else
	{
		$level = '0';
	}
}

//
// Generate page
//
$page_title = $lang['Level_list'];
include($phpbb_root_path . 'includes/page_header.'.$phpEx);

$template->set_filenames(array(
	'body' => 'level_list_body.tpl')
);
make_jumpbox('viewforum.'.$phpEx);

$template->assign_vars(array(
	'LEVEL_NAME' => $level_name,
	'L_EMAIL' => $lang['Email'],
	'L_WEBSITE' => $lang['Website'],
	'L_FROM' => $lang['Location'],
	'L_AIM' => $lang['AIM'],
	'L_YIM' => $lang['YIM'],
	'L_MSNM' => $lang['MSNM'],
	'L_ICQ' => $lang['ICQ'],
	'L_JOINED' => $lang['Joined'],
	'L_POSTS' => $lang['Posts'],
	'L_PM' => $lang['Private_Message'],
	'L_CONTACT' => $lang['Contact'],
	'L_MESSENGER' => $lang['Messenger'])
);

switch( $level )
{
	case '1':
		$level_name = $lang['Administrators'];
		$where = "user_level = 1";
		$order_by = "username, user_id LIMIT $start, " . $board_config['topics_per_page'];
		break;
	case '3':
		$level_name = $lang['Main_Moderators'];
		$where = "user_level = 3";
		$order_by = "username, user_id LIMIT $start, " . $board_config['topics_per_page'];
		break;
	case '2':
		$level_name = $lang['Moderators'];
		$where = "user_level = 2";
		$order_by = "username, user_id LIMIT $start, " . $board_config['topics_per_page'];
		break;
	case '4':
		$level_name = $lang['Support'];
		$where = "user_level = 4";
		$order_by = "username, user_id LIMIT $start, " . $board_config['topics_per_page'];
		break;
	case '5':
		$level_name = $lang['VIP'];
		$where = "user_level = 5";
		$order_by = "username, user_id LIMIT $start, " . $board_config['topics_per_page'];
		break;
	case '99':
		$level_name = $lang['Bots'];
		$where = "user_level = 99";
		$order_by = "username, user_id LIMIT $start, " . $board_config['topics_per_page'];
		break;
	case '100':
		$level_name = $lang['Founder'];
		$where = "user_id = 2 AND user_level = 1";
		$order_by = "username, user_id LIMIT $start, " . $board_config['topics_per_page'];
		break;
	case '0':
		$level_name = $lang['Users'];
		$where = "user_level = 0 AND user_id != -1";
		$order_by = "username, user_id LIMIT $start, " . $board_config['topics_per_page'];
		break;
}

// Restrict Guest Access
// to enable this feature remove /* and */
/*if ( !$userdata['session_logged_in'] )
{
	redirect(append_sid("login.".$phpEx."?redirect=level_list.".$phpEx."?level=$level", true));
	exit;
}*/

// Define Rank
$sql = "SELECT *
	FROM " . RANKS_TABLE . "
	ORDER BY rank_special, rank_min";
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, "Could not obtain ranks information.", '', __LINE__, __FILE__, $sql);
}
$ranksrow = array();
while ( $row = $db->sql_fetchrow($result) )
{
	$ranksrow[] = $row;
}
$db->sql_freeresult($result);

// Define User profile
$sql = "SELECT username, user_id, user_viewemail, user_posts, user_regdate, user_from, user_website, user_email, user_icq, user_aim, user_yim, user_msnm, user_avatar, user_avatar_type, user_allowavatar, user_level, user_rank, r.rank_title
	FROM " . USERS_TABLE . " LEFT JOIN " . RANKS_TABLE . " r
	ON r.rank_id = user_rank
	WHERE " . $where . "
	ORDER BY " . $order_by;

if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not query users', '', __LINE__, __FILE__, $sql);
}

if ( $row = $db->sql_fetchrow($result) )
{
	$i = 0;
	do
	{
		$username = $row['username'];
		$user_id = $row['user_id'];

		$from = ( !empty($row['user_from']) ) ? $row['user_from'] : '&nbsp;';
		$joined = create_date($lang['DATE_FORMAT'], $row['user_regdate'], $board_config['board_timezone']);
		$posts = ( $row['user_posts'] ) ? $row['user_posts'] : 0;

		$user_rank = '';
		$rank_image = '';
		if ( $row['user_rank'] )
		{
			for($j = 0; $j < count($ranksrow); $j++)
			{
				if ( $row['user_rank'] == $ranksrow[$j]['rank_id'] && $ranksrow[$j]['rank_special'] )
				{
					$user_rank = $ranksrow[$j]['rank_title'];
					$rank_image = ( $ranksrow[$j]['rank_image'] ) ? '<img src="' . $ranksrow[$j]['rank_image'] . '" alt="' . $user_rank . '" title="' . $user_rank . '" border="0" /><br />' : '';
				}
			}
		}
		else
		{
			for($j = 0; $j < count($ranksrow); $j++)
			{
				if ( $row['user_posts'] >= $ranksrow[$j]['rank_min'] && !$ranksrow[$j]['rank_special'] )
				{
					$user_rank = $ranksrow[$j]['rank_title'];
					$rank_image = ( $ranksrow[$j]['rank_image'] ) ? '<img src="' . $ranksrow[$j]['rank_image'] . '" alt="' . $user_rank . '" title="' . $user_rank . '" border="0" /><br />' : '';
				}
			}
		}

		$poster_avatar = '';
		if ( $row['user_avatar_type'] && $user_id != ANONYMOUS && $row['user_allowavatar'] )
		{
			switch( $row['user_avatar_type'] )
			{
				case USER_AVATAR_UPLOAD:
					$poster_avatar = ( $board_config['allow_avatar_upload'] ) ? '<img src="' . $board_config['avatar_path'] . '/' . $row['user_avatar'] . '" alt="" border="0" />' : '';
					break;
				case USER_AVATAR_REMOTE:
					$poster_avatar = ( $board_config['allow_avatar_remote'] ) ? '<img src="' . $row['user_avatar'] . '" alt="" border="0" />' : '';
					break;
				case USER_AVATAR_GALLERY:
					$poster_avatar = ( $board_config['allow_avatar_local'] ) ? '<img src="' . $board_config['avatar_gallery_path'] . '/' . $row['user_avatar'] . '" alt="" border="0" />' : '';
					break;
			}
		}

		if ( !empty($row['user_viewemail']) || $userdata['user_level'] == ADMIN || $userdata['user_level'] == '3' )
		{
			$email_uri = ( $board_config['board_email_form'] ) ? append_sid("profile.$phpEx?mode=email&amp;" . POST_USERS_URL .'=' . $user_id) : 'mailto:' . $row['user_email'];

			$email_img = '<a href="' . $email_uri . '"><img src="' . $images['icon_email'] . '" alt="' . $lang['Send_email'] . '" title="' . $lang['Send_email'] . '" border="0" /></a>';
			$email = '<a href="' . $email_uri . '">' . $lang['Send_email'] . '</a>';
		}
		else
		{
			$email_img = '&nbsp;';
			$email = '&nbsp;';
		}

		$temp_url = append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$user_id");
		$profile_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_profile'] . '" alt="' . $lang['Read_profile'] . '" title="' . $lang['Read_profile'] . '" border="0" /></a>';
		$profile = '<a href="' . $temp_url . '">' . $lang['Read_profile'] . '</a>';

		$temp_url = append_sid("privmsg.$phpEx?mode=post&amp;" . POST_USERS_URL . "=$user_id");
		$pm_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_pm'] . '" alt="' . $lang['Send_private_message'] . '" title="' . $lang['Send_private_message'] . '" border="0" /></a>';
		$pm = '<a href="' . $temp_url . '">' . $lang['Send_private_message'] . '</a>';

		$www_img = ( $row['user_website'] ) ? '<a href="' . $row['user_website'] . '" target="_userwww"><img src="' . $images['icon_www'] . '" alt="' . $lang['Visit_website'] . '" title="' . $lang['Visit_website'] . '" border="0" /></a>' : '';
		$www = ( $row['user_website'] ) ? '<a href="' . $row['user_website'] . '" target="_userwww">' . $lang['Visit_website'] . '</a>' : '';

		if ( !empty($row['user_icq']) )
		{
			$icq_status_img = '<a href="http://wwp.icq.com/' . $row['user_icq'] . '#pager"><img src="http://web.icq.com/whitepages/online?icq=' . $row['user_icq'] . '&img=5" width="18" height="18" border="0" /></a>';
			$icq_img = '<a href="http://wwp.icq.com/scripts/search.dll?to=' . $row['user_icq'] . '"><img src="' . $images['icon_icq'] . '" alt="' . $lang['ICQ'] . '" title="' . $lang['ICQ'] . '" border="0" /></a>';
			$icq =  '<a href="http://wwp.icq.com/scripts/search.dll?to=' . $row['user_icq'] . '">' . $lang['ICQ'] . '</a>';
		}
		else
		{
			$icq_status_img = '';
			$icq_img = '';
			$icq = '';
		}

		$aim_img = ( $row['user_aim'] ) ? '<a href="aim:goim?screenname=' . $row['user_aim'] . '&amp;message=Hello+Are+you+there?"><img src="' . $images['icon_aim'] . '" alt="' . $lang['AIM'] . '" title="' . $lang['AIM'] . '" border="0" /></a>' : '';
		$aim = ( $row['user_aim'] ) ? '<a href="aim:goim?screenname=' . $row['user_aim'] . '&amp;message=Hello+Are+you+there?">' . $lang['AIM'] . '</a>' : '';

		$temp_url = append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$user_id");
		$msn_img = ( $row['user_msnm'] ) ? '<a href="' . $temp_url . '"><img src="' . $images['icon_msnm'] . '" alt="' . $lang['MSNM'] . '" title="' . $lang['MSNM'] . '" border="0" /></a>' : '';
		$msn = ( $row['user_msnm'] ) ? '<a href="' . $temp_url . '">' . $lang['MSNM'] . '</a>' : '';

		$yim_img = ( $row['user_yim'] ) ? '<a href="http://edit.yahoo.com/config/send_webmesg?.target=' . $row['user_yim'] . '&amp;.src=pg"><img src="' . $images['icon_yim'] . '" alt="' . $lang['YIM'] . '" title="' . $lang['YIM'] . '" border="0" /></a>' : '';
		$yim = ( $row['user_yim'] ) ? '<a href="http://edit.yahoo.com/config/send_webmesg?.target=' . $row['user_yim'] . '&amp;.src=pg">' . $lang['YIM'] . '</a>' : '';

		$temp_url = append_sid("search.$phpEx?search_author=" . urlencode($username) . "&amp;showresults=posts");
		$search_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_search'] . '" alt="' . $lang['Search_user_posts'] . '" title="' . $lang['Search_user_posts'] . '" border="0" /></a>';
		$search = '<a href="' . $temp_url . '">' . $lang['Search_user_posts'] . '</a>';

		switch ( $row['user_level'] )
		{
			case ADMIN:
				$username = '<strong>' . $username . '</strong>';
				$style_color = ($row['user_id'] == 2) ? ' style="color: #' . $theme['color_founder'] . '"' : ' style="color: #' . $theme['color_admin'] . '"';
				break;
			case MAIN_MOD:
				$username = '<strong>' . $username . '</strong>';
				$style_color = ' style="color: #' . $theme['color_main_mod'] . '"';
				break;
			case MOD:
				$username = '<strong>' . $username . '</strong>';
				$style_color = ' style="color: #' . $theme['color_mod'] . '"';
				break;
			case SUPPORT:
				$username = '<strong>' . $username . '</strong>';
				$style_color = ' style="color: #' . $theme['color_support'] . '"';
				break;
			case VIP:
				$username = '<strong>' . $username . '</strong>';
				$style_color = ' style="color: #' . $theme['color_vip'] . '"';
				break;
			case BOT:
				$username = '<strong>' . $username . '</strong>';
				$style_color = ' style="color: #' . $theme['color_bot'] . '"';
				break;
			case USER:
				$username = '<strong>' . $username . '</strong>';
				$style_color = ' style="color: #' . $theme['color_user'] . '"';
				break;
			default:
				$username = $username;
				$style_color = '';
				break;
		}
		$username = '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $user_id) . '"' . $style_color . '>' . $username . '</a>';

		$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
		$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

		$template->assign_block_vars('level_list', array(
			'ROW_NUMBER' => $i + ( $start + 1 ),
			'ROW_COLOR' => '#' . $row_color,
			'ROW_CLASS' => $row_class,
			'USERNAME' => $username,
			'USER_RANK' => $user_rank,
			'USER_RANK_IMG' => $rank_image,
			'FROM' => $from,
			'JOINED' => $joined,
			'POSTS' => $posts,
			'AVATAR_IMG' => $poster_avatar,
			'PROFILE_IMG' => $profile_img,
			'PROFILE' => $profile,
			'SEARCH_IMG' => $search_img,
			'SEARCH' => $search,
			'PM_IMG' => $pm_img,
			'PM' => $pm,
			'EMAIL_IMG' => $email_img,
			'EMAIL' => $email,
			'WWW_IMG' => $www_img,
			'WWW' => $www,
			'ICQ_STATUS_IMG' => $icq_status_img,
			'ICQ_IMG' => $icq_img,
			'ICQ' => $icq,
			'AIM_IMG' => $aim_img,
			'AIM' => $aim,
			'MSN_IMG' => $msn_img,
			'MSN' => $msn,
			'YIM_IMG' => $yim_img,
			'YIM' => $yim)
		);

		$i++;
	}
	while ( $row = $db->sql_fetchrow($result) );
	$db->sql_freeresult($result);
}
else
{
	$message = $lang['No_match_found'] . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>');
	message_die(GENERAL_MESSAGE, $message);
}

$sql = "SELECT count(*) AS total
	FROM " . USERS_TABLE . "
	WHERE $where";

if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Error getting total users', '', __LINE__, __FILE__, $sql);
}

if ( $total = $db->sql_fetchrow($result) )
{
	$total_levels = $total['total'];
	$pagination = generate_pagination("level_list.$phpEx?level=$level", $total_levels, $board_config['topics_per_page'], $start). '&nbsp;';
}
$db->sql_freeresult($result);

$template->assign_vars(array(
	'LEVEL_NAME' => $level_name,
	'PAGINATION' => $pagination,
	'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $board_config['topics_per_page'] ) + 1 ), ceil( $total_levels / $board_config['topics_per_page'] )),

	'L_GOTO_PAGE' => $lang['Goto_page'])
);

$template->pparse('body');

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>