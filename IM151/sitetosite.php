<?php
/***************************************************************************
 *                              sitetosite.php
 *                            -------------------
 *   begin                : Thursday, Apr 17, 2003
 *   version              : 0.2.0
 *   date                 : 2003/12/23 23:19
 ***************************************************************************/
define('IN_PHPBB', true);
define('IN_NETWORK', true);

$phpbb_root_path = './';
include_once($phpbb_root_path . 'extension.inc');
include_once($phpbb_root_path . 'config.'.$phpEx);
include_once($phpbb_root_path . 'includes/constants.'.$phpEx);
include_once($phpbb_root_path . 'includes/db.'.$phpEx);
$die_string = 'Disabled';

$sql = 'SELECT * FROM ' . CONFIG_TABLE;
if( !$result = $db->sql_query($sql, false, 'board_config') )
{
	$db->sql_close();
	die($die_string . "\nCould not get phpBB config data");
}

while ( $row = $db->sql_fetchrow($result) )
{
	$board_config[$row['config_name']] = $row['config_value'];
}

include_once(PRILL_PATH . 'prill_common.'.$phpEx);

// mode check
$mode = ( !empty($_REQUEST['mode']) ) ? $_REQUEST['mode'] : 'users';

// Are instant messages disabled? Is site-to-site disabled?
if ( !$prill_config['allow_ims'] || !$prill_config['allow_network'] )
{
	exit_the_network();
}

if ( $mode == 'users' )
{
	// Print out the list of online users
	include(PRILL_PATH . 'network_users.'.$phpEx);
}
elseif( $mode == 'detect' )
{
	echo $prill_config['version'] . "\n";
	echo $phpEx . "\n";
	echo $prill_config['network_profile'] . "\n";
	echo $board_config['sitename'];
	exit_the_network();
}
elseif( $mode == 'post' || $mode == 'reply' )
{
	// Receive a post
	include(PRILL_PATH . 'network_receive.'.$phpEx);
}

?>