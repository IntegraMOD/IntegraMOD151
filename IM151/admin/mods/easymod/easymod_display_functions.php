<?php
/***************************************************************************
 *                             easymod_display_functions.php
 *                            -------------------------------
 *   begin                : Wednesday, November 26, 2003
 *   copyright            : (C) 2002-2004 by Nuttzy - Craig Nuttall, 2005 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: easymod_display_functions.php,v 1.27 2007/02/22 03:32:20 wgeric Exp $
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


// ---------
// FUNCTIONS
//


// my own cheese-o-matic template system
//   anthing within {{}} is a template variable
//   anything within {{[]}} is an include tpl to be further processed
//   error handling is completely lacking so don't use this outside of EM ;-)
function display_template( $template_file, $variables)
{
	global $lang;

	// make sure the tpl file exists
	if (!file_exists( $template_file))
	{
		echo '<h1><span class="ok">' . sprintf($lang['EM_err_no_tpl'], $template_file) . "</span></h1>\n";
		exit;
	}

	// open the template file for readin
	$template = fopen( $template_file, 'r');

	// look through the file, displaying each line to the screen
	while (!feof( $template))
	{
		// get a line from the file
		$line = fgets( $template, 4096);

		// see if there is a template variable on this line
		$prev_endpos = 0;
		$pos = strpos( $line, '{{')+2;
		$endpos = (strlen($line) > 2 ) ? strpos( $line, '}}', $pos)-1 : $pos;

		// for some reason I couldn't get strpos to work correctly for me (even using === syntax)
		$start_var = (substr( $line, 0, 2) == '{{') ? true : false;

		// if we found a varibale, then fill it in and see if there are more on this line as well;
		//   pos will always be at least 2; if so then this means we either have no variable, or a variable starting
		//   at the beginning of the line
		if (($pos > 2) || ($start_var))
		{
			// check the entire line until we don't find more vars
			while (($pos > 2) || ($start_var))
			{
				// display the line up to and including the variable
				$start_var = false;
				$var = substr($line, $pos, $endpos-$pos+1);

				// see if this is an included file (will start with [ and stop with ])
				if ((substr($var, 0, 1) == '[') && (substr($var, strlen($var)-1, 1) == ']'))
				{
					// print the portion of the line up to this point
					echo substr( $line, $prev_endpos, (($pos-2)-$prev_endpos));

					// welcome to the wonderful world of recursion :D
					display_template( substr($var, 1, strlen($var)-2), $variables);
				}

				// a normal variable
				else
				{
					$display_var = (isset($variables[$var])) ? $variables[$var] : '';
					echo substr( $line, $prev_endpos, (($pos-2)-$prev_endpos)) . $display_var;
				}

				// get the next variable, if there is one
				$prev_endpos = $endpos+3;
				$pos = strpos( $line, '{{', $prev_endpos)+2;
				$endpos = strpos( $line, '}}', $pos)-1;
			}

			// display the rest of the line
			echo substr( $line, $prev_endpos);
		}

		// no template variable on this line, so just right it out
		else
		{
			echo $line;
		}
	}
	// clean up ;-)
	fclose( $template);
}


// write the top of the page
function page_header( $text, $simple=false)
{
	global $lang, $easymod_install_version, $phpbb_root_path, $script_path;

	$variables = array();
	$variables['TITLE'] = sprintf($lang['EM_installing_beta'], $easymod_install_version);
	$variables['TEXT'] = $text;

	display_template( $phpbb_root_path . $script_path . 'templates/page_start.tpl', $variables);
	if (!$simple)
	{
		display_template( $phpbb_root_path . $script_path . 'templates/page_header.tpl', $variables);
	}

	// add the helpwin javascript and then options form
	helpwin();
}


// write the footer HTML
function page_footer()
{
	global $install_step, $write, $move, $ftp_dir, $ftp_user, $ftp_pass, $ftp_host, $ftp_port, $ftp_debug, $ftp_type, $lang, $phpEx, $phpbb_root_path, $script_path;

/////////////////////////
/////////////////////////
///////////////////////// what about ? and & ???? - i really think there is a better way to do this
/////////////////////////
/////////////////////////
	// we have to fix the password so it does not have a # in it or else the link won't work
	$ftp_pass = str_replace('#', '~pound~', $ftp_pass);
	$link = append_sid("easymod_install.$phpEx?mode=debug&amp;install_step=$install_step&amp;write=$write&amp;move=$move&amp;ftp_dir=$ftp_dir&amp;ftp_user=$ftp_user&amp;ftp_pass=$ftp_pass&amp;ftp_host=$ftp_host&amp;ftp_port=$ftp_port&amp;ftp_debug=$ftp_debug&amp;ftp_type=$ftp_type");

	$variables = array();
	$variables['LINK'] = $link;
	$variables['DEBUG'] = $lang['EM_debug_display'];

	display_template( $phpbb_root_path . $script_path . 'templates/page_footer.tpl', $variables);
}


// allow for the ability to pop open a sub window
function helpwin($width=400, $height=300)
{
	global $phpbb_root_path, $script_path;

	$variables = array();
	$variables['WIDTH'] = $width;
	$variables['HEIGHT'] = $height;

	display_template( $phpbb_root_path . $script_path . 'templates/helpwin.tpl', $variables);
}


// the files access and ftp data form
function form_settings( $hidden, $step, $main_button, $rescan)
{
	global $phpEx, $lang, $phpbb_root_path, $script_path;

	$variables = array();
	$variables['U_FORM'] = append_sid($phpbb_root_path . $script_path . 'easymod_install.'.$phpEx);
	$variables['STEP'] = $step;
	$variables['HIDDEN'] = $hidden;
	$variables['MAIN'] = ($main_button == '') ? '' : '<input class="mainoption" type="submit" value="' . "$main_button\" />&nbsp;";
	$variables['RESCAN'] = (!$rescan) ? '' : '<input class="mainoption" type="submit" value="' . $lang['Rescan'] . '" name="rescan"/>';

	display_template( $phpbb_root_path . $script_path . 'templates/form_settings.tpl', $variables);
}


// neatly format the debug info we've gathered
function display_debug_html( $variables, $access, $values)
{
	global $lang, $easymod_install_version, $install_step, $mode, $write, $move, $ftp_user, $ftp_pass, $ftp_host, $ftp_port, $ftp_dir, $ftp_debug, $ftp_type, $ftp_cache, $phpbb_root_path, $script_path;

	// assign template data
//	$variables = array();
	$variables['EM_debug_info'] = $lang['EM_debug_info'];
	$variables['EM_debug_format'] = $lang['EM_debug_format'];
	$variables['EM_debug_installer'] = $lang['EM_debug_installer'];
	$variables['EM_phpBB_version'] = $lang['EM_phpBB_version'];
	$variables['EM_debug_work_dir'] = $lang['EM_debug_work_dir'];
	$variables['EM_debug_step'] = $lang['EM_debug_step'];
	$variables['EM_debug_mode'] = $lang['EM_debug_mode'];
	$variables['EM_debug_the_error'] = $lang['EM_debug_the_error'];
	$variables['EM_debug_permissions'] = $lang['EM_debug_permissions'];
	$variables['EM_debug_sys_errors'] = $lang['EM_debug_sys_errors'];
	$variables['EM_read_access'] = $lang['EM_read_access'];
	$variables['EM_write_access'] = $lang['EM_write_access'];
	$variables['EM_root_write'] = $lang['EM_root_write'];
	$variables['EM_chmod_access'] = $lang['EM_chmod_access'];
	$variables['EM_unlink_access'] = $lang['EM_unlink_access'];
	$variables['EM_mkdir_access'] = $lang['EM_mkdir_access'];
	$variables['EM_tmp_write'] = $lang['EM_tmp_write'];
	$variables['EM_ftp_ext'] = $lang['EM_ftp_ext'];
	$variables['EM_copy_access'] = $lang['EM_copy_access'];
	$variables['EM_debug_recommend'] = $lang['EM_debug_recommend'];
	$variables['EM_debug_write'] = $lang['EM_debug_write'];
	$variables['EM_debug_move'] = $lang['EM_debug_move'];
	$variables['EM_debug_selected'] = $lang['EM_debug_selected'];
	$variables['EM_debug_write'] = $lang['EM_debug_write'];
	$variables['EM_debug_move'] = $lang['EM_debug_move'];
	$variables['EM_debug_ftp_dir'] = $lang['EM_debug_ftp_dir'];
	$variables['EM_debug_ftp_host'] = $lang['EM_debug_ftp_host'];
	$variables['EM_debug_ftp_port'] = $lang['EM_debug_ftp_post'];
	$variables['EM_debug_ftp_debug'] = $lang['EM_debug_ftp_debug'];
	$variables['EM_debug_ftp_ext'] = $lang['EM_debug_ftp_ext'];
	$variables['EM_debug_ftp_cache'] = $lang['EM_debug_ftp_cache'];
	$variables['EM_debug_listing'] = $lang['EM_debug_listing'];

	$variables['EM_VERSION'] = $easymod_install_version;
	$variables['PHPBB_VERSION'] = get_phpbb_version();
	$variables['CWD'] = dirname(__FILE__);
	$variables['STEP'] = $install_step;
	$variables['MODE'] = $mode;
	$variables['ERROR'] = $values['error'];
	$variables['WRITE_REC'] = $values['write_rec'];
	$variables['MOVE_REC'] = $values['move_rec'];
	$variables['WRITE_SEL'] = $write;
	$variables['MOVE_SEL'] = $move;
	$variables['FTP_DIR'] = $ftp_dir;
	$variables['FTP_HOST'] = $ftp_host;
	$variables['FTP_PORT'] = $ftp_port;
	$variables['FTP_DEBUG'] = ($ftp_debug) ? 'true' : 'false';
	$variables['FTP_EXT'] = $ftp_type;
	$variables['FTP_CACHE'] = ($ftp_cache) ? 'true' : 'false';
	$variables['FILE_LISTING'] = $values['file_listing'];

	// Added in 0.3.0
	global $board_config;
	if (empty($board_config['EM_version']))
	{
		$variables['L_EM_STATUS'] = $lang['EM_EM_status'];
		$variables['EM_STATUS'] = $lang['EM_new_install'];
	}
	else
	{
		$variables['L_EM_STATUS'] = $lang['EM_update_from'];
		$variables['EM_STATUS'] = $board_config['EM_version'];
	}
	$variables['L_EM_PHP_sysinfo'] = $lang['EM_PHP_sysinfo'];
	$variables['L_EM_PHP_system'] = $lang['EM_PHP_system'];
	$variables['L_EM_PHP_config'] = $lang['EM_PHP_config'];
	$variables['L_EM_PHP_version'] = $lang['EM_PHP_version'];
	$variables['PHP_system'] = htmlspecialchars(em_get_phpinfo_data('system'));
	$variables['PHP_config'] = htmlspecialchars(em_get_phpinfo_data('configure command'));
	$variables['PHP_version'] = phpversion();
	$variables['PHP_register_globals'] = (@ini_get('register_globals') == '1' || strtolower(@ini_get('register_globals')) == 'on' ? $lang['EM_on'] : $lang['EM_off']);
	$variables['PHP_magic_quotes_gpc'] = (get_magic_quotes_gpc() ? $lang['EM_on'] : $lang['EM_off']);
	$variables['PHP_magic_quotes_runtime'] = (get_magic_quotes_runtime() ? $lang['EM_on'] : $lang['EM_off']);
	$variables['PHP_allow_url_fopen'] = (@ini_get('allow_url_fopen') == '1' || strtolower(@ini_get('allow_url_fopen')) == 'on' ? $lang['EM_on'] : $lang['EM_off']);
	$variables['PHP_sockets_support'] = htmlspecialchars(em_get_phpinfo_data('sockets support'));

	display_template( $phpbb_root_path . $script_path . 'templates/display_debug.tpl', $variables);

	// check FTP compatiblity
	if (( $write == 'ftpb') || ($move == 'ftpa'))
	{
		// test the ftp connection
		$test_report = '';
		$test_result = capture_test_ftp($ftp_user, $ftp_pass, $ftp_dir, $ftp_host, $ftp_port, true, $ftp_type, $ftp_cache, $test_report);
		echo $test_report;
		if( $test_result )
		{
			echo '<br />[b]<b>' . $lang['EM_debug_ftp_test'] . '</b>[/b] :: [b][color=green]<b class="ok">' . $lang['EM_debug_success']. "</b>[/color][/b]<br />\n";
		}
	}
	else
	{
		echo '<br /><br />[b]<b>' . $lang['EM_debug_ftp_notest'] . "</b>[/b]<br />\n";
	}

	display_template( $phpbb_root_path . $script_path . 'templates/display_debug_footer.tpl', $variables);
}

// extract information from phpinfo output
function em_get_phpinfo_data($query)
{
	global $lang;

	ob_start();
	phpinfo();
	$phpinfo = ob_get_contents();
	ob_end_clean();

	if( preg_match('#<tr\s*.*?><td\s*.*?>\s*'.$query.'\s*</td><td\s*.*?>\s*(.*?)\s*</td>#i', $phpinfo, $match) && !empty($match[1]) )
	{
		return $match[1];
	}
	return $lang['EM_not_avail'];
}

// display the debug info; can be called from handle error or from any page just to get info
function display_debug_info( $err_msg = '')
{
	global $lang, $write, $move;

	$values = array();
	if ($err_msg == '')
	{
		$values['error'] = '[color=green][b]' . $lang['EM_debug_no_error'] . '[/b][/color]';
	}
	else
	{
		$values['error'] = '[color=red]' . $err_msg . '[/color]';
	}

	$variables = array();
	$access = array();
	get_file_access_info( $variables, $access, true);

	// choose the best selection as default
	$can_write = (($access['write_access']) && ($access['mkdir_access'])) ? true : false;
	$values['write_rec'] = ($can_write) ? $lang['EM_write_server'] : $lang['EM_write_ftp'];

	// choose the best selection as default
	if (($values['write_rec'] != $lang['EM_write_server']) && ($values['write_rec'] != $lang['EM_write_ftp']))
	{
		// can't write on the server, so must manually move
		$values['move_rec'] = $lang['EM_move_manual'];
	}
	else
	{
		// either copy or suggest FTP; never suggest exec b/c i don't want to explain it tp dumbasses ;-)
		$values['move_rec'] = (($access['root_write']) && ($access['copy_access']) && ($can_write)) ? $lang['EM_move_copy'] : $lang['EM_move_ftp'];
	}

	$values['file_listing'] = '';
	if ($dh = opendir(dirname(__FILE__)))
	{
		while (($file = readdir($dh)) !== false)
		{
			$values['file_listing'] .= mfunGetPerms(fileperms( $file)) . " $file <br />\n";
		}
		closedir($dh);
	}

	display_debug_html( $variables, $access, $values);
}


// display the error message in a nicely formatted box
function display_error( $error)
{
	global $lang, $phpbb_root_path, $script_path;

	// assign template data
	$variables = array();
	$variables['EM_err_error'] = $lang['EM_err_error'];
	$variables['ERROR'] = $error;

	display_template( $phpbb_root_path . $script_path . 'templates/display_error.tpl', $variables);
}


// used for error reporting on OPEN and FIND
function handle_error($result, $file_list, $close_files, $error = '', $skip_debug = false)
{
	// if we didn't get an OK, then we are automatically aborting
	if ( $result != OPEN_OK)
	{
		// close up files, just to be neat
		if ($close_files)
		{
			// don't worry if a problem with close since we are definitely bailing anyway
			complete_file_reproduction( $file_list);
		}

		// handle case where we are sending a non-file specific error
		if ($error != '')
		{
			display_error( $error);
		}

		// loop through all files; print errors
		for ($err=0; $err<count($file_list); $err++)
		{
			// if there is an error message for this file then print it
			if ($file_list[$err]->err_msg != '')
			{
				$error = $file_list[$err]->err_msg;
				display_error( $error);
			}
		}

		// display debug info unless told otherwise
		if (!$skip_debug)
		{
			display_debug_info( $error);
			echo "<br />\n";
		}
		// no printing debug do print the footer
		else
		{
			page_footer();
		}

		// get us out of here!
		exit;
	}
}


//
// Pick a language, any language ...
//
function em_language_select($default, $select_name='language', $dirname='admin/mods/easymod/languages')
{
	global $phpEx, $phpbb_root_path;

	$dir = opendir($phpbb_root_path . $dirname);

	$EM_lang = array();
	while ( $file = readdir($dir) )
	{
		if (preg_match('#^lang_easymod_#i', $file) && is_file(@phpbb_realpath($phpbb_root_path . $dirname . '/' . $file)) && !is_link(@phpbb_realpath($phpbb_root_path . $dirname . '/' . $file)))
		{
			$filecode = substr($file, 13, strpos($file, '.')-13);
			include @phpbb_realpath($phpbb_root_path . $dirname . '/lang_easymod_' . $filecode . '.' .$phpEx);
			$displayname = $lang['EM_lang_name'];
			$EM_lang[$displayname] = $filecode;
		}
	}

	closedir($dir);

	@asort($EM_lang);
	@reset($EM_lang);

	$EM_lang_select = '<select name="' . $select_name . '">';
	while ( list($displayname, $filecode) = @each($EM_lang) )
	{
		$selected = ( strtolower($default) == strtolower($filecode) ) ? ' selected="selected"' : '';
		$EM_lang_select .= '<option value="' . $filecode . '"' . $selected . '>' . ucwords($displayname) . '</option>';
	}
	$EM_lang_select .= '</select>';

	return $EM_lang_select;
}


function get_install_info( &$variables, $prev_em_version)
{
	global $phpEx, $lang, $easymod_install_version, $phpBB_version, $phpbb_root_path, $script_path, $language;

	$variables['U_FORM'] = append_sid($phpbb_root_path . $script_path . 'easymod_install.' . $phpEx);
	$variables['EM_Install_Info'] = $lang['EM_Install_Info'];
	$variables['EM_Select_Language'] = $lang['EM_Select_Language'];
	$variables['EM_Database_type'] = $lang['EM_Database_type'];
	$variables['EM_phpBB_version'] = $lang['EM_phpBB_version'];
	$variables['EM_EasyMOD_version'] = $lang['EM_easymod_version'];

	$variables['LANG_OPTIONS'] = em_language_select($language, 'language');
	$variables['GO'] = $lang['Go'];
	$variables['SQL_LAYER'] = SQL_LAYER;
	$variables['PHPBB_VERSION'] = $phpBB_version;
	$variables['EM_VERSION'] = $easymod_install_version;
	if ($prev_em_version == '')
	{
		$variables['L_EM_STATUS'] = $lang['EM_EM_status'];
		$variables['STATUS'] = $lang['EM_new_install'];
	}
	else
	{
		$variables['L_EM_STATUS'] = $lang['EM_update_from'];
		$variables['STATUS'] = $prev_em_version;
	}
}


function get_file_access_info( &$variables, &$access, $bbcode=false)
{
	global $lang;

	// we'll handle our on errors
	$old_error_reporting = error_reporting(0);
	$access_msg = '';
	$read_failure = '';
	$ftp_msg = '';
	$safe_msg = '';
	$access = array( 'read_access', 'write_access', 'root_write', 'tmp_write', 'ftp_ext', 'copy_access', 'chmod_access', 'unlink_access', 'mkdir_access', 'safe_mode');

	$variables['EM_File_Access'] = ($bbcode) ? '' : $lang['EM_File_Access'];
	$variables['EM_no_problem'] = ($bbcode) ? '' : $lang['EM_see_file_access'] . '<br /><br />';
	$variables['EM_read_access'] = $lang['EM_read_access'];
	$variables['EM_write_access'] = $lang['EM_write_access'];
	$variables['EM_root_write'] = $lang['EM_root_write'];
	$variables['EM_chmod_access'] = $lang['EM_chmod_access'];
	$variables['EM_unlink_access'] = $lang['EM_unlink_access'];
	$variables['EM_mkdir_access'] = $lang['EM_mkdir_access'];
	$variables['EM_tmp_write'] = $lang['EM_tmp_write'];
	$variables['EM_ftp_ext'] = $lang['EM_ftp_ext'];
	$variables['EM_safe_mode'] = $lang['Safe_mode'];
	$variables['EM_copy_access'] = $lang['EM_copy_access'];

	// check for basic access permissions
	$access['read_access'] = check_access_read( $read_failure);
	$access['write_access'] = check_access_write( $access_msg);
	$access['root_write'] = check_access_write_root( $access_msg);
	$access['tmp_write'] = check_access_write_tmp( $access_msg);
	$access['ftp_ext'] = check_access_ftp_ext( $ftp_msg);
	$access['safe_mode'] = check_access_safe_mode( $safe_msg);
	$access['copy_access'] = check_access_copy( $access_msg);

	// get ready to display bbcode tags if desired
	if ($bbcode)
	{
		$ok_msg = '[b][color=green]<b class="ok">' . $lang['EM_ok'] . '</b>[/color][/b]';
		$okparms = '[b][color=green]<b class="ok">%s</b>[/color][/b]';
		$no_msg = '[b]<b>' . $lang['EM_no'] . '</b>[/b]';
		$noparms = '[b]<b>%s</b>[/b]';
	}
	else
	{
		$ok_msg = '<b class="ok">' . $lang['EM_ok'] . '</b>';
		$okparms = '<b class="ok">%s</b>';
		$no_msg = '<b>' . $lang['EM_no'] . '</b>';
		$noparms = '<b>%s</b>';
	}

	// define template variables
	$variables['ACCESS_READ'] = ($access['read_access']) ? $ok_msg : $no_msg;
	$variables['ACCESS_WRITE'] = ($access['write_access']) ? $ok_msg : $no_msg;
	$variables['ACCESS_ROOT'] = ($access['root_write']) ? $ok_msg : $no_msg;
	$variables['ACCESS_TMP'] = ($access['tmp_write']) ? $ok_msg : $no_msg;
	$variables['ACCESS_FTP'] = ($access['ftp_ext']) ? sprintf( $okparms, $ftp_msg) : sprintf( $noparms, $ftp_msg);
	$variables['ACCESS_SAFE'] = ($access['safe_mode']) ? sprintf( $okparms, $safe_msg) : sprintf( $noparms, $safe_msg);
	$variables['ACCESS_COPY'] = ($access['copy_access']) ? $ok_msg : $no_msg;

	// don't even try chmod and unlink if we can't even write
	if (!$access['write_access'])
	{
		$access['chmod_access'] = false;
		$access['unlink_access'] = false;
		$access['mkdir_access'] = false;
		$variables['ACCESS_CHMOD'] = $lang['EM_unattempted'];
		$variables['ACCESS_UNLINK'] = $lang['EM_unattempted'];
		$variables['ACCESS_MKDIR'] = $lang['EM_unattempted'];
	}

	// check for chmod, unlink, and mkdir access (if we have write access)
	else
	{
		// check for server chmod access
		$access['chmod_access'] = check_access_chmod( $access_msg);
		$variables['ACCESS_CHMOD'] = ($access['chmod_access']) ? $ok_msg : $no_msg;

		// check for server unlink access
		$access['unlink_access'] = check_access_unlink( $access_msg);
		$variables['ACCESS_UNLINK'] = ($access['unlink_access']) ? $ok_msg : $no_msg;

		// check for server mkdir access
		$access['mkdir_access'] = check_access_mkdir( $access_msg);
		$variables['ACCESS_MKDIR'] = ($access['mkdir_access']) ? $ok_msg : $no_msg;
	}

	// restore error handling
	error_reporting($old_error_reporting);

	return $read_failure;
}


function get_ftp_settings( &$variables, $access)
{
	global $lang;

	$variables['EM_ftp_title'] = $lang['EM_ftp_title'];
	$variables['EM_ftp_desc'] = $lang['EM_ftp_desc'];
	$variables['EM_ftp_dir'] = $lang['EM_ftp_dir'];
	$variables['DIR_EX'] = 'ex: public_html/phpBB2';			// hard coded
	$variables['EM_ftp_user'] = $lang['EM_ftp_user'];
	$variables['EM_ftp_pass'] = $lang['EM_ftp_pass'];
	$variables['EM_ftp_host'] = $lang['EM_ftp_host'];
	$variables['EM_ftp_host_info'] = $lang['EM_ftp_host_info'];
	$variables['EM_ftp_port'] = $lang['EM_ftp_port'];
	$variables['EM_ftp_port_info'] = $lang['EM_ftp_port_info'];
	$variables['EM_ftp_debug'] = $lang['EM_ftp_debug'];
	$variables['EM_yes'] = $lang['EM_yes'];
	$variables['EM_no'] = $lang['EM_no'];
	$variables['EM_ftp_debug_not'] = $lang['EM_ftp_debug_not'];
	$variables['EM_ftp_advance_settings'] = $lang['EM_ftp_advance_settings'];
	$variables['EM_ftp_use_ext'] = $lang['EM_ftp_use_ext'];
	$variables['EM_ftp_ext_not'] = $lang['EM_ftp_ext_not'];
	$variables['EM_ftp_use_cache'] = $lang['EM_ftp_cache'];
	$variables['EM_more_info'] = $lang['EM_more_info'];

	$ftp_ext_message = '';
	$ftp_ext_close = '';
	$ftp_cache_message = '';
	$ftp_cache_close = '';
	$ext_yes = '';
	$ext_no = 'checked="checked"';
	$cache_yes = '';
	$cache_no = 'checked="checked"';

	// we only want to display the FTP Ext option if their server can handle it
	if (!$access['ftp_ext'])
	{
		$ftp_ext_message = "&nbsp;" . $lang['EM_ftp_ext_noext'] . "\n<!-- \n";
		$ftp_ext_close = "-->\n";
		$ftp_cache_message = "&nbsp;" . $lang['EM_ftp_ext_noext'] . "\n<!-- \n";
		$ftp_cache_close = "-->\n";
	}
	else if (!$access['tmp_write'])
	{
		$cache_yes = 'checked="checked"';
		$cache_no = '';
	}
	else if (($access['ftp_ext']) && ($access['tmp_write']))
	{
		$ext_yes = 'checked="checked"';
		$ext_no = '';
	}

	$variables['FTP_EXT_MSG'] = $ftp_ext_message;
	$variables['FTP_EXT_CLOSE'] = $ftp_ext_close;
	$variables['FTP_CACHE_MSG'] = $ftp_ext_message;
	$variables['FTP_CACHE_CLOSE'] = $ftp_ext_close;
	$variables['EXT_YES'] = $ext_yes;
	$variables['EXT_NO'] = $ext_no;
	$variables['CACHE_YES'] = $cache_yes;
	$variables['CACHE_NO'] = $cache_no;
}


function get_empw_settings( &$variables)
{
	global $lang;

	$variables['EM_password_title'] = $lang['EM_password_title'];
	$variables['EM_password_desc'] = $lang['EM_password_desc'];
	$variables['EM_password_set'] = $lang['EM_password_set'];
	$variables['EM_password_confirm'] = $lang['EM_password_confirm'];
}


function get_hidden_data( &$variables, $access)
{
	global $language;

	$variables['READ_ACCESS'] = $access['read_access'];
	$variables['WRITE_ACCESS'] = $access['write_access'];
	$variables['ROOT_WRITE'] = $access['root_write'];
	$variables['TMP_WRITE'] = $access['tmp_write'];
	$variables['CHMOD_ACCESS'] = $access['chmod_access'];
	$variables['UNLINK_ACCESS'] = $access['unlink_access'];
	$variables['MKDIR_ACCESS'] = $access['mkdir_access'];
	$variables['COPY_ACCESS'] = $access['copy_access'];
	$variables['LANGUAGE'] = $language;
}


function check_installablity()
{
	global $db, $lang, $easymod_install_version, $phpbb_root_path;

	// make sure we are in the correct directory
	$cwd = dirname(__FILE__);
	$cwd = str_replace("\\", '/', $cwd);
	$dirs = explode('/', $cwd);
	$file_list = array();

	////
	//// make sure EM is in the right directory
	////
	if (($dirs[count($dirs)-3] != 'admin') || ($dirs[count($dirs)-2] != 'mods') || (strtolower($dirs[count($dirs)-1]) != 'easymod'))
	{
		handle_error( OPEN_FAIL_CRITICAL, $file_list, false, $lang['EM_err_install_dir'] );
	}


	////
	//// make sure Default and english exists
	////
	// make sure Default dir exists
	if (!file_exists($phpbb_root_path . 'templates/Default'))
	{
		handle_error( OPEN_FAIL_CRITICAL, $file_list, false, $lang['EM_err_no_Default'] );
	}
	// make sure Default is installed in the DB

	// make sure SS is in the DB
	$sql = "SELECT *
		FROM " . THEMES_TABLE . " 
		WHERE template_name = 'Default'";
	if ( !($result = $db->sql_query($sql)) )
	{
		handle_error( OPEN_FAIL_CRITICAL, $file_list, false, 'Could not get theme info.' );
	}
	if ( !$db->sql_fetchrow($result) )
	{
		handle_error( OPEN_FAIL_CRITICAL, $file_list, false, $lang['EM_err_no_Default'] );
	}

	// make sure english exists
	if (!file_exists($phpbb_root_path . 'language/lang_english'))
	{
		handle_error( OPEN_FAIL_CRITICAL, $file_list, false, $lang['EM_err_no_english'] );
	}



	// get the version of the previous EM install, if there is one
	$prev_em_version = '';
	$sql = "SELECT * 
		FROM " . CONFIG_TABLE . " 
		WHERE config_name = 'EM_version'";
	if ( !($result = $db->sql_query($sql)) )
	{
		handle_error( OPEN_FAIL_CRITICAL, $file_list, false, $lang['EM_err_config_info']);
	}
	if ( $row = $db->sql_fetchrow($result))
	{
		$prev_em_version = $row['config_value'];
	}
	$db->sql_freeresult($result);


	//
	// the settings section
	//

	$variables['EM_Settings'] = $lang['EM_settings'];

	// make sure this version of EM is not already installed
	// see if we have already made the EM entries
	$sql = "SELECT * 
		FROM " . CONFIG_TABLE . " 
		WHERE config_name = 'EM_version'";
	if ( !($result = $db->sql_query($sql)) )
	{
		handle_error( OPEN_FAIL_CRITICAL, $file_list, false, $lang['EM_err_config_info']);
	}
	if ( $row = $db->sql_fetchrow($result))
	{
		// if this version matches the one in the DB, then throw an error
		/* 0.4.0 removing check to see if EasyMOD has already been installed. Reinstalling easymod won't hurt anything
		if ( $row['config_value'] == $easymod_install_version)
		{
			$error_msg  = '<strong>' . $lang['EM_err_critical_error'] . ':</strong> ' . $lang['EM_err_dupe_install'];
			$error_msg .= '<br /><br />' . $lang['EN_reinstall_version'];
			handle_error( OPEN_FAIL_OK, $file_list, false, $error_msg);
		}*/
	}
	$db->sql_freeresult($result);



	$read_failure = '';
	$read_access = check_access_read( $read_failure);
