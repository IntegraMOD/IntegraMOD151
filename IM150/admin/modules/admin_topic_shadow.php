<?php
/***************************************************************************
*                            $RCSfile: admin_topic_shadow.php,v $
*                            -------------------
*   copyright            : (C) 2002-2003 Nivisec.com
*   email                : support@nivisec.com
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
	$module['Forums']['Topic_Shadow'] = $filename;
	return;
}

?>