<?php
/***************************************************************************
 *                           network_parseusers.php
 *                            -------------------
 *   begin                : Wednesday, Nov 6, 2002
 *   version              : 1.1.0
 *   date                 : 2003/12/23 23:27
 ***************************************************************************/

if ( !defined('IN_PHPBB') || !defined('IN_PRILLIAN') )
{
	die('Hacking attempt');
}

$sql = 'SELECT * FROM ' . IM_SITES_TABLE;
if( !$result = $db->sql_query($sql) )
{
	$template->assign_block_vars('switch_network_boxes', array(
		'L_NETWORK_TITLE' => $lang['Network_Users_online']
	));
	$template->set_filenames(array(
		'parse' => 'network_parse_body.tpl')
	);
	$template->assign_block_vars('switch_network_error', array(
		'ERROR_MSG' => 'Could not obtain Network information<br />'
	));
	$template->assign_var_from_handle('USER_BOX', 'parse');
	return;
}

$num_sites = 0;
$num_lines = 0;
$num_errors = 0;
$network_list = $db->sql_fetchrowset($result);
$db->sql_freeresult($result);
$num_sites = count($network_list);
$num_sites = ( $num_sites < 0 ) ? 0 : $num_sites;

$template->set_filenames(array(
	'parse' => 'prillian/network_parse_body.tpl')
);

for($ii=0; $ii<$num_sites; $ii++)
{
	$error = FALSE;
	$error_msg = '';
	$f_contents = array();

	$url = $network_list[$ii]['site_url'] . 'sitetosite.' . $network_list[$ii]['site_phpex'] . '?mode=users';
	if( !$fp = @fopen($url, 'rb') )
	{
		$error = TRUE;
		$num_errors++;
	}

	if( !$error )
	{
		while ( !feof($fp) )
		{
			$f_contents[] = trim(fgetss($fp, 1024));
			$num_lines++;
		}
		fclose ($fp);
		
		if( $f_contents[0] == 'Disabled' || $f_contents[0] == 'None' )
		{
			$num_errors++;
			continue;
		}

		for($jj=1; $jj<$num_lines; $jj++)
		{
			if( $f_contents[$jj] == '' )
			{
				$jj += 2;
				continue;
			}

			$offsite_username = stripslashes($f_contents[$jj++]);
			$offsite_userid = intval($f_contents[$jj]);
			$url = $network_list[$ii]['site_url'] . $network_list[$ii]['site_profile'] . '.' . $network_list[$ii]['site_phpex'] . '?mode=viewprofile&amp;' . OFF_SITE_USERS_URL . '=' . $offsite_userid;
			$message_url =  append_sid($phpbb_root_path . "imclient.$phpEx?mode=post&amp;site_id=" . $network_list[$ii]['site_id'] . '&amp;'. OFF_SITE_USERS_URL . '=' . $offsite_userid . '&amp;username=' . urlencode($offsite_username));

			if( $im_userdata['network_user_list'] == 2 )
			{
				$template->assign_block_vars('switch_network_list', array(
					'ONLINE_USER_SITE' => '<img src="' . $images['prill_offsite'] . '" alt="' . $lang['Online_at'] . $network_list[$ii]['site_name'] . '" title="' . $lang['Online_at'] . $network_list[$ii]['site_name'] . '" align="center" />', 
					'ONLINE_USER_URL' => $url,
					'ONLINE_USER' => $offsite_username,
					'U_MESSAGE_USER' => $message_url
				));
			}
			else
			{
				$user = array();
				$user['user_level'] = OFF_SITE;
				$user['user_allow_viewonline'] = 1;
				$user['user_id'] = $offsite_userid;
				$user['username'] = $offsite_username;
				$user['site_name'] = $network_list[$ii]['site_name'];
				$user['url'] = $url;
				$user['site_id'] = $network_list[$ii]['site_id'];
				$prillian_online[] = $user;
			}
		}
	}
}

if( ($num_errors < $num_sites) && ($im_userdata['network_user_list'] == 2) )
{
	$template->assign_block_vars('switch_network_boxes', array(
		'L_NETWORK_TITLE' => $lang['Network_Users_online']
	));
	$template->assign_var_from_handle('USER_BOX', 'parse');
}

?>