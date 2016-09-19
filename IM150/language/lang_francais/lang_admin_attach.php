<?php
/***************************************************************************
 *                            lang_admin_attach.php [French]
 *                              -------------------
 *     begin                : Thu Feb 07 2002
 *     copyright            : (C) 2002 Meik Sievertsen
 *     email                : acyd.burn@gmx.de
 *     Translation          : Kooky < kooky06@free.fr >
 *
 *     $Id: lang_admin_attach.php,v 1.36 2003/08/30 15:47:39 acydburn Exp $^_^
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
// Attachment Mod Admin Language Variables
//

// Modules, this replaces the keys used
/*$lang['Control_Panel'] = 'Panneau de Contrôle';
$lang['Shadow_attachments'] = 'Fichiers joints perdus';
$lang['Forbidden_extensions'] = 'Extensions interdites';
$lang['Extension_control'] = 'Extensions';
$lang['Extension_group_manage'] = 'Groupes d\'extensions';
$lang['Special_categories'] = 'Catégories spéciales';
$lang['Sync_attachments'] = 'Synchroniser les fichiers joints';
$lang['Quota_limits'] = 'Limites des Quotas';
*/
// Attachments -> Management
$lang['Attach_settings'] = 'Configuration des fichiers joints';
$lang['Manage_attachments_explain'] = 'Ici, vous pouvez configurer les options principales pour le Mod Attachement. Si vous cliquez sur le bouton <u>Tester les Options</u>, le Mod Attachement effectuera quelques tests du système pour être sûr que le Mod fonctionnera correctement. Si vous rencontrez des problèmes en uploadant des fichiers, veuillez utiliser ce test pour obtenir un message d\'erreur plus détaillé.';
$lang['Attach_filesize_settings'] = 'Configuration de la taille des fichiers joints';
$lang['Attach_number_settings'] = 'Configuration du nombre de fichiers joints';
$lang['Attach_options_settings'] = 'Options des fichiers joints';

$lang['Upload_directory'] = 'Répertoire d\'Upload';
$lang['Upload_directory_explain'] = 'Entrez le chemin relatif à votre répertoire d\'installation de phpBB2 vers le répertoire d\'upload des fichiers joints. Par exemple, entrez \'files\' si votre répertoire d\'installation de phpBB2 est situé à http://www.votredomaine.com/phpBB2 et que le répertoire d\'upload des fichiers joints est situé à http://www.votredomaine.com/phpBB2/files.';
$lang['Attach_img_path'] = 'Icône d\'un message avec un fichier joint';
$lang['Attach_img_path_explain'] = 'Cette image est affichée à la suite du lien du fichier joint dans un message individuel. Laissez ce champ vide si vous ne souhaitez pas qu\'une icône soit affichée. Cette option sera remplacée par les options dans la gestion des groupes d\'extensions.';
$lang['Attach_topic_icon'] = 'Icône d\'un sujet avec un fichier joint';
$lang['Attach_topic_icon_explain'] = 'Cette image est affichée avant le titre des sujets dans lesquels sont joints des fichiers. Laissez ce champ vide si vous ne souhaitez pas qu\'une icône soit affichée.';
$lang['Attach_display_order'] = 'Ordre d\'affichage des fichiers joints';
$lang['Attach_display_order_explain'] = 'Ici, vous pouvez choisir si les fichiers joints dans des messages et messages privés seront affichés suivant la date du fichier par ordre décroissant (nouveau fichier en premier) ou par ordre croissant (plus ancien fichier en premier).';
$lang['Show_apcp'] = 'Afficher le nouveau Panneau de Contrôle des fichiers joints';
$lang['Show_apcp_explain'] = 'Choisissez si vous souhaitez afficher le nouveau panneau de contrôle des fichiers joints (Oui) ou l\'ancienne méthode avec les deux boîtes de dialogue pour joindre des fichiers et les éditer (Non) à partir de votre formulaire de rédaction du message. La visualisation de ceci étant très dur à expliquer, par conséquent le mieux est de l\'essayer par vous même.';

