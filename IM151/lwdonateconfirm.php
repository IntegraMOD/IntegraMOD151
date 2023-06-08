<?php
/***************************************************************************
 *				lwdonateconfirm.php
 *							
 *	begin				: 14/SEP/2004
 *	copyright			: Zou Xiong - Loewen Enterprise
 *	email				: admin@loewen.com.sg
 *
 *	version				: 1.0.0.1 - 23/OCT/2004
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
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);
//
// End session management
//
//if( !$userdata['session_logged_in'] )
//{
//   header("Location: " . append_sid($phpbb_script_path . "login." . $phpEx . "?redirect=" . "lwtopup." . $phpEx));
//   exit;
//}

if(strlen($board_config['paypal_b_acct']) <=0 
	|| strlen($board_config['paypal_p_acct']) <=0 )
{
	message_die(GENERAL_ERROR, $lang['LW_PAYPAL_ACCT_ERROR']);
	exit;
}

include($phpbb_root_path . 'includes/page_header.'.$phpEx);

//
// template file
$template->set_filenames(array(
	'body' => 'lwtopupconfirm_body.tpl')
	);

$server_url = "http://" . $board_config['server_name'];
$server_url .= ($board_config['server_port'] == 80) ? '' : ':' . $board_config['server_port'];
$server_url .= $board_config['script_path'];
$pos = strpos($board_config['script_path'], '/', (strlen($board_config['script_path']) - 1));
if($pos === false)
{
	$server_url .= '/';
}

$notifyurl = $server_url . 'lwdonateresult.' . $phpEx;
$returnurl = $server_url . 'lwdonateshowresult.' . $phpEx;

$anonymous = intval($_POST['lw_anonymous']) + 0;
if($anonymous != 1)
{
	$anonymous = 0;
}


$amountopay = htmlspecialchars($_POST['amount']) + 0.00 ;
$currency = htmlspecialchars($_POST['currency_code']);

if(strlen($board_config['donate_currencies']) < 4) //if not set, so just use the primary currency code
{
	$board_config['donate_currencies'] = $board_config['paypal_currency_code'] . ";";
}
if($amountopay <= 0 || strpos($board_config['donate_currencies'], $currency) === false)
{
	$message = $lang['LW_PAYMENT_DATA_ERROR'] . '<br /><br />' . sprintf($lang['Click_return_login'], "<a href=\"lwdonate.$phpEx\">", '</a>') . '<br /><br />' .  sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>');
	message_die(GENERAL_MESSAGE, $message);
	exit;
}
$receiveacct = $board_config['paypal_b_acct'];
if($amountopay < 1)
{
	$receiveacct = $board_config['paypal_p_acct'];
}

//modify to add posts count
$l_lw_amount_pay = $lang['LW_AMOUNT_TO_DONATE'] . $amountopay . ' ' . $currency;

$poster_convertor = lw_cal_cash_exchange_rate($currency, $board_config) + 0; 
if($poster_convertor <= 0)
{
	$poster_convertor = 1.0;
}
	
$lw_mny_payee = ($amountopay + 0.00) / ($poster_convertor);

if(!$userdata['session_logged_in'])
{
	//do nothing	
}
else if(intval($board_config['donate_to_points']) > 0)
{
//	$l_lw_amount_pay .= '<br>' . sprintf($lang['LW_DONATION_TO_POINTS'], intval(intval($board_config['donate_to_points']) * $amountopay));
	$l_lw_amount_pay .= '<br>' . sprintf($lang['LW_DONATION_TO_POINTS'], intval(intval($board_config['donate_to_points']) * $lw_mny_payee));
}
else if(intval($board_config['donate_to_posts']) > 0)
{
//	$l_lw_amount_pay .= '<br>' . sprintf($lang['LW_DONATION_TO_POSTS'], intval(intval($board_config['donate_to_posts']) * $amountopay));
	$l_lw_amount_pay .= '<br>' . sprintf($lang['LW_DONATION_TO_POSTS'], intval(intval($board_config['donate_to_posts']) * $lw_mny_payee));
}  

$template->assign_vars(array(
		'U_INDEX'		=> append_sid('index.'.$phpEx),
		'L_INDEX'		=> sprintf($lang['Forum_Index'], $board_config['sitename']),
		'S_LW_TOPUP'		=> append_sid('lwdonate.'.$phpEx),
		'L_LW_TOPUP'		=> $lang['LW_ACCT_DONATE_INTO'],
		'LW_PAYPAL_ACTION'	=> 'https://www.paypal.com/cgi-bin/webscr',
		'L_LW_TOPUP_TITLE'	=> $lang['LW_DONATE_CONFIRM_TITLE'],
		'L_LW_AMOUNT_TO_PAY'	=> $l_lw_amount_pay,
		'LW_PAYPAL_LOGO' 	=> 'http://www.paypal.com/en_US/i/btn/x-click-but04.gif',
		'LW_PAY_AMOUNT'		=> $amountopay,
		'LW_PAY_CURRENCY'	=> $currency,
		'LW_BUSINESS_ACCT'	=> $receiveacct,
		'LW_ITEM_NAME'		=> sprintf($lang['LW_DONATION_TO_WHO'], $board_config['sitename']),
		'LW_ITEM_NUMBER'	=> ($userdata['user_id'] <= 0 ? 0 : $userdata['user_id']) . '-' . $anonymous,
		'LW_NOTIFY_URL'		=> $notifyurl,
		'LW_RETURN_URL'		=> $returnurl,
		'LW_CANCEL_RETURN_URL'	=> $returnurl,
		)
	);

// page
$template->pparse('body');

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>


