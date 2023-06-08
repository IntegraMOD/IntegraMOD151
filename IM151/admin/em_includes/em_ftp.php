<?php
/***************************************************************************
 *                                em_ftp.php
 *                            -------------------
 *   begin                : Tuesday, Dec 10, 2003
 *   copyright            : (C) 2002-2004 Nuttzy - Craig Nuttall, 2005 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: em_ftp.php,v 1.18 2007/02/22 03:32:20 wgeric Exp $
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
// THE PURPOSE of this module is to house everything related to FTP.  The FTP class by TOMO based on 
// fsockopenis the main attraction.  I could strip out many of the functions there, but they are pretty
// cool so I'll leave them for now.  They might come in handy later.  I also support the PHP FTP
// Extension for those that have problems with fsockopen and have the extension compiled.
//


// used in step 2 of the installer to test the connection and also used in the debug feature; also
// used in the main proggie to check settings
function capture_test_ftp($ftp_user, $ftp_pass, $ftp_dir, $ftp_host, $ftp_port, $ftp_debug, $ftp_type, $ftp_cache, &$test_report)
{
	ob_start();
	$result = test_ftp($ftp_user, $ftp_pass, $ftp_dir, $ftp_host, $ftp_port, $ftp_debug, $ftp_type, $ftp_cache);
	$test_report = ob_get_contents();
	ob_end_clean();
	return $result;
}
function test_ftp($ftp_user, $ftp_pass, $ftp_dir, $ftp_host, $ftp_port, $ftp_debug, $ftp_type, $ftp_cache)
{
	global $lang, $phpbb_root_path, $easymod_install_version;

	echo '<h3>' . $lang['EM_ftp_testing'] . '</h3>' . "\n";

	// create the emftp which will use either fsockopen or the PHP FTP extension
	$emftp = new emftp($ftp_type, $ftp_debug);

	// connect to the FTP server
	if( !$emftp->ftp_connect( $ftp_host, $ftp_port) )
	{
		// failed to connect!
		echo '<br />' . "\n";
		echo '<b>' . sprintf($lang['EM_ftp_fail_conn'], $ftp_host, $ftp_port) . '</b><br />' . "\n";

		// they may need to specify the host
		if( $ftp_host == 'localhost' )
		{
			echo $lang['EM_ftp_fail_conn_lh'] . '<br />' . "\n";
		}

		// they may need to specify the port
		elseif( $ftp_port == 21 )
		{
			echo $lang['EM_ftp_fail_conn_21'] . '<br />' . "\n";
		}

		// the host the entered failed to connect
		else
		{
			// if they have / : or \ in the hostname then they are probably stupid and supplying invalid name
			if( (strstr($ftp_host, '/')) || (strstr($ftp_host, '\\')) || (strstr($ftp_host, ':')) )
			{
				echo $lang['EM_ftp_fail_conn_invalid'] . '<br />' . "\n";
				echo '<br />' . "\n";
			}

			// if they have anything other than an integer in the port then...
			elseif( intval($ftp_port) == $ftp_port )
			{
				echo $lang['EM_ftp_fail_conn_invalid2'] . '<br />' . "\n";
				echo '<br />' . "\n";
			}

			// give them options
			echo $lang['EM_fail_conn_info'] . '<br /><ol>' . "\n";
			echo '<li>' . $lang['EM_fail_conn_op1'] . '</li>' . "\n";
			echo '<li>' . $lang['EM_fail_conn_op2'] . '</li>' . "\n";
			echo '<li>' . $lang['EM_fail_conn_op3'] . '</li>' . "\n";
			echo '<li>' . $lang['EM_fail_conn_op4'] . '</li>' . "\n";
			echo '</ol>' . "\n";
		}

		return false;
	}

	// connected to the FTP server, now send the user/pass
	if( !$emftp->ftp_login($ftp_user, $ftp_pass) )
	{
		// failed to login!  Tell them they are stupid!  Disconnect from server
		$emftp->ftp_quit();

		echo '<br />' . "\n";
		echo '<b>' . $lang['EM_fail_login'] . '</b><br />' . "\n";

		// give them options
		echo $lang['EM_fail_login_info'] . '<br /><ol>' . "\n";

		// check user/pass
		echo '<li>' . $lang['EM_fail_login_op1'] . '</li>' . "\n";
		if( $ftp_host == 'localhost' || $ftp_port == 21 )
		{
			// change from localhost
			echo '<li>' . $lang['EM_fail_login_op2a'] . '</li>' . "\n";
		}
		else
		{
			// change to localhost or something else
			echo '<li>' . $lang['EM_fail_login_op2b'] . '</li>' . "\n";
		}
		echo '</ol>' . "\n";

		return false;
	}

	echo $lang['EM_test_ftp1']. '<br />' . "\n";


	// if we are in debug mode, then get a dir listing before we start moving around
	if( $ftp_debug )
	{
		echo '<b>' . $lang['EM_dir_current'] . ':</b> ' . $emftp->ftp_pwd() . '<br />' . "\n";

//////
////// http://www.phpbb.com/phpBB/viewtopic.php?p=706118#706118 - not sure what happened to nlist there
//////

		$list = $emftp->ftp_nlist();
		echo sprintf($lang['EM_dir_nlist'], count($list)) . '<br />' . "\n";
		for( $i = 0; $i < count($list); $i++ )
		{
			echo '[' . $list[$i] . ']<br />' . "\n";
		}
	}

	// change directory to the EM dir
	if( !($pwd = $emftp->ftp_chdir($ftp_dir . '/admin/mods/easymod')) )
	{
		echo '<br />' . "\n";
		echo '<b>' . sprintf($lang['EM_fail_cd'], $ftp_dir) . '</b><br />' . "\n";

		echo $lang['EM_fail_cd_info'] . '<br /><ol><br />' . "\n";

		// some dopes put the ftp server in the paths
		if( (strstr($ftp_dir, '.com')) || (strstr($ftp_dir, '.net')) || (strstr($ftp_dir, '.org')) )
		{
			echo '<li>' . $lang['EM_fail_cd_op1'] . '</li>' . "\n";
		}

		// make sure there is no / at the end of the path
		if( substr($ftp_dir, strlen($ftp_dir)-1) == '/' )
		{
			echo '<li>' . $lang['EM_fail_cd_op2'] . '</li>' . "\n";
		}

		// everything else
		echo '<li>' . $lang['EM_fail_cd_op3'] . '</li>' . "\n";
		echo '<li>' . $lang['EM_fail_cd_op4'] . '</li>' . "\n";

		if( $ftp_host == 'localhost' || $ftp_port == 21 )
		{
			echo '<li>' . $lang['EM_fail_cd_op5'] . '</li>' . "\n";
		}

		echo '<li>' . $lang['EM_fail_cd_op6'] . '</li>' . "\n";
		echo '</ol>' . "\n";

		// print the working dir
		$emftp->set_debug(false);
		echo '<br />' . "\n";
		echo '<b>' . $lang['EM_ftp_root'] . '</b><br />' . "\n";
		// if pwd fails then we know it is probably a passive mode problem
		if( !$emftp->ftp_pwd() )
		{
			echo $lang['EM_fail_cd_pwd'] . '<br />' . "\n";
		}
		else
		{
			echo $emftp->ftp_pwd() . '<br />' . "\n";
		}

		// print directory listing
		echo '<br /><br />' . $lang['EM_dir_list'] . '<br />' . "\n";
		$list = $emftp->ftp_nlist();

		// if the nlist command failed, then print an error
		if( !$list )
		{
			echo $lang['EM_fail_cd_nlist'] . '<br />' . "\n";
		}
		// if there are no files then indicate there are none to print
		elseif( count($list) == 0 )
		{
			echo '--' . $lang['EM_fail_cd_nlist_no'] . '--<br />' . "\n";
		}
		else
		{
			for( $i = 0; $i < count($list); $i++ )
			{
				echo $list[$i] . '<br />' . "\n";
			}
		}

		$emftp->ftp_quit();
		return false;
	}

	if( !($pwd = $emftp->ftp_pwd()) )
	{
		$emftp->ftp_quit();
		echo $lang['EM_fail_pwd'] . '<br />' . "\n";
		return false;
	}

	echo $lang['EM_test_ftp2'] . '<br />' . "\n";


/////
///// this looks like it could be a problem with the ../../../ on ftp
/////
//	$local_filename  = 'easymod.gif';
//	$remote_filename = '../../../easymod.gif';
	$local_filename  = $phpbb_root_path . 'admin/mods/easymod/easymod.gif';
	$remote_filename = $phpbb_root_path . 'easymod.gif';

	// write to phpBB root and then, confirm we can overwrite so just do the same thing again
	$test_twice = array('EM_fail_put', 'EM_fail_reput');
	foreach( $test_twice as $langkey )
	{
		if( !$emftp->ftp_put($remote_filename, $local_filename, 1) )
		{
			$emftp->ftp_quit();

			echo '<br />' . "\n";
			echo '<b>' . $lang[$langkey] . '</b><br />' . "\n";
			echo sprintf($lang['EM_fail_put_info'], $ftp_user) . '<br />' . "\n";

			echo '<br />' . "\n";
			echo '<b>' . $lang['EM_ftp_phpbb_root'] . '</b><br />' . "\n";
			if( $dh = opendir($phpbb_root_path) )
			{
				while( ($file = readdir($dh)) !== false )
				{
					echo mfunGetPerms(fileperms($phpbb_root_path . $file)) . " $file <br />" . "\n";
				}
				closedir($dh);
			}

			return false;
		}
	}

	// cleanup
	if( !$emftp->ftp_delete($remote_filename) )
	{
		echo $lang['EM_fail_delete'] . '<br />' . "\n";
	}

	echo $lang['EM_test_ftp3']. '<br />' . "\n";


	// if we are using the FTP ext and the cache, then make sure the cache is created, otherwise create it
	if( ($ftp_type == 'ext') && ($ftp_cache) )
	{
		// return the admin directory
		$emftp->ftp_cdup();
		$emftp->ftp_cdup();

		// see if the cache dir exists, otherwise create it put_array
		if( !file_exists($phpbb_root_path . 'admin/em_includes/cache') )
		{
			$emftp->ftp_mkdir('em_includes');
			$emftp->ftp_chdir('em_includes');
			$emftp->ftp_mkdir('cache');

			if( !file_exists($phpbb_root_path . 'admin/em_includes/cache') )
			{
				$emftp->ftp_quit();
				echo sprintf($lang['EM_fail_make_cache'], 'admin/em_includes/cache') . '<br />' . "\n";
				return false;
			}
		}

		// if it was there before (created from a previous EM install)...
		// due to chmod 755 in previous versions, it might not be writable, try to fix this then
		elseif( !is_writeable($phpbb_root_path . 'admin/em_includes/cache') )
		{
			$emftp->ftp_chdir('em_includes');
			$emftp->emftp_chmod('em_includes', '0755');
			$emftp->ftp_chdir('cache');
			$emftp->emftp_chmod('cache', '0755');
		}

		// create a tmp file and write something out
		$tmpfname = @tempnam($phpbb_root_path . 'admin/em_includes/cache', 'txt');
		@unlink($tmpfname); // unlink for safety on php4.0.3+
		if( $fp = @fopen($tmpfname, 'wb') )
		{
			@fwrite($fp, ">>$easymod_install_version<<\n");
			@fclose($fp);
			@unlink($tmpfname);	// Delete the temporary file
		}
		else
		{
			$emftp->ftp_quit();
			echo sprintf($lang['EM_fail_tmp'], $tmpfname) . '<br />' . "\n";
			return false;
		}

		echo $lang['EM_test_ftp4']. '<br />' . "\n";
	}

	// disconnect
	$emftp->ftp_quit();
	return true;
}





/*********************************************************************
 *
 *    PHP FTP Client Class By TOMO ( groove@spencernetwork.org )
 *
 *  - Version 0.13 (2002/06/19)
 *  - This script is free but without any warranty.
 *  - You can freely copy, use, modify or redistribute this script
 *    for any purpose.
 *  - But please do not erase this information!!.
 *
 ********************************************************************/

