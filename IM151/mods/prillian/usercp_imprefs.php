<?php
/***************************************************************************
 *                            usercp_imprefs.php
 *                            -------------------
 *   begin                : Wednesday, Nov 22, 2002
 *   version              : 1.6.0
 *   date                 : 2003/12/23 23:25
 ***************************************************************************/

if ( !defined('IN_PHPBB') || !defined('IN_PRILLIAN') )
{
	die('Hacking attempt');
}

//
// Did the user submit? If so, let's build up a query to update the user's
// preferences in the database
//

// mode check
$client_mode = ( !empty($_REQUEST['cm1']) ) ? $_REQUEST['cm1'] : FRAMES_MODE;

// mode2 check - mode2 will be the window mode of the IM Client that is displayed
$client_mode2 = ( !empty($_REQUEST['cm2']) ) ? $_REQUEST['cm2'] : $im_userdata['current_mode'];

if ( isset($_REQUEST['submit']) )
{
	if ( $_REQUEST['user_id'] != $userdata['user_id'] )
	{
		$error = TRUE;
		$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Wrong_Profile'];
	}

	$vars = im_prepare_vars($_REQUEST, false);
	$current_sound_name = ( $vars['current_sound_name'] != $lang['None'] ) ? $vars['current_sound_name']: '';
	unset($vars['current_sound_name']);
	if( $vars['sound_name'] != $current_sound_name && !$vars['sound_name'] && $vars['play_sound'] )
	{
		$vars['sound_name'] = $current_sound_name;
	}

	if ( !$error )
	{
		$update_sql = '';
		reset($vars);
		while( list($var, $param) = @each($vars) )
		{
			$update_sql .= (( !empty($update_sql) ) ? ', ' : '') . $var . '=\'' . $param . '\'';
		}

		// User is in IM preferences table - UPDATE settings
		$sql = 'UPDATE ' . IM_PREFS_TABLE . '
				SET ' . $update_sql . '
				WHERE user_id = ' . $userdata['user_id'];

		if ( !($result = $db->sql_query($sql)) )
		{
			$msg = 'Could not update preferences table' . $lang['Close_window_link'];
			message_die(GENERAL_ERROR, $msg, '', __LINE__, __FILE__, $sql);
		}

		$message = sprintf($lang['Prillian_Profile_updated'], '<a href="' . append_sid("imclient.$phpEx?mode=$client_mode&mode2=$client_mode2") . '" target="prillian">', '</a>') . $lang['Close_window_link'];
		message_die(GENERAL_MESSAGE, $message);
	}
}
else
{
	$vars = im_prepare_vars($im_userdata, false);
	while( list($var, $param) = @each($vars) )
	{
		$$var = $param;
	}
}

//
// Basic preferences editor
//
$page_title = $lang['Preferences'];

$template->set_filenames(array(
	'prefs_tabs' => 'prillian/prefs_tabs.tpl')
);
$template->assign_vars(array(
	'U_IM_PATH' => PRILL_PATH)
);
$template->assign_var_from_handle('PREFS_TABS', 'prefs_tabs');
$template->assign_block_vars('prefs_tabs_bottom', array());

include_once(PRILL_PATH . 'prill_header.'.$phpEx);

if ( $error )
{
	$template->set_filenames(array(
		'reg_header' => 'error_body.tpl')
	);
	$template->assign_vars(array(
		'ERROR_MESSAGE' => $error_msg)
	);
	$template->assign_var_from_handle('ERROR_BOX', 'reg_header');
}

$template->set_filenames(array(
	'body' => 'prillian/prefs_body.tpl')
);

$s_hidden_fields = '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" /><input type="hidden" name="user_id" value="' . $userdata['user_id'] . '" /><input type="hidden" name="mode" value="editprofile" /><input type="hidden" name="cm1" value="' . $client_mode . '" /><input type="hidden" name="cm2" value="' . $client_mode2 . '" />';
$checked = 'checked="checked"';

if( $prill_config['refresh_drop'] )
{
	$refresh_rate = generic_select($refresh_rate, 'refresh_rate', 'Refresh_times');
	$rate_explain = $lang['Refresh_rate_explain2'];
}
else
{
	$refresh_rate = '<input type="text" size="5" maxlength="5" name="refresh_rate" value="' . $refresh_rate . '" />';
	$rate_explain = $lang['Refresh_rate_explain1'];
}

