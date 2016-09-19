<?php 
/*************************************************************************** 
 *                               export.php 
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

// 
// Start initial var setup 
// 
if ( isset($_GET[POST_TOPIC_URL]) ) 
{ 
   $topic_id = intval($_GET[POST_TOPIC_URL]); 
} 
else if ( isset($_GET['topic']) ) 
{ 
   $topic_id = intval($_GET['topic']); 
} 

if ( isset($_GET[POST_POST_URL])) 
{ 
   $post_id = intval($_GET[POST_POST_URL]); 
} 

$start = ( isset($_GET['start']) ) ? intval($_GET['start']) : 0; 

if ( !isset($topic_id) && !isset($post_id) ) 
{ 
   message_die(GENERAL_MESSAGE, 'Topic_post_not_exist'); 
} 

// 
// This rather complex gaggle of code handles querying for topics but 
// also allows for direct linking to a post (and the calculation of which 
// page the post is on and the correct display of viewtopic) 
// 
$join_sql_table = ( !isset($post_id) ) ? '' : ", " . POSTS_TABLE . " p, " . POSTS_TABLE . " p2 "; 
$join_sql = ( !isset($post_id) ) ? "t.topic_id = $topic_id" : "p.post_id = $post_id AND t.topic_id = p.topic_id AND p2.topic_id = p.topic_id AND p2.post_id <= $post_id"; 
$count_sql = ( !isset($post_id) ) ? '' : ", COUNT(p2.post_id) AS prev_posts"; 

$order_sql = ( !isset($post_id) ) ? '' : "GROUP BY p.post_id, t.topic_id, t.topic_title, t.topic_status, t.topic_replies, t.topic_time, t.topic_type, t.topic_vote, f.forum_name, f.forum_status, f.forum_id, f.auth_view, f.auth_read, f.auth_post, f.auth_reply, f.auth_edit, f.auth_delete, f.auth_sticky, f.auth_announce, f.auth_pollcreate, f.auth_vote, f.auth_attachments ORDER BY p.post_id ASC"; 

$sql = "SELECT t.topic_id, t.topic_title, t.topic_status, t.topic_replies, t.topic_time, t.topic_type, t.topic_vote, f.forum_name, f.forum_status, f.forum_id, f.auth_view, f.auth_read, f.auth_post, f.auth_reply, f.auth_edit, f.auth_delete, f.auth_sticky, f.auth_announce, f.auth_pollcreate, f.auth_vote, f.auth_attachments" . $count_sql . " 
   FROM " . TOPICS_TABLE . " t, " . FORUMS_TABLE . " f" . $join_sql_table . " 
   WHERE $join_sql 
      AND f.forum_id = t.forum_id 
      $order_sql"; 
if ( !($result = $db->sql_query($sql)) ) 
{ 
   message_die(GENERAL_ERROR, "Could not obtain topic information", '', __LINE__, __FILE__, $sql); 
} 

if ( !($forum_row = $db->sql_fetchrow($result)) ) 
{ 
   message_die(GENERAL_MESSAGE, 'Topic_post_not_exist'); 
} 

$forum_id = $forum_row['forum_id']; 

// 
// Start auth check 
// 
$is_auth = array(); 
$is_auth = auth(AUTH_ALL, $forum_id, $userdata, $forum_row); 

if( !$is_auth['auth_view'] || !$is_auth['auth_read'] ) 
{ 
   if ( !$userdata['session_logged_in'] ) 
   { 
      $redirect = ( isset($post_id) ) ? POST_POST_URL . "=$post_id" : POST_TOPIC_URL . "=$topic_id"; 
      $redirect .= ( isset($start) ) ? "&start=$start" : ''; 
      $header_location = ( @preg_match("/Microsoft|WebSTAR|Xitami/", getenv("SERVER_SOFTWARE")) ) ? "Refresh: 0; URL=" : "Location: "; 
      header($header_location . append_sid("login.$phpEx?redirect=viewtopic.$phpEx&$redirect", true)); 
   } 

   $message = ( !$is_auth['auth_view'] ) ? $lang['Topic_post_not_exist'] : sprintf($lang['Sorry_auth_read'], $is_auth['auth_read_type']); 

   message_die(GENERAL_MESSAGE, $message); 
} 
// 
// End auth check 
// 

$forum_name = $forum_row['forum_name']; 
$topic_title = $forum_row['topic_title']; 
$topic_id = $forum_row['topic_id']; 
$topic_time = $forum_row['topic_time']; 

if ( !empty($post_id) ) 
{ 
   $start = floor(($forum_row['prev_posts'] - 1) / $board_config['posts_per_page']) * $board_config['posts_per_page']; 
} 

// Decide how to order the post display 
// 
if ( !empty($_POST['postorder']) || !empty($_GET['postorder']) ) 
{ 
   $post_order = (!empty($_POST['postorder'])) ? $_POST['postorder'] : $_GET['postorder']; 
   $post_time_order = ($post_order == "asc") ? "ASC" : "DESC"; 
} 
else 

{ 
   $post_order = 'asc'; 
   $post_time_order = 'ASC'; 
} 

$select_post_order = '<select name="postorder">'; 
if ( $post_time_order == 'ASC' ) 
{ 
   $select_post_order .= '<option value="asc" selected="selected">' . $lang['Oldest_First'] . '</option><option value="desc">' . $lang['Newest_First'] . '</option>'; 
} 
else 
{ 
   $select_post_order .= '<option value="asc">' . $lang['Oldest_First'] . '</option><option value="desc" selected="selected">' . $lang['Newest_First'] . '</option>'; 
} 
$select_post_order .= '</select>'; 


// 
// Hlavicka 
// 

$soubor = "Forum:\t$forum_name\r\n"; 
$soubor .= "Topic:\t$topic_title\r\n"; 
for ($c=0; $c < strlen ($topic_title);$c++) $soubor .= "-"; 
$soubor .= "--------\r\n"; 
    
// 
// END 
// 

// 
// Go ahead and pull all data for this topic 
// 
$sql = "SELECT u.username, u.user_id, u.user_posts, u.user_from, u.user_website, u.user_email, u.user_icq, u.user_aim, u.user_yim, u.user_regdate, u.user_msnm, u.user_viewemail, u.user_rank, u.user_sig, u.user_sig_bbcode_uid, u.user_avatar, u.user_avatar_type, u.user_allowavatar, u.user_allowsmile, p.*,  pt.post_text, pt.post_subject, pt.bbcode_uid 
   FROM " . POSTS_TABLE . " p, " . USERS_TABLE . " u, " . POSTS_TEXT_TABLE . " pt 
   WHERE p.topic_id = $topic_id 
      $limit_posts_time 
      AND pt.post_id = p.post_id 
      AND u.user_id = p.poster_id 
   ORDER BY p.post_time $post_time_order"; 
if ( !($result = $db->sql_query($sql)) ) 
{ 
   message_die(GENERAL_ERROR, "Could not obtain post/user information.", '', __LINE__, __FILE__, $sql); 
} 

if ( $row = $db->sql_fetchrow($result) ) 
{ 
   $postrow = array(); 
   do 
   { 
      $postrow[] = $row; 
   } 
   while ( $row = $db->sql_fetchrow($result) ); 
   $db->sql_freeresult($result); 

   $total_posts = count($postrow); 
} 
else 
{ 
   message_die(GENERAL_MESSAGE, $lang['No_posts_topic']); 
} 

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

for($i = 0; $i < $total_posts; $i++) { 
   $poster_id = $postrow[$i]['user_id']; 
    
   $poster = ( $poster_id == ANONYMOUS ) ? $lang['Guest'] : $postrow[$i]['username']; 

   $post_date = create_date($board_config['default_dateformat'], $postrow[$i]['post_time'], $board_config['board_timezone']); 

   $poster_posts = ( $postrow[$i]['user_id'] != ANONYMOUS ) ? $lang['Posts'] . ': ' . $postrow[$i]['user_posts'] : ''; 

   $poster_from = ( $postrow[$i]['user_from'] && $postrow[$i]['user_id'] != ANONYMOUS ) ? $lang['Location'] . ': ' . $postrow[$i]['user_from'] : ''; 

   $poster_joined = ( $postrow[$i]['user_id'] != ANONYMOUS ) ? $lang['Joined'] . ': ' . create_date($lang['DATE_FORMAT'], $postrow[$i]['user_regdate'], $board_config['board_timezone']) : ''; 
    
   // 
   // Handle anon users posting with usernames 
   // 
   if ( $poster_id == ANONYMOUS && $postrow[$i]['post_username'] != '' ) 
   { 
      $poster = $postrow[$i]['post_username']; 
      $poster_rank = $lang['Guest']; 
   } 

   $temp_url = ''; 

   $post_subject = ( $postrow[$i]['post_subject'] != '' ) ? $postrow[$i]['post_subject'] : ''; 

   $message = $postrow[$i]['post_text']; 
   $bbcode_uid = $postrow[$i]['bbcode_uid']; 

   $user_sig = ( $postrow[$i]['enable_sig'] && $postrow[$i]['user_sig'] != '' && $board_config['allow_sig'] ) ? $postrow[$i]['user_sig'] : ''; 
   $user_sig_bbcode_uid = $postrow[$i]['user_sig_bbcode_uid']; 
    
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

   if ( $user_sig != '' && $board_config['allow_sig'] ) 
   { 
      $user_sig = make_clickable($user_sig); 
   } 
   $message = make_clickable($message); 

   $message = strip_tags($message); 
   $message = str_replace("  ", "", $message); 
   $message = str_replace("\t", "", $message); 
   $message = str_replace("\r\n\r\n", "\r\n", $message); 
   $message = str_replace("\r\r \r", "", $message); 
   $message = str_replace("\r\r", "", $message); 
   $soubor .= "\r\n$poster:\r\n"; 
   $soubor .= "$message\r\n"; 
} 

$attachment = (strstr($HTTP_USER_AGENT, "MSIE")) ? "" : " attachment"; // IE 5.5 fix. 
$file_name = $board_config['sitename']."_Topic_" . $topic_id . "_".date("Ymd",time()).".txt";
   header("Cache-control: private"); // another fix for IE 
   header("Content-Type: application/octet-stream"); 
   header("Content-Length: ".strlen($soubor)); 
   header("Content-Disposition: attachment; filename=" . $file_name); 
echo $soubor;
?>