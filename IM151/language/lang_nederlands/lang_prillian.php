<?php
/****************************************************************
 *                          lang_prillian.php [Nederlands]
 *                            -------------------
 *   begin                : Friday, Jan 31, 2003
 *   version              : 0.7.0
 *   date                 : 2003/12/23 23:21
 *
 *   Nederlandse vertaling  : Maart 2005 
 *   The Dutch Team         : http://www.integramod.nl
 * 
 *   note: removing the original copyright is illegal even you 
 *         have modified the code. Just append yours if you
 *         have modified it. 
 ***************************************************************/

/****************************************************************
 *
 *   This program is free software; you can redistribute it and/or
 *   modify it under the terms of the GNU General Public License as
 *   published by the Free Software Foundation; either version 2
 *   of the License, or (at your option) any later version.
 *
 ***************************************************************/

//
// CONTRIBUTORS:
//	 Add your details here if wanted, e.g. Name, username, email address, website
//

//
// The format of this file is ---> $lang['message'] = 'text';
// The file will be included separately of other language files as needed, but must
// be included after lang_main.php and/or lang_admin.php
//
//
// This is optional, if you would like a _SHORT_ message output
// along with the phpBB copyright message indicating you are the translator
// please add it here.
$lang['TRANSLATION_INFO'] = ' <br />[ <font style="font-size: 10px; color: #ec7600">Ondersteuning: <a href="http://www.integramod.nl">IntegraMOD Nederland(s)©</a></font> :: <font style="font-size: 10px; color: #ec7600">Vertaling: <a href="http://www.integramod.nl">The Dutch Team</a></font> ]';

// Do not change the next six lines.
// Avoid including the file more than once.
if ( defined('IN_PRILLIAN_LANG') )
{
	return;
}
define('IN_PRILLIAN_LANG', true);

// You may want to edit the following lines to match your website.
$lang['Launch_Prillian'] = 'Start Prillian';  // Link for opening the IM Client
$lang['Prillian_FAQ'] = 'Instant Messenger';   // Title of the IM FAQ
$lang['Prillian'] = 'Prillian';  // Name of Prillian, used throughout the scripts

$lang['New_ims'] = 'Je hebt %d nieuwe IM\'s'; // You have 2 new IMs
$lang['New_im'] = 'Je hebt %d nieuwe IM'; // You have 1 new IM
$lang['Unread_ims'] = 'Je hebt %d ongelezen IM\'s'; // You have 2 new IMs
$lang['Unread_im'] = 'Je hebt %d ongelezen IM'; // You have 1 new IM

// Main IM Client/Who's Online window
$lang['Users_Online'] = 'Gebruikers Online';
$lang['Buddies_Online']	= 'Vrienden Online';
$lang['Hidden_Users_Online'] = 'Verborgen Gebruikers Online';
$lang['Guests_Online'] = 'Gasten Online';
$lang['Close_windows'] = 'Sluit vensters';
$lang['Send_im'] = 'Verstuur Instant Message';
$lang['IM'] = 'IM';
$lang['PM'] = 'PB';
$lang['New_messages'] = 'Nieuwe en ongelezen berichten';


// Controls panels
$lang['Controls'] = 'Menu';
$lang['Check_IMs'] = 'Bekijk IM\'s';
$lang['Message_Log'] = 'Berichten Log';
$lang['Alt_Message_Log'] = 'Open Berichten Log';
$lang['Alt_New_Messages'] = 'Bekijk Nieuwe Berichten';
$lang['Alt_Home'] = 'Terug naar Forums';
$lang['Alt_Close_Windows'] = 'Sluit alle extra schermen';
$lang['Alt_Prefs'] = 'Bewerk ' . $lang['Prillian'] . ' Voorkeuren';
$lang['Alt_Logout'] = 'Uitloggen, Forum en ' . $lang['Prillian'];
$lang['Prillian_Help'] = 'Help';


// Sending/replying
$lang['phpBB_IM_default_subject'] = $lang['Message'];
$lang['Send_new_im'] = 'Verzend een nieuwe Instant Message';
$lang['Select_emoticon'] = 'Selecteer Emoticons';
$lang['Save_reply_pm'] = 'Opslaan en Antwoorden';
$lang['Save_close_pm'] = 'Opslaan en Sluiten';
$lang['Delete_reply_pm'] = 'Verwijderen en Antwoorden';
$lang['Delete_close_pm'] = 'Verwijderen en Sluiten';
$lang['IM_Quick_reply'] = 'Snel Antwoord';


