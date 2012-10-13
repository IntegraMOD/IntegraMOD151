<?php
/***************************************************************************
 *                             easymod_install.php
 *                            -------------------
 *   begin                : Wednesday, March 15, 2002
 *   copyright            : (C) 2002-2004 by Nuttzy - Craig Nuttall, 2005 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: easymod_install.php 131 2008-02-23 01:16:49Z terrafrost $
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

define('IN_PHPBB', 1);
define('CT_SECLEVEL', 'LOW');
$ct_ignorepvar = array('command_step5');
$phpbb_root_path = '../../../';

// Checking phpBB files here allow us to halt installation and warn them with an explanation if the have not upload EM to the correct place ;-)
if( !@file_exists($phpbb_root_path . 'extension.inc') )
{
	// display error message (obviously we can't use the lang system from this ;-)
	echo "<b>CRITICAL ERROR:</b> the file 'extension.inc' could not be found. Please, make sure EasyMOD has been uploaded under the admin/mods/easymod/ directory of your phpBB installation.\n";
	exit;
}
// Note using require rather than include makes sense, since we can't really proceed if the files are not available.
require($phpbb_root_path . 'extension.inc');
require($phpbb_root_path . 'common.'.$phpEx);
require($phpbb_root_path . 'includes/functions_admin.'.$phpEx);

//
// Session Management.
//
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);

//
// Only administrators here, please
//
if( !$userdata['session_logged_in'] )
{
	redirect(append_sid("login.$phpEx?redirect=admin/mods/easymod/easymod_install.$phpEx", true));
}
if( $userdata['user_level'] != ADMIN )
{
	message_die(GENERAL_MESSAGE, $lang['Not_admin']);
}

////
$easymod_install_version = '0.4.0';
$script_path = 'admin/mods/easymod/';
////

// Enable debug helpers?
define('EM_DEBUG_AID', 1);

if( !@file_exists($phpbb_root_path . $script_path . 'em_includes/em_ftp.'.$phpEx) )
{
	// display error message (obviously we can't use the lang system from this ;-)
	echo "<b>CRITICAL ERROR:</b> the file 'admin/mods/easymod/em_includes/em_ftp.$phpEx' could not be found. Please, make sure EasyMOD has been uploaded under the admin/mods/easymod/ directory of your phpBB installation.\n";
	exit;
}
require($phpbb_root_path . $script_path . 'em_includes/em_ftp.'.$phpEx);
require($phpbb_root_path . $script_path . 'em_includes/em_modio.'.$phpEx);
require($phpbb_root_path . $script_path . 'em_includes/em_functions.'.$phpEx);
require($phpbb_root_path . $script_path . 'easymod_display_functions.'.$phpEx);


//
// set teh language (typo intentional ;-) )
//
$EM_lang = _em_get_install_languages();

if( !empty($HTTP_GET_VARS['language']) || !empty($HTTP_POST_VARS['language']) )
{
	$language = (!empty($HTTP_POST_VARS['language'])) ? stripslashes($HTTP_POST_VARS['language']) : stripslashes($HTTP_GET_VARS['language']);
}
elseif( !empty($HTTP_COOKIE_VARS['em_lang']) )
{
	$language = stripslashes($HTTP_COOKIE_VARS['em_lang']);
}
else
{
	$language = $board_config['default_lang'];
}
$language = (in_array($language, $EM_lang)) ? $language : 'english';

// remember the lang in case we hit an error that send us back to step 1
$hidden = _em_hidden_field('language', $language);

// load the appropriate lang pack
if( !@file_exists($phpbb_root_path . $script_path . 'languages/lang_easymod_'.$language.'.'.$phpEx) )
{
	// display error message (obviously we can't use the lang system from this ;-)
	echo "<b>CRITICAL ERROR:</b> the lang_easymod_$language.$phpEx file could not be found in the easymod/languages directory.  EasyMOD cannot be installed without this file present.\n";
	exit;
}

include($phpbb_root_path . $script_path . 'languages/lang_easymod_'.$language.'.'.$phpEx);
setcookie('em_lang', $language, time() + 360);


// ---------
// FUNCTIONS
//

function wrapper_find(&$file_list, &$find_array, $search_array)
{
	global $lang;

	echo '<b>' . $lang['EM_finding'] . ':</b> ';
	for ( $i=0; $i<count($search_array); $i++)
	{
		echo htmlspecialchars($search_array[$i]) . "<br />";
	}

	$result = perform_find($file_list, $find_array, $search_array);
	handle_error($result, $file_list, true);
}


function wrapper_insert(&$file_list, &$find_array, $insert, $before)
{
	global $lang;

	echo '<b>' . $lang['EM_insert'] . ' ' . (($before) ? $lang['EM_before'] : $lang['EM_after']) . ":</b></br>";

	$insert_string = '';
	for ($i=0; $i<count($insert); $i++)
	{
		echo htmlspecialchars($insert[$i]) . "<br />\n";
		$insert_string .= $insert[$i] . "\r\n";
	}

	if ($before)
	{
		write_files($file_list, $insert_string);
		write_find_array($find_array, $file_list);
	}
	else
	{
		write_find_array($find_array, $file_list);
		write_files($file_list, $insert_string);
	}
	$insert = array();
}


// performs a querry and returns a result, is able to draw dots, but not really needed here
function _sql($sql, &$errored, &$error_ary, $echo_dot = true)
{
	global $db;

	if( !($result = $db->sql_query($sql)) )
	{  
		$errored = true;
		$error_ary['sql'][] = ( is_array($sql) ) ? $sql[0] : $sql;
		$error_ary['error_code'][] = $db->sql_error();
	}

	if ( $echo_dot )
	{
		echo '.';
		flush();
	}

	return $result;
}

function _em_hidden_field($name, $value)
{
	return '<input type="hidden" name="' . $name . '" value="' . htmlspecialchars($value) . '" />' . "\n";
}

function _em_get_install_languages()
{
	// do not declare $lang as global here, or else will be unset ;-)
	global $phpbb_root_path, $script_path, $phpEx;

	$dirname = $phpbb_root_path . $script_path . 'languages';
	$dir = @opendir($dirname);

	$EM_lang = array();
	while( $file = @readdir($dir) )
	{
		if( preg_match("#^lang_easymod_(.*)\.$phpEx\$#i", $file, $match) )
		{
			$filecode = $match[1];
			$lang = array();
			include($dirname . '/lang_easymod_' . $filecode . '.' .$phpEx);
			$displayname = $lang['EM_lang_name'];
			$EM_lang[$displayname] = $filecode;
			unset($lang);
		}
	}
	@closedir($dir);

	return $EM_lang;
}





///
/// start program proper
///

$install_step = (isset($HTTP_POST_VARS['install_step'])) ? intval( $HTTP_POST_VARS['install_step']) : 1;
$rescan = (isset($HTTP_POST_VARS['rescan'])) ? TRUE : FALSE;
if ( $rescan)
{
	//$install_step = 1;
	display_step1b_idunno();
}

// Mode setting
if(isset($HTTP_GET_VARS['mode']) || isset($HTTP_POST_VARS['mode']))
{
	$mode = (isset($HTTP_POST_VARS['mode'])) ? stripslashes($HTTP_POST_VARS['mode']) : stripslashes($HTTP_GET_VARS['mode']);
}
else
{
	$mode = '';
}

// check the case where display file on screen is sending a GET VAR
if (($install_step == 1) && (isset($HTTP_GET_VARS['install_step'])))
{
	// make sure the vars seem to match
	if (($HTTP_GET_VARS['install_step'] == 6) && (($mode == 'backup') || ($mode == 'file')))
	{
		// check the password to make sure this is not someone getting around security
		$pw = (isset($HTTP_GET_VARS['pw'])) ? stripslashes($HTTP_GET_VARS['pw']) : '';
		$install_step = ($pw === get_em_pw()) ? 6 : 1;
	}
}


// file access permissions
$read_access = (isset($HTTP_POST_VARS['read_access'])) ? intval($HTTP_POST_VARS['read_access']) : false;
$write_access = (isset($HTTP_POST_VARS['write_access'])) ? intval($HTTP_POST_VARS['write_access']) : false;
$root_write = (isset($HTTP_POST_VARS['root_write'])) ? intval($HTTP_POST_VARS['root_write']) : false;
$tmp_write = (isset($HTTP_POST_VARS['tmp_write'])) ? intval($HTTP_POST_VARS['tmp_write']) : false;
$chmod_access = (isset($HTTP_POST_VARS['chmod_access'])) ? intval($HTTP_POST_VARS['chmod_access']) : false;
$unlink_access = (isset($HTTP_POST_VARS['unlink_access'])) ? intval($HTTP_POST_VARS['unlink_access']) : false;
$mkdir_access = (isset($HTTP_POST_VARS['mkdir_access'])) ? intval($HTTP_POST_VARS['mkdir_access']) : false;
$copy_access = (isset($HTTP_POST_VARS['copy_access'])) ? intval($HTTP_POST_VARS['copy_access']) : false;

// file access settings
$em_pass = (isset($HTTP_POST_VARS['em_pass'])) ? stripslashes($HTTP_POST_VARS['em_pass']) : '';
$read = (isset($HTTP_POST_VARS['sel_read'])) ? stripslashes($HTTP_POST_VARS['sel_read']) : '';
$write = (isset($HTTP_POST_VARS['sel_write'])) ? stripslashes($HTTP_POST_VARS['sel_write']) : '';
$move = (isset($HTTP_POST_VARS['sel_move'])) ? stripslashes($HTTP_POST_VARS['sel_move']) : '';

// ftp settings
$ftp_user = (isset($HTTP_POST_VARS['ftp_user'])) ? stripslashes($HTTP_POST_VARS['ftp_user']) : '';
$ftp_pass = (isset($HTTP_POST_VARS['ftp_pass'])) ? stripslashes($HTTP_POST_VARS['ftp_pass']) : '';
$ftp_host = (isset($HTTP_POST_VARS['ftp_host'])) ? stripslashes($HTTP_POST_VARS['ftp_host']) : 'localhost';
$ftp_port = (isset($HTTP_POST_VARS['ftp_port'])) ? intval($HTTP_POST_VARS['ftp_port']) : 21;
$ftp_debug = (isset($HTTP_POST_VARS['ftp_debug'])) ? intval($HTTP_POST_VARS['ftp_debug']) : false;
$ftp_type = (isset($HTTP_POST_VARS['ftp_type'])) ? stripslashes($HTTP_POST_VARS['ftp_type']) : 'fsock';
$ftp_cache = (isset($HTTP_POST_VARS['ftp_cache'])) ? intval($HTTP_POST_VARS['ftp_cache']) : 0;
$ftp_dir = (isset($HTTP_POST_VARS['ftp_dir'])) ? stripslashes($HTTP_POST_VARS['ftp_dir']) : '/';
$ftp_dir = ($ftp_dir == '') ? '/' : $ftp_dir;

$file_list = array();
$phpBB_version = get_phpbb_version($db);
if ($phpBB_version == '')
{
	handle_error(OPEN_FAIL_CRITICAL, $file_list, false, '<b>' . $lang['EM_err_critical_error'] . ':</b> ' . $lang['EM_err_phpbb_ver']);
}






///
/// display help in the new window requested
///
if ($mode == 'help')
{

	page_header('moo', true);
?>

<table class="forumline" width="100%" cellspacing="1" cellpadding="3" border="0" align="center">
	<tr> 
		<td class="catHead" height="28" align="center"><span class="cattitle"><?=$lang['EM_installer_help'];?></span></td>
	</tr>
	<tr> 
		<td class="row1" align="left" valign="top"><div class="postbody"><?php
	$first_item = true;
	foreach( $lang['help'] as $name => $paragraphs )
	{
		if( $first_item )
		{
			$first_item = false;
		}
		else
		{
			echo '<img src="' . $phpbb_root_path . 'templates/Default/images/spacer.gif" alt="" width="1" height="30" />' . "<hr />\n";
		}
		echo '<p><a name="' . $name . '" /></a><b style="font-size:larger;">' . $paragraphs[0] . "</b></p>\n";
		for( $i = 1; $i < count($paragraphs); $i++ )
		{
			echo '<p>' . $paragraphs[$i] . "</p>\n";
		}
	}
?></div></td>
	</tr>
	<tr>
		<td class="spaceRow" height="1"><img src="<?=$phpbb_root_path;?>templates/Default/images/spacer.gif" alt="" width="1" height="1" /></td>
	</tr>
</table>

<br clear="all" />

<?php
	page_footer();
	exit;
}


//
// display expanded debug screen; there isn't error though, someone just clicked "Display Debug Info" link
//
else if ($mode == 'debug')
{
	$install_step = (isset($HTTP_GET_VARS['install_step'])) ? intval($HTTP_GET_VARS['install_step']) : $install_step;
	$read = (isset($HTTP_GET_VARS['read'])) ? stripslashes($HTTP_GET_VARS['read']) : $read;
	$write = (isset($HTTP_GET_VARS['write'])) ? stripslashes($HTTP_GET_VARS['write']) : $write;
	$move = (isset($HTTP_GET_VARS['move'])) ? stripslashes($HTTP_GET_VARS['move']) : $move;
	$ftp_dir = (isset($HTTP_GET_VARS['ftp_dir'])) ? stripslashes($HTTP_GET_VARS['ftp_dir']) : $ftp_dir;
	$ftp_user = (isset($HTTP_GET_VARS['ftp_user'])) ? stripslashes($HTTP_GET_VARS['ftp_user']) : $ftp_user;
	$ftp_pass = (isset($HTTP_GET_VARS['ftp_pass'])) ? stripslashes($HTTP_GET_VARS['ftp_pass']) : $ftp_pass;
	$ftp_host = (isset($HTTP_GET_VARS['ftp_host'])) ? stripslashes($HTTP_GET_VARS['ftp_host']) : $ftp_host;
	$ftp_port = (isset($HTTP_GET_VARS['ftp_port'])) ? intval($HTTP_GET_VARS['ftp_port']) : $ftp_port;
	$ftp_debug = (isset($HTTP_GET_VARS['ftp_debug'])) ? intval($HTTP_GET_VARS['ftp_debug']) : $ftp_debug;
	$ftp_type = (isset($HTTP_GET_VARS['ftp_type'])) ? stripslashes($HTTP_GET_VARS['ftp_type']) : $ftp_type;

////////////////////// what about ? and &
	// fix the password and put any # symbols back they may belong
	$ftp_pass = str_replace('~pound~', '#', $ftp_pass);

	page_header( $lang['EM_debug_header']);
	display_debug_info();
	echo "<br />\n";
	page_footer();
	exit;
}


//
// download the modified files if that is what we are supposed to be doing
//
else if ($mode == 'download')
{
	$install_step = (isset($HTTP_POST_VARS['filename'])) ? stripslashes($HTTP_POST_VARS['filename']) : '';
	$body = (isset($HTTP_POST_VARS['body'])) ? stripslashes($HTTP_POST_VARS['body']) : '';

	header('Content-Type: text/x-delimtext; name="' . $filename . '"');
	header('Content-disposition: attachment; filename=' . $filename . '"');

	echo $body . "\n";

	exit;
}


///
/// gather setup parameters
///
else if ($install_step == 1)
{
	$install_style = ( ( isset($HTTP_GET_VARS['setup']) && $HTTP_GET_VARS['setup'] == 'advanced' ) || ( isset($HTTP_POST_VARS['setup']) && $HTTP_POST_VARS['setup'] == 'advanced' ) ) ? 'advanced' : 'simple';
	$substep = (isset($HTTP_POST_VARS['substep'])) ? stripslashes($HTTP_POST_VARS['substep']) : '';
	if ($substep != 'a' && $substep != 'b' && $substep != 'c')
	{
		$substep = '';
	}
	$option = (isset($HTTP_POST_VARS['option'])) ? stripslashes($HTTP_POST_VARS['option']) : '';
	if ($option != 'ftp' && $option != 'windoze' && $option != 'idunno' && $option != 'write_copy' && $option != 'post_process' && $option != 'manual' && $option != 'download' && $option != 'advanced')
	{
		$option = '';
	}

	// handle selection from main install screen (simple mode)
	if ( $substep == 'a')
	{
		// they said they have FTP, get the FTP settings
		if ( $option == 'ftp')
		{
			display_step1b_ftp();
		}

		// they said they have a window box, go straight to getting empw
		else if ( $option == 'windoze')
		{
			$read = 'server';
			$write = 'server';
			$move = 'copy';

			display_step1c_empw();
		}

		// they dunno... duh! duh! duh!
		else if ( $option == 'idunno')
		{
			display_step1b_idunno();
		}

		// should never happen
		else
		{
			display_step1_classic();
		}
	}
	else if ( $substep == 'b')
	{
		if ( $option == 'ftp')
		{
			display_step1b_ftp();
		}
		else if ( $option == 'write_copy')
		{
			$read = 'server';
			$write = 'server';
			$move = 'copy';

			display_step1c_empw();
		}
		else if ( $option == 'idunno')
		{
			display_step1b_idunno();
		}
		else if ( $option == 'post_process')
		{
			$read = 'server';
			$write = 'server';
			$move = 'exec';

			display_step1c_empw();
		}
		else if ( $option == 'manual')
		{
			$read = 'server';
			$write = 'server';
			$move = 'ftpm';

			display_step1c_empw();
		}
		else if ( $option == 'download')
		{
			$read = 'server';
			$write = 'local';
			$move = 'ftpm';

			display_step1c_empw();
		}
		else if ( $option == 'advanced')
		{
			display_step1_classic();
		}
		else
		{
			display_step1_classic();
		}
	}
	else if ( $substep == 'c')
	{
		display_step1c_empw();
	}
	else if ($install_style == 'advanced')
	{
		display_step1_classic();
	}
	else
	{
		display_step1_simple();
	}
	exit;
}


//
// confirm the file access settings
//

else if ( $install_step == 2)
{
	page_header( $lang['EM_step2']);

	// confirm passwords match
	$em_pass_confirm = (isset($HTTP_POST_VARS['em_pass_confirm'])) ? stripslashes( $HTTP_POST_VARS['em_pass_confirm']) : '';
	if ( $em_pass !== $em_pass_confirm)
	{
		echo $lang['EM_err_pw_match'] . "<br />\n";
		form_settings($hidden, 3, '', true);
		page_footer();
		exit;
	}

	//
	// verify write access
	//
	echo '<h2>' . $lang['EM_test_write'] . "</h2>\n";
	$has_error = true;

	// test writing to the server
	if ( $write == 'server')
	{
		// duh! they don't have write access!
		if (!$write_access)
		{
			echo $lang['EM_err_acc_write'] . "\n";
		}

		// they can't make dirs, so this is no good
		else if (!$mkdir_access)
		{
			echo $lang['EM_err_acc_mkdir'] . "\n";
		}

		// ok!
		else
		{
			$has_error = false;
		}

		if ($has_error)
		{
////////////
////////////
////////////
			echo "<p>".$lang['EM_check_permissions']."</p>\n";
			form_settings($hidden, 3, '', true);
			page_footer();
			exit;
		}
	}

	// if buffer+ftp write we need to test FTP to make sure we can move the files into place
	else if ( $write == 'ftpb')
	{
		// test the FTP connection
		$test_report = '';
		$test_result = capture_test_ftp($ftp_user, $ftp_pass, $ftp_dir, $ftp_host, $ftp_port, $ftp_debug, $ftp_type, $ftp_cache, $test_report);
		echo $test_report;
		if( !$test_result )
		{
			// FTP failed; print RESCAN button and then exit
			form_settings($hidden, 3, '', true);
			page_footer();
			exit;
		}
	}


	// test to make sure the download feature will work; privmsg.php is the largest file so test with that
	else if ( $write == 'local')
	{
		// this will create a download button
		echo $lang['EM_confirm_download'] . "<br />\n";
		echo '<form action="easymod_install.' . $phpEx . '" name="install5" method="post">' . "\n";
		$button  = '<input type="hidden" name="install_step" value="5" />' . "\n";
		$button .= '<input class="mainoption" type="submit" name="download" value="' . htmlspecialchars($lang['EM_pp_download']) . '" />' . "\n";
		echo $button;
		echo "</form>\n";
	}
	else if ( $write == '')
	{
//////// hard coded lang
//////// also... what is the "3" in the error??  should be a defined constant
		echo "<p>".$lang['EM_undefined_write']."</p>\n";
		form_settings($hidden, 3, '', true);
		page_footer();
		exit;
	}


	echo '<b class="ok">' . $lang['EM_confirm_write'] . "</b><br />\n";
	if ($write == 'server')
	{
		echo $lang['EM_confirm_write_server'] . "<br />\n";
	}
	else if ($write == 'ftpb')
	{
		echo $lang['EM_confirm_write_ftp'] . "<br />\n";
	}
	else if ($write == 'local')
	{
		echo $lang['EM_confirm_write_local'] . "<br />\n";
	}
	else if ($write == 'screen')
	{
		echo $lang['EM_confirm_write_screen'] . "<br />\n";
	}



	//
	// verify move access
	//
	echo '<h2>' . $lang['EM_test_move'] . "</h2>\n";
	$has_error = true;


	// if they are doing an automated server move method, make sure they are writing to the server!
	if ( (($move == 'ftpa') || ($move == 'copy')) && !(($write == 'ftpb') || ($write == 'server')) )
	{
		echo '<p>' . $lang['EM_err_no_write'] . "</p>\n";
		form_settings($hidden, 3, '', true);
		page_footer();
		exit;
	}

	// if they are using FTP to write the files, then make sure they are using it move as well
	else if (($write == 'ftpb') && ($move != 'ftpa'))
	{
		echo '<p>' . $lang['EM_ftp_sync1'] . "</p>\n";
		form_settings($hidden, 3, '', true);
		page_footer();
		exit;
	}

	else if (($write != 'ftpb') && ($move == 'ftpa'))
	{
		echo '<p>' . $lang['EM_ftp_sync2'] . "</p>\n";
		form_settings($hidden, 3, '', true);
		page_footer();
		exit;
	}

	// if they want automated FTP, make sure it works
	else if ( $move == 'ftpa')
	{
		// test the FTP connection
		$test_report = '';
		$test_result = capture_test_ftp($ftp_user, $ftp_pass, $ftp_dir, $ftp_host, $ftp_port, $ftp_debug, $ftp_type, $ftp_cache, $test_report);
		echo $test_report;
		if( !$test_result )
		{
			// FTP failed; print RESCAN button and then exit
			form_settings($hidden, 3, '', true);
			page_footer();
			exit;
		}
	}

	// if they selected copy access, make sure they actually have it (tards!!!)
	else if (( $move == 'copy') && ((!$copy_access) || (!$root_write)))
	{
		echo $lang['EM_err_copy'] . "<br />\n";
////////////
////////////
////////////
////////////
		echo '<p>' . $lang['EM_check_permissions'] . "</p>\n";
		form_settings($hidden, 3, '', true);
		page_footer();
		exit;
	}
	else if ( $move == '')
	{
//////// hard coded lang
//////// also... what is the "3" in the error??  should be a defined constant
		echo '<p>' . $lang['EM_undefined_move_method'] . "</p>\n";
		form_settings($hidden, 3, '', true);
		page_footer();
		exit;
	}


	echo '<b class="ok">' . $lang['EM_confirm_move'] . "</b><br />\n";
	if ($move == 'ftpa')
	{
		echo $lang['EM_confirm_move_ftp'] . "<br />\n";
	}
	else if ($move == 'copy')
	{
		echo $lang['EM_confirm_move_copy'] . "<br />\n";
	}
	else if ($move == 'exec')
	{
		echo $lang['EM_confirm_move_exec'] . "<br />\n";
	}
	else if ($move == 'ftpm')
	{
		echo $lang['EM_confirm_move_ftpm'] . "<br />\n";
	}


	$hidden .= _em_hidden_field('sel_read', $read);
	$hidden .= _em_hidden_field('sel_write', $write);
	$hidden .= _em_hidden_field('sel_move', $move);

	$hidden .= _em_hidden_field('read_access', $read_access);
	$hidden .= _em_hidden_field('write_access', $write_access);
	$hidden .= _em_hidden_field('root_write', $root_write);
	$hidden .= _em_hidden_field('tmp_write', $tmp_write);
	$hidden .= _em_hidden_field('chmod_access', $chmod_access);
	$hidden .= _em_hidden_field('unlink_access', $unlink_access);
	$hidden .= _em_hidden_field('mkdir_access', $mkdir_access);
	$hidden .= _em_hidden_field('copy_access', $copy_access);

	$hidden .= _em_hidden_field('em_pass', $em_pass);
	$hidden .= _em_hidden_field('ftp_user', $ftp_user);
	$hidden .= _em_hidden_field('ftp_pass', $ftp_pass);
	$hidden .= _em_hidden_field('ftp_host', $ftp_host);
	$hidden .= _em_hidden_field('ftp_port', $ftp_port);
	$hidden .= _em_hidden_field('ftp_dir', $ftp_dir);
	$hidden .= _em_hidden_field('ftp_debug', $ftp_debug);
	$hidden .= _em_hidden_field('ftp_type', $ftp_type);
	$hidden .= _em_hidden_field('ftp_cache', $ftp_cache);

	form_settings($hidden, 3, $lang['EM_install_EM'], true);
	page_footer();
	exit;
}


///
/// process files
///

else if ( $install_step == 3)
{
	page_header( $lang['EM_step3'] );
	echo "<br clear=\"all\" />";

	//
	// setup the command file
	//

	// we will keep the command file as an array for now and then write it out later; we will reuse the settings data
	$command_file = new mod_io('post_process.sh', '', $read, $write, $move, $ftp_user, $ftp_pass, $ftp_dir, $ftp_host, $ftp_port, $ftp_type, $ftp_cache);

	// this is really more about moving the other files than is about the command file; establish the FTP connection
	//  for moving files if necessary
	if (!$command_file->modio_prep('write', $ftp_debug))
	{
		$command_file->err_msg = $lang['EM_trace'] . ': main[1]->' . $command_file->err_msg;
		$error = '<b>' . $lang['EM_err_critical_error'] . ':</b><br /> ' . $command_file->err_msg . "<br />\n";
		handle_error(OPEN_FAIL_CRITICAL, $file_list, false, $error);
	}


	// finish writing the file
	if (!complete_file_reproduction($file_list))
	{
		// print an error and will halt processing; don't close files b/c we already have
		handle_error( OPEN_FAIL_CRITICAL, $file_list, false);
	}

	// create the admin/em_includes directory
	$command_file->modio_mkdirs_copy('admin/em_includes/');

	// create the includes/sql directory
	$command_file->modio_mkdirs_copy('includes/sql/');

	// terminate the FTP connection
	$command_file->modio_cleanup('write');	


	echo '<h2>' . $lang['EM_build_post'] . "</h2>\n";


	$command_file->afile[] = 'copy includes/admin_easymod.php.txt ../../../admin/admin_easymod.php';
	$command_file->afile[] = 'copy em_includes/em_functions.php ../../../admin/em_includes/em_functions.php';
	$command_file->afile[] = 'copy em_includes/em_cipher.php ../../../admin/em_includes/em_cipher.php';
	$command_file->afile[] = 'copy em_includes/em_schema.php ../../../admin/em_includes/em_schema.php';
	$command_file->afile[] = 'copy em_includes/em_modio.php ../../../admin/em_includes/em_modio.php';
	$command_file->afile[] = 'copy em_includes/em_ftp.php ../../../admin/em_includes/em_ftp.php';
	$command_file->afile[] = 'copy em_includes/parser_xml.php ../../../admin/em_includes/parser_xml.php';
	$command_file->afile[] = 'copy em_includes/index.htm ../../../admin/em_includes/index.htm';

	$command_file->afile[] = 'copy includes/sql/sql_builder.php ../../../includes/sql/sql_builder.php';
	$command_file->afile[] = 'copy includes/sql/sql_builder_mssql.php ../../../includes/sql/sql_builder_mssql.php';
	$command_file->afile[] = 'copy includes/sql/sql_builder_mysql.php ../../../includes/sql/sql_builder_mysql.php';
	$command_file->afile[] = 'copy includes/sql/sql_builder_postgresql.php ../../../includes/sql/sql_builder_postgresql.php';
	$command_file->afile[] = 'copy includes/sql/sql_parser.php ../../../includes/sql/sql_parser.php';
	$command_file->afile[] = 'copy includes/sql/sql_reserved_keywords.php ../../../includes/sql/sql_reserved_keywords.php';
	$command_file->afile[] = 'copy languages/lang_sql_parser.php ../../../language/lang_english/lang_sql_parser.php';
	
	//$command_file->afile[] = 'copy includes/htaccess.txt ../../../admin/mods/.htaccess';

//////////////
////////////// once we get some translations, we can copy the proper files to where they should go
//////////////
	$lang_path =  $phpbb_root_path . 'language/';
	$lang_files = get_lang_files( 'lang_main.' . $phpEx, 'language/lang_english/', $lang_path);
	for ($i=0; $i<count($lang_files); $i++)
	{
		if ( file_exists(@phpbb_realpath($phpbb_root_path . $script_path . 'languages/lang_easymod_' . preg_replace("/language\/lang_(.*)\//", "\\1", $lang_files[$i]['path']) . '.' .$phpEx)) )
		{
			$command_file->afile[] = "copy languages/lang_easymod_" . preg_replace("/language\/lang_(.*)\//", "\\1", $lang_files[$i]['path']) . ".$phpEx ../../../" . $lang_files[$i]['path'] . 'lang_easymod.' . $phpEx;
		}
		else
		{
			$command_file->afile[] = "copy languages/lang_easymod_english.$phpEx ../../../" . $lang_files[$i]['path'] . 'lang_easymod.' . $phpEx;
		}
	}


	$files = get_theme_files( 'index_body.tpl', 'templates/Default/admin/');
	$pics = get_theme_files( 'cellpic.gif', 'templates/Default/images/');
	for ($i=0; $i<count($files); $i++)
	{
		$command_file->afile[] = 'copy includes/mod_complete.tpl ../../../' . $files[$i]['path'] . 'mod_complete.tpl';
		$command_file->afile[] = 'copy includes/mod_header.tpl ../../../' . $files[$i]['path'] . 'mod_header.tpl';
		$command_file->afile[] = 'copy includes/mod_history.tpl ../../../' . $files[$i]['path'] . 'mod_history.tpl';
		$command_file->afile[] = 'copy includes/mod_history_details.tpl ../../../' . $files[$i]['path'] . 'mod_history_details.tpl';
		$command_file->afile[] = 'copy includes/mod_install.tpl ../../../' . $files[$i]['path'] . 'mod_install.tpl';
		$command_file->afile[] = 'copy includes/mod_login.tpl ../../../' . $files[$i]['path'] . 'mod_login.tpl';
		$command_file->afile[] = 'copy includes/mod_process.tpl ../../../' . $files[$i]['path'] . 'mod_process.tpl';
		$command_file->afile[] = 'copy includes/mod_settings.tpl ../../../' . $files[$i]['path'] . 'mod_settings.tpl';
		$command_file->afile[] = 'copy includes/mod_sql_body.tpl ../../../' . $files[$i]['path'] . 'mod_sql_body.tpl';
		$command_file->afile[] = 'copy includes/mod_preview.tpl ../../../' . $files[$i]['path'] . 'mod_preview.tpl';
		$command_file->afile[] = 'copy includes/mod_diy_body.tpl ../../../' . $files[$i]['path'] . 'mod_diy_body.tpl';
		$command_file->afile[] = 'copy includes/mod_help.tpl ../../../' . $files[$i]['path'] . 'mod_help.tpl';
		
		$command_file->afile[] = 'copy easymod.gif ../../../' . $pics[$i]['path'] . 'easymod.gif';
		$command_file->afile[] = 'copy modx_inside.png ../../../' . $pics[$i]['path'] . 'modx_inside.png';
		$command_file->afile[] = 'copy includes/emc.gif ../../../' . $pics[$i]['path'] . 'emc.gif';
	}

	$hidden .= _em_hidden_field('sel_read', $read);
	$hidden .= _em_hidden_field('sel_write', $write);
	$hidden .= _em_hidden_field('sel_move', $move);

	$hidden .= _em_hidden_field('read_access', $read_access);
	$hidden .= _em_hidden_field('write_access', $write_access);
	$hidden .= _em_hidden_field('root_write', $root_write);
	$hidden .= _em_hidden_field('tmp_write', $tmp_write);
	$hidden .= _em_hidden_field('chmod_access', $chmod_access);
	$hidden .= _em_hidden_field('unlink_access', $unlink_access);
	$hidden .= _em_hidden_field('mkdir_access', $mkdir_access);
	$hidden .= _em_hidden_field('copy_access', $copy_access);

	$hidden .= _em_hidden_field('em_pass', $em_pass);
	$hidden .= _em_hidden_field('ftp_user', $ftp_user);
	$hidden .= _em_hidden_field('ftp_pass', $ftp_pass);
	$hidden .= _em_hidden_field('ftp_host', $ftp_host);
	$hidden .= _em_hidden_field('ftp_port', $ftp_port);
	$hidden .= _em_hidden_field('ftp_dir', $ftp_dir);
	$hidden .= _em_hidden_field('ftp_debug', $ftp_debug);
	$hidden .= _em_hidden_field('ftp_type', $ftp_type);
	$hidden .= _em_hidden_field('ftp_cache', $ftp_cache);

	echo '<b>' . $lang['EM_build_post_desc'] . ":</b>\n";
	for ($i=0; $i<count( $command_file->afile); $i++)
	{
		echo $command_file->afile[$i] . "<br />\n";
		$hidden .= _em_hidden_field("command_step$i", $command_file->afile[$i]);
	}
	$hidden .= _em_hidden_field('num_command_steps', $i);

	form_settings($hidden, 4, $lang['EM_complete_processing'], '');
	page_footer();
	exit;
}


//
// move the files into place and we are done!
//

else if ( $install_step == 4)
{
	// if adding an option to a select field, get the field number
	$num_command_steps = ( isset($HTTP_POST_VARS['num_command_steps'])) ? intval($HTTP_POST_VARS['num_command_steps']) : 0;
	$command = array();
	for ( $i=0; $i<$num_command_steps; $i++)
	{
		$var_name = 'command_step' . $i;
		if ( isset($HTTP_POST_VARS[$var_name]))
		{
			$command[] = stripslashes($HTTP_POST_VARS[$var_name]);
		}
	}

	page_header($lang['EM_step4']);

	// Check which tables should we create before building the $sql array.
	$test_sql = "SELECT * FROM " . EASYMOD_TABLE;
	$create_easymod_table = ( $db->sql_query($test_sql) ? false : true );
	$test_sql = "SELECT * FROM " . EASYMOD_PROCESSED_FILES_TABLE;
	$create_easymod_processed_files_table = ( $db->sql_query($test_sql) ? false : true );

	///
	/// Add the easymod table
	///
	$sql = array();
	switch ( SQL_LAYER )
	{
		case 'mysql':
		case 'mysqli':
		case 'mysql4':
			if( $create_easymod_table )
			{
				$sql[] = "CREATE TABLE " . EASYMOD_TABLE . " (
					mod_id mediumint(8) NOT NULL auto_increment,
					mod_title varchar(255) NULL DEFAULT '',
					mod_file varchar(255) NULL DEFAULT '',
					mod_version varchar(15) NULL DEFAULT '',
					mod_author_handle varchar(25) NULL DEFAULT '',
					mod_author_email varchar(100) NULL DEFAULT '',
					mod_author_name varchar(100) NULL DEFAULT '',
					mod_author_url varchar(100) NULL DEFAULT '',
					mod_description text NULL,
					mod_process_date int(11) NULL DEFAULT '0',
					mod_phpBB_version varchar(15) NULL DEFAULT '',
					mod_processed_themes varchar(200) NULL DEFAULT '',
					mod_processed_langs varchar(200) NULL DEFAULT '',
					mod_files_edited mediumint(8) NULL DEFAULT '0',
					mod_tables_added mediumint(8) NULL DEFAULT '0',
					mod_tables_altered mediumint(8) NULL DEFAULT '0',
					mod_rows_inserted mediumint(8) NULL DEFAULT '0',
					PRIMARY KEY (mod_id))";
			}

			if( $create_easymod_processed_files_table )
			{
				$sql[] = "CREATE TABLE " . EASYMOD_PROCESSED_FILES_TABLE . " (
					mod_processed_file varchar(255) NOT NULL DEFAULT '',
					mod_id mediumint(8) NOT NULL DEFAULT '0',
					KEY mod_processed_file (mod_processed_file),
					KEY mod_id (mod_id))";
			}
			break;

		case 'postgresql':
			if( $create_easymod_table )
			{
				$sql[] = "CREATE SEQUENCE " . EASYMOD_TABLE . "_id_seq start 1 increment 1 maxvalue 2147483647 minvalue 1 cache 1";

				$sql[] = "CREATE TABLE " . EASYMOD_TABLE . " (
					mod_id int4 NOT NULL DEFAULT nextval('" . EASYMOD_TABLE . "_id_seq'::text),
					CONSTRAINT PK_phpbb_easymod PRIMARY KEY (mod_id),
					mod_title varchar(255) NULL DEFAULT '',
					mod_file varchar(255) NULL DEFAULT '',
					mod_version varchar(15) NULL DEFAULT '',
					mod_author_handle varchar(25) NULL DEFAULT '',
					mod_author_email varchar(100) NULL DEFAULT '',
					mod_author_name varchar(100) NULL DEFAULT '',
					mod_author_url varchar(100) NULL DEFAULT '',
					mod_description text NULL DEFAULT '',
					mod_process_date int4 NULL DEFAULT '0',
					mod_phpBB_version varchar(15) NULL DEFAULT '',
					mod_processed_themes varchar(200) NULL DEFAULT '',
					mod_processed_langs varchar(200) NULL DEFAULT '',
					mod_files_edited int4 NULL DEFAULT '0',
					mod_tables_added int4 NULL DEFAULT '0',
					mod_tables_altered int4 NULL DEFAULT '0',
					mod_rows_inserted int4 NULL DEFAULT '0' )";
			}

			if( $create_easymod_processed_files_table )
			{
				$sql[] = 'CREATE TABLE ' . EASYMOD_PROCESSED_FILES_TABLE . " (
					mod_processed_file varchar(255) NOT NULL DEFAULT '',
					mod_id int4 NOT NULL DEFAULT '0' )";
				$sql[] = 'CREATE INDEX ' . EASYMOD_PROCESSED_FILES_TABLE . '_ix1 ON ' . EASYMOD_PROCESSED_FILES_TABLE . ' (mod_processed_file)';
				$sql[] = 'CREATE INDEX ' . EASYMOD_PROCESSED_FILES_TABLE . '_ix2 ON ' . EASYMOD_PROCESSED_FILES_TABLE . ' (mod_id)';
			}
			break;

		case 'mssql-odbc':
		case 'mssql':
/*
			$sql[] = "
BEGIN TRANSACTION
GO";
*/
			if( $create_easymod_table )
			{
				$sql[] = "CREATE TABLE [" . EASYMOD_TABLE . "] (
					  [mod_id] [int] IDENTITY (1, 1) NOT NULL,
					  [mod_title] [varchar] (255) NULL,
					  [mod_file] [varchar] (255) NULL,
					  [mod_version] [varchar] (15) NULL,
					  [mod_author_handle] [varchar] (25) NULL,
					  [mod_author_email] [varchar] (100) NULL,
					  [mod_author_name] [varchar] (100) NULL,
					  [mod_author_url] [varchar] (100) NULL,
					  [mod_description] [varchar] (255) NULL,
					  [mod_process_date] [int] NULL,
					  [mod_phpBB_version] [varchar] (15) NULL,
					  [mod_processed_themes] [varchar] (200) NULL,
					  [mod_processed_langs] [varchar] (200) NULL,
					  [mod_files_edited] [int] NULL,
					  [mod_tables_added] [int] NULL,
					  [mod_tables_altered] [int] NULL,
					  [mod_rows_inserted] [int] NULL
					) ON [PRIMARY];";
