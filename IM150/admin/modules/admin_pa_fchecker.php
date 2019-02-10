<?php
/*
  paFileDB 3.1
  ©2001/2002 PHP Arena
  Written by Todd
  todd@phparena.net
  http://www.phparena.net
  Keep all copyright links on the script visible
  Please read the license included with this script for more information.
  This script was programmed by Andrew Langland <andy@razza.org>
*/

if (!defined('IN_PHPBB'))
{
  die("Hacking attempt");
}
if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['Download']['Fchecker'] = $file;
	return;
}

?>
