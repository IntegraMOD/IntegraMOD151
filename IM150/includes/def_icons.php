<?php

/***************************************************************************
 *                            def_icons.php
 *                            -------------
 *	begin			: 06/09/2003
 *	copyright		: Ptirhiik
 *	email			: admin@rpgnet-fr.com
 *	version			: 1.0.0 - 06/09/2003
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

$icones = array(
	array(
			'ind'	=> 1,
			'img'	=> 'images/icon/icon1.gif',
			'alt'	=> 'icon_note',
			'auth'	=> AUTH_ALL,
	),
	array(
			'ind'	=> 2,
			'img'	=> 'images/smiles/icon_arrow.gif',
			'alt'	=> 'icon_important',
			'auth'	=> AUTH_ALL,
	),
	array(
			'ind'	=> 3,
			'img'	=> 'images/smiles/icon_idea.gif',
			'alt'	=> 'icon_idea',
			'auth'	=> AUTH_ALL,
	),
	array(
			'ind'	=> 4,
			'img'	=> 'images/smiles/icon_exclaim.gif',
			'alt'	=> 'icon_warning',
			'auth'	=> AUTH_ALL,
	),
	array(
			'ind'	=> 5,
			'img'	=> 'images/smiles/icon_question.gif',
			'alt'	=> 'icon_question',
			'auth'	=> AUTH_ALL,
	),
	array(
			'ind'	=> 6,
			'img'	=> 'images/smiles/icon_cool.gif',
			'alt'	=> 'icon_cool',
			'auth'	=> AUTH_ALL,
	),
	array(
			'ind'	=> 7,
			'img'	=> 'images/smiles/icon_smile.gif',
			'alt'	=> 'icon_funny',
			'auth'	=> AUTH_ALL,
	),
	array(
			'ind'	=> 8,
			'img'	=> 'images/smiles/icon_mad.gif',
			'alt'	=> 'icon_angry',
			'auth'	=> AUTH_ALL,
	),
	array(
			'ind'	=> 9,
			'img'	=> 'images/smiles/icon_sad.gif',
			'alt'	=> 'icon_sad',
			'auth'	=> AUTH_ALL,
	),
	array(
			'ind'	=> 10,
			'img'	=> 'images/smiles/icon_mrgreen.gif',
			'alt'	=> 'icon_mocker',
			'auth'	=> AUTH_ALL,
	),
	array(
			'ind'	=> 11,
			'img'	=> 'images/smiles/icon_surprised.gif',
			'alt'	=> 'icon_shocked',
			'auth'	=> AUTH_ALL,
	),
	array(
			'ind'	=> 12,
			'img'	=> 'images/smiles/icon_wink.gif',
			'alt'	=> 'icon_complicity',
			'auth'	=> AUTH_ALL,
	),
	array(
			'ind'	=> 13,
			'img'	=> 'images/icon/icon13.gif',
			'alt'	=> 'icon_bad',
			'auth'	=> AUTH_ALL,
	),
	array(
			'ind'	=> 14,
			'img'	=> 'images/icon/icon14.gif',
			'alt'	=> 'icon_great',
			'auth'	=> AUTH_ALL,
	),
	array(
			'ind'	=> 15,
			'img'	=> 'images/smiles/icon_rolleyes.gif',
			'alt'	=> 'icon_disgusting',
			'auth'	=> AUTH_ALL,
	),
	array(
			'ind'	=> 16,
			'img'	=> 'images/smiles/icon_biggrin.gif',
			'alt'	=> 'icon_winner',
			'auth'	=> AUTH_ALL,
	),
	array(
			'ind'	=> 17,
			'img'	=> 'images/smiles/icon_lol.gif',
			'alt'	=> 'icon_impressed',
			'auth'	=> AUTH_ALL,
	),
	array(
			'ind'	=> 18,
			'img'	=> 'images/icon/icon18.gif',
			'alt'	=> 'icon_roleplay',
			'auth'	=> AUTH_ALL,
	),
	array(
			'ind'	=> 19,
			'img'	=> 'images/icon/icon19.gif',
			'alt'	=> 'icon_fight',
			'auth'	=> AUTH_ALL,
	),
	array(
			'ind'	=> 20,
			'img'	=> 'images/icon/icon20.gif',
			'alt'	=> 'icon_loot',
			'auth'	=> AUTH_ALL,
	),
	array(
			'ind'	=> 21,
			'img'	=> 'images/icon/icon21.gif',
			'alt'	=> 'icon_picture',
			'auth'	=> AUTH_MOD,
	),
	array(
			'ind'	=> 22,
			'img'	=> 'images/icon/icon22.gif',
			'alt'	=> 'icon_calendar',
			'auth'	=> AUTH_MOD,
	),
	array(
			'ind'	=> 0,
			'img'	=> '',
			'alt'	=> 'no topic icon',
			'auth'	=> AUTH_ALL,
	),
);

// definition of special topic
$icon_defined_special = array(
	'POST_ATTACHMENT' => array(
		'lang_key'	=> 'Sort_Attachments',
		'icon'		=> 0,
	),
	'POST_CALENDAR' => array(
		'lang_key'	=> 'Calendar',
		'icon'		=> 0,
	),
	'POST_BIRTHDAY' => array(
		'lang_key'	=> 'Birthday',
		'icon'		=> 0,
	),
	'POST_GLOBAL_ANNOUNCE' => array(
		'lang_key'	=> 'Post_Global_Announcement',
		'icon'		=> 0,
	),
	'POST_ANNOUNCE' => array(
		'lang_key'	=> 'Post_Announcement',
		'icon'		=> 0,
	),
	'POST_STICKY' => array(
		'lang_key'	=> 'Post_Sticky',
		'icon'		=> 0,
	),
	'POST_NORMAL' => array(
		'lang_key'	=> 'Post_Normal',
		'icon'		=> 0,
	),
);


?>