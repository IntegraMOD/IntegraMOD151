<?php
/***************************************************************************
 *                          album_personal.php
 *                          ------------------------------------------------
 *     begin                : Friday, June 12, 2004
 *     copyright            : (C) 2004 IdleVoid
 *     email                : idlevoid@slater.dk
 *     file version         : 1.0.8
 *     release              : 1.2.0
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
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

// Start session management
$userdata = session_pagestart($user_ip, PAGE_ALBUM);
init_userprefs($userdata);
// End session management

	redirect (append_sid("album.$phpEx?user_id=" . $userdata['user_id']));

?>