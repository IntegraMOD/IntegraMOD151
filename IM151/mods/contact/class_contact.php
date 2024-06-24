<?php
/***************************************************************************
 *                             class_contact.php
 *                            -------------------
 *   begin                : Sunday, Dec 14, 2003
 *   version              : 1.0.0
 *   copyright            : See readme.txt
 ***************************************************************************/
/*
	This file manages the database interaction for Prillian and Contact List.
	If you want to adapt Prillian to work with another buddy list or ignore list,
	You should create a new class_contact.php to replace this one.  Your new file
	should have all the same functions as this one, but the contents of those
	functions can be changed so that they call the functions used in the other
	hack.  They should also format the output of the other hack's functions to
	match Prillian's needs, if necessary.
*/

class contact_list 
{
	var $buddy;				// Array of buddies
	var $ignore;			// Array of ignored users
	var $disallow;			// Array of disallowed users
	var $buddy_of;			// Array of people user is a buddy of
	var $ignored_by;		// Array of people ignoring user
	var $disallow_by;		// Array of peole disallowing user
	var $disallow_mode;
	var $append_msg;		// Holds Close Window link text

	// Constructor.
	function __construct()
	{
		global $gen_simple_header, $lang;

		// Set Close Window link.
		if( $gen_simple_header )
		{
			$this->append_msg = $lang['Close_window_link'];
		}
		else
		{
			$this->append_msg = '';
		}

		$this->buddy = array();
		$this->ignore = array();
		$this->disallow = array();
		$this->buddy_of = array();
		$this->ignored_by = array();
		$this->disallow_by = array();
		$this->disallow_mode = false;
	}

       /* Gets lists of contacts from the database; stores them in class variables */
       function get_list($type = 'buddy', $limit = 0, $start = 0, $order = 'ASC', $limit_max = 0)
       {
          global $db, $lang, $userdata;

          if(defined('NO_CONTACTS'))
          {
             return;
          }


          if(empty($userdata)) return;
          // this should not happen but it does as $userdata (which should be global data)
          // is not available here... so something fundamental is wrong...


          $field_list = 'user_id, contact_id';
          $fields_sql = '';
          $field_check_sql =  'c.contact_id AND c.user_id = ' . $userdata['user_id'];

          switch( $type )
          {
             case 'all_new':
                // This type dumps the current lists and gets fresh copies
                $this->buddy = array();
                $this->ignore = array();
                $this->disallow = array();
             case 'all':
                // This type only gets lists that have not already been retrieved
                $field_list = '*';
                break;
             case 'buddy':
                // Buddy list only
                $this->buddy = array();
                $field_list .= ',alert,alert_status,display_name';
                $field_check_sql .= ' AND c.disallow = 0 AND c.user_ignore = 0';
                break;
             case 'ignore':
                // Ignore list only
                $this->ignore = array();
                $field_check_sql .= ' AND c.user_ignore = 1';
                break;
             case 'disallow':
                // Disallow list only
                $this->disallow = array();
                $field_check_sql .= ' AND c.disallow = 1';
                break;
             case 'buddy_of':
                // This type gets the users listing someone as a buddy
                $this->buddy_of = array();
                $field_check_sql = ' AND c.disallow = 0 AND c.user_ignore = 0';
                break;
             case 'ignored_by':
                // This type gets the users ignoring someone
                $this->ignored_by = array();
                $field_check_sql .= ' AND c.user_ignore = 1';
                break;
             case 'disallow_by':
                // This type gets the users disallowing someone
                $this->disallow_by = array();
                $field_check_sql .= ' AND c.disallow = 1';
                break;
          }

          $fields_sql = ($field_list == '*') ? 'c.*': 'c.' . str_replace(',', ', c.', $field_list);

          $sql = 'SELECT ' . $fields_sql . ', u.username FROM ' . CONTACT_TABLE . ' c, ' . USERS_TABLE . ' u WHERE ' . $field_check_sql;

          $sql .= ' ORDER BY u.username ' . $order;

          if ($limit)
          {
             global $board_config;
             $sql .= ' LIMIT ';
             $sql .= ( !empty($start) ) ? $start . ',' : '0,';
             $sql .= ( $limit_max ) ? $limit_max : $board_config['topics_per_page'];
          }

          //var_dump($sql);

          if (!$result = $db->sql_query($sql))
          {
             $this->contact_die('Could not get contacts list:' . $type, __LINE__, __FILE__, $sql);
          }
          if (!$db->sql_numrows($result))
          {
             return; // There are no contacts, quit now.
          }
          else
          {
             // There are contacts, so let's put them in arrays based on type.
             $rows = $db->sql_fetchrowset($result);
             $db->sql_freeresult();

             // First, deal with queries that are getting other user's lists that
             // include this user.
             $id_name = 'contact_id';
             if( $type == 'buddy_of' || $type == 'ignored_by' || $type == 'disallow_by' )
             {
                $id_name = 'user_id';
             }

             foreach($rows as $val)
             {
                if( $type == 'allnew' )
                {
                   if( $val['user_ignore'] && !array_key_exists($val[$id_name], $this->ignore) )
                   {
                      $this->ignore[$val[$id_name]] = $val;
                   }
                   elseif( $val['disallow'] && !array_key_exists($val[$id_name], $this->disallow) )
                   {
                      $this->disallow[$val[$id_name]] = $val;
                   }
                   elseif( !array_key_exists($val[$id_name], $this->buddy) )
                   {
                      $this->buddy[$val[$id_name]] = $val;
                   }
                }
                elseif( $type == 'all' )
                {
                   if( $val['user_ignore'] )
                   {
                      $this->ignore[$val[$id_name]] = $val;
                   }
                   elseif( $val['disallow'] )
                   {
                      $this->disallow[$val[$id_name]] = $val;
                   }
                   else
                   {
                      $this->buddy[$val[$id_name]] = $val;
                   }
                }
                else
                {
                   $this->{$type}[$val[$id_name]] = $val;
                }
             }
             unset($rows); // Dump the old array to free memory.
          }
       } // END - get_list()

