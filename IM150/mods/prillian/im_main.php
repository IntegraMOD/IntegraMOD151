<?php
/***************************************************************************
 *                               im_main.php
 *                            -------------------
 *   begin                : Wednesday, Nov 6, 2002
 *   version              : 0.7.0
 *   date                 : 2003/12/23 23:27
 ***************************************************************************/

// This file builds the IM Client window content.

if ( !defined('IN_PHPBB') || !defined('IN_PRILLIAN') )
{
	die('Hacking attempt');
}

// Delete read instant messages for the user if automatic deletion is turned on.
if( $im_userdata['read_ims'] && $im_userdata['auto_delete'] )
{
	$delete_num = delete_read_ims($userdata['user_id']);
	// Update number of read ims in the script
	$im_userdata['read_ims'] -= $delete_num;
}

// Get forum post information
$row = array();
$sql = 'SELECT COUNT(*) AS total FROM ' . POSTS_TABLE . ' WHERE post_time >= ' . $userdata['user_lastvisit'];
if ( !$result = $db->sql_query($sql) )
{
	message_die(GENERAL_ERROR, 'Could not obtain new post count', '', __LINE__, __FILE__, $sql);
}
$row = $db->sql_fetchrow($result);
$new_posts = ( $row['total'] ) ? $row['total'] : 0;


// Get online user information
$online['visible'] = 0;
$online['hidden'] = 0;
$online['guests'] = 0;
$prillian_online = array();
$online_array = array();
$prev_user_id = 0;
$prev_user_ip = '';

$sql = 'SELECT u.username, u.user_id, u.user_allow_viewonline, u.user_level, s.session_logged_in, s.session_ip
	FROM ' . USERS_TABLE . ' u, ' . SESSIONS_TABLE . ' s
	WHERE u.user_id = s.session_user_id
		AND s.session_time >= ' . ( time() - 300 ) . '
	ORDER BY u.username ASC, s.session_ip ASC';
if( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not obtain user/online information', '', __LINE__, __FILE__, $sql);
}

while( $row = $db->sql_fetchrow($result) )
{
	if ( $row['session_logged_in'] )
	{
		// Skip multiple sessions for one user
		if ( $row['user_id'] != $prev_user_id )
		{
			$prillian_online[] = $row;
			$online_array[] = $row['user_id'];
			( $row['user_allow_viewonline'] ) ? $online['visible']++ : $online['hidden']++ ;
		}
		$prev_user_id = $row['user_id'];
	}
	elseif ( $row['session_ip'] != $prev_session_ip )
	{
		// Skip multiple sessions for one guest
		$online['guests']++;
	}
	$prev_session_ip = $row['session_ip'];
}
$db->sql_freeresult($result);
$total_online_users = $online['visible'] + $online['hidden'] + $online['guests'];
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

if ( $online['visible'] == 0 )
{
	$l_r_user_s = $lang['Reg_users_zero_total'];
}
else if ( $online['visible'] == 1 )
{
	$l_r_user_s = $lang['Reg_user_total'];
}
else
{
	$l_r_user_s = $lang['Reg_users_total'];
}

if ( $online['hidden'] == 0 )
{
	$l_h_user_s = $lang['Hidden_users_zero_total'];
}
else if ( $online['hidden'] == 1 )
{
	$l_h_user_s = $lang['Hidden_user_total'];
}
else
{
	$l_h_user_s = $lang['Hidden_users_total'];
}

if ( $online['guests'] == 0 )
{
	$l_g_user_s = $lang['Guest_users_zero_total'];
}
else if ( $online['guests'] == 1 )
{
	$l_g_user_s = $lang['Guest_user_total'];
}
else
{
	$l_g_user_s = $lang['Guest_users_total'];
}

$l_online_users = sprintf($l_t_user_s, $total_online_users);
$l_online_users .= sprintf($l_r_user_s, $online['visible']);
$l_online_users .= sprintf($l_h_user_s, $online['hidden']);
$l_online_users .= sprintf($l_g_user_s, $online['guests']);


// Get a list of all messages we may be working with, including new/unread instant
// and private messages. Site-to-Site messages are also fetched here.

$all_msgs = array();
$network_msgs = array();
$pm_where = '';

if( $im_userdata['open_pms'] )
{
	$pm_where = ', ' . PRIVMSGS_UNREAD_MAIL;
	$pm_where .= ( $userdata['user_new_privmsg'] ) ? ', ' . PRIVMSGS_NEW_MAIL: '';
}

