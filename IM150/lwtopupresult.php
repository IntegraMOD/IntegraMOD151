<?php
/***************************************************************************
 *				lwtopupresult.php
 *
 *	begin				: SEP/01/2004
 *	copyright			: Loewen Enterprise - Xiong Zou
 *	email				: zouxiong@loewen.com.sg
 *
 *	version				: 1.0.0.3 - OCT/29/2004
 *
 ***************************************************************************/
/***************************************************************************
## Terms of Use
##
## All of my MODifications are to use and edit/change for phpBB End Users
##
## Plese DO NOT remove any copyright/licence declaration when using the MODification
##
## I will remain as the sole developer for all my MODifications unless stated otherwise
##
##
## Distribution Terms
##
## All of my MODifications are prohibited to distribute to others without the permission from me.
##
## Plese DO NOT remove any copyright/licence declaration when using the MODification
##
## I will remain as the sole developer for all my MODifications unless stated otherwise
##
## Re-Distribution Terms
##
## If you are distributing WHOLE or PART of my MOD in your MOD Projects or Pre-modded Projects or any other means, you must:
##
## Get the formal authorization from me first.
##
## Plese DO NOT remove any copyright/licence declaration when using the MODification
##
## I will remain as the sole developer for all my MODification unless stated otherwise. Do NOT declare youself as my co-developer
##
## Re-Distribution Terms DOES NOT apply to MOD authors that developing Add-Ons to my MOD. You will be the Add-Ons' Developer/Author
##
***************************************************************************/

define('IN_PHPBB', true);
$phpbb_root_path = './';

include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

//$unhtml_specialchars_match = array('#&gt;#', '#&lt;#', '#&quot;#', '#&amp;#');
//$unhtml_specialchars_replace = array('>', '<', '"', '&');

//
// Set page ID for session management
//
//$userdata = session_pagestart($user_ip, PAGE_INDEX);
//init_userprefs($userdata);
//
// End session management
//
if(phpversion() <= "4.0.6")  { $_POST = ($_POST);  }


/*
//1 = Live on PayPal Network 2 = Testing with BelaHost.com
$verifymode = "1"; # be sure to change value for testing/live!
// Send notifications to here
$send_mail_to = $board_config['paypal_p_acct'];
// subject of messages
$sysname = "Paypal IPN Transaction";
// Your primary PayPal e-mail address
$paypal_email = $board_config['paypal_p_acct'];
// Your sendmail path
$mailpath = "/usr/sbin/sendmail -t";
// the name you wish to see the messages from
$from_name = $board_config['sitename'];
// the emails will be coming from
$from_email = $board_config['paypal_p_acct'];



// Convert Super globals For backward compatibility
if(phpversion() <= "4.0.6")  { $_POST = ($_POST);  }

// Check for IPN post if non then return 404 error.
if (!$_POST['txn_type']) {header("Status: 404 Not Found");exit; } else { header("Status: 200 OK");    }

// Now we Read the Posted IPN
$postvars = array();



            foreach ($_POST as $ipnvars => $ipnvalue) $postvars[] = $ipnvars;
    			
                   $postipn = 'cmd=_notify-validate'; // Now we ADD "cmd=_notify-validate" for Post back Validation
                   $orgipn = '<b>Posted IPN variables in order received:</b><br><br>';
				// Prepare for validation
            for ($x=0; $x < count($postvars); $x++) 
            { 
            	$y=$x+1; $postkey = $postvars[$x]; $postval = $$postvars[$x]; $postipn.= "&" . $postkey . "=" . urlencode($postval);  $orgipn.= "<b>#" . $y . "</b> Key: " . $postkey . " <b>=</b> " . $postval . "<br>";  
            }

//// Verify Mode 1: This will post the IPN variables to the Paypal Network for Validation
            if     ($verifymode == 1)
            {
		$port = fsockopen ("www.paypal.com", 80, $errno, $errstr, 30);
		$header = "POST /cgi-bin/webscr HTTP/1.0\r\n"."Host: www.paypal.com\r\n"."Content-Type: application/x-www-form-urlencoded\r\n"."Content-Length: " . strlen($postipn) . "\r\n\r\n";
            }
//// Verify Mode 2: This will post the IPN variables to Belahost Test Script for validation
//// Located at www.belahost.com/pp/index.php
            elseif ($verifymode == 2)
            {
//		$port = fsockopen ("www.belahost.com", 80, $errno, $errstr, 30);
//		$header = "POST /pp/ HTTP/1.0\r\n"."Host: www.belahost.com\r\n"."Content-Type: application/x-www-form-urlencoded\r\n"."Content-Length: " . strlen($postipn) . "\r\n\r\n";        
            } else { $error=1; echo "CheckMode: " . $verifymode . " is invalid!";  exit; }


// Error at this point: If at this point you need to check your Firewall or your Port restrictions?
// Setup email Notification here to trouble shoot. . .

            if (!$port && !$error)
            {
			echo "Problem: Error Number: " . $errno . " Error String: " . $errstr;
			send_mail("$send_mail_to", "$sysname", "\nYour Paypal System failed due to $errno and string $errstr \n");			
			exit;
            }


// If No Errors to this point then we proceed with the processing.
// Open port to paypal or test site and post Varibles.
            else
         {
			fputs ($port, $header . $postipn);
            while (!feof($port))
				    {
                   $reply = fgets ($port, 1024);
                   $reply = trim ($reply);
                    }

// Prepare a Debug Report
$ipnreport = $orgipn . "<br><b>" . "IPN Reply: " . $reply . "</b>";
*/

// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';

//foreach ($_POST as $key => $value) {
//$value = urlencode(stripslashes($value));
//$req .= "&$key=$value";
//}
while (list($key, $value) = each($_POST)) {
$value = urlencode(stripslashes($value));
$req .= "&$key=$value";
}


// post back to PayPal system to validate
$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
$fp = fsockopen ('www.paypal.com', 80, $errno, $errstr, 30);


// Below Instant Payment Notifiction Variables
                   $business = (isset($_POST['business']) ? htmlspecialchars($_POST['business']) : '');
                   $receiver_email = (isset($_POST['receiver_email']) ? htmlspecialchars($_POST['receiver_email']) : '');
                   $item_name = (isset($_POST['item_name']) ? htmlspecialchars($_POST['item_name']) : '');
                   $item_number = (isset($_POST['item_number']) ? htmlspecialchars($_POST['item_number']) : '');
                   $quantity = (isset($_POST['quantity']) ? htmlspecialchars($_POST['quantity']) : '');
//Advanced and Custom information
                   $invoice = (isset($_POST['invoice']) ? htmlspecialchars($_POST['invoice']) : '');
                   $custom = (isset($_POST['custom']) ? htmlspecialchars($_POST['custom']) : '');
                   $memo = (isset($_POST['memo']) ? htmlspecialchars($_POST['memo']) : '');
                   $tax = (isset($_POST['tax']) ? htmlspecialchars($_POST['tax']) : '');
                   $option_name1 = (isset($_POST['option_name1']) ? htmlspecialchars($_POST['option_name1']) : '');
                   $option_selection1 = (isset($_POST['option_selection1']) ? htmlspecialchars($_POST['option_selection1']) : '');
                   $option_name2 = (isset($_POST['option_name2']) ? htmlspecialchars($_POST['option_name2']) : '');
                   $option_selection2 = (isset($_POST['option_selection2']) ? htmlspecialchars($_POST['option_selection2']) : '');
// Shopping Cart Information
                   $num_cart_items = (isset($_POST['num_cart_items']) ? htmlspecialchars($_POST['num_cart_items']) : '');
// Transaction Information
                   $pending_reason = (isset($_POST['pending_reason']) ? htmlspecialchars($_POST['pending_reason']) : '');
                   $reason_code = (isset($_POST['reason_code']) ? htmlspecialchars($_POST['reason_code']) : '');
                   $payment_date = (isset($_POST['payment_date']) ? htmlspecialchars($_POST['payment_date']) : '');
                   $txn_id = (isset($_POST['txn_id']) ? htmlspecialchars($_POST['txn_id']) : '');
                   $txn_type = (isset($_POST['txn_type']) ? htmlspecialchars($_POST['txn_type']) : '');
                   
                   $payment_type = (isset($_POST['payment_type']) ? htmlspecialchars($_POST['payment_type']) : '');
                   $payment_status = (isset($_POST['payment_status']) ? htmlspecialchars($_POST['payment_status']) : '');
