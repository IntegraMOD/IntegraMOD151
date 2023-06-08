<?php

/***************************************************************************
 *              lang_cash.php [French]
 *               -------------------
 *   begin        : Sat Jul 20 2003
 *   copyright    : (C) 2003 Q-Zar
 *   email        : admin@enfantsdamnes.be
 *
 *   $Id: lang_cash.php,v 1.0.0.0 2003/10/08 00:55:17 Xore Exp $
 *
 ****************************************************************************/

/***************************************************************************
 *
 *  This program is free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 ***************************************************************************/

//
// Admin menu
//
$lang['Cmcat_main'] = 'Cash Mod - Principal';
$lang['Cmcat_addons'] = 'Add-ons';
$lang['Cmcat_other'] = 'Autres';
$lang['Cmcat_help'] = 'Aide';

$lang['Cash_Configuration'] = 'Cash&nbsp;-&nbsp;Configuration';
$lang['Cash_Currencies'] = 'Cash&nbsp;-&nbsp;Monnaies';
$lang['Cash_Exchange'] = 'Cash&nbsp;-&nbsp;Echanges';
$lang['Cash_Events'] = 'Cash&nbsp;-&nbsp;Evènements';
$lang['Cash_Forums'] = 'Cash&nbsp;-&nbsp;Forums';
$lang['Cash_Groups'] = 'Cash&nbsp;-&nbsp;Groupes';
$lang['Cash_Help'] = 'Cash&nbsp;-&nbsp;Aide';
$lang['Cash_Logs'] = 'Cash&nbsp;-&nbsp;Logs';
$lang['Cash_Settings'] = 'Cash&nbsp;-&nbsp;Réglages';

$lang['Cmenu_cash_config'] = 'Réglages généraux du Cash Mod, modifiant toutes les monnaies';
$lang['Cmenu_cash_currencies'] = 'Ajouter, Enlever, ou déplacer des monnaies';
$lang['Cmenu_cash_settings'] = 'Réglages spécifiques pour chaque monnaie';
$lang['Cmenu_cash_events'] = 'Montants à donner lors d\'évènements';
$lang['Cmenu_cash_reset'] = 'Remettre à zéro ou Recompter les montants';
$lang['Cmenu_cash_exchange'] = 'Activer/Désactiver l\'échange de monnaies, taux d\'échange';
$lang['Cmenu_cash_forums'] = 'Activer ou désactiver les monnaies pour chaque forum';
$lang['Cmenu_cash_groups'] = 'Réglages spécifiques par groupe d\'utilisateur, rang et niveaux';
$lang['Cmenu_cash_log'] = 'Voir/Effacer les Logs Cash';
$lang['Cmenu_cash_help'] = 'Aide Cash Mod';

// Config
$lang['Cash_config'] = 'Cash Mod - Configuration';
$lang['Cash_config_explain'] = 'Le formulaire ci-dessous vous permettra de configurer le Cash Mod.';

$lang['Cash_admincp'] = 'Mode Admin pour Cash Mod';
$lang['Cash_adminnavbar'] = 'Barre de Navigation Cash Mod';
$lang['Sidebar'] = 'Classique';
$lang['Menu'] = 'Menu';

$lang['Messages'] = 'Messages';
$lang['Spam'] = 'Spam';
$lang['Click_return_cash_config'] = 'Cliquez %sici%s pour retourner à la Configuration du Cash Mod';
$lang['Cash_config_updated'] = 'Configuration du Cash Mod Mise A Jour';
$lang['Cash_disabled'] = 'Désactiver le Cash Mod';
$lang['Cash_message'] = 'Montrer les gains dans l\'écran de confirmation de Post/Réponse';
$lang['Cash_display_message'] = 'Message indiquant les gains';
$lang['Cash_display_message_explain'] = 'Doit contenir exactement 1 "%s"';
$lang['Cash_spam_disable_num'] = 'Nombre de posts après lesquels désactiver les gains (prévention de spam)';
$lang['Cash_spam_disable_time'] = 'Période durant laquelle ce nombre doit être dépassé (heures)';
$lang['Cash_spam_disable_message'] = 'Message annonçant le spam et le gain zéro';