// Error messages
$lang['Close_window_link'] = '<br /><br /><a href="javascript:window.close();">' . $lang['Close_window'] . '</a>';
$lang['IM_disabled'] = 'Sorry, maar Instant Messaging is uitgeschakeld op dit bord.';
$lang['Ims_not_allowed'] = 'Sorry, maar Instant Messaging is uitgeschakeld voor die gebruikers account.';
$lang['Ims_not_allowed_fail'] = 'Kon niet bepalen of instant messaging uitgeschakeld is voor die gebruikers account.';
$lang['Cannot_send_im'] = 'Sorry, maar Instant Messaging is in jouw account uitgeschakeld. Als je het zelf uitgeschakeld hebt, kun je het weer inschakelen in je %svoorkeuren%s.';
$lang['Cannot_send_im_admin'] = 'Sorry, maar Instant Messaging is in jouw account door de beheerder uitgeschakeld.';
$lang['Please_set_im_prefs'] = 'Je hebt je Instant Messenger voorkeuren nog niet opgegeven. Neem AUB even de tijd om dat %shier%s te doen.';
$lang['Admin_override'] = 'Sorry, maar de beheerder heeft opgegeven dat gebruikersvoorkeuren worden overschreven met algemene bord instellingen. Zolang dit het geval is, kun je je voorkeuren niet wijzigen.';
$lang['Too_many_ims'] = 'Sorry, maar die gebruiker heeft teveel wachtende Instant Messages. Probeer het later weer.';
$lang['No_autoclose'] = 'Wanneer je deze boodschap ziet, werkt de automatische venstersluiting van ' . $lang['Prillian'] . ' niet in jouw browser. Mogelijke oorzaak is dat Javascript uitgeschakeld staat in je browser. Sluit dit venster handmatig.';
$lang['User_no_im'] = 'Je kunt geen Instant Message naar die gebruiker versturen. ';
$lang['No_im_reply_info'] = 'Kon berichten informatie niet ophalen. Dit betekent waarschijnlijk dat het bericht reeds automatisch verwijderd is.';
$lang['No_Admins_Found'] = 'Er konden geen beheerders worden gevonden in de database.';
$lang['No_post_type'] = 'Kon het berichten type niet bepalen.';
$lang['Admin_no_user_from'] = 'Kon niet bepalen welke verzender er opgezocht moest worden.';
$lang['Admin_no_user_to'] = 'Kon niet bepalen welke ontvanger er opgezocht moest worden.';


// Site to Site
$lang['IM_no_users_online'] = 'Er zijn geen gebruikers online.';
$lang['Online_at'] = 'Gebruiker is online op ';
$lang['User_from'] = 'Gebruiker van ';


// Admin Site to Site
$lang['URL'] = 'URL';
$lang['Extension'] = 'Bestands Extensie';
$lang['Profile_path'] = 'Path naar profile';
$lang['Extension_explain'] = 'Dit is standaard "php"';
$lang['Profile_path_explain'] = 'Dit is standaard "profile"';


// Preferences editor
$lang['Prillian_Profile_updated'] = 'Je voorkeuren zijn bijgewerkt.<br /><br />Indien noodzakelijk, klik %shier%s om de IM Client opnieuw te laden.';

$lang['User_allow_ims'] = 'Schakel het Instant Messaging Systeem in voor deze account';
$lang['User_allow_shout'] = 'Sta gebruik van shoutbox toe';
$lang['User_allow_chat'] = 'Sta gebruik van chatbox toe';
$lang['Always_add_sig_explain'] = 'Handtekening kan in je profiel gewijzigd worden';
$lang['Refresh_rate'] = 'Vernieuwingsfrequentie van het Hoofdvenster';
$lang['Refresh_rate_explain1'] = 'Aantal seconden tussen vernieuwingen van de IM Client.';
$lang['Refresh_rate_explain2'] = 'Tijd tussen vernieuwingen van de IM Client.';
$lang['Success_close'] = 'Sluit berichtenvensters automatisch na het verzenden van een bericht';
$lang['Refresh_method'] = 'Kies vernieuwingsmethode IM Client';
$lang['Refresh_method_explain'] = 'Beide gebruiken wordt aanbevolen';
$lang['JavaScript'] = 'JavaScript';
$lang['META_tag'] = 'META tag'; 
$lang['Use_both_methods'] = 'Gebruik Beide';
$lang['IM_auto_launch_pref'] = 'Open de Client wanneer je de Hoofd pagina bezoekt'; 
$lang['IM_auto_popup'] = 'Open nieuwe berichten automatisch';
$lang['IM_list_new'] = 'Toon nieuwe en ongelezen berichten in hoofdvenster';
$lang['Show_controls'] = 'Toon Controle Paneel';

