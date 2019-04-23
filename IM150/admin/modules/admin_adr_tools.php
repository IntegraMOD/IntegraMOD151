<?php
/***************************************************************************
 *                              admin_adr_tools.php
 *                            ------------------
 *   begin                : 17/02/2004
 *
 *
 ***************************************************************************/

// Yes , we are everywhere ^_^
if (!defined('IN_PHPBB'))
{
	die('Hacking attempt');
}

if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['Adr_Tools']['Adr_cache'] = "$filename?mode=cache";
	$module['Adr_Tools']['Adr_items_resync'] = "$filename?mode=resync_items";
	$module['Adr_Tools']['Armaggedon'] = "$filename?mode=armaggedon";
	return;
}
