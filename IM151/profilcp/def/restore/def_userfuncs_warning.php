<?php

/***************************************************************************
 *							def_userfuncs_warning.php
 *							----------------------------
 *	begin				: 05/12/2004
 *	copyright		: Edwin Bekaert
 *	email				: edwin@ednique.com
 *
 *	version			: 1.0.0 - 05/12/2004
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

function pcp_output_warnings($field_name, $view_userdata, $map_name='')
{
	global $board_config, $images, $lang;
	$user_warnings = $view_userdata[$field_name];
	if ($user_warnings >= $board_config['max_user_bancard']) {
		$txt = $lang['Banned'];
		$img = '<img src="'.$images['icon_r_card'] . '" alt="'. $txt .'">';
	} else if ($user_warnings > 0) {
		$txt =  sprintf($lang['Warnings'],$user_warnings);
		for ($n=0 ; $n<$user_warnings && $user_warnings < $board_config['max_user_bancard'];$n++) {
			$img .= '<img src="'.$images['icon_y_card'].'" alt="'. $txt .'">';
		}
	}
	$res = pcp_output_format($field_name, $txt, $img, $map_name);
	return $res;
}
?>