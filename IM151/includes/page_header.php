<?php
/***************************************************************************
 *                              page_header.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
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

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}



// The New Gzip :: start
$do_gzip_compress = FALSE;
if($board_config['gzip_compress']){
	$useragent = (isset($_SERVER['HTTP_USER_AGENT'])) ? $_SERVER['HTTP_USER_AGENT'] : getenv('HTTP_USER_AGENT');
	$accept_encoding = (isset($_SERVER['HTTP_ACCEPT_ENCODING'])) ? $_SERVER['HTTP_ACCEPT_ENCODING'] : getenv('HTTP_ACCEPT_ENCODING');
	if ( extension_loaded('zlib') && !headers_sent() && strstr($accept_encoding,'gzip')) {
		ob_start("ob_gzhandler");
	}
}
// The New Gzip :: end

define('HEADER_INC', TRUE);

//--------------------------------------------------------------------------------
// Prillian - Begin Code Addition
//

if (defined('PRILLIAN_INSTALLED') && !file_exists('prill_install'))
{
	include_once(PRILL_PATH . 'prill_common.' . $phpEx);
}
else
{
        $im_auto_popup = 0;
}

//
// Prillian - End Code Addition
//--------------------------------------------------------------------------------

//
// IM Portal https://integramod.com
//
if(!defined('PORTAL_INIT'))
{
	include($phpbb_root_path . 'includes/functions_portal.' . $phpEx);
	portal_config_init($portal_config);
	include_once($phpbb_root_path . 'includes/lite.'.$phpEx);
	$options = array(
		'cacheDir' => $phpbb_root_path . 'var_cache/',
		'fileLocking' => $portal_config['md_cache_file_locking'],
		'writeControl' => $portal_config['md_cache_write_control'],
		'readControl' => $portal_config['md_cache_read_control'],
		'readControlType' => $portal_config['md_cache_read_type'],
		'fileNameProtection' => $portal_config['md_cache_filename_protect'],
		'automaticSerialization' => $portal_config['md_cache_serialize']
	);
	$var_cache = new Cache_Lite($options);
	define('PORTAL_INIT', TRUE);
}
if(!empty($portal_config['collapse_layout']) && $portal_config['collapse_layout'] == 1)
{
	$template->assign_block_vars('layout_collapse',array(
		'LAYOUT_IMAGER' => $images['layout_imager'],
		'LAYOUT_IMAGEL' => $images['layout_imagel']
		)
	);
}
else
{
	$template->assign_block_vars('no_layout_collapse',array(
		'SPACER' => $images['spacer'],
		)
	);
}
$template->assign_var('S_DISPLAY_SEARCH', true);

//-- mod : profile cp ------------------------------------------------------------------------------
//-- add
include_once($phpbb_root_path . 'profilcp/functions_profile.' . $phpEx);
//-- fin mod : profile cp --------------------------------------------------------------------------

// 
// gzip_compression 
// 

// ------------------------------------
//
//
// Parse and show the overall header.
//
$template->set_filenames(array(
	'overall_header' => ( empty($gen_simple_header) ) ? 'overall_header.tpl' : 'simple_header.tpl')
);

//
// Generate logged in/logged out status
//
// smartors redirect after log in mod //
// removed Michaelo //
/*
if ( $userdata['session_logged_in'] )
{
	$u_login_logout = 'login.'.$phpEx.'?logout=true&amp;sid=' . $userdata['session_id'];
	$l_login_logout = $lang['Logout'] . ' [ ' . $userdata['username'] . ' ]';
	$template->assign_block_vars('switch_show_digests', array());
}
else
{
	$u_login_logout = 'login.'.$phpEx;
	$l_login_logout = $lang['Login'];
}
*/
// added smartors redirect mod Michaelo //
if ( $userdata['session_logged_in'] )
{
	$u_login_logout = 'login.'.$phpEx.'?logout=true&amp;sid=' . $userdata['session_id'];
	$l_login_logout = $lang['Logout'] . ' [ ' . $userdata['username'] . ' ]';
}
else
{
	$smart_redirect = strrchr($_SERVER['PHP_SELF'], '/');
	$smart_redirect = substr($smart_redirect, 1, strlen($smart_redirect));

	if( ($smart_redirect == ('profile.'.$phpEx)) or ($smart_redirect == ('login.'.$phpEx)) )
	{
		$smart_redirect = '';
	}

	if( isset($_GET) and !empty($smart_redirect) )
	{		
		$smart_get_keys = array_keys($_GET);

		for ($i = 0; $i < count($_GET); $i++)
		{
			if ($smart_get_keys[$i] != 'sid')
			{
				$smart_redirect .= '&' . $smart_get_keys[$i] . '=' . $_GET[$smart_get_keys[$i]];
			}
		}
	}

	$u_login_logout = 'login.' . $phpEx;
	$u_login_logout .= (!empty($smart_redirect)) ? '?redirect=' . $smart_redirect : '';
	$u_login_logout = htmlspecialchars($u_login_logout);
	$l_login_logout = $lang['Login'];
}

//-- mod : today at   yesterday at ------------------------------------------------------------------------ 
//-- add 
//-- mod : keep unread ----------------------------------------------------------------------------- 
//-- delete 
// $s_last_visit = ( $userdata['session_logged_in'] ) ? create_date($board_config['default_dateformat'], $userdata['user_lastvisit'], $board_config['board_timezone']) : ''; 
//-- add 
$s_last_visit = create_date_day($board_config['default_dateformat'], $userdata['user_lastvisit'], $board_config['board_timezone']); 
//-- fin mod : keep unread ------ 
//-- end mod : today at   yesterday at ------------------------------------------------------------------------ 


//
// Get basic (usernames + totals) online
// situation
//
$logged_visible_online = 0;
$logged_hidden_online = 0;
$guests_online = 0;
$online_userlist = '';
$l_online_users = '';

if (defined('SHOW_ONLINE'))
{

	$user_forum_sql = ( !empty($forum_id) ) ? "AND s.session_page = " . intval($forum_id) : '';
	//-- mod : profile cp ------------------------------------------------------------------------------
//-- delete
//	$sql = "SELECT u.username, u.user_id, u.user_allow_viewonline, u.user_level, s.session_logged_in, s.session_ip
//-- add
	$sql = "SELECT u.*, s.session_logged_in, s.session_time, s.session_page, s.session_ip
		FROM ".USERS_TABLE." u, ".SESSIONS_TABLE." s
		WHERE u.user_id = s.session_user_id
			AND s.session_time >= ".( time() - 300 ) . "
			$user_forum_sql
		ORDER BY u.username ASC, s.session_ip ASC";
	if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain user/online information', '', __LINE__, __FILE__, $sql);
	}

	$userlist_ary = array();
	$userlist_visible = array();

	$prev_user_id = 0;
	$prev_user_ip = $prev_session_ip = '';

	//-- mod : profile cp ------------------------------------------------------------------------------
