<?php
/***************************************************************************
 *                               em_modio.php
 *                            -------------------
 *   begin                : Tuesday, Dec 10, 2003
 *   copyright            : (C) 2002 - 2004 Nuttzy - Craig Nuttall, 2005 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: em_modio.php,v 1.12 2007/02/22 03:32:20 wgeric Exp $
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
// THE PURPOSE of this module is to handle all the file i/o for EM.  Files are always read
// using fopen.  They are written and moved using fopen, PHP copy command, /tmp file, FTP using
// fsockopen, FTP using the PHP Extension, file download to client, display file to screen, and
// generating a sh or bat file to execute moves after processing.
//



/***************************************************************************
 *                              mod_io class
 *                            -------------------
 *   begin                : Sunday, Mar 31, 2002
 *   copyright            : (C) 2002 thru 2004 Nuttzy
 *   email                : pktoolkit@blizzhackers.com
 *
 ***************************************************************************/

class mod_io
{
	// file and filepath to MOD
	var $filename ;			// name of the phpBB core file being edited
	var $path ;				// path of the phpBB core file being edited

	// MOD'ing methods
	var $read_method ;
	var $write_method ;
	var $move_method ;

	// write method tools
	var $pfile ;			// file pointer
	var $afile = array() ;		// array of strings to make a file

	// read method tools
	var $pread_file ;			// file pointer to the phpBB core file being read (readonly)

	// error handling
	var $err_msg ;

	// ftp info (if needed)
	var $ftp_user ;
	var $ftp_pass ;
	var $ftp_path ;
	var $ftp_host ;
	var $ftp_port ;
	var $ftp_type ;	// using the PHP FTP extension?
	var $ftp_cache ;	// with ext, writing to /tmp or admin/em_includes/cache?
	var $emftp ;


	//
	// member functions
	//

	// get sent the method and ftp info (install proggie)
	function mod_io( $filename, $path, $read_method, $write_method, $move_method, $ftp_user, $ftp_pass, $ftp_path, $ftp_host, $ftp_port, $ftp_type, $ftp_cache)
	{
		$this->filename = $filename ;
		$this->path = $path ;

		$this->read_method = $read_method ;
		$this->write_method = $write_method ;
		$this->move_method = $move_method ;

		$this->ftp_user = $ftp_user ;
		$this->ftp_pass = $ftp_pass ;
		$this->ftp_path = $ftp_path ;
		$this->ftp_host = $ftp_host ;
		$this->ftp_port = $ftp_port ;
		$this->ftp_type = $ftp_type ;
		$this->ftp_cache = $ftp_cache ;
		$this->emftp = NULL ;
	}


	// make appropriate dirs for the COPY command
	function modio_mkdirs_copy( $path)
	{
		global $phpbb_root_path ;

		// we only create actually dirs if we are writing to server, so bail if that is not the method
		if (( $this->move_method != 'copy') && ( $this->move_method != 'ftpa'))
		{
			return true ;
		}
		// make sure we have something to create!
		else if ($path == '')
		{
			return true ;
		}

		// set up the path; relative to EM execution point, starting at root
		$root_path = ( substr($phpbb_root_path, 0, 2) == './') ? substr($phpbb_root_path, 2) : $phpbb_root_path ;
		$copy_path = ( substr($path, 0, 9) == '../../../') ? $root_path . substr($path, 9) : $phpbb_root_path . $path;

		// create dirs for processing the file (server)
		if ( $this->move_method == 'copy')
		{
			$dir_path = '' ;
			$splitarray = explode('/', $copy_path) ;
			for ($idir=0; $idir<count($splitarray); $idir++)
			{
				$dir_path .= trim($splitarray[$idir]) ;
				// don't bother making ../  ;-)
				if ($splitarray[$idir] == '..')
				{
					// do nothing
				}
				else if (!file_exists($dir_path))
				{
					// use the mkdir command
					mkdir($dir_path, 0755);
					chmod($dir_path, 0755);
				}

				$dir_path .= '/' ;
			}
		}

		// create dirs for processing the file (buffer+ftp)
		else if ( $this->move_method == 'ftpa')
		{
//			$path = ( substr($path, 0, 3) == '../') ? substr($path, 3) : $path ;
			// make the dir tree (its a bit complex); all error handling occurs in the function
			if (!$this->emftp->ftp_mkdir_struct_copy( $path, $this->err_msg))
			{
				$this->err_msg = 'modio_mkdirs_copy()->' . $this->err_msg ;
				return false ;
			}
		}

		return true ;
	}