/*
CHANGES BY NUTTZY
	refined the print_debug to print nicely
	made so the password won't be displayed
	added the ftp_put_array function

not worrying about lang stuff here as we won't be in debug mode and therefore none of the message will be seen
*/

class ftp
{
	/* Public variables */
	var $debug;		// print debug messages
	var $timeout;	// fsockopen() time-out
	var $umask;		// local umask

	/* Private variables */
	var $_sock;
	var $_resp;
	var $_buf;

	/* Constractor */
	function ftp($debug = FALSE, $timeout = 30, $umask = 0022)
	{
		$this->debug   = $debug;
		$this->timeout = $timeout;
		$this->umask   = $umask;

		if (!defined("FTP_BINARY")) {
			define("FTP_BINARY", 1);
		}
		if (!defined("FTP_ASCII")) {
			define("FTP_ASCII", 0);
		}

		$this->_sock = FALSE;
		$this->_resp = "";
		$this->_buf  = 4096;
	}

	/* Public functions */
	function ftp_connect($server, $port = 21)
	{
		$this->_debug_print("Trying to connect to ".$server.":".$port." ...\n");
		$this->_sock = @fsockopen($server, $port, $errno, $errstr, $this->timeout);

		if (!$this->_sock || !$this->_ok()) {
			$this->_debug_print("Error : Cannot connect to remote host \"".$server.":".$port."\"\n");
			$this->_debug_print("Error : fsockopen() ".$errstr." (".$errno.")\n");
			return FALSE;
		}
		$this->_debug_print("Connected to remote host \"".$server.":".$port."\"\n");

		return TRUE;
	}