$sql = 'SELECT pm.privmsgs_type, pm.privmsgs_id, pm.privmsgs_subject, pm.privmsgs_from_userid, u.username 
FROM ' . PRIVMSGS_TABLE . ' pm, ' . USERS_TABLE . ' u 
	WHERE pm.privmsgs_type IN (' . IM_NEW_MAIL . ', ' . IM_UNREAD_MAIL . $pm_where . ')
		AND pm.privmsgs_to_userid = ' . $userdata['user_id'] . ' 
		AND u.user_id = pm.privmsgs_from_userid
		AND pm.site_id = 0';

if ( !$result=$db->sql_query($sql) )
{
	$msg = 'Could not get list of messages' . $append_msg;
	message_die(GENERAL_ERROR, $msg, '', __LINE__, __FILE__, $sql);
}

$all_msgs = $db->sql_fetchrowset($result);
$db->sql_freeresult($result);

// Include Site-to-Site information
if( $im_userdata['user_allow_network'] && $im_userdata['admin_allow_network'] && $prill_config['allow_network'] )
{
	$sql = 'SELECT pm.site_id, pm.privmsgs_type, pm.privmsgs_id, pm.privmsgs_subject, pm.privmsgs_from_username, ss.site_url, ss.site_phpex
	FROM ' . PRIVMSGS_TABLE . ' pm, ' . IM_SITES_TABLE . ' ss 
		WHERE pm.privmsgs_type IN (' . IM_NEW_MAIL . ', ' . IM_UNREAD_MAIL . $read_where . $pm_where . ')
			AND pm.privmsgs_to_userid = ' . $userdata['user_id'] . ' 
			AND pm.site_id = ss.site_id';

	if ( !$result=$db->sql_query($sql) )
	{
		$msg = 'Could not get list of messages' . $append_msg;
		message_die(GENERAL_ERROR, $msg, '', __LINE__, __FILE__, $sql);
	}

	$network_msgs = $db->sql_fetchrowset($result);
	$db->sql_freeresult($result);

	if( !empty($network_msgs) )
	{
		reset($network_msgs);
		while(list($k, $info) = each($network_msgs))
		{
			$all_msgs[] = $info;
		}
	}
}

$msgs_total = (!empty($all_msgs)) ? count($all_msgs): false;
if( $msgs_total )
{
	sort($all_msgs);
}
else
{
	$all_msgs = array();
}

if( isset($_REQUEST['mode_switch']) )
{
	$sql = 'UPDATE ' . IM_PREFS_TABLE . ' SET current_mode = ' . $mode . ' WHERE user_id = ' . $userdata['user_id'];
	if( !$db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not update current mode', '', '', '', $sql);
	}
}

// Begin building the IM Client!

define('SHOW_ONLINE', true);

// Begin building the window

switch($mode)
{
	case WIDE_MODE:
		$body_template = 'widemode';
		$im_userdata['refresh_rate'] += 5;
		break;
	case MINI_MODE:
		$body_template = 'minimode';
		$im_userdata['refresh_rate'] += 5;
		break;
	case MAIN_MODE:
	default:
		$body_template = 'main';
		break;
}

$mode_append = '?mode=' . $mode;
if( $frames )
{
	$mode_append = '?mode=' . NO_FRAMES_MODE . '&amp;mode2=' . $mode;
}

$template->set_filenames(array(
	'body' => 'prillian/' . $body_template . '_body.tpl')
);
$refresh_url = append_sid(PRILL_URL . $mode_append);


if( $im_userdata['refresh_method'] == 1 )
{
	$refresh_javascript = 'onLoad=window.setTimeout("location.href=\'' . $refresh_url . '\'",' . $im_userdata['refresh_rate'] . '000)';
}
elseif( $im_userdata['refresh_method'] == 2 )
{
	// Add 15 seconds to refresh rate - we'll stagger the refresh
	// triggers so that both of them don't go off at the same time.
	$im_refresh_rate2 = $im_userdata['refresh_rate'] + 15;
	$refresh_javascript = 'onLoad=window.setTimeout("location.href=\'' . $refresh_url . '\'",' . $im_refresh_rate2 . '000)';
	$meta_headers = '<meta http-equiv="refresh" content="' . $im_userdata['refresh_rate'] . ';url='  . $refresh_url . '">';
}
else
{
	$meta_headers = '<meta http-equiv="refresh" content="' . $im_userdata['refresh_rate'] . ';url='  . $refresh_url . '">';
}

