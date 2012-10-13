<?php
/***************************************************************************
 *                            contact_common.php
 *                            -------------------
 *   begin                : Tuesday, Jul 02, 2003
 *   version              : 0.2.0
 *   date                 : 2003/12/23 23:25
 ***************************************************************************/
/*
	This file "starts" Contact List by setting up common constants and variables.
	Commonly used files and routines are also included and/or executed.
*/

if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
}

// CONSTANTS - BEGIN
define('IN_CONTACT_LIST', true);
define('CURRENT_LANG_PATH', $phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/');
// CONSTANTS - END


// VARIABLES - BEGIN
// Basic URLs used in single user Buddy Management Links (the image links)
$contact_base_url = CONTACT_URL . '?mode=edit&single=1&simple=1&sid=' . $userdata['session_id'] . '&type=';
$base_urls['buddy'] = $contact_base_url . 'buddy' . '&action=';
$base_urls['ignore'] = $contact_base_url . 'ignore' . '&action=';
$base_urls['disallow'] = $contact_base_url . 'disallow' . '&action=';
$base_urls['add'] = 'add&id=';
$base_urls['delete'] = 'remove&id=';

// Preset common vars to empty or false.
$contact_result = false;
$have_ignored = false;
$online_array = array();
$online_buddylist = '';

$ignore_users = ( isset($_REQUEST['no_ignore']) || $userdata['user_id'] == ANONYMOUS ) ? false: true;
// VARIABLES - END

// FILES - BEGIN
include_once(CONTACT_PATH . 'functions_contact.' . $phpEx);
include_once(CONTACT_PATH . 'class_contact.' . $phpEx);
include_once(CONTACT_PATH . 'functions_common.' . $phpEx);
include_once(CURRENT_LANG_PATH . 'lang_contact.' . $phpEx);
// FILES - END

// PRILLIAN ADD-ONS - BEGIN
// These are only necessary if Prillian is not installed
if(!defined('IN_PRILLIAN'))
{
	secure_superglobals();
	// Skip unneeded page headers on small windows
	$simple = 0;
	$append_msg = '';
	if( !empty($_REQUEST['simple']) || $gen_simple_header )
	{
		$gen_simple_header = true;
		$simple = 1;
	}
}

// PRILLIAN ADD-ONS - END

// Let's turn on a switch to prevent going to the database for contact list info
// when dealing with a guest user, since they can't have contacts anyway.
// To activate this switch on another page, add this line to that page:
// define('NO_CONTACTS', true);
if ( $userdata['user_id'] == ANONYMOUS && !defined('NO_CONTACTS') )
{
	define('NO_CONTACTS', true);
}



// Start Contact List object, and get buddy list since it's used on most pages
$contact_list = new contact_list();
$contact_list->get_list('buddy');

?>