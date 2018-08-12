<?php
/***************************************************************************
*                             admin_forum_rules.php
*                              -------------------
*     begin                : Mon Jul 31, 2001
*     copyright            : (C) 2003 Sko22
*     email                : sko22@quellicheilpc.com
*
*
****************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

define('IN_PHPBB', true);
define('CT_SECLEVEL', 'MEDIUM');
$ct_ignorepvar = array('rules_data');

if ( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['Forums']['Rules'] = $filename;

	return;
}

//
// Load default header
//
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
require($phpbb_root_path . 'includes/functions_admin.'.$phpEx);
include($phpbb_root_path . 'includes/functions_post.'.$phpEx);
include($phpbb_root_path . 'includes/bbcode.'.$phpEx);
include($phpbb_root_path . 'includes/emailer.'.$phpEx);
include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_rule.' . $phpEx); 

if ( !isset( $_GET['mode'] ) || $_GET['mode'] =="" ) $_GET['mode'] = "modify";

switch ($_GET['mode']) {
   

	case "save":

	$date = time();

			//
			// Save data rules.
			//
			$sql = "UPDATE " . RULES_TABLE . " SET rules='$_POST[rules_data]', date=$date";

			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not update rules table', '', __LINE__, __FILE__, $sql);
			}
	
		//
		// Assign the template for data rules.
		//
		$template->assign_vars(array(
			'RULES_DATE' => create_date($lang['DATE_FORMAT'], $date, $board_config['board_timezone']),
			'RULES_DATA' => stripslashes( $_POST['rules_data'] ),
			
			'L_NOTVIEW_RULES' => $lang['NotView_Rules'],
			'L_DO' => $lang['Modify'],
			'L_FORUM_RULES' => $lang['Forum_Rules'],
			'L_FORUM_RULES_EXPLAIN' => $lang['Forum_Rules_explain'],

			'U_NOTVIEW_RULES' => append_sid("admin_forum_rules.$phpEx") . "&mode=notview&trd=" . $date . "",

			'S_FORUMRULES_ACTION' => append_sid("admin_forum_rules.$phpEx") . "&mode=modify"
			)
		);

		$page = 'admin/forum_rules_body.tpl';

		break;

	
	case "modify":

	//
	// Get message of the rules from database.
	//
	$sql = "SELECT rules, date FROM " . RULES_TABLE ;

	if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain the rules', '', __LINE__, __FILE__, $sql);
	}

	$rules = $db->sql_fetchrow($result) ;
	$rules_date = create_date($lang['DATE_FORMAT'], $rules['date'], $board_config['board_timezone']);

		//
		// Assign the template data rules.
		//
		$template->assign_vars(array(
			'RULES_DATE' => $rules_date,

			'L_NOTVIEW_RULES' => $lang['NotView_Rules'],
			'L_DO' => $lang['Save'],
			'L_FORUM_RULES' => $lang['Forum_Rules'],
			'L_FORUM_RULES_EXPLAIN' => $lang['Forum_Rules_explain'],

			'U_NOTVIEW_RULES' => append_sid("admin_forum_rules.$phpEx") . "&mode=notview&trd=" . $rules['date'] . "",

			'S_RULES_DATA' => '<textarea name="rules_data" rows="30" cols="90">' . $rules["rules"] . '</textarea>',
			'S_FORUMRULES_ACTION' => append_sid("admin_forum_rules.$phpEx") . "&mode=save"
			)
		);
      
		$page = 'admin/forum_rules_body.tpl';
		
		break;
	
	
	case "notview":

		//
		// Users that don't have read the rules.
		//
		$sql = "SELECT user_id, username, user_rules FROM " . USERS_TABLE . " WHERE user_rules < $_GET[trd] AND user_id <> " . ANONYMOUS . " ORDER BY username ASC";

		if( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain list of users that don\'t have read the rules', '', __LINE__, __FILE__, $sql);
		}

		while( $row = $db->sql_fetchrow($result) )
		{
			$user_notview_rules .= '<option value="' . $row[user_id] . '">' . $row[username] . '</option>';
			$hidden_input .= $row[user_id] . ",";
		}

		//
		// Get last PM
		//
		$sql = "SELECT pm_subject, pm_message FROM " . RULES_TABLE;

		if( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain last PM', '', __LINE__, __FILE__, $sql);
		}

		$pm = $db->sql_fetchrow($result);

		//
		// Assign the template data rules.
		//
		$template->assign_vars(array(
			'L_SEND_PM_ALL' => $lang['Send_PM_All'],
			'L_SEND_PM_SELECT' => $lang['Send_PM_Select'],
			'L_SEND_EMAIL' => $lang['Send_Email_Rules'],
			'L_NOTVIEW_RULES' => $lang['NotView_Rules'],
			'L_DO' => $lang['Send'],
			'L_SUBJECT' => $lang['Subject'],
			'L_MESSAGE_BODY' => $lang['Message_body'],
			'L_FORUM_RULES' => $lang['Forum_Rules'],
			'L_FORUM_RULES_EXPLAIN' => $lang['Forum_Rules_explain_NotView'],
			'L_SEND_PM_TO' => $lang['Send_PM_to'],
			'L_USERS_NOTVIEW_RULES' => $lang['Users_NotView_Rules'],
			'L_SELECT_USER_FIRST' => $lang['Select_User_First'],

			'S_FORUMRULES_ACTION' => append_sid("admin_forum_rules.$phpEx") . "&mode=notview_sendpm",
			'S_NOTVIEW_RULES' => $user_notview_rules,
			'S_PM_SUBJECT' => $pm["pm_subject"],
			'S_PM_MESSAGE' => $pm["pm_message"],
			'S_HIDDEN_VARS' => $hidden_input
			)
		);
      
		$page = 'admin/forum_rules_notview_body.tpl';

        break;


	case "notview_sendpm":

		$privmsg_subject = trim(strip_tags($_POST['subject']));
		$msg_time = time();
		$html_on = $userdata['user_allowhtml'];
		$bbcode_on = $userdata['user_allowbbcode'];
		$smilies_on =  $userdata['user_allowsmile'];
		$attach_sig = $userdata['user_attachsig'];
		
		//
		//Save the last PM
		//
		$sql = "UPDATE " . RULES_TABLE . " SET pm_subject='$privmsg_subject' , pm_message='" . $_POST['message'] . "'";

		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not update rules table', '', __LINE__, __FILE__, $sql);
		}

		if ( $bbcode_on ) $bbcode_uid = make_bbcode_uid();	

		if (substr($_POST['all_user_notview_rules'], -1) == ",") $_POST['all_user_notview_rules'] = substr($_POST['all_user_notview_rules'], 0, -1);

		//
		//Send a PM to All Users or Selected Users
		//
		if ( $_POST['send_pm'] != "send_pm_all" )
		{
			if ( isset($_POST['user_notview_rules']) ) $user_to_send = $_POST['user_notview_rules'];
		} 

		else $user_to_send = explode(",", $_POST['all_user_notview_rules'] );

		//
		//Send PMs to Users
		//
		foreach ($user_to_send as $to_userdata) {

		$sql = "SELECT user_id, user_notify_pm, user_email, user_lang, user_active FROM " . USERS_TABLE . " WHERE user_id = '" . $to_userdata . "' AND user_id <> " . ANONYMOUS;

				if( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Could not obtain user to send PM', '', __LINE__, __FILE__, $sql);
				}

		$to_userdata = $db->sql_fetchrow($result);

		$sql_info = "INSERT INTO " . PRIVMSGS_TABLE . " (privmsgs_type, privmsgs_subject, privmsgs_from_userid, privmsgs_to_userid, privmsgs_date, privmsgs_ip, privmsgs_enable_html, privmsgs_enable_bbcode, privmsgs_enable_smilies, privmsgs_attach_sig) VALUES (" . PRIVMSGS_UNREAD_MAIL . ", '" . str_replace("\'", "''", $privmsg_subject) . "',	" . $userdata['user_id'] . ", " . $to_userdata['user_id'] . ", $msg_time, '$user_ip',	 $html_on, $bbcode_on, $smilies_on, $attach_sig)";
			
				if ( !($result = $db->sql_query($sql_info, BEGIN_TRANSACTION)) )
				{
					message_die(GENERAL_ERROR, "Could not insert/update private message sent info.", "", __LINE__, __FILE__, $sql_info);
				}

		$privmsg_sent_id = $db->sql_nextid();
		$privmsg_message = prepare_message($_POST['message'], $html_on, $bbcode_on, $smilies_on, $bbcode_uid);

		$sql = "INSERT INTO " . PRIVMSGS_TEXT_TABLE . " (privmsgs_text_id, privmsgs_bbcode_uid, privmsgs_text) VALUES ($privmsg_sent_id, 	'" . $bbcode_uid . "', '" . str_replace("\'", "''", $privmsg_message) . "')";		

				if ( !$db->sql_query($sql, END_TRANSACTION) )
				{
					message_die(GENERAL_ERROR, "Could not insert/update private message sent text.", "", __LINE__, __FILE__, $sql_info);
				}

		//
		// Add to the users new pm counter
		//
		$sql = "UPDATE " . USERS_TABLE . "	SET user_new_privmsg = user_new_privmsg + 1, user_last_privmsg = " . time() . "	WHERE user_id = " . $to_userdata['user_id'] ; 
					
				if ( !$status = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not update private message new/read status for user', '', __LINE__, __FILE__, $sql);
				}


		//Send email with PM
		if ( isset($_POST['send_email']) )
			{

		if ( $to_userdata['user_notify_pm'] && !empty($to_userdata['user_email']) && $to_userdata['user_active'] )
					{

						$script_name = preg_replace('/^\/?(.*?)\/?$/', "\\1", trim($board_config['script_path']));
						$script_name = ( $script_name != '' ) ? $script_name . '/privmsg.'.$phpEx : 'privmsg.'.$phpEx;
						$server_name = trim($board_config['server_name']);
						$server_protocol = ( $board_config['cookie_secure'] ) ? 'https://' : 'http://';
						$server_port = ( $board_config['server_port'] <> 80 ) ? ':' . trim($board_config['server_port']) . '/' : '/';
						
						$emailer = new emailer($board_config['smtp_delivery']);

						if ( substr($board_config['version'], -1) <= 4)
						{ 
							$email_headers = 'From: ' . $board_config['board_email'] . "\nReturn-Path: " . $board_config['board_email'] . "\n";
							$emailer->extra_headers($email_headers);
						}
						else 
						{
							$emailer->from($board_config['board_email']);
							$emailer->replyto($board_config['board_email']);
						}

						$emailer->use_template('privmsg_notify', $to_userdata['user_lang']);
						$emailer->email_address($to_userdata['user_email']);
						$emailer->set_subject($lang['Notification_subject']);
							
						$emailer->assign_vars(array(
							'USERNAME' => $to_username, 
							'SITENAME' => $board_config['sitename'],
							'EMAIL_SIG' => (!empty($board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']) : '', 

							'U_INBOX' => $server_protocol . $server_name . $server_port . $script_name . '?folder=inbox')
						);

						$emailer->send();
						$emailer->reset();
					}
				}

		}

		$message = $lang['Message_sent'] . 
			"<br /><br />" . sprintf($lang['Click_return_Rules'], "<a href=\"" . append_sid("admin_forum_rules.$phpEx?mode=modify") . "\">", "</a>")	 .
			"<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>")	;

		message_die(GENERAL_MESSAGE, $message);

        break;

}


//
// Output the form to retrieve Prune information.
//
$template->set_filenames(array(
	'body' =>$page )
);


//
// Actually output the page here.
//
$template->pparse('body');

include('./page_footer_admin.'.$phpEx);

?>