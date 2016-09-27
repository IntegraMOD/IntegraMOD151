<?php
/***************************************************************************
 *                               ip_search.php
 *                            -------------------
 *   begin                : Monday, Aug 25, 2003
 *   version              : 1.2.0
 *   date                 : 2003/09/17 23:47
 ***************************************************************************/
// Most of this is copied from modcp.php and tweaked to work from a form.

define('IN_PHPBB', 1);

if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['Users']['IP_Search'] = $filename;
	return;
}

$phpbb_root_path = './../';
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_ipsearch.' . $phpEx);

$submit = ( isset($_POST['submit']) || isset($_GET['submit']) ) ? TRUE : FALSE;

if( $submit )
{
	$search_ip = ( isset($_POST['ip']) ) ? $_POST['ip'] : (( isset($_GET['ip']) ) ? $_GET['ip'] : '' );

	if ( !$search_ip )
	{
		message_die(GENERAL_MESSAGE, $lang['IPSearch_Enter_an_IP']);
	}

	//
	// Set template files
	//
	$template->set_filenames(array(
		'viewip' => 'admin/ipsearch_results_body.tpl')
	);

	$strip_num = 0;
	if( preg_match('/(\.)?(\*)$/', $search_ip) )
	{
		$ip_sep = explode('.', $search_ip);
		foreach($ip_sep as $val)
		{
			if( $val == 0 )
			{
				$strip_num += 2;
			}
		}
		if( count($ip_sep) < 4 )
		{
			$strip_num += 2 * (4 - count($ip_sep));
		}
	}

	if( preg_match('/(([0-9]{1,3})(\.)?){1,4}/', $search_ip) )
	{
		$host = @gethostbyaddr($search_ip);
	}
	else
	{
		$host = $search_ip;
		$search_ip = @gethostbyname($host);
	}
	$encoded_ip = encode_ip($search_ip);
	if( $strip_num )
	{
		$encoded_ip = substr($encoded_ip, 0, strlen($encoded_ip) - $strip_num);
		$ip_sql = "LIKE '" . $encoded_ip . "%'";
	}
	else
	{
		$ip_sql = "= '" . $encoded_ip . "'";
	}

	$template->assign_vars(array(
		'L_IP_SEARCH_RESULTS' => $lang['IPSearch_Search_Results'],
		'L_OTHER_USERS' => $lang['Users_this_IP'],
		'L_SEARCH' => $lang['Search'],
		'L_AGAIN' => $lang['IPSearch_Again'],

		'SEARCH_IMG' => $phpbb_root_path . $images['icon_search'], 

		'IP' => $search_ip, 
		'HOST' => $host,

		'U_IP_SEARCH' => append_sid('admin_ip_search.' . $phpEx)
	));


	// Get users who've posted under this IP
	$sql = 'SELECT u.user_id, u.username, COUNT(*) as postings 
		FROM ' . USERS_TABLE . ' u, ' . POSTS_TABLE . ' p 
		WHERE p.poster_id = u.user_id 
			AND p.poster_ip ' . $ip_sql . '
		GROUP BY u.user_id, u.username
		ORDER BY ' . (( SQL_LAYER == 'msaccess' ) ? 'COUNT(*)' : 'postings' ) . ' DESC';
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not get posters information based on IP', '', __LINE__, __FILE__, $sql);
	}

	if ( $row = $db->sql_fetchrow($result) )
	{
		$i = 0;
		do
		{
			$id = $row['user_id'];
			$username = ( $id == ANONYMOUS ) ? $lang['Guest'] : $row['username'];
			$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
			$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

			$template->assign_block_vars('userrow', array(
				'ROW_COLOR' => '#' . $row_color, 
				'ROW_CLASS' => $row_class, 
				'USERNAME' => $username,
				'POSTS' => $row['postings'] . ' ' . ( ( $row['postings'] == 1 ) ? $lang['Post'] : $lang['Posts'] ),
				'L_SEARCH_POSTS' => sprintf($lang['Search_user_posts'], $username), 

				'U_PROFILE' => ($id == ANONYMOUS) ? $phpbb_root_path . 'modcp.' . $phpEx . '?mode=ip&amp;' . POST_POST_URL . '=' . $post_id . '&amp;' . POST_TOPIC_URL . '=' . $topic_id . '&amp;sid=' . $userdata['session_id'] : append_sid($phpbb_root_path . 'profile.' . $phpEx . '?mode=viewprofile&amp;' . POST_USERS_URL . '=' . $id),
				'U_SEARCHPOSTS' => append_sid($phpbb_root_path . 'search.' . $phpEx . '?search_author=' . urlencode($username) . '&amp;showresults=topics'))
				);

				$i++; 
		}
		while ( $row = $db->sql_fetchrow($result) );
	}

	$template->pparse('viewip');
}
else
{
	$template->set_filenames(array(
		'search' => 'admin/ipsearch_search_body.tpl')
	);
	$template->assign_vars(array(
		'L_IP_SEARCH' => $lang['IPSearch_Search_by_IP'],
		'L_IP_ADDRESS' => $lang['IPSearch_Enter_IP'],
		'L_SUBMIT' => $lang['Submit'],

		'U_IP_SEARCH' => append_sid('admin_ip_search.' . $phpEx)
	));
		$template->pparse('search');
}

include('./page_footer_admin.'.$phpEx);

?>