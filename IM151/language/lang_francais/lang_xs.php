<?php

/***************************************************************************
 *                                lang_xs.php
 *                                -----------
 *   copyright            : (C) 2003 - 2005 CyberAlien
 *   support              : http://www.phpbbstyles.com
 *
 *   version              : 2.3.1
 *
 *   file revision        : 75
 *   project revision     : 78
 *   last modified        : 05 Dec 2005  13:54:54
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


$lang['Extreme_Styles'] = 'eXtreme Styles';
$lang['xs_title'] = 'eXtreme Styles MOD';

$lang['xs_file'] = 'Fichier';
$lang['xs_template'] = 'Template';
$lang['xs_id'] = 'ID';
$lang['xs_style'] = 'Thème';
$lang['xs_styles'] = 'Thèmes';
$lang['xs_users'] = 'Utilisateurs';
$lang['xs_options'] = 'Options';
$lang['xs_comment'] = 'Commentaire';
$lang['xs_upload_time'] = 'Temps d\'upload';
$lang['xs_select'] = 'Sélectionner';

$lang['xs_continue'] = 'Continuer';	// button

$lang['xs_click_here_lc'] = 'Cliquez ici';
$lang['xs_edit_lc'] = 'Editer';

/*
* navigation
*/
$lang['xs_config_shownav'] = array(
	'Configuration',
	'Installer un Thème',
	'Désinstaller un Thème',
	'Thème par Défaut',
	'Gestion du Cache',
	'Importer des Thèmes',
	'Exporter des Thèmes',
	'Dupliquer des Thèmes',
	'Télécharger des Thèmes',
	'Editer des Templates',
	'Editer des Thèmes',
	'Exporter la Base de Données',
	'Vérifier les Mises à Jours',
	);

/*
* frame_top.tpl
*/
$lang['xs_menu_lc'] = 'Menu eXtreme Styles MOD';
$lang['xs_support_forum_lc'] = 'Forum de support';
$lang['xs_download_styles_lc'] = 'Télécharger des thèmes';
$lang['xs_install_styles_lc'] = 'Installer des thèmes';

/*
* index.tpl
*/

$lang['xs_main_comment1'] = 'Ceci est le menu principal du MOD eXtreme Styles. Il y a de nombreuses fonctions, cette page se présente donc comme un guide. Une petite explication se trouve en dessous de chaque fonction.<br /><br />Note: Ce MOD remplace le système de gestion des thèmes de phpBB. Vous trouverez les fonctions par défaut de phpBB dans cette liste, mais celles-ci seront optimisées et auront de nouvelles fonctionnalités.<br /><br />Pour toutes questions n\'hésitez pas à visiter <a href="http://www.phpbbstyles.com" target="_blank">le forum de support</a> où vous pourrez trouver de l\'aide pour ce MOD.';
$lang['xs_main_comment2'] = 'Le MOD eXtreme Styles permet à l\'administrateur de stocker des thèmes entiers dans des fichiers .style . Les thèmes sont stockés dans de petits fichiers compressés et ainsi permettent d\'éviter les téléchargements/uploads incessants de nombreux fichiers. Les fichiers .style sont compressés et permettent que le téléchargement/upload soit plus efficace que l\'actuel téléchargement/upload des fichiers de thèmes.';
$lang['xs_main_comment3'] = 'Toutes les fonctions de gestion de thèmes de phpBB sont remplacés par eXtreme Styles MOD.<br /><br /><a href="{URL}">Cliquez ici</a> pour voir le menu.';
$lang['xs_main_title'] = 'eXtreme Styles Menu de Navigation';
$lang['xs_menu'] = 'eXtreme Styles Menu';

$lang['xs_manage_styles'] = 'Gestion des thèmes';
$lang['xs_import_export_styles'] = 'Importer/Exporter des thèmes';
$lang['xs_install_uninstall_styles'] = 'Installer/Désinstaller des thèmes';
$lang['xs_edit_templates'] = 'Editer des Templates';
$lang['xs_other_functions'] = 'Autres Fonctions';

$lang['xs_configuration'] = 'Configuration';
$lang['xs_configuration_explain'] = 'Ceci vous permet de changer la configuration d\'eXtreme Styles.';
$lang['xs_default_style'] = 'Thème par défaut';
$lang['xs_default_style_explain'] = 'Ceci vous permet de changer le thème par défaut du forum et changer le thème des utilisateurs d\'un thème à un autre.';
$lang['xs_manage_cache'] = 'Gestion du Cache';
$lang['xs_manage_cache_explain'] = 'Ceci vous permet de gérer les fichiers mis en cache.';
$lang['xs_import_styles'] = 'Importer des Thèmes';
$lang['xs_import_styles_explain'] = 'Ceci vous permet de télécharger et installer des fichiers .style .';
$lang['xs_export_styles'] = 'Exporter des Thèmes';
$lang['xs_export_styles_explain'] = 'Ceci vous permet de sauvegarder un thème de votre forum en tant que fichier .style et ainsi de facilement le transférer vers un autre forum ou un autre site.';
$lang['xs_clone_styles'] = 'Dupliquer des thèmes';
$lang['xs_clone_styles_explain'] = 'Ceci vous permet de rapidement dupliquer des thèmes ou bien un template complet.';
$lang['xs_download_styles'] = 'Télécharger des Thèmes';
$lang['xs_download_styles_explain'] = 'Ceci vous permet de rapidement télécharger et installer des thèmes depuis des sites. Vous pouvez configurer la liste des sites vous-mêmes.';
$lang['xs_install_styles'] = 'Installer des thèmes';
$lang['xs_install_styles_explain'] = 'Ceci vous permet d\'installer des thèmes déjà présents sur votre forum.';
$lang['xs_uninstall_styles'] = 'Désinstaller des Thèmes';
$lang['xs_uninstall_styles_explain'] = 'Ceci vous permet de désinstaller des thèmes de votre forum.';
$lang['xs_edit_templates_explain'] = 'Ceci vous permet d\'éditer des fichiers tpl directement en ligne.';
$lang['xs_edit_styles_data'] = 'Editer des Variables de Thèmes';
$lang['xs_edit_styles_data_explain'] = 'Ceci vous permet d\'éditer les variables des thèmes. Ceci est utilisé par certains thèmes, mais de nombreux thèmes ne les utilisent pas et utilisent à la place un fichier css.';
$lang['xs_export_styles_data'] = 'Exporter des Variables de Thèmes';
$lang['xs_export_styles_data_explain'] = 'Ceci vous permet de sauver les variables d\'un thème dans theme_info.cfg.';
$lang['xs_check_for_updates'] = 'Vérifier les Mises à Jours';
$lang['xs_check_for_updates_explain'] = 'Ceci vous permet de vérifier les mises à jours de thèmes ou mods installés sur votre forum.';

