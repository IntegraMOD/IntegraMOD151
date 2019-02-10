<?php

// V: function made so that 
function report_integrate_with_qbar($data)
{
	global $template, $images;
	$template->set_filenames(array(
		'report_menu' => 'report_menu_qbar.tpl'
	));
	return $template->render_to_string('report_menu');
}

//
// Little helper function: Converts all ids in an array to valid integers
//
function report_prepare_ids(&$ids)
{
	if (is_array($ids))
	{
		foreach (array_keys($ids) as $key)
		{
			$ids[$key] = (int) $ids[$key];
		}
	}
	else
	{
		$ids = array((int) $ids);
	}
}

//
// Another helper function: Prepares a report subjects array
//
function report_prepare_subjects(&$subjects, $strip_data = false)
{
	$temp = array();
	
	if ($strip_data)
	{
		foreach ($subjects as $report_id => $report_subject)
		{
			$temp[(int) $report_id] = (int) $report_subject[0];
		}
	}
	else
	{
		foreach ($subjects as $report_id => $report_subject)
		{
			$temp[(int) $report_id] = array(
				(int) $report_subject[0],
				$report_subject[1]);
		}
	}

	$subjects = $temp;
}

//
// Reads modules from cache file
//
function report_modules_cache_read()
{
	global $phpbb_root_path, $phpEx;
	
	$cache_file = $phpbb_root_path . "cache/report_modules.$phpEx";
	
	if (file_exists($cache_file))
	{
		include($cache_file);
	}
	
	return (isset($modules)) ? $modules : false;
}

//
// Writes modules to cache file
//
function report_modules_cache_write($modules)
{
	global $phpbb_root_path, $phpEx;
	
	if (!function_exists('var_export'))
	{
		return false;
	}
	
	$content = "<?php\n";
	$content .= "if (!defined('IN_PHPBB'))\n{\n";
	$content .= "die('Hacking attempt');\n";
	$content .= "}\n";
	$content .= '$modules = ' . var_export($modules, true) . ";\n";
	$content .= '?>';

	$cache_file = $phpbb_root_path . "cache/report_modules.$phpEx";

	if (!$handle = fopen($cache_file, 'w'))
	{
		return false;
	}
	
	if (!fwrite($handle, $content))
	{
		return false;
	}
	
	fclose($handle);
	
	return true;
}

//
// Deletes modules cache file
//
function report_modules_cache_clean()
{
	global $phpbb_root_path, $phpEx;
	
	$cache_file = $phpbb_root_path . "cache/report_modules.$phpEx";
	
	if (file_exists($cache_file))
	{
		unlink($cache_file);
	}
}

//
// Obtains modules from the database
//
function report_modules_obtain()
{
	global $db;
	
	$sql = 'SELECT report_module_id, report_module_order, report_module_notify, report_module_prune, report_module_last_prune,
			report_module_name, auth_write, auth_view, auth_notify, auth_delete
		FROM ' . REPORTS_MODULES_TABLE . '
		ORDER BY report_module_order';
	if (!$result = $db->sql_query($sql, false, 'advanced_report_hack_modules'))
	{
		message_die(GENERAL_ERROR, 'Could not obtain report modules', '', __LINE__, __FILE__, $sql);
	}
	
	$modules = $db->sql_fetchrowset($result);
	$db->sql_freeresult($result);
	
	if (empty($modules))
	{
		return array();
	}
	
	return $modules;
}

//
// Obtains report modules from the database or the cache, includes modules and
// stores module objects
//
function report_modules($mode = 'all', $module = null)
{
	global $phpbb_root_path, $phpEx, $board_config;
	static $modules;
	static $module_names;
	
	if (!isset($modules))
	{
		include_once($phpbb_root_path . "includes/report_module.$phpEx");
		
		if (!$board_config['report_modules_cache'] || !$rows = report_modules_cache_read())
		{
			$rows = report_modules_obtain();
			
			if ($board_config['report_modules_cache'])
			{
				report_modules_cache_write($rows);
			}
		}
		
		$modules = $module_names = array();
		foreach ($rows as $row)
		{
			// Include module file
			$row['report_module_name'] = basename($row['report_module_name']);
			include_once($phpbb_root_path . 'includes/report_hack/' . $row['report_module_name'] . ".$phpEx");
			
			// Include language file
			$lang = array();
			
			$lang_file = $phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/report_hack/lang_' . $row['report_module_name'] . ".$phpEx";
			if (file_exists($lang_file))
			{
				include($lang_file);
			}
			
			// Create module object
			$modules[$row['report_module_id']] = new $row['report_module_name']($row['report_module_id'], $row, $lang);
			
			// Add module name to convert array
			$module_names[$row['report_module_name']] = $row['report_module_id'];
			
			// Delete old reports
			if ($row['report_module_prune'] && $row['report_module_last_prune'] + ($row['report_module_prune'] * 3600) < time())
			{
				report_prune($row['report_module_id'], $row['report_module_prune'] * 86400);
				
				if ($board_config['report_modules_cache'])
				{
					report_modules_cache_clean();
				}
			}
		}
	}
	
	switch ($mode)
	{
		case 'all':
			return $modules;
		break;
		
		case 'names':
			return $module_names;
		break;
		
		case 'name':
		case 'id':
			if (!isset($module))
			{
				return false;
			}
			
			$key = ($mode == 'name') ? $module_names[$module] : $module;
			return (isset($modules[$key])) ? $modules[$key] : false;
		break;
		
		default:
			return false;
		break;
	}
}

