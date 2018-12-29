<?php

class report_user extends report_module
{
	var $mode = 'reportuser';
	var $duplicates = true;
	
	//
	// Constructor
	//
	function report_user($id, $data, $lang)
	{
		$this->id = $id;
		$this->data = $data;
		$this->lang = $lang;
	}
	
	//
	// Returns url to a report subject
	//
	function subject_url($id, $non_html_amp = false)
	{
		global $phpEx;
		
		$sep = ($non_html_amp) ? '&' : '&amp;';
		return append_sid("profile.$phpEx?mode=viewprofile$sep" . POST_USERS_URL . '=' . (int) $id, $non_html_amp);
	}
	
	//
	// Returns report subject title
	//
	function subject_obtain($report_subject)
	{
		global $db;
		
		$sql = 'SELECT username
			FROM ' . USERS_TABLE . '
			WHERE user_id = ' . (int) $report_subject;
		if (!$result = $db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Could not obtain report subject', '', __LINE__, __FILE__, $sql);
		}

		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);
		
		return ($row) ? $row['username'] : false;
	}
}

?>