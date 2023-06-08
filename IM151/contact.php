<?php
/***************************************************************************
 *                                contact.php
 *                            -------------------
 *   begin                : Tuesday, Feb 18, 2003
 *   version              : 0.4.0
 *   date                 : 2003/12/23 23:19
 ***************************************************************************/

define('IN_PHPBB', true);

$mode = ( !empty($_REQUEST['mode']) ) ? $_REQUEST['mode'] : 'show';

// Skip standard page headers if including file to get list box
// This stuff should have already been done at this point
if( $mode != 'listbox')
{
	$phpbb_root_path = './';
	include_once($phpbb_root_path . 'extension.inc');
	include_once($phpbb_root_path . 'common.'.$phpEx);

	//
	// Start session management
	//
	$userdata = session_pagestart($user_ip, PAGE_CONTACT);
	init_userprefs($userdata);
	//
	// End session management
	//
}

$mode = ( !empty($_REQUEST['mode']) ) ? $_REQUEST['mode'] : 'show';

// Set up BID List for running
include_once(CONTACT_PATH . 'contact_common.'.$phpEx);

// Skip standard page headers if including file to get list box
// This stuff should have already been done at this point
if( $mode != 'listbox')
{
	$cancel = ( isset($_REQUEST['cancel']) ) ? TRUE : 0;

	if ( $cancel )
	{
		if( $gen_simple_header )
		{
			auto_close();
		}
		else
		{
			thoul_redirect($phpbb_root_path . 'contact.' . $phpEx);
		}
	}

	$confirm = ( isset($_REQUEST['confirm']) ) ? true : 0;
	//
	// Not logged in? Then go to the login page.
	//
	if ( !$userdata['session_logged_in'] )
	{
		thoul_redirect("login.$phpEx?redirect=contact.$phpEx&simple=$simple");
	}

	// Default page title
	$page_title = $lang['Contact_Management'];

	include_once($phpbb_root_path . 'includes/page_header.'.$phpEx);

	if( !$gen_simple_header )
	{
		$template->set_filenames(array(
			'header' => 'contact/header.tpl')
		);

		$temp_url = $phpbb_root_path . 'contact.' . $phpEx . '?mode=show&type=';

		$template->assign_vars(array(
			'FAQ' => '<a href="' . append_sid($phpbb_root_path . 'faq.' . $phpEx . '?mode=contact') . '">' . $lang['FAQ'] . '</a>',
			'ADD_USERS' => '<a href="' . append_sid($temp_url . 'addusers') . '">' . $lang['Add_contact_users_link'] . '</a>',
			'BUDDIES' => '<a href="' . append_sid($temp_url . 'buddy') . '">' . $lang['Buddy_link'] . '</a>',
			'IGNORING' => '<a href="' . append_sid($temp_url . 'ignore') . '">' . $lang['Ignore_link'] . '</a>',
			'DISALLOWING' => '<a href="' . append_sid($temp_url . 'disallow') . '">' . $lang['Disallow_link'] . '</a>',
			'BUDDY_OF' => '<a href="' . append_sid($temp_url . 'buddy_of') . '">' . $lang['Buddied_link'] . '</a>'
		));
		$template->assign_var_from_handle('CONTACT_CP_LINKS', 'header');
	}
}

// Initialize all possible variables!
$type = ( !empty($_REQUEST['type']) ) ? $_REQUEST['type'] : 'buddy';
$action = ( !empty($_REQUEST['action']) ) ? $_REQUEST['action'] : '';
$contact_id = ( !empty($_REQUEST['id']) ) ? intval($_REQUEST['id']) : '';

if ( !empty($_REQUEST['username']) )
{
	$username = trim(htmlspecialchars($_REQUEST['username']));
	$username = str_replace("\'", "''", $username);
}
else
{
	$username = '';
}

$sort_order = ($_REQUEST['order'] == 'DESC') ? 'DESC' : 'ASC';
$start = ( isset($_REQUEST['start']) ) ? intval($_REQUEST['start']) : 0;


if( $mode == 'edit' )
{
	include_once(CONTACT_PATH . 'contactcp_edit.'.$phpEx);
}
elseif( $mode == 'alert' )
{
	$offline = ( isset($_REQUEST['offline']) ) ? $_REQUEST['offline'] : 0;
	$online = ( isset($_REQUEST['online']) ) ? $_REQUEST['online'] : 0;
	popup_buddy_alert($offline, $online);
}
elseif( $mode == 'popup' || $mode == 'listbox' )
{
	include_once(CONTACT_PATH . 'contactcp_listbox.'.$phpEx);
}
else
{
	$mode = 'show';
	include_once(CONTACT_PATH . 'contactcp_show.'.$phpEx);
}


if( $mode != 'listbox')
{
	include_once($phpbb_root_path . 'includes/page_tail.'.$phpEx);
}

?>