	// make appropriate dirs using the appropriate method
	function modio_mkdirs( $process)
	{
		global $install_path ;

		// we only create actually dirs if we are writing to server, so bail if that is not the method
		if (( $this->write_method != 'server') && ( $this->write_method != 'ftpb'))
		{
			return true ;
		}

		// we may or may not add 'process/' in the path depending on if it is a post_process.sh(.bat) file
		$new_path = $install_path . $process . $this->path ;
		$backup_path = $install_path . (($process == '') ? '' : 'backups/') . $this->path ;

		// create dirs for processing the file (server)
		if ( $this->write_method == 'server')
		{
			$dir_path = '' ;
			$splitarray = explode('/', $new_path) ;
			for ($idir=0; $idir<count($splitarray)-1; $idir++)
			{
				$dir_path .= trim($splitarray[$idir]) ;
				if (!file_exists($dir_path))
				{
					// use the mkdir command
					mkdir($dir_path, 0755);
					chmod($dir_path, 0755);
				}
				$dir_path .= '/' ;
			}
		}

		// create dirs for processing the file (buffer+ftp)
		else if ( $this->write_method == 'ftpb')
		{
			// make the dir tree (its a bit complex); all error handling occurs in the function
			if (!$this->emftp->ftp_mkdir_struct( $new_path, $this->err_msg))
			{
				$this->err_msg = 'modio_mkdirs[1]->' . $this->err_msg ;
				return false ;
			}
		}


		// create dirs for backing up the file
		if ( $this->write_method == 'server')
		{
			$dir_path = '' ;
			$splitarray = explode('/', $backup_path) ;
			for ($idir=0; $idir<count($splitarray)-1; $idir++)
			{
				$dir_path .= trim($splitarray[$idir]) ;
				if (!file_exists($dir_path))
				{
					mkdir($dir_path, 0755);
					chmod($dir_path, 0755);
				}
				$dir_path .= '/' ;
			}
		}

		// create dirs for backing up the file (buffer+ftp)
		else if ( $this->write_method == 'ftpb')
		{
			// make the dir tree (its a bit complex); all error handling occurs in the function
			if (!$this->emftp->ftp_mkdir_struct( $backup_path, $this->err_msg))
			{
				$this->err_msg = 'modio_mkdirs[2]->' . $this->err_msg ;
				return false ;
			}
		}

		return true ;
	}


	// open the designated stream for writing
	function modio_open( $create_command = false)
	{
		global $lang, $phpbb_root_path, $install_path ;

		// we'll handle our on errors
		$old_error_reporting = error_reporting(0) ;

////////// NOT WORRYING ABOUT READ LOCAL YET!!!
		// open file on server for readonly access (if not making a config file)
		if (!$create_command)
		{
			if (!$this->pread_file = fopen ( $phpbb_root_path . $this->path . trim($this->filename), 'rb'))
			{
				// restore error handling
				error_reporting($old_error_reporting);

				$this->err_msg = 'modio_open[1]<br /><br />' ;
				$this->err_msg .= sprintf( $lang['EM_modio_open_read'], $this->path . trim($this->filename)) ;
				return false ;
			}
		}
		// restore error handling
		error_reporting($old_error_reporting);


		$ext = ($create_command) ? '' : '.txt' ;
		$process = ($create_command) ? '' : 'processed/' ;

		// setup dirs if necessary
		if (!$create_command)
		{
			if (!$this->modio_mkdirs( $process))
			{
				$this->err_msg = 'modio_open[2]->' . $this->err_msg ;
				return false ;
			}
		}


		// writing on the server
		if ( $this->write_method == 'server')
		{
			// we'll handle our on errors
			$old_error_reporting = error_reporting(0) ;

			// open the file on the server
			if ( $this->pfile = fopen( $install_path . $process . $this->path . trim($this->filename) . $ext, 'wb'))
			{
				// restore error handling
				error_reporting($old_error_reporting);

				return true ;
			}

			// open failed
			else
			{
				// restore error handling
				error_reporting($old_error_reporting);

				$this->err_msg = 'modio_open[3]<br /><br />' ;
				$this->err_msg .= sprintf( $lang['EM_modio_open_write'], $install_path . $process . $this->path . trim($this->filename). $ext);
				return false ;
			}
		}

		// writing to an array buffer and then ftping on the server
		else if ( $this->write_method == 'ftpb')
		{
			$this->afile = array() ;
			return true ;
		}

		// assembling for download or for screen display
		else if ( ($this->write_method == 'local') || ($this->write_method == 'screen'))
		{
			$this->afile = array() ;
			return true ;
		}

		// what the heck is going on!
		else
		{
			$this->err_msg = $lang['EM_modio_open_none'] ;
			return false ;
		}
	}


