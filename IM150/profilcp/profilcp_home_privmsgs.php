<?php
/***************************************************************************
 *                            profilcp_home_privmsgs.php
 *                            --------------------------
 *	begin				: 26/09/2003
 *	copyright			: Ptirhiik
 *	email				: admin@rpgnet-fr.com
 *
 *	version				: 1.0.0 - 26/09/2003
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

if ( !empty($setmodules) ) return;

if ( !empty($set_homemodules) )
{
	$file = basename(__FILE__);
	$home_modules['pos'][] = 'left';
	$home_modules['sort'][] = 10;
	$home_modules['url'][] = $file;
	return;
}

//-------------------------------------------
//
//	Private messages
//
//-------------------------------------------

// pre process : count the privmsgs for the pagination fields
if ( $process == 'pre' )
{
	// get page parm
	$privmsgs_page_size = (isset($board_config['user_privmsgs_per_page'])) ? intval($board_config['user_privmsgs_per_page']) : 0;
	$privmsgs_total = 0;
	$privmsgs_start = 0;
	if ( isset($HTTP_POST_VAR['privmsgs_start']) || isset($HTTP_GET_VARS['privmsgs_start']) )
	{
		$privmsgs_start = isset($HTTP_POST_VAR['privmsgs_start']) ? intval($HTTP_POST_VAR['privmsgs_start']) : intval($HTTP_GET_VARS['privmsgs_start']);
	}

	if ($privmsgs_page_size > 0)
	{
		$user_id = $userdata['user_id'];
		$sql = "SELECT pm.privmsgs_type, pm.privmsgs_id, pm.privmsgs_date, pm.privmsgs_subject, u.* 
				FROM " . PRIVMSGS_TABLE . " pm, " . USERS_TABLE . " u 
				WHERE pm.privmsgs_to_userid = $view_user_id 
					AND (pm.privmsgs_from_userid = $user_id OR $user_id=$view_user_id)
					AND u.user_id = pm.privmsgs_from_userid 
					AND ( pm.privmsgs_type =  " . PRIVMSGS_NEW_MAIL . "	OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " )
				ORDER BY pm.privmsgs_date DESC";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not query private message post information', '', __LINE__, __FILE__, $sql);
		}
		$privmsgs_sql = $sql;
		$privmsgs_total = $db->sql_numrows($result);
		if ( $privmsgs_start >= $privmsgs_total )
		{
			$privmsgs_start = $privmsgs_total - 1;
		}
		if ( $privmsgs_start < 0 )
		{
			$privmsgs_start = 0;
		}

		// pagination fields
		$s_pagination_fields .= "&privmsgs_start=$privmsgs_start";
	}
}

// post process : display
if ( ($process == 'post') && ($privmsgs_page_size > 0) )
{
	$privmsgs_rowset = array();
	if ($privmsgs_total > 0)
	{
		$sql = $privmsgs_sql . " LIMIT $privmsgs_start, $privmsgs_page_size";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not query private message post information', '', __LINE__, __FILE__, $sql);
		}
		while ( $row = $db->sql_fetchrow($result) )
		{
			$privmsgs_rowset[] = $row;
		}
	}

	// save template state
	$sav_tpl = $template->_tpldata;

	// template
	$template->set_filenames(array(
		'_privmsgs_box' => 'profilcp/privmsgs_box.tpl')
	);

	// header
	$template->assign_vars(array(
		'L_NEW_PM'	=> $lang['Private_Messages'],
		'L_FROM'	=> $lang['From'],
		'L_DATE'	=> $lang['Date'],
		)
	);

	if (count($privmsgs_rowset) > 0 )
	{
		$class = false;
		for ($i=0; $i < count($privmsgs_rowset); $i++)
		{
			$class = !$class;
			$template->assign_block_vars('new_pm', array(
				'TITLE'			=> $privmsgs_rowset[$i]['privmsgs_subject'],
				'U_TITLE'		=> append_sid("./privmsg.$phpEx?folder=inbox&mode=read&" . POST_POST_URL . "=" . $privmsgs_rowset[$i]['privmsgs_id']),
				'CLASS'			=> ( $class ) ? 'row1' : 'row2',
				'CLASS_NAME'	=> get_user_level_class( $privmsgs_rowset[$i]['user_level'], 'name', $privmsgs_rowset[$i] ),
				'USERNAME'		=> $privmsgs_rowset[$i]['username'],
				'U_AUTHOR'		=> append_sid("./profile.$phpEx?mode=viewprofile&" . POST_USERS_URL . "=" . $privmsgs_rowset[$i]['user_id'] ),
				'DATE'			=> create_date( $board_config['default_dateformat'], $privmsgs_rowset[$i]['privmsgs_date'], $board_config['board_timezone'] ),
				)
			);
		}
	}
	else
	{
		$template->assign_block_vars('no_new_pm', array(
			'L_NO_MESSAGES' => $lang['No_new_pm'],
			)
		);
	}

	// transfert to a var
	$template->assign_var_from_handle('_privmsgs_box', '_privmsgs_box');
	$res = $template->_tpldata['.'][0]['_privmsgs_box'];

	// restore template saved state
	$template->_tpldata = $sav_tpl;

	// init right part of the home panel
	if ( !$right_part )
	{
		$template->assign_block_vars('right_part', array());
		$right_part = true;
	}

	// send result to template
	$template->assign_block_vars('right_part.box', array(
		'BOX' => $res,
		)
	);

	// hidden fields
	$s_hidden_fields .= '<input type="hidden" name="privmsgs_start" value="' . $privmsgs_start . '" />';

	// fix pagination display bug
	if ($privmsgs_total == 0)
	{
		$privmsgs_total = 1;
	}

	// remove the current paginations data (will be added by the generate_pagination() func)
	$w_pagination = str_replace( "&privmsgs_start=$privmsgs_start", '', $s_pagination_fields );

	// send the pagination sentence to display
	$template->assign_block_vars('right_part.box.pagination', array(
		'PAGINATION'	=> generate_pagination("./profile.$phpEx?$w_pagination", $privmsgs_total, $privmsgs_page_size, $privmsgs_start, true, 'privmsgs_start'),
		'PAGE_NUMBER'	=> sprintf($lang['Page_of'], ( floor( $privmsgs_start / $privmsgs_page_size ) + 1 ), ceil( $privmsgs_total / $privmsgs_page_size )), 
		)
	);
}

?>