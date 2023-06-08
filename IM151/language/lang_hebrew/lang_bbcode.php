<?php
/***************************************************************************
 *                         lang_bbcode.php [hebrew]
 *                            -------------------
 *   begin                : Wednesday Oct 3, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
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

/* CONTRIBUTORS
	2002-12-15	Philip M. White (pwhite@mailhaven.com)
		Fixed many minor grammatical problems.
*/
 
// 
// To add an entry to your BBCode guide simply add a line to this file in this format:
// $faq[] = array("question", "answer");
// If you want to separate a section enter $faq[] = array("--","Block heading goes here if wanted");
// Links will be created automatically
//
// DO NOT forget the ; at the end of the line.
// Do NOT put double quotes (") in your BBCode guide entries, if you absolutely must then escape them ie. \"something\"
//
// The BBCode guide items will appear on the BBCode guide page in the same order they are listed in this file
//
// If just translating this file please do not alter the actual HTML unless absolutely necessary, thanks :)
//
// In addition please do not translate the colors referenced in relation to BBCode any section, if you do
// users browsing in your language may be confused to find they're BBCode doesn't work :D You can change
// references which are 'in-line' within the text though.
//
  
$faq[] = array("--","הקדמה");
$faq[] = array("מה זה BBCode?", "BBCode זו צורה מיוחדת של HTML. אתה יכול למעשה להשתמש ב-BBCode בהודעותיך בפורום לפי מה שקבע המנהל הראשי. בנוסף, אתה יכול לכבות את BBCode בכל בסיס הודעה באופן חד פעמי דרך טופס השליחה. BBCode עצמו דומה בסגנון ל-HTML: התגים נתמכים בסוגריים מרובעים [ ו-] במקום &lt; ו-&gt; והוא מציע ניהול גבוה יותר מעל מה ואיך משהו מוצג. לפי הערכה שבה אתה משתמש תוכל למצוא הוספת BBCode להודעות שלך בדרך קלה יותר דרך ממשק הלחיצה בהודעה בטופס השליחה. אפילו עם זאת תוכל למצוא את המדריך השימושי הבא.");

$faq[] = array("--","תבניות טקסט");
$faq[] = array("כיצד ליצור טקסט מוגדש, נטוי ועם קו תחתי", "BBCode כוללת תגים שמאפשרים לך שינוי מהיר של בסיס הסגנון של הטקסט שלך. ניתן לעשות זאת בדרכים הבאות: <ul><li>כדי לעשות חלק של טקסט מודגש תחום את הטקסט בתגים <b>[b][/b]</b>, למשל <br /><br /><span dir='ltr'><b>[b]</b>שלום<b>[/b]</b></span><br /><br />יהפוך ל <b>שלום</b></li><li>לקו תחתי השתמש ב-<b>[u][/u]</b>, לדוגמא:<br /><br /><span dir='ltr><b>[u]</b>בוקר טוב<b>[/u]</b></span><br /><br />יהפוך ל <u>בוקר טוב</u></li><li>לטקסט נטוי השתמש ב-<b>[i][/i]</b>, למשל<br /><br />זה <span dir='ltr'><b>[i]</b>נהדר!<b>[/i]</b></span><br /><br />יתן זה <i>נהדר!</i></li></ul>");
$faq[] = array("כיצד לשנות את צבע או גודל הטקסט", "כדי לשנות את צבע או גודל הטקסט שלך תוכל להשתמש בתגים הבאים. חשוב כיצד הטקסט יופיע כפלט תלוי בדפדפן הצופים ובמערכת: <ul><li>כדי לשנות את צבע הטקסט עטוף את הטקסט ב-<b>[color=][/color]</b>. את יכול לציין שם צבע מוכר (למשל red לאדום, blue לכחול, yellow לצהוב, וכדומה) או לחילופין שלישיית ההקסדצימלי, למשל <span dir='ltr'>#FFFFFF, #000000</span>. לדוגמא, כדי ליצור טקסט אדום אתה יכול להשתמש:<br /><br /><span dir='ltr'><b>[color=red]</b>שלום!<b>[/color]</b></span><br /><br />או<br /><br /><span dir='ltr'><b>[color=#FF0000]</b>שלום!<b>[/color]</b></span><br /><br />יתן את הפלט <span style=\"color:red\">שלום!</span></li><li>שינוי גודל הטקסט מתקבל בדרך קטנה יותר בעזרת <b>[size=][/size]</b>. תג זה תלוי בערכה שבה אתה משתמש אבל הדרך המומלצת היא ערך מספרי להצגת גודל הטקסט בפיקסלים , מתחיל ב-1 (כל כך קטן עד שלא תוכל לראות את הטקסט) עד ל-29 (גדול מאוד). לדוגמא:<br /><br /><span dir='ltr'><b>[size=9]</b>קטן<b>[/size]</b></span><br /><br />בדרך כלל יהיה <span style=\"font-size:9px\">קטן</span><br /><br />ואילו:<br /><br /><span dir='ltr'><b>[size=24]</b>ענק!<b>[/size]</b></span><br /><br />יהיה <span style=\"font-size:24px\">ענק!</span></li></ul>");
$faq[] = array("האם אני יכול לשלב תגי תבניות?", "כן, כמובן שאתה יכול; לדוגמא כדי לקבל תשומת לב ממישהו תוכל לכתוב:<br /><br /><span dir='ltr'><b>[size=18][color=red][b]</b>הסתכל עלי!<b>[/b][/color][/size]</b></span><br /><br />יהיה הפלט <span style=\"color:red;font-size:18px\"><b>הסתכל עלי!</b></span><br /><br />אנחנו לא ממליצים לך להוציא לפלט הרבה טקסטים שנראים כמו זה. זכור שזה אליך, השולח, להבטיח שהתגים נסגרים כראוי. לדוגמא, הצורה הבאה שגוייה:<br /><br /><span dir='ltr'><b>[b][u]</b>זו טעות<b>[/b][/u]</b></span>");

