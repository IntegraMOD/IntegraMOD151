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

if (!defined('IN_PHPBB'))
{
	die("Hacking attempt");
}
if ( !empty( $setmodules ) )
{
	$file = basename( __FILE__ );
	$module['KB_title']['Custom Field'] = $file;
	return;
}	

?>