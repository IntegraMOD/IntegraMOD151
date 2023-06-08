<?php
/***************************************************************************
 *						lang_extend_merge.php [Hebrew]
 *						-------------------------------
 *	begin				: 28/09/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 1.0.1 - 21/10/2003
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
	$lang['Lang_extend_merge'] = 'איחוד תחבירים פשוט';
}

$lang['Refresh'] = 'רענן';
$lang['Merge_topics'] = 'אחד נושאים';
$lang['Merge_title'] = 'כותרת הנושא החדש';
$lang['Merge_title_explain'] = 'זו תהיה הכותרת החדשה של הנושא הסופי. השאר ריק אם אתה רוצה שמערכת תשתמש בכותרת של תיאור הנושא';
$lang['Merge_topic_from'] = 'נושא לאיחוד';
$lang['Merge_topic_from_explain'] = 'נושא זה יאוחד לנושא אחר. אתה יכול להכניס את ה-id של הנושא, הכתובת של הנושא, או כתובת של הודעה בנושא זה';
$lang['Merge_topic_to'] = 'נושא המטרה';
$lang['Merge_topic_to_explain'] = 'נושא זה יקבל את כל ההודעות של הנושא הקודם. אתה יכול להכניס את ה-id של הנושא, את הכתובת של הנושא, או את הכתובת של הודעה בנושא';
$lang['Merge_from_not_found'] = 'הנושא לאיחוד לא נמצא';
$lang['Merge_to_not_found'] = 'נושא המטרה לא נמצא';
$lang['Merge_topics_equals'] = 'אתה לא יכול לאחד נושא עם עצמו';
$lang['Merge_from_not_authorized'] = 'אתה לא רשאי לנהל נושאים הבאים מהפורום של הנושא לאיחוד';
$lang['Merge_to_not_authorized'] =  'אתה לא רשאי לנהל נושאים הבאים מהפורום של נושא המטרה';
$lang['Merge_poll_from'] = 'ישנו סקר בנושא לאיחוד. הוא יועתק לנושא המטרה';
$lang['Merge_poll_from_and_to'] = 'בנושא המטרה כבר יש סקר. הסקר של הנושא לאיחוד ימחק';
$lang['Merge_confirm_process'] = 'אתה בטוח שאתה רוצה לאחד את <br />"<b>%s</b>"<br />אל<br />"<b>%s</b>"';
$lang['Merge_topic_done'] = 'הנושאים אוחדו בהצלחה.';
$lang['Leave_shadow_topic'] = 'השאר עותק נושא בפורום הישן.';

?>