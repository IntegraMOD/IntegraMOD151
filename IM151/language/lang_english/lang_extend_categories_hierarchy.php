<?php
/***************************************************************************
 *						lang_extend_categories_hierarchy.php [English]
 *						------------------------------------
 *	begin				: 28/09/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
  *	version				: 1.0.1 - 10/11/2003
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
	$lang['Lang_extend_categories_hierarchy']		= 'Categories Hierarchy';

	$lang['Category_attachment']					= 'Attached to';
	$lang['Category_desc']							= 'Description';
	$lang['Category_config_error_fixed']			= 'An error in the category setup has been fixed';
	$lang['Attach_forum_wrong']						= 'You can\'t attach a forum to a forum';
	$lang['Attach_root_wrong']						= 'You can\'t attach a forum to the forum index';
	$lang['Forum_name_missing']						= 'You can\'t create a forum without a name';
	$lang['Category_name_missing']					= 'You can\'t create a category without a name';
	$lang['Only_forum_for_topics']					= 'Topics can only be found in forums';
	$lang['Delete_forum_with_attachment_denied']	= 'You can\'t delete forums having sub-levels';

	$lang['Category_delete']						= 'Delete Category';
	$lang['Category_delete_explain']				= 'The form below will allow you to delete a category and decide where you want to put all forums and categories it contained.';

	// forum links type
	$lang['Forum_link_url']							= 'Link URL';
	$lang['Forum_link_url_explain']					= 'You can set here an URI to a phpBB prog, or a full URL to an external server';
	$lang['Forum_link_internal']					= 'phpBB prog';
	$lang['Forum_link_internal_explain']			= 'Choose yes if you invoke a program that stands in the phpBB dirs';
	$lang['Forum_link_hit_count']					= 'Hit count';
	$lang['Forum_link_hit_count_explain']			= 'Choose yes if you want the board to count and display the number of hit using this link';
	$lang['Forum_link_with_attachment_deny']		= 'You can\'t set a forum as a link if it has already sub-levels';
	$lang['Forum_link_with_topics_deny']			= 'You can\'t set a forum as a link if it has already topics in';
	$lang['Forum_attached_to_link_denied']			= 'You can\'t attach a forum or a category to a forum link';

	$lang['Manage_extend']							= 'Management +';
	$lang['No_subforums']							= 'No sub-forums';
	$lang['Forum_type']								= 'Choose the kind of forum you want';
	$lang['Presets']								= 'Presets';
	$lang['Refresh']								= 'Refresh';
	$lang['Position_after']							= 'Position this forum after';
	$lang['Link_missing']							= 'The link is missing';
	$lang['Category_with_topics_deny']				= 'Topics remains in this forum. You can\'t change it into a category.';
	$lang['Recursive_attachment']					= 'You can\'t attach a forum to a lowest level of its own branch (recursive attachment)';
	$lang['Forum_with_attachment_denied']			= 'You can\'t change a category with forums attached to into a forum';
	$lang['icon']									= 'Icon';
	$lang['icon_explain']							= 'This icon will be displayed in front of the forum title. You can set here a direct URI or a $image[] key entry (see <i>your_template</i>/<i>your_template</i>.cfg).';
}

$lang['Category_locked'] 			= 'This category is locked: you cannot post, reply to, or edit topics.';
$lang['Forum_link']					= 'Link redirection';
$lang['Forum_link_visited']			= 'This link has been visited %d times';
$lang['Redirect']					= 'Redirect';
$lang['Redirect_to']				= 'If your browser does not support meta redirection please click %sHERE% to be redirected';

$lang['Use_sub_forum']				= 'Index packing';
$lang['Hierarchy_setting']			= 'Categories Hierarchy settings';
$lang['Index_packing_explain']		= 'Choose the level of packing you want for the index';
$lang['Medium']						= 'Medium';
$lang['Full']						= 'Full';
$lang['Split_categories']			= 'Split categories on index';
$lang['Use_last_topic_title']		= 'Show the last topic titles on index';
$lang['Last_topic_title_length']	= 'Title length of the last topic on index';
$lang['Sub_level_links']			= 'Sub-level links on index';
$lang['Sub_level_links_explain']	= 'Add the links to the sub-levels in the forum or category description';
$lang['With_pics']					= 'With icons';
$lang['Display_viewonline']			= 'Display viewonline information box on index';
$lang['Never']						= 'Never';
$lang['Root_index_only']			= 'On root index only';
$lang['Always']						= 'Always';
$lang['Subforums']					= 'Subforums';

//-- mod : today at   yesterday at ------------------------------------------------------------------------ 
//-- add 
$lang['Today_at'] = '<b>Today</b> at %s'; // %s is the time 
$lang['Future'] = '[ <b>Future</b> ]<br /> %s'; // %s is the time 
$lang['Yesterday_at'] = '<b>Yesterday</b> at %s'; // %s is the time 
//-- end mod : today at   yesterday at ------------------------------------------------------------------------ 

?>