<?php
/***************************************************************************
 *                          lang_prillian.php [German]
 *                            -------------------
 *   begin                : Friday, Jan 31, 2003
 *   version              : 0.7.0
 *   date                 : 2003/12/23 23:21
 *   modified             : Mahdi, 2005/06/03 01:19
 ***************************************************************************/

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
$lang['TRANSLATION_INFO'] = '';

// Do not change the next six lines.
// Avoid including the file more than once.
if ( defined('IN_PRILLIAN_LANG') )
{
	return;
}
define('IN_PRILLIAN_LANG', true);

// You may want to edit the following lines to match your website.
$lang['Launch_Prillian'] = 'Zugang Prillian';  // Link for opening the IM Client
$lang['Prillian_FAQ'] = 'Instant Messenger';   // Title of the IM FAQ
$lang['Prillian'] = 'Prillian';  // Name of Prillian, used throughout the scripts

$lang['New_ims'] = 'Du hast %d neue IMs'; // You have 2 new IMs
$lang['New_im'] = 'Du hast %d neue IM'; // You have 1 new IM
$lang['Unread_ims'] = 'Du hast %d ungelesene IMs'; // You have 2 new IMs
$lang['Unread_im'] = 'Du hast %d ungelesene IM'; // You have 1 new IM

// Main IM Client/Who's Online window
$lang['Users_Online'] = 'Benutzer Online';
$lang['Buddies_Online'] = 'Freunde Online';
$lang['Hidden_Users_Online'] = 'versteckte Benutzer Online';
$lang['Guests_Online'] = 'Gäste Online';
$lang['Close_windows'] = 'Fenster schliessen';
$lang['Send_im'] = 'sende eine Sofortnachricht (IM)';
$lang['IM'] = 'IM';
$lang['PM'] = 'PM';
$lang['New_messages'] = 'neue und ungelesene Nachricht';


// Controls panels
$lang['Controls'] = 'Optionen';
$lang['Check_IMs'] = 'nach IMs schauen';
$lang['Message_Log'] = 'Message Log';
$lang['Alt_Message_Log'] = 'öffne Message Log';
$lang['Alt_New_Messages'] = 'schaue nach neuen Nachrichten';
$lang['Alt_Home'] = 'zurück zum Forum';
$lang['Alt_Close_Windows'] = 'alle geöffneten Fenster schließen';
$lang['Alt_Prefs'] = 'änder ' . $lang['Prillian'] . ' Einstellungen';
$lang['Alt_Logout'] = 'abmelden vom Forum und ' . $lang['Prillian'];
$lang['Prillian_Help'] = 'Hilfe';


// Sending/replying
$lang['phpBB_IM_default_subject'] = $lang['Message'];
$lang['Send_new_im'] = 'sende eine neue Sofortnachricht';
$lang['Select_emoticon'] = 'wähle Smilie';
$lang['Save_reply_pm'] = 'speichern und antworten';
$lang['Save_close_pm'] = 'speichern und schließen';
$lang['Delete_reply_pm'] = 'lösche und antworten';
$lang['Delete_close_pm'] = 'lösche und schließe';
$lang['IM_Quick_reply'] = 'Schnellantwort';


