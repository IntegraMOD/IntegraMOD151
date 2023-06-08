<?php
/***************************************************************************
 *                                constants.php
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

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

// Define Table Constants
define('MODULES_TABLE', $table_prefix . 'modules');
define('MODULE_INFO_TABLE', $table_prefix . 'module_info');
define('STATS_CONFIG_TABLE', $table_prefix . 'stats_config');
define('CACHE_TABLE', $table_prefix . 'module_cache');
define('MODULE_ADMIN_TABLE', $table_prefix . 'module_admin_panel');
define('SMILIE_INDEX_TABLE', $table_prefix . 'stats_smilies_index');
define('SMILIE_INFO_TABLE', $table_prefix . 'stats_smilies_info');
define('MODULE_GROUP_AUTH_TABLE', $table_prefix . 'module_group_auth');

// define('STATS_DEBUG', true); // Debug Mode
define('STATS_DEBUG', false); // Disable Debug Mode

// Cache Defines
define('HIGHEST_PRIORITY', 100);
define('LOWEST_PRIORITY', 101);
define('EQUAL_PRIORITY', 102);

?>