// Currencies
$lang['Cash_currencies'] = 'Cash Mod - Monnaies';
$lang['Cash_currencies_explain'] = 'Le formulaire ci-dessous vous permet de gérer vos monnaies.';

$lang['Click_return_cash_currencies'] = 'Cliquez %sici%s pour retourner aux monnaies du Cash Mod';
$lang['Cash_currencies_updated'] = 'Monnaies du Cash Mod Mises A Jour';
$lang['Cash_field'] = 'Champ';
$lang['Cash_currency'] = 'Monnaie';
$lang['Name_of_currency'] = 'Nom de la monnaie';
$lang['Default'] = 'Défaut';
$lang['Cash_order'] = 'Ordre';
$lang['Cash_set_all'] = 'Indiquer pour tous les utilisateurs';
$lang['Cash_delete'] = 'Effacer la monnaie';
$lang['Decimals'] = 'Centimes';

$lang['Cash_confirm_copy'] = 'Copier toutes les données d\'utilisateur de %s vers %s ?<br />Ceci ne peut pas être annulé après';
$lang['Cash_confirm_delete'] = 'Effacer %s ?<br />Ceci ne peut pas être annulé après';

$lang['Cash_copy_currency'] = 'Copier les données de la monnaie';

$lang['Cash_new_currency'] = 'Créer une nouvelle monnaie';
$lang['Cash_currency_dbfield'] = 'Champ de la base de données pour la monnaie';
$lang['Cash_currency_decimals'] = 'Nombre de décimales pour la monnaie';
$lang['Cash_currency_default'] = 'Montant par défaut pour la monnaie';

$lang['Bad_dbfield'] = 'Mauvais nom de champ, doit être de la forme \'user_mot\'<br /><br />%s<br /><br/>Exemples:<br />user_points<br />user_cash<br />user_cash<br />user_avertissements<br /><br />';

// 0 monnaies (la plupart des panneaux admin ne fonctionneront pas... )
$lang['Insufficient_currencies'] = 'Vous devez créer des monnaies avant de pouvoir modifier des règlages';

//
// Add-ons ?
//

// Evènements
$lang['Cash_events'] = 'Evènements Cash Mod';
$lang['Cash_events_explain'] = 'Le formulaire ci-dessous vous permettra de déterminer les gains de cash pour des évènements personnalisés.';

$lang['No_events'] = 'Aucun évènement créé';
$lang['Existing_events'] = 'Evènements Créés';
$lang['Add_an_event'] = 'Ajouter un évènement';
$lang['Cash_events_updated'] = 'Evènements Cash mis à jour';
$lang['Click_return_cash_events'] = 'Cliquez %sici%s pour retourner aux Evènements Cash';

//Remettre à zéro
$lang['Cash_reset_title'] = 'Remettre le Cash Mod à Zéro';
$lang['Cash_reset_explain'] = 'Le formulaire ci-dessous vous permettra de remettre les montants de tous les utilisateurs à zéro.';

$lang['Cash_resetting'] = 'Remise à zéro du cash';
$lang['User_of'] = 'Utilisateur %s sur %s';

$lang['Set_checked'] = 'Modifier monnaies sélectionnées';
$lang['Recount_checked'] = 'Recompter monnaies sélectionnées';

$lang['Cash_confirm_reset'] = 'Confirmer la remise à zéro des monnaies ?<br />Ceci ne peut pas être annulé après';
$lang['Cash_confirm_recount'] = 'Confirmer le recomptage des monnaies ?<br />Ceci ne peut pas être annulé après.<br /><br />Cette action n\'est pas conseillée pour les forums avec beaucoup d\'utilisateurs et/ou topics.<br /><br />Il est conseillé de désactiver votre forum pendant que cette action est en cours. <br />Vous pouvez désactiver votre forum dans la %sConfiguration%s';

$lang['Update_successful'] = 'Mise à jour terminée!';
$lang['Click_return_cash_reset'] = 'Cliquez %sici%s pour retourner à la Remise à Zéro du cash';
$lang['User_updated'] = '%s mis à jour<br />';