//
// Checks the authorisation for multiple reports, returns array with report ids
//
function reports_auth_check(&$reports, $auth_names = 'auth_view', $subject_auth = true)
{
	global $board_config;
	
	if (!is_array($reports))
	{
		return array();
	}
	
	$auth_check_array = $reports_data = array();
	foreach ($reports as $report)
	{
		if (!isset($auth_check_array[$report['report_module_id']]))
		{
			$auth_check_array[$report['report_module_id']] = array();
		}
		
		$auth_check_array[$report['report_module_id']][$report['report_id']] = array($report['report_subject'], $report['report_subject_data']);
		
		$reports_data[$report['report_id']] = $report;
	}
	
	$reports = $report_ids = array();
	
	$report_modules = report_modules();
	foreach ($auth_check_array as $report_module_id => $report_subjects)
	{
		$report_module =& $report_modules[$report_module_id];
		
		//
		// Check module authorisation
		//
		if (!$report_module->auth_check($auth_names))
		{
			continue;
		}
		
		//
		// Check subject authorisation
		//
		if ($subject_auth && $board_config['report_subject_auth'])
		{
			$report_module->subjects_auth_check($report_subjects);
			if (empty($report_subjects))
			{
				continue;
			}
		}
		
		foreach (array_keys($report_subjects) as $report_id)
		{
			$reports[] = $reports_data[$report_id];
			$report_ids[] = $report_id;
		}
	}
	
	return $report_ids;
}

//
// Executes a module action
//
function reports_module_action($reports, $action_name, $action_params = array())
{
	if (!is_array($reports))
	{
		return;
	}
	
	if (!is_array($action_params))
	{
		$action_params = array(null, $action_params);
	}
	else
	{
		array_unshift($action_params, null);
	}
	
	$report_modules_subjects = array();
	foreach ($reports as $report)
	{
		if (!isset($report_modules_subjects[$report['report_module_id']]))
		{
			$report_modules_subjects[$report['report_module_id']] = array();
		}
		
		$report_modules_subjects[$report['report_module_id']][$report['report_id']] = array($report['report_subject'], $report['report_subject_data']);
	}
	
	$report_modules = report_modules();
	foreach ($report_modules_subjects as $report_module_id => $report_subjects)
	{
		$report_module =& $report_modules[$report_module_id];
		
		if (method_exists($report_module, "action_$action_name"))
		{
			$action_params[0] = $report_subjects;
			call_user_func_array(array($report_module, "action_$action_name"), $action_params);
		}
	}
}

