<?php
/*********************************************************************************************************
 This code is part of the FileManager software (www.gerd-tentler.de/tools/filemanager), copyright by
 Gerd Tentler. Obtain permission before selling this code or hosting it on a commercial website or
 redistributing it over the Internet or in any other medium. In all cases copyright must remain intact.
*********************************************************************************************************/

define('IN_PHPBB', TRUE);

	if (!empty($setmodules))
		{
	$file = basename(__FILE__);
	$module['Tools']['Filemanager']    = append_sid("filemanager/filemanager.$phpEx?");		
	return;
		}

?>
