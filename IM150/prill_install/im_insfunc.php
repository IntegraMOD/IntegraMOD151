<?php
/***************************************************************************
 *                              im_insfunc.php
 *                            -------------------
 *   begin                : Wednesday, Jun 04, 2003
 *   version              : 1.1.0
 *   date                 : 2003/12/23 22:50
 ***************************************************************************/

/* This script contains functions and code used in both im_install.php and
   im_upgrade.php.
*/

$current_version = '0.7.0';
$app_name = 'Prillian';
$app_abbrev = 'im';
$echo_name = $app_name . ' ' . $current_version;

define('IN_PHPBB', true);
define('IN_PRILLIAN', true);
$phpbb_root_path='./../';
include_once($phpbb_root_path . 'extension.inc');
include_once($phpbb_root_path . 'common.'.$phpEx);

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);
//
// End session management
//

// prillian installed?
if (!defined('PRILLIAN_INSTALLED')) return;

include_once(CONTACT_PATH . 'functions_common.' . $phpEx);
secure_superglobals();


if (!$userdata['session_logged_in'])
{
	install_redirect("login.$phpEx?redirect=prill_install/im_install.$phpEx");
}
else if ($userdata['user_level'] != ADMIN)
{
	message_die(GENERAL_MESSAGE, $lang['Not_admin']);
}

$act_level = (!empty($_REQUEST['act_level'])) ? intval($_REQUEST['act_level']): 0;

$dbms_schema = '';
$dbms_basic = '';
$remove_remarks = '';
$delimiter = '';
$delimiter_basic = '';

if($board_config['default_lang'] != ''){
	$language = $board_config['default_lang'];
} else {
	$language = 'english';
}
include($phpbb_root_path.'language/lang_' . $language . '/lang_prillinstall.'.$phpEx);

function setup_db_data()
{
	global $dbms, $dbms_schema, $dbms_basic, $dbms_alter, $remove_remarks, $delimiter, $delimiter_basic, $app_abbrev;

	$available_dbms = array(
		'mysql'=> array(
			'LABEL'			=> 'MySQL 3.x',
			'SCHEMA'		=> 'mysql', 
			'DELIM'			=> ';',
			'DELIM_BASIC'	=> ';',
			'COMMENTS'		=> 'remove_remarks'
		), 
		'mysql4' => array(
			'LABEL'			=> 'MySQL',
			'SCHEMA'		=> 'mysql', 
			'DELIM'			=> ';', 
			'DELIM_BASIC'	=> ';',
			'COMMENTS'		=> 'remove_remarks'
		), 
		'mysqli' => array(
			'LABEL'			=> 'MySQLi',
			'SCHEMA'		=> 'mysql', 
			'DELIM'			=> ';', 
			'DELIM_BASIC'	=> ';',
			'COMMENTS'		=> 'remove_remarks'
		), 
		'postgres' => array(
			'LABEL'			=> 'PostgreSQL 7.x',
			'SCHEMA'		=> 'postgres', 
			'DELIM'			=> ';', 
			'DELIM_BASIC'	=> ';',
			'COMMENTS'		=> 'remove_comments'
		), 
		'mssql' => array(
			'LABEL'			=> 'MS SQL Server 7/2000',
			'SCHEMA'		=> 'mssql', 
			'DELIM'			=> 'GO', 
			'DELIM_BASIC'	=> ';',
			'COMMENTS'		=> 'remove_comments'
		),
		'msaccess' => array(
			'LABEL'			=> 'MS Access [ ODBC ]',
			'SCHEMA'		=> '', 
			'DELIM'			=> '', 
			'DELIM_BASIC'	=> ';',
			'COMMENTS'		=> ''
		),
		'mssql-odbc' =>	array(
			'LABEL'			=> 'MS SQL Server [ ODBC ]',
			'SCHEMA'		=> 'mssql', 
			'DELIM'			=> 'GO',
			'DELIM_BASIC'	=> ';',
			'COMMENTS'		=> 'remove_comments'
		)
	);

	$dbms_schema = $available_dbms[$dbms]['SCHEMA'] . '_' . $app_abbrev . '_schema.sql';
	$dbms_basic = $available_dbms[$dbms]['SCHEMA'] . '_' . $app_abbrev . '_basic.sql';
	$dbms_alter = $available_dbms[$dbms]['SCHEMA'] . '_' . $app_abbrev . '_alter.sql';

	$remove_remarks = $available_dbms[$dbms]['COMMENTS'];;
	$delimiter = $available_dbms[$dbms]['DELIM']; 
	$delimiter_basic = $available_dbms[$dbms]['DELIM_BASIC']; 
}

