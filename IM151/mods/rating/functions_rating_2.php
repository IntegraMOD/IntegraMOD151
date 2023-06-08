<?php
/***************************************************************************
 *                              functions_rating_2.php
 *                            -------------------
 *   begin                : Friday, Jan 17, 2003
 *   copyright            : (C) 2002 Web Centre Ltd
 *   email                : phpbb@mywebcommunities.com
 *
 *   MODIFICATION HISTORY
 *   v1.1.0 19th May 2003
 *   - Added 'Total (1 per user)' method to topic_rating
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

function update_post_rating($method, $postlist='')
{
	global $db;
	// UPDATE POST RATINGS

	// GENERATE APPROPRIATE SQL

	// IF NOT UPDATING ALL POSTS, ADD POST LIST TO WHERE CLAUSE
	if ( is_array($postlist) )
	{
		list($key,$id) = each($postlist);
		$in_list = $id;
		while (list($key,$id) = each($postlist))
		{
			$in_list .= ', '.$id;
		}
	}

	// FIRST PASS - SET RANK TO 0 WHERE ALL RATINGS HAVE BEEN DELETED
	$sql = 'SELECT p.post_id, count(r.option_id) AS ratings FROM '.POSTS_TABLE.' p';
	$sql_where = ' WHERE p.rating_rank_id != 0';
	$sql_where .= ( !empty($in_list) ) ? ' AND p.post_id IN ('.$in_list.')' : '';
	switch (SQL_LAYER) 
	{ 
		case 'oracle': 
			$sql .= ', '.RATING_TABLE.' r';
			$sql_where .= ' AND p.post_id = r.post_id(+)';
			break; 

		default: 
			$sql .= ' LEFT JOIN '.RATING_TABLE.' r ON p.post_id = r.post_id';
	}
	$sql .= $sql_where.' GROUP BY p.post_id HAVING ratings = 0';
	if( !($result = $db->sql_query($sql)) )
	{
		message_die(CRITICAL_ERROR, 'Could not query post rating information', '', __LINE__, __FILE__, $sql);
	}
	elseif ( $db->sql_numrows($result) > 0 )
	{
		// BUILD ID LIST AND SET RATING TOTAL TO 0
		$row = $db->sql_fetchrow($result);
		$zero_list = '('.$row['post_id'];
		while ( $row = $db->sql_fetchrow($result) )
		{
			$zero_list .= ','.$row['post_id'];
		}
		$zero_list .= ')';
		$sql2 = 'UPDATE '.POSTS_TABLE.' SET rating_rank_id = 0 WHERE post_id IN '.$zero_list;
		if( !($result2 = $db->sql_query($sql2)) )
		{
			message_die(CRITICAL_ERROR, 'Could not update rating totals', '', __LINE__, __FILE__, $sql2);
		}
	}

	// SECOND PASS - UPDATE WHERE CHANGED RATINGS AFFECT RANK
	$sql = 'SELECT p.post_id, p.rating_rank_id, ';
	$sql .= ( $method == 1 ) ? 'SUM(o.points)' : 'AVG(o.points)';
	$sql .= ' AS total FROM '.POSTS_TABLE.' p, '.RATING_TABLE.' r, '.RATING_OPTION_TABLE.' o ';
	$sql_where = ' WHERE p.post_id = r.post_id AND r.option_id = o.option_id';
	$sql_where .= ( !empty($in_list) ) ? ' AND p.post_id IN ('.$in_list.')' : '';
	$sql .= $sql_where.' GROUP BY p.post_id';

	if( !($result = $db->sql_query($sql)) )
	{
		message_die(CRITICAL_ERROR, "Could not query post rating information", "", __LINE__, __FILE__, $sql);
	}
	else
	{
		// CALCULATE NEW RATING FOR EACH POST, UPDATE IF DIFFERENT FROM CURRENT
		while ( $row = $db->sql_fetchrow($result) )
		{
			$overall_rank = assign_rating_rank(intval($row['total']),'post',$method);

			// IF POST RATING HAS CHANGED, UPDATE IT
			if ( $overall_rank != $row['rating_rank_id'] )
			{
				$usql = 'UPDATE '.POSTS_TABLE.' SET rating_rank_id = '.$overall_rank.' WHERE post_id = '.$row['post_id'];
				if( !($uresult = $db->sql_query($usql)) )
				{
					message_die(CRITICAL_ERROR, "Could not update post information", "", __LINE__, __FILE__, $usql);
				}
			}
		}
	}
	$db->sql_freeresult($result);

	// NOTE: Neither first nor second pass will update correctly if record removed from rating_option table, but corresponding records left in rating table. However, rating_admin.php should have already deleted them.
}

function update_topic_rating($method, $topiclist='')
{
	// UPDATE TOPIC RATINGS
	global $db;

	// IF NOT UPDATING ALL TOPICS, GENERATE APPROPRIATE SQL
	if ( is_array($topiclist) )
	{
		list($key,$id) = each($topiclist);
		$in_list = $id;
		while (list($key,$id) = each($topiclist))
		{
			$in_list .= ', '.$id;
		}
	}

	// FIRST PASS - SET RANK TO 0 WHERE ALL RATINGS HAVE BEEN DELETED
	$sql = 'SELECT t.topic_id, count(r.option_id) AS ratings FROM '.TOPICS_TABLE.' t, '.POSTS_TABLE.' p';
	$sql_where = ' WHERE t.rating_rank_id != 0 AND t.topic_id = p.topic_id';
	$sql_where .= ( !empty($in_list) ) ? ' AND t.topic_id IN ('.$in_list.')' : '';
	switch (SQL_LAYER) 
	{ 
		case 'oracle': 
			$sql .= ', '.RATING_TABLE.' r';
			$sql_where .= ' AND p.post_id = r.post_id(+)';
			break; 

		default: 
			$sql .= ' LEFT JOIN '.RATING_TABLE.' r ON p.post_id = r.post_id';
	}
	$sql .= $sql_where.' GROUP BY t.topic_id HAVING ratings = 0';
	if( !($result = $db->sql_query($sql)) )
	{
		message_die(CRITICAL_ERROR, 'Could not query topic rating information', '', __LINE__, __FILE__, $sql);
	}
	elseif ( $db->sql_numrows($result) > 0 )
	{
		// BUILD ID LIST AND SET RATING TOTAL TO 0
		$row = $db->sql_fetchrow($result);
		$zero_list = '('.$row['topic_id'];
		while ( $row = $db->sql_fetchrow($result) )
		{
			$zero_list .= ','.$row['topic_id'];
		}
		$zero_list .= ')';
		$sql2 = 'UPDATE '.TOPICS_TABLE.' SET rating_rank_id = 0 WHERE topic_id IN '.$zero_list;
		if( !($result2 = $db->sql_query($sql2)) )
		{
			message_die(CRITICAL_ERROR, 'Could not update rating totals', '', __LINE__, __FILE__, $sql2);
		}
	}

	// SECOND PASS - UPDATE WHERE CHANGED RATINGS AFFECT RANK
	if ( $method == 3 )
	{
		// TOTAL OF HIGHEST POST RATING PER USER
		$sql = 'SELECT t.topic_id, t.rating_rank_id, MAX(o.points)';
		$sql .= ' AS total FROM '.TOPICS_TABLE.' t, '.POSTS_TABLE.' p, '.RATING_TABLE.' r, '.RATING_OPTION_TABLE.' o ';
		$sql_where = ' WHERE t.topic_id = p.topic_id AND p.post_id = r.post_id AND r.option_id = o.option_id';
		$sql_where .= ( !empty($in_list) ) ? ' AND t.topic_id IN ('.$in_list.')' : '';
		$sql .= $sql_where.' GROUP BY t.topic_id, r.user_id ORDER BY t.topic_id';
		if( !($result = $db->sql_query($sql)) )
		{
			message_die(CRITICAL_ERROR, "Could not query topic rating information", "", __LINE__, __FILE__, $sql);
		}
		else
		{
			$current_topic = 0;
			$topic_total = 0;
			// CALCULATE NEW RATING FOR EACH TOPIC, UPDATE IF DIFFERENT FROM CURRENT
			while ( $row = $db->sql_fetchrow($result) )
			{
				if ( $row['topic_id'] != $current_topic )
				{
					// STARTING NEW TOPIC
					if ( !empty($current_topic) )
					{
						// FINISH UPDATE FOR LAST TOPIC
						$overall_rank = assign_rating_rank($topic_total,'topic',1);
						// IF RATING HAS CHANGED, UPDATE IT
						if ( $overall_rank != $current_rank )
						{
							$usql = 'UPDATE '.TOPICS_TABLE.' SET rating_rank_id = '.$overall_rank.' WHERE topic_id = '.$current_topic;
							if( !($uresult = $db->sql_query($usql)) )
							{
								message_die(CRITICAL_ERROR, "Could not update topic information", "", __LINE__, __FILE__, $usql);
							}
						}
					}
					$current_topic = $row['topic_id'];
					$current_rank = $row['rating_rank_id'];
					$topic_total = $row['total'];
				}
				else
				{
					$topic_total += $row['total'];
				}
			}
			// FINISH UPDATE FOR LAST TOPIC
			if ( !empty($current_topic) )
			{
				// FINISH UPDATE FOR LAST TOPIC
				$overall_rank = assign_rating_rank($topic_total,'topic',1);
				// IF RATING HAS CHANGED, UPDATE IT
				if ( $overall_rank != $current_rank )
				{
					$usql = 'UPDATE '.TOPICS_TABLE.' SET rating_rank_id = '.$overall_rank.' WHERE topic_id = '.$current_topic;
					if( !($uresult = $db->sql_query($usql)) )
					{
						message_die(CRITICAL_ERROR, "Could not update topic information", "", __LINE__, __FILE__, $usql);
					}
				}
			}
		}	
	}
	else
	{
		$sql = 'SELECT t.topic_id, t.rating_rank_id, ';
		$sql .= ( $method == 1 ) ? 'SUM(o.points)' : 'AVG(o.points)';
		$sql .= ' AS total FROM '.TOPICS_TABLE.' t, '.POSTS_TABLE.' p, '.RATING_TABLE.' r, '.RATING_OPTION_TABLE.' o ';
		$sql_where = ' WHERE t.topic_id = p.topic_id AND p.post_id = r.post_id AND r.option_id = o.option_id';
		$sql_where .= ( !empty($in_list) ) ? ' AND t.topic_id IN ('.$in_list.')' : '';
		$sql .= $sql_where.' GROUP BY t.topic_id';
	
		if( !($result = $db->sql_query($sql)) )
		{
			message_die(CRITICAL_ERROR, "Could not query topic rating information", "", __LINE__, __FILE__, $sql);
		}
		else
		{
			// CALCULATE NEW RATING FOR EACH TOPIC, UPDATE IF DIFFERENT FROM CURRENT
			while ( $row = $db->sql_fetchrow($result) )
			{
				// IF NO RATINGS, SET RATING TOTAL TO ZERO
				$overall_rank = assign_rating_rank(intval($row['total']),'topic',$method);

				// IF RATING HAS CHANGED, UPDATE IT
				if ( $overall_rank != $row['rating_rank_id'] )
				{
					$usql = 'UPDATE '.TOPICS_TABLE.' SET rating_rank_id = '.$overall_rank.' WHERE topic_id = '.$row['topic_id'];
					if( !($uresult = $db->sql_query($usql)) )
					{
						message_die(CRITICAL_ERROR, "Could not update topic information", "", __LINE__, __FILE__, $usql);
					}
				}
			}
		}
	}
	$db->sql_freeresult($result);
}

function update_user_rating($method, $userlist='')
{
	// UPDATE USER RATINGS
	global $db;

	$sql_where = ' WHERE u.user_id = p.poster_id';

	// IF NOT UPDATING ALL USERS, GENERATE APPROPRIATE SQL
	if ( is_array($userlist) )
	{
		list($key,$id) = each($userlist);
		$in_list = $id;
		while (list($key,$id) = each($userlist))
		{
			$in_list .= ', '.$id;
		}
	}

	// IGNORE USERS WHO ALREADY HAVE A (NON-RATING) SPECIAL RANK
	$exclude_special_ranks = '';
	$rsql = 'SELECT * FROM '.RANKS_TABLE.' r';
	$rsql_where = ' WHERE rr.user_rank IS NULL AND r.rank_special = 1';
	switch (SQL_LAYER) 
	{ 
		case 'oracle': 
			$rsql .= ', '.RATING_RANK_TABLE.' rr';
			$rsql_where .= ' AND r.rank_id = rr.user_rank(+)';
			break; 

		default: 
			$rsql .= ' LEFT JOIN '.RATING_RANK_TABLE.' rr ON r.rank_id = rr.user_rank';
	}
	$rsql .= $rsql_where;
	if( !($result = $db->sql_query($rsql)) )
	{
		message_die(CRITICAL_ERROR, 'Could not query special rank information', '', __LINE__, __FILE__, $sql);
	}
	elseif ( $db->sql_numrows($result) > 0 )
	{
		// BUILD ID LIST AND SET RATING TOTAL TO 0
		$row = $db->sql_fetchrow($result);
		$special_rank_list = '('.$row['rank_id'];
		while ( $row = $db->sql_fetchrow($result) )
		{
			$special_rank_list .= ','.$row['rank_id'];
		}
		$special_rank_list .= ')';
		$exclude_special_ranks .= ' AND u.user_rank NOT IN '.$special_rank_list;
	}

	// FIRST PASS - SET RANK TO 0 WHERE ALL RATINGS HAVE BEEN DELETED
	$sql = 'SELECT u.user_id, count(r.option_id) AS ratings FROM '.USERS_TABLE.' u, '.POSTS_TABLE.' p';
	$sql_where .= ( !empty($in_list) ) ? ' AND u.user_id IN ('.$in_list.')' : '';
	switch (SQL_LAYER) 
	{ 
		case 'oracle': 
			$sql .= ', '.RATING_TABLE.' r';
			$sql_where .= ' AND p.post_id = r.post_id(+)';
			break;

		default: 
			$sql .= ' LEFT JOIN '.RATING_TABLE.' r ON p.post_id = r.post_id';
	}
	$sql_where .= $exclude_special_ranks;
	$sql .= $sql_where.' GROUP BY u.user_id HAVING ratings = 0';
	if( !($result = $db->sql_query($sql)) )
	{
		message_die(CRITICAL_ERROR, 'Could not query user rating information', '', __LINE__, __FILE__, $sql);
	}
	elseif ( $db->sql_numrows($result) > 0 )
	{
		// BUILD ID LIST AND SET RATING TOTAL TO 0
		$row = $db->sql_fetchrow($result);
		$zero_list = '('.$row['user_id'];
		while ( $row = $db->sql_fetchrow($result) )
		{
			$zero_list .= ','.$row['user_id'];
		}
		$zero_list .= ')';
		$sql2 = 'UPDATE '.USERS_TABLE.' SET user_rank = 0 WHERE user_id IN '.$zero_list; // SET ACCORDING TO POSTS
		if( !($result2 = $db->sql_query($sql2)) )
		{
			message_die(CRITICAL_ERROR, 'Could not update rating totals', '', __LINE__, __FILE__, $sql2);
		}
	}

	// SECOND PASS - UPDATE WHERE CHANGED RATINGS AFFECT RANK
	$sql = 'SELECT u.user_id, u.user_rank, ';
	$sql .= ( $method == 1 ) ? 'SUM(o.points)' : 'AVG(o.points)';
	$sql .= ' AS total FROM '.USERS_TABLE.' u, '.POSTS_TABLE.' p, '.RATING_TABLE.' r, '.RATING_OPTION_TABLE.' o ';
	$sql_where = ' WHERE u.user_id = p.poster_id AND p.post_id = r.post_id AND r.option_id = o.option_id';
	$sql_where .= ( !empty($in_list) ) ? ' AND u.user_id IN ('.$in_list.')' : '';
	$sql_where .= $exclude_special_ranks;
	$sql .= $sql_where.' GROUP BY u.user_id';

	if( !($result = $db->sql_query($sql)) )
	{
		message_die(CRITICAL_ERROR, "Could not query user rating information", "", __LINE__, __FILE__, $sql);
	}
	else
	{
		// CALCULATE NEW RATING FOR EACH USER, UPDATE IF DIFFERENT FROM CURRENT
		while ( $row = $db->sql_fetchrow($result) )
		{
			// IF NO RATINGS, SET RATING TOTAL TO ZERO
			$overall_rank = assign_rating_rank(intval($row['total']),'user',$method);

			// IF RATING HAS CHANGED, UPDATE IT
			if ( $overall_rank != $row['user_rank'] )
			{
				$usql = 'UPDATE '.USERS_TABLE.' SET user_rank = '.$overall_rank.' WHERE user_id = '.$row['user_id'];
				if( !($uresult = $db->sql_query($usql)) )
				{
					message_die(CRITICAL_ERROR, "Could not update user information", "", __LINE__, __FILE__, $usql);
				}
			}
		}
	}
	$db->sql_freeresult($result);
}

function assign_rating_rank($val,$item,$method)
{
	global $db;
	switch($item)
	{
		case 'post':
			$types = '5';
			$field = 'rating_rank_id';
			break;
		case 'topic':
			$types = '4';
			$field = 'rating_rank_id';
			break;
		case 'user':
			$types = '3';
			$field = 'user_rank';
			break;
		default:
			message_die(CRITICAL_ERROR, 'Invalid rating item specified: '.$item, '', __LINE__, __FILE__, $sql);
	}
	switch($method)
	{
		case 1:
			// SUM
			$sql_between = ( $val >= 0 ) ? '0 AND '.$val : $val.' AND 0';
			$sql = 'SELECT '.$field.' FROM '.RATING_RANK_TABLE.' WHERE sum_threshold BETWEEN '.$sql_between.' AND type IN ('.$types.') ORDER BY ABS(sum_threshold) DESC, rating_rank_id LIMIT 1';
			break;

		case 2:
			// AVERAGE
			$sql = 'SELECT '.$field.', ABS('.$val.' - average_threshold) AS nearest from '.RATING_RANK_TABLE.' WHERE type IN ('.$types.') ORDER BY nearest LIMIT 1';
			break;
		default:
			message_die(CRITICAL_ERROR, 'Invalid rating method specified: '.$method, '', __LINE__, __FILE__, $sql);
	}

	if( !($result = $db->sql_query($sql)) )
	{
		message_die(CRITICAL_ERROR, 'Could not query rating total information', '', __LINE__, __FILE__, $sql);
	}
	elseif ( !($row = $db->sql_fetchrow($result)) )
	{
		$overall_rank = 0;
	}
	else
	{
		$overall_rank = $row[$field];
	}
	$db->sql_freeresult($result);
	return $overall_rank;
}
?>