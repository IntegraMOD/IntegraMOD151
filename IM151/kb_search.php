<?php
/**
 * kb_search.php
 *                             -------------------
 *    begin                : Sunday, Mar 31, 2003
 *    copyright            : (C) 2001 The phpBB Group
 *    email                : support@phpbb.com
 * 
 *    $Id: kb_search.php,v 1.0.0
 */

/**
 * This program is free software; you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation; either version 2 of the License, or
 *    (at your option) any later version.
 */

// Switch for making this run as a phpBB MOD or mxBB module
define('CT_SECLEVEL', 'MEDIUM');
$ct_ignorepvar = array('search_keywords');
if ( file_exists( './viewtopic.php' ) ) // -------------------------------------------- phpBB MOD MODE
{
	define( 'MXBB_MODULE', false ); // Switch for making this run as a phpBB mod or mxBB module
	define( 'IN_PHPBB', true );
	define( 'IN_PORTAL', true );
	
	// when run as a phpBB mod these paths are identical
	$phpbb_root_path = $module_root_path = $mx_root_path = './';
	
	include( $phpbb_root_path . 'extension.inc' );
	include( $phpbb_root_path . 'common.' . $phpEx );
	
	if (!defined('PAGE_KB')) define( 'PAGE_KB', -500 );
	
	// Start session management
	
	$userdata = session_pagestart( $user_ip, PAGE_KB );
	init_userprefs( $userdata );
	
	// End session management
	
	include_once( $phpbb_root_path . 'includes/functions_post.' . $phpEx );
	include_once( $phpbb_root_path . 'includes/bbcode.' . $phpEx );
	include_once( $phpbb_root_path . 'includes/functions_search.' . $phpEx );
	
	include( $phpbb_root_path . 'includes/kb_constants.' . $phpEx );
	include( $phpbb_root_path . 'includes/functions_kb.' . $phpEx );
	include( $phpbb_root_path . 'includes/functions_kb_auth.' . $phpEx );
	include( $phpbb_root_path . 'includes/functions_kb_field.' . $phpEx );
	include( $phpbb_root_path . 'includes/functions_kb_mx.' . $phpEx );

}
else // --------------------------------------------------------------------------------- mxBB Module MODE
{
	define( 'MXBB_MODULE', true );
	
	if ( !defined( 'IN_PORTAL' ) )
	{
		define( 'IN_PORTAL', true );
		$mx_root_path = './../../';
		$is_block = false;
		
		include( $mx_root_path . 'extension.inc' );
		include( $mx_root_path . 'common.' . $phpEx );
		
		// Start session management
		
		$userdata = session_pagestart( $user_ip, PAGE_INDEX );
		mx_init_userprefs( $userdata );
		
		// End session management		
	}
	else
	{ 
		// Read block Configuration
		$block_config = read_block_config( $block_id );
		$title = $block_config[$block_id]['block_title'];
		$is_block = true;
		global $images;
	}
	
	define( 'MXBB_27x', file_exists( $mx_root_path . 'mx_login.php' ) );
	
	include_once( $phpbb_root_path . 'includes/functions_post.' . $phpEx );
	include_once( $phpbb_root_path . 'includes/bbcode.' . $phpEx );
	include_once( $phpbb_root_path . 'includes/functions_search.' . $phpEx );
	
	include_once( $module_root_path . 'includes/kb_constants.' . $phpEx );
	include_once( $module_root_path . 'includes/functions_kb.' . $phpEx );
	include_once( $module_root_path . 'includes/functions_kb_auth.' . $phpEx );
	include_once( $module_root_path . 'includes/functions_kb_field.' . $phpEx );
	include_once( $module_root_path . 'includes/functions_kb_mx.' . $phpEx );
}

