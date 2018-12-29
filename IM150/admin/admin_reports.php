<?php

if (!empty($setmodules))
{
	$file = basename(__FILE__);
	$module['Reports']['Modules_reasons'] = $file;
	$module['Reports']['Configuration'] = "$file?mode=config";
	return;
}

define('IN_PHPBB', true);
$phpbb_root_path = './../';
require($phpbb_root_path . 'extension.inc');
$no_page_header = true;
require("./pagestart.$phpEx");
include($phpbb_root_path . "includes/functions_report.$phpEx");
include($phpbb_root_path . "includes/functions_report_admin.$phpEx");

$return_links = array(
	'index' => '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid("index.$phpEx?pane=right") . '">', '</a>'),
	'config' => '<br /><br />' . sprintf($lang['Click_return_report_config'], '<a href="' . append_sid("admin_reports.$phpEx?mode=config") . '">', '</a>'),
	'admin' => '<br /><br />' . sprintf($lang['Click_return_report_admin'], '<a href="' . append_sid("admin_reports.$phpEx") . '">', '</a>')
);

$redirect_url = append_sid("admin/admin_reports.$phpEx", true);

$template->assign_var('S_REPORT_ACTION', append_sid("admin_reports.$phpEx"));

if (isset($_POST['mode']) || isset($_GET['mode']))
{
	$mode = (isset($_POST['mode'])) ? $_POST['mode'] : $_GET['mode'];
	
	//
	// allow multiple modes (we need this for sub-modes, e.g. the report reasons)
	//
	if (is_array($mode))
	{
		$modes = $mode;
		$mode = $modes[0];
	}
	else
	{
		$modes = array($mode);
	}
}
else
{
	$mode = '';
	$modes = array();
}

