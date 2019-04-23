<?php
/***************************************************************************
*                               admin_adr_blacksmithing_recipes.php
*                              -------------------
*     begin                : 19. December 2006
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
	$module['Adr_Items']['Adr_Crafting_Recipes'] = $filename;

	return;
}