//
// Handles email notifications, note that this function has variable parameters
// Includes authorisation check
//
function report_notify($mode/*, ...*/)
{
	global $phpbb_root_path, $phpEx, $db, $userdata, $board_config;
	
	$num_args = func_num_args();
	$notify_users = $reports = array();
	
	switch ($mode)
	{
		case 'new':
			if ($num_args < 2)
			{
				return false;
			}
			
			$report = func_get_arg(1);
			$reports[$report['report_id']] =& $report;
			
			// get module object
			$report_module = report_modules('id', $report['report_module_id']);
			
			//
			// Check if notifications are enabled
			//
			if (!$report_module->data['report_module_notify'])
			{
				break;
			}
			
			//
			// Obtain report reason description
			//
			if ($report['report_reason_id'])
			{
				$sql = 'SELECT report_reason_desc
					FROM ' . REPORTS_REASONS_TABLE . '
					WHERE report_reason_id = ' . $report['report_reason_id'];
				if (!$result = $db->sql_query($sql))
				{
					message_die(GENERAL_ERROR, 'Could not obtain report reason desc', '', __LINE__, __FILE__, $sql);
				}
				
				$row = $db->sql_fetchrow($result);
				$db->sql_freeresult($result);
				
				$report['report_reason_desc'] = ($row) ? $row['report_reason_desc'] : '';
			}
			else
			{
				$report['report_reason_desc'] = '';
			}
			
			//
			// Obtain notification users
			//
			$user_level_sql = ($board_config['report_list_admin']) ? '= ' . ADMIN : 'IN(' . ADMIN . ', ' . MOD . ')';
			$sql = 'SELECT user_id, user_level, user_email, user_lang, user_timezone, user_dateformat
				FROM ' . USERS_TABLE . '
				WHERE user_active = 1
					AND user_level ' . $user_level_sql . '
					AND user_id <> ' . $userdata['user_id'];
			if (!$result = $db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, 'Could not obtain administrators and moderators', '', __LINE__, __FILE__, $sql);
			}
			
			$notify_users[$report['report_id']] = array();
			while ($row = $db->sql_fetchrow($result))
			{
				//
				// Check module authorisation
				//
				if (!$report_module->auth_check(array('auth_view', 'auth_notify'), $row))
				{
					continue;
				}
				
				//
				// Check subject authorisation
				//
				if ($board_config['report_subject_auth'])
				{
					$report_subject = array($report['report_id'] => array($report['report_subject'], $report['report_subject_data']));
					if (!$report_module->subjects_auth_check($report_subject, $row))
					{
						continue;
					}
				}
				
				$notify_users[$report['report_id']][] = $row;
			}
			$db->sql_freeresult($result);
			
			// specify email template
			$email_template = 'report_new';
		break;
		
		case 'change':
			if ($num_args < 3)
			{
				return false;	
			}
			
			$status = func_get_arg(1);
			
			$report_ids = func_get_arg(2);
			report_prepare_ids($report_ids);
			
			//
			// Obtain report information
			//
			$sql = 'SELECT r.report_id, r.report_module_id, r.report_subject, r.report_subject_data, r.report_title, r.report_desc,
					rc.report_change_time, rc.report_change_comment, u.username, u.user_group_id, u.user_session_time
				FROM ' . REPORTS_TABLE . ' r
				INNER JOIN ' . REPORTS_CHANGES_TABLE . ' rc
					ON rc.report_change_id = r.report_last_change
				INNER JOIN ' . USERS_TABLE . ' u
					ON u.user_id = rc.user_id
				WHERE r.report_id IN(' . implode(', ', $report_ids) . ')';
			if (!$result = $db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, 'Could not obtain report information', '', __LINE__, __FILE__, $sql);
			}
			
			$auth_check_array = array();
			while ($row = $db->sql_fetchrow($result))
			{
				if (isset($row['report_subject_data']))
				{
					$row['report_subject_data'] = unserialize($row['report_subject_data']);
				}
				
				if (!isset($auth_check_array[$row['report_module_id']]))
				{
					$auth_check_array[$row['report_module_id']] = array();
				}

				$auth_check_array[$row['report_module_id']][$row['report_id']] = array($row['report_subject'], $row['report_subject_data']);
				
				$reports[$row['report_id']] = $row;
			}
			$db->sql_freeresult($result);
			
			//
			// Obtain notification users
			//
			$user_level_sql = ($board_config['report_list_admin']) ? '= ' . ADMIN : 'IN(' . ADMIN . ', ' . MOD . ')';
			$sql = 'SELECT user_id, user_level, user_email, user_lang, user_dateformat, user_timezone
				FROM ' . USERS_TABLE . '
				WHERE user_active = 1
					AND user_level ' . $user_level_sql . '
					AND user_id <> ' . $userdata['user_id'];
			if (!$result = $db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, 'Could not obtain administrators and moderators', '', __LINE__, __FILE__, $sql);
			}
			
			$auth_options = array('auth_view', 'auth_notify');
			if ($status == REPORT_DELETE)
			{
				$auth_options[] = 'auth_delete';
			}
			
			$report_modules = report_modules();
			
			while ($row = $db->sql_fetchrow($result))
			{
				foreach ($auth_check_array as $report_module_id => $report_subjects)
				{
					$report_module =& $report_modules[$report_module_id];
					
					//
					// Check if notifications are enabled
					//
					if (!$report_module->data['report_module_notify'])
					{
						continue;
					}
					
					//
					// Check module authorisation
					//
					if (!$report_module->auth_check($auth_options, $row))
					{
						continue;
					}
					
					//
					// Check subject authorisation
					//
					if ($board_config['report_subject_auth'])
					{
						$report_module->subjects_auth_check($report_subjects, $row);
					}
					
					//
					// Add users
					//
					foreach (array_keys($report_subjects) as $report_id)
					{
						if (!isset($notify_users[$report_id]))
						{
							$notify_users[$report_id] = array();
						}
						
						$notify_users[$report_id][] = $row;
					}
				}
			}
			$db->sql_freeresult($result);
			
			// specify email template
			$email_template = 'report_change';
		break;
		
		default:
			return false;
		break;
	}

	if (empty($notify_users))
	{
		return true;
	}
	
	// Sixty second limit
	@set_time_limit(60);

	//
	// Let's do some checking to make sure that mass mail functions
	// are working in win32 versions of php.
	//
	if (preg_match('/[c-z]:\\\.*/i', getenv('PATH')) && !$board_config['smtp_delivery'])
	{
		$ini_val = (@phpversion() >= '4.0.0') ? 'ini_get' : 'get_cfg_var';

		// We are running on windows, force delivery to use our smtp functions
		// since php's are broken by default
		$board_config['smtp_delivery'] = 1;
		$board_config['smtp_host'] = @$ini_val('SMTP');
	}

	include_once($phpbb_root_path . "includes/emailer.$phpEx");
	$emailer = new emailer($board_config['smtp_delivery']);

	$server_name = trim($board_config['server_name']);
	$server_protocol = ($board_config['cookie_secure']) ? 'https://' : 'http://';
	$server_port = ($board_config['server_port'] <> 80) ? ':' . trim($board_config['server_port']) . '/' : '/';
	$script_path = preg_replace('#^/?(.*?)/?$#', '$1', trim($board_config['script_path']));
	$script_path .= ($script_path != '') ? '/' : '';
	$server_full = $server_protocol . $server_name . $server_port . $script_path;

	$emailer->from($board_config['board_email']);
	$emailer->replyto($board_config['board_email']);
	
	//
	// Send emails
	//
	foreach ($notify_users as $report_id => $report_notify_users)
	{
		$report =& $reports[$report_id];
		foreach ($report_notify_users as $user_info)
		{
			$emailer->use_template($email_template, $user_info['user_lang']);
			$emailer->email_address($user_info['user_email']);
			
			// Get language variables
			$lang =& report_notify_lang($user_info['user_lang']);
			
			//
			// Set email variables
			// we use $vars here because of an emailer bug
			//
			$vars = array(
				'EMAIL_SIG' => (!empty($board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']) : '',
				'SITENAME' => $board_config['sitename'],
				
				'REPORT_TITLE' => $report['report_title'],
				'REPORT_TEXT' => $report['report_desc'],
				
				'U_REPORT_VIEW' => $server_full . "report.$phpEx?" . POST_REPORT_URL . "=$report_id");
			
			switch ($mode)
			{
				case 'new':
					if ($report['report_reason_desc'])
					{
						$report_reason = (isset($lang[$report['report_reason_desc']])) ? $lang[$report['report_reason_desc']] : $report['report_reason_desc'];
					}
					else
					{
						$report_reason = '-';
					}
				
					$vars = array_merge($vars, array(
						'REPORT_AUTHOR' => $userdata['username'],
						'REPORT_TIME' => create_date($user_info['user_dateformat'], $report['report_time'], $user_info['user_timezone']),
						'REPORT_REASON' => $report_reason)
					);
				break;
				
				case 'change':
					$vars = array_merge($vars, array(
						'REPORT_CHANGE_AUTHOR' => $report['username'],
						'REPORT_CHANGE_TIME' => create_date($user_info['user_dateformat'], $report['report_change_time'], $user_info['user_timezone']),
						'REPORT_CHANGE_STATUS' => $lang['Report_status'][$status],
						'REPORT_CHANGE_COMMENT' => str_replace(array("\r\n", "\r", "\n"), ' ', $report['report_change_comment']))
					);
				break;
			}
			
			$emailer->assign_vars($vars);

			$emailer->send();
			$emailer->reset();
		}
	}
	
	return true;
}

//
// Helper function for report_notify(), returns general language variable for the specified
// language
//
function &report_notify_lang($language)
{
	global $phpbb_root_path, $phpEx, $board_config;
	static $languages = array();
	
	if (!isset($languages[$language]))
	{
		if ($board_config['default_lang'] == $language)
		{
			global $lang;
		}
		else
		{
			$lang = array();
			include($phpbb_root_path . 'language/lang_' . $language . "/lang_main.$phpEx");
		}
		
		$languages[$language] = $lang;
	}
	
	return $languages[$language];
}

//
// Obtains count of new and open reports
// Includes authorisation check
//
function report_count_obtain()
{
	global $db, $userdata, $board_config;
	static $report_count;
	
	if (isset($report_count))
	{
		return $report_count;
	}
	
	if ($userdata['user_level'] == ADMIN)
	{
		$sql = 'SELECT COUNT(report_id) AS report_count
			FROM ' . REPORTS_TABLE . '
			WHERE report_status IN(' . REPORT_NEW . ', ' . REPORT_OPEN . ')';
		if (!$result = $db->sql_query($sql, false, 'advanced_report_hack'))
		{
			message_die(GENERAL_ERROR, 'Could not obtain report count', '', __LINE__, __FILE__, $sql);
		}
		
		$report_count_row = $db->sql_fetchrow($result);
		$report_count = $report_count_row['report_count'];
		$db->sql_freeresult($result);
	}
	else if ($userdata['user_level'] != MOD)
	{
		$report_count = 0;
	}
	else if (!$board_config['report_subject_auth'])
	{
		$sql = 'SELECT COUNT(r.report_id) AS report_count
			FROM ' . REPORTS_TABLE . ' r
			INNER JOIN ' . REPORTS_MODULES_TABLE . ' rm
				ON rm.report_module_id = r.report_module_id
			WHERE report_status IN(' . REPORT_NEW . ', ' . REPORT_OPEN . ')
				AND rm.auth_view <= ' . REPORT_AUTH_MOD;
		if (!$result = $db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Could not obtain report count', '', __LINE__, __FILE__, $sql);
		}
		
		$report_count = $db->sql_fetchfield('report_count', 0, $result);
		$db->sql_freeresult($result);
	}
	else
	{
		$sql = 'SELECT report_id, report_module_id, report_subject, report_subject_data
			FROM ' . REPORTS_TABLE . '
			WHERE report_status IN(' . REPORT_NEW . ', ' . REPORT_OPEN . ')';
		if (!$result = $db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Could not check report auth', '', __LINE__, __FILE__, $sql);
		}
		
		$reports = $db->sql_fetchrowset($result);
		$db->sql_freeresult($result);
		
		if (!empty($reports))
		{
			for ($i = 0, $count = count($reports); $i < $count; $i++)
			{
				if (isset($reports[$i]['report_subject_data']))
				{
					$reports[$i]['report_subject_data'] = unserialize($reports[$i]['report_subject_data']);
				}
			}
			
			reports_auth_check($reports);
			$report_count = count($reports);
		}
		else
		{
			$report_count = 0;
		}
	}

	return $report_count;
}


//
// Obtains reports (for a specific report module if $module_id is defined)
// Includes authorisation check if $auth_check is set to true.
//
function reports_obtain($module_id = null, $auth_check = true, $reportee = null)
{
	global $db;

	$where_sql = (isset($module_id)) ? ' AND r.report_module_id = ' . (int) $module_id : '';
	if ($reportee)
	{
		$where_sql .= ' AND r.reportee_user_id = ' . (int) $reportee;
	}
	$sql = 'SELECT r.report_id, r.user_id, r.report_time, r.report_module_id, r.report_status, r.report_subject,
			r.report_subject_data, r.report_title, u.username, u.user_group_id, u.user_session_time
		FROM ' . REPORTS_TABLE . ' r
		LEFT JOIN ' . USERS_TABLE . ' u
			ON u.user_id = r.user_id
		WHERE r.report_status <> ' . REPORT_DELETE . "
			$where_sql
		ORDER BY r.report_status ASC, r.report_time DESC";
	if (!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not obtain reports', '', __LINE__, __FILE__, $sql);
	}
	
	$rows = $db->sql_fetchrowset($result);
	$db->sql_freeresult($result);
	
	if (empty($rows))
	{
		return array();
	}
	
	for ($i = 0, $count = count($rows); $i < $count; $i++)
	{
		if (isset($rows[$i]['report_subject_data']))
		{
			$rows[$i]['report_subject_data'] = unserialize($rows[$i]['report_subject_data']);
		}
	}
	
	//
	// Check authorisation
	//
	if ($auth_check)
	{
		reports_auth_check($rows);
	}
	
	//
	// Prepare reports array
	//
	$reports = array();
	foreach ($rows as $row)
	{
		if (!isset($reports[$row['report_module_id']]))
		{
			$reports[$row['report_module_id']] = array();
		}
		
		$reports[$row['report_module_id']][] = $row;
	}
	
	return $reports;
}

//
// Obtains open reports
// Includes authorisation check if $auth_check is set to true.
//
function reports_open_obtain($module_id, $report_subject, $auth_check = true)
{
	global $db;
	
	$sql = 'SELECT r.report_id, r.user_id, r.report_time, r.report_module_id, r.report_status, r.report_subject, r.reportee_user_id, r.reportee_username,
			r.report_subject_data, r.report_title, u.username, u.user_group_id, u.user_session_time
		FROM ' . REPORTS_TABLE . ' r
		LEFT JOIN ' . USERS_TABLE . ' u
			ON u.user_id = r.user_id
		WHERE r.report_status NOT IN(' . REPORT_CLEARED . ', ' . REPORT_DELETE . ')
			AND r.report_module_id = ' . (int) $module_id . '
			AND r.report_subject = ' . (int) $report_subject . '
		ORDER BY r.report_status ASC, r.report_time DESC';
	if (!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not obtain open reports', '', __LINE__, __FILE__, $sql);
	}
	
	$reports = $db->sql_fetchrowset($result);
	$db->sql_freeresult($result);
	
	if (empty($reports))
	{
		return array();
	}
	
	for ($i = 0, $count = count($reports); $i < $count; $i++)
	{
		if (isset($reports[$i]['report_subject_data']))
		{
			$reports[$i]['report_subject_data'] = unserialize($reports[$i]['report_subject_data']);
		}
	}
	
	//
	// Check authorisation
	//
	if ($auth_check)
	{
		reports_auth_check($reports);
	}
	
	return $reports;
}

//
// Obtains reports suggested for deletion
// Includes authorisation check if $auth_check is set to true.
//
function reports_deleted_obtain($auth_check = true)
{
	global $db;
	
	$sql = 'SELECT r.report_id, r.user_id, r.report_time, r.report_module_id, r.report_subject, r.reportee_user_id, r.reportee_username,
			r.report_subject_data, r.report_title, u.username, u.user_group_id, u.user_session_time
		FROM ' . REPORTS_TABLE . ' r
		LEFT JOIN ' . USERS_TABLE . ' u
			ON u.user_id = r.user_id
		WHERE r.report_status = ' . REPORT_DELETE . '
		ORDER BY r.report_time DESC';
	if (!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not obtain deleted reports', '', __LINE__, __FILE__, $sql);
	}
	
	$reports = $db->sql_fetchrowset($result);
	$db->sql_freeresult($result);
	
	if (empty($reports))
	{
		return array();
	}
	
	for ($i = 0, $count = count($reports); $i < $count; $i++)
	{
		if (isset($reports[$i]['report_subject_data']))
		{
			$reports[$i]['report_subject_data'] = unserialize($reports[$i]['report_subject_data']);
		}
	}
	
	//
	// Check authorisation
	//
	if ($auth_check)
	{
		reports_auth_check($reports, array('auth_view', 'auth_delete'));
	}
	
	return $reports;
}

//
// Obtains report information for the specified report.
// Includes authorisation check if $auth_check is set to true.
//
function report_obtain($report_id, $auth_check = true)
{
	global $db, $board_config, $lang;
	
	$sql = 'SELECT r.report_id, r.user_id, r.report_time, r.report_module_id, r.report_status, r.report_subject, r.reportee_user_id, r.reportee_username,
			r.report_subject_data, r.report_title, r.report_desc, rr.report_reason_desc, u.username, u.user_group_id, u.user_session_time
		FROM ' . REPORTS_TABLE . ' r
		LEFT JOIN ' . REPORTS_REASONS_TABLE . ' rr
			ON rr.report_reason_id = r.report_reason_id
		LEFT JOIN ' . USERS_TABLE . ' u
			ON u.user_id = r.user_id
		WHERE r.report_id = ' . (int) $report_id;
	if (!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not obtain report', '', __LINE__, __FILE__, $sql);
	}
	
	$report = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);
	
	if (!$report)
	{
		return false;
	}
	
	if (isset($report['report_subject_data']))
	{
		$report['report_subject_data'] = unserialize($report['report_subject_data']);
	}
	
	if (isset($report['report_reason_desc']) && isset($lang[$report['report_reason_desc']]))
	{
		$report['report_reason_desc'] = $lang[$report['report_reason_desc']];
	}
	
	//
	// Check authorisation
	//
	if ($auth_check)
	{
		$auth_names = ($report['report_status'] == REPORT_DELETE) ? array('auth_view', 'auth_delete') : 'auth_view';
		$reports = array($report);
		
		reports_auth_check($reports, $auth_names);
		
		return (!empty($reports)) ? $reports[0] : false;
	}
	else
	{
		return $report;
	}
}

