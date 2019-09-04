<?php
/***************************************************************************
 *                                common.php
 *                            -------------------
 *   begin                : Saturday, Feb 23, 2001
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
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

// Page generation time
$starttime = 0;
$mtime = microtime();
$mtime = explode(" ",$mtime);
$mtime = $mtime[1] + $mtime[0];
$starttime = $mtime;

error_reporting(E_ERROR | E_WARNING | E_PARSE); // This will NOT report uninitialized variables
if (function_exists('set_magic_quotes_runtime'))
{
  @set_magic_quotes_runtime(0); // Disable magic_quotes_runtime
}
date_default_timezone_set(@date_default_timezone_get());

// The following code (unsetting globals)
// Thanks to Matt Kavanagh and Stefan Esser for providing feedback as well as patch files

// PHP5 with register_long_arrays off?
if (@phpversion() >= '5.0.0' && (!@ini_get('register_long_arrays') || @ini_get('register_long_arrays') == '0' || strtolower(@ini_get('register_long_arrays')) == 'off'))
{
	$HTTP_POST_VARS = $_POST;
	$HTTP_GET_VARS = $_GET;
	$HTTP_SERVER_VARS = $_SERVER;
	$HTTP_COOKIE_VARS = $_COOKIE;
	$HTTP_ENV_VARS = $_ENV;
	$HTTP_FILES_VARS = $_FILES;

	// _SESSION is the only superglobal which is conditionally set
	if (isset($_SESSION))
	{
		$HTTP_SESSION_VARS = $_SESSION;
	}
}

// CrackerTracker v5.x
include($phpbb_root_path . 'ctracker/engines/ct_security.' . $phpEx);

// Protect against GLOBALS tricks
if (isset($_POST['GLOBALS']) || isset($_FILES['GLOBALS']) || isset($_GET['GLOBALS']) || isset($_COOKIE['GLOBALS']))
{
	die("Hacking attempt");
}

// Protect against HTTP_SESSION_VARS tricks
if (isset($_SESSION) && !is_array($_SESSION))
{
	die("Hacking attempt");
}

if (@ini_get('register_globals') == '1' || strtolower(@ini_get('register_globals')) == 'on')
{
   // PHP4+ path
   
   	$not_unset = array('HTTP_GET_VARS', 'HTTP_POST_VARS', 'HTTP_COOKIE_VARS', 'HTTP_SERVER_VARS', 'HTTP_SESSION_VARS', 'HTTP_ENV_VARS', 'HTTP_POST_FILES', 'phpEx', 'phpbb_root_path');
   
   // Not only will array_merge give a warning if a parameter
   // is not an array, it will actually fail. So we check if
   // HTTP_SESSION_VARS has been initialised.
	if (!isset($_SESSION) || !is_array($_SESSION))
	{
		$_SESSION = array();
	}

	// Merge all into one extremely huge array; unset
	// this later
	$input = array_merge($_GET, $_POST, $_COOKIE, $_SERVER, $_SESSION, $_ENV, $_FILES);

	unset($input['input']);
	unset($input['not_unset']);

	while (list($var,) = @each($input))
	{
		if (in_array($var, $not_unset))
		{
			die('Hacking attempt!');
		}
		unset($$var);
	}

	unset($input);
}

//
// addslashes to vars if magic_quotes_gpc is off
// this is a security precaution to prevent someone
// trying to break out of a SQL statement.
//
if( !get_magic_quotes_gpc() )
{
	if( is_array($_GET) )
	{
		while( list($k, $v) = each($_GET) )
		{
			if( is_array($_GET[$k]) )
			{
				while( list($k2, $v2) = each($_GET[$k]) )
				{
					$_GET[$k][$k2] = addslashes($v2);
				}
				@reset($_GET[$k]);
			}
			else
			{
				$_GET[$k] = addslashes($v);
			}
		}
		@reset($_GET);
	}

	if( is_array($_POST) )
	{
		while( list($k, $v) = each($_POST) )
		{
			if( is_array($_POST[$k]) )
			{
				while( list($k2, $v2) = each($_POST[$k]) )
				{
					$_POST[$k][$k2] = addslashes($v2);
				}
				@reset($_POST[$k]);
			}
			else
			{
				$_POST[$k] = addslashes($v);
			}
		}
		@reset($_POST);
	}

	if( is_array($_COOKIE) )
	{
		while( list($k, $v) = each($_COOKIE) )
		{
			if( is_array($_COOKIE[$k]) )
			{
				while( list($k2, $v2) = each($_COOKIE[$k]) )
				{
					$_COOKIE[$k][$k2] = addslashes($v2);
				}
				@reset($_COOKIE[$k]);
			}
			else
			{
				$_COOKIE[$k] = addslashes($v);
			}
		}
		@reset($_COOKIE);
	}
}

//
// Define some basic configuration arrays this also prevents
// malicious rewriting of language and otherarray values via
// URI params
//
$board_config = array();
$userdata = array();
$theme = array();
$images = array();
$current_template_path = '';
$lang = array();
$nav_links = array();
$dss_seeded = false;
$gen_simple_header = FALSE;

include($phpbb_root_path . 'config.'.$phpEx);

if( !defined("PHPBB_INSTALLED") )
{
	header('Location: ' . $phpbb_root_path . 'install/chmod.' . $phpEx);
	exit;
}

include($phpbb_root_path . 'includes/constants.'.$phpEx);
include($phpbb_root_path . 'includes/template.'.$phpEx);
include($phpbb_root_path . 'includes/sessions.'.$phpEx);
include($phpbb_root_path . 'includes/auth.'.$phpEx);
include($phpbb_root_path . 'includes/functions.'.$phpEx);
include($phpbb_root_path . 'includes/db.'.$phpEx);
if ( defined('IN_CASHMOD') )
{
	include($phpbb_root_path . 'includes/functions_cash.'.$phpEx);
}
// We do not need this any longer, unset for safety purposes
unset($dbpasswd);

//
// Obtain and encode users IP
//
//if( getenv('HTTP_X_FORWARDED_FOR') != '' )
//{
//	$client_ip = ( !empty($_SERVER['REMOTE_ADDR']) ) ? $_SERVER['REMOTE_ADDR'] : ( ( !empty($_ENV['REMOTE_ADDR']) ) ? $_ENV['REMOTE_ADDR'] : $REMOTE_ADDR );
//
//	$entries = explode(',', getenv('HTTP_X_FORWARDED_FOR'));
//	reset($entries);
//	while (list(, $entry) = each($entries)) 
//	{
//		$entry = trim($entry);
//		if ( preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $entry, $ip_list) )
//		{
//			$private_ip = array('/^0\./', '/^127\.0\.0\.1/', '/^192\.168\..*/', '/^172\.((1[6-9])|(2[0-9])|(3[0-1]))\..*/', '/^10\..*/', '/^224\..*/', '/^240\..*/');
//			$found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);
//
//			if ($client_ip != $found_ip)
//			{
//				$client_ip = $found_ip;
//				break;
//			}
//		}
//	}
//}
//else
//{
//	$client_ip = ( !empty($_SERVER['REMOTE_ADDR']) ) ? $_SERVER['REMOTE_ADDR'] : ( ( !empty($_ENV['REMOTE_ADDR']) ) ? $_ENV['REMOTE_ADDR'] : $REMOTE_ADDR );
//}
$client_ip = ( !empty($_SERVER['REMOTE_ADDR']) ) ? $_SERVER['REMOTE_ADDR'] : ( ( !empty($_ENV['REMOTE_ADDR']) ) ? $_ENV['REMOTE_ADDR'] : $REMOTE_ADDR );
$user_ip = encode_ip($client_ip);

