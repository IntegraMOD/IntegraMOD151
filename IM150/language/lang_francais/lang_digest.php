<?php

/***************************************************************************
 *                           lang_digest.php [English]
 *                              -------------------
 *   begin                : Tuesday, April 6, 2004
 *   copyright            : (C) 2004 masterdavid - Ronald John David
 *   website			  : http://www.integramod.com
 *   email                : webmaster@integramod.com
 *
 *   note: removing the original copyright is illegal even you have modified
 *         the code.  Just append yours if you have modified it.
 ***************************************************************************/


/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

//
// Digests MOD
//
// This block is for general lang definitions
$lang['Digests'] = '"Quoi de neuf ?"';
$lang['digest_options'] = 'Options du "Quoi de neuf"';
$lang['digest_format'] = 'Format';
$lang['digest_show_message_text'] = 'Montrer message texte';
$lang['digest_show_my_messages'] = 'Montrer mes messages';
$lang['digest_frequency'] = 'Fréquence du "Quoi de neuf ?"';
$lang['digest_new_only'] = 'Afficher seulement les nouveaux messages depuis ma derniere connection'; 
$lang['digest_send_empty'] = 'Envoyer les "Quoi de neuf?" même vide';
$lang['digest_message_size'] = 'Caractères maximum dans le message du "Quoi de neuf?"';  

// This block is for lang specific to mail_digests.php
$lang['digest_introduction'] = "Comme vous l\'avez demandé, voici le dernier sommaire des messages signalés sur les forum de %s. N'hésitez pas rejoindre les discussions en cours !"; 
$lang['digest_disclaimer_html'] = "Ce \"Quoi de neuf?\" est envoyé aux membres enregistrés du %s forum et seulement parce que vous l'avez explicitement demandé. %s est complètement en libre. Votre adresse email ne sera jamais divulguée. Voir notre %sFAQ%s pour de plus amples informations sur notre politique sur la vie privée. Vous pouvez changer ou supprimer votre abonnement dans %s dans le %sSommaire%s (vous devrez être connecté pour changer vos paramètres). Si vous avez des questions sur le format de ce sommaire veuillez contacter le %sWebmaster%s."; 
$lang['digest_disclaimer_text'] = "Ce \"Quoi de neuf?\" est envoyé aux membres enregistrés du %s forum et seulement parce que vous l'avez explicitement demandé. %s est complètement en libre. Votre adresse email ne sera jamais divulguée. Voir notre FAQ pour plus ample d'information sur notre politique sur la vie privée. Vous pouvez changer ou supprimer votre abonnement dans le %s Sommaire (vous devrez être connecté pour changer vos paramètres). Si vous avez des questions ou sur le format de ce sommaire veuillez contacter le Webmaster."; 
$lang['digest_salutation'] = 'Cher (chère)'; 
$lang['Digest_Read_More'] = 'Lire la suite...';

// This block is for lang specific to digests.php
$lang['digest_explanation'] = 'Le "Quoi de neuf?" est un email reçu périodiquement. Il résume les nouveaux messages postés sur le site.<br /><br />Vous pouvez naturellement annuler votre abonnement à tout moment en revenant simplement sur cette page.<br/><br/>La plupart des utilisateurs trouvent que c\'est fort utile. Nous vous encourageons à essayer !'; 
$lang['digest_html'] = 'HTML';
$lang['digest_text'] = 'Texte';
$lang['digest_format_desc'] = 'Le HTML est fortement recommandé à moins que votre logiciel de messagerie ne puisse pas afficher le HTML'; 
$lang['digest_new_only_desc'] = 'Ceci filtrera tous les messages postés avant la date et l\'heure où vous avez visité les forums pour la dernière fois. Afin d\'éviter que les messages déjà lus ne soient inclus dans le sommaire.'; 
$lang['digest_frequency_desc'] = 'Saisir le nombre d\'heures à attendre avant d\'envoyer le prochain email. Ou saisir 0 pour ne plus recevoir de "Quoi de neuf?"';
//$lang['digest_send_desc'] = 'C\'est le temps basé sur le fuseau horaire que vous avez choisie dans votre profil. Si vous changez votre fuseau horaire dans votre profil et que vous voulez que les sommaires arrivent la meme date , changez alors cette valeur aussi.'; 
$lang['digest_size_desc'] = 'Attention : le réglage de cette option peut entrainer des sommaires très longs. Un lien, pour chaque message, vous permettra de voir le message complet.'; 
$lang['digest_select_forums']='Envoyer résumés pour ces forums';
$lang['digest_create']='Vos paramètres ont été correctement pris en compte';
$lang['digest_modify']='Vos paramètres ont été correctement modifiés';
$lang['digest_unsubscribe']='Vous n\'êtes plus abonnés, vous ne recevrez plus de "Quoi de neuf?"';
$lang['digest_no_forums_selected']='Vous n\'avez sélectionné aucun forum, vous n\'êtes donc pas abonné';
$lang['digest_all_forums']='Surveiller tous les forums';
$lang['digest_submit_text']='Appliquer les changements';
$lang['Digest_frequency_bounds'] = 'La fréquence de réception saisie doit être comprise entre $d et $d';
$lang['tl']['50'] = '50';
$lang['tl']['150'] = '150';
$lang['tl']['300'] = '300';
$lang['tl']['500'] = '500';
$lang['tl']['1000'] = '1000';
$lang['tl']['-1'] = 'Message entier';
//
// End Digests MOD
//

?>
