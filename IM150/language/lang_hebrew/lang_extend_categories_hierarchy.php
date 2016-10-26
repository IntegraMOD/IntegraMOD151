<?php
/***************************************************************************
 *						lang_extend_categories_hierarchy.php [Hebrew]
 *						------------------------------------
 *	begin				: 28/09/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 1.0.1 - 10/11/2003
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
	$lang['Lang_extend_categories_hierarchy']		= 'תת-קטגוריות';

	$lang['Category_attachment']					= 'צרף ל-';
	$lang['Category_desc']							= 'תיאור';
	$lang['Category_config_error_fixed']			= 'השגיאה בהתקנת הקטגוריה תוקנה';
	$lang['Attach_forum_wrong']						= 'אתה לא יכול לצרף פורום לפורום';
	$lang['Attach_root_wrong']						= 'אתה לא יכול לצרף פורום לפורום ראשי';
	$lang['Forum_name_missing']						= 'אתה לא יכול ליצור פורום ללא שם';
	$lang['Category_name_missing']					= 'אתה לא יכול ליצור קטגוריה ללא שם';
	$lang['Only_forum_for_topics']					= 'ניתן למצוא נושאים בפורומים בלבד';
	$lang['Delete_forum_with_attachment_denied']	= 'אתה לא יכול למחוק פורומים בעלי תת-רמות';

	$lang['Category_delete']						= 'מחק קטגוריה';
	$lang['Category_delete_explain']				= 'הטופס הבא מאפשר לך למחוק קטגוריה ולהחליט היכן לשים את כל הפורומים והקטגוריות שהיא מכילה.';

	// forum links type
	$lang['Forum_link_url']							= 'קישור לכתובת';
	$lang['Forum_link_url_explain']					= 'אתה יכול לקבוע כאן כתובת לתוכנית phpBB, או כתובת מלאה לשרת חיצוני';
	$lang['Forum_link_internal']					= 'תוכנית phpBB';
	$lang['Forum_link_internal_explain']			= 'בחר בכן אם אתה מבקש תוכנית שתעמוד בתיקייות ה-phpBB';
	$lang['Forum_link_hit_count']					= 'מונה לחיצות';
	$lang['Forum_link_hit_count_explain']			= 'בחר בכן אם אתה רוצה שמערכת תספור ותציג את מספר הלחיצות על הקישור';
	$lang['Forum_link_with_attachment_deny']		= 'אתה לא יכול לקבוע פורום כקישור שהוא כבר בעל תת-רמות';
	$lang['Forum_link_with_topics_deny']			= 'אתה לא יכול לקבוע פורום כקישור אם כבר יש בו נושאים';
	$lang['Forum_attached_to_link_denied']			= 'אתה לא יכול לצרף פורום או קטגוריה לפורום קישור';

	$lang['Manage_extend']							= 'ניהול +';
	$lang['No_subforums']							= 'אין תת-פורומים';
	$lang['Forum_type']								= 'בחר את סוג הפורום שאתה רוצה';
	$lang['Presets']								= 'קבע מראש';
	$lang['Refresh']								= 'רענן';
	$lang['Position_after']							= 'שים פורום זה לאחר';
	$lang['Link_missing']							= 'הקישור שגוי';
	$lang['Category_with_topics_deny']				= 'הנושאים נשארים בפורום זה. אתה לא יכול להכניס אותם לתוך קטגוריה.';
	$lang['Recursive_attachment']					= 'אתה לא יכול לצרף פורום לרמה נמוכה יותר של עץ הפורומים שלו (צירוף בלתי הגיוני)';
	$lang['Forum_with_attachment_denied']			= 'אתה לא יכול לשנות קטגוריה עם פורומים שצורפו לתוך פורום';
	$lang['icon']									= 'אייקון';
	$lang['icon_explain']							= 'אייקון זה יוצג לפני כותרת הפורום. אתה יכול לקבוע כתובת ישירה או מפתח הרישום $image[] (ראה <i>your_template</i>/<i>your_template</i>.cfg).';

	// merging of Categories Hierarchy ACP and Points MOD
	$lang['Yes']									= 'כן';
	$lang['No']										= 'לא';
	$lang['Forum_points']							= 'כבה את ' . $board_config['points_name'];
}

$lang['Forum_link']					= 'כתובת להפנייה';
$lang['Forum_link_visited']			= 'קישור זה בוקר %d פעמים';
$lang['Redirect']					= 'הפנייה';
$lang['Redirect_to']				= 'אם הדפדפן שלך לא תומך בהפניית meta לחץ %sכאן% כדי לפנות';

$lang['Use_sub_forum']				= 'חבילת אינדקס';
$lang['Hierarchy_setting']			= 'הגדרות תת קטגוריות';
$lang['Index_packing_explain']		= 'בחר את רמת החבילה שאתה רוצה לאינדקס';
$lang['Medium']						= 'בינוני';
$lang['Full']						= 'מלא';
$lang['Split_categories']			= 'פצל קטגוריות באינדקס';
$lang['Use_last_topic_title']		= 'הראה את כותרות הנושאים האחרונים באינדקס';
$lang['Last_topic_title_length']	= 'אורך הכותרת של הנושא האחרון באינדקס';
$lang['Sub_level_links']			= 'קישורי תת-רמות באינדקס';
$lang['Sub_level_links_explain']	= 'הוסף את הקישורים לתת-הרמות בתיאור הפורום או הקטגוריה';
$lang['With_pics']					= 'עם אייקונים';
$lang['Display_viewonline']			= 'הצג תיבת פרטי מי מחובר באינדקס';
$lang['Never']						= 'לעולם לא';
$lang['Root_index_only']			= 'באינדקס הראשי בלבד';
$lang['Always']						= 'תמיד';
$lang['Subforums']					= 'תת-פורומים';

//-- mod : today at   yesterday at ------------------------------------------------------------------------ 
//-- add 
$lang['Today_at'] = '<b>היום</b> ב-%s'; // %s is the time 
$lang['Future'] = '[ <b>עתיד</b> ]<br /> %s'; // %s is the time 
$lang['Yesterday_at'] = '<b>אתמול</b> ב-%s'; // %s is the time 
//-- end mod : today at   yesterday at ------------------------------------------------------------------------ 

?>