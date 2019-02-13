<?php

/***************************************************************************
 *                          lang_chatspot.php [Hebrew]
 *                              -------------------
 *   begin                : Tuesday, June 29, 2004
 *   copyright            : (C) 2004 masterdavid - Ronald John David
 *   website			  : http://www.integramod.com
 *   email                : webmaster@integramod.com
 *
 *   note: removing the original copyright is illegal even you have modified
 *         the code.  Just append yours if you have modified it.
 ***************************************************************************/


/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

// General
$lang['Return_2_chat'] = 'חזור לצ\'אט';
$lang['Access_denied'] = 'הגישה נדחתה';
$lang['Room_name_error'] = 'אתה יכול להשתמש באותיות לועזיות ומספרים בלבד (a-z ו-0-9) וההדגשה בשמות החדרים.';
$lang['Password_error'] = 'אתה יכול להשתמש באותיות לועזיות ומספרים בלבד (a-z ו-0-9) וההדגשה בסיסמאות.';
$lang['Cannot_determine_user_id'] = 'שגיאה:  לא ניתן לקבוע את ה-id של המשתמש.';
$lang['Cannot_determine_room_id'] = 'שגיאה:  לא ניתן לקבוע את ה-id של החדר.';
$lang['Enter_room_name'] = 'אנא הקלד את שם החדר.'; 
$lang['Group_error'] = 'החדר שביקשת מבקש חברות בקבוצה מסויימת; הגישה נדחתה.';
$lang['Password_protected_error'] = 'החדר שביקשת מוגן בסיסמא; הגישה נדחתה.';
$lang['Password_invalid_error'] = 'הסיסמא שסופקה שגוייה; הגישה נדחתה.';
$lang['Kicked_you'] = 'אתה הועפת מחדר זה.';
$lang['User_created_room'] = '<b>%s</b> יצר את החדר <b>%s</b>'; // username has created the room roomname on

// chatspot.php
$lang['Invalid_room_name'] = 'שם החדר שסופק שגוי.';
$lang['Cannot_find_room'] = 'לא ניתן למצוא את החדר.';
$lang['User_has_joined'] = '<b>%s</b> הצטרף לחדר <b>%s</b>'; // username has joined room roomname on

// config
$lang['System_msg'] = 'הודעת מערכת';

// drop
$lang['Cannot_determine_room_name'] = 'שגיאה:  לא ניתן לקבוע את שם החדר.';
$lang['Cannot_determine_username'] = 'שגיאה:  לא ניתן לקבוע את שם המשתמש.';
$lang['Leaving_room'] = 'עוזב חדר...';
$lang['Log_out'] = 'התנתק';
$lang['Left_room'] = 'עזבת את החדר \'%s\'.'; // You left teh room 'roomname'.
$lang['Logged_out'] = 'התנתקת בהצלחה מנקודת הצ\'אט של phpBB.';

// fuctions
$lang['User_kicked_from'] = '<b>%s</b> הועף מ-<b>%s</b>'; // username was kikked from roomname
$lang['Please_login'] = 'אנא התחבר לפורום כדי להשתמש בצ\'אט.';
$lang['No_Frames'] = 'הדפדפן שלך לא תומך במסגרות. אנא השתמש ב-Internet Explorer לתוצאות הכי טובות.';
$lang['Max_rooms_error'] = 'הגעת למספר המירבי המאופשר של חדרים.';
$lang['Already_in_room'] = 'רשימת ה-session מסמנת שאתה כבר בחדר \'<b>%s</b>\'. אם זה לא נכון, לחץ <a href="%s">כאן</a> כדי להצטרף לחדר.'; // room name & url inclusion
$lang['Open_room'] = 'אם החלון לא קופץ בתוך כמה רגעים לחדר \'<b>%s</b>\', חלץ <a href="%s">כאן</a>'; // room name & url inclusion
$lang['Password_cleared'] = 'הסיסמא לחדר זה הוסרה.'; 
$lang['Password_changed'] = 'הסיסמא לחדר זה שונתה.'; 
$lang['Creator_error'] = 'אתה לא היוצר של חדר זה; הגישה נדחתה.'; 
$lang['User_left_room'] = '<b>%s</b> עזב את החדר <b>%s</b>'; // username has left the room roomname on

// rooms
$lang['None'] = 'ללא'; 
$lang['Room_management'] = 'ניהול החדר'; 
$lang['Permanent_rooms'] = '<b><u>חדרים תמידיים</u></b><br />
		<br />
		לוח בקרה זה מאפשר לך לנהל את החדרים התמידיים בנקודת הצ\'אט של phpBB.  שים לב שכל המשתמשים יכולים עדיין ליצור את החדרים הזמניים שלהם.<br />
		<br />כל החדרים הזמניים הנוכחיים רשומים להלן.  שים לב שאתה יכול לשנות בלבד (או להוסיף) חדר אחד בכל פעם.  כאשר שינוי נעשה בחדר מסויים לחץ על הכפתור \'<b>עדכן</b>\' שמתאים לאותו חדר; בזמן יצירת חדר חדש לחץ על הכפתור \'<b>הוסף</b>\' לאחר הקלדת נתוני החדר החדש.<br />
		<br />
		אתה לא יכול למחוק את החדר הראשי (כברירת מחדל).<br />
		<br />'; 
