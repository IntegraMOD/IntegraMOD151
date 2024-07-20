<?php

/***************************************************************************
 *                            functions_admin_qbar.php
 *                            ------------------------
 *	begin			: 29/10/2003
 *	copyright		: Ptirhiik
 *	email			: admin@rpgnet-fr.com
 *	version			: 1.0.0 - 29/10/2003
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

// client field functions
function qbar_get_icon($icon)
{
	global $images, $phpbb_root_path;
	return empty($icon) ? '' : ((isset($images[$icon])) ? '<img src="' . $phpbb_root_path . './' . $images[$icon] . '" border="0" alt="' . $icon . '" align="absbottom" />' : '<img src="' . $icon . '" border="0" alt="' . $icon . '" />');
}
function qbar_get_value($lang_key)
{
	global $lang;
	return empty($lang_key) ? '' : ((isset($lang[$lang_key])) ? $lang[$lang_key] . '&nbsp;('. $lang_key . ')' : $lang_key);
}
function qbar_get_bool($value)
{
	global $lang;
	return (empty($value) || !$value) ? $lang['No'] : $lang['Yes'];
}
function qbar_get_auth($auth, $pm=false)
{
	global $lang;

	$res = '';
	switch (intval($auth))
	{
		case 1 :
			$res = ($pm) ? $lang['Qbar_auth_pm_new'] : $lang['Qbar_auth_required'];
			break;
		case 2 :
			$res = ($pm) ? $lang['Qbar_auth_pm_no_new'] : $lang['Qbar_auth_prohibited'];
			break;
		case 3 :
			$res = ($pm) ? $lang['Qbar_auth_pm_unread'] : $lang['Qbar_auth_ignore'];
			break;
		default :
			$res = $lang['Qbar_auth_ignore'];
			break;
	}
	return $res;
}
function qbar_get_tree_title($cur)
{
	global $lang, $tree;
	$res = '';
	if (!empty($cur))
	{
		$q_this = isset($tree['keys'][$cur]) ? $tree['keys'][$cur] : -1;
		if ($cur == 'Root')
		{
			$res = qbar_get_value('Forum_index');
		}
		else if ($q_this > -1)
		{
			$res = qbar_get_value( (($tree['type'][$q_this] == POST_CAT_URL) ? $tree['data'][$q_this]['cat_title'] : $tree['data'][$q_this]['forum_name'] ) );
		}
		else
		{
			$res = '??';
		}
	}
	return $res;
}

// list of style
function qbar_style_select($select)
{
	global $db, $lang;

	$sql = "SELECT themes_id, style_name
		FROM " . THEMES_TABLE . "
		ORDER BY template_name, themes_id";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Couldn't query themes table", "", __LINE__, __FILE__, $sql);
	}

	// default value
	$selected = ( empty($select) || ($select == 0)) ? ' selected="selected"' : '';
	$res = '<option value="0"' . $selected . '>' . $lang['Qbar_none'] . '</option>';

	// other values
	while ( $row = $db->sql_fetchrow($result) )
	{
		$selected = ($select == $row['themes_id']) ? ' selected="selected"' : '';
		$res .= '<option value="' . $row['themes_id'] . '"' . $selected . '>' . $row['style_name'] . '</option>';
	}

	// get the result
	$res = '<select name="panel_style">' . $res . '</select>';

	return $res;
}
//
function qbar_get_style($style)
{
	global $db, $lang;

	$res = '';
	if (!empty($style))
	{
		$sql = "SELECT * FROM " . THEMES_TABLE . " WHERE themes_id=$style";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, "Couldn't query themes table", "", __LINE__, __FILE__, $sql);
		}
		if ($row = $db->sql_fetchrow($result))
		{
			$res = '[ ' . $row['style_name'] . ' ]';
		}
	}
	return $res;
}

// list of sub-templates
function qbar_sub_template_select($style, $select)
{
	global $db, $lang, $phpbb_root_path;

	// init
	$res = '';

	// something to select ?
	if (empty($style)) return $res;

	// get the style dir
	$sql = "SELECT * FROM " . THEMES_TABLE . " WHERE themes_id=$style";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Couldn't query themes table", "", __LINE__, __FILE__, $sql);
	}
	if (!$row = $db->sql_fetchrow($result)) return $res;

	// read the sub_templates.cfg file
	$filename = $phpbb_root_path . './templates/' . $row['style_name'] . '/sub_templates.cfg';
	@include($filename);
	if (empty($sub_templates)) return $res;

	// get each sub-templates
	$subtpl = array();
	foreach ($sub_templates as $key => $value)
	{
		if (!in_array($value['name'], $subtpl))
		{
			$subtpl[] = $value['name'];
		}
	}

	// default values
	$selected = empty($select) ? ' selected="selected"' : '';
	$res .= '<option value=""' . $selected . '>' . $lang['Qbar_none'] . '</option>';

	// add the sub-templates
	ksort($subtpl);
	for ($i=0; $i < count($subtpl); $i++)
	{
		$selected = ($select == $subtpl[$i]) ? ' selected="selected"' : '';
		$res .= '<option value="' . $subtpl[$i] . '"' . $selected . '>' . $subtpl[$i] . '</option>';
	}

	// add *all
	$selected = ($select == '*ALL') ? ' selected="selected"' : '';
	$res .= '<option value="*ALL"' . $selected . '>' . $lang['Qbar_all'] . '</option>';

	// add the select row
	$res = '<select name="panel_sub_template">' . $res . '</select>';

	return $res;
}

// get the sub_template name
function qbar_get_sub_template($style, $sub_template)
{
	global $db, $lang;

	$res = '';
	if (isset($lang['Subtemplate']))
	{
		if (!empty($style) && !empty($sub_template))
		{
			$res = '[ ' . $sub_template . ' ]';
		}
	}
	return $res;
}

// fix the sub_template name
function qbar_fix_sub_template($style, $sub_template)
{
	global $db, $lang, $phpbb_root_path;

	// init
	$res = '';

	// something to select ?
	if (empty($style)) return $res;

	// blank
	if (empty($sub_template)) return $res;

	// *all
	if ($sub_template == '*ALL') return $sub_template;

	// get the style dir
	$sql = "SELECT * FROM " . THEMES_TABLE . " WHERE themes_id=$style";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Couldn't query themes table", "", __LINE__, __FILE__, $sql);
	}
	if (!$row = $db->sql_fetchrow($result)) return $res;

	// read the sub_templates.cfg file
	$filename = $phpbb_root_path . './templates/' . $row['style_name'] . '/sub_templates.cfg';
	@include($filename);
	if (empty($sub_templates)) return $res;

	// get each sub-templates
	$subtpl = array();
	foreach ($sub_templates as $key => $value)
	{
		if (!in_array($value['name'], $subtpl))
		{
			$subtpl[] = $value['name'];
		}
	}

	// check
	if (in_array($sub_template, $subtpl))
	{
		$res = $sub_template;
	}

	return $res;
}

// get a specific image pack
function qbar_get_image_style($key, $row, $sub_template)
{
	global $board_config, $phpbb_root_path;

	// init result
	$res = $key;

	// get the base template image file
	$filename = $phpbb_root_path . './templates/' . $row['style_name'] . '/' . $row['style_name'] . '.cfg';
	@include($filename);
	if (count($images) > 0)
	{
		// do we use a sub_template ?
		if (!empty($sub_template))
		{
			// get the main template image file
			$current_template_path = 'templates/' . $row['style_name'];
			@include($phpbb_root_path . './' . $current_template_path . '/' . $row['style_name'] . '.cfg');
			$img_lang = ( file_exists($phpbb_root_path . './' . $current_template_path . '/images/lang_' . $board_config['default_lang']) ) ? $board_config['default_lang'] : 'english';
			foreach ($images as $key => $value)
			{
				if ( !is_array($value) )
				{
					$images[$key] = str_replace('{LANG}', 'lang_' . $img_lang, $value);
				}
			}

			// get the sub-template config file
			$filename = $phpbb_root_path . './templates/' . $row['style_name'] . '/sub_templates.cfg';
			@include($filename);
			if (count($sub_templates) > 0)
			{
				$found = false;
				foreach ($sub_templates as $key => $data)
				{
					$found = ($data['name'] == $sub_template);
					if ($found)
					{
						$fid = $key;
						break;
					}
				}
				if ($found)
				{
					// get the sub-template image file
					$current_template_path = 'templates/' . $row['style_name'] . '/' . $sub_templates[$fid]['dir'];
					@include($phpbb_root_path . './' . $current_template_path . '/' . $sub_templates[$fid]['imagefile']);
					$img_lang = ( file_exists($phpbb_root_path . './' . $current_template_path . '/images/lang_' . $board_config['default_lang']) ) ? $board_config['default_lang'] : 'english';
					foreach ($images as $key => $value)
					{
						if ( !is_array($value) )
						{
							$images[$key] = str_replace('{LANG}', 'lang_' . $img_lang, $value);
						}
					}
				}
			}
			// get the image
			if (isset($images[$res]))
			{
				$res = $phpbb_root_path . './' . $images[$res];
			}
		}
	}
	return $res;
}

// get the good image
function qbar_image($key, $style, $sub_template)
{
	global $db, $images;

	$return = false;
	$res = $key;

	// no style, use the current one
	if (empty($style))
	{
		$return = true;
	}

	// get the style dir
	if (!$return)
	{
		$sql = "SELECT * FROM " . THEMES_TABLE . " WHERE themes_id=$style";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, "Couldn't query themes table", "", __LINE__, __FILE__, $sql);
		}

		// style not found, use current one
		if (!$row = $db->sql_fetchrow($result))
		{
			$return = true;
		}
	}

	// style found, get the specific image pack
	if (!$return)
	{
		$res = qbar_get_image_style($key, $row, $sub_template);
		if (empty($res))
		{
			$res = $key;
			$return = true;
		}
	}
	return $res;
}

function qbar_read_tree_options($select, $cur='Root', $level = -1)
{
	global $tree;

	$q_this = isset($tree['keys'][$cur]) ? $tree['keys'][$cur] : -1;

	// add the current option
	if ($cur == 'Root')
	{
		$value = 'Forum_index';
	}
	else if ($q_this >= -1)
	{
		switch ($tree['type'][$q_this])
		{
			case POST_CAT_URL:
				$value = $tree['data'][$q_this]['cat_title'];
				break;
			case POST_FORUM_URL:
				$value = $tree['data'][$q_this]['forum_name'];
				break;
			default:
				$value = '??';
				break;
		}
	}
	$value = (isset($lang[$value])) ? $lang[$value] : $value;

	// increment
	$inc = '';
	for ($k=1; $k <= $level; $k++)
	{
		$inc .= '|&nbsp;&nbsp;&nbsp;';
	}
	if ($level >=0) $inc .= '|--';
	$value = $inc . $value;

	// do the option
	$selected = ($select == $cur) ? ' selected="selected"' : '';
	$res = '<option value="' . $cur . '"' . $selected . '>' . $value . '</option>';

	// get sub-levels
	for ($i=0; $i < count($tree['sub'][$cur]); $i++)
	{
		$res .= qbar_read_tree_options($select, $tree['sub'][$cur][$i], ($level+1));
	}

	return $res;
}

function qbar_get_tree_options($select='')
{
	global $lang;
	global $tree;

	$res = '';

	// is categories hierarchy v 2 installed ?
	$cat_hierarchy = function_exists('get_auth_keys');

	if (!$cat_hierarchy)
	{
		$res = qbar_read_tree_options($select);
	}
	else
	{
		$res = get_tree_option($select);
	}

	// add None plus a blank line
	$value = 'Qbar_none';
	$value = (isset($lang[$value])) ? $lang[$value] : $value;
	$selected = ($select == '') ? ' selected="selected"' : '';
	$res = '<option value=""' . $selected . '>' . $value . '</option><option></option>' . $res;

	// add the field select
	$res = '<select name="tree_id">' . $res . '</select>';

	return $res;
}

function qbar_sort()
{
	global $qbar_maps;

	$qbars_order = array();
	$qbars_names = array();
	foreach ($qbar_maps as $qbar_name => $qbar_data)
	{
		$qbars_order[] = $qbar_data['order'];
		$qbars_names[] = $qbar_name;

		$fields_order = array();
		$fields_names = array();
		foreach ($qbar_data['fields'] as $field_name => $field_data)
		{
			$fields_order[] = $field_data['order'];
			$fields_names[] = $field_name;
		}
		if (!empty($fields_names))
		{
			array_multisort($fields_order, $fields_names, $qbar_maps[$qbar_name]['fields']);
		}
	}
	if (!empty($qbars_names))
	{
		$qbar = array();
		$qbar = $qbar_maps;
		$qbar_maps = array();
		array_multisort($qbars_order, $qbars_names, $qbar);
		$qbar_maps = $qbar;
		$qbar = array();
	}
	qbar_add_order();
}

// write the qbars
function alpha($value)
{
	return sprintf("'%s'", addslashes($value));
}
function num($value)
{
	return sprintf("%d", intval($value));
}
function boolean($value)
{
	return ($value) ? 'true' : 'false';
}
function qbar_write()
{
	global $phpEx, $phpbb_root_path, $template;
	global $qbar_maps;

	// fields infos
	$map_field = array(
		'shortcut'		=> 'alpha',
		'alternate'		=> 'alpha',
		'explain'		=> 'alpha',
		'icon'			=> 'alpha',
		'use_value'		=> 'boolean',
		'use_icon'		=> 'boolean',
		'url'			=> 'alpha',
		'internal'		=> 'boolean',
		'window'		=> 'boolean',
		'auth_logged'	=> 'num',
		'auth_admin'	=> 'num',
		'auth_pm'		=> 'num',
		'tree_id'		=> 'alpha',
		'php_function'  => 'alpha',
	);

	$template->set_filenames(array(
		'outfile' => 'admin/qbar_def_qbar.tpl')
	);

	// process qbars
	foreach ($qbar_maps as $qname => $qdata)
	{
		if ($qname != 'default_tree')
		{
			$template->assign_block_vars('_outfile_qbar', array(
				'NAME'			=> alpha($qname),
				'CLASS'			=> alpha($qdata['class']),
				'DISPLAY'		=> boolean($qdata['display']),
				'CELLS'			=> num($qdata['cells']),
				'IN_TABLE'		=> boolean($qdata['in_table']),
				'STYLE'			=> num($qdata['style']),
				'SUB_TEMPLATE'	=> alpha($qdata['sub_template']),
				)
			);

			// process fields
			foreach ($qdata['fields'] as $fname => $fdata)
			{
				$template->assign_block_vars('_outfile_qbar.fields', array(
					'NAME'		=> alpha($fname),
					)
				);

				// dump values
				foreach ($map_field as $key => $type)
				{
					if (!empty($fdata[$key]))
					{
						$val = $fdata[$key];
						switch ($type)
						{
							case 'alpha'	: $val = alpha($val); break;
							case 'boolean'	: $val = boolean($val); break;
							case 'num'		: $val = num($val); break;
						}
						$spacer = '';
						if (strlen($key) <= 11)		$spacer .= '	';
						if (strlen($key) <= 8)		$spacer .= '	';
						if (strlen($key) <= 4)		$spacer .= '	';
						if (strlen($key) <= 1)		$spacer .= '	';

						$template->assign_block_vars('_outfile_qbar.fields.row', array(
							'FIELD'		=> alpha($key),
							'TABS'		=> $spacer,
							'VALUE'		=> $val,
							)
						);
					}
				}
			}
		}
	}

	// generate a var for the content
	$file_data = '_file_data';
	$template->assign_var_from_handle($file_data, 'outfile');
	$res = $template->_tpldata['.'][0][$file_data];

	// ouput to the profilcp/def_user_vlists.php
	$filename = phpbb_realpath($phpbb_root_path . 'includes/def_qbar.' . $phpEx);
	@CHMOD($filename, 0666);
	@unlink($filename);
	$f = @fopen($filename, 'w' );
	$texte  = "<?php\n$res\n?>";
	@fputs( $f, $texte );
	@fclose( $f );
}

?>
