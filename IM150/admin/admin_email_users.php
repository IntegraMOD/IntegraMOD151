<?php
/***************************************************************************
 *                              	   admin_email_users.php
 *                                   ------------------
 *
 *   begin                             : 02/03/2004
 *
 *
 ***************************************************************************/

if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['General']['Mass_Email_Users'] = $file;
	return;
}

define('IN_PHPBB', true);
$phpbb_root_path = '../';
require($phpbb_root_path . 'extension.inc');
require("pagestart.$phpEx");
include($phpbb_root_path.'language/lang_' . $board_config['default_lang'] . '/lang_admin_mail_users.'.$phpEx);
include($phpbb_root_path . 'includes/functions_post.'.$phpEx);
include($phpbb_root_path . 'includes/bbcode.'.$phpEx);

// define the new table
define('USER_EMAILS_TABLE', $table_prefix.'email_users');

// have the mail sender infos
$script_name = preg_replace('/^\/?(.*?)\/?$/', "\\1", trim($board_config['script_path']));
$script_name = ( $script_name != '' ) ? $script_name . '/privmsg.'.$phpEx : 'privmsg.'.$phpEx;
$server_name = trim($board_config['server_name']);
$server_protocol = ( $board_config['cookie_secure'] ) ? 'https://' : 'http://';
$server_port = ( $board_config['server_port'] <> 80 ) ? ':' . trim($board_config['server_port']) . '/' : '/';

$template->set_filenames(array(
	'body' => 'admin/config_email_users_body.tpl')
);

$add = isset($_POST['add']); 
$send_action = isset($_POST['send_action']);
$send_pm_action = isset($_POST['send_pm_action']);
$send = isset($_POST['send']); 
$remove = isset($_POST['remove']);

if ( $add )
{
	$sql = "SELECT * FROM " . USERS_TABLE . "
		WHERE user_id > 1
		ORDER by username";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain celled list', '', __LINE__, __FILE__, $sql);
	}
	$email_tos = $db->sql_fetchrowset($result);

	$sql = array();
	
	while( list(,$email_to) = @each($email_tos) )
	{
		if ( isset($_POST[$email_to['user_id']]))
		{
			$id = $email_to['user_id'];
			$mail = $email_to['user_email'];

			$sql = " INSERT INTO " . USER_EMAILS_TABLE . "  ( user_id , user_email ) VALUES ( $id , '" . str_replace("\'", "''", $mail) ."' ) ";
			$result = $db->sql_query($sql);
			if( !$result )
			{
				message_die(GENERAL_ERROR, "Couldn't insert new user into the email table", "", __LINE__, __FILE__, $sql);
			}

		}
	}

	$message = $lang['Admin_email_users_message_users_added'];
	$message .= "<br /><br />" . sprintf($lang['Admin_email_users_return'], "<a href=\"" . append_sid("admin_email_users.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");
	message_die(GENERAL_MESSAGE, $message);
}

else if ( $send )
{
	$template->assign_block_vars('send',array());

	$sql = "SELECT e.* , u.username FROM " . USER_EMAILS_TABLE . " e , " . USERS_TABLE . " u
		WHERE u.user_id = e.user_id ";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain user list', '', __LINE__, __FILE__, $sql);
	}
	$targets = $db->sql_fetchrowset($result);

	for ( $i = 0; $i < count ( $targets ) ; $i++ )
	{
		$template->assign_block_vars('send.targets',array(
			'USER_NAME' => $targets[$i]['username'],
			'USER_EMAIL' => $targets[$i]['user_email'],
		));
	}

}

else if ( $remove )
{
	$sql = "SELECT e.* , u.username FROM " . USER_EMAILS_TABLE . " e , " . USERS_TABLE . " u
		WHERE u.user_id = e.user_id ";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain user list', '', __LINE__, __FILE__, $sql);
	}
	$targets = $db->sql_fetchrowset($result);

	$sql = array();
	
	while( list(,$target) = @each($targets) )
	{
		if ( isset($_POST[$target['user_id']]))
		{
			$id = $target['user_id'];

			$sql = " DELETE FROM " . USER_EMAILS_TABLE . "  
				WHERE user_id = $id ";
			$result = $db->sql_query($sql);
			if( !$result )
			{
				message_die(GENERAL_ERROR, "Couldn't insert delete user into the email table", "", __LINE__, __FILE__, $sql);
			}

		}
	}

	$message = $lang['Admin_email_users_message_users_removed'];
	$message .= "<br /><br />" . sprintf($lang['Admin_email_users_return'], "<a href=\"" . append_sid("admin_email_users.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");
	message_die(GENERAL_MESSAGE, $message);
}

