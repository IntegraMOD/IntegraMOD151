<?php
/***************************************************************************
 *                         blocks_imp_newest_pic.php
 *                            -------------------
 *   begin                : Saturday, March 20, 2004
 *   copyright            : (C) 2004 masterdavid - Ronald John David
 *   website              : http://phpbbintegramod.sourceforge.net
 *   email                : masterdavid@users.sourceforge.net
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

if(!function_exists(imp_newest_pic_block_func))
{
	function imp_newest_pic_block_func()
	{
		global $template, $table_prefix, $db, $lang, $phpEx, $board_config;

		$sql = "SELECT pic_id, pic_title, pic_username, pic_time FROM " .$table_prefix. "album WHERE pic_approval <> 0 ORDER BY pic_time DESC LIMIT 0,1";
		if (!$result = $db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Could not query album information', '', __LINE__, __FILE__, $sql);
		}

		$picrow = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);
		if($picrow['pic_id'] > 0){
			$template->assign_block_vars('newest_pic', array());
		$template->assign_vars(array(
			'L_NEWEST_PIC' => $lang['Newest_pic'],
			'L_BY' => $lang['By'],
			'PIC_IMAGE' => append_sid('album_thumbnail.'. $phpEx . '?pic_id=' . $picrow['pic_id']),
			'PIC_TITLE' => $picrow['pic_title'],
			'PIC_POSTER' => $picrow['pic_username'],
			'U_PIC_LINK' => append_sid('album_showpage.' . $phpEx . '?pic_id=' . $picrow['pic_id']),
			'PIC_TIME' => create_date($board_config['default_dateformat'], $picrow['pic_time'], $board_config['board_timezone'])
			)
		);
		} else {
			$template->assign_block_vars('no_pic', array());
			$template->assign_vars(array(
				'L_NO_PICS' => $lang['No_Pics3'],
				)
			);
		}
	}
}

imp_newest_pic_block_func();
?>