// Currency and Exchange Information                   
                   $mc_gross = (isset($_POST['mc_gross']) ? htmlspecialchars($_POST['mc_gross']) : '');
                   $mc_fee = (isset($_POST['mc_fee']) ? htmlspecialchars($_POST['mc_fee']) : '');
                   $mc_currency = (isset($_POST['mc_currency']) ? htmlspecialchars($_POST['mc_currency']) : '');
                   $settle_amount = (isset($_POST['settle_amount']) ? htmlspecialchars($_POST['settle_amount']) : '');
                   $settle_currency = (isset($_POST['settle_currency']) ? htmlspecialchars($_POST['settle_currency']) : '');
                   $exchange_rate = (isset($_POST['exchange_rate']) ? htmlspecialchars($_POST['exchange_rate']) : '');
                   $payment_gross = (isset($_POST['payment_gross']) ? htmlspecialchars($_POST['payment_gross']) : '');
                   $payment_fee = (isset($_POST['payment_fee']) ? htmlspecialchars($_POST['payment_fee']) : '');
// Auction Information 
                   $for_auction = (isset($_POST['for_auction']) ? htmlspecialchars($_POST['for_auction']) : '');
                   $auction_buyer_id = (isset($_POST['auction_buyer_id']) ? htmlspecialchars($_POST['auction_buyer_id']) : '');
                   $auction_closing_date = (isset($_POST['auction_closing_date']) ? htmlspecialchars($_POST['auction_closing_date']) : '');
                   $auction_multi_item = (isset($_POST['auction_multi_item']) ? htmlspecialchars($_POST['auction_multi_item']) : '');
 // Buyer Information
                   $first_name = (isset($_POST['first_name']) ? htmlspecialchars($_POST['first_name']) : '');
                   $last_name = (isset($_POST['last_name']) ? htmlspecialchars($_POST['last_name']) : '');
                   $address_name = (isset($_POST['address_name']) ? htmlspecialchars($_POST['address_name']) : '');
                   $address_street = (isset($_POST['address_street']) ? htmlspecialchars($_POST['address_street']) : '');
                   $address_city = (isset($_POST['address_city']) ? htmlspecialchars($_POST['address_city']) : '');
                   $address_state = (isset($_POST['address_state']) ? htmlspecialchars($_POST['address_state']) : '');
                   $address_zip = (isset($_POST['address_zip']) ? htmlspecialchars($_POST['address_zip']) : '');
                   $address_country = (isset($_POST['address_country']) ? htmlspecialchars($_POST['address_country']) : '');
                   $address_status = (isset($_POST['address_status']) ? htmlspecialchars($_POST['address_status']) : '');
                   $payer_email = (isset($_POST['payer_email']) ? htmlspecialchars($_POST['payer_email']) : '');
                   $payer_id = (isset($_POST['payer_id']) ? htmlspecialchars($_POST['payer_id']) : '');
                   $payer_status = (isset($_POST['payer_status']) ? htmlspecialchars($_POST['payer_status']) : '');

// Below are Subscription - Instant Payment Notifiction Variables
                   $notify_version = (isset($_POST['notify_version']) ? htmlspecialchars($_POST['notify_version']) : '');
                   $verify_sign = (isset($_POST['verify_sign']) ? htmlspecialchars($_POST['verify_sign']) : '');
                   $subscr_date = (isset($_POST['subscr_date']) ? htmlspecialchars($_POST['subscr_date']) : '');
                   $subscr_effective = (isset($_POST['subscr_effective']) ? htmlspecialchars($_POST['subscr_effective']) : '');
                   $period1 = (isset($_POST['period1']) ? htmlspecialchars($_POST['period1']) : '');
                   $period2 = (isset($_POST['period2']) ? htmlspecialchars($_POST['period2']) : '');
                   $period3 = (isset($_POST['period3']) ? htmlspecialchars($_POST['period3']) : '');
                   $amount1 = (isset($_POST['amount1']) ? htmlspecialchars($_POST['amount1']) : '');
                   $amount2 = (isset($_POST['amount2']) ? htmlspecialchars($_POST['amount2']) : '');
                   $amount3 = (isset($_POST['amount3']) ? htmlspecialchars($_POST['amount3']) : '');
                   $mc_amount1 = (isset($_POST['mc_amount1']) ? htmlspecialchars($_POST['mc_amount1']) : '');
                   $mc_amount2 = (isset($_POST['mc_amount2']) ? htmlspecialchars($_POST['mc_amount2']) : '');
                   $mc_amount3 = (isset($_POST['mc_amount3']) ? htmlspecialchars($_POST['mc_amount3']) : '');
                   $recurring = (isset($_POST['recurring']) ? htmlspecialchars($_POST['recurring']) : '');
                   $reattempt = (isset($_POST['reattempt']) ? htmlspecialchars($_POST['reattempt']) : '');
                   $retry_at = (isset($_POST['retry_at']) ? htmlspecialchars($_POST['retry_at']) : '');
                   $recur_times = (isset($_POST['recur_times']) ? htmlspecialchars($_POST['recur_times']) : '');
                   $username = (isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '');
                   $password = (isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '');
                   $subscr_id = (isset($_POST['subscr_id']) ? htmlspecialchars($_POST['subscr_id']) : '');