//
// Returns report changes for the specified report.
// Doesn't include authorisation check
//
function report_changes_obtain($report_id)
{
	global $db;
	
	$sql = 'SELECT rc.user_id, rc.report_change_time, rc.report_status, rc.report_change_comment,
			u.username, u.user_group_id, u.user_session_time
		FROM ' . REPORTS_CHANGES_TABLE . ' rc
		LEFT JOIN ' . USERS_TABLE . ' u
			ON u.user_id = rc.user_id
		WHERE rc.report_id = ' . (int) $report_id . '
		ORDER BY rc.report_change_time';
	if (!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not obtain report changes', '', __LINE__, __FILE__, $sql);
	}

	$report_changes = $db->sql_fetchrowset($result);
	$db->sql_freeresult($result);
	
	if (empty($report_changes))
	{
		return array();
	}
	
	return $report_changes;
}

//
// Checks if there is a duplicate report
//
function report_duplicate_check($module_id, $report_subject)
{
	global $db;
	
	$sql = 'SELECT COUNT(report_id) AS count
		FROM ' . REPORTS_TABLE . '
		WHERE report_module_id = ' . (int) $module_id . '
			AND report_subject = ' . (int) $report_subject . '
			AND report_status NOT IN(' . REPORT_CLEARED . ', ' . REPORT_DELETE . ')';
	if (!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not check for duplicate reports', '', __LINE__, __FILE__, $sql);
	}
	
	$count = $db->sql_fetchfield('count', 0, $result);
	$db->sql_freeresult($result);
	
	return ($count > 0);
}

