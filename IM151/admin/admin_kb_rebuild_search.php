<?php
/***************************************************************************
 *                          admin_rebuild_search.php
 *                            -------------------
 *   begin                : Thursday, Jul 12, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: admin_kb_rebuild_search.php,v 1.7 2005/04/20 19:30:17 jonohlsson Exp $
 *
 *
 ***************************************************************************/

$start_time = time ();


if ( !empty( $setmodules ) )
{
	$file = basename( __FILE__ );
	$module['KB_title']['Optimize tables'] = $file;
	return;
}	

define( 'IN_PHPBB', 1 );
define( 'IN_PORTAL', 1 );
define( 'MXBB_MODULE', false );
$phpbb_root_path = $module_root_path = $mx_root_path = "./../";
require( $phpbb_root_path . 'extension.inc' );
require( './pagestart.' . $phpEx );
include( $phpbb_root_path . 'includes/functions_admin.'.$phpEx );
include( $phpbb_root_path . 'includes/kb_constants.' . $phpEx );
include( $phpbb_root_path . 'includes/functions_kb.' . $phpEx );
include( $phpbb_root_path . 'includes/functions_kb_auth.' . $phpEx );	
include( $phpbb_root_path . 'includes/functions_kb_field.' . $phpEx );	
include( $phpbb_root_path . 'includes/functions_kb_mx.' . $phpEx );	
include( $phpbb_root_path . 'includes/functions_search.' . $phpEx );	

// **********************************************************************
// Read language definition
// **********************************************************************
if ( !file_exists( $module_root_path.'language/lang_english/lang_admin_rebuild_search.'.$phpEx ) )
{
	include ($module_root_path.'language/lang_english/lang_admin_rebuild_search.'.$phpEx);
}
else
{
	include ($module_root_path.'language/lang_' . $board_config['default_lang'] . '/lang_admin_rebuild_search.'.$phpEx);
} 


if (isset ($_GET['start'])) {
	function onTime () {
		global $start_time, $time_limit;
		static $max_execution_time;
		
		$current_time = time ();
		$time_limit = $_GET['time_limit'];

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
	
	$start = $_GET['start'];
	
	if ($start == 0) {
		$sql = "DELETE FROM ". KB_SEARCH_TABLE;
		$result = $db->sql_query ($sql);
		
		$sql = "DELETE FROM ". KB_WORD_TABLE;
		$result = $db->sql_query ($sql);
		
		$sql = "DELETE FROM ". KB_MATCH_TABLE;
		$result = $db->sql_query ($sql);
		
		$sql = "SELECT article_id FROM ". KB_ARTICLES_TABLE;
		$result = $db->sql_query ($sql);
		$total_num_rows = $db->sql_numrows ($result);
	}
	
	$total_num_rows = (isset ($_GET['total_num_rows'])) ? $_GET['total_num_rows'] : $total_num_rows;
		
	$sql = "SELECT article_id, article_title, article_body FROM ". KB_ARTICLES_TABLE ." LIMIT $start, ". $_GET['post_limit'];
	$result = $db->sql_query ($sql);
		
	$num_rows = 0;
	while (($row = $db->sql_fetchrow ($result)) ) {
		mx_add_search_words('single', $row['article_id'], stripslashes($row['article_body']), stripslashes($row['article_title']), 'kb');
		$num_rows++;
	}
	
	$template->set_filenames(array(
		"body" => "admin/admin_message_body.tpl")
	);
		
	if (($start + $num_rows) != $total_num_rows) {
		$form_action = append_sid ("admin_kb_rebuild_search.$phpEx?start=". ($start + $num_rows) ."&total_num_rows=$total_num_rows&post_limit=". $_GET['post_limit'] ."&time_limit=$time_limit&refresh_rate=". $_GET['refresh_rate']);
		$next = $lang['Next'];
		$template->assign_vars(array(
			"META" => '<meta http-equiv="refresh" content="'. $_GET['refresh_rate'] .';url='. $form_action .'">')
		);
	} else {
		$next = $lang['Finished'];
		$form_action = append_sid ("admin_kb_rebuild_search.$phpEx");
	}
	
	$template->assign_vars (array (
		'PERCENT' => $total_num_rows == 0 ? 100 : round ((($start + $num_rows) / $total_num_rows) * 100),
		'L_NEXT' => $next,
		'START' => $start + $num_rows,
		'TOTAL_NUM_ROWS' => $total_num_rows,
		'S_REBUILD_SEARCH_ACTION' => $form_action)
	);
	
	$template->set_filenames (array (
	    "body" => "admin/kb_rebuild_search_progress.tpl")
	);
} 
else 
{
	$template->assign_vars (array (
		'L_REBUILD_SEARCH' => $lang['Rebuild_search'],
		'L_REBUILD_SEARCH_DESC' => $lang['Rebuild_search_desc'],
		'L_POST_LIMIT' => $lang['Post_limit'],
		'L_TIME_LIMIT' => $lang['Time_limit'],
		'L_REFRESH_RATE' => $lang['Refresh_rate'],
		'SESSION_ID' => $userdata['session_id'],
		
		'S_REBUILD_SEARCH_ACTION' => append_sid ("admin_kb_rebuild_search.$phpEx"))
	);
		
	$template->set_filenames (array (
	    "body" => "admin/kb_rebuild_search.tpl")
	);
}

$template->pparse ('body');

//
// Page Footer
//
// include('./page_footer_admin.'.$phpEx);
include( $mx_root_path . 'admin/page_footer_admin.' . $phpEx );

?>