	/* Gets the count of users on someone's list */
	function get_count($userid, $type = 'buddy')
	{
		global $db, $lang, $userdata;


/* ADDED BY HELTER 3-9-2016 */
if ( empty($userdata['user_id']) )
{
return;
}
/* END ADD */


		$userid = ( empty($userid) ) ? $userdata['user_id'] : intval($userid);
		$field_check_sql =  'user_id = ' . $userid;

		switch( $type )
		{
			case 'all':
				// Total number of contants
				break;
			case 'buddy':
				// Buddy list only
				$field_check_sql .= ' AND disallow = 0 AND user_ignore = 0';
				break;
			case 'ignore':
				// Ignore list only
				$field_check_sql .= ' AND user_ignore = 1';
				break;
			case 'disallow':
				// Disallow list only
				$field_check_sql .= ' AND disallow = 1';
				break;
			case 'buddy_of':
				// Total number of users listing person as a buddy
				$field_check_sql = 'contact_id = ' . $userid . ' AND disallow = 0 AND user_ignore = 0';
				break;
		}

		$sql = 'SELECT COUNT(*) as total FROM ' . CONTACT_TABLE . ' WHERE ' . $field_check_sql;
		if( !$result = $db->sql_query($sql) )
		{
			$this->contact_die('Could not get contacts count:' . $type, __LINE__, __FILE__, $sql);
		}
		if( $row = $db->sql_fetchrow($result) )
		{
			return $row['total'];
		}
		else
		{
			return 0;
		}
	} // END - get_count()

