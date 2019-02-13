<?php
/***************************************************************************
 *                          lang_contact.php [Hebrew]
 *                            -------------------
 *   begin                : Friday, Jan 31, 2003
 *   version              : 0.8.0
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
// along with our copyright message indicating you are the translator
// please add it here.
$lang['TRANSLATION_INFO'] = '';

// Do not change the next six lines.
// Avoid including the file more than once.
if ( defined('IN_CONTACT_LANG') )
{
	return;
}
define('IN_CONTACT_LANG', true);

// You may want to edit the following lines to match your website.
$lang['Buddy'] = 'חבר';
$lang['Ignore'] = 'התעלם';
$lang['Disallow'] = 'לא מורשה';
$lang['User_ignoring_you'] = 'המשתמש שם אותך ברשימת ההתעלמות שלו.';
$lang['User_not_want_contact'] = 'המשתמש שם אותך ברשימת הלא מורשים שלו.';
$lang['Buddies_online'] = 'חברים אלו התחברו';
$lang['Buddy_online'] = 'חבר זה התחבר';
$lang['Buddies_offline'] = 'חברים אלו מנותקים עכשיו';
$lang['Buddy_offline'] = 'חבר זה מנותק עכשיו';
$lang['Listbox_Buddies'] = 'החברים שלך';
$lang['Online'] = 'מחובר';
$lang['Offline'] = 'מנותק';
$lang['Buddies'] = 'חברים';
$lang['Ignored_some_users'] = 'כמה משתמשים בעמוד זה מתעלמים. %sצפה בעמוד זה עם אותם משתמשים?%s';
$lang['Ignore_some_users'] = '%sצפה בעמוד זה ללא המשתמשים המתעלמים?%s';

// These will be used in the user profiles for links to do the indicated thing
// Also used as ALT text for images in several places.  %s will be replaced with a
// user's name
$lang['Add_to_buddy'] = 'הוסף את %s לרשימת החברים שלך';
$lang['Remove_from_buddy'] = 'הסר את %s מרשימת החברים שלך';
$lang['Add_to_ignore'] = 'הוסף את %s לרשימת ההתעלמות שלך';
$lang['Remove_from_ignore'] = 'הסר את %s מרשימת ההתעלמות שלך';
$lang['Add_to_disallow'] = 'הוסף את %s לרשימת הקשר הבלתי מורשת שלך';
$lang['Remove_from_disallow'] = 'הסר את %s מרשימת הקשר הבלתי מורשת שלך';


// Error Messages
$lang['No_alerts_updated'] = 'אין משתמשים שסומנו לקבלת עדכונים';
$lang['No_autoclose'] = 'אם אתה רואה הודעה זו, אז מאפיין סגירת החלון אוטומטית לא תעבוד בדפדפן שלך. סיבות אפשריות יכולות להיות ש-JavaScript כבוי בדפדפן שלך. נא לסגור חלון זה.';

// Control Panel
$lang['Users_you_ignore'] = 'משתמשים שמהם אתה מתעלם';
$lang['Users_you_disallow'] = 'משתמשים שאתה לא מאפשר להם ליצור קשר איתך';
$lang['Users_buddy_you'] = 'משתמשים הרושמים אותך כחבר';
$lang['Users_you_buddy'] = 'החברים שלך';
$lang['None_you_ignore'] = 'אתה לא מתעלם מאף אחד מהמשתמשים.';
$lang['None_you_disallow'] = 'אתה מורשה ליצור קשר עם כל המשתמשים.';
$lang['None_buddy_you'] = 'אין משתמשים הרושמים אותך כחבר.';
$lang['None_you_buddy'] = 'אין לך חברים.';
$lang['Add_a_user'] = 'הוסף משתמש לרשימה זו?';
$lang['Add_user'] = 'הוסף משתמש';
$lang['Move_selected_users'] = 'העבר את המשתמשים הנבחרים ל:';
$lang['Buddy_link'] = 'חברים';
$lang['Buddied_link'] = 'חבר של...';
$lang['Ignore_link'] = 'התעלמות';
$lang['Disallow_link'] = 'לא מורשים';
$lang['Be_alerted'] = 'הודע לי כאשר משתמש זה מתחבר';
$lang['Edit_alerts'] = 'ערוך הגדרות קבלת התחברות והתנתקות';

// Success messages
$lang['Alerts_updated'] = 'העדפות ההודעות עודכנו לכל המשתמשים ששונו';
$lang['Alerts_oops'] = ' חוץ מההבאים, שלא ניתן למצוא אותם:<br />';
$lang['Moved_to_buddies'] = 'המשתמשים הנבחרים הועברו לרשימת החברים שלך.';
$lang['Moved_to_ignore'] = 'המשתמשים הנבחרים הועברו לרשימת ההתעלמות שלך.';
$lang['Moved_to_disallow'] = 'המשתמשים הנבחרים הועברו לרשימת הבלתי מורשים שלך.';
$lang['Removed_selected_users'] = 'המשתמשים הנבחרים הוסרו.';
$lang['Buddy_updated'] = 'רשימת החברים עודכנה';
$lang['Ignore_updated'] = 'רשימת ההתעלמות עודכנה';
$lang['Disallow_updated'] = 'רשימת הבלתי מורשים עודכנה';


// For Prillian
$lang['Close_window_link'] = '<br /><br /><a href="javascript:window.close();">' . $lang['Close_window'] . '</a>';

/* Entries Added in Prillian 0.7.0 & Contact List 0.3.0 */
$lang['No_ignore_admin'] = 'ניסית להתעלם או לא לאפשר את המנהלים הראשיים או המנהלים הבאים: %s. שלח מחדש את השינויים ללא הנסיון להתעלם או לא לאפשר את אותם משתמשים.<br />';
$lang['No_contact_add_self'] = 'ניסית להוסיף את עצמך כאחד מרשימת הקשר שלך.  זה לא מאופשר; שלח מחדש את השינויים לא הנסיון להוסיף את עצמך לרשימת הקשר שלך.';
$lang['Add_Selected_as_Buddies'] = 'הוסף את הנבחרים כחברים';
$lang['Add_contact_users_link'] = 'הוסף אנשי קשר חדשים';
$lang['You_have_buddies'] = 'יש לך %d חברים.';
$lang['You_have_buddy'] = 'יש לך חבר אחד.';
$lang['You_are_ignoring'] = 'אתה מתעלם מ-%d משתמשים.';
$lang['You_are_ignoring_one'] = 'אתה מתעלם ממשתמש אחד.';
$lang['You_have_disallowed'] = 'אתה לא מאפשר ל-%d משתמשים ליצור קשר איתך.';
$lang['You_have_disallowed_one'] = 'אתה לא מאפשר למשתמש אחד ליצור קשר איתך.';
$lang['You_as_buddies'] = '%d משתמשים נוספו כחברים.';
$lang['You_as_buddy'] = 'משתמש אחד נוסף כחבר.';
$lang['Add_many_contacts_explain'] = 'אתה יכול להוסיף כמה משתמשים לרשימות החברים, התעלמות, או הבלתי מורשים שלך כאן.  הקלד את השם של כל משתמש שאתה רוצה להוסיף בתיבת הטקסט הבאה.  כל שם משתמש חייב להיות בשורה נפרדת.';
$lang['Add_to_Buddy_List'] = 'הוסף לרשימת החברים';
$lang['Add_to_Ignore_List'] = 'הוסף לרשימת ההתעלמות';
$lang['Add_to_Disallow_List'] = 'הוסף לרשימת הבלתי מורשים';


