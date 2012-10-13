<?php
/***************************************************************************
 *                              im_install.php
 *                            -------------------
 *   begin                : Monday, Nov 11, 2002
 *   version              : 4.0.0
 *   date                 : 2003/12/23 22:50
 ***************************************************************************/

/* This is an script to install Prillian, based of phpBB install scripts. This
   script requires a successful installation of phpBB to already exist. If you're
   including Prillian in a premodded board package and looking to add this to your
   installer, keep that in mind.
*/

include_once('im_insfunc.php');

$mode = ( $_REQUEST['mode'] == 'new' || $_REQUEST['mode'] == 'delete' ) ? $_REQUEST['mode']: '';

function make_db_changes(&$message, &$error, $type)
{
	global $db, $table_prefix;
	global $dbms_schema, $dbms_basic, $dbms_alter, $remove_remarks, $delimiter, $delimiter_basic;
	global $lang;
	switch($type)
	{
		case 'delete':
		case 'schema':
			$breaker = $delimiter;
			$sourcefile = $dbms_schema;
			$message .= '<span class="head_msg">'.$lang['Attempt_schema_read'].'</span> ';
			$msg1 = '<span class="head_msg">'.$lang['Attempt_create_tables'].'</span><br />';
			$msg_type = $lang['Table'];
			$msg_succ = $lang['Created'];
			break;
		case 'data':
			$breaker = $delimiter_basic;
			$sourcefile = $dbms_basic;
			$message .= '<span class="head_msg">Attempting to read Data SQL file:</span> ';
			$msg1 = '<span class="head_msg">Attempting to add new data:</span><br />';
			$msg_type = $lang['Query'];
			$msg_succ = $lang['Completed'];
			break;
		case 'alter_delete':
			$type = 'delete';
		case 'alter':
			$breaker = $delimiter;
			$sourcefile = $dbms_alter;
			$message .= '<span class="head_msg">'.$lang['Attempt_alter_read'].'</span> ';
			$msg1 = '<span class="head_msg">'.$lang['Attempt_alter_tables'].'</span><br />';
			$msg_type = $lang['Table_alterations'];
			$msg_succ = $lang['Completed'];
			break;
		default:
			$message .= '<span class="err_msg">'.$lang['Undetermine'].'</span>';
			return;
			break;
	}

	$sql_query = get_schema($sourcefile, $breaker);

	if( $type == 'delete' )
	{
		return $sql_query;
	}

	if( $queries_size = sizeof($sql_query) )
	{
		$message .= '<span class="success_msg">'.$lang['Successful'].'</span><br /><br />';
	}
	else
	{
		$error = true;
		$message .= '<span class="err_msg">'.$lang['Failed'].'</span><br /><br />';
		return;
	}

	$message .= $msg1;
	for ($i = 0; $i < $queries_size; $i++)
	{
		if (trim($sql_query[$i]) != '')
		{
			$message .= '&nbsp;&nbsp;&nbsp;&nbsp;<span class="query_msg">' . $sql_query[$i] . '</span><br />&nbsp; &nbsp; &nbsp; &nbsp; ';
			if ( !($result = $db->sql_query($sql_query[$i])) )
			{
				$error = true;
				$error_msg = $db->sql_error();
				$message .= '<span class="err_msg">' . $msg_type . ' ' . ($i+1) . ' '.$lang['Failed'].' '.$lang['Error_follows'].'<br />&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;' . $error_msg['message'] . '</span><br /><br />';
			}
			else
			{
				$message .= '<span class="success_msg">' . $msg_type . ' ' . ($i+1) . ' '.$lang['Successfully'].' ' . $msg_succ . '!</span><br /><br />';
			}
		}
	}
}

