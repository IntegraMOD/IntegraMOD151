<?php

/***************************************************************************
 *							def_userfuncs.php
 *							-----------------
 *	begin				: 04/10/2003
 *	copyright			: Ptirhiik
 *	email				: Ptirhiik@rpgnet.clanmckeen.com
 *
 *	version				: 1.0.5 - 04/11/2003
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

//---------------------------------------------------------------------
//
//	function pcp_parse_def() : parse a sql def, getting all the tables linked and setting their identifiers
//
//---------------------------------------------------------------------
function pcp_parse_def($sql_def, $view_userdata, &$tables_used)
{
	global $phpEx, $phpbb_root_path;
	global $board_config;
	global $values_list, $tables_linked, $classes_fields, $user_maps, $user_fields;

	// nothing to parse
	if ( empty($sql_def) ) return '';

	// change the [view.field_name] by its value $view_userdata[$field_name]
	$sql_ids = array();
	preg_match_all("|\[view.([^\]].*)\]|U", $sql_def, $sql_ids );
	if (count($sql_ids) > 0)
	{
		for ($i = 0; $i < count($sql_ids[1]); $i++)
		{
			$sql_def = str_replace( '[view.' . $sql_ids[1][$i] . ']', $view_userdata[ $sql_ids[1][$i] ], $sql_def );
		}
	}

	// change the [user.field_name] by its value $userdata[$field_name]
	$sql_ids = array();
	preg_match_all("|\[user.([^\]].*)\]|U", $sql_def, $sql_ids );
	if (count($sql_ids) > 0)
	{
		for ($i = 0; $i < count($sql_ids[1]); $i++)
		{
			$sql_def = str_replace( '[user.' . $sql_ids[1][$i] . ']', $userdata[ $sql_ids[1][$i] ], $sql_def );
		}
	}

	// change the [cst.constant] by its value constant(constant)
	$sql_ids = array();
	preg_match_all("|\[cst.([^\]].*)\]|U", $sql_def, $sql_ids );
	if (count($sql_ids) > 0)
	{
		for ($i = 0; $i < count($sql_ids[1]); $i++)
		{
			$sql_def = str_replace( '[cst.' . $sql_ids[1][$i] . ']', constant($sql_ids[1][$i]), $sql_def );
		}
	}

	// change [board.$config_name] by its value $board_config[$config_name]
	$sql_ids = array();
	preg_match_all("|\[board.([^\]].*)\]|U", $sql_def, $sql_ids );
	if (count($sql_ids) > 0)
	{
		for ($i = 0; $i < count($sql_ids[1]); $i++)
		{
			$sql_def = str_replace( '[board.' . $sql_ids[1][$i] . ']', $board_config[ $sql_ids[1][$i] ], $sql_def );
		}
	}

	// change [time] by its value time()
	$sql_ids = array();
	$sql_def = str_replace( '[time]', time(), $sql_def );

	// change [php] by $phpEx
	$sql_def = str_replace( '[php]', $phpEx, $sql_def );

	// change [phpbb_root_path] by $phpbb_root_path
	$sql_def = str_replace( '[phpbb_root_path]', $phpbb_root_path, $sql_def );

	// parse the table identifiers
	$sql_ids = array();
	preg_match_all("|\[([^\]].*)\]|U", $sql_def, $sql_ids );
	if (count($sql_ids) > 0)
	{
		for ($i = 0; $i < count($sql_ids[1]); $i++)
		{
			$sql_def = str_replace( '[' . $sql_ids[1][$i] . ']', $tables_linked[ $sql_ids[1][$i] ]['sql_id'], $sql_def );

			// store the tables used
			$tables_used[ $sql_ids[1][$i] ] = true;
		}
	}
	return $sql_def;
}

//---------------------------------------------------------------------
//
//	function pcp_get_class_check() : get the class field check result
//
//---------------------------------------------------------------------
function pcp_get_class_check($class_name, &$view_userdata) {
	global $board_config, $phpbb_root_path, $phpEx, $lang, $images, $userdata;
	global $values_list, $tables_linked, $classes_fields, $user_maps, $user_fields;

	$class_data = array();
	if ( isset($classes_fields[$class_name]) )
	{
		$class_data = $classes_fields[$class_name];
	}
	// check the data classes
	/* PCP Extra :: Altered
	$display = display_field($class_data['user_field'], $class_data['config_field'],$view_userdata); */
	$display = display_field($class_data['user_field'], $view_userdata);
	return $display;
}

