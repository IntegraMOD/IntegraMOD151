<?php
/***************************************************************************
*                               admin_adr_jobs.php
*                              -------------------
*     begin                : 11/11/2004
*     copyright            : Seteo-Bloke
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
	$module['Adr']['Adr_jobs'] = $filename;

	return;
}