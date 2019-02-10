<?php
/*************************************************************************** 
*                            admin_prune_users.php 
*             php Admin Script for prune users mod 
*                       ------------------- 
*   begin                : April 30, 2002 
*   email                : ncr@db9.dk HTTP://mods.db9.dk 
*      ver. 1.0.2. 
* 
* 
*   History:
* 	 0.9.0. - initial BETA
*      0.9.1. - added prune inativated option
*	 0.9.2. - added support for the end user easely can customise the
*			 interface with more options    
*	 0.9.3. - changed $lang['prune'] to $lang['Prune__commands']
*	 0.9.4. - added prune "avarage posts prune
*	 0.9.5. - now support own language file, the complete mod, require litle change in existing files
*	 0.9.6. - change the javascript name, in the template file
*      1.0.0. - considered as final, included a limit about how meny users max can be deleted at once
*      1.0.1. - fixed a HTML tag, in the admin URL
*      1.0.2. - moved to users section in ACP
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

if (!defined('IN_PHPBB'))
{
	die("Hacking attempt");
}
if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['Users'][$lang['Prune_users']] = $filename;
	return;
}

?>