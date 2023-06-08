<?php
/***************************************************************************
 *                                functions_comments.php
 *                            -------------------
 *   begin                : Sunday, July 27, 2003
 *   copyright            : (C) 2003 Mohd
 *   email                : mohd@mohd.tk
 *
 *   $Id: index.php,v 1.99.2.1 2002/12/19 17:17:40 psotfx Exp $
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
 ***************************************************************************/

function display_comments(&$file_data)
{
	global $pafiledb_template, $lang, $board_config, $phpEx, $pafiledb_config, $db, $images;
	global $_REQUEST, $phpbb_root_path, $userdata, $db, $pafiledb, $pafiledb_functions;
	include_once($phpbb_root_path . 'includes/bbcode.'.$phpEx);

	//
	// Define censored word matches
	//

	$orig_word = array();
	$replacement_word = array();
	obtain_word_list($orig_word, $replacement_word);

	$pafiledb_template->assign_vars(array(
		'L_COMMENTS' => $lang['Comments']) 
	);

	$sql = 'SELECT c.*, u.*
		FROM ' . PA_COMMENTS_TABLE . ' AS c 
			LEFT JOIN ' . USERS_TABLE . " AS u ON c.poster_id = u.user_id
		WHERE c.file_id = '" . $file_data['file_id'] . "'
		ORDER BY c.comments_time ASC";

	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Couldnt select comments', '', __LINE__, __FILE__, $sql);
	}

	if (!($comment_number = $db->sql_numrows($result)))
	{
		$pafiledb_template->assign_vars(array(
			'L_NO_COMMENTS' => $lang['No_comments'],
			'NO_COMMENTS' => TRUE) 
		);
	}

	$ranksrow = array();
	$pafiledb_functions->obtain_ranks($ranksrow);

	while ($comments_row = $db->sql_fetchrow($result)) 
	{     
		$time = create_date($board_config['default_dateformat'], $comments_row['comments_time'], $board_config['board_timezone']);

		$comments_text = $comments_row['comments_text'];

		if ( !$pafiledb_config['allow_html'] )
		{
			if ( $comments_text != '' && $userdata['user_allowhtml'] )
			{
				$comments_text = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $comments_text);
			}
		}

		if ( $pafiledb_config['allow_bbcode'] )
		{
			if ( $comments_text != '' && $comments_row['comment_bbcode_uid'] != '' )
			{
				$comments_text = ( $pafiledb_config['allow_bbcode'] ) ? bbencode_second_pass($comments_text, $comments_row['comment_bbcode_uid']) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $comments_text);
			}    
		}

		$comments_text = comment_suite($comments_text);

		$comments_text = make_clickable($comments_text);

	   	if ( count($orig_word) )
		{
			if ( $comments_text != '' )
			{
				$comments_text = preg_replace($orig_word, $replacement_word, $comments_text);
			}
		}

		if ( $pafiledb_config['allow_smilies'] )
		{
			if ( $userdata['user_allowsmile'] && $comments_text != '' )
			{
				$comments_text = smilies_pass($comments_text);
			}
		}

		$poster = ( $comments_row['user_id'] == ANONYMOUS ) ? $lang['Guest'] : $comments_row['username'];

		$poster_posts = ( $comments_row['user_id'] != ANONYMOUS ) ? $lang['Posts'] . ': ' . $comments_row['user_posts'] : '';

		$poster_from = ( $comments_row['user_from'] && $comments_row['user_id'] != ANONYMOUS ) ? $lang['Location'] . ': ' . $comments_row['user_from'] : '';

		$poster_joined = ( $comments_row['user_id'] != ANONYMOUS ) ? $lang['Joined'] . ': ' . create_date($lang['DATE_FORMAT'], $comments_row['user_regdate'], $board_config['board_timezone']) : '';

		$poster_avatar = '';
		if ( $comments_row['user_avatar_type'] && $poster_id != ANONYMOUS && $comments_row['user_allowavatar'] )
		{
			switch( $comments_row['user_avatar_type'] )
			{
				case USER_AVATAR_UPLOAD:
					$poster_avatar = ( $board_config['allow_avatar_upload'] ) ? '<img src="' . $board_config['avatar_path'] . '/' . $comments_row['user_avatar'] . '" alt="" border="0" />' : '';
					break;
				case USER_AVATAR_REMOTE:
					$poster_avatar = ( $board_config['allow_avatar_remote'] ) ? '<img src="' . $comments_row['user_avatar'] . '" alt="" border="0" />' : '';
					break;
				case USER_AVATAR_GALLERY:
					$poster_avatar = ( $board_config['allow_avatar_local'] ) ? '<img src="' . $board_config['avatar_gallery_path'] . '/' . $comments_row['user_avatar'] . '" alt="" border="0" />' : '';
					break;
			}
		}
 
		//
		// Generate ranks, set them to empty string initially.
		//
		$poster_rank = '';
		$rank_image = '';
		if ( $comments_row['user_id'] == ANONYMOUS )
		{
		}
		else if ( $comments_row['user_rank'] )
		{
			for($j = 0; $j < count($ranksrow); $j++)
			{
				if ( $comments_row['user_rank'] == $ranksrow[$j]['rank_id'] && $ranksrow[$j]['rank_special'] )
				{
					$poster_rank = $ranksrow[$j]['rank_title'];
					$rank_image = ( $ranksrow[$j]['rank_image'] ) ? '<img src="' . $ranksrow[$j]['rank_image'] . '" alt="' . $poster_rank . '" title="' . $poster_rank . '" border="0" /><br />' : '';
				}
			}
		}
		else
		{
			for($j = 0; $j < count($ranksrow); $j++)
			{
				if ( $comments_row['user_posts'] >= $ranksrow[$j]['rank_min'] && !$ranksrow[$j]['rank_special'] )
				{
					$poster_rank = $ranksrow[$j]['rank_title'];
					$rank_image = ( $ranksrow[$j]['rank_image'] ) ? '<img src="' . $ranksrow[$j]['rank_image'] . '" alt="' . $poster_rank . '" title="' . $poster_rank . '" border="0" /><br />' : '';
				}
			}
		}

		$comments_text = str_replace("\n", "\n<br />\n", $comments_text);

		$pafiledb_template->assign_block_vars('text', array(
			'POSTER' => $poster,
			'U_COMMENT_DELETE' => ( ($pafiledb->modules[$pafiledb->module_name]->auth[$file_data['file_catid']]['auth_delete_comment'] && $file_info['user_id'] == $userdata['user_id']) || $pafiledb->modules[$pafiledb->module_name]->auth[$file_data['file_catid']]['auth_mod']) ? append_sid("dload.php?action=post_comment&cid={$comments_row['comments_id']}&delete=do&file_id={$file_data['file_id']}") : '',
			'AUTH_COMMENT_DELETE' => ( ($pafiledb->modules[$pafiledb->module_name]->auth[$file_data['file_catid']]['auth_delete_comment'] && $file_info['user_id'] == $userdata['user_id']) || $pafiledb->modules[$pafiledb->module_name]->auth[$file_data['file_catid']]['auth_mod']) ? TRUE : FALSE,
			'DELETE_IMG' => ( ($pafiledb->modules[$pafiledb->module_name]->auth[$file_data['file_catid']]['auth_delete_comment'] && $file_info['user_id'] == $userdata['user_id']) || $pafiledb->modules[$pafiledb->module_name]->auth[$file_data['file_catid']]['auth_mod']) ? $images['icon_delpost'] : '',
			'ICON_MINIPOST_IMG' => $phpbb_root_path . $images['icon_minipost'],
			'ICON_SPACER' => $phpbb_root_path . 'images/spacer.gif',
			'POSTER_RANK' => $poster_rank,
			'RANK_IMAGE' => $rank_image,
			'POSTER_JOINED' => $poster_joined,
			'POSTER_POSTS' => $poster_posts,
			'POSTER_FROM' => $poster_from,
			'POSTER_AVATAR' => $poster_avatar,
			'TITLE' => $comments_row['comments_title'],
			'TIME' => $time,
			'TEXT' => $comments_text) 
		);
	}

	$db->sql_freeresult($result);

	$pafiledb_template->assign_vars(array(
		'REPLY_IMG' => ( $pafiledb->modules[$pafiledb->module_name]->auth[$file_data['file_catid']]['auth_post_comment'] ) ? $images['pa_comment_post'] : '',
		'AUTH_POST' => ( $pafiledb->modules[$pafiledb->module_name]->auth[$file_data['file_catid']]['auth_post_comment'] ) ? TRUE : FALSE,
		'L_COMMENT_DO' => ( $pafiledb->modules[$pafiledb->module_name]->auth[$file_data['file_catid']]['auth_post_comment'] ) ? $lang['Comment_do'] : '',
		'L_COMMENTS' => $lang['Comments'],
		'L_AUTHOR' => $lang['Author'],
		'L_POSTED' => $lang['Posted'],
		'L_COMMENT_SUBJECT' => $lang['Comment_subject'],
		'L_COMMENT_ADD' => $lang['Comment_add'],
		'L_COMMENT_DELETE' => $lang['Comment_delete'],
		'L_COMMENTS_NAME' => $lang['Name'],
		'L_BACK_TO_TOP' => $lang['Back_to_top'],
		'U_COMMENT_DO' => append_sid('dload.php?action=post_comment&file_id='.$file_data['file_id']))
	);
}

