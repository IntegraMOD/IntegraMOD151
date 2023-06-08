<?php
/***************************************************************************
 *                                im_log.php
 *                            -------------------
 *   begin                : Wednesday, May 21, 2003
 *   version              : 0.3.0
 *   date                 : 2003/12/23 23:27
 ***************************************************************************/

// This file builds the Message Log window content.

if ( !defined('IN_PHPBB') || !defined('IN_PRILLIAN') )
{
	die('Hacking attempt');
}

// Check possible variables

// $type - Possible values include "received", "sent", "offreceived", "offsent"
$type = ( !empty($_REQUEST['type']) ) ? $_REQUEST['type'] : 'received';
$cancel = ( isset($_REQUEST['cancel']) ) ? true : false;
$confirm = ( isset($_REQUEST['confirm']) ) ? true : false;
$delete = ( isset($_REQUEST['delete']) ) ? true : 0;
$mark_list = ( !empty($_REQUEST['mark']) ) ? $_REQUEST['mark'] : 0;
$sort_order = ($_REQUEST['order'] == 'DESC') ? 'DESC' : 'ASC';
$start = ( isset($_REQUEST['start']) ) ? intval($_REQUEST['start']) : 0;

if ( $cancel )
{
	thoul_redirect('imclient.' . $phpEx . '?mode=log&type=' . $type);
}


$u_profile_base = $phpbb_root_path . "profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=';

$offsite = false;
$name_sql = '';
$network_mark = '';

// First, set up some options based on $type
switch($type)
{
	case 'offsent':
		$sender = $userdata['username'];
		$u_sender = $u_profile_base . $userdata['user_id'];
		$sql_user = ' AND pm.privmsgs_from_userid = ' . $userdata['user_id'];
		$msg_sql = $sql_user;
		$type_title = $lang['Offsite_Messages_Sent_by'] . $userdata['username'];
		$no_msg = $lang['No_sent'];
		$name_sql = 'pm.privmsgs_to_username, ';
		$offsite = true;
		$network_mark = '&amp;sitesite=1';
		break;
	case 'offreceived':
		$receiver = $userdata['username'];
		$u_receiver = $u_profile_base . $userdata['user_id'];
		$sent_mark = '';
		$sql_user = ' AND pm.privmsgs_to_userid = ' . $userdata['user_id'];
		$msg_sql = $sql_user;
		$type_title = $lang['Offsite_Messages_Received_by'] . $userdata['username'];
		$no_msg = $lang['No_received'];
		$name_sql = 'pm.privmsgs_from_username, ';
		$offsite = true;
		$network_mark = '&amp;sitesite=1';
		break;
	case 'sent':
		$sender = $userdata['username'];
		$u_sender = $u_profile_base . $userdata['user_id'];
		$sql_user = ' AND pm.privmsgs_from_userid = ' . $userdata['user_id'];
		$msg_sql = $sql_user . ' AND u.user_id = pm.privmsgs_to_userid';
		$type_title = $lang['Messages_Sent_by'] . $userdata['username'];
		$no_msg = $lang['No_sent'];
		break;
	case 'received':
	default:
		$receiver = $userdata['username'];
		$u_receiver = $u_profile_base . $userdata['user_id'];
		$sent_mark = '';
		$sql_user = ' AND pm.privmsgs_to_userid = ' . $userdata['user_id'];
		$msg_sql = $sql_user . ' AND u.user_id = pm.privmsgs_from_userid';
		$type_title = $lang['Messages_Received_by'] . $userdata['username'];
		$no_msg = $lang['No_received'];
		break;
}

if( $offsite )
{
	$msg_sql .= ' AND pm.site_id <> 0';
	$u_select_sql = '';
	$u_table_sql = '';
}
else
{
	$msg_sql .= ' AND pm.site_id=0';
	$u_select_sql = ', u.username';
	$u_table_sql = ', ' . USERS_TABLE . ' u ';
}


