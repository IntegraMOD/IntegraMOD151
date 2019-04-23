<?php
/***************************************************************************
 *                              admin_adr_vault_users.php
 *                                   ------------------
 *
 *   begin                : 		    15/02/2004
 *
 *
 ***************************************************************************/

if (!defined('IN_PHPBB'))
{
	die('Hacking attempt');
}

if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['Adr_Users']['Adr_vault_users'] = $file;
	return;
}
