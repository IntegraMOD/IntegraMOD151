<?php
/***************************************************************************
*                             admin_forum_rules.php
*                              -------------------
*     begin                : Mon Jul 31, 2001
*     copyright            : (C) 2003 Sko22
*     email                : sko22@quellicheilpc.com
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
	die("Hacking attempt");
}
if ( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['Forums']['Rules'] = $filename;

	return;
}

?>