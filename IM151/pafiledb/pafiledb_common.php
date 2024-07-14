<?php
/***************************************************************************
 *                                pafiledb_common.php
 *                            -------------------
 *   begin                : Saturday, Feb 23, 2001
 *   copyright            : (C) 2003 Mohd Web Site!
 *   email                : mohdalbasri@hotmail.com
 *
 *   $Id:
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

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}


//===================================================
// addslashes to vars if magic_quotes_gpc is off
//===================================================
if(!@function_exists('slash_input_data'))
{
	function slash_input_data(&$data)
	{
		if (is_array($data))
		{
			foreach ($data as $k => $v)
			{
				$data[$k] = (is_array($v)) ? slash_input_data($v) : addslashes($v);
			}
		}
		return $data;
	}
}

if (!function_exists('get_magic_quotes_gpc') || !get_magic_quotes_gpc())
{
	$_GET = slash_input_data($_GET);
	$_POST = slash_input_data($_POST);
	$_COOKIE = slash_input_data($_COOKIE);
	$_REQUEST = slash_input_data($_REQUEST);
}


//===================================================
// Get Language
//===================================================

$language = $board_config['default_lang'];

if( !file_exists($phpbb_root_path . 'language/lang_' . $language . '/lang_pafiledb.'.$phpEx) )
{
   $language = 'english';
}

if( !file_exists($phpbb_root_path . 'language/lang_' . $language . '/lang_admin_pafiledb.'.$phpEx) )
{
   $language = 'english';
}

include($phpbb_root_path . 'language/lang_' . $language . '/lang_pafiledb.' . $phpEx);
include($phpbb_root_path . 'language/lang_' . $language . '/lang_admin_pafiledb.' . $phpEx);

//===================================================
// Include pafiledb data file
//===================================================

include($phpbb_root_path . 'pafiledb/includes/pafiledb_constants.'.$phpEx);
include($phpbb_root_path . 'pafiledb/includes/functions_cache.'.$phpEx);
include($phpbb_root_path . 'pafiledb/includes/functions.'.$phpEx);
include($phpbb_root_path . 'pafiledb/includes/template.'.$phpEx);
include($phpbb_root_path . 'pafiledb/includes/functions_pafiledb.'.$phpEx);

$cache = new acm();
$pafiledb_functions = new pafiledb_functions();

if ($cache->exists('config'))
{
	$pafiledb_config = $cache->get('config');
}
else
{
	$pafiledb_config = $pafiledb_functions->pafiledb_config();
	$cache->put('config', $pafiledb_config);
}

$pafiledb_user = new user_info();
$pafiledb_template = new pafiledb_template();
$pafiledb_template->set_template($theme['template_name']);

$pafiledb = new pafiledb_public();

?>
