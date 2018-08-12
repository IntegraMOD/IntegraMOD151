<?php
/***************************************************************************
 *                               viewtopic.php
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
define('IN_CASHMOD', true);
define('CM_VIEWTOPIC', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

//
// Start session management
//
$userdata = session_pagestart($user_ip, $forum_id);
init_userprefs($userdata);
//
// End session management
//

//Begin Lo-Fi Mod 
if ($lofi) {
 $lang['Reply_with_quote'] = $lang['quote_lofi'] ;
 $lang['Edit_delete_post'] = $lang['edit_lofi'];
 $lang['View_IP'] = $lang['ip_lofi'];
 $lang['Delete_post'] = $lang['del_lofi'];
 $lang['Read_profile'] = $lang['profile_lofi'];
 $lang['Send_private_message'] = $lang['pm_lofi'];
 $lang['Send_email'] = $lang['email_lofi'];
 $lang['Visit_website'] = $lang['website_lofi'];
 $lang['ICQ'] = $lang['icq_lofi'];
 $lang['AIM'] = $lang['aim_lofi'];
 $lang['YIM'] = $lang['yim_lofi'];
 $lang['MSNM'] = $lang['msnm_lofi'];
}
//End Lo-Fi Mod

include($phpbb_root_path . 'includes/bbcode.'.$phpEx);
include($phpbb_root_path . 'includes/functions_post.'.$phpEx);
include($phpbb_root_path . 'includes/functions_bookmark.'.$phpEx);
//-- mod : post icon -------------------------------------------------------------------------------
//-- add
include($phpbb_root_path . 'includes/def_icons.'. $phpEx);
//-- fin mod : post icon ---------------------------------------------------------------------------
//-- mod : calendar --------------------------------------------------------------------------------
//-- add
include_once($phpbb_root_path . 'includes/functions_calendar.'.$phpEx);
//-- fin mod : calendar ----------------------------------------------------------------------------
//include($phpbb_root_path . 'profilcp/functions_profile.'.$phpEx);


//
// Start initial var setup
//
$topic_id = $post_id = 0;
$vote_id = array();
if ( isset($_GET[POST_TOPIC_URL]) )
{
	$topic_id = intval($_GET[POST_TOPIC_URL]);
}
else if ( isset($_GET['topic']) )
{
	$topic_id = intval($_GET['topic']);
}

if ( isset($_GET[POST_POST_URL]))
{
	$post_id = intval($_GET[POST_POST_URL]);
}


$start = ( isset($_GET['start']) ) ? intval($_GET['start']) : 0;
$start = ($start < 0) ? 0 : $start;

$download = ( isset($_GET['download']) ) ? $_GET['download'] : '';

if(isset($_GET['printertopic']))
{
	$start = ( isset($_GET['start_rel']) ) && ( isset($_GET['printertopic']) ) ? intval($_GET['start_rel']) - 1 : $start;
	// $finish when positive indicates last message; when negative it indicates range; can't be 0
	if(isset($_GET['finish_rel']))
	{
		$finish = intval($_GET['finish_rel']);
	}
	if(($finish >= 0) && (($finish - $start) <=0))
	{
	unset($finish);
	}
}

if (!$topic_id && !$post_id)
{
	message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');
}

if ( $download )
{
	$sql_download = ( $download != -1 ) ? " AND p.post_id = $download " : '';

	$orig_word = array();
	$replacement_word = array();
	obtain_word_list($orig_word, $replacement_word);

	$sql = "SELECT u.*, p.*,  pt.post_text, pt.post_subject, pt.bbcode_uid
		FROM " . POSTS_TABLE . " p, " . USERS_TABLE . " u, " . POSTS_TEXT_TABLE . " pt
		WHERE p.topic_id = $topic_id
			$sql_download
			AND pt.post_id = p.post_id
			AND u.user_id = p.poster_id
			ORDER BY p.post_time ASC, p.post_id ASC";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Could not create download stream for post.", '', __LINE__, __FILE__, $sql);
	}

	$download_file = '';
	while ( $row = $db->sql_fetchrow($result) )
	{
		$poster_id = $row['user_id'];
		$poster = ( $poster_id == ANONYMOUS ) ? $lang['Guest'] : $row['username'];

		$post_date = create_date($board_config['default_dateformat'], $row['post_time'], $board_config['board_timezone']);

		$post_subject = ( $row['post_subject'] != '' ) ? $row['post_subject'] : '';

		$bbcode_uid = $row['bbcode_uid'];
		$message = $row['post_text'];

		$message = strip_tags($message);
		$message = preg_replace("/\[.*?:$bbcode_uid:?.*?\]/si", '', $message);
		$message = preg_replace('/\[url\]|\[\/url\]/si', '', $message);
		$message = preg_replace('/\:[0-9a-z\:]+\]/si', ']', $message);

		$message = unprepare_message($message);
		$message = preg_replace('/&#40;/', '(', $message);
		$message = preg_replace('/&#41;/', ')', $message);
		$message = preg_replace('/&#58;/', ':', $message);

		if (count($orig_word))
		{
			$post_subject = preg_replace($orig_word, $replacement_word, $post_subject);

			$message = str_replace('\"', '"', substr(preg_replace_callback('#(\>(((? >([^><]+|(?R)))*)\<))#s', function ($matches) use ($orig_word, $replacement_word) {
				return preg_replace($orig_word, $replacement_word, $matches[0]);
			}, '>' . $message . '<'), 1, -1));
		}

		$break = "\n";
		$line = '-----------------------------------';
		$download_file .= $break.$line.$break.$poster.$break.$post_date.$break.$break.$post_subject.$break.$line.$break.$message.$break;
	}

	$disp_folder = ( $download == -1 ) ? 'Topic_'.$topic_id : 'Post_'.$download;
	$filename = $board_config['sitename']."_".$disp_folder."_".date("Ymd",time()).".txt";
	header('Content-Type: text/x-delimtext; name="'.$filename.'"');
	header('Content-Disposition: attachment;filename='.$filename);
	header('Content-Transfer-Encoding: plain/text');
	header('Content-Length: '.strlen($download_file));
	print $download_file;

	exit;
}

//-- mod : keep unread -----------------------------------------------------------------------------
//-- add
// ok, let's simplify all of this by initiating the session
// first get the forum id
if ( !empty($post_id) )
{
	$sql = "SELECT t.forum_id, t.topic_id
				FROM " . TOPICS_TABLE . " t, " . POSTS_TABLE . " p
				WHERE t.topic_id = p.topic_id
					AND t.topic_moved_id = 0
					AND p.post_id = $post_id";
}
else if ( !empty($topic_id) )
{
	$sql = "SELECT t.forum_id, t.topic_id
				FROM " . TOPICS_TABLE . " t
				WHERE t.topic_moved_id = 0
					AND t.topic_id = $topic_id";
}
else
{
	message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');
}
if ( !$result = $db->sql_query($sql) )
{
	message_die(GENERAL_ERROR, 'Could not obtain topic information', '', __LINE__, __FILE__, $sql);
}
if ( !$row = $db->sql_fetchrow($result) )
{
	message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');
}
$forum_id = $row['forum_id'];
$topic_id = $row['topic_id'];

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
					} else {
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
//
// Set or remove bookmark
//
if ( isset($_GET['setbm']) || isset($_GET['removebm']) )
{
	$redirect = "viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&start=$start&postdays=$post_days&postorder=$post_order&highlight=" . $_GET['highlight'];
	if ( $userdata['session_logged_in'] )
	{
		if (isset($_GET['setbm']) && $_GET['setbm'])
		{
			set_bookmark($topic_id);
		}
		else if (isset($_GET['removebm']) && $_GET['removebm'])
		{
			remove_bookmark($topic_id);
		}
	}
	else
	{
		if (isset($_GET['setbm']) && $_GET['setbm'])
		{
			$redirect .= '&setbm=true';
		}
		else if (isset($_GET['removebm']) && $_GET['removebm'])
		{
			$redirect .= '&removebm=true';
		}
		redirect(append_sid("login.$phpEx?redirect=$redirect", true));
	}
	redirect(append_sid($redirect, true));
}

if(!file_exists(@phpbb_realpath($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_printertopic.'.$phpEx)))
{
	include($phpbb_root_path . 'language/lang_english/lang_printertopic.' . $phpEx);
} else
{
	include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_printertopic.' . $phpEx);
}

include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_viewtopic.' . $phpEx);

// get last visit for guest
if ( !$userdata['session_logged_in'] )
{
	$userdata['user_lastvisit'] = $board_config['guest_lastvisit'];
}

// get the last time the user visited the topic
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
//-- fin mod : keep unread -------------------------------------------------------------------------

//
// Find topic id if user requested a newer
// or older topic
//
if ( isset($_GET['view']) && empty($_GET[POST_POST_URL]) )
{
	if ( $_GET['view'] == 'newest' )
	{
//-- mod : keep unread -----------------------------------------------------------------------------
//-- delete
//		if ( isset($_COOKIE[$board_config['cookie_name'] . '_sid']) || isset($_GET['sid']) )
//		{
//			$session_id = isset($_COOKIE[$board_config['cookie_name'] . '_sid']) ? $_COOKIE[$board_config['cookie_name'] . '_sid'] : $_GET['sid'];
//
//			if ( $session_id )
//			{
//				$sql = "SELECT p.post_id
//					FROM " . POSTS_TABLE . " p, " . SESSIONS_TABLE . " s,  " . USERS_TABLE . " u
//					WHERE s.session_id = '$session_id'
//						AND u.user_id = s.session_user_id
//						AND p.topic_id = $topic_id
//						AND p.post_time >= u.user_lastvisit
//					ORDER BY p.post_time ASC
//					LIMIT 1";
//				if ( !($result = $db->sql_query($sql)) )
//				{
//					message_die(GENERAL_ERROR, 'Could not obtain newer/older topic information', '', __LINE__, __FILE__, $sql);
//				}
//
//				if ( !($row = $db->sql_fetchrow($result)) )
//				{
//					message_die(GENERAL_MESSAGE, 'No_new_posts_last_visit');
//				}
//
//				$post_id = $row['post_id'];
//
//				if (isset($_GET['sid']))
//				{
//					redirect("viewtopic.$phpEx?sid=$session_id&" . POST_POST_URL . "=$post_id#$post_id");
//				}
//				else
//				{
//					redirect("viewtopic.$phpEx?" . POST_POST_URL . "=$post_id#$post_id");
//				}
//			}
//		}
//
//		redirect(append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id", true));
//-- add
		// read the first unread post in this topic
		$sql = "SELECT p.post_id, t.topic_last_post_id
					FROM (" . TOPICS_TABLE . " t
						LEFT JOIN " . POSTS_TABLE . " p ON p.topic_id = t.topic_id AND p.post_time > $topic_last_read)
					WHERE t.topic_id = $topic_id
						AND t.topic_moved_id = 0
					ORDER BY p.post_time";
		if ( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain newer/older topic information', '', __LINE__, __FILE__, $sql);
		}
		if ( !$row = $db->sql_fetchrow($result) )
		{
			message_die(GENERAL_MESSAGE, 'No_new_posts_last_visit');
		}
		$post_id = empty($row['post_id']) ? $row['topic_last_post_id'] : $row['post_id'];
		redirect(append_sid("./viewtopic.$phpEx?" . POST_POST_URL . "=$post_id#$post_id", true));
//-- fin mod : keep unread -------------------------------------------------------------------------
	}
	else if ( $_GET['view'] == 'next' || $_GET['view'] == 'previous' )
	{
		$sql_condition = ( $_GET['view'] == 'next' ) ? '>' : '<';
		$sql_ordering = ( $_GET['view'] == 'next' ) ? 'ASC' : 'DESC';

		$sql = "SELECT t.topic_id
			FROM " . TOPICS_TABLE . " t, " . TOPICS_TABLE . " t2
			WHERE
				t2.topic_id = $topic_id
				AND t.forum_id = t2.forum_id
				AND t.topic_moved_id = 0
				AND t.topic_last_post_id $sql_condition t2.topic_last_post_id
			ORDER BY t.topic_last_post_id $sql_ordering
			LIMIT 1";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, "Could not obtain newer/older topic information", '', __LINE__, __FILE__, $sql);
		}

		if ( $row = $db->sql_fetchrow($result) )
		{
			$topic_id = intval($row['topic_id']);
//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
			redirect( "./viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id" );
//-- fin mod : categories hierarchy ----------------------------------------------------------------
		}
		else
		{
			$message = ( $_GET['view'] == 'next' ) ? 'No_newer_topics' : 'No_older_topics';
			message_die(GENERAL_MESSAGE, $message);
		}
	}
}

//
// This rather complex gaggle of code handles querying for topics but
// also allows for direct linking to a post (and the calculation of which
// page the post is on and the correct display of viewtopic)
//
$join_sql_table = (!$post_id) ? '' : ", " . POSTS_TABLE . " p, " . POSTS_TABLE . " p2 ";
$join_sql = (!$post_id) ? "t.topic_id = $topic_id" : "p.post_id = $post_id AND t.topic_id = p.topic_id AND p2.topic_id = p.topic_id AND p2.post_id <= $post_id";
$count_sql = (!$post_id) ? '' : ", COUNT(p2.post_id) AS prev_posts";

$order_sql = (!$post_id) ? '' : "GROUP BY p.post_id, t.topic_id, t.topic_title, t.topic_status, t.topic_replies, t.topic_time, t.topic_type, t.topic_vote, t.topic_last_post_id, f.forum_name, f.forum_status, f.forum_id, f.auth_view, f.auth_read, f.auth_post, f.auth_reply, f.auth_edit, f.auth_delete, f.auth_sticky, f.auth_announce, f.auth_pollcreate, f.auth_vote, f.auth_attachments, f.auth_delayedpost, f.auth_ban, f.auth_greencard, f.auth_bluecard ORDER BY p.post_id ASC";

//-- mod : calendar --------------------------------------------------------------------------------
// here we added
//	, t.topic_first_post_id, t.topic_calendar_time, t.topic_calendar_duration
//-- modify
$sql = "SELECT t.topic_id, t.topic_title, t.topic_info, t.topic_status, t.topic_replies, t.topic_time, t.topic_type, t.topic_vote, t.topic_last_post_id, t.topic_first_post_id, t.topic_calendar_time, t.topic_calendar_duration, f.forum_name, f.forum_status, f.forum_id, f.auth_view, f.auth_read, f.auth_post, f.auth_reply, f.auth_edit, f.auth_delete, f.auth_sticky, f.auth_announce, f.auth_pollcreate, f.auth_vote, f.auth_attachments, f.auth_delayedpost, f.auth_ban, f.auth_greencard, f.auth_bluecard" . $count_sql . "
	FROM " . TOPICS_TABLE . " t, " . FORUMS_TABLE . " f" . $join_sql_table . "
	WHERE $join_sql
		AND f.forum_id = t.forum_id
		$order_sql";
//-- fin mod : calendar ----------------------------------------------------------------------------
attach_setup_viewtopic_auth($order_sql, $sql);
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, "Could not obtain topic information", '', __LINE__, __FILE__, $sql);
}

if ( !($forum_topic_data = $db->sql_fetchrow($result)) )
{
	message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');
}

$forum_id = intval($forum_topic_data['forum_id']);

//
// Start session management
//
//-- mod : keep unread -----------------------------------------------------------------------------
//-- delete
// $userdata = session_pagestart($user_ip, $forum_id);
// init_userprefs($userdata);
//-- fin mod : keep unread -------------------------------------------------------------------------
//
// End session management
//

//
// Start auth check
//
$is_auth = array();
//-- mod : categories hierarchy --------------------------------------------------------------------
//-- delete
// $is_auth = auth(AUTH_ALL, $forum_id, $userdata, $forum_topic_data);
//
// if( !$is_auth['auth_view'] || !$is_auth['auth_read'] )
//-- add
$is_auth = $tree['auth'][POST_FORUM_URL . $forum_id];

if ( !$is_auth['auth_read'] )
//-- fin mod : categories hierarchy ----------------------------------------------------------------
{
	if ( !$userdata['session_logged_in'] )
	{
		$redirect = ($post_id) ? POST_POST_URL . "=$post_id" : POST_TOPIC_URL . "=$topic_id";
		$redirect .= ($start) ? "&start=$start" : '';
		redirect(append_sid("login.$phpEx?redirect=viewtopic.$phpEx&$redirect", true));
	}

//-- mod : categories hierarchy --------------------------------------------------------------------
//-- delete
//	$message = ( !$is_auth['auth_view'] ) ? $lang['Topic_post_not_exist'] : sprintf($lang['Sorry_auth_read'], $is_auth['auth_read_type']);
	$message .= "<br><br>" . sprintf($lang['Click_return_subscribe_lw'], "<a href=lwtopup.$phpEx>", "</a>" );
//-- add
	$message = sprintf($lang['Sorry_auth_read'], $is_auth['auth_read_type']);
//-- fin mod : categories hierarchy ----------------------------------------------------------------

	message_die(GENERAL_MESSAGE, $message);
}
//
// End auth check
//

//-- mod : categories hierarchy --------------------------------------------------------------------
//-- delete
// $forum_name = $forum_topic_data['forum_name'];
//-- add
$forum_name = get_object_lang(POST_FORUM_URL . $forum_topic_data['forum_id'], 'name');
$topic_forum_id = $forum_topic_data['forum_id'];
$topic_topic_title = $forum_topic_data['topic_title'];
//-- fin mod : categories hierarchy ----------------------------------------------------------------

$topic_title = $forum_topic_data['topic_title'];
$topic_info = $forum_topic_data['topic_info'];
$topic_id = intval($forum_topic_data['topic_id']);
$topic_time = $forum_topic_data['topic_time'];
//-- mod : calendar --------------------------------------------------------------------------------
//-- add
$topic_first_post_id = intval($forum_topic_data['topic_first_post_id']);
$topic_calendar_time = intval($forum_topic_data['topic_calendar_time']);
$topic_calendar_duration = intval($forum_topic_data['topic_calendar_duration']);
//-- fin mod : calendar ----------------------------------------------------------------------------

if ($post_id)
{
	$start = floor(($forum_topic_data['prev_posts'] - 1) / intval($board_config['posts_per_page'])) * intval($board_config['posts_per_page']);
}

//
// Is user watching this thread?
//
if( $userdata['session_logged_in'] )
{
	$can_watch_topic = TRUE;

	$sql = "SELECT notify_status
		FROM " . TOPICS_WATCH_TABLE . "
		WHERE topic_id = $topic_id
			AND user_id = " . $userdata['user_id'];
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Could not obtain topic watch information", '', __LINE__, __FILE__, $sql);
	}

	if ( $row = $db->sql_fetchrow($result) )
	{
		if ( isset($_GET['unwatch']) )
		{
			if ( $_GET['unwatch'] == 'topic' )
			{
				$is_watching_topic = 0;

				$sql_priority = (SQL_LAYER == "mysql") ? "LOW_PRIORITY" : '';
				$sql = "DELETE $sql_priority FROM " . TOPICS_WATCH_TABLE . "
					WHERE topic_id = $topic_id
						AND user_id = " . $userdata['user_id'];
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, "Could not delete topic watch information", '', __LINE__, __FILE__, $sql);
				}
			}

			$template->assign_vars(array(
				'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;start=$start") . '">')
			);

			$message = $lang['No_longer_watching'] . '<br /><br />' . sprintf($lang['Click_return_topic'], '<a href="' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;start=$start") . '">', '</a>');
			message_die(GENERAL_MESSAGE, $message);
		}
		else
		{
			$is_watching_topic = TRUE;

			if ( $row['notify_status'] )
			{
				$sql_priority = (SQL_LAYER == "mysql") ? "LOW_PRIORITY" : '';
				$sql = "UPDATE $sql_priority " . TOPICS_WATCH_TABLE . "
					SET notify_status = 0
					WHERE topic_id = $topic_id
						AND user_id = " . $userdata['user_id'];
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, "Could not update topic watch information", '', __LINE__, __FILE__, $sql);
				}
			}
		}
	}
	else
	{
		if ( isset($_GET['watch']) )
		{
			if ( $_GET['watch'] == 'topic' )
			{
				$is_watching_topic = TRUE;

				$sql_priority = (SQL_LAYER == "mysql") ? "LOW_PRIORITY" : '';
				$sql = "INSERT $sql_priority INTO " . TOPICS_WATCH_TABLE . " (user_id, topic_id, notify_status)
					VALUES (" . $userdata['user_id'] . ", $topic_id, 0)";
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, "Could not insert topic watch information", '', __LINE__, __FILE__, $sql);
				}
			}

			$template->assign_vars(array(
				'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;start=$start") . '">')
			);

			$message = $lang['You_are_watching'] . '<br /><br />' . sprintf($lang['Click_return_topic'], '<a href="' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;start=$start") . '">', '</a>');
			message_die(GENERAL_MESSAGE, $message);
		}
		else
		{
			$is_watching_topic = 0;
		}
	}
}
else
{
	if ( isset($_GET['unwatch']) )
	{
		if ( $_GET['unwatch'] == 'topic' )
		{
			redirect(append_sid("login.$phpEx?redirect=viewtopic.$phpEx&" . POST_TOPIC_URL . "=$topic_id&unwatch=topic", true));
		}
	}
	else
	{
		$can_watch_topic = 0;
		$is_watching_topic = 0;
	}
}

//
// Generate a 'Show posts in previous x days' select box. If the postdays var is POSTed
// then get it's value, find the number of topics with dates newer than it (to properly
// handle pagination) and alter the main query
//
$previous_days = array(0, 1, 7, 14, 30, 90, 180, 364);
$previous_days_text = array($lang['All_Posts'], $lang['1_Day'], $lang['7_Days'], $lang['2_Weeks'], $lang['1_Month'], $lang['3_Months'], $lang['6_Months'], $lang['1_Year']);

if( !empty($_POST['postdays']) || !empty($_GET['postdays']) )
{
	$post_days = ( !empty($_POST['postdays']) ) ? intval($_POST['postdays']) : intval($_GET['postdays']);
	$min_post_time = time() - (intval($post_days) * 86400);

	$sql = "SELECT COUNT(p.post_id) AS num_posts
		FROM " . TOPICS_TABLE . " t, " . POSTS_TABLE . " p
		WHERE t.topic_id = $topic_id
			AND p.topic_id = t.topic_id
			AND p.post_time >= $min_post_time";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Could not obtain limited topics count information", '', __LINE__, __FILE__, $sql);
	}

	$total_replies = ( $row = $db->sql_fetchrow($result) ) ? intval($row['num_posts']) : 0;

	$limit_posts_time = "AND p.post_time >= $min_post_time ";

	if ( !empty($_POST['postdays']))
	{
		$start = 0;
	}
}
else
{
	$total_replies = intval($forum_topic_data['topic_replies']) + 1;

	$limit_posts_time = '';
	$post_days = 0;
}

$select_post_days = '<select name="postdays">';
for($i = 0; $i < count($previous_days); $i++)
{
	$selected = ($post_days == $previous_days[$i]) ? ' selected="selected"' : '';
	$select_post_days .= '<option value="' . $previous_days[$i] . '"' . $selected . '>' . $previous_days_text[$i] . '</option>';
}
$select_post_days .= '</select>';

//
// Decide how to order the post display
//
if ( !empty($_POST['postorder']) || !empty($_GET['postorder']) )
{
   $post_order = (!empty($_POST['postorder'])) ? htmlspecialchars($_POST['postorder']) : htmlspecialchars($_GET['postorder']);
   $post_time_order = ($post_order == "asc") ? "ASC" : "DESC";
}
else
{
   $post_order = 'asc';
   $post_time_order = 'ASC';
} 

$select_post_order = '<select name="postorder">';
if ( $post_time_order == 'ASC' )
{
	$select_post_order .= '<option value="asc" selected="selected">' . $lang['Oldest_First'] . '</option><option value="desc">' . $lang['Newest_First'] . '</option>';
}
else
{
	$select_post_order .= '<option value="asc">' . $lang['Oldest_First'] . '</option><option value="desc" selected="selected">' . $lang['Newest_First'] . '</option>';
}
$select_post_order .= '</select>';

//
// Go ahead and pull all data for this topic
//
//-- mod : profile cp ------------------------------------------------------------------------------
//-- delete
// $sql = "SELECT u.username, u.user_id, u.user_posts, u.user_from, u.user_website, u.user_email, u.user_icq, u.user_aim, u.user_yim, u.user_regdate, u.user_msnm, u.user_viewemail, u.user_rank, u.user_sig, u.user_sig_bbcode_uid, u.user_avatar, u.user_avatar_type, u.user_allowavatar, u.user_allowsmile, u.ct_miserable_user, p.*,  pt.post_text, pt.post_subject, pt.bbcode_uid
//-- add
$sql = "SELECT u.*, p.*,  pt.post_text, pt.post_subject, pt.bbcode_uid 
    FROM " . POSTS_TABLE . " p, " . USERS_TABLE . " u, " . POSTS_TEXT_TABLE . " pt 
    WHERE p.topic_id = $topic_id 
        $limit_posts_time 
        AND pt.post_id = p.post_id 
        AND u.user_id = p.poster_id 
    ORDER BY p.post_time $post_time_order, p.post_id 
    LIMIT $start, ".(isset($finish)? ((($finish - $start) > 0)? ($finish - $start): -$finish): $board_config['posts_per_page']);
	$cm_viewtopic->generate_columns($template,$forum_id,$sql);
//-- fin mod : profile cp --------------------------------------------------------------------------
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, "Could not obtain post/user information.", '', __LINE__, __FILE__, $sql);
}

//-- mod : profile cp ------------------------------------------------------------------------------
//-- add
//-- fin mod : profile cp --------------------------------------------------------------------------

$postrow = array();
if ($row = $db->sql_fetchrow($result))
{
	do
	{
		$postrow[] = $row;

	}
	while ($row = $db->sql_fetchrow($result));
	$db->sql_freeresult($result);

	$total_posts = count($postrow);
}
else 
{ 
   include($phpbb_root_path . 'includes/functions_admin.' . $phpEx); 
   sync('topic', $topic_id); 

   message_die(GENERAL_MESSAGE, $lang['No_posts_topic']); 
} 

$resync = FALSE; 
if ($forum_topic_data['topic_replies'] + 1 < $start + count($postrow)) 
{ 
   $resync = TRUE; 
} 
elseif ($start + $board_config['posts_per_page'] > $forum_topic_data['topic_replies']) 
{ 
   $row_id = intval($forum_topic_data['topic_replies']) % intval($board_config['posts_per_page']); 
   if ($postrow[$row_id]['post_id'] != $forum_topic_data['topic_last_post_id'] || $start + count($postrow) < $forum_topic_data['topic_replies']) 
   { 
      $resync = TRUE; 
   } 
} 
elseif (count($postrow) < $board_config['posts_per_page']) 
{ 
   $resync = TRUE; 
} 

if ($resync) 
{ 
   include($phpbb_root_path . 'includes/functions_admin.' . $phpEx); 
   sync('topic', $topic_id); 

   $result = $db->sql_query('SELECT COUNT(post_id) AS total FROM ' . POSTS_TABLE . ' WHERE topic_id = ' . $topic_id); 
   $row = $db->sql_fetchrow($result); 
   $total_replies = $row['total']; 
}

//-- mod : profile cp ------------------------------------------------------------------------------
//-- delete
// $sql = "SELECT *
//	FROM " . RANKS_TABLE . "
//	ORDER BY rank_special, rank_min";
// if ( !($result = $db->sql_query($sql)) )
// {
//	message_die(GENERAL_ERROR, "Could not obtain ranks information.", '', __LINE__, __FILE__, $sql);
// }
//
// $ranksrow = array();
// while ( $row = $db->sql_fetchrow($result) )
// {
//	$ranksrow[] = $row;
// }
// $db->sql_freeresult($result);
//-- fin mod : profile cp --------------------------------------------------------------------------

//
// Define censored word matches
//
$orig_word = array();
$replacement_word = array();
obtain_word_list($orig_word, $replacement_word);

//
// Censor topic title
//
if ( count($orig_word) )
{
	$topic_title = preg_replace($orig_word, $replacement_word, $topic_title);
}

//
// Was a highlight request part of the URI?
//
$highlight_match = $highlight = '';
if (isset($_GET['highlight']))
{
	// Split words and phrases   
	$words = explode(' ', trim(htmlspecialchars($_GET['highlight'])));

	for($i = 0; $i < sizeof($words); $i++)
	{
		if (trim($words[$i]) != '')
		{
			$highlight_match .= (($highlight_match != '') ? '|' : '') . str_replace('*', '\w*', preg_quote($words[$i], '#'));
		}
	}
	unset($words);

	$highlight = urlencode($_GET['highlight']);
	$highlight_match = phpbb_rtrim($highlight_match, "\\");
}

//
// Post, reply and other URL generation for
// templating vars
//
$printer_topic_url = append_sid("viewtopic.$phpEx?printertopic=1&" . POST_TOPIC_URL . "=$topic_id&start=$start&postdays=$post_days&postorder=$post_order&vote=viewresult");
$new_topic_url = append_sid("posting.$phpEx?mode=newtopic&amp;" . POST_FORUM_URL . "=$forum_id");
$reply_topic_url = append_sid("posting.$phpEx?mode=reply&amp;" . POST_TOPIC_URL . "=$topic_id");
$view_forum_url = append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id");
/* Hide Buttons :: Altered
$view_prev_topic_url = append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;view=previous");
$view_next_topic_url = append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;view=next");*/
// Hide Buttons :: Added :: Start
$sql = "SELECT this.topic_id AS thistopic 
                         , next.topic_id AS nexttopic 
                         , prev.topic_id AS prevtopic 
                    FROM " . TOPICS_TABLE . " this 
         LEFT JOIN " . TOPICS_TABLE . " next 
                        ON ( next.forum_id = this.forum_id 
                         AND next.topic_last_post_id > this.topic_last_post_id ) 
         LEFT JOIN " . TOPICS_TABLE . " prev 
                        ON ( prev.forum_id = this.forum_id 
                         AND prev.topic_last_post_id < this.topic_last_post_id ) 
                 WHERE this.topic_id = $topic_id 
            ORDER BY next.topic_last_post_id ASC 
                         , prev.topic_last_post_id DESC 
                 LIMIT 1"; 