//GO";

				$sql[] = "ALTER TABLE [" . EASYMOD_TABLE . "] WITH NOCHECK ADD
					  CONSTRAINT [PK_" . EASYMOD_TABLE . "] PRIMARY KEY CLUSTERED
					  (
					    [mod_id]
					  ) ON [PRIMARY]";
//GO";


//					CONSTRAINT [DF_phpbb_easymod_mod_id] DEFAULT ('0') FOR [mod_id],
				$sql[] = "ALTER TABLE [" . EASYMOD_TABLE . "] WITH NOCHECK ADD
					CONSTRAINT [DF_" . EASYMOD_TABLE . "_mod_title] DEFAULT ('') FOR [mod_title],
					CONSTRAINT [DF_" . EASYMOD_TABLE . "_mod_file] DEFAULT ('') FOR [mod_file],
					CONSTRAINT [DF_" . EASYMOD_TABLE . "_mod_version] DEFAULT ('') FOR [mod_version],
					CONSTRAINT [DF_" . EASYMOD_TABLE . "_mod_author_handle] DEFAULT ('') FOR [mod_author_handle],
					CONSTRAINT [DF_" . EASYMOD_TABLE . "_mod_author_email] DEFAULT ('') FOR [mod_author_email],
					CONSTRAINT [DF_" . EASYMOD_TABLE . "_mod_author_name] DEFAULT ('') FOR [mod_author_name],
					CONSTRAINT [DF_" . EASYMOD_TABLE . "_mod_author_url] DEFAULT ('') FOR [mod_author_url],
					CONSTRAINT [DF_" . EASYMOD_TABLE . "_mod_description] DEFAULT ('') FOR [mod_description],
					CONSTRAINT [DF_" . EASYMOD_TABLE . "_mod_process_date] DEFAULT ('0') FOR [mod_process_date],
					CONSTRAINT [DF_" . EASYMOD_TABLE . "_mod_phpBB_version] DEFAULT ('') FOR [mod_phpBB_version],
					CONSTRAINT [DF_" . EASYMOD_TABLE . "_mod_processed_themes] DEFAULT ('') FOR [mod_processed_themes],
					CONSTRAINT [DF_" . EASYMOD_TABLE . "_mod_processed_langs] DEFAULT ('') FOR [mod_processed_langs],
					CONSTRAINT [DF_" . EASYMOD_TABLE . "_mod_files_edited] DEFAULT ('0') FOR [mod_files_edited],
					CONSTRAINT [DF_" . EASYMOD_TABLE . "_mod_tables_added] DEFAULT ('0') FOR [mod_tables_added],
					CONSTRAINT [DF_" . EASYMOD_TABLE . "_mod_tables_altered] DEFAULT ('0') FOR [mod_tables_altered],
					CONSTRAINT [DF_" . EASYMOD_TABLE . "_mod_rows_inserted] DEFAULT ('0') FOR [mod_rows_inserted]";
