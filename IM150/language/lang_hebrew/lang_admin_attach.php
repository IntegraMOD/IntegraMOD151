<?php
/***************************************************************************
 *                            lang_admin_attach.php [Hebrew]
 *                              -------------------
 *     begin                : Thu Feb 07 2002
 *     copyright            : (C) 2002 Meik Sievertsen
 *     email                : acyd.burn@gmx.de
 *
 *     $Id: lang_admin_attach.php,v 1.36 2003/08/30 15:47:39 acydburn Exp $
 *
 ****************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

//
// Attachment Mod Admin Language Variables
//

// Modules, this replaces the keys used
/*$lang['Control_Panel'] = 'לוח בקרה';
$lang['Shadow_attachments'] = 'עותקי קבצים';
$lang['Forbidden_extensions'] = 'סיומות אסורות';
$lang['Extension_control'] = 'בקרת סיומות';
$lang['Extension_group_manage'] = 'בקרת קבוצות סיומות';
$lang['Special_categories'] = 'קטגורויות מיוחדות';
$lang['Sync_attachments'] = 'סנכרון קבצים';
$lang['Quota_limits'] = 'הגבלת כמות';
*/
// Attachments -> Management
$lang['Attach_settings'] = 'הגדרות צירוף קבצים';
$lang['Manage_attachments_explain'] = 'כאן אתה יכול להגדיר את ההגדרות הראשיות למוד צירוף קבצים. אם אתה לוחץ על כפתור בדיקת הגדרות, מוד הצירוף קבצים עושה כמה בדיקות מערכת כדי להיות בטוח שהמוד עובד כשורה. אם יש לך בעיות בהעלאת קבצים, הרץ בדיקה זו, כדי לקבל הודעת שגיאה מפורטת.';
$lang['Attach_filesize_settings'] = 'הגדרות גודל קובץ לצירוף קבצים';
$lang['Attach_number_settings'] = 'הגדרות מספר צירופי קבצים';
$lang['Attach_options_settings'] = 'אפשרויות צירוף קבצים';

$lang['Upload_directory'] = 'תיקיית העלאה';
$lang['Upload_directory_explain'] = 'הקלד את הנתיב היחסי מהתקנת phpBB2 שלך לתיקיית העלאת צירופי קבצים. לדגומא, הקלד \'files\' אם התקנת phpBB2 שלך נמצאת ב http://www.yourdomain.com/phpBB2 ותקיית העלאת הקבצים נמצאת ב http://www.yourdomain.com/phpBB2/files.';
$lang['Attach_img_path'] = 'אייקון שליחת קובץ מצורף';
$lang['Attach_img_path_explain'] = 'תמונה זו תוצג ליד קישורי הקובץ המצורף בהודעות היחידות. השאר שדה זה ריק אם אתה לא רוצה שאייקון יוצג. הגדרה זו תכתב על-ידי ההגדרות בניהול קבוצות סיומות.';
$lang['Attach_topic_icon'] = 'אייקון נושא עם קובץ מצורף';
$lang['Attach_topic_icon_explain'] = 'תמונה זו תוצג לפני הנושאים עם קבצים מצורפים. השאר שדה זה ריק אם אתה לא רוצה שאייקון יוצג.';
$lang['Attach_display_order'] = 'סדר המצגת קובץ מצורף';
$lang['Attach_display_order_explain'] = 'כאן אתה יכול לבחור אם להציג את הקבצים המצורפים בהודעות/הודעות פרטיות בסדר זמן קובץ יורד (קובץ מצורף הכי חדש ראשון) או סדר זמן קובץ עולה (קובץ מצורף הכי ישן ראשון).';
$lang['Show_apcp'] = 'הצג את לוח בקרת שליחת הקובץ החדש';
$lang['Show_apcp_explain'] = 'בחר אם להציג לוח בקרת שליחת קובץ מצורף (כן) או את השיטה הישנה עם שני תיבות לצירוף קבצים ועריכת הקבצים המצורפים שלך שנשלחו (לא) בתוך מסך השליחה שלך. זה מראה שקשה מאוד להסביר אותו, לכן הכי טוב זה לנסות אותו.';

