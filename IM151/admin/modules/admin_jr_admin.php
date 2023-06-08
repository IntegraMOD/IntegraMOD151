<?php
/***************************************************************************
*                    $RCSfile: admin_jr_admin.php,v $
*                            -------------------
*   copyright            : (C) 2002-2003 Nivisec.com
*   email                : support@nivisec.com
*
*   $Id: admin_jr_admin.php,v 1.7 2003/09/01 01:59:33 nivisec Exp $
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

/****************************************************************************
/** Module Setup
/***************************************************************************/

if (!defined('IN_PHPBB'))
{
	die("Hacking attempt");
}
if (!empty($setmodules))
{
	$filename = basename(__FILE__);
	$module['Users']['Jr_Admin'] = $filename;
	return;
}

?>