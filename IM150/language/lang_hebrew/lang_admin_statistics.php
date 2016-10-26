<?php
/***************************************************************************
 *                            lang_admin_statistics.php [Hebrew]
 *                              -------------------
 *     begin                : Fri Jan 24 2003
 *     copyright            : (C) 2003 Meik Sievertsen
 *     email                : acyd.burn@gmx.de
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

$lang['LEFT_Package_Module'] = 'חבילת מודולים';
$lang['Install_module'] = 'התקן מודול';
$lang['Manage_modules'] = 'נהל מודולים';
$lang['Stats_configuration'] = 'הגדרות';
$lang['Edit_module'] = 'ערוך מודול';
$lang['Stats_langcp'] = 'לוח בקרת שפה';

// Package Module
$lang['Package_module'] = 'אריזה למודול';
$lang['Package_module_explain'] = 'כאן אתה רשאי לארוז שלושה קצי מודולים לחבילת מודול אחת למסירה.';
$lang['Select_info_file'] = 'בחר את קובץ הפרטים';
$lang['Select_lang_file'] = 'בחר את קובץ השפה';
$lang['Select_module_file'] = 'בחר את קובץ המודול php';
$lang['Package_name'] = 'שם החבילה';
$lang['Create'] = 'צור';

// Install Module
$lang['Install_module_explain'] = 'כאן אתה יכול להתקין מודול חדש. אתה יכול לעשות זאת בעזרת שני שיטות. הראשונה היא העלאת חבילת המודול עם הטופס המסופק שאתה רואה למטה. אם ההעלאה אינה עובדת בשבילך, אתה יכול להעלות את חבילת המודול לתיקייה ./modules/pakfiles שלך, והיא תוצג אוטומטית כאן. להוראות בהמשך על איך להתקין את חבילת המודול, צפה בתיעוד המסופק.<br />לאחר שבחרת בחבילת המודול להתקנה, אתה תקבל כמה פרטים על המודול שבחרת. בדוק שפרטי המודול נכונים ושאתה מתאים למינימום הדרישות (למשל גרסת מוד הסטטיסטיקה נכונה). אתה יכול לבחור את השפה שאתה רוצה להתקין עם המודול גם כן. אחרי שוידאת הכל ואתה בטוח להתקין, לחץ על כפתור ההתקנה.<br />ההתקנה כברירת מחדל אינה מתקינה את המודול, אתה צריך להפעיל אותו לפני שהוא יוצג בעמוד הסטטיסטיקה.';
$lang['Select_module_pak'] = 'בחר חבילת מודול';
$lang['Upload_module_pak'] = 'העלה חבילת מודול';
$lang['Inst_module_already_exist'] = 'מודול עם השם \'%s\' כבר קיים.<br />אם אתה רוצה לעדכן מודול זה, אתה צריך לעבור לניהול המודולים ולעדכן את המודול שם.<br />אם אתה רוצה להתקין מחדש לגמרי מודול זה, אתה צריך להסיר את המודול הישן קודם.';
$lang['Incorrect_update_module'] = 'החבילה שבחרת לא מעודכנת למודול הנבחר. אנא בדוק שבחרת את החבילה הנכונה.';

$lang['Module_name'] = 'שם המודול';
$lang['Module_description'] = 'תיאור המודול';
$lang['Module_version'] = 'גרסת המודול';
$lang['Required_stats_version'] = 'מינימום גרסת מוד סטטיסטיקה דרושה';
$lang['Installed_stats_version'] = 'גרסת מוד הסטטיסטיקה מותקנת';
$lang['Module_author'] = 'מחבר המודול';
$lang['Author_email'] = 'כתובת הדואר האלקטרוני של המחבר';
$lang['Module_url'] = 'עמוד הבית של המודול/המחבר';
$lang['Update_url'] = 'עדכן את עמוד הבית של המודול (בדוק לעדכונים)';
$lang['Provided_language'] = 'שפה מסופקת';
$lang['Install_language'] = 'התקן שפה';
$lang['Module_installed'] = 'המודול הותקן בהצלחה.';
$lang['Module_updated'] = 'המודול עודכן בהצלחה.';

// Manage Modules
$lang['Manage_modules_explain'] = 'כאן אתה יכול לנהל את המודול שלך. אתה יכול לערוך אותם, למחוק אותם, לשנות את הסדר, להפעיל ולהפסיק אותם. אם אתה רוצה לההגדיר את המודול שלך (הגדרת גישות, עריכת משתני השפה ועוד), אתה צריך לערוך את המודול שלך.<br />אם אתה לוחץ על שם המודול, אתה תראה תצוגה מקדימה של המודול.';
$lang['Deactivate'] = 'הפסק';
$lang['Activate'] = 'הפעל';

// Delete Module
$lang['Confirm_delete_module'] = 'אתה בטוח שאתה רוצה למחוק מודול זה';

// Configuration
$lang['Msg_config_updated'] = '- הגדרות מוד הסטטיסטיקה עודכנו בהצלחה.';
$lang['Msg_reset_view_count'] = '- מונה הצפיות אופס בהצלחה.';
$lang['Msg_reset_install_date'] = '- תאריך ההתקנה נקבע להיום.';
$lang['Msg_reset_cache'] = '- כל הזכרון נוקה בהצלחה.';
$lang['Msg_purge_modules'] = '- תוכן תיקיית המודולים נמחקה בהצלחה.';
$lang['Config_title'] = 'הגדרות הסטטיסטיקה';
$lang['Config_explain'] = 'כאן אתה יכול להגדיר את מוד הסטטיסטיקה.';
$lang['Messages'] = 'הודעות';
$lang['Return_limit'] = 'הגבלת חזרה';
$lang['Return_limit_explain'] = 'מספר הרכיבים לכלול בכל דירוג.';
$lang['Reset_settings_title'] = 'אפס הגדרות';
$lang['Reset_view_count'] = 'אפס את מונה הצפיות';
$lang['Reset_view_count_explain'] = 'אפס את מונה הצפיות התחתית עמוד הסטטיסטיקה לאפס.';
$lang['Reset_install_date'] = 'אפס תאריך התקנה';
$lang['Reset_install_date_explain'] = 'אפס את תאריך ההתקנה. תאריך ההתקנה יקבע להיום.';
$lang['Reset_cache'] = 'נקה זיכרון';
$lang['Reset_cache_explain'] = 'נקה את כל נתוני הזיכרון הנוכחיים לכל המודולים ותכני הערכות.';
$lang['Purge_module_dir'] = 'נקה את תיקיית המודולים';
$lang['Purge_module_dir_explain'] = 'מחק את תיקיית המודולים השלמה, כל התיקיות שבתוכה והקבצים ימחקו. השתמש באפשרות זו רק אם אתה בטוח לגמרי עם מה שאתה עושה ומה יקרה לסטטיסטקיה שלך.';

// Edit Module
$lang['Msg_changed_update_time'] = '- זמן העדכון שונה בהצלחה.';
$lang['Msg_cleared_module_cache'] = '- זיכרון המודולים נוקה בהצלחה.';
$lang['Msg_module_fields_updated'] = '- שדות המודול שניתנים להגדרה עודכנו בהצלחה.';

$lang['Module_select_title'] = 'בחר מודול';
$lang['Module_select_explain'] = 'כאן אתה יכול לבחור את המודול שאתה רוצה לערוך.';
$lang['Edit_module_explain'] = 'כאן אתה יכול להגדיר את המודול. בחלק העליון תראה את פרטי המודול, ואז חלון הודעה שבו כל הודעות העדכון יוצגו. בתחתית תמצא את איזור ההגדרות ואת איזור עדכון המודול. בתוך איזור עדכון המודול, בחר חבילת מודול \'או\' העלה חבילת מודול, אנא לא את שניהם.<br />איזור ההגדרות יכול להשתנות ממודול למודול, בגלל שלכמה מודול יש אפשרויות הגדרות מיוחדות שהמחבר חשב שיכולים לעזור לך.';
$lang['Module_informations'] = 'פרטי המודול';
$lang['Module_languages'] = 'שפות שקושרו למודול זה';
$lang['Preview_module'] = 'צפה במודול';
$lang['Module_configuration'] = 'הגדרות המודול';
$lang['Update_time'] = 'זמן עדכון בדקות';
$lang['Update_time_explain'] = 'זמן השהייה (בדקות) של רענון נתוני זכרון עם נתונים חדשים. כל x דקות המודול יטען מחדש.<br />בגלל שהסטטיסטיקה משתמשת במערכת עדיפויות, זה יכול להיות גדול יותר מ-x דקות, אבל לא יותר מיום אחד.';
$lang['Module_status'] = 'מצב המודול';
$lang['Active'] = 'פעיל';
$lang['Not_active'] = 'לא פעיל';
$lang['Clear_module_cache'] = 'נקה את זכרון המודול';
$lang['Clear_module_cache_explain'] = 'נקה את זכרון המודול ואפס את עדיפויות המודולים. בפעם הבאה שעמוד הסטטיסטיקה יקרא, מודול זה יטען מחדש.';
$lang['Update_module'] = 'עדכן מודול';
$lang['No_module_packages_found'] = 'לא נמצאו חבילות מודולים';

// Permissions
$lang['Msg_permissions_updated'] = '- הגישות עודכנו';
$lang['Permissions'] = 'גישות';
$lang['Set_permissions_title'] = 'כאן אתה יכול לקבוע את הגישה לצפות במודול. רק המשתמשים (אלמוניים, רשומים, מנהלים ומנהלים ראשיים) וקבוצות שרשאיים/רשומים כאן יכולים לצפות במודול בעמוד הסטטיסטיקה.';
$lang['Perm_all'] = 'משתמשים אלמוניים';
$lang['Perm_reg'] = 'משתמשים רשומים';
$lang['Perm_mod'] = 'מנהלים';
$lang['Perm_admin'] = 'מנהלים ראשיים';
$lang['Perm_group'] = 'קבוצות';
$lang['Added_groups'] = 'הקבוצות נוספו';
$lang['Perm_add_group'] = 'הוסף קבוצה';
$lang['Perm_remove_group'] = 'הסר קבוצה';
$lang['Perm_groups_title'] = 'הקבוצות יכולות לראות מודול זה';
$lang['No_groups_selected'] = 'אין קבוצות שנבחרו';
$lang['No_groups_to_add'] = 'אין יותר קבוצות כדי להוסיף';

// Language CP
$lang['Language_key'] = 'משתנה שפה -> מפתח';
$lang['Language_value'] = 'משתנה שפה -> ערך';
$lang['Update_all_lang'] = 'עדכן את כל הרישומים';
$lang['Add_new_key'] = 'הוסף מפתח חדש';
$lang['Create_new_lang'] = 'צור שפה חדשה';
$lang['Delete_language'] = 'מחק שפה';
$lang['Language_cp_title'] = 'לוח בקרת שפה';
$lang['Language_cp_explain'] = 'כאן אתה יכול לנהל את כל משתני השפה שלך וחבילות השפה לכל מודול, הפרד, בכלל... כמעו הכל. אתה יכול ליבא או ליצא חבילות שפה כאן גם.';
$lang['Export_lang_module'] = 'יצא שפה למודול הנוכחי';
$lang['Export_language'] = 'יצא שפה נוכחית שלמה';
$lang['Export_everything'] = 'יצא הכל';
$lang['Import_new_language'] = 'יבא שפה חדשה';
$lang['Import_new_language_explain'] = 'כאן אתה יכול להעלות (או לבחור) את חבילת השפה שאתה רוצה להתקין. אחרי שהעלת (או בחרת) את חבילת השפה, אתה תראה את הפרטים על חבילת השפה. רק לאחר הצפייה בפרטים אלו החבילה תותקן.';
$lang['Select_language_pak'] = 'בחר חבילת שפה';
$lang['Upload_language_pak'] = 'העלה חבילת שפה';

$lang['Language'] = 'שפה';
$lang['Modules'] = 'מודולים';
$lang['Language_pak_installed'] = 'חבילת השפה הותקנה בהצלחה.';

?>