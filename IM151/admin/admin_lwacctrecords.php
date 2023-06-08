<?php
/***************************************************************************
 *				admin_lwacctrecords.php
 *
 *	begin				: OCT/29/2004
 *	copyright			: Loewen Enterprise - Xiong Zou
 *	email				: zouxiong@loewen.com.sg
 *
 *	version				: 1.0.0.1 - OCT/29/2004
 *
 ***************************************************************************/
/***************************************************************************
## Terms of Use
##
## All of my MODifications are to use and edit/change for phpBB End Users
##
## Plese DO NOT remove any copyright/licence declaration when using the MODification
##
## I will remain as the sole developer for all my MODifications unless stated otherwise
##
##
## Distribution Terms
##
## All of my MODifications are prohibited to distribute to others without the permission from me.
##
## Plese DO NOT remove any copyright/licence declaration when using the MODification
##
## I will remain as the sole developer for all my MODifications unless stated otherwise
##
## Re-Distribution Terms
##
## If you are distributing WHOLE or PART of my MOD in your MOD Projects or Pre-modded Projects or any other means, you must:
##
## Get the formal authorization from me first.
##
## Plese DO NOT remove any copyright/licence declaration when using the MODification
##
## I will remain as the sole developer for all my MODification unless stated otherwise. Do NOT declare youself as my co-developer
##
## Re-Distribution Terms DOES NOT apply to MOD authors that developing Add-Ons to my MOD. You will be the Add-Ons' Developer/Author
##
***************************************************************************/

define('IN_PHPBB', 1);

if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['Subscription_Admin']['IPN_LOG'] = $filename;

	return;
}

