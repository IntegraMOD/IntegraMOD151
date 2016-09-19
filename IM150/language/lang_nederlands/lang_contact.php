<?php
/****************************************************************
 *                          lang_contact.php [Nerderlands]
 *                            -------------------
 *   begin                : Friday, Jan 31, 2003
 *   version              : 0.8.0
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
// along with our copyright message indicating you are the translator
// please add it here.
$lang['TRANSLATION_INFO'] = ' <br />[ <font style="font-size: 10px; color: #ec7600">Ondersteuning: <a href="http://www.integramod.nl">IntegraMOD Nederland(s)©</a></font> :: <font style="font-size: 10px; color: #ec7600">Vertaling: <a href="http://www.integramod.nl">The Dutch Team</a></font> ]';

// Do not change the next six lines.
// Avoid including the file more than once.
if ( defined('IN_CONTACT_LANG') )
{
	return;
}
define('IN_CONTACT_LANG', true);

// You may want to edit the following lines to match your website.
$lang['Buddy'] = 'Vriend';
$lang['Ignore'] = 'Negeer';
$lang['Disallow'] = 'Niet toestaan';
$lang['User_ignoring_you'] = 'Deze gebruiker heeft jouw op zijn negeer lijst gezet.';
$lang['User_not_want_contact'] = 'Deze gebruiker heeft jouw op zijn niet toegestane lijst gezet.';
$lang['Buddies_online'] = 'Deze vrienden zijn online';
$lang['Buddy_online'] = 'Deze vriend is online';
$lang['Buddies_offline'] = 'Deze vrienden zijn nu offline';
$lang['Buddy_offline'] = 'Deze vriend is nu offline';
$lang['Listbox_Buddies'] = 'Jouw vrienden';
$lang['Online'] = 'Online';
$lang['Offline'] = 'Offline';
$lang['Buddies'] = 'Vrienden';
$lang['Ignored_some_users'] = 'Sommige gebruikers op deze pagina worden genegeerd. %sBekijk deze pagina met deze gebruikers?%s';
$lang['Ignore_some_users'] = '%sBekijk deze pagina zonder de  gebruikers die genegeerd zijn ?%s';

// These will be used in the user profiles for links to do the indicated thing
// Also used as ALT text for images in several places.  %s will be replaced with a
// user's name
$lang['Add_to_buddy'] = 'Voeg %s toe aan jouw vrienden lijst';
$lang['Remove_from_buddy'] = 'Verwijder %s Van jouw vrienden lijst';
$lang['Add_to_ignore'] = 'Voeg %s toe tot je negeer lijst';
$lang['Remove_from_ignore'] = 'Verwijder %s Van jouw Negeerlijst';
$lang['Add_to_disallow'] = 'Voeg %s Toe aan jouw blokeer lijst';
$lang['Remove_from_disallow'] = 'Verwijder %s Van jouw niet toegestane contactlijst';


// Error Messages
$lang['No_alerts_updated'] = 'Geen gebruikers zijn geindentificeerd voor Waarshuwings update';
$lang['No_autoclose'] = 'Als u dit bericht ziet, dan zal de automatische windows sluitvenster in de toekomst niet werken met je browser. Mogelijke oorzaken met inbegrip van het hebben van uw browser\'s JavaScript uitgezet. Sluit uw venster.';

// Control Panel
$lang['Users_you_ignore'] = 'Gebruikers die je negeert';
$lang['Users_you_disallow'] = 'Gebruikers die je het verbied';
$lang['Users_buddy_you'] = 'Gebruikers lijst Van Vrienden';
$lang['Users_you_buddy'] = 'Jouw vrienden';
$lang['None_you_ignore'] = 'Je negeert geen gebruikers.';
$lang['None_you_disallow'] = 'Je laat alle gebruikers toestaan om je te contacten.';
$lang['None_buddy_you'] = 'Geen gebruikers hebben je toegevoegd in hun vriendenlijst.';
$lang['None_you_buddy'] = 'Er staan geen vrienden in je vriendenlijst.';
$lang['Add_a_user'] = 'Voeg een gebruiker toe aan de lijst?';
$lang['Add_user'] = 'Gebruiker toevoegen';
$lang['Move_selected_users'] = 'Verplaats de geselecteerde gebruikers:';
$lang['Buddy_link'] = 'Vrienden';
$lang['Buddied_link'] = 'Vrienden van...';
$lang['Ignore_link'] = 'Negeren';
$lang['Disallow_link'] = 'Blokkeren';
$lang['Be_alerted'] = 'Waarschuw me als deze gebruiker online komt ';
$lang['Edit_alerts'] = 'Bewerk online en offline Waarschuwings instellingen';

// Success messages
$lang['Alerts_updated'] = 'Waarschuwings voorkeuren zijn bijgewerkt voor alle veranderde vrienden';
$lang['Alerts_oops'] = ' behalve de volgende, die kon niet gevonden worden:<br />';
$lang['Moved_to_buddies'] = 'De Vermelde gebruikers zijn Verplaatst naar je vrienden lijst.';
$lang['Moved_to_ignore'] = 'De Vermelde gebruikers zijn verplaatst naar de negeerlijst.';
$lang['Moved_to_disallow'] = 'De Vermelde gebruikers zijn verplaatst naar de blokeer lijst.';
$lang['Removed_selected_users'] = 'De Vermelde gebruikers zijn verwijderd.';
$lang['Buddy_updated'] = 'Vrienden Lijst Bijgewerkt';
$lang['Ignore_updated'] = 'Negeer Lijst Bijgewerkt';
$lang['Disallow_updated'] = 'Blokeer lijst Bijgewerkt';


// For Prillian
$lang['Close_window_link'] = '<br /><br /><a href="javascript:window.close();">' . $lang['Close_window'] . '</a>';

/* Entries Added in Prillian 0.7.0 & Contact List 0.3.0 */
$lang['No_ignore_admin'] = 'Je hebt geprobeerd om de volgende beheerders of moderatoren te negeren of te blokkeren: %s. Probeer het opnieuw maar dan zonder te proberen deze gebruikers te negeren of te verbieden.<br />';
$lang['No_contact_add_self'] = 'Je  hebt geprobeerd jezelf aan één van de contactlijsten toe te voegen.  Dit wordt niet toegestaan; probeer het opnieuw zonder te proberen jezelf aan je eigen contactlijsten toe te voegen.';
$lang['Add_Selected_as_Buddies'] = 'Voeg geselecteerde(n) als Vrienden toe';
$lang['Add_contact_users_link'] = 'Voeg nieuwe contacten toe';
$lang['You_have_buddies'] = 'Je hebt %d Vrienden.';
$lang['You_have_buddy'] = 'Je hebt één Vriend.';
$lang['You_are_ignoring'] = 'Je negeert %d gebruikers.';
$lang['You_are_ignoring_one'] = 'Je negeert één gebruiker.';
$lang['You_have_disallowed'] = 'Je hebt %d gebruiker(s) blokeerd om contact met jou te hebben.';
$lang['You_have_disallowed_one'] = 'Je hebt één gebruiker blokeerd om contact met jou te hebben.';
$lang['You_as_buddies'] = '%d gebruikers zijn toegevoegd aan je vrienden lijst.';
$lang['You_as_buddy'] = 'Eén gebruiker heeft je toegevoegd als Vriend.';
$lang['Add_many_contacts_explain'] = 'Je mag HIER meerdere gebruikers toevoegen aan je Vienden, Negeer, of blokeer lijsten.  Enter the name of each user you wish to add in the text box below.  Iedere gebruiker op een aparte regel.';
$lang['Add_to_Buddy_List'] = 'Toevoegen aan Vrienden lijst';
$lang['Add_to_Ignore_List'] = 'Toevoegen aan Negeer lijst';
$lang['Add_to_Disallow_List'] = 'Toevoegen aan Blokeer lijst';