//
// Deletes old reports
//
function report_prune($module_id, $prune_time)
{
	global $db;
	
	//
	// Obtain old reports
	//
	$sql = 'SELECT r.report_id, r.report_module_id, r.report_subject, r.report_subject_data
		FROM ' . REPORTS_TABLE . ' r
		INNER JOIN ' . REPORTS_CHANGES_TABLE . ' rc
			ON rc.report_change_id = r.report_last_change
		WHERE r.report_module_id = ' . (int) $module_id . '
			AND r.report_status IN(' . REPORT_CLEARED . ', ' . REPORT_DELETE . ')
			AND rc.report_change_time < ' . (time() - (int) $prune_time);
	if (!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not obtain old reports', '', __LINE__, __FILE__, $sql);
	}
	
	$reports = $report_ids = array();
	while ($row = $db->sql_fetchrow($result))
	{
		$reports[] = $row;
		$report_ids[] = $row['report_id'];
	}
	$db->sql_freeresult($result);
	
	// Execute module action
	reports_module_action($reports, 'delete');
	
	// Delete reports
	reports_delete($report_ids, false, false);
	
	//
	// Set last prune date
	//
	$sql = 'UPDATE ' . REPORTS_MODULES_TABLE . '
		SET report_module_last_prune = ' . time() . '
		WHERE report_module_id = ' . (int) $module_id;
	if (!$db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not delete old reports', '', __LINE__, __FILE__, $sql);
	}
}

