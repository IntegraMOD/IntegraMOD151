<?php
/***************************************************************************
 *                                im_read.php
 *                            -------------------
 *   begin                : Tuesday, Nov 19, 2002
 *   version              : 1.5.0
 *   date                 : 2003/12/23 23:27
 ***************************************************************************/

if ( !defined('IN_PHPBB') || !defined('IN_PRILLIAN') )
{
	die('Hacking attempt');
}

$msg_id = ( !empty($_REQUEST[POST_POST_URL]) ) ? intval($_REQUEST[POST_POST_URL]) : '';

if ( !$msg_id )
{
	$msg = $lang['No_post_id'] . $append_msg;
	message_die(GENERAL_ERROR, $msg);
}

$adminmode = ( !empty($_REQUEST['adminmode']) ) ? intval($_REQUEST['adminmode']) : false;
$sent_mark = (!empty($_REQUEST['sent_mark'])) ? true : false;
$network_message = (!empty($_REQUEST['sitesite'])) ? true : false;
$template_body = 'prillian/read_body.tpl';

// Got to build a complex query to get the message now.  This is a pain...
if( $adminmode )
{
	if( $userdata['user_level'] != ADMIN )
	{
		die('Hacking Attempt');
	}

	$adminfrom = ( !empty($_REQUEST['adminfrom']) ) ? intval($_REQUEST['adminfrom']) : false;
	if ( !$adminfrom )
	{
		$msg = $lang['Admin_no_user_from'] . $append_msg;
		message_die(GENERAL_ERROR, $msg);
	}

	$adminto = ( !empty($_REQUEST['adminto']) ) ? intval($_REQUEST['adminto']) : false;
	if ( !$adminto )
	{
		$msg = $lang['Admin_no_user_to'] . $append_msg;
		message_die(GENERAL_ERROR, $msg);
	}

	$template_body = 'admin/imclient_admin_read.tpl';

	if( $network_message )
	{
		$msg_sql = 'AND pm.privmsgs_to_userid = ' . $adminto . ' AND u.user_id = pm.privmsgs_to_userid';
	}
	else
	{
		$msg_sql = 'AND pm.privmsgs_from_userid = ' . $adminfrom . ' AND pm.privmsgs_to_userid = ' . $adminto . ' AND u.user_id = pm.privmsgs_from_userid AND u2.user_id = pm.privmsgs_to_userid';
	}
}
elseif( $sent_mark )
{
	$msg_sql = 'AND pm.privmsgs_from_userid = ' . $userdata['user_id'] . ' AND u.user_id = pm.privmsgs_to_userid AND u2.user_id = pm.privmsgs_from_userid';
}
else
{
	if( $network_message )
	{
		$template_body = 'prillian/network_read_body.tpl';
		$msg_sql = 'AND pm.privmsgs_to_userid = ' . $userdata['user_id'] . ' AND u.user_id = pm.privmsgs_to_userid';
	}
	else
	{
		$msg_sql = 'AND pm.privmsgs_to_userid = ' . $userdata['user_id'] . ' AND u.user_id = pm.privmsgs_from_userid AND u2.user_id = pm.privmsgs_to_userid';
	}
}

if( $network_message )
{
	$sql = 'SELECT u.username, u.user_id, pm.*, ss.*, pmt.privmsgs_bbcode_uid, pmt.privmsgs_text FROM ' . PRIVMSGS_TABLE . ' pm, ' . PRIVMSGS_TEXT_TABLE . ' pmt, ' . USERS_TABLE . ' u, ' . IM_SITES_TABLE . ' ss WHERE pm.privmsgs_id = ' . $msg_id . '	AND pmt.privmsgs_text_id = pm.privmsgs_id ' . $msg_sql . ' AND pm.site_id = ss.site_id';
}
else
{
	$sql = 'SELECT u.username, u.user_id, u.user_sig_bbcode_uid, u.user_sig, pm.*, pmt.privmsgs_bbcode_uid, pmt.privmsgs_text, u2.username AS username2, u2.user_id AS user_id2 FROM ' . PRIVMSGS_TABLE . ' pm, ' . PRIVMSGS_TEXT_TABLE . ' pmt, ' . USERS_TABLE . ' u, ' . USERS_TABLE . ' u2 WHERE pm.privmsgs_id = ' . $msg_id . '	AND pmt.privmsgs_text_id = pm.privmsgs_id ' . $msg_sql;
}

if ( !($result = $db->sql_query($sql)) )
{
	$msg = 'Could not query instant message post information' . $append_msg;
	message_die(GENERAL_ERROR, $msg, '', __LINE__, __FILE__, $sql);
}