	function ftp_login($user, $pass)
	{
		$this->_putcmd("USER", $user);
		if (!$this->_ok()) {
			$this->_debug_print("Error : USER command failed\n");
			return FALSE;
		}

		$this->_putcmd("PASS", $pass);
		if (!$this->_ok()) {
			$this->_debug_print("Error : PASS command failed\n");
			return FALSE;
		}
		$this->_debug_print("Authentication succeeded\n");

		return TRUE;
	}

	function ftp_pwd()
	{
		$this->_putcmd("PWD");
		if (!$this->_ok()) {
			$this->_debug_print("Error : PWD command failed\n");
			return FALSE;
		}

		return ereg_replace("^[0-9]{3} \"(.+)\" .+\r\n", "\\1", $this->_resp);
	}

	function ftp_size($pathname)
	{
		$this->_putcmd("SIZE", $pathname);
		if (!$this->_ok()) {
			$this->_debug_print("Error : SIZE command failed\n");
			return -1;
		}

		return ereg_replace("^[0-9]{3} ([0-9]+)\r\n", "\\1", $this->_resp);
	}

	function ftp_mdtm($pathname)
	{
		$this->_putcmd("MDTM", $pathname);
		if (!$this->_ok()) {
			$this->_debug_print("Error : MDTM command failed\n");
			return -1;
		}
		$mdtm = ereg_replace("^[0-9]{3} ([0-9]+)\r\n", "\\1", $this->_resp);
		$date = sscanf($mdtm, "%4d%2d%2d%2d%2d%2d");
		$timestamp = mktime($date[3], $date[4], $date[5], $date[1], $date[2], $date[0]);

		return $timestamp;
	}

	function ftp_systype()
	{
		$this->_putcmd("SYST");
		if (!$this->_ok()) {
			$this->_debug_print("Error : SYST command failed\n");
			return FALSE;
		}
		$DATA = explode(" ", $this->_resp);

		return $DATA[1];
	}

	function ftp_cdup()
	{
		$this->_putcmd("CDUP");
		$response = $this->_ok();
		if (!$response) {
			$this->_debug_print("Error : CDUP command failed\n");
		}
		return $response;
	}