if ( !($result = $db->sql_query($sql)) ){ 
    message_die(GENERAL_ERROR, "Could not obtain newer/older topic information", '', __LINE__, __FILE__, $sql); 
} 
if ( $row = $db->sql_fetchrow($result) ){ 
    if($row['prevtopic']){ 
        $view_prev_topic_url = append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=".$row['prevtopic']); 
        $previmg = 'topic_previous'; 
				// Mozilla navigation bar
				$nav_links['prev'] = array(
					'url' => $view_prev_topic_url,
					'title' => $lang['View_previous_topic']
				);
    } else { 
        $view_prev_topic_url = 'javascript:void();'; 
        $previmg = 'topic_previous_no'; 
    } 
    if($row['nexttopic']){ 
        $view_next_topic_url = append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=".$row['nexttopic']); 
        $nextimg = 'topic_next'; 
				// Mozilla navigation bar
				$nav_links['next'] = array(
					'url' => $view_next_topic_url,
					'title' => $lang['View_next_topic']
				);
    } else { 
        $view_next_topic_url = 'javascript:void();'; 
        $nextimg = 'topic_next_no'; 
    } 
} else { 
    // no next and no prev? 
    $view_prev_topic_url = 'javascript:void();'; 
    $view_next_topic_url = 'javascript:void();'; 
    $previmg = 'topic_previous_no'; 
        $nextimg = 'topic_next_no'; 
}
// Hide Buttons :: Added :: End

