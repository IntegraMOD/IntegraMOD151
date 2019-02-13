<?php
/***************************************************************************
 *                            lang_easymod.php [English]
 *                              -------------------
 *   begin                : Saturday, Mar 22 2003
 *   copyright            : (C) 2002-2004 by Nuttzy - Craig Nuttall, 2005 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: lang_easymod_english.php,v 1.15 2007/02/22 03:32:21 wgeric Exp $
 *
 ****************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/


//
// EasyMOD
//

// Name of the language, to write in this language
$lang['EM_lang_name'] = 'English';

// EM module entries in the ACP
$lang['Modifications'] = 'MOD Center';
$lang['MOD_ainstall'] = 'Install MODs';
$lang['MOD_settings'] = 'EasyMOD Settings';
$lang['MOD_history'] = 'EasyMOD History';

// header
$lang['EM_Title'] = 'EasyMOD - Automatic MOD Installer';

// login
$lang['EM_access_warning'] = 'A password is required to access the EasyMOD automatic MOD installer.  Anyone with access could potentially access the database and FTP login information without the board owner knowing.';
$lang['EM_password'] = 'Password';
$lang['EM_access_EM'] = 'Access EasyMOD';

// history (installed MODs)
$lang['EM_Installed'] = 'Installed MODs';
$lang['EM_installed_desc'] = 'All of these MODs have been installed at one time or another on your board.  In later versions you will be able to get more details or uninstall the MODs from here.';
$lang['EM_install_date'] = 'Installed';
$lang['EM_details'] = 'Details';
$lang['EM_No_mod_selected'] = 'No MOD selected.  Please go back and select one.';
$lang['EM_tables_added'] = 'Tables Added';
$lang['EM_tables_altered'] = 'Tables Altered';
$lang['EM_rows_added'] = 'Rows Added';
$lang['EM_db_alt'] = 'Database Alterations';
$lang['EM_del_files'] = 'Delete MOD Files';
$lang['EN_del_record'] = 'Delete MOD Record';
$lang['EM_install_new_lang'] = 'Install MOD on new languages';
$lang['EM_install_new_themes'] = 'Install MOD on new themes';
$lang['EM_restore_backups'] = 'Restore Backups';
$lang['EM_uninstall'] = 'Uninstall MOD';
$lang['Coming_soon'] = 'Coming Soon!';
$lang['EM_back_to_history'] = 'Back to History';
$lang['EM_are_you_sure'] = 'Are you sure you want to perform the requested operation?';
$lang['EM_record_deleted'] = 'The selected MOD Record has been removed from the database.';
$lang['EM_warning_deldir'] = 'WARNING: To fully remove this MOD from your system, you must delete the following directory:';

// settings
$lang['EM_settings_pw'] = 'The EasyMOD password will allow you to restrict which admins can use EasyMOD. By having access to EasyMOD an admin could covertly obtain your database user/pass and FTP info.  Leave both the password and the confirm password empty to have no password set.  Leave the confirm empty to not change the password.';
$lang['EM_read_server'] = 'server';
$lang['EM_write_server'] = 'server';
$lang['EM_write_ftp'] = 'buffer & ftp';
$lang['EM_write_download'] = 'download';
$lang['EM_write_screen'] = 'on screen';
$lang['EM_move_copy'] = 'copy';
$lang['EM_move_ftp'] = 'automated FTP';
$lang['EM_move_exec'] = 'execute script';
$lang['EM_move_manual'] = 'manually load';
$lang['EM_settings_desc'] = 'This page allows you to configure EasyMOD settings. If you\'re using FTP methods, an attempt to check the connection will be made everytime you submit the form.';
$lang['EM_settings_update'] = 'Update Settings';
$lang['EM_settings_success'] = 'Your EasyMOD settings have been updated successfully.';
$lang['EM_pass_disabled'] = '(EM password disabled)';
$lang['EM_pass_updated'] = '(EM password updated)';
$lang['EM_pass_not_updated'] = '(EM password not updated)';
$lang['EM_supply_on_change'] = 'Only supply if you want to change it';
$lang['EM_emv_description'] = 'If you need to reinstall EM, then you might need to change the version.  You can do so here.';
$lang['EM_easymod_version'] = 'EasyMOD Version';

// EasyMOD install
$lang['EM_Intro'] = 'EasyMOD does in seconds what formally was a tedious process of manually editing files to install phpBB MODs.  EasyMOD will attempt to install any phpBB MOD.  However, approved EasyMOD Compliant MODs have the best chance to install successfully.';
$lang['EM_none_installed'] = 'No MODs have been installed.';
$lang['EM_All_Processed'] = 'All MODs have been processed.';
$lang['EM_unprocessed_mods'] = 'These MODs appear in your MODs directory and have not been processed for your current version of phpBB. Clicking "Process" initiates a multi-step installation.  Your current phpBB files will not be overwritten until the final step.  MODs that are EasyMOD Compliant (EMC) are more likely to install than other MODs.  More info on how to have EM install MODs is <a href="%s">here</a>.';
$lang['EM_Unprocessed'] = 'Unprocessed MODs';
$lang['EM_process'] = 'Process';
$lang['EM_support_thread'] = 'Support';
$lang['EM_EMC'] = 'EMC';
$lang['EM_undefined_write'] = 'Undefined write method.';
$lang['EM_check_permissions'] = 'The files must be accessible to PHP and the user running the web server process, so you need to ensure that the file access permissions on the server allow this access. If you have enabled safe mode, or open_basedir further restrictions may apply.';
$lang['EM_undefined_move_method'] = 'Undefined move method.';
$lang['EM_settings'] = 'EasyMOD Settings';

// Preview
$lang['EM_preview'] = 'Preview';
$lang['EM_preview_mode'] = 'Preview Mode';
$lang['EM_preview_desc'] = 'The following is a list of files that the MOD specifies to be modified.  Click "View" to view what changes will take place.  The changes that EasyMOD will make to the files are bolded in red.  Unfortunately, becasue of HTML formatting, some extra carriage returns are occasionally added, but they will not appear when the file is actually written.';
$lang['EM_preview_filename'] = 'Filename';
$lang['EM_preview_view'] = 'View';
$lang['EM_preview_nofile'] = 'This MOD will not modify any files.  Nothing to preview.';

// History + Install
$lang['EM_Mod'] = 'MOD';
$lang['EM_File'] = 'File';
$lang['EM_Version'] = 'Version';
$lang['EM_Author'] = 'Author';
$lang['EM_Description'] = 'Description';
$lang['EM_Themes'] = 'Themes';
$lang['EM_Languages'] = 'Languages';
$lang['EM_Filter'] = 'Filter';
$lang['EM_Filtered'] = 'Filtered';
$lang['EM_Unfiltered'] = 'Unfiltered';
$lang['EM_Filter_by_file'] = 'Filter MODs by processed file';
$lang['EM_All_mods'] = 'All MODs';
$lang['EM_Total_mods'] = 'Total MODs';
$lang['EM_none_found'] = 'No MODs have been found.';

// process
$lang['EM_proc_step1'] = 'Step 1 of 3';
$lang['EM_proc_complete'] = 'Processing completed successfully!';
$lang['EM_proc_desc'] = 'EasyMOD has completed processing of this MOD. Your original phpBB files remain unaltered. The next step will update your DB and replace your phpBB files with the newly altered ones.  Your original phpBB files will automatically be backed up. However, <b>this is beta quality software and you are urged to make your own backups!!</b>  Press the "Next Step" button to continue.';
$lang['EM_unprocessed_commands'] = 'Unprocessed Commands';
$lang['EM_unprocessed_desc'] = 'The following commands were not recognized by EasyMOD and were ignored.  The MOD script line number is displayed.';
$lang['EM_processed_commands'] = 'Commands Processed';
$lang['EM_processed_desc'] = 'EasyMOD successfully processed the following commands:';
$lang['EM_proc_failed'] = 'Installation Failed';
$lang['EM_proc_failed_desc'] = 'EasyMOD encountered the following error(s).  A general error could be ABC.  A critical error means D and you should do XYZ.';
$lang['EM_text_depend_move'] = 'THIS TEXT WILL DEPEND ON MOVE METHOD';

// process + post process
$lang['EM_Mod_Data'] = 'MOD Data';
$lang['EM_Mod_Title'] = 'MOD Title';
$lang['EM_Proc_Themes'] = 'Processed Themes';
$lang['EM_Proc_Languages'] = 'Processed Languages';
$lang['EM_Files'] = 'Files Edited';

// EasyMOD sql
$lang['EM_sql_step2'] = 'Step 2 of 3';
$lang['EM_Alterations'] = 'Proposed Database Alterations';
$lang['EM_Allow'] = 'Allow';
$lang['EM_Perform'] = 'Perform DB alterations';
$lang['EM_complete_install'] = 'Complete Installation';
$lang['EM_proposed_alterations'] = 'Proposed Database Alterations for your %s Database';
$lang['EM_sql_intro_explain'] = 'EasyMOD will now make changes to your database if you command it to.  Any SQL with a check next to it will be performed by EM.  If you are reinstalling a MOD, you probably <b>do not</b> want to run the SQL a second time, <b>so be careful!</b><br /><br /><b>Official Warning:</b> This is a DUMB process.  Commands you check off will be executed but EM does NOT check to see if these changes will negatively impact your database.  You are STRONGLY advised to <b>backup your database</b> before making any changes.  Prior to executing, you are advised to examine each command thoroughly or ask for feedback from experienced MOD installers.  Again, if you are reinstalling a MOD, multiple executions of the same SQL lines could adversely effect your database.';
$lang['EM_sql_error'] = 'SQL ERROR';
$lang['EM_not_attempted'] = 'Not Attempted';
$lang['EM_success'] = 'Success';
$lang['EM_skipped'] = 'Skipped';
$lang['EM_processing_results'] = 'SQL Processing Results';
$lang['EM_sql_attempted'] = 'The following SQL was attempted:';
$lang['EM_all_lines_successfull'] = 'ALL LINES EXECUTED SUCCESSFULLY';
$lang['EM_errors_detected'] = 'ERRORS DETECTED';
$lang['EM_failed'] = 'FAILED';
$lang['EM_line_results'] = 'The following is the result for each line of SQL executed.';
$lang['EM_sql_error_explain'] = 'An error was encountered while processing the SQL commands.  Further SQL processing has been halted.  You may choose to complete the MOD installation anyway and perform the SQL commands manually yourself.  However, at this point EM cannot guarantee the MOD will work correctly so you are best off seeking support from the Author before continuing further.';
$lang['EM_sql_halted'] = 'SQL PROCESSING HALTED';
$lang['EM_sql_process_error'] = 'SQL PROCESSING ERROR';
$lang['EM_failed_line'] = 'The failed line was';
$lang['EM_no_sql_preformed'] = '<b>No SQL alterations will be performed.</b> However, you may skip SQL processing, continue installing the MOD, and deal with the SQL manually';
$lang['EM_following_error'] = 'The following error occured';
$lang['EM_no_sql'] = 'No SQL to process.  Click \'Complete Installation\' to proceed.';
$lang['EM_notice'] = 'Notice';
$lang['EM_urgent_warning'] = 'URGENT WARNING';
$lang['EM_sql_drop_warning'] = 'SQL commands for dropping either a column or an entire table have been detected.  Although these commands may be legitamate, you should double check that you want this.  Dropping a table or column is irreversable. You are strongly urged to backup your database before proceeding even if the commands are legitamate!';
$lang['EM_sql_msaccess_warning'] = 'You have a MS Access database.  EM should perform most SQL properly for Access.  However, when creating tables or adding columns there is no way to assign default values.  You will have to do this manually in Access. Without default values, the MOD may not function as intended and the consequences could be severe.  If you know how to automate this, be sure to contact us!';
$lang['EM_experimental_explain'] = 'You have a %s database. Most likely EM isn\'t generating the SQL properly.  The reason is simply because we don\'t know what it is supposed to look like.  If you know what the SQL should look like, please let us know in <a href="%s" target="_sql">this topic</a>.  Otherwise just expect that maybe this won\'t work so well ;-)';
$lang['EM_sql_warnings_reported'] = '%d Warning(s) reported by the SQL Parser';
$lang['EM_database_alterations'] = 'Database Alterations';

// EasyMOD sql errors
$lang['EM_Unable_to_parse'] = '<b>FATAL ERROR</b>: Unable to parse SQL statement; ';
$lang['EM_malformed_type'] = 'malformed type length in field near';
$lang['EM_unmatched_NOT'] = 'unmatched NOT in field near';
$lang['EM_missing_DEFAULT'] = 'missing DEFAULT value in field near';
$lang['EM_not_enough'] = 'not enough parameters to parse column.';
$lang['EM_improper_key'] = 'improperly formated key';
$lang['EM_type_invalid'] = 'type %s invalid';
$lang['EM_length_invalid'] = 'length %s invalid';
$lang['EM_malformed_DROP'] = 'malformed DROP action';
$lang['EM_malformed_DROP2'] = 'malformed DROP statement, too many attributes.';
$lang['EM_postgresql_ABORTED'] = 'ABORTED: [%d]<br /> Dropping a field in postgresql was not implemented. Contact Nuttzy if you know how to safely do this without having to drop the whole table.';
$lang['EM_malformed_sql'] = 'malformed SQL, no target defined';
$lang['EM_type_unknown'] = 'type \'%s\' unknown.';
$lang['EM_subaction_unknown'] = 'subaction \'%s\' unknown.';
$lang['EM_unknown_action'] = 'action \'%s\' unknown.';
$lang['EM_SQL_line'] = 'SQL Line:';

// post process
$lang['EM_pp_step3'] = 'Step 3 of 3';
$lang['EM_pp_install_comp'] = 'Installation Complete!';
$lang['EM_pp_comp_desc'] = 'Installation of this MOD is now complete!  You should verify that the MOD is now functioning properly for all installed themes and languages.';
$lang['EM_pp_complete'] = 'completed';
$lang['EM_pp_ready'] = 'ready';
$lang['EM_pp_manual'] = 'MANUAL';
$lang['EM_pp_from'] = 'Copy From [%s]';
$lang['EM_pp_backups'] = 'Making Backups in [%s]';
$lang['EM_pp_backup'] = 'Backup';
$lang['EM_pp_download'] = 'Download';
$lang['EM_pp_to'] = 'To';
$lang['EM_pp_status'] = 'Status';

// diy
$lang['DIY_final'] = 'Final Step';
$lang['DIY_Instructions'] = '\'Do it yourself\' Instructions';
$lang['DIY_intro'] = '\'Do it yourself\' instructions need to be executed by <strong>you manually</strong>, EasyMOD can <strong>not</strong> perform these actions';
$lang['Final_install_step'] = 'View the final install steps';
$lang['Install_complete'] = 'Installation Complete';

// general use
$lang['EM_next_step'] = 'Next Step';
$lang['EM_ok'] = 'OK';
$lang['EM_on'] = 'ON';
$lang['EM_off'] = 'OFF';
$lang['EM_line'] = 'line';


//
// installer
//
$lang['Safe_mode'] = 'Safe Mode';
$lang['Go'] = 'Go';
$lang['EM_installing_beta'] = 'Installing EasyMOD beta (%s)';
$lang['EM_more_info'] = 'More information';
$lang['EM_see_file_access'] = 'Let\'s see what you have for file access.  You do not need everything to read \'ok\'.';
$lang['EN_reinstall_version'] = 'If you are trying to reinstall this version, change the EM version number from the Admin Control Panel under EasyMOD Settings.  Or you could also use the EM Version Changer (by GPHemsley) <a href="http://area51.phpbb.com/phpBB/viewtopic.php?p=92295#p92295">here</a>.';
$lang['EM_simple_mode'] = 'Simple Mode';
$lang['EM_advanced_mode'] = 'Advanced Mode';


// step 1

$lang['EM_step1'] = '<b>Step 1 (of 5):</b> Welcome to the EasyMOD installer.  In this step EasyMOD has scanned the server to see what file access is available for the key steps of reading, writing, and moving files.  EasyMOD has recommended what settings seem to best fit your configuration.';

$lang['EM_Install_Info'] = 'Install Info';
$lang['EM_Select_Language'] = 'Select Language';
$lang['EM_Database_type'] = 'Database type';
$lang['EM_phpBB_version'] = 'phpBB version';
$lang['EM_EM_status'] = 'EM status';
$lang['EM_new_install'] = 'New Install';
$lang['EM_update_from'] = 'Update EM from';

$lang['EM_PHP_sysinfo'] = 'Additional System Information';
$lang['EM_not_avail'] = 'N/A';
$lang['EM_PHP_system'] = 'System';
$lang['EM_PHP_config'] = 'Configure Command';
$lang['EM_PHP_version'] = 'PHP version';

$lang['EM_File_Access'] = 'File Access Info';
$lang['EM_unattempted'] = 'unattempted';
$lang['EM_no_module'] = 'module not loaded';
$lang['EM_support'] = 'For support, visit <a href="http://area51.phpbb.com/phpBB/viewforum.php?f=15" target="_blank">EasyMOD Central</a> over at Area51.';

$lang['EM_read_access'] = 'read access';
$lang['EM_write_access'] = 'write access';
$lang['EM_root_write'] = 'root path write';
$lang['EM_chmod_access'] = 'chmod access';
$lang['EM_unlink_access'] = 'unlink access';
$lang['EM_mkdir_access'] = 'mkdir access';
$lang['EM_tmp_write'] = 'tmp path write';
$lang['EM_ftp_ext'] = 'FTP extension';
$lang['EM_copy_access'] = 'copy access';

$lang['EM_password_title'] = 'EasyMOD Password Protection';
$lang['EM_password_desc'] = 'The EasyMOD password will allow you to restrict which admins can use EasyMOD.  By having access to EasyMOD an admin could covertly obtain your database user/pass and FTP info.';
$lang['EM_password_set'] = 'Set EM password';
$lang['EM_password_confirm'] = 'Confirm EM password';
$lang['EM_file_title'] = 'File Access';
$lang['EM_file_desc'] = 'FTP access is the perferred method for file access.  If you do not have FTP access, EasyMOD has recommended alternate settings.';
$lang['EM_file_reading'] = 'Reading';
$lang['EM_file_writing'] = 'Writing';
$lang['EM_file_moving'] = 'Moving';
$lang['EM_file_alt'] = 'alternate';
$lang['EM_ftp_title'] = 'FTP Information';
$lang['EM_ftp_dir'] = 'FTP path to IntegraMOD';
$lang['EM_ftp_user'] = 'FTP Username';
$lang['EM_ftp_pass'] = 'FTP Password';
$lang['EM_ftp_host'] = 'FTP Server';
$lang['EM_ftp_host_info'] = '(localhost should be fine)';
$lang['EM_ftp_port'] = 'FTP Port';
$lang['EM_ftp_port_info'] = '(21 should be fine)';

$lang['EM_ftp_advance_settings'] = 'Advanced FTP Settings (optional!)';
$lang['EM_ftp_debug'] = 'FTP Debug Mode';
$lang['EM_ftp_debug_not'] = '(only use if there is a problem)';
$lang['EM_ftp_use_ext'] = 'PHP FTP Extension';
$lang['EM_ftp_ext_not'] = '(only change if instructed to)';
$lang['EM_ftp_ext_noext'] = 'Not an option.  PHP FTP module not loaded.';
$lang['EM_ftp_cache'] = 'Use FTP cache';
$lang['EM_yes'] = 'Yes';
$lang['EM_no'] = 'No';

// simple step 1
$lang['EM_step1_simple_header'] = '<strong>Step 1 (gathering settings):</strong> Welcome to the EasyMOD installer.  EasyMOD will try to guide you every step of the way.  First, we need to know a little about your server.';
$lang['EM_step1_ftp_header'] = '<strong>Step 1 (gathering settings):</strong> You have specified that you have FTP access.  Enter your FTP information below.';
$lang['EM_step1_password_header'] = '<strong>Step 1 (gathering settings):</strong> EasyMOD takes security very seriously.  A password will further restict who has access.  If you are using FTP, then a password is required so that your FTP information can safely be crypted into the database.';
$lang['EM_server_style'] = 'Server Style';
$lang['EM_about_server'] = 'About your server';
$lang['EM_describes_server'] = 'Which of the following choices best describes your phpBB server:';
$lang['EM_have_ftp'] = 'I have FTP access to my phpBB files on the server.';
$lang['EM_have_windows'] = 'This is a Windows server and I don\'t have to worry about file permissions.';
$lang['EM_no_ftp_suggest'] = 'I don\'t have FTP access.  Have EasyMOD suggest what to do please!';
$lang['EM_auto_detect'] = 'Auto Detection';
$lang['EM_diagnosis'] = 'Diagnosis';
$lang['EM_auto_tech_detected'] = 'Automation Technique detected!';
$lang['EM_ftp_desc'] = 'Enter the information you would normally need to access your phpBB files via FTP.';

// no write no copy
$lang['Select_one'] = 'Select One:';
$lang['EM_nowrite_nocopy__desc'] = 'This is the worst case scenario.  EasyMOD does not have permission to either create new files or to replace the old files with the new ones.  There are several things you can do:<br />
<ol>
<li>If you have FTP access, then use the FTP option.</li>
<li>Your server has "safe mode" enabled which means EasyMOD cannot automaticly replace your phpBB files.  You might consider using <a href="http://www.wikipedia.org/wiki/chmod" target="_blank">chmod</a> or <a href="http://www.wikipedia.org/wiki/chown" target="_blank">chown</a> to allow access.</li>
<li>You might consider using <a href="http://www.wikipedia.org/wiki/chmod" target="_blank">chmod</a> to allow access.  However, this is not advised in a shared server environment.</li>
<li>Otherwise you will have to download the files and then manually move them into place.</li>
</ol>';
$lang['EM_try_ftp'] = 'I\'ll try using the FTP option. (requires FTP access)';
$lang['EM_perms_mod_rescan'] = 'I have now modified my file permissions, try rescanning to see if EasyMOD has access.';
$lang['EM_download_manual'] = 'I will have to download the files and manually move them into place';
$lang['EM_select_else'] = 'I\'d like to select something else. (Advanced Mode)';

// write no copy
$lang['EM_write_nocopy_desc'] = 'Problem.  EasyMOD has permission to create new files, but does not have permission to replace the old files with the new ones.  There are several things you can do:<br />
<ol>
<li>If you have FTP access, then use the FTP option.</li>
<li>Your server has "safe mode" enabled which means EasyMOD cannot automaticly replace your phpBB files.  You might consider using <a href="http://www.wikipedia.org/wiki/chmod" target="_blank">chmod</a> or <a href="http://www.wikipedia.org/wiki/chown" target="_blank">chown</a> to allow access.</li>
<li>You might consider using <a href="http://www.wikipedia.org/wiki/chmod" target="_blank">chmod</a> to allow access.  However, this is not advised in a shared server environment.</li>
<li>Otherwise you have to use the post process script or manually move files into place.</li>
</ol>';
$lang['EM_use_post_process'] = 'I will use the post_process script to automatically move files into place. (requires knowledge of how to execute a script)';

// write and copy
$lang['EM_write_copy_desc'] = 'Good news! EasyMOD has detected that it has the necessary access to automatically install MODs.  You should select yes below.';
$lang['EM_yes_use_auto'] = 'Yes, use this automated method.';
$lang['EM_no_use_else'] = 'No, I\'d like to select something else. (Advanced Mode)';


// step 2
$lang['EM_step2'] = '<b>Step 2 (of 5):</b> EasyMOD is now confirming your file access settings.';
$lang['EM_test_write'] = 'Testing selected write method';
$lang['EM_confirm_write'] = 'Write access method confirmed!';
$lang['EM_confirm_write_server'] = 'The modified files will be written on the server.';
$lang['EM_confirm_write_ftp'] = 'The modified files will be written to a buffer and then FTP\'d into place.';
$lang['EM_confirm_write_local'] = 'The modified files will be downloaded locally through your web browser.';
$lang['EM_confirm_write_screen'] = 'The modified file contents will be displayed on screen.';
$lang['EM_test_move'] = 'Testing selected move method';
$lang['EM_test_ftp1'] = '1) Logged in successfully';
$lang['EM_test_ftp2'] = '2) CD to EasyMOD path successfully';
$lang['EM_test_ftp3'] = '3) wrote to phpBB root successfully';
$lang['EM_test_ftp4'] = '4) FTP cache access checked successfully';
$lang['EM_ftp_sync1'] = 'You have selected FTP for writing files but not for moving them.  You must set both write and move to use FTP or else you cannot use FTP.';
$lang['EM_ftp_sync2'] = 'You have selected FTP for moving files but not for writing them.  You must set both write and move to use FTP or else you cannot use FTP.';
$lang['EM_confirm_move'] = 'Move access method confirmed!';
$lang['EM_confirm_move_ftp'] = 'The core phpBB files will automatically be replaced by modified files via FTP.';
$lang['EM_confirm_move_copy'] = 'The core phpBB files will automatically be replaced by modified files using the copy function.';
$lang['EM_confirm_move_exec'] = 'A script will be generated that you can execute to automatically replace the core phpBB files with the modified files.';
$lang['EM_confirm_move_ftpm'] = 'You have selected to manually replace the core phpBB files with the modified files.';
$lang['EM_install_EM'] = 'Install EasyMOD';
$lang['EM_confirm_download'] = '<b>IMPORTANT:</b> To fully test the download method, make sure you can download this file.  If it fails, you cannot use the "download" write method and should press "Rescan" to select another option.';

// step 2 ftp test
$lang['EM_ftp_testing'] = 'Testing FTP access...';
$lang['EM_ftp_fail_conn'] = 'FTP ERROR: connection to %s:%s failed.';
$lang['EM_ftp_fail_conn_lh'] = 'This error occurs frequently, particularly on hosts like Lycos.  Back on step 1 you should try changing the FTP Server from "localhost" to whatever hostname you typically use when you FTP.';
$lang['EM_ftp_fail_conn_21'] = 'This error occurs frequently when the port number is incorrect.  Back on step 1 you should try changing the FTP Port from 21 to whatever port you typically use when you FTP.';
$lang['EM_ftp_fail_conn_invalid'] = 'The connection failed because it appears you have provided an invalid FTP Server hostname.  Hostnames cannot have slashes (/ or \\) or colons (:) in the name.  Try reentering the FTP Server field.';
$lang['EM_ftp_fail_conn_invalid2'] = 'The connection failed because it appears you have provided an invalid FTP Server port.  Ports must only contain the numbers 0 through 9.  Try reentering the FTP Port field.';
$lang['EM_fail_conn_info'] = 'The FTP Server you have specified could not be connected to.  The following is recommended:';
$lang['EM_fail_conn_op1'] = 'Have you tried the default settings of <b>localhost</b> for the hostname and <b>21</b> for the port?  These should be tried first.';
$lang['EM_fail_conn_op2'] = 'Did you correctly enter the hostname?  Try reentering.';
$lang['EM_fail_conn_op3'] = 'Are you sure you have FTP access to the IntegraMOD files?  Obviously this is a requirement.';
$lang['EM_fail_conn_op4'] = 'Some servers have issues with the fsockopen method that EasyMOD attempts to use by default.  If you have the PHP FTP extension loaded, then enable that option in step 1.';
$lang['EM_fail_login'] = 'FTP ERROR: login failed';
$lang['EM_fail_login_info'] = 'The FTP Server was connected to, but the username and password were rejected.  The following is recommended:';
$lang['EM_fail_login_op1'] = 'Did you correctly type the username and password?  Make sure your CAPS LOCK key is off and try again.';
$lang['EM_fail_login_op2a'] = 'If you are 100% certain your user/pass is correct, then perhaps you are not connecting to the correct host or on the correct port.  Try changing your FTP Server entry from localhost to the actual ftp host name and your FTP Port entry from 21 to the actual ftp port.';
$lang['EM_fail_login_op2b'] = 'Perhaps you are not connecting to the correct host.  Try changing your FTP Server entry back to localhost or verify you have correctly entered the ftp host name.';
$lang['EM_fail_pwd'] = 'FTP ERROR: pwd failed';
$lang['EM_fail_cd'] = 'FTP ERROR: could not cd to %s';
$lang['EM_fail_cd_info'] = 'You successfully logged into the server, but could not change direcory (CD) to the easymod directory.  The following is recommended:';
$lang['EM_fail_cd_op1'] = '<b>Important:</b> It appears you are including a domain name in the FTP Path setting.  For most servers this is incorrect.  Try reentering the FTP Path setting without the domain name included.';
$lang['EM_fail_cd_op2'] = '<b>Important:</b> You have a slash (/) at the end of your FTP Path.  Try removing this and retrying.';
$lang['EM_fail_cd_op3'] = 'Are you sure you entered the correct path?  Below is a directory listing of the files in the FTP root directory.  The FTP root directory is simply the starting point when you connect.  The path to the IntegraMOD installation should begin with one of the directory names listed below.';
$lang['EM_fail_cd_op4'] = 'Directory names are case sensitive.  Be sure the easymod directory is all lowercase.';
$lang['EM_fail_cd_op5'] = 'In some *very rare* cases it\'s possible that you are not connecting to the proper FTP Server.  Try specifying the hostname in the FTP Server field and the port in the FTP Port field.';
$lang['EM_fail_cd_op6'] = 'Some servers have issues with the passive mode that EasyMOD attempts to use by default.  If you have the PHP FTP extension loaded, then enable that option in step 1.';
$lang['EM_fail_cd_pwd'] = 'FTP Error: Directory info could not be obtained.  This usually indicates solution 4 listed above.';
$lang['EM_fail_cd_nlist'] = 'FTP Error: A file listing could not be obtained.  This usually indicates solution 4 listed above.';
$lang['EM_fail_cd_nlist_no'] = 'No files to list.';
$lang['EM_fail_make_cache'] = 'Could not make the [%s] directory.';
$lang['EM_fail_tmp'] = 'Could not create the [%s] temporary file.';
$lang['EM_ftp_root'] = 'FTP root directory:';
$lang['EM_dir_current'] = 'Current Working Directory';
$lang['EM_dir_nlist'] = '<b>Directory listing:</b> (%d files being listed)';
$lang['EM_dir_list'] = '<b>Directory listing:</b> your FTP Path should start with one of the directories listed below';
$lang['EM_fail_put'] = 'FTP ERROR: could not write to phpBB root';
$lang['EM_fail_put_info'] = 'EasyMOD requires that your <b>%s</b> account have write access on all directories and files in the phpBB directory.  Please confirm all files and directories are set to at least 744 access.';
$lang['EM_ftp_phpbb_root'] = 'phpBB root directory:';
$lang['EM_fail_reput'] = 'FTP ERROR: could not overwrite phpBB root test file';
$lang['EM_fail_delete'] = '<b>FTP WARNING:</b> could not remove test file (not critical)';

// step 3
$lang['EM_step3'] = '<b>Step 3 (of 5):</b> EasyMOD is now installing itself as it would any MOD.  There is a two step process of first creating the modified files and then moving them into place.  The modified file(s) do no effect the core phpBB files in any way until the next step.  Click the "Complete Processing" button to move the files into place.';
$lang['EM_finding'] = 'Finding';
$lang['EM_insert'] = 'Insert';
$lang['EM_before'] = 'before';
$lang['EM_after'] = 'after';
$lang['EM_build_post'] = 'Building Post Process Actions';
$lang['EM_build_post_desc'] = 'The following actions will be executed in the final step';
$lang['EM_complete_processing'] = 'Complete Processing';

// step 4
$lang['EM_step4'] = '<b>Step 4 (of 5):</b> Depending on your selection, the modified files have been automatically moved into place or prepared for you to move them manually.  If there are no errors, click the "Confirm" button to update your database and complete the installation process.';
$lang['EM_add_db'] = 'Adding EasyMOD tables to your database';
$lang['EM_exec_sql'] = 'Executing SQL';
$lang['EM_progress'] = 'Progress';
$lang['EM_done'] = 'Done';
$lang['EM_result'] = 'Result';
$lang['EM_already_exist'] = 'The tables were previously created';
$lang['EM_failed_sql'] = 'Some queries failed, the statements and errors are listing below';
$lang['EM_no_worry'] = 'This is probably nothing to worry about, install will continue. Should this fail to complete you may need to seek help at our development board.';
$lang['EM_no_errors'] = 'No errors';
$lang['EM_update_db'] = 'Updating EasyMOD table data';
$lang['EM_store_entries'] = 'Storing config table entries';
$lang['EM_store_files'] = 'Storing processed files table';
$lang['EM_do_worry'] = 'Could not successfully update table. Something is wrong and install cannot complete.';
$lang['EM_move_htaccess'] = 'Moving protective .htaccess file into place';
$lang['EM_complete_post'] = 'Completing Post-Process';
$lang['EM_admin_panel'] = 'You can now proceed to the Admin Control Panel and select "Install MODs" under "MOD Center".  You may install the included MODs if you desire.  Return to <a href="%s">Forum Index</a>.';
$lang['EM_confirm'] = 'Confirm';
$lang['EM_move_files'] = '<b>IMPORTANT:</b> Before pressing confirm, move files into place.';

// step 5
$lang['EM_step5'] = '<b>Final Step:</b> EasyMOD is now confirming all files have been correctly moved into place.  If confirmed, then your database will be updated and installation will be complete!';
$lang['EM_confirmed'] = 'Confirmed!';
$lang['EM_confirm_admin'] = 'admin_easymod.php, looking for';
$lang['EM_confirm_exist'] = 'verifying existence';
$lang['EM_confirm_failed'] = 'Install Failed';
$lang['EM_confirm_fix'] = 'EM is not properly installed and you will need to fix the above error(s).';
$lang['EM_install_completed'] = 'Installation Confirmed.  EasyMOD is installed!';

// debug info
$lang['EM_debug_header'] = '<b>Debug Info:</b> The following information about your system config has been formatted for display in a forum post.';
$lang['EM_debug_display'] = 'Display Debug Info';
$lang['EM_debug_info'] = 'Expanded Debug Info';
$lang['EM_debug_format'] = 'formatted for forum posting';
$lang['EM_debug_installer'] = 'EM installer';
$lang['EM_debug_work_dir'] = 'Working Dir';
$lang['EM_debug_step'] = 'Install Step';
$lang['EM_debug_mode'] = 'Mode';
$lang['EM_debug_the_error'] = 'The Error';
$lang['EM_debug_no_error'] = 'No error.';
$lang['EM_debug_permissions'] = 'Permissions';
$lang['EM_debug_sys_errors'] = 'including system errors';
$lang['EM_debug_recommend'] = 'Recommendations';
$lang['EM_debug_write'] = 'write';
$lang['EM_debug_move'] = 'move';
$lang['EM_debug_ftp_dir'] = 'ftp dir';
$lang['EM_debug_ftp_host'] = 'ftp host';
$lang['EM_debug_ftp_post'] = 'ftp port';
$lang['EM_debug_ftp_debug'] = 'ftp debug';
$lang['EM_debug_ftp_ext'] = 'ftp ext';
$lang['EM_debug_ftp_cache'] = 'ftp cache';
$lang['EM_debug_ftp_notest'] = 'Not testing FTP since it is not being used.';
$lang['EM_debug_selected'] = 'Selected settings';
$lang['EM_debug_listing'] = 'CWD Listing';		// cwd = current working directory
$lang['EM_debug_ftp_test'] = 'FTP access test';
$lang['EM_debug_success'] = 'successful';

// forms
$lang['Submit'] = 'Submit';
$lang['Rescan'] = 'Rescan';


//
// errors
//
$lang['EM_err_warning'] = 'Warning';
$lang['EM_err_error'] = 'Error';
$lang['EM_err_critical_error'] = 'Critical Error';
$lang['EM_err_secondary'] = 'Secondary Error - Critical';
$lang['EM_err_cwd'] = 'Current working directory';
$lang['EM_err_install_dir'] = '<b>Critical Error:</b> EasyMOD is not in the correct directory to be installed.  It must be placed in a admin/mods/easymod off the phpBB root prior to installation.<br />';
$lang['EM_err_no_Default'] = '<b>Critical Error:</b> EasyMOD cannot be installed.  The Default template is not present in the templates directory.  This template is required as the baseline template for MOD installations.  The Default template is provided in the standard phpBB download at <a href="http://www.phpbb.com">www.phpbb.com</a>.';
$lang['EM_err_no_english'] = '<b>Critical Error:</b> EasyMOD cannot be installed.  The English language package is not present in the language directory.  This language is required as the baseline language package for MOD installations.  The English language package is provided in the standard phpBB download at <a href="http://www.phpbb.com">www.phpbb.com</a>.';
$lang['EM_err_dupe_install'] = 'This version of EM has already been installed.  Terminating to prevent reinstallation.';
$lang['EM_err_pw_match'] = '<b>Error:</b> The EasyMOD passwords do not match.  Please retry by pressing the "Rescan" button.';
$lang['EM_err_acc_write'] = '<b>ACCESS ERROR:</b> phpBB does not have permission to write to the EasyMOD directory.';
$lang['EM_err_acc_mkdir'] = '<b>ACCESS ERROR:</b> phpBB does not have permission to create new directories.';
$lang['EM_err_copy'] = '<b>COPY ERROR:</b> You do not have copy access.  Move method cannot be used.';
$lang['EM_err_no_write'] = '<b>MOVE ERROR:</b> The write method you have selected does not create the files on there server.  Therefore, using either automated FTP or the copy method is not permitted for the move method.';
$lang['EM_err_config_table'] = 'Could not obtain Config Table list';
$lang['EM_err_open_pp'] = '<b>Critical Error:</b> Cannot open post process file for writing.';
$lang['EM_err_attempt_remainder'] = 'ATTEMPING REMAINDER OF POST PROCESS';
$lang['EM_err_write_pp'] = '<b>Critical Error:</b> Unable to complete writing of post process file.';
$lang['EM_err_no_step'] = '<b>Critical Error:</b> Undefinied install step.';
$lang['EM_err_no_sql'] = '<b>Critical Error:</b> No DB LAYER found!';
$lang['EM_err_no_tpl'] = 'A required file [%s] is missing. Aborting install.';
$lang['EM_err_no_file'] = '<b>Critical Error:</b> could not find [%s]. Aborting.';
$lang['EM_err_insert'] = 'Could not insert %s config information.';
$lang['EM_err_update'] = 'Could not update %s config information.';
$lang['EM_err_find'] = 'Could not find';
$lang['EM_err_pw_fail'] = 'INVALID PASSWORD SUPPLIED';
$lang['EM_err_find_fail'] = 'FIND FAILED: In file [%s] could not find';
$lang['EM_err_ifind_fail'] = 'IN-LINE FIND FAILED: In file [%s] could not find';
$lang['EM_error_edit_config'] = '<b>Critical Error:</b> This MOD is trying to edit config.php. This is a security risk. MOD will not be installed.';

// admin_easymod errors
$lang['EM_trace'] = 'Function Trace';
$lang['EM_FAQ'] = 'FAQ';
$lang['EM_report'] = 'Report';
$lang['EM_error_detail'] = 'Error Detail';
$lang['EM_line_num'] = 'MOD script line #';
$lang['EM_err_config_info'] = 'Could not obtain Config information';
$lang['EM_err_no_process_file'] = 'Critical Error: There is no file specified to process.';
$lang['EM_err_set_pw'] = 'The EasyMOD passwords do not match.  Settings not updated.';
$lang['EM_err_em_info'] = 'Could not obtain EasyMod information';
$lang['EM_err_phpbb_ver'] = 'Could not obtain phpBB version info';
$lang['EM_err_backup_open'] = 'Could not open [%s] for reading.';
$lang['EM_err_no_find'] = 'FAILED: malformed script.  A FIND was not previously performed.';
$lang['EM_err_comm_open'] = 'OPEN FAILED: No file name supplied in MOD script';
$lang['EM_err_comm_find'] = 'FIND FAILED: No target supplied for FIND command in MOD script';
$lang['EM_err_inline_body'] = 'FAILED: Invalid command body supplied in MOD script';
$lang['EM_err_increment_body'] = 'FAILED: Invalid command body supplied in MOD script';
$lang['EM_err_no_ifind'] = 'FAILED: Malformed script.  An IN-LINE FIND was not previously performed.';
$lang['EM_err_comm_copy'] = 'COPY FAILED: The target file to be copied [%s%s] could not be found.';
$lang['EM_err_modify'] = 'CRITICAL ERROR: Could not modify [%s]';
$lang['EM_err_theme_info'] = 'Could not query database for theme info';
$lang['EM_err_copy_format'] = 'Could not perform improperly formed COPY command.';
$lang['EM_err_delete_em_info'] = 'Could not delete EasyMod entry!';

// mod_io errors
$lang['EM_modio_mkdir_chdir'] = 'FTP ERROR: could not change directory to [%s]<br />Current dir: [%s]';
$lang['EM_modio_mkdir_mkdir'] = 'FTP ERROR: could not make directory [%s]<br />Current dir: [%s]';
$lang['EM_modio_open_read'] = 'Could not open [%s] for reading.';
$lang['EM_modio_open_write'] = 'Could not open [%s] for writing.';
$lang['EM_modio_open_none'] = 'Write method not recognized.';
$lang['EM_modio_close_chdir'] = 'FTP ERROR: could not change directory to [%s]';
$lang['EM_modio_close_ftp'] = 'FTP ERROR: could not write file [%s]';
$lang['EM_modio_prep_conn'] = 'FTP ERROR: could not connect to localhost';
$lang['EM_modio_prep_login'] = 'FTP ERROR: login failed';
$lang['EM_modio_prep_chdir'] = 'FTP ERROR: could not chdir to phpBB root directory';
$lang['EM_modio_move_copy'] = 'COPY ERROR: could not move file [%s] to [%s]';
$lang['EM_modio_move_ftpa'] = 'FTP ERROR: could not move file [%s] to [%s]';

// EasyMOD Installer Help
$lang['EM_installer_help'] = 'EasyMOD Installer Help';
$lang['help']['file_writing'][] = 'File Writing';
$lang['help']['file_writing'][] = 'Here you can select one of the following options:
<ul>
<li><b>Server:</b> Files will be written using regular file manipulation functions. The user running the web server process needs write access to the files.</li>
<li><b>Buffer &amp; FTP:</b> Files will be prepared on a memory buffer and then written into place using an FTP connection to the server.</li>
<li><b>Download:</b> EasyMOD will offer you the possibility to download the modified files for you to manually upload to the server.</li>
<li><b>On Screen:</b> EasyMOD will display the modified files on the browser, then you would have to upload them manually.</li>
</ul>';
$lang['help']['file_moving'][] = 'File Moving';
$lang['help']['file_moving'][] = 'Here you can select one of the following options:
<ul>
<li><b>Copy:</b> Files will be copied using regular file manipulation functions. The user running the web server process needs access permissions to the files.</li>
<li><b>Automated FTP:</b> Files will be copied into place using an FTP connection to the server.</li>
<li><b>Execute Script:</b> EasyMOD will attempt to generate and execute a shell script to perform the required file operations.</li>
<li><b>Manually Load:</b> EasyMOD will allow you to download the files (or display them on screen) and then you have to manually upload the files to the server.</li>
</ul>';
$lang['help']['ftp_dir'][] = 'FTP Directory';
$lang['help']['ftp_dir'][] = 'Most of all it is important that you don\'t put the slash (/) at the end of the path.';
$lang['help']['ftp_dir'][] = 'Second thing to remember is that (in most cases) this path is not the same as you would put in your main configuration settings (in Administration Panel). Usually the path is different because FTP servers hide the real directory structure of the web server.';
$lang['help']['ftp_dir'][] = 'So the path needs to be the same as the one that you have to walk through when using your FTP client to get to your forum (there should be a file like extension.inc there). Common settings would be:
<ul>
<li>public_html/Integramod</li>
<li>public_html/forum</li>
<li>httpdocs/Integramod</li>
<li>httpdocs/forum</li>
<li>board_name/Integramod</li>
<li>board_name/forum</li>
<li>Integramod</li>
<li>forum</li>
<li>/ (this usually means that you don\'t actually have anything else on your FTP server than the forum)</li>
</ul>';
$lang['help']['ftp_host'][] = 'FTP Host';
$lang['help']['ftp_host'][] = 'This should usually remain localhost, but some servers (like Lycos) need a different name.';
$lang['help']['ftp_host'][] = 'If you don\'t know what to put in here then try the default (localhost) and then try to use the same setting as you use in you FTP client or ask your hosting provider or server administrator.';
$lang['help']['ftp_port'][] = 'FTP Port';
$lang['help']['ftp_port'][] = 'This should usually be the default value (that is 21), but some (rare) servers use a different port.';
$lang['help']['ftp_port'][] = 'If you don\'t know what to put in here then try the default (21) and then try to use the same setting as you use in you FTP client or ask your hosting provider or server administrator.';
$lang['help']['ftp_debug'][] = 'FTP Debug';
$lang['help']['ftp_debug'][] = 'This option tells EasyMOD to generate an extended report that may help to identify problems with FTP connections.';
$lang['help']['ftp_debug'][] = 'Support staff may request this information for diagnosis purposes.';
$lang['help']['ftp_php_ext'][] = 'PHP FTP Extension';
$lang['help']['ftp_php_ext'][] = 'This option instructs EasyMOD to use the <a href="http://www.php.net/ftp" target="_blank">PHP FTP Extension</a> to perform the file operations required to install MODs. However, this extension may not be enabled in your server configuration.';
$lang['help']['ftp_php_ext'][] = 'EasyMOD will try to use the <a href="http://www.php.net/network" target="_blank">PHP Network Functions</a>, if this option is not enabled. While there\'s no special requirement in PHP to use these functions, they may be restricted in your server configuration.';
$lang['help']['ftp_cache'][] = 'FTP Cache';
$lang['help']['ftp_cache'][] = 'When the <em>PHP FTP Extension</em> option is enabled, EasyMOD needs write access to a temporary location to store the files that need to be moved to their final locations using the FTP method.';
$lang['help']['ftp_cache'][] = 'EasyMOD will attempt to create a cache directory located in your admin/em_includes folder. Otherwise, when this option is disabled, it will try to use the system TEMP directory.';

?>