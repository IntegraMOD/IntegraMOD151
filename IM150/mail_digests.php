<?php
/***************************************************************************
                                mail_digest.php
                             -------------------
    begin                : Sat Oct 4 2003
    copyright            : (C) 2000 The phpBB Group
    email                : support@phpBB.com


 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

// Originally Written by Mark D. Hamill, mhamill@computer.org
// Currently Authored by Indemnity83, Indemnity83@dormlife.us
// Modified by masterdavid for IntegraMOD, webmaster@integramod.com
// This software is designed to work with IntegraMOD 1.3.x and above


// ----------------------------------------- WARNING ---------------------------------------------- //
// THIS PROGRAM SHOULD BE INVOKED TO RUN AUTOMATICALLY EVERY HOUR BY THE OPERATING SYSTEM USING AN
// OPERATING SYSTEM FEATURE LIKE CRONTAB. SEE BATCH_SCHEDULING.TXT
// ----------------------------------------- WARNING ---------------------------------------------- //

// Warning: this was only tested with MySQL. I don't have access to other databases. However some of 
// the querys are copied from other places within the standard phpBB so they are likley to work. 

// Please report any bugs in the bug tracker here:  http://www.dormlife.us/bugtracker/


//define('IN_PHPBB', true);
if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}
$phpbb_root_path = './';
//include($phpbb_root_path . 'extension.inc');
//include($phpbb_root_path . 'common.'.$phpEx);
include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_digest.' . $phpEx);
include_once($phpbb_root_path . 'includes/functions_digests.'.$phpEx);
include_once($phpbb_root_path . 'includes/bbcode.'.$phpEx);

define('MOD_VERSION','Beta 1.2.0b');

// 
// Define $siteURL
//
$script_path = preg_replace('/^\/?(.*?)\/?$/', "\\1", trim($board_config['script_path'])) . '/';
$server_name = trim($board_config['server_name']);
$server_protocol = ( $board_config['cookie_secure'] ) ? 'https://' : 'http://';
$server_port = ( $board_config['server_port'] <> 80 ) ? ':' . trim($board_config['server_port']) . '/' : '/';
$siteURL = $server_protocol . $server_name . $server_port . $script_path;

//
// Define censored word matches
//
$orig_word = array();
$replacement_word = array();
obtain_word_list($orig_word, $replacement_word);

//
// Gather the list of subscriptions we need to process now
//
$sql = "SELECT u.username, d.* FROM " . DIGEST_TABLE . " d, " . USERS_TABLE . " u WHERE u.user_id = d.user_id";
if ( !($result = $db->sql_query($sql)))
{
	$error_code = TRUE;
	$error = $db->sql_error();
}
$subscription_data = array();
$total_subscriptions = 0;
$current_time = time();
while( $row = $db->sql_fetchrow($result) )
{
	$tsl = (int)$current_time - (int)$row['last_digest'];
	if ( (int)$tsl > ((int)$row['digest_frequency'] * 3600))
	{
		$subscription_data[] = $row;
		$total_subscriptions++;
	}
}
$db->sql_freeresult($result);

//
// Gather an array of all the forums for this board
//
$sql = "SELECT * FROM " . FORUMS_TABLE;
if ( !($result = $db->sql_query($sql, false, 'forum_list')))
{
	$error_code = TRUE;
	$error = $db->sql_error();
}
$forum_data = array();
$total_forums = 0;
while ( $row = $db->sql_fetchrow($result) )
{
	$forum_data[] = $row; 
	$total_forums++;
}
$db->sql_freeresult($result);
//
// Process each users subscription
//
for ( $i = 0 ; $i < $total_subscriptions ; $i++)
{
	//
	// Create a userdata array for this user
	//	
	$userdata = array();
	$userdata = get_userdata($subscription_data[$i]['user_id']);
	init_userprefs($userdata);
	$style = $userdata['user_style'];
	
	// 
	// Setup some variables that are used thoughout this subscription 
	//
	$return_chars = (( $subscription_data[$i]['show_text'] == true ) ? ($subscription_data[$i]['text_length']) : 0 );
	$show_mine = $subscription_data[$i]['show_mine'];
	$send_empty = $subscription_data[$i]['send_on_no_messages'];
	$new_only = $subscription_data[$i]['new_only'];
	$html = (( $subscription_data[$i]['format'] == DIGEST_HTML ) ? true: false );
	$user_lastvisit = $userdata['user_lastvisit'];
	$user_id = $userdata['user_id'];

	//
	// Obtain a list of topic ids which contain
	// posts made since user last visited
	//
	
	// get a from time for the query, we should pull everything newer than this time
	if ( $new_only )
	{
		$user_lastvisit = $userdata['user_lastvisit']; 
		$last_digest = $subscription_data[$i]['last_digest'];
		
		if ( $user_lastvisit > $last_digest )
		{
			$post_time = " AND p.post_time > " . $user_lastvisit;
		}
		else
		{
			$post_time = " AND p.post_time > " . $last_digest;
		}
	}
	else
	{
		$post_time = " AND p.post_time > " . $subscription_data[$i]['last_digest'];
	}
	
	//
	// Find which forums are visible for this user
	//
	$is_auth_ary = array();
	$is_auth_ary = auth_read($userdata);
		
	$authed_forums = array();
	for($j = 0; $j < $total_forums; $j++)
	{
		if ( $is_auth_ary[$forum_data[$j]['forum_id']]['auth_read'] )
		{
			$authed_forums[$j] = $forum_data[$j]['forum_id'];		
		}
	}
	
	//
	// Get the list of forums the user wants to see digests from
	//
	$subscribed_forums = array();
	$sql3 = 'SELECT forum_id
		FROM ' . DIGEST_FORUMS_TABLE . '
		WHERE user_id = ' . $user_id;

	if ( !($result = $db->sql_query($sql3)))
	{
                $error_code = TRUE;
	        $error = $db->sql_error();
		//message_die(GENERAL_ERROR, 'Unable to retrieve list of subscribed forums', '', __LINE__, __FILE__, $sql);
	}
	while ($row = $db->sql_fetchrow($result))
	{
		$subscribed_forums[] = $row['forum_id']; 
	}
	$db->sql_freeresult($result);
	
	// If there are subscribed forums, we only want to see messages for these forums.
	if ( count($subscribed_forums) == 0 ) 
	{ 
		// The subscribed forums table is empty, by design this means
		// the user wants all auth forums.
		$query_forums = $authed_forums;
	}
	else if ( count($subscribed_forums) > 0 )
	{
		$query_forums = array_intersect($authed_forums, $subscribed_forums);
	}
	else
	{	
		$query_forums = array();
	}
	$auth_forums = " AND p.forum_id IN (" . implode(",", $query_forums) . ")";

	// Setup a filter to hide their own posts if thats what they want
	$filter_users = '';
	if ( !$show_mine )
	{
		$filter_users = " AND p.poster_id <> " . $user_id;
	}
	
 $sql = 'SELECT c.cat_order, f.forum_order, f.forum_name, t.topic_views, t.topic_replies, t.topic_title, u.username, p. * , pt. * ' .
        ' FROM ' . CATEGORIES_TABLE . ' c, ' .
            FORUMS_TABLE . ' f, ' .
            TOPICS_TABLE . ' t, ' .
            USERS_TABLE . ' u, ' .
            POSTS_TABLE . ' p, ' .
            POSTS_TEXT_TABLE .  ' pt' .
        ' WHERE c.cat_id = f.cat_id
            AND f.forum_id = t.forum_id
            AND t.topic_id = p.topic_id
            AND p.poster_id = u.user_id
            AND p.post_id = pt.post_id
            AND t.topic_status <> 2 ' .
            $filter_users .
            $post_time .
            $auth_forums . '
            AND t.topic_time <= '.time() .
      ' ORDER BY c.cat_order, f.forum_order, p.post_time ASC';
		
	// echo $user_id . '\'s SQL query looks like this: ' . $sql . '</br>';
	
	if ( !($result = $db->sql_query($sql)) )
	{
		$error_code = TRUE;
		$error = $db->sql_error();
	}
	$topic_data = array();
	while( $row = $db->sql_fetchrow($result) )
	{
		$topic_data[] = $row;
	}
	$db->sql_freeresult($result);

	//
	// Okay, let's build the digest
	//

	// The emailer class does not have the equivalent of the assign_block_vars operation, so the
	// entire digest must be placed inside a variable.
	if ( !($total_topics = count($topic_data)) )
	{
		$msg = "There are no new topics";
	}
	else
	{
		if ( $html ) 
		{
			$msg = "<table class='bodyline' width='100%' border='0' cellspacing='1' cellpadding='2'>
        		<tr>
          			<th width='150' height='25' class='thCornerL' nowrap='nowrap'>" . $lang['Author'] . "</th>
          			<th width='100%' class='thCornerR' nowrap='nowrap'>" . $lang['Message'] . "</th>
		        </tr>";
		}
		else
		{
			$msg = '';
		}
	}
			
	$last_topic = -1;				
	for ($j = 0; $j < $total_topics; $j++)
	{	
		//
		// If the topic_id changes, put a new divider
		//
		if ( $last_topic != $topic_data[$j]['topic_title'] )
		{
			if ( $html ) 
			{
				if ( $topic_data[$j]['topic_status'] == TOPIC_LOCKED )
				{
					$folder_image = $siteURL . preg_replace('/"/', '\'' , $images['folder_locked']);
				}
				else if ( $topic_data[$j]['topic_type'] == POST_ANNOUNCE )
				{
					$folder_image = $siteURL . preg_replace('/"/', '\'' , $images['folder_announce']);

				}
				else if ( $topic_data[$j]['topic_type'] == POST_STICKY )
				{
					$folder_image = $siteURL . preg_replace('/"/', '\'' , $images['folder_sticky']);
				}
				else
				{
					$folder_image = $siteURL . preg_replace('/"/', '\'' , $images['folder']);
				}

				$msg .= "<tr>";
				$msg .= "<td class='cat' colspan='2' height='28'><span class='topictitle'><img src='" . $folder_image . "' align='absmiddle'>&nbsp; " . $lang['Topic'] . ":&nbsp;<a href=" . $siteURL . 'viewtopic.' . $phpEx . '?' . POST_TOPIC_URL . '=' . $topic_data[$j]['topic_id'] . " class='topictitle'>" . $topic_data[$j]['topic_title']. "</a></span></td>";
				$msg .= "</tr>";
			}
			else
			{
				$msg .= "\r\n____________________________________________________________________________\r\n"; 
				$msg .= "\r\n<< TOPIC-" . $lang['topic'] . ' ' . $topic_data[$j]['topic_title'] . ', ' . $siteURL . 'viewtopic.' . $phpEx. '?' . POST_TOPIC_URL . '=' . $topic_data[$j]['topic_id'] . " >>\r\n\r\n";
				$msg .= "____________________________________________________________________________\r\n";           
				$msg .= "\r\n"; 

			}
			$last_topic = $topic_data[$j]['topic_title'];
		}
		else
		{
			if ( $html )
			{
				$msg .= "<tr><td class='spaceRow' colspan='2' height='1'><img src='" . $siteURL . $current_template_images . "/spacer.gif' alt='' width='1' height='1' /></td></tr>";
			}
		}
		
		$message = $topic_data[$j]['post_text'];
		$topic_title = $topic_data[$j]['topic_title'];
		$post_date = create_date($userdata['user_dateformat'], $topic_data[$j]['post_time'], $board_config['board_timezone']);
		
		
		if ( ($return_chars != 0) && $html)
		{
			$bbcode_uid = $topic_data[$j]['bbcode_uid'];
	
			//
			// If the board has HTML off but the post has HTML
			// on then we process it, else leave it alone
			//
        		if ( $return_chars != -1 )
        		{
        			$message = digest_trim_text( $message, $return_chars );
        		}

			if ( !$board_config['allow_html'] )
			{
				if ( $topic_data[$i]['enable_html'] )
				{
					$message = preg_replace('#(<)([\/]?.*?)(>)#is', '&lt;\\2&gt;', $message);
				}
			}

			if ( $bbcode_uid != '' )
			{
				$message = ( $board_config['allow_bbcode'] ) ? bbencode_second_pass($message, $bbcode_uid) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $message);
			}

			$message = make_clickable($message);

			if ($board_config['allow_smilies'] && $topic_data[$j]['enable_smilies'])
			{
				$message = digest_smilies_pass($message, $siteURL);
			}
	
			if ( count($orig_word) )
			{
				$topic_title = preg_replace($orig_word, $replacement_word, $topic_title);
				$post_subject = ( $topic_data[$j]['post_subject'] != "" ) ? preg_replace($orig_word, $replacement_word, $topic_data[$j]['post_subject']) : $topic_title;
				$message = preg_replace($orig_word, $replacement_word, $message);
			}
			else
			{
				$post_subject = ( $topic_data[$j]['post_subject'] != '' ) ? $topic_data[$j]['post_subject'] : $topic_title;
			}

			if ($board_config['allow_smilies'] && $searchset[$i]['enable_smilies'])
			{
				$message = smilies_pass($message);
			}

                        $message = acronym_pass($message);
	
			$message = str_replace("\n", '<br />', $message);
		}
		else if( !$html )
		{
			$message = strip_tags($message);
			$message = preg_replace("/\[.*?:$bbcode_uid:?.*?\]/si", '', $message);
			$message = preg_replace('/\[url\]|\[\/url\]/si', '', $message);
                        $message = preg_replace('/\[google\]|\[\/google\]/si', '', $message);
                        $message = preg_replace('/\[you\]/si', $userdata['username'], $message);
                        if ( $return_chars != -1 )
        		{
        			$message = digest_trim_text( $message, $return_chars );
        		}
                        if ( !$board_config['allow_html'] )
			{
				if ( $topic_data[$i]['enable_html'] )
				{
					$message = preg_replace('#(<)([\/]?.*?)(>)#is', '&lt;\\2&gt;', $message);
				}
			}
                        $message = unhtmlentities($message);
		}
		else
		{
			$message = '';
		}
		
		if ( $html )
		{
				
			$msg .= "<tr>";  
			$msg .= "<td width='150' align='left' valign='top' class='row1' rowspan='2'><span class='name'><b><a href='" . $siteURL . "profile." . $phpEx . '?mode=viewprofile&' . POST_USERS_URL . "=" . $topic_data[$j]['poster_id'] . "'>" . $topic_data[$j]['username'] . "</a></b></span><br />
					<br />
					<span class='postdetails'>" . $lang['Replies'] . ": <b>" . $topic_data[$j]['topic_replies'] . "</b><br />
					" . $lang['Views'] . ": <b>" . $topic_data[$j]['topic_views'] . "</b></span><br />
					</td>";
			$msg .= "<td width='100%' valign='top' class='row1'><img src='" . $siteURL . preg_replace('/"/', '\'' , $images['icon_minipost']) . "' width='12' height='9' border='0' /><span class='postdetails'>" . $lang['Forum'] . ":&nbsp;<b><a href='" . $siteURL . 'viewforum.' . $phpEx. '?' . POST_FORUM_URL . '=' . $topic_data[$j]['forum_id'] . "' class='postdetails'>" . $topic_data[$j]['forum_name'] . "</a></b>&nbsp; &nbsp;" . $lang['Posted'] . ": " . $post_date . ' ' . date("T",$topic_data[$j]['post_time']) . "&nbsp; &nbsp;" . $lang['Subject'] . ": <b><a href=" . $siteURL . 'viewtopic.' . $phpEx . '?' . POST_TOPIC_URL . '=' . $topic_data[$j]['topic_id'] . " class='postdetails'>" . $topic_data[$j]['topic_title']. "</a></b></span></td>";
			$msg .= "</tr>";
			$msg .= "<tr>";
			$msg .= "<td valign='top' class='row1'><span class='gen'>" . $message . "&nbsp;<span class='postdetails'>[ <b><a href='" . $siteURL . 'viewtopic.' . $phpEx . '?' . POST_POST_URL . '=' . $topic_data[$j]['post_id'] . '#' . $topic_data[$j]['post_id'] . "'>" . $lang['Digest_Read_More'] . "</a></b> ]</span>&nbsp;</span></td>";
			$msg .= "</tr>";
		}
		else
		{
			$msg .= $lang['Poster' ] ." " . $topic_data[$j]['username'] . " " .  $lang['Posted'] . " " . $post_date . " " . date("T",$topic_data[$j]['post_time']) .
            ", " . $siteURL . "viewtopic." . $phpEx . "?" . POST_POST_URL . "=" . $topic_data[$j]['post_id'] . "#" . $topic_data[$j]['post_id'] . "\r\n";
            		$msg .= $lang['Message'] . ": " . preg_replace('/\[\S+\]/', '', $message) . "\r\n";
			$msg .= "\r\n------------------------------\r\n"; 
			$msg .= "\r\n"; 
		}
	} // ... topic
	
	if ( $html )
	{
		$msg .= "</table>";
	}
	
	// Send the email if there are messages or if user selected to send email anyhow
	if ($total_topics > 0 || $send_empty ) 
	{
		
		if ( $total_topics <= 0 )
		{
			$msg = $lang['No_new_posts'];
		}
		if (!(is_object($emailer)))
		{
			$emailer = new digest_emailer($board_config['smtp_delivery']);
		}

		if ($html) 
		{
			$emailer->use_template('mail_digests_html',$userdata['user_lang']);
			
			//
			// Set up style
			//
			if ( OVERIDE_THEME )
			{
				$theme = setup_style(DIGEST_THEME);
			}
			else
			{
                        	if ( !$board_config['override_user_style'] )
				{
					if ( $style > 0 )
					{
                                        	$theme = setup_style($style);
					}
					else
					{
						$theme = setup_style($board_config['default_style']);
					}
				}
				else
				{
					$theme = setup_style($board_config['default_style']);
				}
			}
		}
		else 
		{
			$emailer->use_template('mail_digests_text',$userdata['user_lang']);
		}

		$emailer->extra_headers('From: ' . $board_config['sitename'] . ' <' . $board_config['board_email'] . ">\n");

		if ($html) 
		{
			$emailer->extra_headers('MIME-Version: 1.0');
			$emailer->extra_headers('Content-type: text/html; charset=' . ENCODING);
			
			// Add the links to the disclaimer
			$disclaimer = sprintf($lang['digest_disclaimer_html'], 
				$board_config['sitename'], 
				$board_config['sitename'], 
				'<a href="' . $siteURL . 'faq.' . $phpEx . '">',
				'</a>',
				$board_config['sitename'],
				/* Digests PCP :: Altered
				'<a href="' . $siteURL . 'digests.' . $phpEx . '">',*/
				'<a href="' . $siteURL . 'profile.' . $phpEx . '?mode=profil&sub=digests">',
				'</a>',
				'<a href="mailto:' . $board_config['board_email']. '">',
				'</a>'
			);
		}
		else
		{
			$emailer->extra_headers('Content-Type: text/plain; charset=us-ascii');
			
			$disclaimer = sprintf($lang['digest_disclaimer_text'],
				$board_config['sitename'],
				$board_config['sitename'],
				$board_config['sitename']);
		}
		
		$intro = sprintf($lang['digest_introduction'], $board_config['sitename']);

		$emailer->email_address($userdata['user_email']);
		$emailer->set_subject($board_config['sitename'] . ' ' . $lang['digest_subject_line']);
		$emailer->assign_vars(array(
			'L_SITENAME' => $board_config['sitename'],
			'L_SALUTATION' => $lang['digest_salutation'],
			'L_DIGEST_OPTIONS' => $lang['digest_your_digest_options'],
			'L_INTRODUCTION' => $intro,
			'L_FORMAT' => $lang['digest_format'],
			'L_MESSAGE_TEXT' => $lang['digest_show_message_text'],
			'L_MY_MESSAGES' => $lang['digest_show_my_messages'],
			'L_FREQUENCY' => $lang['digest_frequency'],
			'L_NEW_MESSAGES' => $lang['digest_new_only'],
			'L_SEND_DIGEST' => $lang['digest_send_empty'],
			'L_SEND_TIME' => $lang['digest_send'],
			'L_TEXT_LENGTH' => $lang['digest_message_size'],
			'L_OPTIONS' => $lang['digest_options'],
			/* Digest PCP :: Altered
			'U_OPTIONS' => $siteURL . 'digests.'.$phpEx,*/
			'U_OPTIONS' => $siteURL . 'profile.'.$phpEx.'?mode=profil&sub=digests',
			'U_SUPPORT' => DIGEST_SUPPORT,
	
			'SALUTATION' => $userdata['username'],
			'DIGEST_CONTENT' => $msg,
			'DISCLAIMER' => $disclaimer,

			'BOARD_URL' => $siteURL,
			'LINK' => $link_tag,
						
			'FORMAT' => ($subscription_data[$i]['format'] == 1) ? $lang['digest_html'] : $lang['digest_ext'],
			'MESSAGE_TEXT' => ($subscription_data[$i]['show_text']) ? $lang['Yes'] : $lang['No'],
			'MY_MESSAGES' => ($subscription_data[$i]['show_mine']) ? $lang['Yes'] : $lang['No'],			
			'FREQUENCY' => $subscription_data[$i]['digest_frequency'],			
			'NEW_MESSAGES' => ($subscription_data[$i]['new_only']) ? $lang['Yes'] : $lang['No'],			
			'SEND_DIGEST' => ($subscription_data[$i]['send_on_no_messages']) ? $lang['Yes'] : $lang['No'],						
			'TEXT_LENGTH' => ( $subscription_data[$i]['text_length'] == -1 ? 'Full Posts' : $subscription_data[$i]['text_length'] ),
			
			'T_HEAD_THEME' => ereg_replace(".css", "", $theme['head_stylesheet']),
			'T_HEAD_STYLESHEET' => $theme['head_stylesheet'],
			)
		);
		$emailer->send($html);
		$emailer->reset();
	}

	//
	// Update the digests table with the time this digest was sent
	// minus 5 miniutes as a buffer.
	//
	$sql = 'UPDATE ' . DIGEST_TABLE . ' SET ' .
			' last_digest = ' . (time() - 100) .
			' WHERE user_id=' . $user_id;
	if ( !($db->sql_query($sql)) )
	{
		$error_code = TRUE;
		$error = $db->sql_error();
	}

} // ... subscription (user)

?>