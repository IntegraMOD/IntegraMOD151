<?php

 /***************************************************************************
 *                           admin_auto_lang.php
 *                            -------------------
 *   begin                : Fri, Aug 1, 2003
 *   copyright            : (C) 2003 Herbalite
 *   email                :
 *
 *   $Id: admin_auto_lang.php,v 1.1.1 2003/11/04 15:41:17 Herbalite Exp $
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
	$module['General']['Auto_language_detection'] = $filename;
	return;
}

?>
