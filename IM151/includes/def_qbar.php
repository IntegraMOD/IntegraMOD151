<?php
/***************************************************************************
 *                            def_qbar.php
 *                            ------------
 *	begin			: 22/07/2003
 *	copyright		: Ptirhiik
 *	email			: admin@rpgnet-fr.com
 *	version			: 1.0.3 - 29/10/2003
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

//----------------------------------------------------------------------------
//	$qbar_maps[map_name]
//  --------------------
//		[class]				constant : class of bar : System, Bar, Menu
//		[display]			switch : do we display this qbar (System never are)
//		[cells]				value : number of cells used to display the bar before carriage return
//		[in_table]			switch : Do we draw a table around the qbar
//		[style]				value : Qbar specific to a style
//		[sub_template]		value : Qbar specific to a sub-template (optionnal) : *ALL means ignore
//		[fields]			array : options of the qbar
//			[shortcut]		value : lang[] key or value for the shortcut displayed
//			[alternate]		value : lang[] key or value for shortcut when pms are more than one
//			[explain]		value : lang[] key or value for the shortcut used as title or alt on mouseover
//			[icon]			value : images[] key or url to the icon 
//			[use_value]		switch : we use the value to display
//			[use_icon]		switch : we use the icon to display
//			[url]			value : url of the prog to call while clicking on shortcut
//			[internal]		switch : does tbe program is in phpBB dirs ? if true, do append_sid() with
//			[auth_logged]	switch : ignore/required/denied to : the option will be display if
//			[auth_admin]	switch : ignore/required/denied to : admin user check
//			[auth_pm]		switch : ignore/new_pm/unread pm/no new nor unread : pm check
//			[tree_id]		value : if the user is authorized to the forum tree level (auth view)
//----------------------------------------------------------------------------

$qbar_maps = array(
	
	'Menu' => array(
		'class'			=> 'Menu',
		'display'		=> true,
		'cells'			=> 10,
		'in_table'		=> false,
		'style'			=> 0,
		'sub_template'	=> '',
		'fields'		=> array(
						'Home' => array(
								'shortcut' 		=> 'Home',
								'explain' 		=> 'Home_explain',
								'icon' 			=> 'menu_portal',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'portal.php',
								'internal' 		=> true,
							),
						'Forum' => array(
								'shortcut' 		=> 'Forum',
								'explain' 		=> 'Forum_index_explain',
								'icon' 			=> 'menu_forums',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'index.php',
								'internal' 		=> true,
							),
						'Memberlist' => array(
								'shortcut' 		=> 'Memberlist',
								'explain' 		=> 'Memberlist_explain',
								'icon' 			=> 'menu_memberlist',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'memberlist.php',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
							),
						'Usergroups' => array(
								'shortcut' 		=> 'Usergroups',
								'explain' 		=> 'Usergroups_explain',
								'icon' 			=> 'menu_usergroups',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'groupcp.php',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
							),
						'Admin_configuration_panel' => array(
								'shortcut' 		=> 'Admin',
								'explain' 		=> 'Admin_explain',
								'icon' 			=> 'menu_admin',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'admin/index.php',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
								'auth_admin' 	=> 1,
							),
						'Profile' => array(
								'shortcut' 		=> 'Profile',
								'explain' 		=> 'Profile_explain',
								'icon' 			=> 'menu_profile',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'profile.php?mode=editprofile',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
							),
						'PM_Unlogged' => array(
								'shortcut' 		=> 'Login_check_pm',
								'explain' 		=> 'Private_Messaging_explain',
								'icon' 			=> 'menu_messages',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'login.php',
								'internal' 		=> true,
								'auth_logged' 	=> 2,
							),
						'PM_New_text' => array(
								'shortcut' 		=> 'New_pm',
								'alternate' 	=> 'New_pms',
								'explain' 		=> 'Private_Messaging_explain',
								'icon' 			=> 'menu_messages_new',
								'use_value' 	=> true,
								'url' 			=> 'privmsg.php?folder=inbox',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
								'auth_pm' 		=> 1,
							),
						'PM_Unread_text' => array(
								'shortcut' 		=> 'Unread_pm',
								'alternate' 	=> 'Unread_pms',
								'explain' 		=> 'Private_Messaging_explain',
								'icon' 			=> 'menu_messages_new',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'privmsg.php?folder=inbox',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
								'auth_pm' 		=> 2,
							),
						'PM_No_new_text' => array(
								'shortcut' 		=> 'No_new_pm',
								'explain' 		=> 'Private_Messaging_explain',
								'icon' 			=> 'menu_messages',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'privmsg.php?folder=inbox',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
								'auth_pm' 		=> 3,
							),
						'Register' => array(
								'shortcut' 		=> 'Register',
								'explain' 		=> 'Register_explain',
								'icon' 			=> 'menu_register',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'profile.php?mode=profil&sub=profile_prefer&mod=0',
								'internal' 		=> true,
								'auth_logged' 	=> 2,
							),
						'Login' => array(
								'shortcut' 		=> 'Login',
								'explain' 		=> 'Login_explain',
								'icon' 			=> 'menu_login',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'login.php',
								'internal' 		=> true,
								'auth_logged' 	=> 2,
							),
						'Logout' => array(
								'shortcut' 		=> 'Logout',
								'explain' 		=> 'Logout_explain',
								'icon' 			=> 'menu_logout',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'login.php?logout=true',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
							),
						'Reports' => array(
								'shortcut' 		=> 'Reports',
								'explain' 		=> 'Reports_explain',
								'icon' 			=> 'menu_reports',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'a',
								'internal' 		=> true,
								'php_function' => 'report_integrate_with_qbar',
							),
					),
	),
	
	'Board Navigation' => array(
		'class'			=> 'Nav',
		'display'		=> true,
		'cells'			=> 5,
		'in_table'		=> false,
		'style'			=> 0,
		'sub_template'	=> '',
		'fields'		=> array(
						'Home' => array(
								'shortcut' 		=> 'Home',
								'explain' 		=> 'Home_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'portal.php',
								'internal' 		=> true,
							),
						'Forum' => array(
								'shortcut' 		=> 'Forum',
								'explain' 		=> 'Forum_index_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'index.php',
								'internal' 		=> true,
							),
						'hr_public' => array(
								'shortcut' 		=> '<hr>',
								'use_value' 	=> true,
								'url' 			=> 'portal.php',
								'internal' 		=> true,
							),
						'Acronyms' => array(
								'shortcut' 		=> 'Acronyms',
								'explain' 		=> 'Acronyms_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'acronyms.php',
								'internal' 		=> true,
							),
						'Album' => array(
								'shortcut' 		=> 'Album',
								'explain' 		=> 'Album_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'album.php',
								'internal' 		=> true,
							),
						'Calendar' => array(
								'shortcut' 		=> 'Calendar',
								'explain' 		=> 'Calendar_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'calendar.php',
								'internal' 		=> true,
							),
						'Download' => array(
								'shortcut' 		=> 'Downloads',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'dload.php',
								'internal' 		=> true,
							),
						'Tour' => array(
								'shortcut' 		=> 'Tour',
								'explain' 		=> 'Tour_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'javascript:tour()',
							),
						'Knowledgebase' => array(
								'shortcut' 		=> 'Knowledgebase',
								'explain' 		=> 'Knowledgebase_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'kb.php',
								'internal' 		=> true,
							),
						'Rate' => array(
								'shortcut' 		=> 'Rate_menu',
								'explain' 		=> 'Rate_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'ratings.php',
								'internal' 		=> true,
							),
						'Links' => array(
								'shortcut' 		=> 'Links',
								'explain' 		=> 'Links_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'links.php',
								'internal' 		=> true,
							),
						'Online_users' => array(
								'shortcut' 		=> 'Online_users',
								'explain' 		=> 'Online_users_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'viewonline.php',
								'internal' 		=> true,
							),
						'Personal_albums' => array(
								'shortcut' 		=> 'Personal_albums',
								'explain' 		=> 'Personal_albums_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'album_personal_index.php',
								'internal' 		=> true,
							),
						'News_RSS' => array(
								'shortcut' 		=> 'News_RSS',
								'explain' 		=> 'News_RSS_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'news_rss.php',
								'internal' 		=> true,
							),
						'Rules' => array(
								'shortcut' 		=> 'Rules',
								'explain' 		=> 'Rules_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'rules.php',
								'internal' 		=> true,
							),
						'Staff' => array(
								'shortcut' 		=> 'Staff',
								'explain' 		=> 'Staff_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'staff.php',
								'internal' 		=> true,
							),
						'Statistics' => array(
								'shortcut' 		=> 'Statistics',
								'explain' 		=> 'Statistics_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'statistics.php',
								'internal' 		=> true,
							),
						'hr_search' => array(
								'shortcut' 		=> '<hr>',
								'use_value' 	=> true,
								'url' 			=> 'portal.php',
								'internal' 		=> true,
							),
						'FAQ' => array(
								'shortcut' 		=> 'FAQ',
								'explain' 		=> 'FAQ_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'faq.php',
								'internal' 		=> true,
							),
						'Search_forums' => array(
								'shortcut' 		=> 'Search_forums',
								'explain' 		=> 'Search_forums_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'search.php',
								'internal' 		=> true,
							),
						'Search_dl' => array(
								'shortcut' 		=> 'Search_dl',
								'explain' 		=> 'Search_dl_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'dload.php?action=search',
								'internal' 		=> true,
							),
						'search_kb' => array(
								'shortcut' 		=> 'Search_kb',
								'explain' 		=> 'Search_kb_extend',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'kb_search.php',
								'internal' 		=> true,
							),
						'hr_users' => array(
								'shortcut' 		=> '<hr>',
								'use_value' 	=> true,
								'url' 			=> 'portal.php',
								'internal' 		=> true,
							),
						'Digests' => array(
								'shortcut' 		=> 'Digests',
								'explain' 		=> 'Digests_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'profile.php?mode=profil&sub=digests',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
							),
						'Donate' => array(
								'shortcut' 		=> 'Donate',
								'explain' 		=> 'Donate_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'lwdonate.php',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
							),
						'Donors' => array(
								'shortcut' 		=> 'Donors',
								'explain' 		=> 'Donors_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'lwdonors.php',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
							),
						'Personal_album' => array(
								'shortcut' 		=> 'Personal_album',
								'explain' 		=> 'Personal_album_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'album_personal.php',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
							),
						'Bookmarks' => array(
								'shortcut' 		=> 'Bookmarks',
								'explain' 		=> 'Bookmarks_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'search.php?search_id=bookmarks',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
							),
						'My_cookies' => array(
								'shortcut' 		=> 'My_cookies',
								'explain' 		=> 'My_cookies_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'mycookies.php',
								'internal' 		=> true,
							),
						'Paypal_history' => array(
								'shortcut' 		=> 'Paypal_history',
								'explain' 		=> 'Paypal_history_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'lwacctrecords.php',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
							),
						'Ranks' => array(
								'shortcut' 		=> 'Ranks',
								'explain' 		=> 'Ranks_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'ranks.php',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
							),
						'Shoutbox' => array(
								'shortcut' 		=> 'Shoutbox',
								'explain' 		=> 'Shoutbox_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'shoutbox_max.php',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
							),
						'Tell_friend' => array(
								'shortcut' 		=> 'Tell_friend',
								'explain' 		=> 'Tell_friend_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'tellafriend.php',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
							),
						'hr_admin' => array(
								'shortcut' 		=> '<hr>',
								'use_value' 	=> true,
								'url' 			=> 'portal.php',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
								'auth_admin' 	=> 1,
							),
						'Admin_configuration_panel' => array(
								'shortcut' 		=> 'Admin',
								'explain' 		=> 'Admin_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'admin/index.php',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
								'auth_admin' 	=> 1,
							),
						'Login Security' => array(
								'shortcut' 		=> 'ctracker_gmb_loginlink',
								'explain' 		=> 'ctracker_gmb_loginlink',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon'		=> true,
								'url' 			=> 'ct_login_history.php',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
								'auth_admin' 	=> 1,
							),
						'Exploit_attempts' => array(
								'shortcut' 		=> 'Exploit_attempts',
								'explain' 		=> 'Exploit_attempts_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'login_security.php?phpBBSecurity=caught',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
								'auth_admin' 	=> 1,
							),
						'Sync_user_posts' => array(
								'shortcut' 		=> 'Sync_user_posts',
								'explain' 		=> 'Sync_user_posts_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'sync_postcount.php',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
								'auth_admin' 	=> 1,
							),
					),
	),
	
	'Second menu' => array(
		'class'			=> 'Nav2',
		'display'		=> true,
		'cells'			=> 5,
		'in_table'		=> false,
		'style'			=> 0,
		'sub_template'	=> '',
		'fields'		=> array(
						'integramod.com' => array(
								'shortcut' 		=> 'IntegraMOD.com',
								'explain' 		=> 'The Home of IntegraMOD',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'http://www.integramod.com',
							),
						'Install and configure' => array(
								'shortcut' 		=> 'Install and configure',
								'alternate' 	=> 'Install and configure',
								'explain' 		=> 'Install and configure',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'portal.php?page=2',
								'internal' 		=> true,
							),
						'layout 2' => array(
								'shortcut' 		=> 'layout 2',
								'explain' 		=> 'Sample layout 2',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'portal.php?page=5',
								'internal' 		=> true,
							),
						'3 Column' => array(
								'shortcut' 		=> '3 Column',
								'explain' 		=> 'Sample 3 Column Page',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'portal.php?page=3',
								'internal' 		=> true,
							),
						'4 Column' => array(
								'shortcut' 		=> '4 Column',
								'explain' 		=> 'Sample 4 Column Layout',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'portal.php?page=4',
								'internal' 		=> true,
							),
						'5 Column' => array(
								'shortcut' 		=> '5 Column',
								'explain' 		=> 'Sample 5 Column Layout',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'portal.php?page=5',
								'internal' 		=> true,
							),
						'6 Column' => array(
								'shortcut' 		=> '6 Column',
								'explain' 		=> 'Sample 6 Column Layout',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'portal.php?page=6',
								'internal' 		=> true,
							),
					),
	),
	
	'default_Board Navigation' => array(
		'class'			=> 'System',
		'display'		=> false,
		'cells'			=> 5,
		'in_table'		=> false,
		'style'			=> 0,
		'sub_template'	=> '',
		'fields'		=> array(
						'Home' => array(
								'shortcut' 		=> 'Home',
								'explain' 		=> 'Home_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'portal.php',
								'internal' 		=> true,
							),
						'Forum' => array(
								'shortcut' 		=> 'Forum',
								'explain' 		=> 'Forum_index_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'index.php',
								'internal' 		=> true,
							),
						'hr_public' => array(
								'shortcut' 		=> '<hr>',
								'use_value' 	=> true,
								'url' 			=> 'portal.php',
								'internal' 		=> true,
							),
						'Acronyms' => array(
								'shortcut' 		=> 'Acronyms',
								'explain' 		=> 'Acronyms_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'acronyms.php',
								'internal' 		=> true,
							),
						'Album' => array(
								'shortcut' 		=> 'Album',
								'explain' 		=> 'Album_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'album.php',
								'internal' 		=> true,
							),
						'Calendar' => array(
								'shortcut' 		=> 'Calendar',
								'explain' 		=> 'Calendar_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'calendar.php',
								'internal' 		=> true,
							),
						'Download' => array(
								'shortcut' 		=> 'Downloads',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'dload.php',
								'internal' 		=> true,
							),
						'Tour' => array(
								'shortcut' 		=> 'Tour',
								'explain' 		=> 'Tour_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'javascript:tour()',
							),
						'Knowledgebase' => array(
								'shortcut' 		=> 'Knowledgebase',
								'explain' 		=> 'Knowledgebase_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'kb.php',
								'internal' 		=> true,
							),
						'Rate' => array(
								'shortcut' 		=> 'Rate_menu',
								'explain' 		=> 'Rate_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'ratings.php',
								'internal' 		=> true,
							),
						'Links' => array(
								'shortcut' 		=> 'Links',
								'explain' 		=> 'Links_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'links.php',
								'internal' 		=> true,
							),
						'Online_users' => array(
								'shortcut' 		=> 'Online_users',
								'explain' 		=> 'Online_users_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'viewonline.php',
								'internal' 		=> true,
							),
						'Personal_albums' => array(
								'shortcut' 		=> 'Personal_albums',
								'explain' 		=> 'Personal_albums_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'album_personal_index.php',
								'internal' 		=> true,
							),
						'News_RSS' => array(
								'shortcut' 		=> 'News_RSS',
								'explain' 		=> 'News_RSS_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'news_rss.php',
								'internal' 		=> true,
							),
						'Rules' => array(
								'shortcut' 		=> 'Rules',
								'explain' 		=> 'Rules_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'rules.php',
								'internal' 		=> true,
							),
						'Staff' => array(
								'shortcut' 		=> 'Staff',
								'explain' 		=> 'Staff_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'staff.php',
								'internal' 		=> true,
							),
						'Statistics' => array(
								'shortcut' 		=> 'Statistics',
								'explain' 		=> 'Statistics_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'statistics.php',
								'internal' 		=> true,
							),
						'hr_search' => array(
								'shortcut' 		=> '<hr>',
								'use_value' 	=> true,
								'url' 			=> 'portal.php',
								'internal' 		=> true,
							),
						'FAQ' => array(
								'shortcut' 		=> 'FAQ',
								'explain' 		=> 'FAQ_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'faq.php',
								'internal' 		=> true,
							),
						'Search_forums' => array(
								'shortcut' 		=> 'Search_forums',
								'explain' 		=> 'Search_forums_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'search.php',
								'internal' 		=> true,
							),
						'Search_dl' => array(
								'shortcut' 		=> 'Search_dl',
								'explain' 		=> 'Search_dl_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'dload.php?action=search',
								'internal' 		=> true,
							),
						'search_kb' => array(
								'shortcut' 		=> 'Search_kb',
								'explain' 		=> 'Search_kb_extend',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'kb_search.php',
								'internal' 		=> true,
							),
						'hr_users' => array(
								'shortcut' 		=> '<hr>',
								'use_value' 	=> true,
								'url' 			=> 'portal.php',
								'internal' 		=> true,
							),
						'Digests' => array(
								'shortcut' 		=> 'Digests',
								'explain' 		=> 'Digests_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'profile.php?mode=profil&sub=digests',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
							),
						'Donate' => array(
								'shortcut' 		=> 'Donate',
								'explain' 		=> 'Donate_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'lwdonate.php',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
							),
						'Donors' => array(
								'shortcut' 		=> 'Donors',
								'explain' 		=> 'Donors_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'lwdonors.php',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
							),
						'Personal_album' => array(
								'shortcut' 		=> 'Personal_album',
								'explain' 		=> 'Personal_album_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'album_personal.php',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
							),
						'Bookmarks' => array(
								'shortcut' 		=> 'Bookmarks',
								'explain' 		=> 'Bookmarks_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'search.php?search_id=bookmarks',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
							),
						'My_cookies' => array(
								'shortcut' 		=> 'My_cookies',
								'explain' 		=> 'My_cookies_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'mycookies.php',
								'internal' 		=> true,
							),
						'Paypal_history' => array(
								'shortcut' 		=> 'Paypal_history',
								'explain' 		=> 'Paypal_history_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'lwacctrecords.php',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
							),
						'Ranks' => array(
								'shortcut' 		=> 'Ranks',
								'explain' 		=> 'Ranks_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'ranks.php',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
							),
						'Shoutbox' => array(
								'shortcut' 		=> 'Shoutbox',
								'explain' 		=> 'Shoutbox_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'shoutbox_max.php',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
							),
						'Tell_friend' => array(
								'shortcut' 		=> 'Tell_friend',
								'explain' 		=> 'Tell_friend_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'tellafriend.php',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
							),
						'hr_admin' => array(
								'shortcut' 		=> '<hr>',
								'use_value' 	=> true,
								'url' 			=> 'portal.php',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
								'auth_admin' 	=> 1,
							),
						'Admin_configuration_panel' => array(
								'shortcut' 		=> 'Admin',
								'explain' 		=> 'Admin_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'admin/index.php',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
								'auth_admin' 	=> 1,
							),
						'Exploit_attempts' => array(
								'shortcut' 		=> 'Exploit_attempts',
								'explain' 		=> 'Exploit_attempts_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'login_security.php?phpBBSecurity=caught',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
								'auth_admin' 	=> 1,
							),
						'Sync_user_posts' => array(
								'shortcut' 		=> 'Sync_user_posts',
								'explain' 		=> 'Sync_user_posts_explain',
								'icon' 			=> 'nav_menu',
								'use_value' 	=> true,
								'use_icon' 		=> true,
								'url' 			=> 'sync_postcount.php',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
								'auth_admin' 	=> 1,
							),
					),
	),
	
	'default_menu' => array(
		'class'			=> 'System',
		'display'		=> false,
		'cells'			=> 0,
		'in_table'		=> false,
		'style'			=> 0,
		'sub_template'	=> '',
		'fields'		=> array(
						'FAQ' => array(
								'shortcut' 		=> 'FAQ',
								'explain' 		=> 'FAQ_explain',
								'use_value' 	=> true,
								'url' 			=> 'faq.php',
								'internal' 		=> true,
							),
						'Search' => array(
								'shortcut' 		=> 'Search',
								'explain' 		=> 'Search_explain',
								'use_value' 	=> true,
								'url' 			=> 'search.php',
								'internal' 		=> true,
							),
						'Memberlist' => array(
								'shortcut' 		=> 'Memberlist',
								'explain' 		=> 'Memberlist_explain',
								'use_value' 	=> true,
								'url' 			=> 'memberlist.php',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
							),
						'Usergroups' => array(
								'shortcut' 		=> 'Usergroups',
								'explain' 		=> 'Usergroups_explain',
								'use_value' 	=> true,
								'url' 			=> 'groupcp.php',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
							),
						'Profile' => array(
								'shortcut' 		=> 'Profile',
								'explain' 		=> 'Profile_explain',
								'use_value' 	=> true,
								'url' 			=> 'profile.php?mode=editprofile',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
							),
						'PM_simple' => array(
								'shortcut' 		=> 'Private_Messaging',
								'explain' 		=> 'Private_Messaging_explain',
								'use_value' 	=> true,
								'url' 			=> 'privmsg.php?folder=inbox',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
							),
						'PM_Unlogged' => array(
								'shortcut' 		=> 'Login_check_pm',
								'explain' 		=> 'Private_Messaging_explain',
								'use_value' 	=> true,
								'url' 			=> 'login.php',
								'internal' 		=> true,
								'auth_logged' 	=> 2,
							),
						'PM_New_text' => array(
								'shortcut' 		=> 'New_pm',
								'alternate' 	=> 'New_pms',
								'explain' 		=> 'Private_Messaging_explain',
								'use_value' 	=> true,
								'url' 			=> 'privmsg.php?folder=inbox',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
								'auth_pm' 		=> 1,
							),
						'PM_Unread_text' => array(
								'shortcut' 		=> 'Unread_pm',
								'alternate' 	=> 'Unread_pms',
								'explain' 		=> 'Private_Messaging_explain',
								'use_value' 	=> true,
								'url' 			=> 'privmsg.php?folder=inbox',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
								'auth_pm' 		=> 2,
							),
						'PM_No_new_text' => array(
								'shortcut' 		=> 'No_new_pm',
								'explain' 		=> 'Private_Messaging_explain',
								'use_value' 	=> true,
								'url' 			=> 'privmsg.php?folder=inbox',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
								'auth_pm' 		=> 3,
							),
						'Register' => array(
								'shortcut' 		=> 'Register',
								'explain' 		=> 'Register_explain',
								'use_value' 	=> true,
								'url' 			=> 'profile.php?mode=profil&sub=profile_prefer&mod=0',
								'internal' 		=> true,
								'auth_logged' 	=> 2,
							),
						'Login Security' => array(
								'shortcut' 		=> 'ctracker_gmb_loginlink',
								'explain' 		=> 'ctracker_gmb_loginlink',
								'use_value' 	=> true,
								'url' 			=> 'ct_login_history.php',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
							),
						'Login' => array(
								'shortcut' 		=> 'Login',
								'explain' 		=> 'Login_explain',
								'use_value' 	=> true,
								'url' 			=> 'login.php',
								'internal' 		=> true,
								'auth_logged' 	=> 2,
							),
						'Logout' => array(
								'shortcut' 		=> 'Logout',
								'explain' 		=> 'Logout_explain',
								'use_value' 	=> true,
								'url' 			=> 'login.php?logout=true',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
							),
						'Admin_configuration_panel' => array(
								'shortcut' 		=> 'Admin',
								'explain' 		=> 'Admin_explain',
								'use_value' 	=> true,
								'url' 			=> 'admin/index.php',
								'internal' 		=> true,
								'auth_logged' 	=> 1,
								'auth_admin' 	=> 1,
							),
					),
	),
	
	// standard forum tree
	'default_tree' => array(
		'class'			=> 'System',
		'display'		=> false,
		'cells'			=> 0,
		'in_table'		=> false,
		'sub_template'	=> '*ALL',
		'fields'		=> array(
		),
	),
);
?>