<?php
/***************************************************************************
 *                             admin_approve.php
 *                                  v1.0.9
 ***************************************************************************/
define('IN_PHPBB', 1);

if ( !empty($setmodules) )
{
	//$module['General']['Configuration'] = "$file?mode=config";
	
	$file = basename(__FILE__);
	$module['approve_admin_approval']['approve_admin_approve_index'] = $file . "";
  //V: disabled, useless
	//$module['approve_admin_approval']['approve_admin_forum_moderation'] = $file . "?mode=f";
	$module['approve_admin_approval']['approve_admin_post_moderation'] = $file . "?mode=p";
	$module['approve_admin_approval']['approve_admin_topic_moderation'] = $file . "?mode=t";
	$module['approve_admin_approval']['approve_admin_user_moderation'] = $file . "?mode=u";

	$module['approve_admin_approval']['approve_admin_forum_moderation'] = "admin_forums.$phpEx";
	return;
}

//
// Number of items to show per page. 10 sounds fun.
//
$approve_per_page = 10;

//
// Let's set the root dir for phpBB
//
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
include($phpbb_root_path . 'includes/functions_selects.'.$phpEx);

@include_once($phpbb_root_path . 'includes/emailer.'.$phpEx);
@include_once($phpbb_root_path . 'includes/functions_post.'.$phpEx);
@include_once($phpbb_root_path . 'includes/bbcode.'.$phpEx);

