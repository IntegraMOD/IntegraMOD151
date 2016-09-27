<?php
/***************************************************************************
 *                            lang_main_attach.php [French]
 *                              -------------------
 *     begin                : Thu Feb 07 2002
 *     copyright            : (C) 2002 Meik Sievertsen
 *     email                : acyd.burn@gmx.de
 *     Translation          : Kooky < kooky06@free.fr >
 *
 *     $Id: lang_main_attach.php,v 1.27 2003/01/16 11:11:56 acydburn Exp $^_^
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
// Attachment Mod Main Language Variables
//

// Auth Related Entries
$lang['Rules_attach_can'] = 'Vous <b>pouvez</b> joindre des fichiers';
$lang['Rules_attach_cannot'] = 'Vous <b>ne pouvez pas</b> joindre des fichiers';
$lang['Rules_download_can'] = 'Vous <b>pouvez</b> télécharger des fichiers';
$lang['Rules_download_cannot'] = 'Vous <b>ne pouvez pas</b> télécharger des fichiers';
$lang['Sorry_auth_view_attach'] = 'Désolé, mais vous n\'êtes pas autorisé à voir ou télécharger ce fichier';

// Viewtopic -> Display of Attachments
$lang['Description'] = 'Description'; // used in Administration Panel too...
$lang['Downloaded'] = 'Téléchargé';
$lang['Download'] = 'Télécharger'; // this Language Variable is defined in lang_admin.php too, but we are unable to access it from the main Language File
$lang['Filesize'] = 'Taille du fichier';
$lang['Viewed'] = 'Vu';
$lang['Download_number'] = '%d fois'; // replace %d with count
$lang['Extension_disabled_after_posting'] = 'L\'extension \'%s\' a été désactivée par le webmaster, par conséquent ce fichier ne peut-être affiché.'; // used in Posts and PM's, replace %s with mime type

// Posting/PM -> Initial Display
$lang['Attach_posting_cp'] = 'Panneau de Contrôle des fichiers joints';
$lang['Attach_posting_cp_explain'] = 'Si vous cliquez sur <u>Joindre un fichier</u>, vous apercevrez une boîte de dialogue pour joindre des fichiers.<br />Si vous cliquez sur <u>Fichiers envoyés</u>, vous apercevrez une liste des fichiers déjà joints et vous pourrez les éditer.<br />Si vous souhaitez remplacer un fichier joint (<u>Envoyer une nouvelle version</u>), vous devrez cliquer sur ces deux liens. Joignez le fichier comme vous le feriez normalement, par la suite ne cliquez surtout pas sur <u>Joindre un fichier</u>, cliquez plutôt sur <u>Envoyer une nouvelle version</u> en face du fichier que vous souhaitez mettre à jour.';

// Posting/PM -> Posting Attachments
$lang['Add_attachment'] = 'Joindre un fichier';
$lang['Add_attachment_title'] = 'Joindre un fichier';
$lang['Add_attachment_explain'] = 'Si vous ne voulez pas joindre un fichier à votre message, laissez ces champs vides';
$lang['File_name'] = 'Nom du fichier';
$lang['File_comment'] = 'Commentaire';

// Posting/PM -> Posted Attachments
$lang['Posted_attachments'] = 'Fichiers envoyés';
$lang['Options'] = 'Options';
$lang['Update_comment'] = 'Mettre à jour le commentaire';
$lang['Delete_attachments'] = 'Supprimer les fichiers joints';
$lang['Delete_attachment'] = 'Supprimer le fichier joint';
$lang['Delete_thumbnail'] = 'Supprimer la miniature';
$lang['Upload_new_version'] = 'Envoyer une nouvelle version';

// Errors -> Posting Attachments
$lang['Invalid_filename'] = '%s est un nom de fichier non valable'; // replace %s with given filename
$lang['Attachment_php_size_na'] = 'Le fichier joint est trop gros.<br />Impossible d\'obtenir la taille maximale définie dans PHP.<br />Le MOD Attachement ne peut pas déterminer la taille maximale d\'Upload dans le fichier php.ini.';
$lang['Attachment_php_size_overrun'] = 'Le fichier joint est trop gros.<br />Taille maximale d\'Upload: %d Mo.<br />Veuillez noter que cette taille est définie dans le fichier php.ini, ce qui signifie qu\'elle est réglée par PHP et que le MOD Attachement ne peut pas modifier cette valeur.'; // replace %d with ini_get('upload_max_filesize')
$lang['Disallowed_extension'] = 'L\'extension %s n\'est pas autorisée'; // replace %s with extension (e.g. .php)
$lang['Disallowed_extension_within_forum'] = 'Vous n\'êtes pas autorisé à joindre des fichiers avec l\'extension %s dans ce forum'; // replace %s with the Extension
$lang['Attachment_too_big'] = 'Le fichier joint est trop gros.<br />Taille maximale: %d %s'; // replace %d with maximum file size, %s with size var
$lang['Attach_quota_reached'] = 'Désolé, mais la taille maximale de l\'ensemble des fichiers joints a été atteinte. Veuillez contacter le webmaster si vous avez des questions.';
$lang['Too_many_attachments'] = 'Ce fichier ne peut-être ajouté car le nombre maximum de %d fichiers joints dans ce message a été atteint'; // replace %d with maximum number of attachments
$lang['Error_imagesize'] = 'L\'image jointe doit-être inférieure à: %d x %d (largeur x Hauteur en pixels)';
$lang['General_upload_error'] = 'Erreur d\'Upload: impossible d\'envoyer le fichier joint vers %s.'; // replace %s with local path

$lang['Error_empty_add_attachbox'] = 'Vous devez entrer les valeurs dans le champ \'Joindre un fichier\'';
$lang['Error_missing_old_entry'] = 'Impossible de mettre à jour le fichier joint, l\'ancien fichier n\'a pas été trouvé';

// Errors -> PM Related
$lang['Attach_quota_sender_pm_reached'] = 'Désolé, mais la taille maximale pour l\'ensemble des fichiers joints dans votre Boîte des Messages Privés a été atteinte. Veuillez supprimer quelques-uns de vos fichiers reçus ou envoyés.';
$lang['Attach_quota_receiver_pm_reached'] = 'Désolé, mais la taille maximale pour l\'ensemble des fichiers joints dans la Boîte des Messages Privés de \'%s\' a été atteinte. Veuillez le-lui faire savoir, ou attendez jusqu\'à ce qu\'il/elle ait supprimé quelques-uns de ses fichiers joints.';

// Errors -> Download
$lang['No_attachment_selected'] = 'Vous n\'avez pas sélectionné un fichier joint à télécharger ou à visualiser.';
$lang['Error_no_attachment'] = 'Le fichier joint sélectionné n\'existe plus';

// Delete Attachments
$lang['Confirm_delete_attachments'] = 'Etes vous sûr de vouloir supprimer les fichiers sélectionnés ?';
$lang['Deleted_attachments'] = 'Les fichiers sélectionnés ont été supprimés.';
$lang['Error_deleted_attachments'] = 'Impossible de supprimer les fichiers.';
$lang['Confirm_delete_pm_attachments'] = 'Etes vous sûr de vouloir supprimer tous les fichiers joints dans ce Message Privé ?';

// General Error Messages
$lang['Attachment_feature_disabled'] = 'La fonction fichier joint est désactivée.';

$lang['Directory_does_not_exist'] = 'Le répertoire \'%s\' n\'existe pas ou ne peut pas être trouvé.'; // replace %s with directory
$lang['Directory_is_not_a_dir'] = 'Veuillez vérifier si \'%s\' est un répertoire.'; // replace %s with directory
$lang['Directory_not_writeable'] = 'Le répertoire \'%s\' n\'est pas inscriptible. Vous devez créer le chemin d\'envoi et changer ses droits d\'accès en écriture CHMOD 777 (ou changez les propriétés de votre serveur httpd sur tous) pour envoyer des fichiers.<br />Si vous avez uniquement accès par FTP, changez les \'attributs\' du répertoire en rwxrwxrwx.'; // replace %s with directory

$lang['Ftp_error_connect'] = 'Impossible de se connecter au serveur FTP: \'%s\'. Veuillez vérifier vos paramètres FTP.';
$lang['Ftp_error_login'] = 'Impossible de se connecter au serveur FTP. Le nom d\'utilisateur \'%s\' ou le mot de passe est incorrect. Veuillez vérifier vos paramètres FTP.';
$lang['Ftp_error_path'] = 'Impossible d\'accéder au répertoire du FTP: \'%s\'. Veuillez vérifier vos paramètres FTP.';
$lang['Ftp_error_upload'] = 'Impossible d\'envoyer des fichiers vers le répertoire du FTP: \'%s\'. Veuillez vérifier vos paramètres FTP.';
$lang['Ftp_error_delete'] = 'Impossible de supprimer les fichers du répertoire FTP: \'%s\'. Veuillez vérifier vos paramètres FTP.<br />Une autre raison pour cette erreur pourrait-être la non existence du fichier joint, veuillez vérifier d\'abord dans les fichiers joints perdus.';
$lang['Ftp_error_pasv_mode'] = 'Impossible d\'activer/désactiver le mode passif du FTP';

// Attach Rules Window
$lang['Rules_page'] = 'Règles des fichiers joints';
$lang['Attach_rules_title'] = 'Groupes d\'extensions autorisés et leur taille';
$lang['Group_rule_header'] = '%s » Taille maximale d\'un envoi: %s'; // Replace first %s with Extension Group, second one with the Size STRING
$lang['Allowed_extensions_and_sizes'] = 'Extensions et tailles autorisées';
$lang['Note_user_empty_group_permissions'] = 'NOTE:<br />Normalement, vous êtes autorisé à joindre des fichiers dans ce forum, <br />mais tant qu\'aucun groupe d\'extensions n\'est autorisé à être joint ici, <br />vous ne pouvez joindre aucun fichier. Si vous essayez, <br />vous aurez un message d\'erreur.<br />';

// Quota Variables
$lang['Upload_quota'] = 'Quota d\'Upload';
$lang['Pm_quota'] = 'Quota des MP';
$lang['User_upload_quota_reached'] = 'Désolé, mais vous avez atteint votre limite maximale de quota d\'Upload de %d %s'; // replace %d with Size, %s with Size Lang (MB for example)

// User Attachment Control Panel
$lang['User_acp_title'] = 'PCA utilisateur';
$lang['UACP'] = 'Panneau de Contrôle des Attachements de l\'utilisateur';
$lang['User_uploaded_profile'] = 'Uploadé: %s';
$lang['User_quota_profile'] = 'Quota: %s';
$lang['Upload_percent_profile'] = '%d%% du total';

// Common Variables
$lang['Bytes'] = 'Octets';
$lang['KB'] = 'Ko';
$lang['MB'] = 'Mo';
$lang['Attach_search_query'] = 'Rechercher des fichiers joints';
$lang['Test_settings'] = 'Tester les Options';
$lang['Not_assigned'] = 'Non Assigné';
$lang['No_file_comment_available'] = 'Aucun commentaire disponible';
$lang['Attachbox_limit'] = 'Votre Boîte d\'Attache est pleine à %d%%';
$lang['No_quota_limit'] = 'Aucune limite de quotas';
$lang['Unlimited'] = 'Illimité';

?>