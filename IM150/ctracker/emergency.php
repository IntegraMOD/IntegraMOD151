<?php
/**  
* <b>emergency.php</b>
* A small emergency console to reset the last functioning Board configuration
* or reset the domain settings. Please remember that <b>this file is not part of
* phpBB</b> so it is really important that you exactly READ the instructions
* before you use the file!
* 
* @author Christian Knerr (cback)
* @package ctracker
* @version 5.0.0
* @since 16.08.2006 - 00:20:13
* @copyright (c) 2006 www.cback.de
* 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*/

// CTracker_Ignore: File checked by human
// Warning........: File is not part of phpBB itself!


/*
 * Comment out the following code part to use the Emergency Console. If you stop
 * working with this file please remember to block this file again!! If not
 * everyone could access it and use the functions in here!
 * 
 * If you want access the recovery console just enter the url to that file into
 * your Browser for example:
 * 
 * www.example.com/ctracker/emergency.php
 * 
 * 
 * Our suggestion is to remove this file completely from your Board if you
 * don't need it!
 */
die("<img src=\"admin/console/console_pic.png\" border=\"0\" alt=\"ECON\" title=\"ECON\"><br /><br /><b>Emergency Console Blocked!</b><br />See more instructions in this file!");


/*
 * Define some vars & constants we need
 */
define('IN_PHPBB', true);

$phpbb_root_path = './../';
include($phpbb_root_path . 'extension.inc');

error_reporting  (E_ERROR | E_WARNING | E_PARSE); // This will NOT report uninitialized variables
set_magic_quotes_runtime(0); // Disable magic_quotes_runtime

// The following code (unsetting globals)
// Thanks to Matt Kavanagh and Stefan Esser for providing feedback as well as patch files

// PHP5 with register_long_arrays off?
if (@phpversion() >= '5.0.0' && (!@ini_get('register_long_arrays') || @ini_get('register_long_arrays') == '0' || strtolower(@ini_get('register_long_arrays')) == 'off'))
{
	$_POST = $_POST;
	$_GET = $_GET;
	$_SERVER = $_SERVER;
	$_COOKIE = $_COOKIE;
	$_ENV = $_ENV;
	$_FILES = $_FILES;

	// _SESSION is the only superglobal which is conditionally set
	if (isset($_SESSION))
	{
		$_SESSION = $_SESSION;
	}
}

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


/*
 * Include some files we need for the Emergency Console
 */
include($phpbb_root_path . 'config.' . $phpEx);
include($phpbb_root_path . 'db/' . $dbms . '.' . $phpEx);
include($phpbb_root_path . 'includes/template.' . $phpEx);
define('PREFIX', $table_prefix);


/*
 * DB Connection, Template and Adminclass
 */
$db 	  = new sql_db($dbhost, $dbuser, $dbpasswd, $dbname);
$template = new Template();


/*
 * Unset unused vars
 */
unset($dbname);					// Unset Database Name
unset($dbuser);					// Unset Database Username
unset($dbpasswd);				// Unset Database Password var
unset($db->password);			// Unset Database Password in DB Class
unset($sql);					// Unset maybe injected SQL Commands in this var

function phpbb_realpath($path)
{
	global $phpbb_root_path, $phpEx;
	return (!@function_exists('realpath') || !@realpath($phpbb_root_path . 'includes/functions.'.$phpEx)) ? $path : @realpath($path);
}

function message_die($msg_code, $msg_text = '', $msg_title = '', $err_line = '', $err_file = '', $sql = '')
{
	die("<html>\n<body bgcolor=\"#000000\">\n<font color=\"#FFFFFF\">" . $msg_title . "</font>\n<br /><br />\n" . $msg_text . "</body>\n</html>");
}


/*
 * The script itself :)
 */
$template->set_filenames(array(
	'ct_body' => $phpbb_root_path . 'ctracker/admin/console/emergency.tpl')
);

/*
 * Console Operations
 */
$mode = $_GET['mode'];

