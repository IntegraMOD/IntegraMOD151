<?php
/***************************************************************************
 *                          admin_rebuild_search.php
 *                            -------------------
 *   begin                : Thursday, Jul 12, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *
 *
 ***************************************************************************/

if (!defined('IN_PHPBB'))
{
	die("Hacking attempt");
}
if(!empty ($setmodules))
{
	$filename = basename(__FILE__);
	$module['General']['Rebuild Search'] = $filename;
	return;
}

?>