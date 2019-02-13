<?php
/****************************************************************
 *                         lang_jr_admin.php [Nederlands]
 *                         -------------------
 *   begin                : Friday, June 07, 2002
 *   copyright            : (C) 2002 Nivisec.com
 *   email                : admin@nivisec.com
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

$lang['None'] = 'Geen';
$lang['Allow_Access'] = 'Toegang toestaan';

$lang['Jr_Admin'] = 'Junior Beheerder';
$lang['Options'] 			= 'Opties';
$lang['Example'] 			= 'Voorbeeld';
$lang['Version'] 			= 'Versie';
$lang['Add_Arrow'] 			= 'Toevoegen ->';
$lang['Super_Mod'] = 'Super Moderator';
$lang['Update'] = 'Update';
$lang['Module_Info'] = 'Module Info';
$lang['Module_Count'] 			= 'Module Teller';
$lang['Modules_Owned'] = '(%d Modules)';
$lang['Updated_Permissions'] 		= 'Gebruikers Module Rechten Bijgewerkt<br>';
$lang['Color_Group'] 			= 'Kleur Groep';
$lang['Users_with_Access'] 		= 'Gebruikers Met Toegang';
$lang['Users_without_Access'] 		= 'Gebruikers Zonder Toegang';
$lang['Check_All'] = 'Selecteer Alles';
$lang['Cat_Check_All'] 			= 'Categorie: Selecteer, De-selecteer Alles';
$lang['Edit_Permissions'] 		= 'Bewerk Gebruikers Rechten';
$lang['View_Profile'] 			= 'Bekijk Gebruikers Profiel';
$lang['Edit_User_Details'] 		= 'Bewerk Gebruikers Details';
$lang['Notes'] 				= 'Aantekeningen';
$lang['Allow_View'] 			= 'Geef Gebruiker Toestemming Om Te Kijken';
$lang['Start_Date'] 			= 'Rechten Voor het Eerst Toegewezen Op';
$lang['Update_Date'] 			= 'Rechten Voor het Laatst Bewerkt Op';
$lang['Edit_Modules'] 			= 'Bewerk Modules';
$lang['Color_Group'] 			= 'Kleur Group';
$lang['Rank'] 				= 'Rang';
$lang['Allow_PM'] 			= 'Sta PB toe';
$lang['Allow_Avatar'] 			= 'Avatar Toestaan';
$lang['User_Active'] 			= 'Gebruiker Actief';
$lang['User_Info'] 			= 'Gebruiker Info';
$lang['User_Stats'] 			= 'Gebruiker Statistieken';
$lang['Junior_Admin_Info'] 		= 'Jouw Junior Beheerder Info';
$lang['Admin_Notes'] 			= 'Beheerder Aantekeningen';

//Descriptions
$lang['Levels_Page_Desc'] 		= 'Op deze pagina kun je gebruikers niveaus definiëren. Kies een gebruikersnaam uit de lijst om toe te voegen of type hem handmatig in.  Gebruikersnamen MOETEN op elke lijst gescheiden worden door een (komma)!';
$lang['Permissions_Page_Desc'] 		= 'Op deze pagina kun je bepaalde \'admin-only\' gebruikers opties wijzigen en ook hun module lijst bewerken.<br>Je kunt op kolom kop klikken om een kolom te sorteren.';

//Errors
$lang['Error_Users_Table'] 		= 'Fout bij het doorzoeken van de gebruikerstabel.';
$lang['Error_Module_Table'] 		= 'Fout bij het doorzoeken van de Jr Beheerder module rechten tabel.';
$lang['Error_Module_ID'] 		= 'De gevraagde module bestaat niet of je bent geen geautoriseerde gebruiker.';
$lang['Disabled_Color_Groups'] 		= 'Kleur Groepen Module niet gevonden, kan geen kleur groep toewijzen.';
$lang['Admin_Note'] 			= 'Opmerking: Deze gebruiker heeft Beheerder rechten. Elke hier geplaatste restrictie zal niet werken totdat je zijn/haar toegang veranderd hebt naar Gebruiker i.p.v. Beheerder.';
$lang['No_Special_Ranks'] 		= 'Geen speciale rangen gedefiniëerd.';

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