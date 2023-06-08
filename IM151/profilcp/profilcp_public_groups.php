<?php
/***************************************************************************
 *                            profilcp_public_groups.php
 *                            --------------------------
 *	begin				: 08/05/2003
 *	copyright			: Ptirhiik
 *	email				: admin@rpgnet-fr.com
 *
 *	version				: 1.0.6 - 30/10/2003
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 *
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
	exit;
}
if ( !empty($setmodules) )
{
	pcp_set_sub_menu('viewprofile', 'groups', 20, __FILE__, 'profilcp_public_groups_shortcut', 'profilcp_public_groups_pagetitle' );
	return;
}

//
// template file
$template->set_filenames(array(
	'body' => 'profilcp/public_groups_body.tpl')
);

$template->assign_block_vars('full_panel', array());

// groupes
$groups = array();
$sql = "SELECT 
			g.group_id, 
			g.group_name, 
			g.group_description, 
			g.group_type 
		FROM 
			" . USER_GROUP_TABLE . " l, 
			" . GROUPS_TABLE . " g 
		WHERE l.user_pending = 0 
			AND g.group_single_user = 0 
			AND l.user_id = $view_user_id 
			AND g.group_id = l.group_id 
		ORDER BY 
			g.group_name, 
			g.group_id";
if ( !$result = $db->sql_query($sql) ) 
{
	message_die(GENERAL_ERROR, 'Could not read groups', '', __LINE__, __FILE__, $sql);	
}
while ($row = $db->sql_fetchrow($result))
{
	$groups[] = $row;
}

$template->assign_vars(array(
	'L_USERGROUPS'	=> $lang['Usergroups'],
	'L_NO_GROUPS'	=> $lang['None'],
	'TXTCLASS'		=> 'gen',
	)
);
$nb = 0;
if (count($groups) > 0)
{
	$class = false;
	for ($i=0; $i < count($groups); $i++)
	{
		$is_ok = false;

		// group hidden ?
		if ( ($groups[$i]['group_type'] != GROUP_HIDDEN) || is_admin($userdata) )
		{
			$is_ok=true;
		}
		else
		{
			$group_id = $groups[$i]['group_id'];
			$sql = "SELECT * FROM " . USER_GROUP_TABLE . "
					WHERE group_id = $group_id
						AND user_id =" .  $userdata['user_id'] . "
						AND user_pending=0";
			if ( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Couldn\'t obtain viewer group list', '', __LINE__, __FILE__, $sql);
			}
			$is_ok = ( $row = $db->sql_fetchrow($result) );
		}

		// group allowed : display
		if ($is_ok)
		{
			$nb++;
			$class = !$class;
			$u_group_name = append_sid("groupcp.$phpEx?" . POST_GROUPS_URL . '=' . $groups[$i]['group_id']);
			$l_group_name = $agcm_color->get_user_color($groups[$i]['group_id'], 0, $groups[$i]['group_name'], $groups[$i]['group_name']);
			$l_group_desc = $groups[$i]['group_description'];
			$template->assign_block_vars('groups',array(
				'CLASS'			=> ($class) ? "row1" : "row2",
				'U_GROUP_NAME'	=> $u_group_name,
				'L_GROUP_NAME'	=> $l_group_name,
				'L_GROUP_DESC'	=> $l_group_desc,
				)
			);
			$template->assign_block_vars('groups.desc',array());
		}  // end if ($is_ok)
	}  // end for ($i=0; $i < count($groups); $i++)
}  // end if (count($groups) > 0)

if ($nb == 0)
{
	$template->assign_block_vars('no_groups', array('SPAN' => 2));
}

$template->assign_vars(array(
	'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
	'S_PROFILCP_ACTION' => append_sid("profile.$phpEx"),
	)
);

// page
$template->pparse('body');

?>