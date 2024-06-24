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
 *    $Id: kb_header.php,v 1.15 2005/04/02 20:37:03 jonohlsson Exp $
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

// Parse and show the overall header.

$template->set_filenames( array( 'kb_header' => 'kb_header.tpl' ) );
if ( isset ( $_GET['cat'] ) )
{
	$category_id = intval ($_GET['cat'] );
	// Start auth check
	//
		$kb_is_auth = array();
		$kb_is_auth = kb_auth(AUTH_ALL, $category_id, $userdata);
		
	// End of auth check
	
	if ( $kb_config['allow_new'] == 1 && ( $kb_is_auth['auth_post'] || $kb_is_auth['auth_mod'] ) )
	{
		$temp_url = append_sid( this_kb_mxurl( "mode=add&cat=" . $category_id ) );
		$add_article = '<a href="' . $temp_url . '">' . $lang['Add_article'] . '</a>';
	}
}
else
{
	$add_article = $lang['Click_cat_to_add'];
}

$template->assign_block_vars( 'switch_add_article', array() );	


$temp_url = append_sid( this_kb_mxurl_search ('', true) );
$search = '<a href="' . $temp_url . '">' . $lang['Search'] . '</a>';

if ( $kb_config['header_banner'] == 1 )
{
	$temp_url = append_sid( this_kb_mxurl() );
	$block_title = '<td align="center"><a href="' . $temp_url . '"><img src="' . $images['kb_title'] . '" width="285" height="45" border="0" alt="' . ( isset($title) ? $title : '') . '"></a></td>';
}
else
{
	$block_title = MXBB_MODULE ? '<th class="thHead">&nbsp;&nbsp;' . $title . '</th>' : '<td align="center"><b>' . $lang['KB_title'] . '</b></td>';
}

$template->assign_vars( array( 'U_PORTAL' => $mx_root_path,
		'L_PORTAL' => "<<",
		'L_KB_TITLE' => $block_title,
		'L_ADD_ARTICLE' => $add_article,
		'L_SEARCH' => $search,
		'U_TOPRATED' => append_sid( this_kb_mxurl( "mode=stats&amp;stats=toprated" ) ),
		'L_TOPRATED' => $lang['Top_toprated'],
		'U_MOST_POPULAR' => append_sid( this_kb_mxurl( "mode=stats&amp;stats=mostpopular" ) ),
		'L_MOST_POPULAR' => $lang['Top_most_popular'],
		'U_LATEST' => append_sid( this_kb_mxurl( "mode=stats&amp;stats=latest" ) ),
		'L_LATEST' => $lang['Top_latest'],
		'U_KB' => append_sid( this_kb_mxurl() ),
		'L_KB' => $lang['KB_title'] ) 
	);

if ( $kb_config['stats_list'] == 1 )
{
	get_quick_stats( ( isset($category_id) ? $category_id : '' ) );
}

$template->pparse( 'kb_header' );

?>
