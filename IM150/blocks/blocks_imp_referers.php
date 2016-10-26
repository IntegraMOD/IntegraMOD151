<?php
/***************************************************************************
 *                           blocks_imp_referers.php
 *                            -------------------
 *   begin                : Thursday May 26, 2005
 *   copyright            : (C) 2005 Cody Mays (crxgames)
 *   website              : http://www.crxgames.com & http://www.codymays.net
 *   email                : crxgames@gmail.com
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

if(!function_exists(imp_referers_block_func))
{
	function imp_referers_block_func()
	{
		global $template, $db, $portal_config;
		
		$sql = "SELECT COUNT(DISTINCT referer_host) AS count 
			FROM " . REFERERS_TABLE;
		if(!$result = $db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, "Could not query referers table", "Error", __LINE__, __FILE__, $sql);
		}
		$total_referers = (int)$db->sql_fetchfield("count", 0, $result);		
		
		// Query referer info...
		$sql = "SELECT DISTINCT referer_host, SUM(referer_hits) AS referer_hits, MIN(referer_firstvisit) AS referer_firstvisit, MAX(referer_lastvisit) AS referer_lastvisit 
			FROM " . REFERERS_TABLE . " 
			GROUP BY referer_host 
			ORDER BY " . $portal_config['md_sort_referers'];
		if($portal_config['md_num_referers']){
			$sql .= " LIMIT	0,".$portal_config['md_num_referers'];
		}
		if(!$result = $db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Could not obtain HTTP referrers', '', __LINE__, __FILE__, $sql);
		}

		$i = 0;
		while( $row = $db->sql_fetchrow($result) )
		{
			//2nd column
			if($i >= $total_referers/2)
			{
				$template->assign_block_vars('linkrow2', array( 
					'U_REF_LINK' => 'http://'.$row['referer_host'], 
					'LINK_TEXT' => 'http://'.$row['referer_host']) 
				);
			}
			else //1st column
			{
				$template->assign_block_vars('linkrow1', array( 
					'U_REF_LINK' => 'http://'.$row['referer_host'], 
					'LINK_TEXT' => 'http://'.$row['referer_host']) 
				);
			}
			$i++;
		} 
	}
}
imp_referers_block_func();
?>
