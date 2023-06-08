<?PHP

//
// Set configuration for Desktop Plus
//

// Number of Recent Topics (not Forum ID)
$CFG['number_recent_topics'] = '15';

// Exceptional Forums for Recent Topics, eg. '2,4,10'
$CFG['exceptional_forums'] = '';

//
// END configuration
// --------------------------------------------------------

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);
//
// End session management
//

// Desktop phpbb (Matt Ratcliff)
$lang['Logged_in_title'] = 'Status: %s';
$lang['Logged_in'] = 'Logged In';
$lang['Logged_out'] = 'Logged Out';
$lang['Logged_in_explain'] = 'You are currently logged in as <b>%s</b>.';
$lang['Logged_out_explain'] = 'You are currently logged out, click %shere%s to login.';
// Desktop phpbb

//
// Recent Topics
//
$sql = "SELECT * FROM ". FORUMS_TABLE . " ORDER BY forum_id";
if (!$result = $db->sql_query($sql))
{
	message_die(GENERAL_ERROR, 'Could not query forums information', '', __LINE__, __FILE__, $sql);
}
$forum_data = array();
while( $row = $db->sql_fetchrow($result) )
{
	$forum_data[] = $row;
}

$is_auth_ary = array();
$is_auth_ary = auth(AUTH_ALL, AUTH_LIST_ALL, $userdata, $forum_data);

if( $CFG['exceptional_forums'] == '' )
{
	$except_forum_id = '\'start\'';
}
else
{
	$except_forum_id = $CFG['exceptional_forums'];
}

for ($i = 0; $i < count($forum_data); $i++)
{
	if ((!$is_auth_ary[$forum_data[$i]['forum_id']]['auth_read']) or (!$is_auth_ary[$forum_data[$i]['forum_id']]['auth_view']))
	{
		if ($except_forum_id == '\'start\'')
		{
			$except_forum_id = $forum_data[$i]['forum_id'];
		}
		else
		{
			$except_forum_id .= ',' . $forum_data[$i]['forum_id'];
		}
	}
}
$sql = "SELECT t.topic_id, t.topic_title, t.topic_last_post_id, t.forum_id, p.post_id, p.poster_id, p.post_time, u.user_id, u.username
		FROM " . TOPICS_TABLE . " AS t, " . POSTS_TABLE . " AS p, " . USERS_TABLE . " AS u
		WHERE t.forum_id NOT IN (" . $except_forum_id . ")
			AND t.topic_status <> 2
			AND p.post_id = t.topic_last_post_id
			AND p.poster_id = u.user_id
		ORDER BY p.post_id DESC
		LIMIT " . $CFG['number_recent_topics'];
if (!$result = $db->sql_query($sql))
{
	message_die(GENERAL_ERROR, 'Could not query recent topics information', '', __LINE__, __FILE__, $sql);
}
$number_recent_topics = $db->sql_numrows($result);
$recent_topic_row = array();
while ($row = $db->sql_fetchrow($result))
{
	$recent_topic_row[] = $row;
}
for ($i = 0; $i < $number_recent_topics; $i++)
{
	$template->assign_block_vars('recent_topic_row', array(
		'U_TITLE' => append_sid("viewtopic.$phpEx?" . POST_POST_URL . '=' . $recent_topic_row[$i]['post_id']) . '#' .$recent_topic_row[$i]['post_id'],
		'L_TITLE' => $recent_topic_row[$i]['topic_title'],
		'U_POSTER' => append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $recent_topic_row[$i]['user_id']),
		'S_POSTER' => $recent_topic_row[$i]['username'],
		'S_POSTTIME' => create_date($board_config['default_dateformat'], $recent_topic_row[$i]['post_time'], $board_config['board_timezone'])
		)
	);
}
//
// END - Recent Topics
//

// Login Status
	if ($userdata['user_id'] != '-1')
	{
	$login_status_title = sprintf($lang['Logged_in_title'], '<font style="color:blue">' . $lang['Logged_in'] . '</font>');

	$login_status_explain = sprintf($lang['Logged_in_explain'], $userdata['username']);
	}
	else
	{
	$login_status_title = sprintf($lang['Logged_in_title'], '<font style="color:red">' . $lang['Logged_out'] . '</font>');

	$login_status_explain = sprintf($lang['Logged_out_explain'], '<a href="' . append_sid("../login.php") . '">', '</a>');
	}

//
// Start output of page
//
define('SHOW_ONLINE', true);

$template->set_filenames(array(
	'body' => 'desktop_body.tpl')
);

//
// Get basic (usernames + totals) online
// situation
//
$logged_visible_online = 0;
$logged_hidden_online = 0;
$guests_online = 0;
$online_userlist = '';

