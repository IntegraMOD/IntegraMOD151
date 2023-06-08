<?php

// correcting sessions, times and admin user
echo '<tr><th>correcting sessions, times and admin user</th></tr>
	  <tr><td><span class="gensmall"><div style="border: 1px solid #000000; height: 90px; overflow: auto;"><ul type="circle">';
global $table_prefix, $db, $admin_name, $admin_pass_md5, $language, $board_email;
$sql = array();
$sql[] = "DELETE FROM " . $table_prefix . "sessions";
$sql[] = "UPDATE " . $table_prefix . "users 
	SET username = '" . str_replace("'", "''", $admin_name) . "', 
		user_password='" . str_replace("'", "''", $admin_pass_md5) . "', 
		user_lang = '" . str_replace("'", "''", $language) . "', 
		user_email='" . str_replace("'", "''", $board_email) . "' 
	WHERE username = 'Admin'";
$sql[] = "UPDATE " . $table_prefix . "users SET user_regdate = " . time();
$sql[] = "UPDATE " . $table_prefix . "topics SET topic_time = " . time();
$sql[] = "UPDATE " . $table_prefix . "posts SET post_time = " . time();
$sql[] = "UPDATE " . $table_prefix . "force_read SET install_date = " . time();
$sql[] = "UPDATE " . $table_prefix . "hacks_list SET hack_file_mtime = " . time();
$sql[] = "UPDATE " . $table_prefix . "links SET link_joined = " . time();
$sql[] = "UPDATE " . $table_prefix . "stats_smilies_info SET last_update_time = " . time(). ", update_time = ". time();

$sql[] = "INSERT INTO ". $table_prefix ."wpm VALUES ('wpm_username', '".str_replace("'", "''", $admin_name)."');";
$sql[] = "INSERT INTO ". $table_prefix ."wpm VALUES ('wpm_userid', '2');";
//end possible?
for( $i = 0; $i < count($sql); $i++ )
{
	if( !$result = $db->sql_query ($sql[$i]) )
	{
		$error = $db->sql_error();
		echo '<li>' . $sql[$i] . '<br /> +++ <span style="color:#FF0000"><b>Error:</b></span> ' . $error['message'] . '</li><br />';
	}
	else
	{
		echo '<li>' . $sql[$i] . '<br /> +++ <span style="color:#00AA00"><b>Successful</b></span></li><br />';
	}
}
echo '</ul></div></span></td></tr>';

// correcting BOARD config values
echo '<tr><th>correcting BOARD config values</th></tr>
	  <tr><td><span class="gensmall"><div style="border: 1px solid #000000; height: 90px; overflow: auto;"><ul type="circle">';
global $sec_name, $sec_mod, $sec_admin, $server_name, $server_port, $script_path;
$correct_config = array(
		'board_startdate'			=> time(),
		'default_lang'				=> str_replace("'", "''", $language),
		'board_email'				=> $board_email,
		'script_path'				=> $script_path,
		'server_port'				=> $server_port,
		'server_name'				=> $server_name,
		$sec_admin 					=> '1',
		$sec_mod 					=> '0',
		$sec_name 					=> '1',
		'sec_admin'					=> $sec_admin,
		'sec_mods'					=> $sec_mod,
		'sec_name'					=> $sec_name,
		'icon_per_row'				=> '10',
		'summer_time' 				=> '0',
		'summer_time_auto' 			=> '1',
		'board_fdow'				=> '0'
);	
while (list($config_name, $config_value) = each($correct_config))
{
	$sql = "INSERT INTO " . $table_prefix . "config (config_name, config_value) 
			VALUES ('".$config_name."','".$config_value."')";
	if (!$result = $db->sql_query($sql)){
		$error = $db->sql_error();
		echo '<li>' . $sql . '<br /> +++ <span style="color:#FF0000"><b>Error:</b></span> ' . $error['message'] . '</li><br />';
	}	else {
		echo '<li>' . $sql . '<br /> +++ <span style="color:#00AA00"><b>Successful</b></span></li><br />';
	}
}
echo '</ul></div></span></td></tr>';

// correcting pcp config and user values
echo '<tr><th>correcting pcp config and user values</th></tr>
	  <tr><td><span class="gensmall"><div style="border: 1px solid #000000; height: 90px; overflow: auto;"><ul type="circle">';
