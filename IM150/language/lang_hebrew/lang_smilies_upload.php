<?php
/***************************************************************************
 *                        lang_smilies_upload.php [Hebrew]
 *                            -------------------
 *   begin                : Tuesday, Aug 19, 2003
 *   version              : 1.1.0
 *   date                 : 2003/08/27 19:12
 ***************************************************************************/

//
// CONTRIBUTORS:
//	 Add your details here if wanted, e.g. Name, username, email address, website
//

//
// The format of this file is ---> $lang['message'] = 'text';
//
// This is optional, if you would like a _SHORT_ message output
// along with our copyright message indicating you are the translator
// please add it here.
// $lang['TRANSLATION'] .= '';

if ( defined('IN_SMILIESUPLOAD_LANG') )
{
	return;
}
define('IN_SMILIESUPLOAD_LANG', true);

$lang['SU_Upload_Smilies'] = 'העלה סמיילים';
$lang['SU_Upload_Explain'] = 'אתה יכול להשתמש בשירות זה כדי להעלות תמונה גרפית קטנה לשימוש כסמיילי. ניתן להעלות תמונה אחת בלבד בכל פעם, וגודל הקובץ של התמונה לא יכול להיות גדול מ-%s KB. הרוחב והגובה המירביים המאופשרים הם %s על %s.';
$lang['SU_File'] = 'העלה תמונה מהמחשב שלך';
$lang['SU_Sorry'] = 'סליחה, אתה לא יכול להעלות קבצים.';
$lang['SU_Upload_Name'] = 'שם לקובץ שהועלה';
$lang['SU_Default_Name'] = 'השתמש בשם הקובץ המקורי';
$lang['SU_Name_Explain'] = 'ציין שם לקובץ שהועלה. אל תכלול את סיומת הקובץ (למשל, ציין "apple", ולא "apple.gif").';
$lang['SU_Upload_Succesful'] = 'הקובץ הועלה בהצלחה!';
$lang['SU_Upload_Failed'] = 'העלאת הקובץ נכשלה! בדוק אם גישות תיקיית הסמיילים מאפשרת כתיבה לקבצים.';
$lang['SU_Auto_Add'] = 'הוסף אוטומטית לסמיילים הפורום';
$lang['SU_Add_Successful'] = 'הסמיילים נוספו לטבלת הסמיילים בבסיס הנתונים בהצלחה!';
$lang['SU_Add_Failed'] = 'לא ניתן להוסיף סמיילים לטבלת בסיס הנתונים.';
$lang['SU_filetype'] = 'ניתן להעלות תמונות JPEG, GIF, או PNG בלבד.';
$lang['SU_filesize'] = 'ניתן להעלות קבצים הקטנים ב-%s KB בלבד.';
$lang['SU_File_Already'] = 'קובץ עם שם זה כבר קיים בתיקיית הסמיילים.';
$lang['SU_CC_Fail'] = 'לא ניתן לבדוק לקוד הסמיילים הקיים.';
$lang['SU_CC_Found'] = 'ישנו כבר סמיילי עם הקוד שנקבע אוטומטית.';
$lang['SU_Filename_failed'] = 'לא ניתן לקבוע שם קובץ חדש';
$lang['SU_open_basedir'] = 'open_basedir נקבע וגרסת ה-PHP לא מאפשרת move_uploaded_file.';
$lang['SU_Uploaded'] = 'תמונות הסמיילים הועלו';
$lang['SU_Sorry_None'] = 'לא הועלו תמונות סמיילים.';
$lang['SU_Delete_Successful'] = 'הקובץ %s נמחק!';
$lang['SU_Delete_Failed'] = 'לא ניתן למחוק את הקובץ %s!';
$lang['SU_Select_file'] = 'בחר קובץ להעלאה.';
$lang['SU_CD_Fail'] = 'לא ניתן למחוק רישומים מטבלת הסמיילים בבסיס הנתונים.';
$lang['SU_CD_Successful'] = 'הרישומים בטבלת הסמיילים בבסיס הנתונים נמחקו.';
$lang['SU_Width_height'] = 'קובץ זה עבר את הגודל המירבי המאופשר. התמונות חייבות להיות לא יותר מ-%s רוחב ו-%s גובה.';
$lang['SU_No_Name'] = 'לא ציינת שם לקובץ שהועלה.';

?>