<?php
/***************************************************************************
 *							profilcp_public_base.php
 *							------------------------
 *	begin				: 08/05/2003
 *	copyright			: Ptirhiik
 *	email				: admin@rpgnet-fr.com
 *
 *	version				: 1.0.8 - 24/10/2003
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 *
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
	exit;
}

if ( !empty($setmodules) )
{
	// read maps
	@reset($user_maps);
	while ( list($map_name, $map_data) = @each($user_maps) )
	{
		$map_tree = explode('.', $map_name);
		if ( ($map_tree[0] = 'PCP') && ($map_data['custom'] == 2) )
		{
			// build 
			$map_root = '';
			for ( $i=0; $i < count($map_tree); $i++ )
			{
				$map_root .= ( empty($map_root) ? '' : '.' ) . $map_tree[$i];

				// ignore main level (PCP, phpBB)
				if ( $i == 1 )
				{
					// create it as main menu
					$pgm = '';
					if ( $i == (count($map_tree)-1) )
					{
						$pgm = __FILE__;
					}
					$order = $user_maps[$map_root]['order'];
					$shortcut = $user_maps[$map_root]['title'];
					$pagetitle = $user_maps[$map_root]['title'];
					pcp_set_menu( $map_tree[$i], $order, $pgm, $shortcut, $pagetitle );
				}
				if ( $i > 1 )
				{
					$pgm = '';
					if ( $i == (count($map_tree)-1) )
					{
						$pgm = __FILE__;
					}
					$order = $user_maps[$map_root]['order'];
					$shortcut = $user_maps[$map_root]['title'];
					$pagetitle = $user_maps[$map_root]['title'];
					pcp_set_sub_menu( $map_tree[$i-1], $map_tree[$i], $order, $pgm, $shortcut, $pagetitle );
				}
			}
		}
	}
	return;
}

// Mighty Gorgon - Full Album Pack - BEGIN
$album_root_path = $phpbb_root_path . 'album_mod/';
include ($album_root_path . 'album_constants.' . $phpEx);
include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_album_main.' . $phpEx);

$album_show_pic_url = 'album_showpage.' . $phpEx;
$album_rate_pic_url = $album_show_pic_url;
$album_comment_pic_url = $album_show_pic_url;

$sql = "SELECT * FROM ". ALBUM_CONFIG_TABLE;
if(!$result = $db->sql_query($sql))
{
	message_die(GENERAL_ERROR, "Could not query album config information", "", __LINE__, __FILE__, $sql);
}
while( $row = $db->sql_fetchrow($result) )
{
	$album_config_name = $row['config_name'];
	$album_config_value = $row['config_value'];
	
	$album_config[$album_config_name] = $album_config_value;
}
$db->sql_freeresult($result);

$limit_sql = $album_config['img_cols'] * $album_config['img_rows'];
$cols_per_page = $album_config['img_cols'];

$sql = "SELECT * FROM " . ALBUM_TABLE . " AS p, " . ALBUM_CAT_TABLE . " AS c
		WHERE c.cat_user_id = " . $view_userdata['user_id'] . "
		AND p.pic_cat_id = c.cat_id
		AND p.pic_approval = 1
		ORDER BY pic_time DESC";

if( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not query recent pics information', '', __LINE__, __FILE__, $sql);
}

$recentrow = array();

while($row = $db->sql_fetchrow($result))
{
	$recentrow[] = $row;
}

$totalpicrow = count($recentrow);

$db->sql_freeresult($result);

if ($totalpicrow > 0)
{
	$temp_url = append_sid("album.$phpEx?user_id=" . $view_userdata['user_id']);
	$album_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_album'] . '" alt="' . sprintf($lang['Personal_Gallery_Of_User'], $view_userdata['username']) . '" title="' . sprintf($lang['Personal_Gallery_Of_User'], $view_userdata['username']) . '" border="0" /></a>';
	$album = '<a href="' . $temp_url . '">' . sprintf($lang['Personal_Gallery_Of_User'], $view_userdata['username']) . '</a>';

	$template->assign_block_vars('recent_pics_block', array());
	for ($i = 0; $i < (($totalpicrow < $limit_sql) ? $totalpicrow : $limit_sql); $i += $cols_per_page)
	{
		$template->assign_block_vars('recent_pics_block.recent_pics', array());

		for ($j = $i; $j < ($i + $cols_per_page); $j++)
		{
			if( $j >= $totalpicrow )
			{
				break;
			}

			$template->assign_block_vars('recent_pics_block.recent_pics.recent_col', array(
				'U_PIC' => ($album_config['fullpic_popup']) ? append_sid("album_pic.$phpEx?pic_id=". $recentrow[$j]['pic_id']) : append_sid($album_show_pic_url. '?pic_id='. $recentrow[$j]['pic_id']),
				'THUMBNAIL' => append_sid("album_thumbnail.$phpEx?pic_id=". $recentrow[$j]['pic_id']),
				'DESC' => $recentrow[$j]['pic_desc']
				)
			);

			$template->assign_block_vars('recent_pics_block.recent_pics.recent_detail', array(
				'TITLE' => '<a href = "'.$album_show_pic_url . '?pic_id=' . $recentrow[$j]['pic_id'] . '">' . $recentrow[$j]['pic_title'] . '</a>',
				'POSTER' => $recent_poster,
				'TIME' => create_date($board_config['default_dateformat'], $recentrow[$j]['pic_time'], $board_config['board_timezone']),

				'VIEW' => $recentrow[$j]['pic_view_count'],
				)
			);
		}
	}
}
else
{
	$album_img = '';
	$album = '';
}
   $template->assign_vars(array( 
	'ALBUM_IMG' => $album_img,
	'ALBUM' => $album,

	'U_PERSONAL_GALLERY' => append_sid("album.$phpEx?user_id=" . $view_userdata['user_id']),
	'L_PERSONAL_GALLERY' => sprintf($lang['Personal_Gallery_Of_User_Profile'], $view_userdata['username'], $totalpicrow),
	'P_PERSONAL_GALLERY' => sprintf($lang['Personal_Gallery_Of_User_Profile'], $view_userdata['username'], $totalpicrow),

	'U_TOGGLE_VIEW_ALL' => append_sid("album.$phpEx?user_id=" . $view_userdata['user_id'] . "&mode=" . ALBUM_VIEW_ALL),
	'TOGGLE_VIEW_ALL_IMG' => $images['mini_all_pic_view_mode'],
	'L_TOGGLE_VIEW_ALL' => sprintf($lang['Show_All_Pic_View_Mode_Profile'], $view_userdata['username']),

	'U_ALL_IMAGES_BY_USER' => append_sid("album.$phpEx?user_id=" . $view_userdata['user_id'] . "&mode=" . ALBUM_VIEW_LIST),
	'L_ALL_IMAGES_BY_USER' => sprintf($lang['Picture_List_Of_User'], $view_userdata['username']),
	'L_PROFILE_ALBUM' => $lang['Your_Profile_Album'],

	'L_PROFILE_ALBUM' => $lang['Your_Profile_Gallery'],
	'L_PERSONAL_ALBUM' => $lang['Your_Personal_Gallery'],
	'L_PIC_TITLE' => $lang['Pic_Image'],
	'L_POSTER' => $lang['Pic_Poster'],
	'L_POSTED' => $lang['Posted'],
	'L_VIEW' => $lang['View'],
	'TARGET_BLANK' => ($album_config['fullpic_popup']) ? 'target="_blank"' : '',
	'L_NO_PICS' => $lang['No_Pics'],
	'L_RECENT_PUBLIC_PICS' => $lang['Recent_Public_Pics'],
	'S_COLS' => $album_config['cols_per_page'],
	'S_COL_WIDTH' => (100/$album_config['cols_per_page']) . '%',
   )); 
// Mighty Gorgon - Full Album Pack - END

//----------------------------------------
//
// inits
//
//----------------------------------------

// ids
$user_id = $userdata['user_id'];
$view_user_id = $view_userdata['user_id'];

//----------------------------------------
//
// process the maps
//
//----------------------------------------

// read all the maps involved
$maps = array();
$map_orders = array();
$map_base = 'PCP.viewprofile.';
$map_base = 'PCP.' . $mode . '.';
if ( !empty($sub) )
{
	$map_base .= $sub . '.';
}
@reset($user_maps);
while ( list($map_name, $map_data) = @each($user_maps) )
{
	if ( (substr($map_name, 0, strlen($map_base)) == $map_base) && ( !empty($map_data['title']) || !empty($map_data['fields']) ) )
	{
		$maps[] = $map_name;
		$map_orders[] = $user_maps[$map_name]['order'];
	}
}
array_multisort($map_orders, $maps);

// count cols
$col = 1;
for ($i=0; $i < count($maps); $i++)
{
	if ( ($i != 0) && $user_maps[ $maps[$i] ]['split'] )
	{
		$col++;
	}
}

// template file
$template->set_filenames(array(
	'body' => 'profilcp/public_base_body.tpl')
);

$template->assign_vars(array(
	'L_PUBLIC_TITLE'	=> sprintf($lang['Viewing_user_profile'], ( ($view_userdata['user_id'] != ANONYMOUS) ? $view_userdata['username'] : $lang['Guest'] ) ),
	'SPAN'				=> $col,
	)
);

// process the panels
for ($i = 0; $i < count($maps); $i++ )
{
	$split = false;
	if ( $user_maps[ $maps[$i] ]['split'] )
	{
		$split = true;
		$template->assign_block_vars('col', array());
	}

	// count how many cols in the panel
	$col = 1;
	@reset( $user_maps[ $maps[$i] ]['fields'] );
	while ( list($field_name, $field_data) = @each($user_maps[ $maps[$i] ]['fields']) )
	{
		if ( $field_data['leg'] && ($field_data['img'] || $field_data['txt']) )
		{
			$col++;
			$col++;
			break;
		}
	}

	// panel title
	$title = '';
	if ( is_string($user_maps[ $maps[$i] ]['title']) )
	{
		$title = mods_settings_get_lang( $user_maps[ $maps[$i] ]['title'] );
	}
	else
	{
		$user_maps['_temp'] = array();
		$user_maps['_temp']['fields'] = $user_maps[ $maps[$i] ]['title'];
		$title .= pcp_output_panel('_temp', $view_userdata);
	}
	$template->assign_block_vars('col.panel', array(
		'SPAN'	=> $col,
		'TITLE'	=> $title,
		)
	);
	if ( !$split )
	{
		$template->assign_block_vars('col.panel.linefeed', array());
	}

	// panel field
	@reset( $user_maps[ $maps[$i] ]['fields'] );
	while ( list($field_name, $field_data) = @each($user_maps[ $maps[$i] ]['fields']) )
	{
		if (substr($field_name, 0, 4) == '[lf]')
		{
			$template->assign_block_vars('col.panel.row', array());
			$template->assign_block_vars('col.panel.row.linefeed', array());
		}
		else
		{
			$is_leg = ($col > 1);
			$leg = pcp_output($field_name, $view_userdata, $maps[$i], true);

			// forget the legend
			$user_maps[ $maps[$i] ]['fields'][$field_name]['leg'] = false;
			$val = pcp_output($field_name, $view_userdata, $maps[$i]);

			// reset the legend
			$user_maps[ $maps[$i] ]['fields'][$field_name]['leg'] = $is_leg;

			// output
			$template->assign_block_vars('col.panel.row', array());
			if ($is_leg)
			{
				$template->assign_block_vars('col.panel.row.cell', array(
					'CLASS'	=> 'row2',
					'ALIGN'	=> 'right',
					'WIDTH'	=> '40%',
					'WRAP'	=> 'nowrap="nowrap"',
					'VALUE'	=> $is_leg ? $leg . ( !empty($leg) ? ':&nbsp;' : '') : '',
					)
				);
			}
			$template->assign_block_vars('col.panel.row.cell', array(
				'CLASS'	=> 'row1',
				'ALIGN'	=> $is_leg ? 'left' : 'center',
				'WIDTH'	=> $is_leg ? '100%' : '60%',
				'WRAP'	=> '',
				'VALUE'	=> $val,
				)
			);
			if ($is_leg)
			{
				$template->assign_block_vars('col.panel.row.cellfeed', array());
			}
		}
	}
}
// page
$template->pparse('body');

?>
