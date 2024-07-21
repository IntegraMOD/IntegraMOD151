<?php
/** ------------------------------------------------------------------------
 *		subject				: mx-portal, CMS & portal
 *		begin            	: june, 2002
 *		copyright          	: (C) 2002-2005 MX-System
 *		email             	: jonohlsson@hotmail.com
 *		project site		: www.mx-system.com
 *
 *    	description          : This kb module is based on wGEric's phpbb mod and 
 *                           adapted for mx. It has been greatly improved and bugfixed
 *                           and is currently developed independent of original code...
 * 
 *    $Id: kb.php,v 1.19 2005/04/20 19:30:19 jonohlsson Exp $
 */

/**
 * This program is free software; you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation; either version 2 of the License, or
 *    (at your option) any later version.
 */

// Switch for making this run as a phpBB MOD or mxBB module

define( 'MXBB_MODULE', false ); 
define( 'IN_PHPBB', true );
define('CT_SECLEVEL', 'MEDIUM');
$ct_ignorepvar = array('helpbox', 'article_name', 'article_desc', 'message');
define( 'IN_PORTAL', true );

// When run as a phpBB mod these paths are identical ;)
$phpbb_root_path = $module_root_path = $mx_root_path = './';

include( $phpbb_root_path . 'extension.inc' );
include( $phpbb_root_path . 'common.' . $phpEx );

if (!defined('PAGE_KB')) define( 'PAGE_KB', -500 ); // If this id generates a conflict with other mods, change it ;)	

// Start session management

$userdata = session_pagestart( $user_ip, PAGE_KB );
init_userprefs( $userdata );

// End session management

include( $phpbb_root_path . 'includes/functions_post.' . $phpEx );
include( $phpbb_root_path . 'includes/kb_constants.' . $phpEx );
include( $phpbb_root_path . 'includes/functions_kb.' . $phpEx );
include( $phpbb_root_path . 'includes/functions_kb_auth.' . $phpEx );
include( $phpbb_root_path . 'includes/functions_kb_field.' . $phpEx );
include( $phpbb_root_path . 'includes/functions_kb_mx.' . $phpEx );
include_once( $phpbb_root_path . 'includes/bbcode.' . $phpEx );
include_once( $phpbb_root_path . 'includes/functions_search.' . $phpEx );	 

// -------------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------------

// Start KB SCRIPT

// Instanciate custom fields
$kb_custom_field = new kb_custom_field();
$kb_custom_field->init();

$show_new = true;

// page number

if ( isset( $_POST['page_num'] ) || isset( $_GET['page_num'] ) )
{
	$page_num = ( isset( $_POST['page_num'] ) ) ? intval( $_POST['page_num'] ) : intval( $_GET['page_num'] );
	$page_num = $page_num - 1;
}
else
{
	$page_num = 0;
}
// Print version
if ( isset( $_POST['print'] ) || isset( $_GET['print'] ) )
{
	$print_version = ( isset( $_POST['print'] ) ) ? $_POST['print'] : $_GET['print'];
	$print_version = htmlspecialchars( $print_version );
}
else
{
	$print_version = '';
}

// Pull all config data

$sql = "SELECT *
	FROM " . KB_CONFIG_TABLE;
if ( !$result = $db->sql_query( $sql ) )
{
	message_die( CRITICAL_ERROR, "Could not query config information in kb_config", "", __LINE__, __FILE__, $sql );
}
else
{
	while ( $kb_config_row = $db->sql_fetchrow( $result ) )
	{
		$config_name = $kb_config_row['config_name'];
		$config_value = $kb_config_row['config_value'];
		$kb_config[$config_name] = $config_value;
	}
}

// options
$kb_wysiwyg = false;
if ( $kb_config['wysiwyg'] ) // Html Textblock
{
	if ( file_exists( $mx_root_path . 'modules/tinymce/jscripts/tiny_mce/blank.htm' ) )
	{
		$bbcode_on = false;
		$html_on = true;
		$smilies_on = false;
		$kb_wysiwyg = true;		
	}
}

