<?php
/***************************************************************************
 *				admin_sub_settings.php
 *
 *	begin				: OCT/29/2004
 *	copyright			: Loewen Enterprise - Xiong Zou
 *	email				: zouxiong@loewen.com.sg
 *
 *	version				: 1.0.0.1 - OCT/29/2004
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

define('IN_PHPBB', 1);

if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['Subscription_Admin']['Settings'] = $filename;

	return;
}

//
// Let's set the root dir for phpBB
//
$phpbb_root_path = '../';
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
require($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_ipn_grp.' . $phpEx);

$mode = "";
if( isset($_POST['mode']) || isset($_GET['mode']) )
{
	$mode = (isset($_POST['mode'])) ? trim($_POST['mode']) : trim($_GET['mode']);
}

if($mode == $lang['L_SUBMIT'])
{
	// Get posting variables
	$newdata = array();
	$count = 0;
	$extra_days_for_sub = str_replace("\'", "''", htmlspecialchars(trim($_POST['extra_days_for_sub'])));
	$newdata[$count]['config_value'] = $extra_days_for_sub;
	$newdata[$count]['config_name'] = 'extra_days_for_sub';
		
	for($i = 0; $i <= $count; $i++ )
	{
		$sql = "UPDATE " . CONFIG_TABLE . " SET
			config_value = '" . str_replace("\'", "''", $newdata[$i]['config_value']) . "'
			WHERE config_name = '" . $newdata[$i]['config_name'] . "'";
		if( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, sprintf($lang['update_sub_settings_error'], $newdata[$i]['config_name']), "", __LINE__, __FILE__, $sql);
			exit;
		}
	}

	// Return a message...
	$message = $lang['sub_settings_updated'] . "<br /><br />" . sprintf($lang['Click_return_update_sub_settings'], "<a href=\"" . append_sid("admin_sub_settings.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

	message_die(GENERAL_MESSAGE, $message);
	exit;
}
else
{
	$template->set_filenames(array(
		'body' => 'admin/admin_sub_settings_body.tpl')
	);

		$template->assign_vars(array(
		'L_SUB_SETTINGS_TITLE' => $lang['L_SUB_SETTINGS_TITLE'],
		'L_SUB_SETTINGS_EXPLAIN' => $lang['L_SUB_SETTINGS_EXPLAIN'],
		'L_SUB_SETTINGS' => $lang['L_SUB_SETTINGS'],
		'L_SUB_EXTRA_DAYS' => $lang['L_SUB_EXTRA_DAYS'],
		'L_SUB_EXTRA_DAYS_EXPLAIN' => $lang['L_SUB_EXTRA_DAYS_EXPLAIN'],
		'SUB_EXTRA_DAYS' => ( isset($board_config['extra_days_for_sub']) ? $board_config['extra_days_for_sub'] : ''),

		'S_SUB_SETTINGS_ACTION' => append_sid("admin_sub_settings.$phpEx"),
		'S_HIDDEN_FIELDS' => '',


		'L_SUBMIT' => $lang['L_SUBMIT'],
		'L_RESET' => $lang['L_RESET'],
		)
	);

	$template->pparse('body');
	include('./page_footer_admin.'.$phpEx);
	
}

?>
