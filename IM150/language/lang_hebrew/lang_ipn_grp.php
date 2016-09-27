<?php
/***************************************************************************
 *				lang_ipn_grp.php
 *
 *	begin				: OCT/29/2004
 *	copyright			: Loewen Enterprise - Xiong Zou
 *	email				: zouxiong@loewen.com.sg
 *
 *	version				: 1.0.0.1 - OCT/29/2004
 *
 ***************************************************************************/
/***************************************************************************
## Terms of Use
##
## All of my MODifications are to use and edit/change for phpBB End Users
##
## Plese DO NOT remove any copyright/licence declaration when using the MODification
##
## I will remain as the sole developer for all my MODifications unless stated otherwise
##
##
## Distribution Terms
##
## All of my MODifications are prohibited to distribute to others without the permission from me.
##
## Plese DO NOT remove any copyright/licence declaration when using the MODification
##
## I will remain as the sole developer for all my MODifications unless stated otherwise
##
## Re-Distribution Terms
##
## If you are distributing WHOLE or PART of my MOD in your MOD Projects or Pre-modded Projects or any other means, you must:
##
## Get the formal authorization from me first.
##
## Plese DO NOT remove any copyright/licence declaration when using the MODification
##
## I will remain as the sole developer for all my MODification unless stated otherwise. Do NOT declare youself as my co-developer
##
## Re-Distribution Terms DOES NOT apply to MOD authors that developing Add-Ons to my MOD. You will be the Add-Ons' Developer/Author
##
***************************************************************************/

//
// Display Topup.php
//
$lang['L_IPN_Subscribe_term_title'] = 'תנאי הרשמה: (שיטת תשלום חוזרת)';
$lang['L_IPN_Subscribe_free'] = 'חינם';
$lang['L_IPN_Subscribe_for_first'] = ' לראשון ';
$lang['L_IPN_Subscribe_then'] = 'ואז';
$lang['L_IPN_Subscribe_for_next'] = ' להבא ';
$lang['L_IPN_Subscribe_for_following'] = ' להבא כל ';
$lang['L_IPN_Subscribe_auto_renew'] = 'הרשמתך תחודש אוטומטית אלא אם כן ביטלת אותה.';
$lang['L_IPN_Subscribe_for_every'] = ' לכל ';
$lang['L_IPN_Subscribe_term_manual'] = 'תנאי הרשמה: (שיטת תשלום ידנית)';
$lang['L_IPN_Subscribe_manual_renew'] = 'הרשמתך תסתיים לאחר תאריך התפוגה, כדי לשמור את הרשמתך, אתה צריך לשלם ידנית תשלום עבור הרשמתך כל ';
$lang['L_IPN_Subscribe_cancel_paypal'] = 'אתה יכול <A HREF="https://www.paypal.com/cgi-bin/webscr?cmd=_subscr-find&alias=%s"><IMG SRC="https://www.paypal.com/en_US/i/btn/cancel_subscribe_gen.gif" BORDER="0"></A> מקבוצה זו. <br />הערה: ביטול הרשמתך תשפיע רק כאשר תאריך התפוגה הנוכחי שלך יגיע.';
$lang['L_IPN_Subscribe_extend'] = 'הארך את הרשמתך';
$lang['L_IPN_Subscribe_paypal_sub_url'] = 'https://www.paypal.com/cgi-bin/webscr';
$lang['L_IPN_Subscribe_to_grp'] = 'הרשם לקבוצה - ';
$lang['L_IPN_Subscribe_paypal_button_alt'] = 'בצע תשלומים עם PayPal - זה מהיר, חינם ומאובטח!';


//display page_header
$lang['L_IPN_Subscribe_header_welcome'] = 'ברוך הבא %s, הרשמתך הנוכחית: ';
$lang['L_IPN_Subscribe_expire_date'] = ' [תסתיים ב- %s]';

//display at groupcp.php
$lang['L_IPN_Subscribe_this_grp'] = '%sהרשם לקבוצה זו%s';
$lang['L_IPN_Subscribe_Payment_grp'] = 'זוהי קבוצה בתשלום: ';

//display at user subscription administration
$lang['L_IPN_user_sub_title'] = 'בקרת הרשמת משתמש';
$lang['L_IPN_user_sub_enplain'] = 'כאן אתה יכול לשנות את פרטי תשלום ההרשמה לקבוצה של המשתמש שלך.';
$lang['L_IPN_user_sub_yes'] = 'כן';
$lang['L_IPN_user_sub_no'] = 'לא';
$lang['L_IPN_user_sub_Update'] = 'עדכן';
$lang['L_IPN_user_sub_info'] = 'פרטי הרשמת המשתמש';
$lang['L_IPN_user_sub_info_exp'] = 'שנה את פרטי הרשמת המשתמש. אתה יכול להוסיף אותו לקבוצה ולקבוע את תאריך התפוגה. שים לב שתאריך התפוגה חייב להיות בתבנית "yyyy/mm/dd hh:mm:ss" בדיוק.';
$lang['L_IPN_grp_name'] = 'שם הקבוצה';
$lang['L_IPN_grp_inornot'] = 'בקבוצה זו?';
$lang['L_IPN_grp_expire_date'] = 'תאריך תפוגה';
$lang['L_IPN_grp_action'] = 'פעולה';
$lang['L_IPN_user_sub_updated'] = 'פרטי הרשמת המשתמש עודכנו בהצלחה.';
$lang['L_IPN_click_update_again'] = 'לחץ %sכאן%s כדי לבדוק את ההרשמה של משתמש זה שוב.';

//display IPN Log
$lang['L_IPN_log_title'] = 'יומן פרטי IPN';
$lang['L_IPN_log_title_explain'] = 'חפש את ה-IPN לכל משתמש או רשימת יומנים של פעולה עסקית לכל המשתמשים. הערה: אתה יכול להשאיר את השדה ריק לחיפוש כל הפעולות העסקיות. אם לא ניתן למצוא את שם המשתמש, זה ידפיס את כל הפעולות העסקיות גם כן.';
$lang['L_LW_USERNAME'] = 'חשבון משתמש';

//display subscribe settings
$lang['L_SUB_SETTINGS_TITLE'] = 'הגדרות הרשמה';
$lang['L_SUB_SETTINGS_EXPLAIN'] = 'עדכן את המידע הקשור להרשמה';
$lang['L_SUB_SETTINGS'] = 'הגדרות הרשמה כלליות';
$lang['L_SUB_EXTRA_DAYS'] = 'תן ימים נוספים לנרשם';
$lang['L_SUB_EXTRA_DAYS_EXPLAIN'] = 'בגלל ש-PayPal ידחה בטעינת תשלום ולמטרת גמול גם כן, תן לנרשם שלך כמה ימים נוספים. לדוגמא 2.';
$lang['update_sub_settings_error'] = 'עדכן %s של שגיאת הגדרות ההרשמה.';
$lang['sub_settings_updated'] = 'הגדרות ההרשמה עודכנו בהצלחה.';
$lang['Click_return_update_sub_settings'] = 'לחץ %sכאן%s כדי לעדכן את הגדרות ההרשמה שוב.';


$lang['L_SUBMIT'] = 'שליחה';
$lang['L_RESET'] = 'איפוס';

?>
