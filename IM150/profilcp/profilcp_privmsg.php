<?php
/***************************************************************************
 *                            profilcp_privmsg.php
 *                            --------------------
 *	begin				: 16/05/2003
 *	copyright			: Ptirhiik
 *	email				: admin@rpgnet-fr.com
 *
 *	version				: 1.0.7 - 30/10/2003
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 *
 ***************************************************************************/

// start
if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
	exit;
}

if ( !empty($board_config['privmsg_disable']) ) return;

if( !empty($setmodules) )
{
	pcp_set_menu('privmsg', 80, __FILE__, 'Private_Messaging', 'Private_Messaging' );
	pcp_set_sub_menu('privmsg', 'inbox', 10, __FILE__, 'Inbox', 'Inbox' );
	pcp_set_sub_menu('privmsg', 'outbox', 20, __FILE__, 'Outbox', 'Outbox' );
	pcp_set_sub_menu('privmsg', 'sentbox', 30, __FILE__, 'Sentbox', 'Sentbox' );
	pcp_set_sub_menu('privmsg', 'savebox', 40, __FILE__, 'Savebox', 'Savebox' );
	return;
}
define('IN_PRIVMSG', true);
define('IN_CASHMOD', true); 
if ( defined('IN_CASHMOD') ) 
{ 
   include($phpbb_root_path . 'includes/functions_cash.'.$phpEx); 
}

$privmsg_mode = '';
if ( isset($_GET['privmsg_mode']) || isset($_POST['privmsg_mode']) )
{
	$privmsg_mode = (isset($_POST['privmsg_mode'])) ? $_POST['privmsg_mode'] : $_GET['privmsg_mode'];
}
$mode = $privmsg_mode;

//------------------------------------------------------------------------------
//
// Here starts the copy of privmsg.php
//
//------------------------------------------------------------------------------
$html_entities_match = array('#&(?!(\#[0-9]+;))#', '#<#', '#>#', '#"#');
$html_entities_replace = array('&amp;', '&lt;', '&gt;', '&quot;');

//
// Parameters
//
$submit			= isset($_POST['post']);
$submit_search	= isset($_POST['usersubmit']);
$submit_msgdays	= isset($_POST['submit_msgdays']);
$cancel			= isset($_POST['cancel']);
$preview		= isset($_POST['preview']);
$confirm		= isset($_POST['confirm']);
$delete			= isset($_POST['delete']);
$delete_all		= isset($_POST['deleteall']);
$save			= isset($_POST['save']);
$refresh		= $preview || $submit_search;
$mark_list		= ( !empty($_POST['mark']) ) ? $_POST['mark'] : 0;
$folder			= $sub;
$sid = (isset($_POST['sid'])) ? $_POST['sid'] : 0;

//
// Var definitions
//
$start = ( !empty($_GET['start']) ) ? intval($_GET['start']) : 0;
$start = ($start < 0) ? 0 : $start;

$privmsg_id = '';
if ( isset($_POST[POST_POST_URL]) || isset($_GET[POST_POST_URL]) )
{
	$privmsg_id = ( isset($_POST[POST_POST_URL]) ) ? intval($_POST[POST_POST_URL]) : intval($_GET[POST_POST_URL]);
}

// View PM while replying MOD, By Manipe
if ( isset($_POST['id_for_pm_track']) )
{
	$id_for_pm_track_post_vars = intval($_POST['id_for_pm_track']);
}
else
{
	$id_for_pm_track_post_vars = '';
}

// For a security
$pm_track_id = TRUE;
// View PM while replying MOD, By Manipe

$error = FALSE;

execute_privmsgs_attachment_handling($mode);
// ----------
// Start main
//
if ( $mode == 'read' )
{
	if ( !empty($_GET[POST_POST_URL]) )
	{
		$privmsgs_id = intval($_GET[POST_POST_URL]);
	}
	else
	{
		message_die(GENERAL_ERROR, $lang['No_post_id']);
	}

	if ( !$userdata['session_logged_in'] )
	{
		redirect(append_sid("login.$phpEx?redirect=profile.$phpEx&mode=privmsg&privmsg_mode=$mode&sub=$folder&" . POST_POST_URL . "=$privmsgs_id", true));
	}

	//
	// SQL to pull appropriate message, prevents nosey people
	// reading other peoples messages ... hopefully!
	//
	switch( $folder )
	{
		case 'inbox':
			$l_box_name = $lang['Inbox'];
			$pm_sql_user = "AND pm.privmsgs_to_userid = " . $userdata['user_id'] . " 
				AND ( pm.privmsgs_type = " . PRIVMSGS_READ_MAIL . " 
					OR pm.privmsgs_type = " . PRIVMSGS_NEW_MAIL . " 
					OR pm.privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " )";
			break;
		case 'outbox':
			$l_box_name = $lang['Outbox'];
			$pm_sql_user = "AND pm.privmsgs_from_userid =  " . $userdata['user_id'] . " 
				AND ( pm.privmsgs_type = " . PRIVMSGS_NEW_MAIL . "
					OR pm.privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " ) ";
			break;
		case 'sentbox':
			$l_box_name = $lang['Sentbox'];
			$pm_sql_user = "AND pm.privmsgs_from_userid =  " . $userdata['user_id'] . " 
				AND pm.privmsgs_type = " . PRIVMSGS_SENT_MAIL;
			break;
		case 'savebox':
			$l_box_name = $lang['Savebox'];
			$pm_sql_user .= "AND ( ( pm.privmsgs_to_userid = " . $userdata['user_id'] . "
					AND pm.privmsgs_type = " . PRIVMSGS_SAVED_IN_MAIL . " ) 
				OR ( pm.privmsgs_from_userid = " . $userdata['user_id'] . "
					AND pm.privmsgs_type = " . PRIVMSGS_SAVED_OUT_MAIL . " ) 
				)";
			break;
		default:
			message_die(GENERAL_ERROR, $lang['No_such_folder']);
			break;
	}

	//
	// Major query obtains the message ...
	//
	$sql = "SELECT u.user_group_id AS user_group_id_1, u2.user_group_id AS user_group_id_2, u.user_session_time AS user_session_time_1, u2.user_session_time AS user_session_time_2,  u.username AS username_1, u.user_id AS user_id_1, u2.username AS username_2, u2.user_id AS user_id_2, u.user_sig_bbcode_uid, u.user_posts, u.user_from, u.user_website, u.user_email, u.user_icq, u.user_aim, u.user_yim, u.user_regdate, u.user_msnm, u.user_viewemail, u.user_rank, u.user_sig, u.user_avatar, pm.*, pmt.privmsgs_bbcode_uid, pmt.privmsgs_text
		FROM " . PRIVMSGS_TABLE . " pm, " . PRIVMSGS_TEXT_TABLE . " pmt, " . USERS_TABLE . " u, " . USERS_TABLE . " u2 
		WHERE pm.privmsgs_id = $privmsgs_id
			AND pmt.privmsgs_text_id = pm.privmsgs_id 
			$pm_sql_user 
			AND u.user_id = pm.privmsgs_from_userid 
			AND u2.user_id = pm.privmsgs_to_userid";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not query private message post information', '', __LINE__, __FILE__, $sql);
	}

	//
	// Did the query return any data?
	//
	if ( !($privmsg = $db->sql_fetchrow($result)) )
	{
		$ret_link = append_sid("profile.$phpEx?mode=privmsg&sub=inbox");
		$message = $lang['Topic_post_not_exist'] . '<br /><br />' . sprintf($lang['Click_return_inbox'], '<a href="' . $ret_link . '">', "</a>") . '<br /><br />';
		message_die(GENERAL_MESSAGE, $message);
	}

	$privmsg_id = $privmsg['privmsgs_id'];

	// list of all IDs, current + reviewing
	$privmsg_ids = array($privmsg['privmsgs_id']);

// View PM while replying MOD, By Manipe
	$id_for_pm_track = ($privmsg_id) ? $privmsg_id : $id_for_pm_track_post_vars;

	if ($id_for_pm_track)
	{
		// $pass to 1, so that we don't display review if there's only one
		$pm_track_id = pm_track_all_history($id_for_pm_track, $privmsgs_id, 1);
	}
// View PM while replying MOD, By Manipe

	//
	// Is this a new message in the inbox? If it is then save
	// a copy in the posters sent box
	//
	if (($privmsg['privmsgs_type'] == PRIVMSGS_NEW_MAIL || $privmsg['privmsgs_type'] == PRIVMSGS_UNREAD_MAIL) && $folder == 'inbox')
	{
		// Update appropriate counter
		switch ($privmsg['privmsgs_type'])
		{
			case PRIVMSGS_NEW_MAIL:
				$sql = "user_new_privmsg = user_new_privmsg - 1";
				break;
			case PRIVMSGS_UNREAD_MAIL:
				$sql = "user_unread_privmsg = user_unread_privmsg - 1";
				break;
		}

		$sql = "UPDATE " . USERS_TABLE . " 
			SET $sql 
			WHERE user_id = " . $userdata['user_id'];
		if ( !$db->sql_query($sql) )
		{
			//V: ignore this error. This means we messed up the unread count at some point.
			//   the error only happens if user_xxx - 1 would be negative. We can safely ignore it and stay at 0.
			//message_die(GENERAL_ERROR, 'Could not update private message read status for user', '', __LINE__, __FILE__, $sql);
		}

		$sql = "UPDATE " . PRIVMSGS_TABLE . "
			SET privmsgs_type = " . PRIVMSGS_READ_MAIL . "
			WHERE privmsgs_id = " . $privmsg['privmsgs_id'];
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not update private message read status', '', __LINE__, __FILE__, $sql);
		}

		// Check to see if the poster has a 'full' sent box
		$sql = "SELECT COUNT(privmsgs_id) AS sent_items, MIN(privmsgs_date) AS oldest_post_time 
			FROM " . PRIVMSGS_TABLE . " 
			WHERE privmsgs_type = " . PRIVMSGS_SENT_MAIL . " 
				AND privmsgs_from_userid = " . $privmsg['privmsgs_from_userid'];
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain sent message info for sendee', '', __LINE__, __FILE__, $sql);
		}

		if ( $sent_info = $db->sql_fetchrow($result) )
		{
			if ($board_config['max_sentbox_privmsgs'] && $sent_info['sent_items'] >= $board_config['max_sentbox_privmsgs'])
			{
				$sql = "SELECT privmsgs_id FROM " . PRIVMSGS_TABLE . " 
					WHERE privmsgs_type = " . PRIVMSGS_SENT_MAIL . " 
						AND privmsgs_date = " . $sent_info['oldest_post_time'] . " 
						AND privmsgs_from_userid = " . $privmsg['privmsgs_from_userid'];
				if ( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not find oldest privmsgs', '', __LINE__, __FILE__, $sql);
				}
				$old_privmsgs_id = $db->sql_fetchrow($result);
				$old_privmsgs_id = $old_privmsgs_id['privmsgs_id'];
			
				$sql = "DELETE FROM " . PRIVMSGS_TABLE . " 
					WHERE privmsgs_id = $old_privmsgs_id";
				if ( !$db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not delete oldest privmsgs (sent)', '', __LINE__, __FILE__, $sql);
				}

				$sql = "DELETE FROM " . PRIVMSGS_TEXT_TABLE . " 
					WHERE privmsgs_text_id = $old_privmsgs_id";
				if ( !$db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not delete oldest privmsgs text (sent)', '', __LINE__, __FILE__, $sql);
				}
			}
		}
