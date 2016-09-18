<?php
/***************************************************************************
 *                               viewforum.php
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
include_once($phpbb_root_path . 'includes/bbcode.'.$phpEx);
//-- mod : announces -------------------------------------------------------------------------------
//-- add
include_once($phpbb_root_path . 'includes/functions_announces.'. $phpEx);
//-- fin mod : announces ---------------------------------------------------------------------------
//-- mod : split topic type ------------------------------------------------------------------------
//-- add
include_once($phpbb_root_path . 'includes/functions_topics_list.'. $phpEx);
//-- fin mod : split topic type --------------------------------------------------------------------

//
// Start session management
//
$userdata = session_pagestart($user_ip, $forum_id);
init_userprefs($userdata);
//
// End session management
//

include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_viewforum.' . $phpEx);

//
// Start initial var setup
//
if ( isset($_GET[POST_FORUM_URL]) || isset($_POST[POST_FORUM_URL]) )
{
	$forum_id = ( isset($_GET[POST_FORUM_URL]) ) ? intval($_GET[POST_FORUM_URL]) : intval($_POST[POST_FORUM_URL]);
}
else if ( isset($_GET['forum']))
{
	$forum_id = intval($_GET['forum']);
}
else
{
	$forum_id = '';
}
//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
define('IN_VIEWFORUM', true);
if (isset($_GET['selected_id']) || isset($_POST['selected_id']))
{
	$selected_id = isset($_POST['selected_id']) ? $_POST['selected_id'] : $_GET['selected_id'];
	$type	= substr($selected_id, 0, 1);
	$id		= intval(substr($selected_id, 1));
	if ($type == POST_FORUM_URL)
	{
		$forum_id = $id;
	}
	else if (($type == POST_CAT_URL) || ($selected_id == 'Root'))
	{
		$parm = ($id != 0) ? "?" . POST_CAT_URL . "=$id" : '';
		redirect(append_sid("./index.$phpEx" . $parm));
		exit;
	}
}
//-- fin mod : categories hierarchy ----------------------------------------------------------------

$start = ( isset($_GET['start']) ) ? intval($_GET['start']) : 0;
$start = ($start < 0) ? 0 : $start;

if ( isset($_GET['mark']) || isset($_POST['mark']) )
{
	$mark_read = (isset($_POST['mark'])) ? $_POST['mark'] : $_GET['mark'];
}
else
{
	$mark_read = '';
}
//
// End initial var setup
//

//
// Check if the user has actually sent a forum ID with his/her request
// If not give them a nice error page.
//
//-- mod : categories hierarchy --------------------------------------------------------------------
//-- deleted
// if ( !empty($forum_id) )
// {
//	$sql = "SELECT *
//		FROM " . FORUMS_TABLE . "
//		WHERE forum_id = $forum_id";
//	if ( !($result = $db->sql_query($sql)) )
//	{
//		message_die(GENERAL_ERROR, 'Could not obtain forums information', '', __LINE__, __FILE__, $sql);
//	}
// }
// else
// {
//	message_die(GENERAL_MESSAGE, 'Forum_not_exist');
// }
//
//
// If the query doesn't return any rows this isn't a valid forum. Inform
// the user.
//
// if ( !($forum_row = $db->sql_fetchrow($result)) )
// {
//	message_die(GENERAL_MESSAGE, 'Forum_not_exist');
// }
//-- fin mod : categories hierarchy ----------------------------------------------------------------

#======================================================================= |
#==== Start: == Force Topic Read ======================================= |
#==== v1.0.2 =========================================================== |
#====

	include_once($phpbb_root_path .'includes/functions_ftr.'. $phpEx);
	$check_viewed 	= GetUsersView($userdata['user_id']);
	$install_time 	= time();
	$bypass			= '';
		
	( !$_GET['mode'] ) ? $viewed_mode = $_GET['mode'] : $viewed_mode = $_GET['mode'];
	
	$q = "SELECT active, effected, install_date
		  FROM ". $table_prefix ."force_read"; 
	$r 			= $db -> sql_query($q); 
	$row 		= $db -> sql_fetchrow($r); 
	$active		= $row['active'];
	$effected	= $row['effected'];
	$ins_date	= $row['install_date'];
	
	if ( ($active) && (strlen($ins_date) != 10) )
		{
	$q = "UPDATE ". $table_prefix ."force_read
		  SET install_date = '". $install_time ."'"; 
	$r = $db -> sql_query($q); 		
		}
	
	if ( strlen($ins_date) != 10 )
		{
	$ins_date = $install_time;
		}
		
	if ( $viewed_mode == "reading" || $check_viewed != "false")
		{
	$bypass = 1;
		}
		
	if ( !$active )
		{
	$bypass = 1;
		}
	elseif ( ($active) && ($check_viewed == "false")  && (!$bypass) )
		{
		if ( $viewed_mode == "read_this" )
			{
		$q = "SELECT topic_number, message
			  FROM ". $table_prefix ."force_read"; 
		$r 		= $db -> sql_query($q); 
		$row 	= $db -> sql_fetchrow($r); 
		$topic	= $row['topic_number'];
		$msg	= $row['message'];
				
		InsertReadTopic($userdata['user_id']);
		redirect(append_sid("viewtopic.". $phpEx ."?t=". $topic ."&mode=reading"), true); 	
			}				 
		else
			{
			if ( ($check_viewed == "false" && $effected <> 1 && $ins_date <= $userdata['user_regdate']) || ($check_viewed == "false" && $effected == "1") )
			{
				$q = "SELECT *
				  FROM ". $table_prefix ."force_read"; 
				$r 		= $db -> sql_query($q); 
				$row 	= $db -> sql_fetchrow($r); 
				$topic	= $row['topic_number'];
				$msg	= $row['message'];
				
				if ($topic)
				{	
					include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_ftr.' . $phpEx);
					message_die(GENERAL_ERROR, $msg . "<br /><br /><a href='viewtopic." . $phpEx . "?t=" . $topic . "&mode=read_this'>" . $lang['Ftr_display_link'] . "</a>", $lang['Ftr_msg_title']);
				}
			else 
				{
					$bypass = TRUE;
				}
				}
			else
				{
			$bypass = TRUE;
				}
			}
		}
	if ( $bypass )
		{

#====
#==== Author: aUsTiN [austin@phpbb-amod.com] [http://phpbb-amod.com] === |
#==== End: ==== Force Topic Read ======================================= |	
#======================================================================= |
//-- mod : keep unread -----------------------------------------------------------------------------
//-- add
// get last visit for guest
if ( !$userdata['session_logged_in'] )
{
	$userdata['user_lastvisit'] = $board_config['guest_lastvisit'];
}
//-- fin mod : keep unread -------------------------------------------------------------------------

//-- mod : announces -------------------------------------------------------------------------------
//-- add
include_once($phpbb_root_path . 'includes/mods_settings/mod_announces.' . $phpEx);
//-- fin mod : announces ---------------------------------------------------------------------------


//-- add
// get the forum row
$forum_row = $tree['data'][ $tree['keys'][ POST_FORUM_URL . $forum_id ] ];
if ( empty($forum_row) )
{
	message_die(GENERAL_MESSAGE, 'Forum_not_exist');
}

// handle forum link type
$selected_id = POST_FORUM_URL . $forum_id;
$ch_this = isset($tree['keys'][$selected_id]) ? $tree['keys'][$selected_id] : -1;
if ( ($ch_this > -1) && !empty($tree['data'][$ch_this]['forum_link']))
{
	// add 1 to hit if count ativated
	if ($tree['data'][$ch_this]['forum_link_hit_count'])
	{
		$sql = "UPDATE " . FORUMS_TABLE . " 
					SET forum_link_hit = forum_link_hit + 1 
					WHERE forum_id=$forum_id";
		if (!$db->sql_query($sql)) message_die(GENERAL_ERROR, 'Could not increment forum hits information', '', __LINE__, __FILE__, $sql);
		cache_tree(true);
	}

	// prepare url
	$url = $tree['data'][$ch_this]['forum_link'];
	if ($tree['data'][$ch_this]['forum_link_internal'])
	{
		$part = explode( '?', $url);
		$url .= ((count($part) > 1) ? '&' : '?') . 'sid=' . $userdata['session_id'];
		$url = append_sid($url);

		// redirect to url
		redirect($url);
	}

	// Redirect via an HTML form for PITA webservers
	if (@preg_match('/Microsoft|WebSTAR|Xitami/', getenv('SERVER_SOFTWARE')))
	{
		header('Refresh: 0; URL=' . $url);
		echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><head><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><meta http-equiv="refresh" content="0; url=' . $url . '"><title>' . $lang['Redirect'] . '</title></head><body><div align="center">' . sprintf($lang['Rediect_to'], '<a href="' . $url . '">', '</a>') . '</div></body></html>';
		exit;
	}

	// Behave as per HTTP/1.1 spec for others
	header('Location: ' . $url);
	exit;
}
//-- fin mod : categories hierarchy ----------------------------------------------------------------

//
// Start auth check
//
$is_auth = array();
//-- mod : categories hierarchy --------------------------------------------------------------------
//-- delete
// $is_auth = auth(AUTH_ALL, $forum_id, $userdata, $forum_row);
//-- add
$is_auth = $tree['auth'][POST_FORUM_URL . $forum_id];
//-- fin mod : categories hierarchy ----------------------------------------------------------------


if ( !$is_auth['auth_read'] || !$is_auth['auth_view'] )
{
	if ( !$userdata['session_logged_in'] )
	{
		$redirect = POST_FORUM_URL . "=$forum_id" . ( ( isset($start) ) ? "&start=$start" : '' );
		redirect(append_sid("login.$phpEx?redirect=viewforum.$phpEx&$redirect", true));
	}
	//
	// The user is not authed to read this forum ...
	//
	$message = ( !$is_auth['auth_view'] ) ? $lang['Forum_not_exist'] : sprintf($lang['Sorry_auth_read'], $is_auth['auth_read_type']);
	$message .= "<br><br>" . sprintf($lang['Click_return_subscribe_lw'], "<a href=lwtopup.$phpEx>", "</a>" );

	message_die(GENERAL_MESSAGE, $message);
}
//
// End of auth check
//

//
// Handle marking posts
//
if ( $mark_read == 'topics' )
{
//-- mod : keep unread -----------------------------------------------------------------------------
//-- delete
//	if ( $userdata['session_logged_in'] )
//	{
//		$sql = "SELECT MAX(post_time) AS last_post 
//			FROM " . POSTS_TABLE . " 
//			WHERE forum_id = $forum_id";
//		if ( !($result = $db->sql_query($sql)) )
//		{
//			message_die(GENERAL_ERROR, 'Could not obtain forums information', '', __LINE__, __FILE__, $sql);
//		}
//
//		if ( $row = $db->sql_fetchrow($result) )
//		{
//			$tracking_forums = ( isset($_COOKIE[$board_config['cookie_name'] . '_f']) ) ? unserialize($_COOKIE[$board_config['cookie_name'] . '_f']) : array();
//			$tracking_topics = ( isset($_COOKIE[$board_config['cookie_name'] . '_t']) ) ? unserialize($_COOKIE[$board_config['cookie_name'] . '_t']) : array();
//
//			if ( ( count($tracking_forums) + count($tracking_topics) ) >= 150 && empty($tracking_forums[$forum_id]) )
//			{
//				asort($tracking_forums);
//				unset($tracking_forums[key($tracking_forums)]);
//			}
//
//			if ( $row['last_post'] > $userdata['user_lastvisit'] )
//			{
//				$tracking_forums[$forum_id] = time();
//
//				setcookie($board_config['cookie_name'] . '_f', serialize($tracking_forums), 0, $board_config['cookie_path'], $board_config['cookie_domain'], $board_config['cookie_secure']);
//			}
//		}
//-- add
		$board_config['tracking_forums'][$forum_id] = time();

		// clean cookies
		$s_topics = '';

		// unreads
		@reset($board_config['tracking_unreads']);
		while ( list($id, $time) = @each($board_config['tracking_unreads']) )
		{
			$s_topics .= ( empty($s_topics) ? '' : ', ' ) . $id;
		}

		// reads
		@reset($board_config['tracking_topics']);
		while ( list($id, $time) = @each($board_config['tracking_topics']) )
		{
			$s_topics .= ( empty($s_topics) ? '' : ', ' ) . $id;
		}

		// read the relevant topic ids
		$sql = "SELECT topic_id
					FROM " . TOPICS_TABLE . "
					WHERE topic_id IN ($s_topics)
						AND forum_id = $forum_id
						AND topic_moved_id = 0";
		if ( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not access topics', '', __LINE__, __FILE__, $sql);
		}

		// clean them
		while ( $row = $db->sql_fetchrow($result) )
		{
			if ( isset($board_config['tracking_unreads'][ $row['topic_id'] ]) )
			{
				unset($board_config['tracking_unreads'][ $row['topic_id'] ]);
			}
			if ( isset($board_config['tracking_topics'][ $row['topic_id'] ]) )
			{
				unset($board_config['tracking_topics'][ $row['topic_id'] ]);
			}
		}

		// except the cookies
		write_cookies($userdata);
//-- fin mod : keep unread -------------------------------------------------------------------------

		$template->assign_vars(array(
			'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id") . '">')
		);
//-- mod : keep unread -----------------------------------------------------------------------------
//-- delete
//	}
//-- fin mod : keep unread -------------------------------------------------------------------------

	$message = $lang['Topics_marked_read'] . '<br /><br />' . sprintf($lang['Click_return_forum'], '<a href="' . append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id") . '">', '</a> ');
	message_die(GENERAL_MESSAGE, $message);
}
//
// End handle marking posts
//

//-- mod : keep unread -----------------------------------------------------------------------------
//-- delete
// $tracking_topics = ( isset($_COOKIE[$board_config['cookie_name'] . '_t']) ) ? unserialize($_COOKIE[$board_config['cookie_name'] . '_t']) : '';
// $tracking_forums = ( isset($_COOKIE[$board_config['cookie_name'] . '_f']) ) ? unserialize($_COOKIE[$board_config['cookie_name'] . '_f']) : '';
//-- fin mod : keep unread -------------------------------------------------------------------------

//
// Do the forum Prune
//
if ( $is_auth['auth_mod'] && $board_config['prune_enable'] )
{
	if ( $forum_row['prune_next'] < time() && $forum_row['prune_enable'] )
	{
		include($phpbb_root_path . 'includes/prune.'.$phpEx);
		require($phpbb_root_path . 'includes/functions_admin.'.$phpEx);
		auto_prune($forum_id);
	}
}
//
// End of forum prune
//

//
// Obtain list of moderators of each forum
// First users, then groups ... broken into two queries
//
//-- mod : categories hierarchy --------------------------------------------------------------------
//-- delete
// $sql = "SELECT u.user_id, u.username 
//	FROM " . AUTH_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g, " . USERS_TABLE . " u
//	WHERE aa.forum_id = $forum_id 
//		AND aa.auth_mod = " . TRUE . " 
//		AND g.group_single_user = 1
//		AND ug.group_id = aa.group_id 
//		AND g.group_id = aa.group_id 
//		AND u.user_id = ug.user_id 
//	GROUP BY u.user_id, u.username  
//	ORDER BY u.user_id";
// if ( !($result = $db->sql_query($sql)) )
// {
//	message_die(GENERAL_ERROR, 'Could not query forum moderator information', '', __LINE__, __FILE__, $sql);
// }
//
// $moderators = array();
// while( $row = $db->sql_fetchrow($result) )
// {
//	$moderators[] = '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $row['user_id']) . '">' . $row['username'] . '</a>';
// }
//
// $sql = "SELECT g.group_id, g.group_name 
//	FROM " . AUTH_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g 
//	WHERE aa.forum_id = $forum_id
//		AND aa.auth_mod = " . TRUE . " 
//		AND g.group_single_user = 0
//		AND g.group_type <> ". GROUP_HIDDEN ."
//		AND ug.group_id = aa.group_id 
//		AND g.group_id = aa.group_id 
//	GROUP BY g.group_id, g.group_name  
//	ORDER BY g.group_id";
// if ( !($result = $db->sql_query($sql)) )
// {
//	message_die(GENERAL_ERROR, 'Could not query forum moderator information', '', __LINE__, __FILE__, $sql);
// }
//
// while( $row = $db->sql_fetchrow($result) )
// {
//	$moderators[] = '<a href="' . append_sid("groupcp.$phpEx?" . POST_GROUPS_URL . "=" . $row['group_id']) . '">' . $row['group_name'] . '</a>';
// }
//-- add
// moderators list
$moderators = array(); 
$idx = $tree['keys'][ POST_FORUM_URL . $forum_id ]; 
for ( $i = 0; $i < count($tree['mods'][$idx]['user_id']); $i++ ) { 
    $moderators[] = '<a href="' . append_sid("./profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $tree['mods'][$idx]['user_id'][$i]) . '">' . $tree['mods'][$idx]['username'][$i] . '</a>'; 
} 
for ( $i = 0; $i < count($tree['mods'][$idx]['group_id']); $i++ ) { 
    $moderators[] = '<a href="' . append_sid("./groupcp.$phpEx?" . POST_GROUPS_URL . "=" . $tree['mods'][$idx]['group_id'][$i]) . '">' . $tree['mods'][$idx]['group_name'][$i] . '</a>'; 
}
//-- fin mod : categories hierarchy ----------------------------------------------------------------

//----------------------------------------------------------------------------- 
// MOD: Delayed Topics 

// If use has no permission for delayed topics, let's not show the topics that have dates that we do not have yet reached... 
/* altered by edwin mod is not OK! 
if (($userdata['user_level'] != ADMIN && $userdata['user_level'] != MOD) || !$is_auth['auth_delayedpost'])*/ 
if (($userdata['user_level'] != ADMIN && !$is_auth['auth_mod']) || !$is_auth['auth_delayedpost']) 
{ 
    $current_time = time(); 
    /* altered by edwin 
    $limit_topics_time = "$limit_topics_time AND (t.topic_time <= $current_time OR t.topic_poster = " . $userdata['user_id'] . ")"; 
    */ 
    $limit_topics_time = " AND (t.topic_time <= $current_time OR t.topic_poster = " . $userdata['user_id'] . ")"; 
} 

