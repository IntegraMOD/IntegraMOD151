<?php
/***************************************************************************
 *						lang_extend_topic_calendar.php [English]
 *						------------------------------
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
	$lang['Lang_extend_topic_calendar'] = 'Themen Kalender';
}

$lang['Calendar']				= 'Kalender';
$lang['Calendar_scheduler']		= 'Planer';
$lang['Calendar_event']			= 'Kalender Event';
$lang['Calendar_from_to']		= 'Von %s bin %s (eingefügt)';
$lang['Calendar_time']			= '%s';
$lang['Calendar_until']			= 'Bis';

$lang['Calendar_settings']		= 'Kalender Einstellungen';
$lang['Calendar_header_cells']	= 'Anzahl der Zellen, die im Boardkopf angezeigt werden sollen (0 für keine Anzeige)';
$lang['Calendar_title_length']	= 'Länge das Titels der in einer Kalenderzelle angezeigt wird';
$lang['Calendar_text_length']	= 'Länge des Textes der in der Übersicht angezeigt wird';
$lang['Calendar_display_open']	= 'Soll die Kalenderreihe geöffnet angezeigt werden';
$lang['Calendar_nb_row']		= 'Nummer der Reihe pro Tag im Boardkopf';
$lang['Calendar_birthday']		= 'Zeige Geburtstage im Kalender an';
$lang['Calendar_forum']			= 'Zeige den Forennamen unter dem Thementitel im Planer an';

$lang['Sorry_auth_cal']			= 'Sorry, aber nur %s können Kalenderereignisse in diesem Forum eintragen.';
$lang['Date_error']				= 'Tag %d, Monat %d, Jahr %d ist kein gültiges Datum';

$lang['Event_time']				= 'Event Zeit';
$lang['Minutes']				= 'Minuten';
$lang['Today']					= 'Heute';
$lang['All_events']				= 'Alle Events';

$lang['Rules_calendar_can']		= 'Du <b>kannst</b> Kalenderevents in diesen Forum posten';
$lang['Rules_calendar_cannot']	= 'Du <b>kannst keine</b> Kalenderevents in diesen Forum posten';

$lang['Repeat_mode']			= 'Wiederhonlungen';
$lang['Months']					= 'Monate';
$lang['Weeks']					= 'Wochen';
$lang['Years']					= 'Jahre';
$lang['Months_week']			= 'Monate mit Wochentagen';
?>