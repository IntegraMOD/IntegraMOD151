<?php
/****************************************************************
*
*                       lang_banner.php [Nederlands]
*
*  MOD Title:   Complete banner  
*  MOD Version: 1.2.0.
*  Rev date:    10/12/2003
*  
*   Nederlandse vertaling  : Maart 2005 
*   The Dutch Team         : http://www.integramod.nl 
* 
*   note: removing the original copyright is illegal even you 
*         have modified the code. Just append yours if you
*         have modified it. 
*****************************************************************/

/****************************************************************
*
*   This program is free software; you can redistribute it and/or
*   modify it under the terms of the GNU General Public License as
*   published by the Free Software Foundation; either version 2
*   of the License, or (at your option) any later version.
*
****************************************************************/

// this is the text showen in admin panel, depending on your template layout,
// you may change the text, so this reflect the placement in the templates
// these are only exampels, you may add more or remove some of them.

$lang['Banner_spot']['0'] = "Over all banner"; // used for {BANNER_0_IMG} tag in the template files
$lang['Banner_spot']['1'] = "Top links 1"; // used for {BANNER_1_IMG} tag in the template files
$lang['Banner_spot']['2'] = "Top links 2"; // used for {BANNER_2_IMG} tag in the template files
$lang['Banner_spot']['3'] = "Top midden 1"; // used for {BANNER_3_IMG} tag in the template files
$lang['Banner_spot']['4'] = "Top midden 2"; // used for {BANNER_4_IMG} tag in the template files
$lang['Banner_spot']['5'] = "Top rechts 1"; // used for {BANNER_5_IMG} tag in the template files
$lang['Banner_spot']['6'] = "Top rechts 2"; // used for {BANNER_6_IMG} tag in the template files
$lang['Banner_spot']['7'] = "Onder links 1"; // used for {BANNER_7_IMG} tag in the template files
$lang['Banner_spot']['8'] = "Onder links 2"; // used for {BANNER_8_IMG} tag in the template files
$lang['Banner_spot']['9'] = "Onder midden 1"; // used for {BANNER_9_IMG} tag in the template files
$lang['Banner_spot']['10'] = "Onder midden2"; // used for {BANNER_10_IMG} tag in the template files
$lang['Banner_spot']['11'] = "Onder rechts 1"; // used for {BANNER_11_IMG} tag in the template files
$lang['Banner_spot']['12'] = "Onder rechts 2"; // used for {BANNER_12_IMG} tag in the template files
$lang['Banner_spot']['13'] = "Forum_venster top"; // used for {BANNER_13_IMG} tag in the template files
$lang['Banner_spot']['14'] = "Onderwerp venster top"; // used for {BANNER_14_IMG} tag in the template files
$lang['Banner_spot']['15'] = "Onderwerp venster onder"; // used for {BANNER_15_IMG} tag in the template files
$lang['Banner_spot']['16'] = "Portaal Boven"; // used for {BANNER_16_IMG} tag in the template files
$lang['Banner_spot']['17'] = "Portaal Onder"; // used for {BANNER_17_IMG} tag in the template files
$lang['Banner_spot']['18'] = "Index Boven"; // used for {BANNER_18_IMG} tag in the template files
$lang['Banner_spot']['19'] = "Index Onder"; // used for {BANNER_19_IMG} tag in the template files
$lang['Banner_spot']['20'] = "Portaal Link Block 1"; // used for {BANNER_20_IMG} tag in the template files
$lang['Banner_spot']['21'] = "Portaal Link Block 2"; // used for {BANNER_21_IMG} tag in the template files
$lang['Banner_spot']['22'] = "Portaal Link Block 3"; // used for {BANNER_22_IMG} tag in the template files
$lang['Banner_spot']['23'] = "Portaal Link Block 4"; // used for {BANNER_23_IMG} tag in the template files

//
// please do not modify the text below (except if you are translating)
//
$lang['Banner_title'] = "Banner Beheer";
$lang['Banner_text'] = "Hier kun je de banners van deze site wijzigen, banners kunnen gedefinieerd worden met een tijd gebaseerde regel";
$lang['Add_new_banner'] = "Nieuwe banner";
$lang['Banner_add_text'] = "Hier kun je een banner toevoegen/wijzigen";

$lang['Banner_example']="Voorbeeld";
$lang['Banner_example_explain'] ="Zo zal je de banner zien";
$lang['Banner_type_text'] = "Type";
$lang['Banner_type_explain'] = "Selecteer het type banner";
//pre-defined types
$lang['Banner_type'][0] = "Plaatje link";
$lang['Banner_type'][2] = "Tekst link";
$lang['Banner_type'][4] = "HTML code";
$lang['Banner_type'][6] = "Flash bestand";

