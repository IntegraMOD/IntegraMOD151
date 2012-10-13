<?php 
/*************************************************************************** 
 *                              admin_cron.php 
 *                            ------------------- 
 *   begin                : Thursday, Apr 17, 2003 
 *   copyright            : (C) 2003 Xore 
 *   email                : xore@azuriah.com 
 * 
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
 ***************************************************************************/ 

define('IN_PHPBB', 1); 

if ( !empty($setmodules) ) 
{ 
   $file = basename(__FILE__); 
   $module['Pseudocron']['Cron Configuration'] = "$file?mode=config"; 
   return; 
} 

// 
// Let's set the root dir for phpBB 
// 
$phpbb_root_path = "./../"; 
require($phpbb_root_path . 'extension.inc'); 
require('./pagestart.' . $phpEx); 
include($phpbb_root_path.'language/lang_' . $board_config['default_lang'] . '/lang_admin_cron.'.$phpEx);
include($phpbb_root_path . 'includes/functions_selects.'.$phpEx); 

$new = array(); 
// 
// Pull all config data 
// 
$sql = "SELECT * 
   FROM " . CONFIG_TABLE; 
if ( !$result = $db->sql_query($sql) ) 
{ 
   message_die(CRITICAL_ERROR, "Could not query config information", "", __LINE__, __FILE__, $sql); 
} 
$allowed_array = array( 'pseudocron' => true); 
while ( $row = $db->sql_fetchrow($result) ) 
{ 
   $config_name = $row['config_name']; 
   $config_value = $row['config_value']; 
   $default_config[$config_name] = $config_value; 
    
   $new[$config_name] = $default_config[$config_name]; 

   if ( $allowed_array[$config_name] && 
       isset($HTTP_POST_VARS['submit']) && 
       isset($HTTP_POST_VARS[$config_name]) ) 
   { 
      $new[$config_name] = stripslashes($HTTP_POST_VARS[$config_name]); 
      $sql = "UPDATE " . CONFIG_TABLE . " SET 
         config_value = '" . addslashes($new[$config_name]) . "' 
         WHERE config_name = '$config_name'"; 
      if ( !$db->sql_query($sql) ) 
      { 
         message_die(GENERAL_ERROR, "Failed to update Cron configuration for $config_name", "", __LINE__, __FILE__, $sql); 
      } 
   } 
} 
    
if ( isset($HTTP_POST_VARS['submit']) ) 
{ 
   $message = $lang['Pseudocron_config_updated'] . "<br /><br />" . sprintf($lang['Click_return_pseudocron_config'], "<a href=\"" . append_sid("admin_cron.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>"); 

   message_die(GENERAL_MESSAGE, $message); 
} 

$enable_pseudocron_yes = ( $new['pseudocron'] ) ? "checked=\"checked\"" : ""; 
$enable_pseudocron_no = ( !$new['pseudocron'] ) ? "checked=\"checked\"" : ""; 

// nextcron stuff 
$nc = intval($new['nextcron']) - time(); 
$nc_string = ""; 

$nc_days = floor($nc / 86400 ); 
$nc = $nc - ($nc_days * 86400); 

$nc_hours = floor($nc / 3600 ); 
$nc = $nc - ($nc_hours * 3600); 

$nc_minutes = floor($nc / 60 ); 
$nc_seconds = $nc - ($nc_minutes * 60); 

$nc_string = (($nc_seconds > 9)?("$nc_seconds"):("0$nc_seconds")); 
$nc_string = (($nc_minutes > 9)?("$nc_minutes"):("0$nc_minutes")) . ":" . $nc_string; 
if($nc_days) 
{ 
   $nc_string = $nc_days . ", " . $nc_hours . ":" . $nc_string; 
} 
else if($nc_hours) 
{ 
   $nc_string = $nc_hours . ":" . $nc_string; 
} 


$template->set_filenames(array( 
   "body" => "admin/admin_cron.tpl") 
); 

$template->assign_vars(array( 
   "S_PSEUDOCRON_ACTION" => append_sid("admin_cron.$phpEx"), 

   "L_YES" => $lang['Yes'], 
   "L_NO" => $lang['No'], 
   "L_PSEUDOCRON_TITLE" => $lang['Pseudocron'], 
   "L_PSEUDOCRON_EXPLAIN" => $lang['Pseudocron_explain'], 

   "L_ENABLE_PSEUDOCRON" => $lang['Enable_pseudocron'], 
   "L_ENABLE_PSEUDOCRON_EXPLAIN" => $lang['Enable_pseudocron_explain'], 

   "L_NEXTCRON" => $lang['Nextcron'], 
   "L_NEXTCRON_EXPLAIN" => $lang['Nextcron_explain'], 
   "L_CRONTEST" => $lang['Crontest'], 

   "L_SUBMIT" => $lang['Submit'], 
   "L_RESET" => $lang['Reset'], 
    
   "ENABLE_PSEUDOCRON_YES" => $enable_pseudocron_yes, 
   "ENABLE_PSEUDOCRON_NO" => $enable_pseudocron_no, 
    
   "NEXTCRON_NUMBER" => date("F j [ h:i a ]",$new['nextcron']), 
   "NEXTCRON_MINUTES" => $nc_string, 
   "CRONTEST" => $new['crontest'] 
   ) 
); 

$template->pparse("body"); 

include('./page_footer_admin.'.$phpEx); 

?>