//
// Did the query return any data?
//
if ( !($im_msg = $db->sql_fetchrow($result)) )
{
	$msg = 'Could not get instant message post information' . $append_msg;
	message_die(GENERAL_ERROR, $msg, '', __LINE__, __FILE__, $sql);
}

//
// Update read mail status for the message. This is only done here if the
// user lists new IMs in the Main client, without having the new messages
// automatically pop-up, and the message has not already been read.
//
if( $mark_read && $im_msg['privmsgs_type'] != IM_READ_MAIL && !$sent_mark )
{
	if( $im_msg['privmsgs_type'] == PRIVMSGS_NEW_MAIL || $im_msg['privmsgs_type'] == PRIVMSGS_UNREAD_MAIL )
	{
		$type_to_mark = PRIVMSGS_READ_MAIL;
		$update_sql = 'UPDATE ' . USERS_TABLE . ' 
			SET user_new_privmsg = user_new_privmsg - 1
			WHERE user_id = ' . $userdata['user_id'];
	}
	else
	{
		$type_to_mark = IM_READ_MAIL;
		$update_sql = 'UPDATE ' . IM_PREFS_TABLE . ' 
			SET unread_ims = unread_ims - 1, read_ims = read_ims + 1
			WHERE user_id = ' . $userdata['user_id'];
	}

	$sql = 'UPDATE ' . PRIVMSGS_TABLE . '
		SET privmsgs_type = ' . $type_to_mark . "
		WHERE privmsgs_id=$msg_id";

	if ( !$db->sql_query($sql) )
	{
		$msg = 'Could not update instant message read status' . $append_msg;
		message_die(GENERAL_ERROR, $msg, '', __LINE__, __FILE__, $sql);
	}

	if ( !$db->sql_query($update_sql) )
	{
		$msg = 'Could not update instant message read number for user' . $append_msg;
		message_die(GENERAL_ERROR, $msg, '', __LINE__, __FILE__, $sql);
	}
}

$s_hidden_fields  = '<input type="hidden" name="mode" value="reply" /><input type="hidden" name="p" value="' . $msg_id . '" /><input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';

$page_title = $lang['Read_pm'];
include_once(PRILL_PATH . 'prill_header.'.$phpEx);

//
// Load templates
//
$template->set_filenames(array(
	'body' => $template_body)
);

if( $network_message )
{
	$from_image = $images['prill_offsite'];

	$s_hidden_fields .= '<input type="hidden" name="site_id" value="' . $im_msg['site_id'] . '" />';
	$u_username_from = append_sid($im_msg['site_url'] . 'profile.' . $im_msg['site_phpex'] . '?mode=viewprofile&amp;' . POST_USERS_URL . '=' . $im_msg['privmsgs_from_userid']);
	$username_from = $im_msg['privmsgs_from_username'];

	$u_username_to = append_sid($phpbb_root_path . "profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $im_msg['user_id']);
	$username_to = $im_msg['username'];
}
else
{
	$from_image = $images['prill_onsite'];
	$u_username_from = append_sid($phpbb_root_path . "profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $im_msg['user_id']);
	$username_from = $im_msg['username'];

	$u_username_to = append_sid($phpbb_root_path . "profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $im_msg['user_id2']);
	$username_to = $im_msg['username2'];
	$contact_list->get_list('all');
	$contact_links = $contact_list->get_image_links($im_msg['user_id'], $username_from, 0);
}



$post_date = create_date($board_config['default_dateformat'], $im_msg['privmsgs_date'], $board_config['board_timezone']);


//
// Processing of post
//
$post_subject = $im_msg['privmsgs_subject'];
if( empty($post_subject) )
{
	$post_subject = $default_im_subject;
}

$instant_message = $im_msg['privmsgs_text'];
$bbcode_uid = $im_msg['privmsgs_bbcode_uid'];

if ( $board_config['allow_sig'] && $im_userdata['attach_sig'] )
{
	$user_sig = ( $im_msg['privmsgs_from_userid'] == $userdata['user_id'] ) ? $userdata['user_sig'] : $im_msg['user_sig'];
}
else
{
	$user_sig = '';
}

$user_sig_bbcode_uid = ( $im_msg['privmsgs_from_userid'] == $userdata['user_id'] ) ? $userdata['user_sig_bbcode_uid'] : $im_msg['user_sig_bbcode_uid'];


//
// If the board has HTML off but the post has HTML
// on then we process it, else leave it alone
//
if ( !$board_config['allow_html'] && $im_msg['privmsgs_enable_html'] )
{
	if ( $user_sig != '' && $im_msg['privmsgs_enable_sig'] && $userdata['user_allowhtml'] )
	{
		$user_sig = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $user_sig);
	}

	if ( $im_msg['privmsgs_enable_html'] )
	{
		$instant_message = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $instant_message);
	}
}

if ( $user_sig != '' && $im_msg['privmsgs_attach_sig'] && $user_sig_bbcode_uid != '' )
{
	$user_sig = ( $board_config['allow_bbcode'] ) ? bbencode_second_pass($user_sig, $user_sig_bbcode_uid) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $user_sig);
}


