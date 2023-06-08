<?php
/***************************************************************************
 *                              admin_cash.php
 *                            -------------------
 *   begin                : Monday, Aug 18, 2003
 *   copyright            : (C) 2003 Xore
 *   email                : mods@xore.ca
 *
 *   $Id: admin_cash.php,v 1.1.0.0 2003/09/18 23:03:34 Xore $
 *
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/


if ( !empty($setmodules) && defined('IN_PHPBB') )
{
	$cat_name = $lang['Cmcat_main'];
	$menu = array(
		array('Cash_Configuration',	'cash_config',		$lang['Cmenu_cash_config']),
		array('Cash_Currencies',		'cash_currencies',	$lang['Cmenu_cash_currencies']),
		array('Cash_Forums',			'cash_forums',		$lang['Cmenu_cash_forums']),
		array('Cash_Settings',		'cash_settings',	$lang['Cmenu_cash_settings']),
		array('Cash_Events',			'cash_events',		$lang['Cmenu_cash_events']),
		array('Cash_Reset',			'cash_reset',		$lang['Cmenu_cash_reset']),
		array('Cash_Exchange',		'cash_exchange',	$lang['Cmenu_cash_exchange']),
		array('Cash_Groups',			'cash_groups',		$lang['Cmenu_cash_groups']),
		array('Cash_Logs',			'cash_log',			$lang['Cmenu_cash_log']),
		array('Cash_Help',			'cash_help',		$lang['Cmenu_cash_help']),
	);

	global $phpEx;
	foreach ($menu as list($menu_key, $menu_file, $menu_desc))
	{
		$module['Cash Mod'][$menu_key] = $menu_file . '.' . $phpEx;
	}
}