// Do not change the [0], [1], etc. parts of the following
$lang['Controls_select'][0] = 'Niet tonen';
$lang['Controls_select'][1] = 'Enkel Als Plaatjes';
$lang['Controls_select'][2] = 'Enkel Als Links';
$lang['Controls_select'][3] = 'Als Beide';
$lang['Who_to_list'] = 'Toon deze gebruikers in het hoofdvenster';
$lang['Online_Lists'][1] = 'Alle online gebruikers';
$lang['Online_Lists'][2] = 'Vrienden op forums';
$lang['Online_Lists'][3] = 'Vrienden op IM';
$lang['Online_Lists'][4] = 'Alle gebruikers op IM';

// Include any options you want in the refresh rate drop down list here
// They should be in this format:
// $lang['Refresh_times']['number of seconds'] = 'name in list';
// The number of seconds can be no longer than 5 digits, unless you alter
// the im_prefs database table.
$lang['Refresh_times'][60] = '1 minuut';
$lang['Refresh_times'][120] = '2 minuten';
$lang['Refresh_times'][180] = '3 minuten';
$lang['Refresh_times'][240] = '4 minuten';
$lang['Refresh_times'][300] = '5 minuten';

$lang['IM_play_sound'] = 'Speel geluid bij nieuwe berichten';
$lang['Default_sound'] = 'Gebruik standaardgeluid van het bord';
$lang['Current_sound'] = 'Huidige Geluidsbestand';
$lang['IM_style'] = 'Stijl gebruikt door ' . $lang['Prillian'];
$lang['Width'] = 'Breedte';
$lang['Height'] = 'Hoogte';
$lang['Read_Message'] = 'Lees Bericht';
$lang['Send_Message'] = 'Verzend Bericht';
$lang['Set_window_sizes'] = 'Geef Venstergrootte Op';
$lang['Set_window_sizes_explain'] = 'Alle groottes zijn in Pixels';
$lang['Open_pms'] = 'Open en/of toon prive berichten';
$lang['Auto_delete_ims'] = 'Schakel automatische verwijdering van gelezen IM\'s bij vernieuwing van de IM Client in';

// Admin preferences editor
$lang['Admin_allow_ims'] = 'Sta toe dat gebruiker IM\'s kan verzenden en ontvangen';
$lang['Admin_allow_shout'] = 'Sta toe dat gebruiker shoutbox gebruikt';
$lang['Admin_allow_chat'] = 'Sta toe dat gebruiker chatbox gebruikt';
$lang['IM_user_auto_launch'] = 'Start client automatisch wanneer gebruiker de Hoofd pagina bezoekt en ingelogd is';
$lang['Admin_user_added'] = 'De gebruiker is toegevoegd aan de voorkeuren database.';
$lang['Admin_Set_window_sizes'] = 'Stel Standaard Venstergroottes In';


// Admin Configuration
$lang['IM_auto_launch'] = 'Start client automatisch wanneer ingelogde gebruiker de Hoofd pagina bezoekt'; 
$lang['IM_box_limit'] = 'Maximum aantal ongelezen IM\'s';
$lang['IM_enable_flood'] = 'Schakel Flood Control In';
$lang['IM_override_settings'] = 'Overschrijf individuele gebruikers voorkeuren';
$lang['IM_override_settings_explain'] = 'Dit schakelt de Gebruikers Voorkeuren uit en gebruikt de hier standaard ingestelde bordopties';
$lang['IM_enable_ims'] = 'Schakel Instant Messaging Systeem In';
$lang['IM_enable_shoutbox'] = 'Schakel Shoutbox In';
$lang['IM_enable_chatbox'] = 'Schakel Chatbox In';
$lang['IM_refresh_drop'] = 'Gebruik schuifmenu voor gebruikersvoorkeur vernieuwingsfrequentie';
$lang['IM_sound_name'] = 'Locatie van geluidsbestand';
$lang['IM_allow_sound'] = 'Sta gebruikers toe een geluid af te spelen wanneer ze nieuwe berichten ontvangen';
$lang['IM_default_sound'] = 'Sta gebruikers toe hun eigen geluid af te spelen';
$lang['IM_allow_different_style'] = 'Moet ' . $lang['Prillian'] . ' de zelfde stijl gebruiken als de rest van het forum';
$lang['Prillian_Config'] = 'Algemene ' . $lang['Prillian'] . ' Instellingen';
$lang['Prillian_Config_explain'] = 'In het onderstaande formulier kun je alle algemene instellingen van de Prillian wijzigen. Deze worden gebruikt om de standaard werking en gebruikersopties in te stellen. Voor individuele gebruiker configuraties kun je gebruik maken van de gerelateerde links in het andere frame.';
$lang['IM_session_length'] = 'IM Client Sessie Lengte in Seconden';
$lang['IM_session_length_explain'] = 'Dit wordt gebruikt om te bepalen of een gebruiker actief is in de Prillian. Er wordt aanbevolen deze groter in te stellen dan de vernieuwingsfrequentie.';
$lang['IM_enable_imbox_limit'] = 'Stel de limiet op maximum aantal ongelezen IM\'s in';


