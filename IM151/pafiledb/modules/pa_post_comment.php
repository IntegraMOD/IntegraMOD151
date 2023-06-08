<?php
/***************************************************************************
 *                            post_comment.php
 *                            -------------------
 *   begin                : Wednesday, Jan 1, 2003
 *   copyright            : (C) 2002 Illuminati Gaming Network
 *   email                : whofarted75@yahoo.com
 *
 *   $Id: post_comment.php,v 0.0.6   Exp $
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

class pafiledb_post_comment extends pafiledb_public
{
	function main($action)
	{
		global $pafiledb_template, $lang, $board_config, $phpEx, $pafiledb_config, $db, $images, $userdata;
		global $_REQUEST, $_POST, $phpbb_root_path, $bbcode_tpl;
		global $html_entities_match, $html_entities_replace, $unhtml_specialchars_match, $unhtml_specialchars_replace;
		global $pafiledb_functions;


		include_once($phpbb_root_path . 'includes/bbcode.'.$phpEx);
		include_once($phpbb_root_path . 'includes/functions_post.'.$phpEx);
		include_once($phpbb_root_path . 'pafiledb/includes/functions_comment.'.$phpEx);

		if ( isset($_REQUEST['file_id']) )
		{
			$file_id = intval($_REQUEST['file_id']);
		}
		else
		{
			message_die(GENERAL_MESSAGE, $lang['File_not_exist']);
		}

// MX Addon		
		if ( isset($_REQUEST['cid']) )
		{
			$cid = intval($_REQUEST['cid']);
		}

		$delete = (isset($_REQUEST['delete'])) ? intval($_REQUEST['delete']) : '';

		$submit = (isset($_POST['submit'])) ? TRUE : 0;
		$preview = (isset($_POST['preview'])) ? TRUE : 0;
		
		$subject = ( !empty($_POST['subject']) ) ? htmlspecialchars(trim(stripslashes($_POST['subject']))) : '';
		$message = ( !empty($_POST['message']) ) ? htmlspecialchars(trim(stripslashes($_POST['message']))) : '';


		$sql = "SELECT file_name, file_catid
			FROM " . PA_FILES_TABLE . " 
			WHERE file_id = '" . $file_id . "'";

		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Couldnt select download', '', __LINE__, __FILE__, $sql);
		}

		if(!$file_data = $db->sql_fetchrow($result))
		{
			message_die(GENERAL_MESSAGE, $lang['File_not_exist']);
		}

		$db->sql_freeresult($result);
		
		if( (!$this->auth[$file_data['file_catid']]['auth_post_comment']) )
		{
			if ( !$userdata['session_logged_in'] )
			{
				redirect(append_sid("login.$phpEx?redirect=dload.$phpEx?action=post_comment&file_id=" . $file_id, true));
			}

			$message = sprintf($lang['Sorry_auth_download'], $this->auth[$file_data['file_catid']]['auth_post_comment_type']);
			message_die(GENERAL_MESSAGE, $message);
		}
		
		$html_on = ( $userdata['user_allowhtml'] && $pafiledb_config['allow_html'] ) ? TRUE : 0;
		$bbcode_on = ( $userdata['user_allowbbcode'] && $pafiledb_config['allow_bbcode']  ) ? TRUE : 0;
		$smilies_on = ( $userdata['user_allowsmile'] && $pafiledb_config['allow_smilies']  ) ? TRUE : 0;

		// =======================================================
		// MX Addon
		// =======================================================
		if($delete == 'do' )
		{
				$sql = 'SELECT *
				FROM ' . PA_FILES_TABLE . "
				WHERE file_id = $file_id";
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Couldn\'t get file info', '', __LINE__, __FILE__, $sql);
			}
			$file_info = $db->sql_fetchrow($result);

			if ( ($this->auth[$file_info['file_catid']]['auth_delete_comment'] && $file_info['user_id'] == $userdata['user_id']) || $this->auth[$file_info['file_catid']]['auth_mod'] )
			{

			$sql = 'DELETE FROM ' . PA_COMMENTS_TABLE . "
				WHERE comments_id = $cid";

			if ( !($db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Couldnt delete comment', '', __LINE__, __FILE__, $sql);
			}

			$this->_pafiledb();
			$message = $lang['Comment_deleted'] . '<br /><br />' . sprintf($lang['Click_return'], '<a href="' . append_sid("dload.php?action=file&file_id=$file_id") . '">', '</a>');
			message_die(GENERAL_MESSAGE, $message);
			}
			else
			{
				$message = sprintf($lang['Sorry_auth_delete'], $this->auth[$cat_id]['auth_upload_type']);
				message_die(GENERAL_MESSAGE, $message);
			}
		}

		if(!$submit)
		{

			// Generate smilies listing for page output
			$pafiledb_functions->pa_generate_smilies('inline', PAGE_POSTING);

			$html_status =  ( $userdata['user_allowhtml'] && $pafiledb_config['allow_html'] ) ? $lang['HTML_is_ON'] : $lang['HTML_is_OFF'];
			$bbcode_status = ( $userdata['user_allowbbcode'] && $pafiledb_config['allow_bbcode']  ) ? $lang['BBCode_is_ON'] : $lang['BBCode_is_OFF'];
			$smilies_status = ( $userdata['user_allowsmile'] && $pafiledb_config['allow_smilies']  ) ? $lang['Smilies_are_ON'] : $lang['Smilies_are_OFF'];
			$links_status = ( $pafiledb_config['allow_comment_links']  ) ? $lang['Links_are_ON'] : $lang['Links_are_OFF'];
			$images_status = ( $pafiledb_config['allow_comment_images']  ) ? $lang['Images_are_ON'] : $lang['Images_are_OFF'];
			$hidden_form_fields = '<input type="hidden" name="action" value="post_comment">
						<input type="hidden" name="file_id" value="' . $file_id . '">
						<input type="hidden" name="comment" value="post">';


			//
			// Output the data to the template
			//
			$this->generate_category_nav($file_data['file_catid']);

			$pafiledb_template->assign_vars(array(
				'HTML_STATUS' => $html_status,
				'BBCODE_STATUS' => sprintf($bbcode_status, '<a href="' . append_sid("faq.$phpEx?mode=bbcode") . '" target="_phpbbcode">', '</a>'), 
				'SMILIES_STATUS' => $smilies_status,
				'LINKS_STATUS' => $links_status, 
				'IMAGES_STATUS' => $images_status, 
				'FILE_NAME' => $file_data['file_name'],
				'DOWNLOAD' => $pafiledb_config['settings_dbname'],
				'MESSAGE_LENGTH' => $pafiledb_config['max_comment_chars'],

				'L_COMMENT_ADD' => $lang['Comment_add'],
				'L_COMMENT' => $lang['Message_body'],
				'L_COMMENT_TITLE' => $lang['Subject'],
				'L_OPTIONS' => $lang['Options'],
				'L_COMMENT_EXPLAIN' => sprintf($lang['Comment_explain'], $pafiledb_config['max_comment_chars']),
				'L_PREVIEW' => $lang['Preview'],
				'L_SUBMIT' => $lang['Submit'],
				'L_DOWNLOAD'=> $lang['Download'],
				'L_INDEX' => sprintf($lang['Forum_Index'], $board_config['sitename']),
			   'L_CHECK_MSG_LENGTH' => $lang['Check_message_length'], 
			   'L_MSG_LENGTH_1' => $lang['Msg_length_1'], 
			   'L_MSG_LENGTH_2' => $lang['Msg_length_2'], 
			   'L_MSG_LENGTH_3' => $lang['Msg_length_3'], 
			   'L_MSG_LENGTH_4' => $lang['Msg_length_4'], 
			   'L_MSG_LENGTH_5' => $lang['Msg_length_5'], 
			   'L_MSG_LENGTH_6' => $lang['Msg_length_6'], 

				'L_BBCODE_B_HELP' => $lang['bbcode_b_help'], 
				'L_BBCODE_I_HELP' => $lang['bbcode_i_help'], 
				'L_BBCODE_U_HELP' => $lang['bbcode_u_help'], 
				'L_BBCODE_Q_HELP' => $lang['bbcode_q_help'], 
				'L_BBCODE_C_HELP' => $lang['bbcode_c_help'], 
				'L_BBCODE_L_HELP' => $lang['bbcode_l_help'], 
				'L_BBCODE_O_HELP' => $lang['bbcode_o_help'], 
				'L_BBCODE_P_HELP' => $lang['bbcode_p_help'], 
				'L_BBCODE_W_HELP' => $lang['bbcode_w_help'], 
				'L_BBCODE_A_HELP' => $lang['bbcode_a_help'], 
				'L_BBCODE_S_HELP' => $lang['bbcode_s_help'], 
				'L_BBCODE_F_HELP' => $lang['bbcode_f_help'], 
				'L_EMPTY_MESSAGE' => $lang['Empty_message'],

				'L_FONT_COLOR' => $lang['Font_color'], 
				'L_COLOR_DEFAULT' => $lang['color_default'], 
				'L_COLOR_DARK_RED' => $lang['color_dark_red'], 
				'L_COLOR_RED' => $lang['color_red'], 
				'L_COLOR_ORANGE' => $lang['color_orange'], 
				'L_COLOR_BROWN' => $lang['color_brown'], 
				'L_COLOR_YELLOW' => $lang['color_yellow'], 
				'L_COLOR_GREEN' => $lang['color_green'], 
				'L_COLOR_OLIVE' => $lang['color_olive'], 
				'L_COLOR_CYAN' => $lang['color_cyan'], 
				'L_COLOR_BLUE' => $lang['color_blue'], 
				'L_COLOR_DARK_BLUE' => $lang['color_dark_blue'], 
				'L_COLOR_INDIGO' => $lang['color_indigo'], 
				'L_COLOR_VIOLET' => $lang['color_violet'], 
				'L_COLOR_WHITE' => $lang['color_white'], 
				'L_COLOR_BLACK' => $lang['color_black'], 

				'L_FONT_SIZE' => $lang['Font_size'], 
				'L_FONT_TINY' => $lang['font_tiny'], 
				'L_FONT_SMALL' => $lang['font_small'], 
				'L_FONT_NORMAL' => $lang['font_normal'], 
				'L_FONT_LARGE' => $lang['font_large'], 
				'L_FONT_HUGE' => $lang['font_huge'], 

				'L_BBCODE_CLOSE_TAGS' => $lang['Close_Tags'], 
				'L_STYLES_TIP' => $lang['Styles_tip'], 

				'U_INDEX' => append_sid('index.'.$phpEx),
				'U_DOWNLOAD_HOME' => append_sid('dload.'.$phpEx),
				'U_FILE_NAME' => append_sid('dload.php?action=file&file_id=' . $file_id),

				'S_POST_ACTION' => append_sid('dload.'.$phpEx),
				'S_HIDDEN_FORM_FIELDS' => $hidden_form_fields)
			);

			//
			// Show preview stuff if user clicked preview
			//
			if($preview)
			{
				$orig_word = array();
				$replacement_word = array();
				obtain_word_list($orig_word, $replacement_word);

				$comment_bbcode_uid = ( $bbcode_on ) ? make_bbcode_uid() : '';
				$comments_text = stripslashes(prepare_message(addslashes(unprepare_message($message)), $html_on, $bbcode_on, $smilies_on, $comment_bbcode_uid));

				$title = $subject;

				if ( !$html_on )
				{
					$comments_text = comment_suite($comments_text);
					$comments_text = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $comments_text);
				}

				if ($bbcode_on)
				{
					$comments_text = comment_suite($comments_text);
					$comments_text = bbencode_second_pass($comments_text, $comment_bbcode_uid);// : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $comments_text);
				}
				
				if( !empty($orig_word) )
				{
					$title = ( !empty($title) ) ? preg_replace($orig_word, $replacement_word, $title) : '';
					$comments_text = ( !empty($comments_text) ) ? preg_replace($orig_word, $replacement_word, $comments_text) : '';
				}
				//
				// Now we run comment suite before checking for smilies 
				// so admins can add them in messages if they like
				// and so smilies are not counted as images in sigs.
				// this is done here again incase above conditions are
				// not met.
				//
				$comments_text = comment_suite($comments_text);
				$comments_text = make_clickable($comments_text);
				//
				// Parse smilies
				//
				if ($smilies_on)
				{
					$comments_text = smilies_pass($comments_text);
				}

				$comments_text = str_replace("\n", '<br />', $comments_text);
	
				$pafiledb_template->assign_vars(array(
					'PREVIEW' => TRUE,
					'COMMENT' => stripslashes($_POST['message']),
					'SUBJECT' => stripslashes($_POST['subject']),        
					'PRE_COMMENT' => $comments_text)
				);
			}
		}



		if($submit)
		{

			$length = strlen($_POST['message']);
			$comments_text = str_replace('<br />', "\n", $_POST['message']);
			$comment_bbcode_uid = make_bbcode_uid();
			$comments_text = prepare_message($comments_text, $html_on, $bbcode_on, $smilies_on, $comment_bbcode_uid);
			$comments_text = bbencode_first_pass($comments_text, $comment_bbcode_uid);

			$poster_id = intval($userdata['user_id']);
			$title = stripslashes($_POST['subject']);
			$time = time();
			if($length > $pafiledb_config['max_comment_chars'])
			{
				message_die(GENERAL_ERROR, 'Your comment is too long!<br/>The maximum length allowed in characters is ' . $pafiledb_config['max_comment_chars'] . '');
			}


			$sql = 'INSERT INTO ' . PA_COMMENTS_TABLE . "(file_id, comments_text, comments_title, comments_time, comment_bbcode_uid, poster_id) 
				VALUES($file_id, '" . str_replace("\'", "''", $comments_text) . "','" . str_replace("\'", "''", $title) . "', $time, '$comment_bbcode_uid', $poster_id)";
			if ( !($db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Couldnt insert comments', '', __LINE__, __FILE__, $sql);
			}

			$message = $lang['Comment_posted'] . '<br /><br />' . sprintf($lang['Click_return'], '<a href="' . append_sid('dload.php?action=file&file_id=' . $file_id) . '">', '</a>');
			message_die(GENERAL_MESSAGE, $message);	
		}
		$this->display($lang['Download'], 'pa_comment_posting.tpl');
	}
}

?>