// MOD: Delayed Topics {end} 
//-----------------------------------------------------------------------------	
$l_moderators = ( count($moderators) == 1 ) ? $lang['Moderator'] : $lang['Moderators'];
$forum_moderators = ( count($moderators) ) ? implode(', ', $moderators) : $lang['None'];
unset($moderators);

//
// Generate a 'Show topics in previous x days' select box. If the topicsdays var is sent
// then get it's value, find the number of topics with dates newer than it (to properly
// handle pagination) and alter the main query
//
$previous_days = array(0, 1, 7, 14, 30, 90, 180, 364);
$previous_days_text = array($lang['All_Topics'], $lang['1_Day'], $lang['7_Days'], $lang['2_Weeks'], $lang['1_Month'], $lang['3_Months'], $lang['6_Months'], $lang['1_Year']);

if ( !empty($_POST['topicdays']) || !empty($_GET['topicdays']) )
{
	$topic_days = ( !empty($_POST['topicdays']) ) ? intval($_POST['topicdays']) : intval($_GET['topicdays']);
	$min_topic_time = time() - ($topic_days * 86400);

	$sql = "SELECT COUNT(t.topic_id) AS forum_topics 
		FROM " . TOPICS_TABLE . " t, " . POSTS_TABLE . " p 
		WHERE t.forum_id = $forum_id 
			AND p.post_id = t.topic_last_post_id
			AND p.post_time >= $min_topic_time"; 

	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain limited topics count information', '', __LINE__, __FILE__, $sql);
	}
	$row = $db->sql_fetchrow($result);

	$topics_count = ( $row['forum_topics'] ) ? $row['forum_topics'] : 1;
	$limit_topics_time .= " AND p.post_time >= $min_topic_time";

	if ( !empty($_POST['topicdays']) )
	{
		$start = 0;
	}
}
else
{
	$topics_count = ( $forum_row['forum_topics'] ) ? $forum_row['forum_topics'] : 1;

	/* commented by edwin 
    $limit_topics_time = '';*/
	$topic_days = 0;
}