$lang['Max_filesize_attach'] = 'גודל קובץ';
$lang['Max_filesize_attach_explain'] = 'גודל קובץ מירבי לקבצים מצורפים. ערך של 0 אומר \'בלתי מוגבל\'. הגדרה זו מוגבלת על-ידי הגדרות השרת שלך. לדוגמא, אם הגדרות php שלך מאפשרות גודל מירבי של 2 MB להעלאה, לא ניתן לעבור על הגדרה זו על-ידי מוד זה.';
$lang['Attach_quota'] = 'הגבלת צירוף קבצים';
$lang['Attach_quota_explain'] = 'שטח אחסון מירבי לכל הקבצים המצורפים שיכול להחזיק בשטח האחסון שלך. ערך של 0 אומר\'בלתי מוגבל\'.';
$lang['Max_filesize_pm'] = 'גודל קובץ מירבי בתיקיית ההודעות הפרטיות';
$lang['Max_filesize_pm_explain'] = 'שטח אחסון מירבי לקבצים המצורפים בתיבת ההדועות הפרטיות של המשתמשים. ערך של 0 אומר \'בלתי מוגבל\'.';
$lang['Default_quota_limit'] = 'הגבלת כמות ברירת מחדל';
$lang['Default_quota_limit_explain'] = 'כאן אתה רשאי לבחור את הגבלת הכמות ברירת מחדל אוטומטית הנקבעת למשתמשים הרשומים החדשים ומשתמשים ללא הגבלת כמות מוגדרת. האפשרות \'אין הגבלת כמות\' היא לא לשימוש בכל הגבלות צירוף קבצים, במקום שימוש בהגדרות ברירת מחדל שהגדרת בלוח הניהול.';

$lang['Max_attachments'] = 'מספר מירבי של קבצים מצורפים';
$lang['Max_attachments_explain'] = 'המספר המירבי של הקבצים המצורפים המאופשרים בהודעה אחת.';
$lang['Max_attachments_pm'] = 'מספר מירבי של קבצים מצורפים בהודעה פרטית אחת';
$lang['Max_attachments_pm_explain'] = 'מגדיר את המספר המירבי של קבצים מצורפים שהמשתמש מאופשר לכלול בהודעה פרטית.';

$lang['Disable_mod'] = 'כבה את מוד צירוף קבצים';
$lang['Disable_mod_explain'] = 'אפשרות זו בעיקר לבדיקת עיצובים חדשים או ערכות חדשות, היא מכבה את כל פונקציות צירוף הקבצים חוץ מלוח הניהול.';
$lang['PM_Attachments'] = 'אפשר צירוף קבצים בהודעות פרטיות';
$lang['PM_Attachments_explain'] = 'אפשר/אל תאפשר צירוף קבצים להודעות פרטיוצ.';
$lang['Ftp_upload'] = 'הפעל העלאת FTP';
$lang['Ftp_upload_explain'] = 'הפעל/כבה את אפשרות העלאת FTP. אם קבעת זאת לכן, אתה צריך להגדיר את ההגדרות FTP לצירוף קבצים ותיקיית ההעלאה אינה יותר בשימוש.';
$lang['Attachment_topic_review'] = 'האם אתה רוצה להציג קבצים מצורפים בחלון סיקור הנושא ?';
$lang['Attachment_topic_review_explain'] = 'אם אתה בוחר כן, כל הקבצים שצורפו יוצגו בסיקור הנושא כאשר אתה שולח תגובה.';

$lang['Ftp_server'] = 'שרת העלאת FTP';
$lang['Ftp_server_explain'] = 'כאן אתה יכול להקליד את כתובת ה-IP או את שם שרת ה-FTP של השרת המשומש לקבצים שהועלו שלך. אם אתה משאיר שדה זה ריק, השרת שבו מערכת ה-phpBB2 שלך הותקנה ישומש. שים לב שלא ניתן להוסיף ftp:// או משהו אחר לכתובת, פשוט ftp.foo.com או, שהרבה יותר מהיר, את כתובת ה-IP הפשוטה.';

