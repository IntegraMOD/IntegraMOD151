<?php
/***************************************************************************
 *						lang_extend_sub_template.php [English]
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
	$lang['Lang_extend_sub_template']	= 'Unter-Templates';

	$lang['Subtemplate']				= 'Unter-Templates';
	$lang['Subtemplate_explain']		= 'Hier kannst du ein Unter-Template einer Katergorie oder einem Forum hinzufügen';
	$lang['Choose_main_style']			= 'Wähle ein Hauptstyle aus';
	$lang['main_style']					= 'Hauptstyle';
	$lang['subtpl_name']				= 'Unter-Template Name';
	$lang['subtpl_dir']					= 'Unter-Template Ordner';
	$lang['subtpl_imagefile']			= 'Bilder Kofigurations-Datei';
	$lang['subtpl_create']				= 'Neues Unter-Template hinzufügen';
	$lang['subtpl_usage']				= 'Unter-Templates Verknüpfungen';
	$lang['Select_dir']					= 'Ein Ordner auswählen';

	$lang['subtpl_error_name_missing']	= 'Unter-Template Name nicht angegeben';
	$lang['subtpl_error_dir_missing']	= 'Unter-Template Ordner nicht angegeben';
	$lang['subtpl_error_no_selection']	= 'Es wurde nichts ausgewählt um das Unter-Template zu verknüpfen';

	$lang['subtpl_click_return']		= 'Die Einstellungen des Unter-Templates wurden erfolgreich aktualisiert. Klicke %shier%s um zur Unter-Template Administration zurückzukehren';
}

?>