$lang['xs_set_configuration_lc'] = 'Régler la configuration';
$lang['xs_set_default_style_lc'] = 'Régler le thème par défaut';
$lang['xs_manage_cache_lc'] = 'Gestion du cache';
$lang['xs_import_styles_lc'] = 'Importer des thèmes';
$lang['xs_export_styles_lc'] = 'Exporter des thèmes';
$lang['xs_clone_styles_lc'] = 'Dupliquer des thèmes';
$lang['xs_uninstall_styles_lc'] = 'Désinstaller des thèmes';
$lang['xs_edit_templates_lc'] = 'Editer des templates';
$lang['xs_edit_styles_data_lc'] = 'Editer des variables des thèmes';
$lang['xs_export_styles_data_lc'] = 'Exporter des variables des thèmes';
$lang['xs_check_for_updates_lc'] = 'Vérifier les mises à jour';

/*
* ftp.tpl, ftp functions
*/

$lang['xs_ftp_comment1'] = 'Afin d\'utiliser cette fonctionnalité, vous devez choisir la méthode d\'upload du fichier. Si vous sélectionnez par FTP, le mot de passe ne sera pas enregistré et eXtreme Styles vous demandera un mot de passe à chaque fois que vous voudrez accéder à une fonction nécessitant un accès FTP. Si vous sélectionnez un système de fichiers locaux, assurez-vous dans ce cas que tous les répertoires requis sont inscriptibles.';
$lang['xs_ftp_comment2'] = 'Pour utiliser cette fonctionnalité, vous devez régler la configuration du FTP. Un mot de passe ne sera pas gardé et eXtreme Styles vous demandera un mot de passe à chaque fois que vous voudrez accéder à une fonction nécessitant un accès FTP.';
$lang['xs_ftp_comment3'] = 'Attention: les fonctions FTP sont désactivées sur ce serveur. Vous ne pourrez pas utiliser les fonctions d\'eXtreme Styles qui requiert un accès FTP.';

$lang['xs_ftp_title'] = 'Configuration FTP';

$lang['xs_ftp_explain'] = 'Le FTP est utilisé pour uploader de nouveaux thèmes. Si vous souhaitez utiliser la fonction d\'importation de thèmes, vous devrez régler la configuration du FTP en conséquence. eXtreme Styles tente de détecter automatiquement la configuration quand et si cela est possible.';

$lang['xs_ftp_error_fatal'] = 'Fonctions FTP désactivées sur ce serveur. Impossible de continuer.';
$lang['xs_ftp_error_connect'] = 'Erreur FTP: impossible de se connecter à {HOST}';
$lang['xs_ftp_error_login'] = 'Erreur FTP: impossible de se connecter';
$lang['xs_ftp_error_chdir'] = 'Erreur FTP: impossible de changer le répertoire en {DIR}';
$lang['xs_ftp_error_nonphpbbdir'] = 'Erreur FTP: vous avez indiqué un mauvais répertoire. Aucun fichier phpBB ne se trouve dans ce répertoire';
$lang['xs_ftp_error_noconnect'] = 'Impossible de se connecter au serveur FTP';
$lang['xs_ftp_error_login2'] = 'Login ou mot de passe FTP invalide';

$lang['xs_ftp_log_disabled'] = 'Les fonctions FTP sont désactivées sur ce serveur. Impossible de continuer le script.';
$lang['xs_ftp_log_connecting'] = 'Se connecte à {HOST}';
$lang['xs_ftp_log_noconnect'] = 'Impossible de se connecter à {HOST}';
$lang['xs_ftp_log_connected'] = 'Connecté. Identification en cours...';
$lang['xs_ftp_log_nologin'] = 'Impossible de se connecter en tant que {USER}';
$lang['xs_ftp_log_loggedin'] = 'Identifié';
$lang['xs_ftp_log_end'] = 'Fichier exécuté';
$lang['xs_ftp_log_nopwd'] = 'Erreur: impossible de retrouver le répertoire actuel';
$lang['xs_ftp_log_nomkdir'] = 'Erreur: impossible de créer le répertoire {DIR}';
$lang['xs_ftp_log_mkdir'] = 'Répertoire {DIR} crée';
$lang['xs_ftp_log_nochdir'] = 'Erreur: impossible de changer le répertoire en {DIR}';
$lang['xs_ftp_log_normdir'] = 'Erreur: impossible de supprimer le répertoire {DIR}';
$lang['xs_ftp_log_rmdir'] = 'Répertoire {DIR} supprimé';
$lang['xs_ftp_log_chdir'] = 'Répertoire changé en {DIR}';
$lang['xs_ftp_log_noupload'] = 'Erreur: impossible d\'uploader le fichier {FILE}';
$lang['xs_ftp_log_upload'] = 'Fichier {FILE} uploadé';
$lang['xs_ftp_log_nochmod'] = 'Attention: impossible de chmoder le fichier {FILE}';
$lang['xs_ftp_log_chmod'] = 'Fichier chmodé {FILE} à {MODE}';
$lang['xs_ftp_log_invalidcommand'] = 'Erreur: commande inconnue: {COMMAND}';
$lang['xs_ftp_log_chdir2'] = 'Changement du répertoire actuel initialement à {DIR}';
$lang['xs_ftp_log_nochdir2'] = 'Impossible de changer le répertoire à {DIR}';

$lang['xs_ftp_config'] = 'Configuration du FTP';
$lang['xs_ftp_select_method'] = 'Choisir la méthode d\'upload';
$lang['xs_ftp_select_local'] = 'Utiliser le système de fichiers locaux (aucune configuration requise)';
$lang['xs_ftp_select_ftp'] = 'Utiliser un FTP (régler la configuration du ftp ci-dessous)';