//
// Updates a report's reportee
// Does check if the reportee_ is NULL, and does nothing then (can't unset a reportee)
// Does not check whether it's overriding a report with a reportee already
//
function report_update_reportee($report_id, $reportee)
{
	global $db;
	if (empty($reportee))
	{
		return;
	}

	$sql = 'UPDATE ' . REPORTS_TABLE . '
		SET reportee_user_id = ' . intval($reportee['user_id']) . ",
			reportee_username = '" . str_replace("'", "''", $reportee['username']) . "'
		WHERE report_id = " . intval($report_id);
	if (!$db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not insert report', '', __LINE__, __FILE__, $sql);
	}
}

//
// Inserts a new report
// Includes authorisation check if $auth_check is set to true.
//
function report_insert($module_id, $report_subject, $report_reason, $report_title, $report_desc, $auth_check = true, $module_action = true, $notify = true)
{
	global $db, $userdata, $board_config;
	
	$report_module = report_modules('id', $module_id);
	
	//
	// Check authorisation
	//
	if ($auth_check && !$report_module->auth_check('auth_write'))
	{
		return false;
	}
	
	if (method_exists($report_module, 'subject_data_obtain'))
	{
		$report_subject_data = $report_module->subject_data_obtain($report_subject);
		
		if (is_array($report_subject_data))
		{
			$report_subject_data_sql = "'" . str_replace("\'", "''", addslashes(serialize($report_subject_data))) . "'";
		}
		else
		{
			$report_subject_data_sql = 'NULL';
		}
	}
	else
	{
		$report_subject_data = null;
		$report_subject_data_sql = 'NULL';
	}

	if (method_exists($report_module, 'reportee_obtain'))
	{
		$reportee_data = $report_module->reportee_obtain($report_subject);
		$reportee_id_sql = $reportee_data ? $reportee_data['user_id'] : 'NULL';
		$reportee_username_sql = $reportee_data ? str_replace("'", "''", $reportee_data['username']) : 'NULL';
	}
	else
	{
		$reportee_id_sql = 'NULL';
		$reportee_username_sql = 'NULL';
	}
	
	//
	// Insert report
	//
	$sql = 'INSERT INTO ' . REPORTS_TABLE . ' (user_id, report_time, report_module_id, report_status, report_reason_id, 
		report_subject, report_subject_data, report_title, report_desc, reportee_user_id, reportee_username)
		VALUES (' . $userdata['user_id'] . ', ' . time() . ', ' . (int) $module_id . ', ' . REPORT_NEW . ', ' . (int) $report_reason . ',
			' . (int) $report_subject . ", $report_subject_data_sql, '" . str_replace("'", "''", $report_title) . "',
			'" . str_replace("'", "''", $report_desc) . "', $reportee_id_sql, $reportee_username_sql)";
	if (!$db->sql_query($sql, BEGIN_TRANSACTION))
	{
		message_die(GENERAL_ERROR, 'Could not insert report', '', __LINE__, __FILE__, $sql);
	}
	
	$report_id = $db->sql_nextid();
	
	$report = array(
		'report_id' => $report_id,
		'report_time' => time(),
		'report_module_id' => $module_id,
		'report_reason_id' => $report_reason,
		'report_subject' => $report_subject,
		'report_subject_data' => $report_subject_data,
		'report_title' => $report_title,
		'report_desc' => $report_desc);
	
	//
	// Execute module action
	//
	if ($module_action)
	{
		$report_module = report_modules('id', $module_id);
		if (method_exists($report_module, 'action_insert'))
		{
			$report_module->action_insert($report_subject, $report_id, $report_subject_data);
		}
	}
	
	$db->sql_query('', END_TRANSACTION);
	
	//
	// Send report notifications
	//
	if ($notify && ($board_config['report_notify'] == REPORT_NOTIFY_NEW || $board_config['report_notify'] == REPORT_NOTIFY_CHANGE))
	{	
		report_notify('new', $report);
	}
	
	//
	// Increase report counter
	//
	if (isset($board_config['report_hack_count']))
	{
		$sql = 'UPDATE ' . CONFIG_TABLE . "
			SET config_value = config_value + 1
			WHERE config_name = 'report_hack_count'";
		if (!$db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Could not update report hack count', '', __LINE__, __FILE__, $sql);
		}
	}
	
	return $report_id;
}