//
// Autres
//

// Echange
$lang['Cash_exchange'] = 'Cash Mod - Echange';
$lang['Cash_exchange_explain'] = 'Le formulaire ci-dessous vous permettra d\'indiquer la valeur relative de vos monnaies, et de permettre aux utilisateurs de faire des échanges.';

$lang['Exchange_insufficient_currencies'] = 'Vous n\'avez pas assez de monnaies pour créer des taux d\'échange.<br />Il vous en faut au moins deux';

// Forums
$lang['Forum_cm_settings'] = 'Cash Mod - Réglages Forum';
$lang['Forum_cm_settings_explain'] = 'A partir de ce panneau, vous pouvez indiquer quels forums utiliseront le Cash Mod';

// Groupes
$lang['Cash_groups'] = 'Cash Mod - Groupes';
$lang['Cash_groups_explain'] = 'A partir de ce panneau, vous pouvez indiquer des privilèges spéciaux par rang, groupe, administrateur ou modérateur';

$lang['Click_return_cash_groups'] = 'Cliquez %sici%s pour retourner aux Groupes Cash';
$lang['Cash_groups_updated'] = 'Groupes Cash mis à jour';

$lang['Set'] = 'Modifier';
$lang['Up'] = 'Haut';
$lang['Down'] = 'Bas';

// Aide
$lang['Cmh_support'] = 'Support Cash Mod';
$lang['Cmh_troubleshooting'] = 'Erreurs Communes';
$lang['Cmh_upgrading'] = 'Mise A Jour';
$lang['Cmh_addons'] = 'Add-Ons';
$lang['Cmh_demo_boards'] = 'Forums de Démo';
$lang['Cmh_translations'] = 'Traductions';
$lang['Cmh_features'] = 'Fonctions';

$lang['Cmhe_support'] = 'Information Générale';
$lang['Cmhe_troubleshooting'] = 'Si vous avez des problèmes avec le Cash Mod,regardez ici pour des corrections';
$lang['Cmhe_upgrading'] = 'Vous avez en ce moment la version %s, les mises à jour seront mises ici jusqu\'à la dernière version';
$lang['Cmhe_addons'] = 'Une liste de Mods utilisant les fonctions du Cash Mod';
$lang['Cmhe_demo_boards'] = 'Une liste de forums démo utilisant le Cash Mod';
$lang['Cmhe_translations'] = 'Une liste de traductions pour le Cash Mod';
$lang['Cmhe_features'] = 'Une liste de fonctions du Cash Mod, et développement pour les versions futures';

// Logs
$lang['Logs'] = 'Logs Cash Mod';
$lang['Logs_explain'] = 'A partir de ce panneau vous pourrez voir les logs d\'évènements concernants le Cash Mods';

// Réglages
$lang['Cash_settings'] = 'Réglages Cash Mod';
$lang['Cash_settings_explain'] = 'Le formulaire ci-dessous vous permettra de personnaliser les réglages monnaie.';


$lang['Display'] = 'Affichage';
$lang['Implementation'] = 'Implementation';
$lang['Allowances'] = 'Argent de Poche';
$lang['Allowances_explain'] = 'L\'argent de poche nécessite le plug-in Cash Mod Allowances';
$lang['Click_return_cash_settings'] = 'Cliquez %sici%s pour retourner aux réglages du Cash Mod';
$lang['Cash_settings_updated'] = 'Réglages du Cash Mod mis à jour';

$lang['Cash_enabled'] = 'Activer la monnaie';
$lang['Cash_custom_currency'] = 'Monnaie personnalisée pour Cash Mod';
$lang['Cash_image'] = 'Afficher la monnaie en tant qu\'image';
$lang['Cash_imageurl'] = 'Image (Relative au dossier de base de phpBB2):';
$lang['Cash_imageurl_explain'] = 'Utiliser ceci pour définir une petite image, associée avec la monnaie';
$lang['Prefix'] = 'Préfixe';
$lang['Postfix'] = 'Suffixe';
$lang['Cash_currency_style'] = 'Style de monnaie pour le Cash Mod';
$lang['Cash_currency_style_explain'] = 'Symbole de monnaie ' . $lang['Prefix'] . ' ou ' . $lang['Postfix'];
$lang['Cash_display_usercp'] = 'Montrer les gains dans les profils';
$lang['Cash_display_userpost'] = 'Montrer les gains dans les topics';
$lang['Cash_display_memberlist'] = 'Montrer les gains dans la liste de membres';

