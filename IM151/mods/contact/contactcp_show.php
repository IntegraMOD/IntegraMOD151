<?php
/***************************************************************************
 *                             contactcp_show.php
 *                            -------------------
 *   begin                : Tuesday, Feb 18, 2003
 *   version              : 0.3.0
 *   date                 : 2003/12/23 23:23
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
}

if( $type != 'buddy_of' && $type != 'buddy' && $type != 'ignore' && $type != 'disallow' && $type != 'addusers' && $type != 'alert' )
{
	message_die(GENERAL_ERROR, $lang['No_contact_type']);
}

$list = '';
$type_title = '';
$num = 0;
$total_num = 0;
$allow_edit = false;
$move1 = '';
$move2 = '';
$move_type1 = '';
$move_type2 = '';
$l_alert = '';
$alert_edit = '';
$l_no_list = '';
$confirm_msg = '';
$total_text = '';
$body_template = 'show.tpl';

switch($type)
{
	case 'addusers':
		$type_title = $lang['Add_contact_users_link'];
		$body_template = 'multiadd.tpl';
		
		break;
	case 'buddy_of':
		$contact_list->get_list('buddy_of', true, $start, $sort_order);
		$num = count($contact_list->buddy_of);
	    $total_num = $contact_list->get_count($userdata['user_id'], 'buddy_of');
		$type_title = $lang['Users_buddy_you'];
		$l_no_list = ( !$total_num ) ? $lang['None_buddy_you'] : '';
		$total_text = ( !$total_num ) ? '': ( ($total_num > 1) ? sprintf($lang['You_as_buddies'], $total_num):  $lang['You_as_buddy']);
		break;
	case 'disallow':
		$contact_list->get_list('disallow', true, $start, $sort_order);
		$num = count($contact_list->disallow);
	    $total_num = $contact_list->get_count($userdata['user_id'], 'disallow');
		$type_title = $lang['Users_you_disallow'];
		$l_no_list = ( !$total_num ) ? $lang['None_you_disallow'] : '';
		$total_text = ( !$total_num ) ? '': ( ($total_num > 1) ? sprintf($lang['You_have_disallowed'], $total_num):  $lang['You_have_disallowed_one']);
		$allow_edit = true;
		$move1 = $lang['Buddy'];
		$move2 = $lang['Ignore'];
		$move_type1 = 'buddy';
		$move_type2 = 'ignore';
		$confirm_msg = $lang['Disallow_add_msg'];
		$body_template = 'edit.tpl';
		break;
	case 'ignore':
		$contact_list->get_list('ignore', true, $start, $sort_order);
		$num = count($contact_list->ignore);
	    $total_num = $contact_list->get_count($userdata['user_id'], 'ignore');
		$type_title = $lang['Users_you_ignore'];
		$l_no_list = ( !$total_num ) ? $lang['None_you_ignore'] : '';
		$total_text = ( !$total_num ) ? '': ( ($total_num > 1) ? sprintf($lang['You_are_ignoring'], $total_num):  $lang['You_are_ignoring_one']);
		$allow_edit = true;
		$move1 = $lang['Buddy'];
		$move2 = $lang['Disallow'];
		$move_type1 = 'buddy';
		$move_type2 = 'disallow';
		$confirm_msg = $lang['Ignore_add_msg'];
		$body_template = 'edit.tpl';
		break;
	case 'buddy':
		$contact_list->get_list('buddy', true, $start, $sort_order);
		$num = count($contact_list->buddy);
	    $total_num = $contact_list->get_count($userdata['user_id'], 'buddy');
		$confirm_msg = $lang['Buddy_add_msg'];
		$type_title = $lang['Users_you_buddy'];
		$alert_edit = sprintf('<a href="' . append_sid($phpbb_root_path . "contact.$phpEx?mode=show&type=alert") . '">%s</a>', $lang['Edit_alerts']);
		$l_no_list = ( !$total_num ) ? $lang['None_you_buddy'] : '';
		$total_text = ( !$total_num ) ? '': ( ($total_num > 1) ? sprintf($lang['You_have_buddies'], $total_num):  $lang['You_have_buddy']);
		$allow_edit = true;
		$move1 = $lang['Ignore'];
		$move2 = $lang['Disallow'];
		$move_type1 = 'ignore';
		$move_type2 = 'disallow';
		$l_alert = $lang['Be_alerted'];
		$body_template = 'edit.tpl';
		break;
	case 'alert':
		$contact_list->get_list('buddy', true, $start, $sort_order);
		$num = count($contact_list->buddy);
	    $total_num = $contact_list->get_count($userdata['user_id'], 'buddy');
		$type_title = $lang['Users_you_buddy'];
		$l_no_list = ( !$total_num ) ? $lang['None_you_buddy'] : '';
		$total_text = ( !$total_num ) ? '': ( ($total_num > 1) ? sprintf($lang['You_have_buddies'], $total_num):  $lang['You_have_buddy']);
		$allow_edit = true;
		$l_alert = $lang['Be_alerted'];
		$body_template = 'alert_edit.tpl';
		break;
}

$template->set_filenames(array(
	'body' => 'contact/' . $body_template)
);

$template->assign_vars(array(
	'TYPE_TITLE' => $type_title,
	'L_ALERT' => $l_alert,
	'ALERT_EDIT' => $alert_edit,
	'TOTAL_TEXT' => $total_text,
	'L_SELECT' => $lang['Select'],
	'NO_LIST' => $l_no_list,
	'L_MARK_ALL' => $lang['Mark_all'],
	'L_UNMARK_ALL' => $lang['Unmark_all'],
	'L_SUBMIT' => $lang['Submit'],
	'L_GOTO_PAGE' => $lang['Goto_page']
));

if( $num )
{
	$select_sort_order = '<select name="order">';
	if($sort_order == 'ASC')
	{
		$select_sort_order .= '<option value="ASC" selected="selected">' . $lang['Sort_Ascending'] . '</option><option value="DESC">' . $lang['Sort_Descending'] . '</option>';
	}
	else
	{
		$select_sort_order .= '<option value="ASC">' . $lang['Sort_Ascending'] . '</option><option value="DESC" selected="selected">' . $lang['Sort_Descending'] . '</option>';
	}
	$select_sort_order .= '</select>&nbsp;&nbsp; <input type="submit" name="submit" value="' . $lang['Submit'] . '" class="liteoption" />';
	
	$template->assign_vars(array(
		'S_SORT_ACTION' => append_sid("contact.$phpEx?mode=$mode&amp;type=$type&amp;start=$start"),
		'L_ORDER' => $lang['Order'],
		'S_ORDER_SELECT' => $select_sort_order
		)
	);

	if( $allow_edit )
	{
		$s_hidden_fields = '<input type="hidden" name="mode" value="edit" /><input type="hidden" name="type" value="' . $type . '" /><input type="hidden" name="start" value="' . $start . '" /><input type="hidden" name="order" value="' . $sort_order . '" />';

		$template->assign_block_vars('list', array(
			'S_FORM_ACTION' => append_sid(CONTACT_URL),
			'S_HIDDEN_FIELDS' => $s_hidden_fields,
			'L_MOVE' => $lang['Move_selected_users'],
			'MOVE_1' => $move1,
			'MOVE_2' => $move2,
			'MOVE_TYPE1' => $move_type1,
			'MOVE_TYPE2' => $move_type2,
			'L_REMOVE_SELECTED' => $lang['Remove_selected']
		));
	}
	else
	{
		$s_hidden_fields = '<input type="hidden" name="mode" value="edit" /><input type="hidden" name="action" value="update" /><input type="hidden" name="type" value="buddy" /><input type="hidden" name="start" value="' . $start . '" /><input type="hidden" name="order" value="' . $sort_order . '" />';
		$template->assign_block_vars('list', array(
			'S_FORM_ACTION' => append_sid($phpbb_root_path . "contact.$phpEx"),
			'S_HIDDEN_FIELDS' => $s_hidden_fields,
			'L_ADD_TO_BUDDY' => $lang['Add_Selected_as_Buddies']
		));
	}

	$temp_profile_url = $phpbb_root_path . "profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=';
	$temp_pm_url = $phpbb_root_path . "profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=';

	$temp_type = ( $type == 'alert' ) ? 'buddy' : $type;
	$i = 0;
	foreach($contact_list->$temp_type as $key=>$val)
	{
		$profile_url = append_sid($temp_profile_url . $key);
		$s_checked = ( $val['alert'] ) ? 'checked="checked"' : '';
		$profile_img = '<a href="' . $profile_url . '"><img src="' . $images['icon_profile'] . '" alt="' . $lang['Read_profile'] . '" title="' . $lang['Read_profile'] . '" border="0" /></a>';
		$profile = '<a href="' . $profile_url . '">' . $lang['Read_profile'] . '</a>';

		$pm_url = append_sid($temp_pm_url . $key);
		$pm_img = '<a href="' . $pm_url . '"><img src="' . $images['icon_pm'] . '" alt="' . $lang['Send_private_message'] . '" title="' . $lang['Send_private_message'] . '" border="0" /></a>';
		$pm = '<a href="' . $pm_url . '">' . $lang['Send_private_message'] . '</a>';

		$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
		$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

		$template->assign_block_vars('list.list_row', array(
			'ROW_NUMBER' => $i + ( $start + 1 ),
			'ROW_COLOR' => '#' . $row_color,
			'ROW_CLASS' => $row_class,
			'U_PROFILE' => $profile_url,
			'USERNAME' => $val['username'],
			'PROFILE_IMG' => $profile_img,
			'PROFILE' => $profile,
			'PM_IMG' => $pm_img,
			'PM' => $pm,
			'S_MARK_ID' => $key,
			'S_CHECKED' => $s_checked
		));

		if( $type == 'buddy_of' )
		{
			if( !array_key_exists($key, $contact_list->buddy) )
			{
				$template->assign_block_vars('list.list_row.mark', array(
					'S_MARK_ID' => $key
				));
			}
		}
		$i++;
	}

	if( $total_num )
	{
		$pagination = generate_pagination("contact.$phpEx?mode=$mode&amp;type=$type&amp;order=$sort_order", $total_num, $board_config['topics_per_page'], $start). '&nbsp;';

		$template->assign_vars(array(
			'PAGINATION' => $pagination,
			'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $board_config['topics_per_page'] ) + 1 ), ceil( $total_num / $board_config['topics_per_page'] ))
			)
		);
	}
}
elseif( $type == 'addusers' )
{
	$s_hidden_fields = '<input type="hidden" name="mode" value="edit" /><input type="hidden" name="action" value="update" />';

	$template->assign_vars(array(
		'L_RESET' => $lang['Reset'],
		'L_SUBMIT' => $lang['Submit'],
		'L_ADD_CONTACTS_EXPLAIN' => $lang['Add_many_contacts_explain'],
		'L_ADD_TO_BUDDY_LIST' => $lang['Add_to_Buddy_List'],
		'L_ADD_TO_IGNORE_LIST' => $lang['Add_to_Ignore_List'],
		'L_ADD_TO_DISALLOW_LIST' => $lang['Add_to_Disallow_List'],

		'S_FORM_ACTION' => append_sid(CONTACT_URL),
		'S_HIDDEN_FIELDS' => $s_hidden_fields
	));
}
else
{
	$template->assign_block_vars('top', array());
	$template->assign_vars(array('PAGINATION' => '', 'PAGE_NUMBER' => ''));
}

$template->pparse('body');


if( $allow_edit )
{
	if( $type == 'alert' )
	{
		$type = 'buddy'; 
	}

	$template->set_filenames(array(
		'finduser' => 'contact/find_user.tpl')
	);

	$s_hidden_fields = '<input type="hidden" name="mode" value="edit" /><input type="hidden" name="action" value="add" /><input type="hidden" name="type" value="' . $type . '" />';

	$template->assign_block_vars('find_user', array(
		'L_ADD_A_USER' => $lang['Add_a_user'],
		'L_ADD_USER' => $lang['Add_user'],
		'L_FIND_USERNAME' => $lang['Find_username'],
		'U_SEARCH_USER' => append_sid($phpbb_root_path . "search.$phpEx?mode=searchuser"),
		'S_FORM_ACTION' => append_sid(CONTACT_URL),
		'S_HIDDEN_FIELDS' => $s_hidden_fields,
		'CONFIRM_MSG' => $confirm_msg
	));

	if( $type == 'buddy' )
	{
		$template->assign_block_vars('find_user.alert', array());
	}

	$template->pparse('finduser');
}



?>