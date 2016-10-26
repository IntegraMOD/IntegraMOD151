<?php
/*************************************************************************** 
*                            lang_admin_album.php [French] 
*                              ------------------- 
*     begin                : Sunday, February 02, 2003 
*     copyright            : (C) 2003 Smartor 
*     email                : smartor_xp@hotmail.com 
* 
*     $Id: lang_admin_album.php,v 1.0.6 2003/03/05 00:21:55 ngoctu Exp $^_^ 
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

/*************************************************************************** 
* 
*     Translation          : Kooky < kooky06@hotmail.com > 
* 
***************************************************************************/ 

//--- Multiple File Upload mod : begin
//--- version : 1.0.3
include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_multiple_album.' . $phpEx);
//--- Multiple File Upload mod : end

// 
// Configuration 
// 
$lang['Album_config'] = 'Configuration de l\'Album'; 
$lang['Album_config_explain'] = 'Ici, vous pouvez changer les options principales de votre Album Photos'; 
$lang['Album_config_updated'] = 'La configuration de l\'Album a été mise à jour avec succès'; 
$lang['Click_return_album_config'] = 'Cliquez %sici%s pour revenir à la configuration de l\'Album'; 
$lang['Max_pics'] = 'Nombre maximum de photos pour chaque catégorie (-1 = illimité)'; 
$lang['User_pics_limit'] = 'Nombre limite de photos par catégorie pour chaque utilisateur (-1 = illimité)'; 
$lang['Moderator_pics_limit'] = 'Nombre limite de photos par catégorie pour chaque modérateur (-1 = illimité)'; 
$lang['Pics_Approval'] = 'Approbation des photos'; 
$lang['Rows_per_page'] = 'Nombre de lignes sur la page des miniatures'; 
$lang['Cols_per_page'] = 'Nombre de colonnes sur la page des miniatures'; 
$lang['Thumbnail_quality'] = 'Qualité des miniatures (1-100)'; 
$lang['Thumbnail_cache'] = 'Cache des miniatures'; 
$lang['Manual_thumbnail'] = 'Option manuelle des miniatures'; 
$lang['GD_version'] = 'Optimisation pour la version de la librairie GD'; 
$lang['Pic_Desc_Max_Length'] = 'Longueur maximale de la description/commentaire de la photo (en caractères)'; 
$lang['Hotlink_prevent'] = 'Prévention des liens directs'; 
$lang['Hotlink_allowed'] = 'Autoriser des domaines pour les liens directs (séparer par une virgule)'; 
$lang['Personal_gallery'] = 'Autoriser la création d\'une galerie personnelle par les utilisateurs'; 
$lang['Personal_gallery_limit'] = 'Nombre limite de photos pour chaque galerie personnelle (-1 = illimité)'; 
$lang['Personal_gallery_view'] = 'Qui peut voir les galeries personnelles'; 
$lang['Rate_system'] = 'Autoriser le sytème de notation'; 
$lang['Rate_Scale'] = 'Echelle de notation'; 
$lang['Comment_system'] = 'Autoriser le système de commentaire'; 
$lang['Thumbnail_Settings'] = 'Options des miniatures'; 
$lang['Extra_Settings'] = 'Options spéciales'; 
$lang['Default_Sort_Method'] = 'Méthode de tri par défaut'; 
$lang['Default_Sort_Order'] = 'Ordre de tri par défaut'; 
$lang['Fullpic_Popup'] = 'Voir la photo complète dans une fenêtre'; 


// Personal Gallery Page 
$lang['Personal_Galleries'] = 'Galeries Personnelles'; 
$lang['Album_personal_gallery_title'] = 'Galeries Personnelles'; 
$lang['Album_personal_gallery_explain'] = 'Sur cette page, vous pouvez choisir quels groupes sont autorisés à créer et voir les galeries personnelles. Ces options s\'appliquent uniquement lorsque vous réglez "Autoriser la création d\'une galerie personnelle pour les utilisateurs" ou "Qui peut voir les galeries personnelles" sur "PRIVE" dans l\'écran de configuration de l\'Album.'; 
$lang['Album_personal_successfully'] = 'Les options ont été mises à jour avec succès'; 
$lang['Click_return_album_personal'] = 'Cliquez %sici%s pour revenir aux options des Galeries Personnelles'; 

