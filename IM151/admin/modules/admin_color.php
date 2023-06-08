<?php
/***************************************************************************
*							admin_color.php
*							--------------
*	begin		: 2005/09/30
*	copyright	: phantomk
*	email		: phantomk@hackbb.com
*
*	Version		: 0.0.16 - 2006/07/15
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
	$file = basename(__FILE__);
	$module['Groups']['AGCM_colors'] = $file;
	return;
}

?>