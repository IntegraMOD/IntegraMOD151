<?php
/* Created by: Dave Lozier, dave@chattersonline.com for UBB.threads 6.x
*  Created for phpBB on: June 29, 2002.
*  Enjoy :)
*
* Built from the ground up for phpBB 2.0.x by A_Jelly_Doughnut [ support@jd1.clawz.com ]
* Modified on November 9, 2003 */

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

$userdata = session_pagestart($user_ip, PAGE_COOKIES, $board_config['session_length']);
init_userprefs($userdata);

include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_mycookies.' . $phpEx);

$cookiename = $board_config['cookie_name'];

//
//Delete teh cookies
//
if ($_GET['confirm'] == 1)
{
     setcookie($board_config['cookie_name'] . '_f_all', time(), - 3600, $board_config['cookie_path'], $board_config['cookie_domain'], $board_config['cookie_secure']);

     setcookie($board_config['cookie_name'] . '_t', serialize($tracking_topics), - 3600, $board_config['cookie_path'], $board_config['cookie_domain'], $board_config['cookie_secure']);

     setcookie($board_config['cookie_name'] . '_f', serialize($tracking_forums), - 3600, $board_config['cookie_path'], $board_config['cookie_domain'], $board_config['cookie_secure']);

     setcookie($cookiename . '_data', serialize($sessiondata), - 3600, $cookiepath, $cookiedomain, $cookiesecure);
	
     setcookie($cookiename . '_sid', $session_id, - 3600, $cookiepath, $cookiedomain, $cookiesecure);

header("location: portal.$phpEx");
}


else if(!isset($_GET['confirm']) || $_GET['confirm'] != 1)
{
	 $page_title = $lang['cookies_link'];
	 include($phpbb_root_path . 'includes/page_header.'.$phpEx);

	 $template->set_filenames(array(
	 'body' => 'cookies_body.tpl')
	 );

	 $cookies_found = (isset($_COOKIE[$cookiename . '_t']) || isset($_COOKIE[$cookiename . '_f_all']) || isset($_COOKIE[$cookiename .'_f']) || isset($_COOKIE[$cookiename .'_data']) || isset($_COOKIE[$cookiename .'_sid'])) ? TRUE : FALSE;

	 if($cookies_found == TRUE)
	 {
	 	$template->assign_block_vars('cookies_found', array());
	 }

	 $template->assign_vars(array(
	 'U_CONFIRM' => append_sid("mycookies.$phpEx?confirm=1"),
	 'L_COOKIES_EXPLAIN' => $lang['cookies_explain'],
	 'L_COOKIES' => $lang['cookies_link'],
	 'L_CURRENT_CONTENTS' => $lang['current_contents'],
	 'TOPIC_COOKIE' => print_r(unserialize(stripslashes($_COOKIE[$cookiename .'t'])), true),
	 'MARKED_COOKIE' => print_r(unserialize(stripslashes($_COOKIE[$cookiename .'_f_all'])), true),
	 'FORUM_COOKIE' => print_r(unserialize(stripslashes($_COOKIE[$cookiename .'_f'])), true),
	 'DATA_COOKIE' => print_r(unserialize(stripslashes($_COOKIE[$cookiename .'_data'])), true),
	 'SID_COOKIE' => print_r(unserialize(stripslashes($_COOKIE[$cookiename .'sid'])), true))
	 );

	 $template->pparse('body');

	 include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
}
?>
