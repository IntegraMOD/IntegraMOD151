<?php
/***************************************************************************
 *                           functions_contact.php
 *                            -------------------
 *   begin                : Sunday, Dec 01, 2002
 *   version              : 0.7.0
 *   date                 : 2003/12/23 23:23
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
}

// Avoid including the file more than once.
if ( defined('CONTACTF_INCLUDED') )
{
	return;
}
define('CONTACTF_INCLUDED', true);

function popup_buddy_alert($offline, $online)
{
	global $db, $phpbb_root_path, $phpEx, $template, $lang;

	$offline_ids = '';
	$online_ids = '';
	$offline = explode(',', $offline);
	$online = explode(',', $online);

	foreach($offline as $val)
	{
		$offline_ids .= ( ($offline_ids == '') ? '' : ',' ) . intval($val);
	}
	foreach($online as $val)
	{
		$online_ids .= ( ($online_ids == '') ? '' : ',' ) . intval($val);
	}

	$final_list = '';
	if( $offline_ids != '0' )
	{
		$final_list .= $offline_ids;
	}
	if( $online_ids != '0' )
	{
		$final_list .= $online_ids;
	}

	$sql = 'SELECT user_id, username FROM ' . USERS_TABLE . ' WHERE user_id IN (' . $final_list . ')';
	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not get online/offline usernames', '', __LINE__, __FILE__, $sql);
	}
	$rows = $db->sql_fetchrowset($result);

	$offline_names = '';
	$online_names = '';
	$base_url = $phpbb_root_path . 'profile.' . $phpEx . '?mode=viewprofile&u=';
	foreach($rows as $val)
	{
		$temp_url = $base_url . $val['user_id'];
		if( in_array($val['user_id'], $offline) )
		{
			$offline_names .= ( ($offline_names == '') ? '' : ',' ) . '<a href="' . append_sid($temp_url, true) . '" target="profile">' . $val['username'] . '</a>';
		}
		elseif( in_array($val['user_id'], $online) )
		{
			$online_names .= ( ($online_names == '') ? '' : ',' ) . '<a href="' . append_sid($temp_url, true) . '" target="profile">' . $val['username'] . '</a>';
		}
	}

	$offline_str = '';
	$online_str = '';
	if( $offline_ids != '0' )
	{
		$offline_str = ( count($offline) >= 2 ) ? $lang['Buddies_offline'] . ': ' : $lang['Buddy_offline'] . ': ';
	}
	if( $online_ids != '0' )
	{
		$online_str = ( count($online) >= 2 ) ? $lang['Buddies_online'] . ': ' : $lang['Buddy_online'] . ': ';
	}

	$gen_simple_header = true;
	include_once($phpbb_root_path . 'includes/page_header.' . $phpEx);
	$template->set_filenames(array(
		'body' => 'contact/alert_popup.tpl')
	);
	$template->assign_vars(array(
		'L_CLOSE_WINDOW' => $lang['Close_window'],
		'L_BUDDIES_ONLINE' => $online_str,
		'BUDDIES_ONLINE' => $online_names,
		'L_BUDDIES_OFFLINE' => $offline_str,
		'BUDDIES_OFFLINE' => $offline_names
	));
	$template->pparse('body');
	include_once($phpbb_root_path . 'includes/page_tail.' . $phpEx);
}

?>