// Error messages
$lang['Close_window_link'] = '<br /><br /><a href="javascript:window.close();">' . $lang['Close_window'] . '</a>';
$lang['IM_disabled'] = 'Sorry, aber die Sofortnachrichtenübermittlung ist auf diesem Board gesperrt worden.';
$lang['Ims_not_allowed'] = 'Sorry, aber sofortige Nachrichtenübermittlung ist auf diesem Benutzer- Zugang .';
$lang['Ims_not_allowed_fail'] = 'Konnte nicht überprüfen ob die Sofortnachrichtenübermittlung geperrt ist auf diesem Benutzer- Zugang.';
$lang['Cannot_send_im'] = 'Sorry, aber sofortige Nachrichtenübermittlung ist auf Ihrem Konto gesperrt worden. Wenn Sie sofortige Nachrichtenübermittlung sperrten, Sie können es in Ihren %spreferences%s wieder ermöglichen.';
$lang['Cannot_send_im_admin'] = 'Sorry, aber Sofornachrichten sind auf Ihrem Konto vom Board- Administrator gesperrt worden.';
$lang['Please_set_im_prefs'] = 'Sie haben noch nicht Ihren Instant Messenger eingestellt. Nehmen Sie bitte die Zeit um es %shere%s einzustellen.';
$lang['Admin_override'] = 'Sorry, aber der Board- Administrator hat das Board so eingestellt das Benutzereinstellungen mit der globalen Boardeinstellung überschreiben wurden. Sie können nicht Ihre Präferenzen ändern, während dieser Vorgang noch in Kraft ist.';
$lang['Too_many_ims'] = 'Sorry, aber dieser Benutzer hat zu viele Instant Messages die auf ihm warten. Versuche es noch einmal später.';
$lang['No_autoclose'] = 'Wenn Sie diese Message sehen, dann schließt nicht automatisch das Fenster von ' . $lang['Prillian'] . ' in Ihrem Browser. Mögliche Ursachen: Deaktivierung von JavaScript im Browser. Bitte schließen Sie dieses Fenster.';
$lang['User_no_im'] = 'Sie können keine Instant Message senden zu diesem Benutzer. ';
$lang['No_im_reply_info'] = 'Konnte keinen Nachrichteninhalt erhalten. Das bedeutet vermutlich, daß die Message bereits automatisch gelöscht worden ist.';
$lang['No_Admins_Found'] = 'Kein Board- Administrators wurde in der Datenbank gefunden.';
$lang['No_post_type'] = 'Konnte Mitteilungsart nicht feststellen.';
$lang['Admin_no_user_from'] = 'Konnte Absender nicht feststellen.';
$lang['Admin_no_user_to'] = 'Konnte Empfänger nicht feststellen.';


// Site to Site
$lang['IM_no_users_online'] = 'Hier sind keien Benutzer Online.';
$lang['Online_at'] = 'Benutzer ist Online seid ';
$lang['User_from'] = 'Benutzer von ';


// Admin Site to Site
$lang['URL'] = 'URL';
$lang['Extension'] = 'Dateiendung';
$lang['Profile_path'] = 'Pfad zum Profil';
$lang['Extension_explain'] = 'Das ist "php" im Standart';
$lang['Profile_path_explain'] = 'Das ist "Profil" im Standart';


// Preferences editor
$lang['Prillian_Profile_updated'] = 'Ihre Einstellungen wurden aktualisiert.<br /><br />Fals nötig, klicke %shier%s zum neuladen des IM- Klienten.';

$lang['User_allow_ims'] = 'Aktiviere Instant Messaging System für diesen Zugang';
$lang['User_allow_shout'] = 'Erlaube den Gebrauch von shoutbox';
$lang['User_allow_chat'] = 'Erlaube den Gebrauch von chatbox';
$lang['Always_add_sig_explain'] = 'Signaturen können im Profil geändert werden';
$lang['Refresh_rate'] = 'Hauptfenster Refresh Rate';
$lang['Refresh_rate_explain1'] = 'Anzahl der Sekunden des refreshes im IM- Client.';
$lang['Refresh_rate_explain2'] = 'Zeit zwischen erneuert im IM- Client.';
$lang['Success_close'] = 'automatisches schließen des Message- Fensters nach senden der Message';
$lang['Refresh_method'] = 'wähle die refresh Methode des IM- Clients';
$lang['Refresh_method_explain'] = 'Both verwenden wird empfohlen';
$lang['JavaScript'] = 'JavaScript';
$lang['META_tag'] = 'META tag'; 
$lang['Use_both_methods'] = 'verwende Both';
$lang['IM_auto_launch_pref'] = 'öffne Client wenn Sie den Forumindex besuchen'; 
$lang['IM_auto_popup'] = 'automatisches öffenen von neuen Messages';
$lang['IM_list_new'] = 'Liste neue und ungelesene Messages im Hauptfenster';
$lang['Show_controls'] = 'zeige Verwaltungs- Ebene';

// Do not change the [0], [1], etc. parts of the following
$lang['Controls_select'][0] = 'nicht anzeigen';
$lang['Controls_select'][1] = 'Als Bild immer';
$lang['Controls_select'][2] = 'Als Link immer';
$lang['Controls_select'][3] = 'Als Both';
$lang['Who_to_list'] = 'Listet die Benutzer im Hauptfenster';
$lang['Online_Lists'][1] = 'Alle Online- Benutzer';
$lang['Online_Lists'][2] = 'Freunde im Forum';
$lang['Online_Lists'][3] = 'Freunde im IM';
$lang['Online_Lists'][4] = 'Alle Benutzer im IM';