$lang['Attach_ftp_path'] = 'נתיב FTP לתיקיית ההעלאה שלך';
$lang['Attach_ftp_path_explain'] = 'התיקייה שבה הקבצים המצורפים שלך יאוחסנו. תיקייה זו לא צריכה לקבל הרשאות. אנא אל תקליד את ה-IP או כתובת ה-FTP שלך כאן, בשדה זה מוכנס רק הנתיב ל-FTP.<br />לדוגמא: /home/web/uploads';
$lang['Ftp_download_path'] = 'קישור הורדה לנתיב ה-FTP';
$lang['Ftp_download_path_explain'] = 'הקלד את הכתובת לנתיב ה-FTP שלך, שבו הקבצים המצורפים שלך יאוחסנו.<br />אם אתה משתמש בשרת FTP רחוק, הקלד את הכתובת המלאה, לדוגמא http://www.mystorage.com/phpBB2/upload.<br />אם אתה משתמש בשרת המקומי שלך לאחסון הקבצים שלך, אתה רשאי להקליד כתובת נתיב יחסי לתיקיית phpBB2 שלך, לדגומא \'upload\'.<br />קו נטוי מיותר יוסר. השאר שדה זה ריק, אם נתיב ה-FTP לא נגיש מהאינטרנט. עם שדה זה ריק אתה לא תוכל להשתמש בשיטת הורדה פיסית.';
$lang['Ftp_passive_mode'] = 'הפעל מצב סביל ל-FTP';
$lang['Ftp_passive_mode_explain'] = 'פקודת הסבילות דורשת שהשרת הרחוק פותח יציאה לנתוני החיבור ומחזיר את הכתובת של אותה יציאה. השרת הרחוק רושם באותה יציאה וחיבורי הלקוח אליו.';

$lang['No_ftp_extensions_installed'] = 'אתה לא רשאי להשתמש בשיטות העלאה ה-FTP, מפני שסיומות ה-FTP לא מותאות להתקנת ה-PHP שלך.';

// Attachments -> Shadow Attachments
$lang['Shadow_attachments_explain'] = 'כאן אתה יכול למחוק נתוני קבצים מהודעות כאשר הקבצים פגומים ממערכת הקבצים שלך, ולמחוק קבצים שלא מצורפים יותר להודעות. אתה יכול להוריד או לצפות בקובץ אם אתה לוחץ עליו; אין אין קישור בזמן זה, הקובץ לא קיים.';
$lang['Shadow_attachments_file_explain'] = 'מחק את כל הקבצים המצורפים הקיימים במערכת הקבצים שלך ושלא נקבעו להודעה קיימת.';
$lang['Shadow_attachments_row_explain'] = 'מחק את כל נתוני שליחת הקבצים לקבצים שלא קיימים במערכת הקבצים שלך.';
$lang['Empty_file_entry'] = 'רישום קובץ ריק';

// Attachments -> Sync
$lang['Sync_thumbnail_resetted'] = 'תמונה קטנה שאופסה לקובץ מצורף: %s'; // replace %s with physical Filename
$lang['Attach_sync_finished'] = 'סינכרון הקובץ הסתיים.';

// Extensions -> Extension Control
$lang['Manage_extensions'] = 'ניהול סיומות';
$lang['Manage_extensions_explain'] = 'כאן אתה יכול לנהל את סיומות הקבצים שלך. אם אתה רוצה לאפשר/לא לאפשר סיומת להעלות, השתמש בניהול קבוצות סיומות.';
$lang['Explanation'] = 'הסבר';
$lang['Extension_group'] = 'קבוצת סיומת';
$lang['Invalid_extension'] = 'סיומת שגוייה';
$lang['Extension_exist'] = 'הסיומת %s כבר קיימת'; // replace %s with the Extension
$lang['Unable_add_forbidden_extension'] = 'הסיומת %s אסורה, אתה לא רשאי להוסיף אותה לסיומות המאופשרות'; // replace %s with Extension

