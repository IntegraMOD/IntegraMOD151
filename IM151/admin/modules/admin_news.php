<?php
/***************************************************************************
*                               admin_news.php
*                              -------------------
*     begin                : Sunday, 25th Feb 2003
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
if( !empty($setmodules) )
{
  $filename = basename(__FILE__);
  $module['News Admin']['Configuration'] = $filename;
  return;
}

?>