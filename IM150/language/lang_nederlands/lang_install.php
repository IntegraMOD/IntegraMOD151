<?php
/****************************************************************
 *                    lang_install.php [Nederlands]
 *                    -------------------
 *   begin            : Saturday, July 10, 2004
 *   copyright        : (C) 2004 masterdavid - Ronald John David
 *   website          : http://www.integramod.com
 *   email            : webmaster@integramod.com
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
// Install Process
//
$lang['Welcome_install'] = 'Welkom bij de IntegraMOD151 Installatie';
$lang['Initial_config'] = 'Basis Configuratie';
$lang['DB_config'] = 'Database Configuratie';
$lang['Admin_config'] = 'Beheerder Configuratie';
$lang['continue_upgrade'] = 'Zodra u het config bestand op uw computer heeft gedownload klikt u op de \'Vervolg Actualisering\' knop hieronder om door te gaan met het actualiseringsproces.  Wacht met het uploaden van het config bestand tot de actualisering voltooid is.';
$lang['upgrade_submit'] = 'Vervolg Actualisering';

$lang['Installer_Error'] = 'Er is een fout gemaakt tijdens de installatie';
$lang['Previous_Install'] = 'Er is een oudere installatie gedetecteerd';
$lang['Install_db_error'] = 'Er is een fout gemaakt tijdens het actualiseren van de database';

$lang['Re_install'] = 'Uw oude installatie is nog steeds actief.<br /><br />Als u phpBB2 opnieuw wilt installeren kunt u op de knop \'Ja\' klikken. Ben u ervan bewust dat u daarmee de huidige installatie zal wissen en er geen backup gemaakt zal worden! De beheerder naam en wachtwoord zullen opnieuw worden aangemaakt en er zullen geen andere settings worden behouden.<br /><br />Denk goed na voordat u op \'Ja\' klikt!';

$lang['Inst_Step_0'] = 'Dank u voor het kiezen voor phpBB2. Om de installatie volledig te maken wordt u verzocht onderstaande informatie in te vullen. Bedenk dat de database waar u in wilt installeren reeds moet bestaan. Als u in een database die ODBC gebruikt wilt installeren, bijvoorbeeld MS Access, zult u daar eerst een DSN voor moeten aanmaken alvorens de installatie voort te zetten.';

$lang['Start_Install'] = 'Start Installatie';
$lang['Finish_Install'] = 'Beëindig Installatie';

$lang['Default_lang'] = 'Standaard forum taal';
$lang['DB_Host'] = 'Database Server Hostnaam / DSN';
$lang['DB_Name'] = 'Database Naam';
$lang['DB_Username'] = 'Database Gebruikersnaam';
$lang['DB_Password'] = 'Database Wachtwoord';
$lang['Database'] = 'Uw Database';
$lang['Install_lang'] = 'Kies taal voor Installatie';
$lang['dbms'] = 'Database Type';
$lang['Table_Prefix'] = 'Voorvoegsel voor tabellen in database';
$lang['Admin_Username'] = 'Beheerder Gebruikersnaam';
$lang['Admin_Password'] = 'Beheerder Wachtwoord';
$lang['Admin_Password_confirm'] = 'Beheerder Wachtwoord [ bevestig ]';

$lang['Inst_Step_2'] = 'Uw beheerder gebruikersnaam is aangemaakt.  Uw standaard installatie is nu gereed. U zult nu naar een scherm worden geleid, waar u uw nieuwe installatie kunt beheren. Vergeet niet de Algemene Configuratie details te controleren en de nodige aanpassingen aan te brengen. Dank u voor het kiezen voor phpBB2.';

$lang['Unwriteable_config'] = 'Uw config bestand is niet beschrijfbaar op dit moment. Als u op onderstaande knop klikt wordt een copie van het config bestand naar uw computer gedownload. U moet deze in dezelfde map als phpBB2 uploaden. Zodra dit is gedaan kunt u inloggen in het beheerders controle paneel met gebruik van de beheerder naam en wachtwoord die u in het vorige formulier heeft ingevuld (zodra u bent ingelogd verschijnt een link onderaan elke pagina) om de algemene configuratie te controleren. Dank u voor het kiezen voor phpBB2.';
$lang['Download_config'] = 'Download Configuratie';

$lang['ftp_choose'] = 'Kies Download Methode';
$lang['ftp_option'] = '<br />Omdat FTP extensies in deze versie van PHP ondersteund worden is het mogelijk u de optie aan te bieden om het config bestand eerst handmatig via FTP te uploaden.';
$lang['ftp_instructs'] = 'U heeft gekozen om het account dat phpBB2 bevat automatisch via FTP te uploaden.  Vul de informatie in die nodig is om het proces in werking te stellen. NB: het path naar uw phpBB2 installatie moet precies hetzelfde zijn als wanneer u het handmatig via FTP met een standaard cliënt zou willen uploaden.';
$lang['ftp_info'] = 'Vul uw FTP Informatie in';
$lang['Attempt_ftp'] = 'Probeer config bestand via FTP te uploaden';
$lang['Send_file'] = 'Stuur het bestand naar mij en ik upload het handmatig via FTP';
$lang['ftp_path'] = 'FTP path naar phpBB2';
$lang['ftp_username'] = 'Uw FTP Gebruikersnaam';
$lang['ftp_password'] = 'Uw FTP Wachtwoord';
$lang['Transfer_config'] = 'Start Overdracht';
$lang['NoFTP_config'] = 'Het uploaden van het config bestand via FTP is mislukt.  Download het config bestand en upload het handmatig via FTP aub.';

$lang['Install'] = 'Installeer';
$lang['Upgrade'] = 'Actualiseer';


$lang['Install_Method'] = 'Kies installatie methode';

$lang['Install_No_Ext'] = 'De PHP configuratie op uw server ondersteunt het database type dat u gekozen heeft niet';

$lang['Install_No_PCRE'] = 'phpBB2 heeft de Perl-Compatible Regular Expressions Module voor PHP nodig welke uw PHP configuratie niet lijkt te ondersteunen!';

$lang['Install_No_File_Open'] = 'De file %s kan niet worden geopend, daar hij niet de juiste rechten heeft. Gelieve de CHMOD instructies zorgvuldig na te lezen in de installatie gids.';

$lang['Go_to_prillian'] = 'Ik heb de install directory verwijderd... Laat me nu Prillian installeren...';
$lang['Go_to_profile'] = 'Ik heb de install en de prill_install directories verwijderd... laten we de overige registratie details voor mijn account afmaken...';

$lang['Extra_procedures'] = '<tr><th><center>Integramod Extra Procedures</center></th></tr>
<tr><td>
<p><center>De informatie om enkele extra procedures te beëindigen, nodig om IntegraMOD te installeren, is hieronder.<ul>
<li>Verwijder de installatie folder nu, om te voorkomen dat je een foutmelding krijgt wanneer je op de knop klikt om verder te gaan.<br /></li>
%s
</ul>
Wanneer je nog vragen hebt stel die dan op<br />
<a href="http://www.integramod.com">IntegraMOD.com</a> of <a href="http://www.integramod.com">IntegraMOD.nl</a>
</center></p></td></tr>';
$lang['Extra_procedures_no_prillian'] = '<li>Verwijder tevens de prill_install directory, aangezien je verkoos om deze niet te installeren.</li>'; // comes inside 'Extra_procedures'
$lang['Admin_config_settings'] = 'phpBB Security Instellingen</th>';
$lang['Admin_config_name'] = 'Kies een admin config naam. Dit kan van alles zijn. Probeer het bij maximaal 1 of 2 woorden te houden b.v. <b>admins_allowed</b>. Ik zou dit niet gaan gebruiken, maar je begrijpt het idee.';
$lang['Mod_config_name'] = 'Kies een mod config naam. Dit kan van alles zijn. Probeer het bij maximaal 1 of 2 woorden te houden b.v. <b>mods_allowed</b>. Ik zou dit niet gaan gebruiken, maar je begrijpt het idee.';
$lang['Unwanted_config_name'] = 'Kies een disable config naam. Dit kan van alles zijn. Probeer het bij maximaal 1 of 2 woorden te houden b.v. <b>block_unwanted</b>. Ik zou dit niet gaan gebruiken, maar je begrijpt het idee.';
$lang['No_prillian_wanted'] = 'Vink dit vakje aan indien je Prillian <strong>NIET</strong> wenst te installeren.';
$lang['Install_options'] = 'Instalatie Opties';
?>