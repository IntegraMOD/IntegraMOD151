<?php
/***************************************************************************
 *                              admin_userlist.php
 *                            -------------------
 *   begin                : Tuesday, 09 Feburary 2004
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
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
	$filename = basename(__FILE__);
	$module['Users']['Userlist'] = $filename;
	return;
}

?>