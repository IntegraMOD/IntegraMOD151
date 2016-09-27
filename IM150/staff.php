<?php 
 
define('IN_PHPBB', true); 
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

$userdata = session_pagestart($user_ip, PAGE_STAFF);
init_userprefs($userdata); 

include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_staff.' . $phpEx);

$page_title = $lang['Staff'];
include('includes/page_header.'.$phpEx); 

$template->set_filenames(array(
	'body' => 'staff_body.tpl',
));

$is_auth_ary = $tree['auth'];


$sql_forums = "SELECT ug.user_id, f.forum_id, f.forum_name, ug.group_id 
		FROM ". AUTH_ACCESS_TABLE ." aa, ". USER_GROUP_TABLE ." ug, ". FORUMS_TABLE ." f 
		WHERE aa.auth_mod = ". TRUE . " 
			AND ug.group_id = aa.group_id 
			AND f.forum_id = aa.forum_id
			AND ug.user_pending = 0";
if( !$result_forums = $db->sql_query($sql_forums) ) 
{ 
	message_die(GENERAL_ERROR, 'Could not query forums.', '', __LINE__, __FILE__, $sql_forums); 
} 
// add dummy group if no groups
$groups[] = -1;
while( $row = $db->sql_fetchrow($result_forums) ) 
{ 
	if(!@in_array($row['group_id'],$groups)){
		$groups[] = $row['group_id'];
	}
	$display_forums = ( $is_auth_ary[POST_FORUM_URL.$row['forum_id']]['auth_view'] ) ? true : false;
	
	if( $display_forums )
	{
		$forum_id = $row['forum_id'];
		$staff2[$row['user_id']][$row['forum_id']] = '<a href="'. append_sid("viewforum.$phpEx?f=$forum_id") .'" class="genmed">'. $row['forum_name'] .'</a><br />'; 
	}
} 

$groupslist = implode(',',$groups);

$level_cat[] = $lang['Staff_level'][0];
$level_cat[] = $lang['Staff_level'][2];
$level_cat[] = $lang['Staff_level'][1];
$user_id_ary = '\'temp\'';
for( $i = 0; $i < count($level_cat); $i++ )
{
	$user_level = $level_cat[$i];
	$template->assign_block_vars('user_level', array(
		'USER_LEVEL' => $user_level,
	));

	if( $level_cat['0'] )
	{
		$where = 'u.user_level = '. ADMIN;
	}
	else if( $level_cat['1'] )
	{
		$sql = "SELECT user_id FROM " . JR_ADMIN_TABLE . "
				WHERE user_jr_admin <>''";
		if ( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain junior admin status', '', __LINE__, __FILE__, $sql);
		}

		$jadmin_ary = '\'temp\'';
		while( $row = $db->sql_fetchrow($result) )
		{
			$jadmin_ary .= ',\'' . strval($row['user_id']) . '\'';
		}
		$where = 'u.user_id IN ('.$jadmin_ary.')';
	}
	else if( $level_cat['2'] )
	{
		$where = 'u.user_level = '. MOD . ' AND ug.group_id in ('.$groupslist.')';
	}

	$level_cat[$i] = '';

	$sql_user = "SELECT distinct u.* FROM ". USERS_TABLE ." u, ". USER_GROUP_TABLE ." ug 
								WHERE u.user_id = ug.user_id 
									AND ug.user_pending = 0 
									AND $where 
									AND u.user_id NOT IN (" . $user_id_ary . ")";
	if( !($result_user = $db->sql_query($sql_user)) ) 
	{ 
		message_die(GENERAL_ERROR, 'Could not obtain user information.', '', __LINE__, __FILE__, $sql_user); 
	} 
	if( $staff = $db->sql_fetchrow($result_user) )
	{
		$k = 0;
		do
		{
			$row_class = ( !($k % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
			$user_id = $staff['user_id'];
			$user_id_ary .= ',\'' . strval($user_id) . '\'';

			$forums = '';
			if( !empty($staff2[$staff['user_id']]) ) 
			{  
				asort($staff2[$staff['user_id']]);
				$forums = implode(' ',$staff2[$staff['user_id']]); 
			}
			$panel_info = pcp_output_panel('PHPBB.staff.info', $staff);
			$panel_stats = pcp_output_panel('PHPBB.staff.statistics', $staff);
			$panel_contact = pcp_output_panel('PHPBB.staff.contact', $staff);
			
			$template->assign_block_vars('user_level.staff', array(
				'ROW_CLASS' => $row_class,
				'FORUMS' => $forums,
				'PANEL_INFO' => $panel_info,
				'PANEL_STATS' => $panel_stats,
				'PANEL_CONTACT' => $panel_contact,
			));
			$k++;
		}
		while( $staff = $db->sql_fetchrow($result_user) );
	}
}

$template->assign_vars(array( 
	'L_USER' => $lang['User'], 
	'L_FORUMS' => $lang['Staff_forums'], 
	'L_STATS' => $lang['Staff_stats'], 
	'L_CONTACT' => $lang['Staff_contact'],
	'L_STAFF_TITLE' => $lang['Staff'], // added by edwin
));

$template->pparse('body');
include('includes/page_tail.'.$phpEx); 
?>