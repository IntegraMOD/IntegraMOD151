<?php
/***************************************************************************
*                            $RCSfile: lang_admin_priv_msgs.php,v $
*                            -------------------
*   begin                : Tue January 20 2002
*   copyright            : (C) 2002-2003 Nivisec.com
*   email                : support@nivisec.com
*
*   modified		 : Mahdi, 2005/06/04 (German translated)
*
***************************************************************************/

/***************************************************************************
*
*   This program is free software; you can redistribute it and/or modify
*   it under the terms of the GNU General Public License as published by
*   the Free Software Foundation; either version 2 of the License, or
*   (at your option) any later version.
*
***************************************************************************/

/* General */
$lang['Deleted_Message'] = 'gelöschte Privat- Message - %s <br />'; // %s = PM title
$lang['Archived_Message'] = 'archivierte Privat- Message - %s <br />'; // %s = PM title
$lang['Archived_Message_No_Delete'] = 'Kann nicht %s löschen, dies wurde für das Archiv außerdem gekennzeichnet <br />'; // %s = PM title
$lang['Private_Messages'] = 'Privat- Messages';
$lang['Private_Messages_Archive'] = 'PM- Archiv';
$lang['Archive'] = 'Archive';
$lang['To'] = 'zu';
$lang['Subject'] = 'Thema';
$lang['Sent_Date'] = 'Absendedatum';
$lang['Delete'] = 'löschen';
$lang['From'] = 'von';
$lang['Sort'] = 'sortieren';
$lang['Filter_By'] = 'Filter von';
$lang['PM_Type'] = 'PM Art';
$lang['Status'] = 'Status';
$lang['No_PMS'] = 'keine Privat-Messages bringt die Sortierkriterien hervor';
$lang['Archive_Desc'] = 'diese Privat- Messages willst du archivieren die hier verzeichnet werden. Die Benutzer sind nicht mehr in der Lage diese zugänglich zu machen (Absender und Empänger), aber Sie können sie jederzeit ansehen oder löschen.';
$lang['Normal_Desc'] = 'Alle Privat-Messages von deinem Board werden hier gemanaged. Du kannst alle Messages lesen, die du löschen oder archivieren möchtest (bleiben, aber die Benutzer können sie nicht sehen).';
$lang['Version'] = 'Version';
$lang['Remove_Old'] = 'Orphan PMs:</a> <span class="gensmall">Benutzer die nicht mehr bestehen, können links PMs noch haben, diese werden hier entfernt.</span>';
$lang['Remove_Sent'] = 'Sent Box PMs:</a> <span class="gensmall">PMs in der Sende-Box sind Kopien die gesendet wurden,   diese werden nicht wirklich benötigt.</span>';
$lang['Affected_Rows'] = '%d bekannte Eintragungen entfernt<br>';
$lang['Removed_Old'] = 'entferne alle Orphan-PMs<br>';
$lang['Removed_Sent'] = 'lösche alle gesendete PMs<br>';
$lang['Utilities'] = 'Massenlösch- Tool';
$lang['Nivisec_Com'] = 'Nivisec.com';

/* PM Types */
$lang['PM_-1'] = 'alle Typen'; //PRIVMSGS_ALL_MAIL = -1
$lang['PM_0'] = 'lese PMs'; //PRIVMSGS_READ_MAIL = 0
$lang['PM_1'] = 'neue PMs'; //PRIVMSGS_NEW_MAIL = 1
$lang['PM_2'] = 'sende PMs'; //PRIVMSGS_SENT_MAIL = 2
$lang['PM_3'] = 'speicher PMs (In)'; //PRIVMSGS_SAVED_IN_MAIL = 3
$lang['PM_4'] = 'gespeicherte PMs (Out)'; //PRIVMSGS_SAVED_OUT_MAIL = 4
$lang['PM_5'] = 'ungelesene PMs'; //PRIVMSGS_UNREAD_MAIL = 5

/* Errors */
$lang['Error_Other_Table'] = 'Fehler in einer erforderlichen Tabelle.';
$lang['Error_Posts_Text_Table'] = 'Fehler in der PM- Texttabelle.';
$lang['Error_Posts_Table'] = 'Fehler in der Abfrage der PM- Tabelle.';
$lang['Error_Posts_Archive_Table'] = 'Fehler in der Abfrage der PM- Archivtabelle.';
$lang['No_Message_ID'] = 'Keine Message- ID wurde spezifiziert.';


/*Special Cases, Do not bother to change for another language */
$lang['ASC'] = $lang['Sort_Ascending'];
$lang['DESC'] = $lang['Sort_Descending'];
$lang['privmsgs_date'] = $lang['Sent_Date'];
$lang['privmsgs_subject'] = $lang['Subject'];
$lang['privmsgs_from_userid'] = $lang['From'];
$lang['privmsgs_to_userid'] = $lang['To'];
$lang['privmsgs_type'] = $lang['PM_Type'];

?>