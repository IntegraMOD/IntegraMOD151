<?php
/***************************************************************************
 *                              admin_phpbbmyadmin.php
 *                            -------------------
 *   copyright            : (C) 2003, 2004 Armin Altorffer
 *   email                : aaltorffer@hotmail.com
 *
 ***************************************************************************/

/***************************************************************************
*
*   Copyright:      phpBBMyAdmin v0.3.4 © 2003, 2004 by Armin Altorffer
*   This product is released under the GPL License.
*   This product can be freely used and distributed in its current, unmodified
*   form without permission.
*   Intellectual Property is retained by the hack author(s) listed above.
*
***************************************************************************/

/***************************************************************************
*
*   This product is in no way affiliated with phpMyAdmin (www.phpmyadmin.net)
*   Nor does the author of this product offer support for phpMyAdmin.
*   For support on phpMyAdmin or for phpMyAdmin itself, visit www.phpmyadmin.net
*
***************************************************************************/

if (!defined('IN_PHPBB'))
{
	die("Hacking attempt");
}
if (!empty($setmodules))
{
	$file = basename(__FILE__);
	$module['Database']['phpBBMyAdmin'] = $file;
	return;
}

?>