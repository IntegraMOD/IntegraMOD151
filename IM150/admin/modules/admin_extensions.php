<?php
/***************************************************************************
 *								admin_extensions.php
 *								-------------------
 *   begin                : Wednesday, Jan 09, 2002
 *   copyright            : (C) 2002 Meik Sievertsen
 *   email                : acyd.burn@gmx.de
 *
 *   $Id: admin_extensions.php,v 1.27 2004/10/31 16:46:58 acydburn Exp $
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
	$module['Extensions']['Extension_control'] = $filename . '?mode=extensions';
	$module['Extensions']['Extension_group_manage'] = $filename . '?mode=groups';
	$module['Extensions']['Forbidden_extensions'] = $filename . '?mode=forbidden';
	return;
}

?>