// Message Log
$lang['Messages_Sent_by'] = 'Berichten Verzonden door ';
$lang['Messages_Received_by'] = 'Berichten Ontvangen door ';
$lang['Offsite_Messages_Sent_by'] = 'Off-Line Berichten Verzonden door ';
$lang['Offsite_Messages_Received_by'] = 'Off-Line Berichten Ontvangen door ';
$lang['Received'] = 'Ontvangen';
$lang['Offsite_Received'] = 'Off-line Ontvangen';
$lang['Offsite_Sent'] = 'Off-line Verzonden';
$lang['No_sent'] = 'Er zijn geen door jou verzonden opgeslagen berichten.';
$lang['No_received'] = 'Er zijn geen door jou ontvangen opgeslagen berichten.';
$lang['Message_Log_admin_explain'] = 'Hier kun je IM\'s bekijken die door jouw gebruikers zijn verzonden en ontvangen.';



/* Entries Added in 0.7.0 */
$lang['Prill_new_posts'] = 'Berichten Sinds Laatste Bezoek';
$lang['No_prill_config'] = 'Kan Prillian configuratie informatie niet doorzoeken';
$lang['No_prill_prefs'] = 'Kan IM voorkeuren tabel niet doorzoeken';
$lang['No_prill_userprefs'] = 'Gebruiker niet gevonden in IM voorkeuren tabel';
$lang['Not_authed_im_delete'] = 'Sorry, je kunt geen boodschappen verwijderen die je verzonden hebt.';
$lang['Back_to_log'] = '%sGa terug naar Berichten Log%s';
$lang['Mini_Client_Window'] = 'Mini Client Mode';
$lang['Use_frames'] = 'Gebruik frames in IM Client';
$lang['Use_frames_explain'] = 'Gebruik van frames verkort de laadtijd wanneer er gezocht wordt naar nieuwe berichten.';
$lang['Use_frames_explain_admin'] = $lang['Use_frames_explain'] . ' Dat kan bandbreedte schelen en in een lagere serverload resulteren.';
$lang['Default_mode'] = 'Te Gebruiken Modus wanneer de IM Client gestart wordt';

// Do not change the [0], [1], etc. parts of the following
$lang['Default_mode_select'][0] = 'Laatst Gebruikte Modus';
$lang['Default_mode_select'][1] = 'Normaal';
$lang['Default_mode_select'][2] = 'Breed';