//---------------------------------------------------------------------
//
//	function pcp_output_format() : format display according to settings
//
//---------------------------------------------------------------------
function pcp_output_format($field_name, $txt, $img, $map_name, $lnk='', $view_userdata=array())
{
	global $board_config, $phpbb_root_path, $phpEx, $lang, $images, $userdata;
	global $values_list, $tables_linked, $classes_fields, $user_maps, $user_fields;

	if ( empty($view_userdata) )
	{
		$view_userdata = $userdata;
	}

	// get map config
	$map_leg = false;
	$map_txt = false;
	$map_img = false;
	$map_lnk = false;
	$map_crlf = false;
	$map_style = '';

	// get field settings
	if ( isset($user_fields[$field_name]) )
	{
		$map_leg = $user_fields[$field_name]['leg'];
		$map_txt = $user_fields[$field_name]['txt'];
		$map_img = $user_fields[$field_name]['img'];
		$map_lnk = $user_fields[$field_name]['lnk'];
		$map_crlf = $user_fields[$field_name]['crlf'];
		$map_style = $user_fields[$field_name]['style'];
	}

	// get map settings
	if ( !empty($map_name) && isset($user_maps[$map_name]) )
	{
		$map_leg = $user_maps[$map_name]['fields'][$field_name]['leg'];
		$map_txt = $user_maps[$map_name]['fields'][$field_name]['txt'];
		$map_img = $user_maps[$map_name]['fields'][$field_name]['img'];
		$map_lnk = $user_maps[$map_name]['fields'][$field_name]['lnk'];
		$map_crlf = $user_maps[$map_name]['fields'][$field_name]['crlf'];
		$map_style = $user_maps[$map_name]['fields'][$field_name]['style'];
	}
	if ( !$map_leg && !$map_txt && !$map_img )
	{
		$map_txt = true;
	}
	if ( !empty($map_style) && isset($lang[$map_style]) )
	{
		$map_style = $lang[$map_style];
		$tables_used = array();
		$map_style = pcp_parse_def($map_style, $view_userdata, $tables_used);
	}
	if ( !$map_lnk || empty($lnk) )
	{
		$lnk = '%s';
	}
	else
	{
		$tables_used = array();
		$lnk = pcp_parse_def($lnk, $view_userdata, $tables_used);
	}

	$res = '';
	if ( $map_leg )
	{
		$res = mods_settings_get_lang($user_fields[$field_name]['lang_key']);
	}
	if ($map_leg && ($map_txt || $map_img))
	{
		if ( !empty($res) )
		{
			$res .= ':&nbsp;';
		}
	}
	if ( $map_img )
	{
		$res .= $map_lnk ? sprintf( $lnk, $img ) : $img;
	}
	if ( $map_img && $map_txt )
	{
		if ( !empty($txt) && !empty($img) )
		{
			$res .= ($map_crlf) ? '<br />' : '&nbsp;';
		}
	}
	if ( $map_txt )
	{
		$res .= $map_lnk ? sprintf( $lnk, $txt ) : $txt;
	}
	if ( !empty($map_style) && !empty($res) )
	{
		$res = sprintf($map_style, $res);
	}
	return $res;
}

