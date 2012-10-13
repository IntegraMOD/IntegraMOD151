<?php
/***************************************************************************
 *                               groupcp.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
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

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_GROUPCP);
init_userprefs($userdata);
//
// End session management
//

include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_groupcp.' . $phpEx);

$script_name = preg_replace('/^\/?(.*?)\/?$/', "\\1", trim($board_config['script_path']));
$script_name = ( $script_name != '' ) ? $script_name . '/groupcp.'.$phpEx : 'groupcp.'.$phpEx;
$server_name = trim($board_config['server_name']);
$server_protocol = ( $board_config['cookie_secure'] ) ? 'https://' : 'http://';
$server_port = ( $board_config['server_port'] <> 80 ) ? ':' . trim($board_config['server_port']) . '/' : '/';

$server_url = $server_protocol . $server_name . $server_port . $script_name;

if ( isset($HTTP_GET_VARS[POST_GROUPS_URL]) || isset($HTTP_POST_VARS[POST_GROUPS_URL]) )
{
	$group_id = ( isset($HTTP_POST_VARS[POST_GROUPS_URL]) ) ? intval($HTTP_POST_VARS[POST_GROUPS_URL]) : intval($HTTP_GET_VARS[POST_GROUPS_URL]);
}
else
{
	$group_id = '';
}

if ( isset($HTTP_POST_VARS['mode']) || isset($HTTP_GET_VARS['mode']) )
{
	$mode = ( isset($HTTP_POST_VARS['mode']) ) ? $HTTP_POST_VARS['mode'] : $HTTP_GET_VARS['mode'];
	$mode = htmlspecialchars($mode);
}
else
{
	$mode = '';
}

$confirm = ( isset($HTTP_POST_VARS['confirm']) ) ? TRUE : 0;
$cancel = ( isset($HTTP_POST_VARS['cancel']) ) ? TRUE : 0;

$sid = ( isset($HTTP_POST_VARS['sid']) ) ? $HTTP_POST_VARS['sid'] : '';

$start = ( isset($HTTP_GET_VARS['start']) ) ? intval($HTTP_GET_VARS['start']) : 0;
$start = ($start < 0) ? 0 : $start;

//
// Default var values
//
$is_moderator = FALSE;

if ( isset($HTTP_POST_VARS['groupstatus']) && $group_id )
{
	if ( !$userdata['session_logged_in'] )
	{
		redirect(append_sid("login.$phpEx?redirect=groupcp.$phpEx&" . POST_GROUPS_URL . "=$group_id", true));
	}

	$sql = "SELECT * FROM " . USER_GROUP_TABLE . " AS ug, " . GROUPS_TABLE . " AS g 
		WHERE (ug.user_id = g.group_moderator OR ug.group_moderator = 1) 
			AND g.group_id = $group_id AND ug.group_id = $group_id";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain user and group information', '', __LINE__, __FILE__, $sql);
	}
	$group_moderators = array();
	while ($row = $db->sql_fetchrow($result) )
	{
		$group_moderators[] = $row['user_id'];
	}
	if ( (empty($group_moderators) || !in_array($userdata['user_id'], $group_moderators)) && ($userdata['user_level'] != ADMIN) )
	{
		$template->assign_vars(array(
			'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid("index.$phpEx") . '">')
		);

		$message = $lang['Not_group_moderator'] . '<br /><br />' . sprintf($lang['Click_return_group'], '<a href="' . append_sid("groupcp.$phpEx?" . POST_GROUPS_URL . "=$group_id") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>');

		message_die(GENERAL_MESSAGE, $message);
	}

	$sql = "UPDATE " . GROUPS_TABLE . " 
		SET group_type = " . intval($HTTP_POST_VARS['group_type']) . "
		WHERE group_id = $group_id";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain user and group information', '', __LINE__, __FILE__, $sql);
	}

	$template->assign_vars(array(
		'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid("groupcp.$phpEx?" . POST_GROUPS_URL . "=$group_id") . '">')
	);

	$message = $lang['Group_type_updated'] . '<br /><br />' . sprintf($lang['Click_return_group'], '<a href="' . append_sid("groupcp.$phpEx?" . POST_GROUPS_URL . "=$group_id") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>');

	message_die(GENERAL_MESSAGE, $message);

}
else if ( isset($HTTP_POST_VARS['joingroup']) && $group_id )
{
	//
	// First, joining a group
	// If the user isn't logged in redirect them to login
	//
	if ( !$userdata['session_logged_in'] )
	{
		redirect(append_sid("login.$phpEx?redirect=groupcp.$phpEx&" . POST_GROUPS_URL . "=$group_id", true));
	}

	else if ( $sid !== $userdata['session_id'] )
	{
		message_die(GENERAL_ERROR, $lang['Session_invalid']);
	}

	$sql = "SELECT ug.user_id, g.group_type, group_count, group_count_max
		FROM " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g 
		WHERE g.group_id = $group_id 
			AND ( g.group_type <> " . GROUP_HIDDEN . " OR (g.group_count <= '".$userdata['user_posts']."' AND g.group_count_max > '".$userdata['user_posts']."')) 
			AND ug.group_id = g.group_id";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain user and group information', '', __LINE__, __FILE__, $sql);
	}

	if (	$row = $db->sql_fetchrow($result) )
{
$is_autogroup_enable = ($row['group_count'] <= $userdata['user_posts'] && $row['group_count_max'] > $userdata['user_posts']) ? true : false;
$grouptype = $row['group_type'];
if ( $row['group_type'] == GROUP_OPEN || $is_autogroup_enable || $grouptype == GROUP_AUTO )
		{
			do
			{
				if ( $userdata['user_id'] == $row['user_id'] )
				{
					$template->assign_vars(array(
						'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid("index.$phpEx") . '">')
					);

					$message = $lang['Already_member_group'] . '<br /><br />' . sprintf($lang['Click_return_group'], '<a href="' . append_sid("groupcp.$phpEx?" . POST_GROUPS_URL . "=$group_id") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>');

					message_die(GENERAL_MESSAGE, $message);
				}
			} while ( $row = $db->sql_fetchrow($result) );
		}
		else
		{
			$template->assign_vars(array(
				'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid("index.$phpEx") . '">')
			);

			$message = $lang['This_closed_group'] . '<br /><br />' . sprintf($lang['Click_return_group'], '<a href="' . append_sid("groupcp.$phpEx?" . POST_GROUPS_URL . "=$group_id") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>');

			message_die(GENERAL_MESSAGE, $message);
		}
	}
	else
	{
		message_die(GENERAL_MESSAGE, $lang['No_groups_exist']); 
	}

if ( $grouptype == GROUP_AUTO )
{
$sql = "INSERT INTO " . USER_GROUP_TABLE . " (group_id, user_id, user_pending) 
VALUES ($group_id, " . $userdata['user_id'] . ", 0)";
if ( !($result = $db->sql_query($sql)) )
{
message_die(GENERAL_ERROR, "Error inserting user group subscription", "", __LINE__, __FILE__, $sql);
}

$template->assign_vars(array(
'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid("index.$phpEx") . '">')
);

$message = $lang['Group_approved'] . '<br /><br />' . sprintf($lang['Click_return_group'], '<a href="' . append_sid("groupcp.$phpEx?" . POST_GROUPS_URL . "=$group_id") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>');

message_die(GENERAL_MESSAGE, $message);
}

	$sql = "INSERT INTO " . USER_GROUP_TABLE . " (group_id, user_id, user_pending) 
		VALUES ($group_id, " . $userdata['user_id'] . ",'".(($is_autogroup_enable)? 0 : 1)."')";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Error inserting user group subscription", "", __LINE__, __FILE__, $sql);
	}

	include($phpbb_root_path . 'includes/emailer.'.$phpEx);
	$sql = "SELECT u.user_email, u.username, u.user_lang, g.group_name 
		FROM ".USERS_TABLE . " u, " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g 
		WHERE ( u.user_id = g.group_moderator OR ug.group_moderator = 1 ) 
			AND g.group_id = $group_id AND u.user_id = ug.user_id AND ug.group_id = g.group_id";

	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Error getting group moderator data", "", __LINE__, __FILE__, $sql);
	}

	while ($moderator = $db->sql_fetchrow($result))
	{
	if (!$is_autogroup_enable)
	{
	$emailer = new emailer($board_config['smtp_delivery']);

	$emailer->from($board_config['board_email']);
	$emailer->replyto($board_config['board_email']);

	$emailer->use_template('group_request', $moderator['user_lang']);
	$emailer->email_address($moderator['user_email']);
	$emailer->set_subject($lang['Group_request']);

	$emailer->assign_vars(array( 
                'SITENAME' => $board_config['sitename'], 
                'SUBSCRIBEE' => $userdata['username'], 
                'GROUP_NAME' => $moderator['group_name'], 
                'GROUP_MODERATOR' => $moderator['username'], 
                'EMAIL_SIG' => (!empty($board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']) : '', 
                'U_GROUPCP' => $server_url . '?' . POST_GROUPS_URL . "=$group_id&validate=true") 
        );
	$emailer->send();
	$emailer->reset();
	}
	}

	$template->assign_vars(array(
		'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid("index.$phpEx") . '">')
	);

	$message = ($is_autogroup_enable) ? $lang['Group_added'] : $lang['Group_joined'] . '<br /><br />' . sprintf($lang['Click_return_group'], '<a href="' . append_sid("groupcp.$phpEx?" . POST_GROUPS_URL . "=$group_id") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>');

	message_die(GENERAL_MESSAGE, $message);
}
else if ( isset($HTTP_POST_VARS['unsub']) || isset($HTTP_POST_VARS['unsubpending']) && $group_id )
{
	//
	// Second, unsubscribing from a group
	// Check for confirmation of unsub.
	//
	if ( $cancel )
	{
		redirect(append_sid("groupcp.$phpEx", true));
	}
	else if ( !$userdata['session_logged_in'] )
	{
		redirect(append_sid("login.$phpEx?redirect=groupcp.$phpEx&" . POST_GROUPS_URL . "=$group_id", true));
	}
	else if ( $sid !== $userdata['session_id'] )
	{
		message_die(GENERAL_ERROR, $lang['Session_invalid']);
	}

	if ( $confirm )
	{
		$sql = "DELETE FROM " . USER_GROUP_TABLE . " 
			WHERE user_id = " . $userdata['user_id'] . " 
				AND group_id = $group_id";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not delete group memebership data', '', __LINE__, __FILE__, $sql);
		}

		if ( $userdata['user_level'] != ADMIN && $userdata['user_level'] == MOD )
		{
			$sql = "SELECT COUNT(auth_mod) AS is_auth_mod 
				FROM " . AUTH_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug 
				WHERE ug.user_id = " . $userdata['user_id'] . " 
					AND aa.group_id = ug.group_id 
					AND aa.auth_mod = 1";
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not obtain moderator status', '', __LINE__, __FILE__, $sql);
			}

			if ( !($row = $db->sql_fetchrow($result)) || $row['is_auth_mod'] == 0 )
			{
				$sql = "UPDATE " . USERS_TABLE . " 
					SET user_level = " . USER . " 
					WHERE user_id = " . $userdata['user_id'];
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Could not update user level', '', __LINE__, __FILE__, $sql);
				}
			}
		}

		$template->assign_vars(array(
			'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid("index.$phpEx") . '">')
		);

		$message = $lang['Unsub_success'] . '<br /><br />' . sprintf($lang['Click_return_group'], '<a href="' . append_sid("groupcp.$phpEx?" . POST_GROUPS_URL . "=$group_id") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>');

		message_die(GENERAL_MESSAGE, $message);
	}
	else
	{
		$unsub_msg = ( isset($HTTP_POST_VARS['unsub']) ) ? $lang['Confirm_unsub'] : $lang['Confirm_unsub_pending'];

		$s_hidden_fields = '<input type="hidden" name="' . POST_GROUPS_URL . '" value="' . $group_id . '" /><input type="hidden" name="unsub" value="1" />';
		$s_hidden_fields .= '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';

		$page_title = $lang['Group_Control_Panel'];
		include($phpbb_root_path . 'includes/page_header.'.$phpEx);

		$template->set_filenames(array(
			'confirm' => 'confirm_body.tpl')
		);

		$template->assign_vars(array(
			'MESSAGE_TITLE' => $lang['Confirm'],
			'MESSAGE_TEXT' => $unsub_msg,
			'L_YES' => $lang['Yes'],
			'L_NO' => $lang['No'],
			'S_CONFIRM_ACTION' => append_sid("groupcp.$phpEx"),
			'S_HIDDEN_FIELDS' => $s_hidden_fields)
		);

		$template->pparse('confirm');

		include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
	}

}
else if ( $group_id )
{
	//
	// Did the group moderator get here through an email?
	// If so, check to see if they are logged in.
	//
	if ( isset($HTTP_GET_VARS['validate']) )
	{
		if ( !$userdata['session_logged_in'] )
		{
			redirect(append_sid("login.$phpEx?redirect=groupcp.$phpEx&" . POST_GROUPS_URL . "=$group_id", true));
		}
	}

	//
	// For security, get the ID of the group moderator.
	//
	switch(SQL_LAYER)
	{
		case 'postgresql':
			$sql = "SELECT g.group_moderator, g.group_type, aa.auth_mod 
				FROM " . GROUPS_TABLE . " g, " . AUTH_ACCESS_TABLE . " aa 
				WHERE g.group_id = $group_id
					AND aa.group_id = g.group_id 
					UNION (
						SELECT g.group_moderator, g.group_type, NULL 
						FROM " . GROUPS_TABLE . " g
						WHERE g.group_id = $group_id
							AND NOT EXISTS (
							SELECT aa.group_id 
							FROM " . AUTH_ACCESS_TABLE . " aa 
							WHERE aa.group_id = g.group_id  
						)
					)
				ORDER BY auth_mod DESC";
			break;

		case 'oracle':
			$sql = "SELECT g.group_moderator, g.group_type, aa.auth_mod 
				FROM " . GROUPS_TABLE . " g, " . AUTH_ACCESS_TABLE . " aa 
				WHERE g.group_id = $group_id
					AND aa.group_id (+) = g.group_id
				ORDER BY aa.auth_mod DESC";
			break;

		default:
			$sql = "SELECT g.group_moderator, g.group_type, aa.auth_mod 
				FROM ( " . GROUPS_TABLE . " g 
				LEFT JOIN " . AUTH_ACCESS_TABLE . " aa ON aa.group_id = g.group_id )
				WHERE g.group_id = $group_id
				ORDER BY aa.auth_mod DESC";
			break;
	}
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not get moderator information', '', __LINE__, __FILE__, $sql);
	}

	if ( $group_info = $db->sql_fetchrow($result) )
	{
		$sql = "SELECT * FROM " . USER_GROUP_TABLE . " AS ug, " . GROUPS_TABLE . " AS g 
			WHERE (ug.user_id = g.group_moderator OR ug.group_moderator = 1) 
				AND g.group_id = $group_id AND ug.group_id = $group_id";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain user and group information', '', __LINE__, __FILE__, $sql);
		}
		$group_moderators = array();
		while ($row = $db->sql_fetchrow($result) )
		{
			$group_moderators[] = $row['user_id'];
		}

		if ( (!empty($group_moderators) && in_array($userdata['user_id'], $group_moderators)) || ($userdata['user_level'] == ADMIN) )
		{
			$is_moderator = TRUE;
		}
			
		//
		// Handle Additions, removals, approvals and denials
		//
		if ( !empty($HTTP_POST_VARS['add']) || !empty($HTTP_POST_VARS['remove']) || isset($HTTP_POST_VARS['approve']) || isset($HTTP_POST_VARS['deny']) || isset($HTTP_POST_VARS['grant_ungrant']) )
		{
			if ( !$userdata['session_logged_in'] )
			{
				redirect(append_sid("login.$phpEx?redirect=groupcp.$phpEx&" . POST_GROUPS_URL . "=$group_id", true));

			} 
			else if ( $sid !== $userdata['session_id'] )
			{
				message_die(GENERAL_ERROR, $lang['Session_invalid']);
			}

			if ( !$is_moderator )
			{
				$template->assign_vars(array(
					'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid("index.$phpEx") . '">')
				);

				$message = $lang['Not_group_moderator'] . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>');

				message_die(GENERAL_MESSAGE, $message);
			}

			if ( isset($HTTP_POST_VARS['grant_ungrant']) )
			{
				$members = $HTTP_POST_VARS['members'];
				if (count($members) > 0)
				{
					$s_members = implode( ', ', $members);
					$group_owner = $group_info['group_moderator'];
					$sql = "select * from " . USER_GROUP_TABLE . " where group_id = $group_id and user_id in ($s_members) and user_id <> $group_owner and group_moderator = 1";
					if ( !($result = $db->sql_query($sql)) ) message_die(GENERAL_ERROR, 'Could not get user/group information', '', __LINE__, __FILE__, $sql);
					while ( $row = $db->sql_fetchrow($result) ) $moderators[] = $row['user_id'];
					$s_mod = (count($moderators) > 0) ? implode( ', ', $moderators) : '';
					if ($s_mod != '')
					{
						$sql = "update " . USER_GROUP_TABLE . " set group_moderator = 0 where group_id = $group_id and user_id <> $group_owner and user_id in ($s_mod)";
						if ( !($result = $db->sql_query($sql)) ) message_die(GENERAL_ERROR, 'Could not ungrant user/group mod status', '', __LINE__, __FILE__, $sql);
					}
					$sql = "update " . USER_GROUP_TABLE . " set group_moderator = 1 where group_id = $group_id and user_id <> $group_owner and user_id in ($s_members)";
					if ($s_mod != '') $sql .= " and user_id not in ($s_mod)";
					if ( !($result = $db->sql_query($sql)) ) message_die(GENERAL_ERROR, 'Could not ungrant user/group mod status', '', __LINE__, __FILE__, $sql);

					$template->assign_vars(array(
						'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid("groupcp.$phpEx?" . POST_GROUPS_URL . "=$group_id") . '">')
					);

					$message = $lang['Group_grant_ungrant_mod_ok'] . '<br /><br />' . sprintf($lang['Click_return_group'], '<a href="' . append_sid("groupcp.$phpEx?" . POST_GROUPS_URL . "=$group_id") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>');

					message_die(GENERAL_MESSAGE, $message);
				}
			}
			else if ( isset($HTTP_POST_VARS['add']) )
			{
				$username = ( isset($HTTP_POST_VARS['username']) ) ? phpbb_clean_username($HTTP_POST_VARS['username']) : '';
				
				$sql = "SELECT user_id, user_email, user_lang, user_level  
					FROM " . USERS_TABLE . " 
					WHERE username = '" . str_replace("\'", "''", $username) . "'";
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, "Could not get user information", $lang['Error'], __LINE__, __FILE__, $sql);
				}

				if ( !($row = $db->sql_fetchrow($result)) )
				{
					$template->assign_vars(array(
						'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid("groupcp.$phpEx?" . POST_GROUPS_URL . "=$group_id") . '">')
					);

					$message = $lang['Could_not_add_user'] . "<br /><br />" . sprintf($lang['Click_return_group'], "<a href=\"" . append_sid("groupcp.$phpEx?" . POST_GROUPS_URL . "=$group_id") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_index'], "<a href=\"" . append_sid("index.$phpEx") . "\">", "</a>");

					message_die(GENERAL_MESSAGE, $message);
				}

				if ( $row['user_id'] == ANONYMOUS )
				{
					$template->assign_vars(array(
						'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid("groupcp.$phpEx?" . POST_GROUPS_URL . "=$group_id") . '">')
					);

					$message = $lang['Could_not_anon_user'] . '<br /><br />' . sprintf($lang['Click_return_group'], '<a href="' . append_sid("groupcp.$phpEx?" . POST_GROUPS_URL . "=$group_id") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>');

					message_die(GENERAL_MESSAGE, $message);
				}
				
				$sql = "SELECT ug.user_id, u.user_level 
					FROM " . USER_GROUP_TABLE . " ug, " . USERS_TABLE . " u 
					WHERE u.user_id = " . $row['user_id'] . " 
						AND ug.user_id = u.user_id 
						AND ug.group_id = $group_id";
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Could not get user information', '', __LINE__, __FILE__, $sql);
				}

				if ( !($db->sql_fetchrow($result)) )
				{
					$sql = "INSERT INTO " . USER_GROUP_TABLE . " (user_id, group_id, user_pending) 
						VALUES (" . $row['user_id'] . ", $group_id, 0)";
					if ( !$db->sql_query($sql) )
					{
						message_die(GENERAL_ERROR, 'Could not add user to group', '', __LINE__, __FILE__, $sql);
					}
					
					if ( $row['user_level'] != ADMIN && $row['user_level'] != MOD && $group_info['auth_mod'] )
					{
						$sql = "UPDATE " . USERS_TABLE . " 
							SET user_level = " . MOD . " 
							WHERE user_id = " . $row['user_id'];
						if ( !$db->sql_query($sql) )
						{
							message_die(GENERAL_ERROR, 'Could not update user level', '', __LINE__, __FILE__, $sql);
						}
					}

					//
					// Get the group name
					// Email the user and tell them they're in the group
					//
					$group_sql = "SELECT group_name 
						FROM " . GROUPS_TABLE . " 
						WHERE group_id = $group_id";
					if ( !($result = $db->sql_query($group_sql)) )
					{
						message_die(GENERAL_ERROR, 'Could not get group information', '', __LINE__, __FILE__, $group_sql);
					}

					$group_name_row = $db->sql_fetchrow($result);

					$group_name = $group_name_row['group_name'];

					include($phpbb_root_path . 'includes/emailer.'.$phpEx);
					$emailer = new emailer($board_config['smtp_delivery']);

					$emailer->from($board_config['board_email']);
					$emailer->replyto($board_config['board_email']);

					$emailer->use_template('group_added', $row['user_lang']);
					$emailer->email_address($row['user_email']);
					$emailer->set_subject($lang['Group_added']);

					$emailer->assign_vars(array(
						'SITENAME' => $board_config['sitename'], 
						'GROUP_NAME' => $group_name,
						'EMAIL_SIG' => (!empty($board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']) : '', 

						'U_GROUPCP' => $server_url . '?' . POST_GROUPS_URL . "=$group_id")
					);
					$emailer->send();
					$emailer->reset();
				}
				else
				{
					$template->assign_vars(array(
						'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid("groupcp.$phpEx?" . POST_GROUPS_URL . "=$group_id") . '">')
					);

					$message = $lang['User_is_member_group'] . '<br /><br />' . sprintf($lang['Click_return_group'], '<a href="' . append_sid("groupcp.$phpEx?" . POST_GROUPS_URL . "=$group_id") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>');

					message_die(GENERAL_MESSAGE, $message);
				}
			}
			else 
			{
				if ( ( ( isset($HTTP_POST_VARS['approve']) || isset($HTTP_POST_VARS['deny']) ) && isset($HTTP_POST_VARS['pending_members']) ) || ( isset($HTTP_POST_VARS['remove']) && isset($HTTP_POST_VARS['members']) ) )
				{

					$members = ( isset($HTTP_POST_VARS['approve']) || isset($HTTP_POST_VARS['deny']) ) ? $HTTP_POST_VARS['pending_members'] : $HTTP_POST_VARS['members'];

					$sql_in = '';
					for($i = 0; $i < count($members); $i++)
					{
						$sql_in .= ( ( $sql_in != '' ) ? ', ' : '' ) . intval($members[$i]);
					}

					if ( isset($HTTP_POST_VARS['approve']) )
					{
						if ( $group_info['auth_mod'] )
						{
							$sql = "UPDATE " . USERS_TABLE . " 
								SET user_level = " . MOD . " 
								WHERE user_id IN ($sql_in) 
									AND user_level NOT IN (" . MOD . ", " . ADMIN . ")";
							if ( !$db->sql_query($sql) )
							{
								message_die(GENERAL_ERROR, 'Could not update user level', '', __LINE__, __FILE__, $sql);
							}
						}

						$sql = "UPDATE " . USER_GROUP_TABLE . " 
							SET user_pending = 0 
							WHERE user_id IN ($sql_in) 
								AND group_id = $group_id";
						$sql_select = "SELECT user_email 
							FROM ". USERS_TABLE . " 
							WHERE user_id IN ($sql_in)"; 
					}
					else if ( isset($HTTP_POST_VARS['deny']) || isset($HTTP_POST_VARS['remove']) )
					{
						if ( $group_info['auth_mod'] )
						{
							$sql = "SELECT ug.user_id, ug.group_id 
								FROM " . AUTH_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug 
								WHERE ug.user_id IN  ($sql_in) 
									AND aa.group_id = ug.group_id 
									AND aa.auth_mod = 1 
								GROUP BY ug.user_id, ug.group_id 
								ORDER BY ug.user_id, ug.group_id";
							if ( !($result = $db->sql_query($sql)) )
							{
								message_die(GENERAL_ERROR, 'Could not obtain moderator status', '', __LINE__, __FILE__, $sql);
							}

							if ( $row = $db->sql_fetchrow($result) )
							{
								$group_check = array();
								$remove_mod_sql = '';

								do
								{
									$group_check[$row['user_id']][] = $row['group_id'];
								}
								while ( $row = $db->sql_fetchrow($result) );

								while( list($user_id, $group_list) = @each($group_check) )
								{
									if ( count($group_list) == 1 )
									{
										$remove_mod_sql .= ( ( $remove_mod_sql != '' ) ? ', ' : '' ) . $user_id;
									}
								}

								if ( $remove_mod_sql != '' )
								{
									$sql = "UPDATE " . USERS_TABLE . " 
										SET user_level = " . USER . " 
										WHERE user_id IN ($remove_mod_sql) 
											AND user_level NOT IN (" . ADMIN . ")";
									if ( !$db->sql_query($sql) )
									{
										message_die(GENERAL_ERROR, 'Could not update user level', '', __LINE__, __FILE__, $sql);
									}
								}
							}
						}

						$sql = "DELETE FROM " . USER_GROUP_TABLE . " 
							WHERE user_id IN ($sql_in) 
								AND group_id = $group_id";
					}

					if ( !$db->sql_query($sql) )
					{
						message_die(GENERAL_ERROR, 'Could not update user group table', '', __LINE__, __FILE__, $sql);
					}

					//
					// MOD Group Extra e-mails
					//
					if ( isset($HTTP_POST_VARS['deny']) || isset($HTTP_POST_VARS['remove']) )
					{
						$sql_select = "SELECT user_email 
							FROM ". USERS_TABLE . " 
							WHERE user_id IN ($sql_in)";
                                        if ( !($result = $db->sql_query($sql_select)) )
						{
							message_die(GENERAL_ERROR, 'Could not get user email information', '', __LINE__, __FILE__, $sql);
						}

						$bcc_list = array();
						while ($row = $db->sql_fetchrow($result))
						{
							$bcc_list[] = $row['user_email'];
						}
						$group_sql2 = "SELECT * 
							FROM " . GROUPS_TABLE . " 
							WHERE group_id = $group_id";
						if ( !($result = $db->sql_query($group_sql2)) )
						{
							message_die(GENERAL_ERROR, 'Could not get group information', '', __LINE__, __FILE__, $group_sql2);
						}

						$group_name_row = $db->sql_fetchrow($result);
						$group_name = $group_name_row['group_name'];
                                                $group_id_moderator = $group_name_row['group_moderator'];

						$group_sql3 = "SELECT * 
							FROM " . USERS_TABLE . " 
							WHERE user_id = $group_id_moderator";
                                               	if ( !($result = $db->sql_query($group_sql3)) )
						{
							message_die(GENERAL_ERROR, 'Could not get group moderator information', '', __LINE__, __FILE__, $group_modo_sql);
						}

                                                $group_moderator_name_row = $db->sql_fetchrow($result);
                                                $group_moderator_name = $group_moderator_name_row['username'];



						include($phpbb_root_path . 'includes/emailer.'.$phpEx);
						$emailer = new emailer($board_config['smtp_delivery']);
                                                $email_headers = 'From: ' . $board_config['board_email'] . "\nReturn-Path: " . $board_config['board_email'] . "\n";

						$emailer->from($board_config['board_email']);
						$emailer->replyto($board_config['board_email']);
                                                $emailer->extra_headers($email_headers);

						for ($i = 0; $i < count($bcc_list); $i++)
						{
							$emailer->bcc($bcc_list[$i]);
						}
					        if ( isset($HTTP_POST_VARS['deny']) )
					        {
						$emailer->use_template('group_denied');
						$emailer->set_subject($lang['Group_deny']);
                                                }
                                                else 
					        {
						$emailer->use_template('group_removed');
						$emailer->set_subject($lang['Group_removed']);
                                                }

						$emailer->assign_vars(array(
							'SITENAME' => $board_config['sitename'], 
							'GROUP_NAME' => $group_name,
							'EMAIL_SIG' => (!empty($board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']) : '', 
                                                        'GROUP_MODERATOR_NAME' => $group_moderator_name,
							'U_GROUPCP' => $server_url . '?' . POST_GROUPS_URL . "=$group_id")
						);
						$emailer->send();
						$emailer->reset();
					
                                               }
					//
					// Email users when they are approved
					//
					else if ( isset($HTTP_POST_VARS['approve']) )
					{
                                        if ( !($result = $db->sql_query($sql_select)) )
						{
							message_die(GENERAL_ERROR, 'Could not get user email information', '', __LINE__, __FILE__, $sql);
						}

						$bcc_list = array();
						while ($row = $db->sql_fetchrow($result))
						{
							$bcc_list[] = $row['user_email'];
						}

						//
						// Get the group name
						//
						$group_sql = "SELECT group_name 
							FROM " . GROUPS_TABLE . " 
							WHERE group_id = $group_id";
						if ( !($result = $db->sql_query($group_sql)) )
						{
							message_die(GENERAL_ERROR, 'Could not get group information', '', __LINE__, __FILE__, $group_sql);
						}

						$group_name_row = $db->sql_fetchrow($result);
						$group_name = $group_name_row['group_name'];

						include($phpbb_root_path . 'includes/emailer.'.$phpEx);
						$emailer = new emailer($board_config['smtp_delivery']);

						$emailer->from($board_config['board_email']);
						$emailer->replyto($board_config['board_email']);

						for ($i = 0; $i < count($bcc_list); $i++)
						{
							$emailer->bcc($bcc_list[$i]);
						}

						$emailer->use_template('group_approved');
						$emailer->set_subject($lang['Group_approved']);

						$emailer->assign_vars(array(
							'SITENAME' => $board_config['sitename'], 
							'GROUP_NAME' => $group_name,
							'EMAIL_SIG' => (!empty($board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']) : '', 

							'U_GROUPCP' => $server_url . '?' . POST_GROUPS_URL . "=$group_id")
						);
						$emailer->send();
						$emailer->reset();
					}
				}
			}
		}
		//
		// END approve or deny
		//
	}
	else
	{
		message_die(GENERAL_MESSAGE, $lang['No_groups_exist']);
	}

	//
	// Get group details
	//
	$sql = "SELECT *
		FROM " . GROUPS_TABLE . "
		WHERE group_id = $group_id
			AND group_single_user = 0";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Error getting group information', '', __LINE__, __FILE__, $sql);
	}

	if ( !($group_info = $db->sql_fetchrow($result)) )
	{
		message_die(GENERAL_MESSAGE, $lang['Group_not_exist']); 
	}

	//
	// Get moderator details for this group
	//
	$sql = "SELECT * FROM " . USERS_TABLE . " 
		WHERE user_id = " . $group_info['group_moderator'];
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Error getting user list for group', '', __LINE__, __FILE__, $sql);
	}

	$group_moderator = $db->sql_fetchrow($result); 

	//
	// Get user information for this group
	//
	// group owner
	$sql = "SELECT u.*, ug.user_pending, ug.group_moderator 
		FROM " . USERS_TABLE . " u, " . USER_GROUP_TABLE . " ug
		WHERE ug.group_id = $group_id
			AND u.user_id = ug.user_id
			AND ug.user_pending = 0 
			AND ug.user_id <> " . $group_moderator['user_id'] . " 
		ORDER BY ug.group_moderator DESC, u.username"; 
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Error getting user list for group', '', __LINE__, __FILE__, $sql);
	}

	$group_members = $db->sql_fetchrowset($result); 
	$members_count = count($group_members);
	$db->sql_freeresult($result);

	$sql = "SELECT u.*
		FROM " . GROUPS_TABLE . " g, " . USER_GROUP_TABLE . " ug, " . USERS_TABLE . " u
		WHERE ug.group_id = $group_id
			AND g.group_id = ug.group_id
			AND ug.user_pending = 1
			AND u.user_id = ug.user_id
		ORDER BY u.username"; 
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Error getting user pending information', '', __LINE__, __FILE__, $sql);
	}

	$modgroup_pending_list = $db->sql_fetchrowset($result);
	$modgroup_pending_count = count($modgroup_pending_list);
	$db->sql_freeresult($result);

	$is_group_member = 0;
	if ( $members_count )
	{
		for($i = 0; $i < $members_count; $i++)
		{
			if ( $group_members[$i]['user_id'] == $userdata['user_id'] && $userdata['session_logged_in'] )
			{
				$is_group_member = TRUE; 
			}
		}
	}

	$is_group_pending_member = 0;
$is_autogroup_enable = ($group_info['group_count'] <= $userdata['user_posts'] && $group_info['group_count_max'] > $userdata['user_posts']) ? true : false;
if ( $modgroup_pending_count )
	{
		for($i = 0; $i < $modgroup_pending_count; $i++)
		{
			if ( $modgroup_pending_list[$i]['user_id'] == $userdata['user_id'] && $userdata['session_logged_in'] )
			{
				$is_group_pending_member = TRUE;
			}
		}
	}
	require($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_ipn_grp.' . $phpEx);
	if ( $userdata['user_level'] == ADMIN )
	{
		$is_moderator = TRUE;
	}

	if ( $userdata['user_id'] == $group_info['group_moderator'] )
	{
		$is_moderator = TRUE;

		$group_details =  $lang['Are_group_moderator'];

		$s_hidden_fields = '<input type="hidden" name="' . POST_GROUPS_URL . '" value="' . $group_id . '" />';
	}
	else if ( $is_group_member || $is_group_pending_member )
	{
		$template->assign_block_vars('switch_unsubscribe_group_input', array());

		$group_details =  ( $is_group_pending_member ) ? $lang['Pending_this_group'] : $lang['Member_this_group'];

		$s_hidden_fields = '<input type="hidden" name="' . POST_GROUPS_URL . '" value="' . $group_id . '" />';
	}
	else if ( $userdata['user_id'] == ANONYMOUS )
	{
		$group_details =  $lang['Login_to_join'];
		$s_hidden_fields = '';
	}
	else
	{
		if ( $group_info['group_type'] == GROUP_OPEN )
		{
			$template->assign_block_vars('switch_subscribe_group_input', array());

			$group_details =  $lang['This_open_group'];
			$s_hidden_fields = '<input type="hidden" name="' . POST_GROUPS_URL . '" value="' . $group_id . '" />';
		}
		else if ( $group_info['group_type'] == GROUP_CLOSED )
		{
			if ($is_autogroup_enable) 
			{
				$template->assign_block_vars('switch_subscribe_group_input', array());
				$group_details =  sprintf ($lang['This_closed_group'],$lang['Join_auto']);
				$s_hidden_fields = '<input type="hidden" name="' . POST_GROUPS_URL . '" value="' . $group_id . '" />';
			} else
			{
				$group_details =  sprintf ($lang['This_closed_group'],$lang['No_more']);
				$s_hidden_fields = '';
			}
		}
		else if ( $group_info['group_type'] == GROUP_AUTO )
		{
		$template->assign_block_vars('switch_subscribe_group_input', array());
		
		$group_details =  $lang['This_auto_group'];
		$s_hidden_fields = '<input type="hidden" name="' . POST_GROUPS_URL . '" value="' . $group_id . '" />';
		}
		else if ( $group_info['group_type'] == GROUP_HIDDEN )
		{
			if ($is_autogroup_enable) 
			{
				$template->assign_block_vars('switch_subscribe_group_input', array());
				$group_details =  sprintf ($lang['This_hidden_group'],$lang['Join_auto']);
				$s_hidden_fields = '<input type="hidden" name="' . POST_GROUPS_URL . '" value="' . $group_id . '" />';
			}
		else if ( $group_info['group_type'] == GROUP_PAYMENT )
		{
			$template->assign_block_vars('switch_subscribe_group_input', array());
			$group_details =  sprintf ($lang['L_IPN_Subscribe_Payment_grp']);
			$s_hidden_fields = '';			
		} else
			{
				$group_details =  sprintf ($lang['This_closed_group'],$lang['No_add_allowed']);
				$s_hidden_fields = '';
			}
		}
	}

	$page_title = $lang['Group_Control_Panel'];
	include($phpbb_root_path . 'includes/page_header.'.$phpEx);

	//
	// Load templates
	//
	$template->set_filenames(array(
		'info' => 'groupcp_info_body.tpl')
	);
	make_jumpbox('viewforum.'.$phpEx);
	
	//
	// Add the moderator
	//
	$username = $group_moderator['username'];
	$user_id = $group_moderator['user_id'];
	
	// set the column names and the moderator!
	@reset($user_maps['PHPBB.groupcp']['fields']);
	$rowcount = count($user_maps['PHPBB.groupcp']['fields'])+1;
	$width = 100/$rowcount;
	$width .= '%';
	preProcessUserConfig($group_moderator);
	while (list($field_name, $field_data) = @each($user_maps['PHPBB.groupcp']['fields']) )
	{
		$leg = pcp_output($field_name, $group_moderator, 'PHPBB.groupcp' ,true);
		$val = pcp_output($field_name, $group_moderator, 'PHPBB.groupcp');
		$template->assign_block_vars('headers', array(
					'L_HEADER' => $leg,
					)
				);
		$template->assign_block_vars('mod', array(
					'FIELD' => $val,
					'CLASS' => $theme['td_class1'],
					'WIDTH' => $width,
					)
				);	
	}
	
	$s_hidden_fields .= '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';
	$unsubscribegroup = '<input class="mainoption" type="submit" name="unsub" value="' . $lang['Unsubscribe'] . '" />';
	$joingroup = '<input class="mainoption" type="submit" name="joingroup" value="' . $lang['Join_group'] . '" />';
	if($group_info['group_type'] == GROUP_PAYMENT)
	{
		//get payment account, use business account first, if not exist, then choose personal account
		$paypalaccount = lw_grap_sys_paypal_acct();
		if(strlen($paypalaccount) <= 0)
		{
			message_die(GENERAL_ERROR, $lang['LW_PAYPAL_ACCT_ERROR']);
			exit;			
		}
		$unsubscribegroup = sprintf($lang['L_IPN_Subscribe_cancel_paypal'], str_replace('@', '%40', $paypalaccount));
		$joingroup = sprintf($lang['L_IPN_Subscribe_this_grp'], "<a href=" . append_sid("lwtopup.$phpEx?group_id=" . $group_info['group_id']) . ">", "</a>"); 
	}
	$template->assign_vars(array(
		'ROWCOUNT' => $rowcount,
		'L_GROUP_OWNER' => $lang['Group_owner'],
		'L_GRANT_UNGRANT_SELECTED' => $lang['Group_grant_mod_status'],
		'L_GROUP_INFORMATION' => $lang['Group_Information'],
		'L_GROUP_NAME' => $lang['Group_name'],
		'L_GROUP_DESC' => $lang['Group_description'],
		'L_GROUP_TYPE' => $lang['Group_type'],
		'L_GROUP_MEMBERSHIP' => $lang['Group_membership'],
		'L_SUBSCRIBE' => $lang['Subscribe'],
		'L_UNSUBSCRIBE' => $lang['Unsubscribe'],
		'L_JOIN_GROUP' => $joingroup, 
		'L_UNSUBSCRIBE_GROUP' => $unsubscribegroup, 
		'L_GROUP_OPEN' => $lang['Group_open'],
		'L_GROUP_CLOSED' => $lang['Group_closed'],
		'L_GROUP_HIDDEN' => $lang['Group_hidden'], 
		'L_UPDATE' => $lang['Update'], 
		'L_GROUP_MODERATOR' => $lang['Group_Moderator'], 
		'L_GROUP_MEMBERS' => $lang['Group_Members'], 
		'L_PENDING_MEMBERS' => $lang['Pending_members'], 
		'L_SELECT_SORT_METHOD' => $lang['Select_sort_method'], 
		
		'L_SELECT' => $lang['Select'],
		'L_REMOVE_SELECTED' => $lang['Remove_selected'],
		'L_ADD_MEMBER' => $lang['Add_member'],
		'L_FIND_USERNAME' => $lang['Find_username'],
		'L_USER' => $lang['User'],
		
		'GROUP_NAME' => $group_info['group_name'],
		'GROUP_DESC' => $group_info['group_description'],
		'GROUP_DETAILS' => $group_details,
		'MOD_ROW_CLASS' => $theme['td_class1'],
		'MOD_PANEL' => $panel,

		'U_SEARCH_USER' => append_sid("search.$phpEx?mode=searchuser"), 

		'S_GROUP_OPEN_TYPE' => GROUP_OPEN,
		'S_GROUP_AUTO_TYPE' => GROUP_AUTO,
		'S_GROUP_PAYMENT_TYPE' => GROUP_PAYMENT,
		'S_GROUP_AUTO_CHECKED' => ( $group_info['group_type'] == GROUP_AUTO ) ? ' checked="checked"' : '',
		'L_GROUP_AUTO' => $lang['Group_auto'],
		'S_GROUP_CLOSED_TYPE' => GROUP_CLOSED,
		'S_GROUP_HIDDEN_TYPE' => GROUP_HIDDEN,
		'S_GROUP_OPEN_CHECKED' => ( $group_info['group_type'] == GROUP_OPEN ) ? ' checked="checked"' : '',
		'S_GROUP_CLOSED_CHECKED' => ( $group_info['group_type'] == GROUP_CLOSED ) ? ' checked="checked"' : '',
		'S_GROUP_HIDDEN_CHECKED' => ( $group_info['group_type'] == GROUP_HIDDEN ) ? ' checked="checked"' : '',
		'S_GROUP_PAYMENT_CHECKED' => ( $group_info['group_type'] == GROUP_PAYMENT ) ? ' checked="checked"' : '',
		'S_HIDDEN_FIELDS' => $s_hidden_fields, 
		'S_GROUPCP_ACTION' => append_sid("groupcp.$phpEx?" . POST_GROUPS_URL . "=$group_id"))
	);

	//
	// Dump out the remaining users
	//
	$last_member_type = -1;
	$color = false;
	for($i = $start; $i < min($board_config['topics_per_page'] + $start, $members_count); $i++)
	{
		$username = $group_members[$i]['username'];
		$user_id = $group_members[$i]['user_id'];
		if ( $group_info['group_type'] != GROUP_HIDDEN || $is_group_member || $is_moderator )
		{
			if ($last_member_type != $group_members[$i]['group_moderator'] )
			{
				$template->assign_block_vars('member_type', array(
					'L_TYPE' => ( $group_members[$i]['group_moderator'] ) ? $lang['Group_Moderator'] : $lang['Group_Members'],
					)
				);
				$color = false;
			}
			$last_member_type = $group_members[$i]['group_moderator'];
			$color = !$color;
			$row_class = ( $color ) ? $theme['td_class1'] : $theme['td_class2'];
			
			// set the row class 
			$template->assign_block_vars('member_type.member_row', array(
				'ROW_CLASS' => $row_class,
				'USER_ID' => $user_id, 
				)
			);
			
			@reset($user_maps['PHPBB.groupcp']['fields']);
			preProcessUserConfig($group_members[$i]);
			while (list($field_name, $field_data) = @each($user_maps['PHPBB.groupcp']['fields']) )
			{
				$val = pcp_output($field_name, $group_members[$i], 'PHPBB.groupcp');
				if(!$val){
					$val = "&nbsp;";
				}
				$template->assign_block_vars('member_type.member_row.member_fields', array(
							'FIELD' => $val,
							'WIDTH' => $width,
							)
						);	
			}
			
			if ($is_moderator)
			{
				if ( !$group_members[$i]['group_moderator'] || ($group_members[$i]['group_moderator'] && ( ($group_moderator['user_id'] == $userdata['user_id']) || ($userdata['user_level'] == ADMIN) )) )
				{
					$template->assign_block_vars('member_type.member_row.switch_mod_option', array());
				}
			}
		}
	}

	if ( !$members_count )
	{
		//
		// No group members
		//
		$template->assign_block_vars('switch_no_members', array());
		$template->assign_vars(array(
			'L_NO_MEMBERS' => $lang['No_group_members'])
		);
	}

	$current_page = ( !$members_count ) ? 1 : ceil( $members_count / $board_config['topics_per_page'] );

	$template->assign_vars(array(
		'PAGINATION' => generate_pagination("groupcp.$phpEx?" . POST_GROUPS_URL . "=$group_id", $members_count, $board_config['topics_per_page'], $start),
		'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $board_config['topics_per_page'] ) + 1 ), $current_page ), 

		'L_GOTO_PAGE' => $lang['Goto_page'])
	);

	if ( $group_info['group_type'] == GROUP_HIDDEN && !$is_group_member && !$is_moderator )
	{
		//
		// No group members
		//
		$template->assign_block_vars('switch_hidden_group', array());
		$template->assign_vars(array(
			'L_HIDDEN_MEMBERS' => $lang['Group_hidden_members'])
		);
	}

	//
	// We've displayed the members who belong to the group, now we 
	// do that pending memebers... 
	//
	if ( $is_moderator )
	{
		//
		// Users pending in ONLY THIS GROUP (which is moderated by this user)
		//
		if ( $modgroup_pending_count )
		{
			$template->set_filenames(array(
				'pendinginfo' => 'groupcp_pending_info.tpl')
			);
			for($i = 0; $i < $modgroup_pending_count; $i++)
			{
				$username = $modgroup_pending_list[$i]['username'];
				$user_id = $modgroup_pending_list[$i]['user_id'];
				$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
				
				$template->assign_block_vars('pending_members_row', array(
					'ROW_CLASS' => $row_class,
					'USER_ID' => $user_id, 
					)
				);
				
				@reset($user_maps['PHPBB.groupcp']['fields']);
				preProcessUserConfig($modgroup_pending_list[$i]);
				while (list($field_name, $field_data) = @each($user_maps['PHPBB.groupcp']['fields']) )
				{
					$val = pcp_output($field_name, $modgroup_pending_list[$i], 'PHPBB.groupcp');
					if(!$val){
						$val = "&nbsp;";
					}
					$template->assign_block_vars('pending_members_row.member_fields', array(
								'FIELD' => $val,
								'WIDTH' => $width,
								)
							);	
				}
				
			}

			$template->assign_block_vars('switch_pending_members', array() );

			$template->assign_vars(array(
				'ROWCOUNT' => $rowcount,
				'L_SELECT' => $lang['Select'],
				'L_APPROVE_SELECTED' => $lang['Approve_selected'],
				'L_DENY_SELECTED' => $lang['Deny_selected'])
			);

			$template->assign_var_from_handle('PENDING_USER_BOX', 'pendinginfo');
		
		}
	}

	if ( $is_moderator )
	{
		$template->assign_block_vars('switch_mod_option', array());
		if ( ($group_moderator['user_id'] == $userdata['user_id']) || ($userdata['user_level'] == ADMIN) )
		{
			$template->assign_block_vars('switch_mod_option.switch_owner_option', array());
		}
	}

	$template->pparse('info');
}
else
{
	//
	// Show the main groupcp.php screen where the user can select a group.
	//
	// Select all group that the user is a member of or where the user has
	// a pending membership.
	//
	$in_group = array();

	if ( $userdata['session_logged_in'] ) 
	{
		$sql = "SELECT g.group_id, g.group_name, g.group_type, ug.user_pending 
			FROM " . GROUPS_TABLE . " g, " . USER_GROUP_TABLE . " ug
			WHERE ug.user_id = " . $userdata['user_id'] . "  
				AND ug.group_id = g.group_id
				AND g.group_single_user <> " . TRUE . "
			ORDER BY g.group_name, ug.user_id";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Error getting group information', '', __LINE__, __FILE__, $sql);
		}

		if ( $row = $db->sql_fetchrow($result) )
		{
			$in_group = array();
			$s_member_groups_opt = '';
			$s_pending_groups_opt = '';

			do
			{
				$in_group[] = $row['group_id'];
				if ( $row['user_pending'] )
				{
					$s_pending_groups_opt .= '<option value="' . $row['group_id'] . '">' . $row['group_name'] . '</option>';
				}
				else
				{
					$s_member_groups_opt .= '<option value="' . $row['group_id'] . '">' . $row['group_name'] . '</option>';
				}
			}
			while( $row = $db->sql_fetchrow($result) );

			$s_pending_groups = '<select name="' . POST_GROUPS_URL . '">' . $s_pending_groups_opt . "</select>";
			$s_member_groups = '<select name="' . POST_GROUPS_URL . '">' . $s_member_groups_opt . "</select>";
		}
	}

	//
	// Select all other groups i.e. groups that this user is not a member of
	//
	$ignore_group_sql =	( count($in_group) ) ? "AND group_id NOT IN (" . implode(', ', $in_group) . ")" : ''; 
	$sql = "SELECT group_id, group_name, group_type, group_count , group_count_max 
		FROM " . GROUPS_TABLE . " g 
		WHERE group_single_user <> " . TRUE . " 
			$ignore_group_sql 
		ORDER BY g.group_name";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Error getting group information', '', __LINE__, __FILE__, $sql);
	}

	$s_group_list_opt = '';
	while( $row = $db->sql_fetchrow($result) )
	{
		$is_autogroup_enable = ($row['group_count'] <= $userdata['user_posts'] && $row['group_count_max'] > $userdata['user_posts']) ? true : false;
		if  ( $row['group_type'] != GROUP_HIDDEN || $userdata['user_level'] == ADMIN || $is_autogroup_enable)
		{
			$s_group_list_opt .='<option value="' . $row['group_id'] . '">' . $row['group_name'] . '</option>';
		}
	}
	$s_group_list = '<select name="' . POST_GROUPS_URL . '">' . $s_group_list_opt . '</select>';

	if ( $s_group_list_opt != '' || $s_pending_groups_opt != '' || $s_member_groups_opt != '' )
	{
		//
		// Load and process templates
		//
		$page_title = $lang['Group_Control_Panel'];
		include($phpbb_root_path . 'includes/page_header.'.$phpEx);

		$template->set_filenames(array(
			'user' => 'groupcp_user_body.tpl')
		);
		make_jumpbox('viewforum.'.$phpEx);

		if ( $s_pending_groups_opt != '' || $s_member_groups_opt != '' )
		{
			$template->assign_block_vars('switch_groups_joined', array() );
		}

		if ( $s_member_groups_opt != '' )
		{
			$template->assign_block_vars('switch_groups_joined.switch_groups_member', array() );
		}

		if ( $s_pending_groups_opt != '' )
		{
			$template->assign_block_vars('switch_groups_joined.switch_groups_pending', array() );
		}

		if ( $s_group_list_opt != '' )
		{
			$template->assign_block_vars('switch_groups_remaining', array() );
		}

		$s_hidden_fields = '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';

		$template->assign_vars(array(
			'L_GROUP_MEMBERSHIP_DETAILS' => $lang['Group_member_details'],
			'L_JOIN_A_GROUP' => $lang['Group_member_join'],
			'L_YOU_BELONG_GROUPS' => $lang['Current_memberships'],
			'L_SELECT_A_GROUP' => $lang['Non_member_groups'],
			'L_PENDING_GROUPS' => $lang['Memberships_pending'],
			'L_SUBSCRIBE' => $lang['Subscribe'],
			'L_UNSUBSCRIBE' => $lang['Unsubscribe'],
			'L_VIEW_INFORMATION' => $lang['View_Information'], 
			'L_GROUP_PAYMENT' => $lang['group_payment'],
			'S_USERGROUP_ACTION' => append_sid("groupcp.$phpEx"), 
			'S_HIDDEN_FIELDS' => $s_hidden_fields, 

			'GROUP_LIST_SELECT' => $s_group_list,
			'GROUP_PENDING_SELECT' => $s_pending_groups,
			'GROUP_MEMBER_SELECT' => $s_member_groups)
		);

		$template->pparse('user');
	}
	else
	{
		message_die(GENERAL_MESSAGE, $lang['No_groups_exist']);
	}

}

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>