$faq[] = array("--","ציטוט וקוד עם רוחב תקין");
$faq[] = array("ציטוט טקסט בתגובות", "ישנם שני דרכים שבהם תוכל לצטט טקסט: עם הפניה ובלי.<ul><li>כאשר אתה משתמש בפונקציית הציטוט כדי להגיב להודעה בפורום אתה צריך לדעת שטקסט ההודעה שנסוף להודעה תחום בחלון בבלוק <span dir='ltr'><b>[quote=\"\"][/quote]</b></span>. שיטה זו מאפשרת לך לצטט עם הפנייה לאדם או כל מה שאתה בוחר לשים. לדוגמא, כדי לצטט קטע מהטקסט שמר בלובי כתב, תוכל להקליד:<br /><br /><span dir='ltr'><b>[quote=\"מר בלובי\"]</b>הטקסט שמר בלובי כתב יהיה כאן<b>[/quote]</b></span><br /><br />הפלט הנובע יוסיף אוטומטית: מר בלובי כתב: לפני הטקסט הממשי. זכור שאתה <b>חייב</b> לכלול את המרכאות \"\" סביב השם שאותו אתה רוצה לצטט -- זו אינה רשות.</li><li>השיטה השנייה מאפשרת לך לצטט מישהו בצורת עיוורת. כדי להשתמש באפשרות זו תחום את הטקסט בתגים <b>[quote][/quote]</b>. כאשר תצפה בהודעה תראה פשוט: ציטוט: לפני הטקסט עצמו.</li></ul>");
$faq[] = array("קוד לפלט או נתונים עם רוחב תקין", "אם תרצה להוציא לפלט קטע קוד או כל דבר שדורש רוחב תקין עם סוג גופן Courier, אתה צריך לתחום את הטקסט בתגים <b>[code][/code]</b>, למשל<br /><br /><span dir='ltr'><b>[code]</b>echo \"זהו קוד כלשהו\";<b>[/code]</b></span><br /><br />כל התבנית המשומשת בתוך התגים <b>[code][/code]</b> נשמר כאשר תצפה בהודעה אחר כך.");

