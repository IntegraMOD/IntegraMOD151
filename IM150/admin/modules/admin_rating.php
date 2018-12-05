<?php
/***************************************************************************
 *                              admin_rating.php v1.1.0
 *                            -------------------
 *   begin                : Friday, Feb 7, 2003
 *   copyright            : (C) 2002 Web Centre Ltd
 *   email                : phpbb@mywebcommunities.com
 *
 *   MODIFICATION HISTORY
 *   v1.0.4 21st March 2003
 *     (V: obfuscated the reference to the POST var here so that searching for old variables doesn't yield wrong results)
 *   - Added HTTP_ POST_ VARS for when REGISTER_GLOBALS is off
 *   - Use standard phpBB call for language file
 *   v1.1.0 19th May 2003
 *   - Added 'Max' method to topic_rating
 ***************************************************************************/

if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['General']['Rating_System'] = $file;
	return;
}

?>