//---------------------------------------------------------------------
//
//	function pcp_output() : prepare the output of a field
//
//---------------------------------------------------------------------
function pcp_output($field_name, &$view_userdata, $map_name='', $legend_only=false) {
	global $board_config, $phpbb_root_path, $phpEx, $lang, $images, $userdata;
	global $values_list, $tables_linked, $classes_fields, $user_maps, $user_fields;

	$res = '';

	// no field, exit
	if ( empty($field_name) ) return '';

	// fix user id
	$user_id = $userdata['user_id'];
	if ( !$userdata['session_logged_in'] )
	{
		$user_id = ANONYMOUS;
	}

	// values overwritten in maps
	if ( !empty($user_maps[$map_name]['fields'][$field_name]) )
	{
		@reset($user_maps[$map_name]['fields'][$field_name]);
		while ( list($field_def, $field_def_value) = @each($user_maps[$map_name]['fields'][$field_name]) )
		{
			$user_fields[$field_name][$field_def] = $field_def_value;
		}
	}

	// get field def
	$field_data = array();
	if ( isset($user_fields[$field_name]) )
	{
		$field_data = $user_fields[$field_name];
	}

	// default values
	if ( empty($field_data['lang_key']) )
	{
		$field_data['lang_key'] = ucfirst($field_name);
	}
	if ( empty($field_data['class']) )
	{
		$field_data['class'] = 'generic';
	}
	if ( empty($field_data['type']) )
	{
		$field_data['type'] = 'VARCHAR';
	}

	// legend only
	if ( $legend_only )
	{
		return mods_settings_get_lang( $field_data['lang_key'] );
	}

	// get class def
	$class_data = array();
	if ( isset($classes_fields[ $field_data['class'] ]) )
	{
		$class_data = $classes_fields[ $field_data['class'] ];
	}
	
	// check the data classes
	if($field_data['class'] == 'generic'){
		// this field has no special class defined so don't call the class check function; 
		// but sometimes override do exist! as all fields manually created have override poss.
		// don't mind the return value as this is not an allow field
		/* PCP Extra :: Altered
		display_field($field_data['input_id'], $field_data['input_id'],$view_userdata);*/
		display_field($field_name,$view_userdata); 
	} else {
		if ( !pcp_get_class_check($field_data['class'], $view_userdata) ) return '';
	}
	// process special display
	if ( !empty($field_data['dsp_func']) )
	{
		$func = $field_data['dsp_func'];
		$res = function_exists($func) ? $func($field_name, $view_userdata, $map_name) : $lang['PCP_err_field_dsp_func_unknown'];
	}
	else
	{
		// value
		$txt = '';
		$img = '';
		$lnk = $field_data['link'];
		$res = '';
		$constant_link = $field_data['lnk'] && !isset($view_userdata[$field_name]) && ( ($field_data['txt'] && !empty($field_data['title'])) || ($field_data['img'] && !empty($field_data['image'])) );
		if  ( $view_userdata['user_id'] != ANONYMOUS && ( !empty($view_userdata[$field_name]) || ($field_data['leg'] && !$field_data['txt'] && !$field_data['img']) || $constant_link ) )
		{
			$title = isset($field_data['title']) ? mods_settings_get_lang($field_data['title']) : $view_userdata[$field_name];
			$alt = mods_settings_get_lang($field_data['lang_key']);

			switch ($field_data['type'])
			{
				case 'DATE':
					$txt = !empty($view_userdata[$field_name]) ? create_date($lang['DATE_FORMAT'], $view_userdata[$field_name], $userdata['user_timezone']) : '';
					$img .= isset($images[$field_data['image']]) ? '<img src="' . $images[$field_data['image']] . '" border="0" alt="' . $alt . '" title="' . $title . '" />' : '';
					break;
				case 'DATETIME':
					$txt = !empty($view_userdata[$field_name]) ? create_date($userdata['user_dateformat'], $view_userdata[$field_name], $userdata['user_timezone']) : '';
					$img .= isset($images[$field_data['image']]) ? '<img src="' . $images[$field_data['image']] . '" border="0" alt="' . $alt . '" title="' . $title . '" />' : '';
					break;
				case 'BIRTHDAY':
					$pm_display = pcp_get_class_check('pm', $view_userdata);
					if ( !empty($view_userdata[$field_name]) )
					{
						$temp_url = $pm_display ? append_sid("./privmsg.$phpEx?mode=post&amp;" . POST_USERS_URL . '=' . $view_userdata['user_id']) : '';
						$txt = create_birthday_date($lang['DATE_FORMAT'], $view_userdata[$field_name], $userdata['user_timezone']);
						$img = ( ( intval(substr($view_userdata[$field_name], 4, 4)) == date('md', cal_date(time(),$board_config['board_timezone'])) ) ? ( $pm_display ? '<a href="' . $temp_url . '"><img src="' . $images['icon_birthday'] . '" border="0" align="absbottom" alt="' . $lang['Happy_birthday'] . '" title="' . $lang['Happy_birthday'] . '" /></a>' : '<img src="' . $images['icon_birthday'] . '" border="0" align="absbottom" alt="' . $lang['Happy_birthday'] . '" title="' . $lang['Happy_birthday'] . '" />' ) : '' );
					}
					break;
				default:
					$txt = $view_userdata[$field_name];
					if ( $field_data['lnk'] && !isset($view_userdata[$field_name]) )
					{
						$txt = $title;
					}
					$img .= isset($images[$field_data['image']]) ? '<img src="' . $images[$field_data['image']] . '" border="0" alt="' . $alt . '" title="' . $title . '" />' : '';
					break;
			}

			// res
			$res = pcp_output_format($field_name, $txt, $img, $map_name, $lnk, $view_userdata);
		}
	}

	return $res;
}