$lang['Room_Name'] = 'שם החדר'; 
$lang['Group_access'] = 'קבוצת גישה'; 
$lang['Control'] = 'בקרה';
$lang['Create'] = 'צור';

// title
$lang['Refresh_Chat'] = 'רענן צ\'אט'; 
$lang['Help'] = 'עזרה'; 
$lang['About'] = 'אודות'; 
$lang['Close'] = 'סגור';

// control
$lang['User_logged_out'] = '<b>%s</b> התנתק מהפורום'; // username 
$lang['User_logged_out'] = 'ה-session של<b>%s</b> הסתיים'; // username 

// interpreter
$lang['Kick_missing_name'] = 'אנא ציין את שם המשתמש שאותו אתה רוצה להעיף.';
$lang['User_not_online'] = 'המשתמש <b>%s</b> לא מחובר.'; // username
$lang['User_not_in_room'] = 'המשתמש <b>%s</b> לא בחדר זה.'; // username

$lang['User_killed'] = 'ה-session של <b>%s</b> הסתיים.'; // username
$lang['Include_message'] = 'אנא כלול הודעה לשליחה לכל החדרים.';
$lang['Purge_complete'] = 'האיפוס הושלם.';
$lang['Marked_away'] = 'סומנת כלא זמין.';
$lang['Invite_missing_name'] = 'אנא ציין את שם המשתמש שאתה רוצה להזמין לחדר זה.';
$lang['Invite_user_away'] = 'המשתמש <b>%s</b> לא בפורום כרגע; ההזמנה לא נשלחה.'; // username
$lang['Invite_user_present'] = 'המשתמש <b>%s</b> כבר בצ\'אט; השתמש ב-<b>/p %s</b> כדי לשלוח לו הודעה פרטית.'; // username + username
$lang['Invite_error'] = 'התרחשה שגיאה בנסיון להזמין את <b>%s</b>'; // username
$lang['Invite_succeed'] = '<b>%s</b> הוזמן להצטרף לחדר בצ\'אט.'; // username
$lang['Names_room_missing'] = 'אנא כלול את שם החדר שבו לרשום את שמות המשתמשים.';
$lang['Room_not_exist'] = 'החדר <b>%s</b> לא קיים.'; // roomname
$lang['Users_in_room'] = 'המשתמשים הבאים בחדר <b>%s</b>:  '; // roomname
$lang['Pm_missing_name'] = 'אנא הקלד את שם המשתמש שאליו אתה רוצה לשלוח הודעה פרטית.';
$lang['Missing_Message'] = 'אנא כלול את ההודעה שאתה רוצה לשלוח למשתמש.';
$lang['Message_not_send'] = 'ההודעה לא נשלחה.';
$lang['Command_ignored'] = 'הפקודה <b>%s</b> לא שרירה; התעלם.'; // command

// send
$lang['Command_ignored'] = 'בקרת הצפה: אתה לא יכול לשלוח יותר מהודעה אחת בתוך %s שניות.'; // config seconds
$lang['Loading_error'] = 'בקרת התמונה לא הסתיימה להטען.  נסה להמתין כמה שניות, או לחץ על הקישור \'רענן צ\'אט\', או צא והכנס שוב.';
$lang['Invite_Flood'] = 'בקרת הצפת הזמנות:  אתה לא יכול להזמין יותר מאדם אחד בתוך %s שניות.'; // config seconds

// manager
$lang['Room_management_response'] = 'תשובת ניהול החדר';
$lang['Room_delete_error'] = 'התרחשה שגיאה בלתי ידועה בזמן מחיקת החדר המבוקש.';
$lang['Room_delete_success'] = 'החדר המבוקש נמחק בהצלחה.';
$lang['Room_exists'] = 'שגיאה:  החדר <b>%s</b> כבר קיים.'; // roomname
$lang['Room_create_success'] = 'החדר המבוקש נוצר בהצלחה.';
$lang['Room_create_error'] = 'התרחשה שגיאה בלתי ידועה בזמן יצירת החדר המבוקש.';
$lang['Room_update_error'] = 'התחרשה שגיאה בלתי ידועה בזמן עדכון החדר המבוקש.';
$lang['Room_update_success'] = 'החדר המבוקש עודכן בהצלחה.';


// invite
$lang['Inviting_you'] = '%s הזמין אותך להכנס לצ\'אט'; //username
$lang['Pm_invite'] = '%s רוצה שאתה תצטרף לחדר %s. <a href="%s">לחץ כאן כדי להצטרף.</a>'; // username + roomname + link
?>