$faq[] = array("--","יצירת רשימות");
$faq[] = array("יצירת רשימה לא מסודרת", "BBCode תומכת בשני סוגים של רשימות, לא מסודרת ומסודרת. הם דומים מאוד לשווים שלהם ב-HTML. רשימה לא מסודרת מוציאה לפלט כל רכיב ברשימה שלך באופן סדרתי אחד אחרי האחר וליד כל רכיב סימן של עיגול. כדי ליצור רשיה לא מסודרת תשתמש ב-<b>[list][/list]</b> ומגדיר כל רכיב בתוך הרשימה עם <b>[*]</b>. לדוגמא, לרשימת הצבעים המועדפים שלך אתה יכול להשתמש:<br /><br /><span dir='ltr'><b>[list]</b><br /><b>[*]</b>אדום<br /><b>[*]</b>כחול<br /><b>[*]</b>צהוב<br /><b>[/list]</b></span><br /><br />הקוד הזה יצור את הרשימה הבאה:<ul><li>אדום</li><li>כחול</li><li>צהוב</li></ul>");
$faq[] = array("יצירת רשימה מסודרת", "הסוג השני של רשימות, רשימה מסודרת נותנת לך ניהול גבוה יותר מה יהיה הפלט לפני כל פריט. כדי ליצור רשימה מסדורת אתה יכול להשתמש ב-<b>[list=1][/list]</b> כדי ליצור רשימה ממוספרת או לחילופין <b>[list=a][/list]</b> לרשימה מסודרת לפי האלף-בית הלועזי. כמו ברשימה לא מסודרת רכיבים מצויינים עם <b>[*]</b>. לדוגמא:<br /><br /><span dir='ltr'><b>[list=1]</b><br /><b>[*]</b>לך לחנות<br /><b>[*]</b>קנה מחשב חדש<br /><b>[*]</b>קלל את המחשב כאשר הוא מתקלקל<br /><b>[/list]</b><br /><br />יתן את הרשימה הבאה:<ol type=\"1\"><li>לך לחנות</li><li>קנה מחשב חדש</li><li>קלל את המחשב כאשר הוא מתקלקל</li></ol>ואילו לרשימה מסודרת לפי האלף-בית הלועזי אתה יכול להשתמש:<br /><br /><span dir='ltr'><b>[list=a]</b><br /><b>[*]</b>התשובה האפשרית הראשונה<br /><b>[*]</b>התשובה האפשרית השנייה<br /><b>[*]</b>התשובה האפשרית השלישית<br /><b>[/list]</b></span><br /><br />נותן<ol type=\"a\"><li>התשובה האפשרית הראשונה</li><li>התשובה האפשרית השנייה</li><li>התשובה האפשרית השלישית</li></ol>");

$faq[] = array("--", "יצירת קישורים");
$faq[] = array("יצירת קישור לאתר אחר", "phpBB BBCode תומכת במספר דרכים ליצירת קישורים, URIs ידועים יותר כ-URLs.<ul><li>הראשונה מהשימושים האלו הוא התג <b>[url=][/url]</b>; כל מה שאתה רושם לאחר הסימן = יגרום לתוכן התג להתנהג כמו כתובת אינטרנט. לדוגמא, כדי לקשר ל-phpBB.com אתה יכול להשתמש:<br /><br /><span dir='ltr'><b>[url=http://www.phpbb.com/]</b>בקר ב-phpBB!<b>[/url]</b></span><br /><br />קוד זה יתן לך את הקישור הבא, <a href=\"http://www.phpbb.com/\" target=\"_blank\">בקר ב-phpBB!</a> אתה תראה שהקישור יפתח בחלון חדש אז המשתמש יכול להמשיך לדפדף בפורומים אם הוא מעוניין.</li><li>אם תרצה שהכתובת עצמה תשמש כקישור אתה יכול לעשות זאת פשוט בעזרת:<br /><br /><b>[url]</b>http://www.phpbb.com/<b>[/url]</b><br /><br />הקוד יתן לך את הקישור הבא: <a href=\"http://www.phpbb.com/\" target=\"_blank\">http://www.phpbb.com/</a></li><li>בנוסף במאפייני phpBB ישנו משהו נוסף הנקרא <i>קישורי קסם</i> שיפנה כל כתובת עם תחביר נכון לתוך קישור ללא שתצטרך לציין כל תגים או אפילו את ההתחלה <span dir='ltr'>http://</span>. לדוגמא כתיבת www.phpbb.com בתוך ההודעה שלך אוטומטית יוציא לפלט כאשר תצפה בהודעה את <a href=\"http://www.phpbb.com/\" target=\"_blank\">www.phpbb.com</a></li><li>את אותו הדבר ניתן לעשות לגבי כתובות דואר אלקטרוני; אתה יכול לציין כתובת במפורש, כמו:<br /><br /><b>[email]</b>no.one@domain.adr<b>[/email]</b><br /><br />שיוציא לפלט את <a href=\"emailto:no.one@domain.adr\">no.one@domain.adr</a> או שתוכל פשוט להקליד no.one@domain.adr לתוך ההודעה שלך וזה יהפוך לקישור אוטומטית כאשר תצפה בהודעה.</li></ul>כמו כל תגי ה-BBCode אתה יכול לשלב כתובות סביב כל תג אחר כמו <b>[img][/img]</b> (ראה בקטע הבא), <b>[b][/b]</b>, וכדומה. כמו תגי התבנית אתה צריך להבטיח שתגי הפתיחה והסגירה בסדר הנכון. לדוגמא:<br /><br /><b>[url=http://www.phpbb.com/][img]</b>http://www.phpbb.com/images/phplogo.gif<b>[/url][/img]</b><br /><br />זה <u>לא</u> נכון, דבר זה יכול להוביל למחיקת הודעתך אז הזהר.");

