<?php
/***************************************************************************
 *                                news.inc
 *                            -------------------
 *   begin                : July 17th, 2003
 *   copyright            : (C) 2003 CodeMonkeyX.net
 *   email                : webmaster@codemonkeyx.net
 *
 *   version              : 0.1
 *
 ***************************************************************************/


if ( !defined('IN_PHPBB') )
{
  die("Hacking attempt");
}

require_once $phpbb_root_path . 'includes/news_common.' . $phpEx;
require_once $phpbb_root_path . 'includes/news_data.' . $phpEx;
require_once $phpbb_root_path . 'includes/bbcode.' . $phpEx;

/**
 * Class which displays news content.
 */
class NewsModule
{
  /**
  * news data access abstraction object.
  * @var object
  */
  var $data;

  /**
  * path to phpbb.
  * @var object
  */
  var $root_path;

  /**
  * default file extension.
  * @var object
  */
  var $phpEx;

  var $template;
  var $config;
  var $name;
  var $item_count;

  /**
  * Class constructor.
  *
  * @param string   (optional) location of the templates directory.
  *
  * @return void
  *
  * @access public
  */
  function NewsModule( $root_path )
  {
    global $CFG, $db, $phpEx, $template, $board_config;

    $this->root_path  = 'http://' . $board_config['server_name'] . $board_config['script_path'];
    $this->phpEx      = $phpEx;
    $this->template   = &$template;
    $this->config     = &$board_config;
    $this->name = 'news';
    $this->item_count = 1;
    
    $index_file = $this->config['news_index_file']; 
    if( $this->config['news_base_url'] != '' ) { 
      $index_file = $this->config['news_base_url'] . $index_file; 
    }
    
    $this->setVariables( array(
        'INDEX_FILE' => $index_file,
        'ROOT_PATH' => $this->root_path
        ));

    $this->data = new NewsDataAccess( $root_path );
  }

  /**
  * prepares a list of articles.
  *
  * @param integer (optional) the article id to the article to be displayed.
  *
  * @return void
  *
  * @access private
  */
  function prepareArticles( $articles, $show_abstract = false )
  {
    global $CFG, $lang, $board_config, $_SERVER, $images, $phpEx;

    if( is_array( $articles ) )
    {
      foreach( $articles as $article )
      {
        $trimmed = false;

        // Trim the post body if needed.
        if( $show_abstract && $this->config['news_item_trim'] > 0 )
        {
          $article['post_abstract'] = $this->trimText( $article['post_text'], $this->config['news_item_trim'], $trimmed );
          $article['post_abstract'] = $this->parseMessage( $article['post_abstract'] . ' ... ', $article['bbcode_uid'] );
        }

        $article['post_text'] = $this->parseMessage( $article['post_text'], $article['bbcode_uid'] );

		$this->setVariables(array( 
			"TELL_LINK" => append_sid("http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?topic_id=" . $article['topic_id'], true),
			'L_TELL_FRIEND' => $lang['Tell_Friend'],
			'L_PRINTER_TOPIC' => $lang['Printer_topic'],
			'NEWS_EMAIL_IMAGE' => $images['news_email'],
			'NEWS_PRINT_IMAGE' => $images['news_print']
			)
		);

        $this->setBlockVariables( 'articles', array(
                    'L_TITLE' => $this->news_smilies_pass($article['topic_title']),
                    'L_TITLE2' => $article['topic_title'],
                    'ID' => $article['topic_id'],
                    'KEY' => $article['article_key'],
                    'DAY' => $this->getDay( $article['topic_time'] ),
                    'MONTH' => $this->getMonth( $article['topic_time'] ),
                    'YEAR' => $this->getYear( $article['topic_time'] ),
                    'CATEGORY' => $article['news_category'],
                    'CAT_ID' => $article['news_id'],
                    'CAT_IMG' => $this->root_path . 'images/news/' . $article['news_image'],
                    'POST_DATE' => create_date($board_config['default_dateformat'], $article['post_time'], $board_config['board_timezone']),
                    'RFC_POST_DATE' => gmdate( 'r', $article['post_time'] + (3600 * $this->config['board_timezone']) ),
                    'POSTER_ID' => $article['user_id'],
                    'L_POSTER' => $article['username'],
                    'L_COMMENTS' => $lang['Comments'] . ' (' . $article['topic_replies'] . ')',
					'U_PRINTER_TOPIC' => append_sid("viewtopic.$phpEx?printertopic=1&" . POST_TOPIC_URL . "=". $article['topic_id'] . "&vote=viewresult"),
                    'U_COMMENTS' => $this->root_path . 'viewtopic.' . $this->phpEx . '?t=' . $article['topic_id'],
                    'BODY' => ($show_abstract && $trimmed) ? $article['post_abstract'] : $article['post_text'],
                    'READ_MORE_LINK' => ($show_abstract && $trimmed) ? '<a href="' . $this->config['news_base_url'] . $CFG['index_file'] . '?topic_id=' . $article['topic_id'] . '" alt="' . $lang['Read_More'] . '"><img src="' . $images['read_more'] .'" border="0" alt="' . $lang['Read_More'] . '"></a>' : ''
                    ) );
      }
    }
  }

