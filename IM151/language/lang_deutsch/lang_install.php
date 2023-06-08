<?php
/***************************************************************************
 *                        lang_install.php [German]
 *                            -------------------
 *   begin                : Saturday, July 10, 2004
 *   copyright            : (C) 2004 masterdavid - Ronald John David
 *   website              : http://www.integramod.com
 *   email                : webmaster@integramod.com
 *   modified		  : Mahdi, 2005/06/04
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
// Install Process
//
$lang['Welcome_install'] = 'Willkommen zur IntegraMOD151 Installation';
$lang['Initial_config'] = 'Basic Konfiguration';
$lang['DB_config'] = 'Datenbank- Konfiguration';
$lang['Admin_config'] = 'Admin- Konfiguration';
$lang['continue_upgrade'] = 'Sobald du die Konfigurationsdatei zu Ihrer lokalen Maschine downloadet hast, kannst du den\'Upgrade ausführen\' Button benutzen um den Upgradeprozess durch zuführen. Warte bitte um die Konfigdatei hochzuladen bis der Upgradeprozes komplett ist.';
$lang['upgrade_submit'] = 'Upgrade ausführen';

$lang['Installer_Error'] = 'Ein Fehler ist während der Installation aufgetreten';
$lang['Previous_Install'] = 'Eine vorhergehende Installation ist ermittelt worden';
$lang['Install_db_error'] = 'Ein Fehler trat beim updaten der Datenbank auf';

$lang['Re_install'] = 'Eine vorhergehende Installation ist noch aktiv.<br /><br />Wenn du phpBB 2 wieder installieren möchten, solltest du die Ja/ Yes- Taste unten klicken. Beachte bitte, daß du so alle vorhandenen Daten zerstört werden und keine Sicherungen erstellt wird! Der Administratorname und das Kennwort, das zum LOGIN im Board verwendet wird, werden nach der Neuinstallation neu erstellt und keine anderen Einstellungen werden bei behalten.<br /><br />Bedenke das bevor du mit "ja/yes" bestätigst!';

$lang['Inst_Step_0'] = 'Danke für die Benutzung vom phpBB 2. Zwecks der Durchführung bitte die zu benötigten Angaben die unten erbeten werden eintragen. Merke dir bitte daß die Datenbank die du einträgst bereits bestehen sollte. Wenn du eine Datenbank eingibst die ODBC - z.B. unter MS- Access läuft, solltest du einen DSN zuerst erstellen bevor du weiter machst.';

$lang['Start_Install'] = 'starte Installation';
$lang['Finish_Install'] = 'beende Installation';

$lang['Default_lang'] = 'Standart Board-sprache';
$lang['DB_Host'] = 'Datenbank Server Hostname / DSN';
$lang['DB_Name'] = 'Datenbank- Name';
$lang['DB_Username'] = 'Datenbank Username';
$lang['DB_Password'] = 'Datenbank Passwort';
$lang['Database'] = 'Datenbank';
$lang['Install_lang'] = 'benutze Sprache für Installation';
$lang['dbms'] = 'Datenbank- Typ';
$lang['Table_Prefix'] = 'Prefix für die Tabellen in der Datenbank';
$lang['Admin_Username'] = 'Administrator Username';
$lang['Admin_Password'] = 'Administrator Passwort';
$lang['Admin_Password_confirm'] = 'Administrator Passwort [ bestätigen ]';

$lang['Inst_Step_2'] = 'Dein Admin-Benutzername wurde erstellt. Bis zum diesem Punkt ist die Standart-Installation komplett. Sie werden jetzt zu einem Schirm geleitet der dir erlaubt die neue Installation auszuüben. Bitte  überprüfe  die allgemeinen Konfigurationsdetails und alle mögliche angeforderten Änderungen. Danke für die Benutzung von phpBB 2.';

$lang['Unwriteable_config'] = 'Deine Konfigdatei ist nicht beschreibbar. Eine Kopie von der Konfigdatei wird zu deinem Computer gedownloadet wenn du die Taste unten klickst. Du solltest die Datei ins gleiche Verzeichnis wie phpBB 2 hochladen. Sobald du dich eingeloggt hast, mit Adminname und -kennwort, die Sie im vorhergehenden Fenster eingetragen wurde, besuche dann die Administrations-Verwaltung (Der Link im unteren Bildschirmrand jedesmal beim Login) und überprüfe die allgemeine Konfiguration. Danke für die Benutzung von phpBB 2.';
$lang['Download_config'] = 'config.php downloaden';

$lang['ftp_choose'] = 'wähle die Download- Methode';
$lang['ftp_option'] = '<br />Da ftp-erweiterungen in dieser Version von PHP ermöglicht werden, kannst du die Wahl zum ftp die Config-Datei zuerst automatisch versuchen zu ersetzen.';
$lang['ftp_instructs'] = 'Du hast ftp gewählt um die Datei zum Zugang zu bewegen das automatisch phpBB 2 enthält.  Please enter the information below to facilitate this process. Merke dir, das der ftp-Pfad der richtige Pfad ( Verzeichnispfad) über ftp zu Ihrer phpBB2- Installation sein sollte, als ob du mit einem normalen FTP-Klienten verbinden würdest.';
$lang['ftp_info'] = 'Trage die Ftp-Informationen ein';
$lang['Attempt_ftp'] = 'versuche die Datei config per ftp zu';
$lang['Send_file'] = 'sende die Datei zu mir und ich "pft`e" manuell';
$lang['ftp_path'] = 'FTP- Pfad zu phpBB 2';
$lang['ftp_username'] = 'FTP Username';
$lang['ftp_password'] = 'FTP Password';
$lang['Transfer_config'] = 'Starte Transfer';
$lang['NoFTP_config'] = 'Der Versuch per ftp, wo die Konfigurationsdatei liegt schlug fehl. Downloade die Datei bitte und ersetzte diese dort manuell.';

$lang['Install'] = 'Installation';
$lang['Upgrade'] = 'Upgrade';


$lang['Install_Method'] = 'wähle die Installationsmethode aus';

$lang['Install_No_Ext'] = 'Die PHP- Konfiguration des Servers unterstützt nicht den Datenbanktyp den du ausgewählt hast';

$lang['Install_No_PCRE'] = 'phpBB2 erfordert Perl-Kompatiblität als reguläres Modul für PHP, was Ihre PHP Konfiguration nicht unterstützt! (Provider kontakten)';

$lang['Install_No_File_Open'] = 'The file %s cannot be opened due to insufficient security settings. Please check the chmod instructions in the install guide.';
$lang['Go_to_prillian'] = 'I deleted the install directory... Let\'s install prillian now...';
$lang['Go_to_profile'] = 'I deleted the install and prill_install directories... Let\'s complete the remaining registration details for my account...';

$lang['Extra_procedures'] = '<tr><th>Integramod Extra Procedures</center></th></tr><tr><td><p>
	The information to finish some of the extra procedures needed to install Integramod are below. <ul>
		<li>Please delete the install folder now, to prevent a message die error after you click finish installation</li>
		%s
	</ul>
	If you have any questions please ask at <a href="http://www.integramod.com">integramod.com.</a></p></td></tr>';
$lang['Extra_procedures_no_prillian'] = '<li>Please also delete the prill_install folder as you don\'t want to install it.</li>'; // comes inside 'Extra_procedures'
$lang['Admin_config_settings'] = 'phpBB Security Settings</th>';
$lang['Admin_config_name'] = 'Choose an admin config name. This can be anything. Try to keep it 1 or 2 words
				max IE. <b>admins_allowed</b>. I would not suggest using that, but you get the idea.';
$lang['Mod_config_name'] = 'Choose a mod config name. This can be anything. Try to keep it 1 or 2 words
				max IE. <b>mods_allowed</b>. I would not suggest using that, but you get the idea.';
$lang['Unwanted_config_name'] = 'Choose a disable config name. This can be anything. Try to keep it 1 or 2 words
				max IE. <b>block_unwanted</b>. I would not suggest using that, but you get the idea.';
$lang['No_prillian_wanted'] = 'Check this box if you <strong>don\'t</strong> want to install the prillian.';
$lang['Install_options'] = 'Install Options';
?>