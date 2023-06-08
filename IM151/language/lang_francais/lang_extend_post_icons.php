<?php
/***************************************************************************
 *						lang_extend_post_icons.php [French]
 *						--------------------------
 *	begin				: 28/09/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 1.0.1 - 28/10/2003
 *
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

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

// admin part
if ( $lang_extend_admin )
{
	$lang['Lang_extend_post_icons']		= 'Icônes de messages';

	$lang['Icons_settings_explain']		= 'Vous pouvez ici ajouter, éditer ou supprimer des icônes de messages.';
	$lang['Icons_auth']					= 'Niveau d\'autorisation';
	$lang['Icons_auth_explain']			= 'L\'icône ne sera accessible qu\'aux utilisateurs ayant au moins ce niveau d\'autorisation.';
	$lang['Icons_defaults']				= 'Utilisé par défaut';
	$lang['Icons_defaults_explain']		= 'Cette valeur sera utilisée sur la liste des sujets lorsqu\'aucune icône n\'a été définie spécifiquement pour ce sujet.';
	$lang['Icons_delete']				= 'Supprimer une icône';
	$lang['Icons_delete_explain']		= 'Choisissez une icône de remplacement pour celle-ci :';
	$lang['Icons_confirm_delete']		= 'Etes-vous sûr de vouloir supprimer cette icône ?';

	$lang['Icons_lang_key']				= 'Nom de l\'icône';
	$lang['Icons_lang_key_explain']		= 'Le contenu de cette zone sera affiché lorsque l\'utilisateur passera sa souris sur le lien ou sur l\'icône (mot clés HTML : title & alt). Vous pouvez entrer ici du texte, ou une clé du tableau des langues. <br />(se référer à language/lang_<i>votre_language</i>/lang_main.php)';
	$lang['Icons_icon_key']				= 'Icône';
	$lang['Icons_icon_key_explain']		= 'Lien vers une icône ou une clé du tableau des images ($images[]). <br />(se référer à templates/<i>votre_thème</i>/<i>votre_thème</i>.cfg)';

	$lang['Icons_error_title']			= 'Le nom de l\'icône est vide';
	$lang['Icons_error_del_0']			= 'Vous ne pouvez pas supprimer l\'icône vide par défaut.';

	$lang['Refresh']					= 'Réafficher';
	$lang['Usage']						= 'Utilisation';

	$lang['Image_key_pick_up']			= 'Choisir une clé du tableau des images';
	$lang['Lang_key_pick_up']			= 'Choisir une clé du tableau des langues';
}

$lang['Icons_settings']			= 'Icônes de messages';
$lang['Icons_per_row']			= 'Nombre d\'icône par ligne';
$lang['Icons_per_row_explain']	= 'Indiquez ici le nombre d\'icônes affichées par ligne dans l\'écran de postage.';
$lang['post_icon_title']		= 'Icône de messages';
// icons
$lang['post_icon_title']		= 'Icône de messages';
$lang['icon_none']				= 'pas d\'icône';
$lang['icon_note']				= 'Note';
$lang['icon_important']			= 'Important';
$lang['icon_idea']				= 'Idée';
$lang['icon_warning']			= 'Attention !';
$lang['icon_question']			= 'Question';
$lang['icon_cool']				= 'Détente';
$lang['icon_funny']				= 'Marrant';
$lang['icon_angry']				= 'Grrrr !';
$lang['icon_sad']				= 'Snif !';
$lang['icon_mocker']			= 'Héhéhé !';
$lang['icon_shocked']			= 'Oooh !';
$lang['icon_complicity']		= 'Complice';
$lang['icon_bad']				= 'Nul !';
$lang['icon_great']				= 'Génial !';
$lang['icon_disgusting']		= 'Beurk !';
$lang['icon_winner']			= 'Gniark !';
$lang['icon_impressed']			= 'Ah oui !';
$lang['icon_roleplay']			= 'Roleplay';
$lang['icon_fight']				= 'Combat';
$lang['icon_loot']				= 'Loot';
$lang['icon_picture']			= 'Image';
$lang['icon_calendar']			= 'Evénement du calendrier';

?>