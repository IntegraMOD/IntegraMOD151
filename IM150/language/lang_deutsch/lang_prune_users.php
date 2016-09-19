<?php 
/************************************************************* 
* MOD Title:   Prune users
* MOD Version: 1.4.2
* Translation: English
* Rev date:    19/12/2003 
* 
* Translator:  Niels < ncr@db9.dk > (Niels Chr. Rød) http://mods.db9.dk 
* 
**************************************************************/

/***************************************************************************
 *
 *   german translation	:		clanpunisher
 *
 ***************************************************************************/

// add to prune inactive
$lang['X_Days'] = '%d Tage';
$lang['X_Weeks'] = '%d Wochen';
$lang['X_Months'] = '%d Monate';
$lang['X_Years'] = '%d Jahre';

$lang['Prune_no_users']="Keine Benutzer gelöscht";
$lang['Prune_users_number']="Der/die folgende(n) %d Benutzer wurden gelöscht:";

$lang['Prune_user_list'] = 'Benutzer die gelöscht werden';
$lang['Prune_on_click'] = 'Möchtest du wirklich %d Benutzer löschen?';
$lang['Prune_Action'] = 'Zur Ausführung klicke den unteren Link';
$lang['Prune_users_explain'] = 'Auf dieser Seite kannst du inaktive Benutzer löschen. Du kannst einen von 3 möglichen Links ausführen: Lösche alte Benutzer die nie gepostet haben, lösche Benutzer die sich nie eingelogt haben, Lösche Benutzer die ihren Account nicht aktiviert haben.<p/><b>Beachte:</b> Diese Aktionen kannst du nicht mehr rückgängig machen.';
$lang['Prune_commands'] = array();

// here you can make more entries if needed
$lang['Prune_commands'][0] = 'Lösche nicht postende Benutzer';
$lang['Prune_explain'][0] = 'Benutzer die bislang nicht einmal einen Beitrag abgegeben geschrieben haben, mit <b>Ausnahme</b> neuer Benutzer der letzten %d Tage';
$lang['Prune_commands'][1] = 'Lösche nie eingelogte Benutzer';
$lang['Prune_explain'][1] = 'Benutzer die sich noch nie eingelogt haben, mit <b>Ausnahme</b> neuer Benutzer der letzten %d Tage';
$lang['Prune_commands'][2] = 'Lösche nicht aktivierte Accounts';
$lang['Prune_explain'][2] = 'Benutzer deren Account nie aktiviert wurden, mit <b>Ausnahme</b> neuer Benutzer der letzten %d Tage';
$lang['Prune_commands'][3] = 'Lösche offline Benutzer';
$lang['Prune_explain'][3] = 'Benutzer die seit 60 Tagen nicht mehr onlien waren, mit <b>Ausnahme</b> neuer Benutzer der letzten %d Tage';
$lang['Prune_commands'][4] = 'Lösche nicht oft postende Benutzer';
$lang['Prune_explain'][4] = 'Benutzer die im Durchschnitt von 10 Tagen weniger als einen Beitrag haben, mit <b>Ausnahme</b> neuer Benutzer der letzten %d Tage'; 

?>
