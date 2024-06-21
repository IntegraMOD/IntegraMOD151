<?php
/***************************************************************************
*							class_color.php
*							--------------
*	begin		: 2005/08/16
*	copyright	: phantomk
*	email		: phantomk@hackbb.com
*
*	Version		: 0.0.35 - 2006/07/03
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

if (!defined('IN_PHPBB'))
{
	die("Hacking attempt");
}

//
// AGCM version
//
define('AGCM_CURRENT_VERSION', '1.2.5');

//
// AGCM Table Name
//
define('COLOR_TABLE', $table_prefix.'color');

//
// Default Group Values
//
if ( !defined('GROUP_REGISTERED') && !empty($board_config['group_registered']) )
{
	define('GROUP_REGISTERED', $board_config['group_registered']);
}

if ( !defined('GROUP_ANONYMOUS') && !empty($board_config['group_anonymous']) )
{
	define('GROUP_ANONYMOUS', $board_config['group_anonymous']);
}

if ( !empty($board_config['group_session']) )
{
	define('GROUP_SESSION', $board_config['group_session']);
}

//
// AGCM URL Paramerters
//
define('POST_STYLES_URL', 's');

if ( empty($installed_mods) )
{
	$installed_mods = array();
	$installed_mods[0] = array('name' => 'advanced_group_color_management', 'installed' => AGCM_CURRENT_VERSION);
}
else
{
	$count_installed_mods = count($installed_mods);
	$installed_mods[$count_installed_mods] = array('name' => 'advanced_group_color_management', 'installed' => AGCM_CURRENT_VERSION);
}

function group_color_select()
{
	global $view_user, $user, $db;

	$list_color = array();

	$sql = 'SELECT group_id
			FROM ' . GROUPS_TABLE . '
			WHERE group_color = 1
				AND group_id = ' . GROUP_REGISTERED;
	$result = $db->sql_query($sql, false, __LINE__, __FILE__);

	if ( $row = $db->sql_fetchrow($result) )
	{
		$list_color[GROUP_REGISTERED] = 'Group_registered';
	}

	$db->sql_freeresult($result);

	if ( empty($view_user) )
	{
		$user_id = $user->data['user_id'];
	}
	else
	{
		$user_id = $view_user->data['user_id'];
	}

	$sql = 'SELECT g.group_id, g.group_name
			FROM ' . USER_GROUP_TABLE . ' ug, ' . GROUPS_TABLE . ' g
			WHERE ug.user_id = ' . intval($user_id) . '
				AND g.group_id = ug.group_id
				AND g.group_color = 1
				AND ug.user_pending <> 1
			ORDER BY g.group_weight ASC';
	$result = $db->sql_query($sql, false, __LINE__, __FILE__);

	while ( $group_data = $db->sql_fetchrow($result) )
	{
		$list_color[ intval($group_data['group_id']) ] = $group_data['group_name'];
	}

	$db->sql_freeresult($result);

	return $list_color;
}

function _lang_check($var, $check=false)
{
	global $lang;

	if ( empty($lang[$var]) && $check )
	{
		return false;
	}
	else if ( $check )
	{
		return true;
	}

	if ( !empty($lang[$var]) )
	{
		return $lang[$var];
	}
	else
	{
		return $var;
	}
}

class phpbb_color extends agcm_color
{
	var $cache_dir;

	function read($force=false)
	{
		global $phpbb_root_path, $phpEx;

		$this->data = array();
		$this->cache_dir = $phpbb_root_path . 'cache/';

		$sql = 'SELECT group_id, group_type, group_name, group_description
				FROM ' . GROUPS_TABLE . '
				WHERE group_legend = 1
					AND group_color = 1
				ORDER BY group_weight ASC';
		$cache_file = $this->cache_dir . 'agcm_data.' . $phpEx;
		$cache_time = time();

		//
		// Generate the cache for the first time or force the cache to regenerate
		//
		if ( $force || !file_exists($cache_file) )
		{
			$this->data = $this->write_cache($sql, $cache_file, $cache_time);
		}
		else
		{
			include($cache_file);

			//
			// Regenerate the cache if it is older then a day
			//
			if ( ($cache_time - $gentime) > 86400 )
			{
				$this->data = $this->write_cache($sql, $cache_file, $cache_time);
			}
			else
			{
				$this->data = $data;
			}

			unset($data);
			unset($gentime);
			unset($cache_time);
			unset($cache_file);
		}
	}

	function read_theme($themes_id, $force=false)
	{
		global $phpbb_root_path, $phpEx, $board_config;

		if ( empty($board_config['mod_advanced_group_color_management']) )
		{
			return;
		}

		$sql = 'SELECT group_id, color_code, hover_bold, hover_italic, hover_underline, bold, italic, underline
				FROM ' . COLOR_TABLE . '
				WHERE themes_id = ' . intval($themes_id) . '
				ORDER BY group_id ASC';
		$cache_file = $this->cache_dir . 'agcm_data_theme_' . intval($themes_id) . '.' . $phpEx;
		$cache_time = time();

		//
		// Generate the cache for the first time or force the cache to regenerate
		//
		if ( $force || !file_exists($cache_file) )
		{
			$this->color_data = $this->write_cache($sql, $cache_file, $cache_time);
		}
		else
		{
			include($cache_file);

			//
			// Regenerate the cache if it is older then a day
			//
			if ( ($cache_time - $gentime) > 86400 )
			{
				$this->color_data = $this->write_cache($sql, $cache_file, $cache_time);
			}
			else
			{
				$this->color_data = $data;
			}
		}

		unset($data);
		unset($gentime);
		unset($cache_time);
		unset($cache_file);
	}

	function write_cache($sql, $cache_file, $cache_time)
	{
		global $db;

		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, "Couldn't retrieve group color's data.", "", __LINE__, __FILE__, $sql);
		}

    $data = [];
		while ( $row = $db->sql_fetchrow($result) )
		{
			$data[] = $row;
		}

		$db->sql_freeresult($result);

		$tpl_data = '<' . '?php

if ( !defined(\'IN_PHPBB\') )
{
	die(\'Hack attempt\');
}

$gentime = %s;
$data = %s;

?' . '>';

		// output to file
		$handle = @fopen($cache_file, 'w');
		if (@flock($handle, LOCK_EX)) {
			@fwrite($handle, sprintf($tpl_data, $cache_time, var_export($data, true)));
			@flock($handle, LOCK_UN);
		}
		@fclose($handle);
		@umask(0000);
		@chmod($cache_file, 0644);

		return $data;
	}

	function lang()
	{
		global $phpbb_root_path, $phpEx, $board_config, $lang;

		$language = $board_config['default_lang'];

		if ( !file_exists( $phpbb_root_path . 'language/lang_' . $language . '/lang_extend_color.' . $phpEx ) )
		{
			$language = 'english';
		}

		include( $phpbb_root_path . 'language/lang_' . $language . '/lang_extend_color.' . $phpEx );
	}

	function group_color_select($group_id, $user_id='')
	{
		global $userdata, $db;

		$user_group_color = array();

		$sql = 'SELECT group_id, group_name
				FROM ' . GROUPS_TABLE . '
				WHERE group_color = 1
					AND group_id = ' . GROUP_REGISTERED;
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, "Couldn't obtain user's group data.", "", __LINE__, __FILE__, $sql);
		}

		if ( $row = $db->sql_fetchrow($result) )
		{
			$user_group_color[] = $row;
		}

		$db->sql_freeresult($result);

		if ( empty($user_id) )
		{
			$sql = 'SELECT g.group_id, g.group_name
					FROM ' . USER_GROUP_TABLE . ' ug, ' . GROUPS_TABLE . ' g
					WHERE ug.user_id = ' . intval($userdata['user_id']) . '
						AND g.group_id = ug.group_id
						AND g.group_color = 1
						AND ug.user_pending <> 1
					ORDER BY g.group_weight ASC';
		}
		else
		{
			$sql = 'SELECT g.group_id, g.group_name
					FROM ' . USER_GROUP_TABLE . ' ug, ' . GROUPS_TABLE . ' g
					WHERE ug.user_id = ' . intval($user_id) . '
						AND g.group_id = ug.group_id
						AND g.group_color = 1
						AND ug.user_pending <> 1
					ORDER BY g.group_weight ASC';
		}

		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, "Couldn't obtain user's group data.", "", __LINE__, __FILE__, $sql);
		}

		while ( $row = $db->sql_fetchrow($result) )
		{
			$user_group_color[] = $row;
		}

		$db->sql_freeresult($result);

		$group_color_select = '<select name="user_group_id">';

		for ($i = 0; $i < count($user_group_color); $i++)
		{
			$selected = ( $group_id == $user_group_color[$i]['group_id'] ) ? ' selected="selected"' : '';
			$group_color_select .= '<option value="' . $user_group_color[$i]['group_id'] . '"' . $selected . '>' . _lang_check($user_group_color[$i]['group_name']) . '</option>';
		}

		$group_color_select .= '</select>';

		return $group_color_select;
	}

	function display_legend()
	{
		global $template, $phpEx, $phpbb_root_path;

		if ( !empty($this->data) && count($this->data) != 0 )
		{
			for ($i = 0; $i < count($this->data); $i++)
			{
				$template->assign_block_vars('legend', array(
					"U_GROUP" => in_array($this->data[$i]['group_id'], array_keys($this->group_ids)) ? append_sid($phpbb_root_path . "memberlist.". $phpEx) : append_sid($phpbb_root_path . "groupcp.". $phpEx ."?" . POST_GROUPS_URL . "=". $this->data[$i]['group_id']),
					"GROUP_DESCRIPTION" => _lang_check($this->data[$i]['group_description']),
					"GROUP_NAME" => _lang_check($this->data[$i]['group_name']),
					"GROUP_COLOR" =>  $this->get_user_color($this->data[$i]['group_id']),
				));

				$template->assign_block_vars('legend.color', array(
					"L_COMMA" => '[&nbsp;',
					"L_COMMA2" => '&nbsp;]&nbsp;',
				));
			}
		}
	}
}

class agcm_color
{
	var $data;
	var $color_data;
	var $users;
	var $group_ids;

	function set_vars()
	{
		$this->group_ids = array(
			GROUP_REGISTERED => true,
			GROUP_ANONYMOUS => true,
			GROUP_SESSION => true,
		);
	}

	function add_group($group_id)
	{
		global $db;

		$sql = 'SELECT themes_id
				FROM ' . COLOR_TABLE . '
				WHERE group_id = ' . intval($group_id);
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, "Couldn't obtain color data.", "", __LINE__, __FILE__, $sql);
		}

		$group_ids = array();

		while ( $row = $db->sql_fetchrow($result) )
		{
			$group_ids[ intval($row['themes_id']) ] = true;
		}

		$db->sql_freeresult($result);

		$sql = 'SELECT themes_id
				FROM ' . THEMES_TABLE;
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, "Couldn't obtain theme data.", "", __LINE__, __FILE__, $sql);
		}

		$sql_insert = '';

		while ( $row = $db->sql_fetchrow($result) )
		{
			if ( !$group_ids[$row['themes_id']] )
			{
				$sql_insert .= ( ( empty($sql_insert) ) ? '' : ', ' ) . '(' . intval($group_id) . ', ' . intval($row['themes_id']) . ')' ;
			}
		}

		$db->sql_freeresult($result);

		$sql = 'INSERT INTO ' . COLOR_TABLE . '
				(group_id, themes_id) VALUES ' . $sql_insert;
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Couldn't insert data into color table.", "", __LINE__, __FILE__, $sql);
		}

		$this->set_group_weight();
		$this->read(true);
	}

	function add_theme($themes_id)
	{
		global $db;

		$sql = 'SELECT group_id
				FROM ' . COLOR_TABLE . '
				WHERE themes_id = ' . intval($themes_id);
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, "Couldn't obtain theme data.", "", __LINE__, __FILE__, $sql);
		}

		$themes_ids = array();

		while ( $row = $db->sql_fetchrow($result) )
		{
			$themes_ids[ intval($row['group_id']) ] = true;
		}

		$db->sql_freeresult($result);

		$sql = 'SELECT group_id
				FROM ' . GROUPS_TABLE . '
				WHERE ( group_single_user <> ' . true . ' )
					OR group_id IN (' . implode(', ', array_keys($this->group_ids)) . ')
				ORDER BY group_weight ASC';
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, "Couldn't query group data.", "", __LINE__, __FILE__, $sql);
		}

		$sql_insert = '';

		while ( $row = $db->sql_fetchrow($result) )
		{
			if ( !$themes_ids[$row['group_id']] )
			{
				$sql_insert .= ( ( empty($sql_insert) ) ? '' : ', ' ) . '(' . intval($row['group_id']) . ', ' . intval($themes_id) . ')' ;
			}
		}

		$db->sql_freeresult($result);

		$sql = 'INSERT INTO ' . COLOR_TABLE . '
				(group_id, themes_id) VALUES ' . $sql_insert;
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Couldn't insert theme into color table.", "", __LINE__, __FILE__, $sql);
		}

		$this->read_theme($themes_id, true);
	}

	function remove_group($group_id)
	{
		global $db;

		$sql = 'DELETE FROM ' . COLOR_TABLE . '
					WHERE group_id = ' . intval($group_id);
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Couldn't remove group from color table.", "", __LINE__, __FILE__, $sql);
		}

		$this->set_group_weight();
		$this->read(true);
	}

	function remove_theme($themes_id)
	{
		global $db;

		$sql = 'DELETE FROM ' . COLOR_TABLE . '
				WHERE themes_id = ' . intval($themes_id);
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Couldn't remove theme from color table.", "", __LINE__, __FILE__, $sql);
		}

		$this->read_theme($themes_id, true);
	}

	function read_group_users($group_id, $new_group=false)
	{
		global $db;

		if ( $group_id == GROUP_REGISTERED )
		{
			return;
		}

		$this->users = array();

		$sql = 'SELECT ug.user_id
				FROM ' . USER_GROUP_TABLE . ' ug
					' . ( $new_group ? '' : 'LEFT JOIN ' . USERS_TABLE . ' u ON u.user_id = ug.user_id AND u.user_group_id = ' . intval($group_id) ). '
				WHERE ug.group_id = ' . intval($group_id) . '
					AND ug.user_pending <> 1
				GROUP BY ug.user_id';
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, "Couldn't obtain user_id's.", "", __LINE__, __FILE__, $sql);
		}

		while ( $row = $db->sql_fetchrow($result) )
		{
			$this->users[ intval($row['user_id']) ] = true;
		}

		$db->sql_freeresult($result);
	}

	function set_group_users($group_id, $delete=false)
	{
		global $db;

		if ( $group_id == GROUP_REGISTERED || empty($this->users) )
		{
			return;
		}

		$sql = 'UPDATE ' . USERS_TABLE . '
				SET user_group_id = ' . GROUP_REGISTERED . '
				WHERE user_id IN (' . implode(', ' , array_keys($this->users)) . ')
				AND user_group_id = ' . intval($group_id);
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Couldn't update user_group_id.", "", __LINE__, __FILE__, $sql);
		}

		if ( $delete )
		{
			return;
		}

		$this->users = array();

		$sql = 'SELECT user_id
				FROM ' . USER_GROUP_TABLE . '
				WHERE group_id = ' . intval($group_id) . '
					AND user_pending <> 1
				GROUP BY user_id';
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, "Couldn't obtain user_id's.", "", __LINE__, __FILE__, $sql);
		}

		while ( $row = $db->sql_fetchrow($result) )
		{
			$this->users[ intval($row['user_id']) ] = true;
		}

		$db->sql_freeresult($result);

		$sql = 'UPDATE ' . USERS_TABLE . '
				SET user_group_id = ' . intval($group_id) . '
				WHERE user_id IN (' . implode(', ' , array_keys($this->users)) . ')
				AND user_group_id = ' . GROUP_REGISTERED;
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Couldn't update user_group_id.", "", __LINE__, __FILE__, $sql);
		}
	}

	function set_users_color()
	{
		global $db;

		$sql = 'SELECT group_id
				FROM ' . GROUPS_TABLE . '
				WHERE group_single_user <> ' . true . '
					AND group_color = 1
				ORDER BY group_id ASC';
		if ( !($group_result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, "Couldn't retrieve group data.", "", __LINE__, __FILE__, $sql);
		}

		while ($row = $db->sql_fetchrow($group_result))
		{
			$group_id = $row['group_id'];

			$sql = 'SELECT user_id
					FROM ' . USER_GROUP_TABLE . '
					WHERE group_id = ' . intval($group_id) . '
						AND user_pending <> 1
					GROUP BY user_id';
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, "Couldn't obtain user_id's.", "", __LINE__, __FILE__, $sql);
			}

			$user_ids = array(0);

			while ($row = $db->sql_fetchrow($result))
			{
				if ( !in_array($row['user_id'], $user_ids) )
				{
					$user_ids[ intval($row['user_id']) ] = true;
				}
			}

			$db->sql_freeresult($result);

			if ( !empty($user_ids) )
			{
				$sql = 'UPDATE ' . USERS_TABLE . '
						SET user_group_id = ' . intval($group_id) . '
						WHERE user_id IN (' . implode(', ' , array_keys($user_ids)) . ')
						AND user_group_id <> ' . GROUP_REGISTERED;
				if ( !$db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, "Couldn't update user_group_id.", "", __LINE__, __FILE__, $sql);
				}
			}
		}

		$db->sql_freeresult($group_result);
	}

	function set_group_weight()
	{
		global $db;

		$order = 0;

		$sql = 'SELECT group_id
				FROM ' . GROUPS_TABLE . '
				WHERE ( group_single_user <> ' . true . ' )
					OR group_id IN (' . implode(', ', array_keys($this->group_ids)) . ')
				ORDER BY group_weight ASC';
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, "Couldn't query group weight data.", "", __LINE__, __FILE__, $sql);
		}

		while ( $row = $db->sql_fetchrow($result) )
		{
			$order += 10;
			$sql = 'UPDATE ' . GROUPS_TABLE . '
					SET group_weight = ' . intval($order) . '
					WHERE group_id = ' . intval($row['group_id']);
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Couldn't update group weight.", "", __LINE__, __FILE__, $sql);
			}
		}

		$db->sql_freeresult($result);

		$this->read(true);
	}

	function session_time()
	{
		global $lang;

		$inactive = array();
		$inactive[0]['length'] = $lang['AGCM_second'];
		$inactive[0]['value'] = 1;
		$inactive[1]['length'] = $lang['AGCM_minute'];
		$inactive[1]['value'] = 60;
		$inactive[2]['length'] = $lang['AGCM_hour'];
		$inactive[2]['value'] = 60 * 60;
		$inactive[3]['length'] = $lang['AGCM_day'];
		$inactive[3]['value'] = 60 * 60 * 24;
		$inactive[4]['length'] = $lang['AGCM_week'];
		$inactive[4]['value'] = 60 * 60 * 24 * 7;

		return $inactive;
	}

	function inactive_select()
	{
		global $board_config, $lang;

		$inactive = $this->session_time();

		$inactive_select = '<select name="agcm_value">';

		for ($i = 0; $i < count($inactive); $i++)
		{
			$selected = ( $board_config['agcm_value'] == $inactive[$i]['value'] ) ? ' selected="selected"' : '';
			$inactive_select .= '<option value="' . $inactive[$i]['value'] . '"' . $selected . '>' . $inactive[$i]['length'] . '</option>';
		}

		$inactive_select .= '</select>';

		return $inactive_select;
	}

	function generate_css()
	{
		global $template;

		$color_css = "<style type=\"text/css\">\n";
		$color_css .= "<!--\n";

		for ( $i = 0; $i < count($this->color_data); $i++ )
		{
			$group_id = $this->color_data[$i]['group_id'];
			$color_code = $this->color_data[$i]['color_code'];
			$hover_bold = $this->color_data[$i]['hover_bold'];
			$hover_italic = $this->color_data[$i]['hover_italic'];
			$hover_underline = $this->color_data[$i]['hover_underline'];
			$bold = $this->color_data[$i]['bold'];
			$italic = $this->color_data[$i]['italic'];
			$underline = $this->color_data[$i]['underline'];

			if ( !empty($color_code) )
			{
				$color_css .= ".username_color_" . $group_id . ", a.username_color_" . $group_id . ", a.username_color_" . $group_id . ":link, a.username_color_" . $group_id . ":active, a.username_color_" . $group_id . ":visited {\n";
				$color_css .= "color : #" . $color_code . ";\n";

				if ( $bold )
				{
					$color_css .= "font-weight : bold;\n";
				}
				else
				{
					$color_css .= "font-weight : normal;\n";
				}

				if ( $italic )
				{
					$color_css .= "font-style: italic;\n";
				}
				else
				{
					$color_css .= "font-style : normal;\n";
				}

				if ( $underline )
				{
					$color_css .= "text-decoration : underline;\n";
				}
				else
				{
					$color_css .= "text-decoration : none;\n";
				}

				$color_css .= "}\n";
				$color_css .= "a.username_color_" . $group_id . ":hover {\n";
				$color_css .= "color : #" . $color_code . ";\n";

				if ( $hover_bold )
				{
					$color_css .= "font-weight : bold;\n";
				}
				else
				{
					$color_css .= "font-weight : normal;\n";
				}

				if ( $hover_italic )
				{
					$color_css .= "font-style: italic;\n";
				}
				else
				{
					$color_css .= "font-style : normal;\n";
				}

				if ( $hover_underline )
				{
					$color_css .= "text-decoration : underline;\n";
				}
				else
				{
					$color_css .= "text-decoration : none;\n";
				}

				$color_css .= "}\n";
			}
		}

		$color_css .= "-->\n";
		$color_css .= "</style>\n";

		$template->assign_vars(array(
			'COLOR_CSS' => $color_css)
		);
	}

	function get_user_color($user_color, $user_session_time=0, $username='')
	{
		global $board_config;

		if ( !($user_session_time >= ( time() - ( $board_config['agcm_time'] * $board_config['agcm_value'] ) )) && $board_config['agcm_check'] && $user_session_time != 0 )
		{
			$user_color = GROUP_SESSION;
		}

		if ( !empty($username) )
		{
			$user_color = '<span class="username_color_' . $user_color . '">'. $username .'</span>';
		}
		else
		{
			$user_color = 'username_color_' . $user_color;
		}

		return $user_color;
	}

	function get_group_color($id, $name = '')
	{
		if ( !empty($name) )
		{
			$group_color = '<span class="username_color_' . $id . '">'. $name .'</span>';
		}
		else
		{
			$group_color = 'username_color_' . $id;
		}

		return $group_color;
	}
}

//
// prepare colors class
//
	$agcm_color = new phpbb_color();
	$agcm_color->set_vars();
	$agcm_color->lang();

//
// let's run the install script
// V: disable this, since the mod is bundled in, we never want to be able to run it
//
if ( false && !defined('IN_INSTALL') && $board_config['mod_advanced_group_color_management'] != AGCM_CURRENT_VERSION )
{
	header('Location: ./install/install.' . $phpEx . (empty($SID) ? '' : '?' . $SID));
	exit;
}

//
// read colors
//
if ( !defined('IN_INSTALL') )
{
	$agcm_color->read();
}

?>
