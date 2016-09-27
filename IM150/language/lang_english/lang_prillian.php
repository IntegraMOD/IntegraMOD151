<?php
/***************************************************************************
 *                          lang_prillian.php [English]
 *                            -------------------
 *   begin                : Friday, Jan 31, 2003
 *   version              : 0.7.0
 *   date                 : 2003/12/23 23:21
 ***************************************************************************/

//
// CONTRIBUTORS:
//	 Add your details here if wanted, e.g. Name, username, email address, website
//

//
// The format of this file is ---> $lang['message'] = 'text';
// The file will be included separately of other language files as needed, but must
// be included after lang_main.php and/or lang_admin.php
//
//
// This is optional, if you would like a _SHORT_ message output
// along with the phpBB copyright message indicating you are the translator
// please add it here.
// $lang['TRANSLATION'] .= '';

// Do not change the next six lines.
// Avoid including the file more than once.
if ( defined('IN_PRILLIAN_LANG') )
{
	return;
}
define('IN_PRILLIAN_LANG', true);

// You may want to edit the following lines to match your website.
$lang['Launch_Prillian'] = 'Launch Prillian';  // Link for opening the IM Client
$lang['Prillian_FAQ'] = 'Instant Messenger';   // Title of the IM FAQ
$lang['Prillian'] = 'Prillian';  // Name of Prillian, used throughout the scripts

$lang['New_ims'] = 'You have %d new IMs'; // You have 2 new IMs
$lang['New_im'] = 'You have %d new IM'; // You have 1 new IM
$lang['Unread_ims'] = 'You have %d unread IMs'; // You have 2 new IMs
$lang['Unread_im'] = 'You have %d unread IM'; // You have 1 new IM

// Main IM Client/Who's Online window
$lang['Users_Online'] = 'Users Online';
$lang['Buddies_Online'] = 'Buddies Online';
$lang['Hidden_Users_Online'] = 'Hidden Users Online';
$lang['Guests_Online'] = 'Guests Online';
$lang['Close_windows'] = 'Close Windows';
$lang['Send_im'] = 'Send Instant Message';
$lang['IM'] = 'IM';
$lang['PM'] = 'PM';
$lang['New_messages'] = 'New and Unread Messages';


// Controls panels
$lang['Controls'] = 'Controls';
$lang['Check_IMs'] = 'Check for IMs';
$lang['Message_Log'] = 'Message Log';
$lang['Alt_Message_Log'] = 'Open Message Log';
$lang['Alt_New_Messages'] = 'Check for New Messages';
$lang['Alt_Home'] = 'Return to Forums';
$lang['Alt_Close_Windows'] = 'Close All Child Windows';
$lang['Alt_Prefs'] = 'Edit ' . $lang['Prillian'] . ' Preferences';
$lang['Alt_Logout'] = 'Log Out of Forum and ' . $lang['Prillian'];
$lang['Prillian_Help'] = 'Help';


// Sending/replying
$lang['phpBB_IM_default_subject'] = $lang['Message'];
//$lang['Prillian_default_subject'] = $lang['Message'];
$lang['Send_new_im'] = 'Send a new Instant Message';
$lang['Select_emoticon'] = 'Select Emoticons';
$lang['Save_reply_pm'] = 'Save and Reply';
$lang['Save_close_pm'] = 'Save and Close';
$lang['Delete_reply_pm'] = 'Delete and Reply';
$lang['Delete_close_pm'] = 'Delete and Close';
$lang['IM_Quick_reply'] = 'Quick Reply';


