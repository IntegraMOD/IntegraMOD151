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

if ( file_exists( './../viewtopic.php' ) )
{
	define( 'IN_PHPBB', 1 );
	define( 'IN_PORTAL', 1 );
	define( 'MXBB_MODULE', false );
	
	if ( !empty( $setmodules ) )
	{
		$file = basename( __FILE__ );
		$module['KB_title']['Optimize tables'] = $file;
		return;
	}	
	
	$phpbb_root_path = $module_root_path = $mx_root_path = "./../";
	require( $phpbb_root_path . 'extension.inc' );
	require( './pagestart.' . $phpEx );
	include( $phpbb_root_path . 'config.'.$phpEx );
	include( $phpbb_root_path . 'includes/functions_admin.'.$phpEx );
	include( $phpbb_root_path . 'includes/kb_constants.' . $phpEx );
	include( $phpbb_root_path . 'includes/functions_kb.' . $phpEx );
	include( $phpbb_root_path . 'includes/functions_kb_auth.' . $phpEx );	
	include( $phpbb_root_path . 'includes/functions_kb_field.' . $phpEx );	
	include( $phpbb_root_path . 'includes/functions_kb_mx.' . $phpEx );	
	include( $phpbb_root_path . 'includes/functions_search.' . $phpEx );	
}
else 
{
	define( 'IN_PORTAL', 1 );
	define( 'MXBB_MODULE', true );
	
	if ( !empty( $setmodules ) )
	{
		$file = basename( __FILE__ );
		$module['KB_title']['Optimize tables'] = 'modules/mx_kb/admin/' . $file;
		return;
	}	
	
	$mx_root_path = './../../../';
	$module_root_path = "./../";

	define( 'MXBB_27x', file_exists( $mx_root_path . 'mx_login.php' ) );
	
	require( $mx_root_path . 'extension.inc' );
	require( $mx_root_path . '/admin/pagestart.' . $phpEx );
	include( $module_root_path . 'includes/kb_constants.' . $phpEx );
	include( $module_root_path . 'includes/functions_kb.' . $phpEx );
	include( $module_root_path . 'includes/functions_kb_auth.' . $phpEx );
	include( $module_root_path . 'includes/functions_kb_field.' . $phpEx );
	include( $module_root_path . 'includes/functions_kb_mx.' . $phpEx );
	include( $phpbb_root_path . 'includes/functions_search.' . $phpEx );
	include_once( $mx_root_path . 'admin/page_header_admin.' . $phpEx );
}


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

$page_title = $lang['Page_title'];

if (isset ($HTTP_GET_VARS['start'])) {
	function onTime () {
		global $start_time, $time_limit;
		static $max_execution_time;
		
		$current_time = time ();
		$time_limit = $HTTP_GET_VARS['time_limit'];

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
	
	$total_num_rows = (isset ($HTTP_GET_VARS['total_num_rows'])) ? $HTTP_GET_VARS['total_num_rows'] : $total_num_rows;
		
	$sql = "SELECT article_id, article_title, article_body FROM ". KB_ARTICLES_TABLE ." LIMIT $start, ". $HTTP_GET_VARS['post_limit'];
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
		$form_action = append_sid ("admin_kb_rebuild_search.$phpEx?start=". ($start + $num_rows) ."&total_num_rows=$total_num_rows&post_limit=". $HTTP_GET_VARS['post_limit'] ."&time_limit=$time_limit&refresh_rate=". $HTTP_GET_VARS['refresh_rate']);
		$next = $lang['Next'];
		$template->assign_vars(array(
			"META" => '<meta http-equiv="refresh" content="'. $HTTP_GET_VARS['refresh_rate'] .';url='. $form_action .'">')
		);
	} else {
		$next = $lang['Finished'];
		$form_action = append_sid ("admin_kb_rebuild_search.$phpEx");
	}
	
	$template->assign_vars (array (
		'PERCENT' => round ((($start + $num_rows) / $total_num_rows) * 100),
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