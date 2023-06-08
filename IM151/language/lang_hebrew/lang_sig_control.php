<?php 
/************************************************************** 
* MOD Title:   Signatures control 
* MOD Version: 1.2.1
* Translation: English 
* Rev date:    14/08/2004 
* 
* Translator:  -=ET=- < space_et@tiscali.fr > (n/a) http://www.golfexpert.net/phpbb 
*              Narc0sis < corrosion69@hotmail.com > (n/a) http://www.deviantcore.com
* 
***************************************************************/ 

$lang['sig_settings'] = 'הגדרות חתימה'; 
$lang['sig_settings_explain'] = 'אזהרה: לכל השדות המספריים (חוץ מגודל הגופן), קבע "0" או ריק אומרים "בלתי מוגבל"!'; 

$lang['sig_max_lines'] = 'מספר מירבי של שורות'; 
$lang['sig_wordwrap'] = 'מספר מירבי של תווים ללא רווחים'; 
$lang['sig_allow_font_sizes'] = 'גודל גופן הטקסט [גודל]'; 
$lang['sig_allow_font_sizes_yes'] = 'חופשי'; 
$lang['sig_allow_font_sizes_max'] = 'מוגבל'; 
$lang['sig_allow_font_sizes_imposed'] = 'הוטל'; 
$lang['sig_font_size_limit'] = 'הגבלות גודל הגופן או גודל מוטל'; 
$lang['sig_font_size_limit_explain'] = 'phpBB לא מנהלי גופנים הגדולים מ-29. יתר על כן אם אתה רוצה להטיל גודל גופן, אתה לא יכול לקבוע גודל הקטן מ-7'; 
$lang['sig_min_font_size'] = 'מינימום /'; 
$lang['sig_max_font_size'] = 'מקסימום או גודל מוטל'; 
$lang['sig_text_enhancement'] = 'אפשר שיפורי טקסט'; 
$lang['sig_allow_bold'] = 'מודגש [b]'; 
$lang['sig_allow_italic'] = 'נטוי [i]'; 
$lang['sig_allow_underline'] = 'קו תחתי [u]'; 
$lang['sig_allow_colors'] = 'צבעי גופן [color]'; 
$lang['sig_text_presentation'] = 'אפשר הצגות טקסט'; 
$lang['sig_allow_quote'] = 'ציטוטים [quote]'; 
$lang['sig_allow_code'] = 'ציטוטי קוד [code]'; 
$lang['sig_allow_list'] = 'רשימות [list]'; 
$lang['sig_allow_url'] = 'אפשר כתובות [url]'; 
$lang['sig_allow_images'] = 'אפשר תמונות [img]'; 
$lang['sig_max_images'] = 'מספר מירבי של תמונות'; 
$lang['sig_max_img_size'] = 'גודל תמונות מירבי'; 
$lang['sig_max_img_size_explain1'] = 'עקרונית, בקרת גודל התמונה לא חייבת להיות בעייתית במערכת זו. בכל זאת, אם גודל תמונה לא יכול להבדק, קבע אם התמונה חייבת להיות מאופשרת על-ידי ברירת מחדל או סרב'; 
$lang['sig_max_img_size_explain2'] = 'בקרת גודל התמונה לכמה תמונות יכולה להיות בלתי אפשרית במערכת זו (%s). קבע אם תמונות בלתי נשלטות חייבות להיות מאופשרות על-ידי ברירת המחדל או סרב'; 
$lang['sig_max_img_size_explain3'] = 'עקרונית, בקרת גודל התמונה בלתי אפשרית במערכת זו (%s). קבע אם תמונות בלתי נשלטות חייב להיות מאופשרות על-ידי ברירת המחדל או סרב'; 
$lang['sig_img_size_legend'] = '(גובה x רוחב)'; 
$lang['sig_allow_on_max_img_size_fail'] = 'אפשר אם בלתי אפשרי לנהל'; 
$lang['sig_max_img_files_size'] = 'גודל קבצי תמונה מירביים בסך הכל'; 
$lang['sig_max_img_av_files_size'] = 'גודל קבצי תמונה+סמל אישי מירביים בסך הכל'; 
$lang['sig_max_img_av_files_size_explain'] = 'אם ערך נקבע בשדה זה, בקרה גלובאלית לכל גודל הקובץ של תמונות החתימה והסמל האישי של השולח יעובד, וה-2 מפריד בקרות שכבויות. אם אין ערך או 0 נקבע, הבקרה הגלובאלית תכובה.'; 
$lang['sig_Kbytes'] = 'Kb'; 
$lang['sig_exotic_bbcodes_disallowed'] = 'אל תאפשר BBCodes אחרים';
$lang['sig_exotic_bbcodes_disallowed_explain'] = 'קבע BBCodes אחרים שחייבים להיות בלתי מאופשרים (למשל: fade,php,shadow)';
$lang['sig_allow_smilies'] = 'אפשר סמיילים';
$lang['sig_reset'] = 'אפס את חתימת החברים';
$lang['sig_reset_explain'] = 'מחק את החתימה בפרופיל של <span style="color: #800000">כל החברים!</span> זה ידרוש מהם לקבוע אותם שוב, ואז עבר את בקרת החתימה';
$lang['sig_reset_confirm'] = 'אתה בטוח שאתה רוצה למחוק את החתימה של כל החברים?';

