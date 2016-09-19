<?php
/**
* <b>lang_cback_ctracker.php</b><br><br>
* English Language File for the CBACK Cracker Tracker
*
* @author Christian Knerr (cback)
* @translator Marc Renninger (mc-dragon)
* @package ctracker
* @version 5.0.0
* @since 21.07.2006 - 17:26:28
* @copyright (c) 2006 www.cback.de
*
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*/


/*
 * Language Strings used for the ACP Menu points
 */
$lang['ctracker_module_category'] 		  = 'CrackerTracker';
$lang['ctracker_module_1']                = 'Checksum Scanner';
$lang['ctracker_module_2']                = 'Credits';
$lang['ctracker_module_3']                = 'Filescanner';
$lang['ctracker_module_4']                = 'Global News';
$lang['ctracker_module_5']                = 'IP&Agent Blocker';
$lang['ctracker_module_6']                = 'Logmanager';
$lang['ctracker_module_7']                = 'Maintenance & Tests';
$lang['ctracker_module_8']                = 'Miserable User';
$lang['ctracker_module_9']                = 'Settings';
$lang['ctracker_module_10']               = 'Recovery';
$lang['ctracker_module_11']               = 'Footer';


/*
 * Language Strings used in ACP Modules itself
 */
$lang['ctracker_wrong_module']			  = 'Unknown module number';
$lang['ctracker_img_descriptions']		  = 'Picture';
$lang['ctracker_set_catname1']			  = 'IP, Proxy & UserAgent Blocker';
$lang['ctracker_set_catname2']			  = 'Search Protection System';
$lang['ctracker_set_catname3']			  = 'Login Protection System';
$lang['ctracker_set_catname4']			  = 'Auto Spam Detection';
$lang['ctracker_set_catname5']			  = 'Registration Protection System';
$lang['ctracker_set_catname6']			  = 'Check Password	';
$lang['ctracker_set_catname7']			  = 'General Safety Features';
$lang['ctracker_set_catname8']			  = 'Other Settings';
$lang['ctracker_settings_head']           = 'CrackerTracker Settings';
$lang['ctracker_settings_expl']           = 'Here you can customise all Settings of CBACK CrackerTracker Safety System.';
$lang['ctracker_button_submit']			  = 'Save Settings';
$lang['ctracker_button_reset']			  = 'Restore';

$lang['ctracker_settings_m1']			  = 'Activate IP Blocker';
$lang['ctracker_settings_e1']			  = 'Turns the IP, Proxy and UserAgent Blocker on or off.';
$lang['ctracker_settings_m2']			  = 'IP Blocker Log size';
$lang['ctracker_settings_e2']			  = 'Here you can set the number of entries for the log file of the IP blocker. If the number of entries exceeds the limit, the log file will be automatically deleted in order to save Web space.';
$lang['ctracker_settings_m3']			  = 'Activate Search Protection';
$lang['ctracker_settings_e3']			  = 'Here you can turn on- or off the Search Protection System.';
$lang['ctracker_settings_m4']			  = 'Search Time for users';
$lang['ctracker_settings_e4']			  = 'There is a waiting time (in seconds) for registered users until they can search again, if search protection is activated. ';
$lang['ctracker_settings_m5']			  = 'Number of Searches for users';
$lang['ctracker_settings_e5']			  = 'Here you can adjust the number of queries that may be accomplished in the time interval indicated above by registered users. If this number is exceeded, further queries will be blocked for the time shown above to reduce the server load.';
$lang['ctracker_settings_m6']			  = 'Search Time for guests';
$lang['ctracker_settings_e6']			  = 'Time period (in seconds) guests have to wait, if Search Protection System is activated.';
$lang['ctracker_settings_m7']			  = 'Number if Searches for guests';
$lang['ctracker_settings_e7']			  = 'Here you can set, how many Searches in specified time period guests are allowed to do. If the number exceeds the limit, further queries will be blocked for the time shown above to reduce the server load.';
$lang['ctracker_settings_m8']			  = 'Turn on Login Protection';
$lang['ctracker_settings_e8']			  = 'Here you can activate or deactivate the Login Protection System of CrackerTracker.';
$lang['ctracker_settings_m9']			  = 'Log size for wrong Logins';
$lang['ctracker_settings_e9']			  = 'Here you can set how many entries for failed Logins will be saved until it will be automatically deleted in order to save Web space.';
$lang['ctracker_settings_m10']			  = 'Number of Logins up to the Visual Confirmation';
$lang['ctracker_settings_e10']			  = 'How often a user may fail to log on until the protection of BruteForce Attacks the Visual Confirmation will be shown.';
$lang['ctracker_settings_m11']			  = 'Login History';
$lang['ctracker_settings_e11']			  = 'Here you can activate or deactivate the Login History for users.';
$lang['ctracker_settings_m12']			  = 'Entries in the Login History per user';
$lang['ctracker_settings_e12']			  = 'Here you can set how many successful Logins in the Login History from each user will be saved. Each user has the option to check the times and IP addresses of his/her Login.';
$lang['ctracker_settings_m13']			  = 'Login IP Feature';
$lang['ctracker_settings_e13']			  = 'Activates or deactivates the Login IP System. Each user has the option to activate or deactivate the System on the Login Security page. The IP Protection System checks changes of the IP addresses. The user will be informed if the IP Range has been modified since his/her last Login. Here you\'ll see if someome has logged on from a different location.';
$lang['ctracker_settings_m14']			  = 'Spammer Detection';
$lang['ctracker_settings_e14']			  = 'Here the mode for the Automatic Spammer Detection can be set.';
$lang['ctracker_settings_m15']			  = 'Spammer Time Period';
$lang['ctracker_settings_e15']			  = 'Time period in which posts of users will be count to Spammerdetection. (in Seconds)';
$lang['ctracker_settings_m16']			  = 'Spammer Postnumber';
$lang['ctracker_settings_e16']			  = 'Allowed number of posts in the set period of time. If this number is exceeded the user will be identified as Spammer.';
$lang['ctracker_settings_m17']			  = 'Spammer Logsize';
$lang['ctracker_settings_e17']			  = 'Logsize in which as Spammer identified users will be saved.';
$lang['ctracker_settings_m18']			  = 'Register Protection';
$lang['ctracker_settings_e18']			  = 'Here you can activate or deactivate the Register Protection.';
$lang['ctracker_settings_m19']			  = 'Block Time for Registration';
$lang['ctracker_settings_e19']			  = 'Here you can set the time between two registrations. (in seconds)';

