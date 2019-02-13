<?php
/****************************************************************
 *      lang_extend_pcp_addons.php [Nederlands]
 *      ------------------------------------
 *  begin        : 30/10/2003
 *  copyright      : Ptirhiik
 *  email        : ptirhiik@clanmckeen.com
 *
 *  version        : 1.0.0 - 30/10/2003
 *
 *   Nederlandse vertaling  : Maart 2005
 *   The Dutch Team         : http://www.integramod.nl
 *
 *   note: removing the original copyright is illegal even you
 *         have modified the code. Just append yours if you
 *         have modified it.
 ****************************************************************/

/****************************************************************
 *
 *        Customs lang key entries
 ****************************************************************
 *
 *   This program is free software; you can redistribute it and/or
 *   modify it under the terms of the GNU General Public License as
 *   published by the Free Software Foundation; either version 2
 *   of the License, or (at your option) any later version.
 *
 ****************************************************************/

if ( !defined('IN_PHPBB') )
{
  die("Hacking attempt");
}

// admin part
if ( $lang_extend_admin )
{
  $lang['Lang_extend_pcp_addons'] = 'Add-ons voor Profiel-Controlepaneel';
}

// START - SEND PM ON REGISTER MOD - AbelaJohnB
$lang['register_pm_subject'] = 'Welkom bij %s';
$lang['register_pm'] = 'Hallo!<br /><br />Welkom bij %s. <br /><br />We hopen dat je je amuseert op deze site! <br /><br />Voel je vrij om mee te doen en dingen met anderen te delen of start je eigen discussie! <br /><br />~<br />%s Team ';
// END - SEND PM ON REGISTER MOD - AbelaJohnB

$lang['gallery'] = 'Gebruiker Album';
$lang['PCP_topics_last'] = 'Recente Onderwerpen';
$lang['PCP_topics_last_per_page'] = 'Aantal recente onderwerpen getoond per pagina op het home paneel';
$lang['PCP_topics_last_visit'] = 'Sinds je laatste bezoek';

$lang['gal_pic_in'] = ' Fotos in ';
$lang['gal_pic'] = ' Fotos';
$lang['Public_view_photo'] = 'Geef foto\'s weer';
$lang['user_photo'] = 'Foto in Publiek Profiel';
$lang['user_photo_explain'] = 'Je hebt geen foto geselecteerd uit je persoonlijke album.  <a href="album_personal.php">Upload een foto</a> en selecteer die in <a href="profile.php?mode=profil">je profiel</a>';
$lang['profilcp_photo_shortcut'] = ' Foto';

$lang['country_explain']   = 'Kies je land, en de vlag zal getoond worden in je profiel en onderwerpen sectie';
$lang['profil_country']    = 'Vlag van je land';
$lang['profil_state']    = 'Vlag van je staat/provincie';
$lang['state_explain']           = 'Kies je staat/provincie en de vlag zal getoond worden in je profiel en onderwerpen sectie';

$lang['Holidays'] = 'Vakantie';
$lang['On_Holidays'] = 'Op Vakantie';
$lang['No_holidays_specify'] = 'Onbekend';
// skype :: added :: start
$lang['SKYPE'] = 'Skype Messenger';
// skype :: added :: end

$lang['FDOW']  = 'Eerste dag van de week'; // calendar fix
?>