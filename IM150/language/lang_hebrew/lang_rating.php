<?php
/***************************************************************************
 *                              lang_rating.php v1.1.0
 *                            -------------------
 *   begin                : Friday, Jan 17, 2003
 *   copyright            : (C) 2002 Web Centre Ltd
 *   email                : phpbb@mywebcommunities.com
 *
 ***************************************************************************/

$lang['Rating_page_title'] = 'דרג הודעה';
$lang['Die_rate_private'] = 'אתה לא יכול לדרג הודעות בפורומים פרטיים';
$lang['Die_login_to_rate'] = 'הודעה זו בפורום המוגבל למשתמשים רשומים. אתה חייב להתחבר כדי לגשת לפרטי הדירוג.';
$lang['Die_rate_only_first'] = 'אתה יכול לדרג את ההודעה הראשונה בלבד בכל נושא';
$lang['User_suspended'] = 'הדירוגים למשתמש זה הופסקו על-ידי המנהל הראשי';
$lang['Cannot_rate_own'] = 'אתה לא יכול לדרג את ההודעות שלך';
$lang['Not_yet_rated'] = 'הודעה זו עדיין לא דורגה';
$lang['Rating_anon_user'] = 'משתמש רשום';
$lang['Must_be_logged_to_rate'] = 'אתה חייב להתחבר כדי לדרג הודעה זו';
$lang['Days_registered_before_rating'] = 'אתה צריך להיות רשום למשך %s לפני שתוכל לדרג הודעות';
$lang['Posts_before_rating'] = 'אתה צריך לשלוח %s לפני שתוכל לדרג הודעות אחרות';
$lang['User_rating_limit'] = 'דירגת כבר את %s על-ידי משתמש זה ב-24 השעות האחרונות, בזמן שההגבלה נקבעת על-ידי המנהל הראשי';
$lang['Daily_rating_limit'] = 'דירגת כבר את %s ב-24 השעות האחרונות, בזמן שההגבלה נקבעת על-ידי המנהל הראשי';
$lang['Already_rated'] = 'דירגת כבר הודעה זו';
$lang['No_rating_permission_post'] = 'אין לך גישות לדרג הודעה זו';
$lang['No_rating_permission'] = 'אין לך גישות לדרג הודעות';
$lang['Your_rating'] = 'הדירוג שלך להודעה זו';
$lang['Rating_visible']	= 'הדירוג שלך יראה לאחרים';
$lang['Rating_visible_forced']	= 'הערה: דירוגים אלמוניים אינם מאופשרים יותר. אם תלחץ על הכפתור, כל הדירוגים שלך יראו לאחרים';
$lang['Rate_anonymously'] = 'דרג באופן אלמוני (קבע לכל הדירוגים שלך)';
$lang['Return_to_post']	= 'חזור להודעה';
$lang['Close_window'] = 'סגור חלון';
$lang['Poster_rank'] = 'דירוג השולח';
$lang['Topic_rank'] = 'דירוג הנושא';
$lang['Post_rank'] = 'דירוג ההודעה';
$lang['Rated_by'] = 'דורג על-ידי';
$lang['Rated_on'] = 'ב-';
$lang['No_rating'] = 'אין דירוג';
$lang['Unrated'] = 'לא דורג';
$lang['No_rank'] = 'אין דירוג';
$lang['Rating_sample_post'] = 'הודעה פשוטה';
$lang['Topic_starter'] = 'נושא מתחיל';
$lang['Rating_deactivated'] = 'סליחה, מערכת הדירוגים בלתי פעילה בזמן זה';
$lang['No_ratings'] = 'אין דירוגים';
$lang['Total_points'] = 'כמות נקודות';
$lang['Average_points'] = 'נקודות ממוצעות';
$lang['Rate_it'] = 'דרג';
$lang['Rating_config_gen'] = 'הגדרות כלליות';
$lang['Rating_overview_text'] = '<b>שים לב</b>: משתמשים יכולים לדרג כל הודעה בנפרד, על-ידי בחירה מהטווח של "אפשרויות דירוג", כל דירוג מהאפשרויות מביא ערך נקודה מסויים.  הדירוג הכולל לכל הודעה מחושב על-ידי סיכום (או ממוצע) כל נקודות הדירוג בנפרד להודעה זו, וקביעת דירוג מ-"טבלת סיכומים". הדירוגים הכוללים לנושאים ומשתמשים מופעלים גם בדרך זו (למשל כל הדירוגים של ההודעות בנושא מסויים / על-ידי משתמש מסויים).';
$lang['Rating_settings_title'] = 'הגדרות כלליות למערכת הדירוגים שלך';
$lang['Rating_settings_text'] = '<b>דירוג ההודעה הראשונה בלבד</b>: ניתן לדרג בכל נושא את ההודעה הראשונה בלבד<br />
<b>מינימום כמות הודעות</b>: מספר הודעות שהמשתמש חייב לשלוח לפני שיוכל לדרג<br />
<b>מינימום ימי רישום</b>: ימים שחייבים לעבור מאז הרשמת המשתמש לפני שיוכל לדרג<br />
<b>שיטת שקלול</b>: אם מופעל, משתמש יוכל לבחור מאפשרויות הדירוג הללו בלבד כאשר המונה שלו (למשל מונה הודעות) שווה או עובר את המספר שבעמודה "סף שקלול" (ראה טבלה מתחת)<br />
<b>דירוגים יומיים מירביים</b>: הגבלת כמות מספר הדירוגים שהמשתמשים יכולים לשלוח ב-24 השעות האחרונות<br />
<b>דירוגים יומיים מירביים למשתמש</b>: הגבלת מספר הפעמים שמשתמש יכול לדרג הודעות על-ידי אותו שולח ב-24 השעות האחרונות<br />
<b>אפשר למשתמשים להסתיר שם</b>: אפשר למשתמשים להופיע כאלמוניים ברשימת המי דרג<br />
<b>שיטת דירוג כוללת</b>: אם כמות הדירוגים מבוססים על סכום או ממוצע של כל הדירוגים בנפרד';
$lang['Rating_options'] = 'אפשרויות דירוג';
$lang['Points'] = 'נקודות';
$lang['Rating_label'] = 'תיאור';
$lang['Weighting_threshold'] = 'סף שקלול';
$lang['Rating_who'] = 'מי';
$lang['Rating_used'] = 'משומש';
$lang['Rating_delete'] = 'מחק';
$lang['Rating_update'] = 'עדכן';
$lang['Rating_update_config'] = 'עדכן הגדרות';
$lang['Rating_add'] = 'הוסף';
$lang['Rating_option_title'] = 'קבע טווח של דירוגים שמשתמש יכול לקבוע מהם';
$lang['Rating_option_text'] = '<b>נקודות</b>: משומש לחישוב כמות הדירוגים של ההודעות, הנושאים והמשתמשים<br />
<b>סף שקלול</b>: ראה "שיטת שקלול" בהגדרות כלליות<br />
<b>מי</b>: משומש להגבלת אפשרויות מבוססות על מצב המשתמש<br />
<b>משומש</b>: מספר הפעמים שאפשרות נבחרה לכל תאריך<br />';
$lang['Rating_ranks'] = 'הצגת דירוגי הודעות ונושאים';
$lang['User_ranks_title'] = 'הצגת דירוגי משתמשים';
$lang['Board_rank'] = 'מערכת דירוגים';
$lang['Rating_applies_to'] = 'שייך ל-';
$lang['Rating_sum'] = 'סיכום';
$lang['Rating_average'] = 'מומצע';
$lang['Rating_max'] = 'מקסימום';
$lang['Rating_icon'] = 'אייקון';
$lang['Rating_rank_title'] = 'כיצד הדירוגים הכוללים מחושבים ומוצגים';
$lang['Rating_rank_text'] = '<b>ממוצע</b>: הממוצע של כל הדירוגים השונים מחושב, והדירוג <b>ההכי קרוב</b> לאמד"ממוצע" נבחר<br />
<b>סיכום</b>: כל הדירוגים מסוכמים, ומה שיוצא מאותם דירוגים זהו סך הכל <b>שווה או עובר</b> את "סף הסיכום", הדירוג עם סף הסיכום הגבוהה ביותר הוא הנבחר';
$lang['Rating_admin_page_title'] = 'הגדרות מערכת הדירוגים';
$lang['Must_be_an_integer'] = 'חייב להיות מספר שלם';
$lang['Invalid_point_value'] = 'ערך הנקודות חייב להיות מספר שלם בין -127 ו 128';
$lang['Invalid_threshold_value'] = 'ערך הסף חייב להיות מספרי בין 0 ו 30000';
$lang['Invalid_average_threshold'] = 'סף ממוצע חייב להיות מספרי בין -127 ו 128';
$lang['Invalid_sum_threshold'] = 'סף הסיכום חייב להיות מספרי בין -2000000000 ו 2000000000';
$lang['Weighting_method_posts'] = 'מונה הודעות';
$lang['Rating_user_type_all'] = 'כל המשתמשים';
$lang['Rating_user_type_mods'] = 'כל המנהלים';
$lang['Rating_user_type_forum'] = 'פורום מנהלים';
$lang['Rating_user_type_admin'] = 'מנהל ראשי בלבד';
$lang['Rating_remove_confirm'] = 'הדירוגים הקיימים יוסרו. אתה בוח שאתה רוצה למחוק אפשרות זו?';
$lang['Rating_recalc_confirm'] = 'הדירוגים הקיימים יחושבו מחדש. אתה בטוח שאתה רוצה למחוק דירוג זה?';
$lang['Rating_admin_errors'] = 'ישנם כמה בעיות עם המידע ששלחת. אנא קרא את ההודעות מתחת, בצע את השינויים ההכרחיים ושלח מחדש:';
$lang['As_rated_by'] = 'כדורג על-ידי';
$lang['As_rated_by_you'] = 'כדורג כל-ידיך';
$lang['Ratings_posts_by'] = 'הודעות על-ידי';
$lang['Ratings_posts_by_you'] = 'הודעותיך';
$lang['Recalc_text'] = 'כמה פעולות יכולות לדרוש שאתה תחשב מחדש ידנית את הדירוגים למשל מחיקת ההודעות שדורגו. כדי לעשות זאת, לחץ על הכפתור מתחת';
$lang['Recalc_button'] = 'חשב מחדש את כל הדירוגים';
$lang['Recalc_confirm'] = 'אתב בטוח? זה יכול לקחת כמה זמן במערכות גדולות';
$lang['Ratedby_hidden'] = 'המנהל הראשי בחר להסתיר את השמות של המשתמשים שדרגו הודעות';
$lang['Rating_screen_type'] = 'סוג מסך';
$lang['Rating_in'] = 'בתוך'; // As in "posts IN this forum"
$lang['Rating_all_forums'] = 'כך הפורומים';
$lang['Rating_make_neutral'] = 'דירוגים בכיוון ניטרלי על-ידי %s';
$lang['Rating_is_neutral'] = 'אתה כרגע מדרג בכיוון ניטרלי על-ידי %s';
$lang['Rating_make_buddy'] = 'דירוגים טובים על-ידי %s';
$lang['Rating_is_buddy'] = 'יש לך כרגע דירוגים מועדפים על-ידי %s';
$lang['Rating_buddy'] = 'הדירוגים שלך מועדפים כרגע על-ידי %s';
$lang['Rating_ignored'] = 'הדירוגים שלך מתעלמים כרגע על-ידי %s';
$lang['Rating_make_ignored'] = 'דירוגים מתעלמים על-ידי %s' ;
$lang['Rating_is_ignored'] = 'אתה מתעלם כרגע מדירוגים על-ידי %s';
$lang['Rating_bias'] = 'הטיות';
$lang['Rating_bias_off'] = 'אפשרויות ההטיות לא זמינות כרגע';
$lang['Rating_bias_loggedoff'] = 'אתה חייב להיות מחובר כדי להשתמש במערכת ההטיות של הדירוגים';
$lang['Rating_all_but_ignore'] = 'הכל אבל \'המתעלמים\' שלי';
$lang['Rating_everyone'] = 'כל אחד';
$lang['Rating_buddies_only'] = 'החברים שלך בלבד';
$lang['Rating_include_by'] = 'כולל דירוגים על-ידי';
$lang['Rating_yourself'] = 'יצמך';
$lang['Rating_bias_prompt'] = 'הטייה שעוררה על-ידי';
$lang['Rating_bias_when'] = 'כאשר';
$lang['Rating_current'] = 'דירוג נוכחי';
$lang['Rating_buddies_only'] = 'חברים בלבד';
$lang['Rating_ignores_only'] = 'מתעלמים בלבד';
$lang['Rating_post_removed'] = 'הודעה שלא קיימת יותר';
$lang['Rating_this_post'] = 'הודעה זו';
$lang['Rating_this_user'] = 'משתמש זה';
$lang['Rating_of'] = 'דירוג של';
$lang['Rating_awarded_to'] = 'מוענק ל';
$lang['Rating_my_bias_title'] = 'כיווני הטיות לדירוגים שלי על-ידי משתמשים אחרים';
$lang['Rating_their_bias_title'] = 'הטיות על-ידי משתמשים אחרים מכוונים לדירוגים שלי';
$lang['Rating_no_bias'] = 'אין הטיות כרגע';
?>