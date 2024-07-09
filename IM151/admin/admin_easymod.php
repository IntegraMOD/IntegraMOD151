<?php
/***************************************************************************
 *                             admin_easymod.php
 *                            -------------------
 *   begin                : Sunday Mar 31, 2002
 *   copyright            : (C) 2002-2004 by Nuttzy - Craig Nuttall, 2005 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: admin_easymod.php.txt 134 2008-06-24 19:38:23Z terrafrost $
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

// entries to be displayed in the ACP index
if (defined('IN_PHPBB') && !empty($setmodules))
{
	if ( @file_exists($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_easymod.' . $phpEx) )
	{
		include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_easymod.' . $phpEx);
	}
	else
	{
		include($phpbb_root_path . 'language/lang_english/lang_easymod.' . $phpEx);
	}

	$file = basename(__FILE__);
	$module['Modifications']['MOD_ainstall'] = "$file?mode=install";
	$module['Modifications']['MOD_settings'] = "$file?mode=settings";
	$module['Modifications']['MOD_history'] = "$file?mode=history";
	return;
}


// if we are downloading the file (or backup), then we don't want to send a page header from pagestart.php
$mode = (isset($_POST['mode'])) ? stripslashes($_POST['mode']) : ((isset($_GET['mode'])) ? stripslashes($_GET['mode']) : '');
if (($mode == 'download_file') || ($mode == 'download_backup') ||
	($mode == 'display_file') || ($mode == 'display_backup'))
{
	$no_page_header = true;
}
unset($mode);

//
// Load phpBB code, do session and security stuff
//
define('IN_PHPBB', 1);
$phpbb_root_path = '../';
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

//
$script_path = 'admin/';
//

// Load the EM language file
if ( @file_exists($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_easymod.' . $phpEx) )
{
	include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_easymod.' . $phpEx);
}
else
{
	include($phpbb_root_path . 'language/lang_english/lang_easymod.' . $phpEx);
}

// make sure em_functions is where it needs to be or else the user will get a blank screen :roll:
if (!file_exists($phpbb_root_path . 'admin/em_includes/em_functions.' . $phpEx))
{
	$message = sprintf($lang['EM_err_no_file'], $phpbb_root_path . 'admin/em_includes/em_functions.' . $phpEx);
	if( !defined('IN_ADMIN') )
	{
		// We can reach this point if pagestart has not been called, therefore we better close the DB and do a plain PHP die.
		$db->sql_close();
		die($message);
	}
	message_die(GENERAL_ERROR, $message);
}

// Enable debug helpers?
define('EM_DEBUG_AID', 1);

include($phpbb_root_path . 'admin/em_includes/em_ftp.' . $phpEx);
include($phpbb_root_path . 'admin/em_includes/em_modio.' . $phpEx);
include($phpbb_root_path . 'admin/em_includes/em_functions.' . $phpEx);
include($phpbb_root_path . 'admin/em_includes/parser_xml.' . $phpEx);


///
///
define('EASYMOD_VER', 'beta (0.4.0)');
define('FAQ_LINK', '<a href="http://easymod.sourceforge.net/readme/" target="_blank">');
define('REPORT_LINK', '<a href="http://area51.phpbb.com/phpBB/viewtopic.php?t=12143" target="_blank">');
define('HOW_TO_INSTALL_MODS_URL', 'http://easymod.sourceforge.net/readme/#faq_mod_inst_main');
///
///


// prevent from attempts to read files out of expected scope
function check_file_scope($filename, $expected_scope, $simply_die = false)
{
	global $db, $lang;

	// make sure a file is located somewhere inside the specified directory
	if( !@file_exists(phpbb_realpath($filename)) || !strstr(phpbb_realpath($filename), phpbb_realpath($expected_scope)) )
	{
		$message = sprintf($lang['EM_modio_open_read'], $filename);
		if( $simply_die )
		{
			$db->sql_close();
			die($message);
		}
		message_die(GENERAL_ERROR, $message);
	}
}

// write command info to the screen (add to template)
function display_line($command, $body)
{
	global $template, $theme;

	// print the command
	$template->assign_block_vars('processed', array(
		'ROW_CLASS' => $theme['td_class2'],
		'LINE' => '<b>' . htmlspecialchars($command['command']) . '</b> &nbsp;&nbsp;&nbsp;' . $lang['EM_line'] . ' #' . $command['line'] . "\n")
	);

	// print the command body
	$line = '';
	for ($i=0; $i<count($body); $i++)
	{
//		$line .= htmlspecialchars($body[$i]) . "<br />\n";
		$line .= htmlspecialchars($body[$i]);
	}

	// make sure there is a body to print!
	if (count($body) > 0)
	{
		$template->assign_block_vars('processed', array(
			'ROW_CLASS' => $theme['td_class1'],
//			'LINE' => $line)
			'LINE' => "\n<pre>$line</pre>\n")
		);
	}
}


// write command info to the screen (add to template)
function display_unprocessed_line($command, $body)
{
	global $template, $theme;

	// print the command
	$template->assign_block_vars('unprocessed', array(
		'ROW_CLASS' => $theme['td_class2'],
		'LINE' => '<b>' . htmlspecialchars($command['command']) . '</b> &nbsp;&nbsp;&nbsp;' . $lang['EM_line'] . ' #' . $command['line'] . "\n")
	);

	// print the command body
	$line = '';
	for ($i=0; $i<count($body); $i++)
	{
//		$line .= htmlspecialchars($body[$i]) . "<br />\n";
		$line .= htmlspecialchars($body[$i]);
	}
	$template->assign_block_vars('unprocessed', array(
		'ROW_CLASS' => $theme['td_class1'],
//		'LINE' => $line)
		'LINE' => "\n<pre>$line</pre>\n")
	);
}


// display error message info; it will look like a message_die box
function display_error($message)
{
	global $template, $mode, $lang;

	// template is not defined if we are displaying/downloading the file so echo the error
	if (($mode == 'display_file') || ($mode == 'download_file'))
	{
		echo ( $mode == 'display_file' ) ? '</pre>' . $message . ' :: ' . FAQ_LINK . $lang['EM_FAQ'] . '</a> :: ' . REPORT_LINK . $lang['EM_report'] . '</a><br /><br />' : '';
		return;
	}

	$template->assign_block_vars('error', array(
		'L_TITLE' => $lang['EM_error_detail'],
		'ERROR_MESSAGE' => $message . ' :: ' . FAQ_LINK . $lang['EM_FAQ'] . '</a> :: ' . REPORT_LINK . $lang['EM_report'] . '</a>')
	);
}


// look in the DB to see if we already processed this MOD
function is_unprocessed($db, $mod_title, $mod_version, $phpbb_version)
{
	$sql = "SELECT *
		FROM " . EASYMOD_TABLE . "
		WHERE mod_title = '" . substr($mod_title, 0, 255) . "'
			AND mod_version = '" . substr($mod_version, 0, 15) . "'
		ORDER BY mod_id DESC";
	if ( !($result = $db->sql_query($sql)) || !$db->sql_fetchrow($result) )
	{
		return true;
	}
	return false;
}


// parse the MOD file and get properties about it (make sure it really is a MOD too)
function get_mod_properties($file, &$mod_title, &$mod_author_handle, &$mod_author_email, &$mod_author_name, &$mod_author_url, &$mod_description, &$mod_version, &$compliant, &$modx_mod)
{
	global $phpbb_root_path, $script_path, $mod_type;

	if ($mod_type == MODX)
	{
		$modx_mod = true;
		return get_modx_properties($file, $mod_title, $mod_author_handle, $mod_author_email, $mod_author_name, $mod_author_url, $mod_description, $mod_version, $compliant);
	}
	else
	{
		$modx_mod = false;
	}
	
	// used to add a little tolerance on the Author line
	$faux_author = false;
	$legit_author = false;

	// open the file and grab the first line
	check_file_scope($file, $phpbb_root_path . $script_path);
	$f_mod_script = fopen($file, 'rb');
	if (!$f_mod_script)
	{
		return false;
	}
	$buffer = fgets($f_mod_script, 1024);

	// see if it is EMC right away; first line starts with ## on it and contains "easymod"
	$compliant = false;
	if ((stristr($buffer, 'easymod')) && (substr($buffer,0,2) == '##'))
	{
		$compliant = true;
	}

	// loop through file and try to get MOD info; only look at lines starting with ##
	$getting_desc = 0;
	$first_line = true;
	while ( (!feof($f_mod_script)) && ( substr($buffer,0,2) == '##'))
	{
		// we've already gotten the first line but still need to process it
		$buffer = ($first_line) ? $buffer : fgets($f_mod_script, 1024);
		$first_line = false;

		// check for mod title; allow just "title" if we don't have a title yet
		if ((stristr($buffer, 'MOD Title:')) || (($mod_title == '') && (stristr( $buffer, 'Title:'))))
		{
			$mod_title = htmlspecialchars(trim(substr($buffer, strpos($buffer, ":")+1)));
			$getting_desc = 0;
		}

		// check for author info
		else if ( (stristr($buffer, 'MOD Author:')) || (stristr($buffer, 'Author:') ))
		{
			// if we've already gotten a legit MOD Author, then don't go looking for another
			if ($legit_author)
			{
				continue;
			}

			// they are using just Author instead of MOD author and we've already gotten a "faux" one; get outta here
			else if ((!stristr( $buffer, 'MOD Author:')) && ($faux_author))
			{
				continue;
			}

			// again using some variant of "Author" but allow it; we'll only accept the first non-MOD Author entry
			else if ((!stristr($buffer, 'MOD Author:')) && (!$faux_author))
			{
				$faux_author = true;
			}

			// they are using the proper "MOD Author" label
			else
			{
				$legit_author = true;
			}

			// init our vars
			$mod_author_handle = '';
			$mod_author_email = '';
			$mod_author_name = '';
			$mod_author_url = '';

			// trim off the label
			$orig = trim(substr($buffer, strpos($buffer, ":")+1));

			// get real name + email address
			if (strstr($orig, '<'))
			{
				$left = strpos( $orig, "<")+1;
				$len = strpos( $orig, ">") - $left;
				$mod_author_email = htmlspecialchars(trim(substr($orig, $left, $len)));
				$mod_author_handle = htmlspecialchars(trim(substr($orig, 0, $left-1)));
				$mod_author_url = htmlspecialchars(trim(substr($orig, $left + $len +1)));
			}

			// get handle + web site
			if (strstr($orig, '('))
			{
				$left = strpos( $orig, "(")+1;
				$len = strpos( $orig, ")") - $left;
				$mod_author_name = htmlspecialchars(trim(substr($orig, $left, $len)));
				$mod_author_url = htmlspecialchars(trim(substr($orig, $left + $len +1)));
				if ( $mod_author_handle == '')
				{
					$mod_author_handle = htmlspecialchars(trim(substr($orig, 0, $left-1)));
				}
			}

			// could't get proper format so make it all the handle field
			else if ($mod_author_handle == '')
			{
				$mod_author_handle = htmlspecialchars($orig);
			}

			// see if we can debork a borked url; if there is "http:" but also spaces, take the chunck without spaces
			if ((strstr($mod_author_url, ' ')) && (strstr($mod_author_url, 'http:')))
			{
				$url_array = explode(' ', $mod_author_url);
				$pos_name = '';

				// looking for the element that has no http without any spaces; that will be our URL
				for ($url=0; $url<count($url_array); $url++)
				{
					// found our proper url
					if (strstr($url_array[$url], 'http:'))
					{
						$mod_author_url = htmlspecialchars($url_array[$url]);

						// if we didn't get a proper real name, then use whatever was in front of the url
						if ($mod_author_name == '')
						{
							$mod_author_name = htmlspecialchars($pos_name);
						}
						break;
					}

					// didn't find a url so build a potentially new value for real name
					else
					{
						$pos_name .= ($pos_name != '') ? ' ' . $url_array[$url] : $url_array[$url];
					}
				}
			}

			// if we don't have an author handle, then see what we can do
			if (($mod_author_handle == '') && ($mod_author_name != ''))
			{
				$mod_author_handle = htmlspecialchars($mod_author_name);
			}
			else if (($mod_author_handle == '') && ($mod_author_email != ''))
			{
				$mod_author_handle = htmlspecialchars($mod_author_email);
			}

			$getting_desc = 0;
		}

		// get the description (up to 3 lines); allow just "description" if we don't have a description yet
		else if ((stristr($buffer, 'MOD Description:')) || (($mod_description == '') && (stristr( $buffer, 'Description:'))))
		{
			$mod_description = htmlspecialchars(trim(substr($buffer, strpos($buffer, ":")+1)));
			$getting_desc = 1;
		}

		// get the version; allow just "version" if we don't have a version yet
		else if ((stristr( $buffer, 'MOD Version:')) || (($mod_description == '') && (stristr( $buffer, 'Version:'))))
		{
			$mod_version = htmlspecialchars(trim(substr($buffer, strpos($buffer, ":")+1)));
			$getting_desc = 0;
		}

		// if we are getting the description, chop carriage returns and make one long line; only allow 3 lines
		else if ($getting_desc > 0)
		{
			$new_line = ' ' . trim(substr($buffer, 2));
			$mod_description .= htmlspecialchars($new_line);
			$getting_desc = ($getting_desc >= 3) ? 0 : $getting_desc + 1;
		}
	}
	fclose($f_mod_script);

	// if we have a title and a handle, then that is good enough to call this a MOD (fixed in 0.0.10; used to be name)
	if (($mod_title != '') && ($mod_author_handle != ''))
	{
		return true;
	}
	else
	{
		return false;
	}
}

function get_modx_properties($file, &$mod_title, &$mod_author_handle, &$mod_author_email, &$mod_author_name, &$mod_author_url, &$mod_description, &$mod_version, &$compliant)
{
	global $phpbb_root_path, $script_path;

	$modx = new mod_parser_xml(implode("", file($file)));
	$modx->parse_header();
	
	$mod_title			= htmlspecialchars($modx->header['name']);
	$mod_author_handle	= htmlspecialchars($modx->header['author'][0]['username']);
	$mod_author_email	= htmlspecialchars($modx->header['author'][0]['email']);
	$mod_author_name	= htmlspecialchars($modx->header['author'][0]['realname']);
	$mod_author_url		= htmlspecialchars($modx->header['author'][0]['website']);
	$mod_description	= htmlspecialchars($modx->header['desc']);
	$mod_version		= htmlspecialchars($modx->header['version']);
	$compliant			= false;
	
	return (!empty($mod_title) && !empty($mod_author_handle)) ? true : false;
}


// strip the body array of a command down to the minimum
function strip_whitespace($body, $single_line=true)
{
	$new_array = array();
	$have_line = false;

	// rebuild the array and drop the whitespace lines
	for ($i=0; $i<count($body); $i++)
	{
		// if we already have line and are only looking for one, then skip this line
		if (($have_line) && ($single_line))
		{
			// do nothing
		}

		// if the line has something on it, then we'll want to store it
		else if (strlen(trim($body[$i])) > 0)
		{
			$new_array[] = $body[$i];
			$have_line = true;
		}

		// empty line so get this out of our body array
		else
		{
			// do nothing
		}
	}

	// the white space is now gone, return the result
	return $new_array;
}


// if we encounter an error will modifiying a file then print errors, clean up, and terminate processing if need be
function handle_error( $result, &$file_list, $line, $close_files=false, $find_array=array())
{
	global $lang;

	// if we are halting the processing then finish writing all files, just to be neat i guess
	if (($close_files) && ($result == FIND_FAIL_CRITICAL))
	{
		// if we failed on an IN-LINE command be sure to write the find_array
		if (count($find_array) > 0)
		{
			write_find_array( $find_array, $file_list);
		}

		// don't worry if file repro fails since we are halting anyway
		complete_file_reproduction( $file_list);
	}


	// handle warnings and critical errors
	$failed_close = false;
	if ( $result != OPEN_OK)
	{
		// loop through all files; print errors; and remove file from our file array
		$new_list = array();
		for ($err=0; $err<count($file_list); $err++)
		{
			// if there was an error associated with this file, then get down to biz
			if ($file_list[$err]->err_msg != '')
			{
				// if this file through a warning and we aren't halting then close just this file
				if (($close_files) && ($result != FIND_FAIL_CRITICAL))
				{
					$temp_array = array();
					$temp_array[] = $file_list[$err];

					// if we failed on an IN-LINE command be sure to write the find_array
					if (count($find_array) > 0)
					{
						write_find_array( $find_array, $temp_array);
					}

					// clean up this file
					if (!complete_file_reproduction( $temp_array))
					{
						// repro failed meaning close failed meaning we now have a show stopping error!
						$failed_close = true;
					}
				}

				// show the error(s); do this last in case file repro throw another error
				display_error( $file_list[$err]->err_msg . "<br />\n" . $lang['EM_line_num'] . $line);
			}

			// no error so this file can stay in our file list; ones with errors are removed
			else
			{
				$new_list[] = $file_list[$err];
			}
		}
		$file_list = $new_list;

		// if we have a critical error, then we have to halt the processing NOW!
		if ( ($result == OPEN_FAIL_CRITICAL) || ($failed_close))
		{
			return true;
		}
	}

	// no show stopping errors
	return false;
}


// look in the config table to get the EM settings
function get_em_settings($filename, $path, $em_pass, $preview = false)
{
	global $db, $phpbb_root_path;

	//
	// grab the EM settings
	//
	$sql = "SELECT *
		FROM " . CONFIG_TABLE . "
		WHERE config_name LIKE 'EM_%'";
	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, $lang['EM_err_config_info'], '', __LINE__, __FILE__, $sql);
	}

	// loop through all the settings and assign the EM ones as appropriate
	while ($row = $db->sql_fetchrow($result))
	{
		if ($row['config_name'] == 'EM_read')
		{
			$read = $row['config_value'];
		}
		else if ($row['config_name'] == 'EM_write')
		{
			$write = $row['config_value'];
		}
		else if ($row['config_name'] == 'EM_move')
		{
			$move = $row['config_value'];
		}
		else if ($row['config_name'] == 'EM_ftp_dir')
		{
			$ftp_dir = $row['config_value'];
		}
		else if ($row['config_name'] == 'EM_ftp_user')
		{
			$ftp_user = $row['config_value'];
		}
		else if ($row['config_name'] == 'EM_ftp_pass')
		{
			$ftp_pass = crypt_ftp_pass(EM_DECRYPT, $row['config_value'], $em_pass);
		}
		else if ($row['config_name'] == 'EM_ftp_host')
		{
			$ftp_host = $row['config_value'];
		}
		else if ($row['config_name'] == 'EM_ftp_port')
		{
			$ftp_port = $row['config_value'];
		}
		else if ($row['config_name'] == 'EM_ftp_type')
		{
			$ftp_type = $row['config_value'];
		}
		else if ($row['config_name'] == 'EM_ftp_cache')
		{
			$ftp_cache = $row['config_value'];
		}
	}

	// if we are in preview mode, then no matter what we will set to display to screen
	if ($preview)
	{
		$write = 'screen';
		$move = 'ftpm';
	}

	// easiest thing to do is return a mod_io object
	return new mod_io($filename, $path, $read, $write, $move, $ftp_user, $ftp_pass, $ftp_dir, $ftp_host, $ftp_port, $ftp_type, $ftp_cache);
}

// look in the config table to get the EM Version
function get_em_version()
{
	global $db;

	// look in db
	$sql = "SELECT *
		FROM " . CONFIG_TABLE . " 
		WHERE config_name = 'EM_version'";
	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, $lang['EM_err_config_info'], '', __LINE__, __FILE__, $sql);
	}

	// loop through all the settings and assign the EM ones as appropriate
	if ( $row = $db->sql_fetchrow($result))
	{
		return $row['config_value'];
	}

	return '';
}



// Begin user_id 2 auth
if ( ($userdata['user_level'] == ADMIN) && ($userdata['user_id'] == 2) )
{



// handle the mode; this is the key to securing EM
$mode = '';
$preview = false;
$get_password = false;

// if mode is passed in a GET, be very suspicious!  we don't like it when the user sends us GET vars so make sure they
//   are supposed to be
if (isset($_GET['mode']))
{
	// be very selective about what we allow from GET;  the allowed types will also require password auth
	$mode = (isset($_GET['mode'])) ? stripslashes($_GET['mode']) : '';

	if ($mode == 'help')
	{
		$template->set_filenames(array(
			'body' => 'admin/mod_help.tpl')
		);
		$template->assign_vars(array(
			'L_TITLE' => $lang['EM_installer_help'])
		);
		$first_item = true;
		foreach( $lang['help'] as $name => $paragraphs )
		{
			if( $first_item )
			{
				$first_item = false;
			}
			else
			{
				$template->assign_block_vars('helpitem.separator', array());
			}
			$template->assign_block_vars('helpitem', array(
				'TITLE' => $paragraphs[0],
				'NAME' => $name
			));
			for( $i = 1; $i < count($paragraphs); $i++ )
			{
				$template->assign_block_vars('helpitem.paragraph', array(
					'TEXT' => $paragraphs[$i]
				));
			}
		}
		$template->pparse('body');
		include('page_footer_admin.'.$phpEx);
	}

	if (($mode == 'install') || ($mode == 'settings') || ($mode == 'history'))
	{
		$get_password = false;$get_password = true;
	}

	// if we are displaying the file to screen, then get the pw to confirm against
	else if (($mode == 'display_file') || ($mode == 'display_backup'))
	{
		$password = (isset($_GET['password'])) ? stripslashes($_GET['password']) : '';
		$install_file = ( !empty($_GET['install_file']) ) ? stripslashes(trim($_GET['install_file'])) : '';
		$install_path = ( !empty($_GET['install_path']) ) ? stripslashes(trim($_GET['install_path'])) : '';

		// important! we are writing the file output to screen so the PRE tag will format it nicely for us
		echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">' . "\n"
			. '<html>' . "\n"
			. '<head>' . "\n"
			. '<title>' . $lang['EM_Title'] . '</title>' . "\n"
			. '<style type="text/css"><!--' . "\n"
			. 'pre.normal {color:black; margin:0px; padding:0px;}' . "\n"
			. 'pre.preview {color:red; margin:0px; padding:0px; font-weight:bold;}' . "\n"
			. '--></style>' . "\n"
			. '</head>' . "\n"
			. '<body>' . "\n"
			. '<pre class="normal">';
	}

	// unexpected mode, someone is trying to circumvent the password!  we'll fix 'em ;-)
	else
	{
		// they'll now end up at the password screen instead of whatever they were trying
		$mode = 'install';
		$get_password = true;
	}
}

// get post variables; we trust post variables ;-)
else
{
	$mode = ( !empty($_POST['mode']) ) ? stripslashes(trim($_POST['mode'])) : '';

	$password = ( !empty($_POST['password']) ) ? stripslashes($_POST['password']) : '';
	$install_file = ( !empty($_POST['install_file']) ) ? stripslashes(trim($_POST['install_file'])) : '';
	$install_path = ( !empty($_POST['install_path']) ) ? stripslashes(trim($_POST['install_path'])) : '';

	// 0.0.11 preview mode
	$preview = (isset($_POST['preview'])) ? true : false;
}


// make sure mode is valid; if not then set to default mode and get pw
if (($mode != 'history') && ($mode != 'settings') && ($mode != 'install') &&
	($mode != 'display_file') && ($mode != 'download_file') &&
	($mode != 'display_backup') && ($mode != 'download_backup') &&
	($mode != 'SQL_view') && ($mode != 'SQL_execute') &&
	($mode != 'update') && ($mode != 'process') && ($mode != 'post_process') && ($mode != 'diy_process') &&
	($mode != 'history_details') && ($mode != 'del_files') && ($mode != 'del_record') && ($mode != 'restore_backups') && ($mode != 'install_lang') && ($mode != 'install_themes') && ($mode != 'uninstall'))
{
	$mode = 'install';
	$get_password = false;
}

if (!empty($install_file))
{
	$extension = explode('.', $install_file);
	$extension = array_pop($extension);
	$mod_type = ($extension == 'xml') ? MODX : TEXT;
}

//
// if they are trying to get to the first page, check the pw; after that assume they are validated
//
$pass_message = '';
if ((($mode == 'install') || ($mode == 'settings') || ($mode == 'history') ||
	($mode == 'display_file') || ($mode == 'display_backup')) && (!$get_password))
{
	// compare passwords and send them back to the password screen if they fail
	if (md5($password) !== get_em_pw())
	{
		$get_password = false;
		$pass_message = '<b>' . $lang['EM_err_pw_fail'] . '</b><br />';
	}
}


//
// if they are downloading or displaying a file or backup then we need to get setup
//

// downloading a file or a backup from the completed processing screen
if (($mode == 'download_file') || ($mode == 'download_backup'))
{
	// they clicked a form button; we need to figure out which one so we know what file they are looking for
	$num_files = ( isset($_POST['mod_count'])) ? intval($_POST['mod_count']) : 0;

	// loop through all the submit buttons to see which one was pressed
///////////////////////////////////
///////////////////////////////////
/////////////////////////////////// possible error.... should start at 0? was a 1 before
///////////////////////////////////
///////////////////////////////////
	for( $i=0; $i<=$num_files; $i++ )
	{
		$var_name = 'submitfile' . $i;

		// if this is the button that was pressed then we are all set!  get the file name
		if (isset($_POST[$var_name]))
		{
			$file = (isset($_POST['file'.$i])) ? stripslashes($_POST['file'.$i]) : '';
			break;
		}
	}

	// we'll need to look at the path and filename so split things up
	$split = explode('/', $file);

	// if a file, then make sure we have the filename correct
	if ($mode == 'download_file')
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
		$orig_file = $file;
		$process_file = (substr($file, 0, 9) == '../../../') ? substr($file, 9) : '';
		$process_file = $phpbb_root_path . $process_file;
	}


	// if there is no file to process then we are in trouble!
	if ($process_file == '')
	{
		message_die(GENERAL_ERROR, $lang['EM_err_no_process_file']);
	}

	// set up the redirects so we will download a file, the contents of which we will echo out
	header('Content-Type: text/x-delimtext; name="' . $split[count($split)-1] . '"');
	header('Content-disposition: attachment; filename="' . $split[count($split)-1] . '"');
}

// writing to screen, get set up
else if (($mode == 'display_file') || ($mode == 'display_backup'))
{
	// get the file name
	$file = (isset($_GET['file'])) ? stripslashes($_GET['file']) : '';
	$split = explode('/', $file);

	// if a file, then make sure we have the filename correct
	if ($mode == 'display_file')
	{
		// by default the filename sent will match the one in the MOD script
		$process_file = (substr($file, 0, 9) == '../../../') ? substr($file, 9) : '';
		$orig_file = $process_file;

		// handle the special cases of a template file to display; only Default will appear in the MOD script
		if (($split[3] == 'templates') && ($split[4] != 'Default'))
		{
			$process_file = str_replace( $split[4], 'Default', $process_file);
		}

		// handle the special cases of a language file to display; only english will appear in the MOD script
		else if (($split[3] == 'language') && ($split[4] != 'lang_english'))
		{
			$process_file = str_replace( $split[4], 'lang_english', $process_file);
		}
	}

	// if a backup then we can assume the filename is valid
	else
	{
		$orig_file = $file;
		$process_file = (substr($file, 0, 9) == '../../../') ? substr($file, 9) : '';
		$process_file = $phpbb_root_path . $process_file;
	}

	// if there is no file to process then we are in trouble!
	if ( $process_file == '')
	{
		message_die(GENERAL_ERROR, $lang['EM_err_no_process_file']);
	}
}



//
// Show the page header (if we aren't doing the display modes)
//
if (($mode != 'display_file') && ($mode != 'download_file') && ($mode != 'display_backup') && ($mode != 'download_backup'))
{
	$template->set_filenames(array(
		'mod_header' => 'admin/mod_header.tpl')
	);

	$template->assign_vars(array(
		'L_TITLE' => $lang['EM_Title'],
		'L_EM_VERSION' => EASYMOD_VER)
	);

	$template->pparse('mod_header');
}





//
// password authentication page
//
if ($get_password)
{
	// load the password page template
	$template->set_filenames(array(
		"body" => "admin/mod_login.tpl")
	);


	$template->assign_vars(array(
		'S_ACTION' => append_sid('admin_easymod.' . $phpEx),
		'L_ACCESS_WARNING' => $lang['EM_access_warning'],
		'L_MESSAGE' => $pass_message,
		'L_PASSWORD_TITLE' => $lang['EM_password_title'],
		'L_PASSWORD' => $lang['EM_password'],
		'L_ACCESS_EM' => $lang['EM_access_EM'],

		'MODE' => $mode)
	);
}


//
// display the settings page
//
else if ($mode == 'settings')
{
	// load the settings page template
	$template->set_filenames(array(
		"body" => "admin/mod_settings.tpl")
	);

	$command_file = get_em_settings('6E7574747A79.72756C657321', '', $password);

	$select_read =  '<option value="server"' . (($command_file->read_method == 'server') ? ' selected=selected' : ''). '>' . $lang['EM_read_server'] . '</option>';

	$select_write =  '<option value="server"' . (($command_file->write_method == 'server') ? ' selected=selected' : ''). '>' . $lang['EM_write_server'] . '</option>' . "\n";
	$select_write .= '<option value="ftpb"' . (($command_file->write_method == 'ftpb') ? ' selected=selected' : ''). '>' . $lang['EM_write_ftp'] . '</option>' . "\n";
	$select_write .= '<option value="local"' . (($command_file->write_method == 'local') ? ' selected=selected' : ''). '>' . $lang['EM_write_download'] . '</option>' . "\n";
	$select_write .= '<option value="screen">' . (($command_file->write_method == 'screen') ? ' selected=selected' : ''). '' . $lang['EM_write_screen'] . '</option>' . "\n";

	$select_move =  '<option value="copy"' . (($command_file->move_method == 'copy') ? ' selected=selected' : ''). '>' . $lang['EM_move_copy'] . '</option>' . "\n";
	$select_move .= '<option value="ftpa"' . (($command_file->move_method == 'ftpa') ? ' selected=selected' : ''). '>' . $lang['EM_move_ftp'] . '</option>' . "\n";
	$select_move .= '<option value="exec"' . (($command_file->move_method == 'exec') ? ' selected=selected' : ''). '>' . $lang['EM_move_exec'] . '</option>' . "\n";
	$select_move .= '<option value="ftpm"' . (($command_file->move_method == 'ftpm') ? ' selected=selected' : ''). '>' . $lang['EM_move_manual'] . '</option>' . "\n";

	$template->assign_vars(array(
		'S_ACTION' => append_sid('admin_easymod.' . $phpEx),
		'L_SETTINGS' => $lang['EM_settings'],
		'L_DESC' => $lang['EM_settings_desc'],

		'L_PW_TITLE' => $lang['EM_password_title'],
		'L_PW_DESC' => $lang['EM_settings_pw'],
		'L_PW_SET' => $lang['EM_password_set'],
		'L_PW_CONFIRM' => $lang['EM_password_confirm'],
		'L_EM_VERSION' => $lang['EM_easymod_version'],
		'L_EMV_DESC' => $lang['EM_emv_description'],

		'L_FILE_TITLE' => $lang['EM_file_title'],
		'L_FILE_DESC' => $lang['EM_file_desc'],
		'L_FILE_READ' => $lang['EM_file_reading'],
		'L_FILE_WRITE' => $lang['EM_file_writing'],
		'L_FILE_MOVE' => $lang['EM_file_moving'],

		'L_FTP_TITLE' => $lang['EM_ftp_title'],
		'L_FTP_DESC' => $lang['EM_ftp_desc'],
		'L_FTP_DIR' => $lang['EM_ftp_dir'],
		'L_FTP_USER' => $lang['EM_ftp_user'],
		'L_FTP_PASS' => $lang['EM_ftp_pass'],
		'L_FTP_HOST' => $lang['EM_ftp_host'],
		'L_FTP_PORT' => $lang['EM_ftp_port'],
		'L_FTP_DEBUG' => $lang['EM_ftp_debug'],
		'L_FTP_DEBUG_WARN' => $lang['EM_ftp_debug_not'],
		'L_FTP_EXT' => $lang['EM_ftp_use_ext'],
		'L_FTP_EXT_WARN' => $lang['EM_ftp_ext_not'],
		'L_FTP_CACHE' => $lang['EM_ftp_cache'],
		'L_SUPPLY_CHANGE' => $lang['EM_supply_on_change'],
		'L_YES' => $lang['EM_yes'],
		'L_NO' => $lang['EM_no'],
		'L_SUBMIT' => $lang['EM_settings_update'],

		'EM_PASS' => htmlspecialchars($password),
		'EM_VERSION' => get_em_version(),

		'SELECT_READ' => $select_read,
		'SELECT_WRITE' => $select_write,
		'SELECT_MOVE' => $select_move,

		'FTP_USER' => $command_file->ftp_user,
		'FTP_PASS' => '', // don't send FTP password to page, is unsecure $command_file->ftp_pass,
		'FTP_PATH' => $command_file->ftp_path,
		'FTP_HOST' => $command_file->ftp_host,
		'FTP_PORT' => $command_file->ftp_port,
		'FTP_EXT' => ($command_file->ftp_type == 'ext') ? 'checked="checked"' : '',
		'FTP_FSOCK' => ($command_file->ftp_type == 'fsock') ? 'checked="checked"' : '',
		'FTP_CACHE_YES' => ($command_file->ftp_cache) ? 'checked="checked"' : '',
		'FTP_CACHE_NO' => (!$command_file->ftp_cache) ? 'checked="checked"' : '',

		'U_HELP' => append_sid('admin_easymod.' . $phpEx . '?mode=help'),
		'L_HELP' => $lang['EM_more_info'],

		'MODE' => 'update')
	);
}


//
// update the EM settings; they already filled out the settings page and hit submit
//
else if ($mode == 'update')
{
	// password settings
	$em_pass = (isset($_POST['em_pass'])) ? stripslashes($_POST['em_pass']) : '';
	$em_pass_confirm = (isset($_POST['em_pass_confirm'])) ? stripslashes($_POST['em_pass_confirm']) : '';
	$em_version = (isset($_POST['em_version'])) ? stripslashes($_POST['em_version']) : '';

	// file access settings
	$read = (isset($_POST['sel_read'])) ? stripslashes($_POST['sel_read']) : '';
	$write = (isset($_POST['sel_write'])) ? stripslashes($_POST['sel_write']) : '';
	$move = (isset($_POST['sel_move'])) ? stripslashes($_POST['sel_move']) : '';

	// ftp settings
	$ftp_user = (isset($_POST['ftp_user'])) ? stripslashes($_POST['ftp_user']) : '';
	$ftp_pass = (isset($_POST['ftp_pass'])) ? stripslashes($_POST['ftp_pass']) : '';
	$ftp_host = (isset($_POST['ftp_host'])) ? stripslashes($_POST['ftp_host']) : '';
	$ftp_port = (isset($_POST['ftp_port'])) ? intval($_POST['ftp_port']) : 0;
	$ftp_debug = (isset($_POST['ftp_debug'])) ? intval($_POST['ftp_debug']) : false;
	$ftp_type = (isset($_POST['ftp_type'])) ? stripslashes($_POST['ftp_type']) : 'fsock';
	$ftp_cache = (isset($_POST['ftp_cache'])) ? intval($_POST['ftp_cache']) : 0;
	$ftp_dir = (isset($_POST['ftp_dir'])) ? stripslashes($_POST['ftp_dir']) : '/';
	$ftp_dir == ( $ftp_dir == '') ? '/' : $ftp_dir;

	// confirm passwords match and update pw if needed
	if ($em_pass === $em_pass_confirm)
	{
		// update the password; starting with 0.0.11 store as MD5 hash
		em_db_update('EM_password', md5($em_pass));
		$pass_msg = (empty($em_pass)) ? $lang['EM_pass_disabled'] : $lang['EM_pass_updated'];
		$force_ftp_pass = true;
	}
	// the confirm is empty so they are not trying to update the pw, so don't
	else if (empty($em_pass_confirm))
	{
		$pass_msg = $lang['EM_pass_not_updated'];
		$force_ftp_pass = false;
	}
	// passwords do not match so throw an error
	else if ($em_pass !== $em_pass_confirm)
	{
		message_die(GENERAL_ERROR, $lang['EM_err_set_pw']);
	}

	// update the settings
	em_db_update('EM_read', str_replace("'", "''", $read));
	em_db_update('EM_write', str_replace("'", "''", $write));
	em_db_update('EM_move', str_replace("'", "''", $move));
	em_db_update('EM_ftp_dir', str_replace("'", "''", $ftp_dir));
	em_db_update('EM_ftp_user', str_replace("'", "''", $ftp_user));

	if ( $force_ftp_pass || !empty($ftp_pass) )
	{
		// If they are updating the EM password, but they haven't supplied the FTP password, then
		// we need the old EM password to decrypt the FTP password so it can be encrypted again
		if( empty($ftp_pass) )
		{
			$ftp_pass = crypt_ftp_pass(EM_DECRYPT, $board_config['EM_ftp_pass'], $password);
		}
		em_db_update('EM_ftp_pass', str_replace("'", "''", crypt_ftp_pass(EM_ENCRYPT, $ftp_pass, $em_pass)));
	}

	em_db_update('EM_ftp_host', str_replace("'", "''", $ftp_host));
	em_db_update('EM_ftp_port', $ftp_port);
	em_db_update('EM_ftp_type', str_replace("'", "''", $ftp_type));
	em_db_update('EM_ftp_cache', $ftp_cache);
	em_db_update('EM_version', str_replace("'", "''", $em_version));

	// Test the FTP connection?
	if( $write == 'ftpb' || $move == 'ftpa' )
	{
		$command_file = get_em_settings('6E7574747A79.72756C657321', '', $password);
		$test_report = '';
		$test_result = capture_test_ftp($ftp_user, $ftp_pass, $ftp_dir, $ftp_host, $ftp_port, $ftp_debug, $ftp_type, $ftp_cache, $test_report);
		$test_report = '<table align="center"><tr><td align="left">' . $test_report . '</td></tr></table>';
	}
	else
	{
		$test_report = '';
	}

	message_die(GENERAL_MESSAGE, '<br />' . $lang['EM_settings_success'] . " $pass_msg<br /><br />$test_report");
}

//
// history
//
else if ($mode == 'history')
{
	$filter_option = isset($_POST['filter_option']) ? stripslashes(trim($_POST['filter_option'])) : '';

	// load the history page template
	$template->set_filenames(array(
		"body" => "admin/mod_history.tpl")
	);

	// Build the select options for the 'Filter By File' field.
	// First get distinct file names from DB, they include path relative to phpBB directory.
	// ...we will later build the $distinct_files array based on the basename of files.
	$sql = 'SELECT DISTINCT mod_processed_file FROM ' . EASYMOD_PROCESSED_FILES_TABLE;
	if( !($result = $db->sql_query($sql)) )
	{
	   message_die(GENERAL_ERROR, $lang['EM_err_em_info'], '', __LINE__, __FILE__, $sql);
	}
	$distinct_rows = $db->sql_fetchrowset($result);
	$distinct_count = count($distinct_rows);

	$distinct_files = array();
	for( $i = 0; $i < $distinct_count; $i++ )
	{
		$basename = basename($distinct_rows[$i]['mod_processed_file']);
		if( !in_array($basename, $distinct_files) )
		{
			$distinct_files[] = $basename;
		}
	}
	sort($distinct_files);
	$filter_select_options = '<option value="">' . htmlspecialchars($lang['EM_All_mods']) . '</option>';
	for( $i = 0; $i < count($distinct_files); $i++ )
	{
		$selected = $distinct_files[$i] == $filter_option ? ' selected="selected"' : '';
		$filter_select_options .= '<option value="' . htmlspecialchars($distinct_files[$i]) . '"' . $selected . '>' . htmlspecialchars($distinct_files[$i]) . '</option>';
	}

	// Build the list of mod_ids matching the selected processed file
	if( !empty($filter_option) )
	{
		$sql = "SELECT mod_id FROM " . EASYMOD_PROCESSED_FILES_TABLE . "
			WHERE mod_processed_file LIKE '%" . str_replace("'", "''", $filter_option) . "%'
			ORDER BY mod_id";

		if( !($result = $db->sql_query($sql)) )
		{
		   message_die(GENERAL_ERROR, $lang['EM_err_em_info'], '', __LINE__, __FILE__, $sql);
		}

		$mod_id_list = array();
		while( $row = $db->sql_fetchrow($result) )
		{
			$mod_id_list[] = $row['mod_id'];
		}
		if( count($mod_id_list) <= 0 )
		{
			$mod_id_list[] = -1;
		}
		$filter_by_mod_id_list = 'WHERE mod_id IN (' . implode(',', $mod_id_list) . ')';
		$history_status = $lang['EM_Filtered'];
	}
	else
	{
		$filter_by_mod_id_list = '';
		$history_status = $lang['EM_Unfiltered'];
	}

	// finally, get the list of matching MODs
	$sql = "SELECT *
		FROM " . EASYMOD_TABLE . "
		$filter_by_mod_id_list
		ORDER BY mod_id DESC";
	if( !$result = $db->sql_query($sql) )
	{
	   message_die(GENERAL_ERROR, $lang['EM_err_em_info'], '', __LINE__, __FILE__, $sql);
	}

	$total_mods = 0;
	while( $row = $db->sql_fetchrow($result) )
	{
		$row_class = ( !($total_mods % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
		$template->assign_block_vars('install', array(
			'ROW_CLASS' => $row_class,
			'INSTALL_DATE' => create_date($board_config['default_dateformat'], $row['mod_process_date'], $board_config['board_timezone']),
			'TITLE' => $row['mod_title'],
			'VERSION' => $row['mod_version'],
			'AUTHOR' => $row['mod_author_handle'],
			'URL' => $row['mod_author_url'],
			'PHPBB_VER' => $row['mod_phpBB_version'],

			'S_ACTION' => append_sid('admin_easymod.' . $phpEx),
			'S_HIDDEN_FIELDS' => '<input type="hidden" name="mod_id" value="' . $row['mod_id'] . '" /><input type="hidden" name="mode" value="history_details" /><input type="hidden" name="password" value="' . htmlspecialchars($password) . '" /><input type="hidden" name="filter_option" value="' . htmlspecialchars($filter_option) . '" />',

/////////////////
///////////////// blah, what about schema name?
/////////////////
			'THEMES' => $row['mod_processed_themes'],
			'LANGS' => $row['mod_processed_langs'])
		);
		$total_mods++;
	}
	if ( $total_mods == 0 )
	{
		$template->assign_block_vars('no_install', array());
	}

	$template->assign_vars(array(
		'L_INSTALLED' => $lang['EM_Installed'],
		'L_INSTALLED_DESC' => $lang['EM_installed_desc'],
		'L_INSTALL_DATE' => $lang['EM_install_date'],
		'L_MOD_NAME' => $lang['EM_Mod'],
		'L_FILE' => $lang['EM_File'],
		'L_VERSION' => $lang['EM_Version'],
		'L_AUTHOR' => $lang['EM_Author'],
		'L_DESCRIPTION' => $lang['EM_Description'],
		'L_DATE' => $lang['EM_Process_Date'],
		'L_PHPBB_VER' => $lang['EM_phpBB_version'],
		'L_THEMES' => $lang['EM_Themes'],
		'L_LANGUAGES' => $lang['EM_Languages'],
		'L_NONE_INSTALLED' => ( empty($filter_by_mod_id_list) ? $lang['EM_none_installed'] : $lang['EM_none_found'] ),
		'S_DETAILS' => $lang['EM_details'],
		'L_FILTER' => $lang['EM_Filter'],
		'L_FILTER_BY_FILE' => $lang['EM_Filter_by_file'],
		'S_FILTER_OPTIONS' => $filter_select_options,
		'L_HISTORY_STATUS' => $history_status,
		'L_TOTAL_MODS' => $lang['EM_Total_mods'],
		'S_TOTAL_MODS' => $total_mods,
		'S_HIDDEN_FIELDS' => '<input type="hidden" name="mode" value="history" /><input type="hidden" name="password" value="' . htmlspecialchars($password) . '" />',
		'S_ACTION' => append_sid('admin_easymod.' . $phpEx))
	);
}

//
// history details
//
else if ( $mode == 'history_details' || (isset($_POST['cancel']) && in_array($mode, array('post_process', 'del_files', 'del_record', 'restore_backups', 'install_lang', 'install_themes', 'uninstall'))) )
{
	// get the mod id
	if ( isset($_POST['mod_id']) )
	{
		$mod_id = intval($_POST['mod_id']);
	}
	else
	{
		message_die(GENERAL_ERROR, $lang['EM_No_mod_selected']);
	}

	// load the template
	$template->set_filenames(array(
		"body" => "admin/mod_history_details.tpl")
	);

	$template->assign_vars(array(
		'L_MOD_DATA' => $lang['EM_Mod_Data'],
		'L_MOD_TITLE' => $lang['EM_Mod_Title'],
		'L_MOD_DESCRIPTION' => $lang['EM_Description'],
		'L_AUTHOR' => $lang['EM_Author'],
		'L_INSTALL_DATE' => $lang['EM_install_date'],
		'L_PHPBB_VER' => $lang['EM_phpBB_version'],
		'L_THEMES' => $lang['EM_Proc_Themes'],
		'L_LANGUAGES' => $lang['EM_Proc_Languages'],
		'L_FILES' => $lang['EM_Files'],
		'L_DB_ALTS' => $lang['EM_db_alt'],
		'L_ADDED' => $lang['EM_tables_added'],
		'L_ALTERED' => $lang['EM_tables_altered'],
		'L_INSERTED' => $lang['EM_rows_added'],
		
		'L_BACK_TO_HISTORY' => $lang['EM_back_to_history'],
		'L_DELETE_FILES' => $lang['EM_del_files'],
		'L_DELETE_RECORD' => $lang['EN_del_record'],
		'L_INSTALL_LANG' => $lang['EM_install_new_lang'],
		'L_INSTALL_THEMES' => $lang['EM_install_new_themes'],
		'L_RESTORE_BACKUPS' => $lang['EM_restore_backups'],
		'L_UNISTALL' => $lang['EM_uninstall'],
		'L_GO' => $lang['Go'],
			
		'S_ACTION' => append_sid('admin_easymod.' . $phpEx),
		'S_HIDDEN_FIELDS' => '<input type="hidden" name="mod_id" value="' . $mod_id . '" /><input type="hidden" name="password" value="' . htmlspecialchars($password) . '" /><input type="hidden" name="filter_option" value="' . htmlspecialchars(stripslashes($_POST['filter_option'])) . '" />')
	);

	$sql = "SELECT * FROM " . EASYMOD_TABLE . "
		WHERE mod_id = $mod_id
		LIMIT 0, 1";

	if( !$result = $db->sql_query($sql) )
	{
	   message_die(GENERAL_ERROR, $lang['EM_err_em_info'], '', __LINE__, __FILE__, $sql);
	}

	$row = $db->sql_fetchrow($result);

	// file
	$file = explode('/', $row['mod_file']);

	if ( file_exists('./mods/' . $row['mod_file']) )
	{
		$temp_url = $phpbb_root_path . 'admin/mods/' . $row['mod_file'];
		$mod_file = '<a href="' . htmlspecialchars($temp_url) . '" class="gen" target="_blank">' . htmlspecialchars($file[1]) . '</a>';

		// Let's hide coming soon features until fully implemented
		//$template->assign_block_vars('switch_install_file', array());
	}
	else
	{
		$mod_file = $file[1];
	}

	// see what files are there so we can work with them
	if ( file_exists('./mods/' . $file[0] . '/processed/') || file_exists('./mods/' . $file[0]. '/backups/') )
	{
		// Let's hide coming soon features until fully implemented
		//$template->assign_block_vars('switch_files', array());
	}
	// see if backups are there so we can give them the option to restore them
	if ( file_exists('./mods/' . $file[0]. '/backups/') )
	{
		$template->assign_block_vars('switch_backups', array());
	}

	// build the list of processed files for the current MOD
	$sql = "SELECT mod_processed_file FROM " . EASYMOD_PROCESSED_FILES_TABLE . "
		WHERE mod_id = $mod_id
		ORDER BY mod_processed_file";
	if( !($result = $db->sql_query($sql)) )
	{
	   message_die(GENERAL_ERROR, $lang['EM_err_em_info'], '', __LINE__, __FILE__, $sql);
	}
	$epf_rows = $db->sql_fetchrowset($result);
	$epf_count = count($epf_rows);
	$epf_list = '';
	for( $i = 0; $i < $epf_count; $i++ )
	{
		$epf_list .= '<br />' . htmlspecialchars($epf_rows[$i]['mod_processed_file']);
	}

	$template->assign_vars(array(
		'TITLE' => $row['mod_title'],
		'VERSION' => $row['mod_version'],
		'MOD_FILE' => $mod_file,
		'DESCRIPTION' => $row['mod_description'],
		'AUTHOR' => $row['mod_author_handle'],
		'EMAIL' => $row['mod_author_email'],
		'REAL_NAME' => $row['mod_author_name'],
		'URL' => $row['mod_author_url'],
		'DATE' => create_date($board_config['default_dateformat'], $row['mod_process_date'], $board_config['board_timezone']),
		'PHPBB_VERSION' => $row['mod_phpBB_version'],
		'THEMES' => $row['mod_processed_themes'],
		'LANGUAGES' => $row['mod_processed_langs'],
		'FILES' => $row['mod_files_edited'],
		'FILE_LIST' => $epf_list,
		'ADDED' => $row['mod_tables_added'],
		'ALTERED' => $row['mod_tables_altered'],
		'INSERTED' => $row['mod_rows_inserted'])
	);

}

//
// delete MOD files
//
else if ( $mode == 'del_files' )
{
	// display which folders to delete, either
	// processed, backups, or the complete folder
	message_die(GENERAL_MESSAGE, $lang['Coming_soon']);

}

//
// delete MOD record
//
else if ( $mode == 'del_record' )
{
	// display confirm and delete sql entry

	// get the mod id
	if ( isset($_POST['mod_id']) )
	{
		$mod_id = intval($_POST['mod_id']);
	}
	else
	{
		message_die(GENERAL_ERROR, $lang['EM_No_mod_selected']);
	}

	// Should we display the confirm box?
	if( !isset($_POST['confirm']) )
	{
		$s_hidden_fields = '<input type="hidden" name="mod_id" value="' . $mod_id . '" />'.
							'<input type="hidden" name="password" value="' . htmlspecialchars($password) . '" />'.
							'<input type="hidden" name="mode" value="' . $mode . '" />';
		$template->set_filenames(array(
			'body' => 'confirm_body.tpl')
		);
		$template->assign_vars(array(
			'L_INDEX'			=> '',	// Not really necessary here
			'MESSAGE_TITLE'		=> $lang['EN_del_record'],
			'MESSAGE_TEXT'		=> $lang['EM_are_you_sure'],
			'L_YES'				=> $lang['Yes'],
			'L_NO'				=> $lang['No'],
			'S_CONFIRM_ACTION'	=> append_sid('admin_easymod.' . $phpEx),
			'S_HIDDEN_FIELDS'	=> $s_hidden_fields)
		);
	}
	else
	{
		// ok, let's do it!
		$sql = "SELECT * FROM " . EASYMOD_TABLE . "
			WHERE mod_id = $mod_id";
		if( !($result = $db->sql_query($sql)) || !($row = $db->sql_fetchrow($result)) )
		{
			message_die(GENERAL_ERROR, $lang['EM_err_em_info'], '', __LINE__, __FILE__, $sql);
		}
		$mod_file = $phpbb_root_path . 'admin/mods/' . $row['mod_file'];
		$mod_folder = dirname($mod_file).'/';

		$sql = "DELETE FROM " . EASYMOD_TABLE . "
			WHERE mod_id = $mod_id";
		if( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, $lang['EM_err_delete_em_info'], '', __LINE__, __FILE__, $sql);
		}

		$message = '<form method="post" action="' . append_sid('admin_easymod.' . $phpEx . '?mode=history') . '">';
		$message .= '<br />' . $lang['EM_record_deleted'] . '<br /><br />';
		if( @file_exists($mod_file) )
		{
			$message .= '<br />' . $lang['EM_warning_deldir'] . '<br /><br /><b>' . htmlspecialchars($mod_folder) . '</b><br /><br /><br />';
		}
		$message .= '<input type="submit" name="submit" class="liteoption" value="' . htmlspecialchars($lang['MOD_history']) . '" />';
		$message .= '<input type="hidden" name="password" value="' . htmlspecialchars($password) . '" />';
		$message .= '</form>';
		message_die(GENERAL_MESSAGE, $message);
	}

}

//
// Restore Backups
//
else if ( $mode == 'restore_backups' && !isset($_POST['confirm']) )
{
	// display confirm and move the backups into place

	// get the mod id
	if ( isset($_POST['mod_id']) )
	{
		$mod_id = intval($_POST['mod_id']);
	}
	else
	{
		message_die(GENERAL_ERROR, $lang['EM_No_mod_selected']);
	}

	// Read MOD information from DB...
	$sql = "SELECT * FROM " . EASYMOD_TABLE . "
		WHERE mod_id = $mod_id";
	if( !($result = $db->sql_query($sql)) || !($mod_row = $db->sql_fetchrow($result)) )
	{
		message_die(GENERAL_ERROR, $lang['EM_err_em_info'], '', __LINE__, __FILE__, $sql);
	}
	$sql = "SELECT mod_processed_file FROM " . EASYMOD_PROCESSED_FILES_TABLE . "
		WHERE mod_id = $mod_id
		ORDER BY mod_processed_file";
	if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, $lang['EM_err_em_info'], '', __LINE__, __FILE__, $sql);
	}
	$epf_rows = $db->sql_fetchrowset($result);
	$epf_count = count($epf_rows);

	// build the command array for the restore backups job
	$mod_file = './mods/' . $mod_row['mod_file'];
	$mod_folder = dirname($mod_file).'/';
	$command_ary = array();
	for( $i = 0; $i < $epf_count; $i++ )
	{
		$mod_processed_file = $epf_rows[$i]['mod_processed_file'];
		$command_ary[] = array('backups/' . $mod_processed_file . '.txt', '../../../' . $mod_processed_file);
	}

	if( ($num_command_steps = count($command_ary)) <= 0 )
	{
		message_die(GENERAL_ERROR, $lang['EM_err_no_step']);
	}

	// ok, let's build the NEW post_process stuff, then display the confirm dialog box!
	$mode = 'post_process';

	$hidden_vars_ary = array(
		'mod_id'			=> $mod_id,
		'password'			=> htmlspecialchars($password),
		'mode'				=> $mode,
		'install_path'		=> dirname($mod_file).'/',
		'install_file'		=> basename($mod_file),
		'themes'			=> $mod_row['mod_processed_themes'],
		'languages'			=> $mod_row['mod_processed_langs'],
		'files'				=> $mod_row['mod_files_edited'],
		'num_proc'			=> $mod_row['mod_files_edited'],
		'num_unproc'		=> 0
	);

	$s_hidden_fields = '';
	for( $i=0; $i < $num_command_steps; $i++ )
	{
		$command_line = 'copy ' . $command_ary[$i][0] . ' ' . $command_ary[$i][1];
		$s_hidden_fields .= '<input type="hidden" name="command_step'.$i.'" value="' . htmlspecialchars($command_line) . "\" />\n";
	}
	$s_hidden_fields .= '<input type="hidden" name="num_command_steps" value="' . $i . "\" />\n";

	foreach( $hidden_vars_ary as $key => $val )
	{
		$s_hidden_fields .= '<input type="hidden" name="' . $key . '" value="' . htmlspecialchars($val) . "\" />\n";
	}

	$template->set_filenames(array(
		'body' => 'confirm_body.tpl')
	);

	$message = '<b>' . $lang['EM_restore_backups'] . "</b>:<br /><br />\n";
	for( $i=0; $i < $num_command_steps; $i++ )
	{
		$from = $mod_folder.$command_ary[$i][0];
		$to = ((substr($command_ary[$i][1], 0, 9) == '../../../') ? substr($command_ary[$i][1], 9) : $command_ary[$i][1]);
		$message .= '<b>COPY</b> ' . htmlspecialchars($from) . ' <b>TO</b> ' . htmlspecialchars($to) . "<br />\n";
	}
	$message .= '<br /><br />' . $lang['EM_are_you_sure'];

	$template->assign_vars(array(
		'L_INDEX'			=> '',	// Not really necessary here
		'MESSAGE_TITLE'		=> $lang['EM_restore_backups'],
		'MESSAGE_TEXT'		=> $message,
		'L_YES'				=> $lang['Yes'],
		'L_NO'				=> $lang['No'],
		'S_CONFIRM_ACTION'	=> append_sid('admin_easymod.' . $phpEx),
		'S_HIDDEN_FIELDS'	=> $s_hidden_fields)
	);

}

//
// Install MOD on new Languages
//
else if ( $mode == 'install_lang' )
{
	// list which languages so user can choose and go through install process
	message_die(GENERAL_ERROR, $lang['Coming_soon']);

}

//
// Install MOD on new themes
//
else if ( $mode == 'install_themes' )
{
	// list which themes so user can choose and go through install process
	message_die(GENERAL_ERROR, $lang['Coming_soon']);

}

//
// uninstall the mod
//
else if ( $mode == 'uninstall' )
{
	message_die(GENERAL_MESSAGE, $lang['Coming_soon']);
}

//
// display install MOD page
//
else if ( $mode == 'install')
{
	// load the install page template
	$template->set_filenames(array(
		'body' => 'admin/mod_install.tpl')
	);

	$template->assign_vars(array(
		'L_EM_INTRO' => $lang['EM_Intro'],

		'L_UNPROCESSED' => $lang['EM_Unprocessed'],
		'L_UNPROCESSED_DESC' => sprintf($lang['EM_unprocessed_mods'], HOW_TO_INSTALL_MODS_URL),

		'L_MOD' => $lang['EM_Mod'],
		'L_AUTHOR' => $lang['EM_Author'],
		'L_SUPPORT' => $lang['EM_support_thread'],
		'L_DESCRIPTION' => $lang['EM_Description'],
		'L_EMC' => $lang['EM_EMC'],
		'L_PROCESS' => $lang['EM_process'],
		'L_PREVIEW' => $lang['EM_preview'],
		'L_ALL_PROCESSED' => $lang['EM_All_Processed'],

		'S_ACTION' => append_sid('admin_easymod.' . $phpEx),
		'EM_PASS' => htmlspecialchars($password))
	);



	$phpbb_version = get_phpbb_version();
	if ($phpbb_version == '')
	{
		message_die(GENERAL_ERROR, $lang['EM_err_phpbb_ver']);
	}

	// parse the "mods" directory, looking for newly extracted mods, or mod updates
	$top_handle = opendir('./mods');
	$i = 0;
	while (false !== ($dir = readdir($top_handle)))
	{
		// only want the subdirectories (but not . and ..)
		if ( (is_dir('./mods/' . $dir) ) && ($dir != '.') && ($dir != '..'))
		{
			$path = './mods/' . $dir;
			$dir_handle = opendir($path);
			// loop through the subdirs, looking for mod files
			while (false !== ($file = readdir($dir_handle)))
			{
				$file_path =  $path . '/' . $file;
				$extension = explode('.', $file);
				$extension = array_pop($extension);
				// make sure it is not a dir, and that it ends with .txt or .mod
				//(eregi(".txt$", $file_path)) || (eregi(".mod$", $file_path)) || (eregi(".xml$", $file_path))))
				if ( !is_dir( $file_path) && in_array($extension, array('txt', 'mod', 'xml')))
				{
					$mod_title = '';
					$mod_author_handle = '';
					$mod_author_email = '';
					$mod_author_name = '';
					$mod_author_url = '';
					$mod_description = '';
					$mod_version = '';
					$compliant = false;
					$modx_mod = false;
					$mod_type = ($extension == 'xml') ? MODX : TEXT;

					$is_mod = get_mod_properties($file_path, $mod_title, $mod_author_handle, $mod_author_email, $mod_author_name, $mod_author_url, $mod_description, $mod_version, $compliant, $modx_mod);

					// if it is a MOD and has not been processed yet then add it to the list
					if (($is_mod) && ( is_unprocessed( $db, $mod_title, $mod_version, $phpbb_version)))
					{
						$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
					
						$emc = '';
						if ($modx_mod == true)
						{
							$emc = '<img src="../templates/Default/images/modx_inside.png"><br />';
						}
						$emc .= ($compliant) ? '<img src="../templates/Default/images/emc.gif">' : $lang['No'];
						$template->assign_block_vars('unprocessed', array(
							'ROW_CLASS' => $row_class,
							'MOD_TITLE' => $mod_title,
							'MOD_AUTHOR' => $mod_author_handle,
							'MOD_URL' => preg_match('#^http(s?)#', $mod_author_url) ? '<a href="' . $mod_author_url . '" target="_blank">' . $mod_author_url . '</a>' : '',
							'MOD_VERSION' => $mod_version,
							'MOD_DESC' => $mod_description,
							'MOD_EMC' => $emc,
							'MOD_PATH' => $path . '/',
							'MOD_FILE' => $file,
							'MOD_FILE_URL' => $path . '/' . $file)
						);
						$i++;
					}
				}
			}
		}
	}

	// didn't find any MODs we can process
	if ( $i == 0 )
	{
		$template->assign_block_vars('no_unprocessed', array());
	}
}


//
// preview the changes EM will be making to files
//
else if ($preview)
{
	$files = array();
	check_file_scope($install_path . $install_file, $phpbb_root_path . $script_path);
	
	if ($mod_type == MODX)
	{
		$modx = new mod_parser_xml(implode('', file($install_path . $install_file)));
		$modx->_parse();
		
		$actions = $modx->data[0]['children']['ACTION-GROUP'][0]['children'];
		$open_info = (!empty($actions['OPEN'])) ? $actions['OPEN'] : array();
		for($i = 0, $total = sizeof($open_info); $i < $total; $i++)
		{
			$files[] = str_replace('\\', '/', trim($open_info[$i]['attrs']['SRC']));
		}
	}
	else
	{
		$f_mod_script = fopen($install_path . $install_file, 'rb');
		while (!feof($f_mod_script))
		{
			$buffer = fgets($f_mod_script, 4096);
	
			// if the line starts with #, this is either a comment or an action command
	
			// after obtaining the command, skip any comments until we reach the command body
			if (($buffer[0] == '#') && ($in_header))
			{
				// do nothing until we are out of the command header!!
			}
	
			// not in a header so this comment is either a random comment or start of a command header
			else if ($buffer[0] == '#')
			{
				// if we find [ and ] and OPEN on this line, then we can be reasonably sure we've got an OPEN command
				if ((substr($buffer, 0, 2) != '##') && (strstr($buffer, '[')) && (strstr($buffer, ']')) && (strstr($buffer, 'OPEN')))
				{
					// get us past any remaining # lines
					$buffer = fgets($f_mod_script, 4096);
					while ($buffer[0] == '#')
					{
						if ( feof($f_mod_script))
						{
							break;
						}
						$buffer = fgets($f_mod_script, 4096);
					}
	
					// loop until we get a filename (a non-whitespace line) or the next # line
					while (!feof($f_mod_script))
					{
						// got a line with some text not starting with #, so we're calling this a filename ;)
						if ((strlen(trim($buffer)) > 0) && ($buffer[0] != '#'))
						{
							$files[] = trim($buffer);
							break;
						}
	
						// we found a # so get us out of here
						else if ($buffer[0] == '#')
						{
							break;
						}
	
						$buffer = fgets($f_mod_script, 4096);
					}
	
					// if we hit eof, then get us out of here
					if (feof($f_mod_script))
					{
						break;
					}
				}
			}
	
			// not a comment or command so this is the body of the command
			else
			{
				$in_header = false;
			}
		}
		fclose($f_mod_script);
	}


	// Show the preview page
	$template->set_filenames(array(
		'body' => 'admin/mod_preview.tpl')
	);

	$template->assign_vars(array(
		'L_HEADER' => $lang['EM_preview_mode'],
		'L_PREVIEW_DESC' => $lang['EM_preview_desc'],
		'L_FILENAME' => $lang['EM_preview_filename'],
		'L_VIEW' => $lang['EM_preview_view'])
	);


	// load in the filename and link info
	for ($i=0; $i<count($files); $i++)
	{
		$link = append_sid('admin_easymod.' . $phpEx . '?mode=display_file&amp;file=../../../' . $files[$i] . "&amp;password=$password&amp;install_file=$install_file&amp;install_path=$install_path");

		$template->assign_block_vars('files', array(
			'NAME' => $files[$i],
			'URL' => $link)
		);
	}

	// if there are no files to be modified, then display the message
	if ( count($files) == 0)
	{
		$template->assign_block_vars('nofiles', array(
			'L_NO_FILES' => $lang['EM_preview_nofile'])
		);
	}
}


//
// download or display a backup of the core phpBB file
//
else if (($mode == 'display_backup') || ($mode == 'download_backup'))
{
	// open the core file
	check_file_scope($process_file, $phpbb_root_path . $script_path, true);
	if (!$read_file = fopen($process_file, 'rb'))
	{
		// gotta echo out the message since message_die is not an option
		echo sprintf( $lang['EM_err_backup_open'], $process_file) . "\n";
		exit;
	}

	// write out the lines
	while (!feof($read_file))
	{
		$newline = fgets($read_file, 4096);
		if ($mode == 'download_backup')
		{
			echo $newline;
		}
		else
		{
			echo htmlspecialchars($newline);
		}
	}
	fclose($read_file);

	// finish the PRE formatting tag
	if ($mode == 'display_backup')
	{
		echo "</pre>\n</body>\n</html>\n";
	}

	// done! done! done!
	exit;
}


//
// process the MOD script and modify the files
//
else if (($mode == 'process' ) || ($mode == 'display_file') || ($mode == 'download_file'))
{
	// 0.0.11 preview mode
	$preview = (isset($_POST['preview'])) ? 1 : ($mode == 'display_file');

	$current_command = '';
	$commands = array();
	$body = array();

	$in_header = false;			// in the header of the command (the ## section)
	$line_num = 0;				// line number in the MOD script we are parsing

	$found_file = false;		// only for the special cases


	//
	// open the mod script and load an array with commands to execute
	//

	check_file_scope($install_path . $install_file, $phpbb_root_path . $script_path);
	
	if ($mod_type == MODX)
	{
		$modx = new mod_parser_xml(implode('', file($install_path . $install_file)));
		
		$modx->parse_actions();
		if (($mode == 'display_file') || ($mode == 'download_file'))
		{
			$commands[] = array('command' => 'OPEN', 'line'	=> 0);
			$body[] = array($process_file);
			
			$actions = $modx->actions['open'][$process_file];			
			for($i = 0, $total = sizeof($actions['edit']); $i < $total; $i++)
			{
				$commands[] = array('command' => 'FIND', 'line' => 0);
				$body[] = explode("\n", $actions['edit'][$i]['find']);
				
				$edit_actions = $actions['edit'][$i]['action'];
				for($j = 0, $total2 = sizeof($edit_actions); $j < $total2; $j++)
				{
					$code = explode("\n", $edit_actions[$j]['code']);
					for($k = 0, $total3 = sizeof($code); $k < $total3; $k++)
					{
						$code[$k] = rtrim($code[$k]) . "\n";
					}
					
					switch($edit_actions[$j]['type'])
					{
						case 'after-add':
							$current_command = 'AFTERADD';
						break;
						
						case 'before-add':
							$current_command = 'BEFOREADD';
						break;
						
						case 'replace-with':
							$current_command = 'REPLACE';
						break;
						
						case 'increment':
							$current_command = 'INCREMENT';
						break;
					}
					
					$commands[] = array('command' => $current_command, 'line' => $edit_actions[$j]['line']);
					$body[] = $code."\n";
				}
				
				$inline_edit_actions = $actions['edit'][$i]['in-line-edit'];
				for($j = 0, $total2 = sizeof($inline_edit_actions); $j < $total2; $j++)
				{
					$commands[] = array('command' => 'IN-LINE FIND', 'line' => 0);
					$body[] = explode("\n", $inline_edit_actions[$j]['in-line-find']);
					
					$inline_actions = $inline_edit_actions[$j]['in-line-action'];
					for($k = 0, $total3 = sizeof($inline_actions); $k < $total3; $k++)
					{
						switch($inline_actions[$k]['type'])
						{
							case 'in-line-before-add':
								$current_command = 'IN-LINE BEFOREADD';
							break;
							
							case 'in-line-after-add':
								$current_command = 'IN-LINE AFTERADD';
							break;
							
							case 'in-line-replace-with':
								$current_command = 'IN-LINE REPLACE';
							break;
						}
						
						$commands[] = array('command' => $current_command, 'line' => $inline_actions[$k]['line']);
						$body[] = array($inline_actions[$k]['code']);
					}
				}
			}
		}
		else
		{
			foreach($modx->actions as $action => $data)
			{
				switch($action)
				{
					case 'sql':
						$commands[] = array('command' => 'SQL', 'line' => 0);
						$body[] = $data;					
					break;
					
					case 'copy':
						//copy x to y
						$copy = array();
						for($i = 0, $total = sizeof($data); $i < $total; $i++)
						{
							$copy[] = 'copy ' . $data[$i]['from'] . ' to ' . $data[$i]['to'] . "\n";
						}
						$commands[] = array('command' => 'COPY', 'line' => 0);
						$body[] = $copy;
					break;
					
					case 'diy-instructions':
						$commands[] = array('command' => 'DIY INSTRUCTIONS', 'line' => 0);
						$body[] = $data;
					break;
					
					case 'open':
						foreach($data as $file => $actions)
						{
							$commands[] = array('command' => 'OPEN', 'line'	=> 0);
							$body[] = array($file);

							for($i = 0, $total = sizeof($actions['edit']); $i < $total; $i++)
							{
								$commands[] = array('command' => 'FIND', 'line' => 0);

								$temp = explode("\n", $actions['edit'][$i]['find']);
								for ($j = 0; $j < count($temp); $j++)
								{
									$temp[$j].= "\n";
								}

								$body[] = $temp;
								
								$edit_actions = $actions['edit'][$i]['action'];
								for($j = 0, $total2 = sizeof($edit_actions); $j < $total2; $j++)
								{
									$code = explode("\n", $edit_actions[$j]['code']);

									for($k = 0, $total3 = sizeof($code); $k < $total3; $k++)
									{
										$code[$k] = rtrim($code[$k]). "\n";
									}
									
									switch($edit_actions[$j]['type'])
									{
										case 'after-add':
											$current_command = 'AFTERADD';
										break;
										
										case 'before-add':
											$current_command = 'BEFOREADD';
										break;
										
										case 'replace-with':
											$current_command = 'REPLACE';
										break;
										
										case 'increment':
											$current_command = 'INCREMENT';
										break;
									}
									
									$commands[] = array('command' => $current_command, 'line' => $edit_actions[$j]['line']);
									$body[] = $code;
								}
								
								$inline_edit_actions = $actions['edit'][$i]['in-line-edit'];
								for($j = 0, $total2 = sizeof($inline_edit_actions); $j < $total2; $j++)
								{
									$commands[] = array('command' => 'IN-LINE FIND', 'line' => 0);
									$body[] = explode("\n", $inline_edit_actions[$j]['in-line-find']);
									
									$inline_actions = $inline_edit_actions[$j]['in-line-action'];
									for($k = 0, $total3 = sizeof($inline_actions); $k < $total3; $k++)
									{
										switch($inline_actions[$k]['type'])
										{
											case 'in-line-before-add':
												$current_command = 'IN-LINE BEFOREADD';
											break;
											
											case 'in-line-after-add':
												$current_command = 'IN-LINE AFTERADD';
											break;
											
											case 'in-line-replace-with':
												$current_command = 'IN-LINE REPLACE';
											break;
										}
										
										$commands[] = array('command' => $current_command, 'line' => $inline_actions[$k]['line']);
										$body[] = array($inline_actions[$k]['code']);
									}
								}
							}
						}
					break;
				}
			}
			
			$commands[] = array('command' => 'CLOSE', 'line' => 0);
			$body[] = array();
		}
	}
	else
	{
		$f_mod_script = fopen($install_path . $install_file, 'rb');
		while (!feof($f_mod_script))
		{
			$buffer = fgets($f_mod_script, 4096);
			$line_num++;
	
			// if the line starts with #, this is either a comment or an action command; will also tell us when
			//    we've hit the last search line of the target content for this command (meaning we've reached the
			//    next command)
	
			// after obtaining the command, skip any comments until we reach the command body
			if (($buffer[0] == '#') && ($in_header))
			{
				// do nothing until we are out of the command header!!
			}
	
			// not in a header so this comment is either a random comment or start of a command header
			else if ($buffer[0] == '#')
			{
				// done with last command now that we've hit a comment (regardless if a new command or just a comment)
				if ( $current_command != '')
				{
					$current_command = '';
				}
	
				// if we find [ and ] on this line, then we can be reasonably sure it is an action command
				if ((substr($buffer, 0, 2) != '##') && (strstr($buffer, '[')) && (strstr($buffer, ']')))
				{
	
					//
					// we know it's an action, take appropriate steps for the action; see if the current command
					//   is found on our list;  NOTE: since we are using strstr, it is important to keep the
					//   IN-LINE commands listed before thier similarly named cousins
					//
	
					if (strstr($buffer, 'OPEN'))
					{
						$current_command = 'OPEN';
					}
					else if (strstr($buffer, 'IN-LINE FIND'))
					{
						$current_command = 'IN-LINE FIND';
					}
					else if (strstr($buffer, 'FIND'))
					{
						$current_command = 'FIND';
					}
					else if (strstr($buffer, 'IN-LINE AFTER, ADD'))
					{
						$current_command = 'IN-LINE AFTERADD';
					}
					else if (strstr($buffer, 'AFTER, ADD'))
					{
						$current_command = 'AFTERADD';
					}
					else if (strstr($buffer, 'IN-LINE BEFORE, ADD'))
					{
						$current_command = 'IN-LINE BEFOREADD';
					}
					else if (strstr($buffer, 'BEFORE, ADD'))
					{
						$current_command = 'BEFOREADD';
					}
					else if (strstr($buffer, 'IN-LINE REPLACE'))
					{
						$current_command = 'IN-LINE REPLACE';
					}
					else if (strstr($buffer, 'REPLACE'))
					{
						$current_command = 'REPLACE';
					}
					else if (strstr($buffer, 'COPY'))
					{
						$current_command = 'COPY';
					}
					else if (strstr($buffer, 'SQL'))
					{
						$current_command = 'SQL';
					}
					else if ( strstr($buffer, 'DIY INSTRUCTIONS') )
					{
						$current_command = 'DIY INSTRUCTIONS';
					}
					else if ( strstr($buffer, 'INCREMENT') )
					{
						$current_command = 'INCREMENT';
					}
					else if (strstr($buffer, 'SAVE/CLOSE'))
					{
						$current_command = 'CLOSE';
					}
	
					// not a known command, let see if it is unrecognized command or just a comment
					else
					{
						$left_bracket = strpos($buffer, '[');
						$right_bracket = strpos($buffer, ']');
						$left_of_bracket = substr($buffer, 0, $left_bracket);
						$right_of_bracket = substr($buffer, $right_bracket);
	
						// if there is no "--" both before and after the brackets, this must be a comment
						if (($left_bracket < $right_bracket) && (strstr($left_of_bracket, '--')) && (strstr($right_of_bracket, '--')))
						{
							$current_command = trim(substr($buffer, $left_bracket+1, (($right_bracket-1)-($left_bracket+1))));
						}
					}
	
					// handle special cases when we display or download the file; we are looking for the commands
					//   for one file ONLY, so skip commands until we find the corresponding OPEN
					if (($mode == 'display_file') || ($mode == 'download_file'))
					{
						if ( $current_command != '')
						{
							// not found found file yet so this is a possible canidate
							if ((!$found_file) && ($current_command == 'OPEN'))
							{
								$in_header = true;
							}
	
							// ignore all other commands until we have our file
							else if ((!$found_file) && ($current_command != 'OPEN'))
							{
								$current_command = '';
							}
	
							// after found, once we hit another OPEN or the CLOSE, then we are done
							else if ((($found_file) && ($current_command == 'OPEN') && (!$in_header)) || ($current_command == 'CLOSE'))
							{
								$current_command = '';
								break;
							}
	
							// allow processing of this command
							else
							{
								$in_header = true;
								$commands[] = array( 'command' => $current_command, 'line' => $line_num);
								$body[] = array();
							}
						}
					}
	
					// normal command processing
					else if ( $current_command != '')
					{
						$in_header = true;
						$commands[] = array( 'command' => $current_command, 'line' => $line_num);
						$body[] = array();
					}
				}
			}
	
			// not a comment or command so this is the body of the command
			else if ( $current_command != '')
			{
				// handle special cases; make sure this is for the specific file we are looking for
				if (($mode == 'display_file') || ($mode == 'download_file'))
				{
					// not found found file yet so see if this is it
					if ((!$found_file) && ($current_command == 'OPEN'))
					{
						// found the file, excellent!
						if (trim($buffer) == $process_file)
						{
							$commands[] = array( 'command' => $current_command, 'line' => $line_num);
							$body[] = array();
							$body[ count($body)-1 ][] = $buffer;
							$found_file = true;
						}
					}
	
					// haven't found the file yet, so don't process this command (should never get in here)
					else if (!$found_file)
					{
						$current_command = '';
					}
	
					// this command relates to the file we are looking for, so go ahead
					else
					{
						$body[ count($body)-1 ][] = $buffer;
					}
					$in_header = false;
				}
	
				// store this as this body of our command
				else
				{
					$in_header = false;
					$body[ count($body)-1 ][] = $buffer;
				}
			}
		}
		fclose($f_mod_script);
	}

	// load the process mod template unless we are in special case mode
	if (($mode != 'display_file') && ($mode != 'download_file'))
	{
		// set the template
		$template->set_filenames(array(
			'body' => 'admin/mod_process.tpl')
		);
	}


	$file_list = array();

	$search_array = array();		// what we are searching for
	$search_fragment = '';			// the IN-LINE FIND fragment we are looking for
	$find_array = array();			// contains lines from a FIND which potentially contain our search target

	$files_edited = 0;
	$num_processed = 0;
	$num_unprocessed = 0;

	$failed = true;
	$exec_close = false;			// did we hit the close command?

	// grab the EM settings and open the command file
	$command_file = get_em_settings('post_process.sh', '', $password, $preview);

	// this is really more about moving the other files than is about the command file; establish the FTP connection
	//  for moving files if necessary
	if (!$command_file->modio_prep('move'))
	{
		$command_file->err_msg = $lang['EM_trace'] . ': main[1]->' . $command_file->err_msg;
		message_die(GENERAL_ERROR, '<b>' . $lang['EM_err_critical_error'] . ':</b><br />' . $command_file->err_msg . '<br />');
	}


////////////////////
//////////////////// emcopy - to be fixed and removed in 0.0.11
////////////////////
	$display_copy_warning = false;
	$display_sql_warning = false;
	$sql = array();


	//
	// now that we have the commands all set let's start to process them
	//

	// loop through the command and knock 'em out ;-)
	for ($i=0; $i<count($commands); $i++)
	{
		// a catch all at the end will switch to false if we fail to process
		$processed = true;
		$bad_command = false;

		// protect against malformed script that didn't perform a FIND first; this acts as a gatekeeper to ensure
		//   that the find_array is being managed correctly; OPEN and FIND write out any remenants of find_array; AFTER
		//   and REPLACE destroy the array while BEFORE and the IN-LINE's preserve it to be used again
		if (count($find_array) == 0)
		{
			$error = false;
			switch ($commands[$i]['command'])
			{
				case 'BEFOREADD':
				case 'REPLACE':
				case 'AFTERADD':
				case 'INCREMENT':
				case 'IN-LINE BEFOREADD':
				case 'IN-LINE REPLACE':
				case 'IN-LINE AFTERADD':
					display_error( '<b>' . $lang['EM_err_critical_error'] . "</b><br /><br />\n" . $commands[$i]['command'] . $lang['EM_err_no_find'] . "<br />\n" . $lang['EM_line_num'] . $commands[$i]['line']);
					$error = true;
			}

			if ($error)
			{
				break;
			}
		}

		//
		// open phpBB core file
		//
		if ($commands[$i]['command'] == 'OPEN')
		{
			// if we were doing an BEFORE or an IN-LINE command we need to write out the find_array
			//   also, see if we need to write the lines in preview format
			if ($i>0)
			{
				$do_preview = ((strstr($commands[$i-1]['command'], 'IN-LINE') || $commands[$i-1]['command'] == 'INCREMENT') && ($preview)) ? true : false;
			}
			else
			{
				$do_preview = false;
			}

			write_find_array( $find_array, $file_list, $do_preview);
			$find_array = array();

			// if we already had a file open, close it now
			if (!complete_file_reproduction($file_list))
			{
				// close failed; throw errors and halt
				for ($errs=0; $errs<count($file_list); $errs++)
				{
					display_error('<b>' . $lang['EM_err_critical_error'] . "</b><br /><br />\n" . $file_list[$errs]->err_msg . "<br />\n" . $lang['EM_line_num'] . $commands[$i]['line']);
				}

				// halt processing
				break;
			}

			// strip the body of whitespace down and down to a single line
			$body[$i] = strip_whitespace($body[$i], true);

			// if there is not exactly 1 line then throw a critical error
			if ( count($body[$i]) != 1)
			{
				display_error('<b>' . $lang['EM_err_critical_error'] . "</b><br /><br />\n" . $lang['EM_err_comm_open'] . "<br />\n" . $lang['EM_line_num'] . $commands[$i]['line']);
				break;
			}

			// strip off the path and get the file name
			$splitarray = explode('/', trim($body[$i][0]));
			$filename = $splitarray[count($splitarray)-1];

			// now get the path
			$path = '';
			for ($k=0; $k<count($splitarray)-1; $k++)
			{
				$path .= $splitarray[$k] . '/';
			}


			// open the file(s)
			$file_list = array();
			$result = open_files($filename, $path, $file_list, $command_file);

			// display any errors; if it was critical, terminate processing; if warn, remove file from list
			if (handle_error($result, $file_list, $commands[$i]['line']))
			{
				break;
			}

			// increment our count
			$files_edited += count($file_list);
		}

		//
		// find a string or sequential group of strings in the file
		//
		else if ($commands[$i]['command'] == 'FIND')
		{
			// if we were doing an BEFORE or an IN-LINE command we need to write out the find_array
			//   also, see if we need to write the lines in preview format
			$do_preview = ((strstr($commands[$i-1]['command'], 'IN-LINE') || $commands[$i-1]['command'] == 'INCREMENT') && ($preview)) ? true : false;
			write_find_array($find_array, $file_list, $do_preview);

			// reinit key vars
			$find_array = array();
			$search_fragment = '';

			// strip the body of whitespace lines; allow multiple lines
			$body[$i] = strip_whitespace($body[$i], false);


			// make sure we have something to search for; throw a warning if not
			$search_array = $body[$i];
			if ( count($search_array) == 0 )
			{
				display_error('<b>' . $lang['EM_err_critical_error'] . "</b><br /><br />\n" . $lang['EM_err_comm_find'] . "<br />\n" . $lang['EM_line_num'] . $commands[$i]['line']);
				break;
			}

			// do the find and see what happens
			$result = perform_find($file_list, $find_array, $search_array);

			// display any errors; if it was critical, terminate processing; if warn, remove file from list
			//   the command will also close the files that we were writing
			if (handle_error($result, $file_list, $commands[$i]['line'], true))
			{
				break;
			}
		}

		//
		// write out the find array then write the body
		//
		else if ($commands[$i]['command'] == 'AFTERADD')
		{
			$insert_string = '';
			for ($j=0; $j<count($body[$i]); $j++)
			{
				$insert_string .= $body[$i][$j];
			}

			// if we are preview mode, then mark these effect lines as special
			if ($mode == 'display_file')
			{
				$insert_string = 'EM>>' . $insert_string;
			}

			// see if we need to write the lines in preview format
			$do_preview = ((strstr($commands[$i-1]['command'], 'IN-LINE') || $commands[$i-1]['command'] == 'INCREMENT') && ($preview)) ? true : false;

			write_find_array($find_array, $file_list, $do_preview);
			write_files($file_list, $insert_string);

			// we've written the find array already so we can no longer operate on it
			$find_array = array();
		}

		//
		// write the body then write out the find array
		//
		else if ($commands[$i]['command'] == 'BEFOREADD')
		{
			$insert_string = '';
			for ($j=0; $j<count($body[$i]); $j++)
			{
				$insert_string .= $body[$i][$j];
			}

			// if we are preview mode, then mark these effect lines as special
			if ($mode == 'display_file')
			{
				$insert_string = 'EM>>' . $insert_string;
			}

			write_files($file_list, $insert_string);

			// NOTE: since we have not modified the find_array in any way we can still perform operations on it
			//   so do not write it out
		}

		//
		// write the body then throw out the find array!
		//
		else if ($commands[$i]['command'] == 'REPLACE')
		{
			// is this a totally easy command or what!?!?!  That's why it is soooo dangerous to use.  Another
			//   mod will never be able to work again if it needs to FIND what we just replaced	

			// write the replace lines and notice how we never will write the find_array lines
			for ($j=0; $j<count($body[$i]); $j++)
			{
				// if we are preview mode, then mark these effect lines as special
				if ($mode == 'display_file')
				{
					write_files($file_list, 'EM>>' . $body[$i][$j]);
				}
				else
				{
					write_files($file_list, $body[$i][$j]);
				}
			}

			// we've obliterated the find array already so we can no longer operate on it
			$find_array = array();
		}

		else if ($commands[$i]['command'] == 'INCREMENT')
		{
			// strip the body of whitespace down and down to a single line
			$body[$i] = strip_whitespace($body[$i], true);

			// if there is not exactly 1 line then throw a critical error
			if (count($body[$i]) != 1)
			{
				display_error('<b>' . $lang['EM_err_critical_error'] . "</b><br /><br />\n" . $commands[$i]['command'] . $lang['EM_err_increment_body'] . "<br />\n" . $lang['EM_line_num'] . $commands[$i]['line']);
				break;
			}

			// parse the increment command
			$inc_data = array();
			if (!preg_match('#(%\:\d+)\s*([\+\-]\d+)?#',trim($body[$i][0]),$inc_data))
			{
				display_error('<b>' . $lang['EM_err_critical_error'] . "</b><br /><br />\n" . $commands[$i]['command'] . $lang['EM_err_increment_body'] . "<br />\n" . $lang['EM_line_num'] . $commands[$i]['line']);
				break;
			}
			$inc_data[1] = '{'.$inc_data[1].'}';
			$inc_data[2] = isset($inc_data[2]) ? $inc_data[2] : 1;

			// perform the increment / throw an error as appropriate
			$err_level = FIND_OK;
			for ( $file_count = 0; $file_count < count($file_list); $file_count++ )
			{
				for ( $j = 0; $j < count($find_array[$file_count]); $j++ )
				{
					$increment_search = ($search_fragment != '') ? $search_fragment : $search_array[$j];
					$result = increment_wildcard($inc_data[1], $inc_data[2], $increment_search, $find_array[$file_count][$j]);
					if ($result !== false)
					{
						$find_array[$file_count][$j] = $result;
						break;
					}
				}
				if ($j == count($find_array[$file_count]))
				{
					// halt if this is an english lang file
					if (strstr($file_list[$file_count]->path, 'language/lang_english'))
					{
						$file_list[$file_count]->err_msg = '<b>' . $lang['EM_err_critical_error'] . '</b><br /><br />';
						$err_level = FIND_FAIL_CRITICAL;
					}

					// halt if this is a Default style file
					else if (strstr($file_list[$file_count]->path, 'templates/Default/'))
					{
						$file_list[$file_count]->err_msg = '<b>' . $lang['EM_err_critical_error'] . '</b><br /><br />';
						$err_level = FIND_FAIL_CRITICAL;
					}

					// if a different lang, then allow to continue processing
					else if (strstr($file_list[$file_count]->path, 'language/lang_'))
					{
						$file_list[$file_count]->err_msg = '<b>' . $lang['EM_err_warning'] . '</b><br /><br />';
						$err_level = FIND_FAIL_OK;
					}

					// if a different style file, then allow to continue processing
					else if (strstr($file_list[$file_count]->path, 'templates/'))
					{
						$file_list[$file_count]->err_msg = '<b>' . $lang['EM_err_warning'] . '</b><br /><br />';
						$err_level = FIND_FAIL_OK;
					}

					// any other file then halt processing
					else
					{
						$file_list[$file_count]->err_msg = '<b>' . $lang['EM_err_critical_error'] . '</b><br /><br />';
						$err_level = FIND_FAIL_CRITICAL;
					}
					$file_list[$file_count]->err_msg .= sprintf($lang['EM_err_ifind_fail'], $file_list[$file_count]->path . trim($file_list[$file_count]->filename)) . ':<br /><br />' . htmlspecialchars($search_fragment) . "<br />\n";
				}
			}
			// display any errors; if it was critical, terminate processing; if warn, remove file from list
			//   the command will also close the files that we were writing
			if (handle_error($err_level, $file_list, $commands[$i]['line'], true, $find_array))
			{
				break;
			}
		}

		//
		// IN-LINE commands; perform precision operations on a single line
		//
		else if (strstr($commands[$i]['command'], 'IN-LINE'))
		{
/////////////////////
///////////////////// wasn't there something about not trimming the left side?
/////////////////////
			// strip the body of whitespace down and down to a single line
			$body[$i] = strip_whitespace($body[$i], true);

			if ($commands[$i]['command'] == 'IN-LINE REPLACE')
			{
				// IN-LINE FINDs can be blank or contain actual, at most, one line.
				if (count($body[$i]) > 1)
				{
					display_error('<b>' . $lang['EM_err_critical_error'] . "</b><br /><br />\n" . $commands[$i]['command'] . $lang['EM_err_inline_body'] . "<br />\n" . $lang['EM_line_num'] . $commands[$i]['line']);
					break;
				}
			}
			else
			{
				// if there is not exactly 1 line then throw a critical error
				if (count($body[$i]) != 1)
				{
					display_error('<b>' . $lang['EM_err_critical_error'] . "</b><br /><br />\n" . $commands[$i]['command'] . $lang['EM_err_inline_body'] . "<br />\n" . $lang['EM_line_num'] . $commands[$i]['line']);
					break;
				}
			}

			// if there is no search fragment for an AFTER, BEFORE, or REPLACE then throw a crit error
			if (($search_fragment == '') && ($commands[$i]['command'] != 'IN-LINE FIND'))
			{
				display_error('<b>' . $lang['EM_err_critical_error'] . "</b><br /><br />\n" . $commands[$i]['command'] . $lang['EM_err_no_ifind'] . "<br />\n" . $lang['EM_line_num'] .$commands[$i]['line']);
				break;
			}


			// make the actual alteration for after, before, and replace
			if ($commands[$i]['command'] == 'IN-LINE AFTERADD')
			{
				$result = perform_inline_add($find_array, $file_list, $search_fragment, $body[$i][0], 'after');
			}
			else if ($commands[$i]['command'] == 'IN-LINE BEFOREADD')
			{
				$result = perform_inline_add($find_array, $file_list, $search_fragment, $body[$i][0], 'before');
			}
			else if ($commands[$i]['command'] == 'IN-LINE REPLACE')
			{
				$result = perform_inline_add($find_array, $file_list, $search_fragment, $body[$i][0], 'replace');
			}
			// strip off white space and get our search fragment (we already know it is not an empty string)
			else if ($commands[$i]['command'] == 'IN-LINE FIND')
			{
				$search_fragment = trim($body[$i][0]);
			}
			else
			{
				$bad_command = true;
			}

			// display any errors; if it was critical, terminate processing; if warn, remove file from list
			//   the command will also close the files that we were writing
			if (handle_error($result, $file_list, $commands[$i]['line'], true, $find_array))
			{
				break;
			}
		}

		else if ($commands[$i]['command'] == 'SQL')
		{
			$sql[] = $body[$i];
		}

		else if ( $commands[$i]['command'] == 'DIY INSTRUCTIONS')
		{
			$diy[] = $body[$i];
		}

		//
		// setup the copying of files from the mod directory to core directories
		//
		else if ($commands[$i]['command'] == 'COPY')
		{
			// strip the body of whitespace lines; allow multiple lines
			$body[$i] = strip_whitespace($body[$i], false);

/*
//////////////////////////////////////////////////////////////////////////////
// this COPY command was mostly written by Ptirhiik and integrated by me.  It's not perfect yet, and I can't remember why
//   since it's been soooooo long since I worked on the dang thing!  Will fine tune it later.  
//////////////////////////////////////////////////////////////////////////////


////////// yeah.... can't remember what most of these notes mean ;-)

copy to *.*
copy *.*
copy templates/*.*				to foo
copy includes/functions?.* to foo
copy templates/Default/images/icon*.gif to foo
copy templates/sub* to templates/sav
copy ind*.php to sav*.?u?

copy foo_body.tpl to templates/Default/foo_body.tpl 
copy foo_body.tpl to templates/Default/ 
copy *.* to templates/Default/ 

want to work:
copy admin_flags.php to admin/admin_flags.php				// basic
copy admin_flags.php 		to 	admin/admin_flags.php		// basic with tabs
copy admin_flags.php		to	admin/				// to a dir with trailing slash
copy admin_flags.php		to	admin					// to a dir without trailing slash
copy admin_flags.php		to	admin/*.*				// to a dir as *.*
copy admin_flags.?h?		to	admin					// from with ? wildcards
copy admin_flags.*		to	admin					// from with * wildcard
copy a*.*				to	admin					// from with * wildcards
copy *.*				to	admin					// from as *.*

on the bubble:
copy admin_flags.php		to	admin/*				// to a dir as *
copy a*s.*				to	admin					// from with * wildcards
copy templates/sub* to templates/sav			// wow!!!
copy ind*.php to sav*.?u?					// the heck??



#copy admin_flags.php		to	admin/
#copy admin_flags.php		to	admin/*.*
#copy admin_flags.?h?		to	admin
#copy admin_flags.*		to	admin
#copy admin_flags.*		to	admin/
#copy a*.*			to	admin/
#copy a*.*			to	admin/xxx		// sends files to admin/xxx/ directory
#copy admin_flags.php		to	admin			// careful! Will create a FILE named admin!!
#copy *.*			to	admin
#copy flags/a*.*		to	admin
#copy admin_flags.php		to	admin/*			// careful! file named 'admin_flags' w/o .php!
#copy admin_flags.php		to	admin/*.sfdg
#copy a*s.*				to	admin
#copy processed/templates/sub* to templates/sav
#copy a*.php to sav*.?u?


*/

			// multiple copies : from
			$tmp_mult['from_path'] = array();
			$tmp_mult['from_file'] = array();
			$tmp_mult['to_path'] = array();
			$tmp_mult['to_file'] = array();


			//
			// first pass : split qualified copies from masked copies
			//
			$bad_copy = false;
			for ( $j = 0; $j < count($body[$i]); $j++ )
			{
				$split_line = array();
				// make sure the command is in proper format "copy x to y"
				if (!$split_line = copy_check_basic_form($body[$i][$j]))
				{
//echo "1<br />\n";
					display_error('<b>' . $lang['EM_err_critical_error'] . "</b><br /><br />\n" . $lang['EM_err_copy_format'] . '<br />' . trim($body[$i][$j]) . "<br />\n" . $lang['EM_line_num'] .$commands[$i]['line']);
					$bad_copy = true;
					break;
				}

				// makes sure the filename+path are ok and do a little formatting
				if ((!$targ = copy_check_file(trim( $split_line[1]))) || 
					(!$dest = copy_check_file(trim( $split_line[3]))))
				{
//echo "2<br />\n";
					display_error('<b>' . $lang['EM_err_critical_error'] . "</b><br /><br />\n" . $lang['EM_err_copy_format'] . '<br />' . trim($body[$i][$j]) . "<br />\n" . $lang['EM_line_num'] .$commands[$i]['line']);
					$bad_copy = true;
					break;
				}

				// final format check, make sure we have a muli dest if we have a multi targ
				if ( strstr($targ['file'], '*') || strstr($targ['file'], '?') )
				{
					// force this to be a multi dest listing if not so already
					if ((!strstr( $dest['file'], '*')) && (!strstr( $dest['file'], '?')) )
					{
						$dest['path'] .= $dest['file'] . '/';
						$dest['file'] = '*.*';
					}
				}				
				else
				{
					// check to see if the file exists
					if (!file_exists($install_path . $targ['path'] . $targ['file']) )
					{
						display_error('<b>' . $lang['EM_err_critical_error'] . "</b><br /><br />\n" . sprintf($lang['EM_err_comm_copy'], $install_path . $targ['path'], $targ['file']) . '<br />' . trim($body[$i][$j]) . "<br />\n" . $lang['EM_line_num'] .$commands[$i]['line']);
						$bad_copy = true;					
					}

				}

				// store
				$tmp_mult['from_path'][] = $targ['path'];
				$tmp_mult['from_file'][] = $targ['file'];
				$tmp_mult['to_path'][] = $dest['path'];
				$tmp_mult['to_file'][] = $dest['file'];
			}

			// if we failed then halt processing
			if ($bad_copy)
			{
				break;
			}

			//
			// second pass : get the relevant files with the mask
			//
			for ( $j = 0; $j < count($tmp_mult['from_path']); $j++ )
			{
				if ($bad_copy)
				{
					break;
				}
				$tmp_from_path = $tmp_mult['from_path'][$j];
				$tmp_from_file = $tmp_mult['from_file'][$j];
				$tmp_to_path = $tmp_mult['to_path'][$j];
				$tmp_to_file = $tmp_mult['to_file'][$j];

				// from mask
				$tmp_all = ($tmp_from_file == '*.*');
				$tmp_from_mask = '^' . str_replace(array('*', '?'), array('(.+)', '(.)'), $tmp_from_file . '$');

				// to maks
				$tmp_to_mask = $tmp_to_file;
				$tmp_pos = strrpos($tmp_to_mask, '.');
				if ( $tmp_pos === false )
				{
					$tmp_to_ext = '';
					$tmp_to_base = $tmp_to_file;
				}
				else
				{
					$tmp_to_ext = substr($tmp_to_file, $tmp_pos+1);
					$tmp_to_base = substr($tmp_to_file, 0, $tmp_pos);
				}

				// stack of subdirs
				$tmp_dirs_from = array();
				$tmp_dirs_to = array();

				// init with the asked dir
				array_push($tmp_dirs_from, $tmp_from_path);
				array_push($tmp_dirs_to, $tmp_to_path);

				// let's go
				$first_pass = true;
				while ( !empty($tmp_dirs_from) )
				{
					// get the dir
					$tmp_from_dir = array_pop($tmp_dirs_from);
					$tmp_to_dir = array_pop($tmp_dirs_to);

					// we are no more on the main dir, so accept all files and sub dirs
					if ( !$first_pass )
					{
						$tmp_all = true;
					}
					$first_pass = false;

					// another one bites the dust
					if (!$tmp_handle = @opendir($install_path . $tmp_from_dir) )
					{
//echo "3 [$install_path][$tmp_from_dir]<br />\n";
						display_error('<b>' . $lang['EM_err_critical_error'] . "</b><br /><br />\n" . $lang['EM_err_copy_format'] . '<br />' . trim($body[$i][$j]) . "<br />\n" . $lang['EM_line_num'] .$commands[$i]['line']);
						$bad_copy = true;
						break;
					}

					while ( $tmp_file = readdir($tmp_handle) )
					{
						// don't take care of . & ..
						if ( in_array($tmp_file, array('.', '..')) )
						{
							continue;
						}
						// check if relevant name
						else if ( !$tmp_all && !ereg($tmp_from_mask, $tmp_file) )
						{
							continue;
						}

						// if we keep the full name or are in sub-dirs, don't bother to filter the dest mask
						$tmp_to_file = $tmp_file;
						if ( !$tmp_all )
						{
							// split in basename + ext
							$tmp_pos = strrpos($tmp_file, '.');
							$tmp_from_ext = '';
							$tmp_from_base = $tmp_file;
							if ( $tmp_pos)
							{
								$tmp_from_ext = substr($tmp_file, $tmp_pos+1);
								$tmp_from_base = substr($tmp_file, 0, $tmp_pos);
							}

							$w_base = process_file_split($tmp_to_base, $tmp_from_base);
							$w_ext = process_file_split($tmp_to_ext, $tmp_from_ext);

							// get the final result
							$tmp_to_file = $w_base . ( empty($w_ext) ? '' : '.' . $w_ext );
						}


						// if we are on a dir, push it
						if ( is_dir($install_path . $tmp_from_dir . $tmp_file) )
						{
							array_push($tmp_dirs_from, $tmp_from_dir . $tmp_file . '/');
							array_push($tmp_dirs_to, $tmp_to_dir . $tmp_to_file . '/');
						}
						// we are on a file
						else
						{
							$final = array();
							$final = final_formatting($tmp_to_dir, $tmp_to_file, $tmp_from_dir, $tmp_file);
							for ($x=0; $x<count($final); $x++)
							{
								//$command_file->modio_mkdirs_copy( $final[$x]['to_path']);
								$command_file->afile[] = 'copy ' . $final[$x]['from_path'] . $final[$x]['from_file'] . ' ../../../' . $final[$x]['to_path'] . $final[$x]['to_file'];

//echo 'copy ' . $final[$x]['from_path'] . $final[$x]['from_file'] . ' ../../../' . $final[$x]['to_path'] . $final[$x]['to_file'] . "<br />\n";
							}
						}
					}
				}
			}


			// if we failed then halt processing
			if ($bad_copy)
			{
				break;
			}
		}


		//
		// we are done!  close up shop and stop processing
		//
		else if ($commands[$i]['command'] == 'CLOSE')
		{
			// if we haven't dumped the find_array, then do it now
			if (count($find_array) != 0)
			{
				//   also, see if we need to write the lines in preview format
				$do_preview = ((strstr($commands[$i-1]['command'], 'IN-LINE') || $commands[$i-1]['command'] == 'INCREMENT') && ($preview)) ? true : false;
				write_find_array($find_array, $file_list, $do_preview);
				$find_array = array();
			}

			// if we have a file open, close it now
			if (!complete_file_reproduction( $file_list))
			{
				// close failed; throw errors and halt
				for ($errs=0; $errs<count($file_list); $errs++)
				{
					display_error('<b>' . $lang['EM_err_critical_error'] . "</b><br /><br />\n" . $file_list[$errs]->err_msg . "<br />\n" . $lang['EM_line_num'] . $commands[$i]['line']);
				}

				// halt processing
				break;
			}

			$body[$i] = array();
			$failed = false;
			$exec_close = true;
		}
		else
		{
			$bad_command = true;
		}

		//
		// where unloved commands go ;-)
		//
		if ($bad_command)
		{
			$processed = false;
			$num_unprocessed++;
			if ($mode == 'process')
			{
				display_unprocessed_line($commands[$i], $body[$i]);
			}
		}


		// we processed the command, increase our count and display command info on screen
		if (($processed) && ($mode == 'process'))
		{
			$num_processed++;
			display_line( $commands[$i], $body[$i]);
		}
	}

	// close the ftp connection
	$command_file->modio_cleanup('move');

	//
	// we will now finish up the download or display file if that's what we're doing
	//
	if (($mode == 'display_file') || ($mode == 'download_file'))
	{
		// if we have a file open, close it now
		if (!$exec_close)
		{
			// if we haven't dumped the find_array, then do it now
			if (count($find_array) != 0)
			{
				//   also, see if we need to write the lines in preview format
				$do_preview = ((strstr($commands[$i-1]['command'], 'IN-LINE') || $commands[$i-1]['command'] == 'INCREMENT') && ($preview)) ? true : false;
				write_find_array($find_array, $file_list, $do_preview);
			}

			// not likely a close error will be thrown
			complete_file_reproduction($file_list);
		}

		// make sure we have the right file
		for ($file=0; $file<count($file_list); $file++)
		{
			// make sure this is what we are looking for, otherwise keep looking
			if ($orig_file != ($file_list[$file]->path . $file_list[$file]->filename))
			{
				continue;
			}

			// write out the lines
			$preview_display = false;
			$preview_count = count($file_list[$file]->afile);
			for ($i=0; $i<$preview_count; $i++)
			{
				// writing to file, so do NOT use htmlspecial chars
				if ($mode == 'download_file')
				{
					echo $file_list[$file]->afile[$i];
				}

				// writing to screen so you damn well better use htmlspecial chars!
				else
				{
					// if we encountered a line with the designated EM preview symbol then make it stand out
					if (substr($file_list[$file]->afile[$i], 0, 4) == 'EM>>')
					{
						// the first line of a preview display, being bolding
						if (!$preview_display)
						{
							echo '</pre><pre class="preview">' . htmlspecialchars(substr($file_list[$file]->afile[$i], 4));
						}

						// special case: the very last line of the file, end the bolding
						else if ($i == ($preview_count-1))
						{
							echo htmlspecialchars(substr($file_list[$file]->afile[$i], 4));
						}

						// a middle line of the preview display, just print the line
						else
						{
							echo htmlspecialchars(substr($file_list[$file]->afile[$i], 4));
						}

						$preview_display = true;
					}

					// first line following a preview display line, end the bolding and then carry on
					else if ($preview_display)
					{
						echo '</pre><pre class="normal">' . htmlspecialchars($file_list[$file]->afile[$i]);
						$preview_display = false;
					}

					// normal line
					else
					{
						echo htmlspecialchars($file_list[$file]->afile[$i]);
					}
				}
			}

			// finish the html tag
			if ($mode == 'display_file')
			{
				echo "</pre>\n</body>\n</html>\n";
			}

			// done! done! done!
			exit;
		}

		// didn't find the file!  OH CRAP!
		echo sprintf($lang['EM_err_modify'], $orig_file)  . "\n";
		exit;
	}


	//
	// fill in the template info
	//
	$mod_title = '';
	$mod_author_handle = '';
	$mod_author_email = '';
	$mod_author_name = '';
	$mod_author_url = '';
	$mod_description = '';
	$mod_version = '';
	$compliant = $modx_mod = false;

	// get the properties of the MOD so we can display them nicely
	get_mod_properties($install_path . '/' . $install_file, $mod_title, $mod_author_handle, $mod_author_email, $mod_author_name, $mod_author_url, $mod_description, $mod_version, $compliant, $modx_mod);

	$mod_themes = get_themes();
	if ($mod_themes == '')
	{
		message_die(CRITICAL_ERROR, $lang['EM_err_theme_info']);
	}
	$mod_langs = get_languages('../language');

	$phpbb_version = get_phpbb_version();
	if ($phpbb_version == '')
	{
		message_die(GENERAL_ERROR, $lang['EM_err_phpbb_ver']);
	}
	$print_path = 'admin' . substr($install_path, 1);

	// fill in the template with all our info
	$template->assign_vars(array(
		'S_ACTION' => append_sid('admin_easymod.' . $phpEx),
		'L_MOD_DATA' => $lang['EM_Mod_Data'],
		'L_MOD_TITLE' => $lang['EM_Mod_Title'],
		'L_AUTHOR' => $lang['EM_Author'],
		'L_THEMES' => $lang['EM_Proc_Themes'],
		'L_LANGUAGES' => $lang['EM_Proc_Languages'],
		'L_FILES' => $lang['EM_Files'],
		'L_UNPROCESSED' => $lang['EM_unprocessed_commands'],
		'L_UNPROCESSED_DESC' => $lang['EM_unprocessed_desc'],
		'L_PROCESSED' => $lang['EM_processed_commands'],
		'L_PROCESSED_DESC' => $lang['EM_processed_desc'],

		'INSTALL_PATH' => $print_path,
		'TITLE' => $mod_title,
		'VERSION' => $mod_version,
		'MOD_FILE' => $install_file,
		'AUTHOR' => $mod_author_handle,
		'EMAIL' => $mod_author_email,
		'REAL_NAME' => $mod_author_name,
		'URL' => $mod_author_url,

		'THEMES' => $mod_themes,
		'LANGUAGES' => $mod_langs,
		'FILES' => $files_edited,
		'PROCESSED' => $num_processed,
		'UNPROCESSED' => $num_unprocessed,
		'PREVIEW' => $preview,
		'EM_PASS' => htmlspecialchars($password))
	);


	// if we succeed, tell them where to go from here (1 step down, 2 more to go)
	if ( !$failed)
	{
		// we'll want to remember the command file steps, so pass them along
		$hidden = '';
		for ($i=0; $i<count( $command_file->afile); $i++)
		{
			$hidden .= '<input type="hidden" name="command_step'.$i.'" value="' . $command_file->afile[$i] . "\" />\n";
		}
		$hidden .= '<input type="hidden" name="num_command_steps" value="' . $i . "\" />\n";

		// load up any SQL commands into hidden fields as well
		for ($i=0; $i<count($sql); $i++)
		{
			$line = '';
			for ($j=0; $j<count($sql[$i]); $j++)
			{
				$line .= $sql[$i][$j];
			}
			$hidden .= '<input type="hidden" name="SQL'.$i.'" value="' . htmlspecialchars($line) . "\" />\n";
		}
		$hidden .= '<input type="hidden" name="num_sql_steps" value="' . $i . "\" />\n";

		// put DIY INSTRUCTIONS in hidden fields
		for($i = 0; $i < count($diy); $i++ )
		{
			$line = '';
			for ($j=0; $j<count($diy[$i]); $j++)
			{
				$line .= $diy[$i][$j];
			}
			$hidden .= '<input type="hidden" name="diy_array[]" value="' . htmlspecialchars($line) . "\" />\n";
		}

		$template->assign_block_vars('success', array(
			'L_STEP' => $lang['EM_proc_step1'],
			'L_COMPLETE' => $lang['EM_proc_complete'],
			'L_DESC' => $lang['EM_proc_desc'],
			'L_NEXT_STEP' => $lang['EM_next_step'],

			'TITLE' => $mod_title,
			'INSTALL_PATH' => $print_path,

			'HIDDEN' => $hidden,
			'MOD_FILE' => $install_file,
			'MOD_PATH' => $install_path)
		);
	}

	// if we failed, then we'll report the bad news and what to do
	else
	{
		$template->assign_block_vars('fail', array(
			'L_TITLE' => $lang['EM_error_detail'],
			'L_FAILED' => $lang['EM_proc_failed'],
			'L_FAILED_DESC' => $lang['EM_proc_failed_desc'],
			'ERROR_MESSAGE' => $fail_message)
		);
	}
}

