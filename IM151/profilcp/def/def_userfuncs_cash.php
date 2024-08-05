<?php 

/*************************************************************************** 
 *                     def_userfuncs_custom.php 
 *                     ------------------------ 
 *   begin            : 20/10/2003 
 *   copyright        : Ptirhiik 
 *   email            : Ptirhiik@rpgnet.clanmckeen.com 
 * 
 *   New function file created and designed by psyper@bhere.net.
 *   For:
 *   cash intergration tutorial at http://bhere.net/forum/pcp01.php
 *   shop intergration tutorial at http://bhere.net/forum/pcp05.php
 * 
 *   version            : 1.0.0 - 28/05/2004 
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

if ( !defined('IN_PHPBB') ) 
{ 
   die('Hacking attempt'); 
   exit; 
} 

//-----------------------------------
//
// user_cash topics output function
//
//-----------------------------------
function pcp_output_cashtp($field_name, $view_userdata, $map_name='')
{
   if($map_name == null) global $map_name;
   global $board_config, $phpbb_root_path, $phpEx, $lang, $images, $userdata;
   global $values_list, $tables_linked, $classes_fields, $user_maps, $user_fields;
   global $cash;

   $txt = '';
   $img = '';
   $res = '';
   if  ( $view_userdata['user_id'] != ANONYMOUS ) 
   { 
			if ( $board_config['cash_disable'])
			{
				return;
			}
         while ( $c_cur = $cash->currency_next($cm_i,CURRENCY_ENABLED | CURRENCY_VIEWTOPIC) ) 
         { 
            $u_link = append_sid('cash.'.$phpEx.'?mode=modedit&amp;ref=viewtopic&'.POST_USERS_URL.'='.$view_userdata['user_id'].'&amp;'.POST_POST_URL.'='.$view_userdata['post_id']); 
            $l_name = sprintf($lang['Mod_usercash'],$view_userdata['username']); 
            $cash_amount = $c_cur->display($view_userdata[$c_cur->db()]).'<br />'; 
             if (($userdata['user_level'] == ADMIN) || (($userdata['user_level'] == MOD)) ) 
            { 
                $txt .= '<b>' . '<a href="' . $u_link . '">' . $cash_amount . '</a></b>'; 
            } 
            else 
               { 
                $txt .= $cash_amount; 
               } 
         }
			if ( $userdata['session_logged_in'] && (($cash->currency_count(CURRENCY_ENABLED | CURRENCY_EXCHANGEABLE) >= 2) || ($cash->currency_count(CURRENCY_ENABLED | CURRENCY_DONATE) && ($userdata['user_id'] != $view_userdata['user_id'])) || ($cash->currency_count() && (($userdata['user_level'] == ADMIN) || (($userdata['user_level'] == MOD) && $cash->currency_count(CURRENCY_ENABLED | CURRENCY_MODEDIT))))) )
			{
				if ( $cash->currency_count(CURRENCY_ENABLED | CURRENCY_EXCHANGEABLE) >= 2 )
				{
					$temp_url = append_sid("cash.$phpEx");
					$txt .= '<a href="' . $temp_url . '">' . $lang['Exchange'] . '</a>'.'<br />';
				}
				if ( $cash->currency_count(CURRENCY_ENABLED | CURRENCY_DONATE) && ($userdata['user_id'] != $view_userdata['user_id']) )
				{
					$temp_url = append_sid('cash.'.$phpEx.'?mode=donate&amp;ref=viewtopic&'.POST_USERS_URL.'='.$view_userdata['user_id'].'&amp;'.POST_POST_URL.'='.$view_userdata['post_id']);
                    $txt .= '<a href="' . $temp_url . '">' . $lang['Donate'] . '</a>';  
                    $img = '<a href="' . $temp_url . '"><img src="' . ( isset($images['icon_donate']) ? $images['icon_donate'] : '' ) . '" alt="' . $lang['Donate'] . '" border="0" /></a>';
				}
			}
        }
      $res = pcp_output_format($field_name, $txt, $img, $map_name);
   return $res; 
}	
//-----------------------------------
//
// user_cash profile output function
//
//-----------------------------------
function pcp_output_cashpr($field_name, $view_userdata, $map_name='')
{
   if($map_name == null) global $map_name;
   global $board_config, $phpbb_root_path, $phpEx, $lang, $images, $userdata;
   global $values_list, $tables_linked, $classes_fields, $user_maps, $user_fields;
   global $cash;

   $txt = '';
   $img = '';
   $res = '';
			if ( $board_config['cash_disable'])
			{
				return;
			}
         while ( $c_cur = &$cash->currency_next($cm_i,CURRENCY_ENABLED | CURRENCY_VIEWPROFILE) ) 
         { 
            $u_link = append_sid('cash.'.$phpEx.'?mode=modedit&amp;ref=viewprofile&amp;'.POST_USERS_URL.'='.$view_userdata['user_id']); 
            $l_name = sprintf($lang['Mod_usercash'],$view_userdata['username']); 
            $cash_amount = $c_cur->display($view_userdata[$c_cur->db()]).'<br />'; 
             if (($userdata['user_level'] == ADMIN) || (($userdata['user_level'] == MOD)) ) 
            { 
                $txt .= '<b>' . '<a href="' . $u_link . '">' . $cash_amount . '</a></b></span>'; 
            } 
            else 
               { 
                $txt .= $cash_amount; 
               }             
         }
			if ( $userdata['session_logged_in'] && (($cash->currency_count(CURRENCY_ENABLED | CURRENCY_EXCHANGEABLE) >= 2) || ($cash->currency_count(CURRENCY_ENABLED | CURRENCY_DONATE) && ($userdata['user_id'] != $view_userdata['user_id'])) || ($cash->currency_count() && (($userdata['user_level'] == ADMIN) || (($userdata['user_level'] == MOD) && $cash->currency_count(CURRENCY_ENABLED | CURRENCY_MODEDIT))))) )
			{
				if ( $cash->currency_count(CURRENCY_ENABLED | CURRENCY_EXCHANGEABLE) >= 2 )
				{
					$temp_url = append_sid("cash.$phpEx");
					$txt .= '<a href="' . $temp_url . '">' . $lang['Exchange'] . '</a>'.'<br />';
				}
				if ( $cash->currency_count(CURRENCY_ENABLED | CURRENCY_DONATE) && ($userdata['user_id'] != $view_userdata['user_id']) )
				{
					$temp_url = append_sid('cash.'.$phpEx.'?mode=donate&amp;ref=viewprofile&amp;'.POST_USERS_URL.'='.$view_userdata['user_id']);
                    $txt .= '<a href="' . $temp_url . '">' . $lang['Donate'] . '</a>';
				}
			}
      $res = pcp_output_format($field_name, $txt, $img, $map_name);
   return $res; 
}		
?>
