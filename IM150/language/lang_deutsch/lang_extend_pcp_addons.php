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

/***************************************************************************
 *
 *   german translation	:		clanpunisher
 *
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die("Hacking Versuch");
}

// admin part
if ( $lang_extend_admin )
{
	$lang['Lang_extend_pcp_addons'] = 'Erweiterte Profileinstellung';
}

// START - SEND PM ON REGISTER MOD - AbelaJohnB 
$lang['register_pm_subject'] = 'Willkommen %s'; 
$lang['register_pm'] = 'Hallo!<br /><br />Willkommen %s. <br /><br />Wir hoffen, dass du deine Zeit auf dieser Webseite genießen wirst!<br /><br />Fühl dich frei und beteilige dich an den bereits begonnen Diskussionen oder eröffnen selber welche! <br /><br />~Beginne!<br />%s Staff '; 
// END - SEND PM ON REGISTER MOD - AbelaJohnB 

$lang['gallery'] = 'Benutzer-Gallerie';
$lang['PCP_topics_last'] = 'Neue Themen';
$lang['PCP_topics_last_per_page'] = 'Anzahl der neuen Themen auf der der Startseite';
$lang['PCP_topics_last_visit'] = 'Seit deinem letzten Besuch';

$lang['gal_pic_in'] = ' Bilder in ';
$lang['gal_pic'] = ' Bilder';
$lang['user_photo'] = 'Foto im öffentlichen Profil';
$lang['user_photo_explain'] = 'Du hast kein Foto aus deiner Benutzer-Gallerie ausgewählt. Bitte <a href="album_personal.php">uploade ein Foto</a> und wähle <a href="profile.php?mode=profil">dein Profil</a> aus';

$lang['country_explain'] 	= 'Please choose your Country and your Country flag will display in your profile and topics section';
$lang['profil_country']		= 'Country Flag';
$lang['profil_state']		= 'State Flag';
$lang['state_explain'] 	        = 'Please choose your State and your State flag will display in your profile and topics section';

$lang['Holidays'] = 'Feiertage';
$lang['On_Holidays'] = 'Auf Ferien';
$lang['No_holidays_specify'] = 'Unbekannt';
// skype :: added :: start
$lang['SKYPE'] = 'Skype Messenger';
// skype :: added :: end
$lang['FDOW']	= 'Erster Tag der Woche'; // calendar fix
?>