<?php
/***************************************************************************
 *                            functions_admin.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 *
 ***************************************************************************/

//
// Simple version of jumpbox, just lists authed forums
//
function make_forum_select($box_name, $ignore_forum = false, $select_forum = '')
{
	global $db, $userdata, $lang;

	$is_auth_ary = auth(AUTH_READ, AUTH_LIST_ALL, $userdata);

	$sql = 'SELECT f.forum_id, f.forum_name
		FROM ' . CATEGORIES_TABLE . ' c, ' . FORUMS_TABLE . ' f
		WHERE f.cat_id = c.cat_id 
		ORDER BY c.cat_order, f.forum_order';
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Couldn not obtain forums information', '', __LINE__, __FILE__, $sql);
	}

	$forum_list = '';
	while( $row = $db->sql_fetchrow($result) )
	{
		if ( $is_auth_ary[$row['forum_id']]['auth_read'] && $ignore_forum != $row['forum_id'] )
		{
			$selected = ( $select_forum == $row['forum_id'] ) ? ' selected="selected"' : '';
			$forum_list .= '<option value="' . $row['forum_id'] . '"' . $selected .'>' . $row['forum_name'] . '</option>';
		}
	}

	$forum_list = ( $forum_list == '' ) ? $lang['No_forums'] : '<select name="' . $box_name . '">' . $forum_list . '</select>';

	return $forum_list;
}

//
// Synchronise functions for forums/topics
//
function sync($type, $id = false)
{
	global $db;

	switch($type)
	{
		case 'all forums':
			$sql = "SELECT forum_id
				FROM " . FORUMS_TABLE;
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not get forum IDs', '', __LINE__, __FILE__, $sql);
			}

			while( $row = $db->sql_fetchrow($result) )
			{
				sync('forum', $row['forum_id']);
			}
		   	break;

		case 'all topics':
			$sql = "SELECT topic_id
				FROM " . TOPICS_TABLE;
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not get topic ID', '', __LINE__, __FILE__, $sql);
			}

			while( $row = $db->sql_fetchrow($result) )
			{
				sync('topic', $row['topic_id']);
			}
			break;

	  	case 'forum':
			$sql = "SELECT MAX(post_id) AS last_post, COUNT(post_id) AS total 
				FROM " . POSTS_TABLE . "  
				WHERE forum_id = $id";
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not get post ID', '', __LINE__, __FILE__, $sql);
			}

			if ( $row = $db->sql_fetchrow($result) )
			{
				$last_post = ( $row['last_post'] ) ? $row['last_post'] : 0;
				$total_posts = ($row['total']) ? $row['total'] : 0;
			}
			else
			{
				$last_post = 0;
				$total_posts = 0;
			}

			$sql = "SELECT COUNT(topic_id) AS total
				FROM " . TOPICS_TABLE . "
				WHERE forum_id = $id";
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not get topic count', '', __LINE__, __FILE__, $sql);
			}

			$total_topics = ( $row = $db->sql_fetchrow($result) ) ? ( ( $row['total'] ) ? $row['total'] : 0 ) : 0;

			$sql = "UPDATE " . FORUMS_TABLE . "
				SET forum_last_post_id = $last_post, forum_posts = $total_posts, forum_topics = $total_topics
				WHERE forum_id = $id";
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not update forum', '', __LINE__, __FILE__, $sql);
			}
			break;

		case 'topic':
			$sql = "SELECT MAX(post_id) AS last_post, MIN(post_id) AS first_post, COUNT(post_id) AS total_posts
				FROM " . POSTS_TABLE . "
				WHERE topic_id = $id";
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not get post ID', '', __LINE__, __FILE__, $sql);
			}

			if ( $row = $db->sql_fetchrow($result) )
			{
				if ($row['total_posts'])
				{
					// Correct the details of this topic
					$sql = 'UPDATE ' . TOPICS_TABLE . ' 
						SET topic_replies = ' . ($row['total_posts'] - 1) . ', topic_first_post_id = ' . $row['first_post'] . ', topic_last_post_id = ' . $row['last_post'] . "
						WHERE topic_id = $id";

					if (!$db->sql_query($sql))
					{
						message_die(GENERAL_ERROR, 'Could not update topic', '', __LINE__, __FILE__, $sql);
					}
				}
				else
				{
					// There are no replies to this topic
					// Check if it is a move stub
					$sql = 'SELECT topic_moved_id 
						FROM ' . TOPICS_TABLE . " 
						WHERE topic_id = $id";

					if (!($result = $db->sql_query($sql)))
					{
						message_die(GENERAL_ERROR, 'Could not get topic ID', '', __LINE__, __FILE__, $sql);
					}

					if ($row = $db->sql_fetchrow($result))
					{
						if (!$row['topic_moved_id'])
						{
							$sql = 'DELETE FROM ' . TOPICS_TABLE . " WHERE topic_id = $id";
			
							if (!$db->sql_query($sql))
							{
								message_die(GENERAL_ERROR, 'Could not remove topic', '', __LINE__, __FILE__, $sql);
							}
						}
					}

					$db->sql_freeresult($result);
				}
			}
			attachment_sync_topic($id);
			break;
	}