//
// Updates the status of the specified reports to $report_status, also inserts report status changes (with $comment)
// Includes authorisation check if $auth_check is set to true.
//
function reports_update_status($report_ids, $report_status, $comment = '', $auth_check = true, $module_action = true, $notify = true)
{
	global $db, $userdata, $board_config;
	
	report_prepare_ids($report_ids);
	$report_status = (int) $report_status;
	
	if (empty($report_ids))
	{
		return;
	}
	
	if ($auth_check || $module_action)
	{
		$sql = 'SELECT report_id, report_module_id, report_subject, report_subject_data
			FROM ' . REPORTS_TABLE . '
			WHERE report_id IN(' . implode(', ', $report_ids) . ')';
		if (!$result = $db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Could not obtain reports', '', __LINE__, __FILE__, $sql);
		}
		
		$reports = $db->sql_fetchrowset($result);
		$db->sql_freeresult($result);
		
		if (empty($reports))
		{
			return;
		}
	}
	
	//
	// Check authorisation
	//
	if ($auth_check)
	{
		$report_ids = reports_auth_check($reports);
	}
	
	if (empty($report_ids))
	{
		return;
	}

	// V: fixed transactions
	$db->sql_query('SELECT 1', BEGIN_TRANSACTION);

	//
	// Insert report status changes and update reports
	//
	$comment = str_replace("'", "''", $comment);
	foreach ($report_ids as $report_id)
	{
		$sql = 'INSERT INTO ' . REPORTS_CHANGES_TABLE . " (report_id, user_id, report_change_time, report_status, report_change_comment)
			VALUES($report_id, " . $userdata['user_id'] . ', ' . time() . ", $report_status, '$comment')";
		if (!$db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Could not insert report change', __LINE__, __FILE__, $sql);
		}
		
		$change_id = $db->sql_nextid();
		
		//
		// Update reports
		//
		$sql = 'UPDATE ' . REPORTS_TABLE . "
			SET
				report_status = $report_status,
				report_last_change = " . (int) $change_id . "
			WHERE report_id = $report_id";
		if (!$db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Could not update reports status', '', __LINE__, __FILE__, $sql);
		}
	}
	
	//
	// Execute module action
	//
	if ($module_action)
	{
		reports_module_action($reports, 'update_status', $report_status);
	}
	
	$db->sql_query('SELECT 1', END_TRANSACTION);
	
	//
	// Send report notifications
	//
	if ($notify && $board_config['report_notify'] == REPORT_NOTIFY_CHANGE)
	{
		report_notify('change', $report_status, $report_ids);
	}
}

