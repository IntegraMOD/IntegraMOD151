<?php
/***************************************************************************
 *                        lang_install.php [Hebrew]
 *                            -------------------
 *   begin                : Saturday, July 10, 2004
 *   copyright            : (C) 2004 masterdavid - Ronald John David
 *   website              : http://www.integramod.com
 *   email                : webmaster@integramod.com
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

//
// Install Process
//
$lang['Welcome_install'] = 'ברוך הבא להתקנה של IntegraMOD151';
$lang['Initial_config'] = 'הגדרות בסיסיות';
$lang['DB_config'] = 'הגדרות בסיס הנתונים';
$lang['Admin_config'] = 'הגדרות מנהל ראשי';
$lang['continue_upgrade'] = 'כאשר הורדת את קובץ ההגדרות שלך למחשב המקומי שלך אתה יכול ללחוץ על הכפתור \'המשך לשדרג\' מתחת כדי לעבור קדימה עם עיבוד השדרוג.  אנא המתן בזמן העלאת קובץ ההגדרות עד שעיבוד השידרוג יושלם.';
$lang['upgrade_submit'] = 'המשך לשדרג';

$lang['Installer_Error'] = 'שדיאה התרחשה במשך ההתקנה';
$lang['Previous_Install'] = 'התקנה קודמת נמצאה';
$lang['Install_db_error'] = 'התרחשה שגיאה בנסיון לעדכן את בסיס הנתונים';

$lang['Re_install'] = 'ההתקנה הקודמת שלך עדיין פעילה.<br /><br />אם תרצה להתקין מחדש את phpBB 2 אתה צריך ללחוץ על הכפתור כן מתחת. תהיה מודע לך שדבר זה יהרוס את כל הנתונים הקיימים ולא יווצרו גיבויים! שם המשתמש והסיסמא של המנהל הראשי שאתה משתמש בהם כדי להתחבר לפורום יווצרו מחדש לאחר ההתקנה מחדש ואין הגדרות אחרות שיישמרו.<br /><br />חשוב בזהירות ולחץ על כן!';

$lang['Inst_Step_0'] = 'תודה שבחרת ב-phpBB 2. כדי להשלים התקנה זו אנא מלא את כל הפרטים הנדרשים מתחת. שים לב שבסיס הנתונים שאתה מתקין לתוכו צריך להיות כבר קיים. אם אתה מתקין עם בסיס נתונים שמשתמש ב-ODBC, כמו MS Access אתה צריך ראשית ליצור DSN בשבילו לפני שתמשיך.';

$lang['Start_Install'] = 'התחל התקנה';
$lang['Finish_Install'] = 'סיים התקנה';

$lang['Default_lang'] = 'שפת ברירת המחדל של המערכת';
$lang['DB_Host'] = 'שם שרת בסיס הנתונים / DSN';
$lang['DB_Name'] = 'שם בסיס הנתונים שלך';
$lang['DB_Username'] = 'שם משתמש לבסיס הנתונים';
$lang['DB_Password'] = 'סיסמא לבסיס הנתונים';
$lang['Database'] = 'בסיס הנתונים שלך';
$lang['Install_lang'] = 'בחר שפה להתקנה';
$lang['dbms'] = 'סוג בסיס התנונים';
$lang['Table_Prefix'] = 'תחילית לטבלאות בבסיס הנתונים';
$lang['Admin_Username'] = 'שם המשתמש של המנהל הראשי';
$lang['Admin_Password'] = 'הסיסמא של המנהל הראשי';
$lang['Admin_Password_confirm'] = 'הסיסמא של המנהל הראשי [ אישור ]';

$lang['Inst_Step_2'] = 'שם המשתמש של המנהל הראשי נוצר.  בנקודה זו ההתקנה הבסיסית הושלמה. אתה תועבר עכשיו לעמוד שיאפשר לך לנהל את הפורום החדש שלך. וודא את הפרטים בהגדרות הכלליות וודא שכל השינויים נדרשים. תודה שבחרת ב-phpBB 2.';

$lang['Unwriteable_config'] = 'קובץ ההגדרות שלך בלתי ניתן לכתיבה כרגע. עותק של קובץ ההגדרות יורד למחשב שלך כאשר תלחץ על הכפתור מתחת. אתה צריך להעלות קובץ זה לאותה תיקייה כ-phpBB 2. כאשר הדבר יסתיים אתה צריך להתחבר בעזרת השם והסיסמא של המנהל הראשי שאתה סיפקת בטופס הקודם ובקר במרכז לוח הניהול (קישור יופיע בתחתית כל מסך ברגע שתתחבר) ובדוק את ההגדרות הכלליות. תודה שבחרת ב-phpBB 2.';
$lang['Download_config'] = 'הורד הגדרות';

$lang['ftp_choose'] = 'בחר שיטת הורדה';
$lang['ftp_option'] = '<br />בגלל שסיומות FTP פעילות בגרסה זו של PHP אתה יכול גם לקבל את האפשרות להעלות את קובץ ההגדרות בנסיון דרך ה-FTP אוטומטית.';
$lang['ftp_instructs'] = 'בחרת להעלות את הקובץ דרך FTP לחשבון המכיל את phpBB 2 אוטומטית.  אנא הקלד את הפרטים למטה כדי להקל על תהליך זה. שים לב שנתיב ה-FTP צריך להיות הנתיב המדויק דרך ה-FTP להתקנת phpBB2 שלך כאילו שאתה מעלה דרך ה-FTP את הקובץ כמו כל לקוח רגיל.';
$lang['ftp_info'] = 'הקלד את פרטי ה-FTP שלך';
$lang['Attempt_ftp'] = 'נסה להעלות דרך ה-FTP את קובץ ההגדרות למקומו';
$lang['Send_file'] = 'שלח את הקובץ אלי ואני אעלה אותו דרך ה-FTP בעצמי';
$lang['ftp_path'] = 'נתיב FTP ל-phpBB 2';
$lang['ftp_username'] = 'שם המשתמש של ה-FTP שלך';
$lang['ftp_password'] = 'הסיסמא של ה-FTP שלך';
$lang['Transfer_config'] = 'התחל העברה';
$lang['NoFTP_config'] = 'הנסיון להעלות את קובץ ההגדרות למקומו נכשל.  אנא הורד את קובץ ההגדרות והעלה אותו למקומו בהצלחה.';

$lang['Install'] = 'התקנה';
$lang['Upgrade'] = 'שדרוג';


$lang['Install_Method'] = 'בחר את שיטת ההתקנה שלך';

$lang['Install_No_Ext'] = 'הגדרות ה-PHP בשרת שלך לא תומכות בסוג בסיס הנתונים שבחרת';

$lang['Install_No_PCRE'] = 'phpBB2 דורש את מודול הביטויים הרגילים המותאמים ל-Perl ל-PHP כאשר הגדרות ה-PHP לא תומכות בכך!';

$lang['Install_No_File_Open'] = 'לא ניתן לפתוח את הקובץ %s בגלל שהגדרות האבטחה אינן מספיקות. אנא בדוק את הוראות ההרשאות במדריך ההתקנה.';

$lang['Go_to_prillian'] = 'מחקתי את התיקייה install... בוא נתקין את Prillian עכשיו...';
$lang['Go_to_profile'] = 'I deleted the install and prill_install directories... Let\'s complete the remaining registration details for my account...';

$lang['Extra_procedures'] = '<tr><th>מוצרי Integramodheb נוספים</center></th></tr><tr><td><p>
	במידע לסיום כמה של המוצרים הנוספים הדרושים להתקנה של Integramodheb רשומים להלן. <ul>
	<li>אנא מחק את התיקייה install עכשיו, כדי למנוע מהצגת הודעת השגיאה לאחר לחיצה על סיום ההתקנה</li>
	%s
	</ul>
	אם יש לך שאלות אנא שאל אותן ב <a href="http://www.integramodheb.com">integramodheb.com.</a></p></td></tr>';
$lang['Extra_procedures_no_prillian'] = '<li>Please also delete the prill_install folder as you don\'t want to install it.</li>'; // comes inside 'Extra_procedures'
$lang['Admin_config_settings'] = 'הגדרות אבטחת phpBB</th>';
$lang['Admin_config_name'] = 'בחר שם הגדרות מנהל ראשי. הוא יכול להיות כל דבר. נסה לשמור אותו על מקסימום 1 או 2 מילים
				למשל. <b>admins_allowed</b>. אני לא הייתי ממליץ להשתמש בזה, אבל קיבלת את הרעיון.';
$lang['Mod_config_name'] = 'בחר שם הגדרות מנהל. הוא יכול להיות כל דבר. נסה לשמור אותו על מקסימום 1 או 2 מילים
				למשל. <b>mods_allowed</b>. אני לא הייתי ממליץ להשתמש בזה, אבל קיבלת את הרעיון.';
$lang['Unwanted_config_name'] = 'בחר שם הגדרות כיבוי. הוא יכול להיות כל דבר. נסה לשמור אותו על מקסימום 1 או 2 מילים
				למשל. <b>block_unwanted</b>. אני לא הייתי ממליץ להשתמש בזה, אבל קיבלת את הרעיון.';
$lang['No_prillian_wanted'] = 'Check this box if you <strong>don\'t</strong> want to install the prillian.';
$lang['Install_options'] = 'Install Options';
?>