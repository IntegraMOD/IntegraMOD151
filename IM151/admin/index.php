<?php
/***************************************************************************
 *                             (admin) index.php
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

define('IN_PHPBB', 1);

//
// Load default header
//
$no_page_header = TRUE;
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

include_once($phpbb_root_path . 'includes/lite.'.$phpEx);
$options = array(
    'cacheDir' => $phpbb_root_path . 'var_cache/',
);

$var_cache = new Cache_Lite($options);

$var_cache->clean('mod');

// ---------------
// Begin functions
//
function inarray($needle, $haystack)
{ 
	for($i = 0; $i < sizeof($haystack); $i++ )
	{ 
		if( $haystack[$i] == $needle )
		{ 
			return true; 
		} 
	} 
	return false; 
}
//
// End functions
// -------------

include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_admin_pafiledb.' . $phpEx);
include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_dbmtnc.' . $phpEx);

$page_title = $lang['Admin_panel'];
//
// Generate relevant output
//
if( isset($_GET['pane']) && $_GET['pane'] == 'left' )
{
	$jr_admin_userdata = jr_admin_get_user_info($userdata['user_id']);
	$module = jr_admin_get_module_list(isset($jr_admin_userdata) ? $jr_admin_userdata['user_jr_admin'] : null);

	include('./page_header_admin.'.$phpEx);

	$template->set_filenames(array(
		"body" => "admin/index_navigate.tpl")
	);

	$template->assign_vars(array(
		"U_FORUM_INDEX" => append_sid("../index.$phpEx"),
		"U_PORTAL_INDEX" => append_sid("../portal.$phpEx"),
		"U_ADMIN_INDEX" => append_sid("index.$phpEx?pane=right"),
		'COOKIE_NAME'	=> $board_config['cookie_name'],
		'COOKIE_PATH'	=> $board_config['cookie_path'],
		'COOKIE_DOMAIN'	=> $board_config['cookie_domain'],
		'COOKIE_SECURE'	=> $board_config['cookie_secure'],

		"L_PORTAL_INDEX" => $lang['Portal_index'],
		"L_PREVIEW_PORTAL" => $lang['Preview_portal'],
		"L_FORUM_INDEX" => $lang['Main_index'],
		"L_ADMIN_INDEX" => $lang['Admin_Index'], 
		"L_PREVIEW_FORUM" => $lang['Preview_forum'])
	);

	jr_admin_make_left_pane();

	$template->pparse("body");

	include('./page_footer_admin.'.$phpEx);
}
elseif( isset($_GET['pane']) && $_GET['pane'] == 'right' )
{
	include('./page_header_admin.'.$phpEx);

	$template->set_filenames(array(
		"body" => "admin/index_body.tpl")
	);

/***************************************************************************
*
* #======================================================================= |
* #==== Start: == phpBB Security ========================================= |
* #==== v1.0.3 =========================================================== |
* #====		
* 	$secfile = @file('http://phpbb-tweaks.com/secver.txt');
*	$msg = '';
*	$msg .= '<table align="top" class="forumline" width="100%">';
*	$msg .= '	<tr>';
*	$msg .= '		<th align="center" valign="middle" class="thTop" width="100%">';
*	$msg .= '			phpBB Security Status';
*	$msg .= '		</th>';
*	$msg .= '	</tr>';
*	$msg .= '	<tr>';
*	$msg .= '		<td align="left" width="100%" class="row2">';
*	$msg .= '			<span class="genmed">';
*	if (!$secfile)
*		$msg .= 'Sorry, I was unable to get version data at this time. Please try later.';
*	
*	if ($secfile)
*		{
*	$newest_ver = $secfile[0];
*	$this_ver 	= $board_config['phpBBSecurity_version'];
*	
*		if ($newest_ver == $this_ver)
*			$msg .= 'The newest release is <b>'. $newest_ver .'</b>. The version you are using is 
*			<b>'. $this_ver .'</b>. So I would have to say you are up to date!';
*		else
*			$msg .= 'The newest release is <b>'. $newest_ver .'</b>. The version you are using is 
*			<b>'. $this_ver .'</b>. So I would have to say you need to upgrade ASAP!';
*		}
*		
*	$msg .= '			</span>';
*	$msg .= '		</td>';
*	$msg .= '	</tr>';
*	$msg .= '	<tr>';
*	$msg .= '		<th align="center" valign="middle" class="thTop" width="100%">&nbsp;</th>';
*	$msg .= '	</tr>';
*	$msg .= '</table>';
*	echo $msg;
* #====
* #==== Author: aUsTiN [austin@phpbb-amod.com] [http://phpbb-tweaks.com] = |
* #==== End: ==== phpBB Security ========================================= |	
* #======================================================================= |
***************************************************************************/
	$template->assign_vars(array(
		"L_WELCOME" => $lang['Welcome_phpBB'],
		"L_WELCOME_IM" => $lang['Welcome_IM'],
		"L_ADMIN_INTRO" => $lang['Admin_intro'],
		"L_FORUM_STATS" => $lang['Forum_stats'],
		"L_WHO_IS_ONLINE" => $lang['Who_is_Online'],
		"L_USERNAME" => $lang['Username'],
		"L_LOCATION" => $lang['Location'],
		"L_LAST_UPDATE" => $lang['Last_updated'],
		"L_IP_ADDRESS" => $lang['IP_Address'],
		"L_STATISTIC" => $lang['Statistic'],
		"L_VALUE" => $lang['Value'],
		"L_NUMBER_POSTS" => $lang['Number_posts'],
		"L_POSTS_PER_DAY" => $lang['Posts_per_day'],
		"L_NUMBER_TOPICS" => $lang['Number_topics'],
		"L_TOPICS_PER_DAY" => $lang['Topics_per_day'],
		"L_NUMBER_USERS" => $lang['Number_users'],
		"L_USERS_PER_DAY" => $lang['Users_per_day'],
		"L_BOARD_STARTED" => $lang['Board_started'],
		"L_AVATAR_DIR_SIZE" => $lang['Avatar_dir_size'],
		"L_DB_SIZE" => $lang['Database_size'], 
		"L_FORUM_LOCATION" => $lang['Forum_Location'],
		"L_STARTED" => $lang['Login'],
		"L_GZIP_COMPRESSION" => $lang['Gzip_compression'])
	);

	//
	// Get forum statistics
	//
	$total_posts = get_db_stat('postcount');
	$total_users = get_db_stat('usercount');
	$total_topics = get_db_stat('topiccount');

	$start_date = create_date($board_config['default_dateformat'], $board_config['board_startdate'], $board_config['board_timezone']);

	$boarddays = ( time() - $board_config['board_startdate'] ) / 86400;

	$posts_per_day = sprintf("%.2f", $total_posts / $boarddays);
	$topics_per_day = sprintf("%.2f", $total_topics / $boarddays);
	$users_per_day = sprintf("%.2f", $total_users / $boarddays);

	$avatar_dir_size = 0;

	if ($avatar_dir = @opendir($phpbb_root_path . $board_config['avatar_path']))
	{
		while( $file = @readdir($avatar_dir) )
		{
			if( $file != "." && $file != ".." )
			{
				$avatar_dir_size += @filesize($phpbb_root_path . $board_config['avatar_path'] . "/" . $file);
			}
		}
		@closedir($avatar_dir);

		//
		// This bit of code translates the avatar directory size into human readable format
		// Borrowed the code from the PHP.net annoted manual, origanally written by:
		// Jesse (jesse@jess.on.ca)
		//
		if($avatar_dir_size >= 1048576)
		{
			$avatar_dir_size = round($avatar_dir_size / 1048576 * 100) / 100 . " MB";
		}
		else if($avatar_dir_size >= 1024)
		{
			$avatar_dir_size = round($avatar_dir_size / 1024 * 100) / 100 . " KB";
		}
		else
		{
			$avatar_dir_size = $avatar_dir_size . " Bytes";
		}

	}
	else
	{
		// Couldn't open Avatar dir.
		$avatar_dir_size = $lang['Not_available'];
	}

	if($posts_per_day > $total_posts)
	{
		$posts_per_day = $total_posts;
	}

	if($topics_per_day > $total_topics)
	{
		$topics_per_day = $total_topics;
	}

	if($users_per_day > $total_users)
	{
		$users_per_day = $total_users;
	}

	//
	// DB size ... MySQL only
	//
	// This code is heavily influenced by a similar routine
	// in phpMyAdmin 2.2.0
	//
	if( preg_match("/^mysql/", SQL_LAYER) )
	{
		$sql = "SELECT VERSION() AS mysql_version";
		if($result = $db->sql_query($sql))
		{
			$row = $db->sql_fetchrow($result);
			$mysql_version = $row['mysql_version'];

			$db_name = "`$dbname`";

			$sql = "SHOW TABLE STATUS 
				FROM " . $db_name;
			if($result = $db->sql_query($sql))
			{
				$tabledata_ary = $db->sql_fetchrowset($result);

				$dbsize = 0;
				for($i = 0; $i < count($tabledata_ary); $i++)
				{
					if( $table_prefix != "" )
					{
						if( strstr($tabledata_ary[$i]['Name'], $table_prefix) )
						{
							$dbsize += $tabledata_ary[$i]['Data_length'] + $tabledata_ary[$i]['Index_length'];
						}
					}
					else
					{
						$dbsize += $tabledata_ary[$i]['Data_length'] + $tabledata_ary[$i]['Index_length'];
					}
				}
			}
		}
		else
		{
			$dbsize = $lang['Not_available'];
		}
	}
	else if( preg_match("/^mssql/", SQL_LAYER) )
	{
		$sql = "SELECT ((SUM(size) * 8.0) * 1024.0) as dbsize 
			FROM sysfiles"; 
		if( $result = $db->sql_query($sql) )
		{
			$dbsize = ( $row = $db->sql_fetchrow($result) ) ? intval($row['dbsize']) : $lang['Not_available'];
		}
		else
		{
			$dbsize = $lang['Not_available'];
		}
	}
	else
	{
		$dbsize = $lang['Not_available'];
	}

	if ( is_integer($dbsize) )
	{
		if( $dbsize >= 1048576 )
		{
			$dbsize = sprintf("%.2f MB", ( $dbsize / 1048576 ));
		}
		else if( $dbsize >= 1024 )
		{
			$dbsize = sprintf("%.2f KB", ( $dbsize / 1024 ));
		}
		else
		{
			$dbsize = sprintf("%.2f Bytes", $dbsize);
		}
	}

	$template->assign_vars(array(
		"NUMBER_OF_POSTS" => $total_posts,
		"NUMBER_OF_TOPICS" => $total_topics,
		"NUMBER_OF_USERS" => $total_users,
		"START_DATE" => $start_date,
		"MYSQL_VERSION" => $mysql_version,
		"PHP_VERSION" => phpversion(),
      	"POSTS_PER_DAY" => $posts_per_day,
		"TOPICS_PER_DAY" => $topics_per_day,
		"USERS_PER_DAY" => $users_per_day,
		"AVATAR_DIR_SIZE" => $avatar_dir_size,
		"DB_SIZE" => $dbsize, 
		"GZIP_COMPRESSION" => ( $board_config['gzip_compress'] ) ? $lang['ON'] : $lang['OFF'],
		"L_PHP_VERSION" => $lang['Version_of_PHP'],
		"L_MYSQL_VERSION" => $lang['Version_of_MySQL'],
	));
	//
	// End forum statistics
	//

	//
	// Get users online information.
	//
	$sql = "SELECT u.user_group_id, u.user_id, u.username, u.user_session_time, u.user_session_page, u.user_allow_viewonline, s.session_logged_in, s.session_ip, s.session_start, u.user_level
		FROM " . USERS_TABLE . " u, " . SESSIONS_TABLE . " s
		WHERE s.session_logged_in = " . TRUE . " 
			AND u.user_id = s.session_user_id 
			AND u.user_id <> " . ANONYMOUS . " 
			AND s.session_time >= " . ( time() - 300 ) . " 
		ORDER BY u.user_session_time DESC";
	if(!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, "Couldn't obtain regd user/online information.", "", __LINE__, __FILE__, $sql);
	}
	$onlinerow_reg = $db->sql_fetchrowset($result);

	$sql = "SELECT session_page, session_logged_in, session_time, session_ip, session_start   
		FROM " . SESSIONS_TABLE . "
		WHERE session_logged_in = 0
			AND session_time >= " . ( time() - 300 ) . "
		ORDER BY session_time DESC";
	if(!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, "Couldn't obtain guest user/online information.", "", __LINE__, __FILE__, $sql);
	}
	$onlinerow_guest = $db->sql_fetchrowset($result);

	$sql = "SELECT forum_name, forum_id
		FROM " . FORUMS_TABLE;
	if($forums_result = $db->sql_query($sql))
	{
		while($forumsrow = $db->sql_fetchrow($forums_result))
		{
			$forum_data[$forumsrow['forum_id']] = $forumsrow['forum_name'];
		}
	}
	else
	{
		message_die(GENERAL_ERROR, "Couldn't obtain user/online forums information.", "", __LINE__, __FILE__, $sql);
	}

	$reg_userid_ary = array();

	if( count($onlinerow_reg) )
	{
		$registered_users = 0;

		for($i = 0; $i < count($onlinerow_reg); $i++)
		{
			if( !inarray($onlinerow_reg[$i]['user_id'], $reg_userid_ary) )
			{
				$reg_userid_ary[] = $onlinerow_reg[$i]['user_id'];

				$username = $onlinerow_reg[$i]['username'];

				if( $onlinerow_reg[$i]['user_allow_viewonline'] || $userdata['user_level'] == ADMIN )
				{
					$registered_users++;
					$hidden = FALSE;
				}
				else
				{
					$hidden_users++;
					$hidden = TRUE;
				}

				if( $onlinerow_reg[$i]['user_session_page'] < 1 )
				{
					switch($onlinerow_reg[$i]['user_session_page'])
					{
						case PAGE_INDEX:
						$location = $lang['Forum_index'];
						$location_url = "../index.$phpEx";
						break;
					case PAGE_POSTING:
						$location = $lang['Posting_message'];
						$location_url = "../index.$phpEx";
						break;
					case PAGE_LOGIN:
						$location = $lang['Logging_on'];
						$location_url = "../index.$phpEx";
						break;
					case PAGE_SEARCH:
						$location = $lang['Searching_forums'];
						$location_url = "../search.$phpEx";
						break;
					case PAGE_PROFILE:
						$location = $lang['Viewing_profile'];
						$location_url = "../index.$phpEx";
						break;
					case PAGE_VIEWONLINE:
						$location = $lang['Viewing_online'];
						$location_url = "../viewonline.$phpEx";
						break;
					case PAGE_VIEWMEMBERS:
						$location = $lang['Viewing_member_list'];
						$location_url = "../memberlist.$phpEx";
						break;
					case PAGE_PRIVMSGS:
						$location = $lang['Viewing_priv_msgs'];
						$location_url = "../privmsg.$phpEx";
						break;
					case PAGE_FAQ:
						$location = $lang['Viewing_FAQ'];
						$location_url = "../faq.$phpEx";
						break;
					// Mighty Gorgon - Full Album Pack - BEGIN
					case PAGE_ALBUM:
						$location = $lang['View_Album_Index'];
						$location_url = "index.$phpEx?pane=right";
						break;
					case PAGE_ALBUM_PERSONAL:
						$location = $lang['View_Album_Personal'];
						$location_url = "index.$phpEx?pane=right";
						break;
					case PAGE_ALBUM_PICTURE:
						$location = $lang['View_Pictures'];
						$location_url = "index.$phpEx?pane=right";
						break;
					case PAGE_ALBUM_SEARCH:
						$location = $lang['Album_Search'];
						$location_url = "index.$phpEx?pane=right";
						break;
					// Mighty Gorgon - Full Album Pack - END
					case PAGE_DOWNLOAD:
						$location = $lang['Viewing_Download'];
						$location_url = "../dload.$phpEx";
						break;      
					case PAGE_RULES:
						$location = $lang['Viewing_RULES'];
						$location_url = "../rules.$phpEx";
						break;
					case PAGE_KB:
						$location = $lang['Viewing_KB'];
						$location_url = "../kb.$phpEx";
						break;
					case PAGE_SHOUTBOX: 
						$location = $lang['Shoutbox']; 
						$location_url = "../shoutbox_max.$phpEx"; 
						break; 
					case PAGE_PORTAL: 
						$location = $lang['Portal']; 
						$location_url = "../portal.$phpEx"; 
						break;
					case PAGE_REDIRECT: 
						require_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_banner.' . $phpEx); 
						if ($view_userdata['session_topic']) 
						{ 
								$sql = "SELECT banner_description FROM " . BANNERS_TABLE . " WHERE banner_id=" . $view_userdata['session_topic']; 
								if ( $result2 = $db->sql_query($sql) ) 
								{ 
										$banner_data = $db->sql_fetchrow($result2); 
								} 
								else 
								{     
										message_die(GENERAL_ERROR, 'Could not obtain redirect online information', '', __LINE__, __FILE__, $sql); 
								} 
								$location_url = append_sid("../redirect.$phpEx?banner_id=" . $view_userdata['session_topic']); 
								$location = $lang['Left_via_banner'] .' --> '.$banner_data['banner_description']; 
								} else { 
									$location_url = ""; 
									$location = $lang['Left_via_banner']; 
							} 
							break; 
//--------------------------------------------------------------------------------
// Prillian - Begin Code Addition
//
					case PAGE_PRILLIAN:
							include_once(PRILL_PATH . 'prill_common.' . $phpEx); 
							if ( empty($im_userdata) ) 
							{ 
									$im_userdata = init_imprefs($view_userdata['user_id'], false, true); 
							} 
						$location = $lang['Prillian'];
										$location_url = '../'.PRILL_URL . $im_userdata['mode_string']; 
						break;
					case PAGE_CONTACT:
						$location = $lang['Contact_Management'];
										$location_url = '../'.CONTACT_URL; 
						break;
//
// Prillian - End Code Addition
//--------------------------------------------------------------------------------
					case PAGE_MYCOOKIES:
						$location = $lang['cookies_link'];
						$location_url = "../mycookies.$phpEx";
						break;
					case PAGE_STAFF:
						$location = $lang['Staff'];
						$location_url = "../staff.$phpEx";
						break;
					case (PAGE_UACP): 
						$location = $lang['User_acp_title']; 
						$location_url = "../index.$phpEx"; 
						break; 
					case (PAGE_RULES): 
						$location = $lang['Rules_page']; 
						$location_url = "../rules.$phpEx"; 
						break;
					default:
						$location = $lang['Home'];
						$location_url = "../portal.$phpEx";
					}
				}
				else
				{
					$location_url = append_sid("admin_forums.$phpEx?mode=editforum&amp;" . POST_FORUM_URL . "=" . $onlinerow_reg[$i]['user_session_page']);
					$location = $forum_data[$onlinerow_reg[$i]['user_session_page']];
				}

				$row_color = ( $registered_users % 2 ) ? $theme['td_color1'] : $theme['td_color2'];
				$row_class = ( $registered_users % 2 ) ? $theme['td_class1'] : $theme['td_class2'];

				$reg_ip = decode_ip($onlinerow_reg[$i]['session_ip']);

				$template->assign_block_vars("reg_user_row", array(
					"ROW_COLOR" => "#" . $row_color,
					"ROW_CLASS" => $row_class,
//-- mod : Advanced Group Color Management -------------------------------------
//-- here we replaced
//	$username,
//-- with
//	$color->get_user_color($onlinerow_reg[$i]['user_group_id'], $onlinerow_reg[$i]['user_session_time'], $username),
//-- modify
					"USERNAME" => $agcm_color->get_user_color($onlinerow_reg[$i]['user_group_id'], $onlinerow_reg[$i]['user_session_time'], $username),
//-- fin mod : Advanced Group Color Management ---------------------------------
					"STARTED" => create_date($board_config['default_dateformat'], $onlinerow_reg[$i]['session_start'], $board_config['board_timezone']), 
					"LASTUPDATE" => create_date($board_config['default_dateformat'], $onlinerow_reg[$i]['user_session_time'], $board_config['board_timezone']),
					"FORUM_LOCATION" => $location,
					"IP_ADDRESS" => $reg_ip, 

					"U_WHOIS_IP" => "http://network-tools.com/default.asp?host=$reg_ip", 
					"U_USER_PROFILE" => append_sid("admin_users.$phpEx?mode=edit&amp;" . POST_USERS_URL . "=" . $onlinerow_reg[$i]['user_id']),
					"U_FORUM_LOCATION" => append_sid($location_url))
				);
			}
		}

	}
	else
	{
		$template->assign_vars(array(
			"L_NO_REGISTERED_USERS_BROWSING" => $lang['No_users_browsing'])
		);
	}

	//
	// Guest users
	//
