<?php
/***************************************************************************
 *                              admin_board.php
 *                            -------------------
 *   begin                : Thursday, Jul 12, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *
 *
 ***************************************************************************/

define('IN_PHPBB', 1);
define('CT_SECLEVEL', 'MEDIUM');
$ct_ignorepvar = array('cookie_name');
if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['General']['Configuration'] = $file;
	return;
}

//
// Let's set the root dir for phpBB
//
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
include($phpbb_root_path.'language/lang_' . $board_config['default_lang'] . '/lang_admin_board.'.$phpEx);
include($phpbb_root_path . 'includes/functions_selects.'.$phpEx);

// Start add - Signatures control MOD
if ( !file_exists(@phpbb_realpath($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_sig_control.' . $phpEx)) ) 
{ 
	include($phpbb_root_path . 'language/lang_english/lang_sig_control.' . $phpEx); 
} else 
{ 
	include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_sig_control.' . $phpEx); 
} 
// End add - Signatures control MOD
//
// Pull all config data
//
$sql = "SELECT *
	FROM " . CONFIG_TABLE;
if(!$result = $db->sql_query($sql))
{
	message_die(CRITICAL_ERROR, "Could not query config information in admin_board", "", __LINE__, __FILE__, $sql);
}
else
{
	// CrackerTracker v5.x
	if ( isset($_POST['submit']) && $ctracker_config->settings['detect_misconfiguration'] == 1 )
	{
		// Let's detect some things of misconfiguration
		if ( $_POST['server_port'] == '21' )
		{
			// FTP Port Misstake
			message_die(GENERAL_MESSAGE, $lang['ctracker_gmb_pu_1']);
		}

		if ( $_POST['session_length'] < '100' )
		{
			// Session Length Error
			message_die(GENERAL_MESSAGE, $lang['ctracker_gmb_pu_2']);
		}
		
		if ( !preg_match('/\\A\/$|\\A\/.*\/$/', $_POST['script_path']) )
		{
			// Skript Path Error
			message_die(GENERAL_MESSAGE, $lang['ctracker_gmb_pu_3']);
		}
		
		if ( preg_match('/\/$/', $_POST['server_name']) )
		{
			// Server Name Error
			message_die(GENERAL_MESSAGE, $lang['ctracker_gmb_pu_4']);
		}
	}

	if ( isset($_POST['submit']) && $ctracker_config->settings['auto_recovery'] == 1 )
	{
		define('CTRACKER_ACP', true);
		include_once($phpbb_root_path . 'ctracker/classes/class_ct_adminfunctions.' . $phpEx);
		$backup_system = new ct_adminfunctions();
		$backup_system->recover_configuration();
		unset($backup_system);
	}
	while( $row = $db->sql_fetchrow($result) )
	{
		$config_name = $row['config_name'];
		$config_value = $row['config_value'];
		$default_config[$config_name] = isset($_POST['submit']) ? str_replace("'", "\'", $config_value) : $config_value;
		
		$new[$config_name] = ( isset($_POST[$config_name]) ) ? $_POST[$config_name] : $default_config[$config_name];

		if ($config_name == 'cookie_name')
		{
			$new['cookie_name'] = str_replace('.', '_', $new['cookie_name']);
		}

		// Attempt to prevent a common mistake with this value,
		// http:// is the protocol and not part of the server name
		if ($config_name == 'server_name')
		{
			$new['server_name'] = str_replace('http://', '', $new['server_name']);
		}

		// Attempt to prevent a mistake with this value.
		if ($config_name == 'avatar_path')
		{
			$new['avatar_path'] = trim($new['avatar_path']);
			if (strstr($new['avatar_path'], "\0") || !is_dir($phpbb_root_path . $new['avatar_path']) || !is_writable($phpbb_root_path . $new['avatar_path']))
			{
				$new['avatar_path'] = $default_config['avatar_path'];
			}
		}

		if( isset($_POST['submit']) && ($config_name != 'default_style_over'))
		{
// Start add - Signatures control MOD
$new['sig_allow_bold'] = ( htmlspecialchars($_POST['sig_allow_bold']) ) ? 1 : 0;
$new['sig_allow_italic'] = ( htmlspecialchars($_POST['sig_allow_italic']) ) ? 1 : 0;
$new['sig_allow_underline'] = ( htmlspecialchars($_POST['sig_allow_underline']) ) ? 1 : 0;
$new['sig_allow_colors'] = ( htmlspecialchars($_POST['sig_allow_colors']) ) ? 1 : 0;
$new['sig_allow_quote'] = ( htmlspecialchars($_POST['sig_allow_quote']) ) ? 1 : 0;
$new['sig_allow_code'] = ( htmlspecialchars($_POST['sig_allow_code']) ) ? 1 : 0;
$new['sig_allow_list'] = ( htmlspecialchars($_POST['sig_allow_list']) ) ? 1 : 0;
$new['sig_allow_on_max_img_size_fail'] = ( htmlspecialchars($_POST['sig_allow_on_max_img_size_fail']) ) ? 1 : 0;

$sig_config_error_list .= ( eregi("[^0-9]", htmlspecialchars($_POST['max_sig_chars'])) ) ? '<br />' . $lang['Max_sig_length'] : '' ;
$sig_config_error_list .= ( eregi("[^0-9]", htmlspecialchars($_POST['sig_max_lines'])) ) ? '<br />' . $lang['sig_max_lines'] : '' ;
$sig_config_error_list .= ( eregi("[^0-9]", htmlspecialchars($_POST['sig_wordwrap'])) ) ? '<br />' . $lang['sig_wordwrap'] : '' ;
$sig_config_error_list .= ( eregi("[^0-9]", htmlspecialchars($_POST['sig_min_font_size'])) || htmlspecialchars($_POST['sig_min_font_size'])>29 || eregi("[^0-9]", htmlspecialchars($_POST['sig_max_font_size'])) || htmlspecialchars($_POST['sig_max_font_size'])>29 ) ? '<br />' . $lang['sig_font_size_limit'] : '' ;
$sig_config_error_list .= ( eregi("[^0-9]", htmlspecialchars($_POST['sig_max_images'])) ) ? '<br />' . $lang['sig_max_images'] : '' ;
$sig_config_error_list .= ( eregi("[^0-9]", htmlspecialchars($_POST['sig_max_img_height'])) || eregi("[^0-9]", htmlspecialchars($_POST['sig_max_img_width'])) ) ? '<br />' . $lang['sig_max_img_size'] : '' ;
$sig_config_error_list .= ( eregi("[^0-9]", htmlspecialchars($_POST['sig_max_img_files_size'])) ) ? '<br />' . $lang['sig_max_img_files_size'] : '' ;
$sig_config_error_list .= ( eregi("[^0-9]", htmlspecialchars($_POST['sig_max_img_av_files_size'])) ) ? '<br />' . $lang['sig_max_img_av_files_size'] : '' ;

if ( $sig_config_error_list != '' )
{
	message_die(GENERAL_MESSAGE, $lang['sig_config_error'] . '<br /><br />' . $lang['sig_config_error_int'] . $sig_config_error_list . "<br /><br />" . sprintf($lang['Click_return_config'], "<a href=\"" . append_sid("admin_board.$phpEx") . "\">", "</a>"));
}

if ( htmlspecialchars($_POST['sig_min_font_size']) >= htmlspecialchars($_POST['sig_max_font_size']) && htmlspecialchars($_POST['sig_max_font_size']) != 0 )
{
	message_die(GENERAL_MESSAGE, $lang['sig_config_error'] . '<br /><br />' . sprintf($lang['sig_config_error_min_max'], htmlspecialchars($_POST['sig_min_font_size']), htmlspecialchars($_POST['sig_max_font_size'])) . "<br /><br />" . sprintf($lang['Click_return_config'], "<a href=\"" . append_sid("admin_board.$phpEx") . "\">", "</a>"));
}

if ( htmlspecialchars($_POST['sig_allow_font_sizes']) == 0 && htmlspecialchars($_POST['sig_max_font_size']) < 7 && htmlspecialchars($_POST['sig_max_font_size']) > 29 )
{
	message_die(GENERAL_MESSAGE, $lang['sig_config_error'] . '<br /><br />' . sprintf($lang['sig_config_error_imposed'], htmlspecialchars($_POST['sig_max_font_size'])) . "<br /><br />" . sprintf($lang['Click_return_config'], "<a href=\"" . append_sid("admin_board.$phpEx") . "\">", "</a>"));
}
// End add - Signatures control MOD
			$sql = "UPDATE " . CONFIG_TABLE . " SET
				config_value = '" . str_replace("\'", "''", $new[$config_name]) . "'
				WHERE config_name = '$config_name'";
			if( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Failed to update general configuration for $config_name", "", __LINE__, __FILE__, $sql);
			}
			if($config_name == 'override_user_style')
			{
				$sql = "UPDATE " . CONFIG_TABLE . " SET
					config_value = '" . str_replace("\'", "''", $new[$config_name]) . "'
					WHERE config_name = 'default_style_over'";
				if( !$db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, "Failed to update general configuration for $config_name", "", __LINE__, __FILE__, $sql);
				}
			}
		}
	}

	if( isset($_POST['submit']) )
	{
		$message = $lang['Config_updated'] . "<br /><br />" . sprintf($lang['Click_return_config'], "<a href=\"" . append_sid("admin_board.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

		message_die(GENERAL_MESSAGE, $message);
	}
}
// Logo Selector MOD
// Get all images in the logo directory
$dir = @opendir($phpbb_root_path . $new['logo_image_path']);
$count = 0;
while( $file = @readdir($dir) )
{
	if( !@is_dir(phpbb_realpath($phpbb_root_path . $new['logo_image_path'] . '/' . $file)) )
	{
		if( preg_match('/(\.gif$|\.png$|\.jpg|\.jpeg)$/is', $file) )
		{
			$logo[$count] = $file; 
			$count++;
		}
	}
}
@closedir($dir);
// Logo ListBox
$logo_list = "";
for( $i = 0; $i < count($logo); $i++ )
{
	if ($logo[$i] == $new['logo_image'])
		$logo_list .= '<option value="' . $logo[$i] . '" selected="selected">' . $logo[$i] . '</option>'; 
	else 
		$logo_list .= '<option value="' . $logo[$i] . '">' . $logo[$i] . '</option>';
}

$logo_image = $new['logo_image'];
$logo_width = $new['logo_image_w'];
$logo_height = $new['logo_image_h'];
$style_select = style_select($new['default_style'], 'default_style', "../templates");
$lang_select = language_select($new['default_lang'], 'default_lang', "language");
$timezone_select = tz_select($new['board_timezone'], 'board_timezone');

$disable_board_yes = ( $new['board_disable'] ) ? "checked=\"checked\"" : "";
$disable_board_no = ( !$new['board_disable'] ) ? "checked=\"checked\"" : "";

$cookie_secure_yes = ( $new['cookie_secure'] ) ? "checked=\"checked\"" : "";
$cookie_secure_no = ( !$new['cookie_secure'] ) ? "checked=\"checked\"" : "";

$html_tags = $new['allow_html_tags'];

$override_user_style_yes = ( $new['override_user_style'] ) ? "checked=\"checked\"" : "";
$override_user_style_no = ( !$new['override_user_style'] ) ? "checked=\"checked\"" : "";

$html_yes = ( $new['allow_html'] ) ? "checked=\"checked\"" : "";
$html_no = ( !$new['allow_html'] ) ? "checked=\"checked\"" : "";

$bbcode_yes = ( $new['allow_bbcode'] ) ? "checked=\"checked\"" : "";
$bbcode_no = ( !$new['allow_bbcode'] ) ? "checked=\"checked\"" : "";

$activation_none = ( $new['require_activation'] == USER_ACTIVATION_NONE ) ? "checked=\"checked\"" : "";
$activation_user = ( $new['require_activation'] == USER_ACTIVATION_SELF ) ? "checked=\"checked\"" : "";
$activation_admin = ( $new['require_activation'] == USER_ACTIVATION_ADMIN ) ? "checked=\"checked\"" : "";

$allow_autologin_yes = ( $new['allow_autologin']) ? "checked=\"checked\"" : "";
$allow_autologin_no = ( !$new['allow_autologin']) ? "checked=\"checked\"" : "";

$board_email_form_yes = ( $new['board_email_form'] ) ? "checked=\"checked\"" : "";
$board_email_form_no = ( !$new['board_email_form'] ) ? "checked=\"checked\"" : "";

$gzip_yes = ( $new['gzip_compress'] ) ? "checked=\"checked\"" : "";
$gzip_no = ( !$new['gzip_compress'] ) ? "checked=\"checked\"" : "";

$privmsg_on = ( !$new['privmsg_disable'] ) ? "checked=\"checked\"" : "";
$privmsg_off = ( $new['privmsg_disable'] ) ? "checked=\"checked\"" : "";

$prune_yes = ( $new['prune_enable'] ) ? "checked=\"checked\"" : "";
$prune_no = ( !$new['prune_enable'] ) ? "checked=\"checked\"" : "";

$smile_yes = ( $new['allow_smilies'] ) ? "checked=\"checked\"" : "";
$smile_no = ( !$new['allow_smilies'] ) ? "checked=\"checked\"" : "";

$sig_yes = ( $new['allow_sig'] ) ? "checked=\"checked\"" : "";
$sig_no = ( !$new['allow_sig'] ) ? "checked=\"checked\"" : "";

// Start add - Signatures control MOD
switch ( $new['sig_allow_font_sizes'] )
{ 
	case 1:
		$sig_allow_font_sizes_yes="checked=\"checked\"";
		break; 
	case 2:
		$sig_allow_font_sizes_max="checked=\"checked\"";
		break; 
	case 0:
		$sig_allow_font_sizes_imposed="checked=\"checked\"";
		break; 
} 

$sig_allow_bold_yes = ( $new['sig_allow_bold'] ) ? "checked=\"checked\"" : "";
$sig_allow_italic_yes = ( $new['sig_allow_italic'] ) ? "checked=\"checked\"" : "";
$sig_allow_underline_yes = ( $new['sig_allow_underline'] ) ? "checked=\"checked\"" : "";
$sig_allow_colors_yes = ( $new['sig_allow_colors'] ) ? "checked=\"checked\"" : "";

$sig_allow_quote_yes = ( $new['sig_allow_quote'] ) ? "checked=\"checked\"" : "";
$sig_allow_code_yes = ( $new['sig_allow_code'] ) ? "checked=\"checked\"" : "";
$sig_allow_list_yes = ( $new['sig_allow_list'] ) ? "checked=\"checked\"" : "";

$sig_allow_url_yes = ( $new['sig_allow_url'] ) ? "checked=\"checked\"" : "";
$sig_allow_url_no = ( !$new['sig_allow_url'] ) ? "checked=\"checked\"" : "";

$sig_allow_smilies_yes = ( $new['sig_allow_smilies'] ) ? "checked=\"checked\"" : "";
$sig_allow_smilies_no = ( !$new['sig_allow_smilies'] ) ? "checked=\"checked\"" : "";

$sig_allow_images_yes = ( $new['sig_allow_images'] ) ? "checked=\"checked\"" : "";
$sig_allow_images_no = ( !$new['sig_allow_images'] ) ? "checked=\"checked\"" : "";

$sig_allow_on_max_img_size_fail_yes = ( $new['sig_allow_on_max_img_size_fail'] ) ? "checked=\"checked\"" : "";

if(ini_get('allow_url_fopen')==1 )
{
	$l_sig_max_img_size_explain = $lang['sig_max_img_size_explain1'];
} else
{
	if( ini_get('allow_url_fopen')==0 )
	{
		$l_explain = "allow_url_fopen: off";
	} else
	{
		$l_explain = "";
	}
	$l_sig_max_img_size_explain = sprintf($lang['sig_max_img_size_explain2'], $l_explain);
}
// End add - Signatures control MOD

$namechange_yes = ( $new['allow_namechange'] ) ? "checked=\"checked\"" : "";
$namechange_no = ( !$new['allow_namechange'] ) ? "checked=\"checked\"" : "";

$avatars_local_yes = ( $new['allow_avatar_local'] ) ? "checked=\"checked\"" : "";
$avatars_local_no = ( !$new['allow_avatar_local'] ) ? "checked=\"checked\"" : "";
$avatars_remote_yes = ( $new['allow_avatar_remote'] ) ? "checked=\"checked\"" : "";
$avatars_remote_no = ( !$new['allow_avatar_remote'] ) ? "checked=\"checked\"" : "";
$avatars_upload_yes = ( $new['allow_avatar_upload'] ) ? "checked=\"checked\"" : "";
$avatars_upload_no = ( !$new['allow_avatar_upload'] ) ? "checked=\"checked\"" : "";

$photos_local_yes = ( $new['allow_photo_local'] ) ? "checked=\"checked\"" : "";
$photos_local_no = ( !$new['allow_photo_local'] ) ? "checked=\"checked\"" : "";
$photos_remote_yes = ( $new['allow_photo_remote'] ) ? "checked=\"checked\"" : "";
$photos_remote_no = ( !$new['allow_photo_remote'] ) ? "checked=\"checked\"" : "";
$photos_upload_yes = ( $new['allow_photo_upload'] ) ? "checked=\"checked\"" : "";
$photos_upload_no = ( !$new['allow_photo_upload'] ) ? "checked=\"checked\"" : "";

$smtp_yes = ( $new['smtp_delivery'] ) ? "checked=\"checked\"" : "";
$smtp_no = ( !$new['smtp_delivery'] ) ? "checked=\"checked\"" : "";

$lw_header_reminder_yes = ( $new['lw_header_reminder'] ) ? "checked=\"checked\"" : "";
$lw_header_reminder_no = ( !$new['lw_header_reminder'] ) ? "checked=\"checked\"" : "";

$debug_yes = ( $new['debug_mode'] ) ? "checked=\"checked\"" : "";
$debug_no = ( !$new['debug_mode'] ) ? "checked=\"checked\"" : "";

$template->set_filenames(array(
	"body" => "admin/board_config_body.tpl")
);

//report forum selection
$sql = "SELECT f.forum_name, f.forum_id
	FROM " . FORUMS_TABLE . " f, " . CATEGORIES_TABLE . " c
	WHERE c.cat_id = f.cat_id ORDER BY c.cat_order ASC, f.forum_order ASC";
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, "Couldn't obtain forum list", "", __LINE__, __FILE__, $sql);
}
$report_forum_rows = $db->sql_fetchrowset($result);
$db->sql_freeresult($result);
$report_forum_select_list = '<select name="report_forum">';
$report_forum_select_list .= '<option value="0">' . $lang['None'] . '</option>';
for($i = 0; $i < count($report_forum_rows); $i++)
{
	$report_forum_select_list .= '<option value="' . $report_forum_rows[$i]['forum_id'] . '">' . $report_forum_rows[$i]['forum_name'] . '</option>';
}
$report_forum_select_list .= '</select>';
$report_forum_select_list = str_replace("value=\"".$new['report_forum']."\">", "value=\"".$new['report_forum']."\" SELECTED>*" ,$report_forum_select_list);

//
// Escape any quotes in the site description for proper display in the text
// box on the admin page 
//
$new['site_desc'] = str_replace('"', '&quot;', $new['site_desc']);
$new['sitename'] = str_replace('"', '&quot;', strip_tags($new['sitename']));

$template->assign_vars(array(
	"S_CONFIG_ACTION" => append_sid("admin_board.$phpEx"),

	"L_YES" => $lang['Yes'],
	"L_NO" => $lang['No'],
	"L_CONFIGURATION_TITLE" => $lang['General_Config'],
	"L_CONFIGURATION_EXPLAIN" => $lang['Config_explain'],
	"L_GENERAL_SETTINGS" => $lang['General_settings'],
	"L_SERVER_NAME" => $lang['Server_name'], 
	"L_SERVER_NAME_EXPLAIN" => $lang['Server_name_explain'], 
	"L_SERVER_PORT" => $lang['Server_port'], 
	"L_SERVER_PORT_EXPLAIN" => $lang['Server_port_explain'], 
	"L_SCRIPT_PATH" => $lang['Script_path'], 
	"L_SCRIPT_PATH_EXPLAIN" => $lang['Script_path_explain'], 
	"L_SITE_NAME" => $lang['Site_name'],
	"L_SITE_DESCRIPTION" => $lang['Site_desc'],
	"L_DISABLE_BOARD" => $lang['Board_disable'], 
	"L_DISABLE_BOARD_EXPLAIN" => $lang['Board_disable_explain'], 
	"L_DISABLE_BOARD_MSG" => $lang['Board_disable_msg'], 
	"L_DISABLE_BOARD_MSG_EXPLAIN" => $lang['Board_disable_msg_explain'],
	"L_ACCT_ACTIVATION" => $lang['Acct_activation'], 
	"L_NONE" => $lang['Acc_None'], 
	"L_USER" => $lang['Acc_User'], 
	"L_ADMIN" => $lang['Acc_Admin'], 
	// Logo Selector MOD
	"L_LOGO_SETTINGS" => $lang['Logo_settings'],
	"L_LOGO_EXPLAIN" => $lang['Logo_explain'],
	"L_LOGO_PATH" => $lang['Logo_path'], 
	"L_LOGO_PATH_EXPLAIN" => $lang['Logo_path_explain'],
	"L_LOGO" => $lang['Logo'],
	"L_LOGO_DIMENSIONS" => $lang['Logo_dimensions'],
	"L_LOGO_DIMENSIONS_EXPLAIN" => $lang['Logo_dimensions_explain'],
	// Logo Selector MOD
	"L_ALLOW_AUTOLOGIN" => $lang['Allow_autologin'],
	"L_ALLOW_AUTOLOGIN_EXPLAIN" => $lang['Allow_autologin_explain'],
	"L_AUTOLOGIN_TIME" => $lang['Autologin_time'],
	"L_AUTOLOGIN_TIME_EXPLAIN" => $lang['Autologin_time_explain'],
	"L_COOKIE_SETTINGS" => $lang['Cookie_settings'], 
	"L_COOKIE_SETTINGS_EXPLAIN" => $lang['Cookie_settings_explain'], 
	"L_COOKIE_DOMAIN" => $lang['Cookie_domain'],
	"L_COOKIE_NAME" => $lang['Cookie_name'], 
	"L_COOKIE_PATH" => $lang['Cookie_path'], 
	"L_COOKIE_SECURE" => $lang['Cookie_secure'], 
	"L_COOKIE_SECURE_EXPLAIN" => $lang['Cookie_secure_explain'], 
	"L_SESSION_LENGTH" => $lang['Session_length'], 
	"L_PRIVATE_MESSAGING" => $lang['Private_Messaging'], 
	"L_INBOX_LIMIT" => $lang['Inbox_limits'], 
	"L_SENTBOX_LIMIT" => $lang['Sentbox_limits'], 
	"L_SAVEBOX_LIMIT" => $lang['Savebox_limits'], 
	"L_DISABLE_PRIVATE_MESSAGING" => $lang['Disable_privmsg'], 
	"L_ENABLED" => $lang['Enabled'], 
	"L_DISABLED" => $lang['Disabled'], 
	"L_ABILITIES_SETTINGS" => $lang['Abilities_settings'],
	"L_MAX_POLL_OPTIONS" => $lang['Max_poll_options'],
	"L_FLOOD_INTERVAL" => $lang['Flood_Interval'],
	"L_FLOOD_INTERVAL_EXPLAIN" => $lang['Flood_Interval_explain'],
	"L_SEARCH_FLOOD_INTERVAL" => $lang['Search_Flood_Interval'],
	"L_SEARCH_FLOOD_INTERVAL_EXPLAIN" => $lang['Search_Flood_Interval_explain'], 	
	
	'L_MAX_LOGIN_ATTEMPTS'			=> $lang['Max_login_attempts'],
	'L_MAX_LOGIN_ATTEMPTS_EXPLAIN'	=> $lang['Max_login_attempts_explain'],
	'L_LOGIN_RESET_TIME'			=> $lang['Login_reset_time'],
	'L_LOGIN_RESET_TIME_EXPLAIN'	=> $lang['Login_reset_time_explain'],
	'MAX_LOGIN_ATTEMPTS'			=> $new['max_login_attempts'],
	'LOGIN_RESET_TIME'				=> $new['login_reset_time'],
	"L_BOARD_EMAIL_FORM" => $lang['Board_email_form'], 
	"L_BOARD_EMAIL_FORM_EXPLAIN" => $lang['Board_email_form_explain'], 
	"L_TOPICS_PER_PAGE" => $lang['Topics_per_page'],
	"L_POSTS_PER_PAGE" => $lang['Posts_per_page'],
	"L_HOT_THRESHOLD" => $lang['Hot_threshold'],
	"L_DEFAULT_STYLE" => $lang['Default_style'],
	"L_OVERRIDE_STYLE" => $lang['Override_style'],
	"L_OVERRIDE_STYLE_EXPLAIN" => $lang['Override_style_explain'],
	"L_DEFAULT_LANGUAGE" => $lang['Default_language'],
	"L_DATE_FORMAT" => $lang['Date_format'],
	"L_SYSTEM_TIMEZONE" => $lang['System_timezone'],
	"L_ENABLE_GZIP" => $lang['Enable_gzip'],
	"L_ENABLE_DEBUG" => $lang['Enable_debug'],
	"L_ENABLE_PRUNE" => $lang['Enable_prune'],
	'L_BLUECARD_LIMIT' => $lang['Bluecard_limit'], 
	'L_BLUECARD_LIMIT_EXPLAIN' => $lang['Bluecard_limit_explain'], 
	'L_BLUECARD_LIMIT_2' => $lang['Bluecard_limit_2'], 
	'L_BLUECARD_LIMIT_2_EXPLAIN' => $lang['Bluecard_limit_2_explain'], 
	'L_MAX_USER_BANCARD' => $lang['Max_user_bancard'], 
	'L_MAX_USER_BANCARD_EXPLAIN' => $lang['Max_user_bancard_explain'], 
	'L_REPORT_FORUM' => $lang['Report_forum'],
	'L_REPORT_FORUM_EXPLAIN' => $lang['Report_forum_explain'],
// Start add - Fully integrated shoutbox MOD
	'L_PRUNE_SHOUTS' => $lang['Prune_shouts'], 
	'L_PRUNE_SHOUTS_EXPLAIN' => $lang['Prune_shouts_explain'], 
// End add - Fully integrated shoutbox MOD	
    "L_ALLOW_HTML" => $lang['Allow_HTML'],
	"L_ALLOW_BBCODE" => $lang['Allow_BBCode'],
	"L_ALLOWED_TAGS" => $lang['Allowed_tags'],
	"L_ALLOWED_TAGS_EXPLAIN" => $lang['Allowed_tags_explain'],
	"L_ALLOW_SMILIES" => $lang['Allow_smilies'],
	"L_SMILIES_PATH" => $lang['Smilies_path'],
	"L_SMILIES_PATH_EXPLAIN" => $lang['Smilies_path_explain'],
	"L_ALLOW_SIG" => $lang['Allow_sig'],
	"L_MAX_SIG_LENGTH" => $lang['Max_sig_length'],
	"L_MAX_SIG_LENGTH_EXPLAIN" => $lang['Max_sig_length_explain'],
// Start add - Signatures control MOD
'L_SIG_SETTINGS' => $lang['sig_settings'],
'L_SIG_SETTINGS_EXPLAIN' => $lang['sig_settings_explain'],

'L_SIG_MAX_LINES' => $lang['sig_max_lines'],
'L_SIG_WORDWRAP' => $lang['sig_wordwrap'],
'L_SIG_ALLOW_FONT_SIZES' => $lang['sig_allow_font_sizes'],
'L_SIG_ALLOW_FONT_SIZES_YES' => $lang['sig_allow_font_sizes_yes'],
'L_SIG_ALLOW_FONT_SIZES_MAX' => $lang['sig_allow_font_sizes_max'],
'L_SIG_ALLOW_FONT_SIZES_IMPOSED' => $lang['sig_allow_font_sizes_imposed'],
'L_SIG_FONT_SIZE_LIMIT' => $lang['sig_font_size_limit'],
'L_SIG_FONT_SIZE_LIMIT_EXPLAIN' => $lang['sig_font_size_limit_explain'],
'L_SIG_MIN_FONT_SIZE' => $lang['sig_min_font_size'],
'L_SIG_MAX_FONT_SIZE' => $lang['sig_max_font_size'],
'L_SIG_TEXT_ENHANCEMENT' => $lang['sig_text_enhancement'],
'L_SIG_ALLOW_BOLD' => $lang['sig_allow_bold'],
'L_SIG_ALLOW_ITALIC' => $lang['sig_allow_italic'],
'L_SIG_ALLOW_UNDERLINE' => $lang['sig_allow_underline'],
'L_SIG_ALLOW_COLORS' => $lang['sig_allow_colors'],
'L_SIG_TEXT_PRESENTATION' => $lang['sig_text_presentation'],
'L_SIG_ALLOW_QUOTE' => $lang['sig_allow_quote'],
'L_SIG_ALLOW_CODE' => $lang['sig_allow_code'],
'L_SIG_ALLOW_LIST' => $lang['sig_allow_list'],
'L_SIG_ALLOW_URL' => $lang['sig_allow_url'],
'L_SIG_ALLOW_IMAGES' => $lang['sig_allow_images'],
'L_SIG_MAX_IMAGES' => $lang['sig_max_images'],
'L_SIG_MAX_IMG_SIZE' => $lang['sig_max_img_size'],
'L_SIG_MAX_IMG_SIZE_EXPLAIN' => $l_sig_max_img_size_explain,
'L_SIG_IMG_SIZE_LEGEND' => $lang['sig_img_size_legend'],
'L_SIG_ALLOW_ON_MAX_IMG_SIZE_FAIL' => $lang['sig_allow_on_max_img_size_fail'],
'L_SIG_MAX_IMG_FILES_SIZE' => $lang['sig_max_img_files_size'],
'L_SIG_MAX_IMG_AV_FILES_SIZE' => $lang['sig_max_img_av_files_size'],
'L_SIG_MAX_IMG_AV_FILES_SIZE_EXPLAIN' => $lang['sig_max_img_av_files_size_explain'],
'L_SIG_KBYTES' => $lang['sig_Kbytes'],
'L_SIG_EXOTIC_BBCODES_DISALLOWED' => $lang['sig_exotic_bbcodes_disallowed'],
'L_SIG_EXOTIC_BBCODES_DISALLOWED_EXPLAIN' => $lang['sig_exotic_bbcodes_disallowed_explain'],
'L_SIG_ALLOW_SMILIES' => $lang['sig_allow_smilies'],
'L_SIG_RESET' => $lang['sig_reset'],
'L_SIG_RESET_EXPLAIN' => $lang['sig_reset_explain'],
// End add - Signatures control MOD
	"L_ALLOW_NAME_CHANGE" => $lang['Allow_name_change'],
	"L_MAX_LINK_BOOKMARKS" => $lang['Max_bookmarks_links'],
	"L_MAX_LINK_BOOKMARKS_EXPLAIN" => $lang['Max_bookmarks_links_explain'],
	"L_AVATAR_SETTINGS" => $lang['Avatar_settings'],
	"L_ALLOW_LOCAL" => $lang['Allow_local'],
	"L_ALLOW_REMOTE" => $lang['Allow_remote'],
	"L_ALLOW_REMOTE_EXPLAIN" => $lang['Allow_remote_explain'],
	"L_ALLOW_UPLOAD" => $lang['Allow_upload'],
	"L_MAX_FILESIZE" => $lang['Max_filesize'],
	"L_MAX_FILESIZE_EXPLAIN" => $lang['Max_filesize_explain'],
	"L_MAX_AVATAR_SIZE" => $lang['Max_avatar_size'],
	"L_MAX_AVATAR_SIZE_EXPLAIN" => $lang['Max_avatar_size_explain'],
	"L_AVATAR_STORAGE_PATH" => $lang['Avatar_storage_path'],
	"L_AVATAR_STORAGE_PATH_EXPLAIN" => $lang['Avatar_storage_path_explain'],
	"L_AVATAR_GALLERY_PATH" => $lang['Avatar_gallery_path'],
	"L_AVATAR_GALLERY_PATH_EXPLAIN" => $lang['Avatar_gallery_path_explain'],
	"L_ALLOW_LOCAL_PHOTO" => $lang['Allow_local_photo'],
	"L_ALLOW_REMOTE_PHOTO" => $lang['Allow_remote_photo'],
	"L_ALLOW_REMOTE_PHOTO_EXPLAIN" => $lang['Allow_remote_photo_explain'],
	"L_ALLOW_UPLOAD_PHOTO" => $lang['Allow_upload_photo'],
	"L_MAX_FILESIZE_PHOTO" => $lang['Max_filesize_photo'],
	"L_MAX_FILESIZE_EXPLAIN_PHOTO" => $lang['Max_filesize_photo_explain'],
	"L_PHOTO_SETTINGS" => $lang['Photo_settings'],
	"L_MAX_PHOTO_SIZE" => $lang['Max_photo_size'],
	"L_MAX_PHOTO_SIZE_EXPLAIN" => $lang['Max_photo_size_explain'],
	"L_PHOTO_STORAGE_PATH" => $lang['Photo_storage_path'],
	"L_PHOTO_STORAGE_PATH_EXPLAIN" => $lang['Photo_storage_path_explain'],
	"L_PHOTO_GALLERY_PATH" => $lang['Photo_gallery_path'],
	"L_PHOTO_GALLERY_PATH_EXPLAIN" => $lang['Photo_gallery_path_explain'],
	"L_COPPA_SETTINGS" => $lang['COPPA_settings'],
	"L_COPPA_FAX" => $lang['COPPA_fax'],
	"L_COPPA_MAIL" => $lang['COPPA_mail'],
	"L_COPPA_MAIL_EXPLAIN" => $lang['COPPA_mail_explain'],
	"L_EMAIL_SETTINGS" => $lang['Email_settings'],
	"L_ADMIN_EMAIL" => $lang['Admin_email'],
	"L_EMAIL_SIG" => $lang['Email_sig'],
	"L_EMAIL_SIG_EXPLAIN" => $lang['Email_sig_explain'],
	"L_USE_SMTP" => $lang['Use_SMTP'],
	"L_USE_SMTP_EXPLAIN" => $lang['Use_SMTP_explain'],
	"L_SMTP_SERVER" => $lang['SMTP_server'], 
	"L_SMTP_USERNAME" => $lang['SMTP_username'], 
	"L_SMTP_USERNAME_EXPLAIN" => $lang['SMTP_username_explain'], 
	"L_SMTP_PASSWORD" => $lang['SMTP_password'], 
	"L_SMTP_PASSWORD_EXPLAIN" => $lang['SMTP_password_explain'],
	"L_LW_PAYPAL_SETTINGS" => $lang['LW_PAYPAL_ACCT_SETTINGS_TITLE'],
	"L_LW_OUR_PAYPAL_ACCT" => $lang['LW_OUR_PAYPAL_ACCT'],
	"L_LW_PAYPAL_CURRENCY_CODE" => $lang['LW_OUR_PAYPAL_CURRENCY_CODE'],
	"L_LW_TRIAL_PERIOD" => $lang['LW_TRIAL_PERIOD'], 
	"L_SUBMIT" => $lang['Submit'], 
	"L_RESET" => $lang['Reset'], 
	"L_DONATION_SETTINGS" => $lang['L_DONATION_SETTINGS'],
	"L_LW_HEADER_REMINDER" => $lang['L_LW_HEADER_REMINDER'],
	"L_LW_HEADER_REMINDER_EXPLAIN" => $lang['L_LW_HEADER_REMINDER_EXPLAIN'],
	"L_LW_PERSONAL_PAYPAL_ACCT" => $lang['L_LW_PERSONAL_PAYPAL_ACCT'],
	"L_LW_PERSONAL_PAYPAL_ACCT_EXPLAIN" => $lang['L_LW_PERSONAL_PAYPAL_ACCT_EXPLAIN'],
	"L_LW_BUSINESS_PAYPAL_ACCT" => $lang['L_LW_BUSINESS_PAYPAL_ACCT'],
	"L_LW_BUSINESS_PAYPAL_ACCT_EXPLAIN" => $lang['L_LW_BUSINESS_PAYPAL_ACCT_EXPLAIN'],
	"L_LW_PAYPAL_CURRENCY_CODE" => $lang['L_LW_PAYPAL_CURRENCY_CODE'],
	"L_LW_PAYPAL_CURRENCY_CODE_EXPLAIN" => $lang['L_LW_PAYPAL_CURRENCY_CODE_EXPLAIN'],
	"L_LW_DISPLAY_X_DONORS" => $lang['L_LW_DISPLAY_X_DONORS'],
	"L_LW_DISPLAY_X_DONORS_EXPLAIN" => $lang['L_LW_DISPLAY_X_DONORS_EXPLAIN'],
	"L_LW_DONATION_DESCRIPTION" => $lang['L_LW_DONATION_DESCRIPTION'],
	"L_LW_DONATION_DESCRIPTION_EXPLAIN" => $lang['L_LW_DONATION_DESCRIPTION_EXPLAIN'],
	"L_LW_DONATION_GOAL" => $lang['L_LW_DONATION_GOAL'],
	"L_LW_DONATION_GOAL_EXPLAIN" => $lang['L_LW_DONATION_GOAL_EXPLAIN'],
	"L_LW_DONATION_START" => $lang['L_LW_DONATION_START'],
	"L_LW_DONATION_START_EXPLAIN" => $lang['L_LW_DONATION_START_EXPLAIN'],
	"L_LW_DONATION_END" => $lang['L_LW_DONATION_END'],
	"L_LW_DONATION_END_EXPLAIN" => $lang['L_LW_DONATION_END_EXPLAIN'],
	"L_LW_DONATION_POINTS" => $lang['L_LW_DONATION_POINTS'],
	"L_LW_DONATION_POINTS_EXPLAIN" => $lang['L_LW_DONATION_POINTS_EXPLAIN'],
	"LW_TOP_DONORS" => $new['list_top_donors'], 
	"L_LW_TOP_DONORS" => $lang['L_LW_TOP_DONORS'],
	"L_LW_TOP_DONORS_EXPLAIN" => $lang['L_LW_TOP_DONORS_EXPLAIN'],
	"L_LW_POSTS_COUNTS" => $lang['L_LW_POSTS_COUNTS'],
	"L_LW_POSTS_COUNTS_EXPLAIN" => $lang['L_LW_POSTS_COUNTS_EXPLAIN'],
	"LW_POSTS_COUNTS" => $new['donate_to_posts'], 
	"LW_HEADER_REMINDER" => $new['lw_header_reminder'],
	"LW_HEADER_REMINDER_YES" => $lw_header_reminder_yes,
	"LW_HEADER_REMINDER_NO" => $lw_header_reminder_no,
	"LW_PERSONAL_PAYPAL_ACCT" => $new['paypal_p_acct'], 
	"LW_BUSINESS_PAYPAL_ACCT" => $new['paypal_b_acct'], 
	"LW_PAYPAL_CURRENCY_CODE" => $new['paypal_currency_code'], 
	"LW_DISPLAY_X_DONORS" => $new['dislay_x_donors'], 
	"LW_DONATION_DESCRIPTION" => $new['donate_description'], 
	"LW_DONATION_GOAL" => $new['donate_cur_goal'], 
	"LW_DONATION_START" => $new['donate_start_time'], 
	"LW_DONATION_END" => $new['donate_end_time'], 
	"LW_DONATION_POINTS" => $new['donate_to_points'], 
	"L_LW_DONATE_TOGRP_ONE" => $lang['L_LW_DONATE_TOGRP_ONE'],
	"L_LW_DONATE_TOGRP_ONE_EXPLAIN" => $lang['L_LW_DONATE_TOGRP_ONE_EXPLAIN'],
	"L_LW_TOGRPONE_AMOUNT" => $lang['L_LW_TOGRPONE_AMOUNT'],
	"L_LW_TOGRPONE_AMOUNT_EXPLAIN" => $lang['L_LW_TOGRPONE_AMOUNT_EXPLAIN'],
	"L_LW_DONATE_TOGRP_TWO" => $lang['L_LW_DONATE_TOGRP_TWO'],
	"L_LW_DONATE_TOGRP_TWO_EXPLAIN" => $lang['L_LW_DONATE_TOGRP_TWO_EXPLAIN'],
	"L_LW_TOGRPTWO_AMOUNT" => $lang['L_LW_TOGRPTWO_AMOUNT'],
	"L_LW_TOGRPTWO_AMOUNT_EXPLAIN" => $lang['L_LW_TOGRPTWO_AMOUNT_EXPLAIN'],
	"L_LW_TORANK_ID" => $lang['L_LW_TORANK_ID'],
	"L_LW_TORANK_ID_EXPLAIN" => $lang['L_LW_TORANK_ID_EXPLAIN'],

	"LW_DONATE_TOGRP_ONE" => $new['donate_to_grp_one'], 
	"LW_TOGRPONE_AMOUNT" => $new['to_grp_one_amount'], 
	"LW_DONATE_TOGRP_TWO" => $new['donate_to_grp_two'], 
	"LW_TOGRPTWO_AMOUNT" => $new['to_grp_two_amount'], 
	"LW_TORANK_ID" => $new['donor_rank_id'], 
	"LW_PAYPAL_P_ACCT" => $new['paypal_p_acct'],
	"LW_PAYPAL_CURRENCY_CODE" => $new['paypal_currency_code'],
	"LW_TRIAL_PERIOD" => $new['lw_trial_period'],
	
	"SERVER_NAME" => $new['server_name'], 
	"SCRIPT_PATH" => $new['script_path'], 
	"SERVER_PORT" => $new['server_port'], 
	"SITENAME" => $new['sitename'],
	"SITE_DESCRIPTION" => $new['site_desc'], 
	"S_DISABLE_BOARD_YES" => $disable_board_yes,
	"S_DISABLE_BOARD_NO" => $disable_board_no,
	"DISABLE_BOARD_MSG" => $new['board_disable_msg'],
	"ACTIVATION_NONE" => USER_ACTIVATION_NONE, 
	"ACTIVATION_NONE_CHECKED" => $activation_none,
	"ACTIVATION_USER" => USER_ACTIVATION_SELF, 
	"ACTIVATION_USER_CHECKED" => $activation_user,
	"ACTIVATION_ADMIN" => USER_ACTIVATION_ADMIN, 
	"ACTIVATION_ADMIN_CHECKED" => $activation_admin, 
	"CONFIRM_ENABLE" => $confirm_yes,
	"CONFIRM_DISABLE" => $confirm_no,
	'ALLOW_AUTOLOGIN_YES' => $allow_autologin_yes,
	'ALLOW_AUTOLOGIN_NO' => $allow_autologin_no,
	'AUTOLOGIN_TIME' => (int) $new['max_autologin_time'],
	"BOARD_EMAIL_FORM_ENABLE" => $board_email_form_yes, 
	"BOARD_EMAIL_FORM_DISABLE" => $board_email_form_no, 
	"MAX_POLL_OPTIONS" => $new['max_poll_options'], 
	"FLOOD_INTERVAL" => $new['flood_interval'],
	"SEARCH_FLOOD_INTERVAL" => $new['search_flood_interval'],
	"TOPICS_PER_PAGE" => $new['topics_per_page'],
	"POSTS_PER_PAGE" => $new['posts_per_page'],
	"HOT_TOPIC" => $new['hot_threshold'],
	"STYLE_SELECT" => $style_select,
	"OVERRIDE_STYLE_YES" => $override_user_style_yes,
	"OVERRIDE_STYLE_NO" => $override_user_style_no,
	"LANG_SELECT" => $lang_select,
	"L_DATE_FORMAT_EXPLAIN" => $lang['Date_format_explain'],
	"DEFAULT_DATEFORMAT" => $new['default_dateformat'],
	"TIMEZONE_SELECT" => $timezone_select,
	// Logo Selector MOD
	"LOGO_PATH" => $new['logo_image_path'],
	"LOGO_IMAGE_DIR" => $phpbb_root_path . $new['logo_image_path'], 
	"LOGO_LIST" => $logo_list,
	"LOGO_IMAGE" => ($logo_image) ? $phpbb_root_path . $board_config['logo_image_path'] .'/' . $logo_image : '',
	"LOGO_WIDTH" => $new['logo_image_w'],
	"LOGO_HEIGHT" => $new['logo_image_h'],
	// Logo Selector MOD
	"S_PRIVMSG_ENABLED" => $privmsg_on, 
	"S_PRIVMSG_DISABLED" => $privmsg_off, 
	"INBOX_LIMIT" => $new['max_inbox_privmsgs'], 
	"SENTBOX_LIMIT" => $new['max_sentbox_privmsgs'],
	"SAVEBOX_LIMIT" => $new['max_savebox_privmsgs'],
	"COOKIE_DOMAIN" => $new['cookie_domain'], 
	"COOKIE_NAME" => $new['cookie_name'], 
	"COOKIE_PATH" => $new['cookie_path'], 
	"SESSION_LENGTH" => $new['session_length'], 
	"S_COOKIE_SECURE_ENABLED" => $cookie_secure_yes, 
	"S_COOKIE_SECURE_DISABLED" => $cookie_secure_no, 
	"GZIP_YES" => $gzip_yes,
	"GZIP_NO" => $gzip_no,
	"DEBUG_YES" => $debug_yes,
	"DEBUG_NO" => $debug_no,
	"PRUNE_YES" => $prune_yes,
	"PRUNE_NO" => $prune_no, 
	'BLUECARD_LIMIT' => $new['bluecard_limit'], 
	'BLUECARD_LIMIT_2' => $new['bluecard_limit_2'], 
	'MAX_USER_BANCARD' => $new['max_user_bancard'], 
	'S_REPORT_FORUM' => $report_forum_select_list,
// Start add - Fully integrated shoutbox MOD
	"PRUNE_SHOUTS" => $new['prune_shouts'], 
// End add - Fully integrated shoutbox MOD
        "HTML_TAGS" => $html_tags, 
	"HTML_YES" => $html_yes,
	"HTML_NO" => $html_no,
	"BBCODE_YES" => $bbcode_yes,
	"BBCODE_NO" => $bbcode_no,
	"SMILE_YES" => $smile_yes,
	"SMILE_NO" => $smile_no,
	"SIG_YES" => $sig_yes,
	"SIG_NO" => $sig_no,
	"SIG_SIZE" => $new['max_sig_chars'], 
// Start add - Signatures control MOD
'SIG_MAX_LINES' => $new['sig_max_lines'],
'SIG_WORDWRAP' => $new['sig_wordwrap'],
'SIG_ALLOW_FONT_SIZES_YES' => $sig_allow_font_sizes_yes,
'SIG_ALLOW_FONT_SIZES_MAX' => $sig_allow_font_sizes_max,
'SIG_ALLOW_FONT_SIZES_IMPOSED' => $sig_allow_font_sizes_imposed,
'SIG_MIN_FONT_SIZE' => $new['sig_min_font_size'],
'SIG_MAX_FONT_SIZE' => $new['sig_max_font_size'],
'SIG_ALLOW_BOLD_YES' => $sig_allow_bold_yes,
'SIG_ALLOW_ITALIC_YES' => $sig_allow_italic_yes,
'SIG_ALLOW_UNDERLINE_YES' => $sig_allow_underline_yes,
'SIG_ALLOW_COLORS_YES' => $sig_allow_colors_yes,
'SIG_ALLOW_QUOTE_YES' => $sig_allow_quote_yes,
'SIG_ALLOW_CODE_YES' => $sig_allow_code_yes,
'SIG_ALLOW_LIST_YES' => $sig_allow_list_yes,
'SIG_ALLOW_URL_YES' => $sig_allow_url_yes,
'SIG_ALLOW_URL_NO' => $sig_allow_url_no,
'SIG_ALLOW_IMAGES_YES' => $sig_allow_images_yes,
'SIG_ALLOW_IMAGES_NO' => $sig_allow_images_no,
'SIG_MAX_IMAGES' => $new['sig_max_images'],
'SIG_MAX_IMG_HEIGHT' => $new['sig_max_img_height'],
'SIG_MAX_IMG_WIDTH' => $new['sig_max_img_width'],
'SIG_ALLOW_ON_MAX_IMG_SIZE_FAIL_YES' => $sig_allow_on_max_img_size_fail_yes,
'SIG_MAX_IMG_FILES_SIZE' => $new['sig_max_img_files_size'],
'SIG_MAX_IMG_AV_FILES_SIZE' => $new['sig_max_img_av_files_size'],
'SIG_EXOTIC_BBCODES_DISALLOWED' => $new['sig_exotic_bbcodes_disallowed'],
'SIG_ALLOW_SMILIES_YES' => $sig_allow_smilies_yes,
'SIG_ALLOW_SMILIES_NO' => $sig_allow_smilies_no,

'U_SIG_RESET' => append_sid("./sig_reset.$phpEx?mode=confirm_all"),
// End add - Signatures control MOD
	"NAMECHANGE_YES" => $namechange_yes,
	"NAMECHANGE_NO" => $namechange_no,
	"LINK_BOOKMARKS" => $new['max_link_bookmarks'],
	"AVATARS_LOCAL_YES" => $avatars_local_yes,
	"AVATARS_LOCAL_NO" => $avatars_local_no,
	"AVATARS_REMOTE_YES" => $avatars_remote_yes,
	"AVATARS_REMOTE_NO" => $avatars_remote_no,
	"AVATARS_UPLOAD_YES" => $avatars_upload_yes,
	"AVATARS_UPLOAD_NO" => $avatars_upload_no,
	"AVATAR_FILESIZE" => $new['avatar_filesize'],
	"AVATAR_MAX_HEIGHT" => $new['avatar_max_height'],
	"AVATAR_MAX_WIDTH" => $new['avatar_max_width'],
	"AVATAR_PATH" => $new['avatar_path'], 
	"AVATAR_GALLERY_PATH" => $new['avatar_gallery_path'],
	"PHOTOS_LOCAL_YES" => $photos_local_yes,
	"PHOTOS_LOCAL_NO" => $photos_local_no,
	"PHOTOS_REMOTE_YES" => $photos_remote_yes,
	"PHOTOS_REMOTE_NO" => $photos_remote_no,
	"PHOTOS_UPLOAD_YES" => $photos_upload_yes,
	"PHOTOS_UPLOAD_NO" => $photos_upload_no,
	"PHOTO_FILESIZE" => $new['photo_filesize'],
	"PHOTO_MAX_HEIGHT" => $new['photo_max_height'],
	"PHOTO_MAX_WIDTH" => $new['photo_max_width'],
	"PHOTO_PATH" => $new['photo_path'], 
	"PHOTO_GALLERY_PATH" => $new['photo_gallery_path'], 
	"SMILIES_PATH" => $new['smilies_path'], 
	"INBOX_PRIVMSGS" => $new['max_inbox_privmsgs'], 
	"SENTBOX_PRIVMSGS" => $new['max_sentbox_privmsgs'], 
	"SAVEBOX_PRIVMSGS" => $new['max_savebox_privmsgs'], 
	"EMAIL_FROM" => $new['board_email'],
	"EMAIL_SIG" => $new['board_email_sig'],
	"SMTP_YES" => $smtp_yes,
	"SMTP_NO" => $smtp_no,
	"SMTP_HOST" => $new['smtp_host'],
	"SMTP_USERNAME" => $new['smtp_username'],
	"SMTP_PASSWORD" => $new['smtp_password'],
	"COPPA_MAIL" => $new['coppa_mail'],
	"COPPA_FAX" => $new['coppa_fax'])
);

$template->pparse("body");

include('./page_footer_admin.'.$phpEx);

?>