  /**
  * Fetches articles from the database, and prepares them for display.
  *
  * @param integer (optional) the article id to the article to be displayed.
  *
  * @return void
  *
  * @access private
  */
  function renderArticles( $article_id = 0, $num_items = 0 )
  {
    $this->item_count = 1;

    $catid  = (isset( $_GET['cat_id'] )) ? $_GET['cat_id'] : 0;
    $start  = (isset( $_GET['start'] )) ? $_GET['start'] : 0;
    $this->item_count = $this->data->fetchArticlesCount( $catid );

	if( $article_id <= 0 )
    {
      if( $num_items > 0 ) {
        $this->data->setItemCount( $num_items );
      }
      else {
        $this->data->setItemCount( $this->config['news_item_num'] );
      }

      $articles = $this->data->fetchArticles( 0, $catid, $start );
    }
    else
    {
      $start  = (isset( $_GET['start'] )) ? $_GET['start'] : 0;

      $articles = $this->data->fetchArticle( $article_id );
      $this->renderComments( $article_id, $start );
    }

    $this->prepareArticles( $articles, ($article_id <= 0) );
  }

  /**
  * Prepares the comments for display.
  *
  * @param integer  the article id to fetch the comments for.
  *
  * @return void
  *
  * @access public
  */
  function renderComments( $article_id, $start = 0 )
  {
    $trimmed = false;

    $comments = $this->data->fetchPosts( $article_id, $start );
    $this->item_count = $this->data->fetchPostsCount( $article_id );

    if( is_array( $comments ) )
    {
      foreach( $comments as $comment )
      {
        $comment['post_text'] = $this->parseMessage( $comment['post_text'], $comment['bbcode_uid'] );

        $this->setBlockVariables( 'comments', array(
                    'L_TITLE' => $comment['post_subject'],
                    'POST_DATE' => gmdate( 'm-d-Y h:i:s a', $comment['post_time'] + (3600 * $this->data->boardconfig['board_timezone']) ),
                    'L_POSTER' => ($comment['username'] == '') ? $comment['post_username'] : $comment['username'],
                    'BODY' => $comment['post_text']
                    ) );
      }
    }
  }

  function renderTopics( )
  {
    $categories = $this->data->fetchCategories( );

    if( is_array( $categories ) )
    {
      foreach( $categories as $category )
      {
        $this->setBlockVariables( 'categories', array(
                    'ID' => $category['news_id'],
                    'TITLE' => $category['news_category'],
                    'IMAGE' => $this->root_path . 'images/news/' . $category['news_image'],
                    ) );
      }
    }
  }

  function renderDay( $year, $month, $day, $key = '' )
  {
	global $lang;

    $this->setBlockVariables( 'arch.year', array(
                  'YEAR' => $year
                  ) );

    $this->setBlockVariables( 'arch.year.month', array(
                'L_MONTH' => $lang['datetime'][date( 'F', mktime( 0,0,0,$month,1,0 ) )],
                'POST_COUNT' => '',
                'MONTH' => $month
                ) );

    $this->setBlockVariables( 'arch.year.month.day', array(
                'L_DAY' => date( 'jS', mktime( 0,0,0,$month,$day,0 ) ),
                'POST_COUNT' => '',
                'DAY' => $day
                ) );

    $articles = $this->data->fetchDay( $day, $month, $year, $key );

    $this->prepareArticles( $articles, true );
  }

  function renderDays( $year, $month )
  {
    $days = $this->data->fetchDays( $month, $year );

    for( $d = 31; $d >= 1; $d-- )
    {
      if( $days[$d] > 0 )
      {
        $this->setBlockVariables( 'arch.year.month.day', array(
                    'L_DAY' => date( 'jS', mktime( 0,0,0,$month,$d,0 ) ),
                    'POST_COUNT' => '('.$days[$d].')',
                    'DAY' => $d
                    ) );
      }
    }
  }