// only numeric values!
$pcp_config = array(
		'user_attachsig'					=> 1,
		'user_notify'						=> 0,
		'user_notify_pm'					=> 1,
		'user_popup_pm'						=> 1,
		'user_viewimg'						=> 1,
		'user_allowhtml'					=> 1,
		'user_buddy_friend_display' 		=> 1,
		'user_buddy_ignore_display'			=> 1,
		'user_buddy_friend_of_display' 		=> 1,
		'user_buddy_ignored_by_display' 	=> 1,
		'user_timezone'						=> 0,
		'user_summer_time'					=> 0,
		'user_fdow'							=> 0,
		'user_privmsgs_per_page'			=> 5,
		'user_allow_viewonline' 			=> 1,
		'user_viewemail'					=> 2,
		'user_viewpm'						=> 1,
		'user_viewwebsite'					=> 2,
		'user_viewmessenger'				=> 2,
		'user_viewreal'						=> 2,
		'user_watched_topics_per_page' 		=> 15,
		'user_topics_last_per_page' 		=> 15,
		'user_setbm'						=> 1,
		'user_allowbbcode'					=> 1,
		'user_allowhtml'					=> 1,
		'user_allowsmile'					=> 1,
		'user_viewavatar'					=> 1,
		'user_viewsig'						=> 1,
		'user_viewimg'						=> 1,
		'user_active'						=> 1,
		'user_allow_email'					=> 1,
		'user_allow_pm'						=> 1,
		'user_allow_website'				=> 1,
		'user_allow_messenger'				=> 1,
		'user_allow_real'					=> 1,
		'user_allowavatar'					=> 1,
		'user_allowphoto'					=> 1,
		'user_allowsignature'				=> 1,
		'user_extra'						=> 1	
);
$usersql = "UPDATE " . $table_prefix . "users SET ";
while (list($config_name, $config_value) = each($pcp_config))
{
	$sql = "INSERT INTO " . $table_prefix . "config (config_name, config_value) 
			VALUES ('".$config_name."','".$config_value."')";
	if (!$result = $db->sql_query($sql)){
		$error = $db->sql_error();
		echo '<li>' . $sql . '<br /> +++ <span style="color:#FF0000"><b>Error:</b></span> ' . $error['message'] . '</li><br />';
	}	else {
		echo '<li>' . $sql . '<br /> +++ <span style="color:#00AA00"><b>Successful</b></span></li><br />';
	}
	$usersql .= $config_name . " = " . $config_value .", ";
}
// the character once:
$pcp_config = array(
		'user_lang'							=> str_replace("'", "''", $language),
		'user_dateformat'						=> 'd M Y h:i a',
);
while (list($config_name, $config_value) = each($pcp_config))
{
	$sql = "INSERT INTO " . $table_prefix . "config (config_name, config_value) 
			VALUES ('".$config_name."','".$config_value."')";
	if (!$result = $db->sql_query($sql)){
		$error = $db->sql_error();
		echo '<li>' . $sql . '<br /> +++ <span style="color:#FF0000"><b>Error:</b></span> ' . $error['message'] . '</li><br />';
	}	else {
		echo '<li>' . $sql . '<br /> +++ <span style="color:#00AA00"><b>Successful</b></span></li><br />';
	}
	$usersql .= $config_name . " = '" . $config_value ."', "; // now quotes as they are varchars
}

// remove last 2 characters (comma and blank)
$usersql = substr($usersql,0,-2);
$usersql .= " WHERE user_id > 0";

// user table update and special extra's
$sql = array();
$sql[] = $usersql;
$sql[] = "UPDATE " . $table_prefix . "users SET user_extra=1 WHERE user_id=2";

//end possible?
for( $i = 0; $i < count($sql); $i++ )
{
	if( !$result = $db->sql_query ($sql[$i]) )
	{
		$error = $db->sql_error();
		echo '<li>' . $sql[$i] . '<br /> +++ <span style="color:#FF0000"><b>Error:</b></span> ' . $error['message'] . '</li><br />';
	}
	else
	{
		echo '<li>' . $sql[$i] . '<br /> +++ <span style="color:#00AA00"><b>Successful</b></span></li><br />';
	}
}
echo '</ul></div></span></td></tr>';

// correcting the IM Portal config
echo '<tr><th>correcting IM Portal Configuration</th></tr>
	  <tr><td><span class="gensmall"><div style="border: 1px solid #000000; height: 90px; overflow: auto;"><ul type="circle">';
$dir = @opendir($phpbb_root_path . 'blocks');
while( $file = @readdir($dir) ){
	if(substr($file,-3) == 'cfg'){
		include($phpbb_root_path .'blocks/' . $file);
		for($i = 0; $i < $block_count_variables; $i++){
			$sql = "INSERT INTO " . $table_prefix . "block_variable 
							(label, sub_label, config_name, field_options, field_values, type, block) 
							VALUES ('" . str_replace("'", "''", $block_variables[$i][0]) . "', '" . str_replace("'", "''", $block_variables[$i][1]) . "', '" . str_replace("'", "''", $block_variables[$i][2]) . "', '" . str_replace("'", "''", $block_variables[$i][3]) . "', '" . $block_variables[$i][4] . "', '" . $block_variables[$i][5] . "', '" . str_replace("'", "''", $block_variables[$i][6]) . "')";
			if (!$result = $db->sql_query($sql)){
				$error = $db->sql_error();
				echo '<li>' . $sql . '<br /> +++ <span style="color:#FF0000"><b>Error:</b></span> ' . $error['message'] . '</li><br />';
			}	else {
				echo '<li>' . $sql . '<br /> +++ <span style="color:#00AA00"><b>Successful</b></span></li><br />';
			}
				
			$sql = "INSERT INTO " . $table_prefix . "portal_config  (config_name, config_value)
							VALUES ('" . str_replace("'", "''", $block_variables[$i][2]) . "', '" . str_replace("'", "''", $block_variables[$i][7]) . "')";
			if (!$result = $db->sql_query($sql)){
				$error = $db->sql_error();
				echo '<li>' . $sql . '<br /> +++ <span style="color:#FF0000"><b>Error:</b></span> ' . $error['message'] . '</li><br />';
			}	else {
				echo '<li>' . $sql . '<br /> +++ <span style="color:#00AA00"><b>Successful</b></span></li><br />';
			}
		}
	}
}
@closedir($dir);
$portal_config = array(
		'default_portal'			=> '1',
		'cache_enabled'				=> '1',
		'portal_header'				=> '1',
		'portal_tail'				=> '0'
);
while (list($config_name, $config_value) = each($portal_config))
{
	$sql = "INSERT INTO " . $table_prefix . "portal_config (config_name, config_value) 
			VALUES ('".$config_name."','".$config_value."')";
	if (!$result = $db->sql_query($sql)){
		$error = $db->sql_error();
		echo '<li>' . $sql . '<br /> +++ <span style="color:#FF0000"><b>Error:</b></span> ' . $error['message'] . '</li><br />';
	}	else {
		echo '<li>' . $sql . '<br /> +++ <span style="color:#00AA00"><b>Successful</b></span></li><br />';
	}
}
echo '</ul></div></span></td></tr>';


?>