$lang['Max_filesize_attach'] = 'Taille d\'un fichier';
$lang['Max_filesize_attach_explain'] = 'Taille maximale pour les fichiers joints (en octets). Une valeur de 0 signifie \'illimitée\'. Cette option est restreinte par la configuration de votre serveur. Par exemple, si votre configuration de PHP autorise seulement un maximum de 2 Mo en upload, ceci ne pourra pas être remplacé par le Mod.';
$lang['Attach_quota'] = 'Quota des fichiers joints';
$lang['Attach_quota_explain'] = 'Espace disque maximum pour TOUS les fichiers pouvant être joints sur votre serveur. Une valeur de 0 signifie \'illimitée\'.';
$lang['Max_filesize_pm'] = 'Taille maximale des fichiers dans la Boîte des Messages Privés';
$lang['Max_filesize_pm_explain'] = 'Espace disque maximum des fichiers pouvant être utilisés pour la Boîte des Messages Privés de chaque utilisateur. Une valeur de 0 signifie \'illimitée\'.';
$lang['Default_quota_limit'] = 'Limite des Quotas par défaut';
$lang['Default_quota_limit_explain'] = 'Ici, vous êtes autorisé à sélectionner la limite des Quotas par défaut assignée automatiquement aux nouveaux utilisateurs enregistrés et aux utilisateurs n\'ayant pas de limite de Quota définie. L\'option \'Aucune limite de Quota\' permet de ne pas utiliser les quotas des fichiers joints, au lieu d\'utiliser l\'option par défaut vous pouvez la définir dans ce panneau de gestion.';

$lang['Max_attachments'] = 'Nombre maximum de fichiers joints';
$lang['Max_attachments_explain'] = 'Nombre maximum de fichiers joints autorisé dans un message.';
$lang['Max_attachments_pm'] = 'Définir le nombre maximum de fichiers joints dans un Message Privé';
$lang['Max_attachments_pm_explain'] = 'Défini le nombre maximum de fichiers joints qu\'un utilisateur est autorisé à inclure dans un message privé.';

$lang['Disable_mod'] = 'Désactiver le Mod Attachement';
$lang['Disable_mod_explain'] = 'Cette option est essentiellement faite pour effectuer des tests avec de nouveaux templates ou thèmes, cela désactive toutes les fonctions des fichiers joints à l\'exception du Panneau d\'Administration.';
$lang['PM_Attachments'] = 'Autoriser les fichiers joints dans les Messages Privés';
$lang['PM_Attachments_explain'] = 'Autoriser/Interdire les fichiers joints dans les Messages Privés.';
$lang['Ftp_upload'] = 'Activer l\'Upload par FTP';
$lang['Ftp_upload_explain'] = 'Activer/Désactiver l\'option d\'upload par FTP. Si vous l\'activez (Oui), vous devez définir les paramètres du FTP et le répertoire d\'upload qui sera utilisé pour les fichiers joints.';
$lang['Attachment_topic_review'] = 'Souhaitez-vous afficher les fichiers joints dans la Prévisualisation  du message ?';
$lang['Attachment_topic_review_explain'] = 'Si vous choisissez Oui, tous les fichiers joints seront affichés dans la Prévisualisation du message lorsque vous posterez une réponse.';

$lang['Ftp_server'] = 'Serveur FTP d\'Upload';
$lang['Ftp_server_explain'] = 'Ici, vous pouvez entrer l\'adresse IP ou le nom de domaine du FTP du serveur utilisé pour uploader vos fichiers. Si vous laissez ce champ vide, le serveur sur lequel votre forum phpBB2 est installé sera utilisé. Veuillez noter qu\'il n\'est pas autorisé d\'ajouter ftp:// ou quelque chose de similaire à votre adresse, uniquement ftp.foo.com ou quelque chose de plus rapide, comme l\'adresse IP complète.';

