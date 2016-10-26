<?php
/***************************************************************************
 *                            admin_donors.php
 *                            -------------------
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/
 
define('IN_PHPBB', true);

// Admin Panel
if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['Donates']['Donates_Add'] = $filename;	
	return;
}
//
// Let's set the root dir for phpBB
//
$phpbb_root_path = '../';
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
require($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_admin_donors.' . $phpEx);

$mode = "add";
if( isset($_POST['mode']) || isset($_GET['mode']) )
{
	$mode = (isset($_POST['mode'])) ? $_POST['mode'] : $_GET['mode'];
}

if( isset($_POST['submit']) || isset($_GET['submit']) )
{
	$mode = (isset($_POST['submit'])) ? $_POST['submit'] : $_GET['submit'];	
}
else if(isset($_POST['reset']) || isset($_GET['reset']))
{
	$mode = (isset($_POST['reset'])) ? $_POST['reset'] : $_GET['reset'];	
}

	if( $mode == 'add' || $mode == $lang['L_RESET'])
	{
		$template->set_filenames(array(
			'body' => 'admin/donors_config_body.tpl')
		);

		$template->assign_vars(array(
			'L_DONOR_CONFIGURATION_TITLE' => $lang['L_DONOR_CONFIGURATION_TITLE'],
			'L_DONOR_CONFIGURATION_EXPLAIN' => $lang['L_DONOR_CONFIGURATION_EXPLAIN'],
			'L_DONOR_GENERAL_SETTINGS' => $lang['L_DONOR_GENERAL_SETTINGS'],
			'L_USER_ACCOUNT' => $lang['L_USER_ACCOUNT'],
			'L_DONATE_MONEY' => $lang['L_DONATE_MONEY'],
			'L_DONATE_DATE' => $lang['L_DONATE_DATE'],
			'L_DONATE_DATE_EXPLAIN' => $lang['L_DONATE_DATE_EXPLAIN'],
			'L_TRANSACTION_ID' => $lang['L_TRANSACTION_ID'],
			'L_DONOR_PAY_ACCOUNT' => $lang['L_DONOR_PAY_ACCOUNT'],
			'L_DONOR_PAY_ACCOUNT_EXPLAIN' => $lang['L_DONOR_PAY_ACCOUNT_EXPLAIN'],

			'S_DONOR_CONFIG_ACTION' => append_sid("admin_donors.$phpEx"),
			'S_HIDDEN_FIELDS' => '',


			'L_SUBMIT' => $lang['L_SUBMIT'],
			'L_RESET' => $lang['L_RESET'],
			)
		);

		$template->pparse('body');

		include('./page_footer_admin.'.$phpEx);
	}
	else if($mode == $lang['L_SUBMIT'])
	{
		// Get posting variables
		$user_account = str_replace("\'", "''", htmlspecialchars(trim($_POST['user_account'])));
		$lw_money = str_replace("\'", "''", htmlspecialchars(trim($_POST['lw_money'])));
		$lw_date = str_replace("\'", "''", htmlspecialchars(trim($_POST['lw_date'])));
		$txn_id = str_replace("\'", "''", htmlspecialchars(trim($_POST['txn_id'])));
		$donor_pay_acct = str_replace("\'", "''", htmlspecialchars(trim($_POST['donor_pay_acct'])));



		$sql = "SELECT * FROM " . USERS_TABLE . " WHERE username = '" . $user_account . "'";
		$user_id = ANONYMOUS;
		if ( ($result = $db->sql_query($sql)) )
		{
			if( ($lwuserdata = $db->sql_fetchrow($result)) )
			{
				if($lwuserdata['user_id'] > 0)
				{
					$user_id = $lwuserdata['user_id'];
				}
			}
		}
		$db->sql_freeresult($result);
		if($user_id > 0)
		{

			if(intval($board_config['donate_to_points']) > 0)
			{			
				$sql = "UPDATE " . USERS_TABLE . " SET user_points = user_points + " . (intval(intval($board_config['donate_to_points']) * ($lw_money + 0.00))) . " WHERE user_id = " . $user_id;
				if ( !($result = $db->sql_query($sql)) )
				{
					//do nothing
				}
				
			}
			else if(intval($board_config['donate_to_posts']) > 0)
			{			
				$sql = "UPDATE " . USERS_TABLE . " SET user_posts = user_posts + " . (intval(intval($board_config['donate_to_posts']) * ($lw_money + 0.00))) . " WHERE user_id = " . $user_id;
				if ( !($result = $db->sql_query($sql)) )
				{
					//do nothing
				}
				
			}
			
			
			$sql = "SELECT SUM(lw_money) FROM " . ACCT_HIST_TABLE . " WHERE comment LIKE 'donate from%%' AND user_id = " . $user_id;
			$amount_donated = ($lw_money + 0.00);
			if($result = $db->sql_query($sql))
			{
				if($row = $db->sql_fetchrow($result))
				{
					$amount_donated = $amount_donated + $row["SUM(lw_money)"];
				}
			}

			$grptojoin = 0;
			if( intval($board_config['donate_to_grp_one']) > 0 
				&& ($board_config['to_grp_one_amount'] + 0.00) < ($amount_donated) )
			{
				$grptojoin = intval($board_config['donate_to_grp_one']);
			}
			if(intval($board_config['donate_to_grp_two']) > 0 
				&& ($board_config['to_grp_two_amount'] + 0.00) < ($amount_donated) 
				&& ($board_config['to_grp_one_amount'] + 0.00) < ($board_config['to_grp_two_amount'] + 0.00) )
			{
				$grptojoin = intval($board_config['donate_to_grp_two']);
			}
			if($grptojoin > 0)
			{
			   	$sql = "SELECT * FROM " . USER_GROUP_TABLE . " WHERE group_id = " . $grptojoin . " AND user_id = " . $user_id; 			
			   	// query database 
			   	$need_to_add = 1;
			   	if ( ($result = $db->sql_query($sql)) ) 
			   	{ 
				   	if ( $row = $db->sql_fetchrow($result) ) 
				   	{
 						if($row['user_pending'] == 0)
 						{
	 				   		$need_to_add = 0;
 						}
 						if($row['user_pending'] != 0)
 						{
	 				   		$need_to_add = 2; //need update
 						}
				   	}
			   	}
			   	 
			   	if($need_to_add == 1)
			   	{
					//add to the donor group
					$sql = "INSERT INTO " . USER_GROUP_TABLE . " (user_id, group_id, user_pending) VALUES ($user_id, $grptojoin, 0)";
			
					if( !($result = $db->sql_query($sql)) )
					{
						//do nothing
					}			
					//end add to the donor group
			   		
			   	}
			   	if($need_to_add == 2)
			   	{
					//update the donor group
					$sql = "UPDATE " . USER_GROUP_TABLE . " SET user_pending = 0 WHERE group_id = " . $grptojoin . " AND user_id = " . $user_id;
			
					if( !($result = $db->sql_query($sql)) )
					{
						//do nothing
					}			
					//end update the donor group
			   	}
			}
			
			if( intval($board_config['donor_rank_id']) > 0 )
			{
				$sql = "UPDATE " . USERS_TABLE . " SET user_rank = " . intval($board_config['donor_rank_id']) . " WHERE user_id = " . $user_id;
		
				if ( !($result = $db->sql_query($sql)) )
				{
					//do nothing
				}
				
			}
			
		}

		//date format YYYY/MM/DD hh:mm:ss
		$user_donate_date = time();
		if(strlen($lw_date) == strlen('YYYY/MM/DD hh:mm:ss'))
		{
			$user_donate_date = mktime(substr($lw_date, 11, 2), substr($lw_date, 14, 2), substr($lw_date, 17, 2), substr($lw_date, 5, 2), substr($lw_date, 8, 2), substr($lw_date, 0, 4));
		}

		$sql = "INSERT INTO " . ACCT_HIST_TABLE . "(user_id, lw_post_id, lw_money, lw_plus_minus, MNY_CURRENCY, lw_date, comment, lw_site, status, txn_id) VALUES(" . $user_id . ", 0, " . ($lw_money + 0.00) . ", -1, '" . str_replace("\'", "''", $board_config['paypal_currency_code']) . "', " . $user_donate_date . ", 'donate from " . str_replace("\'", "''", $donor_pay_acct) . ", Thank you!', '" . $table_prefix . "', 'Completed', '" . str_replace("\'", "''", $txn_id) . "')";
		if ( !($result = $db->sql_query($sql)) )
		{
			// Return a message...
			$message = $lang['New_donor_record_error'] . "<br /><br />" . sprintf($lang['Click_return_add_donor'], "<a href=\"" . append_sid("admin_donors.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");
		}	
		else
		{

			// Return a message...
			$message = $lang['New_donor_record_added'] . "<br /><br />" . sprintf($lang['Click_return_add_donor'], "<a href=\"" . append_sid("admin_donors.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");
		}

		message_die(GENERAL_MESSAGE, $message);
	}

?>