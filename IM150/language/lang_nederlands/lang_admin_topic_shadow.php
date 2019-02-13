<?php
/****************************************************************
*         $RCSfile: lang_admin_topic_shadow.php,v $  [Nederlands]
*                      -------------------
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

/* If you are translating this, please e-mail a copy to me! */
/* admin@nivisec.com is fine to use */

/* General */
$lang['Del_Before_Date'] = 'Alle Schaduw Onderwerpen voor %s zijn verwijderd <br />'; // %s = insertion of date
$lang['Deleted_Topic'] = 'Schaduw Onderwerp %s verwijderd<br />'; // %s = topic name
$lang['Affected_Rows'] = '%d bekende entries gemaakt<br />'; // %d = affected rows (not avail with all databases!)
$lang['Delete_From_Date'] = 'Alle Schaduw Topics die gecreerd zijn voor de ingevoerde datum zullen verwijderd worden';
$lang['Delete_Before_Date_Button'] = 'Verwijder alles voor datum';
$lang['No_Shadow_Topics'] = 'Geen Schaduw Topics gevonden.';
$lang['Topic_Shadow'] = 'Topic Schaduw';
$lang['TS_Desc'] = 'Laat het verwijderen van schaduw topics toe zonder het verwijderen van het originele bericht.  Schaduw topics zijn gemaakt wanneer je een post verplaatst naar een ander forum en kiest om het met een link (naar de post) in het originele forum te laten ';
$lang['Month'] = 'Maand';
$lang['Day'] = 'Dag';
$lang['Year'] = 'Jaar';
$lang['Clear'] = 'Wis';
$lang['Resync_Ran_On'] = 'Resync gedraaid op %s<br />'; // %s = insertion of forum name
$lang['All_Forums'] = 'Alle Forum\'s';
$lang['Version'] = 'Versie';

$lang['Title'] = 'Titel';
$lang['Moved_To'] = 'Verplaatst Naar';
$lang['Moved_From'] = 'Verplaatst Van';
$lang['Delete'] = 'Verwijder';

/* Modes */
$lang['topic_time'] = 'Onderwerp Tijd';
$lang['topic_title'] = 'Onderwerp Titel';

/* Errors */
$lang['Error_Month'] = 'De ingevoerde maand moet een waarde zijn tussen 1 en 12';
$lang['Error_Day'] = 'De ingevoerde dag moet een waarde zijn tussen 1 en 31';
$lang['Error_Year'] = 'Het ingevoerde jaar moet een waarde zijn tussen 1970 en 2038';
$lang['Error_Topics_Table'] = 'Fout, geen toegang to onderwerpen tabel';

//Special Cases, Do not change for another language
$lang['ASC'] = $lang['Sort_Ascending'];
$lang['DESC'] = $lang['Sort_Descending'];
$lang['Nivisec_Com'] = 'Nivisec.com';



?>