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

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

// admin part
if ( $lang_extend_admin )
{
	$lang['Lang_extend_sub_template']	= 'Sub-template';

	$lang['Subtemplate']				= 'Sub-templates';
	$lang['Subtemplate_explain']		= 'Here you can attach sub-templates to a category or a forum';
	$lang['Choose_main_style']			= 'Choose a main style';
	$lang['main_style']					= 'Main style';
	$lang['subtpl_name']				= 'Sub-template name';
	$lang['subtpl_dir']					= 'Sub-template directory';
	$lang['subtpl_imagefile']			= 'Images config file';
	$lang['subtpl_create']				= 'Add a new sub-template';
	$lang['subtpl_usage']				= 'Sub-templates used in';
	$lang['Select_dir']					= 'Select a directory';

	$lang['subtpl_error_name_missing']	= 'The sub-template name is missing';
	$lang['subtpl_error_dir_missing']	= 'The sub-template dir is missing';
	$lang['subtpl_error_no_selection']	= 'There nothing selected to apply this sub-template';

	$lang['subtpl_click_return']		= 'Update done. Click %sHere%s to return to the sub-template administration';
}

?>