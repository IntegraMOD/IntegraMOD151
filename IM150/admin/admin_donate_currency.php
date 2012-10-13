<?php
/***************************************************************************
 *				admin_donate_currency.php
 *							
 *	begin				: 23/OCT/2004
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

// Admin Panel
if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['Donates']['Currency_Management'] = $filename;	
	return;
}
//
// Let's set the root dir for phpBB
//
$phpbb_root_path = '../';
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
require($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_donate_curreny.' . $phpEx);

$mode = "";
if( isset($HTTP_POST_VARS['mode']) || isset($HTTP_GET_VARS['mode']) )
{
	$mode = (isset($HTTP_POST_VARS['mode'])) ? trim($HTTP_POST_VARS['mode']) : trim($HTTP_GET_VARS['mode']);
}

if($mode == $lang['L_SUBMIT'])
{
	// Get posting variables
	$newdata = array();
	$count = 0;
	$donate_currencies = str_replace("\'", "''", htmlspecialchars(trim($HTTP_POST_VARS['donate_currencies'])));
	$newdata[$count]['config_value'] = $donate_currencies;
	$newdata[$count]['config_name'] = 'donate_currencies';
	
	$paypal_currency_code = str_replace("\'", "''", htmlspecialchars(trim($HTTP_POST_VARS['paypal_currency_code'])));
	$count += 1;
	$newdata[$count]['config_value'] = $paypal_currency_code;
	$newdata[$count]['config_name'] = 'paypal_currency_code';

	$usd_to_primary = str_replace("\'", "''", htmlspecialchars(trim($HTTP_POST_VARS['usd_to_primary'])));
	$count += 1;
	$newdata[$count]['config_value'] = $usd_to_primary;
	$newdata[$count]['config_name'] = 'usd_to_primary';

	$eur_to_primary = str_replace("\'", "''", htmlspecialchars(trim($HTTP_POST_VARS['eur_to_primary'])));
	$count += 1;
	$newdata[$count]['config_value'] = $eur_to_primary;
	$newdata[$count]['config_name'] = 'eur_to_primary';

	$gbp_to_primary = str_replace("\'", "''", htmlspecialchars(trim($HTTP_POST_VARS['gbp_to_primary'])));
	$count += 1;
	$newdata[$count]['config_value'] = $gbp_to_primary;
	$newdata[$count]['config_name'] = 'gbp_to_primary';

	$cad_to_primary = str_replace("\'", "''", htmlspecialchars(trim($HTTP_POST_VARS['cad_to_primary'])));
	$count += 1;
	$newdata[$count]['config_value'] = $cad_to_primary;
	$newdata[$count]['config_name'] = 'cad_to_primary';

	$jpy_to_primary = str_replace("\'", "''", htmlspecialchars(trim($HTTP_POST_VARS['jpy_to_primary'])));
	$count += 1;
	$newdata[$count]['config_value'] = $jpy_to_primary;
	$newdata[$count]['config_name'] = 'jpy_to_primary';
	
	for($i = 0; $i <= $count; $i++ )
	{
		$sql = "UPDATE " . CONFIG_TABLE . " SET
			config_value = '" . str_replace("\'", "''", $newdata[$i]['config_value']) . "'
			WHERE config_name = '" . $newdata[$i]['config_name'] . "'";
		if( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, sprintf($lang['update_currency_info_error'], $newdata[$i]['config_name']), "", __LINE__, __FILE__, $sql);
			exit;
		}
	}

	// Return a message...
	$message = $lang['Currency_information_updated'] . "<br /><br />" . sprintf($lang['Click_return_update_currencies'], "<a href=\"" . append_sid("admin_donate_currency.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

	message_die(GENERAL_MESSAGE, $message);
	exit;
}
else
{
	$template->set_filenames(array(
		'body' => 'admin/donate_currency_config_body.tpl')
	);

		$template->assign_vars(array(
		'L_CURRENCY_CONFIGURATION_TITLE' => $lang['L_CURRENCY_CONFIGURATION_TITLE'],
		'L_CURRENCY_CONFIGURATION_EXPLAIN' => $lang['L_CURRENCY_CONFIGURATION_EXPLAIN'],
		'L_CURRENCY_GENERAL_SETTINGS' => $lang['L_CURRENCY_GENERAL_SETTINGS'],
		'L_DONATE_CURRENCY' => $lang['L_DONATE_CURRENCY'],
		'L_DONATE_CURRENCY_EXPLAIN' => $lang['L_DONATE_CURRENCY_EXPLAIN'],
		'DONATE_CURRENCY' => $board_config['donate_currencies'],
		'L_DONATE_CURRENCY_PRI' => $lang['L_DONATE_CURRENCY_PRI'],
		'L_DONATE_CURRENCY_PRI_EXPLAIN' => $lang['L_DONATE_CURRENCY_PRI_EXPLAIN'],
		'DONATE_CURRENCY_PRI' => $board_config['paypal_currency_code'],
		
		'L_DONATE_USD_TO_PRI' => $lang['L_DONATE_USD_TO_PRI'],
		'DONATE_USD_TO_PRI' => $board_config['usd_to_primary'],
		'L_DONATE_EUR_TO_PRI' => $lang['L_DONATE_EUR_TO_PRI'],
		'DONATE_EUR_TO_PRI' => $board_config['eur_to_primary'],
		'L_DONATE_GBP_TO_PRI' => $lang['L_DONATE_GBP_TO_PRI'],
		'DONATE_GBP_TO_PRI' => $board_config['gbp_to_primary'],
		'L_DONATE_CAD_TO_PRI' => $lang['L_DONATE_CAD_TO_PRI'],
		'DONATE_CAD_TO_PRI' => $board_config['cad_to_primary'],
		'L_DONATE_JPY_TO_PRI' => $lang['L_DONATE_JPY_TO_PRI'],
		'DONATE_JPY_TO_PRI' => $board_config['jpy_to_primary'],

		'S_CURRENCY_CONFIG_ACTION' => append_sid("admin_donate_currency.$phpEx"),
		'S_HIDDEN_FIELDS' => '',


		'L_SUBMIT' => $lang['L_SUBMIT'],
		'L_RESET' => $lang['L_RESET'],
		)
	);

	$template->pparse('body');
	include('./page_footer_admin.'.$phpEx);
	
}

?>