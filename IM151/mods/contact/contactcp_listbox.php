<?php
/***************************************************************************
 *                           contactcp_listbox.php
 *                            -------------------
 *   begin                : Saturday, Mar 22, 2003
 *   version              : 0.1.2
 *   date                 : 2003/12/23 23:23
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
}

$list = '';
$total_num = 0;

// Max number of buddies to show in the little box
// This should be in the admin panel later or something
$limit_max = 5;

$total_num = count($contact_list->buddy);
$contact_list->get_list('buddy', true, $start, $sort_order, $limit_max);

$template->set_filenames(array(
	'body' => 'contact/listbox.tpl')
);

$template->assign_vars(array(
	'L_BUDDY_TITLE' => $lang['Listbox_Buddies'],
	'NO_LIST' => $lang['None_you_buddy'],
	'L_GOTO_PAGE' => $lang['Goto_page']
));


if( $total_num )
{
	$template->assign_block_vars('list', array());
	foreach($contact_list->buddy as $val)
	{
		$temp_id = ( isset($val['user_id']) ) ? $val['user_id'] : $val['contact_id'];
		$profile_url = $temp_url . $temp_id;
		if( in_array($temp_id, $online_array) )
		{
			$on_off_status = $lang['Online'];
		}
		else
		{
			$on_off_status = $lang['Offline'];
		}

		if( $mode == 'popup' )
		{
			$jscript_onclick = 'onClick="refresh_username(\'' . $val['username'] . '\');return false"';
			$u_onclick = 'javascript: refresh_username(\'' . $val['username'] . '\');return false"';
		}
		else
		{
			$jscript_onclick = '';
			$u_onclick = append_sid($profile_url);
		}

		$template->assign_block_vars('list.list_row', array(
			'U_ONCLICK' => $u_onclick,
			'USERNAME' => $val['username'],
			'J_ONCLICK' => $jscript_onclick,
			'ONLINE_STATUS' => $on_off_status
		));
	}
		
	$pagination = generate_pagination(CONTACT_URL . "?mode=$mode&amp;simple=$simple&amp;order=$sort_order", $total_num, $limit_max, $start). '&nbsp;';

	$template->assign_vars(array(
		'PAGINATION' => $pagination,
		'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $board_config['topics_per_page'] ) + 1 ), ceil( $total_num / $board_config['topics_per_page'] ))
		)
	);
}
else
{
	$template->assign_block_vars('top', array());
	$template->assign_vars(array(
		'PAGINATION' => '',
		'PAGE_NUMBER' => ''
		)
	);
}

$template->pparse('body');

?>