<?php
/***************************************************************************
 *                            lang_admin_album.php [Hebrew]
 *                              -------------------
 *     begin                : Sunday, February 02, 2003
 *     copyright            : (C) 2003 Smartor
 *     email                : smartor_xp@hotmail.com
 *
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

//--- Multiple File Upload mod : begin
//--- version : 1.0.3
include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_multiple_album.' . $phpEx);
//--- Multiple File Upload mod : end

//
// Configuration
//
$lang['Album_config'] = 'הגדרות האלבום';
$lang['Album_config_explain'] = 'אתה יכול לשנות את ההגדרות הכלליות של אלבום התמונות שלך כאן';
$lang['Album_config_updated'] = 'הגדרות האלבום עודכנו בהצלחה';
$lang['Click_return_album_config'] = 'לחץ %sכאן%s כדי לחזור להגדרות האלבום';
$lang['Max_pics'] = 'תמונות מירביות לכל קטגוריה (-1 = בלתי מוגבל)';
$lang['User_pics_limit'] = 'הגבלת תמונות לכל קטגוריה לכל משתמש (-1 = בלתי מוגבל)';
$lang['Moderator_pics_limit'] = 'הגבלת תמונות לכל קטגוריה לכל מנהל (-1 = בלתי מוגבל)';
$lang['Pics_Approval'] = 'אישור תמונות';
$lang['Rows_per_page'] = 'מספר שורות בעמוד התמונות הקטנות';
$lang['Cols_per_page'] = 'מספר עמודות בעמוד התמונות הקטנות';
$lang['Thumbnail_quality'] = 'איכות תמונה קטנה (1-100)';
$lang['Thumbnail_cache'] = 'זכרון תמונות קטנות';
$lang['Manual_thumbnail'] = 'תמונה קטנה ידנית';
$lang['GD_version'] = 'ייעול לגרסת ה-GD';
$lang['Pic_Desc_Max_Length'] = 'אורך מירבי לתיאור/הערת התמונה (bytes)';
$lang['Hotlink_prevent'] = 'מניעת קישורים חמים';
$lang['Hotlink_allowed'] = 'כתובות מאופשרות לקישורים חמים (מופרדים על-ידי פסיק)';
$lang['Personal_gallery'] = 'משתמשים מאופשרים ליצור גלרייה אישית';
$lang['Personal_gallery_limit'] = 'הגבלת תמונות לכל גלרייה אישית (-1 = בלתי מוגבל)';
$lang['Personal_gallery_view'] = 'מי יכול לצפות בגלרייות אישיות';
$lang['Rate_system'] = 'הפעל מערכת דירוגים';
$lang['Rate_Scale'] =' סולם דירוגים';
$lang['Comment_system'] = 'הפעל מערכת תגובות';
$lang['Thumbnail_Settings'] = 'הגדרות תמונה קטנה';
$lang['Extra_Settings'] = 'הגדרות נוספות';
$lang['Default_Sort_Method'] = 'סוג שיטה ברירת מחדל';
$lang['Default_Sort_Order'] = 'סוג סידור ברירת מחדל';
$lang['Fullpic_Popup'] = 'צפה בתמונה המלאה כחלון קופץ';


// Personal Gallery Page
$lang['Personal_Galleries'] = 'גלרייות אישיות';
$lang['Album_personal_gallery_title'] = 'גלרייה אישית';
$lang['Album_personal_gallery_explain'] = 'בעמוד זה, אתה יכול לבחור אילו קבוצות משתמשים יוכלו ליצור ולצפות בגלרייות אישיות. הגדרות אלו משפיעות רק כאשר אתה קובע "פרטי" ל "משתמשים מאופשרים ליצור גלריות אישיות" או "מי יכול לצפות בגלריות אישיות" במסך הגדרות באלבום';
$lang['Album_personal_successfully'] = 'ההגדרות עודכנו בהצלחה';
$lang['Click_return_album_personal'] = 'לחץ %sכאן%s כדי לחזור להגדרות הגלרייות האישיות';

//
// Categories
//
$lang['Album_Categories_Title'] = 'בקרת קטגוריות אלבום';
$lang['Album_Categories_Explain'] = 'במסך זה אתה יכול לנהל את הקטגוריות שלך: ליצור, לשנות, למחוק, למיין, וכדומה.';
$lang['Category_Permissions'] = 'גישות הקטגוריה';
$lang['Category_Title'] = 'כותרת הקטגוריה';
$lang['Category_Desc'] = 'תיאור הקטגוריה';
$lang['View_level'] = 'צפה ברמה';
$lang['Upload_level'] = 'העלה רמה';
$lang['Rate_level'] = 'דרג רמה';
$lang['Comment_level'] = 'הער רמה';
$lang['Edit_level'] = ' ערוך רמה';
$lang['Delete_level'] = 'מחק רמה';
$lang['New_category_created'] = 'הקטגוריה החדשה נוצרה בהצלחה';
$lang['Click_return_album_category'] = 'לחץ %sכאן%s כדי לחזור לניהול קטגוריות האלבום';
$lang['Category_updated'] = 'הקטגוריה עודכנה בהצלחה';
$lang['Delete_Category'] = 'מחק קטגוריה';
$lang['Delete_Category_Explain'] = 'הטופס הבא יאפשר לך למחוק קטגוריה ולהחליט היכן אתה רוצה לשים את כל התמונות שהיא מכילה';
$lang['Delete_all_pics'] = 'מחק את כל התמונות';
$lang['Category_deleted'] = 'הקטגוריה נמחקה בהצלחה';
$lang['Category_changed_order'] = 'סדר הקטגוריה שונה בהצלחה';

//
// Permissions
//
$lang['Album_Auth_Title'] = 'גישות האלבום';
$lang['Album_Auth_Explain'] = 'כאן אתה יכול לבחור אילו קבוצות משתמשים יכולות להיות המנהלות לכל קטגורית אלבום או רק בעלת גישה פרטית';
$lang['Select_a_Category'] = 'בחר קטגוריה';
$lang['Look_up_Category'] = 'אתר קטגוריה';
$lang['Album_Auth_successfully'] = 'הגישות עודכנו בהצלחה';
$lang['Click_return_album_auth'] = 'לחץ %sכאן%s כדי לחזור לגישות האלבום';

$lang['Upload'] = 'העלה';
$lang['Rate'] = 'דרג';
$lang['Comment'] = 'הגב';
$lang['View'] = 'לצפות';

//
// Clear Cache
//
$lang['Clear_Cache'] = 'נקה זיכרון';
$lang['Album_clear_cache_confirm'] = 'אם אתה משתמש במאפיין זיכרון תמונות קטנות אתה חייב לנקות את זכרון התמונות הקטנות שלך לאחר שינוי הגדרות התמונות הקטנות שלך בהגדרות האלבום כדי לחדש אותם.<br /><br /> אתה רוצה לנקות אותם עכשיו?';
$lang['Thumbnail_cache_cleared_successfully'] = '<br />זכרון התמונות הקטנות שלך נוקה בהצלחה<br />&nbsp;';

/* BSRA Album Hierarchy Mod v1.0  START */
$lang['Parent_Category'] = 'קטגורית אב (לקטגוריה זו)';
$lang['Child_Category_Moved'] = 'הקטגוריה הנבחרה בעלת קטגוריות בנים. קטגוריות הבנים הועברו לקטגוריה <B>%s</B>.';
/* BSRA Album Hierarchy Mod v1.0 STOP  */
?>