<?php

/***************************************************************************
 *							functions_admin_pcp.php
 *							-----------------------
 *	begin				: 11/10/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: v 1.0.3 - 24/10/2003
 *
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
	exit;
}

// list of type available
$type_list = array( 'ADVANCED', 'DATE', 'DATETIME', 'BIRTHDAY', 'TINYINT', 'SMALLINT', 'MEDIUMINT', 'INT', 'VARCHAR', 'TEXT' );
$sql_type_list = array( 'TINYINT', 'SMALLINT', 'MEDIUMINT', 'INT', 'DECIMAL', 'VARCHAR', 'TEXT' );

// list of get modes
$get_mode_list = array('LIST_RADIO', 'LIST_DROP', 'TINYINT', 'SMALLINT', 'MEDIUMINT', 'INT', 'VARCHAR', 'TEXT', 'HTMLVARCHAR', 'HTMLTEXT' );

// list of auth
/* PCP Extra :: Altered
$auth_list = array( USER => 'USER', ADMIN => 'ADMIN', BOARD_ADMIN => 'BOARD_ADMIN');*/
$auth_list = array( USER => 'USER', ADMIN => 'ADMIN', BOARD_ADMIN => 'BOARD_ADMIN', GUEST_ONLY => 'GUEST_ONLY');

// dsp types
$types_list = array(
	'BOOLEAN' => array(
		'dsp_func'	=> 'pcp_output_boolean',
		'get_func'	=> 'pcp_input_boolean',
		'align'		=> 'center',
	),
	'FIELDNAME' => array(
		'get_func'	=> 'pcp_input_fieldname',
	),
	'LANG_KEY' => array(
		'dsp_func'	=> 'pcp_output_lang',
		'get_func'	=> 'pcp_input_lang',
	),
	'LIST_CLASS' => array(
		'get_func'	=> 'pcp_input_class',
	),
	'LIST_TYPE'	=> array(
		'get_func'	=> 'pcp_input_type',
	),
	'LIST_GET_MODE' => array(
		'get_func'	=> 'pcp_input_get_mode',
	),
	'LIST_VALUES' => array(
		'get_func'	=> 'pcp_input_values',
	),
	'LIST_AUTH' => array(
		'get_func'	=> 'pcp_input_auth',
	),
	'TEXTHTML'	=> array(
		'get_func'	=> 'pcp_input_text',
	),
	'INTEGER' => array(
		'get_func'	=> 'pcp_input_integer',
	),
	'SQL_DEF' => array(
		'get_func'	=> 'pcp_input_sql_def',
	),
);

