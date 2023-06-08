<?php

/***************************************************************************
 *                            privmsg_popup.php
 *							  -----------------
 *	begin				: 22/06/2003
 *	copyright			: Ptirhiik
 *	email				: admin@rpgnet-fr.com
 *
 *	version				: 1.0.1 - 25/06/2003
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

if ( !empty($setmodules) ) return;

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
	exit;
}
//
// Is PM disabled?
//
if ( !empty($board_config['privmsg_disable']) )
{
	message_die(GENERAL_MESSAGE, 'PM_disabled');
}
//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_PRIVMSGS);
init_userprefs($userdata);
//
// End session management
//

// process
$gen_simple_header = TRUE;
$page_title = $lang['Private_Messaging'];
include($phpbb_root_path . 'includes/page_header.'.$phpEx);

$template->set_filenames(array(
	'body' => 'privmsgs_popup.tpl')
);

if ( $userdata['session_logged_in'] )
{
	if ( $userdata['user_new_privmsg'] )
	{
		$l_new_message = ( $userdata['user_new_privmsg'] == 1 ) ? $lang['You_new_pm'] : $lang['You_new_pms'];
	}
	else
	{
		$l_new_message = $lang['You_no_new_pm'];
	}
	$l_new_message .= '<br /><br />' . sprintf($lang['Click_view_privmsg'], '<a href="' . append_sid("profile.$phpEx?mode=privmsg&sub=inbox") . '" onclick="jump_to_inbox();return false;" target="_new">', '</a>');
}
else
{
	$l_new_message = $lang['Login_check_pm'];
}

$template->assign_vars(array(
	'L_CLOSE_WINDOW' => $lang['Close_window'], 
	'L_MESSAGE' => $l_new_message)
);

$template->pparse('body');
include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>