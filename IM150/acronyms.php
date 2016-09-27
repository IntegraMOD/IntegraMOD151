<?php
// -------------------------------------------------------------
//
// $Id: ---- $
//
// FILENAME  : acronyms.php
// STARTED   : ----
// COPYRIGHT : © 2005 CodeMonkeyX
// WWW       : http://www.codemonkeyx.net
// LICENCE   : GPL vs2.0 [ see /docs/COPYING ]
//
// -------------------------------------------------------------
// Addon for the Acronym mod from CodeMonkeyX
// Originally made for PHP-Nuke 6.5 by Mighty_Y <http://www.portedmods.com>
// but then also made for phpBB standalone as an act of respect for CodeMonkeyX
// -------------------------------------------------------------

define('IN_PHPBB', 1);
$phpbb_root_path = './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.'.$phpEx);

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_VIEWMEMBERS);
init_userprefs($userdata);
//
// End session management
//
$page_title = $lang['Acronyms'];

include('includes/page_header.'.$phpEx);

$template->set_filenames(array(
	"body" => "acronym_body.tpl")
);
	
$sql = "SELECT * FROM " . ACRONYMS_TABLE . "
		ORDER BY acronym ASC";

if( !$result = $db->sql_query($sql) )
{
	message_die(GENERAL_ERROR, "Could not obtain acronym data", "", __LINE__, __FILE__, $sql);
}

$i=0;

while( $acronym_row = $db->sql_fetchrow($result) )
{	
	$acronym = $acronym_row['acronym'];
	$description = $acronym_row['description'];
	$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
	$template->assign_block_vars("acronym_row", array(
		"ROW_CLASS" => $row_class,
		"ACRONYM" => $acronym,
		"DESCRIPTION" => $description)
	);	
	$i++;
}

$template->assign_vars(array(
    'L_ACRONYM' => $lang['Acronym'],
    'L_DESCRIPTION' => $lang['Description'],
	'L_ACRONYMS' => $lang['Acronyms'], // Correct Titles :: Added
	)
);

$template->pparse("body");

include('includes/page_tail.'.$phpEx);
?>