$lang['Attach_ftp_path'] = 'Chemin de votre répertoire d\'upload du FTP';
$lang['Attach_ftp_path_explain'] = 'Répertoire où vos fichiers joints seront conservés. Ce répertoire n\'a pas besoin de permissions (CHMOD). Veuillez ne pas entrer votre adresse IP ou une adresse FTP ici, ce champ est uniquement pour le chemin vers le FTP.<br />Par exemple: /home/web/uploads';
$lang['Ftp_download_path'] = 'Chemin du FTP pour le téléchargement';
$lang['Ftp_download_path_explain'] = 'Entrez le chemin relatif à votre FTP, où vos fichiers joints sont conservés.<br />Si vous utilisez un serveur FTP distant, veuillez entrer l\'url complète, par exemple http://www.monstockage.com/phpBB2/upload.<br />Si vous utilisez votre hébergement local pour sauvegarder vos fichiers, vous pouvez entrer le chemin relatif vers votre répertoire phpBB2, par exemple \'upload\'.<br />Un slash inversé sera supprimé. Laissez ce champ vide, si le chemin du FTP n\'est pas accessible à partir d\'Internet. En laissant ce champ vide vous ne pourrez pas utiliser la méthode de téléchargement physique.';
$lang['Ftp_passive_mode'] = 'Activer le Mode passif du FTP';
$lang['Ftp_passive_mode_explain'] = 'La commande PASV requiert que le serveur distant ouvre un port pour la connexion des informations et renvoie l\'adresse de ce port. Le serveur distant tient compte de ce port pour que le client se connecte à lui.';

$lang['No_ftp_extensions_installed'] = 'Vous ne pouvez pas utiliser la méthode d\'upload par FTP, car les extensions FTP ne sont pas compilées dans votre installation de PHP.';

// Attachments -> Shadow Attachments
$lang['Shadow_attachments_explain'] = 'Ici, vous pouvez supprimer les informations des fichiers liés à des messages lorsque les fichiers ont disparu de votre serveur, et supprimer les fichiers qui ne sont plus liés à des messages. Vous pouvez télécharger ou voir un fichier en cliquant dessus; s\'il n\'y a aucun lien présent, le fichier n\'existe plus.';
$lang['Shadow_attachments_file_explain'] = 'Supprimer tous les fichiers joints existant sur votre serveur et qui ne sont plus liés à un message existant.';
$lang['Shadow_attachments_row_explain'] = 'Supprimer toutes les informations concernant les fichiers joints n\'existant plus sur votre serveur.';
$lang['Empty_file_entry'] = 'Entrée du fichier vide';

// Attachments -> Sync
$lang['Sync_thumbnail_resetted'] = 'Miniature réinitialisée pour le fichier joint: %s'; // replace %s with physical Filename
$lang['Attach_sync_finished'] = 'Synchronisation des fichiers joints terminée.';

// Extensions -> Extension Control
$lang['Manage_extensions'] = 'Gestion des extensions';
$lang['Manage_extensions_explain'] = 'Ici, vous pouvez gérer les extensions de vos fichiers. Si vous souhaitez autoriser/interdire l\'upload d\'une extension, veuillez utiliser la gestion des groupes d\'extensions.';
$lang['Explanation'] = 'Explication';
$lang['Extension_group'] = 'Groupe d\'extensions';
$lang['Invalid_extension'] = 'Extension invalide';
$lang['Extension_exist'] = 'L\'extension %s existe déjà'; // replace %s with the Extension
$lang['Unable_add_forbidden_extension'] = 'L\'Extension %s est interdite, vous ne pouvez pas l\'ajouter aux extensions autorisées'; // replace %s with Extension

