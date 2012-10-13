<?php
/***************************************************************************
 *                          admin_rebuild_search.php
 *                            -------------------
 *   begin                : Thursday, Jul 12, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *
 *
 ***************************************************************************/

define ('IN_PHPBB', 1);

if(!empty ($setmodules))
{
	$filename = basename(__FILE__);
	$module['General']['Rebuild Search'] = $filename;
	return;
}

//
// Let's set the root dir for phpBB
//
$no_page_header = true;
$phpbb_root_path = "./../";
require ($phpbb_root_path . 'extension.inc');
require ('./pagestart.' . $phpEx);
require ($phpbb_root_path . 'includes/functions_search.'.$phpEx); 

$start_time = time ();
if(isset($HTTP_GET_VARS['time_limit']))
{
	$time_limit = $HTTP_GET_VARS['time_limit'];
}
else
{
	$time_limit = 0;
}

//
// Langauge File
//
include ($phpbb_root_path.'language/lang_' . $board_config['default_lang'] . '/lang_admin_rebuild_search.'.$phpEx);

$page_title = $lang['Page_title'];

if (isset ($HTTP_GET_VARS['start'])) {
	function onTime () {
		global $start_time, $time_limit;
		static $max_execution_time;
		
		$current_time = time ();
		
		if (empty ($max_execution_time)) {
			if (ini_get ('safe_mode') == false) {
				set_time_limit (0);
				
				$max_execution_time = $time_limit;
			} else {
				$max_execution_time = ini_get ('max_execution_time');
			}
		}
			
		return (($current_time - $start_time) < $max_execution_time) ? true : false;
	}
	
	$start = $HTTP_GET_VARS['start'];
	
	if ($start == 0) {
		$sql = "DELETE FROM ". SEARCH_TABLE;
		$result = $db->sql_query ($sql);
		
		$sql = "DELETE FROM ". SEARCH_WORD_TABLE;
		$result = $db->sql_query ($sql);
		
		$sql = "DELETE FROM ". SEARCH_MATCH_TABLE;
		$result = $db->sql_query ($sql);
		
		$sql = "SELECT post_id FROM ". POSTS_TEXT_TABLE;
		$result = $db->sql_query ($sql);
		$total_num_rows = $db->sql_numrows ($result);
	}
	
	$total_num_rows = (isset ($HTTP_GET_VARS['total_num_rows'])) ? $HTTP_GET_VARS['total_num_rows'] : $total_num_rows;
		
	$sql = "SELECT post_id, post_subject, post_text FROM ". POSTS_TEXT_TABLE ." LIMIT $start, ". $HTTP_GET_VARS['post_limit'];
	$result = $db->sql_query ($sql);
		
	$num_rows = 0;
	while (($row = $db->sql_fetchrow ($result)) && (onTime () == true)) {
		add_search_words('single', $row['post_id'], stripslashes($row['post_text']), stripslashes($row['post_subject']));
		$num_rows++;
	}
	
	$template->set_filenames(array(
		"body" => "admin/admin_message_body.tpl")
	);
		
	if (($start + $num_rows) != $total_num_rows) {
		$form_action = append_sid ("admin_rebuild_search.$phpEx?start=". ($start + $num_rows) ."&total_num_rows=$total_num_rows&post_limit=". $HTTP_GET_VARS['post_limit'] ."&time_limit=$time_limit&refresh_rate=". $HTTP_GET_VARS['refresh_rate']);
		$next = $lang['Next'];
		$template->assign_vars(array(
			"META" => '<meta http-equiv="refresh" content="'. $HTTP_GET_VARS['refresh_rate'] .';url='. $form_action .'">')
		);
	} else {
		$next = $lang['Finished'];
		$form_action = append_sid ("admin_rebuild_search.$phpEx");
	}
	
	include ('./page_header_admin.'.$phpEx);
	
	$template->assign_vars (array (
		'PERCENT' => round ((($start + $num_rows) / $total_num_rows) * 100),
		'L_NEXT' => $next,
		
		'S_REBUILD_SEARCH_ACTION' => $form_action)
	);
	
	$template->set_filenames (array (
	    "body" => "admin/rebuild_search_progress.tpl")
	);
} else {
	include('./page_header_admin.'.$phpEx);
	
	$template->assign_vars (array (
		'L_REBUILD_SEARCH' => $lang['Rebuild_search'],
		'L_REBUILD_SEARCH_DESC' => $lang['Rebuild_search_desc'],
		'L_POST_LIMIT' => $lang['Post_limit'],
		'L_TIME_LIMIT' => $lang['Time_limit'],
		'L_REFRESH_RATE' => $lang['Refresh_rate'],
		'SESSION_ID' => $userdata['session_id'],
		
		'S_REBUILD_SEARCH_ACTION' => append_sid ("admin_rebuild_search.$phpEx"))
	);
		
	$template->set_filenames (array (
	    "body" => "admin/rebuild_search.tpl")
	);
}

$template->pparse ('body');

//
// Page Footer
//
include('./page_footer_admin.'.$phpEx);

?>