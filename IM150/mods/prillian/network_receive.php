<?php
/***************************************************************************
 *                              network_receive.php
 *                            -------------------
 *   begin                : Thursday, May 29, 2003
 *   version              : 0.2.0
 *   date                 : 2003/12/23 23:25
 ***************************************************************************/

if ( !defined('IN_PHPBB') || !defined('IN_PRILLIAN') )
{
	die('Hacking attempt');
}

include_once($phpbb_root_path . 'includes/template.'.$phpEx);
include_once($phpbb_root_path . 'includes/sessions.'.$phpEx);
include_once($phpbb_root_path . 'includes/auth.'.$phpEx);
include_once($phpbb_root_path . 'includes/functions.'.$phpEx);
include_once($phpbb_root_path . 'includes/bbcode.'.$phpEx);
include_once($phpbb_root_path . 'includes/functions_post.'.$phpEx);
$html_entities_match = array('#&#', '#<#', '#>#');
$html_entities_replace = array('&amp;', '&lt;', '&gt;');
$error = FALSE;
$submit = ( isset($_REQUEST['post']) ) ? TRUE : 0;
$site_url = '';
$site_info = array();
$from_username = '';
$to_username = '';

// Set up default style and language info
init_userprefs(array());

function unprocess_var($var)
{
	$var = trim( strip_tags( undo_htmlspecialchars( $var ) ) );
	return $var;
}

$site_url = ( !empty($_REQUEST['site_url']) ) ? unprocess_var($_REQUEST['site_url']) : '';

