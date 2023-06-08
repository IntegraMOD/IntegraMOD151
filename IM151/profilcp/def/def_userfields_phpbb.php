<?php
/***************************************************************************
 *						def_userfields_phpbb.php
 *						------------------------
 *	begin			: 09/10/2003
 *	copyright		: Ptirhiik
 *	email			: admin@rpgnet-fr.com
 *
 *	version			: 1.0.0 - 09/10/2003
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

if ( !defined('IN_ADMIN') )
{
	return;
}

//--------------------------------------------------------------------------------------------------
//
// $phpbb_user_fields array
//
//		key = name of the field,
//
//			type		: type of the field,
//			length		: length of the field,
//			decimal		: number of decimal if type is DECIMAL
//			unsigned	: true/false : unsigned statement
//			not_null	: true/false : not_null statement
//			default		: default value
//
//--------------------------------------------------------------------------------------------------
$phpbb_user_fields = array(

	'user_id' => array(
		'type'		=> 'MEDIUMINT',
		'length'	=> 8,
		'not_null'	=> true,
		'default'	=> 0,
	),
	'user_active' => array(
		'type'		=> 'TINYINT',
		'length'	=> 1,
		'default'	=> 1,
	),
	'username' => array(
		'type'		=> 'VARCHAR',
		'length'	=> 25,
		'not_null'	=> true,
		'default'	=> '',
	),
	'user_password' => array(
		'type'		=> 'VARCHAR',
		'length'	=> 32,
		'not_null'	=> true,
		'default'	=> '',
	),
	'user_session_time' => array(
		'type'		=> 'INT',
		'length'	=> 11,
		'not_null'	=> true,
		'default'	=> 0,
	),
	'user_session_page' => array(
		'type'		=> 'SMALLINT',
		'length'	=> 5,
		'not_null'	=> true,
		'default'	=> 0,
	),
	'user_lastvisit' => array(
		'type'		=> 'INT',
		'length'	=> 11,
		'not_null'	=> true,
		'default'	=> 0,
	),
	'user_regdate' => array(
		'type'		=> 'INT',
		'length'	=> 11,
		'not_null'	=> true,
		'default'	=> 0,
	),
	'user_level' => array(
		'type'		=> 'TINYINT',
		'length'	=> 4,
		'default'	=> 0,
	),
	'user_posts' => array(
		'type'		=> 'MEDIUMINT',
		'length'	=> 8,
		'unsigned'	=> true,
		'not_null'	=> true,
		'default'	=> 0,
	),
	'user_timezone' => array(
		'type'		=> 'DECIMAL',
		'length'	=> 5,
		'decimal'	=> 2,
		'not_null'	=> true,
		'default'	=> '0.00',
	),
	'user_style' => array(
		'type'		=> 'TINYINT',
		'length'	=> 4,
		'default'	=> NULL,
	),
	'user_lang' => array(
		'type'		=> 'VARCHAR',
		'length'	=> 255,
		'default'	=> NULL,
	),
	'user_dateformat' => array(
		'type'		=> 'VARCHAR',
		'length'	=> 14,
		'not_null'	=> true,
		'default'	=> 'd M Y H:i',
	),
	'user_new_privmsg' => array(
		'type'		=> 'SMALLINT',
		'length'	=> 5,
		'unsigned'	=> true,
		'not_null'	=> true,
		'default'	=> 0,
	),
	'user_unread_privmsg' => array(
		'type'		=> 'SMALLINT',
		'length'	=> 5,
		'unsigned'	=> true,
		'not_null'	=> true,
		'default'	=> 0,
	),
	'user_last_privmsg' => array(
		'type'		=> 'INT',
		'length'	=> 11,
		'not_null'	=> true,
		'default'	=> 0,
	),
	'user_emailtime' => array(
		'type'		=> 'INT',
		'length'	=> 11,
		'default'	=> NULL,
	),
	'user_viewemail' => array(
		'type'		=> 'TINYINT',
		'length'	=> 1,
		'default'	=> NULL,
	),
	'user_attachsig' => array(
		'type'		=> 'TINYINT',
		'length'	=> 1,
		'default'	=> NULL,
	),
	'user_setbm' => array(
		'type'		=> 'TINYINT',
		'length'	=> 1,
		'default'	=> NULL,
	),
	'user_allowhtml' => array(
		'type'		=> 'TINYINT',
		'length'	=> 1,
		'default'	=> 1,
	),
	'user_allowbbcode' => array(
		'type'		=> 'TINYINT',
		'length'	=> 1,
		'default'	=> 1,
	),
	'user_allowsmile' => array(
		'type'		=> 'TINYINT',
		'length'	=> 1,
		'default'	=> 1,
	),
	'user_allowavatar' => array(
		'type'		=> 'TINYINT',
		'length'	=> 1,
		'not_null'	=> true,
		'default'	=> 1,
	),
	'user_photo' => array(
		'type'		=> 'VARCHAR',
		'length'	=> 100,
		'default'	=> NULL,
	),
	'user_photo_type' => array(
		'type'		=> 'TINYINT',
		'length'	=> 4,
		'not_null'	=> true,
		'default'	=> 0,
	),
	'user_allowphoto' => array(
		'type'		=> 'TINYINT',
		'length'	=> 1,
		'not_null'	=> true,
		'default'	=> 1,
	),
	'user_allow_pm' => array(
		'type'		=> 'TINYINT',
		'length'	=> 1,
		'not_null'	=> true,
		'default'	=> 1,
	),
	'user_allow_viewonline' => array(
		'type'		=> 'TINYINT',
		'length'	=> 1,
		'not_null'	=> true,
		'default'	=> 1,
	),
	'user_notify' => array(
		'type'		=> 'TINYINT',
		'length'	=> 1,
		'not_null'	=> true,
		'default'	=> 1,
	),
	'user_notify_pm' => array(
		'type'		=> 'TINYINT',
		'length'	=> 1,
		'not_null'	=> true,
		'default'	=> 0,
	),
	'user_popup_pm' => array(
		'type'		=> 'TINYINT',
		'length'	=> 1,
		'not_null'	=> true,
		'default'	=> 0,
	),
	'user_rank' => array(
		'type'		=> 'INT',
		'length'	=> 11,
		'default'	=> 0,
	),
	'user_avatar' => array(
		'type'		=> 'VARCHAR',
		'length'	=> 100,
		'default'	=> NULL,
	),
	'user_avatar_type' => array(
		'type'		=> 'TINYINT',
		'length'	=> 4,
		'not_null'	=> true,
		'default'	=> 0,
	),
	'user_email' => array(
		'type'		=> 'VARCHAR',
		'length'	=> 255,
		'default'	=> NULL,
	),
	'user_icq' => array(
		'type'		=> 'VARCHAR',
		'length'	=> 15,
		'default'	=> NULL,
	),
	'user_website' => array(
		'type'		=> 'VARCHAR',
		'length'	=> 100,
		'default'	=> NULL,
	),
	'user_from' => array(
		'type'		=> 'VARCHAR',
		'length'	=> 100,
		'default'	=> NULL,
	),
	'user_sig'	=> array(
		'type'		=> 'text',
	),
	'user_sig_bbcode_uid' => array(
		'type'		=> 'VARCHAR',
		'length'	=> 10,
		'default'	=> NULL,
	),
	'user_aim' => array(
		'type'		=> 'VARCHAR',
		'length'	=> 255,
		'default'	=> NULL,
	),
	'user_yim' => array(
		'type'		=> 'VARCHAR',
		'length'	=> 255,
		'default'	=> NULL,
	),
	'user_msnm' => array(
		'type'		=> 'VARCHAR',
		'length'	=> 255,
		'default'	=> NULL,
	),
	'user_occ' => array(
		'type'		=> 'VARCHAR',
		'length'	=> 100,
		'default'	=> NULL,
	),
	'user_interests' => array(
		'type'		=> 'VARCHAR',
		'length'	=> 255,
		'default'	=> NULL,
	),
	'user_actkey' => array(
		'type'		=> 'VARCHAR',
		'length'	=> 32,
		'default'	=> NULL,
	),
	'user_newpasswd' => array(
		'type'		=> 'VARCHAR',
		'length'	=> 32,
		'default'	=> NULL,
	),
);

?>