// Extensions -> Extension Groups Management
$lang['Manage_extension_groups'] = 'Gestion des Groupes d\'extensions';
$lang['Manage_extension_groups_explain'] = 'Ici, vous pouvez ajouter, supprimer et modifier vos groupes d\'extensions, vous pouvez désactiver les groupes d\'extensions, leurs assigner une catégorie spéciale, modifier le mécanisme de téléchargement et vous pouvez définir une icône d\'Upload qui sera affichée en face d\'un fichier joint appartenant à ce groupe.';
$lang['Special_category'] = 'Catégorie Spéciale';
$lang['Category_images'] = 'Images';
$lang['Category_stream_files'] = 'Fichiers Stream';
$lang['Category_swf_files'] = 'Fichiers Flash';
$lang['Allowed'] = 'Autorisé';
$lang['Allowed_forums'] = 'Forums autorisés';
$lang['Ext_group_permissions'] = 'Permissions du groupe';
$lang['Download_mode'] = 'Mode de téléchargement';
$lang['Upload_icon'] = 'Icône d\'Upload';
$lang['Max_groups_filesize'] = 'Taille maximale';
$lang['Extension_group_exist'] = 'Le groupe d\'extensions %s existe déjà'; // replace %s with the group name
$lang['Collapse'] = '+';
$lang['Decollapse'] = '-';

// Extensions -> Special Categories
$lang['Manage_categories'] = 'Gestion des Catégories Spéciales';
$lang['Manage_categories_explain'] = 'Ici, vous pouvez configurer les catégories spéciales. Vous pouvez organiser les paramètres spéciaux et les conditions pour les catégories spéciales assignées à un groupe d\'extensions.';
$lang['Settings_cat_images'] = 'Configurations pour la catégorie spéciale: Images';
$lang['Settings_cat_streams'] = 'Configurations pour la catégorie spéciale: Fichiers Stream';
$lang['Settings_cat_flash'] = 'Configurations pour la catégorie spéciale: Fichiers Flash';
$lang['Display_inlined'] = 'Afficher les images dans le message';
$lang['Display_inlined_explain'] = 'Choisissez si les images doivent être affichées directement dans le message (Oui) ou affichées comme un lien (Non) ?';
$lang['Max_image_size'] = 'Dimensions maximales de l\'image';
$lang['Max_image_size_explain'] = 'Ici, vous pouvez définir la dimension maximale autorisée pour les images jointes (largeur x Hauteur en pixels).<br />Si elle est mise sur 0x0, cette option sera désactivée. Avec certaines images, cette option ne fonctionnera pas à cause de limitations dans PHP.';
$lang['Image_link_size'] = 'Dimensions de l\'image affichée avec un lien';
$lang['Image_link_size_explain'] = 'Si la dimension d\'une image définie est atteinte, l\'image sera affichée comme un lien, plutôt que de l\'afficher dans un message,<br />si \'Afficher l\'image dans le message\' est activé (largeur x Hauteur en pixels).<br />Si elle est mise sur 0x0, cette option sera désactivée. Avec certaines images, cette option ne fonctionnera pas à cause de limitations dans PHP.';
$lang['Assigned_group'] = 'Groupe Assigné';

$lang['Image_create_thumbnail'] = 'Créer une miniature';
$lang['Image_create_thumbnail_explain'] = 'Toujours créer une miniature. Cette option passe outre presque toutes les configurations des catégories spéciales, à l\'exception des dimensions maximales d\'une image. Avec cette option une miniature sera affichée dans le message, l\'utiliateur pourra cliquer dessus pour ouvrir l\'image réelle.<br />Veuillez noter que cette option requiert que ImageMagick soit installé, s\'il n\'est pas installé ou si le Safe-Mode est activé, l\'extension GD de PHP sera utilisée. Si le type d\'image n\'est pas supporté par PHP, cette option ne sera pas utilisée.';
$lang['Image_min_thumb_filesize'] = 'Taille minimale d\'une miniature';
$lang['Image_min_thumb_filesize_explain'] = 'Si une image est plus petite que la taille définie, aucune miniature ne sera créée, car elle sera trop petite.';
$lang['Image_imagick_path'] = 'Programme ImageMagick (chemin complet)';
$lang['Image_imagick_path_explain'] = 'Entrez le chemin vers le programme ImageMagick, normalement /usr/bin/convert (dans windows C:/imagemagick/convert.exe).';
$lang['Image_search_imagick'] = 'Rechercher ImageMagick';

