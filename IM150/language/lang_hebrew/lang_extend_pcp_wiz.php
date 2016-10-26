<?php
/***************************************************************************
 *						lang_extend_pcp_wiz.php [Hebrew]
 *						---------------------------------------
 *	begin				: 21/03/2005 (dd/mm/yyyy)
 *	copyright		: Ptirhiik / ednique
 *	email				: ptirhiik@clanmckeen.com / edwin@ednique.com
 *
 *	version			: 0.0.1 - 21/03/2005
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
	// addded by edwin :: PCP Wiz
	$lang['PCP_10_wizard'] = 'אשף לוח הבקרה לפרופיל';
	$lang['PCP_10_wizard_explain'] = 'אנו ניסינו לעשות את ניהול לוח הבקרה לפרופיל קצת יותר קל. אני מקווה שאתה אוהב זאת.';
	$lang['Wiz_mode_error'] = 'המצב <span class="explaintitle">%s</span> לא נתמך.';
	$lang['Wiz_buddylist'] = 'רשימת חברים מהירה';
	$lang['Wiz_buddylist_description'] = 'כאן אתה יכול לשנות את הסדר, ברירות המחדל או שדות דרושים של עמוד רשימת החברים האישית/רשימת ההתעלמות/רשימת החברים.';
	$lang['Wiz_buddylist_explain'] = '<span class="explaintitle">שם שדה</span>: לחץ על השם כדי לשנות את פרטי השדה הבסיסיים.<br><span class="explaintitle">סדר</span>: זהו הסדר שבהן השדות מופיעות ברשימה. שנה את המספר כדי להעביר את השדות.<br><span class="explaintitle">ברירת מחדל</span>: כאשר המשתמש לעולם לא בחר שדות להצגה, שדה זה יוצג כברירת מחדל.<br><span class="explaintitle">דרוש</span>: דרוש שדה זה כדי להציג תמיד ברשימה.<br><span class="explaintitle">בחירה ציבורית</span>: שדה זה יכול להבחר על-ידי המשתמשים.<br><span class="explaintitle">מוסתר</span>: שדה זה תמיד נשלח כמוסתר. השאר שדות אלו ריקים אם אתה רוצה שחלק רשימת החברים האישית/רשימת ההתעלמות תעבוד.<br><span class="explaintitle">שליחה</span>: לחיצה על כפתור זה תשמור את השינויים שלך והודעה תוצג כדי להודיע אם השינויים הצליחו או לא. סדר המספרים ישונה אוטומטית במקרה שהם לא נשלחו כראוי.<br>';
	$lang['Default'] = 'ברירת מחדל';
	$lang['Forced'] = 'דרוש';
	$lang['Selectable'] = 'בחירה ציבורית';
	$lang['Update_success'] = 'קבצי לוח הבקרה לפרופיל עודנו בהצלחה.';
	$lang['Wiz_addremovefields'] = 'הוסף / הסר שדות עמוד';
	$lang['Wiz_addremovefields_description'] = 'כאן אתה יכול להוסיף או להסיר שדות מעמוד וגם לשנות את סדר השדה.';
	$lang['Wiz_addremovefields_explain'] = '<span class="explaintitle">בחר עמוד</span>: בחר את העמוד שאתה רוצה לערוך מתיבת הרשימה הנגללת ולחץ על כפתור הבחירה. הודעה תופיעה המציג את העמוד הנבחר. במקרה שהעברת את השדות בצורה רעה אתה יכול ללחוץ פשוט על בחר שוב כדי לטעון מחדש את הערכים התחיליים כל עוד לא לחצת שליחה.<br><span class="explaintitle">שנה הצגת עמוד</span>: מוצג רק אם מתאים. בחר עמוד ואז לחץ על כפתור זה כדי לשנות את הסדר שבהם השדות מוצגים בעמוד.<br><span class="explaintitle">שנה הצגת טופס</span>: מוצג רק אם מתאים. בחר עמוד ואז לחץ על כפתור זה כדי לשנות את הדרך שבהם שדות הקלט מוצגות בטופס.<br><span class="explaintitle">שדות זמינים</span>: כאן אתה רואה תיבת בחירה מרובה המכילה את כל השדות הזמונות שלא הושמו בעמוד הנבחר. אתה יכול לבחור 1 או יותר שדות כדי להעביר אותם לעמוד הנבחר על-ידי שימוש בשילוב "SHIFT + לחיצה", "CTRL + לחיצה" או שילוב "לחיצה + העברה".<br><span class="explaintitle">פעולות</span>: לחץ "->" כדי להוסיף שדות לעמוד לאחר בחירתם בתיבת השדות הזמינים הראשונה. לחץ "<-" כדי להסיר שדות מהעמוד לאחר בחירתם בתיבת השדות הנבחרים הראשונה.<br><span class="explaintitle">שדות נבחרים</span>: כאן אתה רואה תיבת בחירה מרובה המכילה את כל השדות שהושמו בעמוד הנבחר. אתה יכול לבחור 1 או יותר שדות כדי להסיר אותם מהעמוד הנבחר על-ידי שימוש בשילוב "SHIFT + לחיצה", "CTRL + לחיצה" או על-ידי שילוב "לחיצה + העברה".<br><span class="explaintitle">העבר למעלה/למטה</span>: כאשר אתה בוחר אחד או יותר שדות בתיבת השדות הנבחרים אתה יכול להשתמש באותם כפתורים כדי להעביר אותם למעלה או למטה בתיבה. השדות יוצגו בעמוד הנבחר באותו סדר.<br><span class="explaintitle">שליחה</span>: לחיצה על כפתור זה תשמור את השינויים שלך והעבר אותך לעמוד אחר שבו תוכל לבחור את הדרך שבהן השדות מוצגות העמוד הנבחר.<br><span class="explaintitle">??</span>: כאשר אתה בוחר שדה אחד בתיבת הרשימה ואז לוחץ על כפתור זה, חלון חדש יוקפץ עם יותר מידע על אותו שדה. אתה תראה את התיאור שלו, באיזה עמוד הוא בשימוש ואם אפשרי, דוגמא של כיצד הוא נראה באותם עמודים.<br>';
	$lang['Map_selected'] = 'בחרת את העמוד <strong>%s</strong>';
	$lang['Move_up'] = 'העבר למעלה';
	$lang['Move_down'] = 'העבר למטה';
	$lang['Wiz_showfieldinfo'] = 'פרטי השדה';
	$lang['Wiz_showfieldinfo_description'] = 'כאן אתה רואה את פרטי השדה הנבחר.';
	$lang['Wiz_showfieldinfo_explain'] = '<span class="explaintitle">עמודים</span>: לחץ על קישור העמוד כדי לשנות את הצגת השדה שלך באותו עמוד.<br><span class="explaintitle">שם השדה</span>: לחץ על שם השדה כדי לשנות את פרטי השדה הבסיסיים.<br>';
	$lang['Pages'] = 'עמודים';
	$lang['Select_page'] = 'בחר עמוד:';
	$lang['Select'] = 'בחר';
	$lang['Available_fields'] = 'שדות זמינים';
	$lang['Action'] = 'פעולה';
	$lang['Selected_fields'] = 'שדות נבחרים';
	$lang['Default_Output'] = 'תצוגה ברירת מחדל';
	$lang['Always_display'] = 'הצג תמיד';
	$lang['Wiz_outputlist'] = 'שנה הצגת עמוד';
	$lang['Wiz_outputlist_description'] = 'כאן אתה יכול לשנות את הדרך שבהם השדות בעמוד מוצגות.';
	$lang['Wiz_outputlist_explain'] = '<span class="explaintitle">בחר עמוד</span>: בחר את העמוד שאתה רוצה לערוך מתיבת הרשימה הנגללת ולחץ על הכפתור בחר. הודעה תופיעה המציגה את העמוד שבחרת. במקרה שהעברת את השדות בצורה רעה אתה יכול פשוט ללחוץ על בחר שוב כדי לטעון מחדש את ערכי התחילית כל עוד לא לחצת שליחה.<br><span class="explaintitle">הוסף / הסר שדות עמוד</span>: בחר עמוד ואז לחץ על כפתור זה כדי להוסיף שדות או להסיר שדות מאותו עמוד.<br><span class="explaintitle">שדה</span>: שם השדה ותיאור אם זמין. לחץ על השם כדי לשנות את פרטי השדה הבסיסיים.<br><span class="explaintitle">אפשרויות</span>: כאן אתה יכול לבחור את האפשרויות לכל שדה.<br><span class="explaintitle">אורך</span>: סמן תיבה זו כדי להציג את אורך השדה. האורך הוא התיאור המוצג בצד ימין תחת שם השדה.<br><span class="explaintitle">טקסט</span>: סמן תיבה זו כדי להציג את הערך כטקסט פשוט.<br><span class="explaintitle">תמונה</span>: סמן תיבה זו כדי להציג את הערך כתמונה.<br><span class="explaintitle">שורה</span>: סמן תיבה זו כאשר סימנת גם את טקסט וגם את תמונה והטקסט יופיע תחת התמונה במקום ליד התמונה.<br><span class="explaintitle">סגנון HTML</span>: כאן אתה יכול להוסיף כמה קוד HTML כדי לשנות את התצוגה. השאר ריק אם לא נדרש. אתה צריך לשים <em>%s</em> במקום ה-HTML שלך היכן שערך השדה יושם. השתמש רק ב <em>%s</em> אחד ואל תשתמש ב <em>%</em> במקום ה-HTML שלך.<br><span class="explaintitle">פונקצית תצוגה</span>: כאן אתה יכול לבחרו פונקציה מואמת להצגה לניהול התצוגה. אם אתה לא צריך אחד, אתה צריך לבחור <em>הצג ברירת מחדל</em>. בזמן יצירת תצוגת הפונקציה המותאמת שלך, שם הפונקציה צריך להתחיל עם <em>pcp_output_</em> ולהעלות את הפונקציה לפני הייבוא לעמוד זה.<br><span class="explaintitle">הצג כאשר</span>: אפשרות זו תנהל למי השדה יוצג. כאשר המשתמש בחר <em>כן</em> או <em>חברים בלבד</em> בפרופיל שלו לשאלה שנבחרה, אנשים אחרים יוכלו לראות את ערך השדה. בחר <em>הצג תמיד</em> כדי להציג תמיד את השדה. למשל: בחר <em>הצג תמיד את כתובת הדואר האלקטרוני שלי</em> לפלט של כתובת הדואר האלקטרוני.<br><span class="explaintitle">דוגמה</span>: אם אפשרי, אתה תראה תיבה המבוססת על כמה נתונים מזוייפים, אז לא תבהל אם הערך המוצג הוא לא הערך שלך.<br><span class="explaintitle">שליחה</span>: לחיצה על כפתור זה תשמור את השינויים שלך והודעה תוצג אם השינויים הצליחו או לא.<br>';
	$lang['Display_when'] = 'הצג כאשר';
	$lang['Nextline'] = 'שורה';
	$lang['Html_style'] = 'סגנון HTML';
	$lang['Extra'] = 'נוסף';
	$lang['Example'] = 'דוגמה';
	$lang['Confirm_message'] = 'אתה בטוח שאתה להתילם מהשינויים שלך?\\n\\nאישור = כן, התעלם מהשינויים שלי.\\n\\nביטול = לא, תן לי ללחוץ שליחה ראשון.';
	$lang['Wiz_inputlist'] = 'שנה הצגת טופס';
	$lang['Wiz_inputlist_description'] = 'כאן אתה יכול לשנות את הדרך שבהם שדות הקלט בטופס מוצגים.';
	$lang['Wiz_inputlist_explain'] = '<span class="explaintitle">בחר עמוד</span>: בחר את העמוד שאתה רוצה לערוך מתיבת הרשימה הנגללת ולחץ על הכפתור בחר. הודעה תופיעה המציגה את העמוד שבחרת. במקרה שהעברת את השדות בצורה רעה אתה יכול פשוט ללחוץ על בחר שוב כדי לטעון מחדש את ערכי התחילית כל עוד לא לחצת שליחה.<br><span class="explaintitle">הוסף / הסר שדות עמוד</span>: בחר עמוד ואז לחץ על כפתור זה כדי להוסיף שדות או להסיר שדות מאותו עמוד.<br><span class="explaintitle">שדה</span>: שם השדה ותיאור אם זמין. לחץ על השם כדי לשנות את פרטי השדה הבסיסיים.<br><span class="explaintitle">רמת גישה</span>: מינמום רמת הדישה שהמשתמש שלך צריך כדי לראות את שדה הקלט. <em>אורח בלבד</em> בשדה מוצג רק לאורחים שבשימוש בעמוד ההרשמה לבקרת התמונה. <br><span class="explaintitle">אפשרויות</span>: כאן אתה יכול לבחור את האפשרויות לכל שדה.<br><span class="explaintitle">שדה דרוש</span>: סמן תיבה זו כדי לעשות את השדה דרוש. השדה יסומן כנדרש ומשתמשים קיימים שלא השלימו שדה זה לא יוכלו לדפדף בפורומים אלא אם כן הם השלימו את השדה.<br><span class="explaintitle">הצג חזותית</span>: סמן תיבה זו כדי להציג את החזותיות של שדה הקלט. זה יספר למשתמש שיכול לראות את הנתונים שהם על השליחה. לדוגמא: <em>(הצג לחברים בלבד)</em><br><span class="explaintitle">סגנון TPL</span>: הוסף ערך כאן כדי לתת שדה קלט בעיצוב אחר כמו למשל שדה החוקים. השם שהוקלד צריך להיות בשימוש ב-board_config_body.tpl בעזרת ה <em>&lt;!-- BEGIN inputstyle --&gt;</em> ו- <em>&lt;!-- END inputstyle --&gt;</em> וה-HTML ביניהם יבוצע לשדה זה. השאר ריק לברירת מחדל שהיא <em>שדה</em>.<br><span class="explaintitle">סוג</span>: בחר אחד מאותם הסוגים לשדה שלך.<br><span class="explaintitle">תיבת טקסט</span>: זה יציג תיבת טקסט או איזור טקסט לשדה שלך.<br><span class="explaintitle">רשימה נגללת</span>: זה יציג תיבת רשימה נגללת לשדה שלך. אתה צריך גם להפריד את <em>רשימת הערכים</em><br><span class="explaintitle">כפתורי רדיו</span>: זה יציג כפתור רדיו לכל ערך אפשרי של השדה שלך. אתה צריך גם להפריד את <em>רשימת הערכים</em><br><span class="explaintitle">השתמש בפונקציות</span>: אתה תצטרך לציין פונקצית get ופונקצית chk כדי להציג ולאשר שדה זה.<br><span class="explaintitle">נוסף</span>: תלוי בסוג שבחרת, אתה תראה כמה אפשרויות נוספות.<br><span class="explaintitle">רשימת ערכים</span>: בחר את רשימת הערכים שבשימוש.<br><span class="explaintitle">פונקצית Get</span>: בחר את הפונקציה להצגת השדה. צור פונקציה ושנה אם שמה לכמו <em>mods_get_YOURNAME</em> או <em>mods_settings_get_YOURNAME</em> לפני הייבוא לעמוד זה.<br><span class="explaintitle">פונקצית Check</span>: בחר את הפונקציה לאישור השדה. צור פונקציה ושנה את שמה לכמו <em>mods_check_YOURNAME</em> או <em>mods_settings_check_YOURNAME</em> לפני הייבוא לעמוד זה.<br><span class="explaintitle">דוגמה</span>: אתה תראה דוגמה המבוססת על כמה נתונים מזוייפים, אז אל תבהל אם הנתונים המוצגים הם לא הערך שלך.<br><span class="explaintitle">שליחה</span>: לחיצה על כפתור זה תשמור את השינויים שלך והודעה תוצג אם השינויים הצליחו או לא.<br>';
	$lang['Tpl_style'] = 'סגנון TPL';
	$lang['Textmode'] = 'תיבת טקסט';
	$lang['Dropmode'] = 'רשימה נגללת';
	$lang['Radiomode'] = 'כפתורי רדיו';
	$lang['Functmode'] = 'השתמש בפונקציות';
	$lang['File_permissions'] = 'לקובץ %s אין את הגדרות ההרשאות הנכונות <strong>(666)</strong>.';
	$lang['Wiz_validate'] = 'אשר קבצי לוח הבקרה לפרופיל';
	$lang['Wiz_validate_description'] = 'הפעולה תאשר את קבצי לוח הבקרה לפרופיל הנכונים ותזהיר בכל אי נכונות.';
	$lang['Missing_param'] = 'שגוי';
	$lang['Move2map'] = 'העבר 2 מפות';
	$lang['Move2field'] = 'העבר 2 שדות';
	$lang['Maptitle_missing'] = 'אנא הוסף כותרת למפה.';
	$lang['Wiz_fields'] = 'נהל שדות';
	$lang['Wiz_fields_description'] = 'כאן אתה יכול לשנות את פרטי השדה הבסיסיים וליצור שדות חדשים מבסיס הנתונים.';
	$lang['Wiz_fields_explain'] = '<span class="explaintitle">בחר שדה</span>: בחר את השדה שאתה רוצה לערוך מתיבת הרשימה הנגללת ולחץ על הכפתור בחר. הודעה תופיע המציגה את השדה שבחרת. במקרה שהעברת את השדות בצורה רעה אתה יכול פשוט ללחוץ על בחר שוב כדי לטעון מחדש את הערכים התחיליים כל עוד לא לחצת שליחה.<br><span class="explaintitle">פרטי השדה</span>: בחר שדה ואז לחץ על כפתור זה כדי לצפות בפרטי השדה והיכן הוא בשימוש.<br><span class="explaintitle">בחר שדה חדש</span>: כל השדות בטבלת המשתמשים שלא בשימוש בלוח הבקרה לפרופיל רשומות בתיבת הרשימה הנגללת. בחר את השדה שאתה רוצה להוסיף ולחץ על הכפתור בחר.<br><span class="explaintitle">אורך השדה</span>: הקלד את מפתח השפה שיהיה בשימוש כאורך השדה.<br><span class="explaintitle">הצג כאשר</span>: אפשרות זו תנהל למי השדה יוצג. כאשר המשתמש בחר <em>כן</em> או <em>חברים בלבד</em> בפרופיל שלו לשאלה שנבחרה, אנשים אחרים יוכלו לראות את ערך השדה. בחר <em>הצג תמיד</em> כדי להציג תמיד את השדה. למשל: בחר <em>הצג תמיד את כתובת הדואר האלקטרוני שלי</em> לפלט של כתובת הדואר האלקטרוני.<br><span class="explaintitle">סוג</span>: בחר אחד מאותם סוגי השדה שלך. זהו סוג הנתונים שבהם השדה שלך מחזיק. ליחד הרשימה הנגללת, אתה תראה את הסוג שמוגדר בבסיס הנתונים. סוג בסיס הנתוניןם לא מוצג למערכת השדות.<br><span class="explaintitle">רמת גישה</span>: מינמום רמת הדישה שהמשתמש שלך צריך כדי לראות את שדה הקלט. <em>אורח בלבד</em> בשדה מוצג רק לאורחים שבשימוש בעמוד ההרשמה לבקרת התמונה.<br><span class="explaintitle">הסבר השדה</span>: בשימוש לטפסי קלט. אתה יכול להוסיף טקסט נוסף מתחת לאורך השדה כדי לתת למשתמשים קצת הבסר למה שהם צריכים להקליד.<br><span class="explaintitle">תמונה</span>: הקלד את מפתח התמונה מהקובץ <em>fisubice.cfg</em>. בזמן בחירת <em>תמונה</em> כאפשרות ב <em>שנה הצגת עמוד</em> לשדה זה, תמונה זו תוצג אם <em>תצוגה ברירת מחדל</em> נבחר כ <em>פונקצית תצוגה</em>.<br><span class="explaintitle">כותרת התמונה</span>: הטקסט המוצג במעבר העכבר מעל התמונה.<br><span class="explaintitle">שליחה</span>: לחיצה על כפתור זה תשמור את השינויים שלך והודעה תוצג אם השינויים הצליחו או לא.<br>';
	$lang['Select_field'] = 'בחר שדה:';
	$lang['Field_selected'] = 'בחרת את השדה <strong>%s</strong>';
	$lang['Select_new_field'] = 'בחר שדה חדש:';
	$lang['Newfield_selected'] = 'בחרת את השדה החדש <strong>%s</strong>';
	$lang['Required_Error'] = 'השדות המסומנים עם %s נדרשים. אנא חזור והשלם את הטופס.';
	$lang['Wiz_autocorrect'] = '<a href="%s">לחץ כאן כדי לתקן אוטומטית את קבצי לוח הבקרה לפרופיל שלך.</a><br>קובץ גיבוי יווצר בתיקייה /profilcp/def/ אם הגדרות האבטחה שלך מאפשרות זאת.';
	$lang['Not_in_fields'] = 'השדה %s לא מוגדר ב-def_userfields...';
	$lang['Wiz_fieldimport'] = 'יבא שדות';
	$lang['Wiz_fieldimport_description'] = 'כאן אתה יכול ליבא את הגדרות השדה שנדרשות כדי לבצע את המודים.';
	$lang['Wiz_import_explain'] = 'לפעמים אתה תצטרך לשנות את קבצי לוח הבקרה לפרופיל בזמן הוספת מודים חדשים.<br>ממשק זה יאפשר לך לעשות זאת, אז אתה צריך לשאול את מחבר המוד כדי לספק את הפרטים הנדרשים להלן. רק ספק לו את הפרטים שלהלן והוא יוכל בקלות לספק את המידע הנדרש.<br>זה תרגול טוב להריץ את הפונקציה <strong>validate</strong> לאחר עדכון קבצי לוח הבקרה לפרופיל שלך ואם נדרש השתמש במאפיין התיקון האוטומטי.<br>במקרה שעדכנת את השדות הקשורים ל <strong>רשימת חברים אישית/רשימת התעלמות/רשימת חברים</strong>, אתה צריך לעבור ל <strong>רשימת חברים אישית מהירה</strong> ולשלוח את אותו עמוד (לא נדרש לשנות דבר).<br> <strong>קובץ גיבוי</strong> יווצר בתיקייה /profilcp/def/ אם הגדרות האבטחה שלך מאפשרות זאת. כדי להיות בטוח, אתה צריך תמיד לגבות ידנית תיקייה זו.';
	$lang['Type'] = 'סוג';
	$lang['Definition'] = 'הגדרה';
	$lang['Type_lists_title'] = 'רשימת הערכים';
	$lang['Type_lists_explain'] = 'אתה צריך ליצור אותו קוד שאתה היית שם במערך <strong>values_list</strong> אבל במקום השימוש בשם values_list, השתמש <strong>new_lists</strong>. <strong>$ לא מאופשר</strong> במקום הקוד ויצא ממנו. כאשר אתה שולח רשימה שכבר קיימת, אותה רשימה תעודכן עם הערכים החדשים שנשלחו. דוגמה:<pre>
new_lists = array(
		\'list_im_versions\' => array(
				\'values\' => array(
					0 => array(\'txt\' => \'1.2.x\', \'img\' => \'\'),
					1 => array(\'txt\' => \'1.3.1\', \'img\' => \'\'),
					2 => array(\'txt\' => \'1.3.2\', \'img\' => \'\'),
					3 => array(\'txt\' => \'1.3.2c\', \'img\' => \'\'),
					4 => array(\'txt\' => \'1.3.2d\', \'img\' => \'\'),
					5 => array(\'txt\' => \'1.3.2e\', \'img\' => \'\'),
					6 => array(\'txt\' => \'1.4.0\', \'img\' => \'\'),
				),
			),
		);</pre>';
	$lang['Type_classes_title'] = 'מחלקות<BR /> ל <em>הצג כאשר</em>';
	$lang['Type_classes_explain'] = 'אתה צריך ליצור את אותו קוד שאתה היית שם במערך <strong>classes_fields</strong> אבל במקום השימוש בשם classes_fields, השתמש <strong>new_classes</strong>. <strong>$ לא מאופשר</strong> במקום הקוד ויצא ממנו אוטומטית. כאשר אתה שולח מחלקה שכבר קיימת, אותה מחלקה תעודכן עם הערכים החדשים שנשלחו. דוגמה:
<pre>
new_classes = array(
		\'imversion\' => array(
				\'config_field\'	=> \'user_viewimversion\',
				\'admin_field\'	=> \'\',
				\'user_field\'	=> \'user_viewimversion\',
				\'sql_def\'		=> \'
				[USERS].user_id = [view.user_id] OR ( ( [BUDDY_MY].buddy_ignore <> 1 OR
			 	[BUDDY_MY].buddy_ignore IS NULL ) AND ( [board.user_viewimversion] <> 0 OR 
			 	[board.user_viewimversion_over] <> 1 ) AND ( [BUDDY_OF].buddy_visible = 1 OR ( 
			 	[USERS].user_viewimversion = 1 OR ([board.user_viewimversion] = 1 AND 
			 	[board.user_viewimversion_over] = 1) ) OR ( [BUDDY_OF].buddy_ignore = 0 AND ( 
			 	[USERS].user_viewimversion = 2 OR ([board.user_viewimversion] = 2 AND 
			 	[board.user_viewimversion_over] = 1) ) ) ) )\',
			),
		);
</pre>';
	$lang['Type_fields_title'] = 'שדות';
	$lang['Type_fields_explain'] = 'אתה צריך ליצור את אותו קוד שאתה היית שם במערך <strong>user_fields</strong> אבל במקום השימוש בשם user_fields, השתמש <strong>new_fields</strong>. <strong>$ לא מאופשר</strong> במקום הקוד ויצא ממנו אוטומטית. כאשר אתה שולח מחלקה שכבר קיימת, אותה מחלקה תעודכן עם הערכים החדשים שנשלחו. דוגמה:
<pre>
new_fields = array(
		\'user_viewimversion\' => array(
				\'lang_key\'     => \'Public_view_imversion\',
				\'class\'        => \'generic\',
				\'type\'         => \'TINYINT\',
				\'get_mode\'     => \'LIST_RADIO\',
				\'values\'       => \'list_yes_no_friend\',				
		),
		\'user_imversion\' => array(
				\'lang_key\'     => \'Im_version\',
				\'class\'        => \'imversion\',
				\'type\'         => \'VARCHAR\',
				\'dsp_func\'     => \'pcp_output_imversion\',
		),
);
</pre>';
	$lang['Type_deletes_title'] = 'הסר רשימות, מחלקות ושדות';
	$lang['Type_deletes_explain'] = 'אתה צריך ליצור מערך ששמו <strong>deletes</strong> המוצג כדוגמה. <strong>$ לא מאופשר</strong> בתוך הקוד ויצא ממנו. דוגמה:
<pre>
deletes = array(
	\'lists\' => array(
		\'list_im_versions\',
	),
	\'classes\' => array(
		\'imversion\',
	),
	\'fields\' => array(
		\'user_viewimversion\',
		\'user_imversion\', 
	),
);
</pre>';
	$lang['Wiz_pageimport'] = 'יבא עמודים';
	$lang['Wiz_pageimport_description'] = 'כאן אתה יכול ליבא הגדרות עמוד שנדרשות בשביל לבצע מודים.';
	$lang['Type_newpages_title'] = 'עדכן עמודים / עמודים חדשים';
	$lang['Type_newpages_explain'] = 'אתה צריך ליצור את אותו קוד שאתה היית שם במערך <strong>user_maps</strong> אבל במקום השימוש בשם user_maps, השתמש <strong>new_pages</strong>. <strong>$ לא מאופשר</strong> בתוך הקוד ויצא ממנו. כאשר אתה שולח עמוד שכבר קיים, אותו עמוד יעודכן עם הנתונין החדשים שנשלחו. דוגמה:
<pre>
new_pages = array(	
	\'DEMO\' => array(
		\'title\'		=> \'Demo\',
	),
	\'DEMO.info\' => array(
		\'title\'		=> \'Demo_Info\',
		\'fields\'	=> array(
			\'user_photo\' => array(
				\'txt\'          => true,
				\'img\'          => true,
				\'crlf\'         => true,
				\'style\'        => \'<div class="gensmall">%s</div>\',
			),
		),
	),
);
</pre>
';
	$lang['Type_delpages_title'] = 'הסר עמודים';
	$lang['Type_delpages_explain'] = 'אתה צריך ליצור מערך עמודים למחיקה, השתמש <strong>del_pages</strong> כשם המערך. <strong>$ לא מאופשר</strong> בתוך הקוד ויצא ממנו. דוגמה:
<pre>
del_pages = array(	
	\'DEMO\',
);
</pre>';
	$lang['Type_newpagefields_title'] = 'שדות עמודים חדשים / עדכן שדות עמוד';
	$lang['Type_newpagefields_explain'] = 'אתה צריך ליצור את אותו קוד שהיית שם המערך <strong>user_maps</strong> אבל במקום השימוש בשם user_maps, השתמש <strong>new_pagefields</strong> ואתה צריך להוסיף מפתח חדש הנקרא <strong>position</strong> לכל עמוד. בחר <strong>התחלה, סיום או שם שדה</strong> שכבר בעמוד. ה-position יגדיר היכן השדות החדשים יבואו לתוך העמוד. <strong>$ לא מאופשר</strong> בתוך הקוד ויצא ממנו. בזמן שליחת שדה שכבר קיים, השדה יעודכן עם הנתונים החדשים שנשלחו. דוגמה:
<pre>
new_pagefields = array(	
	\'DEMO.info\'  => array(
		\'position\' => \'user_photo\', // choose begin, end or a fieldname
		\'fields\'	 => array(
			\'user_avatar\' => array(
				\'img\'          => true,
			),
			\'user_warning\' => array(
				\'img\'          => true,
			),
		),
	),
);</pre>';
	$lang['Type_delpagefields_title'] = 'מחק שדות עמוד';
	$lang['Type_delpagefields_explain'] = 'אתה צריך ליצור את אותו קוד שהיית שם במערך <strong>user_maps</strong> אבל במקום השימוש בשם user_maps, השתמש <strong>del_pagefields</strong>. <strong>$ לא מאופשר</strong> בתוך הקוד ויצא ממנו. דוגמה:
<pre>
del_pagefields = array(	
	\'DEMO.info\'  => array(
		\'fields\'	 => array(
			\'user_avatar\' => array(
			),
		),
	),
);</pre>';
	$lang['Wiz_import_error'] = 'שגיאה בנסיון לייבא את <strong>%s</strong>';
	$lang['Wiz_backups'] = 'גיבויים';
	$lang['Wiz_backups_description'] = 'כאן אתה יכול לגבות את קבצי לוח הבקרה לפרופיל ולמחוק או לשחזר גיבוי.';
	$lang['Wiz_backups_explain'] = '<span class="explaintitle">גבה</span>: מציג את התאריך ושם הקובץ של הגיבוי.<br><span class="explaintitle">פעולה</span>: מה לעשות עם הקובץ.<br><span class="explaintitle">שחזר</span>: משחזר את הקובץ הנבחר לאחר גיבוי הגרסה הנוכחית.<br><span class="explaintitle">מחק</span>: מוחק את הגיבוי הנבחר.<br><span class="explaintitle">צפה</span>: מציג את הגיבוי הנבחר.<br><span class="explaintitle">גבה עכשיו!</span>: יוצר גיבוי גם של /profilcp/def/def_userfields.php וגם של /profilcp/def/def_usermaps.php.<br>';
	$lang['Restore'] = 'שחזר';
	$lang['File_deleted'] = 'הקובץ נמחק בהצלחה: %s';
	$lang['File_restored'] = 'הקובץ שוחזר בהצלחה: %s';
	$lang['backupnow'] = 'גבה עכשיו!';
	$lang['Backups_created'] = 'גיבוי הקבצים נוצר';
}

?>