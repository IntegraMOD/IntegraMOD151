<?php
/***************************************************************************
 *						lang_extend_meta_tags.php [Hebrew]
 *						-----------------------------------------------
 *	begin				: 12/10/2004
 *	copyright		: paperclips
 *	email				: jm.lachance@gmail.com
 *
 *	version				: 1.0.0 - 11/10/2004
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
$lang['Click_return_admin_meta_tags'] = 'לחץ %sכאן%s כדי לחזור לניהול תגי ה-Meta';
$lang['Lang_extend_meta_tags'] = 'תגי Meta +';
$lang['Meta_tags_title'] = 'תגי Meta +';
$lang['Meta_tags_title_explain'] = 'ברוך הבא לניהול תגי ה-Meta.  אותם תגים מאפשרים לך לתת תיאור של האתר שלך למנועי חיפוש כדי לאפשר להם להכניס את האתר שלך למנוע שלהם.<br/ >זה מדוע, אתה צריך לשים לב.<br/ >יותר מכך של התייחסות, אותם תגים מאפשרים אפשרויות הפנייה אוטומטית לכתובת אחרת.  ';

$lang['Meta_parameters'] = 'רשימה שלמה של תגי ה-meta';
$lang['Meta_parameters_explain'] = ' סיכום עקרונות תגי ה-meta, התחביר שלהם הוא : <<b>meta name="xxx" content="xxx"</b>>';
$lang['Meta_keywords']  = 'META מילות מפתח';
$lang['Meta_keywords_explain']  = '- פונקציה: מסמן למנועי החיפוש את מילות המפתח הקשורות לאתר שלך.<br />- מספר מירבי של תווים : 1000 או 100 מילות מפתח.<br/ >- במספר התווים, לא לשכוח לספור את <a href="accent.htm">התווים המודגשים</a> כאשר מקודדים ב-HTML. לדוגמא האות  "א", מקודדת &amp&agrave; במוני HTML לשמונה תווים.<br />- אתה לא צריך לחזור כמה פעמים על אותה המילה (מנועי החיפוש לא אוהבים זאת).<br />- מילות המפתח מופרדות על-ידי פסיק, רווח או פסיק ורווח, זו לפי בחירתך.';
$lang['Meta_description'] = 'META תיאור';
$lang['Meta_description_explain'] = '- תיאור האתר שלך.<br />- מספר מירבי של תווים: 200<br />- המנע מהדגשות, במנועים מסויימים זה לא נלקח לתוך החשבון.';
$lang['Meta_author']  = 'META מחבר';
$lang['Meta_author_explain']  = '- מאפשר לזהות את מחבר האתר.<br/ >- שים את השם הראשון באותיות קטנות, לאחר מכן שם המשפחה מתחיל באות ראשית.<br/ >- אם אתה רוצה, אתה יכול לשים כמה מחברים המופרדים על-ידי פסיק.';
$lang['Meta_identifier_url']  = 'META מזהה כתובת';
$lang['Meta_identifier_url_explain']  = ' - מאפשר לציין כתובת.<br />- הקלד את הכתובת של עמוד הבית שלך.<br />- אתה חייב לציין כתובת אחת בלבד.';
$lang['Meta_reply_to']  = 'META הגבה אל';
$lang['Meta_reply_to_explain']  = ' - מאפשר לצין את הדואר האלקטרוני של מנהל האתר.<br/ > כדי לשים כתובת אחת בלבד.';
$lang['Meta_revisit_after']  = 'META בקר מחדש לאחר';
$lang['Meta_revisit_after_explain']  = ' - מאפשר ציין עם העכביש (רובוט של המנוע) של אינדוקס האתר שלך לפי מספר הימים שהוקלדו. - 15 ימים" או "30 ימים" הם ההעדפות הכי טובות.';
$lang['Meta_category']  = 'META קטגוריה';
$lang['Meta_category_explain']  = ' - מאפשר לציין את קטגורית האתר שלך. בשימוש על-ידי מנועים מסויימים שנותנים סיווג על-ידי קטגוריה.';
$lang['Meta_generator']  = 'META יוצר';
$lang['Meta_generator_explain']  = '  - בדרך אופיינית את שם ומספר הגרסה של כלי הפרסום שבשימוש כדי ליצור את העמוד.<br/ >- יכול להיות בשימוש על-ידי כלי מכירות כדי להעריך חדירת שוק. <br / >- אותם תגים כ-meta של מוציא לאור.';
$lang['Meta_copyright']  = 'META זכויות יוצרים';
$lang['Meta_copyright_explain']  = '- בדרך אופיינית הצהרת זכויות יוצרים חסרת מידה.<br /> - אתה יכול לכלול זכויות יוצרים, סימני היכר, פטנטים, או מידע אחר כאך המשתייך לתכונה האינטלקטואלית שלך.';
$lang['Meta_robots']  = 'META רובוטים';
$lang['Meta_robots_explain']  = '- בקרות רובוטים של מנוע חיפוש בכל בסיס עמוד.<br/ >- all = הבוט יאנדקס שלך את האתר שלך בכולם (כברירת מחדל)<br />- none = הבוט לא יאנדקס את האתר שלך בכולם<br />- index = העמוד שלך מאונדקס<br />- noindex = העמוד שלך לא מאונדקס אבל הבוט יעקוב אחר הקישור לעמוד שלך<br />- follow = הבוט לוקח את ההערה של הקישור שלך בעמוד שלך כדי לאנדקס אותו לאחר מכן.<br />- nofollow = הבוט לא יאנדקס את הקישור באתר שלך';
$lang['Meta_distribution']  = 'META הפצה';
$lang['Meta_distribution_explain']  = '- ישנם שלושה סיווגים של הפצת תוכן האתר שלך:<br/ >- גלובאלי (כל האתר)<br/ >- מקומי (הוזמן לבלוק ה-IP המקומי של האתר שלך)<br/ >- שימוש פנימי (לא להפצה ציבורית)';
$lang['Meta_date_creation']  = 'META תאריך יצירה-yyyymmdd';
$lang['Meta_date_creation_explain']  = '- תאריך יצירת האתר שלך';
$lang['Meta_date_revision']  = 'META תאריך עריכה-yyyymmdd';
$lang['Meta_date_revision_explain']  = '- תאריך השינוי האחרון';
$lang['Meta_day'] = 'יום :';
$lang['Meta_month'] = 'חודש :';
$lang['Meta_year'] = 'שנה :';

$lang['Meta_http_equiv_parameters'] = 'תגים אחרים';
$lang['Meta_http_equiv_parameters_explain'] = ' התחביר הכללי של אותם תגים הוא : <<b>meta http-equiv="xxx" CONTENT="xxx"</b>> אם אתה לא רוצה להשתמש באחד או בכמה תגים, השאר רווחים ריקים.';
$lang['Meta_refresh']  = 'META רענון 1';
$lang['Meta_refresh_explain']  = '- מציין דחייה בשניות לפני שהדפדפן יטען אוטומטית מחדש את האתר. המספר הוא הדחייס בשניות שבהם הדפדפן "יעצור" לפני שהרענון יבוצע. הקלד את המספר בשניות.';
$lang['Meta_redirect_url']  = 'META רענון 2';
$lang['Meta_redirect_url_explain']  = '- מציין דחייה בשניות לפני שהדפדפן יעבור אוטומטית מהמסמך לכתובת שצויינה.<br/ > המספר לפני הכתובת הוא הדחייה בשניות שבהם הדפדפן "יעצור" לפני שההפנייה תבוצע.';
$lang['Meta_redirect_url_time']  = 'פעמים (שניות):';
$lang['Meta_redirect_url_adress']  = 'כתובת:';
$lang['Meta_pragma']  = 'META Pragma';
$lang['Meta_pragma_explain']  = '- מאסר את הרשומה של העמוד בזכרון הזמני של הדפדפן.<br/ >- כדי להשתמש בתג זה, הקלד <i>no-cache</i>, אם לא, השאר ריק.';
$lang['Meta_language']  = 'META שפה';
$lang['Meta_language_explain']  = '- fr : צרפתית<br/ >- en : אנגלית אמריקאית<br/ >- nl : הולנדית<br/ >- de : גרמנית<br/ >- es : ספרדית<br/ >- it : איטלקית<br/ >- pt : פורטוגזית<br/ >- il : עברית<br/ >- אם האתר שלך בכמה שפות, זה לא מומלץ להשתמש בתג זה.';
}
?>