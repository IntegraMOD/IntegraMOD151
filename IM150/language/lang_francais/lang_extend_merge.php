<?php
/***************************************************************************
 *						lang_extend_merge.php [French]
 *						------------------------------
 *	begin				: 28/09/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 1.0.1 - 21/10/2003
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
	$lang['Lang_extend_merge'] = 'Fusion de sujets';
}

$lang['Refresh'] = 'Actualiser';
$lang['Merge_topics'] = 'Fusionner les sujets';
$lang['Merge_title'] = 'Nouveau titre du sujet';
$lang['Merge_title_explain'] = 'Saisissez ici le nouveau titre du sujet, ou laissez cette zone vide si vous voulez que le système utilise le titre du topic de destination.';
$lang['Merge_topic_from'] = 'Sujet à fusionner';
$lang['Merge_topic_from_explain'] = 'Ce sujet sera fusionné. Vous pouvez saisir le n° de sujet, le lien vers le sujet ou le lien vers un post de ce sujet.';
$lang['Merge_topic_to'] = 'Sujet d\'accueil';
$lang['Merge_topic_to_explain'] = 'Ce sujet recevra tous les messages du sujet fusionné. Vous pouvez saisir le n° de sujet, le lien vers le sujet ou le lien vers un post de ce sujet.';
$lang['Merge_from_not_found'] = 'Le sujet à fusionner n\'a pas été trouvé';
$lang['Merge_to_not_found'] = 'Le sujet d\'accueil n\'a pas été trouvé';
$lang['Merge_topics_equals'] = 'Vous ne pouvez pas fusionner un sujet avec lui-même';
$lang['Merge_from_not_authorized'] = 'Vous n\'êtes pas autorisé à modérer le forum du sujet à fusionner';
$lang['Merge_to_not_authorized'] =  'Vous n\'êtes pas autorisé à modérer le forum du sujet d\'accueil';
$lang['Merge_poll_from'] = 'Il y a un sondage sur le sujet à fusionner. Il sera copier sur le sujet d\'accueil';
$lang['Merge_poll_from_and_to'] = 'Le sujet d\'accueil a déjà un sondage. Le sondage du sujet à fusionner sera donc supprimé';
$lang['Merge_confirm_process'] = 'Etes-vous sûr de vouloir fusionner<br />"<b>%s</b>"<br />avec<br />"<b>%s</b>"';
$lang['Merge_topic_done'] = 'Les sujets ont été fusionnés avec succès.';
$lang['Leave_shadow_topic'] = 'Laissez un sujet traceur dans l\'ancien forum.';
?>