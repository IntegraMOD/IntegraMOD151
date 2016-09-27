<?php
/***************************************************************************
 *						lang_extend_pcp_management.php [Hebrew]
 *						---------------------------------------
 *	begin				: 08/10/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 0.0.4 - 24/10/2003
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
	$lang['Lang_extend_pcp_management'] = 'ניהול לוח הבקרה לפרופיל';

	// menu
	$lang['PCP_management'] = 'לוח בקרה לפרופיל';
	$lang['PCP_00_tableslinked'] = 'טבלאות שקושרו';
	$lang['PCP_01_valueslist'] = 'רשימות ערכים';
	$lang['PCP_02_classesfields'] = 'מחלקות';
	$lang['PCP_03_userfields'] = 'הגדרת שדות';
	$lang['PCP_04_usermaps'] = 'הגדרת מפות';

	// objects
	$lang['PCP_tableslinked'] = 'טבלאות שקושרו';
	$lang['PCP_tableslinked_explain'] = 'הטבלאות משומשות על-ידי לוח הבקרה לפרופיל לרשימת ערכים ורשימות חברים/חברים אישית.';

	$lang['PCP_valueslist'] = 'רשימות ערכים';
	$lang['PCP_valueslist_explain'] = 'רשימת ערכים המשומשים על-ידי לוח הבקרה לפרופיל.';

	$lang['PCP_classesfields'] = 'מחלקות';
	$lang['PCP_classesfields_explain'] = 'כאן תוכל לערוך או למחוק את שדות המחלקות.';

	$lang['PCP_userfields'] = 'הגדרת שדות';
	$lang['PCP_userfields_explain'] = 'כאן תוכל לנהל את השדות המשומשות על-ידי לוח הבקרה לפרופיל.';

	$lang['PCP_usermaps'] = 'הגדרת מפות';
	$lang['PCP_usermaps_explain'] = 'כאן תוכל לנהל את שדות המפות המשומשות במקומות השונים.';

	// fields
	$lang['PCP_field_name'] = 'שם השדה';
	$lang['PCP_field_name_explain'] = 'קבע כאן את שם השדה המשומש בתסריטי ה-php.';
	$lang['PCP_field_name_short'] = 'שדה';
	$lang['PCP_field_desc'] = 'תיאור';
	$lang['PCP_field_image'] = 'תמונה';
	$lang['PCP_field_class'] = 'מחלקה';
	$lang['PCP_field_type'] = 'סוג';
	$lang['PCP_field_get_mode'] = 'קבל מצב';
	$lang['PCP_field_functions'] = 'פונקציות';
	$lang['PCP_field_maps_usage'] = 'משומש במפות';

	$lang['PCP_field_sql_actions'] = 'פעולות SQL';
	$lang['PCP_field_add'] = 'הוסף שדה חדש';

	// fields edit
	$lang['PCP_userfields_edit'] = 'עריכת שדות';
	$lang['PCP_userfields_edit_explain'] = 'כאן תוכל לערוך או למחוק שדה.';

	$lang['PCP_field_definition_part'] = 'הגדרת בסיס';
	$lang['PCP_field_output_part'] = 'פלט';
	$lang['PCP_field_input_part'] = 'מוכנס';
	$lang['PCP_field_buddylist_part'] = 'רשימת חברים/חברים אישית';

	$lang['PCP_field_lang_key'] = 'אורך השדה';
	$lang['PCP_field_lang_key_explain'] = 'זהו האורך שיהיה בשימוש להצגת השדה. אתה יכול להשתמש בטקסט או במפתח הרישום $lang[] (ראה <i>your_language</i>/lang_main.php).';
	$lang['PCP_field_lang_key_short'] = 'אורך';
	$lang['PCP_field_explain'] = 'הסבר השדה';
	$lang['PCP_field_explain_explain'] = 'זהו הסבר השדה שיהיה בשימוש להצגה. אתה יכול להשתמש בטקסט או במפתח הרישום $lang[] (ראה <i>your_language</i>/lang_main.php).';
	$lang['PCP_field_image_explain'] = 'אתה יכול לקבוע כאן כתובת ישירה או מפתח רישום $image[] (ראה <i>your_template</i>/<i>your_template</i>.cfg).';
	$lang['PCP_field_title'] = 'כותרת התמונה';
	$lang['PCP_field_title_explain'] = 'הטקסט המוצג בבועה תחת סימון העכבר. אתה יכול להשתמש בטקסט או במפתח הרישום $lang[] (ראה <i>your_language</i>/lang_main.php).';
	$lang['PCP_field_class_explain'] = 'קבע על איזה תנאי התוכן של השדה מוצג. השתמש בכללי לשדה ללא תנאי.';
	$lang['PCP_field_type_explain'] = 'קבע כאן את סוג השדה.';

	$lang['PCP_field_sql_def'] = 'הגדרת SQL';
	$lang['PCP_field_sql_def_explain'] = 'הגדרת SQL של השדה בזמן השימוש ברשימת החברים/רשימת החברים האישית.';

	$lang['PCP_field_get_mode_explain'] = 'קבע כאן את הדרך שבה השדה יוכנס. אם אתה משתמש בפונקציות מותאמות כדי לקבל ולסמן, השאר שדות אלו ריקים.';
	$lang['PCP_field_values_list'] = 'רשימת ערכים';
	$lang['PCP_field_values_list_explain'] = 'קבע כאן את ההשם של רשימת הערכים. רשימת הערכים נדרשת בזמן השימוש בקבלת מצב LIST_*.';
	$lang['PCP_field_default'] = 'ערך ברירת מחדל';
	$lang['PCP_field_default_explain'] = 'ערך יחיד לשדה.';
	$lang['PCP_field_auth'] = 'רמת גישה';
	$lang['PCP_field_auth_explain'] = 'קבע כאן את רמת הגישה המינימלית הנדרשת כדי לגשת לשדה זה.';
	$lang['PCP_field_get_func'] = 'קבל פונקציה';
	$lang['PCP_field_get_func_explain'] = 'קבע כאן את שם הפונקציה המותאמת בשימוש כדי להכניס את הערך של השדה.';
	$lang['PCP_field_chk_func'] = 'בדוק פונקציה';
	$lang['PCP_field_chk_func_explain'] = 'קבע כאן את שם הפונקציה המותאמת בשימוש כדי לבדוק את התוקף של השדה לאחר ההכנסה.';
	$lang['PCP_field_dsp_func'] = 'הצג פונקציה';
	$lang['PCP_field_dsp_func_explain'] = 'קבע כאן את שם הפונקציה המותאמת בשימוש להצגת הערך של השדה.';
	$lang['PCP_field_link'] = 'קישור';
	$lang['PCP_field_link_explain'] = 'זה יאפשר לעשות קישור בטקסט ובתמונה. אתה יכול להשתמש ב-[cst.*], [view.*] ו-[user.*] כדי למלא את הפרמטרים של התוכנית שנקראה. למשל :<br />&lt;a href="./profile.[php]?mode=viewprofile&[cst.POST_USERS_URL]=[view.user_id]" class="gen"&gt;%s&lt;/a&gt;';

	$lang['PCP_field_leg'] = 'הצג את האורך';
	$lang['PCP_field_leg_explain'] = 'קבע זאת לכן כדי להציג את אורך השדה.';
	$lang['PCP_field_leg_short'] = 'אורך';
	$lang['PCP_field_txt'] = 'הצג את ערך הטרסט';
	$lang['PCP_field_txt_explain'] = 'קבע זאת לכן כדי להציג את ערך הטקסט של השדה.';
	$lang['PCP_field_txt_short'] = 'טקסט';
	$lang['PCP_field_img'] = 'הצג את ערך התמונה';
	$lang['PCP_field_img_explain'] = 'קבע זאת לכן כדי להציג את ערך התמונה של השדה.';
	$lang['PCP_field_img_short'] = 'תמונה';
	$lang['PCP_field_use_link'] = 'השתמש בקישור';
	$lang['PCP_field_use_link_explain'] = 'קבע זאת לכן כדי להוסיף את הקישור לערך הטקסט ו/או לתמונה.';
	$lang['PCP_field_use_link_short'] = 'קישור';
	$lang['PCP_field_crlf'] = 'טקסט ליד שורה';
	$lang['PCP_field_crlf_explain'] = 'קבע זאת לכן כדי לכתוב את הטקסט מתחת לתמונה.';
	$lang['PCP_field_style'] = 'הצג Span';
	$lang['PCP_field_style_explain'] = 'ביטוי HTML מעוצב כדי להיות בעל התוצאה הטובה ביותר של התוצאה. <i>sprintf(עיצוב, תוצאה)</i> תבוצע, אז אתה צריך להשתמש ב %s כדי לעצב את נקודת התוצאה שתשמש.<br />לדוגמא: &lt;i&gt;%s&lt/i&gt; תקבע את התוצאה באיטלקית.';
	$lang['PCP_field_input_id'] = 'שם שדה ההגדרות';
	$lang['PCP_field_input_id_explain'] = 'זה יהיה שם הערך בשדה הכנסת קלט, וגם תשומש כשם ערך הגדרות לטבלת ההגדרות.';
	$lang['PCP_field_user_only'] = 'לא ערוך הגדרות';
	$lang['PCP_field_user_only_explain'] = 'קביעת זו לכן תמנע מעך ההגדרות להווצר ו/או להתעדכן. אתה יכול להשתמש בזה כדי לעצב את שדה טבלת המשתמשים או שדה מערכת.';
	$lang['PCP_field_system'] = 'שדה מערכת';
	$lang['PCP_field_system_explain'] = 'קביעת זו לכאן תדרוש שדה זה להיות מוצג להכנסה, אפילו אם זה לא שדה הגדרות ולא שדה טבלת משתמשים. זה ידרוש קבלה ויבדוק פונקציות. השתמש בזה לקישורים או כפתורים, או שדות מיוחדים אחרים, כמו באים מטבלאות טחאות.';
	$lang['PCP_field_ind'] = 'כתובת אפשרות';
	$lang['PCP_field_ind_explain'] = 'לרשימות חברים/חברים אישית : זוהי כתובת השדה בשדה אפשרויות המשתמש.';
	$lang['PCP_field_dft'] = 'נבדק על-ידי ברירת מחדל';
	$lang['PCP_field_dft_explain'] = 'לרשימות חברים/חברים אישית : בחירה כברירת מחדל לשדה ברשימת החברים/החברים אישית.';
	$lang['PCP_field_rqd'] = 'דרוש את הבחירה';
	$lang['PCP_field_rqd_explain'] = 'לרשימות חברים/חברים אישית : זה ידרוש את הבחירה של השדה ברשימת חברים/חברים אישית.';
	$lang['PCP_field_hidden'] = 'הוסף את השדה כמוסתר';
	$lang['PCP_field_hidden_explain'] = 'לרשימות חברים/חברים אישית : זו תהיה התוצאה בהוספת השדה לדרישת sql ללא הצגתו ברשימת חברים/חברים אישית.';

	$lang['PCP_system_values'] = 'ערכי מערכת זמינים';

	$lang['PCP_userfields_field_pick_up'] = 'אסוף שדה';
	$lang['PCP_userfields_lang_key_pick_up'] = 'אסוף מפתח שפה';

	// fields delete
	$lang['PCP_userfields_delete'] = 'כבה שדה';

	// SQL actions
	$lang['PCP_SQL_create_field'] = 'לחץ %sכאן%s כדי ליצור שדה בטבלת המשתמשים.<br /><br />';
	$lang['PCP_SQL_modify_field'] = 'לחץ %sכאן%s כדי לשנות שדה בטבלת המשתמשים.<br /><br />';
	$lang['PCP_SQL_delete_field'] = 'מחק את השדה מטבלת המשתמשים ?';

	$lang['PCP_SQL_create_field_title'] = 'צור שדה בטבלת המשתמשים';
	$lang['PCP_SQL_edit_field_title'] = 'שנה שדה בטבלת המשתמשים';
	
	$lang['PCP_SQL_field_name'] = 'שם השדה';
	$lang['PCP_SQL_field_name_explain'] = 'שם העמודה של הטבלה.';
	$lang['PCP_SQL_field_type'] = 'סוג';
	$lang['PCP_SQL_field_type_explain'] = 'סוג העמודה של הטבלה';
	$lang['PCP_SQL_field_length'] = 'אורך';
	$lang['PCP_SQL_field_length_explain'] = 'אורך העמודה של הטבלה.';
	$lang['PCP_SQL_field_unsigned'] = 'לא חתום';
	$lang['PCP_SQL_field_unsigned_explain'] = 'לשדה מספרי בלבד.';
	$lang['PCP_SQL_null'] = 'ריק מאופשר';
	$lang['PCP_SQL_default'] = 'ערך ברירת מחדל';
	$lang['PCP_SQL_null_value'] = 'ריק';

	// tables linked
	$lang['PCP_tableslinked_name_short'] = 'שמות';
	$lang['PCP_tableslinked_name'] = 'שם הטבלה שקושרה';
	$lang['PCP_tableslinked_name_explain'] = 'שם זה יזהה את הגדרת הטבלה בהגדרות SQL שונות של שדות לוח הבקרה לנקודות, מוקפות על-ידי [].<br />(למשל: טבלת המשתמשים תזוהה על-ידי [USERS])';
	$lang['PCP_tableslinked_id_short'] = 'Id';
	$lang['PCP_tableslinked_id'] = 'id של ה-SQL';
	$lang['PCP_tableslinked_id_explain'] = 'מזהה SQL, משומש על-ידי דרישות SQL.<br />(למשל : "u" מושמש בדרך כלל ב-id של ה-SQL לטבלת המשתמשים)';
	$lang['PCP_tableslinked_join'] = 'SQL join';
	$lang['PCP_tableslinked_join_explain'] = 'הצהרת FROM משומשת בדרישות SQL.<hr />&nbsp;השתמש [cst.<i>תוכן טבלה</i>] כדי להחזיר את שם הטבלה האמיתית.<br />(למשל : [cst.USERS_TABLE] ל-phpbb_users).<hr />&nbsp;Use [<i>שם טבלאות שקושרו</i>] כדי לזהה את ה-id של ה-SQL.<br />(למשל: [USERS].username)<hr />לדוגמא: [cst.USERS_TABLE] AS [USERS]';
	$lang['PCP_tableslinked_where'] = 'SQL where';
	$lang['PCP_tableslinked_where_explain'] = 'הצהרת WHERE משומשת בדרישות SQL.<br />השתמש [<i>שם טבלאות שקושרו</i>] כדי לזהות את ה-id של ה-SQL.<br />(למשל: [USERS].username <> \'\')';
	$lang['PCP_tableslinked_order'] = 'SQL order by';
	$lang['PCP_tableslinked_order_explain'] = 'הצהרת ORDER BY משומשת בדרישות SQL.<br />השתמש [<i>שם טבלאות שקושרו</i>] כדי לזהות את ה-id של ה-SQL.<br />(למשל: [USERS].username)';
	$lang['PCP_tableslinked_sql_desc'] = 'הצהרות SQL';

	$lang['PCP_tableslinked_add'] = 'הוסף טבלה שקושרה חדשה';

	// tables linked edit
	$lang['PCP_tableslinked_linked_edit'] = 'ערוך טבלה שקושרה';
	$lang['PCP_tableslinked_linked_edit_explain'] = 'כאן אתה יכול לערוך או למחוק טבלה שקושרה.';

	// values list
	$lang['PCP_valueslist_name'] = 'שם';
	$lang['PCP_valueslist_name_explain'] = 'שם זה יזהה את רשימת הערכים בהגדרות SQL השונות של שדות לוח הבקרה לנקודות, מוקפות על-ידי [].';
	$lang['PCP_valueslist_func'] = 'פונקציה';
	$lang['PCP_valueslist_func_explain'] = 'קבע כאן את שם הפונקציה המותאמת המשומשת לבניית רשימת הערכים.';
	$lang['PCP_valueslist_table'] = 'טבלה';
	$lang['PCP_valueslist_table_explain'] = 'שם הטבלה שקושרה משומשת לבניית רשימת הערכים לשדה זה.';
	$lang['PCP_valueslist_values'] = 'ערכים';

	$lang['PCP_valueslist_item_val'] = 'ערך';
	$lang['PCP_valueslist_item_txt'] = 'טקסט';
	$lang['PCP_valueslist_item_img'] = 'תמונה';

	$lang['PCP_valueslist_add'] = 'הוסף רשימת ערכים חדשה';

	// values list edit
	$lang['PCP_valueslist_edit'] = 'ערוך רשימת ערכים';
	$lang['PCP_valueslist_edit_explain'] = 'כאן אתה יכול לערוך או למחוק את רשימת הערכים.';
	$lang['PCP_valueslist_keyfield'] = 'מפתח שדה';
	$lang['PCP_valueslist_keyfield_explain'] = 'שדה זה מכיל את הערך של כל בחירה.';
	$lang['PCP_valueslist_txtfield'] = 'טקסט השדה';
	$lang['PCP_valueslist_txtfield_explain'] = 'שדה זה מכיל את הטקסט להצגה.';
	$lang['PCP_valueslist_imgfield'] = 'תמונת השדה';
	$lang['PCP_valueslist_imgfield_explain'] = 'שדה זה מכיל את התמונה להצגה.';

	$lang['PCP_valueslist_add_item'] = 'הוסף ערך חדש';
	$lang['PCP_valueslist_del_item'] = 'מחק בחירה';

	// classes fields
	$lang['PCP_classesfields_name'] = 'שם מחלקות';
	$lang['PCP_classesfields_name_explain'] = 'שם זה יזהה את המחלקות של השדה.';
	$lang['PCP_classesfields_config'] = 'שדה הגדרות';
	$lang['PCP_classesfields_config_explain'] = 'קבע כאן את השדה המנוהל על-ידי המנהלים הראשיים של המערכת כדי לאפשר או לא את השימוש של השדות של מחלקה זו לכל המשתמשים.';
	$lang['PCP_classesfields_admin'] = 'שדה מנהל ראשי';
	$lang['PCP_classesfields_admin_explain'] = 'קבע כאן את השדה המנוהל על-ידי משתמשי המנהלים הראשיים כדי לאפשר או לא את השימוש של השדות של מחלקה זו למשתמש מסויים.';
	$lang['PCP_classesfields_user'] = 'שדה משתמש';
	$lang['PCP_classesfields_user_explain'] = 'קבע כאן את שדה העדפות המשתמש המשומש להצגת המידע או לא של מחלקה זו.';
	$lang['PCP_classesfields_sql_def'] = 'הגדרת SQL';
	$lang['PCP_classesfields_sql_def_explain'] = 'זוהי הגדרת ה-sql למחלקה זו המשומשת ברשימת החברים/חברים אישית.';

	$lang['PCP_classesfields_add'] = 'הוסך מחלקה חדש';

	// classes fields edit
	$lang['PCP_classesfields_edit'] = 'ערוך מחלקה';
	$lang['PCP_classesfields_edit_explain'] = 'כאן אתה יכול לערוך או למחוק מחלקת שדה.';

	// usermaps
	$lang['PCP_usermaps_root'] = 'ראשי';

	$lang['PCP_usermaps_name'] = 'שם מפה';
	$lang['PCP_usermaps_name_explain'] = 'שם זה יזהה את המפה המשומשת.';
	$lang['PCP_usermaps_split'] = 'עמודה חדשה';
	$lang['PCP_usermaps_split_explain'] = 'פצל את התצוגה בעמודה חדשה.';
	$lang['PCP_usermaps_sub'] = 'תת-מפות';
	$lang['PCP_usermaps_add'] = 'הוסף מפה חדשה';
	$lang['PCP_usermaps_custom'] = 'תוכנית משומשת';
	$lang['PCP_usermaps_custom_explain'] = 'קבע כאן אם אתה רוצה להשתמש בתוכנית הלוח הרגיל להצגת מפה זו.';
	$lang['PCP_custom_none'] = 'תוכנית מסורה';
	$lang['PCP_custom_input'] = 'תוכנית הכנסה רגילה';
	$lang['PCP_custom_output'] = 'תוכנית פלט רגילה';

	$lang['PCP_usermaps_fields'] = 'שדות';

	// usermaps edit
	$lang['PCP_usermaps_edit'] = 'ערוך מפה';
	$lang['PCP_usermaps_edit_explain'] = 'כאן אתה יכול לערוך או למחוק מפה.';
	$lang['PCP_usermaps_title'] = 'כותרת המפה';
	$lang['PCP_usermaps_title_explain'] = 'כותרת המפה תשומש בכמה הצגות. אתה יכול לקבוע כאן כותרת, או קביעה של שדה כדי לבנות את הכותרת איתה.';
	$lang['PCP_usermaps_parent'] = 'מפת אם';
	$lang['PCP_usermaps_parent_explain'] = 'קבע כאן לאיזו מפה מפה זו תצורף.';

	$lang['PCP_usermaps_add_titlefield'] = 'הוסף שדה כותרת חדש';
	$lang['PCP_usermaps_add_field'] = 'הוסף שדה חדש';

	// usermaps field edit
	$lang['PCP_usermaps_title_edit'] = 'ערוך שדה כותרת';
	$lang['PCP_usermaps_title_edit_explain'] = 'כאן אתה יכול לערוך או למחוק את השדה המשומש בכותרת המפה.';
	$lang['PCP_usermaps_field_edit'] = 'ערוך שדה';
	$lang['PCP_usermaps_field_edit_explain'] = 'כאן אתה יכול לערוך או למחוק את השדה המשומש במפה.';

	// error msgs
	$lang['PCP_err_field_already_exists'] = 'שדה זה כבר קיים.';
	$lang['PCP_err_field_name_not_valid'] = 'שם השדה הוא לא אחד שריר.';
	$lang['PCP_err_field_lang_key_missing'] = 'מפתח השפה שגוי.';
	$lang['PCP_err_field_class_unknown'] = 'מחלקה לא ידועה.';
	$lang['PCP_err_field_type_unknown'] = 'סוג לא ידוע.';
	$lang['PCP_err_field_get_mode_unknown'] = 'קבלת מצב לא ידוע.';
	$lang['PCP_err_field_values_list_unknown'] = 'רשימת ערכים לא ידועה.';
	$lang['PCP_err_field_auth_unknown'] = 'רמת גישה לא ידועה.';

	$lang['PCP_err_field_values_list_missing'] = 'רשימת הערכים נמנעה אם אתה משתמש בקבלת מצב LIST_*.';
	$lang['PCP_err_field_values_list_presents'] = 'אתה לא יכול להשתמש ברשימת הערכים אם אתה לא משתמש בקבלת מצב LIST_*.';
	$lang['PCP_err_field_get_mode_presents'] = 'אתה לא יכול לקבוע קבלת מצב בזמן שימוש בקבלה ובדיקת פונקציות.';
	$lang['PCP_err_field_dsp_func_not_valid'] = 'לפונקציית התצוגה אין שם שריר.';
	$lang['PCP_err_field_dsp_func_unknown'] = 'פונקציית התצוגה אינה ידועה.';
	$lang['PCP_err_field_get_func_not_valid'] = 'לפונקציית הקבלה אין שם שריר.';
	$lang['PCP_err_field_chk_func_not_valid'] = 'לפונקציית הבדיקה אין שם שריר.';
	$lang['PCP_err_field_get_chk_func_missing'] = 'אתה צקיך לספק גם את פונקציית הבדיקה וגם את פונקציית הקבלה.';

	$lang['PCP_err_sql_delete_not_allow'] = 'אתה לא יכול להסיר שדה זה מטבלת המשתמשים.';
	$lang['PCP_err_sql_edit_not_allow'] = 'אתה לא יכול ליצור או לשנות שדה ה מטבלת המשתמשים.';
	$lang['PCP_err_sql_decimal_not_allow'] = 'אתה לא יכול לקבוע עשרוניים ללא שימוש בסוג עשרוני.';
	$lang['PCP_err_sql_decimal_too_high'] = 'המספר העשרוני לא יכול להיות גדול או שווה לאורך השדה.';
	$lang['PCP_err_sql_length_missing'] = 'אורך השדה שגוי.';
	$lang['PCP_err_sql_unsigned_not_allow'] = 'לא חתום מאופשר רק עם סוגים מספריים.';
	$lang['PCP_err_sql_default_null_not_allow'] = 'ערך ברירת המחדל לא יכול להיות ריק אם השדה לא מקבל ערכים ריקים.';
	$lang['PCP_err_sql_failed'] = 'דרישת SQL זו נכשלה :';

	$lang['PCP_err_tableslinked_already_exists'] = 'שם הטבלה שקושרה כבר קיים.';
	$lang['PCP_err_tableslinked_name_not_valid'] = 'שם הטבלה שקושרה לא אחד שריר.';
	$lang['PCP_err_tableslinked_sql_id_not_valid'] = 'ה-id של הטבלה שקושרה לא אחד שריר.';
	$lang['PCP_err_tableslinked_sql_join_missing'] = 'הטבלה המצורפת שקושרה ריקה.';

	$lang['PCP_err_valueslist_already_exists'] = 'שם רשימת הערכים כבר קיים.';
	$lang['PCP_err_valueslist_name_not_valid'] = 'שם רשימת הערכים לא אחד שריר.';
	$lang['PCP_err_valueslist_func_not_valid'] = 'שם פונקציית רשימת הערכים לא אחד שריר.';
	$lang['PCP_err_valueslist_no_data'] = 'אין דבר ברשימת הערכים.';

	$lang['PCP_err_classesfields_already_exists'] = 'שם המחלקות כבר קיים.';
	$lang['PCP_err_classesfields_name_not_valid'] = 'שם המחלקות לא אחד שריר.';
	$lang['PCP_err_classesfields_config_field_not_valid'] = 'שדה ההגדרות לא אחד שריר.';
	$lang['PCP_err_classesfields_admin_not_valid'] = 'שדה המנהל הראשי לא אחד שריר.';
	$lang['PCP_err_classesfields_user_not_valid'] = 'שדה המשתמש לא אחד שריר.';

	$lang['PCP_err_usermaps_already_exists'] = 'המפה כבר קיימת.';
	$lang['PCP_err_usermaps_name_not_valid'] = 'שם המפה לא אחד שריר.';
	$lang['PCP_err_usermaps_not_empty'] = 'ישנם כמה מפות שעדיין מצורפות למפה שאתה רוצה למחוק. אנא צרף אותם ראשית לכל מקום אחר.';
	$lang['PCP_err_usermaps_field_already_in_map'] = 'שדה זה כבר קיים במפה.';

	// global message, return path
	$lang['PCP_field_created'] = 'הגדרת השדה נוצרה.<br /><br />%sלחץ %sכאן%s כדי לחזור לרשימת השדות.';
	$lang['PCP_field_modified'] = 'הגדרת השדה שונתה.<br /><br />%sלחץ %sכאן%s כדי לחזור לרשימת השדות.';
	$lang['PCP_field_delete'] = 'אתה בטוח שאתה רוצה למחוק את ההגדרה <b>%s</b> ?';
	$lang['PCP_field_deleted'] = 'הגדרת השדה נמחקה.<br /><br />לחץ %sכאן%s כדי לחזור לרשימת השדות.';

	$lang['PCP_sql_field_created'] = 'השדה נוצר בהצלחה בטבלת המשתמשים.<br /><br />לחץ %sכאן%s כדי לחזור לרשימת השדות.';
	$lang['PCP_sql_field_modified'] = 'השדה עודכן בהצלחה בטבלת המשתמשים.<br /><br />לחץ %sכאן%s כדי לחזור לרשימת השדות.';
	$lang['PCP_sql_field_deleted'] = 'השדה נמחק בהצלחה מטבלת המשתמשים.<br /><br />לחץ %sכאן%s כדי לחזור לרשימת השדות.';
	$lang['PCP_sql_field_deleted_short'] = 'השדה נמחק בהצלחה מטבלת המשתמשים.';

	$lang['PCP_tableslinked_created'] = 'הגדרת הטבלה שקושרה נוצרה.<br /><br />לחץ %sכאן%s כדי לחזור לרשימת הטבלאות שקושרו.';
	$lang['PCP_tableslinked_modified'] = 'הגדרות הטבלה שקושרה שונתה.<br /><br />לחץ %sכאן%s כדי לחזור לרשימת הטבלאות שקושרו.';
	$lang['PCP_tableslinked_deleted'] = 'הגדרת הטבלה שקושרה נמחקה.<br /><br />לחץ %sכאן%s כדי לחזור לרשימת הטבלאות שקושרו.';

	$lang['PCP_valueslist_created'] = 'הגדרת רשימת הערכים נוצרה.<br /><br />לחץ %sכאן%s כדי לחזור לרשימת הערכים.';
	$lang['PCP_valueslist_modified'] = 'הגדרת רשימת הערכים שונתה.<br /><br />לחץ %sכאן%s כדי לחזור לרשימת הערכים.';
	$lang['PCP_valueslist_deleted'] = 'הגדרת רשימת הערכים נמחקה.<br /><br />לחץ %sכאן%s כדי לחזור לרשימת הערכים.';

	$lang['PCP_classesfields_created'] = 'הגדרת המחלקה נוצרה.<br /><br />לחץ %sכאן%s כדי לחזור לרשימת המחלקות.';
	$lang['PCP_classesfields_modified'] = 'הגדרת המחלקה שונתה.<br /><br />לחץ %sכאן%s כדי לחזור לרשימת המחלקות.';
	$lang['PCP_classesfields_deleted'] = 'הגדרת המחלקה נמחקה.<br /><br />לחץ %sכאן%s כדי לחזור לרשימת המחלקות.';

	$lang['PCP_usermaps_created'] = 'הגדרת המפה נוצרה.<br /><br />לחץ %sכאן%s כדי לחזור לרשימת המפות.';
	$lang['PCP_usermaps_modified'] = 'הגדרת המפה שונתה.<br /><br />לחץ %sכאן%s כדי לחזור לרשימת המפות.';
	$lang['PCP_usermaps_deleted'] = 'הגדרת המפה נמחקה.<br /><br />לחץ %sכאן%s כדי לחזור לרשימת המפות.';

	// generic
	$lang['PCP_config_values'] = 'ערכי הגדרות';
	$lang['PCP_view_user_values'] = 'משתמש צפה בשדות';
	$lang['PCP_user_values'] = 'משתמש פועל בשדות';

	$lang['Refresh'] = 'רענן';
	$lang['Create'] = 'צור';
	$lang['Suggest'] = 'הצע';
	$lang['More'] = 'עוד...';

	$lang['Auth_GUEST'] = 'כל אחד';
	$lang['Auth_USER'] = 'משתמש רשום';
	$lang['Auth_ADMIN'] = 'משתמשי מנהל ראשי';
	$lang['Auth_BOARD_ADMIN'] = 'המנהל הראשי של המערכת';

	$lang['Up'] = '^';
	$lang['Down'] = 'v';

	$lang['Linefeed'] = '---';

	// PCP Extra :: Added :: Start
	$lang['PCP_field_required'] = 'שדה נדרש';
	$lang['PCP_field_required_explain'] = 'קביעת זו לכן תדרוש מהמשתמש לשלוח את הערך לשדה.';
	$lang['Auth_GUEST_ONLY'] = 'אורח בלבד';
	$lang['PCP_field_visibility'] = 'הצגה חזותית';
	$lang['PCP_field_visibility_explain'] = 'הצג למשתמש, מי שיראה את הנתונים שהוקלדו.';
	$lang['PCP_field_inputstyle'] = 'הכנס עיצוב ערכה';
	$lang['PCP_field_inputstyle_explain'] = 'ב-board_config_body.tpl אנו נבצע את ה-html של הערכה בין &lt;!-- BEGIN inputstyle --&gt; ו-&lt;!-- END inputstyle --&gt; כאשר inputstyle הוא השם המוקלד כאן. השאר ריק לברירת המחדל שהיא "field".';
	// PCP Extra :: Added :: End
}

?>