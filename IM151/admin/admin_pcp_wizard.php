<?php

/***************************************************************************
 *							admin_pcp_wizard.php
 *							---------------------------
 *	begin				: 07/12/2005
 *	copyright		: Ptirhiik/ednique
 *	email				: ptirhiik@clanmckeen.com/edwin@ednique.com
 *
 *	version				: v 0.6.0 - 07/12/2005
 *
 ***************************************************************************/
/*	
	echo '<pre>';
	print_r($menuactions);
	echo '</pre>'; 
*/
/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

/*
	extra's....
	update phpbb board maps with a title!
	constants.php set GUEST_ONLY to 1000	
*/

define('IN_PHPBB', true);
define('CT_SECLEVEL', 'LOW');
$ct_ignorepvar = array('style_username','style_user_online','style_user_avatar','style_user_from','style_user_regdate','style_user_gender','style_user_age','style_user_posts','style_user_cashpr','style_user_cashtp','style_user_holidays','style_user_country','style_user_warnings','style_user_sig','style_user_photo','style_user_birthday','style_user_pm','style_user_album','style_user_email','style_user_website','style_user_aim','style_user_yim','style_user_msnm','style_user_skype','style_user_icq','style_user_rank_title','style_user_session_time','style_user_session_page','style_user_my_friend','style_user_my_ignore','style_user_posts_stat');
if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['PCP_management']['PCP_10_wizard'] = $file;
	return;
}

$no_page_header=true;

//
// Let's set the root dir for phpBB
//
$phpbb_root_path = "../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

include_once($phpbb_root_path . './includes/functions_admin_pcp.' . $phpEx);
include_once($phpbb_root_path . './includes/bbcode.' . $phpEx);
include_once($phpbb_root_path . './includes/functions_cash.' . $phpEx);

//---------------------------------
//
// functions
//
//---------------------------------
function wizurl($mode,$extra=''){
	global $phpEx;
	
	if($extra){
		return append_sid("admin_pcp_wizard.$phpEx?mode=$mode&$extra", true);
	} else {
		return append_sid("admin_pcp_wizard.$phpEx?mode=$mode", true);
	}
}

function wizredirect($nextmode,$extra=''){
	redirect("/admin/".wizurl($nextmode,$extra), false);
}

function menu(){
	global $lang, $template;
	global $menuactions;
	$template->set_filenames(array(
		'body' => 'admin/pcp_wiz_menu.tpl')
	);
	$template->assign_vars(array(
		'L_TITLE'						=> $lang['PCP_10_wizard'],
		'L_TITLE_EXPLAIN'		=> $lang['PCP_10_wizard_explain'],
		)
	);
	setMessage();
	$color = false;
	foreach ($menuactions as $idx =>$action)
	{
		$color = !$color;
		$template->assign_block_vars('menuitems', array(
			'color'						=> $color ? 'row1' : 'row2',
			'action'					=> '<a href="'.wizurl($action).'">'.$lang['Wiz_'.$action].'</a>',
			'description'			=> $lang['Wiz_'.$action.'_description'],
		));
	}
	$template->pparse('body');
}

function buddylist(){
	global $user_fields, $lang, $template;
	global $wiznav, $nextmode, $posted, $submit_name, $fieldsmode;
	// get the buddies from user_fields
	$buddyfields = array_filter($user_fields,"find_buddy_fields");
	// sort upon ind field...
	$buddyfields = sortfields($buddyfields,'ind');
	$template->set_filenames(array(
		'body' => 'admin/pcp_wiz_buddylist.tpl')
	);
	$template->assign_vars(array(
		'L_TITLE'						=> $wiznav.'&raquo; '.$lang['Wiz_buddylist'],
		'L_TITLE_EXPLAIN'		=> $lang['Wiz_buddylist_description'],
		'L_NAME'						=> $lang['PCP_field_name'],
		'L_DESC'						=> $lang['PCP_field_desc'],
		'L_ORDER'						=> $lang['Order'],
		'L_DEFAULT'					=> $lang['Default'],
		'L_FORCE'						=> $lang['Forced'],
		'L_SELECT'					=> $lang['Selectable'],
		'L_HIDDEN'					=> $lang['Hidden'],
		'L_SUBMIT'					=> $lang['Submit'],
		'SUBMIT_NAME'				=> $submit_name,
		'S_ACTION'					=> wizurl($nextmode),
		'HELP'							=> $lang['Wiz_buddylist_explain'],
		)
	);
	setMessage();
	
	$color = false; // Initialize $color before the loop
	foreach ($buddyfields as $key => $data)
	{
	    $color = !$color;
	    $template->assign_block_vars('fields', array(
	        'COLOR'                     => $color ? 'row1' : 'row2',
	        'name'                      => '<a href="'.wizurl($fieldsmode,'field='.$key).'">'.$key.'</a>',
	        'explain'                   => isset($lang[$data['lang_key']]) ? $lang[$data['lang_key']] : '',
	        'ordername'             => 'ind_'.$key,
	        'ordervalue'            => isset($data['ind']) ? $data['ind'] : '',
	        'optionname'            => 'opt_'.$key,
	        'defaultchecked'    => (isset($data['dft']) && $data['dft']) ? ' checked ' : '',
	        'defaultvalue'      => 'dft',
	        'forcechecked'      => (isset($data['rqd']) && $data['rqd']) ? ' checked ' : '',
	        'forcevalue'            => 'rqd',
	        'selectchecked'     => (!isset($data['rqd']) || !$data['rqd']) && (!isset($data['dft']) || !$data['dft']) && (!isset($data['hidden']) || !$data['hidden']) ? ' checked ' : '',
	        'selectvalue'           => 'sel',
	        'hiddenchecked'     => (isset($data['hidden']) && $data['hidden']) ? ' checked ' : '',
	        'hiddenvalue'           => 'hidden',
	    ));
	}
	$template->pparse('body');
}

function find_buddy_fields($var){
	return !empty($var['ind']) || !empty($var['dft']) || !empty($var['rqd']) || !empty($var['hidden']);
}

function sortfields($array,$sortkey){
	// make a new array to sort on...
	foreach ($array as $key => $data)
	{
		$sort[] = ( isset($data[$sortkey]) ? $data[$sortkey] : '' );
	}
	array_multisort($sort,SORT_ASC,SORT_NUMERIC,$array);
	return $array;
}

function buddyupdate(){
	global $values_list, $tables_linked, $classes_fields, $user_fields;
	global $buddy_map, $nextmode, $posted, $submit_name;
	foreach ($posted as $key => $value)
	{
		$name = substr($key,4);
		$field = substr($key,0,3);
		if ($field == 'ind'){
			$user_fields[$name][$field] = $value;
		} else if ($field == 'opt'){
			// when opt, value is dft or rqd or sel :: a field cannot have and dft and rqd :: so delete other keys :: when sel then all options should be deleted
			switch ($value){
				case 'dft':
					$user_fields[$name]['dft'] = 1;
					unset($user_fields[$name]['rqd'],$user_fields[$name]['hidden']);
					break;
				case 'rqd':
					$user_fields[$name]['rqd'] = 1;
					unset($user_fields[$name]['dft']);
					if (array_key_exists('hidden', $user_fields[$name]))
					{
						unset($user_fields[$name]['hidden']);
					}
					break;
				case 'hidden':
					$user_fields[$name]['hidden'] = 1;
					// also unset the ind... not allowed when hidden
					unset($user_fields[$name]['rqd'],$user_fields[$name]['dft'],$user_fields[$name]['ind']);
					break;
				case 'sel':
					unset($user_fields[$name]['rqd'],$user_fields[$name]['dft'],$user_fields[$name]['hidden']);
					break;
			}
		}
	}
	// the ind should be 1,2,3,4,... and not 10,20,30... so sort and renumber!
	$buddyfields = array_filter($user_fields,"find_buddy_fields");
	$buddyfields = sortfields($buddyfields,'ind');
	// correct the ind inuser_fields...
	setBuddyInd($buddyfields);
	// write the file :: send null as user_maps ==> actually not used inside the function!
	pcp_output_fields($values_list, $tables_linked, $classes_fields, NULL, $user_fields);
	// correct the order in the maps...
	reorder_mapfields($buddyfields,$buddy_map);
	// reset the use_list_option :: when altering the order this user value is incorrect 
	update_user_list_option();
	wizredirect($nextmode,$submit_name.'='.$submit_name);
}

function update_user_list_option(){
	global $db;
	$sql = "UPDATE " . USERS_TABLE . " 
				SET user_list_option = NULL";
	if ( !$result = $db->sql_query($sql) ){
		message_die(GENERAL_ERROR, 'Could not update user options.', '', __LINE__, __FILE__, $sql);
	}
}

function setBuddyInd($buddyfields){
	global $user_fields;
	$ind = 1;
	foreach ($buddyfields as $key => $data)
	{
		// only ind when not hidden!
		if(!empty($data['hidden'])){
			unset($user_fields[$key]['ind']);
		} else {
			$user_fields[$key]['ind'] = $ind;
			$ind++;
		}
	}
	// delete all buddy keys if not in sorted anymore...
	$userfields = array_filter($user_fields,"find_buddy_fields");
	foreach ($userfields as $key => $data)
	{
		if(!is_array($buddyfields[$key])){
			unset($user_fields[$key]['rqd'],$user_fields[$key]['dft'],$user_fields[$key]['hidden'],$user_fields[$key]['ind']);
		}
	}
}

function reorder_mapfields($sorted,$map){
	global $user_maps;
	$oldfields = $user_maps[$map]['fields'];
	// copy the old field values into the new sorted array
	foreach ($sorted as $fieldname => $data)
	{
		if(isset($oldfields[$fieldname])){
			$newfields[$fieldname] = $oldfields[$fieldname];
		} else {
			$newfields[$fieldname] = array();
		}
	}
	// overwrite the map with new sorted fields
	$user_maps[$map]['fields'] = $newfields;
	// write the def_usermaps
	pcp_output_maps($user_maps);
}

function is_input_map($var){
	global $user_maps;
	global $profil_map, $register_map;
	if (substr($var,0,strlen($profil_map)) == $profil_map || substr($var,0,strlen($register_map)) == $register_map){
		if (!empty($user_maps[$var]['fields'])){
			return 1;
		}
	}
	return 0;
}

function is_output_map($var){
	global $user_maps;
	global $profil_map, $register_map, $ignore_map_string;
	// remove ignore
	if (substr($var,0,strlen($profil_map)) != $profil_map && substr($var,0,strlen($register_map)) != $register_map && substr($var,-strlen($ignore_map_string)) != $ignore_map_string){
		if (!empty($user_maps[$var]['fields']) && count_safe($user_maps[$var]['fields']))
		{
			return 1;
		}
	}
	return 0;
}

function get_input_maps()
{
	global $user_maps;
	global $input_maps;
	if(!count($input_maps))
	{
		$input_maps = rebuild_array(array_filter(array_keys($user_maps),"is_input_map"));
	}
}

