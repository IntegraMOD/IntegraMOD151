<?php
/***************************************************************************
 *                          lang_main_album.php [Hebrew]
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

$lang['PICVIEWPREVIOUS'] = '&laquo; הקודם';
$lang['PICVIEWALBUMNEXT'] = 'הבא &raquo;';

//
// Album Index
//
$lang['Photo_Album'] = 'אלבום תמונות';
$lang['Pics'] = 'תמונות';
$lang['Last_Pic'] = 'תמונה אחרונה';
$lang['Public_Categories'] = 'קטגוריות ציבוריות';
$lang['No_Pics'] = 'אין תמונות';
$lang['Users_Personal_Galleries'] = 'גלרייות משתמשים אישיות';
$lang['Your_Personal_Gallery'] = 'הגלרייה האישית שלך';
$lang['Recent_Public_Pics'] = 'תמונות ציבוריות אקראיות';

$lang['Poster'] = 'שולח';
$lang['Posted'] = '<b>נשלח</b>';
$lang['View'] = 'צפה';

//
// Category View
//
$lang['Category_not_exist'] = 'הקטגוריה לא קיימת';
$lang['Upload_Pic'] = 'העלה תמונה';
$lang['Pic_Title'] = 'כותרת התמונה';

$lang['Album_upload_can'] = 'אתה <b>יכול</b> להעלות תמונות חדשות בקטגוריה זו';
$lang['Album_upload_cannot'] = 'אתה <b>לא יכול</b> להעלות תמונות חדשות בקטגוריה זו';
$lang['Album_rate_can'] = 'אתה <b>יכול</b> לדרג תמונות בקטגוריה זו';
$lang['Album_rate_cannot'] = 'אתה <b>לא יכול</b> לדרג תמונות בקטגוריה זו';
$lang['Album_comment_can'] = 'אתה <b>יכול</b> לשלוח תגובות לתמונות בקטגוריה זו';
$lang['Album_comment_cannot'] = 'אתה <b>לא יכול</b> לשלוח תגובות לתמונות בקטגוריה זו';
$lang['Album_edit_can'] = 'אתה <b>יכול</b> לערוך את התמונות והתגובות שלך בקטגוריה זו';
$lang['Album_edit_cannot'] = 'אתה <b>לא יכול</b> לערוך את התמונות והתגובות שלך בקטגוריה זו';
$lang['Album_delete_can'] = 'אתה <b>יכול</b> למחוק את התמונות והתגובות שלך בקטגוריה זו';
$lang['Album_delete_cannot'] = 'אתה <b>לא יכול</b> למחוק את התמונות והתגובות שלך בקטגוריה זו';
$lang['Album_moderate_can'] = 'אתה <b>יכול</b> %sלנהל%s קטגוריה זו';

$lang['Edit_pic'] = 'ערוך';
$lang['Delete_pic'] = 'מחק';
$lang['Rating'] = 'דירוג';
$lang['Comments'] = 'תגובות';
$lang['New_Comment'] = 'תגובה חדשה';

$lang['Not_rated'] = '<i>לא דורג</i>';

//
// Upload
//
$lang['Pic_Desc'] = 'תיאור התמונה';
$lang['Plain_text_only'] = 'טקסט פשוט בלבד';
$lang['Max_length'] = 'אורך מירבי (bytes)';
$lang['Upload_pic_from_machine'] = 'העלה תמונה מהמחשב שלך';
$lang['Upload_to_Category'] = 'העלה לקטגוריה';
$lang['Upload_thumbnail_from_machine'] = 'העלה את התמונה הקטנה שלה מהמחשב שלך (חייבת להיות אותו סוג כמו התמונה שלך)';
$lang['Upload_thumbnail'] = 'העלה תמונה קטנה';
$lang['Upload_thumbnail_explain'] = 'חייב שיהיה לה אותו סוג קובץ כמו התמונה שלך';
$lang['Thumbnail_size'] = 'גודל התמונה הקטנה (פקסלים)';
$lang['Filetype_and_thumbtype_do_not_match'] = 'התמונה והתמונה הקטנה שלך חייבים להיות באותו סוג';

$lang['Upload_no_title'] = 'אתה חייב להקליד כותרת לתמונה שלך';
$lang['Upload_no_file'] = 'אתה חייב להקליד את הנתיב שלך ואת שם הקובץ שלך';
$lang['Desc_too_long'] = 'התיאור שלך ארוך מדי';

$lang['Max_file_size'] = 'גודל קובץ מירבי (bytes)';
$lang['Max_width'] = 'רוחב תמונה מירבי (pixel)';
$lang['Max_height'] = 'גובה תמונה מירבי (pixel)';

$lang['JPG_allowed'] = 'ניתן להעלות קבצי JPG';
$lang['PNG_allowed'] = 'ניתן להעלות קבצי PNG';
$lang['GIF_allowed'] = 'ניתן להעלות קבצי GIF';

$lang['Album_reached_quota'] = 'קטגוריה זו הגיעה להקבלת התמונות. אתה לא יכול להעלות יותר עכשיו. צור קשר עם המנהל הראשי למידע נוסף';
$lang['User_reached_pics_quota'] = 'הגעת להגבלת התמונות שלך. אתה לא יכול להעלות יותר עכשיו. צור קשר עם המנהל הראשי למידע נוסף';

$lang['Bad_upload_file_size'] = 'הקובץ שהועלה גדול מדי או פגום';
$lang['Not_allowed_file_type'] = 'סוג הקובץ שלך לא מאופשר';
$lang['Upload_image_size_too_big'] = 'גודל מימדי התמונה שלך גדול מדי';
$lang['Upload_thumbnail_size_too_big'] = 'גודל מימדי התמונה הקטנה שלך גדול מדי';

$lang['Missed_pic_title'] = 'אתה חייב להקליד את כותרת התמונה שלך';

$lang['Album_upload_successful'] = 'התמונה שלך הועלתה בהצלחה';
$lang['Album_upload_need_approval'] = 'התמונה שלך הועלתה בהצלחה.<br /><br />אבל מאפיין אישור התמונות מופעל אז התמונה שלך חייבת להיות מאושרת על ידי מנהל ראשי או מנהל לפני שליחה';
$lang['Click_return_category'] = 'לחץ %sכאן%s כדי לחזור לקטגוריה';
$lang['Click_return_album_index'] = 'לחץ %sכאן%s כדי לחזור לאינדקס האלבום';

// View Pic
$lang['Pic_not_exist'] = 'התמונה לא קיימת';

// Edit Pic
$lang['Edit_Pic_Info'] = 'ערוך פרטי תמונה';
$lang['Pics_updated_successfully'] = 'פרטי התמונה שלך עודכנו בהצלחה';

// Delete Pic
$lang['Album_delete_confirm'] = 'אתה בטוח שאתה רוצה למחוק תמונות אלו?';
$lang['Pics_deleted_successfully'] = 'התמונות נמחקו בהצלחה';

//
// ModCP
//
$lang['Approval'] = 'אישור';
$lang['Approve'] = 'אשר';
$lang['Unapprove'] = 'דחה';
$lang['Status'] = 'מצב';
$lang['Locked'] = 'נעול';
$lang['Not_approved'] = 'לא אושר';
$lang['Approved'] = 'אושר';
$lang['Move_to_Category'] = 'העבר לקטגוריה';
$lang['Pics_moved_successfully'] = 'התמונות שלך הועברו בהצלחה';
$lang['Pics_locked_successfully'] = 'התמונות שלך ננעלו בהצלחה';
$lang['Pics_unlocked_successfully'] = 'התמונות שלך שוחררו מנעילה בהצלחה';
$lang['Pics_approved_successfully'] = 'התמונות שלך אושרו בהצלחה';
$lang['Pics_unapproved_successfully'] = 'התמונות שלך נדחו בהצלחה';

//
// Rate
//
$lang['Current_Rating'] = 'דירוג נוכחי';
$lang['Please_Rate_It'] = 'דרג את התמונה';
$lang['Already_rated'] = 'כבר דירגת תמונה זו';
$lang['Album_rate_successfully'] = 'התמונה שלך דורגה בהצלחה';

//
// Comment
//
//
$lang['Comment_no_text'] = 'הקלד את התגובה שלך';
$lang['Comment_too_long'] = 'התגובה שלך ארוכה מדי';
$lang['Comment_delete_confirm'] = 'אתה בטוח שאתה רוצה למחוק תמונה זו?';
$lang['Pic_Locked'] = 'סליחה, תמונה זו ננעלה. אז אתה לא יכול לשלוח תגובה לתמונה זו יותר';

//
// Personal Gallery
//
$lang['Personal_Gallery_Explain'] = 'אתה יכול לצפות בגלריות אישיות של חברים אחרים על-ידי לחיצה על הקישור בפרופילים שלהם';
$lang['Personal_gallery_not_created'] = 'הגלרייה האישית של %s ריקה או שלא נוצרה';
$lang['Not_allowed_to_create_personal_gallery'] = 'סליחה, המנהל הראשי של מערכת זו לא מאפשר לך ליצור את הגלרייה האישית שלך';
$lang['Click_return_personal_gallery'] = 'לחץ %sכאן%s כדי לחזור לגלרייה האישית';

//
// Search
//
$lang['Search_for'] = 'חפש ל';
$lang['That_contains'] = 'זה מכיל';
$lang['Name'] = 'שם';
$lang['Image_description'] = 'תיאור';
$lang['Highest_rated'] = 'תמונות בעלי הדירוג הכי גבוה';
$lang['Random_pic'] = 'תמונות אקראיות';
$lang['Album_sub_categories'] = 'תת-קטגוריות אלבום';
$lang['Pic_Category'] = 'קטגורית אלבום תמונות';
$lang['Search_found'] = 'החיפוש מצא';
$lang['Matches'] = 'תוצאות';
$lang['Posted_at'] = 'נשלח ב';
$lang['Submitted_by'] = 'נשלח על-ידי';
$lang['Submitted_on'] = 'נשלח ב';
$lang['Click_pic'] = 'לחץ על תמונה כדי לצפות בתמונה הגדולה יותר';

$lang['Last_Comments'] = 'תגובה אחרונה';
$lang['No_Comment_Info'] = "אין תגובות";
$lang['Mod_CP'] = 'אלבום - לוח בקרה למנהל';

$lang['Post_your_comment'] = 'שלח את התגובה שלך';
?>