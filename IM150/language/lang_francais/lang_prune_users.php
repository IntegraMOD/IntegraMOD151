<?php 
/************************************************************* 
* MOD Title:   Prune users
* MOD Version: 1.4.2
* Translation: Français (French)
* Rev date:    19/12/2003 
* 
* Translator:  Kooky < kooky06@hotmail.com > (N/A) http://planetsport.nasov.net
* 
**************************************************************/

// add to prune inactive
$lang['X_Days'] = "%d jour(s)";
$lang['X_Weeks'] = "%d semaine(s)";
$lang['X_Months'] = "%d mois";
$lang['X_Years'] = "%d an(s)";

$lang['Prune_no_users']= 'Aucun utilisateur effac&eacute;';
$lang['Prune_users_number']='%d utilisateur(s) a(ont) &eacute;t&eacute; effac&eacute;(s), la liste des noms suit';

$lang['Prune_user_list'] = "Liste des utilisateurs affect&eacute;s";
$lang['Prune_on_click'] = 'Vous allez effacer %d utilisateurs, continuer?';
$lang['Prune_Action'] = "Sélectionnez le lien suivant pour ex&eacute;cuter";
$lang['Prune_users_explain'] = "A partir de cette page, vous pouvez nettoyer la liste des utilisateurs non activés de deux manières: vous pouvez nettoyer les utilisateurs qui n'ont jamais post&eacute; de message, ou ceux qui n'ont jamais visit&eacute; le site.<p/><b> Attention:</b> il sera impossible de revenir en arrière, les utilisateurs seront d&eacute;truits";
$lang['Prune_commands'] = array();

// here you can make more entrys if needed
$lang['Prune_commands'][0] = "Nettoyer les utilisateurs sans message";
$lang['Prune_explain'][0] = "Nettoyer les utilisateurs qui n'ont jamais post&eacute;, <b>excluant</b> les nouveaux inscrits des %d derniers jours";
$lang['Prune_commands'][1] = "Nettoyer les utilisateurs non activés";
$lang['Prune_explain'][1] = "Nettoyer les utilisateurs qui n'ont jamais revisit&eacute; le forum, <b>excluant</b> les nouveaux inscrits des %d derniers jours";
$lang['Prune_commands'][2] = "Nettoyer les utilisateurs jamais activ&eacute;s";
$lang['Prune_explain'][2] = "Nettoyer les utilisateurs qui se sont inscrits mais qui n'ont jamais activ&eacute; leur compte, <b>excluant</b> les nouveaux inscrits des %d derniers jours";
$lang['Prune_commands'][3] = 'Nettoyer les utilisateurs occasionnels';
$lang['Prune_explain'][3] = 'Qui ne sont pas venus sur le forum depuis 60 jours, <b>Excluant</b> les nouveaux inscrits des %d derniers jours';
$lang['Prune_commands'][4] = 'Nettoyer les utilisateurs qui ne postent qu\'occasionnellement';
$lang['Prune_explain'][4] = 'Qui ont moins d\'un post tous les dix jours depuis leur enregistrement, <b>excluant</b> les nouveaux inscrits des %d derniers jours';

?>
