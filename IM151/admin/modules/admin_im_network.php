<?php
/***************************************************************************
 *                             admin_im_network.php
 *                            -------------------
 *   begin                : Friday, May 16, 2003
 *   version              : 0.2.0
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
		$module['Prillian']['Network Messaging'] = $filename;
	}
	return;
}

?>