	function ftp_chdir($pathname)
	{
		$this->_putcmd("CWD", $pathname);
		$response = $this->_ok();
		if (!$response) {
			$this->_debug_print("Error : CWD command failed\n");
		}
		return $response;
	}

	function ftp_delete($pathname)
	{
		$this->_putcmd("DELE", $pathname);
		$response = $this->_ok();
		if (!$response) {
			$this->_debug_print("Error : DELE command failed\n");
		}
		return $response;
	}

	function ftp_rmdir($pathname)
	{
		$this->_putcmd("RMD", $pathname);
		$response = $this->_ok();
		if (!$response) {
			$this->_debug_print("Error : RMD command failed\n");
		}
		return $response;
	}

	function ftp_mkdir($pathname)
	{
		$this->_putcmd("MKD", $pathname);
		$response = $this->_ok();
		if (!$response) {
			$this->_debug_print("Error : MKD command failed\n");
		}
		return $response;
	}

	function ftp_file_exists($pathname)
	{
		if (!($remote_list = $this->ftp_nlist("-a"))) {
			$this->_debug_print("Error : Cannot get remote file list\n");
			return -1;
		}
		
		reset($remote_list);
		while (list(,$value) = each($remote_list)) {
			if ($value == $pathname) {
				$this->_debug_print("Remote file ".$pathname." exists\n");
				return 1;
			}
		}
		$this->_debug_print("Remote file ".$pathname." does not exist\n");

		return 0;
	}

	function ftp_rename($from, $to)
	{
		$this->_putcmd("RNFR", $from);
		if (!$this->_ok()) {
			$this->_debug_print("Error : RNFR command failed\n");
			return FALSE;
		}
		$this->_putcmd("RNTO", $to);

		$response = $this->_ok();
		if (!$response) {
			$this->_debug_print("Error : RNTO command failed\n");
		}
		return $response;
	}

	function ftp_nlist($arg = "", $pathname = "")
	{
		if (!($string = $this->_pasv())) {
			return FALSE;
		}

		if ($arg == "") {
			$nlst = "NLST";
		} else {
			$nlst = "NLST ".$arg;
		}
		$this->_putcmd($nlst, $pathname);

		$sock_data = $this->_open_data_connection($string);
		if (!$sock_data || !$this->_ok()) {
			$this->_debug_print("Error : Cannot connect to remote host\n");
			$this->_debug_print("Error : NLST command failed\n");
			return FALSE;
		}
		$this->_debug_print("Connected to remote host\n");

		while (!feof($sock_data)) {
			$list[] = ereg_replace("[\r\n]", "", fgets($sock_data, 512)) ;
		}
		$this->_close_data_connection($sock_data);
		$this->_debug_print(implode("\n", $list));

		if (!$this->_ok()) {
			$this->_debug_print("Error : NLST command failed\n");
			return FALSE;
		}

		return $list;
	}

	function ftp_rawlist($pathname = "")
	{
		if (!($string = $this->_pasv())) {
			return FALSE;
		}

		$this->_putcmd("LIST", $pathname);

		$sock_data = $this->_open_data_connection($string);
		if (!$sock_data || !$this->_ok()) {
			$this->_debug_print("Error : Cannot connect to remote host\n");
			$this->_debug_print("Error : LIST command failed\n");
			return FALSE;
		}

		$this->_debug_print("Connected to remote host\n");

		while (!feof($sock_data)) {
			$list[] = ereg_replace("[\r\n]", "", fgets($sock_data, 512));
		}
		$this->_debug_print(implode("\n", $list));
		$this->_close_data_connection($sock_data);

		if (!$this->_ok()) {
			$this->_debug_print("Error : LIST command failed\n");
			return FALSE;
		}

		return $list;
	}

	function ftp_get($localfile, $remotefile, $mode = 1)
	{
		umask($this->umask);

		if (@file_exists($localfile)) {
			$this->_debug_print("Warning : local file will be overwritten\n");
		}

		$fp = @fopen($localfile, "wb");
		if (!$fp) {
			$this->_debug_print("Error : Cannot create \"".$localfile."\"");
			$this->_debug_print("Error : GET command failed\n");
			return FALSE;
		}

		if (!$this->_type($mode)) {
			$this->_debug_print("Error : GET command failed\n");
			return FALSE;
		}

		if (!($string = $this->_pasv())) {
			$this->_debug_print("Error : GET command failed\n");
			return FALSE;
		}

		$this->_putcmd("RETR", $remotefile);

		$sock_data = $this->_open_data_connection($string);
		if (!$sock_data || !$this->_ok()) {
			$this->_debug_print("Error : Cannot connect to remote host\n");
			$this->_debug_print("Error : GET command failed\n");
			return FALSE;
		}
		$this->_debug_print("Connected to remote host\n");
		$this->_debug_print("Retrieving remote file \"".$remotefile."\" to local file \"".$localfile."\"\n");
		while (!feof($sock_data)) {
			fwrite($fp, fread($sock_data, $this->_buf));
		}
		fclose($fp);

		$this->_close_data_connection($sock_data);

		$response = $this->_ok();
		if (!$response) {
			$this->_debug_print("Error : GET command failed\n");
		}
		return $response;
	}