function get_output_maps(){
	global $user_maps;
	global $output_maps;
	if (!is_array($user_maps) || empty($user_maps)) 
	{
	    $user_maps = [];
	}
	 
	if (empty($output_maps)) 
	{
	    $output_maps = rebuild_array(array_filter(array_keys($user_maps), "is_output_map"));
	}
}

function rebuild_array($array){
    // filtered arrays don't have [1],[2],... but [21],[55],...
    $new = array(); // Initialize $new as an empty array
    foreach ($array as $value)
    {
        $new[] = $value;
    }
    return $new;
}

function get_all_maps(){
	global $output_maps, $input_maps, $all_maps;
	get_input_maps();
	get_output_maps();
	if(!count($all_maps)){
		$all_maps = array_merge($input_maps,$output_maps);
	}
}

function build_map_options($type,$selected){
	global $output_maps, $input_maps, $all_maps;
	// type 1 = input; 2 = output; 3 = all
	switch ($type){
		case 1:
			get_input_maps();
			$themaps = $input_maps;
			break;
		case 2:
			get_output_maps();
			$themaps = $output_maps;
			break;
		case 3:
			get_all_maps();
			$themaps = $all_maps;
			break;
	}
	$options = '';
	foreach ($themaps as $idx =>$map)
	{
		if($map == $selected){
			$extra = "selected";
		} else $extra = "";
		$options .= '<option value="'.$map.'" '.$extra.'>'.get_map_title($map).'</option>';
	}
	return $options; 
}

function get_map_title($map,$type=1){
	global $user_maps, $lang;
	$mapitems = explode(".",$map);
	$tmpname = "";
	$tmptitle = "";
	$title = "";
	$newtitle = "";
	$level = 0;
	$iLevel = 0;
	// loop trough the map and fetch all languages
	for($imap=0; $imap < count($mapitems); $imap++){
		$extra = "";
		$tmpname = ($tmpname) ? $tmpname.'.'.$mapitems[$imap] : $mapitems[$imap];
		$tmptitle = isset($user_maps[$tmpname]['title']) && !is_array($user_maps[$tmpname]['title']) && array_key_exists($user_maps[$tmpname]['title'], $lang) ? $lang[$user_maps[$tmpname]['title']] : '';
		if($tmptitle){
			$newtitle = $tmptitle;
		} else if (is_array($user_maps[$tmpname]['title'])){
			// just use the map key to use as text :: array titlezs are too complex
			$newtitle = $mapitems[$imap];
		} else if ($user_maps[$tmpname]['title']){
			// has a title but not in language
			$newtitle = $user_maps[$tmpname]['title'];
		}
		switch ($type){
			case 2:
				if ($level == 3){
					$title .= '<br />';
					$level = 0;
				}
				$level++;
				$title = ($title) ? $title.' &raquo; '.$newtitle : $newtitle;
				break;
			default:
				$title = ($title) ? $title.' &raquo; '.$newtitle : $newtitle;
				break;
		}
	}
	return $title;
}

function build_field_options($map){
    global $user_maps;
    $fields = array_keys(isset($user_maps[$map]['fields']) ? $user_maps[$map]['fields'] : array());
    $options = '';
    // do not sort... keep the order... sort($fields);
    foreach ($fields as $idx =>$fieldname)
    {
        $options .= '<option value="'.$fieldname.'">'.$fieldname.'</option>';
    }
    return $options; 
}
 
function is_not_in_filtermap($var){
    global $user_maps;
    global $filtermap;
    // find all fields that are NOT in a particulary map
    if(isset($user_maps[$filtermap]['fields'][$var]) && is_array($user_maps[$filtermap]['fields'][$var])){
        return 0;
    } else return 1;
}
 
function is_in_filtermap($var){
    global $user_maps;
    global $filtermap;
    // find all fields that are NOT in a particulary map
    if(isset($user_maps[$filtermap]['fields'][$var]) && is_array($user_maps[$filtermap]['fields'][$var])){
        return 1;
    } else return 0;
}
 
function build_allfields_options($excludemap='',$selected=''){
    global $user_fields, $filtermap;
    if(strlen($excludemap)){
        // only fields not in current selected map
        $filtermap = $excludemap; // to be able to grab it in the filterfunction!
        $fields = array_filter(array_keys($user_fields),"is_not_in_filtermap");
    } else {
        $fields = array_keys($user_fields);
    }
    $options = '';
    sort($fields); // sort for easy finding
    foreach ($fields as $idx =>$fieldname)
    {
        if($fieldname == $selected){
            $extra = "selected";
        } else $extra = "";
        $options .= '<option value="'.$fieldname.'" '.$extra.'>'.$fieldname.'</option>';
    }
    return $options; 
}
 
function addremovefields(){
    global $lang, $template;
    global $wiznav, $nextmode, $posted, $all_maps, $helpmode, $demouserdata, $select_name, $submit_name, $goto_name;
    if(!isset($posted['map']) || !$posted['map']){
        // set default map
        get_all_maps();
        $posted['map'] = isset($all_maps[0]) ? $all_maps[0] : '';
    }
    $template->set_filenames(array(
        'body' => 'admin/pcp_wiz_addremovefields.tpl')
    );
    $template->assign_vars(array(
        'L_TITLE'                       => $wiznav.'&raquo; '.(isset($lang['Wiz_addremovefields']) ? $lang['Wiz_addremovefields'] : ''),
        'L_TITLE_EXPLAIN'       => isset($lang['Wiz_addremovefields_description']) ? $lang['Wiz_addremovefields_description'] : '',
        'L_SELECT_MAP'          => isset($lang['Select_page']) ? $lang['Select_page'] : '',
        'MAPSELECT_NAME'        => 'map',
        'MAPOPTIONS'                => build_map_options(3,$posted['map']),
        'HIDDEN_FIELDS'         => '<input type="hidden" name="orig_map" value="'.$posted['map'].'">',
        'L_SELECT'                  => isset($lang['Select']) ? $lang['Select'] : '',
        'SELECT_NAME'               => $select_name,
        'L_GOTO'                        => is_input_map($posted['map']) ? (isset($lang['Wiz_inputlist']) ? $lang['Wiz_inputlist'] : '') : (isset($lang['Wiz_outputlist']) ? $lang['Wiz_outputlist'] : ''),
        'GOTO_NAME'                 => $goto_name,
        'L_AVAILABLE'               => isset($lang['Available_fields']) ? $lang['Available_fields'] : '',
        'L_ACTION'                  => isset($lang['Action']) ? $lang['Action'] : '',
        'L_SELECTED'                => isset($lang['Selected_fields']) ? $lang['Selected_fields'] : '',
        'AVAILABLENAME'         => 'fields',
        'AVAILABLEOPTIONS'  => build_allfields_options($posted['map']),
        'SELECTEDNAME'          => 'selected[]',
        'SELECTEDOPTIONS'       => build_field_options($posted['map']),
        'L_MOVE_UP'                 => isset($lang['Move_up']) ? $lang['Move_up'] : '',
        'L_MOVE_DOWN'               => isset($lang['Move_down']) ? $lang['Move_down'] : '',
        'S_ACTION'                  => wizurl($nextmode),
        'HELP'                          => isset($lang['Wiz_addremovefields_explain']) ? $lang['Wiz_addremovefields_explain'] : '',
        'S_HELP'                        => wizurl($helpmode),
        'L_SUBMIT'                  => isset($lang['Submit']) ? $lang['Submit'] : '',
        'SUBMIT_NAME'               => $submit_name,
        'CONFIRM_MESSAGE'       => isset($lang['Confirm_message']) ? $lang['Confirm_message'] : '',
        )
    );
    setMessage();
    $template->pparse('body');
}
 
function addremovefieldsupdate($buddy){
    global $values_list, $tables_linked, $classes_fields, $user_fields, $user_maps;
    global $nextmode, $posted;
    // correct the map...
    $posted['map'] = isset($posted['orig_map']) ? $posted['orig_map'] : '';
    // fix the fields so thay are more like in the maps...
    $sorted = array();
    if (isset($posted['selected']) && is_array($posted['selected'])) {
        foreach ($posted['selected'] as $idx => $fieldname)
        {
            $sorted[$fieldname] = array();
        }
    }
    if($buddy){
        // set old user_fields value, set ind and rewrite fields
        $buddyfields = array_filter($user_fields,"find_buddy_fields");
        // make tmp var for user fields... sorted needs to go to the maps!
        $tmp = $sorted;
        foreach ($buddyfields as $key => $data)
        {
            if(isset($tmp[$key]) && is_array($tmp[$key])) $tmp[$key] = $data;
        }
        // corret with new ind marker and remove removed fields
        setBuddyInd($tmp);
        // write the def_userfields file
        pcp_output_fields($values_list, $tables_linked, $classes_fields, NULL, $user_fields);
        // when buddy is changed user_list_option should be nulled
        update_user_list_option();
    }
    // write the new map
    reorder_mapfields($sorted,$posted['map']);
    if(is_input_map($posted['map'])){
        // correct required fields
        correctrequired();
        // write the file
        pcp_output_fields($values_list, $tables_linked, $classes_fields, NULL, $user_fields);
    }
    wizredirect($nextmode,'map='.$posted['map']);
}
 
function showfieldinfo(){
    global $user_fields, $lang, $template;
    global $posted, $wiznav, $ignore_map_string, $demouserdata, $nextinputmode, $nextoutputmode, $fieldsmode;
    $langkey = isset($user_fields[$posted['field']]['lang_key']) ? $user_fields[$posted['field']]['lang_key'] : '';
    $fieldmaps = get_all_maps_for_field($posted['field']);
    set_demouserdata();
    $template->set_filenames(array(
        'body' => 'admin/pcp_wiz_showfieldinfo.tpl')
    );
    $template->assign_vars(array(
        'L_TITLE'                       => $wiznav.'&raquo; '.(isset($lang['Wiz_showfieldinfo']) ? $lang['Wiz_showfieldinfo'] : ''),
        'L_TITLE_EXPLAIN'       => isset($lang['Wiz_showfieldinfo_description']) ? $lang['Wiz_showfieldinfo_description'] : '',
        'HELP'                          => isset($lang['Wiz_showfieldinfo_explain']) ? $lang['Wiz_showfieldinfo_explain'] : '',
        'L_FIELDNAME'               => isset($lang['PCP_field_name']) ? $lang['PCP_field_name'] : '',
        'FIELDNAME'                 => '<a href="'.wizurl($fieldsmode,'field='.$posted['field']).'">'.$posted['field'].'</a>',
        'L_DESCRIPTION'         => isset($lang['PCP_field_desc']) ? $lang['PCP_field_desc'] : '',
        'DESCRIPTION'               => ( isset($lang[$langkey]) ? $lang[$langkey] : '' ),
        'L_PAGES'                       => isset($lang['Pages']) ? $lang['Pages'] : '',
        //'PAGES'                           => $pages,
        )
    );
    foreach ($fieldmaps as $idx => $map)
    {
        // do not use the ignore...
        if(substr($map,-strlen($ignore_map_string)) != $ignore_map_string){
            if(is_input_map($map)){ 
                $template->set_filenames(array(
                    'input' => 'admin/pcp_wiz_inputexample.tpl')
                );
                $inputstyle = preview_input_field($user_fields[$posted['field']],$posted['field']);
                $template->assign_var_from_handle('example', 'input');
                $example = isset($template->vars['example']) ? $template->vars['example'] : '';
                $nextmode = $nextinputmode;
            } else {
                $example = pcp_output($posted['field'], $demouserdata, $map);
                $example = '<table>'.$example.'</table>'; // put it in a table to ensure the display is correct!
                $nextmode = $nextoutputmode;
            }
            $example = correctimages($example);
            $page = '<a href="'.wizurl($nextmode,"map=$map").'">'.get_map_title($map,2).'</a>'; 
            $template->assign_block_vars('fieldinpages', array(
                'page'                      => $page,
                'example'                   => $example,)
            );
        }
    }
    $template->pparse('body');
}
function correctimages($text){
	$text = str_replace('src="','src="../', $text); 
	$text = str_replace("src = '","src='../", $text); 
	return $text;
}