$lang['xs_ftp_settings'] = 'Réglages du FTP';
$lang['xs_ftp_host'] = 'Hôte FTP';
$lang['xs_ftp_login'] = 'Login FTP';
$lang['xs_ftp_path'] = 'Chemin vers phpBB FTP';
$lang['xs_ftp_pass'] = 'Mot de Passe FTP';
$lang['xs_ftp_remotedir'] = 'Répertoire Principal';

$lang['xs_ftp_host_guess'] = ' (probablement "{HOST}" [<a href="javascript: void(0)" onclick="{CLICK}">voir l\'hôte</a>])';
$lang['xs_ftp_login_guess'] = ' (probablement "{LOGIN}" [<a href="javascript: void(0)" onclick="{CLICK}">voir l\'hôte</a>])';
$lang['xs_ftp_path_guess'] = ' (probablement "{PATH}" [<a href="javascript: void(0)" onclick="{CLICK}">voir le chemin</a>])';


/*
* config.tpl
*/

$lang['xs_config_updated'] = 'Configuration mise à jour.';
$lang['xs_config_updated_explain'] = 'Vous devez rafraîchir cette page pour que la nouvelle configuration prenne effet. <a href="{URL}">Cliquer ici</a> pour rafraîchir la page.';
$lang['xs_config_warning'] = 'Attention: le cache n\'est pas inscriptible.';
$lang['xs_config_warning_explain'] = 'Le répertoire du cache n\'est pas inscriptible. eXtreme Styles peut tenter de réparer ce problème.<br /><a href="{URL}">Cliquer ici</a> pour essayer de changer l\'accès au répertoire du cache.<br /><br />Si le cache ne fonctionne pas sur votre serveur pour une raison quelconque? Ne vous inquiétez pas, - eXtreme Styles<br />augmente d\'une manière notable la vitesse de votre forum même sans cache.';

$lang['xs_config_maintitle'] = 'Configuration du MOD eXtreme Styles';
$lang['xs_config_subtitle'] = 'Ceci est la configuration pour eXtreme Styles. Si vous ne comprenez pas à quoi servent certaines variables, ne les changez pas.';
$lang['xs_config_title'] = 'Réglages d\'eXtreme Styles MOD v{VERSION}';
$lang['xs_config_cache'] = 'Configuration du Cache';

$lang['xs_config_navbar'] = 'Afficher dans le cadre de gauche:';
$lang['xs_config_navbar_explain'] = 'Vous pouvez choisir quelles fonctions seront affichées dans le cadre de gauche dans le panneau d\'administration.';

$lang['xs_config_def_template'] = 'Répertoire du thème par défaut';
$lang['xs_config_def_template_explain'] = 'Si un tpl requis ne se trouve pas dans le répertoire du template (cela peut arriver si vous avez mal moddé votre forum) alors le système de template recherchera le même fichier dans un autre répertoire de template (par exemple si le thème actuel est "monThème" et le script requiert le fichier "monThème/monfichier.tpl" et que ce fichier n\'existe pas, le système de template recherchera ce fichier dans "subSilver/monfichier.tpl"). Laisser blanc pour désactiver cette option.';

$lang['xs_config_check_switches'] = 'Vérifier les switches pendant la compilation';
$lang['xs_config_check_switches_explain'] = 'Ceci vous permet de vérifier les erreurs dans les templates. Désactiver cette option augmentera la vitesse de compilation, mais le compilateur peut laisser passer quelques erreurs dans les templates s\'ils contiennent certaines erreurs.<br /><br />La vérification avancée vérifiera les erreurs dans les templates et réparera automatiquement toutes les erreurs reconnues (il y a certaines typos reconnaissables dans différents MODs). Elle fonctionne un peu plus lentement que la vérification simple.<br /><br />Mais parfois, le template semble propre uniquement quand la vérification d\'erreurs est désactivée; cela arrive à cause d\'un mauvais codage html - dans ce cas contacter l\'auteur du thème pour corriger les erreurs.<br /><br />Si la fonction de cache est désactivée, alors désactivez également cette fonction pour une compilation plus rapide.'; 
$lang['xs_config_check_switches_0'] = 'Désactivé';
$lang['xs_config_check_switches_1'] = 'Vérification avancée';
$lang['xs_config_check_switches_2'] = 'Vérification simple';

$lang['xs_config_show_errors'] = 'Affiche les erreurs quand les fichiers sont incorrectement inclus dans les fichiers tpl';
$lang['xs_config_show_error_explain'] = 'Ceci active/désactive les erreurs dans les fichiers tpl que l\'utilisateur a incorrectement utilisé &lt;!-- INCLUDE filename --&gt;';

$lang['xs_config_tpl_comments'] = 'Ajouter les noms des fichiers tpl en html';
$lang['xs_config_tpl_comments_explain'] = 'Ceci ajoute des commentaires dans le code html qui permet aux auteurs de thèmes de détecter quels fichiers tpl sont affichés.';

$lang['xs_config_use_cache'] = 'Utiliser le cache';
$lang['xs_config_use_cache_explain'] = 'Le cache est sauvegardé sur le disque et accélérera le système de templates car il n\'y aura plus besoin de compiler le template à chaque fois qu\'il est affiché.';

$lang['xs_config_auto_compile'] = 'Mettre en cache automatiquement';
$lang['xs_config_auto_compile_explain'] = 'Ceci compilera automatiquement les templates qui ne sont pas mis en cache et seront sauvegardé dans le répertoire de cache.';

$lang['xs_config_auto_recompile'] = 'Re-compiler automatiquement le cache';
$lang['xs_config_auto_recompile_explain'] = 'Ceci re-compilera automatiquement les templates si un template a été changé.';

$lang['xs_config_php'] = 'Extension des fichiers de cache';
$lang['xs_config_php_explain'] = 'Ceci est l\'extension des fichiers mis en cache. Les fichiers sont sauvegardés dans un format php, donc l\'extension par défaut sera "php". Ne pas inclure le point';

$lang['xs_config_back'] = '<a href="{URL}">Cliquer ici</a> pour revenir à la configuration';
$lang['xs_config_sql_error'] = 'Impossible de mettre à jour la configuration générale pour {VAR}';