// CrackerTracker v5.x
include($phpbb_root_path . 'ctracker/engines/ct_varsetter.' . $phpEx);
include($phpbb_root_path . 'ctracker/engines/ct_ipblocker.' . $phpEx);

//
// Setup forum wide options, if this fails
// then we output a CRITICAL_ERROR since
// basic forum information is not available
//
$sql = "SELECT *
	FROM " . CONFIG_TABLE;
if( !($result = $db->sql_query($sql, false, 'board_config')) )
{
	message_die(CRITICAL_ERROR, "Could not query config information", "", __LINE__, __FILE__, $sql);
}

while ( $row = $db->sql_fetchrow($result) )
{
	$board_config[$row['config_name']] = $row['config_value'];
}
$db->sql_freeresult($result);
if ($board_config['summer_time'] != date('I') && $board_config['summer_time_auto']) 
{ 
	$board_config['summer_time'] = date('I'); 
} 

// Auto lang mod start
// If someone spoofs the language setting, then init_userprefs() will use the default language, as the spoofed result can't be found
$language = '';
$supported_languages = array();
$accept_language = strtolower (getenv ('HTTP_ACCEPT_LANGUAGE'));
if (!empty ($accept_language))
{
	reset ($board_config);
	$needle = 'auto_lang_';
	$needle_length = strlen($needle);
	while (list ($key, $value) = each ($board_config))
	{
		if ((strstr($key, $needle)))
		{
			$supported_languages[substr ($key, $needle_length)] = $value;
		}
	}
	reset ($board_config); // Avoid nasty surprises for other coders

	if (count ($supported_languages) > 0)
	{
		$accepted_languages = explode (',', $accept_language);
		reset ($accepted_languages);
		while (list(, $lng) = each ($accepted_languages))
		{
			$pos = strpos ($lng, ';');
			if ($pos > 0) // The ; never occurs on position 0 in this case (unless spoofed)
			{
				$lng = substr ($lng, 0, $pos);
			}
			$lng = trim ($lng);
			if (!empty($lng))
			{
				if (isset($supported_languages[$lng])
						&& file_exists($phpbb_root_path . 'language/lang_' .  $supported_languages[$lng] . '/lang_main.'.$phpEx))
				{
					$language = $supported_languages[$lng];
					break;
				}
				else if (strstr($lng,'-')) // A user can have entered '-' at pos 0, so strpos is out for PHP 3 compliance
				{
					// break it up at the '-'
					$lng = substr($lng, 0, strpos($lng, '-'));
					if (!empty($lng) && isset($supported_languages[$lng])
							&& file_exists($phpbb_root_path . 'language/lang_' .  $supported_languages[$lng] . '/lang_main.'.$phpEx))
					{
						$language = $supported_languages[$lng];
						break;
					}
				}
			}
		}
	}
}
if (!empty ($language))
{
	$board_config['default_lang'] = $language;
}
// Auto lang mod end

