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

if ( file_exists( './viewtopic.php' ) ) // -------------------------------------------- phpBB MOD MODE
{
	define( 'MXBB_MODULE', false ); 
	define( 'IN_PHPBB', true );
	define('CT_SECLEVEL', 'MEDIUM');
	$ct_ignorepvar = array('helpbox','message','article_desc','article_name','message',' ($pic_filetype !');
	define( 'IN_PORTAL', true );
	
	// When run as a phpBB mod these paths are identical ;)
	$phpbb_root_path = $module_root_path = $mx_root_path = './';
	
	include( $phpbb_root_path . 'extension.inc' );
	include( $phpbb_root_path . 'common.' . $phpEx );
	
	define( 'PAGE_KB', -500 ); // If this id generates a conflict with other mods, change it ;)	
	
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
}
else // --------------------------------------------------------------------------------- mxBB Module MODE
{
	define( 'MXBB_MODULE', true ); 
	
	if ( !function_exists( 'read_block_config' ) )
	{
		define( 'IN_PORTAL', true );
		$mx_root_path = './../../';
		include_once( $mx_root_path . 'extension.inc' );
		include_once( $mx_root_path . 'common.' . $phpEx ); 
		
		// Start session management
		
		$userdata = session_pagestart( $user_ip, PAGE_INDEX );
		mx_init_userprefs( $userdata ); 
		
		// End session management

		define( 'MXBB_27x', file_exists( $mx_root_path . 'mx_login.php' ) );
		
		if ( !isset( $HTTP_GET_VARS['print'] ) )
		{
			include_once( $module_root_path . 'includes/kb_constants.' . $phpEx );
			include_once( $module_root_path . 'includes/kb_pages.' . $phpEx );

			$start = ( isset( $HTTP_GET_VARS['start'] ) ) ? intval( $HTTP_GET_VARS['start'] ) : 0;
			
			$url = '';
			if ( empty( $article_id ) )
			{
				$url = PORTAL_URL . 'index.php?page=' . $kb_pages . '&mode=cat&cat=' . $cat_id;
			}
			else if ( !empty( $article_id ) )
			{
				$url = PORTAL_URL . 'index.php?page=' . $kb_pages . '&mode=article&k=' . $article_id;
			}	
			
			if ( !empty( $url ) && !$kb_error )
			{
				if ( !empty( $db ) )
				{
					$db->sql_close();
				} 
			
				if ( @preg_match( '/Microsoft|WebSTAR|Xitami/', getenv( 'SERVER_SOFTWARE' ) ) )
				{
					header( 'Refresh: 0; URL=' . $url );
					echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">' . "\n" . '<html><head>' . "\n" . '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">' . "\n" . '<meta http-equiv="refresh" content="0; url=' . $url . '">' . "\n" . '<title>Redirect</title>' . "\n" . '<script language="javascript" type="text/javascript">' . "\n" . '<!--' . "\n" . 'if( document.images ) {' . "\n" . "\t" . 'parent.location.replace("' . $url . '");' . "\n" . '} else {' . "\n" . "\t" . 'parent.location.href = "' . $url . '";' . "\n" . '}' . "\n" . '// -->' . "\n" . '</script>' . "\n" . '</head>' . "\n" . '<body>' . "\n" . '<div align="center">If your browser does not support meta redirection please click ' . '<a href="' . $url . '">HERE</a> to be redirected</div>' . "\n" . '</body></html>';
					exit;
				}
				@header( 'Location: ' . $url );	
			}
			else 
			{
				if ( MXBB_27x )
				{
					mx_message_die(GENERAL_MESSAGE, 'This module does not support standalone usage. In the adminCP, add the kb block to a portal page.');
				}	
				else 
				{			
					die('no article, no redirect');	
				}
			}
		}
	}
	else
	{ 
		define( 'MXBB_27x', file_exists( $mx_root_path . 'mx_login.php' ) );

		// Read block Configuration
		
		$block_config = read_block_config( $block_id );
		$title = !empty( $block_config[$block_id]['block_title'] ) ? $block_config[$block_id]['block_title'] : $lang['KB_title'];
		$desc = $block_config[$block_id]['block_desc'];
		$block_size = ( isset( $block_size ) && !empty( $block_size ) ? $block_size : '100%' );
	
		$is_block = true;
		global $images;
	}	
	
	// Extract 'what posts to view info', the cool Array ;)
	$kb_type_select_data = array();
	$kb_type_select_temp = $block_config[$block_id][kb_type_select]['parameter_value'];
	$kb_type_select_temp = stripslashes( $kb_type_select_temp );
	$kb_type_select_data = eval( "return " . $kb_type_select_temp . ";" );
	
	include_once( $phpbb_root_path . 'includes/functions_post.' . $phpEx );
	include( $module_root_path . 'includes/kb_constants.' . $phpEx );
	include_once( $module_root_path . 'includes/functions_kb.' . $phpEx );
	include_once( $module_root_path . 'includes/functions_kb_auth.' . $phpEx );
	include_once( $module_root_path . 'includes/functions_kb_field.' . $phpEx );
	include_once( $module_root_path . 'includes/functions_kb_mx.' . $phpEx );
	include_once( $phpbb_root_path . 'includes/functions_search.' . $phpEx );	
}

