<?php

//
// Obtains report count for each report module
//
function report_counts_obtain()
{
	global $db;
	
	$sql = 'SELECT rm.report_module_id, COUNT(r.report_id) AS report_count
		FROM ' . REPORTS_MODULES_TABLE . ' rm
		LEFT JOIN ' . REPORTS_TABLE . ' r
			ON r.report_module_id = rm.report_module_id
		GROUP BY rm.report_module_id';
	if (!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not obtain report counts', '', __LINE__, __FILE__, $sql);
	}
	
	$report_counts = array();
	while ($row = $db->sql_fetchrow($result))
	{
		$report_counts[$row['report_module_id']] = $row['report_count'];
	}
	$db->sql_freeresult($result);
	
	return $report_counts;
}

//
// Obtains report reason count for each report module
//
function report_reason_counts_obtain()
{
	global $db;
	
	$sql = 'SELECT rm.report_module_id, COUNT(rr.report_reason_id) AS reason_count
		FROM ' . REPORTS_MODULES_TABLE . ' rm
		LEFT JOIN ' . REPORTS_REASONS_TABLE . ' rr
			ON rr.report_module_id = rm.report_module_id
		GROUP BY rm.report_module_id';
	if (!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not obtain report reason counts', '', __LINE__, __FILE__, $sql);
	}
	
	$report_reason_counts = array();
	while ($row = $db->sql_fetchrow($result))
	{
		$report_reason_counts[$row['report_module_id']] = $row['reason_count'];
	}
	$db->sql_freeresult($result);
	
	return $report_reason_counts;
}

//
// Obtains inactive report modules, includes modules and stores module objects
//
function report_modules_inactive($mode = 'all', $module = null)
{
	global $phpbb_root_path, $phpEx, $board_config;
	static $modules;
	
	if (!isset($modules))
	{
		include_once($phpbb_root_path . "includes/report_module.$phpEx");
		
		$installed_modules = report_modules('names');
		
		$deny_modes = array('open', 'process', 'clear', 'delete', 'reported');
		
		$dir = @opendir($phpbb_root_path . 'includes/report_hack');
		
		$modules = array();
		$i = 0;
		while ($file = @readdir($dir))
		{
			if (!preg_match('#(.*)\.' . phpbb_preg_quote($phpEx, '#') . '$#', $file, $matches))
			{
				continue;
			}
			
			// exclude installed modules
			$module_name = $matches[1];
			if (isset($installed_modules[$module_name]))
			{
				continue;
			}
			
			// include module file
			include($phpbb_root_path . "includes/report_hack/$file");
			
			// Include language file
			$lang = array();
			
			$lang_file = $phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . "/report_hack/lang_$module_name.$phpEx";
			if (file_exists($lang_file))
			{
				include($lang_file);
			}
			
			// Create module object
			$modules[$module_name] = new $module_name(0, array('module_name' => $module_name), $lang);
			
			//
			// Check validity of the module
			//
			if (!empty($modules[$module_name]->mode) && in_array($modules[$module_name]->mode, $deny_modes))
			{
				unset($modules[$module_name]);
			}
			if (!isset($modules[$module_name]->id) || !isset($modules[$module_name]->data) || !isset($modules[$module_name]->lang) || !isset($modules[$module_name]->duplicates))
			{
				unset($modules[$module_name]);
			}
		}
		
		@closedir($dir);
	}
	
	switch ($mode)
	{
		case 'all':
			return $modules;
		break;
		
		case 'name':
			if (!isset($module))
			{
				return false;
			}
			
			return (isset($modules[$module])) ? $modules[$module] : false;
		break;
		
		default:
			return false;
		break;
	}
}

//
// Generates the auth select box
//
function report_auth_select($block_name, $default, $select_items = array(REPORT_AUTH_MOD, REPORT_AUTH_ADMIN))
{
	global $lang, $template;

	foreach ($select_items as $value)
	{
		$template->assign_block_vars($block_name, array(
			'VALUE' => $value,
			'TITLE' => $lang['Report_auth'][$value],
			'SELECTED' => ($value == $default) ? ' selected="selected"' : '')
		);
	}
}

