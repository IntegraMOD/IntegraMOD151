<?php
/***************************************************************************
 *                            admin_im_users.php
 *                            -------------------
 *   begin                : Saturday, Nov 30, 2002
 *   version              : 0.4.5
 *   date                 : 2003/12/23 23:20
 ***************************************************************************/

if( !empty($setmodules) )
{
	if (defined('PRILLIAN_INSTALLED')){
		$filename = basename(__FILE__);
		$module['Prillian']['User Admin'] = $filename;
	}
	return;
}

?>