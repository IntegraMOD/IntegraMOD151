<?php
/***************************************************************************
 *                            lang_main.php [English]
 *                              -------------------
 *     begin                : Sat Dec 16 2000
 *     copyright            : (C) 2001 The phpBB Group
 *     email                : support@phpbb.com
 *
 *
 ****************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

//
// CONTRIBUTORS:
//	 Add your details here if wanted, e.g. Name, username, email address, website
// 2002-08-27  Philip M. White        - fixed many grammar problems
//

//
// The format of this file is ---> $lang['message'] = 'text';
//
// You should also try to set a locale and a character encoding (plus direction). The encoding and direction
// will be sent to the template. The locale may or may not work, it's dependent on OS support and the syntax
// varies ... give it your best guess!
//

$lang['ENCODING'] = 'iso-8859-1';
$lang['DIRECTION'] = 'ltr';
$lang['LEFT'] = 'left';
$lang['CENTER'] = 'center';
$lang['RIGHT'] = 'right';
$lang['DATE_FORMAT'] =  'd M Y'; // This should be changed to the default date format for your language, php date() format
$lang['Ignore'] = 'Ignore';

// This is optional, if you would like a _SHORT_ message output
// along with our copyright message indicating you are the translator
// please add it here.(ADDED TO CLEAR OTHER LANG INFO)
$lang['TRANSLATION_INFO'] = '';

//
// Common, these terms are used
// extensively on several pages
//
$lang['Forum'] = 'Forum';
$lang['Category'] = 'Category';
$lang['Topic'] = 'Topic';
$lang['Topics'] = 'Topics';
$lang['Replies'] = 'Replies';
$lang['Views'] = 'Views';
$lang['Post'] = 'Post';
$lang['Posts'] = 'Posts';
$lang['Posted'] = 'Posted';
$lang['Username'] = 'Username';
$lang['Password'] = 'Password';
$lang['Email'] = 'Email';
$lang['Poster'] = 'Poster';
$lang['Author'] = 'Author';
$lang['Time'] = 'Time';
$lang['Hours'] = 'Hours';
$lang['Message'] = 'Message';

$lang['1_Day'] = '1 Day';
$lang['7_Days'] = '7 Days';
$lang['2_Weeks'] = '2 Weeks';
$lang['1_Month'] = '1 Month';
$lang['3_Months'] = '3 Months';
$lang['6_Months'] = '6 Months';
$lang['1_Year'] = '1 Year';

$lang['Go'] = 'Go';
$lang['Jump_to'] = 'Jump to';
$lang['Submit'] = 'Submit';
$lang['Reset'] = 'Reset';
$lang['Cancel'] = 'Cancel';
$lang['Preview'] = 'Preview';
$lang['Confirm'] = 'Confirm';
$lang['Spellcheck'] = 'Spellcheck';
$lang['Yes'] = 'Yes';
$lang['No'] = 'No';
$lang['Enabled'] = 'Enabled';
$lang['Disabled'] = 'Disabled';
$lang['Error'] = 'Error';

$lang['Next'] = 'Next';
$lang['Previous'] = 'Previous';
$lang['Goto_page'] = 'Goto page';
$lang['Joined'] = 'Joined';
$lang['IP_Address'] = 'IP Address';

$lang['Select_forum'] = 'Select a forum';
$lang['View_latest_post'] = 'View latest post';
$lang['View_newest_post'] = 'View newest post';
$lang['Page_of'] = 'Page <b>%d</b> of <b>%d</b>'; // Replaces with: Page 1 of 2 for example

$lang['ICQ'] = 'ICQ Number';
$lang['AIM'] = 'AIM Address';
$lang['MSNM'] = 'MSN Messenger';
$lang['YIM'] = 'Yahoo Messenger';

$lang['Forum_Index'] = '%s Forum Index';  // eg. sitename Forum Index, %s can be removed if you prefer
//
$lang['Post_new_topic'] = 'Post new topic';
$lang['Reply_to_topic'] = 'Reply to topic';
$lang['Reply_with_quote'] = 'Reply with quote';

$lang['Click_return_topic'] = 'Click %sHere%s to return to the topic'; // %s's here are for uris, do not remove!
$lang['Click_return_login'] = 'Click %sHere%s to try again';
$lang['Click_return_forum'] = 'Click %sHere%s to return to the forum';
$lang['Click_view_message'] = 'Click %sHere%s to view your message';
$lang['Click_return_modcp'] = 'Click %sHere%s to return to the Moderator Control Panel';
$lang['Click_return_group'] = 'Click %sHere%s to return to group information';

$lang['Admin_panel'] = 'Admin';

$lang['Board_disable'] = 'Sorry, but this board is currently unavailable.  Please try again later.';
$lang['View_post'] = 'View Post';
$lang['Acronym'] = 'Acronym';

$lang['Total_votes'] = 'Total Votes : ';
$lang['Voted_show'] = 'Voted : '; // it means :  users that voted  (the number of voters will follow)
$lang['Results_after'] = 'Results will be visible after the poll expires';
$lang['Poll_expires'] = 'Poll expires in : ';
$lang['Minutes'] = 'Minutes';
$lang['Max_vote'] = 'Maximum selections';
$lang['Max_vote_explain'] = '[ Enter 1 or leave blank to allow only one selection ]';
$lang['Max_voting_1_explain'] = 'Please select only ';
$lang['Max_voting_2_explain'] = ' answers';
$lang['Max_voting_3_explain'] = ' (selections above limit will be ignored)';
$lang['Vhide'] = 'Hide';
$lang['Hide_vote'] = 'Results';
$lang['Tothide_vote'] = 'Sum of votes';
$lang['Hide_vote_explain'] = '[ Hide until poll expires ]';

//
// Global Header strings
//
$lang['Day_users'] = 'There have been %d registered users online in the last %d hours:';
$lang['Not_day_users'] = '%d registered users <span style="color:red">Didn\'t</span> visit during the last %d hours:'; 

$lang['Registered_users'] = 'Registered Users:';
$lang['Browsing_forum'] = 'Users browsing this forum:';
$lang['Online_users_zero_total'] = 'In total there are <b>0</b> users online :: ';
$lang['Online_users_total'] = 'In total there are <b>%d</b> users online :: ';
$lang['Online_user_total'] = 'In total there is <b>%d</b> user online :: ';
$lang['Reg_users_zero_total'] = '0 Registered, ';
$lang['Reg_users_total'] = '%d Registered, ';
$lang['Reg_user_total'] = '%d Registered, ';
$lang['Hidden_users_zero_total'] = '0 Hidden and ';
$lang['Hidden_user_total'] = '%d Hidden and ';
$lang['Hidden_users_total'] = '%d Hidden and ';
$lang['Guest_users_zero_total'] = '0 Guests';
$lang['Guest_users_total'] = '%d Guests';
$lang['Guest_user_total'] = '%d Guest';
$lang['Record_online_users'] = 'Most users ever online was <b>%s</b> on %s'; // first %s = number of users, second %s is the date.

$lang['Admin_online_color'] = '%sAdministrator%s';
$lang['Mod_online_color'] = '%sModerator%s';

$lang['You_last_visit'] = 'You last visited on %s'; // %s replaced by date/time
$lang['Current_time'] = 'The time now is %s'; // %s replaced by time

$lang['Search_new'] = 'View posts since last visit';
$lang['Search_your_posts'] = 'View your posts';
$lang['Search_unanswered'] = 'View unanswered posts';

$lang['Register'] = 'Register';
$lang['Profile'] = 'Profile';
$lang['Edit_profile'] = 'Edit your profile';
$lang['Search'] = 'Search';
$lang['Memberlist'] = 'Memberlist';
$lang['FAQ'] = 'FAQ';
$lang['KB_title'] = 'Knowledge Base';
$lang['BBCode_guide'] = 'BBCode Guide';
$lang['Usergroups'] = 'Usergroups';
$lang['Last_Post'] = 'Last Post';
$lang['Moderator'] = 'Moderator';
$lang['Moderators'] = 'Moderators';


//
// Stats block text
//
$lang['Posted_articles_zero_total'] = 'Our users have posted a total of <b>0</b> articles'; // Number of posts
$lang['Posted_articles_total'] = 'Our users have posted a total of <b>%d</b> articles'; // Number of posts
$lang['Posted_article_total'] = 'Our users have posted a total of <b>%d</b> article'; // Number of posts
$lang['Registered_users_zero_total'] = 'We have <b>0</b> registered users'; // # registered users
$lang['Registered_users_total'] = 'We have <b>%d</b> registered users'; // # registered users
$lang['Registered_user_total'] = 'We have <b>%d</b> registered user'; // # registered users
$lang['Newest_user'] = 'The newest registered user is <b>%s%s%s</b>'; // a href, username, /a 

$lang['No_new_posts_last_visit'] = 'No new posts since your last visit';
$lang['No_new_posts'] = 'No new posts';
$lang['New_posts'] = 'New posts';
$lang['New_post'] = 'New post';
$lang['No_new_posts_hot'] = 'No new posts [ Popular ]';
$lang['New_posts_hot'] = 'New posts [ Popular ]';
$lang['No_new_posts_locked'] = 'No new posts [ Locked ]';
$lang['New_posts_locked'] = 'New posts [ Locked ]';
$lang['Forum_is_locked'] = 'Forum is locked';
$lang['Posted'] = 'You have posted in this forum';


//
// Login
//
$lang['Enter_password'] = 'Please enter your username and password to log in.';
$lang['Login'] = 'Log in';
$lang['Logout'] = 'Log out';

$lang['Forgotten_password'] = 'I forgot my password';

$lang['Log_me_in'] = 'Automatic Login';

$lang['Error_login'] = 'You have specified an incorrect or inactive username, or an invalid password.';


//
// Index page
//
$lang['Index'] = 'Index';
$lang['No_Posts'] = 'No Posts';
$lang['No_forums'] = 'This board has no forums';

$lang['Private_Message'] = 'Private Message';
$lang['Private_Messages'] = 'Private Messages';
$lang['Who_is_Online'] = 'Who is Online';


$lang['Go_to_Top'] ='Go to top';
$lang['Go_to_Bottom'] = 'Go to bottom';

$lang['Mark_all_forums'] = 'Mark all forums read';
$lang['Forums_marked_read'] = 'All forums have been marked read';


//
// Viewforum
//
$lang['Topic_Announcement'] = '<b>[ Announcement ]</b>';
$lang['Topic_Sticky'] = '<b>[ Sticky ]</b>';
$lang['Topic_Moved'] = '<b>[ Moved ]</b>';
$lang['Topic_Poll'] = '<b>[ Poll ]</b>';

//
// Viewtopic
//

$lang['Guest'] = 'Guest';
$lang['Post_subject'] = 'Post subject';
$lang['Submit_vote'] = 'Submit Vote';
$lang['View_results'] = 'View Results';
$lang['View_Topic'] = 'View Topic';

$lang['No_newer_topics'] = 'There are no newer topics in this forum';
$lang['No_older_topics'] = 'There are no older topics in this forum';
$lang['Topic_post_not_exist'] = 'The topic or post you requested does not exist';
$lang['No_posts_topic'] = 'No posts exist for this topic';

$lang['Display_posts'] = 'Display posts from previous';
$lang['All_Posts'] = 'All Posts';
$lang['Newest_First'] = 'Newest First';
$lang['Oldest_First'] = 'Oldest First';

$lang['Back_to_top'] = 'Back to top';

$lang['Read_profile'] = 'View user\'s profile'; 
$lang['Send_email'] = 'Send e-mail to user';
$lang['Visit_website'] = 'Visit poster\'s website';
$lang['ICQ_status'] = 'ICQ Status';
$lang['Edit_delete_post'] = 'Edit/Delete this post';
$lang['View_IP'] = 'View IP address of poster';
$lang['Delete_post'] = 'Delete this post';

$lang['wrote'] = 'wrote'; // proceeds the username and is followed by the quoted text
$lang['Quote'] = 'Quote'; // comes before bbcode quote output.
$lang['Code'] = 'Code'; // comes before bbcode code output.
$lang['Priv_Img'] = 'Image display disabled'; // Explanation for missing images in the ModCP.
$lang['PHPCode'] = 'PHP'; // PHP MOD

$lang['Edited_time_total'] = 'Last edited by %s on %s; edited %d time in total'; // Last edited by me on 12 Oct 2001; edited 1 time in total
$lang['Edited_times_total'] = 'Last edited by %s on %s; edited %d times in total'; // Last edited by me on 12 Oct 2001; edited 2 times in total

//
// Posting/Replying (Not private messaging!)
//
$lang['Message_body'] = 'Message body';

$lang['Options'] = 'Options';

$lang['Post_Announcement'] = 'Announcement';
$lang['Post_Sticky'] = 'Sticky';

$lang['Flood_Error'] = 'You cannot make another post so soon after your last; please try again in a short while.';
$lang['Empty_subject'] = 'You must specify a subject when posting a new topic.';
$lang['Empty_message'] = 'You must enter a message when posting.';
$lang['Forum_locked'] = 'This forum is locked: you cannot post, reply to, or edit topics.';
$lang['Topic_locked'] = 'This topic is locked: you cannot edit posts or make replies.';
$lang['Button_locked'] = 'Locked';
$lang['No_post_id'] = 'You must select a post to edit';
$lang['Edit_own_posts'] = 'Sorry, but you can only edit your own posts.';
$lang['Empty_poll_title'] = 'You must enter a title for your poll.';
$lang['To_few_poll_options'] = 'You must enter at least two poll options.';
$lang['To_many_poll_options'] = 'You have tried to enter too many poll options.';

$lang['Update'] = 'Update';
$lang['Delete'] = 'Delete';
$lang['Days'] = 'Days'; // This is used for the Run poll for ... Days + in admin_forums for pruning

$lang['HTML_is_ON'] = 'HTML is <u>ON</u>';
$lang['HTML_is_OFF'] = 'HTML is <u>OFF</u>';
$lang['BBCode_is_ON'] = '%sBBCode%s is <u>ON</u>'; // %s are replaced with URI pointing to FAQ
$lang['BBCode_is_OFF'] = '%sBBCode%s is <u>OFF</u>';
$lang['Smilies_are_ON'] = 'Smilies are <u>ON</u>';
$lang['Smilies_are_OFF'] = 'Smilies are <u>OFF</u>';

$lang['Attach_signature'] = 'Attach signature (signatures can be changed in profile)';
$lang['Delete_post'] = 'Delete this post';

$lang['Stored'] = 'Your message has been entered successfully.';
$lang['Deleted'] = 'Your message has been deleted successfully.';
$lang['Poll_delete'] = 'Your poll has been deleted successfully.';
$lang['Vote_cast'] = 'Your vote has been cast.';

$lang['Topic_reply_notification'] = 'Topic Reply Notification';

$lang['bbcode_b_help'] = 'Bold text: [b]text[/b]  (alt+b)';
$lang['bbcode_i_help'] = 'Italic text: [i]text[/i]  (alt+i)';
$lang['bbcode_u_help'] = 'Underline text: [u]text[/u]  (alt+u)';
$lang['bbcode_q_help'] = 'Quote text: [quote]text[/quote]  (alt+q)';
$lang['bbcode_c_help'] = 'Code display: [code]code[/code]  (alt+c)';
$lang['bbcode_l_help'] = 'List: [list]text[/list] (alt+l)';
$lang['bbcode_o_help'] = 'Ordered list: [list=]text[/list]  (alt+o)';
$lang['bbcode_p_help'] = 'Insert image: [img]http://image_url[/img]  (alt+p)';
$lang['bbcode_w_help'] = 'Insert URL: [url]http://url[/url] or [url=http://url]URL text[/url]  (alt+w)';
$lang['bbcode_a_help'] = 'Close all open bbCode tags';
$lang['bbcode_s_help'] = 'Font color: [color=red]text[/color]  Tip: you can also use color=#FF0000';
$lang['bbcode_f_help'] = 'Font size: [size=x-small]small text[/size]';

$lang['Emoticons'] = 'Emoticons';
$lang['More_emoticons'] = 'View more Emoticons';

$lang['Font_color'] = 'Font colour';
$lang['color_default'] = 'Default';
$lang['color_dark_red'] = 'Dark Red';
$lang['color_red'] = 'Red';
$lang['color_orange'] = 'Orange';
$lang['color_brown'] = 'Brown';
$lang['color_yellow'] = 'Yellow';
$lang['color_green'] = 'Green';
$lang['color_olive'] = 'Olive';
$lang['color_cyan'] = 'Cyan';
$lang['color_blue'] = 'Blue';
$lang['color_dark_blue'] = 'Dark Blue';
$lang['color_indigo'] = 'Indigo';
$lang['color_violet'] = 'Violet';
$lang['color_white'] = 'White';
$lang['color_black'] = 'Black';

$lang['Font_size'] = 'Font size';
$lang['font_tiny'] = 'Tiny';
$lang['font_small'] = 'Small';
$lang['font_normal'] = 'Normal';
$lang['font_large'] = 'Large';
$lang['font_huge'] = 'Huge';

$lang['Close_Tags'] = 'Close Tags';
$lang['Styles_tip'] = 'Tip: Styles can be applied quickly to selected text.';

//
// Private Messaging
//
$lang['Private_Messaging'] = 'Private Messaging';

$lang['Login_check_pm'] = 'Check your PM';
$lang['New_pms'] = '<b>%d new messages</b>'; // You have 2 new messages
$lang['New_pm'] = '<b>%d new message</b>'; // You have 1 new message
$lang['No_new_pm'] = 'No new message(s)';
$lang['Unread_pms'] = '%d unread messages';
$lang['Unread_pm'] = '%d unread message';
$lang['No_unread_pm'] = 'No unread messages';
$lang['You_new_pm'] = 'A new private message is waiting for you in your Inbox';
$lang['You_new_pms'] = 'New private messages are waiting for you in your Inbox';
$lang['You_no_new_pm'] = 'No new private messages are waiting for you';

$lang['Unread_message'] = 'Unread message';
$lang['Read_message'] = 'Read message';

$lang['Read_pm'] = 'Read message';
$lang['Post_new_pm'] = 'Post message';
$lang['Post_reply_pm'] = 'Reply to message';
$lang['Post_quote_pm'] = 'Quote message';
$lang['Edit_pm'] = 'Edit message';

$lang['Inbox'] = 'Inbox';
$lang['Outbox'] = 'Outbox';
$lang['Savebox'] = 'Savebox';
$lang['Sentbox'] = 'Sentbox';
$lang['Flag'] = 'Flag';
$lang['Subject'] = 'Subject';
$lang['From'] = 'From';
$lang['To'] = 'To';
$lang['Date'] = 'Date';
$lang['Mark'] = 'Mark';
$lang['Sent'] = 'Sent';
$lang['Saved'] = 'Saved';
$lang['Delete_marked'] = 'Delete Marked';
$lang['Delete_all'] = 'Delete All';
$lang['Save_marked'] = 'Save Marked'; 
$lang['Save_message'] = 'Save Message';
$lang['Delete_message'] = 'Delete Message';

$lang['Display_messages'] = 'Display messages from previous'; // Followed by number of days/weeks/months
$lang['All_Messages'] = 'All Messages';

$lang['No_messages_folder'] = 'You have no messages in this folder';

$lang['PM_disabled'] = 'Private messaging has been disabled on this board.';
$lang['Cannot_send_privmsg'] = 'Sorry, but the administrator has prevented you from sending private messages.';
$lang['No_to_user'] = 'You must specify a username to whom to send this message.';
$lang['No_such_user'] = 'Sorry, but no such user exists.';

$lang['Disable_HTML_pm'] = 'Disable HTML in this message';
$lang['Disable_BBCode_pm'] = 'Disable BBCode in this message';
$lang['Disable_Smilies_pm'] = 'Disable Smilies in this message';

$lang['Message_sent'] = 'Your message has been sent.';

$lang['Click_return_inbox'] = 'Click %sHere%s to return to your Inbox';
$lang['Click_return_index'] = 'Click %sHere%s to return to the Index';

$lang['Send_a_new_message'] = 'Send a new private message';
$lang['Send_a_reply'] = 'Reply to a private message';
$lang['Edit_message'] = 'Edit private message';

$lang['Notification_subject'] = 'New Private Message has arrived!';

$lang['Find_username'] = 'Find a username';
$lang['Find'] = 'Find';
$lang['No_match'] = 'No matches found.';

$lang['No_post_id'] = 'No post ID was specified';
$lang['No_such_folder'] = 'No such folder exists';
$lang['No_folder'] = 'No folder specified';

$lang['Mark_all'] = 'Mark all';
$lang['Unmark_all'] = 'Unmark all';

$lang['Confirm_delete_pm'] = 'Are you sure you want to delete this message?';
$lang['Confirm_delete_pms'] = 'Are you sure you want to delete these messages?';

$lang['Inbox_size'] = 'Your Inbox is %d%% full'; // eg. Your Inbox is 50% full
$lang['Sentbox_size'] = 'Your Sentbox is %d%% full'; 
$lang['Savebox_size'] = 'Your Savebox is %d%% full'; 

$lang['Click_view_privmsg'] = 'Click %sHere%s to visit your Inbox';


//
// Profiles/Registration
//
$lang['Viewing_user_profile'] = 'Viewing profile :: %s'; // %s is username 
$lang['About_user'] = 'All about %s'; // %s is username

$lang['Preferences'] = 'Preferences';
$lang['Items_required'] = 'Items marked with a * are required unless stated otherwise.';
$lang['Registration_info'] = 'Registration Information';
$lang['Profile_info'] = 'Profile Information';
$lang['Profile_info_warn'] = 'This information will be publicly viewable';
$lang['Avatar_panel'] = 'Avatar control panel';
$lang['Avatar_gallery'] = 'Avatar gallery';

$lang['Website'] = 'Website';
$lang['Location'] = 'Location';
$lang['Contact'] = 'Contact';
$lang['Email_address'] = 'E-mail address';
$lang['Email'] = 'E-mail';
$lang['Send_private_message'] = 'Send private message';
$lang['Hidden_email'] = '[ Hidden ]';
//$lang['Search_user_posts'] = 'Search for posts by this user';
$lang['Interests'] = 'Interests';
$lang['Occupation'] = 'Occupation'; 
$lang['Poster_rank'] = 'Poster rank';

$lang['Total_posts'] = 'Total posts';
$lang['User_post_pct_stats'] = '%.2f%% of total'; // 1.25% of total
$lang['User_post_day_stats'] = '%.2f posts per day'; // 1.5 posts per day
$lang['Search_user_posts'] = 'Find all posts by %s'; // Find all posts by username

$lang['No_user_id_specified'] = 'Sorry, but that user does not exist.';
$lang['Wrong_Profile'] = 'You cannot modify a profile that is not your own.';

$lang['Only_one_avatar'] = 'Only one type of avatar can be specified';
$lang['File_no_data'] = 'The file at the URL you gave contains no data';
$lang['No_connection_URL'] = 'A connection could not be made to the URL you gave';
$lang['Incomplete_URL'] = 'The URL you entered is incomplete';
$lang['Wrong_remote_avatar_format'] = 'The URL of the remote avatar is not valid';
$lang['No_send_account_inactive'] = 'Sorry, but your password cannot be retrieved because your account is currently inactive. Please contact the forum administrator for more information.';

$lang['Always_smile'] = 'Always enable Smilies';
$lang['Always_spellcheck'] = 'Alway\'s check the Spelling before posting';
$lang['Always_html'] = 'Always allow HTML';
$lang['Always_bbcode'] = 'Always allow BBCode';
$lang['Always_add_sig'] = 'Always attach my signature';
$lang['Always_notify'] = 'Always notify me of replies';
$lang['Always_notify_explain'] = 'Sends an e-mail when someone replies to a topic you have posted in. This can be changed whenever you post.';

$lang['Board_style'] = 'Board Style';
$lang['Board_lang'] = 'Board Language';
$lang['No_themes'] = 'No Themes In database';
$lang['Timezone'] = 'Timezone';
$lang['Date_format'] = 'Date format';
$lang['Date_format_explain'] = 'The syntax used is identical to the PHP <a href=\'http://www.php.net/date\' target=\'_other\'>date()</a> function.';
$lang['Signature'] = 'Signature';
$lang['Signature_explain'] = 'This is a block of text that can be added to posts you make. There is a %d character limit';
$lang['Public_view_email'] = 'Always show my e-mail address';
//
$lang['Current_password'] = 'Current password';
$lang['New_password'] = 'New password';
$lang['Confirm_password'] = 'Confirm password';
$lang['Confirm_password_explain'] = 'You must confirm your current password if you wish to change it or alter your e-mail address';

if($userdata['session_logged_in']){ 
    $lang['password_if_changed'] = 'You only need to supply a password if you want to change it'; 
    $lang['password_confirm_if_changed'] = 'You only need to confirm your password if you changed it above.'; 
} else { 
    $lang['password_if_changed'] = 'Remember it is CaSe SeNsItIvE.'; 
    $lang['password_confirm_if_changed'] = ''; 
} 


$lang['PS_security_title']			= 'Security control panel';
$lang['PS_security_question'] 		= 'Security Question';
$lang['PS_security_question_exp'] 	= 'This will be asked if your account becomes locked caused by to many failed login attempts.';
$lang['PS_security_answer']			= 'Security Answer';
$lang['PS_security_answer_exp']		= 'This is the answer to the above question. When you use it to unlock your account, you will HAVE to use this and it is CaSe SeNsItIvE.';
$lang['PS_security_error']			= 'Error';
$lang['PS_security_info']			= 'Information';
$lang['PS_security_one']			= 'The Security Question & Answer Are Required Fields.';
$lang['PS_security_a_exp']			= '<br>The above is a \'hash\' of your Security Answer. This is how it is saved in the database so no one can steal it or see it. You need to write down the real (un-hashed) answer so you dont lose it.';
$lang['PS_security_locked']			= 'Sorry, this account has exceeded its log in attempts. It is now locked. If you are the rightfull user, please click below to be redirected to a page to unlock your id.<br><br>Click <a href="login_security.'. $phpEx .'?phpBBSecurity=retreive&sid='. $userdata['session_id'] .'">Here</a> to unlock your account.';
$lang['PS_security_force']			= 'Sorry, it appears this is your first visit since we added the security questions to accounts. You will only be able to view your profile until you update it and add a question and answer. Thanks!<br><br>Click <b><a href="profile.'. $phpEx .'?mode=register&sub=registering&sid='. $userdata['session_id'] .'">here</a></b> to goto your profile.';
$lang['PS_admin_one']				= 'Login Attempts';
$lang['PS_admin_one_exp']			= '<br>This is the amount of times someone can get the password incorrect before locking the account.';
$lang['PS_admin_two']				= 'Notify Admin';
$lang['PS_admin_two_exp']			= '<br>If this is set to \'Enabled\', specify what methods the admin is to be notified by below it.';
$lang['PS_admin_three']				= 'Admin';
$lang['PS_admin_three_exp']			= '<br>This is the admin you want to be notified if set to \'Enabled\' above.';
$lang['PS_admin_err_one']			= 'The login limit needs to be greater than 0. Please click Back and try again.';
$lang['PS_admin_err_two']			= 'You choose to notify an admin, so please choose to select an admin id. Please click Back and try again.';
$lang['PS_admin_error_three']		= 'The admin id needs to be a numeric value. Please click Back and try again.';
$lang['PS_admin_error_four']		= 'The admin id needs to be a value greater than 0. Please click Back and try again.';
$lang['PS_admin_error_five']		= 'The login limit needs to be a numeric value. Please click Back and try again.';
$lang['PS_admin_current']			= 'Current Admin: %A%';
$lang['PS_admin_default']			= 'Choose One';
$lang['PS_login_title']				= 'phpBB Security';
$lang['PS_login_header']			= 'phpBB Security';
$lang['PS_login_username']			= 'Please enter your username';
$lang['PS_login_email']				= 'Please enter the email associated with this account';
$lang['PS_login_step_one']			= 'Step One: Account Info Validation';
$lang['PS_login_step_two']			= 'Step Two: Security Question Validation';
$lang['PS_login_step_failed']		= 'Sorry, the information you provided is incorrect.';
$lang['PS_login_button']			= 'Validate';
$lang['PS_login_validated']			= 'Thank you for unlocking your account. You may now login.';
$lang['PS_profile_explain']			= 'It is important you think before filling this in. You will not be able to change these at will. You will need an admins approval to change them, for security purposes. Once they are set, all you will be able to do is view them.';
$lang['PS_forgot_sq']				= '<a href="login_security.'. $phpEx .'?phpBBSecurity=forgot&sid='. $userdata['session_id'] .'">Forgot Your Security Question?</a>';
$lang['PS_forgot_exp']				= 'If you have forgoten your security answer, you will need to contact an admin and have them reset your security information. The email to contact is '. $board_config['board_email'] .'. If you can not reach an admin that way, please look at admin profiles for email links. When you update it, please use information you can remember to avoid having to do this again.';
$lang['PS_user_lock']				= 'Locked Status';
$lang['PS_user_lock_exp']			= 'If the account is locked, anytime the user tries to log in, they will be forced to input their security information.';
$lang['PS_user_reset']				= 'Reset Security Information';
$lang['PS_user_reset_exp']			= 'Warning: If you check this, the user will be forced to input new information. It will delete their current security settings.';
$lang['PS_user_status_l']			= 'This account is currently locked. Checking this box will <b>un-lock</b> it.';
$lang['PS_user_status_u']			= 'This account is currently un-locked. Checking this box will <b>lock</b> it.';
$lang['PS_pm_subject']				= 'An account has been locked.';
$lang['PS_pm_message']				= 
'An account was just locked. Below are the details.

Account Locked: %U%
IP For Who Locked It: %I%

This is an automated response, do not reply. If you have an IP tracker installed, check the above IP against the ones you have stored in the database.';
$lang['PS_auto_message']			= 'It appears you have been banned from this website.  If this is a mistake or you are not sure why you are banned, please contact the board administrator.<br /><br /><b>Board Administrator:</b> ';
$lang['PS_admin_ban']				= 'Auto Ban';
$lang['PS_admin_ban_exp']			= '<br>This will automatically ban any IP that tries to use a trick. This option overrides all the individual options. If you want to use the individual options, set this to \'Disabled\' and setup your individual settings.';
$lang['PS_admin_sessions']			= 'Max Allowed Sessions';
$lang['PS_admin_sessions_exp']		= '<br>If your sessions table gets bigger than this number, the mod will automatically get it below this number.';
$lang['PS_clike']					= 'Clike Attempt';
$lang['PS_union']					= 'Union Attempt';
$lang['PS_sql']						= 'SQL Injection Attempt';
$lang['PS_ddos']					= 'DDoS Attempt';
$lang['PS_caught_left']				= 'IP';
$lang['PS_caught_c_left']			= 'Caught For';
$lang['PS_caught_c_right']			= 'Caught On';
$lang['PS_caught_right']			= 'Attempts';
$lang['PS_caught_msg']				= 'There have been no attempts by script kiddies on our site.';
$lang['PS_special']					= 'phpBB Security :: Special Fields';
$lang['PS_special_admins']			= 'Amount of allowed admins';
$lang['PS_special_admins_exp']		= '<br>This number will set how many admins are allowed to be on your site. So no one can inject an admin account to gain access.';
$lang['PS_special_admins_total']	= '<br>You currently have %X% real users set to \'Admin\' status in the users table.';
$lang['PS_special_admins_offset']	= '<font color="red"> It appears you have more admins in the users table than allowed!</font>';
$lang['PS_special_mods']			= 'Amount of allowed mods';
$lang['PS_special_mods_exp']		= '<br>This number will set how many moderators are allowed to be on your site. So no one can inject a moderator account to gain access.';
$lang['PS_special_mods_total']		= '<br>You currently have %X% real users set to \'Moderator\' status in the users table.';
$lang['PS_special_mods_offset']		= '<font color="red"> It appears you have more mods in the users table than allowed!</font>';
$lang['PS_use_special']				= 'Protect admin & moderator accounts';
$lang['PS_use_special_exp']			= '<br>Disabling this, will not stop any extra admins or mods added.';
$lang['PS_fopen_fwrite']			= 'File Writing Attempt';
$lang['PS_system']					= 'Perl Execution Attempt';
$lang['PS_chr']						= 'Encoded Characters Attempt';
$lang['PS_cback']					= 'Sanity Mix Worm Attempt';
$lang['PS_allow_user_change']		= 'Allow users to change their SQ info. <b>Not recommended.</b>';
$lang['PS_notify_admin_by_pm']		= 'Private Message';
$lang['PS_notify_admin_by_em']		= 'Email';
$lang['PS_option_ban']				= 'Ban';
$lang['PS_option_block']			= 'Block';
$lang['PS_option_ignore']			= 'Ignore';
$lang['PS_option_warning']			= '<b>Warning:</b> Setting any of the below to \'Ignore\' will allow anyone to use these tricks on your site. You have been warned.';
$lang['PS_list_choice_one']			= 'Yes';
$lang['PS_list_choice_two']			= 'No';
$lang['PS_list_one']				= 'Action to take in a <b>DDoS</b> attempt?';
$lang['PS_list_two']				= 'Action to take in a <b>Clike</b> attempt?';
$lang['PS_list_three']				= 'Action to take in a <b>UNION</b> attempt?';
$lang['PS_list_four']				= 'Action to take in a <b>Sanity Mix Worm</b> attempt?';
$lang['PS_list_five']				= 'Action to take in an <b>SQL Injection</b> attempt?';
$lang['PS_list_six']				= 'Action to take in a <b>Perl Script</b> attempt?';
$lang['PS_list_seven']				= 'Action to take in an <b>Encoded Characters</b> attempt?';
$lang['PS_list_eight']				= 'Action to take in a <b>File Write/Open</b> attempt?';
$lang['PS_blocked_line']			= '<b>&nbsp;phpBB Security &copy;&nbsp;</b> Has Blocked %T% Exploit Attempts.';
$lang['PS_blocked_line2']			= '<a href="login_security.php?phpBBSecurity=caught" class="copyright">Protected</a> by phpBB Security &copy; <a href="http://phpbb-tweaks.com" class="copyright" target="_blank">phpBB-Tweaks</a>';

#==== Added in 1.0.2
$lang['PS_die_msg_cookies']			= 'There is a cookie mis-match with your account. Please clear your cookies & log back in.';
$lang['PS_die_msg_banned']			= 'You have been banned from this site.';
$lang['PS_die_msg_ddos']			= 'You have been blocked because we think you are a DDoS attempt. If you are running a firewall or similar that can also cause this.';
$lang['PS_die_msg_encoded']			= 'You have been blocked because you have tried to pass encoded characters to this site &amp; that is a potential malicious attempt to gain un-authorized access.';
$lang['PS_die_msg_union']			= 'You have been blocked because you have tried to pass a union type script to this site &amp; that is a potential malicious attempt to gain un-authorized access.';
$lang['PS_die_msg_clike']			= 'You have been blocked because you have tried to a clike type script to this site &amp; that is a potential malicious attempt to gain un-authorized access.';
$lang['PS_die_msg_sql']				= 'You have been blocked because you have tried to an sql injection to this site &amp; that is a potential malicious attempt to gain un-authorized access.';
$lang['PS_die_msg_fwrite']			= 'You have been blocked because you have tried to pass a file write type script to this site &amp; that is a potential malicious attempt to gain un-authorized access.';
$lang['PS_die_msg_perl']			= 'You have been blocked because you have tried to pass a perl execution type script to this site &amp; that is a potential malicious attempt to gain un-authorized access.';
$lang['PS_die_msg_cback']			= 'You have been blocked because you have tried to pass a sanity mix worm type script to this site &amp; that is a potential malicious attempt to gain un-authorized access.';
$lang['PS_die_msg_agent']			= 'You have been blocked because your user agent matches one we have blocked.';
$lang['PS_die_msg_referer']			= 'You have been blocked because your referer matches one we have blocked.';
$lang['PS_die_msg_staff']			= 'You have been blocked because you have permission to be staff, but the admins did not grant you permission in the security panel.';

$lang['PS_die_msg_email']			= 'If you feel you have reached this message in an error due to the site, please contact the admin at %email%.';

$lang['PS_admin_submit']			= 'Save Configuration';
$lang['PS_admin_submit_special']	= 'Save Special Configuration';
$lang['PS_admin_config_saved']		= 'Configuration Updated.';
$lang['PS_admin_special_saved']		= 'Special Settings Updated.';
$lang['PS_return_config']			= 'Click %s<b>here</b>%s to return to the configuration page.';
$lang['PS_return_special']			= 'Click %s<b>here</b>%s to return to the special settings page.';
$lang['PS_admin_not_authed']		= 'Sorry, you\'re not authorized to view/change these settings.';
$lang['PS_admin_grant_access']		= 'Here you can select admins to grant them access to view this page.';
$lang['PS_admin_deny_access']		= 'Here you can select admins to deny them access to view this page.';
$lang['PS_block_agents']			= 'Block User Agents';
$lang['PS_block_agents_exp']		= 'You should know what you\'re doing before using this. An example of what you can do is add <b>Firefox</b> here, and anyone using a Firefox browser will be blocked.';
$lang['PS_unblock_agents']			= 'Un-Block User Agents';
$lang['PS_block_referers']			= 'Block Referers';
$lang['PS_block_referers_exp']		= 'You should know what you\'re doing before using this. An example of what you can do is add <b>search.yahoo.com</b> here, and anyone using that site to get to here will be blocked.';
$lang['PS_unblock_referers']		= 'Un-Block Referers';
$lang['PS_per_page']				= 'How many exploits per page to display on the caught page';
$lang['PS_ddos_level']				= 'DDoS Protection Level:';
$lang['PS_ddos_high']				= 'Strong';
$lang['PS_ddos_medium']				= 'Medium';
$lang['PS_ddos_low']				= 'Low';

$lang['PS_members_title']			= 'Below Will Dump A List Of Any Member Who Was Caught Trying To Exploit This Site.';
$lang['PS_members_pt_check']		= 'Checked [b]Site Posts[/b] Table, Result:';
$lang['PS_members_pt_check_yc']		= 'Posts Table Has Found Something:';
$lang['PS_members_pt_check_nc']		= 'The Posts Table Found No IP Matches.';
$lang['PS_user_exploits']			= 'Their Exploit Attempts';

$lang['PS_users_tries']				= '%N%\'s Exploit Attempts';
$lang['PS_users_id']				= 'Id';
$lang['PS_users_ip']				= 'Ip';
$lang['PS_users_link']				= 'Link';
$lang['PS_users_reason']			= 'Reason';
$lang['PS_users_date']				= 'Date';

$lang['PS_search_title']			= 'Search The Database';
$lang['PS_search_ip']				= 'Please enter an IP';
$lang['PS_search_submit']			= ' Begin Search ';
$lang['PS_search_partial']			= 'Partial Match';
$lang['PS_search_exact']			= 'Exact Match';
$lang['PS_search_unban']			= 'Unban This IP';
$lang['PS_search_banned']			= 'Currently Banned';

$lang['PS_backup_on']				= 'Daily Database Backup';
$lang['PS_backup_folder']			= 'Folder To Put Backups In';
$lang['PS_backup_folder_exp']		= 'This folder <b>MUST</b> be in your forum root directory, it <b>MUST</b> be <i>CHMOD</i> -> 777';
$lang['PS_backup_filename']			= 'Name To Use For DB Backups';
$lang['PS_backup_filename_exp']		= '<i>Example:</i> backup';
$lang['PS_backup_time']				= 'Time Every Day To Complete Backup';
$lang['PS_backup_total']			= 'Clean Avaliable Backups: %N%';
$lang['PS_backup_remove']			= 'Delete Backup File';

#==== Added in 1.0.3
$lang['PS_modcp_verify']			= 'Please verify your password.';
$lang['PS_modcp_verify_fail']		= 'Your Password Was Incorrect, Please Press Back &amp; Try Again.';
$lang['PS_guest_max']				= 'Max allowed sessions per guest IP.';
$lang['PS_guest_max_exp']			= 'This is helpful for people who DDoS sites &amp; get through. With alot of programs, all the guests will have the same IP. This will eliminate that problem.';
$lang['PS_pass_match']				= 'Password Match';
$lang['PS_pass_match_exp']			= 'If this is set to enabled, users passwords will not be allowed to be the same as their usernames when they make accounts.';
$lang['PS_pass_min_length']			= 'Minimum Pass Length';
$lang['PS_pass_min_length_exp']		= 'If this is set to enabled, then users will have to make passwords longer than what you set it to below.';
$lang['PS_pass_length']				= 'Minimum Characters Allowed';
$lang['PS_pass_force']				= 'It appears this is your first visit since the admins have forced all users to change their passwords. So please click %shere%s and update your password. Thanks.';
$lang['PS_pass_force_error']		= 'You <b>have</b> to update your password. Please press back &amp; try again.';
$lang['PS_pass_length_error']		= 'Sorry, there is a %s minimum character requirement for passwords.';
$lang['PS_pass_match_error']		= 'Sorry, your password can not be the same as your username.';
$lang['PS_pass_error']				= 'You cant force a minimum password length and not have a minimum length set.';


$lang['Avatar'] = 'Avatar';
$lang['Avatar_explain'] = 'Displays a small graphic image below your details in posts. Only one image can be displayed at a time, its width can be no greater than %d pixels, the height no greater than %d pixels, and the file size no more than %d KB.';
$lang['Upload_Avatar_file'] = 'Upload Avatar from your machine';
$lang['Upload_Avatar_URL'] = 'Upload Avatar from a URL';
$lang['Upload_Avatar_URL_explain'] = 'Enter the URL of the location containing the Avatar image, it will be copied to this site.';
$lang['Pick_local_Avatar'] = 'Select Avatar from the gallery';
$lang['Link_remote_Avatar'] = 'Link to off-site Avatar';
$lang['Link_remote_Avatar_explain'] = 'Enter the URL of the location containing the Avatar image you wish to link to.';
$lang['Avatar_URL'] = 'URL of Avatar Image';
$lang['Select_from_gallery'] = 'Select Avatar from gallery';
$lang['View_avatar_gallery'] = 'Show gallery';

$lang['Select_avatar'] = 'Select avatar';
$lang['Return_profile'] = 'Cancel avatar';
$lang['Select_category'] = 'Select category';

$lang['Delete_Image'] = 'Delete Image';
$lang['Current_Image'] = 'Current Image';

$lang['Notify_on_privmsg'] = 'Notify on new Private Message';
$lang['Popup_on_privmsg'] = 'Pop up window on new Private Message'; 
$lang['Popup_on_privmsg_explain'] = 'Some templates may open a new window to inform you when new private messages arrive.';
$lang['Hide_user'] = 'Hide your online status';

$lang['Profile_updated'] = 'Your profile has been updated';

$lang['Password_mismatch'] = 'The passwords you entered did not match.';
$lang['Current_password_mismatch'] = 'The current password you supplied does not match that stored in the database.';
$lang['Password_long'] = 'Your password must be no more than 32 characters.';
$lang['Username_taken'] = 'Sorry, but this username has already been taken.';
$lang['Username_invalid'] = 'Sorry, but this username contains an invalid character such as \'.';
$lang['Username_disallowed'] = 'Sorry, but this username has been disallowed.';
$lang['Username_numeric'] = 'Sorry, but the username cannot be a number.';
$lang['Email_taken'] = 'Sorry, but that e-mail address is already registered to a user.';
$lang['Email_banned'] = 'Sorry, but this e-mail address has been banned.';
$lang['Email_invalid'] = 'Sorry, but this e-mail address is invalid.';
$lang['Signature_too_long'] = 'Your signature is too long.';
$lang['Fields_empty'] = 'You must fill in the required fields.';
$lang['Avatar_filetype'] = 'The avatar filetype must be .jpg, .gif or .png';
$lang['Avatar_filesize'] = 'The avatar image file size must be less than %d KB'; // The avatar image file size must be less than 6 KB
$lang['Avatar_imagesize'] = 'The avatar must be less than %d pixels wide and %d pixels high'; 

$lang['Welcome_subject'] = 'Welcome to %s Forums'; // Welcome to my.com forums
$lang['New_account_subject'] = 'New user account';
$lang['Account_activated_subject'] = 'Account Activated';

$lang['Account_added'] = 'Thank you for registering. Your account has been created. You may now log in with your username and password';
$lang['Account_inactive'] = 'Your account has been created. However, this forum requires account activation. An activation key has been sent to the e-mail address you provided. Please check your e-mail for further information';
$lang['Account_inactive_admin'] = 'Your account has been created. However, this forum requires account activation by the administrator. An e-mail has been sent to them and you will be informed when your account has been activated';
$lang['Account_active'] = 'Your account has now been activated. Thank you for registering';
$lang['Account_active_admin'] = 'The account has now been activated';
$lang['Reactivate'] = 'Reactivate your account!';
$lang['Already_activated'] = 'You have already activated your account';
$lang['COPPA'] = 'Your account has been created but has to be approved. Please check your e-mail for details.';

$lang['Wrong_activation'] = 'The activation key you supplied does not match any in the database.';
$lang['Send_password'] = 'Send me a new password'; 
$lang['Password_updated'] = 'A new password has been created; please check your e-mail for details on how to activate it.';
$lang['No_email_match'] = 'The e-mail address you supplied does not match the one listed for that username.';
$lang['New_password_activation'] = 'New password activation';
$lang['Password_activated'] = 'Your account has been re-activated. To log in, please use the password supplied in the e-mail you received.';

$lang['Send_email_msg'] = 'Send an e-mail message';
$lang['No_user_specified'] = 'No user was specified';
$lang['User_prevent_email'] = 'This user does not wish to receive e-mail. Try sending them a private message.';
$lang['User_not_exist'] = 'That user does not exist';
$lang['CC_email'] = 'Send a copy of this e-mail to yourself';
$lang['Email_message_desc'] = 'This message will be sent as plain text, so do not include any HTML or BBCode. The return address for this message will be set to your e-mail address.';
$lang['Flood_email_limit'] = 'You cannot send another e-mail at this time. Try again later.';
$lang['Recipient'] = 'Recipient';
$lang['Email_sent'] = 'The e-mail has been sent.';
$lang['Send_email'] = 'Send e-mail';
$lang['Empty_subject_email'] = 'You must specify a subject for the e-mail.';
$lang['Empty_message_email'] = 'You must enter a message to be e-mailed.';


//
// Visual confirmation system strings
//
$lang['Confirm_code_wrong'] = 'The confirmation code you entered was incorrect';
$lang['Too_many_registers'] = 'You have exceeded the number of registration attempts for this session. Please try again later.';
$lang['Confirm_code_impaired'] = 'If you are visually impaired or cannot otherwise read this code please contact the %sAdministrator%s for help.';
$lang['Confirm_code'] = 'Confirmation code';
$lang['Confirm_code_explain'] = 'Enter the code exactly as you see it. The code is case sensitive and zero has a diagonal line through it.';


//
// Memberslist
//
$lang['Select_sort_method'] = 'Select sort method';
$lang['Sort'] = 'Sort';
$lang['Sort_Top_Ten'] = 'Top Ten Posters';
$lang['Sort_Joined'] = 'Joined Date';
$lang['Sort_Username'] = 'Username';
$lang['Sort_Location'] = 'Location';
$lang['Sort_Posts'] = 'Total posts';
$lang['Sort_Email'] = 'Email';
$lang['Sort_Website'] = 'Website';
$lang['Sort_Ascending'] = 'Ascending';
$lang['Sort_Descending'] = 'Descending';
$lang['Order'] = 'Order';


//
// Group control panel
//
$lang['Remove_selected'] = 'Remove Selected';
$lang['Add_member'] = 'Add Member';
$lang['None'] = 'None';

//
// Search
//
$lang['Sort_by'] = 'Sort by';
//
$lang['No_search_match'] = 'No topics or posts met your search criteria';
$lang['Close_window'] = 'Close Window';

//
// Auth related entries
//
// Note the %s will be replaced with one of the following 'user' arrays
$lang['Sorry_auth_announce'] = 'Sorry, but only %s can post announcements in this forum.';
$lang['Sorry_auth_sticky'] = 'Sorry, but only %s can post sticky messages in this forum.'; 
$lang['Sorry_auth_read'] = 'Sorry, but only %s can read topics in this forum.'; 
$lang['Sorry_auth_post'] = 'Sorry, but only %s can post topics in this forum.'; 
$lang['Sorry_auth_reply'] = 'Sorry, but only %s can reply to posts in this forum.';
$lang['Sorry_auth_edit'] = 'Sorry, but only %s can edit posts in this forum.'; 
$lang['Sorry_auth_delete'] = 'Sorry, but only %s can delete posts in this forum.';
$lang['Sorry_auth_vote'] = 'Sorry, but only %s can vote in polls in this forum.';

// These replace the %s in the above strings
$lang['Auth_Anonymous_Users'] = '<b>anonymous users</b>';
$lang['Auth_Registered_Users'] = '<b>registered users</b>';
$lang['Auth_Users_granted_access'] = '<b>users granted special access</b>';
$lang['Auth_Moderators'] = '<b>moderators</b>';
$lang['Auth_Administrators'] = '<b>administrators</b>';

$lang['Not_Moderator'] = 'You are not a moderator of this forum.';
$lang['Not_Authorised'] = 'Not Authorised';
$lang['Admin_reauthenticate'] = 'To administer the board you must re-authenticate yourself.';

$lang['You_been_banned'] = 'You have been banned from this forum.<br />Please contact the webmaster or board administrator for more information.';


//
// Viewonline
//
$lang['Online_explain'] = 'This data is based on users active over the past five minutes';

$lang['Forum_Location'] = 'Forum Location';
$lang['Last_updated'] = 'Last Updated';

$lang['Forum_index'] = 'Forum index';
$lang['Logging_on'] = 'Logging on';
$lang['Viewing_profile'] = 'Viewing profile';

//
// Moderator Control Panel
//

$lang['Select'] = 'Select';
$lang['Move'] = 'Move';
$lang['Lock'] = 'Lock';
$lang['Unlock'] = 'Unlock';

$lang['Topics_Moved'] = 'The selected topics have been moved.';

//
// Timezones ... for display on each page
//
$lang['All_times'] = 'All times are %s'; // eg. All times are GMT - 12 Hours (times from next block)

$lang['-12'] = 'GMT - 12 Hours';
$lang['-11'] = 'GMT - 11 Hours';
$lang['-10'] = 'GMT - 10 Hours';
$lang['-9'] = 'GMT - 9 Hours';
$lang['-8'] = 'GMT - 8 Hours';
$lang['-7'] = 'GMT - 7 Hours';
$lang['-6'] = 'GMT - 6 Hours';
$lang['-5'] = 'GMT - 5 Hours';
$lang['-4'] = 'GMT - 4 Hours';
$lang['-3.5'] = 'GMT - 3.5 Hours';
$lang['-3'] = 'GMT - 3 Hours';
$lang['-2'] = 'GMT - 2 Hours';
$lang['-1'] = 'GMT - 1 Hours';
$lang['0'] = 'GMT';
$lang['1'] = 'GMT + 1 Hour';
$lang['2'] = 'GMT + 2 Hours';
$lang['3'] = 'GMT + 3 Hours';
$lang['3.5'] = 'GMT + 3.5 Hours';
$lang['4'] = 'GMT + 4 Hours';
$lang['4.5'] = 'GMT + 4.5 Hours';
$lang['5'] = 'GMT + 5 Hours';
$lang['5.5'] = 'GMT + 5.5 Hours';
$lang['6'] = 'GMT + 6 Hours';
$lang['6.5'] = 'GMT + 6.5 Hours';
$lang['7'] = 'GMT + 7 Hours';
$lang['8'] = 'GMT + 8 Hours';
$lang['9'] = 'GMT + 9 Hours';
$lang['9.5'] = 'GMT + 9.5 Hours';
$lang['10'] = 'GMT + 10 Hours';
$lang['11'] = 'GMT + 11 Hours';
$lang['12'] = 'GMT + 12 Hours';
$lang['13'] = 'GMT + 13 Hours';

// These are displayed in the timezone select box
$lang['tz']['-12'] = 'GMT - 12 Hours';
$lang['tz']['-11'] = 'GMT - 11 Hours';
$lang['tz']['-10'] = 'GMT - 10 Hours';
$lang['tz']['-9'] = 'GMT - 9 Hours';
$lang['tz']['-8'] = 'GMT - 8 Hours';
$lang['tz']['-7'] = 'GMT - 7 Hours';
$lang['tz']['-6'] = 'GMT - 6 Hours';
$lang['tz']['-5'] = 'GMT - 5 Hours';
$lang['tz']['-4'] = 'GMT - 4 Hours';
$lang['tz']['-3.5'] = 'GMT - 3.5 Hours';
$lang['tz']['-3'] = 'GMT - 3 Hours';
$lang['tz']['-2'] = 'GMT - 2 Hours';
$lang['tz']['-1'] = 'GMT - 1 Hours';
$lang['tz']['0'] = 'GMT';
$lang['tz']['1'] = 'GMT + 1 Hour';
$lang['tz']['2'] = 'GMT + 2 Hours';
$lang['tz']['3'] = 'GMT + 3 Hours';
$lang['tz']['3.5'] = 'GMT + 3.5 Hours';
$lang['tz']['4'] = 'GMT + 4 Hours';
$lang['tz']['4.5'] = 'GMT + 4.5 Hours';
$lang['tz']['5'] = 'GMT + 5 Hours';
$lang['tz']['5.5'] = 'GMT + 5.5 Hours';
$lang['tz']['6'] = 'GMT + 6 Hours';
$lang['tz']['6.5'] = 'GMT + 6.5 Hours';
$lang['tz']['7'] = 'GMT + 7 Hours';
$lang['tz']['8'] = 'GMT + 8 Hours';
$lang['tz']['9'] = 'GMT + 9 Hours';
$lang['tz']['9.5'] = 'GMT + 9.5 Hours';
$lang['tz']['10'] = 'GMT + 10 Hours';
$lang['tz']['11'] = 'GMT + 11 Hours';
$lang['tz']['12'] = 'GMT + 12 Hours';
$lang['tz']['13'] = 'GMT + 13 Hours';

$lang['datetime']['Sunday'] = 'Sunday';
$lang['datetime']['Monday'] = 'Monday';
$lang['datetime']['Tuesday'] = 'Tuesday';
$lang['datetime']['Wednesday'] = 'Wednesday';
$lang['datetime']['Thursday'] = 'Thursday';
$lang['datetime']['Friday'] = 'Friday';
$lang['datetime']['Saturday'] = 'Saturday';
$lang['datetime']['Sun'] = 'Sun';
$lang['datetime']['Mon'] = 'Mon';
$lang['datetime']['Tue'] = 'Tue';
$lang['datetime']['Wed'] = 'Wed';
$lang['datetime']['Thu'] = 'Thu';
$lang['datetime']['Fri'] = 'Fri';
$lang['datetime']['Sat'] = 'Sat';
$lang['datetime']['January'] = 'January';
$lang['datetime']['February'] = 'February';
$lang['datetime']['March'] = 'March';
$lang['datetime']['April'] = 'April';
$lang['datetime']['May'] = 'May';
$lang['datetime']['June'] = 'June';
$lang['datetime']['July'] = 'July';
$lang['datetime']['August'] = 'August';
$lang['datetime']['September'] = 'September';
$lang['datetime']['October'] = 'October';
$lang['datetime']['November'] = 'November';
$lang['datetime']['December'] = 'December';
$lang['datetime']['Jan'] = 'Jan';
$lang['datetime']['Feb'] = 'Feb';
$lang['datetime']['Mar'] = 'Mar';
$lang['datetime']['Apr'] = 'Apr';
$lang['datetime']['May'] = 'May';
$lang['datetime']['Jun'] = 'Jun';
$lang['datetime']['Jul'] = 'Jul';
$lang['datetime']['Aug'] = 'Aug';
$lang['datetime']['Sep'] = 'Sep';
$lang['datetime']['Oct'] = 'Oct';
$lang['datetime']['Nov'] = 'Nov';
$lang['datetime']['Dec'] = 'Dec';

// calendar pcp stuff
$lang['Sunday'] = 'Sunday';
$lang['Monday'] = 'Monday';

//
// Errors (not related to a
// specific failure on a page)
//
$lang['Information'] = 'Information';
$lang['Critical_Information'] = 'Critical Information';

$lang['General_Error'] = 'General Error';
$lang['Critical_Error'] = 'Critical Error';
$lang['An_error_occured'] = 'An Error Occurred';
$lang['A_critical_error'] = 'A Critical Error Occurred';

$lang['Topic_description'] = 'Description of your topic';
$lang['Description'] = 'Topic Description';

// 
// Begin Approve_Posts_Mod Block : 22
// 

//stuff user sees
$lang['approve_topic_has_awaiting'] = 'Topic has posts awaiting approval';
$lang['approve_topic_is_awaiting'] = 'Topic is awaiting approval';
$lang['approve_post_is_awaiting'] = 'Post is awaiting approval';

$lang['approve_posts_error_obtain'] = 'Could not obtain forum approval information';
$lang['approve_posts_error_delete'] = 'Could not delete forum approval information';
$lang['approve_posts_error_insert'] = 'Could not insert forum approval information';

$lang['approve_notify_subject'] = 'Approve Post';
$lang['approve_notify_link'] = 'There is a new post awaiting moderator approval. To view this post click here: ';
$lang['approve_notify_approve_link'] = 'To approve this post click here: ';
$lang['approve_notify_message'] = 'The message has been included below.';
$lang['approve_notify_message_exceeded'] = '...post continued';
$lang['approve_notify_poster'] = '*** This post will be moderated upon posting and unviewable until approved. ***';
$lang['approve_notify_user_link'] = 'Your post has been approved. To view this post, click here:';
$lang['approve_notify_user_topic'] = 'All posts of yours in this topic have been approved.';
$lang['approve_notify_auto_app'] = 'Auto-Approval Notification.';
$lang['approve_notify_auto_app_msg'] = 'You are now being automatically approved while posting in moderated forums.';
$lang['approve_notify_auto_app_rem'] = 'Auto-Approval Removal Notification.';
$lang['approve_notify_auto_app_rem_msg'] = 'You are no longer being automatically approved while posting in moderated forums.';
$lang['approve_notify_moderation'] = 'Moderation Notification.';
$lang['approve_notify_moderation_msg'] = 'You are now being moderated while posting in moderated forums.';
$lang['approve_notify_moderation_rem'] = 'Moderation Removal Notification.';
$lang['approve_notify_moderation_rem_msg'] = 'You are no longer being moderated while posting in moderated forums.';
$lang['approve_notify_post_approved'] = 'Your post has been approved!.';

$lang['approve_topic_all_current'] = 'Approve all current posts in this topic';
$lang['approve_topic_all_future'] = 'Auto-Approve all future posts in this topic';
$lang['approve_topic_all_future_rem'] = 'Remove Auto-Approve of all future posts in this topic';
$lang['approve_topic_moderate'] = 'Moderate this topic and all future replies';
$lang['approve_topic_moderate_rem'] = 'Remove topic moderation';
$lang['approve_post_approve'] = 'Approve this post';
$lang['approve_topic_approve'] = 'Approve this topic';
$lang['approve_user_auto_approve'] = 'Auto-Approve this user';
$lang['approve_user_auto_approve_rem'] = 'Remove Auto-Approve';
$lang['approve_user_moderate'] = 'Moderate this user';
$lang['approve_user_moderate_rem'] = 'Remove Moderation';

//stuff admin sees
$lang['approve_admin_enable'] = 'Enable Approval System:';
$lang['approve_admin_posts'] = 'Approve Posts';
$lang['approve_admin_users_enable'] = 'Moderate:';
$lang['approve_admin_users_all'] = 'All Users & Topics';
$lang['approve_admin_users_mod'] = 'Selected Users & Topics only';
$lang['approve_admin_posts_topics'] = 'Moderate on:';
$lang['approve_admin_posts_enable'] = 'New Posts';
$lang['approve_admin_poste_enable'] = 'Post edits';
$lang['approve_admin_topics_enable'] = 'New Topics';
$lang['approve_admin_topice_enable'] = 'Topic edits';
$lang['approve_admin_hide_topics_enable'] = 'Hide Unapproved Topics:';
$lang['approve_admin_hide_posts_enable'] = 'Hide Unapproved Posts:';
$lang['approve_admin_button_find'] = 'Find Users';
$lang['approve_admin_button_add'] = 'Add User';
$lang['approve_admin_button_rem'] = 'Remove User';
$lang['approve_admin_moderators'] = 'Moderator(s):';
$lang['approve_admin_forums'] = 'Forums';
$lang['approve_admin_users'] = 'Users';
$lang['approve_admin_author'] = 'Author';
$lang['approve_admin_subject'] = 'Subject';
$lang['approve_admin_empty'] = '--empty--';
$lang['approve_admin_remove'] = 'remove';
$lang['approve_admin_approve'] = 'approve';
$lang['approve_admin_add_approved_submit'] = 'Auto-Approve';
$lang['approve_admin_add_moderated_submit'] = 'Moderate';
$lang['approve_admin_page'] = 'Page: ';
$lang['approve_admin_remove_moderation'] = 'Remove Moderation';
$lang['approve_admin_remove_approval'] = 'Remove Approval';

//Admin menu titles moved to lang_admin.php'; 

$lang['approve_admin_notify_user_enable'] = 'PM User on Approval:';
$lang['approve_admin_notify_admin_enable'] = 'Moderator Notification:';
$lang['approve_admin_notify_type'] = 'Notify Via: ';
$lang['approve_admin_notify_pm_enable'] = 'Private Message';
$lang['approve_admin_notify_email_enable'] = 'E-Mail';
$lang['approve_admin_notify_message_enable'] = 'Include Post in Notification: ';
$lang['approve_admin_notify_message_length'] = 'Max Length (0 = all)';
$lang['approve_admin_notify_posts_topics'] = 'Notify on:';
$lang['approve_admin_notify_posts_enable'] = 'New posts';
$lang['approve_admin_notify_poste_enable'] = 'Post edits';
$lang['approve_admin_notify_topics_enable'] = 'New Topics';
$lang['approve_admin_notify_topice_enable'] = 'Topic edits';
$lang['approve_admin_notify_user_invalid'] = 'Please go back and edit your entry.<br/>The following user user is invalid: ';
$lang['approve_admin_notify_user_empty'] = 'Please go back and edit your entry.<br/>You must choose at least one moderator to notify.';

$lang['approve_admin_username'] = 'Username';
$lang['approve_admin_users_moderated_users'] = 'Moderated Users';
$lang['approve_admin_users_auto_approved'] = 'Auto-Approved Users';
$lang['approve_admin_users_of'] = 'Users <b>%d</b>-<b>%d</b> of <b>%d</b>'; // Replaces with: Users 1-2 of 2 for example
$lang['approve_admin_users_id_remove_error'] = 'The chosen user id is invalid.';
$lang['approve_admin_users_moderation_removed'] = 'The user "%s" has been removed from moderation.';
$lang['approve_admin_users_approval_removed'] = 'The user "%s" has been removed from auto-approval.';
$lang['approve_admin_users_approval_added'] = 'The user "%s" has been added to auto-approval.';
$lang['approve_admin_users_moderated_added'] = 'The user "%s" has been added to moderation.';
$lang['approve_admin_add_approved_user'] = 'Add Auto-Approved User';
$lang['approve_admin_add_moderated_user'] = 'Add Moderated User';

$lang['approve_admin_topics_title'] = 'Topic Title';
$lang['approve_admin_approve_topic'] = 'Approve Topic';
$lang['approve_admin_topics_moderated_topics'] = 'Moderated Topics';
$lang['approve_admin_topics_awaiting'] = 'Topics Awaiting Approval';
$lang['approve_admin_topics_auto_approved'] = 'Auto-Approved Topics';
$lang['approve_admin_topics_of'] = 'Topics <b>%d</b>-<b>%d</b> of <b>%d</b>'; // Replaces with: Topics 1-2 of 2 for example
$lang['approve_admin_topics_id_remove_error'] = 'The chosen topic id is invalid.';
$lang['approve_admin_topics_moderation_removed'] = 'The topic "%s" has been removed from moderation.';
$lang['approve_admin_topics_approval_removed'] = 'The topic "%s" has been removed from auto-approval.';
$lang['approve_admin_topics_approval_added'] = 'The topic "%s" has been added to auto-approval.';
$lang['approve_admin_topics_moderated_added'] = 'The topic "%s" has been added to moderation.';
$lang['approve_admin_topics_approved'] = 'The topic "%s" has been approved.';

$lang['approve_admin_approve_post'] = 'Approve Post';
$lang['approve_admin_posts_awaiting'] = 'Posts Awaiting Approval';
$lang['approve_admin_posts_of'] = 'Posts <b>%d</b>-<b>%d</b> of <b>%d</b>'; // Replaces with: Posts 1-2 of 2 for example
$lang['approve_admin_posts_id_remove_error'] = 'The chosen post id is invalid.';
$lang['approve_admin_posts_approved'] = 'The post "%s" by "%s" has been approved.'; //Replaces with: The post "blah" by "mr.man" has been approved.

$lang['approve_admin_forums_moderated'] = 'Forums Under Moderation';
$lang['approve_admin_Stored_replacement'] = $lang['Stored'] . '<br/><br/> It will become viewable as soon as a moderator approves of it. <br/> Please do not submit your message more than once.';
// 
// End Approve_Posts_Mod Block : 22
//

$lang['Home'] = 'Home';

// Start add - Fully integrated shoutbox MOD
$lang['Shoutbox'] = 'Shoutbox';
$lang['Shoutbox_date'] = ' d m Y h:i:s';
$lang['Shout_censor'] = 'shout removed !';
$lang['Shout_refresh'] = 'Refresh';
$lang['Shout_text'] = 'Your text';
$lang['Viewing_Shoutbox']= 'Viewing shoutbox';
$lang['Censor'] ='Censor';
$lang['This_posts_IP'] = 'IP address of this message';
$lang['Other_IP_this_user'] = 'Other IP addresses of this user';
$lang['Users_this_IP'] = 'Users using this IP address';
$lang['IP_info'] = 'IP Information';
$lang['Lookup_IP'] = 'Search IP address';
$lang['Disable_HTML_post'] = 'Disable HTML in this message';
$lang['Disable_BBCode_post'] = 'Disable BBCode in this message';
$lang['Disable_Smilies_post'] = 'Disable Smilies in this post';
$lang['Smilies'] = 'Smilies';

// End add - Fully integrated shoutbox MOD

$lang['Message_preview'] = 'Message Received Preview';

// Start add - Yellow card admin MOD
$lang['Rules_ban_can'] = 'You <b>can</b> ban other users in this forum'; 
$lang['Rules_greencard_can'] = 'You <b>can</b> un-ban users in this forum'; 
$lang['Rules_bluecard_can'] = 'You <b>can</b> report post to moderators in this forum'; 

$lang['Viewing_RULES'] = 'Viewing the Rules';
$lang['Forum_Rules'] = 'Rules';

$lang['cookies_link'] = 'MyCookies Manager';

// RATING MOD
$lang['Rating'] = 'Rating';
$lang['No_rating'] = 'No rating';
$lang['Ratings_by'] = 'Posts rated by %s';
$lang['Rated_posts_by'] = 'Posts by %s that have been rated';
$lang['Latest_ratings'] = 'Latest ratings';
$lang['Highest_ranked_topics'] = 'Highest-ranked topics';
$lang['Highest_ranked_posts'] = 'Highest-ranked posts';
$lang['Highest_ranked_posters'] = 'Highest-ranked posters';

$lang['Staff'] = 'Staff Site';

//
// Bookmark Mod
//
$lang['More_bookmarks'] = 'More bookmarks...'; // For mozilla navigation bar

//-----------------------------------------------------------------------------
// MOD: Delayed Topics
$lang['Delayed_Post_Alt'] = 'Delayed Topic (due %s)';	// %s replaced by delivery date
$lang['Sorry_auth_delayedpost'] = 'Sorry but only %s can post delayed topics';

// MOD: Delayed Topics {end}
//-----------------------------------------------------------------------------
// Logo Selector MOD
$lang['Logo_settings'] = 'Logo Setting';
$lang['Logo_explain'] = 'Here you can set the folder path to your forum logos, the logo to be used and it\'s display height and width.';
$lang['Logo_path'] = 'Logo Storage Path';
$lang['Logo_path_explain'] = 'Path under your phpBB root dir, e.g. images/logo';
$lang['Logo'] = 'Choose a Logo';
$lang['Logo_dimensions'] = 'Logo Dimensions';
$lang['Logo_dimensions_explain'] = '(Height x Width in pixels) ';
$lang['PS_admin_ban']				= 'Auto Ban';
$lang['PS_admin_ban_exp']			= '<br>This will automatically ban any IP that tries to use a Clike, SQL Injection, DDoS or UNION trick.';
$lang['PS_admin_sessions']			= 'Max Allowed Sessions';
$lang['PS_admin_sessions_exp']		= '<br>If your sessions table gets bigger than this number, the mod will automatically get it below this number.';
$lang['PS_clike']					= 'Clike Attempt';
$lang['PS_union']					= 'Union Attempt';
$lang['PS_sql']						= 'SQL Injection Attempt';
$lang['PS_ddos']					= 'DDoS Attempt';
$lang['PS_caught_left']				= 'IP';
$lang['PS_caught_c_left']			= 'Caught For';
$lang['PS_caught_c_right']			= 'Caught On';
$lang['PS_caught_right']			= 'Attempts';
$lang['PS_caught_msg']				= 'There have been no attempts by script kiddies on our site.';
$lang['PS_special']					= 'phpBB Security :: Special Fields';
$lang['PS_special_admins']			= 'Amount of allowed admins';
$lang['PS_special_admins_exp']		= '<br>This number will set how many admins are allowed to be on your site. So no one can inject an admin account to gain access.';
$lang['PS_special_admins_total']	= '<br>You currently have %X% real users set to \'Admin\' status in the users table.';
$lang['PS_special_admins_offset']	= '<font color="red"> It appears you have more admins in the users table than allowed!</font>';
$lang['PS_special_mods']			= 'Amount of allowed mods';
$lang['PS_special_mods_exp']		= '<br>This number will set how many moderators are allowed to be on your site. So no one can inject a moderator account to gain access.';
$lang['PS_special_mods_total']		= '<br>You currently have %X% real users set to \'Moderator\' status in the users table.';
$lang['PS_special_mods_offset']		= '<font color="red"> It appears you have more mods in the users table than allowed!</font>';
$lang['PS_use_special']				= 'Protect admin & moderator accounts';
$lang['PS_use_special_exp']			= '<br>Disabling this, will not stop any extra admins or mods added.';
///
$lang['LW_USER_ACCT_ERROR'] = 'Member with ID = %d doesnot exist.';
$lang['LW_WELCOME_REGISTERED'] = 'Thank you for registering. Your account has been created.';
$lang['LW_TRANSACTION_RECORDS'] = 'Transactions';
$lang['LW_EXPIRE_MEMBER_REMINDER'] = 'Your membership will be expired on <b>%s</b>';
$lang['LW_EXPIRE_TRIAL_REMINDER'] = 'Your trial period has <b>%d</b> day(s) left';
$lang['LW_WELCOME_REGIST_TRIAIL'] = 'Welcome %s, now you can surf our website for %d day(s) trial period. <br>After that if you want to continue accessing all our services, you will need to pay us subscription fee %s.';
$lang['LW_AMOUNT_TO_PAY_EXPLAIN'] = 'Upon confirmation of payment you will receive access to all the forums, be listed in the directory.';
$lang['LW_TRIAL_PERIOD'] = 'The trial period for member to access your site, <br>based on days, greater or equal to zero: ';
$lang['LW_OUR_SUBSCRIPTION_FEE'] = 'Subscription fee: ';
$lang['LW_OUR_PAYPAL_CURRENCY_CODE'] = 'The currency code your PayPal account supported: ';
$lang['LW_OUR_PAYPAL_ACCT'] = 'Your PayPal account to receive payment from members: ';
$lang['LW_PAYPAL_ACCT_SETTINGS_TITLE'] = 'PayPal IPN Settings';
$lang['LW_ACCT_DISPLAY_FROM'] = 'Display transaction records for last: ';
$lang['LW_ALL_RECORDS'] = 'All Records';
$lang['LW_NO_RECORDS'] = 'There is no record';
$lang['LW_ACCT_CREDIT'] = 'Credit';
$lang['LW_ACCT_DEBIT'] = 'Debit';
$lang['NP_DATE'] = 'Date';
$lang['LW_ACCT_CURRENCY'] = 'Currency';
$lang['LW_ACCT_AMOUNT'] = 'Amount';
$lang['LW_ACCT_PLUS_MINUS'] = 'Credit / Debit';
$lang['LW_ACCT_TXNID'] = 'PayPal TXN ID';
$lang['LW_ACCT_STATUS'] = 'Status';
$lang['LW_ACCT_COMMENT'] = 'Remarks';
$lang['LW_NO_PRIVILEGE'] = 'You donot have the privilege to view this page.';
$lang['LW_Click_view_ACCT_RECORDS'] = 'Click %shere%s to view your acount transaction records';
$lang['LW_PAYMENT_DONE'] = 'Payment for subscription fee done successfully.';
$lang['LW_PAYMENT_PENDDING'] = 'Thank you! Your payment is still pendding, your account will be automatically upgraded after our administrator accept your payment. <br>The notice of acceptance of the payment will be sent to your following email account: %s by PayPal.';
$lang['LW_PAYMENT_DENIED'] = 'Payment from your account is denied, please contact our administrator if you have any question.';
$lang['LW_PAYMENT_FAILED'] = 'Payment from your account failed, please try again later.';
$lang['LW_UPDATE_USER_ACCT_ERROR'] = 'Update member account error, please contact our administrator.';
$lang['LW_AMOUNT_TO_PAY'] = 'Amount to pay: ';
$lang['LW_ACCT_DEPOSIT_INTO'] = 'Payment';
$lang['LW_TOPUP_CONFIRM_TITLE'] = 'Confirm Your Payment';
$lang['Account_not_exist_lw'] = 'The account you specified doesnot exist.';
$lang['Account_activated_lw'] = 'Your account has already been set to access all forums.';
$lang['Click_return_login_lw'] = 'Click %sHere%s to login now.';
$lang['Click_return_activate_lw'] = 'Click %shere%s to pay subscription fee to upgrade your account.';
$lang['Disabled_account_lw'] = 'Your account has not been activated.';
$lang['LW_PAYPAL_ACCT_ERROR'] = 'Website PayPal account has not been set up to receive funds, please contact our administrator to report this issue.';
$lang['LW_PAYMENT_DATA_ERROR'] = 'The amount of subscription fee is wrong.';
$lang['LW_YOU_ARE_VIP'] = 'Welcome %s, you are our <b>VIP</b>.';
$lang['L_LW_PAYMENTS'] = 'Subscription';
$lang['LW_LOGIN_TO_PAY'] = 'Please login with your account name and password, you will be re-directed to payment page if you have not done so. Thanks!';
$lang['LW_PAY_FOR_WHICH_MONTH'] = 'For subscription from <b>%s</b> to <b>%s</b>';
///
$lang['Sorry_auth_paid_read'] = 'Sorry, but only <b>paid members</b> can read topics in this forum.'; 
$lang['LW_Welcome_Nopaid_Member'] = 'Welcome %s, you are our common member.'; 
$lang['Sorry_auth_paid_post'] = 'Sorry, but only <b>paid members</b> can post topics in this forum.'; 
$lang['L_LW_PAID_GROUP_NAME'] = 'The group name for paid member to join: '; 
$lang['LW_SELECT_A_GROUP'] = 'Please select a group to join'; 
$lang['L_LW_GROUP_TO_PAY'] = 'The group you want to join: '; 
$lang['LW_TOPUP_TITLE'] = 'Join Payment-Group';
$lang['L_LW_GROUP_DESCRIPTION'] = 'Group Description: ';
$lang['L_LW_FOR_JOIN_GROUP'] = 'to join group: ';
$lang['L_LW_FOR_UPGRADE_GROUP'] = 'to upgrade to group: ';
$lang['L_LW_FOR_EXTEND_GROUP'] = 'to extend membership in group: ';
$lang['L_LW_USER_EXTEND_SAME_GROUP'] = 'You are going to extend your current membership.';
$lang['L_LW_USER_JOIN_GROUP'] = 'You are going to subscribe this group.';
$lang['L_LW_USER_UPGRADE_GROUP'] = 'You are going to upgrade your current membership.';
$lang['L_LW_USER_DOWNGRADE_GROUP'] = 'You cannot downgrade your membership, please wait your current membership to expire.';
$lang['L_LW_UPGRADE_REMIND'] = 'Subscription Detailes: ';
///
$lang['Click_return_subscribe_lw'] = 'Click %shere%s to select a group to join. You will need to pay a subscription fee.';
$lang['L_LW_GROUP_ALREADY_JOIN'] = 'The group you are currently in: '; 
$lang['L_LW_GROUP_VIEW_DETAIL'] = 'View this group subscription detailes: '; 
$lang['LW_PAYMENT_SUBSCRIPTION'] = 'Your group subscription has been submitted.'; 
///
$lang['LW_ANONYMOUS_DONOR'] = 'Anonymous';
$lang['LW_MORE_DONORS'] = 'View All Donors';
$lang['LW_CURRENT_DONORS'] = 'View Donors For Current Goal';
$lang['L_LW_LAST_DONORS'] = 'Last %s Donors';
$lang['L_LW_TOP_DONORS_TITLE'] = 'Top %s Donors';
$lang['L_LW_DONORS_NAME'] = 'Donor\'s Name';
$lang['LW_DONORS_DISPLAY_FROM'] = 'Display donors for last: ';
$lang['LW_NO_DONORS_YET'] = 'Currently no donor yet';
$lang['LW_WE_HAVE_COLLECT'] = 'We have collected <b>%.2f</b> out of our goal of <b>%s</b>.';
$lang['LW_WANT_ANONYMOUS'] = 'I want to be anonymous.';
$lang['L_LW_DONATE_WAY'] = 'Your status as donor: ';
$lang['LW_DONATION_TO_POINTS'] = 'Thanks for your donation! In return, we are glad to increase your total points by %d';
$lang['LW_DONATION_TO_WHO'] = 'Donate to %s , Thanks!';
$lang['LW_DONATE_TITLE'] = 'Donation';
$lang['LW_AMOUNT_TO_DONATE'] = 'Amount to donate: ';
$lang['LW_AMOUNT_TO_DONATE_EXPLAIN'] = 'Thanks for your donation, it will greatly help us to support our members better. Thanks!';
$lang['LW_DONATE_CONFIRM_TITLE'] = 'Confirm Your Donate Amount';
$lang['LW_ACCT_DONATE_INTO'] = 'Donate';
$lang['LW_DONATE_DONE'] = 'Thank you for your donation. It will help us to bring better service to our valued members.';
$lang['LW_DONATE_PENDDING'] = 'Thank you for your donation. It will help us to bring better service to our valued members.';
$lang['LW_DONATE_DENIED'] = 'Sorry donation is denied for some reason, please contact our administrator if you have any question. Thanks!';
$lang['LW_DONATE_FAILED'] = 'Donation failed, please try again later. Thanks!';
$lang['LW_ACCT_DONATE_US'] = 'Donate';
$lang['LW_CURRENCY_TO_PAY'] = 'Select the currency type: ';
$lang['LW_CURRENCY_TO_PAY_EXPLAIN'] = 'Currently we only accpet %s.';
$lang['LW_PAYMENT_DATA_ERROR'] = 'The amount or the currency you entered is wrong.';
$lang['LW_DONATION_TO_POSTS'] = 'Thanks for your donation! In return, we are glad to increase your total posts count by %d';
$lang['LW_DONATION_TO_HELP'] = 'Please help us to develop!';
$lang['L_LW_MONEY'] = 'Money donated'; 
$lang['L_LW_DATE'] = 'Date donated';
$lang['LW_DONATE_EXPLAIN'] = 'Click here to support us'; 
///
// Please note: %sHERE%s is used to dynamically building the A HREF tag, do not remove the percent signs (%) around HERE!
$lang['dhtml_faq_noscript'] = "It appears that your browser does not support javascript or it has been disabled in your browser's settings.<br /><br />Please, click %sHERE%s to view a plain HTML version of this FAQ.";
// added by edwin :: required fields
$lang['Required_force']	= 'Sorry, it appears this is your first visit since we added some required fields to the system. <br />Once you update the fields marked with %s, you will be able to enjoy the whole site. <br />Thanks!<br /> <br />Click on the fieldnames below to complete them:<br />%s';
// added by edwin :: registration
$lang['Profile_updated_inactive'] = 'Your profile has been updated. However, you have changed vital details, thus your account is now inactive. Check your e-mail to find out how to reactivate your account.';
$lang['Profile_updated_inactive_admin'] = 'Your profile has been updated. However, you have changed vital details, thus your account is now inactive. Wait for the administrator to reactivate it.';
$lang['Click_return_portal'] = 'Click %sHere%s to return to the Portal';
$lang['PS_security_a_exp_empty'] = 'This answer will be hashed once submitted, so no one can know it but you. Please remember or write this down as you might need it again and it cannot be changed.';
$lang['PS_security_a_exp_submitted'] = 'This is the hashed version of your answer you submitted before, so no one can know it but you. If you want to change it, you will have to contact the admin of this site.';

// BEGIN Style Select MOD
$lang['Style_select_manage'] = 'Style select manage';
$lang['Style_select_explain'] = 'Using this facility you can manage style select info table';
$lang['Style_select_author'] = 'Author';
$lang['Style_select_version'] = 'Version';
$lang['Style_select_website'] = 'Web Site';
$lang['Style_select_viewings'] = 'Viewings';
$lang['Style_select_dlurl'] = 'File URL';
$lang['Style_select_dls'] = 'Download Total';
$lang['Style_select_loaclurl'] = 'Localization URL';
$lang['Style_select_ludls'] = 'Localization Download Total';
$lang['Click_return_style_sel_admin'] = 'Click %sHere%s to return to Style Select Administration';
$lang['Style_select_update'] = 'Data was successfully updated';
// END Style Select MOD

// FIND - newsfeeds
$lang['Check_All'] = 'Select All';
$lang['UnCheck_All'] = 'De-Selecte All';
$lang['News_Read_More'] = 'Read more...';
$lang['News_source'] = 'Source: ';
// end FIND - newsfeeds

$lang['Portal'] = 'Portal'; 

$lang['By'] = 'by'; // picture {By} user :: Topic {By} user
$lang['Country'] = 'Country';

$lang['No_r_click'] = 'No Right Click Is Allowed'; 
$lang['No_copy'] = 'Copy Is Not Allowed';

$lang['Login_attempts_exceeded'] = 'The maximum number of %s login attempts has been exceeded. You are not allowed to login for the next %s minutes.';
$lang['Please_remove_install'] = 'Please ensure that the install/ directory is deleted';
$lang['Please_remove_prill'] = 'Please ensure that the prill_install/ directory is deleted';
$lang['Please_remove_both'] = 'Please ensure both the install/ and prill_install/ directories are deleted';
$lang['Session_invalid'] = 'Invalid Session. Please resubmit the form.';

//====================================================================== |
//==== Start Advanced BBCode Box MOD =================================== |
//==== v5.0.0 ========================================================== |
//====
$lang['BBCode_box_hidden'] = 'Spoilers';
$lang['BBcode_box_view'] = 'Click to View Content';
$lang['BBcode_box_hide'] = 'Click to Hide Content';
//====
//==== Author: Disturbed One [http://hvmdesign.com] =================== |
//==== End Advanced BBCode Box MOD ==================================== |
//===================================================================== |

// Mighty Gorgon - Full Album Pack - BEGIN
$lang['Album'] = 'Album';
$lang['Personal_Gallery_Of_User'] = 'Personal Gallery Of %s';
$lang['Personal_Gallery_Of_User_Profile'] = 'Personal Gallery of %s (%d Pictures)';
$lang['Show_All_Pic_View_Mode_Profile'] = 'Show All Pictures In The Personal Gallery of %s (without sub cats)';
$lang['Not_allowed_to_view_album'] = 'Sorry, you are not allowed to view the album.';
$lang['Not_allowed_to_upload_album'] = 'Sorry, you are not allowed to upload new pic to the album. Please contact the album administrator for more information.';
$lang['Album_empty'] = 'There are no pics in the album<br />Click on the <b>Upload New Pic</b> link on this page to post one.';
$lang['Upload_New_Pic'] = 'Upload New Pic.';
$lang['Pic_Title'] = 'Pic Title';
$lang['Pic_Title_Explain'] = 'It is very important to give your pic a good title. It could be a name, a subject to make others know what it is without see it.';
$lang['Pic_Upload'] = 'Pic Upload';
$lang['Pic_Upload_Explain'] = 'Allowed types are JPG, GIF and PNG. Maximum file size is %s bytes. Maximum image dimensions are %sx%s pixels.';
$lang['Album_full'] = 'Sorry, the album has reached the maximum number of uploaded pics. Please contact the album administrator for more information.';
$lang['Album_upload_successful'] = 'Thank you, your pic has been uploaded successfully.';
$lang['Click_return_album'] = 'Click %shere%s to return to the Album.';
$lang['Invalid_upload'] = 'Invalid Upload<br /><br />Your pic is too big or its type is not allowed.';
$lang['Image_too_big'] = 'Sorry, your image dimensions is too large.';
$lang['Uploaded_by'] = 'Uploaded by';
$lang['Category_locked'] = 'Sorry, you cannot upload because this category was locked by an admin. Please contact the album administrator for more information.';
$lang['View_Album_Index'] = 'Album Index';
$lang['View_Album_Personal'] = 'Viewing Personal Album of a user';
$lang['View_Pictures'] = 'Viewing Pictures or Posting/Reading comments in the Album';
$lang['Album_Search'] = 'Searching the Album';
$lang['Pic_Name'] = 'Picture Name';
$lang['Description'] = 'Description';
$lang['Search_Contents'] = ' that contains: ';
$lang['Search_Found'] = 'Search found ';
$lang['Search_Matches'] = 'Matches:';
// Mighty Gorgon - Full Album Pack - END

$lang['profilcp_photo_shortcut'] = 'Photo';
$lang['profilcp_photo_pagetitle'] = 'Photo';
$lang['Public_view_photo'] = 'Display photos';
$lang['User_allowphoto'] = 'Can display photo';
$lang['Photo_panel'] = 'Photo control panel';
$lang['Photo_gallery'] = 'Photo gallery';
$lang['Only_one_photo'] = 'Only one type of photo can be specified';
$lang['Wrong_remote_photo_format'] = 'The URL of the remote photo is not valid';
$lang['Photo'] = 'Photo';
$lang['Photo_explain'] = 'Displays a small graphic image in your profile. Only one image can be displayed at a time, its width can be no greater than %d pixels, the height no greater than %d pixels, and the file size no more than %d KB.';
$lang['Upload_Photo_file'] = 'Upload Photo from your machine';
$lang['Upload_Photo_URL'] = 'Upload Photo from a URL';
$lang['Upload_Photo_URL_explain'] = 'Enter the URL of the location containing the Photo image, it will be copied to this site.';
$lang['Pick_local_Photo'] = 'Select Photo from the gallery';
$lang['Link_remote_Photo'] = 'Link to off-site Photo';
$lang['Link_remote_Photo_explain'] = 'Enter the URL of the location containing the Photo image you wish to link to.';
$lang['Photo_URL'] = 'URL of Photo Image';
$lang['Select_from_gallery'] = 'Select Photo from gallery';
$lang['View_photo_gallery'] = 'Show gallery';
$lang['Select_photo'] = 'Select photo';
$lang['Photo_filetype'] = 'The photo filetype must be .jpg, .gif or .png';
$lang['Photo_filesize'] = 'The photo image file size must be less than %d KB';
$lang['Photo_imagesize'] = 'The photo must be less than %d pixels wide and %d pixels high'; 

//Begin Lo-Fi Mod
$lang['Lofi'] = 'Lo-Fi Version';
$lang['Full_Version'] = 'Full Version';
$lang['quote_lofi'] = 'Quote';
$lang['edit_lofi'] = 'Edit';
$lang['ip_lofi'] = 'IP';
$lang['del_lofi'] = 'Delete';
$lang['profile_lofi'] = 'Profile';
$lang['pm_lofi'] = 'PM';
$lang['email_lofi'] = 'E-mail';
$lang['website_lofi'] = 'Website';
$lang['icq_lofi'] = 'ICQ';
$lang['aim_lofi'] = 'AIM';
$lang['yim_lofi'] = 'YIM';
$lang['msnm_lofi'] = 'MSN';
$lang['quick_lofi'] = 'Quick Reply';
$lang['new_pm_lofi'] = 'Send a PM';
//End Lo-Fi Mod

// Forum Tour
$lang['Forum_tour'] = 'Forum Tour';
$lang['Forum_tour_links'] = 'Forum Tour Links';
$lang['Tour_page'] = 'Goto page ';
$lang['No_forum_tour'] = 'Sorry, the Forum Tour is unavailable. Please try again later.';
$lang['Tour_close'] = 'Close Forum Tour';
$lang['First_page'] = 'Content';
$lang['FT_Guest'] = 'Guest';
$lang['FT_User'] = 'User';
$lang['FT_Mod'] = 'Moderator';
$lang['FT_less_admin'] = 'Super Moderator';
$lang['FT_admin'] = 'Administrator';

//
// That's all, Folks!
// -------------------------------------------------

?>