$lang['ctracker_settings_m21']			  = 'IP Watcher';
$lang['ctracker_settings_e21']			  = 'If this feature has been activated a user with an identical IP Address can just register once until someone has registered with another IP Address.';
$lang['ctracker_settings_m22']			  = 'Password Validity';
$lang['ctracker_settings_e22']			  = 'Activates Checking of Validity of Password for all users.';
$lang['ctracker_settings_m23']			  = 'Validity of Password in days';
$lang['ctracker_settings_e23']			  = 'How long User password will be valid before there will be shown a note that the password should be changed. (in days)';
$lang['ctracker_settings_m24']			  = 'Password Complexity Check';
$lang['ctracker_settings_e24']			  = 'This feature checks the complexity of the User passwords.';
$lang['ctracker_settings_m25']			  = 'Password Complexity Mode';
$lang['ctracker_settings_e25']			  = 'Here it can be set, if there have to be ZEICHEN in passwords.';
$lang['ctracker_settings_m26']			  = 'Password Minimum Length';
$lang['ctracker_settings_e26']			  = 'Here you can set the minimum number of letters of a password.';
$lang['ctracker_settings_m27']			  = 'Password Reset Checker';
$lang['ctracker_settings_e27']			  = 'Allows to reset a password once in a certain period of time (for users). This prevents, that attackers cannot use this feature to spam users using Resetmails.';
$lang['ctracker_settings_m28']			  = 'Password Reset Period of Time';
$lang['ctracker_settings_e28']			  = 'Period of time users may reset their password (in minutes)';
$lang['ctracker_settings_m29']			  = 'E-mail Monitoring';
$lang['ctracker_settings_e29']			  = 'Here you can activate the feature, that users can use the internal Board Mailfunction only once in the given period of time. This prevents spamming.';
$lang['ctracker_settings_m30']			  = 'E-mail Span Of Time';
$lang['ctracker_settings_e30']			  = 'Time period between two E-Mails users can send using the internal Mail feature (in minutes)';
$lang['ctracker_settings_m31']			  = 'Auto Recovery';
$lang['ctracker_settings_e31']			  = 'Activates the feature to save the Settings of the Board automatically. If this does not work you can use last known running configuration.';
$lang['ctracker_settings_m32']			  = 'Visual Confirmation for Guests';
$lang['ctracker_settings_e32']			  = 'When you activate this feature Guests have to enter a visual code by typing a new posts. Otherwise they will not be able to send the post. This protects from automatic Spambots.';
$lang['ctracker_settings_m33']			  = 'Disposable-Mailservice Protection';
$lang['ctracker_settings_e33']			  = 'CrackerTracker has an internal list of so-called Disposable-Mailservices. If you activate this feature users with such Email Addresses will not be able to register.';
$lang['ctracker_settings_m34']			  = 'Identification of incorrect configuration';
$lang['ctracker_settings_e34']			  = 'When you activate this feature CrackerTracker checks the general Boardsettings of phpBB on validity. So you can\'t damage your Board by misconfiguration!';
$lang['ctracker_settings_m35']			  = 'Spammer Detection Boost';
$lang['ctracker_settings_e35']			  = 'When you activate this feature CrackerTracker will watch human Spammers or Spamposts. Most of them will be blocked.';
$lang['ctracker_settings_m36']			  = 'Spammer Keyword Check';
$lang['ctracker_settings_e36']			  = 'When you activate "Spammer Detection Boost", keywords in Profile and Posts will be scanned to identify Spammers.<br /><br /><b>ATTENTION</b> here it exists higher risk of Bugdetection for new users. Please check the Log file for Spammer detection.';


$lang['ctracker_settings_on']			  = 'Activate';
$lang['ctracker_settings_off']			  = 'Deactivate';
$lang['ctracker_blockmode_0']			  = 'Off';
$lang['ctracker_blockmode_1']			  = 'Ban User';
$lang['ctracker_blockmode_2']			  = 'Lock User';
$lang['ctracker_complex_1']				  = '[0-9]';
$lang['ctracker_complex_2']				  = '[a-z]';
$lang['ctracker_complex_3']				  = '[A-Z]';
$lang['ctracker_complex_4']				  = '[0-9][a-z]';
$lang['ctracker_complex_5']				  = '[0-9][A-Z]';
$lang['ctracker_complex_6']				  = '[0-9][a-z][A-Z]';
$lang['ctracker_complex_7']				  = '[0-9][*]';
$lang['ctracker_complex_8']				  = '[0-9][a-z][*]';
$lang['ctracker_complex_9']				  = '[0-9][a-z][A-Z][*]';


