<?php
/***************************************************************************
 *                          lang_contact.php [English]
 *                            -------------------
 *   begin                : Friday, Jan 31, 2003
 *   version              : 0.8.0
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
// along with our copyright message indicating you are the translator
// please add it here.
// $lang['TRANSLATION'] = '';

// Do not change the next six lines.
// Avoid including the file more than once.
if ( defined('IN_CONTACT_LANG') )
{
	return;
}
define('IN_CONTACT_LANG', true);

// You may want to edit the following lines to match your website.
$lang['Buddy'] = 'Buddy';
$lang['Ignore'] = 'Ignore';
$lang['Disallow'] = 'Disallow';
$lang['User_ignoring_you'] = 'That user has placed you on their ignore list.';
$lang['User_not_want_contact'] = 'That user has placed you on their disallow list.';
$lang['Buddies_online'] = 'These Buddies have come online';
$lang['Buddy_online'] = 'This buddy has come online';
$lang['Buddies_offline'] = 'These Buddies are now offline';
$lang['Buddy_offline'] = 'This Buddy is now offline';
$lang['Listbox_Buddies'] = 'Your Buddies';
$lang['Online'] = 'Online';
$lang['Offline'] = 'Offline';
$lang['Buddies'] = 'Buddies';
$lang['Ignored_some_users'] = 'Some users on this page were ignored. %sView this page with those users?%s';
$lang['Ignore_some_users'] = '%sView this page without ignored users?%s';

// These will be used in the user profiles for links to do the indicated thing
// Also used as ALT text for images in several places.  %s will be replaced with a
// user's name
$lang['Add_to_buddy'] = 'Add %s to your buddy list';
$lang['Remove_from_buddy'] = 'Remove %s from your buddy list';
$lang['Add_to_ignore'] = 'Add %s to your ignore list';
$lang['Remove_from_ignore'] = 'Remove %s from your ignore list';
$lang['Add_to_disallow'] = 'Add %s to your disallow contact list';
$lang['Remove_from_disallow'] = 'Remove %s from your disallow contact list';


// Error Messages
$lang['No_alerts_updated'] = 'No users were indicated for alert updates';
$lang['No_autoclose'] = 'If you are seeing this message, then the automatic window closing feature does not work with your browser. Possible causes including having your browser\'s JavaScript disabled. Please close this window.';

// Control Panel
$lang['Users_you_ignore'] = 'Users You are Ignoring';
$lang['Users_you_disallow'] = 'Users You Do Not Allow to Contact You';
$lang['Users_buddy_you'] = 'Users Listing You as a Buddy';
$lang['Users_you_buddy'] = 'Your Buddies';
$lang['None_you_ignore'] = 'You are not ignoring any users.';
$lang['None_you_disallow'] = 'You are allowing all users to contact you.';
$lang['None_buddy_you'] = 'No users have listed you as a buddy.';
$lang['None_you_buddy'] = 'You have no buddies.';
$lang['Add_a_user'] = 'Add a User to this List?';
$lang['Add_user'] = 'Add user';
$lang['Move_selected_users'] = 'Move the selected users to:';
$lang['Buddy_link'] = 'Buddies';
$lang['Buddied_link'] = 'Buddy of...';
$lang['Ignore_link'] = 'Ignoring';
$lang['Disallow_link'] = 'Disallowing';
$lang['Be_alerted'] = 'Alert me when this user comes online';
$lang['Edit_alerts'] = 'Edit online and offline alert settings';

// Success messages
$lang['Alerts_updated'] = 'Alert preferences updated for all changed buddies';
$lang['Alerts_oops'] = ' except the following, which could not be found:<br />';
$lang['Moved_to_buddies'] = 'The indicated users have been moved to your Buddy List.';
$lang['Moved_to_ignore'] = 'The indicated users have been moved to your Ignore List.';
$lang['Moved_to_disallow'] = 'The indicated users have been moved to your Disallow List.';
$lang['Removed_selected_users'] = 'The indicated users have been removed.';
$lang['Buddy_updated'] = 'Buddy List Updated';
$lang['Ignore_updated'] = 'Ignore List Updated';
$lang['Disallow_updated'] = 'Disallow List Updated';


// For Prillian
$lang['Close_window_link'] = '<br /><br /><a href="javascript:window.close();">' . $lang['Close_window'] . '</a>';

/* Entries Added in Prillian 0.7.0 & Contact List 0.3.0 */
$lang['No_ignore_admin'] = 'You have tried to ignore or disallow the following administrators or moderators: %s. Please resubmit the changes without trying to ignore or disallow these users.<br />';
$lang['No_contact_add_self'] = 'You have tried to add yourself to one of your contact lists.  This is not allowed; please resubmit the changes without trying to add yourself to your own contact lists.';
$lang['Add_Selected_as_Buddies'] = 'Add Selected as Buddies';
$lang['Add_contact_users_link'] = 'Add New Contacts';
$lang['You_have_buddies'] = 'You have %d buddies.';
$lang['You_have_buddy'] = 'You have one buddy.';
$lang['You_are_ignoring'] = 'You are ignoring %d users.';
$lang['You_are_ignoring_one'] = 'You are ignoring one user.';
$lang['You_have_disallowed'] = 'You are not allowing %d users to contact you.';
$lang['You_have_disallowed_one'] = 'You are not allowing one user to contact you.';
$lang['You_as_buddies'] = '%d users have added you as a buddy.';
$lang['You_as_buddy'] = 'One user has added you as a buddy.';
$lang['Add_many_contacts_explain'] = 'You may add several users to your buddy, ignore, or disallow lists here.  Enter the name of each user you wish to add in the text box below.  Each user\'s name must be on a separate line.';
$lang['Add_to_Buddy_List'] = 'Add to Buddy List';
$lang['Add_to_Ignore_List'] = 'Add to Ignore List';
$lang['Add_to_Disallow_List'] = 'Add to Disallow List';


/* Entries Changed in Prillian 0.7.0 & Contact List 0.3.0 */
/* Any of these that have contact in the $lang['name'] part used to have bid or
 buddy in place of contact. In some, that is the only change */
$lang['Contact_List_FAQ'] = 'Contact Lists'; // Title of the FAQ

$lang['Contact_Management'] = 'Contact Management';

// Error Messages
$lang['No_contact_mode'] = 'No Contact mode defined';
$lang['No_contact_type'] = 'No Contact type defined';
$lang['No_contact_action'] = 'No Contact action defined';
$lang['No_contact_id'] = 'No Contact user id';
$lang['Invalid_contact_action'] = 'Contact Action definition is invalid';


// Control Panel
$lang['Contact_click_here'] = '%sManage Contact List%s';


// Success messages
$lang['Confirm_contact_changes'] = 'Are you sure you wish to make those changes?';
$lang['No_Contact_changes'] = 'No changes were specified';


//Private Message alerts
$lang['System_title'] = 'Contact List System Message';
$lang['Contact_Alert_PM'] = '[url=%s]%s[/url] has added you to his or her Buddy List.  To manage your Contact List, please [url=%s]click here[/url]. This is an automated message sent by the forum software; you do not need to reply to this message.';


/* Removed entries
$lang['PM_Alert_Moved']
$lang['PM_Alert_Removed']
$lang['PM_Alert_Added']        <--- These two were merged into
$lang['PM_Alert_end']          <----/            $lang['Contact_Alert_PM']
$lang['Ignored_link']
$lang['Disallowed_link']
$lang['Users_ignoring_you']
$lang['Users_disallow_you']
$lang['None_ignoring_you']
$lang['None_disallow_you']

*/

?>