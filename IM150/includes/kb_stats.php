<?php
/** ------------------------------------------------------------------------
 *		subject				: mx-portal, CMS & portal
 *		begin            	: june, 2002
 *		copyright          	: (C) 2002-2005 MX-System
 *		email             	: jonohlsson@hotmail.com
 *		project site		: www.mx-system.com
 * 
 *		description			:
 * -------------------------------------------------------------------------
 * 
 *    $Id: kb_stats.php,v 1.8 2005/04/09 21:41:28 jonohlsson Exp $
 */

/**
 * This program is free software; you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation; either version 2 of the License, or
 *    (at your option) any later version.
 */
if ( !defined('IN_PHPBB') )
{
  die("Hacking attempt");
}

if ( !defined( 'IN_PORTAL' ) )
{
	die( "Hacking attempt" );
}

$start = ( isset( $_GET['start'] ) ) ? intval( $_GET['start'] ) : 0;

// Start auth check
//
	$kb_is_auth_all = array();
	$kb_is_auth_all = kb_auth(AUTH_ALL, AUTH_LIST_ALL, $userdata);
	
// End of auth check
//

$kb_quick_nav = get_kb_cat_list( 'auth_view', 0, 0, true, $kb_is_auth_all );

if ( !$is_block )
{
	include( $mx_root_path . 'includes/page_header.' . $phpEx );
} 

// load header
include ( $module_root_path . "includes/kb_header." . $phpEx );

$template->set_filenames( array( 'body' => 'kb_stats_body.tpl' ) );

if ( $stats == 'toprated' )
{
	$path_kb = $lang['Top_toprated'];
}
elseif ( $stats == 'latest' )
{
	$path_kb = $lang['Top_latest'];
}
elseif ( $stats == 'mostpopular' )
{
	$path_kb = $lang['Top_most_popular'];
} 

$template->assign_vars( array( 'L_CATEGORY_NAME' => $category_name,
		'L_ARTICLE' => $lang['Article'],
		'L_CAT' => $lang['Category'],
		'L_ARTICLE_TYPE' => $lang['Article_type'],
		'L_ARTICLE_CATEGORY' => $lang['Category'],
		'L_ARTICLE_DATE' => $lang['Date'],
		'L_ARTICLE_AUTHOR' => $lang['Author'],
		'L_VIEWS' => $lang['Views'],
		'L_VOTES' => $lang['Votes'],
		'L_CATEGORY' => $lang['Category_sub'],
		'L_ARTICLES' => $lang['Articles'],
		'PATH' => '&raquo; ' . $path_kb,
		'U_CAT' => append_sid( this_kb_mxurl( 'mode=cat&cat=' . $category_id ) ) 
		) );

$total_articles = get_kb_stats( $stats, '1', 'articlerow', $start, $kb_config['art_pagination'], $kb_is_auth_all );

// Stats pagination is inactivated for now ;)
if ( $total_articles > 0 )
{
	// $pagination = generate_pagination( this_kb_mxurl( "mode=cat&cat=$category_id" ), $total_articles, $kb_config['art_pagination'], $start ) . '&nbsp;';
}

if ( $total_articles > 0 )
{
	// $template->assign_block_vars( 'pagination', array() );
}
?>