// Extensions -> Extension Groups Management
$lang['Manage_extension_groups'] = 'ניהול קבוצות סיומות';
$lang['Manage_extension_groups_explain'] = 'כאן אתה יכול להוסיף, למחוק ולשנות קבוצות סיומות, אתה יכול לכבות את קבוצות הסיומות, לקבוע קטגוריה מיוחדת להם, לשנות את מנגנון ההורדה ואתה יכול להגדיר אייקון העלאה שיוצג לפני הקובץ המצורף השייך לקבוצה.';
$lang['Special_category'] = 'קטגוריה מיוחדת';
$lang['Category_images'] = 'תמונות';
$lang['Category_stream_files'] = 'קבצי שמע';
$lang['Category_swf_files'] = 'קבצי פלאש';
$lang['Allowed'] = 'מאופשר';
$lang['Allowed_forums'] = 'פורומים מאופשרות';
$lang['Ext_group_permissions'] = 'גישות קבוצה';
$lang['Download_mode'] = 'מצב הורדה';
$lang['Upload_icon'] = 'אייקון העלאה';
$lang['Max_groups_filesize'] = 'גודל קובץ מירבי';
$lang['Extension_group_exist'] = 'קבוצת הסיומת %s כבר קיימת'; // replace %s with the group name
$lang['Collapse'] = '+';
$lang['Decollapse'] = '-';

// Extensions -> Special Categories
$lang['Manage_categories'] = 'ניהול קטגוריות מיוחדות';
$lang['Manage_categories_explain'] = 'כאן אתה יכול להגדיר את הקטגוריות המיוחדות. אתה יכול לקבוע משתנים ותנאים מיוחדים לקטגוריות המיוחדות הנקבעות לקבוצת סיומת.';
$lang['Settings_cat_images'] = 'הגדרות לקטגוריה מיוחדת: תמונות';
$lang['Settings_cat_streams'] = 'הגדרות לקטגוריה מיוחדת: קבצי שמע';
$lang['Settings_cat_flash'] = 'הגדרות לקטגוריה מיוחדת: קבצי פלאש';
$lang['Display_inlined'] = 'הצג תמונות בתוך השורה';
$lang['Display_inlined_explain'] = 'בחר אם להציג תמונות ישירות בתוך ההודעה (כן) או להציג תמונות כקישור ?';
$lang['Max_image_size'] = 'מימדי תמונה מירביים';
$lang['Max_image_size_explain'] = 'כאן אתה יכול להגדיר את מימדי התמונה המירביים המאופשרים לצרף (רוחב x גובה בפיקסלים).<br />אם זה נקבע ל-0x0, מאפיין זה יהיה כבוי. עם כמה תמונות מאפיין זה לא יעבוד בגלל הגבלות ב-PHP.';
$lang['Image_link_size'] = 'מימדי תמונה מירביים להצגה';
$lang['Image_link_size_explain'] = 'אם זה מימד שהוגדר לתמונה שהתקבלה, התמונה תתקבץ אוטומטית עם היחס המקורי, אם צפייה בתוך השורה מופעלת (רוחב x גובה בפיקסלים).<br />ערך של 0 אומר שאין הגבלה במימד התואם. עם כמה תמונות מאפיין זה לא יעבוד בגלל הגבלות ב-PHP.';
$lang['Assigned_group'] = 'קבוצה שנקבעה';

$lang['Image_create_thumbnail'] = 'צור תמונה קטנה';
$lang['Image_create_thumbnail_explain'] = 'צור תמיד תמונה קטנה. מאפיין זה עובר על כמעט כל ההגדרות בקבוצה מיוחדת זו, חוץ ממימדי התמונה המירביים. עם מאפיין זה תמונה קטנה תוצג בהודעה, המשתמש יכול ללחוץ עליה ולפתוח את התמונה האמיתית.<br />שים לב שמאפיין זה דרש Imagick שיהיה מותקן, אם זה לא מותקן או אם מצב בטוח פעיל סיומת ה-GD של PHP תשומש. אם סוג התמונה לא נתמך על-ידי PHP, מאפיין זה לא יהיה משומש.';
$lang['Image_min_thumb_filesize'] = 'גודל קובץ מירבי לתמונה הקטנה';
$lang['Image_min_thumb_filesize_explain'] = 'אם התמונה קטנה יותר מגדול הקובץ המוגדר, אין תמונה קטנה שתיווצר, מפני שהיא כבר קטנה.';
$lang['Image_imagick_path'] = 'תוכנית Imagick (השלם נתיב)';
$lang['Image_imagick_path_explain'] = 'הקלד את הנתיב של תוכנית ההמרה של imagick, בדרך כלל /usr/bin/convert (בחלונות: c:/imagemagick/convert.exe).';
$lang['Image_search_imagick'] = 'חפש Imagick';

