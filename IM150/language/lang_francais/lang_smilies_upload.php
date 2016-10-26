<?php
/***************************************************************************
 *                        lang_smilies_upload.php [French]
 *                            -------------------
 *   begin                : 12/06/2004
 *   version              : 1.1.0
 ***************************************************************************/

//
// CONTRIBUTORS:
//	 Add your details here if wanted, e.g. Name, username, email address, website
//	 The greatest emperor of the rabbits - Lapinouland

//
// The format of this file is ---> $lang['message'] = 'text';
//
// This is optional, if you would like a _SHORT_ message output
// along with our copyright message indicating you are the translator
// please add it here.
// $lang['TRANSLATION'] .= '';

if ( defined('IN_SMILIESUPLOAD_LANG') )
{
	return;
}
define('IN_SMILIESUPLOAD_LANG', true);

$lang['Upload_Smilies'] = 'Envoi de Smilies';
$lang['SU_Upload_Smilies'] = 'Envoi de Smilies';
$lang['SU_Upload_Explain'] = 'Vous pouvez utiliser ceci pour envoyer de petites images faisant office de Smilies (émoticônes). Une seule image à la fois peut être uploadée, et sa taille ne doit pas être supérieure à %s Kilooctets. Les dimensions maximales sont %s pour la largeur et %s pour la hauteur.';
$lang['SU_File'] = 'Envoyer une image depuis votre ordinateur';
$lang['SU_Sorry'] = 'Désolé, vous ne pouvez pas uploader de fichiers.';
$lang['SU_Upload_Name'] = 'Nom du fichier envoyé';
$lang['SU_Default_Name'] = 'Utiliser le nom original du fichier';
$lang['SU_Name_Explain'] = 'Spécifie un nom pour le fichier envoyé. N\'incluez pas l\'extension du fichier (par exemple, utilisez "icone" au lieu "icone.gif").';
$lang['SU_Upload_Succesful'] = 'Fichier envoyé avec succès';
$lang['SU_Upload_Failed'] = 'Echec de l\'upload du fichier. Vérifiez que le répertoire de destination des Smilies possède les permissions requises.';
$lang['SU_Auto_Add'] = 'Ajouter automatiquement aux Smilies du forum';
$lang['SU_Add_Successful'] = 'Ajouté dans la table des Smilies de la base de données avec succès.';
$lang['SU_Add_Failed'] = 'Impossible d\'ajouter à la table des Smilies de la base de données.';
$lang['SU_filetype'] = 'Seules les extensions JPEG, GIF ou PNG sont autorisées.';
$lang['SU_filesize'] = 'Seuls les fichiers d\'une taille inférieure à %s Ko peuvent être uploadés.';
$lang['SU_File_Already'] = 'Un fichier avec ce nom existe déjà dans le répertoire des Smilies.';
$lang['SU_CC_Fail'] = 'Impossible de vérifier le code des Smilies existants.';
$lang['SU_CC_Found'] = 'Il existe déjà un Smilie avec ce code.';
$lang['SU_Filename_failed'] = 'Impossible de déterminer un nouveau fichier.';
$lang['SU_open_basedir'] = 'Votre version de PHP n\'autorise pas la fonction move_uploaded_file.';
$lang['SU_Uploaded'] = 'Images de Smilies uploadées';
$lang['SU_Sorry_None'] = 'Vous n\'avez aucune image de Smilies uploadée.';
$lang['SU_Delete_Successful'] = 'Le fichier %s a été supprimé!';
$lang['SU_Delete_Failed'] = 'Vous ne pouvez pas effacer le fichier %s!';
$lang['SU_Select_file'] = 'Veuillez sélectionner un fichier à uploader.';
$lang['SU_CD_Fail'] = 'Impossible d\'effacer la moindre entrée dans la base de données.';
$lang['SU_CD_Successful'] = 'Effacer les entrées dans la base de données des Smilies.';
$lang['SU_Width_height'] = 'Ce fichier dépasse les dimensions maximales autorisées. Les images doivent avoir une largeur inférieure à %s et une hauteur inférieure à %s.';
$lang['SU_No_Name'] = 'Vous n\'avez pas spécifié de nom pour le fichier uploadé.';

?>