function set_demouserdata(){
	global $demouserdata;
	// make sure all fields are filled so that examples work
	if(!count($demouserdata)){
		global $userdata;
		$demouserdata = $userdata;
		preProcessUserConfig($demouserdata); // used for pcp_output!
		foreach ($demouserdata as $key =>$value)
		{
			if($value == ''){
				$demouserdata[$key] = $key;
			}
		}
	}
}

function get_all_maps_for_field($field){
	global $user_maps;
	global $filtermap;
	$fieldmaps = [];
	foreach ($user_maps as $map => $data)
	{
		$filtermap = $map;
		if(is_in_filtermap($field)){
			$fieldmaps[] = $map;
		}
	}
	return $fieldmaps;	
}

function preview_input_field($field, $user_field){
	global $demouserdata;
	global $template, $board_config, $classes_fields, $lang, $values_list;
	$input = '';
	if (isset($field['values']) && $field['values'])
	{
	    $fieldvaluelist = $field['values'];
	    $field['values'] = array();
	    if (isset($values_list[$fieldvaluelist]['values']) && is_array($values_list[$fieldvaluelist]['values']))
	    {
	        foreach ($values_list[$fieldvaluelist]['values'] as $key => $data)
	        {
	            if (isset($data['txt']))
	            {
	                $field['values'][$data['txt']] = $key;
	            }
	        }
	    }
	}
	if(!isset($field['get_mode']) && !isset($field['get_func']))
	{
	    $field['get_mode'] = isset($field['type']) ? $field['type'] : '';
	}
	switch (isset($field['get_mode']) ? $field['get_mode'] : null)
	{
		case 'LIST_RADIO':
			foreach ($field['values'] as $key => $val)
			{
				$selected = (isset($demouserdata[$user_field]) && $demouserdata[$user_field] == $val) ? ' checked="checked"' : '';
				$l_key = mods_settings_get_lang($key);
				$input .= '<input type="radio" name="' . $user_field . '" value="' . $val . '"' . $selected . ' />' . $l_key . '&nbsp;&nbsp;';
			}
			break;
		case 'LIST_DROP':
			foreach ($field['values'] as $key => $val)
			{
				$selected = ($demouserdata[$user_field] == $val) ? ' selected="selected"' : '';
				$l_key = mods_settings_get_lang($key);
				$input .= '<option value="' . $val . '"' . $selected . '>' . $l_key . '</option>';
			}
			$input = '<select name="' . $user_field . '">' . $input . '</select>';
			break;
		case 'TINYINT':
			$input = '<input type="text" name="' . $user_field . '" maxlength="3" size="2" class="post" value="' . $demouserdata[$user_field] . '" />';
			break;
		case 'SMALLINT':
			$input = '<input type="text" name="' . $user_field . '" maxlength="5" size="5" class="post" value="' . $demouserdata[$user_field] . '" />';
			break;
		case 'MEDIUMINT':
			$input = '<input type="text" name="' . $user_field . '" maxlength="8" size="8" class="post" value="' . $demouserdata[$user_field] . '" />';
			break;
		case 'INT':
			$input = '<input type="text" name="' . $user_field . '" maxlength="13" size="11" class="post" value="' . $demouserdata[$user_field] . '" />';
			break;
		case 'VARCHAR':
		case 'HTMLVARCHAR':
			$input = '<input type="text" name="' . $user_field . '" maxlength="255" size="45" class="post" value="' . $demouserdata[$user_field] . '" />';
			break;
		case 'TEXT':
		case 'HTMLTEXT':
			$input = '<textarea rows="5" cols="45" wrap="virtual" name="' . $user_field . '" class="post">' . $demouserdata[$user_field] . '</textarea>';
			break;
		default:
	        $input = '';
	        if ( !empty($field['get_func']) && function_exists($field['get_func']) )
	        {
	            $input = $field['get_func']($user_field, isset($demouserdata[$user_field]) ? $demouserdata[$user_field] : null);
	        }
			break;
	}
	// show who can see the info depending on class
	if (!empty($field['visibility'])){
		if ($field['class'] != 'generic')
		{
			$see_field = isset($classes_fields[$field['class']]['user_field']) ? $classes_fields[$field['class']]['user_field'] : null;
			if(array_key_exists($see_field.'_over', $board_config) && $board_config[$see_field.'_over'])
			{
				$viewed_by = $board_config[$see_field];
			} 
			else 
			{
				$viewed_by = isset($demouserdata[$see_field]) ? $demouserdata[$see_field] : '';
			}
		} 
		else 
		{
			$viewed_by = YES;
		}
		switch ($viewed_by) {
			case FRIEND_ONLY:
				if ($user_field == 'user_email' && $board_config['board_email_form']){
					// special case for email via board... 
					$viewed = $lang['Visible_board_email_friends'];
				} else {
					$viewed = $lang['Visible_friends'];
				}
				break;
			case YES:
				if ($user_field == 'user_email' && $board_config['board_email_form']){
					// special case for email via board... 
					$viewed = $lang['Visible_board_email_all'];
				} else {
					$viewed = $lang['Visible_all'];
				}
				break;
			case NO:
				$viewed = $lang['Visible_admin'];
				break;
			default:
				$viewed = $lang['Visible_admin'];
				break;
		}
	} else {
		// system field :: no display
		$viewed = '';
	}
	// dump to template
	$inputstyle = 'field';
	if(!empty($field['inputstyle'])){
		$inputstyle = $field['inputstyle'];
	}
	$template->assign_block_vars($inputstyle, array(
		'L_NAME'	=> mods_settings_get_lang($field['lang_key']),
		'L_EXPLAIN'	=> (!empty($field['explain']) ? '<br />' . mods_settings_get_lang($field['explain']) : '').$viewed,
		'INPUT'		=> $input.(!empty($field['required']) ? $lang['Required_field'] : ''),
		)
	);
	return $inputstyle;
}

function is_output_function($var){
	global $outputfunction, $outputfunctignore;
	foreach ($outputfunction as $idx =>$funct)
	{
		if (substr($var,0,strlen($funct)) == $funct && !in_array($var, $outputfunctignore)) return 1;	
	}
	return 0;
}

function build_dspfunct_options($selected=''){
	global $lang;
	$arrFuncs = get_defined_functions();
	$arrFuncs = array_filter($arrFuncs['user'],"is_output_function");
	$options = '<option value="">'.$lang['Default_Output'] .'</option>';
	sort($arrFuncs); // sort for easy finding
	foreach ($arrFuncs as $idx =>$funct)
	{
		$options .= '<option value="'.$funct.'"'.((strtolower($selected) == $funct)?'selected':'').'>'.$funct.'</option>';
	}
	return $options; 
}

function build_classes_options($selected=''){
	global $classes_fields, $user_fields, $lang;
	$arrClass = array();
	foreach ($classes_fields as $class =>$data)
	{
		if (strlen($data['user_field'])){
			$arrClass[$class]['classtext'] = $lang[$user_fields[$data['user_field']]['lang_key']];
		} else {
			$options = '<option value="'.$class.'">'.$lang['Always_display'].'</option>';
		}
	}
	$arrClass = sortfields($arrClass,'classtext');
	foreach ($arrClass as $class =>$data)
	{
		$options .= '<option value="'.$class.'"'.(($selected == $class)?'selected':'').'>'.$data['classtext'].'</option>';
	}
	return $options; 
}

function setMessage(){
	global $lang, $template, $user_fields;
	global $posted;
	$text = '';
	switch (isset($posted['message']) ? $posted['message'] : -1){
		case 1:
			if(!empty($posted['map'])){
				$text = sprintf($lang['Map_selected'],get_map_title($posted['map']));
			} elseif(!empty($posted['new'])){
				$text = sprintf($lang['Newfield_selected'],$posted['newfield']);
			} elseif(!empty($posted['field'])){
				$text = sprintf($lang['Field_selected'],$lang[$user_fields[$posted['field']]['lang_key']]);
			} 
			break;
		case 2:
			$text = $lang['Update_success'];
			break;
		case 3:
			$text = '';
			foreach ($posted['bad_permissions'] as $idx =>$filename)
			{
				$text .= ($text == '')? '':'<br />';
				$text .= sprintf($lang['File_permissions'],$filename);
			}
			break;
		case 4:
			$text = sprintf($lang['File_deleted'],$posted['file']);
			break;
		case 5:
			$text = sprintf($lang['File_restored'],$posted['file']);
			break;
		case 6:
			$text = sprintf($lang['Backups_created'],$posted['file']);
			break;
	}
	if(strlen(trim($text))){
		$template->assign_block_vars('message', array(
			'text'						=> $text,
		));
	}
}

