<?php
/****************************************************************
 *			lang_extend_qbar.php [Nederlands]
 *			--------------------
 *	begin				: 28/09/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 1.0.0 - 28/09/2003
 *
 *   Nederlandse vertaling  : Maart 2005 
 *   The Dutch Team         : http://www.integramod.nl
 *
 ***************************************************************/

/****************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************/

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

// admin part
if ( $lang_extend_admin )
{
	$lang['Lang_extend_qbar']					= 'QBar/Qmenu';

	// title
	$lang['Qbar_admin']							= 'Qbar';
	$lang['Qbar_admin_explain']			= 'Hier kun je de navigatiebalken op de forums en het menu links instellen.';
	$lang['Qbar_admin_panel']					= 'Qbar paneel';
	$lang['Qbar_admin_panel_explain']	= 'Hier kun je een Qbar maken en bewerken, alsook de wijze instellen waarop deze bovenaan het bord zichtbaar zal zijn.';
	$lang['Qbar_admin_field']			= 'Qbar veld';
	$lang['Qbar_admin_field_explain']	= 'Hier kun je een Qbar veld maken en bewerken.';
	$lang['Qbar_admin_import']			= 'Importeer velden';
	$lang['Qbar_admin_import_explain']	= 'Gebruik deze optie om velden in een bestaande Qbar te importeren.';
	$lang['Qbar_settings']				= 'Instellingen';

	// qbar def
	$lang['Qbar_name']							= 'Qbar naam';
	$lang['Qbar_name_explain']					= 'De Qbar naam wordt nooit aan de gebruiker getoond: Het is enkel een interne identificatie.';
	$lang['Qbar_class']							= 'Soort';
	$lang['Qbar_class_explain']					= 'Gebruik "Bar" voor een balk boven het bord en "Menu" voor een menu.';
	$lang['Qbar_display']						= 'Toon';
	$lang['Qbar_display_explain']				= 'Vink "Ja" aan om de Qbar te tonen.';
	$lang['Qbar_cells']							= 'Links per regel';
	$lang['Qbar_cells_explain']					= 'Aantal links per regel: Wanneer het aantal groter is dan dit, zal er een nieuwe regel aangemaakt worden.';
	$lang['Qbar_in_table']						= 'Gebruik een tabel';
	$lang['Qbar_in_table_explain']				= 'Vink "Ja" aan om rechthoeken rond de links te plaatsen.';
	$lang['Qbar_style']							= 'Gelinkt aan een specifieke stijl';
	$lang['Qbar_style_explain']					= 'Wanneer je een bepaalde stijl selecteert, zal de Qbar enkel zichtbaar zijn wanneer het bord is ingesteld op deze stijl.';
	$lang['Qbar_sub_template']					= 'Gelinkt aan een specifieke sub-template';
	$lang['Qbar_sub_template_explain']			= 'Wanneer je een sub-template selecteert, zal de Qbar enkel zichtbaar zijn wanneer het bord is ingesteld op deze sub-template. Gebruik "Geen" om hem enkel te tonen wanneer er geen sub-template wordt gebruikt, "Alle" om de Qbar te tonen bij elke gebruikte sub-template voor deze stijl.';

	// field def
	$lang['Qbar_field_name']					= 'Veldnaam';
	$lang['Qbar_field_name_explain']			= 'De Veldnaam wordt nooit aan de gebruiker getoond: Het is enkel een interne identificatie.';
	$lang['Qbar_shortcut']						= 'Afkorting';
	$lang['Qbar_shortcut_explain']				= 'De afkorting is datgene wat wordt getoond in het menu of de balk. Je kunt tekst gebruiken of een sleutel uit de taalreeks. <br />(check language/lang_<i>jouw_taal</i>/lang_main.php).';

	$lang['Qbar_explain']						= 'Muis over';
	$lang['Qbar_explain_explain']				= 'De muis over wordt getoond wanneer de gebruiker zijn muis op de link of het icoon plaatst (titel of alt HTML statement). Je kunt tekst gebruiken of een sleutel uit de taalreeks. <br />(check language/lang_<i>jouw_taal</i>/lang_main.php).';
	$lang['Qbar_alternate']						= 'Alternatieve afkorting';
	$lang['Qbar_alternate_explain']				= 'De alternatieve afkorting wordt gebruikt in combinatie met de pb auth set, wanneer het om meer dan 1 PB gaat. Je kunt tekst gebruiken of een sleutel uit de taalreeks. <br />(check language/lang_<i>jouw_taal</i>/lang_main.php).';
	$lang['Qbar_icon']							= 'Icoon';
	$lang['Qbar_icon_explain']					= 'Icoon url of sleutel uit de plaatjesreeks. <br />(check templates/<i>jouw_template</i>/<i>jouw_template</i>.cfg)';
	$lang['Qbar_use_value']						= 'Toon afkorting';
	$lang['Qbar_use_value_explain']				= 'Vink "Ja" aan wanneer je de tekst wilt gebruiken als de getoonde link.';
	$lang['Qbar_use_icon']						= 'Toon icoon';
	$lang['Qbar_use_icon_explain']				= 'Vink "Ja" aan wanneer je het icoon wilt gebruiken als de getoonde link.';
	$lang['Qbar_url']							= 'Programma URL';
	$lang['Qbar_url_explain']					= 'Gebruik enkel URI wanneer het programma in de phpBB directory staat, anders de volledige URL.';
	$lang['Qbar_internal']						= 'phpBB programma';
	$lang['Qbar_internal_explain']				= 'Bij "Ja" zal de link beschouwd worden als een phpBB programma en zal zodoende beschermd zijn tegen enkele basis hack pogingen en zal de sessie id aan de url link toevoegen.';
	$lang['Qbar_window']						= 'New Window';
	$lang['Qbar_window_explain']				= 'Choosing "Yes", the link will be opened in a new window.';
	$lang['Qbar_auth_logged']					= 'Ingelogd';
	$lang['Qbar_auth_logged_explain']			= 'Hiermee zal de link enkel getoond worden wanneer hij overeenkomt met de login status: "Negeren" zal hem altijd tonen.';
	$lang['Qbar_auth_admin']					= 'Beheer niveau';
	$lang['Qbar_auth_admin_explain']			= 'Hiermee zal de link enkel getoond worden wanneer hij overeenkomt met het juiste gebruikersniveau: "Negeren" zal hem altijd tonen.';
	$lang['Qbar_auth_pm']						= 'Wachtende PB';
	$lang['Qbar_auth_pm_explain']				= 'Hiermee zal de link enkel getoond worden wanneer de status van wachtende PB\'s overeenkomt met de instelling: "Negeren" zal hem altijd tonen.';
	$lang['Qbar_tree_id']						= 'Forum boom';
	$lang['Qbar_tree_id_explain']				= 'Hiermee zal de link getoond worden wanneer hij overeenkomt met de gebruikers authorisatie voor een forum.';

	$lang['Qbar_auths']							= 'Authorisaties';
	$lang['Qbar_private_messages']				= 'Privé berichten beheer';

	// specific actions
	$lang['Qbar_delete_panel']					= 'Verwijder een Qbar';
	$lang['Qbar_delete_panel_confirm']			= 'Weet je zeker dat je de Qbar <b>%s</b> wilt verwijderen?';

	$lang['Qbar_delete_field']					= 'Verwijder een link';
	$lang['Qbar_delete_field_confirm']			= 'Weet je zeker dat je de link <b>%s</b> wilt verwijderen van Qbar %s ?';

	// error messages
	$lang['Qbar_error_panel_system']				= 'Je kunt een systeem Qbar niet bewerken of verwijderen.';
	$lang['Qbar_error_panel_exists']			= 'De Qbar naam bestaat al.';
	$lang['Qbar_error_panel_not_found']			= 'De Qbar naam bestaat niet.';
	$lang['Qbar_error_panel_empty_name']		= 'Je moet een Qbar naam opgeven.';
	$lang['Qbar_error_panel_empty_cells']		= 'Je moet het aantal links per regel opgeven als je wilt dat de Qbar getoond wordt.';

	$lang['Qbar_error_field_exists']			= 'De veldnaam bestaat al.';
	$lang['Qbar_error_field_not_found']			= 'De veldnaam bestaat niet.';
	$lang['Qbar_error_field_empty_name']		= 'Je moet een veldnaam opgeven.';
	$lang['Qbar_error_field_system']			= 'Je kunt een veld in een systeem Qbar niet bewerken of verwijderen.';
	$lang['Qbar_error_field_empty_shortcut']	= 'Je moet een afkorting opgeven als je wilt dat deze getoond wordt.';
	$lang['Qbar_error_field_empty_icon']		= 'Je moet een icoon opgeven als je wilt dat deze getoond wordt.';
	$lang['Qbar_error_field_display_nothing']	= 'Je moet kiezen of je de link of het icoon wilt gebruiken, of beide.';
	$lang['Qbar_error_field_empty_url']			= 'Je moet de URL of de URI van de link opgeven.';
	$lang['Qbar_error_field_external_url']		= 'Geef geen domein (http://) op wanneer je een phpBB programma selecteert.';

	// auths
	$lang['Qbar_auth_ignore']			= 'Negeren';
	$lang['Qbar_auth_required']			= 'Vereist';
	$lang['Qbar_auth_prohibited']		= 'Niet toegestaan';
	$lang['Qbar_auth_pm_new']			= 'Nieuwe PB\'s';
	$lang['Qbar_auth_pm_no_new']		= 'Geen nieuwe PB\'s';
	$lang['Qbar_auth_pm_unread']		= 'Ongelezen PB\'s';

	// classes
	$lang['Qbar_class_system']			= 'System';
	$lang['Qbar_class_bar']				= 'Bar';
	$lang['Qbar_class_menu']			= 'Menu';
	$lang['Qbar_class_nav']				= 'Nav';
	$lang['Qbar_class_nav2']			= 'Nav2';
	$lang['Qbar_class_list']			= 'List';

	// generic actions
	$lang['Create_field']				= 'Voeg een nieuw veld toe';
	$lang['Create_panel']				= 'Voeg een nieuw paneel toe';

	// misc.
	$lang['Qbar_none']					= '---------- Geen ----------';
	$lang['Import']						= 'Importeer';
	$lang['Refresh']					= 'Vernieuw';
	$lang['Qbar_all']					= '---------- Alle ----------';
}

