<?php
/***************************************************************************
*                         admin_panel_nivisec.php
*                            -------------------
*   begin                : Friday, June 07, 2002
*   copyright            : (C) 2002 Nivisec.com
*   email                : admin@nivisec.com
*
*
*
***************************************************************************/

 /***************************************************************************
 *
 *   german translation	:		clanpunisher
 *
 ***************************************************************************/
 
$lang['None'] = 'Keine';
$lang['Allow_Access'] = 'Zugang gewähren';

$lang['Jr_Admin'] = 'Junior Admin';
$lang['Options'] = 'Einstellungen';
$lang['Example'] = 'Beispiel';
$lang['Version'] = 'Version';
$lang['Add_Arrow'] = 'Hinzufügen ->';
$lang['Super_Mod'] = 'Super Moderator';
$lang['Update'] = 'Übernehmen';
$lang['Module_Info'] = 'Modul Info';
$lang['Module_Count'] = 'Modul Zähler';
$lang['Modules_Owned'] = '(%d Module)';
$lang['Updated_Permissions'] = 'Modul Berechtigungen der Benutzer übernommen<br>';
$lang['Color_Group'] = 'Gruppenfarbe';
$lang['Users_with_Access'] = 'Benutzer mit Zugang';
$lang['Users_without_Access'] = 'Benutzer ohne Zugang';
$lang['Check_All'] = 'Alle/Keine auswählen';
$lang['Cat_Check_All'] = 'Kategorie: Alle/Keine auswählen';
$lang['Edit_Permissions'] = 'Benutzerberechtigungen bearbeiten';
$lang['View_Profile'] = 'Benutzerprofil anzeigen';
$lang['Edit_User_Details'] = 'Benutzerdetails bearbeiten';
$lang['Notes'] = 'Anmerkungen';
$lang['Allow_View'] = 'Benutzern die Anzeige gestatten';
$lang['Start_Date'] = 'Berechtigungen erstellt am';
$lang['Update_Date'] = 'Berechtigungen geändert am';
$lang['Edit_Modules'] = 'Bearbeite Module';
$lang['Color_Group'] = 'Gruppenfarbe';
$lang['Rank'] = 'Rang';
$lang['Allow_PM'] = 'PM erlauben';
$lang['Allow_Avatar'] = 'Avatar erlauben';
$lang['User_Active'] = 'Benutzer Aktiv';
$lang['User_Info'] = 'Benutzer Info';
$lang['User_Stats'] = 'Benutzer Statistik';
$lang['Junior_Admin_Info'] = 'Deine Junior Admin Info';
$lang['Admin_Notes'] = 'Admin Anmerkung';

//Descriptions
$lang['Levels_Page_Desc'] = 'Auf dieser Seite kannst du Benutzerberechtigungen definieren.  Wähle einen Benutzer aus des Liste aus, damit du ihn hizufügen kannst oder trage ihn manuell ein.  Benutzernamen müssen für jede Liste durch ein , (Komma) getrennt werden!';
$lang['Permissions_Page_Desc'] = 'Auf dieser Seite kannst du bestimmte Admin-Benutzer Optionen als auch die Liste Ihrer Module bearbeiten.';

//Errors
$lang['Error_Users_Table'] = 'Fehler beim durchsuchen der Benutzertabelle.';
$lang['Error_Module_Table'] = 'Fehler beim durchsuchen der Berechtigungenstabelle für die Junior Admin Module.';
$lang['Error_Module_ID'] = 'Das angeforderte Modul existiert nicht oder aber du bist kein berechtigtes Mitglied.';
$lang['Disabled_Color_Groups'] = 'Mod für Gruppenfarben nicht gefunden, kann Gruppenfarben nicht ändern.';
$lang['Admin_Note'] = 'Achtung:  Dieser Benutzer ist ein Administrator.  Keine Einschränkungen werden übernommen bis du ihren Zugang als normalen Benutzer statt Administrator einstellst.';
$lang['No_Special_Ranks'] = 'Keine speziellen Ränge definiert.';

//This is the bookmark ASCII search list!  If you have odd usernames, you should add your own ASCII search numbers.
//It uses a special format.
//
// Smaller-case letters are ignored also.  Don't bother listing them as everything is converted to upper case for eval.
//
// It searches and prepares the bookmark heading IN THE ORDER you have it below.  It will not sort lowest to highest.
//
// Item-Item2 will search the code from item to item2 AND give each their own bookmark heading (ex. A-Z)
// Item&Item2 will search the code from item to item2 BUT NOT give each their own heading, they will appear like 1-9
// You can add single entries, ie 67
// Seperate entry areas by a ,
//
$lang['ASCII_Search_Codes'] = '48&57, 65-90';

//Images
// Don't change these unless you need to
$lang['ASC_Image'] = 'images/asc_order.png';
$lang['DESC_Image'] = 'images/desc_order.png';

?>