//	if( count($onlinerow_guest) )
    if ( isset($onlinerow_guest) && count($onlinerow_guest) )
	{
		$guest_users = 0;

		for($i = 0; $i < count($onlinerow_guest); $i++)
		{
			$guest_userip_ary[] = $onlinerow_guest[$i]['session_ip'];
			$guest_users++;

			if( $onlinerow_guest[$i]['session_page'] < 1 )
			{
				switch( $onlinerow_guest[$i]['session_page'] )
				{
					case PAGE_INDEX:
						$location = $lang['Forum_index'];
						$location_url = "../index.$phpEx";
						break;
					case PAGE_POSTING:
						$location = $lang['Posting_message'];
						$location_url = "../index.$phpEx";
						break;
					case PAGE_LOGIN:
						$location = $lang['Logging_on'];
						$location_url = "../index.$phpEx";
						break;
					case PAGE_SEARCH:
						$location = $lang['Searching_forums'];
						$location_url = "../search.$phpEx";
						break;
					case PAGE_PROFILE:
						$location = $lang['Viewing_profile'];
						$location_url = "../index.$phpEx";
						break;
					case PAGE_VIEWONLINE:
						$location = $lang['Viewing_online'];
						$location_url = "../viewonline.$phpEx";
						break;
					case PAGE_VIEWMEMBERS:
						$location = $lang['Viewing_member_list'];
						$location_url = "../memberlist.$phpEx";
						break;
					case PAGE_PRIVMSGS:
						$location = $lang['Viewing_priv_msgs'];
						$location_url = "../privmsg.$phpEx";
						break;
					case PAGE_FAQ:
						$location = $lang['Viewing_FAQ'];
						$location_url = "../faq.$phpEx";
						break;
					// Mighty Gorgon - Full Album Pack - BEGIN
					case PAGE_ALBUM:
						$location = $lang['View_Album_Index'];
						$location_url = "index.$phpEx?pane=right";
						break;
					case PAGE_ALBUM_PERSONAL:
						$location = $lang['View_Album_Personal'];
						$location_url = "index.$phpEx?pane=right";
						break;
					case PAGE_ALBUM_PICTURE:
						$location = $lang['View_Pictures'];
						$location_url = "index.$phpEx?pane=right";
						break;
					case PAGE_ALBUM_SEARCH:
						$location = $lang['Album_Search'];
						$location_url = "index.$phpEx?pane=right";
						break;
					// Mighty Gorgon - Full Album Pack - END
					case PAGE_DOWNLOAD:
						$location = $lang['Viewing_Download'];
						$location_url = "../dload.$phpEx";
						break;      
					case PAGE_RULES:
						$location = $lang['Viewing_RULES'];
						$location_url = "../rules.$phpEx";
						break;
					case PAGE_KB:
						$location = $lang['Viewing_KB'];
						$location_url = "../kb.$phpEx";
						break;
					case PAGE_SHOUTBOX: 
						$location = $lang['Shoutbox']; 
						$location_url = "../shoutbox_max.$phpEx"; 
						break; 
					case PAGE_PORTAL: 
						$location = $lang['Portal']; 
						$location_url = "../portal.$phpEx"; 
						break;
					case PAGE_REDIRECT: 
						require_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_banner.' . $phpEx); 
						if ($view_userdata['session_topic']) 
						{ 
								$sql = "SELECT banner_description FROM " . BANNERS_TABLE . " WHERE banner_id=" . $view_userdata['session_topic']; 
								if ( $result2 = $db->sql_query($sql) ) 
								{ 
										$banner_data = $db->sql_fetchrow($result2); 
								} 
								else 
								{     
										message_die(GENERAL_ERROR, 'Could not obtain redirect online information', '', __LINE__, __FILE__, $sql); 
								} 
								$location_url = append_sid("../redirect.$phpEx?banner_id=" . $view_userdata['session_topic']); 
								$location = $lang['Left_via_banner'] .' --> '.$banner_data['banner_description']; 
								} else { 
									$location_url = ""; 
									$location = $lang['Left_via_banner']; 
							} 
							break; 
//--------------------------------------------------------------------------------
// Prillian - Begin Code Addition
//
					case PAGE_PRILLIAN:
							include_once(PRILL_PATH . 'prill_common.' . $phpEx); 
							if ( empty($im_userdata) ) 
							{ 
									$im_userdata = init_imprefs($view_userdata['user_id'], false, true); 
							} 
						$location = $lang['Prillian'];
										$location_url = '../'.PRILL_URL . $im_userdata['mode_string']; 
						break;
					case PAGE_CONTACT:
						$location = $lang['Contact_Management'];
										$location_url = '../'.CONTACT_URL; 
						break;
//
// Prillian - End Code Addition
//--------------------------------------------------------------------------------
					case PAGE_MYCOOKIES:
						$location = $lang['cookies_link'];
						$location_url = "../mycookies.$phpEx";
						break;
					case PAGE_STAFF:
						$location = $lang['Staff'];
						$location_url = "../staff.$phpEx";
						break;
					case (PAGE_UACP): 
						$location = $lang['User_acp_title']; 
						$location_url = "../index.$phpEx"; 
						break; 
					case (PAGE_RULES): 
						$location = $lang['Rules_page']; 
						$location_url = "../rules.$phpEx"; 
						break;
					default:
						$location = $lang['Home'];
						$location_url = "../portal.$phpEx";
				}
			}
			else
			{
				$location_url = append_sid("admin_forums.$phpEx?mode=editforum&amp;" . POST_FORUM_URL . "=" . $onlinerow_guest[$i]['session_page']);
				$location = $forum_data[$onlinerow_guest[$i]['session_page']];
			}

			$row_color = ( $guest_users % 2 ) ? $theme['td_color1'] : $theme['td_color2'];
			$row_class = ( $guest_users % 2 ) ? $theme['td_class1'] : $theme['td_class2'];

			$guest_ip = decode_ip($onlinerow_guest[$i]['session_ip']);

			$template->assign_block_vars("guest_user_row", array(
				"ROW_COLOR" => "#" . $row_color,
				"ROW_CLASS" => $row_class,
				"USERNAME" => $lang['Guest'],
				"STARTED" => create_date($board_config['default_dateformat'], $onlinerow_guest[$i]['session_start'], $board_config['board_timezone']), 
				"LASTUPDATE" => create_date($board_config['default_dateformat'], $onlinerow_guest[$i]['session_time'], $board_config['board_timezone']),
				"FORUM_LOCATION" => $location,
				"IP_ADDRESS" => $guest_ip, 

				"U_WHOIS_IP" => "http://network-tools.com/default.asp?host=$guest_ip", 
				"U_FORUM_LOCATION" => append_sid($location_url))
			);
		}

	}
	else
	{
		$template->assign_vars(array(
			"L_NO_GUESTS_BROWSING" => $lang['No_users_browsing'])
		);
	}
	
	// phpBB version
	$current_version = explode('.', '2' . $board_config['version']);
	$version_info = '<p style="color:green">' . $lang['Version_up_to_date'] . '</p>';


