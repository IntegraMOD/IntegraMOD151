<?php
/****************************************************************
 *			lang_extend_post_icons.php [Nederlands]
 *			--------------------------
 *	begin			: 28/09/2003
 *	copyright		: Ptirhiik
 *	email			: ptirhiik@clanmckeen.com
 *
 *	version			: 1.0.1 - 28/10/2003
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
$lang['Lang_extend_post_icons']		= 'Plaats Iconen';

$lang['Icons_settings_explain']		= 'Hier kun je iconen toevoegen, aanpassen of verwijderen';
$lang['Icons_auth']			= 'Toegangs level';
$lang['Icons_auth_explain']		= 'Deze iconen zijn alleen beschikbaar voor gebruikers met de juiste rechten';
$lang['Icons_defaults']			= 'Standaard toewijzingen';
$lang['Icons_defaults_explain']		= 'Deze toewijzingen worden gebruikt bij onderwerpen wanneer geen icoon is ingesteld voor dat bericht';
$lang['Icons_delete']			= 'Verwijder een icoon';
$lang['Icons_delete_explain']		= 'Kies een icoon om het huidige te vervangen :';
$lang['Icons_confirm_delete']		= 'Weet je zeker dat je dit icoon wilt verwijderen ?';

$lang['Icons_lang_key']			= 'Icoon titel';
$lang['Icons_lang_key_explain']		= 'De titel van het icoon wordt weergegeven wanneer de gebruiker met de muis over het icoon gaat (titel of alt HTML statement). Je kunt tekst gebruiken, of een sleutel uit de taalreeks. <br />(check language/lang_<i>jouw_taal</i>/lang_main.php).';
$lang['Icons_icon_key']			= 'Icoon';
$lang['Icons_icon_key_explain']		= 'Icoon url of sleutel naar de plaatjesreeks. <br />(check templates/<i>jouw_template</i>/<i>jouw_template</i>.cfg)';

$lang['Icons_error_title']		= 'De icoontitel is niet ingevoerd';
$lang['Icons_error_del_0']		= 'Je kunt de standaard lege icoon niet verwijderen';

$lang['Refresh']			= 'Herstel';
$lang['Usage']				= 'Gebruik';

$lang['Image_key_pick_up']		= 'Kies een afbeeldingssleutel';
$lang['Lang_key_pick_up']		= 'Kies een taalsleutel';
}

$lang['Icons_settings']			= 'Bericht iconen';
$lang['Icons_per_row']			= 'Iconen per rij';
$lang['Icons_per_row_explain']		= 'Stel hier het aantal iconen in dat per rij wordt getoond';
$lang['post_icon_title']		= 'Icoon titel';
// icons
$lang['icon_none']			= 'Geen icoon';
$lang['icon_note']			= 'Notitie';
$lang['icon_important']			= 'Belangrijk';
$lang['icon_idea']			= 'Idee';
$lang['icon_warning']			= 'Waarschuwing!';
$lang['icon_question']			= 'Vraag';
$lang['icon_cool']			= 'Cool';
$lang['icon_funny']			= 'Grappig';
$lang['icon_angry']			= 'Grrrr!';
$lang['icon_sad']			= 'Snuifje!';
$lang['icon_mocker']			= 'Hehehe !';
$lang['icon_shocked']			= 'Oooh!';
$lang['icon_complicity']		= 'Gecompliceerd';
$lang['icon_bad']			= 'Slecht!';
$lang['icon_great']			= 'Geweldig !';
$lang['icon_disgusting']		= 'Jakkes!';
$lang['icon_winner']			= 'Winnaar!';
$lang['icon_impressed']			= 'Oh ja!';
$lang['icon_roleplay']			= 'Rollenspel';
$lang['icon_fight']			= 'Vecht';
$lang['icon_loot']			= 'Buit';
$lang['icon_picture']			= 'Plaatje';
$lang['icon_calendar']			= 'Kalender gebeurtenis';

?>