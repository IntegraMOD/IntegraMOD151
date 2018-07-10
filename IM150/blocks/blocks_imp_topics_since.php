<?php
/***************************************************************************
 *                         blocks_imp_topics_since.php
 *                            -------------------
 *   begin                : Saturday, december 04, 2004
 *   copyright            : (C) 2004 Edwin Bekaert
 *   website              : http://gandadev.korfballers.be
 *   email                : edwin@ednique.com
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

if(!function_exists('imp_topics_since_block_func'))
{
	function imp_topics_since_block_func()
	{
		global $template, $lang, $db, $theme, $phpEx, $lang, $board_config, $userdata, $phpbb_root_path, $table_prefix, $portal_config, $var_cache, $_POST, $_GET;

	include_once($phpbb_root_path . 'includes/functions_topics_list.' . $phpEx);
	$process = 'pre';
	$view_userdata = $userdata;
	include($phpbb_root_path . 'profilcp/profilcp_home_last_topics.' . $phpEx);
	$process = 'post';
	include($phpbb_root_path . 'profilcp/profilcp_home_last_topics.' . $phpEx);
	$template->assign_vars(array(
	'S_HIDDEN_FIELDS'		=> $s_hidden_fields,
	'S_PROFILCP_ACTION'		=> append_sid("./portal.$phpEx"),
	));
	}
}

imp_topics_since_block_func();


?>
