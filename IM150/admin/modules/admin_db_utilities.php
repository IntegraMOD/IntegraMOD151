<?php
/***************************************************************************
*                             admin_db_utilities.php
*                              -------------------
*     begin                : Thu May 31, 2001
*     copyright            : (C) 2001 The phpBB Group
*     email                : support@phpbb.com
*
*
****************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

/***************************************************************************
*	We will attempt to create a file based backup of all of the data in the
*	users phpBB database.  The resulting file should be able to be imported by
*	the db_restore.php function, or by using the mysql command_line
*
*	Some functions are adapted from the upgrade_20.php script and others
*	adapted from the unoficial phpMyAdmin 2.2.0.
***************************************************************************/

if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['Database']['Backup_DB'] = $filename . "?perform=backup";

	$file_uploads = @ini_get('file_uploads');

	if( (empty($file_uploads) || $file_uploads != 0) && (strtolower($file_uploads) != 'off') )
	{
		$module['Database']['Restore_DB'] = $filename . "?perform=restore";
		$module['Database']['Optimize_DB'] = $filename . "?perform=optimize";
	}

	return;
}

?>