// Include any options you want in the refresh rate drop down list here
// They should be in this format:
// $lang['Refresh_times']['number of seconds'] = 'name in list';
// The number of seconds can be no longer than 5 digits, unless you alter
// the im_prefs database table.
$lang['Refresh_times'][60] = '1 Minute';
$lang['Refresh_times'][120] = '2 Minuten';
$lang['Refresh_times'][180] = '3 Minuten';
$lang['Refresh_times'][240] = '4 Minuten';
$lang['Refresh_times'][300] = '5 Minuten';

$lang['IM_play_sound'] = 'spiele Klang bei neuen Messages';
$lang['Default_sound'] = 'benutze Standartklang vom Board';
$lang['Current_sound'] = 'gegenwärtige Klangdatei';
$lang['IM_style'] = 'Style used by ' . $lang['Prillian'];
$lang['Width'] = 'Breite';
$lang['Height'] = 'Höhe';
$lang['Read_Message'] = 'lese Message';
$lang['Send_Message'] = 'sende Message';
$lang['Set_window_sizes'] = 'Setze Fenstergrösse';
$lang['Set_window_sizes_explain'] = 'Alle Grössen in Pixel';
$lang['Open_pms'] = 'öffne und/oder liste private Nachrichten';
$lang['Auto_delete_ims'] = 'Ermögliche automatische Auslassung der gelesenen IM`s im refresh des IM- Clients';

// Admin preferences editor
$lang['Admin_allow_ims'] = 'erlaube den Benutzern das senden und empfangen vom Instant- Messages';
$lang['Admin_allow_shout'] = 'erlaube den Benutzern die Shoutbox';
$lang['Admin_allow_chat'] = 'erlaube den Benutzern die Chatbox';
$lang['IM_user_auto_launch'] = 'öffne den Client automatisch wenn Benutzer den Forumindex besuchen und sich einloggen';
$lang['Admin_user_added'] = 'Der Benutzer ist in der Datenbank eingetragen wurden.';
$lang['Admin_Set_window_sizes'] = 'setze Standart- Fenstergrösse';


// Admin Configuration
$lang['IM_auto_launch'] = 'öffne den Client automatisch wenn Benutzer den Forumindex besuchen und sich einloggen'; 
$lang['IM_box_limit'] = 'Max. ungelesene Instant- Messages';
$lang['IM_enable_flood'] = 'aktiviere Floodkontrolle';
$lang['IM_override_settings'] = 'überschreibe individuelle Benutzereinstellung';
$lang['IM_override_settings_explain'] = 'Dies deaktiviert die Benutzereinstellungen und verwendet die Boardstandartwerte in dieser Option hier';
$lang['IM_enable_ims'] = 'aktiviert Instant- Messaging System';
$lang['IM_enable_shoutbox'] = 'aktiviert Shoutbox';
$lang['IM_enable_chatbox'] = 'aktiviert Chatbox';
$lang['IM_refresh_drop'] = 'nutze "Drop-down-Liste" für Benutzer Refreshrate- Einstellung';
$lang['IM_sound_name'] = 'Ort der Klangdatei';
$lang['IM_allow_sound'] = 'erlaube den Benutzern das abspielen des Klangs bei neuen Messages';
$lang['IM_default_sound'] = 'erlaube den Benutzern ihren eigenen Klang ab zuspielen';
$lang['IM_allow_different_style'] = 'erlaube ' . $lang['Prillian'] . ' eine andere Art als der Rest des Forums verwenden';
$lang['Prillian_Config'] = $lang['Prillian'] . ' generelle Konfiguration';
$lang['Prillian_Config_explain'] = 'Die Form unten erlaubt Ihnen alle allgemeinen Messenger- Optionen besonders anzufertigen. Diese werden verwendet um Rückstellung, Verhalten und Benutzerwahlen zu definieren. Verwenden Sie die in Verbindung stehenden Links im anderen Frame.';
$lang['IM_session_length'] = 'IM- Client Session- Länge in Sekunden';
$lang['IM_session_length_explain'] = 'Dieses wird verwendet um festzustellen ob ein Benutzer auf dem Messenger aktiv ist. Es wird empfohlen dies grösser einzustellen als die Refreshrate.';
$lang['IM_enable_imbox_limit'] = 'aktivieren Sie die Begrenzung auf die maximal ungelesenen IM`s';