$lang['Cash_amount_per_post'] = 'Cash gagné par nouveau topic';
$lang['Cash_amount_post_bonus'] = 'Cash bonus gagné par réponse sur le topic';
$lang['Cash_amount_per_reply'] = 'Cash gagné par réponse';
$lang['Cash_amount_per_character'] = 'Cash gagné par caractère';
$lang['Cash_maxearn'] = 'Montant maximum gagné par réponse';
$lang['Cash_amount_per_pm'] = 'Cash gagné par message privé';
$lang['Cash_include_quotes'] = 'Inclure les citations en calculant le cash par caractère';
$lang['Cash_exchangeable'] = 'Permettre aux utilisateurs d\'échanger cette monnaie';
$lang['Cash_allow_donate'] = 'Permettre aux utilisateurs de donner du cash aux autres';
$lang['Cash_allow_mod_edit'] = 'Permettre aux modérateurs d\'éditer le cash des membres';
$lang['Cash_allow_negative'] = 'Autoriser les montants négatifs';

$lang['Cash_allowance_enabled'] = 'Activer l\'argent de poche';
$lang['Cash_allowance_amount'] = 'Montant gagné en tant qu\'argent de poche';
$lang['Cash_allownace_frequency'] = 'Fréquence de l\'argent de poche';
$lang['Cash_allownace_frequencies'][CASH_ALLOW_DAY] = 'Jour';
$lang['Cash_allownace_frequencies'][CASH_ALLOW_WEEK] = 'Semaine';
$lang['Cash_allownace_frequencies'][CASH_ALLOW_MONTH] = 'Mois';
$lang['Cash_allownace_frequencies'][CASH_ALLOW_YEAR] = 'Année';
$lang['Cash_allowance_next'] = 'Temps avant le prochain argent de poche';

// Groupes
$lang['Cash_status_type'][CASH_GROUPS_DEFAULT] = 'Défaut';
$lang['Cash_status_type'][CASH_GROUPS_CUSTOM] = 'Personnalisé';
$lang['Cash_status_type'][CASH_GROUPS_OFF] = 'Off';
$lang['Cash_status'] = 'Statut';

// Cash Mod Log Text
// Note: there isn't really a whole lot i can do about it, if languages use a
// grammar that requires these arguments (%s) to be in a different order, it's stuck in
// this order. The up side is that this is about 10x more comprehensive than the
// last way i did it.
//

/* argument order: [donater id][donater name][currency list][receiver id][receiver name]

eg.
Joe donated 14 gold, $10, 3 points to Peter
*/
$lang['Cash_clause'][CASH_LOG_DONATE] = '<a href="' . $phpbb_root_path . 'profile.' . $phpEx . ' ?mode=viewprofile&u=%s" target="_new"><b>%s</b></a> a donné <b>%s</b> à <a href="' . $phpbb_root_path . 'profile.' . $phpEx . ' ?mode=viewprofile&u=%s" target="_new"><b>%s</b></a>';

/* argument order: [admin/mod id][admin/mod name][editee id][editee name][Added list][removed list][Set list]

eg.
Joe modified Peter's Cash:
Added 14 gold
Removed $10
Set 3 points
*/
$lang['Cash_clause'][CASH_LOG_ADMIN_MODEDIT] = '<a href="' . $phpbb_root_path . 'profile.' . $phpEx . ' ?mode=viewprofile&u=%s" target="_new">%s</a> a modifié le cash de <a href="' . $phpbb_root_path . 'profile.' . $phpEx . ' ?mode=viewprofile&u=%s" target="_new"><b>%s</b></a>:<br />Ajouté <b>%s</b><br />Enlevé <b>%s</b><br />Mis à <b>%s</b>';

