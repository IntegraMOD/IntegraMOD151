<?php
/***************************************************************************
 *						lang_extend_topic_calendar.php [French]
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

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

// admin part
if ( $lang_extend_admin )
{
	$lang['Lang_extend_topic_calendar'] = 'Calendrier';
}

$lang['Calendar']				= 'Calendrier';
$lang['Calendar_scheduler']		= 'Agenda';
$lang['Calendar_event']			= 'Evénement du calendrier';
$lang['Calendar_from_to']		= 'Du %s au %s';
$lang['Calendar_time']			= 'Le %s';
$lang['Calendar_until']			= 'jusqu\'au';

$lang['Calendar_settings']		= 'Paramétrage du calendrier';
$lang['Calendar_header_cells']	= 'Nombre de jours à afficher sur l\'entête du forum (0 pour ne rien afficher)';
$lang['Calendar_title_length']	= 'Longueur des titres affichés dans les cases du calendrier';
$lang['Calendar_text_length']	= 'Longueur du texte affiché dans la fenêtre volante';

$lang['Calendar_display_open']	= 'Afficher le calendrier ouvert sur l\'entête du forum';
$lang['Calendar_nb_row']		= 'Nombre maximum d\'événements par jour affichés sur l\'entête du forum';
$lang['Calendar_birthday']		= 'Afficher les anniversaires dans le calendrier';
$lang['Calendar_forum']			= 'Afficher le nom du forum sous le titre de sujet dans l\'agenda';

$lang['Sorry_auth_cal']			= 'Désolé, seuls les %s peuvent poster des événements au calendrier dans ce forum.';
$lang['Date_error']				= '%d/%d/%d n\'est pas une date valide.';

$lang['Event_time']				= 'Heure de l\'événement';
$lang['Minutes']				= 'minutes';
$lang['Today']					= 'Aujourd\'hui';
$lang['All_events']				= 'Tous les événements';

$lang['Rules_calendar_can']		= 'Vous <b>pouvez</b> poster des événements au calendrier dans ce forum';
$lang['Rules_calendar_cannot']	= 'Vous <b>ne pouvez pas</b> poster des événements au calendrier dans ce forum';

$lang['Repeat_mode']			= 'Répéter';
$lang['Months']					= 'mois';
$lang['Weeks']					= 'semaines';
$lang['Years']					= 'années';
$lang['Months_week']			= 'mois (le n du mois)';
?>