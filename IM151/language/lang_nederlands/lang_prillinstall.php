<?php
/***************************************************************************
 *                        lang_prillinstall.php [Nederlands]
 *                            -------------------
 *   begin                : Saturday, July 10, 2004
 *   copyright            : (C) 2004 masterdavid - Ronald John David
 *   website              : http://www.integramod.com
 *   email                : webmaster@integramod.com
 * 
 *   Nederlandse vertaling  : Maart 2005 
 *   The Dutch Team         : http://www.integramod.nl 
 *
 *   note: removing the original copyright is illegal even you have modified
 *         the code.  Just append yours if you have modified it.
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

//
// Prillian Install Process
//
$lang['Installation'] = 'Installatie';
$lang['Thanx'] = 'Bedankt voor het kiezen van %s, Het orginele instant messenger voor phpBB! Als u problemen heeft, bekijk de readme.txt bestand voor locaties waar u hulp kunt vragen.';
$lang['No_redirect'] = 'Als uw browser meta redirection niet ondersteund, klik dan %sHIER%s om dit te doen.';
$lang['Attempt_schema_read'] = 'Poging tot lezen van schema SQL bestand:';
$lang['Attempt_create_tables'] = 'Poging tot het maken van nieuwe DB tabellen:';
$lang['Table'] = 'Tabel';
$lang['Created'] = 'gemaakt';
$lang['Query'] = 'Query';
$lang['Completed'] = 'Voltooid';
$lang['Attempt_alter_read'] = 'Poging tot lezen van SQL bestand met Tabel wijzigingen:';
$lang['Attempt_alter_tables'] = 'Poging tot het wijzigen van DB tabellen:';
$lang['Table_alterations'] = 'Tabel wijzigingen';
$lang['Undetermine'] = 'Kan niet beslissen wat te moeten doen!';
$lang['Successful'] = 'Succesvol!';
$lang['Failed'] = 'Mislukt!';
$lang['Error_follows'] = 'Foutmelding volgt:';
$lang['Successfully'] = 'succesvol';
$lang['Attempt_delete_tables'] = 'Poging tot het verwijderen DB tabellen:';
$lang['Deletion'] = 'verwijderen';
$lang['Attempt_delete_alternations_tables'] = 'Poging tot het verwijderen van veranderingen van DB tabellen:';
$lang['Alteration'] = 'wijzigingen';
$lang['Step_1'] = 'Dit is stap 1 van de 5!';
$lang['Step_1_intro'] = 'We proberen nu de nieuwe database tabellen te installeren.';
$lang['Step_1_error'] = '<br />Helaas, er was een fout! Als enkele van deze tabellen niet zijn gemaakt of nog niet bestaan, dan zul je dit handmatig moeten doen met het *_im_schema.sql betand voor jou type database. Hier zijn wat dingen waar naar gekeken moet worden bij een fout in deze stap.<ul><li><span class="bold">Fout: Poging tot lezen van schema SQL: Mislukt!</span><br />Zorg ervoor dat de *.sql bestanden in dezelfde map als im_install.php staan!</li><li><span class="bold">Fout: Tabel "%s" bestaat al</span><br />Wanneer je Thoul\'s Contact Lijst hack al hebt geinstalleerd maak je dan geen zorgen, beide gebruiken de zelfde tabellen.</li><li><span class="bold">Fout: Tabel "%s" bestaat al</span><br />Als één van de tabellen al bestaat kan deze van een vorige prillian installatie zijn. Zorg eerst dat je prillian helemaal verwijderd en ga dan pas verder met deze installatie. Bij de prillian installatie moet je later waarschijnlijk handmatig nog wat veranderingen doorvoeren.</li></ul>';
$lang['Step_no_errors'] = 'Geen fouten ontdekt in deze stap.';
$lang['Step_2'] = 'Dit is stap 2 van de 5!';
$lang['Step_2_intro'] = 'We zullen nu proberen je gebruikers in de %s database tabellen te copiëren.';
$lang['Step_2_error_get_list'] = 'Fout bij het verkrijgen van de user_ids om in te voegen';
$lang['Step_2_user_success'] = '%s gebruikers van de %s zijn met succes gecopierd naar de tabel.';
$lang['Step_2_user_failed'] = 'geen gebruikers van de %s zijn gecopiërd naar de tabel.';
$lang['Step_2_error'] = '<br /><br /><span class="err_msg">Deze gebruikers zijn niet gecopieerd: %s.</span><br /><br />Deze gebruikers bestaan mischien al in de tabel of het copiëren is simpel weg verkeerd gegaan. In het laatste geval moet je de gebruikers handmatig toevoegen. Om dit te doen moet je de SQL queries starten doormiddel van phpMyAdmin of een vergelijkbaar programma. Als je zo\'n programma niet hebt, ga dan naar het Utilities sectie van phpBBHacks.com en zoek naar de db_generator pagina.<br /><br /><span class="query_msg">';
$lang['Step_3'] = 'Dit is stap 3 van de 5!';
$lang['Step_3_intro'] = 'We proberen nu de gegevens toe te voegen, inclusief vele nieuwe configuratie opties.';
$lang['Step_3_error'] = '<br />Helaas, er was een fout! Als enkele van deze queries niet konden worden uitgevoerd en niet al bestonden, dan zal er waarschijnlijk een probleem ontstaan bij het opstarten van Prillian! Hier zijn wat dingen waar naar gekeken kan worden bij een fout in deze stap:<ul><li><span class="bold">Fout: Poging tot lezen van gegevens SQL bestand: Mislukt!</span><br />Zorg ervoor dat de *.sql bestanden in dezelde map als im_install.php staan!</li><li><span class="bold">invoeg problemen</span><br />Deze fout betekend dat de gegevens in die specifieke query al eens eerder naar de tabel is gecopiërd. Meestal is dit geen error om je druk over te maken, negeer het.</li></ul>';
$lang['Step_4'] = 'Dit is stap 4 van de 5!';
$lang['Step_4_intro'] = 'We proberen nu je bestaande tabellen aan te passen zodat nieuwe data kan worden ingevoerd.';
$lang['Step_4_error'] = '<br />Helaas, er was een fout! Als enkele van deze queries niet werden gemaakt of niet al bestonden, dan zal er waarschijnlijk een probleem ontstaan bij het opstarten van Prillian! Hier zijn wat dingen waar naar gekeken moet worden bij een fout in deze stap:<ul><li><span class="bold">Fout: Poging tot lezen van gewijzigde tabel van SQL bestand: Mislukt!</span><br />Zorg ervoor dat de *.sql bestanden in dezelde map als im_install.php zitten!</li><li><span class="bold">Invoeg problemen van gegevens</span><br />Deze fout betekend dat de gewijzigde gegevens in die specifieke query al eens eerder naar de tabel is gecopiërd. Meestal is dit geen error om je druk over te maken, negeer het.</li></ul>';
$lang['Step_5'] = 'Dit is stap 5 van de 5!!';
$lang['Step_5_intro'] = 'Gefeliciteerd, je bent klaar met de installatie van Prillian<br /><br />Als je geen foutmeldingen bent tegengekomen, dan is je volgende stap het uploaden van sommige Prillian bestanden of wijzigen van phpBB bestanden die je nog niet geupload hebt.<br /><br />Als je fouten bent tegen gekomen, dan moet je de veranderingen nog even handmatig doorvoeren.<br /><br />In elk geval, als je alle bestanden hebt geupload en handmatig de database veranderingen hebt doorgevoerd, kun je naar het administratie paneel gaan en gebruik maken van de nieuwe prillian configuratie pagina om de instellingen klaar te maken voor het gebruik van Prillian.<br /><br /><span class="err_msg">Verwijder prill_install map voordat je verder gaat.</span><br /><br />';
$lang['Step_5_proceed'] = 'Ik heb de directorie prill_install verwijderd... laten we de overige registratie details voor mijn account afmaken';
$lang['Step_0'] = 'Dit is stap 0 van de 5!!';
$lang['Step_0_intro'] = 'Oké, jij kiest ervoor om Prillian te installeren! De installatie zal gedaan worden in een aantal stappen zodat je kan zien wat het script wilt gaat installeren en welke fouten er mischien ontstaan. Wanneer een stap gedaan is, kun je doorgaan naar de volgende stap door te klikken op de ga naar de volgende stap link. Terwijl je verder gaat, zullen soms tips verschijnen bij de fouten die je mischien kunt tegenkomen.<br /><br />Voordat je verder gaat, kun je veranderingen maken aan de standaard waardes gedefinieerd voor phpbb_im_prefs in het *_im_schema.sql bestand dat je gaat gebruiken om de database tabellen te installeren. Deze standaard waarden zullen worden toegepast op alle gebruikers tijdens deze installatie en voor (toekomstige gebruikers) registratie. Als je wilt dat sommige gebruikers Prillian kunnen gebruiken, kunnen veranderingen van sommige van deze handig zijn.<br /><br />Ga verder met de volgende stap om prillian te gaan installeren!';
$lang['Proceed'] = 'Ga naar de volgende stap';
$lang['Delete_step'] = 'Oké, als je zeker bent dat je prillian wilt verwijderen, laten we dit dan gaan doen.';
$lang['Choose_Install'] = 'Voordat we verder gaan, zorg dat je de %s nieuwe phpBB bestanden geupload hebt en dat je het %s bestand aangepast hebt. Als je deze bestanden niet geupload hebt, ben je niet in staat deze instaltie goed te doen.<br /><br />Kies een installatie methode:<ul><li>%s Nieuwe %s Installatie %s</li><li>%s Upgrade van een vorige Installatie %s - <span class="bold">Sorrry, Deze optie is niet mogelijk in %s </span></li><li>%s deinstalleer %s database veranderingen %s</li></ul>';
$lang['Confirm_Delete'] ='Je hebt gekozen om de %s database veranderingen te verwijdern. Dit zal er voor zorgen dat %s ongebruikbaar is, dus je moet de veranderingen in de orginele phpBB bestanden verwijderen (behalve voor %s) voorkom eerst dat je forum het begeeft. Je zou ook eerst een reservere kopie moeten maken van je database tabellen, voor het geval er iets fout gaat. Als je dat gedaan hebt en je weet zeker dat je de database veranderingen wilt verwijderen, klik dan op de link hieronder.<ul><li>%s deinstalleer %s database veranderingen %s</li></ul></div>';
$lang['Already_installed'] ='Je hebt %s al geinstalleerd of een nieuwere versie.';
?>