//
// Let's set the root dir for phpBB
//
$phpbb_root_path = '../';
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
require($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_ipn_grp.' . $phpEx);

$mode = '';
if( isset($_POST['mode']) || isset($_GET['mode']) )
{
	$mode = (isset($_POST['mode'])) ? $_POST['mode'] : $_GET['mode'];
}
if( $mode == 'edit')
{
	$username = '';
	$user_id = 0;
	if( isset($_POST['username']) || isset($_GET['username']) )
	{
		$username = (isset($_POST['username'])) ? $_POST['username'] : $_GET['username'];	
	}
	if(strlen( trim($username) ) > 0)
	{
		$sql = "SELECT * FROM " . USERS_TABLE . " WHERE username = '" . $username . "'";
		if($result = $db->sql_query($sql))
		{
			if( ($userinfo = $db->sql_fetchrow($result)) )
			{
				$user_id = $userinfo['user_id'];
			}
		}
	}
	

	$start = ( isset($_GET['start']) ) ? intval($_GET['start']) : 0;
	
	//
	// Generate a 'Show topics in previous x days' select box. If the topicsdays var is sent
	// then get it's value, find the number of topics with dates newer than it (to properly
	// handle pagination) and alter the main query
	//
	$previous_days = array(7, 14, 30, 90, 180, 364, 400);
	$previous_days_text = array($lang['7_Days'], $lang['2_Weeks'], $lang['1_Month'], $lang['3_Months'], $lang['6_Months'], $lang['1_Year'], $lang['LW_ALL_RECORDS']);
	
	$topic_days = 7;
	if ( !empty($_POST['topicdays']) || !empty($_GET['topicdays']) )
	{
		$topic_days = ( !empty($_POST['topicdays']) ) ? intval($_POST['topicdays']) : intval($_GET['topicdays']);
	
		if($topic_days > 0 && $topic_days < 400)
		{
			$min_topic_time = time() - ($topic_days * 86400);
	
			$limit_topics_time = "lw_date >= $min_topic_time";
		}
		else
		{
			$topic_days = 400;
			$limit_topics_time = '';
		}
	
		if ( !empty($_POST['topicdays']) )
		{
			$start = 0;
		}
	}
	else
	{
		$topic_days = 7;
		$min_topic_time = time() - ($topic_days * 86400);
	
		$limit_topics_time = "lw_date >= $min_topic_time";
	}
	
	$select_topic_days = '<select name="topicdays">';
	for($i = 0; $i < count($previous_days); $i++)
	{
		$selected = ($topic_days == $previous_days[$i]) ? ' selected="selected"' : '';
		$select_topic_days .= '<option value="' . $previous_days[$i] . '"' . $selected . '>' . $previous_days_text[$i] . '</option>';
	}
	$select_topic_days .= '</select>';
	
	
	
	$template->set_filenames(array(
	   	'body' => 'admin/admin_lwacctrecords_body.tpl')
		);
	
	
	
	$template->assign_vars(array(
		'L_INDEX' => $lang['L_IPN_log_title'] . '  ' . $lang['Index'],
	   	'L_LW_USERNAME' => $lang['L_LW_USERNAME'],
		'L_LW_CURRENCY' => $lang['LW_ACCT_CURRENCY'],
		'L_LW_MONEY' => $lang['LW_ACCT_AMOUNT'],
		'L_LW_PLUS_MINUS' => $lang['LW_ACCT_PLUS_MINUS'],
		'L_LW_TXNID' => $lang['LW_ACCT_TXNID'],
		'L_LW_POSTID' => $lang['LW_ACCT_POSTID'],
		'L_LW_STATUS' => $lang['LW_ACCT_STATUS'],
		'L_LW_COMMENT' => $lang['LW_ACCT_COMMENT'],
		'L_LW_DATE' => $lang['NP_DATE'],
		'L_GO' => 'GO',
		'U_INDEX' => append_sid('admin_lwacctrecords.'.$phpEx),
		'L_DISPLAY_TOPICS' => $lang['LW_ACCT_DISPLAY_FROM'],
		'S_SELECT_TOPIC_DAYS' => $select_topic_days,
		'S_RECORDS_DAYS_ACTION' => append_sid('admin_lwacctrecords.' . $phpEx),
		'LW_HIDDEN_FIELDS' => '<input type="hidden" name="mode" value="edit"><input type="hidden" name="username" value="' . $username . '">',
		)
		);
	
	
	$topics_count = 1;
	$strwhere = ( (strlen(trim($limit_topics_time)) > 0 || ($user_id > 0)) ? " WHERE " : "" );
	$strlimittime = trim($limit_topics_time);
	$strand = (strlen(trim($limit_topics_time)) > 0 && ($user_id > 0)) ? " AND " : "";
	$struserid = ($user_id > 0) ? ("user_id = " . $user_id) : "";
	$sql = "SELECT COUNT(*) FROM " . ACCT_HIST_TABLE . $strwhere . $strlimittime . $strand . $struserid;
		
//	printf($sql . "<br />");
	$result = $db->sql_query($sql);
	if($row = $db->sql_fetchrow($result))
	{
		$topics_count = $row["COUNT(*)"];
	}
	
	$topicsperpage = $board_config['topics_per_page'];
	
	$sql = "SELECT username, user_id FROM " . USERS_TABLE;
	$usernamearray = array();
	if($result = $db->sql_query($sql))
	{
		while ( $row = $db->sql_fetchrow($result) ) 
		{
			$usernamearray[$row['user_id']] = $row['username'];
		}
	}
	
	
	
//	$sql = "SELECT * FROM " . ACCT_HIST_TABLE . ((strlen(trim($limit_topics_time)) > 0) ? (" WHERE " . $limit_topics_time) : " ")
//		 . " ORDER BY lw_date DESC "
//		 . "LIMIT $start, $topicsperpage";
	$sql = "SELECT * FROM " . ACCT_HIST_TABLE . $strwhere . $strlimittime . $strand . $struserid
		 . " ORDER BY lw_date DESC "
		 . "LIMIT $start, $topicsperpage";
	

	$result = $db->sql_query($sql);
	
	while ( $row = $db->sql_fetchrow($result) ) {
		$canviewpost = 0;
		if(strnatcasecmp($row['lw_site'], $table_prefix) == 0)
		{
			$canviewpost = 1;
		}
		$posturl = '';
		if($row['lw_post_id'] > 0)
		{
			if($canviewpost == 1)
			{
				$posturl = "<a href=viewtopic.$phpEx?p=" . $row['lw_post_id'] . "#" . $row['lw_post_id'] . ">" . $row['lw_post_id'] . "</a>";
			}
			else
			{
				$posturl = $row['lw_post_id'];
			}
		}
	   $template->assign_block_vars('topicrow', array(
	   	'LW_USERNAME' => '<a href="' . append_sid("admin_lwacctrecords.$phpEx?mode=edit&username=" . $usernamearray[$row['user_id']]) . '">' . $usernamearray[$row['user_id']] . '</a>',
	   	'LW_CURRENCY' => $row['MNY_CURRENCY'],
		'LW_MONEY' => $row['lw_money'],
		'LW_PLUS_MINUS' => ($row['lw_plus_minus'] == 1 ? $lang['LW_ACCT_CREDIT'] : $lang['LW_ACCT_DEBIT']),
		'LW_TXNID' => $row['txn_id'],
		'LW_POSTID' => $posturl,
		'LW_STATUS' => $row['status'],
		'LW_DATE' => create_date($board_config['default_dateformat'], $row['lw_date'], $board_config['board_timezone']),
		'LW_COMMENT' => $row['comment'],
		)
	   	);
	
	}
	if($topics_count > 0)
	{
		$template->assign_vars(array(
			'PAGINATION' => generate_pagination("admin_lwacctrecords.$phpEx?topicdays=$topic_days&username=$username&mode=edit", $topics_count, $topicsperpage, $start),
			'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $topicsperpage ) + 1 ), ceil( $topics_count / $topicsperpage )),
	
			'L_GOTO_PAGE' => $lang['Goto_page'])
		);
	}
	if($topics_count <= 0)
	{
		//
		// No records
		//
		$no_topics_msg = $lang['LW_NO_RECORDS'];
		$template->assign_vars(array(
			'L_LW_NO_RECORDS' => $no_topics_msg)
		);
	
		$template->assign_block_vars('switch_lw_no_records', array() );
	}
	
	$template->pparse('body');
}
else
{
	//
	// Default user selection box
	//
	$template->set_filenames(array(
		'body' => 'admin/user_select_body.tpl')
	);

	$template->assign_vars(array(
		'L_USER_TITLE' => $lang['L_IPN_log_title'],
		'L_USER_EXPLAIN' => $lang['L_IPN_log_title_explain'],
		'L_USER_SELECT' => $lang['Select_a_User'],
		'L_LOOK_UP' => $lang['Look_up_user'],
		'L_FIND_USERNAME' => $lang['Find_username'],

		'U_SEARCH_USER' => append_sid("./../search.$phpEx?mode=searchuser"), 

		'S_USER_ACTION' => append_sid("admin_lwacctrecords.$phpEx"),
		'S_USER_SELECT' => $select_list)
	);
	$template->pparse('body');
}
include('./page_footer_admin.'.$phpEx);

?>