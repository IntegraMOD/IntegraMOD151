<?php
/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

if (!defined('IN_PHPBB'))
{
	die('Hacking attempt');
}
/*
$phpbb_root_path = '../';
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
*/
require_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_album_main.' . $phpEx);
require_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_album_admin.' . $phpEx);

$album_config_tabs[] =  array(
	'order' => 6,
	'selection' => 'clown',
	'title' => 'Extra', //$lang['Extra_Settings'],
	'detail' => ( isset($lang['SP_Album_clown_config_explain']) ? $lang['SP_Album_clown_config_explain'] : 'Extra' ),
	'sub_config' => array(
		0 => array(
			'order' => 0,
			'selection' => 'general',
			'title' => $lang['SP_Album_sp_general'],
			'detail' => '',
			'template_file' => 'admin/album_config_clown_general_body.tpl'
		),
		1 => array(
			'order' => 2,
			'selection' => 'hotornot',
			'title' => $lang['SP_Album_sp_hotornot'],
			'detail' => '',
			'template_file' => 'admin/album_config_clown_hotnot_body.tpl'
		),
		2 => array(
			'order' => 1,
			'selection' => 'watermark',
			'title' => $lang['SP_Album_sp_watermark'],
			'detail' => '',
			'template_file' => 'admin/album_config_clown_watermark_body.tpl'
		)
	),
	'config_table_name' => ALBUM_CONFIG_TABLE,
	'generate_function' => 'album_generate_config_clown_box',
	'template_file' => 'admin/album_config_sub_body.tpl'
);

