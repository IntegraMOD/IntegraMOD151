<?php
/*
  paFileDB 3.0
  �2001/2002 PHP Arena
  Written by Todd
  todd@phparena.net
  http://www.phparena.net
  Keep all copyright links on the script visible
  Please read the license included with this script for more information.
*/

if (!defined('IN_PHPBB'))
{
  die("Hacking attempt");
}
if( !empty($setmodules) )
{
	$file = basename(__FILE__);
// MX mod
    $module['Download']['License_title'] = $file;
//    $module['Download'][$lang['Alicense']] = "$file?license=add";
//    $module['Download'][$lang['Elicense']] = "$file?license=edit";
//    $module['Download'][$lang['Dlicense']] = "$file?license=delete";
	return;
}

?>
