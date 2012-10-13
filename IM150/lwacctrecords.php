<?php
/***************************************************************************
 *				lwacctrecords.php
 *							
 *	begin				: SEP/01/2004
 *	copyright			: Loewen Enterprise - Xiong Zou
 *	email				: zouxiong@loewen.com.sg
 *
 *	version				: 1.0.0.1 - SEP/03/2004
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

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);
//
// End session management

if( !$userdata['session_logged_in'] )
{
   header("Location: " . append_sid($phpbb_script_path . "login." . $phpEx . "?redirect=lwacctrecords." . $phpEx));
   exit;
}

$start = ( isset($HTTP_GET_VARS['start']) ) ? intval($HTTP_GET_VARS['start']) : 0;

include($phpbb_root_path . 'includes/page_header.'.$phpEx);


//
// Generate a 'Show topics in previous x days' select box. If the topicsdays var is sent
// then get it's value, find the number of topics with dates newer than it (to properly
// handle pagination) and alter the main query
//
$previous_days = array(7, 14, 30, 90, 180, 364, 400);
$previous_days_text = array($lang['7_Days'], $lang['2_Weeks'], $lang['1_Month'], $lang['3_Months'], $lang['6_Months'], $lang['1_Year'], $lang['LW_ALL_RECORDS']);

$topic_days = 7;
if ( !empty($HTTP_POST_VARS['topicdays']) || !empty($HTTP_GET_VARS['topicdays']) )
{
	$topic_days = ( !empty($HTTP_POST_VARS['topicdays']) ) ? intval($HTTP_POST_VARS['topicdays']) : intval($HTTP_GET_VARS['topicdays']);

	if($topic_days > 0 && $topic_days < 400)
	{
		$min_topic_time = time() - ($topic_days * 86400);

		$limit_topics_time = "AND lw_date >= $min_topic_time";
	}
	else
	{
		$topic_days = 400;
		$limit_topics_time = '';
	}

	if ( !empty($HTTP_POST_VARS['topicdays']) )
	{
		$start = 0;
	}
}
else
{
	$limit_topics_time = '';
	$topic_days = 7;
}

$select_topic_days = '<select name="topicdays">';
for($i = 0; $i < count($previous_days); $i++)
{
	$selected = ($topic_days == $previous_days[$i]) ? ' selected="selected"' : '';
	$select_topic_days .= '<option value="' . $previous_days[$i] . '"' . $selected . '>' . $previous_days_text[$i] . '</option>';
}
$select_topic_days .= '</select>';
$user_id = 0;
if(isset($HTTP_POST_VARS['userid']))
{
	$user_id = intval(trim(htmlspecialchars($HTTP_POST_VARS['userid']))) + 0;
} 
else if(isset($HTTP_GET_VARS['userid']))
{
	$user_id = intval(trim(htmlspecialchars($HTTP_GET_VARS['userid']))) + 0;
}
else
{
	$user_id = ($userdata['user_id']);
}
if($user_id != $userdata['user_id'] && $userdata['user_level'] != ADMIN)
{
	$message = $lang['LW_NO_PRIVILEGE'] . '<br /><br />' .  sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>');
	message_die(GENERAL_MESSAGE, $message);
	exit;
}
$template->set_filenames(array(
   	'body' => 'lwacctrecords_body.tpl')
	);

$template->assign_vars(array(
	'L_INDEX' => $board_config['sitename'] . '  ' . $lang['Index'],
	'L_LW_CURRENCY' => $lang['LW_ACCT_CURRENCY'],
	'L_LW_MONEY' => $lang['LW_ACCT_AMOUNT'],
	'L_LW_PLUS_MINUS' => $lang['LW_ACCT_PLUS_MINUS'],
	'L_LW_TXNID' => $lang['LW_ACCT_TXNID'],
	'L_LW_STATUS' => $lang['LW_ACCT_STATUS'],
	'L_LW_COMMENT' => $lang['LW_ACCT_COMMENT'],
	'L_LW_DATE' => $lang['NP_DATE'],
	'L_GO' => 'GO',
	'U_INDEX' => append_sid('index.'.$phpEx),
	'L_DISPLAY_TOPICS' => $lang['LW_ACCT_DISPLAY_FROM'],
	'S_SELECT_TOPIC_DAYS' => $select_topic_days,
	'S_RECORDS_DAYS_ACTION' => 'lwacctrecords.' . $phpEx,
	'LW_HIDDEN_FIELDS' => '<input type=hidden name=userid value=' . $user_id . '>'
	)
	);


$topics_count = 0;
$sql = "SELECT COUNT(*) FROM " . ACCT_HIST_TABLE . " WHERE "
	 . "user_id = $user_id "
	 . $limit_topics_time;
$result = $db->sql_query($sql);
if($row = $db->sql_fetchrow($result))
{
	$topics_count = $row["COUNT(*)"];
}

$topicsperpage = $board_config['topics_per_page'];

$sql = "SELECT * FROM " . ACCT_HIST_TABLE . " WHERE "
	 . "user_id = $user_id "
	 . $limit_topics_time
	 . " ORDER BY lw_date DESC "
	 . "LIMIT $start, $topicsperpage";

$result = $db->sql_query($sql);

while ( $row = $db->sql_fetchrow($result) ) {

   $template->assign_block_vars('topicrow', array(
   	'LW_CURRENCY' => $row['MNY_CURRENCY'],
	'LW_MONEY' => $row['lw_money'],
	'LW_PLUS_MINUS' => ($row['lw_plus_minus'] == 1 ? $lang['LW_ACCT_CREDIT'] : $lang['LW_ACCT_DEBIT']),
	'LW_TXNID' => $row['txn_id'],
	'LW_STATUS' => $row['status'],
	'LW_DATE' => create_date($board_config['default_dateformat'], $row['lw_date'], $board_config['board_timezone']),
	'LW_COMMENT' => $row['comment'],
	)
   	);

}
if($topics_count > 0)
{
	$template->assign_vars(array(
		'PAGINATION' => generate_pagination("lwacctrecords.$phpEx?topicdays=$topic_days&userid=$user_id", $topics_count, $topicsperpage, $start),
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
include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>