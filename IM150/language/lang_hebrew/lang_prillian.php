<?php
/***************************************************************************
 *                          lang_prillian.php [English]
 *                            -------------------
 *   begin                : Friday, Jan 31, 2003
 *   version              : 0.7.0
 *   date                 : 2003/12/23 23:21
 ***************************************************************************/

//
// CONTRIBUTORS:
//	 Add your details here if wanted, e.g. Name, username, email address, website
//

//
// The format of this file is ---> $lang['message'] = 'text';
// The file will be included separately of other language files as needed, but must
// be included after lang_main.php and/or lang_admin.php
//
//
// This is optional, if you would like a _SHORT_ message output
// along with the phpBB copyright message indicating you are the translator
// please add it here.
$lang['TRANSLATION_INFO'] = '';

// Do not change the next six lines.
// Avoid including the file more than once.
if ( defined('IN_PRILLIAN_LANG') )
{
	return;
}
define('IN_PRILLIAN_LANG', true);

// You may want to edit the following lines to match your website.
$lang['Launch_Prillian'] = 'הפעל את Prillian';  // Link for opening the IM Client
$lang['Prillian_FAQ'] = 'הודעות מיידיות';   // Title of the IM FAQ
$lang['Prillian'] = 'Prillian';  // Name of Prillian, used throughout the scripts

$lang['New_ims'] = 'יש לך %d הודעות מיידיות חדשות'; // You have 2 new IMs
$lang['New_im'] = 'יש לך הודעה מיידית חדשה'; // You have 1 new IM
$lang['Unread_ims'] = 'יש לך %d הודעות מיידיות שלא נקראו'; // You have 2 new IMs
$lang['Unread_im'] = 'יש לך הודעה מיידית שלא נקראה'; // You have 1 new IM

// Main IM Client/Who's Online window
$lang['Users_Online'] = 'משתמשים מחוברים';
$lang['Buddies_Online'] = 'חברים מחוברים';
$lang['Hidden_Users_Online'] = 'משתמשים מוסתרים מחוברים';
$lang['Guests_Online'] = 'אורחים מחוברים';
$lang['Close_windows'] = 'סגור חלונות';
$lang['Send_im'] = 'שלח הודעה מיידית';
$lang['IM'] = 'הודעה מיידית';
$lang['PM'] = 'הודעה פרטית';
$lang['New_messages'] = 'הודעות חדשות ושלא נקראו';


// Controls panels
$lang['Controls'] = 'בקרות';
$lang['Check_IMs'] = 'בדוק להודעות מיידיות';
$lang['Message_Log'] = 'יומן הודעות';
$lang['Alt_Message_Log'] = 'פתח יומן הודעות';
$lang['Alt_New_Messages'] = 'בדוק להודעות חדשות';
$lang['Alt_Home'] = 'חזור לפורומים';
$lang['Alt_Close_Windows'] = 'סגור את כל החלונות הפתוחים';
$lang['Alt_Prefs'] = 'ערוך העדפות ' . $lang['Prillian'];
$lang['Alt_Logout'] = 'התנתק לפורומים ו- ' . $lang['Prillian'];
$lang['Prillian_Help'] = 'עזרה';


// Sending/replying
$lang['phpBB_IM_default_subject'] = $lang['Message'];
$lang['Send_new_im'] = 'שלח הודעה מיידית חדשה';
$lang['Select_emoticon'] = 'בחר סמיילים';
$lang['Save_reply_pm'] = 'שמור והגב';
$lang['Save_close_pm'] = 'שמור וסגור';
$lang['Delete_reply_pm'] = 'מחק והגב';
$lang['Delete_close_pm'] = 'מחק וסגור';
$lang['IM_Quick_reply'] = 'תגובה מהירה';


