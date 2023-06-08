<?php
/***************************************************************************
 *						lang_extend_topic_calendar.php [Nederlands]
 *						------------------------------
 *	begin				: 28/09/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 1.0.0 - 28/09/2003
 *
 *   Nederlandse vertaling  : Maart 2005 
 *   The Dutch Team         : http://www.integramod.nl
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

// admin part
if ( $lang_extend_admin )
{
	$lang['Lang_extend_topic_calendar'] = 'Topic Kalendar';
}

$lang['Calendar']				= 'Kalender';
$lang['Calendar_scheduler']		= 'Planner';
$lang['Calendar_event']			= 'Kalendar evenementen';
$lang['Calendar_from_to']		= 'Van %s tot %s (inclusief)';
$lang['Calendar_time']			= '%s';
$lang['Calendar_until']			= 'Tot';

$lang['Calendar_settings']		= 'Kalender Instellingen';
$lang['Calendar_header_cells']	= 'Aantal te tonen cellen in pagina kop (0 voor niet tonen)';
$lang['Calendar_title_length']	= 'Titel lengte die getoond moet worden in de kalender cellen';
$lang['Calendar_text_length']	= 'Lengte van de tekst die getoond moet worden in de overzicht schermen';
$lang['Calendar_display_open']	= 'Laat de kalender rij geopend op de pagina kop zien';
$lang['Calendar_display_open']	= 'Display the calendar row on the board header opened';
$lang['Calendar_nb_row']		= 'Aantal regels per dag in de pagina kop';
$lang['Calendar_birthday']		= 'Toon verjaardagen in de kalender';
$lang['Calendar_forum']			= 'Toon de forum naam onder het onderwerp in de planner';

$lang['Sorry_auth_cal']			= 'Sorry, maar %s kunnen aleen evenementen plaatsen in dit forum.';
$lang['Date_error']				= 'dag %d, maand %d, jaar %d is geen geldige datum';

$lang['Event_time']				= 'Evenement tijd';
$lang['Minutes']				= 'Minuten';
$lang['Today']					= 'Vandaag';
$lang['All_events']				= 'Alle evenementen';

$lang['Rules_calendar_can']		= '<b>kun</b> je Kalender evenementen plaatsen';
$lang['Rules_calendar_cannot']	= 'kun je <b>geen</b> Kalender evenementen plaatsen';

$lang['Repeat_mode']			= 'Herhaling';
$lang['Months']					= 'Maanden';
$lang['Weeks']					= 'Weken';
$lang['Years']					= 'Jaren';
$lang['Months_week']			= "Elke {n} weekdag om de {n} maand(en)" //'Months on nth weekday';
?>