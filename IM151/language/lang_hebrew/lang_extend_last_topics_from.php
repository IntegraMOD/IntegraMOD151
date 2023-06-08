<?php
/***************************************************************************
 *						lang_extend_last_topic_from.php [Hebrew]
 *						-------------------------------
 *	begin				: 28/09/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 1.0.0 - 19/10/2003
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
	$lang['Lang_extend_last_topics_from'] = 'נושאים אחרונים מ-';
}

$lang['Topic_last']						= 'נושאים אחרונים';
$lang['Topic_last_settings']			= 'נושאים אחרונים ממשתמש';
$lang['Topic_last_started']				= 'נושאים אחרונים שהותחלו על-ידי %s';
$lang['Topic_last_started_title']		= 'נושאים אחרונים שהותחלו על-ידי משתמש';
$lang['Topic_last_started_explain']		= 'קבע כאן את מספר הנושאים האחרונים שמשתמש התחיל שאתה רוצה להציג בצפיית הפרופיל. 0 אומר ללא הצגה.';
$lang['Topic_last_replied']				= 'נושאים אחרונים ש-%s הגיב אליהם';
$lang['Topic_last_replied_title']		= 'נושאים אחרונים שמשתמש הגיב להם';
$lang['Topic_last_replied_explain']		= 'קבע כאן את מספר הנושאים האחרונים שאליהם משתמש הגיב שאתה רוצה להציג בצפיית הפרופיל. 0 אומר ללא הצגה.';
$lang['Topic_last_ended']				= 'נושאים אחרונים ש-%s סיים';
$lang['Topic_last_ended_title']			= 'נושאים אחרונים שמשתמש סיים';
$lang['Topic_last_ended_explain']		= 'קבע כאן את מספר הנושאים האחרונים שבהם המשתמש שלח את התגובה האחרונה שאתה רוצה להציגה בצפיית הפרופיל. 0 אומר ללא הצגה.';
$lang['Topic_last_split']				= 'פצל את הנושאים לכל סוג';
$lang['Topic_last_split_explain']		= 'הוסף שורת הבדלה בתיבות כל סוג נושאים (הכרזות, נושאים, ועוד).';
$lang['Topic_last_forum']				= 'פורום';
$lang['Topic_last_forum_explain']		= 'הצג את כותרת הפורום שבה הנושא נמצא תחת כותרת הנושא';

?>