$lang['Use_gd2'] = 'Utiliser la librairie GD2';
$lang['Use_gd2_explain'] = 'PHP est autorisé à compiler les images avec les librairies GD1 ou GD2. Pour créer correctement des miniatures sans ImageMagick, le Mod Attachement utilise 2 méthodes différentes basées sur votre choix ici. Si vos miniatures ont une mauvaise qualité ou sont déformées, essayez de changer cette option.';
$lang['Attachment_version'] = 'Attachment Mod Version %s'; // %s is the version number

// Extensions -> Forbidden Extensions
$lang['Manage_forbidden_extensions'] = 'Gestion des extensions interdites';
$lang['Manage_forbidden_extensions_explain'] = 'Ici, vous pouvez ajouter ou supprimer les extensions interdites. Les extensions php, php3 et php4 sont interdites par défaut pour des raisons de sécurité, vous ne pouvez pas les supprimer.';
$lang['Forbidden_extension_exist'] = 'L\'extension interdite %s existe déjà'; // replace %s with the extension
$lang['Extension_exist_forbidden'] = 'L\'extension %s est définie dans vos extensions autorisées, veuillez la supprimer ensuite vous pourrez l\'ajouter ici.';  // replace %s with the extension

// Extensions -> Extension Groups Control -> Group Permissions
$lang['Group_permissions_title'] = 'Permissions du groupe d\'extensions -> \'%s\''; // Replace %s with the Groups Name
$lang['Group_permissions_explain'] = 'Ici, vous pouvez restreindre le groupe d\'extensions sélectionné à des forums de votre choix (défini dans la boîte de dialogue des forums autorisés). Par défaut les groupes d\'extensions sont autorisés sur tous les forums où l\'utilisateur peut joindre des fichiers (de la même façon que le Mod Attachement a fonctionné depuis le début). Ajoutez uniquement les forums où vous souhaitez autoriser le groupe d\'extensions (les extensions comprises par ce groupe), l\'option par défaut TOUS LES FORUMS disparaîtra lorsque vous ajouterez des forums à la liste. Vous pourrez revenir à l\'option TOUS LES FORUMS à n\'importe quel moment donné. Si vous ajoutez un forum à votre site et que les permissions sont réglées sur TOUS LES FORUMS rien ne sera changé. Mais si vous modifiez et limitez l\'accès à certains forums, vous devrez revenir ici afin d\'ajouter votre nouveau forum créé. Cela serait facile de le faire automatiquement, mais cela vous obligerait à éditer un grand nombre de fichiers, c\'est pourquoi cette méthode a été choisie. Veuillez garder à l\'esprit que tous vos forums seront listés ici.';
$lang['Note_admin_empty_group_permissions'] = 'NOTE:<br />Avec la liste des forums ci-dessous vos utilisateurs peuvent joindre normalement des fichiers, mans tant qu\'aucun groupe d\'extensions n\'est autorisé à être joint ici, vos utilisateurs ne pourront joindre aucun fichier. S\'ils essaient, ils auront un message d\'erreur. Peut-être que vous souhaitez régler la permission de \'Joindre des fichiers\' sur ADMIN pour ces forums.<br /><br />';
$lang['Add_forums'] = 'Ajouter les forums';
$lang['Add_selected'] = 'Ajouter la sélection';
$lang['Perm_all_forums'] = 'TOUS LES FORUMS';

