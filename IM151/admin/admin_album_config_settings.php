<?php

if (!defined('IN_PHPBB'))
{
	die('Hacking attempt');
}

$album_config_tabs[] =  array(
	'order' => 0,
	'selection' => 'config',
	'title' => $lang['Album_config'],
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
	'generate_function' => 'album_generate_config_settings_box',
	'template_file' => 'admin/album_config_settings_body.tpl'
);

function album_generate_config_settings_box($config_data)
{
	global $template, $lang, $new;

	$template->assign_vars(array(
		'MAX_PICS' => $new['max_pics'],

		'ROWS_PER_PAGE' => $new['rows_per_page'],
		'COLS_PER_PAGE' => $new['cols_per_page'],

		'USER_PICS_LIMIT' => $new['user_pics_limit'],
		'MOD_PICS_LIMIT' => $new['mod_pics_limit'],

		'ALBUM_CATEGORY_SORTING_ID' => ($new['album_category_sorting'] == 'cat_id') ? 'checked="checked"' : '',
		'ALBUM_CATEGORY_SORTING_NAME' => ($new['album_category_sorting'] == 'cat_title') ? 'checked="checked"' : '',
		'ALBUM_CATEGORY_SORTING_ORDER' => ($new['album_category_sorting'] == 'cat_order') ? 'checked="checked"' : '',

		'ALBUM_CATEGORY_SORTING_ASC' => ($new['album_category_sorting_direction'] == 'ASC') ? 'checked="checked"' : '',
		'ALBUM_CATEGORY_SORTING_DESC' => ($new['album_category_sorting_direction'] == 'DESC') ? 'checked="checked"' : '',

		'SHOW_RECENT_IN_SUBCATS_ENABLED' => ($new['show_recent_in_subcats'] == 1) ? 'checked="checked"' : '',
		'SHOW_RECENT_IN_SUBCATS_DISABLED' => ($new['show_recent_in_subcats'] == 0) ? 'checked="checked"' : '',
		'SHOW_RECENT_INSTEAD_OF_NOPICS_ENABLED' => ($new['show_recent_instead_of_nopics'] == 1) ? 'checked="checked"' : '',
		'SHOW_RECENT_INSTEAD_OF_NOPICS_DISABLED' => ($new['show_recent_instead_of_nopics'] == 0) ? 'checked="checked"' : '',

		'ALBUM_DEBUG_MODE_ENABLED' => ($new['album_debug_mode'] == 1) ? 'checked="checked"' : '',
		'ALBUM_DEBUG_MODE_DISABLED' => ($new['album_debug_mode'] == 0) ? 'checked="checked"' : '',

		'HOTLINK_PREVENT_ENABLED' => ($new['hotlink_prevent'] == 1) ? 'checked="checked"' : '',
		'HOTLINK_PREVENT_DISABLED' => ($new['hotlink_prevent'] == 0) ? 'checked="checked"' : '',

		'HOTLINK_ALLOWED' => $new['hotlink_allowed'],

		'RATE_ENABLED' => ($new['rate'] == 1) ? 'checked="checked"' : '',
		'RATE_DISABLED' => ($new['rate'] == 0) ? 'checked="checked"' : '',

		'RATE_SCALE' => $new['rate_scale'],

		'COMMENT_ENABLED' => ($new['comment'] == 1) ? 'checked="checked"' : '',
		'COMMENT_DISABLED' => ($new['comment'] == 0) ? 'checked="checked"' : '',

		'EMAIL_NOTIFICATION_ENABLED' => ($new['email_notification'] == 1) ? 'checked="checked"' : '',
		'EMAIL_NOTIFICATION_DISABLED' => ($new['email_notification'] == 0) ? 'checked="checked"' : '',

		'SHOW_DOWNLOAD_ALWAYS' => ($new['show_download'] == 2) ? 'checked="checked"' : '',
		'SHOW_DOWNLOAD_ENABLED' => ($new['show_download'] == 1) ? 'checked="checked"' : '',
		'SHOW_DOWNLOAD_DISABLED' => ($new['show_download'] == 0) ? 'checked="checked"' : '',

		'SHOW_SLIDESHOW_ENABLED' => ($new['show_slideshow'] == 1) ? 'checked="checked"' : '',
		'SHOW_SLIDESHOW_DISABLED' => ($new['show_slideshow'] == 0) ? 'checked="checked"' : '',

		'SLIDESHOW_SCRIPT_ENABLED' => ($new['slideshow_script'] == 1) ? 'checked="checked"' : '',
		'SLIDESHOW_SCRIPT_DISABLED' => ($new['slideshow_script'] == 0) ? 'checked="checked"' : '',

		'SHOW_PICS_NAV_ENABLED' => ($new['show_pics_nav'] == 1) ? 'checked="checked"' : '',
		'SHOW_PICS_NAV_DISABLED' => ($new['show_pics_nav'] == 0) ? 'checked="checked"' : '',

		'SHOW_INLINE_COPYRIGHT_ENABLED' => ($new['show_inline_copyright'] == 1) ? 'checked="checked"' : '',
		'SHOW_INLINE_COPYRIGHT_DISABLED' => ($new['show_inline_copyright'] == 0) ? 'checked="checked"' : '',

		'NUFFIMAGE_ENABLED' => ($new['enable_nuffimage'] == 1) ? 'checked="checked"' : '',
		'NUFFIMAGE_DISABLED' => ($new['enable_nuffimage'] == 0) ? 'checked="checked"' : '',

		'SEPIABW_ENABLED' => ($new['enable_sepia_bw'] == 1) ? 'checked="checked"' : '',
		'SEPIABW_DISABLED' => ($new['enable_sepia_bw'] == 0) ? 'checked="checked"' : '',

		'SHOW_EXIF_ENABLED' => ($new['show_exif'] == 1) ? 'checked="checked"' : '',
		'SHOW_EXIF_DISABLED' => ($new['show_exif'] == 0) ? 'checked="checked"' : '',

		//--- Language Setup

		'L_MAX_PICS' => $lang['Max_pics'],
		'L_USER_PICS_LIMIT' => $lang['User_pics_limit'],
		'L_MOD_PICS_LIMIT' => $lang['Moderator_pics_limit'],
		'L_MANUAL_THUMBNAIL' => $lang['Manual_thumbnail'],
		'L_HOTLINK_PREVENT' => $lang['Hotlink_prevent'],
		'L_HOTLINK_ALLOWED' => $lang['Hotlink_allowed'],

		'L_ALBUM_CATEGORY_SORTING' => $lang['Album_Category_Sorting'],
		'L_ALBUM_CATEGORY_SORTING_ID' => $lang['Album_Category_Sorting_Id'],
		'L_ALBUM_CATEGORY_SORTING_NAME' => $lang['Album_Category_Sorting_Name'],
		'L_ALBUM_CATEGORY_SORTING_ORDER' => $lang['Album_Category_Sorting_Order'],

		'L_ALBUM_CATEGORY_DIRECTION' => $lang['Album_Category_Sorting_Direction'],
		'L_ALBUM_CATEGORY_SORTING_ASC' => $lang['Album_Category_Sorting_Asc'],
		'L_ALBUM_CATEGORY_SORTING_DESC' => $lang['Album_Category_Sorting_Desc'],

		'L_SHOW_RECENT_IN_SUBCATS' => $lang['Show_Recent_In_Subcats'],
		'L_SHOW_RECENT_INSTEAD_OF_NOPICS' => $lang['Show_Recent_Instead_of_NoPics'],

		'L_RATE_SYSTEM' => $lang['Rate_system'],
		'L_RATE_SCALE' => $lang['Rate_Scale'],
		'L_COMMENT_SYSTEM' => $lang['Comment_system'],

		'L_EMAIL_NOTIFICATION' => $lang['Email_Notification'],
		'L_SHOW_DOWNLOAD' => $lang['Show_Download'],
		'L_SHOW_SLIDESHOW' => $lang['Show_Slideshow'],
		'L_SHOW_SLIDESHOW_SCRIPT' => $lang['Show_Slideshow_Script'],
		'L_SHOW_PICS_NAV' => $lang['Show_Pics_Nav'],
		'L_SHOW_INLINE_COPYRIGHT' => $lang['Show_Inline_Copyright'],
		'L_ENABLE_NUFFIMAGE' => $lang['Enable_Nuffimage'],
		'L_ENABLE_SEPIA_BW' => $lang['Enable_Sepia_BW'],
		'L_SHOW_EXIF' => $lang['Show_EXIF_Info'],

		'L_ALBUM_DEBUG_MODE' => $lang['Album_debug_mode'],

		'L_DISABLED' => $lang['Disabled'],
		'L_ENABLED' => $lang['Enabled'],
		'L_YES' => $lang['Yes'],
		'L_NO' => $lang['No'],
		'L_ALWAYS' => $lang['SP_Always']
		)
	);
}
?>