//					GO";

			}

			if( $create_easymod_processed_files_table )
			{
				$sql[] = "CREATE TABLE [" . EASYMOD_PROCESSED_FILES_TABLE . "] (
					  [mod_id] [int] NOT NULL,
					  [mod_processed_file] [varchar] (255) NULL
					) ON [PRIMARY];";
//GO";
				$sql[] = "ALTER TABLE [" . EASYMOD_PROCESSED_FILES_TABLE . "] WITH NOCHECK ADD
					CONSTRAINT [DF_" . EASYMOD_PROCESSED_FILES_TABLE . "_mod_processed_file] DEFAULT ('') FOR [mod_processed_file],
					CONSTRAINT [DF_" . EASYMOD_PROCESSED_FILES_TABLE . "_mod_id] DEFAULT ('0') FOR [mod_id]";
//GO";
				$sql[] = "CREATE  INDEX [" . EASYMOD_PROCESSED_FILES_TABLE . "_IX1]
					ON [" . EASYMOD_PROCESSED_FILES_TABLE . "]([mod_processed_file]) ON [PRIMARY]";
//GO";
				$sql[] = "CREATE  INDEX [" . EASYMOD_PROCESSED_FILES_TABLE . "_IX2]
					ON [" . EASYMOD_PROCESSED_FILES_TABLE . "]([mod_id]) ON [PRIMARY]";