// Error messages
$lang['Close_window_link'] = '<br /><br /><a href="javascript:window.close();">' . $lang['Close_window'] . '</a>';
$lang['IM_disabled'] = 'סליחה, אבל ההודעות המיידיות כבויות המערכת זו.';
$lang['Ims_not_allowed'] = 'סליחה, אבל ההודעות המיידיות כבויות לחשבון משתמש זה.';
$lang['Ims_not_allowed_fail'] = 'לא ניתן לבדוק אם ההודעות המיידיות כבויות לאותו משתמש.';
$lang['Cannot_send_im'] = 'סליחה, אבל ההודעות המיידיות כבויות בחשבון שלך. אם כיבית את ההודעות המיידיות, אתה יכול להפעיל אותם ב %sהעדפות%s שלך.';
$lang['Cannot_send_im_admin'] = 'סליחה, אבל ההודעות המיידיות כבויות בחשבון שלך על-ידי המנהל הראשי.';
$lang['Please_set_im_prefs'] = 'עדיין לא קבעת את העדפות ההודעות המיידיות שלך. קח כמה רגעים כדי לעשות זאת %sכאן%s.';
$lang['Admin_override'] = 'סליחה, אבל המנהל הראשי של המערכת קבע אותה שתעבור על העדפות המשתמשים עם העדפות מערכת גלובאליות. אתה לא יכול לשנות את ההעדפות שלך בזמן שההגדרות הגלובאליות בפעולה.';
$lang['Too_many_ims'] = 'סליחה, אבל לאותו משתמש ישנם יותר מדי הודעות מיידיות הממתינות לו. נסה שוב מאוחר יותר.';
$lang['No_autoclose'] = 'אם אתה רואה הודעה זו, אז מאפיין סגירת החלון אוטומטית של ' . $lang['Prillian'] . ' לא עובד עם הדפדפן שלך. סיבות אפשרויות יכולות להיות שה-JavaScript של הדפדפן שלך כבוי. אנא סגור חלון זה.';
$lang['User_no_im'] = 'אתה לא יכול לשלוח הודעה מיידית לאותו משתמש. ';
$lang['No_im_reply_info'] = 'לא ניתן לקבל את פרטי ההודעה. זה כנראה אומר שההודעה כבר נמחקה אוטומטית.';
$lang['No_Admins_Found'] = 'לא ניתן למצוא את המנהלים הראשיים של המערכת בבסיס הנתונים.';
$lang['No_post_type'] = 'לא ניתן לקבוע את סוג ההודעה.';
$lang['Admin_no_user_from'] = 'לא ניתן לקבוע איזה מוען לאתר.';
$lang['Admin_no_user_to'] = 'לא ניתן לקבוע איזה נמען לאתר.';


// Site to Site
$lang['IM_no_users_online'] = 'אין משתמשים מחוברים.';
$lang['Online_at'] = 'משתמשים מחוברים ב ';
$lang['User_from'] = 'משתמש מ ';


// Admin Site to Site
$lang['URL'] = 'כתובת';
$lang['Extension'] = 'סיומת הקובץ';
$lang['Profile_path'] = 'נתיב לפרופיל';
$lang['Extension_explain'] = 'ישנו "php" על-ידי ברירת מחדל';
$lang['Profile_path_explain'] = 'ישנו "פרופיל" על ידי ברירת מחדל';


// Preferences editor
$lang['Prillian_Profile_updated'] = 'ההעדפות שלך עודכנו בהצלחה.<br /><br />אם נדרש, לחץ %sכאן%s כדי לטעון מחדש את לקוח ההודעות המיידיות.';