	/* Check to see if one user is on another's contact list.  This should only be
	   used in places where it's quicker to query the database for one user rather
	   than multiple users on a list.  An example of that would be in viewprofile.

	   Currently supports checking buddy, ignore, disallow, or all lists by passing
	   the other user's ID as $user_one and $userdata['user_id'] as $user_two.  You
	   can check the other way by reversing those two variables.
	*/
	function check_user($user_one, $user_two, $type = '')
	{
		global $db, $lang;

		$user_one = intval($user_one);
		$user_two = intval($user_two);
		$where_sql = '';
		if( $type == 'ignore' )
		{
			$where_sql = ' AND user_ignore = 1';
		}
		elseif( $type == 'disallow' )
		{
			$where_sql = ' AND disallow = 1';
		}
		elseif( $type == 'buddy' )
		{
			$where_sql = ' AND user_ignore = 0 AND disallow = 0';
		}
		$sql = 'SELECT * FROM ' . CONTACT_TABLE . ' WHERE user_id = ' . $user_one . ' AND contact_id = ' . $user_two . $where_sql;
		if( !$result = $db->sql_query($sql) )
		{
			$this->contact_die('Could not check for user in contacts list:' . $type, __LINE__, __FILE__, $sql);
		}
		if( !$db->sql_numrows($result) )
		{
			return false;
		}
		return true;
	} // END - check_user()

	/* Modifies a user's contacts in the database table(s) */
	function manage_contact($type, $contact_id, $userid, $ignore=0, $alert=0, $disallow=0)
	{
		global $db, $lang;

		$id_list = '';
		$list_sql = '';

		if( is_array($contact_id) )
		{
			$id_list = implode(', ', $contact_id);
			$list_sql = ' IN (' . $id_list . ')';
		}
		else
		{
			$list_sql = ' = ' . $contact_id;
		}

		$error = false;
		// Check to see if the user is trying to add themselves to their own lists
		// This may not be allowed; it depends on a setting in constants_contact.php
		if( !ALLOW_BUDDY_SELF && ( $type == 'new' || $type == 'update' ) )
		{
			if( is_array($contact_id) && in_array($userid, $contact_id) )
			{
				$error = true;
			}
			elseif( $contact_id == $userid )
			{
				$error = true;
			}

			if( $error )
			{
				$this->contact_die($lang['No_contact_add_self'], '', '', '');
			}
		}
		/* Here we'll check to see if the user is trying to ignore or disallow any
		   admins or moderators. If so, we'll print out an error message that names
		   the admins and/or moderators. */
		if( ($ignore || $disallow) && ( $type == 'new' || $type == 'update' ) )
		{
			$sql = 'SELECT username, user_level FROM ' . USERS_TABLE . ' WHERE user_id' . $list_sql;
			if( !$result = $db->sql_query($sql) )
			{
				$this->contact_die('Could not check user_level of users.', __LINE__, __FILE__, $sql);
			}
			if( $db->sql_numrows($result) )
			{
				$rows = $db->sql_fetchrowset($result);
			}

			$sql = 'SELECT u.username, g.group_id
				FROM ' . AUTH_ACCESS_TABLE . ' aa, ' . USER_GROUP_TABLE . ' ug, ' . GROUPS_TABLE . ' g, ' . USERS_TABLE . ' u 
				WHERE aa.auth_mod = ' . true . ' 
					AND ((g.group_single_user = 0
					AND g.group_type <> ' . GROUP_HIDDEN . ')
						OR g.group_single_user = 1)
					AND ug.group_id = aa.group_id 
					AND g.group_id = aa.group_id 
					AND u.user_id = ug.user_id
					AND u.user_id ' . $list_sql;
			if ( !$result = $db->sql_query($sql) )
			{
				$this->contact_die('Could not query moderator groups.', __LINE__, __FILE__, $sql);
			}
			while ( $row = $db->sql_fetchrow($result) )
			{
				$rows[] = $row;
			}

			if( count($rows) )
			{
				$mod_admin_list = array();
				foreach($rows as $v)
				{
					if( $v['user_level'] == ADMIN || $v['user_level'] == MODERATOR || isset($v['group_id']) )
					{
						$error = true;
						if( !in_array($v['username'], $mod_admin_list) )
						{
							$mod_admin_list[] = $v['username'];
						}
					}
				}
			}

			if( $error )
			{
				$this->contact_die(sprintf($lang['No_ignore_admin'], implode(', ', $mod_admin_list)), '', '', '');
			}
		}

		switch( $type )
		{
			case 'new':
				// New information
				$sql = array();
				if( is_array($contact_id) )
				{
					foreach($contact_id as $v)
					{
						$sql[] = 'INSERT INTO ' . CONTACT_TABLE . '(user_id, contact_id, user_ignore, alert, alert_status, disallow)
							VALUES (' . $userid . ', ' . intval($v) . ', ' . $ignore . ', ' . $alert . ', 0, ' . $disallow . ')';
					}
				}
				else
				{
					$sql[] = 'INSERT INTO ' . CONTACT_TABLE . '(user_id, contact_id, user_ignore, alert, alert_status, disallow)
							VALUES (' . $userid . ', ' . intval($contact_id) . ', ' . $ignore . ', ' . $alert . ', 0, ' . $disallow . ')';
				}

				foreach($sql as $val)
				{
					if ( !$result = $db->sql_query($val) )
					{
						$this->contact_die('Could not insert data into contact table', __LINE__, __FILE__, $val);
					}
				}
				break;
			case 'update':
				// Update contact info
				$sql = 'UPDATE ' . CONTACT_TABLE . '
						SET user_ignore = ' . $ignore . ', alert = ' . $alert . ', disallow = ' . $disallow . '
						WHERE user_id = ' . $userid . '
						AND contact_id ' . $list_sql;

				if ( !$result = $db->sql_query($sql) )
				{
					$this->contact_die('Could not update data in contact table', __LINE__, __FILE__, $sql);
				}
				break;
			case 'delete':
				// Delete a single contact or list of contacts from the list
				$sql = 'DELETE FROM ' . CONTACT_TABLE . '
					WHERE user_id = ' . $userid . '
						AND contact_id ' . $list_sql;
				
				if ( !$result = $db->sql_query($sql) )
				{
					$this->contact_die('Could not delete data in contact table', __LINE__, __FILE__, $sql);
				}
				break;
			case 'deleteall':
				$sql = 'DELETE FROM ' . CONTACT_TABLE . '
					WHERE user_id = ' . $userid;
				
				if ( !$result = $db->sql_query($sql) )
				{
					$this->contact_die('Could not delete data in contact table', __LINE__, __FILE__, $sql);
				}
				break;
		}
	} // END - manage_contact()

