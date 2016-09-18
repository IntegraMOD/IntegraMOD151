<?php
/***************************************************************************
 *                             phpbb_security.php
 *                            --------------------
 *		Version			: 1.0.3
 *		Email			: austin@phpbb-amod.com
 *		Site			: http://phpbb-tweaks.com
 *		Copyright		: aUsTiN-Inc 2003/6
 *
 ***************************************************************************/

	#==== Added Per Techie-Micheal's Suggestion. Thanks!
	if (!defined('IN_PHPBB'))
		die('<p><strong>Access Denied:</strong> This file ('.basename(__FILE__).') cannot be accessed directly.</p>');
	
	global $table_prefix, $board_config, $phpbb_root_path, $phpEx;
	define('PHPBB_SECURITY', $table_prefix .'phpBBSecurity');
	include_once($phpbb_root_path .'language/lang_'. $board_config['default_lang'] .'/lang_main.'. $phpEx);		
	
	function phpBBSecurity_Error($reason, $add_count)
		{
	global $board_config, $db, $phpEx, $phpbb_root_path, $lang;
	//include($phpbb_root_path .'language/lang_'. $board_config['default_lang'] .'/lang_phpbb_security.'. $phpEx);
	
	$lang_key 	= 'PS_die_msg_'. $reason;
	$message 	= '';	
	$message 	.= $lang['PS_auto_message'] . str_replace("@", " [at] ", $board_config['board_email']);
	$message 	.= '<br><br>';
	$message 	.= $lang[$lang_key];
	//$message 	.= '<br>';
	//$message 	.= str_replace('%email%', $board_config['board_email'], $lang['PS_die_msg_email']);
	
		if ($add_count)
			{
		$q = "UPDATE ". CONFIG_TABLE ."
			  SET config_value = config_value + 1
			  WHERE config_name = 'phpBBSecurity_total_attempts'";
		$db->sql_query($q);
			}
				
	die($message);
	exit();		
		}