//---------------------------------------------------------------------
//
//	function pcp_output_panel() : dump an entire map to a field
//
//---------------------------------------------------------------------
function pcp_output_panel($map_name, &$view_userdata) {
	global $board_config, $phpbb_root_path, $phpEx, $lang, $images, $userdata;
	global $values_list, $tables_linked, $classes_fields, $user_maps, $user_fields;
	
	preProcessUserConfig($view_userdata);
	$res = '';
	@reset($user_maps[$map_name]['fields']);
	while ( list($field_name, $field_data) = @each($user_maps[$map_name]['fields']) )
	{
		$res .= pcp_output($field_name, $view_userdata, $map_name);
	}
	postProcessUserConfig($view_userdata);
	return $res;
}

//---------------------------------------------------------------------
//
//	function pcp_get_values_list() : get the values list and the default
//
//---------------------------------------------------------------------
function pcp_get_values_list($field_name, $field_data, $map_name='')
{
	// V: hardcode which should be cached... This is ugly, it should be in $field_data
	static $cache_fields = array(
		'user_style',
		'user_rank'
	);

	global $board_config, $phpbb_root_path, $phpEx, $lang, $images, $userdata, $db;
	global $values_list, $tables_linked, $classes_fields, $user_maps, $user_fields;

	$res = array();

	// get the list name
	$list_name = $field_data['values'];

	// check if exists
	if ( empty($list_name) || !isset($values_list[$list_name]) )
	{
		return $res;
	}

	// already resolved ?
	$done = ( !empty($values_list[$list_name]['done']) && $values_list[$list_name]['done'] );

	// function used
	if ( !$done && !empty($values_list[$list_name]['func']) )
	{
		$func = $values_list[$list_name]['func'];
		if ( function_exists($func) )
		{
			$values = $func();

			// transfert in values
			@reset($values);
			while ( list($key, $value) = @each($values) )
			{
				$values_list[$list_name]['values'][$key] = $value;
			}
			$values_list[$list_name]['done'] = true;
			$done = true;
		}
	}

	// table used
	if ( !$done && !empty($values_list[$list_name]['table']) && isset($tables_linked[ $values_list[$list_name]['table']['main'] ]) )
	{
		$w = array();
		$w = $values_list[$list_name]['table'];

		// list of fields
		$sql_fields = '[' . $w['main'] . '].*';
		if ( !empty($w['key']) )
		{
			$sql_fields .= ', (' . $w['key'] . ') AS _list_key';
		}
		if ( !empty($w['txt']) )
		{
			$sql_fields .= ', (' . $w['txt'] . ') AS _list_txt';
		}
		if ( !empty($w['img']) )
		{
			$sql_fields .= ', (' . $w['img'] . ') AS _list_img';
		}

		// tables
		$tables_used = array();

		// tables main
		$tables_used[ $w['main'] ] = true;
		$sql_tables = "(" . $tables_linked[ $w['main'] ]['sql_join'] . ")";
		$sql_where = empty($tables_linked[ $w['main'] ]['sql_where']) ? '' : ( empty($sql_where) ? '' : "\n AND") . ' (' . $tables_linked[ $w['main'] ]['sql_where'] . ')';
		$sql_order = empty($tables_linked[ $w['main'] ]['sql_order']) ? '' : ( empty($sql_order) ? '' : ', ') . $tables_linked[ $w['main'] ]['sql_order'];

		// parse the fields and the order statement
		$sql_fields = pcp_parse_def( $sql_fields, $userdata, $tables_used );
		$sql_order = pcp_parse_def( $sql_order, $userdata, $tables_used );

		$tables_processed = array();
		$tables_processed[] = $w['main'];
		$all_done = false;
		while ( !$all_done )
		{
			// add all the tables to the where and tables statements
			@ksort($tables_used);
			@reset($tables_used);
			while ( list($table_name, $used) = @each($tables_used) )
			{
				if ( !in_array($table_name, $tables_processed) )
				{
					$tables_processed[] = $table_name;
					$sql_tables = sprintf( "(%s\n" . $tables_linked[$table_name]['sql_join'] . ")", $sql_tables );
					$sql_where = empty($tables_linked[$table_name]['sql_where']) ? '' : ( empty($sql_where) ? '' : "\n AND") . ' (' . $tables_linked[$table_name]['sql_where'] . ')';
				}
			}

			// parse the tables and the where statement
			$sql_tables = pcp_parse_def( $sql_tables, $userdata, $new_tables_used );
			$sql_where = pcp_parse_def( $sql_where, $userdata, $new_tables_used );

			// check if any unprocessed table remains
			$all_done = true;
			@reset($tables_used);
			while ( list($table_name, $used) = @each($tables_used) )
			{
				$all_done = in_array($table_name, $tables_processed);
				if ( !$all_done )
				{
					break;
				}
			}
		}

		// build the sql request
		if ( !empty($sql_tables) )
		{
			$sql = "SELECT $sql_fields \n FROM $sql_tables";
			if ( !empty($sql_where) )
			{
				$sql .= "\n WHERE $sql_where";
			}
			if ( !empty($sql_order) )
			{
				$sql .= "\n ORDER BY $sql_order";
			}
			// V: this should be in $field_data
			$cache_key = in_array($field_name, $cache_fields) ? "pcp_cache_$field_name" : null;
			if ( !($result = $db->sql_query($sql, false, $cache_key)) )
			{
				message_die(GENERAL_ERROR, 'Could not read list informations', '', __LINE__, __FILE__, '<table><tr><td><span class="genmed"><pre>' . $sql . '</pre></span></td></tr></table>');
			}
			$values = array();
			while ( $row = $db->sql_fetchrow($result) )
			{
				$values[ $row['_list_key'] ] = array( 'txt' => $row['_list_txt'], 'img' => $row['_list_img'] );
			}
			$db->sql_freeresult($result);

			// transfert in values
			@reset($values);
			while ( list($key, $value) = @each($values) )
			{
				$values_list[$list_name]['values'][$key] = $value;
			}
			$values_list[$list_name]['done'] = true;
			$done = true;
		}
	}

	// force txt if nothing ask for display
	if ( !$field_data['txt'] && !$field_data['img'] )
	{
		$field_data['txt'] = true;
	}

	@reset($values_list[$list_name]['values']);
	while ( list( $key, $value_data) = @each($values_list[$list_name]['values']) )
	{
		$txt = '';
		$img = '';
		if ( $field_data['txt'] )
		{
			$txt = isset($lang[ $value_data['txt'] ]) ? $lang[ $value_data['txt'] ] : $value_data['txt'];
		}
		if ( $field_data['img'] )
		{
			$img = isset($images[ $value_data['img'] ]) ? $images[ $value_data['img'] ] : $value_data['img'];
		}

		$value = !empty($img) ? '<img src"' . $img . '" border="0" alt="' . $txt . '" title="' . $txt . '" />' : '';
		$value .= ( !empty($img) && !empty($txt) ) ? '&nbsp;' : '';
		$value .= $txt;
		if ( !empty($value) )
		{
			$res[$value] = $key;
		}
	}
	return $res;
}

