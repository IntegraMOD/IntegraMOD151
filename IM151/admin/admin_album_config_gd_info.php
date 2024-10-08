<?php

if (!defined('IN_PHPBB'))
{
	die('Hacking attempt');
}

$album_config_tabs[] =  array(
	'order' => 7,
	'selection' => 'gd_info',
	'title' => $lang['GD_Info'],
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
	'generate_function' => 'album_generate_config_gd_info',
	'template_file' => 'admin/album_config_gd_info_body.tpl'
);

function album_generate_config_gd_info($config_data)
{
	global $template, $lang, $new;
	if (function_exists('gd_info'))
	{
		$var_dump = gd_info();
	}
	$true = '<span style="color:green">' . $lang['GD_True'] . '</span>';
	$false = '<span style="color:red">' . $lang['GD_False'] . '</span>';

	$template->assign_vars(array(
		'VERSION' => $var_dump['GD Version'],
		'FREETYPE_SUPPORT' => ( $var_dump['FreeType Support'] ) ? $true : $false,
		'FREETYPE_LINKAGE' => $var_dump['FreeType Linkage'],
		'T1LIB_SUPPORT' => !empty( $var_dump['T1Lib Support'] ) ? $true : $false,
		'GIF_READ_SUPPORT' => ( $var_dump['GIF Read Support'] ) ? $true : $false,
		'GIF_CREATE_SUPPORT' => ( $var_dump['GIF Create Support'] ) ? $true : $false,
		'JPG_SUPPORT' => !empty( $var_dump['JPG Support'] ) ? $true : $false,
		'PNG_SUPPORT' => ( $var_dump['PNG Support'] ) ? $true : $false,
		'WBMP_SUPPORT' => ( $var_dump['WBMP Support'] ) ? $true : $false,
		'XBM_SUPPORT' => ( $var_dump['XBM Support'] ) ? $true : $false,
		'JIS_MAPPED_SUPPORT' => ( $var_dump['JIS-mapped Japanese Font Support'] ) ? $true : $false,

		'L_TITLE' => $lang['GD_Title'],
		'L_DESCRIPTION' => $lang['GD_Description'],
		'L_VERSION' => $lang['GD_Version'],
		'L_FREETYPE_SUPPORT' => $lang['GD_Freetype_Support'],
		'L_FREETYPE_LINKAGE' => $lang['GD_Freetype_Linkage'],
		'L_T1LIB_SUPPORT' => $lang['GD_T1lib_Support'],
		'L_GIF_READ_SUPPORT' => $lang['GD_Gif_Read_Support'],
		'L_GIF_CREATE_SUPPORT' => $lang['GD_Gif_Create_Support'],
		'L_JPG_SUPPORT' => $lang['GD_Jpg_Support'],
		'L_PNG_SUPPORT' => $lang['GD_Png_Support'],
		'L_WBMP_SUPPORT' => $lang['GD_Wbmp_Support'],
		'L_XBM_SUPPORT' => $lang['GD_XBM_Support'],
		'L_JIS_MAPPED_SUPPORT' => $lang['GD_Jis_Mapped_Support'],

		//'GD_INFO_TEXT' => print_r(gd_info())
		)
	);
}
?>
