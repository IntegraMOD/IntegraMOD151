<?php
/****************************************************************
 *		lang_extend_categories_hierarchy.php [Nederlands]
 *		------------------------------------
 *	begin				: 28/09/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 1.0.1 - 10/11/2003
 *
 *   Nederlandse vertaling  : Maart 2005 
 *   The Dutch Team         : http://www.integramod.nl 
 * 
 *   note: removing the original copyright is illegal even you 
 *         have modified the code. Just append yours if you
 *         have modified it. 
 ****************************************************************/ 

/****************************************************************
 *
 *   This program is free software; you can redistribute it and/or
 *   modify it under the terms of the GNU General Public License as
 *   published by the Free Software Foundation; either version 2
 *   of the License, or (at your option) any later version.
 *
 ****************************************************************/

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

// admin part
if ( $lang_extend_admin )
{
	$lang['Lang_extend_categories_hierarchy']		= 'Categorieën Hierarchy';

	$lang['Category_attachment']					= 'Koppelen aan';
	$lang['Category_desc']							= 'Omschrijving';
	$lang['Category_config_error_fixed']			= 'Een error in de categorieën setup is hersteld';
	$lang['Attach_forum_wrong']						= 'Je kunt geen forum koppelen aan een forum';
	$lang['Attach_root_wrong']						= 'Je kunt geen forum koppelen aan de forum index';
	$lang['Forum_name_missing']						= 'Je kunt geen forum maken zonder naam';
	$lang['Category_name_missing']					= 'Je kunt geen categorie maken zonder naam';
	$lang['Only_forum_for_topics']					= 'Onderwerpen kunnen alleen in forums geplaatst worden';
	$lang['Delete_forum_with_attachment_denied']	= 'Je kunt geen forums verwijderen die een sub-niveau hebben';

	$lang['Category_delete']						= 'Verwijder Categorie';
	$lang['Category_delete_explain']				= 'Het onderstaande formulier steld je in staat om een categorie te verwijderen en te beslissen waar je de forums & categorieën die het bevat wilt plaatsen.';

	// forum links type
	$lang['Forum_link_url']							= 'Link URL';
	$lang['Forum_link_url_explain']					= 'Hier kan je een URL naar een phpBB programma  plaatsen, of een volledige URL naar een externe server';
	$lang['Forum_link_internal']					= 'phpBB programma';
	$lang['Forum_link_internal_explain']			= 'Kies ja als je naar een programma linkt dat in de phpBB mappen staat';
	$lang['Forum_link_hit_count']					= 'Hit teller';
	$lang['Forum_link_hit_count_explain']			= 'Kies ja als je wil dat het board het aantal klikken op de link bijhoudt en toont';
	$lang['Forum_link_with_attachment_deny']		= 'Je kunt een forum niet veranderen naar een link als het al sub-niveaus heeft';
	$lang['Forum_link_with_topics_deny']			= 'Je kunt een forum niet veranderen naar een link als het al onderwerpen bevat';
	$lang['Forum_attached_to_link_denied']			= 'Je kunt geen categorie of forum onderverdelen in een link';

	$lang['Manage_extend']							= 'Beheer +';
	$lang['No_subforums']							= 'Geen sub-forums';
	$lang['Forum_type']								= 'Kies het forum type';
	$lang['Presets']								= 'Vooraf ingesteld';
	$lang['Refresh']								= 'Vernieuw';
	$lang['Position_after']							= 'Plaats dit forum na';
	$lang['Link_missing']							= 'De link bestaat niet';
	$lang['Category_with_topics_deny']				= 'Onderwerp blijft in dit forum. Je kunt het niet veranderen in een categorie.';
	$lang['Recursive_attachment']					= 'Je kunt een forum niet koppelen aan het laagste niveau van zijn eigen tak zichzelf (recursief koppelen)';
	$lang['Forum_with_attachment_denied']			= 'Je kunt een categorie met gekoppelde forums niet veranderen in een forum';
	$lang['icon']									= 'Icoon';
	$lang['icon_explain']							= 'Dit icoon zal getoond worden voor de forum titel. Je kunt een directe URI invoeren of een $image[] key entrie (zie <i>je_template</i>/<i>je_template</i>.cfg).';

	// merging of Categories Hierarchy ACP and Points MOD
	$lang['Yes']									= 'Ja';
	$lang['No']										= 'Nee';
	$lang['Forum_points']							= 'Uitschakelen ' . $board_config['points_name'];
}

$lang['Category_locked'] 			= 'Deze categorie is gesloten: je kunt niet plaatsen, beantwoorden, of onderwerpen te bewerken.';
$lang['Forum_link']					= 'Link door schakeling';
$lang['Forum_link_visited']			= 'Deze link is %d maal bezocht';
$lang['Redirect']					= 'Door schakeling';
$lang['Redirect_to']				= 'Als je browser geen meta door schakeling toestaat, klik dan %sHIER%s om door geschakeld te worden';

$lang['Use_sub_forum']				= 'Index packing';
$lang['Hierarchy_setting']			= 'Categories Hierarchy instellingen';
$lang['Index_packing_explain']		= 'Kies het niveau van packing dat je wil op de index';
$lang['Medium']						= 'Medium';
$lang['Full']						= 'Volledig';
$lang['Split_categories']			= 'Splits categorieën in de index';
$lang['Use_last_topic_title']		= 'Toon de laatste onderwerp titels in de index';
$lang['Last_topic_title_length']	= 'Titel lengte van het laatste onderwerp in de index';
$lang['Sub_level_links']			= 'Sub-level links in de index';
$lang['Sub_level_links_explain']	= 'Voeg de links aan de sub-levels toe in het forum of de categoriebeschrijving';
$lang['With_pics']					= 'Met icoontjes';
$lang['Display_viewonline']			= 'Toon de viewonline-informatie op de index';
$lang['Never']						= 'Nooit';
$lang['Root_index_only']			= 'In de root index alleen';
$lang['Always']						= 'Altijd';
$lang['Subforums']					= 'Subforums';

//-- mod : today at   yesterday at ------------------------------------------------------------------------ 
//-- add 
$lang['Today_at'] = '<b>Vandaag</b> om %s'; // %s is the time 
$lang['Future'] = '[ <b>Toekomst</b> ]<br /> %s'; // %s is the time 
$lang['Yesterday_at'] = '<b>Gisteren</b> om %s'; // %s is the time 
//-- end mod : today at   yesterday at ------------------------------------------------------------------------ 

?>