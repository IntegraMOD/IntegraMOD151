<?php
/***************************************************************************
 *                         lang_contact_faq.php [English]
 *                            -------------------
 *   begin                : Saturday, May 31, 2003
 *   version              : 3.0.0
 *   date                 : 2003/12/23 23:21
 ***************************************************************************/

//  IMPORTANT NOTICE!!
//  This version of lang_contact_faq.php is intended for use when you have installed
//  Prillian without installing the expanded version of Contact List that is
//  available separately. If you are using the expanded version of Contact List, use
//  the lang_contact_faq.php file provided in that version!

// 
// To add an entry to your FAQ simply add a line to this file in this format:
// $faq[] = array('question', 'answer');
// If you want to separate a section enter
// $faq[] = array('--', 'Block heading goes here if wanted');
// Links will be created automatically
//
// DO NOT forget the ; at the end of the line.
// Do NOT put single quotes (') in your FAQ entries, if you absolutely must then
// escape them i.e.. \'something\' or use double quotes (") at the beginning and end
// of the entries (in which case you'll need to escape any double quotes in the
// entry).
//
// The FAQ items will appear on the FAQ page in the same order they are listed in 
// this file
//
// To mention Contact List by name, use the variable
// $progname as it is used in the defaults
//

include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_contact.' . $phpEx);

$progname = $lang['Contact_List_FAQ'];

$faq[] = array('--', 'General Questions');
$faq[] = array('What are the ' . $progname . '?', $progname . ' are a means by which you can easily find or contact other users or prevent other users from finding or contacting you on the messenger software. The Lists include a Buddy List, an Ignore List, and a Disallow Contact List. A Disallow Contact List is like a lesser version of an Ignore List. It hides your contact information from listed users, but does not erase their presence from your sight like the Ignore List.');
$faq[] = array('So these lists are built into the messenger? Do they work in other parts of the forums?', 'Yes, the lists are built into the messenger. No, they do not work in other parts of the forums, except for the Contact Management control panel. The board administrator can install an expanded version of ' . $progname . ' to add functionality to other parts of the forums, such as user profiles, topics, the memberlist, private messages, and more.');
$faq[] = array('How do I edit my ' . $progname . '?', 'To edit your ' . $progname . ', simply access the <a href="' . append_sid(CONTACT_URL) . '">Control Panel</a>.');
$faq[] = array('How can I add a user to my ' . $progname . '?', 'Access the control panel and go to the page for the particular list to which you wish to add a user. Then enter the user\'s username in the form near the bottom of the page and press the Add User button.<br /><br />To add several users at once, access the control panel and click the ' . $lang['Add_contact_users_link'] . ' link. On that page, you can enter several usernames and add them all to your lists at one time.<br /><br />There are also links to add a user to or remove a user from your lists in the Read Message window.');

$faq[] = array('--', 'Using ' . $progname);
$faq[] = array('What features does the Buddy List provide?', 'The Buddy List is the most useful of the three lists. With the Buddy List, you can limit the users appearing in the IM Client to only buddies currently online (on either the messenger or the forums). You can also be alerted when a buddy comes online or goes offline.');
$faq[] = array('How do I choose to be alerted when a buddy comes online?', 'Access the control panel to see your Buddy List. Click the "Edit online and offline alert settings" link. From this page, you can choose to be alerted when certain users come online. Simply check off the users you wish to be alerted about and press the submit button. To stop being alerted about a user, uncheck them and press the submit button.');
$faq[] = array('What is the Buddies button in the Send Message window?', 'You can press this button to open a small window with a list of your buddies. The list lets you quickly see if a buddy is online or offline and click their name to place it in the Send Message window\'s username field.');
$faq[] = array('What features does the Ignore List provide?', 'When a user is on your ignore list, that user cannot send you any instant messages. Also, the user will not appear in the list of online users in the IM Client.');
$faq[] = array('What features does the Disallow List provide?', 'When a user is on your disallow list, that user cannot send you any instant messages. Also, the user will not be able to see you in the list of online users in the IM Client.');



//
// These entries should remain in all languages and for all modifications
//
$faq[] = array('--', $progname . ' Issues');
$faq[] = array('Who wrote this ' . $progname . ' software?', 'This software (in its unmodified form) is produced, released, and is copyrighted by <a href="http://darkmods.sourceforge.net/" target="_blank">Thoul</a>. It is based on and includes some code from the phpBB forum software, which (in its unmodified form) is produced, released, and is copyrighted by <a href="http://www.phpbb.com/" target="_blank">phpBB Group</a>. Both are made available under the GNU General Public License and may be freely distributed; see the links for more details.');
$faq[] = array('Why isn\'t X feature available?', 'This software was written by and licensed through the phpBB Group (in the case of the forum software) and Thoul (in the case of the ' . $progname . ' ). If you believe a feature needs to be added to the instant messenger software then please visit the darkmods.sourceforge.net website and see if anything has been said about it in the forums there. If not, post a feature request in the forums or via the Sourceforge interface.');
$faq[] = array('Whom do I contact about abusive and/or legal matters related to these  ' . $progname . ' ?', 'You should contact the administrator of this board. If you cannot find who that is, you should first contact one of the forum moderators and ask them who you should in turn contact. If still get no response you should contact the owner of the domain (do a whois lookup) or, if this is running on a free service (e.g. yahoo, free.fr, f2s.com, etc.), the management or abuse department of that service. Please note that Thoul has absolutely no control and cannot in any way be held liable over how, where or by whom this board is used. It is absolutely pointless contacting Thoul in relation to any legal (cease and desist, liable, defamatory comment, etc.) matter not directly related to the darkmods.sourceforge.net website or the discrete software of the ' . $progname . ' itself. If you do email Thoul about any third party use of this software then you should not expect a response.');

//
// This ends the FAQ entries
//

?>