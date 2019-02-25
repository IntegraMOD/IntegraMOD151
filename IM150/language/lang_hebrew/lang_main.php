<?php
/***************************************************************************
 *                            lang_main.php [Hebrew]
 *                              -------------------
 *     begin                : Sat Dec 16 2000
 *     copyright            : (C) 2001 The phpBB Group
 *     email                : support@phpbb.com
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

//
// CONTRIBUTORS:
//	 Add your details here if wanted, e.g. Name, username, email address, website
// 2002-08-27  Philip M. White        - fixed many grammar problems
//

//
// The format of this file is ---> $lang['message'] = 'text';
//
// You should also try to set a locale and a character encoding (plus direction). The encoding and direction
// will be sent to the template. The locale may or may not work, it's dependent on OS support and the syntax
// varies ... give it your best guess!
//

$lang['ENCODING'] = 'utf-8';
$lang['DIRECTION'] = 'Rtl';
$lang['LEFT'] = 'right';
$lang['RIGHT'] = 'left';
$lang['DATE_FORMAT'] =  'd/m/Y ב- H:i:s'; // This should be changed to the default date format for your language, php date() format
$lang['Ignore'] = 'התעלם';

// This is optional, if you would like a _SHORT_ message output
// along with our copyright message indicating you are the translator
// please add it here.
$lang['TRANSLATION_INFO'] = '';

//
// Common, these terms are used
// extensively on several pages
//
$lang['Forum'] = 'פורום';
$lang['Category'] = 'קטגוריה';
$lang['Topic'] = 'נושא';
$lang['Topics'] = 'נושאים';
$lang['Replies'] = 'תגובות';
$lang['Views'] = 'צפיות';
$lang['Post'] = 'הודעה';
$lang['Posts'] = 'הודעות';
$lang['Posted'] = 'נשלח';
$lang['Username'] = 'שם משתמש';
$lang['Password'] = 'סיסמא';
$lang['Email'] = 'דואר אלקטרוני';
$lang['Poster'] = 'שולח';
$lang['Author'] = 'מחבר';
$lang['Time'] = 'זמן';
$lang['Hours'] = 'שעות';
$lang['Message'] = 'הודעה';

$lang['1_Day'] = 'יום אחד';
$lang['7_Days'] = '7 ימים';
$lang['2_Weeks'] = '2 שבועות';
$lang['1_Month'] = 'חודש אחד';
$lang['3_Months'] = '3 חודשים';
$lang['6_Months'] = '6 חודשים';
$lang['1_Year'] = 'שנה אחת';

$lang['Go'] = 'עבור';
$lang['Jump_to'] = 'עבור ל';
$lang['Submit'] = 'שליחה';
$lang['Reset'] = 'איפוס';
$lang['Cancel'] = 'ביטול';
$lang['Preview'] = 'תצוגה מקדימה';
$lang['Confirm'] = 'אישור';
$lang['Spellcheck'] = 'בדיקת איות';
$lang['Yes'] = 'כן';
$lang['No'] = 'לא';
$lang['Enabled'] = 'פעיל';
$lang['Disabled'] = 'כבוי';
$lang['Error'] = 'שגיאה';

$lang['Next'] = 'הבא';
$lang['Previous'] = 'הקודם';
$lang['Goto_page'] = 'עבור לעמוד';
$lang['Joined'] = 'הצטרף';
$lang['IP_Address'] = 'כתובת IP';

$lang['Select_forum'] = 'בחר פורום';
$lang['View_latest_post'] = 'צפה בהודעה האחרונה';
$lang['View_newest_post'] = 'צפה בהודעה החדשה';
$lang['Page_of'] = 'עמוד <b>%d</b> מתוך <b>%d</b>'; // Replaces with: Page 1 of 2 for example

$lang['ICQ'] = 'מספר ICQ';
$lang['AIM'] = 'כתובת AIM';
$lang['MSNM'] = 'MSN מסנג\'ר';
$lang['YIM'] = 'Yahoo מסנג\'ר';

$lang['Forum_Index'] = 'אינדקס הפורומים של %s';  // eg. sitename Forum Index, %s can be removed if you prefer
//
$lang['Post_new_topic'] = 'שלח נושא חדש';
$lang['Reply_to_topic'] = 'הגב לנושא';
$lang['Reply_with_quote'] = 'הגב עם ציטוט';

$lang['Click_return_topic'] = 'לחץ %sכאן%s כדי לחזור לנושא'; // %s's here are for uris, do not remove!
$lang['Click_return_login'] = 'לחץ %sכאן%s כדי לנסות שוב';
$lang['Click_return_forum'] = 'לחץ %sכאן%s כדי לחזור לפורום';
$lang['Click_view_message'] = 'לחץ %sכאן%s כדי לצפות בהודעתך';
$lang['Click_return_modcp'] = 'לחץ %sכאן%s כדי לחזור ללוח הבקרה למנהלים';
$lang['Click_return_group'] = 'לחץ %sכאן%s כדי לחזור לפרטי הקבוצה';

$lang['Admin_panel'] = 'עבור ללוח הניהול';

$lang['Board_disable'] = 'סליחה, אבל הפורומים לא זמינים כרגע.  נסה שוב מאוחר יותר.';
$lang['View_post'] = 'צפה בהודעה';
$lang['Acronym'] = 'ראשי תיבות';

$lang['Total_votes'] = 'כמות הצבעות : ';
$lang['Voted_show'] = 'הצביעו : '; // it means :  users that voted  (the number of voters will follow)
$lang['Results_after'] = 'התוצאות יופיעו לאחר שהסקר יסתיים';
$lang['Poll_expires'] = 'הסקר יסתיים בתוך : ';
$lang['Minutes'] = 'דקות';
$lang['Max_vote'] = 'בחירות מירביות';
$lang['Max_vote_explain'] = '[ הקלד 1 כדי לאפשר בחירה אחת בלבד ]';
$lang['Max_voting_1_explain'] = 'אנא בחר רק ';
$lang['Max_voting_2_explain'] = ' תשובות';
$lang['Max_voting_3_explain'] = ' (הגבלת הבחירות מעל תתעלם)';
$lang['Vhide'] = 'הסתר';
$lang['Hide_vote'] = 'תוצאות';
$lang['Tothide_vote'] = 'סיכום הצבעות';
$lang['Hide_vote_explain'] = '[ הסתר עד סיום הסקר ]';

//
// Global Header strings
//
$lang['Registered_users'] = 'משתמשים רשומים:';
$lang['Browsing_forum'] = 'משתמשים פעילים בפורום זה:';
$lang['Online_users_zero_total'] = 'ישנם <b>0</b> משתמשים מחוברים בסך הכל :: ';
$lang['Online_users_total'] = 'ישנם <b>%d</b> משתמשים מחוברים בסך הכל :: ';
$lang['Online_user_total'] = 'ישנו משתמש מחובר אחד בסך הכל :: ';
$lang['Reg_users_zero_total'] = '0 רשומים, ';
$lang['Reg_users_total'] = '%d רשומים, ';
$lang['Reg_user_total'] = 'רשום אחד, ';
$lang['Hidden_users_zero_total'] = '0 מוסתרים ו-';
$lang['Hidden_user_total'] = 'מוסתר אחד ו-';
$lang['Hidden_users_total'] = '%d מוסתרים ו-';
$lang['Guest_users_zero_total'] = '0 אורחים';
$lang['Guest_users_total'] = '%d אורחים';
$lang['Guest_user_total'] = 'אורח אחד';
$lang['Record_online_users'] = 'מספר המשתמשים הכי גדול שהיה מחובר בו זמנית הוא <b>%s</b> ב-%s'; // first %s = number of users, second %s is the date.

$lang['Admin_online_color'] = '%sמנהל ראשי%s';
$lang['Mod_online_color'] = '%sמנהל%s';

$lang['You_last_visit'] = 'ביקרת לאחרונה ב-%s'; // %s replaced by date/time
$lang['Current_time'] = 'הזמן עכשיו הוא %s'; // %s replaced by time

$lang['Search_new'] = 'צפה בהודעות מאז ביקורך האחרון';
$lang['Search_your_posts'] = 'צפה בהודעותיך';
$lang['Search_unanswered'] = 'צפה בהודעות ללא תגובה';

$lang['Register'] = 'הרשמה';
$lang['Profile'] = 'פרופיל';
$lang['Edit_profile'] = 'ערוך את הפרופיל שלך';
$lang['Search'] = 'חיפוש';
$lang['Memberlist'] = 'רשימת חברים';
$lang['FAQ'] = 'שאלות נפוצות';
$lang['KB_title'] = 'מאמרים';
$lang['BBCode_guide'] = 'מדריך BBCode';
$lang['Usergroups'] = 'קבוצות משתמשים';
$lang['Last_Post'] = 'הודעה אחרונה';
$lang['Moderator'] = 'מנהל';
$lang['Moderators'] = 'מנהלים';


//
// Stats block text
//
$lang['Posted_articles_zero_total'] = 'המשתמשים שלחו <b>0</b> הודעות הסך הכל'; // Number of posts
$lang['Posted_articles_total'] = 'המשתמשים שלחו <b>%d</b> הודעות בסך הכל'; // Number of posts
$lang['Posted_article_total'] = 'המשתמשים שלחו הודעה אחת בסך הכל'; // Number of posts
$lang['Registered_users_zero_total'] = 'ישנם <b>0</b> משתמשים רשומים'; // # registered users
$lang['Registered_users_total'] = 'ישנם <b>%d</b> משתמשים רשומים'; // # registered users
$lang['Registered_user_total'] = 'ישנו משתמש רשום אחד'; // # registered users
$lang['Newest_user'] = 'המשתמש הרשום הכי חדש הוא <b>%s%s%s</b>'; // a href, username, /a 

$lang['No_new_posts_last_visit'] = 'אין הודעות חדשות מאז ביקורך האחרון';
$lang['No_new_posts'] = 'אין הודעות חדשות';
$lang['New_posts'] = 'הודעות חדשות';
$lang['New_post'] = 'הודעה חדשה';
$lang['No_new_posts_hot'] = 'אין הודעות חדשות [ פופולרי ]';
$lang['New_posts_hot'] = 'הודעות חדשות [ פופולרי ]';
$lang['No_new_posts_locked'] = 'אין הודעות חדשות [ נעול ]';
$lang['New_posts_locked'] = 'הודעות חדשות [ נעול ]';
$lang['Forum_is_locked'] = 'הפורום נעול';


//
// Login
//
$lang['Enter_password'] = 'אנא הקלד את שם המשתמש והסיסמא שלך כדי להתחבר.';
$lang['Login'] = 'התחבר';
$lang['Logout'] = 'התנתק';

$lang['Forgotten_password'] = 'שכחתי את הסיסמא שלי';

$lang['Log_me_in'] = 'התחברות אוטומטית';

$lang['Error_login'] = 'ציינת שם משתמש או סיסמא שגויים, או שאינם פעילים.';


//
// Index page
//
$lang['Index'] = 'אינדקס';
$lang['No_Posts'] = 'אין הודעות';
$lang['No_forums'] = 'במערכת זו אין פורומים';

$lang['Private_Message'] = 'הודעה פרטית';
$lang['Private_Messages'] = 'הודעות פרטיות';
$lang['Who_is_Online'] = 'מי מחובר';

$lang['Mark_all_forums'] = 'סמן את כל הפורומים כנקראו';
$lang['Forums_marked_read'] = 'כל הפורומים סומנו כנקראו';


//
// Viewforum
//
$lang['Topic_Announcement'] = '<b>[ הכרזה ]</b>';
$lang['Topic_Sticky'] = '<b>[ דביק ]</b>';
$lang['Topic_Moved'] = '<b>[ הועבר ]</b>';
$lang['Topic_Poll'] = '<b>[ סקר ]</b>';

//
// Viewtopic
//

$lang['Guest'] = 'אורח';
$lang['Post_subject'] = 'כותרת ההודעה';
$lang['Submit_vote'] = 'שלח הצבעה';
$lang['View_results'] = 'צפה בתוצאות';
$lang['View_Topic'] = 'צפה בנושא';

$lang['No_newer_topics'] = 'אין נושאים יותר חדשים בפורום זה';
$lang['No_older_topics'] = 'אין נושאים יותר ישנים בפורום זה';
$lang['Topic_post_not_exist'] = 'הנושא או ההודעה שבחרת אינם קיימים';
$lang['No_posts_topic'] = 'אין הודעות קיימות לנושא זה';

$lang['Display_posts'] = 'הצג הודעות קודמות';
$lang['All_Posts'] = 'כל ההודעות';
$lang['Newest_First'] = 'הראשונה החדשה';
$lang['Oldest_First'] = 'הראשונה הישנה';

$lang['Back_to_top'] = 'חזור לראש העמוד';

$lang['Read_profile'] = 'צפה בפרופיל המשתמש'; 
$lang['Send_email'] = 'שלח דואר למשתמש';
$lang['Visit_website'] = 'בקר באתר השולח';
$lang['ICQ_status'] = 'מצב ICQ';
$lang['Edit_delete_post'] = 'ערוך/מחק הודעה זו';
$lang['View_IP'] = 'צפה בכתובת IP של השולח';
$lang['Delete_post'] = 'מחק הודעה זו';

$lang['wrote'] = 'כתב'; // proceeds the username and is followed by the quoted text
$lang['Quote'] = 'ציטוט'; // comes before bbcode quote output.
$lang['Code'] = 'קוד'; // comes before bbcode code output.
$lang['PHPCode'] = 'PHP'; // PHP MOD

$lang['Edited_time_total'] = 'נערך לאחרונה על-ידי %s ב-%s; נערך פעם אחת בסך הכל'; // Last edited by me on 12 Oct 2001; edited 1 time in total
$lang['Edited_times_total'] = 'נערך לאחרונה על-ידי %s ב-%s; נערך %d פעמים בסך הכל'; // Last edited by me on 12 Oct 2001; edited 2 times in total

//
// Posting/Replying (Not private messaging!)
//
$lang['Message_body'] = 'תוכן ההודעה';

$lang['Options'] = 'אפשרויות';

$lang['Post_Announcement'] = 'הכרזה';
$lang['Post_Sticky'] = 'דביק';

$lang['Flood_Error'] = 'אתה לא יכול לשלוח הודעה נוספת בזמן קצר כל כך מאז הודעתך האחרונה; נסה שוב בתוך זמן קצר.';
$lang['Empty_subject'] = 'אתה חייב לציין כותרת כאשר אתה שולח נושא חדש.';
$lang['Empty_message'] = 'אתה חייב להקליד הודעה כאשר אתה שולח.';
$lang['Forum_locked'] = 'פורום זה נעול: אתה לא יכול לשלוח, להגיב, או לערוך נושאים.';
$lang['Topic_locked'] = 'נושא זה נעול: אתה לא יכול לערוך הודעות או לשלוח תגובות.';

$lang['Button_locked'] = 'Locked';

$lang['No_post_id'] = 'אתה חייב לבחור הודעה לעריכה';
$lang['Edit_own_posts'] = 'סליחה, אבל אתה יכול לערוך את הודעותיך בלבד.';
$lang['Empty_poll_title'] = 'אתה חייב להקליד כותרת לסקר שלך.';
$lang['To_few_poll_options'] = 'אתה חייב להקליד לפחות שני אפשרויות סקר.';
$lang['To_many_poll_options'] = 'ניסית להקליד יותר מדי אפשרויות סקר.';

$lang['Update'] = 'עדכן';
$lang['Delete'] = 'מחק';
$lang['Days'] = 'ימים'; // This is used for the Run poll for ... Days + in admin_forums for pruning

$lang['HTML_is_ON'] = 'HTML <u>פעיל</u>';
$lang['HTML_is_OFF'] = 'HTML <u>כבוי</u>';
$lang['BBCode_is_ON'] = '%sBBCode%s <u>פעיל</u>'; // %s are replaced with URI pointing to FAQ
$lang['BBCode_is_OFF'] = '%sBBCode%s <u>כבוי</u>';
$lang['Smilies_are_ON'] = 'סמיילים <u>פעילים</u>';
$lang['Smilies_are_OFF'] = 'סמיילים <u>כבויים</u>';

$lang['Attach_signature'] = 'צרף חתימה (את החתימות ניתן לשנות בפרופיל)';
$lang['Delete_post'] = 'מחק הודעה זו';

$lang['Stored'] = 'הודעתך נשלחה בהצלחה.';
$lang['Deleted'] = 'הודעתך נמחקה בהצלחה.';
$lang['Poll_delete'] = 'הסקר שלך נמחק בהצלחה.';
$lang['Vote_cast'] = 'הצבעתך התקבלה.';

$lang['Topic_reply_notification'] = 'הודע בעת תגובה לנושא';

$lang['bbcode_b_help'] = 'טקסט מוגדש: [b]טקסט[/b]  (alt+b)';
$lang['bbcode_i_help'] = 'טקסט נטוי: [i]טקסט[/i]  (alt+i)';
$lang['bbcode_u_help'] = 'טקסט עם קו תחתי: [u]טקסט[/u]  (alt+u)';
$lang['bbcode_q_help'] = 'טקסט מצוטט: [quote]טקסט[/quote]  (alt+q)';
$lang['bbcode_c_help'] = 'הצגת קוד: [code]קוד[/code]  (alt+c)';
$lang['bbcode_l_help'] = 'רשימה: [list]טקסט[/list] (alt+l)';
$lang['bbcode_o_help'] = 'רשימה מסודרת: [list=]טקסט[/list]  (alt+o)';
$lang['bbcode_p_help'] = 'הוספת תמונה: [img( | =left | =right )]http://image_url[/img]  (alt+p)';
$lang['bbcode_w_help'] = 'הוספת כתובת: [url]http://url[/url] או [url=http://url]טקסט מקושר[/url]  (alt+w)';
$lang['bbcode_a_help'] = 'סגור את כל תגי ה-bbCode הפתוחים';
$lang['bbcode_s_help'] = 'צבע גופן: [color=red]טקסט[/color]  טיפ: אתה יכול גם להשתמש בצבע מסוג=#FF0000';
$lang['bbcode_f_help'] = 'גודל גופן: [size=x-small]טקסט קטן[/size]';

$lang['Emoticons'] = 'סמיילים';
$lang['More_emoticons'] = 'צפה בעוד סמיילים';

$lang['Font_color'] = 'צבע גופן';
$lang['color_default'] = 'ברירת מחדל';
$lang['color_dark_red'] = 'אדום כהה';
$lang['color_red'] = 'אדום';
$lang['color_orange'] = 'כתום';
$lang['color_brown'] = 'חום';
$lang['color_yellow'] = 'צהוב';
$lang['color_green'] = 'ירוק';
$lang['color_olive'] = 'זית';
$lang['color_cyan'] = 'תכלת';
$lang['color_blue'] = 'כחול';
$lang['color_dark_blue'] = 'כחול כהה';
$lang['color_indigo'] = 'סגול כהה';
$lang['color_violet'] = 'סגול';
$lang['color_white'] = 'לבן';
$lang['color_black'] = 'שחור';

$lang['Font_size'] = 'גודל גופן';
$lang['font_tiny'] = 'קטנטן';
$lang['font_small'] = 'קטן';
$lang['font_normal'] = 'רגיל';
$lang['font_large'] = 'גדול';
$lang['font_huge'] = 'ענק';

$lang['Close_Tags'] = 'סגור תגים';
$lang['Styles_tip'] = 'טיפ: ניתן להוסיף סגנונות במהירות לטקסט על-ידי בחירתו.';

//
// CBACK SupportTicket System
//
$lang['cst_phpbbversion'] = 'Your phpBB Version:';

$lang['cst_errmessage'] = 'You didn\'t enter a title for your post. Please press the Back Button of your browser to correct this.';
$lang['cst_errmessage1'] = 'You didn\'t enter a URL to your board. Please press the Back Button of your browser to correct this.';
$lang['cst_phpbbtype'] = 'phpBB Type:';
$lang['cst_standard'] = 'Standard phpBB ';
$lang['cst_premod'] = 'Integramod 132';
$lang['cst_premod1'] = 'Integramod 140';
$lang['cst_premod2'] = 'Integramod 141';
$lang['cst_anddist'] = 'phpBB / IMPortal';

$lang['cst_mods'] = 'Do you have MODs (Modifications) installed at your forum?';
$lang['cst_yes'] = 'Yes';
$lang['cst_no'] = 'No';

$lang['cst_knowledge'] = 'Your knowledge:';
$lang['cst_beginner'] = 'Beginner';
$lang['cst_basicknow'] = 'Basic Knowledge';
$lang['cst_extended'] = 'Advanced Knowledge';
$lang['cst_profi'] = 'Professional';

$lang['cst_beforeerr'] = 'What was done before the problem appeared?';
$lang['cst_selfsolution'] = 'What was done to try to solve the problem?';
$lang['cst_boardlink'] = 'Board URL:';
$lang['cst_phpver'] = 'PHP Version:';
$lang['cst_sqlver'] = 'MySQL Version:';

$lang['cst_head_msg'] = 'Description and Message';
$lang['cst_optional'] = 'not required';
$lang['cst_head'] = 'This Assistant helps you to give the support staff information to help you. Please fill out as many fields you can. Only with this information is it possible to help you quickly and efficiently.   To qualify for support, you will need to give your "Board URL".';
//
//
//
//
// Private Messaging
//
$lang['Private_Messaging'] = 'הודעות פרטיות';

$lang['Login_check_pm'] = 'בדוק את ההודעות הפרטיות שלך';
$lang['New_pms'] = '<b>%d הודעות חדשות</b>'; // You have 2 new messages
$lang['New_pm'] = '<b>הודעה אחת חדשה</b>'; // You have 1 new message
$lang['No_new_pm'] = 'אין הודעות חדשות';
$lang['Unread_pms'] = '%d הודעות שלא נקראו';
$lang['Unread_pm'] = 'הודעה אחת שלא נקראה';
$lang['No_unread_pm'] = 'אין הודעות שלא נקראו';
$lang['You_new_pm'] = 'הודעה פרטית חדשה ממתינה לך בתיבת הדואר הנכנס שלך';
$lang['You_new_pms'] = 'הודעות פרטיות חדשות ממתינות לך בתיבת הדואר הנכנס שלך';
$lang['You_no_new_pm'] = 'אין הודעות פרטיות חדשות שממתינות לך';

$lang['Unread_message'] = 'הודעה שלא נקראה';
$lang['Read_message'] = 'הודעה שנקראה';

$lang['Read_pm'] = 'קרא הודעה';
$lang['Post_new_pm'] = 'שלח הודעה';
$lang['Post_reply_pm'] = 'הגב להודעה';
$lang['Post_quote_pm'] = 'צטט הודעה';
$lang['Edit_pm'] = 'ערוך הודעה';

$lang['Inbox'] = 'דואר נכנס';
$lang['Outbox'] = 'דואר יוצא';
$lang['Savebox'] = 'דואר שמור';
$lang['Sentbox'] = 'דואר שנשלח';
$lang['Flag'] = 'מצב';
$lang['Subject'] = 'כותרת';
$lang['From'] = 'מאת';
$lang['To'] = 'אל';
$lang['Date'] = 'תאריך';
$lang['Mark'] = 'סמן';
$lang['Sent'] = 'נשלח';
$lang['Saved'] = 'שמור';
$lang['Delete_marked'] = 'מחק מסומנים';
$lang['Delete_all'] = 'מחק הכל';
$lang['Save_marked'] = 'שמור מסומנים'; 
$lang['Save_message'] = 'שמור הודעה';
$lang['Delete_message'] = 'מחק הודעה';

$lang['Display_messages'] = 'הצג הודעות קודמות'; // Followed by number of days/weeks/months
$lang['All_Messages'] = 'כל ההודעות';

$lang['No_messages_folder'] = 'אין לך הודעות בתיקייה זו';

$lang['PM_disabled'] = 'ההודעות הפרטיות כבויות במערכת זו.';
$lang['Cannot_send_privmsg'] = 'סליחה, אבל המנהל הראשי מונע ממך משליחת הודעות פרטיות.';
$lang['No_to_user'] = 'אתה חייב לציין שם משתמש שאליו תשלח ההודעה.';
$lang['No_such_user'] = 'סליחה, אבל המשתמש לא קיים.';

$lang['Disable_HTML_pm'] = 'כבה HTML בהודעה זו';
$lang['Disable_BBCode_pm'] = 'כבה BBCode בהודעה זו';
$lang['Disable_Smilies_pm'] = 'כבה סמיילים בהודעה זו';

$lang['Message_sent'] = 'הודעתך נשלחה.';

$lang['Click_return_inbox'] = 'לחץ %sכאן%s כדי לחזור לתיבת הדואר הנכנס שלך';
$lang['Click_return_index'] = 'לחץ %sכאן%s כדי לחזור לאינדקס';

$lang['Send_a_new_message'] = 'שלח הודעה פרטית חדשה';
$lang['Send_a_reply'] = 'הגב להודעה הפרטית';
$lang['Edit_message'] = 'ערוך הודעה פרטית';

$lang['Notification_subject'] = 'התקבלה הודעה פרטית חדשה!';

$lang['Find_username'] = 'מצא שם משתמש';
$lang['Find'] = 'מצא';
$lang['No_match'] = 'לא נמצאו התאמות.';

$lang['No_post_id'] = 'אין הודעה עם ה-ID שצויין';
$lang['No_such_folder'] = 'התיקייה לא קיימת';
$lang['No_folder'] = 'לא צויינה תיקייה';

$lang['Mark_all'] = 'סמן הכל';
$lang['Unmark_all'] = 'בטל סימון של הכל';

$lang['Confirm_delete_pm'] = 'אתה בטוח שאתה רוצה למחוק הודעה זו?';
$lang['Confirm_delete_pms'] = 'אתה בטוח שאתה רוצה למחוק הודעות אלו?';

$lang['Inbox_size'] = 'תיבת הדואר הנכנס שלך מלאה %d%%'; // eg. Your Inbox is 50% full
$lang['Sentbox_size'] = 'תיבת הדואר שנשלח שלך %d%% מלאה'; 
$lang['Savebox_size'] = 'תיבת הדואר השמור שלך %d%% מלאה'; 

$lang['Click_view_privmsg'] = 'לחץ %sכאן%s כדי לבקר בתיבת הדואר הנכנס שלך';


//
// Profiles/Registration
//
$lang['Viewing_user_profile'] = 'צופה בפרופיל :: %s'; // %s is username 
$lang['About_user'] = 'הכל על %s'; // %s is username

$lang['Preferences'] = 'העדפות';
$lang['Items_required'] = 'רכיבים המסומנים עם * נדרשים אלא אם כן צויין אחרת.';
$lang['Registration_info'] = 'פרטי הרשמה';
$lang['Profile_info'] = 'פרטי פרופיל';
$lang['Profile_info_warn'] = 'מידע זה ניתן לצפייה ציבורית';
$lang['Avatar_panel'] = 'לוח בקרת סמלים אישיים';
$lang['Avatar_gallery'] = 'גלריית סמלים אישיים';

$lang['Website'] = 'אתר אינטרנט';
$lang['Location'] = 'מיקום';
$lang['Contact'] = 'יצירת קשר';
$lang['Email_address'] = 'כתובת דואר אלקטרוני';
$lang['Email'] = 'שלח דואר';
$lang['Send_private_message'] = 'שלח הודעה פרטית';
$lang['Hidden_email'] = '[ מוסתר ]';
//$lang['Search_user_posts'] = 'חפש את כל ההודעות של משתמש זה';
$lang['Interests'] = 'תחביבים';
$lang['Occupation'] = 'מקצוע'; 
$lang['Poster_rank'] = 'דירוג השולח';

$lang['Total_posts'] = 'כמות הודעות';
$lang['User_post_pct_stats'] = '%.2f%% בסך הכל'; // 1.25% of total
$lang['User_post_day_stats'] = '%.2f הודעות ליום'; // 1.5 posts per day
$lang['Search_user_posts'] = 'מצא את כל ההודעות של %s'; // Find all posts by username

$lang['No_user_id_specified'] = 'סליחה, אבל המשתמש לא קיים.';
$lang['Wrong_Profile'] = 'אתה לא יכול לשנות פרופיל שלא שלך.';

$lang['Only_one_avatar'] = 'ניתן לציין סוג אחד של סמל אישי בלבד';
$lang['File_no_data'] = 'בקובץ בכתובת שאתה הזנת אין נתונים';
$lang['No_connection_URL'] = 'לא ניתן להתחבר לכתובת שהזנת';
$lang['Incomplete_URL'] = 'הכתובת שהקלדת אינה שלמה';
$lang['Wrong_remote_avatar_format'] = 'הכתובת של הסמל האישי הרחוק אינה תקפה';
$lang['No_send_account_inactive'] = 'סליחה, אבל לא ניתן לקבל את סיסמתך מפני שחשבונך אינו פעיל כרגע. צור קשר עם המנהל הראשי של הפורום למידע נוסף.';

$lang['Always_smile'] = 'הפעל תמיד סמיילים';
$lang['Always_spellcheck'] = 'בדוק תמיד את האיות לפני השליחה';
$lang['Always_html'] = 'אפשר תמיד HTML';
$lang['Always_bbcode'] = 'אפשר תמיד BBCode';
$lang['Always_add_sig'] = 'צרף תמיד את החתימה שלי';
$lang['Always_notify'] = 'הודע לי תמיד לתגובות';
$lang['Always_notify_explain'] = 'שולח דואר כאשר מישהו מגיב לנושא ששלחת. ניתן לשנות זאת באופן חד פעמי כאשר אתה שולח.';

$lang['Board_style'] = 'עיצוב המערכת';
$lang['Board_lang'] = 'שפת המערכת';
$lang['No_themes'] = 'אין ערכות בבסיס הנתונים';
$lang['Timezone'] = 'איזור זמן';
$lang['Date_format'] = 'תבנית התאריך';
$lang['Date_format_explain'] = 'התחביר המשומש דומה לפונקציה של PHP <a href=\'http://www.php.net/date\' target=\'_other\'>date()</a>';
$lang['Signature'] = 'חתימה';
$lang['Signature_explain'] = 'קטע טקסט זה יתווסף להודעות שאתה שולח. ישנה הגבלה של %d תווים';
$lang['Public_view_email'] = 'הראה תמיד את כתובת הדואר האלקטרוני שלי';
//
$lang['Current_password'] = 'סיסמא נוכחית';
$lang['New_password'] = 'סיסמא חדשה';
$lang['Confirm_password'] = 'אישור סיסמא';
$lang['Confirm_password_explain'] = 'אתה חייב לאשר את סיסמתך הנוכחית אם אתה רוצה לשנות אותה או לשנות את כתובת הדואר האלקטרוני שלך';

if($userdata['session_logged_in']){ 
    $lang['password_if_changed'] = 'אתה צריך לספק את סיסמתך בלבד אם אתה רוצה לשנות אותה'; 
    $lang['password_confirm_if_changed'] = 'אתה צריך לאשר את סיסמתך אם אתה משנה את זאת שמעל.'; 
} else { 
    $lang['password_if_changed'] = 'זכור זאת בהבדלה בין אותיות לועזיות גדולות וקטנות.'; 
    $lang['password_confirm_if_changed'] = ''; 
} 


$lang['PS_security_title']			= 'לוח בקרת אבטחה';
$lang['PS_security_question'] 		= 'שאלת ביטחון';
$lang['PS_security_question_exp'] 	= 'השאלה תשאל אם חשבונך ינעל כתוצאה מהרבה נסיונות התחברות נכשלות.';
$lang['PS_security_answer']			= 'תשובת ביטחון';
$lang['PS_security_answer_exp']		= 'זוהי התשובה לשאלה שמעל. כאשר אתה משחרר את נעילת חשבונך, תהיה חייב להשתמש בה והיא רגישה לאותיות לועזיות גדולות וקטנות.';
$lang['PS_security_error']			= 'שגיאה';
$lang['PS_security_info']			= 'מידע';
$lang['PS_security_one']			= 'השאלה והתשובת ביטחון הינם שדות נדרשים.';
$lang['PS_security_a_exp']			= '<br>זוהי הגרסה \'המוצפנת\' של תשובת הביטחון שלך. זוהי הדרך שבה היא נשמרה בבסיס הנתונים כך שאף אחד לא יכול לדעת אותה חוץ ממך. אתה צריך לזכור או לכתוב את התשובה האמיתית (הגרסה הבלתי מוצפנת שלך) כדי שלא תאבד אותה';
$lang['PS_security_locked']			= 'סליחה, חשבון זה עבר את מספר נסיונות ההתחברות. החשבון נעול עכשיו. אם אתה משתמש אמין, לחץ מתחת כדי לעבור לעמוד שישחרר את נעילת ה-id שלך.<br><br>לחץ <a href="login_security.'. $phpEx .'?phpBBSecurity=retreive&sid='. $userdata['session_id'] .'">כאן</a> כדי לשחרר את נעילת חשבונך.';
$lang['PS_security_force']			= 'סליחה, הודעה זו מופיעה מפני שזהו ביקורך הראשון מאז שהתווספו שאלות הביטחון. אתה תוכל לצפות בפרופיל שלך בלבד עד שתעדכן אותו ותוסיף שאלה ותשובה. תודה!<br><br>לחץ <b><a href="profile.'. $phpEx .'?mode=register&sub=registering&sid='. $userdata['session_id'] .'">כאן</a></b> כדי לעבור לפרופיל שלך.';
$lang['PS_admin_one']				= 'נסיונות התחברות';
$lang['PS_admin_one_exp']			= '<br>זוה כמות הפעמים כאשר מישהו מזין סיסמא שגוייה לפני נעילת החשבון.';
$lang['PS_admin_two']				= 'הודעה למנהל ראשי';
$lang['PS_admin_two_exp']			= '<br>אם זה נקבע ל \'פעיל\' ציין מה השיטות שבהן המנהל הראשי יקבל הודעות על-ידי להלן.';
$lang['PS_admin_three']				= 'מנהל ראשי';
$lang['PS_admin_three_exp']			= '<br>זהו המנהל הראשי שתרצה שיקבל הודעה אם נקבע ל\'פעיל\' מעל.';
$lang['PS_admin_err_one']			= 'הגבלת הכמות צריכה להיות גדולה יותר מ-0. לחץ חזור ונסה שוב.';
$lang['PS_admin_err_two']			= 'בחרת להודיע למנהל ראשי, אז אנא בחר id של מנהל ראשי. לחץ חזור ונסה שוב.';
$lang['PS_admin_error_three']		= 'ה-id של המנהל הראשי צריך להיות ערך מספרי. לחץ חזור ונסה שוב.';
$lang['PS_admin_error_four']		= 'ה-id צריך להיות ערך הגדול מ-0.  לחץ חזור ונסה שוב.';
$lang['PS_admin_error_five']		= 'הגבלת ההתחברות צריכה להיות ערך מספרי.  לחץ חזור ונסה שוב.';
$lang['PS_admin_current']			= 'מנהל ראשי נוכחי: %A%';
$lang['PS_admin_default']			= 'בחר אחד';
$lang['PS_login_title']				= 'אבטחת phpBB';
$lang['PS_login_header']			= 'אבטחת phpBB';
$lang['PS_login_username']			= 'הקלד את שם המשתמש שלך';
$lang['PS_login_email']				= 'הקלד את הדואר האלקטרוני המשותף עם חשבון זה';
$lang['PS_login_step_one']			= 'שלב אחד: אישור פרטי חשבון';
$lang['PS_login_step_two']			= 'שלב שני: אישור שאלת האבטחה';
$lang['PS_login_step_failed']		= 'סליחה, המידע שסיפקת שגוי.';
$lang['PS_login_button']			= 'אשר';
$lang['PS_login_validated']			= 'תודה ששיחררת את נעילת חשבונך. אתה יכול להתחבר עכשיו.';
$lang['PS_profile_explain']			= 'זה מאוד חשוב לחשוב לפני שאתה ממלא. אתה לא תוכל לשנות זאת כרצונך. תצטרך אישור של מנהלים ראשיים כדי לשנות אותם, למען מטרות אבטחה. כל עוד הם לא קובעים, כל מה שתוכל לעשות זה לצפות בהם.';
$lang['PS_forgot_sq']				= '<a href="login_security.'. $phpEx .'?phpBBSecurity=forgot&sid='. $userdata['session_id'] .'">שכחת את תשובת הביטחון שלך?</a>';
$lang['PS_forgot_exp']				= 'אם שכחת את תשובת הביטחון שלך, תצטרך ליצור קשר עם המנהלים הראשיים והם צריכים לאפס את פרטי האבטחה שלך. הדואר ליצירת קשר הוא '. $board_config['board_email'] .'. אם אתה לא יכול להשיג את המנהלים הראשיים בדרך זו, חפש בפרופילים של המנהלים הראשיים לקישורי דואר אלקטרוני. כאשר תעדכן אותם, השתמש במידע שתוכל לזכור כדי להמנע מהצורך לעשות זאת שוב.';
$lang['PS_user_lock']				= 'מצב נעול';
$lang['PS_user_lock_exp']			= 'אם החשבון נעול, בכל פעם שהמשתמש ינסה להתחבר, הוא יצטרך להכניס את פרטי האבטחה שלו.';
$lang['PS_user_reset']				= 'איפוס פרטי האבטחה';
$lang['PS_user_reset_exp']			= 'אזהרה: אם תסמן זאת, המשתמש יצטרך להכניס מידע חדש. הפעולה תמחק את הגדרות האבטחה הנוכחיות שלו.';
$lang['PS_user_status_l']			= 'חשבון זה נעול כרגע. סימון תיבה זו <b>תשחרר את נעילת</b> החשבון.';
$lang['PS_user_status_u']			= 'חשבון זה משוחרר מנעילה כרגע. סימון תיבה זו <b>תנעל</b> את החשבון.';
$lang['PS_pm_subject']				= 'החשבון נעול.';
$lang['PS_pm_message']				= 
'החשבון פשוט נעול. להלן הפרטים.

החשבון נעול: %U%
IP למי שנעל אותו: %I%

זוהי תשובה אוטומטית, לא להגיב. אם יש לך עוקב IP מותקן, בדוק את ה-IP מעל עם האחדים המאוחסנים בבסיס הנתונים.';
$lang['PS_auto_message']			= 'הודעה זו מופיעה מפני שנחסמת מאתר זה.  אם זו טעות או שאתה לא בטוח מדוע נחסמת, אנא צור קשר עם המנהל הראשי של הפורום.<br /><br /><b>המנהל הראשי של הפורום:</b> ';
$lang['PS_admin_ban']				= 'חסימה אוטומטית';
$lang['PS_admin_ban_exp']			= '<br>הפעולה תחסום אוטומטית כל IP שינסה להשתמש בתוכנות פריצה. אפשרות זו עוברת על כל האפשרויות האחרות. אם אתה רוצה להשתמש באפשרויות האחרות, קבע זאת ל \'כבוי\' והגדר את ההגדרות האחרות.';
$lang['PS_admin_sessions']			= 'מקסימום אירועים מאופשרים';
$lang['PS_admin_sessions_exp']		= '<br>אם טבלת האירועים שלך נותנת מספר גדול יותר ממספר זה, המוד יתן אוטומטית מספר זה.';
$lang['PS_clike']					= 'נסיון Clike';
$lang['PS_union']					= 'נסיון Union';
$lang['PS_sql']						= 'נסיון הכנסת SQL';
$lang['PS_ddos']					= 'נסיון DDoS';
$lang['PS_caught_left']				= 'IP';
$lang['PS_caught_c_left']			= 'תפוס ל-';
$lang['PS_caught_c_right']			= 'תפוס ב-';
$lang['PS_caught_right']			= 'נסיונות';
$lang['PS_caught_msg']				= 'אין נסיונות על ידי סוגי תסריט באתר.';
$lang['PS_special']					= 'אבטחת phpBB :: שדות מיוחדים';
$lang['PS_special_admins']			= 'כמות של מנהלים ראשיים מאופשרים';
$lang['PS_special_admins_exp']		= '<br>מספר זה יקבע כמה מנהלים ראשיים מאופשרים להיות באתר שלך. אז אף אחד לא יכול להכניס חשבון מנהל ראשי לקבלת גישה.';
$lang['PS_special_admins_total']	= '<br>יש לך כרגע %X% משתמשים אמיתיים שנקבעו למצב \'מנהל ראשי\' באלת המשתמשים.';
$lang['PS_special_admins_offset']	= '<font color="red"> הודעה זו מופיעה מפני שיש לך יותר מנהלים ראשיים בטבלת המשתמשים מאמאופשר!</font>';
$lang['PS_special_mods']			= 'כמות של מנהלים מאופשרים';
$lang['PS_special_mods_exp']		= '<br>מספר זה יקבע כמה מנהלים מאופשרים להיות באתר שלך. אז אף אחד לא יכול להכניס חשבון מנהל לקבלת גישה.';
$lang['PS_special_mods_total']		= '<br>יש לך כרגע %X% משתמשים אמיתיים שנקבעו למצב \'מנהל\' בטבלת המשתמשים.';
$lang['PS_special_mods_offset']		= '<font color="red"> הודעה זו מופיעה מפני שיש לך יותר מנהלים בטבלת המשתמשים מהמאופשר!</font>';
$lang['PS_use_special']				= 'הגנה על חשבונות מנהל ומנהל ראשי';
$lang['PS_use_special_exp']			= '<br>כיבוי זאת, לא יעצור מנהלים ראשיים או מנהלים נוספים שיתווספו.';
$lang['PS_fopen_fwrite']			= 'נסיון כתיבה לקובץ';
$lang['PS_system']					= 'נסיון ביצוע Perl';
$lang['PS_chr']						= 'נסיון קידוד תווים';
$lang['PS_cback']					= 'נסיון Sanity Mix Worm';
$lang['PS_allow_user_change']		= 'אפשר למשתמשים לשנות את פרטי הביטחון שלהם. <b>לא מומלץ.</b>';
$lang['PS_notify_admin_by_pm']		= 'הודעה פרטית';
$lang['PS_notify_admin_by_em']		= 'דואר אלקטרוני';
$lang['PS_option_ban']				= 'חסום';
$lang['PS_option_block']			= 'חסום';
$lang['PS_option_ignore']			= 'התעלם';
$lang['PS_option_warning']			= '<b>אזהרה:</b> הגדרת כל אחד מהבאים ל \'התעלם\' תאפשר לכל אחד להשתמש באותם פריצות לאתר שלך. אתה תוזהר.';
$lang['PS_list_choice_one']			= 'כן';
$lang['PS_list_choice_two']			= 'לא';
$lang['PS_list_one']				= 'בצע פעולה בנסיון <b>DDoS</b>?';
$lang['PS_list_two']				= 'בצע פעולה בנסיון <b>Clike</b>?';
$lang['PS_list_three']				= 'בצע פעולה בנסיון <b>UNION</b>?';
$lang['PS_list_four']				= 'בצע פעולה בנסיון <b>Sanity Mix Worm</b>?';
$lang['PS_list_five']				= 'בצע פעולה בנסיון <b>הכנסת SQL</b>?';
$lang['PS_list_six']				= 'בצע פעולה בנסיון <b>תסריט Perl</b>?';
$lang['PS_list_seven']				= 'בצע פעולה בנסיון <b>קידוד תווים</b>?';
$lang['PS_list_eight']				= 'בצע פעולה בנסיון <b>כתיבה/פתיחת קובץ</b>?';
$lang['PS_blocked_line']			= '<span dir="ltr"><b>&nbsp;אבטחת phpBB &copy;&nbsp;</b> חסמה %T% נסיונות פריצה.</span>';
$lang['PS_blocked_line2']			= '<a href="login_security.php?phpBBSecurity=caught" class="copyright">מוגן</a> על-ידי אבטחת phpBB © <a href="http://phpbb-amod.com" class="copyright" target="_blank">phpBB-Amod</a>';


#==== Added in 1.0.2
$lang['PS_die_msg_cookies']			= 'ישנה התאמה בלתי ראוייה של עוגייה עם החשבון שלך. אנא הסר את העוגיות שלך והתחבר שוב.';
$lang['PS_die_msg_banned']			= 'נחסמת מאתר זה.';
$lang['PS_die_msg_ddos']			= 'נחסמת משום שכנראה השתמשת בנסיון DDoS. או אתה מריץ קיר-אש או משהו דומה זה גם יכול לגרום לכך.';
$lang['PS_die_msg_encoded']			= 'נחסמת משום שניסית להעביר תווים מקודדים לאתר זה &amp; זהו נסיון זדוני אפשרי לקבלת גישה בלתי מורשת.';
$lang['PS_die_msg_union']			= 'נחסמת משום שניסית להעביר תסריט מסוג union לאתר זה &amp; זהו נסיון זדוני אפשרי לקבלת גישה בלתי מורשת.';
$lang['PS_die_msg_clike']			= 'נחסמת משום שניסית להעביר תסריט מסוג clike לאתר זה &amp; זהו נסיון זדוני אפשרי לקבלת גישה בלתי מורשת.';
$lang['PS_die_msg_sql']				= 'נחסמת משום שניסית להכניס sql לאתר זה &amp; זהו נסיון זדוני אפשרי לקבלת גישה בלתי מורשת.';
$lang['PS_die_msg_fwrite']			= 'נחסמת משום שניסית להעביר תסריט מסוג כתיבה לקובץ לאתר זה &amp; זהו נסיון זדוני אפשרי לקבלת גישה בלתי מורשת.';
$lang['PS_die_msg_perl']			= 'נחסמת משום שניסית להעביר תסריט מסוג ביצוע perl לאתר זה &amp; זהו נסיון זדוני אפשרי לקבלת גישה בלתי מורשת.';
$lang['PS_die_msg_cback']			= 'נחסמת משום שניסית להעביר תסריט מסוג sanity mix worm לאתר זה &amp; זהו נסיון זדוני אפשרי לקבלת גישה בלתי מורשת.';
$lang['PS_die_msg_agent']			= 'נחסמת משום שאחת מהתאמות גורם המשתמש שלך חסמנו.';
$lang['PS_die_msg_referer']			= 'נחסמת משום שאחת מההתאמות המיוחסות שלך חסמנו.';
$lang['PS_die_msg_staff']			= 'נחסמת בגלל שיש לך גישה להיות בצוות, אבל המנהלים הראשיים לא אפשרו את הגישה שלך בלוח האבטחה.';

$lang['PS_die_msg_email']			= 'אם אתה חושב שקיבלת הודעה זו בגלל שגיאה באתר, אנא צור קשר עם המנהל הראשי ב %דואר%.';

$lang['PS_admin_submit']			= 'שמור הגדרות';
$lang['PS_admin_submit_special']	= 'שמור הגדרות מיוחדות';
$lang['PS_admin_config_saved']		= 'ההגדרות עודכנו.';
$lang['PS_admin_special_saved']		= 'ההגדרות המיוחדות עודכנו.';
$lang['PS_return_config']			= 'לחץ %s<b>כאן</b>%s כדי לחזור לעמוד ההגדרות.';
$lang['PS_return_special']			= 'לחץ %s<b>כאן</b>%s כדי לחזור לעמוד ההגדרות המיוחדות.';
$lang['PS_admin_not_authed']		= 'סליחה, אתה לא רשאי לצפות/לשנות אותם הגדרות.';
$lang['PS_admin_grant_access']		= 'כאן אתה יכול לבחור מנהלים ראשיים כדי לאפשר להם גישה לצפות בעמוד זה.';
$lang['PS_admin_deny_access']		= 'כאן אתה יכול לבחור מנהלים ראשיים כדי לדחות מהם את הגישה לצפות בעמוד זה.';
$lang['PS_block_agents']			= 'גורמי חסימת המשתמש';
$lang['PS_block_agents_exp']		= 'אתה צריך לדעת מה אתה עושה לפני השימוש. דוגמה למה שאתה יכול לעשות היא להוסיף את <b>Firefox</b>, וכל אחד שמשתמש בדפדפן Firefox יחסם.';
$lang['PS_unblock_agents']			= 'גורמי ביטול חסימת המשתמש';
$lang['PS_block_referers']			= 'יחסי חסימה';
$lang['PS_block_referers_exp']		= 'אתה צריך לדעת מה אתה עושה לפני השימוש. דוגמה למה שאתה יכול לעשות היא להוסיף את <b>search.yahoo.com</b> כאן, וכל אחד שמשתמש באותו אתר כדי לעבור לכאן יחסם.';
$lang['PS_unblock_referers']		= 'יחסי ביטול חסימה';
$lang['PS_per_page']				= 'כמה נסיונות בכל עמוד להציג בעמוד התפיסה';
$lang['PS_ddos_level']				= 'רמת הגנה מ-DDoS:';
$lang['PS_ddos_high']				= 'חזקה';
$lang['PS_ddos_medium']				= 'בינונית';
$lang['PS_ddos_low']				= 'נמוכה';

$lang['PS_members_title']			= 'להלן רשימה של כל חבר שנתפס בנסיון לפריצה לאתר.';
$lang['PS_members_pt_check']		= 'נבדקה הטבלה [b]הודעות האתר[/b], תוצאה:';
$lang['PS_members_pt_check_yc']		= 'טבלת ההודעות מצאה משהו:';
$lang['PS_members_pt_check_nc']		= 'טבלת ההודעות לא מצאה התאמות IP.';
$lang['PS_user_exploits']			= 'נסיונות הפריצה שלהם';

$lang['PS_users_tries']				= 'נסיונות הפריצה של %N%';
$lang['PS_users_id']				= 'Id';
$lang['PS_users_ip']				= 'Ip';
$lang['PS_users_link']				= 'קישור';
$lang['PS_users_reason']			= 'סיבה';
$lang['PS_users_date']				= 'תאריך';

$lang['PS_search_title']			= 'חפש את בסיס הנתונים';
$lang['PS_search_ip']				= 'אנא הקלד IP';
$lang['PS_search_submit']			= ' התחל חיפוש ';
$lang['PS_search_partial']			= 'התאמה חלקית';
$lang['PS_search_exact']			= 'התאמה מדוייקת';
$lang['PS_search_unban']			= 'שחרר חסימת IP זו';
$lang['PS_search_banned']			= 'חסום כרגע';

$lang['PS_backup_on']				= 'גיבוי בסיס הנתונים יומי';
$lang['PS_backup_folder']			= 'תיקייה לשים בה גיבויים';
$lang['PS_backup_folder_exp']		= 'התיקייה <b>חייבת</b> בתיקייה הראשית של הפורום שלך, היא <b>חייבת</b> להיות בעלת <i>הרשאות</i> -> 777';
$lang['PS_backup_filename']			= 'שם לשימוש לגיבויי בסיס הנתונים';
$lang['PS_backup_filename_exp']		= '<i>דוגמה:</i> גיבוי';
$lang['PS_backup_time']				= 'זמן כל יום להשלמת הגיבוי';
$lang['PS_backup_total']			= 'נקה גיבויים זמינים: %N%';
$lang['PS_backup_remove']			= 'מחק קובץ גיבוי';

$lang['Avatar'] = 'סמל אישי';
$lang['Avatar_explain'] = 'מציג תמונה גרפית קטנה תחת פרטיך בהודעות. ניתן להציג תמונה אחת בלבד בכל פעם, רוחבה לא יכול להיות גדול מ-%d פיקסלים, גובהה לא יכול להיות גדול מ-%d פיקסלים, וגודל הקובץ לא יותר מ-%d KB.';
$lang['Upload_Avatar_file'] = 'העלה סמל אישי מהמחשב שלך';
$lang['Upload_Avatar_URL'] = 'העלה סמל אישי מכתובת';
$lang['Upload_Avatar_URL_explain'] = 'הקלד את הכתובת של המיקום המכיל את תמונת הסמל האישי, התמונה תועתק לאתר זה.';
$lang['Pick_local_Avatar'] = 'בחר סמל אישי מהגלרייה';
$lang['Link_remote_Avatar'] = 'קישור לסמל אישי מחוץ לאתר';
$lang['Link_remote_Avatar_explain'] = 'הקלד את הכתובת של המיקום המכיל את תמונת הסמל האישי שאתה מעוניין לקשר.';
$lang['Avatar_URL'] = 'כתובת לתמונת הסמל האישי';
$lang['Select_from_gallery'] = 'בחר סמל אישי מהגלרייה';
$lang['View_avatar_gallery'] = 'צפה בגלרייה';

$lang['Select_avatar'] = 'בחר סמל אישי';
$lang['Return_profile'] = 'בטל סמל אישי';
$lang['Select_category'] = 'בחר קטגוריה';

$lang['Delete_Image'] = 'מחק תמונה';
$lang['Current_Image'] = 'תמונה נוכחית';

$lang['Notify_on_privmsg'] = 'הודע על הודעה פרטית חדשה';
$lang['Popup_on_privmsg'] = 'הקפץ חלון בעת הודעה פרטית חדשה'; 
$lang['Popup_on_privmsg_explain'] = 'כמה ערכות יכולות לפתוח חלון חדש כדי ליידע אותך כאשר הודעות פרטיות חדשות התקבלו.';
$lang['Hide_user'] = 'הסתר את מצב החיבור שלך';

$lang['Profile_updated'] = 'הפרופיל שלך עודכן';

$lang['Password_mismatch'] = 'הסיסמאות שהקלדת אינן תואמות.';
$lang['Current_password_mismatch'] = 'הסיסמא הנוכחית שסיפקת לא תואמת לסיסמא המאוחסנת בבסיס הנתונים.';
$lang['Password_long'] = 'סיסמתך חייבת להיות פחות מ-32 תווים.';
$lang['Username_taken'] = 'סליחה, אבל שם משתמש זה כבר קיים.';
$lang['Username_invalid'] = 'סליחה, אבל שם משתמש זה מכיל תווים שגויים כמו \'.';
$lang['Username_disallowed'] = 'סליחה, אבל שם משתמש זה לא מורשה.';
$lang['Username_numeric'] = 'סליחה, אבל שם המשתמש לא יכול להיות מספר.';
$lang['Email_taken'] = 'סליחה, אבל כתובת הדואר האלקטרוני רשומה כבר למשתמש אחר.';
$lang['Email_banned'] = 'סליחה, אבל כתובת הדואר האלקטרוני חסומה.';
$lang['Email_invalid'] = 'סליחה, אבל כתובת הדואר האלקטרוני שגוייה.';
$lang['Signature_too_long'] = 'החתימה שלך ארוכה מדי.';
$lang['Fields_empty'] = 'אתה חייב למלא את השדות הנדרשים.';
$lang['Avatar_filetype'] = 'סוג קובץ הסמל האישי חייב להיות .jpg, .gif או .png';
$lang['Avatar_filesize'] = 'גודל קובץ תמונת הסמל האישי חייב להיות פחות מ-%d KB'; // The avatar image file size must be less than 6 KB
$lang['Avatar_imagesize'] = 'הסמל האישי חייב להיות פחות מ-%d פיקסלים רוחב ו-%d פיקסלים גובה'; 

$lang['Welcome_subject'] = 'ברוך הבא לפורומים של %s'; // Welcome to my.com forums
$lang['New_account_subject'] = 'חשבון משתמש חדש';
$lang['Account_activated_subject'] = 'חשבונך הופעל';

$lang['Account_added'] = 'תודה שנרשמת. חשבונך נוצר. אתה יכול להתחבר עם שם המשתמש והסיסמא שלך';
$lang['Account_inactive'] = 'חשבונך נוצר. אך פורום זה דורש הפעלת חשבונות. מפתח ההפעלה נשלחה לכתובת הדואר האלקטרוני שלך. בדוק את תיבת הדואר האלקטרוני שלך למידע נוסף';
$lang['Account_inactive_admin'] = 'חשבונך נוצר. אך פורום זה דורש הפעלת חשבונות על-ידי המנהלים הראשיים. הודעת דואר נשלחה להם ואתה תדע כאשר חשבונך יופעל';
$lang['Account_active'] = 'חשבונך הופעל. תודה שנרשמת';
$lang['Account_active_admin'] = 'החשבון הופעל';
$lang['Reactivate'] = 'הפעל מחדש את חשבונך!';
$lang['Already_activated'] = 'כבר הפעלת את חשבונך';
$lang['COPPA'] = 'חשבונך נוצר אבל צריך לקבל אישור. בדוק את תיבת הדואר האלקטרוני שלך לפרטים.';

$lang['Wrong_activation'] = 'מפתח ההפעלה שסיפקת לא תואם לזה שבבסיס הנתונים.';
$lang['Send_password'] = 'שלח אלי סיסמא חדשה'; 
$lang['Password_updated'] = 'סיסמא חדשה נוצרה; בדוק את תיבת הדואר האלקטרוני שלך לפרטים.';
$lang['No_email_match'] = 'כתובת הדואר האלקטרוני שסיפקת לא תואמת לאחת הרשומה לשם המשתמש.';
$lang['New_password_activation'] = 'הפעלת סיסמא חדשה';
$lang['Password_activated'] = 'חשבונך הופעל מחדש. כדי להתחבר, השתמש בסיסמא שסופקה בדואר שקיבלת.';

$lang['Send_email_msg'] = 'שלח הודעת דואר אלקטרוני';
$lang['No_user_specified'] = 'לא צויין משתמש';
$lang['User_prevent_email'] = 'משתמש זה לא מעוניין לקבל דואר. נסה לשלוח לו הודעה פרטית.';
$lang['User_not_exist'] = 'המשתמש לא קיים';
$lang['CC_email'] = 'שלח עותק של ההודעה לעצמי';
$lang['Email_message_desc'] = 'הודעה זו תשלח כטקסט פשוט, אז אל תכלול כל HTML או BBCode. כתובת החזרה להודעה זו נקבעה לכתובת הדואר האלקטרוני שלך.';
$lang['Flood_email_limit'] = 'אתה לא יכול לשלוח הודעה נוספת בזמן זה. נסה שוב מאוחר יותר.';
$lang['Recipient'] = 'נמען';
$lang['Email_sent'] = 'ההודעה נשלחה.';
$lang['Send_email'] = 'שלח הודעה';
$lang['Empty_subject_email'] = 'אתה חייב לציין כותרת להודעה.';
$lang['Empty_message_email'] = 'אתה חייב להקליד הודעה לשליחה.';


//
// Visual confirmation system strings
//
//$lang['Confirm_code_wrong'] = 'קוד האישור שהקלדת שגוי';
//$lang['Too_many_registers'] = 'עברת את מספר נסיונות ההרשמה לאירוע זה. נסה שוב מאוחר יותר.';
//$lang['Confirm_code_impaired'] = 'אם אתה לא יכול לראות את הקוד החזותי צור קשר עם %sהמנהל הראשי%s לעזרה.';
//$lang['Confirm_code'] = 'קוד אישור';
//$lang['Confirm_code_explain'] = 'הקלד את הקוד בדיוק כפי שאתה רואה אותו. הקוד רגיש לאותיות לועזיות גדולות וקטנות ואפס עם קו עובר בתוכו.';



//
// Memberslist
//
$lang['Select_sort_method'] = 'בחר שיטת סידור';
$lang['Sort'] = 'סדר';
$lang['Sort_Top_Ten'] = 'עשרת השולחים הגדולים';
$lang['Sort_Joined'] = 'תאריך הצטרפות';
$lang['Sort_Username'] = 'שם משתמש';
$lang['Sort_Location'] = 'מיקום';
$lang['Sort_Posts'] = 'כמות הודעות';
$lang['Sort_Email'] = 'דואר אלקטרוני';
$lang['Sort_Website'] = 'אתר אינטרנט';
$lang['Sort_Ascending'] = 'סדר עולה';
$lang['Sort_Descending'] = 'סדר יורד';
$lang['Order'] = 'סדר';


//
// Group control panel
//
$lang['Remove_selected'] = 'הסר נבחרים';
$lang['Add_member'] = 'הוסף חבר';
$lang['None'] = 'ללא';

//
// Search
//
$lang['Sort_by'] = 'סדר לפי';
//
$lang['No_search_match'] = 'אין נושאים או הודעות המתאימות לאפשרויות החיפוש שלך';
$lang['Close_window'] = 'סגור חלון';

//
// Auth related entries
//
// Note the %s will be replaced with one of the following 'user' arrays
$lang['Sorry_auth_announce'] = 'סליחה, אבל רק %s יכולים לשלוח הכרזות בפורום זה.';
$lang['Sorry_auth_sticky'] = 'סליחה, אבל רק %s יכולים לשלוח הודעות דביקות בפורום זה.'; 
$lang['Sorry_auth_read'] = 'סליחה, אבל רק %s יכולים לקרוא נושאים בפורום זה.'; 
$lang['Sorry_auth_post'] = 'סליחה, אבל רק %s יכולים לשלוח נושאים בפורום זה.'; 
$lang['Sorry_auth_reply'] = 'סליחה, אבל רק %s יכולים להגיב להודעות בפורום זה.';
$lang['Sorry_auth_edit'] = 'סליחה, אבל רק %s יכולים לערוך הודעות בפורום זה.'; 
$lang['Sorry_auth_delete'] = 'סליחה, אבל רק %s יכולים למחוק הודעות בפורום זה.';
$lang['Sorry_auth_vote'] = 'סליחה, אבל רק %s יכולים להצביע בסקרים בפורום זה.';

// These replace the %s in the above strings
$lang['Auth_Anonymous_Users'] = '<b>משתמשים אלמוניים</b>';
$lang['Auth_Registered_Users'] = '<b>משתמשים רשומים</b>';
$lang['Auth_Users_granted_access'] = '<b>משתמשים בעלי גישה מיוחדת</b>';
$lang['Auth_Moderators'] = '<b>מנהלים</b>';
$lang['Auth_Administrators'] = '<b>מנהלים ראשיים</b>';

$lang['Not_Moderator'] = 'אתה לא מנהל פורום זה.';
$lang['Not_Authorised'] = 'לא מורשה';
$lang['Admin_reauthenticate'] = 'כדי לנהל את המערכת אתה חייב לאמת את עצמך מחדש.';

$lang['You_been_banned'] = 'נחסמת מפורום זה.<br />צור קשר עם מנהל האתר או המנהל הראשי של המערכת למידע נוסף.';


//
// Viewonline
//
$lang['Online_explain'] = 'הנתונים האלו מבוססים על פעילות המשתמשים במשך חמשת הדקות האחרונות';

$lang['Forum_Location'] = 'מיקום בפורום';
$lang['Last_updated'] = 'עודכן לאחרונה';

$lang['Forum_index'] = 'אינדקס הפורום';
$lang['Logging_on'] = 'מתחבר';
$lang['Viewing_profile'] = 'צופה בפרופיל';

//
// Moderator Control Panel
//

$lang['Select'] = 'בחר';
$lang['Move'] = 'העבר';
$lang['Lock'] = 'נעל';
$lang['Unlock'] = 'שחרר נעילה';

$lang['Topics_Moved'] = 'הנושאים שבחרת הועברו.';

//
// Timezones ... for display on each page
//
$lang['All_times'] = 'כל הזמנים הם %s'; // eg. All times are GMT - 12 Hours (times from next block)

$lang['-12'] = 'GMT - 12 שעות';
$lang['-11'] = 'GMT - 11 שעות';
$lang['-10'] = 'GMT - 10 שעות';
$lang['-9'] = 'GMT - 9 שעות';
$lang['-8'] = 'GMT - 8 שעות';
$lang['-7'] = 'GMT - 7 שעות';
$lang['-6'] = 'GMT - 6 שעות';
$lang['-5'] = 'GMT - 5 שעות';
$lang['-4'] = 'GMT - 4 שעות';
$lang['-3.5'] = 'GMT - 3.5 שעות';
$lang['-3'] = 'GMT - 3 שעות';
$lang['-2'] = 'GMT - 2 שעות';
$lang['-1'] = 'GMT - שעה';
$lang['0'] = 'GMT';
$lang['1'] = 'GMT + שעה';
$lang['2'] = 'שעות ישראל';
$lang['3'] = 'GMT + 3 שעות';
$lang['3.5'] = 'GMT + 3.5 שעות';
$lang['4'] = 'GMT + 4 שעות';
$lang['4.5'] = 'GMT + 4.5 שעות';
$lang['5'] = 'GMT + 5 שעות';
$lang['5.5'] = 'GMT + 5.5 שעות';
$lang['6'] = 'GMT + 6 שעות';
$lang['6.5'] = 'GMT + 6.5 שעות';
$lang['7'] = 'GMT + 7 שעות';
$lang['8'] = 'GMT + 8 שעות';
$lang['9'] = 'GMT + 9 שעות';
$lang['9.5'] = 'GMT + 9.5 שעות';
$lang['10'] = 'GMT + 10 שעות';
$lang['11'] = 'GMT + 11 שעות';
$lang['12'] = 'GMT + 12 שעות';
$lang['13'] = 'GMT + 13 שעות';

// These are displayed in the timezone select box
$lang['tz']['-12'] = 'GMT - 12 שעות';
$lang['tz']['-11'] = 'GMT - 11 שעות';
$lang['tz']['-10'] = 'GMT - 10 שעות';
$lang['tz']['-9'] = 'GMT - 9 שעות';
$lang['tz']['-8'] = 'GMT - 8 שעות';
$lang['tz']['-7'] = 'GMT - 7 שעות';
$lang['tz']['-6'] = 'GMT - 6 שעות';
$lang['tz']['-5'] = 'GMT - 5 שעות';
$lang['tz']['-4'] = 'GMT - 4 שעות';
$lang['tz']['-3.5'] = 'GMT - 3.5 שעות';
$lang['tz']['-3'] = 'GMT - 3 שעות';
$lang['tz']['-2'] = 'GMT - 2 שעות';
$lang['tz']['-1'] = 'GMT - שעה';
$lang['tz']['0'] = 'GMT';
$lang['tz']['1'] = 'GMT + שעה';
$lang['tz']['2'] = 'שעות ישראל';
$lang['tz']['3'] = 'GMT + 3 שעות';
$lang['tz']['3.5'] = 'GMT + 3.5 שעות';
$lang['tz']['4'] = 'GMT + 4 שעות';
$lang['tz']['4.5'] = 'GMT + 4.5 שעות';
$lang['tz']['5'] = 'GMT + 5 שעות';
$lang['tz']['5.5'] = 'GMT + 5.5 שעות';
$lang['tz']['6'] = 'GMT + 6 שעות';
$lang['tz']['6.5'] = 'GMT + 6.5 שעות';
$lang['tz']['7'] = 'GMT + 7 שעות';
$lang['tz']['8'] = 'GMT + 8 שעות';
$lang['tz']['9'] = 'GMT + 9 שעות';
$lang['tz']['9.5'] = 'GMT + 9.5 שעות';
$lang['tz']['10'] = 'GMT + 10 שעות';
$lang['tz']['11'] = 'GMT + 11 שעות';
$lang['tz']['12'] = 'GMT + 12 שעות';
$lang['tz']['13'] = 'GMT + 13 שעות';

$lang['datetime']['Sunday'] = 'ראשון';
$lang['datetime']['Monday'] = 'שני';
$lang['datetime']['Tuesday'] = 'שלישי';
$lang['datetime']['Wednesday'] = 'רביעי';
$lang['datetime']['Thursday'] = 'חמישי';
$lang['datetime']['Friday'] = 'שישי';
$lang['datetime']['Saturday'] = 'שבת';
$lang['datetime']['Sun'] = 'א\'';
$lang['datetime']['Mon'] = 'ב\'';
$lang['datetime']['Tue'] = 'ג\'';
$lang['datetime']['Wed'] = 'ד\'';
$lang['datetime']['Thu'] = 'ה\'';
$lang['datetime']['Fri'] = 'ו\'';
$lang['datetime']['Sat'] = 'ש\'';
$lang['datetime']['January'] = 'ינואר';
$lang['datetime']['February'] = 'פברואר';
$lang['datetime']['March'] = 'מרץ';
$lang['datetime']['April'] = 'אפריל';
$lang['datetime']['May'] = 'מאי';
$lang['datetime']['June'] = 'יוני';
$lang['datetime']['July'] = 'יולי';
$lang['datetime']['August'] = 'אוגוסט';
$lang['datetime']['September'] = 'ספטמבר';
$lang['datetime']['October'] = 'אוקטובר';
$lang['datetime']['November'] = 'נובמבר';
$lang['datetime']['December'] = 'דצמבר';
$lang['datetime']['Jan'] = '01';
$lang['datetime']['Feb'] = '02';
$lang['datetime']['Mar'] = '03';
$lang['datetime']['Apr'] = '04';
$lang['datetime']['May'] = '05';
$lang['datetime']['Jun'] = '06';
$lang['datetime']['Jul'] = '07';
$lang['datetime']['Aug'] = '08';
$lang['datetime']['Sep'] = '09';
$lang['datetime']['Oct'] = '10';
$lang['datetime']['Nov'] = '11';
$lang['datetime']['Dec'] = '12';

// calendar pcp stuff
$lang['Sunday'] = 'ראשון';
$lang['Monday'] = 'שני';

//
// Photo Album Addon v2.x.x by Smartor
//
$lang['Album'] = 'אלבום';
$lang['Personal_Gallery_Of_User'] = 'הגלרייה האישית של %s';

//
// Errors (not related to a
// specific failure on a page)
//
$lang['Information'] = 'מידע';
$lang['Critical_Information'] = 'מידע גורלי';

$lang['General_Error'] = 'שגיאה כללית';
$lang['Critical_Error'] = 'שגיאה חמורה';
$lang['An_error_occured'] = 'התרחשה שגיאה';
$lang['A_critical_error'] = 'התרחשה שגיאה חמורה';

$lang['Topic_description'] = 'תיאור לנושא שלך';
$lang['Description'] = 'תיאור הנושא';

// 
// Begin Approve_Posts_Mod Block : 22
// 

//stuff user sees
$lang['approve_topic_has_awaiting'] = 'לנושא יש הודעות הממתינות לאישור';
$lang['approve_topic_is_awaiting'] = 'הנושא ממתין לאישור';
$lang['approve_post_is_awaiting'] = 'ההודעה ממתינה לאישור';

$lang['approve_posts_error_obtain'] = 'לא ניתן לקבל פרטי אישור הפורום';
$lang['approve_posts_error_delete'] = 'לא ניתן למחוק פרטי אישור הפורום';
$lang['approve_posts_error_insert'] = 'לא ניתן להוסיף פרטי אישור לפורום';

$lang['approve_notify_subject'] = 'אשר הודעה';
$lang['approve_notify_link'] = 'ישנה הודעה חדשה הממתינה לאישור מנהל. כדי לצפות בה לחץ כאן: ';
$lang['approve_notify_approve_link'] = 'כדי לאשר הודעה זו לחץ כאן: ';
$lang['approve_notify_message'] = 'ההודעה נכללת למטה.';
$lang['approve_notify_message_exceeded'] = 'המשך ההודעה...';
$lang['approve_notify_poster'] = '*** הודעה זו מנוהלת תחת שליחה ואינה ניתנת לצפייה עד שתאושר. ***';
$lang['approve_notify_user_link'] = 'הודעתך אושרה. כדי לצפות בהודעה זו, לחץ כאן:';
$lang['approve_notify_user_topic'] = 'כל ההודעות שלך בנושא זה אושרו.';
$lang['approve_notify_auto_app'] = 'הודעת אישור אוטומטי.';
$lang['approve_notify_auto_app_msg'] = 'אתה מאושר אוטומטית בזמן שליחה בפורומים מנוהלים.';
$lang['approve_notify_auto_app_rem'] = 'הודעה על הסרת אישור אוטומטי.';
$lang['approve_notify_auto_app_rem_msg'] = 'אתה לא מאושר אוטומטית יותר בזמן שליחה בפורומים מנוהלים.';
$lang['approve_notify_moderation'] = 'הודעת ניהול.';
$lang['approve_notify_moderation_msg'] = 'אתה עכשיו מנוהל בזמן שליחה בפורומים מנוהלים.';
$lang['approve_notify_moderation_rem'] = 'הודעה על הסרת ניהול.';
$lang['approve_notify_moderation_rem_msg'] = 'אתה לא מנוהל יותר בזמן שליחה בפורומים מנוהלים.';
$lang['approve_notify_post_approved'] = 'הודעתך אושרה!.';

$lang['approve_topic_all_current'] = 'אשר את כל ההודעות הנוכחיות בנושא זה';
$lang['approve_topic_all_future'] = 'אישור אוטומטי לכל ההודעות העתידיות בנושא זה';
$lang['approve_topic_all_future_rem'] = 'הסר אישור אוטומטי לכל ההודעות העתידיות בנושא זה';
$lang['approve_topic_moderate'] = 'נהל נושא זה וכל התגובות העתידיות';
$lang['approve_topic_moderate_rem'] = 'הסר ניהול נושא';
$lang['approve_post_approve'] = 'אשר הודעה זו';
$lang['approve_topic_approve'] = 'אשר נושא זה';
$lang['approve_user_auto_approve'] = 'אשר אוטומטית משתמש זה';
$lang['approve_user_auto_approve_rem'] = 'הסר אישור אוטומטי';
$lang['approve_user_moderate'] = 'נהל משתמש זה';
$lang['approve_user_moderate_rem'] = 'הסר ניהול';

//stuff admin sees
$lang['approve_admin_enable'] = 'הפעל מערכת אישורים:';
$lang['approve_admin_posts'] = 'אשר הודעות';
$lang['approve_admin_users_enable'] = 'נהל:';
$lang['approve_admin_users_all'] = 'כל המשתמשים והנושאים';
$lang['approve_admin_users_mod'] = 'המשתמשים והנושאים הנבחרים בלבד';
$lang['approve_admin_posts_topics'] = 'נהל ב:';
$lang['approve_admin_posts_enable'] = 'הודעות חדשות';
$lang['approve_admin_poste_enable'] = 'הודעות שנערכו';
$lang['approve_admin_topics_enable'] = 'נושאים חדשים';
$lang['approve_admin_topice_enable'] = 'נושאים שנערכו';
$lang['approve_admin_hide_topics_enable'] = 'הסתר נושאים ללא אישור:';
$lang['approve_admin_hide_posts_enable'] = 'הסתר הודעות ללא אישור:';
$lang['approve_admin_button_find'] = 'מצא משתמשים';
$lang['approve_admin_button_add'] = 'הוסף משתמש';
$lang['approve_admin_button_rem'] = 'הסר משתמש';
$lang['approve_admin_moderators'] = 'מנהלים:';
$lang['approve_admin_forums'] = 'פורומים';
$lang['approve_admin_users'] = 'משתמשים';
$lang['approve_admin_author'] = 'מחבר';
$lang['approve_admin_subject'] = 'כותרת';
$lang['approve_admin_empty'] = '--ריק--';
$lang['approve_admin_remove'] = 'הסר';
$lang['approve_admin_approve'] = 'אשר';
$lang['approve_admin_add_approved_submit'] = 'אישור אוטומטי';
$lang['approve_admin_add_moderated_submit'] = 'נהל';
$lang['approve_admin_page'] = 'עמוד: ';
$lang['approve_admin_remove_moderation'] = 'הסר ניהול';
$lang['approve_admin_remove_approval'] = 'הסר אישור';

//Admin menu titles moved to lang_admin.php'; 

$lang['approve_admin_notify_user_enable'] = 'הודעה פרטית למשתמש באישור:';
$lang['approve_admin_notify_admin_enable'] = 'הודעת מנהל:';
$lang['approve_admin_notify_type'] = 'הודע דרך: ';
$lang['approve_admin_notify_pm_enable'] = 'הודעה פרטית';
$lang['approve_admin_notify_email_enable'] = 'דואר אלקטרוני';
$lang['approve_admin_notify_message_enable'] = 'כלול הודעה בהודעה: ';
$lang['approve_admin_notify_message_length'] = 'אורך מירבי (0 = הכל)';
$lang['approve_admin_notify_posts_topics'] = 'הודע ב:';
$lang['approve_admin_notify_posts_enable'] = 'הודעות חדשות';
$lang['approve_admin_notify_poste_enable'] = 'הודעות שנערכו';
$lang['approve_admin_notify_topics_enable'] = 'נושאים חדשים';
$lang['approve_admin_notify_topice_enable'] = 'נושאים שנערכו';
$lang['approve_admin_notify_user_invalid'] = 'חזור וערוך את רישומך.<br/>המשתמש הבא שגוי: ';
$lang['approve_admin_notify_user_empty'] = 'חזור וערוך את רישומך.<br/>אתה חייב לבחור לפחות מנהל אחד להודיע.';

$lang['approve_admin_username'] = 'שם משתמש';
$lang['approve_admin_users_moderated_users'] = 'משתמשים מנוהלים';
$lang['approve_admin_users_auto_approved'] = 'משתמשים עם אישור אוטומטי';
$lang['approve_admin_users_of'] = 'משתמשים <b>%d</b>-<b>%d</b> מתוך <b>%d</b>'; // Replaces with: Users 1-2 of 2 for example
$lang['approve_admin_users_id_remove_error'] = 'ה-id של המשתמש הנבחר שגוי.';
$lang['approve_admin_users_moderation_removed'] = 'המשתמש "%s" הוסר מניהול.';
$lang['approve_admin_users_approval_removed'] = 'המשתמש "%s" הוסר מאישור אוטומטי.';
$lang['approve_admin_users_approval_added'] = 'המשתמש "%s" נוסף לאישור אוטומטי.';
$lang['approve_admin_users_moderated_added'] = 'המשתמש "%s" נוסף לניהול.';
$lang['approve_admin_add_approved_user'] = 'הוסף משתמש לאישור אוטומטי';
$lang['approve_admin_add_moderated_user'] = 'הוסף משתמש מנוהל';

$lang['approve_admin_topics_title'] = 'כותרת הנושא';
$lang['approve_admin_approve_topic'] = 'אשר נושא';
$lang['approve_admin_topics_moderated_topics'] = 'נושאים מנוהלים';
$lang['approve_admin_topics_awaiting'] = 'נושאים הממתינים לאישור';
$lang['approve_admin_topics_auto_approved'] = 'נושאים עם אישור אוטומטי';
$lang['approve_admin_topics_of'] = 'נושאים <b>%d</b>-<b>%d</b> מתוך <b>%d</b>'; // Replaces with: Topics 1-2 of 2 for example
$lang['approve_admin_topics_id_remove_error'] = 'ה-id של הנושא הנבחר שגוי.';
$lang['approve_admin_topics_moderation_removed'] = 'הנושא "%s" הוסר מניהול.';
$lang['approve_admin_topics_approval_removed'] = 'הנושא "%s" הוסר מאישור אוטומטי.';
$lang['approve_admin_topics_approval_added'] = 'הנושא "%s" נוסף לאישור אוטומטי.';
$lang['approve_admin_topics_moderated_added'] = 'הנושא "%s" נוסף לניהול.';
$lang['approve_admin_topics_approved'] = 'הנושא "%s" אושר.';

$lang['approve_admin_approve_post'] = 'אשר הודעה';
$lang['approve_admin_posts_awaiting'] = 'הודעות הממתינות לאישור';
$lang['approve_admin_posts_of'] = 'הודעות <b>%d</b>-<b>%d</b> מתוך <b>%d</b>'; // Replaces with: Posts 1-2 of 2 for example
$lang['approve_admin_posts_id_remove_error'] = 'ה-id של ההודעה הנבחרת שגוייה.';
$lang['approve_admin_posts_approved'] = 'ההודעה "%s" של "%s" אושרה.'; //Replaces with: The post "blah" by "mr.man" has been approved.

$lang['approve_admin_forums_moderated'] = 'פורומים תחת ניהול';
$lang['approve_admin_Stored_replacement'] = $lang['Stored'] . '<br/><br/> היא תהפוך לניתנת לצפייה כאשר מנהל יאשר אותה. <br/> אל תשלח את הודעתך יותר מפעם אחת.';
// 
// End Approve_Posts_Mod Block : 22
//

$lang['Home'] = 'בית';

// Start add - Fully integrated shoutbox MOD
$lang['Shoutbox'] = 'תיבת הצעקות';
$lang['Shoutbox_date'] = ' d/m/Y ב- H:i:s';
$lang['Shout_censor'] = 'הצעקה הוסרה !';
$lang['Shout_refresh'] = 'רענן';
$lang['Shout_text'] = 'הטקסט שלך';
$lang['Viewing_Shoutbox']= 'צופה בתיבת הצעקוץ';
$lang['Censor'] ='צנזר';
$lang['This_posts_IP'] = 'כתובת IP של הודעה זו';
$lang['Other_IP_this_user'] = 'כתובות IP אחרות של משתמש זה';
$lang['Users_this_IP'] = 'משתמשים שמשתמשים בכתובת IP זו';
$lang['IP_info'] = 'פרטי IP';
$lang['Lookup_IP'] = 'חפש כתובת IP';
$lang['Disable_HTML_post'] = 'כבה HTML בהודעה זו';
$lang['Disable_BBCode_post'] = 'כבה BBCode בהודעה זו';
$lang['Disable_Smilies_post'] = 'כבה סמיילים בהודעה זו';
$lang['Smilies'] = 'סמיילים';

// End add - Fully integrated shoutbox MOD

$lang['Message_preview'] = 'תצוגה מקדימה לקבלת ההודעה';

// Start add - Yellow card admin MOD
$lang['Rules_ban_can'] = 'אתה <b>יכול</b> לחסום משתמשים אחרים בפורום זה'; 
$lang['Rules_greencard_can'] = 'אתה <b>יכול</b> לשחרר חסימה למשתמשים בפורום זה'; 
$lang['Rules_bluecard_can'] = 'אתה <b>יכול</b> לדווח על הודעה למנהלים בפורום זה'; 

$lang['Viewing_RULES'] = 'צופה בחוקים';
$lang['Forum_Rules'] = 'חוקים';

$lang['cookies_link'] = 'ניהול העוגיות שלי';

// RATING MOD
$lang['Rating'] = 'דירוג';
$lang['No_rating'] = 'אין דירוג';
$lang['Ratings_by'] = 'ההודעות דורגו על-ידי %s';
$lang['Rated_posts_by'] = 'ההודעות של %s דורגו';
$lang['Latest_ratings'] = 'דירוגים אחרונים';
$lang['Highest_ranked_topics'] = 'נושאים בעלי דירוג גבוה';
$lang['Highest_ranked_posts'] = 'הודעות בעלי דירוג גבוה';
$lang['Highest_ranked_posters'] = 'שולחים בעלי דירוג גבוה';

$lang['Staff'] = 'צוות האתר';

//
// Bookmark Mod
//
$lang['More_bookmarks'] = 'עוד סימניות...'; // For mozilla navigation bar

//-----------------------------------------------------------------------------
// MOD: Delayed Topics
$lang['Delayed_Post_Alt'] = 'נושא דחוי (מתחיל %s)';	// %s replaced by delivery date
$lang['Sorry_auth_delayedpost'] = 'סליחה אבל רק %s יכולים לשלוח נושאים דחויים';

// MOD: Delayed Topics {end}
//-----------------------------------------------------------------------------
// Logo Selector MOD
$lang['Logo_settings'] = 'הגדרות לוגו';
$lang['Logo_explain'] = 'כאן תוכל לקבוע את נתיב התיקייה ללוגויים של הפורום שלך, הלוגו צריך להיות בשימוש והצגת גובהו ורוחבו.';
$lang['Logo_path'] = 'נתיב למיקום הלוגו';
$lang['Logo_path_explain'] = 'נתיב תחת התיקייה הראשית של phpBB שלך, לדוגמא images/logo';
$lang['Logo'] = 'בחר לוגו';
$lang['Logo_dimensions'] = 'מימדי הלוגו';
$lang['Logo_dimensions_explain'] = '(גובה x רוחב בפיקסלים) ';
$lang['PS_admin_ban']				= 'חסימה אוטומטית';
$lang['PS_admin_ban_exp']			= '<br>הפעולה תחסום אוטומטית כל IP שינסה להשתמש בפריצת Clike, הכנסת SQL, DDoS או UNION.';
$lang['PS_admin_sessions']			= 'מקסימום אירועים מאופשרים';
$lang['PS_admin_sessions_exp']		= '<br>אם טבלת האירועים נותנת מספר גדול יותר ממספר זה, המוד יתן אוטומטית את מספר זה.';
$lang['PS_clike']					= 'נסיון Clike';
$lang['PS_union']					= 'נסיון Union';
$lang['PS_sql']						= 'נסיון הכנסת SQL';
$lang['PS_ddos']					= 'נסיון DDoS';
$lang['PS_caught_left']				= 'IP';
$lang['PS_caught_c_left']			= 'תפוס ל-';
$lang['PS_caught_c_right']			= 'תפוס ב-';
$lang['PS_caught_right']			= 'נסיונות';
$lang['PS_caught_msg']				= 'אין נסיונות על-ידי סוגי תסריט באתר.';
$lang['PS_special']					= 'אבטחת phpBB :: שדות מיוחדים';
$lang['PS_special_admins']			= 'כמות של מנהלים ראשיים מאפשרים';
$lang['PS_special_admins_exp']		= '<br>מספר זה יקבע כמה מנהלים ראשיים מאופשרים להיות באתר שלך. אז אף אחד לא יכול להכניס חשבון מנהל ראשי לקבלת גישה.';
$lang['PS_special_admins_total']	= '<br>יש לך כרגע %X% משתמשים אמיתיים שנקבעו למצב \'מנהל ראשי\' באלת המשתמשים.';
$lang['PS_special_admins_offset']	= '<font color="red"> הודעה זו מופיעה מפני שיש לך יותר מנהלים ראשיים בטבלת המשתמשים מאמאופשר!</font>';
$lang['PS_special_mods']			= 'כמות של מנהלים מאופשרים';
$lang['PS_special_mods_exp']		= '<br>מספר זה יקבע כמה מנהלים מאופשרים להיות באתר שלך. אז אף אחד לא יכול להכניס חשבון מנהל לקבלת גישה.';
$lang['PS_special_mods_total']		= '<br>יש לך כרגע %X% משתמשים אמיתיים שנקבעו למצב \'מנהל\' בטבלת המשתמשים.';
$lang['PS_special_mods_offset']		= '<font color="red"> הודעה זו מופיעה מפני שיש לך יותר מנהלים בטבלת המשתמשים מהמאופשר!</font>';
$lang['PS_use_special']				= 'הגנה על חשבונות מנהל ומנהל ראשי';
$lang['PS_use_special_exp']			= '<br>כיבוי זאת, לא יעצור מנהלים ראשיים או מנהלים נוספים שיתווספו.';

$lang['LW_USER_ACCT_ERROR'] = 'חבר עם ID = %d לא קיים.';
$lang['LW_WELCOME_REGISTERED'] = 'תודה שנרשמת. חשבונך נוצר.';
$lang['LW_TRANSACTION_RECORDS'] = 'פעולות עסקיות';
$lang['LW_EXPIRE_MEMBER_REMINDER'] = 'המנוי שלך יסתיים ב-<b>%s</b>';
$lang['LW_EXPIRE_TRIAL_REMINDER'] = 'לתקופת הנסיון שלך חלפו <b>%d</b> ימים';
$lang['LW_WELCOME_REGIST_TRIAIL'] = 'ברוך הבא %s, עכשיו תוכל לגלוש באת האינטרנט שלך למשך %d ימים לתקופת נסיון. <br>אחך כך אם תרצה להמשיך להשתמש בשירותים שלנו, תצטרך לשלם לנו תשלום הרשמה בסך %s.';
$lang['LW_AMOUNT_TO_PAY_EXPLAIN'] = 'על אישור התשלום שתקבל תוכל לגשת לכל הפורומים, להירשם בתיקייה.';
$lang['LW_TRIAL_PERIOD'] = 'תקופת הנסיון לחבר לגשת לאתר שלך, <br>מבוססת על ימים, גדול או שווה לאפס: ';
$lang['LW_OUR_SUBSCRIPTION_FEE'] = 'תשלום הרשמה: ';
$lang['LW_OUR_PAYPAL_CURRENCY_CODE'] = 'קוד המטבע של חשבון ה-PayPal שלך מסופק: ';
$lang['LW_OUR_PAYPAL_ACCT'] = 'חשבון ה-PayPal שלך לקבלת תשלום מחברים: ';
$lang['LW_PAYPAL_ACCT_SETTINGS_TITLE'] = 'הגדרות PayPal IPN';
$lang['LW_ACCT_DISPLAY_FROM'] = 'הצג רישומים של פעולה עסקית אחרונה: ';
$lang['LW_ALL_RECORDS'] = 'כל הרישומים';
$lang['LW_NO_RECORDS'] = 'אין רישום';
$lang['LW_ACCT_CREDIT'] = 'זיכוי';
$lang['LW_ACCT_DEBIT'] = 'חיוב';
$lang['NP_DATE'] = 'תאריך';
$lang['LW_ACCT_CURRENCY'] = 'מטבע';
$lang['LW_ACCT_AMOUNT'] = 'כמות';
$lang['LW_ACCT_PLUS_MINUS'] = 'זיכוי / חיוב';
$lang['LW_ACCT_TXNID'] = 'PayPal TXN ID';
$lang['LW_ACCT_STATUS'] = 'מצב';
$lang['LW_ACCT_COMMENT'] = 'ציין';
$lang['LW_NO_PRIVILEGE'] = 'אין לך את הגישה המיוחדת לצפות בעמוד זה.';
$lang['LW_Click_view_ACCT_RECORDS'] = 'לחץ %sכאן%s כדי לצפות ברשימוי הפעולה העסקית של החשבון שלך';
$lang['LW_PAYMENT_DONE'] = 'תשלום ההרשמה נעשה בהצלחה.';
$lang['LW_PAYMENT_PENDDING'] = 'תודה! התשלום שלך עדיין בשליחה, חשבונך ישודרג אוטומטית אחרי שהמנהל הראשי שלנו יקבל את התשלום שלך. <br>ההודעה על קבלת התשלום תשלח לכתובת הדואר האלקטרוני הבא שלך: %s על-ידי PayPal.';
$lang['LW_PAYMENT_DENIED'] = 'התשלום מהחשבון שלך נדחה, צור קשר עם המנהל הראשי שלנו אם יש לך שאלות.';
$lang['LW_PAYMENT_FAILED'] = 'התשלום מהחשבון שלך נכשל, נסה שוב מאוחר יותר.';
$lang['LW_UPDATE_USER_ACCT_ERROR'] = 'שגיאה בעדכון חשבון החבר, צור קשר עם המנהל הראשי שלנו.';
$lang['LW_AMOUNT_TO_PAY'] = 'כמות לשלם: ';
$lang['LW_ACCT_DEPOSIT_INTO'] = 'שלם';
$lang['LW_TOPUP_CONFIRM_TITLE'] = 'אישור התשלום שלך';
$lang['Account_not_exist_lw'] = 'החשבון שציינת לא קיים.';
$lang['Account_activated_lw'] = 'החשבון שלך כבר נקבע לגישה לכל הפורומים.';
$lang['Click_return_login_lw'] = 'לחץ %sכאן%s כדי להתחבר עכשיו.';
$lang['Click_return_activate_lw'] = 'לחץ %sכאן%s כדי לשלם תשלום הרשמה לשידרוג חשבונך.';
$lang['Disabled_account_lw'] = 'חשבונך לא הופעל.';
$lang['LW_PAYPAL_ACCT_ERROR'] = 'אתר אינטרנט חשבון PayPal לא נקבע עד לקבלת הכספים, צור קשר עם המנהל הראשי שלנו לדיווח מקרה זה.';
$lang['LW_PAYMENT_DATA_ERROR'] = 'כמות תשלום ההרשמה שגוי.';
$lang['LW_YOU_ARE_VIP'] = 'ברוך הבא %s, אתה <b>איש חשוב מאוד</b> שלנו.';
$lang['L_LW_PAYMENTS'] = 'הרשמה';
$lang['LW_LOGIN_TO_PAY'] = 'התחבר עם שם החשבון והסיסמא שלך, אתה תופנה לעמוד התשלום אם אתה לא עשית כך. בתודה!';
$lang['LW_PAY_FOR_WHICH_MONTH'] = 'להרשמה ל <b>%s</b> מ <b>%s</b>';

$lang['Sorry_auth_paid_read'] = 'סליחה, אבל רק <b>חברים ששלמו</b> יכולים לקרוא נושאים בפורום זה.'; 
$lang['LW_Welcome_Nopaid_Member'] = 'ברוך הבא %s, אתה חבר מהקהילה שלנו.'; 
$lang['Sorry_auth_paid_post'] = 'סליחה, אבל רק <b>חברים ששלמו</b> יכולים לשלוח נושאים בפורום זה.'; 
$lang['L_LW_PAID_GROUP_NAME'] = 'שם הקבוצה לחברים ששלמו כדי להצטרף: '; 
$lang['LW_SELECT_A_GROUP'] = 'בחר קבוצה כדי להצטרף'; 
$lang['L_LW_GROUP_TO_PAY'] = 'הקבוצה שאתה רוצה להצטרף: '; 
$lang['LW_TOPUP_TITLE'] = 'הצטרף לקבוצת תשלום';
$lang['L_LW_GROUP_DESCRIPTION'] = 'תיאור הקבוצה: ';
$lang['L_LW_FOR_JOIN_GROUP'] = 'כדי להצטרף לקבוצה: ';
$lang['L_LW_FOR_UPGRADE_GROUP'] = 'כדי לשדרג לקבוצה: ';
$lang['L_LW_FOR_EXTEND_GROUP'] = 'כדי להגדיר חברות בקבוצה: ';
$lang['L_LW_USER_EXTEND_SAME_GROUP'] = 'אתה עומד להגדיר את חברותך הנוכחית.';
$lang['L_LW_USER_JOIN_GROUP'] = 'אתה עומד להרשם לקבוצה זו.';
$lang['L_LW_USER_UPGRADE_GROUP'] = 'אתה עומד לשדרג את החברות הנוכחית שלך.';
$lang['L_LW_USER_DOWNGRADE_GROUP'] = 'אתה לא יכול להוריד את החברות שלך, המתן שהחברות הנוכחית שלך תסתיים.';
$lang['L_LW_UPGRADE_REMIND'] = 'פרטי הרשמה: ';

$lang['Click_return_subscribe_lw'] = 'לחץ %sכאן%s כדי לבחור קבוצה להצטרפות. תצטרך לשלם תשלום הרשמה.';
$lang['L_LW_GROUP_ALREADY_JOIN'] = 'הקבוצה שאתה כרגע בה: '; 
$lang['L_LW_GROUP_VIEW_DETAIL'] = 'צפה בפרטי הרשמת קבוצה זו: '; 
$lang['LW_PAYMENT_SUBSCRIPTION'] = 'ההרשמה שלך לקבוצה נשלחה.'; 

$lang['LW_ANONYMOUS_DONOR'] = 'אלמוני';
$lang['LW_MORE_DONORS'] = 'צפה בכל התורמים';
$lang['LW_CURRENT_DONORS'] = 'צפה בתורמים למטרה הנוכחית';
$lang['L_LW_LAST_DONORS'] = '%s התורמים האחרונים';
$lang['L_LW_TOP_DONORS_TITLE'] = '%s התורמים הגדולים';
$lang['L_LW_DONORS_NAME'] = 'שם התורם';
$lang['LW_DONORS_DISPLAY_FROM'] = 'הצג תורמים: ';
$lang['LW_NO_DONORS_YET'] = 'כרגע אין עדיין תורמים';
$lang['LW_WE_HAVE_COLLECT'] = 'אספנו <b>%.2f</b> ממטרטנו של <b>%s</b>.';
$lang['LW_WANT_ANONYMOUS'] = 'אני רוצה להיות אלמוני.';
$lang['L_LW_DONATE_WAY'] = 'מצבך כתורם: ';
$lang['LW_DONATION_TO_POINTS'] = 'תודה שתרמת! בתמורה, אנו שמחים להגדיל את כמות הנקודות שלך ב-%d';
$lang['LW_DONATION_TO_WHO'] = 'תרום ל-%s , תודה!';
$lang['LW_DONATE_TITLE'] = 'תרומה';
$lang['LW_AMOUNT_TO_DONATE'] = 'כמות לתרומה: ';
$lang['LW_AMOUNT_TO_DONATE_EXPLAIN'] = 'תודה שתרמת, התרומה שלך עזרה לנו לתמוך בחברים שלנו בצורה יותר טובה. תודה!';
$lang['LW_DONATE_CONFIRM_TITLE'] = 'אשר את כמות התרומה שלך';
$lang['LW_ACCT_DONATE_INTO'] = 'תרום';
$lang['LW_DONATE_DONE'] = 'תודה שתרמת. תרומתך תעזור לנו לתת שירות טוב יותר לחברים שלנו.';
$lang['LW_DONATE_PENDDING'] = 'תודה שתרמת. תרומתך תעזור לנו לתת שירות טוב יותר לחברים שלנו.';
$lang['LW_DONATE_DENIED'] = 'סליחה תרומתך נדחתה בגלל כמה סיבות, צור קשר עם המנהל הראשי שלנו אם יש לך שאלות. תודה!';
$lang['LW_DONATE_FAILED'] = 'התרומה נכשלה, נסה שוב מאוחר יותר. תודה!';
$lang['LW_ACCT_DONATE_US'] = 'תרום';
$lang['LW_CURRENCY_TO_PAY'] = 'בחר את סוג המטבע: ';
$lang['LW_CURRENCY_TO_PAY_EXPLAIN'] = 'כרגע אספנו רק %s.';
$lang['LW_PAYMENT_DATA_ERROR'] = 'סכום המטבע שהקלדת שגוי.';
$lang['LW_DONATION_TO_POSTS'] = 'תודה שתרמת! בתמורה, אנו שמחים להגדיל את כמות הנקודות שלך ב-%d';
$lang['LW_DONATION_TO_HELP'] = 'אנא עזור לנו להתפתח!';
$lang['L_LW_MONEY'] = 'הכסף נתרם'; 
$lang['L_LW_DATE'] = 'תאריך התרומה';
$lang['LW_DONATE_EXPLAIN'] = 'לחץ כאן כדי לתמוך בנו'; 
///
// Please note: %sHERE%s is used to dynamically building the A HREF tag, do not remove the percent signs (%) around HERE!
$lang['dhtml_faq_noscript'] = "הודעה זו מופיעה מפני שהדפדפן שלך לא תומך ב-javascript או שהוא כבוי בהגדרות הדפדפן שלך.<br /><br />לחץ %sכאן%s כדי לצפות בגרסת ה-HTML הפשוטה של השאלות הנפוצות.";
// added by edwin :: required fields
$lang['Required_force']	= 'סליחה, הודעה זו מופיעה מפני שזהו ביקורך הראשון מאז שהתווספו שדות נדרשים למערכת. <br />כאשר אתה תעדכן את השדות המסומנים עם %s, אתה תוכל להנות מהאתר השלם. <br />תודה!<br /> <br />לחץ על שמות השדות מתחת כדי להשלים אותן:<br />%s';
// added by edwin :: registration
$lang['Profile_updated_inactive'] = 'הפרופיל שלך עודכן. אך שינית פרטים חיוניים, לכן חשבונך לא פעיל כרגע. בדוק את תיבת הדואר האלקטרוני שלך כדי להבין איך להפעיל את חשבונך מחדש.';
$lang['Profile_updated_inactive_admin'] = 'הפרופיל שלך עודכן. אך שינית פרטים חיוניים, לכן חשבונך לא פעיל כרגע. המתן שהמנהל הראשי יפעיל אותו מחדש.';
$lang['Click_return_portal'] = 'לחץ %sכאן%s כדי לחזור לפורטל';
$lang['PS_security_a_exp_empty'] = 'תשובה זו תוצפן כאשר תשלח, אז אף אחד לא יוכל לדעת אותה חוץ ממך. זכור או כתוב אותה מפני שאולי תצטרך להשתמש בה שוב והיא אינה ניתנת לשינוי.';
$lang['PS_security_a_exp_submitted'] = 'זוהי הגרסה המוצפנת של התשובה שלך שנשלחה קודם, אז אף אחד לא יכול לדעת אותה חוץ ממך. אם תרצה לשנות אותה, תצטרך ליצור קשר עם המנהל הראשי של אתר זה.';

// BEGIN Style Select MOD
$lang['Style_select_manage'] = 'נהל את העיצוב הנבחר';
$lang['Style_select_explain'] = 'בעזרת שירות זה אתה יכול לנהל את טבלת פרטי העיצוב הנבחר';
$lang['Style_select_author'] = 'מחבר';
$lang['Style_select_version'] = 'גרסה';
$lang['Style_select_website'] = 'אתר אינטרנט';
$lang['Style_select_viewings'] = 'צופים';
$lang['Style_select_dlurl'] = 'כתובת לקובץ';
$lang['Style_select_dls'] = 'הורד סך הכל';
$lang['Style_select_loaclurl'] = 'הסב כתובת';
$lang['Style_select_ludls'] = 'הסב הורדת סך הכל';
$lang['Click_return_style_sel_admin'] = 'לחץ %sכאן%s כדי לחזור לניהול העיצוב הנבחר';
$lang['Style_select_update'] = 'הנתונים עודכנו בהצלחה';
// END Style Select MOD

// FIND - newsfeeds
$lang['Check_All'] = 'סמן הכל';
$lang['UnCheck_All'] = 'בטל סימון של הכל';
$lang['News_Read_More'] = 'קרא עוד...';
$lang['News_source'] = 'מקור: ';
// end FIND - newsfeeds

$lang['Portal'] = 'פורטל'; 

$lang['By'] = 'על-ידי'; // picture {By} user :: Topic {By} user
$lang['Country'] = 'מדינה';

$lang['No_r_click'] = 'No Right Click Is Allowed'; 
$lang['No_copy'] = 'Copy Is Not Allowed';
//+MOD: DHTML Collapsible Forum Index MOD
$lang['CFI_options'] = "C.F.I.";
$lang['CFI_options_ex'] = "Collapsible Forum Index Options";
$lang['CFI_close'] = "Close";
$lang['CFI_delete'] = "Delete Saved State";
$lang['CFI_restore'] = "Restore Saved State";
$lang['CFI_save'] = "Save State";
$lang['CFI_Expand_all'] = "Expand All";
$lang['CFI_Collapse_all'] = "Collapse All";
//-MOD: DHTML Collapsible Forum Index MOD
//
// That's all, Folks!
// -------------------------------------------------

?>