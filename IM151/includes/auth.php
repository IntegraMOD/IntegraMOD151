<?php
/***************************************************************************
 *                                 auth.php
 *                            -------------------                         
 *   begin                : Saturday, Feb 13, 2001 
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
// CTracker_Ignore: File Checked By Human

/*
	$type's accepted (pre-pend with AUTH_):
	VIEW, READ, POST, REPLY, EDIT, DELETE, STICKY, ANNOUNCE, VOTE, POLLCREATE, BAN, GREENCARD, BLUECARD, DOWNLOAD

	Possible options ($type/forum_id combinations):

	* If you include a type and forum_id then a specific lookup will be done and
	the single result returned

	* If you set type to AUTH_ALL and specify a forum_id an array of all auth types
	will be returned

	* If you provide a forum_id a specific lookup on that forum will be done

	* If you set forum_id to AUTH_LIST_ALL and specify a type an array listing the
	results for all forums will be returned

	* If you set forum_id to AUTH_LIST_ALL and type to AUTH_ALL a multidimensional
	array containing the auth permissions for all types and all forums for that
	user is returned

	All results are returned as associative arrays, even when a single auth type is
	specified.

	If available you can send an array (either one or two dimensional) containing the
	forum auth levels, this will prevent the auth function having to do its own
	lookup
*/
function auth($type, $forum_id, $userdata, $f_access = '')
{
	global $db, $lang;
	global $board_config;
//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
	global $tree;

	if ( !empty($tree['data']) )
	{
		$f_access = array();
		if ( !empty($forum_id) )
		{
			$idx = $tree['keys'][ POST_FORUM_URL . $forum_id ];
			$f_access = $tree['data'][$idx];
		}
		else
		{
			for ( $i = 0; $i < count($tree['data']); $i++ )
			{
				if ( $tree['type'][$i] == POST_FORUM_URL )
				{
					$f_access[] = $tree['data'][$i];
				}
			}
		}
	}
//-- fin mod : categories hierarchy ----------------------------------------------------------------

	switch( $type )
	{
		case AUTH_ALL:
//-- mod : announces -------------------------------------------------------------------------------
// here we added
//	, a.auth_global_announce
// and
//	, 'auth_global_announce
//-- modify
//-- mod : calendar --------------------------------------------------------------------------------
// here we added
//	, a.auth_cal
// and
//	, 'auth_cal'
//-- modify
			$a_sql = 'a.auth_view, a.auth_read, a.auth_news, a.auth_post, a.auth_reply, a.auth_edit, a.auth_delete, a.auth_cal, a.auth_sticky, a.auth_announce, a.auth_global_announce, a.auth_vote, a.auth_pollcreate, a.auth_delayedpost, a.auth_ban, a.auth_greencard, a.auth_bluecard';
			$auth_fields = array('auth_view', 'auth_read', 'auth_news', 'auth_post', 'auth_reply', 'auth_edit', 'auth_delete', 'auth_cal', 'auth_sticky', 'auth_announce', 'auth_global_announce', 'auth_vote', 'auth_pollcreate', 'auth_delayedpost', 'auth_ban', 'auth_greencard', 'auth_bluecard');
//-- fin mod : calendar ----------------------------------------------------------------------------
//-- fin mod : announces ---------------------------------------------------------------------------
			break;

		case AUTH_VIEW:
			$a_sql = 'a.auth_view';
			$auth_fields = array('auth_view');
			break;

		case AUTH_READ:
			$a_sql = 'a.auth_read';
			$auth_fields = array('auth_read');
			break;
		case AUTH_POST:
			$a_sql = 'a.auth_post';
			$auth_fields = array('auth_post');
			break;
		case AUTH_REPLY:
			$a_sql = 'a.auth_reply';
			$auth_fields = array('auth_reply');
			break;
		case AUTH_EDIT:
			$a_sql = 'a.auth_edit';
			$auth_fields = array('auth_edit');
			break;
		case AUTH_DELETE:
			$a_sql = 'a.auth_delete';
			$auth_fields = array('auth_delete');
			break;
//-- mod : calendar --------------------------------------------------------------------------------
//-- add
		case AUTH_CAL:
			$a_sql = 'a.auth_cal';
			$auth_fields = array('auth_cal');
			break;
//-- fin mod : calendar ----------------------------------------------------------------------------
		case AUTH_ANNOUNCE:
			$a_sql = 'a.auth_announce';
			$auth_fields = array('auth_announce');
			break;
//-- mod : announces -------------------------------------------------------------------------------
//-- add
		case AUTH_GLOBAL_ANNOUNCE:
			$a_sql = 'a.auth_global_announce';
			$auth_fields = array('auth_global_announce');
			break;
//-- fin mod : announces ---------------------------------------------------------------------------
		case AUTH_STICKY:
			$a_sql = 'a.auth_sticky';
			$auth_fields = array('auth_sticky');
			break;

		case AUTH_POLLCREATE:
			$a_sql = 'a.auth_pollcreate';
			$auth_fields = array('auth_pollcreate');
			break;
		case AUTH_VOTE:
			$a_sql = 'a.auth_vote';
			$auth_fields = array('auth_vote');
			break;
		case AUTH_ATTACH:
			break;
		case AUTH_DELAYEDPOST:
			$a_sql = 'a.auth_delayedpost';
			$auth_fields = array('auth_delayedpost');
			break;
		case AUTH_BAN: 
		   $a_sql = 'a.auth_ban'; 
		   $auth_fields = array('auth_ban'); 
		   break;
		case AUTH_GREENCARD: 
		   $a_sql = 'a.auth_greencard'; 
		   $auth_fields = array('auth_greencard'); 
		   break;
		case AUTH_BLUECARD: 
		   $a_sql = 'a.auth_bluecard'; 
		   $auth_fields = array('auth_bluecard'); 
		   break; 
		default:
			break;
	}
	attach_setup_basic_auth($type, $auth_fields, $a_sql);

	//
	// If f_access has been passed, or auth is needed to return an array of forums
	// then we need to pull the auth information on the given forum (or all forums)
	//
	if ( empty($f_access) )
	{
		$forum_match_sql = ( $forum_id != AUTH_LIST_ALL ) ? "WHERE a.forum_id = $forum_id" : '';

		$sql = "SELECT a.forum_id, $a_sql
			FROM " . FORUMS_TABLE . " a
			$forum_match_sql";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Failed obtaining forum access control lists', '', __LINE__, __FILE__, $sql);
		}

		$sql_fetchrow = ( $forum_id != AUTH_LIST_ALL ) ? 'sql_fetchrow' : 'sql_fetchrowset';

		if ( !($f_access = $db->$sql_fetchrow($result)) )
		{
			$db->sql_freeresult($result);
			return array();
		}

		$db->sql_freeresult($result);
	}

	//
	// If the user isn't logged on then all we need do is check if the forum
	// has the type set to ALL, if yes they are good to go, if not then they
	// are denied access
	//
	$u_access = array();
	if ( $userdata['session_logged_in'] )
	{
//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
		if ( isset( $userdata['user_forums_auth'] ) )
		{
			if ( $forum_id != AUTH_LIST_ALL)
			{
				$u_access[] = ( isset($userdata['user_forums_auth'][$forum_id]) ? $userdata['user_forums_auth'][$forum_id] : NULL ) ;
			}
			else
			{
				$u_access = $userdata['user_forums_auth'];
			}
		}
		else
		{
//-- fin mod : categories hierarchy ----------------------------------------------------------------

		$forum_match_sql = ( $forum_id != AUTH_LIST_ALL ) ? "AND a.forum_id = $forum_id" : '';

		$sql = "SELECT a.forum_id, $a_sql, a.auth_mod 
			FROM " . AUTH_ACCESS_TABLE . " a, " . USER_GROUP_TABLE . " ug 
			WHERE ug.user_id = ".$userdata['user_id']. " 
				AND ug.user_pending = 0 
				AND a.group_id = ug.group_id
				$forum_match_sql";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Failed obtaining forum access control lists', '', __LINE__, __FILE__, $sql);
		}

		if ( $row = $db->sql_fetchrow($result) )
		{
			do
			{
				if ( $forum_id != AUTH_LIST_ALL)
				{
					$u_access[] = $row;
				}
				else
				{
					$u_access[$row['forum_id']][] = $row;
				}
			}
			while( $row = $db->sql_fetchrow($result) );
		}
		$db->sql_freeresult($result);
//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
		}