if( !$im_userdata['popup_ims'] && $im_userdata['list_ims'] )
{
	$read_mark = '&mark_read=1';
}

$contact_list->alert_check();

include_once(PRILL_PATH . 'prill_header.' . $phpEx);
if( $frames )
{
	print_controls($mode_append,  NO_FRAMES_MODE, $mode2);
	$template->pparse('controls');
}

// Define basic or common template variables
$template->assign_vars(array(
	'IMG_LOGO' => $images['prill_logo'],
	'L_PRILLIAN' => $lang['Prillian'],
	'IMG_MESSAGE' => $images['prill_message'],

	'L_INFORMATION' => $lang['Information'],
	'L_PRIVATE_MESSAGES' => $lang['Private_Messages'],
	'L_USERS_ONLINE' => $lang['Users_Online'],
	'L_HIDDEN_USERS_ONLINE' => $lang['Hidden_Users_Online'],
	'L_GUESTS_ONLINE' => $lang['Guests_Online'],
	'L_PROFILE' => $lang['Profile'],
	'L_PM' => $lang['PM'],
	'L_IM' => $lang['IM'],
	'L_MESSAGE' => $lang['Message'],
	'L_NEW_POSTS' => $lang['Prill_new_posts'],
	'L_WHOSONLINE_MOD' => sprintf($lang['Mod_online_color'], '<span style="color:#' . $theme['fontcolor2'] . '">', '</span>'),
	'L_WHOSONLINE_ADMIN' => sprintf($lang['Admin_online_color'], '<span style="color:#' . $theme['fontcolor3'] . '">', '</span>'),
	'L_ONLINE_EXPLAIN' => $lang['Online_explain'],
	'L_ALT_MESSAGE' => $lang['Send_im'],

	'U_IM_PATH' => PRILL_PATH,
	'U_PM_LINK' => append_sid($phpbb_root_path . 'privmsg.'.$phpEx.'?folder=inbox'),

	'TOTAL_USERS_ONLINE' => $l_online_users,
	'RECORD_USERS' => sprintf($lang['Record_online_users'], $board_config['record_online_users'], create_date($board_config['default_dateformat'], $board_config['record_online_date'], $board_config['board_timezone'])),
	'NEW_POSTS' => $new_posts,
	'SEND_WIDTH' => $im_userdata['send_width'],
	'SEND_HEIGHT' => $im_userdata['send_height'],
	'READ_WIDTH' => $im_userdata['read_width'],
	'READ_HEIGHT' => $im_userdata['read_height'],
	'NEW_PMS' => $userdata['user_new_privmsg'],
	'USERS_ONLINE' => $online['visible'],
	'HIDDEN_USERS_ONLINE' => $online['hidden'],
	'GUESTS_ONLINE' => $online['guests']
));

// If we're opening new private messages in the IM Client, it's pointless
// to display the number of new pms, since that number will be 0!
if( !$im_userdata['open_pms'] )
{
	$template->assign_block_vars('switch_pms', array());
}

