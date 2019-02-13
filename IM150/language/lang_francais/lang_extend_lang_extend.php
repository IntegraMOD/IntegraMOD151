<?php
/***************************************************************************
 *						lang_extend_lang_extend.php [French]
 *						------------------------------------
 *	begin				: 29/09/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 1.0.1 - 16/10/2003
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
	$lang['Lang_extend_lang_extend'] = 'Extension pour les packs de langues';

	$lang['Lang_extend__custom'] = 'Pack de langues personnalisé';
	$lang['Lang_extend__phpBB'] = 'Pack de langues phpBB (standard)';
	
	$lang['Languages'] = 'Langues';
	$lang['Lang_management'] = 'Gestion';
	$lang['Lang_extend'] = 'Gestion de l\'extension des langues';
	$lang['Lang_extend_explain'] = 'Ici vous pouvez ajouter ou modifier des clés de langues';
	$lang['Lang_extend_pack'] = 'Pack de langues';
	$lang['Lang_extend_pack_explain'] = 'Renseignez ici le nom du pack (généralement le nom du MOD auquel appartient ce pack de langue).';

	$lang['Lang_extend_entry'] = 'Clé de langues';
	$lang['Lang_extend_entries'] = 'Clés de langues';
	$lang['Lang_extend_level_admin'] = 'Admin';
	$lang['Lang_extend_level_normal'] = 'Normal';

	$lang['Lang_extend_add_entry'] = 'Ajouter une nouvelle clé';

	$lang['Lang_extend_key_main'] = 'Clé principale';
	$lang['Lang_extend_key_main_explain'] = 'Renseignez ici la clé de langue principale, la seule utilisée dans la majorité des cas.';
	$lang['Lang_extend_key_sub'] = 'Clé secondaire';
	$lang['Lang_extend_key_sub_explain'] = 'Renseignez ici la clé secondaire, généralement non utilisée.';
	$lang['Lang_extend_level'] = 'Niveau de la clé de langues';
	$lang['Lang_extend_level_explain'] = 'Le niveau admin ne peut être utilisé que dans le panneau d\'administration. Le niveau normal peut être utilisé partout.';

	$lang['Lang_extend_missing_value'] = 'Vous avez à fournir au minimum le libellé en anglais.';
	$lang['Lang_extend_key_missing'] = 'La clé principale est absente.';
	$lang['Lang_extend_duplicate_entry'] = 'Cette clé existe déjà (voir le pack %s).';

	$lang['Lang_extend_update_done'] = 'Cette clé de langue a été mise à jour.<br /><br />Cliquez %sici%s pour retourner à cette clé.<br /><br />Cliquez %sici%s pour retourner à la liste des clés.';
	$lang['Lang_extend_delete_done'] = 'Cette clé de langues a été supprimée.<br />Notez que seules les personnalisations sont supprimées, pas les clés existantes dans les packs.<br /><br />Cliquez %sici%s pour retourner à la liste des clés.';

	$lang['Lang_extend_search'] = 'Rechercher dans la liste des clés';
	$lang['Lang_extend_search_words'] = 'Mots à trouver';
	$lang['Lang_extend_search_words_explain'] = 'Séparez les mots par des espaces.';
	$lang['Lang_extend_search_all'] = 'Tous les mots';
	$lang['Lang_extend_search_one'] = 'Un parmi';
	$lang['Lang_extend_search_in'] = 'Rechercher dans';
	$lang['Lang_extend_search_in_explain'] = 'Précisez où chercher';
	$lang['Lang_extend_search_in_key'] = 'Clés';
	$lang['Lang_extend_search_in_value'] = 'Valeurs';
	$lang['Lang_extend_search_in_both'] = 'Les deux';
	$lang['Lang_extend_search_all_lang'] = 'Toutes les langues installées';

	$lang['Lang_extend_search_no_words'] = 'Vous n\'avez fourni aucun mot à rechercher.<br /><br />Cliquez %sici%s pour retourner à la liste des packs de langues.';
	$lang['Lang_extend_search_results'] = 'Résultats de la recherche';
	$lang['Lang_extend_value'] = 'Valeur';
	$lang['Lang_extend_level_leg'] = 'Niveau';

	$lang['Lang_extend_added_modified'] = '*';
	$lang['Lang_extend_modified'] = 'Modifié';
	$lang['Lang_extend_added'] = 'Ajouté';
}

?>