//////////
////////// no read access is going to be a major pain!  but it would also be nice to read local anyway
//////////
	if ( !$read_access)
	{
		// ask them WTF??
		handle_error( OPEN_FAIL_CRITICAL, $file_list, false, 'No server read access.  Check your permission settings.  Read access from a local file not implemented in this version.<br /><br />' . $read_failure );
	}


	// return the previously installed EM version
	return $prev_em_version;
}



// the "advanced mode" openning screen; it's pretty pathetic that this fairly simply form is being called "advanced mode"
//   but people really are that dumb!
function display_step1_classic()
{
	global $lang, $db, $easymod_install_version, $phpEx, $phpbb_root_path, $script_path;

	$variables = array();
	$access = array();


	// display header info, like the welcome message and pic
	page_header( $lang['EM_step1']);


	// do the checks to make sure things are where we are expecting them
	$prev_em_version = check_installablity();


	// display install and file access info
	get_install_info( $variables, $prev_em_version);
	get_file_access_info( $variables, $access);


	// read selections (there is only one option ;-) )
	$select_read =  '<option value="server" selected="selected">' . $lang['EM_read_server'] . '</option>';

	// recommend FTP as default and then choose the best alternate selection
	$can_write = (($access['write_access']) && ($access['mkdir_access'])) ? true : false;
	$write_rec = ($can_write) ? $lang['EM_write_server'] : $lang['EM_write_download'];

	// write selections
	$select_write =  '<option value="server">' . $lang['EM_write_server'] . '</option>';
	$select_write .= '<option value="ftpb" selected="selected">' . $lang['EM_write_ftp'] . '</option>';
	$select_write .= '<option value="local">' . $lang['EM_write_download'] . '</option>';
	$select_write .= '<option value="screen">' . $lang['EM_write_screen'] . '</option>';


	// recommend FTP as default and then choose the best alternate selection
	if ($write_rec != $lang['EM_write_server'])
	{
		// can't write on the server, so must manually move
		$move_rec = $lang['EM_move_manual'];
	}
	else
	{
		// either copy or suggest FTP; never suggest exec b/c i don't want to explain it tp dumbasses ;-)
		$move_rec = (($access['root_write']) && ($access['copy_access'])) ? $lang['EM_move_copy'] : $lang['EM_move_manual'];
	}

	// write selections
	$select_move =  '<option value="copy">' . $lang['EM_move_copy'] . '</option>';
	$select_move .= '<option value="ftpa" selected="selected">' . $lang['EM_move_ftp'] . '</option>';
	$select_move .= '<option value="exec">' . $lang['EM_move_exec'] . '</option>';
	$select_move .= '<option value="ftpm">' . $lang['EM_move_manual'] . '</option>';


	// assign template data
	$variables['U_FORM'] = append_sid($phpbb_root_path . $script_path . 'easymod_install.'.$phpEx);
	$variables['U_SIMPLE'] = append_sid($phpbb_root_path . $script_path . 'easymod_install.' . $phpEx . '?setup=simple');
	$variables['EM_support'] = $lang['EM_support'];
	$variables['EM_Settings'] = $lang['EM_settings'];
	$variables['EM_file_title'] = $lang['EM_file_title'];
	$variables['EM_file_desc'] = $lang['EM_file_desc'];
	$variables['EM_file_alt'] = $lang['EM_file_alt'];
	$variables['EM_file_reading'] = $lang['EM_file_reading'];
	$variables['EM_file_writing'] = $lang['EM_file_writing'];
	$variables['EM_file_moving'] = $lang['EM_file_moving'];
	$variables['Submit'] = $lang['Submit'];
	$variables['Rescan'] = $lang['Rescan'];
	$variables['EM_simple_mode'] = $lang['EM_simple_mode'];
	$variables['EM_advanced_mode'] = $lang['EM_advanced_mode'];

	$variables['SELECT_READ'] = $select_read;
	$variables['SELECT_WRITE'] = $select_write;
	$variables['SELECT_MOVE'] = $select_move;
	$variables['WRITE_REC'] = $write_rec;
	$variables['MOVE_REC'] = $move_rec;

	// fill the template info
	get_empw_settings( $variables);
	get_ftp_settings( $variables, $access);
	get_hidden_data( $variables, $access);

	// dispay the page and the footer
	display_template( $phpbb_root_path . $script_path . 'templates/step1_classic.tpl', $variables);
	page_footer();
	exit;
}


