<?php
/***************************************************************************
 *                                index.php
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

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);
//-- mod : announces -------------------------------------------------------------------------------
//-- add
include_once($phpbb_root_path . 'includes/functions_announces.'. $phpEx);
//-- fin mod : announces ---------------------------------------------------------------------------

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);
//
// End session management
//

//-- mod : keep unread -----------------------------------------------------------------------------
//-- add
// get last visit for guest
if ( !$userdata['session_logged_in'] )
{
	$userdata['user_lastvisit'] = $board_config['guest_lastvisit'];
}
//-- fin mod : keep unread -------------------------------------------------------------------------

$viewcat = ( !empty($_GET[POST_CAT_URL]) ) ? $_GET[POST_CAT_URL] : -1;
//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
$viewcat = intval($viewcat);
if ($viewcat <= 0) $viewcat = -1;
$viewcatkey = ($viewcat < 0) ? 'Root' : POST_CAT_URL . $viewcat;
//-- fin mod : categories hierarchy ----------------------------------------------------------------


if( isset($_GET['mark']) || isset($_POST['mark']) )
{
	$mark_read = ( isset($_POST['mark']) ) ? $_POST['mark'] : $_GET['mark'];
}
else
{
	$mark_read = '';
}

//
// Handle marking posts
//
if( $mark_read == 'forums' )
{
//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
	if ( $viewcat < 0 )
	{
//-- fin mod : categories hierarchy ----------------------------------------------------------------

//-- mod : keep unread -----------------------------------------------------------------------------
//-- delete
//	if( $userdata['session_logged_in'] )
//	{
//		setcookie($board_config['cookie_name'] . '_f_all', time(), 0, $board_config['cookie_path'], $board_config['cookie_domain'], $board_config['cookie_secure']);
//	}
//-- add
		// set the cookie to mark all and clean the others
		$board_config['tracking_all'] = time();
		$board_config['tracking_forums'] = array();
		$board_config['tracking_topics'] = array();
		$board_config['tracking_unreads'] = array();
		write_cookies($userdata);
//-- fin mod : keep unread -------------------------------------------------------------------------

	$template->assign_vars(array(
		"META" => '<meta http-equiv="refresh" content="3;url='  .append_sid("index.$phpEx") . '">')
	);
//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
	}
	else
	{
//-- mod : keep unread -----------------------------------------------------------------------------
//-- delete
//		if( $userdata['session_logged_in'] )
//		{
//			// get the list of object authorized
//			$keys = array();
//			$keys = get_auth_keys($viewcatkey);
//
//			// mark each forums
//			for ($i=0; $i < count($keys['id']); $i++) if ($tree['type'][ $keys['idx'][$i] ] == POST_FORUM_URL)
//			{
//				$forum_id = $tree['id'][ $keys['idx'][$i] ];
//				$sql = "SELECT MAX(post_time) AS last_post FROM " . POSTS_TABLE . " WHERE forum_id = $forum_id";
//				if ( !($result = $db->sql_query($sql)) ) message_die(GENERAL_ERROR, 'Could not obtain forums information', '', __LINE__, __FILE__, $sql);
//				if ( $row = $db->sql_fetchrow($result) )
//				{
//					$tracking_forums = ( isset($_COOKIE[$board_config['cookie_name'] . '_f']) ) ? unserialize($_COOKIE[$board_config['cookie_name'] . '_f']) : array();
//					$tracking_topics = ( isset($_COOKIE[$board_config['cookie_name'] . '_t']) ) ? unserialize($_COOKIE[$board_config['cookie_name'] . '_t']) : array();
//
//					if ( ( count($tracking_forums) + count($tracking_topics) ) >= 150 && empty($tracking_forums[$forum_id]) )
//					{
//						asort($tracking_forums);
//						unset($tracking_forums[key($tracking_forums)]);
//					}
//
//					if ( $row['last_post'] > $userdata['user_lastvisit'] )
//					{
//						$tracking_forums[$forum_id] = time();
//						setcookie($board_config['cookie_name'] . '_f', serialize($tracking_forums), 0, $board_config['cookie_path'], $board_config['cookie_domain'], $board_config['cookie_secure']);
//					}
//				}
//			}
//		}
//-- add
		// get the list of object authorized
		$keys = array();
		$keys = get_auth_keys($viewcatkey);

		// mark each forums
		for ($i=0; $i < count($keys['id']); $i++)
		{
			if ($tree['type'][ $keys['idx'][$i] ] == POST_FORUM_URL)
			{
				$forum_id = $tree['id'][ $keys['idx'][$i] ];
				$board_config['tracking_forums'][$forum_id] = time();
			}
		}
		write_cookies($userdata);
//-- fin mod : keep unread -------------------------------------------------------------------------

		$template->assign_vars(array(
			"META" => '<meta http-equiv="refresh" content="3;url='  .append_sid("index.$phpEx?" . POST_CAT_URL . "=$viewcat") . '">')
		);
	}
//-- fin mod : categories hierarchy ----------------------------------------------------------------

	$message = $lang['Forums_marked_read'] . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a> ');

	message_die(GENERAL_MESSAGE, $message);
}
//
// End handle marking posts
//

//-- mod : categories hierarchy --------------------------------------------------------------------
//-- delete
// $tracking_topics = ( isset($_COOKIE[$board_config['cookie_name'] . '_t']) ) ? unserialize($_COOKIE[$board_config['cookie_name'] . "_t"]) : array();
// $tracking_forums = ( isset($_COOKIE[$board_config['cookie_name'] . '_f']) ) ? unserialize($_COOKIE[$board_config['cookie_name'] . "_f"]) : array();
//-- fin mod : categories hierarchy ----------------------------------------------------------------

//
// If you don't use these stats on your index you may want to consider
// removing them
//
$total_posts = get_db_stat('postcount');
$total_users = get_db_stat('usercount');
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

//
// Start page proper
//
//-- mod : categories hierarchy --------------------------------------------------------------------
//-- delete
/*

$sql = "SELECT c.cat_id, c.cat_title, c.cat_order
	FROM " . CATEGORIES_TABLE . " c 
	ORDER BY c.cat_order";
if( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not query categories list', '', __LINE__, __FILE__, $sql);
}

$category_rows = array();
while( $category_rows[] = $db->sql_fetchrow($result) );
$db->sql_freeresult($result);

if( ( $total_categories = count($category_rows) ) )
{
	//
	// Define appropriate SQL
	//
	switch(SQL_LAYER)
	{
		case 'postgresql':
			$sql = "SELECT f.*, p.post_time, p.post_username, u.username, u.user_id 
				FROM " . FORUMS_TABLE . " f, " . POSTS_TABLE . " p, " . USERS_TABLE . " u
				WHERE p.post_id = f.forum_last_post_id 
					AND u.user_id = p.poster_id  
					UNION (
						SELECT f.*, NULL, NULL, NULL, NULL
						FROM " . FORUMS_TABLE . " f
						WHERE NOT EXISTS (
							SELECT p.post_time
							FROM " . POSTS_TABLE . " p
							WHERE p.post_id = f.forum_last_post_id  
						)
					)
					ORDER BY cat_id, forum_order";
			break;

		case 'oracle':
			$sql = "SELECT f.*, p.post_time, p.post_username, u.username, u.user_id 
				FROM " . FORUMS_TABLE . " f, " . POSTS_TABLE . " p, " . USERS_TABLE . " u
				WHERE p.post_id = f.forum_last_post_id(+)
					AND u.user_id = p.poster_id(+)
				ORDER BY f.cat_id, f.forum_order";
			break;

		default:
			$sql = "SELECT f.*, p.post_time, p.post_username, u.username, u.user_id
				FROM (( " . FORUMS_TABLE . " f
				LEFT JOIN " . POSTS_TABLE . " p ON p.post_id = f.forum_last_post_id )
				LEFT JOIN " . USERS_TABLE . " u ON u.user_id = p.poster_id )
				ORDER BY f.cat_id, f.forum_order";
			break;
	}
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not query forums information', '', __LINE__, __FILE__, $sql);
	}

	$forum_data = array();
	while( $row = $db->sql_fetchrow($result) )
	{
		$forum_data[] = $row;
	}
	$db->sql_freeresult($result);

	if ( !($total_forums = count($forum_data)) )
	{
		message_die(GENERAL_MESSAGE, $lang['No_forums']);
	}

	//
	// Obtain a list of topic ids which contain
	// posts made since user last visited
	//
	if ( $userdata['session_logged_in'] )
	{
		$sql = "SELECT t.forum_id, t.topic_id, p.post_time 
			FROM " . TOPICS_TABLE . " t, " . POSTS_TABLE . " p 
			WHERE p.post_id = t.topic_last_post_id 
				AND p.post_time > " . $userdata['user_lastvisit'] . " 
				AND t.topic_moved_id = 0"; 
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not query new topic information', '', __LINE__, __FILE__, $sql);
		}

		$new_topic_data = array();
		while( $topic_data = $db->sql_fetchrow($result) )
		{
			$new_topic_data[$topic_data['forum_id']][$topic_data['topic_id']] = $topic_data['post_time'];
		}
	$db->sql_freeresult($result);
	}

	//
	// Obtain list of moderators of each forum
	// First users, then groups ... broken into two queries
	//
	$sql = "SELECT aa.forum_id, u.user_id, u.username 
		FROM " . AUTH_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g, " . USERS_TABLE . " u
		WHERE aa.auth_mod = " . TRUE . " 
			AND g.group_single_user = 1 
			AND ug.group_id = aa.group_id 
			AND g.group_id = aa.group_id 
			AND u.user_id = ug.user_id 
		GROUP BY u.user_id, u.username, aa.forum_id 
		ORDER BY aa.forum_id, u.user_id";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not query forum moderator information', '', __LINE__, __FILE__, $sql);
	}

	$forum_moderators = array();
	while( $row = $db->sql_fetchrow($result) )
	{
		$forum_moderators[$row['forum_id']][] = '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $row['user_id']) . '">' . $row['username'] . '</a>';
	}
	$db->sql_freeresult($result);

	$sql = "SELECT aa.forum_id, g.group_id, g.group_name 
		FROM " . AUTH_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g 
		WHERE aa.auth_mod = " . TRUE . " 
			AND g.group_single_user = 0 
			AND g.group_type <> " . GROUP_HIDDEN . "
			AND ug.group_id = aa.group_id 
			AND g.group_id = aa.group_id 
		GROUP BY g.group_id, g.group_name, aa.forum_id 
		ORDER BY aa.forum_id, g.group_id";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not query forum moderator information', '', __LINE__, __FILE__, $sql);
	}

	while( $row = $db->sql_fetchrow($result) )
	{
		$forum_moderators[$row['forum_id']][] = '<a href="' . append_sid("groupcp.$phpEx?" . POST_GROUPS_URL . "=" . $row['group_id']) . '">' . $row['group_name'] . '</a>';
	}
	$db->sql_freeresult($result);

	//
	// Find which forums are visible for this user
	//
	$is_auth_ary = array();
	$is_auth_ary = auth(AUTH_VIEW, AUTH_LIST_ALL, $userdata, $forum_data);
*/
//-- fin mod : categories hierarchy ----------------------------------------------------------------


	//
	// Start output of page
	//