	function ftp_put($remotefile, $localfile, $mode = 1)
	{
		
		if (!@file_exists($localfile)) {
			$this->_debug_print("Error : No such file or directory \"".$localfile."\"\n");
			$this->_debug_print("Error : PUT command failed\n");
			return FALSE;
		}

		$fp = @fopen($localfile, "rb");
		if (!$fp) {
			$this->_debug_print("Error : Cannot read file \"".$localfile."\"\n");
			$this->_debug_print("Error : PUT1 command failed\n");
			return FALSE;
		}

		if (!$this->_type($mode)) {
			$this->_debug_print("Error : PUT2 command failed\n");
			return FALSE;
		}

		if (!($string = $this->_pasv())) {
			$this->_debug_print("Error : PUT3 command failed\n");
			return FALSE;
		}

		// delete the old file and then move on
		$this->ftp_delete($remotefile);

		$this->_putcmd("STOR", $remotefile);

		$sock_data = $this->_open_data_connection($string);
		if (!$sock_data || !$this->_ok()) {
			$this->_debug_print("Error : Cannot connect to remote host\n");
			$this->_debug_print("Error : PUT4 command failed\n");
			return FALSE;
		}
		$this->_debug_print("Connected to remote host\n");
		$this->_debug_print("Storing local file \"".$localfile."\" to remote file \"".$remotefile."\"\n");
		while (!feof($fp)) {
			fwrite($sock_data, fread($fp, $this->_buf));
		}
		fclose($fp);

		$this->_close_data_connection($sock_data);

		$response = $this->_ok();
		if (!$response) {
			$this->_debug_print("Error : PUT5 command failed\n");
			
			// try deleting the file and then moving it into place after that
			if ( $this->ftp_delete($remotefile) )
			{
				$this->_putcmd("STOR", $remotefile);
				$response = $this->_ok();
				if (!$response) {
					$this->_debug_print("Error : PUT6 command failed\n");
				}
			}
			else
			{
				$this->_debug_print("Error : DELE command failed\n");
			}
		}
		
		return $response;
	}


	////////////////////////////
	// added by Nuttzy
	//	dump and array of lines into a file
	//
	function ftp_put_array($remotefile, $lines, $mode = 1)
	{
		if (!$this->_type($mode)) {
			$this->_debug_print("Error : PUT command failed\n");
			return FALSE;
		}

		if (!($string = $this->_pasv())) {
			$this->_debug_print("Error : PUT command failed\n");
			return FALSE;
		}

		$this->_putcmd("STOR", $remotefile);

		$sock_data = $this->_open_data_connection($string);
		if (!$sock_data || !$this->_ok()) {
			$this->_debug_print("Error : Cannot connect to remote host\n");
			$this->_debug_print("Error : PUT command failed\n");
			return FALSE;
		}
		$this->_debug_print("Connected to remote host\n");
		$this->_debug_print("Storing local file \"".$localfile."\" to remote file \"".$remotefile."\"\n");

		// dump the array into the file
		for ($count=0; $count<count($lines); $count++)
		{
			fwrite($sock_data, $lines[$count]);
		}

		$this->_close_data_connection($sock_data);

		$response = $this->_ok();
		if (!$response) {
			$this->_debug_print("Error : PUT command failed\n");
		}
		return $response;
	}
//////////////////////////////

	function emftp_chmod($file, $perms)
	{
		$this->_putcmd('SITE CHMOD', substr($perms, 1) . ' ' . $file);
		$response = $this->_ok();
		if (!$response) {
			$this->_debug_print("Error : CHMOD command failed\n");
		}
		return $response;
	}	

	function ftp_site($command)
	{
		$this->_putcmd("SITE", $command);
		$response = $this->_ok();
		if (!$response) {
			$this->_debug_print("Error : SITE command failed\n");
		}
		return $response;
	}

	function ftp_quit()
	{
		$this->_putcmd("QUIT");
		if (!$this->_ok() || !fclose($this->_sock)) {
			$this->_debug_print("Error : QUIT command failed\n");
			return FALSE;
		}
		$this->_debug_print("Disconnected from remote host\n");
		return TRUE;
	}

	/* Private Functions */

	function _type($mode)
	{
		if ($mode) {
			$type = "I"; //Binary mode
		} else {
			$type = "A"; //ASCII mode
		}
		$this->_putcmd("TYPE", $type);
		$response = $this->_ok();
		if (!$response) {
			$this->_debug_print("Error : TYPE command failed\n");
		}
		return $response;
	}

	function _port($ip_port)
	{
		$this->_putcmd("PORT", $ip_port);
		$response = $this->_ok();
		if (!$response) {
			$this->_debug_print("Error : PORT command failed\n");
		}
		return $response;
	}

	function _pasv()
	{
		$this->_putcmd("PASV");
		if (!$this->_ok()) {
			$this->_debug_print("Error : PASV command failed\n");
			return FALSE;
		}

		$ip_port = ereg_replace("^.+ \\(?([0-9]{1,3},[0-9]{1,3},[0-9]{1,3},[0-9]{1,3},[0-9]+,[0-9]+)\\)?.*\r\n$", "\\1", $this->_resp);
		return $ip_port;
	}

	function _putcmd($cmd, $arg = "")
	{
		if ($arg != "") {
			$cmd = $cmd." ".$arg;
		}

		fwrite($this->_sock, $cmd."\r\n");
		$this->_debug_print("> ".$cmd."\n");

		return TRUE;
	}

	function _ok()
	{
		$this->_resp = "";
		do {
			$res = fgets($this->_sock, 512);
			$this->_resp .= $res;
		} while (substr($res, 3, 1) != " ");

		$this->_debug_print(str_replace("\r\n", "\n", $this->_resp));

		if (!ereg("^[123]", $this->_resp)) {
			return FALSE;
		}

		return TRUE;
	}

