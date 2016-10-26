<?php

/***************************************************************************
 *                            lang_dbmtnc.php [English]
 *                              -------------------
 *   begin                : Fri Feb 07, 2003
 *   copyright            : (C) 2004 Philipp Kordowich
 *                          Parts: (C) 2002 The phpBB Group
 *
 *   part of DB Maintenance Mod 1.2.2
 ****************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/


//
// Language file for DB Maintenance Mod
//

$lang['DB_Maintenance'] = 'תחזוקת בסיס נתונים';
$lang['DB_Maintenance_Description'] = 'כאן אתה יכול לבדוק את בסיס הנתונים שלך לאי-עקביות ושגיאות.<br />
	<b>שים לב:</b> כמה פעולות יקחו זמן רב לביצוע. המערכת שלך תהיה <b>נעולה</b> במשך הפעולות.</br />
	<br />
	<b>זה מומלץ תמיד לגבות את בסיס הנתונים שלך לפני השימוש בכל אחד מהפונקציות הרשומות להלן!</b>';
$lang['Function'] = 'פונקציה';
$lang['Function_Description'] = 'תיאור';

$lang['Incomplete_configuration'] = 'הגדרה ל-<b>%s</b> לא נמצאה בהגדרות המערכת. תחזוקת בסיס הנתונים אינה יכולה לרוץ ללא הגדרה זו.<br />
	יכול להיות ששכחת לבצע את פקודות ה-SQL כמתוארים בהוראות ההתקנה.';
$lang['dbtype_not_supported'] = 'סליחה, פונקציה זו לא נתמכת לבסיס הנתונים שלך';
$lang['no_function_specified'] = 'אין פונקציה שצויינה';
$lang['function_unknown'] = 'הפונקציה שצויינה אינה ידועה';
$lang['Old_MySQL_Version'] = 'סליחה, גרסת ה-MySQL שלך לא תומכת בפונקציה זו. אנא השתמש בגרסה 3.23.17 או חדשה יותר.';

$lang['Back_to_DB_Maintenance'] = 'חזור לתחזוקת בסיס הנתונים';
$lang['Processing_time'] = 'תחזוקת בסיס הנתונים לקחה %f שניות לפעולות';

$lang['Lock_db'] = 'מכבה מערכת';
$lang['Unlock_db'] = 'מפעיל מערכת';
$lang['Already_locked'] = 'המערכת כבר נעולה';
$lang['Ignore_unlock_command'] = 'המערכת נעולה בזמן התחלת פקודה זו. המערכת לא תשוחרר מנעילה';
$lang['Delay_info'] = 'מעקב בשלוש שניות כדי לאפשר לפעולות בסיס הנתונים להסתיים...';

$lang['Affected_row'] = 'שורה אחת הושפעה';
$lang['Affected_rows'] = '%d שורות הושפעו';
$lang['Done'] = 'הסתיים';
// The following variable is used when nothing hat to be fixed in the database. It needs the complete paragraph-tag.
// If you do not want a message to be displayed in these cases, just leave the variable empty.
$lang['Nothing_to_do'] = "<p class=\"gen\"><i>אין דבר לעשות :-)</i></p>\n";

//
// Names for new records in several tables
//
$lang['New_cat_name'] = 'הפורומים שוחזרו';
$lang['New_forum_name'] = 'הנושאים שוחזרו';
$lang['New_topic_name'] = 'ההודעות שוחזרו';
$lang['Restored_topic_name'] = 'הנושא שוחזר';
$lang['New_poster_name'] = 'ההודעה שוחזרה'; // Name for Poster of a restored post

//
// Functions available
//
// Usage: $mtnc[] = array(internal Name, Name of Function, Description of Function, Warning Message (leef empty to avoid), Number of Check function (Integer))
// Use $mtnc[] = array('--', '', '', '', 0) for a space row (you can us a different check function)
//
$mtnc[] = array('statistic',
	'סטטיסטיקה',
	'הראה מידע על המערכת ובסיס הנתונים.',
	'',
	0);
$mtnc[] = array('config',
	'הגדרות',
	'אפשר הגדרות של תחזוקת בסיס הנתונים.',
	'',
	5);
$mtnc[] = array('--', '', '', '', 0);
$mtnc[] = array('check_user',
	'בדוק טבלאות משתמשים וקבוצות',
	'הפעולה תבדוק את טבלאות המשתמשים והקבוצות לשגיאות ותשחזר טעות קבוצות משתמשים יחידות.',
	'אתה תשחרר את כל הטבלאות ללא אף חבר בפעולה זו. בטוח?',
	0);
$mtnc[] = array('check_post',
	'בדוק טבלאות נושאים והודעות',
	'פעולה זו תבדוק את כל טבלאות הנושאים וההודעות לשגיאות.',
	'אתה תשחרר את כל ההודעות ללא תוכן. בטוח?',
	0);
$mtnc[] = array('check_vote',
	'בדוק טבלאות הצבעות',
	'הפעולה תבדוק את טבלאות ההצבעות לשגיאות.',
	'אתה תשחרר את כל נתוני ההצבעות ללא הצבעה מתאימה. בטוח?',
	0);
$mtnc[] = array('check_pm',
	'בדוק טבלאות הודעות פרטיות',
	'הפעולה תבדוק את טבלאות ההודעות הפרטיות לשגיאות.',
	'הודעות שאינם נקראו ימחקו כאשר השולח או הנמען אינם קיימים. בטוח?',
	0);
$mtnc[] = array('--', '', '', '', 0);
$mtnc[] = array('check_search_wordmatch',
	'בדוק טבלת תיאומי מילות חיפוש',
	'הפעולה תבדוק את טבלת תיאומי המילים. טבלה זו בשימוש לפונקציית החיפוש.',
	'',
	0);
$mtnc[] = array('check_search_wordlist',
	'בדוק טבלת רשימת מילות חיפוש',
	'הפעולה תסיר את כל המילים המיותרות ברשימת המילים שבשימוש לחיפוש.',
	'פונקציה זו יכולה לקחת זמן רב לביצוע. זה לא הכרחי לבצע בדיקה זו אבל פעולה זו תקטין קצת את גודל בסיס הנתונים. בטוח?',
	0);
$mtnc[] = array('--', '', '', '', 0);
$mtnc[] = array('synchronize_post',
	'סינכרון פורומים ונושאים',
	'הפעולה תסנכרן את מוני ההודעה ונתוני ההודעה בפורומים ונושאים.',
	'פעולה זו יכולה לקחת זמן רב עד שתושלם. אם השרת אינו מאפשר את שימוש בפקודה set_time_limit(), פקודה זו יכולה להיות מופסקת על-ידי PHP. לא יאבדו נתונים כך אבל כמה נתונים יכולים להיות לא מעודכנים. בטוח?',
	0);
$mtnc[] = array('synchronize_user',
	'סנכרון מוני הודעת משתמשים',
	'פעולה זו תסנכרן את מוני ההודעה למשתמשים.',
	'<b>שים לב:</b> הודעות שאופסו לא יפחתו ממונה ההודעות כרגיל. בזמן הרצת פקודה זו, הודעות שאופסו יפחתו מהמונה ולא יהיה ניתן לשחזרם. Proceed?',
	6);
$mtnc[] = array('synchronize_mod_state',
	'סנכרון מצב מנהל',
	'פעולה זו תסנכרן את מצב המנהל בטבלת המשתמשים.',
	'',
	0);
$mtnc[] = array('--', '', '', '', 0);
$mtnc[] = array('reset_date',
	'איפוס תאריך ההודעה האחרונה',
	'הפעולה תאפס את תאריך ההודעה האחרונה אם זאת תהיה בעתיד. הפקודה תפתור עניינים שבהם המשתמשים מקבלים הודעה שבה הם לא רשאים ליצור הודעה נוספת בזמן קצר כל כך מאז האחת האחרונה.',
	'כל זמן הודעה בעתיד תקבע לזמן הנוכחי. בטוח?',
	0);
$mtnc[] = array('reset_sessions',
	'איפוס כל העונות',
	'הפעולה תרוקן את כל העונות הנוכחיות על-ידי ריקון הטבלה session.',
	'כל המשתמשים הפעילים הנוכחיים יאבדו את העונה שלהם ותוצאות החיפוש שלהם. בטוח?',
	0);
$mtnc[] = array('--', '', '', '', 8);
$mtnc[] = array('rebuild_search_index',
	'בניית אינדקס החיפוש חדש',
	'פונקצייה זו תבנה מחדש את האינדקס שבשימוש לחיפוש. אתה לא תצטרך פונקצייה זו תחת תנאים נורמליים.',
	'הפעולה תמחק את אינדקס החיפוש השלם ותבנה אותו מחשד. זה יכול לקחת כמה שעות להשלמת משימה זו. הפורום לא יהיה נגיש בזמן זה. בטוח?',
	7);
$mtnc[] = array('proceed_rebuilding',
	'איתחול מחדש של הבנייה',
	'השתמש בפונקציה זו אם היצירה מחדש של אינדקס החיפוש תופסק.',
	'',
	4);
$mtnc[] = array('--', '', '', '', 1);
$mtnc[] = array('check_db',
	'בדוק בסיס נתונים',
	'בודק את בסיס הנתונים לשגיאות.',
	'',
	1);
$mtnc[] = array('optimize_db',
	'יעל בסיס נתונים',
	'מיעל את הטבלאות. הפעולה תקטין את גודל בסיס הנתונים לאחר מחיקת הרבה רשומות וכן הלאה.',
	'',
	1);
$mtnc[] = array('repair_db',
	'תקן בסיס נתונים',
	'מתקן את בסיס הנתונים כאשר נמצאו שגיאות.',
	'אתה צריך לבצע פעולה זו בלבד אם שגיאוה דווחה בזמן בדיקת בסיס הנתונים. בטוח?',
	1);
$mtnc[] = array('--', '', '', '', 0);
$mtnc[] = array('reset_auto_increment',
	'איפוס גידול ערכים אוטומטית',
	'פונקציה זו מאפסת את גידול ערכים אוטומטית. זה צריך להתבצע רק אם נראה שיש בעייה בזמן הוספת נתונים חדשים בטבלה.',
	'האם אתה באמת רוצה לאפס את גידול הערכים אוטומטית? לא יאבדו נתונים אבל פונקציה זו צריכה להית בשימוש רק אם ישנה בעייה בזמן הוספת נתונים חדשים לטבלה.',
	0);
$mtnc[] = array('heap_convert',
	'הפיכת טבלת עונה',
	'פונקציה זו הופכת את טבלת העונה לסוג טבלת HEAP. פקודה זו תתבצע במשך ההתקנה ותאיץ את phpBB קצת. אתה צריך להשתמש בפונקציה זו אם טבלת העונה שלך היא לא מסוג טבלה HEAP.',
	'האם אתה באמת רוצה להפוך את הטבלה?',
	2);
$mtnc[] = array('--', '', '', '', 3);
$mtnc[] = array('unlock_db',
	'שחרור נעילת המערכת',
	'השתמש בפונקציה זו אם אתה מקבל שגיאה במשך ביצוע פעולה קודם והמערת עדיין נשארה נעולה.',
	'',
	3);

//
// Function specific vars
//

// statistic
$lang['Statistic_title'] = 'סטטיסטיקת בסיס נתונים ומערכת';
$lang['Database_table_info'] = 'סטטיסטיקת בסיס הנתונים תמסר לשלושה ערכים שונים: לכל הטבלאות של בסיס הנתונים, לכל
	הטבלאות שנמסרו על-ידי phpBB כברירת מחדל (טבלאות מרכזיות) ואלו שמתחילות עם התחילית של טבלאות המערכת (טבלאות מתקדמות).';
$lang['Board_statistic'] = 'סטטיסטיקת מערכת';
$lang['Database_statistic'] = 'סטטיסטיקת בסיס הנתונים';
$lang['Version_info'] = 'פרטי הגרסה';
$lang['Thereof_deactivated_users'] = 'מזה הופסק';
$lang['Thereof_Moderators'] = 'מזה מנהלים';
$lang['Thereof_Administrators'] = 'מזה מנהלים ראשיים';
$lang['Users_with_Admin_Privileges'] = 'משתמשים עם גישות מנהל ראשי';
$lang['Number_tables'] = 'מספר טבלאות';
$lang['Number_records'] = 'מספר רשומות';
$lang['DB_size'] = 'גודל בסיס הנתונים';
$lang['Thereof_phpbb_core'] = 'מזה טבלאות phpBB מרכזיות';
$lang['Thereof_phpbb_advanced'] = 'מזה טבלאות phpBB מתקדמות';
$lang['Version_of_board'] = 'גרסת המערכת';
$lang['Version_of_mod'] = 'גירסת תחזוקת בסיס הנתונים';
$lang['Version_of_PHP'] = 'גרסת PHP';
$lang['Version_of_MySQL'] = 'גרסת MySQL';
// config
$lang['Config_title'] = 'הגדרות תחזוקת בסיס הנתונים';
$lang['Config_info'] = 'האפשרויות הבאות מאפשרות לך להגדיר את ההתנהגות של תחזוקת בסיס הנתונים. שים לב שהגדרות שגויות יכולות להוביל לתוצאות בלתי צפויות.';
$lang['General_Config'] = 'הגדרות כלליות';
$lang['Rebuild_Config'] = 'הגדרות בנייה מחדש של אינדקס החיפוש';
$lang['Current_Rebuild_Config'] = 'הגדרות בנייה מחדש נוכחיות';
$lang['Rebuild_Settings_Explain'] = 'הגדרות אלו מכוונות את התנהגות התחזוקת בסיס הנתונים בזמן בניית אינדקס החיפוש מחדש.';
$lang['Current_Rebuild_Settings_Explain'] = 'הגדרות אלו בשימוש על-ידי תחזוקת בסיס הנתונים לאחסון המיקום של הבנייה מחדש הנוכחית. אין צורך להסתגל לאותם הגדרות תחת תנאים נורמליים.';
$lang['Disallow_postcounter'] = 'סינכרון לא מורשה למוני הודעות משתמש';
$lang['Disallow_postcounter_Explain'] = 'הפעולה תכבה את פונקצית סינכרון מוני הודעות המשתמש. אתה יכול לא לאפשר פונקציה זו אם אתה לא רוצה שהודעות שאופסו יפחתו ממוני הודעות המשתמשים.';
$lang['Disallow_rebuild'] = 'בנייה מחדש לא מורשת של אינדקס החיפוש';
$lang['Disallow_rebuild_Explain'] = 'הפעולה תכבה את הבנייה מחדש של אינדקס החיפוש. הפסקת הבנייה מחדש יכולה להיות ממושכת בכל זאת.';
$lang['Rebuildcfg_Timelimit'] = 'זמן ביצוע מירבי לבנייה מחדש (בשניות)';
$lang['Rebuildcfg_Timelimit_Explain'] = 'זמן משומש מירבי לשלב אחד בזמן בנייה מחדש (ברירת מחדל: 240). ערך זה מגביל את זמן הביצוע אפילו אם זמן יותר ארוך אפשרי.';
$lang['Rebuildcfg_Timeoverwrite'] = 'כמות מתוקנת של זמן זמין לביצוע (בשניות)';
$lang['Rebuildcfg_Timeoverwrite_Explain'] = 'זמן מתוקן מוערך זמין לביצוע (ברירת מחדל: 0). עם 0 התוצאה של החישוב תשומש כזמן הביצוע, כל ערך אחר יעבור על הערך המחושב.';
$lang['Rebuildcfg_Maxmemory'] = 'גודל הודעה מירבי לבנייה מחדש (ב-kByte)';
$lang['Rebuildcfg_Maxmemory_Explain'] = 'גודל הודעות מירבי מאונדקסות בשלב אחד (ברירת מחדל: 500). כאשר סכום גדלי ההודעות נותן מעל ערך זה, לא תהיה הודעה מאונדקסת בעתיד בשלב הנוכחי.';
$lang['Rebuildcfg_Minposts'] = 'מינימום הודעות לאנדקס בכל שלב';
$lang['Rebuildcfg_Minposts_Explain'] = 'מינימום מספר הודעות מאונדקסות לכל שלב (ברירת מחדל: 3). מגדיר את מספר ההודעות שלפחות מאונדקסות לכל שלב.';
$lang['Rebuildcfg_PHP3Only'] = 'השתמש רק בשיטת ההתאמה של PHP 3 הרגילה לאינדקוס';
$lang['Rebuildcfg_PHP3Only_Explain'] = 'תחזוקת בסיס הנתונים משתמשת בשיטה מיוחדת לאינדוקס כאשר PHP 4.0.5 או חדש יותר זמין. אתה יכול לכבות את השיטה המתקדמת כך שתחזוקת בסיס הנתונים תשתמש בשיטה הרגילה של המערכת.';
$lang['Rebuildcfg_PHP4PPS'] = 'הודעות מאונדקסות לכל שנייה בזמן שימוש בשיטת אינדוקס מתקדמת';
$lang['Rebuildcfg_PHP4PPS_Explain'] = 'ערך מוערך של הודעות שיכול להיות מאונדקס לכל שנייה בזמן שימוש בשיטת האינדוקס המתקדמת (ברירת מחדל: 8).';
$lang['Rebuildcfg_PHP3PPS'] = 'הודעות מאונדקסות לכל שנייה בזמן שימוש בשיטת האינדוקס הרגילה';
$lang['Rebuildcfg_PHP3PPS_Explain'] = 'ערך מוערך של הודעות שיכול להיות מאונדקס בכל שנייה בזמן שימוש בשיטת האינדוקס הרגילה (ברירת מחדל: 1).';
$lang['Rebuild_Pos'] = 'הודעה אחרונה מאונדקסת';
$lang['Rebuild_Pos_Explain'] = 'ID של ההודעה האחרונה שאונדקסה בהצלחה. -1 כאשר הבנייה מחדש הסתיימה.';
$lang['Rebuild_End'] = 'הודעה אחרונה לאנדקס';
$lang['Rebuild_End_Explain'] = 'ID של ההודעה האחרונה לאנדקס. 0 כאשר הבנייה מחדש הסתיימה.';
$lang['Dbmtnc_config_updated'] = 'ההגדרות עודכנו בהצלחה';
$lang['Click_return_dbmtnc_config'] = 'לחץ %sכאן%s כדי לחזור להגדרות';
// check_user
$lang['Checking_user_tables'] = 'בודק טבלאות משתמשים וקבוצות';
$lang['Checking_missing_anonymous'] = 'בודק חשבונות אלמוניים שגויים';
$lang['Anonymous_recreated'] = 'חשבון אלמוני נוצר מחדש';
$lang['Checking_incorrect_pending_information'] = 'בודק פרטים נסיוניים שגויים';
$lang['Updating_invalid_pendig_user'] = 'עודכנו פרטים נסיוניים שגויים למשתמש אחד';
$lang['Updating_invalid_pendig_users'] = 'עודכנו פרטים נסיוניים שגויים ל-%d משתמשים';
$lang['Updating_pending_information'] = 'מעדכן פרטים נסיוניים לקבוצות משתמשים בודדות';
$lang['Checking_missing_user_groups'] = 'בודק למשתמשים בכמה קבוצות או קבוצת משתמש יחידה';
$lang['Found_multiple_SUG'] = 'נמצאו משתמשים עם קבוצות משתמשים יחידות או מרובות';
$lang['Resolving_user_id'] = 'פותר משתמשים לקבוצות';
$lang['Removing_groups'] = 'מסיר קבוצות';
$lang['Removing_user_groups'] = 'מסיר משתמש לחיבור קבוצה';
$lang['Recreating_SUG'] = 'יוצר מחדש קבוצות משתמשים בודדות למשתמש';
$lang['Checking_for_invalid_moderators'] = 'בודק להגדרות מנהל קבוצה שגויים';
$lang['Updating_Moderator'] = 'הגדרת משתמש נוכחית למנהל קבוצה';
$lang['Checking_moderator_membership'] = 'בודק חברות קבוצה למנהלים';
$lang['Updating_mod_membership'] = 'מעדכן חברות מנהלי קבוצה';
$lang['Moderator_added'] = 'המנהל נוסף לקבוצה';
$lang['Moderator_changed_pending'] = 'מצב המנהל הנסיוני שונה';
$lang['Remove_invalid_user_data'] = 'מסיר נתוני משתמש שגויים בטבלת קבוצות המשתמשים';
$lang['Remove_empty_groups'] = 'מסיר קבוצות ריקות';
$lang['Remove_invalid_group_data'] = 'מסיר נתוני קבוצה שגויים בטבלת קבוצות המשתמשים';
$lang['Checking_ranks'] = 'בודק דירוגים שגויים';
$lang['Invalid_ranks_found'] = 'נמצאו משתמשים עם דירוגים שגויים';
$lang['Removing_invalid_ranks'] = 'מסיר דירוגים שגויים';
$lang['Checking_themes'] = 'בודק הגדרות ערכות שגויות';
$lang['Updating_users_without_style'] = 'מעדכן משתמשים עם אף ערכה שנקבעה';
$lang['Default_theme_invalid'] = '<b>אזהרה:</b> עיצוב ברירת המחדל שגוי. אנא בדוק את ההגדרות שלך.';
$lang['Updating_themes'] = 'מעדכן ערכות שגויות לערכה %d';
$lang['Checking_theme_names'] = 'בודק נתון שם ערכה שגוי';
$lang['Removing_invalid_theme_names'] = 'מסיר נתון שם ערכה שגוי';
$lang['Checking_languages'] = 'בודק הגדרות שפה שגוייה';
$lang['Invalid_languages_found'] = 'נמצאו משתמשים עם הגדרות שפה שגוייה';
$lang['Default_language_invalid'] = '<b>אזהרה:</b> שפת ברירת המחדל שגוייה. אנא בדוק את ההגדרות שלך.';
$lang['English_language_invalid'] = '<b>אזהרה:</b> שפת ברירת המחדל שגוייה וקבצי השפה האנגלית לא קיימים. אתה צריך לשחזר את התיקייה <b>lang_english</b>.';
$lang['Changing_language'] = 'משנה שפה \'%s\' ל \'%s\'';
$lang['Remove_invalid_ban_data'] = 'מסיר נתוני חסימה שגויים';
// check_post
$lang['Checking_post_tables'] = 'בודק טבלאות הודעות ונושאים';
$lang['Checking_invalid_forums'] = 'בודק פורומים עם קטגוריה שגוייה';
$lang['Invalid_forums_found'] = 'נמצאו פורומים עם קטגוריה שגוייה';
$lang['Setting_category'] = 'מעביר פורומים לקטגוריה \'%s\'';
$lang['Checking_posts_wo_text'] = 'בודק הודעות ללא תוכן';
$lang['Posts_wo_text_found'] = 'נמצאו הודעות ללא תוכן';
$lang['Deleting_post_wo_text'] = '%d (נושאים: %s (%d); משתמש: %s (%d))';
$lang['Deleting_Posts'] = 'מוחק נתוני הודעה';
$lang['Checking_topics_wo_post'] = 'בודק נושאים ללא הודעה';
$lang['Topics_wo_post_found'] = 'נמצאו נושאים ללא הודעה';
$lang['Deleting_topics'] = 'מוחק נתוני נושא';
$lang['Checking_invalid_topics'] = 'בודק נושאים עם פורום שגוי';
$lang['Invalid_topics_found'] = 'נמצאו נושאים עם פורום שגוי';
$lang['Setting_forum'] = 'מעביר נושאים לפורום \'%s\'';
$lang['Checking_invalid_posts'] = 'בודק הודעות עם נושא שגוי';
$lang['Invalid_posts_found'] = 'נמצאו הודעות עם נושא שגוי';
$lang['Setting_topic'] = 'מעביר הודעות %s לנושא \'%s\' (%d) בפורום \'%s\'';
$lang['Checking_invalid_forums_posts'] = 'בודק הודעות עם פורום שגוי';
$lang['Invalid_forum_posts_found'] = 'נמצאו הודעות עם פורום שגוי';
$lang['Setting_post_forum'] = '%d: מעביר מפורום \'%s\' (%d) ל \'%s\' (%d)';
$lang['Checking_texts_wo_post'] = 'בודק תכני הודעה ללא הודעה';
$lang['Invalid_texts_found'] = 'נמצאו תכנים ללא הודעות';
$lang['Recreating_post'] = 'יוצר מחדש הודעה %d ומעביר אותה לנושא \'%s\' בפורום \'%s\'<br />מחלץ: %s';
$lang['Checking_invalid_topic_posters'] = 'בודק נושאים של שולחים שגויים';
$lang['Invalid_topic_poster_found'] = 'נמצאו נושאים של שולחים שגויים';
$lang['Updating_topic'] = 'מעדכן נושא %d (שולח: %d -&gt; %d)';
$lang['Checking_invalid_posters'] = 'בודק הודעות של שולחים שגויים';
$lang['Invalid_poster_found'] = 'נמצאו הודעות עם שולח שגוי';
$lang['Updating_posts'] = 'מעדכן הודעות';
$lang['Checking_moved_topics'] = 'בודק נושאים שהועברו';
$lang['Deleting_invalid_moved_topics'] = 'מוחק נושאים שהועברו שגויים';
$lang['Updating_invalid_moved_topic'] = 'מעדכן פרטים שהועברו שגויים לנושא אחד שלא הועבר';
$lang['Updating_invalid_moved_topics'] = 'מעדכן פרטים שהועברו שגויים ל-%d נושאים שלא הועברו';
$lang['Checking_prune_settings'] = 'בודק נתוני איפוס שגויים';
$lang['Removing_invalid_prune_settings'] = 'מסיר הגדרות איפוס שגויים';
$lang['Updating_invalid_prune_setting'] = 'מעדכן הגדרות איפוס שגויים של פורום אחד';
$lang['Updating_invalid_prune_settings'] = 'מעדכן הגדרות איפוס שגויים של %d פורומים';
$lang['Checking_topic_watch_data'] = 'בודק נושאים מעוקבים שגויים';
$lang['Checking_auth_access_data'] = 'בודק נתוני גישת קבוצה שגויים';
$lang['Must_synchronize'] = 'אתה צריך לסנקרן את נתוני ההודעה לפני השימוש במערכת. לחץ כדי להמשיך.';
// check_vote
$lang['Checking_vote_tables'] = 'בדוק טבלאות הצבעות';
$lang['Checking_votes_wo_topic'] = 'בודק הצבעות ללא התאמה לנושא';
$lang['Votes_wo_topic_found'] = 'נמצאו הצבעות ללא נושא';
$lang['Invalid_vote'] = '%s (%d) - תאריך התחלה: %s - תאריך סיום: %s';
$lang['Deleting_votes'] = 'מוחק הצבעות';
$lang['Checking_votes_wo_result'] = 'בודק הצבעות ללא תוצאה';
$lang['Votes_wo_result_found'] = 'נמצאו הצבעות ללא תוצאה';
$lang['Checking_topics_vote_data'] = 'בודק נתוני הצבעה בטבלות הנושאים';
$lang['Updating_topics_wo_vote'] = 'מעדכן נושאים שסומנו כהצבעה ללא הצבעה מותאמת';
$lang['Updating_topics_w_vote'] = 'בודק נושאים לא מסומנים כהצבעה אבל עם הצבעה מותאמת';
$lang['Checking_results_wo_vote'] = 'בודק תוצאות ללא הצבעה מותאמת';
$lang['Results_wo_vote_found'] = 'נמצאו תוצאות ללא הצבעות';
$lang['Invalid_result'] = 'מוחק תוצאה: %s (הצבעות: %d)';
$lang['Checking_voters_data'] = 'בודק נתוני הצבעה שגויים';
// check_pm
$lang['Checking_pm_tables'] = 'בודק טבלאות הודעות פרטיות';
$lang['Checking_pms_wo_text'] = 'בודק הודעות פרטיות ללא תוכן';
$lang['Pms_wo_text_found'] = 'נמצאו הודעות פרטיות ללא תוכן';
$lang['Deleting_pn_wo_text'] = '%d (נושא: %s; שולח: %s (%d); נמען: %s (%d))';
$lang['Deleting_Pms'] = 'מוחק נתוני הודעה פרטית';
$lang['Checking_texts_wo_pm'] = 'בודק תכני הודעות פרטיות ללא הודעה';
$lang['Deleting_pm_texts'] = 'מוחק תכני הודעות פרטיות שגויים';
$lang['Checking_invalid_pm_senders'] = 'בודק הודעות פרטיות עם שולחים שגויים';
$lang['Invalid_pm_senders_found'] = 'נמצאו הודעות פרטיות עם שולח שגוי';
$lang['Updating_pms'] = 'מעדכן הודעות פרטיות';
$lang['Checking_invalid_pm_recipients'] = 'בודק הודעות פרטיות עם נמענים שגויים';
$lang['Invalid_pm_recipients_found'] = 'נמצאו הודעות פרטיות עם נמען שגוי';
$lang['Checking_pm_deleted_users'] = 'בודק הודעות פרטיות עם שולחים או נמענים שנמחקו';
$lang['Invalid_pm_users_found'] = 'נמצאו הודעות פרטיות עם שולחים או נמענים שנמחקו';
$lang['Deleting_pms'] = 'מוחק הודעות פרטיות';
$lang['Synchronize_new_pm_data'] = 'מסנקרן מונה הודעות פרטיות חדשות';
$lang['Synchronizing_users'] = 'מעדכן משתמשים';
$lang['Synchronizing_user'] = 'מעדכן משתמש %s (%d)';
$lang['Synchronize_unread_pm_data'] = 'מסנקרן מונה הודעות פרטיות שלא נקראו';
// check_search_wordmatch
$lang['Checking_search_wordmatch_tables'] = 'בודקת טבלת התאמות מילים';
$lang['Checking_search_data'] = 'בודק נתוני חיפוש שגויים';
// check_search_wordlist
$lang['Checking_search_wordlist_tables'] = 'בודק טבלת התאמות מילים';
$lang['Checking_search_words'] = 'בודק מילות חיפוש מיותרות';
$lang['Removing_part_invalid_words'] = 'מסיר חלק ממילות החיפוש המיותרות';
$lang['Removing_invalid_words'] = 'מסיר מילות חיפוש מיותרות';
// rebuild_search_index
$lang['Rebuilding_search_index'] = 'בונה מחדש אינדקס חיפוש';
$lang['Deleting_search_tables'] = 'מרוקן טבלאות חיפוש';
$lang['Reset_search_autoincrement'] = 'מאפס מונה טבלאות חיפוש';
$lang['Preparing_config_data'] = 'מגדיר נתוני הגדרות';
$lang['Can_start_rebuilding'] = 'אתה יכול עכשיו להתחיל עם הבנייה מחדש של אינדקס נחיפוש';
$lang['Click_once_warning'] = '<b>רק לחיצה על הקישור פעם אחת!</b> - זה יכול לקחת מכמה דקות עד הצגת עמוד חדש.';
// proceed_rebuilding
$lang['Preparing_to_proceed'] = 'מכין טבלאות כדי לאפשר להמשיך';
$lang['Preparing_search_tables'] = 'מכין טבלאות חיפוש כדי להמשיך';
// perform_rebuild
$lang['Click_or_wait_to_proceed'] = 'לחץ כאן כדי להמשיך או המתן כמה שניות';
$lang['Indexing_progress'] = '%d מתוך %d הודעות (%01.1f%%) אונדקסו. ההודעה האחרונה שאונדקסה: %d';
$lang['Indexing_finished'] = 'הבנייה מחדש של האינדקס הסתיימה בהצלחה';
// synchronize_post
$lang['Synchronize_posts'] = 'מסנקרן נתוני הודעה';
$lang['Synchronize_topic_data'] = 'מסנקרן נושאים';
$lang['Synchronizing_topics'] = 'מעדכן נושאים';
$lang['Synchronizing_topic'] = 'מעדכן נושא %d (%s)';
$lang['Synchronize_moved_topic_data'] = 'מסנקרן נושאים שהועברו';
$lang['Inconsistencies_found'] = 'אי עקביות בבסיס הנתונים נמצאה. אנא %sבדוק את טבלאות ההודעות והנושאים%s';
$lang['Synchronizing_moved_topics'] = 'מעדכן נושאים שהועברו';
$lang['Synchronizing_moved_topic'] = 'מעדכן נושא שהועבר %d -&gt; %d (%s)';
$lang['Synchronize_forum_topic_data'] = 'מסנקרן נתוני נושא של פורומים';
$lang['Synchronizing_forums'] = 'מעדכן פורומים';
$lang['Synchronizing_forum'] = 'מעדכן פורום %d (%s)';
$lang['Synchronize_forum_data_wo_topic'] = 'מסנקרן פורומים ללא נושא';
$lang['Synchronize_forum_post_data'] = 'מסנקרן נתוני הודעה של פורומים';
$lang['Synchronize_forum_data_wo_post'] = 'מסנקרן פורומים ללא הודעה';
// synchronize_user
$lang['Synchronize_post_counters'] = 'מסנקרן מוני הודעות';
$lang['Synchronize_user_post_counter'] = 'מסנקרן מונה הודעות של משתמשים';
$lang['Synchronizing_user_counter'] = 'מעדכן משתמש %s (%d): %d -&gt; %d';
// synchronize_mod_state
$lang['Synchronize_moderators'] = 'מסנקרן מצב מנהל בטבלת המשתמשים';
$lang['Getting_moderators'] = 'מקבל מנהלים';
$lang['Checking_non_moderators'] = 'בודק משתמשים עם מצב מנהל שלא מנהלים אף פורום';
$lang['Updating_mod_state'] = 'מעדכן מצב מנהל של משתמשים';
$lang['Changing_moderator_status'] = 'מעדכן מצב מנהל של משתמש %s (%d)';
$lang['Checking_moderators'] = 'בודק משתמשים ללא מצב מנהל שמנהלים פורום';
// reset_date
$lang['Resetting_future_post_dates'] = 'מאפס תאריכי הודעה אחרונה בעתיד';
$lang['Checking_post_dates'] = 'בודק נתוני הודעות';
$lang['Checking_pm_dates'] = 'בודק נתוני הודעות פרטיות';
$lang['Checking_email_dates'] = 'בודק נתוני דואר אלקטרוני אחרון';
// reset_sessions
$lang['Resetting_sessions'] = 'מאפס עונות';
$lang['Deleting_session_tables'] = 'מרוקן עונה וטבלת תוצאות חיפוש';
$lang['Restoring_session'] = 'משחזר עונה ומפעיל משתמש';
// check_db
$lang['Checking_db'] = 'בודק בסיס נתונים';
$lang['Checking_tables'] = 'בודק טבלאות';
$lang['Table_OK'] = 'מאושר';
$lang['Table_HEAP_info'] = 'פקודה לא זמינה לטבלאות HEAP';
// repair_db
$lang['Repairing_db'] = 'מתקן בסיס נתונים';
$lang['Repairing_tables'] = 'מתקן טבלאות';
// optimize_db
$lang['Optimizing_db'] = 'מיעל בסיס נתונים';
$lang['Optimizing_tables'] = 'מיעל טבלאות';
$lang['Optimization_statistic'] = 'מיעל גודל מוקטן של טבלאות מ-%s עד %s. זו הקטנה של %s או %01.2f%%.';
// reset_auto_increment
$lang['Reset_ai'] = 'מאפס ערכים מוגדלים אוטומטית';
$lang['Ai_message_update_table'] = 'הטבלה עודכנה';
$lang['Ai_message_no_update'] = 'אין עדכון הכרחי';
$lang['Ai_message_update_table_old_mysql'] = 'הטבלה עודכנה'; // Used if an old version of MySQL is used which does not allow a table check before updating the table
// heap_convert
$lang['Converting_heap'] = 'הופך טבלת עונה ל-HEAP';
// unlock_db
$lang['Unlocking_db'] = 'משחרר נעילה לבסיס הנתונים';

// Emergency Recovery Console
$lang['Forum_Home'] = 'עמוד הבית של הפורום';
$lang['ERC'] = 'מסוף בקרה השבת חירום';
$lang['Submit_text'] = 'שלח';
$lang['Select_Language'] = 'בחר שפה';
$lang['No_selectable_language'] = 'לא נבחרה שפה';
$lang['Select_Option'] = 'בחר אפשרות';
$lang['Option_Help'] = 'לחיצות של האפשרות';
$lang['Authenticate_methods'] = 'ישנם שני דרכים לאמת';
$lang['Authenticate_methods_help_text'] = 'אתה צריך לאמת כדי לעשות כל שינויים בהגדרות המערכת. ישנם שני דרכים לעשות זאת:
	ראשונה, אתה יכול לאמת על-ידי הקלדת שם וסיסמא של כל חשבון מנהל ראשי פעיל של הפורום (שיטה מועדפת). שנייה, אתה יכול
	לאמת על-ידי הקלדת השם משתמש והסיסמא של חשבון בסיס הנתונים שאליה המערכת ניגשת.';
$lang['Authenticate_user_only'] = 'אתה צריך לאמת עם חשבון מנהל ראשי פעיל';
$lang['Authenticate_user_only_help_text'] = 'אתה צריך לאמת כדי לעשות כל שינויים בהגדרות המערכת. אתה יכול לאמת רק על-ידי
	הקלדת שם משתמש וסיסמא של חשבון מנהל ראשי פעיל של הפורום.';
$lang['Admin_Account'] = 'חשבון מנהל ראשי של פורום';
$lang['Database_Login'] = 'משתמש בסיס נתונים';
$lang['Username'] = 'שם משתמש';
$lang['Password'] = 'סיסמא';
$lang['Auth_failed'] = 'האימות נכשל!';
$lang['Return_ERC'] = 'חזור למוסף בקרה השבת חירום';
$lang['cur_setting'] = 'הגדרה נוכחית';
$lang['rec_setting'] = 'הגדרה מומלצת';
$lang['secure'] = 'מאובטח';
$lang['secure_yes'] = 'כן (https)';
$lang['secure_no'] = 'לא (http)';
$lang['domain'] = 'מתחם';
$lang['port'] = 'יציאה';
$lang['path'] = 'נתיב';
$lang['Cookie_domain'] = 'מתחם עוגייה';
$lang['Cookie_name'] = 'שם עוגייה';
$lang['Cookie_path'] = 'נתיב עוגייה';
$lang['select_language'] = 'בחר שפה חדשה';
$lang['select_theme'] = 'בחר ערכה חדשה';
$lang['reset_thmeme'] = 'צור מחדש ערכה ברירת מחדל';
$lang['new_admin_user'] = 'משתמש כדי לאפשר גישות מנהל ראשי';
$lang['dbms'] = 'סוג בסיס נתונים';
$lang['DB_Host'] = 'שם שרת בסיס הנתונים / DSN';
$lang['DB_Name'] = 'שם בסיס הנתונים שלך';
$lang['DB_Username'] = 'שם משתמש לבסיס הנתונים';
$lang['DB_Password'] = 'סיסמא לבסיס הנתונים';
$lang['Table_Prefix'] = 'תחילית לטבלאות בבסיס הנתונים';
$lang['New_config_php'] = "זהו קובץ config.$phpEx החדש שלך";
// Options
$lang['cls'] = 'נקה את כל העונות';
$lang['rdb'] = 'תקן טבלאות בסיס נתונים';
$lang['rpd'] = 'אפס נתוני נתיב';
$lang['rcd'] = 'אפס נתוני עוגייה';
$lang['rld'] = 'אפס נתוני שפה';
$lang['rtd'] = 'אפס נתוני ערכה';
$lang['dgc'] = 'כבה דחיסת GZip';
$lang['cbl'] = 'נקה רשימת חסומים';
$lang['raa'] = 'הסר את כל המנהלים הראשיים';
$lang['mua'] = 'אפשר למשתמש גישות מנהל ראשי';
$lang['rcp'] = 'צור מחדש את config.php';
// Info for options
$lang['cls_info'] = 'בזמן ביצוע כל העונות ינוקו.';
$lang['rdb_info'] = 'בזמן ביצוע כל הטבלאות של בסיס הנתונים יתוקנו.';
$lang['rpd_info'] = 'בזמן ביצוע כל נתוני ההגדרות יעודכנו אם ההגדרה המומלצת נבחרה.';
$lang['rcd_info'] = 'בזמן ביצוע נתוני העוגייה יעודכנו. האפשרות אם לקבוע עוגייה מאובטחת או לא יכולה להמצא תחת \'אפס נתוני נתיב\'.';
$lang['rld_info'] = 'בזמן ביצוע השפה הנבחרה תשומש גם למערכת וגם למשתמש המשומש כדי לאמת.';
$lang['rtd_info'] = 'בזמן ביצוע העיצוב הנבחר ישומש גם למערכת וגם למשתמש המשומש כדי לאמת אם הערכה הברירת המחדל
	(subSilver) תיווצר מחדש ותשומש למערכת ולמשתמש.';
$lang['rtd_info_no_theme'] = 'בזמן ביצוע ערכה ברירת המחדל (subSilver) תיווצר מחדש ותשומש גם למערכת וגם למשתמש המשומש כדי לאמת.';
$lang['dgc_info'] = 'בזמן ביצוע דחיסת ה-GZip תכובה.';
$lang['cbl_info'] = 'בזמן ביצוע גם רשימת החסומים וגם רשימת המשתמשים הבלתי מורשים ינוקו.';
$lang['raa_info'] = 'בזמן ביצוע כל המנהלים הראשיים יקבעו למשתמשים רגילים. אם אתה משתמש בחשבון מנהל ראשי כדי לאמת, החשבון המשומש
	לאימות ישמור את רמת המנהל הראשי שלו.';
$lang['mua_info'] = 'בזמן ביצוע המשתמש הנבחר יקבל גישות מנהל ראשי. המשתמש גם יופעל.';
$lang['rcp_info'] = 'בזמן ביצוע config.php חדש יווצר עם הנתונים שהוקלדו.';
// Success messages for options
$lang['cls_success'] = 'כל העונות נוקו בהצלחה.';
$lang['rdb_success'] = 'הטבלאות של בסיס הנתונים תוקנו.';
$lang['rpd_success'] = 'הגדרות המערכת עודכנו בהצלחה.';
$lang['rcd_success'] = 'נתוני העוגייה עודכנו בהצלחה.';
$lang['rld_success'] = 'נתוני השפה עודכנו בהצלחה.';
$lang['rld_failed'] = "קבצי השפה הנדרשים (lang_main.$phpEx ו- lang_admin.$phpEx) לא קיימים.";
$lang['rtd_restore_success'] = 'עיצוב ברירת המחדל שוחזר בהצלחה.';
$lang['rtd_success'] = 'נתוני העיצוב עודכנו בהצלחה.';
$lang['dgc_success'] = 'דחיסת ה-GZip נכבתה בהצלחה.';
$lang['cbl_success'] = 'רשימת החסומים והמשתמשים הבלתי מורשים נוקו בהצלחה.';
$lang['cbl_success_anonymous'] = 'רשימת החסומים והמשתמשים הבלתי מורשים נוקו בהצלחה. החשבון האלמוני
	נוצר מחדש. בגלל שנתוני הקבוצה של החשבון האלמוני יכולים להיות שגויים, זה מומלץ להשתמש בפונקצייה
	&quot;בדוק טבלאות משתמשים וקבוצות&quot; בחלק הראשי של תחזוקת בסיס הנתונים.';
$lang['raa_success'] = 'כל המנהלים הראשיים הוסרו בהצלחה.';
$lang['mua_success'] = 'למשתמש הנבחר יש עכשיו גישות מנהל ראשי.';
$lang['mua_failed'] = '<b>שגיאה:</b> המשתמש הנבחר לא קיים או שיש לו כבר גישות מנהל ראשי.';
$lang['rcp_success'] = "העתק את הטקסט לקובץ טקסט, שנה את שמו ל- <b>config.$phpEx</b> והעלה אותו לתיקייה הראשית של הפורום. אנא
	וודא שאין תו (כולל רווחים ושורות עודפות) לפני <b>&lt;?php</b> ואחרי <b>?&gt;</b>.<br />
	אתה יכול גם %sלהוריד%s את הקובץ למחשב שלך.";
// Text for success messages
$lang['Removing_admins'] = 'מסיר מנהלים ראשיים';
// Help Text
$lang['Option_Help_Text'] = '<p>אם אתה מקבל דווח שהייתה שגיאה ביצירת עונה, אתה יכול לנקות את נתוני העונה על-ידי
	בחירת <b>נקה את כל העונות</b>. אם יש לך בעיות עם גישה לטבלאות בסיס הנתונים, אתה יכול לתקן את הטבלאות על-ידי בחירת
	<b>תקן טבלאות בסיס נתונים</b>.</p>
	<p>אם אתה לא רשאי להתחבר או להיכנס ללוח הניהול הראשי, יכולה להיות טעות בנתיב שלך או בהגדרות העוגייה שלך. אתה יכול
	לאפס אותם עם <b>אפס נתוני נתיב</b> או <b>אפס נתוני עוגייה</b>. אתה יכול לאפס גם את הגדרות השפה על-ידי בחירת <b>אפס נתוני
	שפה</b> או נתוני ערכה עם <b>אפס נתוני ערכה</b>.</p>
	<p>אם ישנן בעיות לאחר הפעלת דחיסת ה-GZip, אתה יכול להפסיק אותו על-ידי בחירת <b>כבה דחיסת GZip</b>.</p>
	<p>אם איבדת את הסיסמא לחשבון שלך אתה יכול לאפשר למשתמש גישות מנהל ראשי על-ידי בחירת <b>אפשר למשתמש גישות מנהל ראשי</b>.
	הפעולה גם תפעיל את המשתמש כך שתוכל להשתמש במשתמש שפשוט נוצר קודם לכן. אם אתה לא רשאי להוסיף משתמש חדש, את יכול לנקות את
	רשימת החסומים עם <b>נקה רשימת חסומים</b> (הפעולה תשחזר גם את המשתמש האלמוני).</p>
	<p>אם המערכת שלך נפרצה, זה מומלץ שאתה תסיר את כל חשבונות המנהלים הראשיים על-ידי בחירת <b>הסר את כל המנהלים הראשיים</b>. (החשבון עצמו לא ימחק אבל הגישות כן יוסרו.)</p>
	<p>אם אתה צריך לשחזר את config.php שלך אתה יכול לעשות זאת על-ידי בחירת <b>צור מחדש את config.php</b>.</p>';
?>
