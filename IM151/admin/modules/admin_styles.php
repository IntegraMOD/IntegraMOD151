<?php
/***************************************************************************
 *                              admin_styles.php
 *                            -------------------
 *   begin                : Thursday, Jul 12, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
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

if (!defined('IN_PHPBB'))
{
	die("Hacking attempt");
}
if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['Styles']['Add_new'] = "$file?mode=addnew";
	$module['Styles']['Create_new'] = "$file?mode=create";
	$module['Styles']['Manage'] = $file;
	$module['Styles']['Export'] = "$file?mode=export";
	return;
}

?>