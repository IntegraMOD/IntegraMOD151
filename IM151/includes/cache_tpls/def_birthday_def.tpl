/***************************************************************************
 *						def_birthday.php
 *						----------------
 *	begin			: 17/12/2003
 *	copyright		: Ptirhiik
 *	email			: admin@rpgnet-fr.com
 *
 *	version			: 1.0.0 - 17/12/2003
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
// $ranks : templates
// -------
//--------------------------------------------------------------------------------------------------
$birthday_today_date = {DAY};
$birthday_today = array(
	<!-- BEGIN cache_row -->
	{cache_row.ID} => array({cache_row.CELLS}),
	<!-- END cache_row -->
);