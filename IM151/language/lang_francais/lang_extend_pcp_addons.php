<?php
/***************************************************************************
 *                  lang_extend_pcp_addons.php [English]
 *                  ------------------------------------
 *   begin            : 30/10/2003
 *   copyright         : Ptirhiik
 *   email            : ptirhiik@clanmckeen.com
 *
 *   version            : 1.0.0 - 30/10/2003
 *
 ***************************************************************************
 *
 *                        Customs lang key entries
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
   $lang['Lang_extend_pcp_addons'] = 'Add-ons pour le panneau de contrôle du profil';
}

// START - SEND PM ON REGISTER MOD - AbelaJohnB
$lang['register_pm_subject'] = 'Bienvenue sur %s !';
$lang['register_pm'] = 'Bonjour !<br /><br />Bienvenue sur %s. <br /><br />Nous espérons que vous serez intéressés par ce forum! <br /><br />Rejoignez cette communauté et partagez vos idées avec les autres ou commencez vos propres sujets de discussion. <br /><br />%s L\'administrateur du forum et son équipe';
// END - SEND PM ON REGISTER MOD - AbelaJohnB

$lang['PCP_topics_last'] = 'Sujets Récents';
$lang['PCP_topics_last_per_page'] = 'Nombre de sujets récents par page affichés sur la page d\'accueil';
$lang['PCP_topics_last_visit'] = 'Depuis votre dernière visite';

$lang['gal_pic_in'] = ' Photos dans ';
$lang['gal_pic'] = ' Photos';
$lang['user_photo'] = 'Photo dans votre profil publique';
$lang['user_photo_explain'] = 'Vous n\'avez pas sélectionné de photo de votre gallerie personnelle. Veuillez <a href="album_personal.php">envoyer une photo</a> aet la choisir dans <a href="profile.php?mode=profil">votre profil</a>';

$lang['country_explain'] 	= 'Choisissez le drapeau du pays qui sera affiché dans votre profil';
$lang['profil_country']		= 'Drapeau de votre pays de résidence';
$lang['profil_state']		= 'Drapeau du département';
$lang['state_explain'] = 'Choisissez le drapeau du département (province, région, etc) qui sera affiché dans votre profil';

$lang['Holidays'] = 'Vacances';
$lang['On_Holidays'] = 'En vacances';
$lang['No_holidays_specify'] = 'Inconnu';
// skype :: added :: start
$lang['SKYPE'] = 'Skype';
// skype :: added :: end

$lang['FDOW']	= 'Premier jour de la semaine'; // calendar fix
?>