/*// IPN was Confirmed as both Genuine and VERIFIED
            if (!strcmp ($reply, "VERIFIED"))
            { //*/

/* Now that IPN was VERIFIED below are a few things which you may want to do at this point.
 1. Check that the "payment_status" variable is: "Completed"
 2. If it is Pending you may want to wait or inform your customer?
 3. You should Check your datebase to ensure this "txn_id" or "subscr_id" is not a duplicate. txn_id is not sent with subscriptions!
 4. Check "payment_gross" or "mc_gross" matches match your prices!
 5. You definately want to check the "receiver_email" or "business" is yours. 
*/

if (!$fp) {
// HTTP ERROR
} else {
fputs ($fp, $header . $req);
while (!feof($fp)) {
$res = fgets ($fp, 1024);
if (strcmp ($res, "VERIFIED") == 0) {
// check the payment_status is Completed
// check that txn_id has not been previously processed
// check that receiver_email is your Primary PayPal email
// check that payment_amount/payment_currency are correct
// process payment

		//$item_number will looks like 6-14  user_id-group_id
		$pos = strpos($item_number, '-', 0);
		$user_id = 0;
		$group_id = 0;
		if($pos !== false)
		{
			$user_id = intval(substr($item_number, 0, $pos));
			$group_id = intval(substr($item_number, $pos + 1));
		}
		if($user_id <= 0 || $group_id <= 0)
		{
			fclose ($fp);
			$message = sprintf($lang['LW_USER_ACCT_ERROR'], $user_id) . '<br /><br />' .  sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>');
			message_die(GENERAL_MESSAGE, $message);
		        exit;
		}
		$sql = "SELECT user_id, username, user_active, user_level, user_expire_date, user_regdate
			FROM " . USERS_TABLE . "
			WHERE user_id = $user_id";
		if ( !($result = $db->sql_query($sql)) )
		{
			fclose ($fp);
			message_die(GENERAL_ERROR, 'Error in obtaining userdata', '', __LINE__, __FILE__, $sql);
			exit;
		}
		if( $row = $db->sql_fetchrow($result) )
		{
			if( $row['user_level'] == ADMIN
				|| $row['user_level'] == MOD )
			{
				fclose ($fp);
				$message = $lang['Account_activated_lw'] . '<br /><br />' .  sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>');
				message_die(GENERAL_MESSAGE, $message);
				exit;
			}
		}
		else
		{
				fclose ($fp);
				$message = $lang['Account_not_exist_lw'] . '<br /><br />' .  sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>');
				message_die(GENERAL_MESSAGE, $message);
				exit;
		}

		$flag = 0;
		if(strcasecmp($txn_type, 'web_accept') == 0)
		{
			$flag = 1; //check payment;
		}
		else if(strcasecmp($txn_type, 'subscr_payment') == 0)
		{
			$flag = 2; //check payment;
		}
		else if(strcasecmp($txn_type, 'subscr_signup') == 0)
		{
			$flag = 3;  //need to check whether first trial fee is 0, if yes, add to group, if no, wait for payment;
		}
		else if(strcasecmp($txn_type, 'subscr_cancel') == 0)
		{
			$flag = 5; //unsubcribe //cancel subscription, but wait till his time expire
		}
		else if(strcasecmp($txn_type, 'subscr_failed') == 0)
		{
			$flag = 4; //unsubscribe if any exits, report error in return_url what paypal will do if can not deduct money any more?
		}
		else if(strcasecmp($txn_type, 'subscr_eot') == 0)
		{
			$flag = 4; //unsubcribe
		}
		else if(strcasecmp($txn_type, 'subscr_modify') == 0)
		{
			$flag = 0; //else condition, or unknown condition;
		}
		else
		{
			$flag = 0; //else condition, or unknown condition;
		}
		
		$errorflag = 0;
		//if subscr_failed or subscr_eot
		if( $flag == 4 && strcasecmp($payment_status, 'Refunded') != 0 )
		{
			//remove member from this paid group if any
			$sql = "SELECT * FROM " . GROUPS_TABLE . " WHERE group_type = " . GROUP_PAYMENT . " AND group_amount > 0 AND group_id = " . $group_id;
			$groupwhere = '';
			if ( ($result = $db->sql_query($sql)) )
			{
				if( ($group_info = $db->sql_fetchrow($result)) )
				{
					$groupwhere .= "(group_id = " . $group_info['group_id'] . " AND user_id = " . $row['user_id'] . ")";
				}
			}
			if(strlen($groupwhere) > 0)
			{
				$sql = "DELETE FROM " . USER_GROUP_TABLE . " WHERE $groupwhere";
				if( !($result = $db->sql_query($sql)) )
				{
					//do nothing
				}
			}
		}
	
		//update the payee's user data with payment
		if((($flag == 1 || $flag == 2) && strcasecmp($payment_status, 'Completed') == 0)
			|| $flag == 3)
		{
			
			
			//update the user_group table:
	
			$sql = "SELECT * FROM " . GROUPS_TABLE . " WHERE group_type = " . GROUP_PAYMENT . " AND group_amount > 0 AND group_id = " . $group_id;
			if ( !($resultr = $db->sql_query($sql)) )
			{
				fclose ($fp);
				$message = $lang['LW_UPDATE_USER_ACCT_ERROR'] . '<br /><br />' .  sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>');
				message_die(GENERAL_MESSAGE, $message);
			        exit;

			}
			if( !($rowr = $db->sql_fetchrow($resultr)) )
			{
				fclose ($fp);
				$message = $lang['LW_UPDATE_USER_ACCT_ERROR'] . '<br /><br />' .  sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>');
				message_die(GENERAL_MESSAGE, $message);
			        exit;
			}

			$group_id = $rowr['group_id'];
			if($group_id <= 0)
			{
				fclose ($fp);
				$message = $lang['LW_UPDATE_USER_ACCT_ERROR'] . '<br /><br />' .  sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>');
				message_die(GENERAL_MESSAGE, $message);
			        exit;
			}
			$group_amount = $rowr['group_amount'];
			$group_period = $rowr['group_period'];
			$group_period_basis = $rowr['group_period_basis'];
			
			
			//get payment account, use business account first, if not exist, then choose personal account
			$paypalaccount = lw_grap_sys_paypal_acct();
			if(strlen($paypalaccount) <= 0)
			{
				fclose ($fp);
				message_die(GENERAL_ERROR, $lang['LW_PAYPAL_ACCT_ERROR']);
				exit;			
			}
			
			if( strcasecmp( trim($paypalaccount), trim($receiver_email)) != 0  
				|| strcasecmp( trim($board_config['paypal_currency_code']), trim($mc_currency) ) != 0)
			{
				//do nothing
				$errorflag = 1;
			}
			
			if($errorflag == 0)
			{
				//if repviously has a record with same txn_id and its status is completed. exit
				$sql = "SELECT * FROM " . ACCT_HIST_TABLE . " WHERE txn_id = '" . $txn_id . "' AND status = '" . $payment_status . "'";
				if ( !($resulta = $db->sql_query($sql)) )
				{
					//do nothing
				}
				if( !($rowa = $db->sql_fetchrow($resulta)) )
				{
					//do nothing
				}
				if($rowa['lw_money'] > 0)
				{
					fclose ($fp);
					$message = $lang['LW_UPDATE_USER_ACCT_ERROR'] . '<br /><br />' .  sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>');
					message_die(GENERAL_MESSAGE, $message);
				        exit;
				}
				//end if repviously has a record with same txn_id and its status is completed. exit
				
				
				//check whether this user is currently in this payment group
				$sql = "SELECT * FROM " . USER_GROUP_TABLE . " WHERE user_id = " . $user_id . " AND group_id = " . $group_id;
				$useringroup = 0;
				$prevexpiredate = 0;
				if ( ($result = $db->sql_query($sql)) )
				{
					if( ($ug_info = $db->sql_fetchrow($result)) 
						&& $ug_info['group_id'] == $group_id )
					{
						$useringroup = 1;
						$prevexpiredate = $ug_info['ug_expire_date'];
//						if($row['user_expire_date'] > $ug_info['ug_expire_date'])
//						{
//							$prevexpiredate = $row['user_expire_date'];
//						}
					}
				}
				//end check whether this user is currently in this payment group
				
				//end update user group
		
				//expire date
				$expiretime = 0;
				$sql = '';
							
				$add_days = 0;
				$add_months = 0;
				$add_years = 0;		
							
				//cal the time to add, 
				if(($flag == 2 || $flag == 3) && $rowr['group_sub_recurring'] == 1)
				{
					if(($mc_gross + 0.00) >= $rowr['group_amount'])
					{
						$group_period_basis = $rowr['group_period_basis'];
						$group_period = $rowr['group_period'];
					}
					else if( ($mc_gross + 0.00) >= $rowr['group_second_trial_fee']
						 && $rowr['group_second_trial_period'] > 0 )
					{
						$group_period_basis = $rowr['group_second_trial_period_basis'];
						$group_period = $rowr['group_second_trial_period'];
					}
					else if(($mc_gross + 0.00) >= $rowr['group_first_trial_fee']
					          && $rowr['group_first_trial_period'] > 0 )
					{
						$group_period_basis = $rowr['group_first_trial_period_basis'];
						$group_period = $rowr['group_first_trial_period'];
					}
					else
					{
						fclose ($fp);
						$message = $lang['LW_UPDATE_USER_ACCT_ERROR'] . '<br /><br />' .  sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>');
						message_die(GENERAL_MESSAGE, $message);
					        exit;
					}
					
				}
				if(strcasecmp($group_period_basis, 'D') == 0 )
				{
					$add_days = $group_period;
				}
				if(strcasecmp($group_period_basis, 'W') == 0 )
				{
					$add_days = $group_period * 7;
				}
				if(strcasecmp($group_period_basis, 'M') == 0 )
				{
					$add_months = $group_period;
				}
				if(strcasecmp($group_period_basis, 'Y') == 0 )
				{
					$add_years = $group_period;
				}
				//end cal the time to add, 
				
				//now start cal the extra time
				//if this group previous expiration date is zero, give him extra time.
				$extradays = 0;
				if( $prevexpiredate <= 0)
				{
					$extradays = $board_config['extra_days_for_sub'] + 0;
				}					
				//end now start cal the extra time
				
				if($prevexpiredate <= time())
				{
					$expiretime = mktime(date("G")+1, 0, 0, date("m")+$add_months, date("d")+$add_days+$extradays,  date("Y")+$add_years);
				}
				else
				{
					$expiretime = mktime(date("G", $prevexpiredate)+1, 0, 0, date("m", $prevexpiredate)+$add_months, date("d", $prevexpiredate)+$add_days+$extradays,  date("Y", $prevexpiredate)+$add_years);
				}
				
				if($useringroup == 1)
				{
					$sql = "UPDATE " . USER_GROUP_TABLE . " SET ug_active_date = " . time() . ", ug_expire_date = " . $expiretime . " WHERE user_id = " . $user_id . " AND group_id = " . $group_id;			
				}
				else
				{
					$sql = "INSERT INTO " . USER_GROUP_TABLE . " (user_id, group_id, user_pending, ug_active_date, ug_expire_date) VALUES ($user_id, $group_id, 0, " . time() . ", " . $expiretime . ")";
				}
				if ( !($result = $db->sql_query($sql)) )
				{
					//do nothing
				}
				//here is to set the time flag to prevent user enjoy trial period again and again. 
				if( $row['user_expire_date'] == 0)
				{
					$sql = "UPDATE " . USERS_TABLE . " SET user_active = 1, user_actkey='', user_actviate_date = " . time() . ", user_expire_date = " . $expiretime . " WHERE user_id = " . $user_id;	
					if ( !($result = $db->sql_query($sql)) )
					{
						//do nothing
					}
				}
			}
			
	
		}
	
		$sql = "INSERT INTO " . ACCT_HIST_TABLE . "(user_id, lw_post_id, lw_money, lw_plus_minus, MNY_CURRENCY, lw_date, comment, lw_site, status, txn_id) VALUES(" . $user_id . ", 0, " . ($mc_gross + 0.00) . ", -1, '" . str_replace("\'", "''", $mc_currency) . "', " . time() . ", 'pay from: " . str_replace("\'", "''", $payer_email) . " to: " . str_replace("\'", "''", $receiver_email) . " (" . str_replace("\'", "''", $txn_type) . ")', '" . $table_prefix . "', '" . str_replace("\'", "''", $payment_status) . "', '" . str_replace("\'", "''", $txn_id) . "')";
		if ( !($result = $db->sql_query($sql)) )
		{
			//do nothing
		}
}
else if (strcmp ($res, "INVALID") == 0) {
// log for manual investigation
	$sql = "INSERT INTO " . ACCT_HIST_TABLE . "(user_id, lw_post_id, lw_money, lw_plus_minus, MNY_CURRENCY, lw_date, comment, lw_site, status, txn_id) VALUES(0, 0, " . str_replace("\'", "''", $mc_gross) . ", 1, '" . str_replace("\'", "''", $mc_currency) . "', " . time() . ", 'pay from: " . str_replace("\'", "''", $payer_email) . " to: " . str_replace("\'", "''", $receiver_email) . ", INVALID (" . str_replace("\'", "''", $txn_type) . ")', '$table_prefix', '" . str_replace("\'", "''", $payment_status) . "', '" . str_replace("\'", "''", $txn_id) . "')";
	if ( !($result = $db->sql_query($sql)) )
	{
		//do nothing
	}

}
}
fclose ($fp);
}

