<?php
/***************************************************************************
 *                         profilecp_adr_character.php
 *                         ---------------------------
 *   begin                : Saturday, Apr 22, 2006
 *   Original Author:     : MrDSL  < naug@thehottub.net > - psyper < http://bhere.net > - gurukast
 *   Update Author:       : Ozzie
 *   email                : GOster@OzziesWorld.com
 *   support              : http://www.OzziesWorld.com
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{ 
   die('Hacking attempt'); 
   exit; 
}
$phpbb_root_path = './';

// Let's define some basic settins
// This is the absolute largest the avatar will be
define ( 'MAX_AVATAR_HT' , 100 );
// This is the height of the avatar we start with for calculating spacers
define ( 'SUB_AVATAR_HT' , MAX_AVATAR_HT - 4 );
// This is the largest we want the characteristic images to be (ADR default icons are 16 px high
define ( 'MAX_CHARACTERISTICS_IMAGE_HT' , 16 );
// This will turn on and turn off adjustments based the template selected
define ( 'USE_TEMPLATE_ADJUSTMENTS' , false );
// The height of the space between the bars and the characteristics tables, if USE_TEMPLATE_ADJUSTMENTS is set to false
define ( 'SPACER_HEIGHT' , 25 );

if ( !empty($setmodules) )
{
	pcp_set_sub_menu('viewprofile', 'profilcp_public_adr_shortcut', 10, __FILE__, 'profilcp_public_adr_shortcut', 'profilcp_character_pagetitle'  );
	return;
}

if ( !$userdata['session_logged_in'] )
{
	$redirect = "profile.php?mode=addons";
	$redirect .= ( isset($user_id) ) ? '&user_id=' . $user_id : '';
	header('Location: ' . append_sid("login.$phpEx?redirect=$redirect", true));
}

$user_id = $userdata['user_id'];

//
// template file
$template->set_filenames(array(
	'body' => 'profilcp/profil_adr_body.tpl')
);

if ( $board_config['Adr_profile_display'] )
{
	define ( 'IN_ADR_CHARACTER' , true );
	define ( 'IN_ADR_SHOPS' , true );
	define ( 'IN_ADR_SKILLS' , true );
	define ( 'IN_ADR_BATTLE' , true );
	include_once($phpbb_root_path . 'adr/includes/adr_global.'.$phpEx);

    // Get the general config
    $adr_general = adr_get_general_config();
	$searchid = $view_userdata['user_id'];

	// Determine the View Users Avatar Location
	$avatar_loc = '';
	if ( $view_userdata['user_avatar_type'] && $view_userdata['user_allowavatar'] )
	{
		switch( $view_userdata['user_avatar_type'] )
		{
			case USER_AVATAR_UPLOAD:
				$avatar_loc = ( $board_config['allow_avatar_upload'] ) ? $board_config['avatar_path'] . '/' . $view_userdata['user_avatar'] : '';
				break;
			case USER_AVATAR_REMOTE:
				$avatar_loc = ( $board_config['allow_avatar_remote'] ) ? $view_userdata['user_avatar'] : '';
				break;
			case USER_AVATAR_GALLERY:
				$avatar_loc = ( $board_config['allow_avatar_local'] ) ? $board_config['avatar_gallery_path'] . '/' . $view_userdata['user_avatar'] : '';
				break;
		}
	}
	if ( $avatar_loc == '' )
	{
		$avatar_loc = 'images/spacer.gif';
	}
	// Determine the Avatar dimensions & calculate the display size and above and below spacers
	list($avatar_width, $avatar_height) = @getimagesize($avatar_loc);
	list($cell_image_width, $cell_image_height) = @getimagesize('images/cell.gif');
	if ( $avatar_height >= SUB_AVATAR_HT || $avatar_height == '' )
	{
		( $board_config['allow_avatar_remote'] ) ? $img_height = $cell_height = $image_height = MAX_AVATAR_HT :  $img_height = $cell_height = $image_height = SUB_AVATAR_HT;
		$v_spacer = 0;
	}
	else if ( $avatar_height < SUB_AVATAR_HT && $avatar_height >= $cell_image_height )
	{
		$img_height = $cell_height = $image_height = $avatar_height;
		$v_spacer = 0;
	}
	else
	{
		if ( $avatar_loc == 'images/spacer.gif' )
		{
			$img_height = $cell_height = $image_height = $cell_image_height;
			$v_spacer = intval( ( $cell_image_height - $avatar_height ) / 2 );
		}
		else
		{
			$img_height = $avatar_height;
			$cell_height = $image_height = $cell_image_height;
			$v_spacer = intval( ( $cell_image_height - $avatar_height ) / 2 );
		}
	}
	// Calculate the allowed avatar width and the before and after spacer sizes
	if ( $avatar_width >= $board_config['avatar_max_width'] )
	{
		$img_width = $cell_width = $image_width = $board_config['avatar_max_width'];
		$h_spacer = 0;
	}
	else if ( $avatar_width < $board_config['avatar_max_width'] && $avatar_width >= $cell_image_width )
	{
		$img_width = $cell_width = $image_width = $avatar_width;
		$h_spacer = 0;
	}
	else
	{
		if ( $avatar_loc == 'images/spacer.gif' )
		{
			$img_width = $cell_width = $image_width = $cell_image_width;
			$v_spacer = intval( ( $cell_image_height - $avatar_height ) / 2 );
		}
		else
		{
			$img_width = $avatar_width;
			$cell_width = $image_width = $cell_image_width;
			$h_spacer = intval( ( $cell_image_width - $avatar_width ) / 2 );
		}
	}
	// Incarcerated?  Let's put you behind bars if you are
	if ( ($view_userdata['user_cell_time'] > 0) && $board_config['cell_allow_display_bars'])
	{
		$avatar_img = '<div style="position:absolute;padding:0px;width:'.$image_width.'px;height:'.$image_height.'px;z-index:1;"><IMG src="images/spacer.gif" border="0" width="'.$h_spacer.'" height="'.$v_spacer.'"><IMG src="' . $avatar_loc . '" border=0 width="'.$img_width.'" height="'.$img_height.'"><IMG src="images/spacer.gif" border="0" width="'.$h_spacer.'" height="'.$v_spacer.'"></div><div style="position:relative;padding:0px;width:'.$image_width.'px;height:'.$image_height.'px;z-index:2;"><IMG src="images/cell.gif" border=0 STYLE="filter:alpha(opacity=65)" width="'.$cell_width.'" height="'.$cell_height.'"></div>';
	}
	else
	{
		if ( $view_userdata['user_avatar_type'] && $view_userdata['user_allowavatar'] )
		{
			$avatar_img = '<img src="' . $avatar_loc . '" alt="' . $lang['Avatar'] . '" border="0" />';
		}
	}
	$sql = "SELECT c.* , r.race_name , r.race_weight , r.race_weight_per_level , r.race_img , e.element_name , e.element_img , a.alignment_name , a.alignment_img , cl.class_name , cl.class_img , cl.class_update_xp_req
			FROM  " . ADR_CHARACTERS_TABLE . " c , " . ADR_RACES_TABLE . " r , " . ADR_ELEMENTS_TABLE . " e , " . ADR_ALIGNMENTS_TABLE . " a , " . ADR_CLASSES_TABLE . " cl
			WHERE c.character_id= $searchid
			AND cl.class_id = c.character_class
			AND r.race_id = c.character_race
			AND e.element_id = c.character_element
			AND a.alignment_id = c.character_alignment ";
	if ( !($result = $db->sql_query($sql)) )
	{ 
		message_die(CRITICAL_ERROR, 'Error Getting Adr Users!'); 
	}	
	$row = $db->sql_fetchrow($result);

	if ( !(is_numeric($row['character_class'])))
	{
		$template->assign_block_vars( 'adr_profile_none' , array());
	}
	else
	{
		$template->assign_block_vars( 'adr_profile' , array());

		$class = adr_get_lang($row['class_name']);
		$race = adr_get_lang($row['race_name']);
		$element = adr_get_lang($row['element_name']);
		$alignment = adr_get_lang($row['alignment_name']);

		// Work out weight stats
		$max_weight = adr_weight_stats($row['character_level'], $row['race_weight'], $row['race_weight_per_level'], $row['character_might']);

		// Count up characters current weight
		$sql = "SELECT SUM(item_weight) AS total FROM  " . ADR_SHOPS_ITEMS_TABLE . "
				WHERE item_owner_id = $searchid
				AND item_in_warehouse = 0
				AND item_duration > 0
				AND item_in_shop = 0";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(CRITICAL_ERROR, 'Error Getting Adr Users!');
		}
		$weight = $db->sql_fetchrow($result);
		if ( $weight[total] != '' )
		{
			$current_weight = $weight[total];
		}
		else
		{
			$current_weight = 0;
		}

		//changed from max_hp to max_xp
   		$max_xp = $row['class_update_xp_req'];
   		for ( $p = 1 ; $p < $row['character_level'] ; $p ++ )
  		{
      		$max_xp = floor($max_xp * (( $adr_general['next_level_penalty'] + 100 ) / 100 ));
   		}

		##=== Create bar widths ===##
		list($hp_percent_width, $hp_percent_empty) = adr_make_bars($row['character_hp'], $row['character_hp_max'], '318');
		list($mp_percent_width, $mp_percent_empty) = adr_make_bars($row['character_mp'], $row['character_mp_max'], '318');
		list($exp_percent_width, $exp_percent_empty) = adr_make_bars($row['character_xp'], $max_xp, '318');
		list($weight_percent_width, $weight_percent_empty) = adr_make_bars($current_weight, $max_weight, '318');
		##=== Create bar widths ===##

		$sql = "SELECT item_in_shop FROM " . ADR_SHOPS_ITEMS_TABLE . "
				WHERE item_owner_id = $searchid
				AND item_duration > 0
				AND item_in_warehouse < 1
				AND item_auth = 0
				AND item_monster_thief = 0 ";
		if ( !($result = $db->sql_query($sql)) ) 
		{ 
			message_die(CRITICAL_ERROR, 'Error Getting Adr Users!'); 
		}	
		$items = $db->sql_fetchrowset($result);

		$items_owned =  count($items);
		$items_in_inventory = 0;
		$items_in_shop = 0;

		if ( $items_owned )
		{
			for ( $p = 0 ; $p < $items_owned ; $p ++ )
			{
				if ( !$items[$p]['item_in_shop'] ) $items_in_inventory++ ;
				else $items_in_shop++ ;
			}
		}

		$inventory_link = append_sid("adr_character_inventory.$phpEx?" . POST_USERS_URL . "=" . $searchid . "");

		$sql = " SELECT shop_id FROM " . ADR_SHOPS_TABLE . "
			WHERE shop_owner_id = $searchid ";
		if ( !($result = $db->sql_query($sql)) ) 
		{ 
			message_die(CRITICAL_ERROR, 'Error Getting Adr Users!'); 
		}
		$shop = $db->sql_fetchrow($result);

		$shop_link = append_sid("adr_shops.$phpEx?mode=see_shop&amp;shop_id=" . $shop['shop_id'] . "");

		if ( is_numeric($shop['shop_id']))
		{
			$template->assign_block_vars('adr_profile.shop',array());
		}
		else
		{
			$template->assign_block_vars('adr_profile.no_shop',array());
		}

		include($phpbb_root_path . 'adr/language/lang_' . $board_config['default_lang'] . '/lang_adr.'.$phpEx);

		$skills = adr_get_skill_data('');

		##=== Create bar widths ===##
		list($mining_percent_width, $mining_percent_empty) = adr_make_bars($row['character_skill_mining_uses'], $skills[1]['skill_req'], '250');
		list($stone_percent_width, $stone_percent_empty) = adr_make_bars($row['character_skill_stone_uses'], $skills[2]['skill_req'], '250');
		list($forge_percent_width, $forge_percent_empty) = adr_make_bars($row['character_skill_forge_uses'], $skills[3]['skill_req'], '250');
		list($enchantment_percent_width, $enchantment_percent_empty) = adr_make_bars($row['character_skill_enchantment_uses'], $skills[4]['skill_req'], '250');
		list($thief_percent_width, $thief_percent_empty) = adr_make_bars($row['character_skill_thief_uses'], $skills[1]['skill_req'], '250');
		##=== Create bar widths ===##

		// Is this the owner viewing the profile?  If so, let them see their Battle & Skill Limits
		if ( $searchid == $user_id )
		{
			$template->assign_block_vars( 'adr_profile.owner', array());
		}

		// Let's get the sizes of all of the images
		list($class_width, $class_height) = @getimagesize('adr/images/classes/'.$row['class_img']);
		list($race_width, $race_height) = @getimagesize('adr/images/races/'.$row['race_img']);
		list($element_width, $element_height) = @getimagesize('adr/images/elements/'.$row['element_img']);
		list($alignment_width, $alignment_height) = @getimagesize('adr/images/alignments/'.$row['alignment_img']);
		list($au_width, $au_height) = @getimagesize('adr/images/misc/au.gif');
		list($sp_width, $sp_height) = @getimagesize('adr/images/misc/sp.gif');
		list($ac_width, $ac_height) = @getimagesize('adr/images/misc/ac.gif');
		list($power_width, $power_height) = @getimagesize('adr/images/misc/str.gif');
		list($agility_width, $agility_height) = @getimagesize('adr/images/misc/dex.gif');
		list($constit_width, $constit_height) = @getimagesize('adr/images/misc/const.gif');
		list($int_width, $int_height) = @getimagesize('adr/images/misc/int.gif');
		list($wis_width, $wis_height) = @getimagesize('adr/images/misc/look.gif');
		list($cha_width, $cha_height) = @getimagesize('adr/images/misc/cha.gif');
		list($ma_width, $ma_height) = @getimagesize('adr/images/misc/witch.gif');
		list($md_width, $md_height) = @getimagesize('adr/images/misc/wis.gif');

		// Set the image heights to the MAX_CHARACTERISTICS_IMAGE_HT defined above
		( $au_height >= MAX_CHARACTERISTICS_IMAGE_HT ) ? $au_height = MAX_CHARACTERISTICS_IMAGE_HT : '';
		( $sp_height >= MAX_CHARACTERISTICS_IMAGE_HT ) ? $sp_height = MAX_CHARACTERISTICS_IMAGE_HT : '';
		( $ac_height >= MAX_CHARACTERISTICS_IMAGE_HT ) ? $ac_height = MAX_CHARACTERISTICS_IMAGE_HT : '';
		( $power_height >= MAX_CHARACTERISTICS_IMAGE_HT ) ? $power_height = MAX_CHARACTERISTICS_IMAGE_HT : '';
		( $agility_height >= MAX_CHARACTERISTICS_IMAGE_HT ) ? $agility_height = MAX_CHARACTERISTICS_IMAGE_HT : '';
		( $constit_height >= MAX_CHARACTERISTICS_IMAGE_HT ) ? $constit_height = MAX_CHARACTERISTICS_IMAGE_HT : '';
		( $int_height >= MAX_CHARACTERISTICS_IMAGE_HT ) ? $int_height = MAX_CHARACTERISTICS_IMAGE_HT : '';
		( $wis_height >= MAX_CHARACTERISTICS_IMAGE_HT ) ? $wis_height = MAX_CHARACTERISTICS_IMAGE_HT : '';
		( $cha_height >= MAX_CHARACTERISTICS_IMAGE_HT ) ? $cha_height = MAX_CHARACTERISTICS_IMAGE_HT : '';
		( $ma_height >= MAX_CHARACTERISTICS_IMAGE_HT ) ? $ma_height = MAX_CHARACTERISTICS_IMAGE_HT : '';
		( $md_height >= MAX_CHARACTERISTICS_IMAGE_HT ) ? $md_height = MAX_CHARACTERISTICS_IMAGE_HT : '';

		// Use the height of the tallest image in the line
		( $au_height >= 0 ) ? $height_1 = $au_height : $height_1 = 0;
		( $sp_height >= $int_height ) ? $height_2 = $sp_height : $height_2 = $int_height;
		( $ac_height >= $wis_height ) ? $height_3 = $ac_height :  $height_3 = $wis_height;
		( $power_height >= $cha_height ) ? $height_4 = $power_height :  $height_4 = $cha_height;
		( $agility_height >= $ma_height ) ? $height_5 = $agility_height :  $height_5 = $ma_height;
		( $constit_height >= $md_height ) ? $height_6 = $constit_height :  $height_6 = $ma_height;

		// Use Template Adjustments?
		if ( USE_TEMPLATE_ADJUSTMENTS )
		{
			// Determine the template being used
			if ( !$board_config['override_user_style'] || $userdata['user_level'] == ADMIN )
			{
				if ( $userdata['user_style'] > 0 )
				{
					$user_style = $userdata['user_style'];
				}
				else
				{
	    			$user_style = $board_config['default_style'];
				}
			}
			else
			{
				$user_style = $board_config['default_style'];
			}
			// Style #'s are the themes_id from your themes table
			// $base_styles are theme_id's that all have the same $height_adjustment, determined by trial and error
			// There should be an else if for each template that needs different sizes than the base templates, determined by trial and error
			// Enter your base theme_id's in the array below (if you only have one theme/template enter it as the only value in the array)
			$base_styles = array(1,2,3,4,5);
			if (in_array($user_style,$base_styles))
			{
				$height_adjustment = 77;
			}
			// Example of the needed else if for different styles
//			else if ( $user_style == 6 || $user_style == 7 )
//			{
//				$height_adjustment = 66;
//			}
			// The catch all, if the template is not defined above
			else
			{
				$height_adjustment = 77;
			}

			// The calculated height of the space between the bars and the characteristics tables
			$v_height = ( $class_height + $race_height + $element_height + $alignment_height + $height_adjustment ) - ( $height_1 + $height_2 + $height_3 + $height_4 + $height_5 + $height_6 );
		}
		else
		{
			// The height of the space between the bars and the characteristics tables, if USE_TEMPLATE_ADJUSTMENTS is set to false
			$v_height = SPACER_HEIGHT;
		}
	}

	$template->assign_vars(array(
		'ITEMS_OWNED' => $items_owned,
		'ITEMS_INVENTORY' => $items_in_inventory,
		'ITEMS_SHOP' => $items_in_shop,
		'SHOP_LINK' => $shop_link,
		'INVENTORY_LINK' => $inventory_link,
		'MINING' => $row['character_skill_mining'],
		'MINING_IMG' => $skills[1]['skill_img'],
		'MINING_MIN' => $row['character_skill_mining_uses'],
		'MINING_MAX' => $skills[1]['skill_req'],
		'MINING_BAR' => $mining_percent_width,
		'MINING_BAR_EMPTY' => $mining_percent_empty,
		'STONE' => $row['character_skill_stone'],
		'STONE_IMG' => $skills[2]['skill_img'],
		'STONE_MIN' => $row['character_skill_stone_uses'],
		'STONE_MAX' => $skills[2]['skill_req'],
		'STONE_BAR' => $stone_percent_width,
		'STONE_BAR_EMPTY' => $stone_percent_empty,
		'FORGE' => $row['character_skill_forge'],
		'FORGE_IMG' => $skills[3]['skill_img'],
		'FORGE_MIN' => $row['character_skill_forge_uses'],
		'FORGE_MAX' => $skills[3]['skill_req'],
		'FORGE_BAR' => $forge_percent_width,
		'FORGE_BAR_EMPTY' => $forge_percent_empty,
		'ENCHANTMENT' => $row['character_skill_enchantment'],
		'ENCHANTMENT_IMG' => $skills[4]['skill_img'],
		'ENCHANTMENT_MIN' => $row['character_skill_enchantment_uses'],
		'ENCHANTMENT_MAX' => $skills[4]['skill_req'],
		'ENCHANTMENT_BAR' => $enchantment_percent_width,
		'ENCHANTMENT_BAR_EMPTY' => $enchantment_percent_empty,
		'THIEF' => $row['character_skill_thief'],
		'THIEF_IMG' => $skills[6]['skill_img'],
		'THIEF_MIN' => $row['character_skill_thief_uses'],
		'THIEF_MAX' => $skills[6]['skill_req'],
		'THIEF_BAR' => $thief_percent_width,
		'THIEF_BAR_EMPTY' => $thief_percent_empty,
		'L_MINING' => $lang['Adr_mining'],
		'L_MINING_DESC' => adr_get_lang($skills[1]['skill_desc']),
		'L_STONE' => $lang['Adr_stone'],
		'L_STONE_DESC' => adr_get_lang($skills[2]['skill_desc']),
		'L_FORGE' => $lang['Adr_forge'],
		'L_FORGE_DESC' => adr_get_lang($skills[3]['skill_desc']),
		'L_ENCHANTMENT' => $lang['Adr_enchantment'],
		'L_ENCHANTMENT_DESC' => adr_get_lang($skills[4]['skill_desc']),
		'L_TRADING' => $lang['Adr_trading'],
		'L_TRADING_DESC' => adr_get_lang($skills[5]['skill_desc']),
		'L_THIEF' => $lang['Adr_thief'],
		'L_THIEF_DESC' => adr_get_lang($skills[6]['skill_desc']),
		'LEVEL' => $row['character_level'],
		'POWER' => $row['character_might'],
		'AGILITY' => $row['character_dexterity'],
		'CONSTIT' => $row['character_constitution'],
		'INT' => $row['character_intelligence'],
		'WIS' => $row['character_wisdom'],
		'CHA' => $row['character_charisma'],
		'MA' => $row['character_magic_attack'],
		'MD' => $row['character_magic_resistance'],
		'POINTS' => number_format($view_userdata['user_points']),
		'AU_HT' => $au_height,
		'SP_HT' => $sp_height,
		'AC_HT' => $ac_height,
		'POWER_HT' => $power_height,
		'AGILITY_HT' => $agility_height,
		'CONSTIT_HT' => $constit_height,
		'INT_HT' => $int_height,
		'WIS_HT' => $wis_height,
		'CHA_HT' => $cha_height,
		'MA_HT' => $ma_height,
		'MD_HT' => $md_height,
		'HP' => $row['character_hp'],
		'MP' => $row['character_mp'],
		'EXP' => $row['character_xp'],
		'HP_MAX' => $row['character_hp_max'],
		'MP_MAX' => $row['character_mp_max'],
		'SP' => number_format($row['character_sp']),
		'EXP_MAX' => $max_xp,
		'WEIGHT' => $current_weight,
		'WEIGHT_MAX' => $max_weight,
		'WEIGHT_PERCENT_WIDTH' => $weight_percent_width,
		'BATTLE_VICTORIES' => $row['character_victories'],
		'BATTLE_DEFEATS' => $row['character_defeats'],
		'BATTLE_FLEES' => $row['character_flees'],
        'BATTLE_DOUBLE_KO' => $row['character_double_ko'],
		'BATTLE_LIMIT' => $row['character_battle_limit'],
		'SKILL_LIMIT' => $row['character_skill_limit'],
		'TRADING_LIMIT' => $row['character_trading_limit'],
		'THIEF_LIMIT' => $row['character_thief_limit'],
		'AC' => $row['character_ac'],
		'NAME' => $row['character_name'],
		'BIO' => str_replace("\n", "\n<br />\n", $row['character_desc']),
		'AVATAR_IMG' => $avatar_img, 
		'CLASS' => $class,
		'RACE' => $race,
		'ELEMENT' => $element,
		'ALIGNMENT' => $alignment,
		'CLASS_IMG' => $row['class_img'],
		'RACE_IMG' => $row['race_img'],
		'ELEMENT_IMG' => $row['element_img'],
		'ALIGNMENT_IMG' => $row['alignment_img'],
		'V_SPACER_HEIGHT' => $v_height,
		'HP_PERCENT_WIDTH' => $hp_percent_width,
		'MP_PERCENT_WIDTH' => $mp_percent_width,
		'EXP_PERCENT_WIDTH' => $exp_percent_width,
		'ADR_YEAR' => $adr_years,
		'ADR_MONTH' => $adr_months,
		'ADR_WEEK' => $adr_weeks,
		'ADR_DAY' => $adr_days,
		'ADR_HOUR' => $adr_hours,
		'CHAR_YEAR' => adr_character_age($searchid, '0'),
		'HP_PERCENT_EMPTY' => $hp_percent_empty,
		'MP_PERCENT_EMPTY' => $mp_percent_empty,
		'EXP_PERCENT_EMPTY' => $exp_percent_empty,
		'WEIGHT_PERCENT_EMPTY' => $weight_percent_empty,
		'L_YEAR' => $lang['year'],
		'L_MONTH' => $lang['month'],
		'L_WEEK' => $lang['week'],
		'L_DAY' => $lang['day'],
		'L_HOUR' => $lang['hour'],
		'L_AGE' => $lang['Adr_character_age'],
		'L_CHARACTER_AGE' => $lang_age,
		'L_MA' => $lang['Adr_character_ma'],
		'L_MD' => $lang['Adr_character_md'],
		'L_BIO' => $lang['Adr_character_new_bio'],
		'L_CLASS' => $lang['Adr_character_class'],
		'L_RACE' => $lang['Adr_character_race'],
		'L_ELEMENT' => $lang['Adr_character_element'],
		'L_ALIGNMENT' => $lang['Adr_character_alignment'],
		'L_HEALTH'=> $lang['Adr_character_health'],
		'L_MAGIC' => $lang['Adr_character_magic'],
		'L_EXPERIENCE' => $lang['Adr_character_experience'],
		'L_SP' => $lang['Adr_character_sp'],
		'L_WEIGHT' => $lang['Adr_character_weight'],
		'L_AC' => $lang['Adr_character_ac'],
		'L_POWER' => $lang['Adr_character_power'],
		'L_AGILITY' => $lang['Adr_character_agility'],
		'L_CONSTIT' => $lang['Adr_character_endurance'],
		'L_INT' => $lang['Adr_character_intelligence'],
		'L_WIS' => $lang['Adr_character_willpower'],
		'L_CHA' => $lang['Adr_character_charm'],
		'L_POINTS' => get_reward_name(),
		'L_BATTLE_STATISTICS' => $lang['Adr_character_battle_statistics'],
		'L_BATTLE_VICTORIES' => $lang['Adr_character_victories'],
		'L_BATTLE_DEFEATS' => $lang['Adr_character_defeats'],
		'L_BATTLE_SKILLS' => $lang['Adr_character_battle_skills'],
		'L_BATTLE_LIMIT' => $lang['Adr_character_battle_limit'],
		'L_SKILL_LIMIT' => $lang['Adr_character_skill_limit'],
		'L_TRADING_LIMIT' => $lang['Adr_character_trading_limit'],
		'L_THIEF_LIMIT' => $lang['Adr_character_thief_limit'],
		'L_BATTLE_FLEES' => $lang['Adr_character_flees'],
        'L_BATTLE_DOUBLE_KO' => $lang['Adr_character_double_ko'],
		'L_BATTLE_SEE_MONSTERS' => $lang['Adr_character_battle_history_monsters'],
		'L_BATTLE_SEE_PLAYERS' => $lang['Adr_character_battle_history_players'],
		'L_NAME' => $lang['Adr_races_name'],
		'L_DESC' => $lang['Adr_races_desc'],
		'L_IMG' => $lang['Adr_races_image'],
		'L_LEVEL' => $lang['Adr_character_level'],
		'L_PROGRESS' => $lang['Adr_character_progress'],
		'L_SKILLS' => $lang['Adr_character_skills'],
		'L_CHARACTER_OF' => sprintf ( $lang['Adr_character_of'], $view_userdata['username'] ),
		'L_MINING' => $lang['Adr_mining'],
		'L_MINING_DESC' => adr_get_lang($skills[1]['skill_desc']),
		'L_STONE' => $lang['Adr_stone'],
		'L_STONE_DESC' => adr_get_lang($skills[2]['skill_desc']),
		'L_FORGE' => $lang['Adr_forge'],
		'L_FORGE_DESC' => adr_get_lang($skills[3]['skill_desc']),
		'L_ENCHANTMENT' => $lang['Adr_enchantment'],
		'L_ENCHANTMENT_DESC' => adr_get_lang($skills[4]['skill_desc']),
		'L_TRADING' => $lang['Adr_trading'],
		'L_TRADING_DESC' => adr_get_lang($skills[5]['skill_desc']),
		'L_THIEF' => $lang['Adr_thief'],
		'L_THIEF_DESC' => adr_get_lang($skills[6]['skill_desc']),	
		'L_NO_CHARACTER' => $lang['Adr_character_lack'],
		'L_ITEMS' => $lang['Adr_items_prefs'],
		'L_COUNT_ITEMS' => $lang['Adr_count_items'],
		'L_COUNT_ITEMS_INVENTORY' => $lang['Adr_count_items_inventory'],
		'L_COUNT_ITEMS_SHOPS' => $lang['Adr_count_items_shop'],
		'L_SEE_INVENTORY' => $lang['Adr_see_inventory'],
		'L_SEE_SHOP' => $lang['Adr_see_shop'],
		'L_NO_SHOP' => $lang['Adr_no_shop'],
		'L_EQUIPMENT' => $lang['Adr_equipment_page_name'],
		'L_SEE_EQUIPMENT' => $lang['Adr_see_equipment'],
		'U_EQUIPMENT' => append_sid("adr_character_equipment.$phpEx?" . POST_USERS_URL . "=" . $view_userdata['user_id']),
		'U_NAME' => append_sid("adr_character.$phpEx?" . POST_USERS_URL . "=" . $view_userdata['user_id']),
		'S_CHARACTER_ACTION' => append_sid("adr_character.$phpEx?".POST_USERS_URL."=".$searchid),
	));
}

// page
$template->pparse('body');

?>
