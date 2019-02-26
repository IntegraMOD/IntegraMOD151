<?php 
/***************************************************************************
 *					adr_courthouse.php
 *				------------------------
 *	begin 			: 26/02/2004
 *	copyright			: Malicious Rabbit / Dr DLP
 *
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 *
 ***************************************************************************/

define('IN_PHPBB', true); 

define('IN_TOWNMAP_COPYRIGHT', true);
define('IN_ADR_TOWNMAP', true);


define('IN_ADR_CELL' , true);
define('IN_ADR_CHARACTER', true); 
$phpbb_root_path = './'; 
include($phpbb_root_path . 'extension.inc'); 
include($phpbb_root_path . 'common.'.$phpEx);
include($phpbb_root_path . 'adr/includes/adr_global.'.$phpEx);

$loc = 'town';
$sub_loc = 'adr_courthouse';

//
// Start session management
$userdata = session_pagestart($user_ip, PAGE_ADR); 
init_userprefs($userdata); 
// End session management
//
$user_id = $userdata['user_id'];

// Sorry , only logged users ...
if ( !$userdata['session_logged_in'] )
{
	$redirect = "adr_courthouse.$phpEx";
	$redirect .= ( isset($user_id) ) ? '&user_id=' . $user_id : '';
	header('Location: ' . append_sid("login.$phpEx?redirect=$redirect", true));
}

// Include the header
include_once($phpbb_root_path . 'includes/page_header.'.$phpEx);

// Get the general config
$adr_general = adr_get_general_config();

adr_enable_check();
adr_ban_check($user_id);
adr_character_created_check($user_id);


//
//BEGIN zone Prison Restriction
//
$zone_user = adr_get_user_infos($user_id);
$actual_zone = $zone_user['character_area'];



$sql = " SELECT * FROM  " . ADR_ZONES_TABLE . "
       WHERE zone_id = $actual_zone ";
if( !($result = $db->sql_query($sql)) )
        message_die(GENERAL_ERROR, 'Could not query area list', '', __LINE__, __FILE__, $sql);



$info = $db->sql_fetchrow($result);
$access = $info['zone_prison'];



if ( $access == '0' )
	adr_previous( Adr_zone_building_noaccess , adr_zones , '' );
//
//END zone Prison Restriction
//


// Update the time sentence
adr_cell_update_users();

$punishment[1] = $lang['Adr_cell_punishment_global'];
$punishment[2] = $lang['Adr_cell_punishment_posts'];
$punishment[3] = $lang['Adr_cell_punishment_read'];

$start = ( isset($HTTP_GET_VARS['start']) ) ? intval($HTTP_GET_VARS['start']) : 0;
$celled_list = $HTTP_POST_VARS['celled_list'];
$caution = $HTTP_POST_VARS['caution_pay'];
$guilty = $HTTP_POST_VARS['guilty'];
$innocent = $HTTP_POST_VARS['innocent'];
$blank = $HTTP_POST_VARS['blank'];
$celled_id = intval($HTTP_POST_VARS['celled_id']);
$celled_user_id = intval($HTTP_GET_VARS['celled_user_id']);

if ( isset($HTTP_GET_VARS['from']) || isset($HTTP_POST_VARS['from']) )
{
	$from = ( isset($HTTP_POST_VARS['from']) ) ? htmlspecialchars($HTTP_POST_VARS['from']) : htmlspecialchars($HTTP_GET_VARS['from']);
}
else
{
	$from = 'list';
}

if ( $celled_user_id )
{
	$from = 'judgement_page';
}
elseif ($celled_list)
{
	$from = 'celleds_list';
}
else if ($caution)
{
	$from = 'caution_pay';
}
else if ($guilty) 
{ 
	$vote = 0; 
	$from = 'judgement'; 
} 
else if ($innocent) 
{ 
	$vote = 1; 
	$from = 'judgement'; 
}
else if ($blank)
{
	$from = 'blank';
}

