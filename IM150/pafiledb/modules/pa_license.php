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

class pafiledb_license extends pafiledb_public
{
	function main($action)
	{
		global $pafiledb_template, $lang, $board_config, $phpEx, $pafiledb_config, $db, $images, $userdata;
		global $_REQUEST, $phpbb_root_path;

		if ( isset($_REQUEST['license_id']) )
		{
			$license_id = intval($_REQUEST['license_id']);
		}
		else
		{
			message_die(GENERAL_MESSAGE, $lang['License_not_exist']);
		}

		if ( isset($_REQUEST['file_id']) )
		{
			$file_id = intval($_REQUEST['file_id']);
		}
		else
		{
			message_die(GENERAL_MESSAGE, $lang['File_not_exist']);
		}


		$sql = 'SELECT file_catid, file_name
			FROM ' . PA_FILES_TABLE . " 
			WHERE file_id = $file_id";

		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Couldnt Query file info', '', __LINE__, __FILE__, $sql);
		}

		if(!$file_data = $db->sql_fetchrow($result))
		{
			message_die(GENERAL_MESSAGE, $lang['File_not_exist']);
		}
		
		$db->sql_freeresult($result);
		
		if( (!$this->auth[$file_data['file_catid']]['auth_download']) )
		{
			if ( !$userdata['session_logged_in'] )
			{
				redirect(append_sid('login.'.$phpEx.'?redirect=dload.'.$phpEx.'?action=license&license_id=' . $license_id . '&file_id=' . $file_id, true));
			}

			$message = sprintf($lang['Sorry_auth_download'], $this->auth[$file_data['file_catid']]['auth_download_type']);
			message_die(GENERAL_MESSAGE, $message);
		}


		$sql = 'SELECT * 
			FROM ' . PA_LICENSE_TABLE . " 
			WHERE license_id = $license_id";

		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Couldnt Query license info for this file', '', __LINE__, __FILE__, $sql);
		}

		if(!$license = $db->sql_fetchrow($result))
		{
			message_die(GENERAL_MESSAGE, $lang['License_not_exist']);
		}
		
		$db->sql_freeresult($result);

		$this->generate_category_nav($file_data['file_catid']);
		
		$pafiledb_template->assign_vars(array(
			'L_INDEX' => sprintf($lang['Forum_Index'], $board_config['sitename']),
			'L_LICENSE' => $lang['License'],
			'L_LEWARN' => $lang['Licensewarn'],
			'L_AGREE' => $lang['Iagree'],
			'L_NOT_AGREE' => $lang['Dontagree'],

			'U_INDEX' => append_sid('index.'.$phpEx),
			'U_DOWNLOAD_HOME' => append_sid('dload.'.$phpEx),
			'U_FILE_NAME' => append_sid('dload.php?action=file&file_id=' . $file_id),
			'U_DOWNLOAD' => append_sid('dload.php?action=download&file_id=' . $file_id),

			'LE_NAME' => $license['license_name'],
			'FILE_NAME' => $file_data['file_name'],
			'LE_TEXT' => nl2br($license['license_text']),
			'DOWNLOAD' => $pafiledb_config['settings_dbname'])
		);

		$this->display($lang['Download'], 'pa_license_body.tpl');
	}
}
?>