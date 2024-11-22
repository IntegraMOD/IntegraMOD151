<?php

class report_user extends report_module
{
	var $mode = 'reportuser';
	var $duplicates = true;
	
    // Declare properties explicitly
    public $id;
    public $data;
    public $lang;
	
	//
	// Constructor
	//
	function __construct($id, $data, $lang)
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
	// Returns the reportee user id
	//
	function reportee_obtain($report_subject)
	{
		return get_userdata($report_subject);
	}

	/*
	//
	// Returns report subject title
	// V: removed this, the new reportee feature does this just fine...
	//
	function subject_obtain($report_subject)
	{
		global $db, $agcm_color;
		
		$sql = 'SELECT username, user_group_id, user_session_time
			FROM ' . USERS_TABLE . '
			WHERE user_id = ' . (int) $report_subject;
		if (!$result = $db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Could not obtain report subject', '', __LINE__, __FILE__, $sql);
		}

		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);
		
		return ($row) ? $agcm_color->get_user_color($row['user_group_id'], $row['user_session_time'], $row['username']) : false;
	}
	*/
}

?>