// 
// Categories 
// 
$lang['Album_Categories_Title'] = 'Contrôle des catégories de l\'Album'; 
$lang['Album_Categories_Explain'] = 'Sur cette écran, vous pouvez gérer vos catégories: créer, modifier, supprimer, ordonner, etc.'; 
$lang['Category_Permissions'] = 'Permissions de la catégorie'; 
$lang['Category_Title'] = 'Titre de la catégorie'; 
$lang['Category_Desc'] = 'Description de la catégorie'; 
$lang['View_level'] = 'Voir'; 
$lang['Upload_level'] = 'Uploader'; 
$lang['Rate_level'] = 'Noter'; 
$lang['Comment_level'] = 'Commenter'; 
$lang['Edit_level'] = 'Editer'; 
$lang['Delete_level'] = 'Supprimer'; 
$lang['New_category_created'] = 'La nouvelle catégorie a été créée avec succès'; 
$lang['Click_return_album_category'] = 'Cliquez %sici%s pour revenir à la gestion des catégories de l\'Album'; 
$lang['Category_updated'] = 'Cette catégorie a été mise à jour avec succès'; 
$lang['Delete_Category'] = 'Supprimer la catégorie'; 
$lang['Delete_Category_Explain'] = 'Le formulaire ci-dessous vous autorise à supprimer une catégorie et à décider où vous souhaitez placer les photos qu\'elle contient.'; 
$lang['Delete_all_pics'] = 'Supprimer toutes les photos'; 
$lang['Category_deleted'] = 'Cette catégorie a été supprimée avec succès'; 
$lang['Category_changed_order'] = 'Cette catégorie a changé d\'ordre avec succès'; 

// 
// Permissions 
// 
$lang['Album_Auth_Title'] = 'Permissions de l\'Album'; 
$lang['Album_Auth_Explain'] = 'Ici, vous pouvez choisir quels groupes peuvent être modérateur pour chaque catégorie de l\'Album ou seulement en tant qu\'accès privé.'; 
$lang['Select_a_Category'] = 'Sélectionner une catégorie'; 
$lang['Look_up_Category'] = 'Consulter la catégorie'; 
$lang['Album_Auth_successfully'] = 'Les permissions ont été mises à jour avec succès'; 
$lang['Click_return_album_auth'] = 'Cliquez %sici%s pour revenir aux permissions de l\'Album'; 

$lang['Upload'] = 'Uploader'; 
$lang['Rate'] = 'Noter'; 
$lang['Comment'] = 'Commentaire'; 
$lang['View'] = 'Vu';

// 
// Clear Cache 
// 
$lang['Clear_Cache'] = 'Vider le cache'; 
$lang['Album_clear_cache_confirm'] = 'Si vous utilisez l\'option du cache des miniatures, vous devez vider votre cache des miniatures après avoir modifié vos options des miniatures dans la configuration de l\'Album pour qu\'elles soient générées à nouveau.<br /><br /> Voulez-vous le vider maintenant ?'; 
$lang['Thumbnail_cache_cleared_successfully'] = '<br />Votre cache des miniatures a été vidé avec succès<br />&nbsp;'; 

/* BSRA Album Hierarchy Mod v1.0  START */
$lang['Parent_Category'] = 'Catégorie Parente (pour cette catégorie)';
$lang['Child_Category_Moved'] = 'La catégorie sélectionnée a des catégories-filles. Les catégories-filles ont été déplacées vers la catégorie <B>%s</B>.';
/* BSRA Album Hierarchy Mod v1.0 STOP  */
?>
