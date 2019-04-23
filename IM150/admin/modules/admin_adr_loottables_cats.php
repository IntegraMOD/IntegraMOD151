<?php
/***************************************************************************
*                               admin_adr_loottables_cats.php
*                              -------------------
*     begin                : 01/03/2006
*     copyright            : Himmelweiss
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

if (!defined('IN_PHPBB'))
{
	die('Hacking attempt');
}

if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['Adr_Items']['Loottable_Categories'] = $filename;
	// $module['ADR_Loot_System']['Loottable_Categories'] = $filename;

	return;
}
