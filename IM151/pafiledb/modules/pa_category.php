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
class pafiledb_category extends pafiledb_public
{
	function main($action)
	{
		global $pafiledb_template, $lang, $phpEx, $pafiledb_config, $_REQUEST, $userdata;

		// =======================================================
		// Get the id
		// =======================================================

		if ( isset($_REQUEST['cat_id']))
		{
			$cat_id = intval($_REQUEST['cat_id']);
		}
		else
		{
			message_die(GENERAL_MESSAGE, $lang['Cat_not_exist']);
		}

		$start = ( isset($_REQUEST['start']) ) ? intval($_REQUEST['start']) : 0;


		if( isset($_REQUEST['sort_method']) )
		{
			switch ($_REQUEST['sort_method'])
			{
				case 'file_name':
					$sort_method = 'file_name';
					break;
				case 'file_time':
					$sort_method = 'file_time';
					break;
				case 'file_dls':
					$sort_method = 'file_dls';
					break;
				case 'file_rating':
					$sort_method = 'rating';
					break;
				case 'file_update_time':
					$sort_method = 'file_update_time';
					break;
				default:
					$sort_method = $pafiledb_config['sort_method'];
			}
		}
		else
		{
			$sort_method = $pafiledb_config['sort_method'];
		}

		if( isset($_REQUEST['sort_order']) )
		{
			switch ($_REQUEST['sort_order'])
			{
				case 'ASC':
					$sort_order = 'ASC';
					break;
				case 'DESC':
					$sort_order = 'DESC';
					break;
				default:
					$sort_order = $pafiledb_config['sort_order'];
			}
		}
		else
		{
			$sort_order = $pafiledb_config['sort_order'];
		}

		// =======================================================
		// If user not allowed to view file listing (read) and there is no sub Category
		// or the user is not allowed to view these category we gave him a nice message.
		// =======================================================

		$show_category = FALSE;
		if (isset($this->subcat_rowset[$cat_id]))
		{
			foreach($this->subcat_rowset[$cat_id] as $sub_cat_id => $sub_cat_row)
			{
				if($this->auth[$sub_cat_id]['auth_view'])
				{
					$show_category = TRUE;
					break;
				}
			}
		}

		if( (!$this->auth[$cat_id]['auth_read']) && (!$show_category) )
		{
			if ( !$userdata['session_logged_in'] )
			{
				redirect(append_sid("login.$phpEx?redirect=dload.$phpEx?action=category&cat_id=" . $cat_id, true));
			}
			
			$message = sprintf($lang['Sorry_auth_view'], $this->auth[$cat_id]['auth_read_type']);
			message_die(GENERAL_MESSAGE, $message);
		}

		if(!isset($this->cat_rowset[$cat_id]))
		{
			message_die(GENERAL_MESSAGE, $lang['Cat_not_exist']);	
		}

		//===================================================
		// assign var for naviagation
		//===================================================
		$this->generate_category_nav($cat_id);

		$pafiledb_template->assign_vars(array(
			'L_INDEX' => sprintf($lang['Forum_Index'], $board_config['sitename']),

			'U_INDEX' => append_sid('index.'.$phpEx),
			'U_DOWNLOAD' => append_sid('dload.'.$phpEx),

			'DOWNLOAD' => $pafiledb_config['settings_dbname'])
		);

		$no_file_message = TRUE;

		$filelist = FALSE;

		if (isset($this->subcat_rowset[$cat_id])) 
		{
			$no_file_message = FALSE;

			$this->category_display($cat_id);
		}
		
		$this->display_files($sort_method, $sort_order, $start, $no_file_message, $cat_id);

		$this->display($lang['Download'], 'pa_category_body.tpl');
	}
}
?>