//
// Installs a report module
//
function report_module_install($module_notify, $module_prune, $module_name, $auth_write, $auth_view, $auth_notify, $auth_delete, $check = true)
{
	global $db, $board_config;
	
	//
	// Check module
	//
	if ($check)
	{
		if (!$report_module = report_modules_inactive('name', $module_name))
		{
			return false;
		}
	}
	
	//
	// Get module order
	//
	$sql = 'SELECT MAX(report_module_order) AS max_order
		FROM ' . REPORTS_MODULES_TABLE;
	if (!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not obtain max order', '', __LINE__, __FILE__, $sql);
	}
	
	$max_order = $db->sql_fetchfield('max_order', 0, $result);
	$db->sql_freeresult($result);
	
	//
	// Insert module
	//
	$sql = 'INSERT INTO ' . REPORTS_MODULES_TABLE . ' (report_module_order, report_module_notify, report_module_prune,
		report_module_name, auth_write, auth_view, auth_notify, auth_delete)
		VALUES(' . ($max_order + 1) . ', ' . (int) $module_notify . ', ' . (int) $module_prune . ",
			'" . str_replace("'", "''", $module_name) . "', " . (int) $auth_write . ', ' . (int) $auth_view . ',
			' . (int) $auth_notify . ', ' . (int) $auth_delete . ')';
	if (!$db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not install report module', '', __LINE__, __FILE__, $sql);
	}

	$module_id = $db->sql_nextid();
	
	//
	// Clean modules cache
	//
	if ($board_config['report_modules_cache'])
	{
		report_modules_cache_clean();
	}

	return $module_id;
}

//
// Edits a module
//
function report_module_edit($module_id, $module_notify, $module_prune, $auth_write, $auth_view, $auth_notify, $auth_delete)
{
	global $db, $board_config;
	
	$sql = 'UPDATE ' . REPORTS_MODULES_TABLE . '
		SET
			report_module_notify = ' . (int) $module_notify . ',
			report_module_prune = ' . (int) $module_prune . ',
			auth_write = ' . (int) $auth_write . ',
			auth_view = ' . (int) $auth_view . ',
			auth_notify = ' . (int) $auth_notify . ',
			auth_delete = ' . (int) $auth_delete . '
		WHERE report_module_id = ' . (int) $module_id;
	if (!$db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not edit report module', '', __LINE__, __FILE__, $sql);
	}
	
	//
	// Clean modules cache
	//
	if ($board_config['report_modules_cache'])
	{
		report_modules_cache_clean();
	}
}

//
// Moves a module to another position (up or down), reorders other modules
//
function report_module_move($mode, $module_id, $steps = 1)
{
	global $db, $board_config;
	
	if (!$report_module = report_modules('id', $module_id))
	{
		return false;
	}
	
	switch ($mode)
	{
		case 'up':
			$sql = 'UPDATE ' . REPORTS_MODULES_TABLE . "
				SET report_module_order = report_module_order + 1
				WHERE report_module_order >= " . ($report_module->data['report_module_order'] - (int) $steps) . '
					AND report_module_order < ' . $report_module->data['report_module_order'];
		break;
		
		case 'down':
			$sql = 'UPDATE ' . REPORTS_MODULES_TABLE . "
				SET report_module_order = report_module_order - 1
				WHERE report_module_order <= " . ($report_module->data['report_module_order'] + (int) $steps) . '
					AND report_module_order > ' . $report_module->data['report_module_order'];
		break;
		
		default:
			return false;
		break;
	}
	
	if (!$db->sql_query($sql, BEGIN_TRANSACTION))
	{
		message_die(GENERAL_ERROR, 'Could not update module order', '', __LINE__, __FILE__, $sql);
	}
	
	if ($db->sql_affectedrows())
	{
		$op = ($mode == 'up') ? '-' : '+';
		$sql = 'UPDATE ' . REPORTS_MODULES_TABLE . "
			SET report_module_order = report_module_order $op 1
			WHERE report_module_id = " . (int) $module_id;
		if (!$db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Could not update module order', '', __LINE__, __FILE__, $sql);
		}
	}
	
	$db->sql_query('', END_TRANSACTION);
	
	//
	// Clean modules cache
	//
	if ($board_config['report_modules_cache'])
	{
		report_modules_cache_clean();
	}
	
	return true;
}