//
// Mozilla navigation bar
//
$nav_links['up'] = array(
	'url' => $view_forum_url,
	'title' => $forum_name
);

$reply_img = ( $forum_topic_data['forum_status'] == FORUM_LOCKED || $forum_topic_data['topic_status'] == TOPIC_LOCKED ) ? $images['reply_locked'] : $images['reply_new'];
$reply_alt = ( $forum_topic_data['forum_status'] == FORUM_LOCKED || $forum_topic_data['topic_status'] == TOPIC_LOCKED ) ? $lang['Button_locked'] : $lang['Reply_to_topic'];
$reply_title = ( $forum_topic_data['forum_status'] == FORUM_LOCKED || $forum_topic_data['topic_status'] == TOPIC_LOCKED ) ? $lang['Topic_locked'] : $lang['Reply_to_topic'];
$post_img = ( $forum_topic_data['forum_status'] == FORUM_LOCKED ) ? $images['post_locked'] : $images['post_new'];
$post_alt = ( $forum_topic_data['forum_status'] == FORUM_LOCKED ) ? $lang['Forum_locked'] : $lang['Post_new_topic'];

//
// Set a cookie for this topic
//
//-- mod : keep unread -----------------------------------------------------------------------------
//-- delete
// if ( $userdata['session_logged_in'] )
// {
//	$tracking_topics = ( isset($_COOKIE[$board_config['cookie_name'] . '_t']) ) ? unserialize($_COOKIE[$board_config['cookie_name'] . '_t']) : array();
//	$tracking_forums = ( isset($_COOKIE[$board_config['cookie_name'] . '_f']) ) ? unserialize($_COOKIE[$board_config['cookie_name'] . '_f']) : array();
//
//	if ( !empty($tracking_topics[$topic_id]) && !empty($tracking_forums[$forum_id]) )
//	{
//		$topic_last_read = ( $tracking_topics[$topic_id] > $tracking_forums[$forum_id] ) ? $tracking_topics[$topic_id] : $tracking_forums[$forum_id];
//	}
//	else if ( !empty($tracking_topics[$topic_id]) || !empty($tracking_forums[$forum_id]) )
//	{
//		$topic_last_read = ( !empty($tracking_topics[$topic_id]) ) ? $tracking_topics[$topic_id] : $tracking_forums[$forum_id];
//	}
//	else
//	{
//		$topic_last_read = $userdata['user_lastvisit'];
//	}
//
//	if ( count($tracking_topics) >= 150 && empty($tracking_topics[$topic_id]) )
//	{
//		asort($tracking_topics);
//		unset($tracking_topics[key($tracking_topics)]);
//	}
//
//	$tracking_topics[$topic_id] = time();
//
//	setcookie($board_config['cookie_name'] . '_t', serialize($tracking_topics), 0, $board_config['cookie_path'], $board_config['cookie_domain'], $board_config['cookie_secure']);
// }
//-- add
// clean some cookies
if ( !empty($board_config['tracking_all']) && isset($board_config['tracking_forums'][$forum_id]) && ($board_config['tracking_all'] >= $board_config['tracking_forums'][$forum_id]) )
{
	unset($board_config['tracking_forums'][$forum_id]);
}
if ( isset($board_config['tracking_unreads'][$topic_id]) )
{
	unset($board_config['tracking_unreads'][$topic_id]);
}

// add a cookie for this topic
$board_config['tracking_topics'][$topic_id] = time();

// except the cookies
write_cookies($userdata);
//-- fin mod : keep unread -------------------------------------------------------------------------

//
// Load templates
//
if(isset($_GET['printertopic']))
{
	$template->set_filenames(array(
		'body' => 'printertopic_body.tpl')
	);
} else
{
	$template->set_filenames(array(
		'body' => 'viewtopic_body.tpl')
	);
}
make_jumpbox('viewforum.'.$phpEx, $forum_id);

//
// Output page header
//
//Begin Lo-Fi Mod
$page_title = $topic_title;
//End Lo-Fi Mod
if(isset($_GET['printertopic']))
{
	include($phpbb_root_path . 'includes/page_header_printer.'.$phpEx);
} else
{
	include($phpbb_root_path . 'includes/page_header.'.$phpEx);
	//-- mod : sub-template ----------------------------------------------------------------------------
	//-- add
	$reply_img = ( $forum_topic_data['forum_status'] == FORUM_LOCKED || $forum_topic_data['topic_status'] == TOPIC_LOCKED ) ? $images['reply_locked'] : $images['reply_new'];
	$post_img = ( $forum_topic_data['forum_status'] == FORUM_LOCKED ) ? $images['post_locked'] : $images['post_new'];
	//-- fin mod : sub-template ------------------------------------------------------------------------
}

//Parse smilies to display topic title
$topic_title2 = $topic_title;
$topic_title = smilies_pass($topic_title);

//
// User authorisation levels output
//
$s_auth_can = ( ( $is_auth['auth_post'] ) ? $lang['Rules_post_can'] : $lang['Rules_post_cannot'] ) . '<br />';
$s_auth_can .= ( ( $is_auth['auth_reply'] ) ? $lang['Rules_reply_can'] : $lang['Rules_reply_cannot'] ) . '<br />';
$s_auth_can .= ( ( $is_auth['auth_edit'] ) ? $lang['Rules_edit_can'] : $lang['Rules_edit_cannot'] ) . '<br />';
$s_auth_can .= ( ( $is_auth['auth_delete'] ) ? $lang['Rules_delete_can'] : $lang['Rules_delete_cannot'] ) . '<br />';
$s_auth_can .= ( ( $is_auth['auth_vote'] ) ? $lang['Rules_vote_can'] : $lang['Rules_vote_cannot'] ) . '<br />';
$s_auth_can .= ( $is_auth['auth_ban'] ) ? $lang['Rules_ban_can'] . "<br />" : ""; 
$s_auth_can .= ( $is_auth['auth_greencard'] ) ? $lang['Rules_greencard_can'] . "<br />" : ""; 
$s_auth_can .= ( $is_auth['auth_bluecard'] ) ? $lang['Rules_bluecard_can'] . "<br />" : "";
attach_build_auth_levels($is_auth, $s_auth_can);

$topic_mod = '';

//Begin Lo-Fi Mod
if ( $is_auth['auth_mod'] )
{
	$s_auth_can .= sprintf($lang['Rules_moderate'], '<a href="' . append_sid("modcp.$phpEx?" . POST_FORUM_URL . "=$forum_id&amp;p_sid=" . $userdata['priv_session_id']) . '">', '</a>');
	if ($lofi)
	{


		$topic_mod .= '<a href="' . append_sid("modcp.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;mode=delete&amp;p_sid=" . $userdata['priv_session_id']) . '"title="' . $lang['Delete_topic'] . '">' . $lang['Delete_topic'] . '</a>&nbsp;';

		$topic_mod .= '<a href="' . append_sid("modcp.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;mode=move&amp;p_sid=" . $userdata['priv_session_id']) . '" title="' . $lang['Move_topic'] . '">' . $lang['Move_topic'] . '</a>&nbsp;';

		$topic_mod .= ( $forum_topic_data['topic_status'] == TOPIC_UNLOCKED ) ? '<a href="' . append_sid("modcp.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;mode=lock&amp;p_sid=" . $userdata['priv_session_id']) . '" title="' . $lang['Lock_topic'] . '">' . $lang['Lock_topic'] . '</a>&nbsp;' : '<a href="' . append_sid("modcp.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;mode=unlock&amp;p_sid=" . $userdata['priv_session_id']) . '" title="' . $lang['Unlock_topic'] . '">' . $lang['Unlock_topic'] . '</a>&nbsp;::&nbsp;';

		$topic_mod .= '<a href="' . append_sid("modcp.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;mode=split&amp;p_sid=" . $userdata['priv_session_id']) . '" title="' . $lang['Split_topic'] . '">' . $lang['Split_topic'] . '</a>&nbsp;';

		$topic_mod .= '<a href="' . append_sid("merge.$phpEx?" . POST_TOPIC_URL . '=' . $topic_id) . '" title="' . $lang['Merge_topics'] . '" border="0" />' . $lang['Merge_topics'] . '</a>&nbsp;';
	}
	else
	{
		$topic_mod .= '<a class="noi fa fa-times fa-2x" href="' . append_sid("modcp.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;mode=delete&amp;p_sid=" . $userdata['priv_session_id']) . '" title="' . $lang['Delete_topic'] . '"><img src="' . $images['topic_mod_delete'] . '" alt="' . $lang['Delete_topic'] . '" border="0" /></a>&nbsp;';

		$topic_mod .= '<a class="noi fa fa-share fa-2x" href="' . append_sid("modcp.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;mode=move&amp;p_sid=" . $userdata['priv_session_id']) . '" title="' . $lang['Move_topic'] . '"><img src="' . $images['topic_mod_move'] . '" alt="' . $lang['Move_topic'] . '" border="0" /></a>&nbsp;';

		$topic_mod .= ( $forum_topic_data['topic_status'] == TOPIC_UNLOCKED ) ? '<a class="noi fa fa-lock fa-2x" href="' . append_sid("modcp.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;mode=lock&amp;p_sid=" . $userdata['priv_session_id']) . '" title="' . $lang['Lock_topic'] . '"><img src="' . $images['topic_mod_lock'] . '" alt="' . $lang['Lock_topic'] . '" border="0" /></a>&nbsp;' : '<a class="noi fa fa-unlock fa-2x" href="' . append_sid("modcp.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;mode=unlock&amp;p_sid=" . $userdata['priv_session_id']) . '" title="' . $lang['Unlock_topic'] . '"><img src="' . $images['topic_mod_unlock'] . '" alt="' . $lang['Unlock_topic'] . '" border="0" /></a>&nbsp;';

		$topic_mod .= '&nbsp;<a class="noi fa fa-sort fa-rotate-90 fa-2x" href="' . append_sid("modcp.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;mode=split&amp;p_sid=" . $userdata['priv_session_id']) . '" title="' . $lang['Split_topic'] . '"><img src="' . $images['topic_mod_split'] . '" alt="' . $lang['Split_topic'] . '" border="0" /></a>&nbsp;';

		$topic_mod .= '<a class="noi fa fa-clone fa-2x" href="' . append_sid("merge.$phpEx?" . POST_TOPIC_URL . '=' . $topic_id) . '" title="' . $lang['Merge_topics'] . '"><img src="' . $images['topic_mod_merge'] . '" alt="' . $lang['Merge_topics'] . '" border="0" /></a>&nbsp;';
	}
}
//End Lo-Fi Mod

//
// Topic watch information
//
$s_watching_topic = '';
if ( $can_watch_topic )
{
	if ( $is_watching_topic )
	{
		$s_watching_topic = "<a href=\"viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;unwatch=topic&amp;start=$start&amp;sid=" . $userdata['session_id'] . '">' . $lang['Stop_watching_topic'] . '</a>';
		$s_watching_topic_img = ( isset($images['topic_un_watch']) ) ? "<a class=\"noi fa-twatch\" href=\"viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;unwatch=topic&amp;start=$start&amp;sid=" . $userdata['session_id'] . '" title="' . $lang['Stop_watching_topic'] . '"><img src="' . $images['topic_un_watch'] . '" alt="' . $lang['Stop_watching_topic'] . '" border="0"></a>' : '';
	}
	else
	{
		$s_watching_topic = "<a href=\"viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;watch=topic&amp;start=$start&amp;sid=" . $userdata['session_id'] . '">' . $lang['Start_watching_topic'] . '</a>';
		$s_watching_topic_img = ( isset($images['topic_watch']) ) ? "<a class=\"noi fa-twatch\" href=\"viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;watch=topic&amp;start=$start&amp;sid=" . $userdata['session_id'] . '" title="' . $lang['Start_watching_topic'] . '"><img src="' . $images['topic_watch'] . '" alt="' . $lang['Start_watching_topic'] . '" border="0"></a>' : '';
	}
}