//////////////////
   // Check for news from integramod
   $errno = 0;
   $errstr = $news = '';

   if ($fsock = @fsockopen('www.integramod.com', 80, $errno, $errstr))
   {
      @fputs($fsock, "GET /version/151.txt HTTP/1.1\r\n");
      @fputs($fsock, "HOST: www.integramod.com\r\n");
      @fputs($fsock, "Connection: close\r\n\r\n");

      $get_info = false;
      while (!@feof($fsock))
      {
         if ($get_info)
         {
            $news .= @fread($fsock, 1024);
         }
         else
         {
            if (@fgets($fsock, 1024) == "\r\n")
            {
               $get_info = true;
            }
         }
      }
      @fclose($fsock);

   }
   else
   {
      if ($errstr)
      {
         $news = '<p style="color:red">' . sprintf($lang['Connect_socket_error_integra'], $errstr) . '</p>';
      }
      else
      {
         $news = '<p>' . $lang['Socket_functions_disabled'] . '</p>';
      }
   }
////////////////////////


	$template->assign_vars(array(
		'VERSION_INFO'	=> $version_info,
		'L_VERSION_INFORMATION'	=> $lang['Version_information'],
		'INTEGRA_NEWS' => $news,
		'L_INTEGRA_TITLE' => $lang['integra_news'])
	);
	
	
	jr_admin_make_info_box();

	$template->pparse("body");

	include('./page_footer_admin.'.$phpEx);

}
else
{
	//
	// Generate frameset
	//
	$template->set_filenames(array(
		"body" => "admin/index_frameset.tpl")
	);

	$template->assign_vars(array(
		"S_FRAME_NAV" => append_sid("index.$phpEx?pane=left"),
		"S_FRAME_MAIN" => append_sid("index.$phpEx?pane=right"))
	);

	header ("Expires: " . gmdate("D, d M Y H:i:s", time()) . " GMT");
	header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");

	$template->pparse("body");

	$db->sql_close();
	exit;

}

?>