//-- fin mod : categories hierarchy ----------------------------------------------------------------

	}

	$is_admin = ( $userdata['user_level'] == ADMIN && $userdata['session_logged_in'] ) ? TRUE : 0;

	$auth_user = array();
	for($i = 0; $i < count($auth_fields); $i++)
	{
		$key = $auth_fields[$i];

		//
		// If the user is logged on and the forum type is either ALL or REG then the user has access
		//
		// If the type if ACL, MOD or ADMIN then we need to see if the user has specific permissions
		// to do whatever it is they want to do ... to do this we pull relevant information for the
		// user (and any groups they belong to)
		//
		// Now we compare the users access level against the forums. We assume here that a moderator
		// and admin automatically have access to an ACL forum, similarly we assume admins meet an
		// auth requirement of MOD
		//
		if ( $forum_id != AUTH_LIST_ALL )
		{
			$value = $f_access[$key];

			switch( $value )
			{
				case AUTH_ALL:
					$auth_user[$key] = TRUE;
					$auth_user[$key . '_type'] = $lang['Auth_Anonymous_Users'];
					break;

				case AUTH_REG:
					$auth_user[$key] = ( $userdata['session_logged_in'] ) ? TRUE : 0;
					$auth_user[$key . '_type'] = $lang['Auth_Registered_Users'];
					break;

				case AUTH_ACL:
					$auth_user[$key] = ( $userdata['session_logged_in'] ) ? auth_check_user(AUTH_ACL, $key, $u_access, $is_admin) : 0;
					$auth_user[$key . '_type'] = $lang['Auth_Users_granted_access'];
					break;

				case AUTH_MOD:
					$auth_user[$key] = ( $userdata['session_logged_in'] ) ? auth_check_user(AUTH_MOD, 'auth_mod', $u_access, $is_admin) : 0;
					$auth_user[$key . '_type'] = $lang['Auth_Moderators'];
					break;

				case AUTH_ADMIN:
					$auth_user[$key] = $is_admin;
					$auth_user[$key . '_type'] = $lang['Auth_Administrators'];
					break;

				default:
					$auth_user[$key] = 0;
					break;
			}
		}
		else
		{
			for($k = 0; $k < count($f_access); $k++)
			{
				$value = $f_access[$k][$key];
				$f_forum_id = $f_access[$k]['forum_id'];
				
				$u_access[$f_forum_id] = isset($u_access[$f_forum_id]) ? $u_access[$f_forum_id] : array();				

				switch( $value )
				{
					case AUTH_ALL:
						$auth_user[$f_forum_id][$key] = TRUE;
						$auth_user[$f_forum_id][$key . '_type'] = $lang['Auth_Anonymous_Users'];
						break;

					case AUTH_REG:
						$auth_user[$f_forum_id][$key] = ( $userdata['session_logged_in'] ) ? TRUE : 0;
						$auth_user[$f_forum_id][$key . '_type'] = $lang['Auth_Registered_Users'];
						break;

					case AUTH_ACL:
						$auth_user[$f_forum_id][$key] = ( $userdata['session_logged_in'] ) ? auth_check_user(AUTH_ACL, $key, $u_access[$f_forum_id], $is_admin) : 0;
						$auth_user[$f_forum_id][$key . '_type'] = $lang['Auth_Users_granted_access'];
						break;

					case AUTH_MOD:
						$auth_user[$f_forum_id][$key] = ( $userdata['session_logged_in'] ) ? auth_check_user(AUTH_MOD, 'auth_mod', $u_access[$f_forum_id], $is_admin) : 0;
						$auth_user[$f_forum_id][$key . '_type'] = $lang['Auth_Moderators'];
						break;

					case AUTH_ADMIN:
						$auth_user[$f_forum_id][$key] = $is_admin;
						$auth_user[$f_forum_id][$key . '_type'] = $lang['Auth_Administrators'];
						break;

					default:
						$auth_user[$f_forum_id][$key] = 0;
						break;
				}
			}
		}
	}
	//is user a vip?
	$uservip = 0;
	if($userdata['user_rank'] > 0)
	{
		$sql = "SELECT r.rank_id, r.rank_title  
			FROM " . RANKS_TABLE . " r 
			WHERE r.rank_id = " . $userdata['user_rank'];
		if ( ($resultr = $db->sql_query($sql, false, 'ranks')) )
		{
			if( $rowr = $db->sql_fetchrow($resultr) )
			{
				if(strcmp($rowr['rank_title'], VIP_RANK_TITLE) == 0)
				{
					$uservip = 1;
				}
			}	
			$db->sql_freeresult($resultr);
		}
	}
	//or is it a temp vip: within trial period
	if($userdata['user_expire_date'] == 0 && time() <= ( $userdata['user_expire_date'] == 0 ? ($userdata['user_regdate'] + intval($board_config['lw_trial_period']) * 24 * 60 * 60) : (time() - 100)  ))
	{
		$uservip = 1;
	}
	//
	// Is user a moderator?
	//
	if ( $forum_id != AUTH_LIST_ALL )
	{
		$auth_user['auth_mod'] = ( $userdata['session_logged_in'] ) ? auth_check_user(AUTH_MOD, 'auth_mod', $u_access, $is_admin) : 0;
		if($uservip == 1)
		{
			$auth_user['auth_view'] = TRUE;
			$auth_user['auth_read'] = TRUE;
			$auth_user['auth_post'] = TRUE;
			$auth_user['auth_reply'] = TRUE;
			$auth_user['auth_edit'] = TRUE;
			$auth_user['auth_delete'] = TRUE;
			$auth_user['auth_vote'] = TRUE;
			$auth_user['auth_pollcreate'] = TRUE;
		}
	}
	else
	{
		for($k = 0; $k < count($f_access); $k++)
		{
			$f_forum_id = $f_access[$k]['forum_id'];
			
			$u_access[$f_forum_id] = isset($u_access[$f_forum_id]) ? $u_access[$f_forum_id] : array();

			$auth_user[$f_forum_id]['auth_mod'] = ( $userdata['session_logged_in'] ) ? auth_check_user(AUTH_MOD, 'auth_mod', $u_access[$f_forum_id], $is_admin) : 0;
			if($uservip == 1)
			{
				$auth_user[$f_forum_id]['auth_view'] = TRUE;
				$auth_user[$f_forum_id]['auth_read'] = TRUE;
				$auth_user[$f_forum_id]['auth_post'] = TRUE;
				$auth_user[$f_forum_id]['auth_reply'] = TRUE;
				$auth_user[$f_forum_id]['auth_edit'] = TRUE;
				$auth_user[$f_forum_id]['auth_delete'] = TRUE;
				$auth_user[$f_forum_id]['auth_vote'] = TRUE;
				$auth_user[$f_forum_id]['auth_pollcreate'] = TRUE;
			}
		}
	}

	return $auth_user;
}

