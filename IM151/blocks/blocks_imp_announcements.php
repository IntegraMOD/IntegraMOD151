<?php
/***************************************************************************
 *                           blocks_imp_announcements.php
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

if(!function_exists('imp_announcements_block_func'))
{
	function imp_announcements_block_func()
	{
		global $phpbb_root_path, $template, $phpEx, $lang, $portal_config,$_GET;

		include_once($phpbb_root_path . 'fetchposts.'.$phpEx);

		$template->assign_vars(array(
			'L_COMMENTS' => $lang['Comments'],
			'L_VIEW_COMMENTS' => $lang['View_comments'],
			'L_POST_COMMENT' => $lang['Post_your_comment'],
			'L_POSTED' => $lang['Posted'],
			'L_ANNOUNCEMENT' => $lang['Post_Announcement']
			)
		);

		//
		// Fetch Posts from Announcements Forum
		//
		if(!isset($_GET['article']))
		{
			$template->assign_block_vars('welcome_text', array());

			$fetchposts = phpbb_fetch_posts($portal_config['md_announcements_forum_id'], $portal_config['md_num_announcements'], $portal_config['md_announcements_length']);

			for ($i = 0; $i < count($fetchposts); $i++)
			{
				if( $fetchposts[$i]['striped'] == 1 )
				{
					$open_bracket = '[ ';
					$close_bracket = ' ]';
					$read_full = $lang['Read_Full'];
				}
				else
				{
					$open_bracket = '';
					$close_bracket = '';
					$read_full = '';
				}

				$template->assign_block_vars('fetchpost_row', array(
					'TITLE' => $fetchposts[$i]['topic_title'],
					'POSTER' => $fetchposts[$i]['username'],
					'TIME' => $fetchposts[$i]['topic_time'],
					'TEXT' => $fetchposts[$i]['post_text'],
					'REPLIES' => $fetchposts[$i]['topic_replies'],
					'U_VIEW_COMMENTS' => append_sid('viewtopic.' . $phpEx . '?t=' . $fetchposts[$i]['topic_id']),
					'U_POST_COMMENT' => append_sid('posting.' . $phpEx . '?mode=reply&amp;t=' . $fetchposts[$i]['topic_id']),
					'U_READ_FULL' => append_sid('portal.' . $phpEx . '?article=' . $i),
					'L_READ_FULL' => $read_full,
					'OPEN' => $open_bracket,
					'CLOSE' => $close_bracket)
				);
			}
		}
		else
		{
			$fetchposts = phpbb_fetch_posts($portal_config['md_announcements_forum_id'],  $portal_config['md_num_announcements'], 0);

			$i = intval($_GET['article']);

			$template->assign_block_vars('fetchpost_row', array(
				'TITLE' => $fetchposts[$i]['topic_title'],
				'POSTER' => $fetchposts[$i]['username'],
				'TIME' => $fetchposts[$i]['topic_time'],
				'TEXT' => $fetchposts[$i]['post_text'],
				'REPLIES' => $fetchposts[$i]['topic_replies'],
				'U_VIEW_COMMENTS' => append_sid('viewtopic.' . $phpEx . '?t=' . $fetchposts[$i]['topic_id']),
				'U_POST_COMMENT' => append_sid('posting.' . $phpEx . '?mode=reply&amp;t=' . $fetchposts[$i]['topic_id'])
				)
			);
		}
		//
		// END: Fetch Announcements
		//
	}
}

imp_announcements_block_func();
?>