///added by crxgames to optimize the Integramod Beast
	$sql = 'SELECT * FROM ' . ACRONYMS_TABLE;
	if( !$result = $db->sql_query($sql, false, 'acronyms') )
	{
		message_die(GENERAL_ERROR, "Couldn't obtain acronyms data", "", __LINE__, __FILE__, $sql);
	}
			
	$_acronyms = $db->sql_fetchrowset($result);
	$db->sql_freeresult($result);

//-- mod : today at   yesterday at ------------------------------------------------------------------------ 
//-- add 
// 
// PARSE DATEFORMAT TO GET TIME FORMAT 
// 
$time_reg = '/([gh][[:punct:][:space:]]{1,2}[i][[:punct:][:space:]]{0,2}[a]?[[:punct:][:space:]]{0,2}[S]?)/i'; 
preg_match($time_reg, $board_config['default_dateformat'], $regs); 
$board_config['default_timeformat'] = $regs[1]; 
unset($time_reg); 
unset($regs); 

include($phpbb_root_path . 'attach_mod/attachment_mod.'.$phpEx);
//-- mod : Advanced Group Color Management -------------------------------------
//-- add
include($phpbb_root_path . 'includes/class_color.' . $phpEx);
//-- fin mod : Advanced Group Color Management ---------------------------------

if(!defined("IN_LOGIN") && !defined('DEV_MODE')){
	if ((file_exists('install')) && ( !file_exists('prill_install') )) {
	message_die(GENERAL_MESSAGE, 'Please_remove_install');
}

	if ((file_exists('prill_install')) && ( !file_exists('install') )) {
	message_die(GENERAL_MESSAGE, 'Please_remove_prill');
	}
	
	if (file_exists('install') && file_exists('prill_install')) {
	message_die(GENERAL_MESSAGE, 'Please_remove_both');
	}

	if (file_exists('contrib'))
	{
		message_die(GENERAL_MESSAGE, 'Please ensure the contrib/ directory is deleted');
	}

	if (file_exists('chmod.php'))
	{
		message_die(GENERAL_MESSAGE, 'Please ensure root/chmod.php is deleted');
	}
}
//
// Show 'Board is disabled' message if needed.
//
$is_called = FALSE;
if( $board_config['board_disable'] && !defined("IN_ADMIN") && !defined("IN_LOGIN") )
{
	$userdata = session_pagestart( $user_ip, PAGE_INDEX );
	init_userprefs( $userdata );
	$is_called = TRUE;
	if($userdata['user_level'] != ADMIN)
	{
		if ( $board_config['board_disable_msg'] != "" )
		{
			message_die(GENERAL_MESSAGE, $board_config['board_disable_msg'], 'Information');
		}
		else
		{
			message_die(GENERAL_MESSAGE, $lang['Board_disable'], 'Information');
		}
	}
	else
	{
		$template->assign_block_vars('switch_board_disabled', array());
		if ( $board_config['board_disable_msg'] != "" )
		{
			$template->assign_vars(array('L_BOARD_DISABLE' => $board_config['board_disable_msg']));
		}
		else
		{
			$template->assign_vars(array('L_BOARD_DISABLE' => $lang['Board_disable']));
		}
	}
}

if ( is_robot() ) define('IS_ROBOT', true);
include($phpbb_root_path . 'includes/optimize_database_cron.'.$phpEx);

#======================================================================= |
#==== Start: == phpBB Security ========================================= |
#==== v1.0.3 =========================================================== |
#====					
include_once($phpbb_root_path .'includes/phpbb_security.'. $phpEx);
$ps_check = phpBBSecurity_Blocks();
	if ($ps_check)
		phpBBSecurity_Ban(phpBBSecurity_IP(), $board_config['phpBBSecurity_auto_ban'], $ps_check);
phpBBSecurity_MaxSessions($board_config['phpBBSecurity_allowed_sessions']);
phpBBSecurity_Guests();
#====
#==== Author: aUsTiN [austin@phpbb-amod.com] [http://phpbb-tweaks.com] = |
#==== End: ==== phpBB Security ========================================= |	
#======================================================================= |

//Begin Lo-Fi Mod
if (!empty($_GET['lofi']) || !empty($_COOKIE['lofi']))
{
	$lofi = 1;
}
//End Lo-Fi Mod

// IntegraMOD Ez ADR Integration
include_once($phpbb_root_path . 'adr/includes/adr_functions_alone.'.$phpEx); 
// END IntegraMOD Ez ADR Integration
