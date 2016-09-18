<?php
/**
 * pafiledb mx module
 *                             -------------------
 *    copyright            : (C) 2002 MX-System
 *    begin                : oct 23, 2003
 *    email                : jonohlsson@hotmail.com
 *    based on code by Mohd Basri, and pafilDB
 * 
 *    $Id: admin_kb_custom.php,v 1.7 2005/04/20 19:30:17 jonohlsson Exp $
 */

if ( file_exists( './../viewtopic.php' ) )
{
	define( 'IN_PHPBB', 1 );
	define( 'IN_PORTAL', 1 );
	define( 'MXBB_MODULE', false );
	
	if ( !empty( $setmodules ) )
	{
		$file = basename( __FILE__ );
		$module['KB_title']['Custom Field'] = $file;
		return;
	}	
	
	$phpbb_root_path = $module_root_path = $mx_root_path = "./../";
	require( $phpbb_root_path . 'extension.inc' );
	require( './pagestart.' . $phpEx );
	include( $phpbb_root_path . 'config.'.$phpEx );
	include( $phpbb_root_path . 'includes/functions_admin.'.$phpEx );
	include( $phpbb_root_path . 'includes/kb_constants.' . $phpEx );
	include( $phpbb_root_path . 'includes/functions_kb.' . $phpEx );
	include( $phpbb_root_path . 'includes/functions_kb_auth.' . $phpEx );	
	include( $phpbb_root_path . 'includes/functions_kb_field.' . $phpEx );	
	include( $phpbb_root_path . 'includes/functions_kb_mx.' . $phpEx );	
	include( $phpbb_root_path . 'includes/functions_search.' . $phpEx );	
}
else 
{
	define( 'IN_PORTAL', 1 );
	define( 'MXBB_MODULE', true );
	
	if ( !empty( $setmodules ) )
	{
		$file = basename( __FILE__ );
		$module['KB_title']['Custom Field'] = "modules/mx_kb/admin/" . "$file";
		return;
	}	
	
	$mx_root_path = './../../../';
	$module_root_path = "./../";

	define( 'MXBB_27x', file_exists( $mx_root_path . 'mx_login.php' ) );
	
	require( $mx_root_path . 'extension.inc' );
	require( $mx_root_path . '/admin/pagestart.' . $phpEx );
	include( $module_root_path . 'includes/kb_constants.' . $phpEx );
	include( $module_root_path . 'includes/functions_kb.' . $phpEx );
	include( $module_root_path . 'includes/functions_kb_auth.' . $phpEx );
	include( $module_root_path . 'includes/functions_kb_field.' . $phpEx );
	include( $module_root_path . 'includes/functions_kb_mx.' . $phpEx );
	include( $phpbb_root_path . 'includes/functions_search.' . $phpEx );
	include_once( $mx_root_path . 'admin/page_header_admin.' . $phpEx );
}

// ===================================================
// addslashes to vars if magic_quotes_gpc is off
// ===================================================
if ( !@function_exists( 'slash_input_data' ) )
{
	function slash_input_data( &$data )
	{
		if ( is_array( $data ) )
		{
			foreach ( $data as $k => $v )
			{
				$data[$k] = ( is_array( $v ) ) ? slash_input_data( $v ) : addslashes( $v );
			}
		}
		return $data;
	}
}

if ( !isset( $_REQUEST ) )
{
	$_REQUEST = array_merge( $_GET, $_POST, $_COOKIE );
}

if ( !function_exists('get_magic_quotes_gpc') || !get_magic_quotes_gpc() )
{
	$_GET = slash_input_data( $_GET );
	$_POST = slash_input_data( $_POST );
	$_COOKIE = slash_input_data( $_COOKIE );
	$_REQUEST = slash_input_data( $_REQUEST );
}

$kb_custom_field = new kb_custom_field();
$kb_custom_field->init();

