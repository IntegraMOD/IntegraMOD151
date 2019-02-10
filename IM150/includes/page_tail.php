<?php
/***************************************************************************
 *                              page_tail.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: page_tail.php,v 1.27.2.2 2002/11/26 11:42:12 psotfx Exp $
 *
 *
 ***************************************************************************/

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
	die('Hacking attempt');
}

// Start add - Complete banner MOD
// V: only update it 1/3 times, and increment it by 3 instead
if ($banner_show_list && rand(1, 3) == 3)
{
	$sql = "UPDATE ".BANNERS_TABLE."
		SET banner_view=banner_view+3
	WHERE " . $db->sql_in_set('banner_id', $banner_show_list);
	$result = $db->sql_query($sql, false, false, "Couldn't update banners data", __LINE__, __FILE__);
	$db->sql_freeresult($result);
}

// End add - Complete banner MOD

global $do_gzip_compress;

//
// Show the overall footer.
//
include_once($phpbb_root_path . 'includes/functions_jr_admin.' . $phpEx);
$admin_link = jr_admin_make_admin_link();
$cookies_link = '<a href="' . $phpbb_root_path . 'mycookies.' . $phpEx . '" class="menubar">' . $lang['cookies_link'] . '</a>';

$template->set_filenames(array(
	'overall_footer' => ( empty($gen_simple_header) ) ? 'overall_footer.tpl' : 'simple_footer.tpl')
);

include_once($phpbb_root_path . 'ctracker/engines/ct_footer.' . $phpEx);
$output_login_status = ($userdata['ct_enable_ip_warn'])? $lang['ctracker_ma_on'] : $lang['ctracker_ma_off'];

//Begin Lo-Fi Mod
$path_parts = pathinfo($_SERVER['PHP_SELF']);
$lofi = '<a href="' . append_sid($path_parts['basename'] . '?' . $_SERVER['QUERY_STRING'] .'&lofi=' . (empty($_COOKIE['lofi']) ? '1' : '0'))  . '">' . (empty($_COOKIE['lofi']) ? ($lang['Lofi']) : ($lang['Full_Version']) ) . '</a><br />';
$template->assign_vars(array(
	'L_LOFI' => $lang['Lofi'],
	'LOFI' => $lofi,
	'L_FULL_VERSION' => $lang['Full_Version'])
);
//End Lo-Fi Mod

//
// IM Portal http://www.integramod.com
//

// debug forum wide Portal
/*if($layout_forum_wide_flag)
	$temp_debug = 1;
else
	$temp_debug = 0;
die('debug: ' . strval($temp_debug) . ' | ' . strval($portal_config['portal_tail']) . ' | ' . strval(defined('HAS_DIED')) . ' | ' . strval(defined('IN_LOGIN')));*/
// debug forum wide Portal

if(!$layout_forum_wide_flag&&!empty($portal_config)&&$portal_config['portal_tail']&&(!defined('HAS_DIED'))&&(!defined('IN_LOGIN')))
{
	$template->set_filenames(array(
		'portal_tail'         => 'portal_page_tail.tpl')
	);
	portal_parse_blocks($portal_config['default_portal'], TRUE, 'tail');
	$template->assign_vars(array('PORTAL_TAIL' => portal_assign_var_from_handle($template, 'portal_tail')));
}

include($phpbb_root_path . 'includes/pseudocron.'.$phpEx);

//
// Close our DB connection.
//
$db->sql_close();


/* Un-comment the line below to restrict Admins only to view page generation info */

//if( ($userdata['session_logged_in']) and ($userdata['user_level'] == ADMIN) )
//{
	$gzip_text = ($board_config['gzip_compress']) ? 'GZIP enabled' : 'GZIP disabled';

	$debug_text = (DEBUG == 1) ? 'Debug on' : 'Debug off';

	$excuted_queries = $db->num_queries;

	$mtime = microtime();
	$mtime = explode(" ",$mtime);
	$mtime = $mtime[1] + $mtime[0];
	$endtime = $mtime;

	$gentime = round(($endtime - $starttime), 4);

	$sql_time = round($db->sql_time, 4);

	$sql_part = round($sql_time / $gentime * 100);
	$php_part = 100 - $sql_part;