$select_topic_days = '<select name="topicdays">';
for($i = 0; $i < count($previous_days); $i++)
{
	$selected = ($topic_days == $previous_days[$i]) ? ' selected="selected"' : '';
	$select_topic_days .= '<option value="' . $previous_days[$i] . '"' . $selected . '>' . $previous_days_text[$i] . '</option>';
}
$select_topic_days .= '</select>';


//
// All announcement data, this keeps announcements
// on each viewforum page ...
//

//-- mod : announces -------------------------------------------------------------------------------
// here we added
//	( [../..]" . ( !intval($board_config['announcement_display_forum']) ? " OR t.topic_type = " . POST_GLOBAL_ANNOUNCE : '' ) . ")
// and
//	( [../..] OR t.topic_type = " . POST_GLOBAL_ANNOUNCE . ")
// and
//	t.topic_type DESC,
//-- modify
$sql = "SELECT t.*, u.username, u.user_id, u2.username as user2, u2.user_id as id2, p.post_time, p.post_username
	FROM " . TOPICS_TABLE . " t, " . USERS_TABLE . " u, " . POSTS_TABLE . " p, " . USERS_TABLE . " u2
	WHERE (t.forum_id = $forum_id" . ( (intval($board_config['announcement_display_forum']) == 0) ? " OR t.topic_type = " . POST_GLOBAL_ANNOUNCE : '' ) . ") 
		AND t.topic_poster = u.user_id
		AND p.post_id = t.topic_last_post_id
		AND p.poster_id = u2.user_id
		AND (t.topic_type = " . POST_ANNOUNCE . " OR t.topic_type = " . POST_GLOBAL_ANNOUNCE . ") 
		$limit_topics_time 
	ORDER BY t.topic_type DESC, p.post_time DESC ";