$faq[] = array("--", "תצוגת תמונות בהודעות");
$faq[] = array("הוספת תמונה להודעה", "phpBB BBCode כולל תג להוספת תמונות להודעות שלך. שני דברים חשבונים מאוד לזכור בזמן שאתה משתמש בתג זה: הרבה משתמשים לא אוהבים הצגת הרבה תמונות בהודעות והשני, אתה חייב להציג תמונה שכבר זמינה באינטרנט (היא לא יכולה להיות במחשב שלך בלבד, לדוגמא, אלא אם כן אתה מריץ עליו שרת אינטרנט!). אין דרך כרגע לאחסון תמונות בתוך phpBB (כל העניינים האלו כנראה יטופלו בגרסה הבאה של-phpBB). כדי להציג תמונה, אתה חייב להקיף את כתובת האינטרנט המצביעה לתמונה עם תגי <b>[img][/img]</b>. לדוגמא:<br /><br /><b>[img]</b>http://www.phpbb.com/images/phplogo.gif<b>[/img]</b><br /><br />כפי שראית בחלק כתובות האינטרנט מעל אתה יכול לעטוף תמונה בתג <b>[url][/url]</b> אם אתה רוצה, למשל<br /><br /><b>[url=http://www.phpbb.com/][img]</b>http://www.phpbb.com/images/phplogo.gif<b>[/img][/url]</b><br /><br />יתן:<br /><br /><a href=\"http://www.phpbb.com/\" target=\"_blank\"><img src=\"images/logo_phpbb_med.gif\" border=\"0\" alt=\"\" /></a><br />");
// LEFT-RIGHT-start
$faq[] = array("יישור תמונות ועטיפתן בטקסט", "בפורום זה ישנו את המוד תג תמונה ימין-שמאל.  דרך השימוש של התגים, אתה יכול להציג את ההודעות שלך בצורה יותר טובה על-ידי יישור טקסט לצד שמאל או ימין של תוכן ההודעה.  בנוסף, דרך השימוש נוספת של תגים אלו, ניתן לעטוף את הטקסט סביב התמונות בניגוד לתג [img] שבו התמונה והטקסט יופיעו בשורות נפרדות.  לדוגמא:<br /><br /><b>עם תג התמונה:</b><br />באמת באמת <b>[img]</b>phplogo.gif<b>[/img]</b> <b>[img]</b>phplogo.gif<b>[/img]</b> באמת באמת באמת באמת באמת באמת הרבה משפטים. <table width=\"420\" cellpadding=\"5\"><tr><td class=\"quote\"><br />באמת באמת <img src=\"templates/fisubice/images/logo_phpbb_med.gif\" border=\"0\" alt=\"\" /> <img src=\"templates/fisubice/images/logo_phpbb_med.gif\" border=\"0\" alt=\"\" /> באמת באמת באמת באמת באמת באמת הרבה משפטים.<br /><br /></td></tr></table><br /> <b>עם תגי שמאל וימין:</b><br />באמת באמת <b>[img=left]</b>phplogo.gif<b>[/img]</b> <b>[img=right]</b>phplogo.gif<b>[/img]</b> באמת באמת באמת באמת באמת באמת הרבה משפטים. <table width=\"420\" cellpadding=\"5\"><tr><td class=\"quote\"><br /><img src=\"templates/fisubice/images/logo_phpbb_med.gif\" border=\"0\" alt=\"\" align=\"left\" /> <img src=\"templates/fisubice/images/logo_phpbb_med.gif\" border=\"0\" alt=\"\" align=\"right\" /> באמת באמת באמת באמת באמת באמת באמת באמת הרבה משפטים.<br /><br /><br /></td></tr></table>") ;
// LEFT-RIGHT-end


$faq[] = array("--", "עניינים אחרים");
$faq[] = array("האם אני יכול להוסיף תגים משלי?", "לא, לפחות לא ישירות ב-phpBB 2.0. אנו מחפשים רעיון נוספים לתגי BBCode לגרסה הרשמית הבאה.");

$faq[] = array('מהו ה-BBCode של PHP!?', 'ה-PHP BBCode דומה מאוד לקוד BBCode, חוץ מזה שהוא משומש רק בשביל קוד PHP.  למה?  מפני שהוא מבליט חלקים מסויימים של קוד PHP, יוצר את הקוד בצורה יותר קלה לקריאה.');

//
// This ends the BBCode guide entries
//

?>