<?php
/***************************************************************************
*						 lang_admin_color.php
*							--------------
*	begin		: 30/09/2005
*	copyright	: phantomk
*	email		: phantomk@modmybb.com
*
*	Version		: 0.0.6 - 24/1/2006
*
*	Translation	: rabbit
*	email		: support@tech-guide.info
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

if (!defined('IN_PHPBB'))
{
	die('Hacking attempt');
}

//
// CH Specific
//
$lang['Enable_cache_colors'] = 'Aktiviere Cache der Gruppenfarben-Tabelle';
$lang['Cache_succeed_colors'] = 'Gruppenfarben-Tabellen Cache erfolgreich. Der Cache wurde aktiviert.';
$lang['Cache_failed_colors'] = 'Gruppenfarben-Tabellen Cache fehlgeschlagen. Der Cache wurde deaktiviert.';

//
// Multi-Page
//
$lang['AGCM_colors'] = 'Farben';
$lang['AGCM_color_admin'] = 'Gruppenfarben Administration';
$lang['AGCM_color_admin_explain'] = 'Von hier aus kannst du unterschiedliche Farben f&uuml;r alle Gruppen und jedes Template ausw&auml;hlen. W&auml;hle, welche Gruppe in der Legende angezeigt werden soll und die Reihenfolge, in der sie dort angezeigt werden.';

//
// Style Select
//
$lang['AGCM_select_style'] = 'W&auml;hle ein Template';
$lang['AGCM_look_up_group_color'] = 'Gruppenfarben ansehen';
$lang['AGCM_edit_all'] = 'Edit all styles';

//
// Style Edit
//
$lang['AGCM_color'] = 'Gruppenfarbe:';
$lang['AGCM_color_explain'] = 'Gib einen 6-stelligen Farbcode ein f&uuml;r diese Gruppe oder klicke "Finde eine Farbe" und w&auml;hle aus der Palette.';
$lang['AGCM_edit_style'] = 'Bearbeite %s\'s Gruppenfarben'; // Edit subSilver's Group Colors
$lang['AGCM_find_color'] = 'Finde eine Farbe';
$lang['AGCM_legend'] = 'Zeige Gruppennamen in der Legende:';
$lang['AGCM_down'] = 'Schiebe runter';
$lang['AGCM_up'] = 'Schiebe hoch';
$lang['AGCM_session'] = 'Farbe inaktiver Benutzer:';
$lang['AGCM_session_explain'] = 'Gib einen 6-stelligen Farbcode ein, der f&uuml;r inaktive Benutzer angezeigt wird nach einer bestimmten Zeit, die sie nicht aktiv waren. Du kannst "Finde eine Farbe" klicken, um aus der Palette zu w&auml;hlen.';
$lang['AGCM_anonymous'] = 'Gast Farbe:';
$lang['AGCM_anonymous_explain'] = 'Gib einen 6-stelligen Farbcode ein f&uuml;r G&auml;ste oder klicke "Finde eine Farbe" und w&auml;hle aus der Palette.';
$lang['AGCM_registered'] = 'Farbe registrierter Benutzer:';
$lang['AGCM_registered_explain'] = 'Gib einen 6-stelligen Farbcode ein f&uuml;r registrierte Benutzer oder klicke "Finde eine Farbe" und w&auml;hle aus der Palette.';
$lang['AGCM_time'] = 'Bestimme Zeitpunkt f&uuml;r Inaktivit&auml;t:';
$lang['AGCM_time_explain'] = 'Bestimme die Zeit, nach der ein Benutzer in der definierten Farbe f&uuml;r inaktive Benutzer angezeigt wird. (G&auml;ste sind davon nicht betroffen)';
$lang['AGCM_check'] = 'Aktiviere oder deaktiviere die Sessionfarbe auf dem Board:';
$lang['AGCM_editing_all'] = 'Editing all styles';

//
// agcm_time select
//
$lang['AGCM_15_minute'] = '15 Minuten';
$lang['AGCM_1_hour'] = '1 Stunde';
$lang['AGCM_12_hour'] = '12 Stunden';
$lang['AGCM_1_day'] = '1 Tag oder 24 Stunden';
$lang['AGCM_2_day'] = '2 Tage oder 48 Stunden';
$lang['AGCM_1_week'] = '1 Woche oder 7 Tage';

//
// Messages
//
$lang['AGCM_click_return_color_admin'] = 'Klicke %shier%s um zur Gruppenfarben Administration zur&uuml;ckzukehren.'; // 'Here' is a link
$lang['AGCM_update_successfull'] = 'Die Gruppenfarben des Templates wurden erfolgreich aktualisiert';
$lang['AGCM_no_style_exists'] = 'Dieses Template existiert nicht.';

//
// Version Check
//
$lang['advanced_group_color_management'] = 'Advanced Group Color Management';
$lang['mod_up_to_date'] = 'Deine Installation vom %s ist aktuell, es liegen keine Updates vor';
$lang['mod_not_up_to_date'] = 'Deine Installation vom %s scheint <b>nicht</b> aktuell zu sein. Updates findest Du auf <a href="http://www.modmybb.com/" target="_new">http://www.modmybb.com/</a>.';
$lang['current_mod_version'] = 'Die aktuellste Version ist <b>%s</b>.';
$lang['installed_mod_version'] = 'Deine Version lautet <b>%s</b>.';
$lang['mod_version_information'] = 'ModMyBB installierte Mods - Versions Informationen';

?>