// the unbelievably simple setup screen
function display_step1_simple()
{
	global $lang, $db, $easymod_install_version, $phpEx, $language, $phpbb_root_path, $script_path;

	$variables = array();

	// display header info, like the welcome message and pic
	page_header($lang['EM_step1_simple_header']);

	// do the checks to make sure things are where we are expecting them
	$prev_em_version = check_installablity();

	// display install info
	get_install_info( $variables, $prev_em_version);


	// assign template data
	$variables['U_FORM'] = append_sid($phpbb_root_path . $script_path . 'easymod_install.'.$phpEx);
	$variables['U_ADVANCED'] = append_sid($phpbb_root_path . $script_path . 'easymod_install.' . $phpEx . '?setup=advanced');
	$variables['EM_support'] = $lang['EM_support'];
	$variables['EM_Settings'] = $lang['EM_settings'];
	$variables['Submit'] = $lang['Submit'];
	$variables['LANGUAGE'] = $language;
	$variables['EM_simple_mode'] = $lang['EM_simple_mode'];
	$variables['EM_advanced_mode'] = $lang['EM_advanced_mode'];
	$variables['EM_server_style'] = $lang['EM_server_style'];
	$variables['EM_about_server'] = $lang['EM_about_server'];
	$variables['EM_describes_server'] = $lang['EM_describes_server'];
	$variables['EM_have_ftp'] = $lang['EM_have_ftp'];
	$variables['EM_have_windows'] = $lang['EM_have_windows'];
	$variables['EM_no_ftp_suggest'] = $lang['EM_no_ftp_suggest'];


	// dispay the page and the footer
	display_template( $phpbb_root_path . $script_path . 'templates/step1_simple.tpl', $variables);
	page_footer();
	exit;
}


