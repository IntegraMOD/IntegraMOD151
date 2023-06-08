<?php
/***************************************************************************
 *                             admin_im_log.php
 *                            -------------------
 *   begin                : Wednesday, May 21, 2003
 *   version              : 0.3.0
 *   date                 : 2003/12/23 23:20
 ***************************************************************************/

if (!defined('IN_PHPBB'))
{
	die("Hacking attempt");
}
if( !empty($setmodules) )
{
	if (defined('PRILLIAN_INSTALLED')){
		$filename = basename(__FILE__);
		$module['Prillian']['Message Log'] = $filename;
	}
	return;
}

?>