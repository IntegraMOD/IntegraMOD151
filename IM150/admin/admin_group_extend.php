<?php
/***************************************************************************
*                               admin_group_extend.php
*                              -------------------
*     begin                : 20/11/2003
*     copyright            : Dr DLP / Malicious Rabbit
*
*
****************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

define('IN_PHPBB', 1);

if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['Groups']['Group_extend'] = $filename;

	return;
}

$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
include($phpbb_root_path.'language/lang_' . $board_config['default_lang'] . '/lang_admin_group_extend.'.$phpEx);
include($phpbb_root_path.'includes/group_extend_auth.'.$phpEx);

$start = ( isset($_GET['start']) ) ? intval($_GET['start']) : 0;
$gid = ( isset($_GET['gid']) ) ? intval($_GET['gid']) : 0;
$group_page = ( isset($_GET['group_page']) ) ? intval($_GET['group_page']) : 0;

if ( $group_page == '1' )
{
	$template->assign_block_vars( 'group_page1' , array());

	$sql = " SELECT f.forum_name , a.* , g.*
	FROM ". FORUMS_TABLE." f , ".AUTH_ACCESS_TABLE." a , ".GROUPS_TABLE." g
	WHERE a.group_id = $gid
	AND a.group_id = g.group_id
	AND f.forum_id = a.forum_id
	ORDER BY f.forum_name";
	if ( !$result = $db->sql_query($sql) ) 
	{
		message_die(GENERAL_ERROR, 'Could not obtain groups auths', '', __LINE__, __FILE__, $sql);	
	}
	while ( $row = $db->sql_fetchrow($result))
	{
		$gid_auths[] = $row;
	}
	$group_name = $gid_auths[0]['group_name'];
	$group_desc = $gid_auths[0]['group_description'];

	for ( $l=0 ; $l < count($gid_auths); $l++)
	{
		if ( $gid_auths[$l]['auth_mod']) 
		{
			$template->assign_block_vars('group_page1.groups_auths_mod',array(
				'FORUM_NAME' => $gid_auths[$l]['forum_name'],
				'FORUM_LINK' => $gid_auths[$l]['cat_title'],
			));
		}
		if ( $gid_auths[$l]['auth_read'] ) 
		{
			$template->assign_block_vars('group_page1.groups_auths_view',array(
				'FORUM_NAME' => $gid_auths[$l]['forum_name'],
				'FORUM_LINK' => $gid_auths[$l]['cat_title'],
			));
		}
	}

	$template->assign_vars(array(
		'L_MOD' => $lang['Group_extend_forum_mod'],
		'L_VIEW' => $lang['Group_extend_forum_private'],
		'L_FORUM' => $lang['Forum'],
		'L_CAT' => $lang['Group_extend_cat'],
		'GROUP_NAME' => $group_name,
		'GROUP_DESC' => $group_desc)
	);	  
}
else if ( $group_page == '2' )
{
	$template->assign_block_vars( 'group_page2' , array());

	$sql = " SELECT username
	FROM ". USERS_TABLE."
	WHERE user_id = $gid";
	if ( !$result = $db->sql_query($sql) ) 
	{
		message_die(GENERAL_ERROR, 'Could not obtain username', '', __LINE__, __FILE__, $sql);	
	}
	$row = $db->sql_fetchrow($result);
	$username = $row['username'];

	$sql = " SELECT *
	FROM ". FORUMS_TABLE."
	ORDER BY forum_name";
	if ( !$result = $db->sql_query($sql) ) 
	{
		message_die(GENERAL_ERROR, 'Could not obtain groups auths', '', __LINE__, __FILE__, $sql);	
	}
	while ( $row = $db->sql_fetchrow($result))
	{
		$forums[] = $row;
	}
	$auth_user_gid = get_userdata($gid);

	for ( $l=0 ; $l < count($forums); $l++)
	{
		$forum_id = $forums[$l]['forum_id'];
		$sql = "SELECT * 
		FROM ".FORUMS_TABLE."
		WHERE forum_id = $forum_id ";
		if ( !$result = $db->sql_query($sql) ) 
		{
			message_die(GENERAL_ERROR, 'Could not obtain groups auths', '', __LINE__, __FILE__, $sql);	
		}
		$forum_row = $db->sql_fetchrow($result);
		$is_auth = array();
		$is_auth = gid_auth(AUTH_ALL, $forum_id, $auth_user_gid );
		$mod = ( $is_auth['auth_mod'] )  ? $lang['Yes'] : $lang['No'];
		$view = ( $is_auth['auth_view'] )  ? $lang['Yes'] : $lang['No'];
		$read = ( $is_auth['auth_read'] )  ? $lang['Yes'] : $lang['No'];
		$post = ( $is_auth['auth_post'] )  ? $lang['Yes'] : $lang['No'];
		$reply = ( $is_auth['auth_reply'] )  ? $lang['Yes'] : $lang['No'];

		$template->assign_block_vars('group_page2.forums',array(
			'FORUM_NAME' => $forums[$l]['forum_name'],
			'FORUM_MOD' => $mod,
			'FORUM_VIEW' => $view,
			'FORUM_READ' => $read,
			'FORUM_POST' => $post,
			'FORUM_REPLY' => $reply,
		));
	}

	$template->assign_vars(array(
		'L_AUTHS' => $lang['Group_extend_forum_auth'],
		'USERNAME' => $username ,
	)
	);
}
else
{
	$template->assign_block_vars( 'group_page' , array());
}

$template->set_filenames(array(
	"body" => "admin/admin_group_extend_list.tpl")
);

if ( isset($_GET['mode']) || isset($_POST['mode']) )
{
	$mode = ( isset($_POST['mode']) ) ? htmlspecialchars($_POST['mode']) : htmlspecialchars($_GET['mode']);
}
else
{
	$mode = 'name';
}
if(isset($_POST['order']))
{
	$sort_order = ($_POST['order'] == 'ASC') ? 'ASC' : 'DESC';
}
else if(isset($_GET['order']))
{
	$sort_order = ($_GET['order'] == 'ASC') ? 'ASC' : 'DESC';
}
else
{
	$sort_order = 'ASC';
}
$mode_types_text = array($lang['Group_extend_sort1'], $lang['Group_extend_sort2']);
$mode_types = array('name', 'id');
$select_sort_mode = '<select name="mode">';
for($i = 0; $i < count($mode_types_text); $i++)
{
	$selected = ( $mode == $mode_types[$i] ) ? ' selected="selected"' : '';
	$select_sort_mode .= '<option value="' . $mode_types[$i] . '"' . $selected . '>' . $mode_types_text[$i] . '</option>';
}
$select_sort_mode .= '</select>';
$select_sort_order = '<select name="order">';
if($sort_order == 'ASC')
{
	$select_sort_order .= '<option value="ASC" selected="selected">' . $lang['Sort_Ascending'] . '</option><option value="DESC">' . $lang['Sort_Descending'] . '</option>';
}
else
{
	$select_sort_order .= '<option value="ASC">' . $lang['Sort_Ascending'] . '</option><option value="DESC" selected="selected">' . $lang['Sort_Descending'] . '</option>';
}
$select_sort_order .= '</select>';
$mode_group_extend_number = array($lang['Group_extend_type1'], $lang['Group_extend_type2']);
$mode_group_extend_types = array('group_disp1', 'group_disp2');
$select_group_extend_number = '<select name="mode2">';
for($i = 0; $i < count($mode_group_extend_number); $i++)
{
	$selected = ( $mode2 == $mode_group_extend_types[$i] ) ? ' selected="selected"' : '';
	$select_group_extend_number .= '<option value="' . $mode_group_extend_types[$i] . '"' . $selected . '>' . $mode_group_extend_number[$i] . '</option>';
}
$select_group_extend_number .= '</select>';

switch( $mode )
{
	case 'name':
		$order_by = "username $sort_order LIMIT $start, " . $board_config['topics_per_page'];
		$order_by2 = "group_name $sort_order LIMIT $start, " . $board_config['topics_per_page'];
		break;
	case 'id':
		$order_by = "user_id $sort_order LIMIT $start, " . $board_config['topics_per_page'];
		$order_by2 = "group_id $sort_order LIMIT $start, " . $board_config['topics_per_page'];
		break;
	default:
		$order_by = "username $sort_order LIMIT $start, " . $board_config['topics_per_page'];
		$order_by2 = "group_name $sort_order LIMIT $start, " . $board_config['topics_per_page'];
		break;
}

switch( $mode2 )
{
	case 'group_disp1':
		$template->assign_block_vars( 'group_page.users' , array());
		$sssql = "SELECT * 
		FROM " . USERS_TABLE . "
		WHERE user_active = 1
		ORDER by $order_by";
		if ( !$ssresult = $db->sql_query($sssql) ) 
		{
			message_die(GENERAL_ERROR, 'Could not read groups', '', __LINE__, __FILE__, $sssql);	
		}

		while ($ssrow = $db->sql_fetchrow($ssresult))
		{
			$user_groups2[] = $ssrow;
		}
		for($m = 0; $m < count($user_groups2);$m++)
		{

			$group_iden = $user_groups2[$m]['user_id'];
			$ppsql = '
			SELECT 
				g.group_name 
			FROM 
				' . USER_GROUP_TABLE . ' as l, 
				' . GROUPS_TABLE . ' as g 
			WHERE 
				l.user_pending = 0 AND 
				g.group_single_user = 0 AND 
				l.user_id =' . $group_iden . ' AND 
				g.group_id = l.group_id 
			ORDER BY 
				g.group_name, 
				g.group_id';
			if ( !$ppresult = $db->sql_query($ppsql) ) 
			{
				message_die(GENERAL_ERROR, 'Could not read groups', '', __LINE__, __FILE__, $ppsql);	
			}
			$pprow = $db->sql_fetchrowset($ppresult);
			$gcount2 ='<br />';

				for($y = 0; $y < count($pprow);$y++)
				{
					$name = $pprow[$y]['group_name'];
					$gcount2 .= $name.'<br />';
				}

			$group_disp2 = $user_groups2[$m]['username'];
			$row_color = ( !($m % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
			$row_class = ( !($m % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
			$template->assign_block_vars('group_page.users.groups_list_name2',array(
			'LINK' => append_sid("admin_group_extend.$phpEx?group_page=2&amp;gid=$group_iden"),
			'ROW_COLOR' => "#" . $row_color,
			'ROW_CLASS' => $row_class,
			'GL_USERS2' => $gcount2,
			'GL_NAME2' => $group_disp2)
			);
		}
		if ( !$board_config['topics_per_page'] < 10 )
		{
			$sql = "SELECT count(*) AS total
			FROM " . USERS_TABLE . "
			WHERE user_id <> " . ANONYMOUS;

			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Error getting total users', '', __LINE__, __FILE__, $sql);
			}
	
			if ( $total = $db->sql_fetchrow($result) )
			{
				$total_members = $total['total'];
			}
		}
		else
		{
			$total_members = 10;
		}
		$pagination = generate_pagination("admin_group_extend.$phpEx?mode=$mode&amp;mode2=$mode2&amp;order=$sort_order", $total_members, $board_config['topics_per_page'], $start). '&nbsp;';
		break;

	case 'group_disp2':
		$template->assign_block_vars( 'group_page.groups' , array());
		$gcount = '';
		$ssql = "SELECT * FROM " . GROUPS_TABLE . " 
		WHERE group_single_user <> " . TRUE . "
		ORDER BY $order_by2";
		if ( !$sresult = $db->sql_query($ssql) ) 
		{
			message_die(GENERAL_ERROR, 'Could not read groups', '', __LINE__, __FILE__, $ssql);	
		}
		while ($srow = $db->sql_fetchrow($sresult))
		{
			$user_groups[] = $srow;
		}

		for($i = 0; $i < count($user_groups);$i++)
		{
			$group_iden = $user_groups[$i]['group_id'];
			$psql = "SELECT u.username , u.user_id , g.group_name , g.group_id
			FROM 
			" . USER_GROUP_TABLE . " ug, 
			" . GROUPS_TABLE . " g, 
			" . USERS_TABLE . " u
			WHERE ug.user_pending = 0 
			AND g.group_single_user = 0 
			AND g.group_id = ug.group_id 
			AND g.group_id = $group_iden
			AND u.user_id = ug.user_id 
			ORDER BY g.group_name";
			if ( !$presult = $db->sql_query($psql) ) 
			{
				message_die(GENERAL_ERROR, 'Could not read groups', '', __LINE__, __FILE__, $psql);	
			}
			$prow = $db->sql_fetchrowset($presult);
			$gcount ='<br />';

				for($h = 0; $h < count($prow);$h++)
				{
					$name = $prow[$h]['username'];
					$gcount .= $name.'<br />';
				}

			$group_disp = $user_groups[$i]['group_name'];
			$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
			$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
			$template->assign_block_vars('group_page.groups.groups_list_name',array(
			'LINK' => append_sid("admin_group_extend.$phpEx?group_page=1&amp;gid=$group_iden"),
			'ROW_COLOR' => "#" . $row_color,
			'ROW_CLASS' => $row_class,
			'GL_USERS' => $gcount,
			'GL_NAME' => $group_disp)
			);
		}
		break;

	default:
		if ( !$group_page )
		{
			$template->assign_block_vars( 'group_page.groups' , array());
			$gcount = '';
			$ssql = "SELECT * FROM " . GROUPS_TABLE . " 
			WHERE group_single_user <> " . TRUE . "
			ORDER BY $order_by2";
			if ( !$sresult = $db->sql_query($ssql) ) 
			{
				message_die(GENERAL_ERROR, 'Could not read groups', '', __LINE__, __FILE__, $ssql);	
			}
			while ($srow = $db->sql_fetchrow($sresult))
			{
				$user_groups[] = $srow;
			}

			for($i = 0; $i < count($user_groups);$i++)
			{
				$group_iden = $user_groups[$i]['group_id'];
				$psql = "SELECT u.username , u.user_id , g.group_name , g.group_id
				FROM 
				" . USER_GROUP_TABLE . " ug, 
				" . GROUPS_TABLE . " g, 
				" . USERS_TABLE . " u
				WHERE ug.user_pending = 0 
				AND g.group_single_user = 0 
				AND g.group_id = ug.group_id 
				AND g.group_id = $group_iden
				AND u.user_id = ug.user_id 
				ORDER BY g.group_name";
				if ( !$presult = $db->sql_query($psql) ) 
				{
					message_die(GENERAL_ERROR, 'Could not read groups', '', __LINE__, __FILE__, $psql);	
				}
				$prow = $db->sql_fetchrowset($presult);
				$gcount ='<br />';

					for($h = 0; $h < count($prow);$h++)
					{
						$name = $prow[$h]['username'];
						$gcount .= $name.'<br />';
					}

				$group_disp = $user_groups[$i]['group_name'];
				$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
				$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
				$template->assign_block_vars('group_page.groups.groups_list_name',array(
				'LINK' => append_sid("admin_group_extend.$phpEx?group_page=1&amp;gid=$group_iden"),
				'ROW_COLOR' => "#" . $row_color,
				'ROW_CLASS' => $row_class,
				'GL_USERS' => $gcount,
				'GL_NAME' => $group_disp)
				);
			}
		}
		break;

}

$template->assign_vars(array(
	'PAGINATION' => $pagination,
	'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $board_config['topics_per_page'] ) + 1 ), ceil( $total_members / $board_config['topics_per_page'] )), 
	'L_GOTO_PAGE' => $lang['Goto_page'],
	'L_SELECT_SORT_METHOD' => $lang['Select_sort_method'],
	'L_ORDER' => $lang['Order'],
	'L_SORT' => $lang['Sort'],
	'L_SELECT_GROUP_DISP' => $lang['Group_extend_select'],
	'L_SUBMIT' => $lang['Group_extend_select_submit'],
	'L_FORUM_MOD' => $lang['Group_extend_mod'],
	'L_FORUM_READ' => $lang['Group_extend_read'],
	'L_FORUM_VIEW' => $lang['Group_extend_view'],
	'L_FORUM_POST' => $lang['Group_extend_post'],
	'L_FORUM_REPLY' => $lang['Group_extend_reply'],
	'L_GROUP_EXTEND_TITLE' => $lang['Group_extend_title'],
	'L_GROUP_EXTEND_TEXT' => $lang['Group_extend_text'],
	'L_GROUP_EXTEND_GROUPS' => $lang['Group_extend_groups'],
	'L_GROUP_EXTEND_USERS' => $lang['Group_extend_users'],
	'S_GROUP_DISP_SELECT' => $select_group_extend_number,
	'S_MODE_SELECT' => $select_sort_mode,
	'S_ORDER_SELECT' => $select_sort_order,
	'S_MODE_ACTION' => append_sid("admin_group_extend.$phpEx"),
	'S_GROUP_DISP_ACTION' => append_sid("admin_group_extend.$phpEx"))
);

$template->pparse("body");

include('./page_footer_admin.'.$phpEx);

?>