// Message Log
$lang['Messages_Sent_by'] = 'Messages gesendet von ';
$lang['Messages_Received_by'] = 'Messages empfangen von ';
$lang['Offsite_Messages_Sent_by'] = 'Off-Site Messages gesendet von ';
$lang['Offsite_Messages_Received_by'] = 'Off-Site Messages empfangen von ';
$lang['Received'] = 'Empfangen';
$lang['Offsite_Received'] = 'Off-Site empfangen';
$lang['Offsite_Sent'] = 'Off-Site gesendet';
$lang['No_sent'] = 'Es gibt keine gespeicherten Messanges die von Ihnen gesendet wurden.';
$lang['No_received'] = 'Es gibt keine gespeicherten Messages die von Ihnen empfangen wurden.';
$lang['Message_Log_admin_explain'] = 'Hier können Sie die sofortigen Messages wiederholen die von Ihren Benutzern gesendet werden und empfangen sind.';



/* Entries Added in 0.7.0 */
$lang['Prill_new_posts'] = 'Posts seid dem letzten Besuch';
$lang['No_prill_config'] = 'Konnte keine die Prillian- Einstellung abfragen';
$lang['No_prill_prefs'] = 'konnte keine IM- Einstellungen aus der Datenbank abfragen';
$lang['No_prill_userprefs'] = 'keine Benutzer gefunden in der IM- Einstellungs- DatenBank';
$lang['Not_authed_im_delete'] = 'Sorry, Sie können keine Messages löschen die die gesendet wurden.';
$lang['Back_to_log'] = '%szurück zur Message- Log%s';
$lang['Mini_Client_Window'] = 'Mini Client- Modus';
$lang['Use_frames'] = 'benutzen Sie frames im IM- Klient';
$lang['Use_frames_explain'] = 'Mit Rahmen beschleunigt laden bei der Überprüfung auf neue Messages.';
$lang['Use_frames_explain_admin'] = $lang['Use_frames_explain'] . 'Dieses kann Bandbreite und Resultate bei weniger Serverlast speichern.';
$lang['Default_mode'] = 'Modus verwenden wenn IM- Klient geladen ist';

// Do not change the [0], [1], etc. parts of the following
$lang['Default_mode_select'][0] = 'letzter Modus benutzt';
$lang['Default_mode_select'][1] = 'Haupt- Modus';
$lang['Default_mode_select'][2] = 'Breit- Modus';

