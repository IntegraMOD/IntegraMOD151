<?php
/***************************************************************************
 *							admin_security.php
 *						   --------------------
 *		Version			: 1.0.3
 *		Email			: austin@phpbb-amod.com
 *		Site			: http://phpbb-tweaks.com
 *		Copyright		: aUsTiN-Inc 2003/6
 *
 ***************************************************************************/

if (!defined('IN_PHPBB'))
{
	die("Hacking attempt");
}

if (!empty($setmodules))
{
	$file = basename(__FILE__);
	$module['.: Security :.']['Configuration'] 	= $file;
	$module['.: Security :.']['Special'] 		= append_sid("admin_security.$phpEx?mode=special");
	$module['.: Security :.']['Member Tries']	= append_sid("admin_security.$phpEx?mode=members");
	$module['.: Security :.']['Info: phpinfo']	= append_sid("admin_security.$phpEx?mode=php_info");
	$module['.: Security :.']['Info: gdlib']	= append_sid("admin_security.$phpEx?mode=gd_info");	
	$module['.: Security :.']['Quick Search']	= append_sid("admin_security.$phpEx?mode=search");		
	return;
}

?>