// View PM while replying MOD, By Manipe
		$privmsgs_track_id = $privmsg['privmsgs_track_id'];

		if ( $privmsgs_track_id == 0 )
		{
			$sql = "UPDATE " . PRIVMSGS_TABLE . "
				SET privmsgs_track_id = $privmsg_id 
				WHERE privmsgs_id = $privmsg_id";
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not update private message', '', __LINE__, __FILE__, $sql);
			}
			$privmsgs_track_id = $privmsg_id;
		}
	// END View PM while replying MOD, By Manipe

		//
		// This makes a copy of the post and stores it as a SENT message from the sendee. Perhaps
		// not the most DB friendly way but a lot easier to manage, besides the admin will be able to
		// set limits on numbers of storable posts for users ... hopefully!
		//
		$sql = "INSERT INTO " . PRIVMSGS_TABLE . " (privmsgs_type, privmsgs_subject, privmsgs_from_userid, privmsgs_to_userid, privmsgs_date, privmsgs_ip, privmsgs_enable_html, privmsgs_enable_bbcode, privmsgs_enable_smilies, privmsgs_attach_sig, privmsgs_track_id)
			VALUES (" . PRIVMSGS_SENT_MAIL . ", '" . str_replace("\'", "''", addslashes($privmsg['privmsgs_subject'])) . "', " . $privmsg['privmsgs_from_userid'] . ", " . $privmsg['privmsgs_to_userid'] . ", " . $privmsg['privmsgs_date'] . ", '" . $privmsg['privmsgs_ip'] . "', " . $privmsg['privmsgs_enable_html'] . ", " . $privmsg['privmsgs_enable_bbcode'] . ", " . $privmsg['privmsgs_enable_smilies'] . ", " .  $privmsg['privmsgs_attach_sig'] . ", " .  $privmsgs_track_id . ")";
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not insert private message sent info', '', __LINE__, __FILE__, $sql);
		}

		$privmsg_sent_id = $db->sql_nextid();

		$sql = "INSERT INTO " . PRIVMSGS_TEXT_TABLE . " (privmsgs_text_id, privmsgs_bbcode_uid, privmsgs_text)
			VALUES ($privmsg_sent_id, '" . $privmsg['privmsgs_bbcode_uid'] . "', '" . str_replace("\'", "''", addslashes($privmsg['privmsgs_text'])) . "')";
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not insert private message sent text', '', __LINE__, __FILE__, $sql);
		}

		// V: moved this duplication code into the if
		$attachment_mod['pm']->duplicate_attachment_pm($privmsg['privmsgs_attachment'], $privmsg['privmsgs_id'], $privmsg_sent_id);
	}

	//
	// Pick a folder, any folder, so long as it's one below ...
	//
	$post_urls = array(
		'post' => append_sid("profile.$phpEx?mode=privmsg&privmsg_mode=post"),
		'reply' => append_sid("profile.$phpEx?mode=privmsg&privmsg_mode=reply&amp;" . POST_POST_URL . "=$privmsg_id"),
		'quote' => append_sid("profile.$phpEx?mode=privmsg&privmsg_mode=quote&amp;" . POST_POST_URL . "=$privmsg_id"),
		'edit' => append_sid("profile.$phpEx?mode=privmsg&privmsg_mode=edit&amp;" . POST_POST_URL . "=$privmsg_id")
	);
	$post_icons = array(
		'post_img' => '<a class="button_new" href="' . $post_urls['post'] . '" title="' . $lang['Post_new_pm'] . '"><span>' . $lang['Post_new_pm'] . '</span></a>',
		'post' => '<a href="' . $post_urls['post'] . '">' . $lang['Post_new_pm'] . '</a>',
		'reply_img' => '<a class="button_reply" href="' . $post_urls['reply'] . '" title="' . $lang['Post_reply_pm'] . '"><span>' . $lang['Post_reply_pm'] . '</span></a>',
		'reply' => '<a href="' . $post_urls['reply'] . '">' . $lang['Post_reply_pm'] . '</a>',
		'quote_img' => '<a class="icon_quote" href="' . $post_urls['quote'] . '" title="' . $lang['Post_quote_pm'] . '"><span>' . $lang['Quote'] . '</span></a>',
		'quote' => '<a href="' . $post_urls['quote'] . '">' . $lang['Post_quote_pm'] . '</a>',
		'edit_img' => '<a class="icon_edit" href="' . $post_urls['edit'] . '"><span>' . $lang['Edit_pm'] . '</span></a>',
		'edit' => '<a href="' . $post_urls['edit'] . '" />' . $lang['Edit_pm'] . '</a>'
	);

	if ( $folder == 'inbox' )
	{
		$post_img = $post_icons['post_img'];
		$reply_img = $post_icons['reply_img'];
		$quote_img = $post_icons['quote_img'];
		$edit_img = '';
		$post = $post_icons['post'];
		$reply = $post_icons['reply'];
		$quote = $post_icons['quote'];
		$edit = '';
		$l_box_name = $lang['Inbox'];
	}
	else if ( $folder == 'outbox' )
	{
		$post_img = $post_icons['post_img'];
		$reply_img = '';
		$quote_img = '';
		$edit_img = $post_icons['edit_img'];
		$post = $post_icons['post'];
		$reply = '';
		$quote = '';
		$edit = $post_icons['edit'];
		$l_box_name = $lang['Outbox'];
	}
	else if ( $folder == 'savebox' )
	{
		if ( $privmsg['privmsgs_type'] == PRIVMSGS_SAVED_IN_MAIL )
		{
			$post_img = $post_icons['post_img'];
			$reply_img = $post_icons['reply_img'];
			$quote_img = $post_icons['quote_img'];
			$edit_img = '';
			$post = $post_icons['post'];
			$reply = $post_icons['reply'];
			$quote = $post_icons['quote'];
			$edit = '';
		}
		else
		{
			$post_img = $post_icons['post_img'];
			$reply_img = '';
			$quote_img = '';
			$edit_img = '';
			$post = $post_icons['post'];
			$reply = '';
			$quote = '';
			$edit = '';
		}
		$l_box_name = $lang['Saved'];
	}
	else if ( $folder == 'sentbox' )
	{
		$post_img = $post_icons['post_img'];
		$reply_img = '';
		$quote_img = '';
		$edit_img = '';
		$post = $post_icons['post'];
		$reply = '';
		$quote = '';
		$edit = '';
		$l_box_name = $lang['Sent'];
	}

	$s_hidden_fields = '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" /><input type="hidden" name="mark[]" value="' . $privmsgs_id . '" />';

	$page_title = $lang['Read_pm'];

	//
	// Load templates
	//
	$template->set_filenames(array(
		'body' => 'privmsgs_read_body.tpl')
	);

	$template->assign_vars(array(
		'POST_PM_IMG' => $post_img, 
		'REPLY_PM_IMG' => $reply_img, 
		'EDIT_PM_IMG' => $edit_img, 
		'QUOTE_PM_IMG' => $quote_img, 
		'POST_PM' => $post, 
		'REPLY_PM' => $reply, 
		'EDIT_PM' => $edit, 
		'QUOTE_PM' => $quote,

		'BOX_NAME' => $l_box_name, 

		'L_MESSAGE' => $lang['Message'], 
		'L_INBOX' => $lang['Inbox'],
		'L_OUTBOX' => $lang['Outbox'],
		'L_SENTBOX' => $lang['Sent'],
		'L_SAVEBOX' => $lang['Saved'],
		'L_FLAG' => $lang['Flag'],
		'L_SUBJECT' => $lang['Subject'],
		'L_POSTED' => $lang['Posted'], 
		'L_DATE' => $lang['Date'],
		'L_FROM' => $lang['From'],
		'L_TO' => $lang['To'], 
		'L_SAVE_MSG' => $lang['Save_message'], 
		'L_DELETE_MSG' => $lang['Delete_message'], 

		'S_PRIVMSGS_ACTION' => append_sid("profile.$phpEx?mode=privmsg&sub=$folder"),
		'S_HIDDEN_FIELDS' => $s_hidden_fields)
	);

//-- mod : Advanced Group Color Management -------------------------------------
//-- delete
//	$username_from = $privmsg['username_1'];
//-- add
	$username_from = $agcm_color->get_user_color($privmsg['user_group_id_1'], $privmsg['user_session_time_1'], $privmsg['username_1']);
//-- fin mod : Advanced Group Color Management ---------------------------------
	$user_id_from = $privmsg['user_id_1'];
//-- mod : Advanced Group Color Management -------------------------------------
//-- delete
//	$username_to = $privmsg['username_2'];
//-- add
	$username_to = $agcm_color->get_user_color($privmsg['user_group_id_2'], $privmsg['user_session_time_2'], $privmsg['username_2']);