if ( !$kb_wysiwyg ) 
{
	$bbcode_on = $kb_config['allow_bbcode'] ? true : false;
	$html_on = $kb_config['allow_html'] ? true : false;
	$smilies_on = $kb_config['allow_smilies'] ? true : false;
}

if ( MXBB_MODULE ) 
{
	// Newssuite operation mode?
	//-------------------------------------------------------------------------
	$total_blockk = count( $_SESSION['mx_pages']['page_' . $page_id]['blocks'] );
	
	$kb_config['news_operate_mode'] = '';
	for( $blockk = 0; $blockk < $total_blockk; $blockk++ )
	{
		if ( $_SESSION['block_' . $block_rows[$blockk]['block_id']]['news_source_switch']['parameter_value'] == 'kb' && $_SESSION['block_' . $block_rows[$blockk]['block_id']]['news_mode_operate']['parameter_value'] == 'Source' )
		{
			$newssuite_select_par = $_SESSION['block_' . $block_rows[$blockk]['block_id']]['news_type_select']['parameter_value']; 
			// Extract 'what posts to view info', the cool Array ;)
			$news_type_select_data = array();
			$news_type_select_temp = $newssuite_select_par;
			$news_type_select_temp = stripslashes( $news_type_select_temp );
			$news_type_select_data = eval( "return " . $news_type_select_temp . ";" );
			$kb_config['news_operate_mode'] = true;
		}
		else
		{
			$kb_config['news_operate_mode'] = '';
		}
	} 
	// -------------------------------------------------------------------------
}

$is_admin = ( ( $userdata['user_level'] == ADMIN  ) && $userdata['session_logged_in'] ) ? true : 0;

// mode

$mode = '';
if ( isset( $_POST['mode'] ) || isset( $_GET['mode'] ) )
{
	$mode = ( isset( $_POST['mode'] ) ) ? $_POST['mode'] : $_GET['mode'];
	$mode = ( htmlspecialchars( $mode ) != 'cat' || intval ($_GET['cat'] ) != 0 ) ? htmlspecialchars( $mode ) : '';
}

if ( isset( $_POST['stats'] ) || isset( $_GET['stats'] ) )
{
	$stats = ( isset( $_POST['stats'] ) ) ? $_POST['stats'] : $_GET['stats'];
	$stats = htmlspecialchars( $stats );
}

$reader_mode = false;

if ( $mode == 'article' )
{
	include( $module_root_path . 'includes/kb_article.' . $phpEx );
}
else if ( $mode == 'cat' )
{
	include( $module_root_path . 'includes/kb_cat.' . $phpEx );
}
else if ( $mode == 'add' )
{
	include( $module_root_path . 'includes/kb_post.' . $phpEx );
}
else if ( $mode == 'search' )
{
	include( $module_root_path . 'includes/kb_search.' . $phpEx );
}
else if ( $mode == 'edit' )
{
	include( $module_root_path . 'includes/kb_post.' . $phpEx );
}
else if ( $mode == 'rate' )
{
	include( $module_root_path . 'includes/kb_rate.' . $phpEx );
}
else if ( $mode == 'stats' )
{
	include( $module_root_path . 'includes/kb_stats.' . $phpEx );
}
else if ( $mode == 'moderate' )
{
	include( $module_root_path . 'includes/kb_moderator.' . $phpEx );
}
else
{ 
	// DEFAULT ACTION
	$page_title = $lang['KB_title'];
	if ( !$is_block )
	{
		include( $mx_root_path . 'includes/page_header.' . $phpEx );
	}
	// load header
	include ( $module_root_path . "includes/kb_header." . $phpEx );

	$template->set_filenames( array( 'body' => 'kb_index_body.tpl' ) 
		);

	$template->assign_vars( array( 'L_CATEGORY' => $lang['Category'],
			'L_ARTICLES' => $lang['Articles'] ) 
		);

	get_kb_cat_index();
}

$template->pparse( 'body' ); 

// load footer
if ( !$print_version )
{
	include ( $module_root_path . "includes/kb_footer." . $phpEx );
}

if ( !$is_block && !$print_version )
{
	include( $mx_root_path . 'includes/page_tail.' . $phpEx );
}

?>