if (!function_exists('bbcode_box'))
{
function bbcode_box()
{
	global $template, $board_config, $phpbb_root_path, $phpEx;
	include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_bbcode_box.' . $phpEx);

	$template->set_filenames(array(
		'bbcode_box' => $current_template_path . 'bbcode_box.tpl')
	);

	$template->assign_vars(array(
		'L_ROOT' => $phpbb_root_path,
		'L_BBCODE_RTL_HELP' => $lang['bbcode_rtl_help'],
		'L_BBCODE_LTR_HELP' => $lang['bbcode_ltr_help'],
		'L_BBCODE_PLAIN_HELP' => $lang['bbcode_plain_help'],
		'L_BBCODE_FC_HELP' => $lang['bbcode_fc_help'],
		'L_BBCODE_FS_HELP' => $lang['bbcode_fs_help'],
		'L_BBCODE_FT_HELP' => $lang['bbcode_ft_help'],
		'L_BBCODE_RIGHT_HELP' => $lang['bbcode_right_help'],
		'L_BBCODE_LEFT_HELP' => $lang['bbcode_left_help'],
		'L_BBCODE_CENTER_HELP' => $lang['bbcode_center_help'],
		'L_BBCODE_JUSTIFY_HELP' => $lang['bbcode_justify_help'],
		'L_BBCODE_B_HELP' => $lang['bbcode_b_help'],
		'L_BBCODE_I_HELP' => $lang['bbcode_i_help'],
		'L_BBCODE_U_HELP' => $lang['bbcode_u_help'],
		'L_BBCODE_STRIKE_HELP' => $lang['bbcode_strike_help'],
		'L_BBCODE_SUP_HELP' => $lang['bbcode_sup_help'],
		'L_BBCODE_SUB_HELP' => $lang['bbcode_sub_help'],
		'L_BBCODE_GRAD_HELP' => $lang['bbcode_grad_help'],
		'L_BBCODE_FADE_HELP' => $lang['bbcode_fade_help'],
		'L_BBCODE_LIST_HELP' => $lang['bbcode_list_help'],
		'L_BBCODE_MARQR_HELP' => $lang['bbcode_marqr_help'],
		'L_BBCODE_MARQL_HELP' => $lang['bbcode_marql_help'],
		'L_BBCODE_MARQU_HELP' => $lang['bbcode_marqu_help'],
		'L_BBCODE_MARQD_HELP' => $lang['bbcode_marqd_help'],
		'L_BBCODE_QUOTE_HELP' => $lang['bbcode_quote_help'],
		'L_BBCODE_CODE_HELP' => $lang['bbcode_code_help'],
		'L_BBCODE_PHP_HELP' => $lang['bbcode_php_help'],
		'L_BBCODE_SPOIL_HELP' => $lang['bbcode_spoil_help'],
		'L_BBCODE_ANCHOR_HELP' => $lang['bbcode_anchor_help'],
		'L_BBCODE_URL_HELP' => $lang['bbcode_url_help'],
		'L_BBCODE_YOUTUBE_HELP' => $lang['bbcode_youtube_help'],
		'L_BBCODE_MAIL_HELP' => $lang['bbcode_mail_help'],
		'L_BBCODE_GOTOPOST_HELP' => $lang['bbcode_goto_help'],
		'L_BBCODE_IMG_HELP' => $lang['bbcode_img_help'],
		'L_BBCODE_STREAM_HELP' => $lang['bbcode_stream_help'],
		'L_BBCODE_RAM_HELP' => $lang['bbcode_ram_help'],
		'L_BBCODE_WEB_HELP' => $lang['bbcode_web_help'],
		'L_BBCODE_VIDEO_HELP' => $lang['bbcode_video_help'],
		'L_BBCODE_FLASH_HELP' => $lang['bbcode_flash_help'],
		'L_BBCODE_SPELL_HELP' => $lang['bbcode_spell_help'],
		'L_BBCODE_HR_HELP' => $lang['bbcode_hr_help'],
		'L_BBCODE_YOU_HELP' => $lang['bbcode_you_help'],
		'L_BBCODE_TAB_HELP' => $lang['bbcode_tab_help'],
		'L_BBCODE_NBSP_HELP' => $lang['bbcode_nbsp_help'],
		'L_BBCODE_SEARCH_HELP' => $lang['bbcode_search_help'],
		'L_BBCODE_GOOGLE_HELP' => $lang['bbcode_google_help'],
		'L_BBCODE_TABLE_HELP' => $lang['bbcode_table_help'],
		'L_BBCODE_TIP_HELP' => $lang['bbcode_tip_help'],

		'L_BBCODE_TYPE_MESSAGE' => $lang['bbcode_type_message'],
		'L_BBCODE_CONFIRM' => $lang['bbcode_confirm'],
		'L_BBCODE_SELECT' => $lang['bbcode_select_text'],
		'L_BBCODE_LESS_120' => $lang['bbcode_less_120'],
		'L_BBCODE_NOT_AVAILABLE' => $lang['bbcode_not_available'],
		'L_BBCODE_LIST_BOX' => $lang['bbcode_list_box'],
		'L_BBCODE_LISTBOX_OPTIONS' => $lang['bbcode_listbox_options'],
		'L_BBCODE_LISTBOX_ITEM' => $lang['bbcode_listbox_item'],
		'L_BBCODE_NO_LISTBOX_ITEM' => $lang['bbcode_no_listbox_item'],
		'L_BBCODE_ANCHORNAME' => $lang['bbcode_anchorname'],
		'L_BBCODE_NO_ANCHORNAME' => $lang['bbcode_no_anchorname'],
		'L_BBCODE_BAD_ANCHORNAME' => $lang['bbcode_bad_anchorname'],
		'L_BBCODE_NO_URL' => $lang['bbcode_enter_url'],
		'L_BBCODE_ENTER_URL' => $lang['bbcode_no_url'],
		'L_BBCODE_ENTER_PAGENAME' => $lang['bbcode_enter_pagename'],
		'L_BBCODE_NO_PAGENAME' => $lang['bbcode_no_pagename'],
		'L_BBCODE_ENTER_YOUTUBE' => $lang['bbcode_enter_youtube'],
		'L_BBCODE_NO_YOUTUBE' => $lang['bbcode_no_youtube'],
		'L_BBCODE_ENTER_EMAIL' => $lang['bbcode_enter_email'],
		'L_BBCODE_NO_EMAIL' => $lang['bbcode_no_email'],
		'L_BBCODE_POSTNUMBER' => $lang['bbcode_postnumber'],
		'L_BBCODE_NO_POSTNUMBER' => $lang['bbcode_no_postnumber'],
		'L_BBCODE_ANCHORNAME2' => $lang['bbcode_anchorname2'],
		'L_BBCODE_ENTER_SEARCHTEXT' => $lang['bbcode_enter_searchtext'],
		'L_BBCODE_NO_SEARCHTEXT' => $lang['bbcode_no_searchtext'],

		)
	);

	$template->assign_var_from_handle('JAVASCRIPT_BBCODE_BOX', 'bbcode_box');

}
//-- mod : cache -----------------------------------------------------------------------------------
//-- add
	global $board_config;
	board_stats();
	cache_tree(true);
//-- fin mod : categories hierarchy ----------------------------------------------------------------
	
	return true;
}
}

?>
