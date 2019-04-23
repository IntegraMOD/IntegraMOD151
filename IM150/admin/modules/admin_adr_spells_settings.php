<?php
/***************************************************************************
*                              admin_adr_spells_settings.php
*                              -------------------
*   begin                : 18/06/08
*   copyright            : 
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
	$module['ADR Spells']['Spell Settings'] = $filename;
	return;
}
