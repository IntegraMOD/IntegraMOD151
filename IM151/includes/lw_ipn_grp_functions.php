<?php
/***************************************************************************
 *				lw_ipn_grp_functions.php
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

function lw_write_header_reminder()
{
	global $db, $userdata, $board_config;
	global $phpbb_root_path, $phpEx;
	global $lang;
	

	$lwuserreminder = '';	
	if( $userdata['user_level'] != ADMIN && $userdata['user_level'] != MOD)
	{
		$count = 0;
		$sql = "SELECT g.*, ug.* FROM " . GROUPS_TABLE . " g, " . USER_GROUP_TABLE . " ug WHERE g.group_type = " . GROUP_PAYMENT . " AND g.group_amount > 0 AND g.group_id = ug.group_id AND ug.user_id = " . $userdata['user_id'];
		if ( ($result = $db->sql_query($sql)) )
		{
			require($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_ipn_grp.' . $phpEx);
			if( ($group_info = $db->sql_fetchrow($result)) )
			{
				$lwuserreminder .= sprintf($lang['L_IPN_Subscribe_header_welcome'], $userdata['username']);
				$lwuserreminder .= "<br /><select id=\"group_id\" name=\"group_id\" class=\"droplist\" size=\"1\">";
				do
				{
					$lwuserreminder .= "<option value=\"" . $group_info['group_id'] . "\">" . $group_info['group_name'] . sprintf($lang['L_IPN_Subscribe_expire_date'], create_date($userdata['user_dateformat'], $group_info['ug_expire_date'], $userdata['user_timezone']) ) . "</option>";
				}
				while( $group_info = $db->sql_fetchrow($result) );
				$lwuserreminder .= "</select>";
				$count = 1;
			}
		}
		if($count == 0)
		{
			$lwuserreminder = sprintf($lang['LW_Welcome_Nopaid_Member'], $userdata['username']);			
		}
		if($userdata['user_rank'] > 0)
		{
			$sql = "SELECT r.rank_id, r.rank_title  
				FROM " . RANKS_TABLE . " r 
				WHERE r.rank_id = " . $userdata['user_rank'];
			if ( ($resultr = $db->sql_query($sql)) )
			{
				if( $rowr = $db->sql_fetchrow($resultr) )
				{
					if(strcmp( trim($rowr['rank_title']), trim( VIP_RANK_TITLE ) ) == 0)
					{
						$lwuserreminder = sprintf($lang['LW_YOU_ARE_VIP'], $userdata['username']);
					}
				}	
			}
		}

 	}
 	return $lwuserreminder;
}


?>
