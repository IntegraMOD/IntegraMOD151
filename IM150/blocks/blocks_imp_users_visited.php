<?php
/***************************************************************************
 *                        blocks_imp_users_visited.php
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

if(!function_exists(imp_users_visited_block_func))
{
	function imp_users_visited_block_func()
	{
		global $template, $lang, $db, $portal_config, $images, $phpEx;

		$sql = "SELECT user_id, username, user_allow_viewonline, user_level, user_session_time
			FROM ".USERS_TABLE."
			WHERE user_id > 0
			ORDER BY user_level DESC, username ASC";
		if( !($result1 = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain user/day information', '', __LINE__, __FILE__, $sql);
		}

		$day_users_array = $db->sql_fetchrowset($result1);
		$db->sql_freeresult($result1);

		$day_userlist = '';
		$day_users = 0;
		$not_day_userlist = '';
		$not_day_users = 0;

		$counter = count($day_users_array);

		for ($i = 0; $i < $counter; $i++)
		{
			$style_color = '';
			if ( $day_users_array[$i]['user_level'] == ADMIN )
			{
				$day_users_array[$i]['username'] = '<b>' . $day_users_array[$i]['username'] . '</b>';
				$style_color = 'style="color:#' . $theme['fontcolor3'] . '"';
			}
			else if ( $day_users_array[$i]['user_level'] == MOD )
			{
				$day_users_array[$i]['username'] = '<b>' . $day_users_array[$i]['username'] . '</b>';
				$style_color = 'style="color:#' . $theme['fontcolor2'] . '"';
			}
			if ( $day_users_array[$i]['user_session_time'] >= ( time() - intval($portal_config['md_hours_track_users']) * 3600 ) )
			{
				$scroll_num = '1';
			}else
			{
				$scroll_num = '2';
			}
			if ( $day_users_array[$i]['user_allow_viewonline'] )
			{
				$user_day_link = '<a href="' . append_sid("privmsg.php?mode=post&amp;" . POST_USERS_URL . "=" . $day_users_array[$i]['user_id']) . '"' . $style_color .' title="Send User a PM"><img src="' . $images['scroll_pm'] . '" align=top border=0></a> <a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $day_users_array[$i]['user_id']) . '"' . $style_color .' title="View Users Profile">' . $day_users_array[$i]['username'] . '</a>';
			}
			else
			{
				$user_day_link = '<a href="' . append_sid("privmsg.php?mode=post&amp;" . POST_USERS_URL . "=" . $day_users_array[$i]['user_id']) . '"' . $style_color .' title="Send User a PM"><img src="' . $images['scroll_pm'] . '" align=top border=0></a> <a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $day_users_array[$i]['user_id']) . '"' . $style_color .' title="View Users Profile"><i>' . $day_users_array[$i]['username'] . '</i></a>';
			}
			if ( $day_users_array[$i]['user_allow_viewonline'] || $userdata['user_level'] == ADMIN )
			{
				if ( $day_users_array[$i]['user_session_time'] >= ( time() - intval($portal_config['md_hours_track_users']) * 3600 ) )
				{
					$day_userlist .= ( $day_userlist != '' ) ? '&nbsp;&nbsp;||&nbsp;&nbsp;' . $user_day_link : $user_day_link;
					$day_users++;
				}
				else
				{
					$not_day_userlist .= ( $not_day_userlist != '' ) ? '&nbsp;&nbsp;||&nbsp;&nbsp;' . $user_day_link : $user_day_link;
					$not_day_users++;
				}
			}
		}

		$day_userlist = ( ( isset($forum_id) ) ? '' : sprintf($lang['Day_users'], $day_users, $portal_config['md_hours_track_users']) ) . '<br /><marquee scrolldelay=' . $portal_config['md_scroll_delay'] . ' id=userscroll1 loop="true" onmouseover="this.stop()" onmouseout="this.start()">' . $day_userlist . '</marquee>';

		$not_day_userlist = ( ( isset($forum_id) ) ? '' : sprintf($lang['Not_day_users'], $not_day_users, $portal_config['md_hours_track_users']) ) . '<br /><marquee scrolldelay=' . $portal_config['md_scroll_delay'] . ' id=userscroll2 loop="true" onmouseover="this.stop()" onmouseout="this.start()">' . $not_day_userlist . '</marquee>';

		if ( $portal_config['md_display_not_visit'] )
		{
			$day_userlist .= '<br />' . $not_day_userlist;
		}
		$template->assign_vars(array('FEROZ_DAY_LIST' => $day_userlist));
	}
}

imp_users_visited_block_func();
?>