$lang['Use_gd2'] = 'עשה שימוש של סיומת GD2';
$lang['Use_gd2_explain'] = 'PHP רשאי להיות מותאם עם הסיומת GD1 או GD2 לתמונה מתופעלת. ליצרת תמונות קטנות באופן נכון ללא imagemagick מוד צירוף הקבצים משתמש בשני שיטות שונות, מבוססות על בחירתך כאן. אם התמונות הקטנות שלך באיכות לא טובה או מוברגות, נסה לשנות הגדרה זו.';
$lang['Attachment_version'] = 'גירסת מוד צירוף הקבצים היא %s'; // %s is the version number

// Extensions -> Forbidden Extensions
$lang['Manage_forbidden_extensions'] = 'ניהול סיומות אסורות';
$lang['Manage_forbidden_extensions_explain'] = 'כאן אתה יכול להוסיף או למחוק את הסיומות האסורות. הסיומות php, php3 ו-php4 אסורות כברירת מחדל למען סיבות אבטחה, אתה לא יכול למחוק אותם.';
$lang['Forbidden_extension_exist'] = 'הסיומת האסורה %s כבר קיימת'; // replace %s with the extension
$lang['Extension_exist_forbidden'] = 'הסיומת %s מוגדרת בסיומות המאופשרות שלך, מחק אותה לפני שתוסיף אותה כאן.';  // replace %s with the extension

// Extensions -> Extension Groups Control -> Group Permissions
$lang['Group_permissions_title'] = 'גישות קבוצת סיומת -> \'%s\''; // Replace %s with the Groups Name
$lang['Group_permissions_explain'] = 'כאן אתה רשאי להגביל את קבוצת הסיומת הנבחרת לפורומים לפי בחירתך (המוגדרים בתיבת הפורומים המאופשרים). ברירת המחדל היא לאפשר קבוצות סיומות לכל הפורומים שהמשתמש יוכל לצרף בהם קבצים (הדרך הרגילה שמוד הצירוף קבצים עשה מההתחלה). רק הוסף את אותם פורומים שאתה רוצה שקבוצת הסיומת (הסיומות שבתוך קבוצה זו) תהיה מאופשרת שם, ברירת המחדל כל הפורומים תעלם כאשר תוסיף את הפורומים לרשימה. אתה רשאי להוסיף מחדש את כל הפורומים בכל זמן נתון. אם אתה מוסיף פורום למערכת שלך והגישה נקבעת לכל הפורומים לא ישתנה דבר. אבל אם שינית והגבלת את הגישה לפורומים מסויימים, אתה צריך לבדוק חזרה כאן את הפורום שלך שנוצר מחדש. זה קל לעשות זאת אוטומטית, אבל זה ידרוש ממך לערוך את צרור הקבצים, לכן אני הייתי בוחר בדרך זו עכשיו. שים לב, שכל הפורומים שלך יהיו רשומים כאן.';
$lang['Note_admin_empty_group_permissions'] = 'הערה:<br />בתוך הפורומים הרשומים מתחת המשתמשים שלך מאופשרים לצרף קבצים בצורה הרגילה, אבל אם אין קבוצת סיומת מאופשרת לצירוף שם, המשתמשים שלך לא יוכלו לצרף דבר. אם הם ינסו, הם יקבלו הודעות שגיאה. אולי תרצה לקבוע את הגישה \'לשלוח קבצים\' למנהל ראשי באותם פורומים.<br /><br />';
$lang['Add_forums'] = 'הוסף פורומים';
$lang['Add_selected'] = 'הוסף נבחרים';
$lang['Perm_all_forums'] = 'כל הפורומים';

// Attachments -> Quota Limits
$lang['Manage_quotas'] = 'ניהול הגבלת כמות קבצים מצורפים';
$lang['Manage_quotas_explain'] = 'כאן אתה יכול להוסיף/למחוק/לשנות את הגבלות הכמות. אתה רשאי לקבוע את אותם הגבלות כמות למשתמשים וקבוצות מאוחר יותר. כדי לקבוע הגבלת כמות למשתמש, אתה צריך לעבור למשתמשים->ניהול, לבחור את המשתמש ואתה תראה את האפשרויות בתחתית. כדי לקבוע הגבלת כמות לקבוצה, עבור לקבוצות->ניהול, בחר את הקבוצה כדי לערוך אותה, ואתה תראה את ההגדרות. אם אתה רוצה לראות, אילו משתמשים וקבוצות נקבעו להגבלת כמות מסויימת, לחץ על \'צפה\' בצד ימין של תיאור ההגבלה.';
$lang['Assigned_users'] = 'משתמשים שנקבעו';
$lang['Assigned_groups'] = 'קבוצות שנקבעו';
$lang['Quota_limit_exist'] = 'הגבלת הכמות %s כבר קיימת.'; // Replace %s with the Quota Description

