<?php
/***************************************************************************
 *							def_auth.php
 *							------------
 *	begin			: 07/11/2003
 *	copyright		: Ptirhiik
 *	email			: ptirhiik@clanmckeen.com
 *
 *	Version			: 1.0.0 - 07/11/2003
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
	die("Hacking attempt");
}

// presets
if ( defined('IN_ADMIN') )
{
	// all the presets
//-- mod : announces -------------------------------------------------------------------------------
// here we added for each row a new column for global announcement filled with auth_admin
// and add Global Ann in the comment header
//-- modify
//-- mod : calendar --------------------------------------------------------------------------------
// here we added for each row a new column for calendar auth similar to the sticky value
// and add Calendar in the comment header
//-- modify
	//                View      Read      Post     News      Reply     Edit     Delete   Calendar    Sticky   Announce Global Ann   Vote      Poll		DelayedPost    Warn/ban  Unban       Report
	$simple_auth_ary = array(
		0  => array(AUTH_ALL, AUTH_ALL, AUTH_ALL, AUTH_MOD, AUTH_ALL, AUTH_REG, AUTH_REG, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_ADMIN, AUTH_REG, AUTH_REG, AUTH_MOD, AUTH_MOD, AUTH_ADMIN, AUTH_REG),
		1  => array(AUTH_ALL, AUTH_ALL, AUTH_REG, AUTH_MOD, AUTH_REG, AUTH_REG, AUTH_REG, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_ADMIN, AUTH_REG, AUTH_REG, AUTH_MOD, AUTH_MOD, AUTH_ADMIN, AUTH_REG),
		2  => array(AUTH_REG, AUTH_REG, AUTH_REG, AUTH_MOD, AUTH_REG, AUTH_REG, AUTH_REG, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_ADMIN, AUTH_REG, AUTH_REG, AUTH_MOD, AUTH_MOD, AUTH_ADMIN, AUTH_REG),
		3  => array(AUTH_ALL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_MOD, AUTH_ADMIN, AUTH_ACL, AUTH_ACL, AUTH_MOD, AUTH_MOD, AUTH_ADMIN, AUTH_REG),
		4  => array(AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_ACL, AUTH_MOD, AUTH_ADMIN, AUTH_ACL, AUTH_ACL, AUTH_MOD, AUTH_MOD, AUTH_ADMIN, AUTH_REG),
		5  => array(AUTH_ALL, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_ADMIN, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_ADMIN, AUTH_REG),
		6  => array(AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_ADMIN, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_MOD, AUTH_ADMIN, AUTH_REG),
	);
//-- fin mod : calendar ----------------------------------------------------------------------------
//-- fin mod : announces ---------------------------------------------------------------------------

	$simple_auth_types = array($lang['Public'], $lang['Registered'], $lang['Registered'] . ' [' . $lang['Hidden'] . ']', $lang['Private'], $lang['Private'] . ' [' . $lang['Hidden'] . ']', $lang['Moderators'], $lang['Moderators'] . ' [' . $lang['Hidden'] . ']');
}

// data description
$field_names = array(
	'auth_view' => $lang['View'],
	'auth_read' => $lang['Read'],
	'auth_post' => $lang['Post'],
	'auth_news' => $lang['News'],
	'auth_reply' => $lang['Reply'],
	'auth_edit' => $lang['Edit'],
	'auth_delete' => $lang['Delete'],
//-- mod : calendar --------------------------------------------------------------------------------
//-- add
	'auth_cal' => $lang['Calendar'],
//-- fin mod : calendar ----------------------------------------------------------------------------
	'auth_sticky' => $lang['Sticky'],
	'auth_announce' => $lang['Announce'],
//-- mod : announces -------------------------------------------------------------------------------
//-- add
	'auth_global_announce' => $lang['Global_announce'],
//-- fin mod : announces ---------------------------------------------------------------------------
	'auth_vote' => $lang['Vote'],
	'auth_pollcreate' => $lang['Pollcreate'],
	'auth_delayedpost' => $lang['PostDelayed'],
	'auth_ban' => $lang['Ban'], 
	'auth_greencard' => $lang['Greencard'], 
	'auth_bluecard' => $lang['Bluecard'],
);

attach_setup_forum_auth($simple_auth_ary, $forum_auth_fields, $field_names);

// value description
$forum_auth_levels = array('ALL', 'REG', 'PRIVATE', 'MOD', 'ADMIN');
$forum_auth_const = array(AUTH_ALL, AUTH_REG, AUTH_ACL, AUTH_MOD, AUTH_ADMIN);

?>