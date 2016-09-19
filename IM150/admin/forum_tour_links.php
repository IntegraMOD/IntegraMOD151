<?php
/***************************************************************************
*                             forum_tour_links.php
*                              -------------------
*     copyright            : (C) 2004 OXPUS
*     email                : webmaster@oxpus.de
*
****************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

define('IN_PHPBB', 1);

//
// Load default header
//
$no_page_header = TRUE;
$phpbb_root_path = './../';
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

$page_title =  $lang['Forum_tour'];

include('./page_header_admin.'.$phpEx);

$sql = "SELECT cat_id, cat_title, cat_order
	FROM " . CATEGORIES_TABLE . "
	ORDER BY cat_order";
if( !$q_categories = $db->sql_query($sql) )
{
	message_die(GENERAL_ERROR, "Could not query categories list", "", __LINE__, __FILE__, $sql);
}

if( $total_categories = $db->sql_numrows($q_categories) ) 
{
	$category_rows = $db->sql_fetchrowset($q_categories);

	$sql = "SELECT *
		FROM " . FORUMS_TABLE . "
		ORDER BY cat_id, forum_order";
	if(!$q_forums = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, "Could not query forums information", "", __LINE__, __FILE__, $sql);
	}

	if( $total_forums = $db->sql_numrows($q_forums) )
	{
		$forum_rows = $db->sql_fetchrowset($q_forums);
	}

	//
	// Okay, let's build the index
	//
	$gen_cat = array();

	$template->set_filenames(array(
		'body' => 'admin/forum_tour_links_body.tpl')
	);

	for($i = 0; $i < $total_categories; $i++)
	{
		$cat_id = $category_rows[$i]['cat_id'];

		$template->assign_block_vars("catrow", array( 
			'CAT_NAME' => $category_rows[$i]['cat_title'],
			'CAT_DESC' => '[url=http://'.$board_config['server_name'].$board_config['script_path'].'index.'.$phpEx.'?c='.$cat_id.']'.$category_rows[$i]['cat_title'].'[/url]')
		);

		for($j = 0; $j < $total_forums; $j++)
		{
			$forum_id = $forum_rows[$j]['forum_id'];
			
			if ($forum_rows[$j]['cat_id'] == $cat_id)
			{
				$template->assign_block_vars("catrow.forumrow",	array(
					'SUBJECT' => $forum_rows[$j]['forum_name'],
					'U_FORUM_LINK' => '[url=http://'.$board_config['server_name'].$board_config['script_path'].'viewforum.'.$phpEx.'?f='.$forum_id.']'.$forum_rows[$j]['forum_name'].'[/url]',
					'ROW_CLASS' => $theme['td_class1'])
				);
			}// if ... forumid == catid
			
		} // for ... forums

	} // for ... categories

}// if ... total_categories

$template->pparse('body');

include('./page_footer_admin.'.$phpEx);

?>