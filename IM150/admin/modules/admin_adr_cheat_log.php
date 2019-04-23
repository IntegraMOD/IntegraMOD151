<?php
/***************************************************************************
 *                           admin_adr_cheat_log.php
 *                           -----------------------
 *		Version			: 0.2.0
 *		Email			: GOster@OzziesWorld.com
 *		Site			: http://www.OzziesWorld.com
 *
 ***************************************************************************/

if (!defined('IN_PHPBB'))
{
	die('Hacking attempt');
}

if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['ADR-Zones']['Cheat CP'] = $filename;
	return;
}
