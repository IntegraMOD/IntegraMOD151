<?php
/***************************************************************************
 *                             album_common.php
 *                            -------------------
 *   begin                : Saturday, February 01, 2003
 *   copyright            : (C) 2003 Smartor
 *   email                : smartor_xp@hotmail.com
 *
 *   $Id: album_common.php,v 2.0.2 2003/03/03 22:38:24 ngoctu Exp $
 *
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
}

define('IN_ALBUM', TRUE);

// Include Language
$language = $board_config['default_lang'];

if ( !file_exists($phpbb_root_path . 'language/lang_' . $language . '/lang_album_main.'.$phpEx) )
{
	$language = 'english';
}

include($phpbb_root_path . 'language/lang_' . $language . '/lang_album_main.' . $phpEx);


// Get Album Config
$sql = "SELECT *
		FROM ". ALBUM_CONFIG_TABLE;
if(!$result = $db->sql_query($sql))
{
	message_die(GENERAL_ERROR, "Could not query Album config information", "", __LINE__, __FILE__, $sql);
}
while( $row = $db->sql_fetchrow($result) )
{
	$album_config_name = $row['config_name'];
	$album_config_value = $row['config_value'];
	$album_config[$album_config_name] = $album_config_value;
}

if($album_config['album_debug_mode'] == 1)
{
	$GLOBALS['album_debug_enabled'] = true;
}
else
{
	$GLOBALS['album_debug_enabled'] = false;
}

if ($album_config['show_img_no_gd'] == 1)
{
	//$thumb_size = 'width="' . $album_config['thumbnail_size'] . '" height="' . $album_config['thumbnail_size'] . '"';
	$thumb_size = 'width="' . $album_config['thumbnail_size'] . '"';
}
else
{
	$thumb_size = '';
}

if ($album_config['show_inline_copyright'] == 0)
{
	$album_copyright = '<div align="center" class="gensmall" style="letter-spacing: -1px"><b>Photo Album Powered by</b><br />';
	$album_copyright .= 'Photo Album 2' . $album_config['album_version'] . '&nbsp;&copy;&nbsp;2002-2003&nbsp;<a href="http://smartor.is-root.com" target="_blank">Smartor</a><br />';
	$album_copyright .= 'Volodymyr (CLowN) Skoryk\'s SP1 Addon 1.5.1<br />';
	$album_copyright .= 'IdleVoid\'s Album Category Hierarchy 1.3.0<br />';
	$album_copyright .= '<a href="http://www.mightygorgon.com" target="_blank">Mighty Gorgon</a> Full Album Pack ' . $album_config['fap_version'];
	$album_copyright .= '</div>';
}
else
{
	$album_copyright = '<div align="center" class="gensmall" style="letter-spacing: -1px"><b>Photo Album Powered by:</b>&nbsp;';
	$album_copyright .= 'Photo Album 2' . $album_config['album_version'] . '&nbsp;<a href="http://smartor.is-root.com" target="_blank">Smartor</a>&nbsp;-&nbsp;';
	$album_copyright .= 'CLowN SP1 Addon 1.5.1&nbsp;-&nbsp;';
	$album_copyright .= 'IdleVoid\'s Album CH 1.3.0&nbsp;-&nbsp;';
	$album_copyright .= '<a href="http://www.mightygorgon.com" target="_blank">Mighty Gorgon</a> Full Album Pack ' . $album_config['fap_version'];
	$album_copyright .= '</div>';
}

$template->assign_vars(array(
	'NAV_SEP' => $lang['Nav_Separator'],
	'NAV_DOT' => '&#8226;',
	'IMG_ALBUM_FOLDER' => $images['pm_outbox'],
	'IMG_ALBUM_SUBFOLDER' => $images['pm_inbox'],
	'IMG_ALBUM_FOLDER_SMALL' => $images['folder'],
	'IMG_ALBUM_FOLDER_SMALL_NEW' => $images['folder_new'],
	'IMG_ALBUM_SUBFOLDER_SMALL' => $images['icon_minipost'],
	'IMG_ALBUM_SUBFOLDER_SMALL_NEW' => $images['icon_minipost_new'],
	'IMG_ALBUM_FOLDER_NEW' => $images['pm_savebox'],
	'IMG_ALBUM_FOLDER_SS' => $images['pm_sentbox'],
	'IMG_SLIDESHOW' => $images['icon_latest_reply'],
	'IMG_SLIDESHOW_NEW' => $images['icon_newest_reply'],
	'IMG_DOT_ORANGE' => '<img src="' . $images['orange_dot'] . '" align="absmiddle" />',
	'IMG_DOT_BLUE' => '<img src="' . $images['blue_dot'] . '" align="absmiddle" />',
	'IMG_DOT_GREEN' => '<img src="' . $images['green_dot'] . '" align="absmiddle" />',
	'IMG_DOT_YELLOW' => '<img src="' . $images['yellow_dot'] . '" align="absmiddle" />',
	'SPACER' => $images['spacer'],

	'THUMB_SIZE' => $thumb_size,

	'U_ALBUM_SEARCH' => append_sid('album_search.' . $phpEx),
	'U_ALBUM_UPLOAD' => append_sid('album_upload.' . $phpEx),

	'ALBUM_VERSION' => '2' . $album_config['album_version'],
	'ALBUM_COPYRIGHT' => $album_copyright
	)
);

if (!isset($album_root_path) || empty($album_root_path))
{
	$album_root_path = $phpbb_root_path . 'album_mod/';
}

include($album_root_path . 'album_functions.' . $phpEx);
include($album_root_path . 'album_hierarchy_functions.' . $phpEx);
include($album_root_path . 'clown_album_functions.' . $phpEx);

?>