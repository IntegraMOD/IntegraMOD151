<?php
/***************************************************************************
 *						lang_extend_lang_extend.php [Hebrew]
 *						-------------------------------------
 *	begin				: 29/09/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 1.0.1 - 16/10/2003
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
	$lang['Lang_extend_lang_extend'] = 'סיומת לחבילות השפה';
	$lang['Lang_extend__custom'] = 'חבילת שפה מותאמת';
	$lang['Lang_extend__phpBB'] = 'חבילת שפה של phpBB';

	$lang['Languages'] = 'שפות';
	$lang['Lang_management'] = 'ניהול';
	$lang['Lang_extend'] = 'ניהול קבצי ה-Lang extend';
	$lang['Lang_extend_explain'] = 'כאן תוכל להוסיף או לערוך רישומי מפתח';
	$lang['Lang_extend_pack'] = 'חבילת שפה';
	$lang['Lang_extend_pack_explain'] = 'זהו שם החבילה, בדרך כלל שם המוד המתיחס ל-';

	$lang['Lang_extend_entry'] = 'מפתח רישום השפה';
	$lang['Lang_extend_entries'] = 'מפתחות רישומי השפות';
	$lang['Lang_extend_level_admin'] = 'מנהל ראשי';
	$lang['Lang_extend_level_normal'] = 'רגיל';

	$lang['Lang_extend_add_entry'] = 'הוסף מפתח רישום שפה חדש';

	$lang['Lang_extend_key_main'] = 'מפתח רישום שפה ראשית';
	$lang['Lang_extend_key_main_explain'] = 'זהו מפתח הרישום הראשי, בדרך כלל אחד בלבד';
	$lang['Lang_extend_key_sub'] = 'מפתח רישום משני';
	$lang['Lang_extend_key_sub_explain'] = 'זהו מפתח הרישום המשני שבדרך כלל לא משומש';
	$lang['Lang_extend_level'] = 'רמת מפתח רישום השפה';
	$lang['Lang_extend_level_explain'] = 'רמת מנהל ראשי יכולה להיות בשימוש בלוח הגדרות הניהול הראשי בלבד. רמה רגילה יכול להיות בשימוש בכל מקום.';

	$lang['Lang_extend_missing_value'] = 'אתה צריך לספק לפחות את ערך האנגלית';
	$lang['Lang_extend_key_missing'] = 'מפתח הרישום הראשי שגוי';
	$lang['Lang_extend_duplicate_entry'] = 'רישום זה כבר קיים (ראה חבילת %)';

	$lang['Lang_extend_update_done'] = 'הרישום עודכן בהצלחה.<br /><br />לחץ %sכאן%s כדי לחזור לרישום.<br /><br />לחץ %sכאן%s כדי לחזור לרשימת הרישומים';
	$lang['Lang_extend_delete_done'] = 'הרישום נמחק בהצלחה.<br />שים לב שרק מפתחות רישומים מסודרות נפתחו, ולא מפתחות הרישומים היסודיים אם קיימים.<br /><br />לחץ %sכאן%s כדי לחזור לרשימת הרישומים';

	$lang['Lang_extend_search'] = 'חפש במפתחות רישומי שפה';
	$lang['Lang_extend_search_words'] = 'מילים לחיפוש';
	$lang['Lang_extend_search_words_explain'] = 'הפרד מילים עם פסיק';
	$lang['Lang_extend_search_all'] = 'כל המילים';
	$lang['Lang_extend_search_one'] = 'אחד מהם';
	$lang['Lang_extend_search_in'] = 'חפש ב';
	$lang['Lang_extend_search_in_explain'] = 'מיקום מדוייק לחיפוש';
	$lang['Lang_extend_search_in_key'] = 'מפתחות';
	$lang['Lang_extend_search_in_value'] = 'ערכים';
	$lang['Lang_extend_search_in_both'] = 'שניהם';
	$lang['Lang_extend_search_all_lang'] = 'כל השפות הותקנו';

	$lang['Lang_extend_search_no_words'] = 'אין מילים לחיפוש שסופק.<br /><br />לחץ %sכאן%s כדי לחזור לרשימת החבילות.';
	$lang['Lang_extend_search_results'] = 'תוצאות חיפוש';
	$lang['Lang_extend_value'] = 'ערך';
	$lang['Lang_extend_level_leg'] = 'רמה';

	$lang['Lang_extend_added_modified'] = '*';
	$lang['Lang_extend_modified'] = 'שונה';
	$lang['Lang_extend_added'] = 'נוסף';
}

?>