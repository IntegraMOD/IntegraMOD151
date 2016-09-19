<?php
/****************************************************************
 *			lang_extend_merge.php [Nederlands]
 *			-------------------------------
 *	begin				: 28/09/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 1.0.1 - 21/10/2003
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
	$lang['Lang_extend_merge'] = 'Simpel Samenvoegen van Onderwerpen';
}

$lang['Refresh'] = 'Vernieuw';
$lang['Merge_topics'] = 'Voeg onderwerpen samen';
$lang['Merge_title'] = 'Nieuwe onderwerp titel';
$lang['Merge_title_explain'] = 'Dit wordt de nieuwe titel van het onderwerp. Laat het leeg als je de titel wilt gebruiken van het bestemmings onderwerp';
$lang['Merge_topic_from'] = 'Onderwerp om samen te voegen';
$lang['Merge_topic_from_explain'] = 'Dit onderwerp zal samengevoegt worden met het andere onderwerp. Je kunt het onderwerp id invoeren, de url van de onderwerp, of de url van een bericht in dit onderwerp';
$lang['Merge_topic_to'] = 'Bestemmings onderwerp';
$lang['Merge_topic_to_explain'] = 'Dit onderwerp zal alle berichten krijgen van het andere onderwerp. Je kunt het onderwerp id invoeren, de url van de onderwerp, of de url van een bericht in dit onderwerp';
$lang['Merge_from_not_found'] = 'Het onderwerp om samen te voegen is niet gevonden';
$lang['Merge_to_not_found'] = 'Het bestemmings onderwerp is niet gevonden';
$lang['Merge_topics_equals'] = 'Je kunt een onderwerp niet laten samenvoegen met zichzelf';
$lang['Merge_from_not_authorized'] = 'Je hebt geen rechten om onderwerpen samen te voegen die van het forum van dit onderwerp komen';
$lang['Merge_to_not_authorized'] =  'Je hebt geen rechten om onderwerpen die van het forum van dit onderwerp komen de modereren';
$lang['Merge_poll_from'] = 'Er is een Opiniepeiling in het onderwerp dat wordt samengevoegt. Deze zal gekopieerd worden naar het bestemmingsonderwerp';
$lang['Merge_poll_from_and_to'] = 'Het bestemmingsonderwerp heeft al een Opiniepeiling. De Opiniepeiling van het onderwerp om samen te voegen zal verwijderd worden';
$lang['Merge_confirm_process'] = 'Ben je zeker dat je <br />"<b>%s</b>"<br /> met <br />"<b>%s</b> wil samenvoegen"';
$lang['Merge_topic_done'] = 'De onderwerpen zijn succesvol samengevoegt.';
$lang['Leave_shadow_topic'] = 'Laat een schaduw onderwerp in het oude forum.'; 

?>