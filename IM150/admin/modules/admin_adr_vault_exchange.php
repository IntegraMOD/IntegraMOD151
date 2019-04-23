<?php
/***************************************************************************
 *                              admin_adr_vault_exchange.php
 *                            ------------------
 *   begin                : 15/02/2004
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
	$module['Adr_vault']['Adr_vault_exchange'] = $file;
	return;
}