// Debug info
$lang['xs_debug_header'] = 'Debug info';
$lang['xs_debug_explain'] = 'Ceci est le debug info. Utilisé pour trouver/réparer les problèmes lors de la configuration du cache.';
$lang['xs_debug_vars'] = 'Variables du template';
$lang['xs_debug_tpl_name'] = 'Nom de fichier du template:';
$lang['xs_debug_cache_filename'] = 'Nom de fichier du cache:';
$lang['xs_debug_data'] = 'Données du debug:';

$lang['xs_check_hdr'] = 'Vérification du cache pour %s';
$lang['xs_check_filename'] = 'Erreur: nom de fichier invalide';
$lang['xs_check_openfile1'] = 'Erreur: impossible d\'ouvrir le fichier "%s". Tente de créer les répertoires...';
$lang['xs_check_openfile2'] = 'Erreur: impossible d\'ouvrir le fichier "%s" pour la seconde fois. Annulation...';
$lang['xs_check_nodir'] = 'Vérification de "%s" - Pas de répertoire à ce nom.';
$lang['xs_check_nodir2'] = 'Erreur: impossible de créer le répertoire "%s" - vous devriez vérifier les permissions de ce répertoire.';
$lang['xs_check_createddir'] = 'Répertoire "%s" crée';
$lang['xs_check_dir'] = 'Vérification de "%s" - le répertoire existe.';
$lang['xs_check_ok'] = 'Fichier "%s" ouvert pour écriture. Tout semble fonctionner.';
$lang['xs_error_demo_edit'] = 'Vous ne pouvez pas éditer des fichiers en mode démo';
$lang['xs_error_not_installed'] = 'eXtreme Styles mod n\'est pas installé. Vous avez oublié le fichier includes/template.php';


/*
* chmod
*/

$lang['xs_chmod'] = 'CHMOD';
$lang['xs_chmod_return'] = '<br /><br /><a href="{URL}">Cliquer ici</a> pour revenir à la configuration.';
$lang['xs_chmod_message1'] = 'Configuration modifiée.';
$lang['xs_chmod_error1'] = 'Impossible de changer le mode d\'accès pour le répertoire du cache';


/*
* default style
*/

$lang['xs_def_title'] = 'Régler le thème par défaut';
$lang['xs_def_explain'] = 'Ceci vous permet de changer le thème par défaut du forum et changer le thème des utilisateurs d\'un thème à un autre.';

$lang['xs_styles_set_default'] = 'Mettre par défaut';
$lang['xs_styles_no_override'] = 'Ne pas écraser les préférences de l\'utilisateur';
$lang['xs_styles_do_override'] = 'Ecraser les préférences de l\'utilisateur';
$lang['xs_styles_switch_all'] = 'Changer le thème de tous les utilisateurs par celui-ci';
$lang['xs_styles_switch_all2'] = 'Changer le thème de tous les utilisateurs par:';
$lang['xs_styles_defstyle'] = 'Thème par défaut';
$lang['xs_styles_available'] = 'Thèmes disponibles';
$lang['xs_styles_make_public'] = 'Rendre le thème public';
$lang['xs_styles_make_admin'] = 'Rendre le thème uniquement disponible pour l\'administrateur';
$lang['xs_styles_users'] = 'Listes des utilisateurs';


/*
* cache management
*/

$lang['xs_manage_cache_explain2'] = 'Ceci vous permet de compiler ou supprimer des fichiers mis en cache pour les thèmes.';
$lang['xs_clear_all_lc'] = 'Supprimer tous';
$lang['xs_compile_all_lc'] = 'Compiler tous';
$lang['xs_clear_cache_lc'] = 'Vider le cache';
$lang['xs_compile_cache_lc'] = 'Compiler le cache';
$lang['xs_cache_confirm'] = 'Si vous avez de nombreux thèmes, cela peut causer un gros chargement du serveur. Etes-vous sûr de vouloir continuer?';

$lang['xs_cache_nowrite'] = 'Erreur: impossible d\'accéder au répertoire de cache';
$lang['xs_cache_log_deleted'] = '{FILE} supprimé';
$lang['xs_cache_log_nodelete'] = 'Erreur: impossible de supprimer le fichier {FILE}';
$lang['xs_cache_log_nothing'] = 'Rien à supprimer pour le template {TPL}';
$lang['xs_cache_log_nothing2'] = 'Rien à supprimer dans le répertoire de cache';
$lang['xs_cache_log_count'] = 'La suppression des fichiers {NUM} a été effectué avec succès';
$lang['xs_cache_log_count2'] = 'Erreur lors de la suppression des fichiers {NUM}';
$lang['xs_cache_log_compiled'] = 'Compilés: fichiers {NUM}';
$lang['xs_cache_log_errors'] = 'Erreurs: {NUM}';
$lang['xs_cache_log_noaccess'] = 'Erreur: impossible d\'accéder au répertoire {DIR}';
$lang['xs_cache_log_compiled2'] = 'Compilé: {FILE}';
$lang['xs_cache_log_nocompile'] = 'Erreur compilation: {FILE}';

/*
* export/import/download/clone
*/

$lang['xs_import_explain'] = 'Ceci vous permet d\'importer des thèmes et peut aussi installer et mettre à jour automatiquement des thèmes.<br /><br />Note: si vous avez installé des mods (excepté eXtreme Styles MOD) sur ce forum, faites attention lorsque vous importez des thèmes car des thèmes peuvent ne pas être compatibles avec votre forum. Vous pouvez uniquement installer des thèmes qui ont les mêmes modifications que les autres thèmes que vous avez configuré sur votre forum.';

$lang['xs_import_lc'] = 'Importer';
$lang['xs_list_files_lc'] = 'Liste des fichiers';
$lang['xs_delete_file_lc'] = 'Supprimer le fichier';
$lang['xs_export_style_lc'] = 'Exporter le thème';