switch( $from )
{
	case 'blank' :

		if ( $userdata['user_points'] < $adr_general['cell_amount_user_blank'] )
		{
			message_die(GENERAL_MESSAGE, $lang['Adr_cell_lack_money']);
		}

		$ssql = "SELECT celled_id FROM " . ADR_JAIL_USERS_TABLE . "
			ORDER BY celled_id
			DESC LIMIT 1 ";
		if (!$db->sql_query($ssql))
		{
			message_die(GENERAL_ERROR, "Could not update user's jail infos", '', __LINE__, __FILE__, $ssql);
		}
		$total = $db->sql_fetchrow($sresult);
		$cell_id = $total['celled_id'];

		$imprisonned = 0;
		$more_sql = '';

		if ( $userdata['user_cell_time'] > 0 )
		{
			$more_sql = 'AND celled_id <> ".$cell_id." ';
			$imprisonned = 1;
		}

		$sql = "DELETE FROM " . ADR_JAIL_USERS_TABLE . " 
			WHERE user_id = $user_id
			$more_sql ";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR,"", __LINE__, __FILE__, $sql);
		}

		$sql = "UPDATE ".USERS_TABLE."
			SET user_points = user_points - ".$adr_general['cell_amount_user_blank']." ,
		  	    user_cell_celleds = $imprisonned
			WHERE user_id = $user_id ";
		if( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not update user points', '', __LINE__, __FILE__, $sql);
		}

		$message = $lang['Adr_cell_blank_done'].'<br /><br />'.sprintf($lang['Adr_cell_return'],"<a href=\"" . append_sid("adr_courthouse.$phpEx") . "\">", "</a>") ;
		message_die(GENERAL_MESSAGE, $message );

		break;

	case 'caution_pay' :

		$sledge_price = intval($HTTP_POST_VARS['sledge_price']);

		if ( $userdata['user_points'] < $sledge_price )
		{
			message_die(GENERAL_MESSAGE, $lang['Adr_cell_lack_money']);
		}

		subtract_reward( $user_id, $sledge_price );

		adr_cell_free_user( $celled_id , $user_id );

		$message = $lang['Adr_cell_sledge_paid'].'<br /><br />'.sprintf($lang['Adr_cell_return'],"<a href=\"" . append_sid("adr_courthouse.$phpEx") . "\">", "</a>") ;
		message_die(GENERAL_MESSAGE, $message );
			
		break;

	case 'celleds_list' :

		adr_template_file('adr_cell_courthouse_list_body.tpl');

		if ( isset($HTTP_GET_VARS['mode']) || isset($HTTP_POST_VARS['mode']) )
		{
			$mode = ( isset($HTTP_POST_VARS['mode']) ) ? htmlspecialchars($HTTP_POST_VARS['mode']) : htmlspecialchars($HTTP_GET_VARS['mode']);
		}
		else
		{
			$mode = 'username';
		}

		if(isset($HTTP_POST_VARS['order']))
		{
			$sort_order = ($HTTP_POST_VARS['order'] == 'ASC') ? 'ASC' : 'DESC';
		}
		else if(isset($HTTP_GET_VARS['order']))
		{
			$sort_order = ($HTTP_GET_VARS['order'] == 'ASC') ? 'ASC' : 'DESC';
		}
		else
		{
			$sort_order = 'ASC';
		}

		$mode_types_text = array( $lang['Sort_Username'],$lang['Adr_cell_freed_type'] ,$lang['Adr_cell_celled_time'],$lang['Adr_cell_celled_date'],$lang['Adr_cell_admin_celled_caution'],$lang['Adr_cell_imprisonments']);
		$mode_types = array('username', 'freed','cell_time', 'cell_date','caution','cell_times');

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

		switch( $mode )
		{
			case 'username':
				$order_by = "u.username $sort_order LIMIT $start, " . $board_config['topics_per_page'];
				break;
			case 'freed':
				$order_by = "j.user_freed_by $sort_order LIMIT $start, " . $board_config['topics_per_page'];
				break;
			case 'cell_time':
				$order_by = "j.user_time $sort_order LIMIT $start, " . $board_config['topics_per_page'];
				break;
			case 'cell_date':
				$order_by = "j.user_cell_date $sort_order LIMIT $start, " . $board_config['topics_per_page'];
				break;
			case 'caution':
				$order_by = "j.user_caution $sort_order LIMIT $start, " . $board_config['topics_per_page'];
				break;
			case 'cell_times':
				$order_by = "u.user_cell_celleds $sort_order LIMIT $start, " . $board_config['topics_per_page'];
				break;
			default:
				$order_by = "u.username $sort_order LIMIT $start, " . $board_config['topics_per_page'];
				break;
		}

		$sql = "SELECT * FROM " . ADR_JAIL_USERS_TABLE . " j , " . USERS_TABLE . " u
			WHERE u.user_id = j.user_id
			ORDER BY $order_by";
		if( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not query users', '', __LINE__, __FILE__, $sql);
		}

		if ( $row = $db->sql_fetchrow($result) )
		{
			$i = 0;
			do
			{
				if ( $i == '0' ) 
				{ 
					$template->assign_block_vars('cell_user', array()); 
				}

				$username = $row['username'];
				$user_id = $row['user_id'];
				$profile_img = '<img src="' . $images['icon_profile'] . '" alt="' . $lang['Read_profile'] . '" title="' . $lang['Read_profile'] . '" border="0" />';

				if ( $row['user_freed_by'] =='1' )
				{
					$freed_by = $lang['Adr_cell_freed_type_time'];
				}
				else if ( $row['user_freed_by'] =='2' )
				{
					$freed_by = $lang['Adr_cell_freed_type_admin'];
				}
				else if ( $row['user_freed_by'] =='0' )
				{
					$freed_by = $lang['Adr_cell_freed_type_still'];
				}
				else
				{
					$nsql = "SELECT username , user_id FROM " . USERS_TABLE . "
						WHERE user_id = " . $row['user_freed_by'] . " ";
					if( !($nresult = $db->sql_query($nsql)) )
					{
						message_die(GENERAL_ERROR, 'Could not query users', '', __LINE__, __FILE__, $nsql);
					}
					$nrow = $db->sql_fetchrow($nresult);
					$freed_by = $nrow['username'];
				}

				$celled_times = $row['user_cell_celleds'];
				$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
				$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

				$template->assign_block_vars('cell_user.cell_users', array(
					'ROW_CLASS' => $row_class,
					'USERNAME' => $username ,
					'TIME' => adr_make_time($row['user_time']),
					'DATE' => create_date($board_config['default_dateformat'], $row['user_cell_date'], $board_config['board_timezone']),
					'SLEDGE' => $row['user_caution'],
					'PROFILE_IMG' => $profile_img, 
					'FREED_BY' => $freed_by, 
					'CELLED_TIMES' => $celled_times,
					'U_VIEWPROFILE' => append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$user_id"))
				);

				$i++;
			}
			while ( $row = $db->sql_fetchrow($result) );
		}
		else
		{
			$template->assign_block_vars('cell_no_users', array());
		}

		$sql = "SELECT count(*) AS total FROM " . ADR_JAIL_USERS_TABLE ;
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Error getting total users', '', __LINE__, __FILE__, $sql);
		}

		if ( $total = $db->sql_fetchrow($result) )
		{
			$total_members = $total['total'];
			$pagination = generate_pagination("adr_courthouse.$phpEx?from=celleds_list&amp;mode=$mode&amp;order=$sort_order", $total_members, $board_config['topics_per_page'], $start). '&nbsp;';
		}
		if ( $userdata['user_cell_celleds'] && $adr_general['cell_allow_user_blank'] )
		{
			$template->assign_block_vars('user_blank', array());	
			$blank_text = sprintf($lang['Adr_cell_blank_text'],$adr_general['cell_amount_user_blank'].'&nbsp;'.get_reward_name());
		}	

		$template->assign_vars(array(
			'PAGINATION' => $pagination,
			'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $board_config['topics_per_page'] ) + 1 ), ceil( $total_members / $board_config['topics_per_page'] )), 
			'L_GOTO_PAGE' => $lang['Goto_page'],
			'L_SELECT_SORT_METHOD' => $lang['Select_sort_method'],
			'L_IMPRISONNED_LIST'   => $lang['Adr_cell_celled_list_history'],
			'L_BLANK' => $lang['Adr_cell_blank_explain'],
			'L_BLANK_EXPLAIN' => $blank_text,
			'S_MODE_SELECT' => $select_sort_mode,
			'S_ORDER_SELECT' => $select_sort_order,
		));

		break;

	case 'judgement' :
		$sql = "SELECT vote_result FROM " . ADR_JAIL_VOTES_TABLE . "
		   WHERE vote_id = '$celled_id'
		   AND voter_id = '$user_id'";
		if( !($result = $db->sql_query($sql)) )
		{
		   message_die(GENERAL_ERROR, 'Could not check for previous vote', '', __LINE__, __FILE__, $sql);
		}
		$vote_check = $db->sql_fetchrow($result);
		if(is_numeric($vote_check['vote_result'])) adr_previous(Adr_cell_vote_only_once, adr_courthouse, '');

		$sql = "INSERT INTO " . ADR_JAIL_VOTES_TABLE . "
			( vote_id , voter_id , vote_result )
			VALUES ( ".$celled_id." , ".$user_id." , ".$vote." )";
		if( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not update user points', '', __LINE__, __FILE__, $sql);
		}

		$sql = "SELECT count(*) AS total_votes FROM " . ADR_JAIL_VOTES_TABLE . "
			WHERE vote_id = ".$celled_id;
		if( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not update user points', '', __LINE__, __FILE__, $sql);
		}
		$row = $db->sql_fetchrow($result);
		$total = $row['total_votes'];

		$votes = 0;
		if ( $total >= $adr_general['cell_user_judge_voters'] )
		{
			$sql = "SELECT * FROM " . ADR_JAIL_VOTES_TABLE . "
			WHERE vote_id = $celled_id ";
			if( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not update user points', '', __LINE__, __FILE__, $sql);
			}
			$row = $db->sql_fetchrowset($result);
			for ( $i = 0 ; $i < count($row) ; $i ++)
			{
				$votes = $votes + $row[$i]['vote_result'];
			}
			$medium = floor ( $adr_general['cell_user_judge_voters'] / 2 );

			if ( $votes > $medium )
			{
				adr_cell_free_user( $celled_id , 2 );
			}	
			else 
			{
				$sql = "UPDATE " . USERS_TABLE . " 
				SET user_cell_enable_free = 2
				WHERE user_id = $celled_id ";
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR,"", __LINE__, __FILE__, $sql);
				}

				$sql = "DELETE FROM " . ADR_JAIL_VOTES_TABLE . " 
				WHERE vote_id = $celled_id ";
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR,"", __LINE__, __FILE__, $sql);
				}
			}
		}

		$message = $lang['Adr_cell_judgement_done'].'<br /><br />'.sprintf($lang['Adr_cell_return'],"<a href=\"" . append_sid("adr_courthouse.$phpEx") . "\">", "</a>") ;
		message_die(GENERAL_MESSAGE, $message );

	break;

	case 'judgement_page' :

		adr_template_file('adr_cell_courthouse_judge_body.tpl');

		$sql = "SELECT * FROM " . USERS_TABLE . "
			WHERE user_id = $celled_user_id
			AND user_cell_time > 0 ";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR,"", __LINE__, __FILE__, $sql);
		}
		$celled_data = $db->sql_fetchrow($result);
		$celled_id = $celled_data['user_id'];

		$can_vote = FALSE;

		$sql = "SELECT vote_result FROM " . ADR_JAIL_VOTES_TABLE . "
			WHERE voter_id = $user_id
			AND vote_id = $celled_id ";
		if( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain vote results', '', __LINE__, __FILE__, $sql);
		}
		$row = $db->sql_fetchrow($result);

		if ( !(is_numeric($row['vote_result'])))
		{
			$can_vote = TRUE;
		}

		if ( $celled_data['user_cell_enable_caution'] && $adr_general['cell_allow_user_caution'] )
		{
			$template->assign_block_vars('caution_authed',array());
		}
		else if ( !$celled_data['user_cell_enable_caution'] && $adr_general['cell_allow_user_caution'] )
		{
			$template->assign_block_vars('caution_not_authed',array());
		}
		if ( $celled_data['user_cell_enable_free'] && $adr_general['cell_allow_user_judge'] &&  ( $adr_general['cell_user_judge_posts'] < $userdata['user_posts'] ) && $can_vote )
		{
			$template->assign_block_vars('judge_authed',array());
		}
		else if (  $adr_general['cell_allow_user_judge'] && ( !$celled_data['user_cell_enable_free'] || ($adr_general['cell_user_judge_posts'] > $userdata['user_posts'] )))
		{
			$template->assign_block_vars('judge_not_authed',array());
		}
		else if (  $adr_general['cell_allow_user_judge'] && ( $celled_data['user_cell_enable_free'] =='2' ))
		{
			$template->assign_block_vars('judge_authed_ever',array());
		}
		else
		{
			$template->assign_block_vars('judge_ever',array());
		}

		$template->assign_vars(array(
			'NAME' => $celled_data['username'],
			'CAUTION' => $celled_data['user_cell_caution'],
			'SENTENCE' => $celled_data['user_cell_sentence'],
			'TIME' => adr_make_time($celled_data['user_cell_time']),
			'CELLEDS' => $celled_data['user_cell_celleds'],
			'PUNISHMENT' => $punishment[$celled_data['user_cell_punishment']],
			'CELLED_ID' => $celled_id,
			'L_PAY_CAUTION' => $lang['Adr_cell_judgement_pay_sledge'],
			'L_SENTENCE' => $lang['Adr_cell_sentence'],
			'L_JUDGEMENT' => $lang['Adr_cell_judgement'],
		));

		break;

	case 'list' :

		adr_template_file('adr_cell_courthouse_body.tpl');

		if ( isset($HTTP_GET_VARS['mode']) || isset($HTTP_POST_VARS['mode']) )
		{
			$mode = ( isset($HTTP_POST_VARS['mode']) ) ? htmlspecialchars($HTTP_POST_VARS['mode']) : htmlspecialchars($HTTP_GET_VARS['mode']);
		}
		else
		{
			$mode = 'username';
		}

		if(isset($HTTP_POST_VARS['order']))
		{
			$sort_order = ($HTTP_POST_VARS['order'] == 'ASC') ? 'ASC' : 'DESC';
		}
		else if(isset($HTTP_GET_VARS['order']))
		{
			$sort_order = ($HTTP_GET_VARS['order'] == 'ASC') ? 'ASC' : 'DESC';
		}
		else
		{
			$sort_order = 'ASC';
		}

		$mode_types_text = array( $lang['Sort_Username'],$lang['Adr_cell_celled_time'] ,$lang['Adr_cell_admin_celled_caution']);
		$mode_types = array('username', 'cell_time', 'caution');

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

		switch( $mode )
		{
			case 'username':
				$order_by = "username $sort_order LIMIT $start, " . $board_config['topics_per_page'];
				break;
			case 'cell_time':
				$order_by = "user_cell_time $sort_order LIMIT $start, " . $board_config['topics_per_page'];
				break;
			case 'caution':
				$order_by = "user_cell_caution $sort_order LIMIT $start, " . $board_config['topics_per_page'];
				break;
			default:
				$order_by = "username $sort_order LIMIT $start, " . $board_config['topics_per_page'];
				break;
		}

		$sql = "SELECT * FROM " . USERS_TABLE . "
			WHERE user_cell_time > 0
			ORDER BY $order_by";
		if( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not query users', '', __LINE__, __FILE__, $sql);
		}

		if ( $row = $db->sql_fetchrow($result) )
		{
			$i = 0;
			do
			{
				if ( $i == '0' ) 
				{ 
					$template->assign_block_vars('cell_user', array()); 
				}

				$username = $row['username'];
				$cuser_id = $row['user_id'];
				$profile_img = '<img src="' . $images['icon_profile'] . '" alt="' . $lang['Read_profile'] . '" title="' . $lang['Read_profile'] . '" border="0" />';
				$judgement_img = '<img src="adr/images/misc/icon_justice.gif" alt="' . $lang['Adr_cell_judge_user'] . '" title="' . $lang['Adr_cell_judge_user'] . '" border="0" />';

				$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
				$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

				$template->assign_block_vars('cell_user.cell_users', array(
					'ROW_CLASS' => $row_class,
					'CELLED_ID' => $cuser_id,
					'USERNAME' => $username ,
					'TIME' => adr_make_time($row['user_cell_time']),
					'SLEDGE' => $row['user_cell_caution'],
					'PROFILE_IMG' => $profile_img, 
					'JUDGEMENT_IMG' => $judgement_img,
					'PUNISHMENT' => $punishment[$row['user_cell_punishment']],
					'U_JUDGEMENT' => append_sid("adr_courthouse.$phpEx?celled_user_id=$cuser_id"),
					'U_VIEWPROFILE' => append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$cuser_id"))
				);

				$i++;
			}
			while ( $row = $db->sql_fetchrow($result) );
		}
		else
		{
			$template->assign_block_vars('cell_no_users', array());
		}

		$sql = "SELECT count(*) AS total FROM " . USERS_TABLE ."
		WHERE user_cell_time > 0 ";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Error getting total users', '', __LINE__, __FILE__, $sql);
		}

		if ( $total = $db->sql_fetchrow($result) )
		{
			$total_members = $total['total'];
			$pagination = generate_pagination("adr_courthouse.$phpEx?from=list&amp;mode=$mode&amp;order=$sort_order", $total_members, $board_config['topics_per_page'], $start). '&nbsp;';
		}

		$template->assign_vars(array(
			'L_SELECT_SORT_METHOD' => $lang['Select_sort_method'],
			'S_MODE_SELECT' => $select_sort_mode,
			'S_ORDER_SELECT' => $select_sort_order,
			'PAGINATION' => $pagination,
			'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $board_config['topics_per_page'] ) + 1 ), ceil( $total_members / $board_config['topics_per_page'] )), 
			'L_GOTO_PAGE' => $lang['Goto_page'],
		));

		break;
}

