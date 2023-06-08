<?php
/***************************************************************************
 *                            profile_birthday.php
 *                            --------------------
 *	begin				: 08/05/2003
 *	copyright			: Ptirhiik
 *	email				: admin@rpgnet-fr.com
 *
 *	version				: 1.0.0
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

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);

//
// set the page title and include the page header
//
$page_title = $lang['Birthday'];
$gen_simple_header = true;
include ($phpbb_root_path . 'includes/page_header.'.$phpEx);
//
// nom de l'écran
//
$template->set_filenames(array(
	'body' => 'profilcp/birthday_popup.tpl',
	)
);
//
// entête page : les constantes titres, etc.
//
$template->assign_vars(array(
	'L_MESSAGE' => sprintf($lang['birthday_msg'], $userdata['username'], $board_config['sitename']),
	'L_CLOSE_WINDOW' => $lang['Close_window'],
	)
);

//
// pied de page
//
$template->pparse('body');
include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>