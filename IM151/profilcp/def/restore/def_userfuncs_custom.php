<?php

/***************************************************************************
 *							def_userfuncs_custom.php
 *							------------------------
 *	begin				: 30/10/2003
 *	copyright			: Ptirhiik
 *	email				: Ptirhiik@rpgnet.clanmckeen.com
 *
 *	version				: 1.0.0 - 30/10/2003
 *
 ***************************************************************************
 *
 *								Customs functions
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

//----------------------------------------------------
//
//	Add-on	: The name of your add-on
//	Author	: Your references
//	Version	: x.x.x
//
//----------------------------------------------------

function pcp_output_value_list($field_name, $view_userdata, $map_name='') 
{ 
   global $board_config, $phpbb_root_path, $phpEx, $lang, $images, $userdata; 
   global $values_list, $tables_linked, $classes_fields, $user_maps, $user_fields; 

   if ( ($view_userdata['user_id'] != ANONYMOUS) ) 
   { 
      $values_list_name = $user_fields[$field_name]['values']; 
      if ( !empty($map_name) && !empty($user_maps[$map_name]['fields'][$field_name]['values']) ) 
      { 
         $values_list_name = $user_maps[$map_name]['fields'][$field_name]['values']; 
      } 
      $txt = ''; 
      $img = ''; 
      if ( !empty($values_list_name) && isset($values_list[$values_list_name]['values'][ $view_userdata[$field_name] ]) ) 
      { 
         $txt = $values_list[$values_list_name]['values'][ $view_userdata[$field_name] ]['txt']; 
         $img = $values_list[$values_list_name]['values'][ $view_userdata[$field_name] ]['img']; 
      } 

      // result 
      $res = pcp_output_format($field_name, $txt, $img, $map_name); 
   } 
   return $res; 
}

//-----------------------------------
//
// user_country output function
//
//-----------------------------------
function pcp_output_country($field_name, $view_userdata, $map_name='') 
{ 
   global $board_config, $phpbb_root_path, $phpEx, $lang, $images, $userdata; 
   global $values_list, $tables_linked, $classes_fields, $user_maps, $user_fields; 

   if ( ($view_userdata['user_id'] != ANONYMOUS) ) 
   { 
      $values_list_name = $user_fields[$field_name]['values']; 
      if ( !empty($map_name) && !empty($user_maps[$map_name]['fields'][$field_name]['values']) ) 
      { 
         $values_list_name = $user_maps[$map_name]['fields'][$field_name]['values']; 
      } 
      $txt = ''; 
      $img = ''; 
      if ( !empty($values_list_name) && isset($values_list[$values_list_name]['values'][ $view_userdata[$field_name] ]) ) 
      { 
         $txt = $values_list[$values_list_name]['values'][ $view_userdata[$field_name] ]['txt'];
         $img_txt = $values_list[$values_list_name]['values'][ $view_userdata[$field_name] ]['img'];
         $img = '<img src="images/country/' . $img_txt . '.gif" border="0" alt="' . $txt . '" title="' . $txt . '" />';
      } 
      if ( $view_userdata['user_country'] == '0' )
	  {
		  $img = '<div align="center">';
	  }
      // result 
      $res = pcp_output_format($field_name, $txt, $img, $map_name); 
   } 
   return $res; 
}


//-----------------------------------
//
// user_state output function
//
//-----------------------------------
function pcp_output_state($field_name, $view_userdata, $map_name='') 
{ 
   global $board_config, $phpbb_root_path, $phpEx, $lang, $images, $userdata; 
   global $values_list, $tables_linked, $classes_fields, $user_maps, $user_fields; 

   if ( ($view_userdata['user_id'] != ANONYMOUS) ) 
   { 
      $values_list_name = $user_fields[$field_name]['values']; 
      if ( !empty($map_name) && !empty($user_maps[$map_name]['fields'][$field_name]['values']) ) 
      { 
         $values_list_name = $user_maps[$map_name]['fields'][$field_name]['values']; 
      } 
      $txt = ''; 
      $img = ''; 
      if ( !empty($values_list_name) && isset($values_list[$values_list_name]['values'][ $view_userdata[$field_name] ]) ) 
      { 
         $txt = $values_list[$values_list_name]['values'][ $view_userdata[$field_name] ]['txt'];
         $img_txt = $values_list[$values_list_name]['values'][ $view_userdata[$field_name] ]['img'];
         $img = '<img src="images/state/' . $img_txt . '.gif" border="0" alt="' . $txt . '" title="' . $txt . '" />';
      } 
      if ( $view_userdata['user_state'] == '0' )
	  {
		  $img = '</div>';
	  }
      // result 
      $res = pcp_output_format($field_name, $txt, $img, $map_name); 
   } 
   return $res; 
}

//-----------------------------------
//
// user_photo output function for profile photo
//
//-----------------------------------
function pcp_output_photo($field_name, $view_userdata, $map_name='')
{
	global $board_config, $phpbb_root_path, $phpEx, $lang, $images, $userdata;
	global $values_list, $tables_linked, $classes_fields, $user_maps, $user_fields;

	$txt = '';
	$img = '';
	$res = '';

	if ( !empty($view_userdata[$field_name]) && $userdata['user_viewphoto'] && $view_userdata['user_allowphoto'] && ($view_userdata['user_id'] != ANONYMOUS) )
	{
		switch ($view_userdata[$field_name . '_type'] )
		{
			case USER_AVATAR_UPLOAD:
				$img = ( $board_config['allow_photo_upload'] ) ? '<img src="' . $board_config['photo_path'] . '/' . $view_userdata[$field_name] . '" alt="' . $lang['Photo'] . '" border="0" />' : '';
				break;
			case USER_AVATAR_REMOTE:
				$img = ( $board_config['allow_photo_remote'] ) ? '<img src="' . $view_userdata[$field_name] . '" alt="' . $lang['Photo'] . '" border="0" />' : '';
				break;
			case USER_AVATAR_GALLERY:
				$img = ( $board_config['allow_photo_local'] ) ? '<img src="' . $board_config['photo_gallery_path'] . '/' . $view_userdata[$field_name] . '" alt="' . $lang['Photo'] . '" border="0" />' : '';
				break;
		}
	}

		// result
		$res = pcp_output_format($field_name, $txt, $img, $map_name);
	return $res;
}


//----------------------------------------------------
//
//   Add-on   : The name of your add-on
//   Author   : Your references
//   Version   : x.x.x
//
//----------------------------------------------------
//-----------------------------------


?>