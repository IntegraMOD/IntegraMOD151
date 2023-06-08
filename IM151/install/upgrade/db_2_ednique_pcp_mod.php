<?php
global $db, $lang, $phpEx, $table_prefix;
//define('IN_PHPBB', true);
//$phpbb_root_path = './../../';
//include($phpbb_root_path . 'extension.inc');
//include_once($phpbb_root_path . 'common.'.$phpEx);
//include_once($phpbb_root_path . 'includes/constants.'.$phpEx);
//include_once($phpbb_root_path . 'includes/functions.'.$phpEx);
//include($phpbb_root_path . 'includes/bbcode.'.$phpEx);
//include($phpbb_root_path . 'includes/functions_bookmark.'.$phpEx);
//include($phpbb_root_path . 'includes/functions_post.'.$phpEx);


echo('<tr><th>Ednique PCP Mod SQL</th></tr><tr><td><span class="gensmall"><div style="border: 1px solid #000000; height: 90px; overflow: auto;"><ul type="circle">');

$userstable = $table_prefix.'users';
$backuptable = $table_prefix.'config_pcp_update_backup';
$configtable = $table_prefix.'config';

$sqls = array();

$sqls[] = "CREATE TABLE ".$backuptable." (
config_name varchar( 255 ) NOT NULL default '',
config_value varchar( 255 ) NOT NULL default '',
PRIMARY KEY ( config_name ) 
) TYPE = MYISAM";
$sqls[] ="INSERT INTO ".$backuptable." SELECT * FROM ".$configtable;

for( $i = 0; $i < count($sqls); $i++ )
{
	if( !$result = $db->sql_query ($sqls[$i]) )
	{
		$error = $db->sql_error();

		echo '<li>' . $sqls[$i] . '<br /> +++ <font color="#FF0000"><b>Error:</b></font> ' . $error['message'] . '</li><br />';
	}
	else
	{
		echo '<li>' . $sqls[$i] . '<br /> +++ <font color="#00AA00"><b>Successfull</b></font></li><br />';
	}
}


$configs = array
(
    'summer_time_user' => array
        (
            'newname' => user_summer_time
            ,'value' => 1
        ),

    'summer_time_user_over' => array
        (
            'newname' => user_summer_time_over
            ,'value' => 1
        ),

    'display_viewonline' => array
        (
            'newname' => user_allow_viewonline
            ,'value' => 1
        ),

    'display_viewonline_over' => array
        (
            'newname' => user_allow_viewonline_over
            ,'value' => 1
        ),

    'allow_viewemail' => array
        (
            'newname' => user_viewemail
            ,'value' => 2
        ),

    'allow_viewemail_over' => array
        (
            'newname' => user_viewemail_over
            ,'value' => 1
        ),

    'allow_viewpm' => array
        (
            'newname' => user_viewpm
            ,'value' => 1
        ),

    'allow_viewpm_over' => array
        (
            'newname' => user_viewpm_over
            ,'value' => 1
        ),

    'allow_viewwebsite' => array
        (
            'newname' => user_viewwebsite
            ,'value' => 1
        ),

    'allow_viewwebsite_over' => array
        (
            'newname' => user_viewwebsite_over
            ,'value' => 1
        ),

    'allow_viewmessengers' => array
        (
            'newname' => user_viewmessenger
            ,'value' => 2
        ),

    'allow_viewmessengers_over' => array
        (
            'newname' => user_viewmessenger_over
            ,'value' => 1
        ),

    'allow_viewreal' => array
        (
            'newname' => user_viewreal
            ,'value' => 2
        ),

    'allow_viewreal_over' => array
        (
            'newname' => user_viewreal_over
            ,'value' => 1
        ),

    'pm_notify' => array
        (
            'newname' => user_notify_pm
            ,'value' => 1
        ),

    'pm_notify_over' => array
        (
            'newname' => user_notify_pm_over
            ,'value' => 1
        ),

    'pm_popup' => array
        (
            'newname' => user_popup_pm
            ,'value' => 1
        ),

    'pm_popup_over' => array
        (
            'newname' => user_popup_pm_over
            ,'value' => 0
        ),

    'post_sig' => array
        (
            'newname' => user_attachsig
            ,'value' => 1
        ),

    'post_sig_over' => array
        (
            'newname' => user_attachsig_over
            ,'value' => 0
        ),

    'post_bm' => array
        (
            'newname' => user_setbm
            ,'value' => 0
        ),

    'post_bm_over' => array
        (
            'newname' => user_setbm_over
            ,'value' => 0
        ),

    'post_bbcode' => array
        (
            'newname' => user_allowbbcode
            ,'value' => 1
        ),

    'post_bbcode_over' => array
        (
            'newname' => user_allowbbcode_over
            ,'value' => 0
        ),

    'post_html' => array
        (
            'newname' => user_allowhtml
            ,'value' => 0
        ),

    'post_html_over' => array
        (
            'newname' => user_allowhtml_over
            ,'value' => 1
        ),

    'post_smilies' => array
        (
            'newname' => user_allowsmile
            ,'value' => 1
        ),

    'post_smilies_over' => array
        (
            'newname' => user_allowsmile_over
            ,'value' => 0
        ),

    'read_viewavatar' => array
        (
            'newname' => user_viewavatar
            ,'value' => 1
        ),

    'read_viewavatar_over' => array
        (
            'newname' => user_viewavatar_over
            ,'value' => 1
        ),

    'read_viewsig' => array
        (
            'newname' => user_viewsig
            ,'value' => 1
        ),

    'read_viewsig_over' => array
        (
            'newname' => user_viewsig_over
            ,'value' => 1
        ),

    'read_viewimg' => array
        (
            'newname' => user_viewimg
            ,'value' => 1
        ),

    'read_viewimg_over' => array
        (
            'newname' => user_viewimg_over
            ,'value' => 1
        ),

    'buddy_friend_display' => array
        (
            'newname' => user_buddy_friend_display
            ,'value' => 1
        ),

    'buddy_friend_display_over' => array
        (
            'newname' => user_buddy_friend_display_over
            ,'value' => 0
        ),

    'buddy_ignore_display' => array
        (
            'newname' => user_buddy_ignore_display
            ,'value' => 1
        ),

    'buddy_ignore_display_over' => array
        (
            'newname' => user_buddy_ignore_display_over
            ,'value' => 0
        ),

    'buddy_friend_of_display' => array
        (
            'newname' => user_buddy_friend_of_display
            ,'value' => 1
        ),

    'buddy_friend_of_display_over' => array
        (
            'newname' => user_buddy_friend_of_display_over
            ,'value' => 0
        ),

    'buddy_ignored_by_display' => array
        (
            'newname' => user_buddy_ignored_by_display
            ,'value' => 1
        ),

    'buddy_ignored_by_display_over' => array
        (
            'newname' => user_buddy_ignored_by_display_over
            ,'value' => 0
        ),

    'privmsgs_per_page' => array
        (
            'newname' => user_privmsgs_per_page
            ,'value' => 5
        ),

    'privmsgs_per_page_over' => array
        (
            'newname' => user_privmsgs_per_page_over
            ,'value' => 1
        ),

    'topics_watched_per_page' => array
        (
            'newname' => user_watched_topics_per_page
            ,'value' => 10
        ),

    'topics_watched_per_page_over' => array
        (
            'newname' => user_watched_topics_per_page_over
            ,'value' => 1
        ),
		'topics_last_per_page' => array
        (
            'newname' => user_topics_last_per_page
            ,'value' => 1
        ),

);

