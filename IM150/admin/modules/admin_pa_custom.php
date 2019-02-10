<?php
/*
  paFileDB 3.0
  ©2001/2002 PHP Arena
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
// MX Addon	
    $module['Download'][$lang['Mfieldtitle']] = $file;
//    $module['Download'][$lang['Afield']] = "$file?mode=add";
//    $module['Download'][$lang['Efield']] = "$file?mode=edit";
//    $module['Download'][$lang['Dfield']] = "$file?mode=delete";
	return;
}

?>