else if ( $send_pm_action )
{
	$subject = stripslashes(trim($_POST['subject']));
	$message = stripslashes(trim($_POST['message']));

	$sql = "SELECT e.* , u.username FROM " . USER_EMAILS_TABLE . " e , " . USERS_TABLE . " u
		WHERE u.user_id = e.user_id ";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain user list', '', __LINE__, __FILE__, $sql);
	}
	$dests = $db->sql_fetchrowset($result);

	for ( $i = 0 ; $i < count($dests) ; $i++ )
	{	
		$dest_user = $dests[$i]['user_id'];
	    $msg_time = time();
   
		$sql = "SELECT user_id, user_notify_pm, user_email, user_lang, user_active
			 FROM " . USERS_TABLE . "
			 WHERE user_id = $dest_user
			 AND user_id <> " . ANONYMOUS;
		if ( !($result = $db->sql_query($sql)) )
		{
			$error = TRUE;
			$error_msg = $lang['No_such_user'];
		}

		$to_userdata = $db->sql_fetchrow($result);

		$privmsg_subject = trim(strip_tags($subject));
		if ( empty($privmsg_subject) )
		{
			$error = TRUE;
			$error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . $lang['Empty_subject'];
		}

		if ( !empty($message) )
		{
			if ( !$error )
			{
				if ( $bbcode_on )
				{
					$bbcode_uid = make_bbcode_uid();
				}

				$privmsg_message = prepare_message($message, $html_on, $bbcode_on, $smilies_on, $bbcode_uid);
				$privmsg_message = str_replace('\\\n', '\n', $privmsg_message);
			}
		}
		else
		{
			$error = TRUE;
			$error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . $lang['Empty_message'];
		}

		$sql = "SELECT COUNT(privmsgs_id) AS inbox_items, MIN(privmsgs_date) AS oldest_post_time
			FROM " . PRIVMSGS_TABLE . "
			WHERE ( privmsgs_type = " . PRIVMSGS_NEW_MAIL . "
            OR privmsgs_type = " . PRIVMSGS_READ_MAIL . " 
            OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " )
			AND privmsgs_to_userid = $dest_user ";
		if ( !($result = $db->sql_query($sql)) )
		{
			 message_die(GENERAL_MESSAGE, $lang['No_such_user']);
		}

		$sql_priority = ( SQL_LAYER == 'mysql' ) ? 'LOW_PRIORITY' : '';

		if ( $inbox_info = $db->sql_fetchrow($result) )
		{
			if ( $inbox_info['inbox_items'] >= $board_config['max_inbox_privmsgs'] )
			{
				 $sql = "SELECT privmsgs_id FROM " . PRIVMSGS_TABLE . "
					WHERE ( privmsgs_type = " . PRIVMSGS_NEW_MAIL . "
					OR privmsgs_type = " . PRIVMSGS_READ_MAIL . "
					OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . "  )
					AND privmsgs_date = " . $inbox_info['oldest_post_time'] . "
					AND privmsgs_to_userid = $dest_user ";
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

		$sql_info = "INSERT INTO " . PRIVMSGS_TABLE . " (privmsgs_type, privmsgs_subject, privmsgs_from_userid, privmsgs_to_userid, privmsgs_date, privmsgs_ip, privmsgs_enable_html, privmsgs_enable_bbcode, privmsgs_enable_smilies, privmsgs_attach_sig)
			VALUES (" . PRIVMSGS_NEW_MAIL . ", '" . str_replace("\'", "''", $privmsg_subject) . "', 2 , " . $to_userdata['user_id'] . ", $msg_time, '$user_ip', 0 , 1 , 1 , 1)";
	    if ( !($result = $db->sql_query($sql_info, BEGIN_TRANSACTION)) )
	    {
			message_die(GENERAL_ERROR, "Could not insert/update private message sent info.", "", __LINE__, __FILE__, $sql_info);
	    }

		$privmsg_sent_id = $db->sql_nextid();

		$sql = "INSERT INTO " . PRIVMSGS_TEXT_TABLE . " (privmsgs_text_id, privmsgs_bbcode_uid, privmsgs_text)
			VALUES ($privmsg_sent_id, '" . $bbcode_uid . "', '" . str_replace("\'", "''", $privmsg_message) . "')";
		if ( !$db->sql_query($sql, END_TRANSACTION) )
		{
			message_die(GENERAL_ERROR, "Could not insert/update private message sent text.", "", __LINE__, __FILE__, $sql);
		}

		$sql = "UPDATE " . USERS_TABLE . "
			SET user_new_privmsg = user_new_privmsg + 1, user_last_privmsg = " . time() . " 
			WHERE user_id = " . $to_userdata['user_id'];
		if ( !$status = $db->sql_query($sql) )
		{
			 message_die(GENERAL_ERROR, 'Could not update private message new/read status for user', '', __LINE__, __FILE__, $sql);
		}

		if ( $to_userdata['user_notify_pm'] && !empty($to_userdata['user_email']) && $to_userdata['user_active'] )
		{
			include_once($phpbb_root_path . 'includes/emailer.'.$phpEx);
			$emailer = new emailer($board_config['smtp_delivery']);
        
			if  ( $board_config['version'] == '.0.5' || $board_config['version'] == '.0.6' )
			{   
				$emailer->from($board_config['board_email']);
				$emailer->replyto($board_config['board_email']);
				$emailer->use_template('privmsg_notify', $to_userdata['user_lang']);
			}
			else
			{
				$email_headers = 'From: ' . $board_config['board_email'] . "\nReturn-Path: " . $board_config['board_email'] . "\n";
				$emailer->use_template('privmsg_notify', $to_userdata['user_lang']);
				$emailer->extra_headers($email_headers);
			}
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
	message_die(GENERAL_MESSAGE, $lang['Message_sent'] . '<br /><br />' . sprintf($lang['Click_return_admin_index'],  '<a href="' . append_sid("index.$phpEx?pane=right") . '">', '</a>'));
}

else if ( $send_action )
{
	@set_time_limit(1200);

	$subject = stripslashes(trim($_POST['subject']));
	$message = stripslashes(trim($_POST['message']));
	
	$error = FALSE;
	$error_msg = '';

	if ( empty($subject) )
	{
		$error = true;
		$error_msg .= ( !empty($error_msg) ) ? '<br />' . $lang['Empty_subject'] : $lang['Empty_subject'];
	}

	if ( empty($message) )
	{
		$error = true;
		$error_msg .= ( !empty($error_msg) ) ? '<br />' . $lang['Empty_message'] : $lang['Empty_message'];
	}

	$sql = "SELECT e.* , u.username FROM " . USER_EMAILS_TABLE . " e , " . USERS_TABLE . " u
		WHERE u.user_id = e.user_id ";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain user list', '', __LINE__, __FILE__, $sql);
	}

	if ( $row = $db->sql_fetchrow($result) )
	{
		$bcc_list = array();
		do
		{
			$bcc_list[] = $row['user_email'];
		}
		while ( $row = $db->sql_fetchrow($result) );

		$db->sql_freeresult($result);
	}

	if ( !$error )
	{
		include_once($phpbb_root_path . 'includes/emailer.'.$phpEx);

		//
		// Let's do some checking to make sure that mass mail functions
		// are working in win32 versions of php.
		//
		if ( preg_match('/[c-z]:\\\.*/i', getenv('PATH')) && !$board_config['smtp_delivery'])
		{
			$ini_val = ( @phpversion() >= '4.0.0' ) ? 'ini_get' : 'get_cfg_var';

			// We are running on windows, force delivery to use our smtp functions
			// since php's are broken by default
			$board_config['smtp_delivery'] = 1;
			$board_config['smtp_host'] = @$ini_val('SMTP');
		}

		$emailer = new emailer($board_config['smtp_delivery']); 

		if  ( $board_config['version'] == '.0.5' || $board_config['version'] == '.0.6' )
		{
			$emailer->from($board_config['board_email']);
			$emailer->replyto($board_config['board_email']);

			for ($i = 0; $i < count($bcc_list); $i++)
			{
				$emailer->bcc($bcc_list[$i]);
			}

			$email_headers = 'X-AntiAbuse: Board servername - ' . $board_config['server_name'] . "\n";
			$email_headers .= 'X-AntiAbuse: User_id - ' . $userdata['user_id'] . "\n";
			$email_headers .= 'X-AntiAbuse: Username - ' . $userdata['username'] . "\n";
			$email_headers .= 'X-AntiAbuse: User IP - ' . decode_ip($user_ip) . "\n";
		}
		else
		{    
			$email_headers = 'Return-Path: ' . $userdata['board_email'] . "\nFrom: " . $board_config['board_email'] . "\n"; 
			$email_headers .= 'X-AntiAbuse: Board servername - ' . $board_config['server_name'] . "\n"; 
			$email_headers .= 'X-AntiAbuse: User_id - ' . $userdata['user_id'] . "\n"; 
			$email_headers .= 'X-AntiAbuse: Username - ' . $userdata['username'] . "\n"; 
			$email_headers .= 'X-AntiAbuse: User IP - ' . decode_ip($user_ip) . "\n"; 
			$email_headers .= "Bcc: $bcc_list\n"; 			
		}

		$emailer->use_template('admin_send_email'); 
		$emailer->email_address($board_config['board_email']); 
		$emailer->set_subject($subject); 
		$emailer->extra_headers($email_headers); 

		$emailer->assign_vars(array(
			'SITENAME' => $board_config['sitename'], 
			'BOARD_EMAIL' => $board_config['board_email'], 
			'MESSAGE' => $message)
		);
		$emailer->send();
		$emailer->reset();
	}
	else
	{
		$message = $error_msg;
		$message .= "<br /><br />" . sprintf($lang['Admin_email_users_return'], "<a href=\"" . append_sid("admin_email_users.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");
		message_die(GENERAL_MESSAGE, $message);
	}

	message_die(GENERAL_MESSAGE, $lang['Email_sent'] . '<br /><br />' . sprintf($lang['Click_return_admin_index'],  '<a href="' . append_sid("index.$phpEx?pane=right") . '">', '</a>'));

}

else
{
	$template->assign_block_vars('userlist',array());

	$sql = "SELECT e.* , u.username FROM " . USER_EMAILS_TABLE . " e , " . USERS_TABLE . " u
		WHERE u.user_id = e.user_id ";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain user list', '', __LINE__, __FILE__, $sql);
	}
	$targets = $db->sql_fetchrowset($result);

	$ever = '(';
	for ( $i = 0; $i < count ( $targets ) ; $i++ )
	{
		$template->assign_block_vars('userlist.targets',array(
			'USER_ID' => $targets[$i]['user_id'],
			'USER_NAME' => $targets[$i]['username'],
			'USER_EMAIL' => $targets[$i]['user_email'],
		));

		$ever .= $targets[$i]['user_id'] . ',' ;
	}
	$ever .= ' -1 , 1 , 0)';

	$start = ( isset($_GET['start']) ) ? intval($_GET['start']) : 0;

	if ( isset($_GET['sort_mode']) || isset($_POST['sort_mode']) )
	{
		$sort_mode = ( isset($_POST['sort_mode']) ) ? htmlspecialchars($_POST['sort_mode']) : htmlspecialchars($_GET['sort_mode']);
	}
	else
	{
		$sort_mode = 'username';
	}

	if(isset($_POST['order']))
	{
		$sort_order = ($_POST['order'] == 'ASC') ? 'ASC' : 'DESC';
	}
	else if(isset($_GET['order']))
	{
		$sort_order = ($_GET['order'] == 'ASC') ? 'ASC' : 'DESC';
	}
	else
	{
		$sort_order = 'ASC';
	}

	$mode_types_text = array($lang['Sort_Username'], $lang['Sort_Posts'], $lang['Sort_Email']);
	$mode_types = array( 'username', 'posts', 'email', );

	$select_sort_mode = '<select name="sort_mode">';
	for($i = 0; $i < count($mode_types_text); $i++)
	{
		$selected = ( $sort_mode == $mode_types[$i] ) ? ' selected="selected"' : '';
		$select_sort_mode .= '<option value="' . $mode_types[$i] . '"' . $selected . '>' . $mode_types_text[$i] . '</option>';
	}
	$select_sort_mode .= '</select>';

	$select_sort_order = '<select name="order">';
	if($sort_order == 'ASC')
	{
		$select_sort_order .= '<option value="ASC" selected="selected">' . $lang['Sort_Ascending'] . '</option><option value="DESC">' . $lang['Sort_Descending'] . '</option>';
	}
	else
	{
		$select_sort_order .= '<option value="ASC">' . $lang['Sort_Ascending'] . '</option><option value="DESC" selected="selected">' . $lang['Sort_Descending'] . '</option>';
	}
	$select_sort_order .= '</select>';

	switch( $sort_mode )
	{
		case 'username':
			$order_by = "u.username $sort_order LIMIT $start , " . $board_config['topics_per_page'];
			break;
		case 'posts':
			$order_by = "u.user_posts $sort_order LIMIT $start , " . $board_config['topics_per_page'];
			break;
		case 'email':
			$order_by = "u.user_email $sort_order LIMIT $start , " . $board_config['topics_per_page'];
			break;
		default:
			$order_by = "u.username $sort_order LIMIT $start , " . $board_config['topics_per_page'];
			break;
	}

	$sql = "SELECT u.* FROM " . USERS_TABLE . " u
		WHERE u.user_id NOT IN $ever
		ORDER BY $order_by ";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain user list', '', __LINE__, __FILE__, $sql);
	}
	$users = $db->sql_fetchrowset($result);

	for ( $i = 0; $i < count ( $users ) ; $i++ )
	{
		$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

		$template->assign_block_vars('userlist.users',array(
			'USER_ID' => $users[$i]['user_id'],
			'USER_NAME' => $users[$i]['username'],
			'USER_EMAIL' => $users[$i]['user_email'],
			'USER_POSTS' => $users[$i]['user_posts'],
			'ROW' => $row_class,
		));

		$sql = "SELECT g.group_name , g.group_id FROM " . GROUPS_TABLE . " g , " . USER_GROUP_TABLE . " ug , " . USERS_TABLE . " u
			WHERE g.group_single_user = 0
			AND g.group_id = ug.group_id 
			AND u.user_id = ug.user_id 
			AND u.user_id = " . $users[$i]['user_id'] . "	";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain user list', '', __LINE__, __FILE__, $sql);
		}
		$groups = $db->sql_fetchrowset($result);

		for ( $k = 0 ; $k < count($groups) ; $k ++ )
		{
			$template->assign_block_vars('userlist.users.groups',array(
				'GROUP_NAME' => $groups[$k]['group_name'],
				'GROUP_LINK' => append_sid("../groupcp.$phpEx?" . POST_GROUPS_URL . "=" . $groups[$k]['group_id'] . ""),
			));
		}
	}

	$sql = "SELECT * FROM " . USERS_TABLE . " 
		WHERE user_id NOT IN $ever ";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain user list', '', __LINE__, __FILE__, $sql);
	}
	$users = $db->sql_fetchrowset($result);
	$total_members = count($users);
	$pagination = generate_pagination("admin_email_users.$phpEx?sort_mode=$sort_mode&amp;order=$sort_order", $total_members, $board_config['topics_per_page'], $start). '&nbsp;';
}

$template->assign_vars(array(
	'PAGINATION' => $pagination,
	'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $board_config['topics_per_page'] ) + 1 ), ceil( $total_members / $board_config['topics_per_page'] )), 
	'L_REMOVE' => $lang['Admin_email_users_remove'],
	'L_ADD' => $lang['Admin_email_users_add'],
	'L_SELECT_SORT_METHOD' => $lang['Select_sort_method'],
	'L_USERLIST' => $lang['Admin_email_users_userlist'],
	'L_DEST_USERS' => $lang['Admin_email_users_email_to'],
	'L_SEND' => $lang['Admin_email_users_send'],
	'L_SEND_PM' => $lang['Admin_email_users_send_pm'],
	'L_SEND_MAIL' => $lang['Admin_email_users_send_mail'],
	'L_USER_EMAIL' => $lang['Email'],
	'L_USER_NAME' => $lang['Username'],
	'L_ORDER' => $lang['Order'],
	'L_SORT' => $lang['Sort'],
	'L_USER_POSTS' => $lang['Posts'], 
	'L_MASS_EMAIL_TITLE' => $lang['Admin_email_users_title'],
	'L_MASS_EMAIL_TEXT' => $lang['Admin_email_users_explain'],
	'L_GOTO_PAGE' => $lang['Goto_page'],
	'L_MESSAGE_TO_SEND' > $lang['Admin_email_users_message_to_send'],
	'L_MESSAGE' => $lang['Message'],
	'L_SUBJECT' => $lang['Subject'],
	'S_MODE_SELECT' => $select_sort_mode,
	'S_ORDER_SELECT' => $select_sort_order,
	'L_SUBMIT' => $lang['Submit'],
	"S_SUBMIT_ACTION" => append_sid("admin_email_users.$phpEx"),
));


$template->pparse("body");

include('./page_footer_admin.'.$phpEx);

?>