$sql = "SELECT * FROM ".$configtable;
if ($result = $db->sql_query($sql))
{
	while ($row = $db->sql_fetchrow($result))
	{
		if(isset($configs[$row['config_name']]))
		{
			$configs[$row['config_name']]['value'] = $row['config_value'];
		}
	}
		echo '<li>' . $sql . '<br /> +++ <font color="#00AA00"><b>Successfull</b></font></li><br />';
}
else
{
		$error = $db->sql_error();
		echo '<li>' . $sql . '<br /> +++ <font color="#FF0000"><b>Error:</b></font> ' . $error['message'] . '</li><br />';
}

while(list($oldname,$field) = @each($configs))
{
	$sql="delete from ".$configtable." where config_name = '".$oldname."'";
	if( !$result = $db->sql_query($sql) ) 
	{
		$error = $db->sql_error();
		echo '<li>' . $sql . '<br /> +++ <font color="#FF0000"><b>Error:</b></font> ' . $error['message'] . '</li><br />';
	}
	else
	{
		echo '<li>' . $sql . '<br /> +++ <font color="#00AA00"><b>Successfull</b></font></li><br />';
	}
	$sql="select * from ".$configtable." where config_name = '".$field['newname']."'";
	if(!$result = $db->sql_query($sql) ) 
	{
		$error = $db->sql_error();
		echo '<li>' . $sql . '<br /> +++ <font color="#FF0000"><b>Error:</b></font> ' . $error['message'] . '</li><br />';
	}
	else
	{
		echo '<li>' . $sql . '<br /> +++ <font color="#00AA00"><b>Successfull</b></font></li><br />';
	}
	if($db->sql_numrows($result))
	{
		$sql="Update ".$configtable." set config_value='".$field['value']."' where config_name = '".$field['newname']."'";
		if(!$result = $db->sql_query($sql) ) 
		{
			$error = $db->sql_error();
			echo '<li>' . $sql . '<br /> +++ <font color="#FF0000"><b>Error:</b></font> ' . $error['message'] . '</li><br />';
		}
		else
		{
			echo '<li>' . $sql . '<br /> +++ <font color="#00AA00"><b>Successfull</b></font></li><br />';
		}
	} 
	else 
	{
		$sql="insert into ".$configtable." (config_name, config_value) VALUES ('".$field['newname']."','".$field['value']."')";
		if(!$result = $db->sql_query($sql) ) 
		{
			$error = $db->sql_error();
			echo '<li>' . $sql . '<br /> +++ <font color="#FF0000"><b>Error:</b></font> ' . $error['message'] . '</li><br />';
		}
		else
		{
			echo '<li>' . $sql . '<br /> +++ <font color="#00AA00"><b>Successfull</b></font></li><br />';
		}
	}
}
echo '</ul></div></span></td></tr>';

?>