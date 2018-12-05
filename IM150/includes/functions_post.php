<?php
/***************************************************************************
 *                            functions_post.php
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

if (!defined('IN_PHPBB'))
{
	die('Hacking attempt');
}

$html_entities_match = array('#&(?!(\#[0-9]+;))#', '#<#', '#>#', '#"#');
$html_entities_replace = array('&amp;', '&lt;', '&gt;', '&quot;');

$unhtml_specialchars_match = array('#&gt;#', '#&lt;#', '#&quot;#', '#&amp;#');
$unhtml_specialchars_replace = array('>', '<', '"', '&');

// start wpm mod by Duvelske (http://www.vitrax.vze.com)
function wpm_send_pm($user_to_id, $wpm_subject, $wpm_message, $send_email)
{
	global $board_config, $swpm_config, $lang, $db, $phpbb_root_path, $phpEx;

	$sql = "SELECT *
		FROM " . USERS_TABLE . " 
		WHERE user_id = " . $user_to_id . "
		AND user_id <> " . ANONYMOUS;
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Tried obtaining data for a non-existent user', '', __LINE__, __FILE__, $sql);
	}
	$usertodata = $db->sql_fetchrow($result);

	// prepare wpm message
	$bbcode_uid = make_bbcode_uid();
	$wpm_message = str_replace("'", "''", $wpm_message);

	if(empty($wpm_message))
	{
		$wpm_message = "Thank you for registering.";
	}
	$wpm_message = prepare_message(trim($wpm_message), 0, 1, 1, $bbcode_uid);

	$msg_time = time();

	// Do inbox limit stuff
	$sql = "SELECT COUNT(privmsgs_id) AS inbox_items, MIN(privmsgs_date) AS oldest_post_time 
		FROM " . PRIVMSGS_TABLE . " 
		WHERE ( privmsgs_type = " . PRIVMSGS_NEW_MAIL . " 
			OR privmsgs_type = " . PRIVMSGS_READ_MAIL . "  
			OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " ) 
			AND privmsgs_to_userid = " . $usertodata['user_id'];
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_MESSAGE, $lang['No_such_user']);
	}

	$sql_priority = ( SQL_LAYER == 'mysql' ) ? 'LOW_PRIORITY' : '';

	if ( $inbox_info = $db->sql_fetchrow($result) )
	{
		if ( $inbox_info['inbox_items'] >= $board_config['max_inbox_privmsgs'] )
		{
			$sql = "DELETE $sql_priority FROM " . PRIVMSGS_TABLE . " 
				WHERE ( privmsgs_type = " . PRIVMSGS_NEW_MAIL . " 
					OR privmsgs_type = " . PRIVMSGS_READ_MAIL . " 
					OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . "  ) 
					AND privmsgs_date = " . $inbox_info['oldest_post_time'] . " 
					AND privmsgs_to_userid = " . $usertodata['user_id'];
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete your oldest privmsgs', '', __LINE__, __FILE__, $sql);
			}
		}
	}

	$sql_info = "INSERT INTO " . PRIVMSGS_TABLE . " (privmsgs_type, privmsgs_subject, privmsgs_from_userid, privmsgs_to_userid, privmsgs_date, privmsgs_ip, privmsgs_enable_html, privmsgs_enable_bbcode, privmsgs_enable_smilies, privmsgs_attach_sig)
		VALUES (" . PRIVMSGS_NEW_MAIL . ", '" . str_replace("\'", "''", $wpm_subject) . "', " . $swpm_config['wpm_userid'] . ", " . $usertodata['user_id'] . ", $msg_time, '$user_ip', 0, 1, 1, 1)";

	if ( !($result = $db->sql_query($sql_info, BEGIN_TRANSACTION)) )
	{
		message_die(GENERAL_ERROR, "Could not insert private message sent info.", "", __LINE__, __FILE__, $sql_info);
	}

	$privmsg_sent_id = $db->sql_nextid();

	$sql = "INSERT INTO " . PRIVMSGS_TEXT_TABLE . " (privmsgs_text_id, privmsgs_bbcode_uid, privmsgs_text)
		VALUES ($privmsg_sent_id, '" . $bbcode_uid . "', '" . str_replace("\'", "''", $wpm_message) . "')";

	if ( !$db->sql_query($sql, END_TRANSACTION) )
	{
		message_die(GENERAL_ERROR, "Could not insert/update private message sent text.", "", __LINE__, __FILE__, $sql_info);
	}

	// Add to the users new pm counter
	$sql = "UPDATE " . USERS_TABLE . "
		SET user_new_privmsg = user_new_privmsg + 1, user_last_privmsg = '9999999999'
		WHERE user_id = " . $usertodata['user_id']; 
	if ( !$status = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not update private message new/read status for user', '', __LINE__, __FILE__, $sql);
	}

	if ( $send_email && $usertodata['user_notify_pm'] && !empty($usertodata['user_email']) && $usertodata['user_active'] )
	{
		$email_headers = 'From: ' . $board_config['board_email'] . "\nReturn-Path: " . $board_config['board_email'] . "\r\n";

		$script_name = preg_replace('/^\/?(.*?)\/?$/', "\\1", trim($board_config['script_path']));
		$script_name = ( $script_name != '' ) ? $script_name . '/privmsg.'.$phpEx : 'privmsg.'.$phpEx;
		$server_name = trim($board_config['server_name']);
		$server_protocol = ( $board_config['cookie_secure'] ) ? 'https://' : 'http://';
		$server_port = ( $board_config['server_port'] <> 80 ) ? ':' . trim($board_config['server_port']) . '/' : '/';

		include($phpbb_root_path . 'includes/emailer.'.$phpEx);
		$emailer = new emailer($board_config['smtp_delivery']);
			
		$emailer->use_template('privmsg_notify', $usertodata['user_lang']);
		$emailer->extra_headers($email_headers);
		$emailer->email_address($usertodata['user_email']);
		$emailer->set_subject(); //$lang['Notification_subject']
			
		$emailer->assign_vars(array(
			'USERNAME' => $usertodata['username'], 
			'SITENAME' => $board_config['sitename'],
			'EMAIL_SIG' => str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']), 

			'U_INBOX' => $server_protocol . $server_name . $server_port . $script_name . '?folder=inbox')
		);

		$emailer->send();
		$emailer->reset();
	}

	return;
}
// end wpm mod
//
// This function will prepare a posted message for
// entry into the database.
//
function prepare_message($message, $html_on, $bbcode_on, $smile_on, $bbcode_uid = 0)
{
	global $board_config, $html_entities_match, $html_entities_replace;

	//
	// Clean up the message
	//
	$message = trim($message);

	if ($html_on)
	{
		// If HTML is on, we try to make it safe
		// This approach is quite agressive and anything that does not look like a valid tag
		// is going to get converted to HTML entities
		$message = stripslashes($message);
		$html_match = '#<[^\w<]*(\w+)((?:"[^"]*"|\'[^\']*\'|[^<>\'"])+)?>#';
		$matches = array();

		$message_split = preg_split($html_match, $message);
		preg_match_all($html_match, $message, $matches);

		$message = '';

		foreach ($message_split as $part)
		{
			$tag = array(array_shift($matches[0]), array_shift($matches[1]), array_shift($matches[2]));
			$message .= preg_replace($html_entities_match, $html_entities_replace, $part) . clean_html($tag);
		}

		$message = addslashes($message);
		if ( strpos($message, '&quot;') !== false)
		{
			$message = str_replace('&quot;', '\&quot;', $message);
		}

		// BUG beta Michaelo #3  
		// Note this code only replaces two characters 
//		$message = str_replace('&quot;', '\"', $message); 
//		$message = str_replace('&amp;', '&', $message); 
	}
	else
	{
		$message = preg_replace($html_entities_match, $html_entities_replace, $message);
	}

	if ( strpos($message, 'script') !== false)
	{
		$message = str_replace ('script', '.script', $message);
	}

	if($bbcode_on && $bbcode_uid != '')
	{
		$message = bbencode_first_pass($message, $bbcode_uid);
	}

	return $message;
}

function unprepare_message($message)
{
	global $unhtml_specialchars_match, $unhtml_specialchars_replace;
	return preg_replace($unhtml_specialchars_match, $unhtml_specialchars_replace, $message);
}

//
// Prepare a message for posting
// 
//-- mod : calendar --------------------------------------------------------------------------------
// here we have added
//	, $topic_calendar_time = 0, $topic_calendar_duration = 0
//-- modify
function prepare_post(&$mode, &$post_data, &$bbcode_on, &$html_on, &$smilies_on, &$error_msg, &$username, &$bbcode_uid, &$subject, &$message, &$poll_title, &$poll_options, &$poll_length, &$max_vote, &$hide_vote, &$tothide_vote, &$topic_desc, $topic_calendar_time = 0, $topic_calendar_duration = 0, $topic_calendar_repeat)
//-- fin mod : calendar ----------------------------------------------------------------------------
{
	global $board_config, $userdata, $lang, $phpEx, $phpbb_root_path;

	// Check username
	if (!empty($username))
	{
		$username = phpbb_clean_username($username);

		if (!$userdata['session_logged_in'] || ($userdata['session_logged_in'] && $username != $userdata['username']))
		{
			include($phpbb_root_path . 'includes/functions_validate.'.$phpEx);

			$result = validate_username($username);
			if ($result['error'])
			{
				$error_msg .= (!empty($error_msg)) ? '<br />' . $result['error_msg'] : $result['error_msg'];
			}
		}
		else
		{
			$username = '';
		}
	}

	// Check subject
	if (!empty($subject))
	{
		$subject = htmlspecialchars(trim($subject));
	}
	else if ($mode == 'newtopic' || ($mode == 'editpost' && $post_data['first_post']))
	{
		$error_msg .= (!empty($error_msg)) ? '<br />' . $lang['Empty_subject'] : $lang['Empty_subject'];
	}

// Check Topic Desciption
if ( !empty($topic_desc) )
   {
      $topic_desc = htmlspecialchars(trim($topic_desc));
   }

	// Check message
	if (!empty($message))
	{
		$bbcode_uid = ($bbcode_on) ? make_bbcode_uid() : '';
		$message = prepare_message(trim($message), $html_on, $bbcode_on, $smilies_on, $bbcode_uid);
	}
	else if ($mode != 'delete' && $mode != 'poll_delete') 
	{
		$error_msg .= (!empty($error_msg)) ? '<br />' . $lang['Empty_message'] : $lang['Empty_message'];
	}
//-- mod : calendar --------------------------------------------------------------------------------
//-- add
	//
	// check calendar date
	//
	if ((!empty($topic_calendar_time)) && ($mode == 'newtopic' || ($mode == 'editpost' && $post_data['first_post'])))
	{
		$year	= intval(date( 'Y', $topic_calendar_time));
		$month	= intval(date( 'm', $topic_calendar_time));
		$day	= intval(date( 'd', $topic_calendar_time));
		if (!checkdate($month, $day, $year))
		{
			$error_msg .= (!empty($error_msg) ? '<br />' : '') . sprintf($lang['Date_error'], $day, $month, $year);
		}
	}
//-- fin mod : calendar ----------------------------------------------------------------------------

	//
	// Handle poll stuff
	//
	if ($mode == 'newtopic' || ($mode == 'editpost' && $post_data['first_post']))
	{
		$poll_length = (isset($poll_length)) ? max(0, ($poll_length+$poll_length_h/24)) : 0;
		$$max_vote = (isset($max_vote)) ? max(0, intval($max_vote)) : 0;
		$$hide_vote = (isset($hide_vote)) ? max(0, intval($hide_vote)) : 0;
		$$tothide_vote = (isset($tothide_vote)) ? max(0, intval($tothide_vote)) : 0;

		if (!empty($poll_title))
		{
			$poll_title = htmlspecialchars(trim($poll_title));
		}

		if(!empty($poll_options))
		{
			$temp_option_text = array();
			while(list($option_id, $option_text) = @each($poll_options))
			{
				$option_text = trim($option_text);
				if (!empty($option_text))
				{
					$temp_option_text[intval($option_id)] = htmlspecialchars($option_text);
				}
			}
			$option_text = $temp_option_text;

			if (count($poll_options) < 2)
			{
				$error_msg .= (!empty($error_msg)) ? '<br />' . $lang['To_few_poll_options'] : $lang['To_few_poll_options'];
			}
			else if (count($poll_options) > $board_config['max_poll_options']) 
			{
				$error_msg .= (!empty($error_msg)) ? '<br />' . $lang['To_many_poll_options'] : $lang['To_many_poll_options'];
			}
			else if ($poll_title == '')
			{
				$error_msg .= (!empty($error_msg)) ? '<br />' . $lang['Empty_poll_title'] : $lang['Empty_poll_title'];
			}
		}
	}

	return;
}

//
// Post a new topic/reply/poll or edit existing post/poll
//
//-- mod : announces -------------------------------------------------------------------------------
// here we have added
//	, $topic_announce_duration = 0
//-- modify
//-- mod : calendar --------------------------------------------------------------------------------
// here we have added
//	, $topic_calendar_time = 0, $topic_calendar_duration = 0
//-- modify
//-- mod : post icon -------------------------------------------------------------------------------
// here we added
//	, $post_icon = 0
//-- modify
function submit_post($mode, &$post_data, &$message, &$meta, &$forum_id, &$topic_id, &$post_id, &$poll_id, &$topic_type, &$bbcode_on, &$html_on, &$smilies_on, &$attach_sig, &$bbcode_uid, $post_username, $post_subject, $post_message, $poll_title, &$poll_options, &$poll_length, &$max_vote, &$hide_vote, &$tothide_vote, $forcetime='', &$topic_desc, &$news_category, $topic_announce_duration = 0, $topic_calendar_time = 0, $topic_calendar_duration = 0, $post_icon = 0, $topic_calendar_repeat)
//-- fin mod : post icon ---------------------------------------------------------------------------
//-- fin mod : calendar ----------------------------------------------------------------------------
//-- fin mod : announces ---------------------------------------------------------------------------
{
	global $board_config, $lang, $db, $phpbb_root_path, $phpEx;
	global $userdata, $user_ip;
	// CrackerTracker v5.x
	global $ctracker_config;
	
	if ( ($mode == 'newtopic' || $mode == 'reply') && ($ctracker_config->settings['spammer_blockmode'] > 0 || $ctracker_config->settings['spam_attack_boost'] == 1) && $userdata['user_level'] != ANONYMOUS )
	{
		include_once($phpbb_root_path . 'ctracker/classes/class_ct_userfunctions.' . $phpEx);
		$login_functions = new ct_userfunctions();
		$login_functions->handle_postings();
		unset($login_functions);
	}

// BEGIN cmx_slash_news_mod
	if( isset( $news_category ) && is_numeric( $news_category ) )
	{
		$news_id = intval( $news_category );
	}
	else
	{
		$news_id = 0;
	}
// END cmx_slash_news_mod

	include($phpbb_root_path . 'includes/functions_search.'.$phpEx);

	$current_time = time();
	$lastposttime = 0;	// MOD: Delayed Topics

	if ($mode == 'newtopic' || $mode == 'reply' || $mode == 'editpost') 
	{
		//
		// Flood control
		//
		$where_sql = ($userdata['user_id'] == ANONYMOUS) ? "poster_ip = '$user_ip'" : 'poster_id = ' . $userdata['user_id'];
		$sql = "SELECT MAX(post_time) AS last_post_time
			FROM " . POSTS_TABLE . "
			WHERE $where_sql";
		if ($result = $db->sql_query($sql))
		{
			if ($row = $db->sql_fetchrow($result))
			{
				if (intval($row['last_post_time']) > 0 && ($current_time - intval($row['last_post_time'])) < intval($board_config['flood_interval']) && intval($row['last_post_time']) < $current_time)
				{
					message_die(GENERAL_MESSAGE, $lang['Flood_Error']);
				}
				$lastposttime = intval($row['last_post_time']);	// MOD: Delayed Topics
			}
		}
	}

	if ($mode == 'editpost')
	{
		remove_search_post($post_id);
	}

	//-----------------------------------------------------------------------------
	// MOD: Delayed Topics

	// If we're not trying to force the time, use the current time...
	$exta = '';
	$delayed = 0;

	$old_forcetime = '';
if ($mode != 'newtopic') { 
        // how do I read from the topic? 
        $myquery = "SELECT topic_time FROM ". TOPICS_TABLE ." WHERE topic_id = $topic_id"; 
        if ($myresult = $db->sql_query($myquery)) { 
            if ($myrow = $db->sql_fetchrow($myresult)) { 
                if ($myrow['topic_time'] > time()) {                     
                    $old_forcetime = $myrow['topic_time']; 
                    $delayed = 1; 
                } 
            } 
        } 
    } 
    if ($forcetime == '') { 
        $forcetime = time(); 
        if ($old_forcetime){ 
            $extra = ", topic_time = $forcetime"; 
        } 
    } else { 
        $delayed = 1; 
        $extra = ", topic_time = $forcetime"; 
    }


	// MOD: Delayed Topics {end}
	//-----------------------------------------------------------------------------


	if ($mode == 'newtopic' || ($mode == 'editpost' && $post_data['first_post']))
	{
		$topic_vote = (!empty($poll_title) && count($poll_options) >= 2) ? 1 : 0;

//-- mod : announces -------------------------------------------------------------------------------
// here we added 
//	topic_announce_duration,
//	$topic_announce_duration,
//
// and
//	, topic_announce_duration = $topic_announce_duration
//-- modify
//-- mod : calendar --------------------------------------------------------------------------------
// here we have added
//	, topic_calendar_time, topic_calendar_duration
//	, $topic_calendar_time, $topic_calendar_duration
// and
//	, topic_calendar_time = $topic_calendar_time, topic_calendar_duration = $topic_calendar_duration
//-- modify
//-- mod : post icon -------------------------------------------------------------------------------
// here we added
//	, topic_icon
//	, $post_icon
//
// and
//	, topic_icon = $post_icon
//-- modify

	// correct timezone and summertime
	if($topic_calendar_time) user2boardtime($topic_calendar_time);
	
		$sql  = ($mode != "editpost") ? "INSERT INTO " . TOPICS_TABLE . " (topic_title, topic_desc, topic_poster, topic_time, forum_id, news_id, topic_status, topic_type, topic_icon, topic_calendar_time, topic_calendar_duration, topic_announce_duration, topic_calendar_repeat, topic_vote) VALUES ('$post_subject', '$topic_desc', " . $userdata['user_id'] . ", $forcetime, $forum_id, $news_id, " . TOPIC_UNLOCKED . ", $topic_type, $post_icon, $topic_calendar_time, $topic_calendar_duration, " . intval($topic_announce_duration) . ", '$topic_calendar_repeat', $topic_vote)" : "UPDATE " . TOPICS_TABLE . " SET topic_title = '$post_subject', topic_desc = '$topic_desc', news_id = $news_id, topic_type = $topic_type, topic_icon=$post_icon, topic_calendar_time = $topic_calendar_time, topic_calendar_duration = $topic_calendar_duration, topic_announce_duration = " . intval($topic_announce_duration) . "$extra, topic_calendar_repeat = '$topic_calendar_repeat'  " . (($post_data['edit_vote'] || !empty($poll_title)) ? ", topic_vote = " . $topic_vote : "") . " WHERE topic_id = $topic_id";
//-- fin mod : post icon ---------------------------------------------------------------------------
//-- fin mod : calendar ----------------------------------------------------------------------------
//-- fin mod : announces ---------------------------------------------------------------------------
		if (!$db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
		}

		if ($mode == 'newtopic')
		{
			$topic_id = $db->sql_nextid();
		}
	}

	//-----------------------------------------------------------------------------
	// MOD: Delayed Topics

	// is our topic a delayed topic?
	$extra = '';
	$post_time = $current_time;

	if ($delayed == 1)
	{
		if ($mode == 'newtopic')
		{
			$extra = ", post_time = $forcetime";
			$post_time = $forcetime;
		}
		else if ($mode == 'reply')
		{
			// post after last post
if($old_forcetime > time()){ 
    $post_time = intval($old_forcetime); 
} else { 
    $post_time = time(); 
}
		}
	}

	// MOD: Delayed Topics {end}
	//-----------------------------------------------------------------------------


	$edited_sql = ($mode == 'editpost' && !$post_data['last_post'] && $post_data['poster_post']) ? ", post_edit_time = $current_time, post_edit_count = post_edit_count + 1 " : "";
//-- mod : post icon -------------------------------------------------------------------------------
// here we added
// , post_icon
// , $post_icon
//
// and
//  , post_icon = $post_icon
//-- modify
	$sql = ($mode != "editpost") ? "INSERT INTO " . POSTS_TABLE . " (topic_id, forum_id, poster_id, post_username, post_time, poster_ip, enable_bbcode, enable_html, enable_smilies, enable_sig, post_icon) VALUES ($topic_id, $forum_id, " . $userdata['user_id'] . ", '$post_username', $post_time, '$user_ip', $bbcode_on, $html_on, $smilies_on, $attach_sig, $post_icon)" : "UPDATE " . POSTS_TABLE . " SET post_username = '$post_username', enable_bbcode = $bbcode_on, enable_html = $html_on, enable_smilies = $smilies_on, enable_sig = $attach_sig, post_icon = $post_icon" . $edited_sql . " $extra WHERE post_id = $post_id";
//-- fin mod : post icon ---------------------------------------------------------------------------
	if (!$db->sql_query($sql, BEGIN_TRANSACTION))
	{
		message_die(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
	}

	if ($mode != 'editpost')
	{
		$post_id = $db->sql_nextid();
	}

	$sql = ($mode != 'editpost') ? "INSERT INTO " . POSTS_TEXT_TABLE . " (post_id, post_subject, bbcode_uid, post_text) VALUES ($post_id, '$post_subject', '$bbcode_uid', '$post_message')" : "UPDATE " . POSTS_TEXT_TABLE . " SET post_text = '$post_message',  bbcode_uid = '$bbcode_uid', post_subject = '$post_subject' WHERE post_id = $post_id";
	if (!$db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
	}

	add_search_words('single', $post_id, stripslashes($post_message), stripslashes($post_subject));

	//
	// Add poll
	// 
	if (($mode == 'newtopic' || ($mode == 'editpost' && $post_data['edit_poll'])) && !empty($poll_title) && count($poll_options) >= 2)
	{
		$sql = (!$post_data['has_poll']) ? "INSERT INTO " . VOTE_DESC_TABLE . " (topic_id, vote_text, vote_start, vote_length, vote_max, vote_hide, vote_tothide) VALUES ($topic_id, '$poll_title', $current_time, " . ($poll_length * 86400) . ", '$max_vote', '$hide_vote', '$tothide_vote')" : "UPDATE " . VOTE_DESC_TABLE . " SET vote_text = '$poll_title', vote_length = " . ($poll_length * 86400) . ", vote_max = '$max_vote', vote_hide = '$hide_vote', vote_tothide = '$tothide_vote' WHERE topic_id = $topic_id";
		if (!$db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
		}

		$delete_option_sql = '';
		$old_poll_result = array();
		if ($mode == 'editpost' && $post_data['has_poll'])
		{
			$sql = "SELECT vote_option_id, vote_result  
				FROM " . VOTE_RESULTS_TABLE . " 
				WHERE vote_id = $poll_id 
				ORDER BY vote_option_id ASC";
			if (!($result = $db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, 'Could not obtain vote data results for this topic', '', __LINE__, __FILE__, $sql);
			}

			while ($row = $db->sql_fetchrow($result))
			{
				$old_poll_result[$row['vote_option_id']] = $row['vote_result'];

				if (!isset($poll_options[$row['vote_option_id']]))
				{
					$delete_option_sql .= ($delete_option_sql != '') ? ', ' . $row['vote_option_id'] : $row['vote_option_id'];
				}
			}
		}
		else
		{
			$poll_id = $db->sql_nextid();
		}

		@reset($poll_options);

		$poll_option_id = 1;
		while (list($option_id, $option_text) = each($poll_options))
		{
			if (!empty($option_text))
			{
				$option_text = str_replace("\'", "''", htmlspecialchars($option_text));
				$poll_result = ($mode == "editpost" && isset($old_poll_result[$option_id])) ? $old_poll_result[$option_id] : 0;

				$sql = ($mode != "editpost" || !isset($old_poll_result[$option_id])) ? "INSERT INTO " . VOTE_RESULTS_TABLE . " (vote_id, vote_option_id, vote_option_text, vote_result) VALUES ($poll_id, $poll_option_id, '$option_text', $poll_result)" : "UPDATE " . VOTE_RESULTS_TABLE . " SET vote_option_text = '$option_text', vote_result = $poll_result WHERE vote_option_id = $option_id AND vote_id = $poll_id";
				if (!$db->sql_query($sql))
				{
					message_die(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
				}
				$poll_option_id++;
			}
		}

		if ($delete_option_sql != '')
		{
			$sql = "DELETE FROM " . VOTE_RESULTS_TABLE . " 
				WHERE vote_option_id IN ($delete_option_sql) 
					AND vote_id = $poll_id";
			if (!$db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, 'Error deleting pruned poll options', '', __LINE__, __FILE__, $sql);
			}
		}
	}
	//-----------------------------------------------------------------------------
	// MOD: Delayed Topics

	// If we modified the forced date, we need to redate the messages to reflect that

if ($delayed && $mode == 'editpost' && $post_data['first_post'] && $old_forcetime != $forcetime) 
    { 
        $sql = "UPDATE " . POSTS_TABLE . " set post_time=$forcetime WHERE forum_id = $forum_id and topic_id = $topic_id";
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Error in redating delayed topic', '', __LINE__, __FILE__, $sql);
		}
	}

	// MOD: Delayed Topics {end}
	//-----------------------------------------------------------------------------

	$cash_message = $GLOBALS['cm_posting']->update_post($mode, $post_data, $forum_id, $topic_id, $post_id, $topic_type, $bbcode_uid, $post_username, $post_message);
	$meta = '<meta http-equiv="refresh" content="3;url=' . append_sid("viewtopic.$phpEx?" . POST_POST_URL . "=" . $post_id) . '#' . $post_id . '">';
//-- mod : cache -----------------------------------------------------------------------------------
//-- add
	board_stats();
	cache_tree(true);
//-- fin mod : cache -------------------------------------------------------------------------------
	$message = $lang['Stored'] . '<br />' . $cash_message . '<br /><br />' . sprintf($lang['Click_view_message'], '<a href="' . append_sid("viewtopic.$phpEx?" . POST_POST_URL . "=" . $post_id) . '#' . $post_id . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_forum'], '<a href="' . append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id") . '">', '</a>');

	return false;
}

//
// Update post stats and details
//
function update_post_stats(&$mode, &$post_data, &$forum_id, &$topic_id, &$post_id, &$user_id) 
{ 
    global $db; 

    // prepare update of topics table 
    // get first poster and first posttime 
    $sql = "SELECT poster_id, post_time 
                        FROM ".POSTS_TABLE." 
                     WHERE topic_id = ".$topic_id." 
              ORDER BY post_time ASC 
                     LIMIT 1 "; 
    if (!($result = $db->sql_query($sql))) { 
        message_die(GENERAL_ERROR, 'Error in fetching first post data', '', __LINE__, __FILE__, $sql); 
    } 
    if ($row = $db->sql_fetchrow($result)) { 
        $topicposter = $row['poster_id']; 
        $topictime = $row['post_time']; 
    } 
    //get replies, firts post and last post 
    $sql = "SELECT count( post_id )-1 AS replies, 
                                 min( post_id )  AS firstpost, 
                                 max( post_id )  AS lastpost 
                        FROM ".POSTS_TABLE." 
                     WHERE topic_id = ".$topic_id; 
    if (!($result = $db->sql_query($sql))) { 
        message_die(GENERAL_ERROR, 'Error in fetching topic posts data', '', __LINE__, __FILE__, $sql); 
    } 
    if ($row = $db->sql_fetchrow($result)) { 
        $replies = $row['replies']; 
        $firstpost = $row['firstpost']; 
        $lastpost = $row['lastpost']; 
    } 
    // extra's only for poll delete 
    if ($mode == 'poll_delete'){ 
        $extra = ', topic_vote = 0'; 
    } 
    if(isset($topicposter) && isset($topictime)){ 
        // update the topics table 
        $sql = "UPDATE " . TOPICS_TABLE . " 
                SET topic_poster = ".$topicposter.", 
                        topic_time = ".$topictime    .", 
                        topic_replies = ".$replies    .", 
                        topic_first_post_id = ".$firstpost    .", 
                        topic_last_post_id  = ".$lastpost ." 
                        ".$extra." 
                WHERE topic_id = ".$topic_id; 
        if (!$db->sql_query($sql)) { 
            message_die(GENERAL_ERROR, 'Error in updating topics', '', __LINE__, __FILE__, $sql); 
        } 
    } 
    // prepare update of forums table 
    // get forum posts and last post 
    $sql = "SELECT count( p.post_id ) AS posts, 
                                 max( p.post_id ) last_post 
                        FROM ".POSTS_TABLE." p 
                                     LEFT OUTER JOIN 
                                 ".APPROVE_POSTS_TABLE." ap 
                                    ON ( p.post_id = ap.post_id ) 
                     WHERE forum_id = ".$forum_id." 
                          AND post_time <= ".time()." 
                         AND ap.post_id is null"; 
    if (!($result = $db->sql_query($sql))) { 
        message_die(GENERAL_ERROR, 'Error in fetching posts data', '', __LINE__, __FILE__, $sql); 
    } 
    $row = $db->sql_fetchrow($result);
    $posts = $row['posts']; 
    $lastpost = $row['last_post']; 
    // get forum topics 
    $sql = "SELECT count( t.topic_id ) AS topics 
                        FROM ".TOPICS_TABLE." t 
                        LEFT OUTER JOIN 
                                 ".APPROVE_POSTS_TABLE." ap 
                                    ON (t.topic_id = ap.topic_id) 
                     WHERE forum_id = ".$forum_id." 
                          AND topic_time < ".time()." 
                         AND ap.post_id is null"; 
    if (!($result = $db->sql_query($sql))) { 
        message_die(GENERAL_ERROR, 'Error in fetching topics data', '', __LINE__, __FILE__, $sql); 
    } 
    if ($row = $db->sql_fetchrow($result)) { 
        $topics = $row['topics']; 
    } else { 
        $topics = 0; 
    } 
    if($lastpost < 1){ 
        $lastpost = 0; 
    } 
    // update the forums table 
	if ($mode != 'poll_delete')
	{
	    $sql = "UPDATE " . FORUMS_TABLE . " 
	            SET forum_posts = ".$posts.", 
	                    forum_topics = ".$topics    .", 
	                    forum_last_post_id = ".$lastpost    ." 
	            WHERE forum_id = ".$forum_id; 
	    if (!$db->sql_query($sql)) { 
	        message_die(GENERAL_ERROR, 'Error in updating forums', '', __LINE__, __FILE__, $sql); 
	    } 
	}
    // only continue the old code if not edit mode 
    $sign = ($mode == 'delete') ? '- 1' : '+ 1'; 
    if ($mode != 'poll_delete' && $mode != 'editpost') 
    { 
        $sql = "UPDATE " . USERS_TABLE . " 
            SET user_posts = user_posts $sign 
            WHERE user_id = $user_id"; 
        if (!$db->sql_query($sql, END_TRANSACTION)) 
        { 
            message_die(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql); 
        } 
    } 
//-- mod : cache -----------------------------------------------------------------------------------
//-- add
	board_stats();
	cache_tree(true);
//-- fin mod : cache -------------------------------------------------------------------------------

    // only continue the old code if not edit mode 
    if ($mode != 'editpost'){ 
        $sql = "SELECT ug.user_id, g.group_id as g_id, u.user_posts, g.group_count, g.group_count_max FROM (" . GROUPS_TABLE . " g, ".USERS_TABLE." u) 
            LEFT JOIN ". USER_GROUP_TABLE." ug ON g.group_id=ug.group_id AND ug.user_id=$user_id 
            WHERE u.user_id=$user_id 
            AND g.group_single_user=0 
            AND g.group_count_enable=1 
            AND g.group_moderator<>$user_id"; 
        if ( !($result = $db->sql_query($sql)) ) 
        { 
            message_die(GENERAL_ERROR, 'Error geting users post stat', '', __LINE__, __FILE__, $sql); 
        } 
        while ($group_data = $db->sql_fetchrow($result)) 
        { 
    $user_already_added = (empty($group_data['user_id'])) ? FALSE : TRUE; 
    $user_add = ($group_data['group_count'] == $group_data['user_posts'] && $user_id!=ANONYMOUS) ? TRUE : FALSE; 
    $user_remove = ($group_data['group_count'] > $group_data['user_posts'] || $group_data['group_count_max'] < $group_data['user_posts']) ? TRUE : FALSE; 
            if ($user_add && !$user_already_added) 
            { 
                //user join a autogroup 
                $sql = "INSERT INTO " . USER_GROUP_TABLE . " (group_id, user_id, user_pending) 
                    VALUES (".$group_data['g_id'].", $user_id, '0')"; 
                if ( !($db->sql_query($sql)) ) 
                { 
                    message_die(GENERAL_ERROR, 'Error insert users, group count', '', __LINE__, __FILE__, $sql); 
                } 
            } else 
            if ( $user_already_added && $user_remove) 
            { 
                //remove user from auto group 
                $sql = "DELETE FROM " . USER_GROUP_TABLE . " 
                    WHERE group_id=".$group_data['g_id']." 
                    AND user_id=$user_id"; 
                if ( !($db->sql_query($sql)) ) 
                { 
                    message_die(GENERAL_ERROR, 'Could not remove users, group count', '', __LINE__, __FILE__, $sql); 
                } 
            } 
        } 
    } 
    return; 
}
//
// Delete a post/poll
//
function delete_post($mode, &$post_data, &$message, &$meta, &$forum_id, &$topic_id, &$post_id, &$poll_id)
{
	global $board_config, $lang, $db, $phpbb_root_path, $phpEx;
	global $userdata, $user_ip;

	if ($mode != 'poll_delete')
	{
		$GLOBALS['cm_posting']->update_delete($mode, $post_data, $forum_id, $topic_id, $post_id);
		include($phpbb_root_path . 'includes/functions_search.'.$phpEx);

		$sql = "DELETE FROM " . POSTS_TABLE . " 
			WHERE post_id = $post_id";
		if (!$db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Error in deleting post', '', __LINE__, __FILE__, $sql);
		}

		$sql = "DELETE FROM " . POSTS_TEXT_TABLE . " 
			WHERE post_id = $post_id";
		if (!$db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Error in deleting post', '', __LINE__, __FILE__, $sql);
		}

		if ($post_data['last_post'])
		{
			if ($post_data['first_post'])
			{
				$forum_update_sql .= ', forum_topics = forum_topics - 1';
				$sql = "DELETE FROM " . TOPICS_TABLE . " 
					WHERE topic_id = $topic_id 
						OR topic_moved_id = $topic_id";
				if (!$db->sql_query($sql))
				{
					message_die(GENERAL_ERROR, 'Error in deleting post', '', __LINE__, __FILE__, $sql);
				}

				$sql = "DELETE FROM " . TOPICS_WATCH_TABLE . "
					WHERE topic_id = $topic_id";
				if (!$db->sql_query($sql))
				{
					message_die(GENERAL_ERROR, 'Error in deleting post', '', __LINE__, __FILE__, $sql);
				}
				$sql = "DELETE FROM " . BOOKMARK_TABLE . "
					WHERE topic_id = $topic_id";
				if ( !$db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Error in deleting post', '', __LINE__, __FILE__, $sql);
				}
			}
		}

		remove_search_post($post_id);
	}

	if ($mode == 'poll_delete' || ($mode == 'delete' && $post_data['first_post'] && $post_data['last_post']) && $post_data['has_poll'] && $post_data['edit_poll'])
	{
		$sql = "DELETE FROM " . VOTE_DESC_TABLE . " 
			WHERE topic_id = $topic_id";
		if (!$db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Error in deleting poll', '', __LINE__, __FILE__, $sql);
		}

		$sql = "DELETE FROM " . VOTE_RESULTS_TABLE . " 
			WHERE vote_id = $poll_id";
		if (!$db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Error in deleting poll', '', __LINE__, __FILE__, $sql);
		}

		$sql = "DELETE FROM " . VOTE_USERS_TABLE . " 
			WHERE vote_id = $poll_id";
		if (!$db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Error in deleting poll', '', __LINE__, __FILE__, $sql);
		}
	}

	if ($mode == 'delete' && $post_data['first_post'] && $post_data['last_post'])
	{
		$meta = '<meta http-equiv="refresh" content="3;url=' . append_sid("viewforum.$phpEx?" . POST_FORUM_URL . '=' . $forum_id) . '">';
		$message = $lang['Deleted'];
	}
	else
	{
		$meta = '<meta http-equiv="refresh" content="3;url=' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . '=' . $topic_id) . '">';
		$message = (($mode == 'poll_delete') ? $lang['Poll_delete'] : $lang['Deleted']) . '<br /><br />' . sprintf($lang['Click_return_topic'], '<a href="' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id") . '">', '</a>');
	}

	$message .=  '<br /><br />' . sprintf($lang['Click_return_forum'], '<a href="' . append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id") . '">', '</a>');
//-- mod : cache -----------------------------------------------------------------------------------
//-- add
	board_stats();
	cache_tree(true);
//-- fin mod : cache -------------------------------------------------------------------------------
	return;
}

//
// Handle user notification on new post
//
function user_notification($mode, &$post_data, &$topic_title, &$forum_id, &$topic_id, &$post_id, &$notify_user)
{
	global $board_config, $lang, $db, $phpbb_root_path, $phpEx;
	global $userdata, $user_ip;

	$current_time = time();

	if ($mode != 'delete')
	{
		if ($mode == 'reply')
		{
			$sql = "SELECT ban_userid 
				FROM " . BANLIST_TABLE;
			if (!($result = $db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, 'Could not obtain banlist', '', __LINE__, __FILE__, $sql);
			}

			$user_id_sql = '';
			while ($row = $db->sql_fetchrow($result))
			{
				if (isset($row['ban_userid']) && !empty($row['ban_userid']))
				{
					$user_id_sql .= ', ' . $row['ban_userid'];
				}
			}

			$sql = "SELECT u.user_id, u.user_email, u.user_lang 
				FROM " . TOPICS_WATCH_TABLE . " tw, " . USERS_TABLE . " u 
				WHERE tw.topic_id = $topic_id 
					AND tw.user_id NOT IN (" . $userdata['user_id'] . ", " . ANONYMOUS . $user_id_sql . ") 
					AND tw.notify_status = " . TOPIC_WATCH_UN_NOTIFIED . " 
					AND u.user_id = tw.user_id";
			if (!($result = $db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, 'Could not obtain list of topic watchers', '', __LINE__, __FILE__, $sql);
			}

			$update_watched_sql = '';
			$bcc_list_ary = array();
			
			if ($row = $db->sql_fetchrow($result))
			{
				// Sixty second limit
				@set_time_limit(60);

				do
				{
					if ($row['user_email'] != '')
					{
						$bcc_list_ary[$row['user_lang']][] = $row['user_email'];
					}
					$update_watched_sql .= ($update_watched_sql != '') ? ', ' . $row['user_id'] : $row['user_id'];
				}
				while ($row = $db->sql_fetchrow($result));

				//
				// Let's do some checking to make sure that mass mail functions
				// are working in win32 versions of php.
				//
				if (preg_match('/[c-z]:\\\.*/i', getenv('PATH')) && !$board_config['smtp_delivery'])
				{
					$ini_val = (@phpversion() >= '4.0.0') ? 'ini_get' : 'get_cfg_var';

					// We are running on windows, force delivery to use our smtp functions
					// since php's are broken by default
					$board_config['smtp_delivery'] = 1;
					$board_config['smtp_host'] = @$ini_val('SMTP');
				}

				if (sizeof($bcc_list_ary))
				{
					include($phpbb_root_path . 'includes/emailer.'.$phpEx);
					$emailer = new emailer($board_config['smtp_delivery']);

					$script_name = preg_replace('/^\/?(.*?)\/?$/', '\1', trim($board_config['script_path']));
					$script_name = ($script_name != '') ? $script_name . '/viewtopic.'.$phpEx : 'viewtopic.'.$phpEx;
					$server_name = trim($board_config['server_name']);
					$server_protocol = ($board_config['cookie_secure']) ? 'https://' : 'http://';
					$server_port = ($board_config['server_port'] <> 80) ? ':' . trim($board_config['server_port']) . '/' : '/';

					$orig_word = array();
					$replacement_word = array();
					obtain_word_list($orig_word, $replacement_word);

					$emailer->from($board_config['board_email']);
					$emailer->replyto($board_config['board_email']);

					$topic_title = (count($orig_word)) ? preg_replace($orig_word, $replacement_word, unprepare_message($topic_title)) : unprepare_message($topic_title);

					@reset($bcc_list_ary);
					while (list($user_lang, $bcc_list) = each($bcc_list_ary))
					{
						$emailer->use_template('topic_notify', $user_lang);
		
						for ($i = 0; $i < count($bcc_list); $i++)
						{
							$emailer->bcc($bcc_list[$i]);
						}

						// The Topic_reply_notification lang string below will be used
						// if for some reason the mail template subject cannot be read 
						// ... note it will not necessarily be in the posters own language!
						$emailer->set_subject($lang['Topic_reply_notification']); 
						
						// This is a nasty kludge to remove the username var ... till (if?)
						// translators update their templates
						$emailer->msg = preg_replace('#[ ]?{USERNAME}#', '', $emailer->msg);

						$emailer->assign_vars(array(
							'EMAIL_SIG' => (!empty($board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']) : '',
							'SITENAME' => $board_config['sitename'],
							'TOPIC_TITLE' => $topic_title, 

							'U_TOPIC' => $server_protocol . $server_name . $server_port . $script_name . '?' . POST_POST_URL . "=$post_id#$post_id",
							'U_STOP_WATCHING_TOPIC' => $server_protocol . $server_name . $server_port . $script_name . '?' . POST_TOPIC_URL . "=$topic_id&unwatch=topic")
						);

						$emailer->send();
						$emailer->reset();
					}
				}
			}
			$db->sql_freeresult($result);

			if ($update_watched_sql != '')
			{
				$sql = "UPDATE " . TOPICS_WATCH_TABLE . "
					SET notify_status = " . TOPIC_WATCH_NOTIFIED . "
					WHERE topic_id = $topic_id
						AND user_id IN ($update_watched_sql)";
				$db->sql_query($sql);
			}
		}

		$sql = "SELECT topic_id 
			FROM " . TOPICS_WATCH_TABLE . "
			WHERE topic_id = $topic_id
				AND user_id = " . $userdata['user_id'];
		if (!($result = $db->sql_query($sql)))
		{
			message_die(GENERAL_ERROR, 'Could not obtain topic watch information', '', __LINE__, __FILE__, $sql);
		}

		$row = $db->sql_fetchrow($result);

		if (!$notify_user && !empty($row['topic_id']))
		{
			$sql = "DELETE FROM " . TOPICS_WATCH_TABLE . "
				WHERE topic_id = $topic_id
					AND user_id = " . $userdata['user_id'];
			if (!$db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, 'Could not delete topic watch information', '', __LINE__, __FILE__, $sql);
			}
		}
		else if ($notify_user && empty($row['topic_id']))
		{
			$sql = "INSERT INTO " . TOPICS_WATCH_TABLE . " (user_id, topic_id, notify_status)
				VALUES (" . $userdata['user_id'] . ", $topic_id, 0)";
			if (!$db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, 'Could not insert topic watch information', '', __LINE__, __FILE__, $sql);
			}
		}
	}
}