/*
 * Credits page in ACP
 */
$lang['ctracker_credits_head']			  = 'Credits';
$lang['ctracker_credits_subhead']         = 'Here are the Credits of CBACK CrackerTracker. Here we\'ll give you more information about safety and this is also a way to say "Thank You".';
$lang['ctracker_credits_donate']          = 'Donate';
$lang['ctracker_credits_donate_expl']     = 'Do you like <b>CBACK CrackerTracker Professional</b>? Then it would be nice, if you donated the CBACK Project using PayPal Donation. Further Development and the costs of the server will help do go on with our non-profit project. So we will be able to provide CrackerTracker for free in the future. <br /><br />Thank you very much for your support.';
$lang['ctracker_credits_credits']		  = 'Credits';
$lang['ctracker_credits_credits_1']		  = 'Idea & Implementation';
$lang['ctracker_credits_credits_2']		  = 'Author and Support';
$lang['ctracker_credits_credits_3']		  = 'Icons';
$lang['ctracker_credits_credits_4']		  = 'Official Downloadsite';
$lang['ctracker_credits_moddownload']	  = 'CrackerTracker MOD Download';
$lang['ctracker_credits_thanks']		  = 'Thanks to...';
$lang['ctracker_credits_thanks_text']	  = 'I would like to say thank you to the following persons:';
$lang['ctracker_credits_thanks_to']		  = '<b>Ideas, Safety tests and Proofreading</b><br />Tekin Birdüzen<br /><i>(<a href="http://www.cybercosmonaut.de" target="_blank">cYbercOsmOnauT</a>)</i><br /><br /><br /><br /><b>Ideas:</b><br />Bernhard Jaud<br /><i>(GenuineParts)</i><br /><br /><br /><br /><b>Translator (English)</b><br />Marc Renninger<br /><i>(mc-dragon)</i><br /><br /><br /><br /><b>Corrector (English)</b><br />George <br />Sommerset<br /><i>(<a href="http://www.englisch-hilfen.de" target="_blank">www.englisch-hilfen.de</a>)</i><br /><br /><br /><br /><b>Beta Tester</b><br />Thanks to all participants of Beta-Tests<br />to the CBACK Premium users and of course to<br />our colleagues of the "Mod-Scene" who helped with Beta Tests and Proofreading, too.</i>';
$lang['ctracker_credits_info']			  = 'More Safety?';
$lang['ctracker_credits_info_text']		  = 'The perfect add-on for phpBB and the CrackerTracker: For an optimal safety we recommend the Mod <b>Advanced Visual Confirmation</b> by AmigaLink. This MOD expands the CAPTCHA feature of phpBB and  CrackerTracker Professional with a more complex system which cannot be read out by Bots. This MOD you can download on <a href="http://www.amigalink.de" target="_blank">www.AmigaLink.de</a>.<br /><br /><br /><br />We suggest that you also integrate this MOD in your Board for an excellent safety.';


/*
 * File Hash Check in ACP
 */
$lang['ctracker_fchk_head']				  = 'CrackerTracker Checksum Scanner';
$lang['ctracker_fchk_subhead']			  = 'This scanner creates a checksum of each PHP file from your Board when you click on "Create or upgrade Checksums". Afterwards, you have always the possibility with “Examine File Modifications” to determine whether or not the files were changed since last producing check totals. You can see if files were changed without you doing anything. This is usually a sign that someone had gained access to your forum volume of data. Pay attention to the last time that you checked to see if an unauthorized person activated the check total scanner!<br /><br /><br /><b>Information:</b> Not all servers support this feature. Occasionally it can come to Script Timeouts, if the server takes too long to produce the phpBB file list. Other servers stop the procedure since it is quite performance intensive.<br /><br /><br />&raquo; The last actualization of the file check totals took place <b>%s</b>.';
$lang['ctracker_fchk_funcheader']		  = 'Features';
$lang['ctracker_fchk_tableheader']		  = 'System Output';
$lang['ctracker_fchk_option1']			  = 'Create or upgrade Checksums';
$lang['ctracker_fchk_option2']			  = 'Verify Filechanges';
$lang['ctracker_fchk_select_action']	  = 'Please choose an action!';
$lang['ctracker_fchk_update_action']	  = 'Checksums were updated!';
$lang['ctracker_fchk_tablehead1']		  = 'Filepath';
$lang['ctracker_fchk_tablehead2']		  = 'State';
$lang['ctracker_file_unchanged']		  = 'UNMODIFIED';
$lang['ctracker_file_changed']		 	  = 'MODIFIED';
$lang['ctracker_file_deleted']        = 'DELETED';


/*
 * File Safety Scanner in ACP
 */