$lang['User_allow_ims'] = 'הפעל מערכת הודעות מיידיות לחשבון זה';
$lang['User_allow_shout'] = 'אפשר להשתמש בתיבת הצעקות';
$lang['User_allow_chat'] = 'אפשר להשתמש בתיבת הצ\'אט';
$lang['Always_add_sig_explain'] = 'את החתימות ניתן לשנות בפרופיל שלך';
$lang['Refresh_rate'] = 'קצב רענון חלון ראשי';
$lang['Refresh_rate_explain1'] = 'מספר שניות בין רענונים בלקוח ההודעות המיידיות.';
$lang['Refresh_rate_explain2'] = 'זמן בין רענונים בלקוח ההודעות המיידיות.';
$lang['Success_close'] = 'סגור חלונות הודעה אוטומטית לאחר שליחת הודעה';
$lang['Refresh_method'] = 'בחר שיטת רענון לקוח הודעות מיידיות';
$lang['Refresh_method_explain'] = 'בעזרת שניהם מומלץ';
$lang['JavaScript'] = 'JavaScript';
$lang['META_tag'] = 'תג META'; 
$lang['Use_both_methods'] = 'השתמש בשניהם';
$lang['IM_auto_launch_pref'] = 'הפעל לקוח בזמן שאתה מבקר באינדקס הפורום'; 
$lang['IM_auto_popup'] = 'פתח אוטומטית הודעות חדשות';
$lang['IM_list_new'] = 'רשימת הודעות חדשות ולא נקראו בחלון הראשי';
$lang['Show_controls'] = 'הראה לוח בקרות';

// Do not change the [0], [1], etc. parts of the following
$lang['Controls_select'][0] = 'לא להראות';
$lang['Controls_select'][1] = 'כתמונות בלבד';
$lang['Controls_select'][2] = 'כקישורים בלבד';
$lang['Controls_select'][3] = 'שניהם';
$lang['Who_to_list'] = 'רשימת אותם המשתמשים בחלון הראשי';
$lang['Online_Lists'][1] = 'כל המשתמשים המחוברים';
$lang['Online_Lists'][2] = 'חברים בפורומים';
$lang['Online_Lists'][3] = 'חברים בהודעות מיידיות';
$lang['Online_Lists'][4] = 'כל המשתמשים בהודעות מיידיות';

// Include any options you want in the refresh rate drop down list here
// They should be in this format:
// $lang['Refresh_times']['number of seconds'] = 'name in list';
// The number of seconds can be no longer than 5 digits, unless you alter
// the im_prefs database table.
$lang['Refresh_times'][60] = 'דקה';
$lang['Refresh_times'][120] = '2 דקות';
$lang['Refresh_times'][180] = '3 דקות';
$lang['Refresh_times'][240] = '4 דקות';
$lang['Refresh_times'][300] = '5 דקות';

$lang['IM_play_sound'] = 'השמע צליל בהודעות חדשות';
$lang['Default_sound'] = 'השתמש בצליל ברירת המחדל של המערכת';
$lang['Current_sound'] = 'קובץ שמע נוכחי';
$lang['IM_style'] = 'עיצוב בשימוש על-ידי ' . $lang['Prillian'];
$lang['Width'] = 'רוחב';
$lang['Height'] = 'גובה';
$lang['Read_Message'] = 'קרא הודעה';
$lang['Send_Message'] = 'שלח הודעה';
$lang['Set_window_sizes'] = 'קבע גדלי חלון';
$lang['Set_window_sizes_explain'] = 'כל הגדלים בפיקסלים';
$lang['Open_pms'] = 'פתח ו/או רשימת הודעות פרטיות';
$lang['Auto_delete_ims'] = 'הפעל מחיקה אוטומטית של הודעות מיידיות שנקראו ברענון של לקוח הודעות מיידיות';

// Admin preferences editor
$lang['Admin_allow_ims'] = 'אפשר למשתמש לשלוח ולקבל הודעות מיידיות';
$lang['Admin_allow_shout'] = 'אפשר למשתמש להשתמש בתיבת הצעקות';
$lang['Admin_allow_chat'] = 'אפשר למשתמש להשתמש בתיבת הצ\'אט';
$lang['IM_user_auto_launch'] = 'הפעל לקוח אוטומטית בזמן ביקורי המשתמש באינדקס הפורום והתחברות';
$lang['Admin_user_added'] = 'המשתמש נוסף להעדפות בסיס הנתונים.';
$lang['Admin_Set_window_sizes'] = 'קבע גדלי חלון ברירת מחדל';


