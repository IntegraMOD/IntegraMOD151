<?php
/***************************************************************************
 *                          admin_album_config_extended.php
 *                          ------------------------------------------------
 *     begin                : Friday, September 13, 2004
 *     copyright            : (C) 2004 IdleVoid
 *     email                : idlevoid@slater.dk
 *     file version         : 1.0.0BETA
 *     release              : 1.0.0
 *
 *     release              : 1.3.0 (for the Album Category Hierarchy mod)
 ****************************************************************************/

 // NOTE : THIS IS STILL A BETA, USE IT ON YOUR OWN RISK !!!!

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

//------------------------------------------------------------------------
// just some 'cheap' anti hacking attempts ;)
//------------------------------------------------------------------------
if (!defined('IN_PHPBB'))
{
	die("Hacking attempt");
}

//------------------------------------------------------------------------
// setup the link to this phpbb ACP 'module'
//------------------------------------------------------------------------
if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['Photo_Album']['Configuration'] = $filename;
	return;
}
//------------------------------------------------------------------------

?>