$lang['ctracker_fscan_complete']		  = 'The Filescan was executed successfully. Please click on "Show Results", to see the results. You can correct the files.<br /><br /><br /><br /><u>TIP:</u><br /><br />Occasionally it can happen that CrackerTracker detects a file as insecure. This can happen as PHP files can be very, very different and sometimes a developer wants that the code is writeable from outside. In this case - and ONLY if are absolutely sure you can tell CRACKERTRACKER that this is a secure file. Just write in this file at the very beginning: <?php the following code: <br /><br /><br /><i>// CTracker_Ignore: File Checked By Human</i><br /><br /><br />If you are not suree you can also look at the <a href="http://www.community.cback.de" target="_blank">CBACK Community</a> for more instructions.';
$lang['ctracker_fscan_unchecked']		  = 'NOT CHECKED';
$lang['ctracker_fscan_ok']                = 'SAFE';
$lang['ctracker_fscan_prob_1']			  = 'extension.inc not / too late included';
$lang['ctracker_fscan_prob_2']			  = '$phpbb_root_path maybe not be initialised correctly';
$lang['ctracker_fscan_prob_3']			  = 'common.php / pagestart.php maybe not be or too late included';
$lang['ctracker_fscan_prob_4']			  = 'Code in the file is possibly executable beyond from phpBB';
$lang['ctracker_fscan_prob_5']			  = 'extension.inc is missing and/or $phpbb_root_path and/or  constant not found';
$lang['ctracker_fscan_prob_def']		  = 'An undefined case occurred during scanning';
$lang['ctracker_fscan_important']		  = 'Please Pay Attention!';
$lang['ctracker_fscan_sel_action']		  = 'To start the check of all files please click on "Start Filecheck". When this is completed click on "Show Results" to show the results of the check. This list can be retrieved any time using the ACP until a new check will be started.<br /><br /><br />For technical reasons it is not possible to give an <u>unambiguous</u> and <u>unfailing</u> information about the safety of a PHP Script. So don\'t be too certain. It can happen, that the scanner classifies a secure file as insecure, and vice versa. PHP is so complex and codes too - so there can\t be hundred per cent safety. In this there won\'t be insecure scripts anymore. ;-)<br /><br /><br />This scanner is specialised to detect security holes in included files. With this scanner you can easily find these risks and correct them.<br /><br /><br />For more details and instructions use CBACK Community!<br /><br /><br />';
$lang['ctracker_fscan_head']			  = 'CBACK CrackerTracker Security Scanner';
$lang['ctracker_fscan_subhead']			  = 'These Security scanner checks all PHP files of your Forum on important problems so that there will not be security holes which could be exploits by Worms. These holes can be used from outside without using files of the board. So the CrackerTracker System will be inactive and can\'t protect the file. With the ACP Module you have the option to specific detect holes like that and correct them.<br /><br /><br /><b>Please note:</b> Not all servers supports this feature! By very large Boards it can necessarily happen that this performanceintensive Scansystem oversteps the PHP Execution Time. The algorithm of this Scanner were on one\'s best optimised, that this is restraining in limits, however it sadly can occur on some machines. We plead to consider this.<br /><br /><br />&raquo; The last check took place at <b>%s</b>.';$lang['ctracker_fscan_option1']			  = 'Start Filecheck';
$lang['ctracker_fscan_option2']			  = 'Show Results';


/*
 * Global message in ACP
 */
$lang['ctracker_glob_msg_head']			  = 'Global Message';
$lang['ctracker_glob_msg_subhead']		  = 'Here you can leave a global message to all users. This message the user will see on the next Login. You have the option either to refer on a thread or to write your own text (255 characters). ;)';
$lang['ctracker_glob_msg_entry']          = 'Set global message ';
$lang['ctracker_glob_msg_submit']		  = 'Insert';
$lang['ctracker_glob_msg_reset']		  = 'Cancel Message';
$lang['ctracker_glob_msg_type']			  = 'Type of the global message';
$lang['ctracker_glob_type_1']			  = 'Text';
$lang['ctracker_glob_type_2']			  = 'Link';
$lang['ctracker_glob_msg_txt']			  = 'Text of the global message';
$lang['ctracker_glob_msg_link']			  = 'Link Destination in the message';
$lang['ctracker_glob_msg_reset']		  = 'Cancel current message';
$lang['ctracker_glob_res_txt']			  = 'When you click on "Cancel current message" a recorded message will be canceled.';
$lang['ctracker_glob_msg_saved']		  = 'The global message was successfully saved.<br /><br />Click <a href="%s">HERE</a> to go back to CrackerTracker Management.';
$lang['ctracker_glob_msg_reset_ok']		  = 'The global message was deleted from user table. The entered message will not be shown anymore.<br /><br />Click <a href="%s">HERE</a> to go back to CrackerTracker Management.';
$lang['ctracker_dbg_mode']            = '<b>CrackerTracker runs on DEBUG MODE. This should not be a permanent condition.<br />Please set back to normal modus as soon as possible.<br /><br /><u>This message can not be deleted!</u></b>';

/*
 * IP&Agent Blocker
 */
$lang['ctracker_ipb_delete']			  = 'Delete Entry';
$lang['ctracker_ipb_blocklist']			  = 'Block list entries';
$lang['ctracker_ipb_head']                = 'Proxy, IP & UserAgent Blocker';
$lang['ctracker_ipb_description']		  = 'Here you can manage the Blocklist for the CrackerTracker Proxy, IP and UserAgent Blocker. You can delete existing entries and add new ones. With a new entry you have the option to use (*) to enter any combination out of the filter in the list. For example: lwp* locks lwp-1 as well as lwp-simple etc. or 100.*.*.* locks all IP-Addresses beginning with 100. .<br /><br /><b>CAUTION</b> Watch out that you don\'t lock your own UserAgent or IP-Address. Otherwise you are out of your Forum!';
$lang['ctracker_ipb_new_entry']			  = 'New Entry';
$lang['ctracker_ipb_added']               = 'Entry successfully added!';
$lang['ctracker_ipb_deleted']			  = 'Entry successfully deleted!';
$lang['ctracker_ipb_add_now']			  = 'Add Entry';


