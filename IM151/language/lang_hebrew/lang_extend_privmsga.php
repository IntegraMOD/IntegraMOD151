<?php
/***************************************************************************
 *						lang_extend_privmsga.php [English]
 *						------------------------
 *	begin				: 03/12/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 0.0.7 - 08/12/2003
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
	$lang['Lang_extend_privmsga'] = 'Advanced Private Messages';
}

// rules
$lang['Rules_management'] = 'Rules management';
$lang['No_rules'] = 'No rules applied to this folder';
$lang['Add_new_rule'] = 'Create a new rule';
$lang['Rules_name'] = 'Rules name';
$lang['Rules_folder_explain'] = 'Select on which folder this rule will be applied.';
$lang['Rules_type'] = 'Rule type';
$lang['Rules_type_explain'] = 'Choose how this rule will work : it can be a group relative, user relative, system messages relative or word filter relative action.';
$lang['Rules_type_group'] = 'Groups relative';
$lang['Rules_type_user'] = 'Individual user relative';
$lang['Rules_type_sysuser'] = 'System messages relative';
$lang['Rules_type_word'] = 'Word filter relative';
$lang['Rules_name_explain'] = 'Enter here a name for this rule. This name will be used to identify and sort the rule (last one will be the last applied).';
$lang['Rules_group_explain'] = 'Messages coming from/sended to members of this group will be moved into this folder.';
$lang['Rules_user_explain'] = 'Messages coming from/sended to this user will be moved into this folder.';
$lang['Rules_sysuser_explain'] = 'Messages coming from the system will be moved into this folder.';
$lang['Rules_word'] = 'Word filter';
$lang['Rules_word_explain'] = 'Messages having this word in title or text will be moved into this folder.';
$lang['Rules_name_missing'] = 'Rules name is missing.';
$lang['Rules_folder_missing'] = 'You have to choose a folder on which the rule will be applied.';
$lang['Rules_folder_not_exists'] = 'The folder doesn\'t exist.';
$lang['Rules_folder_main'] = 'You can\'t apply a rule to a main box.';
$lang['Rules_type_unknown'] = 'Unknown rule type.';
$lang['Rules_sysuser_input'] = 'System messages can only be rooted from an input or save box.';
$lang['Rules_word_missing'] = 'Word is missing.';
$lang['Rules_edited'] = 'The rule has been edited.';
$lang['Rules_created'] = 'The rule has been created.';
$lang['Rules_deleted'] = 'This rule has been deleted.';
$lang['Delete_rule'] = 'Delete a rule';
$lang['Confirm_delete_rule'] = 'Are you sure you want to delete this rule ?';

// folders
$lang['Folder'] = 'Folder';
$lang['Folders'] = 'Folders';
$lang['Folder_name'] = 'Folder name';
$lang['Folders_management'] = 'Folders management';
$lang['Folder_name_explain'] = 'Enter here a name for your folder. This name will be used to identify the folder.';
$lang['Folder_main'] = 'Main folder';
$lang['Folder_main_explain'] = 'Choose to which mail box you want to attach this folder.';
$lang['Add_new_subfolder'] = 'Create a new folder';
$lang['Folder_not_attached'] = 'You have to choose a main box to attach your folder.';
$lang['Folder_name_missing'] = 'You have to name your folder.';
$lang['Folder_created'] = 'This folder has been created.';
$lang['Folder_edited'] = 'This folder has been edited.';
$lang['Folder_deleted'] = 'This folder has been deleted.';
$lang['Folder_not_empty'] = 'You have first to clear the folder from messages and rules before being able to delete it.';
$lang['Delete_folder'] = 'Delete a folder';
$lang['Confirm_delete_folder'] = 'Are you sure you want to delete this folder ?';
$lang['Click_return_folders'] = 'Click %sHere%s to return to folders management.';

// messages
$lang['Message_deleted'] = 'The message has been deleted.';
$lang['Click_return_outbox'] = 'Click %sHere%s to return to your Outbox.';
$lang['Click_return_sentbox'] = 'Click %sHere%s to return to your Sentbox.';
$lang['Click_return_savebox'] = 'Click %sHere%s to return to your Savebox.';

// search
$lang['Search_pm'] = 'Search in private messages';
$lang['Search_folder'] = 'Search in folder';
$lang['Search_folder_explain'] = 'Select a folder to search in (search will be also performed in sub-folders).';
$lang['Search_recipient'] = 'Search for sender or recipient';
$lang['Search_recipient_explain'] = 'Allows to filter on sender or recipients';
$lang['Search_words'] = 'Search words';
$lang['Search_words_explain'] = 'Enter the words to search, separate with a comma. If one of the words is found, the message will be displayed.';
$lang['Search_no_criteria'] = 'No criteria to search with';
$lang['All_folders'] = '----- All -----';

// email saving process
$lang['Save_to_mail_subject'] = 'Private message saved: ';
$lang['Message_saved_to_mail'] = 'The message has been sent by email';
$lang['Click_return_message'] = 'Click %sHere%s to return to the message';

// generic
$lang['Recipients'] = 'Recipients';
$lang['Forward_message'] = 'Forward message';
$lang['Save_to_mail_message'] = 'Save into mail';
$lang['Short_reply'] = 'Re: ';
$lang['Short_forward'] = 'Fwd: ';
$lang['New_message'] = 'New message';
$lang['Select_group'] = 'Select a group';
$lang['Create'] = 'Create';
$lang['Move_marked'] = 'Move to';
$lang['Move_up'] = 'Move up';
$lang['Move_down'] = 'Move down';
$lang['Copy'] = 'Copy';
$lang['Edit'] = 'Edit';

// distribution process
$lang['Distribution_failed'] = 'Distribution failed';
$lang['Sent_box_feeding_failed'] = 'Sent box feeding failed';
$lang['Word_search_failed'] = 'Word search failed';
$lang['Group_search_failed'] = 'Group search failed';
$lang['Friends_search_failed'] = 'Friends list search failed';
$lang['Sysuser_search_failed'] = 'System messages search failed';
$lang['Remove_undistrib_flag_failed'] = 'Remove undistrib flags failed';

// config var
$lang['privmsga_settings'] = 'Private messages';
$lang['max_inbox_privmsgs'] = 'Max posts in Inbox';
$lang['max_sentbox_privmsgs'] = 'Max posts in Sentbox';
$lang['max_savebox_privmsgs'] = 'Max posts in Savebox';
$lang['apm_max_userlist'] = 'Number of recipients displayed on pm lists';
$lang['apm_save_to_mail'] = 'Allow to export private messages into mails';

?>