//---------------------------------------------------------------------
//
//	function pcp_get_field() : get the field definition
//
//---------------------------------------------------------------------
function pcp_get_field( $field_cfg, $map_name='', $field_name='' )
{
	global $values_list, $tables_linked, $classes_fields, $user_maps, $user_fields;

	$res = array();
	$found = false;
	if ( empty($field_name) )
	{
		@reset($user_fields);
		while ( list($field_name, $field_data) = @each($user_fields) )
		{
			$found = ($field_data[$field_name]['input_id'] == $field_cfg);
			if ( $found )
			{
				break;
			}
		}
		if ( !$found )
		{
			$field_name = $field_cfg;
		}
	}

	// get the field definition
	$field_data = $user_fields[$field_name];

	// overwrite by the map definition
	@reset($user_maps[$map_name]['fields'][$field_name]);
	while ( list($key, $value) = @each($user_maps[$map_name]['fields'][$field_name]) )
	{
		$field_data[$key] = $value;
	}

	// parse the default value
	if ( !empty($field_data['default']) || ($field_data['default'] == "0") )
	{
		$tables_used = array();
		$field_data['default'] = pcp_parse_def($field_data['default'], $userdata, $tables_used);
	}

	// solve values list
	if ( !empty($field_data['values']) && is_string($field_data['values']) )
	{
		// if list drop force the img/txt set
		if ( ($field_data['get_mode'] == 'LIST_DROP') && $field_data['img'] )
		{
			$field_data['img'] = false;
			$field_data['txt'] = true;
		}
		$field_data['values'] = pcp_get_values_list($field_name, $field_data, $map_name);
		if ( empty($field_data['values']) )
		{
			$field_data['default'] = '';
		}
		else
		{
			// check if the default value is in the values list
			@reset($field_data['values']);
			$found = false;
			while ( list($value, $key) = @each($field_data['values']) )
			{
				$found = ( $field_data['default'] == $key );
				if ( $found )
				{
					break;
				}
			}
			if ( !$found )
			{
				$first_key = '';
				@reset($field_data['values']);
				list($first_value, $first_key) = @each($field_data['values']);
				$field_data['default'] = $first_key;
			}
		}
	}

	// get back values
	$res = $field_data;

	// fill the necessary entries for mods_settings
	$res['user'] = $field_name;
	if ( !empty($res['get_mode']) )
	{
		$res['type'] = $res['get_mode'];
	}
	else if ( !empty($res['get_func']) || !empty($res['chk_func']) )
	{
		$res['type'] = '';
	}
	return $res;
}

