<?php
/***************************************************************************
 *                             functions_im.php
 *                            -------------------
 *   begin                : Tuesday, Nov 19, 2002
 *   version              : 0.7.0
 *   date                 : 2003/12/23 23:27
 ***************************************************************************/

if ( !defined('IN_PHPBB') || !defined('IN_PRILLIAN') )
{
	die('Hacking attempt');
}

function override_im_settings(&$im_data)
// Used to set default user IM preferences
{
	global $db, $prill_config;

	if( $prill_config['override_frames'] )
	{
		$im_data['use_frames'] = $prill_config['use_frames'];
	}

	if( !$prill_config['allow_mode_switch'] )
	{
		$im_data['current_mode'] = $prill_config['default_mode'];
	}

	if( $prill_config['override_users'] || $im_data['user_override'] )
	{
		$im_data['user_allow_ims'] = $prill_config['allow_ims'];
		$im_data['user_allow_shout'] = $prill_config['allow_shout'];
		$im_data['user_allow_chat'] = $prill_config['allow_chat'];
		$im_data['attach_sig'] = 0;
		$im_data['refresh_rate'] = $prill_config['refresh_rate'];
		$im_data['success_close'] = $prill_config['success_close'];
		$im_data['refresh_method'] = $prill_config['refresh_method'];
		$im_data['auto_launch'] = $prill_config['auto_launch'];
		$im_data['popup_ims'] = $prill_config['popup_ims'];
		$im_data['list_ims'] = $prill_config['list_ims'];
		$im_data['show_controls'] = $prill_config['show_controls'];
		$im_data['list_all_online'] = $prill_config['list_all_online'];
		$im_data['mode1_height'] = $prill_config['mode1_height'];
		$im_data['mode1_width'] = $prill_config['mode1_width'];
		$im_data['mode2_height'] = $prill_config['mode2_height'];
		$im_data['mode2_width'] = $prill_config['mode2_width'];
		$im_data['mode3_height'] = $prill_config['mode3_height'];
		$im_data['mode3_width'] = $prill_config['mode3_width'];
		$im_data['default_mode'] = $prill_config['default_mode'];
		$im_data['prefs_height'] = $prill_config['prefs_height'];
		$im_data['prefs_width'] = $prill_config['prefs_width'];
		$im_data['read_height'] = $prill_config['read_height'];
		$im_data['read_width'] = $prill_config['read_width'];
		$im_data['send_height'] = $prill_config['send_height'];
		$im_data['send_width'] = $prill_config['send_width'];
		$im_data['play_sound'] = $prill_config['play_sound'];
		$im_data['default_sound'] = $prill_config['default_sound'];
		$im_data['sound_name'] = $prill_config['sound_name'];
		$im_data['themes_id'] = $prill_config['themes_id'];
		$im_data['network_user_list'] = $prill_config['network_user_list'];
		$im_data['open_pms'] = $prill_config['open_pms'];
		$im_data['use_frames'] = $prill_config['use_frames'];
		$im_data['auto_delete'] = $prill_config['auto_delete'];
	}

}

function init_imprefs($id, $style_setup = false, $get_default = false)
// Gets user IM preferences from the database.
{
	global $db, $prill_config, $lang, $append_msg, $theme, $template, $images;

	$id = intval($id);
	$im_data = array();

	if( $id == ANONYMOUS || empty($id) )
	{
		$im_data['current_mode'] = MAIN_MODE;
		return $im_data;
	}
	else
	{
		$sql = 'SELECT * FROM ' . IM_PREFS_TABLE . ' WHERE user_id=' . $id;
		if ( !($result = $db->sql_query($sql)) )
		{
			// Bad mojo
			$msg = $lang['No_prill_prefs'] . $append_msg;
			message_die(CRITICAL_ERROR, $msg, '', __LINE__, __FILE__, $sql);
		}

		if ( !($im_data = $db->sql_fetchrow($result)) )
		{
			$msg = $lang['No_prill_userprefs'] . $append_msg;
			message_die(CRITICAL_ERROR, $msg, '', __LINE__, __FILE__, $sql);
		}

		// Check status of admin overrides
		override_im_settings($im_data, $id, $append_msg);

		if( !$im_data['default_mode'] )
		{
			$im_data['default_mode'] = ( !$im_data['current_mode'] ) ? MAIN_MODE : $im_data['current_mode'];
		}
		if( !$im_data['current_mode'] || $get_default )
		{
			$im_data['current_mode'] = $im_data['default_mode'];
		}
		$end_string = '';
		if( $get_default )
		{
			$end_string = '&mode_switch=1';
		}

		$width = $im_data['mode' . $im_data['current_mode'] . '_width'];
		$height = $im_data['mode' . $im_data['current_mode'] . '_height'];
		if( !$width )
		{
			$width = $prill_config['mode' . $im_data['current_mode'] . '_width'];
		}
		if( !$height )
		{
			$height = $prill_config['mode' . $im_data['current_mode'] . '_height'];
		}
		$frames = ( !$im_data['use_frames'] ) ? NO_FRAMES_MODE: FRAMES_MODE;
		
		$im_data['mode_width'] = $width;
		$im_data['mode_height'] = $height;
		$im_data['mode_string'] = '?mode=' . $frames . '&mode2=' . $im_data['current_mode'] . $end_string;
	}

	// Set the style for the IM Client

	if( $style_setup )
	{
		if ( $prill_config['themes_allow'] )
		{
			if ( $id != ANONYMOUS && $im_data['themes_id'] > 0 )
			{
				if ( $theme = setup_style($im_data['themes_id']) )
				{
					return $im_data;
				}
			}
		}

		$theme = setup_style($prill_config['themes_id']);
	}

	return $im_data;
}

