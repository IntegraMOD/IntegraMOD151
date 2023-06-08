<?php
/**
* This PHP File is used for the Visual Confirmation Page if a user has to
* reactivate his/her Account. Its in my opinion easyer to use this central
* site to do this because the previous Version of CrackerTracker showed that
* many people have problems to edit the login.php and the login_body.tpl
* correctly with the Switch. So to solve Problems with login we use this
* stand alone page wich we can also easy update if the Visual Confirmation
* System would change.
*
* @author Christian Knerr (cback)
* @package ctracker
* @version 5.0.0
* @since 24.07.2006 - 19:33:16
* @copyright (c) 2006 www.cback.de
*
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*/

// CTracker_Ignore: File checked by human

/*
 * We say we're the login page that the Admin has the possibility to
 * reactivate his account again if it should be deactivated on disabled
 * Board.
 */
define('IN_LOGIN', true);


define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);


// Start session management
$userdata = session_pagestart($user_ip, PAGE_LOGIN);
init_userprefs($userdata);
// End session management


// session id check
if (!empty($_POST['sid']) || !empty($_GET['sid']))
{
	$sid = (!empty($_POST['sid'])) ? $_POST['sid'] : $_GET['sid'];
}
else
{
	$sid = '';
}

// Get URL vars
$mode		  = $_GET['mode'];
$user_id      = $_GET['uid'];


// Ensure that a user is not logged in
if ( $userdata['session_logged_in'] )
{
	message_die(GENERAL_MESSAGE, $lang['ctracker_login_logged']);
}


// Include the page_header
$page_title = $lang['ctracker_login_title'];
include($phpbb_root_path . 'includes/page_header.' . $phpEx);


// Define the Template for this file
$template->set_filenames(array(
	'body' => 'ctracker/ctracker_login.tpl')
);


/*
 * Include Visual Confirmation System
 */
if ( $ctracker_config->settings['loginfeature'] == 1 )
{
	define('CRACKER_TRACKER_VCONFIRM', true);
	define('CTRACKER_ACCOUNT_FREE', true);

	include_once( $phpbb_root_path . 'ctracker/engines/ct_visual_confirm.' . $phpEx );
}


// Send some vars to the template
$template->assign_vars(array(
	'CONFIRM_IMAGE'   => $confirm_image,
	'PAGE_ICON'       => $images['ctracker_key_icon'],
	'PI_ICON'         => $images['ctracker_easter_egg'],
	'S_FORM_ACTION'   => append_sid( 'ctracker_login.' . $phpEx . '?mode=check&uid=' . $user_id ),
	'S_HIDDEN_FIELDS' => $s_hidden_fields,
	'L_HEADER_TEXT'   => $lang['ctracker_login_title'],
	'L_DESCRIPTION'   => $lang['ctracker_login_confim'],
	'L_BUTTON_TEXT'	  => $lang['ctracker_login_button'])
	);


// Generate the page
$template->pparse('body');


// Include the page_tail.php file
include($phpbb_root_path . 'includes/page_tail.' . $phpEx);


?>