// component of a field
$field_cat = array(
	'definition'	=> 'PCP_field_definition_part',
	'output'		=> 'PCP_field_output_part',
	'input'			=> 'PCP_field_input_part',
	'buddylist'		=> 'PCP_field_buddylist_part',
);
$field_def = array(
	// generic
	'field_name' => array(
		'lang_key'	=> 'PCP_field_name',
		'explain'	=> 'PCP_field_name_explain',
		'short'		=> 'PCP_field_name_short',
		'type'		=> 'FIELDNAME',
		'cat'		=> 'definition',
	),
	'lang_key' => array(
		'lang_key'	=> 'PCP_field_lang_key',
		'explain'	=> 'PCP_field_lang_key_explain',
		'short'		=> 'PCP_field_lang_key_short',
		'type'		=> 'LANG_KEY',
		'cat'		=> 'definition',
	),
	'explain' => array(
		'lang_key'	=> 'PCP_field_explain',
		'explain'	=> 'PCP_field_explain_explain',
		'type'		=> 'LANG_KEY',
		'cat'		=> 'definition',
	),
	'image' => array(
		'lang_key'	=> 'PCP_field_image',
		'explain'	=> 'PCP_field_image_explain',
		'cat'		=> 'definition',
	),
	'title' => array(
		'lang_key'	=> 'PCP_field_title',
		'explain'	=> 'PCP_field_title_explain',
		'type'		=> 'LANG_KEY',
		'cat'		=> 'definition',
	),

	// dsp part
	'class' => array(
		'lang_key'	=> 'PCP_field_class',
		'explain'	=> 'PCP_field_class_explain',
		'type'		=> 'LIST_CLASS',
		'cat'		=> 'output',
	),
	'type' => array(
		'lang_key'	=> 'PCP_field_type',
		'explain'	=> 'PCP_field_type_explain',
		'type'		=> 'LIST_TYPE',
		'cat'		=> 'output',
	),
	'link' => array(
		'lang_key'	=> 'PCP_field_link',
		'explain'	=> 'PCP_field_link_explain',
		'type'		=> 'TEXTHTML',
		'cat'		=> 'output',
	),
	'dsp_func' => array(
		'lang_key'	=> 'PCP_field_dsp_func',
		'explain'	=> 'PCP_field_dsp_func_explain',
		'cat'		=> 'output',
	),
	'leg' => array(
		'lang_key'	=> 'PCP_field_leg',
		'explain'	=> 'PCP_field_leg_explain',
		'short'		=> 'PCP_field_leg_short',
		'type'		=> 'BOOLEAN',
		'cat'		=> 'output',
	),
	'txt' => array(
		'lang_key'	=> 'PCP_field_txt',
		'explain'	=> 'PCP_field_txt_explain',
		'short'		=> 'PCP_field_txt_short',
		'type'		=> 'BOOLEAN',
		'cat'		=> 'output',
	),
	'img' => array(
		'lang_key'	=> 'PCP_field_img',
		'explain'	=> 'PCP_field_img_explain',
		'short'		=> 'PCP_field_img_short',
		'type'		=> 'BOOLEAN',
		'cat'		=> 'output',
	),
	'crlf' => array(
		'lang_key'	=> 'PCP_field_crlf',
		'explain'	=> 'PCP_field_crlf_explain',
		'type'		=> 'BOOLEAN',
		'cat'		=> 'output',
	),
	'lnk' => array(
		'lang_key'	=> 'PCP_field_use_link',
		'explain'	=> 'PCP_field_use_link_explain',
		'short'		=> 'PCP_field_use_link_short',
		'type'		=> 'BOOLEAN',
		'cat'		=> 'output',
	),
	'style' => array(
		'lang_key'	=> 'PCP_field_style',
		'explain'	=> 'PCP_field_style_explain',
		'type'		=> 'TEXTHTML',
		'cat'		=> 'output',
	),

	// input part
	/* PCP Extra :: Removed
	'input_id' => array(
		'lang_key'	=> 'PCP_field_input_id',
		'explain'	=> 'PCP_field_input_id_explain',
		'cat'		=> 'input',
	),*/
	'user_only' => array(
		'lang_key'	=> 'PCP_field_user_only',
		'explain'	=> 'PCP_field_user_only_explain',
		'type'		=> 'BOOLEAN',
		'cat'		=> 'input',
	),
	'system' => array(
		'lang_key'	=> 'PCP_field_system',
		'explain'	=> 'PCP_field_system_explain',
		'type'		=> 'BOOLEAN',
		'cat'		=> 'input',
	),
	// PCP Extra :: Start Add
	'required' => array(
		'lang_key'	=> 'PCP_field_required',
		'explain'	=> 'PCP_field_required_explain',
		'type'		=> 'BOOLEAN',
		'cat'		=> 'input',
	),
	'visibility' => array(
		'lang_key'	=> 'PCP_field_visibility',
		'explain'	=> 'PCP_field_visibility_explain',
		'type'		=> 'BOOLEAN',
		'cat'		=> 'input',
	),
	// PCP Extra :: End Add
	'get_mode' => array(
		'lang_key'	=> 'PCP_field_get_mode',
		'explain'	=> 'PCP_field_get_mode_explain',
		'type'		=> 'LIST_GET_MODE',
		'cat'		=> 'input',
	),
	'get_func' => array(
		'lang_key'	=> 'PCP_field_get_func',
		'explain'	=> 'PCP_field_get_func_explain',
		'cat'		=> 'input',
	),
	'chk_func' => array(
		'lang_key'	=> 'PCP_field_chk_func',
		'explain'	=> 'PCP_field_chk_func_explain',
		'cat'		=> 'input',
	),
	'default' => array(
		'lang_key'	=> 'PCP_field_default',
		'explain'	=> 'PCP_field_default_explain',
		'cat'		=> 'input',
	),
	'values' => array(
		'lang_key'	=> 'PCP_field_values_list',
		'explain'	=> 'PCP_field_values_list_explain',
		'type'		=> 'LIST_VALUES',
		'cat'		=> 'input',
	),
	// PCP Extra :: Add
	'inputstyle' => array(
		'lang_key'	=> 'PCP_field_inputstyle',
		'explain'	=> 'PCP_field_inputstyle_explain',
		'cat'		=> 'input',
	), // PCP Extra :: End
	'auth' => array(
		'lang_key'	=> 'PCP_field_auth',
		'explain'	=> 'PCP_field_auth_explain',
		'type'		=> 'LIST_AUTH',
		'cat'		=> 'input',
	),

	// buddy/memberlist part
	'ind' => array(
		'lang_key'	=> 'PCP_field_ind',
		'explain'	=> 'PCP_field_ind_explain',
		'type'		=> 'INTEGER',
		'cat'		=> 'buddylist',
	),
	'dft' => array(
		'lang_key'	=> 'PCP_field_dft',
		'explain'	=> 'PCP_field_dft_explain',
		'type'		=> 'BOOLEAN',
		'cat'		=> 'buddylist',
	),
	'rqd' => array(
		'lang_key'	=> 'PCP_field_rqd',
		'explain'	=> 'PCP_field_rqd_explain',
		'type'		=> 'BOOLEAN',
		'cat'		=> 'buddylist',
	),
	'hidden' => array(
		'lang_key'	=> 'PCP_field_hidden',
		'explain'	=> 'PCP_field_hidden_explain',
		'type'		=> 'BOOLEAN',
		'cat'		=> 'buddylist',
	),
	'sql_def' => array(
		'lang_key'	=> 'PCP_field_sql_def',
		'explain'	=> 'PCP_field_sql_def_explain',
		'type'		=> 'SQL_DEF',
		'cat'		=> 'buddylist',
	),
);
//---------------------------------
//
//	build some output
//
//---------------------------------
// boolean
function pcp_output_boolean($value)
{
	global $lang;
	$res = $value ? $lang['Yes'] : '';
	return $res;
}
function pcp_input_boolean($name, $value)
{
	global $lang;
	$res = '';
	$checked = ($value == 1) ? ' checked="checked"' : '';
	$res .= '<input type="radio" name="' . $name . '" value="1" ' . $checked . ' />' . $lang['Yes'] . '&nbsp;';
	$checked = ($value != 1) ? ' checked="checked"' : '';
	$res .= '<input type="radio" name="' . $name . '" value="0" ' . $checked . ' />' . $lang['No'];

	return $res;
}
// field name
function pcp_input_fieldname($name, $value)
{
	global $user_fields, $lang;

	$opt = '<option value="" ' . ($value ? '' : 'selected="selected"') . '>' . $lang['PCP_userfields_field_pick_up'] . '</option>';
	$fields = $user_fields;
	@ksort($fields);
	foreach ($fields as $field_name => $field_data)
	{
		$opt .= "\n" . '<option value="' . $field_name . '" ' . ($value == $field_name ? 'selected="selected"' : '') . '>' . $field_name . '</option>';
	}
	$res = '<select name="' . $name . '_pickup_list" onChange="javascript:' . $name . '.value=this.options[this.selectedIndex].value; this.selectedIndex=0;">' . $opt . '</select>';
	$res .= '<br /><input type="text" name="' . $name .'" value="' . $value .'" size="60" />';
	return $res;
}
// lang key
function pcp_output_lang($value)
{
	global $lang;
	$opt = '<option value="" selected="selected">' . ( isset($lang['PCP_field_pick_up']) ? $lang['PCP_field_pick_up'] : 'Pick up') . '</option>';

	$res = pcp_format_lang($value, true);
	return $res;
}
// lang key
function pcp_input_lang($name, $value)
{
	static $normal_lang;
	global $board_config, $userdata, $phpbb_root_path, $phpEx;
	global $lang;

	if ( empty($normal_lang) )
	{
		// save current keys
		$sav_lang = $lang;

		// get not admin keys
		$lang_choosen = $board_config['default_lang'];
		include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_main.' . $phpEx);

		$lang_extend_admin = false;

		// get the english settings
		if ( ($board_config['default_lang'] != 'english') )
		{
			$dir = @opendir($phpbb_root_path . 'language/lang_english');
			while( $file = @readdir($dir) )
			{
				if( preg_match("/^lang_extend_.*?\." . $phpEx . "$/", $file) )
				{
					include_once($phpbb_root_path . 'language/lang_english/' . $file);
				}
			}
			// include the personalisations
			@include_once($phpbb_root_path . 'language/lang_english/lang_extend.' . $phpEx);
			@closedir($dir);
		}

		// get the user settings
		if ( !empty($board_config['default_lang']) )
		{
			$dir = @opendir($phpbb_root_path . 'language/lang_' . $board_config['default_lang']);
			while( $file = @readdir($dir) )
			{
				if( preg_match("/^lang_extend_.*?\." . $phpEx . "$/", $file) )
				{
					include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/' . $file);
				}
			}
			// include the personalisations
			@include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_extend.' . $phpEx);
			@closedir($dir);
		}

		// save this
		$normal_lang = $lang;

		// restore current lang keys
		$lang = $sav_lang;
	}

	@ksort($normal_lang);

	// process a list
	$opt = '<option value="" ' . ($value ? '' : 'selected="selected"') . '>' . $lang['PCP_userfields_lang_key_pick_up'] . '</option>';
	foreach ($normal_lang as $field_name => $field_data)
	{
		$opt .= "\n" . '<option value="' . $field_name . '" ' . ($value === $field_name ? 'selected="selected"' : '') . '>' . $field_name . '</option>';
	}
	$res = '<select name="' . $name . '_pickup_list" onChange="javascript:' . $name . '.value=this.options[this.selectedIndex].value; this.selectedIndex=0;">' . $opt . '</select>';

	// add the input field
	$res .= '<br /><input type="text" name="' . $name .'" value="' . $value .'" size="60" />';
	return $res;
}
// class list
function pcp_input_class($name, $value)
{
	global $classes_fields, $lang;

	if ( empty($value) )
	{
		$value = 'generic';
	}

	$res = '<select name="' . $name . '">';
	foreach ($classes_fields as $class_name => $class_data)
	{
		$selected = ($class_name === $value) ? ' selected="selected"' : '';
		$res .= '<option value="' . $class_name . '"' . $selected . '>' . pcp_format_lang($class_name) . '</option>';
	}
	$res .= '</select>';
	return $res;
}
// type list
function pcp_input_type($name, $value)
{
	global $type_list, $lang;

	if ( empty($value) )
	{
		$value = 'VARCHAR';
	}

	$res = '<select name="' . $name . '">';
	for ( $i = 0; $i < count($type_list); $i++ )
	{
		$selected = ( $value == $type_list[$i] ) ? ' selected="selected"' : '';
		$res .= '<option value="' . $type_list[$i] . '"' . $selected . '>' . pcp_format_lang($type_list[$i]) . '</option>';
	}
	$res .= '</select>';
	return $res;
}
// get mode list
function pcp_input_get_mode($name, $value)
{
	global $get_mode_list, $lang;

	$res = '<select name="' . $name . '">';
	$selected = empty($value) ? ' selected="selected"' : '';
	$res .= '<option value=""' . $selected . '>' . $lang['None'] . '</option>';
	for ( $i = 0; $i < count($get_mode_list); $i++ )
	{
		$selected = ( $value == $get_mode_list[$i] ) ? ' selected="selected"' : '';
		$res .= '<option value="' . $get_mode_list[$i] . '"' . $selected . '>' . pcp_format_lang($get_mode_list[$i]) . '</option>';
	}
	$res .= '</select>';
	return $res;
}
// value list
function pcp_input_values($name, $value)
{
	global $values_list, $lang;

	$res = '<select name="' . $name . '">';
	$selected = empty($value) ? ' selected="selected"' : '';
	$res .= '<option value=""' . $selected . '>' . $lang['None'] . '</option>';
	foreach ($values_list as $values_list_name => $values_list_data)
	{
		$selected = ( $values_list_name == $value ) ? ' selected="selected"' : '';
		$res .= '<option value="' . $values_list_name . '"' . $selected . '>' . pcp_format_lang($values_list_name) . '</option>';
	}
	$res .= '</select>';
	return $res;
}
// auth list
function pcp_input_auth($name, $value)
{
	global $auth_list, $lang;

	if ( empty($value) )
	{
		$value = USER;
	}
	$res = '';
	foreach ($auth_list as $auth_level => $auth_name)
	{
		$checked = ($value == $auth_level) ? ' checked="checked"' : '';
		$res .= ( empty($res) ? '' : '<br />' ) . '&nbsp;';
		$res .= '<input type="radio" name="' . $name . '" value="' . $auth_level . '"' . $checked . ' />' . pcp_format_lang('Auth_' . $auth_name);
	}
	return $res;
}
// varchar
function pcp_input_varchar($name, $value)
{
	$res = '<input type="text" name="' . $name .'" value="' . $value .'" size="60" />';
	return $res;
}
// text
function pcp_input_text($name, $value)
{
	$res = '<textarea rows="5" cols="60" wrap="virtual" name="' . $name . '" class="post">' . $value . '</textarea>';
	return $res;
}
// integer
function pcp_input_integer($name, $value)
{
	$val = intval($value);
	$length = strlen("$val") + 2;
	$res = '<input type="text" name="' . $name .'" value="' . $value .'" size="' . $length . '" />';
	return $res;
}
// sql def
function pcp_input_sql_def($name, $value)
{
	global $template, $lang, $board_config, $userdata;
	global $tables_linked;
	
	// save template state
	$sav_tpl = $template->_tpldata;

	// template
	$template->set_filenames(array(
		'output' => 'admin/pcp_userfields_edit_sqldef_body.tpl')
	);

	// header
	$template->assign_vars(array(
		'L_SYSTEM_VALUES'	=> $lang['PCP_system_values'],
		'L_TABLES_LINKED'	=> $lang['PCP_tableslinked'],
		'L_CFG_VALUES'		=> $lang['PCP_config_values'],
		'L_VIEWED_USER'		=> $lang['PCP_view_user_values'],
		'L_ACTING_USER'		=> $lang['PCP_user_values'],
		)
	);

	// list of tables
	$s_tables_opt = '<option value="" selected="selected">' . $lang['None'] . '</option>';
	foreach ($tables_linked as $table_name => $table_data)
	{
		$s_tables_opt .= '<option value="[' . $table_name . ']">[' . $table_name . ']</option>';
	}

	// list of config values
	@ksort($board_config);
	$s_cfg_values_opt = '<option value="" selected="selected">' . $lang['None'] . '</option>';
	$s_cfg_values_opt .= '<option value="[time]">[time]</option>';
	foreach ($board_config as $config_name => $config_data)
	{
		$s_cfg_values_opt .= '<option value="[board.' . $config_name . ']">[board.' . $config_name . ']</option>';
	}

	// list of users viewed/acting
	@ksort($userdata);
	$s_viewed_user = '<option value="" selected="selected">' . $lang['None'] . '</option>';
	$s_acting_user = '<option value="" selected="selected">' . $lang['None'] . '</option>';
	foreach ($userdata as $field_name => $field_value)
	{
		$n_name = intval($field_name);
		if ($field_name != "$n_name")
		{
			$s_viewed_user .= '<option value="[view.' . $field_name . ']">[view.' . $field_name . ']</option>';
			$s_acting_user .= '<option value="[user.' . $field_name . ']">[user.' . $field_name . ']</option>';
		}
	}

	// values
	$template->assign_vars(array(
		'NAME'			=> $name,
		'VALUE'			=> $value,

		'S_TABLES_OPT'	=> $s_tables_opt,
		'S_CFG_VALUES'	=> $s_cfg_values_opt,
		'S_VIEWED_USER'	=> $s_viewed_user,
		'S_ACTING_USER'	=> $s_acting_user,
		)
	);

	// transfert to a var
	$template->assign_var_from_handle('output', 'output');
	$res = $template->_tpldata['.'][0]['output'];

	// restore template saved state
	$template->_tpldata = $sav_tpl;

	return $res;
}

