<?php
/***************************************************************************
 *                              admin_ip_logger.php
 *                            -------------------
 *   begin                : Saturday, Febr 9, 2002
 *   copyright            : (C) 2002 Dimitri Seitz
 *   email                : dwing@weingarten-net.de
 *
 *
 *
 * uses phpBB technology (c) 2001 phpBB Group <http://www.phpbb.com/> 
 * 
***************************************************************************/ 

/* ************************************************************************** 
 * 
 *   This program is free software; you can redistribute it and/or modify 
 *   it under the terms of the GNU General Public License as published by 
 *   the Free Software Foundation; either version 2 of the License, or 
 *   (at your option) any later version. 
 * 
***************************************************************************/ 

if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['IP Logger']['Show logged IPs'] = "$file?mode=show";
	$module['IP Logger']['Delete logged IPs'] = "$file?mode=delete";
	$module['IP Logger']['Info'] = "$file?mode=info";
	$module['IP Logger']['Backup'] = "$file?mode=backup";
	$module['IP Logger']['gZip logged IPs'] = "$file?mode=gzip";
	$module['IP Logger']['Delete Backups'] = "$file?mode=d_backup";
	$module['IP Logger']['Server Test'] = "$file?mode=test";
	return;
}
define('IN_PHPBB',1);
//
// Load default header
//
$phpbb_root_path = "../";
require($phpbb_root_path . 'extension.inc');
require('pagestart.' . $phpEx);

include($phpbb_root_path . "includes/functions_ip_logger.php");
if($mode == "gzip")
{
	$filename = "data/ip";
	$filename = escapeshellcmd($filename); 
	exec("gzip $filename", $dummy, $ret_val); 
	if($ret_val == "0") 
	{
		echo "Sorry, your Server is not allowing gzipping files";
	}
	else
	{
		echo "File was zipped: You find it in the  phpBB/admin/data Folder !";
	}
	echo "<br><br>";
	include('page_footer_admin.'.$phpEx);
	die();
}	
else if($mode == "d_backup")
{
	$fh = opendir('backup'); 
	$count = 0; 
	while ($file = readdir($fh)) 
	      $count++; 
	closedir($fh); 	
	
	for ($i = 0 ; $i < count($dirdata) ; $i++) 
	{ 
		if ($dirdata[$i] != "." && $dirdata[$i] != ".." && strstr(strtolower($dirdata[$i]),".bak")) 
		{ 
       			if(@unlink($dirdata[$i]))
			{
				echo "Backup" . $dirdata[$i];
			}
		 }
	}
	echo "Backups deleted !";
	echo "<br><br>";
	include('page_footer_admin.'.$phpEx);
	die();
}

else if($mode == "test" && file_exists("data/ip"))
{
	echo "<h1>IP Logger test programm</h1><br>";
	echo "This can take up to 5 minutes !<br><br><br>";
	echo "Testing....<br>\n .<br>\n.<br>\n.<br>\n<br>";

	//
	// Test Write
	// 
	iplogger_write_test("1");

	echo "<br>\n<br>";

	//
	// Test gzip
	//
	iplogger_gzip_test("1");

	flush();
	echo "<br>\n<br><br>";

	echo "<b>Test completed</b><br><br>";
	include('page_footer_admin.'.$phpEx);
	die();
}


else if($mode == "info")
{
	echo "<h1>Enhanced IP Logger Info</h1><br><br><br>\n";
	echo "Version: 4.0 <br>\n Author: Dimitri Seitz <br>\n Special Thanks to: Brummelchen (phpBB.de User)";
	echo "<br><br>";
	include('page_footer_admin.'.$phpEx);
	die();

}
else if($mode == "backup" && file_exists("data/ip"))
{
	$date = date("Y-F-l - H:i:s");
	$new_name = md5($date);
	if(copy("data/ip","backup/" . $new_name . ".bak"))
	{
		echo "Backup succesfull<br>";
		echo "You should now download it :";
		echo "<a href=\"backup/" . $new_name . ".bak\">Download</a> (Save target as)";
		echo "<br><br>";
		include('page_footer_admin.'.$phpEx);
		die();
	}
	else
	{
		echo "Could not create backup !";
		echo "<br><br>";
		iplogger_write_test("0");
		include('page_footer_admin.'.$phpEx);
		die();
	}
}
else if($mode == "show" && file_exists("data/ip")) 
{
	echo "<h1>Showing logged IPs </h1>";
	echo "Size of IP Logger: ";
	$size = filesize("data/ip");
	echo $size;
	echo " bytes <br><br>\n";
	$IDs=@file("data/ip");
	$i = "0";
	$IDs=str_replace("<!-- break -->","<!-- Neuer Eintrage--><br><hr><br>",$IDs);
	$IDs=str_replace("\n","<br>\n",$IDs);
	foreach($IDs as $value) 
	{
		echo "<center align=\"left\">" . $value. "<center>\n";
	}
	echo "<br><br>";
	include('page_footer_admin.'.$phpEx);
	die();
}
else if($mode == "delete" && file_exists("data/ip")) 
{
	echo "<h1>Deleting Logged IPs</h1>";
	echo "Deleting...<br>";
	flush();
	sleep("5");
	if(unlink("data/ip"));
 	{
		echo "Logged IPs deleted";
	}
	echo "<br><br>";
	include('page_footer_admin.'.$phpEx);
	die();
}
else
{
	echo "<h1>Error</h1><br>\n No IPs are logged !<br>\n";
	iplogger_write_test("0");
	echo "<br><br>";
	include('page_footer_admin.'.$phpEx);
}


?>