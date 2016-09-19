<?php

/***************************************************************************
 *                            admin_subtemplates.php
 *                            ----------------------
 *   begin                : 2003/04
 *   copyright            : Ptirhiik
 *   email                : admin@rpgnet-fr.com
 *   version              : 1.0.2 - 28/10/2003
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

if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['Styles']['Subtemplate'] = $file;
	return;
}

//
// Let's set the root dir for phpBB
//
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

if ( !isset($nav_separator) )
{
	$nav_separator = '&nbsp;->&nbsp;';
}

//
//  functions
//
function board_front_end( &$board, $main='Root', $level=0, $cur_stpl='c0' )
{
	global $lang, $stylerow, $sub_templates;
	global $tree;

	// add the level
	$row = array();
	$ch_this = isset($tree['keys'][$main]) ? $tree['keys'][$main] : -1;
	if ($main == 'Root')
	{
		$row['type']	= POST_CAT_URL;
		$row['id']		= 0;
		$row['main']	= '';
		$row['name']	= $lang['Index'];
		$row['level']	= $level;
		$row['stpl']	= isset( $sub_templates[ $row['type'] . $row['id'] ] ) ? $row['type'] . $row['id'] : $cur_stpl;
	}
	else
	{
		$row['type']	= $tree['type'][$ch_this];
		$row['id']		= $tree['id'][$ch_this];
		$row['main']	= $tree['type'][$ch_this] . $tree['id'][$ch_this];
		$row['name']	= ($tree['type'][$ch_this] == POST_FORUM_URL) ? $tree['data'][$ch_this]['forum_name'] : $tree['data'][$ch_this]['cat_title'];
		$row['level']	= $level;
		$row['stpl']	= isset( $sub_templates[ $row['type'] . $row['id'] ] ) ? $row['type'] . $row['id'] : $cur_stpl;
	}
	$board[] = $row;

	// get sub-levels
	for ($i=0; $i < count($tree['data']); $i++)
	{
		if ( $tree['main'][$i] == $main )
		{
			$cur = $tree['type'][$i] . $tree['id'][$i];
			$stpl = isset( $sub_templates[ $cur ] ) ? $cur : $cur_stpl;
			board_front_end( $board, $cur, $level+1, $stpl );
		}
	}
}

//
//  get parms
//

// mode
$mode = '';
if ( isset($_POST['mode']) || isset($_GET['mode']) )
{
	$mode = isset($_POST['mode']) ? $_POST['mode'] : $_GET['mode'];
}
if ( !in_array($mode, array('style', 'stpl', 'edit', 'delete')) ) $mode = 'style';

// themes_id
$themes_id = 0;
if ( isset($_POST['style']) || isset($_GET['style']) )
{
	$themes_id = isset($_POST['style']) ? intval($_POST['style']) : intval($_GET['style']);
}
if ( $themes_id != 0)
{
	$sql = "SELECT * FROM " . THEMES_TABLE . " WHERE themes_id=$themes_id";
	if (!$result = $db->sql_query($sql)) message_die(GENERAL_ERROR, "Could not get style information!", "", __LINE__, __FILE__, $sql);
	if (!$stylerow = $db->sql_fetchrow($result) ) message_die(GENERAL_ERROR, "Style $themes_id unknown");
}

// sub-template id
$subtpl_id = -1;
if ( isset($_POST['id']) || isset($_GET['id']) )
{
	$subtpl_id = isset($_POST['id']) ? intval($_POST['id']) : intval($_GET['id']);
}

//
//  button
//
if (isset($_POST['create'])) $mode = 'edit' ;
$submit = isset($_POST['submit']);
$cancel = isset($_POST['cancel']);
if ($mode=='delete')
{
	$mode = 'edit';
	$delete = true;
	$submit = true;
}
//
//  process
//

// is categories hierarchy v 2 installed ?
$cat_hierarchy = function_exists(get_auth_keys);

// get the array of sub-templates for a specific main template, and the board front end display
if ( in_array( $mode, array('stpl', 'edit', 'delete') ) )
{
	if ( $board_config['version'] > '.0.5' )
	{
		$tpl_path = phpbb_realpath($phpbb_root_path . 'templates/' . $stylerow['template_name']);
	}
	else
	{
		$tpl_path = $phpbb_root_path . 'templates/' . $stylerow['template_name'];
	}
	@include( $tpl_path . '/sub_templates.cfg' );
	if ( !isset($sub_templates) ) $sub_templates = array();

	// make an array by name/dir/imagefile/keys
	$subtpls			= array();
	$name				= array();
	$dir				= array();
	$head_stylesheet	= array();
	$imagefile			= array();
	@reset($sub_templates);
	while ( list($key, $subtpl) = each($sub_templates) )
	{
		$row['name']			= $subtpl['name'];
		$row['dir']				= $subtpl['dir'];
		$row['head_stylesheet']	= $subtpl['head_stylesheet'];
		$row['imagefile']		= $subtpl['imagefile'];

		// search if already present
		$found = false;
		for ($i=0; ( ($i < count($subtpls)) && !$found ); $i++)
		{
			$found = ( 
						($row['name'] == $subtpls[$i]['name']) && 
						($row['dir'] == $subtpls[$i]['dir']) && 
						($row['head_stylesheet'] == $subtpls[$i]['head_stylesheet']) &&
						($row['imagefile'] == $subtpls[$i]['imagefile'])
					);
			if ($found) break;
		}
		if (!$found)
		{
			$i = count($subtpls);
			$subtpls[$i] = $row;

			// prepare the sort
			$name[]				= $subtpls['name'];
			$dir[]				= $subtpls['dir'];
			$head_stylesheet[]	= $subtpls['head_stylesheet'];
			$imagefile[]		= $subtpls['imagefile'];
		}

		// search the key
		$found = ( (count($subtpls[$i]['keys']) > 0) && in_array($key, $subtpls[$i]['keys']) );
		if ( !$found ) $subtpls[$i]['keys'][] = $key;
	}
	array_multisort( $name, $dir, $head_stylesheet, $imagefile, $subtpls );

	if ($subtpl_id >= count($subtpls)) $subtpl_id = -1;

	// get data
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
			$tree['main'][] = ($row['cat_main']==0) ? 'Root' : POST_CAT_URL . $row['cat_main'];
		}

		// forums
		$sql = "SELECT * FROM " . FORUMS_TABLE . " ORDER BY forum_order, forum_name";
		if (!$result = $db->sql_query($sql)) message_die(GENERAL_ERROR, "Could not get forums informations !", "", __LINE__, __FILE__, $sql);
		while ($row = $db->sql_fetchrow($result)) 
		{
			$tree['keys'][ POST_FORUM_URL . $row['forum_id'] ] = count($tree['data']);
			$tree['type'][] = POST_FORUM_URL;
			$tree['id'][]	= $row['forum_id'];
			$tree['data'][] = $row;
			$tree['main'][] = POST_CAT_URL . $row['cat_id'];
		}
	}

	// generate the board front end
	$board = array();
	board_front_end( $board );

	// get the number of inc
	$max_inc = 0;
	for ($i=0; $i < count($board); $i++) if ($board[$i]['level'] > $max_inc) $max_inc = $board[$i]['level'];
}

// edit/create sub-template
if ($mode == 'edit')
{
	if ($cancel)
	{
		// back to display
		$mode = 'stpl';
		$cancel = false;
	}
	else if ($submit)
	{
		if ( !$delete)
		{
			// get the screen vars
			$name				= trim(str_replace('"', '&quot;', strip_tags($_POST['name'])));
			$dir				= trim(str_replace('"', '&quot;', strip_tags($_POST['dir'])));
			$head_stylesheet	= trim(str_replace('"', '&quot;', strip_tags($_POST['head_stylesheet'])));
			$imagefile			= trim(str_replace('"', '&quot;', strip_tags($_POST['imagefile'])));
			$board_ids			= $_POST['board_ids'];

			// control
			if ($name == '') message_die(GENERAL_ERROR, $lang['subtpl_error_name_missing'] );
			if ($dir == '') message_die(GENERAL_ERROR, $lang['subtpl_error_dir_missing'] );
			if (count($board_ids) == 0) message_die(GENERAL_ERROR, $lang['subtpl_error_no_selection'] );

			// update the array
			if ($subtpl_id == -1) $subtpl_id = count($subtpls);
			$subtpls[$subtpl_id]['name']				= $name;
			$subtpls[$subtpl_id]['dir']					= $dir;
			$subtpls[$subtpl_id]['head_stylesheet']		= $head_stylesheet;
			$subtpls[$subtpl_id]['imagefile']			= $imagefile;
			$subtpls[$subtpl_id]['keys']				= array();
			for ($i=0; $i < count($board_ids); $i++ ) $subtpls[$subtpl_id]['keys'][] = $board[$board_ids[$i]]['type'] . $board[$board_ids[$i]]['id'];
		}

		// build an array per nature and id and add to subtpls the main template if missing
		$sub_templates = array();
		for ($i=0; $i < count($subtpls); $i++ )
		{
			if (!$delete || ($i != $subtpl_id) )
			{
				$row['name']				= $subtpls[$i]['name'];
				$row['dir']					= $subtpls[$i]['dir'];
				$row['head_stylesheet']		= $subtpls[$i]['head_stylesheet'];
				$row['imagefile']			= $subtpls[$i]['imagefile'];
				for ($j=0; $j < count($subtpls[$i]['keys']); $j++)
				{
					$sub_templates[$subtpls[$i]['keys'][$j]]['name']			= $subtpls[$i]['name'];
					$sub_templates[$subtpls[$i]['keys'][$j]]['dir']				= $subtpls[$i]['dir'];
					$sub_templates[$subtpls[$i]['keys'][$j]]['head_stylesheet'] = $subtpls[$i]['head_stylesheet'];
					$sub_templates[$subtpls[$i]['keys'][$j]]['imagefile']		= $subtpls[$i]['imagefile'];
				}
			}
		}
		ksort( $sub_templates );

		// generate the php file
		if ( $board_config['version'] > '.0.5' )
		{
			$tpl_path = phpbb_realpath($phpbb_root_path . 'templates/' . $stylerow['template_name']);
		}
		else
		{
			$tpl_path = $phpbb_root_path . 'templates/' . $stylerow['template_name'];
		}
		$filename = $tpl_path . '/sub_templates.cfg';
		@CHMOD($filename, 0666);
		@unlink($filename);
		$f = @fopen($filename, 'w' );

		$texte  = "<?php\n";
		@fputs( $f, $texte );
		@fputs( $f, "\n" );
		@reset($sub_templates);
		while ( list($key, $value) = each($sub_templates) )
		{
			$nat	= substr( $key, 0, 1);
			$id		= intval( substr( $key, 1) );
			$name	= '';
			$found	= false;
			for ($i=0; ( ($i < count($board)) && !$found); $i++)
			{
				$found = ( ($board[$i]['type'] == $nat) && ($board[$i]['id'] == $id) );
				if ($found) $name = $board[$i]['name'];
			}
			$texte = "// $name\n";
			@fputs( $f, $texte );
			$texte = "$" . "sub_templates['$key']['name'] = '" . $value['name'] . "';\n";
			@fputs( $f, $texte );
			$texte = "$" . "sub_templates['$key']['dir'] = '" . $value['dir']  . "';\n";
			@fputs( $f, $texte );
			$texte = "$" . "sub_templates['$key']['head_stylesheet'] = '" . $value['head_stylesheet'] . "';\n";
			@fputs( $f, $texte );
			$texte = "$" . "sub_templates['$key']['imagefile'] = '" . $value['imagefile']  . "';\n";
			@fputs( $f, $texte );
			@fputs( $f, "\n" );
		}
		$texte = "?>";
		@fputs( $f, $texte );
		@fclose( $f );

		// send message
		$template->set_filenames(array(
			'body' => 'admin/admin_message_body.tpl')
		);
		$template->assign_vars(array(
			'MESSAGE_TITLE' => $lang['Information'],
			'MESSAGE_TEXT'	=> '<br /><br />' . sprintf( $lang['subtpl_click_return'], '<a href="' . append_sid("admin_subtemplates.$phpEx?mode=stpl&style=$themes_id") . '">', '</a>' ) . '<br /><br /><br />',
			)
		);
	}
	else
	{
		// screen
		$template->set_filenames(array(
			"body" => "admin/admin_subtpl_edit_body.tpl")
		);

		$s_hidden_fields = '';
		$s_hidden_fields .= '<input type="hidden" name="mode" value="' . $mode . '">';
		$s_hidden_fields .= '<input type="hidden" name="style" value="' . $themes_id . '">';
		$s_hidden_fields .= '<input type="hidden" name="id" value="' . $subtpl_id . '">';

		// header
		$template->assign_vars(array(
			'L_SUBTEMPLATE_TITLE'	=> $lang['Subtemplate'],
			'L_SUBTEMPLATE_EXPLAIN' => $lang['Subtemplate_explain'],
			'U_CHOOSE_MAIN_STYLE'	=> append_sid("admin_subtemplates.$phpEx"),
			'L_MAIN_STYLE'			=> $lang['main_style'],
			'U_MAIN_STYLE'			=> append_sid("admin_subtemplates.$phpEx?mode=stpl&style=$themes_id"),
			'MAIN_STYLE'			=> $stylerow['style_name'],
			'L_NAME'				=> $lang['subtpl_name'],
			'L_DIR'					=> $lang['subtpl_dir'],
			'L_HEAD_STYLESHEET'		=> $lang['Stylesheet'],
			'L_IMAGEFILE'			=> $lang['subtpl_imagefile'],
			'L_SUBMIT'				=> $lang['Submit'],
			'L_CANCEL'				=> $lang['Cancel'],
			'L_USAGE'				=> $lang['subtpl_usage'],
			'S_HIDDEN_FIELDS'		=> $s_hidden_fields,
			'NAV_SEPARATOR'			=> $nav_separator,
			)
		);

		// look for sub-dir
		$main_tpl = opendir( $tpl_path );
		$dirs = array();
		while ( $file = readdir($main_tpl) ) if ( is_dir($tpl_path . '/' . $file) && !in_array( $file, array('.', '..', 'admin', 'images') ) ) $dirs[] = $file;
		closedir($main_tpl);

		// build the list
		$select = ( $subtpl_id == -1 ) ? ' selected="selected"' : '';
		$s_dir = '<select name="dir"><option value=""' . $select . '>' . $lang['Select_dir'] . '</option>';
		for ($i=0; $i < count($dirs); $i++) 
		{
			$select = ( $subtpls[$subtpl_id]['dir'] == $dirs[$i] ) ? ' selected="selected"' : '';
			$s_dir .= '<option value="' . $dirs[$i] . '"' . $select . '>' . $dirs[$i] . '</option>';
		}
		$s_dir .= '</select>';

		// value
		$template->assign_vars(array(
			'NAME'				=> ($subtpl_id >= 0) ? $subtpls[$subtpl_id]['name'] : '',
			'S_DIR'				=> $s_dir,
			'HEAD_STYLESHEET'	=> ($subtpl_id >= 0 ) ? $subtpls[$subtpl_id]['head_stylesheet'] : '',
			'IMAGEFILE'			=> ($subtpl_id >= 0) ? $subtpls[$subtpl_id]['imagefile'] : '',
			)
		);

		// display
		for ($i=0; $i < count($board); $i++)
		{
			$checked = '';
			if ( @in_array($board[$i]['type'] . $board[$i]['id'], $subtpls[$subtpl_id]['keys']) ) $checked = ' checked="checked"';

			$template->assign_block_vars('boardrow', array(
				'ROW_CLASS'		=> ( $board[$i]['type'] == POST_CAT_URL ) ? 'cat' : 'row1',
				'SPAN_CLASS'	=> ( $board[$i]['type'] == POST_CAT_URL ) ? 'cattitle' : 'gen',
				'SPAN'			=> $max_inc - $board[$i]['level']+1,
				'NAME'			=> $board[$i]['name'],
				'BOARD_ID'		=> $i,
				'S_CHECKED'		=> $checked,
				)
			);
			for ($j=1; $j <= $board[$i]['level']; $j++) $template->assign_block_vars('boardrow.inc', array());
		}

		$template->assign_vars(array(
			'L_USAGE'			=> $lang['subtpl_usage'],
			'L_FORUM'			=> $lang['Forum'],
			'L_TEMPLATE'		=> $lang['Style'],
			'MAX_SPAN'			=> $max_inc+1,
			'MAX_SPAN_FULL'		=> $max_inc+2,
			'S_CONFIG_ACTION'	=> append_sid("admin_subtemplates.$phpEx"),
			)
		);
	}
}

// sub-templates already defined
if ($mode == 'stpl')
{
	// screen
	$template->set_filenames(array(
		"body" => "admin/admin_subtpl_list_body.tpl")
	);

	$s_hidden_fields = '';
	$s_hidden_fields .= '<input type="hidden" name="mode" value="' . $mode . '">';
	$s_hidden_fields .= '<input type="hidden" name="style" value="' . $themes_id . '">';

	// header
	$template->assign_vars(array(
		'L_SUBTEMPLATE_TITLE'		=> $lang['Subtemplate'],
		'L_SUBTEMPLATE_EXPLAIN'		=> $lang['Subtemplate_explain'],
		'U_CHOOSE_MAIN_STYLE'		=> append_sid("admin_subtemplates.$phpEx"),
		'L_MAIN_STYLE'				=> $lang['main_style'],
		'MAIN_STYLE'				=> $stylerow['style_name'],
		'L_NAME'					=> $lang['subtpl_name'],
		'L_DIR'						=> $lang['subtpl_dir'],
		'L_HEAD_STYLESHEET'			=> $lang['Stylesheet'],
		'L_IMAGEFILE'				=> $lang['subtpl_imagefile'],
		'L_USAGE'					=> $lang['subtpl_usage'],
		'L_EDIT'					=> $lang['Edit'],
		'L_DELETE'					=> $lang['Delete'],
		'L_CREATE'					=> $lang['subtpl_create'],
		'S_HIDDEN_FIELDS'			=> $s_hidden_fields,
		'NAV_SEPARATOR'				=> $nav_separator,
		)
	);

	// sub-templates
	for ($i=0; $i < count( $subtpls ); $i++)
	{
		$row_class = ( !($i % 2) ) ? 'row1' : 'row2';
		$template->assign_block_vars('subtpl', array(
			'ROW_CLASS'				=> $row_class,
			'NAME'					=> $subtpls[$i]['name'],
			'DIR'					=> $subtpls[$i]['dir'],
			'HEAD_STYLESHEET'		=> $subtpls[$i]['head_stylesheet'],
			'IMAGEFILE'				=> $subtpls[$i]['imagefile'],
			'U_EDIT'				=> append_sid("admin_subtemplates.$phpEx?mode=edit&style=$themes_id&id=$i"),
			'U_DELETE'				=> append_sid("admin_subtemplates.$phpEx?mode=delete&style=$themes_id&id=$i"),
			)
		);
	}

	// usage report

	// display
	for ($i=0; $i < count($board); $i++)
	{
		$template->assign_block_vars('boardrow', array(
			'ROW_CLASS'		=> ( $board[$i]['type'] == POST_CAT_URL ) ? 'cat' : 'row1',
			'SPAN_CLASS'	=> ( $board[$i]['type'] == POST_CAT_URL ) ? 'cattitle' : 'gen',
			'SPAN'			=> $max_inc - $board[$i]['level']+1,
			'NAME'			=> $board[$i]['name'],
			)
		);
		for ($j=1; $j <= $board[$i]['level']; $j++) $template->assign_block_vars('boardrow.inc', array());

		// get the sub-template name to display
		$subtemplate = isset($sub_templates[$board[$i]['stpl']]['name']) ? $sub_templates[$board[$i]['stpl']]['name'] : $stylerow['style_name'];
		if ( !isset($sub_templates[$board[$i]['type'] . $board[$i]['id']]) )
		{
			$subtemplate = '<i>' . $subtemplate . '</i>';
		}
		else
		{
			$subtemplate = '<b>' . $subtemplate . '</b>';
		}

		// assign the good column to the tpl
		if (!isset($sub_templates['c0']))
		{
			$template->assign_block_vars('boardrow.tpl', array(
				'SUBTEMPLATE' => ($board[$i]['stpl'] == 'c0') ? $subtemplate : '',
				)
			);
		}
		for ($j=0; $j < count($subtpls); $j++ )
		{
			$template->assign_block_vars('boardrow.tpl', array(
				'SUBTEMPLATE' => (in_array($board[$i]['stpl'], $subtpls[$j]['keys'])) ? $subtemplate : '',
				)
			);
		}
	}
	$span = count($subtpls);
	if (!isset($sub_templates['c0']))
	{
		$span++;
	}
	$template->assign_vars(array(
		'L_USAGE'			=> $lang['subtpl_usage'],
		'L_FORUM'			=> $lang['Forum'],
		'L_TEMPLATE'		=> $lang['Style'],
		'MAX_SPAN'			=> $max_inc+1,
		'MAX_SPAN_FULL'		=> $max_inc+1+count($subtpls)+1,
		'TPL_SPAN'			=> $span,
		'S_CONFIG_ACTION'	=> append_sid("admin_subtemplates.$phpEx"),
		)
	);
}

// default entrance : choose a style
if ($mode == 'style')
{
	// screen
	$template->set_filenames(array(
		"body" => "admin/admin_subtpl_styles_body.tpl")
	);

	// header
	$template->assign_vars(array(
		'L_SUBTEMPLATE_TITLE'		=> $lang['Subtemplate'],
		'L_SUBTEMPLATE_EXPLAIN'		=> $lang['Subtemplate_explain'],
		'L_CHOOSE_MAIN_STYLE'		=> $lang['Choose_main_style'],
		'L_STYLE'					=> $lang['Style'],
		'L_TEMPLATE'				=> $lang['Template'],
		'S_HIDDEN_FIELDS'			=> '',
		'NAV_SEPARATOR'				=> $nav_separator,
		)
	);

	// read defined theme
	$sql = "select * from " . THEMES_TABLE . " ORDER BY template_name";
	if(!$result = $db->sql_query($sql)) message_die(GENERAL_ERROR, "Could not get style information!", "", __LINE__, __FILE__, $sql);
	while ( $row = $db->sql_fetchrow($result) )
	{
		$row_class = ( !($i % 2) ) ? 'row1' : 'row2';
		$template->assign_block_vars('styles', array(
			'ROW_CLASS'			=> $row_class,
			'STYLE_NAME'		=> $row['style_name'],
			'TEMPLATE_NAME'		=> $row['template_name'],
			'U_STYLES_CHOOSEN'	=> append_sid("admin_subtemplates.$phpEx?mode=stpl&style=" . $row['themes_id']),
			)
		);
	}
}

//
// footer
$template->pparse("body");
include('./page_footer_admin.'.$phpEx);

?>