include( $phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_search.' . $phpEx );
// -------------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------------

// Start KB SCRIPT

// Define initial vars

if ( isset( $_POST['mode'] ) || isset( $_GET['mode'] ) )
{
	$mode = ( isset( $_POST['mode'] ) ) ? $_POST['mode'] : $_GET['mode'];
}
else
{
	$mode = '';
}

if ( isset( $_POST['search_keywords'] ) || isset( $_GET['search_keywords'] ) )
{
	$search_keywords = ( isset( $_POST['search_keywords'] ) ) ? $_POST['search_keywords'] : $_GET['search_keywords'];
}
else
{
	$search_keywords = '';
}

if ( !$search_keywords || $search_keywords == '' )
{
	$mode = '';
}

$search_id = ( isset( $_GET['search_id'] ) ) ? $_GET['search_id'] : '';

if ( $search_id )
{
	$mode = 'results';
}

$show_results = ( isset( $_POST['show_results'] ) ) ? $_POST['show_results'] : 'posts';

if ( isset( $_POST['search_terms'] ) )
{
	$search_terms = ( $_POST['search_terms'] == 'all' ) ? 1 : 0;
}
else
{
	$search_terms = 0;
}

if ( isset( $_POST['search_fields'] ) )
{
	$search_fields = ( $_POST['search_fields'] == 'all' ) ? 1 : 0;
}
else
{
	$search_fields = 0;
}

$sort_by = ( isset( $_POST['sort_by'] ) ) ? intval( $_POST['sort_by'] ) : 0;

if ( isset( $_POST['sort_dir'] ) )
{
	$sort_dir = ( $_POST['sort_dir'] == 'DESC' ) ? 'DESC' : 'ASC';
}
else
{
	$sort_dir = 'DESC';
}

$start = ( isset( $_GET['start'] ) ) ? intval( $_GET['start'] ) : 0;

$multibyte_charset = 'utf-8, big5, shift_jis, euc-kr, gb2312';
switch ( $mode )
{
	case "results": 
		
		$store_vars = array('search_results', 'total_match_count', 'split_search', 'sort_by', 'sort_dir', 'show_results', 'return_chars');

		// Cycle through options ...
		
			if ( $search_id == '' || $search_keywords != '' )
			{

				$stopword_array = @file( $phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/search_stopwords.txt' );
				$synonym_array = @file( $phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/search_synonyms.txt' );

				$split_search = array();
				$split_search = ( !strstr( $multibyte_charset, $lang['ENCODING'] ) ) ? split_words( clean_words( 'search', stripslashes( $search_keywords ), $stopword_array, $synonym_array ), 'search' ) : explode( ' ', $search_keywords );

				$search_msg_only = ( !$search_fields ) ? "AND m.title_match = 0" : ( ( strstr( $multibyte_charset, $lang['ENCODING'] ) ) ? '' : '' );

				$word_count = 0;
				$current_match_type = 'or';

				$word_match = array();
				$result_list = array();

				for( $i = 0; $i < count( $split_search ); $i++ )
				{
					switch ( $split_search[$i] )
					{
						case 'and':
							$current_match_type = 'and';
							break;

						case 'or':
							$current_match_type = 'or';
							break;

						case 'not':
							$current_match_type = 'not';
							break;

						default:
							if ( !empty( $search_terms ) )
							{
								$current_match_type = 'and';
							}

							if ( !strstr( $multibyte_charset, $lang['ENCODING'] ) )
							{
								$match_word = str_replace( '*', '%', $split_search[$i] );
								$sql = "SELECT m.article_id 
								    FROM " . KB_WORD_TABLE . " w, " . KB_MATCH_TABLE . " m 
									WHERE w.word_text LIKE '$match_word' 
									    AND m.word_id = w.word_id 
										AND w.word_common <> 1 
										$search_msg_only";
							}
							else
							{
								$match_word = addslashes( '%' . str_replace( '*', '', $split_search[$i] ) . '%' );
								$search_msg_only = ( $search_fields ) ? "OR article_title LIKE '$match_word'" : '';
								$sql = "SELECT article_id
								    FROM " . KB_ARTICLES_TABLE . "
									WHERE article_body  LIKE '$match_word'
									$search_msg_only";
							}
							if ( !( $result = $db->sql_query( $sql ) ) )
							{
								mx_message_die( GENERAL_ERROR, 'Could not obtain matched articles list', '', __LINE__, __FILE__, $sql );
							}

							$kb_row = array();
							while ( $temp_row = $db->sql_fetchrow( $result ) )
							{
								$kb_row[$temp_row['article_id']] = 1;

								if ( !$word_count )
								{
									$result_list[$temp_row['article_id']] = 1;
								}
								else if ( $current_match_type == 'or' )
								{
									$result_list[$temp_row['article_id']] = 1;
								}
								else if ( $current_match_type == 'not' )
								{
									$result_list[$temp_row['article_id']] = 0;
								}
							}

							if ( $current_match_type == 'and' && $word_count )
							{
								@reset( $result_list );
								while ( list( $article_id, $match_count ) = @each( $result_list ) )
								{
									if ( !$kb_row[$article_id] )
									{
										$result_list[$article_id] = 0;
									}
								}
							}
							$word_count++;

							$db->sql_freeresult( $result );
					}
				}


				$search_ids = array();
        foreach ( $result_list  as  $article_id => $matches )
				{
					if ( $matches )
					{
						$search_ids[] = $article_id;
					}
				}

				unset( $result_list );
				$total_match_count = count( $search_ids );
			
				// Store new result data
				
				$search_results = implode( ', ', $search_ids );
				$per_page = $board_config['topics_per_page']; 
				
				// Combine both results and search data (apart from original query)
				// so we can serialize it and place it in the DB
				
				$store_search_data = array(); 
				
				// Limit the character length (and with this the results displayed at all following pages) to prevent
				// truncated result arrays. Normally, search results above 12000 are affected.
				// - to include or not to include
				/*
					$max_result_length = 60000;
					if (strlen($search_results) > $max_result_length)
					{
				        $search_results = substr($search_results, 0, $max_result_length);
						$search_results = substr($search_results, 0, strrpos($search_results, ','));
						$total_match_count = count(explode(', ', $search_results));
				    }
					*/
	
				for( $i = 0; $i < count( $store_vars ); $i++ )
				{
					$store_search_data[$store_vars[$i]] = isset(${$store_vars[$i]}) ? ${$store_vars[$i]} : '';
				}
	
				$result_array = serialize( $store_search_data );
				unset( $store_search_data );
	
				mt_srand ( ( double ) microtime() * 1000000 );
				$search_id = mt_rand();
	
				$sql = "UPDATE " . KB_SEARCH_TABLE . " 
				        SET search_id = $search_id, search_array = '" . str_replace( "\'", "''", $result_array ) . "'
						WHERE session_id = '" . $userdata['session_id'] . "'";
				if ( !( $result = $db->sql_query( $sql ) ) || !$db->sql_affectedrows() )
				{
					$sql = "INSERT INTO " . KB_SEARCH_TABLE . " (search_id, session_id, search_array) 
					    	 VALUES($search_id, '" . $userdata['session_id'] . "', '" . str_replace( "\'", "''", $result_array ) . "')";
					if ( !( $result = $db->sql_query( $sql ) ) )
					{
						mx_message_die( GENERAL_ERROR, 'Could not insert search results', '', __LINE__, __FILE__, $sql );
					}
				}
			}
			else
			{
				$search_id = intval($search_id);
				if ( $search_id )
				{
					$sql = "SELECT search_array 
					        FROM " . KB_SEARCH_TABLE . " 
						    WHERE search_id = $search_id  
						        AND session_id = '" . $userdata['session_id'] . "'";
					if ( !( $result = $db->sql_query( $sql ) ) )
					{
						mx_message_die( GENERAL_ERROR, 'Could not obtain search results', '', __LINE__, __FILE__, $sql );
					}
	
					if ( $kb_row = $db->sql_fetchrow( $result ) )
					{
						$search_data = unserialize( $kb_row['search_array'] );
						for( $i = 0; $i < count( $store_vars ); $i++ )
						{
							$$store_vars[$i] = $search_data[$store_vars[$i]];
						}
					}
				}
			} 

			// Look up data ...

			$searchset = array();
			if ( $search_results != '' )
			{
				$sql = "SELECT t.*, u.username, u.user_id 
				        FROM " . KB_ARTICLES_TABLE . " t, " . USERS_TABLE . " u 
					    WHERE t.article_id IN ($search_results) 
					        AND t.article_author_id = u.user_id";

				$per_page = $board_config['topics_per_page'];

				$sql .= " ORDER BY t.article_title $sort_dir LIMIT $start, " . $per_page;

				if ( !$result = $db->sql_query( $sql ) )
				{
					mx_message_die( GENERAL_ERROR, 'Could not obtain search results', '', __LINE__, __FILE__, $sql );
				}

				while ( $kb_row = $db->sql_fetchrow( $result ) )
				{
					$searchset[] = $kb_row;
				}

				$db->sql_freeresult( $result ); 
				
				// Define censored word matches
				
				$orig_word = array();
				$replacement_word = array();
				obtain_word_list( $orig_word, $replacement_word );
			} 
			
			// Output header
			
			$page_title = $lang['KB_title'] . ' - ' . $lang['Search'];
			if ( !$is_block )
			{
				include( $mx_root_path . 'includes/page_header.' . $phpEx );
			}

			// include ( $module_root_path . "includes/kb_header." . $phpEx );

			$template->set_filenames( array( 'body' => 'kb_search_results.tpl' ) 
				);


			$l_search_matches = ( $total_match_count == 1 ) ? sprintf( $lang['Found_search_match'], $total_match_count ) : sprintf( $lang['Found_search_matches'], $total_match_count );

			$template->assign_vars( array( 'L_SEARCH_MATCHES' => $l_search_matches,
					'L_ARTICLE' => $lang['Article'] ) 
				);

			$highlight_active = '';
			$highlight_match = array();
			for( $j = 0; $j < count( $split_search ); $j++ )
			{
				$split_word = $split_search[$j];

				if ( $split_word != 'and' && $split_word != 'or' && $split_word != 'not' )
				{
					$highlight_match[] = '#\b(' . str_replace( "*", "([\w]+)?", $split_word ) . ')\b#is';
					$highlight_active .= " " . $split_word;

					for ( $k = 0; $k < count( $synonym_array ); $k++ )
					{
						$results = explode( ' ', trim( strtolower( $synonym_array[$k] ) ) );
						$replace_synonym = $results[0];
					 	$match_synonym = $results[1];

						if ( $replace_synonym == $split_word )
						{
							$highlight_match[] = '#\b(' . str_replace( "*", "([\w]+)?", $replace_synonym ) . ')\b#is';
							$highlight_active .= ' ' . $match_synonym;
						}
					}
				}
			}

			$highlight_active = urlencode( trim( $highlight_active ) );

			for( $i = 0; $i < count( $searchset ); $i++ )
			{
				$article_url = append_sid( this_kb_mxurl( "mode=article&amp;k=" . $searchset[$i]['article_id'] . "&amp;highlight=$highlight_active", true ) );

				$post_date = create_date( $board_config['default_dateformat'], $searchset[$i]['article_date'], $board_config['board_timezone'] );

				$message = $searchset[$i]['article_body'];
				$article_title = $searchset[$i]['article_title'];
				$article_id = $searchset[$i]['article_id'];

				$kb_cat = get_kb_cat( $searchset[$i]['article_category_id'] );
				$temp_url = append_sid( this_kb_mxurl( 'mode=cat&amp;cat=' . $searchset[$i]['article_category_id'], true ) );
				$category = '<a href="' . $temp_url . '" class="name">' . $kb_cat['category_name'] . '</a>';

				$type = get_kb_type( $searchset[$i]['article_type'] );

				$message = '';

				if ( count( $orig_word ) )
				{
					$article_title = preg_replace( $orig_word, $replacement_word, $searchset[$i]['article_title'] );
				}

				$article_author = '<a href="' . append_sid( $phpbb_root_path . "profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $searchset[$i]['user_id'] ) . '" class="name">';
				$article_author .= $searchset[$i]['username'];
				$article_author .= '</a>';

				$template->assign_block_vars( 'searchresults', array( 'ARTICLE_ID' => $article_id,
						'ARTICLE_AUTHOR' => $article_author,
						'ARTICLE_TITLE' => $article_title,
						'ARTICLE_DESCRIPTION' => $searchset[$i]['article_description'],
						'ARTICLE_CATEGORY' => $category,
						'ARTICLE_TYPE' => $type,

						'U_VIEW_ARTICLE' => $article_url ) 
					);
			}
		

		$base_url = this_kb_mxurl_search( "search_id=$search_id", true );

		$template->assign_vars( array( 'PAGINATION' => generate_pagination( $base_url, $total_match_count, $per_page, $start ),
				'PAGE_NUMBER' => sprintf( $lang['Page_of'], ( floor( $start / $per_page ) + 1 ), ceil( $total_match_count / $per_page ) ),

				'L_AUTHOR' => $lang['Author'],
				'L_MESSAGE' => $lang['Message'],
				'L_TOPICS' => $lang['Article'],
				'L_TYPE' => $lang['Article_type'],
				'L_CATEGORY' => $lang['Category'] ) 
			);

		break;

	default: 
		
		// Output the basic page
		
		$page_title = $lang['KB_title'] . ' - ' . $lang['Search'];
		if ( !$is_block )
		{
			include( $mx_root_path . 'includes/page_header.' . $phpEx );
		}

		//include ( $module_root_path . "includes/kb_header." . $phpEx );

		$template->set_filenames( array( 'body' => 'kb_search_body.tpl' ) 
			);

		$template->assign_vars( array( 'L_SEARCH_QUERY' => $lang['Search_query'],
				'L_SEARCH_KEYWORDS' => $lang['Search_keywords'],
				'L_SEARCH_KEYWORDS_EXPLAIN' => $lang['Search_keywords_explain'],
				'L_SEARCH_ANY_TERMS' => $lang['Search_for_any'],
				'L_SEARCH_ALL_TERMS' => $lang['Search_for_all'],

				'S_SEARCH_ACTION' => append_sid( this_kb_mxurl_search( "mode=results", true ) ),
				'S_HIDDEN_FIELDS' => '<input type="hidden" name="search_fields" value="all" />',
				'S_SEARCH' => $lang['Search'] ) 
			);

		break;
}

$template->pparse( 'body' );
// load footer
//include ( $module_root_path . "includes/kb_footer." . $phpEx );

if ( !$is_block )
{
	include( $phpbb_root_path . 'includes/page_tail.' . $phpEx );
}

?>