function outputlist(){
	global $user_maps, $user_fields, $lang, $template;
	global $output_maps, $wiznav, $nextmode, $posted, $demouserdata, $select_name, $submit_name, $goto_name, $fieldsmode;
	if(!isset($posted['map']) || empty($posted['map']))
	{
	    // set default map
	    get_output_maps();
	    $posted['map'] = $output_maps[0] ?? null;
	}
	set_demouserdata();
	$template->set_filenames(array(
		'body' => 'admin/pcp_wiz_outputlist.tpl')
	);
	$template->assign_vars(array(
		'L_TITLE'						=> $wiznav.'&raquo; '.$lang['Wiz_outputlist'],
		'L_TITLE_EXPLAIN'		=> $lang['Wiz_outputlist_description'],
		'L_SELECT_MAP'			=> $lang['Select_page'],
		'MAPSELECT_NAME'		=> 'map',
		'MAPOPTIONS'				=> build_map_options(2,$posted['map']),
		'HIDDEN_FIELDS'			=> '<input type="hidden" name="orig_map" value="'.$posted['map'].'">',
		'L_SELECT'					=> $lang['Select'],
		'SELECT_NAME'				=> $select_name,
		'L_GOTO'						=> $lang['Wiz_addremovefields'],
		'GOTO_NAME'					=> $goto_name,
		'L_FIELD'						=> $lang['PCP_field_name_short'],
		'L_LEGEND'					=> $lang['PCP_field_leg_short'],
		'L_TEXT'						=> $lang['PCP_field_txt_short'],
		'L_IMAGE'						=> $lang['PCP_field_img_short'],
		'L_NEXTLINE'				=> $lang['Nextline'],
		'L_HTML'						=> $lang['Html_style'],
		'L_DSPFUNCT'				=> $lang['PCP_field_dsp_func'],
		'L_DISPLAY'					=> $lang['Display_when'],
		'L_EXTRA'						=> $lang['Extra'],
		'L_EXAMPLE'					=> $lang['Example'],
		'S_ACTION'					=> wizurl($nextmode),
		'HELP'							=> $lang['Wiz_outputlist_explain'],
		'L_SUBMIT'					=> $lang['Submit'],
		'SUBMIT_NAME'				=> $submit_name,
		'CONFIRM_MESSAGE'		=> $lang['Confirm_message'],
		)
	);
	setMessage();
    $map = isset($user_maps[$posted['map']]['fields']) ? $user_maps[$posted['map']]['fields'] : null;
	$color = true;
	foreach ((is_array($map) || is_object($map) ? $map : array()) as $fieldname => $data)
	{
	    if(!empty($data['dsp_func']))
	    {
	        $dspfunct = $data['dsp_func'];
	    } 
	    else 
	    {
	        $dspfunct = isset($user_fields[$fieldname]['dsp_func']) ? $user_fields[$fieldname]['dsp_func'] : '';
	    }
	    $example = pcp_output($fieldname, $demouserdata, $posted['map']);
	    $example = correctimages($example);
	    $example = '<table>'.$example.'</table>'; // put it in a table to ensure the display is correct!
	    $color = !isset($color) ? true : !$color;
	    $template->assign_block_vars('fields', array(
	        'COLOR'             => $color ? 'row1' : 'row2',
	        'name'              => '<a href="'.wizurl($fieldsmode,'field='.$fieldname).'" onclick="return selectMap();">'.$fieldname.'</a>',
	        'explain'           => isset($user_fields[$fieldname]['lang_key']) && isset($lang[$user_fields[$fieldname]['lang_key']]) ? $lang[$user_fields[$fieldname]['lang_key']] : '',
	        'legendname'        => 'leg_'.$fieldname,
	        'legendchecked'     => !empty($data['leg']) ? 'checked' : '',
	        'textname'          => 'txt_'.$fieldname,
	        'textchecked'       => !empty($data['txt']) ? 'checked' : '',
	        'imagename'         => 'img_'.$fieldname,
	        'imagechecked'      => !empty($data['img']) ? 'checked' : '',
	        'nextlinename'      => 'crlf_'.$fieldname,
	        'nextlinechecked'   => !empty($data['crlf']) ? 'checked' : '',
	        'spanname'          => 'style_'.$fieldname,
	        'spanvalue'         => isset($data['style']) ? $data['style'] : '',
	        'dspfunctname'      => 'dsp_func_'.$fieldname,
	        'dspfunctoptions'   => build_dspfunct_options($dspfunct),
	        'displayname'       => 'class_'.$fieldname,
	        'displayoptions'    => build_classes_options(isset($user_fields[$fieldname]['class']) ? $user_fields[$fieldname]['class'] : ''),
	        'example'           => $example,
	    ));
	}
	$template->pparse('body');
}

function outputlistupdate(){
	global $user_maps, $user_fields, $values_list, $tables_linked, $classes_fields;
	global $posted, $field, $nextmode, $submit_name, $usermapdata;
	$keysupdated = array('dsp_func','leg','txt','img','crlf','style');
	$keynotupdated = rebuild_array(array_diff($usermapdata,$keysupdated));
	// CAUTION :: set orig_map to map...
	$posted['map'] = $posted['orig_map'];
	// get original fields...
	$fields = isset($user_maps[$posted['map']]['fields']) ? array_keys($user_maps[$posted['map']]['fields']) : array();
	foreach ($fields as $idx =>$field)
	{
		// keep old values
		$oldfield = $user_maps[$posted['map']]['fields'][$field];
		// destroy the field
		$user_maps[$posted['map']]['fields'][$field] = array(); 
		// reset old value
	    for ($i = 0; $i < count($keynotupdated); $i++) {
	        $key = $keynotupdated[$i];
	        if (isset($oldfield[$key]) && strlen($oldfield[$key])) {
	            $user_maps[$posted['map']]['fields'][$field][$key] = $oldfield[$key];
	        }
	    }
		$fieldparams = rebuild_array(array_filter(array_keys($posted),"is_param_of_field"));
		foreach ($fieldparams as $x =>$paramname)
		{
			$paramname = substr($paramname,0,-strlen($field)-1);
			$value = $posted[$paramname.'_'.$field];
			if(strlen($value)){
				switch ($paramname) {
					case 'dsp_func':
						if ($value != $user_fields[$field][$paramname]){
							// to map if not same as in fields ... 
							$user_maps[$posted['map']]['fields'][$field][$paramname] = $value;
						}
						break;
					case 'class':
						// add to fields
						$user_fields[$field][$paramname] = $value;
						break;
					default:
						// add to map
						$user_maps[$posted['map']]['fields'][$field][$paramname] = $value;
						break;
				}
			}
		}
	}
	// write the def_userfields 
	pcp_output_fields($values_list, $tables_linked, $classes_fields, $posted['map'], $user_fields);
	// write the def_usermaps
	pcp_output_maps($user_maps);
	wizredirect($nextmode,'map='.$posted['map'].'&'.$submit_name.'='.$submit_name);
}

function is_param_of_field($var){
	global $field;
	if(strlen($field) != strlen($var) && substr($var,-strlen($field)) == $field){
		return 1;
	} else return 0;
}

function inputlist(){
	global $user_maps, $user_fields, $lang, $template;
	global $input_maps, $wiznav, $nextmode, $posted, $demouserdata, $select_name, $submit_name, $goto_name, $fieldsmode;
	if(!isset($posted['map']) || empty($posted['map']))
	{
	    // set default map
	    get_input_maps();
	    $posted['map'] = isset($input_maps[0]) ? $input_maps[0] : '';
	}
	set_demouserdata();
	$template->set_filenames(array(
		'body' => 'admin/pcp_wiz_inputlist.tpl')
	);
	$template->assign_vars(array(
		'L_TITLE'               => $wiznav.'&raquo; '.(isset($lang['Wiz_inputlist']) ? $lang['Wiz_inputlist'] : ''),
		'L_TITLE_EXPLAIN'       => isset($lang['Wiz_inputlist_description']) ? $lang['Wiz_inputlist_description'] : '',
		'L_SELECT_MAP'          => isset($lang['Select_page']) ? $lang['Select_page'] : '',
		'MAPSELECT_NAME'        => 'map',
		'MAPOPTIONS'            => build_map_options(1, isset($posted['map']) ? $posted['map'] : ''),
		'HIDDEN_FIELDS'         => '<input type="hidden" name="orig_map" value="'.(isset($posted['map']) ? $posted['map'] : '').'">',
		'L_SELECT'              => isset($lang['Select']) ? $lang['Select'] : '',
		'SELECT_NAME'           => isset($select_name) ? $select_name : '',
		'L_GOTO'                => isset($lang['Wiz_addremovefields']) ? $lang['Wiz_addremovefields'] : '',
		'GOTO_NAME'             => isset($goto_name) ? $goto_name : '',
		'L_FIELD'               => isset($lang['PCP_field_name_short']) ? $lang['PCP_field_name_short'] : '',
		'L_TYPE'                => isset($lang['PCP_field_type']) ? $lang['PCP_field_type'] : '',
		'L_EXTRA'               => isset($lang['Extra']) ? $lang['Extra'] : '',
		'L_STYLE'               => isset($lang['Tpl_style']) ? $lang['Tpl_style'] : '',
		'L_AUTH'                => isset($lang['PCP_field_auth']) ? $lang['PCP_field_auth'] : '',
		'L_EXAMPLE'             => isset($lang['Example']) ? $lang['Example'] : '',
		'S_ACTION'              => wizurl(isset($nextmode) ? $nextmode : ''),
		'HELP'                  => isset($lang['Wiz_inputlist_explain']) ? $lang['Wiz_inputlist_explain'] : '',
		'L_SUBMIT'              => isset($lang['Submit']) ? $lang['Submit'] : '',
		'SUBMIT_NAME'           => isset($submit_name) ? $submit_name : '',
		'CONFIRM_MESSAGE'       => isset($lang['Confirm_message']) ? $lang['Confirm_message'] : '',
		'L_REQUIRED'            => isset($lang['PCP_field_required']) ? $lang['PCP_field_required'] : '',
		'L_VISIBILITY'          => isset($lang['PCP_field_visibility']) ? $lang['PCP_field_visibility'] : '',
		'L_GETFUNCT'            => isset($lang['PCP_field_get_func']) ? $lang['PCP_field_get_func'] : '',
		'L_CHECKFUNCT'          => isset($lang['PCP_field_chk_func']) ? $lang['PCP_field_chk_func'] : '',
		'L_VALUES'              => isset($lang['PCP_field_values_list']) ? $lang['PCP_field_values_list'] : '',
		)
	);
	setMessage();
	$map = $user_maps[$posted['map']]['fields'];
	$template->set_filenames(array(
		'input' => 'admin/pcp_wiz_inputexample.tpl'
		));
		
	$color = false;
	foreach ($map as $fieldname =>$data)
	{
		$inputstyle = preview_input_field($user_fields[$fieldname],$fieldname);
		$template->assign_var_from_handle('example', 'input');
		$color = !$color;
		// only get_mode when its different then type!
		if (isset($user_fields[$fieldname]) && isset($user_fields[$fieldname]['get_mode']) && $user_fields[$fieldname]['get_mode'])
		{
			$getmode = $user_fields[$fieldname]['get_mode'];
		} 
		elseif (!empty($user_fields[$fieldname]['get_func']) || !empty($user_fields[$fieldname]['chk_func']))
		{
			$getmode = 'funct';    
		} 
		else 
		{
			$getmode = '';
		}
	    $template->assign_block_vars('fields', array(
	        'COLOR'             => $color ? 'row1' : 'row2',
	        'namelink'          => '<a href="'.wizurl($fieldsmode,'field='.$fieldname).'" onclick="return selectMap();">'.$fieldname.'</a>',
	        'name'              => $fieldname,
	        'explain'           => isset($lang[$user_fields[$fieldname]['lang_key']]) ? $lang[$user_fields[$fieldname]['lang_key']] : '',
	        'requiredname'      => 'required_'.$fieldname,
	        'requiredchecked'   => (isset($user_fields[$fieldname]['required']) && $user_fields[$fieldname]['required']) ? 'checked' : '',
	        'visibilityname'    => 'visibility_'.$fieldname,
	        'visibilitychecked' => (isset($user_fields[$fieldname]['visibility']) && $user_fields[$fieldname]['visibility']) ? 'checked' : '',
	        'get_modename'      => 'get_mode_'.$fieldname,
	        'textmodechecked'   => ($getmode == '') ? 'checked' : '',
	        'textmodevalue'     => 'TEXT',
	        'L_TEXTMODE'        => isset($lang['Textmode']) ? $lang['Textmode'] : '',
	        'dropmodechecked'   => ($getmode == 'LIST_DROP') ? 'checked' : '',
	        'dropmodevalue'     => 'LIST_DROP',
	        'L_DROPMODE'        => isset($lang['Dropmode']) ? $lang['Dropmode'] : '',
	        'radiomodechecked'  => ($getmode == 'LIST_RADIO') ? 'checked' : '',
	        'radiomodevalue'    => 'LIST_RADIO',
	        'L_RADIOMODE'       => isset($lang['Radiomode']) ? $lang['Radiomode'] : '',
	        'functmodechecked'  => ($getmode == 'funct') ? 'checked' : '',
	        'functmodevalue'    => 'FUNCT',
	        'L_FUNCTMODE'       => isset($lang['Functmode']) ? $lang['Functmode'] : '',
	        'getfuncname'       => 'get_func_'.$fieldname,
	        'getfuncoptions'    => build_getfunct_options(isset($user_fields[$fieldname]['get_func']) ? $user_fields[$fieldname]['get_func'] : ''),
	        'chkfuncname'       => 'chk_func_'.$fieldname,
	        'chkfuncoptions'    => build_chkfunct_options(isset($user_fields[$fieldname]['chk_func']) ? $user_fields[$fieldname]['chk_func'] : ''),
	        'valuesname'        => 'values_'.$fieldname,
	        'valuesoptions'     => build_values_options(isset($user_fields[$fieldname]['values']) ? $user_fields[$fieldname]['values'] : ''),
	        'inputstylename'    => 'inputstyle_'.$fieldname,
	        'inputstylevalue'   => isset($user_fields[$fieldname]['inputstyle']) ? $user_fields[$fieldname]['inputstyle'] : '',
	        'authname'          => 'auth_'.$fieldname,
	        'authoptions'       => build_auth_options(isset($user_fields[$fieldname]['auth']) ? $user_fields[$fieldname]['auth'] : ''),
	    ));
	}
	$example = $template->vars['example'];
	$example = correctimages($example);
	$template->assign_vars(array('EXAMPLE'=>$example));
	$template->pparse('body');
}