//-- delete
//	while( $row = $db->sql_fetchrow($result) )
//	{
//		// User is logged in and therefor not a guest
//		if ( $row['session_logged_in'] )
//		{
//			// Skip multiple sessions for one user
//			if ( $row['user_id'] != $prev_user_id )
//			{
//				$style_color = '';
//				if ( $row['user_level'] == ADMIN )
//				{
//					$row['username'] = '<b>' . $row['username'] . '</b>';
//					$style_color = 'style="color:#' . $theme['fontcolor3'] . '"';
//				}
//				else if ( $row['user_level'] == MOD )
//				{
//					$row['username'] = '<b>' . $row['username'] . '</b>';
//					$style_color = 'style="color:#' . $theme['fontcolor2'] . '"';
//				}
//
//				if ( $row['user_allow_viewonline'] )
//				{
//					$user_online_link = '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $row['user_id']) . '"' . $style_color .'>' . $row['username'] . '</a>';
//					$logged_visible_online++;
//				}
//				else
//				{
//					$user_online_link = '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $row['user_id']) . '"' . $style_color .'><i>' . $row['username'] . '</i></a>';
//					$logged_hidden_online++;
//				}
//
//				if ( $row['user_allow_viewonline'] || $userdata['user_level'] == ADMIN )
//				{
//					$online_userlist .= ( $online_userlist != '' ) ? ', ' . $user_online_link : $user_online_link;
//				}
//			}
//
//			$prev_user_id = $row['user_id'];
//		}
//		else
//		{
//			// Skip multiple sessions for one user
//			if ( $row['session_ip'] != $prev_session_ip )
//			{
//				$guests_online++;
//			}
//		}
//
//		$prev_session_ip = $row['session_ip'];
//	}
//	$db->sql_freeresult($result);
//-- add
	$connected = array();
	$user_ids = array();
	while ($row = $db->sql_fetchrow($result) )
	{
		// User is logged in and therefor not a guest
		if ( $row['session_logged_in'] )
		{
			if ( !in_array($row['user_id'], $user_ids) )
			{
//--------------------------------------------------------------------------------
// Prillian - Begin Code Addition
//
				$online_array[] = $row['user_id'];
//
// Prillian - End Code Addition
//--------------------------------------------------------------------------------
				$row['style'] = ' class="' . $agcm_color->get_user_color($row['user_group_id'], $row['user_session_time']) . '"';
				$connected[] = $row;
				$user_ids[] = $row['user_id'];
			}
		}
		else
		{
			// Skip multiple sessions for one user
			if ( $row['session_ip'] != $prev_session_ip )
			{
				$row['style'] = '';
				$connected[] = $row;
			}
		}
		$prev_session_ip = $row['session_ip'];
	}
	$db->sql_freeresult($result);

	// read buddy list
	$buddys = array();
	if (count($user_ids))
	{
		$s_user_ids = implode(', ', $user_ids);

		// get base info
		$sql = "SELECT * FROM " . BUDDYS_TABLE . " WHERE (user_id=" . $userdata['user_id'] . " OR buddy_id=" . $userdata['user_id'] .") and buddy_id in ($s_user_ids)";
		if ( !($result = $db->sql_query($sql)) ) message_die(GENERAL_ERROR, "Could not obtain buddys information.", '', __LINE__, __FILE__, $sql);
		while ( $row = $db->sql_fetchrow($result) )
		{
			if ($row['user_id'] == $userdata['user_id'])
			{
				$buddys[ $row['buddy_id'] ]['buddy_ignore'] = $row['buddy_ignore'];
				$buddys[ $row['buddy_id'] ]['buddy_my_friend'] = !$row['buddy_ignore'];
				$buddys[ $row['buddy_id'] ]['buddy_friend'] = false;
				$buddys[ $row['buddy_id'] ]['buddy_visible'] = false;
			}
			else
			{
				if ( !isset($buddys[ $row['user_id'] ]) ) $buddys[ $row['user_id'] ]['buddy_ignore'] = false;
				if ( !isset($buddys[ $row['user_id'] ]) ) $buddys[ $row['user_id'] ]['buddy_my_friend'] = false;
				$buddys[ $row['user_id'] ]['buddy_friend'] = !$row['buddy_ignore'];
				$buddys[ $row['user_id'] ]['buddy_visible'] = $row['buddy_visible'];
			}
		}
		$db->sql_freeresult($result);
	}

	// get visible/not visible status
	$user_id = $userdata['user_id'];
	$user_level = $userdata['user_level'];
	$is_admin = is_admin($userdata);

	for ($i=0; $i < count($connected); $i++)
	{
		$view_user_id = $connected[$i]['user_id'];
		$view_is_admin = is_admin($connected[$i]);

		$view_online_set = $connected[$i]['user_allow_viewonline'];

		$view_ignore	= ($is_admin || $view_is_admin || ($view_user_id == $user_id)) ? false : $buddys[$view_user_id]['buddy_ignore'];
		$view_friend	= isset($buddys[$view_user_id]) ? $buddys[$view_user_id]['buddy_friend'] : false;
		$view_visible	= ($is_admin || ($view_user_id == $user_id)) ? YES : ( isset($buddys[$view_user_id]['buddy_visible']) ? $buddys[$view_user_id]['buddy_visible'] : NO );

		// online/offline/hidden icon
		if ($view_user_id == ANONYMOUS)
		{
			$status = 'guest';
		}
		else if ($view_ignore) 
		{
			$status = 'offline';
		}
		else
		{
			switch ($view_online_set)
			{
				case NO:
					$status = ($view_visible) ? 'hidden' : 'offline';
					break;
				case YES:
					$status = 'online';
					break;
				case FRIEND_ONLY:
					$status = ($view_friend || $view_visible) ? 'hidden' : 'offline';
					break;
				default:
					$status = '???';
			}
		}

		// set the status
		switch ($status)
		{
			case 'guest':
				$guests_online++;
				break;
			case 'offline':
				$logged_hidden_online++;
				break;
			case 'online':
				$logged_visible_online++;
				break;
			case 'hidden':
				$connected[$i]['username'] = '<i>' . $connected[$i]['username'] . '</i>';
				$logged_hidden_online++;
				break;
			default:
		}

		$connected[$i]['status'] = $status;

		// add the user to the online list
		if ( ($status == 'online') || ($status == 'hidden') )
		{
			$online_userlist .= ( $online_userlist != '' ) ? ', ' : '';
			$online_userlist .= '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&" . POST_USERS_URL . "=" . $connected[$i]['user_id'] ) . '"' . $connected[$i]['style'] . '>' . $agcm_color->get_user_color($connected[$i]['user_group_id'], $connected[$i]['user_session_time'], $connected[$i]['username']) . '</a>';
		}
	}
//-- fin mod : profile cp --------------------------------------------------------------------------


	if ( empty($online_userlist) )
	{
		$online_userlist = $lang['None'];
	}
	$online_userlist = ( ( isset($forum_id) ) ? $lang['Browsing_forum'] : $lang['Registered_users'] ) . ' ' . $online_userlist;

	$total_online_users = $logged_visible_online + $logged_hidden_online + $guests_online;

	if ( $total_online_users > $board_config['record_online_users'])
	{
		$board_config['record_online_users'] = $total_online_users;
		$board_config['record_online_date'] = time();

		$sql = "UPDATE " . CONFIG_TABLE . "
			SET config_value = '$total_online_users'
			WHERE config_name = 'record_online_users'";
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not update online user record (nr of users)', '', __LINE__, __FILE__, $sql);
		}

		$sql = "UPDATE " . CONFIG_TABLE . "
			SET config_value = '" . $board_config['record_online_date'] . "'
			WHERE config_name = 'record_online_date'";
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not update online user record (date)', '', __LINE__, __FILE__, $sql);
		}
		$db->clear_cache('board_config');
	}

	if ( $total_online_users == 0 )
	{
		$l_t_user_s = $lang['Online_users_zero_total'];
	}
	else if ( $total_online_users == 1 )
	{
		$l_t_user_s = $lang['Online_user_total'];
	}
	else
	{
		$l_t_user_s = $lang['Online_users_total'];
	}

	if ( $logged_visible_online == 0 )
	{
		$l_r_user_s = $lang['Reg_users_zero_total'];
	}
	else if ( $logged_visible_online == 1 )
	{
		$l_r_user_s = $lang['Reg_user_total'];
	}
	else
	{
		$l_r_user_s = $lang['Reg_users_total'];
	}

	if ( $logged_hidden_online == 0 )
	{
		$l_h_user_s = $lang['Hidden_users_zero_total'];
	}
	else if ( $logged_hidden_online == 1 )
	{
		$l_h_user_s = $lang['Hidden_user_total'];
	}
	else
	{
		$l_h_user_s = $lang['Hidden_users_total'];
	}

	if ( $guests_online == 0 )
	{
		$l_g_user_s = $lang['Guest_users_zero_total'];
	}
	else if ( $guests_online == 1 )
	{
		$l_g_user_s = $lang['Guest_user_total'];
	}
	else
	{
		$l_g_user_s = $lang['Guest_users_total'];
	}

	$l_online_users = sprintf($l_t_user_s, $total_online_users);
	$l_online_users .= sprintf($l_r_user_s, $logged_visible_online);
	$l_online_users .= sprintf($l_h_user_s, $logged_hidden_online);
	$l_online_users .= sprintf($l_g_user_s, $guests_online);
}

