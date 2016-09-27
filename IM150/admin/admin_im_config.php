<?php
/***************************************************************************
 *                            admin_im_config.php
 *                            -------------------
 *   begin                : Thursday, Jan 23, 2003
 *   version              : 0.4.0
 *   date                 : 2003/12/23 23:20
 ***************************************************************************/

define('IN_PHPBB', 1);

if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['Prillian']['Configuration'] = "$file?mode=config";
	return;
}

define('IN_PRILLIAN', 1);
$phpbb_root_path = './../';
require_once($phpbb_root_path . 'extension.inc');
require_once('./pagestart.' . $phpEx);
require_once($phpbb_root_path . 'includes/bbcode.'.$phpEx);
require_once($phpbb_root_path . 'includes/functions_post.'.$phpEx);
require_once($phpbb_root_path . 'includes/functions_selects.'.$phpEx);
require_once($phpbb_root_path . 'includes/functions_validate.'.$phpEx);
require_once(PRILL_PATH . 'functions_im.'.$phpEx);
include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_prillian.' . $phpEx);

$admin_defaults = array(
	'refresh_rate' => '60',
	'flood_interval' => '15',
	'success_close' => '1',
	'refresh_method' => '2',
	'auto_launch' => '0',
	'popup_ims' => '1',
	'list_ims' => '0',
	'mode1_height' => '400',
	'mode1_width' => '225',
	'mode2_height' => '225',
	'mode2_width' => '400',
	'mode3_height' => '225',
	'mode3_width' => '400',
	'read_height' => '225',
	'read_width' => '400',
	'send_height' => '365',
	'send_width' => '460',
	'list_all_online' => '1',
	'show_controls' => '1',
	'allow_ims' => '1',
	'allow_shout' => '1',
	'allow_chat' => '1',
	'override_users' => '0',
	'enable_flood' => '1',
	'box_limit' => '25',
	'refresh_drop' => '1',
	'play_sound' => '1',
	'sound_name' => '',
	'default_sound' => '0',
	'themes_allow' => '1',
	'themes_id' => '1',
	'allow_network' => '1',
	'session_length' => '120',
	'enable_im_limit' => '1',
	'auto_delete' => '1',
	'open_pms' => '0',
	'network_user_list' => '1',
	'prefs_height' => '350',
	'prefs_width' => '500',
	'use_frames' => '1',
	'default_mode' => '1',
	'network_profile' => 'profile',
	'allow_mode_switch' => '1',
	'version' => '0.7.0'
);

// Ensure that all config variables are properly installed.
$sql = array();
$prill_config = get_prillian_config();
foreach($admin_defaults as $var=>$param)
{
	$pos_num = false;
	if( array_key_exists($var, $prill_config) )
	{
		// Variable is already installed, we update it
		$config_name = $var;
		if( isset($_REQUEST[$var]) )
		{
			$new[$var] = $_REQUEST[$var];
			$sql[] = 'UPDATE ' . IM_CONFIG_TABLE . " SET config_value = '" . str_replace("\'", "''", $new[$var]) . "' WHERE config_name = '$var'";
		}
		else
		{
			$new[$var] = $prill_config[$var];
		}
	}
	else
	{
		$new[$var] = ( isset($_REQUEST[$var]) ) ? $_REQUEST[$var] : $param;
		$sql[] = 'INSERT INTO ' . IM_CONFIG_TABLE . ' (config_name, config_value) VALUES (\'' . $var . '\', \'' . str_replace("\'", "''", $new[$var]) . '\')';
	}
}

if( isset($_REQUEST['submit']) && !empty($sql) )
{
	foreach($sql as $val)
	{
		if( !$db->sql_query($val) )
		{
			message_die(GENERAL_ERROR, 'Failed to update general configuration', '', __LINE__, __FILE__, $val);
		}
	}
	$message = $lang['Config_updated'] . '<br /><br />' . sprintf($lang['Click_return_config'], '<a href="' . append_sid("admin_im_config.$phpEx") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid("index.$phpEx?pane=right") . '">', '</a>');
	message_die(GENERAL_MESSAGE, $message);
}

$template->set_filenames(array(
	'body' => 'admin/imclient_admin_config.tpl')
);

$checked = 'checked="checked"';
$skip = array('show_controls', 'list_all_online', 'refresh_method', 'network_user_list', 'themes_id', 'refresh_rate', 'session_length', 'flood_interval', 'box_limit', 'mode1_height', 'mode1_width', 'mode2_height', 'mode2_width', 'mode3_height', 'mode3_width', 'read_height', 'read_width', 'send_height', 'send_width', 'sound_name', 'prefs_height', 'prefs_width', 'default_mode', 'network_profile');

$default_mode = generic_select($new['default_mode'], 'default_mode', 'Default_mode_select');
$show_controls = generic_select($new['show_controls'], 'show_controls', 'Controls_select');
$list_all_online = generic_select($new['list_all_online'], 'list_all_online', 'Online_Lists');
$network_user_list = generic_select($new['network_user_list'], 'network_user_list', 'network_lists');
$style_select = style_select($new['themes_id'], 'themes_id');
$refresh_method_both = ( $new['refresh_method'] == 2 ) ? $checked : '';
$refresh_method_yes = ( $new['refresh_method'] == 1 ) ? $checked : '';
$refresh_method_no = ( !$new['refresh_method'] ) ? $checked : '';
$vars = array();

foreach($new as $key=>$val)
{
	if( !in_array($key, $skip) )
	{
		$vars[strtoupper($key) . '_YES'] = ($val) ? $checked: '';
		$vars[strtoupper($key) . '_NO'] = (!$val) ? $checked: '';
	}
}
$skip = array_slice($skip, 5);
foreach($skip as $val)
{
	$vars[strtoupper($val)] = $new[$val];
}