//GO";
			}

/*
			$sql[] = "COMMIT
					GO";
*/

			break;

		case 'msaccess':
			if( $create_easymod_table )
			{
				$sql[] = "CREATE TABLE " . EASYMOD_TABLE . " (
					mod_id COUNTER NOT NULL CONSTRAINT PK_" . EASYMOD_TABLE . " PRIMARY KEY,
					mod_title TEXT(255) NULL,
					mod_file TEXT(255) NULL,
					mod_version TEXT(15) NULL,
					mod_author_handle TEXT(25) NULL,
					mod_author_email TEXT(100) NULL,
					mod_author_name TEXT(100) NULL,
					mod_author_url TEXT(100) NULL,
					mod_description MEMO NULL,
					mod_process_date INTEGER NULL,
					mod_phpBB_version TEXT(15) NULL,
					mod_processed_themes TEXT(200) NULL,
					mod_processed_langs TEXT(200) NULL,
					mod_files_edited INTEGER NULL,
					mod_tables_added INTEGER NULL,
					mod_tables_altered INTEGER NULL,
					mod_rows_inserted INTEGER NULL )";
			}

			if( $create_easymod_processed_files_table )
			{
				$sql[] = 'CREATE TABLE ' . EASYMOD_PROCESSED_FILES_TABLE . " (
					mod_processed_file TEXT(255) NOT NULL DEFAULT '',
					mod_id INTEGER NOT NULL DEFAULT '0' )";
				$sql[] = 'CREATE INDEX ' . EASYMOD_PROCESSED_FILES_TABLE . '_ix1 ON ' . EASYMOD_PROCESSED_FILES_TABLE . ' (mod_processed_file)';
				$sql[] = 'CREATE INDEX ' . EASYMOD_PROCESSED_FILES_TABLE . '_ix2 ON ' . EASYMOD_PROCESSED_FILES_TABLE . ' (mod_id)';
			}
			break;

		default:
			message_die(GENERAL_ERROR, $lang['EM_err_no_sql']);
			break;
	}


	echo '<h2>' . $lang['EM_add_db'] . "</h2>\n";


	// if the EM tables already exist, then don't bother making them again
	if ( count($sql) <= 0 )
	{
		echo '<p>' . $lang['EM_progress'] . ' :: <b class="ok">' . $lang['EM_done'] . '</b> - ' . $lang['EM_already_exist'] . "<br />\n";
	}

	// we need to create the EM tables
	else
	{
		echo '<b>' . $lang['EM_exec_sql'] . ": </b><br />\n";
		for($i = 0; $i < count($sql); $i++)
		{
			echo "$sql[$i]<br />\n";
		}

		echo '<p>' . $lang['EM_progress'] . ' :: <b>';
		flush();

		$error_ary = array();
		$errored = false;
		for($i = 0; $i < count($sql); $i++)
		{
			_sql($sql[$i], $errored, $error_ary);
		}

		echo '</b> <b class="ok">' . $lang['EM_done'] . '</b><br />' . $lang['EM_result'] . " &nbsp; :: \n";

		if ( $errored )
		{
			echo ' <b>' . $lang['EM_failed_sql'] . "</b>\n<ul>";

			for($i = 0; $i < count($error_ary['sql']); $i++)
			{
				echo '<li>' . $lang['EM_err_error'] . ' :: <b>' . $error_ary['error_code'][$i]['message'] . "</b><br />\n";
				echo "SQL &nbsp; :: <b>" . $error_ary['sql'][$i] . "</b><br /><br /></li>\n";
			}
			echo "</ul>\n<p>" . $lang['EM_no_worry'] . "</p>\n";
		}
		else
		{
			echo '<b>' . $lang['EM_no_errors'] . "</b>\n";
		}
	}

	echo "<br />";
	echo "<br />";
	echo "<br />\n";


	//
	// move the files into place and create the manual post-process script
	//
	echo '<h2>' . $lang['EM_complete_post'] . "</h2>\n";

	// we will keep the command file as an array for now and then write it out later; we will reuse the settings data
	$command_file = new mod_io('post_process.sh', '', $read, $write, $move, $ftp_user, $ftp_pass, $ftp_dir, $ftp_host, $ftp_port, $ftp_type, $ftp_cache);
	$command_bat = new mod_io('post_process.bat', '', $read, $write, $move, $ftp_user, $ftp_pass, $ftp_dir, $ftp_host, $ftp_port, $ftp_type, $ftp_cache);

	// open the command file: config=true,command=true
	if (( !$command_file->modio_open(true)) || ( !$command_bat->modio_open(true)))
	{
		$command_file->err_msg = $lang['EM_trace'] . ': main[1b]->' . $command_file->err_msg;
		$error = '<br />' . $lang['EM_err_open_pp'] . '<br /> ' . $command_file->err_msg . "<br />\n";
		handle_error(OPEN_FAIL_CRITICAL, $file_list, false, $error);
	}

	// this is really more about moving the other files than is about the command file; establish the FTP connection
	//  for moving files if necessary
	if (!$command_file->modio_prep('move', $ftp_debug))
	{
		$command_file->err_msg = $lang['EM_trace'] . ': main[2]->' . $command_file->err_msg;
		handle_error(OPEN_FAIL_CRITICAL, $file_list, false, '<b>' . $lang['EM_err_critical_error'] . ':</b><br /> ' . $command_file->err_msg . "<br />\n");
	}

	// transfer FTP attributes to the bat file
	$command_bat->emftp = $command_file->emftp;

	$bu_list = array();
	$mv_list = array();
	$mod_count = 0;
	// execute the move!
	for ($i=0; $i<$num_command_steps; $i++)
	{
		$parms = explode(' ', $command[$i]);
		if ( $parms[0] == 'copy')
		{
			// write to the post-process script
			$command_file->modio_write('cp ' . $parms[1] . ' ' . $parms[2] . "\n");
			$command_bat->modio_write(str_replace('/', "\\", $command[$i]) . "\r\n");

			$split_from = explode('/', $parms[1]);
			$split_to = explode('/', $parms[2]);

			// set vars depending if this is a backup or a download file
			if ($split_to[0] == 'backups')
			{
				$from = $parms[1];
				$to = $parms[2];
				$type = $lang['EM_pp_backup'];
				$is_backup = true;
				$link = 'easymod_install.' . $phpEx . '?install_step=6&mode=backup&pw=' . md5($em_pass) . '&file=' . $parms[1];
			}
			else
			{
				$from = (strstr($parms[1],$install_path . 'processed/')) ? substr($parms[1],strlen($install_path . 'processed/')) : $parms[1];
				$to = $parms[2];
				$type = $lang['EM_pp_download'];
				$is_backup = false;
				$link = 'easymod_install.' . $phpEx . '?install_step=6&mode=file&pw=' . md5($em_pass) . '&file=' . $parms[2];
			}


///////////////////////
/////////////////////// using the $installer hack to get around a problem; need to fix correctly
///////////////////////
			// now the magic happens ;-)
			$ret_value = $command_file->modio_move( $parms[2], $parms[1], $mod_count, $link, $type, true);
			$mod_count++;

			// if there is no return value then that means it didn't work; print the err_msg and bail
			if ($ret_value == '')
			{
				$command_file->err_msg = $lang['EM_trace'] . ': main[3]->' . $command_file->err_msg;
				
				// if this is the first file in the chain and it fails, then halt processing altogether
				if ($i == 1)
				{
					handle_error(OPEN_FAIL_CRITICAL, $file_list, false, '<b>' . $lang['EM_err_critical_error'] . ':</b><br /> ' . $command_file->err_msg );
				}

				// otherwise print and error and continue on
				else
				{
					echo '<b>' . $lang['EM_err_critical_error'] . ':</b><br /> ' . $command_file->err_msg . '<br />' . $lang['EM_err_attempt_remainder'] . "<br /><br /><br />\n";
				}
			}

			// move was a success, display the output
			else
			{
				// if the destination is a backup, then list it as such
				if ($is_backup)
				{
					$ret_value .= '<input type="hidden" name="mode' .($mod_count-1). '" value="backup" />' . "\n";
					$bu_list[] = '<tr><td class="row1"  width="33%">' . $lang['EM_pp_backup'] . '</td><td class="row2" width="57%">' . $from . '</td><td class="row1" align="center" width="10%">' . $ret_value . "</td></tr>\n";
				}

				// list the file
				else
				{
					// we are only downloading modified files; not ones included with the MOD
					if (!(strstr($parms[1],$install_path . 'processed/')) && ($ret_value != '<b>' . $lang['EM_pp_complete'] . '</b>') && ($ret_value != '<b>' . $lang['EM_pp_ready'] . '</b>'))
					{
						$ret_value = '<b>' . $lang['EM_pp_manual'] . '</b>';
					}

					// if its a download then append the mode
					else if (strstr($ret_value, '<input'))
					{
						$ret_value .= '<input type="hidden" name="mode'.($mod_count-1).'" value="file" />'."\n";
					}

					$mv_list[] = '<tr><td class="row1" width="33%">' . $from . '</td><td class="row2" width="57%">' . $to . '</td><td class="row1" align="center" width="10%">' . $ret_value . "</td></tr>\n";
				}
			}
		}
	}

	// setup the form (whether needed or not)
	echo '<form action="easymod_install.' . $phpEx . '" name="install6" method="post">' . "\n";

	// print the backup list
	echo '<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">' . "\n";
	echo '<tr><th colspan="3">' . sprintf( $lang['EM_pp_backups'], $install_path . 'backups/') . '</th></tr>' . "\n";
	for ($i=0; $i<count($bu_list); $i++)
	{
		echo $bu_list[$i];
	}
	echo "</table><br />\n";

	// print the move list
	echo '<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">' . "\n";
	echo '<tr><th>' . sprintf( $lang['EM_pp_from'], $install_path . 'processed/') . '</th><th>' . $lang['EM_pp_to'] . '</th><th>' . $lang['EM_pp_status'] . "</th></tr>\n";
	for ($i=0; $i<count($mv_list); $i++)
	{
		echo $mv_list[$i];
	}
	echo "</table>\n";

	// finish the form
	echo '<input type="hidden" name="install_step" value="6" />' . "\n";
	echo '<input type="hidden" name="mod_count" value="' . $mod_count . '" />' . "\n";
	echo "</form>\n";


	// finish the script generation
	if ((!$command_file->modio_close( true)) || (!$command_bat->modio_close( true)))
	{
		$command_file->err_msg = $lang['EM_trace'] . ': main[4]->' . $command_file->err_msg;
		$error = '<br />' . $lang['EM_err_write_pp'] . '<br /> ' . $command_file->err_msg . "<br />\n";
		handle_error(OPEN_FAIL_CRITICAL, $file_list, false, $error);
	}

	// cleanup, this is really just for FTP so far
	$command_file->modio_cleanup('move');

	$hidden .= _em_hidden_field('sel_read', $read);
	$hidden .= _em_hidden_field('sel_write', $write);
	$hidden .= _em_hidden_field('sel_move', $move);

	$hidden .= _em_hidden_field('read_access', $read_access);
	$hidden .= _em_hidden_field('write_access', $write_access);
	$hidden .= _em_hidden_field('root_write', $root_write);
	$hidden .= _em_hidden_field('tmp_write', $tmp_write);
	$hidden .= _em_hidden_field('chmod_access', $chmod_access);
	$hidden .= _em_hidden_field('unlink_access', $unlink_access);
	$hidden .= _em_hidden_field('mkdir_access', $mkdir_access);
	$hidden .= _em_hidden_field('copy_access', $copy_access);

	$hidden .= _em_hidden_field('em_pass', $em_pass);
	$hidden .= _em_hidden_field('ftp_user', $ftp_user);
	$hidden .= _em_hidden_field('ftp_pass', $ftp_pass);
	$hidden .= _em_hidden_field('ftp_host', $ftp_host);
	$hidden .= _em_hidden_field('ftp_port', $ftp_port);
	$hidden .= _em_hidden_field('ftp_dir', $ftp_dir);
	$hidden .= _em_hidden_field('ftp_debug', $ftp_debug);
	$hidden .= _em_hidden_field('ftp_type', $ftp_type);
	$hidden .= _em_hidden_field('ftp_cache', $ftp_cache);

	echo "<br />\n";
	// print a warning if they aren't using an automated move method
	if (($move != 'copy') && ($move != 'ftpa'))
	{
		echo $lang['EM_move_files'] . "<br />\n";
	}

	form_settings($hidden, 7, $lang['EM_confirm'], false);
	page_footer();
	exit;

}


