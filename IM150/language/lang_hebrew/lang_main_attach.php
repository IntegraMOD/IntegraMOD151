<?php
/***************************************************************************
 *                            lang_main_attach.php [Hebrew]
 *                              -------------------
 *     begin                : Thu Feb 07 2002
 *     copyright            : (C) 2002 Meik Sievertsen
 *     email                : acyd.burn@gmx.de
 *
 *     $Id: lang_main_attach.php,v 1.27 2003/01/16 11:11:56 acydburn Exp $
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
// Attachment Mod Main Language Variables
//

// Auth Related Entries
$lang['Rules_attach_can'] = 'אתה <b>יכול</b> לצרף קבצים בפורום זה';
$lang['Rules_attach_cannot'] = 'אתה <b>לא יכול</b> לצרף קבצים בפורום זה';
$lang['Rules_download_can'] = 'אתה <b>יכול</b> להוריד קבצים בפורום זה';
$lang['Rules_download_cannot'] = 'אתה <b>לא יכול</b> להוריד קבצים בפורום זה';
$lang['Sorry_auth_view_attach'] = 'סליחה אבל אתה לא רשאי לצפות או להוריד קובץ זה';

// Viewtopic -> Display of Attachments
$lang['Description'] = 'תיאור'; // used in Administration Panel too...
$lang['Downloaded'] = 'הורד';
$lang['Download'] = 'הורדות'; // this Language Variable is defined in lang_admin.php too, but we are unable to access it from the main Language File
$lang['Filesize'] = 'גודל קובץ';
$lang['Viewed'] = 'נצפה';
$lang['Download_number'] = '%d פעמים'; // replace %d with count
$lang['Extension_disabled_after_posting'] = 'הסיומת \'%s\' הופסקה על-ידי המנהל הראשי של המערכת, לכן קובץ זה לא מוצג.'; // used in Posts and PM's, replace %s with mime type

// Posting/PM -> Initial Display
$lang['Attach_posting_cp'] = 'לוח בקרה לשליחת קובץ';
$lang['Attach_posting_cp_explain'] = 'אם אתה לוחץ על הוסף קובץ, תראה תיבת להוספת קבצים.<br />אם אתה לוחץ על קבצים שנשלחו, תראה רשימה של קבצים שצורפו כבר ואתה רשאי לערוך אותם.<br />אם אתה רוצה להחליף (להעלות גרסה חדשה) קובץ, אתה צריך ללחוץ על שני הקישורים. הוסף קובץ כפי שבדרך כלל היית עושה, לאחר מכן לא ללחוץ על הוסף קובץ שוב, במקום זאת ללחוץ על העלה גרסה חדשה ברישום הקובץ שאתה רוצה לעדכן.';

// Posting/PM -> Posting Attachments
$lang['Add_attachment'] = 'הוסף קובץ';
$lang['Add_attachment_title'] = 'הוסף קובץ';
$lang['Add_attachment_explain'] = 'אם אתה לא רוצה להוסיף קובץ להודעה שלך, השאר את השדות ריקים';
$lang['File_name'] = 'שם הקובץ';
$lang['File_comment'] = 'הערת הקובץ';

// Posting/PM -> Posted Attachments
$lang['Posted_attachments'] = 'קבצים שנשלחו';
$lang['Options'] = 'אפשרויות';
$lang['Update_comment'] = 'עדכן הערה';
$lang['Delete_attachments'] = 'מחק קבצים';
$lang['Delete_attachment'] = 'מחק קובץ';
$lang['Delete_thumbnail'] = 'מחק תמונה קטנה';
$lang['Upload_new_version'] = 'העלה גרסה חדשה';

// Errors -> Posting Attachments
$lang['Invalid_filename'] = '%s הוא שם קובץ שגוי'; // replace %s with given filename
$lang['Attachment_php_size_na'] = 'הקובץ גדול מדי.<br />לא ניתן לקבל את הגודל המירבי המוגדר ב-PHP.<br />מוד הצירוף קבצים לא יכול לקבוע את הגודל להעלאה מירבי המוגדר ב-php.ini.';
$lang['Attachment_php_size_overrun'] = 'הקובץ גדול מדי.<br />גודל להעלאה מירבי: %d MB.<br />שים לב שגודל זה מוגדר ב-php.ini, זה אומר שהוא נקבע על-ידי PHP ומוד הצירוף קבצים לא יכול לעבור על ערך זה.'; // replace %d with ini_get('upload_max_filesize')
$lang['Disallowed_extension'] = 'הסיומת %s לא מאופשרת'; // replace %s with extension (e.g. .php) 
$lang['Disallowed_extension_within_forum'] = 'אתה לא רשאי לשלוח קבצים עם הסיומת %s בפורום זה'; // replace %s with the Extension
$lang['Attachment_too_big'] = 'הקובץ גדול מדי.<br />גודל מירבי: %d %s'; // replace %d with maximum file size, %s with size var
$lang['Attach_quota_reached'] = 'סליחה, אבל גודל הקובץ המירבי לכל הקבצים התקבל. צור קשר עם המנהל הראשי של המערכת אם יש לך שאלות.';
$lang['Too_many_attachments'] = 'לא ניתן להוסיף את הקובץ, בגלל המקסימום. מספר של %d קבצים בהודעה זו התקבל'; // replace %d with maximum number of attachments
$lang['Error_imagesize'] = 'הקובץ/התמונה חייב להיות פחות מ-%d פיקסלים רוחב ו-%d פיקסלים גובה'; 
$lang['General_upload_error'] = 'שגיאה בהעלאה: לא ניתן להעלות קובץ ל %s.'; // replace %s with local path

$lang['Error_empty_add_attachbox'] = 'אתה צריך להקליד ערכים בתיבה \'הוסף קובץ\'';
$lang['Error_missing_old_entry'] = 'לא ניתן לעדכן את הקובץ, לא ניתן למצוא את רישום הקובץ הקודם';

// Errors -> PM Related
$lang['Attach_quota_sender_pm_reached'] = 'סליחה, אבל גודל הקובץ המירבי לכל הקבצים שתיקיית ההודעות הפרטיות שלך התקבל. מחק כמה מהקבצים שלך שהתקבלו/נשלחו.';
$lang['Attach_quota_receiver_pm_reached'] = 'סליחה, אבל גודל הקובץ המירבי לכל הקבצים בתיקיית ההודעות הפרטיות של \'%s\' התקבל. אנא הודע לו, או המתן עד שימחק כמה מהקבצים שלו.';

// Errors -> Download
$lang['No_attachment_selected'] = 'לא בחרת קובץ להורדה או לצפייה.';
$lang['Error_no_attachment'] = 'הקובץ שבחרת לא קיים יותר';

// Delete Attachments
$lang['Confirm_delete_attachments'] = 'אתה בטוח שאתה רוצה למחוק את הקבצים הנבחרים?';
$lang['Deleted_attachments'] = 'הקבצים הנבחרים נמחקו.';
$lang['Error_deleted_attachments'] = 'לא ניתן למחוק קבצים.';
$lang['Confirm_delete_pm_attachments'] = 'אתה בטוח שאתה רוצה למחוק את כל הקבצים שנשלחו בהודעה הפרטית?';

// General Error Messages
$lang['Attachment_feature_disabled'] = 'מאפיין הצירוף קבצים כבוי.';

$lang['Directory_does_not_exist'] = 'התיקייה \'%s\' לא קיימת או שלא ניתן למצוא אותה.'; // replace %s with directory
$lang['Directory_is_not_a_dir'] = 'בדוק אם \'%s\' זו תיקייה.'; // replace %s with directory
$lang['Directory_not_writeable'] = 'התיקייה \'%s\' אינה ניתנת לכתיבה. אתה צריך ליצור את נתיב ההעלאה ולשנות את ההרשאות שלו ל-777 (או לשנות את בעל שרתי ה-httpd) להעלות קבצים.<br />אם יש לך גישה ל-ftp פשוטה בלבד שנה את ה-\'Attribute\' של התיקייה ל-rwxrwxrwx.'; // replace %s with directory

$lang['Ftp_error_connect'] = 'לא ניתן להתחבר לשרת ה-FTP: \'%s\'. בדוק את הגדרות ה-FTP שלך.';
$lang['Ftp_error_login'] = 'לא ניתן להתחבר לשרת ה-FTP. שם המשתמש \'%s\' או הסיסמא שגויים. בדוק את הגדרות ה-FTP שלך.';
$lang['Ftp_error_path'] = 'לא ניתן לגשת לתיקיית ה-ftp: \'%s\'. בדוק את הגדרות ה-FTP שלך.';
$lang['Ftp_error_upload'] = 'לא ניתן להעלות קבצים לתיקיית ה-ftp: \'%s\'. בדוק את הגדרות ה-FTP שלך.';
$lang['Ftp_error_delete'] = 'לא ניתן למחוק קבצים מתיקיית ה-ftp: \'%s\'. בדוק את הגדרות ה-FTP שלך.<br />סיבה אחרת לשגיאה זו יכולה להיות אי הקיום של הקובץ, בדוק ראשית את עותקי הקבצים.';
$lang['Ftp_error_pasv_mode'] = 'לא ניתן להפעיל/לכבות את המצב הפסיבי FTP';

// Attach Rules Window
$lang['Rules_page'] = 'חוקי הצירוף קבצים';
$lang['Attach_rules_title'] = 'קבוצות סיומות מאופשרות והגדלים שלהם';
$lang['Group_rule_header'] = '%s -> גודל להעלאה מירבי: %s'; // Replace first %s with Extension Group, second one with the Size STRING
$lang['Allowed_extensions_and_sizes'] = 'סיומות מאופשרות וגדלים';
$lang['Note_user_empty_group_permissions'] = 'הערה:<br />אתה תוכל באופן רגיל לצרף קבצים בפורום זה, <br />אבל אם אין קבוצת סיומת מאופשרת לצירוף כאן, <br />אתה לא תוכל לצרף דבר. אם תנסה, <br />תקבל הודעת שגיאה.<br />';

// Quota Variables
$lang['Upload_quota'] = 'הגבלת העלאה';
$lang['Pm_quota'] = 'הגבלת הודעה פרטית';
$lang['User_upload_quota_reached'] = 'סליחה, הגעת להגבלת הכמות להעלאה מירבית של %d %s'; // replace %d with Size, %s with Size Lang (MB for example)

// User Attachment Control Panel
$lang['User_acp_title'] = 'לוח בקרת ניהול למשתמש';
$lang['UACP'] = 'לוח בקרת צירוף קבצים למשתמש';
$lang['User_uploaded_profile'] = 'הועלו: %s';
$lang['User_quota_profile'] = 'הגבלה: %s';
$lang['Upload_percent_profile'] = '%d%% בסך הכל';

// Common Variables
$lang['Bytes'] = 'Bytes';
$lang['KB'] = 'KB';
$lang['MB'] = 'MB';
$lang['Attach_search_query'] = 'חיפוש קבצים';
$lang['Test_settings'] = 'הגדרות בדיקה';
$lang['Not_assigned'] = 'לא נקבע';
$lang['No_file_comment_available'] = 'אין הערת קובץ זמינה';
$lang['Attachbox_limit'] = 'תיבת צירוף הקבצים שלך %d%% מלאה';
$lang['No_quota_limit'] = 'אין הגבלת כמות';
$lang['Unlimited'] = 'בלי מוגבל';

?>