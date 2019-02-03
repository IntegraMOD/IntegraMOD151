<?php 
/*************************************************************************** 
 *                         blocks_imp_chat.php 
 *                            ------------------- 
 *   begin                : Saturday, March 20, 2004 
 *   copyright            : (C) 2004 masterdavid - Ronald John David 
 *   website              : http://www.integramod.com 
 *   email                : webmaster@integramod.com 
 * 
 *   note: removing the original copyright is illegal even you have modified 
 *         the code.  Just append yours if you have modified it. 
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
   die("Hacking attempt"); 
} 

if(!function_exists('imp_chat_block_func')) 
{ 
   function imp_chat_block_func() 
   { 
      global $template, $lang, $db, $theme, $phpEx, $lang, $board_config, $userdata, $phpbb_root_path, $table_prefix, $portal_config, $var_cache; 

      if(!$userdata['session_logged_in']) 
      { 
         $chat_link = $lang['Login_to_join_chat']; 
      } 
      else 
      { 
         $chat_link = "<a href=\"javascript:void(0);\" onClick=\"window.open('" . append_sid("chatspot/chatspot.$phpEx") . "','" . $userdata['user_id'] . '_chatspot' . "','scrollbars=no,width=540,height=450')\">" . $lang['Click_to_join_chat'] . "</a>"; 
      } 

      require_once( $phpbb_root_path . 'chatspot_front.' . $phpEx ); 

      $template->assign_vars(array( 
         // ChatBox Mod 
         'TOTAL_CHATTERS_ONLINE' => sprintf( $lang[ 'How_Many_Chatters' ], $num_users_in_chat ), 
         'CHATTERS_LIST' => '<b>' . $users_in_chat . '</b>', 
         'L_CHAT_LINK' => $chat_link
      ));
   } 
} 

imp_chat_block_func(); 

?>
