<?php
/***************************************************************************
*                            $RCSfile: admin_priv_msgs.php,v $
*                            -------------------
*   begin                : Tue January 20 2002
*   copyright            : (C) 2002-2003 Nivisec.com
*   email                : support@nivisec.com
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
if (!defined('IN_PHPBB')) define('IN_PHPBB', true);
define('MOD_VERSION', '1.5.1');
define('MOD_CODE', 3);
/* Debugging for this file */
$debug_this_file = false;
/* If you wish to not use the archive area, set this to false */
define('ARCHIVE_ENABLED', true);
/* If you wish to not display IP addresses, set this to false */
define('SHOW_IPS', true);
/* This changes the number of pms to display per page */
define('ROWS_PER_PAGE', 25);
/* Use pop-up messages instead of inline display */
define('USE_POPUP_PAGE', false);
/* If for some reason you need to disable the version check in THIS HACK ONLY,
change the blow to TRUE instead of FALSE.  No other hacks will be affected
by this change.
*/
define('DISABLE_VERSION_CHECK', false);
/****************************************************************************
/** Functions
/***************************************************************************/
function aprvm_resync($type, $user_id)
{
	global $db;
	
	if (($type == PRIVMSGS_NEW_MAIL || $type == PRIVMSGS_UNREAD_MAIL))
	{
		// Update appropriate counter
		switch ($type)
		{
			case PRIVMSGS_NEW_MAIL:
			$sql = "user_new_privmsg = user_new_privmsg - 1";
			break;
			case PRIVMSGS_UNREAD_MAIL:
			$sql = "user_unread_privmsg = user_unread_privmsg - 1";
			break;
		}
		
		$sql = "UPDATE " . USERS_TABLE . "
			SET $sql 
			WHERE user_id = $user_id";
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, $lang['Error_Posts_Table'], '', __LINE__, __FILE__, $sql);
		}
	}
}

function priv_msgs_make_drop_box($prefix = 'sort')
{
	global $sort_types, $order_types, $pmtypes, $lang, $sort, $order, $pmtype, $page_title;
	
	$rval = '<select name="'.$prefix.'">';
	
	switch($prefix)
	{
		case 'sort':
		foreach($sort_types as $val)
		{
			$selected = ($sort == $val) ? 'selected="selected"' : '';
			$rval .= "<option value=\"$val\" $selected>" . $lang[$val] . '</option>';
		}
		break;
		case 'order':
		foreach($order_types as $val)
		{
			$selected = ($order == $val) ? 'selected="selected"' : '';
			$rval .= "<option value=\"$val\" $selected>" . $lang[$val] . '</option>';
		}
		break;
		case 'pmtype':
		foreach($pmtypes as $val)
		{
			$selected = ($pmtype == $val) ? 'selected="selected"' : '';
			$rval .= "<option value=\"$val\" $selected>" . $lang['PM_' . $val] . '</option>';
		}
		break;
	}
	$rval .= '</select>';
	
	return $rval;
}

