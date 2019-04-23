<?php
/***************************************************************************
 *                              	   adr_admin_cell_users.php
 *                                   ------------------
 *
 *   begin                             : 26/02/2004
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
	$module['Adr_Users']['Adr_Jail'] = $file;
	return;
}