//
// Bookmark information
//
if ( $userdata['session_logged_in'] )
{
	$template->assign_block_vars('bookmark_state', array());
	// Send vars to template
	$bm_action = (is_bookmark_set($topic_id)) ? ("&amp;removebm=true") : ("&amp;setbm=true");
	$template->assign_vars(array(
		'L_BOOKMARK_ACTION' => (is_bookmark_set($topic_id)) ? ($lang['Remove_Bookmark']) : ($lang['Set_Bookmark']),
		'BM_IMG' => (is_bookmark_set($topic_id)) ? $images['bm_remove'] : $images['bm_add'],
		'U_BOOKMARK_ACTION' => append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;start=$start&amp;postdays=$post_days&amp;postorder=$post_order&amp;highlight=" . $_GET['highlight'] . $bm_action))
	);
}

//
// If we've got a hightlight set pass it on to pagination,
// I get annoyed when I lose my highlight after the first page.
//
if(isset($_GET['printertopic']))
{
$pagination_printertopic = "printertopic=1&amp;";
}
if($highlight != '')
{
$pagination_highlight = "highlight=$highlight&amp;";
}
$pagination_ppp = $board_config['posts_per_page'];
if(isset($finish))
{
	$pagination_ppp = ($finish < 0)? -$finish: ($finish - $start);
	$pagination_finish_rel = "finish_rel=". -$pagination_ppp. "&amp";
}

$pagination = generate_pagination("viewtopic.$phpEx?". $pagination_printertopic . POST_TOPIC_URL . "=$topic_id&amp;postdays=$post_days&amp;postorder=$post_order&amp;". $pagination_highlight . $pagination_finish_rel, $total_replies, $pagination_ppp, $start);

if( ($userdata['user_level'] == ADMIN) || ($is_auth['auth_mod']) )
{
	$template->assign_block_vars('switch_info', array());
}

if ( isset($_POST['submit_topic_info']) && trim($_POST['topic_info']) != '' && (($userdata['user_level'] == ADMIN) || ($is_auth['auth_mod'])) )
{
	$sql = "UPDATE ". TOPICS_TABLE ." 
		SET topic_info = '" . str_replace("\'", "''", $_POST['topic_info']) . "'
		WHERE topic_id = $topic_id";
	if ( !$db->sql_query($sql) )
            {
		message_die(GENERAL_ERROR, 'Could not update topic info.', '', __LINE__, __FILE__, $sql);
            }
            $message = $lang['Topic_info_updated'] . "<br /><br />" . sprintf($lang['Click_return_topic'], "<a href=\"" . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_forum'], "<a href=\"" . append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id") . "\">", "</a>");
            message_die(GENERAL_MESSAGE, $message);
}

if($pagination != '' && isset($pagination_printertopic))
{
$pagination .= " &nbsp;<a href=\"viewtopic.$phpEx?". $pagination_printertopic. POST_TOPIC_URL . "=$topic_id&amp;postdays=$post_days&amp;postorder=$post_order&amp;". $pagination_highlight. "start=0&amp;finish_rel=-10000\" title=\"" . $lang['printertopic_cancel_pagination_desc'] . "\">:|&nbsp;|:</a>";
}

// Hide Buttons :: Added :: Start
if ($userdata['session_logged_in']){ 
    $template->assign_block_vars('switch_logged_in', array()); 
} 
if($is_auth['auth_post']){ 
    $template->assign_block_vars('is_auth_post', array()); 
} 
if($is_auth['auth_reply']){ 
    $template->assign_block_vars('is_auth_reply', array()); 
}
// Hide Buttons :: Added :: End
//
// Send vars to template
//
$template->assign_vars(array(
	'L_DOWNLOAD_POST' => $lang['Download_post'],
	'START_REL' => ($start + 1),
	'FINISH_REL' => (isset($_GET['finish_rel'])? intval($_GET['finish_rel']) : ($board_config['posts_per_page'] - $start)),
	'L_TOPIC_INFO' => $lang['Topic_info'],
	'S_INFO_ACTION' => append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id"),
	'TOPIC_INFO' => $topic_info,
	'FORUM_ID' => $forum_id,
  'FORUM_NAME' => $forum_name,
  'TOPIC_ID' => $topic_id,
  'TOPIC_TITLE' => $topic_title,
  'TOPIC_TITLE2' => $topic_title2,
	'PAGINATION' => $pagination,
	'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $pagination_ppp ) + 1 ), ceil( $total_replies / $pagination_ppp )),

	'POST_IMG' => $post_img,
	'REPLY_IMG' => $reply_img,

	/* Hide Buttons :: Altered
	'TOPIC_PREVIOUS_IMAGE' => $images['topic_previous'],*/
	'TOPIC_PREVIOUS_IMAGE' => $images[$previmg],
	'TOPIC_PRINT_IMAGE' => $images['topic_print'],
	'TOPIC_EMAIL_IMAGE' => $images['topic_email'],
	'TOPIC_SEARCH_IMAGE' => $images['topic_search'],
	'TOPIC_WHO_POST_IMAGE' => $images['topic_who_post'],
	'TOPIC_EXPORT_IMAGE' => $images['topic_export'],
	'TOPIC_DOWN_IMAGE' => $images['topic_down'],
	/* Hide Buttons :: Altered
	'TOPIC_NEXT_IMAGE' => $images['topic_next'],*/
	'TOPIC_NEXT_IMAGE' => $images[$nextimg],
	'ICON_DISK_IMAGE' => $images['icon_disk'],
	'TOPIC_UP_IMAGE' => $images['topic_up'],
	'ICON_UP_IMAGE' => $images['icon_up'],

	'L_AUTHOR' => $lang['Author'],
	'L_POPUP_MESSAGE' => $lang['Postings_popup_message'],
	'L_EXPORT' => $lang['Export'],
	'L_MESSAGE' => $lang['Message'],
	'L_POSTED' => $lang['Posted'],
	'L_POST_SUBJECT' => $lang['Post_subject'],
	'L_VIEW_NEXT_TOPIC' => $lang['View_next_topic'],
	'L_VIEW_PREVIOUS_TOPIC' => $lang['View_previous_topic'],
	'L_POST_NEW_TOPIC' => $post_alt,
	'L_POST_REPLY_TOPIC' => $reply_alt,
	'L_PRINTER_TOPIC' => $lang['Printer_topic'],
	'L_BACK_TO_TOP' => $lang['Back_to_top'],
	'L_GO_TO_BOTTOM' => $lang['Go_to_bottom'],
	'L_GO_TO_TOP' => $lang['Go_to_top'],

	'L_DISPLAY_POSTS' => $lang['Display_posts'],
	'L_LOCK_TOPIC' => $lang['Lock_topic'],
	'L_UNLOCK_TOPIC' => $lang['Unlock_topic'],
	'L_MOVE_TOPIC' => $lang['Move_topic'],
	'L_SPLIT_TOPIC' => $lang['Split_topic'],
	'L_DELETE_TOPIC' => $lang['Delete_topic'],
	'L_GOTO_PAGE' => $lang['Goto_page'],
	'L_TELL_FRIEND' => $lang['Tell_Friend'],

	'S_TOPIC_LINK' => POST_TOPIC_URL,
	'S_SELECT_POST_DAYS' => $select_post_days,
	'S_SELECT_POST_ORDER' => $select_post_order,
	'S_POST_DAYS_ACTION' => append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . '=' . $topic_id . "&amp;start=$start"),
	'S_AUTH_LIST' => $s_auth_can,
	'S_TOPIC_ADMIN' => $topic_mod,
	'S_WATCH_TOPIC' => $s_watching_topic,
	'S_WATCH_TOPIC_IMG' => $s_watching_topic_img,

	'U_VIEW_TOPIC' => append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;start=$start&amp;postdays=$post_days&amp;postorder=$post_order&amp;highlight=$highlight"),
	'U_VIEW_FORUM' => $view_forum_url,
	'U_POSTINGS_POPUP' => append_sid("postings_popup.$phpEx?t=$topic_id"),
	'U_EXPORT' => append_sid("export.$phpEx?t=$topic_id"),
	'U_VIEW_OLDER_TOPIC' => $view_prev_topic_url,
	'U_VIEW_NEWER_TOPIC' => $view_next_topic_url,
	'U_POST_NEW_TOPIC' => $new_topic_url,
	'U_PRINTER_TOPIC' => $printer_topic_url,
	'U_POST_REPLY_TOPIC' => $reply_topic_url)
);

//
// Does this topic contain a poll?
//
if ( !empty($forum_topic_data['topic_vote']) )
{
// 
// Begin Approve_Mod Block : 10
// 

}	//end of: if ( !empty($forum_topic_data['topic_vote']) )
	//ends the 'Does this topic conatin a poll?' (instead of doing a replace, we redid the if on the bottom of this 'after, add'

$approve_mod = array();
$approve_sql = "SELECT * FROM " . APPROVE_FORUMS_TABLE . " 
	WHERE forum_id = " . intval($forum_id) . " 
	LIMIT 0,1"; 
if ( !($approve_result = $db->sql_query($approve_sql)) ) 
{ 
	message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
} 
if ( $approve_row = $db->sql_fetchrow($approve_result) ) 
{    
	if ( intval($approve_row['enabled']) == 1 )
	{
		$approve_mod = $approve_row;
		$approve_mod['enabled'] = true;
	}

}
$approve_mod['moderators'] = explode('|', get_moderators_user_id_of_forum($forum_id));

if ( $approve_mod['enabled'] )
{
	if ( in_array($userdata['user_id'], $approve_mod['moderators']) || $is_auth['auth_mod'] )
	{
		function approve_mod_pm($type, $id)
		{
			global $approve_mod, $userdata, $user_ip, $session_length, $starttime, $template, $images, $theme, $db, $board_config, $phpEx, $lang, $phpbb_root_path, $html_entities_match, $html_entities_replace, $unhtml_specialchars_match, $unhtml_specialchars_replace;

			if ( $approve_mod['approve_notify_approval'] )
			{
				$server_name = trim($board_config['server_name']);
				$server_protocol = ( $board_config['cookie_secure'] ) ? 'https://' : 'http://';
				$server_port = ( $board_config['server_port'] <> 80 ) ? ':' . trim($board_config['server_port']) . '/' : '/';
				$script_name = preg_replace('/^\/?(.*?)\/?$/', "\\1", trim($board_config['script_path']));
				$script_name = ( $script_name != '' ) ? $script_name . '/viewtopic.'.$phpEx : 'viewtopic.'.$phpEx;
				if ( !class_exists('emailer') )
				{
					@include_once($phpbb_root_path . 'includes/emailer.'.$phpEx);
				}
				@include_once($phpbb_root_path . 'includes/functions_post.'.$phpEx);
				if ( $type == 'app_p' )
				{
					//notify user of post approval
					$approve_sql = "SELECT u.*, p.poster_id FROM " . USERS_TABLE . " u, " . APPROVE_POSTS_TABLE . " p 
						WHERE p.post_id = " .  intval($id) . " 
							AND u.user_id = p.poster_id";
					if ( !$approve_result = $db->sql_query($approve_sql) )
					{
						message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
					}
					if ( $approve_row = $db->sql_fetchrow($approve_result) )
					{
						$approve_to[0] = $approve_row;
					}
					$privmsg_subject = $lang['approve_notify_post_approved'] . " " . $lang['Post'] . ": " . $id;
					$privmsg_message = $lang['approve_notify_user_link'] . "\n" . $server_protocol . $server_name . $server_port . $script_name . '?'. POST_POST_URL . '=' . $id . '#' . $id;
				}
				elseif ( $type == 'app_c' )
				{
					//notify user of post approval
					$approve_sql = "SELECT u.*, p.post_id, p.topic_id FROM " . USERS_TABLE . " u, " . APPROVE_POSTS_TABLE . " p 	WHERE p.topic_id = " . intval($id) . " 
							AND u.user_id = p.poster_id";
					if ( !$approve_result = $db->sql_query($approve_sql) )
					{
						message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
					}
					if ( $approve_row = $db->sql_fetchrow($approve_result) )
					{
						$approve_to[0] = $approve_row;
					}
					$privmsg_subject = $lang['approve_notify_post_approved'] . " " . $lang['Topic'] . ": " . $id;
					$privmsg_message = $lang['approve_notify_user_link'] . "\n" . $server_protocol . $server_name . $server_port . $script_name . '?'. POST_POST_URL . '=' . $approve_to[0]['post_id'] . '#' . $approve_to[0]['post_id'] . "\n\n" .  $lang['approve_notify_user_topic'];
				}
				else
				{
					$approve_sql = "SELECT * FROM " . USERS_TABLE . " 
						WHERE user_id = " . intval($id);
					if ( !$approve_result = $db->sql_query($approve_sql) )
					{
						message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
					}
					if ( $approve_row = $db->sql_fetchrow($approve_result) )
					{
						$approve_to[0] = $approve_row;
					}
					switch($type)
					{
						case 'app_ua':
							$privmsg_subject = $lang['approve_notify_auto_app'];
							$privmsg_message = $lang['approve_notify_auto_app_msg'];
						break;

						case 'app_ur':
							$privmsg_subject = $lang['approve_notify_auto_app_rem'];
							$privmsg_message = $lang['approve_notify_auto_app_rem_msg'];
						break;

						case 'app_ma':
							$privmsg_subject = $lang['approve_notify_moderation'];
							$privmsg_message = $lang['approve_notify_moderation_msg'];
						break;

						case 'app_mr':
							$privmsg_subject = $lang['approve_notify_moderation_rem'];
							$privmsg_message = $lang['approve_notify_moderation_rem_msg'];
						break;
					}
				}
				$approve_user_list = array();
				for($i = 0; !empty($approve_to[$i]['user_id']); $i++)
				{
					if ( $approve_to[$i]['user_id'] != ANONYMOUS && !in_array($approve_to[$i]['user_id'], $approve_user_list) )
					{
						$approve_user_list[] = $approve_to[$i]['user_id'];

						$bbcode_uid = make_bbcode_uid();
						$privmsg_message = prepare_message($privmsg_message, 1, 1, 1, $bbcode_uid);
						$msg_time = time();
						//
						// See if recipient is at their inbox limit
						//
						$sql = "SELECT COUNT(privmsgs_id) AS inbox_items, MIN(privmsgs_date) AS oldest_post_time 
							FROM " . PRIVMSGS_TABLE . " 
							WHERE ( privmsgs_type = " . PRIVMSGS_NEW_MAIL . " 
									OR privmsgs_type = " . PRIVMSGS_READ_MAIL . "  
									OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " ) 
								AND privmsgs_to_userid = " . intval($approve_to[$i]['user_id']);
						if ( !($result = $db->sql_query($sql)) )
						{
							return false;
						}
						$sql_priority = ( SQL_LAYER == 'mysql' ) ? 'LOW_PRIORITY' : '';
						if ( $inbox_info = $db->sql_fetchrow($result) )
						{
							if ( $inbox_info['inbox_items'] >= $board_config['max_inbox_privmsgs'] && !empty($inbox_info['oldest_post_time']) )
							{
								$sql = "SELECT privmsgs_id FROM " . PRIVMSGS_TABLE . " 
									WHERE ( privmsgs_type = " . PRIVMSGS_NEW_MAIL . " 
											OR privmsgs_type = " . PRIVMSGS_READ_MAIL . " 
											OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . "  ) 
										AND privmsgs_date = " . $inbox_info['oldest_post_time'] . " 
										AND privmsgs_to_userid = " . intval($approve_to[$i]['user_id']);
								if ( !$result = $db->sql_query($sql) )
								{
									message_die(GENERAL_ERROR, 'Could not find oldest privmsgs (inbox)', '', __LINE__, __FILE__, $sql);
								}
								$old_privmsgs_id = $db->sql_fetchrow($result);
								$old_privmsgs_id = $old_privmsgs_id['privmsgs_id'];
								$sql = "DELETE $sql_priority FROM " . PRIVMSGS_TABLE . " 
									WHERE privmsgs_id = $old_privmsgs_id";
								if ( !$db->sql_query($sql) )
								{
									message_die(GENERAL_ERROR, 'Could not delete oldest privmsgs (inbox)'.$sql, '', __LINE__, __FILE__, $sql);
								}
								$sql = "DELETE $sql_priority FROM " . PRIVMSGS_TEXT_TABLE . " 
									WHERE privmsgs_text_id = $old_privmsgs_id";
								if ( !$db->sql_query($sql) )
								{
									message_die(GENERAL_ERROR, 'Could not delete oldest privmsgs text (inbox)', '', __LINE__, __FILE__, $sql);
								}
							}
						}
						//
						// Send the pm notification
						//
						$sql_info = "INSERT INTO " . PRIVMSGS_TABLE . " (privmsgs_type, privmsgs_subject, privmsgs_from_userid, privmsgs_to_userid, privmsgs_date, privmsgs_ip, privmsgs_enable_html, privmsgs_enable_bbcode, privmsgs_enable_smilies, privmsgs_attach_sig)
							VALUES (" . PRIVMSGS_NEW_MAIL . ", '" . str_replace("'", "\'", $privmsg_subject) . "', " . intval($approve_to[$i]['user_id']) . ", " . intval($approve_to[$i]['user_id']) . ", $msg_time, '0.0.0.0', 1, 1, 1, 0)";
						if ( !($result = $db->sql_query($sql_info, BEGIN_TRANSACTION)) )
						{
							message_die(GENERAL_ERROR, "Could not insert/update private message sent info.", "", __LINE__, __FILE__, $sql_info);
						}
						$privmsg_sent_id = $db->sql_nextid();
						$sql = "INSERT INTO " . PRIVMSGS_TEXT_TABLE . " (privmsgs_text_id, privmsgs_bbcode_uid, privmsgs_text)
								VALUES ($privmsg_sent_id, '" . $bbcode_uid . "', '" . str_replace("'", "\'", $privmsg_message) . "')";
						if ( !$db->sql_query($sql, END_TRANSACTION) )
						{
							message_die(GENERAL_ERROR, "Could not insert/update private message sent text.", "", __LINE__, __FILE__, $sql_info);
						}									
						//
						// Add to the users new pm counter
						//
						$sql = "UPDATE " . USERS_TABLE . "
							SET user_new_privmsg = user_new_privmsg + 1, user_last_privmsg = " . time() . "  
							WHERE user_id = " . intval($approve_to[$i]['user_id']); 
						if ( !$status = $db->sql_query($sql) )
						{
							message_die(GENERAL_ERROR, 'Could not update private message new/read status for user', '', __LINE__, __FILE__, $sql);
						}
						//
						// E-mail notify the user of the new PM if they have email notification for PM enabled in profile
						//
						if ( $approve_to[$i]['user_notify_pm'] && !empty($approve_to[$i]['user_email']) && $approve_to[$i]['user_active'] )
						{
							$email_headers = 'From: ' . $board_config['board_email'] . "\nReturn-Path: " . $board_config['board_email'] . "\n";
							$script_name = preg_replace('/^\/?(.*?)\/?$/', "\\1", trim($board_config['script_path']));
							$script_name = ( $script_name != '' ) ? $script_name . '/privmsg.'.$phpEx : 'privmsg.'.$phpEx;
							$emailer = new emailer($board_config['smtp_delivery']);
							$emailer->use_template('privmsg_notify',$approve_to[$i]['user_lang']);
							$emailer->extra_headers($email_headers);
							$emailer->email_address($approve_to[$i]['user_email']);
							$emailer->set_subject($lang['Notification_subject']);
							$emailer->assign_vars(array(
								'USERNAME' => $approve_to[$i]['username'], 
								'SITENAME' => $board_config['sitename'],
								'EMAIL_SIG' => (!empty($board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']) : '', 
								'U_INBOX' => $server_protocol . $server_name . $server_port . $script_name . '?folder=inbox')
							);
							$emailer->send();
							$emailer->reset();
						}
					}//if not guest or we've already notified them once
				}//for loop
			}
		}//function approve_mod_pm
		
		if ( isset($_GET['app_p']) ) 
		{ 
			//notify user
			approve_mod_pm('app_p', intval($_GET['app_p']));
			$approve_sql = "DELETE FROM " . APPROVE_POSTS_TABLE . " 
				WHERE post_id = " . intval($_GET['app_p']); 
			if ( !($approve_result = $db->sql_query($approve_sql)) ) 
			{ 
				message_die(GENERAL_ERROR, $lang['approve_posts_error_delete'], '', __LINE__, __FILE__, $approve_sql); 
			}
		}
		if ( isset($_GET['app_c']) ) 
		{ 
			//loop through & notify users
			approve_mod_pm('app_c', intval($_GET['app_c']));
			$approve_sql = "DELETE FROM " . APPROVE_POSTS_TABLE . " 
				WHERE topic_id = " . intval($_GET['app_c']); 
			if ( !($approve_result = $db->sql_query($approve_sql)) ) 
			{ 
				message_die(GENERAL_ERROR, $lang['approve_posts_error_delete'], '', __LINE__, __FILE__, $approve_sql); 
			}
		}
		if ( isset($_GET['app_f']) ) 
		{ 
			$approve_sql = "DELETE FROM " . APPROVE_TOPICS_TABLE . " 
				WHERE topic_id = " . intval($_GET['app_f']); 
			if ( !($approve_result = $db->sql_query($approve_sql)) ) 
			{ 
				message_die(GENERAL_ERROR, $lang['approve_posts_error_delete'], '', __LINE__, __FILE__, $approve_sql); 
			}
			$approve_sql = "INSERT INTO " . APPROVE_TOPICS_TABLE . " (topic_id, approve_moderate) 
				VALUES (" . intval($_GET['app_f']) . ", -1)"; 
			if ( !($approve_result = $db->sql_query($approve_sql)) ) 
			{ 
				message_die(GENERAL_ERROR, $lang['approve_posts_error_insert'], '', __LINE__, __FILE__, $approve_sql); 
			}
		}
		if ( isset($_GET['app_r']) ) 
		{
			$approve_sql = "DELETE FROM " . APPROVE_TOPICS_TABLE . " 
				WHERE topic_id = " . intval($_GET['app_r']) . " 
					AND approve_moderate = -1"; 
			if ( !($approve_result = $db->sql_query($approve_sql)) ) 
			{ 
				message_die(GENERAL_ERROR, $lang['approve_posts_error_delete'], '', __LINE__, __FILE__, $approve_sql); 
			}
		}
		if ( isset($_GET['app_ua']) ) 
		{ 
			//pm notify user they're being auto-approved now
			approve_mod_pm('app_ua', intval($_GET['app_ua']));
			$approve_sql = "DELETE FROM " . APPROVE_USERS_TABLE . " 
				WHERE user_id = " . intval($_GET['app_ua']); 
			if ( !($approve_result = $db->sql_query($approve_sql)) ) 
			{ 
				message_die(GENERAL_ERROR, $lang['approve_posts_error_delete'], '', __LINE__, __FILE__, $approve_sql); 
			}
			$approve_sql = "INSERT INTO " . APPROVE_USERS_TABLE . " (user_id, approve_moderate) 
				VALUES (" . intval($_GET['app_ua']) . ", -1)"; 
			if ( !($approve_result = $db->sql_query($approve_sql)) ) 
			{ 
				message_die(GENERAL_ERROR, $lang['approve_posts_error_insert'], '', __LINE__, __FILE__, $approve_sql); 
			}
			$approve_sql = "DELETE FROM " . APPROVE_POSTS_TABLE . " 
				WHERE poster_id = " . intval($_GET['app_ua']); 
			if ( !($approve_result = $db->sql_query($approve_sql)) ) 
			{ 
				message_die(GENERAL_ERROR, $lang['approve_posts_error_delete'], '', __LINE__, __FILE__, $approve_sql); 
			}
		}
		if ( isset($_GET['app_ur']) ) 
		{ 
			//pm notify user they're no longer being auto-approved
			approve_mod_pm('app_ur', intval($_GET['app_ur']));
			$approve_sql = "DELETE FROM " . APPROVE_USERS_TABLE . " 
				WHERE user_id = " . intval($_GET['app_ur']) . " 
					AND approve_moderate = -1"; 
			if ( !($approve_result = $db->sql_query($approve_sql)) ) 
			{ 
				message_die(GENERAL_ERROR, $lang['approve_posts_error_delete'], '', __LINE__, __FILE__, $approve_sql); 
			}
		} 
		if ( isset($_GET['app_ma']) ) 
		{ 
			//pm notify user they're being moderated now
			approve_mod_pm('app_ma', intval($_GET['app_ma']));
			$approve_sql = "DELETE FROM " . APPROVE_USERS_TABLE . " 
				WHERE user_id = " . intval($_GET['app_ma']); 
			if ( !($approve_result = $db->sql_query($approve_sql)) ) 
			{ 
				message_die(GENERAL_ERROR, $lang['approve_posts_error_delete'], '', __LINE__, __FILE__, $approve_sql); 
			}
			$approve_sql = "INSERT INTO " . APPROVE_USERS_TABLE . " (user_id, approve_moderate) 
				VALUES (" . intval($_GET['app_ma']) . ", 1)"; 
			if ( !($approve_result = $db->sql_query($approve_sql)) ) 
			{ 
				message_die(GENERAL_ERROR, $lang['approve_posts_error_insert'], '', __LINE__, __FILE__, $approve_sql); 
			}
		}
		if ( isset($_GET['app_mr']) ) 
		{ 
			//pm notify user they're not longer being moderated
			approve_mod_pm('app_mr', intval($_GET['app_mr']));
			$approve_sql = "DELETE FROM " . APPROVE_USERS_TABLE . " 
				WHERE user_id = " . intval($_GET['app_mr']) . " 
					AND approve_moderate = 1"; 
			if ( !($approve_result = $db->sql_query($approve_sql)) ) 
			{ 
				message_die(GENERAL_ERROR, $lang['approve_posts_error_delete'], '', __LINE__, __FILE__, $approve_sql); 
			}
		} 
		if ( isset($_GET['app_ta']) ) 
		{ 
			//notify user
			approve_mod_pm('app_p', intval($_GET['app_ta']));
			$approve_sql = "DELETE FROM " . APPROVE_TOPICS_TABLE . " 
				WHERE topic_id = " . intval($_GET['app_ta']); 
			if ( !($approve_result = $db->sql_query($approve_sql)) ) 
			{ 
				message_die(GENERAL_ERROR, $lang['approve_posts_error_delete'], '', __LINE__, __FILE__, $approve_sql); 
			}
			$approve_sql = "INSERT INTO " . APPROVE_TOPICS_TABLE . " (topic_id, approve_moderate) 
				VALUES (" . intval($_GET['app_ta']) . ", 1)"; 
			if ( !($approve_result = $db->sql_query($approve_sql)) ) 
			{ 
				message_die(GENERAL_ERROR, $lang['approve_posts_error_insert'], '', __LINE__, __FILE__, $approve_sql); 
			}
		}
		if ( isset($_GET['app_tr']) ) 
		{ 
			//notify user
			approve_mod_pm('app_p', intval($_GET['app_tr']));
			$approve_sql = "DELETE FROM " . APPROVE_TOPICS_TABLE . " 
				WHERE topic_id = " . intval($_GET['app_tr']) . " 
					AND approve_moderate = 1"; 
			if ( !($approve_result = $db->sql_query($approve_sql)) ) 
			{ 
				message_die(GENERAL_ERROR, $lang['approve_posts_error_delete'], '', __LINE__, __FILE__, $approve_sql); 
			}
		}
		//if the topic is awaiting approval, notify mod user to approve this topic
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
				$approve_mod['topics_admin_awaiting'] = true;
			}  
		}
	}
	else
	{
		//if the topic is awaiting approval, notify non-mod user
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
	}	
}

	//resetting up the if statement for polls, and modifying to hide polls when topic isn't approved yet.

//
// Does this topic contain a poll?
//
if ( !empty($forum_topic_data['topic_vote']) && !$approve_mod['topics_awaiting'] )
{

// 
// End Approve_Mod Block : 10
//

	$s_hidden_fields = '';

	$sql = "SELECT vd.vote_id, vd.vote_text, vd.vote_start, vd.vote_length, vd.vote_max, vd.vote_voted, vd.vote_hide, vd.vote_tothide, vr.vote_option_id, vr.vote_option_text, vr.vote_result
		FROM " . VOTE_DESC_TABLE . " vd, " . VOTE_RESULTS_TABLE . " vr
		WHERE vd.topic_id = $topic_id
			AND vr.vote_id = vd.vote_id
		ORDER BY vr.vote_option_id ASC";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Could not obtain vote data for this topic", '', __LINE__, __FILE__, $sql);
	}

	if ( $vote_info = $db->sql_fetchrowset($result) )
	{
		$db->sql_freeresult($result);
		$vote_options = count($vote_info);

		$vote_id = $vote_info[0]['vote_id'];
		$vote_title = $vote_info[0]['vote_text'];
		$max_vote = $vote_info[0]['vote_max'];
		$voted_vote = $vote_info[0]['vote_voted'];
		$hide_vote = $vote_info[0]['vote_hide'];
		$tothide_vote = $vote_info[0]['vote_tothide'];

		$sql = "SELECT vote_id
			FROM " . VOTE_USERS_TABLE . "
			WHERE vote_id = $vote_id
				AND vote_user_id = " . intval($userdata['user_id']);
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, "Could not obtain user vote data for this topic", '', __LINE__, __FILE__, $sql);
		}

		$user_voted = ( $row = $db->sql_fetchrow($result) ) ? TRUE : 0;
		$db->sql_freeresult($result);

		if ( isset($_GET['vote']) || isset($_POST['vote']) )
		{
			$view_result = ( ( ( isset($_GET['vote']) ) ? $_GET['vote'] : $_POST['vote'] ) == 'viewresult' ) ? TRUE : 0;
		}
		else
		{
			$view_result = 0;
		}

		$poll_expired = ( $vote_info[0]['vote_length'] ) ? ( ( $vote_info[0]['vote_start'] + $vote_info[0]['vote_length'] < time() ) ? TRUE : 0 ) : 0;

		if ( $user_voted || $view_result || $poll_expired || !$is_auth['auth_vote'] || $forum_topic_data['topic_status'] == TOPIC_LOCKED )
		{
			$template->set_filenames(array(
				'pollbox' => 'viewtopic_poll_result.tpl')
			);

			$vote_results_sum = 0;

			for($i = 0; $i < $vote_options; $i++)
			{
				$vote_results_sum += $vote_info[$i]['vote_result'];
			}

			$vote_graphic = 0;
			$vote_graphic_max = count($images['voting_graphic']);

			for($i = 0; $i < $vote_options; $i++)
			{
				$vote_percent = ( $vote_results_sum > 0 ) ? $vote_info[$i]['vote_result'] / $vote_results_sum : 0;
				$vote_graphic_length = round($vote_percent * $board_config['vote_graphic_length']);

				$vote_percent = ( $vote_results_sum > 0 ) ? $vote_info[$i]['vote_result'] / $vote_results_sum : 0;
				$vote_graphic_length = round($vote_percent * $board_config['vote_graphic_length']);

				$vote_graphic_img = $images['voting_graphic'][$vote_graphic];
				$vote_graphic = ($vote_graphic < $vote_graphic_max - 1) ? $vote_graphic + 1 : 0;

				if ( count($orig_word) )
				{
					$vote_info[$i]['vote_option_text'] = preg_replace($orig_word, $replacement_word, $vote_info[$i]['vote_option_text']);
				}
				$hide_vote_bl = '';
				$hide_vote_zr = '0';
				$total_votes_1 = $lang['Total_votes'] ;
				$total_votes_2 = $vote_results_sum ;
				if ( ( $poll_expired == 0 ) && ( $hide_vote == 1 ) && ( $vote_info[0]['vote_length'] <> 0 ) )
				{
					if ( $tothide_vote == 1 )
					{
						$total_votes_1 = '' ;
						$total_votes_2 = '' ;
					}
					$poll_expires_c = $lang['Results_after'];
					$template->assign_block_vars("poll_option", array(
						'POLL_OPTION_CAPTION' => $vote_info[$i]['vote_option_text'],
						'POLL_OPTION_RESULT' => $hide_vote_bl,
						'POLL_OPTION_PERCENT' => $hide_vote_bl,
						'POLL_OPTION_IMG' => $vote_graphic_img,
						'POLL_OPTION_IMG_WIDTH' => $hide_vote_zr)
					);
				}
				else
				{
				$poll_expires_c = '';

				$template->assign_block_vars("poll_option", array(
					'POLL_OPTION_CAPTION' => $vote_info[$i]['vote_option_text'],
					'POLL_OPTION_RESULT' => $vote_info[$i]['vote_result'],
					'POLL_OPTION_PERCENT' => sprintf("%.1d%%", ($vote_percent * 100)),

					'POLL_OPTION_IMG' => $vote_graphic_img,
					'POLL_OPTION_IMG_WIDTH' => $vote_graphic_length)
				);
				}
			}

			if ( ( $poll_expired == 0 ) && ( $vote_info[0]['vote_length'] <> 0 ) )
			{
				$poll_expire_1 = (( $vote_info[0]['vote_start'] + $vote_info[0]['vote_length'] ) - time() );
				$poll_expire_2 = intval($poll_expire_1/86400);
				$poll_expire_a = $poll_expire_2*86400;
				$poll_expire_3 = intval(($poll_expire_1 - ($poll_expire_a))/3600);
				$poll_expire_b = $poll_expire_3*3600;
				$poll_expire_4 = intval((($poll_expire_1 - ($poll_expire_a) - ($poll_expire_b)))/60);
				$poll_comma = ', ';
				$poll_space = ' ';
				$poll_expire_2 == '0' ? $poll_expire_6='' : ( ( $poll_expire_3 == 0 && $poll_expire_4 == 0 ) ? $poll_expire_6=$poll_expire_2.$poll_space.$lang['Days'] : $poll_expire_6=$poll_expire_2.$poll_space.$lang['Days'].$poll_comma ) ;
				$poll_expire_3 == '0' ? $poll_expire_7='' : ( $poll_expire_4 == 0 ? $poll_expire_7=$poll_expire_3.$poll_space.$lang['Hours'] : $poll_expire_7=$poll_expire_3.$poll_space.$lang['Hours'].$poll_comma ) ;
				$poll_expire_4 == '0' ? $poll_expire_8='' : $poll_expire_8=$poll_expire_4.$poll_space.$lang['Minutes'] ;
				$poll_expires_d = $lang['Poll_expires'];
			}
			else
			{
				$poll_expires_6 = '';
				$poll_expires_7 = '';
				$poll_expires_8 = '';
				$poll_expires_d = '';
			}
			$voted_vote_nb = $voted_vote;
			$template->assign_vars(array(
				'VOTED_SHOW' => $lang['Voted_show'],
				'L_TOTAL_VOTES' => $total_votes_1,
				'VOTE_LEFT_IMAGE' => $images['voting_graphic_left'],
				'VOTE_RIGHT_IMAGE' => $images['voting_graphic_right'],
				'L_RESULTS_AFTER' => $poll_expires_c,
				'L_POLL_EXPIRES' => $poll_expires_d,
				'POLL_EXPIRES' => ($poll_expire_6.$poll_expire_7.$poll_expire_8),
				'TOTAL_VOTES' => $total_votes_2)

				
			);

		}
		else
		{
			$template->set_filenames(array(
				'pollbox' => 'viewtopic_poll_ballot.tpl')
			);
			if ( $max_vote > 1 )
			{
				$vote_box = 'checkbox';
			}
			else 	$vote_box = 'radio';
			for($i = 0; $i < $vote_options; $i++)
			{
				if ( count($orig_word) )
				{
					$vote_info[$i]['vote_option_text'] = preg_replace($orig_word, $replacement_word, $vote_info[$i]['vote_option_text']);
				}

				$template->assign_block_vars("poll_option", array(
					'POLL_VOTE_BOX' => $vote_box,
					'POLL_OPTION_ID' => $vote_info[$i]['vote_option_id'],
					'POLL_OPTION_CAPTION' => $vote_info[$i]['vote_option_text'])
				);
			}

			$template->assign_vars(array(
				'L_SUBMIT_VOTE' => $lang['Submit_vote'],
				'L_VIEW_RESULTS' => $lang['View_results'],

				'U_VIEW_RESULTS' => append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;postdays=$post_days&amp;postorder=$post_order&amp;vote=viewresult"))
			);

			$s_hidden_fields = '<input type="hidden" name="topic_id" value="' . $topic_id . '" /><input type="hidden" name="mode" value="vote" />';
		}
				if ( $max_vote > 1 )
				{
					$vote_br = '<br>';
					$max_vote_nb = $max_vote;
				}
				else
				{
					$vote_br = '';
					$lang['Max_voting_1_explain'] = '';
					$lang['Max_voting_2_explain'] = '';
					$lang['Max_voting_3_explain'] = '';
					$max_vote_nb = '';
				}
		if ( count($orig_word) )
		{
			$vote_title = preg_replace($orig_word, $replacement_word, $vote_title);
		}

		$s_hidden_fields .= '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';

		$template->assign_vars(array(
			'POLL_QUESTION' => $vote_title,
			'POLL_VOTE_BR' => $vote_br,
			'MAX_VOTING_1_EXPLAIN' => $lang['Max_voting_1_explain'],
			'MAX_VOTING_2_EXPLAIN' => $lang['Max_voting_2_explain'],
			'MAX_VOTING_3_EXPLAIN' => $lang['Max_voting_3_explain'],
			'max_vote' => $max_vote_nb,
			'voted_vote' => $voted_vote_nb,
			'S_HIDDEN_FIELDS' => $s_hidden_fields,
			'S_POLL_ACTION' => append_sid("posting.$phpEx?mode=vote&amp;" . POST_TOPIC_URL . "=$topic_id"))
		);

		$template->assign_var_from_handle('POLL_DISPLAY', 'pollbox');
	}
}

