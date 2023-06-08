
/***************************************************************************
 *                            def_qbar.php
 *                            ------------
 *	begin			: 22/07/2003
 *	copyright		: Ptirhiik
 *	email			: admin@rpgnet-fr.com
 *	version			: 1.0.3 - 29/10/2003
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

//----------------------------------------------------------------------------
//	$qbar_maps[map_name]
//  --------------------
//		[class]				constant : class of bar : System, Bar, Menu
//		[display]			switch : do we display this qbar (System never are)
//		[cells]				value : number of cells used to display the bar before carriage return
//		[in_table]			switch : Do we draw a table around the qbar
//		[style]				value : Qbar specific to a style
//		[sub_template]		value : Qbar specific to a sub-template (optionnal) : *ALL means ignore
//		[fields]			array : options of the qbar
//			[shortcut]		value : lang[] key or value for the shortcut displayed
//			[alternate]		value : lang[] key or value for shortcut when pms are more than one
//			[explain]		value : lang[] key or value for the shortcut used as title or alt on mouseover
//			[icon]			value : images[] key or url to the icon 
//			[use_value]		switch : we use the value to display
//			[use_icon]		switch : we use the icon to display
//			[url]			value : url of the prog to call while clicking on shortcut
//			[internal]		switch : does tbe program is in phpBB dirs ? if true, do append_sid() with
//			[auth_logged]	switch : ignore/required/denied to : the option will be display if
//			[auth_admin]	switch : ignore/required/denied to : admin user check
//			[auth_pm]		switch : ignore/new_pm/unread pm/no new nor unread : pm check
//			[tree_id]		value : if the user is authorized to the forum tree level (auth view)
//----------------------------------------------------------------------------

$qbar_maps = array(
	<!-- BEGIN _outfile_qbar -->

	{_outfile_qbar.NAME} => array(
		'class'			=> {_outfile_qbar.CLASS},
		'display'		=> {_outfile_qbar.DISPLAY},
		'cells'			=> {_outfile_qbar.CELLS},
		'in_table'		=> {_outfile_qbar.IN_TABLE},
		'style'			=> {_outfile_qbar.STYLE},
		'sub_template'	=> {_outfile_qbar.SUB_TEMPLATE},
		'fields'		=> array(
			<!-- BEGIN fields -->
			{_outfile_qbar.fields.NAME} => array(
				<!-- BEGIN row -->
				{_outfile_qbar.fields.row.FIELD} {_outfile_qbar.fields.row.TABS}=> {_outfile_qbar.fields.row.VALUE},
				<!-- END row -->
			),
			<!-- END fields -->
		),
	),
	<!-- END _outfile_qbar -->

	// standard forum tree
	'default_tree' => array(
		'class'			=> 'System',
		'display'		=> false,
		'cells'			=> 0,
		'in_table'		=> false,
		'sub_template'	=> '*ALL',
		'fields'		=> array(
		),
	),
);