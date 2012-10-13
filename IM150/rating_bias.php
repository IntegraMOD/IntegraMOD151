<?php
/***************************************************************************
 *                              bias.php v1.1.0
 *                            -------------------
 *   begin                : Tuesday, Jun 3, 2003
 *   copyright            : (C) 2002 Web Centre Ltd
 *   email                : phpbb@mywebcommunities.com
 *
 *   MODIFICATION HISTORY
 ***************************************************************************/

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

// Start session management
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);
// End session management

// VALIDATE GET VARS
$s = intval($HTTP_GET_VARS['s']);
$m = intval($HTTP_GET_VARS['m']);
$this_url = append_sid($PHP_SELF).'?m='.$m.'&s='.$s;
$n = intval($HTTP_GET_VARS['n']);

// MUST BE LOGGED IN
if ( !$userdata['session_logged_in'] )
{
		redirect(append_sid('login.'.$phpEx.'?redirect='.$this_url, true));
}

define('RATING_PATH', $phpbb_root_path.'mods/rating/');
$use_lang = ( !file_exists($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_rating.'.$phpEx) ) ? 'english' : $board_config['default_lang']; 
include($phpbb_root_path . 'language/lang_' . $use_lang . '/lang_rating.' . $phpEx); 
include (RATING_PATH.'functions_rating.'.$phpEx);

// LINKS TO OTHER SCREENS
if ( $s == 1 )
{
	$page_title = $lang['Rating_their_bias_title'];
	$l_alt_screen = $lang['Rating_my_bias_title'];
	$u_alt_screen = append_sid($phpbb_root_path.'rating_bias.'.$phpEx.'?s=0');
}
else
{
	$page_title = $lang['Rating_my_bias_title'];
	$l_alt_screen = $lang['Rating_their_bias_title'];
	$u_alt_screen = append_sid($phpbb_root_path.'rating_bias.'.$phpEx.'?s=1');
}

$rating_config = get_rating_config('1,11,17');
if ( $rating_config[1] == 0 )
{
	message_die(GENERAL_ERROR, $lang['Rating_deactivated'], '', __LINE__, __FILE__, $sql); 
}
elseif ( $rating_config[11] == 0 )
{
	message_die(GENERAL_ERROR, $lang['Rating_bias_off'], '', __LINE__, __FILE__, $sql); 
}

if ( !empty($n) )
{
	// MAKE NEUTRAL FOR SPECIFIED USER_ID
	$sql = 'DELETE FROM '.RATING_BIAS_TABLE.' WHERE user_id = '.$userdata['user_id'].' AND target_user = '.$n;
	if( !($result = $db->sql_query($sql)) )
	{
		message_die(CRITICAL_ERROR, "Could not update bias information", "", __LINE__, __FILE__, $sql);
	}
}

// Grab all the basic data 
$sql_select = 'b.bias_status, b.bias_time, u.username, u.user_id, o.label, o.points AS label2, p.post_id, o2.label AS current_label, o2.points AS current_label2';
$sql_from = RATING_BIAS_TABLE.' b, ' . USERS_TABLE . ' u, ' . RATING_OPTION_TABLE . ' o';
$sql_where = ( $s == 1 ) ? 'b.target_user = '.$userdata['user_id'].' AND b.user_id = u.user_id' : 'b.user_id = '.$userdata['user_id'].' AND b.target_user = u.user_id';
$sql_where .= ( !empty($m) ) ? ' AND b.bias_status = '.$m : '';
$sql_where .= ' AND b.option_id = o.option_id';
switch (SQL_LAYER) 
{ 
	case 'oracle': 
		$sql_from .= ', '.POSTS_TABLE.' p, '.RATING_TABLE.' r, '.RATING_OPTION_TABLE.' o2';
		$sql_where .= ' AND b.post_id = p.post_id(+) AND b.post_id = r.post_id(+) AND b.target_user = r.user_id(+) AND r.option_id = o2.option_id';
		break; 

	default: 
		$sql_from .= ' LEFT JOIN '.POSTS_TABLE.' p ON b.post_id = p.post_id';
		$sql_from .= ' LEFT JOIN '.RATING_TABLE.' r ON b.post_id = r.post_id AND b.target_user = r.user_id';
		$sql_from .= ' LEFT JOIN '.RATING_OPTION_TABLE.' o2 ON r.option_id = o2.option_id';
}
$sql_order = 'b.bias_status, b.bias_time DESC';
$sql_group = ( $s == 1 ) ? 'b.user_id' : 'b.target_user';
$sql = 'SELECT '.$sql_select.' FROM '.$sql_from.' WHERE '.$sql_where;
$sql .= ( !empty($sql_group) ) ? ' GROUP BY '.$sql_group : '';
$sql .= ( !empty($sql_order) ) ? ' ORDER BY '.$sql_order : '';
$sql .= ( !empty($sql_limit) ) ? ' LIMIT '.$sql_limit : '';

if( !($result = $db->sql_query($sql)) ) 
{ 
	message_die(GENERAL_ERROR, "Couldn't obtain bias information", '', __LINE__, __FILE__, $sql); 
}

$total_rows = $db->sql_numrows($result); 

// Define censored word matches 
//$orig_word = array(); 
//$replacement_word = array(); 
//obtain_word_list($orig_word, $replacement_word); 

$template->set_filenames(array( 
	'body' => 'rating_bias.tpl'
	)
); 

// Setup the stuff usually in the header 
$template->assign_vars(array( 
	"U_BIAS" => $this_url,
	"L_BIAS" => $lang['Rating_bias'],
	"L_WHO" => $lang['Rating_who'],
	"L_WHEN" => $lang['Rating_bias_when'],
	"L_REASON" => $lang['Rating_bias_prompt'],
	"L_CURRENT" => $lang['Rating_current'],
	'L_ALT_SCREEN' => $l_alt_screen,
	'U_ALT_SCREEN' => $u_alt_screen,
	'L_FORUM_INDEX' => $lang['Forum_index'],
	'U_FORUM_INDEX' => append_sid($phpbb_root_path.'index.'.$phpEx),
	'L_RATINGS' => $lang['Latest_ratings'],
	'U_RATINGS' => append_sid($phpbb_root_path.'ratings.'.$phpEx)
	)
); 


// Okay, lets dump out the page ... 
if( !empty($total_rows) ) 
{ 
	while( $row = $db->sql_fetchrow($result) ) 
	{ 
		// IF 'OTHERS BIAS TOWARDS ME' SCREEN
		if ( $s == 1 )
		{
			// DETERMINE WHETHER USERNAME SHOULD BE ANONYMOUS
			if ( $rating_config[17] == 0 || ( $rating_config[17] == 1 && $row['bias_status'] == 1 ) || (  $rating_config[17] == 2 && $row['bias_status'] == 2 ) )
			{
				$this_user = $lang['Rating_this_user'];
				$who = $lang['Rating_anon_user'];
			}
			else
			{
				$this_user = $row['username'];
				$who = '<a href="' . append_sid($phpbb_root_path . 'profile.' . $phpEx . '?mode=viewprofile&amp;' . POST_USERS_URL . '=' . $row['user_id']) . '">' . $row['username'] . '</a>'; 
			}
			if ( $row['bias_status'] == 1 )
			{
				// IGNORED
				$bias = '<img src="'.RATING_PATH.'images/ignore.gif" border="0" alt="'.sprintf($lang['Rating_ignored'],$this_user).'" />';
			}
			else
			{
				// BUDDY
				$bias = '<img src="'.RATING_PATH.'images/buddy.gif" border="0" alt="'.sprintf($lang['Rating_buddy'],$this_user).'" />';
			}
		}
		// MY BIAS SETTINGS
		else
		{
			$this_user = $row['username'];
			$who = '<a href="' . append_sid($phpbb_root_path . 'profile.' . $phpEx . '?mode=viewprofile&amp;' . POST_USERS_URL . '=' . $row['user_id']) . '">' . $row['username'] . '</a>'; 
			$neutral_icon = '<a href="'.$this_url.'&amp;n='.$row['user_id'].'" title="'.sprintf($lang['Rating_make_neutral'],$row['username']).'"><img src="'.$phpbb_root_path.RATING_PATH.'images/neutral_grey.gif" border="0" alt="'.sprintf($lang['Rating_make_neutral'],$row['username']).'" /></a>';
			if ( $row['bias_status'] == 1 )
			{
				// IGNORED
				$bias = $neutral_icon.'<img src="'.RATING_PATH.'images/ignore.gif" border="0" alt="'.sprintf($lang['Rating_is_ignored'],$this_user).'" />';
			}
			else
			{
				// BUDDY
				$bias = '<img src="'.RATING_PATH.'images/buddy.gif" border="0" alt="'.sprintf($lang['Rating_is_buddy'],$this_user).'" />'.$neutral_icon;
			}
		}
		$this_post = ( empty($row['post_id']) ) ? $lang['Rating_post_removed'] : '<a href="'.append_sid($phpbb_root_path . 'viewtopic.' . $phpEx . '?' . POST_POST_URL. '=' .$row['post_id'] . '#' . $row['post_id']).'">'.$lang['Rating_this_post'].'</a>';
		$rating = ( !empty($row['label']) ) ? $row['label'] : $row['label2'];
		$reason = $lang['Rating_of'].' <b>'.$rating.'</b> '.$lang['Rating_awarded_to'].' '.$this_post;
		$current = ( !empty($row['current_label']) ) ? $row['current_label'] : $row['current_label2'];
		$current = ( !empty($current) ) ? $current : '-';
		$when = create_date($board_config['default_dateformat'], $row['bias_time'], $board_config['board_timezone']);

		$template->assign_block_vars('bias', array( 
			"BIAS" => $bias, 
			"WHO" => $who,
			"WHEN" => $when, 
			"REASON" => $reason, 
			"CURRENT" => $current
			)
		); 
	}
} 
else 
{ 
	// No bias
	$template->assign_vars(array( 
		"L_NO_BIAS" => $lang['Rating_no_bias']) 
	); 
	$template->assign_block_vars('nobias', array() ); 
} 
$db->sql_freeresult($result);


// Parse the page and print 
include($phpbb_root_path . 'includes/page_header.php'); 
$template->pparse('body'); 
include($phpbb_root_path . 'includes/page_tail.php'); 
?>