if( $delete && $mark_list )
{
	if( !$confirm )
	{
		$s_hidden_fields = '<input type="hidden" name="mode" value="' . $mode . '" /><input type="hidden" name="type" value="' . $type . '" />';
		$s_hidden_fields .= ( $delete ) ? '<input type="hidden" name="delete" value="true" />' : '<input type="hidden" name="deleteall" value="true" />';

		$mark_count = count($mark_list);
		for($i = 0; $i < $mark_count; $i++)
		{
			$s_hidden_fields .= '<input type="hidden" name="mark[]" value="' . intval($mark_list[$i]) . '" />';
		}

		// Output confirmation page
		include(PRILL_PATH . 'prill_header.'.$phpEx);

		$template->set_filenames(array(
			'confirm_body' => 'confirm_body.tpl')
		);

		$template->assign_vars(array(
			'MESSAGE_TITLE' => $lang['Information'],
			'MESSAGE_TEXT' => ( count($mark_list) == 1 ) ? $lang['Confirm_delete_pm'] : $lang['Confirm_delete_pms'], 

			'L_YES' => $lang['Yes'],
			'L_NO' => $lang['No'],

			'S_CONFIRM_ACTION' => append_sid('imclient.' . $phpEx),
			'S_HIDDEN_FIELDS' => $s_hidden_fields
		));

		$template->pparse('confirm_body');

		include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
	}
	else
	{
		if( $type != 'received' &&  $type != 'offreceived' )
		{
			include_once(PRILL_PATH . 'prill_header.' . $phpEx);
			$msg = $lang['Not_authed_im_delete'] . $append_msg . ' :: ' . sprintf($lang['Back_to_log'], '<a href="' . append_sid(PRILL_URL . '?mode=' . $mode . '&type=' . $type, true) . '">', '</a>');
			message_die(GENERAL_MESSAGE, $msg);
		}

		if( $delete && $mark_list )
		{
			$delete_sql_id = '';
			$delete_ids = array();
			$delete_nums = array();

			// Set to empty arrays instead of '0' if nothing is selected.
			if ( isset($mark_list) && !is_array($mark_list) )
			{
				$mark_list = array();
			}

			if( count($mark_list) )
			{
				foreach($mark_list as $key=>$val)
				{
					$delete_ids[] = intval($val);
					$delete_sql_id .= (($delete_sql_id != '') ? ', ' : '') . intval($val);
				}
			}

			if( !empty($delete_sql_id) )
			{
				// Get message types, for updating of counters later
				$sql = 'SELECT privmsgs_type FROM ' . PRIVMSGS_TABLE . ' WHERE privmsgs_id IN (' . $delete_sql_id . ') AND privmsgs_to_userid = ' . $userdata['user_id'];
				if ( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not obtain message status list', '', __LINE__, __FILE__, $sql);
				}

				$rows = $db->sql_fetchrowset($result);
				$db->sql_freeresult();
				foreach($rows as $key=>$val)
				{
					if( isset($delete_nums[$val['privmsgs_type']]) )
					{
						$delete_nums[$val['privmsgs_type']]++;
					}
					else
					{
						$delete_nums[$val['privmsgs_type']] = 1;
					}
				}

				$delete_text_sql = 'DELETE FROM ' . PRIVMSGS_TEXT_TABLE . ' WHERE privmsgs_text_id IN (' . $delete_sql_id . ')';
				$delete_sql = 'DELETE FROM ' . PRIVMSGS_TABLE . ' WHERE privmsgs_id IN (' . $delete_sql_id . ') AND privmsgs_to_userid = ' . $userdata['user_id'];
				if ( !$db->sql_query($delete_sql, BEGIN_TRANSACTION) )
				{
					$msg = 'Could not delete message info' . $append_msg;
					message_die(GENERAL_ERROR, $msg, '', __LINE__, __FILE__, $delete_sql);
				}
				if ( !$db->sql_query($delete_text_sql, END_TRANSACTION) )
				{
					$msg = 'Could not delete message text' . $append_msg;
					message_die(GENERAL_ERROR, $msg, '', __LINE__, __FILE__, $delete_text_sql);
				}

				// Now we need to update the counters tracking the numbers of
				// messages in both the script and the database.
				$im_numbers_sql = '';

				foreach($delete_nums as $key=>$val)
				{
					switch($key)
					{
						case IM_READ_MAIL:
							$im_numbers_sql .= (($im_numbers_sql != '') ? ', ' : '') . ' read_ims = read_ims - ' . $val;
							$im_userdata['read_ims'] -= $val;
							break;
						case IM_UNREAD_MAIL:
							$im_numbers_sql .= (($im_numbers_sql != '') ? ', ' : '') . ' unread_ims = unread_ims - ' . $val;
							$im_userdata['unread_ims'] -= $val;
							break;
						case IM_NEW_MAIL:
							$im_numbers_sql .= (($im_numbers_sql != '') ? ', ' : '') . ' new_ims = new_ims - ' . $val;
							$im_userdata['new_ims'] -= $val;
							break;
					}
				}

				if( $im_numbers_sql != '' )
				{
					$sql = 'UPDATE ' . IM_PREFS_TABLE . " SET $im_numbers_sql WHERE user_id = " . $userdata['user_id'];
					if ( !$db->sql_query($sql) )
					{
						$msg = 'Could not update instant message numbers' . $append_msg;
						message_die(GENERAL_ERROR, $msg, '', __LINE__, __FILE__, $sql);
					}
				}
			}
		}
	}
}
// That's the end of all the message deletion stuff!