if (defined('SHOW_ONLINE'))
{
//	include_once($phpbb_root_path.'includes/functions_color_groups.'.$phpEx);
	$user_forum_sql = ( !empty($forum_id) ) ? "AND s.session_page = " . intval($forum_id) : '';
	$sql = "SELECT u.username, u.user_id, u.user_allow_viewonline, u.user_level, s.session_logged_in, s.session_ip
		FROM ".USERS_TABLE." u, ".SESSIONS_TABLE." s
		WHERE u.user_id = s.session_user_id
			AND s.session_time >= ".( time() - 300 ) . "
			$user_forum_sql
		ORDER BY u.username ASC, s.session_ip ASC";
	if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain user/online information', '', __LINE__, __FILE__, $sql);
	}

	$userlist_ary = array();
	$userlist_visible = array();

	$prev_user_id = 0;
	$prev_user_ip = '';

	while( $row = $db->sql_fetchrow($result) )
	{
		// User is logged in and therefor not a guest
		if ( $row['session_logged_in'] )
		{
			// Skip multiple sessions for one user
			if ( $row['user_id'] != $prev_user_id )
			{
				$style_color = '';
				if ( $row['user_level'] == ADMIN )
				{
					$row['username'] = '<b>' . $row['username'] . '</b>';
					$style_color = 'style="color:#' . $theme['fontcolor3'] . '"';
				}
				else if ( $row['user_level'] == MOD )
				{
					$row['username'] = '<b>' . $row['username'] . '</b>';
					$style_color = 'style="color:#' . $theme['fontcolor2'] . '"';
				}
				if ( $row['user_allow_viewonline'] )
				{
					$user_online_link = '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $row['user_id']) . '"' . $style_color .'>' . $row['username'] . '</a>';
					$logged_visible_online++;
				}
				else
				{
					$user_online_link = '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $row['user_id']) . '"' . $style_color .'><i>' . $row['username'] . '</i></a>';
					$logged_hidden_online++;
				}
				if ( $row['user_allow_viewonline'] || $userdata['user_level'] == ADMIN )
				{
					$online_userlist .= ( $online_userlist != '' ) ? ', ' . $user_online_link : $user_online_link;
				}
			}

			$prev_user_id = $row['user_id'];
		}
		else
		{
			// Skip multiple sessions for one user
			if ( $row['session_ip'] != $prev_session_ip )
			{
				$guests_online++;
			}
		}

		$prev_session_ip = $row['session_ip'];
	}
	$db->sql_freeresult($result);

	if ( empty($online_userlist) )
	{
		$online_userlist = $lang['None'];
	}
	$online_userlist = ( ( isset($forum_id) ) ? $lang['Browsing_forum'] : $lang['Registered_users'] ) . ' ' . $online_userlist;

	$total_online_users = $logged_visible_online + $logged_hidden_online + $guests_online;

	if ( $total_online_users > $board_config['record_online_users'])
	{
		$board_config['record_online_users'] = $total_online_users;
		$board_config['record_online_date'] = time();

		$sql = "UPDATE " . CONFIG_TABLE . "
			SET config_value = '$total_online_users'
			WHERE config_name = 'record_online_users'";
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not update online user record (nr of users)', '', __LINE__, __FILE__, $sql);
		}

		$sql = "UPDATE " . CONFIG_TABLE . "
			SET config_value = '" . $board_config['record_online_date'] . "'
			WHERE config_name = 'record_online_date'";
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not update online user record (date)', '', __LINE__, __FILE__, $sql);
		}
		$db->clear_cache('board_config');
	}

	if ( $total_online_users == 0 )
	{
		$l_t_user_s = $lang['Online_users_zero_total'];
	}
	else if ( $total_online_users == 1 )
	{
		$l_t_user_s = $lang['Online_user_total'];
	}
	else
	{
		$l_t_user_s = $lang['Online_users_total'];
	}

	if ( $logged_visible_online == 0 )
	{
		$l_r_user_s = $lang['Reg_users_zero_total'];
	}
	else if ( $logged_visible_online == 1 )
	{
		$l_r_user_s = $lang['Reg_user_total'];
	}
	else
	{
		$l_r_user_s = $lang['Reg_users_total'];
	}

	if ( $logged_hidden_online == 0 )
	{
		$l_h_user_s = $lang['Hidden_users_zero_total'];
	}
	else if ( $logged_hidden_online == 1 )
	{
		$l_h_user_s = $lang['Hidden_user_total'];
	}
	else
	{
		$l_h_user_s = $lang['Hidden_users_total'];
	}

	if ( $guests_online == 0 )
	{
		$l_g_user_s = $lang['Guest_users_zero_total'];
	}
	else if ( $guests_online == 1 )
	{
		$l_g_user_s = $lang['Guest_user_total'];
	}
	else
	{
		$l_g_user_s = $lang['Guest_users_total'];
	}

	$l_online_users = sprintf($l_t_user_s, $total_online_users);
	$l_online_users .= sprintf($l_r_user_s, $logged_visible_online);
	$l_online_users .= sprintf($l_h_user_s, $logged_hidden_online);
	$l_online_users .= sprintf($l_g_user_s, $guests_online);
}
$template->assign_vars(array(
	'LOGIN_STATUS_TITLE' => $login_status_title,
	'LOGIN_STATUS_EXPLAIN' => $login_status_explain,
	'L_RECENT_TOPICS' => $lang['Recent_topics'],
	'TOTAL_USERS_ONLINE' => $l_online_users,
	'LOGGED_IN_USER_LIST' => $online_userlist,
	'RECORD_USERS' => sprintf($lang['Record_online_users'], $board_config['record_online_users'], create_date($board_config['default_dateformat'], $board_config['record_online_date'], $board_config['board_timezone'])),
	'L_WHO_IS_ONLINE' => $lang['Who_is_Online'],
	'L_WHOSONLINE_ADMIN' => sprintf($lang['Admin_online_color'], '<span style="color:#' . $theme['fontcolor3'] . '">', '</span>'),
	'L_WHOSONLINE_MOD' => sprintf($lang['Mod_online_color'], '<span style="color:#' . $theme['fontcolor2'] . '">', '</span>'))
);



//
// Generate the page
//
$template->pparse('body');

?>