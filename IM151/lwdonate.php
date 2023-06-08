<?php
/***************************************************************************
 *				lwdonate.php
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

if(strlen($board_config['paypal_p_acct']) <= 0)
{
	message_die(GENERAL_ERROR, $lang['LW_PAYPAL_ACCT_ERROR']);
	exit;
}

include($phpbb_root_path . 'includes/page_header.'.$phpEx);

//
// template file
$template->set_filenames(array(
	'body' => 'lwdonate_body.tpl')
	);

$currencydisplay = '';
$currencyoptions = '';
if(strlen($board_config['donate_currencies']) < 4)
{
	$board_config['donate_currencies'] = $board_config['paypal_currency_code'] . ";";
}
$currencyoptions = '<select name="currency_code" >';

if(strpos($board_config['donate_currencies'], 'USD', 0) !== false)
{
	$currencydisplay = 'US Dollar';
	$selected = '';
	if(strcasecmp($board_config['paypal_currency_code'], 'USD') == 0)
	{
		$selected = 'selected';
	}
	$currencyoptions .= ('<option value="USD" ' . $selected . '>' . $currencydisplay . '</option>');
}
if(strpos($board_config['donate_currencies'], 'EUR', 0) !== false)
{
	$currencydisplay = 'Euros';
	$selected = '';
	if(strcasecmp($board_config['paypal_currency_code'], 'EUR') == 0)
	{
		$selected = 'selected';
	}
	$currencyoptions .= ('<option value="EUR" ' . $selected . '>' . $currencydisplay . '</option>');
}
if(strpos($board_config['donate_currencies'], 'GBP', 0) !== false)
{
	$currencydisplay = 'Pounds Sterling';
	$selected = '';
	if(strcasecmp($board_config['paypal_currency_code'], 'GBP') == 0)
	{
		$selected = 'selected';
	}
	$currencyoptions .= ('<option value="GBP" ' . $selected . '>' . $currencydisplay . '</option>');
}
if(strpos($board_config['donate_currencies'], 'CAD', 0) !== false)
{
	$currencydisplay = 'Canadian Dollar';
	$selected = '';
	if(strcasecmp($board_config['paypal_currency_code'], 'CAD') == 0)
	{
		$selected = 'selected';
	}
	$currencyoptions .= ('<option value="CAD" ' . $selected . '>' . $currencydisplay . '</option>');
}
if(strpos($board_config['donate_currencies'], 'JPY', 0) !== false)
{
	$currencydisplay = 'Yen';
	$selected = '';
	if(strcasecmp($board_config['paypal_currency_code'], 'JPY') == 0)
	{
		$selected = 'selected';
	}
	$currencyoptions .= ('<option value="JPY" ' . $selected . '>' . $currencydisplay . '</option>');
}
$currencyoptions .= '</select>';

$template->assign_vars(array(
		'U_INDEX'		=> append_sid('index.'.$phpEx),
		'L_INDEX'		=> sprintf($lang['Forum_Index'], $board_config['sitename']),
		'S_LW_TOPUP'		=> append_sid('lwdonate.'.$phpEx),
		'L_LW_TOPUP'		=> $lang['LW_ACCT_DONATE_INTO'],
		'LW_PAYPAL_ACTION'	=> append_sid('lwdonateconfirm.'.$phpEx),	
		'L_LW_TOPUP_TITLE'	=> $lang['LW_DONATE_TITLE'], 	
		'L_LW_AMOUNT_TO_PAY'	=> $lang['LW_AMOUNT_TO_DONATE'], 	
		'L_LW_AMOUNT_TO_PAY_EXPLAIN' => $lang['LW_AMOUNT_TO_DONATE_EXPLAIN'],
		'L_LW_CURRENCY_TO_PAY'	=> $lang['LW_CURRENCY_TO_PAY'],
		'L_LW_CURRENCY_TO_PAY_EXPLAIN' => sprintf($lang['LW_CURRENCY_TO_PAY_EXPLAIN'], $board_config['donate_currencies']),
		'LW_WANT_ANONYMOUS' => $lang['LW_WANT_ANONYMOUS'],
		'L_LW_DONATE_WAY' => $lang['L_LW_DONATE_WAY'],
		'LW_CURRENCY_OPTIONS' => $currencyoptions,
		)
	);
	
// page
$template->pparse('body');

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>