function del_thoul_tables(&$message, $type)
{
	global $db, $table_prefix, $phpbb_root_path, $phpEx;
	global $lang;
	$error = false;

	// Parse the MySQL schema file into some arrays.
	setup_db_data();
	$sql_query = make_db_changes($message, $error, $type);

	if( $queries_size = sizeof($sql_query) )
	{
		$message .= '<span class="success_msg">'.$lang['Successful'].'</span><br /><br />';
	}
	else
	{
		$error = true;
		$message .= '<span class="err_msg">'.$lang['Failed'].'</span><br /><br />';
		return;
	}

	if( $type == 'delete' )
	{
		$message .= '<span class="head_msg">'.$lang['Attempt_delete_tables'].'</span><br />';
		$msg1 .= $lang['Deletion'];
	}
	else
	{
		$message .= '<span class="head_msg">'.$lang['Attempt_delete_alternations_tables'].'</span><br />';
		$msg1 .= $lang['Alteration'];
	}

	for($ii=0; $ii<$queries_size; $ii++)
	{
		$delete_query = '';
		if( $type == 'delete' )
		{
			if ( preg_match('/^CREATE TABLE (\w+)/i', trim($sql_query[$ii]), $matches[$ii]) )
			{
				$delete_query = 'DROP TABLE ' . $matches[$ii][1];
			}
			else
			{
				$error = true;
				continue;
			}
		}
		else
		{
			if ( preg_match('/^ALTER TABLE (\w+) ADD (\w+)/i', trim($sql_query[$ii]), $matches[$ii]) )
			{
				if( $matches[$ii][2] != 'INDEX' )
				{
					$delete_query = 'ALTER TABLE ' . $matches[$ii][1] . ' DROP ' . $matches[$ii][2];
				}
				else
				{
					continue;
				}
			}
			else
			{
				$error = true;
				continue;
			}
		}

		$message .= '&nbsp;&nbsp;&nbsp;&nbsp;';

		if( !$db->sql_query($delete_query) )
		{
			$error = true;
			$error_msg = $db->sql_error();
			$message .= '<span class="err_msg">Table ' . $msg1 . ' ' . $ii . ' '.$lang['Failed'].' '.$lang['Error_follows'].'<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $error_msg['message'] . '</span><br /><br />';
		}
	}

	if( !$error )
	{
		$message .= '<span class="success_msg">'.$lang['Successful'].'</span><br /><br />';
	}
}

function new_install()
{
	global $phpbb_root_path, $board_config, $table_prefix, $db, $current_version, $phpEx, $act_level, $echo_name;
	global $lang;
	
	$error = false;

	$message = '<div class="step">';

	switch($act_level)
	{
		case '1':
			// Install new DB tables
			$message .= $lang['Step_1'].'</div><div class="mainbody">'.$lang['Step_1_intro'].'<br /><br />';

			// We're going to need the sql parser
			include_once($phpbb_root_path . 'includes/sql_parse.' . $phpEx);
			setup_db_data();
			make_db_changes($message, $error, 'schema');
			if( $error )
			{
				$message .= sprintf($lang['Step_1_error'],$table_prefix.'contact_list', $table_prefix.'X');
			}
			else
			{
				$message .= '<br /><span class="bold">'.$lang['Step_no_errors'].'</span>';
			}
			break;
		case '2':
			// Copy users to phpbb_im_prefs
			$message .= $lang['Step_2'].'</div><div class="mainbody">'.sprintf($lang['Step_2_intro'],$table_prefix.'im_prefs').'<br /><br />';
			$user_success = 0;
			$user_total = 0;
			$err_msg = '';
			$err_ids = array();

			$sql = 'SELECT user_id, user_style FROM ' . USERS_TABLE . ' WHERE user_id <> ' . ANONYMOUS;
			if( !$result = $db->sql_query($sql) )
			{
				$error = true;
				$message .= '<span class="err_msg">'.$lang['Step_2_error_get_list'].'<br /><br /></span>';
			}
			while( $row = $db->sql_fetchrow($result) )
			{
				$user_total++;
				$sql = 'INSERT INTO ' . IM_PREFS_TABLE . ' (user_id, themes_id) VALUES (' . $row['user_id'] . ', ' . $row['user_style'] . ')';
				if( !$db->sql_query($sql) )
				{
					$error = true;
					$err_msg .= (( !empty($err_msg) ) ? ', ': '') . $row['user_id'];
					$err_ids[] = $row['user_id'];
				}
				else
				{
					$user_success++;
				}
			}
			if( $user_success )
			{
				$message .= '<span class="success_msg">'.sprintf($lang['Step_2_user_success'],$user_success,$user_total).'</span>';
			}
			else
			{
				$message .= '<span class="err_msg">'.sprintf($lang['Step_2_user_failed'],$user_total).'</span>';
			}

			if( $err_msg )
			{
				$message .= sprintf($lang['Step_2_error'],$err_msg);

				foreach($err_ids as $id)
				{
					$message .= 'INSERT INTO ' . IM_PREFS_TABLE . ' (user_id, themes_id) VALUES (' . $id . ', ' . $board_config['default_style'] . ');<br />';
				}
				
				$message .= '</span>';
			}
			
			break;
		case '3':
			// Add new config vars
			$message .= $lang['Step_3'].'</div><div class="mainbody">'.$lang['Step_3_intro'].'<br /><br />';
			include_once($phpbb_root_path . 'includes/sql_parse.' . $phpEx);
			setup_db_data();
			make_db_changes($message, $error, 'data');
			if( $error )
			{
				$message .= $lang['Step_3_error'];
			}
			else
			{
				$message .= '<br /><span class="bold">'.$lang['Step_no_errors'].'</span>';
			}
			break;
		case '4':
			// Alter tables when needed.
			$message .= $lang['Step_4'].'</div><div class="mainbody">'.$lang['Step_4_intro'].'<br /><br />';
			include_once($phpbb_root_path . 'includes/sql_parse.' . $phpEx);
			setup_db_data();
			make_db_changes($message, $error, 'alter');

			if( $error )
			{
				$message .= $lang['Step_4_error'];
			}
			else
			{
				$message .= '<br /><span class="bold">'.$lang['Step_no_errors'].'</span>';
			}
			break;
		case '5':
			// Finished.
			$message .= $lang['Step_5'].'</div><div class="mainbody">'.$lang['Step_5_intro'];
			$message .= '</div><div class="proceed"><a href="../profile.php?mode=profil&sub=profile_prefer&mod=0">'.$lang['Step_5_proceed'].'  &gt;&gt;</a>';
			break;
		default:
			$message .= $lang['Step_0'].'</div><div class="mainbody">'.$lang['Step_0_intro'];
			break;
	}			

	if( $act_level != 5  )
	{
		$message .= '</div>
			<div class="proceed">
			<a href="im_install.php?mode=new&act_level=' . ++$act_level . '">'.$lang['Proceed'].' &gt;&gt;</a>';
	}
		
	$message .= '</div>';
	echo $message;
}


