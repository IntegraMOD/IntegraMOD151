<?php
/***************************************************************************
 *                            contactcp_edit.php
 *                            -------------------
 *   begin                : Saturday, Jan 25, 2003
 *   version              : 0.4.0
 *   date                 : 2003/12/23 23:25
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
}

$mark_list = ( !empty($_REQUEST['mark']) ) ? $_REQUEST['mark'] : 0;
$users_list = ( !empty($_REQUEST['users']) ) ? $_REQUEST['users'] : 0;
$alert_mark = ( !empty($_REQUEST['alert']) ) ? $_REQUEST['alert'] : 0;
$single_add = ( !empty($_REQUEST['single']) ) ? true : false;

if( $type != 'buddy' && $type != 'ignore' && $type != 'disallow' && $type != 'alert' )
{
	$message = 'You do not have access to other users\' lists';
	message_die(GENERAL_MESSAGE, $message . $contact_list->append_msg);
}

include_once($phpbb_root_path . 'includes/bbcode.' . $phpEx);
include_once($phpbb_root_path . 'includes/functions_post.' . $phpEx);

if( $single_add )
{
	if ( !$confirm )
	{
		// Get user_id from a username
		if( $username && !$contact_id )
		{
			$sql = 'SELECT user_id FROM ' . USERS_TABLE . "
					WHERE username='$username'";

			if ( !$result = $db->sql_query($sql) )
			{
				$message = 'Could not get user_id from username';
				message_die(GENERAL_ERROR, $message . $contact_list->append_msg, '', __LINE__, __FILE__, $sql);
			}

			if( !$row = $db->sql_fetchrow($result) )
			{
				$message = 'Could not get user_id from username row';
				message_die(GENERAL_ERROR, $message . $contact_list->append_msg, '', __LINE__, __FILE__, $sql);
			}

			$contact_id = $row['user_id'];
		}

		$s_hidden_fields = '<input type="hidden" name="mode" value="' . $mode . '" /><input type="hidden" name="type" value="' . $type . '" /><input type="hidden" name="action" value="' . $action . '" />';
		$s_hidden_fields .= '<input type="hidden" name="single" value="1" /><input type="hidden" name="simple" value="' . $simple . '" />';

		if( $alert_mark )
		{
			$s_hidden_fields .= '<input type="hidden" name="alert" value="' . $alert_mark . '" />';
		}

		if( $contact_id )
		{
			$s_hidden_fields .= '<input type="hidden" name="id" value="' . $contact_id . '" />';
		}
		else
		{
			message_die(GENERAL_ERROR, $lang['No_contact_id'] . $contact_list->append_msg, '', __LINE__, __FILE__, $sql);
		}

		$contact_list->confirm_changes($s_hidden_fields, $lang['Confirm_contact_changes']);
	}
	elseif( $confirm )
	{
		$alert = 0;
		$ignore = 0;
		$disallow = 0;

		$in_list = $contact_list->check_user($userdata['user_id'], $contact_id);

		if( $action == 'add' && $in_list )
		{
			$method = 'update';
		}
		elseif( $action == 'add' )
		{
			$method = 'new';
		}
		elseif( $action == 'remove' )
		{
			$method = 'delete';
		}
		else
		{
			message_die(GENERAL_ERROR, $lang['Invalid_contact_action'] . $contact_list->append_msg, '', __LINE__, __FILE__, $sql);
		}

		switch( $type )
		{
			case 'buddy':
				$alert = ( $alert_mark ) ? 1 : 0;
				$message = $lang['Buddy_updated'];
				break;
			case 'ignore':
				$ignore = 1;
				$message = $lang['Ignore_updated'];
				break;
			case 'disallow':
				$disallow = 1;
				$message = $lang['Disallow_updated'];
				break;
		}

		$contact_list->manage_contact($method, $contact_id, $userdata['user_id'], $ignore, $alert, $disallow);
		$contact_list->change_inform($method, $contact_id, $type);

		message_die(GENERAL_MESSAGE, $message . $contact_list->append_msg);
	}
}
else
{
	// Set to empty array instead of '0' if nothing is selected.
	if ( isset($mark_list) && !is_array($mark_list) )
	{
		$mark_list = array();
	}

	if ( isset($users_list) && !is_array($users_list) )
	{
		$users_list = array();
	}

	// Process input from multi-add text box
	// If there's any valid input, we wind up adding it to the $mark_list array
	if( !empty($_REQUEST['list_to_add']) )
	{
		$list_to_add = explode("\n", $_REQUEST['list_to_add']);
		$list_to_lookup = '';
		foreach($list_to_add as $key=>$val)
		{
			$val = trim(htmlspecialchars(str_replace("\'", "''", $val)));
			if( !empty($val) )
			{
				$list_to_lookup .= ( ($list_to_lookup == '') ? '' : ',' ) . '\'' . $val . '\'';
			}
		}

		$sql = 'SELECT user_id FROM ' . USERS_TABLE . ' WHERE username IN (' . $list_to_lookup . ')';
		if( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Failed to get list of user ids from names', '', __LINE__, __FILE__, $sql);
		}
		if( $db->sql_numrows($result))
		{
			$rows = $db->sql_fetchrowset($result);
			$db->sql_freeresult();
			foreach($rows as $val)
			{
				$mark_list[] = $val['user_id'];
			}
		}
	}

	if( !$action )
	{
		if( isset($_REQUEST['delete']) )
		{
			$action = 'delete';
		}
		elseif( isset($_REQUEST['ignore']) )
		{
			$type = 'ignore';
			$action = 'update';
		}
		elseif( isset($_REQUEST['disallow']) )
		{
			$type = 'disallow';
			$action = 'update';
		}
		elseif( isset($_REQUEST['buddy']) )
		{
			$type = 'buddy';
			$action = 'update';
		}
		elseif( $type == 'alert' )
		{
			$action = 'update';
		}
	}

	if ( !$confirm )
	{
		$s_hidden_fields = '<input type="hidden" name="mode" value="' . $mode . '" /><input type="hidden" name="type" value="' . $type . '" /><input type="hidden" name="action" value="' . $action . '" /><input type="hidden" name="start" value="' . $start . '" /><input type="hidden" name="order" value="' . $sort_order . '" />';

		for($i = 0; $i < count($mark_list); $i++)
		{
			$s_hidden_fields .= '<input type="hidden" name="mark[]" value="' . intval($mark_list[$i]) . '" />';
		}

		for($i = 0; $i < count($users_list); $i++)
		{
			$s_hidden_fields .= '<input type="hidden" name="users[]" value="' . intval($users_list[$i]) . '" />';
		}

		if( !count($mark_list) && !count($users_list) )
		{
			$message = $lang['No_Contact_changes'];
			message_die(GENERAL_MESSAGE, $message . $contact_list->append_msg);
		}

		$contact_list->confirm_changes($s_hidden_fields, $lang['Confirm_contact_changes']);
	}
	else if ( $confirm )
	{
		if( $action == 'update' )
		{
			$moved_msg = '';
			$disallow = 0;
			$ignore = 0;

			switch($type)
			{
				case 'alert':
					$contact_list->update_alerts($mark_list, $users_list, $userdata['user_id']);
					break;
				case 'ignore':
					$ignore = 1;
					$moved_msg = $lang['Moved_to_ignore'];
					break;
				case 'disallow':
					$disallow = 1;
					$moved_msg = $lang['Moved_to_disallow'];
					break;
				case 'buddy':
					$moved_msg = $lang['Moved_to_buddies'];
					break;
			}

			$contact_list->get_list('all');
			$update_list = array();
			$new_list = array();
			$mark_size = count($mark_list);

			if ( $mark_size )
			{
				for ($i = 0; $i < $mark_size; $i++)
				{
					$this_user_id = intval($mark_list[$i]);

					if( array_key_exists($this_user_id, $contact_list->buddy) || array_key_exists($this_user_id, $contact_list->ignore) || array_key_exists($this_user_id, $contact_list->disallow) )
					{
						$update_list[] = $this_user_id;
					}
					else
					{
						$new_list[] = $this_user_id;
					}
				}

				if( !empty($update_list) )
				{
					$contact_list->manage_contact('update', $update_list, $userdata['user_id'], $ignore, 0, $disallow);
					$contact_list->change_inform('update', $update_list, $type);
				}

				if( !empty($new_list) )
				{
					$contact_list->manage_contact('new', $new_list, $userdata['user_id'], $ignore, 0, $disallow);
					$contact_list->change_inform('new', $new_list, $type);
				}
				message_die(GENERAL_MESSAGE, $moved_msg . $contact_list->append_msg);
			}
			else
			{
				$message = $lang['No_Contact_changes'];
				message_die(GENERAL_MESSAGE, $message . $contact_list->append_msg);
			}
		}
		elseif( $action == 'delete' )
		{
			// Remove all selected buddies
			$mark_size = count($mark_list);
			if ( $mark_size )
			{
				$delete_list = array();
				for ($i = 0; $i < $mark_size; $i++)
				{
					$delete_list[] = intval($mark_list[$i]);
				}

				if( !empty($delete_list) )
				{
					$contact_list->manage_contact('delete', $delete_list, $userdata['user_id']);
					$contact_list->change_inform('delete', $delete_list);
				}

				message_die(GENERAL_MESSAGE, $lang['Removed_selected_users'] . $contact_list->append_msg);
			}
			else
			{
				message_die(GENERAL_MESSAGE, $lang['No_Contact_changes'] . $contact_list->append_msg);
			}
		}
		else
		{
			message_die(GENERAL_MESSAGE, $lang['Invalid_contact_action'] . $contact_list->append_msg);
		}
	}
}

?>