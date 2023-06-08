<?php
/***************************************************************************
 *						lang_extend_topic_calendar.php [Hebrew]
 *						------------------------------
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
	$lang['Lang_extend_topic_calendar'] = 'נושא לוח שנה';
}

$lang['Calendar']				= 'לוח שנה';
$lang['Calendar_scheduler']		= 'לוח זמנים';
$lang['Calendar_event']			= 'אירוע לוח שנה';
$lang['Calendar_from_to']		= 'מ-%s עד %s (כולל)';
$lang['Calendar_time']			= '%s';
$lang['Calendar_until']			= 'עד';

$lang['Calendar_settings']		= 'הגדרות לוח השנה';
$lang['Calendar_header_cells']	= 'מספר תאים להצגה בכותרת המערכת (0 לללא הצגה)';
$lang['Calendar_title_length']	= 'אורך הכותרת המוצגת בתאי לוח השנה';
$lang['Calendar_text_length']	= 'אורך הטקסט המוצג בחלונות הצפייה המהירה';
$lang['Calendar_display_open']	= 'הצג את שורת לוח השנה בכותרת המערכת פתוחה';
$lang['Calendar_nb_row']		= 'מספר שורה ליום בכותרת המערכת';
$lang['Calendar_birthday']		= 'הצג יום הולדת בלוח השנה';
$lang['Calendar_forum']			= 'הצג את שם הפורום תחת כותרת הנושא ב-scheduler';

$lang['Sorry_auth_cal']			= 'סליחה, אבל רק %s יכולים לשלוח אירועי לוח שנה בפורום זה.';
$lang['Date_error']				= 'יום %d, חודש %d, שנה %d זה לא תאריך תקף';

$lang['Event_time']				= 'זמן האירוע';
$lang['Minutes']				= 'דקות';
$lang['Today']					= 'היום';
$lang['All_events']				= 'כל האירועים';

$lang['Rules_calendar_can']		= 'אתה <b>יכול</b> לשלוח אירועי לוח שנה בפורום זה';
$lang['Rules_calendar_cannot']	= 'אתה <b>לא יכול</b> לשלוח אירועי לוח שנה בפורום זה';

$lang['Repeat_mode']			= 'חזור על';
$lang['Months']					= 'חודשים';
$lang['Weeks']					= 'שבועות';
$lang['Years']					= 'שנים';
$lang['Months_week']			= 'חודשים ביום חול שני';
?>