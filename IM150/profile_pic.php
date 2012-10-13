<?php
/***************************************************************************
 *                           profile_pic.php
 *                           ---------------
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
$userdata = session_pagestart($user_ip, PAGE_REGISTER);
init_userprefs($userdata);
//
// End session management
//
$key = isset($HTTP_GET_VARS['l']) ?  intval($HTTP_GET_VARS['l']) : 0;
$letter = $userdata['session_robot'][$key];
if (file_exists( phpbb_realpath( $images['alphabet_' . $letter] ) ))
{
	header("Expires: " . gmdate( "D, d M Y H:i:s", time()-3600*24 ) . " GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");
	header('Content-type: image/gif');
	readfile( phpbb_realpath($images['alphabet_' . $letter] ) );
}

?>