<?php
/***************************************************************************
*                               admin_group_extend.php
*                              -------------------
*     begin                : 20/11/2003
*     copyright            : Dr DLP / Malicious Rabbit
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
if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['Groups']['Group_extend'] = $filename;

	return;
}

?>