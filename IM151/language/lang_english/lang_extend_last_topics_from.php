<?php
/***************************************************************************
 *						lang_extend_last_topic_from.php [English]
 *						-------------------------------
 *	begin				: 28/09/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 1.0.0 - 19/10/2003
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
	$lang['Lang_extend_last_topics_from'] = 'Last topics from';
}

$lang['Topic_last']						= 'Last topics';
$lang['Topic_last_settings']			= 'Last topics from a user';
$lang['Topic_last_started']				= 'Last topics started by %s';
$lang['Topic_last_started_title']		= 'Last topics started by a user';
$lang['Topic_last_started_explain']		= 'Set here the number of the last topics the user started you want to display on profile view. 0 means no display.';
$lang['Topic_last_replied']				= 'Last topics %s replied to';
$lang['Topic_last_replied_title']		= 'Last topics a user replied to';
$lang['Topic_last_replied_explain']		= 'Set here the number of the last topics the user replied you want to display on profile view. 0 means no display.';
$lang['Topic_last_ended']				= 'Last topics %s ended';
$lang['Topic_last_ended_title']			= 'Last topics a user ended';
$lang['Topic_last_ended_explain']		= 'Set here the number of the last topics on which the user posted the last replied you want to display on profile view. 0 means no display.';
$lang['Topic_last_split']				= 'Split the topics per type';
$lang['Topic_last_split_explain']		= 'Add a separation row in the boxes per topics type (announcements, topics, and so).';
$lang['Topic_last_forum']				= 'Forum';
$lang['Topic_last_forum_explain']		= 'Display the forum title where the topic stands under the topic title';

?>