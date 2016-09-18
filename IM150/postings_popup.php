<?php 

define('IN_PHPBB', true); 
$phpbb_root_path = './'; 
include($phpbb_root_path . 'extension.inc'); 
include($phpbb_root_path . 'common.'.$phpEx); 

// Start session management 

$userdata = session_pagestart($user_ip, PAGE_FAQ); 
init_userprefs($userdata); 
 
// End session management 

include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_postings_popup.' . $phpEx);

// Start initial var setup

$topic_id = intval($_GET[POST_TOPIC_URL]);

// Load templates

$gen_simple_header = TRUE;
$page_title = $lang['Postings_popup_title'];
$topic_url = append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id");

include($phpbb_root_path . 'includes/page_header.'.$phpEx); 

$template->set_filenames(array( 
   'body' => 'postings_popup.tpl') 
); 

// Process the data
// Find who started the topic

$sql = "SELECT t.topic_poster, t.topic_title
	FROM " . TOPICS_TABLE . " t
	WHERE t.topic_id = $topic_id";
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not obtain topic information', '', __LINE__, __FILE__, $sql);
}
$row = $db->sql_fetchrow($result);
$starter = $row['topic_poster'];
$topic_title = $row['topic_title'];
$title_break = '&nbsp;';
if (strlen($topic_title) > 17)
{
	$title_break = '<br>';
}

// Send vars to template

$template->assign_vars(array( 
	'PAGE_TITLE' => $page_title,
	'TOPIC_URL' => $topic_url,
	'TOPIC_TITLE' => smilies_pass($topic_title),
	'TITLE_BREAK' => $title_break,
	'L_CLOSE_WINDOW' => "<a href='javascript:window.close();'>".$lang['Close_window']."</a>",
	'L_TOTAL_POSTS' => $lang['Total_posts'],
	'L_USER' => $lang['Poster'],
	'L_POSTS' => $lang['Posts'],
	'L_TOPIC' => $lang['Topic'],
	'L_AUTHOR' => $lang['Postings_popup_starter'],
	'L_VIEW_TOPIC' => $lang['View_topic'],
	'L_PROFILE_MESSAGE' => $lang['Profile_message'],
	'L_POSTS_MESSAGE' => $lang['Posts_message']
	) 
); 

// Find poster_id and their postcount and order by postcount then poster_id 
$sql = "SELECT DISTINCT p.poster_id, COUNT(p.topic_id) as postcount 
  FROM " . POSTS_TABLE . " p 
  WHERE p.topic_id = $topic_id 
  GROUP BY p.poster_id 
  ORDER BY postcount DESC, p.poster_id"; 

if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not obtain topic information', '', __LINE__, __FILE__, $sql);
}

$total_topics = 0;
$total_rows = 0;
while( $row = $db->sql_fetchrow($result) )
{
	$topic_rowset[] = $row;
	$total_topics += $row['postcount']; 
	$total_rows++; 
}

// Find the number of posts for each user
for($i = 0; $i < $total_rows; $i++)
{
	$poster_id = $topic_rowset[$i]['poster_id'];
	$flag = '&nbsp;&nbsp;&nbsp;';

	if($poster_id == $starter)
	{
		$flag = '*&nbsp;';
	}
	$sql = "SELECT u.username 
		FROM " . USERS_TABLE . " u
		WHERE user_id = $poster_id"; 
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain poster information', '', __LINE__, __FILE__, $sql);
	}

	$posts = $topic_rowset[$i]['postcount'];
	$row = $db->sql_fetchrow($result);
	$poster = $row['username'];
	$posts_url = append_sid("search.$phpEx?search_author=" . $poster . "&amp;search_topic=" . $topic_id . "&amp;showresults=posts");
	$poster_url = append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$poster_id");

	if ($poster_id == -1)
	{
		$poster = $lang['Guest'];
	}

	$template->assign_block_vars('topicrow', array(
		'POSTER' => $poster,
		'FLAG' => $flag,
		'POSTS' => $posts,
		'POSTER_URL' => $poster_url,
		'POSTS_URL' => $posts_url)
	);

	$template->assign_vars(array( 
		'TOTAL_TOPICS' => $total_topics)
	);
}

$template->pparse('body'); 

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?> 