function save_a_copy($in_or_out, $to_userdata, $msg_time, $html_on, $bbcode_on, $smilies_on, $attach_sig, $bbcode_uid, $instant_message, $instant_subject, $site_id)
// Saves a copy of an Instant Message in the user's private message Savebox.
{
	global $db, $userdata, $board_config, $user_ip, $lang;

	if( $in_or_out == PRIVMSGS_SAVED_IN_MAIL )
	{
		// It's a received message
		$from_userid = $to_userdata['user_id'];
		$to_userid = $userdata['user_id'];
		$username['type'] = 'privmsgs_from_username';
		$username['name'] = $to_userdata['username'];
	}
	elseif( $in_or_out == PRIVMSGS_SAVED_OUT_MAIL )
	{
		// It's a sent message
		$from_userid = $userdata['user_id'];
		$to_userid = $to_userdata['user_id'];
		$username['type'] = 'privmsgs_to_username';
		$username['name'] = $to_userdata['username'];
	}
	
	//
	// See if user is at their savebox limit
	//
	$sql = 'SELECT COUNT(privmsgs_id) AS savebox_items, MIN(privmsgs_date) AS oldest_post_time 
		FROM ' . PRIVMSGS_TABLE . ' 
		WHERE ( ( privmsgs_to_userid = ' . $userdata['user_id'] . ' 
				AND privmsgs_type = ' . PRIVMSGS_SAVED_IN_MAIL . ' )
			OR ( privmsgs_from_userid = ' . $userdata['user_id'] . ' 
				AND privmsgs_type = ' . PRIVMSGS_SAVED_OUT_MAIL . ') )';
	if ( !($result = $db->sql_query($sql)) )
	{
		$msg = 'Could not obtain sent message info for sender' . $lang['Close_window_link'];
		message_die(GENERAL_ERROR, $msg, '', __LINE__, __FILE__, $sql);
	}

	$sql_priority = ( SQL_LAYER == 'mysql' ) ? 'LOW_PRIORITY' : '';

	if ( $saved_info = $db->sql_fetchrow($result) )
	{
		if ( $saved_info['savebox_items'] >= $board_config['max_savebox_privmsgs'] )
		{
			$sql = 'SELECT privmsgs_id FROM ' . PRIVMSGS_TABLE . ' 
				WHERE ( ( privmsgs_to_userid = ' . $userdata['user_id'] . ' 
							AND privmsgs_type = ' . PRIVMSGS_SAVED_IN_MAIL . ' )
						OR ( privmsgs_from_userid = ' . $userdata['user_id'] . ' 
							AND privmsgs_type = ' . PRIVMSGS_SAVED_OUT_MAIL . ') ) 
					AND privmsgs_date = ' . $saved_info['oldest_post_time'];
			if ( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not find oldest privmsgs (save)', '', __LINE__, __FILE__, $sql);
			}
			$old_privmsgs_id = $db->sql_fetchrow($result);
			$old_privmsgs_id = $old_privmsgs_id['privmsgs_id'];
			
			$sql = "DELETE $sql_priority FROM " . PRIVMSGS_TABLE . " 
				WHERE privmsgs_id = $old_privmsgs_id";
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete oldest privmsgs (save)', '', __LINE__, __FILE__, $sql);
			}

			$sql = "DELETE $sql_priority FROM " . PRIVMSGS_TEXT_TABLE . " 
				WHERE privmsgs_text_id = $old_privmsgs_id";
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete oldest privmsgs text (save)', '', __LINE__, __FILE__, $sql);
			}
		}
	}

	//
	// This makes a copy of the post and stores it as a SAVED message.
	// Perhaps not the most DB friendly way but a lot easier to 
	// manage, besides the admin can set limits on numbers of 
	// storable posts for users. (This part is adapted from
	// saving a copy of a sent message after the message was read)
	//
	if( $site_id )
	{
		$extra_cols = ', ' . $username['type'] . ', site_id';
		$extra_data = ', \'' . str_replace("\'", "''", $username['name']) . '\', ' . $site_id;
	}
	else
	{
		$extra_cols = '';
		$extra_data = '';
	}

	$sql = "INSERT $sql_priority INTO " . PRIVMSGS_TABLE . ' (privmsgs_type, privmsgs_subject, privmsgs_from_userid, privmsgs_to_userid, privmsgs_date, privmsgs_ip, privmsgs_enable_html, privmsgs_enable_bbcode, privmsgs_enable_smilies, privmsgs_attach_sig' . $extra_cols . ")
		VALUES ($in_or_out , '" . str_replace("\'", "''", $instant_subject) . "', $from_userid, $to_userid, $msg_time, '$user_ip', $html_on, $bbcode_on, $smilies_on, $attach_sig" . $extra_data . ')';
	if ( !$db->sql_query($sql) )
	{
		$msg = 'Could not insert message saved info' . $lang['Close_window_link'];
		message_die(GENERAL_ERROR, $msg, '', __LINE__, __FILE__, $sql);
	}

	$privmsg_sent_id = $db->sql_nextid();

	$sql = "INSERT $sql_priority INTO " . PRIVMSGS_TEXT_TABLE . " (privmsgs_text_id, privmsgs_bbcode_uid, privmsgs_text)
		VALUES ($privmsg_sent_id, '" . $bbcode_uid . "', '" . str_replace("\'", "''", $instant_message) . "')";
	if ( !$db->sql_query($sql) )
	{
		$msg = 'Could not insert message saved text' . $lang['Close_window_link'];
		message_die(GENERAL_ERROR, $msg, '', __LINE__, __FILE__, $sql);
	}
}


