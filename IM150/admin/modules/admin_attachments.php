<?php
/***************************************************************************
 *								admin_attachments.php
 *								-------------------
 *   begin                : Wednesday, Jan 09, 2002
 *   copyright            : (C) 2002 Meik Sievertsen
 *   email                : acyd.burn@gmx.de
 *
 *   $Id: admin_attachments.php,v 1.54 2004/12/09 20:10:01 acydburn Exp $
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

if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['Attachments']['Manage'] = $filename . '?mode=manage';
	$module['Attachments']['Shadow_attachments'] = $filename . '?mode=shadow';
	$module['Extensions']['Special_categories'] = $filename . '?mode=cats';
	$module['Attachments']['Sync_attachments'] = $filename . '?mode=sync';
	$module['Attachments']['Quota_limits'] = $filename . '?mode=quota';
	return;
}

?>