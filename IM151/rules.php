<?php
/***************************************************************************
*                             rules.php
*                              -------------------
*     begin                : Mon Jul 31, 2001
*     copyright            : (C) 2003 Sko22
*     email                : sko22@quellicheilpc.com
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

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_RULES);
init_userprefs($userdata);
//
// End session management
//

//
// Update user rules view
//
$today = time();

$sql = "UPDATE ". USERS_TABLE ." SET user_rules=$today WHERE user_id=$userdata[user_id]";

if (!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not update user rules view', '', __LINE__, __FILE__, $sql);
	}

//
// Lets build a page ...
//
$page_title = $l_title;
include($phpbb_root_path . 'includes/page_header.'.$phpEx);

$template->set_filenames(array(
	'body' => 'rules.tpl')
);

//
// Get message of the rules.
//
$sql = "SELECT * FROM " . RULES_TABLE;

if( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not obtain the rules', '', __LINE__, __FILE__, $sql);
}

while( $row = $db->sql_fetchrow($result) )
{
	$rules = $row["rules"];
	$rules_date = create_date($lang['DATE_FORMAT'], $row['date'], $board_config['board_timezone']);
}

$template->assign_vars(array(
	'L_FORUM_RULES' => $lang['Forum_Rules'], 
	'RULES_DATA' => $rules,
	'RULES_DATE' => $rules_date
	)
);

$template->pparse('body');

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>