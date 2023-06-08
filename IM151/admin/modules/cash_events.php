<?php
/***************************************************************************
 *                              cash_events.php
 *                            -------------------
 *   begin                : Thursday, Sep 18, 2003
 *   copyright            : (C) 2003 Xore
 *   email                : mods@xore.ca
 *
 *   $Id: cash_events.php,v 1.0.2.0 2003/10/07 22:37:54 Xore $
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
define('IN_CASHMOD', 1);

if ( $board_config['cash_adminnavbar'] )
{
	$navbar = 1;
	include('./admin_cash.'.$phpEx);
}

?>