/**
 * Copied and modified from phpBB 2.0.6's bbcode.php function make_clickable($text)
 * Modifications:
 *	Renamed function to im_make_clickable
 *		Reason: To preserve target="_blank" in links on boards that have been
 *			modified to change links in the board to self-targeting links.
 *			Self-targeting links in very a small window == Bad Thing.
 *
 * phpBB 2.0.4 original comments:
 * Rewritten by Nathan Codding - Feb 6, 2001.
 * - Goes through the given string, and replaces xxxx://yyyy with an HTML <a> tag 
 * 	linking to that URL
 * - Goes through the given string, and replaces www.xxxx.yyyy[zzzz] with an HTML 
 * 	<a> tag linking to http://www.xxxx.yyyy[/zzzz]
 * - Goes through the given string, and replaces xxxx@yyyy with an HTML mailto: tag 
 * 	linking	to that email address
 * - Only matches these 2 patterns either after a space, or at the beginning of a 
 * 	line
 *
 * Notes: the email one might get annoying - it's easy to make it more restrictive, 
 * though.. maybe have it require something like xxxx@yyyy.zzzz or such. We'll see.
 */
function im_make_clickable($text)
{
	// pad it with a space so we can match things at the start of the 1st line.
	$ret = ' ' . $text;

	// matches an "xxxx://yyyy" URL at the start of a line, or after a space.
	// xxxx can only be alpha characters.
	// yyyy is anything up to the first space, newline, comma, double quote or <
	$ret = preg_replace("#(^|[\n ])([\w]+?://.*?[^ \"\n\r\t<]*)#is", "\\1<a href=\"\\2\" target=\"_blank\">\\2</a>", $ret);

	// matches a "www|ftp.xxxx.yyyy[/zzzz]" kinda lazy URL thing
	// Must contain at least 2 dots. xxxx contains either alphanum, or "-"
	// zzzz is optional.. will contain everything up to the first space, newline, 
	// comma, double quote or <.
	$ret = preg_replace("#(^|[\n ])((www|ftp)\.[\w\-]+\.[\w\-.\~]+(?:/[^ \"\t\n\r<]*)?)#is", "\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>", $ret);

	// matches an email@domain type address at the start of a line, or after a space.
	// Note: Only the followed chars are valid; alphanums, "-", "_" and or ".".
	$ret = preg_replace("#(^|[\n ])([a-z0-9&\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i", "\\1<a href=\"mailto:\\2@\\3\">\\2@\\3</a>", $ret);

	// Remove our padding..
	$ret = substr($ret, 1);

	return($ret);
}

