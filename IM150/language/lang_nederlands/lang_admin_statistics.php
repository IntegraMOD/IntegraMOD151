<?php
/****************************************************************
 *                    lang_admin_statistics.php [Nederlands]
 *                     -------------------
 *     begin                : Fri Jan 24 2003
 *     copyright            : (C) 2003 Meik Sievertsen
 *     email                : acyd.burn@gmx.de
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

$lang['LEFT_Package_Module'] = 'Resterend Module Pakket ';
$lang['Install_module'] = 'Installeer Module';
$lang['Manage_modules'] = 'Beheer Modules';
$lang['Stats_configuration'] = 'Configuratie';
$lang['Edit_module'] = 'Wijzig Module';
$lang['Stats_langcp'] = 'Taal CP';

// Package Module
$lang['Package_module'] = 'Pakket Module';
$lang['Package_module_explain'] = 'Hier kun je je 3 modulebestanden omvormen naar 1 Module Pakket voor verzending.';
$lang['Select_info_file'] = 'Selecteer infobestand';
$lang['Select_lang_file'] = 'Selecteer taalbestand';
$lang['Select_module_file'] = 'Selecteer module-php-bestand';
$lang['Package_name'] = 'Pakket naam';
$lang['Create'] = 'Creër';

// Install Module
$lang['Install_module_explain'] = 'Hier kun je een nieuwe module installeren, je kunt dit op twee manieren. De eerste methode is je Module Pakket uploaden met het formulier dat hier beneden ziet. Als uploaden niet werkt, kun je de Module Package uploaden naar je ./modules/pakfiles map, het zal hier dan automatisch getoond worden. <br />Nadat je een Module Package geselecteerd hebt om te installeren, zal je Informatie over de Module die je gekozen hebt. Zorg dat je zeker bent dat de Module Informatie correct is en dat je de minimum requirements  (de correct Statistieken Mod Versie) juist is. Je kunt ook de Taal kiezen die je wil mee-installeren. Als je alles goed gecontroleerd hebt, klik je op de Installeer Knop.<br />De normale Installatie laat de Module deactief, je moet het activeren voor het te voorschijn komt in de Statistieken Pagina.';
$lang['Select_module_pak'] = 'Selecteer Module Pakket';
$lang['Upload_module_pak'] = 'Upload Module Pakket';
$lang['Inst_module_already_exist'] = 'Module met de naam \'%s\' bestaat al.<br />Als je deze Module wilt aanpassen, moet je naar het Module Beheer gaan en de Module daar aanpassen.<br />Als je deze module volledig wilt herinstalleren, moet je de oude Module eerst verwijderen.';
$lang['Incorrect_update_module'] = 'Het geselecteerde Pakket is geen update voor de geselecteerde Module. Zorg dat je zeker bent dat je de juiste Pakket hebt geselecteerd.';

$lang['Module_name'] = 'Module Naam';
$lang['Module_description'] = 'Module Beschrijving';
$lang['Module_version'] = 'Module Versie';
$lang['Required_stats_version'] = 'Minimum vereiste Statistieken Versie';
$lang['Installed_stats_version'] = 'Geïnstalleerde Statistieken Versie';
$lang['Module_author'] = 'Module Auteur';
$lang['Author_email'] = 'Auteur E-Mailadres';
$lang['Module_url'] = 'Module/Auteur Homepage';
$lang['Update_url'] = 'Module update Homepage (Controleer voor Updates)';
$lang['Provided_language'] = 'Taalondersteuning';
$lang['Install_language'] = 'Installeer Taal';
$lang['Module_installed'] = 'Module successvol geïnstalleerd.';
$lang['Module_updated'] = 'Module successvol aangepast.';

// Manage Modules
$lang['Manage_modules_explain'] = 'Hier kun je je Module beheren. Je kunt ze wijzigen, verwijderen, de volgorde veranderen of ze activeren/deactiveren. Als je je Module wil configuren (Rechten opties, de Taal Variabelen veranderen,...), zul je die moeten veranderen.<br />Als je klikt op een Module Naam, zul je een preview zien van deze Module.';
$lang['Deactivate'] = 'Deactiveer';
$lang['Activate'] = 'Activeer';

// Delete Module
$lang['Confirm_delete_module'] = 'Ben je zeker dat je deze Module wilt verwijderen?';

// Configuration
$lang['Msg_config_updated'] = '- Statistieken Configuratie successvol geupdated.';
$lang['Msg_reset_view_count'] = '- Bekijkteller successvol gereset.';
$lang['Msg_reset_install_date'] = '- Installeer Datum op vandaag gezet.';
$lang['Msg_reset_cache'] = '- Caches succesvol gereset.';
$lang['Msg_purge_modules'] = '- Successvol de modules mapinhoud verwijderd.';
$lang['Config_title'] = 'Statistieken Configuratie';
$lang['Config_explain'] = 'Hier kun je de Statistieken beheren.';
$lang['Messages'] = 'Bericht';
$lang['Return_limit'] = 'Return Limit';
$lang['Return_limit_explain'] = 'Het aantal items om te includen in elke ranking.';
$lang['Reset_settings_title'] = 'Reset Opties';
$lang['Reset_view_count'] = 'Reset teller';
$lang['Reset_view_count_explain'] = 'Reset de teller onderaan de Statistieken pagina naar nul.';
$lang['Reset_install_date'] = 'Reset de installeer datum';
$lang['Reset_install_date_explain'] = 'Reset de installatie datum. Dit zet de installatie datum naar vandaag.';
$lang['Reset_cache'] = 'Wis Cache';
$lang['Reset_cache_explain'] = 'Wis alle cached data van alle modules & templates.';
$lang['Purge_module_dir'] = 'Maak Module Map leeg';
$lang['Purge_module_dir_explain'] = 'Verwijder de complete Module Map, alle submappen en bestanden zullen gedeleted worden. Gebruik deze optie alleen als je zeker bent wat je doet en welke gevolgen dit heeft voor je Statistieken.';

// Edit Module
$lang['Msg_changed_update_time'] = '- Update tijd succesvol veranderd.';
$lang['Msg_cleared_module_cache'] = '- Module cache succesvol gewist.';
$lang['Msg_module_fields_updated'] = '- Module definable velden successvol geupdated.';

$lang['Module_select_title'] = 'Selecteer Module';
$lang['Module_select_explain'] = 'Hier kan je de Module selecteren die je wilt veranderen .';
$lang['Edit_module_explain'] = 'Hier kun je de Module configureren. Bovenaan zie je de Module Informatie, dan het berichtvenster waar alle Update Berichten getoond worden. Onderaan vindt je het Configuratiedeel en het Update Module deel. Selecteer eenModule Package in het Update Module deel,  \'of\' upload een Module Package, niet alletwee!<br />Het Configuratie Deel kan verschillen van Module tot Module, omdat sommige Modules speciale Configuratie Opties hebben.';
$lang['Module_informations'] = 'Module Informatie';
$lang['Module_languages'] = 'Talen gelinkt aan deze Module';
$lang['Preview_module'] = 'Preview Module';
$lang['Module_configuration'] = 'Module Configuratie';
$lang['Update_time'] = 'Update Tijd in Minuten';
$lang['Update_time_explain'] = 'Tijdinterval (in Minutes) van het vernieuwen van de cached data door nieuwe Data. Elke x aantal minuten wordt de Module opnieuw geladen.<br />Sinds De Statistieken een priority systeem gebruiken, kan dit groter zijn dan x minuten, maar niet meer dan een dag.';
$lang['Module_status'] = 'Module Status';
$lang['Active'] = 'Actief';
$lang['Not_active'] = 'Inactief';
$lang['Clear_module_cache'] = 'Wis module cache';
$lang['Clear_module_cache_explain'] = 'Wis de module cache en reset de modulen priority. De volgende keer wanneer de Statistieken Pagina wordt gebruikt, wordt deze Module opnieuw geladen.';
$lang['Update_module'] = 'Update Module';
$lang['No_module_packages_found'] = 'Geen module pakketten gevonden';

// Permissions
$lang['Msg_permissions_updated'] = '- Rechten aangepast';
$lang['Permissions'] = 'Rechten';
$lang['Set_permissions_title'] = 'Hier kan je de rechten instellen om een Module te bekijken, wijzigen. Alleen de Gebruikers (Anonymous, Geregistreerd, Moderators en Administrators) en Groepen die gerankschikt staan, kunnen de Module bekijken.';
$lang['Perm_all'] = 'Anonymous Gebruikers';
$lang['Perm_reg'] = 'Geregistreerde gebruikers';
$lang['Perm_mod'] = 'Moderators';
$lang['Perm_admin'] = 'Beheerders';
$lang['Perm_group'] = 'Groepen';
$lang['Added_groups'] = 'Toegevoegde Groepen';
$lang['Perm_add_group'] = 'Voeg een Groep toe';
$lang['Perm_remove_group'] = 'Verwijder Group';
$lang['Perm_groups_title'] = 'Groepen die toegelaten zijn om de Module te zien';
$lang['No_groups_selected'] = 'Geen groepen geselecteerd';
$lang['No_groups_to_add'] = 'Er zijn geen groepen meer om toe te voegen';

// Language CP
$lang['Language_key'] = 'Taal Variabel -> Sleutel';
$lang['Language_value'] = 'Taal Variabel -> Waarde';
$lang['Update_all_lang'] = 'Update Alle Entries';
$lang['Add_new_key'] = 'Voeg een nieuwe sleutel toe';
$lang['Create_new_lang'] = 'Creër een nieuwe Taal';
$lang['Delete_language'] = 'Verwijder Taal';
$lang['Language_cp_title'] = 'Taal Controlepaneel';
$lang['Language_cp_explain'] = 'Hier kun je alle Taal Variabels & Taal Pakketten voor iedere Module beheren. Je kunt hier onder andere talen importeren of exporteren.';
$lang['Export_lang_module'] = 'Exporteer Taal voor deze module';
$lang['Export_language'] = 'Exporteer deze complete taal';
$lang['Export_everything'] = 'Exporteer alles';
$lang['Import_new_language'] = 'Importeer Taal';
$lang['Import_new_language_explain'] = 'Here you are able to upload (or select) the Language Pack you want to install. After you have uploaded (or selected) the Language Pack, you will see some Informations about the Language Pack. Only after viewing this Informations the Pack will be installed.';
$lang['Select_language_pak'] = 'Selecteer Taal Pakket';
$lang['Upload_language_pak'] = 'Upload Taal Pakket';

$lang['Language'] = 'Taal';
$lang['Modules'] = 'Modules';
$lang['Language_pak_installed'] = 'Taal Pakket successvol geïnstalleerd.';

?>