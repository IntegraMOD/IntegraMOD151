<?php
/***************************************************************************
 *							admin_security.php
 *						   --------------------
 *		Version			: 1.0.3
 *		Email			: austin@phpbb-amod.com
 *		Site			: http://phpbb-tweaks.com
 *		Copyright		: aUsTiN-Inc 2003/6
 *
 ***************************************************************************/

define('IN_PHPBB', TRUE);
define('CT_SECLEVEL', 'MEDIUM');
$ct_ignoregvar = array('');

if (!empty($setmodules))
{
	$file = basename(__FILE__);
	$module['.: Security :.']['Configuration'] 	= $file;
	$module['.: Security :.']['Special'] 		= append_sid("admin_security.$phpEx?mode=special");
	$module['.: Security :.']['Member Tries']	= append_sid("admin_security.$phpEx?mode=members");
	$module['.: Security :.']['Info: phpinfo']	= append_sid("admin_security.$phpEx?mode=php_info");
	$module['.: Security :.']['Info: gdlib']	= append_sid("admin_security.$phpEx?mode=gd_info");	
	$module['.: Security :.']['Quick Search']	= append_sid("admin_security.$phpEx?mode=search");		
	return;
}

$phpbb_root_path = '../';
include_once($phpbb_root_path .'extension.inc');
include_once('pagestart.'. $phpEx);
include_once($phpbb_root_path .'includes/phpbb_security.'. $phpEx);
	
	$action = (isset($_POST['action'])) ? $_POST['action'] : ( isset($_GET['action']) ? $_GET['action'] : '' );
	$mode 	= (isset($_POST['mode'])) ? $_POST['mode'] : ( isset($_GET['mode']) ? $_GET['mode'] : '' );
	
	function AdminLinkLength($link, $max)
		{
	if (strlen($link) > $max)
		$newlink = substr($link, 0, ($max - 3)) .'.....';
	else
		$newlink = $link;
	return $newlink;
		}

	function AdminBackupSize($size)
		{
		global $lang;
	$gb = 1024 * 1024 * 1024; 
	$mb = 1024 * 1024; 
	$kb = 1024; 
		if ($size >= $gb)
			$newsize = sprintf ("%01.2f", $size/$gb) . " Gb's"; 
		elseif ($size >= $mb)
			$newsize = sprintf ("%01.2f", $size/$mb) . " Mb's"; 
		elseif ($size >= $kb)
			$newsize = sprintf ("%01.2f", $size/$kb) . " Kb's"; 
		else
			$newsize = $size . " B"; 
		
	return $newsize;		
		}
		
	if ($mode == 'gd_info')
		{
	echo '<pre>';
	print_r(gd_info());
	echo '</pre>';
	exit();
		}
					
	if ($mode == 'php_info')
		{
	echo phpinfo();
	exit();
		}
	
	if ($mode == 'unlink')
		{
	unset($authed, $allowed_admins);
	$allowed_admins = explode(',', $board_config['phpBBSecurity_allowed_admins']);
	
	for ($x = 0; $x < count($allowed_admins); $x++)
		{
		if ( ($userdata['user_id'] == $allowed_admins[$x]) && ($userdata['user_level'] == ADMIN) )
			{
		$allowed = TRUE;
		break;
			}
		}
	if ($userdata['user_id'] == phpBBSecurity_OldestAdmin())
		$allowed = TRUE;
		
	if (!$allowed)
		message_die(GENERAL_ERROR, $lang['PS_admin_not_authed']);
		
	$which_file = isset($_GET['file']) ? $_GET['file'] : '';
		
		if ($which_file)
			{
		$file_path = $phpbb_root_path . $board_config['phpBBSecurity_backup_folder'] .'/'. $which_file;
		unlink($file_path);
			}
			
	$mode = 'special';
		}
		
	if ($mode == 'search')
		{
		if ($action == 'unban')
			{
		$who = ($_POST['u']) ? $_POST['u'] : $_POST['u'];
		
		$q = "DELETE FROM ". BANLIST_TABLE ."
			  WHERE ban_ip = '$who'";
		$db->sql_query($q);
		
		$who = decode_ip($who);
			}
			
		if ($action == 'start_search')
			{
		$template->set_filenames(array('body' => 'admin/admin_security_search_body.tpl'));			
		
		$q = "SELECT *
			  FROM ". BANLIST_TABLE ."";
		$r 			= $db->sql_query($q);
		$ban_data 	= $db->sql_fetchrowset($r);
		
		$what_ip 	= isset($_POST['ip']) ? $_POST['ip'] : '';
		$what_type 	= isset($_POST['match_type']) ? intval($_POST['match_type']) : '';
		$split_ip 	= explode('.', $what_ip);
		
			if ($what_type == '1')		
				$final_ip = $split_ip[0] .'.'. $split_ip[1] .'.00.00';
			else
				$final_ip = $split_ip[0] .'.'. $split_ip[1] .'.'. $split_ip[2] .'.'. $split_ip[3];
				
		$final_ip = encode_ip($final_ip);
			
			if ($what_type == '1')
				$final_ip = 'LIKE \''. str_replace('0000', '%', $final_ip) .'\'';
			else
				$final_ip = '= \''. $final_ip .'\'';
				
		$q = "SELECT *
			  FROM ". PHPBB_SECURITY ."
			  WHERE ban_ip $final_ip";
		$r 		= $db->sql_query($q);
		$rows 	= $db->sql_fetchrowset($r);
		
		$template->assign_vars(array(
			'LIST_ID'		=> $lang['PS_users_id'],
			'LIST_IP'		=> $lang['PS_users_ip'],
			'LIST_LINK'		=> $lang['PS_users_link'],
			'LIST_REASON'	=> $lang['PS_users_reason'],
			'LIST_DATE'		=> $lang['PS_users_date'],
			'LIST_BANNED'	=> $lang['PS_search_banned'])
				);
				
			for ($x = 0; $x < count($rows); $x++)
				{
				for ($y = 0; $y < count($ban_data); $y++)
					{
					if ($ban_data[$y]['ban_ip'] == $rows[$x]['ban_ip'])
						{
					$is_banned = TRUE;
					break;
						}
						
					if (!$ban_data[$y]['ban_id'])
						break;
					}
					
			$template->assign_block_vars('rows', array(
				'LIST_ID'		=> $rows[$x]['ban_id'],
				'LIST_IP'		=> decode_ip($rows[$x]['ban_ip']) .'<br><a href="admin_security.'. $phpEx .'?mode=search&amp;action=unban&amp;u='. $rows[$x]['ban_ip'] .'&amp;sid='. $userdata['session_id'] .'">'. $lang['PS_search_unban'] .'</a>',
				'LIST_LINK'		=> AdminLinkLength($rows[$x]['ban_link'], 30),
				'LIST_REASON'	=> $rows[$x]['ban_reason'],
				'BANNED'		=> (($is_banned) ? $lang['PS_list_choice_one'] : $lang['PS_list_choice_two']),
				'LIST_DATE'		=> create_date($board_config['default_dateformat'], $rows[$x]['ban_date'], $board_config['board_timezone']))
					);
									
				if (!$rows[$x]['ban_id'])
					break;
				}
				
		$template->pparse('body');
			}
	$msg = '';
	$msg .= '<form name="start_searching" method="post" action="admin_security.'. $phpEx .'?mode=search&sid='. $userdata['session_id'] .'">';
	$msg .= $lang['PS_search_ip'] .'&nbsp;&nbsp;';
	$msg .= '<input type="text" name="ip" value="'. ((!empty($what_ip) && $what_ip > '0.0.0.0') ? $what_ip : (!empty($who) && ($who > '0.0.0.0') ? $who : ( isset($what_ip) ? $what_ip : '') )) .'" class="post"><br>';
	$msg .= '<input type="radio" name="match_type" value="1">&nbsp;'. $lang['PS_search_partial'] .'&nbsp;&nbsp;<input type="radio" name="match_type" value="2">&nbsp;'. $lang['PS_search_exact'] .'<br><br>';
	$msg .= '<input type="hidden" name="action" value="start_search">';	
	$msg .= '<input type="submit" class="mainoption" value="'. $lang['PS_search_submit'] .'" onclick="document.start_searching.submit()">';
	$msg .= '</form>';
	
	message_die(GENERAL_MESSAGE, $msg, $lang['PS_search_title']);
		}
		
	if ($mode == 'members')
		{
	$template->set_filenames(array('body' => 'admin/admin_security_members_body.tpl'));
		
	$q = "SELECT *
		  FROM ". PHPBB_SECURITY ."";
	$r 				= $db->sql_query($q);
	$caught_data 	= $db->sql_fetchrowset($r);
	
	$q = "SELECT username, user_id
		  FROM ". USERS_TABLE ."";
	$r 			= $db->sql_query($q);
	$users_data	= $db->sql_fetchrowset($r);		
			
	$q = "SELECT *
		  FROM ". POSTS_TABLE ."
		  WHERE poster_id <> '". ANONYMOUS ."'
		  AND poster_ip <> ''
		  GROUP BY poster_ip";
	$r 			= $db->sql_query($q);
	$posts_data	= $db->sql_fetchrowset($r);		
	
	if ($action == 'list_exploits')
		{
	$who 		= isset($_GET['u']) ? intval($_GET['u']) : '';
	$user_ips 	= array();
	$ban_links	= array();
	$ban_id		= array();
	$ban_reason	= array();
	$ban_date	= array();
	$ban_ip		= array();	
	
	$template->assign_block_vars('list', array(
		'USER'			=> str_replace('%N%', phpBBSecurity_GetName($who), $lang['PS_users_tries']),
		'LIST_ID'		=> $lang['PS_users_id'],
		'LIST_IP'		=> $lang['PS_users_ip'],
		'LIST_LINK'		=> $lang['PS_users_link'],
		'LIST_REASON'	=> $lang['PS_users_reason'],
		'LIST_DATE'		=> $lang['PS_users_date'])
			);
			
		for ($x = 0; $x < count($posts_data); $x++)
			{
			if ($posts_data[$x]['poster_id'] == $who)
				$user_ips[] = $posts_data[$x]['poster_ip'];
				
			if (!$posts_data[$x]['post_id'])
				break;
			}
			
		for ($x = 0; $x < count($user_ips); $x++)
			{
			for ($y = 0; $y < count($caught_data); $y++)
				{
				if ($user_ips[$x] == $caught_data[$y]['ban_ip'])
					{
				$ban_links[] 	= AdminLinkLength($caught_data[$y]['ban_link'], 30);
				$ban_id[] 		= $caught_data[$y]['ban_id'];
				$ban_reason[] 	= $caught_data[$y]['ban_reason'];
				$ban_date[] 	= $caught_data[$y]['ban_date'];
				$ban_ip[]		= $caught_data[$y]['ban_ip'];
					}
																
				if (!$caught_data[$y]['ban_id'])
					break;
					
				}			
			if (!$user_ips[$x])
				break;
				
			}
			
		for ($x = 0; $x < count($ban_links); $x++)
			{
		$template->assign_block_vars('list_rows', array(
			'LIST_ID'		=> $ban_id[$x] ,
			'LIST_IP'		=> decode_ip($ban_ip[$x]),
			'LIST_LINK'		=> $ban_links[$x],
			'LIST_REASON'	=> $ban_reason[$x],
			'LIST_DATE'		=> create_date($board_config['default_dateformat'], $ban_date[$x], $board_config['board_timezone']))
				);
							
			if (!$ban_links[$x])
				break;
			}
		}
			
	$bad_user_ids 	= array();
	$bad_user_names	= array();

		for ($a = 0; $a < count($caught_data); $a++)
			{				
			for ($b = 0; $b < count($posts_data); $b++)
				{
				if ($caught_data[$a]['ban_ip'] == $posts_data[$b]['poster_ip'])
					{
				$bad_user_ids[] = $posts_data[$b]['poster_id'];
				break;
					}					
				if (!$posts_data[$b]['post_id'])
					break;
				}
			if (!$caught_data[$a]['ban_id'])
				break;				
			}
			
		for ($x = 0; $x < count($bad_user_ids); $x++)
			{
			for ($y = 0; $y < count($users_data); $y++)
				{
				if ($bad_user_ids[$x] == $users_data[$y]['user_id'])
					{
				$bad_user_names[] = $users_data[$y]['username'];
				break;
					}
				}
			if (!$bad_user_ids[$x])
				break;
			}
			
		if (count($bad_user_names) > 0)
			$switch = $lang['PS_members_pt_check_yc'];
		else
			message_die(GENERAL_MESSAGE, $lang['PS_members_pt_check_nc']);
			
	$template->assign_vars(array(
		'TITLE'		=> $lang['PS_members_title'],
		'HEADER'	=> $switch)
			);
		
		for ($x = 0; $x < count($bad_user_ids); $x++)
			{
			if ($bad_user_ids[$x])
				{
			$template->assign_block_vars('rows', array(
				'POS'	=> $x + 1,
				'USER'	=> '<a href="http://'. $board_config['server_name'] . $board_config['script_path'] .'profile.'. $phpEx .'?mode=viewprofile&amp;u='. $bad_user_ids[$x] .'&sid='. $userdata['session_id'] .'" target="_self">'. $bad_user_names[$x] .'</a>',
				'LINK'	=> '<a href="admin_security.'. $phpEx .'?mode=members&amp;action=list_exploits&amp;u='. $bad_user_ids[$x] .'&sid='. $userdata['session_id'] .'">'. $lang['PS_user_exploits'] .'</a>')
					);
				}
			}
			
	$template->pparse('body');
		}
		
	if ( ($action == 'save_special') && ($mode == 'special') && ($userdata['user_level'] == ADMIN) )
		{
	unset($authed, $allowed_admins);
	$allowed_admins = explode(',', $board_config['phpBBSecurity_allowed_admins']);
	
	for ($x = 0; $x < count($allowed_admins); $x++)
		{
		if ( ($userdata['user_id'] == $allowed_admins[$x]) && ($userdata['user_level'] == ADMIN) )
			{
		$allowed = TRUE;
		break;
			}
		}
	if ($userdata['user_id'] == phpBBSecurity_OldestAdmin())
		$allowed = TRUE;
		
	if (!$allowed)
		message_die(GENERAL_ERROR, $lang['PS_admin_not_authed']);
				
	$s_a 	= ($_POST['special_admin']) 	? $_POST['special_admin'] 	: $_POST['special_admin'];
	$s_m 	= ($_POST['special_mod']) 		? $_POST['special_mod'] 	: $_POST['special_mod'];
	$s_u 	= ($_POST['ps_use_special']) 	? $_POST['ps_use_special'] 	: $_POST['ps_use_special'];
	$s_d	= ($_POST['ps_ddos_option']) 	? $_POST['ps_ddos_option'] 	: $_POST['ps_ddos_option'];
	$s_cl	= ($_POST['ps_clike_option']) 	? $_POST['ps_clike_option']	: $_POST['ps_clike_option'];
	$s_cb	= ($_POST['ps_cback_option']) 	? $_POST['ps_cback_option'] : $_POST['ps_cback_option'];
	$s_e	= ($_POST['ps_chr_option']) 	? $_POST['ps_chr_option'] 	: $_POST['ps_chr_option'];
	$s_s	= ($_POST['ps_sql_option']) 	? $_POST['ps_sql_option'] 	: $_POST['ps_sql_option'];
	$s_p	= ($_POST['ps_perl_option']) 	? $_POST['ps_perl_option'] 	: $_POST['ps_perl_option'];
	$s_un	= ($_POST['ps_union_option']) 	? $_POST['ps_union_option'] : $_POST['ps_union_option'];
	$s_f	= ($_POST['ps_file_option']) 	? $_POST['ps_file_option'] 	: $_POST['ps_file_option'];
	
	$add_admin 		= ($_POST['grant_access']) 	? $_POST['grant_access'] 	: $_POST['grant_access'];
	$remove_admin 	= ($_POST['deny_access']) 	? $_POST['deny_access'] 	: $_POST['deny_access'];
	$add_agent		= ($_POST['block_agents']) 	? $_POST['block_agents'] 	: $_POST['block_agents'];
	$remove_agent	= ($_POST['allow_agents']) 	? $_POST['allow_agents'] 	: $_POST['allow_agents'];
	$ddos_level		= ($_POST['ps_ddos_level']) ? $_POST['ps_ddos_level'] 	: $_POST['ps_ddos_level'];
	$per_page		= ($_POST['per_page']) 		? $_POST['per_page'] 		: $_POST['per_page'];
	$per_page		= ($per_page <= 0) 			? 100 						: $per_page;
	$add_referer	= ($_POST['block_referers'])? $_POST['block_referers'] 	: $_POST['block_referers'];
	$remove_referer	= ($_POST['allow_referers'])? $_POST['allow_referers'] 	: $_POST['allow_referers'];
	
	$use_backup 	= ($_POST['backup_on']) 	? $_POST['backup_on'] 		: $_POST['backup_on'];
	$backup_folder 	= ($_POST['backup_folder']) ? $_POST['backup_folder'] 	: $_POST['backup_folder'];
	$backup_file 	= ($_POST['backup_file']) 	? $_POST['backup_file'] 	: $_POST['backup_file'];
	$backup_time 	= ($_POST['backup_time']) 	? $_POST['backup_time'] 	: $_POST['backup_time'];

	$guest_matches	= isset($_POST['guest_sessions']) ? intval($_POST['guest_sessions']) : '';

	$q = "UPDATE ". CONFIG_TABLE ."
		  SET config_value = '$guest_matches'
		  WHERE config_name = 'phpBBSecurity_guest_matches'";
	$db->sql_query($q);
		
	$q = "UPDATE ". CONFIG_TABLE ."
		  SET config_value = '$use_backup'
		  WHERE config_name = 'phpBBSecurity_backup_on'";
	$db->sql_query($q);
	
	$q = "UPDATE ". CONFIG_TABLE ."
		  SET config_value = '". addslashes(stripslashes(trim($backup_folder))) ."'
		  WHERE config_name = 'phpBBSecurity_backup_folder'";
	$db->sql_query($q);
	
	$q = "UPDATE ". CONFIG_TABLE ."
		  SET config_value = '". addslashes(stripslashes(trim($backup_file))) ."'
		  WHERE config_name = 'phpBBSecurity_backup_filename'";
	$db->sql_query($q);
	
	if ($backup_time >= '00')
		{
	$q = "UPDATE ". CONFIG_TABLE ."
		  SET config_value = '$backup_time'
		  WHERE config_name = 'phpBBSecurity_backup_time'";
	$db->sql_query($q);
		}
					
	$q = "UPDATE ". CONFIG_TABLE ."
		  SET config_value = '$ddos_level'
		  WHERE config_name = 'phpBBSecurity_DDoS_level'";
	$db->sql_query($q);
	
	$q = "UPDATE ". CONFIG_TABLE ."
		  SET config_value = '". intval($per_page) ."'
		  WHERE config_name = 'phpBBSecurity_per_page'";
	$db->sql_query($q);

		if ($add_referer)
			{
		$current_referers 	= '';
		$current_referers	= $board_config['phpBBSecurity_disallowed_referers'];
		$current_referers 	.= addslashes(stripslashes($add_referer)) .',';
		
		$q = "UPDATE ". CONFIG_TABLE ."
			  SET config_value = '$current_referers'
			  WHERE config_name = 'phpBBSecurity_disallowed_referers'";
		$db->sql_query($q);		
			}
			
		if ($remove_referer)
			{
		$current_referers = '';
		$current_referers = str_replace(addslashes(stripslashes($remove_referer)) .',', '', $board_config['phpBBSecurity_disallowed_referers']);
		
		$q = "UPDATE ". CONFIG_TABLE ."
			  SET config_value = '$current_referers'
			  WHERE config_name = 'phpBBSecurity_disallowed_referers'";
		$db->sql_query($q);			
			}
					
		if ($add_agent)
			{
		$current_agents = '';
		$current_agents	= $board_config['phpBBSecurity_disallowed_agents'];
		$current_agents .= addslashes(stripslashes($add_agent)) .',';
		
		$q = "UPDATE ". CONFIG_TABLE ."
			  SET config_value = '$current_agents'
			  WHERE config_name = 'phpBBSecurity_disallowed_agents'";
		$db->sql_query($q);		
			}
			
		if ($remove_agent)
			{
		$current_agents = '';
		$current_agents = str_replace(addslashes(stripslashes($remove_agent)) .',', '', $board_config['phpBBSecurity_disallowed_agents']);
		
		$q = "UPDATE ". CONFIG_TABLE ."
			  SET config_value = '$current_agents'
			  WHERE config_name = 'phpBBSecurity_disallowed_agents'";
		$db->sql_query($q);			
			}
			
		if ($add_admin)
			{
		$current_admins = '';
		$current_admins = $board_config['phpBBSecurity_allowed_admins'];
		$current_admins .= $add_admin .',';
		
		$q = "UPDATE ". CONFIG_TABLE ."
			  SET config_value = '$current_admins'
			  WHERE config_name = 'phpBBSecurity_allowed_admins'";
		$db->sql_query($q);
			}
		
		if ($remove_admin)
			{
		$current_admins = '';			
		$current_admins = str_replace($remove_admin .',', '', $board_config['phpBBSecurity_allowed_admins']);
		
		$q = "UPDATE ". CONFIG_TABLE ."
			  SET config_value = '$current_admins'
			  WHERE config_name = 'phpBBSecurity_allowed_admins'";
		$db->sql_query($q);			
			}
			
	phpBBSecurity_UpdateSpecial($s_a, $s_m, $s_u, $s_d, $s_cl, $s_cb, $s_e, $s_s, $s_p, $s_un, $s_f);
		
	message_die(GENERAL_MESSAGE, $lang['PS_admin_special_saved'] .'<br><br>'. sprintf($lang['PS_return_config'], '<a href="admin_security.'. $phpEx .'?sid='. $userdata['session_id'] .'">', '</a>') .'<br>'. sprintf($lang['PS_return_special'], '<a href="admin_security.'. $phpEx .'?mode=special&sid='. $userdata['session_id'] .'">', '</a>'));
		}
		
	if ( ($action == 'save_config') && ($userdata['user_level'] == ADMIN) )
		{
	$ps_a = (isset($_POST['ps_admin'])) 		? $_POST['ps_admin'] 			: '';
	$ps_i = (isset($_POST['ps_admin_id'])) 	? $_POST['ps_admin_id'] 		: '';
	$ps_l = (isset($_POST['ps_limit'])) 		? $_POST['ps_limit'] 			: '';
	$ps_b = (isset($_POST['ps_ban'])) 			? $_POST['ps_ban'] 			: '';
	$ps_s = (isset($_POST['ps_sess'])) 		? $_POST['ps_sess'] 			: '';
	$ps_c = (isset($_POST['ps_allow_change'])) ? $_POST['ps_allow_change'] 	: '';
	$ps_p = (isset($_POST['ps_admin_pm'])) 	? $_POST['ps_admin_pm'] 		: '';
	$ps_e = (isset($_POST['ps_admin_em'])) 	? $_POST['ps_admin_em'] 		: '';
	
	$use_pw_match	 	= (isset($_POST['phpBBSecurity_use_password_match'])) ? $_POST['phpBBSecurity_use_password_match'] : '';
	$use_pw_length 		= (isset($_POST['phpBBSecurity_use_password_length'])) ? $_POST['phpBBSecurity_use_password_length'] : '';
	$pw_length			= (isset($_POST['phpBBSecurity_password_min_length'])) ? intval($_POST['phpBBSecurity_password_min_length']) : '';
	
		if ( ($use_pw_length) && ($pw_length <= 0) )
			message_die(GENERAL_ERROR, $lang['PS_pass_error']);
			
	phpBBSecurity_UpdateConfig($ps_a, $ps_i, $ps_l, $ps_b, $ps_s, $ps_c, $ps_p, $ps_e, $use_pw_match, $use_pw_length, $pw_length);
	message_die(GENERAL_MESSAGE, $lang['PS_admin_config_saved'] .'<br><br>'. sprintf($lang['PS_return_config'], '<a href="admin_security.'. $phpEx .'?sid='. $userdata['session_id'] .'">', '</a>'));
		}
		
	if (!$mode)
		{
	$template->set_filenames(array('body' => 'admin/admin_security_body.tpl'));
	
	$q = "SELECT username, user_id
		  FROM ". USERS_TABLE ."
		  WHERE user_level = '". ADMIN ."'";
	$r = $db->sql_query($q);
	
		while($admins = $db->sql_fetchrow($r))
			{
		$template->assign_block_vars('admins', array(
			'ID'	=> $admins['user_id'],
			'NAME'	=> $admins['username'])
				);
			}
							
	$template->assign_vars(array(
		'ACTION'			=> 'admin_security.'. $phpEx .'?sid='. $userdata['session_id'],
		'L_SUBMIT'			=> $lang['PS_admin_submit'],
		'L_ENABLED' 		=> $lang['Enabled'], 
		'L_DISABLED' 		=> $lang['Disabled'], 	
		'PS_YES_L'			=> $lang['PS_list_choice_one'],
		'PS_NO_L'			=> $lang['PS_list_choice_two'],
		'ADMIN_EM_V'		=> ($board_config['phpBBSecurity_notify_admin_em']) ? 'checked="checked"' : '',	
		'ADMIN_EM_L'		=> $lang['PS_notify_admin_by_em'],
		'ADMIN_PM_V'		=> ($board_config['phpBBSecurity_notify_admin_pm']) ? 'checked="checked"' : '',	
		'ADMIN_PM_L'		=> $lang['PS_notify_admin_by_pm'],
		'ALLOW_CHANGE_L'	=> $lang['PS_allow_user_change'],	
		'ALLOW_CHANGE_Y'	=> ($board_config['phpBBSecurity_Allow_Change']) ? 'checked="checked"' : '',
		'ALLOW_CHANGE_N'	=> (!$board_config['phpBBSecurity_Allow_Change']) ? 'checked="checked"' : '',	
		'PS_LOGIN_LIMIT_V'	=> $board_config['phpBBSecurity_login_limit'],
		'PS_LOGIN_LIMIT_L'	=> $lang['PS_admin_one'],
		'PS_LOGIN_LIMIT_E'	=> $lang['PS_admin_one_exp'],	
		'PS_NOTIFY_ADMIN_L'	=> $lang['PS_admin_two'],
		'PS_NOTIFY_ADMIN_E'	=> $lang['PS_admin_two_exp'],
		'PS_NOTIFY_ADMIN_Y'	=> ($board_config['phpBBSecurity_notify_admin']) ? 'checked="checked"' : '',	
		'PS_NOTIFY_ADMIN_N'	=> (!$board_config['phpBBSecurity_notify_admin']) ? 'checked="checked"' : '',	
		'PS_ADMIN_ID_V'		=> str_replace('%A%', phpBBSecurity_GetName($board_config['phpBBSecurity_notify_admin_id']), $lang['PS_admin_current']),
		'PS_ADMIN_ID_L'		=> $lang['PS_admin_three'],
		'PS_ADMIN_ID_E'		=> $lang['PS_admin_three_exp'],
		'PS_ADMIN_DEFAULT'	=> $lang['PS_admin_default'],
		'PS_ADMIN_BAN_L'	=> $lang['PS_admin_ban'],
		'PS_ADMIN_BAN_E'	=> $lang['PS_admin_ban_exp'],
		'PS_ADMIN_BAN_Y'	=> ($board_config['phpBBSecurity_auto_ban']) ? 'checked="checked"' : '',	
		'PS_ADMIN_BAN_N'	=> (!$board_config['phpBBSecurity_auto_ban']) ? 'checked="checked"' : '',	
		'PS_ADMIN_SESS_L'	=> $lang['PS_admin_sessions'],
		'PS_ADMIN_SESS_E'	=> $lang['PS_admin_sessions_exp'],
		'PS_ADMIN_SESS_V'	=> $board_config['phpBBSecurity_allowed_sessions'],
		'PS_ADMIN_TITLE'	=> $lang['PS_login_header'],
		'PS_L_PASS_MATCH'	=> $lang['PS_pass_match'],
		'PS_L_PASS_MATCH_E'	=> $lang['PS_pass_match_exp'],
		'PS_PASS_MATCH_Y'	=> ($board_config['phpBBSecurity_use_password_match']) ? 'checked="checked"' : '',	
		'PS_PASS_MATCH_N'	=> (!$board_config['phpBBSecurity_use_password_match']) ? 'checked="checked"' : '',
		'PS_L_PASS_LEN'		=> $lang['PS_pass_min_length'],
		'PS_L_PASS_LEN_E'	=> $lang['PS_pass_min_length_exp'],
		'PS_PASS_LEN_Y'		=> !empty($board_config['phpBBSecurity_use_password_length']) ? 'checked="checked"' : '',	
		'PS_PASS_LEN_N'		=> empty($board_config['phpBBSecurity_use_password_length']) ? 'checked="checked"' : '',
		'PS_L_PASS_LENGTH'	=> $lang['PS_pass_length'],
		'PS_L_BACKUP_REMOVE'	=> $lang['PS_backup_remove'],
		'PS_PASS_LENGTH'	=> $board_config['phpBBSecurity_password_min_length'],)
			);
			
	$template->pparse('body');		
		}
		
	if ($mode == 'special')
		{
	$template->set_filenames(array('body' => 'admin/admin_security_special_body.tpl'));		
	
	unset($authed, $allowed_admins);
	$allowed_admins = explode(',', $board_config['phpBBSecurity_allowed_admins']);
	
	for ($x = 0; $x < count($allowed_admins); $x++)
		{
		if ( ($userdata['user_id'] == $allowed_admins[$x]) && ($userdata['user_level'] == ADMIN) )
			{
		$allowed = TRUE;
		break;
			}
		}
	if ($userdata['user_id'] == phpBBSecurity_OldestAdmin())
		$allowed = TRUE;
		
	if (!$allowed)
		message_die(GENERAL_ERROR, $lang['PS_admin_not_authed']);
		
		$special 	= phpBBSecurity_SpecialCount();
		$split_it 	= explode('%SPLIT%', $special);
		$t_admins 	= str_replace('%X%', $split_it[0], $lang['PS_special_admins_total']);
		$t_mods 	= str_replace('%X%', $split_it[1], $lang['PS_special_mods_total']);
		
			if ($split_it[1] > $board_config[phpBBSecurity_ModConfigName()])
				$mod_problem = $lang['PS_special_mods_offset'];
			else
				$mod_problem = '';
				
			if ($split_it[0] > $board_config[phpBBSecurity_AdminConfigName()])
				$admin_problem = $lang['PS_special_admins_offset'];
			else
				$admin_problem = '';			
		
		$q = "SELECT username, user_id
			  FROM ". USERS_TABLE ."
			  WHERE user_level = '". ADMIN ."'
			  AND user_id <> '". phpBBSecurity_OldestAdmin() ."'";
		$r = $db->sql_query($q);
		$admin_users = $db->sql_fetchrowset($r);
		
		$no_access_list 	= '';
		$has_access_list	= '';
		
		$no_access_list 	.= '<select name="grant_access">';
		$no_access_list 	.= '<option class="post" value="">-----</option>';
		for ($x = 0; $x < count($admin_users); $x++)
			$no_access_list 	.= '<option class="post" value="'. $admin_users[$x]['user_id'] .'">'. $admin_users[$x]['username'] .'</option>';
		$no_access_list 	.= '</select>';
		
		$has_access_list 	.= '<select name="deny_access">';
		$has_access_list 	.= '<option class="post" value="">-----</option>';
		for ($x = 0; $x < count($allowed_admins); $x++)
			{
			if (!$allowed_admins[$x])
				break;
			for ($y = 0; $y < count($admin_users); $y++)
				{
				if ($admin_users[$y]['user_id'] == $allowed_admins[$x])
					{
				$has_access_list .= '<option class="post" value="'. $admin_users[$y]['user_id'] .'">'. $admin_users[$y]['username'] .'</option>';					
					}
				}
			}
		$has_access_list 	.= '</select>';		
		
		$get_agents			= explode(',', $board_config['phpBBSecurity_disallowed_agents']);
		$disallowed_agents 	= '';
		$disallowed_agents 	.= '<select name="allow_agents">';
		$disallowed_agents 	.= '<option class="post" value="">-----</option>';
		for ($x = 0; $x < count($get_agents); $x++)
			$disallowed_agents 	.= '<option class="post" value="'. $get_agents[$x] .'">'. $get_agents[$x] .'</option>';
		$disallowed_agents 	.= '</select>';
		
		$get_referers			= explode(',', $board_config['phpBBSecurity_disallowed_referers']);
		$disallowed_referers 	= '';
		$disallowed_referers 	.= '<select name="allow_referers">';
		$disallowed_referers 	.= '<option class="post" value="">-----</option>';
		for ($x = 0; $x < count($get_referers); $x++)
			$disallowed_referers .= '<option class="post" value="'. $get_referers[$x] .'">'. $get_referers[$x] .'</option>';
		$disallowed_referers	.= '</select>';		
		$time_select_arr = array(
			'00' => '12 AM',
			'01' => '1 AM',
			'02' => '2 AM',
			'03' => '3 AM',
			'04' => '4 AM',
			'05' => '5 AM',
			'06' => '6 AM',
			'07' => '7 AM',
			'08' => '8 AM',
			'09' => '9 AM',
			'10' => '10 AM',
			'11' => '11 AM',
			'12' => '12 PM',
			'13' => '1 PM',
			'14' => '2 PM',
			'15' => '3 PM',
			'16' => '4 PM',
			'17' => '5 PM',
			'18' => '6 PM',
			'19' => '7 PM',
			'20' => '8 PM',
			'21' => '9 PM',
			'22' => '10 PM',
			'23' => '11 PM',
		);

		$time_select = '';
		$time_select .= '<select name="backup_time">';
		$time_select .= '<option value="" class="post">-----</option>';
		reset($time_select_arr);
		foreach($time_select_arr as $myval => $mytxt){
			$time_select .= '<option value="'.$myval.'" class="post"'.(($board_config['phpBBSecurity_backup_time'] == $myval)?'selected':'').'>'.$mytxt.'</option>';
		}
		$time_select .= '</select>';

		$backups 		= '';
		$a				= 0;
		$backups_dir	= $phpbb_root_path . $board_config['phpBBSecurity_backup_folder'] .'/';
		$browse 		= @opendir($backups_dir);
		if ($browse)
		{
			while ($daily_backups = @readdir($browse)) 
			{			
				if ( ($daily_backups != '.htaccess') && ($daily_backups != '.') && ($daily_backups != '..') && ($daily_backups != 'index.htm') )
				{
					$a++;
					$backups .= '<br>'. $a .'. <a href="'. append_sid('admin_security.'. $phpEx .'?mode=unlink&amp;file='. $daily_backups) .'" title='. $lang['PS_backup_remove'] .'>'. $daily_backups .'</a> :: '. AdminBackupSize(@filesize($backups_dir . $daily_backups)) .' :: '. create_date($board_config['default_dateformat'], @filemtime($backups_dir . $daily_backups), $board_config['board_timezone']);
				}
			}
			@closedir($browse);
		}

		$template->assign_vars(array(
			'BACK_ON'		=> $lang['PS_backup_on'],			
			'BACK_ON_V_Y'	=> ($board_config['phpBBSecurity_backup_on']) ? 'checked="checked"' : '',
			'BACK_ON_V_N'	=> (!$board_config['phpBBSecurity_backup_on']) ? 'checked="checked"' : '',			
			'BACK_FOLDER'	=> $lang['PS_backup_folder'],
			'BACK_FOLDER_E'	=> $lang['PS_backup_folder_exp'],
			'BACK_FOLDER_V'	=> $board_config['phpBBSecurity_backup_folder'],
			'BACK_FILE'		=> $lang['PS_backup_filename'],
			'BACK_FILE_E'	=> $lang['PS_backup_filename_exp'],
			'BACK_FILE_V'	=> $board_config['phpBBSecurity_backup_filename'],
			'BACK_TIME'		=> $lang['PS_backup_time'],
			'BACK_V'		=> $time_select,
			'BACK_TOTAL'	=> str_replace('%N%', $backups, $lang['PS_backup_total']),
			'ADMIN_L_ONE'	=> $no_access_list,
			'ADMIN_L_TWO'	=> $has_access_list,
			'L_GRANT'		=> $lang['PS_admin_grant_access'],
			'L_DENY'		=> $lang['PS_admin_deny_access'],			
			'L_SUBMIT'		=> $lang['PS_admin_submit_special'],
			'AGENT'			=> $lang['PS_block_agents'],
			'AGENT_EXP'		=> $lang['PS_block_agents_exp'],
			'AGENTS_V'		=> $disallowed_agents,
			'AGENT_TWO'		=> $lang['PS_unblock_agents'],
			'REFERER'		=> $lang['PS_block_referers'],
			'REFERER_EXP'	=> $lang['PS_block_referers_exp'],
			'REFERER_V'		=> $disallowed_referers,
			'REFERER_TWO'	=> $lang['PS_unblock_referers'],			
			'ACTION'		=> 'admin_security.'. $phpEx .'?mode=special&sid='. $userdata['session_id'],
			'L_ENABLED' 	=> $lang['Enabled'], 
			'L_DISABLED'	=> $lang['Disabled'], 			
			'WARNING'		=> $lang['PS_option_warning'],
			'ONE'			=> $lang['PS_option_ban'],
			'TWO'			=> $lang['PS_option_block'],
			'THREE'			=> $lang['PS_option_ignore'],
			'PER_PAGE'		=> $lang['PS_per_page'],
			'V_PER_PAGE'	=> $board_config['phpBBSecurity_per_page'],
			# DDoS Level Start
			'LEVEL_H'		=> ($board_config['phpBBSecurity_DDoS_level'] == 1) ? 'checked="checked"' : '',
			'LEVEL_M'		=> ($board_config['phpBBSecurity_DDoS_level'] == 2) ? 'checked="checked"' : '',
			'LEVEL_L'		=> ($board_config['phpBBSecurity_DDoS_level'] == 3) ? 'checked="checked"' : '',
			'LEVEL_EXP'		=> $lang['PS_ddos_level'],
			'L_LEVEL_H'		=> $lang['PS_ddos_high'],
			'L_LEVEL_M'		=> $lang['PS_ddos_medium'],
			'L_LEVEL_L'		=> $lang['PS_ddos_low'],						
			# DDoS level Stop; Clike Start
			'BAN_1'			=> ($board_config['phpBBSecurity_Clike_Ban'] == 1) ? 'checked="checked"' : '',
			'BLOCK_1'		=> ($board_config['phpBBSecurity_Clike_Ban'] == 2) ? 'checked="checked"' : '',
			'IGNORE_1'		=> ($board_config['phpBBSecurity_Clike_Ban'] == 0) ? 'checked="checked"' : '',
			'EXP_1'			=> $lang['PS_list_two'],
			# Clike Stop; Union Start
			'BAN_2'			=> ($board_config['phpBBSecurity_Union_Ban'] == 1) ? 'checked="checked"' : '',
			'BLOCK_2'		=> ($board_config['phpBBSecurity_Union_Ban'] == 2) ? 'checked="checked"' : '',
			'IGNORE_2'		=> ($board_config['phpBBSecurity_Union_Ban'] == 0) ? 'checked="checked"' : '',
			'EXP_2'			=> $lang['PS_list_three'],
			# Union Stop; SQL Start
			'BAN_3'			=> ($board_config['phpBBSecurity_SQL_Ban'] == 1) ? 'checked="checked"' : '',
			'BLOCK_3'		=> ($board_config['phpBBSecurity_SQL_Ban'] == 2) ? 'checked="checked"' : '',
			'IGNORE_3'		=> ($board_config['phpBBSecurity_SQL_Ban'] == 0) ? 'checked="checked"' : '',
			'EXP_3'			=> $lang['PS_list_five'],
			# SQL Stop; DDoS Start
			'BAN_4'			=> ($board_config['phpBBSecurity_DDoS_Ban'] == 1) ? 'checked="checked"' : '',
			'BLOCK_4'		=> ($board_config['phpBBSecurity_DDoS_Ban'] == 2) ? 'checked="checked"' : '',
			'IGNORE_4'		=> ($board_config['phpBBSecurity_DDoS_Ban'] == 0) ? 'checked="checked"' : '',
			'EXP_4'			=> $lang['PS_list_one'],
			# DDoS Stop; File Start
			'BAN_5'			=> ($board_config['phpBBSecurity_File_Ban'] == 1) ? 'checked="checked"' : '',
			'BLOCK_5'		=> ($board_config['phpBBSecurity_File_Ban'] == 2) ? 'checked="checked"' : '',
			'IGNORE_5'		=> ($board_config['phpBBSecurity_File_Ban'] == 0) ? 'checked="checked"' : '',
			'EXP_5'			=> $lang['PS_list_eight'],
			# File Stop; Perl Start
			'BAN_6'			=> ($board_config['phpBBSecurity_Perl_Ban'] == 1) ? 'checked="checked"' : '',
			'BLOCK_6'		=> ($board_config['phpBBSecurity_Perl_Ban'] == 2) ? 'checked="checked"' : '',
			'IGNORE_6'		=> ($board_config['phpBBSecurity_Perl_Ban'] == 0) ? 'checked="checked"' : '',
			'EXP_6'			=> $lang['PS_list_six'],
			# Perl Stop; Encoded Start
			'BAN_7'			=> ($board_config['phpBBSecurity_Encoded_Ban'] == 1) ? 'checked="checked"' : '',
			'BLOCK_7'		=> ($board_config['phpBBSecurity_Encoded_Ban'] == 2) ? 'checked="checked"' : '',
			'IGNORE_7'		=> ($board_config['phpBBSecurity_Encoded_Ban'] == 0) ? 'checked="checked"' : '',
			'EXP_7'			=> $lang['PS_list_seven'],
			# Encoded Stop; CBACK Start
			'BAN_8'			=> ($board_config['phpBBSecurity_Cback_Ban'] == 1) ? 'checked="checked"' : '',
			'BLOCK_8'		=> ($board_config['phpBBSecurity_Cback_Ban'] == 2) ? 'checked="checked"' : '',
			'IGNORE_8'		=> ($board_config['phpBBSecurity_Cback_Ban'] == 0) ? 'checked="checked"' : '',
			'EXP_8'			=> $lang['PS_list_four'],
			# CBACK Stop												
			'TITLE'			=> $lang['PS_special'],
			'ADMIN'			=> $lang['PS_special_admins'],
			'ADMIN_2'		=> $lang['PS_special_admins_exp'],
			'ADMIN_3'		=> $board_config[phpBBSecurity_AdminConfigName()],
			'ADMIN_4'		=> $t_admins,
			'ADMIN_5'		=> $admin_problem,
			'MOD'			=> $lang['PS_special_mods'],
			'MOD_2'			=> $lang['PS_special_mods_exp'],
			'MOD_3'			=> $board_config[phpBBSecurity_ModConfigName()],
			'MOD_4'			=> $t_mods,
			'MOD_5'			=> $mod_problem,
			'USE'			=> $lang['PS_use_special'],
			'USE_E'			=> $lang['PS_use_special_exp'],
			'L_GUEST'		=> $lang['PS_guest_max'],
			'L_GUEST_EXP'	=> $lang['PS_guest_max_exp'],
			'GUEST'			=> intval($board_config['phpBBSecurity_guest_matches']),
			'USE_Y'			=> ($board_config[phpBBSecurity_UseSpecial()]) ? 'checked="checked"' : '',	
			'USE_N'			=> (!$board_config[phpBBSecurity_UseSpecial()]) ? 'checked="checked"' : '')
				);			
	$template->pparse('body');		
		}
		
include_once('page_footer_admin.' . $phpEx);

?>