$day_userlist = ''; // prevent undef variable
if (defined('SHOW_ONLINE'))
{
  // ############ Edit below ############
  $display_not_day_userlist = 0; // change to 1 here if you also want the list of the users who didn't visit to be displayed
  $users_list_delay = 24; // change here to the number of hours wanted for the list
  $time_min = time() - ($users_list_delay * 3600);
  // ############ Edit above ############

  $sql = "SELECT user_group_id, user_id, username, user_allow_viewonline, user_level, user_session_time
          FROM ".USERS_TABLE."
          WHERE user_id > 0 "
          . ($display_not_day_userlist ? '' : ("AND user_session_time >= " . $time_min)) .
          " ORDER BY IF(user_level=1,3,user_level) DESC, username ASC";

  if( !($result = $db->sql_query($sql)) )
  {
  message_die(GENERAL_ERROR, 'Could not obtain user/day information', '', __LINE__, __FILE__, $sql);
  }

  $day_users = 0;
  $not_day_userlist = '';
  $not_day_users = 0;
  while( $row = $db->sql_fetchrow($result) )
  {
    $style_color = $agcm_color->get_user_color($row['user_group_id'], $row['user_session_time']);

    if ( $row['user_allow_viewonline'] )
    {
      $temp_url = append_sid("profile.$phpEx?mode=viewprofile&" . POST_USERS_URL . "=" . $row['user_id']);
      $user_day_link = '<a href="' . $temp_url . '" class="' . $style_color . '">' . $row['username'] . '</a>';
    }
    else
    {
      $user_day_link = '<i>' . $row['username'] . '</i>';
    }
    if ( $row['user_allow_viewonline'] || $userdata['user_level'] == ADMIN )
    {
      if ( $row['user_session_time'] >= ( time() - $users_list_delay * 3600 ) )
      {
        $day_userlist .= ( $day_userlist != '' ) ? ', ' . $user_day_link : $user_day_link;
        $day_users++;
      }
      else
      {
        $not_day_userlist .= ( $not_day_userlist != '' ) ? ', ' . $user_day_link : $user_day_link;
        $not_day_users++;
      }
    }
  }

  $day_userlist = ( ( isset($forum_id) ) ? '' : sprintf($lang['Day_users'], $day_users, $users_list_delay) ) . ' ' . $day_userlist;
  $not_day_userlist = ( ( isset($forum_id) ) ? '' : sprintf($lang['Not_day_users'], $not_day_users, $users_list_delay) ) . ' ' . $not_day_userlist;
  if ( $display_not_day_userlist )
  {
    $day_userlist .= '<br />' . $not_day_userlist;
  }
}





//
// Obtain number of new private messages
// if user is logged in
//
if ( ($userdata['session_logged_in']) && (empty($gen_simple_header)) )
{
	if ( $userdata['user_new_privmsg'] )
	{
		$l_message_new = ( $userdata['user_new_privmsg'] == 1 ) ? $lang['New_pm'] : $lang['New_pms'];
		$l_privmsgs_text = sprintf($l_message_new, $userdata['user_new_privmsg']);

		if ( $userdata['user_last_privmsg'] > $userdata['user_lastvisit'] )
		{
			$sql = "UPDATE " . USERS_TABLE . "
				SET user_last_privmsg = " . $userdata['user_lastvisit'] . "
				WHERE user_id = " . $userdata['user_id'];
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not update private message new/read time for user', '', __LINE__, __FILE__, $sql);
			}

			$s_privmsg_new = 1;
			$icon_pm = $images['pm_new_msg'];
		}
		else
		{
			$s_privmsg_new = 0;
			$icon_pm = $images['pm_new_msg'];
		}
	}
	else
	{
		$l_privmsgs_text = $lang['No_new_pm'];

		$s_privmsg_new = 0;
		$icon_pm = $images['pm_no_new_msg'];
	}

	if ( $userdata['user_unread_privmsg'] )
	{
		$l_message_unread = ( $userdata['user_unread_privmsg'] == 1 ) ? $lang['Unread_pm'] : $lang['Unread_pms'];
		$l_privmsgs_text_unread = sprintf($l_message_unread, $userdata['user_unread_privmsg']);
	}
	else
	{
		$l_privmsgs_text_unread = $lang['No_unread_pm'];
	}
}
else
{
	$icon_pm = $images['pm_no_new_msg'];
	$l_privmsgs_text = $lang['Login_check_pm'];
	$l_privmsgs_text_unread = '';
	$s_privmsg_new = 0;
}

//
// Report list link
//
if (empty($gen_simple_header) && ($userdata['user_level'] == ADMIN || (!$board_config['report_list_admin'] && $userdata['user_level'] == MOD)))
{
	include_once($phpbb_root_path . "includes/functions_report.$phpEx");
	
	$report_count = report_count_obtain();
	if ($report_count > 0)
	{
		$template->assign_block_vars('switch_report_list_new', array());
		
		$report_list = $lang['Reports'];
		$report_list .= ($report_count == 1) ? $lang['New_report'] : sprintf($lang['New_reports'], $report_count);
	}
	else
	{
		$template->assign_block_vars('switch_report_list', array());
		
		$report_list = $lang['Reports'];
	}
}
else
{
	$report_list = '';
}

//
// Get report general module and create report link
//
if (empty($gen_simple_header))
{
	include_once($phpbb_root_path . "includes/functions_report.$phpEx");
	$report_general = report_modules('name', 'report_general');
	
	if ($report_general && $report_general->auth_check('auth_write'))
	{
		$template->assign_block_vars('switch_report_general', array());

		$template->assign_vars(array(
			'U_WRITE_REPORT' => append_sid("report.$phpEx?mode=" . $report_general->mode),
			'L_WRITE_REPORT' => $report_general->lang['Write_report'])
		);
	}
}

//
// Generate HTML required for Mozilla Navigation bar
//
if (!isset($nav_links))
{
	$nav_links = array();
}

$nav_links_html = '';
$nav_link_proto = '<link rel="%s" href="%s" title="%s" />' . "\n";
foreach ($nav_links as $nav_item => $nav_array)
{
	if ( !empty($nav_array['url']) )
	{
		$nav_links_html .= sprintf($nav_link_proto, $nav_item, append_sid($nav_array['url']), $nav_array['title']);
	}
	else
	{
		// We have a nested array, used for items like <link rel='chapter'> that can occur more than once.
		while( list(,$nested_array) = each($nav_array) )
		{
			$nav_links_html .= sprintf($nav_link_proto, $nav_item, $nested_array['url'], $nested_array['title']);
		}
	}
}

//--------------------------------------------------------------------------------
// HTTP Referers 
//
if (!empty($_SERVER['HTTP_REFERER']) && false === stripos($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST'] . $board_config['script_path'])) 
{
	$referer_url = $_SERVER['HTTP_REFERER'];
	$referer_host = substr($referer_url, strpos($referer_url, "//") + 2);
	if (strpos($referer_host, "/") === false)
	{
		$referer_url .= "/";
	}
	else
	{
		$referer_host = substr($referer_host, 0, strpos($referer_host, "/"));
	}
	if (substr($referer_host, -1) == ".")
	{
		$referer_host = substr($referer_host, 0, -1);
	}	
     
    $sql = "SELECT * FROM " . REFERERS_TABLE . " 
		WHERE referer_url = '$referer_url'";
	if (!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, "Could not get referers information", "", __LINE__, __FILE__, $sql);
	}
	$row = $db->sql_fetchrow($result);

	if (!$row)
	{
		$sql = "INSERT INTO " . REFERERS_TABLE . " (referer_host, referer_url, referer_ip, referer_hits, referer_firstvisit, referer_lastvisit) 
			VALUES ('$referer_host', '$referer_url', '$user_ip', 1, '" . time() . "', '" . time() . "')";
			
		if (!$result = $db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, "Couldn't insert new referer", "", __LINE__, __FILE__, $sql);
		}
	}
	else 
	{
		$sql = "UPDATE " . REFERERS_TABLE . " 
			SET referer_hits = referer_hits + 1, referer_lastvisit = " . time() . ", referer_ip = '$user_ip' 
			WHERE referer_url='$referer_url'"; 
			
		if (!$result = $db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, "Couldn't update referers information", "", __LINE__, __FILE__, $sql);
		}
	}
}
// END HTTP Referers