//
// Deletes the specified reports, also deletes report status changes
// Includes authorisation check if $auth_check is set to true.
// V: TODO add an option to never *actually* delete
//
function reports_delete($report_ids, $auth_check = true, $module_action = true)
{
	global $db;
	
	report_prepare_ids($report_ids);
	
	if (empty($report_ids))
	{
		return;
	}
	
	if ($auth_check || $module_action)
	{
		$sql = 'SELECT report_id, report_status, report_module_id, report_subject, report_subject_data
			FROM ' . REPORTS_TABLE . '
			WHERE report_id IN(' . implode(', ', $report_ids) . ')';
		if (!$result = $db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Could not obtain reports', '', __LINE__, __FILE__, $sql);
		}
		
		$reports = $db->sql_fetchrowset($result);
		$db->sql_freeresult($result);
		
		if (empty($reports))
		{
			return;
		}
	}
	
	//
	// Check authorisation
	//
	if ($auth_check)
	{
		// general authorisation check
		$update_ids = reports_auth_check($reports, array('auth_view', 'auth_delete_view'));
		
		// check for auth_delete
		$report_ids = reports_auth_check($reports, 'auth_delete', false);
		
		//
		// Update reports without auth_delete
		//
		for ($i = 0, $count = count($update_ids); $i < $count; $i++)
		{
			if (in_array($update_ids[$i], $report_ids))
			{
				unset($update_ids[$i]);
			}
		}
		
		if (!empty($update_ids))
		{
			reports_update_status($update_ids, REPORT_DELETE, false, false);
		}
	}
	
	$reports_sql = implode(', ', $report_ids);
	if ($reports_sql == '')
	{
		return;
	}
	
	//
	// Delete reports
	//
	$sql = 'DELETE FROM ' . REPORTS_TABLE . "
		WHERE report_id IN($reports_sql)";
	if (!$db->sql_query($sql, BEGIN_TRANSACTION))
	{
		message_die(GENERAL_ERROR, 'Could not delete reports', '', __LINE__, __FILE__, $sql);
	}
	
	//
	// Delete report status changes
	//
	$sql = 'DELETE FROM ' . REPORTS_CHANGES_TABLE . "
		WHERE report_id IN($reports_sql)";
	if (!$db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not delete reports changes', '', __LINE__, __FILE__, $sql);
	}

	//
	// Execute module action
	//
	if ($module_action)
	{
		reports_module_action($reports, 'delete');
	}
	
	$db->sql_query('', END_TRANSACTION);
}

//
// Returns report statistics
//
function report_statistics($mode)
{
	global $db, $board_config, $lang;
	
	switch ($mode)
	{
		case 'report_hack_count':
			return $board_config[$mode];
		break;
		
		case 'report_count':
			$sql = 'SELECT COUNT(report_id) AS report_count
				FROM ' . REPORTS_TABLE;
			if (!$result = $db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, 'Could not obtain report statistics', '', __LINE__, __FILE__, $sql);
			}
			
			$report_count = $db->sql_fetchfield('report_count', 0, $result);
			$db->sql_freeresult($result);
			
			if ($report_count > $board_config['report_hack_count'])
			{
				$sql = 'UPDATE ' . CONFIG_TABLE . "
					SET config_value = '" . $report_count . "'
					WHERE config_name = 'report_hack_count'";
				$db->sql_query($sql);
				$db->clear_cache('board_config');
			}
			
			return $report_count;
		break;
		
		case 'modules_count':
			$report_modules = report_modules();
			
			return count($report_modules);
		break;
	}
	
	return $mode;
}

//
// Obtains all forums moderated by the specified user
//
function user_moderated_forums($user_id)
{
	global $db;
	static $moderators = array();
	
	if (!isset($moderators[$user_id]))
	{
		// all auth_mod of user
		$sql = 'SELECT aa.forum_id
			FROM ' . USER_GROUP_TABLE . ' ug
			INNER JOIN ' . AUTH_ACCESS_TABLE . ' aa
				ON aa.group_id = ug.group_id
			WHERE ug.user_id = ' . (int) $user_id . '
				AND aa.auth_mod = 1
			GROUP BY aa.forum_id';
		if (!$result = $db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Could not obtain moderated forums', '', __LINE__, __FILE__, $sql);
		}
		
		$moderators[$user_id] = array();
		while ($row = $db->sql_fetchrow($result))
		{
			$moderators[$user_id][] = $row['forum_id'];
		}
		$db->sql_freeresult($result);
	}
	
	return $moderators[$user_id];
}

?>