init_display_post_attachments($forum_topic_data['topic_attachment']);
//
// Update the topic view counter
//
if (!($postrow[0]['user_id'] == $userdata['user_id'])) 
{
	$sql = "UPDATE " . TOPICS_TABLE . "
		SET topic_views = topic_views + 1
		WHERE topic_id = $topic_id";
	if ( !$db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, "Could not update topic views.", '', __LINE__, __FILE__, $sql);
	}
}
//
// Okay, let's do the loop, yeah come on baby let's do the loop
// and it goes like this ...
//
define('RATING_PATH', $phpbb_root_path.'mods/rating/');
include (RATING_PATH.'functions_rating.'.$phpEx);
$rating_config = get_rating_config('1,2,14,18');
if ( $rating_config[1] == 1 && $is_auth['auth_view'] && $is_auth['auth_read'] )
{
	get_rating_ranks();
	// SHOW DROPDOWN BOX FOR RATINGS SCREEN IF APPROPRIATE
	if ( $rating_config[18] == 1 )
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
	$target_window = ( $rating_config[14] == 1 ) ? 'phpbb_rating' : '_self';
}

for($i = 0; $i < $total_posts; $i++)
{
	//-- mod : profile cp ------------------------------------------------------------------------------
//-- add
	$author_panel = '';
	// get the panels
	$author_panel	= pcp_output_panel('PHPBB.viewtopic.left', $postrow[$i]);
	/* Hide Buttons :: Altered
	$buttons_panel	= pcp_output_panel('PHPBB.viewtopic.buttons', $postrow[$i]);*/
	if ($userdata['session_logged_in']){ 
        $buttons_panel    = pcp_output_panel('PHPBB.viewtopic.buttons', $postrow[$i]); 
    }
	$ignore_panel	= pcp_output_panel('PHPBB.viewtopic.left.ignore', $postrow[$i]);
	$ignore_buttons	= pcp_output_panel('PHPBB.viewtopic.buttons.ignore', $postrow[$i]);
//-- fin mod : profile cp --------------------------------------------------------------------------

	if ( count_safe($post_rank_set) > 0 && ( $i == 0 || $rating_config[2] == 0 ) )
	{
		$post_rating = ( $postrow[$i]['rating_rank_id'] > 0 ) ? $lang['Rating'].':&nbsp;'.$post_rank_set[$postrow[$i]['rating_rank_id']] : $lang['No_rating'];
		$rating_url = append_sid($phpbb_root_path.'rating.php?p='.$postrow[$i]['post_id']);
		/* Hide Buttons :: Altered
		$post_rating = '&nbsp;<a class="nav" href="'.$rating_url.'" target="'.$target_window.'" onclick="window.open(\''.$rating_url.'\',\''.$target_window.'\',\'width=500,height=600,resize,scrollbars=yes\')">'.$post_rating.'</a>';*/
		if ($userdata['session_logged_in']){ 
            $post_rating = '&nbsp;<a class="nav" href="'.$rating_url.'" target="'.$target_window.'" onclick="window.open(\''.$rating_url.'\',\''.$target_window.'\',\'width=500,height=600,resize,scrollbars=yes\')">'.$post_rating.'</a>'; 
        }else{ 
            $post_rating = '&nbsp;'.$post_rating; 
        }
	}
	else
	{
		$post_rating = '';
	}
	$poster_id = $postrow[$i]['user_id'];
	$poster = ( $poster_id == ANONYMOUS ) ? $lang['Guest'] : $postrow[$i]['username'];

//-- mod : today at  yesterday at ------------------------------------------------------------------------ 
//-- add 
	$post_date = create_date($board_config['default_dateformat'], $postrow[$i]['post_time'], $board_config['board_timezone']); 
//-- end mod : today at  yesterday at ------------------------------------------------------------------------ 

	//
	// Define the little post icon
	//
	//-- mod : keep unread -----------------------------------------------------------------------------
//-- delete
//	if ( $userdata['session_logged_in'] && $postrow[$i]['post_time'] > $userdata['user_lastvisit'] && $postrow[$i]['post_time'] > $topic_last_read )
//-- add
	if ( $postrow[$i]['post_time'] > $topic_last_read )
//-- fin mod : keep unread -------------------------------------------------------------------------

	{
		$mini_post_img = $images['icon_minipost_new'];
		$mini_post_alt = $lang['New_post'];
	}
	else
	{
		$mini_post_img = $images['icon_minipost'];
		$mini_post_alt = $lang['Post'];
	}

	$mini_post_url = append_sid("viewtopic.$phpEx?" . POST_POST_URL . '=' . $postrow[$i]['post_id']) . '#' . $postrow[$i]['post_id'];

	$temp_url = append_sid("posting.$phpEx?mode=quote&amp;" . POST_POST_URL . "=" . $postrow[$i]['post_id']);
	/* Hide Buttons :: Altered
	$quote_img = '<a class="icon_quote noi" href="' . $temp_url . '"title="' . $lang['Reply_with_quote'] . '"><span>' . $lang['Quote'] . '</span></a>';*/
	if($is_auth['auth_reply']){ 
        $quote_img = '<a class="icon_quote noi" href="' . $temp_url . '"title="' . $lang['Reply_with_quote'] . '"><span>' . $lang['Quote'] . '</span></a>'; 
    }
	$quote = '<a href="' . $temp_url . '">' . $lang['Reply_with_quote'] . '</a>';

	$temp_url = append_sid("search.$phpEx?search_author=" . urlencode($postrow[$i]['username']) . "&amp;showresults=posts");
	$search_img = '<a class="icon_search noi" href="' . $temp_url . '" title="' . sprintf($lang['Search_user_posts'], $postrow[$i]['username'])  . '"><span>' . $lang['Search'] . '</span></a>';
	$search = '<a href="' . $temp_url . '">' . sprintf($lang['Search_user_posts'], $postrow[$i]['username'])  . '</a>';

	if ( ( $userdata['user_id'] == $poster_id && $is_auth['auth_edit'] ) || $is_auth['auth_mod'] )
	{
		$temp_url = append_sid("posting.$phpEx?mode=editpost&amp;" . POST_POST_URL . "=" . $postrow[$i]['post_id']);
		$edit_img = '<a class="icon_edit noi" href="' . $temp_url . '" title="' . $lang['Edit_delete_post'] . '"><span>' . $lang['edit_lofi'] . '</span></a>';
		$edit = '<a href="' . $temp_url . '">' . $lang['Edit_delete_post'] . '</a>';
	}
	else
	{
		$edit_img = '';
		$edit = '';
	}

	if ( $is_auth['auth_mod'] )
	{
		$temp_url = "modcp.$phpEx?mode=ip&amp;" . POST_POST_URL . "=" . $postrow[$i]['post_id'] . "&amp;" . POST_TOPIC_URL . "=" . $topic_id . "&amp;p_sid=" . $userdata['priv_session_id'];
		$ip_img = '<a class="icon_ip noi" href="' . $temp_url . '" title="' . $lang['View_IP'] . '"><img src="' . $images['icon_ip'] . '" alt="' . $lang['View_IP'] . '" title="' . $lang['View_IP'] . '" border="0" /></a>';
		$ip = '<a href="' . $temp_url . '">' . $lang['View_IP'] . '</a>';

		$temp_url = "posting.$phpEx?mode=delete&amp;" . POST_POST_URL . "=" . $postrow[$i]['post_id'] . "&amp;p_sid=" . $userdata['priv_session_id'];
		$delpost_img = '<a class="icon_delete noi" href="' . $temp_url . '" title="' . $lang['Delete_post'] . '"><img src="' . $images['icon_delpost'] . '" alt="' . $lang['Delete_post'] . '" title="' . $lang['Delete_post'] . '" border="0" /></a>';
		$delpost = '<a href="' . append_sid($temp_url) . '">' . $lang['Delete_post'] . '</a>';
	}
	else
	{
		$ip_img = '';
		$ip = '';

		if ( $userdata['user_id'] == $poster_id && $is_auth['auth_delete'] && $forum_topic_data['topic_last_post_id'] == $postrow[$i]['post_id'] )
		{
			$temp_url = "posting.$phpEx?mode=delete&amp;" . POST_POST_URL . "=" . $postrow[$i]['post_id'] . "&amp;p_sid=" . $userdata['priv_session_id'];
			$delpost_img = '<a class="icon_delete noi" href="' . $temp_url . '"><img src="' . $images['icon_delpost'] . '" alt="' . $lang['Delete_post'] . '" title="' . $lang['Delete_post'] . '" border="0" /></a>';
			$delpost = '<a href="' . append_sid($temp_url) . '">' . $lang['Delete_post'] . '</a>';
		}
		else
		{
			$delpost_img = '';
			$delpost = '';
		}
	}

	if($poster_id != ANONYMOUS && $postrow[$i]['user_level'] != ADMIN) 
	{ 
		$current_user = str_replace("'","\'",$postrow[$i]['username']);
        $user_warnings = $postrow[$i]['user_warnings']; 
        if ($is_auth['auth_greencard'] && $user_warnings) 
		{ 
			  $g_card_img = ' <input type="image" name="unban" value="unban" onClick="return confirm(\''.sprintf($lang['Green_card_warning'],$current_user).'\')" src="'. $images['icon_g_card'] . '" class="gcard noi"  title="' . $lang['Give_G_card'] . '" alt="' . $lang['Give_G_card'] . '" >'; 
		} 
		else 
		{
			$g_card_img = ''; 
		}

		if ($user_warnings<$board_config['max_user_bancard'] && $is_auth['auth_ban'] )
		{ 
			$y_card_img = ' <input type="image" name="warn" value="warn" onClick="return confirm(\''.sprintf($lang['Yellow_card_warning'],$current_user).'\')" src="'. $images['icon_y_card'] . '" class="ycard noi" title="' . sprintf($lang['Give_Y_card'],$user_warnings+1) . '" alt="" >'; 
				$r_card_img = ' <input type="image" name="ban" value="ban"  onClick="return confirm(\''.sprintf($lang['Red_card_warning'],$current_user).'\')" src="'. $images['icon_r_card'] . '" class="rcard noi" title="' . $lang['Give_R_card'] . '" alt="" >'; 
		}
		else
		{
			$y_card_img = '';
			$r_card_img = ''; 
		} 
	} else
	{
		$card_img = '';
		$g_card_img = '';
		$y_card_img = '';
		$r_card_img = '';
	}

		if ($is_auth['auth_bluecard']) 
		{ 
			if ($is_auth['auth_mod']) 
			{ 
				$b_card_img = (($postrow[$i]['post_bluecard'])) ? ' <input type="image" name="report_reset" value="report_reset" onClick="return confirm(\''.$lang['Clear_blue_card_warning'].'\')" src="'. $images['icon_bhot_card'] . '"  class="bhotcard noi" title="'. sprintf($lang['Clear_b_card'],$postrow[$i]['post_bluecard']) . '"  alt="">':' <input type="image" name="report" value="report" onClick="return confirm(\''.$lang['Blue_card_warning'].'\')" src="'. $images['icon_b_card'] . '" title="' . $lang['Give_b_card'] . '"alt="" class="bcard noi" >'; 
			} 
			else 
			{ 
				$b_card_img = ' <input type="image" name="report" value="report" onClick="return confirm(\''.$lang['Blue_card_warning'].'\')" src="'. $images['icon_b_card'] . '" class="bcard noi" title="' . $lang['Give_b_card'] . '" alt="" >';
				
			}
		} else $b_card_img = '';

	// parse hidden filds if cards visible
	$card_hidden = ($g_card_img || $r_card_img || $y_card_img || $b_card_img) ? '<input type="hidden" name="post_id" value="'. $postrow[$i]['post_id'].'">' :'';

	$post_subject = ( $postrow[$i]['post_subject'] != '' ) ? $postrow[$i]['post_subject'] : '';

	// CrackerTracker v5.x
	if ( $postrow[$i]['ct_miserable_user'] == 1 && $postrow[$i]['user_id'] != $userdata['user_id'] && $userdata['user_level'] == 0)
	{
		$message = $lang['ctracker_message_dialog_title'] . '<br /><br />' . $lang['ctracker_ipb_deleted'];
	}
	else
	{
		$message = $postrow[$i]['post_text'];
		if ( $postrow[$i]['ct_miserable_user'] == 1 && $userdata['user_level'] == ADMIN )
		{
			$message .= '<br /><br />' . $lang['ctracker_mu_success'];
		}
	}

	$bbcode_uid = $postrow[$i]['bbcode_uid'];

	if ( ((!$is_auth['auth_reply']) or ($forum_topic_data['forum_status'] == FORUM_LOCKED) or ($forum_topic_data['topic_status'] == TOPIC_LOCKED)) and ($userdata['user_level'] != ADMIN) )
	{
		$quick_quote = '';
	}
	else
	{
		//$plain_message = $postrow[$i]['post_text'];
		//$plain_message = preg_replace('/\:(([a-z0-9]:)?)' . $bbcode_uid . '/s', '', $plain_message);
		//$plain_message = str_replace('<', '&lt;', $plain_message);
		//$plain_message = str_replace('>', '&gt;', $plain_message);
		//$plain_message = str_replace('<br />', "\n", $plain_message);

    $plain_message = $postrow[$i]['post_text'];
		$plain_message = str_replace('&lt;', '<', $plain_message);
		$plain_message = str_replace('&gt;', '>', $plain_message);
		$plain_message = str_replace('&quot;', '"', $plain_message);
    $plain_message = preg_replace('#&amp;#', '&', $plain_message);
		$plain_message = preg_replace('/\:(([a-z0-9]:)?)' . $bbcode_uid . '/s', '', $plain_message);
		$plain_message = str_replace('<br />', "\n", $plain_message);

		$orig_word = array();
		$replacement_word = array();
		obtain_word_list($orig_word, $replacement_word);

		if ( !empty($orig_word) )
		{
			$plain_message = ( !empty($plain_message) ) ? preg_replace($orig_word, $replacement_word, $plain_message) : '';
		}
		$plain_message = addslashes($plain_message);
		$plain_message = str_replace("\n", "\\n", $plain_message);
		$plain_message = str_replace(chr(13), '', $plain_message);
		$quick_quote = '<input type="button" class="button" name="addquote" value="' . $lang['Quick_quote'] . '" style="width: 100px" onClick="addquote(' . $postrow[$i]['post_id'] . ');" />&nbsp;&nbsp;';
	}

	$user_sig = ( $postrow[$i]['enable_sig'] && $postrow[$i]['user_sig'] != '' && $board_config['allow_sig'] ) ? $postrow[$i]['user_sig'] : '';
	$user_sig_bbcode_uid = $postrow[$i]['user_sig_bbcode_uid'];

	//
	// Note! The order used for parsing the message _is_ important, moving things around could break any
	// output
	//

	//
	// If the board has HTML off but the post has HTML
	// on then we process it, else leave it alone
	//
	if ( !$board_config['allow_html'] || !$userdata['user_allowhtml'])
	{
		if ( $user_sig != '' )
		{
			$user_sig = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $user_sig);
		}

		if ( $postrow[$i]['enable_html'] )
		{
			$message = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $message);
			//$message .= 'Precessed... ';
		}
	}
	
	// If the board has HTML on then unprepare Michaelo BUG FIX beta #3 
