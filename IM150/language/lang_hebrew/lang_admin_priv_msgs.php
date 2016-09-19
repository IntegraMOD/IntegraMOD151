<?php
/***************************************************************************
*                            $RCSfile: lang_admin_priv_msgs.php,v $
*                            -------------------
*   begin                : Tue January 20 2002
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

/* General */
$lang['Deleted_Message'] = 'ההודעה הפרטית נמחקה - %s <br />'; // %s = PM title
$lang['Archived_Message'] = 'ההודעה הפרטית נכנסה לארכיון - %s <br />'; // %s = PM title
$lang['Archived_Message_No_Delete'] = 'לא ניתן למחוק את %s, היא מסומנת לארכיון גם כן <br />'; // %s = PM title
$lang['Private_Messages'] = 'הודעות פרטיות';
$lang['Private_Messages_Archive'] = 'ארכיון הודעות פרטיות';
$lang['Archive'] = 'ארכיון';
$lang['To'] = 'מאת';
$lang['Subject'] = 'כותרת';
$lang['Sent_Date'] = 'תאריך שליחה';
$lang['Delete'] = 'מחק';
$lang['From'] = 'מאת';
$lang['Sort'] = 'מיין';
$lang['Filter_By'] = 'סנן על-ידי';
$lang['PM_Type'] = 'סוג הודעה פרטית';
$lang['Status'] = 'מצב';
$lang['No_PMS'] = 'אין הודעות פרטיות המתאימות לאפשרויות המיון שלך להצגה';
$lang['Archive_Desc'] = 'ההודעות הפרטיות שבחרת להכניס לאכיון רשומות כאן.  המשתמשים לא יוכלו לגשת אליהם יותר (המוענים והנמענים), אבל אתה יכול לצפות או למחוק אותם בכל זמן.';
$lang['Normal_Desc'] = 'כל ההודעות הפרטיות בפורום שלך יכולות להיות מנוהלות כאן.  אתה יכול לקרוא כל מה שתרצה ולבחור כדי למחוק אן להכניס לארכיון (לשמור, אבל המשתמשים לא יוכלו לצפות) את ההודעות גם כן.';
$lang['Version'] = 'גרסה';
$lang['Remove_Old'] = 'הודעות פרטיות מיותמות:</a> <span class="gensmall">משתמשים שאינם קיימים יותר שהשאירו את ההודעות הפרטיות לאחר, דבר זה ימחק אותם.</span>';
$lang['Remove_Sent'] = 'Sent Box PMs:</a> <span class="gensmall">הודעות פרטיות בתיבה שנשלחו פשוט עותקים של אותה הודעה שנשלחה בדיוק, חוץ משנקבעה למוען אחר שהמשתמש האחר קרא את ההודעה הפרטית.  הם לא נדרשים באמת.</span>';
$lang['Affected_Rows'] = '%d רשומות ידועות הוסרו<br>';
$lang['Removed_Old'] = 'הוסרו כל ההודעות הפרטיות המיותמות<br>';
$lang['Removed_Sent'] = 'הוסרו כל ההודעות הפרטיות שנשלחו<br>';
$lang['Utilities'] = 'שירותי מחיקה';
$lang['Nivisec_Com'] = 'Nivisec.com';

/* PM Types */
$lang['PM_-1'] = 'כל הסוגים'; //PRIVMSGS_ALL_MAIL = -1
$lang['PM_0'] = 'הודעות פרטיות שנקראו'; //PRIVMSGS_READ_MAIL = 0
$lang['PM_1'] = 'הודעות פרטיות חדשות'; //PRIVMSGS_NEW_MAIL = 1
$lang['PM_2'] = 'הודעות פרטיות שנשלחו'; //PRIVMSGS_SENT_MAIL = 2
$lang['PM_3'] = 'הודעות פרטיות שמורות (נכנסות)'; //PRIVMSGS_SAVED_IN_MAIL = 3
$lang['PM_4'] = 'הודעות פרטיות שמורות (יוצאות)'; //PRIVMSGS_SAVED_OUT_MAIL = 4
$lang['PM_5'] = 'הודעות פרטיות שלא נקראו'; //PRIVMSGS_UNREAD_MAIL = 5

/* Errors */
$lang['Error_Other_Table'] = 'שגיאה בשאילתת הטבלה הנדרשת.';
$lang['Error_Posts_Text_Table'] = 'שגיאה בשאילתת טבלת תוכן ההודעות הפרטיות.';
$lang['Error_Posts_Table'] = 'שגיאה בשאילתת טבלת ההודעות הפרטיות.';
$lang['Error_Posts_Archive_Table'] = 'שגיאה בשאילתת טבלת ארכיון ההודעות הפרטיות.';
$lang['No_Message_ID'] = 'אין הודעה עם ה-ID שצויין.';


/*Special Cases, Do not bother to change for another language */
$lang['ASC'] = $lang['Sort_Ascending'];
$lang['DESC'] = $lang['Sort_Descending'];
$lang['privmsgs_date'] = $lang['Sent_Date'];
$lang['privmsgs_subject'] = $lang['Subject'];
$lang['privmsgs_from_userid'] = $lang['From'];
$lang['privmsgs_to_userid'] = $lang['To'];
$lang['privmsgs_type'] = $lang['PM_Type'];

?>