$lang['sig_reset_successful'] = 'החתימות של כל החברים נמחקו בהצלחה!';
$lang['sig_reset_failed'] = 'שגיאה: חתימת החברים אינה יכולה להמחק.';

$lang['sig_config_error'] = 'הגדרות החתימה שלך אינן תקפות.'; 
$lang['sig_config_error_int'] = 'הנתונים שנקבעו לאותם שדות לא מספרים שלמים חיוביים (או גדלי הגופן הנדרשים גדולים מ-29):'; 
$lang['sig_config_error_min_max'] = 'קבעת ערכים חסרי קשר למינימום ומקסימום גדלי גופן (מינימום: %s / מקסימום: %s). מקסימום גודל הגופן חייב להיות גדול יותר מהאחד המינימום.'; 
$lang['sig_config_error_imposed'] = 'בחרת להטיל את גודל גופן החתימה אבל גודל גופן החתימה לא שריר (%). המינימום הוא 7 והמקסימום 29.'; 

$lang['sig_allow_signature'] = 'ניתן להציג חתימה';
$lang['sig_yes_not_controled'] = 'כן לא מנוהלת';
$lang['sig_yes_controled'] = 'כן מנוהלת';

$lang['sig_explain'] = 'חתימה הוא טקסט קטן שיכול להתווסף שבתחתית הודעתיך.';
$lang['sig_explain_limits'] = 'החתימה מוגבלת ל-%s תווים%s%s%s.'; 
$lang['sig_explain_max_lines'] = ' ב-%s שורות'; // Be careful to the space at the begining! 
$lang['sig_explain_font_size_limit'] = ' (גודל %s עד %s)'; // Be careful to the space at the begining! 
$lang['sig_explain_font_size_max'] = ' (גודל %s מקסימום)'; // Be careful to the space at the begining! 
$lang['sig_explain_no_image'] = ' וללא תמונה'; // Be careful to the space at the begining! 
$lang['sig_explain_images_limit'] = ' ו-%s תמנונות שלא יותר גדולות מ-%sx%s פיקסלים ולגודל מקסימום של %sKb'; // Be careful to the space at the begining! 
$lang['sig_explain_unlimited_images'] = ' והרבה תמונות כמה שתרצה אבל שלא יוכלו לעבור %sx%s פיקסלים, למקסימום של %sKb'; // Be careful to the space at the begining! 
$lang['sig_explain_avatar_included'] = ', סמל אישי נכלל'; 
$lang['sig_explain_wordwrap'] = 'בטקסט שלך, אין יותר מ-%s תווים ללא רווח גם כן.'; 

$lang['sig_BBCodes_are_OFF'] = 'BBCodes <u>כבויים</u>'; 
$lang['sig_bbcodes_on'] = '%sBBCodes%s פעילים: '; 
$lang['sig_bbcodes_off'] = '%sBBCodes%s כבויים: '; 
$lang['sig_none'] = 'ללא'; 
$lang['sig_all'] = 'הכל'; 

$lang['sig_error'] = 'חתימתך לא שרירה.'; 
$lang['sig_error_max_lines'] = 'הטקסט שלך כולל %s שורות בעוד שרק %s מורשות.'; 
$lang['sig_error_wordwrap'] = 'הטקסט שלך כולל %s קבוצות של יותר מ-%s תווים ללא רווחים כאשר זה אסור.'; 
$lang['sig_error_bbcode'] = 'אתה השתמש ב-BBCode(s) האסורים האלו: %s'; 
$lang['sig_error_font_size_min'] = 'השתמש בגודל גופן %s בעוד שהמינימום המורשה לקבוע הוא %s.'; 
$lang['sig_error_font_size_max'] = 'השתמשת בגודל גופן %s כאשר המקסימום המורשה לקבוע הוא %s.'; 
$lang['sig_error_num_images'] = 'השתמשת ב-%s תמונות בעוד שהמקסימום המורשה הוא %s.'; 
$lang['sig_error_images_size'] = 'התמונה %s גדולה מדי.<br />גודלה הוא %s פיקסלים גובה ו-%s רוחב, בעוד שהמקסימום המורשה על-ידי תמונה הוא %s גובה ו-%s רוחב.'; 
$lang['sig_unlimited'] = 'בלתי מוגבל'; 
$lang['sig_error_images_size_control'] = 'בלתי אפשרי לנהל את גודל התמונה של: %s<br />אין תמונה בכתובת זו או שהפורום לא יכול לנהל אותה, אז אתה לא יכול להשתמש בה.'; 
$lang['sig_error_avatar_local'] = 'ישנה בעייה עם הקובץ: %s<br />זה בלתי אפשרי לוודא את גודלה.'; 
$lang['sig_error_avatar_url'] = 'כתובת זו חייבת להיות לא נכונה: %s<br />אין סמל אישי בכתובת זו.'; 
$lang['sig_error_img_files_size'] = 'סך הכל גדלי קבצי התמונות הוא %sKb בעוד שמקסימום המורשה הוא %sKb.'; 
$lang['sig_error_img_av_files_size'] = 'סך הכל גדלי קבצי התמונה שבשימוש לחתימה שלך (%sKb) והסמל האישי שלך (%sKb) גודל יותר מהמורשה %sKb.'; 

?>