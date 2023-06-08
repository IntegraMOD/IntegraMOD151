<?php
/***************************************************************************
 *                            admin_im_config.php
 *                            -------------------
 *   begin                : Thursday, Jan 23, 2003
 *   version              : 0.4.0
 *   date                 : 2003/12/23 23:20
 ***************************************************************************/

if (!defined('IN_PHPBB'))
{
	die("Hacking attempt");
}
if( !empty($setmodules) )
{
	if (defined('PRILLIAN_INSTALLED')){
		$file = basename(__FILE__);
		$module['Prillian']['Configuration'] = "$file?mode=config";
	}
	return;
}

?>