// Error messages
$lang['Close_window_link'] = '<br /><br /><a href="javascript:window.close();">' . $lang['Close_window'] . '</a>';
$lang['IM_disabled'] = 'Sorry, but Instant Messaging has been disabled on this board.';
$lang['Ims_not_allowed'] = 'Sorry, but Instant Messaging has been disabled on that user\'s account.';
$lang['Ims_not_allowed_fail'] = 'Could not check to see if instant messaging has been disabled on that user\'s account.';
$lang['Cannot_send_im'] = 'Sorry, but Instant Messaging has been disabled on your account. If you disabled Instant Messaging, you can enable it in your %spreferences%s.';
$lang['Cannot_send_im_admin'] = 'Sorry, but Instant Messaging has been disabled on your account by the board administrator.';
$lang['Please_set_im_prefs'] = 'You have not yet set your Instant Messenger preferences. Please take a moment to do so %shere%s.';
$lang['Admin_override'] = 'Sorry, but the board administrator has set the board to override user preferences with the global board preferences. You cannot change your preferences while this is in effect.';
$lang['Too_many_ims'] = 'Sorry, but that user has too many instant messages waiting for them. Try again later.';
$lang['No_autoclose'] = 'If you are seeing this message, then the automatic window closing feature of ' . $lang['Prillian'] . ' does not work with your browser. Possible causes including having your browser\'s JavaScript disabled. Please close this window.';
$lang['User_no_im'] = 'You cannot send an Instant Message to that user. ';
$lang['No_im_reply_info'] = 'Could not get message information. This probably means the message has already been automatically deleted.';
$lang['No_Admins_Found'] = 'No board administrators could be found in the database.';
$lang['No_post_type'] = 'Could not determine message type.';
$lang['Admin_no_user_from'] = 'Could not determine which sender to look up.';
$lang['Admin_no_user_to'] = 'Could not determine which receiver to look up.';


// Site to Site
$lang['IM_no_users_online'] = 'There are no users online.';
$lang['Online_at'] = 'User is online at ';
$lang['User_from'] = 'User from ';


// Admin Site to Site
$lang['URL'] = 'URL';
$lang['Extension'] = 'File Extension';
$lang['Profile_path'] = 'Path to profile';
$lang['Extension_explain'] = 'This is "php" by default';
$lang['Profile_path_explain'] = 'This is "profile" by default';


// Preferences editor
$lang['Prillian_Profile_updated'] = 'Your preferences have been updated.<br /><br />If needed, click %shere%s to reload the IM Client.';

$lang['User_allow_ims'] = 'Enable Instant Messaging System for this account';
$lang['User_allow_shout'] = 'Allow use of shoutbox';
$lang['User_allow_chat'] = 'Allow use of chatbox';
$lang['Always_add_sig_explain'] = 'Signatures can be changed in your profile';
$lang['Refresh_rate'] = 'Main Window Refresh Rate';
$lang['Refresh_rate_explain1'] = 'Number of seconds between refreshes in IM Client.';
$lang['Refresh_rate_explain2'] = 'Time between refreshes in IM Client.';
$lang['Success_close'] = 'Automatically close message windows after sending a message';
$lang['Refresh_method'] = 'Choose IM Client refresh method';
$lang['Refresh_method_explain'] = 'Using both is recommended';
$lang['JavaScript'] = 'JavaScript';
$lang['META_tag'] = 'META tag'; 
$lang['Use_both_methods'] = 'Use Both';
$lang['IM_auto_launch_pref'] = 'Launch client when you visit forum index'; 
$lang['IM_auto_popup'] = 'Automatically open new messages';
$lang['IM_list_new'] = 'List new and unread messages in main window';
$lang['Show_controls'] = 'Show Controls Panel';
// Do not change the [0], [1], etc. parts of the following
$lang['Controls_select'][0] = 'Do not show';
$lang['Controls_select'][1] = 'As Images Only';
$lang['Controls_select'][2] = 'As Links Only';
$lang['Controls_select'][3] = 'As Both';
$lang['Who_to_list'] = 'List these users in the main window';
$lang['Online_Lists'][1] = 'All online users';
$lang['Online_Lists'][2] = 'Buddies on forums';
$lang['Online_Lists'][3] = 'Buddies on IM';
$lang['Online_Lists'][4] = 'All users on IM';

// Include any options you want in the refresh rate drop down list here
// They should be in this format:
// $lang['Refresh_times']['number of seconds'] = 'name in list';
// The number of seconds can be no longer than 5 digits, unless you alter
// the im_prefs database table.
$lang['Refresh_times'][60] = '1 minute';
$lang['Refresh_times'][120] = '2 minutes';
$lang['Refresh_times'][180] = '3 minutes';
$lang['Refresh_times'][240] = '4 minutes';
$lang['Refresh_times'][300] = '5 minutes';

