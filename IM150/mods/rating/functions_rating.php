<?php
/***************************************************************************
 *                              functions_rating.php v1.1.0
 *                            -------------------
 *   begin                : Friday, Jan 17, 2003
 *   copyright            : (C) 2002 Web Centre Ltd
 *   email                : phpbb@mywebcommunities.com
 *
 *   v1.1.0 19th May 2003
 *   - Added TEMP_TABLE and BIAS_TABLE definitions
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

define('RATING_TABLE', $table_prefix.'rating');
define('RATING_CONFIG_TABLE', $table_prefix.'rating_config');
define('RATING_OPTION_TABLE', $table_prefix.'rating_option');
define('RATING_RANK_TABLE', $table_prefix.'rating_rank');
define('RATING_TEMP_TABLE', $table_prefix.'rating_temp');
define('RATING_BIAS_TABLE', $table_prefix.'rating_bias');

// LANGUAGE VARS
$l_viewtopic_rating_label = 'Rating:&nbsp;';
$l_viewtopic_norating_label = 'No rating';

function get_rating_config($idlist='')
{
	global $db;
	// GET RATING CONFIGURATION
	$sql = 'SELECT config_id, num_value, text_value, input_type FROM '.RATING_CONFIG_TABLE;
	$sql .= ( !empty($idlist) ) ? ' WHERE config_id IN ('.$idlist.')' : '';
	$sql .= ' ORDER BY config_id';
	if( !($result = $db->sql_query($sql)) )
	{
		message_die(CRITICAL_ERROR, "Could not query rating configuration information", "", __LINE__, __FILE__, $sql);
	}

	// PUT CONFIG SETTINGS INTO ARRAY
	$config_set = array();
	while( $row = $db->sql_fetchrow($result) )
	{
		$val = ($row['input_type'] == 4) ? $row['text_value'] : $row['num_value'];
		$config_set[$row['config_id']] = $val;
	}
	$db->sql_freeresult($result);
	return $config_set;
}


function get_rating_ranks()
{
	global $db, $topic_rank_set;
	// BUILD ARRAYS OF OVERALL RATING CAPTIONS
	$sql = 'SELECT rating_rank_id, type, average_threshold, sum_threshold, label, icon FROM '.RATING_RANK_TABLE;
	if( !($result = $db->sql_query($sql)) )
	{
		message_die(CRITICAL_ERROR, "Could not query rating total information", "", __LINE__, __FILE__, $sql);
	}
	$post_rank_set = array();
	$topic_rank_set = array();
	$user_rank_set = array();
	while ($row = $db->sql_fetchrow($result))
	{
		$id = $row['rating_rank_id'];
		$caption = ( !empty($row['label']) ) ? $row['label'] : '';
		$caption = ( !empty($row['icon']) ) ? '<img border="0" src="'.RATING_PATH.'images/'.$row['icon'].'" alt="'.$caption.'">' : $caption;
		if ( $row['type'] == 1 || $row['type'] == 2 || $row['type'] == 5 )
		{
			// THIS RANK APPLIES TO POSTS
			$p_rank = ( $config_set[8] == 1 ) ? $row['sum_threshold'].'+' : $row['average_threshold'];
			$p_caption = ( !empty($caption) ) ? $caption : $p_rank;
			$post_rank_set[$id] = $p_caption;
		}
		if ( $row['type'] == 1 || $row['type'] == 2 || $row['type'] == 4)
		{
			// THIS RANK APPLIES TO TOPICS
			$t_rank = ( $config_set[9] == 1 ) ? $row['sum_threshold'].'+' : $row['average_threshold'];
			$t_caption = ( !empty($caption) ) ? $caption : $t_rank;
			$topic_rank_set[$id] = $t_caption;
		}
		if ( $row['type'] == 1 || $row['type'] == 3)
		{
			// THIS RANK APPLIES TO USERS
			$u_rank = ( $config_set[10] == 1 ) ? $row['sum_threshold'].'+' : $row['average_threshold'];
			$u_caption = ( !empty($caption) ) ? $caption : $u_rank;
			$user_rank_set[$id] = $u_caption;
		}
	}
	$GLOBALS['post_rank_set'] = $post_rank_set;
	$GLOBALS['topic_rank_set'] = $topic_rank_set;
	$GLOBALS['user_rank_set'] = $user_rank_set;
	$db->sql_freeresult($result);
}

?>