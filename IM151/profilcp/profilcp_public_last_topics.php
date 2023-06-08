<?php

/***************************************************************************
 *                          profilcp_public_last_topics.php
 *                          -------------------------------
 *	begin				: 16/09/2003
 *	copyright			: Ptirhiik
 *	email				: admin@rpgnet-fr.com
 *
 *	version				: 1.0.1 - 19/10/2003
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
if ( !empty($setmodules) )
{
	pcp_set_sub_menu('viewprofile', 'lasttopics', 30, __FILE__, 'Topic_last', 'Topic_last_settings' );
	return;
}

//
// template file
$template->set_filenames(array(
	'body' => 'profilcp/public_last_topics_body.tpl')
);

include_once( $phpbb_root_path . './includes/functions_last_topics_from.' . $phpEx );

last_topics_from($view_userdata);

$template->assign_vars(array(
	'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
	'S_PROFILCP_ACTION' => append_sid("profile.$phpEx"),
	)
);

// page
$template->pparse('body');

?>