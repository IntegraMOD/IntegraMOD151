<?php
/***************************************************************************
*                         admin_panel_nivisec.php
*                            -------------------
*   begin                : Friday, June 07, 2002
*   copyright            : (C) 2002 Nivisec.com
*   email                : admin@nivisec.com
*
*
*
***************************************************************************/
$lang['None'] = 'ללא';
$lang['Allow_Access'] = 'אפשר גישה';

$lang['Jr_Admin'] = 'מנהל ראשי צעיר';
$lang['Options'] = 'אפשרויות';
$lang['Example'] = 'דוגמא';
$lang['Version'] = 'גרסה';
$lang['Add_Arrow'] = 'הוסף ->';
$lang['Super_Mod'] = 'מנהל מיוחד';
$lang['Update'] = 'עדכן';
$lang['Module_Info'] = 'פרטי מודול';
$lang['Module_Count'] = 'מונה מודול';
$lang['Modules_Owned'] = '(%d מודולים)';
$lang['Updated_Permissions'] = 'מודול גישות המשתמש עודכן<br>';
$lang['Color_Group'] = 'צבע הקבוצה';
$lang['Users_with_Access'] = 'משתמשים עם גישה';
$lang['Users_without_Access'] = 'משתמשים ללא גישה';
$lang['Check_All'] = 'בחר הכל/בטל בחירה של הכל';
$lang['Cat_Check_All'] = 'קטגוריה: בחר הכל, בטל בחירה של הכל';
$lang['Edit_Permissions'] = 'ערוך גישות משתמש';
$lang['View_Profile'] = 'צפה בפרופיל המשתמש';
$lang['Edit_User_Details'] = 'ערוך פרטי משתמש';
$lang['Notes'] = 'הערות';
$lang['Allow_View'] = 'אפשר למשתמש לצפות';
$lang['Start_Date'] = 'גישות מאופשרות ראשונות פעילות';
$lang['Update_Date'] = 'גישות מעודכנות אחרונות פעילות';
$lang['Edit_Modules'] = 'ערוך מודולים';
$lang['Color_Group'] = 'צבע הקבוצה';
$lang['Rank'] = 'דירוג';
$lang['Allow_PM'] = 'אפשר הודעה פרטית';
$lang['Allow_Avatar'] = 'אפשר סמל אישי';
$lang['User_Active'] = 'המשתמש פעיל';
$lang['User_Info'] = 'פרטי המשתמש';
$lang['User_Stats'] = 'סטטיסטיקת משתמש';
$lang['Junior_Admin_Info'] = 'פרטי המנהל הראשי הצעיר שלך';
$lang['Admin_Notes'] = 'הערות מנהל ראשי';

//Descriptions
$lang['Levels_Page_Desc'] = 'עמוד זה מאפשר לך להגדיר רמות משתמש.  בחר שם משתמש מהרשימה כדי להוסיף אותו או הקלד אותו ידנית.  שמות משתמשים חייבים להיות מופרדים על-ידי , (פסיק) בכל רשימה!';
$lang['Permissions_Page_Desc'] = 'עמוד זה מאפשר לך לשנות למנהל ראשי מסויים רא אפשרויות משתמש וגם לערוך את רשימת המודול שלו.<br>אתה יכול ללחוץ על כל כותרת טבלה כדי למיין על-ידי אותה כותרת.';

//Errors
$lang['Error_Users_Table'] = 'שגיאה בשאילתת טבלת המשתמשים.';
$lang['Error_Module_Table'] = 'שגיאה בשאילתת טבלת מודול הגישות של המנהלים הראשיים הצעירים.';
$lang['Error_Module_ID'] = 'המודול הנדרש לא קיים או שאתה לא משתמש רשאי.';
$lang['Disabled_Color_Groups'] = 'מוד צבע הקבוצות לא נמצא, לא ניתן לקבוע את צבע הקבוצה.';
$lang['Admin_Note'] = 'הערה:  משתמש זה מסווג כמשתמש בעל רמת מנהל ראשי.  כל הגבלות שהושמו כאן לא יעבדו עד שתשנה את הגישה שלהם למשתמש במקום מנהל ראשי.';
$lang['No_Special_Ranks'] = 'אין דירוגים מיוחדים מוגדרים.';

//This is the bookmark ASCII search list!  If you have odd usernames, you should add your own ASCII search numbers.
//It uses a special format.
//
// Smaller-case letters are ignored also.  Don't bother listing them as everything is converted to upper case for eval.
//
// It searches and prepares the bookmark heading IN THE ORDER you have it below.  It will not sort lowest to highest.
//
// Item-Item2 will search the code from item to item2 AND give each their own bookmark heading (ex. A-Z)
// Item&Item2 will search the code from item to item2 BUT NOT give each their own heading, they will appear like 1-9
// You can add single entries, ie 67
// Seperate entry areas by a ,
//
$lang['ASCII_Search_Codes'] = '48&57, 65-90';

//Images
// Don't change these unless you need to
$lang['ASC_Image'] = 'images/asc_order.png';
$lang['DESC_Image'] = 'images/desc_order.png';

?>