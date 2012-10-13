<?php

/***************************************************************************
 *							user_invite.php
 *							-------------------
 *	last updated      : August 28, 2004
 *	copyright         : (c) 2004 Project Dream Views; icedawg
 *	email             : phpbbchatspot@dreamviews.com
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

/* **[DESCRIPTION]*********************************************************************************************************
		- contains functions used when inviting forum users to join rooms in chat.
	************************************************************************************************************************ */

if ( !defined( 'IN_PHPBB' ) || !defined( 'CHATSPOT' ) )
{
	die( "Hacking attempt" );
}

$phpbb_root_path = './../';
include_once( $phpbb_root_path . 'extension.inc' );
include_once( $phpbb_root_path . 'chatspot/chatspot_config.' . $phpEx );

function is_user_online( $username )
{
	global $db;

	$sql = "SELECT u.username 
		FROM " . USERS_TABLE . " u, " . SESSIONS_TABLE . " s 
		WHERE u.user_id = s.session_user_id
			AND s.session_time >= ".( time() - 300 ) . "
		ORDER BY u.username ASC, s.session_ip ASC";

	if( !( $result = $db->sql_query( $sql ) ) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain user/online information', '', __LINE__, __FILE__, $sql);
	}

	while( $row = $db->sql_fetchrow( $result ) )
	{
		if( strtolower( $row[ 'username' ] ) == strtolower( $username ) )
		{
			$db->sql_freeresult( $result );
			return TRUE;
		}
	}

	$db->sql_freeresult( $result );
	
	return FALSE;
}

function invite_user( $to_username, $from_userid, $from_username, $location, $room_name )
{
	global $board_config, $db;

	$sql = "SELECT *
		FROM " . USERS_TABLE . " 
		WHERE username = '" . $to_username . "' 
		AND user_id <> " . ANONYMOUS;
	
	if( !( $result = $db->sql_query( $sql ) ) ) // user is not a member of the forum
	{
		$db->sql_freeresult( $result );
		return FALSE;
	}
	
	$to_userdata = $db->sql_fetchrow( $result );

	$msg_time = time();

	// Do inbox limit stuff [the following code is taken from phpBB and modified slightly]
	$sql = "SELECT COUNT(privmsgs_id) AS inbox_items, MIN(privmsgs_date) AS oldest_post_time 
		FROM " . PRIVMSGS_TABLE . " 
		WHERE ( privmsgs_type = " . PRIVMSGS_NEW_MAIL . " 
				OR privmsgs_type = " . PRIVMSGS_READ_MAIL . "  
				OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " ) 
			AND privmsgs_to_userid = " . $to_userdata['user_id'];
	if( !( $result = $db->sql_query( $sql ) ) )
		return FALSE;

	$sql_priority = ( SQL_LAYER == 'mysql' ) ? 'LOW_PRIORITY' : '';

	if( $inbox_info = $db->sql_fetchrow( $result ) )
	{
		if( $inbox_info['inbox_items'] >= $board_config['max_inbox_privmsgs'] )
		{
			$sql = "SELECT privmsgs_id FROM " . PRIVMSGS_TABLE . " 
				WHERE ( privmsgs_type = " . PRIVMSGS_NEW_MAIL . " 
					OR privmsgs_type = " . PRIVMSGS_READ_MAIL . " 
					OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . "  ) 
					AND privmsgs_date = " . $inbox_info['oldest_post_time'] . " 
					AND privmsgs_to_userid = " . $to_userdata['user_id'];

			if( !$result = $db->sql_query( $sql ) )
				return FALSE;
			
			$old_privmsgs_id = $db->sql_fetchrow( $result );
			$old_privmsgs_id = $old_privmsgs_id[ 'privmsgs_id' ];
		
			$sql = "DELETE $sql_priority FROM " . PRIVMSGS_TABLE . " 
				WHERE privmsgs_id = $old_privmsgs_id";

			if( !$db->sql_query( $sql ) )
			{
				message_die(GENERAL_ERROR, 'Could not delete oldest privmsgs (inbox)'.$sql, '', __LINE__, __FILE__, $sql);
			}

			$sql = "DELETE $sql_priority FROM " . PRIVMSGS_TEXT_TABLE . " 
				WHERE privmsgs_text_id = $old_privmsgs_id";
			
			if( !$db->sql_query( $sql ) )
				return FALSE;
		}
	}

	$subject = sprintf($lang['Inviting_you'],$from_username);
	
	$message = sprintf($lang['Pm_invite'],$from_username,$room_name,"javascript:void(0);\" onClick=\"window.open( \'" . 
		$location . "\',\'" . $room_name . "\',\'scrollbars=no,resizable=yes,width=640,height=550\' ); return false;");

	$sql_info = "INSERT INTO " . PRIVMSGS_TABLE . " (privmsgs_type, privmsgs_subject, privmsgs_from_userid, privmsgs_to_userid, privmsgs_date, privmsgs_ip, privmsgs_enable_html, privmsgs_enable_bbcode, privmsgs_enable_smilies, privmsgs_attach_sig)
		VALUES (" . PRIVMSGS_NEW_MAIL . ", '" . str_replace( "\'", "''", $subject ) . "', " . $from_userid . ", " . $to_userdata['user_id'] . ", $msg_time, '$user_ip', 0, 0, 0, 0)"; // 1st zero is HTML

	if( !( $result = $db->sql_query( $sql_info, BEGIN_TRANSACTION ) ) )
		return FALSE;

	$privmsg_sent_id = $db->sql_nextid();

	$sql = "INSERT INTO " . PRIVMSGS_TEXT_TABLE . " (privmsgs_text_id, privmsgs_bbcode_uid, privmsgs_text)
		VALUES ($privmsg_sent_id, '', '" . str_replace("\'", "''", $message) . "')";

	if( !$db->sql_query( $sql, END_TRANSACTION ) )
		return FALSE;

	// Add to the users new pm counter   // = '9999999999'
	$sql = "UPDATE " . USERS_TABLE . "
		SET user_new_privmsg = user_new_privmsg + 1, user_last_privmsg = " . $msg_time . "
		WHERE user_id = " . $to_userdata['user_id']; 
	if ( !$status = $db->sql_query($sql) )
		return FALSE;

	return TRUE;
}

?>