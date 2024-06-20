<?php
/***************************************************************************
 *                                login.php
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

//
// Allow people to reach login page if
// board is shut down
//
// CTracker_Ignore: File Checked By Human
// Tell the CTracker Filescanner that this constant is allowed 
//
define("IN_LOGIN", true);

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

//
// Set page ID for session management
//
$userdata = session_pagestart($user_ip, PAGE_LOGIN);
init_userprefs($userdata);
//
// End session management
//
#======================================================================= |
#==== Start: == phpBB Security ========================================= |
#==== v1.0.2 =========================================================== |
#====					
include_once($phpbb_root_path .'includes/phpbb_security.'. $phpEx);
#====
#==== Author: aUsTiN [austin@phpbb-amod.com] [http://phpbb-amod.com] === |
#==== End: ==== phpBB Security ========================================= |	
#======================================================================= |
//--------------------------------------------------------------------------------
// Prillian - Begin Code Addition
//

if (defined('PRILLIAN_INSTALLED') && !file_exists('prill_install'))
{
	include_once(PRILL_PATH . 'prill_common.' . $phpEx);
}

//
// Prillian - End Code Addition
//--------------------------------------------------------------------------------

// session id check
if (!empty($_POST['sid']) || !empty($_GET['sid']))
{
	$sid = (!empty($_POST['sid'])) ? $_POST['sid'] : $_GET['sid'];
}
else
{
	$sid = '';
}

// CrackerTracker v5.x
if ( !empty($_POST['username']) && !empty($ctracker_config->settings['loginfeature']) )
{
	$ctracker_config->check_login_status($_POST['username']);	
}

if( isset($_POST['login']) || isset($_GET['login']) || isset($_POST['logout']) || isset($_GET['logout']) )
{
	if( ( isset($_POST['login']) || isset($_GET['login']) ) && (!$userdata['session_logged_in'] || isset($_POST['admin'])) )
	{
      	$username = isset($_POST['username']) ? phpbb_clean_username($_POST['username']) : '';
		$password = isset($_POST['password']) ? $_POST['password'] : '';

		$sql = "SELECT user_id, username, user_password, user_active, user_level, user_rank, user_actviate_date, user_expire_date, user_regdate, user_login_tries, user_last_login_try, ct_login_count
			FROM " . USERS_TABLE . "
			WHERE username = '" . $db->sql_escape($username) . "'";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Error in obtaining userdata', '', __LINE__, __FILE__, $sql);
		}

		if( $row = $db->sql_fetchrow($result) )
		{
#======================================================================= |
#==== Start: == phpBB Security ========================================= |
#==== v1.0.2 =========================================================== |
#====
		if (md5($password) != $row['user_password'])
			phpBBSecurity_InvalidLogin($row['user_id']);								
			phpBBSecurity_CheckTries($row['user_id']);
#====
#==== Author: aUsTiN [austin@phpbb-amod.com] [http://phpbb-amod.com] === |
#==== End: ==== phpBB Security ========================================= |	
#======================================================================= |
			if( $row['user_level'] != ADMIN && $board_config['board_disable'] )
			{
				redirect(append_sid("portal.$phpEx", true));
			}
			else
			{
				// If the last login is more than x minutes ago, then reset the login tries/time
				if ($row['user_last_login_try'] && $board_config['login_reset_time'] && $row['user_last_login_try'] < (time() - ($board_config['login_reset_time'] * 60)))
				{
					$db->sql_query('UPDATE ' . USERS_TABLE . ' SET user_login_tries = 0, user_last_login_try = 0 WHERE user_id = ' . $row['user_id']);
					$row['user_last_login_try'] = $row['user_login_tries'] = 0;
				}
				
				// Check to see if user is allowed to login again... if his tries are exceeded
				if ($row['user_last_login_try'] && $board_config['login_reset_time'] && $board_config['max_login_attempts'] && 
					$row['user_last_login_try'] >= (time() - ($board_config['login_reset_time'] * 60)) && $row['user_login_tries'] >= $board_config['max_login_attempts'] && $userdata['user_level'] != ADMIN)
				{
					message_die(GENERAL_MESSAGE, sprintf($lang['Login_attempts_exceeded'], $board_config['max_login_attempts'], $board_config['login_reset_time']));
				}
				if( md5($password) == $row['user_password'] && $row['user_active'] )
				{
					lw_check_membership($row);
					$autologin = ( isset($_POST['autologin']) ) ? TRUE : 0;

					$admin = (isset($_POST['admin'])) ? 1 : 0;
					$session_id = session_begin($row['user_id'], $user_ip, PAGE_INDEX, FALSE, $autologin, $admin);
					// Reset login tries
					$db->sql_query('UPDATE ' . USERS_TABLE . ' SET user_login_tries = 0, user_last_login_try = 0 WHERE user_id = ' . $row['user_id']);

					// CrackerTracker v5.x
					if ( $ctracker_config->settings['login_history'] == 1 )
					{
						$ctracker_config->update_login_history($row['user_id']);
					}
					
					if ( $ctracker_config->settings['loginfeature'] == 1 )
					{
						$ctracker_config->reset_login_system($row['user_id']);
					}
					
					if ( $ctracker_config->settings['login_ip_check'] == 1 )
					{
						$ctracker_config->set_user_ip($row['user_id']);
					}
					if( $session_id )
					{
#======================================================================= |
#==== Start: == phpBB Security ========================================= |
#==== v1.0.2 =========================================================== |
#====					
						phpBBSecurity_ResetTries($row['user_id']);
#====
#==== Author: aUsTiN [austin@phpbb-amod.com] [http://phpbb-amod.com] === |
#==== End: ==== phpBB Security ========================================= |	
#======================================================================= |
						$url = ( !empty($_POST['redirect']) ) ? str_replace('&amp;', '&', htmlspecialchars($_POST['redirect'])) : "portal.$phpEx";
						redirect(append_sid($url, true));
					}
					else
					{
						message_die(CRITICAL_ERROR, "Couldn't start session : login", "", __LINE__, __FILE__);
					}
				}
				// Only store a failed login attempt for an active user - inactive users can't login even with a correct password
				elseif( $row['user_active'] )
				{
					// Save login tries and last login
					if ($row['user_id'] != ANONYMOUS)
					{
						// CrackerTracker v5.x
						include_once($phpbb_root_path . 'ctracker/classes/class_log_manager.' . $phpEx);
						$logfile = new log_manager();
						$logfile->prepare_log($row['username']);
						$logfile->write_general_logfile($ctracker_config->settings['logsize_logins'], 4);
						unset($logfile);
						
						if ( $ctracker_config->settings['loginfeature'] == 1 )
						{
							$ctracker_config->handle_wrong_login($row['user_id'], $row['ct_login_count']);
						}
						$sql = 'UPDATE ' . USERS_TABLE . '
							SET user_login_tries = user_login_tries + 1, user_last_login_try = ' . time() . '
							WHERE user_id = ' . $row['user_id'];
						$db->sql_query($sql);
					}
				}

				$redirect = ( !empty($_POST['redirect']) ) ? str_replace('&amp;', '&', htmlspecialchars($_POST['redirect'])) : '';
				$redirect = str_replace('?', '&', $redirect);

				if (strstr(urldecode($redirect), "\n") || strstr(urldecode($redirect), "\r") || strstr(urldecode($redirect), ';url'))
				{
					message_die(GENERAL_ERROR, 'Tried to redirect to potentially insecure url.');
				}

				$template->assign_vars(array(
					'META' => "<meta http-equiv=\"refresh\" content=\"3;url=login.$phpEx?redirect=$redirect\">")
				);

				$message = $lang['Error_login'] . '<br /><br />' . sprintf($lang['Click_return_login'], "<a href=\"login.$phpEx?redirect=$redirect\">", '</a>') . '<br /><br />' .  sprintf($lang['Click_return_index'], '<a href="' . append_sid("portal.$phpEx") . '">', '</a>');

				message_die(GENERAL_MESSAGE, $message);
			}
		}
		else
		{
			$redirect = ( !empty($_POST['redirect']) ) ? str_replace('&amp;', '&', htmlspecialchars($_POST['redirect'])) : "";
			$redirect = str_replace("?", "&", $redirect);

			if (strstr(urldecode($redirect), "\n") || strstr(urldecode($redirect), "\r") || strstr(urldecode($redirect), ';url'))
			{
				message_die(GENERAL_ERROR, 'Tried to redirect to potentially insecure url.');
			}

			$template->assign_vars(array(
				'META' => "<meta http-equiv=\"refresh\" content=\"3;url=login.$phpEx?redirect=$redirect\">")
			);

			$message = $lang['Error_login'] . '<br /><br />' . sprintf($lang['Click_return_login'], "<a href=\"login.$phpEx?redirect=$redirect\">", '</a>') . '<br /><br />' .  sprintf($lang['Click_return_index'], '<a href="' . append_sid("portal.$phpEx") . '">', '</a>');

			message_die(GENERAL_MESSAGE, $message);
		}
	}
	else if( ( isset($_GET['logout']) || isset($_POST['logout']) ) && $userdata['session_logged_in'] )
	{
		// session id check
		if ($sid == '' || $sid != $userdata['session_id'])
		{
			message_die(GENERAL_ERROR, 'Invalid_session');
		}
		if( $userdata['session_logged_in'] )
		{
			session_end($userdata['session_id'], $userdata['user_id']);
		}
//--------------------------------------------------------------------------------
// Prillian - Begin Code Addition
//
		if ( !empty($_REQUEST['in_prill']) )
		{
			im_session_update(true, true);
		}
//
// Prillian - End Code Addition
//--------------------------------------------------------------------------------

		if (!empty($_POST['redirect']) || !empty($_GET['redirect']))
		{
			$url = (!empty($_POST['redirect'])) ? htmlspecialchars($_POST['redirect']) : htmlspecialchars($_GET['redirect']);
			$url = str_replace('&amp;', '&', $url);
			redirect(append_sid($url, true));
		}
		else
		{
			redirect(append_sid("portal.$phpEx", true));
		}
	}
	else
	{
		$url = ( !empty($_POST['redirect']) ) ? str_replace('&amp;', '&', htmlspecialchars($_POST['redirect'])) : "portal.$phpEx";
		redirect(append_sid($url, true));
	}
}
else
{
	//
	// Do a full login page dohickey if
	// user not already logged in
	//
	include_once($phpbb_root_path . 'includes/functions_jr_admin.' . $phpEx);  
	$jr_admin_userdata = jr_admin_get_user_info($userdata['user_id']);  

	if( !$userdata['session_logged_in'] || (isset($_GET['admin']) && $userdata['session_logged_in'] && (!empty($jr_admin_userdata['user_jr_admin']) || $userdata['user_level'] == ADMIN)))
	{
		$page_title = $lang['Login'];
		include($phpbb_root_path . 'includes/page_header.'.$phpEx);

//--------------------------------------------------------------------------------
// Prillian - Begin Code Addition
//
		$body_tpl = '';
		if( $gen_simple_header )
		{
			$body_tpl = 'prillian/';
		}
//
// Prillian - End Code Addition
//--------------------------------------------------------------------------------
		$template->set_filenames(array(
			'body' => $body_tpl . 'login_body.tpl')
		);

		$forward_page = '';

		if( isset($_POST['redirect']) || isset($_GET['redirect']) )
		{
			$forward_to = $_SERVER['QUERY_STRING'];

			if( preg_match("/^redirect=([a-z0-9\.#\/\?&=\+\-_]+)/si", $forward_to, $forward_matches) )
			{
				$forward_to = ( !empty($forward_matches[3]) ) ? $forward_matches[3] : $forward_matches[1];
				$forward_match = preg_split('[\?|&]', $forward_to);

				if(count($forward_match) > 1)
				{
					for($i = 1; $i < count($forward_match); $i++)
					{
						if( false === strpos($forward_match[$i], "sid=") )
						{
							if( $forward_page != '' )
							{
								$forward_page .= '&';
							}
							$forward_page .= $forward_match[$i];
						}
					}
					$forward_page = $forward_match[0] . '?' . $forward_page;
				}
			}
		}
		else
		{
			$forward_page = '';
		}

		$username = ( $userdata['user_id'] != ANONYMOUS ) ? $userdata['username'] : '';

		$s_hidden_fields = '<input type="hidden" name="redirect" value="' . $forward_page . '" />';

		$s_hidden_fields .= (isset($_GET['admin'])) ? '<input type="hidden" name="admin" value="1" />' : '';

		make_jumpbox('viewforum.'.$phpEx);
		$template->assign_vars(array(
			'USERNAME' => $username,

			'L_ENTER_PASSWORD' => (isset($_GET['admin'])) ? $lang['Admin_reauthenticate'] : $lang['Enter_password'],
			'L_SEND_PASSWORD' => $lang['Forgotten_password'],

			'U_SEND_PASSWORD' => append_sid("profile.$phpEx?mode=sendpassword"),

			'S_HIDDEN_FIELDS' => $s_hidden_fields)
		);

		$template->pparse('body');

		include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
	}
	else
	{
		redirect(append_sid("portal.$phpEx", true));
	}

}

?>