function build_getfunct_options($selected='')
{
	global $options;
	$arrFuncs = get_defined_functions();
	$arrFuncs = array_filter($arrFuncs['user'],"is_get_function");
	sort($arrFuncs); // sort for easy finding
	foreach ($arrFuncs as $idx =>$funct)
	{
		$options .= '<option value="'.$funct.'"'.((strtolower($selected) == $funct)?'selected':'').'>'.$funct.'</option>';
	}
	return $options; 
}

function is_get_function($var)
{
	global $getfunction;
	foreach ($getfunction as $idx =>$funct)
	{
		if (substr($var,0,strlen($funct)) == $funct) return 1;
	}
	return 0;
}

function build_chkfunct_options($selected='')
{
	global $options;
	$arrFuncs = get_defined_functions();
	$arrFuncs = array_filter($arrFuncs['user'],"is_check_function");
	sort($arrFuncs); // sort for easy finding
	foreach ($arrFuncs as $idx =>$funct)
	{
		$options .= '<option value="'.$funct.'"'.((strtolower($selected) == $funct)?'selected':'').'>'.$funct.'</option>';
	}
	return $options; 
}

function is_check_function($var){
	global $checkfunction;
	foreach ($checkfunction as $idx =>$funct)
	{
		if (substr($var,0,strlen($funct)) == $funct) return 1;	
	}
	return 0;
}

function build_auth_options($selected=''){
	global $auth_list, $options;
	foreach ($auth_list as $auth_level => $auth_name)
	{
		$options .= '<option value="'.$auth_level.'"'.(($selected == $auth_level)?'selected':'').'>'.pcp_format_lang('Auth_' . $auth_name).'</option>';
	}
	return $options; 
}

function build_values_options($selected=''){
	global $values_list, $options;
	foreach ($values_list as $values_list_name => $values_list_data)
	{
		$options .= '<option value="'.$values_list_name.'"'.(($selected == $values_list_name)?'selected':'').'>'.pcp_format_lang($values_list_name).'</option>';
	}
	return $options; 
}

function inputlistupdate(){
	global $user_maps, $user_fields, $values_list, $tables_linked, $classes_fields;
	global $userfielddata, $posted, $field, $nextmode, $submit_name;
	$keysupdated = array('required','visibility','get_mode','get_func','chk_func','values','inputstyle','auth');
	$keynotupdated = rebuild_array(array_diff($userfielddata,$keysupdated));
	// CAUTION :: set orig_map to map...
	$posted['map'] = $posted['orig_map'];
	// get original fields...
	$fields = array_keys($user_maps[$posted['map']]['fields']);
	foreach ($fields as $idx =>$field)
	{
		// keep old values
		$oldfield = $user_fields[$field];
		// destroy the field
		$user_fields[$field] = array(); 
		// reset old values
		for($i=0; $i<count($keynotupdated); $i++){
			$key = $keynotupdated[$i];
			if(strlen($oldfield[$key])){
				$user_fields[$field][$key] = $oldfield[$key];
			}
		}
		$fieldparams = rebuild_array(array_filter(array_keys($posted),"is_param_of_field"));
		foreach ($fieldparams as $x =>$paramname)
		{
			$paramname = substr($paramname,0,-strlen($field)-1);
			// correct values depending on get_mode
			$mode = $posted['get_mode_'.$field];
			switch ($mode) {
				case 'TEXT':
					$posted['values_'.$field] = '';
					$posted['get_func_'.$field] = '';
					$posted['chk_func_'.$field] = '';
					break;
				case 'LIST_DROP':
				case 'LIST_RADIO':
					$posted['get_func_'.$field] = '';
					$posted['chk_func_'.$field] = '';
					break;
				case 'FUNCT':
					$posted['values_'.$field] = '';
					break;
			}
			$value = $posted[$paramname.'_'.$field];
			if(strlen($value)){
				switch ($paramname) {
					case 'get_mode':
						if($value != 'TEXT' && $value != 'FUNCT'){
							$user_fields[$field][$paramname] = $value;
						}
						break;
					default:
						// add to field
						$user_fields[$field][$paramname] = $value;
						break;
				}
			}
		}
	}
	// write the def_userfields 
	pcp_output_fields($values_list, $tables_linked, $classes_fields, $posted['map'], $user_fields);
	wizredirect($nextmode,'map='.$posted['map'].'&'.$submit_name.'='.$submit_name);
}

function validate($autocorrect=false){
	global $template, $lang, $user_fields, $user_maps, $values_list, $tables_linked, $classes_fields;
	global $posted, $wiznav, $userfielddata, $usermapdata, $all_maps, $fieldkeyrequired, $nextmode, $userfieldsfile, $usermapsfile, $userfieldsfilebackup, $usermapsfilebackup, $fieldkeydefaults, $buddy_map;
	if($autocorrect){
		// backup !
		copy($userfieldsfile, $userfieldsfilebackup);
		chmod($userfieldsfilebackup, 0666);  
		copy($usermapsfile, $usermapsfilebackup);
		chmod($usermapsfilebackup, 0666);  
	}
	$template->set_filenames(array(
		'body' => 'admin/pcp_wiz_validate.tpl')
	);
	$template->assign_vars(array(
		'L_TITLE'						=> $wiznav.'&raquo; '.$lang['Wiz_validate'],
		'L_TITLE_EXPLAIN'		=> $lang['Wiz_validate_description'],
		'HELP'							=> isset($lang['Wiz_validate_explain']) ? $lang['Wiz_validate_explain'] : 'Wiz_validate_explain',
		'AUTOCORRECT'				=> sprintf($lang['Wiz_autocorrect'],wizurl($nextmode)),
		)
	);
	if($autocorrect){
		$posted['message'] = 2;
	}
	setMessage();
	$errors = array();
	// validate maps
	get_all_maps();
	$template->assign_block_vars('type', array(
		'L_TITLE' 					=> 'Validation def_usermaps.php',
		'L_FIELD'						=> $lang['PCP_field_name_short'],
		'L_REQUIRED'				=> $lang['Missing_param'],
		'L_DELETE'					=> $lang['Delete'],
		'L_MOVE'						=> $lang['Move2field'],
	));
	foreach ($all_maps as $idxmap => $map)
	{
		$template->assign_block_vars('type.page', array(
			'text'					=> $map,
		));
		if(empty($user_maps[$map]['title'])){
			if($autocorrect){
				// defailt to map name recursively
				$mapsplit = preg_split('\.',$map);
				$map2alter = "";
				foreach ($mapsplit as $idxCorr => $submap)
				{
					$map2alter .= count($map2alter) ? '.'.$submap : $submap;
					$title = ucfirst($submap);
					$user_maps[$map2alter]['title'] = $title;
				}
			} else {
				$errors['maps'][$map]['missing']['title'] = '';
				$template->assign_block_vars('type.page.titleerror', array(
					'text'					=> $lang['Maptitle_missing'],
				));
			}
		}
		$fields = $user_maps[$map]['fields'];
		$color = false;
		foreach ($fields as $field => $data)
		{
			$color = !$color;
			$template->assign_block_vars('type.page.fields', array(
				'COLOR'					=> $color ? 'row1' : 'row2',
				'field'					=> $field,
				'description'		=> isset($user_fields[$field]['lang_key']) && isset($lang[$user_fields[$field]['lang_key']]) ? $lang[$user_fields[$field]['lang_key']] : ( isset($user_fields[$field]['lang_key']) ? $user_fields[$field]['lang_key'] : '' ),
			));
			// validate if field is in def_userfields
			if(!isset($user_fields[$field]) && substr($field,0,4) != '[lf]'){
				$errors['maps'][$map][$field]['notinfields'] = '';
				$template->assign_block_vars('type.page.fields.notinfields', array(
						'text'					=> sprintf($lang['Not_in_fields'],$field),
					));
			}
			$keys = array_keys($data);
			foreach ($keys as $idx => $key)
			{
				if(!in_array($key,$usermapdata)){
					if(!in_array($key,$userfielddata)){
						$errors['maps'][$map][$field]['alien'][$key] = $data[$key];
						if($autocorrect){
							// delete the key
							unset($user_maps[$map]['fields'][$field][$key]);
						} else {						
							$template->assign_block_vars('type.page.fields.delete', array(
								'key'						=> $key,
								'value'					=> $data[$key],
							));
						}
					} else {
						$errors['maps'][$map][$field]['move2field'][$key] = $data[$key];
						if($autocorrect){
							// move to fields
							$user_fields[$field][$key] = $data[$key];
						} else {
							$template->assign_block_vars('type.page.fields.move', array(
								'key'						=> $key,
								'value'					=> $data[$key],
							));
						}
					}
				} 
			}
		}
	}
	// validate fields
	$template->assign_block_vars('type', array(
		'L_TITLE' 					=> 'Validation def_userfields.php',
		'L_FIELD'						=> $lang['PCP_field_name_short'],
		'L_REQUIRED'				=> $lang['Missing_param'],
		'L_DELETE'					=> $lang['Delete'],
		'L_MOVE'						=> $lang['Move2map'],
	));
	$template->assign_block_vars('type.page', array());
	$color = false;
	foreach ($user_fields as $field => $data)
	{
		$color = !$color;
		$template->assign_block_vars('type.page.fields', array(
			'COLOR'						=> $color ? 'row1' : 'row2',
			'field'						=> $field,
			'description'			=> isset($user_fields[$field]['lang_key']) ? ( isset($lang[$user_fields[$field]['lang_key']]) ? $lang[$user_fields[$field]['lang_key']] : '' ) : '',
		));
		$keys = array_keys($data);
		foreach ($keys as $idx => $key)
		{
			if(!in_array($key,$userfielddata)){
				if(!in_array($key,$usermapdata)){
					$errors['fields'][$field]['alien'][$key] = $data[$key];
					if($autocorrect){
						// delete the key
						unset($user_fields[$field][$key]);
					} else {
						$template->assign_block_vars('type.page.fields.delete', array(
							'key'						=> $key,
							'value'					=> $data[$key],
						));
					}
				} else {
					$errors['fields'][$field]['move2map'][$key] = $data[$key];
					
					$template->assign_block_vars('type.page.fields.move', array(
						'key'						=> $key,
						'value'					=> $data[$key],
					));
				}
			}
		}
		@reset($fieldkeyrequired);
		@reset($fieldkeydefaults);
		foreach ($fieldkeyrequired as $idx => $reqkey)
		{
			if(!in_array($reqkey,$keys)){
				$errors['fields'][$field]['required'][$reqkey] = '';
				if($autocorrect){
					// set to default
					if($fieldkeydefaults[$idx] == '_'){
						$user_fields[$field][$reqkey] = $field;
					} else $user_fields[$field][$reqkey] = $fieldkeydefaults[$idx];
				} else {
					$template->assign_block_vars('type.page.fields.required', array(
						'key'						=> $reqkey,
					));
				}
			}
		}
	}
	if($autocorrect){
		// correct required fields
		correctrequired();
		// correct buddy order
		$buddyfields = array_filter($user_fields,"find_buddy_fields");
		$buddyfields = sortfields($buddyfields,'ind');
		setBuddyInd($buddyfields);
		// write the new files
		pcp_output_fields($values_list, $tables_linked, $classes_fields, NULL, $user_fields);
		// reset the use_list_option :: when altering the order this user value is incorrect 
		update_user_list_option();
		reorder_mapfields($buddyfields,$buddy_map);
		// done in reorder :: pcp_output_maps($user_maps);
	}
	$template->pparse('body');
}

