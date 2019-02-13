<?php
/***************************************************************************
 *						lang_extend_lang_extend.php [English]
 *						-------------------------------------
 *	begin				: 29/09/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 1.0.1 - 16/10/2003
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
	$lang['Lang_extend_lang_extend'] = 'Erweiterung für Sprachpakete';
	$lang['Lang_extend__custom'] = 'Angepasstes Sprachpaket';
	$lang['Lang_extend__phpBB'] = 'phpBB Sprachpaket';

	$lang['Languages'] = 'Sprachpakete';
	$lang['Lang_management'] = 'Management';
	$lang['Lang_extend'] = 'Spracherweiterungen Management';
	$lang['Lang_extend_explain'] = 'Hier kannst du Schlüsseleinträge zu den Sprachen hinzufügen oder bearbeiten.';
	$lang['Lang_extend_pack'] = 'Sprachpaket';
	$lang['Lang_extend_pack_explain'] = 'Dies ist der Name des Sprachpakets, das normalerweise auf den MOD verweisst.';

	$lang['Lang_extend_entry'] = 'Schlüsseleintrag';
	$lang['Lang_extend_entries'] = 'Schlüsseleinträge';
	$lang['Lang_extend_level_admin'] = 'Admin';
	$lang['Lang_extend_level_normal'] = 'Normal';

	$lang['Lang_extend_add_entry'] = 'Füge einen neuen Schlüsseleintrag hinzu';

	$lang['Lang_extend_key_main'] = 'Primär Schlüsseleintrag';
	$lang['Lang_extend_key_main_explain'] = 'Dies ist der HHauptschlüssel, normalerweise der einzigste';
	$lang['Lang_extend_key_sub'] = 'Sekundär Schlüsseleintrag';
	$lang['Lang_extend_key_sub_explain'] = 'Der Sekundäre Schlüsseleintrag wird gewöhlich nicht gebraucht';
	$lang['Lang_extend_level'] = 'Recht des Schlüsseleintrags';
	$lang['Lang_extend_level_explain'] = 'Die Adminrechte können nur im Admin Konigurations-Panel benutzt werden. Normale Rechte können überall benutzt werden.';

	$lang['Lang_extend_missing_value'] = 'Du musst mind. einen Englischen Begriff angeben.';
	$lang['Lang_extend_key_missing'] = 'Der Primäre Schlüsseleintrag wurde nicht angegeben';
	$lang['Lang_extend_duplicate_entry'] = 'Dieser Eintrag existiert bereits (siehe Paket %)';

	$lang['Lang_extend_update_done'] = 'Der Eintrag wurde erfolgreich aktualisiert.<br /><br />Klicke %shier%s um zum Eintrag zurückzukehren.<br /><br />Klicke %shier%s um zu der Eintragsliste zurückkehren';
	$lang['Lang_extend_delete_done'] = 'Der Eintrag wurde erfolgreich gelöscht.<br />Beachte: Nur die angepassten Einträge wurden gelöscht, nicht die Grundeinträge falls vorhanden.<br /><br />Klicke %shier%s um zu der Eintragsliste zurückzukehren';

	$lang['Lang_extend_search'] = 'Suche in den Schlüsseleinträgen';
	$lang['Lang_extend_search_words'] = 'Wörter die gefunden werden';
	$lang['Lang_extend_search_words_explain'] = 'Wörter durch Leertaste trennen';
	$lang['Lang_extend_search_all'] = 'Alle Wörter';
	$lang['Lang_extend_search_one'] = 'Eines dieser';
	$lang['Lang_extend_search_in'] = 'Suche in';
	$lang['Lang_extend_search_in_explain'] = 'Suche genauer definieren';
	$lang['Lang_extend_search_in_key'] = 'Schlüssel';
	$lang['Lang_extend_search_in_value'] = 'Werte';
	$lang['Lang_extend_search_in_both'] = 'Beide';
	$lang['Lang_extend_search_all_lang'] = 'Alle installierten Sprachen';

	$lang['Lang_extend_search_no_words'] = 'No words to search provided.<br /><br />Click %sHere%s to return to the pack list.';
	$lang['Lang_extend_search_results'] = 'Suchergebins';
	$lang['Lang_extend_value'] = 'Wert';
	$lang['Lang_extend_level_leg'] = 'Recht';

	$lang['Lang_extend_added_modified'] = '*';
	$lang['Lang_extend_modified'] = 'Bearbeitet';
	$lang['Lang_extend_added'] = 'Hinzugefügt';
}

?>