<?php
/***************************************************************************
 *                              ratings.php v1.1.0
 *                            -------------------
 *   begin                : Friday, Mar 21, 2003
 *   copyright            : (C) 2002 Web Centre Ltd
 *   email                : phpbb@mywebcommunities.com
 *
 *   MODIFICATION HISTORY
 *   v1.0.1 12th March 2003
 *   - Take proper account of "Show who rated" setting in admin panel
 *   v1.0.2 21st March 2003
 *   - Use standard phpBB call for language file
 *   v1.1.0 19th May 2003
 *   - Added 'Total (1 per user)' method to topic_rating
 ***************************************************************************/

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);
include($phpbb_root_path . 'includes/bbcode.'.$phpEx);


// Start session management
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);
// End session management

// VALIDATE GET VARS
$type = ( empty($_GET['type']) ) ? 'l' : $_GET['type'];
$forum_id = intval($_GET['forum_id']);
$postedby = intval($_GET['postedby']);
$ratedby = intval($_GET['ratedby']);
$ratingsby = ( !empty($_GET['ratingsby']) ) ? intval($_GET['ratingsby']) : 1;
$sql_limit = 20; // Number of posts/topics you want displayed 

define('RATING_PATH', $phpbb_root_path.'mods/rating/');
$use_lang = ( !file_exists($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_rating.'.$phpEx) ) ? 'english' : $board_config['default_lang']; 
include($phpbb_root_path . 'language/lang_' . $use_lang . '/lang_rating.' . $phpEx); 
include (RATING_PATH.'functions_rating.'.$phpEx);
$rating_config = get_rating_config('1,2,6,8,9,10,11');
if ( $rating_config[1] == 0 )
{
	message_die(GENERAL_MESSAGE, $lang['Rating_deactivated']); 
}

// RATINGS_BY DROPDOWN BOX
if ( $rating_config[11] == 0 || !$userdata['session_logged_in'] )
{
	$ratings_by = array(
	 1=>array('title'=>$lang['Rating_everyone'], 'selected'=>' SELECTED')
	 );
	$l_include_by = $lang['Rating_include_by'];
}
else
{
	$ratings_by = array(
	 1=>array('title'=>$lang['Rating_all_but_ignore'], 'selected'=>''),
	 2=>array('title'=>$lang['Rating_everyone'], 'selected'=>''),
	 3=>array('title'=>$lang['Rating_buddies_only'], 'selected'=>'')
	 );
	// 'u'=>array('title'=>$lang['Highest_rated_users'], 'selected'=>'')
	$ratings_by[$ratingsby]['selected'] = ' SELECTED';

	// IF BIAS SYSTEM ACTIVE, CREATE LINK TO BIAS SETTINGS
	$l_include_by = '<a href="'.append_sid($phpbb_root_path.'rating_bias.'.$phpEx).'" title="'.$lang['Rating_my_bias_title'].'">'.$lang['Rating_include_by'].'</a>';
}

// SCREEN-TYPE DROPDOWN BOX
$screen_types = array(
 'l'=>array('title'=>$lang['Latest_ratings'], 'selected'=>''),
 't'=>array('title'=>$lang['Highest_ranked_topics'], 'selected'=>''),
 'p'=>array('title'=>$lang['Highest_ranked_posts'], 'selected'=>''),
 'u'=>array('title'=>$lang['Highest_ranked_posters'], 'selected'=>'')
 );
$screen_types[$type]['selected'] = ' SELECTED';

// SHOULD DATA IN 'REGISTERED USER ONLY' FORUMS BE DISPLAYED?
$r_auth_level = ( !$userdata['session_logged_in'] ) ? 0 : 1;

// FORUM DROPDOWN BOX
$forums = array(0 => array('title'=>$lang['Rating_all_forums'], 'selected'=>''));
$flist = '';
for ($i=0; $i < count($tree['keys']); $i++)
{
	if ( ($tree['type'][$i] == POST_FORUM_URL) && $tree['auth'][POST_FORUM_URL.$tree['id'][$i]]['auth_download'] )
	{
		// this forum is allowed, now check the include param
		// if array is empty (==> first elem of array in null; do not use count) 
		// or forum is in array
		if(!$fincl[0] || in_array($tree['id'][$i],$fincl)){
			$flist .= (($flist != '') ? ', ' : '') . $tree['id'][$i];
		}
	}
}
if(strlen($flist)){
	$fsql = " f.forum_id in ($flist)";
} else { 
	// means that user isn't allowed to see any forum
	$fsql = " f.forum_id in (-1)";
}
/*$sql = 'SELECT forum_id, forum_name FROM '.FORUMS_TABLE.' f
 WHERE f.auth_view <= '.$r_auth_level.' 
 AND f.auth_read <= '.$r_auth_level.' 
 ORDER BY f.forum_name';*/
$sql = 'SELECT forum_id, forum_name FROM '.FORUMS_TABLE.' f
 WHERE '.$fsql.' 
 ORDER BY f.forum_name';
if( !($result = $db->sql_query($sql)) ) 
{ 
	message_die(GENERAL_ERROR, "Couldn't obtain temporary rating information", '', __LINE__, __FILE__, $sql); 
}
while( $row = $db->sql_fetchrow($result) ) 
{
	$forums[$row['forum_id']] = array('title'=>stripslashes($row['forum_name']), 'selected'=>'');
}

// Grab all the basic data 
$sql_select = 't.topic_title, t.rating_rank_id AS topic_rating, p.rating_rank_id AS post_rating, t.topic_id, u.username, u.user_id, r.rating_time, ro.label, ro.points AS label2, f.forum_id, p.post_id';
$sql_from = '('.RATING_TABLE.' r, '. TOPICS_TABLE . ' t, ' . USERS_TABLE . ' u, ' . POSTS_TABLE . ' p, ' . FORUMS_TABLE . ' f, ' . USERS_TABLE . ' u2, ' . RATING_OPTION_TABLE . ' ro, ' . RATING_RANK_TABLE . ' rt)';
/*$sql_where = 'r.post_id = p.post_id 
AND p.poster_id = u.user_id 
AND r.user_id = u2.user_id 
AND p.topic_id = t.topic_id 
AND t.topic_status = 0
AND t.forum_id = f.forum_id 
AND f.auth_view <= '.$r_auth_level.' 
AND f.auth_read <= '.$r_auth_level.' 
AND r.option_id = ro.option_id';*/
$sql_where = 'r.post_id = p.post_id 
AND p.poster_id = u.user_id 
AND r.user_id = u2.user_id 
AND p.topic_id = t.topic_id 
AND t.topic_status = 0
AND t.forum_id = f.forum_id  
AND r.option_id = ro.option_id 
AND '.$fsql;
$sql_where .= ( $rating_config[2] == '1' ) ? ' AND r.post_id = t.topic_first_post_id' : '';
switch ($type)
{
	case 'u':
		if ( $rating_config[10] == 1 )
		{
			$rmethod = 'SUM(ro.points)';
			$l_column4 = $lang['Total_points'];
		}
		else
		{
			$rmethod = 'ROUND(AVG(ro.points),1)';
			$l_column4 = $lang['Average_points'];
		}
		$page_title = $lang['Highest_ranked_posters'];
		$sql_select .= ', rk.rank_image, rk.rank_title, '.$rmethod.' AS points, u.user_posts, u.user_gender, u.user_rank';
		$sql_from .= ', '.RANKS_TABLE.' rk';
		$sql_where .= ' AND p.rating_rank_id = rt.rating_rank_id AND u.user_rank = rk.rank_id';
		$sql_order = 'points DESC, u.user_posts';
		$sql_group = 'p.poster_id';

		$l_column1 = $lang['Poster'];
		$l_column3 = $lang['Posts'];
		$l_column2 = $lang['Rating_sample_post'];
		$l_column5 = $lang['Poster_rank'];

		break;
	case 'p':
		if ( $rating_config[8] == 1 )
		{
			$rmethod = 'SUM(ro.points)';
			$l_column4 = $lang['Total_points'];
			$sql_order = 'points DESC, rt.sum_threshold DESC';
		}
		else
		{
			$rmethod = 'ROUND(AVG(ro.points),1)';
			$l_column4 = $lang['Average_points'];
			$sql_order = 'points DESC, rt.average_threshold DESC';
		}
		$page_title = $lang['Highest_ranked_posts'];

		$sql_select .= ', f.forum_name, '.$rmethod.' AS points';
		$sql_where .= ' AND p.rating_rank_id = rt.rating_rank_id';
		$sql_group = 'p.post_id';
		// Get double req number of ratings, to allow for multiple ratings for same post. note this still doesn't guarantee enough records for desired no. of posts/topics but grabbing too many records would affect screen performance. Adjust to suit your own requirements
		$sql_limit *= 3;
		$l_column1 = $lang['Forum'];
		$l_column3 = $lang['Poster'];
		$l_column5 = $lang['Post_rank'];
		break;
	case 't':
		if ( $rating_config[9] == 3 )
		{
			// TOTAL (1 PER USER)
			$d_sql = 'DELETE FROM bb_rating_temp';
			if( !($d_result = $db->sql_query($d_sql)) ) 
			{ 
				message_die(GENERAL_ERROR, "Couldn't delete temporary rating information", '', __LINE__, __FILE__, $d_sql); 
			}
			$sql_select = 'INSERT INTO bb_rating_temp (topic_id, points) SELECT t.topic_id, MAX(ro.points) AS points';
			$l_column4 = $lang['Total_points'];
			$sql_group = 't.topic_id, r.user_id';
			$sql_order = 't.topic_id';
			$using_temp_table = 'y';
			$sql_limit = '';
		}
		elseif ( $rating_config[9] == 1 )
		{
			// TOTAL (ALL)
			$sql_select .= ', f.forum_name, SUM(ro.points) AS points';
			$l_column4 = $lang['Total_points'];
			$sql_group = 't.topic_id';
			$sql_order = 'points DESC';
			$sql_limit *= 3;
		}
		else
		{
			// AVERAGE
			$sql_select .= ', f.forum_name, ROUND(AVG(ro.points),1) AS points';
			$l_column4 = $lang['Average_points'];
			$sql_group = 't.topic_id';
			$sql_order = 'points DESC';
			$sql_limit *= 3;
		}
		$page_title = $lang['Highest_ranked_topics']; 
		$sql_where = str_replace('p.poster_id', 't.topic_poster', $sql_where);
		$sql_where .= ' AND t.rating_rank_id = rt.rating_rank_id';
		$l_column1 = $lang['Forum'];
		$l_column3 = $lang['Topic_starter'];
		$l_column5 = $lang['Topic_rank'];
		break;
	default:
		$page_title = $lang['Latest_ratings'];
		$sql_select .= ', u2.username as ratedby, u2.rating_status, u2.user_id as ratedby_id';
		$sql_where .= ' AND p.rating_rank_id = rt.rating_rank_id';
		$sql_order = 'r.rating_time DESC';
		$l_column1 = $lang['Poster'];
		$l_column3 = $lang['Rating'];
		$l_column4 = $lang['Rated_by'];
		$l_column5 = $lang['Post_rank'];
}

// POSTS IN A SPECIFIC FORUM?
if ( !empty($forum_id) )
{
	$sql_where .= ' AND t.forum_id = '.$forum_id;
	$page_title .= ' '.$lang['Rating_in'].' "'.$forums[$forum_id]['title'].'"';
	$forums[$forum_id]['selected'] = ' SELECTED';
}

// POSTS BY A SPECIFIC POSTER?
if ( !empty($postedby) )
{
	if ( $postedby == $userdata['user_id'] )
	{
		$by_poster = $lang['Ratings_posts_by_you'];
	}
	else
	{
		$sql = 'SELECT username, rating_status FROM '.USERS_TABLE.' WHERE user_id = '.$postedby;
		$result = $db->sql_query($sql);
		$r = $db->sql_fetchrow($result);
		$by_poster = $lang['Ratings_posts_by'].' '.$r['username'];
	}
	$sql_where .= ' AND p.poster_id = '.$postedby;
	$page_title .= ' ('.$by_poster.')';
	// IF SHOWING POSTS, DISPLAY POST RATING INSTEAD OF TOTAL/AVERAGE POINTS
}

// RATINGS BY A SPECIFIC USER?
if ( $ratedby > 0 )
{
	if ( $rating_config[6] == 0 )
	{
		message_die(GENERAL_MESSAGE, $lang['Ratedby_hidden'], '', __LINE__, __FILE__, $sql); 
	}

	if ( $ratedby == $userdata['user_id'] )
	{
		$by_user = $lang['As_rated_by_you'];
	}
	else
	{
		$sql = 'SELECT username, rating_status FROM '.USERS_TABLE.' WHERE user_id = '.$ratedby;
		$result = $db->sql_query($sql);
		$r = $db->sql_fetchrow($result);
		if ( $r['rating_status'] == 1 )
		{
			$is_anonymous = 'y';
		}
		$by_user = $lang['As_rated_by'].' '.$r['username'];
	}
	$sql_where .= ' AND r.user_id = '.$ratedby;
	$page_title .= ' '.$by_user;
	// IF SHOWING POSTS, DISPLAY POST RATING INSTEAD OF TOTAL/AVERAGE POINTS
	if ( $type == 'p' )
	{
		$l_column4 = $lang['Rating'];
	}
}
elseif ( $ratingsby == 1 )
{
	// EXCLUDE RATINGS BY THOSE ON THIS USER'S IGNORE LIST
	switch (SQL_LAYER) 
	{ 
		case 'oracle': 
			$sql_from .= ', '.RATING_BIAS_TABLE.' i';
			$sql_where .= ' AND '.intval($userdata['user_id']).' = i.user_id(+) AND r.user_id = i.target_user(+) AND (i.bias_status IS NULL OR i.bias_status != 1)';
			break; 

		default: 
			$sql_from .= ' LEFT JOIN '.RATING_BIAS_TABLE.' i ON i.user_id = '.intval($userdata['user_id']).' AND r.user_id = i.target_user';
			$sql_where .= ' AND (i.bias_status IS NULL OR i.bias_status != 1)';
	}
}
elseif ( $ratingsby == 3 )
{
	// ONLY RATINGS BY THOSE ON THIS USER'S BUDDY LIST
	$sql_from .= ', '.RATING_BIAS_TABLE.' i';
	$sql_where .= ' AND '.intval($userdata['user_id']).' = i.user_id AND r.user_id = i.target_user AND i.bias_status = 2';
}


$sql = ( $using_temp_table == 'y' ) ? '' : 'SELECT ';
$sql .= $sql_select.' FROM '.$sql_from.' WHERE '.$sql_where;
$sql .= ( !empty($sql_group) ) ? ' GROUP BY '.$sql_group : '';
$sql .= ( !empty($sql_order) ) ? ' ORDER BY '.$sql_order : '';
$sql .= ( !empty($sql_limit) ) ? ' LIMIT '.$sql_limit : '';

if( !($result = $db->sql_query($sql)) ) 
{ 
	message_die(GENERAL_ERROR, "Couldn't obtain post rating information", '', __LINE__, __FILE__, $sql); 
}

if ( $using_temp_table == 'y' )
{
	// Where sorting couldn't be done in one query (e.g. 1-per-user method for topic ranks)
	$sql_limit = 20;
	$sql = 'SELECT t.topic_title, t.rating_rank_id AS topic_rating, t.topic_id, u.username, u.user_id, f.forum_id, f.forum_name, SUM(z.points) AS points';
	$sql .= ' FROM bb_rating_temp z, '. TOPICS_TABLE . ' t, ' . USERS_TABLE . ' u, ' . FORUMS_TABLE . ' f';
	$sql .= ' WHERE z.topic_id = t.topic_id
	AND t.topic_poster = u.user_id 
	AND t.forum_id = f.forum_id 
	GROUP BY z.topic_id 
	ORDER BY points DESC';
	$sql .= ( !empty($sql_limit) ) ? ' LIMIT '.$sql_limit : '';
	if( !($result = $db->sql_query($sql)) ) 
	{ 
		message_die(GENERAL_ERROR, "Couldn't obtain temporary rating information", '', __LINE__, __FILE__, $sql); 
	}
	$d_sql = 'DELETE FROM bb_rating_temp';
	if( !($d_result = $db->sql_query($d_sql)) ) 
	{ 
		message_die(GENERAL_ERROR, "Couldn't delete temporary rating information", '', __LINE__, __FILE__, $d_sql); 
	}
}


$total_rows = $db->sql_numrows($result); 

// Define censored word matches 
$orig_word = array(); 
$replacement_word = array(); 
obtain_word_list($orig_word, $replacement_word); 

$template->set_filenames(array( 
	'body' => 'ratings.tpl'
	)
); 

$u_ratings = append_sid($PHP_SELF);
$l_column2 = ( !empty($l_column2) ) ? $l_column2 : $lang['Topic'];

// Setup the stuff usually in the header 
$template->assign_vars(array( 
	'L_FORUM_INDEX' => $lang['Forum_index'],
	'U_FORUM_INDEX' => append_sid($phpbb_root_path.'index.'.$phpEx),
	'L_MY_BIAS' => $l_my_bias,
	'U_MY_BIAS' => $u_my_bias,
	'L_THEIR_BIAS' => $l_their_bias,
	'U_THEIR_BIAS' => $u_their_bias,
	"U_RATINGS" => $u_ratings, 
	"L_POSTER" => $lang['Poster'], 
	"L_TOPIC" => $l_column2, 
	"L_FORUM" => $lang['Forum'], 
	"L_SCREEN_TYPE" => $lang['Rating_screen_type'], 
	"L_INCLUDE_BY" => $l_include_by,
	"L_COLUMN1" => $l_column1, 
	"L_COLUMN3" => $l_column3, 
	"L_COLUMN4" => $l_column4, 
	"L_COLUMN5" => $l_column5 
	)
); 

// Okay, lets dump out the page ... 
if( !empty($total_rows) && $is_anonymous != 'y' ) 
{ 
	while( $row = $db->sql_fetchrow($result) ) 
	{ 
		// Start auth check 
		$is_auth = array(); 
		$is_auth = auth(AUTH_ALL, $row['forum_id'], $userdata); 

		if( $is_auth['auth_read'] )
		{
			$rowset[] = $row; 
		}
	}
	// Limit the number of topics 
	$total_rows = ( $total_rows > $sql_limit ) ? $sql_limit : $total_rows;

	get_rating_ranks();

	for($i = 0; $i < $total_rows; $i++) 
	{ 
		$topic_title = ( count($orig_word) > 0 ) ? preg_replace($orig_word, $replacement_word, $rowset[$i]['topic_title']) : 	$rowset[$i]['topic_title']; 

		$poster = ( $rowset[$i]['user_id'] != ANONYMOUS ) ? '<a href="' . append_sid($phpbb_root_path . 'profile.' . $phpEx . '?mode=viewprofile&amp;' . POST_USERS_URL . '=' . $rowset[$i]['user_id']) . '">' . $rowset[$i]['username'] . '</a>' : $lang['Guest']; 

		switch ($type)
		{
			case 'u':
				$column1 = $poster;
				$column2 = append_sid($phpbb_root_path . 'viewtopic.' . $phpEx . '?' . POST_POST_URL. '=' .$rowset[$i]['post_id'] . '#' . $rowset[$i]['post_id']);
				$column3 = $rowset[$i]['user_posts'];
				$column4 = $rowset[$i]['points'];
				$all_ranks = array();
				init_ranks($all_ranks);
				if( empty($rowset[$i]['rank_title']) )
				{
					$column5 = $lang['No_rank'];
				}
				else
				{
					$rank_temp = get_user_rank($rowset[$i]);
					$column5 = $rank_temp['rank_title'];
				}
				break;
			case 'p':
				$column1 = '<a href="' . append_sid($phpbb_root_path . 'viewforum.' . $phpEx . '?' . POST_FORUM_URL . '=' . $rowset[$i]['forum_id']) . '">' . $rowset[$i]['forum_name'] . '</a>';
				$column2 = append_sid($phpbb_root_path . 'viewtopic.' . $phpEx . '?' . POST_POST_URL. '=' .$rowset[$i]['post_id'] . '#' . $rowset[$i]['post_id']);
				$column3 = $poster;
				if ( $ratedby > 0 )
				{
					$column4 = ( !empty($rowset[$i]['label']) ) ? $rowset[$i]['label'] : $rowset[$i]['label2'];
				}
				else
				{
					$column4 = $rowset[$i]['points'];
				}
				$column5 = ( empty($rowset[$i]['post_rating']) ) ? $lang['No_rank'] : $post_rank_set[$rowset[$i]['post_rating']];
				break;
			case 't':
				$column1 = '<a href="' . append_sid($phpbb_root_path . 'viewforum.' . $phpEx . '?' . POST_FORUM_URL . '=' . $rowset[$i]['forum_id']) . '">' . $rowset[$i]['forum_name'] . '</a>';
				$column2 = append_sid($phpbb_root_path . 'viewtopic.' . $phpEx . '?' . POST_TOPIC_URL. '=' .$rowset[$i]['topic_id']);
				$column3 = $poster;
				$column4 = $rowset[$i]['points'];
				$column5 = ( empty($rowset[$i]['topic_rating']) ) ? $lang['No_rank'] : $topic_rank_set[$rowset[$i]['topic_rating']];
				break;
			default:
				$column1 = $poster;
				$column2 = append_sid($phpbb_root_path . 'viewtopic.' . $phpEx . '?' . POST_POST_URL. '=' .$rowset[$i]['post_id'] . '#' . $rowset[$i]['post_id']);
				$column3 = ( !empty($rowset[$i]['label']) ) ? $rowset[$i]['label'] : $rowset[$i]['label2'];
				$column4 = ( $rowset[$i]['rating_status'] != 1 && $rating_config[6] == 1 ) ? '<a href="' . append_sid($phpbb_root_path . 'profile.' . $phpEx . '?mode=viewprofile&amp;' . POST_USERS_URL . '=' . $rowset[$i]['ratedby_id']) . '">' . $rowset[$i]['ratedby'] . '</a>' : $lang['Rating_anon_user']; 
				$column5 = ( empty($rowset[$i]['post_rating']) ) ? $lang['No_rank'] : $post_rank_set[$rowset[$i]['post_rating']];
		}

		$template->assign_block_vars('rating', array( 
			"COLUMN1" => $column1, 
			"COLUMN2" => $column2,
			"COLUMN3" => $column3, 
			"COLUMN4" => $column4, 
			"COLUMN5" => $column5, 
			"TOPIC_TITLE" => smilies_pass($topic_title), 
			"ROW_CLASS" => $row_class
			)
		); 
	}
} 
else 
{ 
	// No ratings 
	$template->assign_vars(array( 
		"L_NO_RATINGS" => $lang['No_ratings']) 
	); 
	$template->assign_block_vars('norating', array() ); 
} 
$db->sql_freeresult($result);

foreach ($ratings_by AS $key=>$val)
{
	$template->assign_block_vars('ratingsby', array( 
		"ID" => $key, 
		"TITLE" => $val['title'],
		"SELECTED" => $val['selected']
		)
	); 
}

foreach ($screen_types AS $key=>$val)
{
	$template->assign_block_vars('screen_type', array( 
		"VALUE" => $key, 
		"TITLE" => $val['title'],
		"SELECTED" => $val['selected']
		)
	); 
}

foreach ($forums AS $key=>$val)
{
	$template->assign_block_vars('forums', array( 
		"ID" => $key, 
		"TITLE" => $val['title'],
		"SELECTED" => $val['selected']
		)
	); 
}

// Parse the page and print 
include($phpbb_root_path . 'includes/page_header.php'); 
$template->pparse('body'); 
include($phpbb_root_path . 'includes/page_tail.php'); 
?>
