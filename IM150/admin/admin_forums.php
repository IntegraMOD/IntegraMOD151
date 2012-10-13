<?php
/***************************************************************************
 *                             admin_forums.php
 *                            -------------------
 *   begin                : Thursday, Jul 12, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
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

define('IN_PHPBB', 1);

if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['approve_admin_approval']['approve_admin_edit_forums']= $file;
	return;
}

//
// Load default header
//
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
include($phpbb_root_path . 'includes/functions_admin.'.$phpEx);

//
// Mode setting
//
if( isset($HTTP_POST_VARS['mode']) || isset($HTTP_GET_VARS['mode']) )
{
	$mode = ( isset($HTTP_POST_VARS['mode']) ) ? $HTTP_POST_VARS['mode'] : $HTTP_GET_VARS['mode'];
	$mode = htmlspecialchars($mode);
}
else
{
	$mode = "";
}

// ------------------
// Begin function block
//
function get_info($id)
{
	global $db;

	$table = FORUMS_TABLE;
	$idfield = 'forum_id';
	$namefield = 'forum_name';

	$sql = "SELECT *
		FROM $table
		WHERE $idfield = $id"; 

	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, "Couldn't get Forum/Category information", "", __LINE__, __FILE__, $sql);
	}

	if( $db->sql_numrows($result) != 1 )
	{
		message_die(GENERAL_ERROR, "Forum/Category doesn't exist or multiple forums/categories with ID $id", "", __LINE__, __FILE__);
	}

	$return = $db->sql_fetchrow($result);
	return $return;
}

//
// End function block
// ------------------

if( !empty($mode) ) 
{
	switch($mode)
	{
		case 'editforum':
			//
			// Show form to create/modify a forum
			//
			if ($mode == 'editforum')
			{
				// $newmode determines if we are going to INSERT or UPDATE after posting?

				$l_title = $lang['Edit_forum'];
				$newmode = 'modforum';
				$buttonvalue = $lang['Update'];

				$forum_id = intval($HTTP_GET_VARS[POST_FORUM_URL]);

				$row = get_info($forum_id);

				$cat_id = $row['cat_id'];
				$forumname = $row['forum_name'];
				$forumdesc = $row['forum_desc'];
				$forumstatus = $row['forum_status'];
// 
// Begin Approve_Mod Block : 14
// 
				$approve_mod = array();
				$sql = "SELECT * FROM " . APPROVE_FORUMS_TABLE . " 
					WHERE forum_id = " . intval($forum_id); 
				if ( !($result = $db->sql_query($sql)) ) 
				{ 
					message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'], '', __LINE__, __FILE__, $sql); 
				} 
				if ( $row_approve = $db->sql_fetchrow($result) ) 
				{         
					$approve_mod['moderators'] = array();
					$approve_mod['moderators'] = explode('|', $row_approve['approve_moderators']);

					$row_approve['approve_notify_user_options'] = '';					
					$row_approve['approve_notify_user_list'] = '';

					for($i = 0; !empty($approve_mod['moderators'][$i]); $i++)
					{
						$sql = "SELECT username
							FROM " . USERS_TABLE . "
							WHERE user_id = " . intval($approve_mod['moderators'][$i]);
						if ( !$result = $db->sql_query($sql) )
						{
							message_die(GENERAL_ERROR, "Couldn't get forum Prune Information","",__LINE__, __FILE__, $sql);
						}
						if ( $row_user = $db->sql_fetchrow($result) )
						{
							if ( $row_user['user_id'] != ANONYMOUS )
							{
								$row_approve['approve_notify_user_options'] = $row_approve['approve_notify_user_options'] . "\n<option>" . $row_user['username'] . "</option>";
								if ( $row_approve['approve_notify_user_list'] == '' )
								{
									$row_approve['approve_notify_user_list'] = $row_user['username'];
								}
								else
								{
									$row_approve['approve_notify_user_list'] = $row_approve['approve_notify_user_list'] . "  |  " . $row_user['username'];
									//used two spaces on either side, because phpBB truncates spaces in usernames.
								}
							}
						}
					}

					$approve_mod['notify_user_options'] = $row_approve['approve_notify_user_options'];
					$approve_mod['notify_user_list'] = $row_approve['approve_notify_user_list'];
					$approve_mod['enabled'] = ( intval($row_approve['enabled']) == 1 ) ? "checked" : ""; 
					$approve_mod['posts_enabled'] = ( intval($row_approve['approve_posts']) == 1 ) ? "checked" : ""; 
					$approve_mod['poste_enabled'] = ( intval($row_approve['approve_poste']) == 1 ) ? "checked" : ""; 
					$approve_mod['topics_enabled'] = ( intval($row_approve['approve_topics']) == 1 ) ? "checked" : ""; 
					$approve_mod['topice_enabled'] = ( intval($row_approve['approve_topice']) == 1 ) ? "checked" : ""; 
					$approve_mod['users_enabled'] = ( intval($row_approve['approve_users']) == 1 ) ? "checked" : "";
					$approve_mod['users_disabled'] = ( intval($row_approve['approve_users']) == 1 ) ? "" : "checked";
					$approve_mod['notify_user_enabled'] = ( intval($row_approve['approve_notify_approval']) == 1 ) ? "checked" : "";
					$approve_mod['notify_user_disabled'] = ( intval($row_approve['approve_notify_approval']) == 1 ) ? "" : "checked";
					$approve_mod['notify_enabled'] = ( intval($row_approve['approve_notify']) == 1 ) ? "checked" : "";
					$approve_mod['notify_disabled'] = ( intval($row_approve['approve_notify']) == 1 ) ? "" : "checked";
					$approve_mod['notify_pm_enabled'] = ( intval($row_approve['approve_notify_type']) == 1 ) ? "checked" : "";
					$approve_mod['notify_email_enabled'] = ( intval($row_approve['approve_notify_type']) == 1 ) ? "" : "checked";
					$approve_mod['notify_message_enabled'] = ( intval($row_approve['approve_notify_message']) == 1 ) ? "checked" : "";
					$approve_mod['notify_message_len'] = intval($row_approve['approve_notify_message_len']);
					$approve_mod['notify_posts_enabled'] = ( intval($row_approve['approve_notify_posts']) == 1 ) ? "checked" : "";
					$approve_mod['notify_poste_enabled'] = ( intval($row_approve['approve_notify_poste']) == 1 ) ? "checked" : "";
					$approve_mod['notify_topics_enabled'] = ( intval($row_approve['approve_notify_topics']) == 1 ) ? "checked" : "";
					$approve_mod['notify_topice_enabled'] = ( intval($row_approve['approve_notify_topice']) == 1 ) ? "checked" : "";
					$approve_mod['hide_topics_enabled'] = ( intval($row_approve['forum_hide_unapproved_topics']) == 1 ) ? "checked" : "";
					$approve_mod['hide_posts_enabled'] = ( intval($row_approve['forum_hide_unapproved_posts']) == 1 ) ? "checked" : "";
					$approve_mod['hide_topics_disabled'] = ( intval($row_approve['forum_hide_unapproved_topics']) == 1 ) ? "" : "checked";
					$approve_mod['hide_posts_disabled'] = ( intval($row_approve['forum_hide_unapproved_posts']) == 1 ) ? "" : "checked";
				}
// 
// End Approve_Mod Block : 14
//

			}

			$template->set_filenames(array(
				"body" => "admin/forum_edit_body.tpl")
			);

			$s_hidden_fields = '<input type="hidden" name="mode" value="' . $newmode .'" /><input type="hidden" name="' . POST_FORUM_URL . '" value="' . $forum_id . '" />';

//	
// Begin Approve_Mod Block : 15
//
			if ( $mode == 'editforum' )
			{
				$template->assign_block_vars("approve_mod_switch", array() );
				$template->assign_vars(array(
					'L_APPROVE_POSTS' => $lang['approve_admin_posts'],
					'L_APPROVE_ENABLE' => $lang['approve_admin_enable'],
					'L_APPROVE_POSTS_TOPICS' => $lang['approve_admin_posts_topics'],
					'L_APPROVE_NOTIFY_POSTS_TOPICS' => $lang['approve_admin_notify_posts_topics'],
					'L_APPROVE_POSTS_ENABLE' => $lang['approve_admin_posts_enable'],
					'L_APPROVE_TOPICS_ENABLE' => $lang['approve_admin_topics_enable'], 
					'L_APPROVE_USERS_ENABLE' => $lang['approve_admin_users_enable'], 
					'L_APPROVE_USERS_ALL' => $lang['approve_admin_users_all'], 
					'L_APPROVE_USERS_MOD' => $lang['approve_admin_users_mod'], 
					'L_APPROVE_POSTE_ENABLE' => $lang['approve_admin_poste_enable'], 
					'L_APPROVE_TOPICE_ENABLE' => $lang['approve_admin_topice_enable'], 
					'L_APPROVE_NOTIFY_ENABLE' => $lang['approve_admin_notify_admin_enable'],
					'L_APPROVE_NOTIFY_USER_ENABLE' => $lang['approve_admin_notify_user_enable'],
					'L_APPROVE_NOTIFY_TYPE' => $lang['approve_admin_notify_type'],
					'L_APPROVE_NOTIFY_PM_ENABLE' => $lang['approve_admin_notify_pm_enable'],
					'L_APPROVE_NOTIFY_EMAIL_ENABLE' => $lang['approve_admin_notify_email_enable'],
					'L_APPROVE_NOTIFY_MESSAGE_ENABLE' => $lang['approve_admin_notify_message_enable'],
					'L_APPROVE_NOTIFY_MESSAGE_LEN' => $lang['approve_admin_notify_message_length'],
					'L_APPROVE_NOTIFY_ENABLED' => $lang['Enabled'],
					'L_APPROVE_NOTIFY_DISABLED' => $lang['Disabled'], 
					'L_APPROVE_NOTIFY_USER' => $lang['approve_admin_moderators'],
					'L_APPROVE_NOTIFY_POSTS_ENABLE' => $lang['approve_admin_notify_posts_enable'],
					'L_APPROVE_NOTIFY_POSTE_ENABLE' => $lang['approve_admin_notify_poste_enable'],
					'L_APPROVE_NOTIFY_TOPICS_ENABLE' => $lang['approve_admin_notify_topics_enable'],
					'L_APPROVE_NOTIFY_TOPICE_ENABLE' => $lang['approve_admin_notify_topice_enable'],
					'L_APPROVE_BUTTON_FIND' => $lang['approve_admin_button_find'],
					'L_APPROVE_BUTTON_ADD' => $lang['approve_admin_button_add'],
					'L_APPROVE_BUTTON_REM' => $lang['approve_admin_button_rem'],
					'L_APPROVE_HIDE_TOPICS_ENABLE' => $lang['approve_admin_hide_topics_enable'],
					'L_APPROVE_HIDE_POSTS_ENABLE' => $lang['approve_admin_hide_posts_enable'],
					'S_APPROVE_ENABLED' => $approve_mod['enabled'],
					'S_APPROVE_POSTS_ENABLED' => $approve_mod['posts_enabled'],
					'S_APPROVE_POSTE_ENABLED' => $approve_mod['poste_enabled'],
					'S_APPROVE_TOPICS_ENABLED' => $approve_mod['topics_enabled'],
					'S_APPROVE_TOPICE_ENABLED' => $approve_mod['topice_enabled'],
					'S_APPROVE_USERS_ENABLED' => $approve_mod['users_enabled'],
					'S_APPROVE_USERS_DISABLED' => $approve_mod['users_disabled'],
					'S_APPROVE_NOTIFY_ENABLED' => $approve_mod['notify_enabled'],
					'S_APPROVE_NOTIFY_USER_ENABLED' => $approve_mod['notify_user_enabled'],
					'S_APPROVE_NOTIFY_USER_DISABLED' => $approve_mod['notify_user_disabled'],
					'S_APPROVE_NOTIFY_PM_ENABLED' => $approve_mod['notify_pm_enabled'],
					'S_APPROVE_NOTIFY_EMAIL_ENABLED' => $approve_mod['notify_email_enabled'],
					'S_APPROVE_NOTIFY_MESSAGE_ENABLED' => $approve_mod['notify_message_enabled'],
					'S_APPROVE_NOTIFY_MESSAGE_LEN' => $approve_mod['notify_message_len'],
					'S_APPROVE_NOTIFY_DISABLED' => $approve_mod['notify_disabled'],
					'S_APPROVE_NOTIFY_USER_OPTIONS' => $approve_mod['notify_user_options'],
					'S_APPROVE_NOTIFY_USER_LIST' => $approve_mod['notify_user_list'],
					'S_APPROVE_NOTIFY_POSTS_ENABLED' => $approve_mod['notify_posts_enabled'],
					'S_APPROVE_NOTIFY_POSTE_ENABLED' => $approve_mod['notify_poste_enabled'],
					'S_APPROVE_NOTIFY_TOPICS_ENABLED' => $approve_mod['notify_topics_enabled'],
					'S_APPROVE_NOTIFY_TOPICE_ENABLED' => $approve_mod['notify_topice_enabled'],
					'S_APPROVE_HIDE_TOPICS_ENABLED' => $approve_mod['hide_topics_enabled'],
					'S_APPROVE_HIDE_POSTS_ENABLED' => $approve_mod['hide_posts_enabled'],
					'S_APPROVE_HIDE_TOPICS_DISABLED' => $approve_mod['hide_topics_disabled'],
					'S_APPROVE_HIDE_POSTS_DISABLED' => $approve_mod['hide_posts_disabled'] )
				);
			}
// 
// End Approve_Mod Block : 15
//

			$template->assign_vars(array(
				'S_FORUM_ACTION' => append_sid("admin_forums.$phpEx"),
				'S_HIDDEN_FIELDS' => $s_hidden_fields,
				'S_SUBMIT_VALUE' => $buttonvalue, 

				'L_FORUM_TITLE' => $l_title, 
				'L_FORUM_NAME' => $lang['Forum_name'], 
				'FORUM_NAME' => $forumname,
				)
			);
			$template->pparse("body");
			break;

		case 'modforum':
// 
// Begin Approve_Mod Block : 16
// 
			$approve_notify_user_list = '';
			$approve_enable = (intval($HTTP_POST_VARS['approve_enable']) == 1) ? 1 : 0;

			if ( trim($HTTP_POST_VARS['usernames_list']) != '' ) 
			{ 
				$approve_mod['moderators'] = array();
				$approve_mod['moderators'] = explode('  |  ', trim($HTTP_POST_VARS['usernames_list']));

				for($i = 0; !empty($approve_mod['moderators'][$i]); $i++)
				{
					$sql = "SELECT user_id, user_level
						FROM " . USERS_TABLE . "
						WHERE username = '" . $approve_mod['moderators'][$i] . "'";
					if ( !$result = $db->sql_query($sql) )
					{
						message_die(GENERAL_ERROR, $lang['approve_posts_error_obtain'],"",__LINE__, __FILE__, $sql);
					}
					if ( $row_user = $db->sql_fetchrow($result) )
					{
						if ( intval($row_user['user_id']) != intval(ANONYMOUS) && intval($row_user['user_level']) != intval(DELETED) )
						{
							if ( $approve_notify_user_list == '' ) 
							{
								$approve_notify_user_list = $row_user['user_id'];
							}
							else
							{
								$approve_notify_user_list = $approve_notify_user_list . '|' . $row_user['user_id'];
							}
						}
						else
						{
							message_die(GENERAL_ERROR, $lang['approve_admin_notify_user_invalid'] . $approve_mod['moderators'][$i]);
						}
					}
					else
					{
						message_die(GENERAL_ERROR, $lang['approve_admin_notify_user_invalid'] . $approve_mod['moderators'][$i]);
					}
				}
			}
			else
			{
				if ( $HTTP_POST_VARS['approve_notify_enable'] )
				{
					message_die(GENERAL_ERROR, $lang['approve_admin_notify_user_empty']);
				}
			}
			$sql = "DELETE FROM " . APPROVE_FORUMS_TABLE . " 
				WHERE forum_id = " . intval($HTTP_POST_VARS[POST_FORUM_URL]);
			if ( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, $lang['approve_posts_error_delete'], '', __LINE__, __FILE__, $sql);
			}
			$sql = "INSERT INTO " . APPROVE_FORUMS_TABLE . " (forum_id, enabled, approve_posts, approve_topics, approve_users, approve_poste, approve_topice, approve_notify, approve_notify_type, approve_notify_message, approve_notify_message_len, approve_moderators, approve_notify_posts, approve_notify_poste, approve_notify_topics, approve_notify_topice, approve_notify_approval, forum_hide_unapproved_topics, forum_hide_unapproved_posts) 
				VALUES (" . intval($HTTP_POST_VARS[POST_FORUM_URL]) . ", " . intval($approve_enable) . ", " . intval($HTTP_POST_VARS['approve_posts_enable']) . ", " . intval($HTTP_POST_VARS['approve_topics_enable']) . ", " . intval($HTTP_POST_VARS['approve_users_enable']) . ", " . intval($HTTP_POST_VARS['approve_poste_enable']) . ", " . intval($HTTP_POST_VARS['approve_topice_enable']) . ", " . intval($HTTP_POST_VARS['approve_notify_enable']) . ", " . intval($HTTP_POST_VARS['approve_notify_type_enable']) . ", " . intval($HTTP_POST_VARS['approve_notify_message_enable']) . ", " . intval($HTTP_POST_VARS['approve_notify_message_len']) . ", '" . $approve_notify_user_list . "', " . intval($HTTP_POST_VARS['approve_notify_posts_enable']) . ", " . intval($HTTP_POST_VARS['approve_notify_poste_enable']) . ", " . intval($HTTP_POST_VARS['approve_notify_topics_enable']) . ", " . intval($HTTP_POST_VARS['approve_notify_topice_enable']) . ", " . intval($HTTP_POST_VARS['approve_notify_user_enable']) . ", " . intval($HTTP_POST_VARS['approve_hide_topics_enable']) . ", " . intval($HTTP_POST_VARS['approve_hide_posts_enable']) . ")";
			if ( !$result = $db->sql_query($sql) ) 
			{ 
				message_die(GENERAL_ERROR, $lang['approve_posts_error_insert'], '', __LINE__, __FILE__, $sql); 
			} 
// 
// End Approve_Mod Block : 16
//
			$message = $lang['Forums_updated'] . "<br /><br />" . sprintf($lang['Click_return_forumadmin'], "<a href=\"" . append_sid("admin_forums.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

			message_die(GENERAL_MESSAGE, $message);

			break;
			
		default:
			message_die(GENERAL_MESSAGE, $lang['No_mode']);
			break;
	}

	if ($show_index != TRUE)
	{
		include('./page_footer_admin.'.$phpEx);
		exit;
	}
}

//
// Start page proper
//
$template->set_filenames(array(
	"body" => "admin/forum_admin_body.tpl")
);

$template->assign_vars(array(
	'S_FORUM_ACTION' => append_sid("admin_forums.$phpEx"),
	'L_FORUM_TITLE' => $lang['Forum_admin'], 
	'L_EDIT' => $lang['Edit'], 
	)
);

$keys = array(); 
$keys = get_auth_keys('Root', $all); 
$last_level = -1; 

$template->assign_block_vars("catrow", array( 
    'CAT_ID' => 0, 
    'CAT_DESC' => 'Root', 
    'U_VIEWCAT' => append_sid($phpbb_root_path."index.$phpEx?" . POST_CAT_URL . "=0")) 
); 
for ($i=0; $i < count($keys['id']); $i++) { 
    // only get object that are not forum links type 
    if ( ($tree['type'][ $keys['idx'][$i] ] != POST_FORUM_URL) || empty($tree['data'][ $keys['idx'][$i] ]['forum_link']) ) { 
        if($tree['type'][ $keys['idx'][$i] ] == POST_FORUM_URL){ 
            $spacer = "&nbsp;&nbsp;"; 
        } else if($tree['type'][ $keys['idx'][$i] ] == POST_CAT_URL){ 
            $spacer = "&nbsp;"; 
        } 
         $level = $keys['real_level'][$i]; 
         $inc = ''; 
         for ($k = 0; $k < $level; $k++) { 
            if($tree['type'][ $keys['idx'][$i] ] == POST_FORUM_URL){ 
                $inc .= "[*$k*]".$spacer.$spacer; 
            } else{ 
                $inc .= "[*$k*]".$spacer.$spacer.$spacer; 
            } 
        } 
        if ($level < $last_level) { 
             //insert spacer if level goes down 
            $res .= $inc . '|'.$spacer.$spacer.$spacer; 
             // make valid lines solid 
            $res = str_replace("[*$level*]", "|", $res); 
            // erase all unnessecary lines 
            for ($k = $level + 1; $k < $last_level; $k++) { 
                 $res = str_replace("[*$k*]", $spacer, $res); 
            } 
        } elseif ($level == 0 && $last_level == -1) { 
            $res .='|'; 
        } 
        $last_level = $level; 
        // name 
         $name = get_object_lang($keys['id'][$i], 'name', $all); 
        if ($keys['level'][$i] >=0) $res .= $inc . '|-- '; 
        $res .= $name ; 
        for ($k = 0; $k < $last_level; $k++) { 
            $res = str_replace("[*$k*]", $spacer, $res); 
        } 
        // send to template 
        if($tree['type'][ $keys['idx'][$i] ] == POST_FORUM_URL){ 
            // strip f from f10 
            $keyid = str_replace(POST_FORUM_URL,'',$keys['id'][$i]); 
            $template->assign_block_vars("catrow.forumrow",    array( 
                    'FORUM_NAME' => $res, 
                    'FORUM_DESC' => '', 
                    'ROW_COLOR' => $row_color, 
                    'U_VIEWFORUM' => append_sid($phpbb_root_path."viewforum.$phpEx?" . POST_FORUM_URL . "=$keyid"), 
                    'U_FORUM_EDIT' => append_sid("admin_forums.$phpEx?mode=editforum&amp;" . POST_FORUM_URL . "=$keyid"), 
                    ) 
            ); 
        } else if($tree['type'][ $keys['idx'][$i] ] == POST_CAT_URL){ 
            // strip c from c10 
            $keyid = str_replace(POST_CAT_URL,'',$keys['id'][$i]); 
            $template->assign_block_vars("catrow", array( 
                    'CAT_ID' => $keyid, 
                    'CAT_DESC' => $res, 
                    'U_VIEWCAT' => append_sid($phpbb_root_path."index.$phpEx?" . POST_CAT_URL . "=$keyid")) 
            ); 
        } 
    } 
    $res=''; 
}

$template->pparse("body");

include('./page_footer_admin.'.$phpEx);

?>