//--------------------------------------------------------------------------------
// Prillian - Begin Code Addition
//

if( ($userdata['user_id'] != ANONYMOUS) && (defined('PRILLIAN_INSTALLED') && !file_exists('prill_install')) && $userdata['user_id'] != NULL )
{
	$template->assign_block_vars('switch_prillian_installed', array());
	if( defined('IN_CONTACT_LIST') && defined('SHOW_ONLINE') )
	{
		$contact_list->alert_check();
	}
	if ( empty($im_userdata) )
	{
		$im_userdata = init_imprefs($userdata['user_id'], false, true);
	}
	$im_auto_popup = auto_prill_check();
	if ( $im_userdata['new_ims'] )
	{
		$l_prillian_msg = ( $im_userdata['new_ims'] > 1 ) ? $lang['New_ims']: $lang['New_im'];
		$l_prillian_text = sprintf($l_prillian_msg, $im_userdata['new_ims']);
	}
	elseif ( $im_userdata['unread_ims'] )
	{
		$l_prillian_msg = ( $im_userdata['unread_ims'] > 1 ) ? $lang['Unread_ims']: $lang['Unread_im'];
		$l_prillian_text = sprintf($l_prillian_msg, $im_userdata['unread_ims']);
	}

	$template->assign_vars(array(
		'IM_AUTO_POPUP' => $im_auto_popup,
		'IM_HEIGHT' => $im_userdata['mode_height'],
		'IM_WIDTH' => $im_userdata['mode_width'],
		'U_IM_LAUNCH' => append_sid(PRILL_URL . $im_userdata['mode_string']),
		'L_IM_LAUNCH' => $l_prillian_text,
		'L_CONTACT_MAN' => $lang['Contact_Management'],
		'U_CONTACT_MAN' => append_sid(CONTACT_URL)
	));
}


//
// Prillian - End Code Addition
//--------------------------------------------------------------------------------

// Format Timezone. We are unable to use array_pop here, because of PHP3 compatibility
$l_timezone = explode('.', $board_config['board_timezone']);
$l_timezone = (count($l_timezone) > 1 && $l_timezone[count($l_timezone)-1] != 0) ? $lang[sprintf('%.1f', $board_config['board_timezone'])] : $lang[number_format($board_config['board_timezone'])];

/*
 * CrackerTracker IP Range Scanner
 */
if (isset($_GET['marknow']) && $_GET['marknow'] == 'ipfeature' && $userdata['session_logged_in'])
{
	// Mark IP Feature Read
	$userdata['ct_last_ip'] = $userdata['ct_last_used_ip'];
	$sql = 'UPDATE ' . USERS_TABLE . ' SET ct_last_ip = ct_last_used_ip WHERE user_id=' . $userdata['user_id'];
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, $lang['ctracker_error_updating_userdata'], '', __LINE__, __FILE__, $sql);
	}
	if ( !empty($_SERVER['HTTP_REFERER']) )
	{
	  preg_match('#/([^/]*?)$#', $_SERVER['HTTP_REFERER'], $backlink);
	  redirect($backlink[1]);
	}
}

if ( !empty($ctracker_config->settings['login_ip_check']) && $ctracker_config->settings['login_ip_check'] == 1 && $userdata['ct_enable_ip_warn'] == 1 && $userdata['session_logged_in'] )
{
	include_once($phpbb_root_path . '/ctracker/classes/class_ct_userfunctions.' . $phpEx);
	$ctracker_user = new ct_userfunctions();
	$check_ip_range = $ctracker_user->check_ip_range();

	if ( $check_ip_range != 'allclear' )
	{
		$template->assign_block_vars('ctracker_message', array(
				'ROW_COLOR'			=> 'FFDFDF',
				'ICON_GLOB'			=> $images['ctracker_note'],
				'L_MESSAGE_TEXT'	=> $check_ip_range,
				'L_MARK_MESSAGE'	=> $lang['ctracker_gmb_markip'],
				'U_MARK_MESSAGE'	=> append_sid('index.' . $phpEx . '?marknow=ipfeature'))
		);
	}
}

/*
 * CrackerTracker Global Message Function
 */
if (isset($_GET['marknow']) && $_GET['marknow'] == 'globmsg' && $userdata['session_logged_in'])
{
	// Mark Global Message as read
	$userdata['ct_global_msg_read'] = 0;
	$sql = 'UPDATE ' . USERS_TABLE . ' SET ct_global_msg_read = 0 WHERE user_id=' . $userdata['user_id'];
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, $lang['ctracker_error_updating_userdata'], '', __LINE__, __FILE__, $sql);
	}
	if ( !empty($_SERVER['HTTP_REFERER']) )
	{
	  preg_match('#/([^/]*?)$#', $_SERVER['HTTP_REFERER'], $backlink);
	  redirect($backlink[1]);
	}
}

if ( $userdata['ct_global_msg_read'] == 1 && $userdata['session_logged_in'] && $ctracker_config->settings['global_message'] != '' )
{
	// Output Global Message
	$global_message_output = '';

	if ( $ctracker_config->settings['global_message_type'] == 1 )
	{
		$global_message_output = $ctracker_config->settings['global_message'];
	}
	else
	{
		$global_message_output = sprintf($lang['ctracker_gmb_link'], $ctracker_config->settings['global_message'], $ctracker_config->settings['global_message']);
	}

	$template->assign_block_vars('ctracker_message', array(
			'ROW_COLOR'			=> 'E1FFDF',
			'ICON_GLOB'			=> $images['ctracker_note'],
			'L_MESSAGE_TEXT'	=>  $global_message_output,
			'L_MARK_MESSAGE'	=> $lang['ctracker_gmb_mark'],
			'U_MARK_MESSAGE'	=> append_sid('index.' . $phpEx . '?marknow=globmsg'))
	);
}

(((!empty($ctracker_config->settings['login_history']) && $ctracker_config->settings['login_history'] == 1) || (!empty($ctracker_config->settings['login_ip_check']) && $ctracker_config->settings['login_ip_check'] == 1)) && $userdata['session_logged_in'])? $template->assign_block_vars('login_sec_link', array()): null;

/*
 * CrackerTracker Password Expirement Check
 */
if ( $userdata['session_logged_in'] && !empty($ctracker_config->settings['pw_control']) )
{
	if ( time() > $userdata['ct_last_pw_reset'] )
	{
		$template->assign_block_vars('ctracker_message', array(
			'ROW_COLOR'			=> 'FFDFDF',
			'ICON_GLOB'			=> $images['ctracker_note'],
			'L_MESSAGE_TEXT'	=> sprintf($lang['ctracker_info_pw_expired'], $ctracker_config->settings['pw_validity']),
			'L_MARK_MESSAGE'	=> '',
			'U_MARK_MESSAGE'	=> '')
		);
	}
}

/*
 * CrackerTracker Debug Mode Check
 */
if ( CT_DEBUG_MODE === true && $userdata['user_level'] == ADMIN )
{
  $template->assign_block_vars('ctracker_message', array(
			'ROW_COLOR'			=> 'FFDFDF',
			'ICON_GLOB'			=> $images['ctracker_note'],
			'L_MESSAGE_TEXT'	=> $lang['ctracker_dbg_mode'],
			'L_MARK_MESSAGE'	=> '',
			'U_MARK_MESSAGE'	=> '')
  );
}

