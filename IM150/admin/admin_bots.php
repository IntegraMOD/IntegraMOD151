<?php
/***************************************************************************
 *                             admin_bots.php
 *                            -------------------
 *   begin                : Friday, April 16, 2004
 *   copyright            : (C) 2004 Adam Marcus
 *   email                : adam_marcus@btinternet.com
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

define('IN_PHPBB', true);

if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['General']['Manage_Bots'] = $filename;
	return;
}

// load default header
$phpbb_root_path = './../';
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_bot_admin.' . $phpEx);

// define bots table - for the users who are to lazy to edit constants.php hehehe!
define('BOTS_TABLE', $table_prefix . "bots");

// errors - mwhahahaha
$bot_errors = "";

// get relevant query data
$submit = ((isset($_POST['submit'])) ? true : false);
if (isset($_GET['action']) || isset($_POST['action']))
{
	$action = (isset($_POST['action'])) ? $_POST['action'] : $_GET['action'];
}
else
{
	$action = '';
}
$id = (isset($_GET['id'])) ? $_GET['id'] : 0;
$mark = (isset($_POST['mark'])) ? $_POST['mark'] : 0;
if (isset($_POST['add'])) $action = 'add';

// editing and marks don't go well together...
if ( ( sizeof($mark) != 1 ) && $action == "edit" ) $action = '';
if ( ((sizeof($mark)) ?  $mark != '' : false ) && $action == "edit" ) 
{
	$id = $mark[0];
	$submit = false;
}


// hmmmmmm what does the user want to do?
switch ($action)

{
	case 'ignore_pending':
	case 'add_pending':
		// get required query data
		$pending_number = $_GET['pending']; 
		$pending_data = $_GET['data']; 

		// get data from table
		$sql = "SELECT pending_" . $pending_data . " 
		FROM " . BOTS_TABLE . " 
		WHERE bot_id = " . $id;

		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Couldn\'t obtain bot data.', '', __LINE__, __FILE__, $sql);
		}

		$row = $db->sql_fetchrow($result);

		// seperate data into a list
		$pending_array = explode('|', $row['pending_' . $pending_data]);

		if ($action == 'add_pending')
		{
			$new_data = $pending_array[($pending_number-1)];
		}

		array_splice($pending_array,  ($pending_number-1), 1);
		$pending = implode("|", $pending_array);

		// update table
		$sql = "UPDATE " . BOTS_TABLE . " 
		SET pending_" . $pending_data . "='$pending'
		WHERE bot_id = " . $id;

		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Couldn\'t update data in bots table.', '', __LINE__, __FILE__, $sql);
		}

		if ($action == "add_pending")
		{
			// get data from table
			$sql = "SELECT bot_" . $pending_data . " 
			FROM " . BOTS_TABLE . " 
			WHERE bot_id = " . $id;

			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Couldn\'t obtain bot data.', '', __LINE__, __FILE__, $sql);
			}

			$row = $db->sql_fetchrow($result);

			// seperate data into a list
			$pending_array = explode('|', $row['bot_' . $pending_data]);

			// insert new data into array
			$pending_array[] = str_replace("|", "&#124;", $new_data);

			$pending = implode("|", $pending_array);

			// update table
			$sql = "UPDATE " . BOTS_TABLE . " 
			SET bot_" . $pending_data . "='$pending'
			WHERE bot_id = " . $id;

			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Couldn\'t update data in bots table.', '', __LINE__, __FILE__, $sql);
			}
		}

		// load bot added template
		$template->set_filenames(array(
			"body" => "admin/bots_added.tpl")
		);

		$template->assign_vars(array(
			"S_BOTS_ACTION" => append_sid("admin_bots.$phpEx"),

			"L_BOTS_TITLE" => ( ($action == 'add_pending') ? $lang['Add'] : $lang['Ignore'] ) . " " . $lang['Bots'],
			"L_BOTS_EXPLAIN" => $lang['Bot_Result_Explain'],

			"L_BOT_OK" => $lang['Ok'],
			"L_BOT_RESULT" => $lang['Result'] . ":",
			"L_BOT_ADDED" => $lang['Bot_Added_Or_Modified'])
		);

		// display the page!
		$template->pparse("body");

		include('./page_footer_admin.'.$phpEx);

		break;
	case 'delete':
		// are we actually deleting something or do people just like clicking links...
		if ($id || $mark)
		{
			$id = ($id) ? " = $id" : ' IN (' . implode(', ', $mark) . ')';

			// do the delete!
			$sql = "DELETE FROM " . BOTS_TABLE . " 
				WHERE bot_id $id";

			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Couldn\'t delete data from bots table.', '', __LINE__, __FILE__, $sql);
			}

		}
		break;

	case 'add':
	case 'edit':

		// check if data has been submitted?
		if ($submit)
		{

			// get and validate required submitted data - for some reason isset doesn't work here?!
			if ( $_POST['bot_ip'] == '' )
			{
				if ( $_POST['bot_agent'] == '')
				{
					$bot_errors = $lang['Error_No_Agent_Or_Ip'];
				}
			}
			if ( $_POST['bot_name'] != '' )
			{
				$bot_name = $_POST['bot_name'];
			}
			else
			{
				$bot_errors = $lang['Error_No_Bot_Name'];
			}

			if (!$bot_errors)
			{


				$bot_agent = ( ( $_POST['bot_agent'] != '' ) ? $_POST['bot_agent'] : '' );
				$bot_ip = ( ( $_POST['bot_ip'] != '' ) ? $_POST['bot_ip'] : '' );

				// remove spaces from ip
				$bot_ip = str_replace(' ', '', $bot_ip);


				// are we creating a new bot - or not?
				if ($action == 'add')
				{
					$sql = "INSERT INTO " . BOTS_TABLE . " (bot_name, bot_agent, bot_ip)
						  VALUES ('$bot_name', '$bot_agent', '$bot_ip')";

					if ( !($result = $db->sql_query($sql)) )
					{
						message_die(GENERAL_ERROR, 'Couldn\'t insert data into bots table.', '', __LINE__, __FILE__, $sql);
					}

				} else {

					$sql = "UPDATE " . BOTS_TABLE . " 
						  SET bot_name='$bot_name', bot_agent='$bot_agent', bot_ip='$bot_ip' 
						  WHERE bot_id = $id";

					if ( !($result = $db->sql_query($sql)) )
					{
						message_die(GENERAL_ERROR, 'Couldn\'t update data in bots table.', '', __LINE__, __FILE__, $sql);
					}
				}

				// load bot added template
				$template->set_filenames(array(
					"body" => "admin/bots_added.tpl")
				);

				$template->assign_vars(array(
					"S_BOTS_ACTION" => append_sid("admin_bots.$phpEx"),

					"L_BOTS_TITLE" => ( ($action == 'edit') ? $lang['Edit'] : $lang['Add'] ) . " " . $lang['Bots'],
					"L_BOTS_EXPLAIN" => $lang['Bot_Result_Explain'],

					"L_BOT_OK" => $lang['Ok'],
					"L_BOT_RESULT" => $lang['Result'] . ":",
					"L_BOT_ADDED" => $lang['Bot_Settings_Changed'])
				);

				// finish off another wonderful page!
				$template->pparse("body");

				include('./page_footer_admin.'.$phpEx);

				// free the result
				$db->sql_freeresult($result);
			}

		} 

		if (!$submit || $bot_errors)
		{

			// load new template
			$template->set_filenames(array(
				"body" => "admin/bots_add_body.tpl")
			);

			if ($id) 
			{
				// get required bot data
				$sql = "SELECT bot_name, bot_agent, bot_ip
				FROM " . BOTS_TABLE . "
				WHERE bot_id = $id";

				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Couldn\'t get data from bots table.', '', __LINE__, __FILE__, $sql);
				}

				$row = $db->sql_fetchrow($result);

				// free the result
				$db->sql_freeresult($result);

				$template->assign_vars(array(
					"BOT_NAME" => $row['bot_name'],
					"BOT_AGENT" => $row['bot_agent'],
					"BOT_IP" => $row['bot_ip'])
				);
			}
		}

		if ($bot_errors)
		{
			$template->assign_block_vars('errorrow', array(
				'BOT_ERROR' => $bot_errors)
			);
		}

		$template->assign_vars(array(
			"S_BOTS_ACTION" => append_sid("admin_bots.$phpEx") . "&action=" . $action . "&id=" . $id,

			"L_BOTS_TITLE" => ( ($action == 'edit') ? $lang['Edit'] : $lang['Add'] ) . " " . $lang['Bots'],
			"L_BOTS_EXPLAIN" => $lang['Bot_Edit_Or_Add_Explain'],

			"L_BOT_SUBMIT" => $lang['Submit'],
			"L_BOT_RESET" => $lang['Reset'],

			"L_BOT_NAME" => $lang['Bot_Name'],
			"L_BOT_AGENT" => $lang['Agent_Match'],
			"L_BOT_IP" => $lang['Bot_Ip'],

			"L_BOT_NAME_EXPLAIN" => $lang['Bot_Name_Explain'],
			"L_BOT_AGENT_EXPLAIN" => $lang['Bot_Agent_Explain'],
			"L_BOT_IP_EXPLAIN" => $lang['Bot_Ip_Explain'])
		);

		// write the page! yay!
		$template->pparse("body");

		include('./page_footer_admin.'.$phpEx);

		break;

}

// load default template
$template->set_filenames(array(
	"body" => "admin/bots_body.tpl")
);

// calculate total site pages!
$total_posts = get_db_stat('postcount');
$total_users = get_db_stat('usercount');
$total_topics = get_db_stat('topiccount');

$total_pages = floor($total_topics / $board_config['topics_per_page']);
$total_pages += floor($total_posts / $board_config['posts_per_page']);
$total_pages += $total_users + floor($total_users / 50);
$total_pages = floor($total_pages*1.25);

// get bot table data
$sql = "SELECT bot_id, bot_name, last_visit, bot_visits, bot_pages
FROM " . BOTS_TABLE;

if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Couldn\'t query bots.', '', __LINE__, __FILE__, $sql);
}

// generate table from bot data
while ($row = $db->sql_fetchrow($result))
{

	$row_class = ( ($row_class == $theme['td_class2']) ? $theme['td_class1'] : $theme['td_class2']);

	$last_visits = explode('|', $row['last_visit']);

	if ($last_visits[0] == '')
	{
		$last_visit = $lang['Never'];
	} else {
		$last_visit = "<select>";
		foreach ($last_visits as $visit)
		{
			$last_visit .= "<option>" . date("j M y H:i:s", $visit) . "</option>";
		}
		$last_visit .= "</select>";
	}

	$bot_pages = $row['bot_pages'];

	$percentage = round(($bot_pages / $total_pages)*100);

	$bot_pages .= " (" . (($percentage < 100) ? $percentage : 100)  . "%)";

	$template->assign_block_vars('botrow', array(
		'ROW_NUMBER' => $row['bot_id'],
		'ROW_CLASS' => $row_class,

		'BOT_NAME' => $row['bot_name'],
		'PAGES' => $bot_pages,
		'VISITS' => $row['bot_visits'],
		'LAST_VISIT' => $last_visit)
	);

}


// if their are no bots write a friendly, informative message!
if ( $db->sql_numrows($result) == 0 )
{
	$template->assign_block_vars('nobotrow', array(
		'NO_BOTS' => $lang['No_Bots'])
	);
}

// free the result and finish the page!
$db->sql_freeresult($result);

// get bot table data
$sql = "SELECT bot_id, bot_name, pending_agent, pending_ip 
FROM " . BOTS_TABLE;

if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Couldn\'t query bots.', '', __LINE__, __FILE__, $sql);
}

$pending_bots = 0;

// generate pending table from bot data
while ($row = $db->sql_fetchrow($result))
{

	// i know its bad practice to have to almost identical statements but what the hey!
	if ( $row['pending_agent'] )
	{
		$loop = 0;

		foreach (explode('|', $row['pending_agent']) as $pending_data)
		{
			$loop++;
			$row_class = ( ($row_class == $theme['td_class2']) ? $theme['td_class1'] : $theme['td_class2']);
			$template->assign_block_vars('pendingrow', array(
				'ROW_NUMBER' => $row['bot_id'],
				'PENDING_NUMBER' => $loop,
				'PENDING_DATA' => $lang['agent'],
				'ROW_CLASS' => $row_class,
	
				'BOT_NAME' => $row['bot_name'],
				'IP_OR_AGENT' => $pending_data)
			);
			$pending_bots = 1;
		}
	}


	if ( $row['pending_ip'] )
	{
		$loop = 0;
	
		foreach (explode('|', $row['pending_ip']) as $pending_data)

		{
			$loop++;
			$row_class = ( ($row_class == $theme['td_class2']) ? $theme['td_class1'] : $theme['td_class2']);
			$template->assign_block_vars('pendingrow', array(
				'ROW_NUMBER' => $row['bot_id'],
				'PENDING_NUMBER' => $loop,
				'PENDING_DATA' => $lang['ip'],
				'ROW_CLASS' => $row_class,

				'BOT_NAME' => $row['bot_name'],
				'IP_OR_AGENT' => $pending_data)
			);
			$pending_bots = 1;
		}
	}

}


// if their are no pending bots write a friendly, informative message!
if ( !$pending_bots )
{
	$template->assign_block_vars('nopendingrow', array(
		'NO_BOTS' => $lang['No_Pending_Bots'])
	);
}

// free the result and finish the page!
$db->sql_freeresult($result);

$template->assign_vars(array(
	"S_BOTS_ACTION" => append_sid("admin_bots.$phpEx"),

	"L_BOTS_TITLE" => $lang['Manage_Bots'],
	"L_BOTS_EXPLAIN" => $lang['Bot_Explain'],

	"L_BOTS_TITLE_PENDING" => $lang['Pending_Bots'],
	"L_BOTS_EXPLAIN_PENDING" => $lang['Pending_Explain'],

	"L_BOT_IP_OR_AGENT" => $lang['Bot_Ip_Or_Agent'],
	"L_BOT_NAME" => $lang['Bot_Name'],
	"L_BOT_LAST_VISIT" => $lang['Last_Visit'],
	"L_BOT_VISITS" => $lang['Visits'],
	"L_BOT_PAGES" => $lang['Pages'],
	"L_BOT_OPTIONS" => $lang['Options'],
	"L_BOT_MARK" => $lang['Mark'],
	"L_BOT_IGNORE" => $lang['Ignore'],
	"L_BOT_ADD" => $lang['Add'],

	"L_BOT_SUBMIT" => $lang['Submit'],
	"L_BOT_DELETE" => $lang['Delete'],
	"L_BOT_EDIT" => $lang['Edit'])
);


$template->pparse("body");

include('./page_footer_admin.'.$phpEx);

?>