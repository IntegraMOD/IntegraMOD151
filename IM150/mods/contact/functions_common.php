<?php
/***************************************************************************
 *                            functions_common.php
 *                            -------------------
 *   begin                : Saturday, Jan 25, 2003
 *   version              : 1.3.0
 *   date                 : 2003/12/23 23:23
 ***************************************************************************/

/***************************************************************************
 *								THOUL SAYS
 *   This file contains functions that both Prillian and Contact List require.
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
}

// Avoid including the file more than once.
if ( defined('CF_INCLUDED') )
{
	return;
}
define('CF_INCLUDED', true);

// in_m_array()
// This function is used to provide search method dealing with two dimensional
// arrays.  Many SQL queries used in phpBB/Prillian/BID List are stored in such
// arrays, so it's helpful to have a way of finding specific things in these
// arrays.  If the $needle is found in $haystack's second dimension, then the
// function will return any array containing TRUE and the key of the first
// dimension in which $needle was found.
function in_m_array($needle, $haystack)
{ 
	$haystack_size = count($haystack);
	if( !$haystack_size )
	{
		return false;
	}
	for( $i = 0; $i < $haystack_size; $i++ )
	{
		if( in_array($needle, $haystack[$i]) )
		{
			return true;
		}
/*		// Search all of second dimension
		$i_size = count($haystack[$i]);
		for( $j = 0; $j < $i_size; $j++ )
		{ 
			if ( $haystack[$i][$j] == $needle )
			{ 
				return array(true, $i);
			} 
		}
*/	} 

	return false; 
}

function server_specs()
{
	global $board_config;

	$server = array();
	$server['protocol'] = ($board_config['cookie_secure']) ? 'https://' : 'http://';
	$server['name'] = preg_replace('#^\/?(.*?)\/?$#', '\1', trim($board_config['server_name']));
	$server['port'] = ($board_config['server_port'] <> 80) ? ':' . trim($board_config['server_port']) : '';
	$server['script'] = preg_replace('#^\/?(.*?)\/?$#', '\1', trim($board_config['script_path']));
	$server['script'] = ($server['script'] == '') ? $server['script'] : '/' . $server['script'];

	return $server;
}

/* thoul_redirect()
	This is based on phpBB's redirect() function. Since that function is not present
	in older versions of phpBB, this function is used instead of redirect() for
	compatiblity with those phpBB versions. The only difference from redirect() is
	that append_sid is used in this function, so it's not needed to call append_sid
	when calling this function. */
function thoul_redirect($url)
{
	global $db;

	if (!empty($db))
	{
		$db->sql_close();
	}

	$url = append_sid($url, true);
	$server = server_specs();

	$url = preg_replace('#^\/?(.*?)\/?$#', '/\1', trim($url));

	// Redirect via an HTML form for PITA webservers
	if (@preg_match('/Microsoft|WebSTAR|Xitami/', getenv('SERVER_SOFTWARE')))
	{
		header('Refresh: 0; URL=' . $server['protocol'] . $server['name'] . $server['port'] . $server['script'] . $url);
		echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta http-equiv="refresh" content="0; url=' . $server['protocol'] . $server['name'] . $server['port'] . $server['script'] . $url . '"><title>Redirect</title></head><body><div align="center">If your browser does not support meta redirection please click <a href="' . $server['protocol'] . $server['name'] . $server['port'] . $server['script'] . $url . '">HERE</a> to be redirected</div></body></html>';
		exit;
	}

	// Behave as per HTTP/1.1 spec for others
	header('Location: ' . $server['protocol'] . $server['name'] . $server['port'] . $server['script'] . $url);
	exit;
}

function auto_close()
// Used for automatically closing a window.
// Page headers & footers are not needed.
{
	global $template, $lang, $db;

	$db->sql_close();

	$template->set_filenames(array(
		'autoclose' => 'autoclose.tpl')
	);

	$template->assign_vars(array(
		'L_NO_AUTOCLOSE' => $lang['No_autoclose'])
	);

	$template->pparse('autoclose');
	exit;
}

function secure_superglobals()
// Runs addslashes on superglobal $_REQUEST if magic_quotes_gpc is off.
// phpBB uses the depreciated HTTP_*_VARS and does not do this for superglobals.
{
	if( function_exists('get_magic_quotes_gpc') && @get_magic_quotes_gpc() )
	{
		return; // magic_quotes_gpc is on, we can skip this and continue.
	}

	// magic_quotes_gpc is off, so we'll run addslashes. I'm using the
	// $_REQUEST superglobal, since it's a combo of $_GET, $_POST, and $_COOKIE.
	// Using $_REQUEST will result in less code elsewhere, too.

	if( is_array($_REQUEST) )
	{
		foreach($_REQUEST as $k1=>$v1)
		{
			if( is_array($v1) )
			{
				foreach($v1 as $k2=>$v2)
				{
					$_REQUEST[$k1][$k2] = addslashes($v2);
				}
			}
			else
			{
				$_REQUEST[$k1] = addslashes($v1);
			}
		}
	}
}

// Used for debugging. Spits out the contents of a variable
function debug_test($var)
{
/*
	echo '<pre>';
		var_dump($var);
	echo '</pre>';
*/

	ob_start();
	if( is_array($var) )
	{
		foreach($var as $key=>$val)
		{
			echo $key . "\t\n";
			var_dump($val);
		}
	}
	else
	{
		var_dump($var);
	}
	$dump = ob_get_contents();
	ob_end_clean();
	if( $dump == '' )
	{
		echo 'No output!';
	}
	else
	{
		highlight_string($dump);
	}
	die;
}

?>