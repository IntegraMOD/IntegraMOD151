<?php
/***************************************************************************
 *						lang_extend_merge.php [English]
 *						-------------------------------
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
/***************************************************************************
 *
 *   german translation	:		clanpunisher
 *
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die("Hacking Versuch");
}

// admin part
if ( $lang_extend_admin )
{
	$lang['Lang_extend_merge'] = 'einfach Themen vereinen';
}

$lang['Refresh'] = 'Neu Laden';
$lang['Merge_topics'] = 'Vereine Themen';
$lang['Merge_title'] = 'Neuer Thementitel';
$lang['Merge_title_explain'] = 'Dies wird der neue Titel des Themas. Lass das Feld leer, falls du den Titel des Zielthemas verwenden möchtest.';
$lang['Merge_topic_from'] = 'Zuvereinendes Thema';
$lang['Merge_topic_from_explain'] = 'Dieses Thema wird mit anderen Themen vereint. Du kannst die Themen id angeben, die url des Themas, oder die url des Posts in diesem Thema.';
$lang['Merge_topic_to'] = 'Zielthema';
$lang['Merge_topic_to_explain'] = 'Dieses Thema erhält alle Posts der vorhergehenden Themen. Du kannst die Themen id angeben, die url des Themas, oder die url des Posts in diesem Thema.';
$lang['Merge_from_not_found'] = 'Das zuvereinende Thema konnte nicht gefunden werden.';
$lang['Merge_to_not_found'] = 'Das Zielthema konnte nicht gefunden werden.';
$lang['Merge_topics_equals'] = 'Du kannst kein Thema mit sich selbst vereinen.';
$lang['Merge_from_not_authorized'] = 'Du hast keine Rechte Themen zu vereinen.';
$lang['Merge_to_not_authorized'] =  'Du hast keine Rechte Zielthemen zu bearbeiten.';
$lang['Merge_poll_from'] = 'Es gibt eine Umfrage in dem zuvereinendem Thema. Es wird auf das Zielthema kopiert.';
$lang['Merge_poll_from_and_to'] = 'Das Zielthema hat bereits eine Umfrage. Die Umfrage des Themas welches vereint werden soll wird gelöscht werden.';
$lang['Merge_confirm_process'] = 'Möchtest du dennoch das Thema vereinen? Von <br />"<b>%s</b>"<br />nach<br />"<b>%s</b>"';
$lang['Merge_topic_done'] = 'Die Themen wurde erfolgreich vereint.';
$lang['Leave_shadow_topic'] = 'Leave shadow topic in old forum.';

?>