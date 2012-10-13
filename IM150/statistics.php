<?php
/***************************************************************************
 *                                statistics.php
 *                            -------------------
 *   begin                : Wed, Jan 01, 2003
 *   copyright            : (C) 2003 Meik Sievertsen
 *   email                : acyd.burn@gmx.de
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

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);

include($phpbb_root_path . 'stats_mod/includes/constants.'.$phpEx);
include($phpbb_root_path . 'stats_mod/includes/lang_functions.'.$phpEx);
include($phpbb_root_path . 'stats_mod/includes/stat_functions.'.$phpEx);
include($phpbb_root_path . 'stats_mod/includes/template.'.$phpEx);
include($phpbb_root_path . 'stats_mod/core.'.$phpEx);

if (STATS_DEBUG)
{
	$m_time = microtime();    
	$m_time = explode(" ",$m_time);
	$m_time = $m_time[1] + $m_time[0];    
	$stats_starttime = $m_time; 
}

$sql = "SELECT * FROM " . STATS_CONFIG_TABLE;
	 
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not query statistics config table', '', __LINE__, __FILE__, $sql);
}

$stats_config = array();

while ($row = $db->sql_fetchrow($result))
{
	$stats_config[$row['config_name']] = trim($row['config_value']);
}

init_core();

if (isset($HTTP_GET_VARS['preview']))
{
	$preview_module = intval($HTTP_GET_VARS['preview']);
}
else
{
	$preview_module = -1;
}

if (($preview_module == -1) || ($preview_module == 0) || ($userdata['user_level'] != ADMIN))
{
	// Get all module informations about activated modules
	$modules = get_modules();
}
else
{
	// Get all module informations about given module_id (activated or not)
	$modules = get_modules(false, $preview_module);
	$core->do_not_use_cache = TRUE;
}

$sql = "SELECT config_value FROM " . CONFIG_TABLE . " WHERE config_name = 'default_lang'";
if (!($result = $db->sql_query($sql)))
{
	message_die(GENERAL_ERROR, 'Unable to query config table', '', __LINE__, __FILE__, $sql);
}

$row = $db->sql_fetchrow($result);
$default_board_lang = trim($row['config_value']);

//
// Include Language
//
$lang_failover = array($board_config['default_lang'], $default_board_lang, 'english');
$languages_to_include = array(
	'language/lang_xxx/lang_admin.' . $phpEx,
	'language/lang_xxx/lang_statistics.' . $phpEx,
	'modules/language/lang_xxx/lang_modules.' . $phpEx
);

for ($i = 0; $i < count($languages_to_include); $i++)
{
	$found = FALSE;

	for ($j = 0; $j < count($lang_failover) && !$found; $j++)
	{
		$language_file = $phpbb_root_path . str_replace('xxx', $lang_failover[$j], $languages_to_include[$i]);
	
		if ( @file_exists(@realpath($language_file)) )
		{
			@include_once($language_file);
			$found = TRUE;
			if (strstr($languages_to_include[$i], 'lang_modules'))
			{
				$core->used_language = $lang_failover[$j];
			}
		}
	}
}

if (trim($core->used_language) == '')
{
	$core->used_language = 'english';
}

$page_title = $lang['Board_statistics'];
include($phpbb_root_path . 'includes/page_header.'.$phpEx);

$development = FALSE;

/*
// MDK -> Develop a Module
$development = TRUE;

$dev_module = array();

$dev_module['short_name'] = 'stats_overview';
$dev_module['location'] = 'dev';
$dev_module['lang_path'] = 'dev/language';
*/

if ($development)
{
	$first_iterate = TRUE;

	$core->current_module_path = $phpbb_root_path . $dev_module['location'] . '/' . trim($dev_module['short_name']) . '/';
	$core->current_module_name = trim($dev_module['short_name']);
	$core->current_module_id = -1;
	$core->do_not_use_cache = TRUE;

	// Include Language File
	$language = $board_config['default_lang'];
	$language_file = $phpbb_root_path . $dev_module['lang_path'] . '/lang_' . $language . '/lang_modules.' . $phpEx;

	if ( !@file_exists(@realpath($language_file)) )
	{
		$language = $default_board_lang;
	}

	$language_file = $phpbb_root_path . $dev_module['lang_path'] . '/lang_' . $language . '/lang_modules.' . $phpEx;

	include($language_file);
	
	include($core->current_module_path . 'module.'.$phpEx);
}

$iterate_index = 0;
$iterate_end = count($modules);

while ($iterate_index < $iterate_end)
{
	$first_iterate = (($iterate_index == 0) && (!$development)) ? TRUE : FALSE;
	$last_iterate = ($iterate_index == $iterate_end-1) ? TRUE : FALSE;

	$core->current_module_path = $phpbb_root_path . 'modules/' . trim($modules[$iterate_index]['short_name']) . '/';
	$core->current_module_name = trim($modules[$iterate_index]['short_name']);
	$core->current_module_id = intval($modules[$iterate_index]['module_id']);

	// Set Language
	$keys = array();
	eval('$current_lang = $' . $core->current_module_name . ';');
		
	if (is_array($current_lang))
	{
		foreach ($current_lang as $key => $value)
		{
			$lang[$key] = $value;
			$keys[] = $key;
		}
	}

	include($core->current_module_path . 'module.'.$phpEx);

	$iterate_index++;

/*	// Empty Language - disabled, at the moment we need the old assignments
	for ($i = 0; $i < count($keys); $i++)
	{
		$lang[$keys[$i]] = '';		
	}
*/
}

$sql = "UPDATE " . STATS_CONFIG_TABLE . "
SET config_value = " . (intval($stats_config['page_views']) + 1) . "
WHERE (config_name = 'page_views')";

if (!$db->sql_query($sql))
{
	message_die(GENERAL_ERROR, 'Unable to Update View Counter', '', __LINE__, __FILE__, $sql);
}

if (STATS_DEBUG)
{
	if (!file_exists($phpbb_root_path . 'modules/cache/explain'))
	{
		@umask(0);
		mkdir($phpbb_root_path . 'modules/cache/explain', 0777);
	}

	$m_time = microtime(); 
	$m_time = explode(" ",$m_time); 
	$m_time = $m_time[1] + $m_time[0]; 
	$stats_endtime = $m_time; 
	$stats_totaltime = ($stats_endtime - $stats_starttime); 

	$template->assign_vars(array(
		'TIME' => $stats_totaltime,
		'SQL_TIME' => $stat_db->sql_time,
		'QUERY' => $stat_db->num_queries,
		'L_STATISTICS' => $lang['Statistics'], // Correct Titles :: Added
		'U_EXPLAIN' => append_sid($phpbb_root_path . 'modules/cache/explain/e' . $userdata['user_id'] . '.html'))
	);

	$template->assign_block_vars('switch_debug', array());

	if ($stat_db->sql_time > 0)
	{
		$fp = fopen($phpbb_root_path . 'modules/cache/explain/e' . $userdata['user_id'] . '.html', 'wt');
		fwrite($fp, $stat_db->sql_report);
		$str = "<pre><b>The Statistics Mod generated " . $stat_db->num_queries . " queries,\nspending " . $stat_db->sql_time . ' doing MySQL queries and ' . ($stats_totaltime - $stat_db->sql_time) . ' doing PHP things.</b></pre>';
		fwrite($fp, $str);
		fclose($fp);
	}

}

$template->set_filenames(array(
	'body' => 'statistics.tpl')
);

$template->pparse('body');

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>
