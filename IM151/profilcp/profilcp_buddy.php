<?php
/***************************************************************************
 *						profilcp_buddy.php
 *						------------------
 *	begin			: 08/05/2003
 *	copyright		: Ptirhiik
 *	email			: admin@rpgnet-fr.com
 *
 *	version			: 1.2.2 - 23/10/2003
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

if( !empty($setmodules) )
{
	pcp_set_menu('buddy', 70, __FILE__, 'profilcp_buddy_shortcut', 'profilcp_buddy_pagetitle' );
	pcp_set_sub_menu('buddy', 'friend', 10, __FILE__, 'profilcp_buddy_friend_shortcut', 'profilcp_buddy_friend_pagetitle' );
	pcp_set_sub_menu('buddy', 'ignore', 20, __FILE__, 'profilcp_buddy_ignore_shortcut', 'profilcp_buddy_ignore_pagetitle' );
	pcp_set_sub_menu('buddy', 'memberlist', 30, __FILE__, 'profilcp_buddy_list_shortcut', 'profilcp_buddy_list_pagetitle' );

	return;
}

// map used
$map_name = 'PCP.buddy';

// check access
if ( ($userdata['user_id'] != $view_userdata['user_id']) && (!is_admin($userdata) || ($level_prior[get_user_level($userdata)] <= $level_prior[get_user_level($view_userdata)])) ) return;

// operators
$operators = array(
	'LE' => $lang['Comp_LE'],
	'EQ' => $lang['Comp_EQ'],
	'NE' => $lang['Comp_NE'],
	'GE' => $lang['Comp_GE'],
	'IN' => $lang['Comp_IN'],
	'NI' => $lang['Comp_NI'],
);

// buddy id
$buddy_id = -1;
if ( isset($_POST['b']) || isset($_GET['b']) )
{
	$buddy_id = isset($_POST['b']) ? intval($_POST['b']) : intval($_GET['b']);
}

// action
$set = '';
if ( isset($_POST['set']) || isset($_GET['set']) )
{
	$set = isset($_POST['set']) ? $_POST['set'] : $_GET['set'];
}
if ( !in_array($set, array('inv', 'vis', 'add', 'remove')) || ($buddy_id < 0) ) 
{
	$set = '';
	$buddy_id = -1;
}

// check buddy_id
if ($buddy_id > 0)
{
	$sql = "SELECT * FROM " . USERS_TABLE . " WHERE user_id = $buddy_id";
	if ( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, "Could not get user information", '', __LINE__, __FILE__, $sql);
	}
	if ( !$userrow = $db->sql_fetchrow($result) )
	{
		$set = '';
		$buddy_id = -1;
		message_die(GENERAL_ERROR, $lang['No_such_user']);
	}
}

// coming from
$from = '';
$l_from = '';
switch (isset($_GET['from']) ? $_GET['from'] : '')
{
	case 'profil' :
		$from = append_sid("profile.$phpEx?mode=viewprofile&" . POST_USERS_URL . "=$buddy_id");
		/* PCP Extra :: Altered ::
		$l_from = sprintf( $lang['Click_return_profilcp'], '<a href="' . $from . '">', '</a>' );*/
		$l_from = sprintf( $lang['Click_return_profilcp'], '<a href="' . $from . '">', '</a>', $lang['Profile'] );
		break;
	case 'topic' :
		$topic_id = 0;
		if ( isset($_GET[POST_TOPICS_URL]) )
		{
			$from = append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=" . intval($_GET[POST_TOPICS_URL]));
			$l_from = sprintf( $lang['Click_return_topic'], '<a href="' . $from . '">', '</a>' );
		}
		else if ( isset($_GET[POST_POST_URL]) )
		{
			$from = append_sid("viewtopic.$phpEx?" . POST_POST_URL . "=" . intval($_GET[POST_POST_URL]) . "#" . intval($_GET[POST_POST_URL]));
			$l_from = sprintf( $lang['Click_return_topic'], '<a href="' . $from . '">', '</a>' );
		}
		break;
	case 'privmsg' :
		$from = append_sid("privmsg.$phpEx?mode=read&" . POST_POST_URL . "=" . intval($_GET[POST_POST_URL]));
		$l_from = sprintf( $lang['Click_return_privmsg'], '<a href="' . $from . '">', '</a>' );
		break;
	default:
		$from = '';
		$l_from = '';
		break;
}

