<?php
/***************************************************************************
 *                        lang_prillinstall.php [English]
 *                            -------------------
 *   begin                : Saturday, July 10, 2004
 *   copyright            : (C) 2004 masterdavid - Ronald John David
 *   website              : http://www.integramod.com
 *   email                : webmaster@integramod.com
 *
 *   note: removing the original copyright is illegal even you have modified
 *         the code.  Just append yours if you have modified it.
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

//
// Prillian Install Process
//
$lang['Installation'] = 'Installation';
$lang['Thanx'] = 'Thank you for choosing %s, the original instant messenger for phpBB! If you have any problems, check the readme.txt file for locations where you can ask for support.';
$lang['No_redirect'] = 'If your browser does not support meta redirection please click %sHERE%s to be redirected.';
$lang['Attempt_schema_read'] = 'Attempting to read Schema SQL file:';
$lang['Attempt_create_tables'] = 'Attempting to create new DB tables:';
$lang['Table'] = 'Table';
$lang['Created'] = 'created';
$lang['Query'] = 'Query';
$lang['Completed'] = 'completed';
$lang['Attempt_alter_read'] = 'Attempting to read Table Alter SQL file:';
$lang['Attempt_alter_tables'] = 'Attempting to alter DB tables:';
$lang['Table_alterations'] = 'Table Alterations';
$lang['Undetermine'] = 'Could not determine what to do!';
$lang['Successful'] = 'Successful!';
$lang['Failed'] = 'Failed!';
$lang['Error_follows'] = 'Error message follows:';
$lang['Successfully'] = 'successfully';
$lang['Attempt_delete_tables'] = 'Attempting to delete DB tables:';
$lang['Deletion'] = 'deletion';
$lang['Attempt_delete_alternations_tables'] = 'Attempting to delete alterations to DB tables:';
$lang['Alteration'] = 'alteration';
$lang['Step_1'] = 'This is step 1 out of 5!';
$lang['Step_1_intro'] = 'We will now try to install new database tables.';
$lang['Step_1_error'] = '<br />Oh no, there was an error! If any of these tables were not created and did not already exist, then you may have to perform the queries in the *_im_schema.sql file for your database type manually. Here are some things to look out for in an error on this step:<ul><li><span class="bold">Error: Attempting to read Schema SQL file: Failed!</span><br />Make sure the *.sql files are in the same directory as im_install.php!</li><li><span class="bold">Error: Table "%s" already exists</span><br />If you have already installed Thoul\'s Contact List hack, do not worry about this. Both Contact List and Prillian attempt to create this table on installation. As long as one of them does so, you\'re fine.</li><li><span class="bold">Error: Table "%s" already exists</span><br />If one of the other tables already exists, it may be leftover from a previous Prillian installation or a Prillian Lite installation. For a Prillian Lite installation, you should stop now and uninstall Prillian Lite. For a Prillian installation, you may need to make some changes to the existing table manually later.</li></ul>';
$lang['Step_no_errors'] = 'No errors detected in this step.';
$lang['Step_2'] = 'This is step 2 out of 5!';
$lang['Step_2_intro'] = 'We will now try to copy all your existing users into the %s database table.';
$lang['Step_2_error_get_list'] = 'Failed to get list of user_ids for inserting';
$lang['Step_2_user_success'] = '%s users out of %s successfully copied to the table.';
$lang['Step_2_user_failed'] = 'No users out of %s were copied to the table.';
$lang['Step_2_error'] = '<br /><br /><span class="err_msg">These users were not copied: %s.</span><br /><br />Those users may already exist in the table or the copy may have simply failed. In the latter case, you may need to add the users manually. To do this, you will need to run the SQL queries below through phpMyAdmin or a similar utility. If you do not have such a utility, try going to the Utilities section of phpBBHacks.com and check out the db_generator page there.<br /><br /><span class="query_msg">';
$lang['Step_3'] = 'This is step 3 out of 5!';
$lang['Step_3_intro'] = 'We will now try to add new data, including many new configuration options.';
$lang['Step_3_error'] = '<br />Oh no, there was an error! If any of these queries were not successfully completed and did not already exist, then there may be a problem running Prillian later! Here are some things to look out for in an error on this step:<ul><li><span class="bold">Error: Attempting to read Data SQL file: Failed!</span><br />Make sure the *.sql files are in the same directory as im_install.php!</li><li><span class="bold">Duplicate entry errors</span><br />This error message means the data in that particular query has been added to your tables previously. Generally, this is not an error to worry about and you can ignore it.</li></ul>';
$lang['Step_4'] = 'This is step 4 out of 5!';
$lang['Step_4_intro'] = 'We will now try to alter your existing database tables to hold new data.';
$lang['Step_4_error'] = '<br />Oh no, there was an error! If any of these queries were not successfully completed and did not already exist, then there may be a problem running Prillian later! Here are some things to look out for in an error on this step:<ul><li><span class="bold">Error: Attempting to read Table Alter SQL file: Failed!</span><br />Make sure the *.sql files are in the same directory as im_install.php!</li><li><span class="bold">Duplicate column name or key name errors</span><br />This error message means the table alterations in that particular query have been added to your tables previously. Generally, this is not an error to worry about and you can ignore it.</li></ul>';
$lang['Step_5'] = 'This is step 5 out of 5!';
$lang['Step_5_intro'] = 'Congratulations, you have finished the Prillian installation!<br /><br />If you encountered no error messages, then your next step should be to upload any Prillian files or modified phpBB files that you have not already uploaded.<br /><br />If you did encounter an error, then you may need to do some manual modifications to your database through another utility.<br /><br />In any case, once you have all the files uploaded and any manual database changes completed, you should go to the Administration Panel and use the new Prillian Configuration page to finalize the settings for your Prillian installation.<br /><br /><span class="err_msg">Please delete the prill_install directory before proceding.</span><br /><br />';
$lang['Step_5_proceed'] = 'I deleted the prill_install directory... Let\'s complete the remaining registration details for my account';
$lang['Step_0'] = 'This is step 0 out of 5!';
$lang['Step_0_intro'] = 'Okay, you chose to install Prillian! The installation will be done in several steps so that you can see what this script will attempt to install and any errors that may occur. When a step of the installation is completed, you can proceed to the next step by clicking the Proceed to Next Step link. As you proceed, some tips and advice on common errors that you may encounter will be displayed.<br /><br />Before going any further, you might wish to change some of the default values defined for phpbb_im_prefs in the *_im_schema.sql file you will be using to install database tables. Those default values will be applied to all users during this installation and (for future users) registration. If you want to allow only a few users access to Prillian, changing some of these is a good idea.<br /><br />Proceed to the Next Step to begin installing Prillian!';
$lang['Proceed'] = 'Proceed to Next Step';
$lang['Delete_step'] = 'Okay, if you\'re sure you want to delete Prillian, let\'s do it.';
$lang['Choose_Install'] = 'Before proceeding, please ensure that you have uploaded the %s new phpBB files and your edited %s file. If these files are not uploaded, you may not be able to use this installer correctly.<br /><br />Please choose an installation method:<ul><li>%s New %s Installation %s</li><li>%s Upgrade From A Previous Installation %s - <span class="bold">Sorry, this option is not available in %s </span></li><li>%s Uninstall %s Database Changes %s</li></ul>';
$lang['Confirm_Delete'] ='You have chosen to uninstall the %s database changes. This will make %s unusable, so you should remove the changes to original phpBB files (except for %s) first to prevent your forum from breaking. You should also backup your database tables in case of errors. If you have done that and are certain you wish to remove the database changes, click the link below.<ul><li>%s Uninstall database changes %s</li></ul></div>';
$lang['Already_installed'] ='You have already installed %s or a later version.';
?>