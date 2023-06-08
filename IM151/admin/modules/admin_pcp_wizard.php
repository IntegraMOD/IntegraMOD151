<?php

/***************************************************************************
 *							admin_pcp_wizard.php
 *							---------------------------
 *	begin				: 07/12/2005
 *	copyright		: Ptirhiik/ednique
 *	email				: ptirhiik@clanmckeen.com/edwin@ednique.com
 *
 *	version				: v 0.6.0 - 07/12/2005
 *
 ***************************************************************************/
/*	
	echo '<pre>';
	print_r($menuactions);
	echo '</pre>'; 
*/
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
	die("Hacking attempt");
}
if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['PCP_management']['PCP_10_wizard'] = $file;
	return;
}

?>