// module mode
$friend_list = ($sub=='friend');
$ignore_list = ($sub=='ignore');

// active/disable the always view option
if ( in_array($set, array('vis', 'inv')) )
{
	$buddy_visible = ($set=='vis') ? '1' : '0';
	$sql = "UPDATE " . BUDDYS_TABLE . " SET buddy_visible=$buddy_visible WHERE user_id=$view_user_id and buddy_id=$buddy_id";
	if ( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not update buddy information', '', __LINE__, __FILE__, $sql);
	}
}

if ( ($set == 'add') && ($buddy_id > 0) ) $adduser = true;
if ( ($set == 'remove') && ($buddy_id > 0) ) $remove = true;

// remove from list
if ($remove)
{
	$user_ids = ( $set == 'remove' ) ? array($buddy_id) : $_POST['user_ids'];
	if ( count($user_ids) > 0 )
	{
		$s_user_ids = implode(', ', $user_ids);
		$sql = "DELETE FROM " . BUDDYS_TABLE . " WHERE user_id = " . $view_userdata['user_id'] . " and buddy_id in ($s_user_ids)";
		if ( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not delete buddy list entries', '', __LINE__, __FILE__, $sql);
		}
	}
	$error = false;
	if ( ($set == 'remove') && ($l_from != '') )
	{
		$ret_link = $from;
		$template->assign_vars(array(
			'META' => '<meta http-equiv="refresh" content="3;url=' . $ret_link . '">')
		);
		$message = $lang['Profile_updated'] . '<br /><br />' . $l_from . '<br /><br />';
		message_die(GENERAL_MESSAGE, $message);
	}
}
else if ($adduser)
{
	if ($set != 'add')
	{
		$username = ( isset($_POST['username']) ) ? $_POST['username'] : '';
		$sql = "SELECT * FROM " . USERS_TABLE . " WHERE LOWER(username) = '" . strtolower(str_replace("\'", "''", $username)) . "'";
		if ( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Could not get user information", '', __LINE__, __FILE__, $sql);
		}
		if ( !$userrow = $db->sql_fetchrow($result) )
		{
			$error = true;
			$error_msg = $lang['profilcp_buddy_could_not_add_user'];
		}
	}
	if ( empty($error) && ($userrow['user_id'] == $view_user_id) )
	{
		$error = true;
		$error_msg = $lang['profilcp_buddy_add_yourself'];
	}
	if ( !$error && ($userrow['user_id'] == ANONYMOUS) )
	{
		$error = true;
		$error_msg = $lang['profilcp_buddy_could_not_anon_user'];
	}
	// check if exist
	if ( empty($error) )
	{
		$sql = "SELECT * FROM " . BUDDYS_TABLE . " 
				WHERE user_id = $view_user_id 
					AND buddy_id = " . $userrow['user_id'];
		if ( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not get buddy information', '', __LINE__, __FILE__, $sql);
		}
		if ( $row = $db->sql_fetchrow($result) )
		{
			$error = true;
			$error_msg = $lang['profilcp_buddy_already'];
		}
	}
	// check if the other ignore this one
	if (!$error && $friend_list)
	{
		$sql = "SELECT * FROM " . BUDDYS_TABLE . " 
				WHERE buddy_id = $view_user_id 
					AND user_id = " . $userrow['user_id'] . " 
					AND buddy_ignore = 1";
		if ( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not get buddy information.', '', __LINE__, __FILE__, $sql);
		}
		if ( $row = $db->sql_fetchrow($result) )
		{
			$error = true;
			$error_msg = $lang['profilcp_buddy_ignore'];
		}
	}
	// check users status if ignore list
	if (!$error && ($sub == 'ignore'))
	{
		if ( is_admin($view_userdata) )
		{
			$error = true;
			$error_msg = $lang['profilcp_buddy_you_admin'];
		}
		if ( is_admin($userrow) )
		{
			$error = true;
			$error_msg = $lang['profilcp_buddy_admin'];
		}
	}
	// add it
	if (!$error )
	{
		$sql = "INSERT INTO " . BUDDYS_TABLE . " (
					user_id, 
					buddy_id, 
					buddy_ignore
				) VALUES (
					$view_user_id, 
					" . $userrow['user_id'] . ", 
					" . ( $friend_list ? 0 : 1 ) . "
				)";
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not insert buddy information.', $lang['Error'], __LINE__, __FILE__, $sql);
		}
	}
	if ($error)
	{
		message_die(GENERAL_ERROR, $error_msg);
		exit;
	}

	if ( ($set == 'add') && ($l_from != '') )
	{
		$ret_link = $from;
		$template->assign_vars(array(
			'META' => '<meta http-equiv="refresh" content="3;url=' . $ret_link . '">')
		);
		$message = $lang['Profile_updated'] . '<br /><br />' . $l_from . '<br /><br />';
		message_die(GENERAL_MESSAGE, $message);
		exit;
	}
}
else
{
	// enhance the ranks table with the rank_max value
	$sql = "SELECT * FROM " . RANKS_TABLE . " 
			WHERE rank_special = 0 
			ORDER BY rank_min DESC";
	if ( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not read ranks informations', '', __LINE__, __FILE__, $sql);
	}
	$ranks = array();
	$last = 8388607; // max int
	while ( $row = $db->sql_fetchrow($result) )
	{
		if (empty($last)) $last = 0;
		$row['rank_max'] = $last;
		$last = $row['rank_min'];
		$ranks[] = $row;
	}
	for ($i = 0; $i < count($ranks); $i++)
	{
		$sql = "UPDATE " . RANKS_TABLE . " 
				SET rank_max = " . $ranks[$i]['rank_max'] . "
				WHERE rank_id = " . $ranks[$i]['rank_id'];
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not update ranks informations', '', __LINE__, __FILE__, $sql);
		}
	}

	// fix special ranks max value
	$sql = "UPDATE " . RANKS_TABLE . " 
			SET rank_max = -1
			WHERE rank_special <> 0";
	if ( !$db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not update ranks informations', '', __LINE__, __FILE__, $sql);
	}

	// template file
	$template->set_filenames(array(
		'body' => 'profilcp/buddy_body.tpl')
	);

	// get the parms
	$fields_choosen = isset($_POST['fields_choosen']);
	$filter_active = isset($_POST['filter_active']);
	$start  = ( isset($_GET['start']) ) ? intval($_GET['start']) : 0;
	$order  = ( isset($_GET['order']) || isset($_POST['order']) ) ? ( isset($_GET['order']) ? trim(htmlspecialchars($_GET['order'])) : trim(htmlspecialchars($_POST['order'])) ) : '';
	$sort   = ( isset($_GET['sort'] ) || isset($_POST['sort'] ) ) ? ( isset($_GET['sort'] ) ? trim(htmlspecialchars($_GET['sort'] )) : trim(htmlspecialchars($_POST['sort'] )) ) : '';
	$filter = ( isset($_GET['filter']) || isset($_POST['filter']) ) ? ( isset($_GET['filter']) ? trim(htmlspecialchars($_GET['filter'])) : trim(htmlspecialchars($_POST['filter'])) ) : '';
	$comp	= ( isset($_GET['comp'] ) || isset($_POST['comp'] ) ) ? ( isset($_GET['comp'] ) ? trim(htmlspecialchars($_GET['comp'] )) : trim(htmlspecialchars($_POST['comp'] )) ) : '';
	$fvalue = ( isset($_GET['fvalue'] ) || isset($_POST['fvalue'] ) ) ? ( isset($_GET['fvalue'] ) ? trim(htmlspecialchars(stripslashes(urldecode($_GET['fvalue'])))) : htmlspecialchars(urldecode($_POST['fvalue'])) ) : '';

	if ( !isset($user_fields[$order]) ) $order = 'username';
	if ( ($order == '') || !in_array($sort, array('ASC', 'DESC')) ) $sort = '';
	if ( ($order != '') && ($sort == '') ) $sort = 'ASC';

	if ( !isset($user_fields[$filter]) ) $filter = 'username';
	if ( !isset($operators[$comp]) ) $comp = 'IN';

	// PCP Extra :: Begin Add
	@reset($user_maps[$map_name]['fields']);
  foreach ($user_maps[$map_name]['fields'] as $field_name => $map_field_data)
  {
		$user_data = $user_fields[$field_name];
    foreach ($user_data as $key => $value)
    {
			if(!isset($map_field_data[$key])){
				$user_maps[$map_name]['fields'][$field_name][$key] = $value;
			}
		}
	}
	// PCP Extra :: End Add

	// get the last ind of the user fields map
	$last_ind = 0;
  foreach ($user_maps[$map_name]['fields'] as $field_name => $map_field_data)
	{
		if ( !$map_field_data['hidden'] && ($map_field_data['ind'] > $last_ind) )
		{
			$last_ind = $map_field_data['ind'];
		}
	}

	// get the fields from the form or init an empty option field
	if ( !empty($_POST['field_ids']) || empty($view_userdata['user_list_option']) || ( strlen($view_userdata['user_list_option']) != ($last_ind+1) ) )
	{
		// something has changed
		$fields_choosen = true;

		// prepare the result
		$option = str_pad('', $last_ind+1, '0');

		// init checked fields
		$field_inds = array();

		// get the current values of the user options field
		if ( empty($_POST['field_ids']) )
		{
			// get the last ind in the userfield
			$max = strlen($view_userdata['user_list_option']);

			// adjust in case a field would have been removed
			if ( $max > ($last_ind+1) )
			{
				$max = $last_ind+1;
			}

			// get back the values
			for ($i = 0; $i < $max; $i++)
			{
				if ( substr($view_userdata['user_list_option'], $i, 1) == '1' )
				{
					$field_inds[] = $i;
				}
			}

			// get back the default values for the fields added
			if ( $max < ($last_ind+1) )
			{
        foreach ($user_maps[$map_name]['fields'] as $field_name => $map_field_data)
				{
					if ( ( $max < ($map_field_data['ind']+1) ) && ($map_field_data['dft'] || $map_field_data['rqd']) )
					{
						$field_inds[] = $map_field_data['ind'];
					}
				}
			}
		}

		// get the form data
		if ( !empty($_POST['field_ids']) )
		{
			$field_inds = $_POST['field_ids'];
		}

		// process the field inds choosen
		for ($i = 0; $i < count($field_inds); $i++)
		{
			$ind = $field_inds[$i];
			$option[$ind] = '1';
		}

		// force the required fields
    foreach ($user_maps[$map_name]['fields'] as $field_name => $map_field_data)
		{
			if ($map_field_data['rqd'])
			{
				$option[ $map_field_data['ind'] ] = '1';
			}
		}

		// store the value
		$view_userdata['user_list_option'] = $option;
	}

	// update the user option field
	if ($fields_choosen)
	{
		// store the result
		$sql = "UPDATE " . USERS_TABLE . " 
				SET user_list_option = '" .  $view_userdata['user_list_option'] . "' 
				WHERE user_id = " . $view_userdata['user_id'];
		if ( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not update user options.', '', __LINE__, __FILE__, $sql);
		}
	}

	// display the select box
	$nb_cell = 5;

	// ordered fields : all available to display
	$ord_fields = array();
  foreach ($user_maps[$map_name]['fields'] as $field_name => $map_field_data)
	{
		if ( !$map_field_data['hidden'] )
		{
			$ord_fields[] = $field_name;
		}
	}

	$count = count($ord_fields) - 1;
	$offset = 0;
	$color_row = false;
	for ($j=0; $j <= intval($count / $nb_cell); $j++)
	{
		$color_row = !$color_row;
		$color = !$color_row;
		$template->assign_block_vars('userfields_row', array());
		for ($i=0; $i < $nb_cell; $i++)
		{
			$color = !$color;
			if ($offset <= $count)
			{
				$field_name = $ord_fields[$offset];
				$field_ind = $user_maps[$map_name]['fields'][$field_name]['ind'];
				$field_leg = pcp_output($field_name, $userdata, $map_name, true);
				$template->assign_block_vars('userfields_row.userfields_cell', array(
					'CLASS'		=> $color ? 'row1' : 'row2',
					'FIELD_ID'	=> $field_ind,
					'FIELDS'	=> $field_leg,
					'CHECKED'	=> (intval($view_userdata['user_list_option'][$field_ind]) ) ? ' checked="checked"' : '',
					)
				);
			}
			else
			{
				$template->assign_block_vars('userfields_row.userfields_cell_empty', array(
					'CLASS' => 'row3',
					)
				);
			}
			$offset++;
		}
	}

	// get a field_id list of the selected field
	$field_ids = array();
	for ($i=0; $i < strlen($view_userdata['user_list_option']); $i++)
	{
		if ($view_userdata['user_list_option'][$i] == '1')
		{
			$field_ids[$i] = true;
		}
	}

	// call url
	$call = "./profile.$phpEx?mode=buddy&sub=$sub&filter=$filter&comp=$comp";
	if ($fvalue != '') $call .= "&fvalue=" . urlencode($fvalue);

	// filter
	$s_filter = '<select name="filter">';

	// header & sort icons
  foreach ($user_maps[$map_name]['fields'] as $field_name => $map_field_data)
	{
		if ( isset($field_ids[ $map_field_data['ind'] ]) )
		{
			// sort/order options
			$icon_sort = '';
			$user_fields[$field_name]['sortable'] = false;

			// unsortable fields
			if ( ($field_name != 'user_email') || is_admin($userdata) || !$board_config['board_email_form'] )
			{
				$user_fields[$field_name]['sortable'] = true;
				if ($order != $field_name)
				{
					$icon_sort = '<a href="' . append_sid($call . "&order=$field_name&sort=DESC") . '"><img src="' . $images['next_arrow'] . '" border="0" alt="' . $lang['Sort_none'] . '" /></a>';
				}
				else switch ($sort)
				{
					case 'DESC':
						$icon_sort = '<a href="' . append_sid($call . "&order=$field_name&sort=ASC") . '"><img src="' . $images['up_arrow'] . '" border="0" alt="' . $lang['Sort_Descending'] . '" /></a>';
						break;
					case 'ASC':
						$icon_sort = '<a href="' . append_sid($call . "&order=$field_name&sort=DESC") . '"><img src="' . $images['down_arrow'] . '" border="0" alt="' . $lang['Sort_Ascending'] . '" /></a>';
						break;
					default:
						$icon_sort = '';
						break;
				}

				// filter
				$select = ( $filter == $field_name ) ? ' selected="selected"' : '';
				$field_leg = pcp_output($field_name, $userdata, $map_name, true);

				// date
				if ( ($user_fields[$field_name]['type'] == 'DATE') || ($user_fields[$field_name]['type'] == 'DATETIME') )
				{
					$field_leg .= ' (' . $lang['date_entry'] . ')';
				}

				// gender
				if ($user_fields[$field_name]['type'] == 'GENDER')
				{
					$field_leg .= ' (' . UNKNOWN . '=' . $lang['No_gender_specify'] . ', ' . MALE . '=' . $lang['Male'] . ', ' . FEMALE . '=' . $lang['Female'] . ')';
				}
				$s_filter .= '<option value="' . $field_name . '"' . $select . '>' . $field_leg . '</option>';
			}

			// fields
			$template->assign_block_vars('header_list', array(
				'L_FIELD'	=> pcp_output($field_name, $userdata, $map_name, true),
				'ICON_SORT' => $icon_sort,
				)
			);
		}
	}
	$s_filter .= '</select>';

	// add the sort to the call
	if ( !empty($order) && !empty($sort) ) 
	{ 
		$call .= "&order=$order&sort=$sort"; 
	}

	// operand
	$s_comp = '<select name="comp">';
  foreach ($operators as $key => $value)
	{
		$select = ($comp == $key) ? ' selected="selected"' : '';
		$s_comp .= '<option value="' . $key . '"' . $select . '>' . $value . '</option>';
	}
	$s_comp .= '</select>';

	// read the users
	$view_user_id = $view_userdata['user_id'];
	$view_is_admin = is_admin($view_userdata);

	// sql classes fields
	$admin = is_admin($userdata);
	$tables_used_class = array();
  foreach ($classes_fields as $class_name => $class_data)
	{
		$sql_var = 'sql_' . $class_name . '_class';
		$$sql_var = '';
		if ( $admin || ( empty($class_data['admin_field']) && empty($class_data['sql_def']) ) )
		{
			$$sql_var = '1';
		}
		else if ( !empty($class_data['admin_field']) && !$view_userdata[ $class_data['admin_field'] ] )
		{
			$$sql_var = '0';
		}
		else if ( !empty($class_data['sql_def'])  )
		{
			// parse the definition of the class
			$sql_def = pcp_parse_def($class_data['sql_def'], $view_userdata, $tables_used_class[$class_name]);

			// result
			$$sql_var = '(' . $sql_def . ')';
		}
	}

	// init usage of classes and tables
	$classes_used = array();
	$tables_used = array();

	// fields
	$sql_fields = $tables_linked['USERS']['sql_id'] . ".*";
  foreach ($user_maps[$map_name]['fields'] as $field_name => $map_field_data)
	{
		$field_data = $user_fields[$field_name];
		if ( isset($field_ids[ $map_field_data['ind'] ]) || $map_field_data['hidden'] )
		{
			// get field class
			$class_def = '';
			if ( !empty($field_data['class']) && isset($classes_fields[ $field_data['class'] ]) )
			{
				$class_name = $field_data['class'];
				$sql_var = 'sql_' . $field_data['class'] . '_class';
				$class_def = $$sql_var;

				// store the class used by this field
				if ( empty($classes_used) || !in_array($class_name, $classes_used) )
				{
					$classes_used[] = $class_name;
				}
			}

			// get table source
			$sql_def = $field_data['sql_def'];
			if ( empty($sql_def) )
			{
				$sql_def = '[USERS].' . $field_name;
			}
			// parse the definition of the field
			$sql_def = pcp_parse_def($sql_def, $view_userdata, $tables_used);

			// apply the class field
			if ($class_def == '1')
			{
				$$field_name = $sql_def;
			}
			else if ($class_def == '0')
			{
				$$field_name = "''";
			}
			else if ( !empty($class_def) )
			{
				$$field_name = "(CASE WHEN $class_def THEN $sql_def ELSE '' END)";
			}
			else
			{
				$$field_name = '';
			}

			if ( !empty( $$field_name ) )
			{
				$sql_fields .= ( empty($sql_fields) ? '' : ",\n" ) . $$field_name . ' AS ' . $field_name . '_virt';
			}
		}
	}

	// classes fields used
	$sql_classes_fields = '';
	@sort($classes_used);
	for ($i = 0; $i < count($classes_used); $i++)
	{
		$class_name = $classes_used[$i];
		$class_data = $classes_fields[ $classes_used[$i] ];

		$sql_var = 'sql_' . $class_name . '_class';
		$class_def = $$sql_var;

		// get the field value
		if ( $class_def == '1' )
		{
			$field_value = '1';
		}
		else if ($class_def == '0')
		{
			$field_value = "''";
		}
		else if ( !empty($class_def) )
		{
			$field_value = "(CASE WHEN $class_def THEN 1 ELSE '' END)";
		}
		else
		{
			$field_value = '';
		}

		if ( !empty($field_value) )
		{
			$sql_classes_fields .= ( empty($sql_classes_fields) ? '' : ",\n" ) . $field_value;
			$sql_classes_fields .= ' AS user_' . $class_name . '_display';
		}

		// get the tables used by this class
    foreach ( $tables_used_class[$class_name]  as $table_name => $used)
		{
			$tables_used[$table_name] = true;
		}
	}

	// commas
	if ( !empty($sql_fields) && !empty($sql_classes_fields) )
	{
		$sql_fields .= ',';
	}

	// where statement
	$sql_where = $tables_linked['USERS']['sql_id'] . ".user_id <> " . ANONYMOUS;
	if ($friend_list)
	{
		$sql_where .= ' AND ' . $tables_linked['BUDDY_MY']['sql_id'] . '.buddy_ignore = 0';
	}
	if ($ignore_list)
	{
		$sql_where .= ' AND ' . $tables_linked['BUDDY_MY']['sql_id'] . '.buddy_ignore = 1';
	}
	if ($fvalue != '')
	{
		$val = $fvalue;
		$t_comp = $comp;
		$t_filter = $filter;

		// field definition
		$field_name = $filter;
		$field_data = $user_fields[$filter];

		switch ( $user_fields[$filter]['type'] )
		{
			case 'TINYINT':
			case 'SMALLINT':
			case 'MEDIUMINT':
			case 'LONGINT':
				$val = intval($val);
				break;
			case 'DATE':
			case 'DATETIME':
				$val1 = mktime( 0, 0, 0, intval(substr($val, 4, 2)), intval(substr($val, 6, 2)), intval(substr($val, 0, 4)) );
				$val2 = mktime( 0, 0, 0, intval(substr($val, 4, 2)), intval(substr($val, 6, 2))+1, intval(substr($val, 0, 4)) )-1;
				switch($t_comp)
				{
					case 'EQ': 
					case 'IN':
						$t_comp = 'RG';
						break;
					case 'NE':
					case 'NI':
						$t_comp = 'NR';
						break;
					case 'LE':
						$val = $val2;
						break;
					default:
						$val = $val1;
						break;
				}
				break;
			case 'VARCHAR':
				$val = str_replace("\'", "''", $val);
				break;
			default:
				$val = '';
				$tcomp = '';
				break;
		}
		
		// get field class
		$class_def = '';
		if ( !empty($field_data['class']) && isset($classes_fields[ $field_data['class'] ]) )
		{
			$class_name = $field_data['class'];
			$sql_var = 'sql_' . $field_data['class'] . '_class';
			$class_def = $$sql_var;
		}

		// get table source
		$sql_def = $field_data['sql_def'];
		if ( empty($sql_def) )
		{
			$sql_def = '[USERS].' . $field_name;
		}
		$sql_def = pcp_parse_def( $sql_def, $view_userdata, $tables_used );

		// apply the class field
		if ($class_def == '1')
		{
			$$field_name = $sql_def;
		}
		else if ($class_def == '0')
		{
			$$field_name = "''";
		}
		else if ( !empty($class_def) )
		{
			$$field_name = "(CASE WHEN $class_def THEN $sql_def ELSE '' END)";
		}
		else
		{
			$$field_name = '';
		}

		// get the result
		$t_filter = $$field_name;

		// filter on accessible field
		if ( !empty($t_filter) )
		{
			switch ($t_comp)
			{
				case 'RG':
					$sql_where .= " AND $t_filter >= '" . $val1 . "' AND $t_filter <= '" . $val2 . "'";
					break;
				case 'NR':
					$sql_where .= " AND ($t_filter < '" . $val1 . "' OR $t_filter > '" . $val2 . "')";
					break;
				case 'LE':
					$sql_where .= " AND $t_filter <= '" . $val . "'";
					break;
				case 'EQ':
					$sql_where .= " AND $t_filter = '" . $val . "'";
					break;
				case 'NE': 
					$sql_where .= " AND $t_filter <> '" . $val . "'";
					break;
				case 'GE': 
					$sql_where .= " AND $t_filter >= '" . $val . "'";
					break;
				case 'IN':
					$sql_where .= " AND $t_filter LIKE '%" . $val . "%'";
					break;
				case 'NI':
					$sql_where .= " AND $t_filter NOT LIKE '%" . $val . "%'";
					break;
				default:
					break;
			}
		}
	}

	// order by statement
	$sql_order_by = '';
	if ( $user_fields[$order]['sortable'] )
	{
		$sql_order_by .= $order . '_virt ' .  $sort;
	}

	// add to tables used the ones required for specific filter (friend and ignore list)
	if ($friend_list || $ignore_list)
	{
		$tables_used['BUDDY_MY'] = true;
	}

	// add the users table
	$tables_used['USERS'] = true;

	// tables (USERS first)
	$sql_tables = "(\n" . $tables_linked['USERS']['sql_join'] . ")";

	// prepare the table processed
	$tables_processed = array();
	$tables_processed[] = 'USERS';
	$done = false;
	while ( !$done )
	{
		@ksort($tables_used);
    foreach ($tables_used as $table_name => $used)
		{
			if ( !in_array($table_name, $tables_processed) )
			{
				$tables_processed[] = $table_name;
				$sql_tables = sprintf( "(%s\n" . $tables_linked[$table_name]['sql_join'] . ")", $sql_tables );
			}
		}

		// parse the result
		$sql_tables = pcp_parse_def( $sql_tables, $view_userdata, $tables_used );

		// check if any unprocessed table remains
		$done = true;
    foreach ($tables_used as $table_name => $used)
		{
			$done = in_array($table_name, $tables_processed);
			if ( !$done )
			{
				break;
			}
		}
	}

	// sql request
	$sql = "SELECT DISTINCT 
				$sql_fields
				$sql_classes_fields
			FROM $sql_tables
			WHERE $sql_where
			ORDER BY $sql_order_by";

	// read the number of row
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Could not read user informations", '', __LINE__, __FILE__, '<table><tr><td><span class="genmed"><pre>' . $sql . '</pre></span></td></tr></table>');
	}
	$total_users = $db->sql_numrows($result);

	$sql .= " LIMIT $start, " . $board_config['topics_per_page'];
	if ( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not read user informations.', '', __LINE__, __FILE__, $sql);
	}