$lang['Banner_name'] = "Plaatje path/Tekst/Code";
$lang['Banner_name_explain'] = "path moet relatief zijn tot het phpbb2 path of een complete URL (inclusief http://)";
$lang['Banner_size'] = "Plaatje grote";
$lang['Banner_size_explain'] = "wanneer de grote is nul, zal het plaatje de standaard grote krijgen";
$lang['Banner_width'] = "Breedte";
$lang['Banner_height'] = "Hoogte";

$lang['Banner_activated'] = "Geactiveerd";
$lang['Banner_activate'] = "Banner Activeren";
$lang['Banner_comment'] = "Commentaar";
$lang['Banner_description'] = "Omschrijving Plaatje";
$lang['Banner_description_explain'] = "Deze tekst zie je wanneer je met de muis over de banner gaat";
$lang['Banner_url'] = "Redirect url";
$lang['Banner_url_explain'] ="De url van de site waar naartoe geschakeld wordt, Klik van de muis, begin met HTTP://<br />(De redirect URL werkt alleen wanneer het type een Plaatje of Text link is)";
$lang['Banner_owner']="Moderator van de banner";
$lang['Banner_owner_explain']="Deze gebruiker kan de banner beheren- (not implemented jet)";
$lang['Banner_placement'] = "Plaats";
$lang['Banner_clicks'] = "Klik\'s";
$lang['Banner_clicks_explain'] = "(De teller werkt alleen wanneer het type een Plaatje of Text link is)";
$lang['Banner_view'] = "Bekeken";
$lang['Banner_weigth'] = "Gewicht van de banner";
$lang['Banner_weigth_explain'] = "Hoe vaak moeten we de banner laten zien, relatief tot andere active banners op dit tijdstip. (1-99)";
$lang['Show_to_users'] ='Gebruikers laten zien';
$lang['Show_to_users_explain'] ='Selecteer welk type gebruiker deze banner moet zien';
$lang['Show_to_users_select'] = 'Gebruikers moeten %s aan %s'; //%s are supstituded with dropdown selections
$lang['Banner_level']['-1'] = 'Gast';
$lang['Banner_level']['0'] = 'Geregistreerd';
$lang['Banner_level']['1'] = 'Moderator';
$lang['Banner_level']['2'] = 'Beheerder';
$lang['Banner_level_type']['0'] = 'gelijk aan';
$lang['Banner_level_type']['1'] = 'minder dan of gelijk aan';
$lang['Banner_level_type']['2'] = 'groter of gelijk aan';
$lang['Banner_level_type']['3'] = 'niet';

$lang['Time_interval'] = "Tijd interval";
$lang['Time_interval_explain'] = "Kies, of een datum, een dag van de week en/of een tijd";
$lang['Start'] = "Start";
$lang['End'] = "Einde";
$lang['Year'] = "Jaar";
$lang['Month'] = "Maand";
$lang['Date'] = "Datum";
$lang['Weekday'] = "WeekDag";
$lang['Hour'] = "Uur";
$lang['Min'] = "Min";
$lang['Time_type'] = "Tijd type";
$lang['Time_type_explain'] = "Selecteer een tijd of een datum interval <i>(je kunt alsnog een tijd interval kiezen, wanneer je een datum gebaseerd type kiest)</i>";
$lang['Not_specify'] = "Niet gespecificeerd";
$lang['No_time'] = "Geen";
$lang['By_time'] = "Op tijd";
$lang['By_week'] = "Op weekdag";
$lang['By_date'] = "Op datum";

// messages
$lang['Missing_banner_id'] = "De banner id ontbreekt";
$lang['Missing_banner_owner'] = "Je moet een banner eigenaar kiezen";
$lang['Missing_time'] = "Wanneer je een Tijd banner definieerd, moet je minimaal een tijd interval kiezen";
$lang['Missing_date'] ="Wanneer je een Datum banner definieerd, moet je minimaal een datum en een tijd interval kiezen";
$lang['Missing_week'] ="Wanneer je een weekdag banner definieerd, moet je minimaal een dag van de week en een tijd interval kiezen";

$lang['Banner_removed'] = "De banner is nu verwijderd";
$lang['Banner_updated'] = "De banner is nu aangepast";
$lang['Banner_added'] = "De banner is nu toegevoegd";
$lang['Click_return_banneradmin'] = 'Terug naar Banner beheer Klik %sHier%s';

$lang['No_redirect_error'] = 'Wanneer de pagina niet komt, Klik dan <b><a href="%s" id="jumplink" name="jumplink">Hier<a></b> om naar die pagina te gaan';
$lang['Left_via_banner'] = 'Vertrokken via banner';

$lang['Banner_filter'] = 'Banner filter';
$lang['Banner_filter_explain'] = 'Verberg deze banner wanneer de gebruiker er op geklikt heeft';
$lang['Banner_filter_time'] = 'Inactieve klik tijd';
$lang['Banner_filter_time_explain'] = 'Aantal seconden dat de banner niet actief is nadat een gebruiker er op geklikt heeft, wanneer banner filter is ingeschakeld, de banner zal ook niet zichtbaar zijn in die tijd';

?>