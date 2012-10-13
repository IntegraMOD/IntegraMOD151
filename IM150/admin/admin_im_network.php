<?php
/***************************************************************************
 *                             admin_im_network.php
 *                            -------------------
 *   begin                : Friday, May 16, 2003
 *   version              : 0.2.0
 *   date                 : 2003/12/23 23:20
 ***************************************************************************/

define('IN_PHPBB', 1);
define('IN_PRILLIAN', 1);

if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['Prillian']['Network Messaging'] = $filename;
	return;
}

$phpbb_root_path = './../';
require_once($phpbb_root_path . 'extension.inc');
require_once('./pagestart.' . $phpEx);
require_once(PRILL_PATH . 'prill_common.' . $phpEx);

// Is fopen allowed to use URLs?
if( !ini_get('allow_url_fopen') )
{
	message_die(GENERAL_MESSAGE, 'No_allow_url_fopen');
}

$confirm = ( isset($_REQUEST['confirm']) ) ? TRUE : FALSE;
$cancel = ( isset($_REQUEST['cancel']) ) ? TRUE : FALSE;

if ($cancel)
{
	thoul_redirect('admin/' . append_sid('admin_im_network.' . $phpEx, true));
}

$mode = ( isset($_REQUEST['mode']) ) ? $_REQUEST['mode'] : '';
$s_hidden_fields = '';
if( isset( $_REQUEST['autodetect']) )
{
	$mode = 'autodetect_form';
}

