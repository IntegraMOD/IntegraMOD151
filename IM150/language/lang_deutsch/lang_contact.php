<?php
/***************************************************************************
 *                          lang_contact.php [English]
 *                            -------------------
 *   begin                : Friday, Jan 31, 2003
 *   version              : 0.8.0
 *   date                 : 2003/12/23 23:21
 ***************************************************************************/

 /***************************************************************************
 *
 *   german translation	:		clanpunisher
 *
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
// along with our copyright message indicating you are the translator
// please add it here.
$lang['TRANSLATION_INFO'] = '';

// Do not change the next six lines.
// Avoid including the file more than once.
if ( defined('IN_CONTACT_LANG') )
{
	return;
}
define('IN_CONTACT_LANG', true);

// You may want to edit the following lines to match your website.
$lang['Buddy'] = 'Freund';
$lang['Ignore'] = 'Ignorieren';
$lang['Disallow'] = 'Verbieten';
$lang['User_ignoring_you'] = 'Dieser Benutzer hat dich auf die Ignorierliste gesetzt.';
$lang['User_not_want_contact'] = 'Dieser Benutzer hat dich auf die Verbotsliste gesetzt.';
$lang['Buddies_online'] = 'Diese Freunde sind jetzt online';
$lang['Buddy_online'] = 'Dieser Freund ist jetzt online';
$lang['Buddies_offline'] = 'Diese Freunde sind jetzt offline';
$lang['Buddy_offline'] = 'Dieser Freund ist jetzt offline';
$lang['Listbox_Buddies'] = 'Deine Freunde';
$lang['Online'] = 'Online';
$lang['Offline'] = 'Offline';
$lang['Buddies'] = 'Freunde';
$lang['Ignored_some_users'] = 'Einige Benutzer dieser Seite wurden ignoriert. %sSeite mit diesen Benutzer anzeigen?%s';
$lang['Ignore_some_users'] = '%sSeite ohne diese Benutzer anzeigen?%s';

// These will be used in the user profiles for links to do the indicated thing
// Also used as ALT text for images in several places.  %s will be replaced with a
// user's name
$lang['Add_to_buddy'] = '%s wurde zu deiner Freundesliste hinzugefügt';
$lang['Remove_from_buddy'] = '%s wurde aus deiner Freundesliste ausgetragen';
$lang['Add_to_ignore'] = '%s wurde zu deiner Ignorierliste hinzugefügt';
$lang['Remove_from_ignore'] = '%s wurde aus deiner Ignorierliste ausgetragen';
$lang['Add_to_disallow'] = '%s wurde zu deiner Verbotsliste hinzugefügt';
$lang['Remove_from_disallow'] = '%s wurde aus deiner Verbotsliste ausgetragen';


// Error Messages
$lang['No_alerts_updated'] = 'Keine Benutzer wurden für eine Benachrichtigungsupdate erkannt';
$lang['No_autoclose'] = 'Wenn du diese Nachricht siehst, dann funktioniert das automatische schliessen des Fensters nicht mit deinem Browser. Eine mögliche Ursache könnte das blocken von Javascripten sein. Bitte schliesse das Fenster.';

// Control Panel
$lang['Users_you_ignore'] = 'Benutzer die du ignorierst';
$lang['Users_you_disallow'] = 'Bennutzer dennen es verboten ist dich zu kontaktieren';
$lang['Users_buddy_you'] = 'Benutzer die dich in die Freundesliste eingetragen haben';
$lang['Users_you_buddy'] = 'Deine Freunde';
$lang['None_you_ignore'] = 'Du ignorierst keinen Benutzer.';
$lang['None_you_disallow'] = 'Alle Benutzer können dich anschreiben.';
$lang['None_buddy_you'] = 'Kein Benutzer hat dich in seine Freundesliste eingetragen.';
$lang['None_you_buddy'] = 'Du hast keine Freunde eingetragen.';
$lang['Add_a_user'] = 'Einen Benutzer in die Freundesliste hinzufügen?';
$lang['Add_user'] = 'Benutzer hinzugefügt';
$lang['Move_selected_users'] = 'Verschiebe die ausgewählten Benutzer nach:';
$lang['Buddy_link'] = 'Freunde';
$lang['Buddied_link'] = 'Freund von...';
$lang['Ignore_link'] = 'Ignorieren';
$lang['Disallow_link'] = 'Verbieten';
$lang['Be_alerted'] = 'Benachrichtigung bei online gehen dieses Benutzers';
$lang['Edit_alerts'] = 'online/offline Einstellungen für die Benachrichtigungen bearbeiten';

// Success messages
$lang['Alerts_updated'] = 'Einstellungen für die Benachrichtigungen aller Freunde geändert';
$lang['Alerts_oops'] = ' bis auf folgende, die nicht gefunden werden konnten:<br />';
$lang['Moved_to_buddies'] = 'Die erkannten Benutzer wurden in deine Freundesliste verschoben.';
$lang['Moved_to_ignore'] = 'Die erkannten Benutzer wurden in deine Ignorierliste verschoben.';
$lang['Moved_to_disallow'] = 'Die erkannten Benutzer wurden in deine Verbotsliste verschoben.';
$lang['Removed_selected_users'] = 'Die erkannten Benutzer wurden gelöscht.';
$lang['Buddy_updated'] = 'Freundesliste aktualisiert';
$lang['Ignore_updated'] = 'Ignorierliste aktualisiert';
$lang['Disallow_updated'] = 'Verbotsliste aktualisiert';


// For Prillian
$lang['Close_window_link'] = '<br /><br /><a href="javascript:window.close();">' . $lang['Close_window'] . '</a>';

/* Entries Added in Prillian 0.7.0 & Contact List 0.3.0 */
$lang['No_ignore_admin'] = 'Du hast versucht folgende Administratoren oder Moderatoren: %s in deine Ignorier-/Verbotsliste zu setzen. Diese Benutzer können weder ignoriert noch verboten werden.<br />';
$lang['No_contact_add_self'] = 'Du hast versucht dich selbst in die Kontakliste einzutragen. Dies ist nicht erlaubt.';
$lang['Add_Selected_as_Buddies'] = 'Als Freunde hinzufügen';
$lang['Add_contact_users_link'] = 'Neue Kontakte hinzufügen';
$lang['You_have_buddies'] = 'Du hast %d Freunde.';
$lang['You_have_buddy'] = 'Du hast einen Freund.';
$lang['You_are_ignoring'] = 'Du ignorierst %d Benutzer.';
$lang['You_are_ignoring_one'] = 'Du ignorierst einen Benutzer.';
$lang['You_have_disallowed'] = 'Du verbietest %d Benutzern dich zu kontaktieren.';
$lang['You_have_disallowed_one'] = 'Du verbietest jeden Kontakt zu dir.';
$lang['You_as_buddies'] = '%d Benutzer haben dich als Freund hinzugefügt.';
$lang['You_as_buddy'] = 'Ein Benutzer hat dich als Freund eingetragen.';
$lang['Add_many_contacts_explain'] = 'Du kannst hier die Benutzer auf die Ignorier- oder Verbotsliste setzen. Schreibe den Benutzer den du hinzufügen möchtest in die untere Textbox. Pro Zeile darf nur ein Benutzer eingetragen werden.';
$lang['Add_to_Buddy_List'] = 'Zur Freundesliste hinzufügen';
$lang['Add_to_Ignore_List'] = 'Zur Ignorierliste hinzufügen';
$lang['Add_to_Disallow_List'] = 'Zur Verbotsliste hinzufügen';


