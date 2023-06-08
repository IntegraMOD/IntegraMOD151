<?php
/***************************************************************************
 *                            admin_links_cat.php
 *                            -------------------
 *  MOD add-on page. Contains GPL code copyright of phpBB group.
 *  Author: OOHOO < webdev@phpbb-tw.net >
 *  Author: Stefan2k1 and ddonker from www.portedmods.com
 *  Demo: http://phpbb-tw.net/
 *  Version: 1.0.X - 2002/03/22 - for phpBB RC serial, and was named Related_Links_MOD
 *  Version: 1.1.0 - 2002/04/25 - Re-packed for phpBB 2.0.0, and renamed to Links_MOD
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
	$module['Links']['Category'] = $file;
	return;
}

?>