//
// Uninstalls a report module
//
function report_module_uninstall($module_id)
{
	global $db, $board_config;
	
	//
	// Obtain reports in this module
	//
	$sql = 'SELECT report_id
		FROM ' . REPORTS_TABLE . '
		WHERE report_module_id = ' . (int) $module_id;
	if (!$result = $db->sql_query($sql, BEGIN_TRANSACTION))
	{
		message_die(GENERAL_ERROR, 'Could not obtain report ids', '', __LINE__, __FILE__, $sql);
	}
	
	$report_ids = array();
	while ($row = $db->sql_fetchrow($result))
	{
		$report_ids = $row['report_id'];
	}
	$db->sql_freeresult($result);
	
	// delete reports
	reports_delete($report_ids, false, false);
	
	//
	// Sync module
	//
	$report_module = report_modules('id', $module_id);
	if (method_exists($report_module, 'sync'))
	{
		$report_module->sync(true);
	}
	
	//
	// Update module order
	//
	$sql = 'UPDATE ' . REPORTS_MODULES_TABLE . '
		SET report_module_order = report_module_order - 1
		WHERE report_module_order > ' . $report_module->data['report_module_order'];
	if (!$db->sql_query($sql, BEGIN_TRANSACTION))
	{
		message_die(GENERAL_ERROR, 'Could not update module order', '', __LINE__, __FILE__, $sql);
	}
	
	//
	// Delete report reasons
	//
	$sql = 'DELETE FROM ' . REPORTS_REASONS_TABLE . '
		WHERE report_module_id = ' . (int) $module_id;
	if (!$db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not delete report reasons', '', __LINE__, __FILE__, $sql);
	}
	
	//
	// Delete module
	//
	$sql = 'DELETE FROM ' . REPORTS_MODULES_TABLE . '
		WHERE report_module_id = ' . (int) $module_id;
	if (!$db->sql_query($sql, END_TRANSACTION))
	{
		message_die(GENERAL_ERROR, 'Could not delete report module', '', __LINE__, __FILE__, $sql);
	}
	
	//
	// Clean modules cache
	//
	if ($board_config['report_modules_cache'])
	{
		report_modules_cache_clean();
	}
}

//
// Obtains a report reason
//
function report_reason_obtain($reason_id)
{
	global $db;
	
	$sql = 'SELECT report_reason_desc
		FROM ' . REPORTS_REASONS_TABLE . '
		WHERE report_reason_id = ' . (int) $reason_id;
	if (!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not obtain report reason', '', __LINE__, __FILE__, $sql);
	}
	
	$row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);
	
	return $row;
}

//
// Inserts a report reason
//
function report_reason_insert($module_id, $reason_desc)
{
	global $db;
	
	//
	// Get reason order
	//
	$sql = 'SELECT MAX(report_reason_order) AS max_order
		FROM ' . REPORTS_REASONS_TABLE;
	if (!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not obtain max order', '', __LINE__, __FILE__, $sql);
	}
	
	$max_order = $db->sql_fetchfield('max_order', 0, $result);
	$db->sql_freeresult($result);
	
	//
	// Insert reason
	//
	$sql = 'INSERT INTO ' . REPORTS_REASONS_TABLE . ' (report_module_id, report_reason_order, report_reason_desc)
		VALUES(' . (int) $module_id . ', ' . ($max_order + 1) . ", '" . str_replace("'", "''", $reason_desc) . "')";
	if (!$db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not insert report reason', '', __LINE__, __FILE__, $sql);
	}
	
	return $db->sql_nextid();
}

