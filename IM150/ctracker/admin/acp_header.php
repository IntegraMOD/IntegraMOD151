<?php
/**  
* <b>acp_header.php</b><br>
* A header file wich we can include in all ACP Modules
* 
* @author Christian Knerr (cback)
* @package ctracker
* @version 5.0.0
* @since 26.07.2006 - 13:29:09
* @copyright (c) 2006 www.cback.de
* 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*/

// Constant check
if ( !defined('IN_PHPBB') || !defined('CTRACKER_ACP') )
{
	die('Hacking attempt!');
}


/*
 * Currently we have just the header template here but we created this file
 * to ensure that we have a global ACP file if we need one in the future.
 */

$template->set_filenames(array(
	'ct_header' => 'ctracker/acp/acp_header.tpl')
);


// Send some vars to the template
$template->assign_vars(array(
		'HEADER_BACKGROUND_IMAGE' => $phpbb_root_path . $images['ctracker_acp_bg'],
		'HEADER_LOGO'			  => $phpbb_root_path . $images['ctracker_acp_logo'],
		'L_PICTURE'				  => $lang['ctracker_img_descriptions'])
	);


// Generate the page
$template->pparse('ct_header');


?>
