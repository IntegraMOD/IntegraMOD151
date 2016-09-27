<?php
/***************************************************************************
 *                               pagestart.php
 *                            -------------------
 *   begin                : Thursday, Aug 2, 2001
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

if (!defined('IN_PHPBB'))
{
	die("Hacking attempt");
}

if (!defined('IN_ADMIN'))
{
  define('IN_ADMIN', true);
}
// Include files
include($phpbb_root_path . 'common.'.$phpEx);

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);
//
// End session management
//

include_once($phpbb_root_path . 'includes/functions_jr_admin.' . $phpEx);
find_lang_file_nivisec('lang_jr_admin');

$dirname = $phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_kb.'.$phpEx;
include($dirname);



if (!$userdata['session_logged_in'])
{
	redirect(append_sid("login.$phpEx?redirect=admin/index.$phpEx", true));
	//redirect(append_sid($phpbb_root_path .'login.'. $phpEx .'?redirect=admin/index.'. $phpEx, true)); 
}
elseif (strstr(basename($_SERVER['REQUEST_URI']),"xs_"))
{
	// use a mdified secure function for extreme styles to fix bug - see functions_jr_admin.php //
	if(!jr_admin_secure_2(basename($_SERVER['REQUEST_URI'])))
		{
			message_die(GENERAL_ERROR, $lang['Error_Module_ID'], '', __LINE__, __FILE__);		
		}
}
elseif (!jr_admin_secure(basename($_SERVER['REQUEST_URI'])))
{
	message_die(GENERAL_ERROR, $lang['Error_Module_ID'], '', __LINE__, __FILE__);	
}



if ($_GET['sid'] != $userdata['session_id'] && $HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_sid'] != $userdata['session_id']) 
{
	redirect("index.$phpEx?sid=" . $userdata['session_id']);
}

$p_sid = (isset($_GET['p_sid'])) ? $_GET['p_sid'] : ((isset($_POST['p_sid'])) ? $_POST['p_sid'] : '');

// if ($p_sid !== $userdata['priv_session_id'])
// {
// 	 redirect("index.$phpEx?sid=" . $userdata['session_id']);
// }

if (!$userdata['session_admin'])
{
	redirect(append_sid("login.$phpEx?redirect=admin/index.$phpEx&admin=1", true));
}

if (empty($no_page_header))
{
	// Not including the pageheader can be neccesarry if META tags are
	// needed in the calling script.
	include('./page_header_admin.'.$phpEx);
}

?>