//---------------------------------------------------------------------
//
//	function pcp_get_mods_setting_menu() : get the menu values for the mods settings
//
//---------------------------------------------------------------------
function pcp_get_mods_setting_menu( $menu_id, $map_name='' )
{
	global $values_list, $tables_linked, $classes_fields, $user_maps, $user_fields;

	$res = array();
	if ( !empty($map_name) && isset($user_maps[$map_name]) )
	{
		$res = $user_maps[$map_name][$menu_id];
	}

	return $res;
}

//---------------------------------------------------------------------
//
//	function pcp_get_mods_setting_config_fields() : get the field definition from a map
//
//---------------------------------------------------------------------
function pcp_get_mods_setting_config_fields( $map_name='' )
{
	global $values_list, $tables_linked, $classes_fields, $user_maps, $user_fields;

	$res = array();
	if ( isset($user_maps[$map_name]) )
	{
		@reset($user_maps[$map_name]['fields']);
		while ( list($field_name, $field_data) = @each($user_maps[$map_name]['fields']) )
		{
			$field_cfg = $field_data['input_id'];
			if ( empty($field_cfg) )
			{
				$field_cfg = $field_name;
			}
			$res[$field_cfg] = pcp_get_field($field_cfg, $map_name, $field_name);
		}
	}

	return $res;
}

