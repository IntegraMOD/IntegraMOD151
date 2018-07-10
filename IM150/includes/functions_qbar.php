<?php

/***************************************************************************
 *                            functions_qbar.php
 *                            ------------------
 *	begin			: 22/07/2003
 *	copyright		: Ptirhiik
 *	email			: admin@rpgnet-fr.com
 *	version			: 1.0.5 - 29/10/2003
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

function qbar_add_order()
{
	global $qbar_maps, $qbar_keys;

	@reset($qbar_maps);
	$qbar_keys = array();
	$qbar_order = 0;
	$i=0;
	while ( list($qbar_name, $qbar_data) = @each($qbar_maps) )
	{
		$i++;
		$qbar_order = $qbar_order + 10;
		if ($qbar_maps[$qbar_name]['class'] != 'System')
		{
			$qbar_maps[$qbar_name]['order'] = $qbar_order;
		}
		else
		{
			$qbar_maps[$qbar_name]['order'] = 99999999;
			$qbar_order = $qbar_order - 10;
		}
		$qbar_keys[$i][0] = $qbar_name;
		$qbar_maps[$qbar_name]['idx'] = $i;

		@reset($qbar_data['fields']);
		$fields_order = 0;
		$j=0;
		while (list($field_name, $field_data) = @each($qbar_data['fields']))
		{
			$j++;
			$fields_order = $fields_order + 10;
			$qbar_maps[$qbar_name]['fields'][$field_name]['order'] = $fields_order;
			$qbar_keys[$i][$j] = $field_name;
			$qbar_maps[$qbar_name]['fields'][$field_name]['idx'] = $j;
		}
	}
}

// get tree
function qbar_set_tree_user_auth($cur='Root')
{
	global $board_config, $userdata, $lang;
	global $tree;

	$q_this = isset($tree['keys'][$cur]) ? $tree['keys'][$cur] : -1;

	// auth
	$res = array();
	$res['auth_view'] = false;

	// get the info from forums
	if ( ($q_this > -1) && $tree['auth'][$cur]['auth_view'] )
	{
		$res['auth_view'] = $tree['auth'][$cur]['auth_view'];
	}

	// read sub-levels
	$count = count($tree['sub'][$cur]);
	for ($i=0; $i < $count; $i++)
	{
		// climb up the tree
		$res_sub = array();
		$res_sub = qbar_set_tree_user_auth($tree['sub'][$cur][$i]);

		// get the auth
		$res['auth_view'] = $res['auth_view'] || $res_sub['auth_view'];
	}

	// overide the level
	$tree['auth'][$cur]['tree.auth_view'] = $res['auth_view'];

	return $res;
}

function qbar_get_tree()
{
	global $db, $userdata;
	global $tree;

	if (!empty($tree)) return;

	// is categories hierarchy v 2 installed ?
	$cat_hierarchy = function_exists(get_auth_keys);

	// fill the tree
	if (!$cat_hierarchy)
	{
		$tree = array();

		// cats
		$sql = "SELECT * FROM " . CATEGORIES_TABLE . " ORDER BY cat_order, cat_title";
		if (!$result = $db->sql_query($sql)) message_die(GENERAL_ERROR, "Could not get categories informations !", "", __LINE__, __FILE__, $sql);
		while ($row = $db->sql_fetchrow($result))
		{
			if ( !isset($row['cat_main']) ) $row['cat_main'] = 0;
			if ( $row['cat_main'] == $row['cat_id'] ) $row['cat_main'] = 0;
			$tree['keys'][ POST_CAT_URL . $row['cat_id'] ] = count($tree['data']);
			$tree['type'][] = POST_CAT_URL;
			$tree['id'][]	= $row['cat_id'];
			$tree['data'][] = $row;
			$main = ($row['cat_main']==0) ? 'Root' : POST_CAT_URL . $row['cat_main'];
			$tree['main'][] = $main;
			$tree['sub'][$main][] = POST_CAT_URL . $row['cat_id'];
		}

		// forums
		$sql = "SELECT * FROM " . FORUMS_TABLE . " ORDER BY forum_order, forum_name";
		if (!$result = $db->sql_query($sql)) message_die(GENERAL_ERROR, "Could not get forums informations !", "", __LINE__, __FILE__, $sql);
		while ($row = $db->sql_fetchrow($result)) 
		{
			$q_this = count($tree['data']);
			$tree['keys'][ POST_FORUM_URL . $row['forum_id'] ] = $q_this;
			$tree['type'][] = POST_FORUM_URL;
			$tree['id'][]	= $row['forum_id'];
			$tree['data'][] = $row;
			$main = POST_CAT_URL . $row['cat_id'];
			$tree['main'][] = $main;
			$tree['sub'][$main][] = POST_FORUM_URL . $row['forum_id'];
		}

		$tree['auth'] = array();
		$wauth = auth(AUTH_ALL, AUTH_LIST_ALL, $userdata);
		if (!empty($wauth))
		{
			reset($wauth);
			while (list($key, $data) = each($wauth))
			{
				$tree['auth'][POST_FORUM_URL . $key] = $data;
			}
		}

		// enhanced each level
		qbar_set_tree_user_auth();
	}
}

// init cats and forums
function qbar_init_tree_list($cur='Root', $level = 0)
{
	global $qbar_maps, $phpEx;
	global $tree;

	if ($cur == 'Root')
	{
		qbar_get_tree();
	}

	// add the level
	if ($cur == 'Root')
	{
		$name	= 'Forum_index';
		$title	= 'Forum_index_explain';
//		$icon	= 'menu_forums';
		$url	= 'index.' . $phpEx;
	}
	else if ($tree['type'][ $tree['keys'][$cur] ] == POST_CAT_URL)
	{
		$name	= $tree['data'][ $tree['keys'][$cur] ]['cat_title'];
		$title	= $tree['data'][ $tree['keys'][$cur] ]['cat_desc'];
//		$icon	= 'menu_forums';
		$url	= 'index.' . $phpEx . '?' . POST_CAT_URL . '=' . $tree['id'][ $tree['keys'][$cur] ];
	}
	else if ($tree['type'][ $tree['keys'][$cur] ] == POST_FORUM_URL)
	{
		$name	= $tree['data'][ $tree['keys'][$cur] ]['forum_name'];
		$title	= $tree['data'][ $tree['keys'][$cur] ]['forum_desc'];
//		$icon	= 'menu_forums';
		$url	= 'viewforum.' . $phpEx . '?' . POST_FORUM_URL . '=' . $tree['id'][ $tree['keys'][$cur] ];
	}
	else
	{
		$name	= $cur;
		$title	= 'Unknown';
//		$icon	= 'menu_faq';
		$url	= 'index.' . $phpEx;
	}

	// init the row
	$row = array();
	$row['shortcut']		= $name;
	$row['explain']			= $title;
	$row['icon']			= $icon;
	$row['use_value']		= true;
	$row['use_icon']		= true;
	$row['url']				= $url;
	$row['internal']		= true;
	$row['window']			= false;
	$row['auth_logged']		= 0;
	$row['auth_admin']		= 0;
	$row['auth_pm']			= 0;
	$row['tree_id']			= $cur;
	$row['level']			= $level;

	// store in definition
	$qbar_maps['default_tree']['fields'][$cur] = $row;

	// get the sub-levels
  $tree_count = $tree['sub'][$cur] ? count($tree['sub'][$cur]) : 0;
  for ($i=0; $i < $tree_count; $i++)
	{
		qbar_init_tree_list( $tree['sub'][$cur][$i], ($level+1) );
	}
}

// read the qbars and enhance them with order
function qbar_read()
{
	global $phpbb_root_path, $phpEx;
	global $qbar_maps;
	
	$qbar_maps = array();
	include($phpbb_root_path . './includes/def_qbar.' . $phpEx);
	qbar_init_tree_list();
	qbar_add_order();
}

// get nav description
function qbar_get_nav_desc($import=false)
{
	global $lang, $phpEx, $nav_separator;
	global $panel_id, $field_id, $qbar_maps, $qbar_keys;
	
	// nav separator
	if (empty($nav_separator)) $nav_separator = '&nbsp;->&nbsp;';

	// nav desc
	if ($import)
	{
		$s_nav_desc = '<input type="submit" name="goto[0]" class="liteoption" value="' . $lang['Qbar_admin'] . '" />';
	}
	else
	{
		$s_nav_desc = '<a href="' . append_sid("admin_qbar.$phpEx") . '" class="nav">' . $lang['Qbar_admin'] . '</a>';
	}

	$qname = '';
	if (!empty($panel_id))
	{
		// find the panel
		$qname = $qbar_keys[$panel_id][0];
		if (!empty($qname))
		{
			if ($import)
			{
				$s_nav_desc .= $nav_separator . '<input type="submit" name="goto[' . $panel_id . ']" class="liteoption" value="' . $qname . '" />';
			}
			else
			{
				$s_nav_desc .= $nav_separator . '<a href="' . append_sid("admin_qbar.$phpEx?panel=$panel_id") . '" class="nav">' . $qname . '</a>';
			}
		}
	}
	return $s_nav_desc;
}


function qbar_display_qbars($display=false)
{
	global $userdata, $lang, $images, $phpEx, $template, $db, $board_config;
	global $sub_template_key_image, $sub_templates, $theme;
	global $tree, $qbar_maps, $lofi;

	// get the tpl for displaying
	/*$template->set_filenames(array(
		'_qbars' => 'qbar_qbars.tpl')
	);*/

	if (!$display) return;
	qbar_read();

	// get number of messages
	$new_pms = intval($userdata['user_new_privmsg']);
	$unread_pms = intval($userdata['user_unread_privmsg']);

	// is categories hierarchy v 2 installed ?
	$cat_hierarchy = function_exists('get_auth_keys');

	// get the style used
	$style = $theme['themes_id'];

	// read the qbar to display
	$qbars = array();
	$qmenu = array();
	$qnav = array();
	$qnav2 = array();
	$qlist = array();
	@reset($qbar_maps);
	while (list($qname, $qdata) = @each($qbar_maps))
	{
		$ok = ($qdata['display'] && ($qdata['class'] != 'System'));

		// check the main template
		if ($ok && !empty($qdata['style']) && ($qdata['style'] != $style))
		{
			$ok = false;
		}
		// no sub-template selected, but one in use
		if ( $ok && !empty($qdata['style']) && empty($qdata['sub_template']) && !empty($sub_templates[$sub_template_key_image]['name']) )
		{
			$ok = false;
		}
		// sub-template selected, and not all sub-template for the qbar
		if ($ok && !empty($qdata['style']) && !empty($qdata['sub_template']) && ($qdata['sub_template'] != '*ALL') && ($qdata['sub_template'] != $sub_templates[$sub_template_key_image]['name']))
		{
			$ok = false;
		}
		if ($ok)
		{
			// get the options
			$options = array();
			@reset($qdata['fields']);
			while( list($fname, $fdata) = @each($qdata['fields']))
			{
				$ok = true;

				// check if logged
				if (($fdata['auth_logged'] == 1) && ($userdata['user_id'] == ANONYMOUS)) 
				{
					$ok = false;
				}
				if (($fdata['auth_logged'] == 2) && ($userdata['user_id'] != ANONYMOUS)) 
				{
					$ok = false;
				}

				// check if admin
				if (($fdata['auth_admin'] == 1) && ($userdata['user_level'] != ADMIN))
				{
					$ok = false;
				}
				if (($fdata['auth_admin'] == 2) && ($userdata['user_level'] == ADMIN))
				{
					$ok = false;
				}

				// check auth tree forum
				if (!empty($fdata['tree_id']) && $ok)
				{
					if (!$cat_hierarchy)
					{
						qbar_get_tree();
					}
					$ok = $tree['auth'][$fdata['tree_id']]['tree.auth_view'];
				}

				// check private messaging
				if (($fdata['auth_pm'] == 1) && ($new_pms <= 0))
				{
					$ok = false;
				}
				if (($fdata['auth_pm'] == 2) && ($unread_pms <= 0))
				{
					$ok = false;
				}
				if (($fdata['auth_pm'] == 2) && ($unread_pms > 0) && ($new_pms > 0))
				{
					$ok = false;
				}
				if (($fdata['auth_pm'] == 3) && (($new_pms > 0) || ($unread_pms > 0)))
				{
					$ok = false;
				}

				// all check
				if ($ok)
				{
					// shortcut
					$shortcut = isset($lang[ $fdata['shortcut'] ]) ? $lang[ $fdata['shortcut'] ] : $fdata['shortcut'];
					if ($fdata['shortcut'] == 'Logout')
					{
						$shortcut .= ' [ ' . $userdata['username'] . ' ]';
					}

					// alternate
					if ($fdata['auth_pm'] == 1)
					{
						if ($new_pms > 1)
						{
							$shortcut = isset($lang[ $fdata['alternate'] ]) ? $lang[ $fdata['alternate'] ] : $fdata['alternate'];
						}
						$shortcut = sprintf($shortcut, $new_pms);
					}
					if ($fdata['auth_pm'] == 2)
					{
						if ($unread_pms > 1)
						{
							$shortcut = isset($lang[ $fdata['alternate'] ]) ? $lang[ $fdata['alternate'] ] : $fdata['alternate'];
						}
						$shortcut = sprintf($shortcut, $unread_pms);
					}

					// mouseover
					$mouseover = isset($lang[ $fdata['explain'] ]) ? $lang[ $fdata['explain'] ] : $fdata['explain'];

					// link
					$url = $fdata['url'];
					if ($fdata['internal'])
					{
						$part = explode( '?', $url);
						$url .= ((count($part) > 1) ? '&' : '?') . 'sid=' . $userdata['session_id'];
						$url = append_sid($url);
					}

					// icon
					$icon = (isset($images[ $fdata['icon'] ])) ? $images[ $fdata['icon'] ] : $fdata['icon'];

					// store the option
					$options['icon'][]			= ($fdata['use_icon']) ? $icon : '';
					$options['shortcut'][]		= ($fdata['use_value']) ? $shortcut : '';
					$options['mouseover'][]		= $mouseover;
					$options['url'][]			= $url;
					$options['window'][]		= $fdata['window'];
				}
			}

			// affect to the good place
			if (count($options['url']) > 0)
			{
				switch ($qdata['class'])
				{
					case 'Bar':
						$qbars['fields'][]			= $options;
						$qbars['in_table'][]		= $qdata['in_table'];
						$qbars['style'][]			= $qdata['style'];
						$qbars['sub_template'][]	= $qdata['sub_template'];
						$qbars['cells'][]			= $qdata['cells'];
						break;
					case 'Menu':
						$qmenu['fields'][]			= $options;
						$qmenu['in_table'][]		= $qdata['in_table'];
						$qmenu['style'][]			= $qdata['style'];
						$qmenu['sub_template'][]	= $qdata['sub_template'];
						$qmenu['cells'][]			= $qdata['cells'];
						break;
					case 'Nav':
						$qnav['fields'][]			= $options;
						$qnav['in_table'][]		    = $qdata['in_table'];
						$qnav['style'][]			= $qdata['style'];
						$qnav['sub_template'][] 	= $qdata['sub_template'];
						$qnav['cells'][]			= $qdata['cells'];
						break;
					case 'Nav2':
						$qnav2['fields'][]			= $options;
						$qnav2['in_table'][]		    = $qdata['in_table'];
						$qnav2['style'][]			= $qdata['style'];
						$qnav2['sub_template'][] 	= $qdata['sub_template'];
						$qnav2['cells'][]			= $qdata['cells'];
						break;
					case 'List':
						$qlist['fields'][]			= $options;
						$qlist['in_table'][]		    = $qdata['in_table'];
						$qlist['style'][]			= $qdata['style'];
						$qlist['sub_template'][] 	= $qdata['sub_template'];
						$qlist['cells'][]			= $qdata['cells'];
						break;
				}
			}
		}
	}

	// send qbars, then qmenus
	for ($obj = 0; $obj < 4; $obj++)
	{
		if ($obj == 0)
		{
			$obj_count = $qbars['fields'] ? count($qbars['fields']) : 0;
			if($obj_count){
				$template->set_filenames(array(
					'_qbars' => 'qbar_qbars.tpl')
				);
			}				
		}
		// the init of qbars tpl has already been done
		if ($obj == 1)
		{
			// display the qmenus
			$obj_count = count($qmenu['fields']);
			if($obj_count){
			$template->set_filenames(array(
				'_qmenus' => 'qbar_qmenus.tpl')
			);
			}
		}elseif ($obj == 2)
		{
			// display the qnavs
			$obj_count = count($qnav['fields']);
			if($obj_count){
			$template->set_filenames(array(
				'_qnavs' => 'qbar_qnavs.tpl')
			);
			}				
		}elseif ($obj == 3)
		{
			// display the second qnavs
			$obj_count = count($qnav2['fields']);
			if($obj_count){
			$template->set_filenames(array(
				'_qnavs2' => 'qbar_qnavs2.tpl')
			);
			}
		}elseif ($obj == 4)
		{ 
			// display the qlist
			$obj_count = count($qlist['fields']);
			if($obj_count){
			$template->set_filenames(array(
				'_qlist' => 'qbar_qlist.tpl')
			);
		}
		}
		// display the object
		for ($i=0; $i < $obj_count; $i++)
		{
			if ($obj == 0)
			{
				// prepare the options array for this qbar
				$fields			= $qbars['fields'][$i];
				$in_table		= $qbars['in_table'][$i];
				$style			= $qbars['style'][$i];
				$sub_template	= $qbars['sub_template'][$i];
				$cells			= $qbars['cells'][$i];
				$class			= 'nav';
			}
			elseif ($obj == 1)
			{
				$fields			= $qmenu['fields'][$i];
				$in_table		= $qmenu['in_table'][$i];
				$style			= $qmenu['style'][$i];
				$sub_template	= $qmenu['sub_template'][$i];
				$cells			= $qmenu['cells'][$i];
				$class			= 'mainmenu';
			}
			elseif ($obj == 2)
			{
				$fields			= $qnav['fields'][$i];
				$in_table		= $qnav['in_table'][$i];
				$style			= $qnav['style'][$i];
				$sub_template	= $qnav['sub_template'][$i];
				$cells			= $qnav['cells'][$i];
				$class			= 'navmenu';
			}
			elseif ($obj == 3)
			{
				$fields			= $qnav2['fields'][$i];
				$in_table		= $qnav2['in_table'][$i];
				$style			= $qnav2['style'][$i];
				$sub_template	= $qnav2['sub_template'][$i];
				$cells			= $qnav2['cells'][$i];
				$class			= 'nav2';
			}
			else
			{
				$fields			= $qlist['fields'][$i];
				$in_table		= $qlist['in_table'][$i];
				$style			= $qlist['style'][$i];
				$sub_template	= $qlist['sub_template'][$i];
				$cells			= $qlist['cells'][$i];
				$class			= 'listmenu';
			}
			$options = array();

			// process one qbar/qmenu
			for ($j=0; $j < count($fields['url']); $j++)
			{
				// link
				if ($fields['window'][$j])
				{
					$wres = '<a target="_blank" href="' . urldecode($fields['url'][$j]) . '" title="' . $fields['mouseover'][$j] . '" class="' . $class . '">%s</a>';
				}
				else
				{
					$wres = '<a href="' . urldecode($fields['url'][$j]) . '" title="' . $fields['mouseover'][$j] . '" class="' . $class . '">%s</a>';
				}

				// icon
				$icon = '';
				if (!empty($fields['icon'][$j]) && $lofi == 0)
				{
					$icon	= '<img src="' . $fields['icon'][$j] . '" alt="' . $fields['mouseover'][$j] . '" align="absbottom" border="0"' . (empty($fields['shortcut'][$j]) ? '' : ' hspace="5"') . ' />';
				}

				// icon & shortcut
				$wres = sprintf($wres, $icon . $fields['shortcut'][$j]);

				// add to options
				$options[] = $wres;
			}

			// send it to template
			if (count($options) > 0)
			{
				if ($obj == 0)
				{
					$obj_root = '_qbar';
//					$align = 'left';
				}
				elseif ($obj == 1)
				{
					$obj_root = '_qmenu';
//					$align = 'center';
				}
				elseif ($obj == 2)
				{
					$obj_root = '_qnav';
//					$align = 'left';
				}
				elseif ($obj == 3)
				{
					$obj_root = '_qnav2';
//					$align = 'left';
				}
				else
				{
					$obj_root = '_qlist';
//					$align = 'center';
				}
				if ($cells == 0) $cells = 1;
				if ($cells > count($options)) $cells = count($options);
				$width = ceil(100 / $cells);
				$align = ($in_table) ? 'center' : $align;
				$template->assign_block_vars($obj_root, array(
					'WIDTH'	=> $width
//					'ALIGN'	=> $align,
					)
				);
				$pointer = -1;
				for ($j = 0; $j < count($options); $j++)
				{
					$inc = ($obj == 1) ? $images['menu_delimeter'] : '';
					$pointer++;
					if ((($pointer % $cells) == 0) || ($in_table))
					{
						if (($pointer % $cells) == 0)
						{
							$template->assign_block_vars($obj_root . '.line', array());
						}
						$template->assign_block_vars($obj_root . '.line.cell', array());
						if (!$in_table)
						{
							$inc = '';
						}
					}
					$template->assign_block_vars($obj_root . '.line.cell.field', array(
						'OPTION' => $inc . $options[$j] . ($in_table ? $inc : ''),
						)
					);
					if ($in_table)
					{
						$template->assign_block_vars($obj_root . '.line.cell.field.in_table', array());
						if ($j == 0)
						{
							// number of cells to add to the first line
							$n = $cells-((count($options)-1) % $cells)+1;
						}
						if ($pointer == ($cells-$n+1))
						{
							// add clear tab
							for ($k=1; $k < ($n-1); $k++)
							{
								$pointer++;
								$template->assign_block_vars($obj_root . '.line.cell', array());
								$template->assign_block_vars($obj_root . '.line.cell.field', array());
							}
						}
					} // end if in table
				} // end read options
			} // if options
		} // object

		// send it to main template
		if ($obj == 0)
		{
			if ($qbars['fields'] && count($qbars['fields']) > 0)
			{
				$template->assign_var_from_handle('QBARS', '_qbars');
			}
		}
		elseif ($obj == 1)
		{
			if (count($qmenu['fields']) > 0)
			{
				$template->assign_var_from_handle('QMENUS', '_qmenus');
			}
		}
		elseif ($obj == 2)
		{
			if (count($qnav['fields']) > 0)
			{
				$template->assign_var_from_handle('QNAVS', '_qnavs');
			}
		}
		elseif ($obj == 3)
		{
			if (count($qnav2['fields']) > 0)
			{
				$template->assign_var_from_handle('QNAVS2', '_qnavs2');
			}
		}
		else
		{
			if (count($qlist['fields']) > 0)
			{
				$template->assign_var_from_handle('QLIST', '_qlist');
			}
		}
	} // end for $obj
}

?>