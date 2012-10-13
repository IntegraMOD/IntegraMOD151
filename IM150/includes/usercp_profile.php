<?php
/***************************************************************************
 *                             usercp_profile.php
 *                            -------------------
 *   begin                : Saturday, Dec 18, 2004
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *
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

function setDefaultUserdata(&$data,$setalways=false){
	// set always will override the values already in data even if there's yet a value :: used in register input page only as guest
	global $mods, $board_config, $db;
	// get the userfields and create the array
	$sql = "SHOW FIELDS FROM ".USERS_TABLE;
	if ( !$result = $db->sql_query($sql) ) {
		message_die(GENERAL_ERROR, 'Could not get user table definition', '', __LINE__, __FILE__, $sql);
	}
	$userfields = array();
	while ($row = $db->sql_fetchrow($result) ){
		$userfields[] = $row['Field'];
	}
	// fetch all fields and set the default to the value in configuration+
	while (list($k1, $d1) = each($mods)){ 
		while (list($k2, $d2) = each($mods[$k1]['data'])){ 
			while (list($k3, $d3) = each($mods[$k1]['data'][$k2]['data'])){ 
				while (list($k4, $d4) = each($mods[$k1]['data'][$k2]['data'][$k3]['data'])){ 
					// only if userfield defined and userfield not yet set in passed data unless setalways is defined
					if(isset($d4['user']) && (!isset($data[$d4['user']]) || $setalways)){ 
						$userfield = $d4['user']; 
						$configfield = $k4;
						// set the userdata :: only if in user table... :: don't need the other fields
						/*$sql = "SHOW FIELDS FROM ".USERS_TABLE." LIKE '$userfield'";
						if ( !$result = $db->sql_query($sql) ) {
							message_die(GENERAL_ERROR, 'Could not get user table definition', '', __LINE__, __FILE__, $sql);	
						}
						$num_rows = $db->sql_numrows($result);
						if($num_rows){*/
						if(in_array($userfield,$userfields)){
							if (isset($board_config[$userfield]) && $board_config[$userfield] !=''){
								$data[$userfield] = $board_config[$userfield];
							} else if (isset($board_config[$configfield]) && $board_config[$configfield] !=''){
								$data[$userfield] = $board_config[$configfield];
							} 
						} 
					} 
				} 
			} 
		} 
	}
	// Get the userfields not in any map...
	// override by default config values...
	/*$sql = "SHOW FIELDS FROM ".USERS_TABLE;
	if ( !$result = $db->sql_query($sql) ) {
		message_die(GENERAL_ERROR, 'Could not get user table definition', '', __LINE__, __FILE__, $sql);
	}
	while ($row = $db->sql_fetchrow($result) ){*/
	reset($userfields);
	foreach ($userfields as $field) {
		$defaultfield = 'default_'.str_replace('user_','',$field);
		$defaultfield_over =  $defaultfield.'_over';
		if($board_config[$defaultfield_over]){
			// always set board config! default over is prior to configuration+ over
			$data[$field] = $board_config[$defaultfield];
		} else if(!isset($data[$field])){
			if($board_config[$defaultfield] != ''){
				// set value as default
				$data[$field] = $board_config[$defaultfield];
			} else {
				// set value as defined in table
				$data[$field] = $row['Default'];
			}
		}
	}
	$db->sql_freeresult($result);
}

function auth_field($field){
	global $is_user, $is_admin, $is_board_admin, $is_guest;
	
	$field_auth = ( empty($field['auth']) && $is_user ) || ( ($field['auth'] == USER) && $is_user ) || ( ($field['auth'] == ADMIN) && $is_admin ) || ( ($field['auth'] == BOARD_ADMIN) && $is_board_admin ) || ( ($field['auth'] == GUEST_ONLY) && $is_guest );
	return $field_auth;
}

function mailmsg($data,$template,$subject){
	global $board_config, $HTTP_POST_VARS, $server_url, $server_name, $user_ip;
	
	$unhtml_specialchars_match = array('#&gt;#', '#&lt;#', '#&quot;#', '#&amp;#');
	$unhtml_specialchars_replace = array('>', '<', '"', '&');
	
	$username = preg_replace($unhtml_specialchars_match, $unhtml_specialchars_replace, substr(str_replace("\'", "'", $data['username']), 0, 25));
	$useremail = $data['user_email'];
	
	$email_headers = "To: \"".$username."\" <".$useremail. ">\r\n"; 
	$email_headers .= "From: \"".$board_config['sitename']."\" <".$board_config['board_email'].">\r\n"; 
	$email_headers .= "Return-Path: " . $board_config['board_email'] . "\r\n"; 
	$email_headers .= "X-AntiAbuse: Board servername - " . trim($board_config['server_name']) . "\r\n"; 
	$email_headers .= "X-AntiAbuse: User_id - " . $data['user_id'] . "\r\n"; 
	$email_headers .= "X-AntiAbuse: Username - " . $username . "\r\n"; 
	$email_headers .= "X-AntiAbuse: User IP - " . decode_ip($user_ip) . "\r\n"; 
	
	$emailer = new emailer($board_config['smtp_delivery']);
	$emailer->use_template($template, stripslashes($data['user_lang']));
	$emailer->email_address($useremail);
	$emailer->set_subject($subject);
	$emailer->extra_headers($email_headers);

	$emailer->assign_vars(array(
		'SITENAME' => $board_config['sitename'],
		'WELCOME_MSG' => $subject,
		'USERNAME' => $username,
		'PASSWORD' => $HTTP_POST_VARS['user_password_confirm'],
		'EMAIL_SIG' => str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']),
		'U_ACTIVATE' => $server_url . '?mode=activate&' . POST_USERS_URL . '=' . $data['user_id'] . '&act_key=' . $data['user_actkey'])
	);

	$emailer->send();
	$emailer->reset();
}
?>