if( empty($site_url) )
{
	$msg = $lang['Network_no_siteurl'] . $append_msg;
	message_die(GENERAL_ERROR, $msg);
}
else
{
	$sql = 'SELECT site_id FROM ' . IM_SITES_TABLE . ' WHERE site_url = \'' . $site_url . '\'';
	if( !$result = $db->sql_query($sql) )
	{
		$msg = 'Could not get Site to Site information' . $append_msg;
		message_die(GENERAL_ERROR, $msg);
	}
	if( !$site_info = $db->sql_fetchrow($result) )
	{
		$msg = $lang['Network_not_in_db'] . $append_msg;
		message_die(GENERAL_ERROR, $msg, "", __LINE__, __FILE__, $sql);
	}

	$success_close = ( !empty($_REQUEST['success_close']) ) ? true : false;

	//
	// Toggles
	//
	if ( !$board_config['allow_html'] )
	{
		$html_on = 0;
	}
	else
	{
		$html_on = ( !empty($_REQUEST['disable_html']) ) ? 0 : TRUE;
	}

	if ( !$board_config['allow_bbcode'] )
	{
		$bbcode_on = 0;
	}
	else
	{
		$bbcode_on = ( !empty($_REQUEST['disable_bbcode']) ) ? 0 : TRUE;
	}

	if ( !$board_config['allow_smilies'] )
	{
		$smilies_on = 0;
	}
	else
	{
		$smilies_on = ( !empty($_REQUEST['disable_smilies']) ) ? 0 : TRUE;
	}

	$attach_sig = 0;
	$user_sig = '';

	//
	// Flood control
	//
	if( $prill_config['enable_flood'] )
	{
		$sql = 'SELECT MAX(privmsgs_date) AS last_post_time
			FROM ' . PRIVMSGS_TABLE . '
			WHERE site_id <> 0';
		if ( $result = $db->sql_query($sql) )
		{
			$db_row = $db->sql_fetchrow($result);

			$last_post_time = $db_row['last_post_time'];

			if ( ( time() - $last_post_time ) < $prill_config['flood_interval'] )
			{
				$msg = $lang['Network_Flood_Error'] . $append_msg;
				message_die(GENERAL_MESSAGE, $msg);
			}
		}
	}
	//
	// End Flood control
	//

	if ( !empty($_REQUEST['username']) )
	{
		$to_username = trim(strip_tags($_REQUEST['username']));

		$sql = 'SELECT username, user_id FROM ' . USERS_TABLE . " 
			WHERE username = '" . str_replace("\'", "''", $to_username) . "'
				AND user_id <> " . ANONYMOUS;
		if ( !$result = $db->sql_query($sql) )
		{
			$error = TRUE;
			$error_msg = $lang['No_such_user'];
		}

		if ( !$to_userdata = $db->sql_fetchrow($result) )
		{
			$error = TRUE;
			$error_msg = $lang['No_such_user'];
		}
		
		// Check to see if IMs have been turned off
		// for the receiving user
		$sql = 'SELECT user_allow_ims, admin_allow_ims 
			FROM ' . IM_PREFS_TABLE . ' 
			WHERE user_id = ' . $to_userdata['user_id'];

		if ( !$result = $db->sql_query($sql) )
		{
			$error = TRUE;
			$error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . $lang['Ims_not_allowed_fail'];
		}
		else
		{
			$to_im_userdata = $db->sql_fetchrow($result);
			if( !$to_im_userdata['user_allow_ims'] && !$to_im_userdata['admin_allow_ims'] )
			{
				// Either the user or admin has turned off IMs for this user
				$error = TRUE;
				$error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . $lang['Ims_not_allowed'];
			}
		}
	}
	else
	{
		$error = TRUE;
		$error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . $lang['No_to_user'];
	}

	// Get sender's username & user id
	if ( !empty($_REQUEST['from_username']) && !empty($_REQUEST['from_userid']) )
	{
		$from_username = unprocess_var($_REQUEST['from_username']);
		$from_userid = intval($_REQUEST['from_userid']);

		if( empty($from_username) )
		{
			$error = TRUE;
			$error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . $lang['Network_no_username'];
		}
	}
	else
	{
		$error = TRUE;
		$error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . $lang['Network_no_username'];
	}

	$instant_subject = trim(strip_tags($_REQUEST['subject']));
	if ( empty($instant_subject) )
	{
		$instant_subject = $default_im_subject;
	}

	if ( !empty($_REQUEST['message']) )
	{
		if ( !$error )
		{
			if ( $bbcode_on )
			{
				$bbcode_uid = make_bbcode_uid();
			}

			$instant_message = prepare_message($_REQUEST['message'], $html_on, $bbcode_on, $smilies_on, $bbcode_uid);
		}
	}
	else
	{
		$error = TRUE;
		$error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . $lang['Empty_message'];
	}

	if( !$error )
	{
		$msg_time = time();

		if( $prill_config['enable_im_limit'] )
		{
			//
			// See if recipient is at their IM box limit
			// If so, don't send the message
			//
			$sql = 'SELECT COUNT(privmsgs_id) AS im_box_items, MIN(privmsgs_date) AS oldest_post_time 
				FROM ' . PRIVMSGS_TABLE . ' 
				WHERE privmsgs_type = ' . IM_UNREAD_MAIL . '
					AND privmsgs_to_userid = ' . $to_userdata['user_id'];

			if ( !$result = $db->sql_query($sql) )
			{
				$msg = $lang['No_such_user'] . $append_msg;
				message_die(GENERAL_MESSAGE, $msg);
			}

			$sql_priority = ( SQL_LAYER == 'mysql' ) ? 'LOW_PRIORITY' : '';

			if ( $im_box_info = $db->sql_fetchrow($result) )
			{
				if ( $im_box_info['im_box_items'] >= $prill_config['box_limit'] )
				{
					$msg = $lang['Too_many_ims'] . $append_msg;
					message_die(GENERAL_ERROR, $msg, '', __LINE__, __FILE__, $sql);
				}
			}
		}

		$room_id = '0';

		$sql_info = 'INSERT INTO ' . PRIVMSGS_TABLE . ' (site_id, room_id, privmsgs_type, privmsgs_subject, privmsgs_from_username, privmsgs_from_userid, privmsgs_to_userid, privmsgs_date, privmsgs_ip, privmsgs_enable_html, privmsgs_enable_bbcode, privmsgs_enable_smilies, privmsgs_attach_sig)
			VALUES (' . $site_info['site_id'] . ", $room_id, " . IM_NEW_MAIL . ", '" . str_replace("\'", "''", $instant_subject) . "', '" . str_replace("\'", "''", $from_username) . "', $from_userid, " . $to_userdata['user_id'] . ", $msg_time, '$user_ip', $html_on, $bbcode_on, $smilies_on, $attach_sig)";

		if ( !$result = $db->sql_query($sql_info, BEGIN_TRANSACTION) )
		{
			$msg = 'Could not insert instant message sent info.' . $append_msg;
			message_die(GENERAL_ERROR, $msg, '', __LINE__, __FILE__, $sql_info);
		}

		$im_msg_sent_id = $db->sql_nextid();

		$sql = 'INSERT INTO ' . PRIVMSGS_TEXT_TABLE . " (privmsgs_text_id, privmsgs_bbcode_uid, privmsgs_text)
			VALUES ($im_msg_sent_id, '" . $bbcode_uid . "', '" . str_replace("\'", "''", $instant_message) . "')";

		if ( !$db->sql_query($sql, END_TRANSACTION) )
		{
			$msg = 'Could not insert instant message sent text.' . $append_msg;
			message_die(GENERAL_ERROR, $msg, '', __LINE__, __FILE__, $sql);
		}

		//
		// Add to the users new message counter
		//
		$sql = 'UPDATE ' . IM_PREFS_TABLE . '
			SET new_ims = new_ims + 1 
			WHERE user_id = ' . $to_userdata['user_id']; 
		if ( !$status = $db->sql_query($sql) )
		{
			$msg = 'Could not update instant message new status for user' . $append_msg;
			message_die(GENERAL_ERROR, '', '', __LINE__, __FILE__, $sql);
		}

		if( $success_close )
		{
			auto_close();
		}
		else
		{
			$msg = $lang['Message_sent'] . $append_msg;
			message_die(GENERAL_MESSAGE, $msg);
		}

	}
	else
	{
		//
		// If we're refreshing then obtain the data passed to the script,
		// process it a little, do some checks where neccessary, etc.
		//
		$to_username = ( isset($_REQUEST['username']) ) ? trim(strip_tags(stripslashes($_REQUEST['username']))) : '';
		$from_username = ( isset($_REQUEST['from_username']) ) ? trim(strip_tags(stripslashes($_REQUEST['from_username']))) : '';
		$instant_subject = ( isset($_REQUEST['subject']) ) ? trim(strip_tags(stripslashes($_REQUEST['subject']))) : '';
		$instant_message = ( isset($_REQUEST['message']) ) ? trim($_REQUEST['message']) : '';
		$instant_message = preg_replace('#<textarea>#si', '&lt;textarea&gt;', $instant_message);
		$instant_message = stripslashes($instant_message);
		$success_close = ( isset($_REQUEST['success_close']) ) ? '1' : '0';
		$site_url = ( isset($_REQUEST['site_url']) ) ? unprocess_var($_REQUEST['site_url']) : '';
		$user_sig = '';

		if ( !empty($_REQUEST[POST_USERS_URL]) )
		{
			$user_id = intval($_REQUEST[POST_USERS_URL]);

			$sql = 'SELECT username
				FROM ' . USERS_TABLE . "
				WHERE user_id = $user_id
					AND user_id <> " . ANONYMOUS;
			if ( !$result = $db->sql_query($sql) )
			{
				$error = TRUE;
				$error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . $lang['No_such_user'];
			}
			if ( $row = $db->sql_fetchrow($result) )
			{
				$to_username = $row['username'];
			}
		}

		$post_a = ( $mode == 'reply' ) ? $lang['Reply_to_a_network'] : $lang['Send_a_new_network'];

		$page_title = $post_a;
		include_once(PRILL_PATH . 'prill_header.'.$phpEx);

		//
		// Start error handling
		//
		if ($error)
		{
			$template->set_filenames(array(
				'reg_header' => 'error_body.tpl')
			);
			$template->assign_vars(array(
				'ERROR_MESSAGE' => $error_msg)
			);
			$template->assign_var_from_handle('ERROR_BOX', 'reg_header');
		}

		//
		// Load templates
		//
		$template->set_filenames(array(
			'body' => 'prillian/posting_body.tpl')
		);

		//
		// HTML toggle selection
		//
		if ( $board_config['allow_html'] )
		{
			$html_status = $lang['HTML_is_ON'];
			$template->assign_block_vars('switch_html_checkbox', array());
		}
		else
		{
			$html_status = $lang['HTML_is_OFF'];
		}

		//
		// BBCode toggle selection
		//
		if ( $board_config['allow_bbcode'] )
		{
			$bbcode_status = $lang['BBCode_is_ON'];
			$template->assign_block_vars('switch_bbcode_checkbox', array());
		}
		else
		{
			$bbcode_status = $lang['BBCode_is_OFF'];
		}

		//
		// Smilies toggle selection
		//
		if ( $board_config['allow_smilies'] )
		{
			$smilies_status = $lang['Smilies_are_ON'];
			$template->assign_block_vars('switch_smilies_checkbox', array());
			//
			// Smilies drop down list - based off concepts presented in
			// radmanics' Drop Down Smilie List MOD version 1.1.5 and posts
			// in that mod's thread in phpBB.com Beta Development forum.
			// This code's all original, though - I didn't copy anything
			// from that mod except some JavaScript in the templates. :)
			//

			$sql = 'SELECT emoticon, code, smile_url FROM ' . SMILIES_TABLE;

			if ( !$result=$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not get smilies list', '', __LINE__, __FILE__, $delete_sql);
			}

			$smiles_array = array();
			while( $row = $db->sql_fetchrow($result) )
			{
				$smiles_array[$row['emoticon']] = $row;
			}

			if( count($smiles_array) )
			{
				$board_config['smilies_path'] = $phpbb_root_path . $board_config['smilies_path'];
				$template->assign_block_vars('switch_smilies_dropdown', array());
				$template->assign_vars(array(
					'L_SELECT_SMILE' => $lang['Select_emoticon'],
					'S_SMILEY_BASEDIR' => $board_config['smilies_path']
				));

				foreach($smiles_array as $val)
				{
					$template->assign_block_vars('switch_smilies_dropdown.smilies_row',	array(
						'S_SMILE_NAME' => $val['emoticon'],
						'S_SMILE_CODE' => $val['code'],
						'S_SMILE_URL' => $val['smile_url'])
					);
				}
			}
		}
		else
		{
			$smilies_status = $lang['Smilies_are_OFF'];
		}

		// Signature toggle selection - only show if
		// the user has a signature
		//
		if ( $user_sig != '' )
		{
			$template->assign_block_vars('switch_signature_checkbox', array());
		}

		$s_hidden_fields = '<input type="hidden" name="mode" value="' . $mode . '" /><input type="hidden" name="site_url" value="' . $site_url . '" /><input type="hidden" name="mode" value="' . $mode . '" /><input type="hidden" name="from_username" value="' . $from_username . '" />';

		$template->assign_block_vars('switch_bbcode_controls', array());
		$template->assign_block_vars('switch_font_controls', array());
		$template->assign_block_vars('switch_smilies_status', array());

		$s_form_action = $phpbb_root_path . 'sitetosite.' . $phpEx;

		$template->assign_vars(array(
			'SUBJECT' => preg_replace($html_entities_match, $html_entities_replace, $instant_subject), 
			'USERNAME' => preg_replace($html_entities_match, $html_entities_replace, $to_userdata['username']),
			'MESSAGE' => $instant_message,
			'HTML_STATUS' => $html_status, 
			'SMILIES_STATUS' => $smilies_status, 
			'BBCODE_STATUS' => sprintf($bbcode_status, '<a href="' . append_sid($phpbb_root_path . "faq.$phpEx?mode=bbcode") . '" target="_phpbbcode">', '</a>'), 
			'FORUM_NAME' => $lang['Private_message'], 

			'L_SUBJECT' => $lang['Subject'],
			'L_MESSAGE' => $lang['Message'],
			'L_OPTIONS' => $lang['Options'],
			'L_SUBMIT' => $lang['Submit'],
			'L_CLOSE_WINDOW' => $lang['Close_window'],
			'L_CANCEL' => $lang['Cancel'],
			'L_POST_A' => $post_a,
			'L_DISABLE_HTML' => $lang['Disable_HTML_pm'], 
			'L_DISABLE_BBCODE' => $lang['Disable_BBCode_pm'], 
			'L_DISABLE_SMILIES' => $lang['Disable_Smilies_pm'], 
			'L_ATTACH_SIGNATURE' => $lang['Attach_signature'], 
			'L_SAVE_SENT' => $lang['Save_message'],

			'L_EMPTY_MESSAGE' => $lang['Empty_message'],
			'L_FIND_USERNAME' => $lang['Find_username'],
			'L_BUDDIES' => $lang['Buddies'],
			'U_IM_PATH' => $phpbb_im_path,

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
			'S_HTML_CHECKED' => ( !$html_on ) ? ' checked="checked"' : '', 
			'S_BBCODE_CHECKED' => ( !$bbcode_on ) ? ' checked="checked"' : '', 
			'S_SMILIES_CHECKED' => ( !$smilies_on ) ? ' checked="checked"' : '', 
			'S_SIGNATURE_CHECKED' => ( $attach_sig ) ? ' checked="checked"' : '', 
			'S_HIDDEN_FORM_FIELDS' => $s_hidden_fields,
			'U_SEARCH_USER' => append_sid($phpbb_root_path . "search.$phpEx?mode=searchuser"), 
			'U_CONTACT' => append_sid(CONTACT_URL . 'simple=1&mode=popup'), 
			'S_POST_ACTION' => append_sid($s_form_action)
		));

		$template->pparse('body');
		include_once($phpbb_root_path . 'includes/page_tail.'.$phpEx);

	}
}

?>