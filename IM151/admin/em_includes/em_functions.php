<?php
/***************************************************************************
 *                              em_functions.php
 *                            -------------------
 *   begin                : Sunday, Mar 31, 2002
 *   copyright            : (C) 2002-2004 by Nuttzy - Craig Nuttall, 2005 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: em_functions.php,v 1.24 2007/02/22 03:32:20 wgeric Exp $
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

//
// THE PURPOSE of this module is for general housing of EM functions.  They mostly
// deal with parsing files.
//



// define the EM table; there is no need to add this to constants.php
define('EASYMOD_TABLE', $table_prefix.'easymod');
define('EASYMOD_PROCESSED_FILES_TABLE', $table_prefix.'easymod_processed_files');

define('OPEN_OK', 0);
define('OPEN_FAIL_OK', 1);
define('OPEN_FAIL_CRITICAL', 2);

define('FIND_OK', 0);
define('FIND_FAIL_OK', 1);
define('FIND_FAIL_CRITICAL', 2);

define('TEXT', 0);
define('MODX', 1);

///
/// Interface to crypt class
///

define('EM_ENCRYPT', 'em_encrypt');
define('EM_DECRYPT', 'em_decrypt');

function crypt_ftp_pass($crypt_direction, $ftp_pass, $em_pass)
{
	global $phpbb_root_path, $phpEx;

	$key = '';
	for($i = 1, $total = strlen($em_pass); $i < $total; $i = round(($i+1)*2))
	{
		$key .= md5($em_pass{$i});
	}

	require_once($phpbb_root_path . 'admin/em_includes/em_cipher.' . $phpEx);
	$cipher = new Cipher_BlockMode_cbc();
	$crypt_method = ( $crypt_direction == EM_ENCRYPT ? 'encrypt' : 'decrypt' );
	$ftp_pass = $cipher->$crypt_method($ftp_pass, $key);
	unset($cipher);
	return $ftp_pass;
}


///
/// file read/write functions
///

// send a Default filename; return an array that has the corresponding file+path for ALL themes
function get_theme_files( $filename, $path)
{
	global $db ;
	$files = array() ;

	// get the installed themes
	$sql = "SELECT *
		FROM " . THEMES_TABLE ;
	if ( !($result = $db->sql_query($sql)) )
	{
		return array() ;
	}

	// loop through each theme
	while( $row = $db->sql_fetchrow($result) )
	{
		// replace Default with this theme name; FYI 9 = number of letters in "Default"
		$temp_path = substr_replace( $path, $row['template_name'], strpos( $path, 'Default'), 9) ;

		// if the file is Default.css or Default.cfg, change these appropriately
		if ($filename == 'Default.css')
		{
			$temp_file = $row['template_name'] . '.css' ;
		}
		else if ($filename == 'Default.cfg')
		{
			$temp_file = $row['template_name'] . '.cfg' ;
		}

		// the file has the same name in all themes (like viewtopic.tpl)
		else
		{
			$temp_file = $filename ;
		}

		// add to the return array
		$files[] = array('filename' => $temp_file, 'path' => $temp_path) ;
	}

	// peace, out
	return $files ;
}


// send a language filename; return an array that has the corresponding file+path for ALL langs
function get_lang_files( $filename, $path, $lang_path)
{
	global $db ;
	$files = array() ;

	// get a list of languages listed in the languages dir
	$dir = opendir( $lang_path);

	// loop through the list to get all the langs
	while ( $file = readdir($dir) )
	{
		// make sure it is a valid lang dir
		if ( ereg("^lang_", $file) && !is_file( $lang_path . $file) && !is_link( $lang_path . $file) )
		{
			// replace lang_english with this language name; FYI 12 = number of letters in "lang_english"
			$temp_path = substr_replace( $path, $file, strpos( $path, 'lang_english'), 12) ;

			$files[] = array('filename' => $filename, 'path' => $temp_path) ;
		}
	}
	closedir($dir);

	return $files ;
}


// open a core phpBB file for reading and a copy for writing following the user set methods of doing so
function open_files( $filename, $path, &$file_list, &$command_file)
{
	global $lang, $phpbb_root_path ;

	// strip off the path and get the file name
	$splitarray = explode('/', $path) ;
	$error_level = OPEN_OK ;


	// make sure there is a sub directory
	$subdir = ( isset( $splitarray[1] ) ) ? $splitarray[1] : '';

	// if this is a style file, then make sure we open the related file for all styles
	if ( $subdir == 'Default')
	{
		// get a list of all related files and open them
		$files = get_theme_files( $filename, $path) ;
		for ($i=0; $i<count($files); $i++)
		{
			// prep the file
			$edit = new mod_io( $files[$i]['filename'], $files[$i]['path'], $command_file->read_method, $command_file->write_method, $command_file->move_method, $command_file->ftp_user, $command_file->ftp_pass, $command_file->ftp_path, $command_file->ftp_host, $command_file->ftp_port, $command_file->ftp_type, $command_file->ftp_cache) ;
			$edit->emftp = $command_file->emftp ;

			// open the file and update our command file actions
			if ( $edit->modio_open())
			{
				$command_file->afile[] = 'copy ../../../' . $edit->path . $edit->filename . ' ' . 'backups/' . $edit->path . $edit->filename . '.txt' ;
				$command_file->afile[] = 'copy processed/' . $edit->path . $edit->filename . '.txt ../../../' . $edit->path . $edit->filename ;
			}

			// if it failed and this is the Default file, then trigger a critical error to halt processing
			else if ( strstr( $edit->path, 'Default'))
			{
				$edit->err_msg = $lang['EM_trace'] . ': open_files[1]->' . $edit->err_msg ;
				$edit->err_msg = '<b>' . $lang['EM_err_critical_error'] . '</b><br /><br />' . $edit->err_msg ;
				$file_list[] = $edit ;
				return OPEN_FAIL_CRITICAL ;
			}

			// a non-Default file failed, allow failure and drive on; issue warning
			else
			{
				$edit->err_msg = $lang['EM_trace'] . ': open_files[2]->' . $edit->err_msg ;
				$edit->err_msg = '<b>' . $lang['EM_err_warning'] . '</b><br /><br />' . $edit->err_msg ;
				$error_level = OPEN_FAIL_OK ;
			}

			// add to the list
			$file_list[] = $edit ;
		}
	}

	// if this is a lang file, then make sure we open the related file for all languages
	else if ( $subdir == 'lang_english')
	{
		// get a list of all related files and open them
		$lang_path =  $phpbb_root_path . 'language/' ;
		$files = get_lang_files( $filename, $path, $lang_path) ;

		for ($i=0; $i<count($files); $i++)
		{
			// prep the file
			$edit = new mod_io( $files[$i]['filename'], $files[$i]['path'], $command_file->read_method, $command_file->write_method, $command_file->move_method, $command_file->ftp_user, $command_file->ftp_pass, $command_file->ftp_path, $command_file->ftp_host, $command_file->ftp_port, $command_file->ftp_type, $command_file->ftp_cache) ;
			$edit->emftp = $command_file->emftp ;

			// open the file and update our command file actions
			if ( $edit->modio_open())
			{
				$command_file->afile[] = 'copy ../../../' . $edit->path . $edit->filename . ' ' . 'backups/' . $edit->path . $edit->filename . '.txt' ;
				$command_file->afile[] = 'copy processed/' . $edit->path . $edit->filename . '.txt ../../../' . $edit->path . $edit->filename ;
			}

			// if it failed and this is the english file, then trigger a critical error to halt processing
			else if ( strstr( $edit->path, 'lang_english'))
			{
				$edit->err_msg = $lang['EM_trace'] . ': open_files[3]->' . $edit->err_msg ;
				$edit->err_msg = '<b>' . $lang['EM_err_critical_error'] . '</b><br /><br />' . $edit->err_msg ;
				$file_list[] = $edit ;
				return OPEN_FAIL_CRITICAL ;
			}

///////////
/////////// really should only fail on lang_bbcode; not sure if i want it to continue on other files
///////////
			// a non-english file failed, allow failure and drive on; issue warning
			else
			{
				$edit->err_msg = $lang['EM_trace'] . ': open_files[4]->' . $edit->err_msg ;
				$edit->err_msg = '<b>' . $lang['EM_err_warning'] . '</b><br /><br />' . $edit->err_msg ;
				$error_level = OPEN_FAIL_OK ;
			}

			// add to the list
			$file_list[] = $edit ;
		}
	}

	// open a core phpBB file
	else
	{
		// prep the file
		$edit = new mod_io( $filename, $path, $command_file->read_method, $command_file->write_method, $command_file->move_method, $command_file->ftp_user, $command_file->ftp_pass, $command_file->ftp_path, $command_file->ftp_host, $command_file->ftp_port, $command_file->ftp_type, $command_file->ftp_cache) ;
		$edit->emftp = $command_file->emftp ;

		// don't let mods edit config.php
		if (stristr($filename, 'config'))
		{
			$edit->err_msg = $lang['EM_trace'] . ': open_files[6]';
			$edit->err_msg = '<b>' . $lang['EM_err_critical_error'] . '</b><br /><br />' . $lang['EM_error_edit_config'];
			$file_list[] = $edit ;
			return OPEN_FAIL_CRITICAL;
		}

		// open the file and update our command file actions
		if ( $edit->modio_open())
		{
			$file_list[] = $edit ;

			$command_file->afile[] = 'copy ../../../' . $edit->path . $edit->filename . ' ' . 'backups/' . $edit->path . $edit->filename . '.txt' ;
			$command_file->afile[] = 'copy processed/' . $edit->path . $edit->filename . '.txt ../../../' . $edit->path . $edit->filename ;
		}

		// throw an error if we can't open
		else
		{
			$edit->err_msg = $lang['EM_trace'] . ': open_files[5]->' . $edit->err_msg ;
			$edit->err_msg = '<b>' . $lang['EM_err_critical_error'] . '</b><br /><br />' . $edit->err_msg ;
			$file_list[] = $edit ;
			return OPEN_FAIL_CRITICAL ;
		}
	}

	return $error_level ;
}


// write the specified line to all the files we have open
function write_files( &$file_list, $buffer)
{
	for ($i=0; $i<count($file_list); $i++)
	{
		$file_list[$i]->modio_write( $buffer ) ;
	}
}


// finish replicating the contents of a file
function complete_file_reproduction( &$file_list)
{
	// if other file is open, finish writing file and close it
	$no_errors = true ;
	for ($i=0; $i<count($file_list); $i++)
	{
		while (!feof($file_list[$i]->pread_file))
		{
			$newline = fgets( $file_list[$i]->pread_file, 4096);
			$file_list[$i]->modio_write( $newline) ;
		}
		if (!$file_list[$i]->modio_close())
		{
			$file_list[$i]->err_msg = $lang['EM_trace'] . ': complete_file_repro[1]->' . $file_list[$i]->err_msg ;
			$no_errors = false ;
		}
	}

	return $no_errors ;
}








///
/// file manipulation functions
///


// remove the first element from the array
function em_array_shift( $orig_array)
{
	$new_array = array() ;
	for ($i=1; $i<count($orig_array); $i++)
	{
		$new_array[] = $orig_array[$i] ;
	}
	return $new_array ;
}


// on a line with nothing but line space, grab the line feed and carriage return chars
function get_line_return( $line)
{
	// we are assuming that $line has nothing but whitespace on it

	$line = str_replace('	', ' ', $line) ;
	$line_array = explode(' ', $line) ;

	return $line_array[count($line_array)-1] ;
}


// find the the specified line fragment(s) in the file (in order); this is the heart of EM!!
function perform_find( &$file_list, &$find_array, $search_array)
{
	global $lang ;

	// FYI search_array is coming to us with all the whitespace already stripped out


	$err_level = FIND_OK ;
	// we'll be searching for this FIND block through all the files in the list
	for ( $file_count=0; $file_count<count( $file_list); $file_count++)
	{
		// change Default to the current template as appropriate.
		$cur_template = preg_replace('#templates/(.*?)/.*#i','$1',$file_list[$file_count]->path);
//		$search_array = ($cur_template == '') ? $search_array : str_replace('Default',$cur_template,$search_array);
// -=ET=-'s bugfix: http://sourceforge.net/tracker/index.php?func=detail&aid=1261039&group_id=136984&atid=737391
		$search_array = ($cur_template == $file_list[$file_count]->path) ? $search_array : str_replace('Default',$cur_template,$search_array);

		$line_return = '' ;
		$potential_find = array() ;
		$found_complete_match = false ;

		// loop through the current file looking for a block of code to match our search array
		while (!feof( $file_list[$file_count]->pread_file))
		{
			// read the next line from the current file and add it to the end of our potential match list
			$current_line = fgets( $file_list[$file_count]->pread_file, 4096) ;

			// if the line contains only whitespace then we won't be matching against it; either add to our
			//    find array (if has some lines) or write it out
			if (trim($current_line) == '')
			{
				// *sigh* not every line return (line feed and carriage return) is the same, so let's figure
				//    out what this is
				$line_return = ($line_return == '') ? get_line_return($current_line) : $line_return ;

				// if there is something already in the find array, then add this whitespace line to it
				if (count($potential_find) > 0)
				{
//warning: tmp is throwing undefined
//echo "in here<br />\n" ;
//					$temp_array[] = $tmp ;
					$potential_find[count($potential_find)-1]['trailing_whitespace']++ ;
				}

				// write it out b/c the find array is empty already
				else
				{
					$file_list[$file_count]->modio_write( $current_line) ;
				}

				// don't continue processing this line; grab the next
				continue ;
			}


			// if this new line fits in the correct order of the search array, then things are looking
			//   more like this could be a match; we also know it's not a whitespace line
			if (preg_match('#'.preg_replace('#\\\\\\{%\\\\\\:(\\d+)\\\\\\}#','(\\d+|\\{%\\:$1\\})', preg_quote(trim($search_array[count($potential_find)]), '#')).'#', $current_line))
			{
				// load the line into the find array
				$potential_find[] = array( 'line' => $current_line, 'trailing_whitespace' => 0) ;

				// all the lines in both arrays match, we're done!!!
				if (count($potential_find) == count($search_array))
				{
					// bust out of this loop!
					$found_complete_match = true ;

					// build the find_array for this file and be sure to add the whitespace lines
					for ($count=0; $count<count($potential_find); $count++)
					{
						$find_array[$file_count][] = $potential_find[$count]['line'] ;
						for ($white=0; $white < $potential_find[$count]['trailing_whitespace']; $white++)
						{
							$find_array[$file_count][] = $line_return ;
						}
					}

					// got our match so get us out of this loop!
					break ;
				}
			}

			// this line doesn't match what we are looking for and so far nothing else does, so just write it out
			else if (count($potential_find) == 0)
			{
				$file_list[$file_count]->modio_write( $current_line) ;
			}

			// this new line doesn't fit in with our search array, but it is possible that the find array
			//   does contain a sequence of the search_array, so we can't throw out the find array yet
			else
			{
				// append the current line to the list
				$potential_find[] = array( 'line' => $current_line, 'trailing_whitespace' => 0) ;


				// the head is definitely junk; write it out and write out the whitespace lines it may have
				$file_list[$file_count]->modio_write( $potential_find[0]['line']) ;
				for ($white=0; $white<$potential_find[0]['trailing_whitespace']; $white++)
				{
					$file_list[$file_count]->modio_write( $line_return) ;
				}

				// pop goes the weasel 'cause the weasel goes pop! (pop off the array head)
				$potential_find = em_array_shift( $potential_find) ;


				// now we see if we can salvage anything left in the find array that matches up with the search
				//   array; compare the head with the start of the search_array; if it has potential keep it,
				//   otherwise pop off the head and try the next element
				while (count($potential_find) > 0)
				{
					$got_match = true ;

					// loop through, if we get a 100% match all for the potential, then this is the new potential
					for ($find=0; $find<count($potential_find); $find++)
					{
						// not a match so mark it as such so that we can pop it and try the next line
						if (!strstr( $potential_find[$find]['line'], trim($search_array[$find])))
						{
							$got_match = false ;
							break ;
						}
					}


					// no match, write out the head then pop it off and we'll try again with the next line
					if (!$got_match)
					{
						// the head is definitely junk; write it out and write out any whitespace lines
						$file_list[$file_count]->modio_write( $potential_find[0]['line']) ;
						for ($white=0; $white<$potential_find[0]['trailing_whitespace']; $white++)
						{
							$file_list[$file_count]->modio_write( $line_return) ;
						}

						// pop goes the weasel 'cause the weasel goes pop! (pop off the array head)
						$potential_find = em_array_shift( $potential_find) ;
					}

					// got a match so get us out of here!
					else
					{
						break ;
					}
				}
			}
		}


		//
		// error/warning processing
		//

		// didn't find a match so throw an error or warning
		if (!$found_complete_match)
		{
			// halt if this is an english lang file
			if (strstr( $file_list[$file_count]->path, 'language/lang_english'))
			{
				$file_list[$file_count]->err_msg = '<b>' . $lang['EM_err_critical_error'] . '</b><br /><br />' ;
				$err_level = FIND_FAIL_CRITICAL ;
			}

			// halt if this is a Default style file
			else if (strstr( $file_list[$file_count]->path, 'templates/Default'))
			{
				$file_list[$file_count]->err_msg = '<b>' . $lang['EM_err_critical_error'] . '</b><br /><br />' ;
				$err_level = FIND_FAIL_CRITICAL ;
			}

			// if a different lang, then allow to continue processing
			else if (strstr( $file_list[$file_count]->path, 'language/lang_'))
			{
				$file_list[$file_count]->err_msg = '<b>' . $lang['EM_err_warning'] . '</b><br /><br />' ;
				$err_level = FIND_FAIL_OK ;
			}

			// if a different style file, then allow to continue processing
			else if (strstr( $file_list[$file_count]->path, 'templates/'))
			{
				$file_list[$file_count]->err_msg = '<b>' . $lang['EM_err_warning'] . '</b><br /><br />' ;
				$err_level = FIND_FAIL_OK ;
			}

			// any other file then halt processing
			else
			{
				$file_list[$file_count]->err_msg = '<b>' . $lang['EM_err_critical_error'] . '</b><br /><br />' ;
				$err_level = FIND_FAIL_CRITICAL ;
			}

			// now that we have the error level, append the fail message to it
			$file_list[$file_count]->err_msg .= sprintf( $lang['EM_err_find_fail'], $file_list[$file_count]->path . trim($file_list[$file_count]->filename)) . ":<br /><br />\n" ;


			// append search string to message
			for ($x=0; $x<count($search_array); $x++)
			{
				$file_list[$file_count]->err_msg .= htmlspecialchars($search_array[$x]) . "<br />\n" ;
			}


			// if its critical then get us out of here
			if ($err_level == FIND_FAIL_CRITICAL)
			{
				return FIND_FAIL_CRITICAL ;
			}
		}
	}

	return $err_level ;
}


// dump the contents of the write array
function write_find_array( $find_array, &$file_list, $do_preview = false)
{
	for ( $file_count=0; $file_count<count( $file_list); $file_count++)
	{
		// make sure there is something in the array
		if (count($find_array) == 0)
		{
			continue ;
		}

		// write the contents of the find array and then reinit everything
		for ($looper=0; $looper<count($find_array[$file_count]); $looper++)
		{
			// if we are in preview mode then add the notation to make it standout
			if ($do_preview)
			{
				$file_list[$file_count]->modio_write( 'EM>>' . $find_array[$file_count][$looper]) ;
			}
			else
			{
				$file_list[$file_count]->modio_write( $find_array[$file_count][$looper]) ;
			}
		}
	}
}


// this function does the AFTER, BEFORE, and REPLACE in-line commands
function perform_inline_add( &$find_array, &$file_list, $search_fragment, $buffer, $where)
{
	global $lang ;

	$err_level = FIND_OK ;
	for ( $file_count=0; $file_count<count( $file_list); $file_count++)
	{
		$cur_template = preg_replace('#templates/(.*?)/.*#i','$1',$file_list[$file_count]->path);
//		$search_fragment = ($cur_template == '') ? $search_fragment : str_replace('Default',$cur_template,$search_fragment);
// -=ET=-'s bugfix: http://sourceforge.net/tracker/index.php?func=detail&aid=1261039&group_id=136984&atid=737391
		$search_fragment = ($cur_template == $file_list[$file_count]->path) ? $search_fragment : str_replace('Default',$cur_template,$search_fragment);

		$found_fragment = false ;
		// search the find array for our fragment
		for ($looper=0; $looper<count($find_array[$file_count]); $looper++)
		{
			// found the fragment, cool!
			if (preg_match('#'.preg_replace('#\\\\\\{%\\\\\\:(\\d+)\\\\\\}#','(\\d+|\\{%\\:$1\\})', preg_quote($search_fragment, '#')).'#', $find_array[$file_count][$looper]))
			{
				$found_fragment = true ;
				break ;
			}
			else
			{
				// didn't find the fragment, so write this line since we are done with it
				$file_list[$file_count]->modio_write( $find_array[$file_count][$looper]) ;
			}
		}

		// successful find, now do our alteration
		if ($found_fragment)
		{
			if ( $where == 'after')
			{
				// insert new code after the fragment
				$find_array[$file_count][$looper] = substr_replace( $find_array[$file_count][$looper], rtrim($buffer), strpos( $find_array[$file_count][$looper], $search_fragment) + strlen($search_fragment), 0) ;
			}
			else if ( $where == 'before')
			{
				// insert new code before the fragment
				$find_array[$file_count][$looper] = substr_replace( $find_array[$file_count][$looper], rtrim($buffer), strpos( $find_array[$file_count][$looper], $search_fragment), 0) ;
			}
			else if ( $where == 'replace')
			{
				// replace new code in place of the fragment
				$find_array[$file_count][$looper] = substr_replace( $find_array[$file_count][$looper], rtrim($buffer), strpos( $find_array[$file_count][$looper], $search_fragment), strlen($search_fragment) ) ;
			}


			// need to pop off the find_array lines prior to the one containing our fragment
			for ($looper2=0; $looper2<$looper; $looper2++)
			{
				// had been using array_shift but that is not supported in PHP3 :(
				$find_array[$file_count] = em_array_shift( $find_array[$file_count]) ;
			}
		}

		// throw appropriate error
		else
		{
			// halt if this is an english lang file
			if (strstr( $file_list[$file_count]->path, 'language/lang_english'))
			{
				$file_list[$file_count]->err_msg = '<b>' . $lang['EM_err_critical_error'] . '</b><br /><br />' ;
				$err_level = FIND_FAIL_CRITICAL ;
			}

			// halt if this is a Default style file
			else if (strstr( $file_list[$file_count]->path, 'templates/Default'))
			{
				$file_list[$file_count]->err_msg = '<b>' . $lang['EM_err_critical_error'] . '</b><br /><br />' ;
				$err_level = FIND_FAIL_CRITICAL ;
			}

			// if a different lang, then allow to continue processing
			else if (strstr( $file_list[$file_count]->path, 'language/lang_'))
			{
				$file_list[$file_count]->err_msg = '<b>' . $lang['EM_err_warning'] . '</b><br /><br />' ;
				$err_level = FIND_FAIL_OK ;
			}

			// if a different style file, then allow to continue processing
			else if (strstr( $file_list[$file_count]->path, 'templates/'))
			{
				$file_list[$file_count]->err_msg = '<b>' . $lang['EM_err_warning'] . '</b><br /><br />' ;
				$err_level = FIND_FAIL_OK ;
			}

			// any other file then halt processing
			else
			{
				$file_list[$file_count]->err_msg = '<b>' . $lang['EM_err_critical_error'] . '</b><br /><br />' ;
				$err_level = FIND_FAIL_CRITICAL ;
			}
			$file_list[$file_count]->err_msg .= sprintf( $lang['EM_err_ifind_fail'], $file_list[$file_count]->path . trim($file_list[$file_count]->filename)) . ':<br /><br />' . htmlspecialchars($search_fragment) . "<br />\n" ;


			// if its critical then get us out of here
			if ($err_level == FIND_FAIL_CRITICAL)
			{
				return FIND_FAIL_CRITICAL ;
			}
		}
	}

	return $err_level ;
}

// Increments variables in strings as appropriate.
function increment_wildcard( $wildcard_identifier, $increment_value, $wildcard_search, $search_result )
{
	$parts = preg_split('#\{%\:\d+\}#',substr($wildcard_search,0,strpos($wildcard_search,$wildcard_identifier)));
	for ($i=0;$i<count($parts);$i++)
	{
		$parts[$i] = preg_quote($parts[$i],'#');
	}
	$beg = preg_replace('#^(.*'.implode('\d+',$parts).').*#s','$1',$search_result,1);
	if ($beg == $search_result)
	{
		return false;
	}
	$aft = substr($search_result,strlen($beg));
	$num = preg_replace('#^(\\d+).*#','$1',$aft);
	$num += $increment_value;
	return $beg.preg_replace('#^\\d+(.*)#',"$num$1",$aft);
}

///
/// access validation functions
///

// get the permissions of a file in nicely printed format
//   I nabbed this function from php.net ;-)
function mfunGetPerms( $in_Perms )
{ 
	$sP = '';

	if($in_Perms & 0x1000)     // FIFO pipe
		$sP = 'p'; 
	elseif($in_Perms & 0x2000) // Character special
		$sP = 'c'; 
	elseif($in_Perms & 0x4000) // Directory
		$sP = 'd'; 
	elseif($in_Perms & 0x6000) // Block special
		$sP = 'b';
	elseif($in_Perms & 0x8000) // Regular
		$sP = '-';
	elseif($in_Perms & 0xA000) // Symbolic Link
		$sP = 'l';
	elseif($in_Perms & 0xC000) // Socket
		$sP = 's';
	else                       // UNKNOWN
		$sP = 'u'; 

	// owner
	$sP .= (($in_Perms & 0x0100) ? 'r' : '-') .
		(($in_Perms & 0x0080) ? 'w' : '-') . 
		(($in_Perms & 0x0040) ? (($in_Perms & 0x0800) ? 's' : 'x' ) : 
			(($in_Perms & 0x0800) ? 'S' : '-')); 

	// group
	$sP .= (($in_Perms & 0x0020) ? 'r' : '-') .
		(($in_Perms & 0x0010) ? 'w' : '-') . 
		(($in_Perms & 0x0008) ? (($in_Perms & 0x0400) ? 's' : 'x' ) : 
			(($in_Perms & 0x0400) ? 'S' : '-')); 

	// world
	$sP .= (($in_Perms & 0x0004) ? 'r' : '-') .
		(($in_Perms & 0x0002) ? 'w' : '-') . 
		(($in_Perms & 0x0001) ? (($in_Perms & 0x0200) ? 't' : 'x' ) : 
			(($in_Perms & 0x0200) ? 'T' : '-')); 

	return $sP ;
}


// check for server read access; the access_msg can be used for output; return true/false for success
function check_access_read( &$access_msg)
{
	global $phpEx, $lang, $language ;

	// using a file that we know is present
	if ($fin = fopen( 'languages/lang_easymod_'.$language.'.'.$phpEx, 'rb'))
	{
		// just make sure the first line is what we were expecting
		$buffer = fgets($fin, 1024);
		fclose( $fin) ;
		if ( trim($buffer) == '<?php')
		{
			$access_msg = $lang['EM_ok'] ;
			return true ;
		}
		else
		{
//			$access_msg = $lang['EM_failed'] ;
$access_msg = "Sucessfully opened [lang_easymod_$language.$phpEx] for reading, but did not find the expected string.<br /> Found this instead: [" . htmlspecialchars($buffer) . "]" ;
			return false ;
		}
	}
	else
	{
//		$access_msg = $lang['EM_failed'] ;
$access_msg = "Could not open file [lang_easymod_$language.$phpEx] for reading." ;
		return false ;
	}
}


// check for server write access; the access_msg can be used for output; return true/false for success
function check_access_write( &$access_msg)
{
	global $lang ;

	// see if we can create a new file
	if ($fout = fopen( 'EM_test.txt', 'wb'))
	{
		fwrite( $fout, 'EM can write!\n') ;
		fclose( $fout) ;

		$access_msg = $lang['EM_ok'] ;
		return true ;
	}
	else
	{
		$access_msg = $lang['EM_failed'] ;
		return false ;
	}
}


// check for server write access in the phpBB root; the access_msg can be used for output; return true/false for success
function check_access_write_root( &$access_msg)
{
	global $phpbb_root_path, $phpEx, $lang ;

	// see if we can open the index.php for writing; not making any changes though!!
	if ($fout = fopen( $phpbb_root_path . 'index.'.$phpEx, 'ab'))
	{
		fclose( $fout) ;

		$access_msg = $lang['EM_ok'] ;
		return true ;
	}
	else
	{
		$access_msg = $lang['EM_failed'] ;
		return false ;
	}
}


// check to see if we can chmod in the EM dir; the access_msg can be used for output; return true/false for success
function check_access_chmod( &$access_msg)
{
	global $lang ;

	// assume the EM_test.txt file exists; now see if we can chmod it
	if ( chmod( 'EM_test.txt', 0755))
	{
		$access_msg = $lang['EM_ok'] ;
		return true ;
	}
	else
	{
		$access_msg = $lang['EM_failed'] ;
		return false ;
	}
}


// check to see if we can unlink in the EM dir; the access_msg can be used for output; return true/false for success
function check_access_unlink( &$access_msg)
{
	global $lang ;

	// assume the EM_test.txt file exists; now see if we can unlink (delete) it
	if ( unlink('EM_test.txt') )
	{
		$access_msg = $lang['EM_ok'] ;
		return true ;
	}
	else
	{
		$access_msg = $lang['EM_failed'] ;
		return false ;
	}
}


// see if we can make a new dir in the EM dir; the access_msg can be used for output; return true/false for success
function check_access_mkdir( &$access_msg)
{
	global $lang, $phpbb_root_path, $script_path, $phpEx ;

	if ( file_exists('EM_test_dir') )
	{
		if ( !rmdir('EM_test_dir') )
		{
			// we can't remove the file but it has been created so we'll assume we have mkdir access
			$access_msg = $lang['EM_ok'];
			return true;
		}
	}

	// check for server mkdir access
	if ( mkdir( 'EM_test_dir', 0755) )
	{
		// clean up!
		rmdir( 'EM_test_dir') ;

		$access_msg = $lang['EM_ok'] ;
		return true ;
	}
	else
	{
		$access_msg = $lang['EM_failed'] ;
		return false ;
	}
}


// see if we can write to the server /tmp dir; the access_msg can be used for output; return true/false for success
function check_access_write_tmp( &$access_msg)
{
	global $lang ;

	// get a random temp file name; if this fails then we know there is no tmp access
	if ( $tmpfname = @tempnam('/tmp', 'cfg'))
	{
		// unlink for safety on php4.0.3+
		@unlink($tmpfname); 

		// see if we can create and write to this file
		if ($fp = @fopen($tmpfname, 'wb'))
		{
			// remember to clean up!
			@fwrite($fp, "EM TEST\n");
			@fclose($fp);
			unlink($tmpfname);

			$access_msg = $lang['EM_ok'] ;
			return true ;
		}
		else
		{
			$access_msg = $lang['EM_failed'] ;
			return false ;
		}
	}

	// no tmp access
	else
	{
		$access_msg = $lang['EM_failed'] ;
		return false ;
	}
}


// see if the ftp module is loaded (no biggie if not); the access_msg can be used for output; return true/false for success
function check_access_ftp_ext( &$access_msg)
{
	global $lang ;

	// check for server access through ftp
	if (@extension_loaded('ftp'))
	{
		$access_msg = $lang['EM_ok'] ;
		return true ;
	}
	else
	{
		$access_msg = $lang['EM_no_module'] ;
		return false ;
	}
}


// see if the dreaded safe mode is enabled; the access_msg can be used for output; return true/false for success
function check_access_safe_mode( &$access_msg)
{
	global $lang ;

	// check to see if safe mode is on
	if (@ini_get('safe_mode') || strtolower(@ini_get('safe_mode')) == 'on')
	{
		$access_msg = $lang['EM_on'] ;
		return false ;
	}
	else
	{
		$access_msg = $lang['EM_off'] ;
		return true ;
	}
}


// try to copy from EM dir to phpBB root; the access_msg can be used for output; return true/false for success
function check_access_copy( &$access_msg)
{
	global $phpbb_root_path, $phpEx, $lang, $language ;

	// check for copy command
	if ( copy( 'languages/lang_easymod_'.$language.'.' . $phpEx, $phpbb_root_path . 'EM_test.txt'))
	{
		// clean up!
		unlink( $phpbb_root_path . 'EM_test.txt') ;

		$access_msg = $lang['EM_ok'] ;
		return true ;
	}
	else
	{
		$access_msg = $lang['EM_failed'] ;
		return false ;
	}
}






///
/// general functions
///

// lookup the phpBB version
function get_phpbb_version()
{
	global $db ;

	// lookup in the DB
	$sql = "SELECT config_value  
		FROM " . CONFIG_TABLE . " 
		WHERE config_name = 'version'";
	if ( !($result = $db->sql_query($sql)) )
	{
		return '' ;
	}
	$row = $db->sql_fetchrow($result);

	// prepend a 2 (so we get 2.x.x)
	$version = '2' . $row['config_value'] ;
	return $version ;
}


// get a text line of what themes are installed
function get_themes()
{
	global $db ;

	// lookup themes in the DB
	$sql = "SELECT *
		FROM " . THEMES_TABLE . " 
		ORDER BY themes_id ASC" ;
	if ( !($result = $db->sql_query($sql)) )
	{
		return '' ;
	}

	// loop though themes and combine into one string
	$themes = '' ;
	while( $row = $db->sql_fetchrow($result) )
	{
		$themes = ( $themes == '') ? $row['template_name'] : $themes . '; ' . $row['template_name'] ;
	}
	return $themes ;
}


// get a text line of what languages are installed
function get_languages( $lang_path)
{
	$dir = opendir( $lang_path);

	// loop through the directory listing and see what langs we have here
	$langs = '' ;
	while ( $file = readdir($dir) )
	{
		// make sure this is a lang dir
		if ( ereg("^lang_", $file) && !is_file("$lang_path/$file") && !is_link("$lang_path/$file") )
		{
			$langs = ( $langs == '') ? substr($file,5) : $langs . '; ' . substr($file,5) ;
		}
	}

	return $langs ;
}


// used for inserting one of the EM fields into the config table
function em_db_insert( $config_name, $config_value)
{
	global $db, $lang ;

	$sql = "INSERT INTO " . CONFIG_TABLE . " ( config_name, config_value)
			VALUES ('$config_name', '$config_value')" ;
	if ( !$db->sql_query($sql) )
	{
/////////////////////
///////////////////// sloppy... should return error, not exit
/////////////////////
		echo  sprintf( $lang['EM_err_insert'], $config_name) . "<br />\n" ;
		echo "sql=[" . htmlspecialchars($sql) . "]<br />\n" ;
		// Debugging
		$sql_error =  $db->sql_error();
		echo $sql_error['message'];

		exit ;
	}
}


// used for updating one of the EM fields into the config table
function em_db_update( $config_name, $config_value)
{
	global $db, $lang ;

	$sql = "UPDATE " . CONFIG_TABLE . " 
		SET config_value = '$config_value'
		WHERE config_name = '$config_name'" ;
	if ( !$db->sql_query($sql) )
	{
/////////////////////
///////////////////// sloppy... should return error, not exit
/////////////////////
		echo  sprintf( $lang['EM_err_update'], $config_name) . "<br />\n" ;
		echo "sql=[" . htmlspecialchars($sql) . "]<br />\n" ;
		// Debugging
		$sql_error =  $db->sql_error();
		echo $sql_error['message'];

		exit ;
	}
}


// as config keys are added from version to version we have to see if newer keys already exist
function add_new_config( $config_key, $config_value)
{
	global $db ;

	$sql = "SELECT * 
		FROM " . CONFIG_TABLE . " 
		WHERE config_name = '$config_key'" ;
	if ( !($result = $db->sql_query($sql)) )
	{
		return false ;
	}
	$rows = $db->sql_numrows($result);
	$db->sql_freeresult($result);

	// we need add the field
	if ($rows == 0)
	{
		em_db_insert( $config_key, $config_value) ;
	}

	// field is there, just update it
	else
	{
		em_db_update( $config_key, $config_value) ;
	}

	return true ;
}



// get the access password to EM
function get_em_pw()
{
	global $db, $lang ;

	// look up the actual password in the db
	$sql = "SELECT *
		FROM " . CONFIG_TABLE . " 
		WHERE config_name = 'EM_password'" ;
	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, $lang['EM_config_info'], '', __LINE__, __FILE__, $sql);
	}
	$row = $db->sql_fetchrow($result) ;

	return $row['config_value'] ;
}


////
//// copy command parsing
////

// make sure the line provided is a properly formatted copy command and extract basic elements
function copy_check_basic_form( $line)
{
	// clean the line from extra spaces and tabs
	$line = str_replace( "\t", ' ', trim( $line) );
	$split_line = explode(' ', $line);
	$imax = count($split_line) ;
	// loop through elements and keep only elements with text
	for ( $i=0; $i<$imax; $i++ )
	{
		$split_line[$i] = trim( $split_line[$i]);
		if ( empty($split_line[$i]) )
		{
			unset($split_line[$i]);
		}
	}
	$line = implode(' ', $split_line);


	// make sure we have a valid format are as follows:
	// copy [target] to [destination]
	$split_line = explode(' ', $line);

	// let's go and analyse these
	if ( (count($split_line) != 4) || (strtolower($split_line[0]) != 'copy') || (strtolower($split_line[2]) != 'to') )
	{
		return false ;
	}

	return $split_line ;
}

function copy_check_file( $file)
{
	global $install_path ;

	// clean a little the name
	if ($file[0] == '/')
	{
		$file = substr( $file, 1);
	}

	// get the dir and the filename
	$file_path = dirname($file);
	$file_path = ( $file_path == '.') ? '' : $file_path . '/' ;
	$file_name = basename($file);

	// check if the path is valid: there can be no * nor ? in it
	if ( strstr( $file_path, '*') || strstr( $file_path, '?') )
	{
		return false ;
	}


//echo "zzzzzzzzzz [$install_path][$file_path][$file_name]<br />\n" ;
	// check for wild cards
	if ( strstr( $file_name, '*') || strstr( $file_name, '?') )
	{
		return array( 'path' => $file_path, 'file' => $file_name) ;
	}

	// is it a directory?
	else if ( is_dir( $install_path . $file_path . '/' . $file_name) )
	{
//echo "x<br />\n" ;
		// if the whole thing is a directory, then it is a path and make the filename *.*
//		return array( 'path' => $file_path . '/' . $file_name, 'file' => '*.*') ;
//		return array( 'path' => $file_path . $file_name, 'file' => '*.*') ;
		return array( 'path' => $file_path . $file_name . '/', 'file' => '*.*') ;
	}

	// secondary directory check; a destination directory may not exist yet, so if it ends with a / then its a dir
	else if ( $file[ (strlen($file)-1)] == '/')
	{
//echo "y<br />\n" ;
//		return array( 'path' => $file_path . '/' . $file_name, 'file' => '*.*') ;
//		return array( 'path' => $file_path . $file_name, 'file' => '*.*') ;
		return array( 'path' => $file_path . $file_name . '/', 'file' => '*.*') ;
	}

	// just a plain file
	else
	{
		return array( 'path' => $file_path, 'file' => $file_name) ;
	}
}


function process_file_split( $split_dest, $split_targ)
{
	$w_split = '' ;
	for ( $i=0; $i<strlen( $split_dest); $i++ )
	{
		if ( $split_dest[$i] == '*' )
		{
			$w_split .= substr( $split_targ, $i);
			break ;
		}

///////////// should be $i I think... why was it $k???
//		else if ( $split_dest[$k] == '?' )
		else if ( $split_dest[$i] == '?' )
		{
			$w_split .= substr( $split_targ, $i, 1);
		}
		else
		{
			$w_split .= $split_dest[$i];
		}
	}

	return $w_split ;
}


function final_formatting( $tmp_to_dir, $tmp_to_file, $tmp_from_dir, $tmp_file)
{
	global $phpbb_root_path ;

	$result_files = array() ;
	$split_path = explode('/', $tmp_to_dir) ;
	// if it is destine for Default, make sure it goes to ALL themes
	if (($split_path[0] == 'templates') && ($split_path[1] == 'Default'))
	{
		$files = get_theme_files( $tmp_to_file, $tmp_to_dir) ;
		for ($x=0; $x<count($files); $x++)
		{
			// make any dirs we may need
			$result_files[] = array('from_path' => $tmp_from_dir,
							'from_file' => $tmp_file,
							'to_path' => $files[$x]['path'],
							'to_file' => $files[$x]['filename']) ;
		}
	}

	// if it destined for lang_english, make sure it goes to ALL languates
	else if (($split_path[0] == 'language') && ($split_path[1] == 'lang_english'))
	{
		$lang_path =  $phpbb_root_path . 'language/' ;
		$files = get_lang_files( $tmp_to_file, $tmp_to_dir, $lang_path) ;
		for ($x=0; $x<count($files); $x++)
		{
			// make any dirs we may need
			$result_files[] = array('from_path' => $tmp_from_dir,
							'from_file' => $tmp_file,
							'to_path' => $files[$x]['path'],
							'to_file' => $files[$x]['filename']) ;
		}
	}

	// everything else
	else
	{
		// make any dirs we may need
		$result_files[] = array('from_path' => $tmp_from_dir,
						'from_file' => $tmp_file,
						'to_path' => $tmp_to_dir,
						'to_file' => $tmp_to_file) ;
	}

	return $result_files ;
}

// used only for debugging purposes only
if( defined('EM_DEBUG_AID') )
{
	function em_vd($mixed, $title = '')
	{
		ob_start();
		var_dump($mixed);
		$content = ob_get_contents();
		ob_end_clean();
		echo '<pre>' . ( !empty($title) ? ($title . ': ') : '' ) . htmlspecialchars($content) . "</pre>\n";
	}
}

?>