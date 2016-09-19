<?php
/***************************************************************************
 *                                  lang_extend_ip_cf.php
 *                            -------------------
 *   begin                : 04-ott-2005
 *   copyright            : (C) 2005 3Di (aka 3D)
 *   email                : 3d AT phpbb2italia DOT za DOT net
 *   credits..............: thanks reddog for Today Userlist 101
 *   $Id: lang_extend_ip_cf.php, 2.0.0, 10-ott-2005 14.00.00, 3Di Exp $
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

//
// IP Country Flag Sessions begins
//
$lang['IP_Country_Flag'] = 'IP Country Flag';
$lang['Truncate_Sessions'] = 'Truncate Sessions';
$lang['IP_CF_Sessions_Page_Title'] = 'Updating your database';
$lang['IP_CF_Sessions_Explain_Pag'] = 'Truncating your sessions table means you\'ve lost all the User\'s connections.';
$lang['IP_CF_Sessions_Title_Pag'] = 'Truncating the sessions table';
//
// IP Country Flag Sessions ends
//

//
// IP Country Flag Today Userlist begins
//

$lang['Today_Userlist'] = 'Today Userlist';
$lang['IP_CF_Today_Userlist_Page_Title'] = 'IP Country Flag Today Userlist';
$lang['IP_CF_Today_Userlist_Explain_Pag'] = 'Day means from 00:00 to 23:59 - 24 hours means from the last User\'s Log-In.';
$lang['IP_CF_Today_Userlist_Title_Pag'] = 'Configuration Page for IP Country Flag Today Userlist';
$lang['Submit'] = 'Submit'; 
$lang['Reset'] = 'Reset'; 
$lang['IP_CF_Config_updated'] = '<b>IP Country Flag Today Userlist</b> Configuration Updated Successfully';
$lang['IP_CF_Click_return_admin_ip_cf_today_userlist_config'] = 'Click %sHere%s to return to IP Country Flag Today Userlist Configuration';
$lang['IP_CF_Click_return_admin_index'] = 'Click %sHere%s to return to the Admin Index';

//
// IP Country Flag Today Userlist ends
//

//-- mod : today userlist ------------------------------------------------------
//-- add
$lang['Today_select_method'] = 'Userlist display period';
$lang['Today_day_select'] = 'Day';
$lang['Today_hours_select'] = '24 hours';
//-- fin mod : today userlist --------------------------------------------------
?>