<?php
/***************************************************************************
 *							  album_functions.php
 *                            -------------------
 *   begin                : Tuesday, February 04, 2003
 *   copyright            : (C) 2003 Smartor
 *   email                : smartor_xp@hotmail.com
 *
 *   $Id: album_functions.php,v 1.1.4 2003/04/03 21:08:31 ngoctu Exp $
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


// ------------------------------------
// All common functions are here!
// ------------------------------------
// You cannot call this file directly from your browser
//
if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
}




// ----------------------------------------------------------------------------
// This function will return the access data of the current user for a category
// Default returning value is "0" (means NOT AUTHORISED)
//
// All $*_check must be "1" or "0"
//
// $passed_auth must be a full row from ALBUM_CAT_TABLE. This function still works without
// ... but $passed_auth will make it worked very much faster (because this function is often
// called in a loop)
//
function album_user_access($cat_id, $passed_auth, $view_check, $upload_check, $rate_check, $comment_check, $edit_check, $delete_check)
{
	global $db, $album_config, $userdata;

	// --------------------------------
	// Force to check moderator status
	// --------------------------------
	$moderator_check = 1;


	// --------------------------------
	// Here the array which this function would return. Now we initiate it!
	// --------------------------------
	$album_user_access = array(
		'view' => 0,
		'upload' => 0,
		'rate' => 0,
		'comment' => 0,
		'edit' => 0,
		'delete' => 0,
		'moderator' => 0
	);
	$album_user_access_keys = array_keys($album_user_access);
	//
	// END initiation $album_user_access
	//


	// --------------------------------
	// Check $cat_id
	// --------------------------------
	if ($cat_id <= ALBUM_ROOT_CATEGORY && !is_array($passed_auth))
	{
		message_die(GENERAL_ERROR, 'Bad cat_id arguments for function album_user_access()');
	}
	//
	// END check $cat_id
	//


	// --------------------------------
	// If the current user is an ADMIN (ALBUM_ADMIN == ADMIN)
	// --------------------------------
	if ($userdata['user_level'] == ADMIN)
	{
		for ($i = 0; $i < count($album_user_access); $i++)
		{
			$album_user_access[$album_user_access_keys[$i]] = 1; // Authorised All
		}

		//
		// Function EXIT here
		//
		return $album_user_access;
	}
	//
	// END check ADMIN
	//


	// --------------------------------
	// if this is a GUEST, we will ignore some checking
	// --------------------------------
	if (!$userdata['session_logged_in'])
	{
		$edit_check = 0;
		$delete_check = 0;
		$moderator_check = 0;
	}
	//
	// END check GUEST
	//


	// --------------------------------
	// check if RATE or COMMENT are turned off by Album Config, so we can ignore them
	// --------------------------------
	if ($album_config['rate'] == 0)
	{
		$rate_check = 0;
	}
	if ($album_config['comment'] == 0)
	{
		$comment_check = 0;
	}
	//
	// END Check RATE & COMMENT
	//


	// --------------------------------
	// The array that list all access type this function will look for (except MODERATOR)
	// --------------------------------
	$access_type = array();

	if ($view_check != 0)
	{
		$access_type[] = 'view';
	}

	if ($upload_check != 0)
	{
		$access_type[] = 'upload';
	}

	if ($rate_check != 0)
	{
		$access_type[] = 'rate';
	}

	if ($comment_check != 0)
	{
		$access_type[] = 'comment';
	}

	if ($edit_check != 0)
	{
		$access_type[] = 'edit';
	}

	if ($delete_check != 0)
	{
		$access_type[] = 'delete';
	}
	//
	// END generating array $access_type
	//


	// --------------------------------
	// If everything is empty
	// --------------------------------
	if( empty($access_type) && (!$moderator_check) )
	{
		//
		// Function EXIT here
		//
		return $album_user_access;
	}
	//
	// END check empty
	//


	// --------------------------------
	// Generate the SQL query based on $access_type and $moderator_check
	// --------------------------------
		$sql = 'SELECT cat_id, cat_user_id';


	for ($i = 0; $i < count($access_type); $i++)
	{
		$sql .= ', cat_'. $access_type[$i] .'_level, cat_'. $access_type[$i] .'_groups';
	}

	if ($moderator_check)
	{
		$sql .= ', cat_moderator_groups';
	}

	$sql .= "
			FROM ". ALBUM_CAT_TABLE ."
			WHERE cat_id = '$cat_id'";
	//
	// END SQL query generating
	//


	// --------------------------------
	// Query the $sql then Fetchrow if $passed_auth == 0
	// --------------------------------
	if( !is_array($passed_auth) )
	{
		if( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not query Album Category information' ,'' , __LINE__, __FILE__, $sql);
		}

		$thiscat = $db->sql_fetchrow($result);
	}
	else
	{
		$thiscat = $passed_auth;
	}
	//
	// END Query and Fetchrow
	//


	// --------------------------------
	// Maybe the access level is not PRIVATE or the groups list is empty
	// ... so we can skip some queries ;)
	// --------------------------------
	$groups_access = array();
	for ($i = 0; $i < count($access_type); $i++)
	{
		switch ($thiscat['cat_'. $access_type[$i] .'_level'])
		{
			case ALBUM_GUEST:
				$album_user_access[$access_type[$i]] = 1;
				break;

			case ALBUM_USER:
				if ($userdata['session_logged_in'])
				{
					$album_user_access[$access_type[$i]] = 1;
				}
				break;

			case ALBUM_PRIVATE:
				if( ($thiscat['cat_'. $access_type[$i] .'_groups'] != '') and ($userdata['session_logged_in']) )
				{
					$groups_access[] = $access_type[$i];
				}
				break;

			case ALBUM_MOD:
				// this will be checked later
				break;

			case ALBUM_ADMIN:
				// ADMIN already returned before at the checking code
				// at the top of this function. So this user cannot be authorised
				$album_user_access[$access_type[$i]] = 0;
				break;

			default:
				$album_user_access[$access_type[$i]] = 0;
		}
	}
	//
	// END Check Access Level
	//


	// --------------------------------
	// We can return now if $groups_access is empty AND $moderator_check == 0
	// --------------------------------
	if( ($moderator_check == 1) && ($thiscat['cat_moderator_groups'] != '') )
	{
		// We can merge them now
		$groups_access[] = 'moderator';
	}

	if (empty($groups_access))
	{
		//
		// Function EXIT here
		//
		return $album_user_access;
	}


	// --------------------------------
	// Now we have the list of usergroups have PRIVATE/MODERATOR access
	// So we will check if this user is in these usergroups or not...
	// --------------------------------
	// upto (6 + 1) loops maximum when this user logged in and All Levels
	// are set to PRIVATE and this function was called to check all.
	// So avoiding PRIVATE will speed up your album. However, these queries are very fast
	for ($i = 0; $i < count($groups_access); $i++)
	{
		$sql = "SELECT group_id, user_id
				FROM ". USER_GROUP_TABLE ."
				WHERE user_id = '". $userdata['user_id'] ."' AND user_pending = 0
					AND group_id IN (". $thiscat['cat_'. $groups_access[$i] .'_groups'] .")";
		if( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not query User-Group information' ,'' , __LINE__, __FILE__, $sql);
		}

		if( $db->sql_numrows($result) > 0 )
		{
			$album_user_access[$groups_access[$i]] = 1;
		}
	}
	//
	// END check PRIVATE/MODERATOR groups
	//


	// --------------------------------
	// If $moderator_check was called and this user is a MODERATOR he
	// will be authorised for all accesses which were not set to ADMIN
	// --------------------------------
	if( ($album_user_access['moderator'] == 1) && ($moderator_check == 1) )
	{
		for ($i = 0; $i < count($album_user_access); $i++)
		{
			if( $thiscat['cat_'. $album_user_access_keys[$i] .'_level'] != ALBUM_ADMIN )
			{
				$album_user_access[$album_user_access_keys[$i]] = 1;
			}
		}
	}
	//
	// END Moderator
	//


	// --------------------------------
	// Return result...
	// --------------------------------
	return $album_user_access;
}
//
// END function album_user_access()
// ----------------------------------------------------------------------------



// ----------------------------------------------------------------------------
// This function will check the access (VIEW, UPLOAD) of current user on
// any personal galleries
function personal_gallery_access($check_view, $check_upload)
{
	global $db, $userdata, $album_config;

	// This array will contain the result
	$personal_gallery_access = array(
		'view' => 0,
		'upload' => 0,
	);

	// --------------------------------
	// Who can create personal gallery?
	// --------------------------------
	if ($check_upload)
	{
		switch ($album_config['personal_gallery'])
		{
			case ALBUM_USER:
				if ($userdata['session_logged_in'])
				{
					$personal_gallery_access['upload'] = 1;
				}
				break;

			case ALBUM_PRIVATE:
				if( ($userdata['session_logged_in']) and ($userdata['user_level'] == ADMIN) )
				{
					$personal_gallery_access['upload'] = 1;
				}
				else if(!empty($album_config['personal_gallery_private']) and $userdata['session_logged_in'])
				{
					$sql = "SELECT group_id, user_id
							FROM ". USER_GROUP_TABLE ."
							WHERE user_id = '". $userdata['user_id'] ."' AND user_pending = 0
								AND group_id IN (". $album_config['personal_gallery_private'] .")";
					if( !$result = $db->sql_query($sql) )
					{
						message_die(GENERAL_ERROR, 'Could not query User-Group information' ,'' , __LINE__, __FILE__, $sql);
					}

					if( $db->sql_numrows($result) > 0 )
					{
						$personal_gallery_access['upload'] = 1;
					}
				}
				break;

			case ALBUM_ADMIN:
				if( ($userdata['session_logged_in']) and ($userdata['user_level'] == ADMIN) )
				{
					$personal_gallery_access['upload'] = 1;
				}
				break;
		}
	}

	// --------------------------------
	// Who can view other personal gallery?
	// --------------------------------
	if ($check_view)
	{
		switch ($album_config['personal_gallery_view'])
		{
			case ALBUM_GUEST:
				$personal_gallery_access['view'] = 1;
				break;

			case ALBUM_USER:
				if ($userdata['session_logged_in'])
				{
					$personal_gallery_access['view'] = 1;
				}
				break;

			case ALBUM_PRIVATE:
				if( ($userdata['session_logged_in']) and ($userdata['user_level'] == ADMIN) )
				{
					$personal_gallery_access['view'] = 1;
				}
				else if(!empty($album_config['personal_gallery_private']) and $userdata['session_logged_in'])
				{
					$sql = "SELECT group_id, user_id
							FROM ". USER_GROUP_TABLE ."
							WHERE user_id = '". $userdata['user_id'] ."' AND user_pending = 0
								AND group_id IN (". $album_config['personal_gallery_private'] .")";
					if( !$result = $db->sql_query($sql) )
					{
						message_die(GENERAL_ERROR, 'Could not query User-Group information' ,'' , __LINE__, __FILE__, $sql);
					}

					if( $db->sql_numrows($result) > 0 )
					{
						$personal_gallery_access['view'] = 1;
					}
				}
				break;
		}
	}

	return $personal_gallery_access;
}
//
// END function personal_gallery_access()
// ----------------------------------------------------------------------------


// ----------------------------------------------------------------------------
// Build up the array similar to $thiscat array
//
function init_personal_gallery_cat($user_id = 0)
{
	global $userdata, $db, $lang, $album_config;

	if ($user_id == 0)
	{
		$user_id = $userdata['user_id'];
	}

	$sql = "SELECT COUNT(pic_id) AS count
			FROM ". ALBUM_TABLE .", ". ALBUM_CAT_TABLE . "
			WHERE pic_cat_id = cat_id
				AND cat_user_id = ". $user_id;

	if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not count pics for this personal gallery', '', __LINE__, __FILE__, $sql);
	}

	$row = $db->sql_fetchrow($result);

	$count = $row['count'];

	if ($user_id != $userdata['user_id'])
	{
		$sql = "SELECT user_id, username
				FROM ". USERS_TABLE ."
				WHERE user_id = $user_id";

		if( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain user information', '', __LINE__, __FILE__, $sql);
		}

		$user_row = $db->sql_fetchrow($result);
		$username = $user_row['username'];
	}
	else
	{
		$username = $userdata['username'];
	}

	$thiscat = array(
		'cat_id' => 0,
		'cat_title' => sprintf($lang['Personal_Gallery_Of_User'], $username),
		'cat_desc' => '',
		'cat_order' => 0,
		'count' => $count,
		'personal' => 1,
		'cat_user_id' => $user_id,
		'cat_view_level' => $album_config['personal_gallery_view'],
		'cat_upload_level' => $album_config['personal_gallery'],
		'cat_rate_level' => $album_config['personal_gallery_view'],
		'cat_comment_level' => $album_config['personal_gallery_view'],
		'cat_edit_level' => $album_config['personal_gallery'],
		'cat_delete_level' => $album_config['personal_gallery'],
		'cat_view_groups' => $album_config['personal_gallery_private'],
		'cat_upload_groups' => $album_config['personal_gallery_private'],
		'cat_rate_groups' => $album_config['personal_gallery_private'],
		'cat_comment_groups' => $album_config['personal_gallery_private'],
		'cat_edit_groups' => $album_config['personal_gallery_private'],
		'cat_delete_groups' => $album_config['personal_gallery_private'],
		'cat_delete_groups' => $album_config['personal_gallery_private'],
		'cat_moderator_groups' => '',
		'cat_approval' => 0
	);

	return $thiscat;
}
//
// END function init_personal_gallery_cat()
// ----------------------------------------------------------------------------


// ----------------------------------------------------------------------------
// You must keep my copyright notice with its original content visible
// Do NOT modify anything!!!
function album_end()
{
	global $album_config;

	echo '<div align="center" style="font-family: Verdana; font-size: 10px; letter-spacing: -1px">Powered by Photo Album Addon 2' . $album_config['album_version'] . ' &copy; 2002, 2003 <a href="http://smartor.is-root.com" target="_blank">Smartor</a></div>';
}
//
// OR you can pay me for the copyright notice removal. Contact me!
// ----------------------------------------------------------------------------

//--- Multiple File Upload - BEGIN
// ----------------------------------------------------------------
// check if the file at index $index was uploaded
// ----------------------------------------------------------------
function was_file_uploaded($files_array, $index)
{
	if ( @phpversion() < '4.2.0' )
	{
		return ( (empty($files_array['tmp_name'][$index]) || $files_array['tmp_name'][$index] == 'none') || $files_array['size'][$index] == 0 ) ? false : true;
	}
	else
	{
		return ( ((empty($files_array['tmp_name'][$index]) || $files_array['tmp_name'][$index] == 'none') || $files_array['size'][$index] == 0) || $files_array['error'][$index] == 4) ? false : true;
	}
}

// ----------------------------------------------------------------
// check if the file has exceeded the maximum allowed file upload
// set in php.ini
// ----------------------------------------------------------------
function file_uploaded_exceeds_max_size($files_array, $index)
{
	// for some bizar reason I can't get the next few lines to work right 'error' is always = 0
	if (@phpversion() >= '4.2.0')
	{
		// UPLOAD_ERR_INI_SIZE == 1 (was first defined in 4.3.0, so 1 here instead)
		return ($files_array['error'][$index] == 1) ? true : false;
	}
	else
	{
		// earlier version of PHP (before 4.2.0) the error associated array didn't exist
		// so we need to TRY to check if the file was too big
		// the rule is the following (not fool proof):
		//
		// if 'name' isn't empty BUT 'tmp_name' and 'size' are empty (or for size = 0)
		// then we must have exceeded our max file size (or another error occured)
		return ( !empty($files_array['name'][$index]) && ( (empty($files_array['tmp_name'][$index]) || $files_array['tmp_name'][$index] == 'none') &&  $files_array['size'][$index] == 0 ) ) ? true : false;
	}
}

// ----------------------------------------------------------------
// generates a picture title, depending on the parameter supplied
// ----------------------------------------------------------------
function generate_picture_title($file_name, $pic_title, $pic_filetype)
{
	global $album_config;

	static $counter = 1;

	// if the user didn't supply a picture title then generate it from the
	// picture filename..and clean it up (remove trailing space, underscores and propercase it)
	if ( empty($pic_title) )
	{
		// remove file extension,
		// NOTE : were do a lowecase of the filename, to ensure that extension with in BIG or misc cApS get removed also
		$pic_title = str_replace($pic_filetype, '', strtolower($file_name));
		// remove underscores '_' and traling spaces
		$pic_title = trim(str_replace('_', ' ', $pic_title));

		if ($album_config['propercase_pic_title'] == 1)
		{
			// convert the first character in each word to upper case and the rest to lower case
			$pic_title = ucwords(strtolower($pic_title));
		}
		/*
		else
		{
			// convert only the first character in a string to upper case, the rest to lower case
			$pic_title = ucfirst(strtolower($pic_title));
		}
		*/
	}
	else
	{
		if ($album_config['propercase_pic_title'] == 1)
		{
			// convert the first character in each word to upper case and the rest to lower case
			$pic_title = ucwords(strtolower($pic_title));
		}
		/*
		else
		{
			// convert only the first character in a string to upper case, the rest to lower case
			$pic_title = ucfirst(strtolower($pic_title));
		}
		*/
		switch ($counter)
		{
			case ($counter < 10):
				$pic_title .= ' - 00' . $counter;
				break;
			case (($counter >= 10) && ($counter < 100)):
				$pic_title .= ' - 0' . $counter;
				break;
			default:
				$pic_title .= ' - ' . $counter;
				break;
		}
		$counter++;
	}

	return $pic_title;
}
//--- Multiple File Upload - END

