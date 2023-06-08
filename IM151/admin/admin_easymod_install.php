<?php
/***************************************************************************
 *                             admin_easymod_install.php
 *                            -------------------
 *   begin                : Wednesday, March 15, 2002
 *   copyright            : (C) 2002-2004 by Nuttzy - Craig Nuttall, 2005 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: admin_easymod_install.php 131 2011-03-23 01:16:49Z HelterSkelter $
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

define('IN_PHPBB', true);

define('CT_SECLEVEL', 'LOW');
$ct_ignorepvar = array('command_step5');

//
// Let's set the root dir for phpBB
//
$phpbb_root_path = "../";


	// display error message (obviously we can't use the lang system from this ;-)
	echo "<iframe src='mods/easymod/easymod_install.php' width='100%' height='800'>";
?>