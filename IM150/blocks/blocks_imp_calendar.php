<?php
/***************************************************************************
 *                          blocks_imp_calendar.php
 *                            -------------------
 *   begin                : Saturday, March 20, 2004
 *   copyright            : (C) 2004 masterdavid - Ronald John David
 *   website              : http://www.integramod.com
 *   email                : webmaster@integramod.com
 *
 *   note: removing the original copyright is illegal even you have modified
 *         the code.  Just append yours if you have modified it.
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

if(!function_exists(imp_calendar_block_func))
{
	function imp_calendar_block_func()
	{
		global $phpbb_root_path, $phpEx, $template, $images, $board_config, $userdata, $_GET, $_POST, $db;
		include($phpbb_root_path . 'mods/netclectic/mini_cal/mini_cal2.'.$phpEx);
	}
}

imp_calendar_block_func();
?>