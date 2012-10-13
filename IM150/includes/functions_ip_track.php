<?php
//////////////////////////////////////////////////////////////////////////// 
///                           ___                 
///                          /  /\                ___     
///    ###       ###        /  /::\              /  /\    
///  ##    ####     ##     /  /:/\:\            /  /:/    
/// ##    ##   ##    ##   /  /:/~/::\          /__/::\    
/// ##    ##         ##  /__/:/ /:/\:\         \__\/\:\__ 
/// ##    ##   ##    ##  \  \:\/:/__\/  /???/     \  \:\/\
///  ##    ####     ##    \  \::/                  \__\::/
///    ###       ###       \  \:\                  /__/:/ 
///                         \  \:\                 \__\/  
///                          \__\/                
//////////////////////////////////////////////////////////////////////////// 

/***************************************************************************
 *                            functions_ip_track.php
 *                            ----------------------
 *   Version              : 1.0.4
 *   Email                : austin_inc@hotmail.com
 *	 Site				  : austin-inc.com/
 *	 Copyright			  : (c) aUsTiN-Inc
 *
 ***************************************************************************/
 
	if(!defined('IN_PHPBB'))
		{
	die('Hacking attempt');
		}
	
	function GetIP() 
		{ 
	if 		(getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) 									$ip = getenv("HTTP_CLIENT_IP"); 
	else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) 						$ip = getenv("HTTP_X_FORWARDED_FOR"); 
	else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) 										$ip = getenv("REMOTE_ADDR"); 
	else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) 	$ip = $_SERVER['REMOTE_ADDR']; 
	else 																													$ip = "unknown"; 		
	return($ip); 
		}

	function GetPage()
		{
	$page = $REQUEST_URI;
	if(!$page) $page = $_SERVER['REQUEST_URI'];
	if(!$page) $page = $_SERVER['PHP_SELF'];
	return $page;
		}
	
/* Add IP to the database */

if((GetPage()) && (GetIP()) && ($_SERVER["HTTP_REFERER"]) && ($userdata['username']))
	{
	$q = "INSERT INTO ". $table_prefix ."ip_tracking
		  VALUES
		  ('". GetIP() ."', '". time() ."', '". GetPage() ."', '". $_SERVER["HTTP_REFERER"] ."', '". $userdata['username'] ."')";
	$r = $db -> sql_query($q); 				
	}

/* Check for max entries allowed & make sure its right */
	$to_delete	= 1000;
	$q1 = "SELECT count(*)
           FROM ". $table_prefix ."ip_tracking"; 
	$r1 			= $db -> sql_query($q1); 
	$row1 			= $db -> sql_fetchrow($r1); 
	$total_in_db 	= $row1['count(*)']; 

	$q1 = "SELECT max
           FROM ". $table_prefix ."ip_tracking_config"; 
	$r1 					= $db -> sql_query($q1); 
	$row1 					= $db -> sql_fetchrow($r1); 
	$total_allowed_in_db 	= $row1['max']; 

if($total_in_db > $total_allowed_in_db)
	{
   $q1 = "DELETE FROM ". $table_prefix ."ip_tracking
		  LIMIT $to_delete"; 
   $r1 = $db -> sql_query($q1); 
	}
?>