<?php
/****************************************************************
 *		lang_extend_last_topic_from.php [Nederlands]
 *		-------------------------------
 *	begin				: 28/09/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 1.0.0 - 19/10/2003
 * 
 *   Nederlandse vertaling  : Maart 2005 
 *   The Dutch Team         : http://www.integramod.nl 
 * 
 *   note: removing the original copyright is illegal even you 
 *         have modified the code. Just append yours if you
 *         have modified it. 
 ****************************************************************/ 

/****************************************************************
 *
 *   This program is free software; you can redistribute it and/or
 *   modify it under the terms of the GNU General Public License as
 *   published by the Free Software Foundation; either version 2
 *   of the License, or (at your option) any later version.
 *
 ****************************************************************/

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

// admin part
if ( $lang_extend_admin )
{
	$lang['Lang_extend_last_topics_from'] = 'Laatste onderwerpen van';
}

$lang['Topic_last']						= 'Laatste onderwerpen';
$lang['Topic_last_settings']			= 'Laatste onderwerpen van een gebruiker';
$lang['Topic_last_started']				= 'Laatste onderwerpen gestart door %s';
$lang['Topic_last_started_title']		= 'Laatste onderwerpen gestart door een gebruiker';
$lang['Topic_last_started_explain']		= 'Voer hier de nummer van de laatste onderwerpen gestart door de gebruiker, die je wilt tonen in het profiel. 0 wil zeggen dat je geen onderwerpen wil tonen.';
$lang['Topic_last_replied']				= 'Laatste onderwerpen waar %s reageerde op';
$lang['Topic_last_replied_title']		= 'Laatste onderwerpen waar een gebruiker reageerde op';
$lang['Topic_last_replied_explain']		= 'Voer hier het nummer in van de laatste onderwerpen waarop de gebruiker reageerde,  die je wilt tonen in het profiel. 0 wil zeggen dat je geen onderwerpen wil tonen.';
$lang['Topic_last_ended']				= 'Laatste onderwerpen die %s beëindigde';
$lang['Topic_last_ended_title']			= 'Laatste onderwerpen die gebruiker beëindigde';
$lang['Topic_last_ended_explain']		= 'Voer hier de nummer van de laatste onderwerpen waar de gebruiker de laatste reactie maakte, die je wilt tonen in het profiel. 0 wil zeggen dat je geen onderwerpen wil tonen.';
$lang['Topic_last_split']				= 'Splits de onderwerpen per type';
$lang['Topic_last_split_explain']		= 'Voeg een scheidingsrij toe in de boxen per onderwerpen type (mededelingen, onderwerpen, ...).';
$lang['Topic_last_forum']				= 'Forum';
$lang['Topic_last_forum_explain']		= 'Toon de forumtitel waar het onderwerp staat (onder de onderwerpen titel)';

?>