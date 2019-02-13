<?php
/***************************************************************************
 *                       lang_admin_portal.php [English]
 *                            -------------------
 *   begin                : Saturday, July 10, 2004
 *   copyright            : (C) 2004 masterdavid - Ronald John David
 *   website              : http://www.integramod.com
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
// IM Portal http://www.integramod.com
//
$lang['BP_Title'] = 'Balise de positionnement des blocs';
$lang['BP_Explain'] = 'Sur cette page, vous pouvez ajouter, éditer et effacer le positionnement des blocs utilisés sur le portail. Les positionnements par défaut sont \'en-tête\', \'pied de page\', \'droite\' et \'centre\'. Ces positionnements correspondent à la disposition utilisée pour une page par défaut du portail. Seules des positionnements existants par page de portail doivent être ajoutés ici. Les clés de positionnement qui n\'existent pas dans une disposition par défaut n\'apparaîtront pas sur le portail. Chaque balise de positionnement et de caractère doit être unique pour chaque page du portail.';
$lang['BP_Position'] = 'Position du caractère';
$lang['BP_Key'] = 'Clé de balise de positionnement';
$lang['BP_Layout'] = 'Page du portail';
$lang['BP_Add_Position'] = 'Ajouter un nouveau positionnement';
$lang['No_bp_selected'] = 'Aucun positionnement sélectionné pour l\'édition';
$lang['BP_Edit_Position'] = 'Editer le positionnement du bloc';
$lang['Must_enter_bp'] = 'Vous devez choisir une clé de balise de positionnement, une position de caractère et une page de portail !';
$lang['BP_updated'] = 'Positionnement du bloc mis à jour';
$lang['BP_added'] = 'Positionnement du bloc ajouté';
$lang['Click_return_bpadmin'] = 'Cliquez %sici%s pour retourner à l\'administration des positionnement des blocs';
$lang['BP_removed'] = 'Positionnement du bloc retiré';
$lang['Portal_wide'] = 'Portail étendu';

$lang['No_layout_selected'] = 'Aucune page du portail sélectionnée pour l\'édition';
$lang['Layout_Title'] = 'Page du portail';
$lang['Layout_Explain'] = 'Sur cette page, vous pouvez ajouter, éditer et effacer la disposition des informations pour vos pages du portail. Différentes pages du portail peuvent utiliser la même disposition. Le fichier de template sélectionné doit se trouver dans le répertoire de votre template. Vous n\'êtes pas autorisé à supprimer la page par défaut du portail (page d\'accueil). Supprimer une page du portail supprime aussi les positionnements de blocs correspondants et tous les blocs qui y sont rattachés.';
$lang['Layout_Name'] = 'Nom';
$lang['Layout_Template'] = 'Fichier de template';
$lang['Layout_Edit'] = 'Editer la page du portail';
$lang['Layout_Page'] = 'ID de la page';
$lang['Layout_View'] = 'Vue par';
$lang['Layout_Forum_wide'] = 'Blocs étendus ?';
$lang['Must_enter_layout'] = 'Vous devez entrer un nom et un fichier de template';
$lang['Layout_updated'] = 'Page du portail mise à jour';
$lang['Click_return_layoutadmin'] = 'Cliquez %sici%s pour retourner à l\'administration des pages du portail';
$lang['Layout_added'] = 'Page du portail ajoutée';
$lang['Layout_removed'] = 'Page du portail retirée';
$lang['Layout_Add'] = 'Ajouter une page de portail';
$lang['Layout_BP_added'] = 'Fichier de configuration de disposition disponible : Balises de positionnement de bloc automatiquement ajouté';
$lang['Layout_default'] = 'Disposition par défaut';
$lang['Layout_make_default'] = 'En faire la disposition par défaut';

$lang['Blocks_Title'] = 'Administration des blocs';
$lang['Blocks_Explain'] = 'Sur cette page, vous pouvez ajouter, éditer, effacer et déplacer les blocs pour chaque page de portail disponible. Un fichier template de bloc doit obligatoirement exister pour chaque bloc ajouté. Quand un fichier de bloc est spécifié, l\'affichage rempli n\'est pas pris en compte par le moteur du portail.';
$lang['Choose_Layout'] = 'Choisir une page de portail';
$lang['B_Title'] = 'Titre du bloc';
$lang['B_Position'] = 'Position du bloc';
$lang['B_Active'] = 'Actif ?';
$lang['B_Display'] = 'Affichage';
$lang['B_HTML'] = 'HTML';
$lang['B_BBCode'] = 'BBCode';
$lang['B_Type'] = 'Type';
$lang['B_Border'] = 'Montrer les bordures';
$lang['B_Titlebar'] = 'Montrer la barre de titre';
$lang['B_Background'] = 'Montrer la couleur de fond';
$lang['B_Local'] = 'Localiser la barre de titre';
$lang['B_Cache'] = 'Mettre en cache ?';
$lang['B_Cachetime'] = 'Durée du cache';
$lang['B_Groups'] = 'Groupes d\'utilisateurs';
$lang['B_All'] = 'Tous';
$lang['B_Guests'] = 'Seulement les invités';
$lang['B_Reg'] = 'Membres';
$lang['B_Mod'] = 'Modérateurs';
$lang['B_Admin'] = 'Administrateurs';
$lang['B_None'] = 'Aucun';
$lang['B_Layout'] = 'Page du portail';
$lang['B_Page'] = 'ID de la page';
$lang['B_Add'] = 'Ajouter des blocs';
$lang['Yes'] = 'Oui';
$lang['No'] = 'Non';
$lang['B_Text'] = 'Texte';
$lang['B_File'] = 'Fichier du bloc';
$lang['B_Move_Up'] = 'Remonter';
$lang['B_Move_Down'] = 'Descendre';
$lang['B_View'] = 'Vue par';
$lang['No_blocks_selected'] = 'Aucun bloc sélectionné';
$lang['B_Content'] = 'Contenu';
$lang['B_Blockfile'] = 'Fichier du bloc';
$lang['Block_Edit'] = 'Edition du bloc';
$lang['Block_updated'] = 'Bloc mis à jour';
$lang['Must_enter_block'] = 'Vous devez entrer un titre de bloc';
$lang['Block_added'] = 'Bloc ajouté';
$lang['Click_return_blocksadmin'] = 'Cliquez %sici%s pour retourner à l\'administration des blocs';
$lang['Block_removed'] = 'Bloc retiré';
$lang['B_BV_added'] = 'Fichier de configuration de bloc disponible. Variables du bloc automatiquement ajoutées.';

$lang['BV_Title'] = 'Variables des blocs';
$lang['BV_Explain'] = 'Sur cette page, vous pouvez ajouter, éditer, effacer des variables de configuration utilisés par les blocs dans le portail. Ces variables peuvent être configurées par la page de Configuration du portail, ce qui vous permettra de personnaliser votre portail.';
$lang['BV_Label'] = 'Label';
$lang['BV_Sub_Label'] = 'Infos';
$lang['BV_Name'] = 'Nom de configuration';
$lang['BV_Options'] = 'Options';
$lang['BV_Values'] = 'Valeur';
$lang['BV_Type'] = 'Type de contrôle';
$lang['BV_Block'] = 'Bloc';
$lang['BV_Add_Variable'] = 'Ajouter une variable de bloc';
$lang['No_bv_selected'] = 'Aucune variable de bloc sélectionnée';
$lang['BV_Edit_Variable'] = 'Editer la variable de bloc';
$lang['Must_enter_bv'] = 'Vous devez entrer un label et un champ de configuration';
$lang['BV_updated'] = 'Variable de bloc mise à jour';
$lang['BV_added'] = 'Variable de bloc ajoutée';
$lang['Click_return_bvadmin'] = 'Cliquez %sici%s pour retourner à l\'administration des variables des blocs';
$lang['Config_Name_Explain'] = 'Il ne doit pas y avoir d\'espace';
$lang['Field_Options_Explain'] = 'Obligation de listes à menus déroulants et<br />boutons radios (séparez par des virgules).';
$lang['Field_Values_Explain'] = 'Obligation de listes à menus déroulants et<br />boutons radios (séparez par des virgules).';
$lang['BV_removed'] = 'Variable de bloc retirée';

$lang['Config_updated'] = 'Configuration du portail mise à jour';
$lang['Click_return_config'] = 'Cliquez %sici%s pour retourner à l\'administration du portail';
$lang['Portal_Config'] = 'Configuration de l\'IM Portal';
$lang['Portal_Explain'] = 'De cette page, vous pouvez définir toutes les configurations nécessaires pour votre portail. Les variables de blocs affichés sur cette page peuvent être créés/mises à jour dans la page de configuration des variables de blocs';
$lang['Portal_General_Config'] = 'Configuration générale';
$lang['Default_Portal'] = 'Portail par défaut';
$lang['Default_Portal_Explain'] = 'Page d\'accueil (Portail principal)';
$lang['Cache_Enabled'] = 'Activer le système de cache';
$lang['Cache_Enabled_Explain'] = 'Pour un chargement plus rapide des informations sur le portail';
$lang['Portal_Header'] = 'Activer l\'en-tête sur toute la largeur du portail';
$lang['Portal_Header_Explain'] = 'Toujours montrer le panneau de gauche';
$lang['Portal_Tail'] = 'Activer le pied de page sur toute la largeur du portail';
$lang['Portal_Tail_Explain'] = 'Toujours montrer le panneau de droite';
$lang['Confirm_delete_item'] = 'Etes-vous sûr de vouloir effacer ce bloc';
$lang['Cache_cleared'] = 'Fichiers du cache effacés';

$lang['bbcode_b_help'] = 'Texte gras: [b]texte[/b] (alt+b)';
$lang['bbcode_i_help'] = 'Texte italique: [i]texte[/i] (alt+i)';
$lang['bbcode_u_help'] = 'Texte souligné: [u]texte[/u] (alt+u)';
$lang['bbcode_q_help'] = 'Citation: [quote]texte cité[/quote] (alt+q)';
$lang['bbcode_c_help'] = 'Afficher du code: [code]code[/code] (alt+c)';
$lang['bbcode_l_help'] = 'Liste: [list]texte[/list] (alt+l)';
$lang['bbcode_o_help'] = 'Liste ordonnée: [list=]texte[/list] (alt+o)';
$lang['bbcode_p_help'] = 'Insérer une image: [img]http://image_url/[/img] (alt+p)';
$lang['bbcode_w_help'] = 'Insérer un lien: [url]http://url/[/url] ou [url=http://url/]Nom[/url] (alt+w)';
$lang['bbcode_a_help'] = 'Fermer toutes les balises BBCode ouvertes';
$lang['bbcode_s_help'] = 'Couleur du texte: [color=red]texte[/color] Astuce: #FF0000 fonctionne aussi';
$lang['bbcode_f_help'] = 'Taille du texte: [size=x-small]texte en petit[/size]';

$lang['Emoticons'] = 'Smilies';
$lang['More_emoticons'] = 'Voir plus de Smilies';

$lang['Font_color'] = 'Couleur';
$lang['color_default'] = 'Défaut';
$lang['color_dark_red'] = 'Rouge foncé';
$lang['color_red'] = 'Rouge';
$lang['color_orange'] = 'Orange';
$lang['color_brown'] = 'Marron';
$lang['color_yellow'] = 'Jaune';
$lang['color_green'] = 'Vert';
$lang['color_olive'] = 'Olive';
$lang['color_cyan'] = 'Cyan';
$lang['color_blue'] = 'Bleu';
$lang['color_dark_blue'] = 'Bleu foncé';
$lang['color_indigo'] = 'Indigo';
$lang['color_violet'] = 'Violet';
$lang['color_white'] = 'Blanc';
$lang['color_black'] = 'Noir';

$lang['Font_size'] = 'Taille';
$lang['font_tiny'] = 'Très petit';
$lang['font_small'] = 'Petit';
$lang['font_normal'] = 'Normal';
$lang['font_large'] = 'Grand';
$lang['font_huge'] = 'Très grand';

$lang['Close_Tags'] = 'Fermer les Balises';
$lang['Styles_tip'] = 'Astuce: Une mise en forme peut être appliquée au texte sélectionné.';