$message = $lang['LW_PAYMENT_DONE'] . '<br /><br />' .  sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>');
message_die(GENERAL_MESSAGE, $message);
exit;
		
/*
// Remove Echo below when live
//echo $ipnreport;
		if($verifymode == 2)
		{
			send_mail("$send_mail_to", "$sysname", "\n Verified IPN Transaction\n \n$ipnreport\n");
		}
            }

// IPN was Not Validated as Genuine and is INVALID
            elseif (!strcmp ($reply, "INVALID"))
            {

/* Now that IPN was INVALID below are a few things which you may want to do at this point.
 1. Check your code for any post back Validation problems!
 2. Investigate the Fact that this Could be an attack on your script IPN!
 3. If updating your DB, Ensure this "txn_id" is Not a Duplicate!
*/
/*
// Remove Echo line below when live
//echo $ipnreport;
send_mail("$send_mail_to", "$sysname", "\n IN Valid IPN Transaction\n \n$ipnreport\n");
                                  }

            else
            {

// Serious problem at this point?
// Remove Echo line below when live
//echo $ipnreport;
send_mail("$send_mail_to", "$sysname", "\n FATAL ERROR Please Investigate\n \n$ipnreport\n");
            }


// Terminate the Socket connection and Exit
	fclose ($port); 
	
	$message = $lang['LW_PAYMENT_DONE'] . '<br /><br />' .  sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>');
	message_die(GENERAL_MESSAGE, $message);
	
	exit;
      }

*/      
      
      
      
      
      
/* =================================
         Below are functions
   ================================= */
   
// Email function
function send_mail($to, $subj, $body)
{
    global $from_name, $from_email, $mailpath;

// E-mail Configuration
	$announce_subject = "$subj";
	$announce_from_email = "$from_email";
	$announce_from_name = "$from_name";
	$announce_to_email = "$to";
	$MP = "$mailpath"; 
	$spec_envelope = 1;
	// End email config
// Access Sendmail
// Conditionally match envelope address
	if(isset($spec_envelope))
	{
	$MP .= " -f $announce_from_email";
	}
	$fd = popen($MP,"w"); 
	fputs($fd, "To: $announce_to_email\n"); 
	fputs($fd, "From: $announce_from_name <$announce_from_email>\n");
	fputs($fd, "Subject: $announce_subject\n"); 
	fputs($fd, "X-Mailer: MyPayPal_Mailer\n");
	fputs($fd, "Content-Type: text/html\n");
	fputs($fd, $body); // $body will be sent when the function is used
	pclose($fd);
}



?>


