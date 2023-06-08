<?php
/***************************************************************************
 *                             cash_exchange.php
 *                            -------------------
 *   begin                : Sunday, Jul 13, 2003
 *   copyright            : (C) 2003 Xore
 *   email                : mods@xore.ca
 *
 *   $Id: cash_exchange.php,v 2.1.0.0 2003/09/18 23:01:30 Xore $
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
define('IN_CASHMOD', 1);

//
// Load default header
//
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
include($phpbb_root_path . 'includes/functions_admin.'.$phpEx);

if ( $board_config['cash_adminnavbar'] )
{
	$navbar = 1;
	include('./admin_cash.'.$phpEx);
}

?>