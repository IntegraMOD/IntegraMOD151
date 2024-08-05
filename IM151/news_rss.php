<?php
/***************************************************************************
 *                              news_rss.php
 *                            -------------------
 *   begin                : Monday, January 13th 2003
 *   email                : webmaster@codemonkeyx.net
 *
 *
 ***************************************************************************/

//
// Set up for phpBB intergration.
//
define('IN_PHPBB', true);
$phpbb_root_path = './';

//
// phpBB related files
//

include_once( $phpbb_root_path . 'extension.inc' );
include_once( $phpbb_root_path . 'common.' . $phpEx );
include_once ($phpbb_root_path . 'includes/news.' . $phpEx );

if( $board_config['allow_rss'] != 1 )
{
  echo 'RSS has been disabled for this site';
  return;
}

header("Content-type: text/xml");
//
// Start session management
//
$userdata = session_pagestart( $user_ip, PAGE_INDEX );
init_userprefs( $userdata );

//
// End session management
//

// Tell the template class which template to use.
$template->set_filenames( array( 'news' => 'news_200_rss_body.tpl' ) );
    
$content = new NewsModule( $phpbb_root_path );

$content->setVariables( array(
    'L_INDEX' => $lang['Index'],
    'L_CATEGORIES' => $lang['Categories'],
    'L_ARCHIVES' => $lang['Archives']
    ) );

$content->renderSyndication( );

$content->display( );
$content->clear( );