	function _close_data_connection($sock)
	{
		$this->_debug_print("Disconnected from remote host\n");
		return fclose($sock);
	}

	function _open_data_connection($ip_port)
	{
		if (!ereg("[0-9]{1,3},[0-9]{1,3},[0-9]{1,3},[0-9]{1,3},[0-9]+,[0-9]+", $ip_port)) {
			$this->_debug_print("Error : Illegal ip-port format(".$ip_port.")\n");
			return FALSE;
		}

		$DATA = explode(",", $ip_port);
		$ipaddr = $DATA[0].".".$DATA[1].".".$DATA[2].".".$DATA[3];
		$port   = $DATA[4]*256 + $DATA[5];
		$this->_debug_print("Trying to ".$ipaddr.":".$port." ...\n");
		$data_connection = @fsockopen($ipaddr, $port, $errno, $errstr);
		if (!$data_connection) {
			$this->_debug_print("Error : Cannot open data connection to ".$ipaddr.":".$port."\n");
			$this->_debug_print("Error : ".$errstr." (".$errno.")\n");
			return FALSE;
		}

		return $data_connection;
	}

	function _debug_print($message = "")
	{
		// htmlspecialchars and str_replace added by Nuttzy
		$message = htmlspecialchars($message) ;
		$message = str_replace( "\n", "<br />\n", $message) ;

		// hide the password added by Nuttzy
		$words = explode(" ", $message) ;
		if ($words[1] == 'PASS')
		{
			$message = "> PASS ********<br />\n" ;
		}

		if ($this->debug)
		{
			echo $message ;
		}

		return TRUE;
	}
}




/***************************************************************************
 *                              emftp class
 *                            -------------------
 *   begin                : Thursday Nov 27, 2003
 *   copyright            : (C) 2002 thru 2004 Nuttzy
 *   email                : pktoolkit@blizzhackers.com
 *
 ***************************************************************************/

class emftp
{
	/* Purpose:
		Some servers do not have the PHP FTP Extension compliled or do not have /tmp write access.  Not all
		servers can use the FTP Client Class by TOMO, generally b/c of PASV settings.  Both methods must be
		made available.  This class simply sits on top of both of those classes, properly using whichever
		method was selected.  This allows for code reuse.
	*/

	var $ftp_type ;		// ext = extension; fsock = fsocketopen

	var $ftp ;			// ext FTP class
	var $ftp_conn_id ;	// fsock FTP stream


	// constructor
	function emftp( $type, $debug = FALSE)
	{
		// define either fsock or ext
		$this->ftp_type = $type ;
		$this->ftp = NULL ;
		$this->ftp_conn_id = NULL ;

		// instantiate the fsock class
		if ($this->ftp_type == 'fsock')
		{
			$this->ftp = new ftp();
			$this->ftp->debug = $debug ;
		}
	}

	// sets debug mode on the fsock class
	function set_debug( $debug)
	{
		$this->ftp->debug = $debug ;
	}

	function ftp_connect( $ftp_host, $ftp_port)
	{
		if ($this->ftp_type == 'fsock')
		{
			return $this->ftp->ftp_connect( $ftp_host, $ftp_port) ;
		}
		else
		{
			$this->ftp_conn_id = @ftp_connect( $ftp_host, $ftp_port);
			return $this->ftp_conn_id ;
		}
	}

	function ftp_login( $ftp_user, $ftp_pass)
	{
		if ($this->ftp_type == 'fsock')
		{
			return $this->ftp->ftp_login( $ftp_user, $ftp_pass) ;
		}
		else
		{
			return @ftp_login( $this->ftp_conn_id, $ftp_user, $ftp_pass);
		}
	}

	function ftp_quit()
	{
		if ($this->ftp_type == 'fsock')
		{
			$this->ftp->ftp_quit() ;
		}
		else
		{
			@ftp_quit( $this->ftp_conn_id);
		}
	}

	function ftp_pwd()
	{
		if ($this->ftp_type == 'fsock')
		{
			return $this->ftp->ftp_pwd() ;
		}
		else
		{
			return @ftp_pwd( $this->ftp_conn_id);
		}
	}

	function ftp_nlist()
	{
		if ($this->ftp_type == 'fsock')
		{
			return $this->ftp->ftp_nlist() ;
		}
		else
		{
			// always do an nlist on the current dir
			return @ftp_nlist( $this->ftp_conn_id, './');
		}
	}

	function ftp_chdir( $ftp_dir)
	{
		if ($this->ftp_type == 'fsock')
		{
			return $this->ftp->ftp_chdir( $ftp_dir) ;
		}
		else
		{
			return @ftp_chdir( $this->ftp_conn_id, $ftp_dir);
		}
	}

	function ftp_cdup()
	{
		if ($this->ftp_type == 'fsock')
		{
			return $this->ftp->ftp_cdup() ;
		}
		else
		{
			return @ftp_cdup( $this->ftp_conn_id);
		}
	}

	function emftp_chmod($file, $perms)
	{
		if ( $this->ftp_type == 'fsock')
		{
			return $this->ftp->emftp_chmod($file, $perms);
		}
		else
		{
			if ( function_exists('ftp_chmod') && @ftp_chmod($this->ftp_conn_id, intval($perms, 8), $file) )
			{
				return true;
			}
			else
			{
				$chmod_cmd = 'CHMOD ' . $perms . ' ' . $file;
				return ftp_site($this->ftp_conn_id, $chmod_cmd);
			}
		}
	}