/* Entries Changed in Prillian 0.7.0 & Contact List 0.3.0 */
/* Any of these that have contact in the $lang['name'] part used to have bid or
 buddy in place of contact. In some, that is the only change */
$lang['Contact_List_FAQ'] = 'Contact Lijsten'; // Title of the FAQ

$lang['Contact_Management'] = 'Contacten';

// Error Messages
$lang['No_contact_mode'] = 'Geen contact mode gedefinieerd';
$lang['No_contact_type'] = 'Geen contact type gedefinieerd';
$lang['No_contact_action'] = 'Geen contact actie gedefinieerd';
$lang['No_contact_id'] = 'Geen contact gebruikers id';
$lang['Invalid_contact_action'] = 'Contact Actie definitie is ongeldig';


// Control Panel
$lang['Contact_click_here'] = '%sBewerken van contact lijst%s';


// Success messages
$lang['Confirm_contact_changes'] = 'Weet je zeker dat u dit wilt veranderen?';
$lang['No_Contact_changes'] = 'Er zijn geen veranderingen zijn gespecificeerd';


//Private Message alerts
$lang['System_title'] = 'Contact Lijst Systeem Bericht';
$lang['Contact_Alert_PM'] = '[url=%s]%s[/url] heeft u toegevoegd aan zijn vrienden lijst.  Om je contact lijst te bewerken, [url=%s]Klik hier[/url]. Dit is een automatisch bericht verzonden door het forum; Je hoeft dit bericht niet te beantwoorden.';

?>