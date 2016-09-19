<?php
/***************************************************************************
*                           admin_edit_module.php
*                            -------------------
*   begin                : Fri, Jan 24, 2003
*   copyright            : (C) 2003 Meik Sievertsen
*   email                : acyd.burn@gmx.de
*
*
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
	$filename = basename(__FILE__);
	$module['Statistics']['Edit_module'] = $filename . '?mode=select_module';
	return;
}

?>