//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
// set the parm of the mark read func
$mark = ($viewcat == -1 ) ? '' : '&' . POST_CAT_URL . '=' . $viewcat;
// monitor the board statistic
if (($board_config['display_viewonline'] == 2) || (($viewcat < 0) && ($board_config['display_viewonline'] == 1)))
{
//-- fin mod : categories hierarchy ----------------------------------------------------------------

	define('SHOW_ONLINE', true);
//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
}
//-- fin mod : categories hierarchy ----------------------------------------------------------------

	$page_title = $lang['Index'];
	include($phpbb_root_path . 'includes/page_header.'.$phpEx);

	$template->set_filenames(array(
		'body' => 'index_body.tpl')
	);
	$donordesc = '';
	if( strlen($board_config['donate_description']) > 0)
	{
		if(strlen($donordesc) <= 0)
		{
			$donordesc .= '[';
		}
		$donordesc .= 'For: ' . $board_config['donate_description'] . '; ';
	}
	if( intval($board_config['donate_cur_goal']) > 0)
	{
		$donorswhere = '';
	
		//format can only be 2004/08/04 yyyy/mm/dd
		$starttime = 0;
		$endtime = 0;
		$donatetime = '';
		if(strlen($board_config['donate_start_time']) == 10)
		{
			$starttime = mktime(0, 0, 0, substr($board_config['donate_start_time'], 5, 2), substr($board_config['donate_start_time'], 8, 2), substr($board_config['donate_start_time'], 0, 4) );
		}
		if(strlen($board_config['donate_end_time']) == 10)
		{
			$endtime = mktime(0, 0, 0, substr($board_config['donate_end_time'], 5, 2), substr($board_config['donate_end_time'], 8, 2), substr($board_config['donate_end_time'], 0, 4) );

			$donatetime .= ' Ended at <b>' . $board_config['donate_end_time'] . '</b>' . ';';
		}	
		$donordesc .= $donatetime;	
		if($starttime > 0)
		{
			if($endtime <= $starttime)
			{
				$donorswhere = ' AND a.lw_date >= ' . $starttime;
			}
			else
			{
				$donorswhere = ' AND a.lw_date >= ' . $starttime . ' AND a.lw_date <= ' . $endtime;
			}
		}
		$curcollected = 0;
		$sql = "SELECT SUM(a.lw_money) FROM " . ACCT_HIST_TABLE . " a, " . USERS_TABLE . " u" . " WHERE a.comment LIKE 'donate from%' AND u.user_id = a.user_id" . 
			"$donorswhere";
		if($result = $db->sql_query($sql))
		{
			if($row = $db->sql_fetchrow($result))
			{
				$curcollected = $row["SUM(a.lw_money)"];
			}
		}
		
		if(strlen($donordesc) <= 0)
		{
			$donordesc .= '[';
		}
		$donordesc .= sprintf($lang['LW_WE_HAVE_COLLECT'], $curcollected, $board_config['donate_cur_goal'] . ' ' . $board_config['paypal_currency_code'] ) . "; ";
	}
	if( strlen($donordesc) > 0)
	{
		$donordesc .= '<a href="' . append_sid("lwdonors.$phpEx?mode=viewcurrent") . '"' . $style_color .'>' . $lang['LW_CURRENT_DONORS'] . '</a>';
		$donordesc .= ']';
	}
	$donationtitle = "";
	if(intval($board_config['list_top_donors']) == 1)
	{
		$donationtitle = sprintf($lang['L_LW_TOP_DONORS_TITLE'], $board_config['dislay_x_donors']) . ' ' . $donordesc;
	}
	else
	{
		$donationtitle = sprintf($lang['L_LW_LAST_DONORS'], $board_config['dislay_x_donors']) . ' ' . $donordesc;
	}

	$template->assign_vars(array(
		'LW_LAST_DONORS' => last_donors(), 
		'L_LW_LAST_DONORS' => $donationtitle,
		'TOTAL_POSTS' => sprintf($l_total_post_s, $total_posts),
		'TOTAL_USERS' => sprintf($l_total_user_s, $total_users),
//-- mod : Advanced Group Color Management -------------------------------------
//-- delete
//	'NEWEST_USER' => sprintf($lang['Newest_user'], '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$newest_uid") . '">' , $newest_user , '</a>'), 
//-- add
		'NEWEST_USER' => sprintf($lang['Newest_user'], '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$newest_uid") . '" class="' . $agcm_color->get_user_color($newest_user_group_id, $newest_user_session_time) . '">' , $newest_user , '</a>'), 
//-- fin mod : Advanced Group Color Management ---------------------------------

		'FORUM_IMG' => $images['forum'],
		'FORUM_NEW_IMG' => $images['forum_new'],
		'FORUM_LOCKED_IMG' => $images['forum_locked'],
		'WHOSONLINE_IMAGE' => $images['who_is_online'],
// Start add - Fully integrated shoutbox MOD
		'U_SHOUTBOX' => append_sid("shoutbox.$phpEx"),
		'L_SHOUTBOX' => $lang['Shoutbox'],
		'U_SHOUTBOX_MAX' => append_sid("shoutbox_max.$phpEx"),
// End add - Fully integrated shoutbox MOD
		'L_FORUM' => $lang['Forum'],
		'L_TOPICS' => $lang['Topics'],
		'L_REPLIES' => $lang['Replies'],
		'L_VIEWS' => $lang['Views'],
		'L_POSTS' => $lang['Posts'],
		'L_LASTPOST' => $lang['Last_Post'], 
		'L_NO_NEW_POSTS' => $lang['No_new_posts'],
		'L_NEW_POSTS' => $lang['New_posts'],
		'L_NO_NEW_POSTS_LOCKED' => $lang['No_new_posts_locked'], 
		'L_NEW_POSTS_LOCKED' => $lang['New_posts_locked'], 
		'L_ONLINE_EXPLAIN' => $lang['Online_explain'], 

		'L_MODERATOR' => $lang['Moderators'], 
		'L_FORUM_LOCKED' => $lang['Forum_is_locked'],
		'L_MARK_FORUMS_READ' => $lang['Mark_all_forums'],

//-- mod : categories hierarchy --------------------------------------------------------------------
// here we added
//	$mark
//-- modify
		'U_MARK_READ' => append_sid("index.$phpEx?mark=forums$mark"))
//-- fin mod : categories hierarchy ----------------------------------------------------------------
	);

//-- mod : announces -------------------------------------------------------------------------------
//-- add
	// categories hierarchy v 2 compliancy
	if (empty($viewcatkey) && ($viewcat > -1))
	{
		$viewcatkey = POST_CAT_URL . $viewcat;
	}
	else
	{
		if (empty($viewcatkey)) $viewcatkey = 'Root';
	}
	announces_from_forums($viewcatkey);
//-- fin mod : announces ---------------------------------------------------------------------------

	//
	// Okay, let's build the index
	//
//-- mod : categories hierarchy --------------------------------------------------------------------
//-- delete
/*
	for($i = 0; $i < $total_categories; $i++)
	{
		$cat_id = $category_rows[$i]['cat_id'];

		//
		// Should we display this category/forum set?
		//
		$display_forums = false;
		for($j = 0; $j < $total_forums; $j++)
		{
			if ( $is_auth_ary[$forum_data[$j]['forum_id']]['auth_view'] && $forum_data[$j]['cat_id'] == $cat_id )
			{
				$display_forums = true;
			}
		}

		//
		// Yes, we should, so first dump out the category
		// title, then, if appropriate the forum list
		//
		if ( $display_forums )
		{
			$template->assign_block_vars('catrow', array(
				'CAT_ID' => $cat_id,
				'CAT_DESC' => $category_rows[$i]['cat_title'],
				'U_VIEWCAT' => append_sid("index.$phpEx?" . POST_CAT_URL . "=$cat_id"))
			);

			if ( $viewcat == $cat_id || $viewcat == -1 )
			{
				for($j = 0; $j < $total_forums; $j++)
				{
					if ( $forum_data[$j]['cat_id'] == $cat_id )
					{
						$forum_id = $forum_data[$j]['forum_id'];

						if ( $is_auth_ary[$forum_id]['auth_view'] )
						{
							if ( $forum_data[$j]['forum_status'] == FORUM_LOCKED )
							{
								$folder_image = $images['forum_locked']; 
								$folder_alt = $lang['Forum_locked'];
							}
							else
							{
								$unread_topics = false;
								if ( $userdata['session_logged_in'] )
								{
									if ( !empty($new_topic_data[$forum_id]) )
									{
										$forum_last_post_time = 0;

										while( list($check_topic_id, $check_post_time) = @each($new_topic_data[$forum_id]) )
										{
											if ( empty($tracking_topics[$check_topic_id]) )
											{
												$unread_topics = true;
												$forum_last_post_time = max($check_post_time, $forum_last_post_time);

											}
											else
											{
												if ( $tracking_topics[$check_topic_id] < $check_post_time )
												{
													$unread_topics = true;
													$forum_last_post_time = max($check_post_time, $forum_last_post_time);
												}
											}
										}

										if ( !empty($tracking_forums[$forum_id]) )
										{
											if ( $tracking_forums[$forum_id] > $forum_last_post_time )
											{
												$unread_topics = false;
											}
										}

										if ( isset($_COOKIE[$board_config['cookie_name'] . '_f_all']) )
										{
											if ( $_COOKIE[$board_config['cookie_name'] . '_f_all'] > $forum_last_post_time )
											{
												$unread_topics = false;
											}
										}

									}
								}

								$folder_image = ( $unread_topics ) ? $images['forum_new'] : $images['forum']; 
								$folder_alt = ( $unread_topics ) ? $lang['New_posts'] : $lang['No_new_posts']; 
							}

							$posts = $forum_data[$j]['forum_posts'];
							$topics = $forum_data[$j]['forum_topics'];

							if ( $forum_data[$j]['forum_last_post_id'] )
							{
								$last_post_time = create_date($board_config['default_dateformat'], $forum_data[$j]['post_time'], $board_config['board_timezone']);

								$last_post = $last_post_time . '<br />';

								$last_post .= ( $forum_data[$j]['user_id'] == ANONYMOUS ) ? ( ($forum_data[$j]['post_username'] != '' ) ? $forum_data[$j]['post_username'] . ' ' : $lang['Guest'] . ' ' ) : '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '='  . $forum_data[$j]['user_id']) . '">' . $forum_data[$j]['username'] . '</a> ';
								
								$last_post .= '<a href="' . append_sid("viewtopic.$phpEx?"  . POST_POST_URL . '=' . $forum_data[$j]['forum_last_post_id']) . '#' . $forum_data[$j]['forum_last_post_id'] . '"><img src="' . $images['icon_latest_reply'] . '" border="0" alt="' . $lang['View_latest_post'] . '" title="' . $lang['View_latest_post'] . '" /></a>';
							}
							else
							{
								$last_post = $lang['No_Posts'];
							}

							if ( count($forum_moderators[$forum_id]) > 0 )
							{
								$l_moderators = ( count($forum_moderators[$forum_id]) == 1 ) ? $lang['Moderator'] : $lang['Moderators'];
								$moderator_list = implode(', ', $forum_moderators[$forum_id]);
							}
							else
							{
								$l_moderators = '&nbsp;';
								$moderator_list = '&nbsp;';
							}

							$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
							$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];


							$template->assign_block_vars('catrow.forumrow',	array(
								'ROW_COLOR' => '#' . $row_color,
								'ROW_CLASS' => $row_class,
								'FORUM_FOLDER_IMG' => $folder_image,
								'FORUM_NAME' => $forum_data[$j]['forum_name'],
								'FORUM_DESC' => $forum_data[$j]['forum_desc'],
								'POSTS' => $forum_data[$j]['forum_posts'],
								'TOPICS' => $forum_data[$j]['forum_topics'],
								'LAST_POST' => $last_post,
								'MODERATORS' => $moderator_list,

								'L_MODERATOR' => $l_moderators, 
								'L_FORUM_FOLDER_ALT' => $folder_alt, 

								'U_VIEWFORUM' => append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id"))
							);
						}
					}
				}
			}
		}
	} // for ... categories

}// if ... total_categories
else
//-- add
*/

// don't display the board statistics
if ( ($board_config['display_viewonline'] == 2) || ( ($viewcat < 0) && ($board_config['display_viewonline'] == 1) ) )
{
	$template->assign_block_vars('disable_viewonline', array());
}

// display the index
$display = display_index($viewcatkey);

if ( !$display )
//-- fin mod : categories hierarchy ----------------------------------------------------------------

{
	message_die(GENERAL_MESSAGE, $lang['No_forums']);
}

// MOD MINI CAL BEGIN
include($phpbb_root_path . 'mods/netclectic/mini_cal/mini_cal.'.$phpEx); 
// MOD MINI CAL END

//-- mod : Advanced Group Color Management -------------------------------------
//-- add
//
// Display Legend
//
$agcm_color->display_legend();
//-- fin mod : Advanced Group Color Management ---------------------------------
//
//
// Generate the page
//
$template->pparse('body');

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>