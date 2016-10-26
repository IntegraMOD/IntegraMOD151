<?php
/***************************************************************************
 *                           blocks_imp_links.php
 *                            -------------------
 *   begin                : Saturday, March 20, 2004
 *   copyright            : (C) 2004 dnL - Jason Maloney
 *   website              : http://www.ejdude.com
 *   email                : TheWizard101[at]SBCGlobal[dot]net
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

if(!function_exists(imp_links_block_func))
{
	function imp_links_block_func()
	{
		global $template, $lang, $board_config, $phpbb_root_path, $phpEx, $db, $portal_config, $var_cache;

		//
		// Grab data
		//
		if($portal_config['cache_enabled'])
		{
			$link_config = $var_cache->get('link_config', 86400, 'link');	
		}
		if(!$link_config)
		{
			$sql = "SELECT *
					FROM ". LINK_CONFIG_TABLE;
			if(!$result = $db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, "Could not query Link config information", "", __LINE__, __FILE__, $sql);
			}
			
			while( $row = $db->sql_fetchrow($result) )
			{
				$link_config[$row['config_name']] = $row['config_value'];
			}

			if($portal_config['cache_enabled'])
			{
				$var_cache->save($link_config, 'link_config', 'link');
			}
		}
		$link_self_img = $link_config['site_logo'];
		$site_logo_height = $link_config['height'];
		$site_logo_width = $link_config['width'];
		$display_interval = $link_config['display_interval'];
		$display_logo_num = $link_config['display_logo_num'];

		$sql = "SELECT link_id, link_title, link_logo_src
			FROM " . LINKS_TABLE . "
			WHERE link_active = 1
			AND link_logo_src <> '' 
			ORDER BY RAND()
			LIMIT ". $display_logo_num;

		if($portal_config['md_links_style'])
		{
			$style_row = 'links_scroll';
		}
		else
		{
			$style_row = 'links_static';
		}

		if($portal_config['md_links_own1'])
		{
			$template->assign_block_vars('links_own1',array());
		}
		if($portal_config['md_links_own2'])
		{
			$template->assign_block_vars('links_own2',array());
		}
		if($portal_config['md_links_code'])
		{
			$template->assign_block_vars('links_code',array());
		}

		$template->assign_block_vars($style_row,array());

		$template->assign_vars(array(
			'SITE_LOGO_WIDTH' => $site_logo_width,
			'SITE_LOGO_HEIGHT' => $site_logo_height,
			'U_SITE_LOGO' => $link_config['site_logo']
			)
		);

		// If failed just ignore
		if( $result = $db->sql_query($sql) )
		{
			while($row = $db->sql_fetchrow($result))
			{
				//if (empty($row['link_logo_src'])) $row['link_logo_src'] = 'images/links/no_logo88a.gif';
				if ($row['link_logo_src'])
				{
					$template->assign_block_vars($style_row.'.links_row', array(
						'LINK_HREF' => 'links.'.$phpEx.'?action=go&link_id='.$row['link_id'],
						'LINK_LOGO_SRC' => $row['link_logo_src'],
						'LINK_TITLE' => $row['link_title'])
					);
				}
			}
		}
	}
}

imp_links_block_func();
?>
