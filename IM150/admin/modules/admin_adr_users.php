<?php
/***************************************************************************
 *                              admin_adr_users.php
 *                            -------------------
 *   begin                : 20/03/2004
 *   
 ***************************************************************************/

if (!defined('IN_PHPBB'))
{
	die('Hacking attempt');
}

if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['Adr_Users']['Adr_characters'] = $filename;

	return;
}