function display_step1b_idunno()
{
	global $lang, $db, $easymod_install_version, $phpEx, $phpbb_root_path, $script_path;

	$variables = array();
	$access = array();

	// file access info
	get_file_access_info( $variables, $access);


	// comment out all 3 sections and then we'll reanble the one we want; based of off the file acces info,
	//   determine which form to display
	$variables['WRITE_COPY_START'] = '<!--';
	$variables['WRITE_COPY_END'] = '-->';
	$variables['WRITE_NOCOPY_START'] = '<!--';
	$variables['WRITE_NOCOPY_END'] = '-->';
	$variables['NOWRITE_NOCOPY_START'] = '<!--';
	$variables['NOWRITE_NOCOPY_END'] = '-->';


	// golden! complete automation
	if (( $access['write_access']) && ( $access['copy_access']))
	{
		$variables['WRITE_COPY_START'] = '';
		$variables['WRITE_COPY_END'] = '';
	}

	// write only
	else if ( $access['write_access'])
	{
		$variables['WRITE_NOCOPY_START'] = '';
		$variables['WRITE_NOCOPY_END'] = '';
	}

	// nada
	else
	{
		$variables['NOWRITE_NOCOPY_START'] = '';
		$variables['NOWRITE_NOCOPY_END'] = '';
	}

	// display header info, like the welcome message and pic
	page_header($lang['EM_auto_detect']);


	// assign template data
	$variables['U_FORM'] = append_sid($phpbb_root_path . $script_path . 'easymod_install.'.$phpEx);
	$variables['EM_support'] = $lang['EM_support'];
	$variables['EM_Settings'] = $lang['EM_settings'];
	$variables['Submit'] = $lang['Submit'];
	$variables['Rescan'] = $lang['Rescan'];
	$variables['SELECT_ONE'] = $lang['Select_one'];
	$variables['EM_diagnosis'] = $lang['EM_diagnosis'];
	$variables['EM_auto_tech_detected'] = $lang['EM_auto_tech_detected'];
	$variables['EM_nowrite_nocopy_desc'] = $lang['EM_nowrite_nocopy__desc'];
	$variables['EM_try_ftp'] = $lang['EM_try_ftp'];
	$variables['EM_perms_mod_rescan'] = $lang['EM_perms_mod_rescan'];
	$variables['EM_download_manual'] = $lang['EM_download_manual'];
	$variables['EM_select_else'] = $lang['EM_select_else'];
	$variables['EM_write_copy_desc'] = $lang['EM_write_copy_desc'];
	$variables['EM_yes_use_auto'] = $lang['EM_yes_use_auto'];
	$variables['EM_no_use_else'] = $lang['EM_no_use_else'];
	$variables['EM_write_nocopy_desc'] = $lang['EM_write_nocopy_desc'];
	$variables['EM_use_post_process'] = $lang['EM_use_post_process'];


	// dispay the page and the footer
	display_template( $phpbb_root_path . $script_path . 'templates/step1b_simple.tpl', $variables);
	page_footer();
	exit;
}