// test download file capability
else if ( $install_step == 5)
{
	header('Content-Type: text/x-delimtext; name="privmsg.'.$phpEx . '"');
	header('Content-disposition: attachment; filename="privmsg.'.$phpEx . '"');

	$file_test = new mod_io('privmsg.'.$phpEx, '', 'server', 'local', 'ftpm', '', '', '', $ftp_host, $ftp_port, $ftp_type, $ftp_cache);
	$file_test->modio_open();

	// replicate the file
	while (!feof($file_test->pread_file))
	{
		echo fgets( $file_test->pread_file, 4096);
	}

	// close the file
	$file_test->modio_close();
	exit;
}

//
// download a file or backup
//
else if ( $install_step == 6)
{
	$on_screen = false;

	// if we have a proper mode through GET VAR, then we are displaying to screen
	if (($mode == 'backup') || ($mode == 'file'))
	{
		$file = ( isset($HTTP_GET_VARS['file'])) ? stripslashes($HTTP_GET_VARS['file']) : '';
		$on_screen = true;
	}

	// otherwise we are downloading a file
	else
	{
		// they clicked a form button; we need to figure out which one so we know what file they are looking for
		$num_files = ( isset($HTTP_POST_VARS['mod_count'])) ? intval($HTTP_POST_VARS['mod_count']) : 0;

		// loop through all the submit buttons to see which one was pressed
		for ( $i=0; $i<=$num_files; $i++)
		{
			// if this is the button that was pressed then we are all set!  get the file name
			$var_name = 'submitfile' . $i;
			if ( isset($HTTP_POST_VARS[$var_name]))
			{
				$file = ( isset($HTTP_POST_VARS['file'.$i])) ? stripslashes($HTTP_POST_VARS['file'.$i]) : '';
				$mode = ( isset($HTTP_POST_VARS['mode'.$i])) ? stripslashes($HTTP_POST_VARS['mode'.$i]) : '';
				break;
			}
		}
	}


	// we'll need to look at the path and filename so split things up
	$split = explode('/', $file);

	// if a file, then make sure we have the filename correct
	if ($mode == 'file')
	{
		// by default the filename sent will match the one in the MOD script
		$process_file = (substr($file, 0, 9) == '../../../') ? substr($file, 9) : '';
		$orig_file = $process_file;

		// handle the special cases of a template file to download; only Default will appear in the MOD script
		if (($split[3] == 'templates') && ($split[4] != 'Default'))
		{
			$process_file = str_replace( $split[4], 'Default', $process_file);
		}

		// handle the special cases of a language file to download; only english will appear in the MOD script
		else if (($split[3] == 'language') && ($split[4] != 'lang_english'))
		{
			$process_file = str_replace( $split[4], 'lang_english', $process_file);
		}
	}

	// if a backup then we can assume the filename is valid
	else
	{
		$process_file = $file;
		$orig_file = $process_file;
	}


	// if there is no file to process then we are in trouble!
	if ( $process_file == '')
	{
		// just print a Plain Jane error, not all the debug info
		echo $lang['EM_err_no_process_file'] . "\n";
		exit;
	}


	// set up the screen for display
	if ($on_screen)
	{
		echo "<pre>\n";
	}

	// set up the redirects so we will download a file, the contents of which we will echo out
	else
	{
		header('Content-Type: text/x-delimtext; name="' . $split[count($split)-1] . '"');
		header('Content-disposition: attachment; filename="' . $split[count($split)-1] . '"');
	}


	// for a backup just dump out the file
	if ($mode == 'backup')
	{
		// open the core file
		if (!$read_file = fopen($process_file, 'r'))
		{
			// gotta echo out the message since message_die is not an option
			echo sprintf($lang['EM_err_backup_open'], $process_file) . "\n";
			exit;
		}

		// write out the lines
		while (!feof($read_file))
		{
			$newline = fgets($read_file, 4096);
			if ($on_screen)
			{
				echo htmlspecialchars($newline);
			}
			else
			{
				echo $newline;
			}
		}
		fclose($read_file);
	}
	else
	{
		$command_file = new mod_io('temp.sh', '', 'server', 'local', 'ftpm', '', '', '', $ftp_host, $ftp_port, $ftp_type, $ftp_cache);

		$find_array = array();
		$search_array = array();
		$search_array[] = "\$lang['Restore_DB']";
		$result = perform_find($file_list, $find_array, $search_array);
		handle_error($result, $file_list, true);

///////////////
/////////////// this should be doing all the checks done when building the lines
///////////////
		$insert  = "// EASYMOD-start\n";
		$insert .= "\$lang['MOD_ainstall'] = 'Install MODs';\n";
		$insert .= "\$lang['MOD_settings'] = 'EasyMOD Settings';\n";
		$insert .= "\$lang['MOD_history'] = 'EasyMOD History';\n";
		$insert .= "\$lang['MOD_control_tag'] = '" . $easymod_install_version . "';\n";
		$insert .= "// EASYMOD-end\n";
		write_find_array($find_array, $file_list);
		write_files($file_list, $insert);

		// unlikely that we will get a close error
		complete_file_reproduction($file_list);

		// make sure we have the right file
		for ($file=0; $file<count($file_list); $file++)
		{
			// make sure this is what we are looking for, otherwise keep looking
			if ($orig_file != ($file_list[$file]->path . $file_list[$file]->filename))
			{
				continue;
			}

			// write out the lines
			for ($i=0; $i<count($file_list[$file]->afile); $i++)
			{
				if ($on_screen)
				{
					echo htmlspecialchars($file_list[$file]->afile[$i]);
				}
				else
				{
					echo $file_list[$file]->afile[$i];
				}
			}

			// done! done! done!
			exit;
		}

		// didn't find the file!  OH CRAP!
		echo $lang['EM_err_modify'] . "\n";
	}

	// do a little clean up
	if ($on_screen)
	{
		echo "</pre>\n";
	}

	exit;
}

