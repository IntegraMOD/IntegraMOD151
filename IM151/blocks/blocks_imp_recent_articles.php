<?php
/***************************************************************************
 *                         blocks_imp_recent_articles.php
 *                            -------------------
 *   begin                : Monday, May 31, 2004
 *   copyright            : (C) 2004 CrX Games - Cody James Mays
 *   website              : http://www.crxgames.com
 *   email                : crxgames@yahoo.com.com
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
define('MXBB_MODULE', 0);

if(!function_exists('imp_recent_articles_func'))
{
	function imp_recent_articles_func()
	{
		/*****************************************************
		* KB Tables                                         */
		/*////////////////////////////////////////////////////
		'KB_ARTICLES_TABLE'
		'KB_CATEGORIES_TABLE'
		'KB_CONFIG_TABLE'
		'KB_TYPES_TABLE'
		'KB_WORD_TABLE'
		'KB_SEARCH_TABLE'
		'KB_MATCH_TABLE'*/
		///////////////////////////////////////////////////////
		global $lang, $template, $portal_config, $board_config, $db, $phpbb_root_path, $table_prefix, $phpEx;
		include_once($phpbb_root_path. 'includes/kb_constants.'.$phpEx);
		
		
		
		$sql = "SELECT * FROM " 
		. KB_ARTICLES_TABLE . "
		ORDER BY article_id DESC LIMIT ". $portal_config['cm_total_articles'];
					/*$sql = 'SELECT *
		FROM ' . KB_ARTICLES_TABLE . '
		WHERE article_id';*/
		
		if( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not query users', '', __LINE__, __FILE__, $sql);
		}

		//now lets get our info
		while ( $row = $db->sql_fetchrow($result) )
		{
			$title = $row['article_title'];
			$article_category_id = $row['article_id'];	
			$url = append_sid($phpbb_root_path . "kb.$phpEx?mode=article&amp;k=$article_category_id");

			$template->assign_block_vars('recent_articles', array(
				'TITLE' => $title,
				'U_ARTICLE' => $url
			));
		}
	}
}

//call the function to output the block.
imp_recent_articles_func();

?>