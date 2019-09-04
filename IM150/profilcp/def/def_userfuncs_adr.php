<?php

/***************************************************************************
 *			def_userfuncs_adr.php
 *
 *
 ***************************************************************************
/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 *
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
	exit;
}
//----------------------------------- 
// 
// user_cell_punishment output function 
// 
//----------------------------------- 
function pcp_output_user_cell_punishment($field_name, $view_userdata, $map_name='') 
{ 
	global $board_config, $phpbb_root_path, $phpEx, $lang, $images, $userdata, $server_url, $db;
	global $values_list, $tables_linked, $classes_fields, $user_maps, $user_fields, $table_prefix;

   $txt = ''; 
   $img = ''; 
   $res = ''; 
 if ( !empty($view_userdata[$field_name]) && ($view_userdata['user_cell_time'] > 0) && ($view_userdata['user_id'] != ANONYMOUS) ) 
   { 
      $temp_url = append_sid("./adr_courthouse.php?celled_user_id=" . $view_userdata['user_id']); 
      $txt = '<a href="' . $temp_url . '" title="' . $lang['Judge'] . '">' . $lang['Judge'] . '</a>'; 
      $img = '<a href="' . $temp_url . '"><img src="' . $images['icon_justice'] . '" alt="' . $lang['Judge'] . '" title="' . $lang['Judge'] . '" border="0" /></a>'; 
      // result 
      $res = pcp_output_format($field_name, $txt, $img, $map_name); 
   } 
   return $res; 
}
//-----------------------------------
//
// user_adr output function
//
//-----------------------------------
function pcp_output_adr($field_name, $view_userdata, $map_name='') 
{ 
  global $board_config, $phpbb_root_path, $phpEx, $lang, $images, $userdata, $server_url, $db;
  global $values_list, $tables_linked, $classes_fields, $user_maps, $user_fields, $table_prefix;

  $txt = ''; 
  $img = ''; 
  $res = ''; 
  $img = adr_display_poster_infos($view_userdata['user_id']);
  // result 
  $res = pcp_output_format($field_name, $txt, $img, $map_name); 

  return $res; 
}
//-----------------------------------
//
// user_vault output function
//
//-----------------------------------
	function pcp_output_vault($field_name, $view_userdata, $map_name='')
{
	global $board_config, $phpbb_root_path, $phpEx, $lang, $images, $userdata, $server_url, $db;
	global $values_list, $tables_linked, $classes_fields, $user_maps, $user_fields, $table_prefix;
	define('ADR_VAULT_BLACKLIST_TABLE',$table_prefix.'adr_vault_blacklist');
	define('ADR_VAULT_EXCHANGE_USERS_TABLE',$table_prefix.'adr_vault_exchange_users');
	define('ADR_VAULT_GENERAL_TABLE',$table_prefix.'adr_vault_general');
	define('ADR_VAULT_USERS_TABLE',$table_prefix.'adr_vault_users');
        $txt = ''; 
        $img = ''; 
        $res = '';
        $sql = " SELECT e.* , eu .* , u.*
          FROM " . ADR_VAULT_EXCHANGE_TABLE . " e
            LEFT JOIN " . ADR_VAULT_EXCHANGE_USERS_TABLE . " eu
              ON ( e.stock_id = eu.stock_id )
            LEFT JOIN " . ADR_VAULT_USERS_TABLE . " u
              ON u.owner_id = eu.user_id AND eu.user_id =  " . $view_userdata['user_id']; 
	if( !($result = $db->sql_query($sql))) 
	{ 
		message_die(GENERAL_ERROR, 'Could not obtain accounts information', "", __LINE__, __FILE__, $sql); 
	} 
	$shares = $db->sql_fetchrowset($result); 

	for ( $i = 0 ; $i < count($shares) ; $i ++ ) 
	{ 
		$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
	}
	$accounts = $shares;
	if ( $accounts ) 
	{ 
	$on_account = ( $shares[0]['account_protect'] && $userdata['user_level'] != ADMIN ) ? $lang['vault_confidential'] : $shares[0]['account_sum'].'&nbsp;'.$board_config['points_name'];
	$loan = ( $shares[0]['loan_protect'] && $userdata['user_level'] != ADMIN ) ? $lang['vault_confidential'] : $shares[0]['loan_sum'].'&nbsp;'.$board_config['points_name'];
	$txt = $lang['vault_account_amount'] . ':&nbsp;'. $on_account .'<br>'.$lang['vault_loan_amount'] . ':&nbsp;' . $loan;
}
else
	$txt = '';

	   $res = pcp_output_format($field_name, $txt, $img, $map_name);

	return $res;
}
?>