if( $prill_config['themes_allow'] )
{
	include_once($phpbb_root_path . 'includes/functions_selects.' . $phpEx);
	$template->assign_block_vars('switch_style', array(
		'L_IM_STYLE' => $lang['IM_style'],
		'STYLE_SELECT' => style_select($im_userdata['themes_id'], 'themes_id')
	));
}

if( $prill_config['allow_network'] )
{
	$template->assign_block_vars('switch_network', array(
		'L_ALLOW_NETWORK' => $lang['User_allow_network'],
		'ALLOW_NETWORK_YES' => ( $user_allow_network ) ? $checked : '',
		'ALLOW_NETWORK_NO' => ( !$user_allow_network ) ? $checked : ''
	));

	if( $im_userdata['user_allow_network'] && $im_userdata['admin_allow_network'] )
	{
		$network_user_list = generic_select($network_user_list, 'network_user_list', 'network_lists');
		$template->assign_block_vars('switch_networkusers', array(
			'L_NETWORK_USER_SELECT' => $lang['Network_user_list'],
			'NETWORK_USER_SELECT' => $network_user_list
		));
	}
}

if( $prill_config['allow_mode_switch'] )
{
	$template->assign_block_vars('mode_switch', array());
}

$show_controls = generic_select($show_controls, 'show_controls', 'Controls_select');
$list_all_online = generic_select($list_all_online, 'list_all_online', 'Online_Lists');
$default_mode = generic_select($default_mode, 'default_mode', 'Default_mode_select');

print_controls('?mode=' . $client_mode . '&mode2' . $client_mode2, $client_mode, $client_mode2);

