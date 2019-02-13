<?php
/***************************************************************************
 *						lang_extend_announces.php [French]
 *						-------------------------
 *	begin				: 28/09/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 1.0.0 - 28/09/2003
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
	$lang['Lang_extend_announces'] = 'Annonces';
}

$lang['Board_announcement']						= 'Annonces des forums';
$lang['announcement_duration']					= 'Durée d\'une annonce';
$lang['announcement_duration_explain']			= 'Nombre de jours avant qu\'une annonce ne redevienne un sujet normal. Utilisez -1 pour éviter cette opération.';
$lang['Announce_settings']						= 'Paramétrage des annonces';
$lang['announcement_date_display']				= 'Afficher les dates des annonces';
$lang['announcement_display']					= 'Afficher les annonces des forums dans l\'index';
$lang['announcement_display_forum']				= 'Afficher les annonces des forums au-dessus de la liste des sujets';
$lang['announcement_split']						= 'Séparer les différents types d\'annonces dans la boîte d\'annonces des forums';
$lang['announcement_forum']						= 'Afficher le nom du forum sous le titre de l\'annonce';
$lang['announcement_prune_strategy']			= 'Stratégie d\'épuration des annonces';
$lang['announcement_prune_strategy_explain']	= 'Renseignez ici ce que deviennent les annonces périmées.';

$lang['Global_announce']						= 'Annonce générale';
$lang['Sorry_auth_global_announce']				= 'Désolé, mais seuls les %s peuvent poster des annonces générales dans ce forum.';
$lang['Post_Global_Announcement']				= 'Annonce Générale';
$lang['Topic_Global_Announcement']				= '<b>Annonce Générale:</b>';

$lang['Announces_from_to']						= '(du %s au %s)';

?>