// Admin Configuration
$lang['IM_auto_launch'] = 'הפעל לקוח אוטומטית בזמן התחברות וביקורי משתמש באינדקס הפורום'; 
$lang['IM_box_limit'] = 'הודעות מיידיות מירביות שלא נקראו';
$lang['IM_enable_flood'] = 'הפעל בקרת הצפה';
$lang['IM_override_settings'] = 'עבור על הגדרות המשתמש';
$lang['IM_override_settings_explain'] = 'הגדרה זו עוברת על העדפות המשתמש ומשתמש בברירות המחדל של המערכת הנקבעות באפשרויות כאן';
$lang['IM_enable_ims'] = 'הפעל מערכת הודעות מיידיות';
$lang['IM_enable_shoutbox'] = 'הפעל תיבת הצעקות';
$lang['IM_enable_chatbox'] = 'הפעל תיבת צ\'אט';
$lang['IM_refresh_drop'] = 'השתמש ברשימה נגללת להעדפת קצב הרענון של המשתמש';
$lang['IM_sound_name'] = 'מיקום קובץ השמע';
$lang['IM_allow_sound'] = 'אפשר למשתמשים להשמיע צליל בזמן קבלת הודעות חדשות';
$lang['IM_default_sound'] = 'אפשר למשתמשים להשמיע צליל משלהם';
$lang['IM_allow_different_style'] = 'אפשר ' . $lang['Prillian'] . ' שישתמש בעיצוב שונה מהעיצוב של שאר הפורום';
$lang['Prillian_Config'] = 'הגדרות כלליות של ' . $lang['Prillian'];
$lang['Prillian_Config_explain'] = 'הטופס הבא יאפשר לך לשנות את כל אפשרויות הדיבור הכלליות. הם בשימוש כדי להגדיר פעולות ברירת מחדל ואפשרויות משתמש. להגדרות משתמש יחידות, השתמש בקישורים המסופקים במסגרת האחרת.';
$lang['IM_session_length'] = 'אורך עונה בשניות של לקוח ההודעות המיידיות';
$lang['IM_session_length_explain'] = 'הגדרה זו בשימוש כדי לקבוע אם המשתמש פעיל בדיבור. זה מומלץ לקבוע ערך הגדול יותר מקצב הרענון.';
$lang['IM_enable_imbox_limit'] = 'הפעל את ההגבלה של הכמות של ההודעות המיידיות שלא נקראו';


// Message Log
$lang['Messages_Sent_by'] = 'הודעות שנשלחו על-ידי ';
$lang['Messages_Received_by'] = 'הודעות שהתקבלו על-ידי ';
$lang['Offsite_Messages_Sent_by'] = 'הודעות שנשלחו מחוץ לאתר על-ידי ';
$lang['Offsite_Messages_Received_by'] = 'הודעות שהתקבלו מחוץ לאתר על-ידי ';
$lang['Received'] = 'התקבלו';
$lang['Offsite_Received'] = 'התקבלו מחוץ לאתר';
$lang['Offsite_Sent'] = 'נשלחו מחוץ לאתר';
$lang['No_sent'] = 'אין הודעות מאוחסנות שנשלחו ממך.';
$lang['No_received'] = 'אין הודעות מאוחסנות שהתקבלו ממך.';
$lang['Message_Log_admin_explain'] = 'כאן אתה יכול לסקור את ההודעות המיידיות שנשלחו והתקבלו על-ידי המשתמשים שלך.';



