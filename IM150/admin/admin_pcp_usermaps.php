<?php

/***************************************************************************
 *							admin_pcp_usermaps.php
 *							----------------------
 *	begin				: 13/10/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: v 1.0.2 - 24/10/2003
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
define('CT_SECLEVEL', 'LOW');

if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['PCP_management']['PCP_04_usermaps'] = $file;
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

if ( !isset($nav_separator) )
{
	$nav_separator = '&nbsp;&raquo;&nbsp;';
}

$list_field = array('field_name', 'lang_key', 'leg', 'txt', 'img', 'lnk' );

// process the field_def array
$i = -1;
$cat_order = array();
@reset($field_cat);
while ( list($cat_name, $cat_data) = @each($field_cat) )
{
	$i++;
	$cat_order[$cat_name] = $i;
}
$i = -1;
$order = array();
$cats = array();
@reset($field_def);
while ( list($def_key, $def_data) = @each($field_def) )
{
	$i++;
	$cats[] = $cat_order[$def_data['cat']];
	$order[] = $i;
}
@array_multisort($cats, $order, $field_def);
//---------------------------------
//
// functions
//
//---------------------------------
// set local order
function pcp_affect_order(&$maps)
{
	$stack = array();
	$w_maps = $maps;
	@reset($maps);
	while ( list($map_name, $map_data) = @each($maps) )
	{
		// get parent
		$w_keys = explode('.', $map_name);
		$new_keys = array();
		for ($i=0; $i < (count($w_keys)-1); $i++)
		{
			$new_keys[] = $w_keys[$i];
		}
		$parent = implode('.', $new_keys);

		if ( empty($stack) || !in_array($parent, $stack) )
		{
			$order = -1;
			@reset($w_maps);
			while ( list($w_map_name, $w_map_data) = @each($w_maps) )
			{
				// get parent
				$w_keys = explode('.', $w_map_name);
				$new_keys = array();
				for ($i=0; $i < (count($w_keys)-1); $i++)
				{
					$new_keys[] = $w_keys[$i];
				}
				$local_parent = implode('.', $new_keys);

				if ($local_parent == $parent)
				{
					$order++;
					$maps[$w_map_name]['order'] = ($order * 10);
				}
			}
			$stack[] = $parent;
		}
	}
}

function pcp_sort_usermaps($user_maps)
{
	// working array
	$maps = $user_maps;

	// set the parent tree
	@reset($maps);
	while ( list($map_name, $map_data) = @each($maps) )
	{
		// find parent
		$w_map_name = $map_name;
		$w_map_data = $map_data;
		$done = false;
		while ( !$done )
		{
			// store
			$maps[$w_map_name] = $w_map_data;

			// verify parents
			$keys = explode('.', $w_map_name);
			$w_keys = array();
			for ($i=0; $i < count($keys)-1; $i++)
			{
				$w_keys[] = $keys[$i];
			}
			$parent_map = implode('.', $w_keys);

			// looping condition
			$done = ( empty($parent_map) || isset($maps[$parent_map]) );

			// set the parent value
			if ( !empty($parent_map) )
			{
				// add parent map if not exists
				if ( !isset($maps[$parent_map]) )
				{
					$maps[$parent_map] = array();
				}
			}

			// loop
			$w_map_name = $parent_map;
			$w_map_data = $maps[$parent_map];
		}
	}

	// get the parent name and the local order
	$local_order = array();
	$names = array();
	@reset($maps);
	while ( list($map_name, $map_data) = @each($maps) )
	{
		$names[] = $map_name;

		// get the parent name
		$w_keys = explode('.', $map_name);
		$new_keys = array();
		for ( $i = 0; $i < (count($w_keys)-1); $i++)
		{
			$new_keys[] = $w_keys[$i];
		}
		$maps[$map_name]['parent'] = implode( '.', $new_keys);

		// get the local order (order+name)
		$local_order[$map_name] = implode('.', array( sprintf('%09d', intval($map_data['order'])), $w_keys[ count($w_keys)-1 ] ) );
	}
	@array_multisort($names, $maps);

	// sort : get the full order expression
	$cumul_order = array();
	$order = array();
	@reset($maps);
	while ( list($map_name, $map_data) = @each($maps) )
	{
		$cumul_order[$map_name] = ( empty($cumul_order[ $map_data['parent'] ]) ? '' : $cumul_order[ $map_data['parent'] ] . '.' ) .  $local_order[$map_name];
		$order[] = $cumul_order[$map_name];
	}
	@array_multisort($order, $maps);

	pcp_affect_order($maps);

	return $maps;
}

// read and sort the maps
function pcp_get_usermaps()
{
	global $phpbb_root_path, $phpEx;

	include($phpbb_root_path . './profilcp/def/def_usermaps.' . $phpEx);

	$maps = pcp_sort_usermaps($user_maps);

	return $maps;
}

// get the tree as select options
function pcp_get_tree_options($maps, $cur='')
{
	global $lang;

	$res = '';

	// add root
	$selected = ($cur == '') ? ' selected="selected"' : '';
	$res .= '<option value=""' . $selected . '>' . $lang['PCP_usermaps_root'] . '</option>';

	// read the maps
	@reset($maps);
	while ( list($map_name, $map_data) = @each($maps) )
	{
		$w_keys = explode('.', $map_name);
		$inc = count($w_keys);
		$indent = '';
		for ( $i = 1; $i < count($w_keys); $i++ )
		{
			$indent .= '|&nbsp;&nbsp;&nbsp;';
		}
		$indent .= '|--&nbsp;';
		$selected = ($cur == $map_name) ? ' selected="selected"' : '';
		$res .= '<option value="' . $map_name . '"' . $selected . '>' . $indent . $w_keys[ count($w_keys)-1 ] . '</option>';
	}

	return $res;
}

//---------------------------------
//
//	process
//
//---------------------------------
// init
$maps = pcp_get_usermaps();

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

// map
$map = '';
if (isset($_POST['map']) || isset($_GET['map']) )
{
	$map = isset($_POST['map']) ? $_POST['map'] : $_GET['map'];
}
if ( !isset($maps[$map]) )
{
	$map = '';
}

// buttons
$submit = isset($_POST['submit']);
$create = isset($_POST['create']);
$delete = isset($_POST['delete']);
$cancel = isset($_POST['cancel']);
$edit = isset($_POST['edit']);

$add_field = isset($_POST['add_field']);
$add_title = isset($_POST['add_title']);

// check if action on the main list
$direction = 0;
$map_id = -1;
@reset($maps);
while ( list($map_name, $map_data) = @each($maps) )
{
	$map_id++;
	if ( isset($_POST['edit_map_' . $map_id]) )
	{
		$mode = 'edit';
		$map = $map_name;
	}
	if ( isset($_POST['moveup_map_' . $map_id]) )
	{
		$mode = 'move';
		$direction = -1;
		$map = $map_name;
	}
	if ( isset($_POST['movedw_map_' . $map_id]) )
	{
		$mode = 'move';
		$direction = +1;
		$map = $map_name;
	}
}

// fix the mode with the button
if ( ($edit || $mode == 'edit') && !empty($map) )
{
	$edit = 1;
	$mode = 'edit';
}

$cur_map = '';
if ( $create )
{
	$cur_map = $map;
	$mode = 'edit';
	$map = '';
}

// move up and down
if ($mode == 'move')
{
	// add direction
	$maps[$map]['order'] += (15 * $direction);

	// store into the file
	$new_maps = pcp_sort_usermaps($maps);
	pcp_output_maps($new_maps);

	// re-read
	$maps = pcp_get_usermaps();

	// continue
	$mode = '';
	$w_keys = explode('.', $map);
	$new_keys = array();
	for ( $i = 0; $i < (count($w_keys)-1); $i++ )
	{
		$new_keys[] = $w_keys[$i];
	}
	$map = implode('.', $new_keys);
}

// determine what is the map to display on nav sentence
if ( !empty($map) )
{
	$cur_map = $map;
}
$cur_map = isset($_POST['cur_map']) ? $_POST['cur_map'] : $cur_map;

// make the nav sentence
$keys = explode('.', $cur_map);
$map_nav_desc = '<a href="' . append_sid("./admin_pcp_usermaps.$phpEx") . '" class="nav">' . $lang['PCP_usermaps_root'] . '</a>';
if ( !empty($cur_map) )
{
	$cur_lvl = '';
	for ($i=0; $i < count($keys); $i++)
	{
		$cur_lvl .= ( empty($cur_lvl) ? '' : '.' ) . $keys[$i];
		$map_nav_desc .= $nav_separator . '<a href="' . append_sid("./admin_pcp_usermaps.$phpEx?map=" . $cur_lvl) . '" class="nav">' . $keys[$i] . '</a>';
	}
}

// edit a map
if ( $mode == 'edit' )
{
	// get back information from memory
	$w_keys = explode('.', $map);
	$name = $w_keys[ count($w_keys)-1 ];
	$new_keys = array();
	for ($i = 0; $i < (count($w_keys)-1); $i++)
	{
		$new_keys[] = $w_keys[$i];
	}
	$parent = implode('.', $new_keys);

	// adding a map : use the cur_map as default parent
	if ( empty($map) )
	{
		$parent = $cur_map;
	}

	$order = isset($maps[$map]['order']) ? $maps[$map]['order'] : 999999999;
	$split = isset($maps[$map]['split']) ? $maps[$map]['split'] : false;
	$custom = isset($maps[$map]['custom']) ? $maps[$map]['custom'] : 0;
	$title_single = '';

	// set of title fields
	$title_fields = array();
	$nb_title_fields = 0;
	$lf_count_title = 0;

	// set of fields
	$fields = array();
	$nb_fields = 0;
	$lf_count = 0;

	// process the title
	if ( isset($maps[$map]['title']) )
	{
		if ( empty($maps[$map]['title']) || is_string($maps[$map]['title']) )
		{
			$title_single = $maps[$map]['title'];
		}
		else
		{
			// read fields definition
			@reset($maps[$map]['title']);
			while ( list( $field_name, $field_data) = @each($maps[$map]['title']) )
			{
				// count
				$nb_title_fields++;

				// linefeed
				if ( substr($field_name, 0, 4) == '[lf]' )
				{
					$field_name = '[lf]';
					$lf_count_title++;
				}

				// reclaim the value from the user field
				$field = array();
				if ( isset($user_fields[$field_name]) )
				{
					$field = $user_fields[$field_name];
				}

				// overwrite with the map definition
				@reset($field_data);
				while ( list($key, $value) = @each($field_data) )
				{
					$field[$key] = $value;
				}
				$field['field_name'] = $field_name;

				// fill the result
				@reset($field_def);
				while ( list($def_key, $def_data) = @each($field_def) )
				{
					$title_fields[$def_key][] = $field[$def_key];
				}
			}
		}
	}

	// process the fields
	if ( isset($maps[$map]['fields']) )
	{
		// read fields definition
		@reset($maps[$map]['fields']);
		while ( list( $field_name, $field_data) = @each($maps[$map]['fields']) )
		{
			// count
			$nb_fields++;

			// linefeed
			if ( substr($field_name, 0, 4) == '[lf]' )
			{
				$field_name = '[lf]';
				$lf_count++;
			}

			// reclaim the value from the user field
			$field = array();
			if ( isset($user_fields[$field_name]) )
			{
				$field = $user_fields[$field_name];
			}

			// overwrite with the map definition
			@reset($field_data);
			while ( list($key, $value) = @each($field_data) )
			{
				$field[$key] = $value;
			}
			$field['field_name'] = $field_name;

			// fill the result
			@reset($field_def);
			while ( list($def_key, $def_data) = @each($field_def) )
			{
				$fields[$def_key][] = $field[$def_key];
			}
		}
	}

	// get back informations from form
	$name = isset($_POST['name']) ? $_POST['name'] : $name;
	$parent = isset($_POST['parent']) ? $_POST['parent'] : $parent;
	$order = isset($_POST['order']) ? intval($_POST['order']) : $order;
	$split = isset($_POST['split']) ? intval($_POST['split']) : $split;
	$custom = isset($_POST['custom']) ? intval($_POST['custom']) : $custom;

	// title
	$title_single = isset($_POST['title_single']) ? $_POST['title_single'] : $title_single;
	$nb_title_fields = isset($_POST['nb_title_fields']) ? intval($_POST['nb_title_fields']) : $nb_title_fields;

	// action
	$title_id = -1;
	$edit_title = false;
	$moveup_title = false;
	$movedw_title = false;
	$sav_title_fields = $title_fields;
	$is_title = false;
	if ( isset($_POST['nb_title_fields']) )
	{
		$title_fields = array();
		$lf_count_title = 0;
	}
	for ( $i = 0; $i < $nb_title_fields; $i++ )
	{
		if ( substr($title_fields['field_name'][$i], 0, 4) == '[lf]' )
		{
			$lf_count_title++;
		}
		@reset($field_def);
		while ( list($def_key, $def_data) = @each($field_def) )
		{
			$title_fields[$def_key][$i] = isset($_POST['title_' . $def_key . '_' . $i]) ? $_POST['title_' . $def_key . '_' . $i] : $sav_title_fields[$def_key][$i];
		}
		if ( isset($_POST['edit_title_' . $i]) )
		{
			$edit_title = true;
		}
		if ( isset($_POST['moveup_title_' . $i]) )
		{
			$moveup_title = true;
		}
		if ( isset($_POST['movedw_title_' . $i]) )
		{
			$movedw_title = true;
		}
		if ( ( $edit_title || $moveup_title || $movedw_title ) && ( $title_id < 0 ) )
		{
			$title_id = $i;
			$is_title = true;
		}
	}

	// order title
	if ( $moveup_title || $movedw_title )
	{
		if ( ($moveup_title && ($title_id > 0)) || ($movedw_title && ($title_id < ($nb_title_fields-1))) )
		{
			$dst_i = $title_id;
			if ( $moveup_title )
			{
				$dst_i--;
			}
			else
			{
				$dst_i++;
			}

			// save the dest
			$sav = array();
			@reset($field_def);
			while ( list($def_key, $def_data) = @each($field_def) )
			{
				$sav[$def_key] = $title_fields[$def_key][$dst_i];
			}

			// copy the src into the dest
			@reset($field_def);
			while ( list($def_key, $def_data) = @each($field_def) )
			{
				$title_fields[$def_key][$dst_i] = $title_fields[$def_key][$title_id];
			}

			// restore the sav into the src
			@reset($field_def);
			while ( list($def_key, $def_data) = @each($field_def) )
			{
				$title_fields[$def_key][$title_id] = $sav[$def_key];
			}
		}
	}

	// get the fields components
	$nb_fields = isset($_POST['nb_fields']) ? intval($_POST['nb_fields']) : $nb_fields;

	// action
	$field_id = -1;
	$edit_field = false;
	$moveup_field = false;
	$movedw_field = false;
	$sav_fields = $fields;
	if ( isset($_POST['nb_fields']) )
	{
		$fields = array();
		$lf_count = 0;
	}
	for ( $i = 0; $i < $nb_fields; $i++ )
	{
		if ( substr($fields['field_name'][$i], 0, 4) == '[lf]' )
		{
			$lf_count++;
		}
		@reset($field_def);
		while ( list($def_key, $def_data) = @each($field_def) )
		{
			$fields[$def_key][$i] = isset($_POST['field_' . $def_key . '_' . $i]) ? $_POST['field_' . $def_key . '_' . $i] : $sav_fields[$def_key][$i];
		}
		if ( isset($_POST['edit_field_' . $i]) )
		{
			$edit_field = true;
		}
		if ( isset($_POST['moveup_field_' . $i]) )
		{
			$moveup_field = true;
		}
		if ( isset($_POST['movedw_field_' . $i]) )
		{
			$movedw_field = true;
		}
		if ( ( $edit_field || $moveup_field || $movedw_field ) && ( $field_id < 0 ) )
		{
			$field_id = $i;
		}
	}

	// order field
	if ( $moveup_field || $movedw_field )
	{
		if ( ($moveup_field && ($field_id > 0)) || ($movedw_field && ($field_id < ($nb_fields-1))) )
		{
			$dst_i = $field_id;
			if ( $moveup_field )
			{
				$dst_i--;
			}
			else
			{
				$dst_i++;
			}

			// save the dest
			$sav = array();
			@reset($field_def);
			while ( list($def_key, $def_data) = @each($field_def) )
			{
				$sav[$def_key] = $fields[$def_key][$dst_i];
			}

			// copy the src into the dest
			@reset($field_def);
			while ( list($def_key, $def_data) = @each($field_def) )
			{
				$fields[$def_key][$dst_i] = $fields[$def_key][$field_id];
			}

			// restore the sav into the src
			@reset($field_def);
			while ( list($def_key, $def_data) = @each($field_def) )
			{
				$fields[$def_key][$field_id] = $sav[$def_key];
			}
		}
	}

	// process the fields
	if ( $edit_field || $edit_title || $add_field || $add_title )
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

		// get the values
		$field_det = array();
		@reset($field_def);
		while ( list($def_key, $def_data) = @each($field_def) )
		{
			// get values from memory
			if ($edit_title)
			{
				$field_det[$def_key] = isset($title_fields[$def_key][$title_id]) ? $title_fields[$def_key][$title_id] : '';
			}
			else if ($edit_field)
			{
				$field_det[$def_key] = isset($fields[$def_key][$field_id]) ? $fields[$def_key][$field_id] : '';
			}

			// get values from form
			$field_det[$def_key] = isset($_POST['field_det_' . $def_key]) ? $_POST['field_det_' . $def_key] : $field_det[$def_key];
		}
		
		/* PCP Extra :: REMOVED
		// some default values
		if ( empty($field_det['class']) )
		{
			$field_det['class'] = 'generic';
		}
		if ( empty($field_det['type']) )
		{
			$field_det['type'] = 'VARCHAR';
		}*/

		// suggest an Option address
		if ( isset($_POST['suggest']) && empty($field_det['ind']) )
		{
			$last_ind = 0;
			for ( $i = 0; $i < count($fields['ind']); $i++ )
			{
				if ( $fields['ind'][$i] > $last_ind )
				{
					$last_ind = $fields['ind'][$i];
				}
			}
			$field_det['ind'] = $last_ind + 1;
		}
		if ( $cancel )
		{
			// back to list
			$cancel = false;
			$edit_field = false;
			$edit_title = false;
			$add_field = false;
			$add_title = false;
			$title_id = -1;
			$field_id = -1;
			$is_title = false;
		}
		else if ( $delete )
		{
			if ( $is_title )
			{
				$new_title_fields = array();
				for ($i = 0; $i < count($title_fields['field_name']); $i++)
				{
					if ( $i != $title_id )
					{
						@reset($field_def);
						while ( list($def_key, $def_data) = @each($field_def) )
						{
							$new_title_fields[$def_key][] = $title_fields[$def_key][$i];
						}
					}
				}
				$title_fields = $new_title_fields;
				$nb_title_fields = count($title_fields['field_name']);
			}
			else
			{
				$new_fields = array();
				for ($i = 0; $i < count($fields['field_name']); $i++)
				{
					if ( $i != $field_id )
					{
						@reset($field_def);
						while ( list($def_key, $def_data) = @each($field_def) )
						{
							$new_fields[$def_key][] = $fields[$def_key][$i];
						}
					}
				}
				$fields = $new_fields;
				$nb_fields = count($fields['field_name']);
			}

			// back to list
			$delete = false;
			$edit_field = false;
			$edit_title = false;
			$add_field = false;
			$add_title = false;
			$title_id = -1;
			$field_id = -1;
			$is_title = false;
		}
		else if ( $submit )
		{
			// perform some checks
			$error = false;
			$error_msg = '';

			// process linefeed
			if ( substr($field_det['field_name'], 0, 4) == '[lf]' )
			{
				if ( $is_title )
				{
					$lf_count_title++;
					$field_det['field_name'] = '[lf]' . ($lf_count_title-1);
				}
				else
				{
					$lf_count++;
					$field_det['field_name'] = '[lf]' . ($lf_count-1);
				}
			}

			// check if exists
			if ( $is_title )
			{
				$found = false;
				for ($i = 0; $i < count($title_fields['field_name']); $i++)
				{
					$found = ( ($title_fields['field_name'][$i] == $field_det['field_name']) && ($title_id != $i) );
					if ( $found )
					{
						$error = true;
						$error_msg = ( empty($error_msg) ? '' : '<br />' ) . $lang['PCP_err_usermaps_field_already_in_map'];
						break;
					}
				}
			}
			else
			{
				$found = false;
				for ($i = 0; $i < count($fields['field_name']); $i++)
				{
					$found = ( ($fields['field_name'][$i] == $field_det['field_name']) && ($field_id != $i) );
					if ( $found )
					{
						$error = true;
						$error_msg = ( empty($error_msg) ? '' : '<br />' ) . $lang['PCP_err_usermaps_field_already_in_map'];
						break;
					}
				}
			}

			// is the field name ok ?
			if ( empty($field_det['field_name']) || !ereg("^[a-z0-9_\[]+", $field_det['field_name']) )
			{
				$error = true;
				$error_msg .= ( empty($error_msg) ? '' : '<br />' ) . $lang['PCP_err_field_name_not_valid'];
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

			// send error
			if ( $error )
			{
				message_die( GENERAL_MESSAGE, '<br />' . $error_msg . '<br /><br />');
			}

			// update
			if ( $is_title )
			{
				if ( $title_id < 0 )
				{
					$nb_title_fields = count($title_fields['field_name'])+1;
					$title_id = $nb_title_fields-1;
				}
				$id = $title_id;
			}
			else
			{
				if ( $field_id < 0 )
				{
					$nb_fields = count($fields['field_name'])+1;
					$field_id = $nb_fields-1;
				}
				$id = $field_id;
			}
			@reset($field_def);
			while ( list($def_key, $ddef_data) = @each($field_def) )
			{
				if ( $is_title )
				{
					$title_fields[$def_key][$id] = $field_det[$def_key];
				}
				else
				{
					$fields[$def_key][$id] = $field_det[$def_key];
				}
			}

			// get back to list
			$submit = false;
			$edit_field = false;
			$edit_title = false;
			$add_field = false;
			$add_title = false;
			$title_id = -1;
			$field_id = -1;
			$is_title = false;
		}
		else
		{
			// template
			$template->set_filenames(array(
				'body' => 'admin/pcp_userfields_edit_body.tpl')
			);

			// header
			$template->assign_vars(array(
				'L_TITLE'				=> $is_title ? $lang['PCP_usermaps_title_edit'] : $lang['PCP_usermaps_field_edit'],
				'L_TITLE_EXPLAIN'		=> $is_title ? $lang['PCP_usermaps_title_edit_explain'] : $lang['PCP_usermaps_field_edit_explain'],

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
				if ($field_def[$def_key]['cat'] == $cur_cat)
				{
					$suggest_button = '';
					if ( $def_key == 'ind' )
					{
						$suggest_button = '  <input type="submit" name="suggest" value="' . $lang['Suggest'] . '" class="liteoption" />';
					}
					$template->assign_block_vars('row', array(
						'L_FIELD'			=> pcp_format_lang($def_data['lang_key']),
						'L_FIELD_EXPLAIN'	=> pcp_format_lang($def_data['explain']),
						'FIELD'				=> stripslashes(pcp_format_input($def_type, $def_name, $def_value)) . $suggest_button,
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

			// footer
			$s_hidden_fields .= '<input type="hidden" name="mode" value="' . $mode . '" />';
			$s_hidden_fields .= '<input type="hidden" name="cur_map" value="' . $cur_map . '" />';
			$s_hidden_fields .= '<input type="hidden" name="map" value="' . $map . '" />';
			$s_hidden_fields .= '<input type="hidden" name="cur_cat" value="' . $cur_cat . '" />';

			// coming from map display
			$s_hidden_fields .= '<input type="hidden" name="name" value="' . $name . '" />';
			$s_hidden_fields .= '<input type="hidden" name="parent" value="' . $parent . '" />';
			$s_hidden_fields .= '<input type="hidden" name="order" value="' . $order . '" />';
			$s_hidden_fields .= '<input type="hidden" name="split" value="' . $split . '" />';
			$s_hidden_fields .= '<input type="hidden" name="custom" value="' . $custom . '" />';

			// nb fields
			$s_hidden_fields .= '<input type="hidden" name="nb_title_fields" value="' . $nb_title_fields . '" />';
			$s_hidden_fields .= '<input type="hidden" name="nb_fields" value="' . $nb_fields . '" />';

			// local mode
			if ( $edit_title )
			{
				$s_hidden_fields .= '<input type="hidden" name="edit_title_' . $title_id . '" value="1" />';
			}
			if ( $edit_field )
			{
				$s_hidden_fields .= '<input type="hidden" name="edit_field_' . $field_id . '" value="1" />';
			}
			if ( $add_title )
			{
				$s_hidden_fields .= '<input type="hidden" name="add_title" value="1" />';
			}
			if ( $add_field )
			{
				$s_hidden_fields .= '<input type="hidden" name="add_field" value="1" />';
			}

			// store the dsp fields
			for ( $i=0; $i < $nb_title_fields; $i++)
			{
				@reset($field_def);
				while ( list($def_key, $def_data) = @each($field_def) )
				{
					$value = $title_fields[$def_key][$i];
					$s_hidden_fields .= '<input type="hidden" name="title_' . $def_key . '_' . $i .'" value="' . htmlspecialchars(htmldecode($value)) . '" />';
				}
			}
			for ( $i=0; $i < $nb_fields; $i++)
			{
				@reset($field_def);
				while ( list($def_key, $def_data) = @each($field_def) )
				{
					$value = $fields[$def_key][$i];
					$s_hidden_fields .= '<input type="hidden" name="field_' . $def_key . '_' . $i .'" value="' . htmlspecialchars(htmldecode($value)) . '" />';
				}
			}

			// dump
			$template->assign_vars(array(
				'MAP_NAV_DESC'		=> $map_nav_desc,
				'S_ACTION'			=> append_sid("./admin_pcp_usermaps.$phpEx"),
				'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
				)
			);
		}
	}

	// process the map
	if ( !$edit_field && !$edit_title && !$add_field && !$add_title )
	{
		if ( $cancel )
		{
			// we were creating a new map
			if ( empty($map) )
			{
				$map = $cur_map;
			}
			else
			{
				$cur_map = $map;
			}
			$cancel = false;
			$mode = '';
		}
		else if ( $delete )
		{
			// perform some checks
			$error = false;
			$error_msg = '';

			// search if maps are attached to the one to remove
			$found = false;
			@reset($maps);
			while ( list($map_name, $map_data) = @each($maps) )
			{
				$found = ( ($map_name != $map) && ( substr($map_name, 0, strlen($map)) == $map ) );
				if ( $found )
				{
					$error = true;
					$error_msg .= ( empty($error_msg) ? '' : '<br /><br />' ) . $lang['PCP_err_usermaps_not_empty'];
					break;
				}
			}

			// error
			if ( $error )
			{
				message_die( GENERAL_MESSAGE, '<br />' . $error_msg . '<br /><br />');
			}

			// delete
			$new_maps = array();
			@reset($maps);
			while ( list($map_name, $map_data) = @each($maps) )
			{
				if ( substr($map_name, 0, strlen($map)) != $map )
				{
					$new_maps[$map_name] = $map_data;
				}
			}

			// store into the file
			$new_maps = pcp_sort_usermaps($new_maps);
			pcp_output_maps($new_maps);

			// get the parent map
			$w_keys = explode('.', $map);
			$new_keys = array();
			for ($i=0; $i < (count($w_keys)-1); $i++)
			{
				$new_keys[] = $w_keys[$i];
			}
			$parent_map = implode('.', $new_keys);

			// send the final message
			$return_path = append_sid("./admin_pcp_usermaps.$phpEx" . (empty($parent_map) ? '' : "?map=$parent_map") );
			$message = sprintf( $lang['PCP_usermaps_deleted'], '<a href="' . $return_path . '" />', '</a>' );
			message_die( GENERAL_MESSAGE, $message );
		}
		else if ( $submit )
		{
			// full map name
			$full_name = $name;
			if ( !empty($parent) )
			{
				$full_name = $parent . '.' . $name;
			}

			// do some checks
			$error = false;
			$error_msg = '';

			// map already exists ?
			if ( ($full_name != $map) && isset($maps[$full_name]) )
			{
				$error = true;
				$error_msg .= ( empty($error_msg) ? '' : '<br />' ) . $lang['PCP_err_usermaps_already_exists'];
			}

			// is the map name ok ?
			if ( empty($name) || !ereg("^[a-zA-Z0-9_]+", $name) )
			{
				$error = true;
				$error_msg .= ( empty($error_msg) ? '' : '<br />' ) . $lang['PCP_err_usermaps_name_not_valid'];
			}

			// error
			if ( $error )
			{
				message_die( GENERAL_MESSAGE, '<br />' . $error_msg . '<br /><br />');
			}

			// rename map attached
			if ( !empty($map) )
			{
				$new_maps = array();
				@reset($maps);
				while ( list($map_name, $map_data) = @each($maps) )
				{
					if ( (substr($map_name, 0, strlen($map)) == $map) && (($map_name == $map) || (substr($map_name, strlen($map), 1) == '.')) )
					{
						$new_name = $full_name . substr($map_name, strlen($map));
						$new_maps[$new_name] = $map_data;
					}
					else
					{
						$new_maps[$map_name] = $map_data;
					}
				}
			}
			else
			{
				$new_maps = $maps;
			}

			// get back values
			$wmap = array();

			// title
			$wfields = array();
			if ( !empty($title_fields['field_name']) )
			{
				$lf_count = -1;
				for ( $i = 0; $i < count($title_fields['field_name']); $i++ )
				{
					$field_name = $title_fields['field_name'][$i];
					if ( !empty($field_name) )
					{
						if ( substr($field_name, 0, 4) == '[lf]' )
						{
							$lf_count++;
							$wfields['[lf]' . $lf_count ] = array();
						}
						else
						{
							// get all the key if different from the user field ones
							$done = false;
							@reset($field_def);
							while ( list($key, $def) = @each($field_def) )
							{
								if ( ($key != 'field_name') && ( !isset($user_maps[$field_name]) || ($title_fields[$key][$i] != $user_maps[$field_name][$key]) ) )
								{
									$wfields[$field_name][$key] = $title_fields[$key][$i];
									$done = true;
								}
							}
							if ( !$done )
							{
								$wfields[$field_name] = array();
							}
						}
					}
				}
			}
			if ( !empty($wfields) )
			{
				$wmaps['title'] = $wfields;
			}
			else
			{
				$wmaps['title'] = $title_single;
			}

			// fields
			$wfields = array();
			$lf_count = -1;
			for ( $i = 0; $i < count($fields['field_name']); $i++ )
			{
				$field_name = $fields['field_name'][$i];
				if ( substr($field_name, 0, 4) == '[lf]' )
				{
					$lf_count++;
					$wfields['[lf]' . $lf_count ] = array();
				}
				else
				{
					// get all the key if different from the user field ones
					$done = false;
					@reset($field_def);
					while ( list($key, $def) = @each($field_def) )
					{
						if ( ($key != 'field_name') && ( !isset($user_maps[$field_name]) || ($fields[$key][$i] != $user_maps[$field_name][$key]) ) )
						{
							$wfields[$field_name][$key] = $fields[$key][$i];
							$done = true;
						}
					}
					if ( !$done )
					{
						$wfields[$field_name] = array();
					}
				}
			}
			$wmaps['fields'] = $wfields;
			$wmaps['order'] = empty($map) ? 999999999 : $maps[$map]['order'];
			$wmaps['split'] = $split;
			$wmaps['custom'] = $custom;

			// store the current map
			$new_maps[$full_name] = $wmaps;

			// store into the file
			$new_maps = pcp_sort_usermaps($new_maps);
			pcp_output_maps($new_maps);

			// send the final message
			$return_path = append_sid("./admin_pcp_usermaps.$phpEx?map=$full_name");
			$message = sprintf( ( empty($map) ? $lang['PCP_usermaps_created'] : $lang['PCP_usermaps_modified']), '<a href="' . $return_path . '" />', '</a>' );
			message_die( GENERAL_MESSAGE, $message );
		}
		else
		{
			// template
			$template->set_filenames(array(
				'body' => 'admin/pcp_usermaps_edit_body.tpl')
			);

			// header
			$template->assign_vars(array(
				'L_TITLE'				=> $lang['PCP_usermaps_edit'],
				'L_TITLE_EXPLAIN'		=> $lang['PCP_usermaps_edit_explain'],

				'L_NAME'				=> $lang['PCP_usermaps_name'],
				'L_NAME_EXPLAIN'		=> $lang['PCP_usermaps_name_explain'],
				'L_PARENT'				=> $lang['PCP_usermaps_parent'],
				'L_PARENT_EXPLAIN'		=> $lang['PCP_usermaps_parent_explain'],
				'L_SPLIT'				=> $lang['PCP_usermaps_split'],
				'L_SPLIT_EXPLAIN'		=> $lang['PCP_usermaps_split_explain'],
				'L_CUSTOM'				=> $lang['PCP_usermaps_custom'],
				'L_CUSTOM_EXPLAIN'		=> $lang['PCP_usermaps_custom_explain'],

				'L_SUBMIT'				=> $lang['Submit'],
				'L_REFRESH'				=> $lang['Refresh'],
				'L_DELETE'				=> $lang['Delete'],
				'L_CANCEL'				=> $lang['Cancel'],

				'L_NONE'				=> $lang['None'],
				'L_LINEFEED'			=> $lang['Linefeed'],
				'L_ACTION'				=> $lang['Action'],
				'L_UP'					=> $lang['Up'],
				'L_EDIT'				=> $lang['Edit'],
				'L_DW'					=> $lang['Down'],
				)
			);

			$s_custom = '';
			$customs_list = array('PCP_custom_none', 'PCP_custom_input', 'PCP_custom_output');
			for ( $i = 0; $i < 3; $i++ )
			{
				$checked = ($custom == $i) ? ' checked="checked"' : '';
				$s_custom .= '<input type="radio" name="custom" value="' . $i . '" ' . $checked . ' />' . $lang[ $customs_list[$i] ] . '<br />';
			}

			// values
			$template->assign_vars(array(
				'NAME'		=> $name,
				'S_SPLIT'	=> pcp_input_boolean('split', $split),
				'S_CUSTOM'	=> $s_custom,
				'S_PARENT'	=> pcp_get_tree_options($maps, $parent),
				)
			);

			//---------------
			// title
			//---------------
			$template->assign_block_vars('block', array(
				'L_TITLE'			=> $lang['PCP_usermaps_title'],
				'L_TITLE_EXPLAIN'	=> $lang['PCP_usermaps_title_explain'],

				'TITLE'				=> $title_single,
				'L_BUTTON'			=> $lang['PCP_usermaps_add_titlefield'],
				'BUTTON'			=> 'title',

				'SPAN'				=> count($list_field)+1,
				)
			);
			if ( empty($title_fields['field_name']) )
			{
				$template->assign_block_vars('block.single', array());
				if ( empty($title_single) )
				{
					$template->assign_block_vars('block.single.button', array());
				}
			}
			else
			{
				$template->assign_block_vars('block.multi', array());
				// header
				for ( $j = 0; $j < count($list_field); $j++ )
				{
					$template->assign_block_vars('block.multi.col', array(
						'TITLE'	=> pcp_format_lang($field_def[ $list_field[$j] ]['short']),
						)
					);
				}
				$color = false;
				for ( $i = 0; $i < count($title_fields['field_name']); $i++ )
				{
					$color = !$color;
					$template->assign_block_vars('block.multi.row', array(
						'COLOR'		=> $color ? 'row1' : 'row2',
						'ROW_ID'	=> $i,
						)
					);
					for ( $j = 0; $j < count($list_field); $j++ )
					{
						$template->assign_block_vars('block.multi.row.col', array(
							'ALIGN'	=> empty($types_list[ $field_def[ $list_field[$j] ]['type'] ]['align']) ? 'left' : $types_list[ $field_def[ $list_field[$j] ]['type'] ]['align'],
							'VALUE'	=> pcp_format_output( $field_def[ $list_field[$j] ]['type'], $title_fields[ $list_field[$j] ][$i], $field_def[ $list_field[$j] ]['style'] ),
							)
						);
					}
				}
				// empty
				if ( count($title_fields['field_name']) == 0 )
				{
					$template->assign_block_vars('block.multi.none', array());
				}
			}

			//---------------
			// fields
			//---------------
			// title
			$template->assign_block_vars('block', array(
				'L_TITLE'			=> $lang['PCP_usermaps_fields'],
				'L_BUTTON'			=> $lang['PCP_usermaps_add_field'],
				'BUTTON'			=> 'field',

				'SPAN'				=> count($list_field)+1,
				)
			);
			$template->assign_block_vars('block.multi', array());
			// header
			for ( $j = 0; $j < count($list_field); $j++ )
			{
				$template->assign_block_vars('block.multi.col', array(
					'TITLE'	=> pcp_format_lang($field_def[ $list_field[$j] ]['short']),
					)
				);
			}
			$color = false;
			for ( $i = 0; $i < count($fields['field_name']); $i++ )
			{
				$color = !$color;
				$template->assign_block_vars('block.multi.row', array(
					'COLOR'		=> $color ? 'row1' : 'row2',
					'ROW_ID'	=> $i,
					)
				);
				for ( $j = 0; $j < count($list_field); $j++ )
				{
					$template->assign_block_vars('block.multi.row.col', array(
						'ALIGN'	=> empty($types_list[ $field_def[ $list_field[$j] ]['type'] ]['align']) ? 'left' : $types_list[ $field_def[ $list_field[$j] ]['type'] ]['align'],
						'VALUE'	=> pcp_format_output( $field_def[ $list_field[$j] ]['type'], $fields[ $list_field[$j] ][$i], $field_def[ $list_field[$j] ]['style'] ),
						)
					);
				}
			}
			// empty
			if ( count($fields['field_name']) == 0 )
			{
				$template->assign_block_vars('block.multi.none', array());
			}

			// footer
			$s_hidden_fields = '';
			$s_hidden_fields .= '<input type="hidden" name="mode" value="' . $mode . '" />';
			$s_hidden_fields .= '<input type="hidden" name="cur_map" value="' . $cur_map . '" />';
			$s_hidden_fields .= '<input type="hidden" name="map" value="' . $map . '" />';

			// nb fields
			$s_hidden_fields .= '<input type="hidden" name="nb_title_fields" value="' . $nb_title_fields . '" />';
			$s_hidden_fields .= '<input type="hidden" name="nb_fields" value="' . $nb_fields . '" />';

			// store the dsp fields
			for ( $i=0; $i < $nb_title_fields; $i++)
			{
				@reset($field_def);
				while ( list($def_key, $def_data) = @each($field_def) )
				{
					$value = $title_fields[$def_key][$i];
					$s_hidden_fields .= '<input type="hidden" name="title_' . $def_key . '_' . $i .'" value="' . htmlspecialchars(htmldecode($value)) . '" />';
				}
			}
			for ( $i=0; $i < $nb_fields; $i++)
			{
				@reset($field_def);
				while ( list($def_key, $def_data) = @each($field_def) )
				{
					$value = $fields[$def_key][$i];
					$s_hidden_fields .= '<input type="hidden" name="field_' . $def_key . '_' . $i .'" value="' . htmlspecialchars(htmldecode($value)) . '" />';
				}
			}

			// dump
			$template->assign_vars(array(
				'MAP_NAV_DESC'		=> $map_nav_desc,
				'S_ACTION'			=> append_sid("./admin_pcp_usermaps.$phpEx"),
				'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
				)
			);
		}
	}
}

// main list
if ($mode == '')
{
	// template
	$template->set_filenames(array(
		'body' => 'admin/pcp_usermaps_body.tpl')
	);

	// header
	$template->assign_vars(array(
		'L_TITLE'			=> $lang['PCP_usermaps'],
		'L_TITLE_EXPLAIN'	=> $lang['PCP_usermaps_explain'],

		'L_NAME'			=> $lang['PCP_usermaps_name'],
		'L_MAP_TITLE'		=> $lang['PCP_usermaps_title'],

		'L_NONE'			=> $lang['None'],
		'L_SUB_MAPS'		=> $lang['PCP_usermaps_sub'],

		'L_FIELDNAME'		=> $lang['PCP_field_name_short'],
		'L_FIELDLEG'		=> $lang['PCP_field_leg_short'],
		'L_FIELDTXT'		=> $lang['PCP_field_txt_short'],
		'L_FIELDIMG'		=> $lang['PCP_field_img_short'],

		'L_ADD_MAP'			=> $lang['PCP_usermaps_add'],
		'L_EDIT'			=> $lang['Edit'],
		'L_UP'				=> $lang['Up'],
		'L_DW'				=> $lang['Down'],
		'L_ACTION'			=> $lang['Action'],
		)
	);

	// child maps
	$template->assign_block_vars('sub', array());
	$i = 0;
	$map_id = -1;
	$color = false;
	@reset($maps);
	while ( list($map_name, $map_data) = @each($maps) )
	{
		$map_id++;
		if ($map_data['parent'] == $map)
		{
			// map name
			$keys = explode('.', $map_name);
			$name = $keys[ count($keys)-1 ];

			// map title
			$title = '';
			if ( !empty($map_data['title']) )
			{
				if ( is_string($map_data['title']) )
				{
					$title = pcp_format_lang($map_data['title'], true);
				}
				else
				{
					@reset($map_data['title']);
					while ( list($field_name, $field_data) = @each($map_data['title']) )
					{
						$title .= ( empty($title) ? '' : '<br />' ) . $field_name;
					}
				}
			}

			// dump
			$color = !$color;
			$i++;
			$template->assign_block_vars('sub.row', array(
				'COLOR'		=> $color ? 'row1' : 'row2',
				'NAME'		=> $name,
				'MAP_TITLE'	=> $title,

				'MAP_ID'	=> $map_id,
				'U_NAME'	=> append_sid("./admin_pcp_usermaps.$phpEx?map=$map_name"),
				)
			);
		}
	}
	if ( $i == 0 )
	{
		$template->assign_block_vars('sub.none', array());
	}

	// map details
	if ( !empty($map) )
	{
		$template->assign_block_vars('details', array());
		$template->assign_vars(array(
			'MAP_NAME'	=> $map,
			)
		);
		//-------------------
		// title
		//-------------------
		$text = ( is_string($maps[$map]['title']) || empty($maps[$map]['title']) );
		$template->assign_block_vars('details.block', array(
			'L_TITLE'	=> $lang['PCP_usermaps_title'],
			'TITLE'		=> $text ? ( empty($maps[$map]['title']) ? $lang['None'] : pcp_format_lang($maps[$map]['title'], true) ) : '',

			'SPAN'		=> count($list_field),
			)
		);

		// one field
		if ( $text )
		{
			$template->assign_block_vars('details.block.text', array());
		}

		// list of field
		if ( !$text )
		{
			$template->assign_block_vars('details.block.multi', array());
			// header
			for ( $j = 0; $j < count($list_field); $j++ )
			{
				$template->assign_block_vars('details.block.multi.col', array(
					'TITLE'	=> '&nbsp;' . ( ($list_field[$j] != 'field_name') ? pcp_format_lang($field_def[ $list_field[$j] ]['short']) : $lang['PCP_usermaps_title'] ) . '&nbsp;',
					'WIDTH' => ($list_field[$j] == 'field_name') ? '50%' : ( ($list_field[$j] == 'lang_key') ? '50%' : '10%' ),
					)
				);
			}
			$color = false;
			@reset($maps[$map]['title']);
			$i = 0;
			while ( list($field_name, $field_data) = @each($maps[$map]['title']) )
			{
				$field_data['field_name'] = $field_name;
				$i++;
				$color = !$color;
				$template->assign_block_vars('details.block.multi.row', array(
					'COLOR'		=> $color ? 'row1' : 'row2',
					)
				);
				for ( $j = 0; $j < count($list_field); $j++ )
				{
					$value = $field_data[ $list_field[$j] ];
					if ( empty($value) && !empty($user_fields[$field_name][ $list_field[$j] ]) )
					{
						$value = $user_fields[$field_name][ $list_field[$j] ];
					}
					$template->assign_block_vars('details.block.multi.row.col', array(
						'ALIGN'	=> empty($types_list[ $field_def[ $list_field[$j] ]['type'] ]['align']) ? 'left' : $types_list[ $field_def[ $list_field[$j] ]['type'] ]['align'],
						'VALUE'	=> pcp_format_output( $field_def[ $list_field[$j] ]['type'], $value, $field_def[ $list_field[$j] ]['style'] ),
						)
					);
				}
			}
			// empty
			if ( $i == 0 )
			{
				$template->assign_block_vars('details.block.multi.none', array());
			}
		}

		//-------------------
		// fields
		//-------------------
		$text = ( is_string($maps[$map]['fields']) || empty($maps[$map]['fields']) );
		$template->assign_block_vars('details.block', array(
			'L_TITLE'	=> $lang['PCP_usermaps_fields'],
			'TITLE'		=> $text ? ( empty($maps[$map]['fields']) ? $lang['None'] : pcp_format_lang($maps[$map]['fields'], true) ) : '',

			'SPAN'		=> count($list_field),
			)
		);

		// one field
		if ( $text )
		{
			$template->assign_block_vars('details.block.text', array());
		}

		// list of field
		if ( !$text )
		{
			$template->assign_block_vars('details.block.multi', array());
			// header
			for ( $j = 0; $j < count($list_field); $j++ )
			{
				$template->assign_block_vars('details.block.multi.col', array(
					'TITLE'	=> '&nbsp;' . ( ($list_field[$j] != 'field_name') ? pcp_format_lang($field_def[ $list_field[$j] ]['short']) : $lang['PCP_usermaps_fields'] ) . '&nbsp;',
					'WIDTH' => ($list_field[$j] == 'field_name') ? '50%' : ( ($list_field[$j] == 'lang_key') ? '50%' : '10%' ),
					)
				);
			}
			$color = false;
			@reset($maps[$map]['fields']);
			$i = 0;
			while ( list($field_name, $field_data) = @each($maps[$map]['fields']) )
			{
				$field_data['field_name'] = $field_name;
				$i++;
				$color = !$color;
				$template->assign_block_vars('details.block.multi.row', array(
					'COLOR'		=> $color ? 'row1' : 'row2',
					)
				);
				for ( $j = 0; $j < count($list_field); $j++ )
				{
					$value = $field_data[ $list_field[$j] ];
					if ( empty($value) && !empty($user_fields[$field_name][ $list_field[$j] ]) )
					{
						$value = $user_fields[$field_name][ $list_field[$j] ];
					}
					$template->assign_block_vars('details.block.multi.row.col', array(
						'ALIGN'	=> empty($types_list[ $field_def[ $list_field[$j] ]['type'] ]['align']) ? 'left' : $types_list[ $field_def[ $list_field[$j] ]['type'] ]['align'],
						'VALUE'	=> pcp_format_output( $field_def[ $list_field[$j] ]['type'], $value, $field_def[ $list_field[$j] ]['style'] ),
						)
					);
				}
			}
			// empty
			if ( $i == 0 )
			{
				$template->assign_block_vars('details.block.multi.none', array());
			}
		}
	}

	// footer
	$s_hidden_fields = '';
	$s_hidden_fields .= '<input type="hidden" name="map" value="' . $map . '" />';
	$template->assign_vars(array(
		'MAP_NAV_DESC'		=> $map_nav_desc,
		'S_ACTION'			=> append_sid("./admin_pcp_usermaps.$phpEx"),
		'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
		)
	);
}

// dump
$template->pparse('body');
include('./page_footer_admin.'.$phpEx);

?>