//
// Configuration page
//
if ($mode == 'config')
{
	if (isset($_POST['submit']))
	{
		$config_update = (isset($_POST['board_config'])) ? $_POST['board_config'] : array();
		
		foreach ($config_update as $config_name => $config_value)
		{
			if (!isset($board_config[$config_name]))
			{
				continue;
			}
			
			//
			// Clean cache if cache settings change
			//
			if ($config_name == 'report_modules_cache' && $config_value != $board_config[$config_name])
			{
				report_modules_cache_clean();
			}
			
			$sql = 'UPDATE ' . CONFIG_TABLE . "
				SET config_value = '" . str_replace("\'", "''", $config_value) . "'
				WHERE config_name = '" . str_replace("\'", "''", $config_name) . "'";
			if (!$db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, 'Could not update config', '', __LINE__, __FILE__, $sql);
			}
		}
		
		message_die(GENERAL_MESSAGE, $lang['Report_config_updated'] . $return_links['config'] . $return_links['index']);
	}
	else
	{
		include("./page_header_admin.$phpEx");
		$template->set_filenames(array(
			'body' => 'admin/report_config_body.tpl')
		);
		
		$template->assign_vars(array(
			'S_HIDDEN_FIELDS' => '<input type="hidden" name="mode" value="config" />',
			
			'REPORT_SUBJECT_AUTH_ON' => ($board_config['report_subject_auth']) ? ' checked="checked"' : '',
			'REPORT_SUBJECT_AUTH_OFF' => (!$board_config['report_subject_auth']) ? ' checked="checked"' : '',
			'REPORT_MODULES_CACHE_ON' => ($board_config['report_modules_cache']) ? ' checked="checked"' : '',
			'REPORT_MODULES_CACHE_OFF' => (!$board_config['report_modules_cache']) ? ' checked="checked"' : '',
			'REPORT_NOTIFY_CHANGE' => ($board_config['report_notify'] == REPORT_NOTIFY_CHANGE) ? ' checked="checked"' : '',
			'REPORT_NOTIFY_NEW' => ($board_config['report_notify'] == REPORT_NOTIFY_NEW) ? ' checked="checked"' : '',
			'REPORT_NOTIFY_OFF' => (!$board_config['report_notify']) ? ' checked="checked"' : '',
			'REPORT_LIST_ADMIN_ON' => ($board_config['report_list_admin']) ? ' checked="checked"' : '',
			'REPORT_LIST_ADMIN_OFF' => (!$board_config['report_list_admin']) ? ' checked="checked"' : '',
			'REPORT_NEW_WINDOW_ON' => ($board_config['report_new_window']) ? ' checked="checked"' : '',
			'REPORT_NEW_WINDOW_OFF' => (!$board_config['report_new_window']) ? ' checked="checked"' : '',
			
			'L_CONFIGURATION_TITLE' => $lang['Reports'] . ': ' . $lang['Configuration'],
			'L_CONFIGURATION_EXPLAIN' => $lang['Report_config_explain'],
			'L_REPORT_SUBJECT_AUTH' => $lang['Report_subject_auth'],
			'L_REPORT_SUBJECT_AUTH_EXPLAIN' => $lang['Report_subject_auth_explain'],
			'L_REPORT_MODULES_CACHE' => $lang['Report_modules_cache'],
			'L_REPORT_MODULES_CACHE_EXPLAIN' => $lang['Report_modules_cache_explain'],
			'L_REPORT_NOTIFY' => $lang['Report_notify'],
			'L_REPORT_NOTIFY_CHANGE' => $lang['Report_notify_change'],
			'L_REPORT_NOTIFY_NEW' => $lang['Report_notify_new'],
			'L_REPORT_LIST_ADMIN' => $lang['Report_list_admin'],
			'L_REPORT_NEW_WINDOW' => $lang['Report_new_window'],
			'L_REPORT_NEW_WINDOW_EXPLAIN' => $lang['Report_new_window_explain'],
			'L_ENABLED' => $lang['Enabled'],
			'L_DISABLED' => $lang['Disabled'],
			'L_YES' => $lang['Yes'],
			'L_NO' => $lang['No'],
			'L_RESET' => $lang['Reset'],
			'L_SUBMIT' => $lang['Submit'])
		);
		
		$template->pparse('body');
		include("./page_footer_admin.$phpEx");
	}
}
else if (isset($_POST[POST_CAT_URL]) || isset($_GET[POST_CAT_URL]))
{
	$module_id = (isset($_POST[POST_CAT_URL])) ? (int) $_POST[POST_CAT_URL] : (int) $_GET[POST_CAT_URL];
	
	if (!$report_module = report_modules('id', $module_id))
	{
		message_die(GENERAL_MESSAGE, $lang['Report_module_not_exists'] . $return_links['admin'] . $return_links['index']);
	}
	
	switch ($mode)
	{
		//
		// Edit module
		//
		case 'edit':
			if (isset($_POST['submit']))
			{
				$module_notify = (isset($_POST['report_module_notify']) && $_POST['report_module_notify'] == 1) ? 1 : 0;
				$module_prune = (isset($_POST['report_module_prune'])) ? (int) $_POST['report_module_prune'] : $report_module->data['report_module_prune'];
				
				$auth_write = (isset($_POST['auth_write'])) ? (int) $_POST['auth_write'] : $report_module->data['auth_write'];
				$auth_view = (isset($_POST['auth_view'])) ? (int) $_POST['auth_view'] : $report_module->data['auth_view'];
				$auth_notify = (isset($_POST['auth_notify'])) ? (int) $_POST['auth_notify'] : $report_module->data['auth_notify'];
				$auth_delete = (isset($_POST['auth_delete'])) ? (int) $_POST['auth_delete'] : $report_module->data['auth_delete'];
				
				report_module_edit($module_id, $module_notify, $module_prune, $auth_write, $auth_view, $auth_notify, $auth_delete);
				
				message_die(GENERAL_MESSAGE, $lang['Report_module_edited'] . $return_links['admin'] . $return_links['index']);
			}
			else if (isset($_POST['cancel']))
			{
				redirect($redirect_url);
			}
			
			include("./page_header_admin.$phpEx");
			$template->set_filenames(array(
				'body' => 'admin/report_module_edit_body.tpl')
			);
			
			$module_info = $report_module->info();
			
			$hidden_fields = '<input type="hidden" name="mode" value="edit" /><input type="hidden" name="' . POST_CAT_URL . '" value="' . $module_id . '" />';
			
			$template->assign_vars(array(
				'S_HIDDEN_FIELDS' => $hidden_fields,
				
				'MODULE_TITLE' => $module_info['title'],
				'MODULE_EXPLAIN' => $module_info['explain'],
				'MODULE_NOTIFY_ON' => ($report_module->data['report_module_notify']) ? ' checked="checked"' : '',
				'MODULE_NOTIFY_OFF' => (!$report_module->data['report_module_notify']) ? ' checked="checked"' : '',
				'MODULE_PRUNE' => $report_module->data['report_module_prune'],
				
				'L_EDIT_MODULE' => $lang['Edit_report_module'],
				'L_REPORT_MODULE' => $lang['Report_module'],
				'L_REPORT_NOTIFY' => $lang['Report_notify'],
				'L_ENABLED' => $lang['Enabled'],
				'L_DISABLED' => $lang['Disabled'],
				'L_REPORT_PRUNE' => $lang['Report_prune'],
				'L_REPORT_PRUNE_EXPLAIN' => $lang['Report_prune_explain'],
				'L_DAYS' => $lang['Days'],
				'L_PERMISSIONS' => $lang['Permissions'],
				'L_AUTH_WRITE' => $lang['Write'],
				'L_AUTH_VIEW' => $lang['View'],
				'L_AUTH_NOTIFY' => $lang['Report_notify'],
				'L_AUTH_NOTIFY_EXPLAIN' => $lang['Report_auth_notify_explain'],
				'L_AUTH_DELETE' => $lang['Delete'],
				'L_AUTH_DELETE_EXPLAIN' => $lang['Report_auth_delete_explain'],
				'L_SUBMIT' => $lang['Submit'],
				'L_CANCEL' => $lang['Cancel'])
			);
			
			//
			// Authorisation selects
			//
			report_auth_select('auth_write', $report_module->data['auth_write'], array(REPORT_AUTH_USER, REPORT_AUTH_MOD, REPORT_AUTH_ADMIN));
			report_auth_select('auth_view', $report_module->data['auth_view']);
			report_auth_select('auth_notify', $report_module->data['auth_notify']);
			report_auth_select('auth_delete', $report_module->data['auth_delete'], array(REPORT_AUTH_MOD, REPORT_AUTH_CONFIRM, REPORT_AUTH_ADMIN));
			
			$template->pparse('body');
			include("./page_footer_admin.$phpEx");
		break;
		
		//
		// Report reasons
		//
		case 'reasons':
			$reason_mode = (isset($modes[1])) ? $modes[1] : '';
			
			$temp_url = append_sid("admin_reports.$phpEx?mode=reasons&amp;" . POST_CAT_URL . "=$module_id");
			$return_links['reasons'] = '<br /><br />' . sprintf($lang['Click_return_report_reasons'], '<a href="' . $temp_url . '">', '</a>');
			
			$redirect_url = append_sid("admin/admin_reports.$phpEx?mode=reasons&" . POST_CAT_URL . "=$module_id", true);
			
			if (isset($_POST[POST_REPORT_REASON_URL]) || isset($_GET[POST_REPORT_REASON_URL]))
			{
				$reason_id = (isset($_POST[POST_REPORT_REASON_URL])) ? (int) $_POST[POST_REPORT_REASON_URL] : (int) $_GET[POST_REPORT_REASON_URL];
				
				switch ($reason_mode)
				{	
					//
					// Edit reason
					//
					case 'edit':
						$errors = array();
						
						if (isset($_POST['submit']))
						{
							$reason_desc = (isset($_POST['report_reason_desc'])) ? htmlspecialchars($_POST['report_reason_desc']) : '';
							
							//
							// Validate reason desc
							//
							if (empty($reason_desc))
							{
								$errors[] = $lang['Reason_desc_empty'];
							}
							
							if (empty($errors))
							{
								$reason_desc = str_replace("\'", "'", $reason_desc);
								
								report_reason_edit($reason_id, $module_id, $reason_desc);
								
								message_die(GENERAL_MESSAGE, $lang['Report_reason_edited'] . $return_links['reasons'] . $return_links['admin'] . $return_links['index']);
							}
						}
						else if (isset($_POST['cancel']))
						{
							redirect($redirect_url);
						}
						
						include("./page_header_admin.$phpEx");
						$template->set_filenames(array(
							'body' => 'admin/report_reason_edit_body.tpl')
						);
						
						//
						// Show validation errors
						//
						if (!empty($errors))
						{
							$template->assign_block_vars('switch_report_errors', array());
							foreach ($errors as $error)
							{
								$template->assign_block_vars('switch_report_errors.report_errors', array(
									'MESSAGE' => $error)
								);
							}
						}
						
						if (!$report_reason = report_reason_obtain($reason_id))
						{
							message_die(GENERAL_MESSAGE, $lang['Report_reason_not_exists'] . $return_links['reasons'] . $return_links['admin'] . $return_links['index']);
						}
						
						if (isset($reason_desc))
						{
							$report_reason['report_reason_desc'] = stripslashes($reason_desc);
						}
						
						$hidden_fields = '<input type="hidden" name="mode[]" value="reasons" /><input type="hidden" name="' . POST_CAT_URL . '" value="' . $module_id . '" />';
						$hidden_fields .= '<input type="hidden" name="mode[]" value="edit" /><input type="hidden" name="' . POST_REPORT_REASON_URL . '" value="' . $reason_id . '" />';
						
						$template->assign_vars(array(
							'S_HIDDEN_FIELDS' => $hidden_fields,
							
							'REASON_DESC' => $report_reason['report_reason_desc'],
							
							'L_EDIT_REASON' => $lang['Edit_reason'],
							'L_REASON_DESC' => $lang['Forum_desc'],
							'L_REASON_DESC_EXPLAIN' => $lang['Reason_desc_explain'],
							'L_SUBMIT' => $lang['Submit'],
							'L_CANCEL' => $lang['Cancel'])
						);
						
						$template->pparse('body');
						include("./page_footer_admin.$phpEx");
					break;
					
					//
					// Move reason up/down
					//
					case 'up':
					case 'down':
						report_reason_move($reason_mode, $reason_id);
						
						redirect($redirect_url);
					break;
					
					//
					// Delete reason
					//
					case 'delete':
						if (isset($_POST['confirm']))
						{
							report_reason_delete($reason_id);
							
							message_die(GENERAL_MESSAGE, $lang['Report_reason_deleted'] . $return_links['reasons'] . $return_links['admin'] . $return_links['index']);
						}
						else if (isset($_POST['cancel']))
						{
							redirect($redirect_url);
						}
						
						include("./page_header_admin.$phpEx");
						$template->set_filenames(array(
							'confirm' => 'admin/confirm_body.tpl')
						);
						
						$hidden_fields = '<input type="hidden" name="mode[]" value="reasons" /><input type="hidden" name="' . POST_CAT_URL . '" value="' . $module_id . '" />';
						$hidden_fields .= '<input type="hidden" name="mode[]" value="delete" /><input type="hidden" name="' . POST_REPORT_REASON_URL . '" value="' . $reason_id . '" />';
						
						$template->assign_vars(array(
							'S_CONFIRM_ACTION' => append_sid("admin_reports.$phpEx"),
							'S_HIDDEN_FIELDS' => $hidden_fields,
							
							'MESSAGE_TITLE' => $lang['Delete_reason'],
							'MESSAGE_TEXT' => $lang['Delete_report_reason_explain'],
							
							'L_YES' => $lang['Yes'],
							'L_NO' => $lang['No'])
						);
						
						$template->pparse('confirm');
						include("./page_footer_admin.$phpEx");
					break;
					
					default:
						message_die(GENERAL_MESSAGE, $lang['Report_not_supported'] . $return_links['reasons'] . $return_links['admin'] . $return_links['index']);
					break;
				}
			}
			else
			{
				switch ($reason_mode)
				{
					//
					// Add reason
					//
					case 'add':
						$errors = array();
						
						if (isset($_POST['submit']))
						{
							$reason_desc = (isset($_POST['report_reason_desc'])) ? htmlspecialchars($_POST['report_reason_desc']) : '';
							
							//
							// Validate reason desc
							//
							if (empty($reason_desc))
							{
								$errors[] = $lang['Reason_desc_empty'];
							}
							
							if (empty($errors))
							{
								$reason_desc = str_replace("\'", "'", $reason_desc);
								
								report_reason_insert($module_id, $reason_desc);
								
								message_die(GENERAL_MESSAGE, $lang['Report_reason_added'] . $return_links['reasons'] . $return_links['admin'] . $return_links['index']);
							}
						}
						else if (isset($_POST['cancel']))
						{
							redirect($redirect_url);
						}
						
						include("./page_header_admin.$phpEx");
						$template->set_filenames(array(
							'body' => 'admin/report_reason_edit_body.tpl')
						);
						
						//
						// Show validation errors
						//
						if (!empty($errors))
						{
							$template->assign_block_vars('switch_report_errors', array());
							foreach ($errors as $error)
							{
								$template->assign_block_vars('switch_report_errors.report_errors', array(
									'MESSAGE' => $error)
								);
							}
						}
						
						$hidden_fields = '<input type="hidden" name="mode[]" value="reasons" /><input type="hidden" name="' . POST_CAT_URL . '" value="' . $module_id . '" />';
						$hidden_fields .= '<input type="hidden" name="mode[]" value="add" />';
						
						$template->assign_vars(array(
							'S_HIDDEN_FIELDS' => $hidden_fields,
							
							'REASON_DESC' => (isset($reason_desc)) ? stripslashes($reason_desc) : '',
							
							'L_EDIT_REASON' => $lang['Add_reason'],
							'L_REASON_DESC' => $lang['Forum_desc'],
							'L_REASON_DESC_EXPLAIN' => $lang['Reason_desc_explain'],
							'L_SUBMIT' => $lang['Submit'],
							'L_CANCEL' => $lang['Cancel'])
						);
						
						$template->pparse('body');
						include("./page_footer_admin.$phpEx");
					break;
					
					case '':
						include("./page_header_admin.$phpEx");
						$template->set_filenames(array(
							'body' => 'admin/report_module_reasons_body.tpl')
						);
						
						if ($report_reasons = $report_module->reasons_obtain())
						{
							foreach ($report_reasons as $reason_id => $reason_desc)
							{
								$template->assign_block_vars('report_reasons', array(
									'DESC' => $reason_desc,
									
									'U_EDIT' => append_sid("admin_reports.$phpEx?mode[]=reasons&amp;" . POST_CAT_URL . "=$module_id&amp;mode[]=edit&amp;" . POST_REPORT_REASON_URL . "=$reason_id"),
									'U_MOVE_UP' => append_sid("admin_reports.$phpEx?mode[]=reasons&amp;" . POST_CAT_URL . "=$module_id&amp;mode[]=up&amp;" . POST_REPORT_REASON_URL . "=$reason_id"),
									'U_MOVE_DOWN' => append_sid("admin_reports.$phpEx?mode[]=reasons&amp;" . POST_CAT_URL . "=$module_id&amp;mode[]=down&amp;" . POST_REPORT_REASON_URL . "=$reason_id"),
									'U_DELETE' => append_sid("admin_reports.$phpEx?mode[]=reasons&amp;" . POST_CAT_URL . "=$module_id&amp;mode[]=delete&amp;" . POST_REPORT_REASON_URL . "=$reason_id"))
								);
							}
						}
						else
						{
							$template->assign_block_vars('switch_no_reasons', array());
						}
						
						$template->assign_vars(array(
							'U_ADD_REASON' => append_sid("admin_reports.$phpEx?mode[]=reasons&amp;" . POST_CAT_URL . "=$module_id&amp;mode[]=add"),
							'U_MODULES' => append_sid("admin_reports.$phpEx"),
							
							'L_REPORT_REASON' => $lang['Report_reason'],
							'L_ACTION' => $lang['Action'],
							'L_EDIT' => $lang['Edit'],
							'L_MOVE_UP' => $lang['Move_up'],
							'L_MOVE_DOWN' => $lang['Move_down'],
							'L_DELETE' => $lang['Delete'],
							'L_NO_REASONS' => $lang['No_reasons'],
							'L_ADD_REASON' => $lang['Add_reason'],
							'L_BACK_MODULES' => $lang['Back_modules'])
						);
						
						$template->pparse('body');
						include("./page_footer_admin.$phpEx");
					break;
					
					default:
						message_die(GENERAL_MESSAGE, $lang['Report_not_supported'] . $return_links['reasons'] . $return_links['admin'] . $return_links['index']);
					break;
				}
			}
		break;
		
		//
		// Move module up/down
		//
		case 'up':
		case 'down':
			report_module_move($mode, $module_id);
			
			redirect($redirect_url);
		break;
		
		//
		// Synchronize module
		//
		case 'sync':
			if (!method_exists($report_module, 'sync'))
			{
				message_die(GENERAL_MESSAGE, $lang['Report_not_supported'] . $return_links['admin'] . $return_links['index']);
			}
			
			$report_module->sync();
			
			message_die(GENERAL_MESSAGE, $lang['Report_module_synced'] . $return_links['admin'] . $return_links['index']);
		break;
		
		//
		// Uninstall module
		//
		case 'uninstall':
			if (isset($_POST['confirm']))
			{
				report_module_uninstall($module_id);
				
				message_die(GENERAL_MESSAGE, $lang['Report_module_uninstalled'] . $return_links['admin'] . $return_links['index']);
			}
			else if (isset($_POST['cancel']))
			{
				redirect($redirect_url);
			}
			
			include("./page_header_admin.$phpEx");
			$template->set_filenames(array(
				'confirm' => 'admin/confirm_body.tpl')
			);
			
			$hidden_fields = '<input type="hidden" name="mode" value="uninstall" /><input type="hidden" name="' . POST_CAT_URL . '" value="' . $module_id . '" />';
			
			$template->assign_vars(array(
				'S_CONFIRM_ACTION' => append_sid("admin_reports.$phpEx"),
				'S_HIDDEN_FIELDS' => $hidden_fields,
				
				'MESSAGE_TITLE' => $lang['Uninstall_report_module'],
				'MESSAGE_TEXT' => $lang['Uninstall_report_module_explain'],
				
				'L_YES' => $lang['Yes'],
				'L_NO' => $lang['No'])
			);
			
			$template->pparse('confirm');
			include("./page_footer_admin.$phpEx");
		break;
		
		default:
			message_die(GENERAL_MESSAGE, $lang['Report_not_supported'] . $return_links['admin'] . $return_links['index']);
		break;
	}
}
else if (isset($_POST['module_id']) || isset($_GET['module_id']))
{
	$module_name = (isset($_POST['module_id'])) ? stripslashes($_POST['module_id']) : stripslashes($_GET['module_id']);
	
	if (!$report_module = report_modules_inactive('name', $module_name))
	{
		message_die(GENERAL_MESSAGE, $lang['Report_module_not_exists'] . $return_links['admin'] . $return_links['index']);
	}
	
	switch ($mode)
	{
		//
		// Install module
		//
		case 'install':
			if (isset($_POST['submit']))
			{
				$module_notify = (isset($_POST['report_module_notify']) && $_POST['report_module_notify'] == 1) ? 1 : 0;
				$module_prune = (isset($_POST['report_module_prune'])) ? (int) $_POST['report_module_prune'] : 0;
				
				$auth_write = (isset($_POST['auth_write'])) ? (int) $_POST['auth_write'] : REPORT_AUTH_USER;
				$auth_view = (isset($_POST['auth_view'])) ? (int) $_POST['auth_view'] : REPORT_AUTH_MOD;
				$auth_notify = (isset($_POST['auth_notify'])) ? (int) $_POST['auth_notify'] : REPORT_AUTH_MOD;
				$auth_delete = (isset($_POST['auth_delete'])) ? (int) $_POST['auth_delete'] : REPORT_AUTH_ADMIN;
				
				report_module_install($module_notify, $module_prune, $module_name, $auth_write, $auth_view, $auth_notify, $auth_delete, false);
				
				message_die(GENERAL_MESSAGE, $lang['Report_module_installed'] . $return_links['admin'] . $return_links['index']);
			}
			else if (isset($_POST['cancel']))
			{
				redirect($redirect_url);
			}
			
			include("./page_header_admin.$phpEx");
			$template->set_filenames(array(
				'body' => 'admin/report_module_edit_body.tpl')
			);
			
			$module_info = $report_module->info();
			
			$hidden_fields = '<input type="hidden" name="mode" value="install" /><input type="hidden" name="module_id" value="' . htmlspecialchars($module_name) . '" />';
			
			$template->assign_vars(array(
				'S_HIDDEN_FIELDS' => $hidden_fields,
				
				'MODULE_TITLE' => $module_info['title'],
				'MODULE_EXPLAIN' => $module_info['explain'],
				'MODULE_NOTIFY_ON' => ($board_config['report_notify']) ? ' checked="checked"' : '',
				'MODULE_NOTIFY_OFF' => (!$board_config['report_notify']) ? ' checked="checked"' : '',
				'MODULE_PRUNE' => 0,
				
				'L_EDIT_MODULE' => $lang['Install_report_module'],
				'L_REPORT_MODULE' => $lang['Report_module'],
				'L_REPORT_NOTIFY' => $lang['Report_notify'],
				'L_ENABLED' => $lang['Enabled'],
				'L_DISABLED' => $lang['Disabled'],
				'L_REPORT_PRUNE' => $lang['Report_prune'],
				'L_REPORT_PRUNE_EXPLAIN' => $lang['Report_prune_explain'],
				'L_DAYS' => $lang['Days'],
				'L_PERMISSIONS' => $lang['Permissions'],
				'L_AUTH_WRITE' => $lang['Write'],
				'L_AUTH_VIEW' => $lang['View'],
				'L_AUTH_NOTIFY' => $lang['Report_notify'],
				'L_AUTH_NOTIFY_EXPLAIN' => $lang['Report_auth_notify_explain'],
				'L_AUTH_DELETE' => $lang['Delete'],
				'L_AUTH_DELETE_EXPLAIN' => $lang['Report_auth_delete_explain'],
				'L_SUBMIT' => $lang['Submit'],
				'L_CANCEL' => $lang['Cancel'])
			);
			
			//
			// Authorisation selects
			//
			report_auth_select('auth_write', REPORT_AUTH_USER, array(REPORT_AUTH_USER, REPORT_AUTH_MOD, REPORT_AUTH_ADMIN));
			report_auth_select('auth_view', REPORT_AUTH_MOD);
			report_auth_select('auth_notify', REPORT_AUTH_MOD);
			report_auth_select('auth_delete', REPORT_AUTH_CONFIRM, array(REPORT_AUTH_MOD, REPORT_AUTH_CONFIRM, REPORT_AUTH_ADMIN));
			
			$template->pparse('body');
			include("./page_footer_admin.$phpEx");
		break;
		
		default:
			message_die(GENERAL_MESSAGE, $lang['Report_not_supported'] . $return_links['admin'] . $return_links['index']);
		break;
	}
}
else
{
	switch ($mode)
	{
		case '':
			$report_modules = report_modules();
			
			include("./page_header_admin.$phpEx");
			$template->set_filenames(array(
				'body' => 'admin/report_modules_body.tpl')
			);
			
			$template->assign_vars(array(
				'L_REPORTS_TITLE' => $lang['Reports'] . ': ' . $lang['Modules_reasons'],
				'L_REPORTS_EXPLAIN' => $lang['Report_admin_explain'],
				
				'L_REPORT_MODULE' => $lang['Report_module'],
				'L_REPORT_COUNT' => $lang['Reports'],
				'L_ACTION' => $lang['Action'],
				'L_INSTALLED_MODULES' => $lang['Installed_modules'],
				'L_NO_MODULES_INSTALLED' => $lang['No_modules_installed'],
				'L_EDIT' => $lang['Edit'],
				'L_MOVE_UP' => $lang['Move_up'],
				'L_MOVE_DOWN' => $lang['Move_down'],
				'L_SYNC' => $lang['Sync'],
				'L_UNINSTALL' => $lang['Uninstall'],
				
				'L_INACTIVE_MODULES' => $lang['Inactive_modules'],
				'L_NO_MODULES_INACTIVE' => $lang['No_modules_inactive'],
				'L_INSTALL' => $lang['Install2'])
			);
			
			$report_counts = report_counts_obtain();
			$report_reason_counts = report_reason_counts_obtain();
			
			//
			// Display installed modules
			//
			$template->assign_block_vars('installed_modules', array());
			foreach (array_keys($report_modules) as $report_module_id)
			{
				$report_module =& $report_modules[$report_module_id];
				$module_info = $report_module->info();
				
				$template->assign_block_vars('installed_modules.modules', array(
					'L_REASONS' => sprintf($lang['Reasons'], $report_reason_counts[$report_module->id]),
				
					'MODULE_TITLE' => $module_info['title'],
					'MODULE_EXPLAIN' => $module_info['explain'],
					'REPORT_COUNT' => $report_counts[$report_module->id],
					
					'U_EDIT' => append_sid("admin_reports.$phpEx?mode=edit&amp;" . POST_CAT_URL . '=' . $report_module->id),
					'U_REASONS' => append_sid("admin_reports.$phpEx?mode=reasons&amp;" . POST_CAT_URL . '=' . $report_module->id),
					'U_MOVE_UP' => append_sid("admin_reports.$phpEx?mode=up&amp;" . POST_CAT_URL . '=' . $report_module->id),
					'U_MOVE_DOWN' => append_sid("admin_reports.$phpEx?mode=down&amp;" . POST_CAT_URL . '=' . $report_module->id),
					'U_SYNC' => append_sid("admin_reports.$phpEx?mode=sync&amp;" . POST_CAT_URL . '=' . $report_module->id),
					'U_UNINSTALL' => append_sid("admin_reports.$phpEx?mode=uninstall&amp;" . POST_CAT_URL . '=' . $report_module->id))
				);
				
				//
				// Display sync option if available
				//
				if (method_exists($report_module, 'sync'))
				{
					$template->assign_block_vars('installed_modules.modules.switch_sync', array());
				}
			}
			
			if (empty($report_modules))
			{
				$template->assign_block_vars('installed_modules.switch_no_modules', array());
			}
			
			$report_modules_inactive = report_modules_inactive();
			
			//
			// Display inactive modules
			//
			$template->assign_block_vars('inactive_modules', array());
			foreach (array_keys($report_modules_inactive) as $key)
			{
				$report_module =& $report_modules_inactive[$key];
				$module_info = $report_module->info();
				
				$template->assign_block_vars('inactive_modules.modules', array(
					'MODULE_TITLE' => $module_info['title'],
					'MODULE_EXPLAIN' => $module_info['explain'],
					'REPORT_COUNT' => '-',
					
					'U_INSTALL' => append_sid("admin_reports.$phpEx?mode=install&amp;module=" . $report_module->data['module_name']))
				);
			}
			
			if (empty($report_modules_inactive))
			{
				$template->assign_block_vars('inactive_modules.switch_no_modules', array());
			}
			
			$template->pparse('body');
			include("./page_footer_admin.$phpEx");
		break;
		
		default:
			message_die(GENERAL_MESSAGE, $lang['Report_not_supported'] . $return_links['admin'] . $return_links['index']);
		break;
	}
}

?>