function aprvm_id_2_name($id, $mode = 'user')
{
	global $db;
	
	if ($id == '')
	{
		return '?';
	}
	
	switch($mode)
	{
		case 'user':
		{
			$sql = 'SELECT username FROM ' . USERS_TABLE . "
	   			WHERE user_id = $id";
			
			if(!$result = $db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, $lang['Error_Other_Table'], '', __LINE__, __FILE__, $sql);
			}
			$row = $db->sql_fetchrow($result);
			return $row['username'];
			break;
		}
		case 'reverse':
		{
			$sql = 'SELECT user_id FROM ' . USERS_TABLE . "
	   			WHERE username = '$id'";
			
			if(!$result = $db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, $lang['Error_Other_Table'], '', __LINE__, __FILE__, $sql);
			}
			$row = $db->sql_fetchrow($result);
			if (empty($row['user_id']))
			{
				return 0;
			}
			else
			{
				return $row['user_id'];
			}
			break;
		}
	}
}
function aprvm_do_pagination($mode = 'normal')
{
	global $db, $filter_from_text, $filter_to_text, $filter_from, $filter_to, $lang, $template, $order;
	global $mode, $pmtype, $sort, $pmtype_text, $archive_text, $start, $archive_start, $topics_per_pg, $phpEx;
	
	$sql = 'SELECT count(*) AS total FROM ' . PRIVMSGS_TABLE . "$archive_text pm
		   WHERE 1
		   $pmtype_text
		   $filter_from_text
		   $filter_to_text";
	
	if(!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, $lang['Error_Posts_Table'], '', __LINE__, __FILE__, $sql);
	}
	$total = $db->sql_fetchrow($result);
	$total_pms = ($total['total'] > 0) ? $total['total'] : 1;
	
	$pagination = generate_pagination("admin_priv_msgs.$phpEx?mode=$mode&amp;order=$order&amp;sort=$sort&amp;pmtype=$pmtype&filter_from=$filter_from&filter_to=$filter_to", $total_pms, $topics_per_pg, $start)."&nbsp;";
	
	$template->assign_vars(array(
	"PAGINATION" => $pagination,
	"PAGE_NUMBER" => sprintf($lang['Page_of'], ( floor( $start / $topics_per_pg ) + 1 ), ceil( $total_pms / $topics_per_pg )),
	
	"L_GOTO_PAGE" => $lang['Goto_page'])
	);
}

define('COPYRIGHT_NIVISEC_FORMAT',
'<br /><span class="copyright"><center>
	%s 
	&copy; %s 
	<a href="http://www.nivisec.com" class="copyright">Nivisec.com</a>.
	</center></span>'
);


if (!function_exists('copyright_nivisec'))
{
	/**
	* @return void
	* @desc Prints a sytlized line of copyright for module
	*/
	function copyright_nivisec($name, $year)
	{
		printf(COPYRIGHT_NIVISEC_FORMAT, $name, $year);
	}
}

if (!function_exists('find_lang_file_nivisec'))
{
	/**
	* @return boolean
	* @param filename string
	* @desc Tries to locate and include the specified language file.  Do not include the .php extension!
	*/
	function find_lang_file_nivisec($filename)
	{
		global $lang, $phpbb_root_path, $board_config, $phpEx;
		
		if (file_exists($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . "/$filename.$phpEx"))
		{
			include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . "/$filename.$phpEx");
		}
		elseif (file_exists($phpbb_root_path . "language/lang_english/$filename.$phpEx"))
		{
			include_once($phpbb_root_path . "language/lang_english/$filename.$phpEx");
		}
		else
		{
			message_die(GENERAL_ERROR, "Unable to find a suitable language file for $filename!", '');
		}
		return true;
	}
}

if (!function_exists('set_filename_nivisec'))
{
	/**
	* @return boolean
	* @param filename string
	* @param handle string
	* @desc Sets the filename to handle in the $template class.  Saves typing for me :)
	*/
	function set_filename_nivisec($handle, $filename)
	{
		global $template;
		
		$template->set_filenames(array(
		$handle => $filename
		));
		
		return true;
	}
}
/****************************************************************************
/** Module Setup
/***************************************************************************/
define('PRIVMSGS_ALL_MAIL', -1);
$phpbb_root_path = '../';
include($phpbb_root_path . 'extension.inc');
include_once("pagestart.$phpEx");
include_once($phpbb_root_path . 'includes/bbcode.' . $phpEx);
find_lang_file_nivisec('lang_admin_priv_msgs');
if (!empty($setmodules))
{
	$filename = basename(__FILE__);
	$module['Users']['Private_Messages'] = $filename;
	if (ARCHIVE_ENABLED)
	{
		$module['Users']['Private_Messages_Archive'] = $filename . '?mode=archive';
	}
	return;
}

/****************************************************************************
/** Module Actual Start
/***************************************************************************/
/*******************************************************************************************
/** Get parameters.  'var_name' => 'default_value'
/** Also get any saved cookie preferences.
/******************************************************************************************/
$params = array('mode' => '', 'view_id' => '', 'start' => 0, 'order' => 'DESC', 'pmtype' => PRIVMSGS_ALL_MAIL,
'sort' => 'privmsgs_date', 'pmaction' => 'none',
'filter_from' => '', 'filter_to' => '', 'filter_from_text' => '', 'filter_to_text' => '');
foreach($params as $var => $default)
{
	$$var = $default;
	if(isset($_POST[$var]) || isset($_GET[$var]))
	{
		$$var = (isset($_POST[$var])) ? $_POST[$var] : $_GET[$var];
	}
}