//Be careful! Do not uncomment the next line!
//$lang['Default_mode_select'][3] = 'Mini Mode';
$lang['Size'] = 'Grootte';
$lang['Color'] = 'Kleur';
$lang['Enabled_explain'] = 'Wanneer \'Nee\' is aangevinkt, kunnen gebruikers geen berichten uitwisselen met deze site.';
$lang['Profile_path_ex_expanded'] = 'Geef het path naar je profile.php file op, relatief aan de forum root directory. Dit wordt gebruikt voor de auto-detectie Network Messaging optie wanneer andere site beheerders je website via auto-detectie proberen te vinden. Geef geen file extensie op, oftewel gebruik "profile" i.p.v. "profile.php"';
$lang['Network_autodetect'] = 'Auto Detecteer een Nieuwe Site';
$lang['Network_autodetect_explain'] = 'Voer de URL van een onderstaand formulier in en Prillian zal proberen verbinding te maken met een Prillian installatie van het forum op die URL. Wanneer de verbinding tot stand is gebracht, zal de Prillian die site automatisch aan je Netwerk lijst proberen toe te voegen.<br /><br />Wanneer je een URL opgeeft, verzeker dan dat hij begint met óf http:// óf ftp:// en eindigt op een slash. Geen file namen opgeven. Dit is juist:<br />http://darkmods.sourceforge.net/mb/<br /><br />Deze zijn onjuist:<br />darkmods.sourceforge.net/mb/<br />http://darkmods.sourceforge.net/<br />darkmods.sourceforge.net/mb<br />http://darkmods.sourceforge.net/mb/imclient.php<br />http://darkmods.sourceforge.net/mb/imclient.php/';
$lang['No_allow_url_fopen'] = 'De allow_url_fopen PHP configuratie instelling is uitgeschakeld. Dit betekent dat PHP scripts op deze server geen verbinding kunnen maken met andere sites. Daarom kun je geen gebruik maken van Network Messaging. Voor informatie over het inschakelen van deze functie kun je contact opnemen met je webhost of server beheerder. Wanneer je die persoon *bent* en meer informatie nodig hebt, kijk dan op <a href="http://www.php.net/manual" target="_blank">PHP manual</a>, vooral in de Configuratie hoofdstukken.<br /><br />Daar je deze boodschap ziet, moet je Network Messaging in de Prillian Configuratie uitschakelen om de snelheid van Prillian te verhogen. Je kunt Network Messaging later weer inschakelen wanneer dat nodig is.';
$lang['ND_cannot_add'] = 'De site op de URL die je opgaf kan niet worden toegevoegd aan je Netwerk.';
$lang['ND_no_connect'] = 'Het script kon geen verbinding maken met de remote site die gebruik maakt van deze URL:';
$lang['ND_no_connect_explain'] = 'Verzeker je ervan dat je de URL juist hebt opgegeven en dat hij begint met óf http:// óf ftp://. Kijk ook of de site online is. Zo niet, probeer het later weer.<br /><br />Als de URL juist is en de site online is, dan is de Network Messaging component van de Prillian niet geïnstalleerd op die URL. ' . $lang['ND_cannot_add'];
$lang['ND_disabled'] = 'Network Messaging is uitgeschakeld op de remote site. ' . $lang['ND_cannot_add'];
$lang['ND_connected'] = 'Het script kon succesvol verbinding maken met de remote site!';
$lang['ND_enabled'] = 'Network Messaging is ingeschakeld op de remote site.';
$lang['ND_version'] = 'Er is een andere versie van Prillian geïnstalleerd op de remote site, er kunnen dus conflicten onstaan tussen jouw versie en het script op de remote site. We zetten de auto-detectie op dit moment voort.';
$lang['ND_060'] = 'Het script heeft gedetecteerd dat Prillian 0.6.0 geïnstalleerd is op de remote site. Prillian 0.6.0 ondersteunt geen auto-detectie en het script kan deze site niet aan je Netwerk toevoegen. Je kunt hem handmatig toevoegen als je dat wilt. Je kunt de beheerder van de remote site er ook toe aanmoedigen te upgraden naar de meest recente versie van Prillian.';
$lang['ND_Unnamed_Site'] = 'Onbekende Gedetecteerde Site';
$lang['ND_data_error'] = 'Er zijn problemen met het auto-detectie data rapport van de remote site. Deze site zal daarom in een uitgeschakelde status aan je Netwerk worden toegevoegd met tenminste één standaardwaarde opgegeven. Je moet deze informatie later via de Messaging Editor bekijken. De fout kan zoiets eenvoudigs zijn als een leeg sitenaam veld.';
$lang['ND_Added_Success'] = 'De site is succesvol toegevoegd aan je Netwerk!';
$lang['Allow_mode_switch'] = 'Sta toe dat gebruikers verschillende IM Client modi kunnen kiezen';

// These three will be used when there are images for the mode switches
//$lang['Alt_Main_Mode'] = 'Schakel IM Client naar Normale Modus';
//$lang['Alt_Wide_Mode'] = 'Schakel IM Client naar Brede Modus';
//$lang['Alt_Mini_Mode'] = 'Schakel IM Client naar Mini Modus';
$lang['Alt_Main_Mode'] = 'Normaal &nbsp; &nbsp; ';
$lang['Alt_Wide_Mode'] = ' Breed';
$lang['Alt_Mini_Mode'] = 'Mini Modus';
$lang[''] = '';
$lang[''] = '';
$lang[''] = '';
$lang[''] = '';