  function renderMonths( $year, $month = 0 )
  {
    global $lang; 

    $months = $this->data->fetchMonths( $year );

    for( $m = 12; $m >= 1; $m-- )
    {
      if( $months[$m] > 0 )
      {
        $this->setBlockVariables( 'arch.year.month', array(
                    'L_MONTH' => $lang['datetime'][date( 'F', mktime( 0,0,0,$m,1,0 ) )],
                    'POST_COUNT' => '('.$months[$m].')',
                    'MONTH' => $m
                    ) );
        if( $month > 0 && $month == $m )
        {
          $this->renderDays( $year, $m );
        }
      }
    }
  }

  function renderYears( $year = 0, $month = 0 )
  {
    $years = $this->data->fetchYears( );

    if( $years == array( ) ) { 
       return '';
    }

    $render_all = !( $year > 0 && $year >= $years['min'] && $year <= $years['max'] );

    for( $y = $years['max']; $y >= $years['min']; $y-- )
    {
      $this->setBlockVariables( 'arch.year', array(
                  'YEAR' => $y
                  ) );

      if( $render_all || $year == $y )
      {
        $this->renderMonths( $y, $month );
      }
    }
  }

  function renderArchives( $year = 0, $month = 0, $day = 0, $key = '' )
  {
    $this->setBlockVariables( 'arch', array( 'TITLE' => $lang['archives'] ) );

    if( $day > 0 && $month > 0 && $year > 0 )
    {
      $this->setBlockVariables( 'arch', array( 'CLASS' => 'class="arch-menu"' ) );
      $this->renderDay( $year, $month, $day, $key );
    }
    else
    {
      $this->setBlockVariables( 'arch', array( ) );
      $this->renderYears( $year, $month );
    }
  }
  
  /**
  * Sets up the Sydication Specific template variables.
  *
  * @param integer Overides the number of items to be rendered.
  * @return void
  *
  * @access public
  */
  function renderSyndication( $num_items = 0 ) 
  {
    $this->setVariables( array( 
      'TITLE'       => $this->config['sitename'],
      'URL'         => 'http://' . trim( $this->config['server_name'] ) . trim( $this->config['script_path'] ),
      'FORUM_PATH'  => $this->config['script_path'],
      'DESC'        => $this->config['news_rss_desc'],
      'LANGUAGE'    => $this->config['news_rss_language'],
      'COPY_RIGHT'  => 'Copyright 2003, ' . $this->config['sitename'],
      'EDITOR'      => $this->config['board_email'],
      'WEBMASTER'   => $this->config['board_email'],
      'TTL'         => $this->config['news_rss_ttl'],
      'CATEGORY'    => $this->config['news_rss_cat'],
	  'LAST_BUILD'   => date( 'r', mktime( 0,0,0,date('m'),date('d'),date('y') ) ),

      'GENERATOR'   => 'phpBB 2' . $this->config['version'] . ' : CMX News Mod',
      'PUB_DATE'    => date( 'r', mktime( 0,0,0,date('m'),date('d'),date('y') ) )
      ) );
    
    if( $this->config['news_rss_image'] != '' &&
        $this->config['news_rss_image_desc'] != '' ) {
      $this->setBlockVariables( 'image', array(
        'IMAGE'       => $this->config['news_rss_image'],
        'IMAGE_TITLE' => $this->config['news_rss_image_desc']
        ));
    }
    
    $this->item_count = 1;

    $catid  = (isset( $_GET['cat_id'] )) ? $_GET['cat_id'] : 0;

    if( $num_items > 0 ) {
      $this->data->setItemCount( $num_items );
    }
    else {
      $this->data->setItemCount( $this->config['news_rss_item_count'] );
    }

    $articles = $this->data->fetchArticles( 0, $catid );
 
    $this->prepareArticles( $articles, $this->config['news_rss_show_abstract'] );
  }
  
