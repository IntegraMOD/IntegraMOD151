<?php
/***************************************************************************
 *                            profilcp_home.php
 *                            -----------------
 *	begin				: 08/05/2003
 *	copyright			: Ptirhiik
 *	email				: admin@rpgnet-fr.com
 *
 *	version				: 1.0.4 - 17/10/2003
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 *
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
	exit;
}

if( !empty($setmodules) )
{
	pcp_set_menu('home', 20, __FILE__, 'profilcp_index_shortcut', 'profilcp_index_pagetitle' );
	return;
}

// get the home panel modules
$home_modules = array();
$dir = @opendir($phpbb_root_path . "profilcp");
$set_homemodules = true;
while( $file = @readdir($dir) )
{
	if( preg_match("/^profilcp_home_.*?\." . $phpEx . "$/", $file) )
	{
		include($phpbb_root_path . "profilcp/" . $file);
	}
}
@closedir($dir);
unset($set_homemodules);

// sort them
array_multisort( $home_modules['pos'], $home_modules['sort'], $home_modules['url'] );

// template file
$template->set_filenames(array(
	'body' => 'profilcp/home_body.tpl')
);

// process the includes
$left_part = false;
$right_part = false;

// pre process : global init
$process = 'pre';
for ($home_module=0; $home_module < count($home_modules['url']); $home_module++)
{
	include( $phpbb_root_path . './profilcp/' . $home_modules['url'][$home_module] );
}

// post process : display, paginations and so
$process = 'post';
for ($home_module=0; $home_module < count($home_modules['url']); $home_module++)
{
	include( $phpbb_root_path . './profilcp/' . $home_modules['url'][$home_module] );
}

// achieve the display
$template->assign_vars(array(
	'S_HIDDEN_FIELDS'		=> $s_hidden_fields,
	'S_PROFILCP_ACTION'		=> append_sid("./profile.$phpEx"),
	)
);
$template->pparse('body');

?>