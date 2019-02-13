<?php
/***************************************************************************
 *                       lang_admin_users.php [English]
 *                            -------------------
 *   begin                : Saturday, July 10, 2004
 *   copyright            : (C) 2004 masterdavid - Ronald John David
 *   website              : http://www.integramod.com
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

$lang['Max_bookmarks_links'] = 'Maximum bookmarks sent in link-tag';
$lang['Max_bookmarks_links_explain'] = 'Number of bookmarks maximal send in link-tag at the beginning of the document. This information is e.g. used by Mozilla. Enter 0 to disable this function.';
$lang['Max_user_bancard'] = 'Maximum number of warnings';
$lang['Max_user_bancard_explain'] = 'If a user gets more yellow cards than this limit, the user will be banned'; 
// TODO remove blue cards (Advanced Report Hack handles that)
$lang['Bluecard_limit'] = 'Interval of bluecard'; 
$lang['Bluecard_limit_explain'] = 'Notify the moderators again for every x bluecards given to a post'; 
$lang['Bluecard_limit_2'] = 'Limit of bluecard'; 
$lang['Bluecard_limit_2_explain'] = 'First notification to moderators is sent, when a post get this amount of blue cards'; 
$lang['Report_forum']= 'Report forum';
$lang['Report_forum_explain'] = 'Fill with the forum ID where users reports are to be posted, a value of 0 will disable this feature, users MUST atleast have post/reply access to this forum';
// Start add - Fully integrated shoutbox MOD
$lang['Prune_shouts'] = 'Auto prune shouts'; 
$lang['Prune_shouts_explain'] = 'Number of days, before the shouts are deleted, if a value of 0 is submittd, autoprune will be disabled'; 
// End add - Fully integrated shoutbox MOD

?>