// Create new message list and spawn pop-ups
if( $msgs_total )
{
	if( $im_userdata['list_ims'] )
	{
		$s_hidden_fields = '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" /><inout type="hidden" name="mode" value="' . $mode . '" />';

		$template->assign_block_vars('switch_newmsg_list', array(
			'S_FORM_ACTION' => $refresh_url,
			'S_HIDDEN_FIELDS' => $s_hidden_fields,

			'L_NEW_MESSAGES' => $lang['New_messages'],
			'L_SUBJECT' => $lang['Subject'],
			'L_FROM' => $lang['From'],
			'L_MARK_ALL' => $lang['Mark_all'],
			'L_UNMARK_ALL' => $lang['Unmark_all'],
			'L_DELETE' => $lang['Delete'])
		);
	}

	$im_id_sql = '';
	$pm_id_sql = '';
	$total_unread = 0;
	$total_new = 0;
	$total_new_pms = 0;
	$total_unread_pms = 0;
	$left_pixels = 0;
	$right_pixels = 0;

	reset($all_msgs);
	while( list($key, $im) = each($all_msgs) )
	{
		if( $im['privmsgs_type'] == IM_UNREAD_MAIL )
		{
			if( $im_userdata['popup_ims'] && ! $im_userdata['list_ims'] )
			{
				$im_id_sql .=  ( ( $im_id_sql == '' ) ? '' : ', ' ) . $im['privmsgs_id'];
				$total_unread++;
			}
		}
		elseif( $im['privmsgs_type'] == IM_NEW_MAIL )
		{
			$im_id_sql .=  ( ( $im_id_sql == '' ) ? '' : ', ' ) . $im['privmsgs_id'];
			$total_new++;
		}
		elseif( $im['privmsgs_type'] == PRIVMSGS_NEW_MAIL )
		{
			$pm_id_sql .=  ( ( $pm_id_sql == '' ) ? '' : ', ' ) . $im['privmsgs_id'];
			$total_new_pms++;
		}
		elseif( $im['privmsgs_type'] == PRIVMSGS_UNREAD_MAIL )
		{
			$pm_id_sql .=  ( ( $pm_id_sql == '' ) ? '' : ', ' ) . $im['privmsgs_id'];
			$total_unread_pms++;
		}
		else
		{
			continue;
		}

		if( $left_pixels == 200 )
		{
			$left_pixels = 0;
			$right_pixels = 0;
		}
		else
		{
			$left_pixels += 20;
			$right_pixels += 40;
		}

		$network_mark = ( $im['site_id'] ) ? '&amp;sitesite=1': '';

		if( $im_userdata['popup_ims'] )
		{
			$template->assign_block_vars('switch_im_popups', array(
				'U_IMMSGS_POPUP' => append_sid(PRILL_URL . '?mode=read&' . POST_POST_URL . '=' . $im['privmsgs_id'] . $network_mark),
				'IMNUM' => $key,
				'LEFT_PX' => $left_pixels,
				'TOP_PX' => $right_pixels)
			);
		}

		if( $im_userdata['list_ims'] )
		{
			$post_subject = $im['privmsgs_subject'];
			$orig_word = array();
			$replacement_word = array();
			obtain_word_list($orig_word, $replacement_word);
			if ( count($orig_word) )
			{
				$post_subject = preg_replace($orig_word, $replacement_word, $post_subject);
			}
			if( strlen($post_subject) > 8 )
			{
				$short_subject = substr($post_subject, 0, 8) . '...';
			}
			else
			{
				$short_subject = $post_subject;
			}

			if( $im['site_id'] )
			{
				$im['username'] = $im['privmsgs_from_username'];
				$u_profile = append_sid($im['site_url'] . 'profile.' . $im['site_phpex'] . '?mode=viewprofile&amp;' . POST_USERS_URL . '=' . $im['privmsgs_from_userid']);
			}
			else
			{
				$u_profile = append_sid($phpbb_root_path . "profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $im['privmsgs_from_userid']);
			}

			if( strlen($im['username']) > 5 )
			{
				$short_sender = substr($im['username'], 0, 5) . '...';
			}
			else
			{
				$short_sender = $im['username'];
			}

			$template->assign_block_vars('switch_newmsg_list.switch_newmsg_row', array(
				'U_IMMSGS' => append_sid(PRILL_URL . '?mode=read&' . POST_POST_URL . '=' . $im['privmsgs_id'] . $read_mark . $network_mark),
				'U_PROFILE' => $u_profile,

				'S_MARK_ID' => $im['privmsgs_id'],

				'SUBJECT_SHORT' => $short_subject,
				'SUBJECT_FULL' => $post_subject,
				'SENDER_SHORT' => $short_sender,
				'SENDER_FULL' => $im['username'],
				'IMNUM' => $key,
				'LEFT_PX' => $left_pixels,
				'TOP_PX' => $right_pixels)
			);
		}
	}

	// Update mail status for all of these new messages

	$im_update_sql = '';
	$im_num_update_sql = '';
	$pm_update_sql = '';
	$pm_num_update_sql = '';

	if( $im_userdata['popup_ims'] )
	{
		if( $im_id_sql != '' )
		{
			$im_update_sql = 'UPDATE ' . PRIVMSGS_TABLE . '
				SET privmsgs_type = ' . IM_READ_MAIL . "
				WHERE privmsgs_id IN ($im_id_sql)";
			$im_update_err = 'Could not update instant message read status';
			$im_update_line = __LINE__;

			$im_num_update_sql = 'UPDATE ' . IM_PREFS_TABLE . " 
				SET new_ims = new_ims - $total_new, unread_ims = unread_ims - $total_unread, read_ims = read_ims + $total_unread + $total_new 
				WHERE user_id = " . $userdata['user_id'];
			$im_num_update_err = 'Could not update instant message read status for user';
			$im_num_update_line = __LINE__;
		}

		if( $total_new_pms || $total_unread_pms )
		{
			$pm_update_sql = 'UPDATE ' . PRIVMSGS_TABLE . '
				SET privmsgs_type = ' . PRIVMSGS_READ_MAIL . "
				WHERE privmsgs_id IN ($pm_id_sql)";
			$pm_update_err = 'Could not update private message read status';
			$pm_update_line = __LINE__;

			$pm_num_update_sql = 'UPDATE ' . USERS_TABLE . " 
				SET user_new_privmsg = user_new_privmsg - $total_new_pms, user_unread_privmsg = user_unread_privmsg - $total_unread_pms
				WHERE user_id = " . $userdata['user_id'];
			$pm_num_update_err = 'Could not update private message read status for user';
			$pm_num_update_line = __LINE__;
		}
	}
	elseif( $im_userdata['list_ims'] )
	{
		if( $im_id_sql != '' )
		{
			$im_update_sql = 'UPDATE ' . PRIVMSGS_TABLE . '
				SET privmsgs_type = ' . IM_UNREAD_MAIL . "
				WHERE privmsgs_id IN ($im_id_sql)";
			$im_update_err = 'Could not update instant message unread status';
			$im_update_line = __LINE__;
			$im_num_update_sql = 'UPDATE ' . IM_PREFS_TABLE . " 
				SET new_ims = new_ims - $total_new, unread_ims = unread_ims + $total_new 
				WHERE user_id = " . $userdata['user_id'];
			$im_num_update_err = 'Could not update instant message unread status for user';
			$im_num_update_line = __LINE__;
		}

		if( $total_new_pms )
		{
			$pm_update_sql = 'UPDATE ' . PRIVMSGS_TABLE . '
				SET privmsgs_type = ' . PRIVMSGS_UNREAD_MAIL . "
				WHERE privmsgs_id IN ($pm_id_sql)";
			$pm_update_err = 'Could not update private message unread status';
			$pm_update_line = __LINE__;

			$pm_num_update_sql = 'UPDATE ' . USERS_TABLE . " 
				SET user_new_privmsg = user_new_privmsg - $total_new_pms, user_unread_privmsg = user_unread_privmsg + $total_new_pms 
				WHERE user_id = " . $userdata['user_id'];
			$pm_num_update_err = 'Could not update private message unread status for user';
			$pm_num_update_line = __LINE__;
		}
	}

	if( $im_update_sql != '' )
	{
		if ( !$db->sql_query($im_update_sql) )
		{
			$msg = $im_update_err . $append_msg;
			message_die(GENERAL_ERROR, $msg, '', $im_update_line, __FILE__, $sql);
		}
		if ( !$db->sql_query($im_num_update_sql) )
		{
			$msg = $im_num_update_err . $append_msg;
			message_die(GENERAL_ERROR, $msg, '', $im_num_update_line, __FILE__, $sql);
		}
	}

	if( $pm_update_sql != '' )
	{
		if ( !$db->sql_query($pm_update_sql) )
		{
			$msg = $pm_update_err . $append_msg;
			message_die(GENERAL_ERROR, $msg, '', $pm_update_line, __FILE__, $sql);
		}
		if ( !$db->sql_query($pm_num_update_sql) )
		{
			$msg = $pm_num_update_err . $append_msg;
			message_die(GENERAL_ERROR, $msg, '', $pm_num_update_line, __FILE__, $sql);
		}
	}

	if( ( $total_new || $total_new_pms ) && $prill_config['play_sound'] && $im_userdata['play_sound'] )
	{
		$sound_name = ( !$prill_config['default_sound'] ) ? $prill_config['sound_name'] : $im_userdata['sound_name'];

		$template->assign_block_vars('switch_sound', array(
			'SOUND_NAME' => $sound_name
		));
	}
}
// That's the end of the message list and pop-up spawning!

// Include Site-to-Site information
if( $im_userdata['user_allow_network'] && $im_userdata['admin_allow_network'] && $im_userdata['network_user_list'] && $prill_config['allow_network'] )
{
	include_once(PRILL_PATH . 'network_parseusers.'.$phpEx);
}

// Now, it's time to build the online user list!
// First, get a list of all users on the IM Client right now.
$on_im = array();

$sql = 'SELECT session_user_id FROM ' . IM_SESSIONS_TABLE;
if ( !$result = $db->sql_query($sql) )
{
	$msg = 'Could not query IM sessions list' . $append_msg;
	message_die(GENERAL_ERROR, $msg, '', __LINE__, __FILE__, $sql);
}
while( $row = $db->sql_fetchrow($result) )
{
	$on_im[] = $row['session_user_id'];
}

if( $im_userdata['list_all_online'] == 1 || $im_userdata['list_all_online'] == 4 )
{
	// Let's show all online users
	$template->assign_block_vars('switch_users_online',	array(
		'L_USERS_ONLINE' => $lang['Users_Online']
	));

	if ( empty($prillian_online) )
	{
		// No users online at all!!
		$template->assign_block_vars('switch_users_online.switch_user_list',	array(
			'ONLINE_USER' => $lang['None'],
			'ONLINE_USER_STYLE' => '',
			'ONLINE_USER_URL' => '',
			'U_MESSAGE_USER' => '',
			'L_MESSAGE' => '')
		);
	}
	else
	{
		// Get ignore and disallowed lists to avoid showing users 
		// the person can't contact or doesn't want to see
		$contact_list->get_list('ignore');
		$contact_list->get_list('disallow_by');

		foreach($prillian_online as $v)
		{
			$is_on_im = 0;
			if( $v['user_level'] != OFF_SITE )
			{
				if( !array_key_exists($v['user_id'], $contact_list->ignore) && !array_key_exists($v['user_id'], $contact_list->disallow_by) )
				{
					if( in_array($v['user_id'], $on_im) )
					{
						// A user is on the IM Client now
						$is_on_im = 1;
					}
					
					if( $im_userdata['list_all_online'] == 4 )
					{
						// All users on IM only
						if( $is_on_im )
						{
							process_user_online($v, $is_on_im);
						}
					}
					else
					{
						// All users on the forum
						process_user_online($v, $is_on_im);
					}
				}
			}
			else
			{
				process_user_online($v, 1);
			}
		}
	}
}
elseif( $im_userdata['list_all_online'] == 2 || $im_userdata['list_all_online'] == 3 )
{
	// We're going to show buddies only
	$buddy_count = 0;
	$template->assign_block_vars('switch_users_online',	array(
		'L_USERS_ONLINE' => $lang['Buddies_Online']
	));

	if ( empty($prillian_online) || !count($contact_list->buddy) )
	{
		// Either the user has no buddies, or no users are online at all!
		$template->assign_block_vars('switch_users_online.switch_user_list',	array(
			'ONLINE_USER' => $lang['None'],
			'ONLINE_USER_STYLE' => '',
			'ONLINE_USER_URL' => '',
			'U_MESSAGE_USER' => '',
			'L_MESSAGE' => '')
		);
	}
	else
	{
		$buddies_online = array();
		foreach($prillian_online as $v)
		{
			$is_on_im = 0;
			if( $v['user_level'] != OFF_SITE )
			{
				if( array_key_exists($value['user_id'], $contact_list->buddy) )
				{
					if( in_array($v['user_id'], $on_im) )
					{
						// A user is on the IM Client now
						$is_on_im = 1;
					}
					
					if( $im_userdata['list_all_online'] == 3 )
					{
						// Buddies on IM only
						if( $is_on_im )
						{
							$buddies_online[$buddy_count]['user'] = $value;
							$buddies_online[$buddy_count]['is_on'] = $is_on_im;
							$buddy_count++;
						}
					}
					else
					{
						// Buddies on all of forums
						$buddies_online[$buddy_count]['user'] = $value;
						$buddies_online[$buddy_count]['is_on'] = $is_on_im;
						$buddy_count++;
					}
				}
			}
			else
			{
				$buddies_online[$buddy_count]['user'] = $value;
				$buddies_online[$buddy_count]['is_on'] = 1;
				$buddy_count++;
			}
		}

		if( !$buddy_count )
		{
			// None of the online users are buddies.
			$template->assign_block_vars('switch_users_online.switch_user_list',	array(
				'ONLINE_USER' => $lang['None'],
				'ONLINE_USER_STYLE' => '',
				'ONLINE_USER_URL' => '',
				'U_MESSAGE_USER' => '',
				'L_MESSAGE' => '')
			);
		}
		else
		{
			// There are some buddies... print them out!
			for($ii=0; $ii<$buddy_count; $ii++)
			{
				process_user_online($buddies_online[$ii]['user'], $buddies_online[$ii]['is_on']);
			}
		}
	}
}

// End of File - imclient.php finishes things off
?>