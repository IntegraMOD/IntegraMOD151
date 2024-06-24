<?php
/***************************************************************************
 *						profilcp_board_config.php
 *						-------------------------
 *	begin			: 11/08/2003
 *	copyright		: Ptirhiik
 *	email			: admin@rpgnet-fr.com
 *
 *	version			: 1.0.6 - 24/10/2003
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 *
 ***************************************************************************/

// start
if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
	exit;
}

include_once($phpbb_root_path . 'includes/usercp_profile.'.$phpEx);
// BEGIN CrackerTracker v5.x
include_once($phpbb_root_path . 'ctracker/classes/class_ct_userfunctions.' . $phpEx);
$profile_security = new ct_userfunctions();
$profile_security->handle_profile();
(isset($_POST['submit']))? $profile_security->password_functions() : null;
// END CrackerTracker v5.x

if ( !empty($setmodules) )
{
	// first pass : get main maps
	$w_maps = array();
  foreach ($user_maps as $map_name => $map_data)
	{
		$map_tree = explode('.', $map_name);
		if ( ($map_tree[0] = 'PCP') && !empty($map_data['custom']) )
		{
			// get this map
			$map_tree = explode('.', $map_name);
			$w_maps['name'][] = $map_name;
			$w_maps['depth'][] = count($map_tree)-1;
		}
	}

	// second pass : get sub maps
	$res_maps = array();
  foreach ($user_maps as $map_name => $map_data)
	{
		for ( $i=0; $i < count($w_maps['name']); $i++ )
		{
			if ( substr($map_name, 0, strlen($w_maps['name'][$i])) == $w_maps['name'][$i] )
			{
				// we must stay within 3 sub levels
				$map_tree = explode('.', $map_name);
				if ( ( (count($map_tree) - 1 - $w_maps['depth'][$i]) < 3 ) && ( (count($map_tree) - 1 - $w_maps['depth'][$i]) > 0 ) )
				{
					// map name
					$start = $w_maps['depth'][$i];
					$map_root = '';
					for ( $j=0; $j < $start; $j++ )
					{
						if ( !empty($map_tree[$j]) )
						{
							$map_root .= ( empty($map_root) ? '' : '.' ) . $map_tree[$j];
						}
					}

					// main menu
					$pgm = '';
					if ( (count($map_tree)-$start) == 0 )
					{
						$pgm = __FILE__;
					}
					$res_maps[ $map_tree[$start-1] ]['']['order'] = isset($user_maps[$map_root]['order']) ? $user_maps[$map_root]['order'] : 0;
					$res_maps[ $map_tree[$start-1] ]['']['pgm'] = $pgm;
					$res_maps[ $map_tree[$start-1] ]['']['shortcut'] = $user_maps[$map_root]['title'];
					$res_maps[ $map_tree[$start-1] ]['']['pagetitle'] = $user_maps[$map_root]['title'];

					// sub-menu
					$map_root .= ( empty($map_root) ? '' : '.' ) . $map_tree[$start];
					$res_maps[ $map_tree[$start-1] ][ $map_tree[$start] ]['order'] = ( isset($user_maps[$map_root]['order']) ? $user_maps[$map_root]['order'] : 0 );
					$res_maps[ $map_tree[$start-1] ][ $map_tree[$start] ]['pgm'] = __FILE__;
					$res_maps[ $map_tree[$start-1] ][ $map_tree[$start] ]['shortcut'] = $user_maps[$map_root]['title'];
					$res_maps[ $map_tree[$start-1] ][ $map_tree[$start] ]['pagetitle'] = $user_maps[$map_root]['title'];
					break;
				}
			}
		}
	}
	
	// process the maps found
  foreach ($res_maps as $main => $main_data)
	{
    foreach ($main_data as $sub => $data)
		{
			if ( empty($sub) )
			{
				pcp_set_menu( $main, $data['order'], $data['pgm'], $data['shortcut'], $data['pagetitle'] );
			}
			else
			{
				pcp_set_sub_menu( $main, $sub, $data['order'], $data['pgm'], $data['shortcut'], $data['pagetitle'] );
			}
		}
	}
	return;
}

// access to users admins and himself
if ( ($userdata['user_id'] != $view_userdata['user_id']) && !is_admin($userdata) ) return;

// create entry if NULL : fix isset issue
foreach ($view_userdata as $key => $data)
{
	if ($view_userdata[$key] == NULL )
	{
		$view_userdata[$key] = '';
	}
}

