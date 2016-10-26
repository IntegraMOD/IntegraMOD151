<?php
/*
  paFileDB 3.0
  ©2001/2002 PHP Arena
  Written by Todd
  todd@phparena.net
  http://www.phparena.net
  Keep all copyright links on the script visible
  Please read the license included with this script for more information.
*/


class pafiledb_email extends pafiledb_public
{
	function main($action)
	{
		global $pafiledb_template, $lang, $board_config, $phpEx, $pafiledb_config, $db, $images, $userdata;
		global $_REQUEST, $_POST, $phpbb_root_path;

		if ( isset($_REQUEST['file_id']))
		{
			$file_id = intval($_REQUEST['file_id']);
		}
		else
		{
			message_die(GENERAL_MESSAGE, $lang['File_not_exist']);
		}
		
		$sql = 'SELECT file_catid, file_name
			FROM ' . PA_FILES_TABLE . " 
			WHERE file_id = $file_id";

		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Couldnt Query file info', '', __LINE__, __FILE__, $sql);
		}

		if(!$file_data = $db->sql_fetchrow($result))
		{
			message_die(GENERAL_MESSAGE, $lang['File_not_exist']);
		}
		
		$db->sql_freeresult($result);
		
		if( (!$this->auth[$file_data['file_catid']]['auth_email']) )
		{
			if ( !$userdata['session_logged_in'] )
			{
				redirect(append_sid("login.$phpEx?redirect=dload.$phpEx?action=email&file_id=" . $file_id, true));
			}

			$message = sprintf($lang['Sorry_auth_email'], $this->auth[$file_data['file_catid']]['auth_email_type']);
			message_die(GENERAL_MESSAGE, $message);
		}

		if ( isset($_POST['submit']) )
		{
			// session id check
			if (!isset($_POST['sid']) || $_POST['sid'] != $userdata['session_id'])
			{
				message_die(GENERAL_ERROR, 'Invalid_session');
			}			

			$error = FALSE;

			if ( !empty($_POST['femail']) && preg_match('/^[a-z0-9\.\-_\+]+@[a-z0-9\-_]+\.([a-z0-9\-_]+\.)*?[a-z]+$/is', $_POST['femail']))
			{
				$user_email = trim(stripslashes($_POST['femail']));
			}
			else
			{
				$error = TRUE;
				$error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $lang['Email_invalid'] : $lang['Email_invalid'];
			}

			$username = trim(stripslashes($_POST['fname']));
			$sender_name = trim(strip_tags(stripslashes($_POST['sname'])));
			
			if (!$userdata['session_logged_in'] || ($userdata['session_logged_in'] && $sender_name != $userdata['username']))
			{
				include($phpbb_root_path . 'includes/functions_validate.'.$phpEx);

				$result = validate_username($username);
				if ($result['error'])
				{
					$error = TRUE;
					$error_msg .= (!empty($error_msg)) ? '<br />' . $result['error_msg'] : $result['error_msg'];
				}
			}
			else
			{
				$sender_name = $userdata['username'];
			}
			
			
			if(!$userdata['session_logged_in'])
			{
				if ( !empty($_POST['semail']) && preg_match('/^[a-z0-9\.\-_\+]+@[a-z0-9\-_]+\.([a-z0-9\-_]+\.)*?[a-z]+$/is', $_POST['semail']))				
				{
					$sender_email = trim(stripslashes($_POST['semail']));
				}
				else
				{
					$error = TRUE;
					$error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $lang['Email_invalid'] : $lang['Email_invalid'];
				}				
			}
			else
			{
				$sender_email = $userdata['user_email'];
			}
  
			if ( !empty($_POST['subject']) )
			{
				$subject = trim(stripslashes($_POST['subject']));
			}
			else
			{
				$error = TRUE;
				$error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $lang['Empty_subject_email'] : $lang['Empty_subject_email'];
			}

			if ( !empty($_POST['message']) )
			{
				$message = trim(stripslashes($_POST['message']));
			}
			else
			{
				$error = TRUE;
				$error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $lang['Empty_message_email'] : $lang['Empty_message_email'];
			}

			if ( !$error )
			{
				include($phpbb_root_path . 'includes/emailer.'.$phpEx);

				$emailer = new emailer($board_config['smtp_delivery']);

				$email_headers = 'Return-Path: ' . $sender_email . "\nFrom: " . $sender_email . "\n";

				$email_headers .= 'X-AntiAbuse: Board servername - ' . $server_name . "\n";		

				$email_headers .= 'X-AntiAbuse: Username - ' . $sender_name . "\n";

				$emailer->use_template('profile_send_email', $user_lang);

				$emailer->email_address($user_email);

				$emailer->set_subject($subject);

				$emailer->extra_headers($email_headers);

				$emailer->assign_vars(array(
					'SITENAME' => $board_config['sitename'], 
					'BOARD_EMAIL' => $board_config['board_email'], 
					'FROM_USERNAME' => $sender_name, 
					'TO_USERNAME' => $username, 
					'MESSAGE' => $message)
				);

				$emailer->send();

				$emailer->reset();

				$message = $lang['Econf'] . '<br /><br />' . sprintf($lang['Click_return'], '<a href="' . append_sid('dload.'.$phpEx.'?action=file&file_id=' . $file_id) . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_forum'], '<a href="' . append_sid('index.'.$phpEx) . '">', '</a>');

				message_die(GENERAL_MESSAGE, $message);
			}

			if ( $error )
			{
				message_die(GENERAL_MESSAGE, $error_msg);  
			}

		}


		$this->generate_category_nav($file_data['file_catid']);
		
		$pafiledb_template->assign_vars(array(
			'USER_LOGGED' => (!$userdata['session_logged_in']) ? TRUE : FALSE,
		
			'S_EMAIL_ACTION' => append_sid('dload.'.$phpEx),
			'S_HIDDEN_FIELDS' => '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />',

			'L_INDEX' => sprintf($lang['Forum_Index'], $board_config['sitename']),
			'L_EMAIL' => $lang['Semail'],
			'L_EMAIL' => $lang['Emailfile'],
			'L_EMAILINFO' => $lang['Emailinfo'],
			'L_YNAME' => $lang['Yname'],
			'L_YEMAIL' => $lang['Yemail'],
			'L_FNAME' => $lang['Fname'],				
			'L_FEMAIL' => $lang['Femail'],
			'L_ETEXT' => $lang['Etext'],   
			'L_DEFAULTMAIL' => $lang['Defaultmail'],
			'L_SEMAIL' => $lang['Semail'],
			'L_ESUB' => $lang['Esub'],
			'L_EMPTY_SUBJECT_EMAIL' => $lang['Empty_subject_email'],
			'L_EMPTY_MESSAGE_EMAIL' => $lang['Empty_message_email'],

			'U_INDEX' => append_sid('index.'.$phpEx),
			'U_DOWNLOAD_HOME' => append_sid('dload.'.$phpEx),
			'U_FILE_NAME' => append_sid('dload.'.$phpEx.'?action=file&file_id=' . $file_id),

			'FILE_NAME' => $file_data['file_name'],
			'SNAME' => $userdata['username'],
			'SEMAIL' => $userdata['user_email'],
			'DOWNLOAD' => $pafiledb_config['settings_dbname'],
			'FILE_URL' => get_formated_url() . '/dload.'.$phpEx.'?action=file&file_id=' . $file_id,
			'ID' => $file_id) 
		);
		$this->display($lang['Download'], 'pa_email_body.tpl');
	}
}

?>