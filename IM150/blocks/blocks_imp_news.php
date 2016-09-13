<?php
/***************************************************************************
 *                            blocks_imp_news.php
 *                            -------------------
 *   begin                : Saturday, March 20, 2004
 *   copyright            : (C) 2004 masterdavid - Ronald John David
 *   website              : http://www.integramod.com
 *   email                : webmaster@integramod.com
 *
 *   note: removing the original copyright is illegal even you have modified
 *         the code.  Just append yours if you have modified it.
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

if(!function_exists(imp_news_block_func))
{
	function imp_news_block_func()
	{
		global $phpbb_root_path, $phpEx, $lang, $_GET;

		include_once ($phpbb_root_path . 'includes/news.' . $phpEx );

		$content = new NewsModule( $phpbb_root_path );

		$content->setVariables( array(
			'L_INDEX' => $lang['Index'],
			'L_CATEGORIES' => $lang['Categories'],
			'L_BY' => $lang['By'],
			'L_ARCHIVES' => $lang['Archives']
			) );

		if( (isset( $_GET['news']  ) && $_GET['news'] == 'categories') )
		{
		  // View the news categories.
		  $content->setVariables( array( 'TITLE' => $lang['News'] . ' ' . $lang['Categories'] ) );
		  $content->renderTopics( );
		}
		elseif( isset( $_GET['news']  ) && $_GET['news'] == 'archives' )
		{
		  // View the news Archives.
		  $year   = (isset( $_GET['year'] )) ? $_GET['year'] : 0;
		  $month  = (isset( $_GET['month'] )) ? $_GET['month'] : 0;
		  $day    = (isset( $_GET['day'] )) ? $_GET['day'] : 0;
		  $key    = (isset( $_GET['key'] )) ? $_GET['key'] : '';

		  $content->setVariables( array( 'TITLE' => $lang['News'] . ' ' . $lang['Archives'] ) );
		  $content->renderArchives( $year, $month, $day, $key );
		}
		else
		{
		  // View news articles.
		  $topic_id = 0;
		  if( isset( $_GET['topic_id'] ) )
		  {
			$topic_id = $_GET['topic_id'];
		  }
		  elseif( isset( $_GET['news_id'] ) )
		  {
			$topic_id = $_GET['news_id'];
		  }

		  $content->setVariables( array( 'TITLE' => $lang['News'] . ' ' . $lang['Articles'] ) );
		  $content->renderArticles( $topic_id );
		}

		$content->renderPagination();
	}
}

imp_news_block_func();
?>