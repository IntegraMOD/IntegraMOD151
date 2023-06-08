<?php

/***************************************************************************
 *                              admin_icons.php
 *                            -------------------
 *   begin                : 07/09/2003
 *   copyright            : Ptirhiik
 *   email                : ptirhiik@wanadoo.fr
 *   version              : 1.0.2 - 28/10/2003
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
	$module['General']['Icons_settings'] = $file;
	return;
}

?>