$lang['IM_play_sound'] = 'Play sound on new messages';
$lang['Default_sound'] = 'Use board\'s default sound';
$lang['Current_sound'] = 'Current Sound File';
$lang['IM_style'] = 'Style used by ' . $lang['Prillian'];
$lang['Width'] = 'Width';
$lang['Height'] = 'Height';
$lang['Read_Message'] = 'Read Message';
$lang['Send_Message'] = 'Send Message';
$lang['Set_window_sizes'] = 'Set Window Sizes';
$lang['Set_window_sizes_explain'] = 'All sizes are in Pixels';
$lang['Open_pms'] = 'Open and/or list private messages';
$lang['Auto_delete_ims'] = 'Enable automatic deletion of read instant messages on refresh of IM Client';

// Admin preferences editor
$lang['Admin_allow_ims'] = 'Allow user to send and receive instant messages';
$lang['Admin_allow_shout'] = 'Allow user to use shoutbox';
$lang['Admin_allow_chat'] = 'Allow user to use chatbox';
$lang['IM_user_auto_launch'] = 'Launch client automatically when user visits forum index and is logged in';
$lang['Admin_user_added'] = 'The user has been added to the preferences database.';
$lang['Admin_Set_window_sizes'] = 'Set Default Window Sizes';


// Admin Configuration
$lang['IM_auto_launch'] = 'Launch client automatically when logged in user visits forum index'; 
$lang['IM_box_limit'] = 'Max unread instant messages';
$lang['IM_enable_flood'] = 'Enable Flood Control';
$lang['IM_override_settings'] = 'Override individual user settings';
$lang['IM_override_settings_explain'] = 'This disables the User Preferences and uses the board defaults set in the options here';
$lang['IM_enable_ims'] = 'Enable Instant Messaging System';
$lang['IM_enable_shoutbox'] = 'Enable Shoutbox';
$lang['IM_enable_chatbox'] = 'Enable Chatbox';
$lang['IM_refresh_drop'] = 'Use drop down list for user refresh rate preference';
$lang['IM_sound_name'] = 'Location of sound file';
$lang['IM_allow_sound'] = 'Allow users to play a sound when receiving new messages';
$lang['IM_default_sound'] = 'Allow users to play their own sound';
$lang['IM_allow_different_style'] = 'Allow ' . $lang['Prillian'] . ' to use a different style than the rest of the forum';
$lang['Prillian_Config'] = $lang['Prillian'] . ' General Configuration';
$lang['Prillian_Config_explain'] = 'The form below will allow you to customize all the general messenger options. These are used to define default behaviors and user options. For individual user configurations, use the related links in the other frame.';
$lang['IM_session_length'] = 'IM Client Session Length in seconds';
$lang['IM_session_length_explain'] = 'This is used to determine if a user is active on the messenger. It is recommended to set this greater than the refresh rate.';
$lang['IM_enable_imbox_limit'] = 'Enable the limit on max unread instant messages';


// Message Log
$lang['Messages_Sent_by'] = 'Messages Sent by ';
$lang['Messages_Received_by'] = 'Messages Received by ';
$lang['Offsite_Messages_Sent_by'] = 'Off-Site Messages Sent by ';
$lang['Offsite_Messages_Received_by'] = 'Off-Site Messages Received by ';
$lang['Received'] = 'Received';
$lang['Offsite_Received'] = 'Off-Site Received';
$lang['Offsite_Sent'] = 'Off-Site Sent';
$lang['No_sent'] = 'There are no stored messages sent by you.';
$lang['No_received'] = 'There are no stored messages received by you.';
$lang['Message_Log_admin_explain'] = 'Here you can review instant messages sent and received by your users.';