/* Entries Changed in Prillian 0.7.0 & Contact List 0.3.0 */
/* Any of these that have contact in the $lang['name'] part used to have bid or
 buddy in place of contact. In some, that is the only change */
$lang['Contact_List_FAQ'] = 'רשימות הקשר'; // Title of the FAQ

$lang['Contact_Management'] = 'ניהול רשימת קשר';

// Error Messages
$lang['No_contact_mode'] = 'אין מצב קשר מוגדר';
$lang['No_contact_type'] = 'אין סוג קשר מוגדר';
$lang['No_contact_action'] = 'אין פעולת קשר מוגדרת';
$lang['No_contact_id'] = 'אין id של משתמש קשר';
$lang['Invalid_contact_action'] = 'פעולת הקשר המוגדרת שגוייה';


// Control Panel
$lang['Contact_click_here'] = '%sנהל רשימת קשר%s';


// Success messages
$lang['Confirm_contact_changes'] = 'אתה בטוח שאתה רוצה לבצע שינויים אלו?';
$lang['No_Contact_changes'] = 'אין שינויים שצויינו';


//Private Message alerts
$lang['System_title'] = 'הודעת מערכת רשימת קשר';
$lang['Contact_Alert_PM'] = '[url=%s]%s[/url] הוסיף אותך לרשימת הקשר שלו.  כדי לנהל את רשימת הקשר שלך, [url=%s]לחץ כאן[/url]. זוהי הודעה אוטומטית שנשלחה על-ידי תוכנת הפורום; אתה לא צריך להגיב להודעה זו.';

?>