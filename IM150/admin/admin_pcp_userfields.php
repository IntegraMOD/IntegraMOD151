<?php

/***************************************************************************
 *							admin_pcp_userfiels.php
 *							-----------------------
 *	begin				: 08/10/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: v 0.0.6 - 15/10/2003
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
	$module['PCP_management']['PCP_03_userfields'] = $file;
	return;
}

//
// Let's set the root dir for phpBB
//
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
include_once($phpbb_root_path . './includes/functions_admin_pcp.' . $phpEx);

// sort available
$sort_list = array('name', 'class', 'type', 'get_mode');
$order_list = array('ASC', 'DESC');

include($phpbb_root_path . './profilcp/def/def_userfields.' . $phpEx);
include($phpbb_root_path . './profilcp/def/def_usermaps.' . $phpEx);
include($phpbb_root_path . './profilcp/def/def_userfields_phpbb.' . $phpEx);

//---------------------------------
//
// functions
//
//---------------------------------

// perform an sql modification on table
function pcp_sql_query($field, $action, $field_def=array(), $old='')
{
	global $db, $lang;

	// description
	$type = $field_def['type'];
	$length = $field_def['length'];
	$decimal = $field_def['decimal'];
	$unsigned = $field_def['unsigned'];
	$not_null = $field_def['not_null'];
	$default = $field_def['default'];
	$default_null = ($field_def['default'] == NULL);

	// init
	$error = false;
	$error_msg = '';
	$sql = array();

	if ( ($action == 'create') || ($action == 'edit') )
	{
		// sql requests
		switch (SQL_LAYER)
		{
			case 'mysql':
			case 'mysql4':
			case 'mysqli':
				$w_old = $old;
				if ( empty($old) )
				{
					$w_old = $field;
				}
				$def = $type;
				if ( !empty($length) )
				{
					if ( !empty($decimal) )
					{
						$def .= "($length,$decimal)";
					}
					else
					{
						$def .= "($length)";
					}
				}
				if ( !empty($unsigned) )
				{
					$def .= " UNSIGNED";
				}
				if ( $not_null )
				{
					$def .= " NOT NULL";
				}
				if ( !empty($default) || $default_null )
				{
					$def .= " DEFAULT " . ($default_null ? 'NULL' : "'" . str_replace("\'", "''", $default) . "'");
				}

				// modify name and definition
				if ( $action == 'create' )
				{
					$sql[] = "ALTER TABLE " . USERS_TABLE . " ADD $field $def";
				}
				else
				{
					$sql[] = "ALTER TABLE " . USERS_TABLE . " CHANGE $w_old $field $def";
				}
				break;

			case 'postgresql':
				// create the new column
				$def = '';
				switch ($type)
				{
					case 'TINYINT':
					case 'SMALLINT':
						$def = 'SMALLINT';
						break;
					case 'MEDIUMINT':
					case 'INT':
						$def = 'INTEGER';
						break;
					case 'BIGINT':
						$def = 'BIGINT';
						break;
					case 'DECIMAL':
						$def = "DECIMAL($length)";
						break;
					default:
						$def = "$type($length)";
						break;
				}

				// default
				if ( !empty($default) )
				{
					$w_def = $is_numeric ? "'%'" : '%'; 
					$def .= " SET DEFAULT " . sprintf($w_def, $default);
				}
				// not null
				if ( $not_null )
				{
					$def .= " SET NOT NULL";
				}

				// save the column value to newname_old
				$sql[] = "ALTER TABLE " . USERS_TABLE . " RENAME COLUMN " . ( (!empty($old) && ($old != $field)) ? $old : $field ) . " TO $field_old";

				// create a new field
				$sql[] = "ALTER TABLE " . USERS_TABLE . " ADD COLUMN $field $def";

				// get back saved values
				$sql[] = "UPDATE " . USERS_TABLE . " SET $field=$field_old";

				// remove the saved column
				$sql[] = "ALTER TABLE " . USERS_TABLE . " DROP $field_old";
				break;

			case 'mssql':
			case 'mssql-odbc':
				// create the new column
				$def = '';
				switch ($type)
				{
					case 'TINYINT':
						$def = 'TINYINT';
						break;
					case 'SMALLINT':
						$def = 'SMALLINT';
						break;
					case 'MEDIUMINT':
					case 'INT':
						$def = 'INTEGER';
						break;
					case 'BIGINT':
						$def = 'BIGINT';
						break;
					case 'DECIMAL':
						$def = "DECIMAL($length, $decimal)";
						break;
					default:
						$def = "$type($length)";
						break;
				}
				if ( $not_null )
				{
					$def .= " NOT NULL";
				}
				if ( !empty($default) || $default_null )
				{
					$def .= " DEFAULT " . ($default_null ? 'NULL' : "'" . str_replace("\'", "''", $default) . "'");
				}

				if ($action == 'create')
				{
					$sql[] = "ALTER TABLE " . USERS_TABLE . " ADD $field $def";
				}
				else
				{
					$sql[] = "ALTER TABLE " . USERS_TABLE . " ALTER COLUMN $field $def";
				}
				break;

			default:
				$error = true;
				$error_msg .= ( empty($error_msg) ? '' : '<br /><br />') . 'Database engine not supported';
				break;
		}
	}

	if ($action == 'delete')
	{
		$sql[] = "ALTER TABLE " . USERS_TABLE . " DROP $field";
	}

	if ( !empty($sql) && !$error )
	{
		for ($i=0; $i < count($sql); $i++)
		{
			if ( !$result = $db->sql_query($sql[$i]) )
			{
				$sql_error = $db->sql_error();
				if ( $sql_error['message'] != '' )
				{
					$debug_text .= '<br /><br />SQL Error : ' . $sql_error['code'] . ' ' . $sql_error['message'];
				}
				$error = true;
				$error_msg .= ( empty($error_msg) ? '' : '<br /><br />') . $lang['PCP_err_sql_failed'];
				$error_msg .= $debug_text . '<br /><hr /><pre>' . $sql[$i] . '</pre><hr />';
				break;
			}
		}
	}

	$message = $error ? $error_msg : '';
	return $message;
}

// get the sql definition
function pcp_get_sql_map($field, $field_data=array())
{
	global $phpbb_user_fields;
	global $db, $dbname;
	
	switch(SQL_LAYER)
	{
		case 'mysql':
		case 'mysql4':
		case 'mysqli':
			$sql = "SHOW COLUMNS FROM $dbname." . USERS_TABLE;
			if ( (!$result = $db->sql_query($sql)) || (!$row = $db->sql_fetchrow($result)) )
			{
				message_die(CRITICAL_ERROR, 'Could not query users table informations', '', __LINE__, __FILE__, $sql);
			}
			while ($row = $db->sql_fetchrow($result) )
			{
				if ($row['Field'] == $field)
				{
					$type = $field_data['type'];
					$length = $field_data['length'];
					$decimal = $field_data['decimal'];
					$unsigned = $field_data['unsigned'];
					$not_null = $field_data['not_null'];
					$default = $field_data['default'];
					@reset($row);
					while ( list($key, $value) = @each($row) )
					{
						$n_key = intval($key);
						if ($key != "$n_key")
						{
							switch ($key)
							{
								case 'Type':
									$value = trim(strtoupper($value));

									// unsigned
									$unsigned = ( strpos($value, 'UNSIGNED') != false );
									$value = trim(str_replace('UNSIGNED', '', $value));

									// length & decimal
									$regs = array();
									if ( ereg('\((.*)\)', $value, $regs) )
									{
										$parts = explode(',', $regs[1]);
										$length = intval($parts[0]);
										if ( count($parts) > 1 )
										{
											$decimal = intval($parts[1]);
										}
									}
									else
									{
										$length = 0;
									}
									$value = ereg_replace( '(\(.*\))', '', $value );

									// type
									$type = $value;
									break;
								case 'Null':
									$not_null = ($value != 'YES');
									break;
								case 'Default':
									$default = $value;
									break;
							}
						}
					}
					$field_data['type'] = $type;
					$field_data['length'] = $length;
					$field_data['decimal'] = $decimal;
					$field_data['unsigned'] = $unsigned;
					$field_data['not_null'] = $not_null;
					$field_data['default'] = $default;
				}
			}
			break;
		default:
			// try to get the definition from the standard phpBB fields
			if ( isset($phpbb_user_fields[$field]) )
			{
				$field_data = $phpbb_user_fields[$field];
			}

			// try from the definition of the field
			else if ( isset($field_data) )
			{
				if ( ($field_data['type'] == 'DATE') || ($field_data['type'] == 'DATETIME') )
				{
					$field_data['type'] = 'INT';
					$field_data['length'] = 11;
				}
				if ( $field_data['type'] == 'BIRTHDAY' )
				{
					$field_data['type'] = 'VARCHAR';
					$field_data['length'] = 8;
				}
				if ( $field_data['type'] == 'ADVANCED' )
				{
					$field_data['type'] = 'VARCHAR';
				}
			}
			break;
	}
	$res['type'] = $field_data['type'];
	$res['length'] = $field_data['length'];
	$res['decimal'] = $field_data['decimal'];
	$res['unsigned'] = $field_data['unsigned'];
	$res['not_null'] = $field_data['not_null'];
	$res['default'] = $field_data['default'];

	return $res;
}

// check sql actions doable
function pcp_check_sql_actions($field_name, $fields, $fields_table, &$create, &$modify, &$delete)
{
	global $phpbb_user_fields;
	global $db;

	// init
	$create = false;
	$modify = false;
	$delete = false;

	// check the name
	if ( !ereg("^[a-z0-9_]+", $field_name) )
	{
		return;
	}

	// creation : not already presents in table, and not advanced type
	if ( !isset($fields_table[$field_name]) && ( !in_array($fields[$field_name]['type'], array('ADVANCED')) ) )
	{
		$create = true;
	}

	// modification : presents in table and not present in standard phpBB
	if ( isset($fields_table[$field_name]) && !isset($phpbb_user_fields[$field_name]) )
	{
		$modify= true;
	}

	// delete : same as modify
	$delete = $modify;
}

// get the actual users table structure
function pcp_get_userfields_table()
{
	global $db;

	// read one row of the users table
	$sql = "SELECT * FROM " . USERS_TABLE . " LIMIT 0,1";
	if ( (!$result = $db->sql_query($sql)) || (!$row = $db->sql_fetchrow($result)) )
	{
		message_die(CRITICAL_ERROR, 'Could not query users table informations', '', __LINE__, __FILE__, $sql);
	}

	@reset($row);
	$user_fields_table = array();
	while ( list($key, $data) = @each($row) )
	{
		$n_key = intval($key);
		if ($key != "$n_key")
		{
			$user_fields_table[$key] = true;
		}
	}
	return $user_fields_table;
}

// get classes and field names for sort process
function pcp_get_userfields($sort, $order, &$maps_usage)
{
	global $phpbb_root_path, $phpEx;
	global $values_list, $tables_linked, $classes_fields, $user_maps;

	// get the parameters
	include($phpbb_root_path . './profilcp/def/def_userfields.' . $phpEx);
	include($phpbb_root_path . './profilcp/def/def_usermaps.' . $phpEx);

	// init the result
	$fields = $user_fields;

	// in which maps the field is used
	$maps_usage = array();

	// sort list
	$names = array();
	$sorts = array();

	// read the user_fields
	@reset($fields);
	while ( list($field_name, $field_data) = @each($fields) )
	{
		// basic sort
		$names[] = $field_name;

		// type
		$type = empty($field_data['type']) ? 'VARCHAR' : $field_data['type'];
		$fields[$field_name]['type'] = $type;

		// class
		$class = empty($field_data['class']) ? 'generic' : $field_data['class'];
		if ($field_data['system'])
		{
			$class = 'system';
		}
		$fields[$field_name]['class'] = $class;

		// get mode
		$get_mode = $field_data['get_mode'];
		if ( empty($get_mode) )
		{
			$get_mode = $type;
		}
		if ( !empty($field_data['get_func']) || !empty($field_data['chk_func']) )
		{
			$get_mode = '';
		}
		$fields[$field_name]['get_mode'] = $get_mode;

		// fill the sort field array
		if ( $sort != 'name' )
		{
			$sorts[] = $fields[$field_name][$sort];
		}

		// search the usage in maps
		@reset($user_maps);
		while ( list($map_name, $map_data) = @each($user_maps) )
		{
			$in_title = false;
			$in_fields = false;
			if ( !empty($map_data['title']) && is_array($map_data['title']) )
			{
				$in_title = isset($map_data['title'][$field_name]);
			}
			if ( !empty($map_data['fields']) )
			{
				$in_fields = isset($map_data['fields'][$field_name]);
			}
			if ( $in_title || $in_fields )
			{
				$maps_usage[$field_name][] = $map_name;
			}
		}
	}
	if ( !empty($fields) )
	{
		if ( $sort != 'name' )
		{
			if ($order == 'DESC')
			{
				array_multisort($sorts, SORT_DESC, $names, $fields);
			}
			else
			{
				array_multisort($sorts, $names, $fields);
			}
		}
		else
		{
			if ($order == 'DESC')
			{
				array_multisort($names, SORT_DESC, $fields);
			}
			else
			{
				array_multisort($names, $fields);
			}
		}
	}
	return $fields;
}

//---------------------------------
//
//	process
//
//---------------------------------
// read user fields
$maps_usage = array();
$fields = pcp_get_userfields($sort, $order, $maps_usage);

// read current users table
$fields_table = array();
$fields_table = pcp_get_userfields_table();

//  get parameters
$mode = '';
if (isset($_POST['mode']) || isset($_GET['mode']) )
{
	$mode = isset($_POST['mode']) ? $_POST['mode'] : $_GET['mode'];
}
if ( !in_array($mode, array('edit', 'create', 'delete', 'sqledit', 'sqlcreate', 'sqldelete')) )
{
	$mode = '';
}

// sort
$sort = '';
if (isset($_POST['sort']) || isset($_GET['sort']) )
{
	$sort = isset($_POST['sort']) ? $_POST['sort'] : $_GET['sort'];
}
if ( !in_array($sort, $sort_list) )
{
	$sort = 'name';
}

// order
$order = '';
if (isset($_POST['order']) || isset($_GET['order']) )
{
	$order = isset($_POST['order']) ? $_POST['order'] : $_GET['order'];
}
if ( !in_array($order, $order_list) )
{
	$order = 'ASC';
}

// field name
$field = '';
if (isset($_POST['field']) || isset($_GET['field']) )
{
	$field = isset($_POST['field']) ? $_POST['field'] : $_GET['field'];
}
if ( !empty($field) )
{
	// check if field exists
	if ( !isset($fields[$field]) )
	{
		$field = '';
	}
}

// old field name
$old = '';
if (isset($_POST['old']) || isset($_GET['old']) )
{
	$old = isset($_POST['old']) ? $_POST['old'] : $_GET['old'];
}
if ( !empty($old) )
{
	// check if field exists
	if ( !isset($fields_table[$old]) )
	{
		$old = '';
	}
}

// buttons
$submit = isset($_POST['submit']);
$create = isset($_POST['create']);
$delete = isset($_POST['delete']);
$confirm = isset($_POST['confirm']);
if ( empty($field) && $delete )
{
	$delete = false;
	$mode = '';
}
if ( $create || $delete )
{
	$mode = 'edit';
}

// sqlcreate && sqledit
if ( ($mode == 'sqlcreate') || ($mode == 'sqledit') )
{
	// get the current definition of the field
	$k_field = empty($old) ? $field : $old;
	$w_field = pcp_get_sql_map($k_field, $fields[$field]);

	// get values from field def
	$type			= $w_field['type'];
	$length			= $w_field['length'];
	$decimal		= $w_field['decimal'];
	$unsigned		= $w_field['unsigned'];
	$not_null		= $w_field['not_null'];
	$default		= $w_field['default'];
	$default_null	= ($w_field['default'] == NULL);

	// get values from the form
	$type			= isset($_POST['type']) ? $_POST['type'] : $type;
	$length			= isset($_POST['length']) ? $_POST['length'] : $length;
	$decimal		= isset($_POST['decimal']) ? $_POST['decimal'] : $decimal;
	$unsigned		= isset($_POST['unsigned']) ? $_POST['unsigned'] : $unsigned;
	$not_null		= isset($_POST['not_null']) ? $_POST['not_null'] : $not_null;
	$default		= isset($_POST['default']) ? $_POST['default'] : $default;
	$default_null	= isset($_POST['default_null']) ? true : (isset($_POST['default']) ? false : $default_null);

	if ($cancel)
	{
		$mode = empty($old) ? '' : 'edit';
		$cancel = false;
	}
	else if ($submit)
	{
		// do some check
		$error = false;
		$error_msg = '';
		$is_numeric = in_array($type, array('TINYINT', 'SMALLINT', 'MEDIUMINT', 'INT', 'DECIMAL'));
		$is_decimal = ($type == 'DECIMAL');

		// decimal
		if ( !empty($decimal) && !$is_decimal )
		{
			$error = true;
			$error_msg = ( empty($error_msg) ? '' : '<br />') . $lang['PCP_err_sql_decimal_not_allow'];
		}
		if ( !empty($decimal) && ($decimal >= $length) )
		{
			$error = true;
			$error_msg = ( empty($error_msg) ? '' : '<br />') . $lang['PCP_err_sql_decimal_too_high'];
		}

		// length
		if ( empty($length) && ($type != 'TEXT') )
		{
			$error = true;
			$error_msg = ( empty($error_msg) ? '' : '<br />') . $lang['PCP_err_sql_length_missing'];
		}

		// unsigned
		if ( $unsigned && !$is_numeric )
		{
			$error = true;
			$error_msg = ( empty($error_msg) ? '' : '<br />') . $lang['PCP_err_sql_unsigned_not_allow'];
		}

		// default null
		if ( $default_null && $not_null )
		{
			$error = true;
			$error_msg = ( empty($error_msg) ? '' : '<br />') . $lang['PCP_err_sql_default_null_not_allow'];
		}

		if ( $error )
		{
			message_die( GENERAL_MESSAGE, $error_msg );
		}

		// try to perform the sql query
		$w_field['type'] = $type;
		$w_field['length'] = $length;
		$w_field['decimal'] = $decimal;
		$w_field['unsigned'] = $unsigned;
		$w_field['not_null'] = $not_null;
		$w_field['default'] = ($default_null) ? NULL : $default;

		$action = ($mode == 'sqlcreate') ? 'create' : 'edit';
		$sql_result = pcp_sql_query($field, $action, $w_field, $old);

		// prepare feedback message
		$return_path = append_sid("./admin_pcp_userfields.$phpEx");
		$message = empty($sql_result) ? sprintf( ( ($action == 'create') ? $lang['PCP_sql_field_created'] : $lang['PCP_sql_field_modified'] ), '<a href="' . $return_path . '" />', '</a>' ) : $sql_result;
		message_die( GENERAL_MESSAGE, $message );
	}
	else
	{
		// check if sql deletion available
		$do_sql = false;
		$sql_create = false;
		$sql_modify = false;
		$sql_delete = false;
		pcp_check_sql_actions($field, $fields, $fields_table, $sql_create, $sql_modify, $sql_delete);
		if (!$sql_create && !$sql_modify)
		{
			message_die(GENERAL_MESSAGE, $lang['PCP_err_sql_edit_not_allow']);
		}

		// template
		$template->set_filenames(array(
			'body' => 'admin/pcp_userfields_sql_body.tpl')
		);

		// header
		$template->assign_vars(array(
			'L_TITLE'				=> $lang['PCP_userfields_edit'],
			'L_TITLE_EXPLAIN'		=> $lang['PCP_userfields_edit_explain'],

			'L_SQL_TITLE'			=> empty($field) ? $lang['PCP_SQL_create_field_title'] : $lang['PCP_SQL_edit_field_title'],
			'L_YES'					=> $lang['Yes'],
			'L_NO'					=> $lang['No'],

			'L_NAME'				=> $lang['PCP_SQL_field_name'],
			'L_NAME_EXPLAIN'		=> $lang['PCP_SQL_field_name_explain'],
			'L_TYPE'				=> $lang['PCP_SQL_field_type'],
			'L_TYPE_EXPLAIN'		=> $lang['PCP_SQL_field_type_explain'],
			'L_LENGTH'				=> $lang['PCP_SQL_field_length'],
			'L_LENGTH_EXPLAIN'		=> $lang['PCP_SQL_field_length_explain'],
			'L_UNSIGNED'			=> $lang['PCP_SQL_field_unsigned'],
			'L_UNSIGNED_EXPLAIN'	=> $lang['PCP_SQL_field_unsigned_explain'],
			'L_NULL'				=> $lang['PCP_SQL_null'],
			'L_DEFAULT'				=> $lang['PCP_SQL_default'],
			'L_DEFAULT_NULL'		=> $lang['PCP_SQL_null_value'],

			'L_SUBMIT'				=> $lang['Submit'],
			'L_REFRESH'				=> $lang['Refresh'],
			'L_CANCEL'				=> $lang['Cancel'],
			)
		);

		// list of sql types
		$s_types = '<select name="type">';
		for ( $i = 0; $i < count($sql_type_list); $i++ )
		{
			$selected = ( $type == $sql_type_list[$i] ) ? ' selected="selected"' : '';
			$s_types .= '<option value="' . $sql_type_list[$i] . '"' . $selected . '>' . pcp_format_lang($sql_type_list[$i]) . '</option>';
		}
		$s_types .= '</select>';

		// value
		$template->assign_vars(array(
			'NAME'				=> $field,
			'S_TYPES'			=> $s_types,
			'LENGTH'			=> $length,
			'DECIMAL'			=> $decimal,
			'UNSIGNED_YES'		=> $unsigned ? ' checked="checked"' : '',
			'UNSIGNED_NO'		=> !$unsigned ? ' checked="checked"' : '',
			'NULL_YES'			=> !$not_null ? ' checked="checked"' : '',
			'NULL_NO'			=> $not_null ? ' checked="checked"' : '',
			'DEFAULT'			=> $default,
			'DEFAULT_NULL'		=> ($default == NULL) ? ' checked="checked"' : '',
			)
		);

		// footer
		$s_hidden_fields = '';
		$s_hidden_fields .= '<input type="hidden" name="mode" value="' . $mode . '" />';
		$s_hidden_fields .= '<input type="hidden" name="field" value="' . $field . '" />';
		$s_hidden_fields .= '<input type="hidden" name="old" value="' . $old . '" />';
		$template->assign_vars(array(
			'S_ACTION'			=> append_sid("./admin_pcp_userfields.$phpEx"),
			'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
			)
		);
	}
}

// sql delete
if ( $mode == 'sqldelete' )
{
	if ($cancel)
	{
		$mode = '';
		$cancel = false;
	}
	else if ($confirm)
	{
		// check if sql deletion available
		$do_sql = false;
		$sql_create = false;
		$sql_modify = false;
		$sql_delete = false;
		pcp_check_sql_actions($field, $fields, $fields_table, $sql_create, $sql_modify, $sql_delete);
		if (!$sql_delete)
		{
			message_die(GENERAL_MESSAGE, $lang['PCP_err_sql_delete_not_allow']);
		}

		// perform the deletion
		$sql_result = pcp_sql_query($field, 'delete');
		$return_path = append_sid("./admin_pcp_userfields.$phpEx");
		$message = empty($sql_result) ? sprintf( $lang['PCP_sql_field_deleted'], '<a href="' . $return_path . '" />', '</a>' ) : $sql_result;
		message_die(GENERAL_MESSAGE, $message);
	}
	else
	{
		// check if sql deletion available
		$do_sql = false;
		$sql_create = false;
		$sql_modify = false;
		$sql_delete = false;
		pcp_check_sql_actions($field, $fields, $fields_table, $sql_create, $sql_modify, $sql_delete);
		if (!$sql_delete)
		{
			message_die(GENERAL_MESSAGE, $lang['PCP_err_sql_delete_not_allow']);
		}

		// ask for confirmation
		$template->set_filenames(array(
			'body' => 'admin/pcp_confirm_body.tpl')
		);

		$message .= '<br /><br />' . $lang['PCP_SQL_delete_field'] . '<br /><br />';

		// header and values
		$template->assign_vars(array(
			'L_TITLE'			=> $lang['PCP_userfields_edit'],
			'L_TITLE_EXPLAIN'	=> $lang['PCP_userfields_edit_explain'],

			'MESSAGE_TITLE'		=> $lang['PCP_userfields_delete'],
			'MESSAGE'			=> $message,

			'L_YES'				=> $lang['Confirm'],
			'L_NO'				=> $lang['Cancel'],
			)
		);

		// footer
		$s_hidden_fields = '';
		$s_hidden_fields .= '<input type="hidden" name="mode" value="' . $mode . '" />';
		$s_hidden_fields .= '<input type="hidden" name="field" value="' . $field . '" />';
		$template->assign_vars(array(
			'S_ACTION'			=> append_sid("./admin_pcp_userfields.$phpEx"),
			'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
			)
		);
	}
}

// edit, delete or create
if ( $mode == 'edit' )
{
	// which field cat is displayed ?
	$cur_cat = isset($_POST['cur_cat']) ? $_POST['cur_cat'] : '';
	@reset($field_cat);
	while ( list($cat_name, $cat_data) = @each($field_cat) )
	{
		if ( isset($_POST['select_field_cat_' . $cat_name]) )
		{
			$cur_cat = $cat_name;
		}
	}
	if ( !isset($field_cat[$cur_cat]) )
	{
		@reset($field_cat);
		list( $cur_cat, $cat_data ) = @each($field_cat);
	}

	// reclaim values
	$field_det = array();
	@reset($field_def);
	while ( list($def_key, $def_data) = @each($field_def) )
	{
		// get values from memory
		if ( $def_key == 'field_name' )
		{
			$field_det['field_name'] = isset($fields[$field]) ? $field : '';
		}
		else
		{
			$field_det[$def_key] = isset($fields[$field][$def_key]) ? $fields[$field][$def_key] : '';
		}

		// get values from form
		$field_det[$def_key] = isset($_POST['field_det_' . $def_key]) ? $_POST['field_det_' . $def_key] : $field_det[$def_key];
	}
	$field_name = $field_det['field_name'];

	// some default values
	if ( empty($field_det['class']) )
	{
		$field_det['class'] = 'generic';
	}
	if ( empty($field_det['type']) )
	{
		$field_det['type'] = 'VARCHAR';
	}

	// process
	if ($delete)
	{
		if ( !isset($fields[$field]) )
		{
			$mode = '';
			$delete = false;
			$cancel = false;
		}
		else if ($cancel)
		{
			$mode = 'edit';
			$cancel = false;
			$delete = false;
		}
		else if ($confirm)
		{
			// check if sql deletion available
			$do_sql = false;
			$sql_create = false;
			$sql_modify = false;
			$sql_delete = false;
			pcp_check_sql_actions($field, $fields, $fields_table, $sql_create, $sql_modify, $sql_delete);
			if ($sql_delete)
			{
				$do_sql = isset($_POST['delete_sql']) && ($_POST['delete_sql'] == 1);
			}

			// delete field definition
			$w_fields = array();
			@reset($fields);
			while ( list( $field_name, $field_data) = @each($fields) )
			{
				if ( $field_name != $field )
				{
					$w_fields[$field_name] = $field_data;
				}
			}

			// store the result
			$fields = $w_fields;
			$w_fields = array();

			// write into file
			pcp_output_fields($values_list, $tables_linked, $classes_fields, $user_maps, $fields);

			// prepare feedback message
			$return_path = append_sid("./admin_pcp_userfields.$phpEx");
			$message = sprintf( $lang['PCP_field_deleted'], '<a href="' . $return_path . '" />', '</a>' );

			// deals with the sql request
			$sql_res = $do_sql ? pcp_sql_query($field, 'delete') : '';
			$sql_res = ( $do_sql && empty($sql_res) ) ? $lang['PCP_sql_field_deleted_short'] : $sql_res;

			// final message
			$message = $sql_res . ( empty($sql_res) ? '' : '<br /><br />') . $message;
			message_die(GENERAL_MESSAGE, $message);
		}
		else
		{
			// avoid other further display
			$mode = 'delete';

			// template
			$template->set_filenames(array(
				'body' => 'admin/pcp_confirm_body.tpl')
			);

			$message = sprintf($lang['PCP_field_delete'], $field);

			// check if sql deletion available
			$sql_create = false;
			$sql_modify = false;
			$sql_delete = false;
			pcp_check_sql_actions($field, $fields, $fields_table, $sql_create, $sql_modify, $sql_delete);
			if ($sql_delete)
			{
				$message .= '<br /><br />' . $lang['PCP_SQL_delete_field'];
				$message .= '&nbsp;<input type="radio" name="delete_sql" value="0" checked="checked" />' . $lang['No'];
				$message .= '&nbsp;<input type="radio" name="delete_sql" value="1" checked="checked" />' . $lang['Yes'];
			}

			// header and values
			$template->assign_vars(array(
				'L_TITLE'			=> $lang['PCP_userfields_edit'],
				'L_TITLE_EXPLAIN'	=> $lang['PCP_userfields_edit_explain'],

				'MESSAGE_TITLE'		=> $lang['PCP_userfields_delete'],
				'MESSAGE'			=> $message,

				'L_YES'				=> $lang['Confirm'],
				'L_NO'				=> $lang['Cancel'],
				)
			);

			// footer
			$s_hidden_fields = '';
			$s_hidden_fields .= '<input type="hidden" name="mode" value="edit" />';
			$s_hidden_fields .= '<input type="hidden" name="field" value="' . $field . '" />';
			$s_hidden_fields .= '<input type="hidden" name="delete" value="1" />';

			// spare field
			@reset($field_def);
			while ( list($def_key, $def_data) = @each($field_def) )
			{
				$value = htmlspecialchars(htmldecode($field_det[$def_key]));
				$s_hidden_fields .= '<input type="hidden" name="field_det_' . $def_key .'" value="' . $value . '" />';
			}

			// dump to template
			$template->assign_vars(array(
				'S_ACTION'			=> append_sid("./admin_pcp_userfields.$phpEx"),
				'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
				)
			);
		}
	}

	// still on edition ?
	if ( $cancel && ($mode == 'edit') )
	{
		$mode = '';
		$cancel = false;
	}
	else if ( $submit && ($mode == 'edit') )
	{
		$field_name = $field_det['field_name'];

		// do some check
		$error = false;
		$error_msg = '';

		// does the field already exists ?
		if ( ($field_name != $field) && isset($fields[$field_name]) )
		{
			$error = true;
			$error_msg .= ( empty($error_msg) ? '' : '<br />' ) . $lang['PCP_err_field_already_exists'];
		}

		// is the field name ok ?
		if ( empty($field_name) || !ereg("^[a-z0-9_]+", $field_name) )
		{
			$error = true;
			$error_msg .= ( empty($error_msg) ? '' : '<br />' ) . $lang['PCP_err_field_name_not_valid'];
		}

		// lang key
		if ( empty($field_det['lang_key']) )
		{
			$error = true;
			$error_msg .= ( empty($error_msg) ? '' : '<br />' ) . $lang['PCP_err_field_lang_key_missing'];
		}

		// class
		if ( !isset($classes_fields[ $field_det['class'] ]) )
		{
			$error = true;
			$error_msg .= ( empty($error_msg) ? '' : '<br />' ) . $lang['PCP_err_field_class_unknown'];
		}

		// type
		if ( !in_array($field_det['type'], $type_list) )
		{
			$error = true;
			$error_msg .= ( empty($error_msg) ? '' : '<br />' ) . $lang['PCP_err_field_type_unknown'];
		}

		// get mode
		if ( !empty($field_det['get_mode']) && !in_array($field_det['get_mode'], $get_mode_list) )
		{
			$error = true;
			$error_msg .= ( empty($error_msg) ? '' : '<br />' ) . $lang['PCP_err_field_get_mode_unknown'];
		}

		// values list
		if ( !empty($field_det['values']) && !isset($values_list[ $field_det['values'] ]) )
		{
			$error = true;
			$error_msg .= ( empty($error_msg) ? '' : '<br />' ) . $lang['PCP_err_field_values_list_unknown'];
		}

		// auth
		if ( !isset($auth_list[ $field_det['auth'] ]) )
		{
			$error = true;
			$error_msg .= ( empty($error_msg) ? '' : '<br />' ) . $lang['PCP_err_field_auth_unknown'];
		}

		// funcs
		if ( !empty($field_det['dsp_func']) && !ereg("^[a-zA-Z0-9_]+", $field_det['dsp_func']) )
		{
			$error = true;
			$error_msg .= ( empty($error_msg) ? '' : '<br />' ) . $lang['PCP_err_field_dsp_func_not_valid'];
		}
		if ( !empty($field_det['get_func']) && !ereg("^[a-zA-Z0-9_]+", $field_det['get_func']) )
		{
			$error = true;
			$error_msg .= ( empty($error_msg) ? '' : '<br />' ) . $lang['PCP_err_field_get_func_not_valid'];
		}
		if ( !empty($field_det['chk_func']) && !ereg("^[a-zA-Z0-9_]+", $field_det['chk_func']) )
		{
			$error = true;
			$error_msg .= ( empty($error_msg) ? '' : '<br />' ) . $lang['PCP_err_field_chk_func_not_valid'];
		}

		// field combined : values and get mode
		if ( (substr($field_det['get_mode'], 0, 5) == 'LIST_') && empty($field_det['values']) )
		{
			$error = true;
			$error_msg .= ( empty($error_msg) ? '' : '<br />' ) . $lang['PCP_err_field_values_list_missing'];
		}
		if ( (substr($field_det['get_mode'], 0, 5) != 'LIST_') && !empty($field_det['values']) )
		{
			$error = true;
			$error_msg .= ( empty($error_msg) ? '' : '<br />' ) . $lang['PCP_err_field_values_list_presents'];
		}

		// get mode and get/chk funcs
		if ( !empty($field_det['get_mode']) && ( !empty($field_det['get_func']) || !empty($field_det['chk_func']) ) )
		{
			$error = true;
			$error_msg .= ( empty($error_msg) ? '' : '<br />' ) . $lang['PCP_err_field_get_mode_presents'];
		}
		if ( (empty($field_det['get_func']) && !empty($field_det['chk_func'])) || (!empty($field_det['get_func']) && empty($field_det['chk_func'])) )
		{
			$error = true;
			$error_msg .= ( empty($error_msg) ? '' : '<br />' ) . $lang['PCP_err_field_get_chk_func_missing'];
		}

		// send any error message
		if ($error)
		{
			message_die(GENERAL_MESSAGE, $error_msg);
		}

		// write the field
		$new_field_name = $field_name;
		$new_field = array();
		@reset($field_def);
		while ( list($def_key, $def_data) = @each($field_def) )
		{
			if ( $def_key != 'field_name' )
			{
				$new_field[$def_key] = $field_det[$def_key];
			}
		}
		if ( !empty($field) )
		{
			// remove the entry and add the new in place
			$w_fields = array();
			@reset($fields);
			while ( list( $field_name, $field_data) = @each($fields) )
			{
				if ( $field_name == $field )
				{
					$w_fields[$new_field_name] = $new_field;
				}
				else
				{
					$w_fields[$field_name] = $field_data;
				}
			}

			// store the result
			$fields = $w_fields;
			$w_fields = array();
		}
		else
		{
			$fields[$new_field_name] = $new_field;
		}
		pcp_output_fields($values_list, $tables_linked, $classes_fields, $user_maps, $fields);

		// sql actions
		$sql_message = '';
		$sql_create = false;
		$sql_modify = false;
		$sql_delete = false;
		pcp_check_sql_actions( ( empty($field) ? $new_field_name : $field ), $fields, $fields_table, $sql_create, $sql_modify, $sql_delete);
		if ( $sql_create )
		{
			$link = append_sid("./admin_pcp_userfields.$phpEx?mode=sqlcreate&field=$new_field_name");
			$sql_message = sprintf($lang['PCP_SQL_create_field'], '<a href="' . $link . '">', '</a>');
		}
		else if ($sql_modify)
		{
			$link = append_sid("./admin_pcp_userfields.$phpEx?mode=sqledit&field=$new_field_name" . ( ($field_name == $field) ? '' : "&old=$field"));
			$sql_message = sprintf($lang['PCP_SQL_modify_field'], '<a href="' . $link . '">', '</a>');
		}

		// send created/updated message
		$return_path = append_sid("./admin_pcp_userfields.$phpEx");
		$message = sprintf( ( empty($field) ? $lang['PCP_field_created'] : $lang['PCP_field_modified'] ), $sql_message, '<a href="' . $return_path . '"/>', '</a>' );
		message_die( GENERAL_MESSAGE, $message );
	}
	else if ($mode == 'edit')
	{
		// template
		$template->set_filenames(array(
			'body' => 'admin/pcp_userfields_edit_body.tpl')
		);

		// header
		$template->assign_vars(array(
			'L_TITLE'				=> $lang['PCP_usermaps_title_edit'],
			'L_TITLE_EXPLAIN'		=> $lang['PCP_usermaps_title_edit_explain'],

			'SPAN'					=> count($field_cat)+1,

			'L_SUBMIT'				=> $lang['Submit'],
			'L_REFRESH'				=> $lang['Refresh'],
			'L_DELETE'				=> $lang['Delete'],
			'L_CANCEL'				=> $lang['Cancel'],
			)
		);

		// cats
		@reset($field_cat);
		while ( list($cat_name, $cat_data) = @each($field_cat) )
		{
			$template->assign_block_vars('catmenu', array(
				'CAT_NAME'		=> $cat_name,
				'L_CAT_NAME'	=> pcp_format_lang($field_cat[$cat_name]),
				)
			);
			if ($cat_name == $cur_cat)
			{
				$template->assign_block_vars('catmenu.flat', array());
			}
			else
			{
				$template->assign_block_vars('catmenu.input', array());
			}
		}

		// values
		$s_hidden_fields = '';
		$sav_cat = '';
		@reset($field_def);
		while ( list($def_key, $def_data) = @each($field_def) )
		{
			$def_type = $def_data['type'];
			$def_name = 'field_det_' . $def_key;
			$def_value = $field_det[$def_key];
			$protected = ( ($def_key=='field_name') && !empty($field) );
			$style = $protected ? '<b>%s</b>' : '';
			if ($field_def[$def_key]['cat'] == $cur_cat)
			{
				$template->assign_block_vars('row', array(
					'L_FIELD'			=> pcp_format_lang($def_data['lang_key']),
					'L_FIELD_EXPLAIN'	=> pcp_format_lang($def_data['explain']),
					'FIELD'				=> pcp_format_input($def_type, $def_name, $def_value, $style, $protected),
					)
				);
				if ($sav_cat != $def_data['cat'])
				{
					$sav_cat = $def_data['cat'];
					$template->assign_block_vars('row.cat', array(
						'L_CAT' => pcp_format_lang($field_cat[$cur_cat]),
						)
					);
				}
			}
			else
			{
				$s_hidden_fields .= '<input type="hidden" name="' . $def_name . '" value="' . htmlspecialchars(htmldecode($def_value)) . '" />';
			}
		}

		// we don't accept yet rename of existing fields in the database, because of ms- databases
		if ( !empty($field) && isset($fields_table[$field]) )
		{
			$template->assign_block_vars('protected', array());
		}
		else
		{
			$template->assign_block_vars('opened', array());
		}

		// footer
		$s_hidden_fields .= '<input type="hidden" name="mode" value="' . $mode . '" />';
		$s_hidden_fields .= '<input type="hidden" name="field" value="' . $field . '" />';
		$s_hidden_fields .= '<input type="hidden" name="sort" value="' . $sort . '" />';
		$s_hidden_fields .= '<input type="hidden" name="order" value="' . $order . '" />';
		$template->assign_vars(array(
			'S_ACTION'			=> append_sid("./admin_pcp_userfields.$phpEx"),
			'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
			)
		);
	}
}

// main entry
if ( $mode == '' )
{
	// template
	$template->set_filenames(array(
		'body' => 'admin/pcp_userfields_body.tpl')
	);

	// header
	$template->assign_vars(array(
		'L_TITLE'			=> $lang['PCP_userfields'],
		'L_TITLE_EXPLAIN'	=> $lang['PCP_userfields_explain'],

		'L_SORT'			=> $lang['Sort_by'],
		'L_GO'				=> $lang['Sort'],
		'L_ADD_FIELD'		=> $lang['PCP_field_add'],

		'L_NAME'			=> $lang['PCP_field_name'],
		'L_DESC'			=> $lang['PCP_field_desc'],
		'L_CLASS'			=> $lang['PCP_field_class'],
		'L_TYPE'			=> $lang['PCP_field_type'],
		'L_MAP_USAGE'		=> $lang['PCP_field_maps_usage'],
		'L_SQL_ACTIONS'		=> $lang['PCP_field_sql_actions'],
		)
	);

	// build the sort list
	$s_sort = '<select name="sort">';
	for ( $i = 0; $i < count($sort_list); $i++ )
	{
		$selected = ( $sort == $sort_list[$i] ) ? ' selected="selected"' : '';
		$s_sort .= '<option value="' . $sort_list[$i] . '"' . $selected . ' />' . $lang[ 'PCP_field_' . $sort_list[$i] ] . '</option>';
	}
	$s_sort .= '</select>';

	// order list
	$s_order = '<select name="order">';
	for ( $i = 0; $i < count($order_list); $i++ )
	{
		$selected = ( $order == $order_list[$i] ) ? ' selected="selected"' : '';
		$s_order .= '<option value="' . $order_list[$i] . '"' . $selected . ' />' . ( ($order_list[$i] == 'DESC') ? $lang['Sort_Descending'] : $lang['Sort_Ascending'] ) . '</option>';
	}
	$s_order .= '</select>';

	// vars
	$template->assign_vars(array(
		'S_SORT'	=> $s_sort,
		'S_ORDER'	=> $s_order,
		)
	);

	// display the fields
	$color = false;
	@reset($fields);
	while ( list($field_name, $field_data) = @each($fields) )
	{
		// check if sql actions can be performed
		$sql_actions = '';
		$sql_create = false;
		$sql_modify = false;
		$sql_delete = false;
		pcp_check_sql_actions($field_name, $fields, $fields_table, $sql_create, $sql_modify, $sql_delete);

		$link = '<a href="' . append_sid("./admin_pcp_userfields.$phpEx?mode=sql%s&field=$field_name&sort=$sort" . ( ($order == 'ASC') ? '' : "&order=$order" )) . '" class="genmed" />%s</a>';

		$sql_actions .= ( empty($sql_actions) ? '' : '<br />' ) . ( $sql_create ? sprintf($link, 'create', $lang['Create']) : '');
		$sql_actions .= ( empty($sql_actions) ? '' : '<br />' ) . ( $sql_modify ? sprintf($link, 'edit', $lang['Edit']) : '');
		$sql_actions .= ( empty($sql_actions) ? '' : '<br />' ) . ( $sql_delete ? sprintf($link, 'delete', $lang['Delete']) : '');

		// send to template
		$color = !$color;
		$template->assign_block_vars('fields', array(
			'COLOR'			=> $color ? 'row1' : 'row2',
			'NAME'			=> $field_name,
			'LANG_KEY'		=> pcp_format_lang($field_data['lang_key'], true),
			'EXPLAIN'		=> empty($field_data['explain']) ? '' : '<br />' . pcp_format_lang($field_data['explain'], true),
			'IMAGE'			=> pcp_format_image($field_data['image'], true),
			'CLASS'			=> $field_data['class'],
			'TYPE'			=> $field_data['type'],
			'GET_MODE'		=> ($field_data['type'] == $field_data['get_mode']) ? '' : $field_data['get_mode'],

			'U_NAME'		=> append_sid("./admin_pcp_userfields.$phpEx?mode=edit&field=$field_name&sort=$sort" . ( ($order == 'ASC') ? '' : "&order=$order" )),
			'U_CLASS'		=> append_sid("./admin_pcp_classesfields.$phpEx?mode=edit&class=" . $field_data['class']),
			'SQL_ACTIONS'	=> $sql_actions,
			)
		);
		for ($i = 0; $i < count($maps_usage[$field_name]); $i++ )
		{
			$template->assign_block_vars('fields.maps', array(
				'NAME'		=> $maps_usage[$field_name][$i],
				'U_NAME'	=> append_sid("./admin_pcp_usermaps.$phpEx?map=" . $maps_usage[$field_name][$i]),
				)
			);
		}
		if ( !empty($sql_actions) )
		{
			$template->assign_block_vars('fields.sql_actions', array());
		}
	}

	// footer
	$s_hidden_fields = '';
	$s_hidden_fields .= '<input type="hidden" name="mode" value="' . $mode . '" />';
	$template->assign_vars(array(
		'S_ACTION'			=> append_sid("./admin_pcp_userfields.$phpEx"),
		'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
		)
	);
}

// dump
$template->pparse('body');
include('./page_footer_admin.'.$phpEx);

?>