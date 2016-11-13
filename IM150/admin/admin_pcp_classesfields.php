<?php

/***************************************************************************
 *							admin_pcp_classesfields.php
 *							---------------------------
 *	begin				: 12/10/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: v 0.0.2 - 15/10/2003
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
define('CT_SECLEVEL', 'MEDIUM');
$ct_ignorepvar = array('sql_def');

if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['PCP_management']['PCP_02_classesfields'] = $file;
	return;
}

//
// Let's set the root dir for phpBB
//
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

include_once($phpbb_root_path . './includes/functions_admin_pcp.' . $phpEx);

include($phpbb_root_path . './profilcp/def/def_userfields.' . $phpEx);
include($phpbb_root_path . './profilcp/def/def_usermaps.' . $phpEx);

//---------------------------------
//
// functions
//
//---------------------------------
function pcp_get_classes_fields()
{
	global $phpbb_root_path, $phpEx;

	// get the parameters
	include($phpbb_root_path . './profilcp/def/def_userfields.' . $phpEx);

	// sort
	$names = array();
	@reset($classes_fields);
	while ( list($class, $data) = @each($classes_fields) )
	{
		$names[] = $class;
	}
	@array_multisort($names, $classes_fields);

	// send the result
	return $classes_fields;
}

//---------------------------------
//
//	process
//
//---------------------------------
// init
$classes = array();
$classes = pcp_get_classes_fields();

//  get parameters
$mode = '';
if (isset($_POST['mode']) || isset($_GET['mode']) )
{
	$mode = isset($_POST['mode']) ? $_POST['mode'] : $_GET['mode'];
}
if ( !in_array($mode, array('edit')) )
{
	$mode = '';
}

// class
$class = '';
if (isset($_POST['class']) || isset($_GET['class']) )
{
	$class = isset($_POST['class']) ? $_POST['class'] : $_GET['class'];
}
if ( empty($classes) || ( !empty($class) && !isset($classes[$class]) ) )
{
	$class = '';
}

// buttons
$submit = isset($_POST['submit']);
$cancel = isset($_POST['cancel']);
$create = isset($_POST['create']);
$delete = isset($_POST['delete']);
$suggest = isset($_POST['suggest']);

if ( $create )
{
	$mode = 'edit';
	$class = '';
}

if ( $mode == 'edit' )
{
	// get info from memory
	$name			= $class;
	$config_field	= isset($classes[$class]['config_field']) ? $classes[$class]['config_field'] : '';
	$admin_field	= isset($classes[$class]['admin_field']) ? $classes[$class]['admin_field'] : '';
	$user_field		= isset($classes[$class]['user_field']) ? $classes[$class]['user_field'] : '';
	$sql_def		= isset($classes[$class]['sql_def']) ? str_replace("\n", ' ', str_replace("\r", '', str_replace("\t", '', $classes[$class]['sql_def']))) : '';

	// get info from form
	$name			= isset($_POST['name']) ? $_POST['name'] : $name;
	$config_field	= isset($_POST['config_field']) ? $_POST['config_field'] : $config_field;
	$admin_field	= isset($_POST['admin_field']) ? $_POST['admin_field'] : $admin_field;
	$user_field		= isset($_POST['user_field']) ? $_POST['user_field'] : $user_field;
	$sql_def		= isset($_POST['sql_def']) ? $_POST['sql_def'] : $sql_def;

	if ( $suggest )
	{
		if ( empty($admin_field) && empty($user_field) )
		{
			$sql_def = '';
		}
		else
		{
			// the user can see all its information
			$sql_def = '[USERS].user_id = [view.user_id]';

			// alternate conditions : not in my ignore list
			$sql_ignore = '( [BUDDY_MY].buddy_ignore <> 1 OR [BUDDY_MY].buddy_ignore IS NULL )';

			// config field provided : add the overwrite parameter
			$sql_config = '';
			if ( !empty($config_field) )
			{
				$sql_config = ' AND ( [board.' . $config_field . '] <> 0 OR [board.' . $config_field . '_over] <> 1 )';
			}

			//admin field provided : add the force user parameter
			$sql_admin = '';
			if ( !empty($admin_field) )
			{
				$sql_admin = ' AND [USERS].' . $admin_field . ' = 1';
			}

			// user field provided : add the comparision with the buddy list settings
			$sql_user = '';
			if ( !empty($user_field) )
			{
				$user_set = '[USERS].' . $user_field . ' = {choice}';
				// force by the general settings
				if ( !empty($config_field) )
				{
					$user_set = '( [USERS].' . $user_field . ' = {choice} OR ([board.' . $config_field . '] = {choice} AND [board.' . $config_field . '_over] = 1) )';
				}
				$sql_user = '[BUDDY_OF].buddy_visible = 1';
				$sql_user .= ' OR ' . str_replace('{choice}', '1', $user_set);
				$sql_user .= ' OR ( [BUDDY_OF].buddy_ignore = 0 AND ' . str_replace('{choice}', '2', $user_set) . ' )';
				$sql_user = ' AND ( ' . $sql_user . ' )';
			}

			// finaly
			$sql_sub = $sql_ignore;
			if ( !empty($sql_config) )
			{
				$sql_sub .= $sql_config;
			}
			if ( !empty($sql_admin) )
			{
				$sql_sub .= $sql_admin;
			}
			if ( !empty($sql_user) )
			{
				$sql_sub .= $sql_user;
			}
			if ( !empty($sql_sub) )
			{
				$sql_def .= ' OR ( ' . $sql_sub . ' )';
			}
		}
	}

	// process
	if ( $cancel )
	{
		$mode = '';
		$class = '';
		$cancel = false;
	}
	else if ( $delete )
	{
		$new_classes = array();
		@reset($classes);
		while ( list($class_name, $class_data) = @each($classes) )
		{
			if ($class_name != $class)
			{
				$new_classes[$class_name] = $class_data;
			}
		}
		$classes = array();
		$classes = $new_classes;

		// output
		pcp_output_fields($values_list, $tables_linked, $classes, $user_maps, $user_fields);

		// prepare feedback message
		$return_path = append_sid("./admin_pcp_classesfields.$phpEx");
		$message = sprintf( $lang['PCP_classesfields_deleted'], '<a href="' . $return_path . '" />', '</a>' );
		message_die( GENERAL_MESSAGE, $message );
	}
	else if ( $submit )
	{
		// perform some checks
		$error = false;
		$error_msg = '';

		// name
		if ( !empty($name) && isset($classes[$name]) && ($name != $class) )
		{
			$error = true;
			$error_msg .= ( empty($error_msg) ? '' : '<br /><br />') . $lang['PCP_err_classesfields_already_exists'];
		}
		if ( empty($name) || !ereg("^[a-zA-Z0-9_]+", $name) )
		{
			$error = true;
			$error_msg .= ( empty($error_msg) ? '' : '<br /><br />') . $lang['PCP_err_classesfields_name_not_valid'];
		}

		// config field
		if ( !empty($config_field) && !ereg("^[a-z0-9_]+", $config_field) )
		{
			$error = true;
			$error_msg .= ( empty($error_msg) ? '' : '<br /><br />') . $lang['PCP_err_classesfields_config_field_not_valid'];
		}

		// admin field
		if ( !empty($admin_field) && !ereg("^[a-z0-9_]+", $admin_field) )
		{
			$error = true;
			$error_msg .= ( empty($error_msg) ? '' : '<br /><br />') . $lang['PCP_err_classesfields_admin_field_not_valid'];
		}

		// user field
		if ( !empty($user_field) && !ereg("^[a-z0-9_]+", $user_field) )
		{
			$error = true;
			$error_msg .= ( empty($error_msg) ? '' : '<br /><br />') . $lang['PCP_err_classesfields_user_field_not_valid'];
		}

		// break if error
		if ( $error )
		{
			message_die( GENERAL_MESSAGE, '<br />' . $error_msg . '<br /><br />');
		}

		// update
		if ( ($name == $class) || empty($class) )
		{
			$classes[$name]['config_field'] = $config_field;
			$classes[$name]['admin_field'] = $admin_field;
			$classes[$name]['user_field'] = $user_field;
			$classes[$name]['sql_def'] = $sql_def;
		}
		else
		{
			$new_classes = array();
			@reset($classes);
			while ( list($class_name, $class_data) = @each($classes) )
			{
				if ($class_name == $class)
				{
					$new_classes[$name]['config_field'] = $config_field;
					$new_classes[$name]['admin_field'] = $admin_field;
					$new_classes[$name]['user_field'] = $user_field;
					$new_classes[$name]['sql_def'] = $sql_def;
				}
				else
				{
					$new_classes[$class_name] = $class_data;
				}
			}
			$classes = array();
			$classes = $new_classes;
		}

		// output
		pcp_output_fields($values_list, $tables_linked, $classes, $user_maps, $user_fields);

		// prepare feedback message
		$return_path = append_sid("./admin_pcp_classesfields.$phpEx");
		$message = sprintf( ( empty($table) ? $lang['PCP_classesfields_created'] : $lang['PCP_classesfields_modified'] ), '<a href="' . $return_path . '" />', '</a>' );
		message_die( GENERAL_MESSAGE, $message );
	}
	else
	{
		// template
		$template->set_filenames(array(
			'body' => 'admin/pcp_classesfields_edit_body.tpl')
		);

		// header
		$template->assign_vars(array(
			'L_TITLE'			=> $lang['PCP_classesfields_edit'],
			'L_TITLE_EXPLAIN'	=> $lang['PCP_classesfields_edit_explain'],

			'L_NAME'			=> $lang['PCP_classesfields_name'],
			'L_NAME_EXPLAIN'	=> $lang['PCP_classesfields_name_explain'],
			'L_CONFIG'			=> $lang['PCP_classesfields_config'],
			'L_CONFIG_EXPLAIN'	=> $lang['PCP_classesfields_config_explain'],
			'L_ADMIN'			=> $lang['PCP_classesfields_admin'],
			'L_ADMIN_EXPLAIN'	=> $lang['PCP_classesfields_admin_explain'],
			'L_USER'			=> $lang['PCP_classesfields_user'],
			'L_USER_EXPLAIN'	=> $lang['PCP_classesfields_user_explain'],
			'L_SQL_DEF'			=> $lang['PCP_classesfields_sql_def'],
			'L_SQL_DEF_EXPLAIN'	=> $lang['PCP_classesfields_sql_def_explain'],

			'L_SUGGEST'			=> $lang['Suggest'],

			'L_SUBMIT'			=> $lang['Submit'],
			'L_REFRESH'			=> $lang['Refresh'],
			'L_DELETE'			=> $lang['Delete'],
			'L_CANCEL'			=> $lang['Cancel'],

			'L_SYSTEM_VALUES'	=> $lang['PCP_system_values'],
			'L_TABLES_LINKED'	=> $lang['PCP_tableslinked'],
			'L_CFG_VALUES'		=> $lang['PCP_config_values'],
			'L_VIEWED_USER'		=> $lang['PCP_view_user_values'],
			'L_ACTING_USER'		=> $lang['PCP_user_values'],
			)
		);

		// list of tables
		$s_tables_opt = '<option value="" selected="selected">' . $lang['None'] . '</option>';
		@reset($tables_linked);
		while ( list($table_name, $table_data) = @each($tables_linked) )
		{
			$s_tables_opt .= '<option value="[' . $table_name . ']">[' . $table_name . ']</option>';
		}

		// list of config values
		@ksort($board_config);
		$s_cfg_values_opt = '<option value="" selected="selected">' . $lang['None'] . '</option>';
		$s_cfg_values_opt .= '<option value="[time]">[time]</option>';
		@reset($board_config);
		while ( list($config_name, $config_data) = @each($board_config) )
		{
			$s_cfg_values_opt .= '<option value="[board.' . $config_name . ']">[board.' . $config_name . ']</option>';
		}

		// list of users viewed/acting
		@ksort($userdata);
		$s_viewed_user = '<option value="" selected="selected">' . $lang['None'] . '</option>';
		$s_acting_user = '<option value="" selected="selected">' . $lang['None'] . '</option>';
		while ( list($field, $value) = @each($userdata) )
		{
			$n_field = intval($field);
			if ($field != "$n_field")
			{
				$s_viewed_user .= '<option value="[view.' . $field . ']">[view.' . $field . ']</option>';
				$s_acting_user .= '<option value="[user.' . $field . ']">[user.' . $field . ']</option>';
			}
		}

		// values
		$template->assign_vars(array(
			'NAME'			=> $name,
			'CONFIG_FIELD'	=> $config_field,
			'ADMIN_FIELD'	=> $admin_field,
			'USER_FIELD'	=> $user_field,
			'SQL_DEF'		=> $sql_def,
			
			'S_TABLES_OPT'	=> $s_tables_opt,
			'S_CFG_VALUES'	=> $s_cfg_values_opt,
			'S_VIEWED_USER'	=> $s_viewed_user,
			'S_ACTING_USER'	=> $s_acting_user,
			)
		);

		// footer
		$s_hidden_fields = '';
		$s_hidden_fields .= '<input type="hidden" name="mode" value="' . $mode . '" />';
		$s_hidden_fields .= '<input type="hidden" name="class" value="' . $class . '" />';
		$template->assign_vars(array(
			'S_ACTION'			=> append_sid("./admin_pcp_classesfields.$phpEx"),
			'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
			)
		);
	}
}

if ($mode == '')
{
	// template
	$template->set_filenames(array(
		'body' => 'admin/pcp_classesfields_body.tpl')
	);

	// header
	$template->assign_vars(array(
		'L_TITLE'			=> $lang['PCP_classesfields'],
		'L_TITLE_EXPLAIN'	=> $lang['PCP_classesfields_explain'],

		'L_NAME'			=> $lang['PCP_classesfields_name'],
		'L_CONFIG'			=> $lang['PCP_classesfields_config'],
		'L_ADMIN'			=> $lang['PCP_classesfields_admin'],
		'L_USER'			=> $lang['PCP_classesfields_user'],
		'L_SQL_DEF'			=> $lang['PCP_classesfields_sql_def'],

		'L_ADD_CLASS'		=> $lang['PCP_classesfields_add'],
		)
	);

	// list
	$color = false;
	@reset($classes);
	while ( list($class_name, $class_data) = @each($classes) )
	{
		$color = !$color;
		$template->assign_block_vars('row', array(
			'COLOR'		=> $color ? 'row1' : 'row2',
			'NAME'		=> $class_name,
			'CONFIG'	=> $class_data['config_field'],
			'ADMIN'		=> $class_data['admin_field'],
			'USER'		=> $class_data['user_field'],
			'SQL_DEF'	=> $class_data['sql_def'],

			'U_NAME'	=> append_sid("./admin_pcp_classesfields.$phpEx?mode=edit&class=$class_name"),
			)
		);
	}

	// footer
	$s_hidden_fields = '';
	$template->assign_vars(array(
		'S_ACTION'			=> append_sid("./admin_pcp_classesfields.$phpEx"),
		'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
		)
	);
}

// dump
$template->pparse('body');
include('./page_footer_admin.'.$phpEx);

?>