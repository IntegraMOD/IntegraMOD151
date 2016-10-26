<?php
/*************************************************************************** 
 *                              pseudocron.php 
 *                            ------------------- 
 *   begin                : Tuesday, Aug 12, 2003 
 *   copyright            : (C) 2003 Xore 
 *   email                : xore@azuriah.com 
 * 
 * 
 * 
 ***************************************************************************/ 

/*************************************************************************** 
 * 
 * Note: if you're a mod author and want to add stuff to this file in your 
 *       mods, make sure your new content doesn't contain switch statements 
 *       with a default clause, since i use the 'default:' in the main 
 *       function as a unique line to specify entry points for queue 
 *       additions. 
 * 
 ***************************************************************************/ 
if ( !defined('IN_PHPBB') )
{
  die("Hacking attempt");
}

function cron_test() 
{ 
   global $db; 
   $sql = "UPDATE " . CONFIG_TABLE . " 
         SET config_value = config_value + 1 
         WHERE config_name = 'crontest'"; 
   if ( !($db->sql_query($sql)) ) 
   { 
//      message_die(GENERAL_ERROR, 'Error updating cron test', '', __LINE__, __FILE__, $sql);
   } 
   return true; 
}

$current_time = time();
if ( ($board_config['nextcron'] < $current_time) && $board_config['pseudocron'] ) 
{ 
	ignore_user_abort(); 
	cron_test();
	$temp_value = $board_config['nextcron'];
	while($temp_value < $current_time)
	{
		$temp_value = $temp_value + 3600;
	}
	$sql = "UPDATE " . CONFIG_TABLE . " 
		SET config_value = $temp_value
		WHERE config_name = 'nextcron'"; 
	if ( !($db->sql_query($sql)) ) 
	{ 
	//		message_die(GENERAL_ERROR, 'Error updating cron status', '', __LINE__, __FILE__, $sql); 
	} 
	include('./mail_digests.' . $phpEx);
} 

?>
