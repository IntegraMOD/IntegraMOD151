<?php
/***************************************************************************
*							links.js.php
*                            -------------------
*  MOD add-on page. Contains GPL code copyright of phpBB group.
*  Author: OOHOO < webdev@phpbb-tw.net >
*  Author: Stefan2k1 and ddonker from www.portedmods.com
*  Demo: http://phpbb-tw.net/
*  Version: 1.0.X - 2002/03/22 - for phpBB RC serial, and was named Related_Links_MOD
*  Version: 1.1.0 - 2002/04/25 - Re-packed for phpBB 2.0.0, and renamed to Links_MOD
*  Version: 1.2.0 - 2003/06/15 - Enhanced and Re-packed for phpBB 2.0.4
*  Version: 1.2.1 - 2003/10/15 - Enhanced by CRLin
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

$phpbb_root_path = "./";
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . "common.$phpEx");

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);
//
// End session management
//

//
// gzip_compression
//
$do_gzip_compress = FALSE;
if($board_config['gzip_compress'] && extension_loaded("zlib"))
{
	ob_start("ob_gzhandler");
}

header ("Cache-Control: no-store, no-cache, must-revalidate");
header ("Cache-Control: pre-check=0, post-check=0, max-age=0", false);
header ("Pragma: no-cache");
header ("Expires: " . gmdate("D, d M Y H:i:s", time()) . " GMT");
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");

$template->set_filenames(array(
	'body' => "links_js_body.tpl"
));

//
// Grab data
//
$sql = "SELECT *
		FROM ". LINK_CONFIG_TABLE;
	if(!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, "Could not query Link config information", "", __LINE__, __FILE__, $sql);
	}
	
	while( $row = $db->sql_fetchrow($result) )
	{
		$link_config_name = $row['config_name'];
		$link_config_value = $row['config_value'];
		$link_config[$link_config_name] = $link_config_value;
		$link_self_img = $link_config['site_logo'];
		$site_logo_height = $link_config['height'];
		$site_logo_width = $link_config['width'];
		$display_interval = $link_config['display_interval'];
		$display_logo_num = $link_config['display_logo_num'];
	}

$sql = "SELECT link_id, link_title, link_logo_src
	FROM " . LINKS_TABLE . "
	WHERE link_active = 1
	ORDER BY link_hits DESC";

// If failed just ignore
if( $result = $db->sql_query($sql) )
{
	$links_logo = "";
	while($row = $db->sql_fetchrow($result))
	{
		//if (empty($row['link_logo_src'])) $row['link_logo_src'] = 'images/links/no_logo88a.gif';
		if ($row['link_logo_src']) {
			$links_logo .= ('\'<a href="' . append_sid("links.$phpEx?action=go&link_id=" . $row['link_id']) . '" target="_blank"><img src="' . $row['link_logo_src'] . '" alt="' . $row['link_title'] . '" width="' . $site_logo_width . '" height="' . $site_logo_height . '" border="0" hspace="1" /></a>\',' . "\n");
		}
	}

	if ($links_logo) {
		$links_logo = substr($links_logo, 0, -2);

		$template->assign_vars(array(
			'S_CONTENT_ENCODING' => $lang['ENCODING'],
			'T_BODY_BGCOLOR' => '#'.$theme['td_color1'],

			'DISPLAY_INTERVAL' => $display_interval,
			'DISPLAY_LOGO_NUM' => $display_logo_num,
			'LINKS_LOGO' => $links_logo
		));
	}
}

$template->pparse("body");

$db->sql_close();
//
// Compress buffered output if required
// and send to browser
//
if($do_gzip_compress)
{
	//
	// Borrowed from php.net!
	//
	$gzip_contents = ob_get_contents();
	ob_end_clean();

	$gzip_size = strlen($gzip_contents);
	$gzip_crc = crc32($gzip_contents);

	$gzip_contents = gzcompress($gzip_contents, 9);
	$gzip_contents = substr($gzip_contents, 0, strlen($gzip_contents) - 4);

	echo "\x1f\x8b\x08\x00\x00\x00\x00\x00";
	echo $gzip_contents;
	echo pack("V", $gzip_crc);
	echo pack("V", $gzip_size);
}

exit;
?>