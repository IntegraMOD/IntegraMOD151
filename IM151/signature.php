<?php 

define('IN_PHPBB', true); 
$phpbb_root_path = './'; 
include($phpbb_root_path . 'extension.inc'); 
include($phpbb_root_path . 'common.'.$phpEx); 

$user_forum_sql = ( !empty($forum_id) ) ? "AND s.session_page = " . intval($forum_id) : '';
$sql = "SELECT u.username, u.user_id, s.session_logged_in, s.session_ip
	FROM ".USERS_TABLE." u, ".SESSIONS_TABLE." s
	WHERE u.user_id = s.session_user_id
		AND s.session_time >= ".( time() - 300 ) . "
		$user_forum_sql
	ORDER BY u.username ASC, s.session_ip ASC";
if( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not obtain user/online information', '', __LINE__, __FILE__, $sql);
}

$logged_online = 0;

$prev_user_id = 0;

while( $row = $db->sql_fetchrow($result) )
{
	// User is logged in and therefor not a guest
	if ( $row['session_logged_in'] )
	{
		// Skip multiple sessions for one user
		if ( $row['user_id'] != $prev_user_id )
		{
				$logged_online++;
		}

		$prev_user_id = $row['user_id'];
	}
}

$sql = "SELECT t.topic_title	FROM ".TOPICS_TABLE." AS t LEFT OUTER JOIN " . APPROVE_POSTS_TABLE . " AS a ON (t.topic_first_post_id = a.post_id)	WHERE forum_id = 3 AND topic_type=1 AND a.post_id is NULL ORDER BY topic_time DESC LIMIT 1";
if( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not obtain user/online information', '', __LINE__, __FILE__, $sql);
}

$row = $db->sql_fetchrow($result);
$latest_news = $row['topic_title'];
if (strlen($latest_news)>27)
$latest_news = substr($latest_news,0,27) . "...";

$sql = "SELECT t.topic_title FROM ".TOPICS_TABLE." AS t LEFT OUTER JOIN " . APPROVE_POSTS_TABLE . " AS a ON (t.topic_first_post_id = a.post_id),". POSTS_TABLE ." AS p WHERE t.topic_id = p.topic_id AND a.post_id is NULL ORDER BY p.post_time DESC LIMIT 1"; 
if( !($result = $db->sql_query($sql)) ) 
{ 
   message_die(GENERAL_ERROR, 'Could not obtain post information', '', __LINE__, __FILE__, $sql); 
} 

$row = $db->sql_fetchrow($result); 
$latest_post = $row['topic_title']; 
if (strlen($latest_post)>29)
$latest_post = substr($latest_post,0,29) . "...";

$ima = strval(mt_rand(1,5));

switch($ima)
{
	case '1':
		$image = "images/signature.png"; 
		break;
	case '2':
		$image = "images/signature2.png"; 
		break;
	case '3':
		$image = "images/signature3.png"; 
		break;
	case '4':
		$image = "images/signature4.png"; 
		break;
	case '5':
		$image = "images/signature1.png"; 
		break;
	default:
		$image = "images/signature.png"; 
} 

$total_users = get_db_stat('usercount'); 
$total_posts = get_db_stat('postcount'); 
$total_topics = get_db_stat('topiccount'); 
$j = strlen($total_users);
$leerzeichen = $j*6+229;
$im = imagecreatefrompng($image);
$tc  = ImageColorAllocate ($im, 0, 0, 0);
$red  = ImageColorAllocate ($im, 255, 0, 0);
$blue  = ImageColorAllocate ($im, 0, 0, 255);
$white = ImageColorAllocate ($im, 255, 255, 255);
ImageString($im, 3, 139, 8, "Latest Release:", $tc);
ImageString($im, 3, 137, 8, "Latest Release:", $tc);
ImageString($im, 3, 139, 6, "Latest Release:", $tc);
ImageString($im, 3, 137, 6, "Latest Release:", $tc);
ImageString($im, 3, 138, 7, "Latest Release:", $white);
ImageString($im, 3, 244, 6, "$latest_news", $white);
ImageString($im, 3, 244, 8, "$latest_news", $white);
ImageString($im, 3, 246, 6, "$latest_news", $white);
ImageString($im, 3, 246, 7, "$latest_news", $white);
ImageString($im, 3, 245, 7, "$latest_news", $blue);
ImageString($im, 3, 139, 18, "Members: $total_users - ", $tc);
ImageString($im, 3, 139, 20, "Members: $total_users - ", $tc);
ImageString($im, 3, 137, 18, "Members: $total_users - ", $tc);
ImageString($im, 3, 137, 20, "Members: $total_users - ", $tc);
ImageString($im, 3, 138, 19, "Members: $total_users - ", $white);
ImageString($im, 3, $leerzeichen-1, 20, "Online: $logged_online", $white);
ImageString($im, 3, $leerzeichen-1, 18, "Online: $logged_online", $white);
ImageString($im, 3, $leerzeichen+1, 20, "Online: $logged_online", $white);
ImageString($im, 3, $leerzeichen+1, 18, "Online: $logged_online", $white);
ImageString($im, 3, $leerzeichen, 19, "Online: $logged_online", $red);
ImageString($im, 3, 137, 32, "Total Posts: $total_posts Posts in $total_topics Topics", $tc);
ImageString($im, 3, 137, 30, "Total Posts: $total_posts Posts in $total_topics Topics", $tc);
ImageString($im, 3, 139, 30, "Total Posts: $total_posts Posts in $total_topics Topics", $tc);
ImageString($im, 3, 139, 32, "Total Posts: $total_posts Posts in $total_topics Topics", $tc);
ImageString($im, 3, 138, 31, "Total Posts: $total_posts Posts in $total_topics Topics", $white);
ImageString($im, 3, 137, 44, "Newest Post:", $tc);
ImageString($im, 3, 139, 44, "Newest Post:", $tc);
ImageString($im, 3, 139, 42, "Newest Post:", $tc);
ImageString($im, 3, 137, 42, "Newest Post:", $tc);
ImageString($im, 3, 138, 43, "Newest Post:", $white);
ImageString($im, 3, 227, 42, "$latest_post", $white);
ImageString($im, 3, 229, 42, "$latest_post", $white);
ImageString($im, 3, 229, 44, "$latest_post", $white);
ImageString($im, 3, 227, 44, "$latest_post", $white);
ImageString($im, 3, 228, 43, "$latest_post", $tc);
header("Content-Type: image/png"); 
Imagepng($im,'',100); 
ImageDestroy ($im); 
?>