if ( $mode == 'restore' )
{
	// Drop existing Config Table
	$sql = 'DROP TABLE IF EXISTS ' . PREFIX . 'config';
	if ( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, "Database Query Failed!", '', __LINE__, __FILE__, $sql);
	}
	
	// Create Config table
	$sql = 'CREATE TABLE ' . PREFIX . 'config (
				`config_name` varchar( 255 ) NOT NULL ,
				`config_value` varchar( 255 ) NOT NULL ,
				PRIMARY KEY ( `config_name` )
				)';
	if ( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, "Database Query Failed!", '', __LINE__, __FILE__, $sql);
	}
	
	// Insert config data
		$sql = 'SELECT * FROM ' . PREFIX . 'ctracker_backup';
		
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Database Query Failed!', '', __LINE__, __FILE__, $sql);
		}
		
		while ( $row = $db->sql_fetchrow($result) )
		{
			$sql2 = 'INSERT INTO ' . PREFIX . 'config (`config_name`, `config_value`) VALUES (\''. $row['config_name'] . '\', \''. $row['config_value'] . '\')';
			if ( !$result2 = $db->sql_query($sql2) )
			{
				message_die(GENERAL_ERROR, 'Database Query Failed!', '', __LINE__, __FILE__, $sql);
			}			
		}
	
	// Remove Backup Timestamp
	$sql = 'DELETE FROM ' . PREFIX . 'config WHERE config_name = \'ct_last_backup\'';
	if ( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, "Database Query Failed", '', __LINE__, __FILE__, $sql);
	}

	$template->assign_block_vars('ok', array());
}
else if ( $mode == 'psrt' )
{
	$sql = "UPDATE " . PREFIX . "config SET
				config_value = '" . str_replace("\'", "''", $_POST['cookie_name']) . "'
				WHERE config_name = 'cookie_name'";
	if ( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, "Database Query Failed!", '', __LINE__, __FILE__, $sql);
	}
	
	$sql = "UPDATE " . PREFIX . "config SET
				config_value = '" . str_replace("\'", "''", $_POST['cookie_path']) . "'
				WHERE config_name = 'cookie_path'";
	if ( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, "Database Query Failed!", '', __LINE__, __FILE__, $sql);
	}
	
	$sql = "UPDATE " . PREFIX . "config SET
				config_value = '" . str_replace("\'", "''", $_POST['cookie_domain']) . "'
				WHERE config_name = 'cookie_domain'";
	if ( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, "Database Query Failed!", '', __LINE__, __FILE__, $sql);
	}
	
	$sql = "UPDATE " . PREFIX . "config SET
				config_value = '" . str_replace("\'", "''", $_POST['cookie_secure']) . "'
				WHERE config_name = 'cookie_secure'";
	if ( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, "Database Query Failed!", '', __LINE__, __FILE__, $sql);
	}
	
	$sql = "UPDATE " . PREFIX . "config SET
				config_value = '" . str_replace("\'", "''", $_POST['server_name']) . "'
				WHERE config_name = 'server_name'";
	if ( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, "Database Query Failed!", '', __LINE__, __FILE__, $sql);
	}
	
	$sql = "UPDATE " . PREFIX . "config SET
				config_value = '" . str_replace("\'", "''", $_POST['server_port']) . "'
				WHERE config_name = 'server_port'";
	if ( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, "Database Query Failed!", '', __LINE__, __FILE__, $sql);
	}
	
	$sql = "UPDATE " . PREFIX . "config SET
				config_value = '" . str_replace("\'", "''", $_POST['script_path']) . "'
				WHERE config_name = 'script_path'";
	if ( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, "Database Query Failed!", '', __LINE__, __FILE__, $sql);
	}
	
	$sql = "UPDATE " . PREFIX . "config SET
				config_value = '" . str_replace("\'", "''", $_POST['session_length']) . "'
				WHERE config_name = 'session_length'";
	if ( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, "Database Query Failed!", '', __LINE__, __FILE__, $sql);
	}
	
	$template->assign_block_vars('ok', array());
}


/*
 * Load backup status
 */
$save_status = '';
$saved_now   = false;
$sql = 'SELECT * FROM ' . PREFIX . 'ctracker_backup WHERE config_name = \'ct_last_backup\'';
if ( !$result = $db->sql_query($sql) )
{
	$save_status = 'no configuration backup available';
}	
else
{
	$saved_now = true;
	while ( $row = $db->sql_fetchrow($result) )
	{
		$backup[$row['config_name']] = $row['config_value'];
	}
	$save_status = date('d.m.Y - H:i', $backup['ct_last_backup']);
}


/*
 * Send some vars to the template
 */
$template->assign_vars(array(
		'YEAR'			 => date(Y),
		'BACKUP' 		 => $save_status,
		'PHPEX'			 => $phpEx,
		'RESTORE_OUTPUT' => ($saved_now)? '<a href="emergency.php?mode=restore" style="color:#FDFF00">&raquo; Click here to restore configuration table now! &laquo;</a>': '')
  );
  

// Generate the page
$template->pparse('ct_body');


/*
 * Disconnect from Database
 */
$db->sql_close();

?>
