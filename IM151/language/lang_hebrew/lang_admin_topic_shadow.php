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

/* If you are translating this, please e-mail a copy to me! */
/* admin@nivisec.com is fine to use */

/* General */
$lang['Del_Before_Date'] = 'נמחקו כל עותקי הנושאים שלפני %s<br />'; // %s = insertion of date
$lang['Deleted_Topic'] = 'נמחק עותק הנושא %s<br />'; // %s = topic name
$lang['Affected_Rows'] = '%d רישומים מודעים שהושפעו<br />'; // %d = affected rows (not avail with all databases!)
$lang['Delete_From_Date'] = 'כל עותקי הנושאים שנוצרו לפני התאריך שהוקלד יוסרו.';
$lang['Delete_Before_Date_Button'] = 'מחק הכל לפני התאריך';
$lang['No_Shadow_Topics'] = 'לא נמצאו עותקי נושאים.';
$lang['Topic_Shadow'] = 'עותק נושא';
$lang['TS_Desc'] = 'מאפשר להסיר עותק נושאים ללא המחיקה של ההודעה המקורית.  עותקי נושאים שנוצרו כאשר העברת הודעה לפורום אחר ובחרת להשאיר קישור לעותק בפורום המקורי להודעה החדשה.';
$lang['Month'] = 'חודש';
$lang['Day'] = 'יום';
$lang['Year'] = 'שנה';
$lang['Clear'] = 'הסר';
$lang['Resync_Ran_On'] = 'סינרון רץ ב-%s<br />'; // %s = insertion of forum name
$lang['All_Forums'] = 'כל הפורומים';
$lang['Version'] = 'גרסה';

$lang['Title'] = 'כותרת';
$lang['Moved_To'] = 'הועבר ל';
$lang['Moved_From'] = 'הועבר מ';
$lang['Delete'] = 'מחק';

/* Modes */
$lang['topic_time'] = 'זמן הנושא';
$lang['topic_title'] = 'כותרת  הנושא';

/* Errors */
$lang['Error_Month'] = 'החודש שהכנסת חייב להיות בין 1 ו-12';
$lang['Error_Day'] = 'היום שכנסת חייב להיות בין 1 ו-31';
$lang['Error_Year'] = 'השנה שהכנסת חייבת להיות בין 1970 ו-2038';
$lang['Error_Topics_Table'] = 'שגיאה בגישה לטבלת הנושאים';

//Special Cases, Do not change for another language
$lang['ASC'] = $lang['Sort_Ascending'];
$lang['DESC'] = $lang['Sort_Descending'];
$lang['Nivisec_Com'] = 'Nivisec.com';



?>