function fields(){
	global $template, $lang, $field_def, $user_fields, $db;
	global $posted, $nextmode, $wiznav, $select_name, $submit_name, $baseparams, $goto_name, $new_name, $fieldkeyrequired;
	$template->set_filenames(array(
		'body' => 'admin/pcp_wiz_fields.tpl')
	);
	$template->assign_vars(array(
		'L_TITLE'						=> $wiznav.'&raquo; '.$lang['Wiz_fields'],
		'L_TITLE_EXPLAIN'		=> $lang['Wiz_fields_description'],
		'L_SELECT_FIELD'		=> $lang['Select_field'],
		'FIELDSELECT_NAME'	=> 'field',
		'FIELDOPTIONS'			=> build_allfields_options('', ( isset($posted['field']) ? $posted['field'] : NULL ) ),
		'HIDDEN_FIELDS'			=> '<input type="hidden" name="orig_field" value="'.(!empty($posted[$new_name])? ( isset($posted['newfield']) ? $posted['newfield'] : '' ) : ( isset($posted['field']) ? $posted['field'] : '' ) ).'">',
		'L_SELECT'					=> $lang['Select'],
		'SELECT_NAME'				=> $select_name,
		'L_SELECT_NEW_FIELD'=> $lang['Select_new_field'],
		'NEWSELECT_NAME'		=> 'newfield',
		'NEWOPTIONS'				=> build_newfield_options(( isset($posted['field']) ? $posted['field'] : NULL )),
		'NEW_NAME'					=> $new_name,
		'S_ACTION'					=> wizurl($nextmode),
		'HELP'							=> $lang['Wiz_fields_explain'],
		'L_SUBMIT'					=> $lang['Submit'],
		'SUBMIT_NAME'				=> $submit_name,
		'CONFIRM_MESSAGE'		=> $lang['Confirm_message'],
		'L_GOTO'						=> $lang['Wiz_showfieldinfo'],
		'GOTO_NAME'					=> $goto_name,
		)
	);
	if(!empty($posted['field'])){
		$template->assign_block_vars('selected', array());
	}
	setMessage();
	$template->set_filenames(array(
		'input' => 'admin/pcp_wiz_inputexample.tpl')
	);
	foreach ($baseparams as $idx => $key)
	{
		$value = ( isset($posted['field']) && array_key_exists($posted['field'], $user_fields) && array_key_exists($key, $user_fields[$posted['field']]) ? $user_fields[$posted['field']][$key] : '' );
		if(in_array($key,$fieldkeyrequired)){
			$dbvalue = $lang['Required_field'];
		} else $dbvalue = '';
		if($key == 'type'){
			$sql = "SHOW FIELDS FROM ".USERS_TABLE." LIKE '". ( isset($posted['field']) ? $posted['field'] : '%' ) ."'";
			if ( !$result = $db->sql_query($sql) ) {
				message_die(GENERAL_ERROR, 'Could not get user table definition', '', __LINE__, __FILE__, $sql);	
			}
			while ($row = $db->sql_fetchrow($result) ){
				$dbvalue .= ' <font color=green>'.$row['Type'].'</font>';
			}
		}
		switch(isset($field_def[$key]['type']) ? $field_def[$key]['type'] : ''){
			case 'LIST_TYPE':
				$input = pcp_input_type($key,$value);
				// correct the select
				$input = str_replace('<select name="'.$key.'">','<select name="'.$key.'" class="post" onchange="updateform();">', $input); 
				$name = $lang[$field_def[$key]['lang_key']];
				break;
			case 'LIST_CLASS':
				$input = '<select name="'.$key.'" class="post" onchange="updateform();">';
				$input .= build_classes_options($value);
				$input .= '</select>';
				$name = $lang['Display_when'];
				break;
			case 'LIST_AUTH':
				$input = '<select name="'.$key.'" class="post" onchange="updateform();">';
				$input .= build_auth_options($value);
				$input .= '</select>';
				$name = $lang['PCP_field_auth'];
				break;
			default:
				$input = '<input type="text" name="'.$key.'" value="'.$value.'" class="post" onchange="updateform();" maxlength="255" size="45">';
				$name = $lang[$field_def[$key]['lang_key']];
				break;
		}
		$template->assign_block_vars('field', array(
			'L_NAME'		=> $name,
			'L_EXPLAIN'	=> '',
			'INPUT'		=> $input.' '.$dbvalue,
			)
		);
	}
	$template->assign_var_from_handle('FIELDINFO', 'input');
	$template->pparse('body');
}

function build_newfield_options($selected=''){
	global $db, $user_fields;
	$options = '';
	$sql = "SHOW FIELDS FROM ".USERS_TABLE;
	if ( !$result = $db->sql_query($sql) ) {
		message_die(GENERAL_ERROR, 'Could not get user table definition', '', __LINE__, __FILE__, $sql);	
	}
	while ($row = $db->sql_fetchrow($result) ){
		if(!isset($user_fields[$row['Field']]) || !is_array($user_fields[$row['Field']])){
			if($row['Field'] == $selected){
				$extra = "selected";
			} else $extra = "";
			$options .= '<option value="'.$row['Field'].'" '.$extra.'>'.$row['Field'].'</option>';
		}
	}
	return $options; 
}

function fieldsupdate(){
	global $lang, $user_fields, $values_list, $tables_linked, $classes_fields;
	global $posted, $fieldkeyrequired, $submit_name, $nextmode, $baseparams;
	// CAUTION :: set orig_field to field...
	$posted['field'] = $posted['orig_field'];
	// check required field params
	foreach ($fieldkeyrequired as $idx => $reqkey)
	{
		if(!strlen($posted[$reqkey])){
			$error_msg = sprintf($lang['Required_Error'],$lang['Required_field']);
			message_die( GENERAL_MESSAGE, $error_msg );
		}
	}
	foreach ($baseparams as $idx => $key)
	{
		if(strlen($posted[$key])){
			$user_fields[$posted['field']][$key] = $posted[$key];
		} else {
			unset($user_fields[$posted['field']][$key]);
		}
	}
	// write the file :: send null as user_maps ==> actually not used inside the function!
	pcp_output_fields($values_list, $tables_linked, $classes_fields, NULL, $user_fields);
	
	wizredirect($nextmode,'field='.$posted['field'].'&'.$submit_name.'='.$submit_name);	
}

function fieldimport(){
	global $template, $lang;
	global $posted, $wiznav, $nextmode, $submit_name, $fieldimports;
	$template->set_filenames(array(
		'body' => 'admin/pcp_wiz_import.tpl')
	);
	$template->assign_vars(array(
		'L_TITLE'						=> $wiznav.'&raquo; '.$lang['Wiz_fieldimport'],
		'L_TITLE_EXPLAIN'		=> $lang['Wiz_fieldimport_description'],
		'S_ACTION'					=> wizurl($nextmode),
		'HELP'							=> $lang['Wiz_import_explain'],
		'L_SUBMIT'					=> $lang['Submit'],
		'SUBMIT_NAME'				=> $submit_name,
		'L_TYPE'						=> $lang['Type'],
		'L_DEFINITION'			=> $lang['Definition'],
		)
	);
	setMessage();
	$color = false;
	foreach ($fieldimports as $idx =>$fieldimport)
	{
		$color = !$color;
		$template->assign_block_vars('type', array(
			'COLOR'						=> $color ? 'row1' : 'row2',
			'title'						=> $lang['Type_'.$fieldimport.'_title'],
			'explain'					=> $lang['Type_'.$fieldimport.'_explain'],
			'name'						=> $fieldimport,
		));
	}
	$template->pparse('body');
}