$lang['xs_import_no_cached'] = 'Il n\'y a aucun thème mis en cache à importer';
$lang['xs_add_styles'] = 'Ajouter des thèmes';
$lang['xs_add_styles_web'] = 'Télécharger des thèmes';
$lang['xs_add_styles_web_get'] = 'Le prendre';
$lang['xs_add_styles_copy'] = 'Copier à partir d\'un fichier local';
$lang['xs_add_styles_copy_get'] = 'Copier';
$lang['xs_add_styles_upload'] = 'Uploader d\'un ordinateur';
$lang['xs_add_styles_upload_get'] = 'Uploader';

$lang['xs_export_style'] = 'Exporter des thèmes';
$lang['xs_export_style_explain'] = 'Ceci vous permet d\'exporter un thème en un seul fichier. Ce fichier est très petit - plus petit qu\'un fichier .zip (car compressé en gzip, qui marche mieux que le zip) et tout le thème se trouve à l\'intérieur de ce fichier. Ainsi, il est plus facile de transférer un thème d\'un forum à un autre.<br /><br />Il vous est  également possible d\'uploader des thèmes exportés en utilisant un ftp vers le serveur. Ce système vous permet de transférer un thème vers un autre forum de manière rapide sans avoir besoin de le copier manuellement.';

$lang['xs_export_style_title'] = 'Exporter le Template "{TPL}"';
$lang['xs_export_tpl_name'] = 'Exporter en tant que (nom du template)';
$lang['xs_export_style_names'] = 'Sélectionner le thème(s) à exporter';
$lang['xs_export_style_name'] = 'Thème à exporter (nom du thème)';
$lang['xs_export_style_comment'] = 'Commentaire';
$lang['xs_export_where'] = 'Lieu d\'exportation';
$lang['xs_export_where_download'] = 'Télécharger sous le nom de';
$lang['xs_export_where_store'] = 'Stocker en tant que fichier sur le serveur';
$lang['xs_export_where_store_dir'] = 'Répertoire';
$lang['xs_export_where_ftp'] = 'Uploader via FTP';
$lang['xs_export_filename'] = 'Exporter le nom de fichier';

$lang['xs_download_explain2'] = 'Ceci vous permet de rapidement télécharger et installer des thèmes directement depuis différents sites. Cliquez sur le lien près du nom du site et vous serez redirigés vers une page de téléchargement de thèmes.<br /><br />Vous pouvez également gérer la liste des sites.';

$lang['xs_download_locations'] = 'Lieux de téléchargement';
$lang['xs_edit_link'] = 'Editer le lien';
$lang['xs_add_link'] = 'Ajouter un lien';
$lang['xs_link_title'] = 'Titre du lien';
$lang['xs_link_url'] = 'URL du lien';
$lang['xs_delete'] = 'Supprimer';

$lang['xs_style_header_error_file'] = 'Impossible d\'ouvrir le fichier local';
$lang['xs_style_header_error_server'] = 'Erreur sur le serveur: ';
$lang['xs_style_header_error_invalid'] = 'Header du fichier invalide';
$lang['xs_style_header_error_reason'] = 'Erreur durant la lecture du header du fichier: ';
$lang['xs_style_header_error_incomplete'] = 'Fichier incomplet';
$lang['xs_style_header_error_incomplete2'] = 'Taille du fichier invalide. Le fichier est probablement incomplet.';
$lang['xs_style_header_error_invalid2'] = 'Fichier invalide. Probablement, le fichier n\'est pas compatible avec eXtreme Styles ou bien avec une version invalide.';
$lang['xs_error_cannot_open'] = 'Impossible d\'ouvrir le fichier.';
$lang['xs_error_decompress_style'] = 'Erreur lors de la décompression du fichier. Le fichier est probablement corrompu.';
$lang['xs_error_cannot_create_file'] = 'Impossible de créer le fichier "{FILE}"';
$lang['xs_error_cannot_create_tmp'] = 'Impossible de créer le fichier temporaire "{FILE}"';
$lang['xs_import_invalid_file'] = 'Fichier invalide';
$lang['xs_import_incomplete_file'] = 'Fichier incomplet';
$lang['xs_import_uploaded'] = 'Thème uploadé.';
$lang['xs_import_installed'] = 'Thème uploadé et installé.';
$lang['xs_import_notinstall'] = 'Thème uploadé, mais erreur en installant le thème (erreur sql).';
$lang['xs_import_notinstall2'] = 'Thème uploadé, mais erreur en installant le thème: aucun thème trouvé dans theme_info.cfg';
$lang['xs_import_notinstall3'] = 'Thème uploadé, mais erreur en installant le thème: aucune entrée "{STYLE}" trouvée dans theme_info.cfg';
$lang['xs_import_notinstall4'] = 'Thème uploadé, mais erreur en installant le thème: impossible d\'obtenir l\'information concernant themes_id';
$lang['xs_import_notinstall5'] = 'Thème uploadé, mais erreur en installant le thème: impossible de mettre à jour la table des thèmes';
$lang['xs_import_nodownload'] = 'Impossible de télécharger le thème depuis {URL}';
$lang['xs_import_nodownload2'] = 'Impossible de copier le thème depuis {URL}';
$lang['xs_import_nodownload3'] = 'Fichier non uploadé.';
$lang['xs_import_uploaded2'] = 'Thème téléchargé. Vous pouvez désormais l\'importer.<br /><br /><a href="{URL}">Cliquer ici</a> pour importer le thème.';
$lang['xs_import_uploaded3'] = 'Thème copié. Vous pouvez désormais l\'importer.<br /><br /><a href="{URL}">Cliquer ici</a> pour importer le thème.';
$lang['xs_import_uploaded4'] = 'Thème uploadé. Vous pouvez désormais l\'importer.<br /><br /><a href="{URL}">Cliquer ici</a> pour importer le thème.';
$lang['xs_export_no_open_dir'] = 'Impossible d\'ouvrir le répertoire {DIR}';
$lang['xs_export_no_open_file'] = 'Impossible d\'ouvrir le fichier {FILE}';
$lang['xs_export_no_read_file'] = 'Erreur lors de la lecture du fichier {FILE}';
$lang['xs_no_theme_data'] = 'Impossible de trouver les données pour le thème sélectionné';
$lang['xs_no_style_info'] = 'Impossible de trouver les informations du thème';
$lang['xs_export_noselect_themes'] = 'Vous devez choisir au moins un thème';
$lang['xs_export_error'] = 'Impossible d\'exporter le template "{TPL}": ';
$lang['xs_export_error2'] = 'Impossible d\'exporter le template "{TPL}": le thème est vide';
$lang['xs_export_saved'] = 'Thème sauvé en tant que "{FILE}"';
$lang['xs_export_error_uploading'] = 'Erreur lors de l\'upload du thème';
$lang['xs_export_uploaded'] = 'Fichier uploadé.';
$lang['xs_clone_taken'] = 'Le nom de ce thème est déjà utilisé.';
$lang['xs_error_new_row'] = 'Impossible d\'insérer une nouvelle colonne dans cette table.';
$lang['xs_theme_cloned'] = 'Thème cloné.';
$lang['xs_invalid_style_name'] = 'Nom de thème invalide.';
$lang['xs_clone_style_exists'] = 'Ce template existe déjà';
$lang['xs_clone_no_select'] = 'Vous devez choisir au moins un thème à cloner.';
$lang['xs_no_themes'] = 'Impossible de trouver le thème dans la base de données.';

