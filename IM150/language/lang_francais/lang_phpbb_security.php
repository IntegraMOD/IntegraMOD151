<?php
/***************************************************************************
 *                             lang_phpbb_security.php
 *                            -------------------------
 *		Version			: 1.0.1
 *		Email			: austin@phpbb-amod.com
 *		Site			: http://phpbb-amod.com
 *		Copyright		: aUsTiN-Inc 2003/4 
 *
 ***************************************************************************/

$lang['PS_security_title']			= 'Security control panel';
$lang['PS_security_question'] 		= 'Security Question';
$lang['PS_security_question_exp'] 	= 'This will be asked if your account becomes locked caused by to many failed login attempts.';
$lang['PS_security_answer']			= 'Security Answer';
$lang['PS_security_answer_exp']		= 'This is the answer to the above question. When you use it to unlock your account, you will HAVE to use this and it is CaSe SeNsItIvE.';
$lang['PS_security_error']			= 'Error';
$lang['PS_security_info']			= 'Information';
$lang['PS_security_one']			= 'The Security Question & Answer Are Required Fields.';
$lang['PS_security_a_exp']			= '<br>The above is a \'hash\' of your Security Answer. This is how it is saved in the database so no one can steal it or see it. You need to write down the real (un-hashed) answer so you dont lose it.';
$lang['PS_security_locked']			= 'Sorry, this account has exceeded its log in attempts. It is now locked. If you are the rightfull user, please click below to be redirected to a page to unlock your id.<br><br>Click <a href="login_security.'. $phpEx .'?phpBBSecurity=retreive&sid='. $userdata['session_id'] .'">Here</a> to unlock your account.';
$lang['PS_security_force']			= 'Sorry, it appears this is your first visit since we added the security questions to accounts. You will only be able to view your profile until you update it and add a question and answer. Thanks!';
$lang['PS_admin_one']				= 'Login Attemps';
$lang['PS_admin_one_exp']			= '<br>This is the amount of times someone can get the password incorrect before locking the account.';
$lang['PS_admin_two']				= 'Notify Admin';
$lang['PS_admin_two_exp']			= '<br>If this is set to \'Enabled\', specify what methods the admin is to be notified by below it.';
$lang['PS_admin_three']				= 'Admin';
$lang['PS_admin_three_exp']			= '<br>This is the admin you want to be notified if set to \'Enabled\' above.';
$lang['PS_admin_err_one']			= 'The login limit needs to be greater than 0. Please click Back and try again.';
$lang['PS_admin_err_two']			= 'You choose to notify an admin, so please choose to select an admin id. Please click Back and try again.';
$lang['PS_admin_error_three']		= 'The admin id needs to be a numeric value. Please click Back and try again.';
$lang['PS_admin_error_four']		= 'The admin id needs to be a value greater than 0. Please click Back and try again.';
$lang['PS_admin_error_five']		= 'The login limit needs to be a numeric value. Please click Back and try again.';
$lang['PS_admin_current']			= 'Current Admin: %A%';
$lang['PS_admin_default']			= 'Choose One';
$lang['PS_login_title']				= 'phpBB Security';
$lang['PS_login_header']			= 'phpBB Security';
$lang['PS_login_username']			= 'Please enter your username';
$lang['PS_login_email']				= 'Please enter the email associated with this account';
$lang['PS_login_step_one']			= 'Step One: Account Info Validation';
$lang['PS_login_step_two']			= 'Step Two: Security Question Validation';
$lang['PS_login_step_failed']		= 'Sorry, the information you provided is incorrect.';
$lang['PS_login_button']			= 'Validate';
$lang['PS_login_validated']			= 'Thank you for unlocking your account. You may now login.';
$lang['PS_profile_explain']			= 'It is important you think before filling this in. You will not be able to change these at will. You will need an admins approval to change them, for security purposes. Once they are set, all you will be able to do is view them.';
$lang['PS_forgot_sq']				= '<a href="login_security.'. $phpEx .'?phpBBSecurity=forgot&sid='. $userdata['session_id'] .'">Forgot Your Security Question?</a>';
$lang['PS_forgot_exp']				= 'If you have forgoten your security answer, you will need to contact an admin and have them reset your security information. The email to contact is '. $board_config['board_email'] .'. If you can not reach an admin that way, please look at admin profiles for email links. When you update it, please use information you can remember to avoid having to do this again.';
$lang['PS_user_lock']				= 'Locked Status';
$lang['PS_user_lock_exp']			= 'If the account is locked, anytime the user tries to log in, they will be forced to input their security information.';
$lang['PS_user_reset']				= 'Reset Security Information';
$lang['PS_user_reset_exp']			= 'Warning: If you check this, the user will be forced to input new information. It will delete their current security settings.';
$lang['PS_user_status_l']			= 'This account is currently locked. Checking this box will <b>un-lock</b> it.';
$lang['PS_user_status_u']			= 'This account is currently un-locked. Checking this box will <b>lock</b> it.';
$lang['PS_pm_subject']				= 'An account has been locked.';
$lang['PS_pm_message']				= 
'An account was just locked. Below are the details.