function delete_install()
{
	global $phpbb_root_path, $db, $board_config, $current_version, $phpEx;
	global $lang;
	// We're going to need the sql parser
	include_once($phpbb_root_path.'includes/sql_parse.'.$phpEx);

	$message = '<div class="mainbody">'.$lang['Delete_step'].'<br /><br />';

	del_thoul_tables($message, 'delete');

	$error = false;
/*
	// Prillian message Removal
	$message .= '<span class="head_msg">Attempting to delete Network and Chat messages:</span><br />';

	$sql = 'SELECT privmsgs_id FROM ' . PRIVMSGS_TABLE . ' WHERE site_id<>0 OR room_id<>0 OR privmsgs_id IN (' . IM_NEW_MAIL . ', ' . IM_READ_MAIL . ', ' . IM_UNREAD_MAIL . ')';

	if( !$result = $db->sql_query($sql) )
	{
		$error = true;
	}
	else
	{
		$ids_sql = '';
		while( $row = $db->sql_fetchrow($result) )
		{
			$ids_sql .= (( empty($ids_sql) ) ? '' : ', ') . $row['privmsgs_id'];
		}

		if( !empty($ids_sql) )
		{
			$sql = 'DELETE FROM ' . PRIVMSGS_TABLE . " WHERE privmsgs_id IN ($ids_sql)";
			$sql1 = 'DELETE FROM ' . PRIVMSGS_TEXT_TABLE . " WHERE privmsgs_text_id IN ($ids_sql)";
			
		}
		if( !$db->sql_query($sql) || !$db->sql_query($sql1) )
		{
			$error = true;
		}
	}

	if( !$error )
	{
		$message .= '<span class="success_msg">Successful!</span><br /><br />';
	}
	else
	{
		$message .= '<span class="err_msg">Failed!</span><br /><br />';
	}
*/	
	// Table alters removal
	del_thoul_tables($message, 'alter_delete');
	$message .= '</div>';
	echo $message;
}

function choose_install()
{
	global $phpEx, $echo_name;
	global $lang;
	$message = '<div class="mainbody">'.sprintf($lang['Choose_Install'],$echo_name, 'constants.'.$phpEx, '<a href="im_install.' . $phpEx . '?mode=new">',$echo_name,'</a>', '<!-- a href="im_upgrade.' . $phpEx . '" -->','<!-- /a -->', $echo_name, '<a href="im_install.' . $phpEx . '?mode=delete">', $echo_name, '</a>').'</div>';
	echo $message;
}

function confirm_delete()
{
	global $phpEx, $echo_name;
	global $lang;
	$message = '<div class="mainbody">'.sprintf($lang['Confirm_Delete'],$echo_name,$echo_name,'constants'.$phpEx, '<a href="im_install.' . $phpEx . '?mode=delete&confirm=1">','</a>').'</div>';
	echo $message;
}


// Page Output
page_header();

switch($mode)
{
	case 'new':
		include_once(PRILL_PATH . 'functions_im.' . $phpEx);
		$prill_config = get_prillian_config(true);

		if( $prill_config['version'] >= $current_version && !$act_level )
		{
			$message = '<div class="mainbody"><span class="err_msg">'.sprintf($lang['Already_installed'],$echo_name).'</span></div>';
			echo $message;
		}
		else
		{
			new_install();
		}
		break;
	case 'delete':
		if( isset($_REQUEST['confirm']) )
		{
			delete_install();
		}
		else
		{
			confirm_delete();
		}
		break;
	case '':
	default:
		choose_install();
		break;
}
page_footer();

?>