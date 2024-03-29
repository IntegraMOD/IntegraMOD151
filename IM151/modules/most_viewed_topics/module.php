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

//
// Most Viewed Topics
//
$core->start_module(true);

$core->set_content('statistical');

$core->set_view('rows', $core->return_limit);
$core->set_view('columns', 3);

$core->define_view('set_columns', array(
	$core->pre_defined('rank'),
	'views' => $lang['Views'],
	'topic' => $lang['Topic'])
);

$core->set_header($lang['module_name']);

$core->assign_defined_view('align_rows', array(
	'left',
	'center',
	'left')
);

$core->assign_defined_view('width_rows', array(
	'',
	'20%',
	'')
);

$sql = 'SELECT forum_id, topic_id, topic_title, topic_views 
FROM ' . TOPICS_TABLE .	' 
WHERE (topic_status <> 2) AND (topic_views > 0)
ORDER BY topic_views DESC 
LIMIT ' . $core->return_limit;

$result = $core->sql_query($sql, 'Couldn\'t retrieve topic data');
$topic_data = $core->sql_fetchrowset($result);

$core->set_data($topic_data);

$core->define_view('set_rows', array(
	'$core->pre_defined()',
	'$core->data(\'topic_views\')',
	'$core->generate_link(append_sid($phpbb_root_path . \'viewtopic.php?t=\' . $core->data(\'topic_id\')), $core->data(\'topic_title\'), \'target="_blank"\')'
	),
	array(
		'$core->data(\'forum_id\')', 'auth_view AND auth_read', 'forum', array(
			'',
			'$core->data(\'topic_views\')',
			'$lang[\'Hidden_from_public_view\']'
		)
	)
);

$core->run_module();

?>