/*
 * Log Manager
 */
$lang['ctracker_log_manager_title']		  = 'Logfile Manager';
$lang['ctracker_log_manager_subtitle']	  = 'Here you can show or delete all Logfiles from CrackerTracker.';
$lang['ctracker_log_manager_overview']	  = 'Log Manager Overview';
$lang['ctracker_log_manager_blocked']	  = 'CrackerTracker has blocked <b>%s</b> attacks so far.';
$lang['ctracker_log_manager_overview']	  = 'Logfile Overview';
$lang['ctracker_log_manager_head1']		  = 'Logname';
$lang['ctracker_log_manager_head2']		  = 'Number of entries';
$lang['ctracker_log_manager_head3']		  = 'Features';
$lang['ctracker_log_manager_name2']		  = 'Worm & Exploit Protection';
$lang['ctracker_log_manager_name3']		  = 'IP, Proxy & UserAgent Blocker';
$lang['ctracker_log_manager_name4']		  = 'Incorrect Logins';
$lang['ctracker_log_manager_name5']		  = 'Blocked Spammers';
$lang['ctracker_log_manager_name6']     = 'Debug Entries';
$lang['ctracker_log_manager_view']		  = 'VIEW';
$lang['ctracker_log_manager_delete']	  = 'DELETE';
$lang['ctracker_log_manager_delete_all']  = 'Delete All Logfiles';
$lang['ctracker_log_manager_deleted']	  = 'The log file has been deleted successfully!';
$lang['ctracker_log_manager_all_deleted'] = 'All log files have been deleted successfully!';
$lang['ctracker_log_manager_showheader1'] = 'There is <b>one</b> entry in this log file. Click <b><a href="%s">HERE</a></b> to go back to Logfile overview.';
$lang['ctracker_log_manager_showheader']  = 'There are <b>%s</b> entries in this log file.<br />Click <b><a href="%s">HERE</a></b> to go back to Logfile overview.';
$lang['ctracker_log_manager_showlog']	  = 'View Logfile';
$lang['ctracker_log_manager_cell_1']	  = 'Date / Time';
$lang['ctracker_log_manager_cell_2a']	  = 'Appeal';
$lang['ctracker_log_manager_cell_2b']	  = 'Username';
$lang['ctracker_log_manager_cell_3']	  = 'Referer';
$lang['ctracker_log_manager_cell_4']	  = 'UserAgent';
$lang['ctracker_log_manager_cell_5']	  = 'IP Address';
$lang['ctracker_log_manager_cell_6']	  = 'Remote Host';
$lang['ctracker_log_manager_sysmsg']	  = 'Last cleaning of the Logfile was <b>%s</b>.';


/*
 * Footer configuration
 */
$lang['ctracker_footer_head']			  = 'Footer Management';
$lang['ctracker_footer_subhead']		  = 'Here you can choose which footer CrackerTracker should show in your Forum. Please do not change the footer and the link to www.cback.de!';
$lang['ctracker_select_footer']			  = 'Choose Footer';
$lang['ctracker_footer_saveit']			  = 'Accept Footer Layout';
$lang['ctracker_footer_done']			  = 'Changes on Footer were saved successfully!';


/*
 * Maintenance Module in ACP
 */