//}*/
if( defined('DEBUG') )
{
	$debug_out = '<div class="genbig" style="text-align: center;">[Page generation time: '. $gentime .'s (PHP: '. $php_part .'% | SQL: '. $sql_part .'%) | SQL queries: '. $excuted_queries .' | '. $gzip_text .' | '. $debug_text .']</div>';
}
else
{
	$debug_out = '<br />';
}

$template->assign_vars(array(
	'PHPBB_VERSION' => ($userdata['user_level'] == ADMIN && $userdata['user_id'] != ANONYMOUS) ? ' ' . '2' . $board_config['version'] : '',
	'INTEGRAMOD_VERSION' => ($userdata['user_level'] == ADMIN && $userdata['user_id'] != ANONYMOUS) ? ' ' . $board_config['integramod_version'] : '',
	'BLOCKED'	=> str_replace('%T%', '<b>'. number_format($board_config['phpBBSecurity_total_attempts']) .'</b>', $lang['PS_blocked_line']),
	'PROTECTED'	=> ($userdata['user_level'] == ADMIN && $userdata['user_id'] != ANONYMOUS) ? ' ' . $lang['PS_blocked_line2'].' :: ' : 'Protected by phpBB Security &copy; <a href="http://phpbb-amod.com" class="copyright" target="_blank">phpBB-Amod</a> ::',
	'TRANSLATION_INFO' => (isset($lang['TRANSLATION_INFO'])) ? $lang['TRANSLATION_INFO'] : ((isset($lang['TRANSLATION'])) ? $lang['TRANSLATION'] : ''),
	'COOKIES_LINK' => $cookies_link,
	'CRACKER_TRACKER_FOOTER' => !empty($ctracker_config) ? create_footer_layout($ctracker_config->settings['footer_layout']) : '',
	'L_STATUS_LOGIN' => (!empty($ctracker_config) && $ctracker_config->settings['login_ip_check'])? sprintf($lang['ctracker_ipwarn_info'], $output_login_status) : '',
	'ADMIN_LINK' => $admin_link,
	'COPYRIGHT' => "Powered by <a href=\"http://www.integramod.com\" target=\"_phpbb\">IntegraMOD</a> &copy; 2004, 2011 The Integramod Group",
	'STYLECWI2' => "Style <a href=\"http://www.integramod.com\" target=\"_phpbb\">Integra2 </a> &copy; IntegraMod Team 2011<br />",
	'STYLECWSI' => "Style <a href=\"http://www.forumimages.us\" target=\"_phpbb\">FI Theme </a><br />",
	'STYLECWIM' => "<a href=\"http://www.integramod.com\" target=\"_phpbb\">Style</a> &copy; IntegraMod Team 2011<br />",
	'STYLECWID' => "<a href=\"http://www.phpbbireland.com\" target=\"_phpbb\">Style</a> &copy; 2005 - 2010 phpbbireland<br />",
	)
);

$template->pparse('overall_footer');

echo $debug_out;

if (defined('DEV_MODE') && DEV_MODE && $db && $db->queries)
{
	foreach ($db->queries as $query)
	{
		list($sql, $bt, $time) = $query;
		echo "Query: $time <pre style='max-width: 300px;'>$sql

" . str_replace($sql, '*QUERY*', strip_tags($bt)) . "</pre>";
/*implode("\n", array_slice(explode("\n", $bt), 0, 10))*/
	}
}

//
// Compress buffered output if required and send to browser
//
if( $do_gzip_compress && headers_sent() != TRUE )
{
	$gzip_contents = ob_get_contents();
	ob_end_clean();
	$gzip_size = strlen($gzip_contents);
	$gzip_crc = crc32($gzip_contents);
	$gzip_contents = gzcompress($gzip_contents, 9);
	$gzip_contents = substr($gzip_contents, 0, strlen($gzip_contents) - 4);
	$gzip_contents .= pack("V",$gzip_crc) . pack("V", $gzip_size);
	header("Content-Encoding: gzip");
	header("Vary: Accept-Encoding");
	header("Content-Length: ".strlen($gzip_contents));
	header('X-Content-Encoded-By: Integramod '.$board_config['integramod_version']);
	echo "\x1f\x8b\x08\x00\x00\x00\x00\x00";
	echo $gzip_contents;
}else echo ob_get_clean();