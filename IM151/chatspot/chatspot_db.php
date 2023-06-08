<?php

/***************************************************************************
 *							chatspot_db.php
 *							-------------------
 *	last updated      : August 28, 2004
 *	copyright         : (c) 2004 Project Dream Views; icedawg
 *	email             : phpbbchatspot@dreamviews.com
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

/* **[DESCRIPTION]*********************************************************************************************************
		- provides separate database account(s) for phpBBChatSpot
		- this ensures that if the database query is exceeded by the account(s) assigned to phpBBChatSpot, the forum can
		  still continue functioning normally
	************************************************************************************************************************ */

$db_accounts = array();

//$db_accounts[] = ''; // account name
//$db_accounts[] = ''; // password

//$db_accounts[] = ''; // additional account name (ONLY if needed)
//$db_accounts[] = ''; // password

//$db_accounts[] = ''; // additional account name (ONLY if needed)
//$db_accounts[] = ''; // password

$num_accounts = sizeof( $db_accounts ) / 2;

if( $num_accounts > 0 )
{
	if( $num_accounts > 1 )
		$account_index = rand( 0, $num_accounts - 1 );
	else
		$account_index = 0;

	$dbuser = $db_accounts[ $account_index * 2 ];
	$dbpasswd = $db_accounts[ ( $account_index * 2 ) + 1 ];
}
?>