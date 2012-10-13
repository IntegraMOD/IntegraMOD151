<?php
/***************************************************************************
 *                            admin_clean.php
 *                              -------------------
 *     begin                : 2003-06-36
 *     email                : florian@developpez.biz
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

if(!empty($setmodules))
{
	$filename = basename(__FILE__);
	$module['Forums']['Database cleaning'] = $filename . "?mode=activate";
	return;
}

?>