// Attachments -> Quota Limits
$lang['Manage_quotas'] = 'Gérer les limites de Quotas des fichiers joints';
$lang['Manage_quotas_explain'] = 'Ici, vous pouvez ajouter/supprimer/modifier les limites de Quotas. Vous pourrez assigner ces limites de quotas à des utilisateurs et des groupes par la suite. Pour assigner une limite de Quota à un utilisateur, vous devez aller dans le panneau de gestion des utilisateurs, sélectionnez l\'utilisateur et vous verrez les options en bas de page. Pour assigner une limite de Quota à un groupe, allez dans le panneau de gestion des groupes, sélectionnez le groupe à éditer, et vous verrez les options de configuration. Si vous souhaiter voir quels sont les utilisateurs et groupes assignés à une limite spécifique de Quota, cliquez sur \'Voir\' à gauche de la description du Quota.';
$lang['Assigned_users'] = 'Utilisateurs assignés';
$lang['Assigned_groups'] = 'Groupes assignés';
$lang['Quota_limit_exist'] = 'La limite de Quota %s existe déjà.'; // Replace %s with the Quota Description

// Attachments -> Control Panel
$lang['Control_panel_title'] = 'Panneau de Contrôle des fichiers joints';
$lang['Control_panel_explain'] = 'Ici, vous pouvez voir et gérer tous les fichiers joints en fonction des utilisateurs, fichiers joints, téléchargements, etc...';
$lang['File_comment_cp'] = 'Commentaire';

// Control Panel -> Search
$lang['Search_wildcard_explain'] = 'Utilisez * comme un joker pour des recherches partielles';
$lang['Size_smaller_than'] = 'Taille du fichier joint inférieure à (en octets)';
$lang['Size_greater_than'] = 'Taille du fichier joint supérieure à (en octets)';
$lang['Count_smaller_than'] = 'Nombre de téléchargements inférieur à';
$lang['Count_greater_than'] = 'Nombre de téléchargements supérieur à';
$lang['More_days_old'] = 'Ancien de plus de (en jours)';
$lang['No_attach_search_match'] = 'Aucun fichier joint ne correspond à vos critères de recherche';

// Control Panel -> Statistics
$lang['Number_of_attachments'] = 'Nombre de fichiers joints';
$lang['Total_filesize'] = 'Taille totale des fichiers joints';
$lang['Number_posts_attach'] = 'Nombre de messages avec des fichiers joints';
$lang['Number_topics_attach'] = 'Nombre de sujets avec des fichiers joints';
$lang['Number_users_attach'] = 'Nombre d\'utilisateurs ayant joint des fichiers';
$lang['Number_pms_attach'] = 'Nombre total de fichiers joints dans les Messages Privés';

// Control Panel -> Attachments
$lang['Statistics_for_user'] = 'Statistiques des fichiers joints pour %s'; // replace %s with username
$lang['Size_in_kb'] = 'Taille (Ko)';
$lang['Downloads'] = 'Téléchargements';
$lang['Post_time'] = 'Date';
$lang['Posted_in_topic'] = 'Sujet';
$lang['Submit_changes'] = 'Envoyer';

// Sort Types
$lang['Sort_Attachments'] = 'Fichiers joints';
$lang['Sort_Size'] = 'Taille';
$lang['Sort_Filename'] = 'Nom du fichier';
$lang['Sort_Comment'] = 'Commentaire';
$lang['Sort_Extension'] = 'Extension';
$lang['Sort_Downloads'] = 'Téléchargements';
$lang['Sort_Posttime'] = 'Date';
$lang['Sort_Posts'] = 'Messages';

// View Types
$lang['View_Statistic'] = 'Statistiques';
$lang['View_Search'] = 'Rechercher';
$lang['View_Username'] = 'Nom d\'utilisateur';
$lang['View_Attachments'] = 'Fichiers joints';

// Successfully updated
$lang['Attach_config_updated'] = 'La configuration des fichiers joints a été mise à jour avec succès';
$lang['Click_return_attach_config'] = 'Cliquez %sici%s pour revenir à la configuration des fichiers joints';
$lang['Test_settings_successful'] = 'Tests des options terminées, la configuration semble être correcte.';

// Some basic definitions
$lang['Attachments'] = 'Fichiers joints';
$lang['Attachment'] = 'Fichier joint';
$lang['Extensions'] = 'Extensions';
$lang['Extension'] = 'Extension';

// Auth pages
$lang['Auth_attach'] = 'Joindre';
$lang['Auth_download'] = 'Télécharger';

?>
