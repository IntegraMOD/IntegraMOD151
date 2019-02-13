<?php
/*******************************************************************
 *		lang_extend_pcp_management.php [Nederlands]
 *		---------------------------------------
 *	begin		: 08/10/2003
 *	copyright	: Ptirhiik
 *	email		: ptirhiik@clanmckeen.com
 *
 *	version		: 0.0.4 - 24/10/2003
 *
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
	$lang['Lang_extend_pcp_management'] = 'Profiel Controle Paneel Beheer';

	// menu
	$lang['PCP_management'] = 'P.C.P.';
	$lang['PCP_00_tableslinked'] = 'Gekoppelde tabellen';
	$lang['PCP_01_valueslist'] = 'Waarden lijst';
	$lang['PCP_02_classesfields'] = 'Klassen';
	$lang['PCP_03_userfields'] = 'Velden definitie';
	$lang['PCP_04_usermaps'] = 'Mappen definitie';

	// objects
	$lang['PCP_tableslinked'] = 'Gekoppelde tabellen';
	$lang['PCP_tableslinked_explain'] = 'De tabellen gebruikt door het Profiel Beheer Paneel voor waarden lijst en vrienden/leden lijsten.';

	$lang['PCP_valueslist'] = 'Waarden lijst';
	$lang['PCP_valueslist_explain'] = 'Lijst van waarden gebruikt door het Profiel Beheer Paneel.';

	$lang['PCP_classesfields'] = 'Klassen';
	$lang['PCP_classesfields_explain'] = 'Hier kunt u de klassen velden aanpassen of verwijderen.';

	$lang['PCP_userfields'] = 'Velden Definitie';
	$lang['PCP_userfields_explain'] = 'Hier kunt u de velden beheren zoals gebruikt in het Profiel Beheer Paneel.';

	$lang['PCP_usermaps'] = 'Mappen definitie';
	$lang['PCP_usermaps_explain'] = 'Hier kunt u de veldenmappen beheren zoals gebruikt op diverse locaties.';

	// fields
	$lang['PCP_field_name'] = 'Veld naam';
	$lang['PCP_field_name_explain'] = 'Vul de veldnaam in, zoals gebruikt in php scripts.';
	$lang['PCP_field_name_short'] = 'Veld';
	$lang['PCP_field_desc'] = 'Beschrijving';
	$lang['PCP_field_image'] = 'Afbeelding';
	$lang['PCP_field_class'] = 'Klasse';
	$lang['PCP_field_type'] = 'Type';
	$lang['PCP_field_get_mode'] = 'Ophaal modus';
	$lang['PCP_field_functions'] = 'Functies';
	$lang['PCP_field_maps_usage'] = 'Gebruikt in mappen';

	$lang['PCP_field_sql_actions'] = 'SQL acties';
	$lang['PCP_field_add'] = 'Voeg nieuw veld toe';

	// fields edit
	$lang['PCP_userfields_edit'] = 'Veld editie';
	$lang['PCP_userfields_edit_explain'] = 'Hier kunt u een veld aanpassen of verwijderen.';

	$lang['PCP_field_definition_part'] = 'Basis definitie';
	$lang['PCP_field_output_part'] = 'Uitvoer';
	$lang['PCP_field_input_part'] = 'Invoer';
	$lang['PCP_field_buddylist_part'] = 'Vrienden/leden lijst';

	$lang['PCP_field_lang_key'] = 'Veldlegenda';
	$lang['PCP_field_lang_key_explain'] = 'Dit is de legenda die gebruikt gaat worden om het veld weer te geven. U kunt een tekst of $lang[] sleutelinvoer gebruiken (bekijk hiervoor <i>uw_taal</i>/lang_main.php).';
	$lang['PCP_field_lang_key_short'] = 'Legenda';
	$lang['PCP_field_explain'] = 'Velduitleg';
	$lang['PCP_field_explain_explain'] = 'Dit is een verklaring voor het te tonen veld. U kunt een tekst of $lang[] sleutelinvoer gebruiken (bekijk hiervoor <i>uw_taal</i>/lang_main.php).';
	$lang['PCP_field_image_explain'] = 'U kunt hier een directe URL gebruiken of een $image[] sleutelinvoer (bekijk hiervoor <i>uw_taal</i>/<i>uw_template</i>.cfg).';
	$lang['PCP_field_title'] = 'Afbeeldingstitel';
	$lang['PCP_field_title_explain'] = 'Tekst afgebeeld bij een mouse-over. U kunt een tekst of $lang[] sleutelinvoer gebruiken (bekijk hiervoor <i>uw_taal</i>/lang_main.php).';
	$lang['PCP_field_class_explain'] = 'Bepaalt, onder welke voorwaarden de inhoud van het veld wordt weergegeven. Gebruik Algemeen voor velden zonder voorwaarde.';
	$lang['PCP_field_type_explain'] = 'Vul het type van het veld in.';

	$lang['PCP_field_sql_def'] = 'SQL definitie';
	$lang['PCP_field_sql_def_explain'] = 'SQL definitie van het veld zoals gebruikt in vrienden/leden lijsten.';

	$lang['PCP_field_get_mode_explain'] = 'Stel hier de methode in waarmee het veld wordt ingevoerd. Voor een zelfgemaakte functie voor het ophalen en controleren van het veld laat u dit veld leeg.';
	$lang['PCP_field_values_list'] = 'Waarden lijst';
	$lang['PCP_field_values_list_explain'] = 'Vul de naam in voor de waarden lijst. Een waarden lijst is nodig voor het gebruik van een LIST_* ophaal modus.';
	$lang['PCP_field_default'] = 'Standaard waarde';
	$lang['PCP_field_default_explain'] = 'Beginwaarde van het veld.';
	$lang['PCP_field_auth'] = 'Gebruikersniveau';
	$lang['PCP_field_auth_explain'] = 'Stel het minimale gebruikersniveau in om dit veld te gebruiken.';
	$lang['PCP_field_get_func'] = 'Ophaal functie';
	$lang['PCP_field_get_func_explain'] = 'Vul de naam in van de zelfgemaakte functie, gebruikt voor de waardenlijst van het veld.';
	$lang['PCP_field_chk_func'] = 'Controleer functie';
	$lang['PCP_field_chk_func_explain'] = 'Vul de naam in van de zelfgemaakte functie, gebruikt om de ingevulde waarden door gebruikers te controleren.';
	$lang['PCP_field_dsp_func'] = 'Toon functie';
	$lang['PCP_field_dsp_func_explain'] = 'Vul de naam in van de zelfgemaakte functie, gebruikt om de waarde van het veld te tonen.';
	$lang['PCP_field_link'] = 'Link';
	$lang['PCP_field_link_explain'] = 'Hiermee kunt u een link maken van de tekst en/of afbeelding. U kunt de [cst.*], [view.*] en [user.*] functies gebruiken om parameters in te vullen. Bijv: <br />&lt;a href="./profile.[php]?mode=viewprofile&[cst.POST_USERS_URL]=[view.user_id]" class="gen"&gt;%s&lt;/a&gt;';

	$lang['PCP_field_leg'] = 'Laat legenda zien';
	$lang['PCP_field_leg_explain'] = 'JA laat de legenda van het veld zien.';
	$lang['PCP_field_leg_short'] = 'Leg';
	$lang['PCP_field_txt'] = 'Laat tekst waarde zien';
	$lang['PCP_field_txt_explain'] = 'JA laat de tekst waarde van het veld zien.';
	$lang['PCP_field_txt_short'] = 'Txt';
	$lang['PCP_field_img'] = 'Laat afbeeldingswaarde zien';
	$lang['PCP_field_img_explain'] = 'JA laat de afbeeldingswaarde van het veld zien.';
	$lang['PCP_field_img_short'] = 'Img';
	$lang['PCP_field_use_link'] = 'Gebruik de link';
	$lang['PCP_field_use_link_explain'] = 'JA stelt deze link in voor de tekst en/of afbeeldingswaarde.';
	$lang['PCP_field_use_link_short'] = 'Lnk';
	$lang['PCP_field_crlf'] = 'Tekst naar volgende regel';
	$lang['PCP_field_crlf_explain'] = 'JA zorgt ervoor dat tekst onder de afbeelding terecht komt.';
	$lang['PCP_field_style'] = 'Span klasse';
	$lang['PCP_field_style_explain'] = 'HTML tag voor meer invloed op de presentatie van tekst. Een <i>sprintf(style, result)</i> word uitgevoerd, dus je moet %s gebruiken om de effectlocatie aan te geven.<br />Voorbeeld: &lt;i&gt;%s&lt/i&gt; zorgt voor een schuingedrukte tekst.';
	$lang['PCP_field_input_id'] = 'Configureer naam veld';
	$lang['PCP_field_input_id_explain'] = 'Dit wordt de waarde naam bij invoervelden, ook gebruikt als een configuratie waarde naam voor de configuratie tabel.';
	$lang['PCP_field_user_only'] = 'Geen configuratiewaarde';
	$lang['PCP_field_user_only_explain'] = 'JA zorgt ervoor dat er geen confuguratiewaarde wordt gemaakt en/of aangepast. Gebruik het om een gebruikers tabelveld aan te geven of een systeemveld.';
	$lang['PCP_field_system'] = 'Systeem veld';
	$lang['PCP_field_system_explain'] = 'JA dwingt dit veld om weergegeven te worden voor invoer, zelfs als het geen configuratie of gebuikersveld is. GET en CHECK functies zijn verplicht. Gebruik dit voor links of knoppen, of andere speciale velden, zoals velden van andere tabellen.';
	$lang['PCP_field_ind'] = 'Optie adres';
	$lang['PCP_field_ind_explain'] = 'Voor vrienden/leden lijsten: dit is het adres van het veld in het gebruiker opties veld.';
	$lang['PCP_field_dft'] = 'Standaard aangevinkt';
	$lang['PCP_field_dft_explain'] = 'Voor vrienden/leden lijsten: standaard keuze van het veld in de vrienden/leden lijst.';
	$lang['PCP_field_rqd'] = 'Dwing de selectie';
	$lang['PCP_field_rqd_explain'] = 'Voor vrienden/leden lijsten: dit dwingt de selectie van het veld in de vrienden/leden lijst.';
	$lang['PCP_field_hidden'] = 'Voeg verborgen veld toe';
	$lang['PCP_field_hidden_explain'] = 'Voor vrienden/leden lijsten: dit voegt het veld verborgen toe aan het SQL verzoek zonder dat het zichtbaar is in de vrienden/leden lijst.';

	$lang['PCP_system_values'] = 'Systeem waarden beschikbaar';

	$lang['PCP_userfields_field_pick_up'] = 'Zoek een veld op';
	$lang['PCP_userfields_lang_key_pick_up'] = 'Zoek een taalsleutel op';

	// fields delete
	$lang['PCP_userfields_delete'] = 'Verwijder een veld';

	// SQL actions
	$lang['PCP_SQL_create_field'] = 'Klik %sHier%s om een veld aan te maken in de gebruikers tabel.<br /><br />';
	$lang['PCP_SQL_modify_field'] = 'Klik %sHier%s om een veld aan te passen in de gebruikers tabel.<br /><br />';
	$lang['PCP_SQL_delete_field'] = 'Wil je het veld verwijderen?';

	$lang['PCP_SQL_create_field_title'] = 'Maak een veld in de gebruikers tabel';
	$lang['PCP_SQL_edit_field_title'] = 'Wijzig een veld in de gebruikers tabel';
	
	$lang['PCP_SQL_field_name'] = 'Veldnaam';
	$lang['PCP_SQL_field_name_explain'] = 'Naam van de tabel kolom.';
	$lang['PCP_SQL_field_type'] = 'Type';
	$lang['PCP_SQL_field_type_explain'] = 'Type van de tabel kolom';
	$lang['PCP_SQL_field_length'] = 'Lengte';
	$lang['PCP_SQL_field_length_explain'] = 'Lengte van de tabel kolom.';
	$lang['PCP_SQL_field_unsigned'] = 'Ongetekend';
	$lang['PCP_SQL_field_unsigned_explain'] = 'Alleen voor nummerieke velden.';
	$lang['PCP_SQL_null'] = 'NULL toegestaan';
	$lang['PCP_SQL_default'] = 'Standaard waarde';
	$lang['PCP_SQL_null_value'] = 'NULL';

	// tables linked
	$lang['PCP_tableslinked_name_short'] = 'Naam';
	$lang['PCP_tableslinked_name'] = 'Tabel gekoppelde naam';
	$lang['PCP_tableslinked_name_explain'] = 'Deze naam identificeert de tabel definitie in de verschillende SQL definities van het PBP, omring door [].<br />(bijv: gebruikers tabel wordt geidentificeert door [USERS])';
	$lang['PCP_tableslinked_id_short'] = 'Id';
	$lang['PCP_tableslinked_id'] = 'SQL id';
	$lang['PCP_tableslinked_id_explain'] = 'SQL identificatie nummer, gebruikt in SQL verzoeken.<br />(bijv : "u" is de standaard gebruikte SQL id voor de gebruikerstabel)';
	$lang['PCP_tableslinked_join'] = 'SQL join';
	$lang['PCP_tableslinked_join_explain'] = 'FROM commando gebruikt in SQL verzoeken.<hr />&nbsp;Gebruik [cst.<i>tabel constante</i>] om de echte tabel naam te krijgen.<br />(bijv: [cst.USERS_TABLE] FOR phpbb_users).<hr />&nbsp;Gebruik [<i>Tabellen gekoppeld naam</i>] om het SQL id te identificeren.<br />(bijv: [USERS].username)<hr />bijv: [cst.USERS_TABLE] AS [USERS]';
	$lang['PCP_tableslinked_where'] = 'SQL where';
	$lang['PCP_tableslinked_where_explain'] = 'WHERE commando gebruikt in SQL verzoeken.<br />Gebruik [<i>Tabellen gekoppeld naam</i>] om het SQL id te identificeren.<br />(bijv: [USERS].username <> \'\')';
	$lang['PCP_tableslinked_order'] = 'SQL order by';
	$lang['PCP_tableslinked_order_explain'] = 'ORDER BY commando gebruikt in SQL verzoeken.<br />Gebruik [<i>Tabellen gekoppeld naam</i>] om het SQL id te identificeren.<br />(bijv: [USERS].username)';
	$lang['PCP_tableslinked_sql_desc'] = 'SQL commando';

	$lang['PCP_tableslinked_add'] = 'Voeg een nieuwe gekoppelde tabel toe';

	// tables linked edit
	$lang['PCP_tableslinked_linked_edit'] = 'Pas gekoppelde tabellen aan';
	$lang['PCP_tableslinked_linked_edit_explain'] = 'Hier kun je een gekoppelde tabel aanpassen of verwijderen.';

	// values list
	$lang['PCP_valueslist_name'] = 'Naam';
	$lang['PCP_valueslist_name_explain'] = 'Deze naam identificeert de waardenlijst in de verschillende SQL definities van de PBP velden, omringd door [].';
	$lang['PCP_valueslist_func'] = 'Functie';
	$lang['PCP_valueslist_func_explain'] = 'Stel hier de naam in van de functie gebruikt om de waardenlijst te maken.';
	$lang['PCP_valueslist_table'] = 'Tabel';
	$lang['PCP_valueslist_table_explain'] = 'Tabel gerelateerde naam gebruikt om de waardenlijst te maken voor dit veld.';
	$lang['PCP_valueslist_values'] = 'Waardes';

	$lang['PCP_valueslist_item_val'] = 'Waarde';
	$lang['PCP_valueslist_item_txt'] = 'Tekst';
	$lang['PCP_valueslist_item_img'] = 'Afbeelding';

	$lang['PCP_valueslist_add'] = 'Voeg een nieuwe waardenlijst toe';

	// values list edit
	$lang['PCP_valueslist_edit'] = 'Aanpasbare waarden lijst';
	$lang['PCP_valueslist_edit_explain'] = 'Hier kun je de waardenlijst aanpassen of verwijderen.';
	$lang['PCP_valueslist_keyfield'] = 'Sleutel veld';
	$lang['PCP_valueslist_keyfield_explain'] = 'Dit veld bevat de waarde van iedere keuzemogelijkheid.';
	$lang['PCP_valueslist_txtfield'] = 'Tekst veld';
	$lang['PCP_valueslist_txtfield_explain'] = 'Dit veld bevat de weer te geven tekst.';
	$lang['PCP_valueslist_imgfield'] = 'Afbeelding';
	$lang['PCP_valueslist_imgfield_explain'] = 'Dit veld bevat een weer te geven afbeelding.';

	$lang['PCP_valueslist_add_item'] = 'Voeg een nieuwe waarde toe';
	$lang['PCP_valueslist_del_item'] = 'Verwijder selectie';

	// classes fields
	$lang['PCP_classesfields_name'] = 'Klasse naam';
	$lang['PCP_classesfields_name_explain'] = 'Deze naam identificeert de klasse van een veld.';
	$lang['PCP_classesfields_config'] = 'Configuratie veld';
	$lang['PCP_classesfields_config_explain'] = 'Stel hier in of het veld gebruikt kan worden door board administrators om de velden van deze klasse wel of niet aan alle gebruikers te geven.';
	$lang['PCP_classesfields_admin'] = 'Admin veld';
	$lang['PCP_classesfields_admin_explain'] = 'Stel hier het veld in voor gebruiker admins om de velden van deze klasse wel of niet aan een specifieke gebruiker te kunnen geven.';
	$lang['PCP_classesfields_user'] = 'Gebruikers veld';
	$lang['PCP_classesfields_user_explain'] = 'Stel hier het gebruikers voorkeuren veld in dat wordt gebruikt om deze informatie wel of niet weer te geven.';
	$lang['PCP_classesfields_sql_def'] = 'SQL definitie';
	$lang['PCP_classesfields_sql_def_explain'] = 'Dit is de SQL definitie voor deze klasse zoals gebruikt in de vrienden/leden lijst.';

	$lang['PCP_classesfields_add'] = 'Voeg een nieuwe klasse toe';

	// classes fields edit
	$lang['PCP_classesfields_edit'] = 'Pas klasse aan';
	$lang['PCP_classesfields_edit_explain'] = 'Hier kun je een klasse verwijderen of aanpassen.';

	// usermaps
	$lang['PCP_usermaps_root'] = 'Root';

	$lang['PCP_usermaps_name'] = 'Map naam';
	$lang['PCP_usermaps_name_explain'] = 'Deze naam identificeert de gebruikte map.';
	$lang['PCP_usermaps_split'] = 'Kolom aanmaken';
	$lang['PCP_usermaps_split_explain'] = 'Verdeel het venster in een nieuwe kolom.';
	$lang['PCP_usermaps_sub'] = 'Submappen';
	$lang['PCP_usermaps_add'] = 'Voeg een nieuwe map toe';
	$lang['PCP_usermaps_custom'] = 'Gebruikte programma';
	$lang['PCP_usermaps_custom_explain'] = 'Stel hier in of je dit door een standaard paneel wilt laten weergeven.';
	$lang['PCP_custom_none'] = 'Toegewijd programma';
	$lang['PCP_custom_input'] = 'Standaard invoer programma';
	$lang['PCP_custom_output'] = 'Standaard uitvoer programma';

	$lang['PCP_usermaps_fields'] = 'Velden';

	// usermaps edit
	$lang['PCP_usermaps_edit'] = 'Pas map aan';
	$lang['PCP_usermaps_edit_explain'] = 'Hier kun je een map verwijderen of aanpassen.';
	$lang['PCP_usermaps_title'] = 'Map titel';
	$lang['PCP_usermaps_title_explain'] = 'De mapnaam wordt gebruikt in sommige vensters. Vul hier een titel in of een veld om de titel mee te maken.';
	$lang['PCP_usermaps_parent'] = 'Hoofdmap';
	$lang['PCP_usermaps_parent_explain'] = 'Stel hier in aan welke map deze map is verbonden.';

	$lang['PCP_usermaps_add_titlefield'] = 'Voeg een nieuw titelveld toe';
	$lang['PCP_usermaps_add_field'] = 'Voeg een nieuw veld toe';

	// usermaps field edit
	$lang['PCP_usermaps_title_edit'] = 'Veldnaam aanpassen';
	$lang['PCP_usermaps_title_edit_explain'] = 'Hier kun je een veld zoals gebruikt in de maptitel verwijderen of aanpassen.';
	$lang['PCP_usermaps_field_edit'] = 'Veld aanpassen';
	$lang['PCP_usermaps_field_edit_explain'] = 'Hier kun je een veld zoals gebruikt in de veldmap verwijderen of aanpassen.';

	// error msgs
	$lang['PCP_err_field_already_exists'] = 'De veldnaam bestaat al.';
	$lang['PCP_err_field_name_not_valid'] = 'De veldnaam is ongeldig.';
	$lang['PCP_err_field_lang_key_missing'] = 'Taalsleutel ontbreekt.';
	$lang['PCP_err_field_class_unknown'] = 'Onbekende klasse.';
	$lang['PCP_err_field_type_unknown'] = 'Onbekend type.';
	$lang['PCP_err_field_get_mode_unknown'] = 'Onbekende GET mode.';
	$lang['PCP_err_field_values_list_unknown'] = 'Onbekende waardenlijst.';
	$lang['PCP_err_field_auth_unknown'] = 'Onbekend gebruikers niveau.';

	$lang['PCP_err_field_values_list_missing'] = 'Een waardenlijst moet ingevuld worden als je LIST_* GET mode instelt.';
	$lang['PCP_err_field_values_list_presents'] = 'Je kunt geen waardenlijst gebruiken als je geen LIST_* GET mode instelt.';
	$lang['PCP_err_field_get_mode_presents'] = 'Je kunt geen GET mode instellen als je GET en CHECK functies gebruikt.';
	$lang['PCP_err_field_dsp_func_not_valid'] = 'De display functie heeft een ongeldige naam.';
	$lang['PCP_err_field_dsp_func_unknown'] = 'De display functie is onbekend.';
	$lang['PCP_err_field_get_func_not_valid'] = 'De GET functie heeft een ongeldige naam.';
	$lang['PCP_err_field_chk_func_not_valid'] = 'De CHECK functie heeft een ongeldige naam.';
	$lang['PCP_err_field_get_chk_func_missing'] = 'Je moet zowel CHECK als GET invullen.';

	$lang['PCP_err_sql_delete_not_allow'] = 'Je kunt dit veld niet verwijderen van de gebruikers tabel.';
	$lang['PCP_err_sql_edit_not_allow'] = 'Je kunt geen veld aanmaken of aanpassen in de gebruikers tabel.';
	$lang['PCP_err_sql_decimal_not_allow'] = 'Je kunt geen decimalen instellen zonder een decimaal type te gebruiken.';
	$lang['PCP_err_sql_decimal_too_high'] = 'Aantal decimalen mag niet groter of gelijk zijn aan de veldlengte.';
	$lang['PCP_err_sql_length_missing'] = 'De veldlengte ontbreekt.';
	$lang['PCP_err_sql_unsigned_not_allow'] = 'Ongetekend is alleen toegestaan bij nummerieke waarden.';
	$lang['PCP_err_sql_default_null_not_allow'] = 'Standaard waarde mag niet NULL zijn als het veld geen NULL waarden mag bevatten.';
	$lang['PCP_err_sql_failed'] = 'Dit SQL commando heeft gefaald:';

	$lang['PCP_err_tableslinked_already_exists'] = 'De tabel naam bestaat al.';
	$lang['PCP_err_tableslinked_name_not_valid'] = 'De gelinkte tabel naam is ongeldig.';
	$lang['PCP_err_tableslinked_sql_id_not_valid'] = 'Het gelinkte tabel-ID is ongeldig.';
	$lang['PCP_err_tableslinked_sql_join_missing'] = 'De samenvoegtabellen zijn leeg.';

	$lang['PCP_err_valueslist_already_exists'] = 'De waardenlijst naam bestaat al.';
	$lang['PCP_err_valueslist_name_not_valid'] = 'De waardenlijst naam is ongeldig.';
	$lang['PCP_err_valueslist_func_not_valid'] = 'De waardenlijst functie is ongeldig.';
	$lang['PCP_err_valueslist_no_data'] = 'De waardenlijst is leeg.';

	$lang['PCP_err_classesfields_already_exists'] = 'De klassenaam bestaat al.';
	$lang['PCP_err_classesfields_name_not_valid'] = 'De klassenaam is ongeldig.';
	$lang['PCP_err_classesfields_config_field_not_valid'] = 'Het configuratieveld is ongeldig.';
	$lang['PCP_err_classesfields_admin_not_valid'] = 'Het adminveld is ongeldig.';
	$lang['PCP_err_classesfields_user_not_valid'] = 'Het gebruikersveld is ongeldig.';

	$lang['PCP_err_usermaps_already_exists'] = 'Deze map bestaat al.';
	$lang['PCP_err_usermaps_name_not_valid'] = 'Deze mapnaam is ongeldig.';
	$lang['PCP_err_usermaps_not_empty'] = 'Er zijn nog mappen verbonden aan de map die je wilt verwijderen. Verbind deze eerst anders voor je verder gaat.';
	$lang['PCP_err_usermaps_field_already_in_map'] = 'Dit veld bestaat al.';

	// global message, return path
	$lang['PCP_field_created'] = 'De veld definitie is aangemaakt.<br /><br />Klik %sHier%s om terug te keren naar de velden lijst.';
	$lang['PCP_field_modified'] = 'De veld definitie is aangepast.<br /><br />Klik %sHier%s om terug te keren naar de velden lijst.';
	$lang['PCP_field_delete'] = 'Weet je zeker dat je de definitie <b>%s</b> wilt verwijderen?';
	$lang['PCP_field_deleted'] = 'De veld definitie is verwijderd.<br /><br />Klik %sHier%s om terug te keren naar de velden lijst.';

	$lang['PCP_sql_field_created'] = 'Het veld is succesvol aangemaakt in de gebruikers tabel.<br /><br />Klik %sHier%s om terug te keren naar de velden lijst.';
	$lang['PCP_sql_field_modified'] = 'Het veld is succesvol aangepast in de gebruikers tabel.<br /><br />Klik %sHier%s om terug te keren naar de velden lijst.';
	$lang['PCP_sql_field_deleted'] = 'Het veld is succesvol verwijderd van de gebruikers tabel.<br /><br />Klik %sHier%s om terug te keren naar de velden lijst.';
	$lang['PCP_sql_field_deleted_short'] = 'Het veld is succesvol verwijderd van de gebruikers tabel.';

	$lang['PCP_tableslinked_created'] = 'De gekoppelde tabel definitie is aangemaakt.<br /><br />Klik hier om terug te keren naar de gekoppelde tabellen lijst.';
	$lang['PCP_tableslinked_modified'] = 'De gekoppelde tabel definitie is aangepast.<br /><br />Klik hier om terug te keren naar de gekoppelde tabellen lijst.';
	$lang['PCP_tableslinked_deleted'] = 'De gekoppelde tabel definitie is verwijderd.<br /><br />Klik hier om terug te keren naar de gekoppelde tabellen lijst.';

	$lang['PCP_valueslist_created'] = 'De waarden lijst definitie is aangemaakt.<br /><br />Klik hier om terug te keren naar de waarden lijst.';
	$lang['PCP_valueslist_modified'] = 'De waarden lijst definitie is aangepast.<br /><br />Klik hier om terug te keren naar de waarden lijst.';
	$lang['PCP_valueslist_deleted'] = 'De waarden lijst definitie is verwijderd.<br /><br />Klik hier om terug te keren naar de waarden lijst.';

	$lang['PCP_classesfields_created'] = 'De klassen definitie is aangemaakt.<br /><br />Klik %sHier%s om terug te keren naar de klassen lijst.';
	$lang['PCP_classesfields_modified'] = 'De klassen definitie is aangepast.<br /><br />Klik %sHier%s om terug te keren naar de klassen lijst.';
	$lang['PCP_classesfields_deleted'] = 'De klassen definitie is verwijderd.<br /><br />Klik %sHier%s om terug te keren naar de klassen lijst.';

	$lang['PCP_usermaps_created'] = 'De mappen definitie is aangemaakt.<br /><br />Klik %sHier%s om terug te keren naar de mappen lijst.';
	$lang['PCP_usermaps_modified'] = 'De mappen definitie is aangepast.<br /><br />Klik %sHier%s om terug te keren naar de mappen lijst.';
	$lang['PCP_usermaps_deleted'] = 'De mappen definitie is verwijderd.<br /><br />Klik %sHier%s om terug te keren naar de mappen lijst.';

	// generic
	$lang['PCP_config_values'] = 'Configureer waarden';
	$lang['PCP_view_user_values'] = 'Gebruiker zichtbare velden';
	$lang['PCP_user_values'] = 'Gebruiker invoer velden';

	$lang['Refresh'] = 'Vernieuw';
	$lang['Create'] = 'Maak aan';
	$lang['Suggest'] = 'Voorstel';
	$lang['More'] = 'Meer...';

	$lang['Auth_GUEST'] = 'Iedereen';
	$lang['Auth_USER'] = 'Geregistreerde gebruiker';
	$lang['Auth_ADMIN'] = 'Gebruikers Beheerder';
	$lang['Auth_BOARD_ADMIN'] = 'Board Oprichter';

	$lang['Up'] = '^';
	$lang['Down'] = 'v';

	$lang['Linefeed'] = '---';

	// PCP Extra :: Added :: Start
	$lang['PCP_field_required'] = 'Vereist veld';
	$lang['PCP_field_required_explain'] = 'Zet deze op Ja en de gebruiker wordt gedwongen dit veld in te vullen.';
	$lang['Auth_GUEST_ONLY'] = 'Alleen Gasten';
	$lang['PCP_field_visibility'] = 'Zichtbaar voor';
	$lang['PCP_field_visibility_explain'] = 'Gebruiker tonen, wie gaat de ingevoerde data zien.';
	$lang['PCP_field_inputstyle'] = 'Input Sjabloon stijl';
	$lang['PCP_field_inputstyle_explain'] = 'In board_config_body.tpl zullen we het html sjabloon tussen &lt;!-- BEGIN inputstyle --&gt; en &lt;!-- END inputstyle --&gt; zetten, waar inputstyle wordt vervangen door de naam die je hier invult. Laat leeg voor standaard, dat is "field".';
	// PCP Extra :: Added :: End
}

?>