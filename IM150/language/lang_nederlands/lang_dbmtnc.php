<?php
/**************************************************************
 *                            lang_dbmtnc.php [Nederlands]
 *                              -------------------
 *   begin                : Fri Feb 07, 2003
 *   copyright            : (C) 2004 Philipp Kordowich
 *                          Parts: (C) 2002 The phpBB Group
 *
 *   part of DB Maintenance Mod 1.2.2
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


//
// Language file for DB Maintenance Mod
//

$lang['DB_Maintenance'] = 'Database Onderhoud';
$lang['DB_Maintenance_Description'] = 'Hier kun je je database op inconsistenties en fouten controleren.<br />
	<b>Let op:</b> Sommige bewerkingen hebben langere tijd nodig om uitgevoerd te worden. Gedurende deze bewerkingen zal je board <b>gesloten</b> worden voor je gebruikers.</br />
	<br />
	<b>Voordat je &eacute;&eacute;n van de functies hieronder gaat gebruiken, dien je <u>een backup</u> van je database te maken!</b>';
$lang['Function'] = 'Functie';
$lang['Function_Description'] = 'Omschrijving';

$lang['Incomplete_configuration'] = 'Er mist een instelling voor <b>%s</b> in de board configuratie. Zonder deze instellingen kan er geen DB onderhoud plaatsvinden.<br />
	Misschien ben je vergeten de SQL bewerkingen uit te voeren zoals die beschreven staan in de installatie handleiding.';
$lang['dbtype_not_supported'] = 'Sorry, deze functie wordt niet ondersteund door jouw database';
$lang['no_function_specified'] = 'Geen functie geselecteerd';
$lang['function_unknown'] = 'De opgegeven functie is onbekend';
$lang['Old_MySQL_Version'] = 'Sorry, jouw MySQL-Versie ondersteunt deze functie niet. Hiervoor is versie 3.23.17 of nieuwer vereist.';

$lang['Back_to_DB_Maintenance'] = 'Terug naar Database Onderhoud';
$lang['Processing_time'] = 'De bewerkingen van DB onderhoud namen %f seconden in beslag';

$lang['Lock_db'] = 'Board uitschakelen';
$lang['Unlock_db'] = 'Board inschakelen';
$lang['Already_locked'] = 'Board is al uitgeschakeld';
$lang['Ignore_unlock_command'] = 'Aan het begin van deze bewerking werd je board uitgeschakeld. Het board zal niet worden ingeschakeld';
$lang['Delay_info'] = 'Vertraging van drie seconden om database bewerkingen af te ronden...';

$lang['Affected_row'] = 'E&eacute;n be&iuml;nvloede dataset';
$lang['Affected_rows'] = '%d be&iuml;nvloede datasets';
$lang['Done'] = 'Gereed';
// The following variable is used when nothing hat to be fixed in the database. It needs the complete paragraph-tag.
// If you do not want a message to be displayed in these cases, just leave the variable empty.
$lang['Nothing_to_do'] = "<p class=\"gen\"><i>Niets te doen :-)</i></p>\n";

//
// Names for new records in several tables
//
$lang['New_cat_name'] = 'Herstelde forums';
$lang['New_forum_name'] = 'Herstelde onderwerpen';
$lang['New_topic_name'] = 'Herstelde berichten';
$lang['Restored_topic_name'] = 'Hersteld onderwerp';
$lang['New_poster_name'] = 'Hersteld bericht'; // Name for Poster of a restored post

//
// Functions available
//
// Usage: $mtnc[] = array(internal Name, Name of Function, Description of Function, Warning Message (leef empty to avoid), Number of Check function (Integer))
// Use $mtnc[] = array('--', '', '', '', 0) for a space row (you can us a different check function)
//
$mtnc[] = array('statistic',
	'Statistieken',
	'Toont informatie over het board en de database.',
	'',
	0);
$mtnc[] = array('config',
	'Configuratie',
	'Toegang tot de configuratie van DB Onderhoud.',
	'',
	5);
$mtnc[] = array('--', '', '', '', 0);
$mtnc[] = array('check_user',
	'Controleer gebruikers en groepen tabellen',
	'Hiermee kun je de gebruikers en groepen tabellen controleren op fouten en zullen missende enkelvoudige gebruikersgroepen worden hersteld.',
	'Groepen zonder leden zullen hierdoor verloren gaan. Wilt u doorgaan?',
	0);
$mtnc[] = array('check_post',
	'Controleer berichten en onderwerpen tabellen',
	'Hiermee kun je de berichten en onderwerpen tabellen controleren op fouten.',
	'Berichten zonder tekst zullen hierdoor verloren gaan. Wilt u doorgaan?',
	0);
$mtnc[] = array('check_vote',
	'Controleer opiniepeiling tabellen',
	'Hiermee kun je de opiniepeiling tabellen controleren op fouten.',
	'Opiniepeiling gegevens zonder overeenkomstige stem zullen hierdoor verloren gaan. Wilt u doorgaan?',
	0);
$mtnc[] = array('check_pm',
	'Controleer priv&eacute; berichten tabellen',
	'Hiermee kun je de priv&eacute; berichten tabellen controleren op fouten.',
	'Ongelezen berichten zullen worden verwijderd wanneer of de afzender of de ontvanger niet bestaat. Wilt u doorgaan?',
	0);
$mtnc[] = array('--', '', '', '', 0);
$mtnc[] = array('check_search_wordmatch',
	'Controleer de word_match tabel van de zoekfunctie',
	'Hiermee kun je de word_match tabel van de zoekfunctie controlen op fouten.',
	'',
	0);
$mtnc[] = array('check_search_wordlist',
	'Controleer de word_list tabel van de zoekfunctie',
	'Hiermee kun je alle overbodige woorden uit de word_list tabel van de zoekfunctie verwijderen.',
	'Deze bewerking kan enige tijd in beslag nemen. Deze controle is niet noodzakelijk, maar kan de grootte van de database wellicht wat reduceren. Wilt u doorgaan?',
	0);
$mtnc[] = array('--', '', '', '', 0);
$mtnc[] = array('synchronize_post',
	'Synchroniseer forums en onderwerpen',
	'Hiermee kun je de berichtentellers en de berichtgegevens in de forums en onderwerpen synchroniseren.',
	'Deze bewerking kan enige tijd in beslag nemen. Als je server het gebruik van het set_time_limit() commando niet toestaat, kan dit commando onderbroken worden door PHP. Hierdoor zullen er geen gegevens verloren gaan, maar sommige gegevens worden wellicht niet bijgewerkt. Wilt u doorgaan?',
	0);
$mtnc[] = array('synchronize_user',
	'Synchroniseer berichtentellers van gebruikers',
	'Hiermee kun je de berichtentellers van de gebruikers synchroniseren.',
	'<b>Let op:</b> Verwijderde berichten worden gewoonlijk niet van het totaal aantal berichten afgetrokken. Door deze bewerking zal het aantal verwijderde berichten afgetrokken worden van het berichtentotaal. Dit kan niet ongedaan worden gemaakt. Wilt u doorgaan?',
	6);
$mtnc[] = array('synchronize_mod_state',
	'Synchroniseer moderator status',
	'Hiermee kun je de moderator status in de gebruiker tabel synchroniseren.',
	'',
	0);
$mtnc[] = array('--', '', '', '', 0);
$mtnc[] = array('reset_date',
	'Reset datum laatste bericht',
	'Hiermee kun je de datum van het laatste bericht resetten wanneer deze in de toekomst ligt. Het probleem van gebruikers, die een bericht krijgen dat ze niet zo snel na het vorige bericht een nieuw bericht kunnen plaatsen, wordt hierdoor opgelost.',
	'Alle datums van berichten in de toekomst zullen worden gereset naar de huidige datum en tijd. Wilt u doorgaan?',
	0);
$mtnc[] = array('reset_sessions',
	'Reset alle sessies',
	'Hiermee kun je alle huidige sessies resetten door de sessie tabel te legen.',
	'Alle huidige gebruikers zullen hun sessie en eventuele zoekresultaten verliezen. Wilt u doorgaan?',
	0);
$mtnc[] = array('--', '', '', '', 8);
$mtnc[] = array('rebuild_search_index',
	'Opnieuw zoek index opbouwen',
	'Hiermee kun je de volledige index voor de zoekfunctie opnieuw opbouwen. Onder normale omstandigheden heb je deze functie niet nodig.',
	'De volledige zoek index zal verwijderd en opnieuw opgebouwd worden. Deze bewerking kan enkele uren in beslag nemen. Tijdens de bewerking zal het board uitgeschakeld zijn. Wilt u doorgaan?',
	7);
$mtnc[] = array('proceed_rebuilding',
	'Herstart zoek index opbouwen',
	'Gebruik deze functie wanneer de opbouw van de zoek index onderbroken werd.',
	'',
	4);
$mtnc[] = array('--', '', '', '', 1);
$mtnc[] = array('check_db',
	'Controleer database',
	'Hiermee kun je de database controleren op fouten.',
	'',
	1);
$mtnc[] = array('optimize_db',
	'Optimaliseer database',
	'Hiermee kun je de tabellen optimaliseren. Door verwijdering van overbodige gegevens zal de grootte van de database gereduceerd worden.',
	'',
	1);
$mtnc[] = array('repair_db',
	'Repareer database',
	'Hiermee kun je de database repareren wanneer er een fout is aangetroffen.',
	'Voer deze bewerking alleen uit wanneer er een fout is aangetroffen bij het controleren van de database. Wilt u doorgaan?',
	1);
$mtnc[] = array('--', '', '', '', 0);
$mtnc[] = array('reset_auto_increment',
	'Reset auto increment waarden',
	'Hiermee kun je de auto increment waarden resetten. Deze bewerking moet alleen worden uitgevoerd wanneer er een probleem is bij het invoeren van nieuwe gegevens in de tabellen.',
	'Weet je zeker dat je de auto increment waarden wilt resetten? Er zullen geen gegevens verloren gaan door deze bewerking, maar hij moet enkel gebruikt worden wanneer dit noodzakelijk is. Wilt u doorgaan?',
	0);
$mtnc[] = array('heap_convert',
	'Converteer sessie tabel',
	'Hiermee kun je de sessie tabel converteren naar het HEAP tabel type. Dit zal gewoonlijk gedurende de installatie gedaan worden en phpBB wat sneller maken. Je zou deze functie moeten gebruiken wanneer de sessie tabel niet van het HEAP tabel type is.',
	'Weet je zeker dat je de sessie tabel wilt converteren?',
	2);
$mtnc[] = array('--', '', '', '', 3);
$mtnc[] = array('unlock_db',
	'Schakel het board weer in',
	'Hiermee kun je je board weer inschakelen wanneer er gedurende &eacute;&eacute;n van bovenstaande bewerkingen een fout is opgetreden en het board nog uitgeschakeld is.',
	'',
	3);

//
// Function specific vars
//

// statistic
$lang['Statistic_title'] = 'Board en database statistieken';
$lang['Database_table_info'] = 'Database statistieken toont drie verschillende waarden: 
1) Voor alle tabellen van de database; 
2) Voor alle standaard phpBB tabellen (kern tabellen) en 
3) Voor alle tabellen die beginnen met de prefix van de board tabellen (geavanceerde tabellen).';
$lang['Board_statistic'] = 'Board statistieken';
$lang['Database_statistic'] = 'Database statistieken';
$lang['Version_info'] = 'Versie informatie';
$lang['Thereof_deactivated_users'] = 'aantal inactief';
$lang['Thereof_Moderators'] = 'aantal moderators';
$lang['Thereof_Administrators'] = 'aantal administrators';
$lang['Users_with_Admin_Privileges'] = 'gebruikers met admin rechten';
$lang['Number_tables'] = 'Aantal Tabellen';
$lang['Number_records'] = 'Aantal Records';
$lang['DB_size'] = 'Grootte van de Database';
$lang['Thereof_phpbb_core'] = 'aantal phpBB kern tabellen';
$lang['Thereof_phpbb_advanced'] = 'aantal geavanceerde phpBB tabellen';
$lang['Version_of_board'] = 'Board versie';
$lang['Version_of_mod'] = 'DB Maintenance versie';
$lang['Version_of_PHP'] = 'PHP versie';
$lang['Version_of_MySQL'] = 'MySQL versie';
// config
$lang['Config_title'] = 'DB Onderhoud Configuratie';
$lang['Config_info'] = 'Met de nu volgende opties kun je het gedrag van DB onderhoud configureren. Houd alsjeblieft in gedachte dat een verkeerde configuratie kan leiden tot onverwachte resultaten.';
$lang['General_Config'] = 'Algemene configuratie';
$lang['Rebuild_Config'] = 'Configuratie voor heropbouw van de zoek index';
$lang['Current_Rebuild_Config'] = 'Configuratie van huidige heropbouw';
$lang['Rebuild_Settings_Explain'] = 'Deze instellingen passen het gedrag van DB Onderhoud aan waneer de zoek index opnieuw wordt opgebouwd.';
$lang['Current_Rebuild_Settings_Explain'] = 'Deze instellingen worden door DB Onderhoud gebruikt om de positie van de huidige heropbouw op te slaan. Onder normale omstandigheden is het niet nodig deze instellingen te wijzigen.';
$lang['Disallow_postcounter'] = 'Sta synchronisatie van berichtentellers gebruikers niet toe';
$lang['Disallow_postcounter_Explain'] = 'Hierdoor zal de functie voor het synchroniseren van berichtentellers van gebruikers uitgeschakeld worden. Je kunt deze functie uitschakelen wanneer je niet wilt dat het aantal verwijderde berichten wordt afgetrokken van het totaal aantal berichten van de individuele gebruikers.';
$lang['Disallow_rebuild'] = 'Sta het vernieuwen van de zoek index niet toe';
$lang['Disallow_rebuild_Explain'] = 'Hierdoor zal de functie voor het opnieuw opbouwen van de zoek index uitgeschakeld worden. Een onderbroken heropbouw kan echter worden voortgezet.';
$lang['Rebuildcfg_Timelimit'] = 'Maximale bewerkingstijd voor de heropbouw (in seconden)';
$lang['Rebuildcfg_Timelimit_Explain'] = 'Maximale bewerkingstijd voor &eacute;&eacute;n stap tijdens de heropbouw (standaard: 240). Deze waarde limiteert de bewerkingstijd, zelfs als deze langer zou kunnen zijn.';
$lang['Rebuildcfg_Timeoverwrite'] = 'Vastgestelde tijdsduur voor bewerking (in seconden)';
$lang['Rebuildcfg_Timeoverwrite_Explain'] = 'Vastgestelde beschikbare geschatte tijdsduur voor bewerking (standaard: 0). Bij 0 wordt het resultaat van de berekening gebruikt als bewerkingstijd. Elke andere waarde overschrijft de berekende waarde.';
$lang['Rebuildcfg_Maxmemory'] = 'Maximale berichtgrootte voor heropbouw (in kB)';
$lang['Rebuildcfg_Maxmemory_Explain'] = 'Maximale berichtgrootte die in &eacute;&eacute;n stap wordt ge&iuml;ndexeerd (standaard: 500). Wanneer het totaal van de berichten deze waarde overschrijdt, zullen er in de huidige stap geen verdere berichten worden ge&iuml;ndexeerd.';
$lang['Rebuildcfg_Minposts'] = 'Minimum aantal berichten dat per stap wordt ge&iuml;ndexeerd';
$lang['Rebuildcfg_Minposts_Explain'] = 'Minimum aantal berichten dat per stap wordt ge&iuml;ndexeerd (standaard: 3). Definieert het aantal berichten dat op zijn minst wordt ge&iuml;ndexeerd per stap.';
$lang['Rebuildcfg_PHP3Only'] = 'Gebruik een standaard PHP 3 compatible indexeringsmethode';
$lang['Rebuildcfg_PHP3Only_Explain'] = 'DB Onderhoud gebruikt een geavanceerde indexeringsmethode wanneer PHP 4.0.5 of nieuwer beschikbaar is. Je kunt deze geavanceerde methode uitschakelen, zodat DB Onderhoud gebruik zal maken van de standaardmethode van het board.';
$lang['Rebuildcfg_PHP4PPS'] = 'Aantal ge&iuml;ndexeerde berichten per seconde (bij gebruik van de geavanceerde indexeringsmethode)';
$lang['Rebuildcfg_PHP4PPS_Explain'] = 'Geschatte aantal berichten dat per seconde ge&iuml;ndexeerd kan worden wanneer er gebruik wordt gemaakt van de geavanceerde indexeringsmethode (standaard: 8).';
$lang['Rebuildcfg_PHP3PPS'] = 'Aantal ge&iuml;ndexeerde berichten per seconde (bij gebruik van de standaard indexeringsmethode)';
$lang['Rebuildcfg_PHP3PPS_Explain'] = 'Geschatte aantal berichten dat per seconde ge&iuml;ndexeerd kan worden wanneer er gebruik wordt gemaakt van de standaard indexeringsmethode (standaard: 1).';
$lang['Rebuild_Pos'] = 'Laatst ge&iuml;ndexeerde bericht';
$lang['Rebuild_Pos_Explain'] = 'ID van het laatste succesvol ge&iuml;ndexeerde bericht. Staat op -1 wanneer de heropbouw gereed is.';
$lang['Rebuild_End'] = 'Laatste bericht om te indexeren';
$lang['Rebuild_End_Explain'] = 'ID van het laatste bericht dat ge&iuml;ndexeerd moet worden. Staat op 0 wanneer de heropbouw gereed is.';
$lang['Dbmtnc_config_updated'] = 'Configuratie succesvol bijgewerkt';
$lang['Click_return_dbmtnc_config'] = 'Klik %sHier%s om terug te gaan naar DB Onderhoud Configuratie';
// check_user
$lang['Checking_user_tables'] = 'Controleert gebruikers en groepen tabellen';
$lang['Checking_missing_anonymous'] = 'Controleert of de anonieme account mist';
$lang['Anonymous_recreated'] = 'Anoniem account opnieuw aangemaakt';
$lang['Checking_incorrect_pending_information'] = 'Controleert op onjuiste zwevende informatie';
$lang['Updating_invalid_pendig_user'] = 'Onjuist zwevende informatie van &eacute;&eacute;n gebruiker bijgewerkt';
$lang['Updating_invalid_pendig_users'] = 'Onjuist zwevende informatie van %d gebruikers bijgewerkt';
$lang['Updating_pending_information'] = 'Werkt zwevende informatie van enkelvoudige gebruikersgroepen bij';
$lang['Checking_missing_user_groups'] = 'Controleert op gebruikers met meerdere en geen enkele gebruikersgroep';
$lang['Found_multiple_SUG'] = 'Gebruikers met meerdere enkelvoudige gebruikersgroepen gevonden';
$lang['Resolving_user_id'] = 'Wijst gebruikers toe aan groep';
$lang['Removing_groups'] = 'Verplaatst groepen';
$lang['Removing_user_groups'] = 'Verplaatst gebruiker naar groep connectie';
$lang['Recreating_SUG'] = 'Maakt enkelvoudige gebruikersgroep voor gebruiker aan';
$lang['Checking_for_invalid_moderators'] = 'Controleert op ongeldige groepsmoderatie instellingen';
$lang['Updating_Moderator'] = 'Stelt huidige gebruiker in als moderator voor de groep';
$lang['Checking_moderator_membership'] = 'Controleert groepslidmaatschap van moderators';
$lang['Updating_mod_membership'] = 'Werkt lidmaatschappen van groepsmoderators bij';
$lang['Moderator_added'] = 'Moderator toegevoegd aan groep';
$lang['Moderator_changed_pending'] = 'Zwevende status van moderator gewijzigd';
$lang['Remove_invalid_user_data'] = 'Verwijdert ongeldige gebruikersgegevens uit gebruikersgroepen tabel';
$lang['Remove_empty_groups'] = 'Verwijdert lege groepen';
$lang['Remove_invalid_group_data'] = 'Verwijdert ongeldige groepsgegevens uit gebruikersgroepen tabel';
$lang['Checking_ranks'] = 'Controleert op ongeldige rangen';
$lang['Invalid_ranks_found'] = 'Gebruikers met ongeldige rangen gevonden';
$lang['Removing_invalid_ranks'] = 'Verwijdert ongeldige rangen';
$lang['Checking_themes'] = 'Controleert op ongeldige thema instellingen';
$lang['Updating_users_without_style'] = 'Werkt gebruikers bij die geen thema gekozen hebben';
$lang['Default_theme_invalid'] = '<b>Let op:</b> De standaard stijl is ongeldig. Controleer uw instellingen.';
$lang['Updating_themes'] = 'Werkt ongeldige thema\'s bij naar %d thema';
$lang['Checking_theme_names'] = 'Controleert op ongeldige themanamen gegevens';
$lang['Removing_invalid_theme_names'] = 'Verwijdert ongeldige themanamen gegevens';
$lang['Checking_languages'] = 'Controleert op ongeldige taal instellingen';
$lang['Invalid_languages_found'] = 'Gebruikers gevonden met ongeldige taal instellingen';
$lang['Default_language_invalid'] = '<b>Let op:</b> De standaard taal is ongeldig. Controleer uw instellingen.';
$lang['English_language_invalid'] = '<b>Let op:</b> De standaard taal is ongeldig en de engelse taalbestanden bestaan niet. Je moet de <b>lang_english</b> bestanden terugplaatsen in de juiste directory.';
$lang['Changing_language'] = 'Wijzigt taal van \'%s\' naar \'%s\'';
$lang['Remove_invalid_ban_data'] = 'Verwijdert ongeldige ban gegevens';
// check_post
$lang['Checking_post_tables'] = 'Controleert bericht en onderwerp tabellen';
$lang['Checking_invalid_forums'] = 'Controleert op forums met een ongeldige categorie';
$lang['Invalid_forums_found'] = 'Forums met ongeldige categorie gevonden';
$lang['Setting_category'] = 'Verplaatst forums naar de categorie \'%s\'';
$lang['Checking_posts_wo_text'] = 'Controleert op berichten zonder tekst';
$lang['Posts_wo_text_found'] = 'Berichten zonder tekst gevonden';
$lang['Deleting_post_wo_text'] = '%d (Onderwerp: %s (%d); Gebruiker: %s (%d))';
$lang['Deleting_Posts'] = 'Verwijdert berichtgegevens';
$lang['Checking_topics_wo_post'] = 'Controleert op onderwerpen zonder berichten';
$lang['Topics_wo_post_found'] = 'Onderwerpen zonder berichten gevonden';
$lang['Deleting_topics'] = 'Verwijdert onderwerpgegevens';
$lang['Checking_invalid_topics'] = 'Controleert op onderwerpen met ongeldig forum';
$lang['Invalid_topics_found'] = 'Onderwerpen met ongeldig forum gevonden';
$lang['Setting_forum'] = 'Verplaatst onderwerp naar het forum \'%s\'';
$lang['Checking_invalid_posts'] = 'Controleert op berichten met ongeldig onderwerp';
$lang['Invalid_posts_found'] = 'Berichten met ongeldig onderwerp gevonden';
$lang['Setting_topic'] = 'Verplaatst berichten %s naar het onderwerp \'%s\' (%d) in het forum \'%s\'';
$lang['Checking_invalid_forums_posts'] = 'Controleert op berichten met ongeldig forum';
$lang['Invalid_forum_posts_found'] = 'Berichten met ongeldig forum gevonden';
$lang['Setting_post_forum'] = '%d: Verplaatst van het forum \'%s\' (%d) naar \'%s\' (%d)';
$lang['Checking_texts_wo_post'] = 'Controleert op berichtteksten zonder bericht';
$lang['Invalid_texts_found'] = 'Berichtteksten zonder bericht gevonden';
$lang['Recreating_post'] = 'Maakt bericht %d opnieuw aan en verplaatst het naar onderwerp \'%s\' in het forum \'%s\'<br />Extract: %s';
$lang['Checking_invalid_topic_posters'] = 'Controleert onderwerpen op ongeldige plaatsers';
$lang['Invalid_topic_poster_found'] = 'Onderwerpen met ongeldige plaatsers gevonden';
$lang['Updating_topic'] = 'Werkt het onderwerp %d bij (Plaatser: %d -&gt; %d)';
$lang['Checking_invalid_posters'] = 'Controleert op berichten van ongeldige plaatser';
$lang['Invalid_poster_found'] = 'Berichten van ongeldige plaatser gevonden';
$lang['Updating_posts'] = 'Werkt berichten bij';
$lang['Checking_moved_topics'] = 'Controleert op verplaatste onderwerpen';
$lang['Deleting_invalid_moved_topics'] = 'Verwijdert ongeldige verplaatste onderwerpen';
$lang['Updating_invalid_moved_topic'] = 'Werkt ongeldige verplaats informatie voor een niet verplaatst onderwerp bij';
$lang['Updating_invalid_moved_topics'] = 'Werkt ongeldige verplaatst informatie voor %d niet verplaatste onderwerpen bij';
$lang['Checking_prune_settings'] = 'Controleert op ongeldige prune gegevens';
$lang['Removing_invalid_prune_settings'] = 'Verwijdert ongeldige prune instellingen';
$lang['Updating_invalid_prune_setting'] = 'Werkt ongeldige prune instellingen van een forum bij';
$lang['Updating_invalid_prune_settings'] = 'Werkt ongeldige prune instellingen van %d forums bij';
$lang['Checking_topic_watch_data'] = 'Controleert op ongeldig gevolgde onderwerpen';
$lang['Checking_auth_access_data'] = 'Controleert op ongeldige groepsautorisatie gegevens';
$lang['Must_synchronize'] = 'U moet de berichtgegevens synchroniseren alvorens het Board te gebruiken. Klik om verder te gaan.';
// check_vote
$lang['Checking_vote_tables'] = 'Controleert opiniepeiling tabellen';
$lang['Checking_votes_wo_topic'] = 'Controleert op stemmen zonder overeenkomstig onderwerp';
$lang['Votes_wo_topic_found'] = 'Stemmen zonder overeenkomstig onderwerp gevonden';
$lang['Invalid_vote'] = '%s (%d) - Start datum: %s - Eind datum: %s';
$lang['Deleting_votes'] = 'Verwijdert stemmen';
$lang['Checking_votes_wo_result'] = 'Controleert op stemmen zonder enig resultaat';
$lang['Votes_wo_result_found'] = 'Stemmen zonder enig resultaat gevonden';
$lang['Checking_topics_vote_data'] = 'Controleert op stemgegevens in onderwerp tabellen';
$lang['Updating_topics_wo_vote'] = 'Werkt onderwerpen gemarkeerd als stem, maar zonder een overeenkomstige stem bij';
$lang['Updating_topics_w_vote'] = 'Werkt onderwerpen die niet gemarkeerd zijn als stem, maar wel een overeenkomstige stem hebben, bij';
$lang['Checking_results_wo_vote'] = 'Controleert op resultaten zonder overeenkomstige stem';
$lang['Results_wo_vote_found'] = 'Resultaten zonder overeenkomstige stem gevonden';
$lang['Invalid_result'] = 'Verwijdert resultaat: %s (Stem: %d)';
$lang['Checking_voters_data'] = 'Controleert op ongeldige stemgegevens';
// check_pm
$lang['Checking_pm_tables'] = 'Controleert priv&eacute; berichten tabellen';
$lang['Checking_pms_wo_text'] = 'Controleert op priv&eacute; berichten zonder tekst';
$lang['Pms_wo_text_found'] = 'Priv&eacute; berichten zonder tekst gevonden';
$lang['Deleting_pn_wo_text'] = '%d (Onderwerp: %s; Afzender: %s (%d); Ontvanger: %s (%d))';
$lang['Deleting_Pms'] = 'Verwijdert priv&eacute; bericht gegevens';
$lang['Checking_texts_wo_pm'] = 'Controleert op priv&eacute; bericht teksten zonder bericht';
$lang['Deleting_pm_texts'] = 'Verwijdert ongeldige priv&eacute; bericht teksten';
$lang['Checking_invalid_pm_senders'] = 'Controleert op priv&eacute; berichten met ongeldige afzender';
$lang['Invalid_pm_senders_found'] = 'Priv&eacute; berichten met ongeldige afzender gevonden';
$lang['Updating_pms'] = 'Werkt priv&eacute; berichten bij';
$lang['Checking_invalid_pm_recipients'] = 'Controleert op priv&eacute; berichten met ongeldige ontvanger';
$lang['Invalid_pm_recipients_found'] = 'Priv&eacute; berichten met ongeldige ontvanger gevonden';
$lang['Checking_pm_deleted_users'] = 'Controleert op priv&eacute; berichten met verwijderde afzenders of ontvangers';
$lang['Invalid_pm_users_found'] = 'Priv&eacute; berichten met verwijderde afzenders of ontvangers gevonden';
$lang['Deleting_pms'] = 'Verwijdert priv&eacute; berichten';
$lang['Synchronize_new_pm_data'] = 'Synchroniseert teller voor nieuwe priv&eacute; berichten';
$lang['Synchronizing_users'] = 'Werkt gebruikers bij';
$lang['Synchronizing_user'] = 'Werkt gebruiker %s (%d) bij';
$lang['Synchronize_unread_pm_data'] = 'Synchroniseert teller voor ongelezen priv&eacute; berichten';
// check_search_wordmatch
$lang['Checking_search_wordmatch_tables'] = 'Controleert de word_match tabel';
$lang['Checking_search_data'] = 'Controleert op ongeldige zoek gegevens';
// check_search_wordlist
$lang['Checking_search_wordlist_tables'] = 'Controleert de word_list tabel';
$lang['Checking_search_words'] = 'Controleert op overbodige zoekwoorden';
$lang['Removing_part_invalid_words'] = 'Verwijdert een deel van de onnodige zoekwoorden';
$lang['Removing_invalid_words'] = 'Verwijdert onnodige zoekwoorden';
// rebuild_search_index
$lang['Rebuilding_search_index'] = 'Vernieuwt de zoek index';
$lang['Deleting_search_tables'] = 'Leegt de zoek tabellen';
$lang['Reset_search_autoincrement'] = 'Reset de teller van de zoek tabellen';
$lang['Preparing_config_data'] = 'Stelt de configuratiegegevens in';
$lang['Can_start_rebuilding'] = 'U kunt nu starten met de herbouw van de zoekindex';
$lang['Click_once_warning'] = '<b>Klik slechts eenmaal op de link!</b> - Het kan enkele minuten duren voordat een nieuwe pagina wordt getoond.';
// proceed_rebuilding
$lang['Preparing_to_proceed'] = 'Bereid de tabellen voor om de bewerking te kunnen vervolgen';
$lang['Preparing_search_tables'] = 'Bereid de zoektabellen voor om de bewerking te kunnen vervolgen';
// perform_rebuild
$lang['Click_or_wait_to_proceed'] = 'Klik hier om verder te gaan of wacht enkele seconden';
$lang['Indexing_progress'] = '%d van de %d berichten (%01.1f%%) zijn ge&iuml;ndexeerd. Laatst ge&iuml;ndexeerde bericht: %d';
$lang['Indexing_finished'] = 'Vernieuwen van de zoekindex is succesvol beëindigd';
// synchronize_post
$lang['Synchronize_posts'] = 'Synchroniseert berichtgegevens';
$lang['Synchronize_topic_data'] = 'Synchroniseert onderwerpen';
$lang['Synchronizing_topics'] = 'Werkt onderwerpen bij';
$lang['Synchronizing_topic'] = 'Werkt onderwerp %d (%s) bij';
$lang['Synchronize_moved_topic_data'] = 'Synchroniseert verplaatste onderwerpen';
$lang['Inconsistencies_found'] = 'Er zijn inconsistenties in uw database gevonden. Controleer %sde bericht en onderwerp tabellen%s';
$lang['Synchronizing_moved_topics'] = 'Werkt verplaatste onderwerpen bij';
$lang['Synchronizing_moved_topic'] = 'Werkt verplaatst onderwerp %d -&gt; %d (%s) bij';
$lang['Synchronize_forum_topic_data'] = 'Synchroniseert onderwerpgegevens van de forums';
$lang['Synchronizing_forums'] = 'Werkt de forums bij';
$lang['Synchronizing_forum'] = 'Werkt forum %d (%s) bij';
$lang['Synchronize_forum_data_wo_topic'] = 'Synchroniseert forums zonder onderwerpen';
$lang['Synchronize_forum_post_data'] = 'Synchroniseert berichtgegevens van de forums';
$lang['Synchronize_forum_data_wo_post'] = 'Synchroniseert forums zonder berichten';
// synchronize_user
$lang['Synchronize_post_counters'] = 'Synchroniseert berichtentellers';
$lang['Synchronize_user_post_counter'] = 'Synchroniseert berichtenteller van gebruiker';
$lang['Synchronizing_user_counter'] = 'Werkt gebruiker %s (%d): %d -&gt; %d bij';
// synchronize_mod_state
$lang['Synchronize_moderators'] = 'Synchroniseert moderator status in gebruikerstabel';
$lang['Getting_moderators'] = 'Geeft moderators weer';
$lang['Checking_non_moderators'] = 'Controleert gebruikers met moderator status die geen enkel forum modereren';
$lang['Updating_mod_state'] = 'Werkt moderator status van gebruikers bij';
$lang['Changing_moderator_status'] = 'Wijzigt moderator status van gebruiker %s (%d)';
$lang['Checking_moderators'] = 'Controleert gebruikers zonder moderator status die een forum modereren';
// reset_date
$lang['Resetting_future_post_dates'] = 'Reset de laatste berichtdata die in de toekomst liggen';
$lang['Checking_post_dates'] = 'Controleert datum van berichten';
$lang['Checking_pm_dates'] = 'Controleert datum van priv&eacute; berichten';
$lang['Checking_email_dates'] = 'Controleert datum van laatste e-mail';
// reset_sessions
$lang['Resetting_sessions'] = 'Reset sessies';
$lang['Deleting_session_tables'] = 'Leegt sessie en zoekresultaat tabellen';
$lang['Restoring_session'] = 'Herstelt de sessie van een actieve gebruiker';
// check_db
$lang['Checking_db'] = 'Controleert de database';
$lang['Checking_tables'] = 'Controleert de tabellen';
$lang['Table_OK'] = 'OK';
$lang['Table_HEAP_info'] = 'Commando niet toepasbaar op HEAP tabellen';
// repair_db
$lang['Repairing_db'] = 'Repareert de database';
$lang['Repairing_tables'] = 'Repareert de tabellen';
// optimize_db
$lang['Optimizing_db'] = 'Optimaliseert de database';
$lang['Optimizing_tables'] = 'Optimaliseert de tabellen';
$lang['Optimization_statistic'] = 'Optimalisatie reduceerde de grootte van de tabellen van %s naar %s. Dat is een vermindering van %s of %01.2f%%.';
// reset_auto_increment
$lang['Reset_ai'] = 'Verwijderen auto increment waarden';
$lang['Ai_message_update_table'] = 'Tabel bijgewerkt';
$lang['Ai_message_no_update'] = 'Bijwerken van tabellen niet nodig';
$lang['Ai_message_update_table_old_mysql'] = 'Tabel bijgewerkt'; // Used if an old version of MySQL is used which does not allow a table check before updating the table
// heap_convert
$lang['Converting_heap'] = 'Converteert sessie tabel naar HEAP';
// unlock_db
$lang['Unlocking_db'] = 'Ontgrendeld de database';

// Emergency Recovery Console
$lang['Forum_Home'] = 'Forum Home';
$lang['ERC'] = 'Nood Herstel Console';
$lang['Submit_text'] = 'Verzenden';
$lang['Select_Language'] = 'Selecteer een taal';
$lang['No_selectable_language'] = 'Geen selecteerbare taal aanwezig';
$lang['Select_Option'] = 'Selecteer een optie';
$lang['Option_Help'] = 'Hulp bij de opties';
$lang['Authenticate_methods'] = 'Er zijn twee manieren om je te autoriseren';
$lang['Authenticate_methods_help_text'] = 'Je moet je autoriseren om de board configuratie te kunnen wijzigen. Er zijn twee manieren om dit te doen:
	1) Je kunt je autoriseren met de naam en het wachtwoord van een actief beheerder account op het board (deze methode heeft de voorkeur). 
	2) Je kunt je autoriseren met de naam en het wachtwoord van de database account die door het board gebruikt wordt om toegang te krijgen tot de database.';
$lang['Authenticate_user_only'] = 'Je moet je autoriseren met een actief beheerder account';
$lang['Authenticate_user_only_help_text'] = 'Je moet je autoriseren om de board configuratie te kunnen wijzigen. 
	Je kunt je enkel autoriseren met de naam en het wachtwoord van een actief beheerder account op het board.';
$lang['Admin_Account'] = 'Beheerder account van het board';
$lang['Database_Login'] = 'Database gebruiker';
$lang['Username'] = 'Gebruikersnaam';
$lang['Password'] = 'Wachtwoord';
$lang['Auth_failed'] = 'Autorisering mislukt!';
$lang['Return_ERC'] = 'Terugkeren naar Nood Herstel Console';
$lang['cur_setting'] = 'Huidige instelling';
$lang['rec_setting'] = 'Aanbevolen instelling';
$lang['secure'] = 'Beveiligd';
$lang['secure_yes'] = 'Ja (https)';
$lang['secure_no'] = 'Nee (http)';
$lang['domain'] = 'Domein';
$lang['port'] = 'Poort';
$lang['path'] = 'Path';
$lang['Cookie_domain'] = 'Cookie domein';
$lang['Cookie_name'] = 'Cookie naam';
$lang['Cookie_path'] = 'Cookie path';
$lang['select_language'] = 'Selecteer nieuwe taal';
$lang['select_theme'] = 'Selecteer nieuw thema';
$lang['reset_thmeme'] = 'Herstel standaard thema';
$lang['new_admin_user'] = 'Gebruiker om admin rechten aan toe te kennen';
$lang['dbms'] = 'Database Type';
$lang['DB_Host'] = 'Hostname van de database server / DSN';
$lang['DB_Name'] = 'Je database naam';
$lang['DB_Username'] = 'Database gebruikersnaam';
$lang['DB_Password'] = 'Database wachtwoord';
$lang['Table_Prefix'] = 'Prefix voor de database tabellen';
$lang['New_config_php'] = "Dit is je nieuwe configuratie.$phpEx";
// Options
$lang['cls'] = 'Sessie tabel legen';
$lang['rdb'] = 'Herstel database tabellen';
$lang['rpd'] = 'Reset path gegevens';
$lang['rcd'] = 'Reset cookie gegevens';
$lang['rld'] = 'Reset taal gegevens';
$lang['rtd'] = 'Reset template gegevens';
$lang['dgc'] = 'GZip compressie uitschakelen';
$lang['cbl'] = 'Ban lijst legen';
$lang['raa'] = 'Verwijder alle beheerders';
$lang['mua'] = 'Geef gebruiker beheerder rechten';
$lang['rcp'] = 'Opnieuw config.php maken';
// Info for options
$lang['cls_info'] = 'Wanneer u doorgaat, worden alle sessies verwijderd.';
$lang['rdb_info'] = 'Wanneer u doorgaat, worden de tabellen van de database hersteld.';
$lang['rpd_info'] = 'Wanneer u doorgaat, worden de configuratie gegevens bijgewerkt wanneer de aanbevolen instelling geselecteerd is.';
$lang['rcd_info'] = 'Wanneer u doorgaat, worden de cookie gegevens bijgewerkt. De optie of er een beveiligde cookie of niet beveiligde cookie moet worden ingesteld, is te vinden onder \'Reset path gegevens\'.';
$lang['rld_info'] = 'Wanneer u doorgaat, wordt de geselecteerde taal gebruikt voor zowel het board als de gebruiker waarmee is aangemeld.';
$lang['rtd_info'] = 'Wanneer u doorgaat, wordt de geselecteerde stijl gebruikt voor zowel het board als de gebruiker waarmee is aangemeld of wordt de standaard stijl (subSilver) opnieuw worden aangemaakt en gebruikt voor zowel het board als de gebruiker.'; 
$lang['rtd_info_no_theme'] = 'Wanneer u doorgaat, wordt de standaard stijl (subSilver) opnieuw aangemaakt en gebruikt voor zowel het board als de gebruiker waarmee is aangemeld.';
$lang['dgc_info'] = 'Wanneer u doorgaat, wordt de GZip compressie uitgeschakeld.';
$lang['cbl_info'] = 'Wanneer u doorgaat, worden zowel de ban lijst als de gebruikers zonder toegang worden verwijderd.';
$lang['raa_info'] = 'Wanneer u doorgaat, worden alle admins teruggezet naar normale gebruikers. Wanneer je een beheerder account hebt gebruikt om aan te melden, zal deze de admin rechten behouden.';
$lang['mua_info'] = 'Wanneer u doorgaat, worden admin rechten toegekend aan de geselecteerde gebruiker. De gebruiker zal (wanneer nodig) ook geactiveerd worden.';
$lang['rcp_info'] = 'Wanneer u doorgaat, wordt config.php opnieuw aangemaakt met ingevoerde gegevens.';
// Success messages for options
$lang['cls_success'] = 'Alle sessies zijn succesvol verwijderd.';
$lang['rdb_success'] = 'De tabellen van de database zijn succesvol hersteld.';
$lang['rpd_success'] = 'De board configuratie is succesvol bijgewerkt.';
$lang['rcd_success'] = 'De cookie gegevens zijn succesvol bijgewerkt.';
$lang['rld_success'] = 'De taalgegevens zijn succesvol bijgewerkt.';
$lang['rld_failed'] = "De vereiste taalbestanden (lang_main.$phpEx en lang_admin.$phpEx) bestaan niet.";
$lang['rtd_restore_success'] = 'De standaard stijl is succesvol hersteld.';
$lang['rtd_success'] = 'De stijl gegevens zijn succesvol bijgewerkt.';
$lang['dgc_success'] = 'De GZip compressie is succesvol uitgeschakeld.';
$lang['cbl_success'] = 'De ban lijst en de gebruikers zonder toegang zijn succesvol verwijderd.';
$lang['cbl_success_anonymous'] = 'De ban lijst en de gebruikers zonder toegang zijn succesvol verwijderd. De anonieme account is opnieuw aangemaakt. Omdat de groepsgegevens van de anonieme account kunnen ontbreken, wordt er aanbevolen de &quot;Controleer gebruikers en groepen tabellen&quot; bewerking in DB Onderhoud uit te voeren.';
$lang['raa_success'] = 'Alle beheerders zijn succesvol verwijderd.';
$lang['mua_success'] = 'De geselecteerde gebruiker heeft geen beheer rechten.';
$lang['mua_failed'] = '<b>Fout:</b> De geselecteerde gebruiker bestaat niet of heeft al beheer rechten.';
$lang['rcp_success'] = "Kopieer de tekst naar een tekstbestand, hernoem het naar <b>config.$phpEx</b> en upload het naar de root van het forum. Verzeker je ervan dat er geen karakters (inclusief spaties en line feeds) voor <b>&lt;?php</b> en na <b>?&gt;</b>.<br /> zijn gebruikt. Je kunt het bestand ook %sdownloaden%s naar je computer.";
// Text for success messages
$lang['Removing_admins'] = 'Verwijdert beheerders';
// Help Text
$lang['Option_Help_Text'] = '<p>Wanneer je een melding krijgt over een fout bij het aanmaken van een sessie, dan kun je de sessie gegevens verwijderen door <b>Verwijder alle sessies</b> te selecteren. Wanneer je problemen hebt met de toegang tot database tabellen, dan kun je de tabellen repareren door <b>Herstel database tabellen</b> te selecteren.</p>
	<p>Wanneer je je niet kunt aanmelden of in het Beheer paneel kan komen, kan er een fout staan in je path of cookie instellingen. Je kunt deze resetten door respectievelijk <b>Reset path gegevens</b> of <b>Reset cookie gegevens</b> te selecteren. Je kunt ook de taal instellingen of de template gegevens resetten door <b>Reset taal gegevens</b> of <b>Reset template gegevens</b> te selecteren.</p>
	<p>Wanneer er problemen voorkomen na het inschakelen van GZip compressie, kun je deze uitschakelen door <b>GZip compressie uitschakelen</b> te selecteren.</p>
	<p>Wanneer je het wachtwoord van je account bent kwijtgeraakt, kun je een gebruiker admin rechten geven door <b>Geef gebruiker admin rechten</b> te selecteren. Hierdoor zal de gebruiker ook geactiveerd worden, dus je kunt speciaal hiervoor een gebruiker aanmaken. Wanneer je geen nieuwe gebruiker kunt aanmaken, kun je de ban lijst verwijderen door <b>Verwijder ban lijst</b> te selecteren (hierdoor zal ook de anonieme gebruiker hersteld worden).</p>
	<p>Wanneer je board gehacked is, wordt er aanbevolen alle beheerder accounts te verwijderen door <b>Verwijder alle administrators</b> te selecteren (Alleen de admin rechten zullen verwijderd worden, de gebruikersaccount blijft bestaan).</p>
	<p>Wanneer je je config.php moet herstellen, kun je dit doen door <b>Vernieuw config.php</b> te selecteren.</p>';
?>