$lang['xs_import_back'] = '<a href="{URL}">Cliquer ici</a> pour retourner à la page d\'importation des thèmes.';
$lang['xs_import_back_download'] = '<a href="{URL}" target="main">Cliquer ici</a> pour retourner au téléchargements.';
$lang['xs_export_back'] = '<a href="{URL}">Cliquer ici</a> pour retourner à la page d\'exportation des thèmes.';
$lang['xs_clone_back'] = '<a href="{URL}">Cliquer ici</a> pour retourner à la page de clonage des thèmes.';
$lang['xs_download_back'] = '<a href="{URL}">Cliquer ici</a> pour retourner au téléchargements.';

$lang['xs_import_tpl'] = 'Importer le Template "{TPL}"';
$lang['xs_import_tpl_comment'] = 'Ceci vous permet d\'uploader un template dans votre forum. Si un template possède déjà ce nom sur votre forum, les anciens fichiers seront écrasés et peut ainsi être utilisé pour mettre à jour des thèmes.<br /><br />Cette fonctionnalité peut également automatiquement installer des thèmes. Si vous souhaitez installer un thème après l\'avoir importé, alors sélectionnez un ou plusieurs thèmes ci-dessous.';
$lang['xs_import_tpl_filename'] = 'Nom du fichier:';
$lang['xs_import_tpl_tplname'] = 'Nom du template:';
$lang['xs_import_tpl_comment2'] = 'Commentaire:';
$lang['xs_import_select_styles'] = 'Sélectionner le(s) thème(s) à installer:';
$lang['xs_import_install_def_lc'] = 'mettre comme thème par défaut du forum';
$lang['xs_import_install_style'] = 'Installer le thème:';
$lang['xs_import'] = 'Importer';

$lang['xs_import_list_contents'] = 'Contenus du fichier: ';
$lang['xs_import_list_filename'] = 'Nom du fichier: ';
$lang['xs_import_list_template'] = 'Template: ';
$lang['xs_import_list_comment'] = 'Commentaire : ';
$lang['xs_import_list_styles'] = 'Thème(s): ';
$lang['xs_import_list_files'] = 'Fichiers ({NUM}):';
$lang['xs_import_download_lc'] = 'Télécharger le fichier';
$lang['xs_import_view_lc'] = 'Voir le fichier';
$lang['xs_import_file_size'] = '({NUM} bytes)';

$lang['xs_import_nogzip'] = 'Cette fonction requiert la compression gzip, et apparemment celle-ci n\'est pas supportée sur ce serveur.';
$lang['xs_import_nowrite_cache'] = 'Impossible d\'écrire dans le cache. Cette fonction requiert que le cache doive être inscriptible. Vérifiez la configuration du MOD.<br /><br /><a href="{URL1}">Cliquer ici</a> pour rendre le cache inscriptible.<br /><br /><a href="{URL2}">Cliquer ici</a>pour revenir à la page d\'importation.';

$lang['xs_import_download_warning'] = 'Ceci vous amènera sur un site web externe où vous pourrez rapidement télécharger des thèmes avec simplement quelques clics en utilisant le système d\'importation d\'eXtreme Styles.';

$lang['xs_clone_style'] = 'Cloner le thème';
$lang['xs_clone_style_explain'] = 'Ceci vous permet de rapidement cloner un thème ou bien un template entier.<br /><br />Attention: Si vous copiez un template, veillez à ce que l\'auteur original du template vous autorise à le faire (sauf pour subSilver - vous pouvez faire ce que vous souhaitez avec subSilver). Normalement les auteurs autorise que leurs thèmes soient modifiés, mais les thèmes modifiés ne doivent être distribués.';
$lang['xs_clone_style_explain2'] = 'Ceci vous permet de créer un nouveau thèmes pour un template. Ceci ne copiera aucun fichier - ceci ajoutera une nouvelle entrée dans la base de données pour le nouveau thème. L\'ancien et le nouveau thème partageront le même template.';
$lang['xs_clone_style_explain3'] = 'Entrez le nom pour le nouveau thème que vous allez créer et cliquez sur le bouton "Cloner".';
$lang['xs_clone_style_explain4'] = 'Ceci vous permet de cloner un template. Vous pouvez également copier tous les thèmes associés à ce template. Plus tard, vous pourrez éditer les fichiers tpl, le nouveau template et l\'ancien template ne seront pas affectés.';

$lang['xs_clone_style_lc'] = 'cloner le thème';
$lang['xs_clone_style2'] = 'Cloner le thème "{STYLE}":';
$lang['xs_clone_style3'] = 'Cloner le template "{STYLE}"';
$lang['xs_clone_newdir_name'] = 'Nom du nouveau template (répertoire):';
$lang['xs_clone_select'] = 'Sélectionner le(s) thème(s) à cloner:';
$lang['xs_clone_select_explain'] = 'Vous devez choisir au moins un thème.';
$lang['xs_clone_newname'] = 'Nouveau nom du thème:';