//-- fin mod : Advanced Group Color Management ---------------------------------
	$user_id_to = $privmsg['user_id_2'];
	init_display_pm_attachments($privmsg['privmsgs_attachment'], $privmsg['privmsgs_id']);

	$post_date = create_date($board_config['default_dateformat'], $privmsg['privmsgs_date'], $board_config['board_timezone']);

	//--------------------------------------------
	//
	//	to user info
	//
	//--------------------------------------------
	// ids
	$user_id		= $userdata['user_id'];
	$view_user_id	= $user_id_to;

	// re-read the user_to to have all the fields
	$sql = "SELECT * FROM " . USERS_TABLE . " WHERE user_id=$user_id_to";
	if ( !($result = $db->sql_query($sql)) ) message_die(GENERAL_ERROR, 'Could not read from user info', '', __LINE__, __FILE__, $sql);
	$user_to = $db->sql_fetchrow($result);

	// get user relational status with user_to
	$view_user_id = $user_to['user_id'];
	$sql = "SELECT * FROM " . BUDDYS_TABLE . " WHERE user_id=$view_user_id AND buddy_id=$user_id";
	if ( !($result = $db->sql_query($sql)) ) message_die(GENERAL_ERROR, 'Could not read from user buddy info', '', __LINE__, __FILE__, $sql);
	$buddys = $db->sql_fetchrow($result);

	$sql = "SELECT * FROM " . BUDDYS_TABLE . " WHERE user_id=$user_id AND buddy_id=$view_user_id";
	if ( !($result = $db->sql_query($sql)) ) message_die(GENERAL_ERROR, 'Could not read my buddies info', '', __LINE__, __FILE__, $sql);
	$my_buddys = $db->sql_fetchrow($result);

	$privmsg['user_friend']		= isset($buddys['buddy_ignore']) ? !$buddys['buddy_ignore'] : false;
	$privmsg['user_ignore']		= $buddys['buddy_ignore'];
	$privmsg['user_visible']	= $buddys['buddy_visible'];
	$privmsg['user_my_friend']	= isset($my_buddys['buddy_ignore']) ? !$my_buddys['buddy_ignore'] :false;
	$privmsg['user_my_ignore']	= $my_buddys['buddy_ignore'];
	$privmsg['user_visible']	= $my_buddys['buddy_visible'];

	// get user_to values
	@reset($user_to);
	while ( list($key, $value) = @each($user_to) )
	{
		$key_n = intval($key);
		if ("$key_n" != $key)
		{
			$privmsg[$key] = $value;
		}
	}

	// get the to panels
	$to_panel			= pcp_output_panel('PHPBB.privmsgs.left', $privmsg);
	$to_ignore_panel	= pcp_output_panel('PHPBB.privmsgs.left.ignore', $privmsg);

	//--------------------------------------------
	//
	//	from user info
	//
	//--------------------------------------------
	// ids
	$user_id		= $userdata['user_id'];
	$view_user_id	= $user_id_from;

	// re-read the user_from to have all the fields
	$sql = "SELECT * FROM " . USERS_TABLE . " WHERE user_id=$user_id_from";
	if ( !($result = $db->sql_query($sql)) ) message_die(GENERAL_ERROR, 'Could not read from user info', '', __LINE__, __FILE__, $sql);
	$user_from = $db->sql_fetchrow($result);

	// get user relational status
	$sql = "SELECT * FROM " . BUDDYS_TABLE . " WHERE user_id=$view_user_id AND buddy_id=$user_id";
	if ( !($result = $db->sql_query($sql)) ) message_die(GENERAL_ERROR, 'Could not read from user buddy info', '', __LINE__, __FILE__, $sql);
	$buddys = $db->sql_fetchrow($result);

	$sql = "SELECT * FROM " . BUDDYS_TABLE . " WHERE user_id=$user_id AND buddy_id=$view_user_id";
	if ( !($result = $db->sql_query($sql)) ) message_die(GENERAL_ERROR, 'Could not read my buddies info', '', __LINE__, __FILE__, $sql);
	$my_buddys = $db->sql_fetchrow($result);

	$privmsg['user_friend']		= isset($buddys['buddy_ignore']) ? !$buddys['buddy_ignore'] : false;
	$privmsg['user_ignore']		= $buddys['buddy_ignore'];
	$privmsg['user_visible']	= $buddys['buddy_visible'];
	$privmsg['user_my_friend']	= isset($my_buddys['buddy_ignore']) ? !$my_buddys['buddy_ignore'] :false;
	$privmsg['user_my_ignore']	= $my_buddys['buddy_ignore'];
	$privmsg['user_visible']	= $my_buddys['buddy_visible'];

	// get user_from values
	@reset($user_from);
	while ( list($key, $value) = @each($user_from) )
	{
		$key_n = intval($key);
		if ("$key_n" != $key)
		{
			$privmsg[$key] = $value;
		}
	}

	// sig
	if (!$userdata['user_viewsig'] || !$privmsg['user_allowsignature'])
	{
		$privmsg['user_sig'] = '';
	}

	// get the from panels
	$from_panel			= pcp_output_panel('PHPBB.privmsgs.left', $privmsg);
	$buttons_panel		= pcp_output_panel('PHPBB.privmsgs.buttons', $privmsg);
	$from_ignore_panel	= pcp_output_panel('PHPBB.privmsgs.left.ignore', $privmsg);
	$ignore_buttons		= pcp_output_panel('PHPBB.privmsgs.buttons.ignore', $privmsg);

	$temp_url = append_sid("search.$phpEx?search_author=" . urlencode($username_from) . "&amp;showresults=posts");
	$search_img = '<a class="icon_search" href="' . $temp_url . '" title="' . sprintf($lang['Search_user_posts'], $username_from)  . '"><span>' . $lang['Search']  . '</span></a>';
	$search = '<a href="' . $temp_url . '">' . sprintf($lang['Search_user_posts'], $username_from)  . '</a>';

	//
	// Processing of post
	//
	$post_subject = $privmsg['privmsgs_subject'];

	$private_message = $privmsg['privmsgs_text'];
	$bbcode_uid = $privmsg['privmsgs_bbcode_uid'];

	if ( $board_config['allow_sig'] )
	{
		$user_sig = ( $privmsg['privmsgs_from_userid'] == $userdata['user_id'] ) ? $userdata['user_sig'] : $privmsg['user_sig'];
	}
	else
	{
		$user_sig = '';
	}

	$user_sig_bbcode_uid = ( $privmsg['privmsgs_from_userid'] == $userdata['user_id'] ) ? $userdata['user_sig_bbcode_uid'] : $privmsg['user_sig_bbcode_uid'];

	//
	// If the board has HTML off but the post has HTML
	// on then we process it, else leave it alone
	//
	if ( !$board_config['allow_html'] )
	{
		if ( $user_sig != '' && $privmsg['privmsgs_enable_sig'] && $userdata['user_allowhtml'] )
		{
			$user_sig = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $user_sig);
		}

		if ( $privmsg['privmsgs_enable_html'] )
		{
			$private_message = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $private_message);
		}
	}

	if ( $user_sig != '' && $privmsg['privmsgs_attach_sig'] && $user_sig_bbcode_uid != '' )
	{
		$user_sig = ( $board_config['allow_bbcode'] ) ? bbencode_second_pass($user_sig, $user_sig_bbcode_uid) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $user_sig);
	}

	if ( $bbcode_uid != '' )
	{
		$private_message = ( $board_config['allow_bbcode'] ) ? bbencode_second_pass($private_message, $bbcode_uid) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $private_message);
	}

	$private_message = make_clickable($private_message);

	if ( $privmsg['privmsgs_attach_sig'] && $user_sig != '' )
	{
		$private_message .= '<br /><br />_________________<br />' . make_clickable($user_sig);
	}

	$orig_word = array();
	$replacement_word = array();
	obtain_word_list($orig_word, $replacement_word);

	if ( count($orig_word) )
	{
		$post_subject = preg_replace($orig_word, $replacement_word, $post_subject);
		$private_message = preg_replace($orig_word, $replacement_word, $private_message);
	}

	if ( $board_config['allow_smilies'] && $privmsg['privmsgs_enable_smilies'] )
	{
		$private_message = smilies_pass($private_message);
	}

	$private_message = str_replace("\n", '<br />', $private_message);
	$private_message = str_replace(".script", "script", $private_message);

	//
	// Dump it to the templating engine
	//
	$template->assign_vars(array(
		'AUTHOR_PANEL'	=> !$privmsg['user_my_ignore'] ? $from_panel : $from_ignore_panel,
		'DEST_PANEL'	=> !$privmsg['user_my_ignore'] ? $to_panel : $to_ignore_panel,
		'BUTTONS_PANEL'	=> !$privmsg['user_my_ignore'] ? $buttons_panel : $ignore_buttons,

		'POST_SUBJECT' => $post_subject,
		'POST_DATE' => $post_date, 
		'MESSAGE' => $private_message,

		'SEARCH_IMG' => $search_img,
		'SEARCH' => $search,
		)
	);

	$template->pparse('body');
}
else if ( ( $delete && $mark_list ) || $delete_all )
{
	if ( !$userdata['session_logged_in'] )
	{
		redirect(append_sid("login.$phpEx?redirect=profile.$phpEx&mode=privmsg&sub=inbox", true));
	}

	// session id check
	if ( ($sid == '' || $sid != $userdata['session_id']) && !defined('NO_SID') )
	{
		message_die(GENERAL_ERROR, 'Invalid_session');
	}

	if ( isset($mark_list) && !is_array($mark_list) )
	{
		// Set to empty array instead of '0' if nothing is selected.
		$mark_list = array();
	}

	if ( !$confirm )
	{
		$s_hidden_fields = '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';
		$s_hidden_fields .= '<input type="hidden" name="mode" value="privmsg" />';
		$s_hidden_fields .= '<input type="hidden" name="privmsg_mode" value="' . $mode . '" />';
		$s_hidden_fields .= '<input type="hidden" name="sub" value="' . $folder . '" />';
		$s_hidden_fields .= ( isset($_POST['delete']) ) ? '<input type="hidden" name="delete" value="true" />' : '<input type="hidden" name="deleteall" value="true" />';

		for($i = 0; $i < count($mark_list); $i++)
		{
			$s_hidden_fields .= '<input type="hidden" name="mark[]" value="' . intval($mark_list[$i]) . '" />';
		}

		//
		// Output confirmation page
		//
		$template->set_filenames(array(
			'confirm_body' => 'confirm_body.tpl')
		);
		$template->assign_vars(array(
			// erase index sentence
			'L_INDEX' => '',

			'MESSAGE_TITLE' => $lang['Information'],
			'MESSAGE_TEXT' => ( count($mark_list) == 1 ) ? $lang['Confirm_delete_pm'] : $lang['Confirm_delete_pms'], 

			'L_YES' => $lang['Yes'],
			'L_NO' => $lang['No'],
			'S_CONFIRM_ACTION' => append_sid("profile.$phpEx?mode=privmsg&sub=$folder"),
			'S_HIDDEN_FIELDS' => $s_hidden_fields)
		);

		$template->pparse('confirm_body');
	}
	else if ( $confirm )
	{
		$delete_sql_id = '';

		if (!$delete_all)
		{
			 for ($i = 0; $i < count($mark_list); $i++)
			 {
					$delete_sql_id .= (($delete_sql_id != '') ? ', ' : '') . intval($mark_list[$i]);
			 }
			 $delete_sql_id = "AND privmsgs_id IN ($delete_sql_id)";
		}

		switch($folder)
		{
			 case 'inbox':
					$delete_type = "privmsgs_to_userid = " . $userdata['user_id'] . " AND (
					privmsgs_type = " . PRIVMSGS_READ_MAIL . " OR privmsgs_type = " . PRIVMSGS_NEW_MAIL . " OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " )";
					break;

			 case 'outbox':
					$delete_type = "privmsgs_from_userid = " . $userdata['user_id'] . " AND ( privmsgs_type = " . PRIVMSGS_NEW_MAIL . " OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " )";
					break;

			 case 'sentbox':
					$delete_type = "privmsgs_from_userid = " . $userdata['user_id'] . " AND privmsgs_type = " . PRIVMSGS_SENT_MAIL;
					break;

			 case 'savebox':
					$delete_type = "( ( privmsgs_from_userid = " . $userdata['user_id'] . " 
						 AND privmsgs_type = " . PRIVMSGS_SAVED_OUT_MAIL . " ) 
					OR ( privmsgs_to_userid = " . $userdata['user_id'] . " 
						 AND privmsgs_type = " . PRIVMSGS_SAVED_IN_MAIL . " ) )";
					break;
		}

		$sql = "SELECT privmsgs_id
			 FROM " . PRIVMSGS_TABLE . "
			 WHERE $delete_type $delete_sql_id";

		if ( !($result = $db->sql_query($sql)) )
		{
			 message_die(GENERAL_ERROR, 'Could not obtain id list to delete messages', '', __LINE__, __FILE__, $sql);
		}

		$mark_list = array();
		while ( $row = $db->sql_fetchrow($result) )
		{
			 $mark_list[] = $row['privmsgs_id'];
		}

		unset($delete_type);

		$attachment_mod['pm']->delete_all_pm_attachments($mark_list);

		if ( count($mark_list) )
		{
			$delete_sql_id = '';
			for ($i = 0; $i < sizeof($mark_list); $i++)
			{
				$delete_sql_id .= (($delete_sql_id != '') ? ', ' : '') . intval($mark_list[$i]);
			}

			if ($folder == 'inbox' || $folder == 'outbox')
			{
				switch ($folder)
				{
					case 'inbox':
						$sql = "privmsgs_to_userid = " . $userdata['user_id'];
						break;
					case 'outbox':
						$sql = "privmsgs_from_userid = " . $userdata['user_id'];
						break;
				}

				// Get information relevant to new or unread mail
				// so we can adjust users counters appropriately
				$sql = "SELECT privmsgs_to_userid, privmsgs_type 
					FROM " . PRIVMSGS_TABLE . " 
					WHERE privmsgs_id IN ($delete_sql_id) 
						AND $sql  
						AND privmsgs_type IN (" . PRIVMSGS_NEW_MAIL . ", " . PRIVMSGS_UNREAD_MAIL . ")";
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Could not obtain user id list for outbox messages', '', __LINE__, __FILE__, $sql);
				}

				if ( $row = $db->sql_fetchrow($result))
				{
					$update_users = $update_list = array();
				
					do
					{
						switch ($row['privmsgs_type'])
						{
							case PRIVMSGS_NEW_MAIL:
								$update_users['new'][$row['privmsgs_to_userid']]++;
								break;

							case PRIVMSGS_UNREAD_MAIL:
								$update_users['unread'][$row['privmsgs_to_userid']]++;
								break;
						}
					}
					while ($row = $db->sql_fetchrow($result));

					if (sizeof($update_users))
					{
						while (list($type, $users) = each($update_users))
						{
							while (list($user_id, $dec) = each($users))
							{
								$update_list[$type][$dec][] = $user_id;
							}
						}
						unset($update_users);

						while (list($type, $dec_ary) = each($update_list))
						{
							switch ($type)
							{
								case 'new':
									$type = "user_new_privmsg";
									break;

								case 'unread':
									$type = "user_unread_privmsg";
									break;
							}

							while (list($dec, $user_ary) = each($dec_ary))
							{
								$user_ids = implode(', ', $user_ary);

								$sql = "UPDATE " . USERS_TABLE . " 
									SET $type = $type - $dec 
									WHERE user_id IN ($user_ids)";
								if ( !$db->sql_query($sql) )
								{
									message_die(GENERAL_ERROR, 'Could not update user pm counters', '', __LINE__, __FILE__, $sql);
								}
							}
						}
						unset($update_list);
					}
				}
				$db->sql_freeresult($result);
			}

			// Delete the messages
			$delete_text_sql = "DELETE FROM " . PRIVMSGS_TEXT_TABLE . "
				WHERE privmsgs_text_id IN ($delete_sql_id)";
			$delete_sql = "DELETE FROM " . PRIVMSGS_TABLE . "
				WHERE privmsgs_id IN ($delete_sql_id)
					AND ";

			switch( $folder )
			{
				case 'inbox':
					$delete_sql .= "privmsgs_to_userid = " . $userdata['user_id'] . " AND (
						privmsgs_type = " . PRIVMSGS_READ_MAIL . " OR privmsgs_type = " . PRIVMSGS_NEW_MAIL . " OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " )";
					break;

				case 'outbox':
					$delete_sql .= "privmsgs_from_userid = " . $userdata['user_id'] . " AND ( 
						privmsgs_type = " . PRIVMSGS_NEW_MAIL . " OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " )";
					break;

				case 'sentbox':
					$delete_sql .= "privmsgs_from_userid = " . $userdata['user_id'] . " AND privmsgs_type = " . PRIVMSGS_SENT_MAIL;
					break;

				case 'savebox':
					$delete_sql .= "( ( privmsgs_from_userid = " . $userdata['user_id'] . " 
						AND privmsgs_type = " . PRIVMSGS_SAVED_OUT_MAIL . " ) 
					OR ( privmsgs_to_userid = " . $userdata['user_id'] . " 
						AND privmsgs_type = " . PRIVMSGS_SAVED_IN_MAIL . " ) )";
					break;
			}

			if ( !$db->sql_query($delete_sql, BEGIN_TRANSACTION) )
			{
				message_die(GENERAL_ERROR, 'Could not delete private message info', '', __LINE__, __FILE__, $delete_sql);
			}

			if ( !$db->sql_query($delete_text_sql, END_TRANSACTION) )
			{
				message_die(GENERAL_ERROR, 'Could not delete private message text', '', __LINE__, __FILE__, $delete_text_sql);
			}
		}
		redirect(append_sid("profile.$phpEx?mode=privmsg&sub=$folder", true));
		exit;
	}
}
else if ( $save && $mark_list && $folder != 'savebox' && $folder != 'outbox' )
{
	if ( !$userdata['session_logged_in'] )
	{
		redirect(append_sid("login.$phpEx?redirect=profile.$phpEx&mode=privmsg&sub=inbox", true));
	}

	// session id check
	if ( ($sid == '' || $sid != $userdata['session_id']) && !defined('NO_SID') )
	{
		message_die(GENERAL_ERROR, 'Invalid_session');
	}
	
	if (sizeof($mark_list))
	{
		// See if recipient is at their savebox limit
		$sql = "SELECT COUNT(privmsgs_id) AS savebox_items, MIN(privmsgs_date) AS oldest_post_time 
			FROM " . PRIVMSGS_TABLE . " 
			WHERE ( ( privmsgs_to_userid = " . $userdata['user_id'] . " 
					AND privmsgs_type = " . PRIVMSGS_SAVED_IN_MAIL . " )
				OR ( privmsgs_from_userid = " . $userdata['user_id'] . " 
					AND privmsgs_type = " . PRIVMSGS_SAVED_OUT_MAIL . ") )";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain sent message info for sendee', '', __LINE__, __FILE__, $sql);
		}

		if ( $saved_info = $db->sql_fetchrow($result) )
		{
			if ($board_config['max_savebox_privmsgs'] && $saved_info['savebox_items'] >= $board_config['max_savebox_privmsgs'] )
			{
				$sql = "SELECT privmsgs_id FROM " . PRIVMSGS_TABLE . " 
					WHERE ( ( privmsgs_to_userid = " . $userdata['user_id'] . " 
								AND privmsgs_type = " . PRIVMSGS_SAVED_IN_MAIL . " )
							OR ( privmsgs_from_userid = " . $userdata['user_id'] . " 
								AND privmsgs_type = " . PRIVMSGS_SAVED_OUT_MAIL . ") ) 
						AND privmsgs_date = " . $saved_info['oldest_post_time'];
				if ( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not find oldest privmsgs (save)', '', __LINE__, __FILE__, $sql);
				}
				$old_privmsgs_id = $db->sql_fetchrow($result);
				$old_privmsgs_id = $old_privmsgs_id['privmsgs_id'];
			
				$sql = "DELETE FROM " . PRIVMSGS_TABLE . " 
					WHERE privmsgs_id = $old_privmsgs_id";
				if ( !$db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not delete oldest privmsgs (save)', '', __LINE__, __FILE__, $sql);
				}

				$sql = "DELETE FROM " . PRIVMSGS_TEXT_TABLE . " 
					WHERE privmsgs_text_id = $old_privmsgs_id";
				if ( !$db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not delete oldest privmsgs text (save)', '', __LINE__, __FILE__, $sql);
				}
			}
		}
	
		$saved_sql_id = '';
		for ($i = 0; $i < sizeof($mark_list); $i++)
		{
			$saved_sql_id .= (($saved_sql_id != '') ? ', ' : '') . intval($mark_list[$i]);
		}

		// Process request
		$saved_sql = "UPDATE " . PRIVMSGS_TABLE;

		// Decrement read/new counters if appropriate
		if ($folder == 'inbox' || $folder == 'outbox')
		{
			switch ($folder)
			{
				case 'inbox':
					$sql = "privmsgs_to_userid = " . $userdata['user_id'];
					break;
				case 'outbox':
					$sql = "privmsgs_from_userid = " . $userdata['user_id'];
					break;
			}

			// Get information relevant to new or unread mail
			// so we can adjust users counters appropriately
			$sql = "SELECT privmsgs_to_userid, privmsgs_type 
				FROM " . PRIVMSGS_TABLE . " 
				WHERE privmsgs_id IN ($saved_sql_id) 
					AND $sql  
					AND privmsgs_type IN (" . PRIVMSGS_NEW_MAIL . ", " . PRIVMSGS_UNREAD_MAIL . ")";
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not obtain user id list for outbox messages', '', __LINE__, __FILE__, $sql);
			}

			if ( $row = $db->sql_fetchrow($result))
			{
				$update_users = $update_list = array();
			
				do
				{
					switch ($row['privmsgs_type'])
					{
						case PRIVMSGS_NEW_MAIL:
							$update_users['new'][$row['privmsgs_to_userid']]++;
							break;

						case PRIVMSGS_UNREAD_MAIL:
							$update_users['unread'][$row['privmsgs_to_userid']]++;
							break;
					}
				}
				while ($row = $db->sql_fetchrow($result));

				if (sizeof($update_users))
				{
					while (list($type, $users) = each($update_users))
					{
						while (list($user_id, $dec) = each($users))
						{
							$update_list[$type][$dec][] = $user_id;
						}
					}
					unset($update_users);

					while (list($type, $dec_ary) = each($update_list))
					{
						switch ($type)
						{
							case 'new':
								$type = "user_new_privmsg";
								break;

							case 'unread':
								$type = "user_unread_privmsg";
								break;
						}

						while (list($dec, $user_ary) = each($dec_ary))
						{
							$user_ids = implode(', ', $user_ary);

							$sql = "UPDATE " . USERS_TABLE . " 
								SET $type = $type - $dec 
								WHERE user_id IN ($user_ids)";
							if ( !$db->sql_query($sql) )
							{
								message_die(GENERAL_ERROR, 'Could not update user pm counters', '', __LINE__, __FILE__, $sql);
							}
						}
					}
					unset($update_list);
				}
			}
			$db->sql_freeresult($result);
		}

		switch ($folder)
		{
			case 'inbox':
				$saved_sql .= " SET privmsgs_type = " . PRIVMSGS_SAVED_IN_MAIL . " 
					WHERE privmsgs_to_userid = " . $userdata['user_id'] . " 
						AND ( privmsgs_type = " . PRIVMSGS_READ_MAIL . " 
							OR privmsgs_type = " . PRIVMSGS_NEW_MAIL . " 
							OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . ")";
				break;

			case 'outbox':
				$saved_sql .= " SET privmsgs_type = " . PRIVMSGS_SAVED_OUT_MAIL . " 
					WHERE privmsgs_from_userid = " . $userdata['user_id'] . " 
						AND ( privmsgs_type = " . PRIVMSGS_NEW_MAIL . " 
							OR privmsgs_type = " . PRIVMSGS_UNERAD_MAIL . " ) ";
				break;

			case 'sentbox':
				$saved_sql .= " SET privmsgs_type = " . PRIVMSGS_SAVED_OUT_MAIL . " 
					WHERE privmsgs_from_userid = " . $userdata['user_id'] . " 
						AND privmsgs_type = " . PRIVMSGS_SENT_MAIL;
				break;
		}

		$saved_sql .= " AND privmsgs_id IN ($saved_sql_id)";

		if ( !$db->sql_query($saved_sql) )
		{
			message_die(GENERAL_ERROR, 'Could not save private messages', '', __LINE__, __FILE__, $saved_sql);
		}
	}
	redirect(append_sid("profile.$phpEx?mode=privmsg&sub=savebox", true));
	exit;
}
else if ( $submit || $refresh || $mode != '' )
{
	if ( !$userdata['session_logged_in'] )
	{
		$buddy_id = ( isset($_GET['b']) ) ? '&b=' . intval($_GET['b']) : '';
		redirect(append_sid("login.$phpEx?redirect=profile.$phpEx&mode=privmsg&sub=$folder&privmsg_mode=$mode" . $buddy_id, true));
	}
	
	//
	// Toggles
	//
	if ( !$board_config['allow_html'] )
	{
		$html_on = 0;
	}
	else
	{
		$html_on = ( $submit || $refresh ) ? ( ( !empty($_POST['disable_html']) ) ? 0 : TRUE ) : $userdata['user_allowhtml'];
	}

	if ( !$board_config['allow_bbcode'] )
	{
		$bbcode_on = 0;
	}
	else
	{
		$bbcode_on = ( $submit || $refresh ) ? ( ( !empty($_POST['disable_bbcode']) ) ? 0 : TRUE ) : $userdata['user_allowbbcode'];
	}

	if ( !$board_config['allow_smilies'] )
	{
		$smilies_on = 0;
	}
	else
	{
		$smilies_on = ( $submit || $refresh ) ? ( ( !empty($_POST['disable_smilies']) ) ? 0 : TRUE ) : $userdata['user_allowsmile'];
	}

	$attach_sig = ( $submit || $refresh ) ? ( ( !empty($_POST['attach_sig']) ) ? TRUE : 0 ) : $userdata['user_attachsig'];
	$user_sig = ( $userdata['user_sig'] != '' && $board_config['allow_sig'] ) ? $userdata['user_sig'] : "";
	
	if ( $submit && $mode != 'edit' )
	{
		//
		// Flood control
		//
		$sql = "SELECT MAX(privmsgs_date) AS last_post_time
			FROM " . PRIVMSGS_TABLE . "
			WHERE privmsgs_from_userid = " . $userdata['user_id'];
		if ( $result = $db->sql_query($sql) )
		{
			$db_row = $db->sql_fetchrow($result);

			$last_post_time = $db_row['last_post_time'];
			$current_time = time();

			if ( ( $current_time - $last_post_time ) < $board_config['flood_interval'])
			{
				message_die(GENERAL_MESSAGE, $lang['Flood_Error']);
			}
		}
		//
		// End Flood control
		//
	}

	if ($submit && $mode == 'edit')
	{
		$sql = 'SELECT privmsgs_from_userid
			FROM ' . PRIVMSGS_TABLE . '
			WHERE privmsgs_id = ' . (int) $privmsg_id . '
				AND privmsgs_from_userid = ' . $userdata['user_id'];

		if (!($result = $db->sql_query($sql)))
		{
			message_die(GENERAL_ERROR, "Could not obtain message details", "", __LINE__, __FILE__, $sql);
		}

		if (!($row = $db->sql_fetchrow($result)))
		{
			message_die(GENERAL_MESSAGE, $lang['No_such_post']);
		}
		$db->sql_freeresult($result);

		unset($row);
	}

	if ( $submit )
	{
		// session id check
		if ( ($sid == '' || $sid != $userdata['session_id']) && !defined('NO_SID') )
		{
			message_die(GENERAL_ERROR, 'Invalid_session');
		}

		if ( !empty($_POST['username']) )
		{
//-- mod : Advanced Group Color Management -------------------------------------
//-- delete
//	$to_username = (isset($HTTP_POST_VARS['username']) ) ? trim(htmlspecialchars(stripslashes($HTTP_POST_VARS['username']))) : '';
//-- add
		if (isset($_POST['username']))
		{
			$to_username = phpbb_clean_username($_POST['username']);

			$sql = "SELECT username, user_group_id, user_session_time
				FROM " . USERS_TABLE . "
				WHERE username = '" . str_replace("\'", "''", $to_username) . "'
					AND user_id <> " . ANONYMOUS;
			if ( !($result = $db->sql_query($sql)) )
			{
				$error = TRUE;
				$error_msg = $lang['No_such_user'];
			}

			if ( $row = $db->sql_fetchrow($result) )
			{
				$to_username = $row['username'];
				$to_user_group_id = $row['user_group_id'];
				$to_user_session_time = $row['user_session_time'];
			}
		}
//-- fin mod : Advanced Group Color Management ---------------------------------
			$sql = "SELECT * FROM " . USERS_TABLE . " 
					WHERE username = '" . str_replace("\'", "''", $to_username) . "' 
						AND user_id <> " . ANONYMOUS;
			if ( !$result = $db->sql_query($sql) ) message_die(GENERAL_ERROR, 'Could not access users table', '', __LINE__, __FILE__, $sql);
			if ( !$to_userdata = $db->sql_fetchrow($result) )
			{
				$error = TRUE;
				$error_msg = $lang['No_such_user'];
			}
		}
		else
		{
			$error = TRUE;
			$error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . $lang['No_to_user'];
		}

		if ( !$error )
		{
			// check the ignore status
			$sql = "SELECT * FROM " . BUDDYS_TABLE . " 
					WHERE ( 
							(user_id=" . $userdata['user_id'] . " AND buddy_id=" . $to_userdata['user_id'] . ") OR 
							(buddy_id=" . $userdata['user_id'] . " AND user_id=" . $to_userdata['user_id'] . ") 
						) 
						AND buddy_ignore=1";
			if ( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not access buddy list', '', __LINE__, __FILE__, $sql);
			}
			if ( $urow = $db->sql_fetchrow($result) )
			{
				$error = true;
				$error_msg = ($urow['user_id'] == $userdata['user_id']) ? $lang['Ignore_choosed'] : $lang['profilcp_buddy_ignore'];
			}

			// check social status
			if ( !$error && !is_admin($userdata) && (!$to_userdata['user_allow_pm'] || $to_userdata['user_viewpm'] != YES) )
			{
				if ( ($to_userdata['user_viewpm'] == FRIEND_ONLY) || ($to_userdata['user_viewpm'] == NO) )
				{
					// read the to_user buddys
					$sql = "SELECT * FROM " . BUDDYS_TABLE . " 
							WHERE user_id=" . $to_userdata['user_id'] . " 
								AND buddy_id =" . $userdata['user_id'];
					if ( !$result = $db->sql_query($sql) )
					{
						message_die(GENERAL_ERROR, 'Could not access buddy list', '', __LINE__, __FILE__, $sql);
					}
					if ( !$row = $db->sql_fetchrow($result) || $row['buddy_ignore'] || ( ($to_userdata['user_viewpm'] == NO) && !$row['buddy_visible'] ) )
					{
						$error = true;
						$error_msg = $lang['Do_not_allow_pm'];
					}
				}
				else
				{
					$error = true;
					$error_msg = $lang['Do_not_allow_pm'];
				}
			}
		}

		$privmsg_subject = trim(htmlspecialchars($_POST['subject']));
		if ( empty($privmsg_subject) )
		{
			$error = TRUE;
			$error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . $lang['Empty_subject'];
		}

		if ( !empty($_POST['message']) )
		{
			if ( !$error )
			{
				if ( $bbcode_on )
				{
					$bbcode_uid = make_bbcode_uid();
				}

				$privmsg_message = prepare_message($_POST['message'], $html_on, $bbcode_on, $smilies_on, $bbcode_uid);

			}
		}
		else
		{
			$error = TRUE;
			$error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . $lang['Empty_message'];
		}
	}

	if ( $submit && !$error )
	{
		//
		// Has admin prevented user from sending PM's?
		//
		if ( !$userdata['user_allow_pm'] )
		{
			$message = $lang['Cannot_send_privmsg'];
			message_die(GENERAL_MESSAGE, $message);
		}

		$msg_time = time();

		if ( $mode != 'edit' )
		{
			//
			// See if recipient is at their inbox limit
			//
			$sql = "SELECT COUNT(privmsgs_id) AS inbox_items, MIN(privmsgs_date) AS oldest_post_time 
				FROM " . PRIVMSGS_TABLE . " 
				WHERE ( privmsgs_type = " . PRIVMSGS_NEW_MAIL . " 
						OR privmsgs_type = " . PRIVMSGS_READ_MAIL . "  
						OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " ) 
					AND privmsgs_to_userid = " . $to_userdata['user_id'];
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_MESSAGE, $lang['No_such_user']);
			}

			if ( $inbox_info = $db->sql_fetchrow($result) )
			{
				if ($board_config['max_inbox_privmsgs'] && $inbox_info['inbox_items'] >= $board_config['max_inbox_privmsgs'])
				{
					$sql = "SELECT privmsgs_id FROM " . PRIVMSGS_TABLE . " 
						WHERE ( privmsgs_type = " . PRIVMSGS_NEW_MAIL . " 
								OR privmsgs_type = " . PRIVMSGS_READ_MAIL . " 
								OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . "  ) 
							AND privmsgs_date = " . $inbox_info['oldest_post_time'] . " 
							AND privmsgs_to_userid = " . $to_userdata['user_id'];
					if ( !$result = $db->sql_query($sql) )
					{
						message_die(GENERAL_ERROR, 'Could not find oldest privmsgs (inbox)', '', __LINE__, __FILE__, $sql);
					}
					$old_privmsgs_id = $db->sql_fetchrow($result);
					$old_privmsgs_id = $old_privmsgs_id['privmsgs_id'];
				
					$sql = "DELETE FROM " . PRIVMSGS_TABLE . " 
						WHERE privmsgs_id = $old_privmsgs_id";
					if ( !$db->sql_query($sql) )
					{
						message_die(GENERAL_ERROR, 'Could not delete oldest privmsgs (inbox)'.$sql, '', __LINE__, __FILE__, $sql);
					}

					$sql = "DELETE FROM " . PRIVMSGS_TEXT_TABLE . " 
						WHERE privmsgs_text_id = $old_privmsgs_id";
					if ( !$db->sql_query($sql) )
					{
						message_die(GENERAL_ERROR, 'Could not delete oldest privmsgs text (inbox)', '', __LINE__, __FILE__, $sql);
					}
				}
			}

// Track PMs MOD, By Manipe (Begin)
			$id_for_pm_track = ($privmsg_id) ? $privmsg_id : $id_for_pm_track_post_vars;

			if ($id_for_pm_track)
			{
				$sql = "SELECT privmsgs_track_id
					FROM " . PRIVMSGS_TABLE . "
					WHERE privmsgs_id = " . $id_for_pm_track;
				if ( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not get PM track id', '', __LINE__, __FILE__, $sql);
				}

				$row = $db->sql_fetchrow($result);
				$pm_track_id = $row['privmsgs_track_id'];
			}

			if (!$id_for_pm_track || $pm_track_id == 0)
			{
				$sql = "SELECT MAX(privmsgs_id) AS privmsgs_track_id
					FROM " . PRIVMSGS_TABLE;
				
				if ( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not get PM track id', '', __LINE__, __FILE__, $sql);
				}

				$row = $db->sql_fetchrow($result);
				$pm_track_id = $row['privmsgs_track_id'] + 1;
			}
// Track PMs MOD, By Manipe (End)

			$sql_info = "INSERT INTO " . PRIVMSGS_TABLE . " (privmsgs_type, privmsgs_subject, privmsgs_from_userid, privmsgs_to_userid, privmsgs_date, privmsgs_ip, privmsgs_enable_html, privmsgs_enable_bbcode, privmsgs_enable_smilies, privmsgs_attach_sig, privmsgs_track_id)
				VALUES (" . PRIVMSGS_NEW_MAIL . ", '" . str_replace("\'", "''", $privmsg_subject) . "', " . $userdata['user_id'] . ", " . $to_userdata['user_id'] . ", $msg_time, '$user_ip', $html_on, $bbcode_on, $smilies_on, $attach_sig, $pm_track_id)";
		}
		else
		{
			$sql_info = "UPDATE " . PRIVMSGS_TABLE . "
				SET privmsgs_type = " . PRIVMSGS_NEW_MAIL . ", privmsgs_subject = '" . str_replace("\'", "''", $privmsg_subject) . "', privmsgs_from_userid = " . $userdata['user_id'] . ", privmsgs_to_userid = " . $to_userdata['user_id'] . ", privmsgs_date = $msg_time, privmsgs_ip = '$user_ip', privmsgs_enable_html = $html_on, privmsgs_enable_bbcode = $bbcode_on, privmsgs_enable_smilies = $smilies_on, privmsgs_attach_sig = $attach_sig 
				WHERE privmsgs_id = $privmsg_id";
		}

		if ( !($result = $db->sql_query($sql_info, BEGIN_TRANSACTION)) )
		{
			message_die(GENERAL_ERROR, "Could not insert/update private message sent info.", "", __LINE__, __FILE__, $sql_info);
		}

		if ( $mode != 'edit' )
		{
			$privmsg_sent_id = $db->sql_nextid();

			$sql = "INSERT INTO " . PRIVMSGS_TEXT_TABLE . " (privmsgs_text_id, privmsgs_bbcode_uid, privmsgs_text)
				VALUES ($privmsg_sent_id, '" . $bbcode_uid . "', '" . str_replace("\'", "''", $privmsg_message) . "')";
		}
		else
		{
			$sql = "UPDATE " . PRIVMSGS_TEXT_TABLE . "
				SET privmsgs_text = '" . str_replace("\'", "''", $privmsg_message) . "', privmsgs_bbcode_uid = '$bbcode_uid' 
				WHERE privmsgs_text_id = $privmsg_id";
		}

		if ( !$db->sql_query($sql, END_TRANSACTION) )
		{
			message_die(GENERAL_ERROR, "Could not insert/update private message sent text.", "", __LINE__, __FILE__, $sql);
		}

		$attachment_mod['pm']->insert_attachment_pm($privmsg_id);
		if ( $mode != 'edit' )
		{
			//
			// Add to the users new pm counter
			//
			$sql = "UPDATE " . USERS_TABLE . "
				SET user_new_privmsg = user_new_privmsg + 1, user_last_privmsg = " . time() . "  
				WHERE user_id = " . $to_userdata['user_id']; 
			if ( !$status = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not update private message new/read status for user', '', __LINE__, __FILE__, $sql);
			}

			if ( $to_userdata['user_notify_pm'] && !empty($to_userdata['user_email']) && $to_userdata['user_active'] )
			{
				$emailer = new emailer($board_config['smtp_delivery']);

//-- mod : profilcp --------------------------------------------------------------------------------
				$email_headers = '';
				switch( $board_config['version'] )
				{
					case '.0.4':
						$email_headers = 'From: ' . $board_config['board_email'] . "\nReturn-Path: " . $board_config['board_email'] . "\n";
						break;
					default:
						$emailer->from($board_config['board_email']);
						$emailer->replyto($board_config['board_email']);
						break;
				}
//-- fin mod : profilcp ----------------------------------------------------------------------------

				$emailer->use_template('privmsg_notify', $to_userdata['user_lang']);
				$emailer->email_address($to_userdata['user_email']);
				$emailer->extra_headers($email_headers);
				$emailer->set_subject($lang['Notification_subject']);

				$emailer->assign_vars(array(
					'USERNAME' => stripslashes($to_username),
					'SITENAME' => $board_config['sitename'],
					'EMAIL_SIG' => (!empty($board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']) : '', 

					'U_INBOX' => $server_protocol . $server_name . $server_port . $script_name . '?folder=inbox')
				);

				$emailer->send();
				$emailer->reset();
			}
			$pmer = new cash_user($userdata['user_id'],$userdata);
			$pmer->give_pm_amount();
			while ( false ) {
			}
		}

		$template->assign_vars(array(
			'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid("profile.$phpEx?mode=privmsg&sub=inbox") . '">')
		);

		$msg = $lang['Message_sent'] . '<br /><br />' . sprintf($lang['Click_return_inbox'], '<a href="' . append_sid("profile.$phpEx?mode=privmsg&sub=inbox") . '">', '</a> ') . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>');

		message_die(GENERAL_MESSAGE, $msg);
	}
	else if ( $preview || $refresh || $error )
	{

		//
		// If we're previewing or refreshing then obtain the data
		// passed to the script, process it a little, do some checks
		// where neccessary, etc.
		//
		$to_username = ( isset($_POST['username']) ) ? trim(strip_tags(stripslashes($_POST['username']))) : '';
		$privmsg_subject = ( isset($_POST['subject']) ) ? trim(htmlspecialchars(stripslashes($_POST['subject']))) : '';
		$privmsg_message = ( isset($_POST['message']) ) ? trim($_POST['message']) : '';
		// $privmsg_message = preg_replace('#<textarea>#si', '&lt;textarea&gt;', $privmsg_message);

		if ( !$preview )
		{
			$privmsg_message = stripslashes($privmsg_message);
		}

		//
		// Do mode specific things
		//
		if ( $mode == 'post' )
		{
			$page_title = $lang['Post_new_pm'];

			$user_sig = ( $userdata['user_sig'] != '' && $board_config['allow_sig'] ) ? $userdata['user_sig'] : '';

		}
		else if ( $mode == 'reply' )
		{
			$page_title = $lang['Post_reply_pm'];

			$user_sig = ( $userdata['user_sig'] != '' && $board_config['allow_sig'] ) ? $userdata['user_sig'] : '';

		}
		else if ( $mode == 'edit' )
		{
			$page_title = $lang['Edit_pm'];

			$sql = "SELECT u.user_id, u.user_sig 
				FROM " . PRIVMSGS_TABLE . " pm, " . USERS_TABLE . " u 
				WHERE pm.privmsgs_id = $privmsg_id 
					AND u.user_id = pm.privmsgs_from_userid";
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, "Could not obtain post and post text", "", __LINE__, __FILE__, $sql);
			}

			if ( $postrow = $db->sql_fetchrow($result) )
			{
				if ( $userdata['user_id'] != $postrow['user_id'] )
				{
					message_die(GENERAL_MESSAGE, $lang['Edit_own_posts']);
				}

				$user_sig = ( $postrow['user_sig'] != '' && $board_config['allow_sig'] ) ? $postrow['user_sig'] : '';
			}
		}
	}
	else 
	{
		if ( !$privmsg_id && ( $mode == 'reply' || $mode == 'edit' || $mode == 'quote' ) )
		{
			message_die(GENERAL_ERROR, $lang['No_post_id']);
		}

		if ( !empty($_GET['b']) )
		{
			$user_id = intval($_GET['b']);

			$sql = "SELECT username
				FROM " . USERS_TABLE . "
				WHERE user_id = $user_id
					AND user_id <> " . ANONYMOUS;
			if ( !($result = $db->sql_query($sql)) )
			{
				$error = TRUE;
				$error_msg = $lang['No_such_user'];
			}

			if ( $row = $db->sql_fetchrow($result) )
			{
				$to_username = $row['username'];
			}
		}
		else if ( $mode == 'edit' )
		{
			$sql = "SELECT pm.*, pmt.privmsgs_bbcode_uid, pmt.privmsgs_text, u.username, u.user_id, from_user.user_sig 
				FROM " . PRIVMSGS_TABLE . " pm, " . PRIVMSGS_TEXT_TABLE . " pmt, " . USERS_TABLE . " u, " . USERS_TABLE . " as from_user 
				WHERE pm.privmsgs_id = $privmsg_id 
					AND pmt.privmsgs_text_id = pm.privmsgs_id 
					AND pm.privmsgs_from_userid = " . $userdata['user_id'] . " 
					AND from_user.user_id = " . $userdata['user_id'] . " 
					AND ( pm.privmsgs_type = " . PRIVMSGS_NEW_MAIL . " OR pm.privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " ) 
					AND u.user_id = pm.privmsgs_to_userid"; 

			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not obtain private message for editing', '', __LINE__, __FILE__, $sql);
			}

			if ( !($privmsg = $db->sql_fetchrow($result)) )
			{
				$ret_link = append_sid("profile.$phpEx?mode=privmsg&sub=$folder");
				$message = $lang['Topic_post_not_exist'] . '<br /><br />' . sprintf($lang['Click_return_privmsg'], '<a href="' . $ret_link . '">', "</a>") . '<br /><br />';
				message_die(GENERAL_MESSAGE, $message);
			}

			$privmsg_subject = $privmsg['privmsgs_subject'];
			$privmsg_message = $privmsg['privmsgs_text'];
			$privmsg_bbcode_uid = $privmsg['privmsgs_bbcode_uid'];
			$privmsg_bbcode_enabled = ($privmsg['privmsgs_enable_bbcode'] == 1);

			if ( $privmsg_bbcode_enabled )
			{
				$privmsg_message = preg_replace("/\:(([a-z0-9]:)?)$privmsg_bbcode_uid/si", '', $privmsg_message);
			}

			$privmsg_message = preg_replace ("'.script'si", "script", $privmsg_message);
			$privmsg_message = str_replace('<br />', "\n", $privmsg_message);
			// $privmsg_message = preg_replace('#</textarea>#si', '&lt;/textarea&gt;', $privmsg_message);

			$user_sig = (  $board_config['allow_sig'] ) ? $privmsg['user_sig'] : '';

			$to_username = $privmsg['username'];
			$to_userid = $privmsg['user_id'];
		}
		else if ( $mode == 'reply' || $mode == 'quote' )
		{
			$sql = "SELECT pm.privmsgs_subject, pm.privmsgs_date, pmt.privmsgs_bbcode_uid, pmt.privmsgs_text, u.username, u.user_id
				FROM " . PRIVMSGS_TABLE . " pm, " . PRIVMSGS_TEXT_TABLE . " pmt, " . USERS_TABLE . " u
				WHERE pm.privmsgs_id = $privmsg_id
					AND pmt.privmsgs_text_id = pm.privmsgs_id
					AND pm.privmsgs_to_userid = " . $userdata['user_id'] . "
					AND u.user_id = pm.privmsgs_from_userid";
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not obtain private message for editing', '', __LINE__, __FILE__, $sql);
			}

			if ( !($privmsg = $db->sql_fetchrow($result)) )
			{
				$ret_link = append_sid("profile.$phpEx?mode=privmsg&sub=$folder");
				$message = $lang['Topic_post_not_exist'] . '<br /><br />' . sprintf($lang['Click_return_privmsg'], '<a href="' . $ret_link . '">', "</a>") . '<br /><br />';
				message_die(GENERAL_MESSAGE, $message);
			}

			$orig_word = $replacement_word = array();
			obtain_word_list($orig_word, $replace_word);

			$privmsg_subject = ( ( !preg_match('/^Re:/', $privmsg['privmsgs_subject']) ) ? 'Re: ' : '' ) . $privmsg['privmsgs_subject'];
			$privmsg_subject = preg_replace($orig_word, $replacement_word, $privmsg_subject);

			$to_username = $privmsg['username'];
			$to_userid = $privmsg['user_id'];

			if ( $mode == 'quote' )
			{
				$privmsg_message = $privmsg['privmsgs_text'];
				$privmsg_bbcode_uid = $privmsg['privmsgs_bbcode_uid'];

				$privmsg_message = preg_replace ("'.script'si", "script", $privmsg_message);
				$privmsg_message = preg_replace("/\:(([a-z0-9]:)?)$privmsg_bbcode_uid/si", '', $privmsg_message);
				$privmsg_message = str_replace('<br />', "\n", $privmsg_message);
				// $privmsg_message = preg_replace('#</textarea>#si', '&lt;/textarea&gt;', $privmsg_message);
				$privmsg_message = preg_replace($orig_word, $replacement_word, $privmsg_message);

				$msg_date =  create_date($board_config['default_dateformat'], $privmsg['privmsgs_date'], $board_config['board_timezone']); 

				$privmsg_message = '[quote="' . $to_username . '"]' . $privmsg_message . '[/quote]';

				$mode = 'reply';
			}
		}
		else
		{
			$privmsg_subject = $privmsg_message = $to_username = '';
		}
	}

// View PM while replying MOD, By Manipe
	$id_for_pm_track = ($privmsg_id) ? $privmsg_id : $id_for_pm_track_post_vars;

	if ( $id_for_pm_track && ( $mode == 'reply' || $mode == 'edit' || $mode == 'post' ) )
	{
		$pm_track_id = pm_track_all_history($id_for_pm_track);
	}
// View PM while replying MOD, By Manipe

	//
	// Has admin prevented user from sending PM's?
	//
	if ( !$userdata['user_allow_pm'] && $mode != 'edit' )
	{
		$message = $lang['Cannot_send_privmsg'];
		message_die(GENERAL_MESSAGE, $message);
	}

	//
	// Start output, first preview, then errors then post form
	//
	$page_title = $lang['Send_private_message'];

	if ( $preview && !$error )
	{
		$orig_word = array();
		$replacement_word = array();
		obtain_word_list($orig_word, $replacement_word);

		if ( $bbcode_on )
		{
			$bbcode_uid = make_bbcode_uid();
		}

		$preview_message = stripslashes(prepare_message($privmsg_message, $html_on, $bbcode_on, $smilies_on, $bbcode_uid));
		$privmsg_message = stripslashes(preg_replace($html_entities_match, $html_entities_replace, $privmsg_message));

		//
		// Finalise processing as per viewtopic
		//
		if ( !$html_on )
		{
			if ( $user_sig != '' || !$userdata['user_allowhtml'] )
			{
				$user_sig = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $user_sig);
			}
		}

		if ( $attach_sig && $user_sig != '' && $userdata['user_sig_bbcode_uid'] )
		{
			$user_sig = bbencode_second_pass($user_sig, $userdata['user_sig_bbcode_uid']);
		}

		if ( $bbcode_on )
		{
			$preview_message = bbencode_second_pass($preview_message, $bbcode_uid);
		}

		if ( $attach_sig && $user_sig != '' )
		{
			$preview_message = $preview_message . '<br /><br />_________________<br />' . $user_sig;
		}
		
		if ( count($orig_word) )
		{
			$preview_subject = preg_replace($orig_word, $replacement_word, $privmsg_subject);
			$preview_message = preg_replace($orig_word, $replacement_word, $preview_message);
		}
		else
		{
			$preview_subject = $privmsg_subject;
		}

		if ( $smilies_on )
		{
			$preview_message = smilies_pass($preview_message);
		}

		$preview_message = make_clickable($preview_message);
		$preview_message = str_replace("\n", '<br />', $preview_message);

		$s_hidden_fields = '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" /><input type="hidden" name="folder" value="' . $folder . '" />';
		$s_hidden_fields .= '<input type="hidden" name="mode" value="privmsg" />';
		$s_hidden_fields .= '<input type="hidden" name="privmsg_mode" value="' . $mode . '" />';
		$s_hidden_fields .= '<input type="hidden" name="sub" value="' . $folder . '" />';

		if ( isset($privmsg_id) )
		{
			$s_hidden_fields .= '<input type="hidden" name="' . POST_POST_URL . '" value="' . $privmsg_id . '" />';
		}

		$template->set_filenames(array(
			"preview" => 'privmsgs_preview.tpl')
		);
		$attachment_mod['pm']->preview_attachments();

		$template->assign_vars(array(
			'TOPIC_TITLE' => $preview_subject,
			'POST_SUBJECT' => $preview_subject,
//-- mod : Advanced Group Color Management -------------------------------------
//-- delete
//	'MESSAGE_TO' => $to_username,
//	'MESSAGE_FROM' => $userdata['username'],
//-- add
			'MESSAGE_TO' => $agcm_color->get_user_color($to_user_group_id, $to_user_session_time, $to_username),
			'MESSAGE_FROM' => $agcm_color->get_user_color($userdata['user_group_id'], $userdata['user_session_time'], $userdata['username']),
//-- fin mod : Advanced Group Color Management ---------------------------------
			'POST_DATE' => create_date($board_config['default_dateformat'], time(), $board_config['board_timezone']),
			'MESSAGE' => $preview_message,

			'S_HIDDEN_FIELDS' => $s_hidden_fields,

			'L_SUBJECT' => $lang['Subject'],
			'L_DATE' => $lang['Date'],
			'L_FROM' => $lang['From'],
			'L_TO' => $lang['To'],
			'L_PREVIEW' => $lang['Preview'],
			'L_POSTED' => $lang['Posted'])
		);

		$template->assign_var_from_handle('POST_PREVIEW_BOX', 'preview');
	}

	//
	// Start error handling
	//
	if ($error)
	{
		$privmsg_message = htmlspecialchars($privmsg_message);
		message_die(GENERAL_MESSAGE, $error_msg);
	}

	//
	// Load templates
	//
	$template->set_filenames(array(
		'body' => 'posting_body.tpl')
	);

	//
	// Enable extensions in posting_body
	//
	$template->assign_block_vars('switch_privmsg', array());

	//
	// HTML toggle selection
	//
	if ( $board_config['allow_html'] )
	{
		$html_status = $lang['HTML_is_ON'];
		$template->assign_block_vars('switch_html_checkbox', array());
	}
	else
	{
		$html_status = $lang['HTML_is_OFF'];
	}

	//
	// BBCode toggle selection
	//
	if ( $board_config['allow_bbcode'] )
	{
		$bbcode_status = $lang['BBCode_is_ON'];
		$template->assign_block_vars('switch_bbcode_checkbox', array());
	}
	else
	{
		$bbcode_status = $lang['BBCode_is_OFF'];
	}

	//
	// Smilies toggle selection
	//
	//Begin Lo-Fi Mod
	if ( $board_config['allow_smilies'] && !$lofi)
	//End Lo-Fi Mod
	{
		$smilies_status = $lang['Smilies_are_ON'];
		$template->assign_block_vars('switch_smilies_checkbox', array());
	}
	else
	{
		$smilies_status = $lang['Smilies_are_OFF'];
	}

	//
	// Signature toggle selection - only show if
	// the user has a signature
	//
	if ( $user_sig != '' )
	{
		$template->assign_block_vars('switch_signature_checkbox', array());
	}

	if ( $mode == 'post' )
	{
		$post_a = $lang['Send_a_new_message'];
	}
	else if ( $mode == 'reply' )
	{
		$post_a = $lang['Send_a_reply'];
		$mode = 'post';
	}
	else if ( $mode == 'edit' )
	{
		$post_a = $lang['Edit_message'];
	}

	$s_hidden_fields = '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" /><input type="hidden" name="folder" value="' . $folder . '" />';
	$s_hidden_fields .= '<input type="hidden" name="mode" value="privmsg" />';
	$s_hidden_fields .= '<input type="hidden" name="privmsg_mode" value="' . $mode . '" />';
	$s_hidden_fields .= '<input type="hidden" name="sub" value="' . $folder . '" />';
	$s_hidden_fields .= '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';

	if ( $mode == 'edit' )
	{
		$s_hidden_fields .= '<input type="hidden" name="' . POST_POST_URL . '" value="' . $privmsg_id . '" />';
	}
