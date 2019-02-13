<?php
/***************************************************************************
 *						lang_extend_sub_template.php [Hebrew]
 *						----------------------------
 *	begin				: 28/09/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 1.0.4 - 28/10/2003
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
	$lang['Lang_extend_sub_template']	= 'תת-ערכות';

	$lang['Subtemplate']				= 'תת-ערכות';
	$lang['Subtemplate_explain']		= 'כאן תוכל לצרף תת-ערכות לקטגוריה או פורום';
	$lang['Choose_main_style']			= 'בחר עיצוב ראשי';
	$lang['main_style']					= 'עיצוב ראשי';
	$lang['subtpl_name']				= 'שם תת-הערכה';
	$lang['subtpl_dir']					= 'תיקיית תת-הערכה';
	$lang['subtpl_imagefile']			= 'קובץ הגדרות תמונות';
	$lang['subtpl_create']				= 'הוסף תת-ערכה חדשה';
	$lang['subtpl_usage']				= 'תת-ערכות בשימוש ב-';
	$lang['Select_dir']					= 'בחר תיקייה';

	$lang['subtpl_error_name_missing']	= 'שם תת-הערכה שגוי';
	$lang['subtpl_error_dir_missing']	= 'תיקיית תת-הערכה שגוייה';
	$lang['subtpl_error_no_selection']	= 'לא נבחר דבר לשייך לתת-ערכה זו';

	$lang['subtpl_click_return']		= 'העדכון נעשה. לחץ %sכאן%s כדי לחזור לניהול תתי-ערכות';
}

?>