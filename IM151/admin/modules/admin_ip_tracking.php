<?php
/***************************************************************************
 *                            admin_ip_tracking.php
 *                            ---------------------
 *   Version              : 1.0.5
 *   Email                : austin_inc@hotmail.com
 *	 Site				  : phpbb-amod.vcm/
 *	 Copyright			  : (c) aUsTiN-Inc
 *
 ***************************************************************************/
 
if (!defined('IN_PHPBB'))
{
	die("Hacking attempt");
}

if( !empty($setmodules) )
{
	$module['Ip Tracking']['Configuration']		= append_sid("admin_ip_tracking.$phpEx?mode=config");
	$module['Ip Tracking']['Ip: Logs']						= append_sid("admin_ip_tracking.$phpEx?mode=logs&update=next&start=0");
	$module['Ip Tracking']['Ip: Admin Hits']				= append_sid("admin_ip_tracking.$phpEx?mode=admin");
	$module['Ip Tracking']['Ip: Multi Users'] 				= append_sid("admin_ip_tracking.$phpEx?mode=multi");
	$module['Ip Tracking']['Ip: Search'] 					= append_sid("admin_ip_tracking.$phpEx?mode=search");	
	return;
}
?>