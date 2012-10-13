<?php

/***************************************************************************
 *							admin_pcp_valueslist.php
 *							------------------------
 *	begin				: 11/10/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: v 0.0.1 - 11/10/2003
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
	$module['PCP_management']['PCP_01_valueslist'] = $file;
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

define('PCP_threshold', 3);
//---------------------------------
//
// functions
//
//---------------------------------
function pcp_get_values_lists()
{
	global $phpbb_root_path, $phpEx;

	// get the parameters
	include($phpbb_root_path . './profilcp/def/def_userfields.' . $phpEx);

	// sort
	$names = array();
	@reset($values_list);
	while ( list($vlist, $data) = @each($values_list) )
	{
		$names[] = $vlist;
	}
	@array_multisort($names, $values_list);

	// send the result
	return $values_list;
}

//---------------------------------
//
//	process
//
//---------------------------------
// init
$vlists = array();
$vlists = pcp_get_values_lists();

//  get parameters
$mode = '';
if (isset($HTTP_POST_VARS['mode']) || isset($HTTP_GET_VARS['mode']) )
{
	$mode = isset($HTTP_POST_VARS['mode']) ? $HTTP_POST_VARS['mode'] : $HTTP_GET_VARS['mode'];
}
if ( !in_array($mode, array('edit')) )
{
	$mode = '';
}

// table
$vlist = '';
if (isset($HTTP_POST_VARS['vlist']) || isset($HTTP_GET_VARS['vlist']) )
{
	$vlist = isset($HTTP_POST_VARS['vlist']) ? $HTTP_POST_VARS['vlist'] : $HTTP_GET_VARS['vlist'];
}
if ( !empty($vlist) && !isset($vlists[$vlist]) )
{
	$vlist = '';
	$mode = '';
}

// buttons
$submit = isset($HTTP_POST_VARS['submit']);
$create = isset($HTTP_POST_VARS['create']);
$delete = isset($HTTP_POST_VARS['delete']);
$cancel = isset($HTTP_POST_VARS['cancel']);
if ($create)
{
	$vlist = '';
	$mode = 'edit';
}

// edit a values list
if ($mode == 'edit')
{
	// coming from memory
	$name		= $vlist;
	$func		= isset($vlists[$vlist]['func']) ? str_replace("\n", ' ', str_replace("\r", '', str_replace("\t", '', $vlists[$vlist]['func']))) : '';
	$main		= isset($vlists[$vlist]['table']['main']) ? str_replace("\n", ' ', str_replace("\r", '', str_replace("\t", '', $vlists[$vlist]['table']['main']))) : '';
	$keyfield	= isset($vlists[$vlist]['table']['key']) ? str_replace("\n", ' ', str_replace("\r", '', str_replace("\t", '', $vlists[$vlist]['table']['key']))) : '';
	$txtfield	= isset($vlists[$vlist]['table']['txt']) ? str_replace("\n", ' ', str_replace("\r", '', str_replace("\t", '', $vlists[$vlist]['table']['txt']))) : '';
	$imgfield	= isset($vlists[$vlist]['table']['img']) ? str_replace("\n", ' ', str_replace("\r", '', str_replace("\t", '', $vlists[$vlist]['table']['img']))) : '';
	$item_keys = array();
	$item_txts = array();
	$item_imgs = array();
	$item_chks = array();
	@reset($vlists[$vlist]['values']);
	while ( list($item_key, $item_data) = @each($vlists[$vlist]['values']) )
	{
		$item_keys[] = $item_key;
		$item_txts[] = $item_data['txt'];
		$item_imgs[] = $item_data['img'];
		$item_chks[] = false;
	}

	// coming from the form
	$name		= isset($HTTP_POST_VARS['name']) ? $HTTP_POST_VARS['name'] : $name;
	$func		= isset($HTTP_POST_VARS['func']) ? $HTTP_POST_VARS['func'] : $func;
	$main		= isset($HTTP_POST_VARS['main']) ? $HTTP_POST_VARS['main'] : $main;
	$keyfield	= isset($HTTP_POST_VARS['keyfield']) ? $HTTP_POST_VARS['keyfield'] : $keyfield;
	$txtfield	= isset($HTTP_POST_VARS['txtfield']) ? $HTTP_POST_VARS['txtfield'] : $txtfield;
	$imgfield	= isset($HTTP_POST_VARS['imgfield']) ? $HTTP_POST_VARS['imgfield'] : $imgfield;
	$move_id = -1;
	$move_dir = 0;

	if ( isset($HTTP_POST_VARS['not_init']) )
	{
		// get back all item_rows
		$item_rows = array();
		$item_rows = isset($HTTP_POST_VARS['item_rows']) ? $HTTP_POST_VARS['item_rows'] : array();

		$w_item_keys = array();
		$w_item_txts = array();
		$w_item_imgs = array();
		$w_item_chks = array();
		$offset = -1;
		for ($i=0; $i < count($item_rows); $i++)
		{
			$offset++;
			$w_item_keys[] = $HTTP_POST_VARS['item_key_' . $item_rows[$i] ];
			$w_item_txts[] = $HTTP_POST_VARS['item_txt_' . $item_rows[$i] ];
			$w_item_imgs[] = $HTTP_POST_VARS['item_img_' . $item_rows[$i] ];
			$w_item_chks[] = $HTTP_POST_VARS['item_chk_' . $item_rows[$i] ];

			if ( isset($HTTP_POST_VARS['moveup_' . $item_rows[$i] ]) )
			{
				$w_move_id = $offset;
				$w_move_dir = -1;
			}
			if ( isset($HTTP_POST_VARS['movedw_' . $item_rows[$i] ]) )
			{
				$w_move_id = $offset;
				$w_move_dir = +1;
			}
		}

		// get back the values
		$item_keys = array();
		$item_txts = array();
		$item_imgs = array();
		$item_chks = array();
		$offset = -1;
		$move_id = -1;
		$move_dir = 0;
		for ($i = 0; $i < count($w_item_keys); $i++)
		{
			if ( ( !isset($HTTP_POST_VARS['delete_selection']) || !$w_item_chks[$i] ) && ( ($w_item_keys[$i] != '') || ($w_item_txts[$i] != '') || ($w_item_imgs[$i] != '') ) )
			{
				$offset++;
				$item_keys[] = $w_item_keys[$i];
				$item_txts[] = $w_item_txts[$i];
				$item_imgs[] = $w_item_imgs[$i];
				$item_chks[] = $w_item_chks[$i];
				if ( $w_move_id == $i )
				{
					$move_id = $offset;
					$move_dir = $w_move_dir;
				}
			}
		}

		// move
		if ( ( ($move_id > 0) && ($move_dir == -1) ) || ( ($move_id < (count($item_keys)-1)) && ($move_dir == +1) ) )
		{
			if ( $move_dir == -1 )
			{
				$dest = $move_id - 1;
			}
			else
			{
				$dest = $move_id + 1;
			}
			$w_key = $item_keys[$dest];
			$w_txt = $item_txts[$dest];
			$w_img = $item_imgs[$dest];
			$w_chk = $item_chks[$dest];

			$item_keys[$dest] = $item_keys[$move_id];
			$item_txts[$dest] = $item_txts[$move_id];
			$item_imgs[$dest] = $item_imgs[$move_id];
			$item_chks[$dest] = $item_chks[$move_id];
			
			$item_keys[$move_id] = $w_key;
			$item_txts[$move_id] = $w_txt;
			$item_imgs[$move_id] = $w_img;
			$item_chks[$move_id] = $w_chk;
		}

		// add values asked
		if ( isset($HTTP_POST_VARS['add_selection']) )
		{
			$item_keys[] = '';
			$item_txts[] = '';
			$item_imgs[] = '';
			$item_chks[] = false;
		}
	}

	if ( $cancel )
	{
		$mode = '';
		$cancel = false;
	}
	else if ( $delete )
	{
		$new_vlists = array();
		@reset($vlists);
		while ( list($vlist_name, $vlist_data) = @each($vlists) )
		{
			if ( ($vlist_name != $vlist) && !empty($vlist_name) )
			{
				$new_vlists[$vlist_name] = $vlist_data;
			}
		}

		// output
		pcp_output_fields($new_vlists, $tables_linked, $classes_fields, $user_maps, $user_fields);

		// prepare feedback message
		$return_path = append_sid("./admin_pcp_valueslist.$phpEx");
		$message = sprintf( $lang['PCP_valueslist_deleted'], '<a href="' . $return_path . '" />', '</a>' );
		message_die( GENERAL_MESSAGE, $message );
	}
	else if ( $submit )
	{
		// perform some check
		$error = false;
		$error_msg = '';

		// name
		if ( !empty($name) && isset($vlists[$name]) && ($name != $vlist) )
		{
			$error = true;
			$error_msg .= ( empty($error_msg) ? '' : '<br /><br />') . $lang['PCP_err_valueslist_already_exists'];
		}
		if ( empty($name) || !ereg("^[a-zA-Z0-9_]+", $name) )
		{
			$error = true;
			$error_msg .= ( empty($error_msg) ? '' : '<br /><br />') . $lang['PCP_err_valueslist_name_not_valid'];
		}

		// func
		if ( !empty($func) && !ereg("^[a-zA-Z0-9_]+", $func) )
		{
			$error = true;
			$error_msg .= ( empty($error_msg) ? '' : '<br /><br />') . $lang['PCP_err_valueslist_func_not_valid'];
		}

		// global
		if ( empty($func) && empty($main) && empty($item_keys) )
		{
			$error = true;
			$error_msg .= ( empty($error_msg) ? '' : '<br /><br />') . $lang['PCP_err_valueslist_no_data'];
		}

		// break if error
		if ( $error )
		{
			message_die( GENERAL_MESSAGE, '<br />' . $error_msg . '<br /><br />');
		}

		// update
		$values = array();
		for ($i = 0; $i < count($item_keys); $i++)
		{
			$values[ $item_keys[$i] ] = array( 'txt' => $item_txts[$i], 'img' => $item_imgs[$i] );
		}
		$new_vlists = array();
		@reset($vlists);
		while ( list($vlist_name, $vlist_data) = @each($vlists) )
		{
			if ( ($vlist_name == $vlist) && !empty($vlist) )
			{
				$new_vlists[$name]['func'] = $func;
				$new_vlists[$name]['table']['main'] = $main;
				$new_vlists[$name]['table']['key'] = $keyfield;
				$new_vlists[$name]['table']['txt'] = $txtfield;
				$new_vlists[$name]['table']['img'] = $imgfield;
				$new_vlists[$name]['values'] = $values;
			}
			else if ( !empty($vlist_name) )
			{
				$new_vlists[$vlist_name] = $vlist_data;
			}
		}
		if ( empty($vlist) )
		{
			$new_vlists[$name]['func'] = $func;
			$new_vlists[$name]['table']['main'] = $main;
			$new_vlists[$name]['table']['key'] = $keyfield;
			$new_vlists[$name]['table']['txt'] = $txtfield;
			$new_vlists[$name]['table']['img'] = $imgfield;
			$new_vlists[$name]['values'] = $values;
		}

		// output
		pcp_output_fields($new_vlists, $tables_linked, $classes_fields, $user_maps, $user_fields);

		// prepare feedback message
		$return_path = append_sid("./admin_pcp_valueslist.$phpEx");
		$message = sprintf( ( empty($vlist) ? $lang['PCP_valueslist_created'] : $lang['PCP_valueslist_modified'] ), '<a href="' . $return_path . '" />', '</a>' );
		message_die( GENERAL_MESSAGE, $message );
	}
	else
	{
		// template
		$template->set_filenames(array(
			'body' => 'admin/pcp_valueslist_edit_body.tpl')
		);

		// header
		$template->assign_vars(array(
			'L_TITLE'				=> $lang['PCP_valueslist_edit'],
			'L_TITLE_EXPLAIN'		=> $lang['PCP_valueslist_edit_explain'],

			'L_NAME'				=> $lang['PCP_valueslist_name'],
			'L_NAME_EXPLAIN'		=> $lang['PCP_valueslist_name_explain'],
			'L_FUNC'				=> $lang['PCP_valueslist_func'],
			'L_FUNC_EXPLAIN'		=> $lang['PCP_valueslist_func_explain'],
			'L_TABLE'				=> $lang['PCP_valueslist_table'],
			'L_TABLE_EXPLAIN'		=> $lang['PCP_valueslist_table_explain'],
			'L_KEYFIELD'			=> $lang['PCP_valueslist_keyfield'],
			'L_KEYFIELD_EXPLAIN'	=> $lang['PCP_valueslist_keyfield_explain'],
			'L_TXTFIELD'			=> $lang['PCP_valueslist_txtfield'],
			'L_TXTFIELD_EXPLAIN'	=> $lang['PCP_valueslist_txtfield_explain'],
			'L_IMGFIELD'			=> $lang['PCP_valueslist_imgfield'],
			'L_IMGFIELD_EXPLAIN'	=> $lang['PCP_valueslist_imgfield_explain'],

			'L_VALUES'				=> $lang['PCP_valueslist_values'],
			'L_ITEM'				=> $lang['PCP_valueslist_item_val'],
			'L_TXT'					=> $lang['PCP_valueslist_item_txt'],
			'L_IMG'					=> $lang['PCP_valueslist_item_img'],
			'L_EMPTY'				=> $lang['None'],
			'L_ADD_ITEM'			=> $lang['PCP_valueslist_add_item'],
			'L_DELETE_SELECTION'	=> $lang['PCP_valueslist_del_item'],

			'L_UP'					=> $lang['Up'],
			'L_DOWN'				=> $lang['Down'],

			'L_SUBMIT'				=> $lang['Submit'],
			'L_REFRESH'				=> $lang['Refresh'],
			'L_DELETE'				=> $lang['Delete'],
			'L_CANCEL'				=> $lang['Cancel'],
			)
		);

		// tables list
		$selected = empty($main) ? ' selected="selected"' : '';
		$s_tables_opt = '<option value=""' . $selected . '>' . $lang['None'] . '</option>';
		@reset($tables_linked);
		while ( list($table_name, $table_data) = @each($tables_linked) )
		{
			$selected = ($main == $table_name) ? ' selected="selected"' : '';
			$s_tables_opt .= '<option value="' . $table_name . '"' . $selected . '>[' . $table_name . ']</option>';
		}

		// var
		$template->assign_vars(array(
			'NAME'			=> $name,
			'FUNC'			=> $func,
			'S_TABLES_OPT'	=> $s_tables_opt,
			'MAIN'			=> $main,
			'KEYFIELD'		=> $keyfield,
			'TXTFIELD'		=> $txtfield,
			'IMGFIELD'		=> $imgfield,
			)
		);

		if ( empty($item_keys) )
		{
			$template->assign_block_vars('empty', array());
		}
		else
		{
			$color = false;
			for ($i=0; $i < count($item_keys); $i++)
			{
				$color = !$color;
				$template->assign_block_vars('row', array(
					'COLOR'		=> $color ? 'row1' : 'row2',
					'ITEM_ROW'	=> $i,
					'ITEM_KEY'	=> $item_keys[$i],
					'ITEM_TXT'	=> $item_txts[$i],
					'ITEM_IMG'	=> $item_imgs[$i],
					'ITEM_CHK'	=> $item_chks[$i] ? 'checked="checked"' : '',
					)
				);
			}
		}

		// footer
		$s_hidden_fields = '';
		$s_hidden_fields .= '<input type="hidden" name="mode" value="' . $mode . '" />';
		$s_hidden_fields .= '<input type="hidden" name="vlist" value="' . $vlist . '" />';
		$s_hidden_fields .= '<input type="hidden" name="not_init" value="1" />';
		$template->assign_vars(array(
			'S_ACTION'			=> append_sid("./admin_pcp_valueslist.$phpEx"),
			'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
			)
		);
	}
}

if ($mode == '')
{
	// template
	$template->set_filenames(array(
		'body' => 'admin/pcp_valueslist_body.tpl')
	);

	// header
	$template->assign_vars(array(
		'L_TITLE'			=> $lang['PCP_valueslist'],
		'L_TITLE_EXPLAIN'	=> $lang['PCP_valueslist_explain'],

		'L_NAME'			=> $lang['PCP_valueslist_name'],
		'L_FUNC'			=> $lang['PCP_valueslist_func'],
		'L_TABLE'			=> $lang['PCP_valueslist_table'],
		'L_VALUES'			=> $lang['PCP_valueslist_values'],

		'L_ITEM'			=> $lang['PCP_valueslist_item_val'],
		'L_TXT'				=> $lang['PCP_valueslist_item_txt'],
		'L_IMG'				=> $lang['PCP_valueslist_item_img'],
		'L_MORE'			=> $lang['More'],

		'L_ADD_TABLE'		=> $lang['PCP_valueslist_add'],
		)
	);

	// dump tables linked list
	$color = false;
	@reset($vlists);
	while ( list($vlist_name, $vlist_data) = @each($vlists) )
	{
		$color = !$color;
		$template->assign_block_vars('row', array(
			'COLOR'		=> $color ? 'row1' : 'row2',
			'NAME'		=> $vlist_name,
			'FUNC'		=> $vlist_data['func'],
			'MAIN'		=> $vlist_data['table']['main'],

			'U_VLIST'	=> append_sid("./admin_pcp_valueslist.$phpEx?mode=edit&vlist=$vlist_name"),
			'U_MAIN'	=> append_sid("./admin_pcp_tableslinked.$phpEx?mode=edit&table=" . $vlist_data['table']['main']),
			)
		);
		if ( !empty($vlist_data['values']) )
		{
			$template->assign_block_vars('row.items', array());
			$color_sub = false;
			@reset($vlist_data['values']);
			$i = 0;
			while ( list($item_val, $item_data) = @each($vlist_data['values']) )
			{
				if ($i >= PCP_threshold)
				{
					$template->assign_block_vars('row.items.more', array());
					break;
				}
				$color_sub = !$color_sub;
				$template->assign_block_vars('row.items.list', array(
					'COLOR'	=> $color_sub ? 'row1' : 'row2',
					'VAL'	=> $item_val,
					'TXT'	=> $item_data['txt'],
					'IMG'	=> $item_data['img'],
					)
				);
				$i++;
			}
		}
	}

	// footer
	$s_hidden_fields = '';
	$template->assign_vars(array(
		'S_ACTION'			=> append_sid("./admin_pcp_valueslist.$phpEx"),
		'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
		)
	);
}

// dump
$template->pparse('body');
include('./page_footer_admin.'.$phpEx);

?>