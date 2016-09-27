<?php
/***************************************************************************
 *                               imclient.php
 *                            -------------------
 *   begin                : Wednesday, Nov 6, 2002
 *   version              : 0.7.0
 *   date                 : 2003/12/23 23:19
 ***************************************************************************/

define('IN_PHPBB', true);
$phpbb_root_path = './';
include_once($phpbb_root_path . 'extension.inc');
include_once($phpbb_root_path . 'common.' . $phpEx);

// Session management
$userdata = session_pagestart($user_ip, PAGE_PRILLIAN);
init_userprefs($userdata);

// Path to Instant Messenger files other than imclient.php
include_once(PRILL_PATH . 'prill_common.' . $phpEx);
$gen_simple_header = true; // Avoids full page headers in small windows

//
// Are instant messages disabled?
//
if ( !$prill_config['allow_ims'] )
{
	$message = $lang['IM_disabled'] . $append_msg;
	message_die(GENERAL_MESSAGE, $message);
}

// Get user's IM Preferences
$im_userdata = array();
$im_userdata = init_imprefs($userdata['user_id'], true);

// mode check
$mode = ( !empty($_REQUEST['mode']) ) ? $_REQUEST['mode'] : FRAMES_MODE;

// mode2 check - mode2 will be the window mode of the IM Client that is displayed
$mode2 = ( !empty($_REQUEST['mode2']) ) ? $_REQUEST['mode2'] : $im_userdata['current_mode'];

if( $mode2 != MAIN_MODE && $mode2 != WIDE_MODE && $mode2 != MINI_MODE )
{
	 $mode2 = $prill_config['default_mode'];
}

//
// Not logged in? Then go to the login page.
//
if ( !$userdata['session_logged_in'] )
{
	thoul_redirect('login.' . $phpEx . '?redirect=imclient.' . $phpEx . '?mode=' . $mode . '&mode2=' . $mode2 . '&simple=1');
}

//
// Have IM privs for the user been turned off by admin?
//
if ( !$im_userdata['admin_allow_ims'] )
{
	$message = $lang['Cannot_send_im_admin'] . $append_msg;
	message_die(GENERAL_MESSAGE, $message);
}

// Include commonly used files
include_once($phpbb_root_path . 'includes/bbcode.'.$phpEx);

//
// Have IM privs for the user been turned off by user?
//
if ( !$im_userdata['user_allow_ims'] && $mode !='editprofile')
{
	$message = sprintf($lang['Cannot_send_im'], '<a href="' . append_sid("imclient.$phpEx?mode=editprofile&oldmode=" . $mode . '_' . $mode2) . '" onClick="javascript:window.open(\'' . append_sid("imclient.$phpEx?mode=editprofile&oldmode=" . $mode . '_' . $mode2) . '\', \'im_prefs\', \'scrollbars, resizable, height=' . $im_userdata['prefs_height'] . ', innerHeight=' . $im_userdata['prefs_height'] . ', innerWidth=' . $im_userdata['prefs_width'] . ', width=' . $im_userdata['prefs_width'] . '\'); return false">', '</a>');
	$message .= $append_msg;
	message_die(GENERAL_MESSAGE, $message);
}

// Initialize some common variables we my need.

$submit = ( isset($_REQUEST['post']) ) ? true : 0;
$saveclose = ( isset($_REQUEST['saveclose']) ) ? true : 0;
$savereply = ( isset($_REQUEST['savereply']) ) ? true : 0;
$save_sent_im = ( isset($_REQUEST['save_sent']) ) ? true : 0;
$mark_read = ( isset($_REQUEST['mark_read']) ) ? true : 0;

$full_footer = true;
$frames = false;

switch($mode)
{
	case NO_FRAMES_MODE:
		// Frameless Mode. Needs Controls and main body
		im_session_update();
		$frames = true;
		switch($mode2)
		{
			case MINI_MODE:
				include_once(PRILL_PATH . 'im_mini.'.$phpEx);
				break;
			case WIDE_MODE:
			case MAIN_MODE:
			default:
				$mode = $mode2;
				include_once(PRILL_PATH . 'im_main.' . $phpEx);
				break;
		}
		break;
	case FRAMES_MODE:
		// Frames of IM Client
		$template->set_filenames(array(
			'body' => 'prillian/frameset.tpl'
		));

		$u_refresher = append_sid($phpbb_root_path . 'imclient.' . $phpEx . '?mode=' . $mode2);
		$u_control = append_sid($phpbb_root_path . 'imclient.' . $phpEx . '?mode=controls&mode2=' . $mode2);
		$template->assign_vars(array(
			'L_PRILLIAN' => $page_title,
			'U_IM_PATH' => PRILL_PATH,
			'U_REFRESHER' => $u_refresher,
			'U_CONTROL' => $u_control
		));

		$full_footer = false;
		break;
	case 'controls':
		// Print Controls frame
		include_once(PRILL_PATH . 'prill_header.' . $phpEx);
		print_controls('?mode=' . $mode2, FRAMES_MODE, $mode2, true);
		break;
	case 'read':
		// Read a message
		include_once(PRILL_PATH . 'im_read.' . $phpEx);
		break;
	case 'editprofile':
		// Has admin set board to override user settings?
		if( $prill_config['override_users'] )
		{
			// Yes? Then tell them and offer to close the window.
			$message = $lang['Admin_override'] . $append_msg;
			message_die(GENERAL_MESSAGE, $message);
		}
		else
		{
			// No? Then edit the profile.
			include_once(PRILL_PATH . 'usercp_imprefs.' . $phpEx);
		}
		break;
	case 'post':
	case 'reply':
		// Send or reply to a message
		include_once($phpbb_root_path . 'includes/functions_post.' . $phpEx);
		include_once(PRILL_PATH . 'im_send.' . $phpEx);
		break;
	case WIDE_MODE:
	case MAIN_MODE:
		// Start and/or update IM Client sessions
		im_session_update();

		// Main IM Client or Who's Online Client
		include_once(PRILL_PATH . 'im_main.' . $phpEx);
		break;
	case MINI_MODE:
		// Start and/or update IM Client sessions
		im_session_update();

		// And I shall call him... mini mode!
		include_once(PRILL_PATH . 'im_mini.'.$phpEx);
		// I've never actually seen that movie.
		break;
	case 'log':
		// View the Message Log
		include_once(PRILL_PATH . 'im_log.' . $phpEx);
		break;
	case 'profile':
		// View a Mini-Profile
		include_once(PRILL_PATH . 'profile.' . $phpEx);
		break;
}

$template->pparse('body');
include_once(PRILL_PATH . 'prill_footer.' . $phpEx);

if( !$include_footer )
{
	$db->sql_close();
}
?>