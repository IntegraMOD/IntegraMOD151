<?php
/***************************************************************************
 *                            profilcp_profil_avatar.php
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
	if ( $board_config['allow_avatar_upload'] || $board_config['allow_avatar_remote'] || $board_config['allow_avatar_local'] )
	{
		pcp_set_sub_menu('profil', 'avatar', 30, __FILE__, 'profilcp_avatar_shortcut', 'profilcp_avatar_pagetitle' );
	}
	return;
}

// check access
if ( ($userdata['user_id'] != $view_userdata['user_id']) && (!is_admin($userdata) || ($level_prior[get_user_level($userdata)] <= $level_prior[get_user_level($view_userdata)])) ) return;

//
// template file
$template->set_filenames(array(
	'body' => 'profilcp/profil_avatar_body.tpl')
);

if ($submit)
{
	$user_avatar_local = ( !empty($_POST['avatarlocal']) && $board_config['allow_avatar_local'] ) ? trim(htmlspecialchars($_POST['avatarlocal'])) : '';
	$user_avatar_category = ( !empty($_POST['avatarcatname']) && $board_config['allow_avatar_local'] ) ? trim(htmlspecialchars($_POST['avatarcatname'])) : '' ;
	$user_avatar_remoteurl = ( !empty($_POST['avatarremoteurl']) ) ? trim(htmlspecialchars($_POST['avatarremoteurl'])) : '';
	$user_avatar_upload = ( !empty($_POST['avatarurl']) ) ? trim($_POST['avatarurl']) : ( ( $_FILES['avatar']['tmp_name'] != "none") ? $_FILES['avatar']['tmp_name'] : '' );
	$user_avatar_name = ( !empty($_FILES['avatar']['name']) ) ? $_FILES['avatar']['name'] : '';
	$user_avatar_size = ( !empty($_FILES['avatar']['size']) ) ? $_FILES['avatar']['size'] : 0;
	$user_avatar_filetype = ( !empty($_FILES['avatar']['type']) ) ? $_FILES['avatar']['type'] : '';

	$user_avatar = $view_userdata['user_avatar'];
	$user_avatar_type = $view_userdata['user_avatar_type'];

	// check
	$avatar_sql = '';
	if ( isset($_POST['avatardel']) )
	{
		$avatar_sql = pcp_user_avatar_delete($view_userdata['user_avatar_type'], $view_userdata['user_avatar']);
	}
	if ( ( !empty($user_avatar_upload) || !empty($user_avatar_name) ) && $board_config['allow_avatar_upload'] )
	{
		if ( !empty($user_avatar_upload) )
		{
			$avatar_mode = ( !empty($user_avatar_name) ) ? 'local' : 'remote';
			$avatar_sql = pcp_user_avatar_upload($avatar_mode, $view_userdata['user_avatar'], $view_userdata['user_avatar_type'], $error, $error_msg, $user_avatar_upload, $user_avatar_name, $user_avatar_size, $user_avatar_filetype);
		}
		else if ( !empty($user_avatar_name) )
		{
			$l_avatar_size = sprintf($lang['Avatar_filesize'], round($board_config['avatar_filesize'] / 1024));

			$error = true;
			$error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . $l_avatar_size;
		}
	}
	else if ( $user_avatar_remoteurl != '' && $board_config['allow_avatar_remote'] )
	{
      pcp_user_avatar_delete($view_userdata['user_avatar_type'], $view_userdata['user_avatar']); 
      $avatar_sql = pcp_user_avatar_url($error, $error_msg, $user_avatar_remoteurl); 
	} 
	else if ( $user_avatar_local != '' && $board_config['allow_avatar_local'] ) 
	{ 
      pcp_user_avatar_delete($view_userdata['user_avatar_type'], $view_userdata['user_avatar']); 
      $avatar_sql = pcp_user_avatar_gallery($error, $error_msg, $user_avatar_local, $user_avatar_category);
	}

	if ($error) message_die(GENERAL_ERROR, $error_msg);

	if ($avatar_sql != '')
	{
		$sql = "UPDATE " . USERS_TABLE . " SET $avatar_sql WHERE user_id=$view_user_id"; 
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
	$form_enctype = ( @$ini_val('file_uploads') == '0' || strtolower(@$ini_val('file_uploads') == 'off') || phpversion() == '4.0.4pl1' || !$board_config['allow_avatar_upload'] || ( phpversion() < '4.0.3' && @$ini_val('open_basedir') != '' ) ) ? '' : 'enctype="multipart/form-data"';

	$template->assign_vars(array(
		'L_AVATAR_PANEL' => $lang['Avatar_panel'],
		'L_AVATAR_EXPLAIN' => sprintf($lang['Avatar_explain'], $board_config['avatar_max_width'], $board_config['avatar_max_height'], (round($board_config['avatar_filesize'] / 1024))),
		'L_CURRENT_IMAGE' => $lang['Current_Image'],
		'L_DELETE_AVATAR' => $lang['Delete_Image'],
		'L_UPLOAD_AVATAR_FILE' => $lang['Upload_Avatar_file'],
		'AVATAR_SIZE' => $board_config['avatar_filesize'],
		'L_UPLOAD_AVATAR_URL' => $lang['Upload_Avatar_URL'],
		'L_UPLOAD_AVATAR_URL_EXPLAIN' => $lang['Upload_Avatar_URL_explain'],
		'L_LINK_REMOTE_AVATAR' => $lang['Link_remote_Avatar'],
		'L_LINK_REMOTE_AVATAR_EXPLAIN' => $lang['Link_remote_Avatar_explain'],
		'L_AVATAR_GALLERY' => $lang['Select_from_gallery'],
		'L_SHOW_GALLERY' => $lang['View_avatar_gallery'],
		'U_AVATAR_SELECT' => append_sid("profile_avatar.$phpEx"),

		'L_SUBMIT' => $lang['Submit'],
		'L_PREVIEW' => $lang['Preview'],
		'L_RESET' => $lang['Reset'],
		)
	);

	// get data
	$user_avatar = ( $view_userdata['user_allowavatar'] ) ? $view_userdata['user_avatar'] : '';
	$user_avatar_type = ( $view_userdata['user_allowavatar'] ) ? $view_userdata['user_avatar_type'] : USER_AVATAR_NONE;

	$avatar_img = '';
	if ( $user_avatar_type )
	{
		switch( $user_avatar_type )
		{
			case USER_AVATAR_UPLOAD:
				$avatar_img = ( $board_config['allow_avatar_upload'] ) ? '<img src="' . $board_config['avatar_path'] . '/' . $user_avatar . '" alt="" />' : '';
				break;
			case USER_AVATAR_REMOTE:
				$avatar_img = ( $board_config['allow_avatar_remote'] ) ? '<img src="' . $user_avatar . '" alt="" />' : '';
				break;
			case USER_AVATAR_GALLERY:
				$avatar_img = ( $board_config['allow_avatar_local'] ) ? '<img src="' . $board_config['avatar_gallery_path'] . '/' . $user_avatar . '" alt="" />' : '';
				break;
		}
	}

	// set data
	$template->assign_vars(array(
		'AVATAR' => $avatar_img,
		)
	);

	// set switch
	if ( $view_userdata['user_allowavatar'] && ( $board_config['allow_avatar_upload'] || $board_config['allow_avatar_local'] || $board_config['allow_avatar_remote'] ) )
	{
		if ( $board_config['allow_avatar_upload'] && file_exists(@phpbb_realpath('./' . $board_config['avatar_path'])) )
		{
			if ( $form_enctype != '' )
			{
				$template->assign_block_vars('switch_avatar_local_upload', array() );
			}
			$template->assign_block_vars('switch_avatar_remote_upload', array() );
		}

		if ( $board_config['allow_avatar_remote'] )
		{
			$template->assign_block_vars('switch_avatar_remote_link', array() );
		}

		if ( $board_config['allow_avatar_local'] && file_exists(@phpbb_realpath('./' . $board_config['avatar_gallery_path'])) )
		{
			$template->assign_block_vars('switch_avatar_local_gallery', array() );
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
