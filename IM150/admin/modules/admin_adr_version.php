<?php
/***************************************************************************
 *                              admin_adr_version.php
 *                            ------------------
 *   begin                : 23/03/2006
 *
 *
 ***************************************************************************/

if (!defined('IN_PHPBB'))
{
	die('Hacking attempt');
}

if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['Adr_Tools']['Check ADR Version'] = "$filename?mode=version";
	return;
}
