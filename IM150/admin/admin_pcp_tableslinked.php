<?php

/***************************************************************************
 *							admin_pcp_tableslinked.php
 *							--------------------------
 *	begin				: 11/10/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: v 1.0.1 - 20/10/2003
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
	$file = basename(__FILE__);
	$module['PCP_management']['PCP_00_tableslinked'] = $file;
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
function pcp_get_tables_linked()
{
	global $phpbb_root_path, $phpEx;

	// get the parameters
	include($phpbb_root_path . './profilcp/def/def_userfields.' . $phpEx);
	include($phpbb_root_path . './profilcp/def/def_usermaps.' . $phpEx);

	// sort
	$names = array();
	@reset($tables_linked);
	while ( list($table, $data) = @each($tables_linked) )
	{
		$names[] = $table;
	}
	@array_multisort($names, $tables_linked);

	// send the result
	return $tables_linked;
}

//---------------------------------
//
//	process
//
//---------------------------------
// init
$tables = array();
$tables = pcp_get_tables_linked();

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

// table
$table = '';
if (isset($_POST['table']) || isset($_GET['table']) )
{
	$table = isset($_POST['table']) ? $_POST['table'] : $_GET['table'];
}
if ( !empty($table) && !isset($tables[$table]) )
{
	$table = '';
	$mode = '';
}

// buttons
$submit = isset($_POST['submit']);
$create = isset($_POST['create']);
$delete = isset($_POST['delete']);
$cancel = isset($_POST['cancel']);
if ($create)
{
	$table = '';
	$mode = 'edit';
}

// edit a table linked
if ($mode == 'edit')
{
	// coming from memory
	$name		= $table;
	$sql_id		= isset($tables[$table]['sql_id']) ? str_replace("\n", ' ', str_replace("\r", '', str_replace("\t", '', $tables[$table]['sql_id']))) : '';
	$sql_join	= isset($tables[$table]['sql_join']) ? str_replace("\n", ' ', str_replace("\r", '', str_replace("\t", '', $tables[$table]['sql_join']))) : '';
	$sql_where	= isset($tables[$table]['sql_where']) ? str_replace("\n", ' ', str_replace("\r", '', str_replace("\t", '', $tables[$table]['sql_where']))) : '';
	$sql_order	= isset($tables[$table]['sql_order']) ? str_replace("\n", ' ', str_replace("\r", '', str_replace("\t", '', $tables[$table]['sql_order']))) : '';

	// coming from the form
	$name		= isset($_POST['name']) ? $_POST['name'] : $name;
	$sql_id		= isset($_POST['sql_id']) ? $_POST['sql_id'] : $sql_id;
	$sql_join	= isset($_POST['sql_join']) ? $_POST['sql_join'] : $sql_join;
	$sql_where	= isset($_POST['sql_where']) ? $_POST['sql_where'] : $sql_where;
	$sql_order	= isset($_POST['sql_order']) ? $_POST['sql_order'] : $sql_order;

	if ( $cancel )
	{
		$mode = '';
		$cancel = false;
	}
	else if ( $delete )
	{
		$new_tables = array();
		@reset($tables);
		while ( list($table_name, $table_data) = @each($tables) )
		{
			if ($table_name != $table)
			{
				$new_tables[$table_name] = $table_data;
			}
		}
		$tables = array();
		$tables = $new_tables;

		// output
		pcp_output_fields($values_list, $tables, $classes_fields, $user_maps, $user_fields);

		// prepare feedback message
		$return_path = append_sid("./admin_pcp_tableslinked.$phpEx");
		$message = sprintf( $lang['PCP_tableslinked_deleted'], '<a href="' . $return_path . '" />', '</a>' );
		message_die( GENERAL_MESSAGE, $message );
	}
	else if ( $submit )
	{
		// perform some check
		$error = false;
		$error_msg = '';

		// name
		if ( !empty($name) && isset($tables[$name]) && ($name != $table) )
		{
			$error = true;
			$error_msg .= ( empty($error_msg) ? '' : '<br /><br />') . $lang['PCP_err_tableslinked_already_exists'];
		}
		if ( empty($name) || !ereg("^[A-Z0-9_]+", $name) )
		{
			$error = true;
			$error_msg .= ( empty($error_msg) ? '' : '<br /><br />') . $lang['PCP_err_tableslinked_name_not_valid'];
		}

		// sql_id
		if ( empty($sql_id) || !ereg("^[a-z0-9_]+", $sql_id) )
		{
			$error = true;
			$error_msg .= ( empty($error_msg) ? '' : '<br /><br />') . $lang['PCP_err_tableslinked_sql_id_not_valid'];
		}

		// sql_join
		if ( empty($sql_join) )
		{
			$error = true;
			$error_msg .= ( empty($error_msg) ? '' : '<br /><br />') . $lang['PCP_err_tableslinked_sql_join_missing'];
		}

		// break if error
		if ( $error )
		{
			message_die( GENERAL_MESSAGE, '<br />' . $error_msg . '<br /><br />');
		}

		// update
		if ( ($name == $table) || empty($table) )
		{
			$tables[$name]['sql_id'] = $sql_id;
			$tables[$name]['sql_join'] = $sql_join;
			$tables[$name]['sql_where'] = $sql_where;
			$tables[$name]['sql_order'] = $sql_order;
		}
		else
		{
			$new_tables = array();
			@reset($tables);
			while ( list($table_name, $table_data) = @each($tables) )
			{
				if ($table_name == $table)
				{
					$new_tables[$name]['sql_id'] = $sql_id;
					$new_tables[$name]['sql_join'] = $sql_join;
					$new_tables[$name]['sql_where'] = $sql_where;
					$new_tables[$name]['sql_order'] = $sql_order;
				}
				else
				{
					$new_tables[$table_name] = $table_data;
				}
			}
			$tables = array();
			$tables = $new_tables;
		}

		// output
		pcp_output_fields($values_list, $tables, $classes_fields, $user_maps, $user_fields);

		// prepare feedback message
		$return_path = append_sid("./admin_pcp_tableslinked.$phpEx");
		$message = sprintf( ( empty($table) ? $lang['PCP_tableslinked_created'] : $lang['PCP_tableslinked_modified'] ), '<a href="' . $return_path . '" />', '</a>' );
		message_die( GENERAL_MESSAGE, $message );
	}
	else
	{
		// template
		$template->set_filenames(array(
			'body' => 'admin/pcp_tableslinked_edit_body.tpl')
		);

		// header
		$template->assign_vars(array(
			'L_TITLE'				=> $lang['PCP_tableslinked_linked_edit'],
			'L_TITLE_EXPLAIN'		=> $lang['PCP_tableslinked_linked_edit_explain'],

			'L_NAME'				=> $lang['PCP_tableslinked_name'],
			'L_NAME_EXPLAIN'		=> $lang['PCP_tableslinked_name_explain'],
			'L_SQL_ID'				=> $lang['PCP_tableslinked_id'],
			'L_SQL_ID_EXPLAIN'		=> $lang['PCP_tableslinked_id_explain'],
			'L_SQL_JOIN'			=> $lang['PCP_tableslinked_join'],
			'L_SQL_JOIN_EXPLAIN'	=> $lang['PCP_tableslinked_join_explain'],
			'L_SQL_WHERE'			=> $lang['PCP_tableslinked_where'],
			'L_SQL_WHERE_EXPLAIN'	=> $lang['PCP_tableslinked_where_explain'],
			'L_SQL_ORDER'			=> $lang['PCP_tableslinked_order'],
			'L_SQL_ORDER_EXPLAIN'	=> $lang['PCP_tableslinked_order_explain'],

			'L_SUBMIT'				=> $lang['Submit'],
			'L_REFRESH'				=> $lang['Refresh'],
			'L_DELETE'				=> $lang['Delete'],
			'L_CANCEL'				=> $lang['Cancel'],
			)
		);

		// var
		$template->assign_vars(array(
			'NAME'		=> strtoupper($name),
			'SQL_ID'	=> strtolower($sql_id),
			'SQL_JOIN'	=> $sql_join,
			'SQL_WHERE'	=> $sql_where,
			'SQL_ORDER'	=> $sql_order,
			)
		);

		// footer
		$s_hidden_fields = '';
		$s_hidden_fields .= '<input type="hidden" name="mode" value="' . $mode . '" />';
		$s_hidden_fields .= '<input type="hidden" name="table" value="' . $table . '" />';
		$template->assign_vars(array(
			'S_ACTION'			=> append_sid("./admin_pcp_tableslinked.$phpEx"),
			'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
			)
		);
	}
}

if ($mode == '')
{
	// template
	$template->set_filenames(array(
		'body' => 'admin/pcp_tableslinked_body.tpl')
	);

	// header
	$template->assign_vars(array(
		'L_TITLE'			=> $lang['PCP_tableslinked'],
		'L_TITLE_EXPLAIN'	=> $lang['PCP_tableslinked_explain'],

		'L_TABLE_NAME'		=> $lang['PCP_tableslinked_name_short'],
		'L_TABLE_ID'		=> $lang['PCP_tableslinked_id_short'],
		'L_TABLE_SQL_DESC'	=> $lang['PCP_tableslinked_sql_desc'],

		'L_TABLE_JOIN'		=> $lang['PCP_tableslinked_join'],
		'L_TABLE_WHERE'		=> $lang['PCP_tableslinked_where'],
		'L_TABLE_ORDER'		=> $lang['PCP_tableslinked_order'],

		'L_ADD_TABLE'		=> $lang['PCP_tableslinked_add'],
		)
	);

	// dump tables linked list
	$color = false;
	@reset($tables);
	while ( list($table_name, $table_data) = @each($tables) )
	{
		$color = !$color;
		$template->assign_block_vars('row', array(
			'COLOR'			=> $color ? 'row1' : 'row2',
			'TABLE_NAME'	=> $table_name,
			'TABLE_ID'		=> $table_data['sql_id'],
			'TABLE_JOIN'	=> $table_data['sql_join'],
			'TABLE_WHERE'	=> $table_data['sql_where'],
			'TABLE_ORDER'	=> $table_data['sql_order'],

			'U_TABLE'		=> append_sid("./admin_pcp_tableslinked.$phpEx?mode=edit&table=$table_name"),
			)
		);
	}

	// footer
	$s_hidden_fields = '';
	$template->assign_vars(array(
		'S_ACTION'			=> append_sid("./admin_pcp_tableslinked.$phpEx"),
		'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
		)
	);
}

// dump
$template->pparse('body');
include('./page_footer_admin.'.$phpEx);

?>