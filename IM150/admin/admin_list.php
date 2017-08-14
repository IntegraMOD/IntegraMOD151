<?php
/***************************************************************************
 *                             Admin + Mods list
 *                            -------------------
 *   begin                : Thursday, Apr 1, 2004
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : woody@scoobler.com
 ***************************************************************************/

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
	$file = basename(__FILE__);
	$module['Users']['Admins & Mod\'s'] = $file;
	return;
}
//
// Let's set the root dir for phpBB
//
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

include($phpbb_root_path.'language/lang_' . $board_config['default_lang'] . '/lang_admin_list.'.$phpEx);

//
// Let's set the template
//
$template->set_filenames(array("body" => "admin/user_list_body.tpl"));

//
// Lets see how many Admin there are
//
$sql = "SELECT *
  FROM " . USERS_TABLE . "
	WHERE user_level='1'";
if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Could not query database.", $lang['Error'], __LINE__, __FILE__, $sql);
	}
$baner_rows = $db->sql_fetchrowset($result);
$baner_count = count($baner_rows);


for($i = 0; $i < $baner_count; $i++)
	{
		$baner_link = $baner_rows[$i]['username'];
		$baner_desc = $baner_rows[$i]['user_id'];
	
		$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
		$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

		$template->assign_block_vars("LIST",array(
			"ROW_COLOR" => "#" . $row_color,
			"ROW_CLASS" => $row_class,
			"BANER_DESC" => $baner_desc,
			"BANER_LINK" => $baner_link));
  }
  
//
// Lets see how many Moderators there are
//
$sql2 = "SELECT *
  FROM " . USERS_TABLE . "
	WHERE user_level='2'";
if( !($result2 = $db->sql_query($sql2)) )
	{
		message_die(GENERAL_ERROR, "Could not query database.", $lang['Error'], __LINE__, __FILE__, $sql2);
	}
$baner_rows2 = $db->sql_fetchrowset($result2);
$baner_count2 = count($baner_rows2);


for($i = 0; $i < $baner_count2; $i++)
	{
		$baner_link2 = $baner_rows2[$i]['username'];
		$baner_desc2 = $baner_rows2[$i]['user_id'];
	
		$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
		$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

		$template->assign_block_vars("LIST2",array(
			"ROW_COLOR" => "#" . $row_color,
			"ROW_CLASS" => $row_class,
			"BANER_DESC" => $baner_desc2,
			"BANER_LINK" => $baner_link2));
  }
  
//
// Lets see how many Junior Admin there are
//
$sql3 = "SELECT u.*
         FROM " . USERS_TABLE . " AS u, " . JR_ADMIN_TABLE . " AS j
         WHERE u.user_id = j.user_id
            AND j.user_jr_admin <> ''";

if( !($result3 = $db->sql_query($sql3)) )
	{
		message_die(GENERAL_ERROR, "Could not query database.", $lang['Error'], __LINE__, __FILE__, $sql3);
	}
$baner_rows3 = $db->sql_fetchrowset($result3);
$baner_count3 = count($baner_rows3);

for($i = 0; $i < $baner_count3; $i++)
{
  $baner_link3 = $baner_rows3[$i]['username'];
  $baner_desc3 = $baner_rows3[$i]['user_id'];

  $row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
  $row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

  $template->assign_block_vars("LIST3",array(
    "ROW_COLOR" => "#" . $row_color,
    "ROW_CLASS" => $row_class,
    "BANER_DESC" => $baner_desc3,
    "BANER_LINK" => $baner_link3
  ));
}
  
$template->assign_vars(array(
	"TITLE" => $lang['Admin_mod_list'],
    "EXPLAIN" => sprintf($lang['Admin_mod_explain'], strval($baner_count), strval($baner_count2), strval($baner_count3)),
	"ADMIN" => $lang['Admin_admin'],
	"MOD" => $lang['Admin_moderator'],
	"JUNIOR" => $lang['Admin_junior'],
	"USERNAME" => $lang['Username'],
	"MEMBER_NO" => $lang['Member_no'],
	"S_WORDS_ACTION" => append_sid("admin_linkb.$phpEx"),
	"S_HIDDEN_FIELDS" => '',
  ));
  
  
$template->pparse("body");
include('./page_footer_admin.'.$phpEx);
?>