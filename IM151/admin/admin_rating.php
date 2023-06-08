<?php
/***************************************************************************
 *                              admin_rating.php v1.1.0
 *                            -------------------
 *   begin                : Friday, Feb 7, 2003
 *   copyright            : (C) 2002 Web Centre Ltd
 *   email                : phpbb@mywebcommunities.com
 *
 *   MODIFICATION HISTORY
 *   v1.0.4 21st March 2003
 *     (V: obfuscated the reference to the POST var here so that searching for old variables doesn't yield wrong results)
 *   - Added HTTP_ POST_ VARS for when REGISTER_GLOBALS is off
 *   - Use standard phpBB call for language file
 *   v1.1.0 19th May 2003
 *   - Added 'Max' method to topic_rating
 ***************************************************************************/
define('IN_PHPBB', 1);
define('CT_SECLEVEL', 'MEDIUM');
$ct_ignorepvar = array('submit');

if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['General']['Rating_System'] = $file;
	return;
}

//
// Let's set the root dir for phpBB
//
$phpbb_root_path = "./../";
include($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

define('RATING_PATH', $phpbb_root_path . 'mods/rating/');
$use_lang = ( !file_exists($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_rating.'.$phpEx) ) ? 'english' : $board_config['default_lang']; 
include($phpbb_root_path . 'language/lang_' . $use_lang . '/lang_rating.' . $phpEx); 
include (RATING_PATH.'functions_rating.' . $phpEx);
include (RATING_PATH.'functions_rating_2.' . $phpEx);


if (isset($_POST['rating_form_submitted']))
{
	// CHECK IF ADMIN
	if( $userdata['user_level'] != ADMIN )
	{
		message_die(CRITICAL_ERROR, 'Hacking attempt!');
	}
	// FORM SUBMITTED
	if ($_POST['submit'])
	{
		// UPDATE GENERAL CONFIGURATION

		// VALIDATE TEXT/NUMBER FIELDS
		$sql = 'SELECT config_id, label, input_type FROM '.RATING_CONFIG_TABLE.' ORDER BY config_id';
		if(!$result = $db->sql_query($sql))
		{
			message_die(CRITICAL_ERROR, "Could not query rating configuration information", "", __LINE__, __FILE__, $sql);
		}
		else
		{
			while( $row = $db->sql_fetchrow($result) )
			{
				$val = trim(strip_tags($_POST['config'][$row['config_id']]));
				$text_fields = array();
				switch ($row['input_type'])
				{
					case 2:
						if (!empty($val) && !is_numeric($val))
						{
							$r_error[]=ucfirst($row['label']).' '.$lang['Must_be_an_integer'];
						}
						else
						{
							$val = intval($val);
						}
						break;
					case 4:
						$text_fields[]=$row['config_id'];
						break;
				}
				$config[$row['config_id']] = $val;
			}	
		}

		// UPDATE DATABASE IF NO ERRORS
		if (count($r_error)==0)
		{
			while (list($id,$val)=each($config))
			{
				$sql = 'UPDATE '.RATING_CONFIG_TABLE.' SET ';
				$sql .= ( in_array($id,$text_fields) ) ? 'text_value' : 'num_value';
				$sql .= ' = "'.$val.'" WHERE config_id = '.$id;
				if( !$result = $db->sql_query($sql) )
				{
					message_die(CRITICAL_ERROR, "Could not update rating configuration information", "", __LINE__, __FILE__, $sql);
				}

				// IF "FIRST POST ONLY" HAS CHANGED, RECALCULATE AFFECTED TOPIC AND USER RANKS
				if ( $id == 2 && $firstpostonly != $val )
				{
					// UPDATE AFFECTED TOPICS
					$sql = 'SELECT t.topic_id FROM '.RATING_TABLE.' r, '.POSTS_TABLE.' p, '.TOPICS_TABLE.' t WHERE r.post_id = p.post_id AND p.topic_id = t.topic_id AND t.topic_first_post_id != p.post_id GROUP BY t.topic_id';
					if( !$result = $db->sql_query($sql) )
					{
						message_die(CRITICAL_ERROR, "Could not get rating information", "", __LINE__, __FILE__, $sql);
					}
					elseif ( $db->sql_numrows($result) > 0 )
					{
						$topiclist = array();
						while ( $row = $db->sql_fetchrow($result) )
						{
							$topiclist[] = $row['topic_id'];
						}
						update_topic_rating($config[9], $topiclist);
					}
					// UPDATE AFFECTED USERS
					$sql = 'SELECT p.poster_id FROM '.RATING_TABLE.' r, '.POSTS_TABLE.' p, '.TOPICS_TABLE.' t WHERE r.post_id = p.post_id AND p.topic_id = t.topic_id AND t.topic_first_post_id != p.post_id GROUP BY p.poster_id';
					if( !$result = $db->sql_query($sql) )
					{
						message_die(CRITICAL_ERROR, "Could not get rating information", "", __LINE__, __FILE__, $sql);
					}
					elseif ( $db->sql_numrows($result) > 0 )
					{
						$userlist = array();
						while ( $row = $db->sql_fetchrow($result) )
						{
							$userlist[] = $row['poster_id'];
						}
						update_user_rating($config[10], $userlist);
					}
				}
			}
		}	
	}
	elseif ($_POST['r_submit'])
	{
		// ADD / UPDATE RATING OPTION
		list($key,$action) = each($_POST['r_submit']);

		// VALIDATE FIELDS
		$points = intval($_POST['r_option_1'][$key]);
		$label = trim(strip_tags($_POST['r_option_2'][$key]));
		$threshold = intval($_POST['r_option_3'][$key]);
		$who = $_POST['r_option_4'][$key];
		if ( !is_numeric($points) || $points < -127 || $points > 128 )
		{
			$r_error[1] = $lang['Invalid_point_value'];
		}
		if ( !empty($threshold) && ($threshold < 0 || $threshold > 30000) )
		{
			$r_error[3] = $lang['Invalid_threshold_value'];
		}

		// IF NO ERRORS, UPDATE DATABASE
		if ( empty($r_error) )
		{
			unset($r_option_0);
			unset($r_option_1);
			unset($r_option_2);
			unset($r_option_3);
			unset($r_option_4);
			if ( $key == 0 )
			{
				// ADD
				$sql = 'INSERT INTO '.RATING_OPTION_TABLE.' (points, label, weighting, user_type) VALUES ('.$points.', "'.$label.'", '.$threshold.', '.$who.')';
				if( !$result = $db->sql_query($sql) )
				{
					message_die(CRITICAL_ERROR, 'Could not add rating option', '', __LINE__, __FILE__, $sql);
				}
			}
			else
			{
				// UPDATE
				$sql = 'UPDATE '.RATING_OPTION_TABLE.' SET points = '.$points.', label = "'.$label.'", weighting = '.$threshold.', user_type = '.$who.' WHERE option_id = '.$key;
				if( !$result = $db->sql_query($sql) )
				{
					message_die(CRITICAL_ERROR, 'Could not update rating option', '', __LINE__, __FILE__, $sql);
				}
				$old_points = intval($r_option_0[$key]);
				if ( $points != $old_points )
				{
					// POINTS VALUE IS CHANGING, NEED TO CHECK AND UPDATE ALL AFFECTED RATINGS

					// POSTS
					$sql = 'SELECT post_id FROM '.RATING_TABLE.' WHERE option_id = '.$key.' GROUP BY post_id';
					if(!$result = $db->sql_query($sql))
					{
						message_die(CRITICAL_ERROR, 'Could not query rating information', '', __LINE__, __FILE__, $sql);
					}
					$postlist = array();
					while( $row = $db->sql_fetchrow($result) )
					{
						$postlist[] = $row['post_id'];
					}
					$db->sql_freeresult($result);
					// TOPICS
					$sql = 'SELECT p.topic_id FROM '.RATING_TABLE.' r, '.POSTS_TABLE.' p WHERE r.option_id = '.$key.' AND r.post_id = p.post_id GROUP BY p.topic_id';
					if(!$result = $db->sql_query($sql))
					{
						message_die(CRITICAL_ERROR, 'Could not query rating information', '', __LINE__, __FILE__, $sql);
					}
					$topiclist = array();
					while( $row = $db->sql_fetchrow($result) )
					{
						$topiclist[] = $row['topic_id'];
					}
					$db->sql_freeresult($result);
					// USERS
					$sql = 'SELECT p.poster_id FROM '.RATING_TABLE.' r, '.POSTS_TABLE.' p WHERE r.option_id = '.$key.' AND r.post_id = p.post_id GROUP BY p.poster_id';
					if(!$result = $db->sql_query($sql))
					{
						message_die(CRITICAL_ERROR, 'Could not query rating information', '', __LINE__, __FILE__, $sql);
					}
					$userlist = array();
					while( $row = $db->sql_fetchrow($result) )
					{
							$userlist[] = $row['poster_id'];
					}
					$db->sql_freeresult($result);

					$rating_config = get_rating_config('8,9,10');

					// UPDATE AFFECTED RATINGS
					if ( count($postlist) > 0 )
					{
						update_post_rating($rating_config[8], $postlist);
					}
					if ( count($topiclist) > 0 )
					{
						update_topic_rating($rating_config[9], $topiclist);
					}
					if ( count($userlist) > 0 )
					{
						update_user_rating($rating_config[10], $userlist);
					}
				}
			}
		}
	}
	elseif ($_POST['r_delete'])
	{
		// DELETE RATING OPTION
		list($key,$action) = each($_POST['r_delete']);

		$used = $_POST['r_option_5'][$key];
		if ( $used > 0 )
		{
			// OPTION HAS ALREADY BEEN USED, NEED TO CHECK AND UPDATE ALL AFFECTED RATINGS
			// POSTS
			$sql = 'SELECT post_id FROM '.RATING_TABLE.' WHERE option_id = '.$key.' GROUP BY post_id';
			if(!$result = $db->sql_query($sql))
			{
				message_die(CRITICAL_ERROR, 'Could not query rating information', '', __LINE__, __FILE__, $sql);
			}
			$postlist = array();
			while( $row = $db->sql_fetchrow($result) )
			{
				$postlist[] = $row['post_id'];
			}
			$db->sql_freeresult($result);
			// TOPICS
			$sql = 'SELECT p.topic_id FROM '.RATING_TABLE.' r, '.POSTS_TABLE.' p WHERE r.option_id = '.$key.' AND r.post_id = p.post_id GROUP BY p.topic_id';
			if(!$result = $db->sql_query($sql))
			{
				message_die(CRITICAL_ERROR, 'Could not query rating information', '', __LINE__, __FILE__, $sql);
			}
			$topiclist = array();
			while( $row = $db->sql_fetchrow($result) )
			{
				$topiclist[] = $row['topic_id'];
			}
			$db->sql_freeresult($result);
			// USERS
			$sql = 'SELECT p.poster_id FROM '.RATING_TABLE.' r, '.POSTS_TABLE.' p WHERE r.option_id = '.$key.' AND r.post_id = p.post_id GROUP BY p.poster_id';
			if(!$result = $db->sql_query($sql))
			{
				message_die(CRITICAL_ERROR, 'Could not query rating information', '', __LINE__, __FILE__, $sql);
			}
			$userlist = array();
			while( $row = $db->sql_fetchrow($result) )
			{
				$userlist[] = $row['poster_id'];
			}
			$db->sql_freeresult($result);

			$rating_config = get_rating_config('8,9,10');


			// Must delete ratings that no longer have corresponding entry in rating option table, BEFORE recalculating ranks
			$sql = 'DELETE FROM '.RATING_TABLE.' WHERE option_id = '.$key;
			if(!$result = $db->sql_query($sql))
			{
				message_die(CRITICAL_ERROR, 'Could not delete ratings', '', __LINE__, __FILE__, $sql);
			}

			// MUST DELETE BIAS SETTINGS THAT NO LONGER HAVE CORRESPONDING ENTRY IN RATING OPTION TABLE
			$sql = 'DELETE FROM '.RATING_BIAS_TABLE.' WHERE option_id = '.$key;
			if(!$result = $db->sql_query($sql))
			{
				message_die(CRITICAL_ERROR, 'Could not delete bias settings', '', __LINE__, __FILE__, $sql);
			}
		}

		$sql = 'DELETE FROM '.RATING_OPTION_TABLE.' WHERE option_id = '.$key;
		if(!$result = $db->sql_query($sql))
		{
			message_die(CRITICAL_ERROR, 'Could not delete rating option', '', __LINE__, __FILE__, $sql);
		}

		// UPDATE AFFECTED RATINGS
		if ( count($postlist) > 0 )
		{
			update_post_rating($rating_config[8], $postlist);
		}
		if ( count($topiclist) > 0 )
		{
			update_topic_rating($rating_config[9], $topiclist);
		}
		if ( count($userlist) > 0 )
		{
			update_user_rating($rating_config[10], $userlist);
		}
	}
	// ADDING / UPDATING TOTAL ENTRY
	elseif ($_POST['t_submit'])
	{
		// ADD / UPDATE RATING TOTAL
		list($key,$action) = each($_POST['t_submit']);
		// VALIDATE FIELDS
		$type = intval($_POST['r_total_1'][$key]);
		$average = intval($_POST['r_total_2'][$key]);
		$sum = intval($_POST['r_total_3'][$key]);
		$label = trim(strip_tags($_POST['r_total_4'][$key]));
		$icon = trim(strip_tags($_POST['r_total_5'][$key]));
		$urank = intval($_POST['r_total_6'][$key]);
		if (!is_numeric($average) || $average < -127 || $average > 128)
		{
			$t_error[2] = $lang['Invalid_average_threshold'];
		}
		if (!empty($sum) && ($sum < -2000000000 || $sum > 2000000000))
		{
			$t_error[3] = $lang['Invalid_sum_threshold'];
		}

		// IF NO ERRORS, UPDATE DATABASE
		if (empty($t_error))
		{
			unset($r_total_0);
			unset($r_total_1);
			unset($r_total_2);
			unset($r_total_3);
			unset($r_total_4);
			unset($r_total_5);
			unset($r_total_6);
			if ($key == 0)
			{
				// ADD
				$sql = 'INSERT INTO '.RATING_RANK_TABLE.' (type, average_threshold, sum_threshold, label, icon, user_rank) VALUES ('.$type.', '.$average.', '.$sum.', "'.$label.'", "'.$icon.'", '.$urank.')';
				if(!$result = $db->sql_query($sql))
				{
					message_die(CRITICAL_ERROR, 'Could not add rating total', '', __LINE__, __FILE__, $sql);
				}
			}
			else
			{
				// CHECK EXISTING VALUES
				$sql = 'SELECT type, average_threshold, sum_threshold FROM '.RATING_RANK_TABLE.' WHERE rating_rank_id = '.$key;
				if(!$result = $db->sql_query($sql))
				{
					message_die(CRITICAL_ERROR, 'Could not check rating total information', '', __LINE__, __FILE__, $sql);
				}
				$row = $db->sql_fetchrow($result);
				$old_type = $row['type'];
				$old_sum = $row['sum_threshold'];
				$old_avg = $row['average_threshold'];

				// UPDATE
				$sql = 'UPDATE '.RATING_RANK_TABLE.' SET type = '.$type.', average_threshold = '.$average.', sum_threshold = '.$sum.', label = "'.$label.'", icon = "'.$icon.'", user_rank = '.$urank.' WHERE rating_rank_id = '.$key;
				if(!$result = $db->sql_query($sql))
				{
					message_die(CRITICAL_ERROR, 'Could not update rating total', '', __LINE__, __FILE__, $sql);
				}

				$rating_config = get_rating_config('8,9,10');

				// NOTE: IF TYPE OR THRESHOLD VALUES ARE CHANGING, NEED TO CHECK AND UPDATE ALL AFFECTED RATINGS
				if ( $type != $old_type )
				{
					update_post_rating($rating_config[8]);
					update_topic_rating($rating_config[9]);
					update_user_rating($rating_config[10]);
				}
				elseif ( $sum != $old_sum )
				{
					if ( $type == 5 && $rating_config[8] == 1 )
					{
						update_post_rating($rating_config[8]);
					}
					elseif ( $type == 4 && $rating_config[9] == 1 )
					{
						update_topic_rating($rating_config[9]);
					}
					elseif ( $type == 3 && $rating_config[10] == 1 )
					{
						update_user_rating($rating_config[10]);
					}
				}
				elseif ( $average != $old_avg )
				{
					if ( $type == 5 && $rating_config[8] == 2 )
					{
						update_post_rating($rating_config[8]);
					}
					elseif ( $type == 4 && $rating_config[9] == 2 )
					{
						update_topic_rating($rating_config[9]);
					}
					elseif ( $type == 3 && $rating_config[10] == 2 )
					{
						update_user_rating($rating_config[10]);
					}
				}
			}
		}
	}
	elseif ($_POST['t_delete'])
	{
		list($key,$action) = each($_POST['t_delete']);

		// NOTE: IF OPTION IN USE, NEED TO CHECK AND UPDATE ALL AFFECTED RATINGS
		if ( $type == 5 )
		{
			$usql = 'SELECT post_id FROM '.POSTS_TABLE.' WHERE rating_rank_id = '.$key;
			if(!$uresult = $db->sql_query($usql))
			{
				message_die(CRITICAL_ERROR, 'Could not get post data', '', __LINE__, __FILE__, $usql);
			}
			$postlist = array();
			while( $urow = $db->sql_fetchrow($uresult) )
			{
				$postlist[] = $urow['post_id'];
			}
			$db->sql_freeresult($uresult);

		$rating_config = get_rating_config('8');
			update_post_rating($rating_config[8], $postlist);
		}
		elseif ( $type == 4 )
		{
			$usql = 'SELECT topic_id FROM '.TOPICS_TABLE.' WHERE rating_rank_id = '.$key;
			if(!$uresult = $db->sql_query($usql))
			{
				message_die(CRITICAL_ERROR, 'Could not get topic data', '', __LINE__, __FILE__, $usql);
			}
			$topiclist = array();
			while( $urow = $db->sql_fetchrow($uresult) )
			{
				$topiclist[] = $urow['topic_id'];
			}
			$db->sql_freeresult($uresult);
		$rating_config = get_rating_config('9');
			update_topic_rating($rating_config[9], $topiclist);
		}
		elseif ( $type == 3 )
		{
			$usql = 'SELECT user_id FROM '.USERS_TABLE.' WHERE user_rank = '.$r_total_6[$key];
			if(!$uresult = $db->sql_query($usql))
			{
				message_die(CRITICAL_ERROR, 'Could not get user data', '', __LINE__, __FILE__, $usql);
			}
			$userlist = array();
			while( $urow = $db->sql_fetchrow($uresult) )
			{
				$userlist[] = $urow['user_id'];
			}
			$db->sql_freeresult($uresult);
			$rating_config = get_rating_config('10');
			update_user_rating($rating_config[10], $userlist);
		}

		// DELETING TOTAL ENTRY
		$sql = 'DELETE FROM '.RATING_RANK_TABLE.' WHERE rating_rank_id = '.$key;
		if(!$result = $db->sql_query($sql))
		{
			message_die(CRITICAL_ERROR, 'Could not delete rating total', '', __LINE__, __FILE__, $sql);
		}
	}
	elseif ( isset($_POST['recalculate']) )
	{
		$rating_config = get_rating_config('8,9,10');
		update_post_rating($rating_config[8]);
		update_topic_rating($rating_config[9]);
		update_user_rating($rating_config[10]);
	}
}


// Load templates
$template->set_filenames(array(
	'body' => 'admin/rating_config_body.tpl')
);


	// Start:A update for ratings, added laungage var to admin Michaelo #1 09/07/06 //
	global $userdata;
	include('./../language/lang_' . $lang_dir = $userdata['user_lang'] . '/lang_rating.'.$phpEx); 
	// End:A update for ratings, added laungage var to admin Michaelo #1 09/07/06 //

	// First time load, show config screen
	$sql = 'SELECT config_id, label, num_value, text_value, input_type FROM '.RATING_CONFIG_TABLE.' 
	 ORDER BY list_order';
	if(!$result = $db->sql_query($sql))
	{
		message_die(CRITICAL_ERROR, "Could not query rating configuration information", "", __LINE__, __FILE__, $sql);
	}
	else
	{
		while( $row = $db->sql_fetchrow($result) )
		{
			$id = $row['config_id'];
			
			// Start:B update for ratings, added laungage var to admin Michaelo #1 09/07/06 //
			$label_h = $row['label']; 
			$label = $lang[$label_h];   
			// End:B update for ratings, added laungage var to admin Michaelo #1 09/07/06 //
			
			$rowcss = ($rowcss == 'row1') ? 'row2' : 'row1';
			// SET FORM ELEMENT
			$input = '';
			$input_properties = ' name="config['.$id.']" id="config'.$id.'"';
			switch ($id)
			{
//				case 1:
//					$input_properties .= ' onChange="RatingOnOff(this.value);">';
//					break;
				case 2:
					$input_properties .= '>';
					$input .= '<input type="hidden" name="firstpostonly" value="'.$row['num_value'].'">';
					break;
				case 3:
//					$input_properties .= ' onChange="WeightingOnOff(this.value);">';
					$input_properties .= '>';
					$select_options = array(0=>$lang['None'], 1=>$lang['Weighting_method_posts']);
					break;
//				case 6:
//					$input_properties .= ' onChange="ActivateElement(\'config7\',this.value);">';
//					break;
				case 8:
					$select_options = array(1=>$lang['Rating_sum'], 2=>$lang['Rating_average']);
					$input_properties .= '>';
					break;
				case 9:
					$select_options = array(1=>$lang['Rating_sum'], 2=>$lang['Rating_average'], 3=>$lang['Rating_max']);
					$input_properties .= '>';
					break;
				case 10:
					$select_options = array(1=>$lang['Rating_sum'], 2=>$lang['Rating_average']);
					$input_properties .= '>';
					break;
				case 12:
					// CHECK IF USER ALLOWED TO VIEW / UPDATE CONFIG
					if( $userdata['user_level'] != ADMIN )
					{
						if ( $row['num_value'] == 0 )
						{
							message_die(GENERAL_MESSAGE, $lang['Not_Authorised']);
						}
						else
						{
							$rating_view_only = 1;
						}
					}
					break;
				case 17:
					$select_options = array(0=>$lang['No'], 1=>$lang['Rating_buddies_only'], 2=>$lang['Rating_ignores_only'], 3=>$lang['Yes']);
					$input_properties .= '>';
					break;
				default:
					$input_properties .= '>';
					break;
			}

			switch ($row['input_type'])
			{
				case 2:
				// NUMBER
					$input .= '<input type="text" value="'.$row['num_value'].'" size="5"';
					break;
				case 3:
				// DROPDOWN, YES/NO UNLESS OTHERWISE SPECIFIED
					$select_options = (empty($select_options)) ? array(0=>$lang['No'], 1=>$lang['Yes']) : $select_options;
					$input .= '<select';
					// MARK CURRENT VALUE AS 'SELECTED'
					$thisval = $row['num_value'];
					while (list($key,$val)=each($select_options))
					{
						$option = '<option value="'.$key.'"';
						$option .= ($key == $thisval) ? ' SELECTED>' : '>';
						$option .= $val.'</option>';
						$input_properties .= $option;
					}
					$input_properties .= '</select>';
					unset ($select_options);
					break;
				default:
				// TEXTBOX
					$input .= '<input type="text" value="'.$row['text_value'].'"';
			}
			$input .= $input_properties;
			
			$template->assign_block_vars('config', array(
				'ID' => $id,
				'LABEL' => $label,
				'ROWCSS' => $rowcss,
				'INPUT' => $input
				)
			);
		}
	}

	// RATING OPTIONS
	$user_types = array(1 => $lang['Rating_user_type_all'], 2=>$lang['Rating_user_type_mods'], 3=>$lang['Rating_user_type_forum'], 4=>$lang['Rating_user_type_admin']);

	$sql = 'SELECT option_id, points, label, weighting, user_type FROM '.RATING_OPTION_TABLE.' 
	 ORDER BY points DESC';
	if(!$result = $db->sql_query($sql))
	{
		message_die(CRITICAL_ERROR, "Could not query rating system information", "", __LINE__, __FILE__, $sql);
	}
	else
	{
		// GET TOTAL TIMES EACH OPTION HAS BEEN USED TO DATE
		$sql2 = 'SELECT option_id, count(*) AS num FROM '.RATING_TABLE.' GROUP BY option_id';
		if(!$result2 = $db->sql_query($sql2))
		{
			message_die(CRITICAL_ERROR, "Could not query rating information", "", __LINE__, __FILE__, $sql);
		}
		$option_used = array();
		while( $row2 = $db->sql_fetchrow($result2) )
		{
			$option_used[$row2['option_id']] = $row2['num'];
		}

		// EACH EXISTING RATING ENTRY
		while( $row = $db->sql_fetchrow($result) )
		{
			$id = $row['option_id'];
			$points = $row['points'];
			$label = $row['label'];
			$threshold = $row['weighting'];
			$used = $option_used[$row['option_id']];
			$rowcss = ( $rowcss == 'row1' ) ? 'row2' : 'row1';
			if ( $rating_view_only == 1 )
			{
				$delete = '';
				$option_submit = '';
			}
			else
			{
				$delete = '<input type="submit" name="r_delete['.$id.']" value="'.$lang['Rating_delete'].'"';
				$delete .= ( $used > 0 ) ? ' onclick = "return confirm(\''.$lang['Rating_remove_confirm'].'\')">' : '>';
				$option_submit =  '<input type="submit" name="r_submit['.$id.']" value="'.$lang['Rating_update'].'">';
			}
			$template->assign_block_vars('option', array(
				'ID' => $id,
				'POINTS' => $points,
				'LABEL' => $label,
				'DELETE' => $delete,
				'THRESHOLD' => $threshold,
				'USED' => $used,
				'SUBMIT' => $option_submit,
				'ROWCSS' => $rowcss
				)
			);

			// GENERATE SELECT BOX OPTIONS FOR USER_TYPE
			//$template->assign_block_vars('option.who', array(
			//	'ID' => 0,
			//	'SELECTED' => '',
			//	'LABEL' => 'Choose one'
			//	)
			//);
			$user_type = $row['user_type'];
			reset ($user_types);
			while (list($key,$val) = each($user_types))
			{
				$selected = ($key == $user_type) ? 'SELECTED' : '';
				$template->assign_block_vars('option.who', array(
					'ID' => $key,
					'SELECTED' => $selected,
					'LABEL' => $val
					)
				);
			}
		}
		$option_submit = ( $rating_view_only == 1 ) ? '' : '<input type="submit" name="r_submit[0]" value="Add">';
		// BLANK LINE FOR ADDING RATING OPTION
		$template->assign_block_vars('option', array(
			'ID' => 0,
			'POINTS' => $r_option_1[0],
			'LABEL' => stripslashes($r_option_2[0]),
			'THRESHOLD' => $r_option_3[0],
			'SUBMIT' => $option_submit,
			'ROWCSS' => 'row3'
			)
		);
		reset ($user_types);
		while (list($key,$val) = each($user_types))
		{
			$selected = ($key == $r_option_4[0]) ? 'SELECTED' : '';
			$template->assign_block_vars('option.who', array(
				'ID' => $key,
				'SELECTED' => $selected,
				'LABEL' => $val
				)
			);
		}
	}
	//}	

	if (!empty($r_error))
	{
		$error_report = '<p class="gen">There were some problems with the information you submitted. Please read the messages below, make the necessary changes and re-submit:</p>';
		$o_errors .= '<ul class="err">';
		while (list($key,$msg)=each($r_error))
		{
			$o_errors .= '<li>'.$msg.'</li>';
		}
		$o_errors .= '</ul></p>';
	}


	// RATING TOTALS - TOPICS/POSTS
	$total_types = array(4=>'Topics', 5=>'Posts');

	$sql = 'SELECT rating_rank_id, type, average_threshold, sum_threshold, label, icon FROM '.RATING_RANK_TABLE.' WHERE type IN (2,4,5)
	 ORDER BY type, sum_threshold DESC, average_threshold DESC';
	if(!$result = $db->sql_query($sql))
	{
		message_die(CRITICAL_ERROR, "Could not query rating total information", "", __LINE__, __FILE__, $sql);
	}
	else
	{
		// EACH EXISTING RATING ENTRY
		while( $row = $db->sql_fetchrow($result) )
		{
			$id = $row['rating_rank_id'];
			$label = $row['label'];
			$icon = $row['icon'];
			$average = $row['average_threshold'];
			$sum = $row['sum_threshold'];
			$rowcss = ($rowcss == 'row1') ? 'row2' : 'row1';
			if ( $rating_view_only == 1 )
			{
				$delete = '';
				$total_submit = '';
			}
			else
			{
				$total_submit = '<input type="submit" name="t_submit['.$id.']" value="Update">';
				$delete = '<input type="submit" name="t_delete['.$id.']" value="Delete" onclick = "return confirm(\''.$lang['Rating_recalc_confirm'].'\')">';
			}
			$template->assign_block_vars('total', array(
				'ID' => $id,
				'AVERAGE' => $average,
				'SUM' => $sum,
				'ICON' => $icon,
				'LABEL' => $label,
				'DELETE' => $delete,
				'SUBMIT' => $total_submit,
				'ROWCSS' => $rowcss
				)
			);

			// GENERATE SELECT BOX OPTIONS FOR USER_TYPE
			//$template->assign_block_vars('option.who', array(
			//	'ID' => 0,
			//	'SELECTED' => '',
			//	'LABEL' => 'Choose one'
			//	)
			//);
			$total_type = $row['type'];
			reset ($total_types);
			while (list($key,$val) = each($total_types))
			{
				$selected = ($key == $total_type) ? 'SELECTED' : '';
				$template->assign_block_vars('total.type', array(
					'ID' => $key,
					'SELECTED' => $selected,
					'LABEL' => $val
					)
				);
			}
		}
		$total_submit = ( $rating_view_only == 1 ) ? '' : '<input type="submit" name="t_submit[0]" value="'.$lang['Rating_add'].'">';
		// BLANK LINE FOR ADDING RATING TOTAL ENTRY
		$template->assign_block_vars('total', array(
			'ID' => 0,
			'AVERAGE' => $r_total_2[0],
			'SUM' => $r_total_3[0],
			'LABEL' => stripslashes($r_total_4[0]),
			'ICON' => stripslashes($r_total_5[0]),
			'SUBMIT' => $total_submit,
			'ROWCSS' => 'row3'
			)
		);
		reset ($total_types);
		while (list($key,$val) = each($total_types))
		{
			$selected = ($key == $r_total_1[0]) ? 'SELECTED' : '';
			$template->assign_block_vars('total.type', array(
				'ID' => $key,
				'SELECTED' => $selected,
				'LABEL' => $val
				)
			);
		}
	}
	//}	

	// RATING TOTALS - USERS
	$user_ranks = array(0 => '');

	// GET LIST OF MAIN PHPBB RANKS
	$sql = 'SELECT rank_id, rank_title FROM '.RANKS_TABLE.' WHERE rank_special = 1 ORDER BY rank_min';
	if(!$result = $db->sql_query($sql))
	{
		message_die(CRITICAL_ERROR, "Could not query user rank information", "", __LINE__, __FILE__, $sql);
	}
	else
	{
		// EACH EXISTING RATING ENTRY
		while( $row = $db->sql_fetchrow($result) )
		{
			$user_ranks[$row['rank_id']] = $row['rank_title'];
		}
	}
	
	$sql = 'SELECT rating_rank_id, user_rank, average_threshold, sum_threshold FROM '.RATING_RANK_TABLE.' WHERE type = 3
	 ORDER BY type, sum_threshold DESC, average_threshold DESC';
	if(!$result = $db->sql_query($sql))
	{
		message_die(CRITICAL_ERROR, "Could not query rating total information", "", __LINE__, __FILE__, $sql);
	}
	else
	{
		// EACH EXISTING RATING ENTRY
		while( $row = $db->sql_fetchrow($result) )
		{
			$id = $row['rating_rank_id'];
			$average = $row['average_threshold'];
			$sum = $row['sum_threshold'];
			$rowcss = ($rowcss == 'row1') ? 'row2' : 'row1';
			if ( $rating_view_only == 1 )
			{
				$delete = '';
				$total_submit = '';
			}
			else
			{
				$total_submit = '<input type="submit" name="t_submit['.$id.']" value="Update">';
				$delete = '<input type="submit" name="t_delete['.$id.']" value="Delete" onclick = "return confirm(\''.$lang['Rating_recalc_confirm'].'\')">';
			}
			$template->assign_block_vars('user', array(
				'ID' => $id,
				'AVERAGE' => $average,
				'SUM' => $sum,
				'DELETE' => $delete,
				'SUBMIT' => $total_submit,
				'ROWCSS' => $rowcss
				)
			);

			foreach($user_ranks as $key => $val)
			{
				$selected = ($key == $row['user_rank']) ? 'SELECTED' : '';
				$template->assign_block_vars('user.rank', array(
					'ID' => $key,
					'SELECTED' => $selected,
					'LABEL' => $val
					)
				);
			}
		}
		$total_submit = ( $rating_view_only == 1 ) ? '' : '<input type="submit" name="t_submit[0]" value="'.$lang['Rating_add'].'">';
		// BLANK LINE FOR ADDING RATING TOTAL ENTRY
		$template->assign_block_vars('user', array(
			'ID' => 0,
			'AVERAGE' => $r_total_2[0],
			'SUM' => $r_total_3[0],
			'SUBMIT' => $total_submit,
			'ROWCSS' => 'row3'
			)
		);
		foreach($user_ranks as $key => $val)
		{
			$selected = ($key == $r_total_1[0]) ? 'SELECTED' : '';
			$template->assign_block_vars('user.rank', array(
				'ID' => $key,
				'SELECTED' => $selected,
				'LABEL' => $val
				)
			);
		}
	}
	//}	

	if (!empty($t_error))
	{
		$error_report = '<p class="gen">'.$lang['Rating_admin_errors'].'</p>';
		$t_errors .= '<ul class="err">';
		while (list($key,$msg)=each($t_error))
		{
			$t_errors .= '<li>'.$msg.'</li>';
		}
		$t_errors .= '</ul></p>';
	}

	$config_submit = ($rating_view_only == 1) ? '' : '<input type="submit" name="submit" value="'.$lang['Rating_update_config'].'">';

	$template->assign_vars(array(
		'FORM_ACTION' => append_sid('admin_rating.'.$phpEx),
		'CONFIG_SUBMIT' => $config_submit,
		'ERROR_REPORT' => $error_report,
		'GENERAL_ERRORS' => $g_errors,
		'OPTION_ERRORS' => $o_errors,
		'TOTAL_ERRORS' => $t_errors,
		'USER_ERRORS' => $u_errors,
		'HEADING' => $lang['Rating_admin_page_title'],
		'L_GENERAL_CONFIGURATION' => $lang['Rating_config_gen'],
		'L_OVERVIEW_TEXT' => $lang['Rating_overview_text'],
		'L_OVERALL_SETTINGS_TITLE' => $lang['Rating_settings_title'],
		'L_OVERALL_SETTINGS_TEXT' => $lang['Rating_settings_text'],
		'L_RATING_OPTIONS' => $lang['Rating_options'],
		'L_POINTS' => $lang['Points'],
		'L_LABEL' => $lang['Rating_label'],
		'L_WEIGHTING_THRESHOLD' => $lang['Weighting_threshold'],
		'L_BOARD_RANK' => $lang['Board_rank'],
		'L_WHO' => $lang['Rating_who'],
		'L_USED' => $lang['Rating_used'],
		'L_DELETE' => $lang['Rating_delete'],
		'L_UPDATE' => $lang['Rating_update'],
		'L_RECALC_TEXT' => $lang['Recalc_text'],
		'L_RECALC_BUTTON' => $lang['Recalc_button'],
		'L_RECALC_CONFIRM' => $lang['Recalc_confirm'],
		'L_OPTION_TITLE' => $lang['Rating_option_title'],
		'L_OPTION_TEXT' => $lang['Rating_option_text'],
		'L_RATING_RANKS' => $lang['Rating_ranks'],
		'L_USER_RANKS_TITLE' => $lang['User_ranks_title'],
		'L_APPLIES_TO' => $lang['Rating_applies_to'],
		'L_SUM' => $lang['Rating_sum'],
		'L_AVERAGE' => $lang['Rating_average'],
		'L_ICON' => $lang['Rating_icon'],
		'L_RANK_TITLE' => $lang['Rating_rank_title'],
		'L_RANK_TEXT' => $lang['Rating_rank_text'],
		)
	);


$template->pparse("body");

include('./page_footer_admin.'.$phpEx);
?>