// PCP Extra :: Replaced the full function
// function added by edwin for fixing override problem...
function display_field($userfield, &$viewdata){ 
    global $board_config, $userdata, $user_fields; 
     
    /*     You cannot unscrable scrambled eggs... So re-write the logic! 
            edwin's logic: 
            If override 
                yes:     if value 0 ==> hide 
                            if value 1 ==> Show 
                            if value 2 ==> Show Buddy, hide Ignore 
                            + override the view_user value 
                                    ==> this is for all non allow fields 
                                            when a generic field is created the value in config is not 0,1 or 2 
                                            but the exact needed value. 
                                            Ex: if username=dumbo && override=yes 
                                                    then set dumbo as view_userdata['username'] 
                No:        User value? 
                            0 ==> hide 
                            1 ==> show 
                            2 ==> Show buddy, hide Ignore 
            Special cases 
                1) guest user logged in ==> hide 
                2) user viewing guest user ==> hide 
                3) admin viewing user ==> show + override the view_user value 
    */ 
     
    // tha vals 
    $config_value = $board_config[$userfield]; 
    $override = $board_config[$userfield.'_over']; 
    $user_value = $viewdata[$userfield]; 
    $display = false; 
    // let's go! 
    // special cases 
    if ($userdata['user_id'] == ANONYMOUS) { 
        // guest user logged in ==> hide 
        $display = false; 
    } else if ($viewdata['viewed_by_admin']) { 
        // 3) show + override the view_user value 
        $display = true; 
        if($override){ 
            $viewdata[$userfield] = $config_value; 
        } 
    } else { 
        // start edwin's logic: 
        if ($override){ 
            $real_value = $config_value; 
            // override the value of view_userdata 
            $viewdata[$userfield] = $config_value; 
        } else { 
            $real_value = $user_value; 
        } 
        switch ($real_value){ 
            case YES: 
                // show 
                $display = true; 
                break; 
            case FRIEND_ONLY: 
                // show buddy, hide Ignore 
                // if page calls the pcp_get_class_check() directly for valmidating a class 
                //         the getBuddyStatus() hasn't been called 
                //    ==> call it otherwise this returns false! 
                if(!isset($viewdata['user_ignore']) || !isset($viewdata['user_friend'])){ 
                    getBuddyStatus($viewdata); 
                } 
                if ($viewdata['user_ignore']){ 
                    $display = false; 
                } else if ($viewdata['user_friend']){ 
                    $display = true; 
                } else { 
                    $display = false; 
                } 
                break; 
            default: 
                // means NO, 0 or NULL ==> non allow field is NULL 
                // hide 
                $display = false; 
                break; 
        } 
    } 
    // yes, yes, yes... we know it now so no good of keeping thus return it... 
    return $display; 
}

function preProcessUserConfig(&$viewdata){
	global $userdata;
	// stuff to do before user buttons are send to the template
	// set the admin for use inside my functions...
	$viewdata['viewed_by_admin'] = is_admin($userdata);
	// set online
	$viewdata['user_online'] = ( $viewdata['user_session_time'] >= (time()-300) );
	// correct pm
	$viewdata['user_pm'] = pcp_get_class_check('pm', $viewdata);
	// get buddy status
	getBuddyStatus($viewdata);
}

function postProcessUserConfig(&$viewdata){
	// stuff to do after user buttons are send to the template
	global $userdata;
	// sig :: hide when user do not want to see it...
	if (!$userdata['user_viewsig'] || !$viewdata['user_allowsignature'])
	{
		$viewdata['user_sig'] = '';
	}
}

function getBuddyStatus(&$viewdata){
	static $buddy_cache = array();
	global $db, $userdata;
	
	$id = $userdata['user_id'];
	$viewid =  $viewdata['user_id'];
	if($id == $viewid){
		// you are always buddy of yourself!
		$viewdata['user_friend'] = 1;
		$viewdata['user_ignore'] = 0;
		$viewdata['user_visible'] = 1;
	} else {
		$cache_key = $id . "-" . $viewid;
		if (isset($buddy_cache[$cache_key]))
		{
			$buddy_data = $buddy_cache[$cache_key];
		}
		else
		{
			$sql = "SELECT * FROM " . BUDDYS_TABLE . " 
					WHERE (user_id=$id AND buddy_id=$viewid) OR (user_id=$viewid AND buddy_id=$id)";
			if ( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not get buddy information', '', __LINE__, __FILE__, $sql);	
			}
			$buddy_data = $buddy_cache[$cache_key] = $db->sql_fetchrowset($result);
		}
		foreach ($buddy_data as $row)
		{
			if ( $row['user_id'] != $viewid )
			{
				$viewdata['user_my_friend'] = !$row['buddy_ignore'];
				$viewdata['user_my_ignore'] = $row['buddy_ignore'];
				$viewdata['user_my_visible'] = $row['buddy_visible'];
			}
			else
			{
				if($viewdata['viewed_by_admin']){
					// admin is always the friend of the user being viewed
					$viewdata['user_friend'] = 1;
					$viewdata['user_ignore'] = 0;
					$viewdata['user_visible'] = 1;
				} else {
					$viewdata['user_friend'] = !$row['buddy_ignore'];
					$viewdata['user_ignore'] = $row['buddy_ignore'];
					$viewdata['user_visible'] = $row['buddy_visible'];
				}
			}
		}
	}
}

?>