//-- fin mod : announces -------------------------------------------------------------------------------

if ( !($result = $db->sql_query($sql)) )
{
   message_die(GENERAL_ERROR, 'Could not obtain topic information', '', __LINE__, __FILE__, $sql);
}

$topic_rowset = array();
$total_announcements = 0;
while( $row = $db->sql_fetchrow($result) )
{
	$topic_rowset[] = $row;
	$total_announcements++;
}

$db->sql_freeresult($result);

//
// Grab all the basic data (all topics except announcements)
// for this forum
//

//-- mod : announces -------------------------------------------------------------------------------
// here we added
//	AND t.topic_type <> " . POST_GLOBAL_ANNOUNCE . "
//-- modify
$sql = "SELECT t.*, u.username, u.user_id, u2.username as user2, u2.user_id as id2, p.post_username, p2.post_username AS post_username2, p2.post_time 
	FROM " . TOPICS_TABLE . " t, " . USERS_TABLE . " u, " . POSTS_TABLE . " p, " . POSTS_TABLE . " p2, " . USERS_TABLE . " u2
	WHERE t.forum_id = $forum_id
		AND t.topic_poster = u.user_id
		AND p.post_id = t.topic_first_post_id
		AND p2.post_id = t.topic_last_post_id
		AND u2.user_id = p2.poster_id 
		AND t.topic_type <> " . POST_ANNOUNCE . " AND t.topic_type <> " . POST_GLOBAL_ANNOUNCE . "
		$limit_topics_time
	ORDER BY t.topic_type DESC, p2.post_time DESC 
	LIMIT $start, ".$board_config['topics_per_page'];
//-- fin mod : announces ---------------------------------------------------------------------------
if ( !($result = $db->sql_query($sql)) )
{
   message_die(GENERAL_ERROR, 'Could not obtain topic information', '', __LINE__, __FILE__, $sql);
}

$total_topics = 0;
while( $row = $db->sql_fetchrow($result) )
{
	$topic_rowset[] = $row;
	$total_topics++;
}

$db->sql_freeresult($result);

//
// Total topics ...
//
$total_topics += $total_announcements;

//
// Define censored word matches
//
$orig_word = array();
$replacement_word = array();
obtain_word_list($orig_word, $replacement_word);

