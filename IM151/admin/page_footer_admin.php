<?php
/***************************************************************************
 *                           page_footer_admin.php
 *                            -------------------
 *   begin                : Saturday, Jul 14, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
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
	die("Hacking attempt");
}

global $do_gzip_compress;

//
// Show the overall footer.
//
$template->set_filenames(array(
	'page_footer' => 'admin/page_footer.tpl')
);

$template->assign_vars(array(
	'PHPBB_VERSION' => ($userdata['user_level'] == ADMIN && $userdata['user_id'] != ANONYMOUS) ? ' ' . '2' . $board_config['version'] : '',
	'INTEGRAMOD_VERSION' => ($userdata['user_level'] == ADMIN && $userdata['user_id'] != ANONYMOUS) ? ' ' . $board_config['integramod_version'] : '',
	'TRANSLATION_INFO' => (isset($lang['TRANSLATION_INFO'])) ? $lang['TRANSLATION_INFO'] : ((isset($lang['TRANSLATION'])) ? $lang['TRANSLATION'] : ''))
);

$template->pparse('page_footer');

//
// Clear the whole cache.
//
$db->clear_cache('');

//
// Close our DB connection.
//
$db->sql_close();

//
// Compress buffered output if required
// and send to browser
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
}
exit;

?>