//*** The return valuse in the next 3 functions MUST be changed to the default values prior to installing.See Michales_notes.txt in install directory before running an install ***//
	
	function phpBBSecurity_AdminConfigName()
	{
		return 'phpBBSecurity_max_admins';
	}
		
	function phpBBSecurity_ModConfigName()
	{
		return 'phpBBSecurity_max_mods';
	}
		
	function phpBBSecurity_UseSpecial()
	{
		return 'phpBBSecurity_use_max';
	}			

	function phpBBSecurity_Validate($q, $a, $user, $mode, $location)
		{
		global $userdata, $db, $board_config;
		
		if ( ($mode == 'profil') && ($location == 'pre') )
			{
			if (empty($q) || empty($a))
				return phpBBSecurity_MD('1');
			}
			
		if ( ($mode == 'profil') && (!$userdata['phpBBSecurity_question']) && (!$userdata['phpBBSecurity_answer']) )
			{
			if (empty($q) || empty($a))
				return phpBBSecurity_MD('1');
									
			if (trim($q) != $userdata['phpBBSecurity_question'])
				$new_q = trim($q);
					
			if ($a != $userdata['phpBBSecurity_answer'])
				$new_a = md5($a);

			if ($new_a)
				{
			$q = "UPDATE ". USERS_TABLE ."
				  SET phpBBSecurity_answer = '". $new_a ."'
				  WHERE user_id = '". $user ."'";
			$db->sql_query($q);
				}
				
			if ($new_q)
				{				
			$q = "UPDATE ". USERS_TABLE ."
				  SET phpBBSecurity_question = '". str_replace("\'", "''", $new_q) ."'
				  WHERE user_id = '". $user ."'";
			$db->sql_query($q);
				}
			}
					
		if ( ($mode == 'profil') && ($userdata['phpBBSecurity_question']) && ($userdata['phpBBSecurity_answer']) )
			{
			if ($board_config['phpBBSecurity_Allow_Change'])
				{
				if (empty($q) || empty($a))
					return phpBBSecurity_MD('1');
									
				if (trim($q) != $userdata['phpBBSecurity_question'])
					$new_q = trim($q);
					
				if ($a != $userdata['phpBBSecurity_answer'])
					$new_a = md5($a);

				if ($new_a)
					{
				$q = "UPDATE ". USERS_TABLE ."
					  SET phpBBSecurity_answer = '". $new_a ."'
					  WHERE user_id = '". $user ."'";
				$db->sql_query($q);
					}
					
				if ($new_q)
					{				
				$q = "UPDATE ". USERS_TABLE ."
					  SET phpBBSecurity_question = '". str_replace("\'", "''", $new_q) ."'
					  WHERE user_id = '". $user ."'";
				$db->sql_query($q);
					}
				}						
			}
			
		if ( ($mode == 'profil') && ($location == 'post') )
			{
			if ($user != ANONYMOUS)
				{
				if (empty($q) || empty($a))
					return phpBBSecurity_MD('1');
					
			$new_q = trim($q);
			$new_a = md5($a);
			
			$q = "UPDATE ". USERS_TABLE ."
				  SET phpBBSecurity_question = '". str_replace("\'", "''", $new_q) ."', phpBBSecurity_answer = '". $new_a ."'
				  WHERE user_id = '". $user ."'";
			$db->sql_query($q);
										
				}
			}
		}
		
	function phpBBSecurity_MD($val)
		{
		global $lang;
		if ($val == '1')
			message_die(GENERAL_ERROR, $lang['PS_security_one'], $lang['PS_security_error']);
			
		if ($val == '2')
			message_die(GENERAL_ERROR, $lang['PS_security_locked'], $lang['PS_security_error']);
			
		if ($val == '3')
			message_die(GENERAL_MESSAGE, $lang['PS_security_force'], $lang['PS_security_info']);
			
		if ($val == '4')
			message_die(GENERAL_ERROR, $lang['PS_admin_err_one'], $lang['PS_security_error']);
			
		if ($val == '5')
			message_die(GENERAL_ERROR, $lang['PS_admin_error_five'], $lang['PS_security_error']);
			
		if ($val == '6')
			message_die(GENERAL_ERROR, $lang['PS_admin_error_three'], $lang['PS_security_error']);
			
		if ($val == '7')
			message_die(GENERAL_ERROR, $lang['PS_admin_error_four'], $lang['PS_security_error']);
			
		if ($val == '8')
			message_die(GENERAL_ERROR, $lang['PS_admin_error_two'], $lang['PS_security_error']);
			
		if ($val == '9')
			message_die(GENERAL_ERROR, $lang['PS_login_step_failed'], $lang['PS_security_error']);
			
		if ($val == '10')
			message_die(GENERAL_MESSAGE, $lang['PS_login_validated'], $lang['PS_security_info']);
			
		if ($val == '11')
			message_die(GENERAL_MESSAGE, $lang['PS_forgot_exp'], $lang['PS_security_info']);									
		}
		
	function phpBBSecurity_InvalidLogin($user)
		{
		global $db;
		
		$q = "UPDATE ". USERS_TABLE ."
			  SET phpBBSecurity_login_tries = phpBBSecurity_login_tries + 1
			  WHERE user_id = '". $user ."'";
		$db->sql_query($q);
		}
		
	function phpBBSecurity_ResetTries($user)
		{
		global $db;
		
		$q = "UPDATE ". USERS_TABLE ."
			  SET phpBBSecurity_login_tries = '0', phpBBSecurity_pm_sent = '0'
			  WHERE user_id = '". $user ."'";
		$db->sql_query($q);
		}
		
	function phpBBSecurity_SetPM($user)
		{
		global $db;
		
		$q = "UPDATE ". USERS_TABLE ."
			  SET phpBBSecurity_pm_sent = '1'
			  WHERE user_id = '". $user ."'";
		$db->sql_query($q);
		}			
		
	function phpBBSecurity_CheckTries($user)
		{
		global $db, $board_config;
		
		$q = "SELECT phpBBSecurity_login_tries, username, phpBBSecurity_pm_sent
			  FROM ". USERS_TABLE ."
			  WHERE user_id = '". $user ."'";
		$r 		= $db->sql_query($q);
		$row 	= $db->sql_fetchrow($r);
		
		$tries = intval($row['phpBBSecurity_login_tries']);
		
			if ( (!$row['phpBBSecurity_pm_sent']) && ($board_config['phpBBSecurity_notify_admin']) && ($tries >= intval($board_config['phpBBSecurity_login_limit'])) )
					phpBBSecurity_PM($board_config['phpBBSecurity_notify_admin_id'], ANONYMOUS, $row['username']);
							
			if ($tries >= intval($board_config['phpBBSecurity_login_limit']))
				return phpBBSecurity_MD('2');
		}
		
	function phpBBSecurity_Force()
		{
		return phpBBSecurity_MD('3');
		}
	
	function phpBBSecurity_UpdateConfig($ps_a, $ps_i, $ps_l, $ps_b, $ps_s, $ps_c, $ps_p, $ps_e, $use_pw_match, $use_pw_length, $pw_length)
		{
		global $db, $board_config;
		$limit 	= intval($ps_l);
		$a_id 	= intval($ps_i);
		$use 	= $ps_a;
		$sess	= intval($ps_s);
		$ban_on	= $ps_b;
		$change = (intval($ps_c) > 0) ? 1 : 0;
		$email 	= (intval($ps_e) > 0) ? 1 : 0;
		$prvmsg = (intval($ps_p) > 0) ? 1 : 0;
		
		if (!is_numeric($limit))
			return phpBBSecurity_MD('5');
					
		if ($limit < '1')
			return phpBBSecurity_MD('4');
			
		if ( ($use) && (!$board_config['phpBBSecurity_notify_admin_id']) && (!$a_id || !is_numeric($a_id)))
			return phpBBSecurity_MD('8');
					
		if ( (!is_numeric($a_id)) && (!$board_config['phpBBSecurity_notify_admin_id']) )
			return phpBBSecurity_MD('7');
									
		if ( ($a_id < '1') && (!$board_config['phpBBSecurity_notify_admin_id']) )
			return phpBBSecurity_MD('6');

		$config_name_array 	= array('phpBBSecurity_login_limit', 'phpBBSecurity_notify_admin', 'phpBBSecurity_auto_ban', 'phpBBSecurity_allowed_sessions', 'phpBBSecurity_Allow_Change', 'phpBBSecurity_notify_admin_em', 'phpBBSecurity_notify_admin_pm', 'phpBBSecurity_use_password_match', 'phpBBSecurity_use_password_length', 'phpBBSecurity_password_min_length');
		$config_value_array = array($limit, $use, $ban_on, $sess, $change, $email, $prvmsg, $use_pw_match, $use_pw_length, $pw_length);
		
		if ($a_id)
			{
		$config_name_array[] = 'phpBBSecurity_notify_admin_id';
		$config_value_array[] = $a_id;
			}	
			
		for ($i = 0; $i < count($config_name_array); $i++)
			{
		$q = "UPDATE ". CONFIG_TABLE ."
			  SET config_value = '". $config_value_array[$i] ."'
			  WHERE config_name = '". $config_name_array[$i] ."'";
		$db->sql_query($q);
			}													
		}
		
	function phpBBSecurity_GetName($id)
		{
		global $db;
		
		$q = "SELECT username
			  FROM ". USERS_TABLE ."
			  WHERE user_id = '". $id ."'";
		$r 		= $db->sql_query($q);
		$row 	= $db->sql_fetchrow($r);
		$name 	= $row['username'];
		return $name;
		}
		
	function phpBBSecurity_ValidateStepOne($ps_username, $ps_email)
		{
		global $db;
		
		$q = "SELECT user_email
			  FROM ". USERS_TABLE ."
			  WHERE username = '". str_replace("\'", "''", $ps_username) ."'";
		$r 			= $db->sql_query($q);
		$row 		= $db->sql_fetchrow($r);		
		$real_email = $row['user_email'];
		
		if ($real_email != $ps_email)
			return phpBBSecurity_MD('9');
		}
		
	function phpBBSecurity_ValidateGetQ($ps_username, $ps_email)
		{
		global $db;
		
		$q = "SELECT phpBBSecurity_question 
			  FROM ". USERS_TABLE ."
			  WHERE username = '". str_replace("\'", "''", $ps_username) ."'";
		$r 		= $db->sql_query($q);
		$row	= $db->sql_fetchrow($r);		
		$q 		= $row['phpBBSecurity_question'];

		return $q;
		}		
		
	function phpBBSecurity_ValidateStepTwo($ps_username, $ps_answer)
		{
		global $db;
		
		$q = "SELECT phpBBSecurity_answer, user_id
			  FROM ". USERS_TABLE ."
			  WHERE username = '". str_replace("\'", "''", $ps_username) ."'";
		$r 		= $db->sql_query($q);
		$row 	= $db->sql_fetchrow($r);		
		$answer = $row['phpBBSecurity_answer'];
		
		if (md5($ps_answer) != $answer)
			return phpBBSecurity_MD('9');
			
		phpBBSecurity_Validated($row['user_id']);
		}		
		
	function phpBBSecurity_Validated($user_id)
		{
		global $db;
		
		$q = "UPDATE ". USERS_TABLE ."
			  SET phpBBSecurity_login_tries = '0'
			  WHERE user_id = '$user_id'";
		$db->sql_query($q);
		return phpBBSecurity_MD('10');
		}
		
	function phpBBSecurity_Forgot()
		{
		return phpBBSecurity_MD('11');
		}		
		
	function phpBBSecurity_QueryString()
		{
		if (isset($_SERVER['QUERY_STRING']))
    		return eregi_replace('%09', '%20', $_SERVER['QUERY_STRING']);
		elseif (isset($_SERVER['QUERY_STRING']))
    		return eregi_replace('%09', '%20', $_SERVER['QUERY_STRING']);
		elseif (getenv('QUERY_STRING'))
			return eregi_replace('%09', '%20', getenv('QUERY_STRING'));
		else
    		return 'unknown';		
		}

	function phpBBSecurity_IP()
		{ 
		if (getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown'))
			return getenv('REMOTE_ADDR');
		elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown'))
			return $_SERVER['REMOTE_ADDR'];
		else
			return 'unknown';       
      }
				
	function phpBBSecurity_RequestMethod() 
		{
		if (isset($_SERVER['REQUEST_METHOD'])) 
			return $_SERVER['REQUEST_METHOD'];
		elseif (isset($_SERVER['REQUEST_METHOD']))
			return $_SERVER['REQUEST_METHOD'];
		elseif (getenv('REQUEST_METHOD'))
			return getenv('REQUEST_METHOD');
		else
			return 'unknown';
	  	}
		
	function phpBBSecurity_ServerName() 
		{
		if (isset($_SERVER['SERVER_NAME'])) 
			return $_SERVER['SERVER_NAME'];
		elseif (isset($_SERVER['SERVER_NAME']))
			return $_SERVER['SERVER_NAME'];
		elseif (getenv('SERVER_NAME'))
			return getenv('SERVER_NAME');
		else
			return 'unknown';
	  	}
		
	function phpBBSecurity_ServerPort() 
		{
		if (intval($_SERVER['SERVER_PORT'])) 
			return $_SERVER['SERVER_PORT'];
		elseif (intval($_SERVER['SERVER_PORT']))
			return $_SERVER['SERVER_PORT'];
		elseif (getenv('SERVER_PORT'))
			return getenv('SERVER_PORT');
		else
			return 'unknown';
	  	}
		
	function phpBBSecurity_UserAgent() 
		{
		if (isset($_SERVER['HTTP_USER_AGENT'])) 
			return $_SERVER['HTTP_USER_AGENT'];
		elseif (isset($_SERVER['HTTP_USER_AGENT']))
			return $_SERVER['HTTP_USER_AGENT'];
		elseif (getenv('HTTP_USER_AGENT'))
			return getenv('HTTP_USER_AGENT');
		else
			return '';
	  	}
		
	function phpBBSecurity_Referer() 
		{
		if (isset($_SERVER['HTTP_REFERER'])) 
			return $_SERVER['HTTP_REFERER'];
		elseif (isset($_SERVER['HTTP_REFERER']))
			return $_SERVER['HTTP_REFERER'];
		elseif (getenv('HTTP_REFERER'))
			return getenv('HTTP_REFERER');
		else
			return '';
	  	}		

	function phpBBSecurity_ScriptName() 
		{
		if (isset($_SERVER['SCRIPT_NAME'])) 
			return $_SERVER['SCRIPT_NAME'];
		elseif (isset($_SERVER['SCRIPT_NAME']))
			return $_SERVER['SCRIPT_NAME'];
		elseif (getenv('SCRIPT_NAME'))
			return getenv('SCRIPT_NAME');
		else
			return '';
	  	}								
				
	function phpBBSecurity_Blocks()
		{
		#==== Added urldecode to checks, something i forgot to do, pointed out by Techie-Micheal.		
		global $board_config, $db;
		$error = '';
		$trick = '';
		
		#==== Passing Globals (Super Or Not) Or Functions
		$disallowed = array('$_REQUEST', '$HTTP_REQUEST_VARS', '$_SERVER', '$_SERVER', '$_COOKIE', '$_COOKIE', '$_ENV', '$_ENV', '$_FILES', '$HTTP_FILES_VARS', '$_GET', '$_GET', '$_POST', '$_POST', '$_SESSION', '$_SESSION', 'phpinfo()');
		$qstring	= phpBBSecurity_QueryString();
		for ($x = 0; $x < count($disallowed); $x++)
			{
			if (@strstr(strtolower($qstring), strtolower($disallowed[$x])))
				phpBBSecurity_Error('', '');
			}
		
		#==== Referer Check
		$disallowed_referers = '';
		$disallowed_referers = explode(',', $board_config['phpBBSecurity_disallowed_referers']);
		for ($x = 0; $x < count($disallowed_referers); $x++)
			{
			if (!$disallowed_referers[$x])
				break;
				
			if (stristr(phpBBSecurity_Referer(), $disallowed_referers[$x]))
				phpBBSecurity_Error('referer', 0);
			}
					
		#==== Agent Check
		$disallowed_agents = '';
		$disallowed_agents = explode(',', $board_config['phpBBSecurity_disallowed_agents']);
		for ($x = 0; $x < count($disallowed_agents); $x++)
			{
			if (!$disallowed_agents[$x])
				break;
				
			if (stristr(phpBBSecurity_UserAgent(), $disallowed_agents[$x]))
				phpBBSecurity_Error('agent', 0);
			}
		
		#==== Ban Check
		 #-> We have found, quite a few of us, that phpBB's ban system is weak. Instant bans are not always
		 #-> instant, sometimes they can roam the site for a bit before getting the ban message, etc..
		 #-> So lets fix that.
		$q = "SELECT *
			  FROM ". BANLIST_TABLE ."
			  WHERE ban_ip = '". encode_ip(phpBBSecurity_IP()) ."'";
		$r 		= $db->sql_query($q);
		$match 	= $db->sql_fetchrow($r);
		if ($match['ban_ip'])
			return phpBBSecurity_Error('banned', 0);
		 	
		#==== DDoS Prevention Help
		#==== Since i once made a DDoS attacker, and made prevention help for it, it helps here.
		#==== Max Protection
		if ($board_config['phpBBSecurity_DDoS_level'] == 1)
			{
			if ( phpBBSecurity_ServerPort() == 'unknown' || !is_numeric(phpBBSecurity_ServerPort()) || phpBBSecurity_ServerPort() == '' ||
				phpBBSecurity_ServerName() == 'unknown' || phpBBSecurity_ServerName() == '' || 
				phpBBSecurity_ScriptName() == '' || phpBBSecurity_UserAgent() == '' || phpBBSecurity_UserAgent() == '-'   
				&& ( phpBBSecurity_RequestMethod() == 'GET' || phpBBSecurity_RequestMethod() == 'POST') )
				$trick	= 4;
			}
		#==== Medium Protection
		if ($board_config['phpBBSecurity_DDoS_level'] == 2)
			{
			if (phpBBSecurity_ScriptName() == '' || phpBBSecurity_UserAgent() == '' || phpBBSecurity_UserAgent() == '-'   
				&& ( phpBBSecurity_RequestMethod() == 'GET' || phpBBSecurity_RequestMethod() == 'POST') )
				$trick	= 4;
			}
		#==== Low Protection
		if ($board_config['phpBBSecurity_DDoS_level'] == 2)
			{
			if (phpBBSecurity_UserAgent() == '' || phpBBSecurity_UserAgent() == '-'   
				&& ( phpBBSecurity_RequestMethod() == 'GET' || phpBBSecurity_RequestMethod() == 'POST') )
				$trick	= 4;
			}						
		
		#==== Encoded Characters Prvention
		if (stristr(phpBBSecurity_QueryString(),')%252echr('))
			$trick	= 7;
						
		#==== UNION Prevention Help	
		if (stristr(phpBBSecurity_QueryString(),'%20union%20') || 
			stristr(phpBBSecurity_QueryString(),'*/union/*') || 
			stristr(phpBBSecurity_QueryString(),' union ') || 
			stristr(urldecode(phpBBSecurity_QueryString()),'%20union%20') || 
			stristr(urldecode(phpBBSecurity_QueryString()),'*/union/*') || 
			stristr(urldecode(phpBBSecurity_QueryString()),' union ') || 			
			stristr(base64_decode(phpBBSecurity_QueryString()),'%20union%20') || 
			stristr(base64_decode(phpBBSecurity_QueryString()),'*/union/*') || 
			stristr(base64_decode(phpBBSecurity_QueryString()),' union '))
			$trick	= 2;
			
		#==== Clike Prevention Help
		if (stristr(phpBBSecurity_QueryString(),'/*') ||
			stristr(urldecode(phpBBSecurity_QueryString()),'/*') || 
			stristr(base64_decode(phpBBSecurity_QueryString()),'/*'))
			$trick	= 1;
			
		#==== SQL Injection Prevention Help
		if (phpBBSecurity_RequestMethod() == 'GET')
			{
			if (stristr(phpBBSecurity_QueryString(),'mysql_query(') || 
				stristr(urldecode(phpBBSecurity_QueryString()),'mysql_query(') || 
				stristr(base64_decode(phpBBSecurity_QueryString()),'mysql_query('))
			$trick	= 3;
			}
			
		#==== File Writing Prevention Help
		if (stristr(phpBBSecurity_QueryString(),'fwrite(') || 
			stristr(base64_decode(phpBBSecurity_QueryString()),'fwrite(') || 
			stristr(urldecode(phpBBSecurity_QueryString()),'fwrite(') || 
			stristr(phpBBSecurity_QueryString(),'fopen(') || 
			stristr(base64_decode(phpBBSecurity_QueryString()),'fopen(') || 
			stristr(urldecode(phpBBSecurity_QueryString()),'fopen('))
			$trick	= 5;
		
		#==== Perl Execution Prevention Help
		if (stristr(phpBBSecurity_QueryString(),'system(') || 
			stristr(base64_decode(phpBBSecurity_QueryString()),'system(') || 
			stristr(urldecode(phpBBSecurity_QueryString()),'system('))
			$trick = 6;		
			
		#==== CBACK Worm Prevention Help
		if (stristr(phpBBSecurity_QueryString(),'rush=echo%20_START_') || 
			stristr(base64_decode(phpBBSecurity_QueryString()),'rush=echo%20_START_') || 
			stristr(urldecode(phpBBSecurity_QueryString()),'rush=echo%20_START_') || 
			stristr(phpBBSecurity_QueryString(),'%20cd%20') || 
			stristr(base64_decode(phpBBSecurity_QueryString()),'%20cd%20') || 
			stristr(urldecode(phpBBSecurity_QueryString()),'%20cd%20') || 
			stristr(phpBBSecurity_QueryString(),'%20/tmp;wget%20') || 
			stristr(base64_decode(phpBBSecurity_QueryString()),'%20/tmp;wget%20') || 
			stristr(urldecode(phpBBSecurity_QueryString()),'%20/tmp;wget%20') || 
			stristr(phpBBSecurity_QueryString(),'/tmp;wget%20') || 
			stristr(base64_decode(phpBBSecurity_QueryString()),'/tmp;wget%20') || 
			stristr(urldecode(phpBBSecurity_QueryString()),'/tmp;wget%20') || 
			stristr(phpBBSecurity_QueryString(),'/tmp;wget') || 
			stristr(base64_decode(phpBBSecurity_QueryString()),'/tmp;wget') || 
			stristr(urldecode(phpBBSecurity_QueryString()),'/tmp;wget') || 
			stristr(phpBBSecurity_QueryString(),'%20/tmp;wget') || 
			stristr(base64_decode(phpBBSecurity_QueryString()),'%20/tmp;wget') || 
			stristr(urldecode(phpBBSecurity_QueryString()),'%20/tmp;wget') || 
			stristr(phpBBSecurity_QueryString(),';perl%20') || 
			stristr(base64_decode(phpBBSecurity_QueryString()),';perl%20') || 
			stristr(urldecode(phpBBSecurity_QueryString()),';perl%20') || 
			stristr(phpBBSecurity_QueryString(),';wget%20') || 
			stristr(base64_decode(phpBBSecurity_QueryString()),';wget%20') || 
			stristr(urldecode(phpBBSecurity_QueryString()),';wget%20') || 
			stristr(phpBBSecurity_QueryString(),'wget%20') || 
			stristr(base64_decode(phpBBSecurity_QueryString()),'wget%20') || 
			stristr(urldecode(phpBBSecurity_QueryString()),'wget%20') || 			
			stristr(phpBBSecurity_QueryString(),'%20echo%20_END_') || 
			stristr(base64_decode(phpBBSecurity_QueryString()),'%20echo%20_END_') || 
			stristr(urldecode(phpBBSecurity_QueryString()),'%20echo%20_END_'))
			$trick = 8;
							
		if ($trick)
			return $trick;
		}
		
	function phpBBSecurity_Admin($user_id, $locked_status, $reset_status)
		{
		global $db, $board_config;
		
		$q = "SELECT phpBBSecurity_login_tries
			  FROM ". USERS_TABLE ."
			  WHERE user_id = '$user_id'";
		$r 		= $db->sql_query($q);
		$row 	= $db->sql_fetchrow($r);
		$count 	= $row['phpBBSecurity_login_tries'];
		$max	= $board_config['phpBBSecurity_login_limit'];
		
		if ($locked_status)
			{
			if ($count >= $max)
				{
			$new_count 	= '0';
			$pm_sent	= '0';
				}
			else
				{
			$new_count 	= $max;
			$pm_sent	= '1';
				}
				
		$q = "UPDATE ". USERS_TABLE ."
			  SET phpBBSecurity_login_tries = '$new_count', phpBBSecurity_pm_sent = '$pm_sent'
			  WHERE user_id = '$user_id'";
		$db->sql_query($q);				
			}
			
		if ($reset_status)
			{
		$q = "UPDATE ". USERS_TABLE ."
			  SET phpBBSecurity_answer = '', phpBBSecurity_question = ''
			  WHERE user_id = '$user_id'";
		$db->sql_query($q);							
			}
		}
		
	function phpBBSecurity_PM($to, $from, $locked_id)
		{
		global $db, $phpbb_root_path, $phpEx, $lang, $user_ip, $board_config, $userdata;
		if ($board_config['phpBBSecurity_notify_admin_pm'])
			{
		$dest_user 	= intval($to);
		$msg_time 	= time();
		$from_id 	= intval($from);
		$subject 	= $lang['PS_pm_subject'];
		$subject2	= 'phpBB Security Alert';
		$msg_pass	= str_replace('%U%', $locked_id, $lang['PS_pm_message']);
		$message	= str_replace('%I%', phpBBSecurity_IP(), $msg_pass);
		$html_on 	= 1;
		$bbcode_on 	= 1;
		$smilies_on = 1;
	
		include_once($phpbb_root_path .'includes/functions_post.'. $phpEx);
		include_once($phpbb_root_path .'includes/bbcode.'. $phpEx);
	   
		$privmsg_subject 	= trim(strip_tags($subject));
		$bbcode_uid 		= make_bbcode_uid();
		$privmsg_message 	= trim(strip_tags($message));
	
			if ( defined('PRIVMSGA_TABLE'))
				{
			include_once($phpbb_root_path . 'includes/functions_messages.'.$phpEx);
			send_pm( 0 , '' , $dest_user , $privmsg_subject, $privmsg_message, '' );
				}
			else
				{
				$sql = "SELECT user_id, user_notify_pm, user_email, user_lang, user_active
						FROM ". USERS_TABLE ."
						WHERE user_id = '". $dest_user ."'";
				if (!($result = $db->sql_query($sql)))
					{
				$error = TRUE;
				$error_msg = $lang['No_such_user'];
					}
				$to_userdata = $db->sql_fetchrow($result);
		
				$sql = "SELECT COUNT(privmsgs_id) AS inbox_items, MIN(privmsgs_date) AS oldest_post_time
						FROM ". PRIVMSGS_TABLE ."
						WHERE ( privmsgs_type = ". PRIVMSGS_NEW_MAIL ."
						OR privmsgs_type = ". PRIVMSGS_READ_MAIL ." 
						OR privmsgs_type = ". PRIVMSGS_UNREAD_MAIL ." )
						AND privmsgs_to_userid = '". $dest_user ."'";
				if (!($result = $db->sql_query($sql)))
					message_die(GENERAL_MESSAGE, $lang['No_such_user']);
		
				$sql_priority = (SQL_LAYER == 'mysql') ? 'LOW_PRIORITY' : '';
		
				if($inbox_info = $db->sql_fetchrow($result))
					{
					if ($inbox_info['inbox_items'] >= $board_config['max_inbox_privmsgs'])
						{
						$sql = "SELECT privmsgs_id 
								FROM ". PRIVMSGS_TABLE ."
								WHERE ( privmsgs_type = ". PRIVMSGS_NEW_MAIL ."
								OR privmsgs_type = ". PRIVMSGS_READ_MAIL ."
								OR privmsgs_type = ". PRIVMSGS_UNREAD_MAIL ."  )
								AND privmsgs_date = ". $inbox_info['oldest_post_time'] . "
								AND privmsgs_to_userid = '". $dest_user ."'";
						if (!$result = $db->sql_query($sql))	
							message_die(GENERAL_ERROR, 'Could not find oldest privmsgs (inbox)', '', __LINE__, __FILE__, $sql);
						
						$old_privmsgs_id = $db->sql_fetchrow($result);
						$old_privmsgs_id = $old_privmsgs_id['privmsgs_id'];
				   
						$sql = "DELETE $sql_priority 
								FROM ". PRIVMSGS_TABLE ."
								WHERE privmsgs_id = '". $old_privmsgs_id ."'";
						if (!$db->sql_query($sql))
							message_die(GENERAL_ERROR, 'Could not delete oldest privmsgs (inbox)'.$sql, '', __LINE__, __FILE__, $sql);
		
						$sql = "DELETE $sql_priority 
								FROM " . PRIVMSGS_TEXT_TABLE . "
								WHERE privmsgs_text_id = '". $old_privmsgs_id ."'";
						if (!$db->sql_query($sql))
							message_die(GENERAL_ERROR, 'Could not delete oldest privmsgs text (inbox)', '', __LINE__, __FILE__, $sql);
						}
					}
		
				$sql_info = "INSERT INTO ". PRIVMSGS_TABLE ." 
							(privmsgs_type, privmsgs_subject, privmsgs_from_userid, privmsgs_to_userid, privmsgs_date, privmsgs_ip, privmsgs_enable_html, privmsgs_enable_bbcode, privmsgs_enable_smilies)
							VALUES ( 1 , '". str_replace("\'", "''", addslashes($privmsg_subject)) ."' , '". $from_id ."', '". $to_userdata['user_id'] ."', $msg_time, '$user_ip' , $html_on, $bbcode_on, $smilies_on)";
				if (!$db->sql_query($sql_info))
					message_die(GENERAL_ERROR, 'Could not delete oldest privmsgs text (inbox)', '', __LINE__, __FILE__, $sql_info);
		
				$privmsg_sent_id = $db->sql_nextid();
		
				$sql = "INSERT INTO ". PRIVMSGS_TEXT_TABLE ." (privmsgs_text_id, privmsgs_bbcode_uid, privmsgs_text)
						VALUES ($privmsg_sent_id, '" . $bbcode_uid . "', '" . str_replace("\'", "''", addslashes($privmsg_message)) . "')"; 
				if (!$db->sql_query($sql, END_TRANSACTION))
					message_die(GENERAL_ERROR, "Could not insert/update private message sent text.", "", __LINE__, __FILE__, $sql);
		
				$sql = "UPDATE ". USERS_TABLE ."
						SET user_new_privmsg = user_new_privmsg + 1, user_last_privmsg = " . time() . " 
						WHERE user_id = '". $to_userdata['user_id'] ."'";
				if (!$status = $db->sql_query($sql))
					message_die(GENERAL_ERROR, 'Could not update private message new/read status for user', '', __LINE__, __FILE__, $sql);
				}
			phpBBSecurity_SetPM($dest_user);
			}
			
		if ($board_config['phpBBSecurity_notify_admin_em'])
			{
		$dest_user = intval($to); 
       
		$sql = "SELECT user_id, user_notify_pm, user_email, user_lang, user_active 
				FROM ". USERS_TABLE ." 
				WHERE user_id = '". $dest_user ."'"; 
			if (!($result = $db->sql_query($sql))) 
				message_die(GENERAL_MESSAGE, $lang['No_such_user']);
				
		$to_userdata 		= $db->sql_fetchrow($result); 			
		$script_name 		= preg_replace('/^\/?(.*?)\/?$/', "\\1", trim($board_config['script_path']));
		$script_name 		= ( $script_name != '' ) ? $script_name . '/privmsg.'.$phpEx : 'privmsg.'.$phpEx;
		$server_name 		= trim($board_config['server_name']);
		$server_protocol 	= ( $board_config['cookie_secure'] ) ? 'https://' : 'http://';
		$server_port 		= ( $board_config['server_port'] <> 80 ) ? ':' . trim($board_config['server_port']) . '/' : '/';

		include_once($phpbb_root_path . './includes/emailer.'.$phpEx);
		$emailer 		= new emailer($board_config['smtp_delivery']);
		$email_headers 	= 'From: ' . $board_config['board_email'] . "\nReturn-Path: " . $board_config['board_email'] . "\n\n\n$message\n\n";
		$emailer->extra_headers($email_headers);
		$emailer->email_address($to_userdata['user_email']);
		$emailer->set_subject($subject2);
		
			$emailer->assign_vars(array(
			'USERNAME' 	=> $to_userdata['username'],
			'SITENAME' 	=> $board_config['sitename'],
			'EMAIL_SIG' => (!empty($board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']) : '',
			'U_INBOX' 	=> $server_protocol . $server_name . $server_port . $script_name . '?folder=inbox')
				);
			
		$emailer->send();
		$emailer->reset();
		phpBBSecurity_SetPM($dest_user);
			}		
		}
	
	function phpBBSecurity_Ban($ip, $on, $reason)
		{
		global $db, $board_config;
		
		$auto_ban 	= '';
		$ignored 	= '';
		$just_block = '';
		
		#==== Make sure what they did is not being ignored by the script		
		if ( ($reason == 1) && ($board_config['phpBBSecurity_Clike_Ban'] == 0) )
			$ignored = TRUE;			
		if ( ($reason == 2) && ($board_config['phpBBSecurity_Union_Ban'] == 0) )
			$ignored = TRUE;			
		if ( ($reason == 3) && ($board_config['phpBBSecurity_SQL_Ban'] == 0) )
			$ignored = TRUE;			
		if ( ($reason == 4) && ($board_config['phpBBSecurity_DDoS_Ban'] == 0) )
			$ignored = TRUE;			
		if ( ($reason == 5) && ($board_config['phpBBSecurity_File_Ban'] == 0) )
			$ignored = TRUE;			
		if ( ($reason == 6) && ($board_config['phpBBSecurity_Perl_Ban'] == 0) )
			$ignored = TRUE;			
		if ( ($reason == 7) && ($board_config['phpBBSecurity_Encoded_Ban'] == 0) )
			$ignored = TRUE;
		if ( ($reason == 8) && ($board_config['phpBBSecurity_Cback_Ban'] == 0) )
			$ignored = TRUE;
					
		#==== If the script is set to just block it, then we can do that here.		
		if ( ($reason == 1) && ($board_config['phpBBSecurity_Clike_Ban'] == 2) )
			$just_block = TRUE;			
		if ( ($reason == 2) && ($board_config['phpBBSecurity_Union_Ban'] == 2) )
			$just_block = TRUE;			
		if ( ($reason == 3) && ($board_config['phpBBSecurity_SQL_Ban'] == 2) )
			$just_block = TRUE;			
		if ( ($reason == 4) && ($board_config['phpBBSecurity_DDoS_Ban'] == 2) )
			$just_block = TRUE;			
		if ( ($reason == 5) && ($board_config['phpBBSecurity_File_Ban'] == 2) )
			$just_block = TRUE;			
		if ( ($reason == 6) && ($board_config['phpBBSecurity_Perl_Ban'] == 2) )
			$just_block = TRUE;			
		if ( ($reason == 7) && ($board_config['phpBBSecurity_Encoded_Ban'] == 2) )
			$just_block = TRUE;
		if ( ($reason == 8) && ($board_config['phpBBSecurity_Cback_Ban'] == 2) )
			$just_block = TRUE;

		#==== Make sure they have auto-ban on before sending the ban SQL
		if ( ($reason == 1) && ($board_config['phpBBSecurity_Clike_Ban'] == 1) )
			$auto_ban = TRUE;			
		if ( ($reason == 2) && ($board_config['phpBBSecurity_Union_Ban'] == 1) )
			$auto_ban = TRUE;			
		if ( ($reason == 3) && ($board_config['phpBBSecurity_SQL_Ban'] == 1) )
			$auto_ban = TRUE;			
		if ( ($reason == 4) && ($board_config['phpBBSecurity_DDoS_Ban'] == 1) )
			$auto_ban = TRUE;			
		if ( ($reason == 5) && ($board_config['phpBBSecurity_File_Ban'] == 1) )
			$auto_ban = TRUE;			
		if ( ($reason == 6) && ($board_config['phpBBSecurity_Perl_Ban'] == 1) )
			$auto_ban = TRUE;			
		if ( ($reason == 7) && ($board_config['phpBBSecurity_Encoded_Ban'] == 1) )
			$auto_ban = TRUE;			
		if ( ($reason == 8) && ($board_config['phpBBSecurity_Cback_Ban'] == 1) )
			$auto_ban = TRUE;
		
		#==== If Ignoring It, End The Function
		if ($ignored)
			return;
				
		#==== If Just Blocking It, Process It
		if ($just_block)
			{
			if ($reason == 1)		
				phpBBSecurity_Error('clike', 1);
			if ($reason == 2)		
				phpBBSecurity_Error('union', 1);
			if ($reason == 3)		
				phpBBSecurity_Error('sql', 1);
			if ($reason == 4)		
				phpBBSecurity_Error('ddos', 1);
			if ($reason == 5)		
				phpBBSecurity_Error('fwrite', 1);
			if ($reason == 6)		
				phpBBSecurity_Error('perl', 1);
			if ($reason == 7)		
				phpBBSecurity_Error('encoded', 1);
			if ($reason == 8)		
				phpBBSecurity_Error('cback', 1);																												
			}
				
		#==== If We Got This Far, We Are Banning Someone :>				
		$q = "SELECT ban_id
			  FROM ". BANLIST_TABLE ."
			  WHERE ban_ip = '". encode_ip($ip) ."'";
		$r 		= $db->sql_query($q);
		$row 	= $db->sql_fetchrow($r);																					
			
		if ( ($on || $auto_ban) && (!$ignored) && (!$just_block) )
			{				
			if (!$row['ban_id'])
				{
				if ($ip != 'unknown')
					{
				$q = "INSERT INTO ". BANLIST_TABLE ."
					  (ban_ip) VALUES ('". encode_ip($ip) ."')";
				$db->sql_query($q);
				
				$q = "DELETE FROM ". SESSIONS_TABLE ."
					  WHERE session_ip = '". encode_ip($ip) ."'";
				$db->sql_query($q);				
					}
				}
		phpBBSecurity_BanTwo($ip, $reason);				
			}
		}
		
	function phpBBSecurity_BanTwo($ip, $reason)
		{
	global $db, $phpbb_root_path, $board_config, $phpEx, $lang;
	$trick = '';
	
		if ($reason == '1')
			$trick = $lang['PS_clike'];
		if ($reason == '2')
			$trick = $lang['PS_union'];
		if ($reason == '3')
			$trick = $lang['PS_sql'];
		if ($reason == '4')
			$trick = $lang['PS_ddos'];
		if ($reason == '5')
			$trick = $lang['PS_fopen_fwrite'];			
		if ($reason == '6')
			$trick = $lang['PS_system'];
		if ($reason == '7')
			$trick = $lang['PS_chr'];
		if ($reason == '8')
			$trick = $lang['PS_cback'];					

		$q = "SELECT *
			  FROM ". PHPBB_SECURITY ."
			  WHERE ban_ip = '". encode_ip($ip) ."'";
		$r 		= $db->sql_query($q);
		$row 	= $db->sql_fetchrow($r);	
		
		if ($row['ban_id'])
			{
		$q = "UPDATE ". PHPBB_SECURITY ."
			  SET ban_attempts = ban_attempts + 1
			  WHERE ban_id = '". $row['ban_id'] ."'";
		$db->sql_query($q);				
			}
		else
			{
		$q = "INSERT INTO ". PHPBB_SECURITY ."
			  VALUES ('', '". encode_ip($ip) ."', '". $trick ."', '". time() ."', '0', '". $_SERVER['PHP_SELF'] . '?' . phpBBSecurity_QueryString() ."')";
		$db->sql_query($q);	
			}
			
		if ($reason == 1)		
			phpBBSecurity_Error('clike', 1);
		if ($reason == 2)		
			phpBBSecurity_Error('union', 1);
		if ($reason == 3)		
			phpBBSecurity_Error('sql', 1);
		if ($reason == 4)		
			phpBBSecurity_Error('ddos', 1);
		if ($reason == 5)		
			phpBBSecurity_Error('fwrite', 1);
		if ($reason == 6)		
			phpBBSecurity_Error('perl', 1);
		if ($reason == 7)		
			phpBBSecurity_Error('encoded', 1);
		if ($reason == 8)		
			phpBBSecurity_Error('cback', 1);			
		}
		
	function phpBBSecurity_MaxSessions($count)
		{
		global $db;
		
		$q = "SELECT session_id
			  FROM ". SESSIONS_TABLE ."
			  WHERE session_user_id <> '". ANONYMOUS ."'";
		$r 		= $db->sql_query($q);
		$amount = $db->sql_numrows($r);
		
		#==== We are deleting user sessions because of mods such as users
		#==== of the day, if guests get deleted, these mods wont work right
		#==== & new users cant register!
		if ($amount >= $count)
			{
		$q = "DELETE FROM ". SESSIONS_TABLE ."
			  WHERE session_user_id <> '". ANONYMOUS ."'";
		$db->sql_query($q);
			}
		}
				
	function phpBBSecurity_Caught($start, $stop)
		{
		global $db;
		$start = (intval($start) > 0) ? intval($start) : 0;
		
		$q = "SELECT *
			  FROM ". PHPBB_SECURITY ."
			  LIMIT $start, $stop";
		$r 				= $db->sql_query($q);
		$caught_info 	= $db->sql_fetchrowset($r);
		
		return $caught_info;
		}
		
	function phpBBSecurity_Total()
		{
		global $db;
		
		$q = "SELECT *
			  FROM ". PHPBB_SECURITY ."";
		$r 				= $db->sql_query($q);
		$caught_count 	= $db->sql_numrows($r);
		
		return $caught_count;
		}				
		
	function phpBBSecurity_OldestAdmin()
		{
		global $db;
		
		$q = "SELECT user_id
			  FROM ". USERS_TABLE ."
			  WHERE user_level = ". ADMIN ."
			  AND user_id > '0'
			  ORDER BY user_id ASC
			  LIMIT 1";
		$r 		= $db->sql_query($q);
		$row 	= $db->sql_fetchrow($r);
		
		return $row['user_id'];
		}
		
	function phpBBSecurity_Elimination($max_admins, $max_mods, $id)
		{
		global $db, $board_config;
		
		if ($board_config[phpBBSecurity_UseSpecial()])
			{
		$q = "SELECT *
			  FROM ". USERS_TABLE ."
			  WHERE user_level = '". ADMIN ."'
			  ORDER BY user_id ASC";
		$r 		= $db->sql_query($q);
		$row 	= $db->sql_fetchrowset($r);
			
			for ($a = 0; $a < count($row); $a++)
				{
				if ($row[$a]['user_id'] <= '0') 
					{
				return phpBBSecurity_Error('staff', 1);
				break;				
					}
					
				if ( ($row[$a]['user_level'] == ADMIN) && ($a >= $max_admins) && ($row[$a]['user_id'] == $id) )
					{
				return phpBBSecurity_Error('staff', 1);
				break;
					}
				}
				
		$q = "SELECT *
			  FROM ". USERS_TABLE ."
			  WHERE user_level = '". MOD ."'
			  ORDER BY user_id ASC";
		$r 		= $db->sql_query($q);
		$row 	= $db->sql_fetchrowset($r);
			
			for ($a = 0; $a < count($row); $a++)
				{
				if ($row[$a]['user_id'] <= '0') 
					{
				return phpBBSecurity_Error('staff', 1);
				break;				
					}
								
				if ( ($row[$a]['user_level'] == MOD) && ($a >= $max_mods) && ($row[$a]['user_id'] == $id) )
					{
				return phpBBSecurity_Error('staff', 1);
				break;
					}
				}
			}					
		}
		
	function phpBBSecurity_SpecialCount()
		{
		global $db;
		
		$q = "SELECT user_id
			  FROM ". USERS_TABLE ."
			  WHERE user_level = '". MOD ."'";
		$r 		= $db->sql_query($q);
		$mod 	= $db->sql_numrows($r);
		
		$q = "SELECT user_id
			  FROM ". USERS_TABLE ."
			  WHERE user_level = '". ADMIN ."'";
		$r 		= $db->sql_query($q);
		$admin 	= $db->sql_numrows($r);
						
		return ($admin .'%SPLIT%'. $mod);
		}
		
	function phpBBSecurity_UpdateSpecial($admins, $mods, $enable, $ddos, $clike, $cback, $chr, $sql_inj, $perl, $union, $file)
		{
		global $db;

		$q = "UPDATE ". CONFIG_TABLE ."
			  SET config_value = '". $ddos ."'
			  WHERE config_name = 'phpBBSecurity_DDoS_Ban'";
		$db->sql_query($q);
		
		$q = "UPDATE ". CONFIG_TABLE ."
			  SET config_value = '". $clike ."'
			  WHERE config_name = 'phpBBSecurity_Clike_Ban'";
		$db->sql_query($q);
		
		$q = "UPDATE ". CONFIG_TABLE ."
			  SET config_value = '". $cback ."'
			  WHERE config_name = 'phpBBSecurity_Cback_Ban'";
		$db->sql_query($q);
		
		$q = "UPDATE ". CONFIG_TABLE ."
			  SET config_value = '". $chr ."'
			  WHERE config_name = 'phpBBSecurity_Encoded_Ban'";
		$db->sql_query($q);
		
		$q = "UPDATE ". CONFIG_TABLE ."
			  SET config_value = '". $sql_inj ."'
			  WHERE config_name = 'phpBBSecurity_SQL_Ban'";
		$db->sql_query($q);
		
		$q = "UPDATE ". CONFIG_TABLE ."
			  SET config_value = '". $perl ."'
			  WHERE config_name = 'phpBBSecurity_Perl_Ban'";
		$db->sql_query($q);
		
		$q = "UPDATE ". CONFIG_TABLE ."
			  SET config_value = '". $union ."'
			  WHERE config_name = 'phpBBSecurity_Union_Ban'";
		$db->sql_query($q);
		
		$q = "UPDATE ". CONFIG_TABLE ."
			  SET config_value = '". $file ."'
			  WHERE config_name = 'phpBBSecurity_File_Ban'";
		$db->sql_query($q);														
		
		$q = "UPDATE ". CONFIG_TABLE ."
			  SET config_value = '". $enable ."'
			  WHERE config_name = '". phpBBSecurity_UseSpecial() ."'";
		$db->sql_query($q);
				
		$q = "UPDATE ". CONFIG_TABLE ."
			  SET config_value = '". $admins ."'
			  WHERE config_name = '". phpBBSecurity_AdminConfigName() ."'";
		$db->sql_query($q);
		
		$q = "UPDATE ". CONFIG_TABLE ."
			  SET config_value = '". $mods ."'
			  WHERE config_name = '". phpBBSecurity_ModConfigName() ."'";
		$db->sql_query($q);		
		}
	
	function phpBBSecurity_FinalSet()
		{
		global $userdata;
	#==== Make sure everything stays as it should no matter what
	if ($userdata['user_id'] == ANONYMOUS)
		$userdata['user_id'] = ANONYMOUS;
	if ($userdata['user_level'] == USER)
		$userdata['user_level'] = USER;
	if ($userdata['user_level'] == MOD)
		$userdata['user_level'] = MOD;
	if ($userdata['user_level'] == ADMIN)
		$userdata['user_level'] = ADMIN;
		}
		
	function phpBBSecurity_DBBackup()
		{
	global $board_config, $phpbb_root_path, $phpEx;
	global $db, $lang, $user_ip, $userdata;
	include($phpbb_root_path .'config.'. $phpEx);
		
		$today 			= date('d');
		$last_backup 	= $board_config['phpBBSecurity_last_backup_date'];
		$backup_time 	= $board_config['phpBBSecurity_backup_time'];
		$use_backup 	= $board_config['phpBBSecurity_backup_on'];
		$backup_folder	= $board_config['phpBBSecurity_backup_folder'];
		$backup_file 	= $board_config['phpBBSecurity_backup_filename'];
		
		if ($use_backup)
			{
			if ( ($last_backup != $today) && (date('H') >= $backup_time) )
				{				
			system("/usr/bin/mysqldump -u". $dbuser ." -p". $dbpasswd ." -h ". $dbhost ." ". $dbname ." > ". (($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : $_SERVER['DOCUMENT_ROOT']) . $board_config['script_path'] . $backup_folder ."/". $backup_file  ."-". date('Y-m-d') .".sql", $fp);
			
				if ($fp == 0)
					$msg = 'Your Daily Database Backup Was Completed.';
				else
					$msg = 'Your Daily Database Backup Failed.';
			
			$q = "UPDATE ". CONFIG_TABLE ."
				  SET config_value = '". date('d') ."'
				  WHERE config_name = 'phpBBSecurity_last_backup_date'";
			$db->sql_query($q);
			
			$dest_user 	= intval(phpBBSecurity_OldestAdmin());
			$msg_time 	= time();
			$from_id 	= intval(phpBBSecurity_OldestAdmin());
			$subject 	= 'phpBB Security Update';
			$message	= $msg;
			$html_on 	= 1;
			$bbcode_on 	= 1;
			$smilies_on = 1;
		
			include_once($phpbb_root_path .'includes/functions_post.'. $phpEx);
			include_once($phpbb_root_path .'includes/bbcode.'. $phpEx);
		   
			$privmsg_subject 	= trim(strip_tags($subject));
			$bbcode_uid 		= make_bbcode_uid();
			$privmsg_message 	= trim(strip_tags($message));
		
				if ( defined('PRIVMSGA_TABLE'))
					{
				include_once($phpbb_root_path . 'includes/functions_messages.'.$phpEx);
				send_pm( 0 , '' , $dest_user , $privmsg_subject, $privmsg_message, '' );
					}
				else
					{
					$sql = "SELECT user_id, user_notify_pm, user_email, user_lang, user_active
							FROM ". USERS_TABLE ."
							WHERE user_id = '". $dest_user ."'";
					$result = $db->sql_query($sql);
					$to_userdata = $db->sql_fetchrow($result);
			
					$sql = "SELECT COUNT(privmsgs_id) AS inbox_items, MIN(privmsgs_date) AS oldest_post_time
							FROM ". PRIVMSGS_TABLE ."
							WHERE ( privmsgs_type = ". PRIVMSGS_NEW_MAIL ."
							OR privmsgs_type = ". PRIVMSGS_READ_MAIL ." 
							OR privmsgs_type = ". PRIVMSGS_UNREAD_MAIL ." )
							AND privmsgs_to_userid = '". $dest_user ."'";
					$result = $db->sql_query($sql);
			
					$sql_priority = (SQL_LAYER == 'mysql') ? 'LOW_PRIORITY' : '';
			
					if($inbox_info = $db->sql_fetchrow($result))
						{
						if ($inbox_info['inbox_items'] >= $board_config['max_inbox_privmsgs'])
							{
							$sql = "SELECT privmsgs_id 
									FROM ". PRIVMSGS_TABLE ."
									WHERE ( privmsgs_type = ". PRIVMSGS_NEW_MAIL ."
									OR privmsgs_type = ". PRIVMSGS_READ_MAIL ."
									OR privmsgs_type = ". PRIVMSGS_UNREAD_MAIL ."  )
									AND privmsgs_date = ". $inbox_info['oldest_post_time'] . "
									AND privmsgs_to_userid = '". $dest_user ."'";
							if (!$result = $db->sql_query($sql))	
								message_die(GENERAL_ERROR, 'Could not find oldest privmsgs (inbox)', '', __LINE__, __FILE__, $sql);
							
							$old_privmsgs_id = $db->sql_fetchrow($result);
							$old_privmsgs_id = $old_privmsgs_id['privmsgs_id'];
					   
							$sql = "DELETE $sql_priority 
									FROM ". PRIVMSGS_TABLE ."
									WHERE privmsgs_id = '". $old_privmsgs_id ."'";
							if (!$db->sql_query($sql))
								message_die(GENERAL_ERROR, 'Could not delete oldest privmsgs (inbox)'.$sql, '', __LINE__, __FILE__, $sql);
			
							$sql = "DELETE $sql_priority 
									FROM " . PRIVMSGS_TEXT_TABLE . "
									WHERE privmsgs_text_id = '". $old_privmsgs_id ."'";
							if (!$db->sql_query($sql))
								message_die(GENERAL_ERROR, 'Could not delete oldest privmsgs text (inbox)', '', __LINE__, __FILE__, $sql);
							}
						}
			
					$sql_info = "INSERT INTO ". PRIVMSGS_TABLE ." 
								(privmsgs_type, privmsgs_subject, privmsgs_from_userid, privmsgs_to_userid, privmsgs_date, privmsgs_ip, privmsgs_enable_html, privmsgs_enable_bbcode, privmsgs_enable_smilies)
								VALUES ( 1 , '". str_replace("\'", "''", addslashes($privmsg_subject)) ."' , '". $from_id ."', '". $to_userdata['user_id'] ."', $msg_time, '$user_ip' , $html_on, $bbcode_on, $smilies_on)";
					if (!$db->sql_query($sql_info))
						message_die(GENERAL_ERROR, 'Could not delete oldest privmsgs text (inbox)', '', __LINE__, __FILE__, $sql_info);
			
					$privmsg_sent_id = $db->sql_nextid();
			
					$sql = "INSERT INTO ". PRIVMSGS_TEXT_TABLE ." (privmsgs_text_id, privmsgs_bbcode_uid, privmsgs_text)
							VALUES ($privmsg_sent_id, '" . $bbcode_uid . "', '" . str_replace("\'", "''", addslashes($privmsg_message)) . "')"; 
					if (!$db->sql_query($sql, END_TRANSACTION))
						message_die(GENERAL_ERROR, "Could not insert/update private message sent text.", "", __LINE__, __FILE__, $sql);
			
					$sql = "UPDATE ". USERS_TABLE ."
							SET user_new_privmsg = user_new_privmsg + 1, user_last_privmsg = " . time() . " 
							WHERE user_id = '". $to_userdata['user_id'] ."'";
					if (!$status = $db->sql_query($sql))
						message_die(GENERAL_ERROR, 'Could not update private message new/read status for user', '', __LINE__, __FILE__, $sql);
					}					
				}
			}
		else
			return;
		}
		
	function phpBBSecurity_Guests()
		{
	global $db, $board_config;
	
		if ($board_config['phpBBSecurity_guest_matches'] > 0)
			{
		$q = "SELECT count(session_id) AS total, session_ip
			  FROM ". SESSIONS_TABLE ." 
			  WHERE session_user_id = '". ANONYMOUS ."'
			  GROUP BY session_ip
			  ORDER BY total DESC";
		$r = $db->sql_query($q);
		$rows = $db->sql_fetchrowset($r);
		
			for ($x = 0; $x < count($rows); $x++)
				{
				if (!$rows[$x])
					break;
					
				if ($rows[$x]['total'] > $board_config['phpBBSecurity_guest_matches'])
					{
				$q = "DELETE FROM ". SESSIONS_TABLE ."
					  WHERE session_ip = '". $rows[$x]['session_ip'] ."'
					  AND session_user_id = '". ANONYMOUS ."'";
				$db->sql_query($q);
					}
				}
			}
		}
?>