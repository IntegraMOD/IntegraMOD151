<?php
/***************************************************************************
 *                        blocks_imp_security_block.php
 *                            -------------------
 *   begin                : Saturday, March 20, 2004
 *   copyright            : (C) 2005 Wekke
 *   website              : http://www.integramod.com
 *   email                : wekke@integramod.com
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

if(!function_exists('imp_security_block_func'))
{
	function imp_security_block_func()
	{
		global $template, $lang, $board_config;
		$template->assign_vars(array(
			'BLOCKED'	=> str_replace('%T%', ''. number_format($board_config['phpBBSecurity_total_attempts']) .'', $lang['PS_blocked_line']),
			)
		);
	}
}

imp_security_block_func();
?>