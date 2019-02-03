<?php

class report_privmsg extends report_module
{
	var $mode = 'reportprivmsg';
	var $duplicates = false;
	
	//
	// Constructor
	//
	function report_privmsg($id, $data, $lang)
	{
		$this->id = $id;
		$this->data = $data;
		$this->lang = $lang;
	}
	
	//
	// Synchronizing function
	//
	function sync($uninstall = false)
	{
		global $db;
		
		$sql = 'UPDATE ' . PRIVMSGS_TABLE . '
			SET privmsgs_reported = 0';
		if (!$db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Could not reset privmsgs reported flag', '', __LINE__, __FILE__, $sql);
		}
		
		if (!$uninstall)
		{
			$sql = 'SELECT report_subject
				FROM ' . REPORTS_TABLE . '
				WHERE report_module_id = ' . $this->id . '
					AND report_status NOT IN(' . REPORT_CLEARED . ', ' . REPORT_DELETE . ')
				GROUP BY report_subject';
			if (!$result = $db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, 'Could not obtain open reports', '', __LINE__, __FILE__, $sql);
			}
			
			$open_ids = array();
			while ($row = $db->sql_fetchrow($result))
			{
				$open_ids[] = $row['report_subject'];
			}
			$db->sql_freeresult($result);
			
			if (!empty($open_ids))
			{
				$sql = 'UPDATE ' . PRIVMSGS_TABLE . '
					SET privmsgs_reported = 1
					WHERE privmsgs_id IN(' . implode(', ', $open_ids) . ')';
				if (!$db->sql_query($sql))
				{
					message_die(GENERAL_ERROR, 'Could not sync privmsgs reported flag', '', __LINE__, __FILE__, $sql);
				}
			}
		}
	}
	
	//
	// Module action: Insert
	//
	function action_insert($report_subject, $report_id)
	{
		global $db;
		
		$sql = 'UPDATE ' . PRIVMSGS_TABLE . '
			SET privmsgs_reported = 1
			WHERE privmsgs_id = ' . (int) $report_subject;
		if (!$db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Could not update privmsgs reported flag', '', __LINE__, __FILE__, $sql);
		}
	}
	
	//
	// Module action: Update status
	//
	function action_update_status($report_subjects, $report_status)
	{
		global $db;
		
		switch ($report_status)
		{
			case REPORT_CLEARED:
			case REPORT_DELETE:
				$this->action_delete($report_subjects);
			break;
			
			default:
				report_prepare_subjects($report_subjects, true);
				
				$sql = 'UPDATE ' . PRIVMSGS_TABLE . '
					SET privmsgs_reported = 1
					WHERE privmsgs_id IN(' . implode(', ', $report_subjects) . ')';
				if (!$db->sql_query($sql))
				{
					message_die(GENERAL_ERROR, 'Could not update privmsgs reported flag', '', __LINE__, __FILE__, $sql);
				}
			break;
		}
	}
	
	//
	// Module action: Delete
	//
	function action_delete($report_subjects)
	{
		global $db;
		
		report_prepare_subjects($report_subjects, true);
		
		$sql = 'SELECT report_subject
			FROM ' . REPORTS_TABLE . '
			WHERE report_module_id = ' . $this->id . '
				AND report_id NOT IN(' . implode(', ', array_keys($report_subjects)) . ')
				AND report_subject IN(' . implode(', ', $report_subjects) . ')
				AND report_status NOT IN(' . REPORT_CLEARED . ', ' . REPORT_DELETE . ')
			GROUP BY report_subject';
		if (!$result = $db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Could not get open reports', '', __LINE__, __FILE__, $sql);
		}
		
		$open_ids = array();
		while ($row = $db->sql_fetchrow($result))
		{
			$open_ids[] = $row['report_subject'];
		}
		$db->sql_freeresult($result);
		
		if (!empty($open_ids))
		{
			$sql = 'UPDATE ' . PRIVMSGS_TABLE . '
				SET privmsgs_reported = 1
				WHERE privmsgs_id IN(' . implode(', ', $open_ids) . ')';
			if (!$db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, 'Could not update topic reported flag', '', __LINE__, __FILE__, $sql);
			}
		}
		
		$clear_ids = array();
		foreach ($report_subjects as $report_subject)
		{
			if (!in_array($report_subject, $open_ids))
			{
				$clear_ids[] = $report_subject;
			}
		}
		
		if (!empty($clear_ids))
		{
			$sql = 'UPDATE ' . PRIVMSGS_TABLE . '
				SET privmsgs_reported = 0
				WHERE privmsgs_id IN(' . implode(', ', $clear_ids) . ')';
			if (!$db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, 'Could not update topic reported flag', '', __LINE__, __FILE__, $sql);
			}
		}
	}
	
	//
	// Returns url to a report subject
	//
	function subject_url($report_subject, $non_html_amp = false)
	{
		global $phpEx;
		
		$sep = ($non_html_amp) ? '&' : '&amp;';
		return append_sid("privmsg.$phpEx?mode=read$sep" . POST_POST_URL . '=' . (int) $report_subject, $non_html_amp);
	}
	
	// V: TODO reportee_obtain

	//
	// Returns report subject title
	//
	function subject_obtain($report_subject)
	{
		global $db, $userdata;
		
		$sql = 'SELECT privmsgs_subject
			FROM ' . PRIVMSGS_TABLE . '
			WHERE privmsgs_to_userid = ' . $userdata['user_id'] . '
				AND privmsgs_id = ' . (int) $report_subject;
		if (!$result = $db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Could not obtain report subject', '', __LINE__, __FILE__, $sql);
		}
		
		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);
		
		return ($row) ? $row['privmsgs_subject'] : false;
	}
	
	//
	// Returns report subject details
	//
	function subject_details_obtain($report_subject)
	{
		global $db, $phpEx;
		
		$sql = 'SELECT p.privmsgs_subject, p.privmsgs_from_userid, p.privmsgs_enable_html, p.privmsgs_enable_smilies, pt.privmsgs_bbcode_uid, pt.privmsgs_text, u.username
			FROM ' . PRIVMSGS_TABLE . ' p
			INNER JOIN ' . PRIVMSGS_TEXT_TABLE . ' pt
				ON pt.privmsgs_text_id = privmsgs_id
			LEFT JOIN ' . USERS_TABLE . ' u
				ON u.user_id = p.privmsgs_from_userid
			WHERE privmsgs_id = ' . (int) $report_subject;
		if (!$result = $db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, "Could not obtain report subject details", '', __LINE__, __FILE__, $sql);
		}
		
		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);
		
		if (!$row)
		{
			return false;
		}

		$subject_details = array(
			'Message_id' => '#' . $report_subject,
			'Message_from' => '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $row['privmsgs_from_userid']) . '">' . $row['username'] . '</a>',
			'Message_title' => $row['privmsgs_subject'],
			'Message_text' => $row['privmsgs_text']);
		
		$this->_subject_details_prepare($subject_details['Message_text'], $subject_details['Message_title'], $row);
		
		return array(
			'details' => $subject_details);
	}
	
	//
	// Helper function for subject_details_obtain(), prepares private message and private
	// message subject
	//
	function _subject_details_prepare(&$message, &$subject, $row)
	{
		global $phpbb_root_path, $phpEx, $board_config, $userdata;
		include_once($phpbb_root_path . "includes/bbcode.$phpEx");
		
		//
		// If the board has HTML off but the post has HTML
		// on then we process it, else leave it alone
		//
		if ((!$board_config['allow_html'] || !$userdata['user_allowhtml']) && $row['privmsgs_enable_html'])
		{
			$message = preg_replace('#(<)([\/]?.*?)(>)#is', '&lt;\\2&gt;', $message);
		}
	
		if ($row['privmsgs_bbcode_uid'] != '')
		{
			$message = ($board_config['allow_bbcode']) ? bbencode_second_pass($message, $row['privmsgs_bbcode_uid']) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $message);
		}
	
		$message = make_clickable($message);
	
		$orig_word = $replacement_word = array();
		obtain_word_list($orig_word, $replacement_word);
	
		if (!empty($orig_word))
		{
			$subject = preg_replace($orig_word, $replacement_word, $subject);
			$message = preg_replace($orig_word, $replacement_word, $message);
		}
	
		if ($board_config['allow_smilies'] && $row['privmsgs_enable_smilies'])
		{
			$message = smilies_pass($message);
		}
	
		$message = str_replace("\n", '<br />', $message);
	}
}

?>