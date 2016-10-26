<?php
/***************************************************************************
 *                              admin_banner.php
 *                            -------------------
 *		ver 1.2.3
 *          Author: Niels Chr. Rød, Denmark
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

define('IN_PHPBB', 1);
define('CT_SECLEVEL', 'LOW');
$ct_ignorepvar = array('banner_description');
if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['Styles']['Banner'] = $file;
	return;
}

function selection($default='0', $select_name = 'banner_type')
{
	global $lang;
	if ( !isset($default) )
	{
		$default == 0;
	}
	$type_select = '<select name="' . strtolower($select_name) . '">';
	while( list($offset, $type) = @each( $lang[$select_name] ) )
	{
		$selected = ( $offset == $default ) ? ' selected="selected"' : '';
		$type_select .= '<option value="' . $offset . '"' . $selected . '>' . $type . '</option>';
	}
	$type_select .= '</select>';
	return $type_select;
}

//
// Let's set the root dir for phpBB
//
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_banner.' . $phpEx);

if( isset($_GET['mode']) || isset($_POST['mode']) )
{
	$mode = (isset($_GET['mode'])) ? $_GET['mode'] : $_POST['mode'];
}
else 
{
	//
	// These could be entered via a form button
	//
	if( isset($_POST['add']) )
	{
		$mode = "add";
	}
	else if( isset($_POST['save']) )
	{
		$mode = "save";
	}
	else
	{
		$mode = "";
	}
}


if( $mode!= "")
{
	if( $mode == "edit" || $mode == "add" )
	{
		//
		// They want to add a new banner, show the form.
		//
		if( isset($_POST['id']) || isset($_GET['id']) )
		{
			$banner_id = ( isset($_POST['id']) ) ? intval($_POST['id']) : intval($_GET['id']);
		}
		else
		{
			$banner_id = 0;
		}
		
		$s_hidden_fields = "";
		
		if( $mode == "edit" )
		{
			if( empty($banner_id) )
			{
				message_die(GENERAL_MESSAGE, $lang['Missing_banner_id']);
			}

			$sql = "SELECT * FROM " . BANNERS_TABLE . "
				WHERE banner_id = '$banner_id'";
			if(!$result = $db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, "Couldn't obtain banner data", "", __LINE__, __FILE__, $sql);
			}
			
			$banner_info = $db->sql_fetchrow($result);
			$s_hidden_fields .= '<input type="hidden" name="id" value="' . $banner_id . '" />';
		}
		else
		{
			// Default settings for new banners
			$banner_info['banner_active'] = 1;
			$banner_info['banner_weigth'] = 50;
			$banner_info['banner_level'] = -1;
			$banner_info['banner_level_type'] = 2;
			$banner_info['banner_type'] = 0;
			$banner_info['banner_width'] = 122;
			$banner_info['banner_height'] = 55;
			$banner_info['banner_filter_time'] = 600;

		}

		$s_hidden_fields .= '<input type="hidden" name="mode" value="save" />';
		$banner_is_active = ( $banner_info['banner_active'] ) ? "checked=\"checked\"" : "";
		$banner_is_not_active = ( !$banner_info['banner_active'] ) ? "checked=\"checked\"" : "";
		
		$template->set_filenames(array(
			'body' => 'admin/banner_edit_body.tpl')
		);

		$owner = get_userdata( intval($banner_info['banner_owner']) );
		$s_time_week_begin='<option value="0">-
			<option value="1">'.$lang['datetime']['Mon'].'
			<option value="2">'.$lang['datetime']['Tue'].'
			<option value="3">'.$lang['datetime']['Wed'].'
			<option value="4">'.$lang['datetime']['Thu'].'
			<option value="5">'.$lang['datetime']['Fri'].'
			<option value="6">'.$lang['datetime']['Sat'].'
			<option value="0">'.$lang['datetime']['Sun'];
		$s_time_week_end=$s_time_week_begin;
		$s_time_min_begin ='<option value="00">00
			<option value="10">10
			<option value="15">15
			<option value="20">20
			<option value="30">30
			<option value="40">40
			<option value="45">45
			<option value="50">50
			<option value="59">59';
		$s_time_min_end ='<option value="00">00
			<option value="09">09
			<option value="14">14
			<option value="19">19
			<option value="29">29
			<option value="39">39
			<option value="44">44
			<option value="49">49
			<option value="59">59';
		$s_time_hours_begin ='<option value="00">00
			<option value="01">01
			<option value="02">02
			<option value="03">03
			<option value="04">04
			<option value="05">05
			<option value="06">06
			<option value="07">07
			<option value="08">08
			<option value="09">09
			<option value="10">10
			<option value="11">11
			<option value="12">12
			<option value="13">13
			<option value="14">14
			<option value="15">15
			<option value="16">16
			<option value="17">17
			<option value="18">18
			<option value="19">19
			<option value="20">20
			<option value="21">21
			<option value="22">22
			<option value="23">23';
		$s_time_hours_end=$s_time_hours_begin;
		$s_time_date_begin='<option value="0">-
			<option value="01">01
			<option value="02">02
			<option value="03">03
			<option value="04">04
			<option value="05">05
			<option value="06">06
			<option value="07">07
			<option value="08">08
			<option value="09">09
			<option value="10">10
			<option value="11">11
			<option value="12">12
			<option value="13">13
			<option value="14">14
			<option value="15">15
			<option value="16">16
			<option value="17">17
			<option value="18">18
			<option value="19">19
			<option value="20">20
			<option value="21">21
			<option value="22">22
			<option value="23">23
			<option value="24">24
			<option value="25">25
			<option value="26">26
			<option value="27">27
			<option value="28">28
			<option value="29">29
			<option value="30">30
			<option value="31">31';
		$s_time_date_end=$s_time_date_begin;
		$s_time_months_begin='<option value="0">-
			<option value="01">'.$lang['datetime']['Jan'].'
			<option value="02">'.$lang['datetime']['Feb'].'
			<option value="03">'.$lang['datetime']['Mar'].'
			<option value="04">'.$lang['datetime']['Apr'].'
			<option value="05">'.$lang['datetime']['May'].'
			<option value="06">'.$lang['datetime']['Jun'].'
			<option value="07">'.$lang['datetime']['Jul'].'
			<option value="08">'.$lang['datetime']['Aug'].'
			<option value="09">'.$lang['datetime']['Sep'].'
			<option value="10">'.$lang['datetime']['Oct'].'
			<option value="11">'.$lang['datetime']['Nov'].'
			<option value="12">'.$lang['datetime']['Dec'];
		$s_time_months_end=$s_time_months_begin;
		$s_time_year_begin =' <option value="0">-
			<option value="2002">2002
			<option value="2003">2003
			<option value="2004">2004
			<option value="2005">2005
			<option value="2006">2006
			<option value="2007">2007
			<option value="2008">2008
			<option value="2009">2009
			<option value="2010">2010
			<option value="2099">2099';
		$s_time_year_end =$s_time_year_begin;
		switch ($banner_info['banner_timetype'])
		{
			case 0: $rule_type=$lang['No_time'];
				$rule_begin = $lang['None'];
				$rule_end = $lang['None'];
				$c_no_time = 'CHECKED';break;
			case 2:	
				$time_begin = $banner_info['time_begin'];
				$hour_begin=$time_begin['0'].$time_begin['1'];
				$min_begin=$time_begin['2'].$time_begin['3'];
				$time_end = $banner_info['time_end'];
				$hour_end=$time_end['0'].$time_end['1'];
				$min_end=$time_end['2'].$time_end['3'];
				$s_time_hours_begin = str_replace("value=\"$hour_begin\">", "value=\"".$hour_begin."\" SELECTED>" ,$s_time_hours_begin);
				$s_time_hours_end = str_replace("value=\"$hour_end\">", "value=\"".$hour_end."\" SELECTED>" ,$s_time_hours_end);
				$s_time_min_begin = str_replace("value=\"$min_begin\">", "value=\"".$min_begin."\" SELECTED>" ,$s_time_min_begin);
				$s_time_min_end = str_replace("value=\"$min_end\">", "value=\"".$min_end."\" SELECTED>" ,$s_time_min_end);
				$rule_type=$lang['By_time'];
				$rule_begin = sprintf("%04d",$banner_info['time_begin']);
				$rule_end = sprintf("%04d",$banner_info['time_end']);
				$c_by_time = 'CHECKED';break;
			case 4 :	
				$time_begin = $banner_info['time_begin'];
				$hour_begin=$time_begin['0'].$time_begin['1'];
				$min_begin=$time_begin['2'].$time_begin['3'];
				$week_begin=$banner_info['date_begin'];
				$time_end = $banner_info['time_end'];
				$hour_end=$time_end['0'].$time_end['1'];
				$min_end=$time_end['2'].$time_end['3'];
				$week_end=$banner_info['date_end'];
				$s_time_hours_begin = str_replace("value=\"$hour_begin\">", "value=\"".$hour_begin."\" SELECTED>" ,$s_time_hours_begin);
				$s_time_hours_end = str_replace("value=\"$hour_end\">", "value=\"".$hour_end."\" SELECTED>" ,$s_time_hours_end);
				$s_time_min_begin = str_replace("value=\"$min_begin\">", "value=\"".$min_begin."\" SELECTED>" ,$s_time_min_begin);
				$s_time_min_end = str_replace("value=\"$min_end\">", "value=\"".$min_end."\" SELECTED>" ,$s_time_min_end);
				$s_time_week_begin=str_replace("value=\"$week_begin\">", "value=\"".$week_begin."\" SELECTED>" ,$s_time_week_begin);
				$s_time_week_end=str_replace("value=\"$week_end\">", "value=\"".$week_end."\" SELECTED>" ,$s_time_week_end);
				$rule_type=$lang['By_week'];
				$day_array = array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
				$rule_begin = $lang['datetime'][$day_array[$banner_info['date_begin']]].', '.sprintf("%04d",$banner_info['time_begin']);
				$rule_end = $lang['datetime'][$day_array[$banner_info['date_end']]].', '.sprintf("%04d",$banner_info['time_end']);
				$c_by_week = 'CHECKED';break;
			case 6:	
				$time_begin = $banner_info['time_begin'];
				$hour_begin=$time_begin['0'].$time_begin['1'];
				$min_begin=$time_begin['2'].$time_begin['3'];
				$time_end = $banner_info['time_end'];
				$hour_end=$time_end['0'].$time_end['1'];
				$min_end=$time_end['2'].$time_end['3'];
				$s_time_hours_begin = str_replace("value=\"$hour_begin\">", "value=\"".$hour_begin."\" SELECTED>" ,$s_time_hours_begin);
				$s_time_hours_end = str_replace("value=\"$hour_end\">", "value=\"".$hour_end."\" SELECTED>" ,$s_time_hours_end);
				$s_time_min_begin = str_replace("value=\"$min_begin\">", "value=\"".$min_begin."\" SELECTED>" ,$s_time_min_begin);
				$s_time_min_end = str_replace("value=\"$min_end\">", "value=\"".$min_end."\" SELECTED>" ,$s_time_min_end);
				$date_begin = $banner_info['date_begin'];
				$year_begin=$date_begin['0'].$date_begin['1'].$date_begin['2'].$date_begin['3'];
				$month_begin=$date_begin['4'].$date_begin['5'];
				$day_begin=$date_begin['6'].$date_begin['7'];
				$date_end = $banner_info['date_end'];
				$year_end=$date_end['0'].$date_end['1'].$date_end['2'].$date_end['3'];
				$month_end=$date_end['4'].$date_end['5'];	
				$day_end=$date_end['6'].$date_end['7'];
				$s_time_year_begin = str_replace("value=\"$year_begin\">", "value=\"$year_begin\" SELECTED>" ,$s_time_year_begin);
				$s_time_year_end = str_replace("value=\"$year_end\">", "value=\"$year_end\" SELECTED>" ,$s_time_year_end);
				$s_time_months_begin = str_replace("value=\"$month_begin\">", "value=\"$month_begin\" SELECTED>" ,$s_time_months_begin);
				$s_time_months_end = str_replace("value=\"$month_end\">", "value=\"$month_end\" SELECTED>" ,$s_time_months_end);
				$s_time_date_begin = str_replace("value=\"$day_begin\">", "value=\"$day_begin\" SELECTED>" ,$s_time_date_begin);
				$s_time_date_end = str_replace("value=\"$day_end\">", "value=\"$day_end\" SELECTED>" ,$s_time_date_end);
				$rule_type=$lang['By_date'];
				$rule_begin = $banner_info['date_begin'].', '.sprintf("%04d",$banner_info['time_begin']);
				$rule_end = $banner_info['date_end'].', '.sprintf("%04d",$banner_info['time_end']);
				$c_by_date = 'CHECKED';break;
		default:	$rule_type=$lang['Not_specify'];
		}
		$n=0;
		while ( $lang['Banner_spot'][$n] )
		{
			$s_banner_spot.= ( $banner_info['banner_spot']==$n ) ? 
			'<option value="'.$n.'" SELECTED>* '.$lang['Banner_spot'][$n] : 
			'<option value="'.$n.'" >'.$lang['Banner_spot'][$n];
			$n++;
		}
		$n='-1';
		$s_level='<select name="banner_level">';
		while ( $lang['Banner_level'][$n] )
		{
			$s_level.= ( $banner_info['banner_level']==$n ) ? 
			'<option value="'.$n.'" SELECTED>* '.$lang['Banner_level'][$n] : 
			'<option value="'.$n.'" >'.$lang['Banner_level'][$n];
			$n++;
		}
		$s_level .='</select>';			
		$n=0;
		$s_level_type = '<select name="banner_level_type">';
		while ( $lang['Banner_level_type'][$n] )
		{
			$s_level_type.= ( $banner_info['banner_level_type']==$n ) ? 
			'<option value="'.$n.'" SELECTED> '.$lang['Banner_level_type'][$n] : 
			'<option value="'.$n.'" >'.$lang['Banner_level_type'][$n];
			$n++;
		}
		$s_level_type .='</select>';			


		//forum selection
		$sql = "SELECT f.forum_name, f.forum_id
			FROM " . FORUMS_TABLE . " f
			WHERE f.cat_id=1 ORDER BY f.forum_name ASC";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, "Couldn't obtain special pages list", "", __LINE__, __FILE__, $sql);
		}
		$forum_rows = $db->sql_fetchrowset($result);
		$db->sql_freeresult($result);

		$sql = "SELECT f.forum_name, f.forum_id
			FROM " . FORUMS_TABLE . " f, " . CATEGORIES_TABLE . " c
			WHERE c.cat_id = f.cat_id ORDER BY c.cat_order ASC, f.forum_order ASC";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, "Couldn't obtain forum list", "", __LINE__, __FILE__, $sql);
		}
		$forum_rows = array_merge($forum_rows,$db->sql_fetchrowset($result));
		$db->sql_freeresult($result);

		$forum_select_list = '<select name="' . POST_FORUM_URL . '">';
		$forum_select_list .= '<option value="0">' . $lang['All_available'] . '</option>';
		for($i = 0; $i < count($forum_rows); $i++)
		{
			$forum_select_list .= '<option value="' . $forum_rows[$i]['forum_id'] . '">' . $forum_rows[$i]['forum_name'] . '</option>';
		}
		$forum_select_list .= '</select>';
		$forum_select_list = str_replace("value=\"".$banner_info['banner_forum']."\">", "value=\"".$banner_info['banner_forum']."\" SELECTED>*" ,$forum_select_list);
		$banner_size = ($banner_info['banner_width'] && $banner_info['banner_height']) ? '"width="'.$banner_info['banner_width'].'" height="'.$banner_info['banner_height'].'"' : '';
		switch ($banner_info['banner_type'])
		{
			case 6 :
				// swf
				$banner_example = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,23,0" id="macromedia" '.$banner_size.' align="abscenter"	border="0" ><param name=movie value="'.$banner_info['banner_name'].'" /><param name=quality value=high /><embed src="'.$banner_info['banner_name'].'" quality=high pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" autostart="true" />
				<noembed><a href="'.append_sid('redirect.'.$phpEx.'?banner_id='.$banner_info['banner_id']).'" target="_blank">'.$banner_info['banner_description'].'</a></noembed></object>'; 
				break;
			case 4 :
				// custom
				$banner_example = $banner_info['banner_name'];
				break;
			case 2 :
				$banner_example = '<a href="'.append_sid('redirect.'.$phpEx.'?banner_id='.$banner_info['banner_id']).'" target="_blank">'.$banner_info['banner_name'].'</a>';
				break;
			case 0 :
			default: 
				$banner_example = '<a href="'.append_sid('redirect.'.$phpEx.'?banner_id='.$banner_info['banner_id']).'" target="_blank"><img src="'.$banner_info['banner_name'].'" '.$banner_size.' border="0" alt="'.$banner_info['banner_description'].'" title="'.$banner_info['banner_description'].'" /></a>';
		}


		$template->assign_vars(array(
			'L_BANNER_TITLE' => $lang['Banner_title'],
			'L_BANNER_TEXT' => $lang['Banner_add_text'],
			'L_BANNER_ACTIVATE' => $lang['Banner_activate'], 
			'BANNER_NOT_ACTIVE' => $banner_is_not_active,
			'BANNER_ACTIVE' => $banner_is_active,
			'L_BANNER_TYPE' => $lang['Banner_type_text'],
			'BANNER_TYPE' => selection($banner_info['banner_type'], 'Banner_type'),

			'L_BANNER_NAME' => $lang['Banner_name'],
			'L_BANNER_NAME_EXPLAIN' =>$lang['Banner_name_explain'],
			'BANNER_NAME' => $banner_info['banner_name'],
			'L_BANNER_EXAMPLE' => $lang['Banner_example'],
			'L_BANNER_EXAMPLE_EXPLAIN' => $lang['Banner_example_explain'],

			'BANNER_EXAMPLE' => $banner_example,
			'U_BANNER' => ( preg_match("/http/",strtolower($banner_info['/banner_name/']))) ? $banner_info['/banner_name/'] : '/..//'.$banner_info['/banner_name/'],
			'L_BANNER_DESCRIPTION' => $lang['Banner_description'],
			'L_BANNER_DESCRIPTION_EXPLAIN' => $lang['Banner_description_explain'],
			'BANNER_DESCRIPTION' => $banner_info['banner_description'],
			'L_BANNER_SIZE' => $lang['Banner_size'],
			'L_BANNER_SIZE_EXPLAIN' => $lang['Banner_size_explain'],
			'L_BANNER_HEIGHT' => $lang['Banner_height'],
			'L_BANNER_WIDTH' => $lang['Banner_width'],
			'BANNER_WIDTH' => $banner_info['banner_width'],
			'BANNER_HEIGHT' => $banner_info['banner_height'],


			'L_BANNER_FILTER' => $lang['Banner_filter'],
			'L_BANNER_FILTER_EXPLAIN' => $lang['Banner_filter_explain'],
			'BANNER_FILTER_YES' => ($banner_info['banner_filter']) ? 'checked="checked"' : '',
			'BANNER_FILTER_NO' => ($banner_info['banner_filter']) ? '' : 'checked="checked"',
			'L_BANNER_FILTER_TIME' => $lang['Banner_filter_time'],
			'L_BANNER_FILTER_TIME_EXPLAIN' => $lang['Banner_filter_time_explain'],
			'BANNER_FILTER_TIME' => $banner_info['banner_filter_time'],

			'L_BANNER_CLICK' => $lang['Banner_clicks'],
			'L_BANNER_CLICK_EXPLAIN' => $lang['Banner_clicks_explain'],
			'BANNER_CLICK' => $banner_info['banner_click'],
			'L_BANNER_VIEW' => $lang['Banner_view'],
			'BANNER_VIEW' => $banner_info['banner_view'],
			'L_BANNER_COMMENT' => $lang['Banner_comment'],
			'L_BANNER_COMMENT_EXPLAIN' => $lang['Banner_comment_explain'],
			'BANNER_COMMENT' => $banner_info['banner_comment'],
			'L_BANNER_URL' => $lang['Banner_url'],
			'L_BANNER_URL_EXPLAIN' => $lang['Banner_url_explain'],
			'BANNER_URL' => $banner_info['banner_url'],
			'L_BANNER_OWNER' => $lang['Banner_owner'],
			'L_BANNER_OWNER_EXPLAIN' => $lang['Banner_owner_explain'],
			'BANNER_OWNER' => $owner['username'],
			'U_SEARCH_USER' => append_sid("./../search.$phpEx?mode=searchuser"), 
			'L_FIND_USERNAME' => $lang['Find_username'],

			'L_BANNER_WEIGTH' => $lang['Banner_weigth'],
			'L_BANNER_WEIGTH_EXPLAIN' => $lang['Banner_weigth_explain'],
			'BANNER_WEIGTH' => $banner_info['banner_weigth'],
			'L_BANNER_SPOT' => $lang['Banner_placement'],
			'S_BANNER_SPOT' => $s_banner_spot,
			'S_BANNER_FORUM' => $forum_select_list,
			'L_BANNER_SHOW_TO' => $lang['Show_to_users'],
			'L_BANNER_SHOW_TO_EXPLAIN' => $lang['Show_to_users_explain'],
			'S_BANNER_SHOW_TO' => sprintf($lang['Show_to_users_select'],$s_level_type,$s_level),
			'C_NO_TIME' => $c_no_time,
			'C_BY_TIME' => $c_by_time,
			'C_BY_WEEK' => $c_by_week,
			'C_BY_DATE' => $c_by_date,
			'L_RULE_TYPE' => $rule_type,
			'RULE_BEGIN' => $rule_begin,
			'RULE_END' => $rule_end,
			'L_START' => $lang['Start'],
			'L_END' => $lang['End'],
			'L_YEAR' => $lang['Year'],
			'L_MONTH' => $lang['Month'],
			'L_DATE' => $lang['Date'],
			'L_WEEKDAY' => $lang['Weekday'],
			'L_HOURS' => $lang['Hours'],
			'L_MIN' => $lang['Min'],
			'S_WEEK_BEGIN' => $s_time_week_begin,
			'S_WEEK_END' => $s_time_week_end,
			'S_MIN_BEGIN' => $s_time_min_begin,
			'S_MIN_END' => $s_time_min_end,
			'S_HOURS_BEGIN' => $s_time_hours_begin,
			'S_HOURS_END' => $s_time_hours_end,
			'S_DATE_BEGIN' => $s_time_date_begin,
			'S_DATE_END' => $s_time_date_end,
			'S_MONTHS_BEGIN' => $s_time_months_begin,
			'S_MONTHS_END' => $s_time_months_end,
			'S_YEAR_BEGIN' => $s_time_year_begin,
			'S_YEAR_END' => $s_time_year_end,

			'L_TIME_INTERVAL' => $lang['Time_interval'] ,
			'L_TIME_INTERVAL_EXPLAIN' => $lang['Time_interval_explain'],
			'L_TIME_SELECT' => $lang['Time_select'],
			'L_TIME_TYPE' => $lang['Time_type'],
			'L_TIME_TYPE_EXPLAIN' => $lang['Time_type_explain'],
			'L_TIME_NO' => $lang['No_time'],
			'L_TIME_TIME' => $lang['By_time'],
			'L_TIME_WEEK' => $lang['By_week'],
			'L_TIME_DATE' => $lang['By_date'],
			'L_SUBMIT' => $lang['Submit'],
			'L_RESET' => $lang['Reset'],
			'L_YES' => $lang['Yes'],
			'L_NO' => $lang['No'],
		
			'S_BANNER_ACTION' => append_sid("admin_banner.$phpEx"),
			'S_HIDDEN_FIELDS' => $s_hidden_fields)
		);
	}
	else if( $mode == "save" )
	{
		//
		// Ok, they sent us our info, let's update it.
		//
		$banner_id = ( isset($_POST['id']) ) ? intval($_POST['id']) : 0;

		$banner_active = ( $_POST['banner_active'] == 1 ) ? TRUE : 0;
		$banner_filter = ( $_POST['banner_filter'] == 1 ) ? TRUE : 0;
		$banner_filter_time = ( isset($_POST['banner_filter_time']) ) ? intval($_POST['banner_filter_time']) : 0;

		$banner_type = ( isset($_POST['banner_type']) ) ? intval($_POST['banner_type']) : 0;
		$banner_name = ( isset($_POST['banner_name']) ) ? trim($_POST['banner_name']) : "";
		$banner_description = ( isset($_POST['banner_description']) ) ? trim($_POST['banner_description']) : "";
		$banner_width = ( isset($_POST['banner_width']) ) ? intval($_POST['banner_width']) : 0;
		$banner_height = ( isset($_POST['banner_height']) ) ? intval($_POST['banner_height']) : 0;
		$banner_click = ( isset($_POST['banner_click']) ) ? intval($_POST['banner_click']) : 0;
		$banner_view = ( isset($_POST['banner_view']) ) ? intval($_POST['banner_view']) : 0;
		$banner_url = ( isset($_POST['banner_url']) ) ? trim($_POST['banner_url']) : "";
		$banner_owner = ( isset($_POST['username']) ) ? trim($_POST['username']) : "";
		$banner_spot = ( isset($_POST['banner_spot']) ) ? intval($_POST['banner_spot']) : 0;
		$banner_forum = ( isset($_POST[POST_FORUM_URL]) ) ? intval($_POST[POST_FORUM_URL]) : 0;

		$banner_weigth = ( isset($_POST['banner_weigth']) ) ? intval($_POST['banner_weigth']) : 0;
		$banner_level = ( isset($_POST['banner_level']) ) ? intval($_POST['banner_level']) : -1;
		$banner_level_type = ( isset($_POST['banner_level_type']) ) ? intval($_POST['banner_level_type']) : 0;

		$time_type = ( isset($_POST['time_type']) ) ? intval($_POST['time_type']) : 0;
		$date_begin_week = ( isset($_GET['date_begin_week']) ) ? $_GET['date_begin_week'] : (( isset($_POST['date_begin_day']) ) ? $_POST['date_begin_week'] : '0');
		$date_end_week = ( isset($_GET['date_end_week']) ) ? $_GET['date_end_week'] : (( isset($_POST['date_end_day']) ) ? $_POST['date_end_week'] : '0');
		$date_begin_day = ( isset($_GET['date_begin_day']) ) ? $_GET['date_begin_day'] : (( isset($_POST['date_begin_day']) ) ? $_POST['date_begin_day'] : '0');
		$date_end_day = ( isset($_GET['date_end_day']) ) ? $_GET['date_end_day'] : (( isset($_POST['date_end_day']) ) ? $_POST['date_end_day'] : '0');
		$date_begin_year = ( isset($_GET['date_begin_year']) ) ? $_GET['date_begin_year'] : (( isset($_POST['date_begin_year']) ) ? $_POST['date_begin_year'] : '0');
		$date_begin_month = ( isset($_GET['date_begin_month']) ) ? $_GET['date_begin_month'] : (( isset($_POST['date_begin_month']) ) ? $_POST['date_begin_month'] : '0');
		$date_end_year = ( isset($_GET['date_end_year']) ) ? $_GET['date_end_year'] : (( isset($_POST['date_end_year']) ) ? $_POST['date_end_year'] : '0');
		$date_end_month = ( isset($_GET['date_end_month']) ) ? $_GET['date_end_month'] : (( isset($_POST['date_end_month']) ) ? $_POST['date_end_month'] : '0');
		$time_begin_hour = ( isset($_GET['time_begin_hour']) ) ? $_GET['time_begin_hour'] : (( isset($_POST['time_begin_hour']) ) ? $_POST['time_begin_hour'] : '0');
		$time_begin_min = ( isset($_GET['time_begin_min']) ) ? $_GET['time_begin_min'] : (( isset($_POST['time_begin_min']) ) ? $_POST['time_begin_min'] : '0');
		$time_end_hour = ( isset($_GET['time_end_hour']) ) ? $_GET['time_end_hour'] : (( isset($_POST['time_end_hour']) ) ? $_POST['time_end_hour'] : '0');
		$time_end_min = ( isset($_GET['time_end_min']) ) ? $_GET['time_end_min'] : (( isset($_POST['time_end_min']) ) ? $_POST['time_end_min'] : '0');

		switch ($time_type)
		{
		case 0: 	$time_begin=0;$time_end=0;
			$date_begin=0;$date_end=0;break;
		case 2:	$date_begin = 0;$date_end = 0;
			$time_begin = $time_begin_hour.$time_begin_min;
			$time_end = $time_end_hour.$time_end_min;
			if (!$time_begin || !$time_end)
			{
				message_die(GENERAL_MESSAGE, $lang['Missing_time']);
			}break;
		case 4 :	$time_begin = $time_begin_hour.$time_begin_min;
			$time_end = $time_end_hour.$time_end_min;
			$date_begin = $date_begin_week;
			$date_end = $date_end_week;
			if (!$date_begin || !$date_end)
			{
				message_die(GENERAL_MESSAGE, $lang['Missing_week']);
			}break;
		case 6 :	$time_begin = $time_begin_hour.$time_begin_min;
			$time_end = $time_end_hour.$time_end_min;
			$date_begin = $date_begin_year.$date_begin_month.$date_begin_day;
			$date_end = $date_end_year.$date_end_month.$date_end_day;
			if (!$date_begin || !$date_end)
			{
				message_die(GENERAL_MESSAGE, $lang['Missing_date']);
			}break;
		}
		$banner_comment = ( isset($_POST['banner_comment']) ) ? trim($_POST['banner_comment']) : "";
		// verify the inputs
		if( $banner_name == "" )
		{
			message_die(GENERAL_MESSAGE, $lang['Missing_banner_name']);
		}
		$owner=get_userdata($banner_owner);
		if ($owner['user_id']=="")
		{
			message_die(GENERAL_MESSAGE, $lang['Missing_banner_owner']);
		}
		if( !empty($banner_id) )
		{
			$sql = "UPDATE " . BANNERS_TABLE . "
				SET 	banner_active = $banner_active, banner_name = '" . str_replace("\'", "''", $banner_name) . "',
					banner_description = '" . str_replace("\'", "''", $banner_description) . "',	banner_click = $banner_click,	banner_view = $banner_view,
					banner_url = '" . str_replace("\'", "''", $banner_url) . "', banner_owner = ".$owner['user_id'].",
					banner_type = '$banner_type', banner_width = '$banner_width', banner_height = '$banner_height',
					banner_filter = '$banner_filter',banner_filter_time='$banner_filter_time',
					banner_spot = $banner_spot, banner_forum= $banner_forum, banner_weigth = $banner_weigth,	
					banner_level = '$banner_level', banner_level_type = '$banner_level_type', banner_timetype = $time_type,
					date_begin=$date_begin, date_end=$date_end, time_begin=$time_begin, time_end=$time_end,
					banner_comment='" . str_replace("\'", "''", $banner_comment) . "'	WHERE banner_id = '$banner_id'";
			$message = $lang['Banner_updated'];
		}
		else
		{
			$sql = "SELECT MAX(banner_id) as banner_id FROM " . BANNERS_TABLE;
			if(!$result = $db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, "Couldn't obtain banner id data", "", __LINE__, __FILE__, $sql);
			}
			$banner_nr = $db->sql_fetchrow($result);
			$banner_id = $banner_nr['banner_id']+1;
			$sql = "INSERT INTO " . BANNERS_TABLE . " (banner_id, banner_name, banner_active, banner_spot, banner_description, banner_url, banner_click, banner_view, banner_owner, banner_level, banner_level_type, banner_timetype, time_begin, time_end, date_begin, date_end, banner_comment, banner_type, banner_width, banner_height, banner_filter, banner_filter_time, banner_weigth)
				VALUES ('$banner_id','" . str_replace("\'", "''", $banner_name) . "', '$banner_active', '$banner_spot', '" . str_replace("\'", "''", $banner_description) . "', '" . str_replace("\'", "''", $banner_url) . "', '$banner_click', '$banner_view', '".$owner['user_id']."', '$banner_level', '$banner_level_type', '$time_type', '$time_begin', '$time_end', '$date_begin', '$date_end', '" . str_replace("\'", "''", $banner_comment) . "','$banner_type','$banner_width','$banner_height','$banner_filter','$banner_filter_time','$banner_weigth')";
			$message = $lang['Banner_added'];
		}
		if( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Couldn't update/insert into banners table", "", __LINE__, __FILE__, $sql);
		}
		$message .= "<br /><br />" . sprintf($lang['Click_return_banneradmin'], "<a href=\"" . append_sid("admin_banner.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");
		message_die(GENERAL_MESSAGE, $message);
	}
	else if( $mode == "delete" )
	{
		//
		// Ok, they lets delete the selected banner
		//
		
		if( isset($_POST['id']) || isset($_GET['id']) )
		{
			$banner_id = ( isset($_POST['id']) ) ? intval($_POST['id']) : intval($_GET['id']);
		}
		else
		{
			$banner_id = '';
		}
		
		if( !empty($banner_id ))
		{
			$sql = "DELETE FROM " . BANNERS_TABLE . "
				WHERE banner_id = '$banner_id'";
			
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Couldn't delete banner data", "", __LINE__, __FILE__, $sql);
			}
			$message = $lang['Banner_removed'] . "<br /><br />" . sprintf($lang['Click_return_banneradmin'], "<a href=\"" . append_sid("admin_banner.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");
			message_die(GENERAL_MESSAGE, $message);
		}
		else
		{
			message_die(GENERAL_MESSAGE, $lang['Missing_banner_id']);
		}
	} else
	{
		message_die(GENERAL_ERROR, 'Error illigal mode specifyed');
	}
}
else
{
//
// Show the default page
//
$template->set_filenames(array(
	"body" => "admin/banner_list_body.tpl"));
	$sql = "SELECT * FROM " . BANNERS_TABLE ." order by banner_spot";
	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, "Couldn't obtain ranks data", "", __LINE__, __FILE__, $sql);
	}
	$banners_count = $db->sql_numrows($result);
	$banners_rows = $db->sql_fetchrowset($result);
	$template->assign_vars(array(
		"L_BANNER_TITLE" => $lang['Banner_title'],
		"L_BANNER_TEXT" => $lang['Banner_text'],
		"L_BANNER_DESCRIPTION" => $lang['Banner_description'],
		"L_BANNER_ACTIVATED" => $lang['Banner_activated'],
		"L_TIME_TYPE" => $lang['Time_type'],
		"L_BANNER_NAME" => $lang['Banner_name'],
		"L_BANNER_COMMENT" => $lang['Banner_comment'],
		"L_BANNER_CLICKS" => $lang['Banner_clicks'],
		"L_BANNER_VIEW" => $lang['Banner_view'],
		"L_BANNER_SPOT" => $lang['Banner_placement'],
		"L_EDIT" => $lang['Edit'],
		"L_DELETE" => $lang['Delete'],
		"L_ADD_BANNER" => $lang['Add_new_banner'],
		"L_ACTION" => $lang['Action'],
		
		"S_BANNER_ACTION" => append_sid("admin_banner.$phpEx"))
	);
	
	for($i = 0; $i < $banners_count; $i++)
	{
		$banner_name = $banners_rows[$i]['banner_name'];
		$banner_id = $banners_rows[$i]['banner_id'];
		$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
		$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
		$banner_is_active = ( $banners_rows[$i]['banner_active'] ) ? $lang['Yes'] : $lang['No'];
		switch ($banners_rows[$i]['banner_timetype'])
		{
			case 0: $rule_type=$lang['No_time'];
					$rule_begin = '';
					$rule_end = '';break;
			case 2:	$rule_type=$lang['By_time'].'</br>';
					$rule_begin = sprintf("%04d",$banners_rows[$i]['time_begin']).'</br>';
					$rule_end = sprintf("%04d",$banners_rows[$i]['time_end']);break;
			case 4 :	$rule_type=$lang['By_week'].'</br>';
					$day_array = array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
					$rule_begin = $lang['datetime'][$day_array[$banners_rows[$i]['date_begin']]].', '.sprintf("%04d",$banners_rows[$i]['time_begin']).'</br>';
					$rule_end = $lang['datetime'][$day_array[$banners_rows[$i]['date_end']]].', '.sprintf("%04d",$banners_rows[$i]['time_end']);break;
			case 6:	$rule_type=$lang['By_date'].'</br>';
					$rule_begin = $banners_rows[$i]['date_begin'].', '.sprintf("%04d",$banners_rows[$i]['time_begin']).'</br>';
					$rule_end = $banners_rows[$i]['date_end'].', '.sprintf("%04d",$banners_rows[$i]['time_end']);break;
		default:		$rule_type=$lang['Not_specify'];
		}	
		$template->assign_block_vars("banners", array(
			'ROW_COLOR' => "#" . $row_color,
			'ROW_CLASS' => $row_class,
			'BANNER_DESCRIPTION' => $banners_rows[$i]['banner_description'],
			'BANNER_IS_ACTIVE' => $banner_is_active,
			'BANNER_NAME' => $banner_name,
			'BANNER_CLICKS' => $banners_rows[$i]['banner_click'],
			'BANNER_VIEW' => $banners_rows[$i]['banner_view'],
			'BANNER_COMMENT' => $banners_rows[$i]['banner_comment'],
			'BANNER_SPOT' => $lang['Banner_spot'][$banners_rows[$i]['banner_spot']],
			'BANNER_ID' => $banner_id,
			'L_RULE_TYPE' => $rule_type,
			'RULE_BEGIN' => $rule_begin,
			'RULE_END' => $rule_end,
			'U_BANNER_EDIT' => append_sid("admin_banner.$phpEx?mode=edit&amp;id=$banner_id"),
			'U_BANNER_DELETE' => append_sid("admin_banner.$phpEx?mode=delete&amp;id=$banner_id"))
		);
	}
}

$template->pparse("body");

include('./page_footer_admin.'.$phpEx);

?>