//Be careful! Do not uncomment the next line!
//$lang['Default_mode_select'][3] = 'Mini Mode';
$lang['Size'] = 'Grösse';
$lang['Color'] = 'Farbe';
$lang['Enabled_explain'] = 'setzt du nein wird Ihren Benutzern nicht erlaubt auf die Seite ein zu wirken.';
$lang['Profile_path_ex_expanded'] = 'Betreten Sie den Pfad zu Ihrer profil.php- Datei, dieses wird für Netz-Nachrichtenübermittlungen Automatik-Abfrage- Eigenschaft verwendet, wenn andere Site- Admins versuchen Ihre Seite automatisch zu ermitteln. Schließen Sie nicht die Dateiextension ein, e.g., verwenden Sie "Profil" anstelle "vom profile.php"';
$lang['Network_autodetect'] = 'automatisches ermitteln einer neuen Seite';
$lang['Network_autodetect_explain'] = 'Tragen Sie die URL eines Forums unten ein wenn die Verbindung hergestellt ist, Prillian versucht die Seite in Ihrer Netzliste automatisch hinzuzufügen.<br /><br />Wenn die URL eingetragen ist, stellen Sie sicher diese mit http:// oder ftp:// beginnt. Keine Datien sollen enthalten sein. So ist es richtig:<br />http://darkmods.sourceforge.net/mb/<br /><br />So ist es falsch:<br />darkmods.sourceforge.net/mb/<br />http://darkmods.sourceforge.net/<br />darkmods.sourceforge.net/mb<br />http://darkmods.sourceforge.net/mb/imclient.php<br />http://darkmods.sourceforge.net/mb/imclient.php/';
$lang['No_allow_url_fopen'] = 'Allow_url_fopen PHP Konfigurationseinstellung wird abgestellt. Dies heißt, daß PHP- Scripte auf diesem Server nicht an Remoteaufstellungsorte anschließen können. Infolgedessen Sie können nicht Netz-Nachrichten übermittelt verwenden. Zur Information über das Ermöglichen dieser Wahl, sprechen Sie bitte mit Ihrem Webhoster oder Server- Administrator. Wenn benötigen *Sie* diese Person und weitere  Informationen <a href="http://www.php.net/manual" target="_blank">PHP manual</a>, besonders in den Konfigurations- Kapiteln.<br /><br />Während Sie diese Anzeige sehen sollten Sie Netz-Nachrichtenübermittlung in der Prillian Konfiguration sperren um die Geschwindigkeit von Prillian zu erhöhen. Sie können Netz-Nachrichtenübermittlung später ermöglichen wenn es gewünscht wird.';
$lang['ND_cannot_add'] = 'Die Seite der URL Sie eintragen haben kann nicht Ihrem Netz hinzugefügt werden.';
$lang['ND_no_connect'] = 'Das Script konnte nicht an den Remoteaufstellungsort mit dieser URL verbinden:';
$lang['ND_no_connect_explain'] = 'Stellen Sie bitte sicher, daß Sie das URL richtig schrieben ist und mit:  http:// or ftp://. Prüfen Sie auch, ob die Seite Online ist. Wenn nicht, versuche es noch einmal später.<br /><br />Wenn die URL korrekt ist und die Seite Online ist, kann es möglich sein das Prillian nicht auf dieser URL installiert ist. ' . $lang['ND_cannot_add'];
$lang['ND_disabled'] = 'Netz-Nachrichtenübermittlung ist am Remoteaufstellungsort deaktiviert ' .  $lang['ND_cannot_add'];
$lang['ND_connected'] = 'Das Script wurde am Remoteaufstellungsort erfolgreich eingerichtet!';
$lang['ND_enabled'] = 'Netz-Nachrichtenübermittlung wird am Remoteaufstellungsort ermöglicht.';
$lang['ND_version'] = 'Eine andere Version von Prillian wird am Remoteaufstellungsort gefunden, so es kann einige Konflikte zwischen Ihrer Version und dem Script auf dem Remoteaufstellungsort geben. Wir fahren mit Auto- Abfragung ruhig fort.';
$lang['ND_060'] = 'Das Script hat Prillian 0.6.0 auf der anderen Seite gefunden. Prillian 0.6.0 ist nicht supportet für Auto-Detection und das Script kann nicht das Netzwerk hinzufügen. Sie können es manuell hinzufügen wenn Sie wünschen. Sie können den Admin des Remoteaufstellungsortes auch anregen zur neuesten Version von Prillian zu updaten.';
$lang['ND_Unnamed_Site'] = 'namenlose ermittelte Seite';
$lang['ND_data_error'] = 'Es gibt einige Probleme mit den Autoabfrage- Daten die durch den Remoteaufstellungsort berichtet werden, so wird dieser Aufstellungsort Ihrem Netz in einem untauglichen Status mit mindestens einem eingetragenen Default-Wert hinzugefügt. Sie sollten die Informationen durch den Netz-Nachrichtenübermittlungs- Herausgeber später wiederholen. Die Störung kann auch einfach ein leerer Aufstellungsort- Name sein.';
$lang['ND_Added_Success'] = 'Der Aufstellungsort ist erfolgreich Ihrem Netz hinzugefügt worden!';
$lang['Allow_mode_switch'] = 'erlaube Benutzern unterschiedliche IM- Client Modi zu verwenden';

// These three will be used when there are images for the mode switches
//$lang['Alt_Main_Mode'] = 'Switch IM Client to Main Mode';
//$lang['Alt_Wide_Mode'] = 'Switch IM Client to Wide Mode';
//$lang['Alt_Mini_Mode'] = 'Switch IM Client to Mini Mode';
$lang['Alt_Main_Mode'] = 'Haupt-Modus';
$lang['Alt_Wide_Mode'] = 'Breit-Modus';
$lang['Alt_Mini_Mode'] = 'Mini-Modus';
$lang[''] = '';
$lang[''] = '';
$lang[''] = '';
$lang[''] = '';

// Adapted from Enhanced Admin User Lookup
$lang['User_lookup_explain'] = 'Sie können Benutzer nachschlagen indem Sie unten eins oder mehr der Kriterien spezifizieren. Keine Wildcards sind erforderlich, sie werden automatisch eingefügt.';
$lang['One_user_found'] = 'Nur ein Benutzer wurde gefunden, dieser Benutzer Sie wurde genommen';
$lang['Click_goto_prefs'] = 'Klicke %sHier%s um den Bnutzer zu verändern';
$lang['Click_goto_log'] = 'Klicke %sHier%s um die Benutzer- Messages anzuschauen';
$lang['User_joined_explain'] = 'Der Syntax ist identisch zur PHP- <a href="http://www.php.net/strtotime" target="_other">strtotime()</a> Funktion sein';
$lang['Click_return_perms_admin'] = 'Klicke %sHier%s um zur Benutzer- Erlaubnisverwaltung zurück zu gehen';


