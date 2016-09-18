<?php
/***************************************************************************
*                             admin_forum_tour.php
*                              -------------------
*     copyright            : (C) 2004 OXPUS
*     email                : webmaster@oxpus.de
*
****************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

define('IN_PHPBB', 1);

if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['Applications']['Forum_Tour'] = $filename;

	return;
}

//
// Load default header
//
$no_page_header = TRUE;
$phpbb_root_path = './../';
require($phpbb_root_path . 'extension.inc');
define('CT_SECLEVEL', 'LOW');
$ct_ignorepvar = array('helpbox');
require('./pagestart.' . $phpEx);
include($phpbb_root_path . 'includes/bbcode.'.$phpEx);
include($phpbb_root_path . 'includes/functions_post.'.$phpEx);

//
// Check and set various parameters
//
$params = array(
	'submit' => 'submit',
	'id' => 'id',
	'default' => 'default',
	'cancel' => 'cancel',
	'delete' => 'delete',
	'mode' => 'mode',
	'edit' => 'edit',
	'move' => 'move',
	'confirm' => 'confirm');

while( list($var, $param) = @each($params) )
{
	if ( !empty($_POST[$param]) || !empty($_GET[$param]) )
	{
		$$var = ( !empty($_POST[$param]) ) ? $_POST[$param] : $_GET[$param];
	}
	else
	{
		$$var = '';
	}
}

$mode = ( $mode != 'cancel' || !$cancel ) ? $mode : '';
$mode = ( $mode == 'confirm' && $confirm ) ? 'delete' : $mode;
$mode = ( $cancel ) ? '' : $mode;

function reorder_pages()
{
	global $db;

	$sql = "SELECT page_id, page_sort FROM ". FORUM_TOUR_TABLE ."
		ORDER BY page_sort ASC";
	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not get list of forum tour pages', '', __LINE__, __FILE__, $sql);
	}

	$i = 10;

	while( $row = $db->sql_fetchrow($result) )
	{
		$sql2 = "UPDATE ". FORUM_TOUR_TABLE ."
			SET page_sort = $i
			WHERE page_id = ". $row['page_id'];
		if( !$db->sql_query($sql2) )
		{
			message_die(GENERAL_ERROR, 'Could not update order forum tour pages', '', __LINE__, __FILE__, $sql);
		}
		$i += 10;
	}
}

//
// Set variables on default values
$page_subject = '';
$page_text = '';
$page_bbcode_uid = '';
$page_sort = '';

$page_title =  $lang['Forum_tour'];

switch ( $mode  )
{
	case 'smilies':
		$smilies_path = $board_config['smilies_path'];
		$board_config['smilies_path'] = './../'.$board_config['smilies_path'];

		$emoticom = FALSE;
		$mode = 'edit';

		generate_smilies('window', PAGE_FORUM_TOUR);

		$board_config['smilies_path'] = $smilies_path;

		$mode = '';

		break;

	case 'submit':
		$subject = stripslashes(trim($_POST['subject']));
		$message = stripslashes(trim($_POST['message']));
		$page_access = intval($_POST['page_access']);

		$error = FALSE;
		$error_msg = '';

		if ( empty($subject) )
		{
			$error = true;
			$error_msg .= ( !empty($error_msg) ) ? '<br />' . $lang['FT_empty_subject'] : $lang['FT_empty_subject'];
		}

		if ( empty($message) )
		{
			$error = true;
			$error_msg .= ( !empty($error_msg) ) ? '<br />' . $lang['FT_empty_message'] : $lang['FT_empty_message'];
		}

		if ( $error )
		{
			include('./page_header_admin.'.$phpEx);

			$template->set_filenames(array(
				'reg_header' => 'error_body.tpl')
			);
			$template->assign_vars(array(
				'ERROR_MESSAGE' => $error_msg)
			);
			$template->pparse('reg_header');

			include('./page_footer_admin.'.$phpEx);
		}

		$subject = addslashes($subject);
		$message = addslashes($message);

		if ( $id != '' )
		{
			$bbcode_uid = trim($_POST['bbcode_uid']);
			$message = make_clickable($message);
			$message = prepare_message(trim($message), 1, 1, 1, $bbcode_uid);

			$sql = "UPDATE " . FORUM_TOUR_TABLE . "
				SET page_subject = '$subject', page_text = '$message', page_access = $page_access
				WHERE page_id = $id";
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not update forum tour page', '', __LINE__, __FILE__, $sql);
			}
				}
		else
		{
			$sql = "SELECT max(page_id) as maxid FROM " . FORUM_TOUR_TABLE;
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not check forum tour page', '', __LINE__, __FILE__, $sql);
			}
			while ( $row = $db->sql_fetchrow($result) )
			{
				$id = $row['maxid'];
			}

			$id++;
			$page = $id * 10;

			$bbcode_uid = make_bbcode_uid();
			$message = make_clickable($message);
			$message = prepare_message(trim($message), 0, 1, 1, $bbcode_uid);

			$sql = "INSERT INTO " . FORUM_TOUR_TABLE . " (page_id, page_subject, page_text, page_sort, bbcode_uid, page_access)
				VALUES ($id, '$subject', '$message', $page, '$bbcode_uid', $page_access)";
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not insert forum tour page', '', __LINE__, __FILE__, $sql);
			}
		}

		break;

	case 'delete':

		if ( $id == '' )
		{
			message_die(GENERAL_ERROR, 'ID unknown! No delete.', '', __LINE__, __FILE__, $sql);
		}

		$sql = "DELETE FROM " . FORUM_TOUR_TABLE . "
			WHERE page_id = $id";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not delete forum tour page', '', __LINE__, __FILE__, $sql);
		}

		reorder_pages();

		break;

	case 'confirm':

		include('./page_header_admin.'.$phpEx);
		if ( $id != '' )
		{
			$template->set_filenames(array(
				'body' => 'admin/admin_confirm_ft.tpl')
			);

			$sql = "SELECT page_subject FROM " . FORUM_TOUR_TABLE . "
				WHERE page_id = $id";
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not read forum tour page', '', __LINE__, __FILE__, $sql);
			}
			while ( $row = $db->sql_fetchrow($result) )
			{
				$subject = $row['page_subject'];
			}

			$template->assign_vars(array(
				'S_ACTION' => append_sid('admin_forum_tour.'.$phpEx.'?mode=confirm&amp;id='.$id),
				'L_SUBJECT' => sprintf($lang['Confirm_delete_ft'], htmlspecialchars(trim(stripslashes($subject)))),
				'L_YES' => $lang['Yes'],
				'L_NO' => $lang['No'])
			);

			$template->pparse('body');
		}
		include('./page_footer_admin.'.$phpEx);

		break;

	case  'edit':

		$subject = '';
		$message = '';
		$bbcode_uid = '';
		$page = '';
		$page_access = '';
		$access = '';

		if ( $id != 0 )

		{
			$sql = "SELECT * FROM ". FORUM_TOUR_TABLE ."
				WHERE page_id = $id";
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not get forum tour page', '', __LINE__, __FILE__, $sql);
			}

			$tour_page = array();
			while( $row = $db->sql_fetchrow($result) )
			{
				$tour_page = $row;
			}

			$subject = stripslashes($tour_page['page_subject']);
			$message = stripslashes($tour_page['page_text']);
			$bbcode_uid = $tour_page['bbcode_uid'];
			$page = $tour_page['page_id'];
			$page_access = $tour_page['page_access'];

			$message = preg_replace('/\:(([a-z0-9]:)?)' . $bbcode_uid . '/s', '', $message);

			$s_action = append_sid("admin_forum_tour.$phpEx?mode=submit&id=$id");
			$l_mode = $page_title . ': ' . $lang['Edit'];
		}
		else
		{
			$s_action = append_sid("admin_forum_tour.$phpEx?mode=submit");
			$l_mode = $page_title . ': ' . $lang['Add_new'];
		}

		$page_access = ( $page_access != '' ) ? $page_access : ANONYMOUS;

		$access = '<select name="page_access">';
		$access .= '<option value="'.ANONYMOUS.'">'.$lang['FT_Guest'].'</option>';
		$access .= '<option value="'.USER.'">'.$lang['FT_User'].'</option>';
		$access .= '<option value="'.MOD.'">'.$lang['FT_Mod'].'</option>';
		$access .= ( defined('LESS_ADMIN' ) ) ? '<option value="'.LESS_ADMIN.'">'.$lang['FT_less_admin'].'</option>' : '';
		$access .= '<option value="'.ADMIN.'">'.$lang['FT_admin'].'</option>';
		$access .= '</select>';

		$access = str_replace('value="'.$page_access.'">', 'value="'.$page_access.'" SELECTED>', $access);

		include('./page_header_admin.'.$phpEx);

		$template->set_filenames(array(
			'body' => 'admin/edit_pages_body.tpl')
		);

		$template->assign_vars(array(
			'SUBJECT' => $subject,
			'MESSAGE' => $message,
			'FORUM_LIST' => 'javascript:forum_links()',
			'USID' => append_sid("forum_tour_links.$phpEx"),
			'BBCODE_UID' => $bbcode_uid,
			'PAGE_ACCESS' => $access,
			'L_INDEX' => sprintf($lang['Forum_Index'], ''),
			'L_MODE' => $l_mode,
			'L_FONT_COLOR' => $lang['Font_color'],
			'L_COLOR_DARK_RED' => $lang['color_dark_red'],
			'L_COLOR_RED' => $lang['color_red'],
			'L_COLOR_ORANGE' => $lang['color_orange'],
			'L_COLOR_BROWN' => $lang['color_brown'],
			'L_COLOR_YELLOW' => $lang['color_yellow'],
			'L_COLOR_GREEN' => $lang['color_green'],
			'L_COLOR_OLIVE' => $lang['color_olive'],
			'L_COLOR_CYAN' => $lang['color_cyan'],
			'L_COLOR_BLUE' => $lang['color_blue'],
			'L_COLOR_DARK_BLUE' => $lang['color_dark_blue'],
			'L_COLOR_INDIGO' => $lang['color_indigo'],
			'L_COLOR_VIOLET' => $lang['color_violet'],
			'L_COLOR_WHITE' => $lang['color_white'],
			'L_COLOR_BLACK' => $lang['color_black'],
			'L_FONT_SIZE' => $lang['Font_size'],
			'L_SUBJECT' => $lang['Subject'],
			'L_MESSAGE' => $lang['Message_body'],
			'L_SUBMIT' => $lang['Submit'],
			'L_ACCESS' => $lang['Permissions'],
			'S_POST_ACTION' => $s_action,
			'S_PAGE_ID' => $page,
			'L_SMILIES' => $lang['Emoticons'],
			'U_SMILIES' => append_sid("admin_forum_tour.$phpEx?mode=smilies"),
			'L_CLOSE' => $lang['Close_window'].' / '.$lang['Cancel'],
			'U_CLOSE' => append_sid("admin_forum_tour.$phpEx"))
		);
		$template->pparse('body');
		include('./page_footer_admin.'.$phpEx);

		break;

	case 'move':

		$sql = "UPDATE ". FORUM_TOUR_TABLE ."
			SET page_sort = page_sort + $move
			WHERE page_id = $id";
		if( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not update order forum tour pages', '', __LINE__, __FILE__, $sql);
		}

		reorder_pages();

		break;
}

//
// Default
include('./page_header_admin.'.$phpEx);

$ids = $subject = $send = $sent_to = $page_access = array();

$sql = "SELECT page_id, page_subject, page_sort, page_access FROM " . FORUM_TOUR_TABLE . "
	ORDER BY page_sort";
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not get forum tour subjects', '', __LINE__, __FILE__, $sql);
}
while ( $row = $db->sql_fetchrow($result) )
{
	$ids[] = $row['page_id'];
	$subject[] = $row['page_subject'];
	$page_sort[] = $row['page_sort'];
	$page_access[] = $row['page_access'];
}

$template->set_filenames(array(
	'body' => 'admin/admin_forum_tour_body.tpl')
);

$template->assign_vars(array(
	'L_PAGE_NAME' => $page_title,
	'L_SUBJECT' => $lang['Subject'],
	'L_ACCESS' => $lang['Permissions'],
	'L_DELETE' => $lang['Delete'],
	'L_EDIT' => $lang['Edit'],
	'L_MOVE_UP' => $lang['Move_up'],
	'L_MOVE_DOWN' => $lang['Move_down'],
	'L_NEW_SITE' => $lang['New_forum_tour_page'],
	'L_PREVIEW' => $lang['Preview'],
	'S_ACTION_ADD' => append_sid("admin_forum_tour.$phpEx?mode=edit"))
);

if ( count($ids) <= 0 )

{
	$template->assign_block_vars('no_forum_pages', array(
		'NO_SITES' => $lang['No_forum_pages'])
	);
}
else
{
	for ( $i=0; $i < count($ids); $i++ )
	{
		$access = '';
		switch ($page_access[$i])
		{
			case ANONYMOUS:
					$access = $lang['FT_Guest'];
					break;
			case USER:
					$access = $lang['FT_User'];
					break;
			case MOD:
					$access = $lang['FT_Mod'];
					break;
			case LESS_ADMIN:
					$access = $lang['FT_less_admin'];
					break;
			case ADMIN:
					$access = $lang['FT_admin'];
					break;
			default:
					$access = $lang['FT_Guest'];
					break;
		}

		$template->assign_block_vars('forum_tour_pages', array(
			'ROW_CLASS' => ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'],
			'SUBJECT' => htmlspecialchars(trim(stripslashes($subject[$i]))),
			'PAGE_ACCESS' => $access,
			'S_MOVE_UP' => append_sid("admin_forum_tour.$phpEx?mode=move&amp;move=-15&amp;id=$ids[$i]"),
			'S_MOVE_DOWN' => append_sid("admin_forum_tour.$phpEx?mode=move&amp;move=15&amp;id=$ids[$i]"),
			'U_EDIT' => append_sid("admin_forum_tour.$phpEx?mode=edit&amp;id=$ids[$i]"),
			'U_DELETE' => append_sid("admin_forum_tour.$phpEx?mode=confirm&amp;id=$ids[$i]"))
		);
	}
}

$template->pparse('body');

include('./page_footer_admin.'.$phpEx);

?>