//	echo '<hr /><div class="gensmall"><pre>' . $sql . '</pre></div>';
	$users = array();
	while ($row = $db->sql_fetchrow($result))
	{
    foreach ($user_maps[$map_name]['fields'] as $field_name => $map_field_data)
		{
			if ( isset($row[$field_name . '_virt']) )
			{
				$row[$field_name] = $row[$field_name . '_virt'];
			}
		}
		$users[] = $row;
	}
	// display the users
	$color = false;
	for ($i=0; $i < count($users); $i++ )
	{
		$color = !$color;
		$template->assign_block_vars('userrow', array(
			'CLASS'		=> ($color) ? 'row1' : 'row2',
			'NUMBER'	=> $i+1+$start,
			)
		);
    foreach ($user_maps[$map_name]['fields'] as $field_name => $map_field_data)
		{
			if ($field_ids[ $map_field_data['ind'] ] )
			{
				preProcessUserConfig($users[$i]);
				$template->assign_block_vars('userrow.user_list', array(
					'FIELD' => pcp_output($field_name, $users[$i], $map_name),
					)
				);
			}
		}
		if ($friend_list || $ignore_list)
		{
			$template->assign_block_vars('userrow.select', array(
				'USER_ID' => $users[$i]['user_id'],
				'CHECKED' => '',
				)
			);
		}
	}

	// friend or ignore list : add select column
	$col = count($field_ids) + 1;
	if ($friend_list || $ignore_list)
	{
		$col++;
		$template->assign_block_vars('select', array());
	}

	$template->assign_vars(array(
		'L_USER_FIELDS'		=> $lang['User_fields'],
		'COLSPAN'			=> $nb_cell,
		'DOWN_ARROW'		=> $images['down_arrow'],
		'UP_ARROW'			=> $images['up_arrow'],

		'L_FILTER_FIELDS'	=> $lang['Select'],
		'S_FILTER_FIELDS'	=> $s_filter,
		'S_COMP'			=> $s_comp,
		'FILTER'			=> str_replace("\'", "'", $fvalue),

		'ROW_SPAN'			=> $col+1,

		'L_SUBMIT'			=> $lang['Submit'],
		'L_RESET'			=> $lang['Reset'],
		'L_GO'				=> $lang['Go'],

		'L_SELECT'			=> $lang['Select'],
		'L_ADD_MEMBER'		=> $lang['Add_member'],
		'L_FIND_USERNAME'	=> $lang['Find_username'],
		'L_REMOVE_SELECTED'	=> $lang['Remove_selected'],
		)
	);

	$template->assign_vars(array(
		'PAGINATION'			=> generate_pagination($call, $total_users, $board_config['topics_per_page'], $start),
		'PAGE_NUMBER'			=> sprintf($lang['Page_of'], ( floor( $start / $board_config['topics_per_page'] ) + 1 ), ceil( $total_users / $board_config['topics_per_page'] )), 
		'L_GOTO_PAGE'			=> $lang['Goto_page'],

		'S_HIDDEN_FIELDS'		=> $s_hidden_fields,
		'U_SEARCH_USER'			=> append_sid("./search.$phpEx?mode=searchuser"),
		'S_PROFILCP_ACTION'		=> append_sid("./profile.$phpEx"),
		)
	);

	// page
	$template->pparse('body');
}

?>
