<?php
/***************************************************************************
 *                            admin_ip_tracking.php
 *                            ---------------------
 *   Version              : 1.0.5
 *   Email                : austin_inc@hotmail.com
 *	 Site				  : phpbb-amod.vcm/
 *	 Copyright			  : (c) aUsTiN-Inc
 *
 ***************************************************************************/
 
define('IN_PHPBB', 1);
	
if( !empty($setmodules) )
{
	$module['Ip Tracking']['Configuration'] 	= append_sid("admin_ip_tracking.$phpEx?mode=config");
	$module['Ip Tracking']['Ip: Logs']				= append_sid("admin_ip_tracking.$phpEx?mode=logs&update=next&start=0");
	$module['Ip Tracking']['Ip: Admin Hits']	= append_sid("admin_ip_tracking.$phpEx?mode=admin");
	$module['Ip Tracking']['Ip: Multi Users']	= append_sid("admin_ip_tracking.$phpEx?mode=multi");
	$module['Ip Tracking']['Ip: Search'] 			= append_sid("admin_ip_tracking.$phpEx?mode=search");	
	return;
}

$phpbb_root_path 	= '../';
require($phpbb_root_path . 'extension.inc');
require('pagestart.' . $phpEx);

	if( isset($_POST['mode']) || isset($_GET['mode']) )
		{
	$mode = ( isset($_POST['mode']) ) ? $_POST['mode'] : $_GET['mode'];
		}
	else if( isset($_POST['config']) )
		{
	$mode = "config";
		}
	else if( isset($_POST['logs']) )
		{
	$mode = "logs";
		}
	else if( isset($_POST['admin']) )
		{
	$mode = "admin";		
		}
	else if( isset($_POST['multi']) )
		{
	$mode = "multi";
		}
	else if( isset($_POST['search']) )
		{
	$mode = "search";
		}						
	else
		{
	$mode = "";
		}
		
	$update = $_POST['update'];
	$start 	= ( isset($_GET['start']) ) ? intval($_GET['start']) : 0;		
	$limit 	= "50";
		
	if($mode == "search")
		{
		if($update == "search_this")
			{
	echo "<table width='100%' border='0' class='forumline' cellspacing='2' align='center' valign='middle'>";
	echo "	<tr>";
    echo "		<th class='thHead' colspan='2'>";
	echo "			IP Tracking Admin: Search Results";
	echo "		</th>";
	echo "	</tr>";				
	echo "</table>"; 
	echo "<br><br>";
	$query 		= $_POST['query'];
	$wildcard 	= $_POST['wildcard'];
	$type 		= $_POST['select_search'];
	
	if($wildcard == "1")
		{
	$search_query = $type ." LIKE '%". $query ."%'";
		}
	elseif($wildcard == "2")
		{
	$search_query = $type ." = '". $query ."'";
		}
	else
		{
	$search_query = $type ." LIKE '%". $query ."%'";		
		} 

	echo "<table width='100%' border='0' class='forumline' cellspacing='1' align='center' valign='middle'>";							
	echo "	<tr>"; 
	echo "		<td align='left' valign='middle' width='20%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				Username";
	echo "			</span>";
	echo "		</td>";
	echo "		<td align='left' valign='middle' width='20%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				IP";
	echo "			</span>";
	echo "		</td>";
	echo "		<td align='left' valign='middle' width='20%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				Page";
	echo "			</span>";
	echo "		</td>";
	echo "		<td align='left' valign='middle' width='20%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				Time";
	echo "			</span>";
	echo "		</td>";
	echo "		<td align='left' valign='middle' width='20%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				Referer";
	echo "			</span>";
	echo "		</td>";				
	echo "	</tr>";
	
	$q1 = "SELECT *
		   FROM ". $table_prefix ."ip_tracking
		   WHERE $search_query";
	$r1			= $db -> sql_query($q1) or die("q1: Error Retrieving Search Data.".mysql_error());
	while($row1	= $db -> sql_fetchrow($r1))
		{
	$view_ip			= $row1['ip'];
	$username			= $row1['username'];
	$view_page 			= $row1['located'];
	$view_time			= $row1['time'];
	$referrer			= $row1['referer'];
	$view_time_human	= create_date($board_config['default_dateformat'], $view_time, $board_config['board_timezone']);
	$ban_user 			= append_sid("admin_ip_tracking.$phpEx?mode=search");
	
	echo "<form name='do_ban' method='post' action='$ban_user'>";			
	echo "	<tr>"; 
	echo "		<td align='left' valign='middle' width='20%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				$username";
	echo "			</span>";
	echo "		</td>";			
	echo "		<td align='left' valign='middle' width='20%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				$view_ip";
	echo "			</span>";
	echo "		</td>";	
	echo "		<td align='left' valign='middle' width='20%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				$view_page";
	echo "			</span>";
	echo "		</td>";
	echo "		<td align='left' valign='middle' width='20%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				$view_time_human";
	echo "			</span>";
	echo "		</td>";
	echo "		<td align='left' valign='middle' width='20%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				$referrer";
	echo "			</span>";
	echo "		</td>";				
	echo "	</tr>";
	echo "</form>";							
				}
	echo "</table>";
			}			
		else
			{
	echo "<table width='100%' border='0' class='forumline' cellspacing='2' align='center' valign='middle'>";
	echo "	<tr>";
    echo "		<th class='thHead' colspan='2'>";
	echo "			IP Tracking Admin: Search Logs";
	echo "		</th>";
	echo "	</tr>";				
	echo "</table>"; 
	echo "<br><br>";
	
	$search_db = append_sid("admin_ip_tracking.$phpEx?mode=search");		
	echo "<form name='do_search' method='post' action='$search_db'>";	
	echo "<table width='100%' border='0' class='forumline' cellspacing='1' align='center' valign='middle'>";			
	echo "	<tr>"; 
	echo "		<td align='left' valign='middle' width='50%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				Select Search Type:";
	echo "			</span>";
	echo "		</td>";
	echo "		<td align='center' valign='middle' width='50%' class='row2'>";
	echo "			<select name='select_search'>";				
	echo "				<option value='ip'>Ip</option>";		
	echo "				<option value='located'>Location</option>";		
	echo "				<option value='referer'>Referer</option>";
	echo "				<option value='time'>Time</option>";	
	echo "				<option value='username'>Username</option>";				
	echo "			</select>";		
	echo "		</td>";
	echo "	</tr>";
	echo "	<tr>"; 
	echo "		<td align='left' valign='middle' width='50%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				Search Query:";
	echo "			</span>";
	echo "		</td>";
	echo "		<td align='center' valign='middle' width='50%' class='row2'>";
	echo "			<input type='text' name='query' value='' size='20'>";						
	echo "		</td>";
	echo "	</tr>";
	echo "	<tr>"; 
	echo "		<td align='left' valign='middle' width='50%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				Use Wildcard?:";
	echo "			</span>";
	echo "		</td>";
	echo "		<td align='center' valign='middle' width='50%' class='row2'>";	
	echo "			<input type='radio' name='wildcard' value='1'>&nbsp;Yes";
	echo "				&nbsp;&nbsp;&nbsp;";
	echo "			<input type='radio' name='wildcard' value='2'>&nbsp;No";								
	echo "		</td>";
	echo "	</tr>";						
	echo "</table>";
	echo "<br>";
	echo "<table width='100%' border='0' class='forumline' cellspacing='1' align='center' valign='middle'>";			
	echo "	<tr>"; 
	echo "		<td align='center' valign='middle' width='100%' class='row2'>";
	echo "			<input type='hidden' name='update' value='search_this'>";	
	echo "			<input type='submit' class='mainoption' value=' Search ' onchange='document.do_search.submit()'>";
	echo "		</td>";
	echo "	</tr>";	
	echo "</table>";
	echo "</form>";
			}
		}		
	elseif($mode == "config")
		{
		if($update == "delete_all_logs")
			{
	echo "<table width='100%' border='0' class='forumline' cellspacing='2' align='center' valign='middle'>";
	echo "	<tr>";
    echo "		<th class='thHead' colspan='2'>";
	echo "			IP Tracking Admin: Complete Log Deletion";
	echo "		</th>";
	echo "	</tr>";				
	echo "</table>"; 
	echo "<br><br>";

	$q1 = "TRUNCATE ". $table_prefix ."ip_tracking";
	$r1 =  $db -> sql_query($q1);
		
	message_die(GENERAL_MESSAGE, "All IP Logs Were Deleted.", 'Success');					
			}
		elseif($update == "delete_guest_logs")
			{
	echo "<table width='100%' border='0' class='forumline' cellspacing='2' align='center' valign='middle'>";
	echo "	<tr>";
    echo "		<th class='thHead' colspan='2'>";
	echo "			IP Tracking Admin: Guest Log Deletion";
	echo "		</th>";
	echo "	</tr>";				
	echo "</table>"; 
	echo "<br><br>";

	$q1 = "DELETE FROM ". $table_prefix ."ip_tracking
		   WHERE username = 'Anonymous'";
	$r1 =  $db -> sql_query($q1);
		
	message_die(GENERAL_MESSAGE, "All Guest Logs Were Deleted.", 'Success');			
			}
		elseif($update == "save_new_config")
			{
		$new_max = $_POST['delete_after'];
			if(strlen($new_max) > 2)
				{
	echo "<table width='100%' border='0' class='forumline' cellspacing='2' align='center' valign='middle'>";
	echo "	<tr>";
    echo "		<th class='thHead' colspan='2'>";
	echo "			IP Tracking Admin: Save Configuration";
	echo "		</th>";
	echo "	</tr>";				
	echo "</table>"; 
	echo "<br><br>";
	
	$q1 = "UPDATE ". $table_prefix ."ip_tracking_config
		   SET max = '". $new_max ."'";
	$r1 =  $db -> sql_query($q1);
		
	message_die(GENERAL_MESSAGE, "Your New Config Setting Is Saved.", 'Success');		
				}
			else
				{
	message_die(GENERAL_ERROR, "The Number You Specified Was To Small, Or You Did Not Specify One.", 'Error');						
				}			
			}
		else
			{		
	echo "<table width='100%' border='0' class='forumline' cellspacing='2' align='center' valign='middle'>";
	echo "	<tr>";
    echo "		<th class='thHead' colspan='2'>";
	echo "			IP Tracking Admin: Configuration";
	echo "		</th>";
	echo "	</tr>";				
	echo "</table>"; 
	echo "<br><br>";
		
	$q1 = "SELECT max
		   FROM ". $table_prefix ."ip_tracking_config";
	$r1 		= $db -> sql_query($q1);
	$row1 		= $db -> sql_fetchrow($r1);
	$max_ips 	= $row1['max'];
			
	$q1 = "SELECT count(ip)
		   FROM ". $table_prefix ."ip_tracking";
	$r1 		= $db -> sql_query($q1);
	$row1 		= $db -> sql_fetchrow($r1);
	$total_ips 	= $row1['count(ip)'];
	
	$q1 = "SELECT count(ip)
		   FROM ". $table_prefix ."ip_tracking
		   WHERE username = 'Anonymous'";
	$r1 			= $db -> sql_query($q1);
	$row1 			= $db -> sql_fetchrow($r1);
	$total_guests 	= $row1['count(ip)'];	
				
	echo "<table width='100%' border='0' class='forumline' cellspacing='1' align='center' valign='middle'>";
	$save_config = append_sid("admin_ip_tracking.$phpEx?mode=config");		
	echo "<form name='save_max' method='post' action='$save_config'>";	
	echo "	<tr>"; 
	echo "		<td align='center' valign='middle' width='33%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				Max IP's To Store Before Dumping:";
	echo "			</span>";
	echo "		</td>";
	echo "		<td align='center' valign='middle' width='33%' class='row2'>";
	echo "			<input type='text' size='12' class='liteoption' name='delete_after' value='$max_ips'>";
	echo "		</td>";
	echo "		<td align='center' valign='middle' width='33%' class='row2'>";
	echo "			<input type='hidden' name='update' value='save_new_config'>";	
	echo "			<input type='submit' class='mainoption' value=' Save ' onchange='document.save_max.submit()'>";
	echo "		</td>";	
	echo "	</tr>";
	echo "</form>";      	   
	$delete_logs = append_sid("admin_ip_tracking.$phpEx?mode=config");		
	echo "<form name='del_log' method='post' action='$delete_logs'>";	
	echo "	<tr>"; 
	echo "		<td align='center' valign='middle' width='33%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				Delete All IP Logs?";
	echo "			</span>";
	echo "		</td>";
	echo "		<td align='center' valign='middle' width='33%' class='row2'>";
	echo "			$total_ips IP Entries";
	echo "		</td>";
	echo "		<td align='center' valign='middle' width='33%' class='row2'>";
	echo "			<input type='hidden' name='update' value='delete_all_logs'>";
	echo "			<input type='submit' class='mainoption' value=' Delete ' onchange='document.del_log.submit()'>";
	echo "		</td>";	
	echo "	</tr>";
	echo "</form>"; 
	$delete_guests = append_sid("admin_ip_tracking.$phpEx?mode=config");		
	echo "<form name='del_guests' method='post' action='$delete_guests'>";	
	echo "	<tr>"; 
	echo "		<td align='center' valign='middle' width='33%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				Delete Just Guests?";
	echo "			</span>";
	echo "		</td>";
	echo "		<td align='center' valign='middle' width='33%' class='row2'>";
	echo "			$total_guests IP Entries";
	echo "		</td>";
	echo "		<td align='center' valign='middle' width='33%' class='row2'>";
	echo "			<input type='hidden' name='update' value='delete_guest_logs'>";
	echo "			<input type='submit' class='mainoption' value=' Delete ' onchange='document.del_guests.submit()'>";
	echo "		</td>";	
	echo "	</tr>";
	echo "</form>"; 		
	echo "</table>";
			}	   		
		}
	elseif($mode == "logs")		
		{
	if($update == "view")
		{
	$who = $_GET['who'];
	
	echo "<table width='100%' border='0' class='forumline' cellspacing='2' align='center' valign='middle'>";
	echo "	<tr>";
    echo "		<th class='thHead' colspan='2'>";
	echo "			IP Tracking Admin: $who's Page Views";
	echo "		</th>";
	echo "	</tr>";				
	echo "</table>"; 
	echo "<br><br>";

	echo "<table width='100%' border='0' class='forumline' cellspacing='1' align='center' valign='middle'>";		
	echo "	<tr>"; 
	echo "		<td align='center' valign='middle' width='25%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				IP";
	echo "			</span>";
	echo "		</td>";
	echo "		<td align='center' valign='middle' width='25%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				Page Viewed";
	echo "			</span>";
	echo "		</td>";
	echo "		<td align='center' valign='middle' width='25%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				When";
	echo "			</span>";
	echo "		</td>";
	echo "		<td align='center' valign='middle' width='25%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				Referrer";
	echo "			</span>";
	echo "		</td>";				
	echo "	</tr>";
				
	$q1 = "SELECT *
		   FROM ". $table_prefix ."ip_tracking
		   WHERE username = '". $who ."'
		   ORDER BY time DESC";
	$r1	= $db -> sql_query($q1) or die("q1: Error Retrieving Ip Data.".mysql_error());
	while($row1	= $db -> sql_fetchrow($r1))
		{
	$view_ip			= $row1['ip'];
	$view_page 			= str_replace("/", "", $row1['located']);
	$view_page			= explode("&sid", $view_page);
	$view_page			= $view_page[0];
	$view_page			= "<a href='". $phpbb_root_path . $view_page ."' target='_blank'>". $view_page ."</a>";
	$view_time			= $row1['time'];
	$referrer			= $row1['referer'];
	$view_time_human	= create_date($board_config['default_dateformat'], $view_time, $board_config['board_timezone']);	
			
	echo "	<tr>"; 
	echo "		<td align='left' valign='middle' width='25%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				&nbsp;<a href='http://ws.arin.net/cgi-bin/whois.pl?queryinput=$view_ip' target='_blank'>$view_ip</a>";	
	echo "			</span>";
	echo "		</td>";	
	echo "		<td align='left' valign='middle' width='25%' class='row2'>";
	echo "			&nbsp;$view_page";
	echo "		</td>";		
	echo "		<td align='center' valign='middle' width='25%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				$view_time_human";
	echo "			</span>";
	echo "		</td>";
	echo "		<td align='center' valign='middle' width='25%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				<a href='". $referrer ."' target='_blank' class='mainmenu'>". $referrer ."</a>";
	echo "			</span>";
	echo "		</td>";						
	echo "	</tr>";		
			}
	echo "</table>";			
		}
	else
		{			
	echo "<table width='100%' border='0' class='forumline' cellspacing='2' align='center' valign='middle'>";
	echo "	<tr>";
    echo "		<th class='thHead' colspan='2'>";
	echo "			IP Tracking Admin: IP Logs";
	echo "		</th>";
	echo "	</tr>";				
	echo "</table>"; 
	echo "<br><br>";
	
	$sql = "SELECT COUNT(ip) AS total
			FROM ". $table_prefix ."ip_tracking
			GROUP BY username";

	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Error Getting IP Count.', '', __LINE__, __FILE__, $sql);
	}

	if ( $total = $db->sql_numrows($result) )
	{
		$total_ips = $total;

		$pagination = generate_pagination("admin_ip_tracking.$phpEx?mode=logs", $total_ips, $limit, $start). '&nbsp;';
	}
else
	{
	$pagination = '&nbsp;';
	$total_ips = $limit;
	}

	$page_number = sprintf($lang['Page_of'], ( floor( $start / $limit ) + 1 ), ceil( $total_ips / $limit ));

	
	echo "<table width='100%' border='0' class='forumline' cellspacing='1' align='center' valign='middle'>";	
	echo "	<tr>"; 
	echo "		<td align='center' valign='middle' width='50%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				$page_number";
	echo "			</span>";
	echo "		</td>";
	echo "		<td align='center' valign='middle' width='50%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				$pagination";
	echo "			</span>";
	echo "		</td>";
	echo "	</tr>";
	echo "</table>";
	echo "<br>";
	echo "<table width='100%' border='0' class='forumline' cellspacing='1' align='center' valign='middle'>";		
	echo "	<tr>"; 
	echo "		<td align='center' valign='middle' width='25%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				IP";
	echo "			</span>";
	echo "		</td>";
	echo "		<td align='center' valign='middle' width='25%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				User (Hits)";
	echo "			</span>";
	echo "		</td>";
	echo "		<td align='center' valign='middle' width='25%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				Page Viewed";
	echo "			</span>";
	echo "		</td>";
	echo "		<td align='center' valign='middle' width='25%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				Last Visit";
	echo "			</span>";
	echo "		</td>";			
	echo "	</tr>";
				
	$q1 = "SELECT *, MAX(time) AS newest
		   FROM ". $table_prefix ."ip_tracking
		   GROUP BY username
		   ORDER BY time DESC
		   LIMIT $start, $limit";
	$r1	= $db -> sql_query($q1) or die("q1: Error Retrieving Ip Data.".mysql_error());
	while($row1	= $db -> sql_fetchrow($r1))
		{
	$view_ip			= $row1['ip'];
	$view_name 			= $row1['username'];
	$view_page 			= $row1['located'];
	$view_time			= $row1['newest'];
	$view_time_human	= create_date($board_config['default_dateformat'], $view_time, $board_config['board_timezone']);	

	$link = append_sid("admin_ip_tracking.$phpEx?mode=logs&who=$view_name");
				
	$q2 = "SELECT user_id
		   FROM ". $table_prefix ."users
		   WHERE username = '". $view_name ."'";
	$r2 			= $db -> sql_query($q2);
	$row2 			= $db -> sql_fetchrow($r2);
	$view_id 		= $row2['user_id'];
	
	$q3 = "SELECT COUNT(username) AS hits
		   FROM ". $table_prefix ."ip_tracking
		   WHERE username = '". $view_name ."'";	
	$r3				= $db -> sql_query($q3);
	$row3 			= $db -> sql_fetchrow($r3);
	$hits	 		= $row3['hits'];
			
	echo "	<tr>"; 
	echo "		<td align='left' valign='middle' width='25%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				&nbsp;<a href='http://ws.arin.net/cgi-bin/whois.pl?queryinput=". $view_ip ."' target='_blank'>$view_ip</a>";	
	echo "			</span>";
	echo "		</td>";
	echo "		<td align='left' valign='middle' width='25%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				&nbsp;<a href='". $phpbb_root_path ."profile.php?mode=viewprofile&u=". $view_id ."' target='_blank'>$view_name</a> ($hits)";	
	echo "			</span>";
	echo "		</td>";
	echo "<form name='view_person' method='post' action='$link'>";	
	echo "		<td align='center' valign='middle' width='25%' class='row2'>";
	echo "			<input type='hidden' name='update' value='view'>";
	echo "			<input type='submit' class='mainoption' value=' View Hits' onchange='document.view_person.submit()'>";
	echo "		</td>";
	echo "</form>";		
	echo "		<td align='center' valign='middle' width='25%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				$view_time_human";
	echo "			</span>";
	echo "		</td>";					
	echo "	</tr>";		
			}
	echo "</table>";
			}			
		}
	elseif($mode == "admin")
		{
	echo "<table width='100%' border='0' class='forumline' cellspacing='2' align='center' valign='middle'>";
	echo "	<tr>";
    echo "		<th class='thHead' colspan='2'>";
	echo "			IP Tracking Admin: Admin Page Hits";
	echo "		</th>";
	echo "	</tr>";				
	echo "</table>"; 
	echo "<br><br>";
	echo "<table width='100%' border='0' class='forumline' cellspacing='1' align='center' valign='middle'>";	
	echo "	<tr>"; 
	echo "		<td align='center' valign='middle' width='25%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				IP";
	echo "			</span>";
	echo "		</td>";
	echo "		<td align='center' valign='middle' width='25%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				Username";
	echo "			</span>";
	echo "		</td>";
	echo "		<td align='center' valign='middle' width='25%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				Page Viewed";
	echo "			</span>";
	echo "		</td>";
	echo "		<td align='center' valign='middle' width='25%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				When";
	echo "			</span>";
	echo "		</td>";			
	echo "	</tr>";
	
	$q1 = "SELECT *
		   FROM ". $table_prefix ."ip_tracking
		   WHERE located LIKE '%admin%'
		   ORDER BY time DESC		   
		   LIMIT $start, $limit";
	$r1	= $db -> sql_query($q1);
	while($row1	= $db -> sql_fetchrow($r1))
		{
	$admin_view_ip 			= $row1['ip'];
	$admin_view_name 		= $row1['username'];
	$admin_view_page 		= str_replace("/admin", "admin", $row1['located']);
	$admin_view_time		= $row1['time'];
	$admin_view_time_human	= create_date($board_config['default_dateformat'], $admin_view_time, $board_config['board_timezone']);	
	
	$max = "25";
	
	if(strlen($admin_view_page) > $max)
		{
	$admin_view_page_short = substr($admin_view_page, 0, ($max - 3)) ."...";
		}
				
	$q2 = "SELECT user_id
		   FROM ". $table_prefix ."users
		   WHERE username = '". $admin_view_name ."'";
	$r2 			= $db -> sql_query($q2);
	$row2 			= $db -> sql_fetchrow($r2);
	$admin_view_id 	= $row2['user_id'];
		
	echo "	<tr>"; 
	echo "		<td align='center' valign='middle' width='25%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				<a href='http://ws.arin.net/cgi-bin/whois.pl?queryinput=$admin_view_ip' target='_blank'>$admin_view_ip</a>";
	echo "			</span>";
	echo "		</td>";
	echo "		<td align='center' valign='middle' width='25%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				<a href='". $phpbb_root_path ."profile.php?mode=viewprofile&u=$admin_view_id' target='_blank'>$admin_view_name</a>";
	echo "			</span>";
	echo "		</td>";
	echo "		<td align='center' valign='middle' width='25%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				<a href='". $phpbb_root_path ."$admin_view_page' target='_blank'>$admin_view_page_short</a>";
	echo "			</span>";
	echo "		</td>";
	echo "		<td align='center' valign='middle' width='25%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				$admin_view_time_human";
	echo "			</span>";
	echo "		</td>";		
			
	echo "	</tr>";		
			}
	echo "</table>";
	
	$q = "SELECT COUNT(*) AS total
		  FROM ". $table_prefix ."ip_tracking
		  WHERE located LIKE '%admin%'
		  GROUP BY time";

	if (!($r = $db->sql_query($q)))
		{
	message_die(GENERAL_ERROR, 'Error Getting IP Count.', '', __LINE__, __FILE__, $q);
		}
		
	$total = $db->sql_numrows($r);
	if($total)
		{
	$total_ips = $total;
	$pagination = generate_pagination("admin_ip_tracking.$phpEx?mode=admin", $total_ips, $limit, $start). '&nbsp;';
		}
	else
		{
	$pagination = '&nbsp;';
	$total_ips = $limit;
		}

	$page_number = sprintf($lang['Page_of'], ( floor( $start / $limit ) + 1 ), ceil( $total_ips / $limit ));

	
	echo "<table width='100%' border='0' class='forumline' cellspacing='1' align='center' valign='middle'>";	
	echo "	<tr>"; 
	echo "		<td align='center' valign='middle' width='50%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				$page_number";
	echo "			</span>";
	echo "		</td>";
	echo "		<td align='center' valign='middle' width='50%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				$pagination";
	echo "			</span>";
	echo "		</td>";
	echo "	</tr>";
	echo "</table>";	
		}
	elseif($mode == "multi")
		{
	echo "<table width='100%' border='0' class='forumline' cellspacing='2' align='center' valign='middle'>";
	echo "	<tr>";
    echo "		<th class='thHead' colspan='2'>";
	echo "			IP Tracking Admin: Multiple IP Users";
	echo "		</th>";
	echo "	</tr>";				
	echo "</table>"; 
	echo "<br><br>";
		
	echo "<table width='100%' border='0' class='forumline' cellspacing='1' align='center' valign='middle'>";	
	echo "	<tr>"; 
	echo "		<td align='center' valign='middle' width='25%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				IP";
	echo "			</span>";
	echo "		</td>";
	echo "		<td align='center' valign='middle' width='25%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				Usernames";
	echo "			</span>";
	echo "		</td>";			
	echo "	</tr>";
						
	$q1 = "SELECT *
		   FROM ". $table_prefix ."ip_tracking
		   GROUP BY ip
		   LIMIT $start, $limit";
	$r1			= $db -> sql_query($q1);
	while($row1	= $db -> sql_fetchrow($r1))
		{
	$view_ip	= $row1['ip'];
							
	$t = 0;
	$q3 = "SELECT username
		   FROM ". $table_prefix ."ip_tracking
		   WHERE ip = '". $view_ip ."'
		   GROUP BY username";
	$r3 		= $db -> sql_query($q3);
	while($row3	= $db -> sql_fetchrow($r3))
		{
	$t++;
		}
		
	$q2 = "SELECT username, ip
		   FROM ". $table_prefix ."ip_tracking
		   WHERE ip = '". $view_ip ."' AND
		   $t > 1
		   GROUP BY ip";
	$r2 		= $db -> sql_query($q2);
	while($row2	= $db -> sql_fetchrow($r2))
		{	
	$new_ip = $row2['ip'];
	echo "	<tr>"; 	
	echo "		<td align='center' valign='middle' width='25%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				$new_ip";
	echo "			</span>";
	echo "		</td>";
	echo "		<td align='left' valign='middle' width='25%' class='row2'>";
	echo "			<span class='genmed'>";	
		}				
	$q4 = "SELECT username, ip
		   FROM ". $table_prefix ."ip_tracking
		   WHERE ip = '". $view_ip ."' AND
		   $t > 1
		   GROUP BY username";
	$r4 		= $db -> sql_query($q4);
	while($row4	= $db -> sql_fetchrow($r4))
		{
	$total = $row4['username'];								
	echo "				[ $total ] ";
				}	
	echo "			</span>";
	echo "		</td>";			
	echo "	</tr>";							
			}
	echo "</table>";

	$q = "SELECT COUNT(ip) AS total
		  FROM ". $table_prefix ."ip_tracking
		  GROUP BY ip";

	if (!($r = $db->sql_query($q)))
		{
	message_die(GENERAL_ERROR, 'Error Getting IP Count.', '', __LINE__, __FILE__, $q);
		}
		
	$total = $db->sql_numrows($r);
	if($total)
		{
	$total_ips = $total;
	$pagination = generate_pagination("admin_ip_tracking.$phpEx?mode=multi", $total_ips, 100, $start). '&nbsp;';
		}
	else
		{
	$pagination = '&nbsp;';
	$total_ips = $limit;
		}

	$page_number = sprintf($lang['Page_of'], ( floor( $start / 100 ) + 1 ), ceil( $total_ips / 100 ));

	
	echo "<table width='100%' border='0' class='forumline' cellspacing='1' align='center' valign='middle'>";	
	echo "	<tr>"; 
	echo "		<td align='center' valign='middle' width='50%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				$page_number";
	echo "			</span>";
	echo "		</td>";
	echo "		<td align='center' valign='middle' width='50%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				$pagination";
	echo "			</span>";
	echo "		</td>";
	echo "	</tr>";
	echo "</table>";	
		}
	else
		{
	message_die(GENERAL_ERROR, "The Part Of This ACP Feature You Are Trying To View Does Not Exist.", 'Error');		
		}						
/*
If this is removed, dont bother asking for any assistance from me.
Give credit where credit is due.
*/
	echo "<table width='100%' border='0' align='center'>";
	echo "	<tr>";  
	echo "		<td align='center'>";
	echo "			<span class='gen'>";
	echo "				<a href='http://phpbb-amod.com/' target='_blank'>";
	echo "					<font class='gensmall'>";
	echo "							&copy; aUsTiN-Inc";
	echo "					</font>";
	echo "				</a>";	
	echo "			</span>";
	echo "		</td>";  				
	echo "	</tr>";
	echo "</table>"; 
		
include('page_footer_admin.' . $phpEx);
?>