$lang['FAQ_explain']				= 'Vaak gestelde vragen';
$lang['Memberlist_explain']			= 'Lijst van geregistreerde gebruikers';
$lang['Usergroups_explain']			= 'Gebruikers Groepen van geregisteerde gebruikers';
$lang['Profile_explain']			= 'Profiel aanpassen';
$lang['Private_Messaging_explain']	= 'Bekijk je prive berichten';
$lang['Login_explain']				= 'Login om je nickname en profiel instellingen te gebruiken';
$lang['Register_explain']			= 'Aanmelden/Registreren';
$lang['Logout_explain']				= 'Uitloggen';
$lang['Admin_explain']				= 'Beheer paneel';
$lang['Admin']						= 'Beheer';
$lang['Forum']						= 'Forums';
$lang['Forum_index_explain']		= 'Forum Index';
$lang['Home']						= 'Home';
$lang['Home_explain']				= 'Ga naar de Portaal pagina';
$lang['Album']						= 'Foto Albums';
$lang['Album_explain']				= 'Bekijk geuploade fotos';
$lang['Calendar']					= 'Kalender';
$lang['Calendar_explain']			= 'Bekijk gebeurtenissen die in dit forum geplaatst zijn';
$lang['Statistics']					= 'Statistieken';
$lang['Statistics_explain']			= 'Bekijk website statistieken';
$lang['Knowledgebase']				= 'Kennis Bank';
$lang['Knowledgebase_explain']		= 'Bekijk artikelen in de Kennis Bank';
$lang['Acronyms']					= 'Acroniemen';
$lang['Acronyms_explain']			= 'Bekijk de Acroniemen van deze site';
$lang['Digests']					= 'Samenvattingen';
$lang['Digests_explain']			= 'Meld je aan voor Samenvattingen van deze site, ze worden je via e-mail gestuurd';
$lang['Points_CP']					= 'Punten CP';
$lang['Points_CP_explain']			= 'Geef punten aan gebruikers van dit forum';
$lang['Rules']						= 'Regels';
$lang['Rules_explain']				= 'Lees de regels van dit forum';
$lang['Tour']						= 'Forum Tour';
$lang['Tour_explain']				= 'Online help bij dit forum';
$lang['Rate_menu']					= 'Laatste Ratings';
$lang['Rate_explain']				= 'Onderwerpen die als hoogste gewaardeerd zijn door forum gebruikers';
$lang['Ranks']						= 'Rangen';
$lang['Ranks_explain']				= 'Lijst van beschikbare Rangen en hun leden';
$lang['Links']						= 'Links';
$lang['Links_explain']				= 'Links Categorieën';
$lang['Donate']						= 'Donate';
$lang['Donate_explain']				= 'Donate to '.$board_config['sitename'];
$lang['Donors']						= 'Donors';
$lang['Donors_explain']				= 'Users who have donated';
$lang['Personal_album']		= 'My Album';
$lang['Personal_album_explain']				= 'Your own personal album';
$lang['Personal_albums']		= 'Personal Albums';
$lang['Personal_albums_explain']				= 'All personal albums';
$lang['FAQ']				= 'FAQ';
$lang['Search_forums']				= 'Search Forums';
$lang['Search_forums_explain']				= 'Search through forums.';
$lang['Search_kb']				= 'Search KB';
$lang['Search_kb_explain']				= 'Search through Knowledge Base.';
$lang['Paypal_history']		= 'My PayPal History';
$lang['Paypal_history_explain']				= 'View your PayPal account history';
$lang['My_cookies']		= 'My Cookies';
$lang['My_cookies_explain']				= 'Manage your own cookies';
$lang['News_RSS']		= 'RSS Feed';
$lang['News_RSS_explain']				= 'News in RSS format';
$lang['Shoutbox']		= 'Shoutbox';
$lang['Shoutbox_explain']				= 'Full Page Shoutbox';
$lang['Sync_user_posts']		= 'Sync User Posts';
$lang['Sync_user_posts_explain']				= 'Rebuild user post count';
$lang['Tell_friend']		= 'Tell A Friend';
$lang['Tell_friend_explain']				= 'Tell your friends about thsi great site.';
$lang['Online_users']		= 'Online Users';
$lang['Online_users_explain']				= 'See who is online at this time.';
$lang['Bookmarks']					= 'Mijn Bladwijzers';
$lang['Bookmarks_explain']			= 'Bekijk je Bladwijzers naar Onderwerpen';
$lang['Exploit_attempts']					= 'Exploit Attempts';
$lang['Exploit_attempts_explain']			= 'See the list of blocked exploit attempts';
$lang['Search_dl']					= 'Search Downloads';
$lang['Search_dl_explain']			= 'Search trough downloads';
$lang['Staff']						= 'Team';
$lang['Staff_explain']				= 'Lijst Team, medewerkers van deze site';
?>