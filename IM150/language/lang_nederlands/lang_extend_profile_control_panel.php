<?php
/****************************************************************
 *		lang_extend_profile_control_panel.php [Nederlands]
 *		-----------------------------------------------
 *	begin				: 28/09/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 1.0.2 - 28/09/2003
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
	$lang['Lang_extend_profile_control_panel'] = 'Profiel Controle Paneel taal pakket';
}

// who's online
$lang['Admin_founder_online_color']		= '%sOprichter%s';
$lang['Jadmin_online_color']			= '%sJunior Beheerder%s';
$lang['User_online_color']			= '%sGebruiker%s';

// topic or privmsg display

$lang['Add_friend']					= 'vriend toevoegen';
$lang['Add_to_friend_list']			= 'Voeg toe aan je vriendenlijst';
$lang['Remove_friend']				= 'vriend verwijderen';
$lang['Remove_from_friend_list']	= 'Verwijder van je vriendenlijst';
$lang['Add_to_ignore_list']			= 'Voeg toe aan je negeerlijst';
$lang['Remove_from_ignore_list']		= 'Verwijder van je negeerlijst';
$lang['Happy_birthday']				= 'Van harte gefeliciteerd!';
$lang['Ignore_choosed']				= 'Je hebt ervoor gekozen deze gebruiker te negeren';
$lang['Online']					= 'Online';
$lang['Offline']				= 'Offline';
$lang['Hidden']					= 'Verborgen';
$lang['Gender']					= 'Geslacht';
$lang['Male']					= 'Mannelijk';
$lang['Female']					= 'Vrouwelijk';
$lang['No_gender_specify']			= 'Onbekend';
$lang['Age']					= 'Leeftijd';
$lang['Do_not_allow_pm']			= 'Deze gebruiker accepteert geen privé berichten';

// main entry (profile.php)
$lang['Click_return_profilcp']			= 'Klik %sHier%s om terug te gaan naar %s';

// birthday popup (profile_birthday.php)
$lang['Birthday']				= 'Geboortedatum';
$lang['birthday_msg']				= 'Hoi %s, <br /><br /><br /> %s wil je hartelijk feliciteren met je verjaardag!';

// home panel (profilcp_home.php)
$lang['profilcp_index_shortcut']		= 'Home';
$lang['profilcp_index_pagetitle']		= 'Persoonlijk profiel home';

// home panel : mini buddy list (functions_profile.php)
$lang['Friend_list']				= 'Vriendenlijst';
$lang['Friend_list_of']				= 'Vriend van';
$lang['Ignore_list']				= 'Negeerlijst';
$lang['Ignore_list_of']				= 'Genegeerd door';
$lang['Nobody']					= 'Niemand';
$lang['Always_visible']				= 'Altijd zichtbaar voor deze gebruiker';
$lang['Not_always_visible']			= 'Deze gebruiker ziet niet dat je online bent wanneer je in verborgen modus bent';

// home panel : watched topics (functions_profile.php)
$lang['Stop_watching_selected_topics']		= 'Geselecteerde niet meer volgen';
$lang['New_subscribed_topic']			= 'Aangemeld';
$lang['Submit_period']				= 'Onderwerpen vanaf';

// buddy list (profilcp_buddy.php)
$lang['profilcp_buddy_shortcut']		= 'Vrienden';
$lang['profilcp_buddy_pagetitle']		= 'Vriendenlijst';
$lang['profilcp_buddy_friend_shortcut']		= 'Vriendenlijst';
$lang['profilcp_buddy_friend_pagetitle']	= 'Bewerk je vriendenlijst';
$lang['profilcp_buddy_ignore_shortcut']		= 'Negeerlijst';
$lang['profilcp_buddy_ignore_pagetitle']	= 'Bewerk je negeerlijst';
$lang['profilcp_buddy_list_shortcut']		= 'Alle leden';
$lang['profilcp_buddy_list_pagetitle']		= 'Ledenlijst';
$lang['Click_return_privmsg']			= 'Klik %sHier%s om terug te gaan naar je privé berichten';
$lang['profilcp_buddy_could_not_add_user']	= 'De geselecteerde gebruiker bestaat niet.';
$lang['profilcp_buddy_could_not_anon_user']	= 'Gasten kunnen niet toegevoegd worden als buddy.';
$lang['profilcp_buddy_add_yourself']		= 'Je kunt jezelf niet toevoegen aan de buddy lijst';
$lang['profilcp_buddy_already']			= 'De gebruiker staat al in de buddy lijst';
$lang['profilcp_buddy_ignore']			= 'Toevoegen niet mogelijk i.v.m. instellingen van de gebruiker';
$lang['profilcp_buddy_you_admin']		= 'Als Beheerder of moderator kun je niemand negeren';
$lang['profilcp_buddy_admin']			= 'Je kunt geen Beheerders or moderators negeren';
$lang['User_fields']				= 'Lijst Gebruikers velden';
$lang['Friend']					= 'Vriend';
$lang['Comp_LE']				= 'is kleiner dan';
$lang['Comp_EQ']				= 'is gelijk aan';
$lang['Comp_NE']				= 'is niet gelijk aan';
$lang['Comp_GE']				= 'is groter dan';
$lang['Comp_IN']				= 'bevat';
$lang['Comp_NI']				= 'bevat niet';
$lang['Sort_none']				= 'Ongesorteerd';
$lang['date_entry']				= 'JJJJMMDD';

// update profile (profilcp_profil.php)
$lang['profilcp_profil_shortcut']		= 'Profiel';
$lang['profilcp_profil_pagetitle']		= 'Profiel Editie';
$lang['profilcp_prefer_shortcut']		= 'Jouw profiel';
$lang['profilcp_prefer_pagetitle']		= 'Profiel voorkeuren';
$lang['profilcp_signature_shortcut']		= 'Ondertekening';
$lang['profilcp_signature_pagetitle']		= 'Ondertekening';
$lang['profilcp_avatar_shortcut']		= 'Avatar';
$lang['profilcp_avatar_pagetitle']		= 'Avatar';
$lang['profilcp_digests_shortcut']			= 'Samenvattingen';
$lang['profilcp_digests_pagetitle']			= 'Samenvattingen';
// update profile : preferences - functions (mod_profile_control_panel.php)
$lang['Other']					= 'Overigen...';
$lang['Friend_only']				= 'Alleen vrienden';

// update profile : public informations : web info (mod_profile_control_public_web.php)
$lang['profilcp_profil_base_shortcut']		= 'Openbare informatie';
$lang['Web_info']				= 'Web informatie';

// update profile : public informations : real info (mod_profile_control_public_real.php)
$lang['Real_info']				= 'Persoonlijke informatie';
$lang['Realname']				= 'Echte naam';
$lang['Date_error']				= 'dag %d, maand %d, jaar %d is geen juiste datum';

// update profile : public informations : messengers info (mod_profile_control_public_messengers.php)
$lang['Messengers']				= 'Messengers';

// update profile : public informations : contact info (mod_profile_control_public_contact.php)
$lang['Home_phone']				= 'Telefoon thuis';
$lang['Home_fax']				= 'Fax thuis';
$lang['Work_phone']				= 'Telefoon werk';
$lang['Work_fax']				= 'Fax werk';
$lang['Cellular']				= 'Mobiel';
$lang['Pager']					= 'Pieper';

// update profile : preferences - preferences panel ("Your profile")
$lang['Profile_control_panel']			= 'Profiel instellingen';

// update profile : preferences - i18n panel (mod_profile_control_panel_international.php)
$lang['Profile_control_panel_i18n']		= 'Internationale gegevens';
$lang['summer_time']				= 'Is het zomertijd bij je ?';

// update profile : preferences - notification panel (mod_profile_control_panel_notification.php)
$lang['Profile_control_panel_notification']	= 'Notificatie';

// update profile : preferences - posting panel (mod_profile_control_panel_posting.php)
$lang['Profile_control_panel_posting']		= 'Berichten plaatsen';

// update profile : preferences - privacy panel (mod_profile_control_panel_privacy.php)
$lang['Profile_control_panel_privacy']		= 'Privé';
$lang['View_user']				= 'Geef me weer als online';
$lang['Public_view_pm']				= 'Accepteer privé berichten';
$lang['Public_view_website']			= 'Geef mijn web informatie weer';
$lang['Public_view_messengers']			= 'Geef mijn messengers informatie weer';
$lang['Public_view_real_info']			= 'Geef mijn persoonlijke informatie weer';

// update profile : preferences - reading panel (mod_profile_control_panel_reading.php)
$lang['Profile_control_panel_reading']		= 'Lezen';
$lang['Public_view_avatar']			= 'Geef avatars weer';
$lang['Public_view_sig']			= 'Geef ondertekeningen weer';
$lang['Public_view_img']			= 'Geef plaatjes weer';

// update profile : preferences - profile preferences
$lang['profile_prefer']				= 'Profiel opties';

// update profile : preferences - system panel (mod_profile_control_panel_system.php)
$lang['Profile_control_panel_system']		= 'Systeem';
$lang['summer_time_set']			= 'Is het nu zomertijd bij je ? (tel +1 uur op bij de lokale tijd)';
$lang['Forum_rules']				= 'Laat de regels zien tijdens het registreren';

// update profile : preferences - admin part (mod_profile_control_panel_admin.php)
$lang['profilcp_admin_shortcut']		= 'Administratie';
$lang['User_deleted']				= 'Gebruiker is succesvol verwijderd.';
$lang['User_special']				= 'Speciale Beheer-only velden';
$lang['User_special_explain']			= 'Deze velden kunnen niet door gebruikers aangepast worden. Hier kun je de status en overige opties instellen die de gebruikers niet hebben.';
$lang['User_status']				= 'De gebruiker is actief';
$lang['User_allow_email']			= 'Kan e-mail versturen';
$lang['User_allow_pm']				= 'Kan privé berichten versturen';
$lang['User_allow_website']			= 'Kan web info weergeven';
$lang['User_allow_messenger']			= 'Kan messengers gegevens weergeven';
$lang['User_allow_real']			= 'Kan persoonlijke informatie weergeven';
$lang['User_allowavatar']			= 'Kan avatar weergeven';
$lang['User_allow_sig']				= 'Kan ondertekening weergeven';
$lang['Rank_title']				= 'Rank titel';
$lang['User_delete']				= 'Verwijder deze gebruiker';
$lang['User_delete_explain']			= 'Klik hier om deze gebruiker te verwijderen; dit kan NIET ongedaan worden gemaakt.';
$lang['No_assigned_rank']			= 'Geen speciale rank';
$lang['User_self_delete']			= 'Je kunt je account verwijderen wanneer je board administrator bent!';

// update profile : signature (profilcp_profile_signature.php)
$lang['profilcp_sig_preview']			= 'Preview ondertekening';

// display profile (profilcp_public.php)
$lang['profilcp_public_shortcut']		= 'Openbaar';
$lang['profilcp_public_pagetitle']		= 'Openbaar weergeven';
$lang['profilcp_public_base_shortcut']		= 'Algemene info';
$lang['profilcp_public_base_pagetitle']		= 'Algemene Profiel informatie';
$lang['profilcp_public_groups_shortcut']	= 'Groepen';
$lang['profilcp_public_groups_pagetitle']	= 'Groepen waar deze gebruiker lid van is';

// update profile : preferences - home panel (mod_profile_control_panel_home.php)
$lang['Profile_control_panel_home']		= 'Profiel Home paneel';
$lang['Profile_control_panel_home_buddy']	= 'Buddy lijst';
$lang['Buddy_friend_display']			= 'Geef mijn vriendenlijst weer op het paneel';
$lang['Buddy_ignore_display']			= 'Geef mijn negeerlijst weer op het paneel';
$lang['Buddy_friend_of_display']		= 'Geef "Vriend van"-lijst weer op het paneel';
$lang['Buddy_ignored_by_display']		= 'Geef "Genegeerd door"-lijst weer op het paneel';

$lang['Profile_control_panel_home_privmsg']	= 'Privé berichten';
$lang['Privmsgs_per_page']			= 'Aantal privé berichten die per pagina worden weergegeven op het paneel';

$lang['Profile_control_panel_home_wtopics']	= 'Bekeken onderwerpen';
$lang['Watched_topics_per_page']		= 'Aantal bekeken onderwerpen per pagina weergegeven op het paneel';

// display profile : base info (profilcp_public_base.php)
$lang['Unavailable']				= 'Niet beschikbaar';
$lang['Last_visit']				= 'Laatste bezoek';
$lang['User_pics']				= 'Ge-uploade afbeeldingen';
$lang['User_post_stats']			= '%s berichten, %.2f%% van totaal, %.2f berichten per dag';
$lang['User_posts']				= 'Berichten van gebruiker';
$lang['Most_active_topic']			= 'Meest actieve onderwerpen';
$lang['Most_active_topic_stat']			= '%s berichten, %.2f%% van het onderwerp, %.2f%% van het forum';
$lang['Most_active_forum']			= 'Meest actieve forum';
$lang['Most_active_forum_stat']			= '%s berichten, %.2f%% van het forum, %.2f%% van het totaal';

// register (profilcp_register.php)
$lang['profilcp_register_shortcut']		= 'Registratie';
$lang['profilcp_register_pagetitle']		= 'Registratie informatie';
$lang['profilcp_email_title']			= 'Email adres';
$lang['profilcp_email_confirm']			= 'Bevestig je Email adres';
$lang['anti_robotic']				= 'Controle plaatje';
$lang['anti_robotic_explain']			= 'Deze controle is ontworpen om spam tegen te gaan';
$lang['profilcp_password_explain']		= 'Je moet je huidige wachtwoord bevestigen als je het wilt wijzigen';
$lang['Agree_rules']				= 'Door dit vakje aan te vinken, verklaar je de voorwaarden te hebben gelezen en er akkoord mee te gaan';
$lang['profilcp_username_missing']		= 'Gebruikersnaam ontbreekt';
$lang['profilcp_email_not_matching']		= 'Email adressen komen niet overeen';
$lang['Robot_flood_control']			= 'Wat je hebt ingevoerd komt niet overeen met het controle plaatje';
$lang['Disagree_rules']				= 'Je gaat niet akkoord met de voorwaarden. Je kunt je daarom niet registreren.';

$lang['Always_set_bm'] 				= 'Stel automatisch een bookmark in bij het plaatsen van een bericht';

// PCP Extra :: Added :: Start
$lang['Required_Error'] 			= 'Het Veld "%s" is verplicht';
$lang['Required_field'] 			= '&nbsp;<font color=red>*</font>';
$lang['Required_explain'] 			= '&nbsp;<font color=red>*</font> = verplicht veld.';
$lang['Email_confirm'] 				= 'Wanneer je je email adres wijzigt, moet je je account opnieuw activeren, door middel van de link die naar je nieuwe Email adres wordt gestuurd.';
$lang['Email_confirm_admin'] 			= 'Wanneer je je email adres wijzigt, moet de administrator je account weer activeren.';
$lang['Email_confirm_guest'] 			= 'Er zal een email worden verstuurd naar dit adres om je account te kunnen activeren.';
$lang['Email_confirm_guest_admin'] 		= 'Je zult op dit adres geïnformeerd worden wanneer je account geactiveerd is door de administrator.';
$lang['Visible_friends'] 			= '<br><i>(alleen voor vrienden zichtbaar)</i>';
$lang['Visible_all'] 				= '<br><i>(voor alle gebruikers zichtbaar)</i>';
$lang['Visible_admin'] 				= '<br><i>(alleen voor administrators zichtbaar)</i>';
$lang['Visible_board_email_all'] 		= '<br><i>(emails zijn altijd verborgen en alle gebruikers kunnen je een email zenden via het bord)</i>';
$lang['Visible_board_email_friends'] 		= '<br><i>(emails zijn altijd verborgen en alleen vrienden kunnen je een email zenden via het bord)</i>';
$lang['Preferences'] 				= 'Voorkeuren';
$lang['Privmsgs'] 				= 'Prive Berichten';
$lang['Buttons'] 				= 'Knoppen';
$lang['Left'] 					= 'Links';
$lang['Viewtopic'] 				= 'Bekijk Onderwerp';
// PCP Extra :: Added :: End
// Digests PCP :: Added :: Start
$lang['profilcp_digests_shortcut']		= 'Samenvattingen';
$lang['profilcp_digests_pagetitle']		= 'Samenvattingen';
// Digests PCP :: Added :: End
// Warning PCP :: Added :: Start
$lang['Warnings'] 				= 'Gele Kaarten: %d'; //wordt getoond naast berichten van gebruiker, wanneer hij/zij een waarschuwing heeft gehad
$lang['user_warnings'] = 'Gele Kaarten'; // field label
$lang['Banned'] 				= 'Momenteel gebanned';//wordt getoond naast berichten van gebruiker, wanneer hij/zij gebanned is
// Warning PCP :: Added :: End
// Auto Summer time :: Added :: Start 
$lang['summer_time_auto_set'] 			= 'Automatisch zomertijd aanpassen?'; 
// Auto Summer time :: Added :: End 
//  Mini Cal PCP :: Added :: Start
$lang['mini_cal_version_mycal'] 		= 'MyCalendar';
$lang['mini_cal_version_plus'] 			= 'MyCalendar+';
$lang['mini_cal_version_topic'] 		= 'Topic Calendar';
$lang['mini_cal_version_snail'] 		= 'Websnail Calendar Pro';
$lang['mini_cal_version_snaillite'] 		= 'Websnail Calendar Lite';
$lang['mini_cal_version_none'] 			= 'Geen ondersteunde kalender geinstalleerd';
$lang['mini_cal_calendar_version'] 		= 'Mini Kalender Versie'; 
$lang['mini_cal_calendar_version_explain'] 	= 'Geef aan welke evenementen Kalender je gebruikt, als er 1 is.'; 
$lang['mini_cal_limit'] 			= 'Mini Kalender Bereik'; 
$lang['mini_cal_limit_explain'] 		= 'Limiteer het aantal evenementen dat weergegeven moet worden in de mini kalender. Alleen voor evenementen kalenders!'; 
$lang['mini_cal_days_ahead'] 			= 'Mini Kalender aantal dagen vooruit'; 
$lang['mini_cal_days_ahead_explain'] 		= 'Zet een limiet van hoeveel dagen vooruit in welke tijd de aankomende evenementen moeten weergegeven worden. Zet op 0 (nul) voor oneindig. Alleen voor evenementen Kalenders!'; 
$lang['mini_cal_search_posts'] 			= 'Zoek naar berichten'; 
$lang['mini_cal_search_events'] 		= 'Zoek naar evenementen'; 
$lang['mini_cal_date_search'] 			= 'Mini Kalender Datum Zoeken'; 
$lang['mini_cal_date_search_explain'] 		= 'Definieer welke zoekfunctie er gebruikt wordt wanneer een gebruiker op een datum in de kalender klikt. "Zoeken naar evenementen" is alleen voor evenementen Kalenders!'; 
$lang['mini_cal_fdow'] 				= 'Mini Kalender FDOW'; 
$lang['mini_cal_fdow_explain'] 			= 'Eerste dag van de week - 0=Zondag, 1=Maandag...6=Zaterdag.'; 
$lang['mini_cal_link_class'] 			= 'Mini Kalender Link Klasse'; 
$lang['mini_cal_link_class_explain'] 		= 'Definieer de css klasse om te gebruiken voor de mini kalender dagen links.'; 
$lang['mini_cal_today_class'] 			= 'Mini Kalender Vandaag Klasse'; 
$lang['mini_cal_today_class_explain'] 		= 'Definieer de css klasse om te gebruiken voor de mini kalender vandaag datum.'; 
$lang['mini_cal_auth'] = 'Mini Cal Auth';
$lang['mini_cal_auth_explain'] = 'defines the authentication level required to be able to view the upcoming events. This relates to the permission level assigned to forum.';
//  Mini Cal PCP :: Added :: End 
// signature control
$lang['sig_yes_not_controled'] = 'Ja NIET gecontroleerd';
$lang['sig_yes_controled'] = 'Ja gecontroleerd';
// right click
$lang['Extra_priv_explain'] ='Laat gebruiker toe om te kopïeren en rechts te klikken';
// phpbb security admin
$lang['Force_security'] ='Force Security';
$lang['Force_security_explain'] ='Check this box and the user will be forced to re-activate his acount using the security question and answer.';
$lang['Reset_security'] ='Reset Security';
$lang['Reset_security_explain'] ='Check this box if the user locked himself out by mistyping his password too many times. This will reset the counter to 0.';
$lang['Clear_security'] ='Clear Security';
$lang['Clear_security_explain'] ='Check this box and the security question and answer of this user will be reset. The user will NOT be able to browse the forums untill he/she re-enters them.';
?>