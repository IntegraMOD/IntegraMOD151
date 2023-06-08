<?php
/***************************************************************************
 *                              admin_meta_tags.php
 *                            -------------------
 *   begin                : Thursday, 11/10/2004
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 ***************************************************************************/

if (!defined('IN_PHPBB'))
{
	die("Hacking attempt");
}
if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['General']['Meta_tags_title'] = $file;
	return;
}

?>