function generate_single_pic_title($file_name, $pic_title, $pic_filetype)
{
	global $album_config;

	// if the user didn't supply a picture title then generate it from the
	// picture filename and clean it up (remove trailing space, underscores and propercase it)
	if ( empty($pic_title) )
	{
		// remove file extension,
		// NOTE : were do a lowecase of the filename, to ensure that extension with in BIG or misc cApS get removed also
		$pic_title = str_replace($pic_filetype, '', strtolower($file_name));
		// remove underscores '_' and traling spaces
		$pic_title = trim(str_replace('_', ' ', $pic_title));

		if ($album_config['propercase_pic_title'] == 1)
		{
			// convert the first character in each word to upper case and the rest to lower case
			$pic_title = ucwords(strtolower($pic_title));
		}
		/*
		else
		{
			// convert only the first character in a string to upper case, the rest to lower case
			$pic_title = ucfirst(strtolower($pic_title));
		}
		*/
	}
	else
	{
		if ($album_config['propercase_pic_title'] == 1)
		{
			// convert the first character in each word to upper case and the rest to lower case
			$pic_title = ucwords(strtolower($pic_title));
		}
		/*
		else
		{
			// convert only the first character in a string to upper case, the rest to lower case
			$pic_title = ucfirst(strtolower($pic_title));
		}
		*/
	}

	return $pic_title;
}

// +------------------------------------------------------+
// |  Powered by Photo Album 2.x.x (c) 2002-2003 Smartor  |
// +------------------------------------------------------+


?>