//
// Fill smiley templates (or just the variables) with smileys
// Either in a window or inline
//
function generate_smilies($mode, $page_id)
{
	global $db, $board_config, $template, $lang, $images, $theme, $phpEx, $phpbb_root_path;
	global $user_ip, $session_length, $starttime;
	global $userdata;
//-- mod : Advanced Group Color Management -------------------------------------
//-- add
	global $agcm_color;
//-- fin mod : Advanced Group Color Management ---------------------------------
	//-- mod : profile cp ------------------------------------------------------------------------------
//-- add
	global $admin_level, $level_prior;
//-- fin mod : profile cp --------------------------------------------------------------------------

//-- mod : qbar ------------------------------------------------------------------------------------
//-- add
	global $qbar_maps;
//-- fin mod : qbar --------------------------------------------------------------------------------

//-- mod : sub-template ----------------------------------------------------------------------------
//-- add
	global $sub_template_key_image, $sub_templates;
//-- fin mod : sub-template ------------------------------------------------------------------------

	$inline_columns = 4;
	$inline_rows = 5;
	$window_columns = 8;

	if ($mode == 'window')
	{
		$userdata = session_pagestart($user_ip, $page_id);
		init_userprefs($userdata);

		$gen_simple_header = TRUE;

		$page_title = $lang['Emoticons'];
		if ( defined('IN_ADMIN') )
		{
			include('./page_header_admin.'.$phpEx);
		}
		else
		{
			include($phpbb_root_path . 'includes/page_header.'.$phpEx);
		}

		$template->set_filenames(array(
			'smiliesbody' => 'posting_smilies.tpl')
		);
	}
//-- mod : cache -----------------------------------------------------------------------------------
//-- add
	if ( defined('CACHE_SMILIES') )
	{
		@include( $phpbb_root_path . './includes/def_smilies.' . $phpEx );
		if ( empty($smilies) )
		{
			cache_smilies();
			include( $phpbb_root_path . './includes/def_smilies.' . $phpEx );
		}
	}
	if ( empty($smilies) && !defined('CACHE_SMILIES') )
	{
		$smilies = array();
//-- fin mod : cache -------------------------------------------------------------------------------
	$sql = "SELECT emoticon, code, smile_url   
		FROM " . SMILIES_TABLE . " 
		ORDER BY smilies_id";
	if ($result = $db->sql_query($sql))
	{
//-- mod : cache -----------------------------------------------------------------------------------
//-- add
			while ( $row = $db->sql_fetchrow($result) )
			{
				$smilies[] = $row;
			}
		}
	}
	if ( !empty($smilies) )
	{
//-- fin mod : cache -------------------------------------------------------------------------------

		$num_smilies = 0;
		$rowset = array();
//-- mod : cache -----------------------------------------------------------------------------------
//-- delete
//		while ($row = $db->sql_fetchrow($result))
//-- add
		@reset($smilies);
		while ( list($row_id, $row) = @each($smilies) )
//-- fin mod : cache -------------------------------------------------------------------------------
		{
			if (empty($rowset[$row['smile_url']]))
			{
				$rowset[$row['smile_url']]['code'] = str_replace("'", "\\'", str_replace('\\', '\\\\', $row['code']));
				$rowset[$row['smile_url']]['emoticon'] = $row['emoticon'];
				$num_smilies++;
			}
		}

		if ($num_smilies)
		{
			$smilies_count = ($mode == 'inline') ? min(19, $num_smilies) : $num_smilies;
			$smilies_split_row = ($mode == 'inline') ? $inline_columns - 1 : $window_columns - 1;

			$s_colspan = 0;
			$row = 0;
			$col = 0;

			while (list($smile_url, $data) = @each($rowset))
			{
				if (!$col)
				{
					$template->assign_block_vars('smilies_row', array());
				}

				$template->assign_block_vars('smilies_row.smilies_col', array(
					'SMILEY_CODE' => $data['code'],
					'SMILEY_IMG' => $board_config['smilies_path'] . '/' . $smile_url,
					'SMILEY_DESC' => $data['emoticon'])
				);

				$s_colspan = max($s_colspan, $col + 1);

				if ($col == $smilies_split_row)
				{
					if ($mode == 'inline' && $row == $inline_rows - 1)
					{
						break;
					}
					$col = 0;
					$row++;
				}
				else
				{
					$col++;
				}
			}

			if ($mode == 'inline' && $num_smilies > $inline_rows * $inline_columns)
			{
				$template->assign_block_vars('switch_smilies_extra', array());

				$template->assign_vars(array(
					'L_MORE_SMILIES' => $lang['More_emoticons'], 
					'U_MORE_SMILIES' => append_sid("posting.$phpEx?mode=smilies"))
				);
			}

			$template->assign_vars(array(
				'L_EMOTICONS' => $lang['Emoticons'], 
				'L_CLOSE_WINDOW' => $lang['Close_window'], 
				'S_SMILIES_COLSPAN' => $s_colspan)
			);
		}
	}

	if ($mode == 'window')
	{
		$template->pparse('smiliesbody');

		include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
	}
}

