<?php
/***************************************************************************
 *                             admin_groups.php
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

define('IN_PHPBB', 1);
define('CT_SECLEVEL', 'MEDIUM');
$ct_ignorepvar = array('new','group_name','username');

if ( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['Groups']['Manage'] = $filename;

	return;
}

//
// Load default header
//
$phpbb_root_path = './../';
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

include($phpbb_root_path.'language/lang_' . $board_config['default_lang'] . '/lang_admin_groups.'.$phpEx);

if ( isset($HTTP_POST_VARS[POST_GROUPS_URL]) || isset($HTTP_GET_VARS[POST_GROUPS_URL]) )
{
	$group_id = ( isset($HTTP_POST_VARS[POST_GROUPS_URL]) ) ? intval($HTTP_POST_VARS[POST_GROUPS_URL]) : intval($HTTP_GET_VARS[POST_GROUPS_URL]);
}
else
{
	$group_id = 0;
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

attachment_quota_settings('group', $HTTP_POST_VARS['group_update'], $mode);
//-- mod : Loewen Enterprise - PAYPAL IPN REG / SUBSCRIPTION - GROUP -----------------------------------------------------------			
//-- remove
//if ( isset($HTTP_POST_VARS['edit']) || isset($HTTP_POST_VARS['new']) )
//-- add
if ( isset($HTTP_POST_VARS['edit']) || isset($HTTP_GET_VARS['edit']) || isset($HTTP_POST_VARS['new']) )
//-- fin mod : Loewen Enterprise - PAYPAL IPN REG / SUBSCRIPTION - GROUP -----------------------------------------------------------			
{
	//
	// Ok they are editing a group or creating a new group
	//
	$template->set_filenames(array(
		'body' => 'admin/group_edit_body.tpl')
	);

//-- mod : Loewen Enterprise - PAYPAL IPN REG / SUBSCRIPTION - GROUP -----------------------------------------------------------			
//-- remove
//	if ( isset($HTTP_POST_VARS['edit']) )
//-- add
	if ( isset($HTTP_POST_VARS['edit']) || isset($HTTP_GET_VARS['edit']))
//-- fin mod : Loewen Enterprise - PAYPAL IPN REG / SUBSCRIPTION - GROUP -----------------------------------------------------------			

	{
		//
		// They're editing. Grab the vars.
		//
		$sql = "SELECT *
			FROM " . GROUPS_TABLE . "
			WHERE group_single_user <> " . TRUE . "
			AND group_id = $group_id";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Error getting group information', '', __LINE__, __FILE__, $sql);
		}

		if ( !($group_info = $db->sql_fetchrow($result)) )
		{
			message_die(GENERAL_MESSAGE, $lang['Group_not_exist']);
		}

		$mode = 'editgroup';
		$template->assign_block_vars('group_edit', array());

	}
	else if ( isset($HTTP_POST_VARS['new']) )
	{
		$group_info = array (
			'group_name' => '',
			'group_description' => '',
			'group_moderator' => '',
			'group_count' => '99999999',
			'group_count_max' => '99999999',
			'group_count_enable' => '0',
			'group_type' => GROUP_OPEN);
		$group_open = ' checked="checked"';

		$mode = 'newgroup';

	}

	//
	// Ok, now we know everything about them, let's show the page.
	//
	if ($group_info['group_moderator'] != '')
	{
		$sql = "SELECT user_id, username
			FROM " . USERS_TABLE . "
			WHERE user_id = " . $group_info['group_moderator'];
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain user info for moderator list', '', __LINE__, __FILE__, $sql);
		}

		if ( !($row = $db->sql_fetchrow($result)) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain user info for moderator list', '', __LINE__, __FILE__, $sql);
		}

		$group_moderator = $row['username'];
	}
	else
	{
		$group_moderator = '';
	}

	$group_open = ( $group_info['group_type'] == GROUP_OPEN ) ? ' checked="checked"' : '';
	$group_closed = ( $group_info['group_type'] == GROUP_CLOSED ) ? ' checked="checked"' : '';
	$group_hidden = ( $group_info['group_type'] == GROUP_HIDDEN ) ? ' checked="checked"' : '';
	$group_payment = ( $group_info['group_type'] == GROUP_PAYMENT ) ? ' checked="checked"' : '';
	$group_period = intval($group_info['group_period']);
	$group_period_basis = $group_info['group_period_basis'];
	$group_first_trial_fee = ($group_info['group_first_trial_fee'] + 0.00);
	$group_first_trial_period = intval($group_info['group_first_trial_period']);
	$group_first_trial_period_basis = ($group_info['group_first_trial_period_basis']);
	$group_second_trial_fee = ($group_info['group_second_trial_fee'] + 0.00);
	$group_second_trial_period = intval($group_info['group_second_trial_period']);
	$group_second_trial_period_basis = ($group_info['group_second_trial_period_basis']);
	$group_sub_recurring = intval($group_info['group_sub_recurring']);
	$group_sub_recurring_stop = intval($group_info['group_sub_recurring_stop']);
	$group_sub_recurring_stop_num = intval($group_info['group_sub_recurring_stop_num']);
	$group_sub_reattempt = intval($group_info['group_sub_reattempt']);

	$grp_billing_circle = '<SELECT name="group_period"><OPTION>--</OPTION>';
	for($i = 1; $i <= 30; $i++ )
	{
		if($group_period == $i)
		{
			$grp_billing_circle .= '<OPTION VALUE="' . $i . '" SELECTED>' . $i . '</OPTION>';
		}
		else
		{
			$grp_billing_circle .= '<OPTION VALUE="' . $i . '">' . $i . '</OPTION>';
		}
	}
	$grp_billing_circle .= '</SELECT>';

	$grp_period_basis = '<select name="group_period_basis">';
	$grp_period_basis .= '<option value="0"' . ((strcasecmp($group_period_basis, '0') == 0) ? 'SELECTED' : '') . ' >-select one-</option>';
	$grp_period_basis .= '<option value="D"' . ((strcasecmp($group_period_basis, 'D') == 0) ? 'SELECTED' : '') . ' >Day(s)</option>';
	$grp_period_basis .= '<option value="W"' . ((strcasecmp($group_period_basis, 'W') == 0) ? 'SELECTED' : '') . ' >Week(s)</option>';
	$grp_period_basis .= '<option value="M"' . ((strcasecmp($group_period_basis, 'M') == 0) ? 'SELECTED' : '') . ' >Month(s)</option>';
	$grp_period_basis .= '<option value="Y"' . ((strcasecmp($group_period_basis, 'Y') == 0) ? 'SELECTED' : '') . ' >Year(s)</option>';
	$grp_period_basis .= '</select>';
	
	$grp_recur_stop_num = '<SELECT name="group_sub_recurring_stop_num"><OPTION>--</OPTION>';
	for($i = 2; $i <= 30; $i++ )
	{
		if($group_sub_recurring_stop_num == $i)
		{
			$grp_recur_stop_num .= '<OPTION VALUE="' . $i . '" SELECTED>' . $i . '</OPTION>';
		}
		else
		{
			$grp_recur_stop_num .= '<OPTION VALUE="' . $i . '">' . $i . '</OPTION>';
		}
	}
	$grp_recur_stop_num .= '</SELECT>';
	
	$grp_first_trial_period = '<SELECT name="group_first_trial_period"><OPTION>--</OPTION>';
	for($i = 1; $i <= 30; $i++ )
	{
		if($group_first_trial_period == $i)
		{
			$grp_first_trial_period .= '<OPTION VALUE="' . $i . '" SELECTED>' . $i . '</OPTION>';
		}
		else
		{
			$grp_first_trial_period .= '<OPTION VALUE="' . $i . '">' . $i . '</OPTION>';
		}
	}
	$grp_first_trial_period .= '</SELECT>';
	
	$grp_first_trial_period_basis = '<select name="group_first_trial_period_basis">';
	$grp_first_trial_period_basis .= '<option value="0"' . ((strcasecmp($group_first_trial_period_basis, '0') == 0) ? 'SELECTED' : '') . ' >-select one-</option>';
	$grp_first_trial_period_basis .= '<option value="D"' . ((strcasecmp($group_first_trial_period_basis, 'D') == 0) ? 'SELECTED' : '') . ' >Day(s)</option>';
	$grp_first_trial_period_basis .= '<option value="W"' . ((strcasecmp($group_first_trial_period_basis, 'W') == 0) ? 'SELECTED' : '') . ' >Week(s)</option>';
	$grp_first_trial_period_basis .= '<option value="M"' . ((strcasecmp($group_first_trial_period_basis, 'M') == 0) ? 'SELECTED' : '') . ' >Month(s)</option>';
	$grp_first_trial_period_basis .= '<option value="Y"' . ((strcasecmp($group_first_trial_period_basis, 'Y') == 0) ? 'SELECTED' : '') . ' >Year(s)</option>';
	$grp_first_trial_period_basis .= '</select>';
	
	$grp_second_trial_period = '<SELECT name="group_second_trial_period"><OPTION>--</OPTION>';
	for($i = 1; $i <= 30; $i++ )
	{
		if($group_second_trial_period == $i)
		{
			$grp_second_trial_period .= '<OPTION VALUE="' . $i . '" SELECTED>' . $i . '</OPTION>';
		}
		else
		{
			$grp_second_trial_period .= '<OPTION VALUE="' . $i . '">' . $i . '</OPTION>';
		}
	}
	$grp_second_trial_period .= '</SELECT>';
	
	$grp_second_trial_period_basis = '<select name="group_second_trial_period_basis">';
	$grp_second_trial_period_basis .= '<option value="0"' . ((strcasecmp($group_second_trial_period_basis, '0') == 0) ? 'SELECTED' : '') . ' >-select one-</option>';
	$grp_second_trial_period_basis .= '<option value="D"' . ((strcasecmp($group_second_trial_period_basis, 'D') == 0) ? 'SELECTED' : '') . ' >Day(s)</option>';
	$grp_second_trial_period_basis .= '<option value="W"' . ((strcasecmp($group_second_trial_period_basis, 'W') == 0) ? 'SELECTED' : '') . ' >Week(s)</option>';
	$grp_second_trial_period_basis .= '<option value="M"' . ((strcasecmp($group_second_trial_period_basis, 'M') == 0) ? 'SELECTED' : '') . ' >Month(s)</option>';
	$grp_second_trial_period_basis .= '<option value="Y"' . ((strcasecmp($group_second_trial_period_basis, 'Y') == 0) ? 'SELECTED' : '') . ' >Year(s)</option>';
	$grp_second_trial_period_basis .= '</select>';
	$group_auto = ( $group_info['group_type'] == GROUP_AUTO ) ? ' checked="checked"' : '';
	$group_count_enable_checked = ( $group_info['group_count_enable'] ) ? ' checked="checked"' : '';

	$s_hidden_fields = '<input type="hidden" name="mode" value="' . $mode . '" /><input type="hidden" name="' . POST_GROUPS_URL . '" value="' . $group_id . '" />';

	$template->assign_vars(array(
		'GROUP_NAME' => $group_info['group_name'],
		'GROUP_DESCRIPTION' => $group_info['group_description'], 
		'GROUP_MODERATOR' => $group_moderator, 
		'GROUP_COUNT' => $group_info['group_count'], 
		'GROUP_COUNT_MAX' => $group_info['group_count_max'], 
		'GROUP_COUNT_ENABLE_CHECKED' => $group_count_enable_checked,
		
		'L_GROUP_COUNT' => $lang['group_count'],
		'L_GROUP_COUNT_MAX' => $lang['group_count_max'],
		'L_GROUP_COUNT_EXPLAIN' => $lang['group_count_explain'],
		'L_GROUP_COUNT_ENABLE' => $lang['Group_count_enable'],
		'L_GROUP_COUNT_UPDATE' => $lang['Group_count_update'],
		'L_GROUP_COUNT_DELETE' => $lang['Group_count_delete'],

		'L_GROUP_TITLE' => $lang['Group_administration'],
		'L_GROUP_EDIT_DELETE' => ( isset($HTTP_POST_VARS['new']) ) ? $lang['New_group'] : $lang['Edit_group'], 
		'L_GROUP_NAME' => $lang['group_name'],
		'L_GROUP_DESCRIPTION' => $lang['group_description'],
		'L_GROUP_MODERATOR' => $lang['group_moderator'], 
		'L_FIND_USERNAME' => $lang['Find_username'], 
		'L_GROUP_STATUS' => $lang['group_status'],
		'L_GROUP_OPEN' => $lang['group_open'],
		'L_GROUP_CLOSED' => $lang['group_closed'],
		'L_GROUP_HIDDEN' => $lang['group_hidden'],
		'L_GROUP_DELETE' => $lang['group_delete'],
		'L_GROUP_PAYMENT' => $lang['group_payment'],
		'L_GROUP_PAYMENTS_LW' => sprintf($lang['L_GROUP_PAYMENTS_LW'], $board_config['paypal_currency_code']),
		'L_GROUP_DELETE_CHECK' => $lang['group_delete_check'],
		'L_SUBMIT' => $lang['Submit'],
		'L_RESET' => $lang['Reset'],
		'L_DELETE_MODERATOR' => $lang['delete_group_moderator'],
		'L_DELETE_MODERATOR_EXPLAIN' => $lang['delete_moderator_explain'],
		'L_YES' => $lang['Yes'],

		'U_SEARCH_USER' => append_sid("../search.$phpEx?mode=searchuser"), 

		'S_GROUP_OPEN_TYPE' => GROUP_OPEN,
		'L_GROUP_AUTO' => $lang['group_auto'],
		'S_GROUP_AUTO_TYPE' => GROUP_AUTO,
		'S_GROUP_AUTO_CHECKED' => $group_auto,
		'S_GROUP_CLOSED_TYPE' => GROUP_CLOSED,
		'S_GROUP_HIDDEN_TYPE' => GROUP_HIDDEN,
		'S_GROUP_PAYMENT_TYPE' => GROUP_PAYMENT,
		'S_GROUP_OPEN_CHECKED' => $group_open,
		'S_GROUP_CLOSED_CHECKED' => $group_closed,
		'S_GROUP_HIDDEN_CHECKED' => $group_hidden,
		'S_GROUP_PAYMENT_CHECKED' => $group_payment,
		'GROUP_AMOUNT_LW' => $group_info['group_amount'],
		'LW_SUB_RECUR' => '<input type="radio" name="group_sub_recurring" value="1" ' . ($group_sub_recurring == 1 ? 'CHECKED' : '') . ' >Yes&nbsp;&nbsp;<input type="radio" name="group_sub_recurring" value="0" ' . ($group_sub_recurring == 0 ? 'CHECKED' : '') . '>No',
		'LW_BILLING_CIRCLE_PERIOD' => $grp_billing_circle,
		'LW_BILLING_PERIOD_BASIS' => $grp_period_basis,
		'LW_STOP_RECURRING' => '<input type="radio" name="group_sub_recurring_stop" value="1" ' . ($group_sub_recurring_stop == 1 ? 'CHECKED' : '') . ' >Yes&nbsp;&nbsp;<input type="radio" name="group_sub_recurring_stop" value="0" ' . ($group_sub_recurring_stop == 0 ? 'CHECKED' : '') . ' >No',
		'LW_STOP_RECURRING_NUM' => $grp_recur_stop_num,
		'LW_SUBCRIBE_REATTEMPT' => '<input type="radio" name="group_sub_reattempt" value="1" ' . ($group_sub_reattempt == 1 ? 'CHECKED' : '') . ' >Yes&nbsp;&nbsp;<input type="radio" name="group_sub_reattempt" value="0" ' . ($group_sub_reattempt == 0 ? 'CHECKED' : '') . ' >No',
		'GROUP_TRIAL_PERIOD_ONE_FEE_LW' => $group_first_trial_fee,
		'LW_FIRST_TRIAL_PERIOD' => $grp_first_trial_period,
		'LW_FIRST_TRIAL_PERIOD_BASIS' => $grp_first_trial_period_basis,
		'GROUP_TRIAL_PERIOD_TWO_FEE_LW' => $group_second_trial_fee,
		'LW_SECOND_TRIAL_PERIOD' => $grp_second_trial_period,
		'LW_SECOND_TRIAL_PERIOD_BASIS' => $grp_second_trial_period_basis,
		'S_GROUP_ACTION' => append_sid("admin_groups.$phpEx"),
		'S_HIDDEN_FIELDS' => $s_hidden_fields)
	);

	$template->pparse('body');

}
else if ( isset($HTTP_POST_VARS['group_update']) )
{
	//
	// Ok, they are submitting a group, let's save the data based on if it's new or editing
	//
	if ( isset($HTTP_POST_VARS['group_delete']) )
	{
		//
		// Reset User Moderator Level
		//

		// Is Group moderating a forum ?
		$sql = "SELECT auth_mod FROM " . AUTH_ACCESS_TABLE . " 
			WHERE group_id = " . $group_id;
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not select auth_access', '', __LINE__, __FILE__, $sql);
		}

		$row = $db->sql_fetchrow($result);
		if (intval($row['auth_mod']) == 1)
		{
			// Yes, get the assigned users and update their Permission if they are no longer moderator of one of the forums
			$sql = "SELECT user_id FROM " . USER_GROUP_TABLE . "
				WHERE group_id = " . $group_id;
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not select user_group', '', __LINE__, __FILE__, $sql);
			}

			$rows = $db->sql_fetchrowset($result);
			for ($i = 0; $i < count($rows); $i++)
			{
				$sql = "SELECT g.group_id FROM " . AUTH_ACCESS_TABLE . " a, " . GROUPS_TABLE . " g, " . USER_GROUP_TABLE . " ug
				WHERE (a.auth_mod = 1) AND (g.group_id = a.group_id) AND (a.group_id = ug.group_id) AND (g.group_id = ug.group_id) 
					AND (ug.user_id = " . intval($rows[$i]['user_id']) . ") AND (ug.group_id <> " . $group_id . ")";
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Could not obtain moderator permissions', '', __LINE__, __FILE__, $sql);
				}

				if ($db->sql_numrows($result) == 0)
				{
					$sql = "UPDATE " . USERS_TABLE . " SET user_level = " . USER . " 
					WHERE user_level = " . MOD . " AND user_id = " . intval($rows[$i]['user_id']);
					
					if ( !$db->sql_query($sql) )
					{
						message_die(GENERAL_ERROR, 'Could not update moderator permissions', '', __LINE__, __FILE__, $sql);
					}
				}
			}
		}

		//
		// Delete Group
		//
		$sql = "DELETE FROM " . GROUPS_TABLE . "
			WHERE group_id = " . $group_id;
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not update group', '', __LINE__, __FILE__, $sql);
		}

		$sql = "DELETE FROM " . USER_GROUP_TABLE . "
			WHERE group_id = " . $group_id;
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not update user_group', '', __LINE__, __FILE__, $sql);
		}

		$sql = "DELETE FROM " . AUTH_ACCESS_TABLE . "
			WHERE group_id = " . $group_id;
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not update auth_access', '', __LINE__, __FILE__, $sql);
		}

		$message = $lang['Deleted_group'] . '<br /><br />' . sprintf($lang['Click_return_groupsadmin'], '<a href="' . append_sid("admin_groups.$phpEx") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid("index.$phpEx?pane=right") . '">', '</a>');

		message_die(GENERAL_MESSAGE, $message);
	}
	else
	{
		$group_type = isset($HTTP_POST_VARS['group_type']) ? intval($HTTP_POST_VARS['group_type']) : GROUP_OPEN;
		$group_name = isset($HTTP_POST_VARS['group_name']) ? htmlspecialchars(trim($HTTP_POST_VARS['group_name'])) : '';
		$group_description = isset($HTTP_POST_VARS['group_description']) ? trim($HTTP_POST_VARS['group_description']) : '';
		$group_moderator = isset($HTTP_POST_VARS['username']) ? $HTTP_POST_VARS['username'] : '';
		$delete_old_moderator = isset($HTTP_POST_VARS['delete_old_moderator']) ? true : false;
		$group_amount = isset($HTTP_POST_VARS['group_amount']) ? ($HTTP_POST_VARS['group_amount'] + 0.00) : 0;
		$group_period = isset($HTTP_POST_VARS['group_period']) ? intval($HTTP_POST_VARS['group_period']) : 0;
		$group_period_basis = isset($HTTP_POST_VARS['group_period_basis']) ? htmlspecialchars($HTTP_POST_VARS['group_period_basis']) : '0';
		$group_first_trial_fee = isset($HTTP_POST_VARS['group_first_trial_fee']) ? ($HTTP_POST_VARS['group_first_trial_fee'] + 0.00) : 0;
		$group_first_trial_period = isset($HTTP_POST_VARS['group_first_trial_period']) ? intval($HTTP_POST_VARS['group_first_trial_period']) : 0;
		$group_first_trial_period_basis = isset($HTTP_POST_VARS['group_first_trial_period_basis']) ? htmlspecialchars($HTTP_POST_VARS['group_first_trial_period_basis']) : '0';
		$group_second_trial_fee = isset($HTTP_POST_VARS['group_second_trial_fee']) ? ($HTTP_POST_VARS['group_second_trial_fee'] + 0.00) : 0;
		$group_second_trial_period = isset($HTTP_POST_VARS['group_second_trial_period']) ? intval($HTTP_POST_VARS['group_second_trial_period']) : 0;
		$group_second_trial_period_basis = isset($HTTP_POST_VARS['group_second_trial_period_basis']) ? htmlspecialchars($HTTP_POST_VARS['group_second_trial_period_basis']) : '0';
		$group_sub_recurring = isset($HTTP_POST_VARS['group_sub_recurring']) ? intval($HTTP_POST_VARS['group_sub_recurring']) : 1;
		$group_sub_recurring_stop = isset($HTTP_POST_VARS['group_sub_recurring_stop']) ? intval($HTTP_POST_VARS['group_sub_recurring_stop']) : 0;
		$group_sub_recurring_stop_num = isset($HTTP_POST_VARS['group_sub_recurring_stop_num']) ? intval($HTTP_POST_VARS['group_sub_recurring_stop_num']) : 0;
		$group_sub_reattempt = isset($HTTP_POST_VARS['group_sub_reattempt']) ? intval($HTTP_POST_VARS['group_sub_reattempt']) : 1;

$group_count = isset($HTTP_POST_VARS['group_count']) ? intval($HTTP_POST_VARS['group_count']) : 0;
$group_count_max = isset($HTTP_POST_VARS['group_count_max']) ? intval($HTTP_POST_VARS['group_count_max']) : 0;
$group_count_enable = isset($HTTP_POST_VARS['group_count_enable']) ? true : false;
$group_count_update = isset($HTTP_POST_VARS['group_count_update']) ? true : false;
$group_count_delete = isset($HTTP_POST_VARS['group_count_delete']) ? true : false;

		if ( $group_name == '' )
		{
			message_die(GENERAL_MESSAGE, $lang['No_group_name']);
		}
		else if ( $group_moderator == '' )
		{
			message_die(GENERAL_MESSAGE, $lang['No_group_moderator']);
		}
		
		$this_userdata = get_userdata($group_moderator, true);
		$group_moderator = $this_userdata['user_id'];

		if ( !$group_moderator )
		{
			message_die(GENERAL_MESSAGE, $lang['No_group_moderator']);
		}
				
		if( $mode == "editgroup" )
		{
			$sql = "SELECT *
				FROM " . GROUPS_TABLE . "
				WHERE group_single_user <> " . TRUE . "
				AND group_id = " . $group_id;
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Error getting group information', '', __LINE__, __FILE__, $sql);
			}

			if( !($group_info = $db->sql_fetchrow($result)) )
			{
				message_die(GENERAL_MESSAGE, $lang['Group_not_exist']);
			}
		
			if ( $group_info['group_moderator'] != $group_moderator )
			{
				if ( $delete_old_moderator )
				{
					$sql = "DELETE FROM " . USER_GROUP_TABLE . "
						WHERE user_id = " . $group_info['group_moderator'] . " 
							AND group_id = " . $group_id;
					if ( !$db->sql_query($sql) )
					{
						message_die(GENERAL_ERROR, 'Could not update group moderator', '', __LINE__, __FILE__, $sql);
					}
				}

				$sql = "SELECT user_id 
					FROM " . USER_GROUP_TABLE . " 
					WHERE user_id = $group_moderator 
						AND group_id = $group_id";
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Failed to obtain current group moderator info', '', __LINE__, __FILE__, $sql);
				}

				if ( !($row = $db->sql_fetchrow($result)) )
				{
					$sql = "INSERT INTO " . USER_GROUP_TABLE . " (group_id, user_id, user_pending)
						VALUES (" . $group_id . ", " . $group_moderator . ", 0)";
					if ( !$db->sql_query($sql) )
					{
						message_die(GENERAL_ERROR, 'Could not update group moderator', '', __LINE__, __FILE__, $sql);
					}
				}
			}
//				group_period = $group_period, 
//				group_period_basis = '$group_period_basis', 
//				group_first_trial_fee = $group_first_trial_fee,	
//				group_first_trial_period = $group_first_trial_period, 
//				group_first_trial_period_basis = '$group_first_trial_period_basis', 
//				group_second_trial_fee = $group_second_trial_fee, 
//				group_second_trial_period = $group_second_trial_period, 
//				group_second_trial_period_basis = '$group_second_trial_period_basis', 
//				group_sub_recurring = $group_sub_recurring, 
//				group_sub_recurring_stop = $group_sub_recurring_stop, 
//				group_sub_recurring_stop_num = $group_sub_recurring_stop_num, 
//				group_sub_reattempt = $group_sub_reattempt 
			$sql = "UPDATE " . GROUPS_TABLE . "
				SET group_type = $group_type, group_name = '" . str_replace("\'", "''", $group_name) . "', group_description = '" . str_replace("\'", "''", $group_description) . "', group_moderator = $group_moderator, group_amount = $group_amount,  
				group_period = $group_period, 
				group_period_basis = '$group_period_basis', 
				group_first_trial_fee = $group_first_trial_fee,	
				group_first_trial_period = $group_first_trial_period, 
				group_first_trial_period_basis = '$group_first_trial_period_basis', 
				group_second_trial_fee = $group_second_trial_fee, 
				group_second_trial_period = $group_second_trial_period, 
				group_second_trial_period_basis = '$group_second_trial_period_basis', 
				group_sub_recurring = $group_sub_recurring, 
				group_sub_recurring_stop = $group_sub_recurring_stop, 
				group_sub_recurring_stop_num = $group_sub_recurring_stop_num, 
				group_sub_reattempt = $group_sub_reattempt, group_count='$group_count', group_count_max='$group_count_max', group_count_enable='$group_count_enable'
 
				WHERE group_id = $group_id";
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not update group', '', __LINE__, __FILE__, $sql);
			}
if ($group_count_delete)
			{
				//removing old users
				$sql = "DELETE FROM " . USER_GROUP_TABLE . "
					WHERE group_id=$group_id 
					AND user_id NOT IN ('$group_moderator','".ANONYMOUS."')";
				if ( !$db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not remove users, group count', '', __LINE__, __FILE__, $sql);
				}
				$group_count_remove=$db->sql_affectedrows();
			}
			if ( $group_count_update)
			{
				//finding new users
				$sql = "SELECT u.user_id FROM (" . USERS_TABLE . " u)
					LEFT JOIN " . USER_GROUP_TABLE ." ug ON u.user_id=ug.user_id AND ug.group_id='$group_id'
					WHERE u.user_posts>='$group_count' AND u.user_posts<'$group_count_max'
					AND ug.group_id is NULL
					AND u.user_id NOT IN ('$group_moderator','".ANONYMOUS."')";
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, $sql.'Could not select new users, group count', '', __LINE__, __FILE__, $sql);
				}
				//inserting new users
				$group_count_added=0;
				while ( ($new_members = $db->sql_fetchrow($result)) )
				{
					$sql = "INSERT INTO " . USER_GROUP_TABLE . " (group_id, user_id, user_pending) 
						VALUES ($group_id, " . $new_members['user_id'] . ", 0)";
					if ( !($result2 = $db->sql_query($sql)) )
					{
						message_die(GENERAL_ERROR, 'Error inserting user group, group count', '', __LINE__, __FILE__, $sql);
					}
					$group_count_added++;
				}
			}
			$message = $lang['Updated_group'] .'<br />'.sprintf($lang['group_count_updated'],$group_count_remove,$group_count_added). '<br /><br />' . sprintf($lang['Click_return_groupsadmin'], '<a href="' . append_sid("admin_groups.$phpEx") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid("index.$phpEx?pane=right") . '">', '</a>');;

			message_die(GENERAL_MESSAGE, $message);
		}
		else if( $mode == 'newgroup' )
		{
			$sql = "INSERT INTO " . GROUPS_TABLE . " (group_type, group_name, group_description, group_moderator, group_count,group_count_max,group_count_enable, group_single_user, group_amount, group_period, group_period_basis, group_first_trial_fee, group_first_trial_period, group_first_trial_period_basis, group_second_trial_fee, group_second_trial_period, group_second_trial_period_basis, group_sub_recurring, group_sub_recurring_stop, group_sub_recurring_stop_num, group_sub_reattempt) 
				VALUES ($group_type, '" . str_replace("\'", "''", $group_name) . "', '" . str_replace("\'", "''", $group_description) . "', $group_moderator, '$group_count','$group_count_max','$group_count_enable',	'0', $group_amount, $group_period, '$group_period_basis', $group_first_trial_fee, $group_first_trial_period, '$group_first_trial_period_basis', $group_second_trial_fee, $group_second_trial_period, '$group_second_trial_period_basis', $group_sub_recurring, $group_sub_recurring_stop, $group_sub_recurring_stop_num, $group_sub_reattempt)";
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not insert new group', '', __LINE__, __FILE__, $sql);
			}
			$new_group_id = $db->sql_nextid();

			$sql = "INSERT INTO " . USER_GROUP_TABLE . " (group_id, user_id, user_pending)
				VALUES ($new_group_id, $group_moderator, 0)";
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not insert new user-group info', '', __LINE__, __FILE__, $sql);
			}
		if ($group_count_delete)
			{
				//removing old users
				$sql = "DELETE FROM " . USER_GROUP_TABLE . "
					WHERE group_id=$new_group_id 
					AND user_id NOT IN ('$group_moderator','".ANONYMOUS."')";
				if ( !$db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not remove users, group count', '', __LINE__, __FILE__, $sql);
				}
				$group_count_remove=$db->sql_affectedrows();
			}
			if ( $group_count_update)
			{
				//finding new users
				$sql = "SELECT u.user_id FROM (" . USERS_TABLE . " u)
					LEFT JOIN " . USER_GROUP_TABLE ." ug ON u.user_id=ug.user_id AND ug.group_id='$new_group_id'
					WHERE u.user_posts>='$group_count' AND u.user_posts<'$group_count_max'
					AND ug.group_id is NULL
					AND u.user_id NOT IN ('$group_moderator','".ANONYMOUS."')";
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, $sql.'Could not select new users, group count', '', __LINE__, __FILE__, $sql);
				}
				//inserting new users
				$group_count_added=0;
				while ( ($new_members = $db->sql_fetchrow($result)) )
				{
					$sql = "INSERT INTO " . USER_GROUP_TABLE . " (group_id, user_id, user_pending) 
						VALUES ($new_group_id, " . $new_members['user_id'] . ", 0)";
					if ( !($result2 = $db->sql_query($sql)) )
					{
						message_die(GENERAL_ERROR, 'Error inserting user group, group count', '', __LINE__, __FILE__, $sql);
					}
					$group_count_added++;
				}
			}			
			$message = $lang['Added_new_group'] .'<br />'.sprintf($lang['group_count_updated'],$group_count_remove,$group_count_added). '<br /><br />' . sprintf($lang['Click_return_groupsadmin'], '<a href="' . append_sid("admin_groups.$phpEx") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid("index.$phpEx?pane=right") . '">', '</a>');;

			message_die(GENERAL_MESSAGE, $message);

		}
		else
		{
			message_die(GENERAL_MESSAGE, $lang['No_group_action']);
		}
	}
}
else
{
	$sql = "SELECT group_id, group_name
		FROM " . GROUPS_TABLE . "
		WHERE group_single_user <> " . TRUE . "
		ORDER BY group_name";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain group list', '', __LINE__, __FILE__, $sql);
	}

	$select_list = '';
	if ( $row = $db->sql_fetchrow($result) )
	{
		$select_list .= '<select name="' . POST_GROUPS_URL . '">';
		do
		{
			$select_list .= '<option value="' . $row['group_id'] . '">' . $row['group_name'] . '</option>';
		}
		while ( $row = $db->sql_fetchrow($result) );
		$select_list .= '</select>';
	}

	$template->set_filenames(array(
		'body' => 'admin/group_select_body.tpl')
	);

	$template->assign_vars(array(
		'L_GROUP_TITLE' => $lang['Group_administration'],
		'L_GROUP_EXPLAIN' => $lang['Group_admin_explain'],
		'L_GROUP_SELECT' => $lang['Select_group'],
		'L_LOOK_UP' => $lang['Look_up_group'],
		'L_CREATE_NEW_GROUP' => $lang['New_group'],

		'S_GROUP_ACTION' => append_sid("admin_groups.$phpEx"),
		'S_GROUP_SELECT' => $select_list)
	);

	if ( $select_list != '' )
	{
		$template->assign_block_vars('select_box', array());
	}

	$template->pparse('body');
}

include('./page_footer_admin.'.$phpEx);

?>
