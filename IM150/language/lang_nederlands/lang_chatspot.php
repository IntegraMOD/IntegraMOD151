<?php

/***************************************************************************
 *                          lang_chatspot.php [Nederlands]
 *                              -------------------
 *   begin                : Tuesday, June 29, 2004
 *   copyright            : (C) 2004 masterdavid - Ronald John David
 *   website			  : http://www.integramod.com
 *   email                : webmaster@integramod.com
 * 
 *   Nederlandse vertaling  : Juli 2005 
 *   The Dutch Team         : http://www.integramod.nl 
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

// General
$lang['Return_2_chat'] = 'Terug naar de chatbox';
$lang['Access_denied'] = 'TOEGANG GEWEIGERD';
$lang['Room_name_error'] = 'Je kunt alleen alfanumerieke tekens (a-z en 0-9) en het onderstreepteken in chatkamer namen gebruiken.';
$lang['Password_error'] = 'Je kunt alleen alfanumerieke tekens (a-z en 0-9) en het onderstreepteken in wachtwoorden gebruiken.';
$lang['Cannot_determine_user_id'] = 'FOUT:  kan geen gebruikers id vaststellen.';
$lang['Cannot_determine_room_id'] = 'FOUT:  kan geen chatkamer id vaststellen.';
$lang['Enter_room_name'] = 'Vul een chatkamer naam in.'; 
$lang['Group_error'] = 'Voor deze chatkamer is een speciale groep lidmaatschap nodig; toegang geweigerd.';
$lang['Password_protected_error'] = 'Deze chatkamer is met een wachtwoord beschermt; toegang geweigerd.';
$lang['Password_invalid_error'] = 'Het ingevulde wachtwoord is niet juist; toegang geweigerd.';
$lang['Kicked_you'] = 'Je bent uit de chatkamer geschopt.';
$lang['User_created_room'] = '<b>%s</b> heeft de chatkamer gemaakt op <b>%s</b>'; // username has created the room roomname on

// chatspot.php
$lang['Invalid_room_name'] = 'Ongeldige chatkamer naam ingevuld.';
$lang['Cannot_find_room'] = 'Kan chatkamer niet vinden.';
$lang['User_has_joined'] = '<b>%s</b> is de kamer binnen gekomen op <b>%s</b>'; // username has joined room roomname on

// config
$lang['System_msg'] = 'Systeem bericht';

// drop
$lang['Cannot_determine_room_name'] = 'FOUT:  kan de chatkamer naam niet vaststellen.';
$lang['Cannot_determine_username'] = 'FOUT:  kan gebruikersnaam niet vaststellen.';
$lang['Leaving_room'] = 'verlaat de chatkamer...';
$lang['Log_out'] = 'Uitloggen';
$lang['Left_room'] = 'Je hebt deze chatkamer verlaten: \'%s\'.'; // You left teh room 'roomname'.
$lang['Logged_out'] = 'Je bent succesvol uitgelogt.';

// fuctions
$lang['User_kicked_from'] = '<b>%s</b> is deze chatkamer uitgeschopt op: <b>%s</b>'; // username was kikked from roomname
$lang['Please_login'] = 'Je moet bij het forum inloggen om gebruik te kunnen maken van de chatkamer.';
$lang['No_Frames'] = 'Je browser ondersteund geen frames. Gebruik internet explorer voor de beste resultaten.';
$lang['Max_rooms_error'] = 'Je hebt het maximale aantal gebruikers bereikt voor de chatkamers.';
$lang['Already_in_room'] = 'De sessie lijst geeft aan dat je al in deze chatkamer bent: \'<b>%s</b>\'. Als dit niet goed is, klik <a href="%s">hier</a> om de chatkamer binnen te gaan.'; // room name & url inclusion
$lang['Open_room'] = 'Als een venster van deze chatkamer \'<b>%s</b>\' niet binnen een aantal seconden verschijnt , klik dan <a href="%s">hier</a>'; // room name & url inclusion
$lang['Password_cleared'] = 'Het wachtwoord voor deze chatkamer is verwijderd.'; 
$lang['Password_changed'] = 'Het wachtwoord voor deze chatkamer is veranderd.'; 
$lang['Creator_error'] = 'Je bent niet de maker van deze chatkamer; toegang geweigerd.'; 
$lang['User_left_room'] = '<b>%s</b> heeft deze chatkamer verlaten op: <b>%s</b>'; // username has left the room roomname on

// rooms
$lang['None'] = 'Geen'; 
$lang['Room_management'] = 'Chatkamer Management'; 
$lang['Permanent_rooms'] = '<b><u>Permanente kamers</u></b><br />
		<br />
		Dit beheerpaneel geeft je de mogelijkheid de permanente kamers in phpBBChatSpot te regelen.  Onthoud dat de gebruikers nog steeds hun eigen tijdelijke kamer kunnen maken.<br />
		<br />Alle huidige permanente kamers staan in de lijst hieronder.  Je kunt maar één kamer per keer veranderen (of toevoegen). Na het veranderen van de desbetreffende kamer klik je op de \'<b>Update</b>\' knop die overeenkomt met de kamer; bij het maken van een kamer klik je op de \'<b>Toevoegen</b>\' knop, wanneer je de nieuwe kamer informatie hebt ingevult.<br />
		<br />
		Je kunt de standaard kamer niet verwijderen.<br />
		<br />'; 
$lang['Room_Name'] = 'Kamer naam'; 
$lang['Group_access'] = 'Groep Toegang'; 
$lang['Control'] = 'Beheer';
$lang['Create'] = 'Aanmaken';

// title
$lang['Refresh_Chat'] = 'Vernieuwen'; 
$lang['Help'] = 'Help'; 
$lang['About'] = 'Info'; 
$lang['Close'] = 'Sluiten';

// control
$lang['User_logged_out'] = '<b>%s</b> is uitgelogd uit het forum op '; // username 
$lang['User_logged_out'] = '<b>%s</b>\'s sessies zijn verlopen op '; // username 

// interpreter
$lang['Kick_missing_name'] = 'Geef de naam van de gebruiker die je wilt kikken.';
$lang['User_not_online'] = 'De gebruiker <b>%s</b> is niet online.'; // username
$lang['User_not_in_room'] = 'De gebruiker <b>%s</b> is niet in deze kamer.'; // username

$lang['User_killed'] = '<b>%s</b>\'s sessies zijn beëindingd.'; // username
$lang['Include_message'] = 'Voeg een bericht toe dat naar alle kamers verzonden wordt.';
$lang['Purge_complete'] = 'Verlossen is klaar.';
$lang['Marked_away'] = 'Je bent als afwezig genoteerd.';
$lang['Invite_missing_name'] = 'Geef de naam aan van de gebruiker die je wilt uitnodigen naar deze kamer.';
$lang['Invite_user_away'] = 'De gebruiker <b>%s</b> is op moment niet op het forum; uitnodiging is niet verzonden.'; // username
$lang['Invite_user_present'] = 'De gebruiker <b>%s</b> is al in een chatroom; gebruik <b>/p %s</b> om deze een persoonlijk bericht te versturen.'; // username + username
$lang['Invite_error'] = 'Er was een fout bij het uitnodigen van<b>%s</b>'; // username
$lang['Invite_succeed'] = '<b>%s</b> is uitgenodigd om in de chatroom deel te nemen.'; // username
$lang['Names_room_missing'] = 'Voeg een kamer naam in om zo een lijst van namen van de gebruikers te krijgen.';
$lang['Room_not_exist'] = 'De kamer <b>%s</b> bestaat niet.'; // roomname
$lang['Users_in_room'] = 'De volgende gebruikers zijn in de kamer <b>%s</b>:  '; // roomname
$lang['Pm_missing_name'] = 'Voeg de gebruikers namen in van diegene die je een persoonlijk bericht wilt sturen.';
$lang['Missing_Message'] = 'Voeg het bericht in dat je naar de gebruikers wilt sturen.';
$lang['Message_not_send'] = 'bericht is niet verzonden.';
$lang['Command_ignored'] = 'Het commando <b>%s</b> is niet geldig; genegeerd.'; // command

// send
$lang['Command_ignored'] = 'overvloed beheersing: Je kan niet meer dan één bericht versturen in %s seconden.'; // config seconds
$lang['Loading_error'] = 'Het bericht beheer heeft het laden niet voltooid.  wacht een aantal secondes, of klik op de \'Vernieuw chat\' link, of vertrek en kom terug.';
$lang['Invite_Flood'] = 'Uitnodigings overvloed beheer:  je kan niet meer dan één persoon uitnodigen in %s seconden.'; // config seconds

// manager
$lang['Room_management_response'] = 'Kamer Management terugkoppeling';
$lang['Room_delete_error'] = 'Er was een onbekende fout bij het verwijderen van de gevraagde kamer.';
$lang['Room_delete_success'] = 'De gevraagde kamer is met succes verwijderd.';
$lang['Room_exists'] = 'FOUT:  De kamer <b>%s</b> bestaat al.'; // roomname
$lang['Room_create_success'] = 'De gevraagde kamer is met succes aangemaakt.';
$lang['Room_create_error'] = 'Er was een onbekende fout bij het aanmaken van de gevraagde kamer.';
$lang['Room_update_error'] = 'Er was een onbekende fout bij het bijwerkenen van de gevraagde kamer.';
$lang['Room_update_success'] = 'De gevraagde kamer is met succes bijgewekt.';


// invite
$lang['Inviting_you'] = '%s vraagt jou om de chatkamer binnen te gaan'; //username
$lang['Pm_invite'] = '%s vraagt je om deze chatkamer binnen te gaan: %s. <a href="%s">klik hier om binnen te gaan.</a>'; // username + roomname + link
?>