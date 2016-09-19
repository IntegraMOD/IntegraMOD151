<?php
/****************************************************************
*          $RCSfile: lang_admin_priv_msgs.php,v $   [Nederlands]
*                     -------------------
*   begin                : Tue January 20 2002
*   copyright            : (C) 2002-2003 Nivisec.com
*   email                : support@nivisec.com
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

/* General */
$lang['Deleted_Message'] = 'Verwijderde Privé Berichten - %s <br />'; // %s = PM title
$lang['Archived_Message'] = 'Gearchiveerde Privé Berichten - %s <br />'; // %s = PM title
$lang['Archived_Message_No_Delete'] = 'Kan %s niet verwijderen, Het is ook gemarkeerd als gearchiveerd <br />'; // %s = PM title
$lang['Private_Messages'] = 'Privé Berichten';
$lang['Private_Messages_Archive'] = 'Privé Berichten Archief';
$lang['Archive'] = 'Archief';
$lang['To'] = 'Aan';
$lang['Subject'] = 'Onderwerp';
$lang['Sent_Date'] = 'Verzenddatum';
$lang['Delete'] = 'Verwijder';
$lang['From'] = 'Van';
$lang['Sort'] = 'Sorteer';
$lang['Filter_By'] = 'Filter op';
$lang['PM_Type'] = 'PB Type';
$lang['Status'] = 'Status';
$lang['No_PMS'] = 'Geen Privé Berichten komen overeen met uw sorteercriteria.';
$lang['Archive_Desc'] = 'Privé Berichten die je gearchiveerd hebt, staan hier gerankschikt. Gebruikers kunnen deze niet meer bekijken (zender en ontvanger), maar jij kunt ze altijd bekijken of verwijderen.';
$lang['Normal_Desc'] = 'Alle Privé Berichten op je board kunnen hier beheerd worden.  Je kunt ze hier bekijken en kiezen om ze te verwijderen of te archiveren (bijhouden, maar gebruikers kunnen ze niet bekijken).';
$lang['Version'] = 'Versie';
$lang['Remove_Old'] = 'Wees PB\'s:</a> <span class="gensmall">Gebruikers die niet langer bestaan kunnen hun PB\'s achtergelaten hebben, dit zal de PB\'s verwijderen.</span>';
$lang['Remove_Sent'] = 'Verzonden PB\'s Box:</a> <span class="gensmall">PB\'s in de Verzonden Box zijn gewoon kopieën van exact hetzelfde bericht dat verzonden is. Deze zijn niet echt nodig.</span>';
$lang['Affected_Rows'] = '%d bekende entries verwijderd<br>';
$lang['Removed_Old'] = 'Alle Wees PB\'s verwijderd<br>';
$lang['Removed_Sent'] = ' Alle Verzonden PB\'s verwijderd<br>';
$lang['Utilities'] = 'Massa Verwijderings Utilities';
$lang['Nivisec_Com'] = 'Nivisec.com';

/* PM Types */
$lang['PM_-1'] = 'Alle Types'; //PRIVMSGS_ALL_MAIL = -1
$lang['PM_0'] = 'Lees PB\'s'; //PRIVMSGS_READ_MAIL = 0
$lang['PM_1'] = 'Nieuwe PB\'s'; //PRIVMSGS_NEW_MAIL = 1
$lang['PM_2'] = 'Verzonden PB\'s'; //PRIVMSGS_SENT_MAIL = 2
$lang['PM_3'] = 'Opgeslagen PB\'s (Postvak In)'; //PRIVMSGS_SAVED_IN_MAIL = 3
$lang['PM_4'] = 'Opgeslagen PB\'s (Postvak Uit)'; //PRIVMSGS_SAVED_OUT_MAIL = 4
$lang['PM_5'] = 'Ongelezen PB\'s'; //PRIVMSGS_UNREAD_MAIL = 5

/* Errors */
$lang['Error_Other_Table'] = 'Error bij het doorzoeken van een vereiste tabel.';
$lang['Error_Posts_Text_Table'] = 'Error bij het doorzoeken van de Privé Berichten Tekst tabel.';
$lang['Error_Posts_Table'] = 'Error bij het doorzoeken van de Privé Berichten tabel.';
$lang['Error_Posts_Archive_Table'] = 'Error bij het doorzoeken van de Privé Berichten Archief tabel.';
$lang['No_Message_ID'] = 'Geen bericht ID gespecificeerd.';


/*Special Cases, Do not bother to change for another language */
$lang['ASC'] = $lang['Sort_Ascending'];
$lang['DESC'] = $lang['Sort_Descending'];
$lang['privmsgs_date'] = $lang['Sent_Date'];
$lang['privmsgs_subject'] = $lang['Subject'];
$lang['privmsgs_from_userid'] = $lang['From'];
$lang['privmsgs_to_userid'] = $lang['To'];
$lang['privmsgs_type'] = $lang['PM_Type'];

?>