// levels
$is_prior = ( $level_prior[get_user_level($userdata)] > $level_prior[get_user_level($view_userdata)] ) || (get_user_level($userdata) == ADMIN_FOUNDER);
$is_admin = ( is_admin($userdata) && $is_prior );
$is_board_admin = $is_admin && ($userdata['user_level'] == ADMIN);
if($userdata['user_id'] == -1){
	$is_guest = 1;
} 
// everyone is user even the guest... or registration doesn't work
$is_user = 1;

//
// get all the mods settings
//
$mods = array();
$dir = @opendir($phpbb_root_path . 'includes/mods_settings');
while( $file = @readdir($dir) )
{
	if( preg_match("/^mod_.*?\." . $phpEx . "$/", $file) )
	{
		include($phpbb_root_path . 'includes/mods_settings/' . $file);
	}
}
@closedir($dir);

// main_menu

$menu_name = $sub;
if ( !isset($mods[$menu_name]['data']) )
{
	$menu_name = '';
}

// mod_id
$mod_id = 0;
if ( isset($_GET['mod']) || isset($_POST['mod_id']) )
{
	$mod_id = isset($_POST['mod_id']) ? intval($_POST['mod_id']) : intval($_GET['mod']);
}

// sub_id
$sub_id = 0;
if ( isset($_GET['msub']) || isset($_POST['mod_sub_id']) )
{
	$sub_id = isset($_POST['mod_sub_id']) ? intval($_POST['mod_sub_id']) : intval($_GET['msub']);
}

// build a key array
$mod_keys = array();
$mod_sort = array();
$sub_keys = array();
$sub_sort = array();

foreach ($mods[$menu_name]['data'] as $mod_name => $mod)
{
	// check if there is some users fields
	$found = false;
  foreach ($mod['data'] as $sub_name => $subdata)
	{
    foreach ($subdata['data'] as $field_name => $field)
		{
			$is_auth = auth_field($field);
			if ( ( ( !empty($field['user']) && isset($view_userdata[ $field['user'] ]) && !$board_config[ $field_name . '_over'] )  || !empty($field['system']) ) && $is_auth )
			{
				$found=true;
				break;
			}
		}
	}
	if ($found)
	{
		$i = count($mod_keys);
		$mod_keys[$i] = $mod_name;
		$mod_sort[$i] = $mod['sort'];

		// init sub levels
		$sub_keys[$i] = array();
		$sub_sort[$i] = array();

		// sub names
    foreach ($mod['data'] as $sub_name => $subdata)
		{
			if ( !empty($sub_name) )
			{
				// user fields in this level
				$found = false;
        foreach ($subdata['data'] as $field_name => $field)
				{
					$is_auth = auth_field($field);
					if ( ( ( !empty($field['user']) && isset($view_userdata[ $field['user'] ]) && !$board_config[ $field_name . '_over'] ) || !empty($field['system']) ) && $is_auth )
					{
						$found=true;
						break;
					}
				}
				if ($found)
				{
					$sub_keys[$i][] = $sub_name;
					$sub_sort[$i][] = $subdata['sort'];
				}
			}
		}
		@array_multisort($sub_sort[$i], $sub_keys[$i]);
	}
}

@array_multisort($mod_sort, $mod_keys, $sub_sort, $sub_keys);

// fix mod id
if ( $mod_id >= count($mod_keys) )
{
	$mod_id = 0;
}
if ( $sub_id >= ( isset($sub_keys[$mod_id]) ? count($sub_keys[$mod_id]) : 0 ) )
{
	$sub_id = 0;
}

// mod name
$mod_name = $mod_keys[$mod_id];

// sub name
$sub_name = isset($sub_keys[$mod_id][$sub_id]) ? $sub_keys[$mod_id][$sub_id] : '';

// buttons
$submit = isset($_POST['submit']);

// sessions
$sid = (isset($_POST['sid'])) ? $_POST['sid'] : 0;

