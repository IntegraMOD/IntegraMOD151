<?php
//////////////////////////////////////////////////////////////////////////// 
///                           ___                 
///                          /  /\                ___     
///    ###       ###        /  /::\              /  /\    
///  ##    ####     ##     /  /:/\:\            /  /:/    
/// ##    ##   ##    ##   /  /:/~/::\          /__/::\    
/// ##    ##         ##  /__/:/ /:/\:\         \__\/\:\__ 
/// ##    ##   ##    ##  \  \:\/:/__\/  /ппп/     \  \:\/\
///  ##    ####     ##    \  \::/                  \__\::/
///    ###       ###       \  \:\                  /__/:/ 
///                         \  \:\                 \__\/  
///                          \__\/                
//////////////////////////////////////////////////////////////////////////// 

/***************************************************************************
 *                            functions_ftr.php
 *                           -------------------
 *		Version			: 1.0.2
 *		Email			: austin_inc@hotmail.com
 *		Site			: phpbb-amod.com
 *		Copyright		: й aUsTiN-Inc 2003/4 
 *
 ***************************************************************************/
 
if (!defined('IN_PHPBB'))
{
	die('Hacking attempt');
}

function GetUsersView($user) 
	{ 
		global $db, $table_prefix;
			
	$q1 = "SELECT *
           FROM ". $table_prefix ."force_read_users
		   WHERE user = '$user'"; 
	$r1 	= $db -> sql_query($q1); 
	$row1 	= $db -> sql_fetchrow($r1); 
	$user 	= $row1['user']; 
	$read	= $row1['read'];
	
	if(($user) && ($read == "1"))
		{
	$viewed = "true";
		}
	else
		{
	$viewed = "false";
		}
		
	return $viewed;
	}


function InsertReadTopic($user)
	{
		global $db, $table_prefix;
		$time = time();
	
	$q = "INSERT INTO ". $table_prefix ."force_read_users
		  VALUES
		  ('$user', '1', '$time')";
	$r = $db -> sql_query($q); 
		
	return;
	}
?>