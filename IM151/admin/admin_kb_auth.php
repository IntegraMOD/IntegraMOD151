<?php
/** ------------------------------------------------------------------------
 *		subject				: mx-portal module
 *		begin            	: june, 2002
 *		copyright          	: (C) 2002-2005 MX-System
 *		email             	: jonohlsson@hotmail.com
 *		project site		: www.mx-system.com
 * 
 *		description			:
 * 
 *    $Id: admin_kb_auth.php,v 1.7 2005/04/20 19:30:17 jonohlsson Exp $
 */

/**
 * This program is free software; you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation; either version 2 of the License, or
 *    (at your option) any later version.
 */


if ( !empty( $setmodules ) )
{
	$file = basename( __FILE__ );
	$module['KB_title']['Permissions'] = $file;
	return;
}	
define( 'IN_PHPBB', 1 );
define( 'IN_PORTAL', 1 );
define( 'MXBB_MODULE', false );

$phpbb_root_path = $module_root_path = $mx_root_path = "./../";
require( $phpbb_root_path . 'extension.inc' );
require( './pagestart.' . $phpEx );
include( $phpbb_root_path . 'includes/functions_admin.'.$phpEx );
include( $phpbb_root_path . 'includes/kb_constants.' . $phpEx );
include( $phpbb_root_path . 'includes/functions_kb.' . $phpEx );
include( $phpbb_root_path . 'includes/functions_kb_auth.' . $phpEx );	
include( $phpbb_root_path . 'includes/functions_kb_field.' . $phpEx );	
include( $phpbb_root_path . 'includes/functions_kb_mx.' . $phpEx );	
include( $phpbb_root_path . 'includes/functions_search.' . $phpEx );	