function album_generate_config_clown_box($config_data)
{
	global $template, $lang, $phpEx, $new;

	$selected_subtab = get_selected_tab_from_config($config_data);

	$template->assign_vars(array(

		//cat names
		'L_ALBUM_SP_GENERAL' => $lang['SP_Album_sp_general'],
		'L_ALBUM_SP_WATERMARK' => $lang['SP_Album_sp_watermark'],
		'L_ALBUM_SP_HOTORNOT' => $lang['SP_Album_sp_hotornot'],

		//config blocks

		//--------------------
		//General Config Section
		//--------------------
		//rate type
		'L_RATE_TYPE' => $lang['SP_Rate_type'],
		'L_RATE_TYPE_0' => $lang['SP_Rate_type_0'],
		'RATE_TYPE_0' => ($new['rate_type'] == 0) ? 'selected="selected"' : '',
		'L_RATE_TYPE_1' => $lang['SP_Rate_type_1'],
		'RATE_TYPE_1' => ($new['rate_type'] == 1) ? 'selected="selected"' : '',
		'L_RATE_TYPE_2' => $lang['SP_Rate_type_2'],
		'RATE_TYPE_2' => ($new['rate_type'] == 2) ? 'selected="selected"' : '',

		//display latest
		'L_DISPLAY_LATEST' => $lang['SP_Display_latest'],
		'DISPLAY_LATEST_ENABLED' => ($new['disp_late'] == 1) ? 'checked="checked"' : '',
		'DISPLAY_LATEST_DISABLED' => ($new['disp_late'] == 0) ? 'checked="checked"' : '',

		//display highest
		'L_DISPLAY_HIGHEST' => $lang['SP_Display_highest'],
		'DISPLAY_HIGHEST_ENABLED' => ($new['disp_high'] == 1) ? 'checked="checked"' : '',
		'DISPLAY_HIGHEST_DISABLED' => ($new['disp_high'] == 0) ? 'checked="checked"' : '',

		//display most viewed
		'L_DISPLAY_MOST_VIEWED' => $lang ['SP_Display_most_viewed'],
		'DISPLAY_MOST_VIEWED_ENABLED' => ($new['disp_mostv'] == 1) ? 'checked="checked"' : '',
		'DISPLAY_MOST_VIEWED_DISABLED' => ($new['disp_mostv'] == 0) ? 'checked="checked"' : '',

		//display random
		'L_DISPLAY_RANDOM' => $lang['SP_Display_random'],
		'DISPLAY_RANDOM_ENABLED' => ($new['disp_rand'] == 1) ? 'checked="checked"' : '',
		'DISPLAY_RANDOM_DISABLED' => ($new['disp_rand'] == 0) ? 'checked="checked"' : '',

		//how many pics
		'L_PIC_ROW' => $lang['SP_Pic_row'],
		'L_PIC_COL' => $lang['SP_Pic_col'],
		'PIC_ROW' => $new['img_rows'],
		'PIC_COL' => $new['img_cols'],

		//mid thumbnail
		'L_MIDTHUMB_USE' => $lang['SP_Midthumb_use'],
		'MIDTHUMB_ENABLED' => ($new['midthumb_use'] == 1) ? 'checked="checked"' : '',
		'MIDTHUMB_DISABLED' => ($new['midthumb_use'] == 0) ? 'checked="checked"' : '',

		//mid thumbnail cache
		'L_MIDTHUMB_CACHE' => $lang['SP_Midthumb_cache'],
		'MIDTHUMB_CACHE_ENABLED' => ($new['midthumb_cache'] == 1) ? 'checked="checked"' : '',
		'MIDTHUMB_CACHE_DISABLED' => ($new['midthumb_cache'] == 0) ? 'checked="checked"' : '',

		//wut size fo midthumbnail
		'L_MIDTHUMB_HEIGHT' => $lang['SP_Midthumb_high'],
		'MIDTHUMB_HEIGHT' => $new['midthumb_height'],
		'L_MIDTHUMB_WIDTH' => $lang['SP_Midthumb_width'],
		'MIDTHUMB_WIDTH' => $new['midthumb_width'],


		//--------------------
		//WaterMark Section
		//--------------------
		//watermark
		'L_WATERMARK' => $lang['SP_Watermark'],
		'WATERMARK_ENABLED' => ($new['use_watermark'] == 1) ? 'checked="checked"' : '',
		'WATERMARK_DISABLED' => ($new['use_watermark'] == 0) ? 'checked="checked"' : '',

		//fo wut users
		'L_WATERMARK_USERS' => $lang['SP_Watermark_users'],
		'WATERMARK_USERS_ENABLED' => ($new['wut_users'] == 1) ? 'checked="checked"' : '',
		'WATERMARK_USERS_DISABLED' => ($new['wut_users'] == 0) ? 'checked="checked"' : '',

		//watermark placement
		'L_WATERMARK_PLACENT' => $lang['SP_Watermark_placent'],
		'WATERMARK_PLACEMENT_1' => ($new['disp_watermark_at'] == 1) ? 'checked="checked"' : '',
		'WATERMARK_PLACEMENT_2' => ($new['disp_watermark_at'] == 2) ? 'checked="checked"' : '',
		'WATERMARK_PLACEMENT_3' => ($new['disp_watermark_at'] == 3) ? 'checked="checked"' : '',
		'WATERMARK_PLACEMENT_4' => ($new['disp_watermark_at'] == 4) ? 'checked="checked"' : '',
		'WATERMARK_PLACEMENT_5' => ($new['disp_watermark_at'] == 5) ? 'checked="checked"' : '',
		'WATERMARK_PLACEMENT_6' => ($new['disp_watermark_at'] == 6) ? 'checked="checked"' : '',
		'WATERMARK_PLACEMENT_7' => ($new['disp_watermark_at'] == 7) ? 'checked="checked"' : '',
		'WATERMARK_PLACEMENT_8' => ($new['disp_watermark_at'] == 8) ? 'checked="checked"' : '',
		'WATERMARK_PLACEMENT_9' => ($new['disp_watermark_at'] == 9) ? 'checked="checked"' : '',

		//--------------------
		//Hot or Not Config Section
		//--------------------
		//already rated?
		'L_HON_ALREDY_RATED' => $lang['SP_Hon_already_rated'],
		'HON_ALREADY_RATED_ENABLED' => ($new['hon_rate_times'] == 1) ? 'checked="checked"' : '',
		'HON_ALREADY_RATED_DISABLED' => ($new['hon_rate_times'] == 0) ? 'checked="checked"' : '',

		//use sep table for hon rating?
		'L_HON_SEP_RATING' => $lang['SP_Hon_sep_rating'],
		'HON_SEP_RATING_ENABLED' => ($new['hon_rate_sep'] == 1) ? 'checked="checked"' : '',
		'HON_SEP_RATING_DISABLED' => ($new['hon_rate_sep'] == 0) ? 'checked="checked"' : '',

		//take pics from
		'L_HON_WHERE' => $lang['SP_Hon_where'],
		'HON_WHERE' => $new['hon_rate_where'],

		//if user anon
		'L_HON_USERS' => $lang['SP_Hon_users'],
		'HON_USERS_ENABLED' => ($new['hon_rate_users'] == 1) ? 'checked="checked"' : '',
		'HON_USERS_DISABLED' => ($new['hon_rate_users'] == 0) ? 'checked="checked"' : '',

		'L_DISABLED' => $lang['SP_Disabled'],
		'L_ENABLED' => $lang['SP_Enabled'],
		'L_YES' => $lang['SP_Yes'],
		'L_NO' => $lang['SP_No'],
		'L_SUBMIT' => $lang['SP_Submit'],
		'L_RESET' => $lang['SP_Reset'])
	);
}

?>