// Start add - Complete banner MOD
// V: rewritten the code to do it via PHP not via SQL
$time_now=time();
$hour_now=create_date('Hi',$time_now,$board_config['board_timezone']);
$date_now=create_date('Ymd',$time_now,$board_config['board_timezone']);
$week_now=create_date('w',$time_now,$board_config['board_timezone']);
$sql = "SELECT * FROM " . BANNERS_TABLE;
if ( !($result = $db->sql_query($sql, false, "banner")) )
{
	message_die(GENERAL_ERROR, "Couldn't get banners data", "", __LINE__, __FILE__, $sql);
}
$banners = array();
while ($possible_banner = $db->sql_fetchrow($result))
{
	if (!$possible_banner['banner_active'])
	{
		continue;
	}
	$hour_within = $hour_now < $possible_banner['time_begin'] || $hour_now > $possible_banner['time_end'];
	$date_within = $date_now < $possible_banner['date_begin'] || $date_now > $possible_banner['date_end'];
	$week_within = $week_now < $possible_banner['date_begin'] || $week_now > $possible_banner['date_end'];
	switch ($possible_banner['banner_timetype'])
	{
		case 2:
			if (!$hour_within)
				continue 2;

		case 4:
			if (!$date_within)
				continue 2;

		case 6:
			if (!$week_within)
				continue 2;

		// case: 0: ;
	}

	// banner mod uses an ascending user_level system (in phpBB, mod = 2, admin = 1)
	$banner_user_level = ANONYMOUS;
	switch ($userdata['user_level'])
	{
		case USER:
			$banner_user_level = 0;
			break;
		case MOD:
			$banner_user_level = 1;
			break;
		case ADMIN:
			$banner_user_level = 2;
			break;
	}

	$banner_level = $possible_banner['banner_level'];
	switch ($possible_banner['banner_level_type'])
	{
		case 0: // must be equal
			if ($banner_level != $banner_user_level)
				continue 2; // it's not, skip this row
		case 1: // must be less or equal
			if ($banner_level > $banner_user_level)
				continue 2; // it's not, skip this row
		case 2: // must be greater or equal
			if ($banner_level < $banner_user_level)
				continue 2; // it's not, skip this row
		case 1: // must be unequal
			if ($banner_level == $banner_user_level)
				continue 2; // it's not, skip this row
	}

	// TODO implement banner_weight(?)

	$banners[] = $possible_banner;
}
$db->sql_freeresult($result);
shuffle($banners);
$banner_count = count($banners);
$last_spot = null;
for ($i = 0; $i < $banner_count; $i++)
{
	$cookie_name = $board_config['cookie_name'] . '_b_' . $banners[$i]['banner_id'];
	if ($banners[$i]['banner_filter'] && !empty($_COOKIE[$cookie_name]))
	{ // V: skip over filtered+clicked banners
		continue;
	}
	if ($banners[$i]['banner_forum'])
	{
		if (!isset($forum_id))
		{ // we're not in a forum but the banner requires one
			continue;
		}
		if ($forum != $banners[$i]['banner_forum'])
		{ // wrong forum
			continue;
		}
	}

	$banner_spot = $banners[$i]['banner_spot'];
	if ($banner_spot == $last_spot)
	{
		continue;
	}
	$last_spot = $banner_spot;

	$banner_size = ($banners[$i]['banner_width'] && $banners[$i]['banner_height']) ? '"width="'.$banners[$i]['banner_width'].'" height="'.$banners[$i]['banner_height'].'"' : '';
                $template->assign_block_vars('switch_banner_'.$banner_spot, array() );
	switch ($banners[$i]['banner_type'])
	{
		case 6:
			// swf file
			$banner_html = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,23,0" id=macromedia '.$banner_size.' align="abscenter"><param name=movie value="'.$banners[$i]['banner_name'].'"><param name=quality value=high><embed src="'.$banners[$i]['banner_name'].'" quality=high pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" autostart="true" /><noembed><a href="'.append_sid('redirect.'.$phpEx.'?banner_id='.$banners[$i]['banner_id']).'" target="_blank">'.$banners[$i]['banner_description'].'</a></noembed></object>';
			break;
		case 4:
			// custom code
			$banner_html = $banners[$i]['banner_name'];
			break;
		case 2:
			// Text link
			$banner_html = '<a href="'.append_sid('redirect.'.$phpEx.'?banner_id='.$banners[$i]['banner_id']).'" target="_blank">'.$banners[$i]['banner_name'].'</a>';
			break;
		case 0:
		default:
			$banner_html = '<a href="'.append_sid('redirect.'.$phpEx.'?banner_id='.$banners[$i]['banner_id']).'" target="_blank"><img src="'.$banners[$i]['banner_name'].'" '.$banner_size.' class="img-fluid" alt="'.$banners[$i]['banner_description'].'" title="'.$banners[$i]['banner_description'].'" /></a>';
	}
	$template->assign_vars(array('BANNER_'.$banner_spot.'_IMG' => $banner_html));
	$banner_show_list[] = $banners[$i]['banner_id'];
}
// End add - Complete banner MOD

#======================================================================= |
#==== Start: == phpBB Security ========================================= |
#==== v1.0.2 =========================================================== |
#====					
include_once($phpbb_root_path .'includes/phpbb_security.'. $phpEx);
#====
#==== Author: aUsTiN [austin@phpbb-amod.com] [http://phpbb-amod.com] === |
#==== End: ==== phpBB Security ========================================= |	
#======================================================================= |


// ----- Login Redirect for IntegraMOD 1.4.x
$upage = $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME'];
$upage = str_replace($board_config['server_name'] . $board_config['script_path'], "", $upage);
if ($_SERVER['QUERY_STRING'] != '')
{
	$upage .= '?' . $_SERVER['QUERY_STRING'];
}
// -----

