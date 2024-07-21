<?php
/** ------------------------------------------------------------------------
 *		subject				: mx-portal, CMS & portal
 *		begin            	: june, 2002
 *		copyright          	: (C) 2002-2005 MX-System
 *		email             	: jonohlsson@hotmail.com
 *		project site		: www.mx-system.com
 * 
 *		description			:
 * -------------------------------------------------------------------------
 * 
 *     $Id: functions_kb_mx.php,v 1.5 2005/04/20 19:30:19 jonohlsson Exp $
 */

/**
 * This program is free software; you can redistribute it and/or modify
 *     it under the terms of the GNU General Public License as published by
 *     the Free Software Foundation; either version 2 of the License', or
 *     ('at your option) any later version.
 */

	if ( !function_exists('mx_smilies_pass' ) )
	{	
		function mx_smilies_pass($message)
		{
			global $board_config;
			$smilies_path = $board_config['smilies_path'];
			$board_config['smilies_path'] = PHPBB_URL . $board_config['smilies_path'];
			$message = smilies_pass($message);
			$board_config['smilies_path'] = $smilies_path;
			return $message;
		}
	}

	if ( !function_exists('mx_generate_smilies' ) )
	{	
		function mx_generate_smilies($mode, $page_id)
		{
			global $board_config, $template, $phpEx;
			$smilies_path = $board_config['smilies_path'];
			$board_config['smilies_path'] = PHPBB_URL . $board_config['smilies_path'];
			generate_smilies($mode, $page_id);
			$board_config['smilies_path'] = $smilies_path;
			$template->assign_vars(array(
				'U_MORE_SMILIES' => append_sid(PHPBB_URL . "posting.$phpEx?mode=smilies"))
			);
		}
	}
		
	if ( !function_exists('mx_message_die' ) )
	{
		
		function mx_message_die($msg_code, $msg_text = '', $msg_title = '', $err_line = '', $err_file = '', $sql = '')
		{
			global $db, $template, $board_config, $theme, $lang, $phpEx, $phpbb_root_path, $nav_links, $gen_simple_header, $images;
			global $userdata, $user_ip, $session_length;
			global $starttime;
			
			message_die($msg_code, $msg_text, $msg_title, $err_line, $err_file, $sql);
		}		
		
	}
	
	if ( !function_exists('mx_is_group_member' ) )
	{	
		// Validates if user belongs to group included in group_ids list
		// Also, adds all usergroups to userdata array
		function mx_is_group_member( $group_ids = '', $group_mod_mode = false )
		{
			global $userdata, $db;
			
			if ( $group_ids == '' )
			{
				return false;
			}
		
			$group_ids_array = explode(",", $group_ids);
			
			// Try to reuse usergroups result.
			if ( $group_mod_mode )
			{ 
				$userdata_key = 'mx_usergroups_mod' . $userdata['user_id'];
		
				if ( empty( $userdata[$userdata_key] )  )
				{
					// Check if user is group moderator..
					$sql = "SELECT gr.group_id
				  		FROM " . GROUPS_TABLE . " gr,
				      		" . USER_GROUP_TABLE . " ugr
		  				WHERE gr.group_id = ugr.group_id
		  				AND gr.group_moderator = '" . $userdata['user_id'] . "'
						AND ugr.user_pending = '0' ";			
					
					if ( !( $result = $db->sql_query( $sql ) ) )
					{
						message_die( GENERAL_ERROR, "Could not query group rights information", '', '', '', '' );
					}			
					
					$group_row = $db->sql_fetchrowset( $result );
					
					$userdata[$userdata_key_mod] = $group_row;
				} 
			}
			else 
			{
				$userdata_key = 'mx_usergroups' . $userdata['user_id'];
		
				if ( empty( $userdata[$userdata_key] ) )
				{
					// Check if user is member of the proper group..
					$sql = "SELECT group_id FROM " . USER_GROUP_TABLE . " WHERE user_id='" . $userdata['user_id'] . "' AND user_pending = 0";
					
					if ( !( $result = $db->sql_query( $sql ) ) )
					{
						message_die( GENERAL_ERROR, "Could not query group rights information", '', '', '', '' );
					}				
					
					$group_row = $db->sql_fetchrowset( $result );
					
					$userdata[$userdata_key] = $group_row;
				} 
			}
			
			for ( $i = 0; $i < count( $userdata[$userdata_key] ); $i++ )
			{
				if ( in_array( $userdata[$userdata_key][$i]['group_id'], $group_ids_array ) )
				{
					$is_member = true;
					return $is_member;
				}
			}	
			
			return false;	
		}
	}
	
	if ( !function_exists('mx_add_search_words' ) )
	{	
		// Add search words for blocks
		function mx_add_search_words($mode, $post_id, $post_text, $post_title = '', $mx_mode = 'mx')
		{
			global $db, $phpbb_root_path, $board_config, $lang;
		
			// $search_match_table = SEARCH_MATCH_TABLE;
			// $search_word_table = SEARCH_WORD_TABLE;
			
			switch ( $mx_mode )
			{
				case 'mx':
					$search_match_table = MX_MATCH_TABLE;
					$search_word_table = MX_WORD_TABLE;
					$db_key = 'block_id';
				break;
				case 'kb':
					$search_match_table = KB_MATCH_TABLE;
					$search_word_table = KB_WORD_TABLE;
					$db_key = 'article_id';	
				break;	
			}
			
			$stopword_array = @file($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . "/search_stopwords.txt"); 
			$synonym_array = @file($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . "/search_synonyms.txt"); 
		
			$search_raw_words = array();
			$search_raw_words['text'] = split_words(clean_words('post', $post_text, $stopword_array, $synonym_array));
			$search_raw_words['title'] = split_words(clean_words('post', $post_title, $stopword_array, $synonym_array));
		
			@set_time_limit(0);
		
			$word = array();
			$word_insert_sql = array();
			foreach ($search_raw_words as $word_in => $search_matches)
			{
				$word_insert_sql[$word_in] = '';
				if ( !empty($search_matches) )
				{
					for ($i = 0; $i < count($search_matches); $i++)
					{ 
						$search_matches[$i] = trim($search_matches[$i]);
		
						if( $search_matches[$i] != '' ) 
						{
							$word[] = $search_matches[$i];
							if ( !strstr($word_insert_sql[$word_in], "'" . $search_matches[$i] . "'") )
							{
								$word_insert_sql[$word_in] .= ( $word_insert_sql[$word_in] != "" ) ? ", '" . $search_matches[$i] . "'" : "'" . $search_matches[$i] . "'";
							}
						} 
					}
				}
			}
		
			if ( count($word) )
			{
				sort($word);
		
				$prev_word = '';
				$word_text_sql = '';
				$temp_word = array();
				for($i = 0; $i < count($word); $i++)
				{
					if ( $word[$i] != $prev_word )
					{
						$temp_word[] = $word[$i];
						$word_text_sql .= ( ( $word_text_sql != '' ) ? ', ' : '' ) . "'" . $word[$i] . "'";
					}
					$prev_word = $word[$i];
				}
				$word = $temp_word;
		
				$check_words = array();
				switch( SQL_LAYER )
				{
					case 'postgresql':
					case 'msaccess':
					case 'mssql-odbc':
					case 'oracle':
					case 'db2':
						$sql = "SELECT word_id, word_text     
							FROM " . $search_word_table . " 
							WHERE word_text IN ($word_text_sql)";
						if ( !($result = $db->sql_query($sql)) )
						{
							mx_message_die(GENERAL_ERROR, 'Could not select words', '', __LINE__, __FILE__, $sql);
						}
		
						while ( $row = $db->sql_fetchrow($result) )
						{
							$check_words[$row['word_text']] = $row['word_id'];
						}
						break;
				}
		
				$value_sql = '';
				$match_word = array();
				for ($i = 0; $i < count($word); $i++)
				{ 
					$new_match = true;
					if ( isset($check_words[$word[$i]]) )
					{
						$new_match = false;
					}
		
					if ( $new_match )
					{
						switch( SQL_LAYER )
						{
							case 'mysql':
							case 'mysql4':
							case 'mysqli':
								$value_sql .= ( ( $value_sql != '' ) ? ', ' : '' ) . '(\'' . $word[$i] . '\', 0)';
								break;
							case 'mssql':
							case 'mssql-odbc':
								$value_sql .= ( ( $value_sql != '' ) ? ' UNION ALL ' : '' ) . "SELECT '" . $word[$i] . "', 0";
								break;
							default:
								$sql = "INSERT INTO " . $search_word_table . " (word_text, word_common) 
									VALUES ('" . $word[$i] . "', 0)"; 
								if( !$db->sql_query($sql) )
								{
									mx_message_die(GENERAL_ERROR, 'Could not insert new word', '', __LINE__, __FILE__, $sql);
								}
								break;
						}
					}
				}
		
				if ( $value_sql != '' )
				{
					switch ( SQL_LAYER )
					{
						case 'mysql':
						case 'mysql4':
						case 'mysqli':
							$sql = "INSERT IGNORE INTO " . $search_word_table . " (word_text, word_common) 
								VALUES $value_sql"; 
							break;
						case 'mssql':
						case 'mssql-odbc':
							$sql = "INSERT INTO " . $search_word_table . " (word_text, word_common) 
								$value_sql"; 
							break;
					}
		
					if ( !$db->sql_query($sql) )
					{
						mx_message_die(GENERAL_ERROR, 'Could not insert new word', '', __LINE__, __FILE__, $sql);
					}
				}
			}
		
			foreach ($word_insert_sql as $word_in => $match_sql)
			{
				$title_match = ( $word_in == 'title' ) ? 1 : 0;
		
				if ( $match_sql != '' )
				{
					$sql = "INSERT INTO " . $search_match_table . " ($db_key, word_id, title_match) 
						SELECT $post_id, word_id, $title_match  
							FROM " . $search_word_table . " 
							WHERE word_text IN ($match_sql)"; 
					if ( !$db->sql_query($sql) )
					{
						mx_message_die(GENERAL_ERROR, 'Could not insert new word matches', '', __LINE__, __FILE__, $sql);
					}
				}
			}
		
			if ($mode == 'single')
			{
				// remove_common('single', 4/10, $word);
			}
		
			return;
		}
		
		function mx_remove_search_post($post_id_sql, $mx_mode = 'mx')
		{
			global $db;
		
			// $search_match_table = SEARCH_MATCH_TABLE;
			// $search_word_table = SEARCH_WORD_TABLE;
			
			switch ( $mx_mode )
			{
				case 'mx':
					$search_match_table = MX_MATCH_TABLE;
					$search_word_table = MX_WORD_TABLE;
					$db_key = 'block_id';
				break;
				case 'kb':
					$search_match_table = KB_MATCH_TABLE;
					$search_word_table = KB_WORD_TABLE;
					$db_key = 'article_id';	
				break;	
			}
			
			$words_removed = false;
		
			switch ( SQL_LAYER )
			{
				case 'mysql':
				case 'mysql4':
				case 'mysqli':
					$sql = "SELECT word_id 
						FROM " . $search_match_table . " 
						WHERE $db_key IN ($post_id_sql) 
						GROUP BY word_id";
					if ( $result = $db->sql_query($sql) )
					{
						$word_id_sql = '';
						while ( $row = $db->sql_fetchrow($result) )
						{
							$word_id_sql .= ( $word_id_sql != '' ) ? ', ' . $row['word_id'] : $row['word_id']; 
						}
		
						$sql = "SELECT word_id 
							FROM " . $search_match_table . " 
							WHERE word_id IN ($word_id_sql) 
							GROUP BY word_id 
							HAVING COUNT(word_id) = 1";
						if ( $result = $db->sql_query($sql) )
						{
							$word_id_sql = '';
							while ( $row = $db->sql_fetchrow($result) )
							{
								$word_id_sql .= ( $word_id_sql != '' ) ? ', ' . $row['word_id'] : $row['word_id']; 
							}
		
							if ( $word_id_sql != '' )
							{
								$sql = "DELETE FROM " . $search_word_table . " 
									WHERE word_id IN ($word_id_sql)";
								if ( !$db->sql_query($sql) )
								{
									mx_message_die(GENERAL_ERROR, 'Could not delete word list entry', '', __LINE__, __FILE__, $sql);
								}
		
								$words_removed = $db->sql_affectedrows();
							}
						}
					}
					break;
		
				default:
					$sql = "DELETE FROM " . $search_word_table . " 
						WHERE word_id IN ( 
							SELECT word_id 
							FROM " . $search_match_table . " 
							WHERE word_id IN ( 
								SELECT word_id 
								FROM " . $search_match_table . " 
								WHERE $db_key IN ($post_id_sql) 
								GROUP BY word_id 
							) 
							GROUP BY word_id 
							HAVING COUNT(word_id) = 1
						)"; 
					if ( !$db->sql_query($sql) )
					{
						mx_message_die(GENERAL_ERROR, 'Could not delete old words from word table', '', __LINE__, __FILE__, $sql);
					}
		
					$words_removed = $db->sql_affectedrows();
		
					break;
			}
		
			$sql = "DELETE FROM " . $search_match_table . "  
				WHERE $db_key IN ($post_id_sql)";
			if ( !$db->sql_query($sql) )
			{
				mx_message_die(GENERAL_ERROR, 'Error in deleting post', '', __LINE__, __FILE__, $sql);
			}
		
			return $words_removed;
		}	
	}

	if ( !function_exists('mx_do_install_upgrade') )
	{
		// Generating output
		
		function mx_do_install_upgrade( $sql = '', $main_install = false )
		{
			global $table_prefix, $mx_table_prefix, $userdata, $phpEx, $template, $lang, $db, $board_config, $_POST;
			
			$inst_error = false;
			$n = 0;
			$message = "<b>This is the result list of the SQL queries needed for the install/upgrade</b><br /><br />";
		
			while ( $sql[$n] )
			{
				if ( !$result = $db->sql_query( $sql[$n] ) )
				{
					$message .= '<b><font color=#FF0000>[Error or Already added]</font></b> line: ' . ( $n + 1 ) . ' , ' . $sql[$n] . '<br />';
					$inst_error = true;
				}
				else
				{
					$message .= '<b><font color=#0000fF>[Added/Updated]</font></b> line: ' . ( $n + 1 ) . ' , ' . $sql[$n] . '<br />';
				}
				$n++;
			}
			$message .= '<br /> If you get some Errors, Already Added or Updated messages, relax, this is normal when updating modules';
			
			if ( $main_install )
			{
				if ( !$inst_error )
				{
					$message .= '-> no db errors :-)<br /><br /><b>Portal installed successfully! </b><hr><br /><br />';
					$message .= '1) Now, delete the /install and /contrib folders!!!<br /><br />';
					$message .= '2) If you haven\'t already done a db backup, now is the time ;)<br /><br />';
					$message .= '3) Then (after step 1), you HAVE to configure MX core and its modules from within the adminCP, simply \'upgrade\' MX portal Core and all modules in use!!!<br /><br />';
		
					$message .= 'Click <a href=../admin/admin_mx_module.php>Here</a> to administer/upgrade the portal/modules. You will be promted for an admin username and pass. The upgrade process provide informative output...';
				}
				else
				{
					$message .= '<br /><br /><b>Portal installed successfully (with some warnings)! </b><hr><br /><br />';
					$message .= '1) Now, delete the /install and /contrib folders!!!<br /><br />';
					$message .= '2) If you haven\'t already done a db backup, now is the time ;)<br /><br />';
					$message .= '3) Now (after step 1), you HAVE to configure MX core and its modules from within the adminCP, simply \'upgrade\' MX portal Core and all modules in use!!!<br /><br />';
		
					$message .= 'Click <a href=../admin/admin_mx_module.php>Here</a> to administer/upgrade the portal/modules. You will be promted for an admin username and pass. The upgrade process provide informative output...';
				}
			}
			return $message;
		}
	}	
?>
