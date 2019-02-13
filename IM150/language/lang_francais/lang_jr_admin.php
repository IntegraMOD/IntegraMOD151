<?php
/***************************************************************************
*                         admin_panel_nivisec.php
*                            -------------------
*   begin                : Friday, June 07, 2002
*   copyright            : (C) 2002 Nivisec.com
*   email                : admin@nivisec.com
*
*   $Id: lang_jr_admin.php,v 1.4 2003/08/15 02:09:36 nivisec Exp $
*
*
***************************************************************************/
$lang['None'] = 'Aucun';
$lang['Allow_Access'] = 'Autoriser l\'accès';

$lang['Jr_Admin'] = 'Junior Admin';
$lang['Options'] = 'Options';
$lang['Example'] = 'Exemple';
$lang['Version'] = 'Version';
$lang['Add_Arrow'] = 'Ajouter ->';
$lang['Super_Mod'] = 'Super Modérateur';
$lang['Update'] = 'Mise à jour';
$lang['Module_Info'] = 'Informations du module';
$lang['Module_Count'] = 'Nombre de modules';
$lang['Modules_Owned'] = '(%d Modules)';
$lang['Updated_Permissions'] = 'Permissions du module de l\'utilisateur mis à jour<br>';
$lang['Color_Group'] = 'Couleur du groupe';
$lang['Users_with_Access'] = 'Utilisateurs ayant un accès';
$lang['Users_without_Access'] = 'Utilisateurs n\'ayant pas d\'accès';
$lang['Check_All'] = 'Tout sélectionner/déselectionner';
$lang['Cat_Check_All'] = 'Catégorie: Tout sélectionner/déselectionner';
$lang['Edit_Permissions'] = 'Editer les permissions';
$lang['View_Profile'] = 'Voir le profil';
$lang['Edit_User_Details'] = 'Editer le profil';
$lang['Notes'] = 'Notes';
$lang['Allow_View'] = 'Autoriser l\'utilisateur à voir les notes';
$lang['Start_Date'] = 'Première activation des permissions';
$lang['Update_Date'] = 'Dernière mise à jour des permissions';
$lang['Edit_Modules'] = 'Editer les modules';
$lang['Color_Group'] = 'Couleur du groupe';
$lang['Rank'] = 'Rang';
$lang['Allow_PM'] = 'MP autorisé';
$lang['Allow_Avatar'] = 'Avatar autorisé';
$lang['User_Active'] = 'Utilisateur actif';
$lang['User_Info'] = 'Informations sur l\'utilisateur';
$lang['User_Stats'] = 'Statistiques de l\'utilisateur';
$lang['Junior_Admin_Info'] = 'Vos informations de Junior Admin';
$lang['Admin_Notes'] = 'Notes de l\'administrateur';

//Descriptions
$lang['Levels_Page_Desc'] = 'Cette page vous permet de choisir le niveau de l\'utilisateur. Choisissez un nom d\'utilisateur dans la liste pour l\'ajouter ou bien entrez-le manuellement. Les noms d\'utilisateurs doivent être séparés par une virgule dans chaque liste !';
$lang['Permissions_Page_Desc'] = 'Cette page vous permet de masquer à votre Junior Admin certaines options administratives et ainsi changer leurs listes de modules.<br>Vous pouvez trier le tableau en cliquant sur la première case de chaque colonne.';

//Errors
$lang['Error_Users_Table'] = 'Erreur en effectuant une requête dans la table users.';
$lang['Error_Module_Table'] = 'Erreur en effectuant une requête dans la table des permissions des modules de Junior Admin.';
$lang['Error_Module_ID'] = 'Le module que vous avez demandé n\'existe pas ou bien vous n\'avez pas l\'autorisation.';
$lang['Disabled_Color_Groups'] = 'Color Groups Mod n\'est pas installé, vous ne pouvez pas assigner une couleur de groupe.';
$lang['Admin_Note'] = 'Note:  Cet utilisateur a un niveau Administrateur. Toutes les restrictions indiquées ici ne seront effectives uniquement si vous changez son niveau d\'Administrateur à Utilisateur.';
$lang['No_Special_Ranks'] = 'Aucun rang spécial défini.';

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