	/* Outputs a confirmation page before any changes are made in database */
	function confirm_changes($s_hidden_fields, $msg_text)
	{
		global $template, $lang;

		$path = '';
		if ( !empty($this->append_msg) )
		{
			$path = 'contact/';
		}
		$template->set_filenames(array(
			'confirm_body' => $path . 'confirm_body.tpl')
		);
		$template->assign_vars(array(
			'MESSAGE_TITLE' => $lang['Contact_Management'],
			'MESSAGE_TEXT' => $msg_text . $this->append_msg,

			'L_YES' => $lang['Yes'],
			'L_NO' => $lang['No'],

			'S_CONFIRM_ACTION' => append_sid(CONTACT_URL),
			'S_HIDDEN_FIELDS' => $s_hidden_fields)
		);

		$template->pparse('confirm_body');
	} // END - confirm_changes()

	/* Sends a PM when a user is added to another user's list */
	function change_inform($method, $id_list, $type = '')
	{
		global $db, $userdata, $board_config, $lang, $phpbb_root_path, $phpEx, $user_ip;

		if( $type != 'buddy' || ($method != 'new' && $method != 'update') )
		{
			return; // Not adding to buddy list, so send no PM.
		}

		$server = server_specs();
		$base_profile_url = $server['protocol'] . $server['name'] . $server['port'] . $server['script'];
		$contactcp_string = $base_profile_url;
		$base_profile_url .= '/profile.' . $phpEx . '?mode=viewprofile&amp;sid=' . $userdata['session_id'] . '&amp;' . POST_USERS_URL . '=';
		$contactcp_string .= '/contact.' . $phpEx . '?mode=show&amp;sid=' . $userdata['session_id'];
		$msg_time = time();

		// Make sure we're dealing with an array of contact_id's
		if( !is_array($id_list) )
		{
			$temp_array = array();
			$temp_array[] = $id_list;
			$id_list = $temp_array;
		}

		// Send Private Message to every affected user
		// Much of this is lifted straight from 2.0.4's privmsg.php
		$num_of_ids = sizeof($id_list);
		for ($i = 0; $i < $num_of_ids; $i++)
		{
			$to_userdata = array();
			$sql = 'SELECT username, user_notify_pm, user_email, user_lang, user_active FROM ' . USERS_TABLE . ' WHERE user_id = \'' . $id_list[$i] . '\'';

			if ( !$result = $db->sql_query($sql) )
			{
				$this->contact_die('Could not get user data for sending system message', __LINE__, __FILE__, $sql);
			}

			$to_userdata = $db->sql_fetchrow($result);
			$to_userdata['user_id'] = $id_list[$i];

			$user_profile_string = $base_profile_url . $userdata['user_id'];
			$username_string = str_replace("\'", "''", $userdata['username']);
			$to_username = str_replace("\'", "''", $to_userdata['username']);

			$sys_message = sprintf($lang['Contact_Alert_PM'], $user_profile_string, $username_string, $contactcp_string);

			$bbcode_uid = make_bbcode_uid();
			$privmsg_message = prepare_message($sys_message, '1', '1', '0', $bbcode_uid);

			//
			// See if recipient is at their inbox limit
			//
			$sql = 'SELECT COUNT(privmsgs_id) AS inbox_items, MIN(privmsgs_date) AS oldest_post_time 
				FROM ' . PRIVMSGS_TABLE . ' 
				WHERE privmsgs_type IN (' . PRIVMSGS_NEW_MAIL . ', ' . PRIVMSGS_READ_MAIL . ', ' . PRIVMSGS_UNREAD_MAIL . ' ) 
					AND privmsgs_to_userid = ' . $to_userdata['user_id'];
			if ( !$result = $db->sql_query($sql) )
			{
				$this->contact_die($lang['No_such_user'], __LINE__, __FILE__, $sql);
			}

			$sql_priority = ( SQL_LAYER == 'mysql' ) ? 'LOW_PRIORITY' : '';
			if ( $inbox_info = $db->sql_fetchrow($result) )
			{
				if ( $inbox_info['inbox_items'] >= $board_config['max_inbox_privmsgs'] )
				{
					$sql = 'SELECT privmsgs_id FROM ' . PRIVMSGS_TABLE . ' 
						WHERE privmsgs_type IN (' . PRIVMSGS_NEW_MAIL . ', ' . PRIVMSGS_READ_MAIL . ', ' . PRIVMSGS_UNREAD_MAIL . ' ) 
							AND privmsgs_date = ' . $inbox_info['oldest_post_time'] . ' 
							AND privmsgs_to_userid = ' . $to_userdata['user_id'];
					if ( !$result = $db->sql_query($sql) )
					{
						$this->contact_die('Could not find oldest privmsgs (inbox)', __LINE__, __FILE__, $sql);
					}
					$old_privmsgs_id = $db->sql_fetchrow($result);
					$old_privmsgs_id = $old_privmsgs_id['privmsgs_id'];

					$sql = "DELETE $sql_priority FROM " . PRIVMSGS_TABLE . " 
						WHERE privmsgs_id = $old_privmsgs_id";
					if ( !$db->sql_query($sql) )
					{
						$this->contact_die('Could not delete oldest privmsgs (inbox)', __LINE__, __FILE__, $sql);
					}

					$sql = "DELETE $sql_priority FROM " . PRIVMSGS_TEXT_TABLE . " 
						WHERE privmsgs_text_id = $old_privmsgs_id";
					if ( !$db->sql_query($sql) )
					{
						$this->contact_die('Could not delete oldest privmsgs text (inbox)', __LINE__, __FILE__, $sql);
					}
				}
			}

			$sql_info = 'INSERT INTO ' . PRIVMSGS_TABLE . ' (privmsgs_type, privmsgs_subject, privmsgs_from_userid, privmsgs_to_userid, privmsgs_date, privmsgs_ip, privmsgs_enable_html, privmsgs_enable_bbcode, privmsgs_enable_smilies, privmsgs_attach_sig)
				VALUES (' . PRIVMSGS_NEW_MAIL . ", '" . str_replace("\'", "''", $lang['System_title']) . "', " . $userdata['user_id'] . ", " . $to_userdata['user_id'] . ", $msg_time, '$user_ip', 1, 1, 0, 0)";

			if ( !$result = $db->sql_query($sql_info, BEGIN_TRANSACTION) )
			{
				$this->contact_die('Could not insert/update private message sent info.', __LINE__, __FILE__, $sql_info);
			}

			$privmsg_sent_id = $db->sql_nextid();

			$sql = 'INSERT INTO ' . PRIVMSGS_TEXT_TABLE . " (privmsgs_text_id, privmsgs_bbcode_uid, privmsgs_text)
				VALUES ($privmsg_sent_id, '$bbcode_uid ', '" . str_replace("\'", "''", addslashes($privmsg_message)) . "')";

			if ( !$result = $db->sql_query($sql, END_TRANSACTION) )
			{
				$this->contact_die('Could not insert/update private message sent text.', __LINE__, __FILE__, $sql_info);
			}

			//
			// Add to the users new pm counter
			//
			$sql = 'UPDATE ' . USERS_TABLE . '
				SET user_new_privmsg = user_new_privmsg + 1, user_last_privmsg = ' . time() . '  
				WHERE user_id = ' . $to_userdata['user_id']; 
			if ( !$status = $db->sql_query($sql) )
			{
				$this->contact_die('Could not update private message new/read status for user', __LINE__, __FILE__, $sql);
			}

			if ( $to_userdata['user_notify_pm'] && !empty($to_userdata['user_email']) && $to_userdata['user_active'] )
			{
				include_once($phpbb_root_path . 'includes/emailer.'.$phpEx);
				$emailer = new emailer($board_config['smtp_delivery']);
				$emailer->from($board_config['board_email']);
				$emailer->replyto($board_config['board_email']);
				$emailer->use_template('privmsg_notify', $to_userdata['user_lang']);
				$emailer->email_address($to_userdata['user_email']);
				$emailer->set_subject($lang['Notification_subject']);
				$emailer->assign_vars(array(
					'USERNAME' => $to_username, 
					'SITENAME' => $board_config['sitename'],
					'EMAIL_SIG' => (!empty($board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']) : '', 

					'U_INBOX' => $server['protocol'] . $server['name'] . $server['port'] . $server['script'] . '/privmsg.' .$phpEx . '?folder=inbox')
				);

				$emailer->send();
				$emailer->reset();
			}
		}
	} // END - change_inform()

	/* Changes the online/offline alert marker in the database */
	function update_alert_status($online_list, $offline_list, $userid)
	{
		global $db, $lang;

		if( !empty($online_list) )
		{
			$sql = 'UPDATE ' . CONTACT_TABLE . " SET alert_status = 1 WHERE user_id = $userid AND contact_id IN ($online_list)";

			if ( !$result = $db->sql_query($sql) )
			{
				$this->contact_die('Could not update online alert status', __LINE__, __FILE__, $sql);
			}
		}

		if( !empty($offline_list) )
		{
			$sql = 'UPDATE ' . CONTACT_TABLE . " SET alert_status = 0 WHERE user_id = $userid AND contact_id IN ($offline_list)";

			if ( !$result = $db->sql_query($sql) )
			{
				$this->contact_die('Could not update offline alert status', __LINE__, __FILE__, $sql);
			}
		}
	} // END - update_alert_status()


	/* Changes alert settings for a buddy in the database */
	function update_alerts($mark_list, $users_list, $userid)
	{
		global $db, $lang;

		$mark_size = count($mark_list);
		$user_size = count($users_list);

		if ( $mark_size && $user_size )
		{
			$bad_list = '';
			$on_list = array();
			$off_list = array();

			for ($i = 0; $i < $mark_size; $i++)
			{
				$this_user_id = intval($mark_list[$i]);
				$buddy_exists = array_key_exists($this_user_id, $this->buddy);
				if( $buddy_exists )
				{
					if( !$this->buddy[$this_user_id]['alert'] )
					{
						$on_list[] = $this_user_id;
					}
				}
				else
				{
					$error = TRUE;
					$bad_list .=  ( ( $bad_list == '' ) ? '' : ', ' ) . '\'' . $this_user_id . '\'';
				}
			}

			for ($i = 0; $i < $user_size; $i++)
			{
				$this_user_id = intval($users_list[$i]);
				if( !in_array($this_user_id, $mark_list) &&  $this->buddy[$this_user_id]['alert'] )
				{
					$off_list[] = $this_user_id;
				}
			}

			if( !empty($on_list) )
			{
				$this->manage_contact('update', $on_list, $userid, 0, 1);
			}

			if( !empty($off_list) )
			{
				$this->manage_contact('update', $off_list, $userid);
			}

			if( $error && !empty($bad_list) )
			{
				$bad_names = '';
				$sql = 'SELECT username FROM ' . USERS_TABLE . '
						WHERE user_id IN (' . $bad_list . ')';
				if ( !$result=$db->sql_query($sql) )
				{
					$this->contact_die('Could not get list of usernames for alert update error', __LINE__, __FILE__, $sql);
				}
				while( $row = $db->sql_fetchrow($result) )
				{
					$bad_names .=  ( ( $bad_names == '' ) ? '' : ', ' ) . $row['username'];
				}

				$this->contact_die($lang['Alerts_updated'] . $lang['Alerts_oops'] . $bad_names, __LINE__, __FILE__, $sql);
			}

			message_die(GENERAL_MESSAGE, $lang['Alerts_updated'], '', __LINE__, __FILE__, $sql);
		}
		elseif ( $user_size )
		{
			// $mark_list is empty, but $users_list is not. This means
			// to remove alert updates for all of the users in $users_list.
			for ($i = 0; $i < $user_size; $i++)
			{
				$this_id = intval($users_list[$i]);
				$buddy_exists = array_key_exists($this_id, $this->buddy);
				if( $buddy_exists )
				{
					
				}
				if( $this->buddy[$this_id]['alert'] )
				{
					$off_list[] = $this->buddy[$this_id]['contact_id'];
				}
			}

			if( !empty($off_list) )
			{
				$this->manage_contact('update', $off_list, $userid);
			}
			message_die(GENERAL_MESSAGE, $lang['Alerts_updated'], '', __LINE__, __FILE__, $sql);
		}
		else
		{
			$this->contact_die($lang['No_alerts_updated'], __LINE__, __FILE__, $sql);
		}
	} // END - update_alerts()


	/* Checks list of online users to see if a buddy has just come online */
	function alert_check()
	{
		if( !count($this->buddy) || defined('NO_CONTACTS') )
		{
			return 0;
		}

		global $lang, $userdata, $online_array;

		$online_list = '';
		$offline_list = '';

		foreach($this->buddy as $key=>$val)
		{
			if( $val['alert'] )
			{
				if( in_array($val['contact_id'], $online_array) && !$val['alert_status'] )
				{
					// Buddy is online & we haven't alerted user before
					$online_list .= ( ( $online_list == '') ? '' : ',' ) . $val['contact_id'];
				}
				elseif( !in_array($val['contact_id'], $online_array) && $val['alert_status'] )
				{
					// Buddy was online, but now isn't
					$offline_list .= ( ( $offline_list == '') ? '' : ',' ) . $val['contact_id'];
				}
			}
		}

		if( $online_list != '' || $offline_list != '' )
		{
			// Update alert_status
			$this->update_alert_status($online_list, $offline_list, $userdata['user_id']);
		}
		// Inform user of online/offline users
		$this->pass_list($online_list, $offline_list);
	} // END - alert_check()


	/* Pass a list of alert ids to a new window */
	function pass_list($online_list, $offline_list)
	{
		global $template;

		$buddy_alert = 1;
		$u_buddy_alert = CONTACT_URL . '?mode=alert&simple=1&offline=';
		if( empty($online_list) && empty($offline_list) )
		{
			$buddy_alert = 0;
			$u_buddy_alert = '';
		}
		elseif( empty($online_list) )
		{
			$u_buddy_alert .= $offline_list . '&online=0';
		}
		elseif( empty($offline_list) )
		{
			$u_buddy_alert .= '0&online=' . $online_list;
		}
		
		$template->assign_block_vars('buddy_alert',	array(
			'BUDDY_ALERT' => $buddy_alert,
			'U_BUDDY_ALERT' => append_sid($u_buddy_alert, true)
		));
	} // END - pass_list()


	/* Creates the add/remove image links in topics, profiles, etc. */
	function get_image_links($user_id, $username, $ignore_users)
	{
		if( defined('NO_CONTACTS') )
		{
			return false;
		}

		global $lang, $images, $base_urls;

		$ignore_check = $buddy_check = $disallow_check = false;
		$result = array('output' => true, 'img_buddy' => '', 'img_ignore' => '', 'img_disallow' => '', 'l_buddy_alt' => '', 'l_ignore_alt' => '', 'l_disallow_alt' => '', 'final_buddy_url' => '', 'final_ignore_url' => '', 'final_disallow_url' => '');

		$ignore_check = array_key_exists($user_id, $this->ignore);
		if( $ignore_users && $ignore_check )
		{
			// The viewer has not bypassed the ignore system, and is ignoring the user.
			return false;
		}

		// Still going?  Let's see if the user is in the viewer's buddy
		// or disallow lists.  Since a user can only be on one list, we
		// can skip the others once we've found them on one.
		if( !$ignore_check )
		{
			$buddy_check = array_key_exists($user_id, $this->buddy);
			if( !$buddy_check )
			{
				$disallow_check = array_key_exists($user_id, $this->disallow);
			}
		}
		$result['final_buddy_url'] = $base_urls['buddy'];
		$result['final_ignore_url'] = $base_urls['ignore'];
		$result['final_disallow_url'] = $base_urls['disallow'];

		if( $ignore_check )
		{
			// On ignore list - give option to remove
			$result['final_ignore_url'] .= $base_urls['delete'] . $user_id;
			$result['l_ignore_alt'] = $lang['Remove_from_ignore'];
			$result['img_ignore'] = $images['ignore_remove'];
		}
		else
		{
			// Not on ignore list - give option to add
			$result['final_ignore_url'] .= $base_urls['add'] . $user_id;
			$result['l_ignore_alt'] = $lang['Add_to_ignore'];
			$result['img_ignore'] = $images['ignore_add'];
		}

		if( $buddy_check )
		{
			// On buddy list - give option to remove
			$result['final_buddy_url'] .= $base_urls['delete'] . $user_id;
			$result['l_buddy_alt'] = $lang['Remove_from_buddy'];
			$result['img_buddy'] = $images['buddy_remove'];
		}
		else
		{
			// Not on buddy list - give option to add
			$result['final_buddy_url'] .= $base_urls['add'] . $user_id;
			$result['l_buddy_alt'] = $lang['Add_to_buddy'];
			$result['img_buddy'] = $images['buddy_add'];
		}

		if( $disallow_check )
		{
			// On disallow list - give option to remove
			$result['final_disallow_url'] .= $base_urls['delete'] . $user_id;
			$result['l_disallow_alt'] = $lang['Remove_from_disallow'];
			$result['img_disallow'] = $images['disallow_remove'];
		}
		else
		{
			// Not on disallow list - give option to add
			$result['final_disallow_url'] .= $base_urls['add'] . $user_id;
			$result['l_disallow_alt'] = $lang['Add_to_disallow'];
			$result['img_disallow'] = $images['disallow_add'];
		}

		$result['l_buddy_alt'] = sprintf($result['l_buddy_alt'], $username);
		$result['l_ignore_alt'] = sprintf($result['l_ignore_alt'], $username);
		$result['l_disallow_alt'] = sprintf($result['l_disallow_alt'], $username);

		return $result;
	} // END - get_image_links()

	function contact_die($msg, $line, $file, $sql)
	{
		message_die(GENERAL_ERROR, $msg . $this->append_msg, '',  $line, $file, $sql);
	} // END - contact_die()

	function find_disallow_switch()
	{
		global $lang;

	}
}

?>