// -------------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------------

// Start KB SCRIPT

// Instanciate custom fields
$kb_custom_field = new kb_custom_field();
$kb_custom_field->init();

$show_new = true;

// page number

if ( isset( $HTTP_POST_VARS['page_num'] ) || isset( $HTTP_GET_VARS['page_num'] ) )
{
	$page_num = ( isset( $HTTP_POST_VARS['page_num'] ) ) ? intval( $HTTP_POST_VARS['page_num'] ) : intval( $HTTP_GET_VARS['page_num'] );
	$page_num = $page_num - 1;
}
else
{
	$page_num = 0;
}
// Print version
if ( isset( $HTTP_POST_VARS['print'] ) || isset( $HTTP_GET_VARS['print'] ) )
{
	$print_version = ( isset( $HTTP_POST_VARS['print'] ) ) ? $HTTP_POST_VARS['print'] : $HTTP_GET_VARS['print'];
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
	$total_blockk = count( $HTTP_SESSION_VARS['mx_pages']['page_' . $page_id]['blocks'] );
	
	$kb_config['news_operate_mode'] = '';
	for( $blockk = 0; $blockk < $total_blockk; $blockk++ )
	{
		if ( $HTTP_SESSION_VARS['block_' . $block_rows[$blockk]['block_id']]['news_source_switch']['parameter_value'] == 'kb' && $HTTP_SESSION_VARS['block_' . $block_rows[$blockk]['block_id']]['news_mode_operate']['parameter_value'] == 'Source' )
		{
			$newssuite_select_par = $HTTP_SESSION_VARS['block_' . $block_rows[$blockk]['block_id']]['news_type_select']['parameter_value']; 
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

if ( isset( $HTTP_POST_VARS['mode'] ) || isset( $HTTP_GET_VARS['mode'] ) )
{
	$mode = ( isset( $HTTP_POST_VARS['mode'] ) ) ? $HTTP_POST_VARS['mode'] : $HTTP_GET_VARS['mode'];
	$mode = ( htmlspecialchars( $mode ) != 'cat' || intval ($HTTP_GET_VARS['cat'] ) != 0 ) ? htmlspecialchars( $mode ) : '';
}

if ( isset( $HTTP_POST_VARS['stats'] ) || isset( $HTTP_GET_VARS['stats'] ) )
{
	$stats = ( isset( $HTTP_POST_VARS['stats'] ) ) ? $HTTP_POST_VARS['stats'] : $HTTP_GET_VARS['stats'];
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