switch($mode)
{
	case 'autodetect_form':
		$template->set_filenames(array(
			'body' => 'admin/network_detect_body.tpl')
		);

		$template->assign_vars(array(
			'L_SUBMIT' => $lang['Submit'],
			'L_NETWORK_TITLE' => $lang['Network_autodetect'],
			'L_NETWORK_TEXT' => $lang['Network_autodetect_explain'],
			'L_URL' => $lang['URL'],
			'L_REQUIRED' => $lang['Items_required'],

			'S_FORM_ACTION' => append_sid('admin_im_network.'.$phpEx)
		));

		break;
	case 'autodetect':
		$message = '';
		$site_url = ( isset( $_REQUEST['site_url'] )) ? trim($_REQUEST['site_url']): '';
		// If no url was entered complain ...
		if ( $site_url == '' )
		{
			message_die(GENERAL_ERROR, $lang['Fields_empty'], 'Information');
		}
		$detect_url = $site_url . 'sitetosite.php?mode=detect';
		if( !$remote = @fopen($detect_url, 'rb') )
		{
			$message .= $lang['ND_no_connect'] . "<br /><br /><a href=\"$site_url\" target=\"_blank\">$detect_url</a><br /><br />" . $lang['ND_no_connect_explain'];
		}
		else
		{
			$message .= $lang['ND_connected'];
			$first_line = trim(fgetss($remote, 1024));
			if( $first_line == 'Disabled' )
			{
				$message .= '<br /><br />' . $lang['ND_disabled'];
				fclose ($remote);
			}
			else
			{
				$message .= '<br /><br />' . $lang['ND_enabled'];
				$f_contents = array();
				while ( !feof($remote) )
				{
					$f_contents[] = trim(fgetss($remote, 1024));
					$num_lines++;
				}
				fclose ($remote);
				if( $first_line == '0.6.0' )
				{
					$message .= '<br /><br />' . $lang['ND_060'];
				}
				else
				{
					$error = false;
					if( $first_line != $prill_config['version'] )
					{
						$message .= '<br /><br />' . $lang['ND_version'];
					}
					$site_phpex = ( !empty($f_contents[0]) ) ? $f_contents[0]: 'php';
					$site_profile = ( !empty($f_contents[1]) ) ? $f_contents[1]: 'profile';
					$site_name = ( !empty($f_contents[2]) ) ? $f_contents[2]: $lang['ND_Unnamed_Site'];
					if( empty($f_contents[0]) || empty($f_contents[1]) || empty($f_contents[2]) )
					{
						$error = true;
					}
					$site_enable = ( !$error ) ? 1: 0;

					if( $error )
					{
						$message .= '<br /><br />' . $lang['ND_data_error'];
					}

					$site_url = str_replace("\'", "''", addslashes($site_url));
					$site_name = str_replace("\'", "''", addslashes($site_name));
					$site_phpex = str_replace("\'", "''", addslashes($site_phpex));
					$site_profile = str_replace("\'", "''", addslashes($site_profile));

					$sql = 'INSERT INTO ' . IM_SITES_TABLE . ' (site_name, site_url, site_enable, site_phpex, site_profile) VALUES (' . "'$site_name', '$site_url', $site_enable, '$site_phpex', '$site_profile')";

					if(!$db->sql_query($sql))
					{
						$message .= '<br /><br />' . 'Could not insert network site data';
						message_die(GENERAL_ERROR, $message, '', __LINE__, __FILE__, $sql);
					}
					else
					{
						$message .= '<br /><br />' . $lang['ND_Added_Success'];
					}
				} // 0.6.0
			} // Disabled
		} // 404
		$message .= '<br /><br />' . sprintf($lang['Click_return_network'], '<a href="' . append_sid('admin_im_network.' . $phpEx) . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid("index.$phpEx?pane=right") . '">', '</a>');
		message_die(GENERAL_MESSAGE, $message);
		break;
	case 'save':
		$new_site = ( !isset($_REQUEST['network_type']) ) ? true : false;

		$site_id = ( !empty( $_REQUEST['site_id'] )) ? intval($_REQUEST['site_id']): '';
		$site_name = ( isset( $_REQUEST['site_name'] )) ? trim($_REQUEST['site_name']): '';
		$site_url = ( isset( $_REQUEST['site_url'] )) ? trim($_REQUEST['site_url']): '';
		$site_phpex = ( isset( $_REQUEST['site_phpex'] )) ? trim($_REQUEST['site_phpex']): 'php';
		$site_profile = ( isset( $_REQUEST['site_profile'] )) ? trim($_REQUEST['site_profile']): 'profile';
		$site_enable = ( !empty( $_REQUEST['site_enable'] )) ? 1: 0;

		// If no name or url were entered complain ...
		if ($site_name == '' || $site_url == '' )
		{
			message_die(GENERAL_ERROR, $lang['Fields_empty'], 'Information');
		}

		$site_url = str_replace("\'", "''", addslashes($site_url));
		$site_name = str_replace("\'", "''", addslashes($site_name));
		$site_phpex = str_replace("\'", "''", addslashes($site_phpex));
		$site_profile = str_replace("\'", "''", addslashes($site_profile));

		if( $new_site )
		{
			$error_msg = 'Could not insert network site data';
			$name_sql = '';
			$val_sql = '';

			if( $site_phpex )
			{
				$name_sql .= ', site_phpex';
				$val_sql .= ", '$site_phpex'";
			}
			if( $site_profile )
			{
				$name_sql .= ', site_profile';
				$val_sql .= ", '$site_profile'";
			}

			$sql = 'INSERT INTO ' . IM_SITES_TABLE . ' (site_name, site_url, site_enable' . $name_sql . ') VALUES (' . "'$site_name', '$site_url', $site_enable $val_sql)";
		}
		else
		{
			$error_msg = 'Could not update network site data';
			$sql = 'UPDATE ' . IM_SITES_TABLE . " SET site_name='$site_name', site_url='$site_url', site_phpex='$site_phpex', site_profile='$site_profile', site_enable=$site_enable WHERE site_id = $site_id";
		}

		if(!$db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, $error_msg, '', __LINE__, __FILE__, $sql);
		}

		$message = $lang['Network_add_success'] . '<br /><br />' . sprintf($lang['Click_return_network'], '<a href="' . append_sid('admin_im_network.' . $phpEx) . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid("index.$phpEx?pane=right") . '">', '</a>');

		message_die(GENERAL_MESSAGE, $message);
		break;
	case 'edit':
		// Edit a site
		$site_id = ( isset( $_REQUEST['site_id'] )) ? intval($_REQUEST['site_id']): '';
		// If no id was entered complain ...
		if ( !$site_id )
		{
			message_die(GENERAL_ERROR, $lang['Fields_empty'], 'Information');
		}

		$sql = 'SELECT * FROM ' . IM_SITES_TABLE . ' WHERE site_id = ' . $site_id;
		if(!$result = $db->sql_query($sql))
		{
			message_die(CRITICAL_ERROR, 'Could not query network site table for editing in admin_im_network', '', __LINE__, __FILE__, $sql);
		}
		
		if(!$row = $db->sql_fetchrow($result) )
		{
			message_die(CRITICAL_ERROR, 'Could not get site information in admin_im_network', '', __LINE__, __FILE__, $sql);
		}

		$s_hidden_fields = '<input type="hidden" name="site_id" value="' . $row['site_id'] . '" /><input type="hidden" name="network_type" value="edit" />';

		// No break - we continue this under add
	case 'add':
		// Add a site

		if( !isset($row))
		{
			$row = '';
		}

		$s_hidden_fields .= '<input type="hidden" name="mode" value="save" />';
		
		$template->set_filenames(array(
			'body' => 'admin/network_edit_body.tpl')
		);

		$template->assign_vars(array(
			'L_SUBMIT' => $lang['Submit'],
			'L_SITE_CONFIG' => $lang['Network_config'],
			'L_NETWORK_TITLE' => $lang['Network_title'],
			'L_NETWORK_TEXT' => $lang['Network_explain'],
			'L_SITENAME' => $lang['Site_name'],
			'L_URL' => $lang['URL'],
			'L_EXT' => $lang['Extension'],
			'L_PROFILE_PATH' => $lang['Profile_path'],
			'L_PROFILE_PATH_EXPLAIN' => $lang['Profile_path_explain'],
			'L_EXT_EXPLAIN' => $lang['Extension_explain'],
			'L_ENABLED' => $lang['Enabled'],
			'L_ENABLED_EXPLAIN' => $lang['Enabled_explain'],
			'L_YES' => $lang['Yes'],
			'L_NO' => $lang['No'],
			'L_REQUIRED' => $lang['Items_required'],

			'S_HIDDEN_FIELDS' => $s_hidden_fields, 
			'S_FORM_ACTION' => append_sid('admin_im_network.'.$phpEx),

			'ENABLED_YES' => ( $row['site_enable'] ) ? 'checked="checked"' : '',
			'ENABLED_NO' => ( !$row['site_enable'] ) ? 'checked="checked"' : '',
			'NAME' => $row['site_name'],
			'URL' => $row['site_url'],
			'EXT' => $row['site_phpex'],
			'PROFILE_PATH' => $row['site_profile']
		));
		
		break;
	case 'delete':
		// Delete a site from the list

		$site_id = ( isset( $_REQUEST['site_id'] )) ? intval($_REQUEST['site_id']): '';
		// If no id was entered complain ...
		if ( !$site_id )
		{
			message_die(MESSAGE, $lang['Fields_empty']);
		}

		$sql = 'DELETE FROM ' . IM_SITES_TABLE . ' WHERE site_id = ' . $site_id;
		if( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not delete site', '', __LINE__, __FILE__, $sql);
		}

		$message = $lang['Network_del_success'] . '<br /><br />' . sprintf($lang['Click_return_network'], '<a href="' . append_sid('admin_im_network.' . $phpEx) . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid("index.$phpEx?pane=right") . '">', '</a>');

		message_die(GENERAL_MESSAGE, $message);
		break;
	default:
		$sql = 'SELECT * FROM ' . IM_SITES_TABLE;
		if(!$result = $db->sql_query($sql))
		{
			message_die(CRITICAL_ERROR, 'Could not query network sites table in admin_im_network', '', __LINE__, __FILE__, $sql);
		}
		$sites = $db->sql_fetchrowset($result);

		$s_hidden_fields = '<input type="hidden" name="mode" value="add" />';

		$template->set_filenames(array(
			'body' => 'admin/network_list_body.tpl')
		);

		$template->assign_vars(array(
			'L_ACTION' => $lang['Action'],
			'L_DELETE' => $lang['Delete'],
			'L_EDIT' => $lang['Edit'],
			'L_NETWORK_TITLE' => $lang['Network_title'],
			'L_NETWORK_TEXT' => $lang['Network_explain'],
			'L_SITENAME' => $lang['Site_name'],
			'L_URL' => $lang['URL'],
			'L_EXT' => $lang['Extension'],
			'L_NETWORK_ADD' => $lang['Network_add'],
			'L_ENABLED' => $lang['Enabled'],
			'L_NETWORK_AUTODETECT' => $lang['Network_autodetect'],

			'S_HIDDEN_FIELDS' => $s_hidden_fields, 
			'S_FORM_ACTION' => append_sid('admin_im_network.'.$phpEx))
		);

		for($i = 0; $i < count($sites); $i++)
		{
			$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
			$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
			$enable_status = ( $sites[$i]['site_enable'] ) ? $lang['Yes']: $lang['No'];

			$template->assign_block_vars('sites', array(
				'ROW_CLASS' => $row_class,
				'ROW_COLOR' => $row_color,
				'NAME' => $sites[$i]['site_name'],
				'URL' => $sites[$i]['site_url'],
				'EXT' => $sites[$i]['site_phpex'],
				'ENABLED' => $enable_status,

				'U_SITE_EDIT' => append_sid('admin_im_network.' . $phpEx . '?mode=edit&amp;site_id=' . $sites[$i]['site_id']),
				'U_SITE_DELETE' => append_sid('admin_im_network.' . $phpEx . '?mode=delete&amp;site_id=' . $sites[$i]['site_id']))
			);
		}
		
		break;
}

$template->pparse('body');	
include('./page_footer_admin.'.$phpEx);

?>