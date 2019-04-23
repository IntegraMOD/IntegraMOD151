<?php
/***************************************************************************
*                               admin_adr_give_users_spells.php
*                              -------------------
*		begin				: 2005/09/19
*		copyright			: Da Moose
*		Based on			: admin_adr_users and adr_shops by
*								Dr DLP / Malicious Rabbit
*		copyright           : Dr DLP / Malicious Rabbit
*
*
****************************************************************************/
/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
*   (at your option) any later version.
 *
 ***************************************************************************/

if (!defined('IN_PHPBB'))
{
	die('Hacking attempt');
}

if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['ADR Spells']['Give User Spells'] = $filename;
	return;
}
