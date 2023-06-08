<?php
/***************************************************************************
 *						lang_extend_qbar.php [English]
 *						--------------------
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
	$lang['Lang_extend_qbar']					= 'QBar/Qmenu';

	// title
	$lang['Qbar_admin']							= 'Qbar';
	$lang['Qbar_admin_explain']					= 'Here you can setup the navigation bars upon the forums and menus links.';
	$lang['Qbar_admin_panel']					= 'Qbar panel';
	$lang['Qbar_admin_panel_explain']			= 'Here you can create and modify a Qbar and the way it will appear on the header of the board.';
	$lang['Qbar_admin_field']					= 'Qbar field';
	$lang['Qbar_admin_field_explain']			= 'Here you can create and modify a Qbar field.';
	$lang['Qbar_admin_import']					= 'Import fields';
	$lang['Qbar_admin_import_explain']			= 'Use this feature to import field to an existing Qbar.';
	$lang['Qbar_settings']						= 'Settings';

	// qbar def
	$lang['Qbar_name']							= 'Qbar name';
	$lang['Qbar_name_explain']					= 'The Qbar name is never displayed to the user : it\'s only an internal identifier.';
	$lang['Qbar_class']							= 'Class';
	$lang['Qbar_class_explain']					= 'Use "Bar" for a bar above the board, "Menu" for a menu.';
	$lang['Qbar_display']						= 'Display';
	$lang['Qbar_display_explain']				= 'Set this one to "Yes" in order to display the qbar.';
	$lang['Qbar_cells']							= 'Links per line';
	$lang['Qbar_cells_explain']					= 'Number of links per line : if the number of links exceed this value, a new line will be generated.';
	$lang['Qbar_in_table']						= 'Use a table';
	$lang['Qbar_in_table_explain']				= 'Set this one to "Yes" in order to draw boxes around the links.';
	$lang['Qbar_style']							= 'Linked to a specific style';
	$lang['Qbar_style_explain']					= 'If you select a particular style, the Qbar will only be display when the board will use this style.';
	$lang['Qbar_sub_template']					= 'Linked to a specific sub-template';
	$lang['Qbar_sub_template_explain']			= 'If you select a sub-template, the Qbar will only be display when the board will use this sub-template. Use "None" for displaying it only when no sub-template are used, "All" to display the Qbar whatever sub-template is used for this style.';

	// field def
	$lang['Qbar_field_name']					= 'Field name';
	$lang['Qbar_field_name_explain']			= 'The field name is never displayed to the user : it\'s only an internal identifier.';
	$lang['Qbar_shortcut']						= 'Shortcut';
	$lang['Qbar_shortcut_explain']				= 'The shortcut is what is displayed in the menu or the bar option. You can use text, or a key of the language array. <br />(check language/lang_<i>your_language</i>/lang_main.php)';

	$lang['Qbar_explain']						= 'Mouse over';
	$lang['Qbar_explain_explain']				= 'The mouse over will be displayed when the user set his mouse on the link or on the icon (title or alt HTML statement). You can use text, or a key of the language array. <br />(check language/lang_<i>your_language</i>/lang_main.php).';
	$lang['Qbar_alternate']						= 'Alternate shortcut';
	$lang['Qbar_alternate_explain']				= 'The alternate shortcut is used in conjonction with the pm auth set, when more than one PM is considered. You can use direct text, or a key of the language array. <br />(check language/lang_<i>your_language</i>/lang_main.php).';
	$lang['Qbar_icon']							= 'Icon';
	$lang['Qbar_icon_explain']					= 'Icon url or key to the images array. <br />(check templates/<i>your_template</i>/<i>your_template</i>.cfg)';
	$lang['Qbar_use_value']						= 'Display shortcut';
	$lang['Qbar_use_value_explain']				= 'Check yes if you want to use the text as the link displayed.';
	$lang['Qbar_use_icon']						= 'Display icon';
	$lang['Qbar_use_icon_explain']				= 'Check yes if you want to use the icon as the link displayed.';
	$lang['Qbar_url']							= 'Program URL';
	$lang['Qbar_url_explain']					= 'If the program stands in phpBB dir, use only URI, else use full URL.';
	$lang['Qbar_internal']						= 'phpBB prog';
	$lang['Qbar_internal_explain']				= 'Choosing "Yes", the link will be considered as a phpBB program, and will be so secured against some basic hack attempts and will include the session id in the url link.';
	$lang['Qbar_window']						= 'New Window';
	$lang['Qbar_window_explain']				= 'Choosing "Yes", the link will be opened in a new window.';
	$lang['Qbar_auth_logged']					= 'Logged in';
	$lang['Qbar_auth_logged_explain']			= 'This allows to display the link only if it suits the loggin status : "Ignore" will display it all the time.';
	$lang['Qbar_auth_admin']					= 'Admin level';
	$lang['Qbar_auth_admin_explain']			= 'This allows to display the link only if the user level suits the setup : "Ignore" will display it all the time.';
	$lang['Qbar_auth_pm']						= 'PM awaiting';
	$lang['Qbar_auth_pm_explain']				= 'This allows to display the link only if the status of pm awaiting suits the septup : "Ignore" will display it all the time.';
	$lang['Qbar_tree_id']						= 'Forum tree';
	$lang['Qbar_tree_id_explain']				= 'This allows you to display the link suiting the user\'s view authorization to a forum.';

	$lang['Qbar_auths']							= 'Authorizations';
	$lang['Qbar_private_messages']				= 'Private messages management';

	// specific actions
	$lang['Qbar_delete_panel']					= 'Delete a Qbar';
	$lang['Qbar_delete_panel_confirm']			= 'Are you sure you want to delete the Qbar <b>%s</b> ?';

	$lang['Qbar_delete_field']					= 'Delete a link';
	$lang['Qbar_delete_field_confirm']			= 'Are you sure you want to remove the link <b>%s</b> from the Qbar %s ?';

	// error messages
	$lang['Qbar_error_panel_system']			= 'You can not modify or delete a system Qbar.';
	$lang['Qbar_error_panel_exists']			= 'The Qbar name already exists.';
	$lang['Qbar_error_panel_not_found']			= 'The Qbar name doesn\'t exist.';
	$lang['Qbar_error_panel_empty_name']		= 'You have to set a Qbar name.';
	$lang['Qbar_error_panel_empty_cells']		= 'You have to set a number of options displayed per line if you want the Qbar to be displayed.';

	$lang['Qbar_error_field_exists']			= 'The field name already exists.';
	$lang['Qbar_error_field_not_found']			= 'The field name doesn\'t exist.';
	$lang['Qbar_error_field_empty_name']		= 'You have to set a field name.';
	$lang['Qbar_error_field_system']			= 'You can not modify or delete a field in a system Qbar.';
	$lang['Qbar_error_field_empty_shortcut']	= 'You have to fill the shortcut if you want to display it.';
	$lang['Qbar_error_field_empty_icon']		= 'You have to fill the icon if you want to display it.';
	$lang['Qbar_error_field_display_nothing']	= 'You have to choose to use the link or the icon or both.';
	$lang['Qbar_error_field_empty_url']			= 'You have to fill the URL or URI of the link.';
	$lang['Qbar_error_field_external_url']		= 'Don\'t specify a domain (http://) if you are selecting a phpBB prog.';

	// auths
	$lang['Qbar_auth_ignore']					= 'Ignore';
	$lang['Qbar_auth_required']					= 'Required';
	$lang['Qbar_auth_prohibited']				= 'Prohibited';
	$lang['Qbar_auth_pm_new']					= 'New PMs';
	$lang['Qbar_auth_pm_no_new']				= 'No new PMs';
	$lang['Qbar_auth_pm_unread']				= 'Unread PMs';

	// classes
	$lang['Qbar_class_system']					= 'System';
	$lang['Qbar_class_bar']						= 'Bar';
	$lang['Qbar_class_menu']					= 'Menu';
	$lang['Qbar_class_nav']						= 'Nav';
	$lang['Qbar_class_nav2']					= 'Nav2';
	$lang['Qbar_class_list']					= 'List';

	// generic actions
	$lang['Create_field']						= 'Add a new field';
	$lang['Create_panel']						= 'Add a new panel';

	// misc.
	$lang['Qbar_none']							= '---------- None ----------';
	$lang['Import']								= 'Import';
	$lang['Refresh']							= 'Refresh';
	$lang['Qbar_all']							= '---------- All -----------';

	// V: PHP function for QBar
	$lang['QBAR_PHP_FUNCTION'] = 'PHP function';
	$lang['QBAR_PHP_FUNCTION_EXPLAIN'] = 'Call a PHP function to render this field';
}

$lang['FAQ_explain']				= 'Frequently Asked Questions.';
$lang['Memberlist_explain']			= 'List of the registered members.';
$lang['Usergroups_explain']			= 'Groups of registered users.';
$lang['Profile_explain']			= 'Edit your profile.';
$lang['Private_Messaging_explain']	= 'See your private message.';
$lang['Login_explain']				= 'Log in to use your nick and profile settings.';
$lang['Register_explain']			= 'Register.';
$lang['Logout_explain']				= 'End your session.';
$lang['Admin_explain']				= 'Go to the admin panel.';
$lang['Admin']						= 'Admin';
$lang['Forum']						= 'Forum';
$lang['Forum_index_explain']		= 'Index of the forum.';
$lang['Home']						= 'Home';
$lang['Home_explain']				= 'Go to the homepage';
$lang['Album']						= 'Album';
$lang['Album_explain']				= 'View uploaded images';
$lang['Calendar']					= 'Calendar';
$lang['Calendar_explain']			= 'Check events posted in the forum';
$lang['Statistics']					= 'Statistics';
$lang['Statistics_explain']			= 'View website statistics';
$lang['Knowledgebase']				= 'Knowledge Base';
$lang['Knowledgebase_explain']		= 'Check articles uploaded to the website';
$lang['Acronyms']					= 'Acronyms';
$lang['Acronyms_explain']			= 'Display the acronyms being used by the forum';
$lang['Digests']					= 'Digests';
$lang['Digests_explain']			= 'Subscribe to the daily e-mail digest of this site';
$lang['Rules']						= 'Rules';
$lang['Rules_explain']				= 'Read the rules of this website';
$lang['Tour']						= 'Forum Tour';
$lang['Tour_explain']				= 'Online help for the website';
$lang['Rate_menu']					= 'Latest Ratings';
$lang['Rate_explain']				= 'Topics that are top rated by forum users';
$lang['Ranks']						= 'Ranks';
$lang['Ranks_explain']				= 'Display Available Ranks and members';
$lang['Links']						= 'Links';
$lang['Links_explain']				= 'Links Categories';
$lang['Donate']						= 'Donate';
$lang['Donate_explain']				= 'Donate to '.$board_config['sitename'];
$lang['Donors']						= 'Donors';
$lang['Donors_explain']				= 'Users who have donated';
$lang['Personal_album']		= 'My Album';
$lang['Personal_album_explain']				= 'Your own personal album';
$lang['Personal_albums']		= 'Personal Albums';
$lang['Personal_albums_explain']				= 'All personal albums';
$lang['FAQ']				= 'FAQ';
$lang['Search_forums']				= 'Search Forums';
$lang['Search_forums_explain']				= 'Search through forums.';
$lang['Search_kb']				= 'Search KB';
$lang['Search_kb_explain']				= 'Search through Knowledge Base.';
$lang['Paypal_history']		= 'My PayPal History';
$lang['Paypal_history_explain']				= 'View your PayPal account history';
$lang['My_cookies']		= 'My Cookies';
$lang['My_cookies_explain']				= 'Manage your own cookies';
$lang['News_RSS']		= 'RSS Feed';
$lang['News_RSS_explain']				= 'News in RSS format';
$lang['Shoutbox']		= 'Shoutbox';
$lang['Shoutbox_explain']				= 'Full Page Shoutbox';
$lang['Sync_user_posts']		= 'Sync User Posts';
$lang['Sync_user_posts_explain']				= 'Rebuild user post count';
$lang['Tell_friend']		= 'Tell A Friend';
$lang['Tell_friend_explain']				= 'Tell your friends about this great site.';
$lang['Online_users']		= 'Online Users';
$lang['Online_users_explain']				= 'See who is online at this time.';
$lang['Bookmarks']					= 'My Bookmarks';
$lang['Bookmarks_explain']			= 'See your bookmarked posts';
$lang['Exploit_attempts']					= 'Exploit Attempts';
$lang['Exploit_attempts_explain']			= 'See the list of blocked exploit attempts';
$lang['Search_dl']					= 'Search Downloads';
$lang['Search_dl_explain']			= 'Search through downloads';
$lang['Staff']						= 'Staff';
$lang['Staff_explain']				= 'Members of our staff';
?>