/**
* Called from within prepare_message to clean included HTML tags if HTML is
* turned on for that post
* @param array $tag Matching text from the message to parse
*/
function clean_html($tag)
{
	global $board_config;

	if (empty($tag[0]))
	{
		return '';
	}

	$allowed_html_tags = preg_split('/, */', strtolower($board_config['allow_html_tags']));
	$disallowed_attributes = '/^(?:style|on)/i';

	// Check if this is an end tag
	preg_match('/<[^\w\/]*\/[\W]*(\w+)/', $tag[0], $matches);
	if (sizeof($matches))
	{
		if (in_array(strtolower($matches[1]), $allowed_html_tags))
		{
			return  '</' . $matches[1] . '>';
		}
		else
		{
			return  htmlspecialchars('</' . $matches[1] . '>');
		}
	}

	// Check if this is an allowed tag
	if (in_array(strtolower($tag[1]), $allowed_html_tags))
	{
		$attributes = '';
		if (!empty($tag[2]))
		{
			preg_match_all('/[\W]*?(\w+)[\W]*?=[\W]*?(["\'])((?:(?!\2).)*)\2/', $tag[2], $test);
			for ($i = 0; $i < sizeof($test[0]); $i++)
			{
				if (preg_match($disallowed_attributes, $test[1][$i]))
				{
					continue;
				}
				$attributes .= ' ' . $test[1][$i] . '=' . $test[2][$i] . str_replace(array('[', ']'), array('&#91;', '&#93;'), htmlspecialchars($test[3][$i])) . $test[2][$i];
			}
		}
		if (in_array(strtolower($tag[1]), $allowed_html_tags))
		{
			return '<' . $tag[1] . $attributes . '>';
		}
		else
		{
			return htmlspecialchars('<' . $tag[1] . $attributes . '>');
		}
	}
	// Finally, this is not an allowed tag so strip all the attibutes and escape it
	else
	{
		return htmlspecialchars('<' .   $tag[1] . '>');
	}
}

?>