// validate
if ($submit)
{
	// session id check
	if ($sid == '' || $sid != $userdata['session_id'])
	{
		$error = true;
		$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Session_invalid'];
	}

	// init for error
	$error = false;
	$error_msg = '';

	// format and verify data
  foreach ($mods[$menu_name]['data'][$mod_name]['data'][$sub_name]['data'] as $field_name => $field)
	{
		$user_field = $field['user'];
		$is_auth = auth_field($field);
		if ( isset($_POST[$user_field]) && $is_auth )
		{
			switch ($field['type'])
			{
				case 'LIST_RADIO':
				case 'LIST_DROP':
					$$user_field = $_POST[$user_field];
					if (!in_array($$user_field, $mods[$menu_name]['data'][$mod_name]['data'][$sub_name]['data'][$field_name]['values']))
					{
						$error = true;
						$msg = mods_settings_get_lang( $mods[$menu_name]['data'][$mod_name]['data'][$sub_name]['data'][$field_name]['lang_key'] );
						$error_msg .= (empty($error_msg) ? '' : '<br />') . $lang['Error'] . ':&nbsp;' . $msg;
					}
					break;
				case 'TINYINT':
				case 'SMALLINT':
				case 'MEDIUMINT':
				case 'INT':
					$$user_field = intval($_POST[$user_field]);
					break;
				case 'VARCHAR':
				case 'TEXT':
				case 'DATEFMT':
					$$user_field = trim(str_replace("\'", "''", htmlspecialchars($_POST[$user_field])));
					break;
				case 'HTMLVARCHAR':
				case 'HTMLTEXT':
					$$user_field = trim(str_replace("\'", "''", $_POST[$user_field]));
					break;
				default:
					$$user_field = '';
					if ( !empty($field['chk_func']) && function_exists($field['chk_func']) )
					{
						$$user_field = $field['chk_func']($user_field, $_POST[$user_field]);
					}
					else
					{
						message_die(GENERAL_ERROR, 'Unknown type of config data : ' . $field_name, '', __LINE__, __FILE__, '');
					}
					break;
			}
			// handle required...
			if(!empty($field['required'])){
				if(!$$user_field){
					$error = true;
					$msg = mods_settings_get_lang($mods[$menu_name]['data'][$mod_name]['data'][$sub_name]['data'][$field_name]['lang_key'] );
					$error_msg .= (empty($error_msg) ? '' : '<br />') . sprintf($lang['Required_Error'],$msg);
				}
			}
			// set in values array only if not a system field
			if(empty($field['system'])){
				$values[$user_field]=$$user_field;
			}
		}
	}
	// alert all errors!
	if ($error){
		$message = $error_msg . '<br /><br />';
		message_die(GENERAL_MESSAGE, $message);
	}

	$email_changed = isset($values['user_email']) && strtolower($values['user_email']) != strtolower($view_userdata['user_email']);
	// set re-activate for guest and email changed
	if ( $is_guest || $email_changed)
	{
		if ($board_config['require_activation'] != USER_ACTIVATION_NONE)
		{
		// if admin user is active :: need 0 and 1 for updating user table!
			if($is_admin){
				$values['user_active'] = 1;
			} else{
				$values['user_active'] = 0;
			}
			// get an activation key
			if (!$values['user_active']) {
				$values['user_actkey'] = pcp_gen_rand_string(true);
				$key_len = 54 - ( strlen($server_url) );
				$key_len = ( $key_len > 6 ) ? $key_len : 6;
				$values['user_actkey'] = substr($values['user_actkey'], 0, $key_len);
			}
		} else {
			$values['user_active'] = 1;
			$values['user_actkey'] = '';
		}
		$user_active_changed = true;
	}
	else
	{
		$user_active_changed = false;
	}
	if($is_guest){
		// insert user...
		// set the regdate
		$values['user_regdate'] = time();
		// set the user_id
		$sql = "SELECT MAX(user_id)+1 AS total FROM " . USERS_TABLE;
		if ( !$result = $db->sql_query($sql) ){
			message_die(GENERAL_ERROR, 'Could not obtain next user_id information', '', __LINE__, __FILE__, $sql);
		}
		if ( !$row = $db->sql_fetchrow($result) )	{
			message_die(GENERAL_ERROR, 'Could not obtain next user_id information', '', __LINE__, __FILE__, $sql);
		}
		$values['user_id'] = $row['total'];
		$user_id = $values['user_id'];
		// get the defaults... 
		setDefaultUserdata($values);
		// get the fields and values
    foreach ($values as $key => $value)
    {
			$sql_key .= ( empty($sql_key) ? '' : ', ') . $key;
			$sql_val .= ( empty($sql_val) ? '' : ', ') . "'" . str_replace("\'", "''", $value) . "'";
		}
		// insert user + start transaction
		$sql = "INSERT INTO " . USERS_TABLE . "($sql_key) VALUES ($sql_val)";
		if ( !($result = $db->sql_query($sql, BEGIN_TRANSACTION)) ){
			message_die(GENERAL_ERROR, 'Could not insert data into users table', '', __LINE__, __FILE__, $sql);
		}
		// BEGIN CrackerTracker v5.x
		($mode == 'profil')? $profile_security->pw_create_date($user_id) : null;
		($mode == 'profil')? $profile_security->reg_done() : null;
		// END CrackerTracker v5.x
		// insert group
		$sql = "INSERT INTO " . GROUPS_TABLE . " (group_name, group_description, group_single_user, group_moderator)
				VALUES ('".$values['username']."', 'Personal User', 1, 0)";
		if ( !($result = $db->sql_query($sql)) ){
			message_die(GENERAL_ERROR, 'Could not insert data into groups table', '', __LINE__, __FILE__, $sql);
		}
		$group_id = $db->sql_nextid();
		// insert user_group
		$sql = "INSERT INTO " . USER_GROUP_TABLE . " (user_id, group_id, user_pending)
				VALUES ($user_id, $group_id, 0)";
		if( !($result = $db->sql_query($sql)) ){
			message_die(GENERAL_ERROR, 'Could not insert data into user_group table', '', __LINE__, __FILE__, $sql);
		}
		// autojoin groups where count is zero
		$sql = "SELECT ug.user_id, g.group_id as g_id, g.group_name , u.user_posts, g.group_count FROM (" . GROUPS_TABLE . " g, ".USERS_TABLE." u) 
			LEFT JOIN ". USER_GROUP_TABLE." ug ON g.group_id=ug.group_id AND ug.user_id=$user_id 
			WHERE u.user_id=$user_id 
				 AND ug.user_id is NULL 
				 AND g.group_count=0 
				 AND g.group_single_user=0 
				 AND g.group_moderator<>$user_id"; 
		if ( !($result = $db->sql_query($sql)) ) { 
			message_die(GENERAL_ERROR, 'Error geting users post stat', '', __LINE__, __FILE__, $sql); 
		} 
		while ($group_data = $db->sql_fetchrow($result)) { 
			$sql = "INSERT INTO " . USER_GROUP_TABLE . " (group_id, user_id, user_pending) VALUES (".$group_data['g_id'].", $user_id, 0)"; 
			if ( !($db->sql_query($sql)) ) { 
				message_die(GENERAL_ERROR, 'Error inserting user group, group count', '', __LINE__, __FILE__, $sql); 
			} 
		} 
		// insert prillian + end transaction
		if (defined('PRILLIAN_INSTALLED')){
			$sql = 'INSERT INTO ' . IM_PREFS_TABLE . ' (user_id, themes_id)
				VALUES (' . $user_id . ', ' . $values['user_style'] . ')';
		if ( !$db->sql_query($sql, END_TRANSACTION) ){
				message_die(GENERAL_ERROR, 'Could not insert data into im_prefs table', '', __LINE__, __FILE__, $sql);
			}
		} else {
			// start dummy sql to end transaction
			$sql = "select user_id from ". USERS_TABLE . " where user_id = " . $view_userdata['user_id'];
			if ( !$db->sql_query($sql, END_TRANSACTION) ) {
				message_die(GENERAL_ERROR, 'Failed to end transaction', '', __LINE__, __FILE__, $sql);
			} 		
		}
		 // 
		 // START wpm mod by Duvelske (http://www.vitrax.vze.com) 
		 { 
				$sql = "SELECT * 
					 FROM " . WPM; 
				if(!$result = $db->sql_query($sql)) 
				{ 
					 message_die(GENERAL_ERROR, "", "", __LINE__, __FILE__, $sql); 
				} 
				else 
				{ 
					 while($row = $db->sql_fetchrow($result)) 
					 { 
							$swpm_config[$row['name']] = $row['value']; 
					 } 
				} 
				if($swpm_config['active_wpm']) 
				{ 
				// Just a couple of replaces for better customisation on a per user basis 
				// no point making a special function since there are so few needed 

				$wpm_subject = str_replace("[username]", $values['username'], $swpm_config['wpm_subject']); 
				$wpm_subject = str_replace("[user_id]", $user_id, $wpm_subject); 
				$wpm_subject = str_replace("[sitename]", $board_config['sitename'], $wpm_subject); 

				$wpm_message = str_replace("[username]", $values['username'], $swpm_config['wpm_message']); 
				$wpm_message = str_replace("[user_id]", $user_id, $wpm_message); 
				$wpm_message = str_replace("[sitename]", $board_config['sitename'], $wpm_message); 

				// Will not send a pm notification via email (already sent the standard welcome email) 
				// Simply change the 0 to a 1 to turn it on 
				wpm_send_pm($user_id, $wpm_subject, $wpm_message, 0); 
				} 
		 } 
		 // END wpm mod 
		 //
	}else{
		// username changed? 
		// Do this before updating usertable! as the view_userdata will be altered accordingly
		if ($username_changed){
			$sql = "UPDATE " . GROUPS_TABLE . " 
								 SET group_name = '" . str_replace("\'", "''", $values['username']) . "'
							 WHERE group_name = '" . str_replace("\'", "''", $view_userdata['username'] ) . "'";
			if ( !$result = $db->sql_query($sql, BEGIN_TRANSACTION) ){
					message_die(GENERAL_ERROR, 'Could not rename users group', '', __LINE__, __FILE__, $sql);
			}
		}
		// save result :: update user
    foreach ($values as $field_name => $value)
    {
			$sql = "UPDATE " . USERS_TABLE . " 
			 					 SET $field_name='" . $value . "'
						   WHERE user_id = " . $view_userdata['user_id'];
			if ( !$db->sql_query($sql) ) {
				message_die(GENERAL_ERROR, 'Failed to update user configuration for ' . $field_name, '', __LINE__, __FILE__, $sql);
			}
			// also update the view_userdata! 
			$view_userdata[$field_name] = $value;
		}
		// start dummy sql to end transaction
		$sql = "select user_id from ". USERS_TABLE . " where user_id = " . $view_userdata['user_id'];
		if ( !$db->sql_query($sql, END_TRANSACTION) ) {
			message_die(GENERAL_ERROR, 'Failed to end transaction', '', __LINE__, __FILE__, $sql);
		}
	}
	
	// reset the board stats !!!
	// only if guest == new user count
	if($is_guest){
		board_stats();
	}
	
	// send messages 
	// relocate
	$ret_link = append_sid("./portal.$phpEx");
	$ret_msg = sprintf($lang['Click_return_portal'],  '<a href="' . $ret_link . '">', '</a>');
	if (empty($values['user_active']) && $user_active_changed){
		if ($is_guest){
			if ( $board_config['require_activation'] == USER_ACTIVATION_SELF ){
				$message = $lang['Account_inactive'] . '<br /><br />' . $ret_msg;
				mailmsg($values,'user_welcome_inactive',sprintf($lang['Welcome_subject'], $board_config['sitename']));
			} else if ( $board_config['require_activation'] == USER_ACTIVATION_ADMIN ){
				$message = $lang['Account_inactive_admin'] . '<br /><br />' .  $ret_msg;
				mailmsg($values,'admin_welcome_inactive',sprintf($lang['Welcome_subject'], $board_config['sitename']));
				// also send to admin, 
				$admin['user_email'] = $board_config['board_email'];
				$admin['username'] = $values['username'];
				$admin['user_id'] = $values['user_id'];
				$admin['user_lang'] = $board_config['default_lang'];
				$admin['user_actkey'] = $values['user_actkey'];
				mailmsg($admin,'admin_activate',$lang['New_account_subject']);
			}
		} else {
			if ( $board_config['require_activation'] == USER_ACTIVATION_SELF ){
				$message = $lang['Profile_updated_inactive'] . '<br /><br />' . $ret_msg;
				// use view_userdata as email or user_id might not be submitted
				mailmsg($view_userdata,'user_activate',$lang['Reactivate']);
			} else if ( $board_config['require_activation'] == USER_ACTIVATION_ADMIN ){
				$message = $lang['Profile_updated_inactive_admin'] . '<br /><br />' .  $ret_msg;
				// send to admin, not to user
				// use view_userdata as email or user_id might not be submitted
				$admin['user_email'] = $board_config['board_email'];
				$admin['username'] = $view_userdata['username'];
				$admin['user_id'] = $view_userdata['user_id'];
				$admin['user_lang'] = $board_config['default_lang'];
				$admin['user_actkey'] = $view_userdata['user_actkey'];
				mailmsg($admin,'admin_activate',$lang['New_account_subject']);
			}
		}
		if ($userdata['session_logged_in'] && !is_admin($userdata)){
			session_end($userdata['session_id'], $userdata['user_id']);
		}
	} else {
		if ($is_guest){
			$message = $lang['Account_added'] . '<br /><br />' . $ret_msg;
			mailmsg($values,'user_welcome',sprintf($lang['Welcome_subject'], $board_config['sitename']));
		} else {
			$ret_link = append_sid("./profile.$phpEx?mode=$mode&sub=$sub&mod=$mod_id&msub=$sub_id&" . POST_USERS_URL . "=$view_user_id");
			$message = $lang['Profile_updated'] . "<br /><br />" . sprintf($lang['Click_return_profilcp'], '<a href="' . $ret_link . '">', '</a>', mods_settings_get_lang($mod_name) ) . '<br /><br />';
		}
	}
	message_die(GENERAL_MESSAGE, $message);
} else {	
	// set the default values for registering...
	if ($is_guest){
		setDefaultUserdata($view_userdata,true);
	}

	if ($userdata['session_logged_in']){
		// template
		$template->set_filenames(array(
			'body' => 'profilcp/board_config_body.tpl')
		);
	} else {
		// template
		$template->set_filenames(array(
			'body' => 'profilcp/board_config_body2.tpl')
		);
	}
	// header
	$template->assign_vars(array(
		'L_MOD_NAME'		=> mods_settings_get_lang($mod_name) . ( !empty($sub_name) ? ' - ' . mods_settings_get_lang($sub_name) : '' ),
		'L_SUBMIT'			=> $lang['Submit'],
		'L_RESET'			=> $lang['Reset'],
		)
	);

	// send menu
	for ($i=0; $i < count($mod_keys); $i++)
	{
		$l_mod = $mod_keys[$i];
		if ( count($sub_keys[$i]) == 1 )
		{
			$l_mod = $sub_keys[$i][0];
		}
		$template->assign_block_vars('mod', array(
			'CLASS'	=> ($mod_id == $i) ? 'row1' : 'row2',
			'ALIGN'	=> ( ($mod_id == $i) && (count($sub_keys[$i]) > 1) ) ? 'left' : 'center',
			'U_MOD'	=> append_sid("./profile.$phpEx?mode=$mode&sub=$sub&mod=$i&" . POST_USERS_URL . "=$view_user_id"),
			'L_MOD'	=> sprintf( (($mod_id == $i) ? '<b>%s</b>' : '%s'), mods_settings_get_lang($l_mod) ),
			)
		);
		if ($is_guest && $i==0){
			// make sure guests don't have access to the other sub modules
			break;
		}
		if ($mod_id == $i)
		{
			if ( count($sub_keys[$i]) > 1 )
			{
				$template->assign_block_vars('mod.sub', array());
				for ($j=0; $j < count($sub_keys[$i]); $j++)
				{
					$template->assign_block_vars('mod.sub.row', array(
						'CLASS'	=> ($sub_id == $j) ? 'row1' : 'row1',
						'U_MOD' => append_sid("./profile.$phpEx?mode=$mode&sub=$sub&mod=$i&msub=$j&" . POST_USERS_URL . "=$view_user_id"),
						'L_MOD'	=> sprintf( (($sub_id == $j) ? '<b>%s</b>' : '%s'), mods_settings_get_lang($sub_keys[$i][$j]) ),
						)
					);
				}
			}
		}
	}

	// send items
  foreach ($mods[$menu_name]['data'][$mod_name]['data'][$sub_name]['data'] as $field_name => $field)
	{
		// process only not overwritten fields from users table and system fields
		$user_field = $field['user'];
		$is_auth = auth_field($field);
		if ( ( ( !empty($user_field) && isset($view_userdata[$user_field]) && !$board_config[ $field_name . '_over'] ) || $field['system'] ) && $is_auth )
		{
			// get the field input statement
			$input = '';
			switch ($field['type'])
			{
				case 'LIST_RADIO':
          foreach ($field['values'] as $key => $val)
					{
						$selected = ($view_userdata[$user_field] == $val) ? ' checked="checked"' : '';
						$l_key = mods_settings_get_lang($key);
						$input .= '<input type="radio" name="' . $user_field . '" value="' . $val . '"' . $selected . ' />' . $l_key . '&nbsp;&nbsp;';
					}
					break;
				case 'LIST_DROP':
          foreach ($field['values'] as $key => $val)
					{
						$selected = ($view_userdata[$user_field] == $val) ? ' selected="selected"' : '';
						$l_key = mods_settings_get_lang($key);
						$input .= '<option value="' . $val . '"' . $selected . '>' . $l_key . '</option>';
					}
					$input = '<select name="' . $user_field . '">' . $input . '</select>';
					break;
				case 'TINYINT':
					$input = '<input type="text" name="' . $user_field . '" maxlength="3" size="2" class="post" value="' . $view_userdata[$user_field] . '" />';
					break;
				case 'SMALLINT':
					$input = '<input type="text" name="' . $user_field . '" maxlength="5" size="5" class="post" value="' . $view_userdata[$user_field] . '" />';
					break;
				case 'MEDIUMINT':
					$input = '<input type="text" name="' . $user_field . '" maxlength="8" size="8" class="post" value="' . $view_userdata[$user_field] . '" />';
					break;
				case 'INT':
					$input = '<input type="text" name="' . $user_field . '" maxlength="13" size="11" class="post" value="' . $view_userdata[$user_field] . '" />';
					break;
				case 'VARCHAR':
				case 'HTMLVARCHAR':
					$input = '<input type="text" name="' . $user_field . '" maxlength="255" size="45" class="post" value="' . $view_userdata[$user_field] . '" />';
					break;
				case 'TEXT':
				case 'HTMLTEXT':
					$input = '<textarea rows="5" cols="45" wrap="virtual" name="' . $user_field . '" class="post">' . $view_userdata[$user_field] . '</textarea>';
					break;
				default:
					$input = '';
					if ( !empty($field['get_func']) && function_exists($field['get_func']) )
					{
						$input = $field['get_func']($user_field, $view_userdata[$user_field]);
					}
					break;
			}
			// show who can see the info depending on class
			if ($field['visibility']){
				if ($field['class'] != 'generic'){ 
					$see_field = $classes_fields[$field['class']]['user_field']; 
					if($board_config[$see_field.'_over']){ 
						$viewed_by = $board_config[$see_field]; 
					} else { 
						$viewed_by = $view_userdata[$see_field]; 
					} 
				} else { 
					$viewed_by = YES; 
				}
				switch ($viewed_by) {
					case FRIEND_ONLY:
						if ($user_field == 'user_email' && $board_config['board_email_form']){
							// special case for email via board... 
							$viewed = $lang['Visible_board_email_friends'];
						} else {
							$viewed = $lang['Visible_friends'];
						}
						break;
					case YES:
						if ($user_field == 'user_email' && $board_config['board_email_form']){
							// special case for email via board... 
							$viewed = $lang['Visible_board_email_all'];
						} else {
							$viewed = $lang['Visible_all'];
						}
						break;
					case NO:
						$viewed = $lang['Visible_admin'];
						break;
					default:
						$viewed = $lang['Visible_admin'];
						break;
				}
			} else {
				// system field :: no display
				$viewed = '';
			}
			// dump to template
			$inputstyle = 'field';
			if($field['inputstyle']){
				$inputstyle = $field['inputstyle'];
			}
			$template->assign_block_vars($inputstyle, array(
				'L_NAME'	=> mods_settings_get_lang($field['lang_key']),
				'L_EXPLAIN'	=> (!empty($field['explain']) ? '<br />' . mods_settings_get_lang($field['explain']) : '').$viewed,
				'INPUT'		=> $input.($field['required'] ? $lang['Required_field'] : ''),
				)
			);
		}
	}

	// system
	$s_hidden_fields .= '<input type="hidden" name="mod_id" value="' . $mod_id . '" />';
	$s_hidden_fields .= '<input type="hidden" name="mod_sub_id" value="' . $sub_id . '" />';
	$s_hidden_fields .= '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';
	$s_hidden_fields .= '<input type="hidden" name="set" value="add" />';
	$s_hidden_fields .= '<input type="hidden" name="submit" value="1" />';
	$template->assign_vars(array(
		'S_PROFILCP_ACTION' => append_sid("profile.$phpEx"),
		'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
		'REQUIRED_EXPLAIN' => $lang['Required_explain'],
		)
	);
	// page
	$template->pparse('body');
}
?>