// central
function pcp_format_output($type, $value, $style='')
{
	global $types_list;

	if ( !empty($type) && isset($types_list[$type]) && !empty($types_list[$type]['dsp_func']) )
	{
		$func = $types_list[$type]['dsp_func'];
		$res = $func($value);
	}
	else
	{
		if (substr($value, 0, 4) == '[lf]')
		{
			$value = '[lf]';
		}
		if ($value == '%s')
		{
			$value = '';
		}
		$res = $value;
	}
	if ( !empty($style) )
	{
		$res = sprintf( $style, $res );
	}
	return $res;
}

function pcp_format_input($type, $name, $value, $style='', $protected=false)
{
	global $types_list;

	if ($protected)
	{
		$res = pcp_format_output($type, $value, $style);
	}
	else
	{
		if ( !empty($type) && isset($types_list[$type]) && !empty($types_list[$type]['get_func']) )
		{
			$func = $types_list[$type]['get_func'];
			$res = $func($name, $value);
		}
		else
		{
			if (substr($value, 0, 4) == '[lf]')
			{
				$value = '[lf]';
			}
			if ($value == '%s')
			{
				$value = '';
			}
			$func = 'pcp_input_varchar';
			$res = $func( $name, $value );
		}
		if ( !empty($style) )
		{
			$res = sprintf( $style, $res );
		}
	}
	return $res;
}