$mode = ( isset( $_REQUEST['mode'] ) ) ? htmlspecialchars( $_REQUEST['mode'] ) : 'select';
$field_id = ( isset( $_REQUEST['field_id'] ) ) ? intval( $_REQUEST['field_id'] ) : 0;
$field_type = ( isset( $_REQUEST['field_type'] ) ) ? intval( $_REQUEST['field_type'] ) : $kb_custom_field->field_rowset[$field_id]['field_type'];
$field_ids = ( isset( $_REQUEST['field_ids'] ) ) ? $_REQUEST['field_ids'] : '';
$submit = ( isset( $_POST['submit'] ) ) ? true : false;

switch ( $mode )
{
	case 'addfield':
		$template_file = 'admin/kb_field_add.tpl';
		break;
	case 'editfield':
		$template_file = 'admin/kb_field_add.tpl';
		break;
	case 'edit':
		$template_file = 'admin/kb_select_field_edit.tpl';
		break;
	case 'add':
		$template_file = 'admin/kb_select_field_type.tpl';
		break;
	case 'delete':
		$template_file = 'admin/kb_select_field_delete.tpl';
		break;
	case 'select':
		$template_file = 'admin/kb_select.tpl';
		break;
}

if ( $submit )
{
	if ( $mode == 'do_add' && !$field_id )
	{
		$kb_custom_field->update_add_field( $field_type );

		$message = $lang['Fieldadded'] . '<br /><br />' . sprintf( $lang['Click_return'], '<a href="' . append_sid( 'admin_kb_custom.' . $phpEx ) . '">', '</a>' ) . '<br /><br />' . sprintf( $lang['Click_return_admin_index'], '<a href="' . append_sid( 'index.' . $phpEx . '?pane=right' ) . '">', '</a>' );
		mx_message_die( GENERAL_MESSAGE, $message );
	}
	elseif ( $mode == 'do_add' && $field_id )
	{
		$kb_custom_field->update_add_field( $field_type, $field_id );

		$message = $lang['Fieldedited'] . '<br /><br />' . sprintf( $lang['Click_return'], '<a href="' . append_sid( 'admin_kb_custom.' . $phpEx ) . '">', '</a>' ) . '<br /><br />' . sprintf( $lang['Click_return_admin_index'], '<a href="' . append_sid( 'index.' . $phpEx . '?pane=right' ) . '">', '</a>' );
		mx_message_die( GENERAL_MESSAGE, $message );
	}
	elseif ( $mode == 'do_delete' )
	{
		foreach( $field_ids as $key => $value )
		{
			$kb_custom_field->delete_field( $key );
		}

		$message = $lang['Fieldsdel'] . '<br /><br />' . sprintf( $lang['Click_return'], '<a href="' . append_sid( 'admin_kb_custom.' . $phpEx ) . '">', '</a>' ) . '<br /><br />' . sprintf( $lang['Click_return_admin_index'], '<a href="' . append_sid( 'index.' . $phpEx . '?pane=right' ) . '">', '</a>' );
		mx_message_die( GENERAL_MESSAGE, $message );
	}
}

$template->set_filenames( array( 'admin' => $template_file ) 
	);

switch ( $mode )
{
	case 'add':
	case 'addfield':
		$l_title = $lang['Afieldtitle'];
		break;
	case 'edit':
		$l_title = $lang['Efieldtitle'];
		break;
	case 'editfield':
		$l_title = $lang['Efieldtitle'];
		break;
	case 'delete':
		$l_title = $lang['Dfieldtitle'];
		break;
	case 'select':
		$l_title = $lang['Mfieldtitle'];
		break;
}

if ( $mode == 'add' )
{
	$s_hidden_fields = '<input type="hidden" name="mode" value="addfield">';
}
elseif ( $mode == 'addfield' || $mode == 'editfield')
{
	$s_hidden_fields = '<input type="hidden" name="field_type" value="' . $field_type . '">';
	$s_hidden_fields .= '<input type="hidden" name="field_id" value="' . $field_id . '">';
	$s_hidden_fields .= '<input type="hidden" name="mode" value="do_add">';
}
elseif ( $mode == 'edit' )
{
	$s_hidden_fields = '<input type="hidden" name="mode" value="editfield">';
}
elseif ( $mode == 'delete' )
{
	$s_hidden_fields = '<input type="hidden" name="mode" value="do_delete">';
}