// Attachments -> Control Panel
$lang['Control_panel_title'] = 'לוח בקרת קובץ מצורף';
$lang['Control_panel_explain'] = 'כאן אתה יכול לצפות ולנהל את כל הקבצים במצורפים המבוססים על משתמשים, קבצים מצורפים, צפיות וכדומה...';
$lang['File_comment_cp'] = 'הערת הקובץ';

// Control Panel -> Search
$lang['Search_wildcard_explain'] = 'השתמש ב-* כסימן כולל לתוצאות החלקיות';
$lang['Size_smaller_than'] = 'גודל הקובץ המצורף קטן יותר מ (bytes)';
$lang['Size_greater_than'] = 'גודל הקובץ המצורף גדול יותר מ (bytes)';
$lang['Count_smaller_than'] = 'מונה ההורדות קטן יותר מ-';
$lang['Count_greater_than'] = 'מונה ההורדות גדול יותר מ-';
$lang['More_days_old'] = 'יותר מכמות ימים זו עברה';
$lang['No_attach_search_match'] = 'אין קבצים מצורפים המתאימים לאפשרויות החיפוש שלך';

// Control Panel -> Statistics
$lang['Number_of_attachments'] = 'מספר קבצים מצורפים';
$lang['Total_filesize'] = 'גודל קובץ כולל';
$lang['Number_posts_attach'] = 'מספר הודעות עם קבצים מצורפים';
$lang['Number_topics_attach'] = 'מספר נושאים עם קבצים מצורפים';
$lang['Number_users_attach'] = 'משתמשים עצמאיים ששלחו קבצים מצורפים';
$lang['Number_pms_attach'] = 'מספר כולל של קבצים מצורפים בהודעות פרטיות';

// Control Panel -> Attachments
$lang['Statistics_for_user'] = 'סטטיסטיקת צירוף קבצים ל-%s'; // replace %s with username
$lang['Size_in_kb'] = 'גודל (KB)';
$lang['Downloads'] = 'הורדות';
$lang['Post_time'] = 'זמן ההודעה';
$lang['Posted_in_topic'] = 'נשלח בנושא';
$lang['Submit_changes'] = 'שלח שינויים';

// Sort Types
$lang['Sort_Attachments'] = 'קבצים מצורפים';
$lang['Sort_Size'] = 'גודל';
$lang['Sort_Filename'] = 'שם הקובץ';
$lang['Sort_Comment'] = 'הערה';
$lang['Sort_Extension'] = 'סיומת';
$lang['Sort_Downloads'] = 'הורדות';
$lang['Sort_Posttime'] = 'זמן ההודעה';
$lang['Sort_Posts'] = 'הודעות';

// View Types
$lang['View_Statistic'] = 'סטטיסטיקה';
$lang['View_Search'] = 'חיפוש';
$lang['View_Username'] = 'שם משתמש';
$lang['View_Attachments'] = 'קבצים מצורפים';

// Successfully updated
$lang['Attach_config_updated'] = 'הגדרות צירוף הקבצים עודכנו בהצלחה';
$lang['Click_return_attach_config'] = 'לחץ %sכאן%s כדי לחזור להגדרות צירוף הקבצים';
$lang['Test_settings_successful'] = 'בדיקת ההגדרות הסתיימה, ההגדרות כנראה עובדות.';

// Some basic definitions
$lang['Attachments'] = 'קבצים מצורפים';
$lang['Attachment'] = 'קובץ מצורף';
$lang['Extensions'] = 'סיומות';
$lang['Extension'] = 'סיומת';

// Auth pages
$lang['Auth_attach'] = 'שליחת קבצים';
$lang['Auth_download'] = 'הורדת קבצים';

?>