//	if ( $board_config['allow_html'] && $userdata['user_allowhtml'])
//	{
//		$message = unprepare_message($message); // beta Michaelo #3 
//	}

	//
	// Parse message and/or sig for BBCode if reqd
	//
	if ($user_sig != '' && $user_sig_bbcode_uid != '')
	{
// Start add - Signatures control MOD
if ( $userdata['user_allowsignature'] != 2 && $board_config['sig_allow_font_sizes'] == 0 )
{
	$user_sig = '[size=' . $board_config['sig_max_font_size'] . ':' . $user_sig_bbcode_uid . ']' . $user_sig . '[/size:' . $user_sig_bbcode_uid . ']';
}
// End add - Signatures control MOD
		$user_sig = ($board_config['allow_bbcode']) ? bbencode_second_pass($user_sig, $user_sig_bbcode_uid) : preg_replace("/\:$user_sig_bbcode_uid/si", '', $user_sig);
	}

	if ( strpos($message, '.script') !== false)
	{
		$message = str_replace(".script", "script", $message);
	}

	if ($bbcode_uid != '')
	{
		$message = ($board_config['allow_bbcode']) ? bbencode_second_pass($message, $bbcode_uid) : preg_replace("/\:$bbcode_uid/si", '', $message);
	}

	if ( $user_sig != '' && $board_config['sig_allow_url'] != 0 )
	{
		$user_sig = make_clickable($user_sig);
	}
	$message = make_clickable($message);
	// BEGIN CMX News Mod
	// Strip out the <!--break--> delimiter.
	$delim = htmlspecialchars( '<!--break-->' );
	$pos = strpos( $message, $delim );
	if( ($pos !== false) && ($pos < strlen( $message )) ) {
		$message = substr_replace( $message, html_entity_decode($delim), $pos, strlen($delim) );
	}
	// END CMX News Mod


	//
	// Parse smilies
	//
	//Begin Lo-Fi Mod
	if ( $board_config['allow_smilies'] && !$lofi )
	//End Lo-Fi Mod 
	{
		if ( $postrow[$i]['user_allowsmile'] && $user_sig != '' && $board_config['sig_allow_smilies'] != 0 )
		{
			$user_sig = smilies_pass($user_sig);
		}

		if ( $postrow[$i]['enable_smilies'] )
		{
			$message = smilies_pass($message);
		}
	}

	//
	// Highlight active words (primarily for search)
	//
	if ($highlight_match)
	{
		// This has been back-ported from 3.0 CVS
		$message = preg_replace('#(?!<.*)(?<!\w)(' . $highlight_match . ')(?!\w|[^<>]*>)#i', '<b style="color:#'.$theme['fontcolor3'].'">\1</b>', $message);
	}

	//
	// Replace naughty words
	//
	if (count($orig_word))
	{
		$post_subject = preg_replace($orig_word, $replacement_word, $post_subject);

		if ($user_sig != '')
		{
			$user_sig = str_replace('\"', '"', substr(preg_replace_callback('#(\>(((? >([^><]+|(?R)))*)\<))#s', function ($matches) use ($orig_word, $replacement_word) {
				return preg_replace($orig_word, $replacement_word, $matches[0]);
			}, '>' . $user_sig . '<'), 1, -1));
		}

		$message = str_replace('\"', '"', substr(preg_replace_callback('#(\>(((? >([^><]+|(?R)))*)\<))#s', function ($matches) use ($orig_word, $replacement_word) {
			return preg_replace($orig_word, $replacement_word, $matches[0]);
		}, '>' . $message . '<'), 1, -1));
	}

	//
	// Replace newlines (we use this rather than nl2br because
	// till recently it wasn't XHTML compliant)
	//
	if ( $user_sig != '' && $userdata['user_allowsignature'] != 0 )
	{
		$user_sig = '_________________<br />' . str_replace("\n", "\n<br />\n", $user_sig);
	} else $user_sig = '';
	
	if(!isset($_GET['printertopic']))
	{
		$message = acronym_pass( $message );
	}
	$message = str_replace("\n", "\n<br />\n", $message);

	//
	// Editing information
	//
	if ( $postrow[$i]['post_edit_count'] )
	{
		$l_edit_time_total = ( $postrow[$i]['post_edit_count'] == 1 ) ? $lang['Edited_time_total'] : $lang['Edited_times_total'];

		$l_edited_by = '<br /><br />' . sprintf($l_edit_time_total, $poster, create_date($board_config['default_dateformat'], $postrow[$i]['post_edit_time'], $board_config['board_timezone']), $postrow[$i]['post_edit_count']);
	}
	else
	{
		$l_edited_by = '';
	}