function fieldimportupdate(){
	global $values_list, $classes_fields, $user_fields, $tables_linked;
	global $posted, $nextmode, $submit_name, $userfieldsfile, $userfieldsfilebackup;
  
	// manage lists
	if($posted['lists']){
		// no dollar signs allowed!
		$posted['lists'] = str_replace('$','',$posted['lists']);
		$posted['lists'] = trim($posted['lists']);
		if(substr($posted['lists'],0,9) == 'new_lists'){
			$code = "\$". stripslashes($posted['lists']);
			eval($code);
			foreach ($new_lists as $listname =>$data)
			{
				$values_list[$listname] = $data;
			}
		}
	}
	// manage classes
	if($posted['classes']){
		// no dollar signs allowed!
		$posted['classes'] = str_replace('$','',$posted['classes']);
		$posted['classes'] = trim($posted['classes']);
		if(substr($posted['classes'],0,11) == 'new_classes'){
			$code = "\$". stripslashes($posted['classes']);
			eval($code);
			foreach ($new_classes as $classname =>$data)
			{
				$classes_fields[$classname] = $data;
			}
		}
	}
	// manage deletes
	if($posted['deletes']){
		// no dollar signs allowed!
		$posted['deletes'] = str_replace('$','',$posted['deletes']);
		$posted['deletes'] = trim($posted['deletes']);
		if(substr($posted['deletes'],0,7) == 'deletes'){
			$code = "\$". stripslashes($posted['deletes']);
			eval($code);
			foreach ($deletes as $type =>$data)
			{
				foreach ($data as $idx =>$item)
				{
					switch($type){
						case 'lists':
							unset($values_list[$item]);
							break;
						case 'classes':
							unset($classes_fields[$item]);
							break;
						case 'fields':
							unset($user_fields[$item]);
							break;
					}
				}
			}
		}
	}
	// manage fields
	if($posted['fields']){
		// no dollar signs allowed!
		$posted['fields'] = str_replace('$','',$posted['fields']);
		$posted['fields'] = trim($posted['fields']);
		if(substr($posted['fields'],0,10) == 'new_fields'){
			$code = "\$". stripslashes($posted['fields']);
			eval($code);
			foreach ($new_fields as $fieldname =>$data)
			{
				$user_fields[$fieldname] = $data;
			}
		}
	}
	// backup !
	copy($userfieldsfile, $userfieldsfilebackup);
	chmod($userfieldsfilebackup, 0666);  
	// update the data...
	pcp_output_fields($values_list, $tables_linked, $classes_fields, NULL, $user_fields);
	$posted['message'] = 2;
	fieldimport();
}

function pageimport(){
	global $template, $lang;
	global $posted, $wiznav, $nextmode, $submit_name, $pageimports;
	$template->set_filenames(array(
		'body' => 'admin/pcp_wiz_import.tpl')
	);
	$template->assign_vars(array(
		'L_TITLE'						=> $wiznav.'&raquo; '.$lang['Wiz_pageimport'],
		'L_TITLE_EXPLAIN'		=> $lang['Wiz_pageimport_description'],
		'S_ACTION'					=> wizurl($nextmode),
		'HELP'							=> $lang['Wiz_import_explain'],
		'L_SUBMIT'					=> $lang['Submit'],
		'SUBMIT_NAME'				=> $submit_name,
		'L_TYPE'						=> $lang['Type'],
		'L_DEFINITION'			=> $lang['Definition'],
		)
	);
	setMessage();
	$color = false;	
	foreach ($pageimports as $idx =>$pageimport)
	{
		$color = !(isset($color) ? $color : false);
		$template->assign_block_vars('type', array(
			'COLOR'						=> $color ? 'row1' : 'row2',
			'title'						=> $lang['Type_'.$pageimport.'_title'],
			'explain'					=> $lang['Type_'.$pageimport.'_explain'],
			'name'						=> $pageimport,
		));
	}
	$template->pparse('body');
}

function pageimportupdate(){
	global $user_maps;
	global $posted, $nextmode, $submit_name, $usermapsfile, $usermapsfilebackup;
	// manage delpages
	if($posted['delpages']){
		// no dollar signs allowed!
		$posted['delpages'] = str_replace('$','',$posted['delpages']);
		$posted['delpages'] = trim($posted['delpages']);
		if(substr($posted['delpages'],0,9) == 'del_pages'){
			$code = "\$". stripslashes($posted['delpages']);
			eval($code);
			foreach ($del_pages as $idx =>$mapname)
			{
				unset($user_maps[$mapname]);
			}
		}
	}
	// manage newpages
	if($posted['newpages']){
		// no dollar signs allowed!
		$posted['newpages'] = str_replace('$','',$posted['newpages']);
		$posted['newpages'] = trim($posted['newpages']);
		if(substr($posted['newpages'],0,9) == 'new_pages'){
			$code = "\$". stripslashes($posted['newpages']);
			eval($code);
			foreach ($new_pages as $mapname =>$data)
			{
				$user_maps[$mapname] = $data;
			}
		}
	}
	// manage delpagefields
	if($posted['delpagefields']){
		// no dollar signs allowed!
		$posted['delpagefields'] = str_replace('$','',$posted['delpagefields']);
		$posted['delpagefields'] = trim($posted['delpagefields']);
		if(substr($posted['delpagefields'],0,14) == 'del_pagefields'){
			$code = "\$". stripslashes($posted['delpagefields']); 
			eval($code);
			foreach ($del_pagefields as $mapname => $data)
			{
				foreach ($data['fields'] as $fieldname =>$fielddata)
				{
					// update the map
					unset($user_maps[$mapname]['fields'][$fieldname]);
				}
			}
		}
	}
	// manage newpagefields
	if($posted['newpagefields']){
		// no dollar signs allowed!
		$posted['newpagefields'] = str_replace('$','',$posted['newpagefields']);
		$posted['newpagefields'] = trim($posted['newpagefields']);
		if(substr($posted['newpagefields'],0,14) == 'new_pagefields'){
			$code = "\$". stripslashes($posted['newpagefields']); 
			eval($code);
			foreach ($new_pagefields as $mapname => $data)
			{
				$newfields = array();
				switch($data['position']){
					case 'begin': 
						$newfields = array_merge($data['fields'],$user_maps[$mapname]['fields']);
						break;
					case 'end':
						$newfields = array_merge($user_maps[$mapname]['fields'],$data['fields']);
					default:
						// choosing field
						foreach ($user_maps[$mapname]['fields'] as $fieldname =>$fielddata)
						{
							$newfields[$fieldname] = $fielddata;
							if($fieldname == $data['position']){
								$newfields = array_merge($newfields,$data['fields']);
							} 
						}
						if(!count($newfields)){
							// searchfield not found
							$newfields = $data['fields'];
						}
						break; 
				}
				// update the map
				$user_maps[$mapname]['fields'] = $newfields;
			}
		}
	}
	// backup!
	copy($usermapsfile, $usermapsfilebackup);
	chmod($usermapsfilebackup, 0666);  
	// sort the map!
	$user_maps = pcp_sort_usermaps($user_maps);
	// rebuild the map 	
	pcp_output_maps($user_maps);
	$posted['message'] = 2;
	pageimport();
}

if (!function_exists('pcp_sort_usermaps')) {
	function pcp_sort_usermaps($user_maps) {
		// taken from admin_pcp_usermaps.php
		// working array
		$maps = $user_maps;
		// set the parent tree
		foreach ($maps as $map_name => $map_data)
		{
			// find parent
			$w_map_name = $map_name;
			$w_map_data = $map_data;
			$done = false;
			while ( !$done )
			{
				// store
				$maps[$w_map_name] = $w_map_data;
				// verify parents
				$keys = explode('.', $w_map_name);
				$w_keys = array();
				for ($i=0; $i < count($keys)-1; $i++)
				{
					$w_keys[] = $keys[$i];
				}
				$parent_map = implode('.', $w_keys);
				// looping condition
				$done = ( empty($parent_map) || isset($maps[$parent_map]) );
				// set the parent value
				if ( !empty($parent_map) )
				{
					// add parent map if not exists
					if ( !isset($maps[$parent_map]) )
					{
						$maps[$parent_map] = array();
					}
				}
				// loop
				$w_map_name = $parent_map;
				$w_map_data = $maps[$parent_map];
			}
		}
		// get the parent name and the local order
		$local_order = array();
		$names = array();
		foreach ($maps as $map_name => $map_data)
		{
			$names[] = $map_name;
			// get the parent name
			$w_keys = explode('.', $map_name);
			$new_keys = array();
			for ( $i = 0; $i < (count($w_keys)-1); $i++)
			{
				$new_keys[] = $w_keys[$i];
			}
			$maps[$map_name]['parent'] = implode( '.', $new_keys);
			// get the local order (order+name)
			$local_order[$map_name] = implode('.', array( sprintf('%09d', intval($map_data['order'])), $w_keys[ count($w_keys)-1 ] ) );
		}
		@array_multisort($names, $maps);
		// sort : get the full order expression
		$cumul_order = array();
		$order = array();
		foreach ($maps as $map_name => $map_data)
		{
			$cumul_order[$map_name] = ( empty($cumul_order[ $map_data['parent'] ]) ? '' : $cumul_order[ $map_data['parent'] ] . '.' ) .  $local_order[$map_name];
			$order[] = $cumul_order[$map_name];
		}
		@array_multisort($order, $maps);
		pcp_affect_order($maps);
		return $maps;
	}
}

if (!function_exists('pcp_affect_order')) {
	function pcp_affect_order(&$maps) {
		// taken from admin_pcp_usermaps.php
		$stack = array();
		$w_maps = $maps;
		foreach ($maps as $map_name => $map_data)
		{
			// get parent
			$w_keys = explode('.', $map_name);
			$new_keys = array();
			for ($i=0; $i < (count($w_keys)-1); $i++)
			{
				$new_keys[] = $w_keys[$i];
			}
			$parent = implode('.', $new_keys);
			if ( empty($stack) || !in_array($parent, $stack) )
			{
				$order = -1;
				foreach ($w_maps as $w_map_name => $w_map_data)
				{
					// get parent
					$w_keys = explode('.', $w_map_name);
					$new_keys = array();
					for ($i=0; $i < (count($w_keys)-1); $i++)
					{
						$new_keys[] = $w_keys[$i];
					}
					$local_parent = implode('.', $new_keys);

					if ($local_parent == $parent)
					{
						$order++;
						$maps[$w_map_name]['order'] = ($order * 10);
					}
				}
				$stack[] = $parent;
			}
		}
	}
}

function backups(){
	global $template, $lang, $board_config;
	global $posted, $nextmode, $deletemode, $restoremode, $defdir, $wiznav, $backupnowmode;
	$template->set_filenames(array(
		'body' => 'admin/pcp_wiz_backups.tpl')
	);
	$template->assign_vars(array(
		'L_TITLE'						=> $wiznav.'&raquo; '.$lang['Wiz_backups'],
		'L_TITLE_EXPLAIN'		=> $lang['Wiz_backups_description'],
		'HELP'							=> $lang['Wiz_backups_explain'],
		'L_BACKUP'					=> $lang['Backup'],
		'L_ACTIONS'					=> $lang['Action'],
		'L_FIELDS'					=> $lang['PCP_usermaps_fields'] . ' :: def_userfields.php',
		'L_PAGES'						=> $lang['Pages'] . ' :: def_usermaps.php',
		'L_RESTORE'					=> $lang['Restore'],
		'L_DELETE'					=> $lang['Delete'],
		'L_BACKUPNOW'				=> $lang['backupnow'],
		'U_BACKUPNOW'				=> wizurl($backupnowmode),
		)
	);
	setMessage();
	$dir = @opendir($defdir);
	$fcolor=$pcolor=true;
	while( $file = @readdir($dir) )
	{
		$restore = wizurl($restoremode,'file='.$file);
		$delete = wizurl($deletemode,'file='.$file);
		$view = $defdir.'/'.$file;
		$afile = explode('.',$file);
		$name = ( isset($afile[1]) ? $afile[1] : '' ) ;
		if( preg_match("/^def_userfields\.[0-9].*?$/", $file) ) {
			$fcolor = !$fcolor;
			$time = mktime(substr($name,8,2), substr($name,10,2), substr($name,12,2), substr($name,4,2), substr($name,6,2), substr($name,0,4));
			$name = create_date($board_config['default_dateformat'], $time, $board_config['board_timezone']);
			$template->assign_block_vars('fields', array(
					'COLOR'			=> $fcolor ? 'row1' : 'row2',
					'name'			=> $name,
					'file'			=> $file,
					'restore'		=> $restore,
					'delete'		=> $delete,
					'view'			=> $view,
				)
			);
		}
		if( preg_match("/^def_usermaps\.[0-9].*?$/", $file) ) {
			$pcolor = !$pcolor;
			$template->assign_block_vars('pages', array(
					'COLOR'			=> $pcolor ? 'row1' : 'row2',
					'name'			=> $name,
					'file'			=> $file,
					'restore'		=> $restore,
					'delete'		=> $delete,
					'view'			=> $view,
				)
			);
		}
	}
	@closedir($dir);
	$template->pparse('body');
}

