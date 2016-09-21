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

if ( !defined('ADMIN_MENU') )
{
	define('ADMIN_MENU',1);
	function admin_menu(&$menu)
	{
		global $lang;
		$i = 0;
		$j = 0;
		$menu[$i] = new cash_menucat($lang['Cmcat_main']);
		$menu[$i]->additem(new cash_menuitem($j,	'Cash_Configuration',	'cash_config',		$lang['Cmenu_cash_config']));
		$menu[$i]->additem(new cash_menuitem($j,	'Cash_Currencies',		'cash_currencies',	$lang['Cmenu_cash_currencies']));
		$menu[$i]->additem(new cash_menuitem($j,	'Cash_Forums',			'cash_forums',		$lang['Cmenu_cash_forums']));
		$menu[$i]->additem(new cash_menuitem($j,	'Cash_Settings',		'cash_settings',	$lang['Cmenu_cash_settings']));
		$menu[$i]->additem(new cash_menuitem($j,	'Cash_Events',			'cash_events',		$lang['Cmenu_cash_events']));
		$menu[$i]->additem(new cash_menuitem($j,	'Cash_Reset',			'cash_reset',		$lang['Cmenu_cash_reset']));
		$menu[$i]->additem(new cash_menuitem($j,	'Cash_Exchange',		'cash_exchange',	$lang['Cmenu_cash_exchange']));
		$menu[$i]->additem(new cash_menuitem($j,	'Cash_Groups',			'cash_groups',		$lang['Cmenu_cash_groups']));
		$menu[$i]->additem(new cash_menuitem($j,	'Cash_Logs',			'cash_log',			$lang['Cmenu_cash_log']));
		$menu[$i]->additem(new cash_menuitem($j,	'Cash_Help',			'cash_help',		$lang['Cmenu_cash_help']));
	}
}

if ( !empty($navbar) && defined('IN_PHPBB') )
{
	$menu = array();
	if ( !defined('CASH_INCLUDE') )
	{
		message_die(GENERAL_ERROR,'functions_cash.php has not been included.<br /><br />Please make sure you have properly installed Cash Mod, including all the necessary file edits as found in cm_install_22x.txt');
	}
	admin_menu($menu);

	$template->set_filenames(array(
		"navbar" => "admin/cash_navbar.tpl")
	);

	$class = 0;
	for ( $i = 0; $i < count($menu); $i++ )
	{
		$template->assign_block_vars("navcat",array(	"L_CATEGORY" => $menu[$i]->category,
														"WIDTH" => $menu[$i]->num()));
		for ( $j = 0; $j < $menu[$i]->num(); $j++ )
		{
			$template->assign_block_vars("navitem",$menu[$i]->items[$j]->data($phpEx,$class+1,''));
			$class = ($class + 1)%2;
		}
	}
	$template->assign_var_from_handle('NAVBAR', 'navbar');
	return;
}

if ( !empty($setmodules) && defined('IN_PHPBB') )
{
	if ( empty($table_prefix) )
	{
		// jr admin mod
		/*
			since this gets included from within a function,
			and we require these base-scope variables, we
			copy them in from the global scope
		*/
		$table_prefix = $GLOBALS['table_prefix'];
		$phpbb_root_path = $GLOBALS['phpbb_root_path'];
		$phpEx = $GLOBALS['phpEx'];
		$board_config = $GLOBALS['board_config'];
		$lang = $GLOBALS['lang'];
	}
	include($phpbb_root_path . 'includes/functions_cash.'.$phpEx);
	$menu = array();
	admin_menu($menu);

	if ( $board_config['cash_adminbig'] )
	{
		for ( $i = 0; $i < count($menu); $i++ )
		{
			for ( $j = 0; $j < $menu[$i]->num(); $j++ )
			{
        // Pass false so we don't get SIDs. The admin panel adds them by itself.
				$module['Cash Mod'][$menu[$i]->items[$j]->title] = $menu[$i]->items[$j]->linkage($phpEx, false);
				if ( ($j == $menu[$i]->num() - 1) && !($i == count($menu) - 1) )
				{
					$lang[$menu[$i]->items[$j]->title] = $lang[$menu[$i]->items[$j]->title] . '</a></span></td></tr><tr><td class="row2" height="7"><span class="genmed"><a name="cm' . $menu[$i]->num() . '">';
				}
			}
		}
	}
	else
	{
		$file = basename(__FILE__);
		$module['Cash Mod']['Cash_Admin'] = "$file";
		$module['Cash Mod']['Cash_Help'] = "cash_help.$phpEx";
	}
	return;
}

define('IN_PHPBB', 1);
define('IN_CASHMOD', 1);

//
// Let's set the root dir for phpBB
//
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
include($phpbb_root_path . 'includes/functions_selects.'.$phpEx);

if ( $board_config['cash_adminnavbar'] )
{
	$navbar = 1;
	include('./admin_cash.'.$phpEx);
}

//$menu = array();
admin_menu($menu);

$template->set_filenames(array(
	"body" => "admin/cash_menu.tpl")
);

for ( $i = 0; $i < count($menu); $i++ )
{
	$template->assign_block_vars("menucat",array("L_CATEGORY" => $menu[$i]->category));
	for ( $j = 0; $j < $menu[$i]->num(); $j++ )
	{
		$template->assign_block_vars("menucat.menuitem",$menu[$i]->items[$j]->data($phpEx,1,''));
	}
}

$template->pparse("body");

include('./page_footer_admin.'.$phpEx);

?>