/* Entries Added in 0.7.0 */
$lang['Prill_new_posts'] = 'הודעות מאז הביקור האחרון';
$lang['No_prill_config'] = 'לא ניתן לבדוק שאילתה לפרטי הגדרוצ Prillian';
$lang['No_prill_prefs'] = 'לא ניתן לבדוק שאילתה לטבלת ההעדפות של ההודעות המיידיות';
$lang['No_prill_userprefs'] = 'המשתמש לא נמצא בטבלת ההעדפות של ההודעות המיידיות';
$lang['Not_authed_im_delete'] = 'סליחה, אתה לא יכול למחוק הודעות ששלחת.';
$lang['Back_to_log'] = '%sחזור ליומן ההודעות%s';
$lang['Mini_Client_Window'] = 'מצב לקוח קטן';
$lang['Use_frames'] = 'השתמש במסגרות בלקוח ההודעות המיידיות';
$lang['Use_frames_explain'] = 'שימוש במסגרות מאיץ את הטעינה בזמן בדיקת הודעות חדשות.';
$lang['Use_frames_explain_admin'] = $lang['Use_frames_explain'] . ' זה יכול לשמוא על פס רחב ויוצא בטעינת שרת קטנה יותר.';
$lang['Default_mode'] = 'מצב לשימוש בזמן שלקוח ההודעות המיידיות מופעל';

// Do not change the [0], [1], etc. parts of the following
$lang['Default_mode_select'][0] = 'מצב אחרון בשימוש';
$lang['Default_mode_select'][1] = 'מצב ראשי';
$lang['Default_mode_select'][2] = 'מצב רחב';

//Be careful! Do not uncomment the next line!
//$lang['Default_mode_select'][3] = 'Mini Mode';
$lang['Size'] = 'גודל';
$lang['Color'] = 'צבע';
$lang['Enabled_explain'] = 'אם קבעת ללא, המשתמשים שלך לא יכולו לפעול עם אתר זה.';
$lang['Profile_path_ex_expanded'] = 'הקלד את הנתיב לקובץ profile.php שלך, יחסית לתיקייה הראשית של הפורומים. זה בשימוש למאפיין המחיקה אוטומטית של הודעות ברשת בזמן שהמנהלים הרא מנסים למחוק אוטומטית מהאתר שלך. לא לכלול את סיומת הקובץ, למשל, השתמש ב-"profile" במקום ב-"profile.php"';
$lang['Network_autodetect'] = 'גילוי אוטומטי של אתר חדש';
$lang['Network_autodetect_explain'] = 'הקלד את הכתובת של הפורום מתחת, ו-Prillian ינסה להתחבר ל-Prillian המותקן באותה כתובות. אם החיבור מצליח, Prillian ינסה להוסיף אוטומטית את אותו אתר לרשימת הרשת שלך.<br /><br />בזמן הקלדת הכתובת, וודא שהיא מתחילה עם http:// או ftp:// והסיום בקו נטוי. אין שמות קבצים להכלל. זו צורה נכונה:<br />http://darkmods.sourceforge.net/mb/<br /><br />אלו לא צורות נכונות:<br />darkmods.sourceforge.net/mb/<br />http://darkmods.sourceforge.net/<br />darkmods.sourceforge.net/mb<br />http://darkmods.sourceforge.net/mb/imclient.php<br />http://darkmods.sourceforge.net/mb/imclient.php/';
$lang['No_allow_url_fopen'] = 'הגדרות ה-PHP של allow_url_fopen מסומנים לכבויים. זה אומר שתסריטי ה-PHP לא יכולים להתחבר לאתרים רחוקים. כתוצאה מכך, אתה לא יכול להשתמש בדיבור ברשת. למידע על הפעלת אפשרות זו, דבר עם תומך און מנהל השרת שלך. אם אתה אותו אתם וצריך מידע נוסף, בדוק את <a href="http://www.php.net/manual" target="_blank">מדריך ה-PHP</a>, במיוחד בפרקי ההגדרות.<br /><br />בזמן שאתה רואה הודעה זו, אתה צריך לכבות את הדיבור בשרת בהגדרות ה-Prillian כדי להגדיל את מהירות ה-Prillian. אתה יכול להפעיל את הדיבור ברשת מאוחר יותר אם תרצה.';
$lang['ND_cannot_add'] = 'האתר בכתובת שהקלדת לא יכול להתווסף לרשת שלך.';
$lang['ND_no_connect'] = 'התסריט לא יכול להתחבר לאתר הרחוק בעזרת כתובת זו:';
$lang['ND_no_connect_explain'] = 'אנא וודא שהקלדת את הכתובת בצורה נכונה, ושהיא מתחילה עם http:// או ftp://. גם בדוק שהאתר פעיל. אם הוא לא, נסה שוב מאוחר יותר.<br /><br />אם הכתובת נכונה והאתר פעיל, הרכב הדיבור ברשת של Prillian לא מותקנת באותה כתובת. ' . $lang['ND_cannot_add'];
$lang['ND_disabled'] = 'הדיבור ברשת כבוי באתר הרחוק. ' . $lang['ND_cannot_add'];
$lang['ND_connected'] = 'התסריט התחבר לאתר הרחוק בהצלחה!';
$lang['ND_enabled'] = 'הדיבור ברשת פעיל באתר הרחוק.';
$lang['ND_version'] = 'גירסה שונה של Prillian מותקנת באתר הרחוק, אז יכולה להיות התנגשות בין הגרסה שלך והתסריט באתר הרחוק. אנו עדיין נמשיך עם גילוי אוטומטי בזמן זה.';
$lang['ND_060'] = 'התסריט גילה ש-Prillian 0.6.0 מותקן באתר הרחוק. Prillian 0.6.0 לא תומך בגילוי אוטומטי, והתסריט לא יכול להוסיף אתר זה לרשת שלך. אתה יכול להוסיף אותו ידנית, אם אתה רוצה. אתה יכול גם לעודד את המנהל הראשי של האתר הרחוק לשדרג לגרסה האחרונה של Prillian.';
$lang['ND_Unnamed_Site'] = 'האתר שהתגלה ללא שם';
$lang['ND_data_error'] = 'ישנם כמה בעיות עם נתוני הגילוי האוטומטי שדווחו על ידי האתר הרחוק, אז האתר יתווסף לרשת שלך במצב כבוי עם ערך אחד לפחות כברירת מחדל מוקלד. אתה צריך לסקור את המידע דרך עורך הדיבור ברשת מאוחר יותר. השגיאה יכולה להיות משהו פשוט כמו ששדה שם האתר ריק.';
$lang['ND_Added_Success'] = 'האתר נוסף בהצלחה לרשת שלך!';
$lang['Allow_mode_switch'] = 'אפשר למשתמשים לבחור מצבי לקוח הודעות מיידיות';

