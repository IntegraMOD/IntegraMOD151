<?php
/***************************************************************************
 *                         blocks_imp_statistics.php
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

if(!function_exists('imp_statistics_block_func'))
{
	function imp_statistics_block_func()
	{
		global $template, $lang, $phpEx;
		global $agcm_color;

		$total_posts = get_db_stat('postcount');
		$total_users = get_db_stat('usercount');
		$total_topics = get_db_stat('topiccount');
		$newest_userdata = get_db_stat('newestuser');
		$newest_user = $newest_userdata['username'];
		$newest_uid = $newest_userdata['user_id'];
//-- mod : Advanced Group Color Management -------------------------------------
//-- add
		$newest_user_group_id = $newest_userdata['user_group_id'];
		$newest_user_session_time = $newest_userdata['user_session_time'];
//-- fin mod : Advanced Group Color Management ---------------------------------

		if( $total_posts == 0 )
		{
			$l_total_post_s = $lang['Posted_articles_zero_total'];
		}
		else if( $total_posts == 1 )
		{
			$l_total_post_s = $lang['Posted_article_total'];
		}
		else
		{
			$l_total_post_s = $lang['Posted_articles_total'];
		}

		if( $total_users == 0 )
		{
			$l_total_user_s = $lang['Registered_users_zero_total'];
		}
		else if( $total_users == 1 )
		{
			$l_total_user_s = $lang['Registered_user_total'];
		}
		else
		{
			$l_total_user_s = $lang['Registered_users_total'];
		}

		$template->assign_vars(array(
			'TOTAL_USERS' => sprintf($l_total_user_s, $total_users),
//-- mod : Advanced Group Color Management -------------------------------------
//-- delete
//	'NEWEST_USER' => sprintf($lang['Newest_user'], '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$newest_uid") . '">' , $newest_user , '</a>'), 
//-- add
			'NEWEST_USER' => sprintf($lang['Newest_user'], '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$newest_uid") . '" class="' . $agcm_color->get_user_color($newest_user_group_id, $newest_user_session_time) . '">' , $newest_user , '</a>'), 
//-- fin mod : Advanced Group Color Management ---------------------------------
			'TOTAL_POSTS' => sprintf($l_total_post_s, $total_posts),
			'TOTAL_TOPICS' => sprintf($lang['total_topics'], $total_topics)
			)
		);
	}
}

imp_statistics_block_func();
?>