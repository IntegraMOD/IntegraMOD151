<?php
/***************************************************************************
 *						lang_extend_announces.php [English]
 *						-------------------------
 *	begin				: 28/09/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 1.0.0 - 28/09/2003
 *
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

/***************************************************************************
 *
 *   german translation	:		clanpunisher
 *
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die("Hacking Versuch");
}

// admin part
if ( $lang_extend_admin )
{
	$lang['Lang_extend_announces'] = 'Ankündigungs-Einstellungen';
}

$lang['Board_announcement']						= 'Board Ankündigungen';
$lang['announcement_duration']					= 'Ankündigungsdauer';
$lang['announcement_duration_explain']			= 'Dies ist die Dauer in Tagen, wie lang eine Ankündigung bestehen bleibt. Benutzer -1 damit diese permanent gestezt wird';
$lang['Announce_settings']						= 'Ankündigungen';
$lang['announcement_date_display']				= 'Zeige Datums Ankündigung';
$lang['announcement_display']					= 'Zeige Ankündigungen auf der Index';
$lang['announcement_display_forum']				= 'Zeige Ankündigungen auf der Index Forumen';
$lang['announcement_split']						= 'Splitte den Ankündigungstyp in der Board-Ankündigungsbox';
$lang['announcement_forum']						= 'Display the forum name under the announcement title in the board announcement box';
$lang['announcement_prune_strategy']			= 'Ankündigungs-Prune Vorgehen';
$lang['announcement_prune_strategy_explain']	= 'Dies ist der Typ des Ankündigungs-Themas nach dem es gepruned wurde';

$lang['Global_announce']						= 'Allgemeine Ankündigung';
$lang['Sorry_auth_global_announce']				= 'Sorry, aber nur %s kann allgemeine Ankündigungen posten.';
$lang['Post_Global_Announcement']				= 'Allgemeine Ankündigung';
$lang['Topic_Global_Announcement']				= '<b>[ Global Announcement ]</b>';

$lang['Announces_from_to']						= '(from %s to %s)';

?>