// View PM while replying MOD, By Manipe
	$id_for_pm_track = ($privmsg_id) ? $privmsg_id : $id_for_pm_track_post_vars;

	if ( $id_for_pm_track )
	{
		$s_hidden_fields .= '<input type="hidden" name="id_for_pm_track" value="' . $id_for_pm_track . '" />';
	}
// View PM while replying MOD, By Manipe


// V: this if below is from masterdavid's "View PMs while replying".
//    it is disabled because we use the more advanced "Track PMs" mod.
/*
if(isset($_GET['p']))
{
	$post_to_review = intval($_GET['p']);
	
	$sq1 = "SELECT privmsgs_text , privmsgs_bbcode_uid
		   FROM  " . PRIVMSGS_TEXT_TABLE . "
		   WHERE privmsgs_text_id   = '$post_to_review'";
	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, "Could not query private messages table", $lang['Error'], __LINE__, __FILE__, $sql);
	}
	$row1 = $db->sql_fetchrow($result);
	$pm_review_message = $row1['privmsgs_text'];
	$pm_review_message_bbcode = $row1['privmsgs_bbcode_uid'];

	$pm_review_message = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $pm_review_message);
	if ( $pm_review_message_bbcode != '' )
	{
		$pm_review_message = bbencode_second_pass($pm_review_message, $pm_review_message_bbcode);
	}
	$pm_review_message = make_clickable($pm_review_message);
	$pm_review_message = smilies_pass($pm_review_message);
	$pm_review_message = str_replace("\n", "\n<br />\n", $pm_review_message);
	$pm_review_message = '<span class="postbody">' . $pm_review_message . '</span>';

	$template->assign_block_vars('pm_review', array(
		'L_MESSAGE_PREVIEW' => $lang['Message_preview'],
		'PM_REVIEW_MESSAGE' => $pm_review_message
		)
	);
}
*/

	//
	// Send smilies to template
	//
	generate_smilies('inline', PAGE_PRIVMSGS);

	$template->assign_vars(array(
		// erase index sentence
		'L_INDEX' => '',
		// erase time zone info
		'S_TIMEZONE' => '',
		'L_USERNAME' => $lang['Username'],

		'SUBJECT' => preg_replace($html_entities_match, $html_entities_replace, $privmsg_subject), 
		'USERNAME' => preg_replace($html_entities_match, $html_entities_replace, $to_username),
		'MESSAGE' => $privmsg_message,
		'HTML_STATUS' => $html_status, 
		'SMILIES_STATUS' => $smilies_status, 
		'BBCODE_STATUS' => sprintf($bbcode_status, '<a href="' . append_sid("faq.$phpEx?mode=bbcode") . '" target="_phpbbcode">', '</a>'), 
		'FORUM_NAME' => $lang['Private_Message'],
		
		'BOX_NAME' => $l_box_name, 

		'L_SUBJECT' => $lang['Subject'],
		'L_MESSAGE_BODY' => $lang['Message_body'],
		'L_OPTIONS' => $lang['Options'],
		'L_SPELLCHECK' => $lang['Spellcheck'],
		'L_PREVIEW' => $lang['Preview'],
		'L_SUBMIT' => $lang['Submit'],
		'L_CANCEL' => $lang['Cancel'],
		'L_POST_A' => $post_a,
		'L_FIND_USERNAME' => $lang['Find_username'],
		'L_FIND' => $lang['Find'],
		'L_DISABLE_HTML' => $lang['Disable_HTML_pm'], 
		'L_DISABLE_BBCODE' => $lang['Disable_BBCode_pm'], 
		'L_DISABLE_SMILIES' => $lang['Disable_Smilies_pm'], 
		'L_ATTACH_SIGNATURE' => $lang['Attach_signature'], 

		'L_BBCODE_B_HELP' => $lang['bbcode_b_help'], 
		'L_BBCODE_I_HELP' => $lang['bbcode_i_help'], 
		'L_BBCODE_U_HELP' => $lang['bbcode_u_help'], 
		'L_BBCODE_Q_HELP' => $lang['bbcode_q_help'], 
		'L_BBCODE_C_HELP' => $lang['bbcode_c_help'], 
		'L_BBCODE_L_HELP' => $lang['bbcode_l_help'], 
		'L_BBCODE_O_HELP' => $lang['bbcode_o_help'], 
		'L_BBCODE_P_HELP' => $lang['bbcode_p_help'], 
		'L_BBCODE_W_HELP' => $lang['bbcode_w_help'], 
		'L_BBCODE_A_HELP' => $lang['bbcode_a_help'], 
		'L_BBCODE_S_HELP' => $lang['bbcode_s_help'], 
		'L_BBCODE_F_HELP' => $lang['bbcode_f_help'], 
		'L_EMPTY_MESSAGE' => $lang['Empty_message'],

		'L_FONT_COLOR' => $lang['Font_color'], 
		'L_COLOR_DEFAULT' => $lang['color_default'], 
		'L_COLOR_DARK_RED' => $lang['color_dark_red'], 
		'L_COLOR_RED' => $lang['color_red'], 
		'L_COLOR_ORANGE' => $lang['color_orange'], 
		'L_COLOR_BROWN' => $lang['color_brown'], 
		'L_COLOR_YELLOW' => $lang['color_yellow'], 
		'L_COLOR_GREEN' => $lang['color_green'], 
		'L_COLOR_OLIVE' => $lang['color_olive'], 
		'L_COLOR_CYAN' => $lang['color_cyan'], 
		'L_COLOR_BLUE' => $lang['color_blue'], 
		'L_COLOR_DARK_BLUE' => $lang['color_dark_blue'], 
		'L_COLOR_INDIGO' => $lang['color_indigo'], 
		'L_COLOR_VIOLET' => $lang['color_violet'], 
		'L_COLOR_WHITE' => $lang['color_white'], 
		'L_COLOR_BLACK' => $lang['color_black'], 

		'L_FONT_SIZE' => $lang['Font_size'], 
		'L_FONT_TINY' => $lang['font_tiny'], 
		'L_FONT_SMALL' => $lang['font_small'], 
		'L_FONT_NORMAL' => $lang['font_normal'], 
		'L_FONT_LARGE' => $lang['font_large'], 
		'L_FONT_HUGE' => $lang['font_huge'], 

		'L_BBCODE_CLOSE_TAGS' => $lang['Close_Tags'], 
		'L_STYLES_TIP' => $lang['Styles_tip'], 

		'S_HTML_CHECKED' => ( !$html_on ) ? ' checked="checked"' : '', 
		'S_BBCODE_CHECKED' => ( !$bbcode_on ) ? ' checked="checked"' : '', 
		'S_SMILIES_CHECKED' => ( !$smilies_on ) ? ' checked="checked"' : '', 
		'S_SIGNATURE_CHECKED' => ( $attach_sig ) ? ' checked="checked"' : '',
		'S_HIDDEN_FORM_FIELDS' => $s_hidden_fields,

		'S_POST_ACTION' => append_sid("profile.$phpEx?mode=privmsg"),

		'U_SEARCH_USER' => append_sid("search.$phpEx?mode=searchuser"),
		'U_VIEW_FORUM' => append_sid("profile.$phpEx?mode=privmsg"))
	);

	$template->pparse('body');

}
else
{
	//
	// Default page
	//
	if ( !$userdata['session_logged_in'] )
	{
		redirect(append_sid("login.$phpEx?redirect=profile.$phpEx&mode=privmsg", true));
	}

	//
	// Update unread status 
	// ... but only if we have new privmsgs.
	//
	if ($userdata['user_new_privmsg'] != 0)
	{
		$sql = "UPDATE " . USERS_TABLE . "
			SET user_unread_privmsg = user_unread_privmsg + user_new_privmsg, user_new_privmsg = 0, user_last_privmsg = " . $userdata['session_start'] . " 
			WHERE user_id = " . $userdata['user_id'];
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not update private message new/read status for user', '', __LINE__, __FILE__, $sql);
		}

		$sql = "UPDATE " . PRIVMSGS_TABLE . "
			SET privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " 
			WHERE privmsgs_type = " . PRIVMSGS_NEW_MAIL . " 
				AND privmsgs_to_userid = " . $userdata['user_id'];
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not update private message new/read status (2) for user', '', __LINE__, __FILE__, $sql);
		}
	}

	//
	// Reset PM counters
	//
	$userdata['user_new_privmsg'] = 0;
	$userdata['user_unread_privmsg'] = ( $userdata['user_new_privmsg'] + $userdata['user_unread_privmsg'] );

	//
	// Generate page
	//
	$page_title = $lang['Private_Messaging'];

	//
	// Load templates
	//
	$template->set_filenames(array(
		'body' => 'profilcp/privmsgs_body.tpl')
	);

	$orig_word = array();
	$replacement_word = array();
	obtain_word_list($orig_word, $replacement_word);

	//
	// New message
	//
	$post_new_mesg_url = '<a class="button_new" href="' . append_sid("profile.$phpEx?mode=privmsg&privmsg_mode=post") . '"><span>' . $lang['Post_new_pm'] . '</span></a>';

	//
	// General SQL to obtain messages
	//
	$sql_tot = "SELECT COUNT(privmsgs_id) AS total 
		FROM " . PRIVMSGS_TABLE . " ";
	$sql = "SELECT pm.privmsgs_type, pm.privmsgs_id, pm.privmsgs_date, pm.privmsgs_subject, u.* 
		FROM " . PRIVMSGS_TABLE . " pm, " . USERS_TABLE . " u ";

	switch( $folder )
	{
		case 'inbox':
			$sql_tot .= "WHERE privmsgs_to_userid = " . $view_userdata['user_id'] . "
				AND ( privmsgs_type =  " . PRIVMSGS_NEW_MAIL . "
					OR privmsgs_type = " . PRIVMSGS_READ_MAIL . " 
					OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " )";

			$sql .= "WHERE pm.privmsgs_to_userid = " . $view_userdata['user_id'] . "
				AND u.user_id = pm.privmsgs_from_userid
				AND ( pm.privmsgs_type =  " . PRIVMSGS_NEW_MAIL . "
					OR pm.privmsgs_type = " . PRIVMSGS_READ_MAIL . " 
					OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " )";
			break;

		case 'outbox':
			$sql_tot .= "WHERE privmsgs_from_userid = " . $view_userdata['user_id'] . "
				AND ( privmsgs_type =  " . PRIVMSGS_NEW_MAIL . "
					OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " )";

			$sql .= "WHERE pm.privmsgs_from_userid = " . $view_userdata['user_id'] . "
				AND u.user_id = pm.privmsgs_to_userid
				AND ( pm.privmsgs_type =  " . PRIVMSGS_NEW_MAIL . "
					OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " )";
			break;

		case 'sentbox':
			$sql_tot .= "WHERE privmsgs_from_userid = " . $view_userdata['user_id'] . "
				AND privmsgs_type =  " . PRIVMSGS_SENT_MAIL;

			$sql .= "WHERE pm.privmsgs_from_userid = " . $view_userdata['user_id'] . "
				AND u.user_id = pm.privmsgs_to_userid
				AND pm.privmsgs_type =  " . PRIVMSGS_SENT_MAIL;
			break;

		case 'savebox':
			$sql_tot .= "WHERE ( ( privmsgs_to_userid = " . $view_userdata['user_id'] . " 
					AND privmsgs_type = " . PRIVMSGS_SAVED_IN_MAIL . " )
				OR ( privmsgs_from_userid = " . $view_userdata['user_id'] . " 
					AND privmsgs_type = " . PRIVMSGS_SAVED_OUT_MAIL . ") )";

			$sql .= "WHERE u.user_id = pm.privmsgs_from_userid 
				AND ( ( pm.privmsgs_to_userid = " . $view_userdata['user_id'] . " 
					AND pm.privmsgs_type = " . PRIVMSGS_SAVED_IN_MAIL . " ) 
				OR ( pm.privmsgs_from_userid = " . $view_userdata['user_id'] . " 
					AND pm.privmsgs_type = " . PRIVMSGS_SAVED_OUT_MAIL . " ) )";
			break;

		default:
			message_die(GENERAL_MESSAGE, $lang['No_such_folder']);
			break;
	}

	//
	// Show messages over previous x days/months
	//
	if ( $submit_msgdays && ( !empty($_POST['msgdays']) || !empty($_GET['msgdays']) ) )
	{
		$msg_days = ( !empty($_POST['msgdays']) ) ? intval($_POST['msgdays']) : intval($_GET['msgdays']);
		$min_msg_time = time() - ($msg_days * 86400);

		$limit_msg_time_total = " AND privmsgs_date > $min_msg_time";
		$limit_msg_time = " AND pm.privmsgs_date > $min_msg_time ";

		if ( !empty($_POST['msgdays']) )
		{
			$start = 0;
		}
	}
	else
	{
		$limit_msg_time = '';
		$post_days = 0;
	}

	$sql .= $limit_msg_time . " ORDER BY pm.privmsgs_date DESC LIMIT $start, " . $board_config['topics_per_page'];
	$sql_all_tot = $sql_tot;
	$sql_tot .= $limit_msg_time_total;

	//
	// Get messages
	//
	if ( !($result = $db->sql_query($sql_tot)) )
	{
		message_die(GENERAL_ERROR, 'Could not query private message information', '', __LINE__, __FILE__, $sql_tot);
	}

	$pm_total = ( $row = $db->sql_fetchrow($result) ) ? $row['total'] : 0;

	if ($limit_msg_time_total != '')
	{
		if ( !($result = $db->sql_query($sql_all_tot)) )
		{
			message_die(GENERAL_ERROR, 'Could not query private message information', '', __LINE__, __FILE__, $sql_tot);
		}

		$pm_all_total = ( $row = $db->sql_fetchrow($result) ) ? $row['total'] : 0;
	}
	else
	{
		$pm_all_total = $pm_total;
	}

	//
	// Build select box
	//
	$previous_days = array(0, 1, 7, 14, 30, 90, 180, 364);
	$previous_days_text = array($lang['All_Posts'], $lang['1_Day'], $lang['7_Days'], $lang['2_Weeks'], $lang['1_Month'], $lang['3_Months'], $lang['6_Months'], $lang['1_Year']);

	$select_msg_days = '';
	for($i = 0; $i < count($previous_days); $i++)
	{
		$selected = ( $msg_days == $previous_days[$i] ) ? ' selected="selected"' : '';
		$select_msg_days .= '<option value="' . $previous_days[$i] . '"' . $selected . '>' . $previous_days_text[$i] . '</option>';
	}

	//
	// Define correct icons
	//
	switch ( $folder )
	{
		case 'inbox':
			$l_box_name = $lang['Inbox'];
			break;
		case 'outbox':
			$l_box_name = $lang['Outbox'];
			break;
		case 'savebox':
			$l_box_name = $lang['Savebox'];
			break;
		case 'sentbox':
			$l_box_name = $lang['Sentbox'];
			break;
	}
	$post_pm = append_sid("profile.$phpEx?mode=privmsg&privmsg_mode=post");
	$post_pm_img = '<a class="button_new" href="' . $post_pm . '"><span>' . $lang['Post_new_pm'] . '</span></a>';
	$post_pm = '<a href="' . $post_pm . '">' . $lang['Post_new_pm'] . '</a>';

	//
	// Output data for inbox status
	//
	if ( $folder != 'outbox' )
	{
		$inbox_limit_pct = ( $board_config['max_' . $folder . '_privmsgs'] > 0 ) ? round(( $pm_all_total / $board_config['max_' . $folder . '_privmsgs'] ) * 100) : 100;
		$inbox_limit_img_length = ( $board_config['max_' . $folder . '_privmsgs'] > 0 ) ? round(( $pm_all_total / $board_config['max_' . $folder . '_privmsgs'] ) * $board_config['privmsg_graphic_length']) : $board_config['privmsg_graphic_length'];
		$inbox_limit_remain = ( $board_config['max_' . $folder . '_privmsgs'] > 0 ) ? $board_config['max_' . $folder . '_privmsgs'] - $pm_all_total : 0;

		$template->assign_block_vars('switch_box_size_notice', array());

		switch( $folder )
		{
			case 'inbox':
				$l_box_size_status = sprintf($lang['Inbox_size'], $inbox_limit_pct);
				break;
			case 'sentbox':
				$l_box_size_status = sprintf($lang['Sentbox_size'], $inbox_limit_pct);
				break;
			case 'savebox':
				$l_box_size_status = sprintf($lang['Savebox_size'], $inbox_limit_pct);
				break;
			default:
				$l_box_size_status = '';
				break;
		}
	}
	else
	{
		$inbox_limit_img_length = $inbox_limit_pct = $l_box_size_status = '';
	}


	//
	// Dump vars to template
	//
	$template->assign_vars(array(
		'L_GO' => $lang['Go'],

		'BOX_NAME' => $l_box_name, 
		'POST_PM_IMG' => $post_pm_img, 
		'POST_PM' => $post_pm, 

		'INBOX_LIMIT_IMG_WIDTH' => $inbox_limit_img_length, 
		'INBOX_LIMIT_PERCENT' => $inbox_limit_pct, 

		'BOX_SIZE_STATUS' => $l_box_size_status, 

		'L_INBOX' => $lang['Inbox'],
		'L_OUTBOX' => $lang['Outbox'],
		'L_SENTBOX' => $lang['Sent'],
		'L_SAVEBOX' => $lang['Saved'],
		'L_MARK' => $lang['Mark'],
		'L_FLAG' => $lang['Flag'],
		'L_SUBJECT' => $lang['Subject'],
		'L_DATE' => $lang['Date'],
		'L_DISPLAY_MESSAGES' => $lang['Display_messages'],
		'L_FROM_OR_TO' => ( $folder == 'inbox' || $folder == 'savebox' ) ? $lang['From'] : $lang['To'], 
		'L_MARK_ALL' => $lang['Mark_all'], 
		'L_UNMARK_ALL' => $lang['Unmark_all'], 
		'L_DELETE_MARKED' => $lang['Delete_marked'], 
		'L_DELETE_ALL' => $lang['Delete_all'], 
		'L_SAVE_MARKED' => $lang['Save_marked'], 

		'S_PRIVMSGS_ACTION' => append_sid("profile.$phpEx?mode=privmsg&sub=$folder"),
		'S_HIDDEN_FIELDS' => '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />',
		'S_POST_NEW_MSG' => $post_new_mesg_url,
		'S_SELECT_MSG_DAYS' => $select_msg_days,

		'U_POST_NEW_TOPIC' => $post_new_topic_url)
	);

	if (!in_array($folder, array('savebox', 'outbox')))
	{
		$template->assign_block_vars('switch_save', array());
	}

	//
	// Okay, let's build the correct folder
	//
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not query private messages', '', __LINE__, __FILE__, $sql);
	}
	$rows = $db->sql_fetchrowset($result);
	$attachment_ids = array();
	foreach ($rows as $row)
		$attachment_ids[] = $row['privmsgs_id'];
	$attachment_images = privmsgs_attachment_image_many($attachment_ids);

	foreach ($rows as $row)
	{
		$privmsg_id = $row['privmsgs_id'];

		$flag = $row['privmsgs_type'];

		$icon_flag = ( $flag == PRIVMSGS_NEW_MAIL || $flag == PRIVMSGS_UNREAD_MAIL ) ? $images['pm_unreadmsg'] : $images['pm_readmsg'];
		$icon_flag_alt = ( $flag == PRIVMSGS_NEW_MAIL || $flag == PRIVMSGS_UNREAD_MAIL ) ? $lang['Unread_message'] : $lang['Read_message'];

		$msg_userid = $row['user_id'];
		$msg_username = $row['username'];

		$u_from_user_profile = append_sid("profile.$phpEx?mode=viewprofile&" . POST_USERS_URL . "=$msg_userid");

		$msg_subject = $row['privmsgs_subject'];

		if ( count($orig_word) )
		{
			$msg_subject = preg_replace($orig_word, $replacement_word, $msg_subject);
		}

		$u_subject = append_sid("profile.$phpEx?mode=privmsg&sub=$folder&privmsg_mode=read&" . POST_POST_URL . "=$privmsg_id");

		$msg_date = create_date($board_config['default_dateformat'], $row['privmsgs_date'], $board_config['board_timezone']);

		if ( $flag == PRIVMSGS_NEW_MAIL && $folder == 'inbox' )
		{
			$msg_subject = '<b>' . $msg_subject . '</b>';
			$msg_date = '<b>' . $msg_date . '</b>';
			$msg_username = '<b>' . $msg_username . '</b>';
		}

		$row_class = ( !($i % 2) ) ? 'row1' : 'row2';

		$template->assign_block_vars('listrow', array(
			'CLASS_NAME' => get_user_level_class($row['user_level'], 'name', $row),
			'ROW_CLASS' => $row_class,
			'FROM' => $msg_username,
			'SUBJECT' => $msg_subject,
			'DATE' => $msg_date,
			'PRIVMSG_ATTACHMENTS_IMG' => isset($attachment_images[$privmsg_id]) ? $attachment_images[$privmsg_id] : '',
			'PRIVMSG_FOLDER_IMG' => $icon_flag,

			'L_PRIVMSG_FOLDER_ALT' => $icon_flag_alt, 

			'S_MARK_ID' => $privmsg_id, 

			'U_READ' => $u_subject,
			'U_FROM_USER_PROFILE' => $u_from_user_profile,
//-- mod : Advanced Group Color Management -------------------------------------
//-- add
				'S_FROM' => $agcm_color->get_user_color($row['user_group_id'], $row['user_session_time']),
//-- fin mod : Advanced Group Color Management ---------------------------------
		));
	}

	if ($rows)
	{
		$template->assign_vars(array(
			'PAGINATION' => generate_pagination("profile.$phpEx?mode=privmsg&sub=$folder", $pm_total, $board_config['topics_per_page'], $start),
			'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $board_config['topics_per_page'] ) + 1 ), ceil( $pm_total / $board_config['topics_per_page'] )), 

			'L_GOTO_PAGE' => $lang['Goto_page'])
		);
	}
	else
	{
		$template->assign_vars(array(
			'L_NO_MESSAGES' => $lang['No_messages_folder'])
		);

		$template->assign_block_vars("switch_no_messages", array() );
	}

	$template->pparse('body');
}

//------------------------------------------------------------------------------
//
// Here ends the copy of privmsg.php
//
//------------------------------------------------------------------------------

$privmsg_mode = $mode;
$mode = 'privmsg';
