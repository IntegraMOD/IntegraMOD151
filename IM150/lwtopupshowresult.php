<?php
/***************************************************************************
 *				lwtopupshowresult.php
 *							
 *	begin				: SEP/01/2004
 *	copyright			: Loewen Enterprise - Xiong Zou
 *	email				: zouxiong@loewen.com.sg
 *
 *	version				: 1.0.0.1 - SEP/03/2004
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

//
// Set page ID for session management
//
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);
//
// End session management
//

	if(isset($HTTP_POST_VARS['txn_id']) || isset($HTTP_GET_VARS['tx']))
	{
		$txn_id = isset($HTTP_POST_VARS['txn_id']) ? htmlspecialchars($HTTP_POST_VARS['txn_id']) : htmlspecialchars($HTTP_GET_VARS['tx']);
	}
	if(isset($HTTP_POST_VARS['mc_currency']) || isset($HTTP_GET_VARS['cc']))
	{
		$payment_currency = isset($HTTP_POST_VARS['mc_currency']) ? htmlspecialchars($HTTP_POST_VARS['mc_currency']) : htmlspecialchars($HTTP_GET_VARS['cc']);
	}
	if(isset($HTTP_POST_VARS['mc_gross']) || isset($HTTP_GET_VARS['amt']))
	{
		$payment_amount = isset($HTTP_POST_VARS['mc_gross']) ? htmlspecialchars($HTTP_POST_VARS['mc_gross']) : htmlspecialchars($HTTP_GET_VARS['amt']);
	}
	if(isset($HTTP_POST_VARS['payment_status']) || isset($HTTP_GET_VARS['st']))
	{
		$payment_status = isset($HTTP_POST_VARS['payment_status']) ? htmlspecialchars($HTTP_POST_VARS['payment_status']) : htmlspecialchars($HTTP_GET_VARS['st']);
	}


	if(strcasecmp($payment_status, 'Completed') == 0)
	{
		$message .= $lang['LW_PAYMENT_DONE'];
	}
	else if(strcasecmp($payment_status, 'Pending') == 0)
	{
		$message .= sprintf($lang['LW_PAYMENT_PENDDING'], $payer_email);
	}
	else if(strcasecmp($payment_status, 'Denied') == 0)
	{
		$message .= $lang['LW_PAYMENT_DENIED'];
	}
	else if(strcasecmp($payment_status, 'Failed') == 0)
	{
		$message .= $lang['LW_PAYMENT_FAILED'];
	}
	else
	{
		$message .= $lang['LW_PAYMENT_SUBSCRIPTION'];
	}
	
	$message .= '<br /><br />' .  sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>');
 	message_die(GENERAL_MESSAGE, $message);

 
        exit;


?>