$lang['ctracker_ma_unknown']			  = '<font color="#FFB900"><b>UNKNOWN</b></font>';
$lang['ctracker_ma_secure']			  	  = '<font color="#1CBF00"><b>SAFE</b></font>';
$lang['ctracker_ma_warning']			  = '<font color="#FF0000"><b>CAUTION</b></font>';
$lang['ctracker_ma_active']			  	  = '<font color="#1CBF00"><b>ACTIVE</b></font>';
$lang['ctracker_ma_inactive']			  = '<font color="#FF0000"><b>INACTIVE</b></font>';
$lang['ctracker_ma_on']				  	  = 'ON';
$lang['ctracker_ma_off']				  = 'OFF';
$lang['ctracker_ma_ca']				  	  = '<font color="#1CBF00"><b>OK</b></font>';
$lang['ctracker_ma_ci']					  = '<font color="#FF0000"><b>NOT SET</b></font>';
$lang['ctracker_ma_head']				  = 'Maintenance and System check';
$lang['ctracker_ma_subhead']			  = 'This system automatically examines the CrackerTracker safety modules for features and shows tips to optimize your system.';
$lang['ctracker_ma_systest']			  = 'Automatic System Test';
$lang['ctracker_ma_sectest']			  = 'Security Test';
$lang['ctracker_ma_maint']				  = 'Service Function';
$lang['ctracker_ma_name_1']				  = 'Worm- & Exploitprotection System';
$lang['ctracker_ma_name_2']				  = 'Variable Control Unit';
$lang['ctracker_ma_name_3']				  = 'IP, Proxy & UserAgent Protection Unit';
$lang['ctracker_ma_name_4']				  = 'Worm Heuristics Definitions Batch - Number of Definitions: <b>%s</b>';
$lang['ctracker_ma_syshead_1']			  = 'Security Module';
$lang['ctracker_ma_syshead_2']			  = 'Status';
$lang['ctracker_ma_seccheck_1']			  = 'Checkpoint';
$lang['ctracker_ma_seccheck_2']			  = 'Version / Status';
$lang['ctracker_ma_seccheck_3']			  = 'Reference';
$lang['ctracker_ma_seccheck_4']			  = 'Status';
$lang['ctracker_ma_scheck_1']			  = 'PHP Version (<a href="http://www.php.net" target="_blank">Visit Website</a>)';
$lang['ctracker_ma_scheck_2']			  = '&raquo; PHP SAFE MODE';
$lang['ctracker_ma_scheck_3']			  = '&raquo; PHP GLOBALS';
$lang['ctracker_ma_scheck_4']			  = 'phpBB Version (<a href="http://www.phpbb.com" target="_blank">Visit Website</a>)';
$lang['ctracker_ma_scheck_4a']			  = '&raquo; Visual Confirmation';
$lang['ctracker_ma_scheck_4b']			  = '&raquo; Account Activation';
$lang['ctracker_ma_scheck_5']			  = 'CBACK CrackerTracker (<a href="http://www.cback.de" target="_blank">Visit Website</a>)';
$lang['ctracker_ma_chmod']				  = '<b>CHMOD777 Status:</b> ';
$lang['ctracker_ma_desc_link']			  = 'EXECUTE NOW';
$lang['ctracker_ma_desc1']				  = '<b>Clear IP, Proxy & UserAgent Table</b><br />Here you can delete <u>all</u> entries from IP, Proxy & UserAgent Table.';
$lang['ctracker_ma_desc2']				  = '<b>Factory setting: IP, Proxy & UserAgent Blocker</b><br />Here you can restore the delivery status of the IP, Proxy & the user agent data base table. Your filters are lost, however!';
$lang['ctracker_ma_desc3']				  = '<b>Delete Login History</b><br />Here you can delete all entries from Login History, regardless the user and regardless the adjusted number of saves per user.';
$lang['ctracker_ma_desc4']				  = '<b>Clear File-Hashchecktable</b><br />Delete all saved entries from the table of File-Hashcheck.';
$lang['ctracker_ma_desc5']				  = '<b>Clear Securitscanner Table</b><br />Delete all results that were stored during the file security examination in the data base.';
$lang['ctracker_ma_succ_main']			  = 'Process executed successfully!';
$lang['ctracker_ma_err_main']			  = 'Process executed unsuccessfully!';


/*
 * Miserable User Module in ACP...
 */
$lang['ctracker_mu_success']			  = 'The user has been marked as "Miserable User" and will get some problems by surfing your Forum immediately. ;)';
$lang['ctracker_mu_error_admin']		  = 'ADMINS or MODs are not be able to marked as Miserable User!';
$lang['ctracker_mu_deleted']			  = 'The chosen users have been deleted from the Miserable User Userlist successfully.';
$lang['ctracker_mu_head']				  = 'Miserable User';
$lang['ctracker_mu_subhead']			  = 'Let\'s say a user doesn\'t behave right and has already signed on with a different account after he got banned. There is a feature called "Miserable user", which was frequently requested. The CrackerTracker system does not couple this to "We Solve Unreasonable Error Messages", which is easily transparent, but proceeds according to the principle "Don\'t feed the Monkey": A so-called "Miserable user" is marked, and his posts can only be read by the administrator. For other users, the contributions are invisible, therefore nobody has to deal with the troublemaker and it will get boring for him and he will leave the forum.<br /><b>Note: <u>This function just let\'s vanish the postings inside a thread.</u> Using "Quote" or "Search" still shows you the postings of the "Miserable User"!';
$lang['ctracker_mu_select']				  = 'Mark user as Miserable User';
$lang['ctracker_mu_find']				  = 'Look for Usernames';
$lang['ctracker_mu_send']				  = 'Enter Usernames';
$lang['ctracker_mu_entr']				  = 'Marked Usernames';
$lang['ctracker_mu_uname']				  = 'Entered Username';
$lang['ctracker_mu_remove']				  = 'Delete Entries';
$lang['ctracker_mu_no_defined']			  = 'There are no users marked as "Miserable User" up to now.';


/*
 * Recovery feature in ACP
 */
$lang['ctracker_rec_head']				  = 'System Recovery';
$lang['ctracker_rec_subhead']			  = 'Here you can back up the Configuration Table from your Forum or you can go to the last running configuration. If you have activated this feature in the general settings of CrackerTracker, then it will be backed up every time you change the General Settings. (CAUTION! It is <b>NOT</b> a Backup of the complete database!)<br /><br />When you are not in the ACP after you have changed settings, then you can reactivate the last running configuration using the Emergency Console of CrackerTracker, too. Please read the file comment in <i>ctracker/emergency.php</i> for more instructions of Forum configurations in an emergency. Please note, that this file has to be enabled before using.<br /><br /><b>CAUTION!</b> This feature should be only used with serious problems!';
$lang['ctracker_rec_last_saved']		  = 'Last Backup of the Configuration Table: <b>%s</b>';
$lang['ctracker_rec_never_saved']		  = 'The Configuration Table has not been backed up so far!';
$lang['ctracker_rec_backup']			  = 'Backup of Configuration Table';
$lang['ctracker_rec_restore']			  = 'Recover the at last running Configuration Table';
$lang['ctracker_rec_succ']				  = 'The database process has been executed successfully.';
$lang['ctracker_rec_pab']				  = 'Recovery is not available before you have made a successful Backup!';


/*
 * Language Strings used at multiple places
 */
