<?php 
/***************************************************************************
 *							admin_captcha_config.php
 *                         --------------------------
 *   copyright            : (C) 2006 AmigaLink
 *   website              : www.amigalink.de
 *
 *   $Id: admin_captcha_config.php, v 0.0.8 2006/11/12 01:06:00 AmigaLink Exp $
 *
 ***************************************************************************/ 

define('IN_PHPBB', 1);

// First we do the setmodules stuff for the admin cp.
if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['General']['VC_Captcha_Config'] = $filename;

	return;
}

// Let's set the root dir for phpBB
$phpbb_root_path = '../';
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

// Pull config data
$sql = "SELECT * FROM " . CAPTCHA_CONFIG_TABLE;
if(!$result = $db->sql_query($sql))
{
	message_die(CRITICAL_ERROR, "Could not query Lexicon config information", "", __LINE__, __FILE__, $sql);
}
else
{
	while( $row = $db->sql_fetchrow($result) )
	{
		$config_name = $row['config_name'];
		$config_value = $row['config_value'];
		$default_config[$config_name] = $config_value;

		$new[$config_name] = ( isset($_POST[$config_name]) ) ? $_POST[$config_name] : $default_config[$config_name];

		if( isset($_POST['submit']) )
		{
			$sql = "UPDATE " . CAPTCHA_CONFIG_TABLE . " SET
				config_value = '" . str_replace("\'", "''", $new[$config_name]) . "'
				WHERE config_name = '$config_name'";
			if( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Failed to update Lexicon configuration for $config_name", "", __LINE__, __FILE__, $sql);
			}
		}
	}

	if( isset($_POST['submit']) )
	{
		$message = $lang['captcha_config_updated'] . "<br />" . sprintf($lang['Click_return_captcha_config'], "<a href=\"" . append_sid("admin_captcha_config.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>") . "<br /><br />";

		message_die(GENERAL_MESSAGE, $message);
	}
}

$template->set_filenames(array(
	"body" => "admin/admin_captcha_config.tpl")
);

if (!(@extension_loaded('gd')))
{
	$message = 'GD extension is not installed on your server, the "old style" of CAPTCHA will be used instead.';
	message_die(GENERAL_MESSAGE, $message);
	die;
}

if  (!function_exists('imagettfbbox') && !function_exists('imagettftext'))
{
	$message = 'Freetype for GD is not installed on your server, the "old style" of CAPTCHA will be used instead.';
	message_die(GENERAL_MESSAGE, $message);
	die;
}

$allowed_image_types = (imagetypes() & IMG_JPEG) ? 'jpg' : '';
$allowed_image_types .= (imagetypes() & IMG_PNG) ? (($allowed_image_types) ? ', png' : 'png') : '';
$allowed_image_types = ($allowed_image_types) ? $allowed_image_types : $lang['no_one'];


$template->assign_vars(array(
	'L_CAPTCHA_CONFIGURATION' => $lang['VC_Captcha_Config'],
	'L_CAPTCHA_CONFIGURATION_EXPLAIN' => $lang['captcha_config_explain'],
	'L_VC_ACTIVE' => ($board_config['enable_confirm']) ? $lang['VC_active'] : $lang['VC_inactive'],
	'L_BACKGROUND_CONFIG' => $lang['background_configs'],
	'L_RANDOM' => $lang['Random'],
	'L_DISABLED' => $lang['Disabled'],
	'L_ENABLED' => $lang['Enabled'],
	'L_YES' => $lang['Yes'],
	'L_NO' => $lang['No'],
	'L_SUBMIT' => $lang['Submit'],
	'L_RESET' => $lang['Reset'],

	'L_EXAMPLE_CODE' => $lang['example_code'],
	'L_EXAMPLE_CODE_EXPLAIN' => $lang['example_code_explain'],
	'L_WIDTH' => $lang['CAPTCHA_width'],
	'L_HEIGHT' => $lang['CAPTCHA_height'],
	'L_PRE_LETTERS' => $lang['pre_letters'],
	'L_PRE_LETTERS_EXPLAIN' => $lang['pre_letters_explain'],
	'L_GREAT_PRE_LETTERS' => $lang['great_pre_letters'],
	'L_GREAT_PRE_LETTERS_EXPLAIN' => $lang['great_pre_letters_explain'],
	'L_RND_FONT_PER_LETTER' => $lang['random_font_per_letter'],
	'L_RND_FONT_PER_LETTER_EXPLAIN' => $lang['random_font_per_letter_explain'],
	'L_TRANS_LETTERS' => $lang['trans_letters'],
	'L_TRANS_LETTERS_EXPLAIN' => $lang['trans_letters_explain'],
	'L_ALLOW_IMAGE' => $lang['back_image'],
	'L_ALLOW_IMAGE_EXPLAIN' => sprintf($lang['back_image_explain'], $allowed_image_types),
	'L_BG_TRANSITION' => $lang['bg_transition'],
	'L_BG_TRANSITION_EXPLAIN' => $lang['bg_transition_explain'],
	'L_BACKGROUND_COLOR' => $lang['background_color'],
	'L_BACKGROUND_COLOR_EXPLAIN' => $lang['background_color_explain'],
	'L_ALLOW_CHESS' => $lang['back_chess'],
	'L_ALLOW_CHESS_EXPLAIN' => $lang['back_chess_explain'],
	'L_ALLOW_ELLIPSES' => $lang['back_ellipses'],
	'L_ALLOW_ARCS' => $lang['back_arcs'],
	'L_ALLOW_LINES' => $lang['back_lines'],
	'L_FOREGROUND_LATTICE' => $lang['foreground_lattice'],
	'L_FOREGROUND_LATTICE_EXPLAIN' => $lang['foreground_lattice_explain'],
	'L_FOREGROUND_LATTICE_COLOR' => $lang['foreground_lattice_color'],
	'L_FOREGROUND_LATTICE_COLOR_EXPLAIN' => $lang['foreground_lattice_color_explain'],
	'L_GAMMACORRECT' => $lang['gammacorrect'],
	'L_GAMMACORRECT_EXPAIN' => $lang['gammacorrect_explain'] ,
	'L_GENERATE_JPEG' => $lang['generate_jpeg'],
	'L_GENERATE_JPEG_EXPAIN' => $lang['generate_jpeg_explain'],
	'L_JPEG_QUALITY' => $lang['generate_jpeg_quality'],

	'EXAMPLE_CODE' => $new['exsample_code'],
	'WIDTH' => $new['width'],
	'HEIGHT' => $new['height'],
	'BG_TRANSITION' => $new['bg_transition'],
	'BACKGROUND_COLOR' => strtoupper($new['background_color']),
	'PRE_LETTERS' => $new['pre_letters'],
	'LATTICE_X_LINES' => $new['foreground_lattice_x'],
	'LATTICE_Y_LINES' => $new['foreground_lattice_y'],
	'LATTICE_COLOR' => strtoupper($new['lattice_color']),
	'GAMMACORRECT' => $new['gammacorrect'],
	'JPEG_QUALITY' => $new['jpeg_quality'],

	'CAPTCHA_IMG' => '<img src="'.append_sid($phpbb_root_path.'profile.'.$phpEx.'?mode=confirm&amp;id=Admin').'">  <img src="'.append_sid($phpbb_root_path.'profile.'.$phpEx.'?mode=confirm&amp;id=Admin&amp;thumb=1').'">',

	'S_GREAT_PRE_LETTERS_YES' => ($new['pre_letters_great'] == 1) ? 'checked="checked"' : '',
	'S_GREAT_PRE_LETTERS_NO' => ($new['pre_letters_great'] == 0) ? 'checked="checked"' : '',
	'S_RND_FONT_PER_LETTER_YES' => ($new['font'] == 1) ? 'checked="checked"' : '',
	'S_RND_FONT_PER_LETTER_NO' => ($new['font'] == 0) ? 'checked="checked"' : '',
	'S_TRANS_LETTERS_YES' => ($new['trans_letters'] == 1) ? 'checked="checked"' : '',
	'S_TRANS_LETTERS_NO' => ($new['trans_letters'] == 0) ? 'checked="checked"' : '',
	'S_ALLOW_CHESS_YES' => ($new['chess'] == 1) ? 'checked="checked"' : '',
	'S_ALLOW_CHESS_NO' => ($new['chess'] == 0) ? 'checked="checked"' : '',
	'S_ALLOW_CHESS_RND' => ($new['chess'] == 2) ? 'checked="checked"' : '',
	'S_ALLOW_ELLIPSES_YES' => ($new['ellipses'] == 1) ? 'checked="checked"' : '',
	'S_ALLOW_ELLIPSES_NO' => ($new['ellipses'] == 0) ? 'checked="checked"' : '',
	'S_ALLOW_ELLIPSES_RND' => ($new['ellipses'] == 2) ? 'checked="checked"' : '',
	'S_ALLOW_ARCS_YES' => ($new['arcs'] == 1) ? 'checked="checked"' : '',
	'S_ALLOW_ARCS_NO' => ($new['arcs'] == 0) ? 'checked="checked"' : '',
	'S_ALLOW_ARCS_RND' => ($new['arcs'] == 2) ? 'checked="checked"' : '',
	'S_ALLOW_LINES_YES' => ($new['lines'] == 1) ? 'checked="checked"' : '',
	'S_ALLOW_LINES_NO' => ($new['lines'] == 0) ? 'checked="checked"' : '',
	'S_ALLOW_LINES_RND' => ($new['lines'] == 2) ? 'checked="checked"' : '',
	'S_ALLOW_IMAGE_YES' => ($new['image'] == 1) ? 'checked="checked"' : '',
	'S_ALLOW_IMAGE_NO' => ($new['image'] == 0) ? 'checked="checked"' : '',
	'S_JPEG_IMAGE_YES' => ($new['jpeg'] == 1) ? 'checked="checked"' : '',
	'S_JPEG_IMAGE_NO' => ($new['jpeg'] == 0) ? 'checked="checked"' : '',

	'S_HIDDEN_FIELDS' => '',
	'S_CAPTCHA_CONFIG_ACTION' => append_sid('admin_captcha_config.'.$phpEx))
);

$template->pparse("body");

echo '<div align="center"><span class="copyright">Advanced Visual Confirmation ' . $new['avc_version'] . ' &copy; 2006 <a href="http://www.amigalink.de" target="_blank">AmigaLink</a></span></div>';
include('./page_footer_admin.'.$phpEx);
?>