function approve_mod_pm($type, $id)
{
	global $approve_mod, $db, $board_config, $phpEx, $lang, $phpbb_root_path;

	if ( intval($approve_mod['approve_notify_approval']) != 0 )
	{
		$server_name = trim($board_config['server_name']);
		$server_protocol = ( $board_config['cookie_secure'] ) ? 'https://' : 'http://';
		$server_port = ( $board_config['server_port'] <> 80 ) ? ':' . trim($board_config['server_port']) . '/' : '/';
		$script_name = preg_replace('/^\/?(.*?)\/?$/', "\\1", trim($board_config['script_path']));
		$script_name = ( $script_name != '' ) ? $script_name . '/viewtopic.'.$phpEx : 'viewtopic.'.$phpEx;

		if ( $type == 'app_p' )
		{
			//notify user of post approval
			$approve_sql = "SELECT u.*, p.poster_id 
				FROM " . USERS_TABLE . " u, " . APPROVE_POSTS_TABLE . " p 
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
			$approve_sql = "SELECT u.*, p.post_id, p.topic_id 
				FROM " . USERS_TABLE . " u, " . APPROVE_POSTS_TABLE . " p 
				WHERE p.topic_id = " .  intval($id) . " 
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
			$approve_sql = "SELECT * 
				FROM " . USERS_TABLE . " 
				WHERE user_id = " . intval($id);
			if ( !$approve_result = $db->sql_query($approve_sql) )
			{
				message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
			}
			if ( $approve_row = $db->sql_fetchrow($approve_result) )
			{
				$approve_to[0] = $approve_row;
			}
			switch( $type )
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
		for($i=0; (!empty($approve_to[$i]['user_id'])); $i++)
		{
			if ( intval($approve_to[$i]['user_id']) != ANONYMOUS && !in_array(intval($approve_to[$i]['user_id']), $approve_user_list) )
			{
				$approve_user_list[] = intval($approve_to[$i]['user_id']);

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
					if ( intval($inbox_info['inbox_items']) >= intval($board_config['max_inbox_privmsgs']) && !empty($inbox_info['oldest_post_time']) )
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
						$sql = "DELETE $sql_priority 
							FROM " . PRIVMSGS_TABLE . " 
							WHERE privmsgs_id = $old_privmsgs_id";
						if ( !$db->sql_query($sql) )
						{
							message_die(GENERAL_ERROR, 'Could not delete oldest privmsgs (inbox)'.$sql, '', __LINE__, __FILE__, $sql);
						}
						$sql = "DELETE $sql_priority 
							FROM " . PRIVMSGS_TEXT_TABLE . " 
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
					VALUES (" . PRIVMSGS_NEW_MAIL . ", '" . str_replace("'", "\'", $privmsg_subject) . "', " .  intval($approve_to[$i]['user_id']) . ", " .  intval($approve_to[$i]['user_id']) . ", $msg_time, '0.0.0.0', 1, 1, 1, 0)";
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
				if ( intval($approve_to[$i]['user_notify_pm']) != 0 && !empty($approve_to[$i]['user_email']) && intval($approve_to[$i]['user_active']) != 0 )
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


$template->set_filenames(array(
	"approval_header" => "admin/approve_header.tpl")
);
$template->assign_vars(array(
		"L_APPROVE_INDEX" => $lang['approve_admin_approve_index'],
		"L_POST_MODERATION" => $lang['approve_admin_post_moderation'],
		"L_TOPIC_MODERATION" => $lang['approve_admin_topic_moderation'],
		"L_USER_MODERATION" => $lang['approve_admin_user_moderation'],
		"L_FORUM_MODERATION" => $lang['approve_admin_forum_moderation'],
		"S_APPROVE_INDEX" => append_sid('admin_approve.'.$phpEx),
		"S_POST_MODERATION" => append_sid('admin_approve.'.$phpEx.'?mode=p'),
		"S_TOPIC_MODERATION" => append_sid('admin_approve.'.$phpEx.'?mode=t'),
		"S_USER_MODERATION" => append_sid('admin_approve.'.$phpEx.'?mode=u'),
    // V: changed
		//"S_FORUM_MODERATION" => append_sid('admin_approve.'.$phpEx.'?mode=f')
    "S_FORUM_MODERATION" => append_sid('admin_forums.'.$phpEx),
	)
);
$template->pparse("approval_header");

$mode = ($_GET['mode']) ? $_GET['mode'] : $_POST['mode']; 
$s = ($_GET['s']) ? $_GET['s'] : $_POST['s'];
$p = ($_GET['p']) ? $_GET['p'] : $_POST['p'];
$id =($_GET['id']) ? $_GET['id'] : $_POST['id'];
$submit = ( !empty($_POST['submit']) ) ? true : false;

switch( $mode )
{
	default:
		$modevar['default'] = true;
	break;
	case 'd':
		$modevar['d'] = true;
	break;
	case 'p':
		$modevar['p'] = true;
	break;
	case 't':
		$modevar['t'] = true;
	break;
	case 'u':
		$modevar['u'] = true;
	break;
	case 'f':
		$modevar['f'] = true;
	break;
}
if ( $modevar['default'] == true )
{
		//portal page w/ all info & links
		$template->set_filenames(array(
			"default" => "admin/approve_index.tpl")
		);

		$template->assign_vars(array(
				"L_USERS_AUTO_APROVED" => $lang['approve_admin_users_auto_approved'],
				"L_USERS_MODERATED" => $lang['approve_admin_users_moderated_users'],
				"L_TOPICS_AWAITING" => $lang['approve_admin_topics_awaiting'],
				"L_TOPICS_AUTO_APPROVED" => $lang['approve_admin_topics_auto_approved'],
				"L_TOPICS_MODERATED" => $lang['approve_admin_topics_moderated_topics'],
				"L_POSTS_AWAITING" => $lang['approve_admin_posts_awaiting'],
				"L_FORUMS_MODERATED" => $lang['approve_admin_forums_moderated'],
				"L_POSTS" => $lang['Posts'],
				"L_TOPICS" => $lang['Topics'],
				"L_FORUMS" => $lang['approve_admin_forums'],
				"L_USERS" => $lang['approve_admin_users']
			)
		);

		$approve_sql = "SELECT COUNT(user_id) AS total 
			FROM " . APPROVE_USERS_TABLE . " 
			WHERE approve_moderate = 1";
		if ( !($approve_result = $db->sql_query($approve_sql)) ) 
		{ 
			message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
		}
		$approve_row = $db->sql_fetchrow($approve_result);
		$approve_user_moderated = $approve_row['total'];

		$approve_sql = "SELECT COUNT(user_id) AS total 
			FROM " . APPROVE_USERS_TABLE . " 
			WHERE approve_moderate = -1";
		if ( !($approve_result = $db->sql_query($approve_sql)) ) 
		{ 
			message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
		}
		$approve_row = $db->sql_fetchrow($approve_result);
		$approve_user_auto_approved = $approve_row['total'];

		$approve_sql = "SELECT COUNT(topic_id) AS total 
			FROM " . APPROVE_TOPICS_TABLE . " 
			WHERE approve_moderate = 1";
		if ( !($approve_result = $db->sql_query($approve_sql)) ) 
		{ 
			message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
		}
		$approve_row = $db->sql_fetchrow($approve_result);
		$approve_topic_moderated = $approve_row['total'];

		$approve_sql = "SELECT COUNT(topic_id) AS total 
			FROM " . APPROVE_TOPICS_TABLE . " 
			WHERE approve_moderate = -1";
		if ( !($approve_result = $db->sql_query($approve_sql)) ) 
		{ 
			message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
		}
		$approve_row = $db->sql_fetchrow($approve_result);
		$approve_topic_auto_approved = $approve_row['total'];

		$approve_sql = "SELECT COUNT(post_id) AS total 
			FROM " . APPROVE_POSTS_TABLE . " 
			WHERE is_topic = 1";
		if ( !($approve_result = $db->sql_query($approve_sql)) ) 
		{ 
			message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
		}
		$approve_row = $db->sql_fetchrow($approve_result);
		$approve_topic_awaiting = $approve_row['total'];

		$approve_sql = "SELECT COUNT(post_id) AS total 
			FROM " . APPROVE_POSTS_TABLE . " 
			WHERE is_topic = 0";
		if ( !($approve_result = $db->sql_query($approve_sql)) ) 
		{ 
			message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
		}
		$approve_row = $db->sql_fetchrow($approve_result);
		$approve_post_awaiting = $approve_row['total'];

		$approve_sql = "SELECT COUNT(forum_id) AS total 
			FROM " . APPROVE_FORUMS_TABLE . " 
			WHERE enabled = 1";
		if ( !($approve_result = $db->sql_query($approve_sql)) ) 
		{ 
			message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
		}
		$approve_row = $db->sql_fetchrow($approve_result);
		$approve_forum_moderated = $approve_row['total'];

		$template->assign_vars(array(
				"S_USERS_AUTO_APROVED" => $approve_user_auto_approved,
				"S_USERS_MODERATED" => $approve_user_moderated,
				"S_TOPICS_AWAITING" => $approve_topic_awaiting,
				"S_TOPICS_AUTO_APPROVED" => $approve_topic_auto_approved,
				"S_TOPICS_MODERATED" => $approve_topic_moderated,
				"S_POSTS_AWAITING" => $approve_post_awaiting,
				"S_FORUMS_MODERATED" => $approve_forum_moderated,
			)
		);
		
		$template->pparse("default");
}
if ( $modevar['d'] == true )
{
		$s = ($_GET['s']) ? $_GET['s'] : $_POST['s'];
		$p = ($_GET['p']) ? $_GET['p'] : $_POST['p'];
		$id =($_GET['id']) ? $_GET['id'] : $_POST['id'];
		$submit = ( !empty($_POST['submit']) ) ? true : false;

		$approval_links = '';

		switch ($s)
		{
			case 'td':

				$approve_sql = "SELECT topic_first_post_id 
					FROM " . TOPICS_TABLE . " 
					WHERE topic_id = ". intval($id);
				if ( !($approve_result = $db->sql_query($approve_sql)) ) 
				{ 
					message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
				}
				$approve_row = $db->sql_fetchrow($approve_result);
				if ( !empty($approve_row['topic_first_post_id']) )
				{

					$approve_sql2 = "SELECT * 
						FROM " . APPROVE_POSTS_TABLE . " 
						WHERE topic_id = ". intval($id) ." 
							AND is_topic = '1'";
					if ( !($approve_result2 = $db->sql_query($approve_sql2)) ) 
					{ 
						message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
					}
					$approve_row2 = $db->sql_fetchrow($approve_result2);
					if ( intval($approve_row2['topic_id']) == intval($id) )
					{
						$approval_links .= (!empty($approval_links)) ? " | " : "";
						$approval_links .= '<a href="'.append_sid("admin_approve.$phpEx" . "?mode=t&s=ap&id=" . $id).'">'.$lang['approve_admin_approve_topic'].'</a>';
					}
					
					$approve_sql2 = "SELECT * 
						FROM " . APPROVE_TOPICS_TABLE . " 
						WHERE topic_id = ". intval($id);
					if ( !($approve_result2 = $db->sql_query($approve_sql2)) ) 
					{ 
						message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
					}
					$approve_row2 = $db->sql_fetchrow($approve_result2);
					if ( intval($approve_row2['approve_moderate']) == 1 )
					{
						//moderated
						$approval_links .= (!empty($approval_links)) ? " | " : "";
						$approval_links .= '<a href="'.append_sid("admin_approve.$phpEx" . "?mode=t&s=rm&id=" . $id).'">'.$lang['approve_admin_remove_moderation'].'</a>';
					}
					else
					{
						//not moderated
						$approval_links .= (!empty($approval_links)) ? " | " : "";
						$approval_links .= '<a href="'.append_sid("admin_approve.$phpEx" . "?mode=t&s=am&id=" . $id).'">'.$lang['approve_admin_add_moderated_submit'].'</a>';
					}
					if ( intval($approve_row2['approve_moderate']) == -1 )
					{
						//auto approved
						$approval_links .= (!empty($approval_links)) ? " | " : "";
						$approval_links .= '<a href="'.append_sid("admin_approve.$phpEx" . "?mode=t&s=ra&id=" . $id).'">'.$lang['approve_admin_remove_approval'].'</a>';
					}
					else
					{
						//not auto approved
						$approval_links .= (!empty($approval_links)) ? " | " : "";
						$approval_links .= '<a href="'.append_sid("admin_approve.$phpEx" . "?mode=t&s=aa&id=" . $id).'">'.$lang['approve_admin_add_approved_submit'].'</a>';
					}

					$template->assign_vars(array(
						"S_APPROVE" => $approval_links
						)
					);

					$id = intval($approve_row['topic_first_post_id']);
				}
				else
				{
					$id = 0;
				}
			break;

			case 'pd':
				if ( !empty($id) )
				{
					$approval_links = '<a href="'.append_sid("admin_approve.$phpEx" . "?mode=p&s=ap&id=" . $id).'">'.$lang['approve_admin_approve_post'].'</a>';
					$template->assign_vars(array(
						"S_APPROVE" => $approval_links
						)
					);
				}
				else
				{
					$id = 0;
				}
			break;

			case 'ud':
				if ( !empty($id) )
				{
				}
				else
				{
					$id = 0;
				}
			break;
		}

		if ( $s == 'ud' )
		{
			//user detail page
			if ( empty($id) || intval($id) == ANONYMOUS )
			{
				message_die(GENERAL_MESSAGE, $lang['No_user_id_specified']);
			}

			$sql = "SELECT * 
				FROM " . USERS_TABLE . " 
				WHERE user_id = $id 
					AND user_id <> " . ANONYMOUS;
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Tried obtaining data for a non-existent user', '', __LINE__, __FILE__, $sql);
			}
			$profiledata = $db->sql_fetchrow($result);

			$sql = "SELECT *
				FROM " . RANKS_TABLE . "
				ORDER BY rank_special, rank_min";
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not obtain ranks information', '', __LINE__, __FILE__, $sql);
			}
			while ( $row = $db->sql_fetchrow($result) )
			{
				$ranksrow[] = $row;
			}
			$db->sql_freeresult($result);

			//
			// Output page header and profile_view template
			//
			$template->set_filenames(array(
				'detail' => 'profile_view_body.tpl')
			);
			//make_jumpbox('viewforum.'.$phpEx);

			//
			// Calculate the number of days this user has been a member ($memberdays)
			// Then calculate their posts per day
			//
			$regdate = $profiledata['user_regdate'];
			$memberdays = max(1, round( ( time() - $regdate ) / 86400 ));
			$posts_per_day = $profiledata['user_posts'] / $memberdays;

			// Get the users percentage of total posts
			if ( intval($profiledata['user_posts']) != 0  )
			{
				$total_posts = get_db_stat('postcount');
				$percentage = ( $total_posts ) ? min(100, ($profiledata['user_posts'] / $total_posts) * 100) : 0;
			}
			else
			{
				$percentage = 0;
			}

			$avatar_img = '';
			if ( !empty($profiledata['user_avatar_type']) && intval($profiledata['user_allowavatar']) != 0 )
			{
				switch( $profiledata['user_avatar_type'] )
				{
					case USER_AVATAR_UPLOAD:
						$avatar_img = ( $board_config['allow_avatar_upload'] ) ? '<img src="../' . $board_config['avatar_path'] . '/' . $profiledata['user_avatar'] . '" alt="" border="0" />' : '';
						break;
					case USER_AVATAR_REMOTE:
						$avatar_img = ( $board_config['allow_avatar_remote'] ) ? '<img src="../' . $profiledata['user_avatar'] . '" alt="" border="0" />' : '';
						break;
					case USER_AVATAR_GALLERY:
						$avatar_img = ( $board_config['allow_avatar_local'] ) ? '<img src="../' . $board_config['avatar_gallery_path'] . '/' . $profiledata['user_avatar'] . '" alt="" border="0" />' : '';
						break;
				}
			}

			$poster_rank = '';
			$rank_image = '';
			if ( intval($profiledata['user_rank']) != 0 )
			{
				for($i = 0; $i < count($ranksrow); $i++)
				{
					if ( $profiledata['user_rank'] == $ranksrow[$i]['rank_id'] && $ranksrow[$i]['rank_special'] )
					{
						$poster_rank = $ranksrow[$i]['rank_title'];
						$rank_image = ( $ranksrow[$i]['rank_image'] ) ? '<img src="../' . $ranksrow[$i]['rank_image'] . '" alt="' . $poster_rank . '" title="' . $poster_rank . '" border="0" /><br />' : '';
					}
				}
			}
			else
			{
				for($i = 0; $i < count($ranksrow); $i++)
				{
					if ( $profiledata['user_posts'] >= $ranksrow[$i]['rank_min'] && !$ranksrow[$i]['rank_special'] )
					{
						$poster_rank = $ranksrow[$i]['rank_title'];
						$rank_image = ( $ranksrow[$i]['rank_image'] ) ? '<img src="../' . $ranksrow[$i]['rank_image'] . '" alt="' . $poster_rank . '" title="' . $poster_rank . '" border="0" /><br />' : '';
					}
				}
			}

			$temp_url = append_sid("privmsg.$phpEx?mode=post&amp;" . POST_USERS_URL . "=" . $profiledata['user_id']);
			$pm_img = '<a href="' . $temp_url . '"><img src="../' . $images['icon_pm'] . '" alt="' . $lang['Send_private_message'] . '" title="' . $lang['Send_private_message'] . '" border="0" /></a>';
			$pm = '<a href="../' . $temp_url . '">' . $lang['Send_private_message'] . '</a>';

			$email_uri = ( $board_config['board_email_form'] ) ? append_sid("profile.$phpEx?mode=email&amp;" . POST_USERS_URL .'=' . $profiledata['user_id']) : 'mailto:' . $profiledata['user_email'];

			$email_img = '<a href="' . $email_uri . '"><img src="../' . $images['icon_email'] . '" alt="' . $lang['Send_email'] . '" title="' . $lang['Send_email'] . '" border="0" /></a>';
			$email = '<a href="' . $email_uri . '">' . $lang['Send_email'] . '</a>';

			$www_img = ( $profiledata['user_website'] ) ? '<a href="' . $profiledata['user_website'] . '" target="_userwww"><img src="../' . $images['icon_www'] . '" alt="' . $lang['Visit_website'] . '" title="' . $lang['Visit_website'] . '" border="0" /></a>' : '&nbsp;';
			$www = ( $profiledata['user_website'] ) ? '<a href="' . $profiledata['user_website'] . '" target="_userwww">' . $profiledata['user_website'] . '</a>' : '&nbsp;';

			if ( !empty($profiledata['user_icq']) )
			{
				$icq_status_img = '<a href="http://wwp.icq.com/' . $profiledata['user_icq'] . '#pager"><img src="http://web.icq.com/whitepages/online?icq=' . $profiledata['user_icq'] . '&img=5" width="18" height="18" border="0" /></a>';
				$icq_img = '<a href="http://wwp.icq.com/scripts/search.dll?to=' . $profiledata['user_icq'] . '"><img src="../' . $images['icon_icq'] . '" alt="' . $lang['ICQ'] . '" title="' . $lang['ICQ'] . '" border="0" /></a>';
				$icq =  '<a href="http://wwp.icq.com/scripts/search.dll?to=' . $profiledata['user_icq'] . '">' . $lang['ICQ'] . '</a>';
			}
			else
			{
				$icq_status_img = '&nbsp;';
				$icq_img = '&nbsp;';
				$icq = '&nbsp;';
			}

			$aim_img = ( $profiledata['user_aim'] ) ? '<a href="aim:goim?screenname=' . $profiledata['user_aim'] . '&amp;message=Hello+Are+you+there?"><img src="../' . $images['icon_aim'] . '" alt="' . $lang['AIM'] . '" title="' . $lang['AIM'] . '" border="0" /></a>' : '&nbsp;';
			$aim = ( $profiledata['user_aim'] ) ? '<a href="aim:goim?screenname=' . $profiledata['user_aim'] . '&amp;message=Hello+Are+you+there?">' . $lang['AIM'] . '</a>' : '&nbsp;';

			$msn_img = ( $profiledata['user_msnm'] ) ? $profiledata['user_msnm'] : '&nbsp;';
			$msn = $msn_img;

			$yim_img = ( $profiledata['user_yim'] ) ? '<a href="http://edit.yahoo.com/config/send_webmesg?.target=' . $profiledata['user_yim'] . '&amp;.src=pg"><img src="../' . $images['icon_yim'] . '" alt="' . $lang['YIM'] . '" title="' . $lang['YIM'] . '" border="0" /></a>' : '';
			$yim = ( $profiledata['user_yim'] ) ? '<a href="http://edit.yahoo.com/config/send_webmesg?.target=' . $profiledata['user_yim'] . '&amp;.src=pg">' . $lang['YIM'] . '</a>' : '';

			$temp_url = append_sid("search.$phpEx?search_author=" . urlencode($profiledata['username']) . "&amp;showresults=posts");
			$search_img = '<a href="../' . $temp_url . '"><img src="../' . $images['icon_search'] . '" alt="' . sprintf($lang['Search_user_posts'], $profiledata['username'])  . '" title="' . sprintf($lang['Search_user_posts'], $profiledata['username'])  . '" border="0" /></a>';
			$search = '<a href="../' . $temp_url . '">' . sprintf($lang['Search_user_posts'], $profiledata['username'])  . '</a>';

			//
			// Generate page
			//

			$template->assign_vars(array(
				'USERNAME' => $profiledata['username'],
				'JOINED' => create_date($lang['DATE_FORMAT'], $profiledata['user_regdate'], $board_config['board_timezone']),
				'POSTER_RANK' => $poster_rank,
				'RANK_IMAGE' => $rank_image,
				'POSTS_PER_DAY' => $posts_per_day,
				'POSTS' => $profiledata['user_posts'],
				'PERCENTAGE' => $percentage . '%', 
				'POST_DAY_STATS' => sprintf($lang['User_post_day_stats'], $posts_per_day), 
				'POST_PERCENT_STATS' => sprintf($lang['User_post_pct_stats'], $percentage), 
				'SEARCH_IMG' => $search_img,
				'SEARCH' => $search,
				'PM_IMG' => $pm_img,
				'PM' => $pm,
				'EMAIL_IMG' => $email_img,
				'EMAIL' => $email,
				'WWW_IMG' => $www_img,
				'WWW' => $www,
				'ICQ_STATUS_IMG' => $icq_status_img,
				'ICQ_IMG' => $icq_img, 
				'ICQ' => $icq, 
				'AIM_IMG' => $aim_img,
				'AIM' => $aim,
				'MSN_IMG' => $msn_img,
				'MSN' => $msn,
				'YIM_IMG' => $yim_img,
				'YIM' => $yim,

				'LOCATION' => ( $profiledata['user_from'] ) ? $profiledata['user_from'] : '&nbsp;',
				'OCCUPATION' => ( $profiledata['user_occ'] ) ? $profiledata['user_occ'] : '&nbsp;',
				'INTERESTS' => ( $profiledata['user_interests'] ) ? $profiledata['user_interests'] : '&nbsp;',
				'AVATAR_IMG' => $avatar_img,

				'L_VIEWING_PROFILE' => sprintf($lang['Viewing_user_profile'], $profiledata['username']), 
				'L_ABOUT_USER' => sprintf($lang['About_user'], $profiledata['username']), 
				'L_AVATAR' => $lang['Avatar'], 
				'L_POSTER_RANK' => $lang['Poster_rank'], 
				'L_JOINED' => $lang['Joined'], 
				'L_TOTAL_POSTS' => $lang['Total_posts'], 
				'L_SEARCH_USER_POSTS' => sprintf($lang['Search_user_posts'], $profiledata['username']), 
				'L_CONTACT' => $lang['Contact'],
				'L_EMAIL_ADDRESS' => $lang['Email_address'],
				'L_EMAIL' => $lang['Email'],
				'L_PM' => $lang['Private_Message'],
				'L_ICQ_NUMBER' => $lang['ICQ'],
				'L_YAHOO' => $lang['YIM'],
				'L_AIM' => $lang['AIM'],
				'L_MESSENGER' => $lang['MSNM'],
				'L_WEBSITE' => $lang['Website'],
				'L_LOCATION' => $lang['Location'],
				'L_OCCUPATION' => $lang['Occupation'],
				'L_INTERESTS' => $lang['Interests'],
				'U_SEARCH_USER' => append_sid("../search.$phpEx?search_author=" . urlencode($profiledata['username'])),
				'S_PROFILE_ACTION' => append_sid("../profile.$phpEx"))
			);
			$template->pparse('detail');
		}
		else if ( intval($id) != 0 && $s == 'pd' || $s == 'td' )
		{
		
			//detail page for a post/topic to approve, auto-approve if topic, moderate if topic, etc.
			$template->set_filenames(array(
				"detail" => "admin/approve_detail.tpl")
			);

		    $template->assign_vars(array(
					"L_USERS_AUTO_APROVED" => $lang['approve_admin_users_auto_approved'],
					"L_USERS_MODERATED" => $lang['approve_admin_users_moderated_users'],
					"L_TOPICS_AWAITING" => $lang['approve_admin_topics_awaiting'],
					"L_TOPICS_AUTO_APPROVED" => $lang['approve_admin_topics_auto_approved'],
					"L_TOPICS_MODERATED" => $lang['approve_admin_topics_moderated_topics'],
					"L_POSTS_AWAITING" => $lang['approve_admin_posts_awaiting'],
					"L_FORUMS_MODERATED" => $lang['approve_admin_forums_moderated'],
					"L_POSTS" => $lang['Posts'],
					"L_TOPICS" => $lang['Topics'],
					"L_FORUMS" => $lang['approve_admin_forums'],
					"L_USERS" => $lang['approve_admin_users'],
				)
			);

			$approve_sql = "SELECT u.username, u.user_id, u.user_posts, u.user_from, u.user_website, u.user_email, u.user_icq, u.user_aim, u.user_yim, u.user_regdate, u.user_msnm, u.user_viewemail, u.user_rank, u.user_sig, u.user_sig_bbcode_uid, u.user_avatar, u.user_avatar_type, u.user_allowavatar, u.user_allowsmile, p.*,  pt.post_text, pt.post_subject, pt.bbcode_uid, t.topic_title, t.topic_id, f.forum_name, t.topic_vote
				FROM " . POSTS_TABLE . " p, " . USERS_TABLE . " u, " . POSTS_TEXT_TABLE . " pt, " . TOPICS_TABLE . " t, " . FORUMS_TABLE . " f
				WHERE p.post_id = " . intval($id) . "
					AND pt.post_id = p.post_id
					AND u.user_id = p.poster_id
					AND t.topic_id = p.topic_id
					AND f.forum_id = p.forum_id";
			if ( !($approve_result = $db->sql_query($approve_sql)) )
			{
				message_die(GENERAL_ERROR, "Could not obtain post/user information.", '', __LINE__, __FILE__, $sql);
			}
			if ( $postrow = $db->sql_fetchrow($approve_result) )
			{
				//var_dump($postrow);
				//exit();
	
				//
				//fix path
				//
				$board_config['smilies_path'] = "../" . $board_config['smilies_path'];
				$topic_id = $postrow['topic_id'];
				$forum_id = $postrow['forum_id'];

				//
				// Post, reply and other URL generation for
				// templating vars
				//
				
				//show the post to the admin
				$template->assign_vars(array(
					'FORUM_ID' => $postrow['forum_id'],
					'FORUM_NAME' => $postrow['forum_name'],
					'TOPIC_ID' => $postrow['topic_id'],
					'TOPIC_TITLE' => $postrow['topic_title'],
					'L_AUTHOR' => $lang['Author'],
					'L_MESSAGE' => $lang['Message'],
					'L_POSTED' => $lang['Posted'],
					'L_POST_SUBJECT' => $lang['Post_subject'],
					'L_BACK_TO_TOP' => $lang['Back_to_top'],
					'L_DISPLAY_POSTS' => $lang['Display_posts'],
					'U_VIEW_TOPIC' => append_sid("../viewtopic.$phpEx?" . POST_POST_URL . "=" . $postrow['post_id']) . "#" . $postrow['post_id'],
					'U_VIEW_FORUM' => append_sid("../viewforum.$phpEx?" . POST_FORUM_URL . "=" . $postrow['forum_id'])
					)
				);

				//
				// Does this topic contain a poll?
				//
				if ( !empty($postrow['topic_vote']) )
				{
					$s_hidden_fields = '';

					$sql = "SELECT vd.vote_id, vd.vote_text, vd.vote_start, vd.vote_length, vr.vote_option_id, vr.vote_option_text, vr.vote_result
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

						$template->set_filenames(array(
							'pollbox' => 'viewtopic_poll_ballot.tpl')
						);

						for($i = 0; $i < $vote_options; $i++)
						{
							if ( count($orig_word) )
							{
								$vote_info[$i]['vote_option_text'] = preg_replace($orig_word, $replacement_word, $vote_info[$i]['vote_option_text']);
							}

							$template->assign_block_vars("poll_option", array(
								'POLL_OPTION_ID' => $vote_info[$i]['vote_option_id'],
								'POLL_OPTION_CAPTION' => $vote_info[$i]['vote_option_text'])
							);
						}

						$template->assign_vars(array(
							'L_SUBMIT_VOTE' => $lang['Submit_vote'],
							'L_VIEW_RESULTS' => $lang['View_results'],

							'U_VIEW_RESULTS' => append_sid("../viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;postdays=$post_days&amp;postorder=$post_order&amp;vote=viewresult"))
						);

						$s_hidden_fields = '<input type="hidden" name="topic_id" value="' . $topic_id . '" /><input type="hidden" name="mode" value="vote" />';


						if ( count($orig_word) )
						{
							$vote_title = preg_replace($orig_word, $replacement_word, $vote_title);
						}

						$s_hidden_fields = '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';

						$template->assign_vars(array(
							'POLL_QUESTION' => $vote_title,

							'S_HIDDEN_FIELDS' => $s_hidden_fields,
							'S_POLL_ACTION' => append_sid("../posting.$phpEx?mode=vote&amp;" . POST_TOPIC_URL . "=$topic_id"))
						);

						$template->assign_var_from_handle('POLL_DISPLAY', 'pollbox');
					}
				}

				$poster = ( $postrow['user_id'] == ANONYMOUS ) ? $lang['Guest'] : $postrow['username'];
				$post_date = create_date($board_config['default_dateformat'], $postrow['post_time'], $board_config['board_timezone']);
				$poster_posts = ( $postrow['user_id'] != ANONYMOUS ) ? $lang['Posts'] . ': ' . $postrow['user_posts'] : '';
				$poster_from = ( $postrow['user_from'] && $postrow['user_id'] != ANONYMOUS ) ? $lang['Location'] . ': ' . $postrow['user_from'] : '';
				$poster_joined = ( $postrow['user_id'] != ANONYMOUS ) ? $lang['Joined'] . ': ' . create_date($lang['DATE_FORMAT'], $postrow['user_regdate'], $board_config['board_timezone']) : '';
				$poster_avatar = '';
				if ( $postrow['user_avatar_type'] && $postrow['user_id'] != ANONYMOUS && $postrow['user_allowavatar'] )
				{
					switch( $postrow['user_avatar_type'] )
					{
						case USER_AVATAR_UPLOAD:
							$poster_avatar = ( $board_config['allow_avatar_upload'] ) ? '<img src="../' . $board_config['avatar_path'] . '/' . $postrow['user_avatar'] . '" alt="" border="0" />' : '';
							break;
						case USER_AVATAR_REMOTE:
							$poster_avatar = ( $board_config['allow_avatar_remote'] ) ? '<img src="../' . $postrow['user_avatar'] . '" alt="" border="0" />' : '';
							break;
						case USER_AVATAR_GALLERY:
							$poster_avatar = ( $board_config['allow_avatar_local'] ) ? '<img src="../' . $board_config['avatar_gallery_path'] . '/' . $postrow['user_avatar'] . '" alt="" border="0" />' : '';
							break;
					}
				}

				//
				// Generate ranks, set them to empty string initially.
				//
				$poster_rank = '';
				$rank_image = '';
				if ( intval($postrow['user_id']) == ANONYMOUS )
				{
				}
				else if ( $postrow['user_rank'] )
				{
					for($j = 0; $j < count($ranksrow); $j++)
					{
						if ( $postrow['user_rank'] == $ranksrow[$j]['rank_id'] && $ranksrow[$j]['rank_special'] )
						{
							$poster_rank = $ranksrow[$j]['rank_title'];
							$rank_image = ( $ranksrow[$j]['rank_image'] ) ? '<img src="../' . $ranksrow[$j]['rank_image'] . '" alt="' . $poster_rank . '" title="' . $poster_rank . '" border="0" /><br />' : '';
						}
					}
				}
				else
				{
					for($j = 0; $j < count($ranksrow); $j++)
					{
						if ( $postrow['user_posts'] >= $ranksrow[$j]['rank_min'] && !$ranksrow[$j]['rank_special'] )
						{
							$poster_rank = $ranksrow[$j]['rank_title'];
							$rank_image = ( $ranksrow[$j]['rank_image'] ) ? '<img src="../' . $ranksrow[$j]['rank_image'] . '" alt="' . $poster_rank . '" title="' . $poster_rank . '" border="0" /><br />' : '';
						}
					}
				}

				//
				// Handle anon users posting with usernames
				//
				if ( intval($postrow['user_id']) == ANONYMOUS && $postrow['post_username'] != '' )
				{
					$poster = $postrow['post_username'];
					$poster_rank = $lang['Guest'];
				}

				$temp_url = '';

				if ( intval($postrow['user_id']) != ANONYMOUS )
				{
					$temp_url = append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=".$postrow['user_id']);
					$profile_img = '<a href="../' . $temp_url . '"><img src="../' . $images['icon_profile'] . '" alt="' . $lang['Read_profile'] . '" title="' . $lang['Read_profile'] . '" border="0" /></a>';
					$profile = '<a href="' . $temp_url . '">' . $lang['Read_profile'] . '</a>';

					$temp_url = append_sid("privmsg.$phpEx?mode=post&amp;" . POST_USERS_URL . "=".$postrow['user_id']);
					$pm_img = '<a href="../' . $temp_url . '"><img src="../' . $images['icon_pm'] . '" alt="' . $lang['Send_private_message'] . '" title="' . $lang['Send_private_message'] . '" border="0" /></a>';
					$pm = '<a href="../' . $temp_url . '">' . $lang['Send_private_message'] . '</a>';

					if ( !empty($postrow['user_viewemail']) || $is_auth['auth_mod'] )
					{
						$email_uri = ( $board_config['board_email_form'] ) ? append_sid("profile.$phpEx?mode=email&amp;" . POST_USERS_URL .'=' . $postrow['user_id']) : 'mailto:' . $postrow['user_email'];

						$email_img = '<a href="' . $email_uri . '"><img src="../' . $images['icon_email'] . '" alt="' . $lang['Send_email'] . '" title="' . $lang['Send_email'] . '" border="0" /></a>';
						$email = '<a href="' . $email_uri . '">' . $lang['Send_email'] . '</a>';
					}
					else
					{
						$email_img = '';
						$email = '';
					}

					$www_img = ( $postrow['user_website'] ) ? '<a href="' . $postrow['user_website'] . '" target="_userwww"><img src="../' . $images['icon_www'] . '" alt="' . $lang['Visit_website'] . '" title="' . $lang['Visit_website'] . '" border="0" /></a>' : '';
					$www = ( $postrow['user_website'] ) ? '<a href="' . $postrow['user_website'] . '" target="_userwww">' . $lang['Visit_website'] . '</a>' : '';

					if ( !empty($postrow['user_icq']) )
					{
						$icq_status_img = '<a href="http://wwp.icq.com/' . $postrow['user_icq'] . '#pager"><img src="http://web.icq.com/whitepages/online?icq=' . $postrow['user_icq'] . '&img=5" width="18" height="18" border="0" /></a>';
						$icq_img = '<a href="http://wwp.icq.com/scripts/search.dll?to=' . $postrow['user_icq'] . '"><img src="../' . $images['icon_icq'] . '" alt="' . $lang['ICQ'] . '" title="' . $lang['ICQ'] . '" border="0" /></a>';
						$icq =  '<a href="http://wwp.icq.com/scripts/search.dll?to=' . $postrow['user_icq'] . '">' . $lang['ICQ'] . '</a>';
					}
					else
					{
						$icq_status_img = '';
						$icq_img = '';
						$icq = '';
					}

					$aim_img = ( $postrow['user_aim'] ) ? '<a href="aim:goim?screenname=' . $postrow['user_aim'] . '&amp;message=Hello+Are+you+there?"><img src="../' . $images['icon_aim'] . '" alt="' . $lang['AIM'] . '" title="' . $lang['AIM'] . '" border="0" /></a>' : '';
					$aim = ( $postrow['user_aim'] ) ? '<a href="aim:goim?screenname=' . $postrow['user_aim'] . '&amp;message=Hello+Are+you+there?">' . $lang['AIM'] . '</a>' : '';

					$temp_url = append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=".$postrow['user_id']);
					$msn_img = ( $postrow['user_msnm'] ) ? '<a href="../' . $temp_url . '"><img src="../' . $images['icon_msnm'] . '" alt="' . $lang['MSNM'] . '" title="' . $lang['MSNM'] . '" border="0" /></a>' : '';
					$msn = ( $postrow['user_msnm'] ) ? '<a href="../' . $temp_url . '">' . $lang['MSNM'] . '</a>' : '';

					$yim_img = ( $postrow['user_yim'] ) ? '<a href="http://edit.yahoo.com/config/send_webmesg?.target=' . $postrow['user_yim'] . '&amp;.src=pg"><img src="../' . $images['icon_yim'] . '" alt="' . $lang['YIM'] . '" title="' . $lang['YIM'] . '" border="0" /></a>' : '';
					$yim = ( $postrow['user_yim'] ) ? '<a href="http://edit.yahoo.com/config/send_webmesg?.target=' . $postrow['user_yim'] . '&amp;.src=pg">' . $lang['YIM'] . '</a>' : '';
				}
				else
				{
					$profile_img = '';
					$profile = '';
					$pm_img = '';
					$pm = '';
					$email_img = '';
					$email = '';
					$www_img = '';
					$www = '';
					$icq_status_img = '';
					$icq_img = '';
					$icq = '';
					$aim_img = '';
					$aim = '';
					$msn_img = '';
					$msn = '';
					$yim_img = '';
					$yim = '';
				}

				$temp_url = append_sid("posting.$phpEx?mode=quote&amp;" . POST_POST_URL . "=" . $postrow['post_id']);
				$quote_img = '<a href="../' . $temp_url . '"><img src="../' . $images['icon_quote'] . '" alt="' . $lang['Reply_with_quote'] . '" title="' . $lang['Reply_with_quote'] . '" border="0" /></a>';
				$quote = '<a href="../' . $temp_url . '">' . $lang['Reply_with_quote'] . '</a>';

				$temp_url = append_sid("search.$phpEx?search_author=" . urlencode($postrow['username']) . "&amp;showresults=posts");
				$search_img = '<a href="../' . $temp_url . '"><img src="../' . $images['icon_search'] . '" alt="' . sprintf($lang['Search_user_posts'], $postrow['username'])  . '" title="' . sprintf($lang['Search_user_posts'], $postrow['username'])  . '" border="0" /></a>';
				$search = '<a href="../' . $temp_url . '">' . sprintf($lang['Search_user_posts'], $postrow['username'])  . '</a>';

				$temp_url = append_sid("posting.$phpEx?mode=editpost&amp;" . POST_POST_URL . "=" . $postrow['post_id']);
				$edit_img = '<a href="../' . $temp_url . '"><img src="../' . $images['icon_edit'] . '" alt="' . $lang['Edit_delete_post'] . '" title="' . $lang['Edit_delete_post'] . '" border="0" /></a>';
				$edit = '<a href="../' . $temp_url . '">' . $lang['Edit_delete_post'] . '</a>';

				$temp_url = "modcp.$phpEx?mode=ip&amp;" . POST_POST_URL . "=" . $postrow['post_id'] . "&amp;" . POST_TOPIC_URL . "=" . $topic_id . "&amp;sid=" . $userdata['session_id'];
				$ip_img = '<a href="../' . $temp_url . '"><img src="../' . $images['icon_ip'] . '" alt="' . $lang['View_IP'] . '" title="' . $lang['View_IP'] . '" border="0" /></a>';
				$ip = '<a href="../' . $temp_url . '">' . $lang['View_IP'] . '</a>';

				$temp_url = "posting.$phpEx?mode=delete&amp;" . POST_POST_URL . "=" . $postrow['post_id'] . "&amp;sid=" . $userdata['session_id'];
				$delpost_img = '<a href="../' . $temp_url . '"><img src="../' . $images['icon_delpost'] . '" alt="' . $lang['Delete_post'] . '" title="' . $lang['Delete_post'] . '" border="0" /></a>';
				$delpost = '<a href="../' . $temp_url . '">' . $lang['Delete_post'] . '</a>';
				

				$post_subject = ( $postrow['post_subject'] != '' ) ? $postrow['post_subject'] : '';

				$message = $postrow['post_text'];
				$bbcode_uid = $postrow['bbcode_uid'];

				$user_sig = ( $postrow['enable_sig'] && $postrow['user_sig'] != '' && $board_config['allow_sig'] ) ? $postrow['user_sig'] : '';
				$user_sig_bbcode_uid = $postrow['user_sig_bbcode_uid'];

				//
				// Note! The order used for parsing the message _is_ important, moving things around could break any
				// output
				//

				//
				// If the board has HTML off but the post has HTML
				// on then we process it, else leave it alone
				//
				if ( !$board_config['allow_html'] )
				{
					if ( $user_sig != '' && $userdata['user_allowhtml'] )
					{
						$user_sig = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $user_sig);
					}

					if ( $postrow['enable_html'] )
					{
						$message = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $message);
					}
				}

				//
				// Parse message and/or sig for BBCode if reqd
				//
				if ( $board_config['allow_bbcode'] )
				{
					if ( $user_sig != '' && $user_sig_bbcode_uid != '' )
					{
						$user_sig = ( $board_config['allow_bbcode'] ) ? bbencode_second_pass($user_sig, $user_sig_bbcode_uid) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $user_sig);
					}

					if ( $bbcode_uid != '' )
					{
						$message = ( $board_config['allow_bbcode'] ) ? bbencode_second_pass($message, $bbcode_uid) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $message);
					}
				}

				if ( $user_sig != '' )
				{
					$user_sig = make_clickable($user_sig);
				}
				$message = make_clickable($message);

				//
				// Parse smilies
				//
				if ( $board_config['allow_smilies'] )
				{
					if ( $postrow['user_allowsmile'] && $user_sig != '' )
					{
						$user_sig = smilies_pass($user_sig);
					}

					if ( $postrow['enable_smilies'] )
					{
						$message = smilies_pass($message);
					}
				}

				//
				// Highlight active words (primarily for search)
				//
				if ( $highlight_match )
				{
					// This was shamelessly 'borrowed' from volker at multiartstudio dot de
					// via php.net's annotated manual

			//
			//note: i split the ? and > to keep syntax highlighting
			//
					$message = str_replace('\"', '"', substr(preg_replace_callback('#(\>(((? >([^><]+|(?R)))*)\<))#s', function ($matches) use ($highlight_match, $theme) {
						return preg_replace('#\b(' . $highlight_match . ')\b#i', '<span style="color:#"' . $theme['fontcolor3'] . '"><b>\\1</b></span>', $matches[0]);
					}, '>' . $message . '<'), 1, -1));
				}

				//
				// Replace naughty words
				//
				if ( count($orig_word) )
				{
					$post_subject = preg_replace($orig_word, $replacement_word, $post_subject);

					if ( $user_sig != '' )
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
				if ( $user_sig != '' )
				{
					$user_sig = '<br />_________________<br />' . str_replace("\n", "\n<br />\n", $user_sig);
				}

				$message = str_replace("\n", "\n<br />\n", $message);

				//
				// Editing information
				//
				if ( $postrow['post_edit_count'] )
				{
					$l_edit_time_total = ( $postrow['post_edit_count'] == 1 ) ? $lang['Edited_time_total'] : $lang['Edited_times_total'];

					$l_edited_by = '<br /><br />' . sprintf($l_edit_time_total, $poster, create_date($board_config['default_dateformat'], $postrow['post_edit_time'], $board_config['board_timezone']), $postrow['post_edit_count']);
				}
				else
				{
					$l_edited_by = '';
				}

				$template->assign_vars(array(
					'ROW_COLOR' => '#' . $row_color,
					'ROW_CLASS' => 'row1',
					'POSTER_NAME' => $poster,
					'POSTER_RANK' => $poster_rank,
					'RANK_IMAGE' => $rank_image,
					'POSTER_JOINED' => $poster_joined,
					'POSTER_POSTS' => $poster_posts,
					'POSTER_FROM' => $poster_from,
					'POSTER_AVATAR' => $poster_avatar,
					'POST_DATE' => $post_date,
					'POST_SUBJECT' => $post_subject,
					'MESSAGE' => $message,
					'SIGNATURE' => $user_sig,
					'EDITED_MESSAGE' => $l_edited_by,

					'MINI_POST_IMG' => $mini_post_img,
					'PROFILE_IMG' => $profile_img,
					'PROFILE' => $profile,
					'SEARCH_IMG' => $search_img,
					'SEARCH' => $search,
					'PM_IMG' => $pm_img,
					'PM' => $pm,
					'EMAIL_IMG' => $email_img,
					'EMAIL' => $email,
					'WWW_IMG' => $www_img,
					'WWW' => $www,
					'ICQ_STATUS_IMG' => $icq_status_img,
					'ICQ_IMG' => $icq_img,
					'ICQ' => $icq,
					'AIM_IMG' => $aim_img,
					'AIM' => $aim,
					'MSN_IMG' => $msn_img,
					'MSN' => $msn,
					'YIM_IMG' => $yim_img,
					'YIM' => $yim,
					'EDIT_IMG' => $edit_img,
					'EDIT' => $edit,
					'QUOTE_IMG' => $quote_img,
					'QUOTE' => $quote,
					'IP_IMG' => $ip_img,
					'IP' => $ip,
					'DELETE_IMG' => $delpost_img,
					'DELETE' => $delpost,

					'L_MINI_POST_ALT' => $mini_post_alt,

					'U_MINI_POST' => $mini_post_url,
					'U_POST_ID' => $postrow['post_id'])
				);

			}
			$template->pparse("detail");
		}

}
if ( $modevar['u'] == true )
{
		//list of users currently under moderation, list of users auto-approved, paginated
		$template->set_filenames(array(
			"users" => "admin/approve_users.tpl")
		);

		$template->assign_vars(array(
				"L_MODERATED" => $lang['approve_admin_users_moderated_users'],
				"L_REMOVE_MODERATION" => $lang['approve_admin_remove_moderation'],
				"L_AUTO_APPROVED" => $lang['approve_admin_users_auto_approved'],
				"L_REMOVE_APPROVAL" => $lang['approve_admin_remove_approval'],
				"L_REMOVE" => $lang['approve_admin_remove'],
				"L_NEXT" => $lang['Next'],
				"L_PREVIOUS" => $lang['Previous'],
				"S_LINKS" => "",
				"L_APPROVE_BUTTON_FIND" => $lang['approve_admin_button_find'],
				"L_USERNAME" => $lang['approve_admin_username'],
				"L_MODERATION" => $lang['approve_admin_user_moderation'],
				"L_ADD_MODERATED" => $lang['approve_admin_add_moderated_user'],
				"L_ADD_AUTO_APPROVED" => $lang['approve_admin_add_approved_user'],
				"L_PAGE" => $lang['approve_admin_page']
			)
		);

		$template->assign_vars(array(
				"S_MODERATION" => append_sid('admin_approve.'.$phpEx.'?mode=u'),
				"S_MODERATED" => append_sid('admin_approve.'.$phpEx.'?mode=u&s=um'),
				"S_APPROVED" => append_sid('admin_approve.'.$phpEx.'?mode=u&s=ua'),
				"S_ADD_MODERATED" => append_sid('admin_approve.'.$phpEx.'?mode=u&s=am'),
				"S_ADD_APPROVED" => append_sid('admin_approve.'.$phpEx.'?mode=u&s=aa'),
			)
		);

		$s = ($_GET['s']) ? $_GET['s'] : $_POST['s'];
		$p = ($_GET['p']) ? $_GET['p'] : $_POST['p'];
		$id =($_GET['id']) ? $_GET['id'] : $_POST['id'];
		$submit = ( !empty($_POST['submit']) ) ? true : false;

		switch( $s )
		{
			default :
				$approve_mod['um'] = true;
				$approve_mod['ua'] = true;
			break;

			case "um":
				$approve_mod['um'] = true;
				$approve_mod['ua'] = false;
			break;

			case "ua":
				$approve_mod['ua'] = true;
				$approve_mod['um'] = false;
			break;

			case "ra":
				//remove auto-approval
				$approve_mod['ua'] = true;
				$approve_mod['um'] = false;
				
				if ( intval($id) != 0)
				{
					$approve_sql = "SELECT username 
						FROM " . USERS_TABLE . " 
						WHERE user_id = " . intval($id);
					if ( !($approve_result = $db->sql_query($approve_sql)) ) 
					{ 
						message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
					}
					$approve_row = $db->sql_fetchrow($approve_result);
					if ( !empty($approve_row['username']) )
					{
						//notify user of auto approval removal
						$approve_mod['approve_notify_approval'] = true;
						approve_mod_pm("app_ur", intval($id));
						$approve_sql = "DELETE 
							FROM " . APPROVE_USERS_TABLE . " 
							WHERE approve_moderate = -1 
								AND user_id = " . intval($id);
						if ( !($approve_result = $db->sql_query($approve_sql)) ) 
						{ 
							message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
						}
						$template->assign_block_vars("approve_message", array(
								"MESSAGE" => sprintf($lang['approve_admin_users_approval_removed'], $approve_row['username'])
							)
						);
					}
					else
					{
						
						$template->assign_block_vars("approve_message", array(
								"MESSAGE" => sprintf($lang['approve_admin_users_id_remove_error'], $approve_row['username'])
							)
						);
					}
				}
				else
				{
					$template->assign_block_vars("approve_message", array(
							"MESSAGE" => sprintf($lang['approve_admin_users_id_remove_error'], $approve_row['username'])
						)
					);
				}
				break;

			case "rm":
				//remove moderation
				$approve_mod['um'] = true;
				$approve_mod['ua'] = false;

				if ( intval($id) != 0 )
				{
					$approve_sql = "SELECT username 
						FROM " . USERS_TABLE . " 
						WHERE user_id = " . intval($id);
					if ( !($approve_result = $db->sql_query($approve_sql)) ) 
					{ 
						message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
					}
					$approve_row = $db->sql_fetchrow($approve_result);
					if ( !empty($approve_row['username']) )
					{
						//notify user of moderation removal
						approve_mod_pm("app_mr", intval($id));
						$approve_sql = "DELETE 
							FROM " . APPROVE_USERS_TABLE . " 
							WHERE approve_moderate = 1 
								AND user_id = " . intval($id);
						if ( !($approve_result = $db->sql_query($approve_sql)) ) 
						{ 
							message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
						}
						$template->assign_block_vars("approve_message", array(
								"MESSAGE" => sprintf($lang['approve_admin_users_moderation_removed'], $approve_row['username'])
							)
						);
					}
					else
					{
						
						$template->assign_block_vars("approve_message", array(
								"MESSAGE" => sprintf($lang['approve_admin_users_id_remove_error'], $approve_row['username'])
							)
						);
					}
				}
				else
				{
					$template->assign_block_vars("approve_message", array(
							"MESSAGE" => sprintf($lang['approve_admin_users_id_remove_error'], $approve_row['username'])
						)
					);
				}
			break;
			
			case "am":
				$approve_mod['um'] = false;
				$approve_mod['ua'] = false;
				//do add moderated user form, w/ search box

				$template->assign_block_vars("add_approval", array(
					"L_ADD_APPROVAL_USER" => $lang['approve_admin_add_moderated_user'],
					"S_S" => "am",
					"L_APPROVAL" => $lang['approve_admin_add_moderated_submit']
					)
				);

				if ( intval($submit) != 0 )
				{
					$approve_sql = "SELECT username, user_id 
						FROM " . USERS_TABLE . " 
						WHERE username = '" . ( get_magic_quotes_gpc() ? $_POST['username'] : addslashes($_POST['username']) ) . "'";
					if ( !($approve_result = $db->sql_query($approve_sql)) ) 
					{ 
						message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
					}
					$approve_row = $db->sql_fetchrow($approve_result);
					if ( !empty($approve_row['user_id']) )
					{
						//notify user they're being moderated now
						if ( $approve_row['user_id'] != ANONYMOUS )
						{
							approve_mod_pm("app_ma", intval($id));
						}
						$approve_sql = "DELETE 
							FROM " . APPROVE_USERS_TABLE . " 
							WHERE user_id = " . intval($approve_row['user_id']); 
						if ( !($approve_result = $db->sql_query($approve_sql)) ) 
						{ 
							message_die(GENERAL_ERROR, $lang['approve_posts_error_delete'], '', __LINE__, __FILE__, $approve_sql); 
						}
						$approve_sql = "INSERT INTO " . APPROVE_USERS_TABLE . " (user_id, approve_moderate) 
							VALUES (" . intval($approve_row['user_id']) . ", 1)"; 
						if ( !($approve_result = $db->sql_query($approve_sql)) ) 
						{ 
							message_die(GENERAL_ERROR, $lang['approve_posts_error_insert'], '', __LINE__, __FILE__, $approve_sql); 
						}
						$template->assign_block_vars("approve_message", array(
								"MESSAGE" => sprintf($lang['approve_admin_users_moderated_added'], $approve_row['username'])
							)
						);
					}
				}
			break;

			case "aa":
				$approve_mod['ua'] = false;
				$approve_mod['um'] = false;
				//do add moderated user form, w/ search box
				
				$template->assign_block_vars("add_approval", array(
					"L_ADD_APPROVAL_USER" => $lang['approve_admin_add_approved_user'],
					"S_S" => "aa",
					"L_APPROVAL" => $lang['approve_admin_add_approved_submit']
					)
				);

				if ( intval($submit) != 0 )
				{
					$approve_sql = "SELECT username, user_id 
						FROM " . USERS_TABLE . " 
						WHERE username = '" . ( get_magic_quotes_gpc() ? $_POST['username'] : addslashes($_POST['username']) ) . "'";
					if ( !($approve_result = $db->sql_query($approve_sql)) ) 
					{ 
						message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
					}
					$approve_row = $db->sql_fetchrow($approve_result);
					if ( !empty($approve_row['user_id']) )
					{
						//notify user they're being auto-approved now
						if ( $approve_row['user_id'] != ANONYMOUS )
						{
							approve_mod_pm("app_ua", intval($id));
						}
						$approve_sql = "DELETE 
							FROM " . APPROVE_USERS_TABLE . " 
							WHERE user_id = " . intval($approve_row['user_id']); 
						if ( !($approve_result = $db->sql_query($approve_sql)) ) 
						{ 
							message_die(GENERAL_ERROR, $lang['approve_posts_error_delete'], '', __LINE__, __FILE__, $approve_sql); 
						}
						$approve_sql = "INSERT INTO " . APPROVE_USERS_TABLE . " (user_id, approve_moderate) 
							VALUES (" . intval($approve_row['user_id']) . ", -1)"; 
						if ( !($approve_result = $db->sql_query($approve_sql)) ) 
						{ 
							message_die(GENERAL_ERROR, $lang['approve_posts_error_insert'], '', __LINE__, __FILE__, $approve_sql); 
						}
						$approve_sql = "DELETE 
							FROM " . APPROVE_POSTS_TABLE . " 
							WHERE poster_id = " . intval($approve_row['user_id']); 
						if ( !($approve_result = $db->sql_query($approve_sql)) ) 
						{ 
							message_die(GENERAL_ERROR, $lang['approve_posts_error_delete'], '', __LINE__, __FILE__, $approve_sql); 
						}
						$template->assign_block_vars("approve_message", array(
								"MESSAGE" => sprintf($lang['approve_admin_users_approval_added'], $approve_row['username'])
							)
						);
						
					}
				}
			break;

		}

		if ( $approve_mod['um'] == true )
		{

			//list of users currently under moderation, paginated
			$template->assign_block_vars("moderated", array() );


			//
			// Do Pagination
			//
			if ( intval($p) < 1 )
			{
				$approve_page = 1;
			}
			else
			{
				$approve_page = intval($p);
			}
			$approve_sql = "SELECT COUNT(user_id) as approve_count 
				FROM " . APPROVE_USERS_TABLE . " 
				WHERE approve_moderate = 1";
			if ( !($approve_result = $db->sql_query($approve_sql)) ) 
			{ 
				message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
			}
			$approve_row = $db->sql_fetchrow($approve_result);
			$approve_record_count = $approve_row['approve_count'];
			$approve_page_count = ( ($approve_record_count/$approve_per_page) > 1) ? ceil($approve_record_count/$approve_per_page) : 1;
			$approve_firstRec = ($approve_page > 1) ? (($approve_page - 1) * $approve_per_page) : 0;
			$approve_lastRec = ( ($approve_record_count < ($approve_page*$approve_per_page)) ? $approve_record_count : ($approve_page*$approve_per_page)); 
			
			$template->assign_vars(array(
					"L_MODERATED_USERS_OF" => sprintf($lang['approve_admin_users_of'], (($approve_firstRec + 1) > $approve_record_count) ? $approve_record_count : ($approve_firstRec + 1), $approve_lastRec, $approve_record_count )
				)
			);
			if ( intval($approve_page) > 1 )
			{
				$template->assign_block_vars("moderated.moderated_paginate", array(
						"S_LINK" => "<a href=" . append_sid("admin_approve.$phpEx" . "?mode=u&s=um&p=" . ($approve_page - 1)) . ">" . $lang['Previous'] . "</a> | "
					)
				);
			}
			for($i = 1; $i <= intval($approve_page_count); $i++)
			{
				$prev = "";
				$next = ""; 
				if ( $i > 1 )
				{
					$prev = " | "; 
				}
				if ( (intval($i) == intval($approve_page_count)) && (intval($approve_page) < intval($approve_page_count)) )
				{
					$next = " | "; 
				}
				if ( intval($approve_page) == intval($i) )
				{
					$template->assign_block_vars("moderated.moderated_paginate", array(
							"S_LINK" => $prev . "<b>" . $i . "</b>" . $next
						)
					);
				}
				else
				{
					$template->assign_block_vars("moderated.moderated_paginate", array(
							"S_LINK" => $prev . "<a href=" . append_sid("admin_approve.$phpEx" . "?mode=u&s=um&p=" . $i) . ">" . $i . "</a>" . $next
						)
					);
				}
			}
			if ( intval($approve_page) < intval($approve_page_count) )
			{
				$template->assign_block_vars("moderated.moderated_paginate", array(
						"S_LINK" => "<a href=" . append_sid("admin_approve.$phpEx" . "?mode=u&s=um&p=" . ($approve_page + 1)) . ">" . $lang['Next'] . "</a>" 
					)
				);
			}

			//
			// Moderated Users
			//
			$approve_sql = "SELECT * 
				FROM " . APPROVE_USERS_TABLE . " 
				WHERE approve_moderate = 1 
				ORDER BY user_id 
				LIMIT ". intval($approve_firstRec) . ", " . intval($approve_lastRec);
			if ( !($approve_result = $db->sql_query($approve_sql)) ) 
			{ 
				message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
			} 
			$approve_row_class = '';
			while( $approve_row = $db->sql_fetchrow($approve_result) )
			{
				$approve_sql2 = "SELECT username 
					FROM " . USERS_TABLE . " 
					WHERE user_id = " . intval($approve_row['user_id']);
				if ( !($approve_result2 = $db->sql_query($approve_sql2)) ) 
				{ 
					message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql2); 
				}
				if ( $approve_row2 = $db->sql_fetchrow($approve_result2) )
				{
					$approve_row_class = ($approve_row_class == 'row1') ? 'row2' : 'row1';
					$template->assign_block_vars("moderated.moderated_users", array(
							"S_ID" => $approve_row2['user_id'],
							"S_USERNAME" => $approve_row2['username'],
							"S_LINK" => append_sid("admin_approve.$phpEx" . "?mode=d&s=ud&id=" . $approve_row['user_id']),
							"S_REMOVE" => append_sid("admin_approve.$phpEx" . "?mode=u&s=rm&id=" . $approve_row['user_id']),
							"S_ROW" => $approve_row_class
						)
					);
				}
			}
		}

		if ( $approve_mod['ua'] == true )
		{

			//list of users currently auto-approved, paginated
			
			$template->assign_block_vars("approved", array() );

			//
			// Do Pagination
			//
			if ( intval($p) < 1 )
			{
				$approve_page = 1;
			}
			else
			{
				$approve_page = intval($p);
			}
			$approve_sql = "SELECT COUNT(user_id) as approve_count 
				FROM " . APPROVE_USERS_TABLE . " 
				WHERE approve_moderate = -1";
			if ( !($approve_result = $db->sql_query($approve_sql)) ) 
			{ 
				message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
			}
			$approve_row = $db->sql_fetchrow($approve_result);
			
			$approve_record_count = $approve_row['approve_count'];
			$approve_page_count = ( ($approve_record_count/$approve_per_page) > 1) ? ceil($approve_record_count/$approve_per_page) : 1;
			$approve_firstRec = ($approve_page > 1) ? (($approve_page - 1) * $approve_per_page) : 0;
			$approve_lastRec = ( ($approve_record_count < ($approve_page*$approve_per_page)) ? $approve_record_count : ($approve_page*$approve_per_page)); 
			
			$template->assign_vars(array(
					"L_APPROVED_USERS_OF" => sprintf($lang['approve_admin_users_of'], (($approve_firstRec + 1) > $approve_record_count) ? $approve_record_count : ($approve_firstRec + 1), $approve_lastRec, $approve_record_count )
				)
			);
			if ( intval($approve_page) > 1 )
			{
				$template->assign_block_vars("approved.approve_paginate", array(
						"S_LINK" => "<a href=" . append_sid("admin_approve.$phpEx" . "?mode=u&s=ua&p=" . ($approve_page - 1)) . ">" . $lang['Previous'] . "</a> | "
					)
				);
			}
			for($i = 1; $i <= intval($approve_page_count); $i++)
			{
				$prev = "";
				$next = ""; 
				if ( $i > 1 )
				{
					$prev = " | "; 
				}
				if ( (intval($i) == intval($approve_page_count)) && (intval($approve_page) < intval($approve_page_count)) )
				{
					$next = " | "; 
				}
				if ( intval($approve_page) == intval($i) )
				{
					$template->assign_block_vars("approved.approved_paginate", array(
							"S_LINK" => $prev . "<b>" . $i . "</b>" . $next
						)
					);
				}
				else
				{
					$template->assign_block_vars("approved.approved_paginate", array(
							"S_LINK" => $prev . "<a href=" . append_sid("admin_approve.$phpEx" . "?mode=u&s=ua&p=" . $i) . ">" . $i . "</a>" . $next
						)
					);
				}
			}
			if ( intval($approve_page) < intval($approve_page_count) )
			{
				$template->assign_block_vars("approved.approved_paginate", array(
						"S_LINK" => "<a href=" . append_sid("admin_approve.$phpEx" . "?mode=u&s=ua&p=" . ($approve_page + 1)) . ">" . $lang['Next'] . "</a>" 
					)
				);
			}

			//
			// Auto-Approved Users
			//
			$approve_sql = "SELECT * 
				FROM " . APPROVE_USERS_TABLE . " 
				WHERE approve_moderate = -1 
				ORDER BY user_id 
				LIMIT ". intval($approve_firstRec) . ", " . intval($approve_lastRec);
			if ( !($approve_result = $db->sql_query($approve_sql)) ) 
			{ 
				message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
			} 
			$approve_row_class = '';
			while( $approve_row = $db->sql_fetchrow($approve_result) )
			{
				$approve_sql2 = "SELECT username 
					FROM " . USERS_TABLE . " 
					WHERE user_id = " . intval($approve_row['user_id']);
				if ( !($approve_result2 = $db->sql_query($approve_sql2)) ) 
				{ 
					message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql2); 
				}
				if ( $approve_row2 = $db->sql_fetchrow($approve_result2) )
				{
					$approve_row_class = ($approve_row_class == 'row1') ? 'row2' : 'row1';
					$template->assign_block_vars("approved.approved_users", array(
							"S_ID" => $approve_row2['user_id'],
							"S_USERNAME" => $approve_row2['username'],
							"S_LINK" => append_sid("admin_approve.$phpEx" . "?mode=d&s=ud&id=" . $approve_row['user_id']),
							"S_REMOVE" => append_sid("admin_approve.$phpEx" . "?mode=u&s=ra&id=" . $approve_row['user_id']),
							"S_ROW" => $approve_row_class
						)
					);
				}
			}
		}
		$template->pparse("users");
}
if ( $modevar['t'] == true )
{	
		//list of topics currently under moderation, list of topics auto-approved, paginated, searchable
		$template->set_filenames(array(
			"topics" => "admin/approve_topics.tpl")
		);

		$s = ($_GET['s']) ? $_GET['s'] : $_POST['s'];
		$p = ($_GET['p']) ? $_GET['p'] : $_POST['p'];
		$id =($_GET['id']) ? $_GET['id'] : $_POST['id'];
		$submit = ( !empty($_POST['submit']) ) ? true : false;

		$template->assign_vars(array(
				"L_MODERATION" => $lang['approve_admin_topic_moderation'],
				"L_MODERATED_TOPICS" => $lang['approve_admin_topics_moderated_topics'],
				"L_REMOVE_MODERATION" => $lang['approve_admin_remove_moderation'],
				"L_AUTO_APPROVED_TOPICS" => $lang['approve_admin_topics_auto_approved'],
				"L_REMOVE_APPROVAL" => $lang['approve_admin_remove_approval'],
				"L_APPROVE_TOPIC" => $lang['approve_admin_approve_topic'],
				"L_AWAITING_APPROVAL" => $lang['approve_admin_topics_awaiting'],
				"L_REMOVE" => $lang['approve_admin_remove'],
				"L_APPROVE" => $lang['approve_admin_approve'],
				"L_NEXT" => $lang['Next'],
				"L_PREVIOUS" => $lang['Previous'],
				"S_LINKS" => "",
				"L_APPROVE_BUTTON_FIND" => $lang['approve_admin_button_find'],
				"L_TOPIC_TITLE" => $lang['approve_admin_topics_title'],
				"L_PAGE" => $lang['approve_admin_page'],
				"L_AUTHOR" => $lang['approve_admin_author']
			)
		);
		
		$template->assign_vars(array(
				"S_MODERATION" => append_sid('admin_approve.'.$phpEx.'?mode=t'),
				"S_AWAITING" => append_sid('admin_approve.'.$phpEx.'?mode=t&s=at'),
				"S_MODERATED" => append_sid('admin_approve.'.$phpEx.'?mode=t&s=tm'),
				"S_APPROVED" => append_sid('admin_approve.'.$phpEx.'?mode=t&s=ta')
			)
		);
		switch( $s )
		{
			default :
				$approve_mod['tm'] = true;
				$approve_mod['ta'] = true;
				$approve_mod['at'] = true;
			break;

			case "tm":
				$approve_mod['tm'] = true;
				$approve_mod['ta'] = false;
				$approve_mod['at'] = false;
			break;

			case "ta":
				$approve_mod['ta'] = true;
				$approve_mod['tm'] = false;
				$approve_mod['at'] = false;
			break;

			case "at":
				$approve_mod['ta'] = false;
				$approve_mod['tm'] = false;
				$approve_mod['at'] = true;
			break;

			case "ra":
				//remove auto-approval
				$approve_mod['ta'] = true;
				$approve_mod['tm'] = false;
				$approve_mod['at'] = false;
				
				if ( intval($id) != 0 )
				{
					$approve_sql = "SELECT t.topic_title, u.username 
						FROM " . TOPICS_TABLE . " t, " . USERS_TABLE . " u 
						WHERE topic_id = " . intval($id) . " 
							AND u.user_id = t.topic_poster";
					if ( !($approve_result = $db->sql_query($approve_sql)) ) 
					{ 
						message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
					}
					$approve_row = $db->sql_fetchrow($approve_result);
					if ( !empty($approve_row['topic_title']) )
					{
						$approve_sql2 = "DELETE 
							FROM " . APPROVE_TOPICS_TABLE . " 
							WHERE approve_moderate = -1 
							AND topic_id = " . intval($id);
						if ( !($approve_result2 = $db->sql_query($approve_sql2)) ) 
						{ 
							message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql2); 
						}
						$template->assign_block_vars("approve_message", array(
								"MESSAGE" => sprintf($lang['approve_admin_topics_approval_removed'], $approve_row['topic_title'], $approve_row['username'])
							)
						);
					}
					else
					{
						$template->assign_block_vars("approve_message", array(
								"MESSAGE" => $lang['approve_admin_topics_id_remove_error']
							)
						);
					}
				}
				else
				{
					$template->assign_block_vars("approve_message", array(
							"MESSAGE" => $lang['approve_admin_topics_id_remove_error']
						)
					);
				}
				break;

			case "rm":
				//remove moderation
				$approve_mod['tm'] = true;
				$approve_mod['ta'] = false;
				$approve_mod['at'] = false;

				if ( intval($id) != 0 )
				{
					$approve_sql = "SELECT t.topic_title, u.username 
						FROM " . TOPICS_TABLE . " t, " . USERS_TABLE . " u 
						WHERE topic_id = " . intval($id) . " 
							AND u.user_id = t.topic_poster";
					if ( !($approve_result = $db->sql_query($approve_sql)) ) 
					{ 
						message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
					}
					$approve_row = $db->sql_fetchrow($approve_result);
					if ( !empty($approve_row['topic_title']) )
					{
						$approve_sql = "DELETE 
							FROM " . APPROVE_TOPICS_TABLE . " 
							WHERE approve_moderate = 1 
								AND topic_id = " . intval($id);
						if ( !($approve_result = $db->sql_query($approve_sql)) ) 
						{ 
							message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
						}
						$template->assign_block_vars("approve_message", array(
								"MESSAGE" => sprintf($lang['approve_admin_topics_moderation_removed'], $approve_row['topic_title'], $approve_row['username'])
							)
						);
					}
					else
					{
						
						$template->assign_block_vars("approve_message", array(
								"MESSAGE" => $lang['approve_admin_topics_id_remove_error']
							)
						);
					}
				}
				else
				{
					$template->assign_block_vars("approve_message", array(
							"MESSAGE" =>$lang['approve_admin_topics_id_remove_error']
						)
					);
				}
			break;
			
			case "ap":
				//approve topic
				$approve_mod['tm'] = false;
				$approve_mod['ta'] = false;
				$approve_mod['at'] = true;

				if ( intval($id) != 0 )
				{
					$approve_sql = "SELECT a.* 
						FROM " . TOPICS_TABLE . " t, " . APPROVE_FORUMS_TABLE . " a 
						WHERE t.topic_id = " . intval($id) . " 
							AND a.forum_id = t.forum_id";
					if ( !($approve_result = $db->sql_query($approve_sql)) ) 
					{ 
						message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
					}
					$approve_mod = $db->sql_fetchrow($approve_result);
					
					$approve_sql = "SELECT t.topic_title, u.username, t.topic_first_post_id 
						FROM " . TOPICS_TABLE . " t, " . USERS_TABLE . " u 
						WHERE topic_id = " . intval($id) . " 
							AND u.user_id = t.topic_poster";
					if ( !($approve_result = $db->sql_query($approve_sql)) ) 
					{ 
						message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
					}
					$approve_row = $db->sql_fetchrow($approve_result);

					//notify user their topic has been approved
					approve_mod_pm("app_p", intval($approve_row['topic_first_post_id']));

					$approve_sql = "DELETE 
						FROM " . APPROVE_POSTS_TABLE . " 
						WHERE topic_id = " . intval($id) . " 
							AND is_topic = 1"; 
					if ( !($approve_result = $db->sql_query($approve_sql)) ) 
					{ 
						message_die(GENERAL_ERROR, $lang['approve_posts_error_delete'], '', __LINE__, __FILE__, $approve_sql); 
					}
					$template->assign_block_vars("approve_message", array(
							"MESSAGE" => sprintf($lang['approve_admin_topics_approved'], $approve_row['topic_title'], $approve_row['username'])
						)
					);
				}
				else
				{
					$template->assign_block_vars("approve_message", array(
							"MESSAGE" => $lang['approve_admin_topics_id_remove_error']
						)
					);
				}
			break;
			
			case "am":
				$approve_mod['tm'] = true;
				$approve_mod['ta'] = false;
				$approve_mod['at'] = false;
				//add moderation to this topic


				$approve_sql = "SELECT t.topic_title, u.username 
					FROM " . TOPICS_TABLE . " t, " . USERS_TABLE . " u 
					WHERE topic_id = " . intval($id) . " 
						AND u.user_id = t.topic_poster";
				if ( !($approve_result = $db->sql_query($approve_sql)) ) 
				{ 
					message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
				}
				$approve_row = $db->sql_fetchrow($approve_result);

				if ( !empty($approve_row['topic_title']) )
				{
					//pm notify user that topic is being moderated now
					//approve_mod_pm("app_ma", intval($approve_row['user_id']));
					$approve_sql = "DELETE 
						FROM " . APPROVE_TOPICS_TABLE . " 
						WHERE topic_id = " . intval($id); 
					if ( !($approve_result = $db->sql_query($approve_sql)) ) 
					{ 
						message_die(GENERAL_ERROR, $lang['approve_posts_error_delete'], '', __LINE__, __FILE__, $approve_sql); 
					}
					$approve_sql = "INSERT INTO " . APPROVE_TOPICS_TABLE . " (topic_id, approve_moderate) 
						VALUES (" . intval($id) . ", 1)"; 
					if ( !($approve_result = $db->sql_query($approve_sql)) ) 
					{ 
						message_die(GENERAL_ERROR, $lang['approve_posts_error_insert'], '', __LINE__, __FILE__, $approve_sql); 
					}
					$template->assign_block_vars("approve_message", array(
							"MESSAGE" => sprintf($lang['approve_admin_topics_moderated_added'], $approve_row['topic_title'])
						)
					);
				}
			break;

			case "aa":
				$approve_mod['tm'] = false;
				$approve_mod['ta'] = true;
				$approve_mod['at'] = false;
				//add auto-approval to this topic
				
				$approve_sql = "SELECT t.topic_title, u.username 
					FROM " . TOPICS_TABLE . " t, " . USERS_TABLE . " u 
					WHERE topic_id = " . intval($id) . " 
						AND u.user_id = t.topic_poster";
				if ( !($approve_result = $db->sql_query($approve_sql)) ) 
				{ 
					message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
				}
				$approve_row = $db->sql_fetchrow($approve_result);

				if ( !empty($approve_row['topic_title']) )
				{
					//pm notify user they're being auto-approved now
					//approve_mod_pm("app_ua", intval($approve_row['user_id']));
					$approve_sql = "DELETE 
						FROM " . APPROVE_TOPICS_TABLE . " 
						WHERE topic_id = " . intval($id); 
					if ( !($approve_result = $db->sql_query($approve_sql)) ) 
					{ 
						message_die(GENERAL_ERROR, $lang['approve_posts_error_delete'], '', __LINE__, __FILE__, $approve_sql); 
					}
					$approve_sql = "INSERT INTO " . APPROVE_TOPICS_TABLE . " (topic_id, approve_moderate) 
						VALUES (" . intval($id) . ", -1)"; 
					if ( !($approve_result = $db->sql_query($approve_sql)) ) 
					{ 
						message_die(GENERAL_ERROR, $lang['approve_posts_error_insert'], '', __LINE__, __FILE__, $approve_sql); 
					}
					$approve_sql = "DELETE 
						FROM " . APPROVE_POSTS_TABLE . " 
						WHERE topic_id = " . intval($id); 
					if ( !($approve_result = $db->sql_query($approve_sql)) ) 
					{ 
						message_die(GENERAL_ERROR, $lang['approve_posts_error_delete'], '', __LINE__, __FILE__, $approve_sql); 
					}
					$template->assign_block_vars("approve_message", array(
							"MESSAGE" => sprintf($lang['approve_admin_topics_approval_added'], $approve_row['topic_title'])
						)
					);
				}
			break;
		}

		if ( $approve_mod['tm'] == true )
		{

			//list of topics currently under moderation, paginated
			$template->assign_block_vars("moderated", array() );


			//
			// Do Pagination
			//
			if ( intval($p) < 1 )
			{
				$approve_page = 1;
			}
			else
			{
				$approve_page = intval($p);
			}
			$approve_sql = "SELECT COUNT(topic_id) as approve_count 
				FROM " . APPROVE_TOPICS_TABLE . " 
				WHERE approve_moderate = 1";
			if ( !($approve_result = $db->sql_query($approve_sql)) ) 
			{ 
				message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
			}
			$approve_row = $db->sql_fetchrow($approve_result);
			$approve_record_count = $approve_row['approve_count'];
			$approve_page_count = ( ($approve_record_count/$approve_per_page) > 1) ? ceil($approve_record_count/$approve_per_page) : 1;
			$approve_firstRec = ($approve_page > 1) ? (($approve_page - 1) * $approve_per_page) : 0;
			$approve_lastRec = ( ($approve_record_count < ($approve_page*$approve_per_page)) ? $approve_record_count : ($approve_page*$approve_per_page)); 
			
			$template->assign_vars(array(
					"L_MODERATED_TOPICS_OF" => sprintf($lang['approve_admin_topics_of'], (($approve_firstRec + 1) > $approve_record_count) ? $approve_record_count : ($approve_firstRec + 1), $approve_lastRec, $approve_record_count )
				)
			);
			if ( intval($approve_page) > 1 )
			{
				$template->assign_block_vars("moderated.moderated_paginate", array(
						"S_LINK" => "<a href=" . append_sid("admin_approve.$phpEx" . "?mode=t&s=tm&p=" . ($approve_page - 1)) . ">" . $lang['Previous'] . "</a> | "
					)
				);
			}
			for($i = 1; $i <= intval($approve_page_count); $i++)
			{
				$prev = "";
				$next = ""; 
				if ( $i > 1 )
				{
					$prev = " | "; 
				}
				if ( (intval($i) == intval($approve_page_count)) && (intval($approve_page) < intval($approve_page_count)) )
				{
					$next = " | "; 
				}
				if ( intval($approve_page) == intval($i) )
				{
					$template->assign_block_vars("moderated.moderated_paginate", array(
							"S_LINK" => $prev . "<b>" . $i . "</b>" . $next
						)
					);
				}
				else
				{
					$template->assign_block_vars("moderated.moderated_paginate", array(
							"S_LINK" => $prev . "<a href=" . append_sid("admin_approve.$phpEx" . "?mode=t&s=tm&p=" . $i) . ">" . $i . "</a>" . $next
						)
					);
				}
			}
			if ( intval($approve_page) < intval($approve_page_count) )
			{
				$template->assign_block_vars("moderated.moderated_paginate", array(
						"S_LINK" => "<a href=" . append_sid("admin_approve.$phpEx" . "?mode=t&s=tm&p=" . ($approve_page + 1)) . ">" . $lang['Next'] . "</a>" 
					)
				);
			}

			//
			// Moderated Topics
			//
			$approve_sql = "SELECT * 
				FROM " . APPROVE_TOPICS_TABLE . " 
				WHERE approve_moderate = 1 
				ORDER BY topic_id 
				LIMIT ". intval($approve_firstRec) . ", " . intval($approve_lastRec);
			if ( !($approve_result = $db->sql_query($approve_sql)) ) 
			{ 
				message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
			} 
			$approve_row_class = '';
			while( $approve_row = $db->sql_fetchrow($approve_result) )
			{
				$approve_sql2 = "SELECT t.topic_title, t.topic_id, u.username, t.topic_poster 
					FROM " . TOPICS_TABLE . " t, " . USERS_TABLE . " u 
					WHERE topic_id = " . intval($approve_row['topic_id']) . " 
						AND u.user_id = t.topic_poster";
				if ( !($approve_result2 = $db->sql_query($approve_sql2)) ) 
				{ 
					message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql2); 
				}
				if ( $approve_row2 = $db->sql_fetchrow($approve_result2) )
				{
					$approve_row_class = ($approve_row_class == 'row1') ? 'row2' : 'row1';
					$template->assign_block_vars("moderated.moderated_topics", array(
							"S_ID" => $approve_row2['topic_id'],
							"S_TITLE" => $approve_row2['topic_title'],
							"S_AUTHOR" => $approve_row2['username'],
							"S_LINK" => append_sid("admin_approve.$phpEx" . "?mode=d&s=td&id=" . $approve_row2['topic_id']),
							"S_U_LINK" => append_sid("admin_approve.$phpEx" . "?mode=d&s=ud&id=" . $approve_row2['topic_poster']),
							"S_REMOVE" => append_sid("admin_approve.$phpEx" . "?mode=t&s=rm&id=" . $approve_row['topic_id']),
							"S_ROW" => $approve_row_class
						)
					);
				}
			}
		}

		if ( $approve_mod['ta'] == true )
		{

			//list of topics currently auto-approved, paginated
			
			$template->assign_block_vars("approved", array() );

			//
			// Do Pagination
			//
			if ( intval($p) < 1 )
			{
				$approve_page = 1;
			}
			else
			{
				$approve_page = intval($p);
			}
			$approve_sql = "SELECT COUNT(topic_id) as approve_count 
				FROM " . APPROVE_TOPICS_TABLE . " 
				WHERE approve_moderate = -1";
			if ( !($approve_result = $db->sql_query($approve_sql)) ) 
			{ 
				message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
			}
			$approve_row = $db->sql_fetchrow($approve_result);
			
			$approve_record_count = $approve_row['approve_count'];
			$approve_page_count = ( ($approve_record_count/$approve_per_page) > 1) ? ceil($approve_record_count/$approve_per_page) : 1;
			$approve_firstRec = ($approve_page > 1) ? (($approve_page - 1) * $approve_per_page) : 0;
			$approve_lastRec = ( ($approve_record_count < ($approve_page*$approve_per_page)) ? $approve_record_count : ($approve_page*$approve_per_page)); 
			
			$template->assign_vars(array(
					"L_APPROVED_TOPICS_OF" => sprintf($lang['approve_admin_topics_of'], (($approve_firstRec + 1) > $approve_record_count) ? $approve_record_count : ($approve_firstRec + 1), $approve_lastRec, $approve_record_count )
				)
			);
			if ( intval($approve_page) > 1 )
			{
				$template->assign_block_vars("approved.approve_paginate", array(
						"S_LINK" => "<a href=" . append_sid("admin_approve.$phpEx" . "?mode=t&s=ta&p=" . ($approve_page - 1)) . ">" . $lang['Previous'] . "</a> | "
					)
				);
			}
			for($i = 1; $i <= intval($approve_page_count); $i++)
			{
				$prev = "";
				$next = ""; 
				if ( $i > 1 )
				{
					$prev = " | "; 
				}
				if ( (intval($i) == intval($approve_page_count)) && (intval($approve_page) < intval($approve_page_count)) )
				{
					$next = " | "; 
				}
				if ( intval($approve_page) == intval($i) )
				{
					$template->assign_block_vars("approved.approved_paginate", array(
							"S_LINK" => $prev . "<b>" . $i . "</b>" . $next
						)
					);
				}
				else
				{
					$template->assign_block_vars("approved.approved_paginate", array(
							"S_LINK" => $prev . "<a href=" . append_sid("admin_approve.$phpEx" . "?mode=t&s=ta&p=" . $i) . ">" . $i . "</a>" . $next
						)
					);
				}
			}
			if ( intval($approve_page) < intval($approve_page_count) )
			{
				$template->assign_block_vars("approved.approved_paginate", array(
						"S_LINK" => "<a href=" . append_sid("admin_approve.$phpEx" . "?mode=t&s=ta&p=" . ($approve_page + 1)) . ">" . $lang['Next'] . "</a>" 
					)
				);
			}

			//
			// Auto-Approved Topics
			//
			$approve_sql = "SELECT * 
				FROM " . APPROVE_TOPICS_TABLE . " 
				WHERE approve_moderate = -1 
				ORDER BY topic_id 
				LIMIT ". intval($approve_firstRec) . ", " . intval($approve_lastRec);
			if ( !($approve_result = $db->sql_query($approve_sql)) ) 
			{ 
				message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
			} 
			$approve_row_class = '';
			while( $approve_row = $db->sql_fetchrow($approve_result) )
			{
				$approve_sql2 = "SELECT t.topic_title, t.topic_id, u.username, t.topic_poster 
					FROM " . TOPICS_TABLE . " t, " . USERS_TABLE . " u 
					WHERE topic_id = " . intval($approve_row['topic_id']) . " 
						AND u.user_id = t.topic_poster";
				if ( !($approve_result2 = $db->sql_query($approve_sql2)) ) 
				{ 
					message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql2); 
				}
				if ( $approve_row2 = $db->sql_fetchrow($approve_result2) )
				{
					$approve_row_class = ($approve_row_class == 'row1') ? 'row2' : 'row1';
					$template->assign_block_vars("approved.approved_topics", array(
							"S_ID" => $approve_row2['topic_id'],
							"S_TITLE" => $approve_row2['topic_title'],
							"S_AUTHOR" => $approve_row2['username'],
							"S_LINK" => append_sid("admin_approve.$phpEx" . "?mode=d&s=td&id=" . $approve_row2['topic_id']),
							"S_U_LINK" => append_sid("admin_approve.$phpEx" . "?mode=d&s=ud&id=" . $approve_row2['topic_poster']),
							"S_REMOVE" => append_sid("admin_approve.$phpEx" . "?mode=t&s=ra&id=" . $approve_row['topic_id']),
							"S_ROW" => $approve_row_class
						)
					);
				}
			}
		}
		if ( $approve_mod['at'] == true )
		{
			//
			// Topics Awaiting Approval
			//

			$template->assign_block_vars("awaiting_approval", array() );

			//
			// Do Pagination
			//
			if ( intval($p) < 1 )
			{
				$approve_page = 1;
			}
			else
			{
				$approve_page = intval($p);
			}

			$approve_sql = "SELECT COUNT(topic_id) as approve_count 
				FROM " . APPROVE_POSTS_TABLE . " 
				WHERE is_topic = 1";
			if ( !($approve_result = $db->sql_query($approve_sql)) ) 
			{ 
				message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
			}
			$approve_row = $db->sql_fetchrow($approve_result);
			
			$approve_record_count = $approve_row['approve_count'];
			$approve_page_count = ( ($approve_record_count/$approve_per_page) > 1) ? ceil($approve_record_count/$approve_per_page) : 1;
			$approve_firstRec = ($approve_page > 1) ? (($approve_page - 1) * $approve_per_page) : 0;
			$approve_lastRec = ( ($approve_record_count < ($approve_page*$approve_per_page)) ? $approve_record_count : ($approve_page*$approve_per_page)); 
			
			$template->assign_vars(array(
					"L_APPROVAL_TOPICS_OF" => sprintf($lang['approve_admin_topics_of'], (($approve_firstRec + 1) > $approve_record_count) ? $approve_record_count : ($approve_firstRec + 1), $approve_lastRec, $approve_record_count )
				)
			);
			if ( intval($approve_page) > 1 )
			{
				$template->assign_block_vars("awaiting_approval.approval_paginate", array(
						"S_LINK" => "<a href=" . append_sid("admin_approve.$phpEx" . "?mode=t&s=at&p=" . ($approve_page - 1)) . ">" . $lang['Previous'] . "</a> | "
					)
				);
			}
			for($i = 1; $i <= intval($approve_page_count); $i++)
			{
				$prev = "";
				$next = ""; 
				if ( $i > 1 )
				{
					$prev = " | "; 
				}
				if ( (intval($i) == intval($approve_page_count)) && (intval($approve_page) < intval($approve_page_count)) )
				{
					$next = " | "; 
				}
				if ( intval($approve_page) == intval($i) )
				{
					$template->assign_block_vars("awaiting_approval.approval_paginate", array(
							"S_LINK" => $prev . "<b>" . $i . "</b>" . $next
						)
					);
				}
				else
				{
					$template->assign_block_vars("awaiting_approval.approval_paginate", array(
							"S_LINK" => $prev . "<a href=" . append_sid("admin_approve.$phpEx" . "?mode=t&s=at&p=" . $i) . ">" . $i . "</a>" . $next
						)
					);
				}
			}
			if ( intval($approve_page) < intval($approve_page_count) )
			{
				$template->assign_block_vars("awaiting_approval.approval_paginate", array(
						"S_LINK" => "<a href=" . append_sid("admin_approve.$phpEx" . "?mode=t&s=at&p=" . ($approve_page + 1)) . ">" . $lang['Next'] . "</a>" 
					)
				);
			}

			//
			// Topics Awaiting Approval
			//
			$approve_sql = "SELECT * 
				FROM " . APPROVE_POSTS_TABLE . " 
				WHERE is_topic = 1 
				ORDER BY topic_id 
				LIMIT ". intval($approve_firstRec) . ", " . intval($approve_lastRec);
			if ( !($approve_result = $db->sql_query($approve_sql)) ) 
			{ 
				message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
			} 
			$approve_row_class = '';
			while( $approve_row = $db->sql_fetchrow($approve_result) )
			{
				$approve_sql2 = "SELECT t.topic_title, t.topic_id, u.username, t.topic_poster 
					FROM " . TOPICS_TABLE . " t, " . USERS_TABLE . " u 
					WHERE topic_id = " . intval($approve_row['topic_id']) . " 
						AND u.user_id = t.topic_poster";
				if ( !($approve_result2 = $db->sql_query($approve_sql2)) ) 
				{ 
					message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql2); 
				}
				if ( $approve_row2 = $db->sql_fetchrow($approve_result2) )
				{
					$approve_row_class = ($approve_row_class == 'row1') ? 'row2' : 'row1';
					$template->assign_block_vars("awaiting_approval.approval_topics", array(
							"S_ID" => $approve_row2['topic_id'],
							"S_TITLE" => $approve_row2['topic_title'],
							"S_AUTHOR" => $approve_row2['username'],
							"S_LINK" => append_sid("admin_approve.$phpEx" . "?mode=d&s=td&id=" . $approve_row2['topic_id']),
							"S_U_LINK" => append_sid("admin_approve.$phpEx" . "?mode=d&s=ud&id=" . $approve_row2['topic_poster']),
							"S_APPROVE" => append_sid("admin_approve.$phpEx" . "?mode=t&s=ap&id=" . $approve_row['topic_id']),
							"S_ROW" => $approve_row_class
						)
					);
				}
			}
		}
		$template->pparse("topics");
}
if ( $modevar['p'] == true )
{	
		//list of posts currently under moderation, paginated, searchable
		$template->set_filenames(array(
			"posts" => "admin/approve_posts.tpl")
		);

		$template->assign_vars(array(
				"L_APPROVE_POST" => $lang['approve_admin_approve_post'],
				"L_AWAITING_APPROVAL" => $lang['approve_admin_posts_awaiting'],
				"L_REMOVE" => $lang['approve_admin_remove'],
				"L_APPROVE" => $lang['approve_admin_approve'],
				"L_NEXT" => $lang['Next'],
				"L_PREVIOUS" => $lang['Previous'],
				"L_APPROVE_BUTTON_FIND" => $lang['approve_admin_button_find'],
				"L_POST_SUBJECT" => $lang['approve_admin_subject'],
				"L_AUTHOR" => $lang['approve_admin_author'],
				"L_PAGE" => $lang['approve_admin_page']
			)
		);

		$template->assign_vars(array(
				"S_MODERATION" => append_sid('admin_approve.'.$phpEx.'?mode=p')
			)
		);

		$s = ($_GET['s']) ? $_GET['s'] : $_POST['s'];
		$p = ($_GET['p']) ? $_GET['p'] : $_POST['p'];
		$id =($_GET['id']) ? $_GET['id'] : $_POST['id'];
		$submit = ( !empty($_POST['submit']) ) ? true : false;
		
		if ( $s == "ap" )
		{	
			//approve post

			if ( intval($id) != 0 )
			{
				$approve_sql = "SELECT a.* 
					FROM " . POSTS_TABLE . " p, " . APPROVE_FORUMS_TABLE . " a 
					WHERE p.post_id = " . intval($id) . " 
						AND a.forum_id = p.forum_id";
				if ( !($approve_result = $db->sql_query($approve_sql)) ) 
				{ 
					message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
				}
				$approve_mod = $db->sql_fetchrow($approve_result);

				//notify user their post has been approved
				approve_mod_pm("app_p", intval($id));
				$approve_sql = "SELECT t.post_subject, p.poster_id, u.username 
					FROM " . POSTS_TEXT_TABLE . " t, " . POSTS_TABLE . " p, " . USERS_TABLE . " u 
					WHERE p.post_id = " . intval($id) . " 
						AND t.post_id = p.post_id 
						AND u.user_id = p.poster_id";
				if ( !($approve_result = $db->sql_query($approve_sql)) ) 
				{ 
					message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
				}
				$approve_row = $db->sql_fetchrow($approve_result);

				$approve_sql = "DELETE 
					FROM " . APPROVE_POSTS_TABLE . " 
					WHERE post_id = " . intval($id) . " 
						AND is_topic = 0"; 
				if ( !($approve_result = $db->sql_query($approve_sql)) ) 
				{ 
					message_die(GENERAL_ERROR, $lang['approve_posts_error_delete'], '', __LINE__, __FILE__, $approve_sql); 
				}
				$template->assign_block_vars("approve_message", array(
						"MESSAGE" => sprintf($lang['approve_admin_posts_approved'], $approve_row['post_subject'], $approve_row['username'])
					)
				);
			}
			else
			{
				$template->assign_block_vars("approve_message", array(
						"MESSAGE" => $lang['approve_admin_posts_id_remove_error']
					)
				);
			}
		}

		//
		// Do Pagination
		//
		if ( intval($p) < 1 )
		{
			$approve_page = 1;
		}
		else
		{
			$approve_page = intval($p);
		}

		$approve_sql = "SELECT COUNT(post_id) as approve_count 
			FROM " . APPROVE_POSTS_TABLE . " 
			WHERE is_topic = 0";
		if ( !($approve_result = $db->sql_query($approve_sql)) ) 
		{ 
			message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
		}
		$approve_row = $db->sql_fetchrow($approve_result);
		
		$approve_record_count = $approve_row['approve_count'];
		$approve_page_count = ( ($approve_record_count/$approve_per_page) > 1) ? ceil($approve_record_count/$approve_per_page) : 1;
		$approve_firstRec = ($approve_page > 1) ? (($approve_page - 1) * $approve_per_page) : 0;
		$approve_lastRec = ( ($approve_record_count < ($approve_page*$approve_per_page)) ? $approve_record_count : ($approve_page*$approve_per_page)); 
		
		$template->assign_vars(array(
				"L_APPROVAL_POSTS_OF" => sprintf($lang['approve_admin_posts_of'], (($approve_firstRec + 1) > $approve_record_count) ? $approve_record_count : ($approve_firstRec + 1), $approve_lastRec, $approve_record_count )
			)
		);
		if ( intval($approve_page) > 1 )
		{
			$template->assign_block_vars("approval_paginate", array(
					"S_LINK" => "<a href=" . append_sid("admin_approve.$phpEx" . "?mode=p&p=" . ($approve_page - 1)) . ">" . $lang['Previous'] . "</a> | "
				)
			);
		}
		for($i = 1; $i <= intval($approve_page_count); $i++)
		{
			$prev = "";
			$next = ""; 
			if ( $i > 1 )
			{
				$prev = " | "; 
			}
			if ( (intval($i) == intval($approve_page_count)) && (intval($approve_page) < intval($approve_page_count)) )
			{
				$next = " | "; 
			}
			if ( intval($approve_page) == intval($i) )
			{
				$template->assign_block_vars("approval_paginate", array(
						"S_LINK" => $prev . "<b>" . $i . "</b>" . $next
					)
				);
			}
			else
			{
				$template->assign_block_vars("approval_paginate", array(
						"S_LINK" => $prev . "<a href=" . append_sid("admin_approve.$phpEx" . "?mode=p&p=" . $i) . ">" . $i . "</a>" . $next
					)
				);
			}
		}
		if ( intval($approve_page) < intval($approve_page_count) )
		{
			$template->assign_block_vars("approval_paginate", array(
					"S_LINK" => "<a href=" . append_sid("admin_approve.$phpEx" . "?mode=p&p=" . ($approve_page + 1)) . ">" . $lang['Next'] . "</a>" 
				)
			);
		}

		//
		// Posts Awaiting Approval
		//
		$approve_sql = "SELECT * FROM " . APPROVE_POSTS_TABLE . " 
			WHERE is_topic = 0 
			ORDER BY post_id 
			LIMIT ". intval($approve_firstRec) . ", " . intval($approve_lastRec);
		if ( !($approve_result = $db->sql_query($approve_sql)) ) 
		{ 
			message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
		}
		$approve_row_class = '';
		while( $approve_row = $db->sql_fetchrow($approve_result) )
		{
			$approve_sql2 = "SELECT t.post_subject, p.poster_id, u.username 
				FROM " . POSTS_TEXT_TABLE . " t, " . POSTS_TABLE . " p, " . USERS_TABLE . " u 
				WHERE p.post_id = " . intval($approve_row['post_id']) . " 
					AND t.post_id = p.post_id 
					AND u.user_id = p.poster_id";
			if ( !($approve_result2 = $db->sql_query($approve_sql2)) ) 
			{ 
				message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql2); 
			}
			if ( $approve_row2 = $db->sql_fetchrow($approve_result2) )
			{
				$approve_row_class = ($approve_row_class == 'row1') ? 'row2' : 'row1';
				$template->assign_block_vars("approval_posts", array(
						"S_ID" => $approve_row['post_id'],
						"S_SUBJECT" => (!empty($approve_row2['post_subject'])) ? $approve_row2['post_subject'] : $lang['approve_admin_empty'],
						"S_AUTHOR" => $approve_row2['username'],
						"S_LINK" => append_sid("admin_approve.$phpEx" . "?mode=d&s=pd&id=" . $approve_row['post_id']),
						"S_U_LINK" => append_sid("admin_approve.$phpEx" . "?mode=d&s=ud&id=" . $approve_row2['poster_id']),
						"S_APPROVE" => append_sid("admin_approve.$phpEx" . "?mode=p&s=ap&id=" . $approve_row['post_id']),
						"S_ROW" => $approve_row_class
					)
				);
			}
		}
		$template->pparse("posts");
}//mode = p

