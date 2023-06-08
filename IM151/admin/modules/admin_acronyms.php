<?php
// -------------------------------------------------------------
//
// $Id: ---- $
//
// FILENAME  : admin_acronyms.php
// STARTED   : ----
// COPYRIGHT : © 2005 CodeMonkeyX
// WWW       : http://www.codemonkeyx.net
// LICENCE   : GPL vs2.0 [ see /docs/COPYING ]
//
// -------------------------------------------------------------
// Addon for the Acronym mod from CodeMonkeyX
// Originally made for PHP-Nuke 6.5 by Mighty_Y <http://www.portedmods.com>
// but then also made for phpBB standalone as an act of respect for CodeMonkeyX
// -------------------------------------------------------------

if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['General']['Acronyms'] = $file;
	return;
}

?>