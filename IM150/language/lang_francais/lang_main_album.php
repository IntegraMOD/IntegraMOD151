<?php
/*************************************************************************** 
*                          lang_main_album.php [French] 
*                              ------------------- 
*     begin                : Sunday, February 02, 2003 
*     copyright            : (C) 2003 Smartor 
*     email                : smartor_xp@hotmail.com 
* 
*     $Id: lang_main_album.php,v 1.0.6 2003/03/05 20:12:38 ngoctu Exp $^_^ 
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
///
//--- Multiple File Upload mod : begin
//--- version : 1.0.3
include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_multiple_album.' . $phpEx);
//--- Multiple File Upload mod : end

$lang['PICVIEWPREVIOUS'] = '&laquo; Précédent';
$lang['PICVIEWALBUMNEXT'] = 'Suivant &raquo;';

// 
// Album Index 
// 
$lang['Photo_Album'] = 'Album Photos'; 
$lang['Pics'] = 'Photos'; 
$lang['Last_Pic'] = 'Dernière photo'; 
$lang['Public_Categories'] = 'Catégories publiques'; 
$lang['No_Pics'] = 'Aucune Photo'; 
$lang['Users_Personal_Galleries'] = 'Galeries personnelles des utilisateurs'; 
$lang['Your_Personal_Gallery'] = 'Votre galerie personnelle'; 
$lang['Recent_Public_Pics'] = 'Photos publiques récentes';

//$lang['Highest_Rated_Pics'] = 'Photos les mieux notées';
//$lang['Random_Pics'] = 'Photos aléatoires';

$lang['Poster'] = 'Posté par';
$lang['Posted'] = 'Date';
$lang['View'] = 'Vu'; 
///
// 
// Category View 
// 
$lang['Category_not_exist'] = 'Cette catégorie n\'existe pas'; 
$lang['Upload_Pic'] = 'Uploader une photo'; 
$lang['Pic_Title'] = 'Titre'; 
// SANJI START ADD - Album Picture Id Display Add-On MOD
$lang['Pic']= 'Id'; 
// SANJI END

$lang['Album_upload_can'] = 'Vous <b>pouvez</b> uploader de nouvelles photos dans cette catégorie'; 
$lang['Album_upload_cannot'] = 'Vous <b>ne pouvez pas</b> uploader de nouvelles photos dans cette catégorie'; 
$lang['Album_rate_can'] = 'Vous <b>pouvez</b> noter les photos dans cette catégorie'; 
$lang['Album_rate_cannot'] = 'Vous <b>ne pouvez pas</b> noter les photos dans cette catégorie'; 
$lang['Album_comment_can'] = 'Vous <b>pouvez</b> poster des commentaires sur les photos dans cette catégorie'; 
$lang['Album_comment_cannot'] = 'Vous <b>ne pouvez pas</b> poster des commentaires sur les photos dans cette catégorie'; 
$lang['Album_edit_can'] = 'Vous <b>pouvez</b> éditer vos photos et commentaires dans cette catégorie'; 
$lang['Album_edit_cannot'] = 'Vous <b>ne pouvez pas</b> éditer vos photos et commentaires dans cette catégorie'; 
$lang['Album_delete_can'] = 'Vous <b>pouvez</b> supprimer vos photos et commentaires dans cette catégorie'; 
$lang['Album_delete_cannot'] = 'Vous <b>ne pouvez pas</b> supprimer vos photos et commentaires dans cette catégorie'; 
$lang['Album_moderate_can'] = 'Vous <b>pouvez</b> %smodérer%s cette catégorie'; 

$lang['Edit_pic'] = 'Editer'; 
$lang['Delete_pic'] = 'Supprimer'; 
$lang['Rating'] = 'Note'; 
$lang['Comments'] = 'Commentaires'; 
$lang['New_Comment'] = 'Nouveau commentaire'; 

$lang['Not_rated'] = '<i>aucune note</i>'; 

// 
// Upload 
// 
$lang['Pic_Desc'] = 'Description'; 
$lang['Plain_text_only'] = 'Texte à caractère simple uniquement'; 
$lang['Max_length'] = 'Longueur maximale (en caractères)'; 
$lang['Upload_pic_from_machine'] = 'Uploader une photo à partir de votre ordinateur'; 
$lang['Upload_to_Category'] = 'Uploader vers une catégorie'; 
$lang['Upload_thumbnail_from_machine'] = 'Uploader cette miniature à partir de votre ordinateur (doit avoir le même type d\'extension que votre photo)'; 
$lang['Upload_thumbnail'] = 'Uploader une miniature'; 
$lang['Upload_thumbnail_explain'] = 'Cela doit-être le même type d\'extension que votre image'; 
$lang['Thumbnail_size'] = 'Taille de la miniature (en pixels)'; 
$lang['Filetype_and_thumbtype_do_not_match'] = 'Votre photo et votre miniature doivent avoir le même type d\'extension'; 

$lang['Upload_no_title'] = 'Vous devez entrer un titre pour votre photo'; 
$lang['Upload_no_file'] = 'Vous devez entrer votre chemin et votre nom de fichier'; 
$lang['Desc_too_long'] = 'Votre description est trop longue'; 

$lang['Max_file_size'] = 'Taille maximale du fichier (en octets)'; 
$lang['Max_width'] = 'Largeur maximale de l\'image (en pixels)'; 
$lang['Max_height'] = 'Hauteur maximale de l\'image (en pixels)'; 

$lang['JPG_allowed'] = 'Autoriser l\'upload de fichiers JPG'; 
$lang['PNG_allowed'] = 'Autoriser l\'upload de fichiers PNG'; 
$lang['GIF_allowed'] = 'Autoriser l\'upload de fichiers GIF'; 

$lang['Album_reached_quota'] = 'Ce système a atteint le quota de photos. Maintenant vous ne pouvez plus uploader. Veuillez contacter l\'administrateur pour plus d\'informations'; 
$lang['User_reached_pics_quota'] = 'Vous avez atteint votre quota de photos. Maintenant vous ne pouvez plus uploader. Veuillez contacter l\'administrateur pour plus d\'informations'; 

$lang['Bad_upload_file_size'] = 'Votre fichier uploadé est trop grand ou corrompu'; 
$lang['Not_allowed_file_type'] = 'Votre type de fichier n\'est pas autorisé'; 
$lang['Upload_image_size_too_big'] = 'La dimension de votre image est trop grande'; 
$lang['Upload_thumbnail_size_too_big'] = 'La dimension de votre miniature est trop grande'; 

$lang['Missed_pic_title'] = 'Vous devez entrer le titre de votre photo'; 

$lang['Album_upload_successful'] = 'Votre photo a été uploadée avec succès'; 
$lang['Album_upload_need_approval'] = 'Votre photo a été uploadée avec succès.<br /><br />Mais l\'option d\'Approbation des photos a été activée, ainsi votre photo doit être approuvée par l\'administrateur ou un modérateur avant d\'être postée'; 
$lang['Click_return_category'] = 'Cliquez %sici%s pour revenir à la catégorie'; 
$lang['Click_return_album_index'] = 'Cliquez %sici%s pour revenir à l\'index de l\'Album'; 

// View Pic 
$lang['Pic_not_exist'] = 'Cette photo n\'existe pas'; 

// Edit Pic 
$lang['Edit_Pic_Info'] = 'Editer les informations de la photo'; 
$lang['Pics_updated_successfully'] = 'Les informations de votre photo ont été mises à jour avec succès'; 

// Delete Pic 
$lang['Album_delete_confirm'] = 'Etes-vous sûr de vouloir supprimer cette photo ?'; 
$lang['Pics_deleted_successfully'] = 'Cette photo a été supprimée avec succès'; 

// 
// ModCP 
// 
$lang['Approval'] = 'Approbation'; 
$lang['Approve'] = 'Approuver'; 
$lang['Unapprove'] = 'Désapprouver'; 
$lang['Status'] = 'Statut'; 
$lang['Locked'] = 'Verrouiller'; 
$lang['Not_approved'] = 'Désapprouvé'; 
$lang['Approved'] = 'Approuvé'; 
$lang['Move_to_Category'] = 'Déplacer vers cette catégorie'; 
$lang['Pics_moved_successfully'] = 'Votre photo a été déplacée avec succès'; 
$lang['Pics_locked_successfully'] = 'Votre photo a été verrouillée avec succès'; 
$lang['Pics_unlocked_successfully'] = 'Votre photo a été déverrouillée avec succès'; 
$lang['Pics_approved_successfully'] = 'Votre photo a été approuvée avec succès'; 
$lang['Pics_unapproved_successfully'] = 'Votre photo a été désapprouvée avec succès'; 

// 
// Rate 
// 
$lang['Current_Rating'] = 'Note actuelle'; 
$lang['Please_Rate_It'] = 'Veuillez la noter'; 
$lang['Already_rated'] = 'Vous avez déjà noté cette photo'; 
$lang['Album_rate_successfully'] = 'La photo a été notée avec succès'; 

// 
// Comment 
// 
//$lang['Post_your_comment'] = 'Postez votre commentaire'; 
$lang['Comment_no_text'] = 'Veuillez entrer votre commentaire'; 
$lang['Comment_too_long'] = 'Votre commentaire est trop long'; 
$lang['Comment_delete_confirm'] = 'Etes-vous sûr de vouloir supprimer ce commentaire ?'; 
$lang['Pic_Locked'] = 'Désolé, mais cette photo a été verrouillée. Par conséquent, vous ne pouvez plus poster de commentaire pour cette photo'; 

// 
// Personal Gallery 
// 
$lang['Personal_Gallery_Explain'] = 'Vous pouvez voir les galeries personnelles des autres membres en cliquant sur le lien dans leur profil'; 
$lang['Personal_gallery_not_created'] = 'La galerie personnelle de %s est vide ou n\'a pas été créée'; 
$lang['Not_allowed_to_create_personal_gallery'] = 'Désolé, mais l\'administrateur de ce site ne vous a pas autorisé à créer votre galerie personnelle'; 
$lang['Click_return_personal_gallery'] = 'Cliquez %sici%s pour revenir à la galerie personnelle'; 

//
// Search
//
$lang['Search_for'] = 'Chercher le champ';
$lang['That_contains'] = 'contenant';
$lang['Name'] = 'Nom';
$lang['Image_description'] = 'Description';
$lang['Highest_rated'] = 'Photos les mieux notées';
$lang['Random_pic'] = 'Photos aléatoires';
$lang['Album_sub_categories'] = 'Sous-catégories de l\'album';
$lang['Pic_Category'] = 'Catégorie de la photo';
$lang['Search_found'] = 'La recherche a retourné';
$lang['Matches'] = 'correspondance(s)';
$lang['Posted_at'] = 'Posté à';
$lang['Submitted_by'] = 'Posté par';
$lang['Submitted_on'] = 'Posté le';
$lang['Click_pic'] = 'Cliquez sur l\'image pour la voir plus grande';

$lang['Last_Comments'] = 'Dernier commentaire';
$lang['No_Comment_Info'] = "Aucun commentaire";
$lang['Mod_CP'] = 'Album - Panneau de contrôle du modérateur';

$lang['Post_your_comment'] = 'Poster votre commentaire';
?>