if ( $bbcode_uid != '' )
{
	$instant_message = ( $board_config['allow_bbcode'] ) ? bbencode_second_pass($instant_message, $bbcode_uid) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $instant_message);
}

$instant_message = im_make_clickable($instant_message);

if ( $im_msg['privmsgs_attach_sig'] && $user_sig != '' )
{
	$instant_message .= '<br /><br />_________________<br />' . im_make_clickable($user_sig);
}


$orig_word = array();
$replacement_word = array();
obtain_word_list($orig_word, $replacement_word);

if ( count($orig_word) )
{
	$post_subject = preg_replace($orig_word, $replacement_word, $post_subject);
	$instant_message = preg_replace($orig_word, $replacement_word, $instant_message);
}

if ( $board_config['allow_smilies'] && $im_msg['privmsgs_enable_smilies'] )
{
	$board_config['smilies_path'] = $phpbb_root_path . $board_config['smilies_path'];
	$instant_message = smilies_pass($instant_message);
}

$instant_message = str_replace("\n", '<br />', $instant_message);

$reply_width = $im_userdata['send_width'];
// Add 25 pixels to height to compensate for what might be an Internet Explorer bug
$reply_height = $im_userdata['send_height'] + 25;

// Quick Reply Form
$s_quick_hidden = '<input type="hidden" name="username" value="' . $username_from . '" /><input type="hidden" name="subject" value="Re: ' . $post_subject . '" /><input type="hidden" name="mode" value="reply" /><input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';

//
// Dump it to the templating engine
//
$template->assign_vars(array(
	'S_POST_ACTION' => append_sid(PRILL_URL),
	'S_HIDDEN_FIELDS' => $s_hidden_fields,
	'S_QUICK_HIDDEN' => $s_quick_hidden,

	'L_SAVE_REPLY' => $lang['Save_reply_pm'],
	'L_SAVE_CLOSE' => $lang['Save_close_pm'],
	'L_REPLY' => $lang['Post_reply_pm'],
	'L_CLOSE_WINDOW' => $lang['Close_window'],
	'L_MESSAGE' => $lang['Message'],
	'L_FLAG' => $lang['Flag'],
	'L_SUBJECT' => $lang['Subject'],
	'L_POSTED' => $lang['Posted'],
	'L_DATE' => $lang['Date'],
	'L_FROM' => ( $sent_mark ) ? $lang['To'] : $lang['From'],
	'L_TO' => ( $sent_mark ) ? $lang['From'] : $lang['To'],
	'L_SUBMIT' => $lang['Submit'],
	'L_QUICK_REPLY' => $lang['IM_Quick_reply'],
	'L_EMPTY_MESSAGE' => $lang['Empty_message'],

	'U_TO' => $u_username_to,
	'U_FROM' => $u_username_from,
	'IMG_BUDDY' => $contact_links['img_buddy'],
	'IMG_IGNORE' => $contact_links['img_ignore'],
	'IMG_DISALLOW' => $contact_links['img_disallow'],
	'L_ALT_BUDDY' => $contact_links['l_buddy_alt'],
	'L_ALT_IGNORE' => $contact_links['l_ignore_alt'],
	'L_ALT_DISALLOW' => $contact_links['l_disallow_alt'],
	'U_BUDDY' => $contact_links['final_buddy_url'],
	'U_IGNORE' => $contact_links['final_ignore_url'],
	'U_DISALLOW' => $contact_links['final_disallow_url'],

	'SITE_FROM' => '<img src="' . $from_image . '" alt="' . $lang['User_from'] . $im_msg['site_name'] . '" align="center" />',
	'SITE_TO' => '<img src="' . $images['prill_onsite'] . '" alt="' . $lang['User_from'] . $board_config['sitename'] . '" align="center" />',

	'MESSAGE_TO' => $username_to,
	'MESSAGE_FROM' => $username_from,
	'POST_SUBJECT' => $post_subject,
	'POST_DATE' => $post_date,
	'MESSAGE' => $instant_message,
	'REPLY_WIDTH' => $reply_width,
	'REPLY_HEIGHT' => $reply_height
));

?>