// These three will be used when there are images for the mode switches
//$lang['Alt_Main_Mode'] = 'Switch IM Client to Main Mode';
//$lang['Alt_Wide_Mode'] = 'Switch IM Client to Wide Mode';
//$lang['Alt_Mini_Mode'] = 'Switch IM Client to Mini Mode';
$lang['Alt_Main_Mode'] = 'מצב ראשי';
$lang['Alt_Wide_Mode'] = 'מצב רחב';
$lang['Alt_Mini_Mode'] = 'מצב קטן';
$lang[''] = '';
$lang[''] = '';
$lang[''] = '';
$lang[''] = '';

// Adapted from Enhanced Admin User Lookup
$lang['User_lookup_explain'] = 'אתה יכול לאתר משתמשים על-ידי ציון אחד או יותר של האפשרויות למטה. אין סימנים כוללים נדרשים, הם יתווספו אוטומטית.';
$lang['One_user_found'] = 'רק משתמש אחד נמצא, אתה נלקחת לאותו משתמש';
$lang['Click_goto_prefs'] = 'לחץ %sכאן%s כדי לערוך את העדפות המשתמש';
$lang['Click_goto_log'] = 'לחץ %sכאן%s כדי לצפות בהודעות המשתמש';
$lang['User_joined_explain'] = 'התחביר שבשימוש דומה לפונקציה של PHP <a href="http://www.php.net/strtotime" target="_other">strtotime()</a>';
$lang['Click_return_perms_admin'] = 'לחץ %sכאן%s כדי לחזור לבקרת גישות המשתמש';