//
// Post URL generation for templating vars
//
$template->assign_vars(array(
	'L_DISPLAY_TOPICS' => $lang['Display_topics'],

	'U_POST_NEW_TOPIC' => append_sid("posting.$phpEx?mode=newtopic&amp;" . POST_FORUM_URL . "=$forum_id"),

	'S_SELECT_TOPIC_DAYS' => $select_topic_days,
	'S_POST_DAYS_ACTION' => append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=" . $forum_id . "&amp;start=$start"))
);

// Hide Buttons :: Added
if($is_auth['auth_post']){ 
    $template->assign_block_vars('is_auth_post', array()); 
}
//
// User authorisation levels output
//
$s_auth_can = ( ( $is_auth['auth_post'] ) ? $lang['Rules_post_can'] : $lang['Rules_post_cannot'] ) . '<br />';
$s_auth_can .= ( ( $is_auth['auth_reply'] ) ? $lang['Rules_reply_can'] : $lang['Rules_reply_cannot'] ) . '<br />';
$s_auth_can .= ( ( $is_auth['auth_edit'] ) ? $lang['Rules_edit_can'] : $lang['Rules_edit_cannot'] ) . '<br />';
$s_auth_can .= ( ( $is_auth['auth_delete'] ) ? $lang['Rules_delete_can'] : $lang['Rules_delete_cannot'] ) . '<br />';
$s_auth_can .= ( ( $is_auth['auth_vote'] ) ? $lang['Rules_vote_can'] : $lang['Rules_vote_cannot'] ) . '<br />';
$s_auth_can .= ( $is_auth['auth_ban'] ) ? $lang['Rules_ban_can'] . '<br />' : ''; 
$s_auth_can .= ( $is_auth['auth_greencard'] ) ? $lang['Rules_greencard_can'] . '<br />' : ''; 
$s_auth_can .= ( $is_auth['auth_bluecard'] ) ? $lang['Rules_bluecard_can'] . '<br />' : '';
//-- mod : calendar --------------------------------------------------------------------------------
//-- add
$s_auth_can .= ( ( $is_auth['auth_cal'] ) ? $lang['Rules_calendar_can'] : $lang['Rules_calendar_cannot'] ) . '<br />';
//-- fin mod : calendar ----------------------------------------------------------------------------
attach_build_auth_levels($is_auth, $s_auth_can);

if ( $is_auth['auth_mod'] )
{
	$s_auth_can .= sprintf($lang['Rules_moderate'], '<a href="' . append_sid("modcp.$phpEx?" . POST_FORUM_URL . "=$forum_id&amp;start=" . $start . "&amp;p_sid=" . $userdata['priv_session_id']) . '">', '</a>');
}

//
// Mozilla navigation bar
//
$nav_links['up'] = array(
	'url' => append_sid('index.'.$phpEx),
	'title' => sprintf($lang['Forum_Index'], $board_config['sitename'])
);

//
// Dump out the page header and load viewforum template
//
//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
$forum_row['forum_name'] = get_object_lang(POST_FORUM_URL . $forum_id, 'name');
//-- fin mod : categories hierarchy ----------------------------------------------------------------

define('SHOW_ONLINE', true);
//Begin Lo-Fi Mod 
$page_title = $forum_row['forum_name'];
//End Lo-Fi Mod
include($phpbb_root_path . 'includes/page_header.'.$phpEx);

$template->set_filenames(array(
	'body' => 'viewforum_body.tpl')
);
make_jumpbox('viewforum.'.$phpEx);
//-- mod : announces -------------------------------------------------------------------------------
//-- add
announces_from_forums(POST_FORUM_URL . $forum_id);
//-- fin mod : announces ---------------------------------------------------------------------------
//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
display_index(POST_FORUM_URL . $forum_id);
//-- fin mod : categories hierarchy ----------------------------------------------------------------


$template->assign_vars(array(
	'FORUM_ID' => $forum_id,
	'FORUM_NAME' => $forum_row['forum_name'],
	'MODERATORS' => $forum_moderators,
	'POST_IMG' => ( $forum_row['forum_status'] == FORUM_LOCKED ) ? $images['post_locked'] : $images['post_new'],

	'FOLDER_IMG' => $images['folder'],
	'FOLDER_NEW_IMG' => $images['folder_new'],
	'FOLDER_HOT_IMG' => $images['folder_hot'],
	'FOLDER_HOT_NEW_IMG' => $images['folder_hot_new'],
	'FOLDER_LOCKED_IMG' => $images['folder_locked'],
	'FOLDER_LOCKED_NEW_IMG' => $images['folder_locked_new'],
	'FOLDER_STICKY_IMG' => $images['folder_sticky'],
	'FOLDER_STICKY_NEW_IMG' => $images['folder_sticky_new'],
	'FOLDER_ANNOUNCE_IMG' => $images['folder_announce'],
	'FOLDER_ANNOUNCE_NEW_IMG' => $images['folder_announce_new'],
	'FOLDER_POSTED_IMG' => $images['folder_posted'], 

	'L_TOPICS' => $lang['Topics'],
	'L_REPLIES' => $lang['Replies'],
	'L_VIEWS' => $lang['Views'],
	'L_POSTS' => $lang['Posts'],
	'L_LASTPOST' => $lang['Last_Post'], 
	'L_MODERATOR' => $l_moderators, 
	'L_MARK_TOPICS_READ' => $lang['Mark_all_topics'], 
	'L_POST_NEW_TOPIC' => ( $forum_row['forum_status'] == FORUM_LOCKED ) ? $lang['Forum_locked'] : $lang['Post_new_topic'], 
	'L_NO_NEW_POSTS' => $lang['No_new_posts'],
	'L_NEW_POSTS' => $lang['New_posts'],
	'L_NO_NEW_POSTS_LOCKED' => $lang['No_new_posts_locked'], 
	'L_NEW_POSTS_LOCKED' => $lang['New_posts_locked'], 
	'L_NO_NEW_POSTS_HOT' => $lang['No_new_posts_hot'],
	'L_NEW_POSTS_HOT' => $lang['New_posts_hot'],
	'L_ANNOUNCEMENT' => $lang['Post_Announcement'], 
	'L_STICKY' => $lang['Post_Sticky'], 
	'L_POSTED' => $lang['Posted'],
	'L_JOINED' => $lang['Joined'],
	'L_AUTHOR' => $lang['Author'],
	'L_POPUP_MESSAGE' => $lang['Postings_popup_message'],

	'S_AUTH_LIST' => $s_auth_can, 

	'U_VIEW_FORUM' => append_sid("viewforum.$phpEx?" . POST_FORUM_URL ."=$forum_id"),

	'U_MARK_READ' => append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id&amp;mark=topics"))
);
//
// End header
//

//
// Okay, lets dump out the page ...
//
//-- mod : split topic type ------------------------------------------------------------------------
//-- add
// adjust the item id
for ($i=0; $i < count($topic_rowset); $i++)
{
	$topic_rowset[$i]['topic_id'] = POST_TOPIC_URL . $topic_rowset[$i]['topic_id'];
}

// set the bottom sort option
$footer = $lang['Display_topics'] . ':&nbsp;' . $select_topic_days . '&nbsp;' . ( !empty($s_display_order) ? $s_display_order : '') . '<input type="submit" class="liteoption" value="' . $lang['Go'] . '" name="submit" />';

// send the list
$allow_split_type = true;
$display_nav_tree = false;

if(!count($topic_rank_set)){ 
    if(!$RATING_PATH){ 
        define('RATING_PATH', $phpbb_root_path.'mods/rating/'); 
    } 
    include_once(RATING_PATH.'functions_rating.'.$phpEx); 
    if(!$rating_config){ 
        $rating_config = get_rating_config('1'); 
    } 
    if ( $rating_config[1] == 1 ) { 
        $topic_rank_set = array(); 
        get_rating_ranks(); 
    } 
} 

// SHOW DROPDOWN BOX FOR RATINGS SCREEN IF APPROPRIATE
$rating_config = get_rating_config('1,2,14,18,19');
if ( $rating_config[1] == 1 ) 
{
	if ( $rating_config['19'] == 1 && $is_auth['auth_view'] && $is_auth['auth_read'] )
	//REMOVED//if ( $rating_config[19] == 1 && $forum_topic_data['auth_view'] < 2 && $forum_topic_data['auth_read'] < 2 )
	{
		$u_ratings = append_sid($phpbb_root_path.'ratings.'.$phpEx);
		$template->assign_block_vars('ratingsbox', array(
			'U_RATINGS' => $u_ratings,
			'L_LATEST_RATINGS' => $lang['Latest_ratings'],
			'L_HIGHEST_RANKED_POSTS' => $lang['Highest_ranked_posts'],
			'L_HIGHEST_RANKED_TOPICS' => $lang['Highest_ranked_topics'],
			'L_HIGHEST_RANKED_POSTERS' => $lang['Highest_ranked_posters']
			)
		);
	}
}

topic_list('TOPICS_LIST_BOX', 'topics_list_box', $topic_rowset, '', $allow_split_type, $display_nav_tree, $footer, true, '', 0, '', array(), $topic_rank_set);
//-- delete
/*
//---------------------------------------
//
// Note : all the code that was standing there stands now in functions_topics_list.php, topic_list() func
//
//---------------------------------------
if( $total_topics )
{
	for($i = 0; $i < $total_topics; $i++)
	{
		$topic_id = $topic_rowset[$i]['topic_id'];

		$topic_title = ( count($orig_word) ) ? preg_replace($orig_word, $replacement_word, $topic_rowset[$i]['topic_title']) : $topic_rowset[$i]['topic_title'];

		$replies = $topic_rowset[$i]['topic_replies'];

		$topic_type = $topic_rowset[$i]['topic_type'];

		if( $topic_type == POST_ANNOUNCE )
		{
			$topic_type = $lang['Topic_Announcement'] . ' ';
		}
		else if( $topic_type == POST_STICKY )
		{
			$topic_type = $lang['Topic_Sticky'] . ' ';
		}
		else
		{
			$topic_type = '';		
		}

		if( $topic_rowset[$i]['topic_vote'] )
		{
			$topic_type .= $lang['Topic_Poll'] . ' ';
		}
		
		if( $topic_rowset[$i]['topic_status'] == TOPIC_MOVED )
		{
			$topic_type = $lang['Topic_Moved'] . ' ';
			$topic_id = $topic_rowset[$i]['topic_moved_id'];

			$folder_image =  $images['folder'];
			$folder_alt = $lang['Topics_Moved'];
			$newest_post_img = '';
		}
		else
		{
			if( $topic_rowset[$i]['topic_type'] == POST_ANNOUNCE )
			{
				$folder = $images['folder_announce'];
				$folder_new = $images['folder_announce_new'];
			}
			else if( $topic_rowset[$i]['topic_type'] == POST_STICKY )
			{
				$folder = $images['folder_sticky'];
				$folder_new = $images['folder_sticky_new'];
			}
			else if( $topic_rowset[$i]['topic_status'] == TOPIC_LOCKED )
			{
				$folder = $images['folder_locked'];
				$folder_new = $images['folder_locked_new'];
			}
			else
			{
				if($replies >= $board_config['hot_threshold'])
				{
					$folder = $images['folder_hot'];
					$folder_new = $images['folder_hot_new'];
				}
				else
				{
					$folder = $images['folder'];
					$folder_new = $images['folder_new'];
				}
			}

			$newest_post_img = '';
//-- mod : keep unread -----------------------------------------------------------------------------
//-- delete
//			if( $userdata['session_logged_in'] )
//			{
//				if( $topic_rowset[$i]['post_time'] > $userdata['user_lastvisit'] ) 
//				{
//					if( !empty($tracking_topics) || !empty($tracking_forums) || isset($_COOKIE[$board_config['cookie_name'] . '_f_all']) )
//					{
//						$unread_topics = true;
//
//						if( !empty($tracking_topics[$topic_id]) )
//						{
//							if( $tracking_topics[$topic_id] >= $topic_rowset[$i]['post_time'] )
//							{
//								$unread_topics = false;
//							}
//						}
//
//						if( !empty($tracking_forums[$forum_id]) )
//						{
//							if( $tracking_forums[$forum_id] >= $topic_rowset[$i]['post_time'] )
//							{
//								$unread_topics = false;
//							}
//						}
//
//						if( isset($_COOKIE[$board_config['cookie_name'] . '_f_all']) )
//						{
//							if( $_COOKIE[$board_config['cookie_name'] . '_f_all'] >= $topic_rowset[$i]['post_time'] )
//							{
//								$unread_topics = false;
//							}
//						}
//-- add
			// have we got a last visit time for this topic
			$topic_last_read = intval($board_config['tracking_unreads'][$topic_id]);
			if ( !empty($board_config['tracking_all']) && ($board_config['tracking_all'] > $topic_last_read) )
			{
				$topic_last_read = $board_config['tracking_all'];
			}
			if ( isset($board_config['tracking_forums'][$forum_id]) && ($board_config['tracking_forums'][$forum_id] > $topic_last_read) )
			{
				$topic_last_read = $board_config['tracking_forums'][$forum_id];
			}
			if ( isset($board_config['tracking_topics'][$topic_id]) && ($board_config['tracking_topics'][$topic_id] > $topic_last_read) )
			{
				$topic_last_read = $board_config['tracking_topics'][$topic_id];
			}
			if ( empty($topic_last_read) )
			{
				$topic_last_read = $userdata['user_lastvisit'];
			}

			// unread status ?
			$unread_topics = ( $topic_rowset[$i]['post_time'] > $topic_last_read );
//-- fin mod : keep unread -------------------------------------------------------------------------

						if( $unread_topics )
						{
							$folder_image = $folder_new;
							$folder_alt = $lang['New_posts'];

							$newest_post_img = '<a href="' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;view=newest") . '"><img src="' . $images['icon_newest_reply'] . '" alt="' . $lang['View_newest_post'] . '" title="' . $lang['View_newest_post'] . '" border="0" /></a> ';
						}
						else
						{
							$folder_image = $folder;
							$folder_alt = ( $topic_rowset[$i]['topic_status'] == TOPIC_LOCKED ) ? $lang['Topic_locked'] : $lang['No_new_posts'];

							$newest_post_img = '';
						}
//-- mod : keep unread -----------------------------------------------------------------------------
//-- delete
//					}
//					else
//					{
//						$folder_image = $folder_new;
//						$folder_alt = ( $topic_rowset[$i]['topic_status'] == TOPIC_LOCKED ) ? $lang['Topic_locked'] : $lang['New_posts'];
//
//						$newest_post_img = '<a href="' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;view=newest") . '"><img src="' . $images['icon_newest_reply'] . '" alt="' . $lang['View_newest_post'] . '" title="' . $lang['View_newest_post'] . '" border="0" /></a> ';
//					}
//				}
//				else 
//				{
//					$folder_image = $folder;
//					$folder_alt = ( $topic_rowset[$i]['topic_status'] == TOPIC_LOCKED ) ? $lang['Topic_locked'] : $lang['No_new_posts'];
//
//					$newest_post_img = '';
//				}
//			}
//			else
//			{
//				$folder_image = $folder;
//				$folder_alt = ( $topic_rowset[$i]['topic_status'] == TOPIC_LOCKED ) ? $lang['Topic_locked'] : $lang['No_new_posts'];
//
//				$newest_post_img = '';
//			}
//-- fin mod : keep unread -------------------------------------------------------------------------
		}

		if( ( $replies + 1 ) > $board_config['posts_per_page'] )
		{
			$total_pages = ceil( ( $replies + 1 ) / $board_config['posts_per_page'] );
			$goto_page = ' [ <img src="' . $images['icon_gotopost'] . '" alt="' . $lang['Goto_page'] . '" title="' . $lang['Goto_page'] . '" />' . $lang['Goto_page'] . ': ';

			$times = 1;
			for($j = 0; $j < $replies + 1; $j += $board_config['posts_per_page'])
			{
				$goto_page .= '<a href="' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=" . $topic_id . "&amp;start=$j") . '">' . $times . '</a>';
				if( $times == 1 && $total_pages > 4 )
				{
					$goto_page .= ' ... ';
					$times = $total_pages - 3;
					$j += ( $total_pages - 4 ) * $board_config['posts_per_page'];
				}
				else if ( $times < $total_pages )
				{
					$goto_page .= ', ';
				}
				$times++;
			}
			$goto_page .= ' ] ';
		}
		else
		{
			$goto_page = '';
		}
		
		$view_topic_url = append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id");

		$topic_author = ( $topic_rowset[$i]['user_id'] != ANONYMOUS ) ? '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $topic_rowset[$i]['user_id']) . '">' : '';
		$topic_author .= ( $topic_rowset[$i]['user_id'] != ANONYMOUS ) ? $topic_rowset[$i]['username'] : ( ( $topic_rowset[$i]['post_username'] != '' ) ? $topic_rowset[$i]['post_username'] : $lang['Guest'] );

		$topic_author .= ( $topic_rowset[$i]['user_id'] != ANONYMOUS ) ? '</a>' : '';

		$first_post_time = create_date($board_config['default_dateformat'], $topic_rowset[$i]['topic_time'], $board_config['board_timezone']);

		$last_post_time = create_date($board_config['default_dateformat'], $topic_rowset[$i]['post_time'], $board_config['board_timezone']);

		$last_post_author = ( $topic_rowset[$i]['id2'] == ANONYMOUS ) ? ( ($topic_rowset[$i]['post_username2'] != '' ) ? $topic_rowset[$i]['post_username2'] . ' ' : $lang['Guest'] . ' ' ) : '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '='  . $topic_rowset[$i]['id2']) . '">' . $topic_rowset[$i]['user2'] . '</a>';

		$last_post_url = '<a href="' . append_sid("viewtopic.$phpEx?"  . POST_POST_URL . '=' . $topic_rowset[$i]['topic_last_post_id']) . '#' . $topic_rowset[$i]['topic_last_post_id'] . '"><img src="' . $images['icon_latest_reply'] . '" alt="' . $lang['View_latest_post'] . '" title="' . $lang['View_latest_post'] . '" border="0" /></a>';

		$views = $topic_rowset[$i]['topic_views'];
		
		$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
		$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
// BEGIN cmx_mod
		$news_label = ( $topic_rowset[$i]['news_id'] > 0 ) ? '[ ' . $lang['News'] . ' ] ' : '';
// END cmx_mod


// 
// Begin Approve_Mod Block : 9
// 
		if ( $approve_mod['enabled'] )
		{
			$approve_mod['topics_awaiting'] = false;
			$approve_sql = "SELECT * FROM " . APPROVE_POSTS_TABLE . " 
				WHERE topic_id = " . intval($topic_id) . " 
					AND is_topic = 1 
				LIMIT 0,1";
			if ( !($approve_result = $db->sql_query($approve_sql)) ) 
			{ 
				message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
			} 
			if ( $approve_row = $db->sql_fetchrow($approve_result) ) 
			{ 
				if ( intval($approve_row['is_topic']) == 1 )
				{
					$approve_mod['topics_awaiting'] = true;
				}
			} 

			if ( in_array($userdata['user_id'], $approve_mod['moderators']) || $is_auth['auth_mod'] )
			{
				if ( $approve_mod['topics_awaiting'] )
				{
					$topic_title .= "</a><br /><a href=\"" . append_sid("viewtopic." . $phpEx . "?t=" . $topic_id ) . "\" class='copyright'>[ " . $lang['approve_topic_is_awaiting'] . " ]";
				}
				else
				{
					$approve_sql = "SELECT * FROM " . APPROVE_POSTS_TABLE . " 
						WHERE topic_id = " . intval($topic_id) . " 
							AND is_post = 1 
						ORDER BY post_id 
						LIMIT 0,2";
					if ( !($approve_result = $db->sql_query($approve_sql)) ) 
					{ 
						message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
					} 
					if ( $approve_row = $db->sql_fetchrow($approve_result) ) 
					{ 
						if ( $db->sql_numrows($approve_result) >= 1 )
						{
							$topic_title .= "</a><br /><a href=\"" . append_sid("viewtopic." . $phpEx . "?p=" . $approve_row['post_id'] ) . "#" . $approve_row['post_id'] . "\" class='copyright'>[ " . $lang['approve_topic_has_awaiting'] . " ]";
						}
					}
				}
			}
			else
			{
				if ( $approve_mod['topics_awaiting'] )
				{
					if ( $approve_mod['forum_hide_unapproved_topics'] )
					{
						continue;
					}
					$topic_title = "</a><span class='copyright'>[ " . $lang['approve_topic_is_awaiting'] . " ]</span>";
					$view_topic_url = append_sid("viewforum.php?f=" . $forum_id );
					$last_post_url = $last_post_url = '<img src="' . $images['icon_latest_reply'] . '" alt="' . $lang['View_latest_post'] . '" title="' . $lang['View_latest_post'] . '" border="0" />';
					$goto_page = '';
					$last_post_author = ( intval($topic_rowset[$i]['id2']) == intval(ANONYMOUS) ) ? $lang['Guest'] : $last_post_author;
					$topic_author = ( intval($topic_rowset[$i]['user_id']) == intval(ANONYMOUS) ) ? $lang['Guest'] : $topic_author;
				}
				else
				{
					$approve_sql = "SELECT * FROM " . APPROVE_POSTS_TABLE . " 
						WHERE post_id = " . intval($topic_rowset[$i]['topic_last_post_id']) . " 
						AND is_post = 1 
						LIMIT 0,1";
					if ( !($approve_result = $db->sql_query($approve_sql)) ) 
					{ 
						message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
					} 
					$approve_row = $db->sql_fetchrow($approve_result);
					if ( intval($approve_row['post_id']) == intval($topic_rowset[$i]['topic_last_post_id']) )
					{
						if ( $approve_mod['forum_hide_unapproved_posts'] )
						{
							$approve_sql = "SELECT p.post_id, p.poster_id, p.post_time, p.post_username, u.username 
								FROM " . POSTS_TABLE . " p, " . APPROVE_POSTS_TABLE . " a, " . USERS_TABLE . " u 
								WHERE a.post_id = " . intval($topic_rowset[$i]['topic_last_post_id']) . " 
								AND p.topic_id = a.topic_id 
								AND u.user_id = p.poster_id 
								ORDER BY p.post_time DESC";
							if ( !($approve_result = $db->sql_query($approve_sql)) ) 
							{ 
								message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
							} 
							while( $approve_row = $db->sql_fetchrow($approve_result) )
							{
								$approve_sql = "SELECT * FROM " . APPROVE_POSTS_TABLE . " 
									WHERE post_id = " . intval($approve_row['post_id']) . " 
									LIMIT 0,1";
								if ( !($approve_result2 = $db->sql_query($approve_sql)) ) 
								{ 
									message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
								} 
								$approve_row2 = $db->sql_fetchrow($approve_result2);
								if ( !$approve_row2['post_id'] )
								{
									$last_post_time = create_date($board_config['default_dateformat'], $approve_row['post_time'], $board_config['board_timezone']);

									$last_post_author = ( $approve_row['poster_id'] == ANONYMOUS ) ? ( ($approve_row['post_username'] != '' ) ? $approve_row['post_username'] . ' ' : $lang['Guest'] . ' ' ) : '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '='  . $approve_row['poster_id']) . '">' . $approve_row['username'] . '</a>';

									$last_post_url = '<a href="' . append_sid("viewtopic.$phpEx?"  . POST_POST_URL . '=' . $approve_row['post_id']) . '#' . $approve_row['post_id'] . '"><img src="' . $images['icon_latest_reply'] . '" alt="' . $lang['View_latest_post'] . '" title="' . $lang['View_latest_post'] . '" border="0" /></a>';
									break;
								}
							}						
						}
						else
						{
							$last_post_author = ( intval($topic_rowset[$i]['id2']) == intval(ANONYMOUS) ) ? $lang['Guest'] : $last_post_author;
						}
					}
				}
			}
		}
// 
// End Approve_Mod Block : 9
//

		$template->assign_block_vars('topicrow', array(
			'ROW_COLOR' => $row_color,
			'ROW_CLASS' => $row_class,
			'FORUM_ID' => $forum_id,
			'TOPIC_ID' => $topic_id,
			'TOPIC_FOLDER_IMG' => $folder_image, 
			'TOPIC_AUTHOR' => $topic_author, 
			'GOTO_PAGE' => $goto_page,
			'REPLIES' => $replies,
			'NEWEST_POST_IMG' => $newest_post_img,
			'TOPIC_ATTACHMENT_IMG' => topic_attachment_image($topic_rowset[$i]['topic_attachment']),
			'TOPIC_TITLE' => $topic_title,
			'TOPIC_TYPE' => $topic_type,
			'VIEWS' => $views,
			'FIRST_POST_TIME' => $first_post_time, 
			'LAST_POST_TIME' => $last_post_time, 
			'LAST_POST_AUTHOR' => $last_post_author, 
			'LAST_POST_IMG' => $last_post_url,
// BEGIN cmx_mod
			'L_NEWS' => $news_label,
// END cmx_mod


			'L_TOPIC_FOLDER_ALT' => $folder_alt, 

			'U_VIEW_TOPIC' => $view_topic_url)
		);
	}
*/
//-- fin mod : split topic type --------------------------------------------------------------------

	$topics_count -= $total_announcements;

	$template->assign_vars(array(
		'PAGINATION' => generate_pagination("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id&amp;topicdays=$topic_days", $topics_count, $board_config['topics_per_page'], $start),
		'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $board_config['topics_per_page'] ) + 1 ), ceil( $topics_count / $board_config['topics_per_page'] )), 

		'L_GOTO_PAGE' => $lang['Goto_page'])
	);
//-- mod : split topic type ------------------------------------------------------------------------
//-- delete
/*
}
else
{
	//
	// No topics
	//
	$no_topics_msg = ( $forum_row['forum_status'] == FORUM_LOCKED ) ? $lang['Forum_locked'] : $lang['No_topics_post_one'];
	$template->assign_vars(array(
		'L_NO_TOPICS' => $no_topics_msg)
	);

	$template->assign_block_vars('switch_no_topics', array() );

}
*/
//-- fin mod : split topic type --------------------------------------------------------------------

//
// Parse the page and print
//
$template->pparse('body');

//
// Page footer
//
include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
#======================================================================= |
#==== Start: == Force Topic Read ======================================= |
#==== v1.0.2 =========================================================== |
#====
	if ( $active )
		{
	}
		}
#====
#==== Author: aUsTiN [austin@phpbb-amod.com] [http://phpbb-amod.com] === |
#==== End: ==== Force Topic Read ======================================= |	
#======================================================================= |
?>