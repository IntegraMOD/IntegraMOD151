<?php

/***************************************************************************
 *							def_userfuncs_skype.php
 *							----------------------------
 *	begin				: 03/01/2004
 *	copyright		: CyberNord 
 *	email				: < cybernord@hotmail.com > http://www.cybernord.com 
 *
 *	version			: 1.0.1 - 05/12/2004
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 *
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
	exit;
}

function pcp_output_skype($field_name, $view_userdata, $map_name='') 
{ 
   global $board_config, $phpbb_root_path, $phpEx, $lang, $images, $userdata; 
   global $values_list, $tables_linked, $classes_fields, $user_maps, $user_fields; 

   $txt = ''; 
   $img = ''; 
   $res = ''; 
   if ( !empty($view_userdata[$field_name]) && ($view_userdata['user_id'] != ANONYMOUS) ) 
   { 
      $temp_url = 'callto://' . $view_userdata[$field_name]; 
      $txt = '<a href="' . $temp_url . '" title="' . $view_userdata[$field_name] . '">' . $lang['SKYPE'] . '</a>'; 
      $img = '<a class="icon_contact_skype" href="' . $temp_url . '" title="' . $lang['SKYPE'] . '"><span class="icon-skype">&nbsp;</span></a>'; 

      // result 
      $res = pcp_output_format($field_name, $txt, $img, $map_name); 
   } 
   return $res; 
} 
?>