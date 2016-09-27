<?php
/***************************************************************************
 *						lang_extend_profile_control_panel.php [English]
 *						-----------------------------------------------
 *	begin				: 28/09/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 1.0.2 - 28/09/2003
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
	$lang['Lang_extend_profile_control_panel'] = 'חבילת שפה ללוח בקרה לפרופיל';
}

// who's online
$lang['Admin_founder_online_color']			= '%sמייסד המערכת%s';
$lang['Jadmin_online_color']			        = '%sמנהל ראשי צעיר%s';
$lang['User_online_color']					= '%sמשתמש%s';

// topic or privmsg display

$lang['Add_friend']							= 'הוסף לרשימת החברים שלך';
$lang['Add_to_friend_list']					= 'הוסף לרשימת החברים שלך';

$lang['Remove_friend']						= 'הסר מרשימת החברים שלך';
$lang['Remove_from_friend_list']			= 'הסר מרשימת החברים שלך';



$lang['Add_to_ignore_list']					= 'הוסף לרשימת ההתעלמות שלך';
$lang['Remove_from_ignore_list']			= 'הססר מרשימת ההתעלמות שלך';
$lang['Happy_birthday']						= 'יום הולדת שמח !';
$lang['Ignore_choosed']						= 'בחרת להתעלם ממשתמש זה';
$lang['Online']								= 'מחובר';
$lang['Offline']							= 'מנותק';
$lang['Hidden']								= 'מוסתר';
$lang['Gender']								= 'מין';
$lang['Male']								= 'זכר';
$lang['Female']								= 'נקבה';
$lang['No_gender_specify']					= 'לא ידוע';
$lang['Age']								= 'גיל';
$lang['Do_not_allow_pm']					= 'משתמש זה לא מקבל הודעות פרטיות';

// main entry (profile.php)
$lang['Click_return_profilcp']			    = 'לחץ %sכאן%s כדי לחזור ל%s';

// birthday popup (profile_birthday.php)
$lang['Birthday']							= 'יום הולדת';
$lang['birthday_msg']						= 'שלום %s, <br /><br /><br /> %s שמח לברך אותך יום הולדת שמח !';

// home panel (profilcp_home.php)
$lang['profilcp_index_shortcut']			= 'בית';
$lang['profilcp_index_pagetitle']			= 'דף הבית של הפרופיל הפרטי';

// home panel : mini buddy list (functions_profile.php)
$lang['Friend_list']						= 'רשימת חברים';
$lang['Friend_list_of']						= 'חבר של';
$lang['Ignore_list']						= 'רשימת התעלמות';
$lang['Ignore_list_of']						= 'מתעלם על-ידי';
$lang['Nobody']								= 'אף אחד';
$lang['Always_visible']						= 'הראה תמיד למשתמש זה';
$lang['Not_always_visible']					= 'משתמש זה לא רואה אותך כמחובר בזמן שאתה במצב מוסתר';

// home panel : watched topics (functions_profile.php)
$lang['Stop_watching_selected_topics']		= 'הפסק לעקוב אחר הנושאים הנבחרים';
$lang['New_subscribed_topic']				= 'נושאים רשומים';
$lang['Submit_period']						= 'ראה נושאים מאז';

// buddy list (profilcp_buddy.php)
$lang['profilcp_buddy_shortcut']			= 'רשימת חברים אישית';
$lang['profilcp_buddy_pagetitle']			= 'רשימת חברים אישית';
$lang['profilcp_buddy_friend_shortcut']		= 'רשימת חברים';
$lang['profilcp_buddy_friend_pagetitle']	= 'ערוך את רשימת החברים שלך';
$lang['profilcp_buddy_ignore_shortcut']		= 'רשימת התעלמות';
$lang['profilcp_buddy_ignore_pagetitle']	= 'ערוך את רשימת ההתעלמות שלך';
$lang['profilcp_buddy_list_shortcut']		= 'כל החברים';
$lang['profilcp_buddy_list_pagetitle']		= 'רשימת חברים';
$lang['Click_return_privmsg']				= 'לחץ %sכאן%s כדי לחזור להודעה הפרטית';
$lang['profilcp_buddy_could_not_add_user']	= 'המשתמש שבחרת לא קיים.';
$lang['profilcp_buddy_could_not_anon_user']	= 'אתה לא יכול לצרף משתמש אלמוני כחבר.';
$lang['profilcp_buddy_add_yourself']		= 'אתה לא יכול להוסיף את עצמך לרשימת החברים שלך';
$lang['profilcp_buddy_already']				= 'המשתמש כבר ברשימת החברים שלך';
$lang['profilcp_buddy_ignore']				= 'הוספה בלתי אפשרית : משתמש זה מתעלם ממך';
$lang['profilcp_buddy_you_admin']			= 'מנהל ראשי או מנהל, אתה לא יכול להתעלם מאנשים';
$lang['profilcp_buddy_admin']				= 'אתה לא יכול להתעלם ממנהלים ראשיים או מנהלים';
$lang['User_fields']						= 'רשימת שדות משתמש';
$lang['Friend']								= 'חבר';
$lang['Comp_LE']							= 'פחות מ-';
$lang['Comp_EQ']							= 'שווה ל-';
$lang['Comp_NE']							= 'שונה מ-';
$lang['Comp_GE']							= 'גדול מ-';
$lang['Comp_IN']							= 'כולל';
$lang['Comp_NI']							= 'לא כולל';
$lang['Sort_none']							= 'לא ממוין';
$lang['date_entry']							= 'YYYYMMDD';

// update profile (profilcp_profil.php)
$lang['profilcp_profil_shortcut']			= 'פרופיל';
$lang['profilcp_profil_pagetitle']			= 'עריכת פרופיל';
$lang['profilcp_prefer_shortcut']			= 'הפרופיל שלך';
$lang['profilcp_prefer_pagetitle']			= 'העדפות הפרופיל שלך';
$lang['profilcp_signature_shortcut']		= 'חתימה';
$lang['profilcp_signature_pagetitle']		= 'חתימה';
$lang['profilcp_avatar_shortcut']			= 'סמל אישי';
$lang['profilcp_avatar_pagetitle']			= 'סמל אישי';
$lang['profilcp_digests_shortcut']			= 'דיונים';
$lang['profilcp_digests_pagetitle']			= 'דיונים';
// update profile : preferences - functions (mod_profile_control_panel.php)
$lang['Other']								= 'אחר...';
$lang['Friend_only']						= 'חברים בלבד';

// update profile : public informations : web info (mod_profile_control_public_web.php)
$lang['profilcp_profil_base_shortcut']		= 'מידע ציבורי';
$lang['Web_info']							= 'פרטי אתר';

// update profile : public informations : real info (mod_profile_control_public_real.php)
$lang['Real_info']							= 'מידע אישי';
$lang['Realname']							= 'שם אמיתי';
$lang['Date_error']							= 'יום %d, חודש %d, שנה %d זה לא תאריך תקף';

// update profile : public informations : messengers info (mod_profile_control_public_messengers.php)
$lang['Messengers']							= 'מסנג\'רים';

// update profile : public informations : contact info (mod_profile_control_public_contact.php)
$lang['Home_phone']							= 'טלפון בבית';
$lang['Home_fax']							= 'פקס בבית';
$lang['Work_phone']							= 'טלפון בעבודה';
$lang['Work_fax']							= 'פקס בעבודה';
$lang['Cellular']							= 'סלולרי';
$lang['Pager']								= 'Pager';

// update profile : preferences - preferences panel ("Your profile")
$lang['Profile_control_panel']				= 'הגדרות פרופיל';

// update profile : preferences - i18n panel (mod_profile_control_panel_international.php)
$lang['Profile_control_panel_i18n']			= 'לאומיות';
$lang['summer_time']						= 'האם אתה באיזור שומר אור ?';

// update profile : preferences - notification panel (mod_profile_control_panel_notification.php)
$lang['Profile_control_panel_notification']	= 'הודעה';

// update profile : preferences - posting panel (mod_profile_control_panel_posting.php)
$lang['Profile_control_panel_posting']		= 'שליחה';

// update profile : preferences - privacy panel (mod_profile_control_panel_privacy.php)
$lang['Profile_control_panel_privacy']		= 'פרטיות';
$lang['View_user']							= 'הראה אותי מחובר';
$lang['Public_view_pm']						= 'קבל הודעה פרטית';
$lang['Public_view_website']				= 'הצג את פרטי האתר שלי';
$lang['Public_view_messengers']				= 'הצג את כתובות המסנג\'רים שלי';
$lang['Public_view_real_info']				= 'הצג את המידע האישי שלי';

// update profile : preferences - reading panel (mod_profile_control_panel_reading.php)
$lang['Profile_control_panel_reading']		= 'קריאה';
$lang['Public_view_avatar']					= 'הצג סמלים אישיים';
$lang['Public_view_sig']					= 'הצג חתימות';
$lang['Public_view_img']					= 'הצג תמונות';

// update profile : preferences - profile preferences
$lang['profile_prefer']						= 'אפשרויות פרופיל';

// update profile : preferences - system panel (mod_profile_control_panel_system.php)
$lang['Profile_control_panel_system']		= 'מערכת';
$lang['summer_time_set']					= 'האם הזמן הוא שעון קיץ ? (הוסף שעה לזמן המקומי)';
$lang['Forum_rules']						= 'הראה את חוקי הפורום בהרשמה';

// update profile : preferences - admin part (mod_profile_control_panel_admin.php)
$lang['profilcp_admin_shortcut']			= 'ניהול ראשי';
$lang['User_deleted']						= 'המשתמש נמחק בהצלחה.';
$lang['User_special']						= 'שדות מיוחדים למנהלים ראשיים בלבד';
$lang['User_special_explain']				= 'שדות אלו אינן ניתנות לשינוי על-ידי המשתמשים.  כאן תוכל לקבוע את המצב שלהם ואפשרויות אחרות שאינן ניתנות להם.';
$lang['User_status']						= 'המשתמש פעיל';
$lang['User_allow_email']					= 'יכול לשלוח הודעות דואר';
$lang['User_allow_pm']						= 'יכול לשלוח הודעות פרטיות';
$lang['User_allow_website']					= 'יכול להראות את פרטי האתר שלו';
$lang['User_allow_messenger']				= 'יכול לשתף את כתובות המסנג\'רים שלו';
$lang['User_allow_real']					= 'יכול להראות את המידע האישי שלו';
$lang['User_allowavatar']					= 'יכול להציג סמל אישי';
$lang['User_allow_sig']						= 'יכול להציג את החתימה שלו';
$lang['Rank_title']							= 'כותרת דירוג';
$lang['User_delete']						= 'מחק משתמש זה';
$lang['User_delete_explain']				= 'לחץ כאן כדי למחוק משתמש זה; לא ניתן לשחזר את הפעולה.';
$lang['No_assigned_rank']					= 'אין דירוג מיוחד שנקבע';
$lang['User_self_delete']					= 'אתה יכול למחוק את החשבון שלך בעזרת המנהל הראשי של המערכת';

// update profile : signature (profilcp_profile_signature.php)
$lang['profilcp_sig_preview']				= 'תצוגה מקדימה של החתימה';

// display profile (profilcp_public.php)
$lang['profilcp_public_shortcut']			= 'ציבורי';
$lang['profilcp_public_pagetitle']			= 'הצגה ציבורית';
$lang['profilcp_public_base_shortcut']		= 'מידע מבוסס';
$lang['profilcp_public_base_pagetitle']		= 'פרטי פרופיל מבוססים';
$lang['profilcp_public_groups_shortcut']	= 'קבוצות';
$lang['profilcp_public_groups_pagetitle']	= 'קבוצות שמשתמש זה שייך להם';

// update profile : preferences - home panel (mod_profile_control_panel_home.php)
$lang['Profile_control_panel_home']			= 'דף הבית של הפרופיל';
$lang['Profile_control_panel_home_buddy']	= 'רשימת חברים אישית';
$lang['Buddy_friend_display']				= 'הצג את רשימת החברים שלי בדף הבית';
$lang['Buddy_ignore_display']				= 'הצג את רשימת ההתעלמות שלי בדף הבית';
$lang['Buddy_friend_of_display']			= 'הצג רשימת "חבר של" בדף הבית';
$lang['Buddy_ignored_by_display']			= 'הצג רשימת "מתעלם על-ידי" בדף הבית';

$lang['Profile_control_panel_home_privmsg']	= 'הודעות פרטיות';
$lang['Privmsgs_per_page']					= 'מספר הודעות פרטיות המוצגות בכל עמוד בדף הבית';

$lang['Profile_control_panel_home_wtopics']	= 'נושאים מעוקבים';
$lang['Watched_topics_per_page']			= 'מספר של נושאים מעוקבים המוצגים בכל עמוד בדף הבית';

// display profile : base info (profilcp_public_base.php)
$lang['Unavailable']						= 'לא זמין';
$lang['Last_visit']							= 'זמן הביקור האחרון';
$lang['User_pics']							= 'תמונות שהועלו';
$lang['User_post_stats']					= '%s הודעות, %.2f%% בסך הכל, %.2f הודעות ליום';
$lang['User_posts']							= 'הודעות משתמש';
$lang['Most_active_topic']					= 'הנושא הכי פעיל';
$lang['Most_active_topic_stat']				= '%s הודעות, %.2f%% של הנושא, %.2f%% של הפורום';
$lang['Most_active_forum']					= 'הפורום הכי פעיל';
$lang['Most_active_forum_stat']				= '%s הודעות, %.2f%% של הפורום, %.2f%% בסך הכל';

// register (profilcp_register.php)
$lang['profilcp_register_shortcut']			= 'הרשמה';
$lang['profilcp_register_pagetitle']		= 'פרטי הרשמה';
$lang['profilcp_email_title']				= 'כתובת דואר אלקטרוני';
$lang['profilcp_email_confirm']				= 'אשר את כתובת הדואר האלקטרוני שלך';
$lang['anti_robotic']						= 'בקרת תמונה';
$lang['anti_robotic_explain']				= 'בקרה זו נקבעה כדי למנוע הצפה על-ידי רובוטי הרשמה';
$lang['profilcp_password_explain']			= 'אתה חייב לאשר את סיסמתך הנוכחית אם אתה רוצה לשנות אותה';
$lang['Agree_rules']						= 'על-ידי סימון תיבה זו, אתה מצהיר שאתה מודע לתנאים, ומסכים איתם';
$lang['profilcp_username_missing']			= 'שם המשתמש שגוי';
$lang['profilcp_email_not_matching']		= 'כתובות הדואר האלקטרוני אינן תואמות';
$lang['Robot_flood_control']				= 'בקרת התמונה לא תואמת למה שהקלדת';
$lang['Disagree_rules']						= 'הצהרת שאינך מסכים עם חוקי השימוש במערכת זו, אז אתה לא רשאי להרשם.';

$lang['Always_set_bm'] = 'קבע סימנייה אוטומטית כאשר אתה שולח';

// PCP Extra :: Added :: Start
$lang['Required_Error'] = 'השדה "%s" נדרש';
$lang['Required_field'] = '&nbsp;<font color=red>*</font>';
$lang['Required_explain'] = '&nbsp;<font color=red>*</font> = שדה דרוש.';
$lang['Email_confirm'] = 'אם שינית את כתובת הדואר האלקטרוני שלך, תצטרך להפעיל מחדש את חשבונך דרך הקישור שנשלח לכתובת הדואר האלקטרוני החדשה שלך.';
$lang['Email_confirm_admin'] = 'אם שינית את כתובת הדואר האלקטרוני שלך, המנהל הראשי יצטרך להפעיל את חשבונך מחדש.';
$lang['Email_confirm_guest'] = 'הודעה תשלח לכתובת זו כדי להפעיל את חשבונך';
$lang['Email_confirm_guest_admin'] = 'תקבל הודעה לכתובת זו כאשר החשבון שלך יופעל על-ידי המנהל הראשי';
$lang['Visible_friends'] = '<br><i>(ניתן לצפייה על-ידי חברים בלבד)</i>';
$lang['Visible_all'] = '<br><i>(ניתן לצפייה על-ידי כל המשתמשים)</i>';
$lang['Visible_admin'] = '<br><i>(ניתן לצפייה על-ידי המנהלים הראשיים בלבד)</i>';
$lang['Visible_board_email_all'] = '<br><i>(כתובות דואר אלקטרוני תמיד מוסתרות לכל המשתמשים שיכולים לשלוח לך הודעה דרך המערכת)</i>';
$lang['Visible_board_email_friends'] = '<br><i>(כתובות דואר אלקטרוני תמיד מוסתרות וחברים בלבד יכולים לשלוח לך הודעות דרך המערכת)</i>';
$lang['Preferences'] = 'העדפות';
$lang['Privmsgs'] = 'הודעות פרטיות';
$lang['Buttons'] = 'כפתורים';
$lang['Left'] = 'שמאל';
$lang['Viewtopic'] = 'צפה בנושא';
// PCP Extra :: Added :: End
// Digests PCP :: Added :: Start
$lang['profilcp_digests_shortcut']			= 'תקצירים';
$lang['profilcp_digests_pagetitle']			= 'תקצירים';
// Digests PCP :: Added :: End
// Warning PCP :: Added :: Start
$lang['Warnings'] = 'כרטיסים צהובים: %d'; //shown beside users post, if any warnings given to the user
$lang['user_warnings'] = 'כרטיסים צהובים'; // field label
$lang['Banned'] = 'חסום כרגע';//shown beside users post, if user are banned
// Warning PCP :: Added :: End
// Auto Summer time :: Added :: Start
$lang['summer_time_auto_set'] = 'כוון אוטומטית לשעון הקיץ?';
// Auto Summer time :: Added :: End
//  Mini Cal PCP :: Added :: Start
$lang['mini_cal_version_mycal'] = 'לוח השנה שלי';
$lang['mini_cal_version_plus'] = 'לוח השנה שלי+';
$lang['mini_cal_version_topic'] = 'נושא לוח שנה';
$lang['mini_cal_version_snail'] = 'לוח שנה של Websnail Pro';
$lang['mini_cal_version_snaillite'] = 'לוח שנה של Websnail Lite';
$lang['mini_cal_version_none'] = 'אין לוח שנה נתמל שהותקן';
$lang['mini_cal_calendar_version'] = 'לוח שנה בגרסה קטנה';
$lang['mini_cal_calendar_version_explain'] = 'מגדיר באילו אירועי לוח שנה אתה משתמש, אם בכלל.';
$lang['mini_cal_limit'] = 'הגבלת לוח שנה קטן';
$lang['mini_cal_limit_explain'] = 'מגביל את מספר האירועים המוצגים בלוח השנה הקטן. רק לאירועי לוח שנה!';
$lang['mini_cal_days_ahead'] = 'ימים הבאים של לוח השנה הקטן';
$lang['mini_cal_days_ahead_explain'] = 'מגביל את מספר הימים הבאים שבהם זמן האירועים מתקרב יוצגו. קבע ל-0 (אפס) לבלתי מוגבל. רק לאירועי לוח שנה!';
$lang['mini_cal_search_posts'] = 'חפש לפי הודעות';
$lang['mini_cal_search_events'] = 'חפש לפי אירועים';
$lang['mini_cal_date_search'] = 'חיפוש תאריך בלוח השנה הקטן';
$lang['mini_cal_date_search_explain'] = 'מגדיר איזה סוג חיפוש קורה כאשר משתמש לוחץ על תאריך בלוח השנה. "חפש לפי אירועים" זה רק לאירועי לוח שנה!';
$lang['mini_cal_fdow'] 				= 'היום הראשון של השבוע בלוח השנה הקטן'; 
$lang['mini_cal_fdow_explain'] 			= 'היום הראשון של השבוע: - 0=ראשון, 1=שני...6=שבת.'; 
$lang['mini_cal_link_class'] = 'מחלקת קישור בלוח השנה הקטן';
$lang['mini_cal_link_class_explain'] = 'מגדיר את מחלקת ה-css לשימוש לכתובות ימי לוח השנה הקטן.';
$lang['mini_cal_today_class'] = 'מחלקת היום בלוח השנה הקטן';
$lang['mini_cal_today_class_explain'] = 'מגדיר את מחלקת ה-the לשימוש לתאריך של היום ללוח השנה הקטן.';
$lang['mini_cal_auth'] = 'גישת לוח שנה קטן';
$lang['mini_cal_auth_explain'] = 'מגדיר את רמת הגישה הנדרשת כדי לצפות באירועים המתקרבים. זה קשור לרמת הגישה שנקבעה לפורום.';
//  Mini Cal PCP :: Added :: End
// signature control
$lang['sig_yes_not_controled'] = 'כן לא מgוהלת';
$lang['sig_yes_controled'] = 'כן מgוהלת';
// right click
$lang['Extra_priv_explain'] ='אפשר למשתמש להעתיק וללחוץ לחיצה ימgית';
// phpbb security admin
$lang['Force_security'] ='Force Security';
$lang['Force_security_explain'] ='Check this box and the user will be forced to re-activate his acount using the security question and answer.';
$lang['Reset_security'] ='Reset Security';
$lang['Reset_security_explain'] ='Check this box if the user locked himself out by mistyping his password too many times. This will reset the counter to 0.';
$lang['Clear_security'] ='Clear Security';
$lang['Clear_security_explain'] ='Check this box and the security question and answer of this user will be reset. The user will NOT be able to browse the forums untill he/she re-enters them.';
?>