//-- mod : calendar --------------------------------------------------------------------------------
//-- add
	if (!empty($topic_calendar_time) && ($postrow[$i]['post_id'] == $topic_first_post_id))
	{
		$post_subject .= get_calendar_title($topic_calendar_time, $topic_calendar_duration);
	}
//-- fin mod : calendar ----------------------------------------------------------------------------
//-- mod : post icon -------------------------------------------------------------------------------
//-- add
	$post_subject = get_icon_title($postrow[$i]['post_icon']) . '&nbsp;' . $post_subject;
//-- fin mod : post icon ---------------------------------------------------------------------------
	//
	// Again this will be handled by the templating
	// code at some point
	//
	$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
	$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

// 
// Begin Approve_Mod Block : 11
// 		
		if ( $approve_mod['enabled'] )
		{
			$approve_mod['poster_id'] = $postrow[$i]['poster_id'];
			$approve_mod['posts_awaiting'] = false;

			$approve_sql = "SELECT * FROM " . APPROVE_POSTS_TABLE . " 
				WHERE post_id = " . intval($postrow[$i]['post_id']) . " 
				LIMIT 0,1"; 
			if ( !($approve_result = $db->sql_query($approve_sql)) ) 
			{ 
				message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
			} 
			if ( $approve_row = $db->sql_fetchrow($approve_result) ) 
			{ 
				if ( intval($approve_row['post_id']) == intval($postrow[$i]['post_id']) )
				{
					$approve_mod['posts_awaiting'] = true;
				}  
			} 
			$approve_mod['moderators'] = explode('|', get_moderators_user_id_of_forum($forum_id));
			
			if ( in_array($userdata['user_id'], $approve_mod['moderators']) || $is_auth['auth_mod'] )
			{
				if ( !$approve_mod['approve_first_past'] )
				{
					$approve_mod['approve_first_past'] = true;
					$approve_sql = "SELECT * FROM " . APPROVE_POSTS_TABLE . " 
						WHERE topic_id = " . intval($topic_id) . " 
						LIMIT 0,2"; 
					if ( !($approve_result = $db->sql_query($approve_sql)) ) 
					{ 
						message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
					}
					if ( $db->sql_numrows($approve_result) > 1) 
					{ 
						$post_subject .= "<br /><a href=\"" . append_sid("viewtopic." . $phpEx . "?". POST_TOPIC_URL . "=" . $topic_id . "&app_c=" . $topic_id) . "\" class='copyright'>[ " . $lang['approve_topic_all_current'] . " ]</a>";
					}
					if ( $approve_mod['approve_users'] )
					{
						$approve_sql = "SELECT * FROM " . APPROVE_TOPICS_TABLE . " 
							WHERE topic_id = " . intval($topic_id) . " 
								AND approve_moderate = -1 
							LIMIT 0,1"; 
						if ( !($approve_result = $db->sql_query($approve_sql)) ) 
						{ 
							message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
						} 
						if ( $approve_row = $db->sql_fetchrow($approve_result) ) 
						{ 
							$post_subject .= "<br /><a href=\"" . append_sid("viewtopic." . $phpEx . "?". POST_TOPIC_URL . "=" . $topic_id . "&app_r=" . $topic_id) . "\" class='copyright'>[ " . $lang['approve_topic_all_future_rem'] . " ]</a>";
						}
						else
						{
							$post_subject .= "<br /><a href=\"" . append_sid("viewtopic." . $phpEx . "?". POST_TOPIC_URL . "=" . $topic_id . "&app_f=" . $topic_id) . "\" class='copyright'>[ " . $lang['approve_topic_all_future'] . " ]</a>";
						}
					}
					else if ( $approve_mod['approve_topics'] && $approve_mod['approve_posts'] )
					{
						$approve_sql = "SELECT * FROM " . APPROVE_TOPICS_TABLE . " 
							WHERE topic_id = " . intval($topic_id) . " 
								AND approve_moderate = 1";
						if ( !($approve_result = $db->sql_query($approve_sql)) ) 
						{ 
							message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
						} 
						if ( $approve_row = $db->sql_fetchrow($approve_result) ) 
						{
							$post_subject .= "<br /><a href=\"" . append_sid("viewtopic." . $phpEx . "?". POST_TOPIC_URL . "=" . $topic_id . "&app_tr=" . $topic_id) . "\" class='copyright'>[ " . $lang['approve_topic_moderate_rem'] . " ]</a>";
						}
						else 
						{
							$post_subject .= "<br /><a href=\"" . append_sid("viewtopic." . $phpEx . "?". POST_TOPIC_URL . "=" . $topic_id . "&app_ta=" . $topic_id) . "\" class='copyright'>[ " . $lang['approve_topic_moderate'] . " ]</a>";
						}
					}
				}
				if ( $approve_mod['approve_users'] && $approve_mod['poster_id'] != ANONYMOUS )
				{
					$approve_sql = "SELECT * FROM " . APPROVE_USERS_TABLE . " 
						WHERE user_id = " . intval($approve_mod['poster_id']) . " 
						LIMIT 0,1";
					if ( !($approve_result = $db->sql_query($approve_sql)) ) 
					{ 
						message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
					} 
					$approve_row = $db->sql_fetchrow($approve_result);
					if ( intval($approve_row['approve_moderate']) == -1 ) 
					{ 
						$auto_approve= "<a href=\"" .  append_sid("viewtopic." . $phpEx . "?". POST_POST_URL . "=" . $postrow[$i]['post_id'] . "&app_ur=" . $poster_id) . "#" . $postrow[$i]['post_id'] . "\" class='copyright'>[ " . $lang['approve_user_auto_approve_rem'] . " ]</a><br /><br />";
						
					}
					elseif ( intval($approve_row['approve_moderate']) == 1 ) 
					{
						$poster_rank .= "<br /><a href=\"" .  append_sid("viewtopic." . $phpEx . "?". POST_POST_URL . "=" . $postrow[$i]['post_id'] . "&app_mr=" . $poster_id) . "#" . $postrow[$i]['post_id'] . "\" class='copyright'>[ " . $lang['approve_user_moderate_rem'] . " ]</a>";
					}
					else
					{
						
						//moderate all users, give option to auto approve this user
						$auto_approve= "<a href=\"" .  append_sid("viewtopic." . $phpEx . "?". POST_POST_URL . "=" . $postrow[$i]['post_id'] . "&app_ua=" . $poster_id) . "#" . $postrow[$i]['post_id'] . "\" class='copyright'>[ " . $lang['approve_user_auto_approve'] . " ]</a><br /><br />";
					}
				}
				elseif ( $approve_mod['poster_id'] != -1 )
				{
					$approve_sql = "SELECT * FROM " . APPROVE_USERS_TABLE . " 
						WHERE user_id = " . intval($approve_mod['poster_id']) . " 
						LIMIT 0,1"; 
					if ( !($approve_result = $db->sql_query($approve_sql)) ) 
					{ 
						message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
					} 
					$approve_row = $db->sql_fetchrow($approve_result);
					if ( intval($approve_row['approve_moderate']) == 1 ) 
					{ 
							$poster_rank .= "<br /><a href=\"" .  append_sid("viewtopic." . $phpEx . "?". POST_POST_URL . "=" . $postrow[$i]['post_id'] . "&app_mr=" . $poster_id) . "#" . $postrow[$i]['post_id'] . "\" class='copyright'>[ " . $lang['approve_user_moderate_rem'] . " ]</a>";
					}
					elseif ( intval($approve_row['approve_moderate']) == -1 ) 
					{ 
							$auto_approve="<a href=\"" .  append_sid("viewtopic." . $phpEx . "?". POST_POST_URL . "=" . $postrow[$i]['post_id'] . "&app_ur=" . $poster_id) . "#" . $postrow[$i]['post_id'] . "\" class='copyright'>[ " . $lang['approve_user_auto_approve_rem'] . " ]</a><br /><br />";
					}
					else
					{
						$poster_rank .= "<br /><a href=\"" .  append_sid("viewtopic." . $phpEx . "?". POST_POST_URL . "=" . $postrow[$i]['post_id'] . "&app_ma=" . $poster_id) . "#" . $postrow[$i]['post_id'] . "\" class='copyright'>[ " . $lang['approve_user_moderate'] . " ]</a>";
					}
				}
				if ( $approve_mod['topics_admin_awaiting'] )
				{
					$post_subject .= "<br /><a href=\"" . append_sid("viewtopic." . $phpEx . "?". POST_POST_URL . "=" . $postrow[$i]['post_id'] . "&app_p=" . $postrow[$i]['post_id']) . "#" . $postrow[$i]['post_id'] . "\" class='copyright'>[ " . $lang['approve_topic_approve'] . " ]</a>";
				}
				else 
				if ( $approve_mod['posts_awaiting'] )
				{
					$post_subject .= "<br /><a href=\"" . append_sid("viewtopic." . $phpEx . "?". POST_POST_URL . "=" . $postrow[$i]['post_id'] . "&app_p=" . $postrow[$i]['post_id']) . "#" . $postrow[$i]['post_id'] . "\" class='copyright'>[ " . $lang['approve_post_approve'] . " ]</a>";
				}
			}
			else
			{
				if ( $approve_mod['posts_awaiting'] )
				{
					if ( $approve_mod['forum_hide_unapproved_posts'] && !$approve_mod['topics_awaiting'] ) 
					{
						continue;
					}
					$post_subject = "[ " . $lang['approve_post_is_awaiting'] . " ]";
					$message = $post_subject;
					$quote_img = '';
					$quote = '';
					$poster = ($postrow[$i]['poster_id'] == ANONYMOUS) ? $lang['Guest'] : $poster;
				}
			}
		}