$lang['ctracker_error_updating_userdata'] = 'CBACK CrackerTracker couldn\'t run the database operation in the Usertable.';
$lang['ctracker_error_database_op']       = 'CBACK CrackerTracker couldn\'t run the database operation correctly.';
$lang['ctracker_message_dialog_title']    = 'CBACK CrackerTracker Professional';


/*
 * Language Strings used for the footer itself
 */
$lang['ctracker_fdisplay_imgdesc']		  = 'Board Security';
$lang['ctracker_fdisplay_n'] 			  = '<a href="http://www.cback.de" target="_blank">Security</a> with <a href="http://www.cback.de" target="_blank">CBACK CrackerTracker</a>.';
$lang['ctracker_fdisplay_c'] 			  = 'Protected by <a href="http://www.cback.de" target="_blank">CBACK CrackerTracker</a><br /><b>%s</b> Attacks blocked.';
$lang['ctracker_fdisplay_g'] 			  = '<b>%s</b> Attacks blocked';


/*
 * Language Strings for the class_ct_database.php
 */
$lang['ctracker_error_loading_config']    = 'The CBACK CrackerTracker Configuration couldn\'t be loaded from the database. Have you run the installation script and edited the file "includes/constants.php" correctly?';
$lang['ctracker_error_updating_config']   = 'The CBACK CrackerTracker Configuration couldn\'t be updated. Have you run the installation script and edited the file "includes/constants.php" correctly?';
$lang['ctracker_error_loading_blocklist'] = 'The CBACK CrackerTracker Blocklist couldn\'t be loaded from Database. Have you run the installation script and edited the file "includes/constants.php" correctly?';
$lang['ctracker_error_insert_blocklist']  = 'The data couldn\'t be added to CBACK CrackerTracker Blocklist. Have you run the installation script and edited the file "includes/constants.php" correctly?';
$lang['ctracker_error_delete_blocklist']  = 'The data couldn\'t be removed from CBACK CrackerTracker Blocklist. Have you run the installation script and edited the file "includes/constants.php" correctly?';
$lang['ctracker_error_login_history']     = 'There has been an error with the database operations inside CBACK CrackerTracker Login History. Have you run the installation script and edited the file "includes/constants.php" correctly?';
$lang['ctracker_error_del_login_history'] = 'The CBACK CrackerTracker Login History Table couldn\'t be emptied.';


/*
 * Language Strings used in class_ct_userfunctions.php
 */
$lang['ctracker_info_search_time']        = "For safety reasons the search is only possible %s times within %s seconds. If this number was exceeded, you must wait now <span id=\"waittime\">%s</span> seconds, until you can implement the next search procedure. <script type=\"text/javascript\"><!-- \n var wait = %s; var waitt = wait * 1000; for(i=1; i <= wait; i++) { window.setTimeout(\"newoutput(\" + i + \")\", i * 1000); } function newoutput(waitcounter) { if ( (waitt/1000) == waitcounter ) { document.getElementById(\"waittime\").innerHTML = \"0\"; } else { document.getElementById(\"waittime\").innerHTML = (waitt/1000) - waitcounter; } } //--></script>";
$lang['ctracker_info_regist_time']        = "For safety reasons a registration is only possible every %s seconds. If this number was exceeded, you must wait now <span id=\"waittime\">%s</span> seconds, until you can implement the next search registrations. <script type=\"text/javascript\"><!-- \n var wait = %s; var waitt = wait * 1000; for(i=1; i <= wait; i++) { window.setTimeout(\"newoutput(\" + i + \")\", i * 1000); } function newoutput(waitcounter) { if ( (waitt/1000) == waitcounter ) { document.getElementById(\"waittime\").innerHTML = \"0\"; } else { document.getElementById(\"waittime\").innerHTML = (waitt/1000) - waitcounter; } } //--></script>";
$lang['ctracker_info_regip_double']		  = 'There has already been a registration from this IP-Address. From safety reasons you only one registration from the same IP address is possible.';
$lang['ctracker_info_profile_spammer']	  = 'This registration was identified as a spam account! If you think, that this was incorrect, please contact the administrator of this forum so that he can check your account.';
$lang['ctracker_info_password_minlng']    = 'The Administrator has set, that the password must contain minimum <b>%s</b> characters. Your chosen password has only <b>%s</b> characters. Please click on "Back" to enter a new password.';
$lang['ctracker_info_password_cmplx']	  = 'The Administrator has set, that the password must contain out of  <b>minimum</b> the following things: %s';
$lang['ctracker_info_password_cmplx_1']	  = 'Figures';
$lang['ctracker_info_password_cmplx_2']	  = 'Lower case';
$lang['ctracker_info_password_cmplx_3']	  = 'Capitals';
$lang['ctracker_info_password_cmplx_4']	  = 'Special Characters';
$lang['ctracker_info_pw_expired']		  = "The administrator has made adjustments so that a password may be valid only for <b>%s days</b>. days. We recommend for safety reasons that you change your password now. (<a href='profile.$phpEx?mode=editprofile&u=%d'>Profile</a>)";


/*
 * Language Strings used in ct_visual_confirm.php
 */
$lang['ctracker_login_wrong']   = 'The entered Visual Confirmation Code was incorrect!';
$lang['ctracker_code_dbconn']   = 'Couldn\'t load Visual Confirmation Code from database! If you have a phpBB Plus you have to install the phpBB internat modules for the Visual Confirmation. Please read the references to phpBB Plus in the "add_ons" folder of CrackerTracker Mod Package!';
$lang['ctracker_login_success'] = 'Your Account has been activated again.<br /><br />Click <a href="%s">HERE</a> to go back to Login.';
$lang['ctracker_code_count']    = 'The number of entries of Visual Confirmation has exceeded the limit in this session.';


