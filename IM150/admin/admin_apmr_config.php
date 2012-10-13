<?php
		                              						   			  
/***************************************************************************
 *                             admin_apmr_config.php
 *                            -----------------------
 *		Version			: 1.0.0
 *		Email			: austin_inc@hotmail.com
 *		Site			: austin-inc.com/Blend/
 *		Copyright		: � aUsTiN-Inc 2003/4 (Blend Portal System) 
 *
 ***************************************************************************/
define('IN_PHPBB', 1);
if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['APMR Admin']['Configuration'] = $file;
	return;
}

$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');

require('./pagestart.' . $phpEx);

if( isset( $HTTP_POST_VARS['mode'] ) || isset( $HTTP_GET_VARS['mode'] ) )
{
	$mode = ( isset( $HTTP_POST_VARS['mode']) ) ? $HTTP_POST_VARS['mode'] : $HTTP_GET_VARS['mode'];
}
else
{
	$mode = '';
}
	$link = append_sid("admin_apmr_config.". $phpEx);

	echo "<table width='100%' border='0' class='forumline' cellspacing='2' align='center' valign='middle'>";
	echo "	<tr>";
	echo "		<th class='thHead' colspan='2'>";
	echo "			Admin PM Redirect/Deny";
	echo "		</th>";
	echo "	</tr>";
	echo "</table>";
	echo "<br><br>";
		