/****************************************************************************
/** Main Vars.
/***************************************************************************/
$topics_per_pg = ROWS_PER_PAGE;
$page_title = $lang['Private_Messages'];
$order_types = array('DESC', 'ASC');
$sort_types = array('privmsgs_date', 'privmsgs_subject', 'privmsgs_from_userid', 'privmsgs_to_userid', 'privmsgs_type');
$pmtypes = array(PRIVMSGS_ALL_MAIL, PRIVMSGS_READ_MAIL, PRIVMSGS_NEW_MAIL, PRIVMSGS_SENT_MAIL, PRIVMSGS_SAVED_IN_MAIL, PRIVMSGS_SAVED_OUT_MAIL, PRIVMSGS_UNREAD_MAIL);
$status_message = '';
/*
// Private messaging defintions from constants.php for reference
define('PRIVMSGS_READ_MAIL', 0);
define('PRIVMSGS_NEW_MAIL', 1);
define('PRIVMSGS_SENT_MAIL', 2);
define('PRIVMSGS_SAVED_IN_MAIL', 3);
define('PRIVMSGS_SAVED_OUT_MAIL', 4);
define('PRIVMSGS_UNREAD_MAIL', 5);
*/

/*******************************************************************************************
/** Setup some options
/******************************************************************************************/
$archive_text = (ARCHIVE_ENABLED && $mode == 'archive') ? '_archive' : '';
$pmtype_text = ($pmtype != PRIVMSGS_ALL_MAIL) ? "AND pm.privmsgs_type = $pmtype" : '';
// Assign text filters if specified
if ($filter_from != '')
{
	$filter_from_user = aprvm_id_2_name($filter_from, 'reverse');
	$filter_from_text = (!empty($filter_from_user)) ? "AND pm.privmsgs_from_userid = $filter_from_user" : '';
}
if ($filter_to != '')
{
	$filter_to_user = aprvm_id_2_name($filter_to, 'reverse');
	$filter_to_text = (!empty($filter_to_user)) ? "AND pm.privmsgs_to_userid = $filter_to_user" : '';
}