	function ftp_put( $remote_filename, $local_filename, $file_type)
	{
		if ($this->ftp_type == 'fsock')
		{
			$result = $this->ftp->ftp_put( $remote_filename, $local_filename, $file_type) ;
			if ( $result )
			{
				$this->emftp_chmod($remote_filename, '0644');
			}
			return $result;
		}
		else
		{
			// make sure what we are putting actually exists
			if (!@file_exists($local_filename))
			{
				return false ;
			}

			$result = ftp_put( $this->ftp_conn_id, $remote_filename, $local_filename, ($file_type==1) ? FTP_BINARY : FTP_ASCII ) ;
			
			// if did not work, attempt to delete the file and then move the new one in place
			if ( !$result )
			{
				if ( ftp_delete($this->ftp_conn_id, $remote_filename) )
				{
					$result = ftp_put( $this->ftp_conn_id, $remote_filename, $local_filename, ($file_type==1) ? FTP_BINARY : FTP_ASCII ) ;
				}			
			}
						
			if ( $result )
			{
				$this->emftp_chmod($remote_filename, '0644');
			}
			return $result;
		}
	}

	function ftp_put_array( $to_file, $array_lines, $ftp_cache)
	{
		global $phpbb_root_path ;

		if ($this->ftp_type == 'fsock')
		{
			$result = $this->ftp->ftp_put_array( $to_file, $array_lines, 0) ;
			if ( $result )
			{
				$this->emftp_chmod($to_file, '0644');
			}
			return $result;
		}
		else
		{
			// the FTP Extension can only move files about, we can't build them directly :(  So create
			//   a temp file first (assuming we have access)

			// Write out a temp file...

			// create in the cache directory if we don't have tmp write access
			if ( $ftp_cache)
			{
				// make sure the cache directory exists
				if (!file_exists($phpbb_root_path . 'admin/em_includes/cache'))
				{
					return false;
				}
				$tmpfname = @tempnam($phpbb_root_path . 'admin/em_includes/cache', 'txt');
			}
			// create in the tmp dir
			else
			{
				$tmpfname = @tempnam('/tmp', 'txt');
			}


			@unlink($tmpfname); // unlink for safety on php4.0.3+
			$fp = @fopen($tmpfname, 'wb');
			for ($i=0; $i<count($array_lines); $i++)
			{
				@fwrite($fp, $array_lines[$i]);
			}
			@fclose($fp);

			// put the file and then cleanup the temp file
			$result = ftp_put( $this->ftp_conn_id, $to_file, $tmpfname, FTP_ASCII ) ;
			if ( $result )
			{
				$this->emftp_chmod($to_file, '0644');
			}
			unlink($tmpfname);

			return $result ;
		}
	}

	function ftp_delete( $remote_filename)
	{
		if ($this->ftp_type == 'fsock')
		{
			return $this->ftp->ftp_delete( $remote_filename) ;
		}
		else
		{
			return ftp_delete( $this->ftp_conn_id, $remote_filename) ;
		}
	}

	function ftp_mkdir( $dir_name)
	{
		if ($this->ftp_type == 'fsock')
		{
			$result = $this->ftp->ftp_mkdir( $dir_name) ;
			if ( $result )
			{
				$this->emftp_chmod($dir_name, '0755');
			}
			return $result;
		}
		else
		{
			$result = @ftp_mkdir( $this->ftp_conn_id, $dir_name) ;
			$this->emftp_chmod($dir_name, '0755');
//			return $result ;
/////////////
/////////////
/////////////
///////////// not sure why always returning false even when successful :(  just assume true - BLAH!
/////////////
/////////////
/////////////
			return true ;
		}
	}


	// we expect phpbb_root_path to either be ./ or ./ with one more ../ following; we need
	//	to find out how many ../'s there are
	function ftp_count_cdups( $root_path)
	{
		$count = 0 ;
		while (strlen($root_path) > 0)
		{
			if ( substr($root_path, 0, 3) == '../')
			{
				$root_path = substr($root_path, 3) ;
				$count++ ;
			}
			else
			{
				break ;
			}
		}
		return $count ;
	}


	// send the nummber of ../ needed to get back to the phpbb_root_path
	function ftp_cdup_home( $num_ups)
	{
		for ($i=0; $i<$num_ups; $i++)
		{
			if (!$this->ftp_cdup())
			{
				return false ;
			}
		}
		return true ;
	}


