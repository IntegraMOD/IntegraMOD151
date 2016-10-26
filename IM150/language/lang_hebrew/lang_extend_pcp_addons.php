<?php
/***************************************************************************
 *						lang_extend_pcp_addons.php [Hebrew]
 *						------------------------------------
 *	begin				: 30/10/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 1.0.0 - 30/10/2003
 *
 ***************************************************************************
 *
 *								Customs lang key entries
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
	$lang['Lang_extend_pcp_addons'] = 'תוספות ללוח הבקרה לפרופיל';
}

// START - SEND PM ON REGISTER MOD - AbelaJohnB 
$lang['register_pm_subject'] = 'ברוך הבא ל-%s'; 
$lang['register_pm'] = 'שלום!<br /><br />ברוך הבא ל-%s. <br /><br />אנו מקווים שאתה נהנה מהזמן שלך באתר זה! <br /><br />תרגיש חופשי להרשם ולהשתתף עם אחרים או לנהל דיון משלך! <br /><br />~תהנה!<br />צוות %s '; 
// END - SEND PM ON REGISTER MOD - AbelaJohnB 

$lang['gallery'] = 'גלריית משתמש';
$lang['PCP_topics_last'] = 'נושאים אחרונים';
$lang['PCP_topics_last_per_page'] = 'מספר נושאים אחרונים המוצגים בכל עמוד בדף הבית של לוח הבקרה';
$lang['PCP_topics_last_visit'] = 'מאז ביקורך האחרון';

$lang['gal_pic_in'] = ' תמונות עבור ';
$lang['gal_pic'] = ' תמונות';
$lang['user_photo'] = 'תצלום בפרופיל ציבורי';
$lang['user_photo_explain'] = 'לא בחרת תצלום מהגלרייה האישית שלך. <a href="album_personal.php">העלה תצלום</a> ובחר אותו ב <a href="profile.php?mode=profil">פרופיל שלך</a>';

$lang['country_explain'] 	= 'בחר את המדינה שלך ואת דגל המדינה שלך שיוצגו בנושאים שלך ובחלקי הנושאים';
$lang['profil_country']		= 'דגל המדינה';
$lang['profil_state']		= 'דגל האיזור';
$lang['state_explain'] 	        = 'בחר את הדגל שלך ואת דגל האיזור שלך שיוצגו בפרופיל שלך וחלקי הנושאים';

$lang['Holidays'] = 'חופשות';
$lang['On_Holidays'] = 'בחופשה';
$lang['No_holidays_specify'] = 'לא ידוע';
// skype :: added :: start
$lang['SKYPE'] = 'מסנג\'ר Skype';
// skype :: added :: end

$lang['FDOW']	= 'יום ראשון של השבוע'; // calendar fix
?>