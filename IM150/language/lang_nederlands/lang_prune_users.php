<?php 
/****************************************************************
* MOD Title:   Prune users  [Nederlands]
* MOD Version: 1.4.2
* Translation: English
* Rev date:    19/12/2003 
* 
* Translator:  Niels < ncr@db9.dk > (Niels Chr. Rød) http://mods.db9.dk 
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

// add to prune inactive
$lang['X_Days'] = '%d Dagen';
$lang['X_Weeks'] = '%d Weken';
$lang['X_Months'] = '%d Maanden';
$lang['X_Years'] = '%d Jaren';

$lang['Prune_no_users']="Geen gebruikers verwijderd";
$lang['Prune_users_number']="De volgende %d gebruikers zijn verwijderd:";

$lang['Prune_user_list'] = 'Gebruikers die zullen worden verwijderd';
$lang['Prune_on_click'] = 'Je staat op het punt om %d gebruikers te verwijderen. Weet je het zeker?';
$lang['Prune_Action'] = 'Klik op de onderstaande link om te bevestigen';
$lang['Prune_users_explain'] = 'Op deze pagina kun je gebruikers verwijderen. <br />Kies één van de mogelijkheden: <br />oude gebruikers verwijderen die nooit een bericht hebben geplaatst, <br />oude gebruikers verwijderen die nooit hebben ingelogt, <br />gebruikers verwijderen die nooit hun account hebben geactiveerd.<p/><b>Belangrijk!:</b> Je kunt deze bewerking niet ongedaan maken.';
$lang['Prune_commands'] = array();

// here you can make more entries if needed
$lang['Prune_commands'][0] = 'Verwijder niet-plaatsende gebruikers';
$lang['Prune_explain'][0] = 'Gebruikers die nooit een bericht hebben geplaatst, <b>exclusief</b> nieuwe gebruikers van de laatste %d dagen';

$lang['Prune_commands'][1] = 'Verwijder niet actieve gebruikers';
$lang['Prune_explain'][1] = 'Gebruikers die nooit ingelogd hebben, <b>exclusief</b> nieuwe gebruikers van de laatste %d dagen';

$lang['Prune_commands'][2] = 'Verwijder niet actieve gebruikers';
$lang['Prune_explain'][2] = 'Gebruikers die nooit hun account hebben geactiveerd, <b>exclusief</b> nieuwe gebruikers van de laatste %d dagen'; 

$lang['Prune_commands'][3] = 'Verwijder lange-tijd-sinds gebruikers';
$lang['Prune_explain'][3] = 'Gebruikers die de laatste 60 dagen niet hebben ingelogd, <b>exclusief</b> nieuwe gebruikers van de laatste %d dagen';

$lang['Prune_commands'][4] = 'Verwijder gebruikers die niet zovaak berichten plaatsen';
$lang['Prune_explain'][4] = 'Gebruikers die gemiddeld minder dan 1 bericht over 10 dagen plaatsen, <b>exclusief</b> nieuwe gebruikers van de laatste %d dagen'; 
?>
