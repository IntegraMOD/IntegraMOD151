<?php

/***************************************************************************
 *							functions_profile.php
 *							---------------------
 *	begin				: 08/05/2003
 *	copyright			: Ptirhiik
 *	email				: admin@rpgnet-fr.com
 *
 *	version				: 1.1.2 - 24/10/2003
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

if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
	exit;
}

if ( $is_called == FALSE )
{
	//-------------------------------------------
	//
	//	users administrators
	//
	//-------------------------------------------
	$admin_level = array(ADMIN_FOUNDER, ADMIN, JADMIN);
	$level_prior = array(ADMIN_FOUNDER => 99, ADMIN => 9, JADMIN => 7, MOD => 5, USER => 0);
	$level_desc = array(ADMIN_FOUNDER => 'Admin_founder_online_color', ADMIN => 'Admin_online_color', JADMIN => 'Jadmin_online_color', MOD => 'Mod_online_color', USER => 'User_online_color');

	function get_user_level($userdata)
	{
		// fix a phpBB bug
		global $db, $portal_config, $var_cache;
		if ($userdata['user_level'] == MOD)
		{
			$num_rows = FALSE;
			if($portal_config['cache_enabled'])
			{
				$num_rows = $var_cache->get('mod' . strval($userdata['user_id']), 200000, 'mod');
			}
			if($num_rows === FALSE)
			{
				$sql = "SELECT * FROM " . AUTH_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug
						WHERE ug.user_id = " . $userdata['user_id'] . "
							AND aa.group_id = ug.group_id
							AND aa.auth_mod = 1
							AND ug.user_pending = 0";
				if ( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not obtain moderator status', '', __LINE__, __FILE__, $sql);
				}
				$num_rows = $db->sql_numrows($result);
				if($portal_config['cache_enabled'])
				{
					$var_cache->save($num_rows, 'mod' . strval($userdata['user_id']), 'mod');
				}
			}
			if ($num_rows <= 0)
			{
				$userdata['user_level'] = USER;
			}
		}

		$jadmin_ary = array();
		if(!empty($portal_config['cache_enabled']))
		{
			$jadmin_ary=$var_cache->get('jadmin', 200000, 'jadmin');
		}
		
		if($jadmin_ary === FALSE)
		{
			$sql = "SELECT user_id FROM " . JR_ADMIN_TABLE . "
					WHERE user_jr_admin <> ''";
			if ( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not obtain junior admin status', '', __LINE__, __FILE__, $sql);
			}

	        while( $db->sql_fetchrow($result) !== false )
	        {
	            $jadmin_ary[] = $row['user_id'];
	        }
	        if($db->sql_numrows($result) == 0)
	        {
	            $jadmin_ary[] = -10;
	        }
	        if($portal_config['cache_enabled'])
	        {
	            $var_cache->save($jadmin_ary, 'jadmin', 'jadmin');
	        }
		}

		$res = USER;
		if ( ($userdata['user_level'] == ADMIN) && ($userdata['user_id'] == 2) )
		{
			$res = ADMIN_FOUNDER;
		}
		else if ($userdata['user_level'] == ADMIN)
		{
			$res = ADMIN;
		}
		else if (is_array($jadmin_ary))
		{
			if (in_array($userdata['user_id'], $jadmin_ary))
			{
				$res = JADMIN;
			}
			else if ($userdata['user_level'] == MOD)
			{
				$res = MOD;
			}
			else
			{
				$res = USER;
			}
		}
		else if ($userdata['user_level'] == MOD)
		{
			$res = MOD;
		}
		else
		{
			$res = USER;
		}
		return $res;
	}

	function is_admin($userdata)
	{
		global $admin_level;

		return in_array(get_user_level($userdata),$admin_level);
	}

	//-------------------------------------------
	//
	//	ranks management
	//
	//-------------------------------------------
	function init_ranks(&$ranks)
	{
		global $db;

		$sql = "SELECT * FROM " . RANKS_TABLE . " ORDER BY rank_special DESC, rank_min";
		if ( !$result = $db->sql_query($sql, false, 'ranks') )
		{
			message_die(GENERAL_ERROR, 'Could not obtain ranks information.', '', __LINE__, __FILE__, $sql);
		}
		$ranks = $db->sql_fetchrowset($result);
		$db->sql_freeresult($result);

		$rank_maxi = 99999999;
		foreach ($ranks as $row)
		{
			if ( $row['rank_special'] ) $row['rank_mini'] = 0;
			$row['rank_maxi'] = $rank_maxi;
			if (!$row['rank_special'] ) 
			{
				$rank_maxi = ( isset($row['rank_mini']) ? $row['rank_mini'] : 0 );
			}
			else $rank_maxi = 99999999;
		}
	}

	$all_ranks = array();
	init_ranks($all_ranks);

	function get_user_rank($userrow)
	{
		global $all_ranks;

		if(empty($all_ranks)){
			$all_ranks = array();
			init_ranks($all_ranks);
		}

		$rank_title = '';
		$rank_image = '';
		if ($userrow['user_id'] != ANONYMOUS)
		{
			if ( $userrow['user_rank'] )
			{
				$found = false;
				for ($i = 0; ( ($i < count($all_ranks)) && !$found); $i++)
				{
					$found = ( ($userrow['user_rank'] == $all_ranks[$i]['rank_id']) && $all_ranks[$i]['rank_special']);
					if ($found)
					{
						$ranks = explode( "|", $all_ranks[$i]['rank_title']);
						$rank_title = ( isset($ranks[$userrow['user_gender']]) && ($ranks[$userrow['user_gender']] != '') ) ? $ranks[$userrow['user_gender']] : $ranks[0];
						$rank_image = ( $all_ranks[$i]['rank_image'] ) ? '<img src="' . $all_ranks[$i]['rank_image'] . '" alt="' . $rank_title . '" title="' . $rank_title . '" border="0" />' : '';
					}
				}
			}
			else
			{
				for($i = 0; $i < count($all_ranks); $i++)
				{
					if ( $userrow['user_posts'] >= $all_ranks[$i]['rank_min'] && !$all_ranks[$i]['rank_special'] )
					{
						$ranks = explode( "|", $all_ranks[$i]['rank_title']);
						$rank_title = ( isset($ranks[$userrow['user_gender']]) && ($ranks[$userrow['user_gender']] != '') ) ? $ranks[$userrow['user_gender']] : $ranks[0];
						$rank_image = ( $all_ranks[$i]['rank_image'] ) ? '<img src="' . $all_ranks[$i]['rank_image'] . '" alt="' . $rank_title . '" title="' . $rank_title . '" border="0" />' : '';
					}
				}
			}
		}

		// result
		$res = array();
		$res['rank_title'] = $rank_title;
		$res['rank_image'] = $rank_image;
		return $res;
	}

	//-------------------------------------------
	//
	//	others functions
	//
	//-------------------------------------------
	function pcp_gen_rand_string($hash)
	{

	$rand_str = dss_rand();

	return ( $hash ) ? md5($rand_str) : substr($rand_str, 0, 8);
	}

	function prepare_signature( $signature, $view_userdata )
	{
		global $board_config, $lang;

		$preview_sig = ($signature != '') ? $signature : '';
		$user_sig_bbcode_uid = $view_userdata['user_sig_bbcode_uid'];

		// delete html tags
		if ( $preview_sig != '' && $view_userdata['user_allowhtml'] && !$board_config['allow_html'] )
		{
			$preview_sig = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $preview_sig);
		}

		// parse bbcodes
		if ( $preview_sig != '' && $user_sig_bbcode_uid != '' && $board_config['allow_bbcode'])
		{
			$preview_sig = ( $board_config['allow_bbcode'] ) ? bbencode_second_pass($preview_sig, $user_sig_bbcode_uid) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $preview_sig);
		}

		// add links
		if ( $preview_sig != '' ) $preview_sig = make_clickable($preview_sig);

		// parse smilies
		if ( $preview_sig != '' && $view_userdata['user_allowsmile'] && $board_config['allow_smilies'] )
		{
			$preview_sig = smilies_pass($preview_sig);
		}

		// formate \n 
		if ( $preview_sig != '' ) $preview_sig = str_replace("\n", "\n<br />\n", $preview_sig);

		return $preview_sig;
	}

	function pcp_check_image_type(&$type, &$error, &$error_msg)
	{
		global $lang;

		switch( $type )
		{
			case 'jpeg':
			case 'pjpeg':
			case 'jpg':
				return '.jpg';
				break;
			case 'gif':
				return '.gif';
				break;
			case 'png':
				return '.png';
				break;
			default:
				$error = true;
				$error_msg = (!empty($error_msg)) ? $error_msg . '<br />' . $lang['Avatar_filetype'] : $lang['Avatar_filetype'];
				break;
		}

		return false;
	}

	function pcp_user_avatar_delete($avatar_type, $avatar_file)
	{
		global $board_config, $userdata;

		if ( $avatar_type == USER_AVATAR_UPLOAD && $avatar_file != '' )
		{
			if ( @file_exists(@phpbb_realpath('./' . $board_config['avatar_path'] . '/' . $avatar_file)) )
			{
				@unlink('./' . $board_config['avatar_path'] . '/' . $avatar_file);
			}
		}

		return " user_avatar = '', user_avatar_type = " . USER_AVATAR_NONE;
	}

	function pcp_user_avatar_gallery(&$error, &$error_msg, $avatar_filename, $avatar_category)
	{
		global $board_config;

		if(!preg_match('/(\.gif$|\.png$|\.jpg|\.jpeg)$/is', $avatar_filename))
		{
			return '';
		}

		if ( file_exists(@phpbb_realpath($board_config['avatar_gallery_path'] . '/' . $avatar_category . '/' . $avatar_filename)) )
		{
			$return = " user_avatar = '" . str_replace("\'", "''", $avatar_category . '/' . $avatar_filename) . "', user_avatar_type = " . USER_AVATAR_GALLERY;
		}
		else
		{
			$return = '';
		}
		return $return;
	}

	function pcp_user_avatar_url(&$error, &$error_msg, $avatar_filename)
	{
		global $lang;

		$width = $height = 0;

		if ( !preg_match('#^(http)|(ftp):\/\/#i', $avatar_filename) )
		{
			$avatar_filename = 'http://' . $avatar_filename;
		}

		if ( !preg_match("#^((ht|f)tp://)([^ \?&=\#\"\n\r\t<]*?(\.(jpg|jpeg|gif|png))$)#is", $avatar_filename) )
		{
			$error = true;
			$error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $lang['Wrong_remote_avatar_format'] : $lang['Wrong_remote_avatar_format'];
			return;
		}
	 	$sizes = @getimagesize($tmp_filename);
		$width = $sizes[0];
		$height = $sizes[1];
		$type = $sizes[2];

      if ( ($width > $board_config['avatar_max_width']) || ($height > $board_config['avatar_max_height']) ) 
      { 
         $l_avatar_size = sprintf($lang['Avatar_imagesize'], $board_config['avatar_max_width'], $board_config['avatar_max_height']); 

         $error = true; 
         $error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $l_avatar_size : $l_avatar_size; 
         return; 
      } 
		return " user_avatar = '" . str_replace("\'", "''", $avatar_filename) . "', user_avatar_type = " . USER_AVATAR_REMOTE;

   }

function pcp_user_avatar_upload($avatar_mode, &$current_avatar, &$current_type, &$error, &$error_msg, $avatar_filename, $avatar_realname, $avatar_filesize, $avatar_filetype)
{
	global $board_config, $db, $lang;

	$ini_val = ( @phpversion() >= '4.0.0' ) ? 'ini_get' : 'get_cfg_var';

	$width = $height = 0;
	$type = '';

	if ( $avatar_mode == 'remote' && preg_match('/^(http:\/\/)?([\w\-\.]+)\:?([0-9]*)\/(.*)$/', $avatar_filename, $url_ary) )
	{
		if ( empty($url_ary[4]) )
		{
			$error = true;
			$error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $lang['Incomplete_URL'] : $lang['Incomplete_URL'];
			return;
		}

		$base_get = '/' . $url_ary[4];
		$port = ( !empty($url_ary[3]) ) ? $url_ary[3] : 80;

		if ( !($fsock = @fsockopen($url_ary[2], $port, $errno, $errstr)) )
		{
			$error = true;
			$error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $lang['No_connection_URL'] : $lang['No_connection_URL'];
			return;
		}

		@fputs($fsock, "GET $base_get HTTP/1.1\r\n");
		@fputs($fsock, "HOST: " . $url_ary[2] . "\r\n");
		@fputs($fsock, "Connection: close\r\n\r\n");

		unset($avatar_data);
		while( !@feof($fsock) )
		{
			// Start replacement - Signatures control MOD
			$avatar_data .= @fread($fsock, ( $board_config['sig_max_img_av_files_size'] ) ? $board_config['sig_max_img_av_files_size'] : $board_config['avatar_filesize']);
			// End replacement - Signatures control MOD
		}
		@fclose($fsock);

		if (!preg_match('#Content-Length\: ([0-9]+)[^ /][\s]+#i', $avatar_data, $file_data1) || !preg_match('#Content-Type\: image/[x\-]*([a-z]+)[\s]+#i', $avatar_data, $file_data2))
		{
			$error = true;
			$error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $lang['File_no_data'] : $lang['File_no_data'];
			return;
		}

		$avatar_filesize = $file_data1[1]; 
		$avatar_filetype = $file_data2[1]; 

		if ( ($avatar_filesize > 0 && $avatar_filesize < $board_config['avatar_filesize']) || $board_config['sig_max_img_av_files_size'] )
		{
			$avatar_data = substr($avatar_data, strlen($avatar_data) - $avatar_filesize, $avatar_filesize);

			$tmp_path = ( !@$ini_val('safe_mode') ) ? '/tmp' : './' . $board_config['avatar_path'] . '/tmp';
			$tmp_filename = tempnam($tmp_path, uniqid(rand()) . '-');

			$fptr = @fopen($tmp_filename, 'wb');
			$bytes_written = @fwrite($fptr, $avatar_data, $avatar_filesize);
			@fclose($fptr);

			if ( $bytes_written != $avatar_filesize )
			{
				@unlink($tmp_filename);
				message_die(GENERAL_ERROR, 'Could not write avatar file to local storage. Please contact the board administrator with this message', '', __LINE__, __FILE__);
			}

			$sizes = @getimagesize($tmp_filename);
			$width = $sizes[0];
			$height = $sizes[1];
			$type = $sizes[2];
		}
		else
		{
			$l_avatar_size = sprintf($lang['Avatar_filesize'], round($board_config['avatar_filesize'] / 1024));

			$error = true;
			$error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $l_avatar_size : $l_avatar_size;
		}
	}
	else if ( ( file_exists(@phpbb_realpath($avatar_filename)) ) && preg_match('/\.(jpg|jpeg|gif|png)$/i', $avatar_realname) )
	{
		if ( $avatar_filesize <= $board_config['avatar_filesize'] && ($avatar_filesize > 0) || $board_config['sig_max_img_av_files_size'])
		{
			preg_match('#image\/[x\-]*([a-z]+)#', $avatar_filetype, $avatar_filetype);
			$avatar_filetype = $avatar_filetype[1];
		}
		else
		{
			$l_avatar_size = sprintf($lang['Avatar_filesize'], round($board_config['avatar_filesize'] / 1024));

			$error = true;
			$error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $l_avatar_size : $l_avatar_size;
			return;
		}

		$sizes = @getimagesize($avatar_filename);
		$width = $sizes[0];
		$height = $sizes[1];
		$type = $sizes[2];
	}

	if ( !($imgtype = pcp_check_image_type($avatar_filetype, $error, $error_msg)) )
	{
		return;
	}

	switch ($type)
	{
		// GIF
		case 1:
			if ($imgtype != '.gif')
			{
				@unlink($tmp_filename);
				message_die(GENERAL_ERROR, 'Unable to upload file', '', __LINE__, __FILE__);
			}
		break;

		// JPG, JPC, JP2, JPX, JB2
		case 2:
		case 9:
		case 10:
		case 11:
		case 12:
			if ($imgtype != '.jpg' && $imgtype != '.jpeg')
			{
				@unlink($tmp_filename);
				message_die(GENERAL_ERROR, 'Unable to upload file', '', __LINE__, __FILE__);
			}
		break;

		// PNG
		case 3:
			if ($imgtype != '.png')
			{
				@unlink($tmp_filename);
				message_die(GENERAL_ERROR, 'Unable to upload file', '', __LINE__, __FILE__);
			}
		break;

		default:
			@unlink($tmp_filename);
			message_die(GENERAL_ERROR, 'Unable to upload file', '', __LINE__, __FILE__);
	}

	if ( $width > 0 && $height > 0 && $width <= $board_config['avatar_max_width'] && $height <= $board_config['avatar_max_height'] )
	{
		$new_filename = uniqid(rand()) . $imgtype;

		if ( $current_type == USER_AVATAR_UPLOAD && $current_avatar != '' )
		{
			pcp_user_avatar_delete($current_type, $current_avatar);
		}

		if( $avatar_mode == 'remote' )
		{
			@copy($tmp_filename, './' . $board_config['avatar_path'] . "/$new_filename");
			@unlink($tmp_filename);
		}
		else
		{
			if ( @$ini_val('open_basedir') != '' )
			{
				if ( @phpversion() < '4.0.3' )
				{
					message_die(GENERAL_ERROR, 'open_basedir is set and your PHP version does not allow move_uploaded_file', '', __LINE__, __FILE__);
				}

				$move_file = 'move_uploaded_file';
			}
			else
			{
				$move_file = 'copy';
			}

			$move_file($avatar_filename, './' . $board_config['avatar_path'] . "/$new_filename");
		}

		@chmod('./' . $board_config['avatar_path'] . "/$new_filename", 0777);

		$avatar_sql = " user_avatar = '$new_filename', user_avatar_type = " . USER_AVATAR_UPLOAD;
	}
	else
	{
		$l_avatar_size = sprintf($lang['Avatar_imagesize'], $board_config['avatar_max_width'], $board_config['avatar_max_height']);

		$error = true;
		$error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $l_avatar_size : $l_avatar_size;
	}

	return $avatar_sql;
}
	function create_birthday_date($format, $date, $timezone)
	{
		global $board_config, $lang;
		static $translate;

		$birthday = '';
		if (intval($date) != 0)
		{
			// create a date on year 1971
			$day = intval(substr($date, 6, 2));
			$month = intval(substr($date, 4, 2));
			$year = substr($date, 0, 4);
			$temp_date = date($format, mktime( 0, 0, 1, $month, $day, 1971));
			$birthday = str_replace( '1971', $year, $temp_date );
			if ( empty($translate) && $board_config['default_lang'] != 'english' )
			{
				foreach ($lang['datetime'] as $match => $replace)
				{
					$translate[$match] = $replace;
				}
			}
			if (!empty($translate))
			{
				$birthday = strtr($birthday, $translate);
			}
		}
		return $birthday;
	}

function pcp_user_photo_delete($photo_type, $photo_file)
{
	global $board_config, $userdata;

	if ( $photo_type == USER_AVATAR_UPLOAD && $photo_file != '' )
	{
		if ( @file_exists(@phpbb_realpath('./' . $board_config['photo_path'] . '/' . $photo_file)) )
		{
			@unlink('./' . $board_config['photo_path'] . '/' . $photo_file);
		}
	}

	return " user_photo = '', user_photo_type = " . USER_AVATAR_NONE;
}

function pcp_user_photo_gallery(&$error, &$error_msg, $photo_filename)
{
	global $board_config;
	if ( file_exists(@phpbb_realpath($board_config['photo_gallery_path'] . '/' . $photo_filename)) )
	{
		$return = " user_photo = '" . str_replace("\'", "''", $photo_filename) . "', user_photo_type = " . USER_AVATAR_GALLERY;
	}
	else
	{
		$return = '';
	}
	return $return;
}

function pcp_user_photo_url(&$error, &$error_msg, $photo_filename)
{
	global $board_config, $lang;

	if ( !preg_match('#^(http)|(ftp):\/\/#i', $photo_filename) )
	{
		$photo_filename = 'http://' . $photo_filename;
	}

	if ( !preg_match('#^((http)|(ftp):\/\/[\w\-]+?\.([\w\-]+\.)+[\w]+(:[0-9]+)*\/.*?\.(gif|jpg|jpeg|png)$)#is', $photo_filename) )
	{
		$error = true;
		$error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $lang['Wrong_remote_photo_format'] : $lang['Wrong_remote_photo_format'];
		return;
	}
	$sizes = @getimagesize($photo_filename);
	$width = $sizes[0];
	$height = $sizes[1];
	
	if ( ($width > $board_config['photo_max_width']) || ($height > $board_config['photo_max_height']) )
	{
		$l_photo_size = sprintf($lang['Photo_imagesize'], $board_config['photo_max_width'], $board_config['photo_max_height']);

		$error = true;
		$error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $l_photo_size : $l_photo_size;
		return;
	}
	return " user_photo = '" . str_replace("\'", "''", $photo_filename) . "', user_photo_type = " . USER_AVATAR_REMOTE;

}

function pcp_user_photo_upload($photo_mode, &$current_photo, &$current_type, &$error, &$error_msg, $photo_filename, $photo_realname, $photo_filesize, $photo_filetype)
{
	global $board_config, $db, $lang;

	$ini_val = ( @phpversion() >= '4.0.0' ) ? 'ini_get' : 'get_cfg_var';

	if ( $photo_mode == 'remote' && preg_match('/^(http:\/\/)?([\w\-\.]+)\:?([0-9]*)\/(.*)$/', $photo_filename, $url_ary) )
	{
		if ( empty($url_ary[4]) )
		{
			$error = true;
			$error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $lang['Incomplete_URL'] : $lang['Incomplete_URL'];
			return;
		}

		$base_get = '/' . $url_ary[4];
		$port = ( !empty($url_ary[3]) ) ? $url_ary[3] : 80;

		if ( !($fsock = @fsockopen($url_ary[2], $port, $errno, $errstr)) )
		{
			$error = true;
			$error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $lang['No_connection_URL'] : $lang['No_connection_URL'];
			return;
		}

		@fputs($fsock, "GET $base_get HTTP/1.1\r\n");
		@fputs($fsock, "HOST: " . $url_ary[2] . "\r\n");
		@fputs($fsock, "Connection: close\r\n\r\n");

		unset($photo_data);
		while( !@feof($fsock) )
		{
			$photo_data .= @fread($fsock, $board_config['photo_filesize']);
		}
		@fclose($fsock);

		if (!preg_match('#Content-Length\: ([0-9]+)[^ /][\s]+#i', $photo_data, $file_data1) || !preg_match('#Content-Type\: image/[x\-]*([a-z]+)[\s]+#i', $photo_data, $file_data2))
		{
			$error = true;
			$error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $lang['File_no_data'] : $lang['File_no_data'];
			return;
		}

		$photo_filesize = $file_data1[1]; 
		$photo_filetype = $file_data2[1]; 

		if ( !$error && $photo_filesize > 0 && $photo_filesize < $board_config['photo_filesize'] )
		{
			$photo_data = substr($photo_data, strlen($photo_data) - $photo_filesize, $photo_filesize);

			$tmp_path = ( !@$ini_val('safe_mode') ) ? '/tmp' : './' . $board_config['photo_path'] . '/tmp';
			$tmp_filename = tempnam($tmp_path, uniqid(rand()) . '-');

			$fptr = @fopen($tmp_filename, 'wb');
			$bytes_written = @fwrite($fptr, $photo_data, $photo_filesize);
			@fclose($fptr);

			if ( $bytes_written != $photo_filesize )
			{
				@unlink($tmp_filename);
				message_die(GENERAL_ERROR, 'Could not write photo file to local storage. Please contact the board administrator with this message', '', __LINE__, __FILE__);
			}

			$sizes = @getimagesize($tmp_filename);
			$width = $sizes[0];
			$height = $sizes[1];
		}
		else
		{
			$l_photo_size = sprintf($lang['Photo_filesize'], round($board_config['photo_filesize'] / 1024));

			$error = true;
			$error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $l_photo_size : $l_photo_size;
		}
	}
	else if ( ( file_exists(@phpbb_realpath($photo_filename)) ) && preg_match('/\.(jpg|jpeg|gif|png)$/i', $photo_realname) )
	{
		if ( $photo_filesize <= $board_config['photo_filesize'] && $photo_filesize > 0 )
		{
			preg_match('#image\/[x\-]*([a-z]+)#', $photo_filetype, $photo_filetype);
			$photo_filetype = $photo_filetype[1];
		}
		else
		{
			$l_photo_size = sprintf($lang['Photo_filesize'], round($board_config['photo_filesize'] / 1024));

			$error = true;
			$error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $l_photo_size : $l_photo_size;
			return;
		}

			$sizes = @getimagesize($photo_filename);
			$width = $sizes[0];
			$height = $sizes[1];
	}

	if ( !($imgtype = pcp_check_image_type($photo_filetype, $error, $error_msg)) )
	{
		return;
	}

	if ( $width > 0 && $height > 0 )
	{
		$new_filename = uniqid(rand()) . $imgtype;

		if ( $current_type == USER_AVATAR_UPLOAD && $current_photo != '' )
		{
			if ( file_exists(@phpbb_realpath('./' . $board_config['photo_path'] . '/' . $current_photo)) )
			{
				@unlink('./' . $board_config['photo_path'] . '/' . $current_photo);
			}
		}

		if( $photo_mode == 'remote' )
		{
			@copy($tmp_filename, './' . $board_config['photo_path'] . "/$new_filename");
			@unlink($tmp_filename);
		}
		else
		{
			if ( @$ini_val('open_basedir') != '' )
			{
				if ( @phpversion() < '4.0.3' )
				{
					message_die(GENERAL_ERROR, 'open_basedir is set and your PHP version does not allow move_uploaded_file', '', __LINE__, __FILE__);
				}

				$move_file = 'move_uploaded_file';
			}
			else
			{
				$move_file = 'copy';
			}

			$move_file($photo_filename, './' . $board_config['photo_path'] . "/$new_filename");
		}

		@chmod('./' . $board_config['photo_path'] . "/$new_filename", 0777);

		if ($width > $board_config['photo_max_width'] || $height > $board_config['photo_max_height'])
		{
			$width_old = $width;
			$height_old = $height;
			if ($width > $board_config['photo_max_width'])
			{
				$height = ($board_config['photo_max_width'] / $width) * $height;
				$width = $board_config['photo_max_width'];
			}
			if ($height > $board_config['photo_max_height'])
			{
				$width = ($board_config['photo_max_height'] / $height) * $width;
				$height = $board_config['photo_max_height'];
			}
			$width = round ($width);   // to avoid float->integer conversion problems
			$height = round ($height); // to avoid float->integer conversion problems
			switch ($imgtype)
			{
				case '.jpg':
					$imagecreatefrom_function = imagecreatefromjpeg;
					$image_function = imagejpeg;
					break;
				case '.gif':
					$imagecreatefrom_function = imagecreatefromgif;
					$image_function = imagegif;
					break;
				case '.png':
					$imagecreatefrom_function = imagecreatefrompng;
					$image_function = imagepng;
					break;
			}
	    	$img_old = $imagecreatefrom_function ('./' . $board_config['photo_path'] . "/$new_filename");
			$img_new = imagecreatetruecolor ($width, $height);
			imagecopyresampled ($img_new, $img_old, 0, 0, 0, 0, $width, $height, $width_old, $height_old);
			$image_function ($img_new, './' . $board_config['photo_path'] . "/$new_filename");
			imagedestroy ($img_new);
		}
		$photo_sql = " user_photo = '$new_filename', user_photo_type = " . USER_AVATAR_UPLOAD;
	}
	else
	{
		$l_photo_size = sprintf($lang['Photo_imagesize'], $board_config['photo_max_width'], $board_config['photo_max_height']);

		$error = true;
		$error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $l_photo_size : $l_photo_size;
	}

	return $photo_sql;
}

	//-------------------------------------------
	//
	//	fields definitions
	//
	//-------------------------------------------
	if ( !defined('DEF_INCLUSION_DONE') )
	{
		$dir = @opendir($phpbb_root_path . './profilcp/def');
		while( $file = @readdir($dir) )
		{
			if( preg_match("/^def_.*?\." . $phpEx . "$/", $file) )
			{
				include_once($phpbb_root_path . './profilcp/def/' . $file);
			}
		}
		@closedir($dir);
		define('DEF_INCLUSION_DONE', true);
	}

	//-------------------------------------------
	//
	//	menu service function
	//
	//-------------------------------------------
	function pcp_set_menu($mode, $sort='', $url='', $shortcut='', $page_title='')
	{
		global $lang;
		global $module;
		global $user_maps;

		// get the menu idx
		$count_mode = $idx = ( isset($module['mode']) ? $module['mode'] : 0) ? count($module['mode']) : 0;
		$new = false;
		$found = false;
		for ( $i = 0; $i < $count_mode; $i++ )
		{
			$found = ( $module['mode'][$i] == $mode );
			if ( $found )
			{
				$idx = $i;
				break;
			}
		}

		// init
		if ( !$found )
		{
			$module['sort'][$idx]			= '';
			$module['url'][$idx]			= '';
			$module['shortcut'][$idx]		= '';
			$module['page_title'][$idx]		= '';
			$module['sub'][$idx]			= array();
		}

		// add it
		$module['mode'][$idx]			= $mode;
		$module['sort'][$idx]			= empty($module['sort'][$idx]) ? $sort : $module['sort'][$idx];
		$module['url'][$idx]			= empty($module['url'][$idx]) ? basename($url) : $module['url'][$idx];
		$module['shortcut'][$idx]		= empty($module['shortcut'][$idx]) ? $lang[$shortcut] : $module['shortcut'][$idx];
		$module['page_title'][$idx]		= empty($module['page_title'][$idx]) ? $lang[$page_title] : $module['page_title'][$idx];

		if ( isset($user_maps['PCP.' . $mode]) )
		{
			$module['sort'][$idx] = isset($user_maps['PCP.' . $mode]['order']) ? $user_maps['PCP.' . $mode]['order'] : 0;
		}

		return $idx;
	}

	function pcp_set_sub_menu($mode, $sub_mode, $sub_sort='', $sub_url='', $sub_shortcut='', $sub_page_title='' )
	{
		global $lang;
		global $module;
		global $user_maps;

		// ensure the main menu exists
		$idx = pcp_set_menu($mode);

		// check if the sub_menu exists
		$sub_count = $sub_idx = ( isset($module['sub'][$idx]['mode']) ? $module['sub'][$idx]['mode'] : 0) ? count($module['sub'][$idx]['mode']) : 0;
		$found = false;
		for ( $i = 0; $i < $sub_count; $i++ )
		{
			$found = ( $module['sub'][$idx]['mode'][$i] == $sub_mode );
			if ( $found )
			{
				$sub_idx = $i;
				break;
			}
		}

		// init
		if ( !$found )
		{
			$module['sub'][$idx]['sort'][$sub_idx]			= '';
			$module['sub'][$idx]['url'][$sub_idx]			= '';
			$module['sub'][$idx]['shortcut'][$sub_idx]		= '';
			$module['sub'][$idx]['page_title'][$sub_idx]	= '';
		}

		// add it
		$module['sub'][$idx]['mode'][$sub_idx]			= $sub_mode;
		$module['sub'][$idx]['sort'][$sub_idx]			= empty($module['sub'][$idx]['sort'][$sub_idx]) ? $sub_sort : $module['sub'][$idx]['sort'][$sub_idx];
		$module['sub'][$idx]['url'][$sub_idx]			= empty($module['sub'][$idx]['url'][$sub_idx]) ? basename($sub_url) : $module['sub'][$idx]['url'][$sub_idx];
		$module['sub'][$idx]['shortcut'][$sub_idx]		= empty($module['sub'][$idx]['shortcut'][$sub_idx]) ? $lang[$sub_shortcut] : $module['sub'][$idx]['shortcut'][$sub_idx];
		$module['sub'][$idx]['page_title'][$sub_idx]	= empty($module['sub'][$idx]['page_title'][$sub_idx]) ? $lang[$sub_page_title] : $module['sub'][$idx]['page_title'][$sub_idx];

		if ( isset($user_maps['PCP.' . $mode . '.' . $sub_mode]) )
		{
			$module['sub'][$idx]['sort'][$sub_idx] = isset($user_maps['PCP.' . $mode . '.' . $sub_mode]['order']) ? $user_maps['PCP.' . $mode . '.' . $sub_mode]['order'] : 0;
		}
	}

	// PCP Extra :: Added :: Start
	function find_input_maps($var){
		global $user_maps;
		if (substr($var,0,10) == 'PCP.profil' || substr($var,0,12) == 'PCP.register'){
			if (count($user_maps[$var]['fields'])){
				$filter_override = array_filter(array_keys($user_maps[$var]['fields']),"find_non_override_map_fields");
				if (count($filter_override)){
					return 1;
				}
			}
		}
		return 0;
	}
	function find_non_override_map_fields($var){
		global $board_config;
		if($board_config[$var.'_over']){
			return 0;
		} else {
			return 1;
		}
	}
	function find_required($var){
		global $user_fields, $userdata;
		if ($user_fields[$var]['required'] && !$user_fields[$var]['system'] && !$userdata[$var] ){
			return 1;
		} else {
			return 0;
		}
	}
	
    function force_required(){ 
		global $user_fields, $userdata, $lang, $board_config, $phpEx, $user_maps, $inputfieldmaps;
        if ($_SERVER['PHP_SELF'] == $board_config['script_path'] .'profile.'. $phpEx) 
            $is_valid = TRUE; 
        elseif ($_SERVER['PHP_SELF'] == $board_config['script_path'] .'login.'. $phpEx) 
            $is_valid = TRUE; 
        else 
            $is_valid = ''; 
			
        if ( (!$is_valid)  && (!$gen_simple_header) ) { 
            # Make sure they are not a guest 
            if ($userdata['user_id'] != ANONYMOUS) { 
				// get the input maps 
				$inputfieldmaps = array_filter(array_keys($user_maps),"find_input_maps");
				$missing = array_filter(array_keys($user_fields),"find_required");
				if(count($missing)){
					foreach ($missing as $id =>$field_name)
					{
						$mod = -1;
						$oldmod = "";
						$msub = -1;
						$oldmsub = "";
						$oldsub = "";
						foreach ($inputfieldmaps as $id =>$map_name)
						{
							$mapdata = explode(".",$map_name);
							if ($oldsub != $mapdata[2]){
								$oldsub = $mapdata[2];
								$oldmod = $mapdata[3];
								$oldmsub = $mapdata[4];
								$mod = 0;
								$msub = 0;
							} else if ($oldmod != $mapdata[3]){
								$oldmod = $mapdata[3];
								$mod++;
								$msub = 0;
							} else if ($oldmsub != $mapdata[4]){
								$oldmsub = $mapdata[4];
								$msub++;
							}
							if(isset($user_maps[$map_name]['fields'][$field_name])){
								$lnk = append_sid("./profile.$phpEx?mode=".$mapdata[1]."&sub=".$mapdata[2]."&mod=".$mod."&msub=".$msub);
                        break; 
                    } 
                } 
						if(!$lnk){
							message_die(GENERAL_ERROR, 'User maps error.<br /> the field <b>'.$field_name.'</b> is marked s required, but doesn not appear on any input screen. <br />Please remove the required setting or add the field on the profil or registering map.', '', __LINE__, __FILE__);
						}
						$href = '<a href="'.$lnk.'">'.$lang[$user_fields[$field_name]['lang_key']].'</a>';
						$text .= sprintf($lang['Required_Error'],$href).'<br>';
					}
					$txt = sprintf($lang['Required_force'],$lang['Required_field'],$text);
                    message_die(GENERAL_MESSAGE, $txt , ''); 
					exit;
                } 
            } 
        } 
    }

}
?>
