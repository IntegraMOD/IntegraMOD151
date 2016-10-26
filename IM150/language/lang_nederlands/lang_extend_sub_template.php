<?php
/***************************************************************************
 *						lang_extend_sub_template.php [Nederlands]
 *						----------------------------
 *	begin				: 28/09/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 1.0.4 - 28/10/2003
 *
 *   Nederlandse vertaling  : Maart 2005 
 *   The Dutch Team         : http://www.integramod.nl
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
$lang['Lang_extend_sub_template']	= 'Sub-template';

$lang['Subtemplate']			= 'Sub-templates';
$lang['Subtemplate_explain']		= 'Hier kun je sub-templates linken aan een categorie of een forum';
$lang['Choose_main_style']		= 'Kies een hoofdstijl';
$lang['main_style']			= 'Hoofdstijl';
$lang['subtpl_name']			= 'Sub-template naam';
$lang['subtpl_dir']			= 'Sub-template directorie';
$lang['subtpl_imagefile']		= 'Afbeeldingen Configuratie bestand';
$lang['subtpl_create']			= 'Voeg een nieuwe sub-template toe';
$lang['subtpl_usage']			= 'Sub-templates gebruikt in';
$lang['Select_dir']			= 'Selecteer een directorie';

$lang['subtpl_error_name_missing']	= 'De sub-template naam ontbreekt';
$lang['subtpl_error_dir_missing']	= 'De sub-template directorie ontbreekt';
$lang['subtpl_error_no_selection']	= 'Er is niets geselecteerd om deze sub-template op toe te passen';

$lang['subtpl_click_return']		= 'Bijgewerkt. Klik %sHier%s om terug te keren naar sub-template beheer';
}

?>