//---------------------------------
//
//	reverse htmlspecialchars() (coming from php.net)
//
//---------------------------------
function htmldecode($encoded)
{
	return strtr(stripslashes($encoded), array_flip(get_html_translation_table(HTML_ENTITIES)) ); 
}
//---------------------------------
//
//	format lang output
//
//---------------------------------
function pcp_format_lang($key, $plain=false)
{
	global $lang;
	$res = $key;
	if ( isset($lang[$key]) )
	{
		$res = ( $plain ? '(' . $key . ')&nbsp;' : '' ) . $lang[$key];
	}
	return $res;
}

//---------------------------------
//
//	format image output
//
//---------------------------------
function pcp_format_image($key, $plain=false)
{
	global $images;
	$res = '';
	if ( !empty($key) )
	{
		$res = $plain ? $key : '';
		if ( @file_exists('./../' . $key) )
		{
			$res = '<img src="' . './../' . $key . '" border="0" title="' . $key . '" alt="' . $key . '" />';
		}
		if ( isset($images[$key]) )
		{
			$res = '<img src="' . './../' . $images[$key] . '" border="0" title="' . $key . '" alt="' . $key . '" />';
		}
	}
	return $res;
}

//---------------------------------
//
//	output the user arrays to file
//
//---------------------------------
function pcp_output_fields($values_list, $tables_linked, $classes_fields, $user_maps, $user_fields)
{
	global $phpbb_root_path, $phpEx, $template, $userdata;
	global $field_def;
	global $auth_list;

	// save template state
	$sav_tpl = $template->_tpldata;

	// template
	$template->set_filenames(array(
		'output' => 'admin/pcp_userfields_def.tpl')
	);

	// main
	$template->assign_vars(array(
		'TIME'		=> date( 'Y-m-d H:i:s', time() ),
		'USERNAME'	=> $userdata['username'],
		)
	);

	// tables linked
	foreach ($tables_linked as $table_name => $table_data)
	{
		// name
		$template->assign_block_vars('tables', array(
			'NAME'		=> str_replace( "''", "\'", $table_name),
			)
		);

		// rows
		foreach ($table_data as $key => $value)
		{
			$template->assign_block_vars('tables.row', array(
				'KEY'	=> str_replace( "''", "\'", $key),
				'VALUE'	=> str_replace( "''", "\'", $value),
				)
			);
		}
	}

	// values_list
	foreach ($values_list as $value_name => $value_data)
	{
		// name, func and table def.
		$template->assign_block_vars('values', array(
			'NAME'	=> str_replace( "''", "\'", $value_name),
			'FUNC'	=> isset($value_data['func']) ? str_replace( "''", "\'", $value_data['func']) : '',
			'MAIN'	=> isset($value_data['table']['main']) ? str_replace( "''", "\'", $value_data['table']['main']) : '',
			'KEY'	=> isset($value_data['table']['key']) ? str_replace( "''", "\'", $value_data['table']['key']) : '',
			'TXT'	=> isset($value_data['table']['txt']) ? str_replace( "''", "\'", $value_data['table']['txt']) : '',
			'IMG'	=> isset($value_data['table']['img']) ? str_replace( "''", "\'", $value_data['table']['img']) : '',
			)
		);
		// determines which kind of list it is
		if ( !empty($value_data['func']) )
		{
			$template->assign_block_vars('values.func', array());
		}
		if ( !empty($value_data['table']['main']) )
		{
			$template->assign_block_vars('values.table', array());
		}
		if ( !empty($value_data['values']) )
		{
			$template->assign_block_vars('values.set', array());
			foreach ($value_data['values'] as $value_item => $value_item_data)
			{
				if ( is_string($value_item) || ( empty($value_item) && ($value_item != "0") ) )
				{
					$value_item = sprintf( "'%s'", str_replace("''", "\'", $value_item) );
				}
				$template->assign_block_vars('values.set.val', array(
					'VALUE'	=> $value_item,
					'TXT'	=> str_replace( "''", "\'", $value_item_data['txt'] ),
					'IMG'	=> str_replace( "''", "\'", $value_item_data['img'] ),
					)
				);
			}
		}
	}

	// classes fields
	foreach ($classes_fields as $class_name => $class_data)
	{
		$template->assign_block_vars('classes', array(
			'NAME'			=> str_replace( "''", "\'", $class_name),
			'CONFIG_FIELD'	=> str_replace( "''", "\'", $class_data['config_field']),
			'ADMIN_FIELD'	=> str_replace( "''", "\'", $class_data['admin_field']),
			'USER_FIELD'	=> str_replace( "''", "\'", $class_data['user_field']),
			'SQL_DEF'		=> str_replace( "''", "\'", $class_data['sql_def']),
			)
		);
	}

	// sort user fields
	$class = array();
	$name = array();
	foreach ($user_fields as $field_name => $field_data)
	{
		$name[] = $field_name;
		$class[] = $field_data['class'];
	}
	@array_multisort($class, $name, $user_fields);

	// first pass : get the longest field lib
	$max_length = 0;
	foreach ($field_def as $def_key => $def_value)
	{
		if ( strlen($def_key) > $max_length )
		{
			$max_length = strlen($def_key);
		}
	}
	$max_length += 2;

	// send the header description
	foreach ($field_def as $def_key => $def_value)
	{
		$template->assign_block_vars('def_title', array(
			'KEY'	=> $def_key,
			'L_KEY'	=> pcp_format_lang($def_value['lang_key']),
			'PAD'	=> str_pad( '', $max_length - strlen($def_key) ),
			)
		);
	}

	// ouput
	$class_sav = '';
	foreach ($user_fields as $field_name => $field_data)
	{
		$template->assign_block_vars('field', array(
			'NAME'		=> $field_name,
			'COMMENT'	=> $field_data['class'],
			)
		);
		if ( $class_sav != $field_data['class'] )
		{
			$template->assign_block_vars('field.comment', array());
		}
		$class_sav = $field_data['class'];

		// dump the field
		foreach ($field_data as $def_key => $data)
		{
			$pres = "'%s'";
			switch ($def_key)
			{
				case 'get_mode':
					if ( $data == $field_data['type'] )
					{
						$data = '';
					}
					break;
				case 'auth':
					$pres = '%s';
					$data = $auth_list[$data];
					break;
			}
			if ( !empty($data) )
			{
				if (isset($field_def[$def_key]['type']) && $field_def[$def_key]['type'] == 'BOOLEAN')
				{
					$pres = '%s';
					$data = $data ? 'true' : 'false';
				}
				$template->assign_block_vars('field.row', array(
					'KEY'	=> str_replace( "''", "\'", $def_key),
					'VALUE'	=> sprintf($pres, str_replace( "''", "\'", str_replace('\"', '"', $data))),
					'PAD'	=> str_pad( '', $max_length - strlen($def_key) ),
					)
				);
			}
		}
	}

	// transfert to a var
	$template->assign_var_from_handle('output', 'output');
	$res = "<?php\n" . $template->_tpldata['.'][0]['output'] . "\n?>";

	// restore template saved state
	$template->_tpldata = $sav_tpl;

	// output to file
	$fname = $phpbb_root_path . './profilcp/def/def_userfields.' . $phpEx;
	@chmod($fname, 0666);
	$handle = @fopen($fname, 'w');
	@fwrite($handle, $res);
	@fclose($handle);
}


