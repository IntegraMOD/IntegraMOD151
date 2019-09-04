<?php
/***************************************************************************
 *						lang_extend_pcp_addons.php [English]
 *						------------------------------------
 *	begin				: 30/10/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 1.0.0 - 30/10/2003
 *
 ***************************************************************************
 *
 *								Customs lang key entries
 *
 ***************************************************************************/
 
/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

// admin part
if ( $lang_extend_admin )
{
	$lang['Lang_extend_pcp_addons'] = 'Add-ons for Profile Control Panel';
}

// START - SEND PM ON REGISTER MOD - AbelaJohnB 
$lang['register_pm_subject'] = 'Welcome to %s'; 
$lang['register_pm'] = 'Hello!<br /><br />Welcome to %s. <br /><br />We hope you enjoy your time at this site! <br /><br />Feel free to join in and share with others or start your own discussion! <br /><br />~Enjoy!<br />%s Staff '; 
// END - SEND PM ON REGISTER MOD - AbelaJohnB 

$lang['PCP_topics_last'] = 'Recent Topics';
$lang['PCP_topics_last_per_page'] = 'Number of recent topics displayed per page on home panel';
$lang['PCP_topics_last_visit'] = 'Since your last visit';

$lang['country_explain'] 	= 'Please choose your Country and your Country flag will display in your profile and topics section';
$lang['profil_country']		= 'Country Flag';
$lang['profil_state']		= 'State Flag';
$lang['state_explain'] 	    = 'Please choose your State and your State flag will display in your profile and topics section';
$lang['personal_album']		= 'Personal Album';
$lang['Holidays'] = 'Holidays';
$lang['On_Holidays'] = 'On Vacation';
$lang['No_holidays_specify'] = 'Unknown';
// skype :: added :: start
$lang['SKYPE'] = 'Skype';
// skype :: added :: end

$lang['FDOW']	= 'First day of the week'; // calendar fix

// ADR+PCP
$lang['profilcp_public_adr_shortcut'] = 'Character Sheet';
$lang['profilcp_character_pagetitle'] = 'ADR';
$lang['Judge'] = 'Judge Me';
$lang['vault_account_amount']='Capital';
$lang['vault_loan_amount']='Loan';
$lang['vault_confidential']='Hidden';