if($mode == "main" || !$mode)
		{
	echo "<table border='0' align='center' valign='top' class='forumline' width='100%'>";
	echo "	<tr>";
	echo "		<td align='center' valign='top' width='100%' class='row2'>";
	echo "			<span class='genmed'>";
	echo "				Select An Admin To Change Preferences On";
	echo "			</span>";
	echo "		</td>";
	echo "	</tr>";		
	echo "</table>";
	echo "<br>";
	
	echo "<form name='change' action='$link' method='post'>";		
	echo "<table border='0' align='center' valign='top' class='forumline' width='100%'>";
	echo "	<tr>";
	echo "		<td align='center' valign='top' width='50%' class='row2'>";			
	echo "			<select name='admin_id'>";
	echo "				<option selected value=''>Choose An Id</option>";	
	$q = "SELECT *
		  FROM ". USERS_TABLE ."
		  WHERE user_level = ". ADMIN;
	$r			= $db -> sql_query($q);
	while($row 	= $db -> sql_fetchrow($r))
		{	
	$id 	= $row['user_id'];
	$name 	= $row['username'];
	echo "				<option value='". $id ."'>$name</option>";					
		}			
	echo "			</select>";
	echo "		</td>";
	echo "	</tr>";		
	echo "</table>";
	echo "<br>";
	echo "<table border='0' align='center' valign='top'>";	
	echo "	<tr>";	
	echo "		<td align='center' valign='middle' width='100%' class='row2'>";	
	echo "			<input type='hidden' name='mode' value='update_admin'>";   	     
	echo "			<input type='submit' class='mainoption' value=' Set Preferences ' onchange='document.change.submit()'>";       
	echo "		</td>";
	echo "	</tr>";					
	echo "</table>";	
	echo "</form>";
	echo "<br><br>";	
		}
		
	if($mode == "update_admin")
		{
	$admin_id	= $_POST['admin_id'];
			
		if(!$admin_id)	
			{
	message_die(GENERAL_ERROR, "No admin was specified to edit.<br><br>Click <a href=". $link .">Here</a> To Try Again.", "Error");	
			}
					
		if($admin_id)
			{			
	$q = "SELECT username
		  FROM ". USERS_TABLE ."
		  WHERE user_id = '$admin_id'";
	$r			= $db -> sql_query($q);
	$row 		= $db -> sql_fetchrow($r);	
	$username 	= $row['username'];
				
	$q = "SELECT *
		  FROM ". ADMIN_PM_TABLE ."
		  WHERE admin_id = '$admin_id'";
	$r			= $db -> sql_query($q);
	$row 		= $db -> sql_fetchrow($r);	
	$admin	 	= $row['admin_id'];
	$deny		= $row['admin_deny'];
	$redirect	= $row['admin_redirect_id'];
	
	$q = "SELECT username
		  FROM ". USERS_TABLE ."
		  WHERE user_id = '$redirect'";
	$r			= $db -> sql_query($q);
	$row 		= $db -> sql_fetchrow($r);	
	$username2 	= $row['username'];
	
	if($admin < 1)
		{
	$adminz = $admin_id;
		}
	else
		{
	$adminz = $admin;
		}
	
	if($deny == "1")
		{
	$deny_status = "Yes";
		}
	else
		{
	$deny_status = "No";
		}
		
	if($redirect > "0")
		{
	$redirect_status = "Yes";
		}
	else
		{
	$redirect_status = "No";
		}
		
	echo "<table border='0' align='center' valign='top' class='forumline' width='100%'>";	
	echo "	<tr>";	
	echo "		<td align='center' valign='middle' width='100%' class='row2'>";	
	echo "			<span class='genmed'>";
	echo "				Current Settings For $username:";
	echo "			</span>";	
	echo "		</td>";
	echo "	</tr>";					
	echo "</table>";
	echo "<table border='0' align='center' valign='top' class='forumline' width='100%'>";	
	echo "	<tr>";	
	echo "		<td align='left' valign='middle' width='50%' class='row2'>";	
	echo "			<span class='genmed'>";
	echo "				Is blocking all PM's?";
	echo "			</span>";	
	echo "		</td>";
	echo "		<td align='center' valign='middle' width='50%' class='row2'>";	
	echo "			<span class='genmed'>";
	echo "				$deny_status";
	echo "			</span>";	
	echo "		</td>";	
	echo "	</tr>";
	echo "	<tr>";	
	echo "		<td align='left' valign='middle' width='50%' class='row2'>";	
	echo "			<span class='genmed'>";
	echo "				Is redirecting all PM's?";
	echo "			</span>";	
	echo "		</td>";
	echo "		<td align='center' valign='middle' width='50%' class='row2'>";	
	echo "			<span class='genmed'>";
	echo "				$redirect_status";
	echo "			</span>";	
	echo "		</td>";	
	echo "	</tr>";
			if($redirect)
				{
	echo "	<tr>";	
	echo "		<td align='left' valign='middle' width='50%' class='row2'>";	
	echo "			<span class='genmed'>";
	echo "				Is redirecting all PM's to:";
	echo "			</span>";	
	echo "		</td>";
	echo "		<td align='center' valign='middle' width='50%' class='row2'>";	
	echo "			<span class='genmed'>";
	echo "				$username2";
	echo "			</span>";	
	echo "		</td>";	
	echo "	</tr>";
				}							
	echo "</table>";	
	echo "<br><br>";
	echo "<form name='save' action='$link' method='post'>";	
	echo "<table border='0' align='center' valign='top' class='forumline' width='100%'>";	
	echo "	<tr>";	
	echo "		<td align='center' valign='middle' width='100%' class='row2'>";	
	echo "			<span class='genmed'>";
	echo "				New Settings For $username:";
	echo "			</span>";	
	echo "		</td>";
	echo "	</tr>";					
	echo "</table>";
	echo "<table border='0' align='center' valign='top' class='forumline' width='100%'>";	
	echo "	<tr>";	
	echo "		<td align='left' valign='middle' width='50%' class='row2'>";	
	echo "			<span class='genmed'>";
	echo "				Is blocking all PM's?";
	echo "			</span>";	
	echo "		</td>";
	echo "		<td align='center' valign='middle' width='50%' class='row2'>";	
	echo "			<span class='genmed'>";
	echo "				<input type='radio' name='blocking' value='1'>&nbsp;Yes&nbsp;&nbsp;&nbsp;<input type='radio' name='blocking' value='0'>&nbsp;No";
	echo "			</span>";	
	echo "		</td>";	
	echo "	</tr>";
	echo "	<tr>";	
	echo "		<td align='left' valign='middle' width='50%' class='row2'>";	
	echo "			<span class='genmed'>";
	echo "				Is redirecting all PM's?";
	echo "			</span>";	
	echo "		</td>";
	echo "		<td align='center' valign='middle' width='50%' class='row2'>";	
	echo "			<span class='genmed'>";
	echo "				<input type='radio' name='redirecting' value='1'>&nbsp;Yes&nbsp;&nbsp;&nbsp;<input type='radio' name='redirecting' value='0'>&nbsp;No";
	echo "			</span>";	
	echo "		</td>";	
	echo "	</tr>";
	echo "	<tr>";	
	echo "		<td align='left' valign='middle' width='50%' class='row2'>";	
	echo "			<span class='genmed'>";
	echo "				If Yes, redirecting all PM's to what User?";
	echo "			</span>";	
	echo "		</td>";
	echo "		<td align='center' valign='middle' width='50%' class='row2'>";	
	echo "			<select name='redirect_id'>";
	echo "				<option selected value=''>Choose A User</option>";	
	$q = "SELECT *
		  FROM ". USERS_TABLE ."
		  WHERE user_id <> '-1'";
	$r			= $db -> sql_query($q);
	while($row 	= $db -> sql_fetchrow($r))
		{	
	$id 	= $row['user_id'];
	$name 	= $row['username'];
	echo "				<option value='". $id ."'>$name</option>";					
		}			
	echo "			</select>";	
	echo "		</td>";	
	echo "	</tr>";							
	echo "</table>";
	echo "<br>";
	echo "<table border='0' align='center' valign='top'>";	
	echo "	<tr>";	
	echo "		<td align='center' valign='middle' width='100%' class='row2'>";	
	echo "			<input type='hidden' name='mode' value='save_admin'>";
	echo "			<input type='hidden' name='admins_id' value='". $adminz ."'>";	   	     
	echo "			<input type='submit' class='mainoption' value=' Save Preferences ' onchange='document.save.submit()'>";       
	echo "		</td>";
	echo "	</tr>";					
	echo "</table>";	
	echo "</form>";
	echo "<br><br>";			
			}
		}
		
	if($mode == "save_admin")
		{
	$who 	= $_POST['admins_id'];
	$who2 	= $_POST['redirect_id'];	
	$what 	= $_POST['blocking'];
	$what2 	= $_POST['redirecting'];
						
	$q = "SELECT *
		  FROM ". ADMIN_PM_TABLE ."
		  WHERE admin_id = '$who'";
	$r			= $db -> sql_query($q);
	$row 		= $db -> sql_fetchrow($r);	
	$admin	 	= $row['admin_id'];
	$deny		= $row['admin_deny'];
	$redirect	= $row['admin_redirect_id'];
			
			if(($admin) && ($what2) && ($who2))
				{
	# Set up redirection on
	$q = "UPDATE ". ADMIN_PM_TABLE ."
		  SET admin_deny = '0', admin_redirect_id = '". $who2 ."'
		  WHERE admin_id = '$admin'";
	$r = $db -> sql_query($q);				
				}
				
			if(($admin) && ($what2 == 0))
				{
	# Set up redirection off
	$q = "UPDATE ". ADMIN_PM_TABLE ."
		  SET admin_deny = '0', admin_redirect_id = '0'
		  WHERE admin_id = '$admin'";
	$r = $db -> sql_query($q);	
				}				
				
			if(($admin) && ($what == "0" || $what == "1"))
				{
	# Set up blocking
	$q = "UPDATE ". ADMIN_PM_TABLE ."
		  SET admin_deny = '". $what ."', admin_redirect_id = '0'
		  WHERE admin_id = '$admin'";
	$r = $db -> sql_query($q);	
				}
				
			if((!$admin) && ($what == "0" || $what == "1"))
				{
	# Insert blocking
	$q = "INSERT INTO ". ADMIN_PM_TABLE ."
		  VALUES ('". $who ."', '0', '". $what ."')";
	$r = $db -> sql_query($q);				
				}
				
			if((!$admin) && ($what2) && ($who2))
				{
	# Insert redirecting 
	$q = "INSERT INTO ". ADMIN_PM_TABLE ."
		  VALUES ('". $who ."', '". $who2 ."', '0')";
	$r = $db -> sql_query($q);				
				}	
	
			message_die(GENERAL_MESSAGE, "Admin Data Saved.", "Information");
		}
			
include('page_footer_admin.' . $phpEx);
?>