/* argument order: [admin/mod id][admin/mod name][currency name]

eg.
Joe created points 
*/
$lang['Cash_clause'][CASH_LOG_ADMIN_CREATE_CURRENCY] = '<a href="' . $phpbb_root_path . 'profile.' . $phpEx . ' ?mode=viewprofile&u=%s" target="_new"><b>%s</b></a> a créé les <b>%s</b>';

/* argument order: [admin/mod id][admin/mod name][currency name]

eg.
Joe deleted $ 
*/
$lang['Cash_clause'][CASH_LOG_ADMIN_DELETE_CURRENCY] = '<a href="' . $phpbb_root_path . 'profile.' . $phpEx . ' ?mode=viewprofile&u=%s" target="_new"><b>%s</b></a> a effacé les <b>%s</b>';

/* argument order: [admin/mod id][admin/mod name][old currency name][new currency name]

eg.
Joe renamed silver to gold
*/
$lang['Cash_clause'][CASH_LOG_ADMIN_RENAME_CURRENCY] = '<a href="' . $phpbb_root_path . 'profile.' . $phpEx . ' ?mode=viewprofile&u=%s" target="_new"><b>%s</b></a> a renommé <b>%s</b> en <b>%s</b>';

/* argument order: [admin/mod id][admin/mod name][copied currency name][copied over currency name]

eg.
Joe copied users' gold to points
*/
$lang['Cash_clause'][CASH_LOG_ADMIN_COPY_CURRENCY] = '<a href="' . $phpbb_root_path . 'profile.' . $phpEx . ' ?mode=viewprofile&u=%s" target="_new"><b>%s</b></a> a copié les <b>%s</b> du membre vers les <b>%s</b>';
$lang['Log'] = 'Log';
$lang['Action'] = 'Action';
$lang['Type'] = 'Type';
$lang['Cash_all'] = 'Tous';
$lang['Cash_admin'] = 'Admin';
$lang['Cash_user'] = 'Membre';
$lang['Delete_all_logs'] = 'Effacer les logs';
$lang['Delete_admin_logs'] = 'Effacer les logs admin';
$lang['Delete_user_logs'] = 'Effacer les logs membre';
$lang['All'] = 'Tous';
$lang['Day'] = 'Jour';
$lang['Week'] = 'Semaine';
$lang['Month'] = 'Mois';
$lang['Year'] = 'Année';
$lang['Page'] = 'Page';
$lang['Per_page'] = 'par page';

//
// Now for some regular stuff...
//

//
// User CP
//
$lang['Donate'] = 'Donner';
$lang['Mod_usercash'] = 'Modifier le cash de %s';
$lang['Exchange'] = 'Echange';

//
// Exchange
//
$lang['Convert'] = 'Convertir';
$lang['Select_one'] = 'En sélectionner une';
$lang['Exchange_lack_of_currencies'] = 'Il n\'y a pas assez de monnaies pour vous permettre d\'échanger<br />Pour utiliser cette fonction, votre admin doit créé au moins deux monnaies';
$lang['You_have'] = 'Vous avez';
$lang['One_worth'] = 'Un(e) %s vaut:';
$lang['Cannot_exchange'] = 'Vous ne pouvez échanger ceci : %s, actuellement';

//
// Donate
//
$lang['Amount'] = 'Montant';
$lang['Donate_to'] = 'Donner à %s';
$lang['Donation_recieved'] = 'Vous avez reçu une donation de %s';
$lang['Has_donated'] = '%s vous a donné [b]%s[/b]. \n\n%s a écrit:\n';

//
// Mod Edit
//
$lang['Add'] = 'Ajouter';
$lang['Remove'] = 'Effacer';
$lang['Omit'] = 'Exclure';
$lang['Amount'] = 'Montant';
$lang['Donate_to'] = 'Donner à %s';
$lang['Has_moderated'] = '%s a modéré vos %s';
$lang['Has_added'] = '[*]Ajouté: [b]%s[/b]\n';
$lang['Has_removed'] = '[*]Enlevé: [b]%s[/b]\n';
$lang['Has_set'] = '[*]Mis à : [b]%s[/b]\n';

// That's all folks!

?>