$template->assign_vars(array(
	'POINTS'                 => $userdata['user_points'],
	'L_NO_CELLED'            => $lang['Adr_cell_judgement_none'],
	'L_CAUTION_NOT_AUTHED'   => $lang['Adr_cell_caution_not_authed'],
	'L_JUDGE_NOT_AUTHED'     => $lang['Adr_cell_judgement_not_authed'],
	'L_JUDGE_EVER'           => $lang['Adr_cell_judgement_ever'],
	'L_JUDGEMENT_EXPLAIN'    => $lang['Adr_cell_judgement_explain'],
	'L_JUDGEMENT_NO'         => $lang['Adr_cell_judgement_guilty'],
	'L_JUDGEMENT_YES'        => $lang['Adr_cell_judgement_innocent'],
	'L_JUDGE_AUTHED_EVER'    => $lang['Adr_cell_judgement_ever_authed'],
	'L_NEVER_CELLED'         => $lang['Adr_cell_judgement_never'],
	'L_CELLED_TIMES'         => $lang['Adr_cell_imprisonments'],
	'L_SUBMIT'               => $lang['Submit'],
	'L_PUNISHMENT'           => $lang['Adr_cell_punishment'],
	'L_POINTS'               => get_reward_name(),
	'L_SLEDGE' 			 => $lang['Adr_cell_admin_celled_caution'],
	'L_USERNAME'		 => $lang['Username'],
	'L_IMPRISONED_TIME' 	 => $lang['Adr_cell_celled_time'],
	'L_IMPRISONED_DATE' 	 => $lang['Adr_cell_celled_date'],
	'L_FREED_BY'             => $lang['Adr_cell_freed_type'],
	'L_JUDGEMENT'            => $lang['Adr_cell_judgement'],
	'L_COURTHOUSE'           => $lang['Adr_courthouse_page_name'],
	'L_CELLED_LIST'          => $lang['Adr_cell_celled_list'],

	'L_TOWNBOUTONRETOUR' => $lang['Adr_TownMap_Bouton_Retour'],
	'L_TOWNMAPCOPYRIGHT' => $lang['TownMap_Copyright'],
	'L_COPYRIGHT' => $lang['Adr_copyright'],
	'U_COPYRIGHT' => append_sid("adr_copyright.$phpEx"),
	'U_TOWNMAPCOPYRIGHT' => append_sid("TownMap_Copyright.$phpEx"),
	'U_TOWNBOUTONRETOUR' => append_sid("adr_TownMap.$phpEx"),

	'U_COURTHOUSE'           => append_sid("adr_courthouse.$phpEx"),
	'S_COURTHOUSE_ACTION'    => append_sid("adr_courthouse.$phpEx"),
));

include($phpbb_root_path . 'adr/includes/adr_header.'.$phpEx);


$template->pparse('body');
include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
 
?> 
