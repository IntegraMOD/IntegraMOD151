<?php
/***************************************************************************
 *						lang_extend_last_topic_from.php [English]
 *						-------------------------------
 *	begin				: 28/09/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 1.0.0 - 19/10/2003
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
	$lang['Lang_extend_last_topics_from'] = 'Letzte Themen vom';
}

$lang['Topic_last']						= 'Letzte Themen';
$lang['Topic_last_settings']			= 'Letzte Themen eines Benutzers';
$lang['Topic_last_started']				= 'Letzte Themen gestartet von %s';
$lang['Topic_last_started_title']		= 'Letzte Themen gestartet von einem User';
$lang['Topic_last_started_explain']		= 'Set here the number of the last topics the user started you want to display on profile view. 0 means no display.';
$lang['Topic_last_replied']				= 'Letzte Themen %s beantwortet an';
$lang['Topic_last_replied_title']		= 'Letzte Themen die ein Benutzer beatwortet hat';
$lang['Topic_last_replied_explain']		= 'Setze hier die Anzahl der letzten Themen die der Benutzer angefordert hat, die in seinem Profil angezeigt werden sollen. 0 steht für keine Anzeige.';
$lang['Topic_last_ended']				= 'Letzte Themen %s enden';
$lang['Topic_last_ended_title']			= 'Letzte Themen die ein Benutzer beendet hat';
$lang['Topic_last_ended_explain']		= 'Setze hier die Anzahl der letzten Themen auf die Benutzer gepostet hat, die in seinem Profil angezeigt werden sollen. 0 steht für keine Anzeige.';
$lang['Topic_last_split']				= 'Splitte die Themen nach Typ auf';
$lang['Topic_last_split_explain']		= 'Setze pro Thementyp eine Trennlinie z.B. für (Ankündigungen, Themen, usw.).';
$lang['Topic_last_forum']				= 'Forum';
$lang['Topic_last_forum_explain']		= 'Zeige den Forumstitel an der Stelle wo das Thema unter dem Thementitel steht.';

?>