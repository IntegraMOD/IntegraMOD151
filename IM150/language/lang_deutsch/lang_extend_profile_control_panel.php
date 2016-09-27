<?php
/***************************************************************************
 *						lang_extend_profile_control_panel.php [English]
 *						-----------------------------------------------
 *	begin				: 28/09/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 1.0.2 - 28/09/2003
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
	die("Hacking Versuch");
}

// admin part
if ( $lang_extend_admin )
{
	$lang['Lang_extend_profile_control_panel'] = 'Profile Control Panel language pack';
}

// who's online
$lang['Admin_founder_online_color']			= '%sBoard Founder%s';
$lang['Jadmin_online_color']			        = '%sJunior Admin%s';
$lang['User_online_color']					= '%sUser%s';

// topic or privmsg display
$lang['Add_friend']							= 'Add Friend';
$lang['Add_to_friend_list']					= 'Add to your friend list';
$lang['Remove_friend']						= 'Remove Friend';
$lang['Add_to_friend_list']					= 'Add to your friend list';
$lang['Add_to_ignore_list']					= 'Add to your ignore list';
$lang['Remove_from_ignore_list']			= 'Remove from your ignore list';
$lang['Happy_birthday']						= 'Happy Birthday !';
$lang['Ignore_choosed']						= 'You have choosen to ignore this user';
$lang['Online']								= 'Online';
$lang['Offline']							= 'Offline';
$lang['Hidden']								= 'Hidden';
$lang['Gender']								= 'Gender';
$lang['Male']								= 'Male';
$lang['Female']								= 'Female';
$lang['No_gender_specify']					= 'Unknown';
$lang['Age']								= 'Age';
$lang['Do_not_allow_pm']					= 'This user doesn\'t accept private messages';

// main entry (profile.php)
$lang['Click_return_profilcp']			    = 'Click %sHere%s to return to %s';

// birthday popup (profile_birthday.php)
$lang['Birthday']							= 'Birthday';
$lang['birthday_msg']						= 'Hi %s, <br /><br /><br /> %s would like to to wish you a Happy Birthday !';

// home panel (profilcp_home.php)
$lang['profilcp_index_shortcut']			= 'Home';
$lang['profilcp_index_pagetitle']			= 'Private Profile home';

// home panel : mini buddy list (functions_profile.php)
$lang['Friend_list']						= 'Friend list';
$lang['Friend_list_of']						= 'Friend of';
$lang['Ignore_list']						= 'Ignore list';
$lang['Ignore_list_of']						= 'Ignored by';
$lang['Nobody']								= 'Nobody';
$lang['Always_visible']						= 'Always visible to this user';
$lang['Not_always_visible']					= 'This user won\'t see you online when you\'ll be in hidden mode';

// home panel : watched topics (functions_profile.php)
$lang['Stop_watching_selected_topics']		= 'Stop watching the selected topics';
$lang['New_subscribed_topic']				= 'Subscribed Topics';
$lang['Submit_period']						= 'See topics since';

// buddy list (profilcp_buddy.php)
$lang['profilcp_buddy_shortcut']			= 'Buddy list';
$lang['profilcp_buddy_pagetitle']			= 'Buddy list';
$lang['profilcp_buddy_friend_shortcut']		= 'Friend list';
$lang['profilcp_buddy_friend_pagetitle']	= 'Edit your Friend list';
$lang['profilcp_buddy_ignore_shortcut']		= 'Ignore list';
$lang['profilcp_buddy_ignore_pagetitle']	= 'Edit your Ignore list';
$lang['profilcp_buddy_list_shortcut']		= 'All the members';
$lang['profilcp_buddy_list_pagetitle']		= 'Member list';
$lang['Click_return_privmsg']				= 'Click %sHere%s to return to the private message';
$lang['profilcp_buddy_could_not_add_user']	= 'The user you selected does not exist.';
$lang['profilcp_buddy_could_not_anon_user']	= 'You cannot make Anonymous a buddy member.';
$lang['profilcp_buddy_add_yourself']		= 'You can\'t add yourself to your buddy lists';
$lang['profilcp_buddy_already']				= 'User is already in the buddy list';
$lang['profilcp_buddy_ignore']				= 'Addition impossible : this user ignores you';
$lang['profilcp_buddy_you_admin']			= 'Being an admin or moderator, you can\'t ignore people';
$lang['profilcp_buddy_admin']				= 'You can\'t ignore admins or moderators';
$lang['User_fields']						= 'User fields list';
$lang['Friend']								= 'Friend';
$lang['Comp_LE']							= 'is less than';
$lang['Comp_EQ']							= 'is equal to';
$lang['Comp_NE']							= 'is different from';
$lang['Comp_GE']							= 'is greater than';
$lang['Comp_IN']							= 'includes';
$lang['Comp_NI']							= 'doesn\'t include';
$lang['Sort_none']							= 'Unsorted';
$lang['date_entry']							= 'YYYYMMDD';

// update profile (profilcp_profil.php)
$lang['profilcp_profil_shortcut']			= 'Profile';
$lang['profilcp_profil_pagetitle']			= 'Profile Edition';
$lang['profilcp_prefer_shortcut']			= 'Your profile';
$lang['profilcp_prefer_pagetitle']			= 'Your profile preferences';
$lang['profilcp_signature_shortcut']		= 'Signature';
$lang['profilcp_signature_pagetitle']		= 'Signature';
$lang['profilcp_avatar_shortcut']			= 'Avatar';
$lang['profilcp_avatar_pagetitle']			= 'Avatar';
$lang['profilcp_digests_shortcut']			= 'Digests';
$lang['profilcp_digests_pagetitle']			= 'Digests';
// update profile : preferences - functions (mod_profile_control_panel.php)
$lang['Other']								= 'Other...';
$lang['Friend_only']						= 'Only friends';

// update profile : public informations : web info (mod_profile_control_public_web.php)
$lang['profilcp_profil_base_shortcut']		= 'Public information';
$lang['Web_info']							= 'Web information';

// update profile : public informations : real info (mod_profile_control_public_real.php)
$lang['Real_info']							= 'Personal information';
$lang['Realname']							= 'Real name';
$lang['Date_error']							= 'day %d, month %d, year %d is not a valid date';

// update profile : public informations : messengers info (mod_profile_control_public_messengers.php)
$lang['Messengers']							= 'Messengers';

// update profile : public informations : contact info (mod_profile_control_public_contact.php)
$lang['Home_phone']							= 'Home phone';
$lang['Home_fax']							= 'Home fax';
$lang['Work_phone']							= 'Work phone';
$lang['Work_fax']							= 'Work fax';
$lang['Cellular']							= 'Cellular';
$lang['Pager']								= 'Pager';

// update profile : preferences - preferences panel ("Your profile")
$lang['Profile_control_panel']				= 'Profile Settings';

// update profile : preferences - i18n panel (mod_profile_control_panel_international.php)
$lang['Profile_control_panel_i18n']			= 'Internationalization';
$lang['summer_time']						= 'Are you in a daylight saving zone ?';

// update profile : preferences - notification panel (mod_profile_control_panel_notification.php)
$lang['Profile_control_panel_notification']	= 'Notification';

// update profile : preferences - posting panel (mod_profile_control_panel_posting.php)
$lang['Profile_control_panel_posting']		= 'Posting';

// update profile : preferences - privacy panel (mod_profile_control_panel_privacy.php)
$lang['Profile_control_panel_privacy']		= 'Privacy';
$lang['View_user']							= 'Show me online';
$lang['Public_view_pm']						= 'Accept private message';
$lang['Public_view_website']				= 'Display my web information';
$lang['Public_view_messengers']				= 'Display my messengers references';
$lang['Public_view_real_info']				= 'Display my personal information';

// update profile : preferences - reading panel (mod_profile_control_panel_reading.php)
$lang['Profile_control_panel_reading']		= 'Reading';
$lang['Public_view_avatar']					= 'Display avatars';
$lang['Public_view_sig']					= 'Display signatures';
$lang['Public_view_img']					= 'Display images';

// update profile : preferences - profile preferences
$lang['profile_prefer']						= 'Profile options';

// update profile : preferences - system panel (mod_profile_control_panel_system.php)
$lang['Profile_control_panel_system']		= 'System';
$lang['summer_time_set']					= 'Is it summer time ? (add +1 hour to local time)';
$lang['Forum_rules']						= 'Show forum rules on registration';

// update profile : preferences - admin part (mod_profile_control_panel_admin.php)
$lang['profilcp_admin_shortcut']			= 'Administration';
$lang['User_deleted']						= 'User was successfully deleted.';
$lang['User_special']						= 'Special admin-only fields';
$lang['User_special_explain']				= 'Diese Felder können nicht vom Benutzer bearbeitet werden. Hier kannst du unter anderem auch ihren Status bestimmen und andere Optionen die sie nicht bearbeiten können.';
$lang['User_status']						= 'User is active';
$lang['User_allow_email']					= 'Can send emails';
$lang['User_allow_pm']						= 'Can send Private Messages';
$lang['User_allow_website']					= 'Can show his web info';
$lang['User_allow_messenger']				= 'Can share his messengers adresses';
$lang['User_allow_real']					= 'Can show his personal information';
$lang['User_allowavatar']					= 'Can display avatar';
$lang['User_allow_sig']						= 'Can display his signature';
$lang['Rank_title']							= 'Rank Title';
$lang['User_delete']						= 'Delete this user';
$lang['User_delete_explain']				= 'Click here to delete this user; this cannot be undone.';
$lang['No_assigned_rank']					= 'No special rank assigned';
$lang['User_self_delete']					= 'You can delete your account being a board administrator';

// update profile : signature (profilcp_profile_signature.php)
$lang['profilcp_sig_preview']				= 'Signature preview';

// display profile (profilcp_public.php)
$lang['profilcp_public_shortcut']			= 'Public';
$lang['profilcp_public_pagetitle']			= 'Public display';
$lang['profilcp_public_base_shortcut']		= 'Base info';
$lang['profilcp_public_base_pagetitle']		= 'Profile base information';
$lang['profilcp_public_groups_shortcut']	= 'Groups';
$lang['profilcp_public_groups_pagetitle']	= 'Groups this user belong to';

// update profile : preferences - home panel (mod_profile_control_panel_home.php)
$lang['Profile_control_panel_home']			= 'Profile Home panel';
$lang['Profile_control_panel_home_buddy']	= 'Buddy lists';
$lang['Buddy_friend_display']				= 'Display my friend list on home panel';
$lang['Buddy_ignore_display']				= 'Display my ignore list on home panel';
$lang['Buddy_friend_of_display']			= 'Display "Friend of" list on home panel';
$lang['Buddy_ignored_by_display']			= 'Display "Ignored by" list on home panel';

$lang['Profile_control_panel_home_privmsg']	= 'Private messages';
$lang['Privmsgs_per_page']					= 'Number of private messages displayed per page on home panel';

$lang['Profile_control_panel_home_wtopics']	= 'Watched topics';
$lang['Watched_topics_per_page']			= 'Number of topics watched displayed per page on home panel';

// display profile : base info (profilcp_public_base.php)
$lang['Unavailable']						= 'Unavailable';
$lang['Last_visit']							= 'Last visit time';
$lang['User_pics']							= 'Uploaded pictures';
$lang['User_post_stats']					= '%s posts, %.2f%% of total, %.2f posts per day';
$lang['User_posts']							= 'User posts';
$lang['Most_active_topic']					= 'Most active topic';
$lang['Most_active_topic_stat']				= '%s posts, %.2f%% of the topic, %.2f%% of the forum';
$lang['Most_active_forum']					= 'Most active forum';
$lang['Most_active_forum_stat']				= '%s posts, %.2f%% of the forum, %.2f%% of total';

// register (profilcp_register.php)
$lang['profilcp_register_shortcut']			= 'Registering';
$lang['profilcp_register_pagetitle']		= 'Registration information';
$lang['profilcp_email_title']				= 'Email address';
$lang['profilcp_email_confirm']				= 'Confirm your Email address';
$lang['anti_robotic']						= 'Control picture';
$lang['anti_robotic_explain']				= 'This control is designed to prevent the flooding by the register robots';
$lang['profilcp_password_explain']			= 'You must confirm your current password if you wish to change it';
$lang['Agree_rules']						= 'By checking this box, you declare having taken knowledge of the terms, and agree with them';
$lang['profilcp_username_missing']			= 'Username missing';
$lang['profilcp_email_not_matching']		= 'Emails doesn\'t match';
$lang['Robot_flood_control']				= 'The control image doesn\'t match what you\'ve typed in';
$lang['Disagree_rules']						= 'You have declared you disagree with the rules used on this board, so you won\'t be able to register.';

$lang['Always_set_bm'] = 'Set bookmark automatically when posting';

// PCP Extra :: Added :: Start
$lang['Required_Error'] = 'The Field "%s" is required';
$lang['Required_field'] = '&nbsp;<font color=red>*</font>';
$lang['Required_explain'] = '&nbsp;<font color=red>*</font> = required field.';
$lang['Email_confirm'] = 'If you change your email address, you will need to re-activate your account through the link send to your new email address.';
$lang['Email_confirm_admin'] = 'If you change your email address, the administrator will need to re-activate your account.';
$lang['Email_confirm_guest'] = 'An email will be send to this address to activate your account';
$lang['Email_confirm_guest_admin'] = 'You will be informed to this address when your account has been activated by the administrator';
$lang['Visible_friends'] = '<br><i>(visible by friends only)</i>';
$lang['Visible_all'] = '<br><i>(visible by all users)</i>';
$lang['Visible_admin'] = '<br><i>(visible by administrators only)</i>';
$lang['Visible_board_email_all'] = '<br><i>(emails are always hidden and all users can send you an email trough the board)</i>';
$lang['Visible_board_email_friends'] = '<br><i>(emails are always hidden and only friends can send you an email trough the board)</i>';
$lang['Preferences'] = 'Preferences';
$lang['Privmsgs'] = 'Private Messages';
$lang['Buttons'] = 'Buttons';
$lang['Left'] = 'Left';
$lang['Viewtopic'] = 'View Topic';
// PCP Extra :: Added :: End
// Digests PCP :: Added :: Start
$lang['profilcp_digests_shortcut']			= 'Digests';
$lang['profilcp_digests_pagetitle']			= 'Digests';
// Digests PCP :: Added :: End
// Warning PCP :: Added :: Start
$lang['Warnings'] = 'Gelbe Karten : %d'; //shown beside users post, if any warnings given to the user
$lang['user_warnings'] = 'Gelbe Karten'; // field label
$lang['Banned'] = 'Currently banned';//shown beside users post, if user are banned
// Warning PCP :: Added :: End
// Auto Summer time :: Added :: Start
$lang['summer_time_auto_set'] = 'Automatically adjust the summer time?';
// Auto Summer time :: Added :: End
//  Mini Cal PCP :: Added :: Start
$lang['mini_cal_version_mycal'] = 'MyCalendar';
$lang['mini_cal_version_plus'] = 'MyCalendar+';
$lang['mini_cal_version_topic'] = 'Topic Calendar';
$lang['mini_cal_version_snail'] = 'Websnail Calendar Pro';
$lang['mini_cal_version_snaillite'] = 'Websnail Calendar Lite';
$lang['mini_cal_version_none'] = 'No Supported Calendar is installed';
$lang['mini_cal_calendar_version'] = 'Mini Cal Version';
$lang['mini_cal_calendar_version_explain'] = 'Defines which events calendar you are using, if any.';
$lang['mini_cal_limit'] = 'Mini Cal Limit';
$lang['mini_cal_limit_explain'] = 'Limits the number of events shown on the mini cal. Only for Event Calendars!';
$lang['mini_cal_days_ahead'] = 'Mini Cal Days Ahead';
$lang['mini_cal_days_ahead_explain'] = 'Limits the number of days ahead in which time upcoming events will be shown. Set to 0 (zero) for umlimited. Only for Event Calendars!';
$lang['mini_cal_search_posts'] = 'Search for Posts';
$lang['mini_cal_search_events'] = 'Search for Events';
$lang['mini_cal_date_search'] = 'Mini Cal Date Search';
$lang['mini_cal_date_search_explain'] = 'Defines what type of search happens when a user clicks on a date in the calendar. "Search for Events" is only for Event Calendars!';
$lang['mini_cal_fdow'] 				= 'Mini Kalender FDOW'; 
$lang['mini_cal_fdow_explain'] 			= 'First day of the week - 0=Sunday, 1=Monday...6=Saturday.'; 
$lang['mini_cal_link_class'] = 'Mini Cal Link Class';
$lang['mini_cal_link_class_explain'] = 'Defines the css class to use for mini cal days urls.';
$lang['mini_cal_today_class'] = 'Mini Cal Today Class';
$lang['mini_cal_today_class_explain'] = 'Defines the css class to use for mini cal today date.';
$lang['mini_cal_auth'] = 'Mini Cal Auth';
$lang['mini_cal_auth_explain'] = 'defines the authentication level required to be able to view the upcoming events. This relates to the permission level assigned to forum.';
//  Mini Cal PCP :: Added :: End
// signature control
$lang['sig_yes_not_controled'] = 'Yes not controled';
$lang['sig_yes_controled'] = 'Yes controled';
// right click
$lang['Extra_priv_explain'] ='Allow user to copy and right click';
// phpbb security admin
$lang['Force_security'] ='Force Security';
$lang['Force_security_explain'] ='Check this box and the user will be forced to re-activate his acount using the security question and answer.';
$lang['Reset_security'] ='Reset Security';
$lang['Reset_security_explain'] ='Check this box if the user locked himself out by mistyping his password too many times. This will reset the counter to 0.';
$lang['Clear_security'] ='Clear Security';
$lang['Clear_security_explain'] ='Check this box and the security question and answer of this user will be reset. The user will NOT be able to browse the forums untill he/she re-enters them.';
?>