if (count($_POST))
{
	foreach($_POST as $key => $val)
	{
		/*******************************************************************************************
		/** Check for archive items
		/******************************************************************************************/
		if (ARCHIVE_ENABLED && substr_count($key, 'archive_id_'))
		{
			$post_id = substr($key, 11);
			
			$sql = 'SELECT * FROM ' . PRIVMSGS_TABLE . "
			   WHERE privmsgs_id = $post_id";
			if(!$result = $db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, $lang['Error_Posts_Table'], '', __LINE__, __FILE__, $sql);
			}
			$row = $db->sql_fetchrow($result);
			
			$sql = 'INSERT INTO ' . PRIVMSGS_TABLE . '_archive VALUES
			   (' . $row['privmsgs_id'] . ', ' . $row['privmsgs_type'] . ", '" . $row['privmsgs_subject'] . "', " .
			$row['privmsgs_from_userid'] . ', ' . $row['privmsgs_to_userid'] . ', ' . $row['privmsgs_date'] . ", '" .
			$row['privmsgs_ip'] . "', " . $row['privmsgs_enable_bbcode'] . ', ' . $row['privmsgs_enable_html'] . ', ' .
			$row['privmsgs_enable_smilies'] . ', ' . $row['privmsgs_attach_sig'] . ')';
			if(!$db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, $lang['Error_Posts_Text_Table'], '', __LINE__, __FILE__, $sql);
			}
			else
			{
				$status_message .= sprintf($lang['Archived_Message'], $row['privmsgs_subject']);
			}
			
			$sql = 'DELETE FROM ' . PRIVMSGS_TABLE . "
			   WHERE privmsgs_id = $post_id";
			if(!$db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, $lang['Error_Posts_Text_Table'], '', __LINE__, __FILE__, $sql);
			}
			aprvm_resync($row['privmsgs_type'], $row['privmsgs_to_userid']);
		}
		/*******************************************************************************************
		/** Check for deletion items
		/******************************************************************************************/
		elseif (substr_count($key, 'delete_id_'))
		{
			$post_id = substr($key, 10);
			
			/* Make sure user isn't trying to delete an archived message in the same submit! */
			if (ARCHIVE_ENABLED && isset($_POST['archive_id_' . $post_id]))
			{
				/* This query isn't really needed, but makes the hey we deleted this title isntead of id show up */
				$sql = 'SELECT privmsgs_subject, privmsgs_to_userid, privmsgs_type FROM ' . PRIVMSGS_TABLE . "
			   WHERE privmsgs_id = $post_id";
				if(!$result = $db->sql_query($sql))
				{
					message_die(GENERAL_ERROR, $lang['Error_Posts_Archive_Table'], '', __LINE__, __FILE__, $sql);
				}
				$row = $db->sql_fetchrow($result);
				$status_message .= sprintf($lang['Archived_Message_No_Delete'], $row['privmsgs_subject']);
			}
			else
			{
				$sql = 'SELECT privmsgs_subject, privmsgs_to_userid, privmsgs_type FROM ' . PRIVMSGS_TABLE . "$archive_text
			   WHERE privmsgs_id = $post_id";
				if(!$result = $db->sql_query($sql))
				{
					message_die(GENERAL_ERROR, $lang['Error_Posts_Table'], '', __LINE__, __FILE__, $sql);
				}
				$row = $db->sql_fetchrow($result);
				
				$sql = "DELETE FROM " . PRIVMSGS_TEXT_TABLE . "
			   	   WHERE privmsgs_text_id = $post_id";
				if(!$db->sql_query($sql))
				{
					message_die(GENERAL_ERROR, $lang['Error_Posts_Table'], '', __LINE__, __FILE__, $sql);
				}
				
				$sql = "DELETE FROM " . PRIVMSGS_TABLE . "$archive_text
			   	   WHERE privmsgs_id = $post_id";
				if(!$db->sql_query($sql))
				{
					message_die(GENERAL_ERROR, $lang['Error_Posts_Table'], '', __LINE__, __FILE__, $sql);
				}
				
				$status_message .= sprintf($lang['Deleted_Message'], $row['privmsgs_subject']);
				
				if (!ARCHIVE_ENABLED || $mode != 'archive')
				{
					aprvm_resync($row['privmsgs_type'], $row['privmsgs_to_userid']);
				}
			}
		}
	}
}
/*******************************************************************************************
/** Switch our Mode to the right one
/******************************************************************************************/
switch($pmaction)
{
	case 'view_message':
	{
		if ($view_id == '')
		{
			message_die(GENERAL_ERROR, $lang['No_Message_ID'], '', __LINE__, __FILE__);
		}
		$sql = 'SELECT pm.*, pmt.*
		   FROM ' . PRIVMSGS_TABLE . "$archive_text pm, " . PRIVMSGS_TEXT_TABLE . " pmt
		   WHERE pm.privmsgs_id = pmt.privmsgs_text_id
		   AND pmt.privmsgs_text_id = $view_id";
		if(!$result = $db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, $lang['Error_Posts_Table'], '', __LINE__, __FILE__);
		}
		$privmsg = $db->sql_fetchrow($result);
		/************************/
		/* Just stole all the phpBB code for message processing :) And edited a ton of it out since we are all admins here */
		/**********************/
		$private_message = $privmsg['privmsgs_text'];
		$bbcode_uid = $privmsg['privmsgs_bbcode_uid'];
		if ( $bbcode_uid != '' )
		{
			$private_message = bbencode_second_pass($private_message, $bbcode_uid);
		}
		$private_message = make_clickable($private_message);
		if ( $privmsg['privmsgs_enable_smilies'] )
		{
			$old_config = $board_config['smilies_path'];
			$board_config['smilies_path'] = '../' . $board_config['smilies_path'];
			$private_message = smilies_pass($private_message);
			$board_config['smilies_path'] = $old_config;
		}
		$private_message = str_replace("\n", '<br />', $private_message);
		
		$template->set_filenames(array(
		'viewmsg_body' => (USE_POPUP_PAGE) ? 'admin/admin_priv_msgs_view_body.tpl' : 'admin/admin_priv_msgs_view_inline_body.tpl')
		);
		$template->assign_vars(array(
		'L_SUBJECT' => $lang['Subject'],
		'L_TO' => $lang['To'],
		'L_FROM' => $lang['From'],
		'L_SENT_DATE' => $lang['Sent_Date'],
		'L_PRIVATE_MESSAGES' => $page_title)
		);
		$template->assign_vars(array(
		'SUBJECT' => $privmsg['privmsgs_subject'],
		'FROM' => aprvm_id_2_name($privmsg['privmsgs_from_userid']),
		'FROM_IP' => (SHOW_IPS) ? ' : ('.decode_ip($privmsg['privmsgs_ip']).')' : '',
		'TO' => aprvm_id_2_name($privmsg['privmsgs_to_userid']),
		'DATE' => create_date($lang['DATE_FORMAT'], $privmsg['privmsgs_date'], $board_config['board_timezone']),
		'MESSAGE' => $private_message)
		);
		
		if (USE_POPUP_PAGE)
		{
			
			$template->pparse('viewmsg_body');
			copyright_nivisec($page_title, '2001-2003');
			break;
		}
		else
		{
			$template->assign_var_from_handle('PM_MESSAGE', 'viewmsg_body');
		}
	}
	case 'remove_old':
	{
		if ($pmaction == 'remove_old')
		{
			// Build user sql list
			$user_id_sql_list = '';
			$sql = 'SELECT user_id FROM '. USERS_TABLE .'
			   WHERE user_id <> '. ANONYMOUS;
			if(!$result = $db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, $lang['Error_Other_Table'], '', __LINE__, __FILE__);
			}
			while($row = $db->sql_fetchrow($result))
			{
				$user_id_sql_list .= ($user_id_sql_list != '') ? ', '.$row['user_id'] : $row['user_id'];
			}
			
			// Get orphan PM ids
			$priv_msgs_id_sql_list = '';
			$sql = 'SELECT privmsgs_id FROM '. PRIVMSGS_TABLE ."$archive_text
		WHERE privmsgs_to_userid NOT IN ($user_id_sql_list)";
			//print $sql;
			if(!$result = $db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, $lang['Error_Posts_Table'], '', __LINE__, __FILE__, $sql);
			}
			while ($row = $db->sql_fetchrow($result))
			{
				$priv_msgs_id_sql_list .= ($priv_msgs_id_sql_list != '') ? ', '.$row['privmsgs_id'] : $row['privmsgs_id'];
			}
			if ($priv_msgs_id_sql_list != '')
			{
				$sql = "DELETE FROM " . PRIVMSGS_TEXT_TABLE . "
			   	   WHERE privmsgs_text_id IN ($priv_msgs_id_sql_list)";
				//print $sql;
				if(!$db->sql_query($sql))
				{
					message_die(GENERAL_ERROR, $lang['Error_Posts_Table'], '', __LINE__, __FILE__, $sql);
				}
				
				$sql = "DELETE FROM " . PRIVMSGS_TABLE . "$archive_text
			   	   WHERE privmsgs_id  IN ($priv_msgs_id_sql_list)";
				//print $sql;
				if(!$db->sql_query($sql))
				{
					message_die(GENERAL_ERROR, $lang['Error_Posts_Table'], '', __LINE__, __FILE__, $sql);
				}
			}
			
			$status_message .= $lang['Removed_Old'];
			$status_message .= (SQL_LAYER == 'db2' || SQL_LAYER == 'mysql' || SQL_LAYER == 'mysql4' || SQL_LAYER == 'mysqli') ? sprintf($lang['Affected_Rows'], $db->sql_affectedrows()) : '';
		}
	}
	case 'remove_sent':
	{
		if ($pmaction == 'remove_sent')
		{
			// Get sent PM ids
			$priv_msgs_id_sql_list = '';
			$sql = 'SELECT privmsgs_id FROM '. PRIVMSGS_TABLE ."$archive_text
		WHERE privmsgs_type = ". PRIVMSGS_SENT_MAIL;
			if(!$result = $db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, $lang['Error_Posts_Table'], '', __LINE__, __FILE__, $sql);
			}
			while ($row = $db->sql_fetchrow($result))
			{
				$priv_msgs_id_sql_list .= ($priv_msgs_id_sql_list != '') ? ', '.$row['privmsgs_id'] : $row['privmsgs_id'];
			}
			if ($priv_msgs_id_sql_list != '')
			{
				$sql = "DELETE FROM " . PRIVMSGS_TEXT_TABLE . "
			   	   WHERE privmsgs_text_id IN ($priv_msgs_id_sql_list)";
				//print $sql;
				if(!$db->sql_query($sql))
				{
					message_die(GENERAL_ERROR, $lang['Error_Posts_Table'], '', __LINE__, __FILE__, $sql);
				}
				
				$sql = "DELETE FROM " . PRIVMSGS_TABLE . "$archive_text
			   	   WHERE privmsgs_id  IN ($priv_msgs_id_sql_list)";
				//print $sql;
				if(!$db->sql_query($sql))
				{
					message_die(GENERAL_ERROR, $lang['Error_Posts_Table'], '', __LINE__, __FILE__, $sql);
				}
			}
			
			$status_message .= $lang['Removed_Sent'];
			$status_message .= (SQL_LAYER == 'db2' || SQL_LAYER == 'mysql' || SQL_LAYER == 'mysql4' || SQL_LAYER == 'mysqli') ? sprintf($lang['Affected_Rows'], $db->sql_affectedrows()) : '';
		}
	}
	default:
	{
		$sql = 'SELECT pm.*, pmt.* FROM ' . PRIVMSGS_TABLE . "$archive_text pm, " . PRIVMSGS_TEXT_TABLE . " pmt
			   WHERE pm.privmsgs_id = pmt.privmsgs_text_id
			   $pmtype_text
			   $filter_from_text
			   $filter_to_text
			   ORDER BY $sort $order
			   LIMIT $start, $topics_per_pg";
		
		if(!$result = $db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, $lang['Error_Posts_Archive_Table'], '', __LINE__, __FILE__);
		}
		
		$i = 0;
		while($row = $db->sql_fetchrow($result))
		{
			$view_url = (!USE_POPUP_PAGE) ? append_sid(basename(__FILE__)."?mode=$mode&start=$start&amp;order=$order&amp;sort=$sort&amp;pmtype=$pmtype&filter_from=$filter_from&filter_to=$filter_to&pmaction=view_message&view_id=".$row['privmsgs_id']) : '#';
			$onclick_url = (USE_POPUP_PAGE) ? "JavaScript:window.open('" . append_sid("admin_priv_msgs.$phpEx?mode=$mode&pmaction=view_message&view_id=" . $row['privmsgs_id']) . "', '_privmsg', 'HEIGHT=450,resizable=yes,WIDTH=550')" : '';
			$template->assign_block_vars('msgrow', array(
			'ROW_CLASS' => (!(++$i% 2)) ? $theme['td_class1'] : $theme['td_class2'],
			'ATTACHMENT_INFO' => (defined('ATTACH_VERSION')) ? 'Not Here Yet' : '',
			'PM_ID' => $row['privmsgs_id'],
			'PM_TYPE' => $lang['PM_' . $row['privmsgs_type']],
			'SUBJECT' => $row['privmsgs_subject'],
			'FROM' => aprvm_id_2_name($row['privmsgs_from_userid']),
			'TO' => aprvm_id_2_name($row['privmsgs_to_userid']),
			'FROM_IP' => (SHOW_IPS) ? '<br>('.decode_ip($row['privmsgs_ip']).')' : '',
			'U_VIEWMSG' => $onclick_url,
			'U_INLINE_VIEWMSG' => $view_url,
			'DATE' => create_date($lang['DATE_FORMAT'], $row['privmsgs_date'], $board_config['board_timezone']))
			);
			if ($mode != 'archive' && ARCHIVE_ENABLED)
			{
				$template->assign_block_vars('msgrow.archive_avail_switch_msg', array());
			}
		}
		
		if ($i == 0)
		{
			$template->assign_block_vars('empty_switch', array());
			$template->assign_vars(array('L_NO_PMS' => $lang['No_PMS']));
		}
		
		aprvm_do_pagination();
		
		if ($mode != 'archive' && ARCHIVE_ENABLED)
		{
			$template->assign_block_vars('archive_avail_switch', array());
		}
		else {
			/* Send the comment area to the archive only parts to prevent JS errors */
			$template->assign_vars(array(
			'JS_ARCHIVE_COMMENT_1' => '/* ',
			'JS_ARCHIVE_COMMENT_2' => ' */'));
		}
		
		$page_title = (ARCHIVE_ENABLED && $mode == 'archive') ? $lang['Private_Messages_Archive'] : $lang['Private_Messages'];
		
		$template->set_filenames(array(
		'body' => 'admin/admin_priv_msgs_body.tpl')
		);
		
		$template->assign_vars(array(
		"L_SELECT_SORT_METHOD" => $lang['Select_sort_method'],
		"L_SUBJECT" => $lang['Subject'],
		"L_TO" => $lang['To'],
		"L_FROM" => $lang['From'],
		"L_SENT_DATE" => $lang['Sent_Date'],
		'L_PAGE_NAME' => $page_title,
		"L_ORDER" => $lang['Order'],
		"L_SORT" => $lang['Sort'],
		"L_SUBMIT" => $lang['Submit'],
		"L_DELETE" => $lang['Delete'],
		'L_PM_TYPE' => $lang['PM_Type'],
		'L_FILTER_BY' => $lang['Filter_By'],
		'L_RESET' => $lang['Reset'],
		'L_ARCHIVE' => $lang['Archive'],
		'L_PAGE_DESC' => ($mode == 'archive') ? $lang['Archive_Desc'] : $lang['Normal_Desc'],
		'L_VERSION' => $lang['Version'],
		'VERSION' => MOD_VERSION,
		'L_REMOVE_OLD' => $lang['Remove_Old'],
		'L_REMOVE_SENT' => $lang['Remove_Sent'],
		'L_UTILS' => $lang['Utilities'],
		
		'URL_ORPHAN' => append_sid(basename(__FILE__) . "?pmaction=remove_old&mode=$mode"),
		'URL_SENT' => append_sid(basename(__FILE__) . "?pmaction=remove_sent&mode=$mode"),
		
		'S_MODE' => $mode,
		'S_PMTYPE' => $pmtype,
		'S_FILTER_FROM' => $filter_from,
		'S_FILTER_TO' => $filter_to,
		'S_PMTYPE_SELECT' => priv_msgs_make_drop_box('pmtype'),
		"S_MODE_SELECT" => priv_msgs_make_drop_box('sort'),
		"S_ORDER_SELECT" => priv_msgs_make_drop_box('order'),
		'S_FILENAME' => basename(__FILE__),
		'S_MODE_ACTION' => append_sid(basename(__FILE__)))
		);
		
		
		if ($status_message != '')
		{
			$template->assign_block_vars('statusrow', array());
			$template->assign_vars(array(
			'L_STATUS' => $lang['Status'],
			'I_STATUS_MESSAGE' => $status_message)
			);
		}
		
		/************************************************************************
		** Begin The Version Check Feature
		************************************************************************/
		if (file_exists($phpbb_root_path.'nivisec_version_check.'.$phpEx) && !DISABLE_VERSION_CHECK)
		{
			include($phpbb_root_path.'nivisec_version_check.'.$phpEx);
		}
		/************************************************************************
		** End The Version Check Feature
		************************************************************************/

		$template->pparse('body');
		copyright_nivisec($page_title, '2001-2003');
		include('page_footer_admin.'.$phpEx);
		break;
	}
}
?>