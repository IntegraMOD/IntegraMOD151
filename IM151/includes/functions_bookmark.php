<?php
/***************************************************************************
 *                           functions_bookmark.php
 *                            -------------------
 *   begin                : Sun Dec 01, 2002
 *   copyright            : (C) 2004 Philipp Kordowich
 *                          Parts: (C) 2002 The phpBB Group
 *
 *   part of Bookmark Mod 1.1.1
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

//
// Checks whether a bookmark is set or not
//
function is_bookmark_set($topic_id)
{
	global $db, $userdata;

	$user_id = $userdata['user_id'];
	$sql = "SELECT topic_id, user_id
		FROM " . BOOKMARK_TABLE . " 
		WHERE topic_id = $topic_id AND user_id = $user_id";
	if ( $result = $db->sql_query($sql) )
	{
		$is_bookmark_set = ($db->sql_fetchrow($result)) ? (TRUE) : (FALSE);
	}
	else
	{
		message_die(GENERAL_ERROR, 'Could not obtain bookmark information', '', __LINE__, __FILE__, $sql);
		$is_bookmark_set = FALSE;
	}
	$db->sql_freeresult($result);
	
	return $is_bookmark_set;
}

//
// Sets a bookmark
//
function set_bookmark($topic_id)
{
	global $db, $userdata;

	$user_id = $userdata['user_id'];
	if ( !is_bookmark_set($topic_id, $user_id) )
	{
		$sql = "INSERT INTO " . BOOKMARK_TABLE . " (topic_id, user_id)
			VALUES ($topic_id, $user_id)";
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not insert bookmark information', '', __LINE__, __FILE__, $sql);
		}
	}
	return;
}

//
// Removes a bookmark
//
function remove_bookmark($topic_id)
{
	global $db, $userdata;

	$user_id = $userdata['user_id'];
	$sql = "DELETE FROM " . BOOKMARK_TABLE . "
		WHERE topic_id IN ($topic_id) AND user_id = $user_id";
	if ( !$db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not remove bookmark information', '', __LINE__, __FILE__, $sql);
	}
	return;
}
?>