/*
* install/uninstall
*/
$lang['xs_install_styles_explain2'] = 'Ceci est la liste des thèmes uploadés sur votre forum, mais qui ne sont pas installés. Cliquer sur le lien "installer" pour le thème que vous souhaitez installer, ou bien sélectionner plusieurs thèmes puis cliquer sur le bouton d\'envoi.';
$lang['xs_uninstall_styles_explain2'] = 'Ceci est la liste des thèmes installés sur votre forum. Cliquer sur le lien "désinstaller" pour supprimer certains thèmes de ce forum. Désinstaller est sûr - tous les membres qui emploie ce thème qui a été désinstallé seront modifiés au thème par défaut du forum. Aussi, supprimer un thème supprimera automatiquement le cache pour ce thème.';

$lang['xs_install'] = 'Installer';
$lang['xs_install_lc'] = 'Installer';
$lang['xs_uninstall'] = 'Désinstaller';
$lang['xs_remove_files'] = 'Supprimer les fichiers';
$lang['xs_style_removed'] = 'Thème supprimé.';
$lang['xs_uninstall_lc'] = 'Désinstallé';
$lang['xs_uninstall2_lc'] = 'Désinstaller et supprimer les fichiers';

$lang['xs_install_back'] = '<a href="{URL}">Cliquer ici</a> pour revenir à l\'installation des thèmes.';
$lang['xs_uninstall_back'] = '<a href="{URL}">Cliquer ici</a> pour revenir à la désinstallation des thèmes.';
$lang['xs_goto_default'] = '<a href="{URL}">Cliquer ici</a> pour changer le thème par défaut.';

$lang['xs_install_installed'] = 'Thème(s) installé(s).';
$lang['xs_install_error'] = 'Erreur lors de l\'installation du thème.';
$lang['xs_install_none'] = 'Il n\'y a pas de nouveau thème à installer. Tous les thèmes disponibles sont déjà installés.';

$lang['xs_uninstall_default'] = 'Vous ne pouvez pas supprimer le thème par défaut. Pour changer le thème par défaut <a href="{URL}">cliquer ici</a>.';

/*
* export theme_info.cfg
*/
$lang['xs_export_styles_data_explain2'] = 'Ceci sauvegarde les données du thème dans theme_info.cfg. Ceci peut être utilisé pour sauvegarder les informations de la base de données avant de transférer les thèmes d\'un forum à un autre.<br /><br />Note: Si vous utilisez le système d\'importation d\'eXtreme Styles pour transférer un thème d\'un forum à un autre, vous n\'avez pas besoin de sauvegarder theme_info.cfg - ceci est effectué automatiquement par le système d\'exportation des thèmes.';
$lang['xs_export_styles_data_explain3'] = 'Sélectionner les thèmes à exporter.';

$lang['xs_export_data_back'] = '<a href="{URL}">Cliquer ici</a> pour revenir à la page d\'exportation des données.';
$lang['xs_export_style_data_lc'] = 'exporter les données du thème';

$lang['xs_export_data_saved'] = 'Données exportées.';

/*
* edit templates (file manager)
*/
$lang['xs_edit_template_comment1'] = 'Ceci vous permet d\'éditer les templates. L\'explorateur vous montre uniquement les fichiers éditables.';
$lang['xs_edit_template_comment2'] = 'Ceci vous permet d\'éditer les templates.';
$lang['xs_edit_file_saved'] = 'Fichier sauvegardé.';
$lang['xs_edit_not_found'] = 'Fichier non trouvé.';
$lang['xs_edittpl_back_dir'] = '<a href="{URL}">Cliquer ici</a> pour retourner à la gestion des fichiers.';

$lang['xs_fileman_browser'] = 'Explorateur de fichiers';
$lang['xs_fileman_directory'] = 'Répertoire:';
$lang['xs_fileman_dircount'] = 'Répertoires ({COUNT}):';
$lang['xs_fileman_filter'] = 'Filtre';
$lang['xs_fileman_filter_ext'] = 'Montrer uniquement les fichiers avec extension:';
$lang['xs_fileman_filter_content'] = 'Montrer uniquement les fichiers contenant:';
$lang['xs_fileman_filter_clear'] = 'Vider le filtre';
$lang['xs_fileman_filename'] = 'Nom du fichier';
$lang['xs_fileman_filesize'] = 'Taille';
$lang['xs_fileman_filetime'] = 'Modification';
$lang['xs_fileman_options'] = 'Options';
$lang['xs_fileman_time_today'] = '(aujourd\'hui)';
$lang['xs_fileman_edit_lc'] = 'éditer';

$lang['xs_fileedit_search_nomatch'] = 'Aucune correspondance trouvée';
$lang['xs_fileedit_search_match1'] = 'Remplacer une correspondance';
$lang['xs_fileedit_search_matches'] = "Remplacer ' + compter + ' correspondances";
$lang['xs_fileedit_noundo'] = 'Il n\'y a rien à annuler';
$lang['xs_fileedit_undo_complete'] = 'Ancien contenu restauré';
$lang['xs_fileedit_edit_name'] = 'Editer le fichier:';
$lang['xs_fileedit_location'] = 'Localisation:';
$lang['xs_fileedit_reload_lc'] = 'Recharger le fichier';
$lang['xs_fileedit_download_lc'] = 'Télécharger le fichier';
$lang['xs_fileedit_trim'] = 'Supprimer Automatiquement les espaces en début et fin de fichier.';
$lang['xs_fileedit_functions'] = 'Editer les fonctions';
$lang['xs_fileedit_replace1'] = 'Remplacer ';
$lang['xs_fileedit_replace2'] = ' par ';
$lang['xs_fileedit_replace_first_lc'] = 'Remplacer la première correspondance';
$lang['xs_fileedit_replace_all_lc'] = 'Remplacer toutes les correspondances';
$lang['xs_fileedit_replace_undo_lc'] = 'Annuler le remplacement';
$lang['xs_fileedit_backups'] = 'Backups';
$lang['xs_fileedit_backups_save_lc'] = 'Sauvegarder';
$lang['xs_fileedit_backups_show_lc'] = 'Montrer le contenu';
$lang['xs_fileedit_backups_restore_lc'] = 'Restaurer';
$lang['xs_fileedit_backups_download_lc'] = 'Télécharger';
$lang['xs_fileedit_backups_delete_lc'] = 'Supprimer';
$lang['xs_fileedit_upload'] = 'Upload';
$lang['xs_fileedit_upload_file'] = 'Uploader le fichier:';

