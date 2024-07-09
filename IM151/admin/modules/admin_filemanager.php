<?php
/*********************************************************************************************************
 This code is part of the FileManager software (www.gerd-tentler.de/tools/filemanager), copyright by
 Gerd Tentler. Obtain permission before selling this code or hosting it on a commercial website or
 redistributing it over the Internet or in any other medium. In all cases copyright must remain intact.
*********************************************************************************************************/

if (!defined('IN_PHPBB'))
{
	die("Hacking attempt");
}
if (!empty($setmodules))
{
	$file = basename(__FILE__);

	if ( ($userdata['user_level'] == ADMIN) && ($userdata['user_id'] == 2) )
	{
		// V: disabled, idk what this is
		// $module['Tools']['Filemanager']    = append_sid("admin_filemanager.$phpEx?");		
	}

	return;
}

?>
