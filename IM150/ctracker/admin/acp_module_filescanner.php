<?php
/**  
* <b>acp_module_filescanner.php</b><br>
* Check the Security of all your Board files
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

$admin_filescan = new ct_adminfunctions();

/*
 * Wich action do we have?
 */
$action = $HTTP_GET_VARS['action'];


/*
 * Template handling
 */
$template->set_filenames(array(
	'ct_body' => 'ctracker/acp/acp_filescanner.tpl')
);


if( $action == 'scan' )
{
	// scan files
	$admin_filescan->DropData();
	$admin_filescan->CreateFileList($phpbb_root_path, '', $phpEx);
	$admin_filescan->ScanFile();
	
	$timestamp = time();
	$ctracker_config->change_configuration('last_file_scan', $timestamp);
	$ctracker_config->settings['last_file_scan'] = $timestamp;
	
	$template->assign_block_vars('akt_complete', array(
		'L_UPDATE_ACTION'	=> $lang['ctracker_fscan_complete'])
	);	
}
else if ( $action == 'display' )
{
	/*
	 * Lets check the files for changes
	 */
	$sql = 'SELECT * FROM ' . CTRACKER_FILESCANNER;
	$table_class = false;
	
	if ( (!$result = $db->sql_query($sql)) )
	{
		message_die(CRITICAL_ERROR, $lang['ctracker_error_database_op'], '', __LINE__, __FILE__, $sql);
	}
	
	$template->assign_block_vars('header_table_cell', array());
	
	while( $row = $db->sql_fetchrow($result) )
	{
		$table_class    = !$table_class;
		$color  		= '';		
		$filestatus 	= '';
		
		if ( $row['safety'] == 10 )
		{
			// File was not scanned yet
			$filestatus = $lang['ctracker_fscan_unchecked'];
			$color		= '#FF8C2F';
		}
		else if ( $row['safety'] == 0 )
		{
			// File is declared as safe
			$filestatus = $lang['ctracker_fscan_ok'];
			$color		= '#269F00';	
		}
		else
		{
			// Maybe there is an issue
			$color      = '#FF1200';
			
			switch( $row['safety'] )
			{
				case 1:  $filestatus = $lang['ctracker_fscan_prob_1'];
						 break;
				
				case 2:  $filestatus = $lang['ctracker_fscan_prob_2'];
						 break;
						
				case 3:  $filestatus = $lang['ctracker_fscan_prob_3'];
						 break;
						
				case 4:  $filestatus = $lang['ctracker_fscan_prob_4'];
						 break;
						
				case 5:  $filestatus = $lang['ctracker_fscan_prob_5'];
						 break;
						
				default: $filestatus = $lang['ctracker_fscan_prob_def'];
						 break;
			}
		}
		
		$path_cleaned = str_replace('./../', '', $row['filepath']);
		
		$template->assign_block_vars('file_output', array(
			'PATH'	 => $path_cleaned,
			'STATUS' => $filestatus,
			'CLASS'  => ($table_class)? 'row1' : 'row2',
			'COLOR'  => $color)
		);		
	}
}
else
{
	/*
	 * No action selected
	 */
	$template->assign_block_vars('no_action', array(
	    'L_IMPORTANT'		=> $lang['ctracker_fscan_important'],
		'L_SELECT_ACTION'	=> $lang['ctracker_fscan_sel_action'])
	);
}


/*
 * Send some vars to the template
 */
$template->assign_vars(array(
	'L_HEADLINE' 		=> $lang['ctracker_fscan_head'],
	'L_SUBHEADLINE'		=> sprintf($lang['ctracker_fscan_subhead'], date($board_config['default_dateformat'], $ctracker_config->settings['last_file_scan'])),
	'L_FUNC_HEADER'		=> $lang['ctracker_fchk_funcheader'],
	'L_TABLE_HEADER'	=> $lang['ctracker_fchk_tableheader'],
	'L_OPTION_1'		=> $lang['ctracker_fscan_option1'],
	'L_OPTION_2'		=> $lang['ctracker_fscan_option2'],
	'L_ALT_TEXT'		=> $lang['ctracker_img_descriptions'],
	
	'L_TABLEHEAD_1'		=> $lang['ctracker_fchk_tablehead1'],
	'L_TABLEHEAD_2'		=> $lang['ctracker_fchk_tablehead2'],
	
	'U_LINK_OPTION_1'	=> append_sid('admin_cracker_tracker.' . $phpEx . '?modu=3&action=scan'),
	'U_LINK_OPTION_2'	=> append_sid('admin_cracker_tracker.' . $phpEx . '?modu=3&action=display'),
	
	'IMG_ICON_1'		=> $phpbb_root_path . $images['ctracker_fc_icon_1'],
	'IMG_ICON_2'		=> $phpbb_root_path . $images['ctracker_fc_icon_2'])
  );
  

// Generate the page
$template->pparse('ct_body');

unset($admin_filescan);

?>