// Let's get a list of all messages we may be working with. This includes new,
// read, and unread instant messages. These may be messages sent or received by the
// user depending on $type.

$all_msgs = array();

$sql = 'SELECT pm.privmsgs_type, pm.privmsgs_id, pm.privmsgs_subject, pm.privmsgs_from_userid, ' . $name_sql . 'pm.privmsgs_to_userid, pm.privmsgs_date' . $u_select_sql . ' FROM ' . PRIVMSGS_TABLE . ' pm' . $u_table_sql . '
	WHERE pm.privmsgs_type IN (' . IM_NEW_MAIL . ', ' . IM_UNREAD_MAIL . ', ' . IM_READ_MAIL . ')' . $msg_sql;
$sql .= ' ORDER BY pm.privmsgs_date ' . $sort_order;
$sql .= ' LIMIT ' . (($start) ? $start . ', ' : '') . $board_config['topics_per_page'];

$msg_count_sql = 'SELECT COUNT(*) AS total
FROM ' . PRIVMSGS_TABLE . ' pm' . $u_table_sql . '
	WHERE pm.privmsgs_type IN (' . IM_NEW_MAIL . ', ' . IM_UNREAD_MAIL . ', ' . IM_READ_MAIL . ')' . $msg_sql;

if ( !$result=$db->sql_query($sql) )
{
	$msg = 'Could not get list of messages' . $append_msg;
	message_die(GENERAL_ERROR, $msg, '', __LINE__, __FILE__, $sql);
}

$all_msgs = $db->sql_fetchrowset($result);
$db->sql_freeresult($result);

$msgs_total = (!empty($all_msgs)) ? count($all_msgs): false;
if( $msgs_total )
{
	sort($all_msgs);
}
else
{
	$all_msgs = array();
}


// Begin building the window

$template->set_filenames(array(
	'body' => 'prillian/log_body.tpl')
);

$page_title = $type_title;

include_once(PRILL_PATH . 'prill_header.'.$phpEx);

// Define basic or common template variables
$template->assign_vars(array(
	'IMG_LOGO' => $images['prill_logo'],
	'L_PRILLIAN' => $lang['Prillian'],

	'L_SENT' => $lang['Sent'],
	'L_RECEIVED' => $lang['Received'],
	'L_OFF_SENT' => $lang['Offsite_Sent'],
	'L_OFF_RECEIVED' => $lang['Offsite_Received'],

	'U_RECEIVED' => append_sid(PRILL_URL . '?mode=log&type=received'),
	'U_SENT' => append_sid(PRILL_URL . '?mode=log&type=sent'),
	'U_OFF_RECEIVED' => append_sid(PRILL_URL . '?mode=log&type=offreceived'),
	'U_OFF_SENT' => append_sid(PRILL_URL . '?mode=log&type=offsent'),
	'U_IM_PATH' => PRILL_PATH,

	'S_FORM_ACTION' => append_sid(PRILL_URL),
	'MESSAGES' => $type_title,
	'READ_WIDTH' => $im_userdata['read_width'],
	'READ_HEIGHT' => $im_userdata['read_height']
));


