<?php
/***************************************************************************
 *                             prill_common.php
 *                            -------------------
 *   begin                : Tuesday, Jul 02, 2003
 *   version              : 0.2.0
 *   date                 : 2003/12/23 23:25
 ***************************************************************************/
/*
	This file "starts" Prillian by setting up common constants and variables.
	Commonly used files and routines are also included and/or executed.
*/

if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
}

// CONSTANTS - BEGIN
// Some other constants are in constants_prillian.php
define('IN_PRILLIAN', true);
define('CURRENT_LANG_PATH', $phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/');
// CONSTANTS - END

// FILES - BEGIN

include_once(PRILL_PATH . 'functions_im.' . $phpEx);
include_once(CURRENT_LANG_PATH . 'lang_prillian.' . $phpEx);

// FILES - END

// VARIABLES - BEGIN

// Preset common vars.
$error = false;
$meta_headers = '';
$refresh_javascript = '';
$mode_append = '';
$read_mark = '';
$im_auto_popup = 0;
$l_prillian_text = $lang['Launch_Prillian'];
$im_userdata = array();
$default_im_subject = $lang['phpBB_IM_default_subject'];
// VARIABLES - END

if( !defined('IN_NETWORK'))
{
	// Contact List requirements
	include_once(CONTACT_PATH . 'contact_common.' . $phpEx);
}
else
{
	include_once(CONTACT_PATH . 'functions_common.' . $phpEx);
}


secure_superglobals();
$prill_config = get_prillian_config();
// Skip unneeded page headers on small windows
$simple = 0;
$append_msg = '';
if( !empty($_REQUEST['simple']) || $gen_simple_header )
{
	$gen_simple_header = true;
	$simple = 1;
	$append_msg = $lang['Close_window_link'];
}

?>