// Adapted from Enhanced Admin User Lookup
$lang['User_lookup_explain'] = 'Je kunt gebruikers opzoeken door één of meer van onderstaande criteria op te geven. Er zijn geen wildcards nodig, deze worden automatisch toegevoegd.';
$lang['One_user_found'] = 'Gebruiker gevonden, je wordt naar die gebruiker doorverwezen';
$lang['Click_goto_prefs'] = 'Klik %sHier%s om de voorkeuren van deze gebruiker te bewerken';
$lang['Click_goto_log'] = 'Klik %sHier%s om de berichten van deze gebruiker te bekijken';
$lang['User_joined_explain'] = 'De syntax is identiek aan de PHP <a href="http://www.php.net/strtotime" target="_other">strtotime()</a> functie';
$lang['Click_return_perms_admin'] = 'Klik %sHier%s om terug te keren naar Gebruikers Permissie Beheer';


/* Entries Changed in 0.7.0 */

// Controls panels
$lang['Alt_Contact_Man'] = 'Beheer Contacten'; // Was $lang['Alt_Buddy_Man']

// Preferences editor
$lang['Wide_Client_Window'] = 'Brede Client Modus'; // Was $lang['Whos_Online_Window']
$lang['Main_Window'] = 'Normale Client Modus';

/* Any of these that have network in the $lang['name'] part used to have s2s in
 place of network. In some, that is the only change */
// Network Messaging
$lang['Network_disabled'] = 'Sorry, maar Network Messaging is uitgeschakeld op dit bord.';
$lang['Network_no_username'] = 'Network Messaging heeft je gebruikersnaam of user id niet ontvangen.';
$lang['Network_no_siteurl'] = 'Network Messaging heeft de site url of de site waar vandaan je je bericht verstuurt niet ontvangen.';
$lang['Network_no_siteid'] = 'Network Messaging heeft de site id of de site waarnaar je je bericht verstuurt niet ontvangen.';
$lang['Network_Users_online'] = 'Van Andere Sites';
$lang['No_network_type'] = 'Kon type niet bepalen.';
$lang['Invalid_network_type'] = 'Kon geen geldig type bepalen.';
$lang['Network_not_in_db'] = 'Sorry, maar de site waar vandaan je je bericht verstuurt, staat niet in de lijst van goedgekeurde sites op de site waarnaar je het bericht wilt versturen.';
$lang['Send_a_new_network'] = 'Verzend een nieuwe Network Message';
$lang['Reply_to_a_network'] = 'Antwoord op een Network Message';
$lang['Network_Flood_Error'] = 'Network Messaging kan niet zo snel na het vorige bericht een nieuwe ontvangen. Probeer het over een korte tijd weer.';

// Admin Network Messaging
$lang['Network_title'] = 'Network Messaging Editor';
$lang['Network_explain'] = 'Op deze pagina kun je de sites waarmee je gebruikers via de Prillian Network Messaging Optie berichten kunnen uitwisselen, toevoegen, bewerken en verwijderen .';
$lang['Network_add'] = 'Voeg een Nieuwe Site toe';
$lang['Network_del_success'] = 'De site werd succesvol verwijderd. Je gebruikers kunnen via de Prillian niet langer berichten uitwisselen met die site.';
$lang['Click_return_network'] = 'Klik %shier%s om terug te keren naar Network Messaging.';
$lang['Network_config'] = 'Site Configuratie';
$lang['Network_add_success'] = 'De site informatie is succesvol bijgewerkt.';

// Admin preferences editor
$lang['Admin_allow_network'] = 'Sta gebruikers toe gebruik te maken van Network Messaging';

// Preferences editor
$lang['User_allow_network']	= 'Schakel Network Messaging in voor dit account';
$lang['Network_user_list'] = 'Kies een methode om gebruikers online te tonen op andere sites';

// Do not change the [0], [1], etc. parts of the following
$lang['network_lists'][0] = 'Niet tonen';
$lang['network_lists'][1] = 'Toon samen met gebruikers op deze site';
$lang['network_lists'][2] = 'Toon apart van gebruikers op deze site';

// Admin Configuration
$lang['IM_allow_network'] = 'Schakel het Network Messaging Systeem In';
/* End of the s2s -> network changes */



/*
The following entries were removed in 0.7.0

$lang['PUU_Constant']
$lang['PPU_Constant']
$lang['PUU_Constant_explain']
$lang['PPU_Constant_explain']
*/
?>