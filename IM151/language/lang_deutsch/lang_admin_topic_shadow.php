<?php
/***************************************************************************
*                            $RCSfile: lang_admin_topic_shadow.php,v $
*                            -------------------
*   copyright            : (C) 2002-2003 Nivisec.com
*   email                : support@nivisec.com
*
*
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

/***************************************************************************
 *
 *   german translation	:		clanpunisher
 *
 ***************************************************************************/

/* If you are translating this, please e-mail a copy to me! */
/* admin@nivisec.com is fine to use */

/* General */
$lang['Del_Before_Date'] = 'Lösche alle Schatten-Themen vor dem %s<br />'; // %s = insertion of date
$lang['Deleted_Topic'] = 'Schatten-Thema %s erfolgreich gelöscht<br />'; // %s = topic name
$lang['Affected_Rows'] = '%d bekannte Einträge die betroffen wurden<br />'; // %d = affected rows (not avail with all databases!)
$lang['Delete_From_Date'] = 'Alle Schatten-Themen die vor dem angegebenen Datum erstellt wurden, werden gelöscht.';
$lang['Delete_Before_Date_Button'] = 'Lösche bis';
$lang['No_Shadow_Topics'] = 'Keine Schatten-Themen gefunden.';
$lang['Topic_Shadow'] = 'Schatten-Thema';
$lang['TS_Desc'] = 'Allows the removal of shadow topics without the deletion of the actual message.  Shadow topics are created when you move a post to another forum and choose to leave behind a link in the original forum to the new post.';
$lang['Month'] = 'Monat';
$lang['Day'] = 'Tag';
$lang['Year'] = 'Jahr';
$lang['Clear'] = 'Löschen';
$lang['Resync_Ran_On'] = 'Resynchronisierung fortsetzen %s<br />'; // %s = insertion of forum name
$lang['All_Forums'] = 'Alle Foren';
$lang['Version'] = 'Version';

$lang['Title'] = 'Titel';
$lang['Moved_To'] = 'Verschoben nach';
$lang['Moved_From'] = 'Verschoben von';
$lang['Delete'] = 'Löschen';

/* Modes */
$lang['topic_time'] = 'Thema-Zeit';
$lang['topic_title'] = 'Thema-Titel';

/* Errors */
$lang['Error_Month'] = 'Die Eingabe der Monate muss zwischen 1 und 12 liegen';
$lang['Error_Day'] = 'Die Eingabe der Tage muss zwischen 1 und 31 liegen';
$lang['Error_Year'] = 'Die Eingabe der Jahre muss zwischen 1970 und 2038 liegen';
$lang['Error_Topics_Table'] = 'Error accessing topics table';

//Special Cases, Do not change for another language
$lang['ASC'] = $lang['Sort_Ascending'];
$lang['DESC'] = $lang['Sort_Descending'];
$lang['Nivisec_Com'] = 'Nivisec.com';



?>