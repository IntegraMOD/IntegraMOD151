<?php
/***************************************************************************
 *                            admin_album_auth.php
 *                             -------------------
 *   begin                : Tuesday, February 04, 2003
 *   copyright            : (C) 2003 Smartor
 *   email                : smartor_xp@hotmail.com
 *
 *   $Id: admin_album_auth.php,v 1.0.2 2003/03/05, 19:45:51 ngoctu Exp $
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

define('IN_PHPBB', true);

if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['Photo_Album']['Permissions'] = $filename;
	return;
}

//
// Let's set the root dir for phpBB
//
$phpbb_root_path = '../';
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
require_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_album_main.' . $phpEx);
require_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_album_admin.' . $phpEx);

$album_root_path = $phpbb_root_path . 'album_mod/';
require($album_root_path. 'album_common.'.$phpEx);
$album_user_id = ALBUM_PUBLIC_GALLERY;


// Get info of this cat
$cat_id = isset($_GET['cat_id']) ? intval($_GET['cat_id']) : ( isset($_POST['cat_id']) ? intval($_POST['cat_id']) : -1 );
$sql = "SELECT *
		FROM ". ALBUM_CAT_TABLE ."
		WHERE cat_id = '$cat_id'";
if( !$result = $db->sql_query($sql) )
{
	message_die(GENERAL_ERROR, 'Could not get Category information', '', __LINE__, __FILE__, $sql);
}

$thiscat = $db->sql_fetchrow($result);
if( !isset($_POST['submit']) || !$thiscat )
{
	album_read_tree();
	$s_album_cat_list = album_get_tree_option(ALBUM_ROOT_CATEGORY, ALBUM_AUTH_VIEW, ALBUM_SELECTBOX_INCLUDE_ALL | ALBUM_SELECTBOX_PUBLIC_HEADER);

	$template->set_filenames(array(
		'body' => 'admin/album_cat_select_body.tpl')
	);

	$template->assign_vars(array(
		'L_ALBUM_AUTH_TITLE' => $lang['Album_Auth_Title'],
		'L_ALBUM_AUTH_EXPLAIN' => $lang['Album_Auth_Explain'],
		'L_SELECT_CAT' => $lang['Select_a_Category'],
		'S_ALBUM_ACTION' => append_sid("admin_album_auth.$phpEx"),
		'L_LOOK_UP_CAT' => $lang['Look_up_Category'],
		'CAT_SELECT_TITLE' => $s_album_cat_list)
	);

	$template->pparse('body');

	include('./page_footer_admin.'.$phpEx);
}
else
{
	if( !isset($_GET['cat_id']) )
	{
		$cat_id = intval($_POST['cat_id']);

		$template->set_filenames(array(
			'body' => 'admin/album_auth_body.tpl')
		);

		$template->assign_vars(array(
			'L_ALBUM_AUTH_TITLE' => $lang['Album_Auth_Title'],
			'L_ALBUM_AUTH_EXPLAIN' => $lang['Album_Auth_Explain'],
			'L_SUBMIT' => $lang['Submit'],
			'L_RESET' => $lang['Reset'],

			'L_GROUPS' => $lang['Usergroups'],

			'L_VIEW' => $lang['View'],
			'L_UPLOAD' => $lang['Upload'],
			'L_RATE' => $lang['Rate'],
			'L_COMMENT' => $lang['Comment'],
			'L_EDIT' => $lang['Edit'],
			'L_DELETE' => $lang['Delete'],

			'L_IS_MODERATOR' => $lang['Is_Moderator'],
			'S_ALBUM_ACTION' => append_sid("admin_album_auth.$phpEx?cat_id=$cat_id"),
			)
		);

		// Get the list of phpBB usergroups
		$sql = "SELECT group_id, group_name
				FROM " . GROUPS_TABLE . "
				WHERE group_single_user <> " . TRUE ."
				ORDER BY group_name ASC";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not get group list', '', __LINE__, __FILE__, $sql);
		}

		$groupdata = [];
		while( $row = $db->sql_fetchrow($result) )
		{
			$groupdata[] = $row;
		}
		// V: compute which field is PRIVATE and should be shown
		$auth_keys = array('view', 'upload', 'rate', 'comment', 'edit', 'delete');
		foreach ($auth_keys as $auth_key)
		{
			$show_checkbox = $thiscat['cat_' . $auth_key . '_level'] == ALBUM_PRIVATE;
			$template->assign_var('SHOW_CHECKBOX_'.strtoupper($auth_key), $show_checkbox);
		}

		$view_groups = @explode(',', $thiscat['cat_view_groups']);
		$upload_groups = @explode(',', $thiscat['cat_upload_groups']);
		$rate_groups = @explode(',', $thiscat['cat_rate_groups']);
		$comment_groups = @explode(',', $thiscat['cat_comment_groups']);
		$edit_groups = @explode(',', $thiscat['cat_edit_groups']);
		$delete_groups = @explode(',', $thiscat['cat_delete_groups']);

		$moderator_groups = @explode(',', $thiscat['cat_moderator_groups']);

		for ($i = 0; $i < count($groupdata); $i++)
		{
			$template->assign_block_vars('grouprow', array(
				'GROUP_ID' => $groupdata[$i]['group_id'],
				'GROUP_NAME' => $groupdata[$i]['group_name'],

				'VIEW_CHECKED' => (in_array($groupdata[$i]['group_id'], $view_groups)) ? 'checked="checked"' : '',

				'UPLOAD_CHECKED' => (in_array($groupdata[$i]['group_id'], $upload_groups)) ? 'checked="checked"' : '',

				'RATE_CHECKED' => (in_array($groupdata[$i]['group_id'], $rate_groups)) ? 'checked="checked"' : '',

				'COMMENT_CHECKED' => (in_array($groupdata[$i]['group_id'], $comment_groups)) ? 'checked="checked"' : '',

				'EDIT_CHECKED' => (in_array($groupdata[$i]['group_id'], $edit_groups)) ? 'checked="checked"' : '',

				'DELETE_CHECKED' => (in_array($groupdata[$i]['group_id'], $delete_groups)) ? 'checked="checked"' : '',

				'MODERATOR_CHECKED' => (in_array($groupdata[$i]['group_id'], $moderator_groups)) ? 'checked="checked"' : ''
				)
			);
		}

		$template->pparse('body');

		include('./page_footer_admin.'.$phpEx);
	}
	else
	{
		$cat_id = intval($_GET['cat_id']);
		$groupvars = ['view', 'upload', 'rate', 'comment', 'edit', 'delete', 'moderator'];
		foreach ($groupvars as $groupvar)
		{
			$varname = $groupvar . '_groups';
			$groupvalues = [];
			if (isset($_POST[$groupvar]))
			{
				foreach ($_POST[$groupvar] as $groupvalue)
				{
					$groupvalues[] = intval($groupvalue);
				}
			}
			${$varname} = implode(',', $groupvalues);
		}


		$sql = "UPDATE ". ALBUM_CAT_TABLE ."
				SET cat_view_groups = '$view_groups', cat_upload_groups = '$upload_groups', cat_rate_groups = '$rate_groups', cat_comment_groups = '$comment_groups', cat_edit_groups = '$edit_groups', cat_delete_groups = '$delete_groups',	cat_moderator_groups = '$moderator_groups'
				WHERE cat_id = '$cat_id'";
		if ( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not update Album config table', '', __LINE__, __FILE__, $sql);
		}

		// okay, return a message...
		$message = $lang['Album_Auth_successfully'] . '<br /><br />' . sprintf($lang['Click_return_album_auth'], '<a href="' . append_sid("admin_album_auth.$phpEx") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid("index.$phpEx?pane=right") . '">', '</a>');

		message_die(GENERAL_MESSAGE, $message);
	}
}

/* Powered by Photo Album v2.x.x (c) 2002-2003 Smartor */

?>
