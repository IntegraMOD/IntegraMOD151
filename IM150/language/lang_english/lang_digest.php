<?php

/***************************************************************************
 *                           lang_digest.php [English]
 *                              -------------------
 *   begin                : Tuesday, April 6, 2004
 *   copyright            : (C) 2004 masterdavid - Ronald John David
 *   website			  : http://www.integramod.com
 *   email                : webmaster@integramod.com
 *
 *   note: removing the original copyright is illegal even you have modified
 *         the code.  Just append yours if you have modified it.
 ***************************************************************************/


/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

//
// Digests MOD
//
// This block is for general lang definitions
$lang['Digests'] = 'Digests';
$lang['digest_options'] = 'Digest Options';
$lang['digest_format'] = 'Format';
$lang['digest_show_message_text'] = 'Show Message Text';
$lang['digest_show_my_messages'] = 'Show My Messages';
$lang['digest_frequency'] = 'Digest Frequency';
$lang['digest_new_only'] = 'Show only new messages since last time I logged in';
$lang['digest_send_empty'] = 'Send empty digests';
$lang['digest_message_size'] = 'Maximum characters per message in digest';

// This block is for lang specific to mail_digests.php
$lang['digest_introduction'] = "As you requested, here is the latest digest of messages posted on %s forums. Please come and join the discussion!";
$lang['digest_disclaimer_html'] = "This digest is being sent to registered members of %s forums and only because you explicitly requested it. %s is completely commercial free. Your email address is never disclosed to outside parties. See our %sFAQ%s for more information on our privacy policies. You can change or delete your subscription by logging into %s from the %sDigest Page%s. (You must be logged in to change your digest settings.) If you have questions or feedback on the format of this digest please send it to the %sWebmaster%s.";
$lang['digest_disclaimer_text'] = "This digest is being sent to registered members of %s forums and only because you explicitly requested it. %s is completely commercial free. Your email address is never disclosed to outside parties. See our FAQ for more information on our privacy policies. You can change or delete your subscription by logging into %s from the Digest Page. (You must be logged in to change your digest settings.) If you have questions or feedback on the format of this digest please send it to the Webmaster.";
$lang['digest_salutation'] = 'Dear';
$lang['Digest_Read_More'] = 'Read more...';

// This block is for lang specific to digests.php
$lang['digest_explanation'] = "Digests are email summaries of messages posted here that are sent to you periodically. Digests are sent on a schedule you set with the frequency below. You can specify those particular forums for which you want message summaries, or you can elect to receive all messages for all forums for which you are allowed access.<br /><br />\r\nConsisent with our privacy policy digests contain no \"spam\", nor is your email address used in any way connected to an advertisement. You can, of course, cancel your digest subscription at any time by simply coming back to this page. Most users find digests to be very useful. We encourage you to give it a try!";
$lang['digest_html'] = 'HTML';
$lang['digest_text'] = 'Text';
$lang['digest_format_desc'] = 'HTML is highly recommended unless your email program cannot display HTML';
$lang['digest_new_only_desc'] = 'This will filter out any messages posted prior to the date and time you last visited that would otherwise be included in the digest.';
$lang['digest_frequency_desc'] = 'Enter the number of hours to wait before sending the next digest. Or enter 0 to remove youself from this feature';
$lang['digest_size_desc'] = 'Caution: setting this too high may make for very long digests. A link is provided for each message that will let you see the full content of the message.';
$lang['digest_select_forums']='Send digests for these forums';
$lang['digest_create']='Your digest settings were successfully created';
$lang['digest_modify']='Your digest settings were successfully updated';
$lang['digest_unsubscribe']='You have been unsubscribed and will no longer receive a digest';
$lang['digest_no_forums_selected']='You have not selected any forums, so you will be unsubscribed';
$lang['digest_all_forums']='All Subscribed Forums';
$lang['digest_submit_text']='Make Digest Changes';
$lang['Digest_frequency_bounds'] = 'The digest frequency value you entered is not between $d and $d';
$lang['tl']['50'] = '50';
$lang['tl']['150'] = '150';
$lang['tl']['300'] = '300';
$lang['tl']['500'] = '500';
$lang['tl']['1000'] = '1000';
$lang['tl']['-1'] = 'Entire message';
//
// End Digests MOD
//

?>