/*
 * Language Strings used in ctracker_login.php
 */
$lang['ctracker_login_title']   = 'CrackerTracker Account Activation';
$lang['ctracker_login_logged']  = 'Logged In Users cannot access the site.';
$lang['ctracker_login_confim']  = 'The adjusted number of wrong Logins for your Account was reached. Therefore your Account has been locked. It will have to be reactivated using  Visual Confirmation.<br /><br />Please type in the following code and click on "Unlock" to unlock your account. If this is done you can log on again.';
$lang['ctracker_login_button']  = 'Activate';


/*
 * Language Strings for IP Warning Engine
 */
$lang['ctracker_ipwarn_info']	= 'IP Range Scanning for your Account is <b>%s</b>';
$lang['ctracker_ipwarn_prof']	= 'IP Range Scanner';
$lang['ctracker_ipwarn_pdes']	= 'The IP Range Scanner checks, if activated, the so-called IP Range on changes. If someone is logged on with your account from another location you will get a short message (also if you are logged on from different locations). If someone is logged on with your account from another location you will get a short message (also if you are logged on from different locations). Please check the footer to see if the warning feature is still activated. Maybe an aggressor deactivated this. The Login remains active however, thus you still have the ability to make changes after the activation.';
$lang['ctracker_ipwarn_chng']	= '<b>&raquo; ADVICE &laquo;</b><br />The IP Range for your account has changed. The actual Login took place from <b>%s</b>, the previous from <b>%s</b>. If you didn\'t log on from another location, then may be an aggressor has used your account without authorisation!';
$lang['ctracker_ipwarn_welc']	= '<b>&raquo; ADVICE &laquo;</b><br />The IP Range Scanner for your Account has not been initialised yet. This happens after two Logins. If you like to initialize the Scanner now, then log on and out twice.';
$lang['ctracker_ipwarn_send']	= 'Accept Settings';


/*
 * Language Strings for Login History
 */
$lang['ctracker_lhistory_h']	= 'Login History';
$lang['ctracker_lhistory_i']	= 'Here you can have a look at your recorded IP addresses and the Login-time since you last <b>%s</b> Login. You can see if your account was used by someone else. If there are unknown Login-times or IP adresses in the Login History - it is possible that someone has grabbed your password. In this case you should change the password for your account and check your e-mail account too.';
$lang['ctracker_lhistory_h1']	= 'Login Date and Time';
$lang['ctracker_lhistory_h2']	= 'Saved IP address';
$lang['ctracker_lhistory_nav']	= 'CrackerTracker Login History';
$lang['ctracker_lhistory_err']  = 'You must be logged in to use the features of CrackerTracker.';
$lang['ctracker_lhistory_off']  = 'Login History was deactivated by Admin.';


/*
 * Other Language Strings used in the Board itself
 */
$lang['ctracker_gmb_link']		= 'The Admin has written an important note to all users. This note can be seen here:<br /><br /><a href="%s">%s</a><br />';
$lang['ctracker_gmb_mark']		= 'Mark Post Read';
$lang['ctracker_gmb_markip']	= 'Remove tip';
$lang['ctracker_gmb_loginlink']	= 'Login Security';
$lang['ctracker_gmb_1stadmin']	= 'The Setup or Settings of the first Admin cannot be changed.';
$lang['ctracker_gmb_pu_1']		= '<b>CBACK CrackerTracker - Misconfiguration</b><br /><br />Port 21 is used for FTP Services. If the Forum will be reconverted to this Port the Forum is normally no more executable, because Browsers use this Port for FTP as well.';
$lang['ctracker_gmb_pu_2']		= '<b>CBACK CrackerTracker - Misconfiguration</b><br /><br />The Sessionlength is set undersize! Maybe thus you will always logged out of the Forum before you can correct the setting.';
$lang['ctracker_gmb_pu_3']		= '<b>CBACK CrackerTracker - Misconfiguration</b><br /><br />The Scriptpath begins and/or ends either not with a Slash (/www/) or doesn\'t only compose of the Slash (/)!';
$lang['ctracker_gmb_pu_4']		= '<b>CBACK CrackerTracker - Misconfiguration</b><br /><br />The Servername doesn\'t end with a Slash (/) !';
$lang['ctracker_binf_spammer']	= 'The Spam Security System is watching you. You have reached your maximum number of posts within %s seconds. When you try to write withing <b>%s</b> seconds another post, your account will be <b>blocked!</b><br /><br />Please wait. Sorry to take your time, but this is necessary for safety reasons.';
$lang['ctracker_binf_sban']		= 'The Spam Block System has banned your account because you have been identified as a spammer.';
$lang['ctracker_sendmail_info'] = 'Due to safety reasons you are only allowed to send an e-mail every %s minutes.';
$lang['ctracker_pwreset_info']	= 'Due to safety reasons it is not possible to send a new password every %s minutes. Please contact the administrator if you have trouble!';
$lang['ctracker_vc_guest_post'] = 'Visual Confirmation for Guests';
$lang['ctracker_vc_guest_expl'] = 'Please enter the following code before sending your post. For guests this is neccessary due to Spam Security reasons.';

?>