$template->assign_vars(array(
	'IMG_LOGO' => $images['prill_logo'],
	'L_PRILLIAN' => $lang['Prillian'],

	'S_PREFS_ACTION' => append_sid(PRILL_URL),
	'S_HIDDEN_FIELDS' => $s_hidden_fields,

	'L_YES' => $lang['Yes'],
	'L_NO' => $lang['No'],
	'L_PREFS' => $lang['Preferences'],
	'L_ALLOW_IMS' => $lang['User_allow_ims'],
	'L_ALLOW_SHOUT' => $lang['User_allow_shout'],
	'L_ALLOW_CHAT' => $lang['User_allow_chat'],
	'L_ALWAYS_ADD_SIGNATURE' => $lang['Always_add_sig'],
	'L_ALWAYS_ADD_SIGNATURE_EXPLAIN' => $lang['Always_add_sig_explain'],
	'L_REFRESH_RATE' => $lang['Refresh_rate'],
	'L_REFRESH_RATE_EXPLAIN' => $rate_explain,
	'L_REFRESH_METHOD' => $lang['Refresh_method'],
	'L_REFRESH_METHOD_EXPLAIN' => $lang['Refresh_method_explain'],
	'L_JAVASCRIPT' => $lang['JavaScript'],
	'L_META' => $lang['META_tag'],
	'L_BOTH' => $lang['Use_both_methods'],
	'L_AUTO_LAUNCH' => $lang['IM_auto_launch_pref'],
	'L_POPUP_IMS' => $lang['IM_auto_popup'],
	'L_LIST_IMS' => $lang['IM_list_new'],
	'L_PLAY_SOUND' => $lang['IM_play_sound'],
	'L_SUCCESS_CLOSE' => $lang['Success_close'],
	'L_SHOW_CONTROLS' => $lang['Show_controls'],
	'L_WHO_TO_LIST' => $lang['Who_to_list'],
	'L_SUBMIT' => $lang['Submit'],
	'L_RESET' => $lang['Reset'],
	'L_SOUND_NAME' => $lang['IM_sound_name'],
	'L_DEFAULT_SOUND' => $lang['Default_sound'],
	'L_CURRENT_SOUND' => $lang['Current_sound'],
	'L_WIDTH' => $lang['Width'],
	'L_HEIGHT' => $lang['Height'],
	'L_SET_WINDOW_SIZES' => $lang['Set_window_sizes'],
	'L_SET_WINDOW_SIZES_EXPLAIN' => $lang['Set_window_sizes_explain'],
	'L_MAIN_WINDOW' => $lang['Main_Window'],
	'L_SEND_WINDOW' => $lang['Send_Message'],
	'L_READ_WINDOW' => $lang['Read_Message'],
	'L_WIDE_WINDOW' => $lang['Wide_Client_Window'],
	'L_AUTO_DELETE' => $lang['Auto_delete_ims'],
	'L_OPEN_PMS' => $lang['Open_pms'],
	'L_MINI_WINDOW' => $lang['Mini_Client_Window'],
	'L_USE_FRAMES' => $lang['Use_frames'],
	'L_USE_FRAMES_EXPLAIN' => $lang['Use_frames_explain'],
	'L_DEFAULT_MODE' => $lang['Default_mode'],

	'USE_FRAMES_YES' => ( $use_frames ) ? $checked : '',
	'USE_FRAMES_NO' => ( !$use_frames ) ? $checked : '',
	'OPEN_PMS_YES' => ( $open_pms ) ? $checked : '',
	'OPEN_PMS_NO' => ( !$open_pms ) ? $checked : '',
	'AUTO_DELETE_YES' => ( $auto_delete ) ? $checked : '',
	'AUTO_DELETE_NO' => ( !$auto_delete ) ? $checked : '',
	'ALLOW_IMS_YES' => ( $user_allow_ims ) ? $checked : '',
	'ALLOW_IMS_NO' => ( !$user_allow_ims ) ? $checked : '',
	'ALLOW_SHOUT_YES' => ( $user_allow_shout ) ? $checked : '',
	'ALLOW_SHOUT_NO' => ( !$user_allow_shout ) ? $checked : '',
	'ALLOW_CHAT_YES' => ( $user_allow_chat ) ? $checked : '',
	'ALLOW_CHAT_NO' => ( !$user_allow_chat ) ? $checked : '',
	'ALWAYS_ADD_SIGNATURE_YES' => ( $attach_sig ) ? $checked : '',
	'ALWAYS_ADD_SIGNATURE_NO' => ( !$attach_sig ) ? $checked : '',
	'REFRESH_RATE' => $refresh_rate,
	'REFRESH_METHOD_YES' => ( $refresh_method == 1 ) ? $checked : '',
	'REFRESH_METHOD_NO' => ( !$refresh_method ) ? $checked : '',
	'REFRESH_METHOD_BOTH' => ( $refresh_method == 2) ? $checked : '',
	'AUTO_LAUNCH_YES' => ( $auto_launch ) ? $checked : '',
	'AUTO_LAUNCH_NO' => ( !$auto_launch ) ? $checked : '',
	'POPUP_IMS_YES' => ( $popup_ims ) ? $checked : '',
	'POPUP_IMS_NO' => ( !$popup_ims ) ? $checked : '',
	'LIST_IMS_YES' => ( $list_ims ) ? $checked : '',
	'LIST_IMS_NO' => ( !$list_ims ) ? $checked : '',
	'PLAY_SOUND_YES' => ( $play_sound ) ? $checked : '',
	'PLAY_SOUND_NO' => ( !$play_sound ) ? $checked : '',
	'DEFAULT_SOUND_YES' => ( $default_sound ) ? $checked : '',
	'DEFAULT_SOUND_NO' => ( !$default_sound ) ? $checked : '',
	'SUCCESS_CLOSE_YES' => ( $success_close ) ? $checked : '',
	'SUCCESS_CLOSE_NO' => ( !$success_close ) ? $checked : '',
	'DEFAULT_MODE_SELECT' => $default_mode,
	'SHOW_CONTROLS' => $show_controls,
	'LIST_ALL_ONLINE' => $list_all_online,
	'NORMAL_HEIGHT' => $mode1_height,
	'NORMAL_WIDTH' => $mode1_width,
	'WIDE_HEIGHT' => $mode2_height,
	'WIDE_WIDTH' => $mode2_width,
	'MINI_HEIGHT' => $mode3_height,
	'MINI_WIDTH' => $mode3_width,
	'PREFS_HEIGHT' => $prefs_height,
	'PREFS_WIDTH' => $prefs_width,
	'READ_HEIGHT' => $read_height,
	'READ_WIDTH' => $read_width,
	'SEND_HEIGHT' => $send_height,
	'SEND_WIDTH' => $send_width,
	'SOUND_NAME' => ( !empty($sound_name) ) ? $sound_name: $lang['None']
));

?>