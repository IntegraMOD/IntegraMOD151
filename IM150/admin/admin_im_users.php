<?php
/***************************************************************************
 *                            admin_im_users.php
 *                            -------------------
 *   begin                : Saturday, Nov 30, 2002
 *   version              : 0.4.5
 *   date                 : 2003/12/23 23:20
 ***************************************************************************/

define('IN_PHPBB', 1);
define('IN_PRILLIAN', 1);

if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['Prillian']['User Admin'] = $filename;
	return;
}

if ( isset($_REQUEST['mode']) && $_REQUEST['mode'] == 'lookup' )
{
	$no_page_header = true;
}

$phpbb_root_path = './../';
require_once($phpbb_root_path . 'extension.inc');
require_once('./pagestart.' . $phpEx);
require_once(PRILL_PATH . 'prill_common.' . $phpEx);
require_once($phpbb_root_path . 'includes/bbcode.'.$phpEx);
require_once($phpbb_root_path . 'includes/functions_post.'.$phpEx);
require_once($phpbb_root_path . 'includes/functions_selects.'.$phpEx);
require_once($phpbb_root_path . 'includes/functions_validate.'.$phpEx);

$html_entities_match = array('#<#', '#>#');
$html_entities_replace = array('&lt;', '&gt;');

$mode = ( isset( $_REQUEST['mode']) ) ? $_REQUEST['mode'] : '';