$template->assign_vars($vars);
$template->assign_vars(array(
	'S_CONFIG_ACTION' => append_sid('admin_im_config.'.$phpEx),

	'L_YES' => $lang['Yes'],
	'L_NO' => $lang['No'],
	'L_SUBMIT' => $lang['Submit'],
	'L_RESET' => $lang['Reset'],
	'L_CONFIGURATION_TITLE' => $lang['Prillian_Config'],
	'L_CONFIGURATION_EXPLAIN' => $lang['Prillian_Config_explain'],
	'L_PRILLIAN' => $lang['Prillian'],
	'PRILLIAN_VERSION' => $prill_config['version'],
	'L_PREFS' => $lang['Preferences'],
	'L_FLOOD_INTERVAL' => $lang['Flood_Interval'],
	'L_FLOOD_INTERVAL_EXPLAIN' => $lang['Flood_Interval_explain'],
	'L_REFRESH_RATE' => $lang['Refresh_rate'],
	'L_REFRESH_RATE_EXPLAIN' => $lang['Refresh_rate_explain'],
	'L_SUCCESS_CLOSE' => $lang['Success_close'],
	'L_REFRESH_METHOD' => $lang['Refresh_method'],
	'L_REFRESH_METHOD_EXPLAIN' => $lang['Refresh_method_explain'],
	'L_JAVASCRIPT' => $lang['JavaScript'],
	'L_META' => $lang['META_tag'],
	'L_BOTH' => $lang['Use_both_methods'],
	'L_AUTO_LAUNCH' => $lang['IM_auto_launch'],
	'L_POPUP_IMS' => $lang['IM_auto_popup'],
	'L_LIST_IMS' => $lang['IM_list_new'],
	'L_WIDTH' => $lang['Width'],
	'L_HEIGHT' => $lang['Height'],
	'L_SET_WINDOW_SIZES' => $lang['Admin_Set_window_sizes'],
	'L_SET_WINDOW_SIZES_EXPLAIN' => $lang['Set_window_sizes_explain'],
	'L_MAIN_WINDOW' => $lang['Main_Window'],
	'L_SEND_WINDOW' => $lang['Send_Message'],
	'L_READ_WINDOW' => $lang['Read_Message'],
	'L_WIDE_WINDOW' => $lang['Wide_Client_Window'],
	'L_MINI_WINDOW' => $lang['Mini_Client_Window'],
	'L_DEFAULT_MODE' => $lang['Default_mode'],
	'L_USE_FRAMES' => $lang['Use_frames'],
	'L_USE_FRAMES_EXPLAIN' => $lang['Use_frames_explain_admin'],
	'L_BOX_LIMIT' => $lang['IM_box_limit'],
	'L_ENABLE_FLOOD' => $lang['IM_enable_flood'],
	'L_OVERRIDE_USERS' => $lang['IM_override_settings'],
	'L_OVERRIDE_USERS_EXPLAIN' => $lang['IM_override_settings_explain'],
	'L_ALLOW_IMS' => $lang['IM_enable_ims'],
	'L_ALLOW_SHOUT' => $lang['IM_enable_shoutbox'],
	'L_ALLOW_CHAT' => $lang['IM_enable_chatbox'],
	'L_WHO_TO_LIST' => $lang['Who_to_list'],
	'L_ALL_ONLINE' => $lang['All_online'],
	'L_BUDDIES_BOARD' => $lang['Buddies_on_board'],
	'L_BUDDIES_IM' => $lang['Buddies_on_im'],
	'L_SHOW_CONTROLS' => $lang['Show_controls'],
	'L_REFRESH_DROP' => $lang['IM_refresh_drop'],
	'L_PLAY_SOUND' => $lang['IM_play_sound'],
	'L_SOUND_NAME' => $lang['IM_sound_name'],
	'L_DEFAULT_SOUND' => $lang['IM_default_sound'],
	'L_STYLE' => $lang['IM_style'],
	'L_STYLE_ALLOW' => $lang['IM_allow_different_style'],
	'L_ALLOW_NETWORK' => $lang['IM_allow_network'],
	'L_SESS_LEN' => $lang['IM_session_length'],
	'L_SESS_LEN_EXPLAIN' => $lang['IM_session_length_explain'],
	'L_OPEN_PMS' => $lang['Open_pms'],
	'L_AUTO_DEL' => $lang['Auto_delete_ims'],
	'L_ENABLE_LIMIT' => $lang['IM_enable_imbox_limit'],
	'L_NETWORK_USER_SELECT' => $lang['Network_user_list'],
	'L_NETWORK_PROFILE' => $lang['Profile_path'],
	'L_NETWORK_PROFILE_EXPLAIN' => $lang['Profile_path_ex_expanded'],
	'L_ALLOW_MODE_SWITCH' => $lang['Allow_mode_switch'],

	'DEFAULT_MODE_SELECT' => $default_mode,
	'NETWORK_USER_SELECT' => $network_user_list,
	'LIST_ALL_ONLINE' => $list_all_online,
	'SHOW_CONTROLS' => $show_controls,
	'STYLE_SELECT' => $style_select,
	'REFRESH_METHOD_YES' => $refresh_method_yes,
	'REFRESH_METHOD_NO' => $refresh_method_no,
	'REFRESH_METHOD_BOTH' => $refresh_method_both
));

$template->pparse('body');


include('./page_footer_admin.'.$phpEx);

?>