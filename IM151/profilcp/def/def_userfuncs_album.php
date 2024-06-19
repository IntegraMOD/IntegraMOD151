<?php

/***************************************************************************
 *							def_userfuncs_album.php
 *							---------------------
 *	begin				: 28/10/2003
 *	copyright			: G-Funk
 *	email				: G-Funk@gmx.at
 *
 *	version				: 1.0.1 - 28/10/2003
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 *
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
	exit;
}

//-----------------------------------
//
// user_album output function
//
//-----------------------------------
function pcp_output_album($field_name, $view_userdata, $map_name='')
{
	global $board_config, $phpbb_root_path, $phpEx, $lang, $images, $userdata, $album_config;
	global $values_list, $tables_linked, $classes_fields, $user_maps, $user_fields, $totalpicrow;

	$txt = '';
	$img = '';
	$res = '';

	if ( $view_userdata['user_id'] != ANONYMOUS )
	{
		$temp_url = append_sid("album.$phpEx?user_id=" . $view_userdata['user_id']);
		$img = '<a class="icon_gallery" href="' . $temp_url . '" title="' . sprintf($lang['Personal_Gallery_Of_User'], $view_userdata['username']) . '"><span>' . $lang['Album'] . '</span></a>';

		$toggle = '';
	if (!empty($album_config['show_all_in_personal_gallery']))
	{
		$u_toggle_view_all = append_sid("album.$phpEx?user_id=" . $view_userdata['user_id'] . "&mode=" . ALBUM_VIEW_ALL);
		$toggle_view_all_img = $images['mini_all_pic_view_mode'];
		$l_toggle_view_all = sprintf($lang['Show_All_Pic_View_Mode_Profile'], $view_userdata['username']);
		$toggle = '<a class="icon_gallery" href="'.$u_toggle_view_all.'" title="'.$l_toggle_view_all.'"><span>' . $lang['Album'] . '</span></a>';
	}
		$u_personal_gallery = append_sid("album.$phpEx?user_id=" . $view_userdata['user_id']);
		$l_personal_gallery = sprintf($lang['Personal_Gallery_Of_User_Profile'], $view_userdata['username'], $totalpicrow);
		$u_all_images_by_user = append_sid("album.$phpEx?user_id=" . $view_userdata['user_id'] . "&mode=" . ALBUM_VIEW_LIST);
		$l_all_images_by_user = sprintf( ( isset($lang['Picture_List_Of_User']) ? $lang['Picture_List_Of_User'] : 'Pictures of %s' ), $view_userdata['username']);
		$txt = '<a href="'.$u_personal_gallery.'">'.$l_personal_gallery.'</a> '.$toggle.' <br /><a href="'.$u_all_images_by_user.'">'.$l_all_images_by_user.'</a>';

		// result
		$res = pcp_output_format($field_name, $txt, $img, $map_name);
	}
	return $res;
}
?>
