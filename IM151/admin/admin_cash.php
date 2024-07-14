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

if (!empty($setmodules) || !empty($navbar))
{
	/* V: disabled navbar. ACP menus are strictly superior.
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
	*/
	return;
}

define('IN_PHPBB', 1);
define('IN_CASHMOD', 1);

//
// Let's set the root dir for phpBB
//
$phpbb_root_path = "./../";
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