function deletebackup(){
	global $posted, $defdir, $nextmode;
	$file = $defdir . '/' . $posted['file'];
	if(file_exists($file)) unlink($file);
	wizredirect($nextmode,'message=4&file='.$posted['file']);
}

function restorebackup(){
	global $posted, $userfieldsfile, $userfieldsfilebackup, $usermapsfile, $usermapsfilebackup, $defdir, $nextmode;
	if( preg_match("/^def_usermaps\.[0-9].*?$/", $posted['file']) ) {
		// backup !
		copy($usermapsfile, $usermapsfilebackup);
		chmod($usermapsfilebackup, 0666);
		// delete
		if(file_exists($usermapsfile)) unlink($usermapsfile);
		// copy
		$file = $defdir . '/' . $posted['file'];
		copy($file,$usermapsfile);
		chmod($usermapsfile, 0666);
	} else {
		// backup !
		copy($userfieldsfile, $userfieldsfilebackup);
		chmod($userfieldsfilebackup, 0666); 
		// delete 
		if(file_exists($userfieldsfile)) unlink($userfieldsfile);
		// copy
		$file = $defdir . '/' . $posted['file'];
		copy($file,$userfieldsfile);
		chmod($userfieldsfile, 0666);
	}
	wizredirect($nextmode,'message=5&file='.$posted['file']);
}

function backupnow(){
	global $posted, $userfieldsfile, $userfieldsfilebackup, $usermapsfile, $usermapsfilebackup, $defdir, $nextmode;
	copy($userfieldsfile, $userfieldsfilebackup);
	chmod($userfieldsfilebackup, 0666); 
	copy($usermapsfile, $usermapsfilebackup);
	chmod($usermapsfilebackup, 0666);
	wizredirect($nextmode,'message=6');
}

function correctrequired(){
	global $user_fields, $user_maps;
	global $input_maps;
	
	$requiredfields = array_keys(array_filter($user_fields,"find_required_fields"));
	get_input_maps();
	foreach ($input_maps as $idxmap => $map)
	{
		if (!count($requiredfields)) break;

		$mapfields = array();
		if( is_array($user_maps[$map]['fields'])){
			$mapfields = array_keys($user_maps[$map]['fields']);
		}
		for($i=0; $i<count($requiredfields); $i++){
			if(in_array($requiredfields[$i],$mapfields)){
				array_splice($requiredfields,$i,1);
				$i--;
			}
		}
	}
	// now $requiredfields contains only fields that are not on input maps so delete the prop
	for($i=0; $i<count($requiredfields); $i++){
		unset($user_fields[$requiredfields[$i]]['required']);
	}
	
}

function find_required_fields($var){
	return !empty($var['required']);
}

//---------------------------------
//
//	process
//
//---------------------------------
// init
$menuactions = array('validate','buddylist','addremovefields','outputlist','inputlist','fields','fieldimport','pageimport','backups');
$hiddenactions = array('menu','buddyupdate','addremovefieldsupdate','showfieldinfo','outputlistupdate','inputlistupdate','fieldsupdate','validateupdate','fieldimportupdate','pageimportupdate','deletebackup','restorebackup','backupnow');
$actions = array_merge($menuactions,$hiddenactions);
$wiznav = '<a href="'.wizurl("menu").'">'.$lang['PCP_10_wizard'].'</a> ';
$defdir = $phpbb_root_path . "profilcp/def";
$userfieldsfile = $defdir . '/def_userfields.' . $phpEx;
$usermapsfile =  $defdir . '/def_usermaps.' . $phpEx;
$nowstr = date("YmdHis");
$userfieldsfilebackup = $defdir . '/def_userfields.' . $nowstr;
$usermapsfilebackup = $defdir . '/def_usermaps.' . $nowstr;
$posted = array_merge($_POST,$_GET);
$mode = !empty($posted['mode']) ? $posted['mode'] : 'menu'; //default to menu
$fieldsmode = 'fields';
$buddy_map = 'PCP.buddy';
$profil_map = 'PCP.profil';
$register_map = 'PCP.register';
$ignore_map_string = 'ignore';
$outputfunction = array('pcp_output_');
$outputfunctignore = array('pcp_output_format','pcp_output_panel','pcp_output_boolean','pcp_output_lang','pcp_output_fields','pcp_output_maps');
$getfunction = array('mods_get_','mods_settings_get_');
$checkfunction = array('mods_check_','mods_settings_check_');
$select_name = 'select';
$submit_name = 'submit';
$new_name = 'new';
$goto_name = 'goto';
$input_maps = array();
$output_maps = array();
$all_maps = array();
$demouserdata = array();
$userfielddata = array('lang_key','explain','image','title','class','type','dsp_func','user_only','system','required','visibility','get_mode','get_func','chk_func','values','inputstyle','auth','ind','dft','rqd','hidden','sql_def'); // remove 'default' is done by config+
$fieldkeyrequired = array('lang_key','class','type');
$fieldkeydefaults = array('_','generic','VARCHAR');
$usermapdata = array('dsp_func','link','leg','txt','img','crlf','lnk','style');
$baseparams = array_merge($fieldkeyrequired,array('explain','image','title'));
$fieldimports = array('lists','classes','fields','deletes');
$pageimports = array('newpages','delpages','newpagefields','delpagefields');
// validate file permissions
if(substr(sprintf('%o', fileperms($userfieldsfile)), -4) != '0666'){
	$posted['message'] = 3;
	$posted['bad_permissions'][] = $userfieldsfile;
}
if(substr(sprintf('%o', fileperms($usermapsfile)), -4) != '0666'){
	$posted['message'] = 3;
	$posted['bad_permissions'][] = $usermapsfile;
}
include($userfieldsfile);
include($usermapsfile);

// internal navigation 
$select = array(
	'addremovefieldsupdate' => 'addremovefields',
	'outputlistupdate' 			=> 'outputlist',
	'inputlistupdate' 			=> 'inputlist',
	'fieldsupdate'		 			=> 'fields',
);
$goto = array(
	'outputlistupdate' 			=> 'addremovefields',
	'addremovefieldsupdate' => isset($posted['map']) && is_output_map($posted['map'])?'outputlist':'inputlist',
	'inputlistupdate' 			=> 'addremovefields',
	'fieldsupdate'		 			=> 'showfieldinfo',
);

if(!empty($posted[$select_name])){
	$posted['message'] = 1;
	$mode = $select[$mode];
} elseif(!empty($posted[$submit_name])){
	$posted['message'] = 2;
} elseif(!empty($posted[$goto_name])){
	$mode = $goto[$mode];
} elseif(!empty($posted[$select_name])){	
	$posted['message'] = 3;
	$mode = $select[$mode];
} elseif(!empty($posted[$new_name])){	
	$posted['message'] = 1;
	$mode = $select[$mode];
	$posted['field'] = $posted['newfield'];
}

if ( !in_array($mode, $actions ) ) {
	$error_msg = sprintf($lang['Wiz_mode_error'],$mode);
	message_die( GENERAL_MESSAGE, $error_msg );
}

switch ($mode) {
	case 'menu':
		include('./page_header_admin.'.$phpEx);
		menu();
		break;
	case 'buddylist':
		include('./page_header_admin.'.$phpEx);
		$nextmode = 'buddyupdate';
		buddylist();
		break;
	case 'buddyupdate':
		$nextmode = 'buddylist';
		buddyupdate();
		break;
	case 'addremovefields':
		include('./page_header_admin.'.$phpEx);
		$helpmode = 'showfieldinfo';
		$nextmode = 'addremovefieldsupdate';
		addremovefields();
		break;
	case 'addremovefieldsupdate':
			$buddy = false;
			if($posted['map'] == $buddy_map){
				$nextmode = 'outputlist';
				$buddy = true;
			} else if(is_input_map($posted['map'])){
				$nextmode = 'inputlist';
			} else {
				$nextmode = 'outputlist';
			}
			// update the map
			addremovefieldsupdate($buddy);
		break;
	case 'showfieldinfo':
		include('./page_header_admin.'.$phpEx);
		$nextinputmode = 'inputlist';
		$nextoutputmode = 'outputlist';
		showfieldinfo();
		break;
	case 'outputlist':
		include('./page_header_admin.'.$phpEx);
		$nextmode = 'outputlistupdate';
		outputlist();
		break;
	case 'outputlistupdate':
		$nextmode = 'outputlist';
		outputlistupdate();
		break;
	case 'inputlist':
		include('./page_header_admin.'.$phpEx);
		$nextmode = 'inputlistupdate';
		inputlist();
		break;
	case 'inputlistupdate':
		$nextmode = 'inputlist';
		inputlistupdate();
		break;
	case 'validate':
		include('./page_header_admin.'.$phpEx);
		$nextmode = 'validateupdate';
		validate();
		break;
	case 'validateupdate':
		include('./page_header_admin.'.$phpEx);
		$nextmode = 'validateupdate';
		validate(true);
		break;
	case 'fields':
		include('./page_header_admin.'.$phpEx);
		$nextmode = 'fieldsupdate';
		fields();
		break;
	case 'fieldsupdate':
		$nextmode = 'fields';
		fieldsupdate();
		break;
	case 'fieldimport':
		include('./page_header_admin.'.$phpEx);
		$nextmode = 'fieldimportupdate';
		fieldimport();
		break;
	case 'fieldimportupdate':
		include('./page_header_admin.'.$phpEx);
		$nextmode = 'fieldimport';
		fieldimportupdate();
		break;
	case 'pageimport':
		include('./page_header_admin.'.$phpEx);
		$nextmode = 'pageimportupdate';
		pageimport();
		break;
	case 'pageimportupdate':
		include('./page_header_admin.'.$phpEx);
		$nextmode = 'pageimport';
		pageimportupdate();
		break;
	case 'backups':
		include('./page_header_admin.'.$phpEx);
		$nexmode = 'restorebackup';
		$deletemode = 'deletebackup';
		$restoremode = 'restorebackup';
		$backupnowmode = 'backupnow';
		backups();
		break;
	case 'deletebackup':
		$nextmode = 'backups';
		deletebackup();
		break;
	case 'restorebackup':
		$nextmode = 'backups';
		restorebackup();
		break;
	case 'backupnow':
		$nextmode = 'backups';
		backupnow();
		break;
}

include('./page_footer_admin.'.$phpEx);

?>