//
// Edits a report reason
//
function report_reason_edit($reason_id, $module_id, $reason_desc)
{
	global $db;
	
	$sql = 'UPDATE ' . REPORTS_REASONS_TABLE . '
		SET
			report_module_id = ' . (int) $module_id . ",
			report_reason_desc = '" . str_replace("'", "''", $reason_desc) . "'
		WHERE report_reason_id = " . (int) $reason_id;
	if (!$db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not update report reason', '', __LINE__, __FILE__, $sql);
	}
}

//
// Moves a report reason to another position (up or down), reorders other report reasons
//
function report_reason_move($mode, $reason_id, $steps = 1)
{
	global $db, $board_config;
	
	//
	// Obtain report reason information
	//
	$sql = 'SELECT report_module_id, report_reason_order
		FROM ' . REPORTS_REASONS_TABLE . '
		WHERE report_reason_id = ' . (int) $reason_id;
	if (!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not obtain report reason order', '', __LINE__, __FILE__, $sql);
	}
	
	$row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);
	
	if (!$row)
	{
		return false;
	}
	
	switch ($mode)
	{
		case 'up':
			$sql = 'UPDATE ' . REPORTS_REASONS_TABLE . '
				SET report_reason_order = report_reason_order + 1
				WHERE report_module_id = ' . $row['report_module_id'] . '
					AND report_reason_order >= ' . ($row['report_reason_order'] - (int) $steps) . '
					AND report_reason_order < ' . $row['report_reason_order'];
		break;
		
		case 'down':
			$sql = 'UPDATE ' . REPORTS_REASONS_TABLE . '
				SET report_reason_order = report_reason_order - 1
				WHERE report_module_id = ' . $row['report_module_id'] . '
					AND report_reason_order <= ' . ($row['report_reason_order'] + (int) $steps) . '
					AND report_reason_order > ' . $row['report_reason_order'];
		break;
		
		default:
			return false;
		break;
	}
	
	if (!$db->sql_query($sql, BEGIN_TRANSACTION))
	{
		message_die(GENERAL_ERROR, 'Could not update report reason order', '', __LINE__, __FILE__, $sql);
	}
	
	if ($db->sql_affectedrows())
	{
		$op = ($mode == 'up') ? '-' : '+';
		$sql = 'UPDATE ' . REPORTS_REASONS_TABLE . "
			SET report_reason_order = report_reason_order $op 1
			WHERE report_reason_id = " . (int) $reason_id;
		if (!$db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Could not update report reason order', '', __LINE__, __FILE__, $sql);
		}
	}
	
	$db->sql_query('', END_TRANSACTION);
	
	return true;
}

//
// Deletes a report reason
//
function report_reason_delete($reason_id)
{
	global $db;
	
	//
	// Obtain report reason information
	//
	$sql = 'SELECT report_module_id, report_reason_order
		FROM ' . REPORTS_REASONS_TABLE . '
		WHERE report_reason_id = ' . (int) $reason_id;
	if (!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not obtain report reason', '', __LINE__, __FILE__, $sql);
	}
	
	$row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);
	
	if (!$row)
	{
		return;
	}
	
	//
	// Update report reason order
	//
	$sql = 'UPDATE ' . REPORTS_REASONS_TABLE . '
		SET report_reason_order = report_reason_order - 1
		WHERE report_module_id = ' . $row['report_module_id'] . '
			AND report_reason_order > ' . $row['report_reason_order'];
	if (!$db->sql_query($sql, BEGIN_TRANSACTION))
	{
		message_die(GENERAL_ERROR, 'Could not update report reason order', '', __LINE__, __FILE__, $sql);
	}
	
	//
	// Delete report reason
	//
	$sql = 'DELETE FROM ' . REPORTS_REASONS_TABLE . '
		WHERE report_reason_id = ' . (int) $reason_id;
	if (!$db->sql_query($sql, END_TRANSACTION))
	{
		message_die(GENERAL_ERROR, 'Could not delete report reason', '', __LINE__, __FILE__, $sql);
	}
}

?>