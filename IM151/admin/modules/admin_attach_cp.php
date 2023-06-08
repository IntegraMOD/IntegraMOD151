<?php
/***************************************************************************
 *							admin_attach_cp.php
 *							-------------------
 *	begin				: Saturday, Feb 09, 2002
 *	copyright			: (C) 2002 Meik Sievertsen
 *	email				: acyd.burn@gmx.de
 *
 *	$Id: admin_attach_cp.php,v 1.25 2005/05/09 19:30:26 acydburn Exp $
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
	$module['Attachments']['Control_Panel'] = $filename;
	return;
}

?>