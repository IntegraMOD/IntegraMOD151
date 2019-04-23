<?php
/***************************************************************************
*                               admin_adr_item_type.php
*                              -------------------
*     begin                : 31/01/2004
*     copyright            : vash1486
*	  email                : vash1486@hotmail.com
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
	$module['Adr_Items']['Adr_items_settings_advanced'] = "$filename";

	return;
}