if ( !isset( $_POST['submit'] ) )
{
	$s_kb_cat_list = get_kb_cat_list( '', 0, 1, 0, 0, true ); 
	$template->set_filenames( array( 'body' => 'admin/kb_cat_select_body.tpl' ) 
		);

	$template->assign_vars( array( 'L_KB_AUTH_TITLE' => $lang['KB_Auth_Title'],
			'L_KB_AUTH_EXPLAIN' => $lang['KB_Auth_Explain'],
			'L_SELECT_CAT' => $lang['Select_a_Category'],
			'S_KB_ACTION' => append_sid( "admin_kb_auth.$phpEx" ),
			'L_LOOK_UP_CAT' => $lang['Look_up_Category'], 
			'CAT_SELECT_TITLE' => $s_kb_cat_list ) 
		);

	$template->pparse( 'body' );

	include( $mx_root_path . 'admin/page_footer_admin.' . $phpEx );
}
else
{
	if ( !isset( $_GET['cat_id'] ) )
	{
		$cat_id = intval( $_POST['cat_id'] );

		$template->set_filenames( array( 'body' => 'admin/kb_cat_auth_body.tpl' ) 
			);

		$template->assign_vars( array( 
				'L_SUBMIT' => $lang['Submit'],
				'L_RESET' => $lang['Reset'],

				'L_GROUPS' => $lang['Usergroups'],

				'L_VIEW' => $lang['View'],
				'L_UPLOAD' => $lang['Upload'],
				'L_RATE' => $lang['Rate'],
				'L_COMMENT' => $lang['Comment'],
				'L_EDIT' => $lang['Edit'],
				'L_DELETE' => $lang['Delete'],
				// 'L_APPROVAL' => $lang['Approval'],
				// 'L_APPROVAL_EDIT' => $lang['Approval_edit'],

				'L_IS_MODERATOR' => $lang['Is_Moderator'],
				'S_ALBUM_ACTION' => append_sid( "admin_kb_auth.$phpEx?cat_id=$cat_id" ), 
				) 
			); 
		// Get the list of phpBB usergroups
		$sql = "SELECT group_id, group_name
				FROM " . GROUPS_TABLE . "
				WHERE group_single_user <> " . true . "
				ORDER BY group_name ASC";
		if ( !( $result = $db->sql_query( $sql ) ) )
		{
			mx_message_die( GENERAL_ERROR, 'Could not get group list', '', __LINE__, __FILE__, $sql );
		}

		while ( $kb_row = $db->sql_fetchrow( $result ) )
		{
			$groupdata[] = $kb_row;
		} 
		// Get info of this cat
		$sql = "SELECT *
				FROM " . KB_CATEGORIES_TABLE . "
				WHERE category_id = '$cat_id'";
		if ( !$result = $db->sql_query( $sql ) )
		{
			mx_message_die( GENERAL_ERROR, 'Could not get Category information', '', __LINE__, __FILE__, $sql );
		}

		$thiscat = $db->sql_fetchrow( $result );

		// V: compute which field is PRIVATE and should be shown
		$auth_keys = array('view', 'post', 'rate', 'comment', 'edit', 'delete');
		foreach ($auth_keys as $auth_key)
		{
			$show_checkbox = $thiscat['auth_' . $auth_key] == AUTH_ACL;
			$template->assign_var('SHOW_CHECKBOX_'.strtoupper($auth_key), $show_checkbox);
		}

		$view_groups = @explode( ',', $thiscat['auth_view_groups'] );
		$post_groups = @explode( ',', $thiscat['auth_post_groups'] );
		$rate_groups = @explode( ',', $thiscat['auth_rate_groups'] );
		$comment_groups = @explode( ',', $thiscat['auth_comment_groups'] );
		$edit_groups = @explode( ',', $thiscat['auth_edit_groups'] );
		$delete_groups = @explode( ',', $thiscat['auth_delete_groups'] );
		// $approval_groups = @explode( ',', $thiscat['auth_approval_groups'] );
		// $approval_edit_groups = @explode( ',', $thiscat['auth_approval_edit_groups'] );

		$moderator_groups = @explode( ',', $thiscat['auth_moderator_groups'] );

		for ( $i = 0; $i < count_safe( $groupdata ); $i++ )
		{
			$template->assign_block_vars( 'grouprow', array( 'GROUP_ID' => $groupdata[$i]['group_id'],
					'GROUP_NAME' => $groupdata[$i]['group_name'],

					'VIEW_CHECKED' => ( in_array( $groupdata[$i]['group_id'], $view_groups ) ) ? 'checked="checked"' : '',

					'POST_CHECKED' => ( in_array( $groupdata[$i]['group_id'], $post_groups ) ) ? 'checked="checked"' : '',

					'RATE_CHECKED' => ( in_array( $groupdata[$i]['group_id'], $rate_groups ) ) ? 'checked="checked"' : '',

					'COMMENT_CHECKED' => ( in_array( $groupdata[$i]['group_id'], $comment_groups ) ) ? 'checked="checked"' : '',

					'EDIT_CHECKED' => ( in_array( $groupdata[$i]['group_id'], $edit_groups ) ) ? 'checked="checked"' : '',

					'DELETE_CHECKED' => ( in_array( $groupdata[$i]['group_id'], $delete_groups ) ) ? 'checked="checked"' : '',
					
					// 'APPROVAL_CHECKED' => ( in_array( $groupdata[$i]['group_id'], $approval_groups ) ) ? 'checked="checked"' : '',
					
					// 'APPROVAL_EDIT_CHECKED' => ( in_array( $groupdata[$i]['group_id'], $approval_edit_groups ) ) ? 'checked="checked"' : '',

					'MODERATOR_CHECKED' => ( in_array( $groupdata[$i]['group_id'], $moderator_groups ) ) ? 'checked="checked"' : '' ) 
				);
		}

		$template->pparse( 'body' );

		include( $mx_root_path . 'admin/page_footer_admin.' . $phpEx );
	}
	else
	{
		$cat_id = intval( $_GET['cat_id'] );
		$groupvars = ['view', 'post', 'rate', 'comment', 'edit', 'delete', 'moderator', 'approval', 'approval_edit'];
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


		$sql = "UPDATE " . KB_CATEGORIES_TABLE . "
				SET auth_view_groups = '$view_groups', auth_post_groups = '$post_groups', auth_rate_groups = '$rate_groups', auth_comment_groups = '$comment_groups', auth_edit_groups = '$edit_groups', auth_delete_groups = '$delete_groups', auth_approval_groups = '$approval_groups', auth_approval_edit_groups = '$approval_edit_groups',	auth_moderator_groups = '$moderator_groups'
				WHERE category_id = '$cat_id'";
		if ( !$result = $db->sql_query( $sql ) )
		{
			mx_message_die( GENERAL_ERROR, 'Could not update KB config table', '', __LINE__, __FILE__, $sql );
		} 
		$message = $lang['KB_Auth_successfully'] . '<br /><br />' . sprintf( $lang['Click_return_KB_auth'], '<a href="' . append_sid( "admin_kb_auth.$phpEx" ) . '">', '</a>' ) . '<br /><br />' . sprintf( $lang['Click_return_admin_index'], '<a href="' . append_sid( $mx_root_path . "admin/index.$phpEx?pane=right" ) . '">', '</a>' );

		mx_message_die( GENERAL_MESSAGE, $message );
	}
}

?>
