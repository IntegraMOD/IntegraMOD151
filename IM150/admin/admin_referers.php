<?php
/***************************************************************************
 *                             admin_referers.php
 *                            -------------------
 *   copyright            : (C) 2005 oc5iD XTreme Mods
 *   email                : admin@on-irc.net
 *   Web                  : http://www.on-irc.net
 *
 ***************************************************************************/

define('IN_PHPBB', 1);
define('CT_SECLEVEL', 'MEDIUM');
$ct_ignorepvar = array('delete');

if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['General']['HTTP_Referers_Title'] = $file;
	return;
}

//
// Load default header
//
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);


//
// Check to see what mode we should operate in.
//
if( isset($HTTP_POST_VARS['mode']) || isset($HTTP_GET_VARS['mode']) )
{
	$mode = ( isset($HTTP_POST_VARS['mode']) ) ? $HTTP_POST_VARS['mode'] : $HTTP_GET_VARS['mode'];
	$mode = htmlspecialchars($mode); 
}
else
{
	$mode = "";
}

//
// Select main mode
//
if( isset($HTTP_POST_VARS['delete']) || isset($HTTP_GET_VARS['delete']) )
{
	//
	// Delete all referers data 
	//
	$sql = "DELETE FROM " . REFERERS_TABLE;
	if (!$query = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not delete HTTP Referers.', '', __LINE__, __FILE__, $sql);
	}
	$message = $lang['referer_del_success'] . "<br /><br />" . sprintf($lang['Click_return_referersadmin'], "<a href=\"" . append_sid("admin_referers.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

	message_die(GENERAL_MESSAGE, $message);		
}

if ( $mode == 'delete')
{
	//
	// Delete a individual referer
	//		
	$referer_id = ( !empty($HTTP_POST_VARS['id']) ) ? $HTTP_POST_VARS['id'] : $HTTP_GET_VARS['id'];		
	$referer_host = ( !empty($HTTP_POST_VARS['host']) ) ? $HTTP_POST_VARS['host'] : $HTTP_GET_VARS['host'];

	$sql = "DELETE FROM " . REFERERS_TABLE . "
		WHERE " . ($referer_id ? "referer_id = $referer_id" : "referer_host = '$referer_host'");
	$result = $db->sql_query($sql);
	if( !$result )
	{
			message_die(GENERAL_ERROR, "Couldn't delete referer", "", __LINE__, __FILE__, $sql);
	}

	$message = $lang['referer_del_success'] . "<br /><br />" . sprintf($lang['Click_return_referersadmin'], "<a href=\"" . append_sid("admin_referers.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

	message_die(GENERAL_MESSAGE, $message);
	break;
}		
else
{
	//
	// This is the main display of the page before the admin has selected
	// any options.
	//
	$start = (isset($HTTP_GET_VARS['start'])) ? intval($HTTP_GET_VARS['start']) : 0;

	if( isset($HTTP_POST_VARS['sort']) )
	{
		$sort_method = $HTTP_POST_VARS['sort'];
	}
	else if( isset($HTTP_GET_VARS['sort']) )
	{
		$sort_method = $HTTP_GET_VARS['sort'];
	}
	else
	{
		$sort_method = 'referer_host';
	}

	$rdns_ip_num = ( isset($HTTP_GET_VARS['rdns']) ) ? $HTTP_GET_VARS['rdns'] : "";

	if( isset($HTTP_POST_VARS['order']) )
	{
		$sort_order = $HTTP_POST_VARS['order'];
	}
	else if( isset($HTTP_GET_VARS['order']) )
	{
		$sort_order = $HTTP_GET_VARS['order'];
	}
	else
	{
		$sort_order = '';
	}

	$template->set_filenames(array(
		"body" => "admin/admin_referers.tpl")
	);

	$template->assign_vars(array(
		'L_HTTP_REFERERS_TITLE' => $lang['HTTP_Referers_Title'],
		'L_HTTP_REFERERS_EXPLAIN' => $lang['HTTP_Referers_Explain'],
		'U_SHOW_URLS_ACTION' => append_sid("admin_referers.$phpEx" . (($mode == 'showurls') ? '' : '?mode=showurls')),
		'L_DO_SHOW_URLS' => (($mode == 'showurls') ? $lang['Referer_urls_hide'] : $lang['Referer_urls_show']),
		'L_SELECT_SORT_METHOD' => $lang['Select_sort_method'],
		'U_LIST_ACTION' => append_sid("admin_referers.$phpEx"),
		'L_SORT' => $lang['Sort'],
		'L_ORDER' => $lang['Order'],
		'L_DELETE' => $lang['Delete'],
		'L_DELETE_ALL' => $lang['Delete_all'],
		'L_CONFIRM_DELETE_REFERER' => $lang['Confirm_delete_referer'],
		'L_CONFIRM_DELETE_REFERERS' => $lang['Confirm_delete_referers'],
		'L_SORT_DESCENDING' => $lang['Sort_Descending'],
		'L_SORT_ASCENDING' => $lang['Sort_Ascending'],
		'L_REFERER' => $lang['Referer_host'],
		'L_REFERER_URL' => $lang['Referer_url'],
		'L_REFERER_IP' => $lang['Referer_ip'],
		'L_HITS' => $lang['Referer_hits'],
		'L_FIRSTVISIT' => $lang['Referer_firstvisit'],
		'L_LASTVISIT' => $lang['Referer_lastvisit'],
		'L_ACTION' => $lang['Action'],	
		'REFERER_SELECTED' => ($sort_method == 'referer_host') ? 'selected="selected"' : '',
		'HITS_SELECTED' => ($sort_method == 'referer_hits') ? 'selected="selected"' : '',
		'FIRSTVISIT_SELECTED' => ($sort_method == 'referer_firstvisit') ? 'selected="selected"' : '',
		'LASTVISIT_SELECTED' => ($sort_method == 'referer_lastvisit') ? 'selected="selected"' : '',
		'ASC_SELECTED' => ($sort_order != 'DESC') ? 'selected="selected"' : '',
		'DESC_SELECTED' => ($sort_order == 'DESC') ? 'selected="selected"' : '')	
	);

	if ( $mode == "showurls" )
	{
		$template->assign_block_vars('switch_show_ref_urls', array() );
		// Count referers
		$sql = "SELECT COUNT(*) AS count 
			FROM " . REFERERS_TABLE;
	
		if(!$result = $db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, "Could not query referers table", "Error", __LINE__, __FILE__, $sql);
		}
		$total_referers = $db->sql_fetchfield("count", 0, $result);

		// Query referer info...
		$sql = "SELECT * FROM " . REFERERS_TABLE . " 
			ORDER BY " . $sort_method . " " . $sort_order . " 
			LIMIT " . $start . "," . $board_config['topics_per_page'];

		if(!$result = $db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, "Could not query referers table", "Error", __LINE__, __FILE__, $sql);
		}
	}
	else
	{
		$template->assign_block_vars('switch_dont_show_ref_urls', array() );
		// Count referers
		$sql = "SELECT COUNT(DISTINCT referer_host) AS count 
			FROM " . REFERERS_TABLE;
		if(!$result = $db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, "Could not query referers table", "Error", __LINE__, __FILE__, $sql);
		}
		$total_referers = $db->sql_fetchfield("count", 0, $result);

		// Query referer info...
		$sql = "SELECT DISTINCT referer_host, SUM(referer_hits) AS referer_hits, MIN(referer_firstvisit) AS referer_firstvisit, MAX(referer_lastvisit) AS referer_lastvisit 
			FROM " . REFERERS_TABLE . " 
			GROUP BY referer_host 
			ORDER BY " . $sort_method . " " . $sort_order . " 
			LIMIT " . $start . "," . $board_config['topics_per_page'];
	
		if(!$result = $db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Could not obtain HTTP referrers', '', __LINE__, __FILE__, $sql);
		}
	}

	while( $row = $db->sql_fetchrow($result) )
	{
		$refererrow[] = $row;
	}

	for ($i = 0; $i < $board_config['topics_per_page']; $i++)
	{
		if (empty($refererrow[$i]))
		{
			break;
		}

		$row_color = (($i % 2) == 0) ? "row1" : "row2";

		$firstvisit = create_date($board_config['default_dateformat'], $refererrow[$i]['referer_firstvisit'], $board_config['board_timezone']);
		if ($refererrow[$i]['referer_lastvisit'] != 0) 
		{
			$lastvisit = create_date($board_config['default_dateformat'], $refererrow[$i]['referer_lastvisit'], $board_config['board_timezone']);
		}
		else 
		{
			$lastvisit = '';
		}

		if ( $mode == "showurls" )
		{
			$l_ip = $refererrow[$i]['referer_ip'];
			if ( $l_ip == $rdns_ip_num )
			{
				$u_ip = append_sid("admin_referers.$phpEx?mode=showurls");
				$l_ip = gethostbyaddr(decode_ip($l_ip));
			}
			else
			{
				$u_ip = append_sid("admin_referers.$phpEx?mode=showurls&amp;rdns=$l_ip");
				$l_ip = decode_ip($l_ip);
			}
			$u_ip .= "&amp;sort=$sort_method&amp;order=$sort_order";
			$referer_url = substr($refererrow[$i]['referer_url'], strpos($refererrow[$i]['referer_url'], "/", strpos($refererrow[$i]['referer_url'], "//") + 2));
			$referer_url_title = '';
			if ( strlen($referer_url) > 48 )
			{
				$referer_url_title = ' title="' . $referer_url . '"';
				$referer_url = substr($referer_url, 0, 45) . '...';
			}

			$template->assign_block_vars('refererrow_with_ref_urls', array(
				'COLOR' => $row_color,
				'U_REFERER' => ($refererrow[$i]['referer_host'] ? "http://" . $refererrow[$i]['referer_host'] : ''),
				'REFERER' => ($refererrow[$i]['referer_host'] ? $refererrow[$i]['referer_host'] : '(empty)'),
				'U_URL' => htmlentities($refererrow[$i]['referer_url']),
				'URL' => htmlentities($referer_url),
				'URL_TITLE' => $referer_url_title,
				'U_IP' => $u_ip,
				'L_IP' => $l_ip,
				'HITS' => $refererrow[$i]['referer_hits'],
				'FIRSTVISIT' => $firstvisit,
				'LASTVISIT' => $lastvisit,
				'U_DELETE' => append_sid("admin_referers.$phpEx?mode=delete&amp;id=" . $refererrow[$i]['referer_id'])
				) //end array
			);
		}
		else
		{
		$template->assign_block_vars('refererrow', array(
			'COLOR' => $row_color,
			'U_REFERER' => ($refererrow[$i]['referer_host'] ? "http://" . $refererrow[$i]['referer_host'] : ''),
			'REFERER' => ($refererrow[$i]['referer_host'] ? $refererrow[$i]['referer_host'] : '(empty)'),
			'HITS' => $refererrow[$i]['referer_hits'],
			'FIRSTVISIT' => $firstvisit,
			'LASTVISIT' => $lastvisit,
			'U_DELETE' => append_sid("admin_referers.$phpEx?mode=delete&amp;host=" . $refererrow[$i]['referer_host'])
			) //end array
		);
		}
	} // end for

	$template->assign_vars(array(
		'PAGINATION' => generate_pagination(append_sid("admin_referers.$phpEx?sort=$sort_method&amp;order=$sort_order" . (isset($mode) ? "&amp;mode=$mode" : "") . ($rdns_ip_num == "" ? "" : "&amp;rdns=$rdns_ip_num")), $total_referers, $board_config['topics_per_page'], $start),
		'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $board_config['topics_per_page'] ) + 1 ), ceil( $total_referers / $board_config['topics_per_page'] ))
		) // end array
	);

	$template->pparse('body');
}

include('./page_footer_admin.'.$phpEx);

?>