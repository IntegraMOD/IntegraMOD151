<?php
/*
  paFileDB 3.0
  ©2001/2002 PHP Arena
  Written by Todd
  todd@phparena.net
  http://www.phparena.net
  Keep all copyright links on the script visible
  Please read the license included with this script for more information.
*/
class pafiledb_file extends pafiledb_public
{
	function main($action)
	{
		global $pafiledb_template, $lang, $board_config, $phpEx, $pafiledb_config, $db, $images;
		global $_REQUEST, $phpbb_root_path, $userdata, $db, $pafiledb_functions;
		
		if ( isset($_REQUEST['file_id']))
		{
			$file_id = intval($_REQUEST['file_id']);
		}
		else
		{
			message_die(GENERAL_MESSAGE, $lang['File_not_exist']);
		}

		// =======================================================
		// file id is not set, give him/her a nice error message
		// =======================================================

		switch(SQL_LAYER)
		{
			case 'oracle':
				$sql = "SELECT f.*, AVG(r.rate_point) AS rating, COUNT(r.votes_file) AS total_votes, u.user_id, u.username, COUNT(c.comments_id) as total_comments
					FROM " . PA_FILES_TABLE . " AS f, " . PA_VOTES_TABLE . " AS r, " . USERS_TABLE . " AS u, " . PA_COMMENTS_TABLE . " AS c
					WHERE f.file_id = r.votes_file(+)
					AND f.user_id = u.user_id(+)
					AND f.file_id = c.file_id(+)
					AND f.file_id = $file_id
					AND f.file_approved = 1
					GROUP BY f.file_id ";
				break;

			default:
				$sql = "SELECT f.*, AVG(r.rate_point) AS rating, COUNT(r.votes_file) AS total_votes, u.user_id, u.username, COUNT(c.comments_id) as total_comments
					FROM " . PA_FILES_TABLE . " AS f
						LEFT JOIN " . PA_VOTES_TABLE . " AS r ON f.file_id = r.votes_file 
						LEFT JOIN ". USERS_TABLE ." AS u ON f.user_id = u.user_id
						LEFT JOIN " . PA_COMMENTS_TABLE . " AS c ON f.file_id = c.file_id
					WHERE f.file_id = $file_id
					AND f.file_approved = 1
					GROUP BY f.file_id ";
				break;
		}

		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Couldnt Query file info', '', __LINE__, __FILE__, $sql);
		}
		
		//===================================================
		// file doesn't exist'
		//===================================================
		if(!$file_data = $db->sql_fetchrow($result))
		{
			message_die(GENERAL_MESSAGE, $lang['File_not_exist']);
		}
		$db->sql_freeresult($result);
		
		//===================================================
		// Pafiledb auth for viewing file
		//===================================================

		if( (!$this->auth[$file_data['file_catid']]['auth_view_file']) )
		{
			if ( !$userdata['session_logged_in'] )
			{
				redirect(append_sid("login.$phpEx?redirect=dload.$phpEx?action=file&file_id=" . $file_id, true));
			}

			$message = sprintf($lang['Sorry_auth_view'], $this->auth[$file_data['file_catid']]['auth_view_file_type']);
			message_die(GENERAL_MESSAGE, $message);
		}

		$this->generate_category_nav($file_data['file_catid']);

		$pafiledb_template->assign_vars(array(
			'L_INDEX' => sprintf($lang['Forum_Index'], $board_config['sitename']),

			'U_INDEX' => append_sid('index.'.$phpEx),
			'U_DOWNLOAD_HOME' => append_sid('dload.'.$phpEx),

			'FILE_NAME' => $file_data['file_name'],
			'DOWNLOAD' => $pafiledb_config['settings_dbname'])
		); 
		
		//===================================================
		// Prepare file info to display them
		//===================================================

		$file_time = create_date($board_config['default_dateformat'], $file_data['file_time'], $board_config['board_timezone']);

		$file_last_download = ($file_data['file_last']) ? create_date($board_config['default_dateformat'], $file_data['file_last'], $board_config['board_timezone']) : $lang['never'];
		
		$file_update_time = ($file_data['file_update_time']) ? create_date($board_config['default_dateformat'], $file_data['file_update_time'], $board_config['board_timezone']) : $lang['never'];
		
		$file_author = trim($file_data['file_creator']);

		$file_version = trim($file_data['file_version']);

		$file_screenshot_url = trim($file_data['file_ssurl']);

		$file_website_url = trim($file_data['file_docsurl']);

		$file_rating = ($file_data['rating'] != 0) ? round($file_data['rating'], 2) . ' / 10' : $lang['Not_rated'];

		$file_download_link = ($file_data['file_license'] > 0) ? append_sid('dload.php?action=license&license_id=' . $file_data['file_license'] . '&file_id=' . $file_id) : append_sid('dload.php?action=download&file_id=' . $file_id);


		$file_size = $pafiledb_functions->get_file_size($file_id, $file_data);
		
