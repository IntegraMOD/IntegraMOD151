<?php
/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

// true == use db cache
$core->start_module(true);

$core->set_content('bars');

$core->set_view('rows', $core->return_limit);
$core->set_view('columns', 5);

$core->define_view('set_columns', array(
	$core->pre_defined('rank'),
	'username' => $lang['Username'],
	'posts' => $lang['Topics'],
	$core->pre_defined('percent'),
	$core->pre_defined('graph'))
);

$content->percentage_sign = TRUE;

$core->set_header($lang['module_name']);

$core->assign_defined_view('align_rows', array(
	'left',
	'left',
	'center',
	'center',
	'left')
);

$sql = "SELECT COUNT(topic_id) as total_topics FROM " . TOPICS_TABLE . " WHERE topic_status <> " . TOPIC_MOVED;

$result = $core->sql_query($sql, 'Unable to retrieve total topics');
$row = $core->sql_fetchrow($result);

$total_topics = $row['total_topics'];

$sql = "SELECT u.user_id, u.username, COUNT(t.topic_poster) num_topics, u.user_group_id, u.user_session_time
FROM " . USERS_TABLE . " u, " . TOPICS_TABLE . " t 
WHERE (t.topic_poster <> " . ANONYMOUS . ") AND (u.user_posts > 0) AND (u.user_id = t.topic_poster)
GROUP BY t.topic_poster ORDER BY num_topics DESC 
LIMIT " . $core->return_limit;

$result = $core->sql_query($sql, 'Unable to retrieve user and topic data');
$data = $core->sql_fetchrowset($result);

$content->init_math('num_topics', $data[0]['num_topics'], $total_topics);
$core->set_data($data);

$core->make_global(array('$agcm_color'));
$core->define_view('set_rows', array(
	'$core->pre_defined()',
	'$core->generate_link(append_sid($phpbb_root_path . \'profile.php?mode=viewprofile&u=\' . $core->data(\'user_id\')),
			$agcm_color->get_user_color($core->data(\'user_group_id\'), $core->data(\'user_session_time\'), $core->data(\'username\')),
		\'target="_blank"\')',
	'$core->data(\'num_topics\')',
	'$core->pre_defined()',
	'$core->pre_defined()')
);

$core->run_module();

?>