#
//
// The following assigns all _common_ variables that may be used at any point
// in a template.
//
$template->assign_vars(array(
	'SITENAME' => $board_config['sitename'],
	'SITE_DESCRIPTION' => $board_config['site_desc'],
	'META_HTTP_EQUIV_TAGS' => '
	<meta http-equiv="refresh" content="' . $board_config['meta_redirect_url_time'] . '; URL=' . $board_config['meta_redirect_url_adress'] . '">
	<meta http-equiv="refresh" content="' . $board_config['meta_refresh'] .'">
	<meta http-equiv="pragma" content="' . $board_config['meta_pragma'] .'">
	<meta http-equiv="content-language" content="' . $board_config['meta_language'] .'">',
	'META_TAGS' => '
	<meta name="keywords" content="' . $board_config['meta_keywords'] .'">
	<meta name="description" content="' . $board_config['meta_description'] .'">
	<meta name="author" content="' . $board_config['meta_author'] .'">
	<meta name="identifier-url" content="' . $board_config['meta_identifier_url'] .'">
	<meta name="reply-to" content="' . $board_config['meta_reply_to'] .'">
	<meta name="revisit-after" content="' . $board_config['meta_revisit_after'] .'">
	<meta name="category" content="' . $board_config['meta_category'] .'">
	<meta name="copyright" content="' . $board_config['meta_copyright'] .'">
	<meta name="generator" content="' . $board_config['meta_generator'] .'">
	<meta name="robots" content="' . $board_config['meta_robots'] .'">
	<meta name="distribution" content="' . $board_config['meta_distribution'] .'">
	<meta name="date-creation-yyyymmdd" content="' . $board_config['meta_date_creation_year'] . '' . $board_config['meta_date_creation_month'] . '' . $board_config['meta_date_creation_day'] . '">
	<meta name="date-revision-yyyymmdd" content="' . $board_config['meta_date_revision_year'] . '' . $board_config['meta_date_revision_month'] . '' . $board_config['meta_date_revision_day'] . '">',
	// Logo Selector MOD
	'LOGO' => ($board_config['logo_image']) ? $phpbb_root_path . $board_config['logo_image_path'] .'/' . $board_config['logo_image'] : '',
	'LOGO_WIDTH' => $board_config['logo_image_w'],
	'LOGO_HEIGHT' => $board_config['logo_image_h'],
	// Logo Selector MOD
	'PAGE_TITLE' => ( isset($page_title) ? $page_title : '') ,
	'LAST_VISIT_DATE' => sprintf($lang['You_last_visit'], $s_last_visit),
	'CURRENT_TIME' => sprintf($lang['Current_time'], create_date($board_config['default_dateformat'], time(), $board_config['board_timezone'])),
	'TOTAL_USERS_ONLINE' => $l_online_users,
	'LOGGED_IN_USER_LIST' => $online_userlist,
	'USERS_OF_THE_DAY_LIST' => $day_userlist,
	'RECORD_USERS' => sprintf($lang['Record_online_users'], $board_config['record_online_users'], create_date($board_config['default_dateformat'], $board_config['record_online_date'], $board_config['board_timezone'])),
	'PRIVATE_MESSAGE_INFO' => $l_privmsgs_text,
	'PRIVATE_MESSAGE_INFO_UNREAD' => $l_privmsgs_text_unread,
	'PRIVATE_MESSAGE_NEW_FLAG' => $s_privmsg_new,
	'REPORT_LIST' => $report_list,
	'USER_EXTRA' => ($userdata['user_extra']) ? '0' : '1',
	'L_NO_CLICK' => $lang['No_r_click'],
	'L_NO_COPY' => $lang['No_copy'],
	'PRIVMSG_IMG' => $icon_pm,

	'L_USERNAME' => $lang['Username'],
	'L_PASSWORD' => $lang['Password'],
	'L_LOGIN_SEC' => $lang['ctracker_gmb_loginlink'],
	'L_LOGIN_LOGOUT' => $l_login_logout,
	'L_LOGIN' => $lang['Login'],
	'L_LOG_ME_IN' => $lang['Log_me_in'],
	'L_AUTO_LOGIN' => $lang['Log_me_in'],
	'L_INDEX' => sprintf($lang['Forum_Index'], $board_config['sitename']),
//	'L_REGISTER' => $lang['Register'],
//	'L_PROFILE' => $lang['Profile'],
//	'L_SEARCH' => $lang['Search'],
	'L_PRIVATEMSGS' => $lang['Private_Messages'], 

	'L_TOPIC_UP_IMAGE' => $lang['Go_to_Top'],
	'L_TOPIC_DOWN_IMAGE' => $lang['Go_to_Bottom'],
//	'L_DIGESTS' => $lang['digest_page_title'], 


	'L_WHO_IS_ONLINE' => $lang['Who_is_Online'],
//	'L_MEMBERLIST' => $lang['Memberlist'],
//	'L_FAQ' => $lang['FAQ'],
//-- mod : Advanced Group Color Management -------------------------------------
//-- add
	'L_GROUP_LEGEND' => $lang['AGCM_legend'],
//-- fin mod : Advanced Group Color Management ---------------------------------
 	'L_USERGROUPS' => $lang['Usergroups'],
	"L_LW_DONATE_SITE" => '<a href="' . append_sid('lwdonate.'.$phpEx) . '" class="mainmenu"><img src="http://www.paypal.com/en_US/i/btn/x-click-but04.gif" border="0" alt="' . $lang['LW_DONATION_TO_HELP'] . '" hspace="3" /></a>',  
	'L_SEARCH_NEW' => $lang['Search_new'],
	'L_SEARCH_UNANSWERED' => $lang['Search_unanswered'],
	'L_SEARCH_SELF' => $lang['Search_your_posts'],
	//-- mod : profile cp ------------------------------------------------------------------------------
//-- delete
//	'L_WHOSONLINE_ADMIN' => sprintf($lang['Admin_online_color'], '<span style="color:#' . $theme['fontcolor3'] . '">', '</span>'),
//	'L_WHOSONLINE_MOD' => sprintf($lang['Mod_online_color'], '<span style="color:#' . $theme['fontcolor2'] . '">', '</span>'),
	'L_LW_TRANSACTIONS' => $lang['LW_TRANSACTION_RECORDS'],
	'U_LW_TRANSACTIONS' => append_sid('lwacctrecords.'.$phpEx),
	'L_LW_PAYMENTS' => $lang['L_LW_PAYMENTS'],
	'U_LW_PAYMENTS' => append_sid('lwtopup.'.$phpEx),
	'L_LW_TRANSACTIONS' => $lang['LW_TRANSACTION_RECORDS'],
	'U_LW_TRANSACTIONS' => append_sid('lwacctrecords.'.$phpEx),
	'L_LW_PAYMENTS' => $lang['L_LW_PAYMENTS'],
	'U_LW_PAYMENTS' => append_sid('lwtopup.'.$phpEx),
  //-- add
  // V: REMOVED BY AGCM
// 'L_WHOSONLINE' => get_users_online_color(),
//-- fin mod : profile cp --------------------------------------------------------------------------
	'U_PORTAL' =>  append_sid('portal.'.$phpEx),
	'U_SEARCH_UNANSWERED' => append_sid('search.'.$phpEx.'?search_id=unanswered'),
	'U_SEARCH_SELF' => append_sid('search.'.$phpEx.'?search_id=egosearch'),
	'U_SEARCH_NEW' => append_sid('search.'.$phpEx.'?search_id=newposts'),
	'U_INDEX' => append_sid('index.'.$phpEx),
	'U_LOGIN_SEC' => append_sid('ct_login_history.' . $phpEx),
	'U_REGISTER' => append_sid('profile.'.$phpEx.'?mode=profil&sub=profile_prefer&mod=0'),
	'U_PROFILE' => append_sid('profile.'.$phpEx.'?mode=editprofile'),
	'U_PRIVATEMSGS' => append_sid('privmsg.'.$phpEx.'?folder=inbox'),
	'U_PRIVATEMSGS_POPUP' => append_sid('privmsg.'.$phpEx.'?mode=newpm'),
	'U_SEARCH' => append_sid('search.'.$phpEx),
	// Referral MOD for PCP
	'U_MEMBERLIST' => append_sid('memberlist.'.$phpEx),
	'U_DIGESTS' => append_sid('digests.'.$phpEx),
	'U_MODCP' => append_sid('modcp.'.$phpEx),
	'U_FAQ' => append_sid('faq.'.$phpEx),
	'U_VIEWONLINE' => append_sid('viewonline.'.$phpEx),
	'U_LOGIN_LOGOUT' => append_sid($u_login_logout),
	'U_GROUP_CP' => append_sid('groupcp.'.$phpEx),
	'U_REPORT_LIST' => append_sid("report.$phpEx"),
	// Mighty Gorgon - Full Album Pack - BEGIN
	'L_ALBUM' => $lang['Album'],
	'U_ALBUM' => append_sid('album.'.$phpEx),
	'L_PIC_NAME' => $lang['Pic_Name'],
	'L_DESCRIPTION' => $lang['Description'],
	'L_GO' => $lang['Go'],
	'L_SEARCH_CONTENTS' => $lang['Search_Contents'],
	'L_SEARCH_MATCHES' => $lang['Search_Matches'],
	// Mighty Gorgon - Full Album Pack - END
	'U_THISUSER' => $userdata['username'],

// ----- Login Redirect for IntegraMOD 1.4.x
	'U_PAGE' => append_sid($upage),
// -----


	'S_CONTENT_DIRECTION' => $lang['DIRECTION'],
	'S_CONTENT_ENCODING' => $lang['ENCODING'],
	'S_CONTENT_DIR_LEFT' => $lang['LEFT'],
	'S_CONTENT_DIR_RIGHT' => $lang['RIGHT'],
	'S_TIMEZONE' => sprintf($lang['All_times'], $l_timezone),
	'S_LOGIN_ACTION' => append_sid('login.'.$phpEx),
    'S_LANG' => 'lang_'.$board_config['default_lang'],

	'T_HEAD_STYLESHEET' => $theme['head_stylesheet'],
	'T_BODY_BACKGROUND' => $theme['body_background'],
	'T_BODY_BGCOLOR' => '#'.$theme['body_bgcolor'],
	'T_BODY_TEXT' => '#'.$theme['body_text'],
	'T_BODY_LINK' => '#'.$theme['body_link'],
	'T_BODY_VLINK' => '#'.$theme['body_vlink'],
	'T_BODY_ALINK' => '#'.$theme['body_alink'],
	'T_BODY_HLINK' => '#'.$theme['body_hlink'],
	'T_TR_COLOR1' => '#'.$theme['tr_color1'],
	'T_TR_COLOR2' => '#'.$theme['tr_color2'],
	'T_TR_COLOR3' => '#'.$theme['tr_color3'],
	'T_TR_CLASS1' => $theme['tr_class1'],
	'T_TR_CLASS2' => $theme['tr_class2'],
	'T_TR_CLASS3' => $theme['tr_class3'],
	'T_TH_COLOR1' => '#'.$theme['th_color1'],
	'T_TH_COLOR2' => '#'.$theme['th_color2'],
	'T_TH_COLOR3' => '#'.$theme['th_color3'],
	'T_TH_CLASS1' => $theme['th_class1'],
	'T_TH_CLASS2' => $theme['th_class2'],
	'T_TH_CLASS3' => $theme['th_class3'],
	'T_TD_COLOR1' => '#'.$theme['td_color1'],
	'T_TD_COLOR2' => '#'.$theme['td_color2'],
	'T_TD_COLOR3' => '#'.$theme['td_color3'],
	'T_TD_CLASS1' => $theme['td_class1'],
	'T_TD_CLASS2' => $theme['td_class2'],
	'T_TD_CLASS3' => $theme['td_class3'],
	'T_FONTFACE1' => $theme['fontface1'],
	'T_FONTFACE2' => $theme['fontface2'],
	'T_FONTFACE3' => $theme['fontface3'],
	'T_FONTSIZE1' => $theme['fontsize1'],
	'T_FONTSIZE2' => $theme['fontsize2'],
	'T_FONTSIZE3' => $theme['fontsize3'],
	'T_FONTCOLOR1' => '#'.$theme['fontcolor1'],
	'T_FONTCOLOR2' => '#'.$theme['fontcolor2'],
	'T_FONTCOLOR3' => '#'.$theme['fontcolor3'],
	'T_SPAN_CLASS1' => $theme['span_class1'],
	'T_SPAN_CLASS2' => $theme['span_class2'],
	'T_SPAN_CLASS3' => $theme['span_class3'],

	'NAV_LINKS' => $nav_links_html)
);