//
// Begin program
//
if( $mode == 'edit' || $mode == 'save' && isset($_REQUEST['submit']) && (  isset($_REQUEST['username']) || isset($_REQUEST[POST_USERS_URL]) ) )
{

	if( isset($_REQUEST[POST_USERS_URL]) )
	{
		$user_id = intval( $_REQUEST[POST_USERS_URL] );
		$this_userdata = get_userdata($user_id);
		if( !$this_userdata )
		{
			message_die(GENERAL_MESSAGE, $lang['No_user_id_specified'] );
		}
	}
	elseif( isset($_REQUEST['username']) )
	{
		$this_userdata = get_userdata( $_REQUEST['username'] );
		if( !$this_userdata )
		{
			message_die(GENERAL_MESSAGE, $lang['No_user_id_specified'] );
		}
	}
	else
	{
		message_die(GENERAL_MESSAGE, $lang['No_user_id_specified'] );
	}

	// Get user's current IM preferences
	$im_userdata = array();
	$im_userdata = init_imprefs($this_userdata['user_id']);

	if( isset( $_REQUEST['submit'] ) )
	{
		$vars = im_prepare_vars($_REQUEST);
		$current_sound_name = ( $vars['current_sound_name'] != $lang['None'] ) ? $vars['current_sound_name']: '';
		unset($vars['current_sound_name']);
		if( $vars['sound_name'] != $current_sound_name && !$vars['sound_name'] && $vars['play_sound'] )
		{
			$vars['sound_name'] = $current_sound_name;
		}
	
		$update_sql = '';
		foreach($vars as $var=>$param)
		{
			$update_sql .= (( !empty($update_sql) ) ? ', ' : '') . $var . '=\'' . $param . '\'';
		}

		// User is in IM preferences table - UPDATE settings
		$sql = 'UPDATE ' . IM_PREFS_TABLE . ' SET ' . $update_sql . ' WHERE user_id = ' . $this_userdata['user_id'];

		if ( !$result = $db->sql_query($sql) )
		{
			$msg = 'Could not update preferences table';
			message_die(GENERAL_ERROR, $msg, '', __LINE__, __FILE__, $sql);
		}

		$message = $lang['Admin_user_updated'];
		$message .= '<br /><br />' . sprintf($lang['Click_return_useradmin'], '<a href="' . append_sid("admin_im_users.$phpEx") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid("index.$phpEx?pane=right") . '">', '</a>');

		message_die(GENERAL_MESSAGE, $message);
	}
	else
	{
		$vars = im_prepare_vars($im_userdata);
		foreach($vars as $var=>$param)
		{
			$$var = $param;
		}
	}

	$s_hidden_fields = '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" /><input type="hidden" name="mode" value="save" /><input type="hidden" name="' . POST_USERS_URL . '" value="' . $this_userdata['user_id'] . '" />';

	$show_controls = generic_select($show_controls, 'show_controls', 'Controls_select');
	$list_all_online = generic_select($list_all_online, 'list_all_online', 'Online_Lists');
	$network_user_list = generic_select($network_user_list, 'network_user_list', 'network_lists');
	$default_mode = generic_select($default_mode, 'default_mode', 'Default_mode_select');
	$checked = 'checked="checked"';

	$template->set_filenames(array(
		'body' => 'admin/imclient_user_body.tpl')
	);
	$template->assign_vars(array(
		'S_PREFS_ACTION' => append_sid('admin_im_users.'.$phpEx),
		'S_HIDDEN_FIELDS' => $s_hidden_fields,

		'L_YES' => $lang['Yes'],
		'L_NO' => $lang['No'],
		'L_PRILLIAN' => $lang['Prillian'],
		'L_PREFS' => $lang['Preferences'],
		'L_ALLOW_IMS' => $lang['Admin_allow_ims'],
		'L_ALLOW_SHOUT' => $lang['Admin_allow_shout'],
		'L_ALLOW_CHAT' => $lang['Admin_allow_chat'],
		'L_ALWAYS_ADD_SIGNATURE' => $lang['Always_add_sig'],
		'L_ALWAYS_ADD_SIGNATURE_EXPLAIN' => $lang['Always_add_sig_explain'],
		'L_REFRESH_RATE' => $lang['Refresh_rate'],
		'L_REFRESH_RATE_EXPLAIN' => $lang['Refresh_rate_explain1'],
		'L_REFRESH_METHOD' => $lang['Refresh_method'],
		'L_REFRESH_METHOD_EXPLAIN' => $lang['Refresh_method_explain'],
		'L_JAVASCRIPT' => $lang['JavaScript'],
		'L_META' => $lang['META_tag'],
		'L_BOTH' => $lang['Use_both_methods'],
		'L_AUTO_LAUNCH' => $lang['IM_user_auto_launch'],
		'L_POPUP_IMS' => $lang['IM_auto_popup'],
		'L_LIST_IMS' => $lang['IM_list_new'],
		'L_SUCCESS_CLOSE' => $lang['Success_close'],
		'L_SHOW_CONTROLS' => $lang['Show_controls'],
		'L_WHO_TO_LIST' => $lang['Who_to_list'],
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
		'L_SUBMIT' => $lang['Submit'],
		'L_RESET' => $lang['Reset'],
		'L_PLAY_SOUND' => $lang['IM_play_sound'],
		'L_DEFAULT_SOUND' => $lang['Default_sound'],
		'L_SOUND_NAME' => $lang['IM_sound_name'],
		'L_IM_STYLE' => $lang['IM_style'],
		'L_ALLOW_NETWORK' => $lang['Admin_allow_network'],
		'L_NETWORK_USER_SELECT' => $lang['Network_user_list'],
		'L_MINI_WINDOW' => $lang['Mini_Client_Window'],
		'L_USE_FRAMES' => $lang['Use_frames'],
		'L_USE_FRAMES_EXPLAIN' => $lang['Use_frames_explain'],
		'L_DEFAULT_MODE' => $lang['Default_mode'],

		'NETWORK_USER_SELECT' => $network_user_list,
		'STYLE_SELECT' => style_select($im_userdata['themes_id'], 'themes_id'),
		'OPEN_PMS_YES' => ( $open_pms ) ? $checked : '',
		'OPEN_PMS_NO' => ( !$open_pms ) ? $checked : '',
		'AUTO_DELETE_YES' => ( $auto_delete ) ? $checked : '',
		'AUTO_DELETE_NO' => ( !$auto_delete ) ? $checked : '',
		'ALLOW_NETWORK_YES' => ( $admin_allow_network ) ? $checked : '',
		'ALLOW_NETWORK_NO' => ( !$admin_allow_network ) ? $checked : '',
		'ALLOW_IMS_YES' => ( $admin_allow_ims ) ? $checked : '',
		'ALLOW_IMS_NO' => ( !$admin_allow_ims ) ? $checked : '',
		'ALLOW_SHOUT_YES' => ( $admin_allow_shout ) ? $checked : '',
		'ALLOW_SHOUT_NO' => ( !$admin_allow_shout ) ? $checked : '',
		'ALLOW_CHAT_YES' => ( $admin_allow_chat ) ? $checked : '',
		'ALLOW_CHAT_NO' => ( !$admin_allow_chat ) ? $checked : '',
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
		'USE_FRAMES_YES' => ( $use_frames ) ? $checked : '',
		'USE_FRAMES_NO' => ( !$use_frames ) ? $checked : '',
		'DEFAULT_MODE_SELECT' => $default_mode,
		'SHOW_CONTROLS' => $show_controls,
		'LIST_ALL_ONLINE' => $list_all_online,
		'MODE1_HEIGHT' => $mode1_height,
		'MODE1_WIDTH' => $mode1_width,
		'MODE2_HEIGHT' => $mode2_height,
		'MODE2_WIDTH' => $mode2_width,
		'MODE3_HEIGHT' => $mode3_height,
		'MODE3_WIDTH' => $mode3_width,
		'PREFS_HEIGHT' => $prefs_height,
		'PREFS_WIDTH' => $prefs_width,
		'READ_HEIGHT' => $read_height,
		'READ_WIDTH' => $read_width,
		'SEND_HEIGHT' => $send_height,
		'SEND_WIDTH' => $send_width,
		'SOUND_NAME' => ( !empty($sound_name) ) ? $sound_name: $lang['None']
	));
}
else if ( $mode == 'lookup' )
{
	//
	// Lookup user
	//
	$username = ( !empty($_REQUEST['username']) ) ? str_replace('%', '%%', trim(strip_tags( $_REQUEST['username'] ) )) : '';
	$email = ( !empty($_REQUEST['email']) ) ? trim(strip_tags(htmlspecialchars( $_REQUEST['email'] ) )) : '';
	$posts = ( !empty($_REQUEST['posts']) ) ? intval(trim(strip_tags( $_REQUEST['posts'] ) )) : '';
	$joined = ( !empty($_REQUEST['joined']) ) ? trim(strtotime( $_REQUEST['joined'] ) ) : 0;

	$sql_where = ( !empty($username) ) ? 'u.username LIKE "%' . str_replace("\'", "''", $username) . '%"' : '';
	$sql_where .= ( !empty($email) ) ? ( ( !empty($sql_where) ) ? ' AND u.user_email LIKE "%' . $email . '%"' : 'u.user_email LIKE "%' . $email . '%"' ) : '';
	$sql_where .= ( !empty($posts) ) ? ( ( !empty($sql_where) ) ? ' AND u.user_posts >= ' . $posts : 'u.user_posts >= ' . $posts ) : '';
	$sql_where .= ( $joined ) ? ( ( !empty($sql_where) ) ? ' AND u.user_regdate >= ' . $joined : 'u.user_regdate >= ' . $joined ) : '';

	if ( !empty($sql_where) )
	{
		$sql = "SELECT u.user_id, u.username, u.user_email, u.user_posts, u.user_active, u.user_regdate
			FROM " . USERS_TABLE . " u
			WHERE $sql_where
			ORDER BY u.username ASC";

		if ( !( $result = $db->sql_query($sql) ) )
		{
			message_die(GENERAL_ERROR, 'Unable to query users', '', __LINE__, __FILE__, $sql);
		}
		else if ( !$db->sql_numrows($result) )
		{
			$message = $lang['No_user_id_specified'];
			$message .= '<br /><br />' . sprintf($lang['Click_return_useradmin'], '<a href="' . append_sid("admin_im_users.$phpEx") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid("index.$phpEx?pane=right") . '">', '</a>');
			message_die(GENERAL_MESSAGE, $message);
		}
		else if ( $db->sql_numrows($result) == 1 )
		{
			// Redirect to this user
			$row = $db->sql_fetchrow($result);

			$template->assign_vars(array(
				"META" => '<meta http-equiv="refresh" content="3;url=' . append_sid("admin_im_users.$phpEx?mode=edit&" . POST_USERS_URL . "=" . $row['user_id']) . '">')
			);

			$message .= $lang['One_user_found'];
			$message .= '<br /><br />' . sprintf($lang['Click_goto_prefs'], '<a href="' . append_sid("admin_im_users.$phpEx?mode=edit&" . POST_USERS_URL . "=" . $row['user_id']) . '">', '</a>');

			message_die(GENERAL_MESSAGE, $message);
		}
		else
		{
			// Show select screen
			include('page_header_admin.'.$phpEx);

			$template->set_filenames(array(
				'body' => 'admin/imclient_lookup_body.tpl')
			);

			$template->assign_vars(array(
				'L_USERNAME' => $lang['Username'],
				'L_USER_TITLE' => $lang['User_admin'],
				'L_POSTS' => $lang['Posts'],
				'L_JOINED' => $lang['Sort_Joined'],
				'L_USER_EXPLAIN' => $lang['User_admin_explain'],
				'L_ACTIVE' => $lang['User_status'],
				'L_EMAIL_ADDRESS' => $lang['Email_address'])
			);

			$i = 0;
			while ( $row = $db->sql_fetchrow($result) )
			{
				$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
				$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

				$template->assign_block_vars('user_row', array(
					'ROW_COLOR' => '#' . $row_color,
					'ROW_CLASS' => $row_class,
					'USERNAME' => $row['username'],
					'EMAIL' => $row['user_email'],
					'POSTS' => $row['user_posts'],
					'ACTIVE' => ( $row['user_active'] ) ? $lang['Yes'] : $lang['No'],
					'JOINED' => create_date($lang['DATE_FORMAT'], $row['user_regdate'], $board_config['board_timezone']),

					'U_USERNAME' => append_sid("admin_im_users.$phpEx?mode=edit&" . POST_USERS_URL . '=' . $row['user_id']))
				);

				$i++;
			}
		}
	}
	else
	{
		$message = $lang['No_user_id_specified'];
		$message .= '<br /><br />' . sprintf($lang['Click_return_useradmin'], '<a href="' . append_sid("admin_im_users.$phpEx") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid("index.$phpEx?pane=right") . '">', '</a>');
		message_die(GENERAL_MESSAGE, $message);
	}
}
else
{
	//
	// Default user selection box
	//
	$template->set_filenames(array(
		'body' => 'admin/imclient_select_body.tpl')
	);

	$template->assign_vars(array(
		'L_USER_TITLE' => $lang['User_admin'],
		'L_USER_EXPLAIN' => $lang['User_admin_explain'],
		'L_USER_SELECT' => $lang['Select_a_User'],
		'L_LOOK_UP' => $lang['Look_up_user'],
		'L_FIND_USERNAME' => $lang['Find_username'],
		'L_USERNAME' => $lang['Username'],
		'L_POSTS' => $lang['Posts'],
		'L_JOINED' => $lang['Sort_Joined'],
		'L_ACTIVE' => $lang['User_status'],

		'L_USER_LOOKUP_EXPLAIN' => $lang['User_lookup_explain'],
		'L_EMAIL_ADDRESS' => $lang['Email_address'],
		'L_JOINED_EXPLAIN' => $lang['User_joined_explain'],

		'U_SEARCH_USER' => append_sid($phpbb_root_path . "search.$phpEx?mode=searchuser"), 

		'S_USER_ACTION' => append_sid('admin_im_users.'.$phpEx),
		'S_USER_SELECT' => $select_list)
	);
}

$template->pparse('body');
include('./page_footer_admin.'.$phpEx);

?>