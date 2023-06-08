<?php
/***************************************************************************
 *				 admin_wpm.php
 *			     --------------------
 *   copyright	  : (C) 2003, 2004 Duvelske
 *   email		  : duvelske@planet.nl
 *	 version mod  : 1.08
 *	 For updates please visit: http://www.vitrax.vze.com
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
	$module['General']['PM_Settings'] = $filename;
	return;
}

?>