$template->assign_vars( array( 
		'L_FIELD_TITLE' => $l_title,
		'L_FIELD_EXPLAIN' => $lang['Fieldexplain'],
		'L_SELECT_TITLE' => $lang['Fieldselecttitle'],

		'S_HIDDEN_FIELDS' => $s_hidden_fields,
		'S_FIELD_ACTION' => append_sid( "admin_kb_custom.$phpEx" ) ) 
	);

if ( $mode == 'addfield' || $mode == 'editfield')
{
	if ( $field_id )
	{
		$data = $kb_custom_field->get_field_data( $field_id );
	}

	$template->assign_vars( array( 'L_FIELD_NAME' => $lang['Fieldname'],
			'L_FIELD_NAME_INFO' => $lang['Fieldnameinfo'],
			'L_FIELD_DESC' => $lang['Fielddesc'],
			'L_FIELD_DESC_INFO' => $lang['Fielddescinfo'],
			'L_FIELD_DATA' => $lang['Field_data'],
			'L_FIELD_DATA_INFO' => $lang['Field_data_info'],
			'L_FIELD_REGEX' => $lang['Field_regex'],
			'L_FIELD_REGEX_INFO' => sprintf( $lang['Field_regex_info'], '<a href="http://www.php.net/manual/en/function.preg-match.php" target="_blank">', '</a>' ),
			'L_FIELD_ORDER' => $lang['Field_order'],

			//'DATA' => ( $field_type != INPUT && $field_type != TEXTAREA ) ? true : false,
			//'REGEX' => ( $field_type == INPUT || $field_type == TEXTAREA ) ? true : false,
			//'ORDER' => ( $field_id ) ? true : false,

			'FIELD_NAME' => $data['custom_name'],
			'FIELD_DESC' => $data['custom_description'],
			'FIELD_DATA' => $data['data'],
			'FIELD_REGEX' => $data['regex'],
			'FIELD_ORDER' => $data['field_order'] ) 
		);
		
		if ( $field_type != INPUT && $field_type != TEXTAREA )
		{
			$template->assign_block_vars( 'data', array() );
		}
		if ( $field_type == INPUT || $field_type == TEXTAREA )
		{
			$template->assign_block_vars( 'regex', array() );
		}
		if ( $field_id )
		{
			$template->assign_block_vars( 'order', array() );
		}
}
elseif ( $mode == 'add' )
{
	$field_types = array( INPUT => $lang['Field_Input'], TEXTAREA => $lang['Field_Textarea'], RADIO => $lang['Field_Radio'], SELECT => $lang['Field_Select'], SELECT_MULTIPLE => $lang['Field_Select_multiple'], CHECKBOX => $lang['Field_Checkbox'] );

	$field_type_list = '<select name="field_type">';
	foreach( $field_types as $key => $value )
	{
		$field_type_list .= '<option value="' . $key . '">' . $value . '</option>';
	}
	$field_type_list .= '</select>';

	$template->assign_vars( array( 'S_SELECT_FIELD_TYPE' => $field_type_list ) 
		);
}
elseif ( $mode == 'edit' || $mode == 'delete' || $mode == 'select' )
{
	foreach( $kb_custom_field->field_rowset as $field_id => $field_data )
	{
		$template->assign_block_vars( 'field_row', array( 
				'FIELD_ID' => $field_id,
				'FIELD_NAME' => $field_data['custom_name'],
				'FIELD_DESC' => $field_data['custom_description'] ) 
			);
	}
}

$template->pparse( 'admin' );

// MX Module
include( $mx_root_path . 'admin/page_footer_admin.' . $phpEx );

?>