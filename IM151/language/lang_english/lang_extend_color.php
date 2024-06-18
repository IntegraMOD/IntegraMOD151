<?php
/***************************************************************************
*						 lang_extend_color.php
*							--------------
*	begin		: 2006/02/09
*	copyright	: phantomk
*	email		: phantomk@hackbb.com
*
*	Version		: 0.0.2 - 2006/06/02
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
	die('Hacking attempt');
}

if ( !empty($is['admin']) || !defined('CH_CURRENT_VERSION') )
{
	//
	// CH Specific
	//
	$lang['Enable_cache_ch_color'] = 'Enable group colors table cache';
	$lang['Cache_succeed_ch_color'] = 'Group colors table cache succeed. The cache has been enabled.';
	$lang['Cache_failed_ch_color'] = 'Group colors table cache failed. The cache has been disabled.';

	//
	// Multi-Page
	//
	$lang['AGCM_colors'] = 'Colors';
	$lang['AGCM_color_admin'] = 'Group Color Administration';
	$lang['AGCM_color_admin_explain'] = 'From this panel you can select different colors for all the groups for each style, select if each group is displayed in the legend, and the order of which they are displayed in the legend.';

	//
	// Style Select
	//
	$lang['AGCM_select_style'] = 'Select a Style';
	$lang['AGCM_look_up_group_color'] = 'Look up group colors';
	$lang['AGCM_edit_all'] = 'Edit all styles';

	//
	// Style Edit
	//
	$lang['AGCM_color'] = 'Group Color:';
	$lang['AGCM_color_explain'] = 'Enter a 6 digit color code for this group or you can click on "Find a Color" to choose a color from the color picker.';
	$lang['AGCM_edit_style'] = 'Edit %s\'s Group Colors'; // Edit subSilver's Group Colors
	$lang['AGCM_find_color'] = 'Find a Color';
	$lang['AGCM_display_legend'] = 'Group Displayed in Legend:';
	$lang['AGCM_down'] = 'Move Down';
	$lang['AGCM_up'] = 'Move Up';
	$lang['AGCM_session'] = 'Inactive User\'s Color:';
	$lang['AGCM_session_explain'] = 'Enter a 6 digit color code for Inactive Users or you can click on "Find a Color" to choose a color from the color picker.  Inactive User\'s are defined by the Inactive Session Time and can be disabled.';
	$lang['AGCM_anonymous'] = 'Anonymous User\'s Color:';
	$lang['AGCM_anonymous_explain'] = 'Enter a 6 digit color code for Anonymous Users or you can click on "Find a Color" to choose a color from the color picker.';
	$lang['AGCM_registered'] = 'Registered User\'s Color:';
	$lang['AGCM_registered_explain'] = 'Enter a 6 digit color code for Registered Users or you can click on "Find a Color" to choose a color from the color picker.';
	$lang['AGCM_time'] = 'Inactive Session Time:';
	$lang['AGCM_time_explain'] = 'Assign the time that a users color will change to if they have been inactive on the board for the defined time. (Anonymous users are unaffected)';
	$lang['AGCM_check'] = 'Enable the session color on the board:';
	$lang['AGCM_editing_all'] = 'Editing all styles';
	$lang['AGCM_style_explain'] = 'Effect\'s you can add whenever a group/user is displayed as a link: ';
	$lang['AGCM_hover_style_explain'] = 'Effect\'s you can add when you hover over a group/user link: ';
	$lang['AGCM_bold'] = 'Bold: ';
	$lang['AGCM_italic'] = 'Italic: ';
	$lang['AGCM_underline'] = 'Underline';

	//
	// agcm_time select
	//
	$lang['AGCM_second'] = 'second\'s';
	$lang['AGCM_minute'] = 'minute\'s';
	$lang['AGCM_hour'] = 'hour\'s';
	$lang['AGCM_day'] = 'day\'s';
	$lang['AGCM_week'] = 'week\'s';

	//
	// Messages
	//
	$lang['AGCM_click_return_color_admin'] = 'Click %sHere%s to return to the Colors Group Administration.'; // 'Here' is a link
	$lang['AGCM_update_successfull'] = 'The Theme group colors were successfully updated';
	$lang['AGCM_no_style_exists'] = 'No such style exists.';

	//
	// Version Check
	//
	$lang['advanced_group_color_management'] = 'Advanced Group Color Management';
	$lang['mod_up_to_date'] = 'Your installation of %s is up to date, no updates are available';
	$lang['mod_not_up_to_date'] = 'Your installation of %s does <b>not</b> seem to be up to date. Updates are available at <a href="http://www.modmybb.com/" target="_new">http://www.modmybb.com/</a>.';
	$lang['current_mod_version'] = 'The latest available version is <b>%s</b>.';
	$lang['installed_mod_version'] = 'You are running version <b>%s</b>.';
	$lang['mod_version_information'] = 'ModMyBB Installed Mods Version Information';

	//
	// Tiagra color picker
	//
	$lang['AGCM_color_search'] = 'Color Search';
	$lang['AGCM_color_search_explain'] = 'Hover over the wheel to view colors.  Click to choose a web-smart color.  Make sure you pick colors that do not clash with your main theme.';
	$lang['AGCM_web_safe'] = 'Web Safe Palette';
	$lang['AGCM_windows_system'] = 'Windows System Palette';
	$lang['AGCM_grey_scale'] = 'Grey Scale Palette';
	$lang['AGCM_mac_os'] = 'Mac OS Palette';
}

//
// CH Specific
//
$lang['Color_options'] = 'Username Color Options';

//
// User Profile
//
$lang['AGCM_user_color'] = 'Select your default group color:';
$lang['AGCM_user_color_explain'] = 'If you are assigned to more then one group with colors enabled, then you can select which group color will affect your Username.';

//
// Legend
//
$lang['AGCM_legend'] = ' Legend ::';
$lang['Group_registered'] = 'Registered Users';
$lang['Group_registered_desc'] = 'All Registered Users';
$lang['Group_anonymous'] = 'Anonymous Users';
$lang['Group_anonymous_desc'] = 'All Anonymous Users';
$lang['Group_session'] = 'Inactive Users';
$lang['Group_session_desc'] = 'Users who have been defined as Inactive by the Admin';

?>