/*
* edit styles data (theme_info)
*/
$lang['xs_data_head_stylesheet'] = 'Feuille de style CSS';
$lang['xs_data_body_background'] = 'Image de fond';
$lang['xs_data_body_bgcolor'] = 'Couleur de fond';
$lang['xs_data_style_name'] = 'Nom du thème';
$lang['xs_data_body_link'] = 'Couleur du lien';
$lang['xs_data_body_text'] = 'Couleur du texte';
$lang['xs_data_body_vlink'] = 'Couleur du lien visité';
$lang['xs_data_body_alink'] = 'Couleur du lien actif';
$lang['xs_data_body_hlink'] = 'Couleur du lien survolé';
$lang['xs_data_tr_color'] = 'Couleur de la rangée du tableau %s';
$lang['xs_data_tr_class'] = 'Classe de la rangée du tableau %s';
$lang['xs_data_th_color'] = 'Couleur du header du tableau %s';
$lang['xs_data_th_class'] = 'Classe du header du tableau %s';
$lang['xs_data_td_color'] = 'Couleur de la cellule du tableau %s';
$lang['xs_data_td_class'] = 'Classe de la cellule du tableau %s';
$lang['xs_data_fontface'] = 'Police %s';
$lang['xs_data_fontsize'] = 'Taille de police %s';
$lang['xs_data_fontcolor'] = 'Couleur de police %s';
$lang['xs_data_span_class'] = 'Span Classe %s';
$lang['xs_data_img_size_poll'] = 'Taille de l\'image dans un vote [px]';
$lang['xs_data_img_size_privmsg'] = 'Taille du statut des messages privés [px]';
$lang['xs_data_theme_public'] = 'Style Public (1 or 0)';
$lang['xs_data_unknown'] = 'Description non valable (%s)';

$lang['xs_edittpl_error_updating'] = 'Erreur en mettant à jour le thème.';
$lang['xs_edittpl_style_updated'] = 'Thème mis à jour.';
$lang['xs_invalid_style_id'] = 'ID du thème invalide.';

$lang['xs_edittpl_back_edit'] = '<a href="{URL}">Cliquer ici</a> pour revenir à l\'édition.';
$lang['xs_edittpl_back_list'] = '<a href="{URL}">Cliquer ici</a> pour revenir à la liste des thèmes.';

$lang['xs_editdata_explain'] = 'Ceci vous permet d\'éditer les données de la base de données pour les thèmes installés. Certains thèmes ignorent les valeurs de la base de données et utilisent les fichiers css à la place, et certains thèmes utilisent uniquement les valeurs de la base de données.';
$lang['xs_editdata_var'] = 'Variable';
$lang['xs_editdata_value'] = 'Valeur';
$lang['xs_editdata_comment'] = 'Commentaire';

/*
* updates
*/

$lang['xs_updates'] = 'Mises à jour';
$lang['xs_updates_comment'] = 'Ceci vérifie les mises à jours de certains thèmes et mods. Ne marche qu\'avec ceux qui sont aptes à avoir des informations sur leurs mises à jours.';
$lang['xs_updates_comment2'] = 'Voici le résultat de la mise à jour.';
$lang['xs_update_total1'] = 'Total: {NUM} items';
$lang['xs_update_info1'] = 'Cette fonction administrative vous permet de vérifier les mises à jours disponibles de phpBB, certains MODs, et certains thèmes installés sur votre forum. Si des mises à jours sont disponibles, il vous sera montré un lien où vous pourrez télécharger le fichier de mise à jour.<br /><br />Cette fonction nécessite les sockets pour être activée. Le plupart des hébergements gratuits ne permettent pas cette fonctionnalité, ainsi si ce forum est hébergé par un hébergeur gratuit (comme lycos) vous ne pouvez pas utiliser cette fonction de mise à jour, mais si ce forum est sur un hébergeur normal tout devrait correctement se passer.<br /><br />Quand vous cliquerez sur "continuer", le script vérifiera toutes les programmes installés sur ce forum. Si votre site est lent cela peut prendre un peu de temps. Soyez patient et ne cliquez pas sur "stop" si le temps d\'exécution de votre explorateur internet n\'est pas terminé. Si le serveur est lent ou bien la mise à jour du site est lent alors le temps d\'exécution du script doit être terminé - si cela arrive, vous devriez augmenter la valeur du temps d\'exécution.';
$lang['xs_update_name'] = 'Nom';
$lang['xs_update_type'] = 'Type';
$lang['xs_update_current_version'] = 'Votre version';
$lang['xs_update_latest_version'] = 'Dernière version';
$lang['xs_update_downloadinfo'] = 'URL de téléchargement';
$lang['xs_update_timeout'] = 'Mettre à jour le temps d\'exécution (secondes):';
$lang['xs_update_continue'] = 'Continuer';


$lang['xs_update_total2'] = 'Erreurs: {NUM}';
$lang['xs_update_total3'] = 'Mises à jours disponibles: {NUM} items';
$lang['xs_update_select1'] = 'Sélectionner les items à mettre à jour';
$lang['xs_update_types'] = array(
		0 => 'Inconnu',
		1 => 'Thème',
		2 => 'MOD',
		3 => 'phpBB'
		);
$lang['xs_update_fileinfo'] = 'Plus d\'informations';
$lang['xs_update_nothing'] = 'Rien à mettre à jour.';
$lang['xs_update_noupdate'] = 'Vous utilisez la dernière version.';

$lang['xs_update_error_url'] = 'Erreur: impossible de trouver l\'url %s';
$lang['xs_update_error_noitem'] = 'Erreur: aucune information concernant la mise à jour disponible';
$lang['xs_update_error_noconnect'] = 'Erreur: impossible de se connecter au serveur';

$lang['xs_update_download'] = 'Télécharger';
$lang['xs_update_downloadinfo2'] = 'Télécharger/info';
$lang['xs_update_info'] = 'Site web';

$lang['xs_permission_denied'] = 'Permission refusée';

$lang['xs_download_lc'] = 'Téléchargements';
$lang['xs_info_lc'] = 'Info';

/*
* style configuration
*/
$lang['Template_Config'] = 'Template Config';
$lang['xs_style_configuration'] = 'Template Configuration';

?>