// confirmation
else if ($install_step == 7)
{
	page_header( $lang['EM_step5']);


	// if the error message is not empty after our tests, then we won't complete the install
	$error = '';


	//
	// confirm admin_easymod.php is in place and correct version
	//
	
	// let 'em know what we are doing
	echo '<br /><br /><b>' . $lang['EM_confirm_admin'] . ":</b> admin_easymod.php<br />\n";

	// open admin_easymod.php for reading
	$found = false;
	if ($fin = fopen('../../admin_easymod.'.$phpEx, 'r'))
	{
		// loop through file looking for key
		while (!feof( $fin))
		{
			// read a line and see if it contains our key
			$line = fgets($fin, 4096);
			if (strstr($line, 'admin_easymod.php'))
			{
				// print success and break out
				$found = true;
				echo '<span class="ok"><b>' . $lang['EM_confirmed'] . "</b></span><br />\n";
				break;
			}
		}
		fclose($fin);

		// if failed mark it and display error
		if (!$found)
		{
			$error = $lang['EM_err_find'] . ' <b>admin_easymod.php</b> [admin/admin_easymod.php].';
			display_error($error);
		}
	}
	else
	{
		$error = sprintf($lang['EM_modio_open_read'], 'admin/admin_easymod.php');
		display_error($error);
	}


	//
	// confirm mod_install.tpl is in place
	//
	
	// let 'em know what we are doing
	echo '<br /><br /><b>mod_install.tpl:</b> ' . $lang['EM_confirm_exist'] . "<br />\n";

	// see if the file exists
	if (file_exists('../../../templates/Default/admin/mod_install.tpl'))
	{
		// print success
		echo '<span class="ok"><b>' . $lang['EM_confirmed'] . "</b></span><br />\n";
	}
	else
	{
		// if failed mark it and display error
		$error = $lang['EM_err_find'] . ' [templates/Default/admin/mod_install.tpl].';
		display_error($error);
	}


	//
	// if failed, display debug info and break out
	//

	if ($error != '')
	{
		// tell them that EM is not properly installed and they will need to fix the above errors
		echo '<br /><br /><h2>' . $lang['EM_confirm_failed'] . "</h2>\n";
		echo '<strong>' . $lang['EM_confirm_fix'] . "</strong><br /><br /><br />\n";

		// display debug
		display_debug_info($error);
		echo "<br />\n";

		// get us out of here!
		exit;
	}


	//
	// if all in order, update the db to reflect that
	//

	echo "<br />\n";
	echo "<br />\n";
	echo "<br />\n";
	echo '<h2>' . $lang['EM_update_db'] . "</h2>\n";


	// update our EM config info
	echo '<strong>' . $lang['EM_store_entries'] . ": </strong>";

	// see if we have already made the EM entries
	$sql = "SELECT * 
		FROM " . CONFIG_TABLE . " 
		WHERE config_name = 'EM_version'";
	if ( !($result = $db->sql_query($sql)) )
	{
		handle_error(OPEN_FAIL_CRITICAL, $file_list, false, $lang['EM_err_config_table']);
	}
	$rows = $db->sql_numrows($result);
	$db->sql_freeresult($result);

	// added security starting in 0.0.11, md5 the em pass
	$em_md5 = md5($em_pass);

	// added security starting in 0.0.11, blowfish encrypt the ftp_pass
	$ftp_cipher = crypt_ftp_pass(EM_ENCRYPT, $ftp_pass, $em_pass);

	// if not, add the fields
	if ( $rows == 0)
	{
		em_db_insert('EM_version', $easymod_install_version);
		em_db_insert('EM_password', $em_md5);
		em_db_insert('EM_read', str_replace("'", "''", $read));
		em_db_insert('EM_write', str_replace("'", "''", $write));
		em_db_insert('EM_move', str_replace("'", "''", $move));
		em_db_insert('EM_ftp_dir', str_replace("'", "''", $ftp_dir));
		em_db_insert('EM_ftp_user', str_replace("'", "''", $ftp_user));
		em_db_insert('EM_ftp_pass', str_replace("'", "''", $ftp_cipher));
		em_db_insert('EM_ftp_host', str_replace("'", "''", $ftp_host));
		em_db_insert('EM_ftp_port', $ftp_port);
		em_db_insert('EM_ftp_type', str_replace("'", "''", $ftp_type));
		em_db_insert('EM_ftp_cache', $ftp_cache);
	}

	// if so, update the settings
	else
	{
		em_db_update('EM_version', $easymod_install_version);
		em_db_update('EM_password', $em_md5);
		em_db_update('EM_read', str_replace("'", "''", $read));
		em_db_update('EM_write', str_replace("'", "''", $write));
		em_db_update('EM_move', str_replace("'", "''", $move));
		em_db_update('EM_ftp_dir', str_replace("'", "''", $ftp_dir));
		em_db_update('EM_ftp_user', str_replace("'", "''", $ftp_user));
		em_db_update('EM_ftp_pass', str_replace("'", "''", $ftp_cipher));

		// 0.0.10a and later see if we have already made the EM_ftp_host field
		if (!add_new_config('EM_ftp_host', str_replace("'", "''", $ftp_host)))
		{
			handle_error(OPEN_FAIL_CRITICAL, $file_list, false, $lang['EM_err_config_table']);
		}

		// 0.0.14 and later see if we have already made the EM_ftp_port field
		if (!add_new_config('EM_ftp_port', $ftp_port))
		{
			handle_error(OPEN_FAIL_CRITICAL, $file_list, false, $lang['EM_err_config_table']);
		}

		// 0.0.10c and later see if we have already made the EM_ftp_type field
		if (!add_new_config('EM_ftp_type', str_replace("'", "''", $ftp_type)))
		{
			handle_error(OPEN_FAIL_CRITICAL, $file_list, false, $lang['EM_err_config_table']);
		}

		// 0.0.12 and later see if we have already made the EM_ftp_cache field
		if (!add_new_config('EM_ftp_cache', $ftp_cache))
		{
			handle_error(OPEN_FAIL_CRITICAL, $file_list, false, $lang['EM_err_config_table']);
		}
	}
	echo '<span class="OK"><b>' . $lang['EM_done'] . "</b></span><br />\n";
	echo "<br />\n";


	///
	/// Make an update to the EM table
	///

	unset($sql);
	$error_ary = array();
	$errored = false;
	
	$sql = 'INSERT INTO ' . EASYMOD_TABLE . " ( mod_title, mod_file, mod_version, mod_author_handle, mod_author_email, mod_author_name, mod_author_url, mod_description, mod_process_date, mod_phpBB_version, mod_processed_themes, mod_processed_langs, mod_files_edited, mod_tables_added, mod_tables_altered, mod_rows_inserted)
		VALUES ( 'EasyMOD', 'easymod/easymod_install." . $phpEx . "', '$easymod_install_version', 'Nuttzy', 'pktoolkit@blizzhackers.com', 'n/a', 'http://www.blizzhackers.com', 'EasyMOD automatically perfoms in seconds which previously required the tedious task of manually editing files.', " . time() . ", '$phpBB_version', '" . get_themes() . "', '" . get_languages( '../../../language') . "', 0, 1, 0, 1)";

	echo '<b>' . $lang['EM_exec_sql'] . ": </b>$sql<br />\n";
	echo '<p>' . $lang['EM_progress'] . ' :: <b>';
	flush();

	_sql($sql, $errored, $error_ary);

	// save the new record id for later use.
	$mod_id = $db->sql_nextid();

	echo '</b> <b class="ok">' . $lang['EM_done'] . '</b><br />' . $lang['EM_result'] . " &nbsp; :: \n";

	if ( $errored )
	{
		echo ' <b>' . $lang['EM_failed_sql'] . "</b>\n<ul>";

		for($i = 0; $i < count($error_ary['sql']); $i++)
		{
			echo '<li>' . $lang['EM_err_error'] . ' :: <b>' . $error_ary['error_code'][$i]['message'] . "</b><br />\n";
			echo "SQL &nbsp; :: <b>" . $error_ary['sql'][$i] . "</b><br /><br /></li>\n";
		}
		echo "</ul>\n"; 
		handle_error(OPEN_FAIL_CRITICAL, $file_list, false, "<p>" . $lang['EM_do_worry'] . "</p>\n");
	}
	else
	{
		echo '<b>' . $lang['EM_no_errors'] . "</b>\n";
	}


	// populate the processed files table
	echo "<br /><br /><strong>" . $lang['EM_store_files'] . "</strong><br />\n<br />\n";

	// If we're upgrading, then there might be data here already
	$sql_test = 'SELECT COUNT(*) AS cnt FROM ' . EASYMOD_PROCESSED_FILES_TABLE;
	if( !($result = $db->sql_query($sql_test)) )
	{
		handle_error(OPEN_FAIL_CRITICAL, $file_list, false, "<p>" . $lang['EM_err_em_info'] . "</p>\n");
	}
	$epf_count = $db->sql_fetchrow($result);
	$epf_count = intval($epf_count['cnt']);

	$sql = array();

	if( $epf_count > 0 )
	{
		// if we found records here, that means we have all data from all previously processed MODs
		// all we have to do is add a new record corresponding to this version of EM.
		$processed_file = "admin/admin_easymod.$phpEx";
		$sql[] = 'INSERT INTO ' . EASYMOD_PROCESSED_FILES_TABLE . " (mod_processed_file, mod_id)
			VALUES ('" . $processed_file . "', " . $mod_id . ")";
		// Note $mod_id was stored just after inserting the the record for this EM installation.
	}
	else
	{
		// if NO records were found here, that means:
		// a) this is a new EM installation.
		// b) we are upgrading to the first EM version capable of recording processed files.
		// The same logic applies to both scenarios. We have to parse all MODs found in the main
		// EM table (there would be just one if its a new installation or many if it's an upgrade).
		$sql_test = 'SELECT mod_id, mod_title, mod_file
			FROM ' . EASYMOD_TABLE . '
			ORDER BY mod_id';
		if( !($result = $db->sql_query($sql_test)) )
		{
			handle_error(OPEN_FAIL_CRITICAL, $file_list, false, "<p>" . $lang['EM_err_em_info'] . "</p>\n");
		}
		$em_rows = $db->sql_fetchrowset($result);
		$em_count = count($em_rows);

		// for each MOD we'll read its 'post_process.bat' file to get
		// its list of processed files from there.
		for( $i = 0; $i < $em_count; $i++ )
		{
			if( $em_rows[$i]['mod_title'] == 'EasyMOD' )
			{
				$processed_file = "admin/admin_easymod.$phpEx";
				$sql[] = 'INSERT INTO ' . EASYMOD_PROCESSED_FILES_TABLE . " (mod_processed_file, mod_id)
					VALUES ('" . $processed_file . "', " . $em_rows[$i]['mod_id'] . ")";
				continue;
			}

			// current working directory is admin/mods/easymod, so we should be able to reach MODs like this:
			$post_process_bat = dirname('../' . $em_rows[$i]['mod_file']) . '/post_process.bat';

			// Ignore errors when reading 'post_process.bat' files
			if( @file_exists($post_process_bat) && ($read_file = @fopen($post_process_bat, 'r')) )
			{
				while( !feof($read_file) )
				{
					$newline = fgets($read_file, 4096);
					$parms = explode(' ', str_replace(array('\\', "\n", "\r"), array('/', '', ''), $newline));
					if( $parms[0] == 'copy' )
					{
						$split_to = explode('/', $parms[2]);
						if( $split_to[0] == 'backups' )
						{
							$processed_file = (substr($parms[1], 0, 9) == '../../../') ? substr($parms[1], 9) : $parms[1];
							$sql[] = 'INSERT INTO ' . EASYMOD_PROCESSED_FILES_TABLE . " (mod_processed_file, mod_id)
								VALUES ('" . $processed_file . "', " . $em_rows[$i]['mod_id'] . ")";
						}
					}
				}
				@fclose($read_file);
			}
		}
	}

	echo '<b>' . $lang['EM_exec_sql'] . ": </b><br />\n";
	for($i = 0; $i < count($sql); $i++)
	{
		echo "$sql[$i]<br />\n";
	}

	echo '<p>' . $lang['EM_progress'] . ' :: <b>';
	flush();

	$error_ary = array();
	$errored = false;
	for($i = 0; $i < count($sql); $i++)
	{
		_sql($sql[$i], $errored, $error_ary);
	}

	echo '</b> <b class="ok">' . $lang['EM_done'] . '</b><br />' . $lang['EM_result'] . " &nbsp; :: \n";

	if ( $errored )
	{
		echo ' <b>' . $lang['EM_failed_sql'] . "</b>\n<ul>";

		for($i = 0; $i < count($error_ary['sql']); $i++)
		{
			echo '<li>' . $lang['EM_err_error'] . ' :: <b>' . $error_ary['error_code'][$i]['message'] . "</b><br />\n";
			echo "SQL &nbsp; :: <b>" . $error_ary['sql'][$i] . "</b><br /><br /></li>\n";
		}
		echo "</ul>\n<p>" . $lang['EM_no_worry'] . "</p>\n";
	}
	else
	{
		echo '<b>' . $lang['EM_no_errors'] . "</b>\n";
	}

	// move protective .htaccess file into place
	$type = $lang['EM_pp_download'];
	$link = 'easymod_install.' . $phpEx . '?install_step=6&mode=file&pw=' . md5($em_pass) . '&file=../../../admin/mods/.htaccess';
	$io = new mod_io('post_process.sh', '', $read, $write, $move, $ftp_user, $ftp_pass, $ftp_dir, $ftp_host, $ftp_port, $ftp_type, $ftp_cache);
	$io->modio_prep('move');
	$io->modio_move('../../../admin/mods/.htaccess', 'includes/htaccess.txt', 1, $link, $type);
	echo '<br /><br /><strong>' . $lang['EM_move_htaccess'] . '</strong>: <b class="ok">' . $lang['EM_done'] . "</b>\n";

	//
	// congratufuckinglations
	//
	echo "<br />\n";
	echo "<br />\n";
	echo '<br /><br /><h2><span class="ok"><b>' . $lang['EM_install_completed'] . "</b></span></h2>\n";
	echo '<p>' . sprintf($lang['EM_admin_panel'], append_sid($phpbb_root_path . 'index.' . $phpEx)) . "</p><br />";

	page_footer();
	exit;
}


// this should never happen!!
else
{
	echo $lang['EM_err_no_step'] . "<br />\n";
	exit;
}

?>