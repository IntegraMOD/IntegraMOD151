<?php
/***************************************************************************
 *					adr_mine.php
 *				------------------------
 *	begin 			: 27/02/2004
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
define('IN_ADR_MINE', true);
define('IN_ADR_SHOPS', true);
define('IN_ADR_CHARACTER', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

$loc = 'town';
$sub_loc = 'adr_mine';

//
// Start session management
$userdata = session_pagestart($user_ip, PAGE_ADR);
init_userprefs($userdata);
// End session management
//

$user_id = $userdata['user_id'];
$points = $userdata['user_points'];

include($phpbb_root_path . 'adr/includes/adr_global.'.$phpEx);

// Sorry , only logged users ...
if ( !$userdata['session_logged_in'] )
{
	$redirect = "adr_familiar.$phpEx";
	$redirect .= ( isset($user_id) ) ? '&user_id=' . $user_id : '';
	header('Location: ' . append_sid("login.$phpEx?redirect=$redirect", true));
}

// Includes the tpl and the header
adr_template_file('adr_mine_body.tpl');
include($phpbb_root_path . 'includes/page_header.'.$phpEx);

// Get the general config
$adr_general = adr_get_general_config();


//
//BEGIN zone Mine Restriction
//
$zone_user = adr_get_user_infos($user_id);
$actual_zone = $zone_user['character_area'];

$sql = " SELECT * FROM  " . ADR_ZONES_TABLE . "
       WHERE zone_id = $actual_zone ";
if( !($result = $db->sql_query($sql)) )
        message_die(GENERAL_ERROR, 'Could not query area list', '', __LINE__, __FILE__, $sql);

$info = $db->sql_fetchrow($result);
$access = $info['zone_mine'];

if ( $access == '0' )
	adr_previous( Adr_zone_building_noaccess , adr_zones , '' );
//
//END zone Mine Restriction
//


// Grab details for skill limit
$sql = " SELECT character_skill_limit FROM " . ADR_CHARACTERS_TABLE . "
		WHERE character_id = $user_id ";
if( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not query skill limit value', '', __LINE__, __FILE__, $sql);
}
$limit_update = $db->sql_fetchrow($result);

adr_enable_check();
adr_ban_check($user_id);
adr_character_created_check($user_id);

if ( $adr_general['Adr_character_limit_enable'] != 0 && $limit_update['character_skill_limit'] <= 0 )
{	
	adr_previous ( Adr_skill_limit , adr_character , '' );
}

if( isset($HTTP_POST_VARS['mode']) || isset($HTTP_GET_VARS['mode']) )
{
	$mode = ( isset($HTTP_POST_VARS['mode']) ) ? $HTTP_POST_VARS['mode'] : $HTTP_GET_VARS['mode'];
	$mode = htmlspecialchars($mode);	
}
else
{
	$mode = "";
}



if ( $mode != "" )
{
	switch($mode)
	{
		case 'mining' :

			$template->assign_block_vars('mining',array());
			$sql = " SELECT * FROM " . ADR_SHOPS_ITEMS_TABLE . "
				WHERE item_owner_id = $user_id
				AND item_in_shop = 0
				AND item_in_warehouse = 0
				AND item_duration > 0
				AND item_type_use = 3 ";
			if ( !($result = $db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, 'Could not check user tools',"", __LINE__, __FILE__, $sql);
			}
			$tools = $db->sql_fetchrowset($result);
		
			$tool_list = '<select name="item_tool">';
			$tool_list .= '<option value = "0" >' . $lang['Adr_forge_mining_no_tool'] . '</option>';
			for ( $i = 0 ; $i < count($tools) ; $i ++ )
			{
				$tool_list .= '<option value = "'.$tools[$i]['item_id'].'" >' . adr_get_lang($tools[$i]['item_name']) . ' ( ' . $lang['Adr_items_power'] . ' : ' . $tools[$i]['item_power'] . ' - ' . $lang['Adr_items_duration'] . ' : ' . $tools[$i]['item_duration'] . ' )'.'</option>';
			}
			$tool_list .= '</select>';

			$template->assign_vars(array(
				'TOOL_LIST' => $tool_list,
				'L_SELECT_TOOL' => $lang['Adr_forge_mining_select_tool'],
				'L_GO_MINING' => $lang['Adr_forge_mining_go'],
				'L_MINING_EXPLAIN' => $lang['Adr_forge_mining_explain'],
			));

			break;

		case 'mining_action' :
			
      // V: this seems like a worse version of the one in adr_forge...
			$tool = intval($HTTP_POST_VARS['item_tool']);

			// No tool , no mining
			if ( !$tool )
			{
        // V: why does this redirect to forge?!?!
				adr_previous ( Adr_forge_mining_tool_needed , adr_forge , "mode=mining" );
			}
			else
			{	
				$new_item_id = adr_use_skill_mining($user_id , $tool);

				if ( !$new_item_id )
				{
					adr_previous ( Adr_forge_mining_failure , adr_forge , "mode=mining" );
				}
				else
				{
					$sql = " SELECT item_name , item_price FROM " . ADR_SHOPS_ITEMS_TABLE . "
						WHERE item_owner_id = $user_id
						AND item_in_warehouse = 0
						AND item_id = $new_item_id ";
					if ( !($result = $db->sql_query($sql)))
					{
						message_die(GENERAL_ERROR, 'Could not check user tools',"", __LINE__, __FILE__, $sql);
					}
					$new_item = $db->sql_fetchrow($result);

					$direction = append_sid("adr_mine.$phpEx?mode=mining");
					$message = sprintf($lang['Adr_forge_mining_success'] , adr_get_lang($new_item['item_name']) , $new_item['item_price'] , get_reward_name() );
					$message .= '<br /><br />'.sprintf($lang['Adr_return'],"<a href=\"" . $direction . "\">", "</a>") ;

					message_die ( GENERAL_MESSAGE , $message );
				}
			}
		
			break;

		case 'repair' :

			$template->assign_block_vars('repair',array());
			$sql = " SELECT * FROM " . ADR_SHOPS_ITEMS_TABLE . "
				WHERE item_owner_id = $user_id
				AND item_in_shop = 0
				AND item_in_warehouse = 0
				AND item_duration > 0
				AND item_type_use = 3 ";
			if ( !($result = $db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, 'Could not check user tools',"", __LINE__, __FILE__, $sql);
			}
			$tools = $db->sql_fetchrowset($result);
		
			$tool_list = '<select name="item_tool">';
			$tool_list .= '<option value = "0" >' . $lang['Adr_forge_mining_no_tool'] . '</option>';
			for ( $i = 0 ; $i < count($tools) ; $i ++ )
			{
				$tool_list .= '<option value = "'.$tools[$i]['item_id'].'" >' . adr_get_lang($tools[$i]['item_name']) . ' ( ' . $lang['Adr_items_power'] . ' : ' . $tools[$i]['item_power'] . ' - ' . $lang['Adr_items_duration'] . ' : ' . $tools[$i]['item_duration'] . ' )'.'</option>';
			}
			$tool_list .= '</select>';

			$sql = " SELECT * FROM " . ADR_SHOPS_ITEMS_TABLE . "
				WHERE item_owner_id = $user_id
				AND item_in_shop = 0
				AND item_in_warehouse = 0
				AND item_duration < item_duration_max
				AND item_duration > 0
				AND item_duration_max > 1
				AND item_type_use IN ( 5 , 6 , 7 , 8 , 9 , 29 , 30 , 10) ";
			if ( !($result = $db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, 'Could not check user items',"", __LINE__, __FILE__, $sql);
			}
			$items = $db->sql_fetchrowset($result);

			$items_list = '<select name="item_to_repair">';
			$items_list .= '<option value = "0" >' . $lang['Adr_forge_repair_no_item'] . '</option>';
			for ( $i = 0 ; $i < count($items) ; $i ++ )
			{
				$items_list .= '<option value = "'.$items[$i]['item_id'].'" >' . adr_get_lang($items[$i]['item_name']) . ' ( ' . $lang['Adr_items_power'] . ' : ' . $items[$i]['item_power'] . ' - ' . $lang['Adr_items_quality'] . ' : ' . adr_get_item_quality($items[$i]['item_quality'],simple) . ' - ' . $lang['Adr_items_type_use'] . ' : ' . adr_get_item_type($items[$i]['item_type_use'],simple) . ')'.'</option>';
			}
			$items_list .= '</select>';

			$template->assign_vars(array(
				'ITEMS_LIST' => $items_list,
				'TOOL_LIST' => $tool_list,
				'L_SELECT_TOOL' => $lang['Adr_forge_mining_select_tool'],
				'L_SELECT_ITEMS' => $lang['Adr_forge_repair_select_item'],
				'L_GO_REPAIR' => $lang['Adr_forge_repair_go'],
				'L_REPAIR_ITEM_EXPLAIN' => $lang['Adr_forge_repair_explain'],
			));

			break ;

		case 'repair_action' :
			
			$tool = intval($HTTP_POST_VARS['item_tool']);
			$item_to_repair = intval($HTTP_POST_VARS['item_to_repair']);

			// No tool , no repair
			if ( !$tool )
			{
				adr_previous ( Adr_forge_repair_tool_needed , adr_forge , "mode=repair" );
			}

			// No item to repair ?
			if ( !$item_to_repair )
			{
				adr_previous ( Adr_forge_repair_item_to_repair_needed , adr_forge , "mode=repair" );
			}

			$success = adr_use_skill_forge($user_id,$tool,$item_to_repair);
			
			if ( $success == -1 )
			{
				$message = $lang['Adr_forge_repair_failure_critical'];
			}
			else if ( !$success )
			{
				$message = $lang['Adr_forge_repair_failure'];
			}
			else
			{
				$message = sprintf($lang['Adr_forge_repair_success'] , $success  );
			}

			$direction = append_sid("adr_mine.$phpEx?mode=repair");
			$message .= '<br /><br />'.sprintf($lang['Adr_return'],"<a href=\"" . $direction . "\">", "</a>") ;
			message_die ( GENERAL_MESSAGE , $message );

			break;

		case 'recharge' :

			$template->assign_block_vars('recharge',array());
			$sql = " SELECT * FROM " . ADR_SHOPS_ITEMS_TABLE . "
				WHERE item_owner_id = $user_id
				AND item_in_shop = 0
				AND item_in_warehouse = 0
				AND item_duration > 0
				AND item_type_use = 4 ";
			if ( !($result = $db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, 'Could not check user tools',"", __LINE__, __FILE__, $sql);
			}
			$tools = $db->sql_fetchrowset($result);
		
			$tool_list = '<select name="item_tool">';
			$tool_list .= '<option value = "0" >' . $lang['Adr_forge_mining_no_tool'] . '</option>';
			for ( $i = 0 ; $i < count($tools) ; $i ++ )
			{
				$tool_list .= '<option value = "'.$tools[$i]['item_id'].'" >' . adr_get_lang($tools[$i]['item_name']) . ' ( ' . $lang['Adr_items_power'] . ' : ' . $tools[$i]['item_power'] . ' - ' . $lang['Adr_items_duration'] . ' : ' . $tools[$i]['item_duration'] . ' )'.'</option>';
			}
			$tool_list .= '</select>';

			$sql = " SELECT * FROM " . ADR_SHOPS_ITEMS_TABLE . "
				WHERE item_owner_id = $user_id
				AND item_in_shop = 0
				AND item_in_warehouse = 0
				AND item_duration < item_duration_max
				AND item_duration > 0
				AND item_duration_max > 1
				AND item_type_use IN ( 11 , 12 , 13 , 14 ) ";
			if ( !($result = $db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, 'Could not check user items',"", __LINE__, __FILE__, $sql);
			}
			$items = $db->sql_fetchrowset($result);

			$items_list = '<select name="item_to_repair">';
			$items_list .= '<option value = "0" >' . $lang['Adr_forge_repair_no_item'] . '</option>';
			for ( $i = 0 ; $i < count($items) ; $i ++ )
			{
				$items_list .= '<option value = "'.$items[$i]['item_id'].'" >' . adr_get_lang($items[$i]['item_name']) . ' ( ' . $lang['Adr_items_power'] . ' : ' . $items[$i]['item_power'] . ' - ' . $lang['Adr_items_quality'] . ' : ' . adr_get_item_quality($items[$i]['item_quality'],simple) . ' - ' . $lang['Adr_items_type_use'] . ' : ' . adr_get_item_type($items[$i]['item_type_use'],simple) . ')'.'</option>';
			}
			$items_list .= '</select>';

			$template->assign_vars(array(
				'ITEMS_LIST' => $items_list,
				'TOOL_LIST' => $tool_list,
				'L_SELECT_TOOL' => $lang['Adr_forge_mining_select_tool'],
				'L_SELECT_ITEMS' => $lang['Adr_forge_recharge_select_item'],
				'L_GO_REPAIR' => $lang['Adr_forge_recharge_go'],
				'L_RECHARGE_ITEM_EXPLAIN' => $lang['Adr_forge_recharge_explain'],
			));

			break ;

		case 'recharge_action' :
			
			$tool = intval($HTTP_POST_VARS['item_tool']);
			$item_to_repair = intval($HTTP_POST_VARS['item_to_repair']);

			// No tool , no repair
			if ( !$tool )
			{
				adr_previous ( Adr_forge_recharge_tool_needed , adr_forge , "mode=recharge" );
			}

			// No item to repair ?
			if ( !$item_to_repair )
			{
				adr_previous ( Adr_forge_recharge_item_to_repair_needed , adr_forge , "mode=recharge" );
			}

			$success = adr_use_skill_enchant( $user_id , $tool , $item_to_repair , recharge );
			
			if ( $success == -1 )
			{
				$message = $lang['Adr_forge_repair_failure_critical'];
			}
			else if ( !$success )
			{
				$message = $lang['Adr_forge_recharge_failure'];
			}
			else
			{
				$message = sprintf($lang['Adr_forge_repair_success'] , $success  );
			}

			$direction = append_sid("adr_mine.$phpEx?mode=recharge");
			$message .= '<br /><br />'.sprintf($lang['Adr_return'],"<a href=\"" . $direction . "\">", "</a>") ;
			message_die ( GENERAL_MESSAGE , $message );

			break;

		case 'stone' :

			$template->assign_block_vars('stone',array());
			$sql = " SELECT * FROM " . ADR_SHOPS_ITEMS_TABLE . "
				WHERE item_owner_id = $user_id
				AND item_in_shop = 0
				AND item_in_warehouse = 0
				AND item_duration > 0
				AND item_type_use = 3 ";
			if ( !($result = $db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, 'Could not check user tools',"", __LINE__, __FILE__, $sql);
			}
			$tools = $db->sql_fetchrowset($result);
		
			$tool_list = '<select name="item_tool">';
			$tool_list .= '<option value = "0" >' . $lang['Adr_forge_mining_no_tool'] . '</option>';
			for ( $i = 0 ; $i < count($tools) ; $i ++ )
			{
				$tool_list .= '<option value = "'.$tools[$i]['item_id'].'" >' . adr_get_lang($tools[$i]['item_name']) . ' ( ' . $lang['Adr_items_power'] . ' : ' . $tools[$i]['item_power'] . ' - ' . $lang['Adr_items_duration'] . ' : ' . $tools[$i]['item_duration'] . ' )'.'</option>';
			}
			$tool_list .= '</select>';

			$sql = " SELECT * FROM " . ADR_SHOPS_ITEMS_TABLE . "
				WHERE item_owner_id = $user_id
				AND item_quality < 5
				AND item_in_shop = 0
				AND item_in_warehouse = 0
				AND item_duration > 0
				AND item_type_use IN ( 1 , 2 ) ";
			if ( !($result = $db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, 'Could not check user items',"", __LINE__, __FILE__, $sql);
			}
			$items = $db->sql_fetchrowset($result);

			$items_list = '<select name="item_to_repair">';
			$items_list .= '<option value = "0" >' . $lang['Adr_forge_repair_no_item'] . '</option>';
			for ( $i = 0 ; $i < count($items) ; $i ++ )
			{
				$items_list .= '<option value = "'.$items[$i]['item_id'].'" >' . adr_get_lang($items[$i]['item_name']) . ' ( ' . $lang['Adr_items_power'] . ' : ' . $items[$i]['item_power'] . ' - ' . $lang['Adr_items_quality'] . ' : ' . adr_get_item_quality($items[$i]['item_quality'],simple) . ' - ' . $lang['Adr_items_type_use'] . ' : ' . adr_get_item_type($items[$i]['item_type_use'],simple) . ')'.'</option>';
			}
			$items_list .= '</select>';

			$template->assign_vars(array(
				'ITEMS_LIST' => $items_list,
				'TOOL_LIST' => $tool_list,
				'L_SELECT_TOOL' => $lang['Adr_forge_mining_select_tool'],
				'L_SELECT_ITEMS' => $lang['Adr_forge_stone_select_item'],
				'L_GO_REPAIR' => $lang['Adr_forge_stone_go'],
				'L_STONE_EXPLAIN' => $lang['Adr_forge_stone_explain'],
			));

			break ;

		case 'stone_action' :
			
			$tool = intval($HTTP_POST_VARS['item_tool']);
			$item_to_repair = intval($HTTP_POST_VARS['item_to_repair']);

			// No tool , no repair
			if ( !$tool )
			{
				adr_previous ( Adr_forge_stone_tool_needed , adr_forge , "mode=stone" );
			}

			// No item to repair ?
			if ( !$item_to_repair )
			{
				adr_previous ( Adr_forge_stone_item_to_repair_needed , adr_forge , "mode=stone" );
			}

			$success = adr_use_skill_stone($user_id,$tool,$item_to_repair);
			
			if ( $success == -1 )
			{
				$message = $lang['Adr_forge_repair_failure_critical'];
			}
			else if ( !$success )
			{
				$message = $lang['Adr_forge_stone_failure'];
			}
			else
			{
				$message = sprintf($lang['Adr_forge_stone_success'] , $success  );
			}

			$direction = append_sid("adr_mine.$phpEx?mode=stone");
			$message .= '<br /><br />'.sprintf($lang['Adr_return'],"<a href=\"" . $direction . "\">", "</a>") ;
			message_die ( GENERAL_MESSAGE , $message );

			break;


		case 'enchant' :

			$template->assign_block_vars('enchant',array());

			$sql = " SELECT * FROM " . ADR_SHOPS_ITEMS_TABLE . "
				WHERE item_owner_id = $user_id
				AND item_in_shop = 0
				AND item_in_warehouse = 0
				AND item_duration > 0
				AND item_type_use IN ( 11 , 12 ) ";
			if ( !($result = $db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, 'Could not check user tools',"", __LINE__, __FILE__, $sql);
			}
			$tools = $db->sql_fetchrowset($result);
		
			$tool_list = '<select name="item_tool">';
			$tool_list .= '<option value = "0" >' . $lang['Adr_forge_enchant_no_item'] . '</option>';
			for ( $i = 0 ; $i < count($tools) ; $i ++ )
			{
				$tool_list .= '<option value = "'.$tools[$i]['item_id'].'" >' . adr_get_lang($tools[$i]['item_name']) . ' ( ' . $lang['Adr_items_power'] . ' : ' . $tools[$i]['item_power'] . ' - ' . $lang['Adr_items_duration'] . ' : ' . $tools[$i]['item_duration'] . ' )'.'</option>';
			}
			$tool_list .= '</select>';

			$sql = " SELECT * FROM " . ADR_SHOPS_ITEMS_TABLE . "
				WHERE item_owner_id = $user_id
				AND item_in_shop = 0
				AND item_in_warehouse = 0
				AND item_duration > 0
				AND item_type_use IN ( 5 , 6 , 7 , 8 , 9 , 29 , 30 , 10) ";
			if ( !($result = $db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, 'Could not check user items',"", __LINE__, __FILE__, $sql);
			}
			$items = $db->sql_fetchrowset($result);

			$items_list = '<select name="item_to_repair">';
			$items_list .= '<option value = "0" >' . $lang['Adr_forge_mining_no_tool'] . '</option>';
			for ( $i = 0 ; $i < count($items) ; $i ++ )
			{
				$items_list .= '<option value = "'.$items[$i]['item_id'].'" >' . adr_get_lang($items[$i]['item_name']) . ' ( ' . $lang['Adr_items_power'] . ' : ' . $items[$i]['item_power'] . ' - ' . $lang['Adr_items_quality'] . ' : ' . adr_get_item_quality($items[$i]['item_quality'],simple) . ' - ' . $lang['Adr_items_type_use'] . ' : ' . adr_get_item_type($items[$i]['item_type_use'],simple) . ')'.'</option>';
			}
			$items_list .= '</select>';

			$template->assign_vars(array(
				'ITEMS_LIST' => $items_list,
				'TOOL_LIST' => $tool_list,
				'L_SELECT_TOOL' => $lang['Adr_forge_enchant_select_tool'],
				'L_SELECT_ITEMS' => $lang['Adr_forge_enchant_select_item'],
				'L_GO_REPAIR' => $lang['Adr_forge_enchant_go'],
				'L_ENCHANT_ITEM_EXPLAIN' => $lang['Adr_forge_enchant_explain'],
			));

			break ;

		case 'enchant_action' :
			
			$tool = intval($HTTP_POST_VARS['item_tool']);
			$item_to_repair = intval($HTTP_POST_VARS['item_to_repair']);

			// START max skill power check
			$sql = " SELECT * FROM " . ADR_SHOPS_ITEMS_TABLE . "
				WHERE item_in_shop = 0
				AND item_in_warehouse = 0
				AND item_owner_id = $user_id
				AND item_id = $item_to_repair ";
			if( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not query tool informations', '', __LINE__, __FILE__, $sql);
			}
			$item = $db->sql_fetchrow($result);

			// Check if power limit is enabled
			if ( $adr_general['item_power_level'] )
			{
				if ( $item['item_add_power'] >= $item['item_max_skill'] )
				{
					adr_previous( Adr_forge_max_skill , adr_forge , '' );
				}
			}
			else
			{
				if ( $item['item_power'] >= $item['item_max_skill'] )
				{
					adr_previous( Adr_forge_max_skill , adr_forge , '' );
				}		
			}
			// END max skill power check

			// No tool , no repair
			if ( !$tool )
			{
				adr_previous ( Adr_forge_enchant_tool_needed , adr_forge , "mode=enchant" );
			}

			// No item to repair ?
			if ( !$item_to_repair )
			{
				adr_previous ( Adr_forge_enchant_item_to_repair_needed , adr_forge , "mode=enchant" );
			}

			$success = adr_use_skill_enchant( $user_id, $tool , $item_to_repair , enchant );
			
			if ( $success == -1 )
			{
				$message = $lang['Adr_forge_repair_failure_critical'];
			}
			else if ( !$success )
			{
				$message = $lang['Adr_forge_enchant_failure'];
			}
			else
			{
				$message = sprintf($lang['Adr_forge_enchant_success'] , $success  );
			}

			$direction = append_sid("adr_mine.$phpEx?mode=enchant");
			$message .= '<br /><br />'.sprintf($lang['Adr_return'],"<a href=\"" . $direction . "\">", "</a>") ;
			message_die ( GENERAL_MESSAGE , $message );

			break;

		case 'create' :
			break;
	}
}

else
{
	$template->assign_block_vars('main',array());
}

$template->assign_vars(array(
	'L_REPAIR_ITEM' => $lang['Adr_forge_repair'],
	'L_RECHARGE_ITEM' => $lang['Adr_forge_recharge'],
	'L_CREATE_ITEM' => $lang['Adr_forge_create'],
	'L_MINING' => $lang['Adr_forge_mining'],
	'L_STONE' => $lang['Adr_forge_stone'],
	'L_ENCHANT_ITEM' => $lang['Adr_forge_enchant'],
	'U_REPAIR_ITEM' => append_sid("adr_mine.$phpEx?mode=repair"),
	'U_RECHARGE_ITEM' => append_sid("adr_mine.$phpEx?mode=recharge"),
	'U_CREATE_ITEM' => append_sid("adr_mine.$phpEx?mode=create"),
	'U_MINING' => append_sid("adr_mine.$phpEx?mode=mining"),
	'U_STONE' => append_sid("adr_mine.$phpEx?mode=stone"),
	'U_ENCHANT_ITEM' => append_sid("adr_mine.$phpEx?mode=enchant"),
	'S_FORGE_ACTION'=> append_sid("adr_mine.$phpEx"),
));


include($phpbb_root_path . 'adr/includes/adr_header.'.$phpEx);

$template->pparse('body');
include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>