// Create message list and spawn pop-ups
if( $msgs_total )
{
	$s_hidden_fields = '<input type="hidden" name="type" value="' . $type . '" /><input type="hidden" name="mode" value="' . $mode . '" />';

	$template->assign_block_vars('switch_msg_list', array(
		'S_HIDDEN_FIELDS' => $s_hidden_fields,

		'L_SUBJECT' => $lang['Subject'],
		'L_FROM' => $lang['From'],
		'L_TO' => $lang['To'],
		'L_DATE' => $lang['Date'],
		'L_MARK_ALL' => $lang['Mark_all'],
		'L_UNMARK_ALL' => $lang['Unmark_all'],
		'L_DELETE' => $lang['Delete']
	));

	$left_pixels = 0;
	$right_pixels = 0;
	$i = 0;

	$orig_word = array();
	$replacement_word = array();
	obtain_word_list($orig_word, $replacement_word);

	foreach($all_msgs as $key=>$im)
	{
		$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
		$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
		$i++;

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

		$post_subject = $im['privmsgs_subject'];

		if( empty($post_subject) )
		{
			$post_subject = $default_im_subject;
		}
		elseif ( count($orig_word) )
		{
			$post_subject = preg_replace($orig_word, $replacement_word, $post_subject);
		}

		if( $im['privmsg_type'] != IM_READ_MAIL )
		{
			$read_mark = '&mark_read=1';
		}
		else
		{
			$read_mark = '';
		}

		switch($type)
		{
			case 'offsent':
				$receiver = $im['privmsgs_to_username'];
				$u_receiver = $u_profile_base . $im['privmsgs_to_userid'];
				$sent_mark = '&sent_mark=1';
				$read_mark = '';
				break;
			case 'offreceived':
				$sender = $im['privmsgs_from_username'];
				$u_sender = $u_profile_base . $im['privmsgs_from_userid'];
				break;
			case 'sent':
				$receiver = $im['username'];
				$u_receiver = $u_profile_base . $im['privmsgs_to_userid'];
				$sent_mark = '&sent_mark=1';
				$read_mark = '';
				break;
			case 'received':
			default:
				$sender = $im['username'];
				$u_sender = $u_profile_base . $im['privmsgs_from_userid'];
				break;
		}

		$template->assign_block_vars('switch_msg_list.switch_msg_row', array(
			'U_IMMSGS' => append_sid(PRILL_URL . '?mode=read&' . POST_POST_URL . '=' . $im['privmsgs_id'] . $read_mark . $sent_mark . $network_mark),
			'U_SENDER' => append_sid($u_sender),
			'U_RECEIVER' => append_sid($u_receiver),

			'S_MARK_ID' => $im['privmsgs_id'],

			'ROW_CLASS' => $row_class,
			'ROW_COLOR' => $row_color,
			'SUBJECT' => $post_subject,
			'SENDER' => $sender,
			'RECEIVER' => $receiver,
			'DATE' => create_date($board_config['default_dateformat'], $im['privmsgs_date'], $board_config['board_timezone']),
			'IMNUM' => $key,
			'LEFT_PX' => $left_pixels,
			'TOP_PX' => $right_pixels
		));
	}

	if ( !$result=$db->sql_query($msg_count_sql) )
	{
		$msg = 'Could not get total number of messages' . $append_msg;
		message_die(GENERAL_ERROR, $msg, '', __LINE__, __FILE__, $sql);
	}

	if ( !$row = $db->sql_fetchrow($result) )
	{
		$msg = 'Could not find total number of messages' . $append_msg;
		message_die(GENERAL_ERROR, $msg, '', __LINE__, __FILE__, $sql);
	}

	$pagination = generate_pagination(PRILL_URL . "?mode=$mode&amp;type=$type&amp;order=$sort_order", $row['total'], $board_config['topics_per_page'], $start);

	$template->assign_vars(array(
		'PAGINATION' => $pagination,
		'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $board_config['topics_per_page'] ) + 1 ), ceil( $row['total'] / $board_config['topics_per_page'] ))
	));
}
else
{
	// No messages.
	$template->assign_block_vars('switch_no_msg', array(
		'NO_MSG' => $no_msg
	));
	$template->assign_vars(array('PAGINATION' => '', 'PAGE_NUMBER' => ''));
}
// That's the end of the message list!


// Output the controls panel(s)
print_controls();

// End of File - imclient.php finishes things off

?>