function generic_select($value, $name, $lang_list)
// Used to create various drop down lists used in preferences editors.
{
	global $im_userdata, $lang;

	ksort($lang[$lang_list]);
	$select = '<select name="' . $name . '">';
	foreach($lang[$lang_list] as $key=>$val)
	{
		$select .= '<option value="' . $key;
		$select .= ( $im_userdata[$name] == $key || $value == $key ) ? '" selected>' : '">' ;
		$select .= "$val</option>\n";
	}
	$select .= '</select>';

	return $select;
}

function im_prepare_vars($array, $use_admin = true)
// Prepares array of user preference variables
{
	global $prill_config;

	$final_vars = array();
	$admin_defaults = array(
		'attach_sig' => 0,
		'refresh_rate' => $prill_config['refresh_rate'],
		'success_close' => $prill_config['success_close'],
		'refresh_method' => $prill_config['refresh_method'],
		'auto_launch' => $prill_config['auto_launch'],
		'popup_ims' => $prill_config['popup_ims'],
		'list_ims' => $prill_config['list_ims'],
		'show_controls' => $prill_config['show_controls'],
		'list_all_online' => $prill_config['list_all_online'],
		'default_mode' => $prill_config['default_mode'],
		'mode1_height' => $prill_config['mode1_height'],
		'mode1_width' => $prill_config['mode1_width'],
		'mode2_height' => $prill_config['mode2_height'],
		'mode2_width' => $prill_config['mode2_width'],
		'mode3_height' => $prill_config['mode3_height'],
		'mode3_width' => $prill_config['mode3_width'],
		'prefs_height' => $prill_config['prefs_height'],
		'prefs_width' => $prill_config['prefs_width'],
		'read_height' => $prill_config['read_height'],
		'read_width' => $prill_config['read_width'],
		'send_height' => $prill_config['send_height'],
		'send_width' => $prill_config['send_width'],
		'play_sound' => $prill_config['play_sound'],
		'default_sound' => $prill_config['default_sound'],
		'sound_name' => $prill_config['sound_name'],
		'themes_id' => $prill_config['themes_id'],
		'network_user_list' => $prill_config['network_user_list'],
		'open_pms' => $prill_config['open_pms'],
		'use_frames' => $prill_config['use_frames'],
		'auto_delete' => $prill_config['auto_delete']
	);

	$var_list = array_keys($admin_defaults);
	$var_list[] = 'current_sound_name';

	if( $use_admin )
	{
		$admin_defaults['admin_allow_ims'] = $prill_config['allow_ims'];
		$admin_defaults['admin_allow_shout'] = $prill_config['allow_shout'];
		$admin_defaults['admin_allow_chat'] = $prill_config['allow_chat'];
		$admin_defaults['admin_allow_network'] = $prill_config['allow_network'];
		$var_list[] = 'admin_allow_ims';
		$var_list[] = 'admin_allow_shout';
		$var_list[] = 'admin_allow_chat';
		$var_list[] = 'admin_allow_network';
	}
	else
	{
		$admin_defaults['user_allow_ims'] = $prill_config['allow_ims'];
		$admin_defaults['user_allow_shout'] = $prill_config['allow_shout'];
		$admin_defaults['user_allow_chat'] = $prill_config['allow_chat'];
		$admin_defaults['user_allow_network'] = $prill_config['allow_network'];
		$var_list[] = 'user_allow_ims';
		$var_list[] = 'user_allow_shout';
		$var_list[] = 'user_allow_chat';
		$var_list[] = 'user_allow_network';
	}

	foreach($var_list as $var)
	{
		if ( $var != 'sound_name' && $var != 'current_sound_name' && isset($array[$var]) )
		{
			$final_vars[$var] = intval(preg_replace('/[^\d]/', '', $array[$var]));
		}
		elseif( $var == 'sound_name' || $var == 'current_sound_name' )
		{
			$final_vars[$var] = trim(htmlspecialchars($array[$var]));
		}
		else
		{
			$final_vars[$var] = $admin_defaults[$var];
		}
	}

	return $final_vars;
}

