<?php
/***************************************************************************
*                               admin_adr_races.php
*                              -------------------
*     begin                : 29/01/2004
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
define('IN_ADR_ADMIN', 1);

define('IN_ADR_ZONES_ADMIN', 1);

define('IN_ADR_CHARACTER', 1);

if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['Adr']['Adr_races'] = $filename;

	return;
}

$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
include($phpbb_root_path . 'adr/includes/adr_global.'.$phpEx);

if( isset($HTTP_POST_VARS['mode']) || isset($HTTP_GET_VARS['mode']) )
{
	$mode = ( isset($HTTP_POST_VARS['mode']) ) ? $HTTP_POST_VARS['mode'] : $HTTP_GET_VARS['mode'];
	$mode = htmlspecialchars($mode);
}
else
{
	$mode = "";
}

$template->assign_vars(array(
	"L_ZONE" => $lang['Adr_zone_acp_race_zone'],
	"L_ZONE_EXPLAIN" => $lang['Adr_zone_acp_race_zone_explain'],

	"L_RACES_TITLE" => $lang['Adr_races_add_edit'],
	"L_RACES_EXPLAIN" => $lang['Adr_races_add_edit_explain'],
	"L_NAME" => $lang['Adr_races_name'],
	"L_NAME_EXPLAIN" => $lang['Adr_races_name_explain'],
	"L_DESC" => $lang['Adr_races_desc'],
	"L_IMG" => $lang['Adr_races_image'],
	"L_IMG_EXPLAIN" => $lang['Adr_races_image_explain'],
	"L_LEVEL" => $lang['Adr_races_level'],
	"L_LEVEL_EXPLAIN" => $lang['Adr_races_level_explain'],
	"L_MIGHT_BONUS" => $lang['Adr_races_bonus_might'],
	"L_DEXT_BONUS" => $lang['Adr_races_bonus_dext'],
	"L_CONST_BONUS" => $lang['Adr_races_bonus_const'],
	"L_INT_BONUS" => $lang['Adr_races_bonus_int'],
	"L_WIS_BONUS" => $lang['Adr_races_bonus_wis'],
	"L_CHA_BONUS" => $lang['Adr_races_bonus_cha'],
	"L_MA_BONUS" => $lang['Adr_races_bonus_ma'],
	"L_MD_BONUS" => $lang['Adr_races_bonus_md'],
	"L_MA_MALUS" => $lang['Adr_races_malus_ma'],
	"L_MD_MALUS" => $lang['Adr_races_malus_md'],
	"L_MIGHT_MALUS" => $lang['Adr_races_malus_might'],
	"L_DEXT_MALUS" => $lang['Adr_races_malus_dext'],
	"L_CONST_MALUS" => $lang['Adr_races_malus_const'],
	"L_INT_MALUS" => $lang['Adr_races_malus_int'],
	"L_WIS_MALUS" => $lang['Adr_races_malus_wis'],
	"L_CHA_MALUS" => $lang['Adr_races_malus_cha'],
	"L_MINING_BONUS" => $lang['Adr_races_bonus_mining'],
	"L_COOKING_BONUS" => $lang['Adr_races_bonus_cooking'],
	"L_BREWING_BONUS" => $lang['Adr_races_bonus_brewing'],
	"L_BLACKSMITHING_BONUS" => $lang['Adr_races_bonus_blacksmithing'],
	"L_STONE_BONUS" => $lang['Adr_races_bonus_stone'],
	"L_FORGE_BONUS" => $lang['Adr_races_bonus_forge'],
	"L_ENCHANT_BONUS" => $lang['Adr_races_bonus_enchant'],
	"L_TRADING_BONUS" => $lang['Adr_races_bonus_trading'],
	"L_THIEF_BONUS" => $lang['Adr_races_bonus_thief'],
	"L_FISHING_BONUS" => $lang['Adr_races_bonus_fishing'],
	"L_LUMBERJACK_BONUS" => $lang['Adr_races_bonus_lumberjack'],
	"L_TAILORING_BONUS" => $lang['Adr_races_bonus_tailoring'],
	"L_HERBALISM_BONUS" => $lang['Adr_races_bonus_herbalism'],
	"L_HUNTING_BONUS" => $lang['Adr_races_bonus_hunting'],
	"L_ALCHEMY_BONUS" => $lang['Adr_races_bonus_alchemy'],
	"L_RACES_TITLE" => $lang['Adr_races_add_edit'],
	"L_RACES_EXPLAIN" => $lang['Adr_races_add_edit_explain'],
	"L_RACES_WEIGHT" => $lang['Adr_races_weight'],	
	"L_RACES_WEIGHT_PER_LEVEL" => $lang['Adr_races_weight_per_level'],	
	"L_SUBMIT" => $lang['Submit'],
));

if( isset($HTTP_POST_VARS['add']) || isset($HTTP_GET_VARS['add']) )
{
	adr_template_file('admin/config_adr_races_edit_body.tpl');

	$s_hidden_fields = '<input type="hidden" name="mode" value="savenew" />';

	$template->assign_block_vars( 'races_add', array());

	$level[0] = $lang['Adr_races_level_all'];
	$level[1] = $lang['Adr_races_level_admin'];
	$level[2] = $lang['Adr_races_level_mod'];

	$level_list = '<select name="level">';
	for( $i = 0; $i < 3; $i++ )
	{
		$level_list .= '<option value = "'.$i.'" >' . $level[$i] . '</option>';
	}
	$level_list .= '</select>';

	//zones lists
	$sql = "SELECT * FROM " . ADR_ZONES_TABLE ."
		ORDER BY zone_name ASC";
	$result = $db->sql_query($sql);
	if( !$result ) 
		message_die(GENERAL_ERROR, 'Could not obtain zones information', "", __LINE__, __FILE__, $sql);
	
	$zonelist = $db->sql_fetchrowset($result);

	$zone_list = '<select name="zone">';
	for ( $i = 0 ; $i < count($zonelist) ; $i ++)
	  	$zone_list .= '<option value = "' . $zonelist[$i]['zone_id'] . '" >' . $zonelist[$i]['zone_name'] . '</option>';
	$zone_list .= '</select>';


	$template->assign_vars(array(
		"LEVEL_LIST" => $level_list,

		"ZONE_LIST" => $zone_list,
		"S_HIDDEN_FIELDS" => $s_hidden_fields) 
	);

	$template->pparse("body");
}
else if ( $mode != "" )
{
	switch( $mode )
	{
		case 'delete':

			$race_id = ( !empty($HTTP_POST_VARS['id']) ) ? intval($HTTP_POST_VARS['id']) : intval($HTTP_GET_VARS['id']);

			if ( $race_id == '1' )
			{
				adr_previous( Adr_race_default , admin_adr_races , '' );
			}

			$sql = "UPDATE " . ADR_CHARACTERS_TABLE . "
				SET character_race = 1
				WHERE character_race = " . $race_id;
			$result = $db->sql_query($sql);
			if( !$result )
			{
				message_die(GENERAL_ERROR, "Couldn't delete race", "", __LINE__, __FILE__, $sql);
			}

			$sql = "DELETE FROM " . ADR_RACES_TABLE . "
				WHERE race_id = " . $race_id;
			$result = $db->sql_query($sql);
			if( !$result )
			{
				message_die(GENERAL_ERROR, "Couldn't delete race", "", __LINE__, __FILE__, $sql);
			}

			adr_previous( Adr_race_successful_deleted , admin_adr_races , '' );
			break;

		case 'edit':

			$race_id = ( !empty($HTTP_POST_VARS['id']) ) ? intval($HTTP_POST_VARS['id']) : intval($HTTP_GET_VARS['id']);

			adr_template_file('admin/config_adr_races_edit_body.tpl');

			$template->assign_block_vars( 'races_edit', array());

			$sql = "SELECT *
				FROM " . ADR_RACES_TABLE ."
				WHERE race_id = $race_id ";
			$result = $db->sql_query($sql);
			if( !$result )
			{
				message_die(GENERAL_ERROR, 'Could not obtain races information', "", __LINE__, __FILE__, $sql);
			}
			$races = $db->sql_fetchrow($result);

			$s_hidden_fields = '<input type="hidden" name="mode" value="save" /><input type="hidden" name="race_id" value="' . $races['race_id'] . '" />';

			$pic = $races['race_img'];

			$level[0] = $lang['Adr_races_level_all'];
			$level[1] = $lang['Adr_races_level_admin'];
			$level[2] = $lang['Adr_races_level_mod'];
			$level_list = '<select name="level">';
			for( $i = 0; $i < 3; $i++ )
			{
				$selected = ( $i == $races['race_level'] ) ? ' selected="selected"' : '';
				$level_list .= '<option value = "'.$i.'" '.$selected.' >' . $level[$i] . '</option>';
			}
			$level_list .= '</select>';

			//zones lists
			$existing_zone = $races['race_zone_begin'];
			$existing_name = $races['race_zone_name'];

			$sql = "SELECT * FROM " . ADR_ZONES_TABLE ."
				ORDER BY zone_name ASC";
			$result = $db->sql_query($sql);
			if( !$result ) 
				message_die(GENERAL_ERROR, 'Could not obtain zones information', "", __LINE__, __FILE__, $sql);
	
			$zonelist = $db->sql_fetchrowset($result);

			$zone_list = '<select name="zone">';
			$zone_list .= '<option value = "'. $existing_zone .'" >' . $existing_name . '</option>';
			for ( $i = 0 ; $i < count($zonelist) ; $i ++)
	  			$zone_list .= '<option value = "' . $zonelist[$i]['zone_id'] . '" >' . $zonelist[$i]['zone_name'] . '</option>';
			$zone_list .= '</select>';


			$template->assign_vars(array(
				"RACE_NAME" => $races['race_name'],
				"RACE_NAME_EXPLAIN" => adr_get_lang($races['race_name']),
				"RACE_DESC" => $races['race_desc'],
				"RACE_DESC_EXPLAIN" => adr_get_lang($races['race_desc']),
				"RACE_IMG" => $races['race_img'],
				"RACE_IMG_EX" => $pic ,
				"RACE_WEIGHT" => $races['race_weight'],
				"RACE_WEIGHT_PER_LEVEL" => $races['race_weight_per_level'],
				"MIGHT_BONUS" => $races['race_might_bonus'],
				"DEXT_BONUS" => $races['race_dexterity_bonus'],
				"CONST_BONUS" => $races['race_constitution_bonus'],
				"INT_BONUS" => $races['race_intelligence_bonus'],
				"WIS_BONUS" => $races['race_wisdom_bonus'],
				"CHA_BONUS" => $races['race_charisma_bonus'],
				"MA_BONUS" => $races['race_magic_attack_bonus'],
				"MD_BONUS" => $races['race_magic_resistance_bonus'],
				"MA_MALUS" => $races['race_magic_attack_malus'],
				"MD_MALUS" => $races['race_magic_resistance_malus'],
				"MIGHT_MALUS" => $races['race_might_malus'],
				"DEXT_MALUS" => $races['race_dexterity_malus'],
				"CONST_MALUS" => $races['race_constitution_malus'],
				"INT_MALUS" => $races['race_intelligence_malus'],
				"WIS_MALUS" => $races['race_wisdom_malus'],
				"CHA_MALUS" => $races['race_charisma_malus'],
				"MINING_BONUS" => $races['race_skill_mining_bonus'],
				"BLACKSMITHING_BONUS" => $races['race_skill_blacksmithing_bonus'],
				"BREWING_BONUS" => $races['race_skill_brewing_bonus'],
				"COOKING_BONUS" => $races['race_skill_cooking_bonus'],
				"STONE_BONUS" => $races['race_skill_stone_bonus'],
				"FORGE_BONUS" => $races['race_skill_forge_bonus'],
				"ENCHANT_BONUS" => $races['race_skill_enchantment_bonus'],
				"TRADING_BONUS" => $races['race_skill_trading_bonus'],
				"THIEF_BONUS" => $races['race_skill_thief_bonus'],
				"FISHING_BONUS" => $races['race_skill_fishing_bonus'],
				"TAILORING_BONUS" => $races['race_skill_tailoring_bonus'],
				"LUMBERJACK_BONUS" => $races['race_skill_lumberjack_bonus'],
				"HERBALISM_BONUS" => $races['race_skill_herbalism_bonus'],
				"HUNTING_BONUS" => $races['race_skill_hunting_bonus'],
				"ALCHEMY_BONUS" => $races['race_skill_alchemy_bonus'],
				"LEVEL_LIST" => $level_list,

				"ZONE_LIST" => $zone_list,
				"L_ZONE" => $lang['Adr_zone_acp_race_zone'],
				"L_ZONE_EXPLAIN" => $lang['Adr_zone_acp_race_zone_explain'],

				"L_RACES_TITLE" => $lang['Adr_races_add_edit'],
				"L_RACES_EXPLAIN" => $lang['Adr_races_add_edit_explain'],
				"L_RACES_WEIGHT" => $lang['Adr_races_weight'],	
				"L_RACES_WEIGHT_PER_LEVEL" => $lang['Adr_races_weight_per_level'],	
				"L_NAME" => $lang['Adr_races_name'],
				"L_NAME_EXPLAIN" => $lang['Adr_races_name_explain'],
				"L_DESC" => $lang['Adr_races_desc'],
				"L_IMG" => $lang['Adr_races_image'],
				"L_IMG_EXPLAIN" => $lang['Adr_races_image_explain'],
				"L_LEVEL" => $lang['Adr_races_level'],
				"L_LEVEL_EXPLAIN" => $lang['Adr_races_level_explain'],
				"L_MIGHT_BONUS" => $lang['Adr_races_bonus_might'],
				"L_DEXT_BONUS" => $lang['Adr_races_bonus_dext'],
				"L_CONST_BONUS" => $lang['Adr_races_bonus_const'],
				"L_BREWING_BONUS" => $lang['Adr_races_bonus_brewing'],
				"L_INT_BONUS" => $lang['Adr_races_bonus_int'],
				"L_WIS_BONUS" => $lang['Adr_races_bonus_wis'],
				"L_CHA_BONUS" => $lang['Adr_races_bonus_cha'],
				"L_MA_BONUS" => $lang['Adr_races_bonus_ma'],
				"L_MD_BONUS" => $lang['Adr_races_bonus_md'],
				"L_MA_MALUS" => $lang['Adr_races_malus_ma'],
				"L_MD_MALUS" => $lang['Adr_races_malus_md'],
				"L_MIGHT_MALUS" => $lang['Adr_races_malus_might'],
				"L_DEXT_MALUS" => $lang['Adr_races_malus_dext'],
				"L_CONST_MALUS" => $lang['Adr_races_malus_const'],
				"L_INT_MALUS" => $lang['Adr_races_malus_int'],
				"L_WIS_MALUS" => $lang['Adr_races_malus_wis'],
				"L_CHA_MALUS" => $lang['Adr_races_malus_cha'],
				"S_HIDDEN_FIELDS" => $s_hidden_fields) 
			);

			$template->pparse("body");
			break;

		case "save":

			$race_id = ( !empty($HTTP_POST_VARS['race_id']) ) ? intval($HTTP_POST_VARS['race_id']) : intval($HTTP_GET_VARS['race_id']);

			$race_name = ( isset($HTTP_POST_VARS['race_name']) ) ? trim($HTTP_POST_VARS['race_name']) : trim($HTTP_GET_VARS['race_name']);
			$race_img = ( isset($HTTP_POST_VARS['race_img']) ) ? trim($HTTP_POST_VARS['race_img']) : trim($HTTP_GET_VARS['race_img']);
			$race_desc = ( isset($HTTP_POST_VARS['race_desc']) ) ? trim($HTTP_POST_VARS['race_desc']) : trim($HTTP_GET_VARS['race_desc']);
			$level = intval($HTTP_POST_VARS['level']);
			$weight = intval($HTTP_POST_VARS['weight']);
			$weight_per_level = intval($HTTP_POST_VARS['weight_per_level']);
			$b_might = intval($HTTP_POST_VARS['might_bonus']);
			$b_dext = intval($HTTP_POST_VARS['dext_bonus']);
			$b_const = intval($HTTP_POST_VARS['const_bonus']);
			$b_int = intval($HTTP_POST_VARS['int_bonus']);
			$b_wis = intval($HTTP_POST_VARS['wis_bonus']);
			$b_cha = intval($HTTP_POST_VARS['cha_bonus']);
			$b_ma = intval($HTTP_POST_VARS['ma_bonus']);
			$b_md = intval($HTTP_POST_VARS['md_bonus']);
			$m_might = intval($HTTP_POST_VARS['might_malus']);
			$m_dext = intval($HTTP_POST_VARS['dext_malus']);
			$m_const = intval($HTTP_POST_VARS['const_malus']);
			$m_int = intval($HTTP_POST_VARS['int_malus']);
			$m_wis = intval($HTTP_POST_VARS['wis_malus']);
			$m_cha = intval($HTTP_POST_VARS['cha_malus']);
			$m_ma = intval($HTTP_POST_VARS['ma_malus']);
			$m_md = intval($HTTP_POST_VARS['md_malus']);
			$b_mining = intval($HTTP_POST_VARS['mining_bonus']);
			$b_brewing = intval($HTTP_POST_VARS['brewing_bonus']);
			$b_cooking = intval($HTTP_POST_VARS['cooking_bonus']);
			$b_blacksmithing = intval($HTTP_POST_VARS['blacksmithing_bonus']);
			$b_stone = intval($HTTP_POST_VARS['stone_bonus']);
			$b_forge = intval($HTTP_POST_VARS['forge_bonus']);
			$b_enchant = intval($HTTP_POST_VARS['enchant_bonus']);
			$b_trading = intval($HTTP_POST_VARS['trading_bonus']);
			$b_thief = intval($HTTP_POST_VARS['thief_bonus']);
			$b_fishing = intval($HTTP_POST_VARS['fishing_bonus']);
			$b_herbalism = intval($HTTP_POST_VARS['herbalism_bonus']);
			$b_lumberjack = intval($HTTP_POST_VARS['lumberjack_bonus']);
			$b_hunting = intval($HTTP_POST_VARS['hunting_bonus']);
			$b_tailoring = intval($HTTP_POST_VARS['tailoring_bonus']);
			$b_alchemy = intval($HTTP_POST_VARS['alchemy_bonus']);

			$begin_zone = intval($HTTP_POST_VARS['zone']);

			//Find zone name
			$sql = "SELECT * FROM " . ADR_ZONES_TABLE . "
					WHERE zone_id = '$begin_zone' ";
			$result = $db->sql_query($sql);
			if( !$result )
			{
				message_die(GENERAL_ERROR, 'Could not obtain elements information', "", __LINE__, __FILE__, $sql);
			}
			$zone_data = $db->sql_fetchrow($result);
			$name_data = $zone_data['zone_name'];


			if ($race_name == '' )
			{
				message_die(MESSAGE, $lang['Fields_empty']);
			}

			$sql = "UPDATE " . ADR_RACES_TABLE . "
				SET race_name = '" . str_replace("\'", "''", $race_name) . "', 	
					race_desc = '" . str_replace("\'", "''", $race_desc) . "', 
					race_img = '" . str_replace("\'", "''", $race_img) . "',
					race_level = $level ,
					race_weight = $weight ,
					race_weight_per_level = $weight_per_level ,
					race_might_bonus = $b_might , 
					race_dexterity_bonus = $b_dext ,
					race_constitution_bonus = $b_const ,
					race_intelligence_bonus = $b_int ,
					race_wisdom_bonus = $b_wis ,
					race_charisma_bonus = $b_cha ,
					race_magic_attack_bonus = $b_ma ,
					race_magic_resistance_bonus = $b_md ,
					race_might_malus = $m_might ,
					race_dexterity_malus = $m_dext ,
					race_constitution_malus = $m_const ,
					race_intelligence_malus = $m_int ,
					race_wisdom_malus = $m_wis ,
					race_charisma_malus = $m_cha ,
					race_skill_mining_bonus = $b_mining ,
					race_skill_cooking_bonus = $b_cooking ,
					race_skill_brewing_bonus = $b_brewing ,
					race_skill_blacksmithing_bonus = $b_blacksmithing ,
					race_skill_stone_bonus = $b_stone , 
					race_skill_forge_bonus = $b_forge ,
					race_skill_enchantment_bonus = $b_enchant ,
					race_skill_trading_bonus = $b_trading , 
					race_skill_thief_bonus = $b_thief ,
					race_skill_fishing_bonus = $b_fishing ,
					race_skill_hunting_bonus = $b_hunting ,
					race_skill_herbalism_bonus = $b_herbalism ,
					race_skill_lumberjack_bonus = $b_lumberjack ,
					race_skill_tailoring_bonus = $b_tailoring ,
					race_skill_alchemy_bonus = $b_alchemy ,

					race_skill_thief_bonus = $b_thief,
					race_zone_begin = $begin_zone,
					race_zone_name = '" . str_replace("\'", "''", $name_data) . "'

				WHERE race_id = " . $race_id;
			if( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, "Couldn't update races info", "", __LINE__, __FILE__, $sql);
			}
			// Update cache
			adr_update_race_infos();

			adr_previous( Adr_race_successful_edited , admin_adr_races , '' );
			break;

		case "savenew":

			$sql = "SELECT race_id
			FROM " . ADR_RACES_TABLE ."
			ORDER BY race_id 
			DESC LIMIT 1";
			$result = $db->sql_query($sql);
			if( !$result )
			{
				message_die(GENERAL_ERROR, 'Could not obtain races information', "", __LINE__, __FILE__, $sql);
			}
			$fields_data = $db->sql_fetchrow($result);

			$race_name = ( isset($HTTP_POST_VARS['race_name']) ) ? trim($HTTP_POST_VARS['race_name']) : trim($HTTP_GET_VARS['race_name']);
			$race_img = ( isset($HTTP_POST_VARS['race_img']) ) ? trim($HTTP_POST_VARS['race_img']) : trim($HTTP_GET_VARS['race_img']);
			$race_desc = ( isset($HTTP_POST_VARS['race_desc']) ) ? trim($HTTP_POST_VARS['race_desc']) : trim($HTTP_GET_VARS['race_desc']);
			$level = intval($HTTP_POST_VARS['level']);
			$weight = intval($HTTP_POST_VARS['weight']);
			$weight_per_level = intval($HTTP_POST_VARS['weight_per_level']);
			$b_might = intval($HTTP_POST_VARS['might_bonus']);
			$b_dext = intval($HTTP_POST_VARS['dext_bonus']);
			$b_const = intval($HTTP_POST_VARS['const_bonus']);
			$b_int = intval($HTTP_POST_VARS['int_bonus']);
			$b_wis = intval($HTTP_POST_VARS['wis_bonus']);
			$b_cha = intval($HTTP_POST_VARS['cha_bonus']);
			$b_ma = intval($HTTP_POST_VARS['ma_bonus']);
			$b_md = intval($HTTP_POST_VARS['md_bonus']);
			$m_might = intval($HTTP_POST_VARS['might_malus']);
			$m_dext = intval($HTTP_POST_VARS['dext_malus']);
			$m_const = intval($HTTP_POST_VARS['const_malus']);
			$m_int = intval($HTTP_POST_VARS['int_malus']);
			$m_wis = intval($HTTP_POST_VARS['wis_malus']);
			$m_cha = intval($HTTP_POST_VARS['cha_malus']);
			$m_ma = intval($HTTP_POST_VARS['ma_malus']);
			$m_md = intval($HTTP_POST_VARS['md_malus']);
			$b_mining = intval($HTTP_POST_VARS['mining_bonus']);
			$b_cooking = intval($HTTP_POST_VARS['cooking_bonus']);
			$b_brewing = intval($HTTP_POST_VARS['brewing_bonus']);
			$b_blacksmithing = intval($HTTP_POST_VARS['blacksmithing_bonus']);
			$b_stone = intval($HTTP_POST_VARS['stone_bonus']);
			$b_forge = intval($HTTP_POST_VARS['forge_bonus']);
			$b_enchant = intval($HTTP_POST_VARS['enchant_bonus']);
			$b_trading = intval($HTTP_POST_VARS['trading_bonus']);
			$b_thief = intval($HTTP_POST_VARS['thief_bonus']);
			$b_fishing = intval($HTTP_POST_VARS['fishing_bonus']);
			$b_herbalism = intval($HTTP_POST_VARS['herbalism_bonus']);
			$b_lumberjack = intval($HTTP_POST_VARS['lumberjack_bonus']);
			$b_hunting = intval($HTTP_POST_VARS['hunting_bonus']);
			$b_tailoring = intval($HTTP_POST_VARS['tailoring_bonus']);
			$b_alchemy = intval($HTTP_POST_VARS['alchemy_bonus']);

			$begin_zone = intval($HTTP_POST_VARS['zone']);

			//Find zone name
			$sql = "SELECT * FROM " . ADR_ZONES_TABLE . "
					WHERE zone_id = '$begin_zone' ";
			$result = $db->sql_query($sql);
			if( !$result )
			{
				message_die(GENERAL_ERROR, 'Could not obtain elements information', "", __LINE__, __FILE__, $sql);
			}
			$zone_data = $db->sql_fetchrow($result);
			$name_data = $zone_data['zone_name'];


			$race_id = $fields_data['race_id'] +1;

			if ($race_name == '' )
			{
				message_die(MESSAGE, $lang['Fields_empty']);
			}

			$sql = "INSERT INTO " . ADR_RACES_TABLE . "
				( race_id , race_name , race_desc ,  race_level , race_img , race_might_bonus , race_dexterity_bonus , race_constitution_bonus , race_intelligence_bonus , race_wisdom_bonus , race_charisma_bonus , race_magic_attack_bonus , race_magic_resistance_bonus , race_might_malus , race_dexterity_malus , race_constitution_malus , race_intelligence_malus , race_wisdom_malus , race_charisma_malus , race_magic_attack_malus , race_magic_resistance_malus , race_skill_mining_bonus , race_skill_stone_bonus , race_skill_forge_bonus , race_skill_enchantment_bonus , race_skill_trading_bonus , race_skill_thief_bonus, race_zone_begin , race_zone_name, race_skill_brewing_bonus, race_skill_cooking_bonus, race_skill_blacksmithing_bonus, race_skill_herbalism_bonus , race_skill_lumberjack_bonus , race_skill_hunting_bonus , race_skill_tailoring_bonus , race_skill_fishing_bonus , race_skill_alchemy_bonus )
				VALUES ( $race_id,'" . str_replace("\'", "''", $race_name) . "', '" . str_replace("\'", "''", $race_desc) . "' , $level , '" . str_replace("\'", "''", $race_img) . "' , $b_might , $b_dext , $b_const , $b_int, $b_wis, $b_cha , $b_ma , $b_md , $m_might, $m_dext ,$m_const , $m_int, $m_wis , $m_cha , $m_ma , $m_md , $b_mining , $b_stone , $b_forge ,$b_enchant , $b_trading ,$b_thief, $begin_zone , '" . str_replace("\'", "''", $name_data) . "', $b_brewing, $b_cooking, $b_blacksmithing , $b_herbalism , $b_lumberjack , $b_hunting , $b_tailoring , $b_fishing , $b_alchemy )";
			$result = $db->sql_query($sql);
			if( !$result )
			{
				message_die(GENERAL_ERROR, "Couldn't insert new race", "", __LINE__, __FILE__, $sql);
			}
			// Update cache
			adr_update_race_infos();

			adr_previous( Adr_race_successful_added , admin_adr_races , '' );
			break;
	}
}
else
{

	adr_template_file('admin/config_adr_races_list_body.tpl');

	$sql = "SELECT *
		FROM " . ADR_RACES_TABLE;
	$result = $db->sql_query($sql);
	if( !$result )
	{
		message_die(GENERAL_ERROR, 'Could not obtain races information', "", __LINE__, __FILE__, $sql);
	}
	$races = $db->sql_fetchrowset($result);

	for($i = 0; $i < count($races); $i++)
	{
		$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

		$level[0] = $lang['Adr_races_level_all'];
		$level[1] = $lang['Adr_races_level_admin'];
		$level[2] = $lang['Adr_races_level_mod'];
		$race_level = $level[$races[$i]['race_level']];

		$pic = $races[$i]['race_img'];

		$template->assign_block_vars("races", array(
			"ROW_CLASS" => $row_class,
			"NAME" => adr_get_lang($races[$i]['race_name']),
			"DESC" => adr_get_lang($races[$i]['race_desc']),
			"IMG" => $pic ,
			"LEVEL" => $race_level,

			"ZONE" =>  $races[$i]['race_zone_name'],

			"U_RACES_EDIT" => append_sid("admin_adr_races.$phpEx?mode=edit&amp;id=" . $races[$i]['race_id']), 
			"U_RACES_DELETE" => append_sid("admin_adr_races.$phpEx?mode=delete&amp;id=" . $races[$i]['race_id']))
		);
	}


	$template->assign_vars(array(
		"L_RACES_TITLE" => $lang['Adr_races'],
		"L_RACES_TEXT" => $lang['Adr_races_explain'],
		"L_NAME" => $lang['Adr_races_name'],
		"L_IMG" => $lang['Adr_races_image'],
		"L_DESC" => $lang['Adr_races_desc'],
		"L_LEVEL" => $lang['Adr_races_level'],

		"L_ZONE" => $lang['Adr_zone_acp_race_zone_list'],


		"L_RACES_ADD" => $lang['Adr_races_add'],
		"L_ACTION" => $lang['Action'],
		"L_DELETE" => $lang['Delete'],
		"L_EDIT" => $lang['Edit'],
		"L_SUBMIT" => $lang['Submit'],
		"S_RACES_ACTION" => append_sid("admin_adr_races.$phpEx"))
	);

	$template->pparse("body");
	include('./page_footer_admin.'.$phpEx);
}