	// add text line(s) to stream
	function modio_write( $text)
	{
		// writing on the server in mods dir
		if ($this->write_method == 'server')
		{
			fwrite( $this->pfile, $text ) ;
		}

		// assembling for ftp buffer, download, or for screen display
		else
		{
			$this->afile[] = $text ;
		}
	}


	// close it down and take care of business
	function modio_close( $create_command = false)
	{
		global $lang, $script_path, $install_path ;

		// close the read file on the server
		if (!$create_command)
		{
			fclose( $this->pread_file) ;
		}

		// writing on the server
		if ( $this->write_method == 'server')
		{
			fclose( $this->pfile) ;

			// if it is a command file, then we don't have processed/ in the dir path, and we don't append .txt
			if ($create_command)
			{
				chmod( $install_path . $this->path . trim($this->filename), 0755 ) ;
			}

			// normal files: written in the processed/ dir; add .txt on the end for security (not executable)
			else
			{
				chmod( $install_path . 'processed/' . $this->path . trim($this->filename) . '.txt', 0755 ) ;
			}
		}


		// write the array buffer to a file via ftp
		else if ( $this->write_method == 'ftpb')
		{
			// determing the destination path and filename
			$ipath = strpos($install_path, './') === 0 ? substr($install_path, 2) : $install_path;
			if ($create_command)
			{
				$to_dir = $script_path . $ipath . $this->path;
				$to_file = $this->filename;
			}
			else
			{
				$to_dir = $script_path . $ipath . 'processed/' . $this->path;
				$to_file = $this->filename . '.txt';
			}


			// leave some breadcrumbs so we can cd back to phpbb_root
			$return_path = '' ;
			$split_array = explode('/', $to_dir) ;
			for ($count=0; $count<count($split_array); $count++)
			{
				if (($split_array[$count] != '.') && ($split_array[$count] != ''))
				{
					$return_path .= '../' ;
				}
			}

			// we must first CD to the dir before putting the file (found in 0.0.9)
			if (!$this->emftp->ftp_chdir( $to_dir))
			{
				// we failed; don't close the connection though, assume it will be cleaned up later
				$err_msg = sprintf( $lang['EM_modio_close_chdir'], $to_dir) ;

				// we do not wish to overwrite a pre-existing error message.  close is often called after handling
				//   another error.  If this is the case then append this message on the end of that one.
				$this->err_msg = ($this->err_msg == '') ? "modio_close[1]<br /><br />$err_msg" : 'modio_close[1]->' . $this->err_msg . '<br /><br /><b>' . $lang['EM_err_secondary'] . '<b><br />' . $err_msg ;

				return false ;
			}

			// assume the ftp connection has already been prepped; dump the array to a file
			if (!$this->emftp->ftp_put_array( $to_file, $this->afile, $this->ftp_cache))
			{
				// we failed; don't close the connection though, assume it will be cleaned up later
				$err_msg = sprintf( $lang['EM_modio_close_ftp'], $to_dir . $to_file) ;

				// we do not wish to overwrite a pre-existing error message.  close is often called after handling
				//   another error.  If this is the case then append this message on the end of that one.
				$this->err_msg = ($this->err_msg == '') ? "modio_close[2]<br /><br />$err_msg" : 'modio_close[2]->' . $this->err_msg . '<br /><br /><b>' . $lang['EM_err_secondary'] . '<b><br />' . $err_msg ;

				return false ;
			}


			// we must now cd back from whence we came ;-) (found in 0.0.9)
			if (!$this->emftp->ftp_chdir( $return_path))
			{
				// we failed; don't close the connection though, assume it will be cleaned up later
				$err_msg = sprintf( $lang['EM_modio_close_chdir'], $return_path) ;

				// we do not wish to overwrite a pre-existing error message.  close is often called after handling
				//   another error.  If this is the case then append this message on the end of that one.
				$this->err_msg = ($this->err_msg == '') ? "modio_close[3]<br /><br />$err_msg" : 'modio_close[3]->' . $this->err_msg . '<br /><br /><b>' . $lang['EM_err_secondary'] . '<b><br />' . $err_msg ;

				return false ;
			}
		}

		// assembling for download or for screen display
		else if ( $this->write_method == 'local')
		{
			// do nothing
		}

		// display on screen
		else
		{
			// do nothing
		}

		return true ;
	}