function process_user_online($user, $is_on_im)
// Processes user information for adding to Users Online list in template
{
	global $userdata, $template, $theme, $phpbb_root_path, $phpEx, $im_userdata, $lang, $images, $board_config;

	$style_color = '';
	$user_online_name = '';
	$user_online_link = '';

	if ( $user['user_level'] == ADMIN )
	{
		$user['username'] = '<b>' . $user['username'] . '</b>';
		$style_color = ' style="color:#' . $theme['fontcolor3'] . '"';
	}
	else if ( $user['user_level'] == MOD )
	{
		$user['username'] = '<b>' . $user['username'] . '</b>';
		$style_color = ' style="color:#' . $theme['fontcolor2'] . '"';
	}

	$u_message_user = $phpbb_root_path . "imclient.$phpEx?mode=post&" . POST_USERS_URL . '=' . $user['user_id'];
	$u_pmessage_user = $phpbb_root_path . "privmsg.$phpEx?mode=post&" . POST_USERS_URL . '=' . $user['user_id'];

	if( $user['user_level'] == OFF_SITE )
	{
		$site_img = '<img src="' . $images['prill_offsite'] . '" alt="' . $lang['Online_at'] . $user['site_name'] . '" title="' . $lang['Online_at'] . $user['site_name'] . '" align="center" />';
		$u_message_user .= '&amp;site_id=' . $user['site_id'];
		$u_pmessage_user = '';
	}
	else
	{
		$site_img = '<img src="' . $images['prill_onsite'] . '" alt="' . $lang['Online_at'] . $board_config['sitename'] . '" title="' . $lang['Online_at'] . $board_config['sitename'] . '" align="center" />';
	}

	if ( $user['user_allow_viewonline'] )
	{
		if( $user['user_level'] == OFF_SITE )
		{
			$user_online_link = $user['url'];
		}
		else
		{
			$user_online_link = append_sid($phpbb_root_path . "profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $user['user_id']);
		}

		$user_online_name = $user['username'];
	}
	elseif( $userdata['user_level'] == ADMIN )
	{
		$user_online_link = append_sid($phpbb_root_path . "profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $user['user_id']);
		$user_online_name = '<strike>' . $user['username'] . '</strike>';
	}

	if( $user_online_name )
	{
		if( $is_on_im )
		{
			$user_online_name = '<em>' . $user_online_name . '</em>';
		}

		$template->assign_block_vars('switch_users_online.switch_user_list', array(
			'ONLINE_USER' => $user_online_name,
			'ONLINE_USER_SITE' => $site_img,
			'ONLINE_USER_STYLE' => $style_color,
			'ONLINE_USER_URL' => $user_online_link,
			'U_MESSAGE_USER' => append_sid($u_message_user),
			'U_PMESSAGE_USER' => append_sid($u_pmessage_user)
		));
	}
}

function im_session_update($delete_only = false, $delete_self = false, $simple = false)
{
	global $db, $im_userdata, $userdata, $prill_config;

	if( $userdata['session_logged_in'] && !$delete_only )
	{
		$sql = 'SELECT * FROM ' . IM_SESSIONS_TABLE . '
			WHERE session_user_id = ' . $userdata['user_id'];

		if ( !$result = $db->sql_query($sql) )
		{
			return; // Can't query the table? Let's stop now then.
		}

		if ( !$im_session = $db->sql_fetchrow($result) )
		{
			// User does not have an open session - make one
			$sql = 'INSERT INTO ' . IM_SESSIONS_TABLE . ' (session_user_id, session_id, session_time)
				VALUES (' . $userdata['user_id'] . ", '" . $userdata['session_id'] . "', " . time() . ')';

			if ( !$db->sql_query($sql) )
			{
				message_die(CRITICAL_ERROR, 'Error creating IM session', '', __LINE__, __FILE__, $sql);
			}
		}
		else
		{
			// User has an open session - update the session time
			$sql = 'UPDATE ' . IM_SESSIONS_TABLE . ' SET 
				session_time = ' . time() . " 
				WHERE session_id = '" . $userdata['session_id'] . "'";

			if ( !$db->sql_query($sql) )
			{
				if( !$simple )
				{
					// Normal error message
					message_die(CRITICAL_ERROR, 'Error updating IM session', '', __LINE__, __FILE__, $sql);
				}
				else
				{
					// Network error message
					exit_the_network('Not able to delete old sessions', $sql);
				}
			}
		}
	}

	// Delete old sessions
	if( $delete_self )
	{
		$added_sql = 'AND session_id = \'' . $userdata['session_id'] . '\'';
	}
	else
	{
		$added_sql = 'AND session_id <> \'' . $userdata['session_id'] . '\'';
	}
	$sess_length = $prill_config['session_length'];
	$expiry_time = time() - $sess_length;
	$sql = 'DELETE FROM ' . IM_SESSIONS_TABLE . " 
			WHERE session_time < $expiry_time 
				$added_sql";
	if ( !$db->sql_query($sql) )
	{
		message_die(CRITICAL_ERROR, 'Error clearing old IM sessions', '', __LINE__, __FILE__, $sql);
	}
}

function print_controls($mode_append = '', $client_mode = FRAMES_MODE, $client_mode2 = MAIN_MODE, $alone = false)
{
	global $db, $im_userdata, $template, $images, $prill_config, $lang, $phpEx, $phpbb_root_path, $mode;

	if( empty($mode_append) )
	{
		$mode_append = '?mode=' . MAIN_MODE;
	}

	if( $alone )
	{
		$template->set_filenames(array(
			'body' => 'prillian/controls_frame.tpl'
		));

		$template->assign_vars(array(
			'IMG_LOGO' => $images['prill_logo'],
			'L_PRILLIAN' => $lang['Prillian']
		));
	}
	else
	{
		$template->set_filenames(array(
			'controls' => 'prillian/controls_frame.tpl'
		));
	}

	$u_login_logout = 'login.' . $phpEx . '?logout=true&amp;in_prill=1&amp;sid=' . $userdata['session_id'];

	$template->assign_vars(array(
		'IMG_MESSAGE' => $images['prill_message'],
		'IMG_REFRESH' => $images['prill_refresh'],
		'IMG_HELP' => $images['prill_help'],
		'IMG_CONTACT' => $images['prill_buddies'],
		'IMG_HOME' => $images['prill_home'],
		'IMG_CLOSE_WINDOWS' => $images['prill_closewin'],
		'IMG_LOGOUT' => $images['prill_logout'],
		'IMG_MESSAGE_LOG' => $images['prill_log'],
		'IMG_PREFS' => $images['prill_prefs'],
		'IMG_MODE1' => $images['prill_main_switch'],
		'IMG_MODE2' => $images['prill_wide_switch'],
		'IMG_MODE3' => $images['prill_mini_switch'],

		'L_ALT_MODE1' => $lang['Alt_Main_Mode'],
		'L_ALT_MODE2' => $lang['Alt_Wide_Mode'],
		'L_ALT_MODE3' => $lang['Alt_Mini_Mode'],
		'L_ALT_PREFS' => $lang['Alt_Prefs'],
		'L_ALT_REFRESH' => $lang['Alt_New_Messages'],
		'L_ALT_CONTACT' => $lang['Alt_Contact_Man'],
		'L_ALT_HOME' => $lang['Alt_Home'],
		'L_ALT_CLOSE_WINDOWS' => $lang['Alt_Close_Windows'],
		'L_ALT_LOGOUT' => $lang['Alt_Logout'],
		'L_ALT_MESSAGE' => $lang['Send_im'],
		'L_ALT_MESSAGE_LOG' => $lang['Alt_Message_Log'],
		'L_ALT_HELP' => $lang['Prillian_Help'],
		'L_CONTROLS' => $lang['Controls'],
		'L_CLOSE_WINDOWS' => $lang['Alt_Close_Windows'],
		'L_LOGOUT' => $lang['Logout'],
		'L_CHECK_IMS' => $lang['Check_IMs'],
		'L_CONTACT_MAN' => $lang['Contact_Management'],
		'L_PROFILE' => $lang['Profile'],
		'L_SEND_IM' => $lang['Send_im'],
		'L_MESSAGE_LOG' => $lang['Message_Log'],
		'L_PREFS' => $lang['Preferences'],

		'U_IM_PATH' => PRILL_PATH,
		'U_MODE1' => append_sid(PRILL_URL . '?mode=' . $client_mode . '&amp;mode2=' . MAIN_MODE . '&amp;mode_switch=1'),
		'U_MODE2' => append_sid(PRILL_URL . '?mode=' . $client_mode . '&amp;mode2=' . WIDE_MODE . '&amp;mode_switch=1'),
		'U_MODE3' => append_sid(PRILL_URL . '?mode=' . $client_mode . '&amp;mode2=' . MINI_MODE . '&amp;mode_switch=1'),
		'U_HELP' => append_sid($phpbb_root_path . 'faq.' . $phpEx . '?mode=prill'),
		'U_MESSAGE_LOG' => append_sid(PRILL_URL . '?mode=log'),
		'U_CONTACT_MAN' => append_sid(CONTACT_URL),
		'U_SEND_IM' => append_sid(PRILL_URL . '?mode=post'),
		'U_RELOAD' => append_sid(PRILL_URL . $mode_append),
		'U_PROFILE' => append_sid($phpbb_root_path . 'profile.'.$phpEx.'?mode=editprofile'),
		'U_INDEX' => append_sid($phpbb_root_path . 'index.' . $phpEx),
		'U_LOGIN_LOGOUT' => append_sid($u_login_logout),
		'U_PREFS' => append_sid($phpbb_root_path . 'imclient.'.$phpEx.'?mode=editprofile&cm1=' . $client_mode . '&cm2=' . $client_mode2),

		'MODE1_WIDTH' => $im_userdata['mode1_width'],
		'MODE1_HEIGHT' => $im_userdata['mode1_height'],
		'MODE2_WIDTH' => $im_userdata['mode2_width'],
		'MODE2_HEIGHT' => $im_userdata['mode2_height'],
		'MODE3_WIDTH' => $im_userdata['mode3_width'],
		'MODE3_HEIGHT' => $im_userdata['mode3_height'],
		'SEND_WIDTH' => $im_userdata['send_width'],
		'SEND_HEIGHT' => $im_userdata['send_height'],
		'PREFS_WIDTH' => $im_userdata['prefs_width'],
		'PREFS_HEIGHT' => $im_userdata['prefs_height'],
	));
	
	switch( $im_userdata['show_controls'] )
	{
		case '1':
			$template->assign_block_vars('switch_controls_images', array());
			if( !$prill_config['override_users'] )
			{
				$template->assign_block_vars('switch_controls_images.switch_prefs', array());
			}
			if( $prill_config['allow_mode_switch'] )
			{
				$template->assign_block_vars('switch_controls_images.switch_mode', array());
			}
			break;
		case '2':
			$template->assign_block_vars('switch_controls_text', array());
			if( !$prill_config['override_users'] )
			{
				$template->assign_block_vars('switch_controls_text.switch_prefs', array());
			}
			if( $prill_config['allow_mode_switch'] )
			{
				$template->assign_block_vars('switch_controls_text.switch_mode', array());
			}
			break;
		case '3':
			$template->assign_block_vars('switch_controls_images', array());
			$template->assign_block_vars('switch_controls_text', array());

			if( !$prill_config['override_users'] )
			{
				$template->assign_block_vars('switch_controls_text.switch_prefs', array());
				$template->assign_block_vars('switch_controls_images.switch_prefs', array());
			}
			if( $prill_config['allow_mode_switch'] )
			{
				$template->assign_block_vars('switch_controls_images.switch_mode', array());
				$template->assign_block_vars('switch_controls_text.switch_mode', array());
			}
			break;
	}

	if( $client_mode == FRAMES_MODE )
	{
		$template->assign_block_vars('no_switch_copyright', array());
	}
}


function auto_prill_check()
// Checks various factors to see if the auto popup of the IM Client should
// be used. It would be better to accomplish it with JavaScript, but that
// doesn't seem to work even when I copy stuff straight from a tutorial.
// Returns either 1 (trigger the popup) or 0 (don't)
{
	global $db, $board_config, $phpEx, $im_userdata;

	// Does the user have the auto launch feature and IMs enabled?
	if( !$im_userdata['auto_launch'] || !$im_userdata['user_allow_ims'] || !$im_userdata['admin_allow_ims'] )
	{
		return 0;
	}

	// Auto launch should only be triggered on index.php
	// build a pattern url and check it against PHP_SELF
	$pattern_str = $board_config['script_path'];
	$position = strpos($board_config['script_path'], '/');
	if ( !is_integer($position) && $position != 0 )
	{
	    $pattern_str = '/' . $pattern_str;
	}

	$position = strrpos($board_config['script_path'], '/');
	if ( $position != strlen($board_config['script_path']) - 1 )
	{
	    $pattern_str .= '/';
	}

	$pattern_str = '#' . $pattern_str . 'index\.' . $phpEx . '#';
	$script_name_check = preg_match($pattern_str, $_SERVER['PHP_SELF']);

	if( !$script_name_check )
	{
		return 0;
	}

	// Final check - has the popup already been triggered in this IM session?
	$sql = 'SELECT session_popup FROM ' . IM_SESSIONS_TABLE . ' WHERE session_user_id=' . $im_userdata['user_id'];
	if( !$result = $db->sql_query($sql) )
	{
		return 0;
//		$message = 'Could not check messenger auto popup status';
//		message_die(GENERAL_ERROR, $msg, '', __LINE__, __FILE__, $sql);
	}

	$row = $db->sql_fetchrow($result);
	if( !$row['session_popup'] )
	{
		$sql = 'UPDATE ' . IM_SESSIONS_TABLE . ' SET session_popup=1 WHERE session_user_id=' . $im_userdata['user_id'];
		if( !$result = $db->sql_query($sql) )
		{
			$message = 'Could not add messenger auto popup status';
			message_die(GENERAL_ERROR, $msg, '', __LINE__, __FILE__, $sql);
		}

		return 1;
	}
	else
	{
		return 0;
	}
}

function delete_read_ims($user_id)
{
	global $db, $lang;

	$sql = 'SELECT privmsgs_id FROM ' . PRIVMSGS_TABLE . ' WHERE privmsgs_type = ' . IM_READ_MAIL . ' AND privmsgs_to_userid = ' . $user_id;

	if ( !$result = $db->sql_query($sql) )
	{
		$msg = 'Could not get list of read messages for deleting.' . $lang['Close_window_link'];
		message_die(GENERAL_ERROR, $msg, '', __LINE__, __FILE__, $sql);
	}
	$num_rows = $db->sql_numrows($result);
	if( !$num_rows )
	{
		return false; // No read messages to delete
	}
	$rows = $db->sql_fetchrowset($result);
	$db->sql_freeresult($result);
	$delete_sql_id = '';
	foreach($rows as $val)
	{
		$delete_sql_id .= (($delete_sql_id != '') ? ', ' : '') . $val['privmsgs_id'];
	}

	$delete_text_sql = 'DELETE FROM ' . PRIVMSGS_TEXT_TABLE . "
		WHERE privmsgs_text_id IN ($delete_sql_id)";
	$delete_sql = 'DELETE FROM ' . PRIVMSGS_TABLE . "
		WHERE privmsgs_id IN ($delete_sql_id)
			AND privmsgs_to_userid = " . $user_id;
	if ( !$db->sql_query($delete_sql, BEGIN_TRANSACTION) )
	{
		$msg = 'Could not delete read message info' . $lang['Close_window_link'];
		message_die(GENERAL_ERROR, $msg, '', __LINE__, __FILE__, $delete_sql);
	}
	if ( !$db->sql_query($delete_text_sql, END_TRANSACTION) )
	{
		$msg = 'Could not delete read message text' . $lang['Close_window_link'];
		message_die(GENERAL_ERROR, $msg, '', __LINE__, __FILE__, $delete_text_sql);
	}

	$sql = 'UPDATE ' . IM_PREFS_TABLE . ' SET read_ims = read_ims - ' . $num_rows . ' WHERE user_id = ' . $user_id;
	if ( !$db->sql_query($sql) )
	{
		$msg = 'Could not update read instant message number' . $lang['Close_window_link'];
		message_die(GENERAL_ERROR, $msg, '', __LINE__, __FILE__, $sql);
	}

	return $num_rows;
}

function get_prillian_config($no_err = false)
{
	global $db, $lang;

	$sql = 'SELECT * FROM ' . IM_CONFIG_TABLE;
	$result = $db->sql_query($sql, false, 'prillian_config');
	if( !$result && !$no_err )
	{
		message_die(CRITICAL_ERROR, $lang['No_prill_config'], '', __LINE__, __FILE__, $sql);
	}
	elseif( !$result )
	{
		return array();
	}

	$temp = array();
	while ( $row = $db->sql_fetchrow($result) )
	{
		$temp[$row['config_name']] = $row['config_value'];
	}
	$db->sql_freeresult($result);

	return $temp;
}

function exit_the_network($msg = '', $sql ='')
{
	global $db, $die_string;	

	$db->sql_close();
	$full_die_string = $die_string;
	if( !empty($msg) )
	{
		$full_die_string .= "\n" . $msg;
	}
	if( DEBUG_MODE && !empty($sql) )
	{
		$full_die_string .= "\n" . $sql;
	}
	if( $msg == 'no_msg' )
	{
		$full_die_string = '';
	}
	die($full_die_string);

}
?>