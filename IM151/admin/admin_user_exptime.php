<?php

/***************************************************************************
 *				admin_user_exptime.php
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
 

if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['Users']['Subscription'] = $filename;

	return;
}
define('IN_PHPBB', 1);


//
// Let's set the root dir for phpBB
//
$phpbb_root_path = '../';
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
require($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_ipn_grp.' . $phpEx);


$mode = '';
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
if( $mode == 'edit')
{
	$username = '';
	if( isset($_POST['username']) || isset($_GET['username']) )
	{
		$username = (isset($_POST['username'])) ? $_POST['username'] : $_GET['username'];	
	}
	if( strlen(trim($username)) <= 0 )
	{
		message_die(GENERAL_ERROR, "No such user.");		
		exit;
	}
	
	$template->set_filenames(array(
		'body' => 'admin/subscription_config_body.tpl')
	);
	$sql = "SELECT * FROM " . USERS_TABLE . " WHERE username = '" . $username . "'";
	if(!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, "No such user.", "", __LINE__, __FILE__, $sql);
		exit;
	}
	if( !($userinfo = $db->sql_fetchrow($result)) )
	{
		message_die(GENERAL_ERROR, "No such user.", "", __LINE__, __FILE__, $sql);
		exit;
	}
	
	
	$sql = "SELECT g.* FROM " . GROUPS_TABLE . " g WHERE g.group_type = " . GROUP_PAYMENT . " AND g.group_amount > 0";
	if(!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, "Couldn't obtain payment group information.", "", __LINE__, __FILE__, $sql);
		exit;
	}
	$paymentgroups = $db->sql_fetchrowset($result);
	$sql = "SELECT g.*, ug.* FROM " . GROUPS_TABLE . " g, " . USER_GROUP_TABLE . " ug WHERE g.group_type = " . GROUP_PAYMENT . " AND g.group_amount > 0 AND g.group_id = ug.group_id AND ug.user_id = " . $userinfo['user_id'];
	if(!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, "Couldn't obtain user group information.", "", __LINE__, __FILE__, $sql);
		exit;
	}
	$usergroups = $db->sql_fetchrowset($result);
	
	
	for($i = 0; $i < count($paymentgroups); $i++)
	{
		$userinthisgrp = 0;
		$expiretime = '0';
		$expiretimeinint = 0;
		for($j = 0; $j < count($usergroups); $j++)
		{
			if($paymentgroups[$i]['group_id'] == $usergroups[$j]['group_id'])
			{
				$userinthisgrp = 1;
				$expiretime = date("Y/m/d H:i:s", $usergroups[$j]['ug_expire_date']);
				$expiretimeinint = $usergroups[$j]['ug_expire_date'];
			}
		}
		
		$row_color = ( $i % 2 ) ? $theme['td_color1'] : $theme['td_color2'];
		$row_class = ( $i % 2 ) ? $theme['td_class1'] : $theme['td_class2'];
		
		
		$ingrpselect = '';
		$notingrpselect = '';
		if($userinthisgrp == 1)
		{
			$ingrpselect = 'selected';
		}
		else
		{
			$notingrpselect = 'selected';
		}
		$ingrpornot = "<select name=\"ingrpornot\">";
		$ingrpornot .= "<option value=1 $ingrpselect>" . $lang['L_IPN_user_sub_yes'] . "</option>";
		$ingrpornot .= "<option value=0 $notingrpselect>" . $lang['L_IPN_user_sub_no'] . "</option>";
		$ingrpornot .= "</select>";
		
		$expiretimefield = "<input class=\"post\" type=\"text\" maxlength=\"255\" name=\"user_expire_date\" value=\"" . $expiretime . "\" />";
		

		$template->assign_block_vars("lw_sub_user_row", array(
			"LW_SUB_GRP_FORM_ACTION_S" => '<form method="post" name="post" action="' . append_sid("admin_user_exptime.$phpEx") . '">',
			"LW_SUB_GRP_FORM_ACTION_E" => '<input type="hidden" name="username" value="' . $userinfo['username'] . '"><input type="hidden" name="user_table_expiretime" value="' . $userinfo['user_expire_date'] . '"><input type="hidden" name="user_id" value="' . $userinfo['user_id'] . '"><input type="hidden" name="prev_expiredate" value="' . $expiretimeinint . '"><input type="hidden" name="prev_ingrpornot" value="' . $userinthisgrp . '"><input type="hidden" name="group_id" value="' . $paymentgroups[$i]['group_id'] . '"></form>',
			"ROW_COLOR" => "#" . $row_color,
			"ROW_CLASS" => $row_class,
			"LW_SUB_GRP_PROFILE" => append_sid('admin_groups.' . $phpEx . '?' . POST_GROUPS_URL . '=' . $paymentgroups[$i]['group_id'] . '&edit=view'),
			"LW_SUB_GRP_NAME" => $paymentgroups[$i]['group_name'], 
			"LW_SUB_GRP_INORNOT" => $ingrpornot, 
			"LW_SUB_EXPTIME" => $expiretimefield,
			"LW_SUB_ACTION" => '<input type="submit" name="mode" value="' . $lang['L_IPN_user_sub_Update'] . '" class="mainoption" />',
			)
		);

	}

	$template->assign_vars(array(
		'L_LW_SUBSCRIPTIONS' => $lang['L_IPN_user_sub_info'] . "<br />" . $userinfo['username'],
		'L_LW_SUB_EXPLAIN' => $lang['L_IPN_user_sub_info_exp'],
		'L_LW_SUB_GROUP_NAME' => $lang['L_IPN_grp_name'],
		'L_LW_SUB_GROUP_INORNOT' => $lang['L_IPN_grp_inornot'],
		'L_LW_SUB_EXPIRATION' => $lang['L_IPN_grp_expire_date'],
		'L_LW_SUB_ACTION' => $lang['L_IPN_grp_action'],
		)
	);
	

	$template->pparse('body');
		
}
else if( $mode == $lang['L_IPN_user_sub_Update'] )
{
	$group_id = intval($_POST['group_id']);
	$user_id = intval($_POST['user_id']);
	if($group_id <= 0 || $user_id <= 0 )
	{
		message_die(GENERAL_ERROR, "Couldn't update user group information.", "", __LINE__, __FILE__, $sql);
		exit;
	}
	$ingrpornot = intval($_POST['ingrpornot']);
	$prev_ingrpornot = intval($_POST['prev_ingrpornot']);
	$user_expire_date_str = str_replace("\'", "''", htmlspecialchars(trim($_POST['user_expire_date'])));
	$username = str_replace("\'", "''", htmlspecialchars(trim($_POST['username'])));
	
	$prev_expiredate = intval($_POST['prev_expiredate']);
	$user_table_expiretime = intval($_POST['user_table_expiretime']);
	
	
	$userexpiretime = $prev_expiredate;
	if(strlen($user_expire_date_str) == strlen("yyyy/mm/dd hh:mm:ss"))
	{
		$userexpiretime = mktime(substr($user_expire_date_str, 11, 2), substr($user_expire_date_str, 14, 2), substr($user_expire_date_str, 17, 2), substr($user_expire_date_str, 5, 2), substr($user_expire_date_str, 8, 2), substr($user_expire_date_str, 0, 4));
	}
	
	if($ingrpornot != $prev_ingrpornot)
	{
		if($ingrpornot == 0) //remove from current group
		{
			$sql = "DELETE FROM " . USER_GROUP_TABLE . " WHERE group_id = " . $group_id . " AND user_id = " . $user_id;
			if( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, "Couldn't update user group information.", "", __LINE__, __FILE__, $sql);
				exit;
			}
		}
		else if($ingrpornot == 1) //insert into current group 
		{
			$sql = "INSERT INTO " . USER_GROUP_TABLE . " (user_id, group_id, user_pending, ug_expire_date, ug_active_date) VALUES(" . $user_id . ", " . $group_id . ", 0, " . $userexpiretime . ", " . time() . ")";
			if( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, "Couldn't update user group information.", "", __LINE__, __FILE__, $sql);
				exit;
			}
			if($user_table_expiretime <= 0 && $userexpiretime > 0)
			{
				$sql = "UPDATE " . USERS_TABLE . " SET user_actviate_date = " . time() . ", user_expire_date = " . $userexpiretime . " WHERE user_id = " . $user_id;	
				if( !($result = $db->sql_query($sql)) )
				{
					//do nothing
				}
			}		
		}
	}
	else
	{
		if($ingrpornot == 1 && $userexpiretime != $prev_expiredate) //if user in group and need to update expiration date
		{
			$sql = "UPDATE " . USER_GROUP_TABLE . " SET ug_active_date = " . time() . ", ug_expire_date = " . $userexpiretime . " WHERE user_id = " . $user_id . " AND group_id = " . $group_id;			
			if( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, "Couldn't update user group information.", "", __LINE__, __FILE__, $sql);
				exit;
			}
			
		}
	}
	$message = $lang['L_IPN_user_sub_updated'] . "<br /><br />" . sprintf($lang['L_IPN_click_update_again'], "<a href=\"" . append_sid("admin_user_exptime.$phpEx?username=" . $username) . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");
	message_die(GENERAL_MESSAGE, $message);
	exit;
	
}
else
{
	//
	// Default user selection box
	//
	$template->set_filenames(array(
		'body' => 'admin/user_select_body.tpl')
	);

	$template->assign_vars(array(
		'L_USER_TITLE' => $lang['L_IPN_user_sub_title'],
		'L_USER_EXPLAIN' => $lang['L_IPN_user_sub_enplain'],
		'L_USER_SELECT' => $lang['Select_a_User'],
		'L_LOOK_UP' => $lang['Look_up_user'],
		'L_FIND_USERNAME' => $lang['Find_username'],

		'U_SEARCH_USER' => append_sid("./../search.$phpEx?mode=searchuser"), 

		'S_USER_ACTION' => append_sid("admin_user_exptime.$phpEx"),
		'S_USER_SELECT' => ( isset($select_list ) ? $select_list : '' ),
	));
	$template->pparse('body');
}


include('./page_footer_admin.'.$phpEx);

?>
