/***************************************************************************
 *						def_userfields.php
 *						------------------
 *	begin			: 03/10/2003
 *	copyright		: Ptirhiik
 *	email			: admin@rpgnet-fr.com
 *
 *	version			: 1.0.2 - 17/10/2003
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
// tables_linked array
//
//		key = identifier (used in [*])
//
//			sql_id		: id used in sql request,
//			sql_join	: sql FROM statement
//			sql_where	: WHERE statement
//			sql_order	: ORDER BY statement
//
//--------------------------------------------------------------------------------------------------
$tables_linked = array(
	<!-- BEGIN tables -->
	'{tables.NAME}' => array(
		<!-- BEGIN row -->
		'{tables.row.KEY}' => '{tables.row.VALUE}',
		<!-- END row -->
	),
	<!-- END tables -->
);

//--------------------------------------------------------------------------------------------------
//
// $values_list array
//
//		key = values list name
//			func	= special function
//			table	= use tables to build the list
//				main	: main table the list is based on,
//				key		: key field,
//				txt		: text field,
//				img		: image field
//			values	= field values
//				txt		: text or $lang key entry to display
//				img		: img url or $images key entry to display
//--------------------------------------------------------------------------------------------------
$values_list = array(
	<!-- BEGIN values -->
	'{values.NAME}' => array(
		<!-- BEGIN func -->
		'func' => '{values.FUNC}',
		<!-- END func -->
		<!-- BEGIN table -->
		'table' => array(
			'main'	=> '{values.MAIN}',
			'key'	=> '{values.KEY}',
			'txt'	=> '{values.TXT}',
			'img'	=> '{values.IMG}',
		),
		<!-- END table -->
		<!-- BEGIN set -->
		'values' => array(
			<!-- BEGIN val -->
			{values.set.val.VALUE} => array('txt' => '{values.set.val.TXT}', 'img' => '{values.set.val.IMG}'),
			<!-- END val -->
		),
		<!-- END set -->
	),
	<!-- END values -->
);

//--------------------------------------------------------------------------------------------------
//
// $classes_fields array
//
//		key = name of the class,
//
//			config_field	: the config table field set by the admin to restrict the class display to everybody
//			admin_field		: the users table field set by the admin to restrict the class display to a particular user,
//			user_field		: the users table field set by the user (preferences) to restrict the class display,
//			sql_def			: sql definition of the condition field
//
//--------------------------------------------------------------------------------------------------
$classes_fields = array(
	<!-- BEGIN classes -->
	'{classes.NAME}' => array(
		'config_field'	=> '{classes.CONFIG_FIELD}',
		'admin_field'	=> '{classes.ADMIN_FIELD}',
		'user_field'	=> '{classes.USER_FIELD}',
		'sql_def'		=> '{classes.SQL_DEF}',
	),
	<!-- END classes -->
);

//--------------------------------------------------------------------------------------------------
//
// $user_fields array
//
//		key = name of the field,
//
<!-- BEGIN def_title -->
//			{def_title.KEY}{def_title.PAD}: {def_title.L_KEY}
<!-- END def_title -->
//
//--------------------------------------------------------------------------------------------------
$user_fields = array(
	<!-- BEGIN field -->
	<!-- BEGIN comment -->

	// {field.COMMENT} informations
	<!-- END comment -->
	'{field.NAME}' => array(
		<!-- BEGIN row -->
		'{field.row.KEY}'{field.row.PAD} => {field.row.VALUE},
		<!-- END row -->
	),
	<!-- END field -->
);
