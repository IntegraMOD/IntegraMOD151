<?php
/****************************************************************
 *		lang_extend_lang_extend.php [Nederlands]
 *		-------------------------------------
 *	begin				: 29/09/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 1.0.1 - 16/10/2003
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
	$lang['Lang_extend_lang_extend'] = 'Extensie voor taalpakketten';
	$lang['Lang_extend__custom'] = 'Standaard taalpakket';
	$lang['Lang_extend__phpBB'] = 'phpBB taalpakket';

	$lang['Languages'] = 'Talen';
	$lang['Lang_management'] = 'Talen Beheer';
	$lang['Lang_extend'] = 'Uitgebreid talen Beheer';
	$lang['Lang_extend_explain'] = 'Hier kun je sleutelwoorden wijzigen of verwijderen';
	$lang['Lang_extend_pack'] = 'Taalpakket';
	$lang['Lang_extend_pack_explain'] = 'Dit is de naam van het pakket, meestal met de naam van de MOD';

	$lang['Lang_extend_entry'] = 'Sleutelwoord';
	$lang['Lang_extend_entries'] = 'Sleutelwoorden';
	$lang['Lang_extend_level_admin'] = 'Admin';
	$lang['Lang_extend_level_normal'] = 'Normaal';

	$lang['Lang_extend_add_entry'] = 'Voeg een nieuw sleutelwoord toe';

	$lang['Lang_extend_key_main'] = 'Hoofd sleutelwoord';
	$lang['Lang_extend_key_main_explain'] = 'Dit is het hoofdsleutelwoord, meestal de enige';
	$lang['Lang_extend_key_sub'] = 'Tweede sleutelwoord';
	$lang['Lang_extend_key_sub_explain'] = 'Dit is het tweede level sleutelwoord, wordt meestal niet gebruikt ';
	$lang['Lang_extend_level'] = 'Level van het sleutelwoord';
	$lang['Lang_extend_level_explain'] = 'Met een Admin level kan het sleutelwoord alleen gebruikt worden in het Configuratiepaneel. Normaal level kan overal gebruikt worden.';

	$lang['Lang_extend_missing_value'] = 'Je moet tenminste de Engelse waarde invoeren';
	$lang['Lang_extend_key_missing'] = 'Hoofd sleutelwoord ontbreekt';
	$lang['Lang_extend_duplicate_entry'] = 'Dit sleutelwoord bestaat al (zie pakket %s)';

	$lang['Lang_extend_update_done'] = 'Het sleutelwoord is succesvol geupdated.<br /><br />Klik %sHier%s om terug te gaan naar het sleutelwoord.<br /><br />Klik %sHier%s om terug te keren naar de sleutelwoordenlijst';
	$lang['Lang_extend_delete_done'] = 'Het sleutelwoord is succesvol verwijderd.<br />Alleen aangepaste key entries zijn verwijderd, niet de basissleutelwoorden, als deze bestaan.<br /><br />Klik %sHier%s om terug te keren naar de sleutelwoordenlijst';

	$lang['Lang_extend_search'] = 'Zoek in sleutelwoorden';
	$lang['Lang_extend_search_words'] = 'Woorden om te zoeken';
	$lang['Lang_extend_search_words_explain'] = 'Onderscheid woorden met spaties';
	$lang['Lang_extend_search_all'] = 'Alle woorden';
	$lang['Lang_extend_search_one'] = 'Eén van deze';
	$lang['Lang_extend_search_in'] = 'Zoeken in';
	$lang['Lang_extend_search_in_explain'] = 'Zorgt voor nauwkeurigere zoekresultaten';
	$lang['Lang_extend_search_in_key'] = 'sleutelwoorden';
	$lang['Lang_extend_search_in_value'] = 'waarden';
	$lang['Lang_extend_search_in_both'] = 'beide';
	$lang['Lang_extend_search_all_lang'] = 'Alle talen geïnstalleerd';

	$lang['Lang_extend_search_no_words'] = 'Geen zoekresultaten gevonden.<br /><br />Klik %sHier%s om terug te keren naar de talenlijst.';
	$lang['Lang_extend_search_results'] = 'Zoekresultaten';
	$lang['Lang_extend_value'] = 'Waarde';
	$lang['Lang_extend_level_leg'] = 'Niveau';

	$lang['Lang_extend_added_modified'] = '*';
	$lang['Lang_extend_modified'] = 'Gewijzigd';
	$lang['Lang_extend_added'] = 'Toegevoegd';
}

?>