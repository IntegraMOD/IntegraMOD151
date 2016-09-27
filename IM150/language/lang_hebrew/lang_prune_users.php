<?php 
/************************************************************* 
* MOD Title:   Prune users
* MOD Version: 1.4.2
* Translation: English
* Rev date:    19/12/2003 
* 
* Translator:  Niels < ncr@db9.dk > (Niels Chr. Rרd) http://mods.db9.dk 
* 
**************************************************************/

// add to prune inactive
$lang['X_Days'] = '%d ימים';
$lang['X_Weeks'] = '%d שבועות';
$lang['X_Months'] = '%d חודשים';
$lang['X_Years'] = '%d שנים';

$lang['Prune_no_users']="לא נמחקו משתמשים";
$lang['Prune_users_number']="%d המשתמשים הבאים נמחקו:";

$lang['Prune_user_list'] = 'משתמשים שימחקו';
$lang['Prune_on_click'] = 'אתה עומד למחוק %d משתמשים. אתה בטוח?';
$lang['Prune_Action'] = 'לחץ על הקישור מתחת כדי לבצע';
$lang['Prune_users_explain'] = 'מעמוד זה אתה יכול לאפס משתמשים. אתה יכול לבחור אחד משלושת הקישורים: מחק משתמשים ישנים שלא שלחו לעולם, מחק משתמשים ישנים שלא התחברו לעולם, מחק משתמשים שלעולם לא הפעילו את חשבונותיהם.<p/><b>הערה:</b> אין פונקציית שחזור.';
$lang['Prune_commands'] = array();

// here you can make more entries if needed
$lang['Prune_commands'][0] = 'אפס משתמשים שלא שלחו';
$lang['Prune_explain'][0] = 'משתמשים שלא שלחו לעולם, <b>לא כולל</b> משתמשים חדשים מלפני %d ימים';
$lang['Prune_commands'][1] = 'אפס משתמשים שלא התחברו';
$lang['Prune_explain'][1] = 'משתמשים שלא התחברו לעולם, <b>לא כולל</b> משתמשים חדשים מלפני %d ימים';
$lang['Prune_commands'][2] = 'אפס משתמשים שלא הופעלו';
$lang['Prune_explain'][2] = 'משתמשים שלא הופעלו לעולם, <b>לא כולל</b> משתמשים חדשים מלפני %d ימים';
$lang['Prune_commands'][3] = 'אפס משתמשים שלא התחברו זמן רב';
$lang['Prune_explain'][3] = 'משתמשים שלא ביקרו 60 ימים, <b>לא כולל</b> משתמשים חדשים מלפני %d ימים';
$lang['Prune_commands'][4] = 'אפס משתמשים שלא שולחים לעיתים קרובות';
$lang['Prune_explain'][4] = 'משתמשים שיש להם בממוצע פחות מהודעה אחת לכל 10 ימים מאז הרשמתם, <b>לא כולל</b> משתמשים חדשים מלפני %d ימים'; 

?>
