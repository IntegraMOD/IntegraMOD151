<?php
/***************************************************************************
 *                            profilcp_profil_digests.php
 *                            --------------------------
 *	begin				: 18 Dec 2004
 *	copyright		: (C) 2000 The phpBB Group // edwin bekaert
 *	email				: support@phpBB.com
 *
 *	version				: 1.0.0 - 18/12/2004
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

// Originally Written by Mark D. Hamill, mhamill@computer.org
// Currently Authored by Indemnity83, Indemnity83@dormlife.us
// This software is designed to work with phpBB Version 2.0.8

// This is the user interface for the digest software. Users can use it to create and modify their digest 
// settings, or remove their digest subscription. 

// Warning: this was only tested with MySQL. I don't have access to other databases. Consequently, 
// the SQL may need tweaking for other relational databases.

// adapted to PCP by edwin bekaert.

if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
	exit;
}

if ( !empty($setmodules) )
{
	pcp_set_sub_menu('profil', 'digests', 30, __FILE__, 'profilcp_digests_shortcut', 'profilcp_digests_pagetitle' );
	return;
}

// check access
if ( ($userdata['user_id'] != $view_userdata['user_id']) && (!is_admin($userdata) || ($level_prior[get_user_level($userdata)] <= $level_prior[get_user_level($view_userdata)])) ) return;

//
// template file
$template->set_filenames(array(
	'body' => 'profilcp/profil_digests_body.tpl')
);

include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_digest.' . $phpEx);
include_once($phpbb_root_path . 'includes/functions_selects.'.$phpEx);
include_once($phpbb_root_path . 'includes/functions_digests.'.$phpEx);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	// get current subscription data for this user, if any
	$sql = 'SELECT count(*) AS count FROM ' . DIGEST_TABLE . ' WHERE user_id = ' . $view_userdata['user_id'];
	if ( !($result = $db->sql_query($sql))){
		$error = true;
		$error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . 'Could not get count from '. DIGEST_TABLE . ' table';
	}
	$row = $db->sql_fetchrow($result);
	$create_new = ($row['count'] == 0) ? true: false;

	if ($create_new){
		// default values if no digest subscription for user
		$digest_frequency = '0';
		$format = DIGEST_HTML;
		$show_text = true;
		$show_mine = true;
		$new_only = true;
		$send_on_no_messages = true;
		$text_length = '300';
	} else {
		// read current digest options into local variables, because we have one inherent connection
		$sql = 'SELECT digest_frequency, format, show_text, show_mine, new_only, send_on_no_messages, text_length FROM ' . DIGEST_TABLE . ' WHERE user_id = ' . $view_userdata['user_id'];

		if ( !($result = $db->sql_query($sql))){
			$error = true;
			$error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) .'Could not get count from ' . DIGEST_TABLE . 'table' ;			
		}
		$row = $db->sql_fetchrow($result);

		$digest_frequency = $row['digest_frequency'];
		$format = $row['format'];
		$show_text = $row['show_text'];
		$show_mine = $row['show_mine'];
		$new_only = $row['new_only'];
		$send_on_no_messages = $row['send_on_no_messages'];
		$text_length = $row['text_length'];
	}  
	$db->sql_freeresult ($result);
   
	// get current subscribed forums for this user, if any
	$sql = 'SELECT count(*) AS count FROM ' . DIGEST_FORUMS_TABLE . ' WHERE user_id = ' . $view_userdata['user_id'];
	if ( !($result = $db->sql_query($sql))){
		$error = true;
		$error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . 'Could not get count from ' . DIGEST_FORUMS_TABLE . ' table';
	}
	$row = $db->sql_fetchrow($result);
	$all_forums_new = ($row['count'] == 0) ? true : false;
	$db->sql_freeresult ($result);

	// fill template with current digest options for user
	$template->assign_vars(array(
		'L_DIGEST_FREQUENCY' => $lang['digest_frequency'],
		'L_DIGEST_FREQUENCY_DESC' => $lang['digest_frequency_desc'],
		'L_FORMAT' => $lang['digest_format'],
		'L_FORMAT_DESC' => $lang['digest_format_desc'],
		'L_HTML' => $lang['digest_html'],
		'L_TEXT' => $lang['digest_text'],
		'L_SHOW_TEXT' => $lang['digest_show_message_text'],
		'L_YES' => $lang['Yes'],
		'L_NO' => $lang['No'],
		'L_SHOW_MINE' => $lang['digest_show_my_messages'],
		'L_NEW_ONLY' => $lang['digest_new_only'],
		'L_NEW_ONLY_DESC' => $lang['digest_new_only_desc'],
		'L_SEND_ON_NO_MESSAGES' => $lang['digest_send_empty'],
		'L_TEXT_LENGTH' => $lang['digest_message_size'],
		'L_TEXT_LENGTH_DESC' => $lang['digest_size_desc'],
		'L_FORUM_SELECTION' => $lang['digest_select_forums'],
		'L_ALL_SUBSCRIBED_FORUMS' => $lang['digest_all_forums'],
		'L_SUBMIT' => $lang['digest_submit_text'],
		'L_RESET' => $lang['Reset'],
		
		'S_HTML' => DIGEST_HTML,
		'S_TEXT' => DIGEST_TEXT,
		'S_TRUE' => true, 
		'S_FALSE' => false,
		'S_TEXT_LENGH' => tl_select($text_length),
	
		'NO_FORUMS_SELECTED' => $lang['digest_no_forums_selected'],
		'DIGEST_EXPLANATION' => $lang['digest_explanation'],
		'DIGEST_CREATE_NEW_VALUE' => ($create_new) ? '1' : '0',			
		'S_DIGEST_FREQUENCY' => $digest_frequency,						
		'HTML_CHECKED' => ($format== DIGEST_HTML ) ? 'checked="checked"' : '',			
		'TEXT_CHECKED' => ($format== DIGEST_TEXT ) ? 'checked="checked"' : '',			
		'SHOW_TEXT_YES_CHECKED' => ($show_text== true ) ? 'checked="checked"' : '',			
		'SHOW_TEXT_NO_CHECKED' => ($show_text== false ) ? 'checked="checked"' : '',			
		'SHOW_MINE_YES_CHECKED' => ($show_mine== true ) ? 'checked="checked"' : '',
		'SHOW_MINE_NO_CHECKED' => ($show_mine== false ) ? 'checked="checked"' : '',			
		'NEW_ONLY_YES_CHECKED' => ($new_only== true ) ? 'checked="checked"' : '',
		'NEW_ONLY_NO_CHECKED' => ($new_only== false ) ? 'checked="checked"' : '',			
		'SEND_ON_NO_MESSAGES_YES_CHECKED' => ($send_on_no_messages== true ) ? 'checked="checked"' : '',
		'SEND_ON_NO_MESSAGES_NO_CHECKED' => ($send_on_no_messages== false ) ? 'checked="checked"' : '',			
		'50_SELECTED' => ($text_length=='50') ? 'selected="selected"' : '',
		'100_SELECTED' => ($text_length=='100') ? 'selected="selected"' : '',
		'150_SELECTED' => ($text_length=='150') ? 'selected="selected"' : '',
		'300_SELECTED' => ($text_length=='300') ? 'selected="selected"' : '',
		'600_SELECTED' => ($text_length=='600') ? 'selected="selected"' : '',
		'MAX_SELECTED' => ($text_length=='32000') ? 'selected="selected"' : '',
		'ALL_FORUMS_CHECKED' => ($create_new || ((!($create_new)) && $all_forums_new)) ? 'checked="checked"' : '')
	);
	
	//
	// Start the code to grab the viewable forum list
	//
		
	//
	// Define appropriate SQL
	//
	switch(SQL_LAYER){
		case 'postgresql':
			$sql = "SELECT f.*, p.post_time, p.post_username, u.username, u.user_id 
				FROM " . FORUMS_TABLE . " f, " . POSTS_TABLE . " p, " . USERS_TABLE . " u
				WHERE p.post_id = f.forum_last_post_id 
					AND u.user_id = p.poster_id  
					UNION (
						SELECT f.*, NULL, NULL, NULL, NULL
						FROM " . FORUMS_TABLE . " f
						WHERE NOT EXISTS (
							SELECT p.post_time
							FROM " . POSTS_TABLE . " p
							WHERE p.post_id = f.forum_last_post_id  
						)
					)
					ORDER BY cat_id, forum_order";
			break;

		case 'oracle':
			$sql = "SELECT f.*, p.post_time, p.post_username, u.username, u.user_id 
				FROM " . FORUMS_TABLE . " f, " . POSTS_TABLE . " p, " . USERS_TABLE . " u
				WHERE p.post_id = f.forum_last_post_id(+)
					AND u.user_id = p.poster_id(+)
				ORDER BY f.cat_id, f.forum_order";
			break;

		default:
			$sql = "SELECT f.*, p.post_time, p.post_username, u.username, u.user_id
				FROM (( " . FORUMS_TABLE . " f
				LEFT JOIN " . POSTS_TABLE . " p ON p.post_id = f.forum_last_post_id )
				LEFT JOIN " . USERS_TABLE . " u ON u.user_id = p.poster_id )
				ORDER BY f.cat_id, f.forum_order";
			break;
	}
	
	if ( !($result = $db->sql_query($sql)) ){
		$error = true;
		$error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . 'Could not query forums information';
	}

	$forum_data = array();
	while( $row = $db->sql_fetchrow($result) ){
		$forum_data[] = $row;
	}
	$db->sql_freeresult($result);

	if ( !($total_forums = count($forum_data)) ){
		$error = true;
		$error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . $lang['No_forums'];
	}
	
	//
	// Find which forums are visible for this user
	//
	$is_auth_ary = array();
	$is_auth_ary = auth_read($view_userdata);
	
	// now print the forums on the web page, each forum being a checkbox with appropriate label
	for ($j = 0; $j < $total_forums; $j++) {
		if ( $is_auth_ary[$forum_data[$j]['forum_id']]['auth_read'] ){
			// Is this forum currently subscribed? If so it needs to be checkmarked
			if (!($all_forums_new)) {
				$sql = 'SELECT count(*) AS count FROM ' . DIGEST_FORUMS_TABLE . ' WHERE forum_id = ' . $forum_data[$j]['forum_id'] . ' AND user_id = ' . $view_userdata['user_id'];
				if ( !($result = $db->sql_query($sql))){
					$error = true;
					$error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . 'Could not get count from ' . DIGEST_FORUMS_TABLE . ' table';
				}
				$row = $db->sql_fetchrow($result);
				if ($row['count'] == 0){
					$forum_checked = false;
				} else {
					$forum_checked = true;
				}
				$db->sql_freeresult ($result);
			} else {
				$forum_checked = true;               	
			}
			
			$template->assign_block_vars('forums', array( 
				'FORUM_NAME' => 'forum_' . $forum_data[$j]['forum_id'],
				'CHECKED' => ($forum_checked || $create_new) ? 'checked="checked"' : '',
				'FORUM_LABEL' => $forum_data[$j]['forum_name'])
			);
		}
	}
	// global setting
	$template->assign_vars(array(
		'S_HIDDEN_FIELDS' => $s_hidden_fields,
		'S_PROFILCP_ACTION' => append_sid("profile.$phpEx"),
		)
	);
	// page
	$template->pparse('body');
} else {
	// The user has submitted the form. This logic takes the necessary action to update the database
	// and gives an appropriate confirmation message.

	if ( $error ) {
		//
		// If an error occured we need to stripslashes on returned data
		//
		$digest_frequency = stripslashes($digest_frequency);
		$format = stripslashes($format);
		$show_text = stripslashes($show_text);
		$show_mine = stripslashes($show_mine);
		$new_only = stripslashes(new_only);
		$send_on_no_messages = stripslashes(send_on_no_messages);
		$text_length = stripslashes($text_lengh);
	}

	if ($_POST['digest_frequency'] == 0) {
		// user no longer wants a digest
		// first remove all individual forum subscriptions
		$sql = 'DELETE FROM ' . DIGEST_FORUMS_TABLE . ' WHERE user_id = ' . $view_userdata['user_id'];
		if ( !($result = $db->sql_query($sql))){
			$error = true;
			$error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . 'Could not delete from ' . DIGEST_FORUMS_TABLE . ' table';
		}
		// remove subscription itself
		$sql = 'DELETE FROM ' . DIGEST_TABLE . ' WHERE user_id = ' . $view_userdata['user_id'];
		if ( !($result = $db->sql_query($sql))){
			$error = true;
			$error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . 'Could not delete from ' . DIGEST_TABLE . ' table';
		}
		$update_type = 'unsubscribe';
	} else {
		// In all other cases a digest has to be either created or updated
		// first, create or update the subscription
		if ($_POST['create_new'] == '1'){// new digest
			$sql = 'INSERT INTO ' . DIGEST_TABLE . ' (user_id, digest_frequency, last_digest, format, show_text, show_mine, new_only, send_on_no_messages, text_length) VALUES (' .
				intval($view_userdata['user_id']) . ', ' .
				"'" . htmlspecialchars($_POST['digest_frequency']) . "', " .
				"'" . time() . "', " .
				"'" . htmlspecialchars($_POST['format']) . "', " .
				"'" . htmlspecialchars($_POST['show_text']) . "', " .
				"'" . htmlspecialchars($_POST['show_mine']) . "', " .
				"'" . htmlspecialchars($_POST['new_only']) . "', " .
				"'" . htmlspecialchars($_POST['send_on_no_messages']) . "', " .
				intval($_POST['text_length']). ')';
			$update_type = 'create';
		} else {
			$sql = 'UPDATE ' . DIGEST_TABLE . ' SET ' .
				"digest_frequency = '" . htmlspecialchars($_POST['digest_frequency']) . "', " .
				"format = '" . htmlspecialchars($_POST['format']) . "', " .
				"show_text = '" . htmlspecialchars($_POST['show_text']) . "', " .
				"show_mine = '" . htmlspecialchars($_POST['show_mine']) . "', " .
				"new_only = '" . htmlspecialchars($_POST['new_only']) . "', " .
				"send_on_no_messages = '" . htmlspecialchars($_POST['send_on_no_messages']) . "', " .
				'text_length = ' . intval($_POST['text_length']) . ' ' . 
				' WHERE user_id = ' . intval($view_userdata['user_id']);
			$update_type = 'modify';
		}
		if ( !($result = $db->sql_query($sql))){
			$error = true;
			$error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) .  'Could not insert or update ' . DIGEST_TABLE . ' table';
		}
		// next, if there are any individual forum subscriptions, remove the old ones and create the new ones
		$sql = 'DELETE FROM ' . DIGEST_FORUMS_TABLE . ' WHERE user_id = ' . $view_userdata['user_id'];
		if ( !($result = $db->sql_query($sql))){
			$error = true;
			$error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . 'Could not delete from ' . DIGEST_FORUMS_TABLE . ' table';
		}
		// Note that if "all_forums" is checked, this is noted in the subscriptions table. It does not put
		// each forum in the subscribed_forums table. This conserves disk space. "all_forums" means all 
		// forums this user is allowed to access.
		if ($_POST['all_forums'] !== 'on'){
			foreach ($_POST as $key => $value){
				if (substr($key, 0, 6) == 'forum_'){
					$sql = 'INSERT INTO ' . DIGEST_FORUMS_TABLE . ' (user_id, forum_id) VALUES (' .
					$view_userdata['user_id'] . ', ' . htmlspecialchars(substr($key,6)) . ')';
					if ( !($result = $db->sql_query($sql))){
						$error = true;
						$error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . 'Could not insert into ' . DIGEST_FORUMS_TABLE . ' table';
   				}
				}
			}
		}
	}
	if ($error) message_die(GENERAL_ERROR, $error_msg);
}

?>