function auth_check_user($type, $key, $u_access, $is_admin)
{
	$auth_user = 0;

	// V: this is when we pass in a single access record
	//    instead of an array thereof
  if ($u_access === null) $u_access = [];
	if (count($u_access) && !isset($u_access[0]))
	{
		$u_access = array($u_access);
	}

	if ( count($u_access) )
	{
		for($j = 0; $j < count($u_access); $j++)
		{
			$result = 0;
			switch($type)
			{
				case AUTH_ACL:
					$result = isset($u_access[$j][$key]) ? $u_access[$j][$key] : null;

				case AUTH_MOD:
					// V: this is probably hiding an auth bug earlier
					$result = $result || !empty($u_access[$j]['auth_mod']);

				case AUTH_ADMIN:
					$result = $result || $is_admin;
					break;
			}

			$auth_user = $auth_user || $result;
		}
	}
	else
	{
		$auth_user = $is_admin;
	}

	return $auth_user;
}
function get_moderators_user_id_of_forum($forum_id){ 
    // returns a pipe (|) delimited list of user_ids of moderators of a forum even if the moderators are inside a group 
    global $tree, $db; 
    $users = ''; 
    $groups = array(); 
    $idx = $tree['keys'][ POST_FORUM_URL . $forum_id ]; 
    if(!empty($tree['mods'][$idx]['user_id'])){ 
        $users = implode(',',$tree['mods'][$idx]['user_id']); 
        $userwhere = ' AND user_id not in ('.implode(',',$tree['mods'][$idx]['user_id']).')'; 
    } 
    if(!empty($tree['mods'][$idx]['group_id'])){ 
        $groups = implode(',',$tree['mods'][$idx]['group_id']); 
        $sql = "SELECT distinct user_id 
                FROM " . USER_GROUP_TABLE . " 
                WHERE user_pending = 0 AND group_id in ($groups) $userwhere"; 
        if (!($result = $db->sql_query($sql))) { 
                message_die(GENERAL_ERROR, 'Error getting group information', '', __LINE__, __FILE__, $sql); 
        } 
        $user_rows =  $db->sql_fetchrowset($result); 
        for ($i = 0; $i < count($user_rows); $i++) { 
            if ($i == 0 && !count($tree['mods'][$idx]['user_id'])) { 
                // no users in list yet so don't append a | 
                $users = $user_rows[$i]['user_id']; 
            } else { 
                $users .= '|'.$user_rows[$i]['user_id']; 
            } 
        } 
        $db->sql_freeresult($result); 
    } 
    return $users; 
}
?>