		$file_poster = ( $file_data['user_id'] != ANONYMOUS ) ? '<a href="' . append_sid('profile.'.$phpEx.'?mode=viewprofile&amp;' . POST_USERS_URL . '=' . $file_data['user_id']) . '">' : '';
		$file_poster .= ( $file_data['user_id'] != ANONYMOUS ) ? $file_data['username'] : $lang['Guest'];
		$file_poster .= ( $file_data['user_id'] != ANONYMOUS ) ? '</a>' : '';

		$pafiledb_template->assign_vars(array(
			'L_CLICK_HERE' => $lang['Click_here'],
			'L_AUTHOR' => $lang['Creator'],
			'L_VERSION' => $lang['Version'],
			'L_SCREENSHOT' => $lang['Scrsht'],
			'L_WEBSITE' => $lang['Docs'],
			'L_FILE' => $lang['File'],
// MX Addon
			'L_EDIT' => $lang['Editfile'],
			'L_DELETE' => $lang['Deletefile'],

		 	'L_DESC' => $lang['Desc'],
			'L_VOTES' => $lang['Votes'],
			'L_DATE' => $lang['Date'],
			'L_UPDATE_TIME' => $lang['Update_time'],
			'L_LASTTDL' => $lang['Lastdl'],
			'L_DLS' => $lang['Dls'],
			'L_RATING' => $lang['DlRating'],
			'L_SIZE' => $lang['File_size'],
			'L_DOWNLOAD' => $lang['Downloadfile'],
			'L_RATE' => $lang['Rate'],
			'L_EMAIL' => $lang['Emailfile'],
			'L_SUBMITED_BY' => $lang['Submiter'],

			'SHOW_AUTHOR' => (!empty($file_author)) ? TRUE : FALSE,
			'SHOW_VERSION' => (!empty($file_version)) ? TRUE : FALSE,
			'SHOW_SCREENSHOT' => (!empty($file_screenshot_url)) ? TRUE : FALSE,
			'SHOW_WEBSITE' => (!empty($file_website_url)) ? TRUE : FALSE,
			'SS_AS_LINK' => ($file_data['file_sshot_link']) ? TRUE : FALSE,
			'FILE_NAME' => $file_data['file_name'],
		  	'FILE_LONGDESC' => nl2br($file_data['file_longdesc']),
			'FILE_SUBMITED_BY' => $file_poster,
			'FILE_AUTHOR' => $file_author,
			'FILE_VERSION' => $file_version,
			'FILE_SCREENSHOT' => $file_screenshot_url,
			'FILE_WEBSITE' => $file_website_url,
// MX Addon
			'AUTH_EDIT' => ( ($this->auth[$file_data['file_catid']]['auth_edit_file'] && $file_data['user_id'] == $userdata['user_id']) || $this->auth[$file_data['file_catid']]['auth_mod']) ? TRUE : FALSE,
			'AUTH_DELETE' => ( ($this->auth[$file_data['file_catid']]['auth_delete_file'] && $file_data['user_id'] == $userdata['user_id']) || $this->auth[$file_data['file_catid']]['auth_mod']) ? TRUE : FALSE,
 
			'AUTH_DOWNLOAD' => ($this->auth[$file_data['file_catid']]['auth_download']) ? TRUE : FALSE,
			'AUTH_RATE' => ($this->auth[$file_data['file_catid']]['auth_rate']) ? TRUE : FALSE,
			'AUTH_EMAIL' => ($this->auth[$file_data['file_catid']]['auth_email']) ? TRUE : FALSE,
			'INCLUDE_COMMENTS' => ($this->auth[$file_data['file_catid']]['auth_view_comment']) ? TRUE : FALSE,
// MX Addon
			'DELETE_IMG' => $images['icon_delpost'],
			'EDIT_IMG' => $images['icon_edit'],

			'DOWNLOAD_IMG' => $images['pa_download'],
			'RATE_IMG' => $images['pa_rate'],
			'EMAIL_IMG' => $images['pa_email'],
			'FILE_VOTES' => $file_data['total_votes'],
			'TIME' => $file_time,
			'UPDATE_TIME' => ($file_data['file_update_time'] != $file_data['file_time']) ? $file_update_time : $lang['never'],
			'RATING' => $file_rating,
			'FILE_DLS' => intval($file_data['file_dls']),
			'FILE_SIZE' => $file_size,
			'LAST' => $file_last_download,

// MX Addon
			'U_DELETE' => append_sid('dload.php?action=user_upload&do=delete&file_id=' . $file_id),
			'U_EDIT' => append_sid('dload.php?action=user_upload&file_id=' . $file_id),

			'U_DOWNLOAD' => $file_download_link,
			'U_RATE' => append_sid('dload.php?action=rate&file_id=' . $file_id),
		 	'U_EMAIL' => append_sid('dload.php?action=email&file_id=' . $file_id))
		);

		include($phpbb_root_path . 'pafiledb/includes/functions_field.'.$phpEx);
		$custom_field = new custom_field();
		$custom_field->init();
		$custom_field->display_data($file_id);


		if($this->auth[$file_data['file_catid']]['auth_view_comment'])
		{
			include($phpbb_root_path . 'pafiledb/includes/functions_comment.'.$phpEx);
			display_comments($file_data);
		}
		$this->display($lang['Download'], 'pa_file_body.tpl');
	}
}
?>