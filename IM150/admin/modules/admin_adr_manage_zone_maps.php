<?php
/***************************************************************************
*                      admin_adr_manage_zone_maps.php
*                      ------------------------------
*     begin                : 06/04/2005
*     copyright            : Ozzie
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
if(	!empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['ADR-Zones']['Manage Zone Maps'] = $file;
	return;
}
