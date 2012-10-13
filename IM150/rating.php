<?php
/***************************************************************************
 *                              rating.php v1.0.1
 *                            -------------------
 *   begin                : Friday, Mar 21, 2003
 *   copyright            : (C) 2002 Web Centre Ltd
 *   email                : phpbb@mywebcommunities.com
 *
 *   MODIFICATION HISTORY
 *   v1.0.1 21st March 2003
 *   - Use standard phpBB call for language file
 *   - Added HTTP_POST_VARS for when REGISTER_GLOBALS is off
 ***************************************************************************/


define('IN_PHPBB', true);

$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);
include($phpbb_root_path . 'includes/bbcode.'.$phpEx);

define('RATING_PATH', $phpbb_root_path.'mods/rating/');

// Start session management
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);
// End session management

$use_lang = ( !file_exists($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_rating.'.$phpEx) ) ? 'english' : $board_config['default_lang']; 
include($phpbb_root_path . 'language/lang_' . $use_lang . '/lang_rating.' . $phpEx); 
include (RATING_PATH.'functions_rating.'.$phpEx);
include (RATING_PATH.'functions_rating_2.'.$phpEx);

$p = ( isset($HTTP_POST_VARS['p']) ) ? intval($HTTP_POST_VARS['p']) : intval($HTTP_GET_VARS['p']);
if ( empty($p) ) die('No post id specified'); // NOTE: THIS SHOULD NEVER HAPPEN
$i = intval($HTTP_GET_VARS['i']);
$b = intval($HTTP_GET_VARS['b']);
$n = intval($HTTP_GET_VARS['n']);
$o = intval($HTTP_GET_VARS['o']);
$this_url = append_sid($PHP_SELF.'?p='.$p);

$config_set = get_rating_config();

if ( isset($HTTP_POST_VARS['rating_form_submitted']) )
{
	$anonymous_old = $HTTP_POST_VARS['anonymous_old'];
	$anonymous_new = $HTTP_POST_VARS['anonymous_new'];
	// UPDATE 'ANONYMOUS' SETTING IF IT HAS BEEN CHANGED
	if ( (empty($anonymous_old) && !empty($anonymous_new)) || (!empty($anonymous_old) && empty($anonymous_new)) )
	{
		$anonymous_rating = ( empty($anonymous_new) ) ? 0 : 1;
		$sql = 'UPDATE '.USERS_TABLE.' SET rating_status = '.$anonymous_rating.' WHERE user_id = '.$userdata['user_id'];
		if( !($result = $db->sql_query($sql)) )
		{
			message_die(CRITICAL_ERROR, "Could not update user information", "", __LINE__, __FILE__, $sql);
		}
		if ( isset($userdata['rating_status']) )
		{
			$userdata['rating_status'] = $anonymous_rating;
		}
	}

	$new_rating = intval($HTTP_POST_VARS['rating']);
	// CHECK IF NEW / CHANGED RATING
	$sql = 'SELECT option_id FROM '.RATING_TABLE.' WHERE user_id = '.$userdata['user_id'].' AND post_id = '.$p;
	if( !($result = $db->sql_query($sql)) )
	{
		message_die(CRITICAL_ERROR, "Could not query rating information", "", __LINE__, __FILE__, $sql);
	}

	$row = $db->sql_fetchrow($result);
	$current_rating = intval($row['option_id']);

	if ( $current_rating != $new_rating )
	{
		// UPDATE RATING
		if ( $new_rating == 0 )
		{
			$sql = 'DELETE FROM '.RATING_TABLE.' WHERE user_id = '.$userdata['user_id'].' AND post_id = '.$p;
		}
		elseif ( $current_rating > 0 ) 
		{
			$sql = 'UPDATE '.RATING_TABLE.' SET option_id = '.$new_rating.', rating_time = UNIX_TIMESTAMP(NOW()) WHERE user_id = '.$userdata['user_id'].' AND post_id = '.$p;
		}
		else
		{
			$sql = 'INSERT INTO '.RATING_TABLE.' (user_id, post_id, option_id, rating_time) VALUES ('.$userdata['user_id'].', '.$p.', '.$new_rating.', UNIX_TIMESTAMP(NOW()))';
		}
		if( !($result = $db->sql_query($sql)) )
		{
			message_die(CRITICAL_ERROR, "Could not update rating information", "", __LINE__, __FILE__, $sql);
		}

		// GET CURRENT RATINGS
		$sql = 'SELECT p.rating_rank_id AS post_rating, p.poster_id, t.topic_id, t.rating_rank_id AS topic_rating, u.user_rank AS user_rating FROM '.POSTS_TABLE.' p, '.TOPICS_TABLE.' t, '.USERS_TABLE.' u WHERE p.post_id = '.$p.' AND p.topic_id = t.topic_id AND p.poster_id = u.user_id';

		if( !($result = $db->sql_query($sql)) )
		{
			message_die(CRITICAL_ERROR, "Could not query current rating information", "", __LINE__, __FILE__, $sql);
		}
		elseif ( !($row = $db->sql_fetchrow($result)) )
		{
			message_die(CRITICAL_ERROR, "Could not query current rating information", "", __LINE__, __FILE__, $sql);
		}
		$postlist = array($p);
		$userlist = array($row['poster_id']);
		$topiclist = array($row['topic_id']);

		update_post_rating($config_set[8], $postlist);
		update_topic_rating($config_set[9], $topiclist);
		update_user_rating($config_set[10], $userlist);

	}
}
elseif ( !empty($i) || !empty($b) )
{
	if ( !empty($i) )
	{
		// IGNORING
		$target_user = $i;
		$new_status = 1;
	}
	else
	{
		// BUDDY
		$target_user = $b;
		$new_status = 2;
	}
	// CHANGE BIAS FOR SPECIFIED USER_ID
	$sql = 'SELECT bias_id FROM '.RATING_BIAS_TABLE.' WHERE user_id = '.$userdata['user_id'].' AND target_user = '.$target_user;
	if( !($result = $db->sql_query($sql)) )
	{
		message_die(CRITICAL_ERROR, "Could not query current bias information", "", __LINE__, __FILE__, $sql);
	}
	if ( !$row = $db->sql_fetchrow($result) )
	{
		// NO BIAS RECORD EXISTS SO CREATE ONE
		$sql = 'INSERT INTO '.RATING_BIAS_TABLE.' (user_id, target_user, bias_status, post_id, option_id, bias_time) VALUES ('.$userdata['user_id'].', '.$target_user.', '.$new_status.', '.$p.', '.$o.', UNIX_TIMESTAMP(NOW()))';
	}
	else
	{
		$sql = 'UPDATE '.RATING_BIAS_TABLE.' SET bias_status = '.$new_status.', post_id = '.$p.', option_id = '.$o.', bias_time = UNIX_TIMESTAMP(NOW()) WHERE bias_id = '.$row['bias_id'];
	}
	if( !($result = $db->sql_query($sql)) )
	{
		message_die(CRITICAL_ERROR, "Could not update bias information", "", __LINE__, __FILE__, $sql);
	}
}
elseif ( !empty($n) )
{
	// MAKE NEUTRAL FOR SPECIFIED USER_ID
	$sql = 'DELETE FROM '.RATING_BIAS_TABLE.' WHERE user_id = '.$userdata['user_id'].' AND target_user = '.$n;
	if( !($result = $db->sql_query($sql)) )
	{
		message_die(CRITICAL_ERROR, "Could not update bias information", "", __LINE__, __FILE__, $sql);
	}
}
	

$rate_post_msg = '';

get_rating_ranks();

// GET OVERALL RATING AND TOPIC / FORUM INFO FOR THIS POST
$sql = 'SELECT p.rating_rank_id AS post_rating, f.forum_id, f.auth_view, f.auth_read, u.user_rank AS user_rating, u.user_id, u.username, u.rating_status, t.rating_rank_id AS topic_rating, t.topic_title, t.topic_first_post_id';
$sql_from = USERS_TABLE.' u, '.POSTS_TABLE.' p, '.TOPICS_TABLE.' t, '.FORUMS_TABLE.' f';
$sql .= ' FROM '.$sql_from.' WHERE p.post_id = '.$p.' AND u.user_id = p.poster_id AND p.topic_id = t.topic_id AND t.forum_id = f.forum_id';
if( !($result = $db->sql_query($sql)) )
{
	message_die(CRITICAL_ERROR, "Could not query post information", "", __LINE__, __FILE__, $sql);
}
$row = $db->sql_fetchrow($result);

// CHECK THIS USER IS ALLOWED TO READ POST
$is_auth = $tree['auth'][POST_FORUM_URL . $row['forum_id']]; 
if ( $is_auth['auth_view'] > 1 || $is_auth['auth_read'] > 1 ) 
{ 
    message_die(GENERAL_MESSAGE, $lang['Die_rate_private']); 
} 
elseif ( !$userdata['session_logged_in'] && ($is_auth['auth_view'] == 1 || $is_auth['auth_read'] == 1) )
{
	// FORUM IS "REGISTERED USERS ONLY", REDIRECT TO LOGIN
	message_die(GENERAL_MESSAGE, $lang['Die_login_to_rate']);
}
elseif ( $config_set[2] == '1' && $p != $row['topic_first_post_id'] )
{
	message_die(GENERAL_MESSAGE, $lang['Die_rate_only_first']);
}
elseif ( $row['rating_status'] > 9 )
{
	message_die(GENERAL_MESSAGE, $lang['User_suspended']);
}

$poster = $row['username'];
$poster_id = $row['user_id'];
$topic_title = $row['topic_title'];
$forum_id = $row['forum_id'];
$post_rating = ( empty($row['post_rating']) ) ? $lang['Unrated'] : $post_rank_set[$row['post_rating']];
$topic_rating = ( empty($row['topic_rating']) ) ? $lang['Unrated'] : $topic_rank_set[$row['topic_rating']];
//$user_rating = ( empty($row['user_rating']) ) ? $lang['Unrated'] : $user_rank_set[$row['user_rating']];

// Load templates
$template->set_filenames(array(
'body' => 'rating.tpl'
)
);

// IF FORUM RESTRICTED TO REGISTERED MEMBERS ONLY, CHECK
if ( $poster_id == $userdata['user_id'] )
{
	$rate_post_msg = $lang['Cannot_rate_own'];
}

// GET ANY EXISTING RATINGS FOR THIS POST
$sql = 'SELECT u.username, u.user_id, u.rating_status AS anon, ro.points, ro.option_id, ro.label, r.rating_time';
$sql_from = RATING_OPTION_TABLE.' ro, '.RATING_TABLE.' r, '.USERS_TABLE.' u';
$sql_where = 'r.post_id = '.$p.' AND r.option_id = ro.option_id AND r.user_id = u.user_id';

// TAKE ACCOUNT OF 'BIAS' SETTINGS
if ( $config_set[11] == 1 && $userdata['session_logged_in'] )
{
	$sql .= ', i.bias_status';
	switch (SQL_LAYER) 
	{ 
		case 'oracle': 
			$sql_from .= ', '.RATING_BIAS_TABLE.' i';
			$sql_where .= ' AND '.intval($userdata['user_id']).' = i.user_id(+) AND u.user_id = i.target_user(+)';
			break; 

		default: 
			$sql_from .= ' LEFT JOIN '.RATING_BIAS_TABLE.' i ON i.user_id = '.intval($userdata['user_id']).' AND u.user_id = i.target_user';
	}
}
$sql .= ' FROM '.$sql_from.' WHERE '.$sql_where.' ORDER BY ro.points DESC, ro.weighting DESC';

if( !($result = $db->sql_query($sql)) )
{
	message_die(CRITICAL_ERROR, "Could not query existing rating information", "", __LINE__, __FILE__, $sql);
}
elseif( $db->sql_numrows($result) == 0 )
{
	$template->assign_block_vars('current', array(
		'ROWCSS' => 'row1',
		'RATING' => $lang['Not_yet_rated']
		)
	);
}
else
{
	while( $row = $db->sql_fetchrow($result) )
	{
		// DETERMINE WHETHER USERNAME OF THOSE WHO HAVE RATED SHOULD BE DISPLAYED
		if ( $config_set[6] == 0 || $row['anon'] == 1 )
		{
			$who = $lang['Rating_anon_user'];
		}
		else
		{
			$who = ( $row['user_id'] != ANONYMOUS ) ? '<a class="nav" href="'.append_sid($phpbb_root_path.'profile.'.$phpEx.'?mode=viewprofile&u='.$row['user_id']).'">'.$row['username'].'</a>' : $lang['Guest'];
		}
		$rating_time = create_date($board_config['default_dateformat'], $row['rating_time'], $board_config['board_timezone']);
		$rating = (!empty($row['label'])) ? $row['label'] : $row['points'];
		$rowcss = ($rowcss == 'row1') ? 'row2' : 'row1';

		// BIAS STATUS
		if ( !$userdata['session_logged_in'] || $config_set[11] == 0 || $config_set[6] == 0 || $row['anon'] == 1 || $row['user_id'] == ANONYMOUS )
		{
			$bias_message = ( !$userdata['session_logged_in'] ) ? $lang['Rating_bias_loggedoff'] : $lang['Rating_bias_off'];
			// BIAS NOT APPLICABLE
			$buddy_icon = '<img src="'.RATING_PATH.'images/buddy_grey.gif" border="0" alt="'.$bias_message.'" />';
			$neutral_icon = '<img src="'.RATING_PATH.'images/neutral_grey.gif" border="0" alt="'.$bias_message.'" />';
			$ignore_icon = '<img src="'.RATING_PATH.'images/ignore_grey.gif" border="0" alt="'.$bias_message.'" />';
		}
		else
		{
			$bias_status = intval($row['bias_status']);
			$bias_user = ( $row['user_id'] == $userdata['user_id'] ) ? $lang['Rating_yourself'] : $row['username'];
			switch ($bias_status)
			{
				case 1:
					// IGNORED
					$buddy_icon = '<a href="'.$this_url.'&amp;b='.$row['user_id'].'&amp;o='.$row['option_id'].'" title="'.sprintf($lang['Rating_make_buddy'],$bias_user).'"><img src="'.RATING_PATH.'images/buddy_grey.gif" border="0" alt="'.sprintf($lang['Rating_make_buddy'],$bias_user).'" /></a>';
					$neutral_icon = '<a href="'.$this_url.'&amp;n='.$row['user_id'].'" title="'.sprintf($lang['Rating_make_neutral'],$bias_user).'"><img src="'.RATING_PATH.'images/neutral_grey.gif" border="0" alt="'.sprintf($lang['Rating_make_neutral'],$bias_user).'" /></a>';
					$ignore_icon = '<img src="'.RATING_PATH.'images/ignore.gif" border="0" alt="'.sprintf($lang['Rating_is_ignored'],$bias_user).'" />';
					break;
				case 2:
					// BUDDY
					$buddy_icon = '<img src="'.RATING_PATH.'images/buddy.gif" border="0" alt="'.sprintf($lang['Rating_is_buddy'],$bias_user).'" />';
					$neutral_icon = '<a href="'.$this_url.'&amp;n='.$row['user_id'].'" title="'.sprintf($lang['Rating_make_neutral'],$bias_user).'"><img src="'.RATING_PATH.'images/neutral_grey.gif" border="0" alt="'.sprintf($lang['Rating_make_neutral'],$bias_user).'" /></a>';
					$ignore_icon = '<a href="'.$this_url.'&amp;i='.$row['user_id'].'&amp;o='.$row['option_id'].'" title="'.sprintf($lang['Rating_make_ignored'],$bias_user).'"><img src="'.RATING_PATH.'images/ignore_grey.gif" border="0" alt="'.sprintf($lang['Rating_make_ignored'],$bias_user).'" />';
					break;
				default:
					// NEUTRAL
					$buddy_icon = '<a href="'.$this_url.'&amp;b='.$row['user_id'].'&amp;o='.$row['option_id'].'" title="'.sprintf($lang['Rating_make_buddy'],$bias_user).'"><img src="'.RATING_PATH.'images/buddy_grey.gif" border="0" alt="'.sprintf($lang['Rating_make_buddy'],$bias_user).'" /></a>';
					$neutral_icon = '<img src="'.RATING_PATH.'images/neutral.gif" border="0" alt="'.sprintf($lang['Rating_is_neutral'],$bias_user).'" />';
					$ignore_icon = '<a href="'.$this_url.'&amp;i='.$row['user_id'].'&amp;o='.$row['option_id'].'" title="'.sprintf($lang['Rating_make_ignored'],$bias_user).'"><img src="'.RATING_PATH.'images/ignore_grey.gif" border="0" alt="'.sprintf($lang['Rating_make_ignored'],$bias_user).'" />';
			}
		}
		$bias = $buddy_icon.$neutral_icon.$ignore_icon;
		/* Hide Buttons :: Removed
		$template->assign_block_vars('current', array(
			'ROWCSS' => $rowcss,
			'WHO' => $who,
			'BIAS' => $bias,
			'RATING_TIME' => $rating_time,
			'RATING' => $rating,
			)
		);*/
		// Hide Buttons :: Added :: Start
if($config_set[11]){ 
            $template->assign_block_vars('bias_applicable', array( 
            'ROWCSS' => $rowcss, 
            'WHO' => $who, 
            'BIAS' => $bias, 
            'RATING_TIME' => $rating_time, 
            'RATING' => $rating, 
            )); 
        } else { 
            $template->assign_block_vars('bias_not_applicable', array( 
            'ROWCSS' => $rowcss, 
            'WHO' => $who, 
            'BIAS' => $bias, 
            'RATING_TIME' => $rating_time, 
            'RATING' => $rating, 
            )); 
        }
		// Hide Buttons :: Added :: End

		// IF RATING IS BY THIS USER, MAKE OPTION 'SELECTED' IN VOTING DROPDOWN
		if ($row['user_id'] == $userdata['user_id'])
		{
			$previous_rating = $row['option_id'];
		}
	}
	$db->sql_freeresult($result);
}

// CHECK IF AUTHORISED TO RATE THIS POST
if( !$userdata['session_logged_in'] )
{
	// "LOGIN / REGISTER TO RATE THIS POST" OPTION
	$rate_post_msg = $lang['Must_be_logged_to_rate'];
}
elseif ( empty($rate_post_msg) )
{
	// CHECK IF AUTHORISED TO USE ANY RATING OPTIONS

	// MUST HAVE BEEN REGISTERED FOR x DAYS?
	$min_days_reg = $config_set[16];
	if ( empty($rate_post_msg) && $min_days_reg > 0 )
	{
		if ( time() - $userdata['user_regdate'] < ($min_days_reg * 86400) )
		{
			$min_days_phrase = ( $min_days_reg == 1 ) ? $lang['1_Day'] : $min_days_reg.' '.$lang['Days'];
			$rate_post_msg = sprintf($lang['Days_registered_before_rating'], $min_days_phrase);
		}
	}

	// MUST HAVE MADE x POSTS?
	$min_post_count = $config_set[15];
	if ( empty($rate_post_msg) && $min_post_count > 0 )
	{
		if ( $userdata['user_posts'] < $min_post_count )
		{
			$min_post_phrase = $min_post_count.' ';
			$min_post_phrase .= ( $min_post_count == 1 ) ? $lang['Post'] : $lang['Posts'];
			$rate_post_msg = sprintf($lang['Posts_before_rating'], $min_post_phrase);
		}
	}

	// (RATINGS OF THIS USER ALREADY MADE TODAY, IF LIMITED)
	$daily_user_max = $config_set[13];
	if ( empty($rate_post_msg) && $daily_user_max > 0 )
	{
		$sql2 = 'SELECT count(*) AS last24hours FROM '.RATING_TABLE.' r, '.POSTS_TABLE.' p WHERE r.user_id = '.$userdata['user_id'].' AND r.post_id != '.$p.' AND r.post_id = p.post_id AND p.poster_id = '.$poster_id.' AND r.rating_time > '.(time()-86400);
		if( !($result2 = $db->sql_query($sql2)) )
		{
			message_die(CRITICAL_ERROR, "Could not query rating configuration information", "", __LINE__, __FILE__, $sql2);
		}
		else
		{
			$row2 = $db->sql_fetchrow($result2);
			if ( $row2['last24hours'] >= $daily_user_max )
			{
				$max_phrase = $daily_user_max.' ';
				$max_phrase .= ( $daily_user_max == 1 ) ? $lang['Post'] : $lang['Posts'];
				$rate_post_msg = sprintf($lang['User_rating_limit'], $max_phrase);
			}
		}
	}

	// (+ TOTAL RATINGS ALREADY MADE TODAY, IF LIMITED)
	$daily_max = $config_set[5];
	if ( empty($rate_post_msg) && $daily_max > 0 )
	{
		$sql2 = 'SELECT count(*) AS last24hours FROM '.RATING_TABLE.' WHERE user_id = '.$userdata['user_id'].' AND rating_time > '.(time()-86400);
		if( !($result2 = $db->sql_query($sql2)) )
		{
			message_die(CRITICAL_ERROR, "Could not query rating configuration information", "", __LINE__, __FILE__, $sql);
		}
		else
		{
			$row2 = $db->sql_fetchrow($result2);
			if ( $row2['last24hours'] >= $daily_max )
			{
				$max_phrase = $daily_max.' ';
				$max_phrase .= ( $daily_max == 1 ) ? $lang['Post'] : $lang['Posts'];
				$rate_post_msg = sprintf($lang['Daily_rating_limit'], $max_phrase);
			}
		}
	}

	// IF ALREADY RATED BY THIS USER AND CHANGES NOT ALLOWED
	if ( empty($rate_post_msg) && !empty($previous_rating) && $config_set[4] == 0 )
	{
		$rate_post_msg = $lang['Already_rated'];
	}

	// IF USER ALLOWED TO RATE
	if ( empty($rate_post_msg) )
	{			
		// BUILD QUERY TO GET LIST OF POSSIBLE RATING OPTIONS
		$sql = 'SELECT option_id, points, label FROM '.RATING_OPTION_TABLE;
		$sql_where = '';
		if( $userdata['user_level'] != ADMIN )
		{
			// NOT ADMIN, SO CHECK WHICH OPTIONS THIS USER CAN CHOOSE FROM
			$valid_user_types = '1';

			// IF MOD
			if ( $userdata['user_level'] == MOD )
			{
				$valid_user_types .= ',2';
			
				// IF MOD OF THIS FORUM
					if ( $is_auth['auth_mod'] == 1 )
				{
					$valid_user_types .= ',3';
				}
			}
			$sql_where .= ( !empty($valid_user_types) ) ? 'user_type IN ('.$valid_user_types.')' : '';

			// IF POST COUNT THRESHOLD APPLIES, ADD TO QUERY
			if ($config_set[3] == 1)
			{
				$sql_where .= ( !empty($sql_where) ) ? ' AND ' : '';
				$sql_where .= 'weighting <= '.$userdata['user_posts'];
			}
		}
		$sql .= ( !empty($sql_where) ) ? ' WHERE '.$sql_where : '';
		$sql .= ' ORDER BY points DESC, weighting DESC';

		if( !($result = $db->sql_query($sql)) )
		{
			message_die(CRITICAL_ERROR, 'Could not query rating option information', '', __LINE__, __FILE__, $sql);
		}
		elseif( $db->sql_numrows($result) == 0)
		{
			$rate_post_msg = $lang['No_rating_permission_post'];
		}
		else
		{
			if ( !isset($userdata['rating_status']) )
			{
				$sql2 = 'SELECT rating_status FROM '.USERS_TABLE.' WHERE user_id = '.$userdata['user_id'];
				if( !($result2 = $db->sql_query($sql2)) )
				{
					message_die(CRITICAL_ERROR, 'Could not query user information', '', __LINE__, __FILE__, $sql2);
				}
				$row2 = $db->sql_fetchrow($result2);
				$rating_status = $row2['rating_status'];
			}
			else
			{
				$rating_status = $userdata['rating_status'];
			}

			if ( $rating_status == 3 )
			{
				// NOT ALLOWED TO RATE
				$rate_post_msg = $lang['No_rating_permission'];
			}
			else
			{
				// IS ALLOWED TO RATE, DISPLAY OPTIONS AND SUBMIT BUTTON
				$rate_post_msg = $lang['Your_rating'];

				while( $row = $db->sql_fetchrow($result) )
				{
					$label = ( !empty($row['label']) ) ? $row['label'] : $row['points'];
					$selected = ( $previous_rating == $row['option_id'] ) ? ' CHECKED' : '';
					$template->assign_block_vars('option', array(
						'ID' => $row['option_id'],
						'SELECTED' => $selected,
						'LABEL' => $row['label']
						)
					);
				}
				$selected = ( empty($previous_rating) ) ? ' CHECKED' : '';
				$template->assign_block_vars('option', array(
					'ID' => 0,
					'SELECTED' => $selected,
					'LABEL' => $lang['No_rating']
					)
				);

				$end_of_form = '<input type="submit" name="submit" value="'.$lang['Rate_it'].'">';

				if ( $config_set[7] == 1 )
				{
					// ANONYMOUS SETTING
					if ( $rating_status > 1 )
					{
						$end_of_form .= '&nbsp;<span class="genmed">'.$lang['Rating_visible'].'</span>';
					}
					else
					{
						$anon_checked = ( $rating_status == 1 ) ? ' CHECKED' : '';
						$end_of_form .= '&nbsp;<input type="checkbox" name="anonymous_new" '.$anon_checked.'>&nbsp;<span 	class="genmed">'.$lang['Rate_anonymously'].'</span>';
						$end_of_form .= '&nbsp;<input type="hidden" name="anonymous_old" value="'.$rating_status.'">';
					}
				}
				elseif ( $rating_status > 0 )
				{
					// CURRENTLY ANON, BUT THIS IS NO LONGER ALLOWED - CHANGE BACK
					$end_of_form .= '&nbsp;<input type="hidden" name="anonymous_old" value="1">';
					$end_of_form .= '&nbsp;<input type="hidden" name="anonymous_new" value="0">';
					$end_of_form .= '&nbsp;<span class="genmed">'.$lang['Rating_visible_forced'].'</span>';
				}
				else
				{
					$end_of_form .= '&nbsp;<span class="genmed">'.$lang['Rating_visible'].'</span>';
				}
			}
		}
	}
}


$u_end_link = ( $config_set[14] == 1 ) ? 'JavaScript:window.close();' : append_sid($phpbb_root_path.'viewtopic.'.$phpEx.'?' . POST_POST_URL . '=' . $p) . '#' . $p;
;
$l_end_link = ( $config_set[14] == 1 ) ? $lang['Close_window'] : $lang['Return_to_post'];

$template->assign_vars(array(
	'HEADING' => $lang['Rating_page_title'],
	'MESSAGE' => $message,
	'FORM_ACTION' => $this_url,
	'POSTER' =>	$poster,
	'POSTER_ID' =>	$poster_id,
	'T_TITLE' => smilies_pass($topic_title),
	'POST_RANK' => $post_rating,
	'TOPIC_RANK' => $topic_rating,
	//'USER_RANK' => $user_rating,
	'SUBMIT_BUTTON' =>	$end_of_form,
	'RATE_POST_MSG' => $rate_post_msg,
	'U_END_LINK' => $u_end_link,
	'L_END_LINK' => $l_end_link,
	'L_POSTER' => $lang['Poster'],
	'L_BIAS' => $lang['Rating_bias'],
	'L_USER_RANK' => $lang['User_rank'],
	'L_TOPIC' => $lang['Topic'],
	'L_TOPIC_RANK' => $lang['Topic_rank'],
	'L_POST_RANK' => $lang['Post_rank'],
	'L_RATED_BY' => $lang['Rated_by'],
	'L_RATED_ON' => $lang['Rated_on'],
	'L_RATING' => $lang['Rating'],
	)
);


// Output page header
$page_title = $lang['Rating_page_title'];
if($config_set[14]){ 
    $gen_simple_header = 1; 
    $template->assign_block_vars('popup',array()); 
} else { 
    $template->assign_block_vars('no_popup',array()); 
}
include($phpbb_root_path . 'includes/page_header.'.$phpEx);

$template->pparse("body");

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
?>
