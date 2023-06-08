<?php
/***************************************************************************
 *                              forum_tour.php
 *                            -------------------
 *   copyright            : (C) 2004 OXPUS
 *   email                : administrator@oxpus.de
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

// Define page is using in phpBB
define('IN_PHPBB', true);

// Include required files
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);
include($phpbb_root_path . 'includes/functions_post.'.$phpEx);
include($phpbb_root_path . 'includes/bbcode.'.$phpEx);

//
// Start session management
$userdata = session_pagestart($user_ip, PAGE_FORUM_TOUR);
init_userprefs($userdata);

//
// Set variables on default values
$page_subject = '';
$page_text = '';
$page_bbcode_uid = '';
$page_sort = '';
$pagination = '';
$first_page = '';

//
// Load templates
$page_title = $lang['Forum_tour'];
$gen_simple_header = TRUE;
include($phpbb_root_path . 'includes/page_header.'.$phpEx);

$template->set_filenames(array(
	'body' => 'tour_body.tpl')
);

//
// Get currect page number
$start = 0;
$page = ( $_POST['page'] ) ? $_POST['page'] : $_GET['page'];
$page = ( !$page ) ? $start : intval($page);
$cp = ( $_POST['cp'] ) ? $_POST['cp'] : $_GET['cp'];
$cp = intval($cp);

// Check userlevel and prepare page access
switch ($userdata['user_level'])
{
	case ANONYMOUS:
			$sql_access = 'page_access = '.ANONYMOUS;
			break;
	case USER:
			$sql_access = 'page_access IN ('.ANONYMOUS.', '.USER.')';
			break;
	case MOD:
			$sql_access = 'page_access IN ('.ANONYMOUS.', '.USER.', '.MOD.')';
			break;
	case LESS_ADMIN:
			$sql_access = 'page_access <> '.ADMIN;
			break;
	case ADMIN:
			$sql_access = '';
			break;
	default:
			$sql_access = 'page_access = '.ANONYMOUS;
			break;
}
if ( $userdata['user_id'] == ANONYMOUS )
{
	$sql_access = 'page_access = '.ANONYMOUS;
}

//
// Check for content
$sql = "SELECT count(page_subject) as max_page FROM " . FORUM_TOUR_TABLE . ( ( $sql_access != '' ) ? " WHERE $sql_access" : '' );
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, "Could not obtain forum tour data.", '', __LINE__, __FILE__, $sql);
}

while ($row = $db->sql_fetchrow($result))
{
	$max_page = $row['max_page'];
}

if ( $max_page != 0 )
{
	$page_count = $max_page;
	//
	// Create forum tour
	if ( $page == 0 )
	{
		//
		// Create first page per default or on demand
		$sql = "SELECT page_subject, page_sort FROM " . FORUM_TOUR_TABLE . ( ( $sql_access != '' ) ? " WHERE $sql_access" : '' ) . "
			ORDER BY page_sort";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, "Could not obtain forum tour.", '', __LINE__, __FILE__, $sql);
		}

		while ($row = $db->sql_fetchrow($result))
		{
			$first_page .= ( $first_page != '' ) ? '<br /><br /><a href="'.append_sid("tour.$phpEx?page=".$row['page_sort']).'" class=mainmenu>'.$row['page_subject'].'</a>' : '<a href="'.append_sid("tour.$phpEx?page=".$row['page_sort']).'" class=mainmenu>'.$row['page_subject'].'</a>';
		}

		$page_subject = $lang['First_page'];
		$page_text = $first_page;
		$page_bbcode_uid = '';
		$page_sort = 0;
	}
	else
	{
		//
		// Get another page
		$sql = "SELECT * FROM " . FORUM_TOUR_TABLE . "
			WHERE page_sort = $page" . ( ( $sql_access != '' ) ? " AND $sql_access" : '' );
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, "Could not obtain forum tour.", '', __LINE__, __FILE__, $sql);
		}

		while ($row = $db->sql_fetchrow($result))
		{
			$page_subject = $row['page_subject'];
			$page_text = $row['page_text'];
			$page_bbcode_uid = $row['bbcode_uid'];
			$page_sort = $row['page_sort'];
		}
	}

	//
	// Get pagination
	$sql = "SELECT * FROM " . FORUM_TOUR_TABLE . ( ( $sql_access != '' ) ? " WHERE $sql_access" : '' ) . " ORDER BY page_sort";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Could not obtain forum tour.", '', __LINE__, __FILE__, $sql);
	}

	$page_sort = array();
	while ($row = $db->sql_fetchrow($result))
	{
		$page_sort[] = $row['page_sort'];
	}

	for ( $i = 0; $i < $max_page; $i++ )
	{
		$j = $i + 1;
		$tour_page = $page_sort[$i];
		$tour_page = ( $tour_page != $page ) ? '<a href="'.append_sid("tour.$phpEx?page=$tour_page&amp;cp=$i").'" class="nav">'.$j.'</a>' : $j;
		$pagination .= ( $pagination == '' ) ? ' '.$tour_page : ', '.$tour_page;
	}

	if ( $cp != 0 && $page != 0 && $page != 10 )
	{
		$i = $cp - 1;
		$goto_page = $page_sort[$i];
		$prev_page = '<input class="mainoption" type="submit" name="page" value="'.$lang['Previous'].'" onClick="javascript:tour(\''.append_sid("tour.$phpEx?page=".($goto_page)."&cp=$i").'\')">';
	}
	else
	{
		$prev_page = '<input class="mainoption" type="submit" name="page" value="'.$lang['Previous'].'" disabled="disabled">';
	}

	$i = ( $page == 0 ) ? 0 : $cp + 1;

	if ( $i < $max_page )
	{
		$goto_page = $page_sort[$i];
		$next_page = '<input class="mainoption" type="submit" name="page" value="'.$lang['Next'].'" onClick="javascript:tour(\''.append_sid("tour.$phpEx?page=".($goto_page)."&cp=$i").'\')">';
	}
	else
	{
		$next_page = '<input class="mainoption" type="submit" name="page" value="'.$lang['Next'].'" disabled="disabled">';
	}

	$page_one = ( $page != 0 ) ? '<input class="mainoption" type="submit" name="page" value="'.$lang['First_page'].'" onClick="javascript:tour(\''.append_sid("tour.$phpEx?page=0&cp=0").'\')">' : '<input class="mainoption" type="submit" name="page" value="'.$lang['First_page'].'" disabled="disabled">';

	$pagination = ( ( $page != 0 && $page_count != 1 ) ? '<br /><br />' . $lang['Tour_page'] . $pagination : '' );

	//
	// Prepare the currect page for output
	$subject = stripslashes($page_subject);
	$message = stripslashes($page_text);
	$message = smilies_pass($message);

	$message = bbencode_second_pass($message, $page_bbcode_uid);

	$message = str_replace("\n", "\n<br />\n", $message);

	//
	// Pull the page to the template
	$template->assign_block_vars('forum_tour', array(
		'SUBJECT' => $subject,
		'MESSAGE' => $message,
		'PAGINATION' => $pagination,
		'NAV_PREV' => $prev_page,
		'NAV_NEXT' => $next_page,
		'NAV_FIRST_PAGE' => $page_one)
	);
}
else
{
	$template->assign_block_vars('switch_no_forum_tour', array(
		'L_NO_FORUM_TOUR' => $lang['No_forum_tour'])
	);
}

//
// Pull global values to template
$template->assign_vars(array(
	'L_CLOSE_TOUR' => $lang['Tour_close'])
);

//
// Create the current page
$template->pparse('body');

//
// Include the forum footer
include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>