/* Entries Added in 0.7.0 */
$lang['Prill_new_posts'] = 'Posts Since Last Visit';
$lang['No_prill_config'] = 'Could not query Prillian config information';
$lang['No_prill_prefs'] = 'Could not query IM preferences table';
$lang['No_prill_userprefs'] = 'User not found in IM preferences table';
$lang['Not_authed_im_delete'] = 'Sorry, you cannot delete messages you have sent.';
$lang['Back_to_log'] = '%sReturn to Message Log%s';
$lang['Mini_Client_Window'] = 'Mini Client Mode';
$lang['Use_frames'] = 'Use frames in IM Client';
$lang['Use_frames_explain'] = 'Using frames speeds up loading when checking for new messages.';
$lang['Use_frames_explain_admin'] = $lang['Use_frames_explain'] . ' This can save bandwidth and result in less server load.';
$lang['Default_mode'] = 'Mode to Use when IM Client is launched';
// Do not change the [0], [1], etc. parts of the following
$lang['Default_mode_select'][0] = 'Last Mode Used';
$lang['Default_mode_select'][1] = 'Main Mode';
$lang['Default_mode_select'][2] = 'Wide Mode';
//Be careful! Do not uncomment the next line!
//$lang['Default_mode_select'][3] = 'Mini Mode';
$lang['Size'] = 'Size';
$lang['Color'] = 'Color';
$lang['Enabled_explain'] = 'If set to No, you users will not be allowed to interact with this site.';
$lang['Profile_path_ex_expanded'] = 'Enter the path to your profile.php file, relative to the forum root directory. This is used for Network Messaging\'s auto-detection feature when other site admins attempt to auto-detect your site. Do  not include the file extension, e.g., use "profile" instead of "profile.php"';
$lang['Network_autodetect'] = 'Auto Detect a New Site';
$lang['Network_autodetect_explain'] = 'Enter the URL of a forum below, and Prillian will attempt to connect to a Prillian installation on the forum at that URL. If the connection is established, Prillian will try to automatically add that site to your Network list.<br /><br />When entering the URL, ensure that it begins with either http:// or ftp:// and ends in a slash. No files names should be included. This is correct:<br />http://darkmods.sourceforge.net/mb/<br /><br />These are not correct:<br />darkmods.sourceforge.net/mb/<br />http://darkmods.sourceforge.net/<br />darkmods.sourceforge.net/mb<br />http://darkmods.sourceforge.net/mb/imclient.php<br />http://darkmods.sourceforge.net/mb/imclient.php/';
$lang['No_allow_url_fopen'] = 'The allow_url_fopen PHP configuration setting is turned off. This means that PHP scripts on this server cannot connect to remote sites. As a result, you cannot use Network Messaging. For information about enabling this option, please speak to your webhost or server administrator. If you *are* that person and need further information, check the <a href="http://www.php.net/manual" target="_blank">PHP manual</a>, particularly in Configuration chapters.<br /><br />While you see this message, you should disable Network Messaging in the Prillian Configuration to increase Prillian\'s speed. You can enable Network Messaging later if desired.';
$lang['ND_cannot_add'] = 'The site at the URL you entered cannot be added to your Network.';
$lang['ND_no_connect'] = 'The script could not connect to the remote site using this URL:';
$lang['ND_no_connect_explain'] = 'Please ensure that you typed the URL correctly, and that it begins with either http:// or ftp://. Also check that the site is online. If it is not, try again later.<br /><br />If the URL is correct and the site is online, then Prillian\'s Network Messaging component is not installed at that URL. ' . $lang['ND_cannot_add'];
$lang['ND_disabled'] = 'Network Messaging is disabled at the remote site. ' . $lang['ND_cannot_add'];
$lang['ND_connected'] = 'The script was able to connect to the remote site successfully!';
$lang['ND_enabled'] = 'Network Messaging is enabled at the remote site.';
$lang['ND_version'] = 'A different version of Prillian is installed at the remote site, so there may be some conflicts between your version and the script on the remote site. We will still proceed with auto-detection at this time.';
$lang['ND_060'] = 'The script has detected that Prillian 0.6.0 is installed at the remote site. Prillian 0.6.0 does not support auto-detection, and the script cannot add this site to your Network. You may add it manually, if you desire. You can also encourage the admin of the remote site to upgrade to the latest version of Prillian.';
$lang['ND_Unnamed_Site'] = 'Unnamed Detected Site';
$lang['ND_data_error'] = 'There are some problems with the auto-detection data reported by the remote site, so this site will be added to your Network in a disabled status with at least one default value entered. You should review the information through the Network Messaging Editor later. The error may be something as simple as an empty site name field.';
$lang['ND_Added_Success'] = 'The Site has been successfully added to your Network!';
$lang['Allow_mode_switch'] = 'Allow users to choose different IM Client modes';

