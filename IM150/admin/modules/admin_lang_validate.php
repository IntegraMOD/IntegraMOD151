<?php

/***************************************************************************
 *							admin_lang_validate.php
 *							---------------------
 *	begin				: 16/07/2005
 *	copyright		: The Integramod Team
 *	website			: www.integramod.com
 *
 *	version			: v 1.0.0 - 16/07/2005
 *
 ***************************************************************************/

if (!defined('IN_PHPBB'))
{
	die("Hacking attempt");
}
if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['Languages']['Lang_validate'] = $file;
	return;
}

?>