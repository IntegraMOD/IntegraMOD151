<?php
/***************************************************************************
 *                        lang_install.php [English]
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
// Install Process
//
$lang['Welcome_install'] = 'Welcome to IntegraMOD141 Installation';
$lang['Initial_config'] = 'Basic Configuration';
$lang['DB_config'] = 'Database Configuration';
$lang['Admin_config'] = 'Admin Configuration';
$lang['continue_upgrade'] = 'Once you have downloaded your config file to your local machine you may\'Continue Upgrade\' button below to move forward with the upgrade process.  Please wait to upload the config file until the upgrade process is complete.';
$lang['upgrade_submit'] = 'Continue Upgrade';

$lang['Installer_Error'] = 'An error has occurred during installation';
$lang['Previous_Install'] = 'A previous installation has been detected';
$lang['Install_db_error'] = 'An error occurred trying to update the database';

$lang['Re_install'] = 'Your previous installation is still active.<br /><br />If you would like to re-install phpBB 2 you should click the Yes button below. Please be aware that doing so will destroy all existing data and no backups will be made! The administrator username and password you have used to login in to the board will be re-created after the re-installation and no other settings will be retained.<br /><br />Think carefully before pressing Yes!';

$lang['Inst_Step_0'] = 'Thank you for choosing <b>IntegraMOD</b>. <br />In order to complete this install please fill out the details requested below. Please note that the database you install into should already exist. If you are installing to a database that uses ODBC, e.g. MS Access you should first create a DSN for it before proceeding.';

$lang['Start_Install'] = 'Start Install';
$lang['Finish_Install'] = 'Finish Installation';

$lang['Default_lang'] = 'Default board language';
$lang['DB_Host'] = 'Database Server Hostname / DSN';
$lang['DB_Name'] = 'Your Database Name';
$lang['DB_Username'] = 'Database Username';
$lang['DB_Password'] = 'Database Password';
$lang['Database'] = 'Your Database';
$lang['Install_lang'] = 'Choose Language for Installation';
$lang['dbms'] = 'Database Type';
$lang['Table_Prefix'] = 'Prefix for tables in database';
$lang['Admin_Username'] = 'Administrator Username';
$lang['Admin_Password'] = 'Administrator Password';
$lang['Admin_Password_confirm'] = 'Administrator Password [ Confirm ]';

$lang['Inst_Step_2'] = 'Your admin username has been created.  At this point your basic installation is complete. You will now be taken to a screen which will allow you to administer your new installation. Please be sure to check the General Configuration details and make any required changes. Thank you for choosing phpBB 2.';

$lang['Unwriteable_config'] = 'Your config file is un-writeable at present. A copy of the config file will be downloaded to your computer when you click the button below. You should upload this file to the same directory as phpBB 2. Once this is done you should log in using the administrator name and password you provided on the previous form and visit the admin control center (a link will appear at the bottom of each screen once logged in) to check the general configuration. Thank you for choosing phpBB 2.';
$lang['Download_config'] = 'Download Config';

$lang['ftp_choose'] = 'Choose Download Method';
$lang['ftp_option'] = '<br />Since FTP extensions are enabled in this version of PHP you may also be given the option of first trying to automatically FTP the config file into place.';
$lang['ftp_instructs'] = 'You have chosen to FTP the file to the account containing phpBB 2 automatically.  Please enter the information below to facilitate this process. Note that the FTP path should be the exact path via FTP to your phpBB2 installation as if you were FTPing to it using any normal client.';
$lang['ftp_info'] = 'Enter Your FTP Information';
$lang['Attempt_ftp'] = 'Attempt to FTP config file into place';
$lang['Send_file'] = 'Just send the file to me and I\'ll FTP it manually';
$lang['ftp_path'] = 'FTP path to phpBB 2';
$lang['ftp_username'] = 'Your FTP Username';
$lang['ftp_password'] = 'Your FTP Password';
$lang['Transfer_config'] = 'Start Transfer';
$lang['NoFTP_config'] = 'The attempt to FTP the config file into place failed.  Please download the config file and FTP it into place manually.';

$lang['Install'] = 'Install';
$lang['Upgrade'] = 'Upgrade';


$lang['Install_Method'] = 'Choose your installation method';

$lang['Install_No_Ext'] = 'The PHP configuration on your server doesn\'t support the database type that you chose';

$lang['Install_No_PCRE'] = 'phpBB2 Requires the Perl-Compatible Regular Expressions Module for PHP which your PHP configuration doesn\'t appear to support!';

$lang['Install_No_File_Open'] = 'The file %s cannot be opened due to insufficient security settings. Please check the chmod instructions in the install guide.';

$lang['Go_to_prillian'] = 'I deleted the install directory... Let\'s install prillian now...';
$lang['Go_to_profile'] = 'I deleted the install and prill_install directories... Let\'s complete the remaining registration details for my account...';

$lang['Extra_procedures'] = '<tr><th>Integramod Extra Procedures</center></th></tr><tr><td><p>
	The information to finish some of the extra procedures needed to install Integramod are below. <ul>
		<li>Please delete the install folder now, to prevent a message die error after you click finish installation</li>
		%s
	</ul>
	If you have any questions please ask at <a href="http://www.integramod.com">integramod.com.</a></p></td></tr>';
$lang['Extra_procedures_no_prillian'] = '<li>Please also delete the prill_install folder as you don\'t want to install it.</li>'; // comes inside 'Extra_procedures'
$lang['Admin_config_settings'] = 'phpBB Security Settings</th>';
$lang['Admin_config_name'] = 'Choose an admin config name. This can be anything. Try to keep it 1 or 2 words
				max IE. <b>admins_allowed</b>. I would not suggest using that, but you get the idea.';
$lang['Mod_config_name'] = 'Choose a mod config name. This can be anything. Try to keep it 1 or 2 words
				max IE. <b>mods_allowed</b>. I would not suggest using that, but you get the idea.';
$lang['Unwanted_config_name'] = 'Choose a disable config name. This can be anything. Try to keep it 1 or 2 words
				max IE. <b>block_unwanted</b>. I would not suggest using that, but you get the idea.';
$lang['No_prillian_wanted'] = 'Check this box if you <strong>don\'t</strong> want to install the prillian.';
$lang['Install_options'] = 'Install Options';
?>