if ( $modevar['f'] == true )
{
    // V: ok, so, Approve Mod doesn't deal with forums_extend correctly.
  // Replace this page with the actual admin_forums page, which has the simpler "Edit" button, and which deals with CH.
    exit;
  
		//forum list page w/ all info & links
		$template->set_filenames(array(
			"approve_forums" => "admin/approve_forums.tpl")
		);

		$template->assign_vars(array(
				"L_USERS_AUTO_APROVED" => $lang['approve_admin_users_auto_approved'],
				"L_USERS_MODERATED" => $lang['approve_admin_users_moderated_users'],
				"L_TOPICS_AWAITING" => $lang['approve_admin_topics_awaiting'],
				"L_TOPICS_AUTO_APPROVED" => $lang['approve_admin_topics_auto_approved'],
				"L_TOPICS_MODERATED" => $lang['approve_admin_topics_moderated_topics'],
				"L_POSTS_AWAITING" => $lang['approve_admin_posts_awaiting'],
				"L_FORUMS_MODERATED" => $lang['approve_admin_forums_moderated'],
				"L_POSTS" => $lang['Posts'],
				"L_TOPICS" => $lang['Topics'],
				"L_FORUMS" => $lang['approve_admin_forums'],
				"L_USERS" => $lang['approve_admin_users'],
				"L_ENABLED" => $lang['Enabled'],
				"L_FORUM_NAME" => $lang['Forum_name'],
				"L_EDIT" => $lang['Edit']
			)
		);
		
    $approve_sql2 = "SELECT * 
      FROM " . FORUMS_TABLE;
    if ( !($approve_result2 = $db->sql_query($approve_sql2)) ) 
    { 
      message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql2); 
    }
    $forum_rows = array();
    while ($forum_row = $db->sql_fetchrow($approve_result2))
    {
      $forum_rows[$forum_row['forum_id']] = $forum_row;
    }

		$approve_sql = "SELECT * 
			FROM " . APPROVE_FORUMS_TABLE . " 
			ORDER BY forum_id";
		if ( !($approve_result = $db->sql_query($approve_sql)) ) 
		{ 
			message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $approve_sql); 
		}
    $approve_rows = array();
		while( $approve_row = $db->sql_fetchrow($approve_result) )
    {
      $forum_id = $approve_row['forum_id'];
      // set the forum name
      $approve_row['forum_name'] = $forum_rows[$forum_id]['forum_name'];
      $approve_rows[] = $approve_row;

      // mark the forum as treated
      unset($forum_rows[$forum_id]);
    }

    // add missing forums
    foreach ($forum_rows as $forum_id => $forum_row)
    {
			$sql = "INSERT INTO " . APPROVE_FORUMS_TABLE . " (forum_id) 
        VALUES ($forum_id)";
      if (!($result = $db->sql_query($sql)))
      {
        message_die(GENERAL_ERROR, 'Couldnt add missing approve forums', '', __LINE__, __FILE__, $sql);
      }

      $approve_rows[] = array(
        'forum_id' => $forum_id,
        'forum_name' => $forum_row['forum_name'],
        'enabled' => false,
      );
    }

		$approve_row_class = '';
    foreach ($approve_rows as $approve_row)
		{
			$approve_row_class = ($approve_row_class == 'row1') ? 'row2' : 'row1';
			$template->assign_block_vars("approve_forums", array(
					"S_ID" => $approve_row['forum_id'],
					"S_NAME" => (!empty($approve_row['forum_name'])) ? $approve_row['forum_name'] : $lang['approve_admin_empty'],
					"S_EDIT" => append_sid("admin_forums.$phpEx" . "?mode=editforum&f=" . $approve_row['forum_id']),
					"S_LINK" => append_sid("../viewforum.$phpEx" . "?f=" . $approve_row['forum_id']),
					"S_ENABLED" => ($approve_row['enabled']) ? $lang['Yes'] : $lang['No'],
					"S_ROW" => $approve_row_class
				)
			);
		}
		$template->pparse("approve_forums");
}

include('./page_footer_admin.'.$phpEx);
?>
