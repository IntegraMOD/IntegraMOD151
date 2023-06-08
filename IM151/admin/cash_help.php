<?php
/***************************************************************************
 *                              cash_help.php
 *                            -------------------
 *   begin                : Wednesday, Jul 30, 2003
 *   copyright            : (C) 2003 Xore
 *   email                : mods@xore.ca
 *
 *   $Id: cash_help.php,v 2.0.0.0 2003/09/18 22:59:21 Xore $
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
//
// Start page proper
//
$template->set_filenames(array(
	"body" => "admin/cash_menu.tpl")
);

$j = 0;
$help = array();
$help[0] = new cash_menucat($lang['Cmenu_cash_help']);
$help[0]->additem(new cash_menuitem($j,	'Cmh_support',			'http://www.phpbb.com/phpBB/viewtopic.php?p=623226#623226',	$lang['Cmhe_support']));
$help[0]->additem(new cash_menuitem($j,	'Cmh_troubleshooting',	'http://www.phpbb.com/phpBB/viewtopic.php?p=623226#625402',	$lang['Cmhe_troubleshooting']));
$help[0]->additem(new cash_menuitem($j,	'Cmh_upgrading',		'http://www.phpbb.com/phpBB/viewtopic.php?p=623226#648190',	sprintf($lang['Cmhe_upgrading'],$board_config['cash_version'])));
$help[0]->additem(new cash_menuitem($j,	'Cmh_addons',			'http://www.phpbb.com/phpBB/viewtopic.php?p=623226#655651',	$lang['Cmhe_addons']));
$help[0]->additem(new cash_menuitem($j,	'Cmh_demo_boards',		'http://www.phpbb.com/phpBB/viewtopic.php?p=623226#658468',	$lang['Cmhe_demo_boards']));
$help[0]->additem(new cash_menuitem($j,	'Cmh_translations',		'http://www.phpbb.com/phpBB/viewtopic.php?p=623226#662158',	$lang['Cmhe_translations']));
$help[0]->additem(new cash_menuitem($j,	'Cmh_features',			'http://www.phpbb.com/phpBB/viewtopic.php?p=623226#664549',	$lang['Cmhe_features']));

for ( $i = 0; $i < count($help); $i++ )
{
	$template->assign_block_vars("menucat",array("L_CATEGORY" => $help[$i]->category));
	for ( $j = 0; $j < $help[$i]->num(); $j++ )
	{
		$template->assign_block_vars("menucat.menuitem",$help[$i]->items[$j]->data('',1,' target="cmh"',false));
	}
}

$template->pparse("body");

include('./page_footer_admin.'.$phpEx);

?>