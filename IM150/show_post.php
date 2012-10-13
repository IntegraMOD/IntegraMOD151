<?php
/***************************************************************************
 *                               show_post.php
 *                            -------------------
 *   begin                : Saturday, Nov 23, 2002
 *   copyright            : (C) 2002 Meik Sievertsen
 *   email                : acyd.burn@gmx.de
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

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);
include($phpbb_root_path . 'includes/bbcode.'.$phpEx);

//
// Start session management
//
$userdata = session_pagestart($user_ip, $forum_id);
init_userprefs($userdata);
//
// End session management
//

include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_show_post.' . $phpEx);

//
// Start initial var setup
//
if ( isset($HTTP_GET_VARS['p']))
{
	$post_id = intval($HTTP_GET_VARS['p']);
}

if ( !isset($post_id) )
{
	message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');
}

//
// Find topic id if user requested a newer
// or older topic
//
if ( isset($HTTP_GET_VARS['view']) )
{
	if ( $HTTP_GET_VARS['view'] == 'next' || $HTTP_GET_VARS['view'] == 'previous' )
	{
		$sql_condition = ( $HTTP_GET_VARS['view'] == 'next' ) ? '>' : '<';
		$sql_ordering = ( $HTTP_GET_VARS['view'] == 'next' ) ? 'ASC' : 'DESC';

		$sql = "SELECT topic_id, post_time FROM " . POSTS_TABLE . " WHERE post_id = " . $post_id . " LIMIT 1";

		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, "Could not obtain newer/older post information", '', __LINE__, __FILE__, $sql);
		}

		$row = $db->sql_fetchrow($result);

		$topic_id = $row['topic_id'];
		$post_time = $row['post_time'];

		$sql = "SELECT post_id FROM " . POSTS_TABLE . "
			WHERE topic_id = $topic_id
			AND post_time $sql_condition " . $post_time . "
			ORDER BY post_time $sql_ordering
			LIMIT 1";
		
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, "Could not obtain newer/older post information", '', __LINE__, __FILE__, $sql);
		}
		
		if ($row = $db->sql_fetchrow($result))
		{
			$post_id = $row['post_id'];
		}
		else
		{
			$message = ( $HTTP_GET_VARS['view'] == 'next' ) ? 'No_newer_posts' : 'No_older_posts';
			message_die(GENERAL_MESSAGE, $message);
		}
	}
}

if ( !isset($post_id) )
{
	message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');
}

//
// Get topic info ...
//
$sql = "SELECT t.topic_title, f.forum_id, f.auth_view, f.auth_read, f.auth_post, f.auth_reply, f.auth_edit, f.auth_delete, f.auth_sticky, f.auth_announce, f.auth_pollcreate, f.auth_vote, f.auth_attachments 
	FROM " . TOPICS_TABLE . " t, " . FORUMS_TABLE . " f, " . POSTS_TABLE . " p
	WHERE p.post_id = $post_id
		AND t.topic_id = p.topic_id
		AND f.forum_id = t.forum_id";
		
$tmp = '';
//attach_setup_viewtopic_auth($tmp, $sql);

if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not obtain topic information', '', __LINE__, __FILE__, $sql);
}

if ( !($forum_row = $db->sql_fetchrow($result)) )
{
	message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');
}

$forum_id = $forum_row['forum_id'];
$topic_title = $forum_row['topic_title'];
		
$is_auth = array();
$is_auth = auth(AUTH_ALL, $forum_id, $userdata, $forum_row);

if ( !$is_auth['auth_read'] )
{
	message_die(GENERAL_MESSAGE, sprintf($lang['Sorry_auth_read'], $is_auth['auth_read_type']));
}

//
// Define censored word matches
//
if ( empty($orig_word) && empty($replacement_word) )
{
	$orig_word = array();
	$replacement_word = array();

	obtain_word_list($orig_word, $replacement_word);
}

//
// Dump out the page header and load viewtopic body template
//
$gen_simple_header = TRUE;

$page_title = $lang['Post_review'] . ' - ' . $topic_title;
include($phpbb_root_path . 'includes/page_header.'.$phpEx);

$template->set_filenames(array(
	'reviewbody' => 'post_review.tpl')
);

$view_prev_post_url = append_sid("show_post.$phpEx?p=$post_id&amp;view=previous");
$view_next_post_url = append_sid("show_post.$phpEx?p=$post_id&amp;view=next");

$template->assign_vars(array(
	'L_AUTHOR' => $lang['Author'],
	'L_MESSAGE' => $lang['Message'],
	'L_POSTED' => $lang['Posted'], 
	'L_POST_SUBJECT' => $lang['Post_subject'],
	'L_VIEW_NEXT_POST' => $lang['View_next_post'],
	'L_VIEW_PREVIOUS_POST' => $lang['View_previous_post'],

	'U_VIEW_OLDER_POST' => $view_prev_post_url,
	'U_VIEW_NEWER_POST' => $view_next_post_url)
);

$sql = "SELECT *
	FROM " . RANKS_TABLE . "
	ORDER BY rank_special, rank_min";
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, "Could not obtain ranks information.", '', __LINE__, __FILE__, $sql);
}

$ranksrow = array();
while ( $row = $db->sql_fetchrow($result) )
{
	$ranksrow[] = $row;
}
$db->sql_freeresult($result);
	
//
// Go ahead and pull all data for this topic
//
$sql = "SELECT u.*, p.*,  pt.post_text, pt.post_subject, pt.bbcode_uid
	FROM " . POSTS_TABLE . " p, " . USERS_TABLE . " u, " . POSTS_TEXT_TABLE . " pt
	WHERE p.post_id = $post_id
	AND p.poster_id = u.user_id
	AND p.post_id = pt.post_id
	LIMIT 1";

if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not obtain post/user information', '', __LINE__, __FILE__, $sql);
}

//init_display_review_attachments($is_auth);

//
// Okay, let's do the loop, yeah come on baby let's do the loop
// and it goes like this ...
//
if ( $row = $db->sql_fetchrow($result) )
{
	$mini_post_img = $images['icon_minipost'];
	$mini_post_alt = $lang['Post'];

	$i = 0;
	do
	{
		$poster_id = $row['user_id'];
		$poster = ( $poster_id == ANONYMOUS ) ? $lang['Guest'] : $row['username'];

		$post_date = create_date($board_config['default_dateformat'], $row['post_time'], $board_config['board_timezone']);

		$poster_posts = ( $row['user_id'] != ANONYMOUS ) ? $lang['Posts'] . ': ' . $row['user_posts'] : '';

		$poster_from = ( $row['user_from'] && $row['user_id'] != ANONYMOUS ) ? $lang['Location'] . ': ' . $row['user_from'] : '';

		$poster_joined = ( $row['user_id'] != ANONYMOUS ) ? $lang['Joined'] . ': ' . create_date($lang['DATE_FORMAT'], $row['user_regdate'], $board_config['board_timezone']) : '';

		$poster_avatar = '';
		if ( $row['user_avatar_type'] && $poster_id != ANONYMOUS && $row['user_allowavatar'] )
		{
			switch( $row['user_avatar_type'] )
			{
				case USER_AVATAR_UPLOAD:
					$poster_avatar = ( $board_config['allow_avatar_upload'] ) ? '<img src="' . $board_config['avatar_path'] . '/' . $row['user_avatar'] . '" alt="" border="0" />' : '';
					break;
				case USER_AVATAR_REMOTE:
					$poster_avatar = ( $board_config['allow_avatar_remote'] ) ? '<img src="' . $row['user_avatar'] . '" alt="" border="0" />' : '';
					break;
				case USER_AVATAR_GALLERY:
					$poster_avatar = ( $board_config['allow_avatar_local'] ) ? '<img src="' . $board_config['avatar_gallery_path'] . '/' . $row['user_avatar'] . '" alt="" border="0" />' : '';
					break;
			}
		}

		//
		// Generate ranks, set them to empty string initially.
		//
		$poster_rank = '';
		$rank_image = '';
		if ( $row['user_id'] == ANONYMOUS )
		{
		}
		else if ( $row['user_rank'] )
		{
			for($j = 0; $j < count($ranksrow); $j++)
			{
				if ( $row['user_rank'] == $ranksrow[$j]['rank_id'] && $ranksrow[$j]['rank_special'] )
				{
					$all_ranks = array();
					init_ranks($all_ranks);
					$rank_temp = get_user_rank($row);
					$poster_rank = $rank_temp['rank_title'];
					$rank_image = ( $ranksrow[$j]['rank_image'] ) ? '<img src="' . $ranksrow[$j]['rank_image'] . '" alt="' . $poster_rank . '" title="' . $poster_rank . '" border="0" /><br />' : '';
				}
			}
		}
		else
		{
			for($j = 0; $j < count($ranksrow); $j++)
			{
				if ( $row['user_posts'] >= $ranksrow[$j]['rank_min'] && !$ranksrow[$j]['rank_special'] )
				{
					$all_ranks = array();
					init_ranks($all_ranks);
					$rank_temp = get_user_rank($row);
					$poster_rank = $rank_temp['rank_title'];
					$rank_image = ( $ranksrow[$j]['rank_image'] ) ? '<img src="' . $ranksrow[$j]['rank_image'] . '" alt="' . $poster_rank . '" title="' . $poster_rank . '" border="0" /><br />' : '';
				}
			}
		}

		//
		// Handle anon users posting with usernames
		//
		if ( $poster_id == ANONYMOUS && $row['post_username'] != '' )
		{
			$poster = $row['post_username'];
			$poster_rank = $lang['Guest'];
		}

		$temp_url = '';

		if ( $poster_id != ANONYMOUS )
		{
			$temp_url = append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$poster_id");
			$profile_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_profile'] . '" alt="' . $lang['Read_profile'] . '" title="' . $lang['Read_profile'] . '" border="0" /></a>';
			$profile = '<a href="' . $temp_url . '">' . $lang['Read_profile'] . '</a>';

			$temp_url = append_sid("privmsg.$phpEx?mode=post&amp;" . POST_USERS_URL . "=$poster_id");
			$pm_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_pm'] . '" alt="' . $lang['Send_private_message'] . '" title="' . $lang['Send_private_message'] . '" border="0" /></a>';
			$pm = '<a href="' . $temp_url . '">' . $lang['Send_private_message'] . '</a>';

			if ( !empty($row['user_viewemail']) || $is_auth['auth_mod'] )
			{
				$email_uri = ( $board_config['board_email_form'] ) ? append_sid("profile.$phpEx?mode=email&amp;" . POST_USERS_URL .'=' . $poster_id) : 'mailto:' . $row['user_email'];

				$email_img = '<a href="' . $email_uri . '"><img src="' . $images['icon_email'] . '" alt="' . $lang['Send_email'] . '" title="' . $lang['Send_email'] . '" border="0" /></a>';
				$email = '<a href="' . $email_uri . '">' . $lang['Send_email'] . '</a>';
			}
			else
			{
				$email_img = '';
				$email = '';
			}

			$www_img = ( $row['user_website'] ) ? '<a href="' . $row['user_website'] . '" target="_userwww"><img src="' . $images['icon_www'] . '" alt="' . $lang['Visit_website'] . '" title="' . $lang['Visit_website'] . '" border="0" /></a>' : '';
			$www = ( $row['user_website'] ) ? '<a href="' . $row['user_website'] . '" target="_userwww">' . $lang['Visit_website'] . '</a>' : '';

			if ( !empty($row['user_icq']) )
			{
				$icq_status_img = '<a href="http://wwp.icq.com/' . $row['user_icq'] . '#pager"><img src="http://web.icq.com/whitepages/online?icq=' . $postrow[$i]['user_icq'] . '&img=5" width="18" height="18" border="0" /></a>';
				$icq_img = '<a href="http://wwp.icq.com/scripts/search.dll?to=' . $row['user_icq'] . '"><img src="' . $images['icon_icq'] . '" alt="' . $lang['ICQ'] . '" title="' . $lang['ICQ'] . '" border="0" /></a>';
				$icq =  '<a href="http://wwp.icq.com/scripts/search.dll?to=' . $row['user_icq'] . '">' . $lang['ICQ'] . '</a>';
			}
			else
			{
				$icq_status_img = '';
				$icq_img = '';
				$icq = '';
			}

			$aim_img = ( $row['user_aim'] ) ? '<a href="aim:goim?screenname=' . $row['user_aim'] . '&amp;message=Hello+Are+you+there?"><img src="' . $images['icon_aim'] . '" alt="' . $lang['AIM'] . '" title="' . $lang['AIM'] . '" border="0" /></a>' : '';
			$aim = ( $row['user_aim'] ) ? '<a href="aim:goim?screenname=' . $row['user_aim'] . '&amp;message=Hello+Are+you+there?">' . $lang['AIM'] . '</a>' : '';

			$temp_url = append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$poster_id");
			$msn_img = ( $row['user_msnm'] ) ? '<a href="' . $temp_url . '"><img src="' . $images['icon_msnm'] . '" alt="' . $lang['MSNM'] . '" title="' . $lang['MSNM'] . '" border="0" /></a>' : '';
			$msn = ( $row['user_msnm'] ) ? '<a href="' . $temp_url . '">' . $lang['MSNM'] . '</a>' : '';

			$yim_img = ( $row['user_yim'] ) ? '<a href="http://edit.yahoo.com/config/send_webmesg?.target=' . $row['user_yim'] . '&amp;.src=pg"><img src="' . $images['icon_yim'] . '" alt="' . $lang['YIM'] . '" title="' . $lang['YIM'] . '" border="0" /></a>' : '';
			$yim = ( $row['user_yim'] ) ? '<a href="http://edit.yahoo.com/config/send_webmesg?.target=' . $row['user_yim'] . '&amp;.src=pg">' . $lang['YIM'] . '</a>' : '';
		}
		else
		{
			$profile_img = '';
			$profile = '';
			$pm_img = '';
			$pm = '';
			$email_img = '';
			$email = '';
			$www_img = '';
			$www = '';
			$icq_status_img = '';
			$icq_img = '';
			$icq = '';
			$aim_img = '';
			$aim = '';
			$msn_img = '';
			$msn = '';
			$yim_img = '';
			$yim = '';
		}

		$temp_url = append_sid("posting.$phpEx?mode=quote&amp;" . POST_POST_URL . "=" . $row['post_id']);
		$quote_img = '<a href="' . $temp_url . '" target="_parent"><img src="' . $images['icon_quote'] . '" alt="' . $lang['Reply_with_quote'] . '" title="' . $lang['Reply_with_quote'] . '" border="0" /></a>';
		$quote = '<a href="' . $temp_url . '" target="_parent">' . $lang['Reply_with_quote'] . '</a>';

		$post_subject = ( $row['post_subject'] != '' ) ? $row['post_subject'] : '';

		$message = $row['post_text'];
		$bbcode_uid = $row['bbcode_uid'];

		$user_sig = ( $row['enable_sig'] && $row['user_sig'] != '' && $board_config['allow_sig'] ) ? $row['user_sig'] : '';
		$user_sig_bbcode_uid = $row['user_sig_bbcode_uid'];

		//
		// Note! The order used for parsing the message _is_ important, moving things around could break any 
		// output
		//

		//
		// If the board has HTML off but the post has HTML
		// on then we process it, else leave it alone
		//
		if ( !$board_config['allow_html'] )
		{
			if ( $user_sig != '' && $userdata['user_allowhtml'] )
			{
				$user_sig = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $user_sig);
			}

			if ( $row['enable_html'] )
			{
				$message = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $message);
			}
		}

		//
		// Parse message and/or sig for BBCode if reqd
		//
		if ( $board_config['allow_bbcode'] )
		{
			if ( $user_sig != '' && $user_sig_bbcode_uid != '' )
			{
				$user_sig = ( $board_config['allow_bbcode'] ) ? bbencode_second_pass($user_sig, $user_sig_bbcode_uid) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $user_sig);
			}

			if ( $bbcode_uid != '' )
			{
				$message = ( $board_config['allow_bbcode'] ) ? bbencode_second_pass($message, $bbcode_uid) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $message);
			}
		}

		if ( $user_sig != '' )
		{
			$user_sig = make_clickable($user_sig);
		}
		$message = make_clickable($message);

		//
		// Replace naughty words
		//
		if ( count($orig_word) )
		{
			if ( $user_sig != '' )
			{
				$user_sig = preg_replace($orig_word, $replacement_word, $user_sig);
			}

			$post_subject = preg_replace($orig_word, $replacement_word, $post_subject);
			$message = preg_replace($orig_word, $replacement_word, $message);
		}

		//
		// Parse smilies
		//
		if ( $board_config['allow_smilies'] )
		{
			if ( $row['user_allowsmile'] && $user_sig != '' )
			{
				$user_sig = smilies_pass($user_sig);
			}

			if ( $row['enable_smilies'] )
			{
				$message = smilies_pass($message);
			}
		}

		//
		// Replace newlines (we use this rather than nl2br because
		// till recently it wasn't XHTML compliant)
		//
		if ( $user_sig != '' )
		{
			$user_sig = '<br />_________________<br />' . str_replace("\n", "\n<br />\n", $user_sig);
		}

		$message = str_replace("\n", "\n<br />\n", $message);

		//
		// Editing information
		//
		if ( $row['post_edit_count'] )
		{
			$l_edit_time_total = ( $row['post_edit_count'] == 1 ) ? $lang['Edited_time_total'] : $lang['Edited_times_total'];
			
			$l_edited_by = '<br /><br />' . sprintf($l_edit_time_total, $poster, create_date($board_config['default_dateformat'], $row['post_edit_time'], $board_config['board_timezone']), $row['post_edit_count']);
		}
		else
		{
			$l_edited_by = '';
		}

		//
		// Again this will be handled by the templating
		// code at some point
		//
		$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
		$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

//$message = unprepare_message($message); // beta Michaelo		
		
		$template->assign_block_vars('postrow', array(
			'ROW_COLOR' => '#' . $row_color,
			'ROW_CLASS' => $row_class,
			'POSTER_NAME' => $poster,
			'POSTER_RANK' => $poster_rank,
			'RANK_IMAGE' => $rank_image,
			'POSTER_JOINED' => $poster_joined,
			'POSTER_POSTS' => $poster_posts,
			'POSTER_FROM' => $poster_from,
			'POSTER_AVATAR' => $poster_avatar,
			'POST_DATE' => $post_date,
			'POST_SUBJECT' => $post_subject,
			'MESSAGE' => $message, 
			'SIGNATURE' => $user_sig, 
			'EDITED_MESSAGE' => $l_edited_by, 

			'MINI_POST_IMG' => $mini_post_img, 
			'PROFILE_IMG' => $profile_img, 
			'PROFILE' => $profile, 
			'PM_IMG' => $pm_img,
			'PM' => $pm,
			'EMAIL_IMG' => $email_img,
			'EMAIL' => $email,
			'WWW_IMG' => $www_img,
			'WWW' => $www,
			'ICQ_STATUS_IMG' => $icq_status_img,
			'ICQ_IMG' => $icq_img, 
			'ICQ' => $icq, 
			'AIM_IMG' => $aim_img,
			'AIM' => $aim,
			'MSN_IMG' => $msn_img,
			'MSN' => $msn,
			'YIM_IMG' => $yim_img,
			'YIM' => $yim,
			'QUOTE_IMG' => $quote_img,
			'QUOTE' => $quote,

			'L_MINI_POST_ALT' => $mini_post_alt, 

			'U_POST_ID' => $row['post_id'])
		);
//		display_review_attachments($row['post_id'], $row['post_attachment'], $is_auth);

		$i++;
	}
	while ( $row = $db->sql_fetchrow($result) );
}
else
{
	message_die(GENERAL_MESSAGE, 'Topic_post_not_exist', '', __LINE__, __FILE__, $sql);
}

$template->pparse('reviewbody');
include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>