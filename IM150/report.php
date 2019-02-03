<?php

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . "common.$phpEx");
include($phpbb_root_path . "includes/functions_report.$phpEx");

$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);

if (!$userdata['session_logged_in'])
{
	redirect(append_sid("index.$phpEx", true));
}

$return_links = array(
	'index' => '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>'),
	'list' => '<br /><br />' . sprintf($lang['Click_return_report_list'], '<a href="' . append_sid("report.$phpEx") . '">', '</a>')
);

if (isset($_POST['mode']) || isset($_GET['mode']))
{
	$mode = (isset($_POST['mode'])) ? $_POST['mode'] : $_GET['mode'];
}
else
{
	$mode = '';
}

$report_modules = report_modules();
$db->clear_cache('advanced_report_hack'); // clear all cache every time we are on this page

//
// Check for matching report module
//
if (!empty($mode))
{
	foreach (array_keys($report_modules) as $report_module_id)
	{
		$report_module = $report_modules[$report_module_id];
		
		if (!empty($report_module->mode) && $mode == $report_module->mode)
		{
			break;
		}
		
		unset($report_module);
	}
}

//
// Report module matched, show report form
//
if (isset($report_module))
{
	$errors = array();
	
	if (isset($_POST['id']) || isset($_GET['id']))
	{
		$report_subject_id = (isset($_POST['id'])) ? (int) $_POST['id'] : (int) $_GET['id'];
	}
	else
	{
		$report_subject_id = 0;
	}
	
	//
	// Check authorisation, check for duplicate reports
	//
	// V: TODO auth_bluecard; figure out a way to get forum_id
	if (!$report_module->auth_check('auth_write'))
	{
		message_die(GENERAL_MESSAGE, $report_module->lang['Auth_write_error'] . $report_module->return_link($report_subject_id) . $return_links['index']);
	}
	else if (!$report_module->duplicates && report_duplicate_check($report_module->id, $report_subject_id))
	{
		message_die(GENERAL_MESSAGE, $report_module->lang['Duplicate_error'] . $report_module->return_link($report_subject_id) . $return_links['index']);
	}
	
	if (isset($_POST['submit']))
	{
		$report_reason = (isset($_POST['reason'])) ? (int) $_POST['reason'] : 0;
		$report_desc = (isset($_POST['message'])) ? htmlspecialchars($_POST['message']) : '';
		
		//
		// Obtain report title if necessary
		//
		if (method_exists($report_module, 'subject_obtain'))
		{
			$report_title = addslashes($report_module->subject_obtain($report_subject_id));
		}
		else
		{
			$report_title = (isset($_POST['title'])) ? htmlspecialchars($_POST['title']) : '';
			$report_subject_id = 0;
		}
		
		//
		// Validate values
		//
		if (empty($report_title))
		{
			$errors[] = $lang['Report_title_empty'];
		}
		
		if (empty($report_desc))
		{
			$errors[] = $lang['Report_desc_empty'];
		}

		//
		// Insert report
		//
		if (empty($errors))
		{
			$report_desc = str_replace("\'", "'", $report_desc);
			$report_title = str_replace("\'", "'", $report_title);
			
			report_insert($report_module->id, $report_subject_id, $report_reason, $report_title, $report_desc, false);

			message_die(GENERAL_MESSAGE, $lang['Report_inserted'] . $report_module->return_link($report_subject_id) . $return_links['index']);
		}
	}
	else if (isset($_POST['cancel']))
	{
		$redirect_url = (method_exists($report_module, 'subject_url')) ? $report_module->subject_url($report_subject_id, true) : append_sid("index.$phpEx", true);
		redirect($redirect_url);
	}
	
	$page_title = $report_module->lang['Write_report'];
	include($phpbb_root_path . "includes/page_header.$phpEx");
	$template->set_filenames(array(
		'body' => 'report_form_body.tpl')
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
	
	//
	// Generate report reasons select
	//
	if ($report_reasons = $report_module->reasons_obtain())
	{
		$template->assign_block_vars('switch_report_reasons', array());
		
		foreach ($report_reasons as $reason_id => $reason_desc)
		{
			$template->assign_block_vars('switch_report_reasons.report_reasons', array(
				'ID' => $reason_id,
				'DESC' => $reason_desc,
				'CHECKED' => (isset($report_reason) && $report_reason == $reason_id) ? ' selected="selected"' : '')
			);
		}
	}
	
	//
	// Show report subject, check for correct subject
	//
	if (method_exists($report_module, 'subject_obtain'))
	{
		if ($report_subject = $report_module->subject_obtain($report_subject_id))
		{
			$template->assign_block_vars('switch_report_subject', array());
			$template->assign_var('REPORT_SUBJECT', $report_subject);
			
			if (method_exists($report_module, 'subject_url'))
			{
				$template->assign_block_vars('switch_report_subject.switch_url', array());
				$template->assign_var('U_REPORT_SUBJECT', $report_module->subject_url($report_subject_id));
			}
		}
		else
		{
			message_die(GENERAL_MESSAGE, $report_module->lang['Write_report_error'] . $return_links['index']);
		}
	}
	//
	// Show report title input
	//
	else
	{
		$template->assign_block_vars('switch_report_title', array());
	}
	
	$hidden_fields = '<input type="hidden" name="mode" value="' . $mode . '" /><input type="hidden" name="id" value="' . $report_subject_id . '" />';
	
	$template->assign_vars(array(
		'S_REPORT_ACTION' => append_sid("report.$phpEx"),
		'S_HIDDEN_FIELDS' => $hidden_fields,
		
		'L_WRITE_REPORT' => $report_module->lang['Write_report'],
		'L_WRITE_REPORT_EXPLAIN' => $report_module->lang['Write_report_explain'],
		'REPORT_TITLE' => (!method_exists($report_module, 'subject_obtain') && isset($report_title)) ? stripslashes($report_title) : '',
		'REPORT_DESC' => (isset($report_desc)) ? stripslashes($report_desc) : '',
		
		'L_TITLE' => $lang['Post_subject'],
		'L_SUBJECT' => $lang['Report_subject'],
		'L_REASON' => $lang['Reason'],
		'L_MESSAGE' => $lang['Message'],
		'L_SUBMIT' => $lang['Submit'],
		'L_CANCEL' => $lang['Cancel'])
	);
	
	$template->pparse('body');
	include($phpbb_root_path . "includes/page_tail.$phpEx");
}
else
{
	if ($userdata['user_level'] != ADMIN && ($board_config['report_list_admin'] || $userdata['user_level'] != MOD))
	{
		redirect(append_sid("index.$phpEx", true));
	}
	
	$params = array('open', 'process', 'clear', 'delete');
	foreach ($params as $param)
	{
		if (isset($_POST[$param]))
		{
			$mode = $param;
		}
	}
	
	// Report status css classes
	$report_status_classes = array(
		REPORT_NEW => 'report_new',
		REPORT_OPEN => 'report_open',
		REPORT_IN_PROCESS => 'report_process',
		REPORT_CLEARED => 'report_cleared',
		REPORT_DELETE => 'report_delete'
	);
	
	switch ($mode)
	{
		case 'open':
		case 'process':
		case 'clear':
		case 'delete':
			//
			// Validate report ids
			//
			if (isset($_POST[POST_REPORT_URL]) || isset($_GET[POST_REPORT_URL]))
			{
				$report_id = (isset($_POST[POST_REPORT_URL])) ? $_POST[POST_REPORT_URL] : $_GET[POST_REPORT_URL];
				$reports = array((int) $report_id);
				
				$single_report = true;
			}
			else if (isset($_POST['reports']))
			{
				$reports = array();
				foreach ($_POST['reports'] as $report_id)
				{
					$reports[] = (int) $report_id;
				}
				
				$single_report = false;
			}

			if (empty($reports))
			{
				$template->assign_var('META', '<meta http-equiv="refresh" content="3;url=' . append_sid("report.$phpEx") . '">');
				
				message_die(GENERAL_MESSAGE, $lang['No_reports_selected'] . $return_links['list'] . $return_links['index']);
			}
			
			//
			// Cancel action
			//
			if (isset($_POST['cancel']))
			{
				$redirect_url = ($single_report) ? "report.$phpEx?" . POST_REPORT_URL . '=' . $reports[0] : "report.$phpEx";
				redirect(append_sid($redirect_url, true));
			}
			
			//
			// Hidden fields
			//
			$hidden_fields = '<input type="hidden" name="mode" value="' . $mode . '" />';
			if ($single_report)
			{
				$hidden_fields .= '<input type="hidden" name="' . POST_REPORT_URL . '" value="' . $reports[0] . '" />';
			}
			else
			{
				foreach ($reports as $report_id)
				{
					$hidden_fields .= '<input type="hidden" name="reports[]" value="' . $report_id . '" />';
				}
			}
			
			$template->assign_vars(array(
				'S_CONFIRM_ACTION' => append_sid("report.$phpEx"),
				'S_HIDDEN_FIELDS' => $hidden_fields)
			);
			
			//
			// Change reports status
			//
			if ($mode != 'delete')
			{
				if (isset($_POST['confirm']))
				{
					$comment = (isset($_POST['comment'])) ? htmlspecialchars(str_replace("\'", "'", $_POST['comment'])) : '';
					
					switch ($mode)
					{
						case 'open':
							$status = REPORT_OPEN;
						break;
						
						case 'process':
							$status = REPORT_IN_PROCESS;
						break;
						
						case 'clear':
							$status = REPORT_CLEARED;
						break;
					}
					
					reports_update_status($reports, $status, $comment);
					
					$meta_url = ($single_report) ? "report.$phpEx?" . POST_REPORT_URL . '=' . $reports[0] : "report.$phpEx";
					$template->assign_var('META', '<meta http-equiv="refresh" content="3;url=' . append_sid($meta_url) . '">');
					
					$return_link = ($single_report) ? '<br /><br />' . sprintf($lang['Click_return_report'], '<a href="' . append_sid("report.$phpEx?" . POST_REPORT_URL . '=' . $reports[0]) . '">', '</a>') : '';
					$message = ($single_report) ? 'Report_changed' : 'Reports_changed';
					message_die(GENERAL_MESSAGE, $lang[$message] . $return_link . $return_links['list'] . $return_links['index']);
				}
				
				$page_title = ($single_report) ? $lang['Change_report'] : $lang['Change_reports'];
				
				include($phpbb_root_path . "includes/page_header.$phpEx");
				$template->set_filenames(array(
					'body' => 'report_change_body.tpl')
				);
				
				$template->assign_vars(array(
					'MESSAGE_TITLE' => $page_title,
					'MESSAGE_TEXT' => ($single_report) ? $lang['Change_report_explain'] : $lang['Change_reports_explain'],
					
					'L_COMMENT' => $lang['Comment'],
					'L_SUBMIT' => $lang['Submit'],
					'L_CANCEL' => $lang['Cancel'])
				);

				$template->pparse('body');
				include($phpbb_root_path . "includes/page_tail.$phpEx");
			}
			//
			// Delete reports
			//
			else
			{
				if (isset($_POST['confirm']))
				{
					reports_delete($reports);
					
					$template->assign_var('META', '<meta http-equiv="refresh" content="3;url=' . append_sid("report.$phpEx") . '">');
					
					$message = ($single_report) ? 'Report_deleted' : 'Reports_deleted';
					message_die(GENERAL_MESSAGE, $lang[$message] . $return_links['list'] . $return_links['index']);
				}
				
				$page_title = ($single_report) ? $lang['Delete_report'] : $lang['Delete_reports'];
				
				include($phpbb_root_path . "includes/page_header.$phpEx");
				$template->set_filenames(array(
					'confirm' => 'confirm_body.tpl')
				);

				$template->assign_vars(array(
					'MESSAGE_TITLE' => $page_title,
					'MESSAGE_TEXT' => ($single_report) ? $lang['Delete_report_explain'] : $lang['Delete_reports_explain'],
					
					'L_YES' => $lang['Yes'],
					'L_NO' => $lang['No'])
				);

				$template->pparse('confirm');
				include($phpbb_root_path . "includes/page_tail.$phpEx");
			}
		break;
		
		case 'reported':
			$cat = (isset($_GET[POST_CAT_URL])) ? (int) $_GET[POST_CAT_URL] : 0;
			$report_subject_id = (isset($_GET['id'])) ? (int) $_GET['id'] : 0;
			
			if (empty($cat) || empty($report_subject_id) || !isset($report_modules[$cat]))
			{
				message_die(GENERAL_MESSAGE, $lang['Report_not_supported'] . $return_links['index']);
			}
			
			$report_module =& $report_modules[$cat];
			$reports = reports_open_obtain($cat, $report_subject_id);
			
			//
			// No open reports for the subject, sync report module
			//
			if (empty($reports))
			{
				if (method_exists($report_module, 'sync'))
				{
					$report_module->sync();
				}
				
				message_die(GENERAL_MESSAGE, $lang['No_reports_found'] . $report_module->return_link($report_subject_id) . $return_links['index']);
			}
			//
			// Redirect to the open report
			//
			else if (count($reports) == 1)
			{
				$redirect_url = append_sid("report.$phpEx?" . POST_REPORT_URL . '=' . $reports[0]['report_id'], true);
				redirect($redirect_url);
			}
			
			$page_title = $lang['Open_reports'];
			include($phpbb_root_path . "includes/page_header.$phpEx");
			$template->set_filenames(array(
				'body' => 'report_open_body.tpl')
			);
			
			$template->assign_vars(array(
				'S_REPORT_ACTION', append_sid("report.$phpEx"),
				
				'L_OPEN_REPORTS' => $lang['Open_reports'],
				'L_BY' => $lang['Report_by'],
				'L_ACTION' => $lang['Action'],
				'L_DELETE' => $lang['Delete'],
				'L_MARK' => $lang['Report_mark'],
				'L_STATUS_CLEARED' => $lang['Report_status'][REPORT_CLEARED],
				'L_STATUS_IN_PROCESS' => $lang['Report_status'][REPORT_IN_PROCESS],
				'L_STATUS_OPEN' => $lang['Report_status'][REPORT_OPEN],
				'L_SUBMIT' => $lang['Submit'],
				'L_SELECT_ALL' => $lang['Mark_all'],
				'L_INVERT_SELECT' => $lang['Invert_select'])
			);
			
			//
			// Show list with open reports
			//
			foreach ($reports as $report)
			{
				$template->assign_block_vars('open_reports', array(
					'U_SHOW' => append_sid("report.$phpEx?" . POST_REPORT_URL . '=' . $report['report_id']),
					'U_AUTHOR' => append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $report['user_id']),
					
					'ID' => $report['report_id'],
					'TITLE' => $report['report_title'],
					'AUTHOR' => $agcm_color->get_user_color($report['user_group_id'], $report['user_session_time'], $report['username']),

					'TIME' => create_date($board_config['default_dateformat'], $report['report_time'], $board_config['board_timezone']))
				);
			}
			
			$template->pparse('body');
			include($phpbb_root_path . "includes/page_tail.$phpEx");
		break;
		
		case '':
			$page_title = $lang['Reports'];
			include($phpbb_root_path . "includes/page_header.$phpEx");
			$template->set_filenames(array(
				'body' => 'report_list_body.tpl')
			);

			$cat = (isset($_GET[POST_CAT_URL])) ? (int) $_GET[POST_CAT_URL] : null;
			$cat_url = (!empty($cat)) ? '&amp;' . POST_CAT_URL . "=$cat" : '';

			// V: TODO use something like ?reportee_filter instead of POST_USERS_URL??
			// TODO filter by username
			$reportee_filter_id = isset($_GET[POST_USERS_URL]) ? (int) $_GET[POST_USERS_URL] : null;
			$reportee_filter = '';
			if ($reportee_filter_data = get_userdata($reportee_filter_id))
			{
				$reportee_filter = "&amp;" . POST_USERS_URL . "=" . $reportee_filter_id;
				$template->assign_block_vars('reportee', array(
					'NAME' => $agcm_color->get_user_color($reportee_filter_data['user_group_id'], $reportee_filter_data['user_session_time'], $reportee_filter_data['username']),
					'U_REPORTEE_URL' => append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $reportee_filter_data['user_id']),
				));						
			}
			
			$template->assign_vars(array(
				'S_REPORT_ACTION' => append_sid("report.$phpEx"),
				
				'U_REPORT_INDEX' => append_sid("report.$phpEx"),
				'U_REPORT_FILTERED_INDEX' => append_sid("report.$phpEx?$reportee_filter"),
				
				'L_REPORTS' => $lang['Reports'],
				'L_REPORT_INDEX' => $lang['Report_index'],
				'L_BY' => $lang['Report_by'],
				'L_NO_REPORTS' => $lang['No_reports'],
				'L_ACTION' => $lang['Action'],
				'L_DELETE' => $lang['Delete'],
				'L_MARK' => $lang['Report_mark'],
				'L_STATUS_CLEARED' => $lang['Report_status'][REPORT_CLEARED],
				'L_STATUS_IN_PROCESS' => $lang['Report_status'][REPORT_IN_PROCESS],
				'L_STATUS_OPEN' => $lang['Report_status'][REPORT_OPEN],
				'L_SUBMIT' => $lang['Submit'],
				'L_SELECT_ALL' => $lang['Mark_all'],
				'L_INVERT_SELECT' => $lang['Invert_select'])
			);

			$show_delete_option = false;

			//
			// Show report list
			//
			$reports = reports_obtain($cat, true, $reportee_filter_id);
			foreach ($report_modules as $report_module)
			{
				//
				// Check module authorisation
				//
				if (!$report_module->auth_check('auth_view'))
				{
					continue;
				}

				//
				// V: make sure we can filter this one by user
				//
				if ($reportee_filter && !method_exists($report_module, 'reportee_obtain'))
				{
					continue;
				}
				
				$template->assign_block_vars('report_modules', array(
					'U_SHOW' => append_sid("report.$phpEx?" . POST_CAT_URL . '=' . $report_module->id . $reportee_filter),
					
					'TITLE' => $report_module->lang['Report_list_title'])
				);
				
				//
				// No reports in this category, display no reports message
				//
				if (!isset($reports[$report_module->id]))
				{
					if (empty($cat) || $cat == $report_module->id)
					{
						$template->assign_block_vars('report_modules.no_reports', array());
					}
					
					continue;
				}
				
				//
				// Check if deletions are allowed
				//
				if ($report_module->auth_check('auth_delete_view'))
				{
					$show_delete_option = true;
				}
				
				//
				// Show reports
				//
				foreach ($reports[$report_module->id] as $report)
				{		
					$template->assign_block_vars('report_modules.reports', array(
						'U_SHOW' => append_sid("report.$phpEx?" . POST_REPORT_URL . '=' . $report['report_id'] . $cat_url . $reportee_filter),
						'U_AUTHOR' => append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $report['user_id']),
						
						'ROW_CLASS' => $report_status_classes[$report['report_status']],
						'ID' => $report['report_id'],
						'TITLE' => (strlen($report['report_title'] > 53)) ? substr($report['report_title'], 0, 50) . '...' : $report['report_title'],
						'AUTHOR' => $agcm_color->get_user_color($report['user_group_id'], $report['user_session_time'], $report['username']),
						'TIME' => create_date($board_config['default_dateformat'], $report['report_time'], $board_config['board_timezone']),
						'STATUS' => $lang['Report_status'][$report['report_status']])
					);
					
					if (isset($_GET[POST_REPORT_URL]) && $_GET[POST_REPORT_URL] == $report['report_id'])
					{
						$template->assign_block_vars('report_modules.reports.switch_current', array());
					}
				}
			}
			
			if ($show_delete_option)
			{
				$template->assign_block_vars('switch_global_delete_option', array());
			}
			
			//
			// Show information for one report
			//
			if (isset($_GET[POST_REPORT_URL]))
			{
				$template->set_filenames(array(
					'report_view' => 'report_view_body.tpl')
				);
				
				if (!$report = report_obtain((int) $_GET[POST_REPORT_URL]))
				{
					message_die(GENERAL_MESSAGE, $lang['Report_not_exists'] . $return_links['list'] . $return_links['index']);
				}
				
				if ($report['report_status'] == REPORT_NEW)
				{
					reports_update_status($report['report_id'], REPORT_OPEN, '', false, true, false);
					$report['report_status'] = REPORT_OPEN;
				}
				
				//
				// Show report subject (with or without details, depending on the report module)
				//
				$report_module = $report_modules[$report['report_module_id']];
				$has_subject = false;
				if (method_exists($report_module, 'subject_details_obtain'))
				{
					if ($report_subject = $report_module->subject_details_obtain($report['report_subject']))
					{
						if (!$has_subject && isset($report_subject['subject']) || isset($report_subject['details']))
						{
							$template->assign_block_vars('report_subject', array());
							$has_subject = true;
						}
						
						//
						// Assign report subject
						//
						if (isset($report_subject['subject']))
						{
							$template->assign_block_vars('report_subject.switch_subject', array());
							$template->assign_var('REPORT_SUBJECT', $report_subject['subject']);
							
							if (method_exists($report_module, 'subject_url'))
							{
								$template->assign_block_vars('report_subject.switch_subject.switch_url', array());
								$template->assign_vars(array(
									'S_REPORT_SUBJECT_TARGET' => ($board_config['report_new_window']) ? ' target="_blank"' : '',
									'U_REPORT_SUBJECT' => $report_module->subject_url($report['report_subject']))
								);
							}
						}
						
						//
						// Assign report subject details
						//
						if (isset($report_subject['details']))
						{							
							foreach ($report_subject['details'] as $detail_title => $detail_value)
							{
								$template->assign_block_vars('report_subject.details', array(
									'TITLE' => $report_module->lang[$detail_title],
									'VALUE' => $detail_value)
								);
							}
						}
					}
					else
					{
						$template->assign_var('SWITCH_REPORT_SUBJECT_DELETED', true);
						$template->assign_var('L_REPORT_SUBJECT_DELETED', $report_module->lang['Deleted_error']);
					}
				}
				else if (method_exists($report_module, 'subject_obtain'))
				{
					if ($report_subject = $report_module->subject_obtain($report['report_subject']))
					{
						//
						// Assign report subject
						//
						if (!$has_subject)
						{
							$template->assign_block_vars('report_subject', array());
							$has_subject = true;
						}
						$template->assign_block_vars('report_subject.switch_subject', array());
						$template->assign_var('REPORT_SUBJECT', $report_subject);
						
						if (method_exists($report_module, 'subject_url'))
						{
							$template->assign_block_vars('report_subject.switch_subject.switch_url', array());
							$template->assign_vars(array(
								'S_REPORT_SUBJECT_TARGET' => ($board_config['report_new_window']) ? ' target="_blank"' : '',
								'U_REPORT_SUBJECT' => $report_module->subject_url($report['report_subject']))
							);
						}
					}
					else
					{
						$template->assign_var('SWITCH_REPORT_SUBJECT_DELETED', true);
						$template->assign_var('L_REPORT_SUBJECT_DELETED', $report_module->lang['Deleted_error']);
					}
				}
				
				// V: manage reportees here
				$reportee_user_id = null;
				if (!empty($report['reportee_user_id']))
				{
					$reportee_user_id = $report['reportee_user_id'];
					$reportee = get_userdata($reportee_user_id);
				}
				else if (method_exists($report_module, 'reportee_obtain'))
				{
					if ($reportee = $report_module->reportee_obtain($report['report_subject']))
					{
						// update the reportee_user_id, actual display is below
						report_update_reportee($report['report_id'], $reportee);
					}
				}

				if (!empty($reportee))
				{
					if (!$has_subject)
					{
						$template->assign_block_vars('report_subject', array());
						$has_subject = true;
					}

					$template->assign_block_vars('report_subject.reportee', array(
						'NAME' => $agcm_color->get_user_color($reportee['user_group_id'], $reportee['user_session_time'], $reportee['username']),
					));
					$template->assign_block_vars('report_subject.reportee.reportee_url', array(
						'L_SEND_PM' => $lang['Send_private_message'],
						'L_SEE_REPORTS' => $lang['SEE_REPORTS'],

						'U_SEND_PM' => append_sid("privmsg.$phpEx?mode=post&amp;" . POST_USERS_URL . '=' . $reportee['user_id']),
						'U_REPORTEE_URL' => append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $reportee['user_id']),
						'SHOW_SEE_REPORTS' => empty($reportee_filter_data),
						'U_SEE_REPORTS' => append_sid("report.$phpEx?" . POST_REPORT_URL . "=" . $report['report_id'] . "&amp;" . POST_USERS_URL . '=' . $reportee['user_id']),
					));
				}
				else if (!empty($report['reportee_username']))
				{ // user was probably deleted
					if (!$has_subject)
					{
						$template->assign_block_vars('report_subject', array());
						$has_subject = true;
					}
					$template->assign_block_vars('report_subject.reportee', array(
						// TODO says " (deleted)" somewhere?
						'NAME' => $report['reportee_username'],
					));
				}

				//
				// Assign report reason
				//
				if (!empty($report['report_reason_desc']))
				{
					$template->assign_block_vars('switch_report_reason', array());
					
					$template->assign_var('REPORT_REASON', $report['report_reason_desc']);
				}
				
				//
				// Show report changes
				//
				if ($report_changes = report_changes_obtain($report['report_id']))
				{
					$template->assign_block_vars('switch_report_changes', array());
					
					foreach ($report_changes as $report_change)
					{
						$u_report_change_user = append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $report_change['user_id']);
						$report_change_user = '<a href="' . $u_report_change_user . '">' . $agcm_color->get_user_color($report_change['user_group_id'], $report_change['user_session_time'], $report_change['username']) . '</a>';
						
						$report_change_status = $lang['Report_status'][$report_change['report_status']];
						$report_change_time = create_date($board_config['default_dateformat'], $report_change['report_change_time'], $board_config['board_timezone']);
						
						//
						// Text that contains all information
						//
						if ($report_change['report_status'] == REPORT_DELETE)
						{
							$report_change_text = sprintf($lang['Report_change_delete_text'], $report_change_user, $report_change_time);
						}
						else if ($report_change['report_change_comment'] != '')
						{
							$report_change_text = sprintf($lang['Report_change_text_comment'], $report_change_status, $report_change_user, $report_change_time, $report_change['report_change_comment']);
						}
						else
						{
							$report_change_text = sprintf($lang['Report_change_text'], $report_change_status, $report_change_user, $report_change_time);
						}
						
						$template->assign_block_vars('switch_report_changes.report_changes', array(
							'U_USER' => $u_report_change_user,
							
							'ROW_CLASS' => $report_status_classes[$report_change['report_status']],
							'STATUS' => $report_change_status,
							'USER' => $agcm_color->get_user_color($report_change['user_group_id'], $report_change['user_session_time'], $report_change['username']),
							'TIME' => $report_change_time,
							
							'TEXT' => $report_change_text)
						);
					}
					
					//
					// Assign last change information
					//
					$template->assign_vars(array(
						'U_REPORT_LAST_CHANGE_USER' => $u_report_change_user,
						
						'REPORT_LAST_CHANGE_TIME' => $report_change_time,
						'REPORT_LAST_CHANGE_USER' => $agcm_color->get_user_color($report_change['user_group_id'], $report_change['user_session_time'], $report_change['username']),
					));
				}
				
				//
				// Check if deletions are allowed
				//
				if ($report_module->auth_check('auth_delete_view'))
				{
					$template->assign_block_vars('switch_delete_option', array());
				}

				$template->assign_vars(array(
					'S_HIDDEN_FIELDS' => '<input type="hidden" name="' . POST_REPORT_URL . '" value="' . $report['report_id'] . '" />',
					
					'U_REPORT_AUTHOR' => append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $report['user_id']),
					'U_REPORT_AUTHOR_PRIVMSG' => append_sid("privmsg.$phpEx?mode=post&amp;" . POST_USERS_URL . '=' . $report['user_id']),
					
					'REPORT_TYPE' => $report_module->lang['Report_type'],
					'REPORT_TITLE' => $report['report_title'],
					'REPORT_AUTHOR' => $agcm_color->get_user_color($report['user_group_id'], $report['user_session_time'], $report['username']),
					'REPORT_TIME' => create_date($board_config['default_dateformat'], $report['report_time'], $board_config['board_timezone']),
					'REPORT_DESC' => str_replace("\n", '<br />', $report['report_desc']),
					'REPORT_STATUS' => $lang['Report_status'][$report['report_status']],
					'REPORT_STATUS_CLASS' => $report_status_classes[$report['report_status']],
					
					'L_SUBJECT' => $lang['Report_subject'],
					'L_REPORTED_BY' => $lang['Reported_by'],
					'L_SEND_PRIVMSG' => $lang['Send_private_message'],
					'L_REPORTED_TIME' => $lang['Reported_time'],
					'L_REASON' => $lang['Reason'],
					'L_MESSAGE' => $lang['Message'],
					'L_STATUS' => $lang['Status'],
					'L_LAST_CHANGED_BY' => $lang['Last_changed_by'],
					'L_CHANGES' => $lang['Changes'])
				);
			}
			//
			// Show report index page
			//
			else
			{
				$template->set_filenames(array(
					'report_view' => 'report_index_body.tpl')
				);
				
				$template->assign_vars(array(
					'L_STATISTICS' => $lang['Statistics'],
					'L_STATISTIC' => $lang['Statistic'],
					'L_VALUE' => $lang['Value'],
					'L_DELETED_REPORTS' => $lang['Deleted_reports'],
					'L_REPORT_TYPE' => $lang['Report_type'])
				);
				
				$statistics = array(
					'Report_count' => 'report_count',
					'Report_modules_count' => 'modules_count',
					'Report_hack_count' => 'report_hack_count'
				);
				foreach ($statistics as $stat_lang => $stat_mode)
				{
					$template->assign_block_vars('report_statistics', array(
						'STATISTIC' => $lang[$stat_lang],
						'VALUE' => report_statistics($stat_mode))
					);
				}
				
				/*
				if ($userdata['user_level'] == ADMIN)
				{
				*/
				$deleted_reports = reports_deleted_obtain();
				if (!empty($deleted_reports))
				{
					$template->assign_block_vars('switch_deleted_reports', array());
					foreach ($deleted_reports as $report)
					{
						$report_module = $report_modules[$report['report_module_id']];
						
						$template->assign_block_vars('switch_deleted_reports.deleted_reports', array(
							'U_SHOW' => append_sid("report.$phpEx?" . POST_REPORT_URL . '=' . $report['report_id'] . $cat_url),
							'U_AUTHOR' => append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $report['user_id']),
							
							'ID' => $report['report_id'],
							'TITLE' => $report['report_title'],
							'TYPE' => $report_module->lang['Report_type'],
							'AUTHOR' => $agcm_color->get_user_color($report['user_group_id'], $report['user_session_time'], $report['username']),
							'TIME' => create_date($board_config['default_dateformat'], $report['report_time'], $board_config['board_timezone']),
							'STATUS' => $lang['Report_status'][REPORT_DELETE])
						);
					}
				}
				/*
				}
				*/
			}

			$template->assign_var_from_handle('REPORT_VIEW', 'report_view');
			
			$template->pparse('body');
			include($phpbb_root_path . "includes/page_tail.$phpEx");
		break;
		
		default:
			message_die(GENERAL_MESSAGE, $lang['Report_not_supported'] . $return_links['index']);
		break;
	}
}

?>