  /**
  * prepares all the template variables ready for display.
  *
  * @return void
  *
  * @access public
  */
  function render( )
  {
    global $lang;

    // reset the item count.
 
    $this->setVariables( array(
        'L_INDEX' => $lang['Index'],
        'L_CATEGORIES' => $lang['Categories'],
        'L_ARCHIVES' => $lang['Archives']
        ) );

    if( (isset( $_GET['news']  ) && $_GET['news'] == 'topics') )
    {
      $this->setVariables( array( 'TITLE' => $lang['News'] . ' ' . $lang['Categories'] ) );
      $this->renderTopics( );
    }
    elseif( isset( $_GET['news']  ) && $_GET['news'] == 'archives' )
    {
      $year   = (isset( $_GET['year'] )) ? $_GET['year'] : 0;
      $month  = (isset( $_GET['month'] )) ? $_GET['month'] : 0;
      $day     = (isset( $_GET['day'] )) ? $_GET['day'] : 0;
      $key     = (isset( $_GET['key'] )) ? $_GET['key'] : '';

      $this->setVariables( array( 'TITLE' => $lang['News'] . ' ' . $lang['Archives'] ) );
      $this->renderArchives( $year, $month, $day, $key );
    }
    else
    {
      $topic_id = 0;
      if( isset( $_GET['topic_id'] ) )
      {
        $topic_id = $_GET['topic_id'];
      }
      elseif( isset( $_GET['news_id'] ) )
      {
        $topic_id = $_GET['news_id'];
      }

      $this->setVariables( array( 'TITLE' => $lang['News'] . ' ' . $lang['Articles'] ) );
      $this->renderArticles( $topic_id );
    }

    $this->renderPagination();
  }
  // {{{ trimString( )

  function renderPagination()
  {
    global $CFG;

	  if(!$_GET['topic_id'])
	  {
		  $news_items = $this->config['news_item_num'];
	  }
	  else
	  {
	 	  $news_items = DEFAULT_NUM_ITEMS;
	  }


    if( $this->item_count > $news_items )
    {
      $base_url = $CFG['index_file'] . '?news=article';
       if( isset( $_GET['topic_id'] ) )
      {
        $base_url .= '&amp;topic_id=' . $_GET['topic_id'];
      }
	  if( isset( $_GET['cat_id'] ) )
      {
        $base_url .= '&amp;cat_id=' . $_GET['cat_id'];
      }

      $this->setBlockVariables( 'pagination', array(
          'PAGINATION' => generate_pagination( $base_url, $this->item_count, $news_items, $_GET['start'] )
          ));
    }
  }

  /**
  * Trims a given string to the passed length.
  *
  * @access public
  *
  * @param string $source The string to be trimmed..
  * @param integer $length The length the string is to be trimmed to.
  *
  * @return string The resulting trimmed string.
  */
  function trimString( $source, $length )
  {
    $length = intval( $length );

    if( $length <= 0 || strlen( $source ) < $length )
    {
      return $source;
    }

    $result = trim( $source );  // Remove leading and trailing whitespace.
    $result = strip_tags( $result );  // Remove any html or php tags.
    $result = html_entity_decode( $result );  // Convert special entities to characters.

    $result = substr( $result, 0, $length );

    return htmlspecialchars( $result );
  }

  // }}}

  // {{{ trimText( )

  /**
  * Post based on a delimeter present in the source text.
  *
  * @access public
  *
  * @param string $source The string to be trimmed.
  * @param string $delim The delimeter used to mark the break in text.
  *
  * @return string The resulting trimmed string.
  */
  function trimText( &$text, $size, &$trimmed )
  {
    $pos = strpos( $text, htmlspecialchars( '<!--break-->' ) );
    if( ($pos !== false) && ($pos < strlen( $text )) ) {
      $trimmed = true;
      return substr( $text, 0, $pos );
    }
    // Breaks up the message by blocks of bbcodes.
    // The message is divided into two parts,
    // 1. text inside a pair of bbcode tags.
    // 2. text not contained inside a pair of bbcode tags.
    $segments = preg_split(
          '#(\[([a-zA-Z]+?).*?\].+?\[/\\2.*?\])#s' ,
          $text, -1,
          PREG_SPLIT_NO_EMPTY);
    
	$offset = 0;
	foreach( $segments as $segment )
    {
	  $segment_length = strpos($text,$segment,$offset);
      if( ($segment_length + strlen($segment) > $size) &&
        ($segment_length <= $size) )
      // $size fall inside the current block.
      {
        $trimmed = true;
        return substr( $text, 0, $size );
      }
      elseif( $segment_length > $size )
      // We have gone past the trim point.
      {
        $trimmed = true;
        return substr( $text, 0, $segment_length );
      }
	  $offset = $segment_length + 1;
    }
    $trimmed = false;
    return $text;

  }

  // }}}

  // {{{ decodeBBText( )

