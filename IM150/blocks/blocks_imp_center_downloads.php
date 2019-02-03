<?php
/***************************************************************************
 *                        blocks_imp_center_downloads.php
 *                            -------------------
 *   begin                : Thursday, May 6, 2004
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

if(!function_exists('imp_center_downloads_block_func'))
{
	function imp_center_downloads_block_func()
	{
		global $template, $portal_config, $table_prefix, $phpEx, $db, $lang, $board_config, $theme;

		$sql = "SELECT *
			FROM " . $table_prefix."pa_files
			ORDER BY file_dls DESC
			LIMIT 0," . $portal_config['md_num_top_downloads'];
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not query database for the most downloads');
		} 

		$i = 1;
		while ($file_most = $db->sql_fetchrow($result)) 
		{   
			$row_class = ( !($i % 2) ) ? 'row1': 'row2';
			$template->assign_block_vars('dlrow', array(
				'NUMBER_MOST' => strval($i),
				'ROW_CLASS' => $row_class,
				'FILELINK_MOST' => append_sid("dload." . $phpEx . "?action=file&file_id=" . $file_most['file_id']),
				'FILENAME_MOST' => $file_most['file_name'],
				'DESCRIP_MOST' => $file_most['file_desc'],
				'INFO_MOST' => $file_most['file_dls'] . ' ' . $lang['Dls'])
			);
				
			$i++;
		}

		$sql = "SELECT *
			FROM " . $table_prefix."pa_files
			ORDER BY file_time DESC
			LIMIT 0," . $portal_config['md_num_new_downloads'];
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not query database for the most downloads');
		} 

		$i = 1;
		while ($file_latest = $db->sql_fetchrow($result)) 
		{   
			$row_class = ( !($i % 2) ) ? 'row1': 'row2';
			$template->assign_block_vars('dlrow2', array(
				'NUMBER_LATEST' => strval($i),
				'FILELINK_LATEST' => append_sid("dload." . $phpEx . "?action=file&file_id=" . $file_latest['file_id']),
				'ROW_CLASS' => $row_class,
				'FILENAME_LATEST' => $file_latest['file_name'],
				'DESCRIP_LATEST' => $file_latest['file_desc'],
				'INFO_LATEST' => create_date($board_config['default_dateformat'], $file_latest['file_time'], $board_config['board_timezone']))
			);
				
			$i++;
		}

		$template->assign_vars(array(
			'TOP_DOWNLOADS' => $lang['Top_downloads'],
			'NEW_DOWNLOADS' => $lang['New_downloads']
		));
	}
}

imp_center_downloads_block_func();
?>