/* Entries Changed in 0.7.0 */

// Controls panels
$lang['Alt_Contact_Man'] = 'נהל רשימות קשר'; // Was $lang['Alt_Buddy_Man']

// Preferences editor
$lang['Wide_Client_Window'] = 'מצב לקוח רחב'; // Was $lang['Whos_Online_Window']
$lang['Main_Window'] = 'מצב לקוח ראשי';

/* Any of these that have network in the $lang['name'] part used to have s2s in
 place of network. In some, that is the only change */
// Network Messaging
$lang['Network_disabled'] = 'סליחה, אבל הדיבור ברשת כבוי במערכת זו.';
$lang['Network_no_username'] = 'הדיבור ברשת לא קיבל את שם המשתמש או ה-id של המשתמש שלך.';
$lang['Network_no_siteurl'] = 'הדיבור ברשת לא קיבל את כתובת האתר של האתר שממנו אתה שולח את ההודעה.';
$lang['Network_no_siteid'] = 'הדיבור ברשת לא קיבל את ה-id של האתר שממנו אתה שולח את ההודעה.';
$lang['Network_Users_online'] = 'משתמשים מחוברים באתרים אחרים';
$lang['No_network_type'] = 'לא ניתן לקבוע סוג.';
$lang['Invalid_network_type'] = 'לא ניתן לקבוע סוג שריר.';
$lang['Network_not_in_db'] = 'סליחה, אבל האתר שלך שממנו אתה שולח את ההודעה שלך לא ברשימת האתרים המאושרים באתר שאליו אתה מנסה לשלוח את ההודעה.';
$lang['Send_a_new_network'] = 'שלח הודעת רשת חדשה';
$lang['Reply_to_a_network'] = 'הגב להודעת רשת';
$lang['Network_Flood_Error'] = 'הדיבור ברשת לא יכול לקבל את ההודעה בזמן קצר כל כך מאז האחרונה. נסה שוב בתוך זמן קצר.';

// Admin Network Messaging
$lang['Network_title'] = 'עורך הדיבור ברשת';
$lang['Network_explain'] = 'בעמוד זה, אתה יכול להוסיף, לערוך, ולהסיר את האתרים שהמשתמשים שלך יכולים לפעול דרך המאפיין של הדיבור ברשת של Prillian.';
$lang['Network_add'] = 'הוסף אתר חדש';
$lang['Network_del_success'] = 'האתר נמחק בהצלחה. המשתמשים שלך לא יכולים יותר לפעול עם אותו ה-Prillian של האתר.';
$lang['Click_return_network'] = 'לחץ %sכאן%s כדי לחזור לדיבור ברשת.';
$lang['Network_config'] = 'הגדרות האתר';
$lang['Network_add_success'] = 'פרטי האתר שונו בהצלחה.';

// Admin preferences editor
$lang['Admin_allow_network'] = 'אפשר למשתמש להשתמש בדיבור ברשת';

// Preferences editor
$lang['User_allow_network'] = 'הפעל דיבור ברשת לחשבון זה';
$lang['Network_user_list'] = 'בחר שיטה להצגת המשתמשים המחוברים באתרים האחרים';

// Do not change the [0], [1], etc. parts of the following
$lang['network_lists'][0] = 'לא להציג';
$lang['network_lists'][1] = 'הצג עם משתמשים באתר זה';
$lang['network_lists'][2] = 'הצג בנפרד ממשתמשים באתר זה';

// Admin Configuration
$lang['IM_allow_network'] = 'הפעל מערכת דיבור ברשת';
/* End of the s2s -> network changes */



/*
The following entries were removed in 0.7.0

$lang['PUU_Constant']
$lang['PPU_Constant']
$lang['PUU_Constant_explain']
$lang['PPU_Constant_explain']
*/
?>