//
// Login box?
//
if ( !$userdata['session_logged_in'] )
{
	$template->assign_block_vars('switch_user_logged_out', array());
	//
	// Allow autologin?
	//
	if (!isset($board_config['allow_autologin']) || $board_config['allow_autologin'] )
	{
		$template->assign_block_vars('switch_allow_autologin', array());
		$template->assign_block_vars('switch_user_logged_out.switch_allow_autologin', array());
	}
}
else
{
	$template->assign_block_vars('switch_user_logged_in', array());

	if ( !empty($userdata['user_popup_pm']) )
	{
		$template->assign_block_vars('switch_enable_pm_popup', array());
	}
	if ( $board_config['lw_header_reminder'] == 1)
	{
		require($phpbb_root_path . 'includes/lw_ipn_grp_functions.'.$phpEx);
		$lwuserreminder = lw_write_header_reminder();
		$template->assign_block_vars('switch_lw_user_logged_in', array());
		$template->assign_var('L_LW_EXPIRE_REMINDER', $lwuserreminder); 
	}
}

// Add no-cache control for cookies if they are set
//$c_no_cache = (isset($_COOKIE[$board_config['cookie_name'] . '_sid']) || isset($_COOKIE[$board_config['cookie_name'] . '_data'])) ? 'no-cache="set-cookie", ' : '';

// Work around for "current" Apache 2 + PHP module which seems to not
// cope with private cache control setting
if (!empty($_SERVER['SERVER_SOFTWARE']) && strstr($_SERVER['SERVER_SOFTWARE'], 'Apache/2'))
{
	header ('Cache-Control: no-cache, pre-check=0, post-check=0');
}
else
{
	header ('Cache-Control: private, pre-check=0, post-check=0, max-age=0');
}
header ('Expires: 0');
header ('Pragma: no-cache');

//-- mod : profile cp ------------------------------------------------------------------------------
//-- add
if ( $userdata['session_logged_in'] )
{
	if (empty($gen_simple_header))
	{
		$today_year = date('Y', cal_date(time(),$board_config['board_timezone']));
		$today_month = date('m', cal_date(time(),$board_config['board_timezone']));
		$today_day = date('d', cal_date(time(),$board_config['board_timezone']));
		$today = mktime( 0, 0, 1, $today_month, $today_day, $today_year );

		$birthday_year = $today_year;
		$birthday_month = intval(substr($userdata['user_birthday'], 4, 2));
		$birthday_day = intval(substr($userdata['user_birthday'], 6, 2 ));
		$birthday = mktime( 0, 0, 1, $birthday_month, $birthday_day, $birthday_year );

		$last_year = date('Y', $userdata['user_last_birthday']);
		$last_month = date('m', $userdata['user_last_birthday']);
		$last_day = date('d', $userdata['user_last_birthday']);
		$last = (intval($userdata['user_last_birthday']) > 0 ) ? mktime( 0, 0, 1, $last_month, $last_day, $last_year ) : 0;

		// one week limit
		if ( ($last < $birthday) && ($today >= $birthday) && ($today <= ($birthday + 3600*24*7)) )
		{
			$userdata['user_last_birthday'] = cal_date(time(),$board_config['board_timezone']);
			$sql = "UPDATE " . USERS_TABLE . " 
					SET user_last_birthday = " . $userdata['user_last_birthday'] . " 
					WHERE user_id = " . $userdata['user_id'];
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not update user information', '', __LINE__, __FILE__, $sql);
			}
			$template->assign_block_vars('birthday_popup', array(
				'U_BIRTHDAY_POPUP' => append_sid('profile_birthday.'.$phpEx),
				)
			);
		}
	}
}

// birthday today list
if (!function_exists("get_birthday_list")) {
function get_birthday_list( $time )
{
	global $db, $phpbb_root_path, $phpEx, $userdata, $admin_level, $level_prior, $agcm_color;

	$res = '';

	// no guest here, sorry ;)
	if ( ($userdata['user_id'] == ANONYMOUS) || !$userdata['session_logged_in']) return $res;

	$today = date("md", $time);
	$user_id = $userdata['user_id'];
	$sql = "SELECT u.*, 
					(CASE WHEN i.buddy_ignore = 1 THEN 1 ELSE 0 END) AS user_ignore,
					(CASE WHEN b.buddy_ignore = 0 THEN 1 ELSE 0 END) AS user_friend,
					(CASE WHEN b.buddy_visible = 1 THEN 1 ELSE 0 END) AS user_visible
				FROM ((" . USERS_TABLE . " AS u 
				LEFT JOIN " . BUDDYS_TABLE . " AS b	ON b.user_id=u.user_id AND b.buddy_id=$user_id)
				LEFT JOIN " . BUDDYS_TABLE . " AS i ON i.user_id=$user_id AND i.buddy_id=u.user_id)
				WHERE u.user_id <> " . ANONYMOUS . " AND u.user_birthday <> 0 AND u.user_birthday <> '' and RIGHT(u.user_birthday, 4) = $today 
				ORDER BY username";
	if ( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not read user table to get birthday today info', '', __LINE__, __FILE__, $sql);
	}
	while ($row = $db->sql_fetchrow($result))
	{
		// get user relational status
		$ignore  = $row['user_ignore'];
		$friend  = $row['user_friend'];
		$always_visible = $row['user_visible'];

		// get the status of each info
		$real_display = ( !$ignore && $userdata['user_allow_real'] && $row['user_allow_real'] && ( ($row['user_viewreal'] == YES) || ( ($row['user_viewreal'] == FRIEND_ONLY) && $friend ) ) );

		// take care of admin status
		if ( is_admin($userdata) || ($row['user_id'] == $userdata['user_id']) ) $real_display = true;

		if ($real_display)
		{
			$txtclass = $agcm_color->get_user_color($row['user_group_id'], $row['user_session_time']);
			if ($row['user_allow_viewonline'] != YES) $row['username'] = '<i>' . $row['username'] . '</i>';
			$temp_url = append_sid("profile.$phpEx?mode=viewprofile&" . POST_USERS_URL . "=" . $row['user_id']);
			$row['username'] = '<a href="' . $temp_url . '" class="' . $txtclass . '">' . $row['username'] . '</a>';

			// add to the user list
			$res .= ( $res != '' ) ? ', ' : '';
			$res .= $row['username'];
		}
	}
	return $res;
}

// send happy birthday list
if (defined('SHOW_ONLINE') && $userdata['session_logged_in'])
{
	$birthday_fellows = get_birthday_list(cal_date(time(),$board_config['board_timezone']));
	if ( !empty($birthday_fellows) )
	{
		$template->assign_block_vars('switch_happy_birthday', array());
	}
	$template->assign_vars(array(
		'HAPPY_BIRTHDAY_IMG' => $images['Happy_birthday'],
		'L_HAPPY_BIRTHDAY' => $lang['Happy_birthday'],
		'HAPPY_BIRTHDAY_FELLOWS' => $birthday_fellows,
		)
	);
}
}
//-- fin mod : profile cp --------------------------------------------------------------------------


