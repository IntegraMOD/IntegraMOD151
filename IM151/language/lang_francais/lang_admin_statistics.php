<?php
/***************************************************************************
 *                            lang_admin_statistics.php [English]
 *                              -------------------
 *     begin                : Fri Jan 24 2003
 *     copyright            : (C) 2003 Meik Sievertsen
 *     email                : acyd.burn@gmx.de
 *
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

$lang['LEFT_Package_Module'] = 'Ensemble des modules';
$lang['Install_module'] = 'Installer un module';
$lang['Manage_modules'] = 'Gestion des modules';
$lang['Stats_configuration'] = 'Configuration';
$lang['Edit_module'] = 'Editer un module';
$lang['Stats_langcp'] = 'Gestion des langages';

// Package Module
$lang['Package_module'] = 'Ensemble des modules';
$lang['Package_module_explain'] = 'Ici, vous pouvez combiner vos fichiers de 3 modules en un pack de module de distribution.';
$lang['Select_info_file'] = 'Sélectionner un fichier information';
$lang['Select_lang_file'] = 'Sélectionner un fichier de langue';
$lang['Select_module_file'] = 'Sélectionner le fichier php d\'un module';
$lang['Package_name'] = 'Nom du pack';
$lang['Create'] = 'Créer';

// Install Module
$lang['Install_module_explain'] = 'Ici, vous pouvez installer un nouveau module. Vous pouvez faire cela de deux façons. La première consiste à uploader votre pack de module avec le formulaire fourni ci-dessous. Si l\'upload ne fonctionne pas, vous pouvez uploader le pack de module vers votre répertoire ./modules/pakfiles, il sera affiché automatiquement ici. Pour plus d\'informations sur l\'installation d\'un pack de module, vous pouvez regarder la documentation incluse.<br />Après avoir choisi d\'installer un pack de module, vous serez guidé vers certaines informations concernant le module que vous avez choisi. Veuillez vous assurer que les informations sont correctes et que vous remplissez les conditions minimum (par exemple, la bonne version du Mod Statistiques). Vous pouvez aussi choisir le langage que vous souhaitez installer avec. Après avoir tout vérifié et que vous êtes prêt à l\'installer, cliquez sur le bouton \'Installation\'.<br />L\'installation par défaut laisse le module désactivé, vous devez l\'activer pour qu\'il soit affiché sur la page de statistiques.';
$lang['Select_module_pak'] = 'Sélectionner un pack de module';
$lang['Upload_module_pak'] = 'Uploader un pack de module';
$lang['Inst_module_already_exist'] = 'Le module \'%s\' existe déjà.<br />Si vous souhaitez mettre à jour ce module, vous devez aller dans la gestion des modules et le mettre à jour.<br />Si vous souhaitez le réinstaller complètement, vous devez d\'abord désinstaller l\'ancien.';
$lang['Incorrect_update_module'] = 'Le pack sélectionné n\'est pas une mise à jour du module sélectionné. Veuillez vous assurer que vous avez sélectionné le bon pack.';

$lang['Module_name'] = 'Nom du module';
$lang['Module_description'] = 'Description du module';
$lang['Module_version'] = 'Version du module';
$lang['Required_stats_version'] = 'Version minimum du Mod Statistiques requise';
$lang['Installed_stats_version'] = 'Version du Mod Statistiques installée';
$lang['Module_author'] = 'Auteur du module';
$lang['Author_email'] = 'Email de l\'auteur';
$lang['Module_url'] = 'Site web du module/auteur';
$lang['Update_url'] = 'Site web des mises à jour du module (vérifiez les dernières mises à jour)';
$lang['Provided_language'] = 'Langage disponible';
$lang['Install_language'] = 'Langage à installer';
$lang['Module_installed'] = 'Ce module a été installé avec succès.';
$lang['Module_updated'] = 'Ce module a été mis à jour avec succès.';

// Manage Modules
$lang['Manage_modules_explain'] = 'Ici, vous pouvez gérer vos modules. Vous pouvez les éditer, les supprimer, modifier l\'ordre, les activer et les désactiver. Si vous souhaitez configurer votre module (choisir les permissions, éditer les variables de langue, etc...), vous devez l\'éditer.<br />Si vous cliquez sur le nom d\'un module, vous apercevrez une prévisualisation de ce module.';
$lang['Deactivate'] = 'Désactiver';
$lang['Activate'] = 'Activer';

// Delete Module
$lang['Confirm_delete_module'] = 'Etes-vous sûr de vouloir supprimer ce module ?';

// Configuration
$lang['Msg_config_updated'] = '- La configuration du Mod Statistiques a été mise à jour avec succès.';
$lang['Msg_reset_view_count'] = '- Le compteur de visites a été remis à zéro avec succès.';
$lang['Msg_reset_install_date'] = '- La date d\'installation a été mise sur la date d\'aujourd\'hui.';
$lang['Msg_reset_cache'] = '- Tous les caches ont été vidés avec succès.';
$lang['Msg_purge_modules'] = '- Le répertoire des modules a été supprimé avec succès.';
$lang['Config_title'] = 'Configuration des statistiques';
$lang['Config_explain'] = 'Ici, vous pouvez configurer le Mod Statistiques.';
$lang['Messages'] = 'Messages';
$lang['Return_limit'] = 'Limite de répétition';
$lang['Return_limit_explain'] = 'Nombre de rangs à inclure pour chaque classement.';
$lang['Reset_settings_title'] = 'Réinitialiser les options';
$lang['Reset_view_count'] = 'Réinitialiser le compteur de visites';
$lang['Reset_view_count_explain'] = 'Remettre le compteur de visites en bas de la page de statistiques à zéro.';
$lang['Reset_install_date'] = 'Réinitialiser la date d\'installation';
$lang['Reset_install_date_explain'] = 'Remettre la date d\'installation à la date d\'aujourd\'hui.';
$lang['Reset_cache'] = 'Vider le cache';
$lang['Reset_cache_explain'] = 'Vider toutes les données actuelles du cache pour tous les modules et contenus des templates.';
$lang['Purge_module_dir'] = 'Vider le répertoire des modules';
$lang['Purge_module_dir_explain'] = 'Supprimer complètement le répertoire des modules, tous les sous-répertoires ainsi que tous les fichiers seront supprimés. Veuillez utiliser cette option seulement si vous êtes sûr de ce que vous faîtes et de l\'effet que cela aura sur vos statistiques.';

// Edit Module
$lang['Msg_changed_update_time'] = '- Le temps de mise à jour à été modifié avec succès.';
$lang['Msg_cleared_module_cache'] = '- Le cache des modules a été vidé avec succès.';
$lang['Msg_module_fields_updated'] = '- Les champs définis des modules ont été mis à jour avec succès.';

$lang['Module_select_title'] = 'Sélectionner un module';
$lang['Module_select_explain'] = 'Ici, vous pouvez sélectionner le module que vous souhaitez éditer.';
$lang['Edit_module_explain'] = 'Ici, vous pouvez configurer le module. Ci-dessous, vous pouvez apercevoir certaines informations, dans la fenêtre Messages là où tous les messages mis à jour sont affichés. Ci-desous, vous trouverez également la zone de configuration et celle de mise à jour du module. Dans la zone de mise à jour, veuillez sélectionner un pack de module \'ou\' uploadez un pack de module, surtout pas les deux en même temps.<br />La zone de configuration peut changer d\'un module à un autre, certains disposent d\'options spéciales de configuration; l\'auteur considère qu\'elles pourraient vous être utiles.';
$lang['Module_informations'] = 'Informations du module';
$lang['Module_languages'] = 'Langages rattachés à ce module';
$lang['Preview_module'] = 'Prévisualiser ce module';
$lang['Module_configuration'] = 'Configuration du module';
$lang['Update_time'] = 'Temps de mise à jour (en minutes)';
$lang['Update_time_explain'] = 'Intervalle de temps (en minutes) du rafraîchissement des données du cache avec de nouvelles données. Chaque \'X\' minutes, le module est réactualisé.<br />Depuis que les statistiques utilisent un système de priorité, cette durée peut être plus importante que \'X\' minutes, mais cela ne peut pas dépasser plus d\'une journée.';
$lang['Module_status'] = 'Statut du module';
$lang['Active'] = 'Actif';
$lang['Not_active'] = 'Désactivé';
$lang['Clear_module_cache'] = 'Vider le cache des modules';
$lang['Clear_module_cache_explain'] = 'Videz le cache du module et remettez à zéro ses priorités. La prochaine fois que la page de statistiques sera appelée, ce module sera rechargé.';
$lang['Update_module'] = 'Mettre à jour ce module';
$lang['No_module_packages_found'] = 'Aucun pack de module n\'a été trouvé';

// Permissions
$lang['Msg_permissions_updated'] = '- Permissions mises à jour';
$lang['Permissions'] = 'Permissions';
$lang['Set_permissions_title'] = 'Ici, vous pouvez choisir les permissions pour voir un module. Seuls les utilisateurs (anonyme, membre, modérateur et webmaster) et groupes autorisés/listés ici peuvent voir le module sur la page de statistiques.';
$lang['Perm_all'] = 'Anonyme';
$lang['Perm_reg'] = 'Membre';
$lang['Perm_mod'] = 'Modérateur';
$lang['Perm_admin'] = 'webmaster';
$lang['Perm_group'] = 'Groupes';
$lang['Added_groups'] = 'Groupes ajoutés';
$lang['Perm_add_group'] = 'Ajouter un groupe';
$lang['Perm_remove_group'] = 'Supprimer un groupe';
$lang['Perm_groups_title'] = 'Groupes autorisés à voir le module';
$lang['No_groups_selected'] = 'Aucun groupe n\'a été sélectionné';
$lang['No_groups_to_add'] = 'Il n\'y a plus aucun groupe à ajouter';

// Language CP
$lang['Language_key'] = 'Variable de langue';
$lang['Language_value'] = 'Valeur';
$lang['Update_all_lang'] = 'Mettre à jour toutes les entrées';
$lang['Add_new_key'] = 'Ajouter une nouvelle variable';
$lang['Create_new_lang'] = 'Créer un nouveau langage';
$lang['Delete_language'] = 'Supprimer';
$lang['Language_cp_title'] = 'Panneau de contrôle des langages';
$lang['Language_cp_explain'] = 'Ici, vous pouvez gérer toutes les variables et packs de langues pour chaque module, les ordonner, etc... Vous pouvez également importer ou exporter des packs de langages.';
$lang['Export_lang_module'] = 'Exporter la langue de ce module';
$lang['Export_language'] = 'Exporter ce langage';
$lang['Export_everything'] = 'Exporter tout';
$lang['Import_new_language'] = 'Importer un langage';
$lang['Import_new_language_explain'] = 'Ici, vous pouvez uploader (ou sélectionner) le pack de langue que vous souhaitez installer. Après avoir uploadé (ou sélectionné) un pack de langue, vous apercevrez certaines informations le concernant. C\'est seulement après avoir regardé ces informations que le pack sera installé.';
$lang['Select_language_pak'] = 'Sélectionner un pack de langue';
$lang['Upload_language_pak'] = 'Uploader un pack de langue';

$lang['Language'] = 'Langue';
$lang['Modules'] = 'Modules';
$lang['Language_pak_installed'] = 'Le pack de langue a été installé avec succès.';	

?>