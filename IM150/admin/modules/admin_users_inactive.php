<?php
/***************************************************************************
 *                            admin_users_inactive.php
 *                            -------------------
 *   begin                : Tuesday, Sep 19, 2003
 *   copyright            : (C) 2003 Sko22
 *   email                : sko22@quellicheilpc.com
 *
 *   $Id: admin_users_inactive.php,v 1.1.7 2004/08/08 14:08:30 sko22
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

if ( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['Users']['Users_Inactive'] = $filename;
	return;
}

?>