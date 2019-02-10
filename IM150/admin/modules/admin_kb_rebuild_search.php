<?php
/***************************************************************************
 *                          admin_rebuild_search.php
 *                            -------------------
 *   begin                : Thursday, Jul 12, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: admin_kb_rebuild_search.php,v 1.7 2005/04/20 19:30:17 jonohlsson Exp $
 *
 *
 ***************************************************************************/

if (!defined('IN_PHPBB'))
{
	die("Hacking attempt");
}
if ( !empty( $setmodules ) )
{
	$file = basename( __FILE__ );
	$module['KB_title']['Optimize tables'] = $file;
	return;
}

?>