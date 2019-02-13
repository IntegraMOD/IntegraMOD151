<?php
/***************************************************************************
 *						lang_extend_qbar.php [Hebrew]
 *						--------------------
 *	begin				: 28/09/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 1.0.0 - 28/09/2003
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

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

// admin part
if ( $lang_extend_admin )
{
	$lang['Lang_extend_qbar']					= 'תפריט Q/סרגל Q';

	// title
	$lang['Qbar_admin']							= 'סרגל Q';
	$lang['Qbar_admin_explain']					= 'כאן אתה יכול להתקין את סרגלי הניווט והקישורים שעל הפורומים והתפריטים.';
	$lang['Qbar_admin_panel']					= 'לוח סרגל Q';
	$lang['Qbar_admin_panel_explain']			= 'כאן אתה יכול ליצור או לשנות סרגל Q והדרך תופיע בראש המערכת.';
	$lang['Qbar_admin_field']					= 'שדה סרגל Q';
	$lang['Qbar_admin_field_explain']			= 'כאן אתה יכול ליצור ולשנות שדה Q.';
	$lang['Qbar_admin_import']					= 'יבא שדות';
	$lang['Qbar_admin_import_explain']			= 'השתמש במאפיין זה כדי לייבא את השדה לסרגל Q קיים.';
	$lang['Qbar_settings']						= 'הגדרות';

	// qbar def
	$lang['Qbar_name']							= 'שם סרגל Q';
	$lang['Qbar_name_explain']					= 'שם סרגל ה-Q לעולם לא יוצג למשתמש : הוא רק לזיהוי פנימי.';
	$lang['Qbar_class']							= 'מחלקה';
	$lang['Qbar_class_explain']					= 'השתמש ב "סרגל" לסרגל מעל הלוח, "תפריט" לתפריט.';
	$lang['Qbar_display']						= 'הצג';
	$lang['Qbar_display_explain']				= 'קבע אחד זה ל "כן" כדי להציג את סרגל ה-q.';
	$lang['Qbar_cells']							= 'קישורים לשורה';
	$lang['Qbar_cells_explain']					= 'מספר קישורים לשורה : אם מספר הקישורים עבר ערך זה, שורה חדשה תווצר.';
	$lang['Qbar_in_table']						= 'השתמש בטבלה';
	$lang['Qbar_in_table_explain']				= 'קבע מאפיין זה ל "כן" כדי לצייר תיבות סביב הקישורים.';
	$lang['Qbar_style']							= 'מקושר לעיצוב מסויים';
	$lang['Qbar_style_explain']					= 'אם אתה בוחר בעיצוב מיוחד, סרגל ה-Q יוצג רק כאשר המערכת תשתמש בעיצוב זה.';
	$lang['Qbar_sub_template']					= 'מקושר לתת-ערכה מסויימת';
	$lang['Qbar_sub_template_explain']			= 'אם אתה בוחר תת-ערכה, סרגל ה-Q יוצג רק כאשר המערכת תשתמש בתת-ערכה זו. השתמש ב "ללא" להצגתו רק כאשר אין תת-ערכה בשימוש, "הכל כדי להציג את סרגל ה-Q בכל תת-ערכה שהיא בשימוש לעיצוב זה.';

	// field def
	$lang['Qbar_field_name']					= 'שם השדה';
	$lang['Qbar_field_name_explain']			= 'שם השדה לעולם לא מוצג למשתמש : הוא רק מזהה פנימי.';
	$lang['Qbar_shortcut']						= 'קיצור דרך';
	$lang['Qbar_shortcut_explain']				= 'קיצור הדרך הוא מה מוצג בתפריט או בסרגל האפשרות. אתה יכול להשתמש בטקסט, או מפתח למערך השפה. <br />(בדוק language/lang_<i>your_language</i>/lang_main.php)';

	$lang['Qbar_explain']						= 'מעבר עכבר';
	$lang['Qbar_explain_explain']				= 'מעבר העכבר יוצג כאשר המשתמש קבע את העכבר שלו על הקישור או על האייקון (מאפיין title או alt של HTML). אתה יכול להשתמש בטקסט, או מפתח של מערך השפה. <br />(בדוק language/lang_<i>your_language</i>/lang_main.php).';
	$lang['Qbar_alternate']						= 'קיצור דרך חלופי';
	$lang['Qbar_alternate_explain']				= 'קיצור הדרך החלופי בשימוש ב-conjonction עם קביעת גישת הודעה פרטית, כאשר יותר מההודעה הפרטית האחת נקבעה. אתה יכול להשתמש בטקסט ישיר, או מפתח למערך השפה. <br />(בדוק language/lang_<i>your_language</i>/lang_main.php).';
	$lang['Qbar_icon']							= 'אייקון';
	$lang['Qbar_icon_explain']					= 'כתובת לאייקון או מפתח ממערך התמונות. <br />(בדוק templates/<i>your_template</i>/<i>your_template</i>.cfg)';
	$lang['Qbar_use_value']						= 'הצג קיצור דרך';
	$lang['Qbar_use_value_explain']				= 'סמן כן אם אתה רוצה להשתמש בטקסט כקישור המוצג.';
	$lang['Qbar_use_icon']						= 'הצג אייקון';
	$lang['Qbar_use_icon_explain']				= 'סמן כן אם אתה רוצה להשתמש באייקון כקישור המוצג.';
	$lang['Qbar_url']							= 'כתובת לתוכנית';
	$lang['Qbar_url_explain']					= 'אם התוכנית עומדת בתיקיית phpBB, השתמש רק בכתובת יחסית, אחרת השתמש בכתובת מלאה.';
	$lang['Qbar_internal']						= 'תוכנית phpBB';
	$lang['Qbar_internal_explain']				= 'סימון "כן", הקישור יקבע כתוכנית phpBB, ותהיה כל כך מאובטחת כנגד כמה נסיונות פריצה בסיסיות ותכלול את ה-id של העונה בכתובת הקישור.';
	$lang['Qbar_auth_logged']					= 'מחובר';
	$lang['Qbar_auth_logged_explain']			= 'דבר זה מאפשר להציג את הקישור רק אם זה מתאים למצב מחובר : "התעלם" יציג אותו בכל פעם.';
	$lang['Qbar_auth_admin']					= 'רמת מנהל ראשי';
	$lang['Qbar_auth_admin_explain']			= 'דבר זה מאפשר להציג את הקישור רק אם רמת המשתמש מתאימה להתקן : "התעלם" יציג אותו בכל פעם.';
	$lang['Qbar_auth_pm']						= 'הודעה פרטית ממתינה';
	$lang['Qbar_auth_pm_explain']				= 'דבר זה מאפשר לך להציג את הקישור רק אם המצב של הודעה פרטית ממתינה מתאימה להתקן : "התעלם" יציג אותו בכל פעם.';
	$lang['Qbar_tree_id']						= 'עץ פורום';
	$lang['Qbar_tree_id_explain']				= 'דבר זה מאפשר לך להציג את הקישור המתאים לגישת הצפייה של המשתמש בפורום.';

	$lang['Qbar_auths']							= 'גישות';
	$lang['Qbar_private_messages']				= 'ניהול הודעות פרטיות';

	// specific actions
	$lang['Qbar_delete_panel']					= 'מחק סרגל Q';
	$lang['Qbar_delete_panel_confirm']			= 'אתה בטוח שאתה רוצה למחוק את סרגל ה-Q <b>%s</b> ?';

	$lang['Qbar_delete_field']					= 'מחק קישור';
	$lang['Qbar_delete_field_confirm']			= 'אתה בטוח שאתה רוצה להסיר את הקישור <b>%s</b> מסרגל ה-Q %s ?';

	// error messages
	$lang['Qbar_error_panel_system']			= 'אתה לא יכול לשנות או למחוק מערכת סרגל Q.';
	$lang['Qbar_error_panel_exists']			= 'שם סרגל ה-Q כבר קיים.';
	$lang['Qbar_error_panel_not_found']			= 'שם סרגל ה-Q לא קיים.';
	$lang['Qbar_error_panel_empty_name']		= 'אתה צריך לקבוע את שם סרגל ה-Q.';
	$lang['Qbar_error_panel_empty_cells']		= 'אתה צריך לקבוע את מספר האפשרויות המוצגות בכל שורה אם אתה רוצה שסרגל ה-Q יוצג.';

	$lang['Qbar_error_field_exists']			= 'שם השדה כבר קיים.';
	$lang['Qbar_error_field_not_found']			= 'שם השדה לא קיים.';
	$lang['Qbar_error_field_empty_name']		= 'אתה צריך לקבוע את שם השדה.';
	$lang['Qbar_error_field_system']			= 'אתה לא יכול לשנות או למחוק שדה ממערכת סרגל ה-Q.';
	$lang['Qbar_error_field_empty_shortcut']	= 'אתה צריך למלא את קיצור הדרך אם אתה רוצה להציג אותו.';
	$lang['Qbar_error_field_empty_icon']		= 'אתה צריך למלא את האייקון אם אתה רוצה להציג אותו.';
	$lang['Qbar_error_field_display_nothing']	= 'אתה צריך לבחור להשתמש בקישור או באייקון או בשניהם.';
	$lang['Qbar_error_field_empty_url']			= 'אתה צריך למלא את הכתובת או הכתובת היחסית לקישור.';
	$lang['Qbar_error_field_external_url']		= 'לא צויין מתחם (http://) אם אתה בוחר בתוכנית phpBB.';

	// auths
	$lang['Qbar_auth_ignore']					= 'התעלם';
	$lang['Qbar_auth_required']					= 'נדרש';
	$lang['Qbar_auth_prohibited']				= 'אסור';
	$lang['Qbar_auth_pm_new']					= 'הודעות פרטיות חדשות';
	$lang['Qbar_auth_pm_no_new']				= 'אין הודעות פרטיות חדשות';
	$lang['Qbar_auth_pm_unread']				= 'הודעות פרטיות שלא נקראו';

	// classes
	$lang['Qbar_class_system']					= 'מערכת';
	$lang['Qbar_class_bar']						= 'סרגל';
	$lang['Qbar_class_menu']					= 'תפריט';
	$lang['Qbar_class_nav']						= 'ניווט';
	$lang['Qbar_class_nav2']					= 'ניווט 2';
	$lang['Qbar_class_list']					= 'רשימה';

	// generic actions
	$lang['Create_field']						= 'הוסף שדה חדש';
	$lang['Create_panel']						= 'הוסף לוח חדש';

	// misc.
	$lang['Qbar_none']							= '---------- ללא ----------';
	$lang['Import']								= 'יבא';
	$lang['Refresh']							= 'רענן';
	$lang['Qbar_all']							= '---------- הכל -----------';
}

$lang['FAQ_explain']				= 'שאלות נפוצות.';
$lang['Memberlist_explain']			= 'רשימת החברים הרשומים.';
$lang['Usergroups_explain']			= 'קבוצות של משתמשים רשומים.';
$lang['Profile_explain']			= 'ערוך את הפרופיל שלך.';
$lang['Private_Messaging_explain']	= 'ראה את ההודעות הפרטיות שלך.';
$lang['Login_explain']				= 'התחבר כדי להשתמש בכינוי ובהגדרות הפרופיל שלך.';
$lang['Register_explain']			= 'הרשמה.';
$lang['Logout_explain']				= 'סיים את האירוע שלך.';
$lang['Admin_explain']				= 'עבור ללוח הניהול הראשי.';
$lang['Admin'] = 'gיהול ראשי';
$lang['Forum']						= 'פורומים';
$lang['Forum_index_explain']		= 'אינדקס הפורומים.';
$lang['Home']						= 'בית';
$lang['Home_explain']				= 'עבור לדף הבית';
$lang['Album']						= 'אלבום';
$lang['Album_explain']				= 'צפה בתמונות שהועלו';
$lang['Calendar']					= 'לוח שנה';
$lang['Calendar_explain']			= 'בדוק אירועים שנשלחו בפורומים';
$lang['Statistics']					= 'סטטיסטיקה';
$lang['Statistics_explain']			= 'צפה בסטטיסטיקת האתר';
$lang['Knowledgebase']				= 'מאגר מאמרים';
$lang['Knowledgebase_explain']		= 'בדוק מאמרים שהועלו לאתר';
$lang['Acronyms']					= 'ראשי תיבות';
$lang['Acronyms_explain']			= 'הצג את ראשי התיבות אשר בשימוש בפורומים';
$lang['Digests']					= 'תקצירים';
$lang['Digests_explain']			= 'הרשם לדיוני הדואר היומיים של אתר זה';
$lang['Points_CP']					= 'לוח בקרה לנקודות';
$lang['Points_CP_explain']			= 'תן נקודות לכל אחד מחברי הפורום';
$lang['Rules']						= 'חוקים';
$lang['Rules_explain']				= 'קרא את חוקי האתר';
$lang['Tour']						= 'סיור בפורום';
$lang['Tour_explain']				= 'עזרה מקוונת לאתר';
$lang['Rate_menu']					= 'דירוגים אחרונים';
$lang['Rate_explain']				= 'הנושאים המדורגים הגדולים שדורגו על-ידי משתמשי הפורום';
$lang['Ranks']						= 'דירוגים';
$lang['Ranks_explain']				= 'הצג דירוגים זמינים וחברים';
$lang['Links']						= 'קישורים';
$lang['Links_explain']				= 'קטגוריות קישורים';
$lang['Donate']						= 'Donate';
$lang['Donate_explain']				= 'Donate to '.$board_config['sitename'];
$lang['Donors']						= 'Donors';
$lang['Donors_explain']				= 'Users who have donated';
$lang['Personal_album']		= 'My Album';
$lang['Personal_album_explain']				= 'Your own personal album';
$lang['Personal_albums']		= 'Personal Albums';
$lang['Personal_albums_explain']				= 'All personal albums';
$lang['FAQ']				= 'FAQ';
$lang['Search_forums']				= 'Search Forums';
$lang['Search_forums_explain']				= 'Search through forums.';
$lang['Search_kb']				= 'Search KB';
$lang['Search_kb_explain']				= 'Search through Knowledge Base.';
$lang['Paypal_history']		= 'My PayPal History';
$lang['Paypal_history_explain']				= 'View your PayPal account history';
$lang['My_cookies']		= 'My Cookies';
$lang['My_cookies_explain']				= 'Manage your own cookies';
$lang['News_RSS']		= 'RSS Feed';
$lang['News_RSS_explain']				= 'News in RSS format';
$lang['Shoutbox']		= 'Shoutbox';
$lang['Shoutbox_explain']				= 'Full Page Shoutbox';
$lang['Sync_user_posts']		= 'Sync User Posts';
$lang['Sync_user_posts_explain']				= 'Rebuild user post count';
$lang['Tell_friend']		= 'Tell A Friend';
$lang['Tell_friend_explain']				= 'Tell your friends about thsi great site.';
$lang['Online_users']		= 'Online Users';
$lang['Online_users_explain']				= 'See who is online at this time.';
$lang['Bookmarks']					= 'סימניות';
$lang['Bookmarks_explain']			= 'חפש להודעות עם סימניות';
$lang['Exploit_attempts']					= 'Exploit Attempts';
$lang['Exploit_attempts_explain']			= 'See the list of blocked exploit attempts';
$lang['Search_dl']					= 'Search Downloads';
$lang['Search_dl_explain']			= 'Search trough downloads';
$lang['Staff']						= 'צוות הפורום';
$lang['Staff_explain']				= 'הצג את חברי צוות הפורום';
?>