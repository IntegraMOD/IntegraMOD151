<?php
/***************************************************************************
 *                            lang_admin_link.php
 *                            -------------------
 *  MOD add-on page. Contains GPL code copyright of phpBB group.
 *  Author: OOHOO < webdev@phpbb-tw.net >
 *  Author: Stefan2k1 and ddonker from www.portedmods.com
 *  Demo: http://phpbb-tw.net/
 *  Version: 1.0.X - 2002/03/22 - for phpBB RC serial, and was named Related_Links_MOD
 *  Version: 1.1.0 - 2002/04/25 - Re-packed for phpBB 2.0.0, and renamed to Links_MOD
 *  Version: 1.1.5 - 2003/06/11 - Enhanced and Re-packed for phpBB 2.0.4
 *  Version: 1.2.2 - 2004-05-10 - Enhanced by CRLin
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

//
// Categories
//
$lang['Link_Categories_Title'] = 'בקרת קטגוריות קישורים';
$lang['Link_Categories_Explain'] = 'המסך זה אתה יכול לנהל את הקטגוריות שלך: ליצור, לשנות, למחוק, לסדר, וכדומה.';
$lang['Category_Permissions'] = 'גישות הקטגוריה';
$lang['Category_Title'] = 'כותרת הקטגוריה';
$lang['Category_Desc'] = 'תיאור הקטגוריה';
$lang['View_level'] = 'רמת צפייה';
$lang['Upload_level'] = 'רמת העלאה';
$lang['Rate_level'] = 'רמת דירוג';
$lang['Comment_level'] = 'רמת הערה';
$lang['Edit_level'] = ' רמת עריכה';
$lang['Delete_level'] = 'רמת מחיקה';
$lang['New_category_created'] = 'הקטגוריה החדשה נוצרה בהצלחה';
$lang['Click_return_link_category'] = 'לחץ %sכאן%s כדי לחזור לנהל קטגוריות הקישורים';
$lang['Category_updated'] = 'הקטגוריה עודכנה בהצלחה';
$lang['Delete_Category'] = 'מחק קטגוריה';
$lang['Delete_Category_Explain'] = 'הטופס הבא יאפשר לך למחוק קטגוריה';;
$lang['Category_deleted'] = 'הקטגוריה נמחקה בהצלחה';
$lang['Category_changed_order'] = 'סדר הקטגוריה שונה בהצלחה';

//
// Config
//
$lang['Link_Config'] ='בקרת הגדרות הקישורים';
$lang['Link_config_explain'] = 'אתה יכול לשנות את ההגדרות הכלליות של הקישורים שלך כאן';
$lang['lock_submit_site'] = 'נעל שליחת אתר משתמש';
$lang['allow_guest_submit_site'] = 'אפשר לאורח לשלוח אתר';
$lang['allow_no_logo'] = 'אפשר לשלוח אתר ללא באנר';
$lang['site_logo'] = 'הכתובת שבו הלוגו יכול להמצא (כתובת מלאה)';
$lang['site_url'] = 'כתובת האתר שלך';
$lang['width'] = 'רוחב מירבי של הבאנרים';
$lang['height'] = 'גובה מירבי של הבאנרים';
$lang['linkspp'] = 'קישורים מירביים לעמוד';
$lang['interval'] = 'כיצד מהירות הבאנרים מוצגים';
$lang['display_logo'] = 'כמה באנרים מוצגים בפעם אחת';
$lang['Link_display_links_logo'] = 'הצג באנר של קישורי האתר';
$lang['Link_email_notify'] = 'בזמן שהקישור נוסף, שלח הודעה לכל המנהלים הראשיים של האתר';
$lang['Link_pm_notify'] = 'בזמן שקישור נוסף, הודע לכל המנהלים הראשיים בהודעה פרטית';
$lang['Link_config_updated'] = 'הגדרות הקישורים עודכנו בהצלחה';
$lang['Click_return_link_config'] = 'לחץ %sכאן%s כדי לחזור למנהל הגדרות הקישורים';

// Link_MOD
$lang['Links'] = "ניהול קישורים";
$lang['Links_explain'] = "מלוח בקרה זה, אתה יכול לצפות במצב של כל הקישורים ולערוך או להסיר את  הקישור נבחר.";
$lang['Add_link'] = "הוסף קישור";
$lang['Add_link_explain'] = "הטופס הבא יאפשר לך להוסיף קישור ישירות.";
$lang['Edit_link'] = "ערוך קישור";
$lang['Edit_link_explain'] = "הטופס הבא יאפשר לך לערוך את פרטי הקישור, וגם אתה יכול לבחור ל ";
$lang['Delete_link'] = "מחק קישור";
$lang['Delete_link_explain'] = "הטופס הבא יאפשר לך להסיר קישור, וגם אתה יכול לבחור ל ";
$lang['Link_update'] = "עדכן פרטי קישור";
$lang['Link_delete'] = "מחק קישור זה";
$lang['Link_title'] = "שם האתר";
$lang['Link_url'] = "כתובת האתר";
$lang['Link_logo_src'] = "לוגו האתר (88x31 פיקסלים, גודל לא יותר מ-10K)";
$lang['Link_category'] = "קטגוריית האתר";
$lang['Link_desc'] = "תיאור האתר";
$lang['link_hits'] = "לחיצות";
$lang['Link_basic_setting'] = "פרטי קישור יסודיים";
$lang['Link_adv_setting'] = "הגדרות מתקדמות";
$lang['Link_active'] = "מצב פעיל";

$lang['Link_admin_add_success'] = "הקישור נוסף בהצלחה"; 
$lang['Link_admin_add_fail'] = "לא ניתן להוסיף קישור חדש, נסה שוב מאוחר יותר"; 
$lang['Link_admin_update_success'] = "הקישור עודכן בהצלחה"; 
$lang['Link_admin_update_fail'] = "לא ניתן לעדכן את הקישור, נסה שוב מאוחר יותר"; 
$lang['Link_admin_delete_success'] = "הקישור הוסר בהצלחה";
$lang['Link_admin_delete_fail'] = "לא ניתן להסיר את הקישור, נסה שוב מאוחר יותר";
$lang['Click_return_lastpage'] = "לחץ %sכאן%s כדי לחזור לעמוד הקודם";
$lang['Click_return_admin_links'] = "לחץ %sכאן%s כדיח לחזור לניהול הקישורים";
$lang['Preview'] = "צפה בלוגו";
$lang['Search_site'] = "חפש אתר";
$lang['Search_site_title'] = "חפש את שם האתר/תיאורו:";
?>