//
// setup the SQL processing - skip this step in preview mode!
//
else if (($mode == 'SQL_view') && (!$preview))
{
	// get the vars we are passing along
	$themes = (isset($_POST['themes'])) ? stripslashes($_POST['themes']) : '';
	$languages = (isset($_POST['languages'])) ? stripslashes($_POST['languages']) : '';
	$files = (isset($_POST['files'])) ? intval($_POST['files']) : 0;
	$num_proc = (isset($_POST['num_proc'])) ? intval($_POST['num_proc']) : 0;
	$num_unproc = (isset($_POST['num_unproc'])) ? intval($_POST['num_unproc']) : 0;
	$diy = (isset($_POST['diy_array'])) ? $_POST['diy_array'] : array();

	// get the post process operations and prepare to send them to the next step
	$num_command_steps = (isset($_POST['num_command_steps'])) ? intval($_POST['num_command_steps']) :0;
	$hidden = '';
	for( $i = 0; $i < $num_command_steps; $i++ )
	{
		$var_name = 'command_step' . $i;
		if (isset($_POST[$var_name]))
		{
			$hidden .= '<input type="hidden" name="command_step'.$i.'" value="' . $_POST[$var_name] . "\" />\n";
		}
	}
	$hidden .= '<input type="hidden" name="num_command_steps" value="' . $i . "\" />\n";

	// put DIY instructions in hidden vars
	for( $i = 0; $i < count($diy); $i++ )
	{
		$hidden .= '<input type="hidden" name="diy_array[]" value="' . stripslashes(htmlspecialchars($diy[$i])) . "\" />\n";
	}

	// get the SQL commands we are going to translate
	$sql = array();
	$num_sql_steps = (isset($_POST['num_sql_steps'])) ? intval($_POST['num_sql_steps']) : 0;
	for( $i = 0; $i < $num_sql_steps; $i++ )
	{
		$var_name = 'SQL' . $i;
		if (isset($_POST[$var_name]))
		{
			if (isset($_POST[$var_name]))
			{
				$sql[] = trim(stripslashes($_POST[$var_name]));
			}
		}
	}

	// Show the SQL template
	$template->set_filenames(array(
		'body' => 'admin/mod_sql_body.tpl')
	);

	// Parser SQL statements, if any
	$formatted_sql = array();
	$sql_warnings = array();
	$error = '';
	if( count($sql) > 0 )
	{
		// Use the old SQL Parser for MS-Access, support for which has been dropped
		if( SQL_LAYER == 'msaccess' )
		{
			// turn the psuedo mysql into SQL for this user's DB type
			require($phpbb_root_path . 'admin/em_includes/em_schema.' . $phpEx);
			for( $i = 0; $i < count($sql); $i++ )
			{
				$return_sql = handle_db_alteration($sql[$i], $error);
				if (!empty($error))
				{
					$template->assign_block_vars('error', array('ERROR_MSG' => $error));
					break;
				}

				for( $j = 0; $j < count($return_sql); $j++ )
				{
					$formatted_sql[] = $return_sql[$j];
				}
			}
		}

		// Use the new SQL Parser to deal with any other SQL server
		else
		{
			// Load the new SQL Parser
			if( @file_exists($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_sql_parser.' . $phpEx) )
			{
				require($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_sql_parser.' . $phpEx);
			}
			else
			{
				require($phpbb_root_path . 'language/lang_english/lang_sql_parser.' . $phpEx);
			}
			require($phpbb_root_path . 'includes/sql/sql_parser.' . $phpEx);

			// Instatiate the SQL Parser object.
			$sql_parser = new sql_parser();

			// Parse and convert the SQL statements for this user's DB type.
			$result = $sql_parser->parse_stream(implode("\n", $sql), $table_prefix);

			if( $result & SQL_PARSER_ERROR )
			{
				$error = '<b>Error:</b><br />' . $sql_parser->error_message['message'] . '<br /><br /><b>SQL:</b><br />' . $sql_parser->sql_input[$sql_parser->sql_count];
				$template->assign_block_vars('error', array('ERROR_MSG' => $error));
			}
			if( $result & SQL_PARSER_WARNINGS )
			{
				$sql_warnings = $sql_parser->warnings;
			}
			for( $j = 0; $j < count($sql_parser->sql_output); $j++ )
			{
				$formatted_sql[] = $sql_parser->sql_output[$j];
			}
		}
	}

	// print message if there is no SQL to worry about
	else
	{
		$template->assign_block_vars('no_sql', array());
		$template->assign_vars(array('L_NO_SQL' => $lang['EM_no_sql']));
		$error = 'none';
	}

	// display the list of SQL to generate and give user the option to not run them; display warnings if needed
	$drop_warning = false;
	$steps = 0;
	// if there was an error, then simply skip this
	if (empty($error))
	{
		// Display warnings generated by the SQL Parser, if any
		$sql_warnings_count = count($sql_warnings);
		if ($sql_warnings_count > 0)
		{
			$template->assign_block_vars('warnings_block', array(
				'TITLE'	=> sprintf($lang['EM_sql_warnings_reported'], $sql_warnings_count)
			));
			for( $i = 0; $i < $sql_warnings_count; $i++ )
			{
				$template->assign_block_vars('warnings_block.line', array(
					'TEXT'	=> $sql_warnings[$i]['message']
				));
			}
		}

		// Show the mark/unmark commands
		$template->assign_block_vars('sql_rows', array());

		for( $i = 0; $i < count($formatted_sql); $i++ )
		{
			$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

			// see if this is the warning about dropping columns in postgresql
			$split = explode(' ', $formatted_sql[$i]);
			$hidden_sql = '';
			if ($split[0] == 'ABORTED:')
			{
				$formatted_sql[$i] = '<b>' . htmlspecialchars($formatted_sql[$i]) . ';</b>';
				$hidden_sql = '';
				$check = '';
			}
			else
			{
				$formatted_sql[$i] = htmlspecialchars($formatted_sql[$i]) . ';';
				$hidden_sql = '<input type="hidden" name="SQL' . $steps . '" value="' . $formatted_sql[$i] . '" />';
				$check = '<input type="checkbox" name="check_SQL' . $steps . '" checked="checked" />';
				$steps++;
			}

			// see if there are any DROP's we should warn the user about; we only want to display the warning once
			if ((!$drop_warning) && ((strtoupper($split[0]) == 'DROP') || (strtoupper($split[3]) == 'DROP')))
			{
				$template->assign_block_vars('drop_warning', array());
				$template->assign_vars(array(
					'L_SQL_DROP_WARN' => $lang['EM_sql_drop_warning'],
					'L_URGENT_WARNING' => $lang['EM_urgent_warning'])
				);
				$drop_warning = true;
			}

			$template->assign_block_vars('sql_row', array(
				'ROW_CLASS' => $row_class,
				'STMT_COUNT' => $i+1,
				'HIDDEN_SQL' => $hidden_sql,
				'CHECK' => $check,
				'DISPLAY_SQL' => $formatted_sql[$i])
			);
		}
	}
	$hidden .= '<input type="hidden" name="num_sql_steps" value="' . $steps . "\" />\n";

	// if it's postgre or mssql, let them know I don't have things quite right yet!
// Commented out since the new SQL Parser should process them nicely
//	if (($error == '') && ((SQL_LAYER == 'mssql') || (SQL_LAYER == 'postgresql')))
//	{
//		$link = 'http://area51.phpbb.com/phpBB/viewtopic.php?t=';
//		$link .= (SQL_LAYER == 'postgresql') ? '15388' : '15389';
//
//		$template->assign_block_vars('experimental', array());
//		$template->assign_vars(array(
//			'L_EXPERIMENTAL_EXPLAIN' => sprintf($lang['EM_experimental_explain'], SQL_LAYER, $link))
//		);
//	}

	// if it's msaccess, let them know that we can't add defaults :(
	if (($error == '') && (SQL_LAYER == 'msaccess'))
	{
		$template->assign_block_vars('msaccess', array());
		$template->assign_vars(array('L_SQL_MSACCESS_WARN' => $lang['EM_sql_msaccess_warning']));
	}

	// fill the template
	$template->assign_vars(array(
		'S_ACTION' => append_sid('admin_easymod.' . $phpEx),

		'L_STEP' => $lang['EM_sql_step2'],
		'L_SQL_INTRO' => $lang['EM_sql_intro_explain'],
		'L_ALTERATIONS' => $lang['EM_Alterations'],
		'L_PSEUDO' => sprintf($lang['EM_proposed_alterations'], SQL_LAYER),
		'L_ALLOW' => $lang['EM_Allow'],
		'L_PERFORM' => $lang['EM_Perform'],
		'L_COMPLETE' => $lang['EM_complete_install'],
		'L_NOTICE' => $lang['EM_notice'],
		'L_MARK_ALL' => $lang['Mark_all'],
		'L_UNMARK_ALL' => $lang['Unmark_all'],

		'L_SQL_PROCESS_ERROR' => $lang['EM_sql_process_error'],
		'L_NO_SQL_PREFORMED' => $lang['EM_no_sql_preformed'],
		'L_FOLLOWING_ERROR' => $lang['EM_following_error'],

		'THEMES' => $themes,
		'LANGUAGES' => $languages,
		'FILES' => $files,
		'PROCESSED' => $num_proc,
		'UNPROCESSED' => $num_unproc,
		'MOD_FILE' => $install_file,
		'MOD_PATH' => $install_path,
		'MODE' => ($error == '') ? 'SQL_execute' : 'post_process',
		'HIDDEN' => $hidden,
		'EM_PASS' => htmlspecialchars($password))
	);
}

else if ( $mode == 'SQL_execute' )
{
	// get the vars we are passing along
	$themes = (isset($_POST['themes'])) ? stripslashes($_POST['themes']) : '';
	$languages = (isset($_POST['languages'])) ? stripslashes($_POST['languages']) : '';
	$files = (isset($_POST['files'])) ? intval($_POST['files']) : 0;
	$num_proc = (isset($_POST['num_proc'])) ? intval($_POST['num_proc']) : 0;
	$num_unproc = (isset($_POST['num_unproc'])) ? intval($_POST['num_unproc']) : 0;
	$diy = (isset($_POST['diy_array'])) ? $_POST['diy_array'] : array();

	// get the post process operations and prepare to send them to the next step
	$num_command_steps = (isset($_POST['num_command_steps'])) ? intval($_POST['num_command_steps']) :0;
	$hidden = '';
	for( $i = 0; $i < $num_command_steps; $i++ )
	{
		$var_name = 'command_step' . $i;
		if (isset($_POST[$var_name]))
		{
			$hidden .= '<input type="hidden" name="command_step'.$i.'" value="' . $_POST[$var_name] . "\" />\n";
		}
	}
	$hidden .= '<input type="hidden" name="num_command_steps" value="' . $i . "\" />\n";

	// put DIY instructions in hidden vars
	for( $i = 0; $i < count($diy); $i++ )
	{
		$hidden .= '<input type="hidden" name="diy_array[]" value="' . stripslashes(htmlspecialchars($diy[$i])) . "\" />\n";
	}

	// get the SQL commands we are going to execute
	$num_sql_steps = (isset($_POST['num_sql_steps'])) ? intval($_POST['num_sql_steps']) : 0;
	$sql = array();
	$failure = false;
	for( $i = 0; $i < $num_sql_steps; $i++ )
	{
		$sql_name = 'SQL' . $i;
		$sql_check = 'check_' . $sql_name;
		$sql_line = ( !empty($_POST[$sql_name]) ) ? stripslashes(trim($_POST[$sql_name])) : '';
		$sql_allow = ( isset($_POST[$sql_check])) ? ( ($_POST[$sql_check]) ? TRUE : 0 ) : 0;

		if ($failure)
		{
			$sql[] = array('command' => $sql_line, 'status' => '<b>' . '1'.$lang['EM_not_attempted'] . '</b>');
		}
		else if ($sql_allow)
		{

			if( !($result = $db->sql_query($sql_line)) )
			{
				// set the status
				$sql[] = array('command' => $sql_line, 'status' => '<b>' . $lang['EM_failed'] . '</b>');
				$failure = true;

				$error = $db->sql_error();
//echo "[" . $error['message'] . "][" . $error['code'] . "]<br />\n";
//exit;
				// load up an error message
				$template->assign_block_vars( 'sql_error', array(
					'LINE' => htmlspecialchars($sql_line) . ';',
					'ERROR_CODE' => $error['code'],
					'ERROR_MSG' => $error['message'])
				);
				$template->assign_vars(array(
					'L_SQL_ERROR' => $lang['EM_sql_error'],
					'L_SQL_ERROR_EXPLAIN' => $lang['EM_sql_error_explain'],
					'L_FAILED_LINE' => $lang['EM_failed_line'],
					'L_SQL_HALTED' => $lang['EM_sql_halted'])
				);
			}
			else
			{
				$sql[] = array('command' => $sql_line, 'status' => $lang['EM_success']);
			}
		}
		else
		{
			$sql[] = array('command' => $sql_line, 'status' => '<b>' . $lang['EM_skipped'] . '</b>');
		}
	}


	// Show the SQL template
	$template->set_filenames(array(
		'body' => 'admin/mod_sql_body.tpl')
	);

	// display the list of SQL to generate and give use the option to not run them; display warnings if needed
	$steps = 0;
	for( $i = 0; $i < count($sql); $i++ )
	{
		$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
		$template->assign_block_vars( 'sql_row', array(
			'ROW_CLASS' => $row_class,
			'HIDDEN' => '',
			'CHECK' => $sql[$i]['status'],
			'DISPLAY_SQL' => htmlspecialchars($sql[$i]['command']) . ';')
		);
	}
	$sql_intro = $lang['EM_line_results'];
	$sql_intro .= (!$failure) ? ' - <b>' . $lang['EM_all_lines_successfull'] . '</b>' : ' - <b>' . $lang['EM_errors_detected'] . '</b>';

	// fill the template
	$template->assign_vars(array(
		'S_ACTION' => append_sid('admin_easymod.' . $phpEx),

		'L_STEP' => $lang['EM_sql_step2'],
		'L_SQL_INTRO' => $sql_intro,
		'L_ALTERATIONS' => $lang['EM_processing_results'],
		'L_PSEUDO' => $lang['EM_sql_attempted'],
		'L_ALLOW' => $lang['EM_Allow'],
		'L_PERFORM' => $lang['EM_Perform'],
		'L_COMPLETE' => $lang['EM_complete_install'],

		'THEMES' => $themes,
		'LANGUAGES' => $languages,
		'FILES' => $files,
		'PROCESSED' => $num_proc,
		'UNPROCESSED' => $num_unproc,
		'MOD_FILE' => $install_file,
		'MOD_PATH' => $install_path,
		'MODE' => 'post_process',
		'HIDDEN' => $hidden,
		'EM_PASS' => htmlspecialchars($password))
	);
}

//
// last step!  move the files into place - force this step if in preview mode
//
else if (($mode == 'post_process') || ($preview))
{
	// get the info we are passing along
	$themes = (isset($_POST['themes'])) ? stripslashes($_POST['themes']) : '';
	$languages = (isset($_POST['languages'])) ? stripslashes($_POST['languages']) : '';
	$files = (isset($_POST['files'])) ? intval($_POST['files']) : 0;
	$num_proc = (isset($_POST['num_proc'])) ? intval($_POST['num_proc']) : 0;
	$num_unproc = (isset($_POST['num_unproc'])) ? intval($_POST['num_unproc']) : 0;
	$diy = (isset($_POST['diy_array'])) ? $_POST['diy_array'] : array();

	$hidden = '';

	// explode each new line so they can have their own bullet
	if ( count($diy) )
	{
		$template->assign_block_vars('diy_switch', array(
			'MODE'		=> 'diy_process',
			'S_ACTION'	=> append_sid('admin_easymod.' . $phpEx),
			'EM_PASS' => htmlspecialchars($password))
		);

		$diy_process = array();
		for( $i = 0; $i < count($diy); $i++ )
		{
			$diy_process = array_merge($diy_process, explode("\n", $diy[$i]));
		}

		for( $i = 0; $i < count($diy_process); $i++ )
		{
			$diy_process[$i] = trim($diy_process[$i]);
			if ( !empty($diy_process[$i]) )
			{
				$hidden .= '<input type="hidden" name="diy_array[]" value="' . stripslashes(htmlspecialchars($diy_process[$i])) . "\" />\n";

				$template->assign_block_vars('diy_switch.diyrow', array(
					'INSTRUCTIONS'	=> stripslashes(htmlspecialchars($diy_process[$i])))
				);
			}
		}
	}

	// get the post process operations
	$num_command_steps = (isset($_POST['num_command_steps'])) ? intval($_POST['num_command_steps']) : 0;
	$command = array();
	for( $i = 0; $i < $num_command_steps; $i++ )
	{
		$var_name = 'command_step' . $i;
		if (isset($_POST[$var_name]))
		{
			$command[] = htmlspecialchars($_POST[$var_name]);
		}
	}


	// Show the post process page
	$template->set_filenames(array(
		'body' => 'admin/mod_complete.tpl')
	);


	// write the command files
	$command_file = get_em_settings('post_process.sh', '', $password, $preview);
	$command_bat = new mod_io('post_process.bat', '', $command_file->read_method, $command_file->write_method, $command_file->move_method, $command_file->ftp_user, $command_file->ftp_pass, $command_file->ftp_path, $command_file->ftp_host, $command_file->ftp_port, $command_file->ftp_type, $command_file->ftp_cache);

	// open the command file: config=true,command=true
	if ((!$command_file->modio_open(true)) || ( !$command_bat->modio_open(true)))
	{
		$command_file->err_msg = $lang['EM_trace'] . ':<br /> main[2]->' . $command_file->err_msg;
		message_die(GENERAL_ERROR, '<br />' . $lang['EM_err_open_pp'] . '<br />' . $lang['EM_err_cwd'] . ': ' . getcwd() . '<br />');
	}

	// this is really more about moving the other files than is about the command file; establish the FTP connection
	//  for moving files if necessary
	if (!$command_file->modio_prep('move'))
	{
		$command_file->err_msg = $lang['EM_trace'] . ': main[3]->' . $command_file->err_msg;
		message_die(GENERAL_ERROR, '<b>' . $lang['EM_err_critical_error'] . ':</b><br /> ' . $command_file->err_msg . '<br />');
	}
	// share FTP attributes with the bat file
	$command_bat->emftp = $command_file->emftp;


////////////////////
////////////////////
////////////////////-md5
////////////////////
////////////////////
//	$em_pass = get_em_pw();
	$em_pass = $password;

	$processed_files = array();

	// execute the move!
	$mod_count = 0;
	for( $i = 0; $i < $num_command_steps; $i++ )
	{
/////////BUG: if there is a dir with spaces in the name that is going to cause problems
		$parms = explode(' ', $command[$i]);
		if ($parms[0] == 'copy')
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
				$link = append_sid('admin_easymod.' . $phpEx . '?mode=display_backup&amp;file=' . $parms[1] . "&amp;password=$em_pass");
			}
			else
			{
				$from = $parms[1];
				$to = $parms[2];
				$type = $lang['EM_pp_download'];
				$is_backup = false;
				$link = append_sid('admin_easymod.' . $phpEx . '?mode=display_file&amp;file=' . $parms[2] . "&amp;password=$em_pass&amp;install_file=$install_file&amp;install_path=$install_path");
			}

			// create the directory before moving files into it
			// could be optimized such that modio_mkdirs_copy is only called once per
			// new directory, as opposed to once per original COPY action, but oh well...
			if ((substr($parms[1],0,9) != "processed") && (substr($parms[1],0,9) != "../../../"))
			{
				$command_file->modio_mkdirs_copy(substr(dirname($parms[2]),9).'/' );
			}

			// now the magic happens ;-)
			$ret_value = $command_file->modio_move($parms[2], $parms[1], $mod_count, $link, $type);
			$mod_count++;

			// if there is no return value then that means it didn't work; print the err_msg and bail
			if ($ret_value == '')
			{
				message_die(GENERAL_ERROR, '<b>' . $lang['EM_err_critical_error'] . ':</b> ' . $command_file->err_msg . '<br />' . $lang['EM_err_attempt_remainder'] . '<br />');
			}

			// move was a success, display the output
			else
			{
				// if the destination is a backup, then put in the backup listing
				if ($is_backup)
				{
					// this is relative to the phpBB directory
					$from_file = (substr($from, 0, 9) == '../../../') ? substr($from, 9) : $from;
					$processed_files[] = $from_file;

					$template->assign_block_vars('backups', array(
						'FROM' => $from_file,
						'TO' => $ret_value)
					);
				}

				// put in the move list
				else
				{
					if (!(strstr($parms[1], 'processed/')) && ($ret_value != '<b>' . $lang['EM_pp_complete'] . '</b>') && ($ret_value != '<b>' . $lang['EM_pp_ready'] . '</b>'))
					{
						$ret_value = '<b>' . $lang['EM_pp_manual'] . '</b>';
					}

					$template->assign_block_vars('files', array(
						'FROM' => $from,
						'TO' => ((substr($to, 0, 9) == '../../../') ? substr($to, 9) : $to),
						'COMPLETED' => $ret_value)
					);
				}
			}
		}
	}

	$mod_title = '';
	$mod_author_handle = '';
	$mod_author_email = '';
	$mod_author_name = '';
	$mod_author_url = '';
	$mod_description = '';
	$mod_version = '';
	$compliant = $modx_mod = false;
	get_mod_properties($install_path . '/' . $install_file, $mod_title, $mod_author_handle, $mod_author_email, $mod_author_name, $mod_author_url, $mod_description, $mod_version, $compliant, $modx_mod);

	$template->assign_vars(array(
		'S_ACTION' => append_sid('admin_easymod.' . $phpEx),

		'L_STEP' => $lang['EM_pp_step3'],
		'L_COMPLETE' => $lang['EM_pp_install_comp'],
		'L_COMP_DESC' => $lang['EM_pp_comp_desc'],
		'L_COPY_TO' => $lang['EM_pp_to'],
		'L_COPY_STATUS' => $lang['EM_pp_status'],
		'L_COPY_FROM' => sprintf($lang['EM_pp_from'], $install_path . 'processed/'),
		'L_MAKING_BACKUPS' => sprintf( $lang['EM_pp_backups'], $install_path . 'backups/'),

		'L_MOD_DATA' => $lang['EM_Mod_Data'],
		'L_MOD_TITLE' => $lang['EM_Mod_Title'],
		'L_AUTHOR' => $lang['EM_Author'],
		'L_THEMES' => $lang['EM_Proc_Themes'],
		'L_LANGUAGES' => $lang['EM_Proc_Languages'],
		'L_FILES' => $lang['EM_Files'],
		'L_PROCESSED' => $lang['EM_processed_commands'],
		'L_UNPROCESSED' => $lang['EM_unprocessed_commands'],
		'L_DB_ALTERATIONS' => $lang['EM_database_alterations'],
		'L_TABLES_ADDED' => $lang['EM_tables_added'],
		'L_TABLES_ALTERED' => $lang['EM_tables_altered'],
		'L_ROWS_ADDED' => $lang['EM_rows_added'],
		'L_DEPENDS_ON_MOVE' => $lang['EM_text_depend_move'],

		'L_DIY_INSTRUCTIONS' => $lang['DIY_Instructions'],
		'L_DIY_INTRO' => $lang['DIY_intro'],
		'L_FINAL_INSTALL_STEP' => $lang['Final_install_step'],

		'INSTALL_PATH' => $print_path,
		'TITLE' => $mod_title,
		'VERSION' => $mod_version,
		'MOD_FILE' => $install_file,
		'AUTHOR' => $mod_author_handle,
		'EMAIL' => $mod_author_email,
		'REAL_NAME' => $mod_author_name,
		'URL' => $mod_author_url,

		'MOD_FILE' => $install_file,
		'MOD_PATH' => $install_path,
		'MOD_COUNT' => $mod_count,
		'THEMES' => $themes,
		'LANGUAGES' => $languages,
		'FILES' => $files,
		'PROCESSED' => $num_proc,
		'UNPROCESSED' => $num_unproc,
		
		'HIDDEN'	=> $hidden)
	);


	// finish the script generation
	if ((!$command_file->modio_close(true)) || (!$command_bat->modio_close(true)))
	{
		message_die(GENERAL_ERROR, '<br />' . $lang['EM_err_write_pp'] . '<br />' . $lang['EM_err_cwd'] . ': ' . getcwd() . '<br />');
	}

	// closs the FTP session
	$command_file->modio_cleanup('move');	


	$phpbb_version = get_phpbb_version();
	$mod_file = str_replace("\'", "''", addslashes(substr($install_path, 7) . $install_file));
	$mod_title = str_replace("\'", "''", addslashes(substr($mod_title, 0, 255)));
	$mod_author_handle = str_replace("\'", "''", addslashes(substr($mod_author_handle, 0, 25)));
	$mod_author_email = str_replace("\'", "''", addslashes(substr($mod_author_email, 0, 100)));
	$mod_author_name = str_replace("\'", "''", addslashes(substr($mod_author_name, 0, 100)));
	$mod_author_url = str_replace("\'", "''", addslashes(substr($mod_author_url, 0, 100)));
	$mod_description = str_replace("\'", "''", addslashes($mod_description));
	$mod_version = str_replace("\'", "''", addslashes(substr($mod_version, 0, 15)));
	$themes = str_replace("\'", "''", addslashes($themes));
	$languages = str_replace("\'", "''", addslashes($languages));

	if ($preview)
	{
		// do not update the DB while in preview mode
	}
	else
	{
		// We might come here from the 'Restore Backups' option, in this case we'll find the mod_id in the POST array.
		if ( isset($_POST['mod_id']) && ($mod_id = intval($_POST['mod_id'])) > 0 )
		{
			// If we have restored backups, what we really need now is delete the MOD record.
			$sql = 'DELETE FROM ' . EASYMOD_TABLE . " WHERE mod_id = $mod_id";
		}
		else
		{
			// Otherwise, we have just installed a new MOD.
			$sql = 'INSERT INTO ' . EASYMOD_TABLE . " ( mod_file, mod_title, mod_version, mod_author_handle, mod_author_email, mod_author_url, mod_author_name, mod_description, mod_process_date, mod_phpBB_version, mod_processed_themes, mod_processed_langs, mod_files_edited)
				VALUES ( '" . $mod_file . "', '$mod_title', '$mod_version', '$mod_author_handle', '$mod_author_email', '$mod_author_url', '$mod_author_name', '$mod_description', " . time() . ", '" . $phpbb_version . "', '" . $themes . "', '" . $languages . "', $files)";
		}

		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, $lang['EM_err_em_info'], '', __LINE__, __FILE__, $sql);
		}

		if( isset($mod_id) )
		{
			$sql = 'DELETE FROM ' . EASYMOD_PROCESSED_FILES_TABLE . " WHERE mod_id = $mod_id";
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, $lang['EM_err_em_info'], '', __LINE__, __FILE__, $sql);
			}
		}
		else
		{
			// get the ID of the just installed MOD.
			$mod_id = $db->sql_nextid();

			for( $i = 0; $i < count($processed_files); $i++ )
			{
				$sql = 'INSERT INTO ' . EASYMOD_PROCESSED_FILES_TABLE . " (mod_processed_file, mod_id)
					VALUES ('" . $processed_files[$i] . "', $mod_id)";
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, $lang['EM_err_em_info'], '', __LINE__, __FILE__, $sql);
				}
			}
		}
	}
}