  /**
  * Converts BBCode tags to thier html equivelents.
  *
  * @access public
  *
  * @param string $text The body of text to be processed.
  * @param string $bbcode_uid BBCode unique id needed for decoding.
  *
  * @return string The resulting decoded text.
  */
  function decodeBBText( $text, $bbcode_uid )
  {
    if( !isset( $text ) || !isset( $bbcode_uid ) || strlen( $text ) <= 0 )
    {
      return;
    }

    //
    // Parse message and/or sig for BBCode if reqd
    //

    if ( $bbcode_uid != '' )
    {
      $text = ( $this->config['allow_bbcode'] ) ? bbencode_second_pass($text, $bbcode_uid) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $text);
    }

    $text = make_clickable($text);

    //
    // Parse smilies
    //
    if ( $this->config['allow_smilies'] )
    {
      $text = $this->news_smilies_pass($text);
      $text = preg_replace( "/images\/smiles/", $this->root_path . $this->config['smilies_path'], $text );
    }

    $text = str_replace("\n", "\n<br />\n", $text);

    if( function_exists( 'acronym_pass' ) )
    {
      $text = acronym_pass( $text );
    }

    return $text;
  }

  // }}

  function parseMessage( $text, $bbcode_uid )
  {
    $text  = $this->decodeBBText( $text, $bbcode_uid );

    // BEGIN CMX News Mod
    // Strip out the <!--break--> delimiter.
    $delim = htmlspecialchars( '<!--break-->' );
    $pos = strpos( $text, $delim );
    if( ($pos !== false) && ($pos < strlen( $text )) ) {
      $text = substr_replace( $text, html_entity_decode($delim), $pos, strlen($delim) );
    }
    // END CMX News Mod
    
    return $text;
  }

  function setVariables( $variables )
  {
    $this->template->assign_vars( $variables );
  }

  function setBlockVariables( $block, $variables )
  {
    $this->template->assign_block_vars( $block, $variables );
  }

  function display( )
  {
    $this->template->pparse( $this->name );
  }

  function clear( )
  {
    $this->template->destroy( );
  }

  function getYear( $timestamp )
  {
    return $this->getDateComp( 'Y', $timestamp );
  }

  function getMonth( $timestamp )
  {
    return $this->getDateComp( 'm', $timestamp );
  }

  function getDay( $timestamp )
  {
    return $this->getDateComp( 'd', $timestamp );
  }

  function getDateComp( $format, $timestamp )
  {
    return gmdate( $format, $timestamp );
  }

  function news_smilies_pass($message)
  {
	global $portal_config;
	
	if(!$portal_config['cache_enabled'])
	{
		static $orig, $repl;
		if (!isset($orig))
		{
			global $db, $board_config;
			$orig = $repl = array();
			$sql = 'SELECT * FROM ' . SMILIES_TABLE;
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Couldn't obtain smilies data", "", __LINE__, __FILE__, $sql);
			}
			$smilies = $db->sql_fetchrowset($result);
			if (count($smilies))
			{
				usort($smilies, 'smiley_sort');
			}
			for ($i = 0; $i < count($smilies); $i++)
			{
				$orig[] = "/(?<=.\W|\W.|^\W)" . phpbb_preg_quote($smilies[$i]['code'], "/") . "(?=.\W|\W.|\W$)/";
				$repl[] = '<img src="'. $board_config['smilies_path'] . '/' . $smilies[$i]['smile_url'] . '" alt="' . $smilies[$i]['emoticon'] . '" border="0" />';
			}
		}
	}else
	{
		global $db, $board_config, $var_cache;

		$orig = $repl = array();
		$orig=$var_cache->get('orig', 86400, 'smilies');
		$repl=$var_cache->get('repl', 86400, 'smilies');
		if(!$orig)
		{
			$sql = 'SELECT * FROM ' . SMILIES_TABLE;
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Couldn't obtain smilies data", "", __LINE__, __FILE__, $sql);
			}
			$smilies = $db->sql_fetchrowset($result);
			if (count($smilies))
			{
				usort($smilies, 'smiley_sort');
			}
			for ($i = 0; $i < count($smilies); $i++)
			{
				$orig[] = "/(?<=.\W|\W.|^\W)" . phpbb_preg_quote($smilies[$i]['code'], "/") . "(?=.\W|\W.|\W$)/";
				$repl[] = '<img src="'. $board_config['smilies_path'] . '/' . $smilies[$i]['smile_url'] . '" alt="' . $smilies[$i]['emoticon'] . '" border="0" />';
			}
			$var_cache->save($orig, 'orig', 'smilies');
			$var_cache->save($repl, 'repl', 'smilies');
		}
    }

	if (count($orig))
	{
		$message = preg_replace($orig, $repl, ' ' . $message . ' ');
		$message = substr($message, 1, -1);
	}
	
	return $message;
  }
}
?>