// 
// End Approve_Mod Block : 11
//
    
	/* Warning PCP :: Removed
	if ($card_img)
	{
		$template->assign_block_vars('switch_card_image', array());
	}*/
	
	$template->assign_block_vars('postrow', array(
		'DOWNLOAD_POST' => append_sid("viewtopic.$phpEx?download=".$postrow[$i]['post_id']."&amp;".POST_TOPIC_URL."=".$topic_id),
		'POST_RATING' => $post_rating,
//-- mod : profile cp ------------------------------------------------------------------------------
//-- add
		'POST_ID' => $postrow[$i]['post_id'],
		'AUTHOR_PANEL'	=> $postrow[$i]['user_my_ignore'] ? $ignore_panel : $auto_approve.$author_panel,
		'BUTTONS_PANEL'	=> $buttons_panel,
		'IGNORE_IMG'	=> $ignore_buttons,
//-- fin mod : profile cp --------------------------------------------------------------------------
		'ROW_COLOR' => '#' . $row_color,
		'POSTER_NAME' => $poster,
		'ROW_CLASS' => $row_class,
		'POST_DATE' => $post_date,
		'POST_NUMBER' => ($i + $start + 1),
		'POST_SUBJECT' => smilies_pass($post_subject),
		'MESSAGE' => $message,
		'QUICK_QUOTE' => $quick_quote,
		'PLAIN_MESSAGE' => str_replace(chr(13), '', $plain_message), 
		'SIGNATURE' => $user_sig,
		'EDITED_MESSAGE' => $l_edited_by,

		'MINI_POST_IMG' => $mini_post_img,
		'EDIT_IMG' => $edit_img,
		'EDIT' => $edit,
		'QUOTE_IMG' => $quote_img,
		'QUOTE' => $quote,
		'IP_IMG' => $ip_img,
		'IP' => $ip,
		'DELETE_IMG' => $delpost_img,
		'DELETE' => $delpost,
		'USER_WARNINGS' => $user_warnings,
		'CARD_IMG' => $card_img,
		'CARD_HIDDEN_FIELDS' => $card_hidden,
		'CARD_EXTRA_SPACE' => ($r_card_img || $y_card_img || $g_card_img || $b_card_img) ? ' ' : '',

		'L_MINI_POST_ALT' => $mini_post_alt,

		'U_MINI_POST' => $mini_post_url,
		'U_G_CARD' => $g_card_img, 
		'U_Y_CARD' => $y_card_img, 
		'U_R_CARD' => $r_card_img, 
		'U_B_CARD' => $b_card_img,
		'S_CARD' => append_sid("card.".$phpEx),
		'U_POST_ID' => $postrow[$i]['post_id'])
	);

	$cm_viewtopic->post_vars($postrow[$i],$userdata,$forum_id
	);

	display_post_attachments($postrow[$i]['post_id'], $postrow[$i]['post_attachment']);
		//-- mod : profile cp ------------------------------------------------------------------------------
//-- add
	if ($postrow[$i]['user_my_ignore'])
	{
		$template->assign_block_vars('postrow.switch_buddy_ignore', array());
	}
	else
	{
		$template->assign_block_vars('postrow.switch_no_buddy_ignore', array());
	}
//-- fin mod : profile cp --------------------------------------------------------------------------

}

//-- mod : profile cp ------------------------------------------------------------------------------
//-- add
$template->assign_vars(array(
	'L_IGNORE_CHOOSEN' => $lang['Ignore_choosed'],
	)
);
//-- fin mod : profile cp --------------------------------------------------------------------------

//
// Quick Reply Mod
//
if ( ((!$is_auth['auth_reply']) or ($forum_topic_data['forum_status'] == FORUM_LOCKED) or ($forum_topic_data['topic_status'] == TOPIC_LOCKED)) and ($userdata['user_level'] != ADMIN) )
{
	$quick_reply_form = "";
}
else
{
	if ( $can_watch_topic && $is_watching_topic )
	{
		$notify = 1;
	}
	else
	{
		$notify = $userdata['user_notify'];
	}
	$bbcode_uid = $postrow[$total_posts - 1]['bbcode_uid'];
	$last_poster = $postrow[$total_posts - 1]['username'];
	$last_msg = $postrow[$total_posts - 1]['post_text'];
	$last_msg = str_replace(":1:$bbcode_uid", "", $last_msg);
	$last_msg = str_replace(":u:$bbcode_uid", "", $last_msg);
	$last_msg = str_replace(":o:$bbcode_uid", "", $last_msg);
	$last_msg = str_replace(":$bbcode_uid", "", $last_msg);
	$last_msg = str_replace("'", "&#39;", $last_msg);
	$last_msg = "[QUOTE=\"$last_poster\"]" . $last_msg . "[/QUOTE]";
	$quick_reply_form = "
	<script type='text/javascript'>
                var is_submit = false;
		function checkForm() {
			formErrors = false;
			document.post.message.value = '';
			if (document.post.input.value.length < 2) {
				formErrors = '" . $lang['Empty_message'] . "';
			}
			if (formErrors) {
				alert(formErrors);
				return false;
    		} else if (is_submit) { 
      			alert('Your post is already submitted'); 
                return false;
            } else {
            	is_submit = true;
            }
			if (document.post.quick_quote.checked) {
				document.post.message.value = document.post.last_msg.value;
			}
			document.post.message.value += document.post.input.value;
			return true;
		}
	</script>
	<form action='".append_sid("posting.$phpEx")."' method='post' name='post' onsubmit='return checkForm(this)'>
	<span class='genmed'><b>".$lang['Quick_Reply'].":</b><br />";

	if (!$userdata['session_logged_in'])
	{
		$quick_reply_form .= $lang['Username'] . ":&nbsp;<input class='post' type='text' name='username' size='25' maxlength='25' value='' /><br />";
	}

	$quick_reply_form .= "<textarea name='input' rows='10' cols='80' wrap='virtual' class='post forumline''></textarea><br />
	<input type='checkbox' name='quick_quote' />".$lang['Quote_last']."<br />
	<input type='checkbox' name='attach_sig' checked='checked' />".$lang["Attach_signature"]."<br />
	<input type='hidden' name='mode' value='reply' />
	<input type='hidden' name='sid' value='" . $userdata['session_id'] . "' />
	<input type='hidden' name='t' value='" . $topic_id . "' />
	<input type='hidden' name='message' value='' />
	<input type='hidden' name='notify' value=" . $notify  . " />
	<input type='hidden' name='last_msg' value='" . $last_msg  . "' />
	<input type='submit' name='preview' class='liteoption' value='".$lang['Preview']."' />&nbsp;
	<input type='submit' name='post' class='mainoption' value='".$lang["Submit"]."' />
	</span></form>";
}

$block_width = 0;
if($portal_config['portal_header'])
{
	$block_width = $block_width + $portal_config['header_width'];
}
if($portal_config['portal_tail'])
{
	$block_width = $block_width + $portal_config['footer_width'];
}

$template->assign_vars(array(
	'QUICK_REPLY_FORM' => $quick_reply_form,
	'BLOCK_WIDTH' => $block_width)
);
//
// END Quick Reply Mod
//

$template->assign_vars(array( 
"TELL_LINK" => append_sid("http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?t=$topic_id", true)));

$template->pparse('body');

if(isset($_GET['printertopic']))
{
	$gen_simple_header = 1;
}
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