//
// show the DIY instructions
// move below post_process?
//
else if ( $mode == 'diy_process' )
{
	$diy = (isset($_POST['diy_array'])) ? $_POST['diy_array'] : array();

	// explode each new line so they can have their own bullet
	$diy_process = array();
	for( $i = 0; $i < count($diy); $i++ )
	{
		$diy_process = array_merge($diy_process, explode("\n", $diy[$i]));
	}

	for( $i = 0; $i < count($diy_process); $i++ )
	{
		$diy_process[$i] = trim($diy_process[$i]);
		if ( !empty($diy_process[$i]) )
		{
			$template->assign_block_vars('diyrow', array(
				'INSTRUCTIONS'	=> stripslashes(htmlspecialchars($diy_process[$i])))
			);
		}
	}

	// Show the SQL template
	$template->set_filenames(array(
		'body' => 'admin/mod_diy_body.tpl')
	);

	// fill the template
	$template->assign_vars(array(
		'L_STEP' => $lang['DIY_final'],
		'L_COMPLETE' => $lang['DIY_Instructions'],
		'L_DIY_INTRO' => $lang['DIY_intro'],
		'L_INSTALL_COMPLETE' => $lang['Install_complete'])
	);

}
	

// actually outputs the template date we've built
$template->pparse('body');

// end  user_id 2 auth
}

// output the footer
include('page_footer_admin.'.$phpEx);


?>
