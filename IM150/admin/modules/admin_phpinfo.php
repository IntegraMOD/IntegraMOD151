<?php
/***************************************************************************
 *                              admin_phpinfo.php
 *                            -------------------
 *   begin                : Wednesday, Jul 16, 2003
 *   copyright            : (C) 2003 Dimitri Seitz
 *   email                : dimitri.seitz@weingarten-net.de
 *
 *   version		  : 1.1.2
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

/***************************************************************************
 *
 *   Mit diesem phpBB 2 Modul wird die phpinfo() übersichtlich im 
 *   Adminpanel angezeigt.
 *   Zur Installation einfach in den phpBB2/admin Ordner kopieren
 *
 ***************************************************************************/

if (!defined('IN_PHPBB'))
{
	die("Hacking attempt");
}
if (!empty($setmodules))
{
	$filename = basename(__FILE__);
	$module['Tools']['PHP Info'] = $filename;
	return;
}

?>