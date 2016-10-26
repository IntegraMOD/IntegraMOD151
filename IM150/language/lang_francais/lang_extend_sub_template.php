<?php
/***************************************************************************
 *						lang_extend_sub_template.php [French]
 *						----------------------------
 *	begin				: 28/09/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 1.0.4 - 28/10/2003
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
	$lang['Lang_extend_sub_template'] = 'Sous-templates';

	$lang['Subtemplate'] = 'Sous-templates';
	$lang['Subtemplate_explain'] = 'Ici vous vouvez attacher un sous-template à des forums ou des catégories';
	$lang['Choose_main_style'] = 'Choisissez un thème principal';
	$lang['main_style'] = 'Thème principal';
	$lang['subtpl_name'] = 'Nom du sous-template';
	$lang['subtpl_dir'] = 'Répertoire du sous-template';
	$lang['subtpl_imagefile'] = 'Fichier de configuration des images';
	$lang['subtpl_create'] = 'Créer un nouveau sous-template';
	$lang['subtpl_usage'] = 'Sous-template utilisé dans';
	$lang['Select_dir'] = 'Choisissez un répertoire';

	$lang['subtpl_error_name_missing'] = 'Le nom du sous-template est obligatoire';
	$lang['subtpl_error_dir_missing'] = 'Le répertoire du sous-template est obligatoire';
	$lang['subtpl_error_no_selection'] = 'Vous n\'avez sélectionné ce sous-template dans aucun forum ou catégorie';

	$lang['subtpl_click_return'] = 'Mise à jour effectuée. Cliquez %sici%s pour retourner à l\'écran d\'administration des sous-templates';
}

?>