	// give a path, build the directory structure from the mod install dir
	function ftp_mkdir_struct( $path_to_build, &$err_msg)
	{
		global $lang, $script_path, $phpbb_root_path ;

		$dir_path = '' ;
		$ftp_path = '' ;

		// strip off leading ./ from phpbb root
		$root_path = ( substr($phpbb_root_path, 0, 2) == './') ? substr($phpbb_root_path, 2) : $phpbb_root_path ;

		// prepare for number of CD ../ we'll need to do to get back after we are done
		$num_return_cdup = $this->ftp_count_cdups( $root_path) ;


		// cd to the script path
		if (!$this->ftp_chdir( $script_path))
		{
			// we failed; don't close the connection though, assume it will be cleaned up later
			$err_msg = 'ftp_mkdir_struct[1]<br /><br />' ;
			$err_msg .= sprintf( $lang['EM_modio_mkdir_chdir'], $script_path, $this->ftp_pwd()) ;
			return false ;
		}

		// loop through the path structure and create dirs as needed
		$splitarray = explode('/', $path_to_build) ;
		for ($idir=0; $idir<count($splitarray)-1; $idir++)
		{
			$prev_path = $ftp_path ;
			$ftp_path = trim($splitarray[$idir]) ;
			$dir_path .= $ftp_path ;

			// often times a "./" gets added to the path; let's skip that
			if ( $dir_path == '.')
			{
				// do nothing
				$ftp_path = '' ;
				$dir_path = '' ;
			}

			// the directory doesn't exist, let's make it
			else if (!file_exists($dir_path))
			{
				// if we made a dir the previous loop, then cd into it now
				if ($prev_path != '')
				{
					// if we can't chdir, try to get back to phpbb_root before escaping
					if (!$this->ftp_chdir( $prev_path))
					{
						// v0.0.10c, corrected err_msg to use prev_path instead of root_path - not tested!
						$err_msg = 'ftp_mkdir_struct[2]<br /><br />' ;
						$err_msg .= sprintf( $lang['EM_modio_mkdir_chdir'], $prev_path, $this->ftp_pwd()) ;
						$this->ftp_cdup_home( $num_return_cdup) ;
						return false ;
					}
					$num_return_cdup++ ;
				}

				// make the directory; return error if failed
				if (!$this->ftp_mkdir( $ftp_path))
				{
					$err_msg = 'ftp_mkdir_struct[3]<br /><br />' ;
					$err_msg .= sprintf( $lang['EM_modio_mkdir_mkdir'], $ftp_path, $this->ftp_pwd());
					$this->ftp_cdup_home( $num_return_cdup) ;
					return false ;
				}

				$dir_path .= '/' ;
			}

			// directory already exists no need to make, but probably need to cd into a dir created last loop
			else
			{
				// cd into dir we made during last pass
				if ($prev_path != '')
				{
					$this->ftp_chdir( $prev_path) ;
					$num_return_cdup++ ;
				}
				$dir_path .= '/' ;
			}
		}

		// return us to phpbb root
		if (!$this->ftp_cdup_home( $num_return_cdup))
		{
			$return_path = '' ;
			for ($i=0; $i<$num_return_cdup; $i++)
			{
				$return_path .= '../' ;
			}
			$err_msg = 'ftp_mkdir_struct[4]<br /><br />' ;
			$err_msg .= sprintf( $lang['EM_modio_mkdir_chdir'], $return_path, $this->ftp_pwd());
			return false ;
		}

		return true ;
	}



	// give a path, build the directory structure from phpbb root
	function ftp_mkdir_struct_copy( $path_to_build, &$err_msg)
	{
		global $lang, $phpbb_root_path ;

		$dir_path = '' ;
		$ftp_path = '' ;

		// strip off leading ./ from phbpp root
		$root_path = ( substr($phpbb_root_path, 0, 2) == './') ? substr($phpbb_root_path, 2) : $phpbb_root_path ;

		// loop through the path structure and create dirs as needed
		$splitarray = explode('/', $path_to_build) ;
		for ($idir=0; $idir<count($splitarray)-1; $idir++)
		{
			$prev_path = $ftp_path ;
			$ftp_path = trim($splitarray[$idir]) ;
			$dir_path .= $ftp_path ;

			// the directory doesn't exist, let's make it
			if (!file_exists($root_path . $dir_path))
			{
				// if we made a dir the previous loop, then cd into it now
				if ($prev_path != '')
				{
					// if we can't chdir, try to get back to phpbb_root before escaping
					if (!$this->ftp_chdir( $prev_path))
					{
						$err_msg = 'ftp_mkdir_struct_copy[1]<br /><br />' ;
						$err_msg .= sprintf( $lang['EM_modio_mkdir_chdir'], $prev_path, $this->ftp_pwd()) ;
						$this->ftp_cdup_home( $num_return_cdup) ;
						return false ;
					}
					$num_return_cdup++ ;
				}

				// make the directory; return error if failed
				if (!$this->ftp_mkdir( $ftp_path))
				{
					$err_msg = 'ftp_mkdir_struct_copy[2]<br /><br />' ;
					$err_msg .= sprintf( $lang['EM_modio_mkdir_mkdir'], $ftp_path, $this->ftp_pwd());
					$this->ftp_cdup_home( $num_return_cdup) ;
					return false ;
				}

				$dir_path .= '/' ;
			}

			// directory already exists no need to make, but probably need to cd into a dir created last loop
			else
			{
				// cd into dir we made during last pass
				if ($prev_path != '')
				{
					$this->ftp_chdir( $prev_path) ;
					$num_return_cdup++ ;
				}
				$dir_path .= '/' ;
			}
		}


		// return us to phpbb root
		if (!$this->ftp_cdup_home( $num_return_cdup))
		{
			$return_path = '' ;
			for ($i=0; $i<$num_return_cdup; $i++)
			{
				$return_path .= '../' ;
			}
			$err_msg = 'ftp_mkdir_struct_copy[3]<br /><br />' ;
			$err_msg .= sprintf( $lang['EM_modio_mkdir_chdir'], $return_path, $this->ftp_pwd());
			return false ;
		}

		return true ;
	}
}

?>