	// make ftp connection if needed; generally this will be called by the command file mod_io object
	//   before batch processing
	function modio_prep( $action, $debug=false)
	{
		global $lang ;

		// called when moving a file into its final place, or when writing the buffer via ftp

		// using the FTP class
		if ((($action == 'move') && ($this->move_method == 'ftpa')) ||
			(($action == 'write') && ($this->write_method == 'ftpb')))
		{
			$this->emftp = new emftp( $this->ftp_type, $debug) ;

			if (!$this->emftp->ftp_connect( $this->ftp_host, $this->ftp_port))
			{
				$this->err_msg = 'modio_prep[1]<br /><br />' ;
				$this->err_msg .= $lang['EM_modio_prep_conn'] ;
				return false ;
			}
			else if (!$this->emftp->ftp_login( $this->ftp_user, $this->ftp_pass))
			{
				$this->emftp->ftp_quit();

				$this->err_msg = 'modio_prep[2]<br /><br />' ;
				$this->err_msg .= $lang['EM_modio_prep_login'] ;
				return false ;
			}

			// CD to the phpBB root then we will always know the relative dir we are in (added 0.0.9c)
			else if (!$this->emftp->ftp_chdir( $this->ftp_path))
			{
				$this->emftp->ftp_quit();

				$this->err_msg = 'modio_prep[3]<br /><br />' ;
				$this->err_msg .= $lang['EM_modio_prep_chdir'] ;
				return false ;
			}
		}

		return true ;
	}


	// close ftp connection if needed; generall this will be called by the command file mod_io object
	//   before batch processing
	function modio_cleanup( $action)
	{
		if ((($action == 'move') && ($this->move_method == 'ftpa')) ||
			(($action == 'write') && ($this->write_method == 'ftpb')))
		{
			$this->emftp->ftp_quit();
		}
	}