/* Entries Changed in 0.7.0 */

// Controls panels
$lang['Alt_Contact_Man'] = 'oganisiere Kontakte'; // Was $lang['Alt_Buddy_Man']

// Preferences editor
$lang['Wide_Client_Window'] = 'Breit- Klient- Modus'; // Was $lang['Whos_Online_Window']
$lang['Main_Window'] = 'Haupt- Klient- Modus';

/* Any of these that have network in the $lang['name'] part used to have s2s in
 place of network. In some, that is the only change */
// Network Messaging
$lang['Network_disabled'] = 'Sorry, aber das Netz-Nachrichtenübermittlung ist deaktiviert auf diesem Board.';
$lang['Network_no_username'] = 'Netz-Nachrichtenübermittlung funzt nicht ohne Ihrem Benutzername oder Teilnehmerbezeichnung.';
$lang['Network_no_siteurl'] = 'Netz-Nachrichtenübermittlung empfing nicht die URL des Aufstellungsortes, von dem Sie Ihre Message senden.';
$lang['Network_no_siteid'] = 'Netz-Nachrichtenübermittlung empfing nicht die URL des Aufstellungsortes, zu dem Sie Ihre Message schicken.';
$lang['Network_Users_online'] = 'Benutzer Online auf der anderen Webseite';
$lang['No_network_type'] = 'konnte nicht den Netzwerk-Typ feststellen';
$lang['Invalid_network_type'] = 'Konnte kein gültigen Nertzwerk-Typ feststellen.';
$lang['Network_not_in_db'] = 'Sorry, aber Ihre Seite sendet Ihre Messages die nicht in der Liste der anerkannten Aufstellungsorte auf der Seite, zu dem Sie versuchen die Messages zu verschicken.';
$lang['Send_a_new_network'] = 'sende eine neue Netwerk- Message';
$lang['Reply_to_a_network'] = 'antworte einer Netzwerk- Message';
$lang['Network_Flood_Error'] = 'Netz-Nachrichtenübermittlung kann nicht eine Nachricht so schnell nacheinander empfangen (Flood). Bitte Versuch es noch einmal.';

// Admin Network Messaging
$lang['Network_title'] = 'Netzwerk- Messaging- Editor';
$lang['Network_explain'] = 'Auf dieser Seite können Sie: hinzufügen, editieren und entfernen die Aufstellungsorte, die Ihre Benutzer über Prillian nutzen.';
$lang['Network_add'] = 'Neue Seite hinzufügen';
$lang['Network_del_success'] = 'Der Aufstellungsort wurde erfolgreich gelöscht. Ihre Benutzer können auf diesen Aufstellungsort durch Prillian nicht mehr zugreifen.';
$lang['Click_return_network'] = 'Klicke %sHier%s um zur Netz-Nachrichtenübermittlung zurück zu gehen.';
$lang['Network_config'] = 'Seiten Konfiguration';
$lang['Network_add_success'] = 'Die Seiten- Information wurde erfolgreich geändert.';

// Admin preferences editor
$lang['Admin_allow_network'] = 'Erlaube den Benutzern Netz-Nachrichtenübermittlung zu verwenden';

// Preferences editor
$lang['User_allow_network'] = 'aktiviere Netzwerk- Messaging für diesen Zugang';
$lang['Network_user_list'] = 'Wählen Sie eine Methode für Benutzer um sich Online anzuzeigen an anderen Aufstellungsorten';

// Do not change the [0], [1], etc. parts of the following
$lang['network_lists'][0] = 'Nicht anzeigen';
$lang['network_lists'][1] = 'zeige die Benutzer an auf dieser Webseite';
$lang['network_lists'][2] = 'zeige separat die Benutzern auf dieser Webseite';

// Admin Configuration
$lang['IM_allow_network'] = 'aktiviere  Netz-Nachrichtenübermittlung System';
/* End of the s2s -> network changes */



/*
The following entries were removed in 0.7.0

$lang['PUU_Constant']
$lang['PPU_Constant']
$lang['PUU_Constant_explain']
$lang['PPU_Constant_explain']
*/
?>