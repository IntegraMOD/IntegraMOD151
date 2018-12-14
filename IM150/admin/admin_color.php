<?php
/***************************************************************************
*							admin_color.php
*							--------------
*	begin		: 2005/09/30
*	copyright	: phantomk
*	email		: phantomk@hackbb.com
*
*	Version		: 0.0.16 - 2006/07/15
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

$file = basename(__FILE__);
if( !empty($setmodules) )
{
	$module['Groups']['AGCM_colors'] = $file;
	return;
}

$phpbb_root_path = './../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
$requester = 'admin/admin_color';
require('./pagestart.' . $phpEx);

if ( isset($_POST[POST_STYLES_URL]) || isset($_GET[POST_STYLES_URL]) )
{
	$style_id = ( isset($_POST[POST_STYLES_URL]) ) ? intval($_POST[POST_STYLES_URL]) : intval($_GET[POST_STYLES_URL]);
}
else
{
	$style_id = '';
}

if ( ( isset($_POST['edit']) || isset($_GET['edit']) ) && !empty($style_id ) )
{
	if ( isset($_POST[POST_GROUPS_URL]) || isset($_GET[POST_GROUPS_URL]) )
	{
		$group_id = ( isset($_POST[POST_GROUPS_URL]) ) ? intval($_POST[POST_GROUPS_URL]) : intval($_GET[POST_GROUPS_URL]);

		$move = ( isset($_POST['edit']) ) ? intval($_POST['edit']) : intval($_GET['edit']);

		$sql = 'UPDATE ' . GROUPS_TABLE . '
				SET group_weight = ' . $move . '
				WHERE group_id = ' . $group_id;
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Error updateing groups table', '', __LINE__, __FILE__, $sql);
		}

		$agcm_color->set_group_weight();
	}

	if ( $style_id != -1 )
	{
		$sql = 'SELECT themes_id, style_name
				FROM ' . THEMES_TABLE . '
				WHERE themes_id = ' . intval($style_id);
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Couldn\'t obtain themes data', '', __LINE__, __FILE__, $sql);
		}

		if ( $row = $db->sql_fetchrow($result) )
		{
			$style_id = $row['themes_id'];
			$style_name = sprintf($lang['AGCM_edit_style'], $row['style_name']);
		}
		else
		{
			message_die(GENERAL_MESSAGE, $lang['No_style_exists']);
		}

		$db->sql_freeresult($result);
	}
	else
	{
		$style_id = -1;
		$style_name = $lang['AGCM_editing_all'];
	}

		$sql = 'SELECT g.group_id, g.group_name, g.group_weight, g.group_legend, g.group_color
				FROM ' . GROUPS_TABLE . ' g
				WHERE g.group_single_user <> ' . true . '
					OR g.group_id IN (' . implode(', ', array_keys($agcm_color->group_ids)) . ')
				ORDER BY g.group_weight ASC';

	if ( $style_id != -1 )
	{
		$sql = str_replace('SELECT ', 'SELECT c.color_code, c.bold, c.italic, c.underline, c.hover_bold, c.hover_italic, c.hover_underline, ', $sql);
		$sql = str_replace('WHERE ', 'LEFT JOIN ' . COLOR_TABLE . ' c ON c.group_id = g.group_id AND c.themes_id = ' . intval($style_id) . ' WHERE ', $sql);
	}

	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Couldn\'t obtain group data', '', __LINE__, __FILE__, $sql);
	}

	$groups = $db->sql_fetchrowset($result);

	$db->sql_freeresult($result);

	$s_hidden_fields = '<input type="hidden" name="' . POST_STYLES_URL . '" value="' . $style_id . '" />';

	$template->set_filenames(array(
		'body' => 'admin/color_edit_body.tpl',
	));

	$template->assign_vars(array(
		'FALSE' => '0',
		'TRUE' => '1',
		'TIME' => $board_config['agcm_time'],

		'I_UP' => $phpbb_root_path . $images['Up'],
		'I_DOWN' => $phpbb_root_path . $images['Down'],

		'L_TITLE' => $lang['AGCM_color_admin'],
		'L_EDIT' => $style_name,
		'L_NO' => $lang['No'],
		'L_YES' => $lang['Yes'],
		'L_UP' => $lang['AGCM_up'],
		'L_DOWN' => $lang['AGCM_down'],
		'L_SUBMIT' => $lang['Submit'],
		'L_RESET' => $lang['Reset'],
		'L_COLOR' => $lang['AGCM_color'],
		'L_COLOR_EXPLAIN' => $lang['AGCM_color_explain'],
		'L_FIND_COLOR' => $lang['AGCM_find_color'],
		'L_LEGEND' => $lang['AGCM_display_legend'],
		'L_TIME' => $lang['AGCM_time'],
		'L_TIME_EXPLAIN' => $lang['AGCM_time_explain'],
		'L_CHECK' => $lang['AGCM_check'],
		'L_CHECK_EXPLAIN' => $lang['AGCM_check_explain'],
		'L_BOLD' => $lang['AGCM_bold'],
		'L_ITALIC' => $lang['AGCM_italic'],
		'L_UNDERLINE' => $lang['AGCM_underline'],
		'L_STYLE_EXPLAIN' => $lang['AGCM_style_explain'],
		'L_HOVER_STYLE_EXPLAIN' => $lang['AGCM_hover_style_explain'],

		'U_SEARCH_COLOR' => append_sid($phpbb_root_path . "search." . $phpEx . "?mode=searchcolor"),

		'S_VALUE' => $agcm_color->inactive_select(),
		'S_CHECK_YES' => ($board_config['agcm_check']) ? ' checked="checked"' : '',
		'S_CHECK_NO' => (!$board_config['agcm_check']) ? ' checked="checked"' : '',
		'S_HIDDEN_FIELDS' => $s_hidden_fields,
		'S_ACTION' => append_sid("admin_color.$phpEx"),
	));

	if ( !empty($groups) )
	{
		for ($j = 0; $j < count($groups); $j++)
		{
			$template->assign_block_vars('group_color_edit', array(
				'ID' => $groups[$j]['group_id'],
				'GROUP_NAME' => _lang_check($groups[$j]['group_name']),
				'GROUP_COLOR' => $style_id == -1 ? '' : $groups[$j]['color_code'],
				'BOLD' => $style_id == -1 ? '' : ( intval($groups[$j]['bold']) ? ' checked="checked"' : '' ),
				'ITALIC' => $style_id == -1 ? '' : ( intval($groups[$j]['italic']) ? ' checked="checked"' : '' ),
				'UNDERLINE' => $style_id == -1 ? '' : ( intval($groups[$j]['underline']) ? ' checked="checked"' : '' ),
				'HOVER_BOLD' => $style_id == -1 ? '' : ( intval($groups[$j]['hover_bold']) ? ' checked="checked"' : '' ),
				'HOVER_ITALIC' => $style_id == -1 ? '' : ( intval($groups[$j]['hover_italic']) ? ' checked="checked"' : '' ),
				'HOVER_UNDERLINE' => $style_id == -1 ? '' : ( intval($groups[$j]['hover_underline']) ? ' checked="checked"' : '' ),

				'U_WEIGHT_UP' => append_sid("admin_color." . $phpEx . "?" . POST_GROUPS_URL . "=" . $groups[$j]['group_id'] . "&amp;edit=" . ($groups[$j]['group_weight'] - 15) . "&amp;" . POST_STYLES_URL . "=" . $style_id),
				'U_WEIGHT_DOWN' => append_sid("admin_color." . $phpEx . "?" . POST_GROUPS_URL . "=" . $groups[$j]['group_id'] . "&amp;edit=" . ($groups[$j]['group_weight'] + 15) . "&amp;" . POST_STYLES_URL . "=" . $style_id),

				'S_LEGEND_YES' => $groups[$j]['group_legend'] ? ' checked="checked"' : '',
				'S_LEGEND_NO' => !$groups[$j]['group_legend'] ? ' checked="checked"' : '',
			));

			if ( $j != 0 )
			{
				$template->assign_block_vars('group_color_edit.up', array());
			}

			if ( $j < ($i - 1) )
			{
				$template->assign_block_vars('group_color_edit.down', array());
			}
		}
	}
}
else if ( isset($_POST['color_update']) && !empty($style_id ) )
{
	if ( $style_id != -1 )
	{
		$sql = 'SELECT themes_id, style_name
				FROM ' . THEMES_TABLE . '
				WHERE themes_id = ' . intval($style_id);
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Couldn\'t obtain themes data', '', __LINE__, __FILE__, $sql);
		}

		if ( $row = $db->sql_fetchrow($result) )
		{
			$style_id = $row['themes_id'];
		}
		else
		{
			message_die(GENERAL_MESSAGE, $lang['AGCM_no_style_exists']);
		}

		$db->sql_freeresult($result);
	}
	else
	{
		$style_id = -1;
	}

		$sql = 'SELECT g.group_id, g.group_name, g.group_weight, g.group_legend, g.group_color
				FROM ' . GROUPS_TABLE . ' g
				WHERE g.group_single_user <> ' . true . '
					OR g.group_id IN (' . implode(', ', array_keys($agcm_color->group_ids)) . ')
				ORDER BY g.group_weight ASC';

	if ( $style_id != -1 )
	{
		$sql = str_replace('SELECT ', 'SELECT c.color_code, c.bold, c.italic, c.underline, c.hover_bold, c.hover_italic, c.hover_underline, ', $sql);
		$sql = str_replace('WHERE ', 'LEFT JOIN ' . COLOR_TABLE . ' c ON c.group_id = g.group_id AND c.themes_id = ' . intval($style_id) . ' WHERE ', $sql);
	}

	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Couldn\'t obtain group data', '', __LINE__, __FILE__, $sql);
	}

	$i = 0;
	$groups = array();

	while ($row = $db->sql_fetchrow($result))
	{
		$groups[$i] = $row;
		$i++;
	}

	$db->sql_freeresult($result);
	$error = false;

	for ($j = 0; $j < $i; $j++)
	{
		$color_id = 'color_code' . intval($groups[$j]['group_id']);
		$color_code = htmlspecialchars($_POST[$color_id]);

		$legend_id = 'legend' . intval($groups[$j]['group_id']);
		$legend = empty($color_code) ? 0 : ( isset($_POST[$legend_id]) ? intval($_POST[$legend_id]) : 0 );

		$bold_id = 'bold' . intval($groups[$j]['group_id']);
		$bold = empty($color_code) ? 0 : ( isset($_POST[$bold_id]) ? 1 : 0 );

		$italic_id = 'italic' . intval($groups[$j]['group_id']);
		$italic = empty($color_code) ? 0 : ( isset($_POST[$italic_id]) ? 1 : 0 );

		$underline_id = 'underline' . intval($groups[$j]['group_id']);
		$underline = empty($color_code) ? 0 : ( isset($_POST[$underline_id]) ? 1 : 0 );

		$hover_bold_id = 'hover_bold' . intval($groups[$j]['group_id']);
		$hover_bold = empty($color_code) ? 0 : ( isset($_POST[$hover_bold_id]) ? 1 : 0);

		$hover_italic_id = 'hover_italic' . intval($groups[$j]['group_id']);
		$hover_italic = empty($color_code) ? 0 : ( isset($_POST[$hover_italic_id]) ? 1 : 0 );

		$hover_underline_id = 'hover_underline' . intval($groups[$j]['group_id']);
		$hover_underline = empty($color_code) ? 0 : ( isset($_POST[$hover_underline_id]) ? 1 : 0 );

		$group_color = empty($color_code) ? 0 : 1;

		$sql = 'UPDATE ' . COLOR_TABLE . '
				SET color_code = \'' . $color_code . '\', bold = ' . $bold . ', italic = ' . $italic . ', underline = ' . $underline . ', hover_bold = ' . $hover_bold . ', hover_italic = ' . $hover_italic . ', hover_underline = ' . $hover_underline . '
				WHERE group_id = ' . intval($groups[$j]['group_id']);

		if ( $style_id != -1 )
		{
			$sql = str_replace('WHERE', 'WHERE themes_id = ' . $style_id . ' AND', $sql);
		}

		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Error updateing themes table', '', __LINE__, __FILE__, $sql);
		}

		$sql = 'UPDATE ' . GROUPS_TABLE . '
				SET group_legend = ' . intval($legend) . ', group_color = ' . intval($group_color) . '
				WHERE group_id = ' . intval($groups[$j]['group_id']);
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Error updateing themes table', '', __LINE__, __FILE__, $sql);
		}
	}

	$agcm_check = isset($_POST['agcm_check']) ? intval($_POST['agcm_check']) : 0;

	$sql = 'UPDATE ' . CONFIG_TABLE . '
			SET config_value = ' . $agcm_check . '
			WHERE config_name = \'agcm_check\'';
	if ( !$db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Error updateing config table', '', __LINE__, __FILE__, $sql);
	}

	$agcm_time = isset($_POST['agcm_time']) ? intval($_POST['agcm_time']) : 0;

	$sql = 'UPDATE ' . CONFIG_TABLE . '
			SET config_value = ' . $agcm_time . '
			WHERE config_name = \'agcm_time\'';
	if ( !$db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Error updateing config table', '', __LINE__, __FILE__, $sql);
	}

	$agcm_value = isset($_POST['agcm_value']) ? intval($_POST['agcm_value']) : 0;

	$sql = 'UPDATE ' . CONFIG_TABLE . '
			SET config_value = ' . $agcm_value . '
			WHERE config_name = \'agcm_value\'';
	if ( !$db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Error updateing config table', '', __LINE__, __FILE__, $sql);
	}

	if ( $style_id != -1 )
	{
		$agcm_color->read_theme($style_id, true);
	}
	else
	{
		$sql = 'SELECT themes_id
				FROM ' . THEMES_TABLE . '
				ORDER BY template_name';
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, "Couldn't retrieve themes data.", "", __LINE__, __FILE__, $sql);
		}

		while( $row = $db->sql_fetchrow($result) )
		{
			$agcm_color->read_theme($row['themes_id'], true);
		}

		$db->sql_freeresult($result);
	}

	$agcm_color->read(true);

	$message = $lang['AGCM_update_successfull'] . '<br /><br />' . sprintf($lang['AGCM_click_return_color_admin'], '<a href="' . append_sid("admin_color.$phpEx") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid("index.$phpEx?pane=right") . '">', '</a>');

	message_die(GENERAL_MESSAGE, $message);
}
else
{
	$sql = 'SELECT themes_id, style_name
			FROM ' . THEMES_TABLE . '
			ORDER BY template_name';
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Couldn't retrieve themes data.", "", __LINE__, __FILE__, $sql);
	}

	$select_list = '<select name="' . POST_STYLES_URL . '">';

	$select_list .= '<option value="-1">' . $lang['AGCM_edit_all'] . '</option>';

	while( $row = $db->sql_fetchrow($result) )
	{
		$select_list .= '<option value="' . $row['themes_id'] . '">' . $row['style_name'] . '</option>';
	}

	$select_list .= '</select>';

	$db->sql_freeresult($result);

	$template->set_filenames(array(
		'body' => 'admin/color_style_select.tpl')
	);

	$template->assign_vars(array(
		'L_TITLE' => $lang['AGCM_color_admin'],
		'L_EXPLAIN' => $lang['AGCM_color_admin_explain'],
		'L_SELECT' => $lang['AGCM_select_style'],
		'L_LOOK_UP' => $lang['AGCM_look_up_group_color'],

		'S_ACTION' => append_sid("admin_color.$phpEx"),
		'S_SELECT' => $select_list,
	));
}

$template->pparse('body');

include('./page_footer_admin.'.$phpEx);

?>