	// close it down and take care of business
	function modio_move( $to, $from, $mod_count, $link, $type)
	{
		global $lang, $script_path, $phpbb_root_path, $install_path ;
		$this->err_msg = '' ;

		// everything enters relative to the exec script directory; cleanup some vars
		$root = ( substr($phpbb_root_path, 0, 2) == './') ? substr($phpbb_root_path, 2) : $phpbb_root_path ;
		$ipath = ( substr($install_path, 0, 2) == './') ? substr($install_path, 2) : $install_path ;


		//
		// copy access on the server
		//
		if ( $this->move_method == 'copy')
		{
			// make file paths relative to the EM or installer execution point
			$to = ( substr($to, 0, 9) == '../../../') ? $root . substr($to, 9) : $ipath . $to ;
			$from = ( substr($from, 0, 9) == '../../../') ? $root . substr($from, 9) : $ipath . $from ;

//////////////////////
//////////////////////
////////////////////// BUG! should be able to do *.* and should also make new dirs if needed
//////////////////////
//////////////////////
			$split=explode('/', $from) ;
			if ($split[count($split)-1] == '*.*')
			{
				return '<b>' . $lang['EM_pp_manual'] . '</b>' ;
			}

			// return a success message if the copy works
			if ( copy( $from, $to))
			{
				@chmod($to, 0644);
				return '<b>' . $lang['EM_pp_complete'] . '</b>' ;
			}

			// we failed, oh dear
			else
			{
				$this->err_msg = 'modio_move[1]<br /><br />' ;
				$this->err_msg .= sprintf( $lang['EM_modio_move_copy'], $from, $to) ;
				return '' ;
			}
		}

		//
		// FTP access to the server
		//
		else if ( $this->move_method == 'ftpa')
		{
			// make the "to" file path relative to the phpBB root and the "from" relative to EM runtime
			$to = ( substr($to, 0, 9) == '../../../') ? substr($to, 9) : $script_path . $ipath . $to ;
			$from = ( substr($from, 0, 9) == '../../../') ? substr($from, 9) : $script_path  . $ipath . $from ;

//////////////////////
//////////////////////
////////////////////// BUG! should be able to do *.* and should also make new dirs if needed
//////////////////////
//////////////////////
			$split=explode('/', $from) ;
			if ($split[count($split)-1] == '*.*')
			{
				return '<b>' . $lang['EM_pp_manual'] . '</b>' ;
			}


			// leave some breadcrumbs so we can cd back to phpbb_root
			$return_path = '' ;
			$to_dir = '' ;
			$split_array = explode('/', $to) ;
			for ($count=0; $count<count($split_array)-1; $count++)
			{
				if ($split_array[$count] != '')
				{
					$return_path .= '../' ;
					$to_dir .= $split_array[$count] . '/' ;
				}
			}

			$to_dir = substr($to_dir, 0, strlen($to_dir)-1) ;       // remove trailing slash
			$to_file = $split_array[count($split_array)-1] ;



			// get the file extension
			$file_extension = substr( $to_file, strpos($to_file, '.')+1) ;

			// I lifted this list from the attachment MOD and it saved me a lot of time. Thank you Acyd Burn!
			$extensions = array('ace', 'ai', 'aif', 'aifc', 'aiff', 'ar', 'asf', 'asx', 'au', 'avi', 'doc', 'dot', 'gif', 'gtar', 'gz', 'ivf', 'jpeg', 'jpg', 'm3u', 'mid', 'midi', 'mlv', 'mp2', 'mp3', 'mp2v', 'mpa', 'mpe', 'mpeg', 'mpg', 'mpv2', 'pdf', 'png', 'ppt', 'ps', 'rar', 'rm', 'rmi', 'snd', 'swf', 'tga', 'tif', 'wav', 'wax', 'wm', 'wma', 'wmv', 'wmx', 'wvx', 'xls', 'zip') ;
			$is_binary = true ; // forcing binary for every file

			// see if the extension is in our list of binary types
			// damn!  i wanted to use array_key_exists, but that is a PHP 4 function :(
			/*for ($count=0; $count<count($extensions); $count++)
			{
				// its a binary so mark it as such
				if ($file_extension == $extensions[$count])
				{
					$is_binary = true ;
					break ;
				}
			}*/


			// we must first CD to the dir before putting the file (found in 0.0.9)
			if ( $to_dir == '')
			{
				// do nothing
			}
			else if (!$this->emftp->ftp_chdir( $to_dir))
			{
				// we failed; don't close the connection though, assume it will be cleaned up later
				$this->err_msg = 'modio_move[2]<br /><br />' ;
				$this->err_msg .= sprintf( $lang['EM_modio_mkdir_chdir'], $to_dir, $this->emftp->ftp_pwd()) ;
				return '' ;
			}

			// move the file into place, throw an error if we fail
			// bases on the extension, move as binary or ascii (0.0.10)
			if (!$this->emftp->ftp_put( $to_file, $root . $from, $is_binary))
			{
				$this->err_msg = 'modio_move[3]<br /><br />' ;
				$this->err_msg .= sprintf( $lang['EM_modio_move_ftpa'], $from, $to_file) ;
				return '' ;
			}

			// CD back from whence we came ;-)
			if ( $return_path == '')
			{
				// do nothing
			}
			else if (!$this->emftp->ftp_chdir( $return_path))
			{
				// we failed; don't close the connection though, assume it will be cleaned up later
				$this->err_msg = 'modio_move[4]<br /><br />' ;
				$this->err_msg = sprintf( $lang['EM_modio_mkdir_chdir'], $return_path, $this->emftp->ftp_pwd()) ;
				return '' ;
			}

			return '<b>' . $lang['EM_pp_complete'] . '</b>' ;
		}

		// they be running the script, so nothing to do except return that it is ready to go
		else if ( $this->move_method == 'exec')
		{
			return '<b>' . $lang['EM_pp_ready'] . '</b>' ;
		}



///////////////////////////
///////////////////////////
/////////////////////////// there should really be a case to handle write_method is unknown
///////////////////////////
///////////////////////////
		// manually loading, so either writing to screen or downloading locally depending upon write method
		else
		{
			// downloading; return a form button that will activate the download of the file from the server
			if ($this->write_method == 'local')
			{
				// a backup file is the "from" and a download file is the "to"
				$button  = '<input type="hidden" name="file' . $mod_count . '" value="' . $to . '">' . "\n" ;
				if ($type == $lang['EM_pp_backup'])
				{
					$button  = '<input type="hidden" name="file' . $mod_count . '" value="'. $from .'">' . "\n" ;
				}
				$button .= '<input class="mainoption" type="submit" name="submitfile' . $mod_count . '" value="' . $type . '" />' . "\n" ;
				return $button ;
			}

			// writing to screen; return a link that will pop open a new window with the file contents
			else if ($this->write_method == 'screen')
			{
				$link = '<a href="' . $link . '" target="_blank">' . $type . '</a>' ;
				return $link ;
			}
		}
	}
}


?>