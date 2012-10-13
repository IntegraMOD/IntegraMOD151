<?php
/***************************************************************************
 *                             admin_approve.php
 *                                  v1.0.9
 ***************************************************************************/

if ( !empty($setmodules) )
{
	//$module['General']['Configuration'] = "$file?mode=config";
	
	$file = basename(__FILE__);
	$module['approve_admin_approval']['approve_admin_approve_index'] = $file . "";
	$module['approve_admin_approval']['approve_admin_forum_moderation'] = $file . "?mode=f";
	$module['approve_admin_approval']['approve_admin_post_moderation'] = $file . "?mode=p";
	$module['approve_admin_approval']['approve_admin_topic_moderation'] = $file . "?mode=t";
	$module['approve_admin_approval']['approve_admin_user_moderation'] = $file . "?mode=u";
	return;
}

?>