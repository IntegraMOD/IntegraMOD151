<?php
/***************************************************************************
 *                          blocks_imp_shoutbox.php
 *                            -------------------
 *   begin                : Monday, May 03, 2004
 *   copyright            : (C) 2004 masterdavid - Ronald John David
 *   website              : http://www.integramod.com
 *   email                : webmaster@integramod.com
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

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

if(!function_exists('imp_shoutbox_block_func'))
{
	function imp_shoutbox_block_func()
	{
		global $template, $phpEx;

		$template->assign_vars(array(
			'U_SHOUTBOX' => append_sid("shoutbox.$phpEx"),
			)
		);
	}
}

imp_shoutbox_block_func();
?>