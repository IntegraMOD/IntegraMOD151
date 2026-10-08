/***************************************************************************
 *						def_usermaps.php
 *						----------------
 *	begin			: 04/10/2003
 *	copyright		: Ptirhiik
 *	email			: admin@rpgnet-fr.com
 *
 *	version			: 1.0.2 - 23/10/2003
 *
 *	last update		: {TIME} by {USERNAME}
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

//--------------------------------------------------------------------------------------------------
//
// $user_maps array
//
//		key = name of the map,
//			order	: order,
//			split	: split the display in a new column
//			custom	: use a dedicated program or a standard program : 0: dedicated, 1: standard input, 2: standard output
//			title	: title or set of fields
//			fields	: set of fields
//
//			title and fields :
<!-- BEGIN def_title -->
//				{def_title.KEY}{def_title.PAD}: {def_title.L_KEY}
<!-- END def_title -->
//
//--------------------------------------------------------------------------------------------------
$user_maps = array(
	<!-- BEGIN map -->

	'{map.NAME}' => array(
		<!-- BEGIN order -->
		'order'		=> {map.ORDER},
		<!-- END order -->
		<!-- BEGIN split -->
		'split'		=> {map.SPLIT},
		<!-- END split -->
		<!-- BEGIN custom -->
		'custom'	=> {map.CUSTOM},
		<!-- END custom -->
		<!-- BEGIN title_single -->
		'title'		=> '{map.TITLE_SINGLE}',
		<!-- END title_single -->
		<!-- BEGIN block -->
		'{map.block.NAME}'	=> array(
			<!-- BEGIN field -->
			'{map.block.field.NAME}' => array(
				<!-- BEGIN def -->
				'{map.block.field.def.DEF_KEY}'{map.block.field.def.PAD} => {map.block.field.def.VALUE},
				<!-- END def -->
			),
			<!-- END field -->
		),
		<!-- END block -->
	),
	<!-- END map -->
);