//-- fin mod : profile cp --------------------------------------------------------------------------
//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
// get the nav sentence
$nav_key = '';
if (isset($_POST[POST_CAT_URL]) || isset($_GET[POST_CAT_URL]))
{
	$nav_key = POST_CAT_URL . ((isset($_POST[POST_CAT_URL])) ? intval($_POST[POST_CAT_URL]) : intval($_GET[POST_CAT_URL]));
}
if (isset($_POST[POST_FORUM_URL]) || isset($_GET[POST_FORUM_URL]))
{
	$nav_key = POST_FORUM_URL . ((isset($_POST[POST_FORUM_URL])) ? intval($_POST[POST_FORUM_URL]) : intval($_GET[POST_FORUM_URL]));
}
if (isset($_POST[POST_TOPIC_URL]) || isset($_GET[POST_TOPIC_URL]))
{
	$nav_key = POST_TOPIC_URL . ((isset($_POST[POST_TOPIC_URL])) ? intval($_POST[POST_TOPIC_URL]) : intval($_GET[POST_TOPIC_URL]));
}
if (isset($_POST[POST_POST_URL]) || isset($_GET[POST_POST_URL]))
{
	$nav_key = POST_POST_URL . ((isset($_POST[POST_POST_URL])) ? intval($_POST[POST_POST_URL]) : intval($_GET[POST_POST_URL]));
}
if ( empty($nav_key) && (isset($_POST['selected_id']) || isset($_GET['selected_id'])) )
{
   $nav_key = isset($_GET['selected_id']) ? $_GET['selected_id'] : $_POST['selected_id'];
}
if ( empty($nav_key) )
{
	$nav_key = 'Root';
}
$nav_cat_desc = make_cat_nav_tree($nav_key, isset($nav_pgm) ? $nav_pgm : '', 'nav', isset($topic_topic_title) ? $topic_topic_title : '', isset($topic_forum_id) ? $topic_forum_id : 0);
if ( !empty($nav_cat_desc) )
{
	$nav_cat_desc = ( isset($nav_separator) ? $nav_separator : '' ) . $nav_cat_desc;
}

// send to template
$template->assign_vars(array(
	'SPACER'		=> $images['spacer'],
	'NAV_SEPARATOR' => ( isset($nav_separator) ? $nav_separator : '' ),
	'NAV_CAT_DESC'	=> $nav_cat_desc,
	)
);
//-- fin mod : categories hierarchy ----------------------------------------------------------------

//-- mod : calendar --------------------------------------------------------------------------------
//-- add
if (!defined('IN_CALENDAR'))
{
	if ( intval($board_config['calendar_header_cells']) > 0 )
	{
		include_once($phpbb_root_path . './includes/functions_calendar.' . $phpEx);
		display_calendar('CALENDAR_BOX', intval($board_config['calendar_header_cells']));
	}
}
//-- fin mod : calendar ----------------------------------------------------------------------------

//-- mod : qbar ------------------------------------------------------------------------------------
//-- add
include( $phpbb_root_path . 'includes/functions_qbar.' . $phpEx);
qbar_display_qbars(empty($gen_simple_header));
//-- fin mod : qbar --------------------------------------------------------------------------------

//
// IM Portal https://integramod.com
//

// debug forum wide Portal
/*if($layout_forum_wide_flag)
	$temp_debug = 1;
else
	$temp_debug = 0;
die('debug: ' . strval(empty($gen_simple_header)) . ' | ' . strval($temp_debug) . ' | ' . strval($portal_config['portal_header']) . ' | ' . strval(defined('HAS_DIED')) . ' | ' . strval(defined('IN_LOGIN')));*/
// debug forum wide Portal

//
// IM Portal blocks
//
if(empty($gen_simple_header))
{
	if(empty($layout_forum_wide_flag) && $portal_config['portal_header'])
	{
		if(defined('HAS_DIED') || defined('IN_LOGIN')){
			$template->assign_vars(array('FOOTER_WIDTH' => 0));
		} else {
		if($portal_config['portal_tail'])
		{
			$template->assign_block_vars('switch_portal_both', array());
			$template->assign_vars(array('FOOTER_WIDTH' => $portal_config['footer_width']));
		}
		else
		{
			$template->assign_block_vars('switch_portal_header', array());
		}
		$template->set_filenames(array(
			'portal_header'         => 'portal_page_header.tpl')
		);
		portal_parse_blocks($portal_config['default_portal'], TRUE, 'header');
		$template->assign_vars(array('HEADER_WIDTH' => $portal_config['header_width']));
		$template->assign_vars(array('PORTAL_HEADER' => portal_assign_var_from_handle($template, 'portal_header')));
		}
	}
	else if ($portal_config['portal_tail'])
	{
		$template->assign_block_vars('switch_portal_tail', array());
		$template->assign_vars(array('FOOTER_WIDTH' => $portal_config['footer_width']));
	}
}
//
// end of IM Portal blocks
//

//-- mod : Advanced Group Color Management -------------------------------------
//-- add
$agcm_color->generate_css();
//-- fin mod : Advanced Group Color Management ---------------------------------
$template->pparse('overall_header');

#======================================================================= |
#==== Start: == phpBB Security ========================================= |
#==== v1.0.3 =========================================================== |
#====
	phpBBSecurity_FinalSet();
	phpBBSecurity_DBBackup();

	/* removed by PCP Extra :: force_required() below will manage this...
	# Only allow them to login & view profile to update it
	if ($_SERVER['PHP_SELF'] == $board_config['script_path'] .'profile.'. $phpEx)
		$is_valid = TRUE;
	elseif ($_SERVER['PHP_SELF'] == $board_config['script_path'] .'login.'. $phpEx)
		$is_valid = TRUE;
	else
		$is_valid = '';
		
	if ( (!$is_valid) && (!$gen_simple_header) ) 
		{
		# Make sure they are not a guest
		if ($userdata['user_id'] != ANONYMOUS)
			{
			# Do the check
			if (!$userdata['phpBBSecurity_answer'] || !$userdata['phpBBSecurity_question'])
				phpBBSecurity_Force();
				
			if ($userdata['phpBBSecurity_force_pw_update'] != 1)
				message_die(GENERAL_ERROR, sprintf($lang['PS_pass_force'], '<a href="profile.'. $phpEx .'?mode=editprofile&amp;infrom=phpBBSecurity&amp;sid='. $userdata['session_id'] .'">', '</a>'));
			}
		}*/
#====
#==== Author: aUsTiN [austin@phpbb-amod.com] [http://phpbb-tweaks.com] = |
#==== End: ==== phpBB Security ========================================= |	
#======================================================================= |

?>