function comment_suite($comments_text)
{
	global $pafiledb_config;
	
	// Start Remove images/links in comments text
	if ( $comments_text != '' )
	{	
		if($pafiledb_config['allow_comment_images'] == 0)
		{
			$no_image_message = $pafiledb_config['no_comment_image_message'];
			if(preg_match('/(<img src=)(.+?)(\>)/i', $comments_text))
			{
				$comments_text = preg_replace('/(<img src=)(.+?)(\>)/i', $no_image_message, $comments_text); 
			}
		
			if(preg_match('/(\[img\])([^\[]*)(\[\/img\])/i', $comments_text))
			{
				$comments_text = preg_replace('/(\[img\])([^\[]*)(\[\/img\])/i', $no_image_message, $comments_text); 
			}
		}
		
		if($pafiledb_config['allow_comment_links'] == 0)
		{
			$no_link_message = $pafiledb_config['no_comment_link_message'];
			
			if(preg_match('/(\[url=(.*?)\])([^\[]*)(\[\/url\])/i', $comments_text))
			{
				$comments_text = preg_replace('/(\[url=(.*?)\])([^\[]*)(\[\/url\])/i', $no_link_message, $comments_text); 
			}
		
			if(preg_match('/(\[url\])([^\[]*)(\[\/url\])/i', $comments_text))
			{
				$comments_text = preg_replace('/(\[url\])([^\[]*)(\[\/url\])/i', $no_link_message, $comments_text); 
			}
			
			if (preg_match("#([\n ])http://www\.([a-z0-9\-]+)\.([a-z0-9\-.\~]+)((?:/[^,\t \n\r]*)?)#i", $comments_text) )
			{
				$comments_text = preg_replace("#([\n ])http://www\.([a-z0-9\-]+)\.([a-z0-9\-.\~]+)((?:/[^,\t \n\r]*)?)#i", $no_link_message, $comments_text);
			}

			if (preg_match("#([\n ])www\.([a-z0-9\-]+)\.([a-z0-9\-.\~]+)((?:/[^,\t \n\r]*)?)#i", $comments_text) )
			{
				$comments_text = preg_replace("#([\n ])www\.([a-z0-9\-]+)\.([a-z0-9\-.\~]+)((?:/[^,\t \n\r]*)?)#i", $no_link_message, $comments_text);
			}
		}
	}
	return $comments_text;
}
?>
