<?php
/***************************************************************************
 *                             cash_log.php
 *                            -------------------
 *   begin                : Saturday, Jun 28, 2003
 *   copyright            : (C) 2003 Xore
 *   email                : mods@xore.ca
 *
 *   $Id: cash_log.php,v 2.0.0.0 2003/09/18 22:58:59 Xore $
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

define('IN_PHPBB', 1);
define('IN_CASHMOD', 1);

//
// Load default header
//
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
include($phpbb_root_path . 'includes/functions_admin.'.$phpEx);

if ( $board_config['cash_adminnavbar'] )
{
	$navbar = 1;
	include('./admin_cash.'.$phpEx);
}
$current_time = time();

$ar_time = array(	"all" => "",
					"day" => "(log_time > " . ($current_time - 86400) . ")",
					"week" => "(log_time > " . ($current_time - 604800) . ")",
					"month" => "(log_time > " . ($current_time - 2592000) . ")",
					"year" => "(log_time > " . ($current_time - 31536000) . ")");

function lt($const)
{
	return "log_type = $const";
}
$action_types = array(	CASH_LOG_DONATE => 'user',
						CASH_LOG_ADMIN_MODEDIT => 'admin',
						CASH_LOG_ADMIN_CREATE_CURRENCY => 'admin',
						CASH_LOG_ADMIN_DELETE_CURRENCY => 'admin',
						CASH_LOG_ADMIN_RENAME_CURRENCY => 'admin',
						CASH_LOG_ADMIN_COPY_CURRENCY => 'admin'
						);
$action_users = array('user' => array(), 'admin' => array());
foreach ( $action_types  as $type =>$user)
{
	$action_users[$user][] = lt($type);
}

$ar_action = array(	'all' => "",
					'user' => "(" . implode(" OR ",$action_users['user'] ) . ")",
					'admin' => "(" . implode(" OR ",$action_users['admin'] ) . ")"
					);
$ar_count = array(	"a" => 10,
					"b" => 25,
					"c" => 50,
					"d" => 100);

if ( isset($_GET['delete']) &&
	 ( ($_GET['delete'] == "all") ||
	   ($_GET['delete'] == "admin") ||
	   ($_GET['delete'] == "user") ) )
{
	$deleteclause = $ar_action[$_GET['delete']];
	if ( $deleteclause != "" )
	{
		$deleteclause = " WHERE " . $deleteclause;
	}
	$sql = "DELETE FROM " . CASH_LOGS_TABLE . $deleteclause;
	if ( !$db->sql_query($sql) )
	{
		message_die(CRITICAL_ERROR, "Log deletion failed", "", __LINE__, __FILE__, $sql);
	}
}
//
// most of this is just stupid sorting stuff
// -- but then, that's mostly all the functionality that this page has :P
//

// The addslashes isn't really necessary, but it truncates the variable to a string if it's an array
$saction = isset($_GET['saction'])?$_GET['saction']:"";
$stime = isset($_GET['stime'])?$_GET['stime']:"";
$scount = isset($_GET['scount'])?$_GET['scount']:"";
$start = isset($_GET['start'])?intval($_GET['start']):0;

$saction = ( isset($ar_action[$saction]) ) ? $saction : "all";
$stime = ( isset($ar_time[$stime]) ) ? $stime : "all";
$scount = ( isset($ar_count[$scount]) ) ? $scount : "b";

if ( !empty($_GET['sindex']) )
{
	$sindex = intval($_GET['sindex']);
	$sindex = max($sindex,0);
}
else
{
	$sindex = 0;
}
$clause = array();
if ( $saction != "all" )
{

	$clause[] = $ar_action[$saction];

}
if ( $stime != "all" )
{

	$clause[] = $ar_time[$stime];

}

$numactionfilters = count($ar_action);
$numtimefilters = count($ar_time);

$sql_clause = "";
if ( count($clause) != 0 )
{
	$sql_clause = "WHERE " . implode(" AND ", $clause);
}

$sql = "SELECT count(log_id) AS log_items
	FROM " . CASH_LOGS_TABLE . "
	$sql_clause";
if ( !$result = $db->sql_query($sql) )
{
	message_die(CRITICAL_ERROR, "Could not query the logs table", "", __LINE__, __FILE__, $sql);
}
if ( !($row = $db->sql_fetchrow($result)) )
{
	message_die(CRITICAL_ERROR, "Could not obtain log count", "", __LINE__, __FILE__, $sql);
}

$total = $row['log_items'];

$pagination = generate_pagination("cash_log.$phpEx?saction=$saction&amp;stime=$stime&amp;scount=$scount", max(1,$total), $ar_count[$scount], $start);


//
// Start page proper
//
$template->set_filenames(array(
	"body" => "admin/cash_log.tpl")
);

$template->assign_vars(array(
	'S_FORUM_ACTION' => append_sid("cash_forums.$phpEx"),
	'L_LOG_TITLE' => $lang['Logs'], 
	'L_LOG_EXPLAIN' => $lang['Logs_explain'],
	'L_LOG' => $lang['Log'], 
	'L_TIME' => $lang['Time'],
	'L_TYPE' => $lang['Type'],
	'L_ACTION' => $lang['Action'],
	'L_PAGE' => $lang['Page'],
	'L_PER_PAGE' => $lang['Per_page'],
	'PAGINATION' => $pagination,

	'NUMACTIONFILTERS' => $numactionfilters,
	'NUMTIMEFILTERS' => $numtimefilters)
);

//
// Some more stuff (icky!)
// (it looks nice now that it's not hardcoded :P )
//
$i = 0;
foreach ( $ar_action  as $key =>$dummy)
{
	$template->assign_block_vars("actionfilter", array(	"ROW_CLASS" => (( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2']),
														"ROW_COLOR" => (( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2']),
														"NAME" => $lang['Cash_' . $key],
														"LINK" => append_sid("cash_log.$phpEx?saction=$key&stime=$stime&scount=$scount&sindex=0"),
														"DELETE" => $lang['Delete_' . $key . '_logs'],
														"DELETECOMMAND" => append_sid("cash_log.$phpEx?delete=$key")));
	if ( $key != $saction )
	{
		$template->assign_block_vars("actionfilter.switch_linkpage_on", array());
	}
	else
	{
		$template->assign_block_vars("actionfilter.switch_linkpage_off", array());
	}
	$i++;
}
foreach ( $ar_time  as $key =>$dummy)
{
	$template->assign_block_vars("timefilter", array(	"ROW_CLASS" => (( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2']),
														"ROW_COLOR" => (( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2']),
														"NAME" => $lang[ucfirst($key)],
														"LINK" => append_sid("cash_log.$phpEx?saction=$saction&stime=$key&scount=$scount&sindex=0")));
	if ( $key != $stime )
	{
		$template->assign_block_vars("timefilter.switch_linkpage_on", array());
	}
	else
	{
		$template->assign_block_vars("timefilter.switch_linkpage_off", array());
	}
	$i++;
}
foreach ( $ar_count  as $key =>$number)
{
	$template->assign_block_vars("countfilter",array("NAME" => $number, "LINK" => append_sid("cash_log.$phpEx?saction=$saction&stime=$stime&scount=$key&sindex=0")));
	if ( $key != $scount )
	{
		$template->assign_block_vars("countfilter.switch_linkpage_on", array());
	}
	else
	{
		$template->assign_block_vars("countfilter.switch_linkpage_off", array());
	}
}

//$start = $ar_count[$scount] * $sindex;
$range = $ar_count[$scount];
$data_log = array();
$sql = "SELECT *
	FROM " . CASH_LOGS_TABLE . "
	$sql_clause
	ORDER BY log_time DESC
	LIMIT $start, $range";
if ( !$result = $db->sql_query($sql) )
{
	message_die(CRITICAL_ERROR, "Could not query log information", "", __LINE__, __FILE__, $sql);
}

while ( $row = $db->sql_fetchrow($result) )
{
	$data_log[] = $row;
}

$i = 0;

for ( $i = 0; $i < count($data_log); $i++ )
{
	$entry = $data_log[$i];
	$entry['log_time'] = create_date($board_config['default_dateformat'], $entry['log_time'], $board_config['board_timezone']);
	$entry['log_action'] = '<span class="gen">' . cash_clause($lang['Cash_clause'][$entry['log_type']],$entry['log_action']) . '</span>';
	$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
	$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

	$template->assign_block_vars("logrow", array( 
		"TIME" => $entry['log_time'], 
		"TEXT" => nl2br($entry['log_text']),
		"TYPE" => $lang['Cash_' . $action_types[$entry['log_type']]],
		"ACTION" => $entry['log_action'],
		"ROW_CLASS" => $row_class,
		"ROW_COLOR" => $row_color)
	);
}

$template->pparse("body");

include('./page_footer_admin.'.$phpEx);

?>
