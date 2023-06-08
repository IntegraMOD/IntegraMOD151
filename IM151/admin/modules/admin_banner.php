<?php
/***************************************************************************
 *                              admin_banner.php
 *                            -------------------
 *		ver 1.2.3
 *          Author: Niels Chr. Rød, Denmark
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

if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['Styles']['Banner'] = $file;
	return;
}

?>