function get_schema($sourcefile, $breaker)
{
	global $table_prefix, $remove_remarks;

	$sql_query = @fread(@fopen($sourcefile, 'r'), @filesize($sourcefile));
	$sql_query = preg_replace('/phpbb_/', $table_prefix, $sql_query);

	$sql_query = $remove_remarks($sql_query);
	$sql_query = split_sql_file($sql_query, $breaker);
	return $sql_query;
}

function page_header()
{
	global $phpEx, $lang, $echo_name;

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $lang['ENCODING']; ?>">
<meta http-equiv="Content-Style-Type" content="text/css">
<title><?php echo $echo_name . ' ' . $lang['Installation'] ?></title>
<link rel="stylesheet" href="install.css" />
</head>
<body bgcolor="#E5E5E5" text="#000000" link="#006699" vlink="#5584AA">

<div class="prill_widelogo">
<?php echo $echo_name  . ' ' . $lang['Installation'] ?>
</div>
<div class="thanks">
<?php echo sprintf($lang['thanx'],$echo_name); ?>
</div>
<?php

}

function page_footer()
{

?>
</div>

</body>
</html>
<?php

}

// install_redirect()
// This is an almost straight copy of phpBB 2.0.4's redirect() function (which is
// copyright (C) the phpBB Group. Since that function is not present in older
// versions of phpBB, this function is used instead of redirect() for compatiblity
// with those phpBB versions. The only difference from redirect() is that append_sid
// is used in this function, so it's not needed to call append_sid when calling this
// function.
function install_redirect($url)
{
	global $db, $board_config, $lang;

	if (!empty($db))
	{
		$db->sql_close();
	}

	$url = append_sid($url, true);

	$server_protocol = ($board_config['cookie_secure']) ? 'https://' : 'http://';
	$server_name = preg_replace('#^\/?(.*?)\/?$#', '\1', trim($board_config['server_name']));
	$server_port = ($board_config['server_port'] <> 80) ? ':' . trim($board_config['server_port']) : '';
	$script_name = preg_replace('#^\/?(.*?)\/?$#', '\1', trim($board_config['script_path']));
	$script_name = ($script_name == '') ? $script_name : '/' . $script_name;
	$url = preg_replace('#^\/?(.*?)\/?$#', '/\1', trim($url));

	// Redirect via an HTML form for PITA webservers
	if (@preg_match('/Microsoft|WebSTAR|Xitami/', getenv('SERVER_SOFTWARE')))
	{
		header('Refresh: 0; URL=' . $server_protocol . $server_name . $server_port . $script_name . $url);
		echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><head><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><meta http-equiv="refresh" content="0; url=' . $server_protocol . $server_name . $server_port . $script_name . $url . '"><title>Redirect</title></head><body><div align="center">'.sprintf($lang['No_redirect'],'<a href="' . $server_protocol . $server_name . $server_port . $script_name . $url . '">','</a>').'</div></body></html>';
		exit;
	}

	// Behave as per HTTP/1.1 spec for others
	header('Location: ' . $server_protocol . $server_name . $server_port . $script_name . $url);
	exit;
}
?>