// These three will be used when there are images for the mode switches
//$lang['Alt_Main_Mode'] = 'Switch IM Client to Main Mode';
//$lang['Alt_Wide_Mode'] = 'Switch IM Client to Wide Mode';
//$lang['Alt_Mini_Mode'] = 'Switch IM Client to Mini Mode';
$lang['Alt_Main_Mode'] = 'Main Mode';
$lang['Alt_Wide_Mode'] = 'Wide Mode';
$lang['Alt_Mini_Mode'] = 'Mini Mode';
$lang[''] = '';
$lang[''] = '';
$lang[''] = '';
$lang[''] = '';

// Adapted from Enhanced Admin User Lookup
$lang['User_lookup_explain'] = 'You can lookup users by specifying one or more of the criteria below. No wildcards are needed, they will be added automatically.';
$lang['One_user_found'] = 'Only one user was found, you are being taken to that user';
$lang['Click_goto_prefs'] = 'Click %sHere%s to edit this user\'s preferences';
$lang['Click_goto_log'] = 'Click %sHere%s to view this user\'s messages';
$lang['User_joined_explain'] = 'The syntax used is identical to the PHP <a href="http://www.php.net/strtotime" target="_other">strtotime()</a> function';
$lang['Click_return_perms_admin'] = 'Click %sHere%s to return to User Permissions Control';


/* Entries Changed in 0.7.0 */

// Controls panels
$lang['Alt_Contact_Man'] = 'Manage Contacts'; // Was $lang['Alt_Buddy_Man']

// Preferences editor
$lang['Wide_Client_Window'] = 'Wide Client Mode'; // Was $lang['Whos_Online_Window']
$lang['Main_Window'] = 'Main Client Mode';

/* Any of these that have network in the $lang['name'] part used to have s2s in
 place of network. In some, that is the only change */
// Network Messaging
$lang['Network_disabled'] = 'Sorry, but Network Messaging has been disabled on this board.';
$lang['Network_no_username'] = 'Network Messaging did not receive either your username or user id.';
$lang['Network_no_siteurl'] = 'Network Messaging did not receive the site url of the site from which you are sending your message.';
$lang['Network_no_siteid'] = 'Network Messaging did not receive the site id of the site to which you are sending your message.';
$lang['Network_Users_online'] = 'Users Online at Other Sites';
$lang['No_network_type'] = 'Could not determine type.';
$lang['Invalid_network_type'] = 'Could not determine a valid type.';
$lang['Network_not_in_db'] = 'Sorry, but the site your are sending your message from is not in the list of approved sites on the site to which you are attempting to send the message.';
$lang['Send_a_new_network'] = 'Send a new Network Message';
$lang['Reply_to_a_network'] = 'Reply to a Network Message';
$lang['Network_Flood_Error'] = 'Network Messaging cannot receive a post so soon after the last. Please try again in a short while.';

// Admin Network Messaging
$lang['Network_title'] = 'Network Messaging Editor';
$lang['Network_explain'] = 'On this page, you can add, edit, and remove the sites your users can interact with via Prillian\'s Network Messaging feature.';
$lang['Network_add'] = 'Add a New Site';
$lang['Network_del_success'] = 'The site was successfully deleted. Your users can no longer interact with that site through Prillian.';
$lang['Click_return_network'] = 'Click %shere%s to return to Network Messaging.';
$lang['Network_config'] = 'Site Configuration';
$lang['Network_add_success'] = 'The site information was successfully modified.';

// Admin preferences editor
$lang['Admin_allow_network'] = 'Allow user to use Network Messaging';

// Preferences editor
$lang['User_allow_network'] = 'Enable Network Messaging for this account';
$lang['Network_user_list'] = 'Choose a method for displaying users online at other sites';
// Do not change the [0], [1], etc. parts of the following
$lang['network_lists'][0] = 'Do not display';
$lang['network_lists'][1] = 'Display with users on this site';
$lang['network_lists'][2] = 'Display separately from users on this site';

// Admin Configuration
$lang['IM_allow_network'] = 'Enable Network Messaging system';
/* End of the s2s -> network changes */



/*
The following entries were removed in 0.7.0

$lang['PUU_Constant']
$lang['PPU_Constant']
$lang['PUU_Constant_explain']
$lang['PPU_Constant_explain']
*/
?>