Account Locked: %U%
IP For Who Locked It: %I%

This is an automated response, do not reply. If you have an IP tracker installed, check the above IP against the ones you have stored in the database.';
$lang['PS_admin_ban']				= 'Auto Ban';
$lang['PS_admin_ban_exp']			= '<br>This will automatically ban any IP that tries to use a trick. This option overrides all the individual options. If you want to use the individual options, set this to \'Disabled\' and setup your individual settings.';
$lang['PS_admin_sessions']			= 'Max Allowed Sessions';
$lang['PS_admin_sessions_exp']		= '<br>If your sessions table gets bigger than this number, the mod will automatically get it below this number.';
$lang['PS_clike']					= 'Clike Attempt';
$lang['PS_union']					= 'Union Attempt';
$lang['PS_sql']						= 'SQL Injection Attempt';
$lang['PS_ddos']					= 'DDoS Attempt';
$lang['PS_caught_left']				= 'IP';
$lang['PS_caught_c_left']			= 'Caught For';
$lang['PS_caught_c_right']			= 'Caught On';
$lang['PS_caught_right']			= 'Attempts';
$lang['PS_caught_msg']				= 'There have been no attempts by script kiddies on our site.';
$lang['PS_special']					= 'phpBB Security :: Special Fields';
$lang['PS_special_admins']			= 'Amount of allowed admins';
$lang['PS_special_admins_exp']		= '<br>This number will set how many admins are allowed to be on your site. So no one can inject an admin account to gain access.';
$lang['PS_special_admins_total']	= '<br>You currently have %X% real users set to \'Admin\' status in the users table.';
$lang['PS_special_admins_offset']	= '<font color="red"> It appears you have more admins in the users table than allowed!</font>';
$lang['PS_special_mods']			= 'Amount of allowed mods';
$lang['PS_special_mods_exp']		= '<br>This number will set how many moderators are allowed to be on your site. So no one can inject a moderator account to gain access.';
$lang['PS_special_mods_total']		= '<br>You currently have %X% real users set to \'Moderator\' status in the users table.';
$lang['PS_special_mods_offset']		= '<font color="red"> It appears you have more mods in the users table than allowed!</font>';
$lang['PS_use_special']				= 'Protect admin & moderator accounts';
$lang['PS_use_special_exp']			= '<br>Disabling this, will not stop any extra admins or mods added.';
$lang['PS_fopen_fwrite']			= 'File Writing Attempt';
$lang['PS_system']					= 'Perl Execution Attempt';
$lang['PS_chr']						= 'Encoded Characters Attempt';
$lang['PS_cback']					= 'CBACK Worm Attempt';
$lang['PS_allow_user_change']		= 'Allow users to change their SQ info. <b>Not recommended.</b>';
$lang['PS_notify_admin_by_pm']		= 'Private Message';
$lang['PS_notify_admin_by_em']		= 'Email';
$lang['PS_option_ban']				= 'Ban';
$lang['PS_option_block']			= 'Block';
$lang['PS_option_ignore']			= 'Ignore';
$lang['PS_option_warning']			= '<b>Warning:</b> Setting any of the below to \'Ignore\' will allow anyone to use these tricks on your site. You have been warned.';
$lang['PS_list_choice_one']			= 'Yes';
$lang['PS_list_choice_two']			= 'No';
$lang['PS_list_one']				= 'Action to take in a <b>DDoS</b> attempt?';
$lang['PS_list_two']				= 'Action to take in a <b>Clike</b> attempt?';
$lang['PS_list_three']				= 'Action to take in a <b>UNION</b> attempt?';
$lang['PS_list_four']				= 'Action to take in a <b>CBACK Worm</b> attempt?';
$lang['PS_list_five']				= 'Action to take in an <b>SQL Injection</b> attempt?';
$lang['PS_list_six']				= 'Action to take in a <b>Perl Script</b> attempt?';
$lang['PS_list_seven']				= 'Action to take in an <b>Encoded Characters</b> attempt?';
$lang['PS_list_eight']				= 'Action to take in a <b>File Write/Open</b> attempt?';
$lang['PS_blocked_line']			= 'phpBB Security 1.0.1 &copy <a href="http://www.phpbb-amod.com">phpBB-Amod</a> <a href="login_security.php?phpBBSecurity=caught" class="copyright">Has Blocked %T% Exploit Attempts.</a>';

?>