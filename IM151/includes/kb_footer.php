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
 *    $Id: kb_footer.php,v 1.6 2005/04/09 21:41:28 jonohlsson Exp $
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

// Parse and show the overall footer.

$template->set_filenames( array( 'kb_footer' => 'kb_footer.tpl' ) );

if ( !empty($kb_auth_can) )
{
	$template->assign_block_vars( 'auth_can', array() );
}

if ( !empty($kb_quick_nav) )
{
	$template->assign_block_vars( 'quick_nav', array() );
}

if ( !MXBB_MODULE ||MXBB_27x )
{
	$template->assign_block_vars( 'copy_footer', array() );
}

$quick_nav_action = this_kb_mxurl();
$s_hidden_vars = '<input type="hidden" name="mode" value="cat"><input type="hidden" name="page" value="' . $page_id . '">';

$template->assign_vars( array( 
		'QUICK_JUMP_ACTION' => $quick_nav_action,
		'S_HIDDEN_VARS' => $s_hidden_vars,
		//'SID' => $userdata['session_id'],
		
		'L_QUICK_NAV' => $lang['Quick_nav'],
		'L_QUICK_JUMP' => $lang['Quick_jump'],
		'QUICK_NAV' => $kb_quick_nav,
		
		'S_AUTH_LIST' => ( isset($kb_auth_can) ? $kb_auth_can : '' ),
		
		'L_MODULE_VERSION' => $kb_module_version,
		'L_MODULE_ORIG_AUTHOR' => $kb_module_orig_author,
		'L_MODULE_AUTHOR' => $kb_module_author ) 
	);

$template->pparse( 'kb_footer' );

?>
