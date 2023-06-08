<?php

/***************************************************************************
 *                            admin_subtemplates.php
 *                            ----------------------
 *   begin                : 2003/04
 *   copyright            : Ptirhiik
 *   email                : admin@rpgnet-fr.com
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
	$module['Styles']['Subtemplate'] = $file;
	return;
}

?>