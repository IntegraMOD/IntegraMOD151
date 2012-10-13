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
// New Users by Month
//
$core->start_module(true);

$core->set_content('values');

$sql = "SELECT YEAR(FROM_UNIXTIME(user_regdate)) as year_regdate, MONTH(FROM_UNIXTIME(user_regdate)) as month_regdate, COUNT(*) AS num_user 
FROM " . USERS_TABLE . " 
WHERE (user_id <> " . ANONYMOUS . " )
GROUP BY YEAR(FROM_UNIXTIME(user_regdate)), MONTH(FROM_UNIXTIME(user_regdate)) 
ORDER BY user_regdate";

$result = $core->sql_query($sql, 'Couldn\'t retrieve users data');

$user_count = $core->sql_numrows($result);
$user_data = $core->sql_fetchrowset($result);

$month_array = array();

for ($i = 0; $i < $user_count; $i++)
{
	$month_array[$user_data[$i]['year_regdate']][($user_data[$i]['month_regdate']-1)]['num_user'] = $user_data[$i]['num_user'];
}

@reset($month_array);

while (list($year, $data) = each($month_array))
{
	for ($i = 0; $i < 12; $i++)
	{
		if (!isset($month_array[$year][$i]))
		{
			$month_array[$year][$i]['num_user'] = 0;
		}
	}
}
@reset($month_array);

$year_ar = array();
$month_1 = array();
$month_2 = array();
$month_3 = array();
$month_4 = array();
$month_5 = array();
$month_6 = array();
$month_7 = array();
$month_8 = array();
$month_9 = array();
$month_10 = array();
$month_11 = array();
$month_12 = array();

while (list($year, $data) = each($month_array))
{
	$year_ar[] = $year;
	for ($i = 0; $i < 12; $i++)
	{
		eval("\$month_" . ($i+1) . "[] = \$month_array[\$year][\$i]['num_user'];");
	}
}

$core->set_view('columns', 13);
$core->set_view('num_blocks', 1);
$core->set_view('value_order', 'left_right');

$core->define_view('set_columns', array(
	'year' => $lang['Year'],
	'1' => $lang['Month_jan'],
	'2' => $lang['Month_feb'],
	'3' => $lang['Month_mar'],
	'4' => $lang['Month_apr'],
	'5' => $lang['Month_may'],
	'6' => $lang['Month_jun'],
	'7' => $lang['Month_jul'],
	'8' => $lang['Month_aug'],
	'9' => $lang['Month_sep'],
	'10' => $lang['Month_oct'],
	'11' => $lang['Month_nov'],
	'12' => $lang['Month_dec'])
);

$core->set_header($lang['module_name']);

$data = $core->assign_defined_view('value_array', array(
	$year_ar, 
	$month_1,
	$month_2,
	$month_3,
	$month_4,
	$month_5,
	$month_6,
	$month_7,
	$month_8,
	$month_9,
	$month_10,
	$month_11,
	$month_12)
);

$core->set_data($data);

$core->define_view('iterate_values', array());

$core->run_module();

?>