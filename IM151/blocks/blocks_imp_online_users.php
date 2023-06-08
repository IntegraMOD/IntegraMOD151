<?php
/***************************************************************************
 *                         blocks_imp_online_users.php
 *                            -------------------
 *   begin                : Saturday, March 20, 2004
 *   copyright            : (C) 2004 masterdavid - Ronald John David
 *   website              : http://www.integramod.com
 *   email                : webmaster@integramod.com
 *
 *   note: removing the original copyright is illegal even you have modified
 *         the code.  Just append yours if you have modified it.
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

if(!function_exists('imp_online_users_block_func'))
{
	function imp_online_users_block_func()
	{
		global $template, $lang, $db, $theme, $phpEx, $lang, $board_config, $userdata, $phpbb_root_path, $table_prefix, $portal_config, $var_cache;
		global $agcm_color;

		$jadmin_ary = array();
		if($portal_config['cache_enabled'])
		{
			$jadmin_ary=$var_cache->get('jadmin', 200000, 'jadmin');
		}
		if($jadmin_ary === FALSE)
		{
			$sql = "SELECT user_id FROM " . JR_ADMIN_TABLE . "
					WHERE user_jr_admin <>''";
			if ( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not obtain junior admin status', '', __LINE__, __FILE__, $sql);
			}

			while( $row = $db->sql_fetchrow($result) )
			{
				$jadmin_ary[] = $row['user_id'];
			}
    		if($db->sql_fetchrow($result) == 0)
    		{
                $jadmin_ary[] = -10;
            }
			if($portal_config['cache_enabled'])
			{
				$var_cache->save($jadmin_ary, 'jadmin', 'jadmin');
			}
		}

		$sql = "SELECT u.user_group_id, u.user_session_time, u.username, u.user_id, u.user_allow_viewonline, u.user_level, s.session_logged_in, s.session_ip
			FROM ".USERS_TABLE." u, ".SESSIONS_TABLE." s
			WHERE u.user_id = s.session_user_id
				AND s.session_time >= ".( time() - 300 ) . "
			ORDER BY u.username ASC, s.session_ip ASC";
		if( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain user/online information', '', __LINE__, __FILE__, $sql);
		}

		$userlist_ary = array();
		$userlist_visible = array();

		$prev_user_id = 0;
		$prev_user_ip = '';

		$logged_visible_online = $logged_hidden_online = $guests_online = 0;
		$online_userlist = '';
		$prev_session_ip = null;
		while( $row = $db->sql_fetchrow($result) )
		{
			// User is logged in and therefor not a guest
			if ( $row['session_logged_in'] )
			{
				// Skip multiple sessions for one user
				if ( $row['user_id'] != $prev_user_id )
				{
					$style_color = $agcm_color->get_user_color($row['user_group_id'], $row['user_session_time']);

					if ( $row['user_allow_viewonline'] )
					{
						$user_online_link = '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $row['user_id']) . '"><span class="'.$style_color.'">' . $row['username'] . '</span></a>';
						$logged_visible_online++;
					}
					else
					{
						$user_online_link = '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $row['user_id']) . '"><span class="'.$style_color.'"><i>' . $row['username'] . '</span></i></a>';
						$logged_hidden_online++;
					}

					if ( $row['user_allow_viewonline'] || $userdata['user_level'] == ADMIN )
					{
						$online_userlist .= ( $online_userlist != '' ) ? ', ' . $user_online_link : $user_online_link;
					}
				}

				$prev_user_id = $row['user_id'];
			}
			else
			{
				// Skip multiple sessions for one user
				if ( $row['session_ip'] != $prev_session_ip )
				{
					$guests_online++;
				}
			}

			$prev_session_ip = $row['session_ip'];
		}
		$db->sql_freeresult($result);
		if ( empty($online_userlist) )
		{
			$online_userlist = $lang['None'];
		}
		$online_userlist = $lang['Registered_users'] . ' ' . $online_userlist;

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

		if(!$userdata['session_logged_in'])
		{
			$chat_link = $lang['Login_to_join_chat'];
		}
		else
		{
			$chat_link = "<a href=\"javascript:void(0);\" onClick=\"window.open('" . append_sid( "chatspot/chatspot.$phpEx" . "?initialize=1" ) . "','" . 'Lobby' . "','scrollbars=no,width=640,height=550')\">" . $lang['Click_to_join_chat'] . "</a>";
		}

		require_once( $phpbb_root_path . 'chatspot_front.' . $phpEx );

		$template->assign_vars(array(
// ******************** BEGIN phpBBChatSpot MOD ******************** 
			'CHATSPOT_IDENTIFICATION' => $lang[ 'ChatSpot_id' ],
			'TOTAL_CHATTERS_ONLINE' => sprintf( $lang[ 'How_Many_Chatters' ], $num_users_in_chat ),
			'CHATTERS_LIST' => '<b>' . $users_in_chat . '</b>', 
			'L_CHAT_LINK' => $chat_link,
// ********************  END phpBBChatSpot MOD  ********************

			'B_L_VIEW' => $lang['View_complete_list'],
			'B_TOTAL_USERS_ONLINE' => $l_online_users,
			'B_LOGGED_IN_USER_LIST' => $online_userlist,
			'B_U_VIEWONLINE' => append_sid('viewonline.'.$phpEx),
			'B_RECORD_USERS' => sprintf($lang['Record_online_users'], $board_config['record_online_users'], create_date($board_config['default_dateformat'], $board_config['record_online_date'], $board_config['board_timezone']))
                        )
		);
	}
}

imp_online_users_block_func();


?>
