<?php
/***************************************************************************
 *                             prill_footer.php
 *                            -------------------
 *   begin                : Monday, Dec 08, 2003
 *   version              : 1.0.0
 *   date                 : 2003/12/08
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
}

// Close the database connection.
$db->sql_close();

if( $full_footer )
{
	// Add page footer.
	$template->set_filenames(array(
		'footer' => 'prillian/prill_footer.tpl')
	);

	$template->assign_vars(array(
		'PHPBB_VERSION' => '2' . $board_config['version'],
		'TRANSLATION_INFO' => ( isset($lang['TRANSLATION_INFO']) ) ? $lang['TRANSLATION_INFO'] : ''
	));
	$template->pparse('footer');
}

//
// Compress buffered output if required and send to browser
//
if ( $do_gzip_compress )
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
	echo pack('V', $gzip_crc);
	echo pack('V', $gzip_size);
}

exit;

?>