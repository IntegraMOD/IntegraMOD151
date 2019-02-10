<?php
/***************************************************************************
 *							admin_forums_extend.php
 *							-----------------------
 *	begin			: 06/11/2003
 *	copyright		: Ptirhiik
 *	email			: Ptirhiik@clanmckeen.com
 *
 *	version			: 1.0.1 - 22/11/2003
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
if ( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['Forums']['Manage_extend'] = $file;
	return;
}

?>