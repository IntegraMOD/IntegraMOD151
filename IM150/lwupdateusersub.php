<?php
/***************************************************************************
 *				lwupdateusersub.php
 *
 *	begin				: OCT/29/2004
 *	copyright			: Loewen Enterprise - Xiong Zou
 *	email				: zouxiong@loewen.com.sg
 *
 *	version				: 1.0.0.1 - OCT/29/2004
 *
 ***************************************************************************/
/***************************************************************************
## Terms of Use
##
## All of my MODifications are to use and edit/change for phpBB End Users
##
## Plese DO NOT remove any copyright/licence declaration when using the MODification
##
## I will remain as the sole developer for all my MODifications unless stated otherwise
##
##
## Distribution Terms
##
## All of my MODifications are prohibited to distribute to others without the permission from me.
##
## Plese DO NOT remove any copyright/licence declaration when using the MODification
##
## I will remain as the sole developer for all my MODifications unless stated otherwise
##
## Re-Distribution Terms
##
## If you are distributing WHOLE or PART of my MOD in your MOD Projects or Pre-modded Projects or any other means, you must:
##
## Get the formal authorization from me first.
##
## Plese DO NOT remove any copyright/licence declaration when using the MODification
##
## I will remain as the sole developer for all my MODification unless stated otherwise. Do NOT declare youself as my co-developer
##
## Re-Distribution Terms DOES NOT apply to MOD authors that developing Add-Ons to my MOD. You will be the Add-Ons' Developer/Author
##
***************************************************************************/

define('IN_PHPBB', true);
$phpbb_root_path = './';

include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

//$unhtml_specialchars_match = array('#&gt;#', '#&lt;#', '#&quot;#', '#&amp;#');
//$unhtml_specialchars_replace = array('>', '<', '"', '&');

//
// Set page ID for session management
//
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);
//
// End session management
//
if( $userdata['user_level'] != ADMIN)
{
	$message = 'Sorry, you are not admin!' . '<br /><br />' .  sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>');
	message_die(GENERAL_MESSAGE, $message);
	exit;
}

		$sql = "SELECT user_id, username, user_active, user_level, user_expire_date, user_regdate
			FROM " . USERS_TABLE;
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Error in obtaining userdata', '', __LINE__, __FILE__, $sql);
			exit;
		}
		$user_infos = array();
		if( $row = $db->sql_fetchrow($result) )
		{
			do
			{
				$user_infos[] = $row;				
			}
			while( $row = $db->sql_fetchrow($result) );
		}
		
		for($i = 0; $i < count($user_infos); $i++ )
		{
			//update every user's expiration date
			$sql = "SELECT ug.*, g.* FROM " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g " . " WHERE g.group_type = " . GROUP_PAYMENT . " AND g.group_amount > 0 AND g.group_id = ug.group_id AND ug.user_id = " . $user_infos[$i]['user_id'];
			$ug_infos = array();
			if ( ($result = $db->sql_query($sql)) )
			{
				if( ($ug_info = $db->sql_fetchrow($result)))
				{
					do
					{
						$ug_infos[] = $ug_info;				
					}
					while( $ug_info = $db->sql_fetchrow($result) );					
				}
			}

			$paygrpids = "";
			$paygrpids .= "(";
			$countflag = 0;
			for($j = 0; $j < count($ug_infos); $j++ )
			{
				if($j > 0)
				{
					$paygrpids .= " OR ";
				}
				$paygrpids .= "group_id = " . $ug_infos[$j]['group_id'];
				$countflag = 1;
			}
			$paygrpids .= ")";
			if($countflag > 0)
			{
				$sql = "UPDATE " . USER_GROUP_TABLE . " SET ug_active_date = " . time() . ", ug_expire_date = " . ($user_infos[$i]['user_expire_date'] <= 0 ? "0" : $user_infos[$i]['user_expire_date']) . " WHERE $paygrpids AND user_id = " . $user_infos[$i]['user_id'];			
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Error in updating userdata', '', __LINE__, __FILE__, $sql);
					exit;
				}
				
			}
			

		}
	$filename = basename(__FILE__);
	$message = 'Update all your member\'s expiration date successfully from ver 1.0.0.2 to ver 1.0.0.3! <br />Remember to remove ' . $filename . ' from your current system!!!' . '<br /><br />' .  sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>');
//	$message .= "<br />" . $sql;
	message_die(GENERAL_MESSAGE, $message);
	exit;

?>


