<?php
/****************************************************************
 *			lang_extend_announces.php [Nederlands]
 *			-------------------------
 *	begin				: 28/09/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 1.0.0 - 28/09/2003
 *
 *   Nederlandse vertaling  : Maart 2005 
 *   The Dutch Team         : http://www.integramod.nl 
 * 
 *   note: removing the original copyright is illegal even you 
 *         have modified the code. Just append yours if you
 *         have modified it. 
 ****************************************************************/ 

/****************************************************************
 *
 *   This program is free software; you can redistribute it and/or
 *   modify it under the terms of the GNU General Public License as
 *   published by the Free Software Foundation; either version 2
 *   of the License, or (at your option) any later version.
 *
 ****************************************************************/

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

// admin part
if ( $lang_extend_admin )
{
	$lang['Lang_extend_announces'] = 'Mededelingen Suite';
}

$lang['Board_announcement']						= 'Forum Mededelingen';
$lang['announcement_duration']					= 'Duur van de mededeling';
$lang['announcement_duration_explain']			= 'Dit is het aantal dagen dat een mededeling blijft. Voer -1 in om hem permanent te laten staan';
$lang['Announce_settings']						= 'Mededelingen';
$lang['announcement_date_display']				= 'Toon mededeling datum';
$lang['announcement_display']					= 'Toon boardmededelingen op de index';
$lang['announcement_display_forum']				= 'Toon boardmededelingen op de forums';
$lang['announcement_split']						= 'Splits mededeling type in de board mededelingenbox';
$lang['announcement_forum']						= 'Toon de forum naam onder de mededeling titel in de board mededelingenbox';
$lang['announcement_prune_strategy']			= 'Mededeling prune strategie';
$lang['announcement_prune_strategy_explain']	= 'Dit zal het type van de mededeling zijn na het prunen';

$lang['Global_announce']						= 'Algemene Mededeling';
$lang['Sorry_auth_global_announce']				= 'Sorry, alleen %s kunnen algemene mededelingen plaatsen in dit forum.';
$lang['Post_Global_Announcement']				= 'Algemene Mededeling';
$lang['Topic_Global_Announcement']				= '<b>[ Algemene Mededeling ]</b>';

$lang['Announces_from_to']						= '(van %s tot %s)';

?>