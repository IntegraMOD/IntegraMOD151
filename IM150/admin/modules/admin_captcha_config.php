<?php 
/***************************************************************************
 *							admin_captcha_config.php
 *                         --------------------------
 *   copyright            : (C) 2006 AmigaLink
 *   website              : www.amigalink.de
 *
 *   $Id: admin_captcha_config.php, v 0.0.8 2006/11/12 01:06:00 AmigaLink Exp $
 *
 ***************************************************************************/ 

define('IN_PHPBB', 1);

// First we do the setmodules stuff for the admin cp.
if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['General']['VC_Captcha_Config'] = $filename;

	return;
}
?>