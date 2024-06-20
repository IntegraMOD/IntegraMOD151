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

// V: for now, this is merged with "pcp_output_warnings".
//    it NEEDS TO BE a different field, because only admins can see 
include_once($phpbb_root_path . "includes/functions_report.$phpEx");
function pcp_output_advanced_report_hack($field_name, $view_userdata, $map_name='')
{
	global $phpbb_root_path, $phpEx, $template, $board_config;

	$report_user = report_modules('name', 'report_user');

	$can_report = $report_user && $report_user->auth_check('auth_write');
	$template->assign_var('CAN_REPORT', $can_report);
	if ($can_report)
	{
		$template->set_filenames(array('report_pcp_template' => 'profilcp/report_body.tpl'));
		$template->assign_vars(array(
			'U_REPORT_USER' => append_sid("report.$phpEx?mode=" . $report_user->mode . '&amp;id=' . $view_userdata['user_id']),
			'L_REPORT_USER' => $report_user->lang['Write_report'])
		);
		return $template->render_to_string('report_pcp_template');
	}
	return '';
}

function pcp_output_warnings($field_name, $view_userdata, $map_name='')
{
	global $board_config, $images, $lang;
	$user_warnings = $view_userdata[$field_name];
	$img = $txt = '';
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
	$res .= pcp_output_advanced_report_hack($field_name, $view_userdata, $map_name);
	return $res;
}
?>
