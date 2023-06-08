<?php

if (!defined('IN_PHPBB'))
{
	die('Hacking attempt');
}

$album_config_tabs[] =  array(
	'order' => 1,
	'selection' => 'index',
	'title' => $lang['Album_Index_Settings'],
	'detail' => '',
	'sub_config' => array(
		/*
		0 => array(
			'order' => 0,
			'selection' => '',
			'title' => '',
			'detail' => ''
		)
		*/
	),
	'config_table_name' => ALBUM_CONFIG_TABLE,
	'generate_function' => 'album_generate_config_index_box',
	'template_file' => 'admin/album_config_index_body.tpl'
);

function album_generate_config_index_box($config_data)
{
	global $template, $lang, $new;

	$template->assign_vars(array(
		'INDEX_SHOW_SUBCATS_ENABLED' => ($new['show_index_subcats'] == 1) ? 'checked="checked"' : '',
		'INDEX_SHOW_SUBCATS_DISABLED' => ($new['show_index_subcats'] == 0) ? 'checked="checked"' : '',
		'INDEX_THUMB_ENABLED' => ($new['show_index_thumb'] == 1) ? 'checked="checked"' : '',
		'INDEX_THUMB_DISABLED' => ($new['show_index_thumb'] == 0) ? 'checked="checked"' : '',
		'INDEX_TOTAL_PICS_ENABLED' => ($new['show_index_total_pics'] == 1) ? 'checked="checked"' : '',
		'INDEX_TOTAL_PICS_DISABLED' => ($new['show_index_total_pics'] == 0) ? 'checked="checked"' : '',
		'INDEX_TOTAL_COMMENTS_ENABLED' => ($new['show_index_total_comments'] == 1) ? 'checked="checked"' : '',
		'INDEX_TOTAL_COMMENTS_DISABLED' => ($new['show_index_total_comments'] == 0) ? 'checked="checked"' : '',
		'INDEX_PICS_ENABLED' => ($new['show_index_pics'] == 1) ? 'checked="checked"' : '',
		'INDEX_PICS_DISABLED' => ($new['show_index_pics'] == 0) ? 'checked="checked"' : '',
		'INDEX_COMMENTS_ENABLED' => ($new['show_index_comments'] == 1) ? 'checked="checked"' : '',
		'INDEX_COMMENTS_DISABLED' => ($new['show_index_comments'] == 0) ? 'checked="checked"' : '',
		'INDEX_LAST_COMMENT_ENABLED' => ($new['show_index_last_comment'] == 1) ? 'checked="checked"' : '',
		'INDEX_LAST_COMMENT_DISABLED' => ($new['show_index_last_comment'] == 0) ? 'checked="checked"' : '',
		'INDEX_LAST_PIC_ENABLED' => ($new['show_index_last_pic'] == 1) ? 'checked="checked"' : '',
		'INDEX_LAST_PIC_DISABLED' => ($new['show_index_last_pic'] == 0) ? 'checked="checked"' : '',
		'INDEX_LAST_PIC_LV_ENABLED' => ($new['show_index_last_pic_lv'] == 1) ? 'checked="checked"' : '',
		'INDEX_LAST_PIC_LV_DISABLED' => ($new['show_index_last_pic_lv'] == 0) ? 'checked="checked"' : '',
		'INDEX_LINEBREAK_ENABLED' => ($new['line_break_subcats'] == 1) ? 'checked="checked"' : '',
		'INDEX_LINEBREAK_DISABLED' => ($new['line_break_subcats'] == 0) ? 'checked="checked"' : '',

		'INDEX_SHOW_PERSONAL_GALLERY_LINK_ENABLED' => ($new['show_personal_gallery_link'] == 1) ? 'checked="checked"' : '',
		'INDEX_SHOW_PERSONAL_GALLERY_LINK_DISABLED' => ($new['show_personal_gallery_link'] == 0) ? 'checked="checked"' : '',
		'NEW_PIC_CHECK_INTERVAL' => $new['new_pic_check_interval'],
		'INDEX_SUPERCELLS_ENABLED' => ($new['index_enable_supercells'] == 1) ? 'checked="checked"' : '',
		'INDEX_SUPERCELLS_DISABLED' => ($new['index_enable_supercells'] == 0) ? 'checked="checked"' : '',

		'L_INDEX_SHOW_SUBCATS' => $lang['Show_Index_Subcats'],
		'L_INDEX_THUMB' => $lang['Show_Index_Thumb'],
		'L_INDEX_TOTAL_PICS' => $lang['Show_Index_Total_Pics'],
		'L_INDEX_TOTAL_COMMENTS' => $lang['Show_Index_Total_Comments'],
		'L_INDEX_PICS' => $lang['Show_Index_Pics'],
		'L_INDEX_COMMENTS' => $lang['Show_Index_Comments'],
		'L_INDEX_LAST_COMMENT' => $lang['Show_Index_Last_Comment'],
		'L_INDEX_LAST_PIC' => $lang['Show_Index_Last_Pic'],
		'L_INDEX_LINEBREAK_SUBCATS' => $lang['Line_Break_Subcats'],

		'L_SHOW_PERSONAL_GALLERY_LINK' => $lang['Show_Personal_Gallery_Link'],

		'L_NEW_PIC_CHECK_INTERVAL' => $lang['New_Pic_Check_Interval'],
		'L_NEW_PIC_CHECK_INTERVAL_DESC' => $lang['New_Pic_Check_Interval_Desc'],
		'L_NEW_PIC_CHECK_INTERVAL_LV' => $lang['New_Pic_Check_Interval_LV'],
		'L_ENABLE_SUPERCELLS' => $lang['Enable_Index_Supercells'],

		'L_DISABLED' => $lang['Disabled'],
		'L_ENABLED' => $lang['Enabled'],
		'L_YES' => $lang['Yes'],
		'L_NO' => $lang['No']
		)
	);
}
?>