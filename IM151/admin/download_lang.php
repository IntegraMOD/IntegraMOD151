<?php
/***************************************************************************
*                           admin_stats_lang.php
*                            -------------------
*   begin                : Sat, Jan 04, 2003
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

//
// Let's set the root dir for phpBB
//
$phpbb_root_path = './../';
require($phpbb_root_path . 'extension.inc');
if (!empty($board_config))
{
	@include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_admin_statistics.' . $phpEx);
}

$no_page_header = true;
require('pagestart.' . $phpEx);

if( isset($_POST['mode']) || isset($_GET['mode']) )
{
	$mode = ( isset($_POST['mode']) ) ? $_POST['mode'] : $_GET['mode'];
}
else
{
	$mode = '';
}

@include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_admin_statistics.' . $phpEx);
@include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_statistics.' . $phpEx);
include($phpbb_root_path . 'stats_mod/includes/constants.'.$phpEx);

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

include($phpbb_root_path . 'stats_mod/includes/lang_functions.'.$phpEx);
include($phpbb_root_path . 'stats_mod/includes/stat_functions.'.$phpEx);
include($phpbb_root_path . 'stats_mod/includes/admin_functions.'.$phpEx);

if ($mode == 'export_module')
{
	$module_id = (isset($_GET['module'])) ? intval($_GET['module']) : -1;
	$language = (isset($_GET['lang'])) ? trim($_GET['lang']) : '';
		
	if (($language == '') || ($module_id == -1))
	{
		message_die(GENERAL_MESSAGE, 'Invalid Call, Hacking Attempt ?');
	}
		
	$sql = "SELECT short_name FROM " . MODULES_TABLE . " WHERE module_id = " . $module_id;

	if (!($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Unable to get short name', "", __LINE__, __FILE__, $sql);
	}
	
	if ($db->sql_numrows($result) == 0)
	{
		message_die(GENERAL_ERROR, 'Unable to get Module ' . $module_id);
	}
		
	$row = $db->sql_fetchrow($result);
	$short_name = trim($row['short_name']);
	
	if (!($fp = fopen($phpbb_root_path . 'modules/cache/temp.pak', 'wb')))
	{
		message_die(GENERAL_ERROR, 'Unable to write Package File to cache.');
	}

	$language_content = get_lang_entries($short_name, $language);

	fwrite($fp, pack("C*", 0xFF, 0xFC, 0xCC), 3);
	fwrite($fp, 'LANGPACK', 8);
	fwrite($fp, pack("C*", 0xCC, 0xFC, 0xFF), 3);
	
	$content = '<?php' . "\n\n";
	$content .= '// [' . $language . ']' . "\n";
	$content .= '// [module:' . $short_name . ']' . "\n";

	for ($i = 0; $i < count($language_content); $i++)
	{
		$content .= '$lang[\'' . $language_content[$i]['key'] . '\'] = \'' . $language_content[$i]['value'] . '\';' . "\n";
	}

	$content .= '// [/module:' . $short_name . ']' . "\n";
	$content .= '// [/' . $language . ']' . "\n\n";
	$content .= '?>';

	$size = strlen($content);
	fwrite($fp, $content, $size);
	fwrite($fp, pack("C*", 0xCC, 0xCC, 0xFF), 3);
	fwrite($fp, 'LANGPACK', 8);
	fwrite($fp, pack("C*", 0xFF, 0xCC, 0xCC), 3);

	fclose($fp);

	$content = implode('', file($phpbb_root_path . 'modules/cache/temp.pak'));
	
	@chmod($phpbb_root_path . 'modules/cache/temp.pak', 0666);
	@unlink($phpbb_root_path . 'modules/cache/temp.pak');

	$filename = $short_name . '_' . str_replace('lang_', '', $language) . '.pak';
	
	header("Content-Type: text/x-delimtext; name=\"" . $filename . "\"");
	header("Content-disposition: attachment; filename=" . $filename);

	echo $content;
}
else if ($mode == 'export_lang')
{
	$language = (isset($_GET['lang'])) ? trim($_GET['lang']) : '';
		
	if ($language == '')
	{
		message_die(GENERAL_MESSAGE, 'Invalid Call, Hacking Attempt ?');
	}
		
	$sql = "SELECT short_name FROM " . MODULES_TABLE;

	if (!($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Unable to get short name', "", __LINE__, __FILE__, $sql);
	}
	
	if ($db->sql_numrows($result) == 0)
	{
		message_die(GENERAL_ERROR, 'Unable to get Modules.');
	}
		
	$rows = $db->sql_fetchrowset($result);
	$num_rows = $db->sql_numrows($result);
	
	if (!($fp = fopen($phpbb_root_path . 'modules/cache/temp.pak', 'wb')))
	{
		message_die(GENERAL_ERROR, 'Unable to write Package File to cache.');
	}

	fwrite($fp, pack("C*", 0xFF, 0xFC, 0xCC), 3);
	fwrite($fp, 'LANGPACK', 8);
	fwrite($fp, pack("C*", 0xCC, 0xFC, 0xFF), 3);
	$content = '<?php' . "\n\n";
	$content .= '// [' . $language . ']' . "\n";

	for ($i = 0; $i < $num_rows; $i++)
	{
		$short_name = trim($rows[$i]['short_name']);
		$language_content = get_lang_entries($short_name, $language);
	
		$content .= '// [module:' . $short_name . ']' . "\n";

		for ($j = 0; $j < count($language_content); $j++)
		{
			$content .= '$lang[\'' . $language_content[$j]['key'] . '\'] = \'' . $language_content[$j]['value'] . '\';' . "\n";
		}

		$content .= '// [/module:' . $short_name . ']' . "\n\n";
	}

	$content .= '// [/' . $language . ']' . "\n\n";
	$content .= '?>';

	$size = strlen($content);
	fwrite($fp, $content, $size);
	fwrite($fp, pack("C*", 0xCC, 0xCC, 0xFF), 3);
	fwrite($fp, 'LANGPACK', 8);
	fwrite($fp, pack("C*", 0xFF, 0xCC, 0xCC), 3);

	fclose($fp);

	$content = implode('', file($phpbb_root_path . 'modules/cache/temp.pak'));
	
	@chmod($phpbb_root_path . 'modules/cache/temp.pak', 0666);
	@unlink($phpbb_root_path . 'modules/cache/temp.pak');

	$filename = $language . '.pak';
	
	header("Content-Type: text/x-delimtext; name=\"" . $filename . "\"");
	header("Content-disposition: attachment; filename=" . $filename);

	echo $content;
}
else if ($mode == 'export_everything')
{
	$sql = "SELECT short_name FROM " . MODULES_TABLE;

	if (!($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Unable to get short name', "", __LINE__, __FILE__, $sql);
	}
	
	if ($db->sql_numrows($result) == 0)
	{
		message_die(GENERAL_ERROR, 'Unable to get Modules.');
	}
		
	$rows = $db->sql_fetchrowset($result);
	$num_rows = $db->sql_numrows($result);
	
	$languages = get_all_installed_languages();
		
	if (!($fp = fopen($phpbb_root_path . 'modules/cache/temp.pak', 'wb')))
	{
		message_die(GENERAL_ERROR, 'Unable to write Package File to cache.');
	}

	fwrite($fp, pack("C*", 0xFF, 0xFC, 0xCC), 3);
	fwrite($fp, 'LANGPACK', 8);
	fwrite($fp, pack("C*", 0xCC, 0xFC, 0xFF), 3);
	$content = '<?php' . "\n\n";
	
	foreach ($languages as $language)
	{
		$content .= '// [' . $language . ']' . "\n";

		for ($i = 0; $i < $num_rows; $i++)
		{
			$short_name = trim($rows[$i]['short_name']);
			$language_content = get_lang_entries($short_name, $language);
	
			$content .= '// [module:' . $short_name . ']' . "\n";

			for ($j = 0; $j < count($language_content); $j++)
			{
				$content .= '$lang[\'' . $language_content[$j]['key'] . '\'] = \'' . $language_content[$j]['value'] . '\';' . "\n";
			}

			$content .= '// [/module:' . $short_name . ']' . "\n\n";
		}

		$content .= '// [/' . $language . ']' . "\n\n";
	}
	
	$content .= '?>';

	$size = strlen($content);
	fwrite($fp, $content, $size);
	fwrite($fp, pack("C*", 0xCC, 0xCC, 0xFF), 3);
	fwrite($fp, 'LANGPACK', 8);
	fwrite($fp, pack("C*", 0xFF, 0xCC, 0xCC), 3);

	fclose($fp);

	$content = implode('', file($phpbb_root_path . 'modules/cache/temp.pak'));
	
	@chmod($phpbb_root_path . 'modules/cache/temp.pak', 0666);
	@unlink($phpbb_root_path . 'modules/cache/temp.pak');

	$filename = 'statsv3_lang.pak';
	
	header("Content-Type: text/x-delimtext; name=\"" . $filename . "\"");
	header("Content-disposition: attachment; filename=" . $filename);

	echo $content;
}


exit;

?>