function display_step1b_ftp()
{
	global $lang, $db, $easymod_install_version, $phpEx, $language, $phpbb_root_path, $script_path;

	$variables = array();
	$access = array();

	// display header info, like the welcome message and pic
	page_header($lang['EM_step1_ftp_header']);
	// display the file access info
	get_file_access_info( $variables, $access);


	// assign template data
	$variables['U_FORM'] = append_sid($phpbb_root_path . $script_path . 'easymod_install.'.$phpEx);
	$variables['EM_support'] = $lang['EM_support'];
	$variables['EM_Settings'] = $lang['EM_settings'];
	$variables['Submit'] = $lang['Submit'];
	$variables['Rescan'] = $lang['Rescan'];

	$variables['SEL_READ'] = 'server';
	$variables['SEL_WRITE'] = 'ftpb';
	$variables['SEL_MOVE'] = 'ftpa';
	$variables['LANGUAGE'] = $language;

	get_ftp_settings( $variables, $access);
	$variables['EM_ftp_desc'] = $lang['EM_ftp_desc'];


	// dispay the page and the footer
	display_template( $phpbb_root_path . $script_path . 'templates/step1b_ftp.tpl', $variables);
	page_footer();
	exit;
}


function display_step1c_empw()
{
	global $lang, $db, $easymod_install_version, $phpEx, $phpbb_root_path, $script_path;
	global $read, $write, $move, $ftp_user, $ftp_pass, $ftp_host, $ftp_port, $ftp_dir, $ftp_debug, $ftp_type, $ftp_cache;

	$variables = array();
	$access = array();


	// display header info, like the welcome message and pic
	page_header($lang['EM_step1_password_header']);


	// file access info
	get_file_access_info( $variables, $access);


	// assign template data
	$variables['U_FORM'] = append_sid($phpbb_root_path . $script_path . 'easymod_install.'.$phpEx);
	$variables['EM_support'] = $lang['EM_support'];
	$variables['EM_Settings'] = $lang['EM_settings'];
	$variables['Submit'] = $lang['Submit'];
	$variables['Rescan'] = $lang['Rescan'];

	$variables['SEL_READ'] = $read;
	$variables['SEL_WRITE'] = $write;
	$variables['SEL_MOVE'] = $move;

	$variables['FTP_USER'] = $ftp_user;
	$variables['FTP_PASS'] = $ftp_pass;
	$variables['FTP_HOST'] = $ftp_host;
	$variables['FTP_PORT'] = $ftp_port;
	$variables['FTP_DIR'] = $ftp_dir;
	$variables['FTP_DEBUG'] = $ftp_debug;
	$variables['FTP_TYPE'] = $ftp_type;
	$variables['FTP_CACHE'] = $ftp_cache;

	// fill the template info
	get_empw_settings( $variables);
	get_hidden_data( $variables, $access);


	// dispay the page and the footer
	display_template( $phpbb_root_path . $script_path . 'templates/step1c_empw.tpl', $variables);
	page_footer();
	exit;
}

?>