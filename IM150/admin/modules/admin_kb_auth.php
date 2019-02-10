<?php
/** ------------------------------------------------------------------------
 *		subject				: mx-portal module
 *		begin            	: june, 2002
 *		copyright          	: (C) 2002-2005 MX-System
 *		email             	: jonohlsson@hotmail.com
 *		project site		: www.mx-system.com
 * 
 *		description			:
 * 
 *    $Id: admin_kb_auth.php,v 1.7 2005/04/20 19:30:17 jonohlsson Exp $
 */

/**
 * This program is free software; you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation; either version 2 of the License, or
 *    (at your option) any later version.
 */

if (!defined('IN_PHPBB'))
{
	die("Hacking attempt");
}
if ( !empty( $setmodules ) )
{
	$file = basename( __FILE__ );
	$module['KB_title']['Permissions'] = $file;
	return;
}	

?>