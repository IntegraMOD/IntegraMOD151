<?php
/*********************************************************************************************************
 This code is part of the FileManager software (www.gerd-tentler.de/tools/filemanager), copyright by
 Gerd Tentler. Obtain permission before selling this code or hosting it on a commercial website or
 redistributing it over the Internet or in any other medium. In all cases copyright must remain intact.
*********************************************************************************************************/

  header('Cache-control: private, no-cache, must-revalidate');
  header('Expires: Sat, 01 Jan 2000 00:00:00 GMT');
  header('Date: Sat, 01 Jan 2000 00:00:00 GMT');
  header('Pragma: no-cache');

define('IN_PHPBB', TRUE);

	if (!empty($setmodules))
		{
	$file = basename(__FILE__);

if ( ($userdata['user_level'] == ADMIN) && ($userdata['user_id'] == 2) )
	{
	$module['Tools']['Filemanager']    = append_sid("./filemanager/filemanager.$phpEx?");		
	}

	return;
		}

?>
