<?php
/***************************************************************************
 *                            profilcp_profil_photo.php
 *                            --------------------------
 *	begin				: 08/05/2003
 *	copyright			: Ptirhiik
 *	email				: admin@rpgnet-fr.com
 *
 *	version				: 1.0.3 - 17/10/2003
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
if ( !empty($setmodules) )
{
	if ( $board_config['allow_photo_upload'] || $board_config['allow_photo_remote'] || $board_config['allow_photo_local'] )
	{
		pcp_set_sub_menu('profil', 'photo', 80, __FILE__, 'profilcp_photo_shortcut', 'profilcp_photo_pagetitle' );
	}
	return;
}

// check access
if ( ($userdata['user_id'] != $view_userdata['user_id']) && (!is_admin($userdata) || ($level_prior[get_user_level($userdata)] <= $level_prior[get_user_level($view_userdata)])) ) return;

//
// template file
$template->set_filenames(array(
	'body' => 'profilcp/profil_photo_body.tpl')
);

if ($submit)
{
	$user_photo_local = ( !empty($HTTP_POST_VARS['photolocal']) && $board_config['allow_photo_local'] ) ? trim(htmlspecialchars($HTTP_POST_VARS['photolocal'])) : '';
	$user_photo_remoteurl = ( !empty($HTTP_POST_VARS['photoremoteurl']) ) ? trim(htmlspecialchars($HTTP_POST_VARS['photoremoteurl'])) : '';
	$user_photo_upload = ( !empty($HTTP_POST_VARS['photourl']) ) ? trim($HTTP_POST_VARS['photourl']) : ( ( $HTTP_POST_FILES['photo']['tmp_name'] != "none") ? $HTTP_POST_FILES['photo']['tmp_name'] : '' );
	$user_photo_name = ( !empty($HTTP_POST_FILES['photo']['name']) ) ? $HTTP_POST_FILES['photo']['name'] : '';
	$user_photo_size = ( !empty($HTTP_POST_FILES['photo']['size']) ) ? $HTTP_POST_FILES['photo']['size'] : 0;
	$user_photo_filetype = ( !empty($HTTP_POST_FILES['photo']['type']) ) ? $HTTP_POST_FILES['photo']['type'] : '';

	$user_photo = $view_userdata['user_photo'];
	$user_photo_type = $view_userdata['user_photo_type'];

	// check
	$photo_sql = '';
	if ( isset($HTTP_POST_VARS['photodel']) )
	{
		$photo_sql = pcp_user_photo_delete($view_userdata['user_photo_type'], $view_userdata['user_photo']);
	}
	if ( ( !empty($user_photo_upload) || !empty($user_photo_name) ) && $board_config['allow_photo_upload'] )
	{
		if ( !empty($user_photo_upload) )
		{
			$photo_mode = ( !empty($user_photo_name) ) ? 'local' : 'remote';
			$photo_sql = pcp_user_photo_upload($photo_mode, $view_userdata['user_photo'], $view_userdata['user_photo_type'], $error, $error_msg, $user_photo_upload, $user_photo_name, $user_photo_size, $user_photo_filetype);
		}
		else if ( !empty($user_photo_name) )
		{
			$l_photo_size = sprintf($lang['Photo_filesize'], round($board_config['photo_filesize'] / 1024));

			$error = true;
			$error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . $l_photo_size;
		}
	}
	else if ( $user_photo_remoteurl != '' && $board_config['allow_photo_remote'] )
	{
		if ( @file_exists(@phpbb_realpath('./' . $board_config['photo_path'] . '/' . $view_userdata['user_photo'])) )
		{
			@unlink(@phpbb_realpath('./' . $board_config['photo_path'] . '/' . $view_userdata['user_photo']));
		}
		$photo_sql = pcp_user_photo_url($error, $error_msg, $user_photo_remoteurl);
	}
	else if ( $user_photo_local != '' && $board_config['allow_photo_local'] )
	{
		if ( @file_exists(@phpbb_realpath('./' . $board_config['photo_path'] . '/' . $view_userdata['user_photo'])) )
		{
			@unlink(@phpbb_realpath('./' . $board_config['photo_path'] . '/' . $view_userdata['user_photo']));
		}
		$photo_sql = pcp_user_photo_gallery($error, $error_msg, $user_photo_local);
	}

	if ($error) message_die(GENERAL_ERROR, $error_msg);

	if ($photo_sql != '')
	{
		$sql = "UPDATE " . USERS_TABLE . " SET $photo_sql WHERE user_id=$view_user_id"; 
		if ( !($result = $db->sql_query($sql)) ) message_die(GENERAL_ERROR, 'Could not update user table', '', __LINE__, __FILE__, $sql);
	}

}
if (!$submit)
{
	//
	// Let's do an overall check for settings/versions which would prevent
	// us from doing file uploads....
	//
	$ini_val = ( phpversion() >= '4.0.0' ) ? 'ini_get' : 'get_cfg_var';
	$form_enctype = ( @$ini_val('file_uploads') == '0' || strtolower(@$ini_val('file_uploads') == 'off') || phpversion() == '4.0.4pl1' || !$board_config['allow_photo_upload'] || ( phpversion() < '4.0.3' && @$ini_val('open_basedir') != '' ) ) ? '' : 'enctype="multipart/form-data"';

	$template->assign_vars(array(
		'L_PHOTO_PANEL' => $lang['Photo_panel'],
		'L_PHOTO_EXPLAIN' => sprintf($lang['Photo_explain'], $board_config['photo_max_width'], $board_config['photo_max_height'], (round($board_config['photo_filesize'] / 1024))),
		'L_CURRENT_IMAGE' => $lang['Current_Image'],
		'L_DELETE_PHOTO' => $lang['Delete_Image'],
		'L_UPLOAD_PHOTO_FILE' => $lang['Upload_Photo_file'],
		'PHOTO_SIZE' => $board_config['photo_filesize'],
		'L_UPLOAD_PHOTO_URL' => $lang['Upload_Photo_URL'],
		'L_UPLOAD_PHOTO_URL_EXPLAIN' => $lang['Upload_Photo_URL_explain'],
		'L_LINK_REMOTE_PHOTO' => $lang['Link_remote_Photo'],
		'L_LINK_REMOTE_PHOTO_EXPLAIN' => $lang['Link_remote_Photo_explain'],
		'L_PHOTO_GALLERY' => $lang['Select_from_gallery'],
		'L_SHOW_GALLERY' => $lang['View_photo_gallery'],
		'U_PHOTO_SELECT' => append_sid("profile_photo.$phpEx"),

		'L_SUBMIT' => $lang['Submit'],
		'L_PREVIEW' => $lang['Preview'],
		'L_RESET' => $lang['Reset'],
		)
	);

	// get data
	$user_photo = ( $view_userdata['user_allowphoto'] ) ? $view_userdata['user_photo'] : '';
	$user_photo_type = ( $view_userdata['user_allowphoto'] ) ? $view_userdata['user_photo_type'] : USER_PHOTO_NONE;

	$photo_img = '';
	if ( $user_photo_type )
	{
		switch( $user_photo_type )
		{
			case USER_AVATAR_UPLOAD:
				$photo_img = ( $board_config['allow_photo_upload'] ) ? '<img src="' . $board_config['photo_path'] . '/' . $user_photo . '" alt="" />' : '';
				break;
			case USER_AVATAR_REMOTE:
				$photo_img = ( $board_config['allow_photo_remote'] ) ? '<img src="' . $user_photo . '" alt="" />' : '';
				break;
			case USER_AVATAR_GALLERY:
				$photo_img = ( $board_config['allow_photo_local'] ) ? '<img src="' . $board_config['photo_gallery_path'] . '/' . $user_photo . '" alt="" />' : '';
				break;
		}
	}

	// set data
	$template->assign_vars(array(
		'PHOTO' => $photo_img,
		)
	);

	// set switch
	if ( $view_userdata['user_allowphoto'] && ( $board_config['allow_photo_upload'] || $board_config['allow_photo_local'] || $board_config['allow_photo_remote'] ) )
	{
		if ( $board_config['allow_photo_upload'] && file_exists(@phpbb_realpath('./' . $board_config['photo_path'])) )
		{
			if ( $form_enctype != '' )
			{
				$template->assign_block_vars('switch_photo_local_upload', array() );
			}
			$template->assign_block_vars('switch_photo_remote_upload', array() );
		}

		if ( $board_config['allow_photo_remote'] )
		{
			$template->assign_block_vars('switch_photo_remote_link', array() );
		}

		if ( $board_config['allow_photo_local'] && file_exists(@phpbb_realpath('./' . $board_config['photo_gallery_path'])) )
		{
			$template->assign_block_vars('switch_photo_local_gallery', array() );
		}
	}

	// global setting
	$template->assign_vars(array(
		'S_FORM_ENCTYPE' => $form_enctype,
		'S_HIDDEN_FIELDS' => $s_hidden_fields,
		'S_PROFILCP_ACTION' => append_sid("profile.$phpEx"),
		)
	);

	// page
	$template->pparse('body');
}
?>