/* Entries Changed in Prillian 0.7.0 & Contact List 0.3.0 */
/* Any of these that have contact in the $lang['name'] part used to have bid or
 buddy in place of contact. In some, that is the only change */
$lang['Contact_List_FAQ'] = 'Contact Lists'; // Title of the FAQ

$lang['Contact_Management'] = 'Kontakte';

// Error Messages
$lang['No_contact_mode'] = 'Kein Kontaktmodus definiert';
$lang['No_contact_type'] = 'Kein Kontakttyp definiert';
$lang['No_contact_action'] = 'Keine Kontaktaktion definiert';
$lang['No_contact_id'] = 'Keine Benutzer Kontakt id';
$lang['Invalid_contact_action'] = 'Kontaktaktion Definition ist falsch';


// Control Panel
$lang['Contact_click_here'] = '%sKontaktliste anpassen%s';


// Success messages
$lang['Confirm_contact_changes'] = 'Änderungen übernehmen?';
$lang['No_Contact_changes'] = 'Keine Änderungen wurde angegeben';


//Private Message alerts
$lang['System_title'] = 'Systemnachricht der Kontaktliste';
$lang['Contact_Alert_PM'] = '[url=%s]%s[/url] hat dich zu seiner/ihrer Freundesliste hinzugefügt. [url=%s]Klicke hier[/url] um deine Kontakliste zu bearbeiten . Diese Nachricht wurde automatisch generiert; es besteht kein Bedarf einer Antwort.';

?>