<?php
/***************************************************************************
 *						lang_extend_post_icons.php [Hebrew]
 *						--------------------------
 *	begin				: 28/09/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 1.0.1 - 28/10/2003
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
	$lang['Lang_extend_post_icons']		= 'אייקונים להודעה';

	$lang['Icons_settings_explain']		= 'כאן אתה יכול להוסיף, לערוך או למחוק אייקונים להודעות';
	$lang['Icons_auth']					= 'רמת גישה';
	$lang['Icons_auth_explain']			= 'אייקון זה יהיה זמין רק למשתמשים המתאימים לדרישה זו';
	$lang['Icons_defaults']				= 'משימה ברירת מחדל';
	$lang['Icons_defaults_explain']		= 'משימות אלא ישמשו ברשימות הנושא כאשר אין אייקון המוגדר לנושא';
	$lang['Icons_delete']				= 'מחק אייקון';
	$lang['Icons_delete_explain']		= 'בחר אייקון כדי להחליף אותו באחד זה :';
	$lang['Icons_confirm_delete']		= 'אתה בטוח שאתה רוצה למחוק אחד זה ?';

	$lang['Icons_lang_key']				= 'כותרת האייקון';
	$lang['Icons_lang_key_explain']		= 'כותרת האייקון תוצג כאשר המשתמש שם את העכבר שלו על האייקון (הצהרות title או alt של HTML). אתה יכול להשתמש בטקסט, או במפתח של מערך השפה. <br />(בדוק language/lang_<i>your_language</i>/lang_main.php).';
	$lang['Icons_icon_key']				= 'אייקון';
	$lang['Icons_icon_key_explain']		= 'כתובת האייקון או מפתח למערך התמונות. <br />(בדוק templates/<i>your_template</i>/<i>your_template</i>.cfg)';

	$lang['Icons_error_title']			= 'כותרת האייקון ריקה';
	$lang['Icons_error_del_0']			= 'אתה לא יכול להסיר את האייקון הריק כברירת מחדל';

	$lang['Refresh']					= 'רענן';
	$lang['Usage']						= 'שימוש';

	$lang['Image_key_pick_up']			= 'שים מפתח תמונה';
	$lang['Lang_key_pick_up']			= 'שים מפתח שפה';
}

$lang['Icons_settings']			= 'אייקונים להודעות';
$lang['Icons_per_row']			= 'אייקונים לשורה';
$lang['Icons_per_row_explain']	= 'קבע כאן את מספר האייקונים המוצגים בכל שורה בתצוגת טופס השליחה';
$lang['post_icon_title']		= 'אייקון ההודעה';
// icons
$lang['icon_none']				= 'אין איקון';
$lang['icon_note']				= 'הודעה';
$lang['icon_important']			= 'חשוב';
$lang['icon_idea']				= 'רעיון';
$lang['icon_warning']			= 'אזהרה !';
$lang['icon_question']			= 'שאלה';
$lang['icon_cool']				= 'מגניב';
$lang['icon_funny']				= 'מצחיק';
$lang['icon_angry']				= 'כועס !';
$lang['icon_sad']				= 'עצוב !';
$lang['icon_mocker']			= 'מלגלג !';
$lang['icon_shocked']			= 'המום !';
$lang['icon_complicity']		= 'קורץ';
$lang['icon_bad']				= 'לא טוב !';
$lang['icon_great']				= 'טוב !';
$lang['icon_disgusting']		= 'מבולבל !';
$lang['icon_winner']			= 'מחייך !';
$lang['icon_impressed']			= 'צוחק !';
$lang['icon_roleplay']			= 'ספר';
$lang['icon_fight']				= 'קרב';
$lang['icon_loot']				= 'גזילה';
$lang['icon_picture']			= 'תמונה';
$lang['icon_calendar']			= 'אירוע לוח שנה';

?>