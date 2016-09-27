<?php
/***************************************************************************
 *						lang_extend_announces.php [Hebrew]
 *						-------------------------
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
	$lang['Lang_extend_announces'] = 'מערכת הכרזות';
}

$lang['Board_announcement']						= 'מערכת הכרזות';
$lang['announcement_duration']					= 'משך זמן ההכרזה';
$lang['announcement_duration_explain']			= 'זה מספר הימים שבה ההכרזה תשאר. השתמש ב-1- כדי לקבוע אותה לצמיתות';
$lang['Announce_settings']						= 'הכרזות';
$lang['announcement_date_display']				= 'הצג תאריכי הכרזות';
$lang['announcement_display']					= 'הצג מערכת הכרזות באינדקס';
$lang['announcement_display_forum']				= 'הצג מערכת הכרזות בפורומים';
$lang['announcement_split']						= 'פצל סוג הכרזה בתיבת מערכת ההכרזות';
$lang['announcement_forum']						= 'הצג את שם הפורום תחת כותרת ההכרזה בתיבת מערכת ההכרזות';
$lang['announcement_prune_strategy']			= 'שיטת איפוס הכרזה';
$lang['announcement_prune_strategy_explain']	= 'זהו סוג ההכרזה לאחר איפוסה';

$lang['Global_announce']						= 'הכרזה גלובאלית';
$lang['Sorry_auth_global_announce']				= 'סליחה, אבל רק %s יכולים לשלוח הכרזות גלובאליות בפורום זה.';
$lang['Post_Global_Announcement']				= 'הכרזה גלובאלית';
$lang['Topic_Global_Announcement']				= '<b>[ הכרזה גלובאלית ]</b>';

$lang['Announces_from_to']						= '(מ-%s עד-%s)';

?>