//---------------------------------
//
//	output the maps array to file
//
//---------------------------------
function pcp_output_maps($user_maps)
{
	global $phpbb_root_path, $phpEx, $template, $userdata;
	global $auth_list, $field_def, $user_fields;
	
	// save template state
	$sav_tpl = $template->_tpldata;

	// template
	$template->set_filenames(array(
		'output' => 'admin/pcp_usermaps_def.tpl')
	);

	// main
	$template->assign_vars(array(
		'TIME'		=> date( 'Y-m-d H:i:s', time() ),
		'USERNAME'	=> $userdata['username'],
		)
	);

	// first pass : get the longest field lib
	$max_length = 0;
	foreach ($field_def as $def_key => $def_value)
	{
		if ( strlen($def_key) > $max_length )
		{
			$max_length = strlen($def_key);
		}
	}
	$max_length += 2;

	// send the header description
	foreach ($field_def as $def_key => $def_value)
	{
		$template->assign_block_vars('def_title', array(
			'KEY'	=> $def_key,
			'L_KEY'	=> pcp_format_lang($def_value['lang_key']),
			'PAD'	=> str_pad( '', $max_length - strlen($def_key) ),
			)
		);
	}

	// dump map
	foreach ($user_maps as $map_name => $map_data)
	{
		// map header
		$template->assign_block_vars('map', array(
			'NAME'			=> str_replace( "''", "\'", $map_name),
			'ORDER'			=> str_replace( "''", "\'", $map_data['order']),
			'SPLIT'			=> $map_data['split'] ? 'true' : 'false',
			'CUSTOM'		=> intval($map_data['custom']),
			'TITLE_SINGLE'	=> is_string($map_data['title']) ? str_replace( "''", "\'", $map_data['title']) : '',
			)
		);
		if ( !empty($map_data['order']) )
		{
			$template->assign_block_vars('map.order', array());
		}
		if ( $map_data['split'] )
		{
			$template->assign_block_vars('map.split', array());
		}
		if ( !empty($map_data['custom']) )
		{
			$template->assign_block_vars('map.custom', array());
		}
		if ( empty($map_data['title']) || is_string($map_data['title']) )
		{
			$template->assign_block_vars('map.title_single', array());
		}

		// fields title
		if ( !empty($map_data['title']) && !is_string($map_data['title']) )
		{
			$template->assign_block_vars('map.block', array(
				'NAME'	=> 'title',
				)
			);
			foreach ($map_data['title'] as $field_name => $field_data)
			{
				$template->assign_block_vars('map.block.field', array(
					'NAME'	=> str_replace( "''", "\'", $field_name),
					)
				);
				foreach ($field_def as $def_key => $def_value)
				{
					if ( ($def_key != 'field_name') && ($field_data[$def_key] != $user_fields[$field_name][$def_key]) && ( !empty($field_data[$def_key]) || ( empty($field_data[$def_key]) && !is_string($field_data[$def_key]) && ($field_data[$def_key] == "0") ) ) )
					{
						$value = $field_data[$def_key];
						if ( is_string($value) || ( empty($value) && ($value != "0") ) )
						{
							$value = sprintf( "'%s'", str_replace("''", "\'", str_replace('\"', '"', $value)) );
						}
						if ($def_value['type'] == 'BOOLEAN')
						{
							$value = $value ? 'true' : 'false';
						}
						$template->assign_block_vars('map.block.field.def', array(
							'DEF_KEY'	=> $def_key,
							'VALUE'		=> $value,
							'PAD'		=> str_pad( '', $max_length - strlen($def_key) ),
							)
						);
					}
				}
			}
		}
		

		// fields
		if ( !empty($map_data['fields']) )
		{
			$template->assign_block_vars('map.block', array(
				'NAME'	=> 'fields',
				)
			);
			foreach ($map_data['fields'] as $field_name => $field_data)
			{
				$template->assign_block_vars('map.block.field', array(
					'NAME'	=> str_replace( "''", "\'", $field_name),
					)
				);
				foreach ($field_def as $def_key => $def_value)
				{
					// use array_key_exists here, because we want to allow an empty value
					if ( ($def_key != 'field_name') && ($field_data[$def_key] != $user_fields[$field_name][$def_key]) && array_key_exists($def_key, $field_data) )
					{
						$data = $field_data[$def_key];
						$pres = "'%s'";
						switch ($def_key)
						{
							case 'get_mode':
								if ( $data == $field_data['type'] )
								{
									$data = '';
								}
								break;
							case 'auth':
								$pres = '%s';
								$data = $auth_list[$data];
								break;
						}
						// do NOT check if data is set here, we know we have data if we arrived here after the if
						if ($def_value['type'] == 'BOOLEAN')
						{
							$data = $data ? 'true' : 'false';
							$pres = '%s';
						}
						$template->assign_block_vars('map.block.field.def', array(
							'DEF_KEY'	=> str_replace( "''", "\'", $def_key),
							'VALUE'		=> sprintf($pres, str_replace('\"', '"', str_replace( "''", "\'", $data))),
							'PAD'		=> str_pad( '', $max_length - strlen($def_key) ),
						));
					}
				}
			}
		}
	}

	// transfert to a var
	$template->assign_var_from_handle('output', 'output');
	$res = "<?php\n" . $template->_tpldata['.'][0]['output'] . "\n?>";

	// restore template saved state
	$template->_tpldata = $sav_tpl;

	// output to file
	$fname = $phpbb_root_path . './profilcp/def/def_usermaps.' . $phpEx;
	@chmod($fname, 0666);
	$handle = @fopen($fname, 'w');
	@fwrite($handle, $res);
	@fclose($handle);
}

?>
