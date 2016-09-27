<?php
/***************************************************************************
 *                                Errors.php
 *                            -------------------
 *   begin                : Wednesday, June 4, 2003
 *   email                : Joshua_Hesketh@hotmail.com
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

/***************************************************************************
 *
 *   Some code in this file I borrowed from the original index.php, Welcome
 *   Avatar MOD and others...
 *
 ***************************************************************************/

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'config.'.$phpEx);
include($phpbb_root_path . 'common.'.$phpEx);

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);
//
// End session management
//

include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_errors.' . $phpEx);

if(isset($_GET['error']))
{
	$error = $_GET['error'];
}
else
{
	$error = '';
}

switch ($error) 
{ 
  case '401': 
  case '403': 
  case '404': 
  case '500': 
    $error_title = $lang['error_' . $error];
    $error_message = $lang['error_' . $error . '_message'];
    break;
  default: 
    $error_title = $lang['Unknown_error'];
    $error_message = $lang['Unknown_error_message'];
    break;
};


$page_title = $lang['error_' . $error];
include($phpbb_root_path . 'includes/page_header.'.$phpEx);

$template->set_filenames(array(
	'body' => 'errors_body.tpl')
);

$template->assign_vars(array(
	'L_ERROR' => $error_title,
	'L_ERROR_MESSAGE' => $error_message,)
);

//
// Generate the page
//

$template->pparse('body');

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>