<?php
/***************************************************************************
 *                               ip_search.php
 *                            -------------------
 *   begin                : Monday, Aug 25, 2003
 *   version              : 1.2.0
 *   date                 : 2003/09/17 23:47
 ***************************************************************************/
// Most of this is copied from modcp.php and tweaked to work from a form.

if (!defined('IN_PHPBB'))
{
	die("Hacking attempt");
}
if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['Users']['IP_Search'] = $filename;
	return;
}

?>