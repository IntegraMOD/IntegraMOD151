<?php
/***************************************************************************
 *                            admin_album_personal.php
 *                             -------------------
 *   begin                : Sunday, February 02, 2003
 *   copyright            : (C) 2003 Smartor
 *   email                : smartor_xp@hotmail.com
 *
 *   $Id: admin_album_personal.php,v 1.0.2 2003/03/05, 19:44:38 ngoctu Exp $
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
	$filename = basename(__FILE__);
	$module['Photo_Album']['Personal_Galleries'] = $filename;
	return;
}
?>