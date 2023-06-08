<?php
/***************************************************************************
 *                             admin_referers.php
 *                            -------------------
 *   copyright            : (C) 2005 oc5iD XTreme Mods
 *   email                : admin@on-irc.net
 *   Web                  : http://www.on-irc.net
 *
 ***************************************************************************/

if (!defined('IN_PHPBB'))
{
	die("Hacking attempt");
}
if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['General']['HTTP_Referers_Title'] = $file;
	return;
}

?>