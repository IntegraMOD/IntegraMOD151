<?php
/****************************************************************
 *                            lang_main.php [Nederlands]
 *                              -------------------
 *     begin                : Sat Dec 16 2000
 *     copyright            : (C) 2001 The phpBB Group
 *     email                : support@phpbb.com
 *
 *   Nederlandse vertaling  : Maart 2005
 *   The Dutch Team         : http://www.integramod.nl
 *
 *   note: removing the original copyright is illegal even you
 *         have modified the code. Just append yours if you
 *         have modified it.
 ***************************************************************/

/****************************************************************
 *
 *   This program is free software; you can redistribute it and/or
 *   modify it under the terms of the GNU General Public License as
 *   published by the Free Software Foundation; either version 2
 *   of the License, or (at your option) any later version.
 *
 ***************************************************************/

//
// CONTRIBUTORS:
//   Add your details here if wanted, e.g. Name, username, email address, website
// 2002-08-27  Philip M. White        - fixed many grammar problems
//

//
// The format of this file is ---> $lang['message'] = 'text';
//
// You should also try to set a locale and a character encoding (plus direction). The encoding and direction
// will be sent to the template. The locale may or may not work, it's dependent on OS support and the syntax
// varies ... give it your best guess!
//

$lang['ENCODING'] = 'utf-8';
$lang['DIRECTION'] = 'ltr';
$lang['LEFT'] = 'links';
$lang['CENTER'] = 'center';
$lang['RIGHT'] = 'rechts';
$lang['DATE_FORMAT'] =  'd M,  Y'; // This should be changed to the default date format for your language, php date() format
$lang['Ignore'] = 'Negeren';

// This is optional, if you would like a _SHORT_ message output
// along with our copyright message indicating you are the translator
// please add it here.
$lang['TRANSLATION_INFO'] = ' <br /><font style="font-size: 10px; color: #ec7600">Vertaling: <a href="http://www.integramod.nl">The Dutch Team</a></font>';

//
// Common, these terms are used
// extensively on several pages
//
$lang['Admin_short'] = 'Administratie';
$lang['Forum'] = 'Forums';
$lang['Category'] = 'Categorie';
$lang['Topic'] = 'Onderwerp';
$lang['Topics'] = 'Onderwerpen';
$lang['Replies'] = 'Reacties';
$lang['Views'] = 'Bekeken';
$lang['Post'] = 'Bericht';
$lang['Posts'] = 'Berichten';
$lang['Posted'] = 'Geplaatst';
$lang['Username'] = 'Gebruikersnaam';
$lang['Password'] = 'Wachtwoord';
$lang['Email'] = 'E-mail';
$lang['Poster'] = 'Plaatser';
$lang['Author'] = 'Auteur';
$lang['Time'] = 'Tijd';
$lang['Hours'] = 'Uren';
$lang['Message'] = 'Bericht';

$lang['1_Day'] = '1 Dag';
$lang['7_Days'] = '7 Dagen';
$lang['2_Weeks'] = '2 Weken';
$lang['1_Month'] = '1 Maand';
$lang['3_Months'] = '3 Maanden';
$lang['6_Months'] = '6 Maanden';
$lang['1_Year'] = '1 Jaar';

$lang['Go'] = 'Ok';
$lang['Jump_to'] = 'Ga naar';
$lang['Submit'] = 'Verzenden';
$lang['Reset'] = 'Opnieuw';
$lang['Cancel'] = 'Annuleren';
$lang['Preview'] = 'Voorbeeld';
$lang['Confirm'] = 'Bevestig';
$lang['Spellcheck'] = 'Spellingcontrole';
$lang['Yes'] = 'Ja';
$lang['No'] = 'Nee';
$lang['Enabled'] = 'Ingeschakeld';
$lang['Disabled'] = 'Uitgeschakeld';
$lang['Error'] = 'Fout';

$lang['Next'] = 'Volgende';
$lang['Previous'] = 'Vorige';
$lang['Goto_page'] = 'Ga naar pagina';
$lang['Joined'] = 'Geregistreerd';
$lang['IP_Address'] = 'IP Adres';

$lang['Select_forum'] = 'Selecteer een forum';
$lang['View_latest_post'] = 'Bekijk laatste berichten';
$lang['View_newest_post'] = 'Bekijk nieuwste berichten';
$lang['Page_of'] = 'Pagina <b>%d</b> van <b>%d</b>'; // Replaces with: Page 1 of 2 for example

$lang['ICQ'] = 'ICQ Nummer';
$lang['AIM'] = 'AIM Adres';
$lang['MSNM'] = 'MSN Messenger';
$lang['YIM'] = 'Yahoo Messenger';

$lang['Forum_Index'] = '%s Forum Index';  // eg. sitename Forum Index, %s can be removed if you prefer

$lang['Post_new_topic'] = 'Plaats een nieuw bericht';
$lang['Reply_to_topic'] = 'Beantwoord dit bericht';
$lang['Reply_with_quote'] = 'Beantwoorden met Citaat';

$lang['Click_return_topic'] = 'Terug naar je onderwerp %sKlik hier%s'; // %s's here are for uris, do not remove!
$lang['Click_return_login'] = 'Opnieuw proberen %sKlik hier%s';
$lang['Click_return_forum'] = 'Terug naar het forum %sKlik hier%s ';
$lang['Click_view_message'] = 'Je bericht opnieuw bekijken %sKlik hier%s';
$lang['Click_return_modcp'] = 'Terug naar het Moderator Controle Paneel %sKlik hier%s';
$lang['Click_return_group'] = 'Terug naar groep informatie %sKlik hier%s';

$lang['Admin_panel'] = 'Beheerders Paneel';

$lang['Board_disable'] = 'Sorry, dit deel van de site is op dit moment niet beschikbaar. Probeer het later nog eens.';
$lang['View_post'] = 'Bekijk Bericht';
$lang['Acronym'] = 'Acroniem';

$lang['Total_votes'] = 'Aantal stemmen: ';
$lang['Voted_show'] = 'Gestemd: '; // it means :  users that voted  (the number of voters will follow)
$lang['Results_after'] = 'Het resultaat zal bekeken kunnen worden wanneer de opiniepeiling afgelopen is.';
$lang['Poll_expires'] = 'Opiniepeiling verloopt over: ';
$lang['Minutes'] = 'Minuten';
$lang['Max_vote'] = 'Maximum keuze';
$lang['Max_vote_explain'] = '[ Vul 1 in of laat leeg, om 1 keuze toe te staan ]';
$lang['Max_voting_1_explain'] = 'Selecteer alleen ';
$lang['Max_voting_2_explain'] = ' antwoorden';
$lang['Max_voting_3_explain'] = ' (keuze boven limiet wordt genegeerd)';
$lang['Vhide'] = 'Verbergen';
$lang['Hide_vote'] = 'Resultaat';
$lang['Tothide_vote'] = 'Som van stemmen';
$lang['Hide_vote_explain'] = '[ Verbergen tot opiniepeiling verloopt ]';

//
// Global Header strings
//
$lang['Day_users'] = 'There have been %d registered users online in the last %d hours:';
$lang['Not_day_users'] = '%d registered users <span style="color:red">Didn\'t</span> visit during the last %d hours:'; 

$lang['Registered_users'] = 'Geregistreerde gebruikers:';
$lang['Browsing_forum'] = 'Gebruikers actief op dit forum:';
$lang['Online_users_zero_total'] = 'Totaal zijn er <b>0</b> gebruikers online :: ';
$lang['Online_users_total'] = 'Totaal zijn er <b>%d</b> gebruikers online :: ';
$lang['Online_user_total'] = 'Totaal zijn er <b>%d</b> gebruikers online :: ';
$lang['Reg_users_zero_total'] = '0 Geregistreerd, ';
$lang['Reg_users_total'] = '%d Geregistreerde, ';
$lang['Reg_user_total'] = '%d Geregistreerd, ';
$lang['Hidden_users_zero_total'] = '0 Verborgen en ';
$lang['Hidden_user_total'] = '%d Verborgen en ';
$lang['Hidden_users_total'] = '%d Verborgen en ';
$lang['Guest_users_zero_total'] = '0 Gasten';
$lang['Guest_users_total'] = '%d Gasten';
$lang['Guest_user_total'] = '%d Gast';
$lang['Record_online_users'] = 'Hoogste aantal online was <b>%s</b> op %s '; // first %s = number of users, second %s is the date.

$lang['Admin_online_color'] = '%sBeheerder%s';
$lang['Mod_online_color'] = '%sModerator%s';

$lang['You_last_visit'] = 'Je laatste bezoek was %s'; // %s replaced by date/time
$lang['Current_time'] = 'Het is nu %s '; // %s replaced by time

$lang['Search_new'] = 'Bekijk de berichten sinds je laatste bezoek';
$lang['Search_your_posts'] = 'Bekijk je berichten';
$lang['Search_unanswered'] = 'Bekijk onbeantwoorde berichten';

$lang['Register'] = 'Aanmelden';
$lang['Profile'] = 'Profiel';
$lang['Edit_profile'] = 'Profiel bewerken';
$lang['Search'] = 'Zoeken';
$lang['Memberlist'] = 'Gebruikerslijst';
$lang['FAQ'] = 'FAQ';
$lang['KB_title'] = 'Kennis Bank';
$lang['BBCode_guide'] = 'BBCode gids';
$lang['Usergroups'] = 'Gebruikersgroepen';
$lang['Last_Post'] = 'Laatste';
$lang['Moderator'] = 'Moderator';
$lang['Moderators'] = 'Moderators';


//
// Stats block text
//
$lang['Posted_articles_zero_total'] = 'Onze gebruikers hebben totaal <b>0</b> berichten geplaatst'; // Number of posts
$lang['Posted_articles_total'] = 'Onze gebruikers hebben totaal <b>%d</b> berichten geplaatst'; // Number of posts
$lang['Posted_article_total'] = 'Onze gebruikers hebben totaal <b>%d</b> berichten geplaatst'; // Number of posts
$lang['Registered_users_zero_total'] = 'Er zijn <b>0</b> geregistreerde gebruikers'; // # registered users
$lang['Registered_users_total'] = 'Er zijn <b>%d</b> geregistreerde gebruikers'; // # registered users
$lang['Registered_user_total'] = 'Er is <b>%d</b> geregistreerde gebruiker'; // # registered users
$lang['Newest_user'] = 'Nieuwste geregistreerde gebruiker is <b>%s%s%s</b>'; // a href, username, /a

$lang['No_new_posts_last_visit'] = 'Geen nieuwe berichten sinds je vorige bezoek';
$lang['No_new_posts'] = 'Geen nieuwe berichten';
$lang['New_posts'] = 'Nieuwe berichten';
$lang['New_post'] = 'Nieuw bericht';
$lang['No_new_posts_hot'] = 'Geen nieuwe berichten [Populair]';
$lang['New_posts_hot'] = 'Nieuwe berichten [Populair]';
$lang['No_new_posts_locked'] = 'Geen nieuwe berichten [Gesloten]';
$lang['New_posts_locked'] = 'Nieuwe berichten [Gesloten]';
$lang['Forum_is_locked'] = 'Forum is Gesloten';
$lang['Posted'] = 'You have posted in this forum';


//
// Login
//
$lang['Enter_password'] = 'Vul je Gebruikersnaam en Wachtwoord in om in te loggen.';
$lang['Login'] = 'Inloggen';
$lang['Logout'] = 'Uitloggen';

$lang['Forgotten_password'] = 'Ik ben mijn Wachtwoord vergeten';

$lang['Log_me_in'] = 'Automatisch inloggen';

$lang['Error_login'] = 'Je hebt je gebruikersnaam of wachtwoord niet goed ingevuld (of je account is niet geactiveerd)';


//
// Index page
//
$lang['Index'] = 'Index';
$lang['No_Posts'] = 'Geen Berichten';
$lang['No_forums'] = 'Deze site heeft geen forum\'s';

$lang['Private_Message'] = 'Priv&eacute; Bericht';
$lang['Private_Messages'] = 'Priv&eacute; Berichten';
$lang['Who_is_Online'] = 'Wie is Online';

$lang['Go_to_Top'] ='Go to top';
$lang['Go_to_Bottom'] = 'Go to bottom';

$lang['Mark_all_forums'] = 'Markeer alle forum\'s als gelezen';
$lang['Forums_marked_read'] = 'Alle forum\'s zijn nu gemarkeerd als gelezen';


//
// Viewforum
//
$lang['Topic_Announcement'] = '<b>[ Aankondiging ]</b>';
$lang['Topic_Sticky'] = '<b>[ Sticky ]</b>';
$lang['Topic_Moved'] = '<b>[ Verplaatst ]</b>';
$lang['Topic_Poll'] = '<b>[ Opiniepeiling ]</b>';

//
// Viewtopic
//

$lang['Guest'] = 'Gast';
$lang['Post_subject'] = 'Onderwerp';
$lang['Submit_vote'] = 'Stemmen';
$lang['View_results'] = 'Bekijk Resultaat';
$lang['View_Topic'] = 'Bekijk Onderwerp';

$lang['No_newer_topics'] = 'Er zijn geen nieuwere onderwerpen in dit forum';
$lang['No_older_topics'] = 'Er zijn geen oudere onderwerpen';
$lang['Topic_post_not_exist'] = 'Sorry het onderwerp of bericht dat je zoekt bestaat niet';
$lang['No_posts_topic'] = 'Er zijn geen berichten in dit onderwerp';

$lang['Display_posts'] = 'Vorige Berichten';
$lang['All_Posts'] = 'Alle berichten';
$lang['Newest_First'] = 'Nieuwste Eerst';
$lang['Oldest_First'] = 'Oudste Eerst';

$lang['Back_to_top'] = 'Terug naar boven';

$lang['Read_profile'] = 'Bekijk gebruiker\'s profiel';
$lang['Send_email'] = 'Stuur een e-mail naar de gebruiker';
$lang['Visit_website'] = 'Bezoek de website van deze gebruiker ';
$lang['ICQ_status'] = 'ICQ Status';
$lang['Edit_delete_post'] = 'Bericht Bewerken';
$lang['View_IP'] = 'Bekijk IP adres van plaatser';
$lang['Delete_post'] = 'Bericht Verwijderen';

$lang['wrote'] = 'Schreef'; // proceeds the username and is followed by the quoted text
$lang['Quote'] = 'Citaat'; // comes before bbcode quote output.
$lang['Code'] = 'Code'; // comes before bbcode code output.
$lang['PHPCode'] = 'PHP'; // PHP MOD

$lang['Edited_time_total'] = 'Laatste wijziging gemaakt door %s op %s; gewijzigd: %d keer totaal'; // Last edited by me on 12 Oct 2001; edited 1 time in total
$lang['Edited_times_total'] = 'Laatste wijziging gemaakt door %s op %s; gewijzigd: %d keer totaal'; // Last edited by me on 12 Oct 2001; edited 2 times in total

//
// Posting/Replying (Not private messaging!)
//
$lang['Message_body'] = 'Bericht';

$lang['Options'] = 'Opties';

$lang['Post_Announcement'] = 'Aankondiging';
$lang['Post_Sticky'] = 'Sticky';

$lang['Flood_Error'] = 'Je kunt niet zo snel achter elkaar berichten plaatsen, probeer het over enkele ogenblikken nog keer.';
$lang['Empty_subject'] = 'Je moet een onderwerp invullen, wanneer je een nieuw bericht wilt plaatsen.';
$lang['Empty_message'] = 'Je hebt geen tekst in het bericht ingevoerd, het bericht is leeg.';
$lang['Forum_locked'] = 'Dit forum is gesloten: je kunt geen berichten plaatsen, bewerken of beantwoorden.';
$lang['Topic_locked'] = 'Dit onderwerp is gesloten: je kunt berichten niet bewerken of beantwoorden.';

$lang['Button_locked'] = 'Gesloten';

$lang['No_post_id'] = 'Selecteer een bericht om te bewerken';
$lang['Edit_own_posts'] = 'Sorry, Je kunt alleen je eigen berichten bewerken.';
$lang['Empty_poll_title'] = 'Je moet een titel voor het Opiniepeiling opgeven.';
$lang['To_few_poll_options'] = 'Er zijn Minimaal 2 opties nodig voor een Opiniepeiling.';
$lang['To_many_poll_options'] = 'Je hebt te veel opties in het Opiniepeiling.';

$lang['Update'] = 'Wijzig';
$lang['Delete'] = 'Verwijder';
$lang['Days'] = 'Dagen'; // This is used for the Run poll for ... Days + in admin_forums for pruning

$lang['HTML_is_ON'] = 'HTML is <u>AAN</u>';
$lang['HTML_is_OFF'] = 'HTML is <u>UIT</u>';
$lang['BBCode_is_ON'] = '%sBBCode%s is <u>AAN</u>'; // %s are replaced with URI pointing to FAQ
$lang['BBCode_is_OFF'] = '%sBBCode%s is <u>UIT</u>';
$lang['Smilies_are_ON'] = 'Smilies zijn <u>AAN</u>';
$lang['Smilies_are_OFF'] = 'Smilies zijn <u>UIT</u>';

$lang['Attach_signature'] = 'Ondertekening invoegen (kun je aanmaken of wijzigen in je profiel)';
$lang['Delete_post'] = 'Verwijder dit bericht';

$lang['Stored'] = 'Je bericht is opgeslagen.';
$lang['Deleted'] = 'Je bericht is verwijderd.';
$lang['Poll_delete'] = 'Je Opiniepeiling is verwijderd.';
$lang['Vote_cast'] = 'Je stem is verwerkt.';

$lang['Topic_reply_notification'] = 'Reactie op Onderwerp notificatie';

$lang['bbcode_b_help'] = 'Vette tekst: [b]tekst[/b]  (alt+b)';
$lang['bbcode_i_help'] = 'Schuine tekst: [i]tekst[/i]  (alt+i)';
$lang['bbcode_u_help'] = 'Onderstreepte tekst: [u]tekst[/u]  (alt+u)';
$lang['bbcode_q_help'] = 'Citaat tekst: [quote]tekst[/quote]  (alt+q)';
$lang['bbcode_c_help'] = 'Code tonen: [code]code[/code]  (alt+c)';
$lang['bbcode_l_help'] = 'Lijst: [list]tekst[/list] (alt+l)';
$lang['bbcode_o_help'] = 'Geordende lijst: [list=]tekst[/list]  (alt+o)';
$lang['bbcode_p_help'] = 'Foto invoegen: [img( | =left | =right )]http://image_url[/img]  (alt+p)';
$lang['bbcode_w_help'] = 'URL invoegen: [url]http://url[/url] of [url=http://url]URL tekst[/url]  (alt+w)';
$lang['bbcode_a_help'] = 'Sluit alle open bbCode tags';
$lang['bbcode_s_help'] = 'Tekstkleur: [color=red]tekst[/color]  Tip: je kunt ook color=#FF0000 gebruiken';
$lang['bbcode_f_help'] = 'Tekstgrote: [size=x-small]kleine tekst[/size]';

$lang['Emoticons'] = 'Emoticons - Smilies';
$lang['More_emoticons'] = 'Bekijk meer Emoticons';

$lang['Font_color'] = 'Tekst kleur';
$lang['color_default'] = 'Standaard';
$lang['color_dark_red'] = 'Donker Rood';
$lang['color_red'] = 'Rood';
$lang['color_orange'] = 'Oranje';
$lang['color_brown'] = 'Bruin';
$lang['color_yellow'] = 'Geel';
$lang['color_green'] = 'Groen';
$lang['color_olive'] = 'Olijf';
$lang['color_cyan'] = 'Cyaan';
$lang['color_blue'] = 'Blauw';
$lang['color_dark_blue'] = 'Donker Blauw';
$lang['color_indigo'] = 'Indigo';
$lang['color_violet'] = 'Violet';
$lang['color_white'] = 'Wit';
$lang['color_black'] = 'Zwart';

$lang['Font_size'] = 'Tekst grote';
$lang['font_tiny'] = 'Erg klein';
$lang['font_small'] = 'Klein';
$lang['font_normal'] = 'Normaal';
$lang['font_large'] = 'Groot';
$lang['font_huge'] = 'Super groot';

$lang['Close_Tags'] = 'Sluit Tags';
$lang['Styles_tip'] = 'Tip: Stijlen kun je het gemakkelijkst aanpassen als je de tekst eerst selecteert.';


//
// Private Messaging
//
$lang['Private_Messaging'] = 'Priv&eacute; Berichten';

$lang['Login_check_pm'] = 'Controleer je PB';
$lang['New_pms'] = '<b>%d NIEUWE berichten</b>'; // You have 2 new messages
$lang['New_pm'] = '<b>%d NIEUW bericht</b>'; // You have 1 new message
$lang['No_new_pm'] = 'Geen nieuwe Priv&eacute; Berichten';
$lang['Unread_pms'] = '%d Ongelezen berichten';
$lang['Unread_pm'] = '%d Ongelezen bericht';
$lang['No_unread_pm'] = 'Geen ongelezen berichten';
$lang['You_new_pm'] = 'Een nieuw Priv&eacute; Bericht in je Inbox';
$lang['You_new_pms'] = 'Nieuwe Priv&eacute; Berichten in je Inbox';
$lang['You_no_new_pm'] = 'Geen nieuwe Priv&eacute; Berichten voor je';

$lang['Unread_message'] = 'Ongelezen bericht';
$lang['Read_message'] = 'Gelezen bericht';

$lang['Read_pm'] = 'Gelezen berichten';
$lang['Post_new_pm'] = 'Maak een PB';
$lang['Post_reply_pm'] = 'Beantwoord met PB';
$lang['Post_quote_pm'] = 'Citeer PB';
$lang['Edit_pm'] = 'PB aanpassen';

$lang['Inbox'] = 'Inbox';
$lang['Outbox'] = 'Uitbox';
$lang['Savebox'] = 'Opgeslagen';
$lang['Sentbox'] = 'Verzonden';
$lang['Flag'] = 'Vlag';
$lang['Subject'] = 'Onderwerp';
$lang['From'] = 'Afzender';
$lang['To'] = 'Aan';
$lang['Date'] = 'Datum';
$lang['Mark'] = 'Markeer';
$lang['Sent'] = 'Verzenden';
$lang['Saved'] = 'Opgeslagen';
$lang['Delete_marked'] = 'Verwijder gemarkeerde';
$lang['Delete_all'] = 'Verwijder Alles';
$lang['Save_marked'] = 'Gemarkeerde Opslaan';
$lang['Save_message'] = 'Bericht opslaan';
$lang['Delete_message'] = 'Verwijder Bericht';

$lang['Display_messages'] = 'Bekijk vorige berichten'; // Followed by number of days/weeks/months
$lang['All_Messages'] = 'Alle berichten';

$lang['No_messages_folder'] = 'Je hebt geen berichten in deze map';

$lang['PM_disabled'] = 'Het maken van Priv&eacute; Berichten is uitgeschakeld voor deze site.';
$lang['Cannot_send_privmsg'] = 'Sorry, je kunt geen Priv&eacute; Berichten versturen, dit is door een Beheerder uitgeschakeld.';
$lang['No_to_user'] = 'Je moet een gebruikersnaam invullen aan wie je dit bericht wilt sturen.';
$lang['No_such_user'] = 'Sorry, deze gebruiker bestaat niet.';

$lang['Disable_HTML_pm'] = 'HTML Uitschakelen in dit bericht';
$lang['Disable_BBCode_pm'] = 'BBCode Uitschakelen in dit bericht';
$lang['Disable_Smilies_pm'] = 'Smilies Uitschakelen in dit bericht';

$lang['Message_sent'] = 'Je bericht is verstuurd.';

$lang['Click_return_inbox'] = 'Terug naar je Inbox %sKlik hier%s ';
$lang['Click_return_index'] = 'Terug naar de Index %sKlik hier%s ';

$lang['Send_a_new_message'] = 'Stuur een nieuw Priv&eacute; Bericht';
$lang['Send_a_reply'] = 'Beantwoord Priv&eacute; Bericht';
$lang['Edit_message'] = 'Het Priv&eacute; Bericht bewerken';

$lang['Notification_subject'] = 'Er is een Nieuw bericht!';

$lang['Find_username'] = 'Zoek gebruikersnaam';
$lang['Find'] = 'Zoek';
$lang['No_match'] = 'Geen overeenkomsten gevonden.';

$lang['No_post_id'] = 'geen post ID was ingevuld';
$lang['No_such_folder'] = 'Deze map bestaat niet';
$lang['No_folder'] = 'Geen map aangegeven';

$lang['Mark_all'] = 'Markeer alles';
$lang['Unmark_all'] = 'Demarkeer alles';

$lang['Confirm_delete_pm'] = 'Weet je zeker dat je dit bericht wilt verwijderen?';
$lang['Confirm_delete_pms'] = 'Weet je zeker dat je deze berichten wilt te verwijderen?';

$lang['Inbox_size'] = 'Je INBOX is voor %d%% gevuld'; // eg. Your Inbox is 50% full
$lang['Sentbox_size'] = 'Je VERZONDEN berichten map is voor %d%% gevuld';
$lang['Savebox_size'] = 'Je OPGESLAGEN berichten map is voor %d%% gevuld';

$lang['Click_view_privmsg'] = 'Open je INBOX %sKlik hier%s';


//
// Profiles/Registration
//
$lang['Viewing_user_profile'] = 'Bekijk profiel :: %s'; // %s is username
$lang['About_user'] = 'Alles over %s'; // %s is username

$lang['Preferences'] = 'Voorkeuren';
$lang['Items_required'] = 'Velden gemarkeerd met een * moeten verplicht worden ingevuld.';
$lang['Registration_info'] = 'Registratie Informatie';
$lang['Profile_info'] = 'Profiel Informatie';
$lang['Profile_info_warn'] = 'Deze info is voor iedereen toegankelijk';
$lang['Avatar_panel'] = 'Avatar controle paneel';
$lang['Avatar_gallery'] = 'Avatar gallerie';

$lang['Website'] = 'Website';
$lang['Location'] = 'Woonplaats';
$lang['Contact'] = 'Contact';
$lang['Email_address'] = 'E-mail adres';
$lang['Email'] = 'E-mail';
$lang['Send_private_message'] = 'Verstuur een Priv&eacute; Bericht';
$lang['Hidden_email'] = '[ Verborgen ]';
//$lang['Search_user_posts'] = 'Zoek naar berichten van deze gebruiker';
$lang['Interests'] = 'Interesses';
$lang['Occupation'] = 'Beroep';
$lang['Poster_rank'] = 'Rang gebruiker';

$lang['Total_posts'] = 'Totaal berichten';
$lang['User_post_pct_stats'] = '%.2f%% van totaal'; // 1.25% of total
$lang['User_post_day_stats'] = '%.2f berichten per dag'; // 1.5 posts per day
$lang['Search_user_posts'] = 'Zoek alle berichten van %s'; // Find all posts by username

$lang['No_user_id_specified'] = 'Sorry, deze gebruiker bestaat niet.';
$lang['Wrong_Profile'] = 'Je kunt het profiel van een ander niet wijzigen.';

$lang['Only_one_avatar'] = 'Je kunt maar 1 avatar kiezen';
$lang['File_no_data'] = 'Het bestand dat je met de URL aangeeft, bevat geen data';
$lang['No_connection_URL'] = 'Er kon geen verbinding worden gemaakt met de opgegeven URL';
$lang['Incomplete_URL'] = 'De opgegeven URL is niet compleet. TIP: open de avatar of het plaatje in een nieuwe pagina en kopieer dan de URL ';
$lang['Wrong_remote_avatar_format'] = 'De URL die je opgeeft is niet toegestaan';
$lang['No_send_account_inactive'] = 'Sorry, maar je wachtwoord kan niet gevonden worden, omdat je account niet geactiveerd of gedeactiveerd is. Vraag de Beheerder voor meer info.';

$lang['Always_smile'] = 'Atijd Smilies toestaan';
$lang['Always_spellcheck'] = 'Controleer altijd de Spelling voor plaatsen';
$lang['Always_html'] = 'Altijd HTML toestaan';
$lang['Always_bbcode'] = 'Altijd BBCode toestaan';
$lang['Always_add_sig'] = 'Altijd ondertekening toevoegen';
$lang['Always_notify'] = 'Informeer me altijd bij een antwoord';
$lang['Always_notify_explain'] = 'Stuurt een e-mail als iemand antwoorde op een bericht van jou. Dit kun je wijzigen bij elk bericht dat je maakt.';

$lang['Board_style'] = 'Forum stijl (layout)';
$lang['Board_lang'] = 'Forum Taal';
$lang['No_themes'] = 'Geen Thema\'s in de database';
$lang['Timezone'] = 'Tijdzone';
$lang['Date_format'] = 'Datum opmaak';
$lang['Date_format_explain'] = 'De syntax is identiek aan die van PHP <a href=\'http://www.php.net/date\' target=\'_other\'>date()</a> functie.';
$lang['Signature'] = 'Ondertekening';
$lang['Signature_explain'] = 'Dit is een stukje tekst dat je onder elk bericht dat je maakt kunt toevoegen. Er is een beperking van %d karakters';
$lang['Public_view_email'] = 'Toon altijd mijn e-mail adres';
//
$lang['Current_password'] = 'Huidig wachtwoord';
$lang['New_password'] = 'Nieuw wachtwoord';
$lang['Confirm_password'] = 'Bevestig wachtwoord';
$lang['Confirm_password_explain'] = 'Je moet bevestigen met je huidige wachtwoord, wanneer je die wilt veranderen of je e-mail adres wilt aanpassen';

if($userdata['session_logged_in']){
    $lang['password_if_changed'] = 'Je hoeft hier alleen een wachtwoord in te vullen wanneer je die wilt veranderen';
    $lang['password_confirm_if_changed'] = 'Vul het wachtwoord nog een keer in, wanneer je het hierboven hebt veranderd.';
} else {
    $lang['password_if_changed'] = 'Let op: Je wachtwoord is HoOfDlEtTeR GeVoEliG';
    $lang['password_confirm_if_changed'] = '';
}


$lang['PS_security_title']      = 'Veiligheid controle paneel';
$lang['PS_security_question']     = 'Veiligheids Vraag';
$lang['PS_security_question_exp']   = 'Deze vraag zal gesteld worden wanneer je account geblokkeerd raakt, veroorzaakt door te veel mislukte login pogingen.';
$lang['PS_security_answer']      = 'Veiligheids Antwoord';
$lang['PS_security_answer_exp']    = 'Dit is het antwoord op de veiligheids vraag hierboven. Het antwoord heb je nodig om je account te deblokkeren en is HoOfDlEtTeR GeVoEliG!';
$lang['PS_security_error']      = 'Fout';
$lang['PS_security_info']      = 'Informatie';
$lang['PS_security_one']      = 'De Veiligheids Vraag en het Veiligheids Antwoord zijn verplichte velden.';
$lang['PS_security_a_exp']      = '<br>Dit is het gecodeerde antwoord dat je invoerde, zodat niemand het weet behalve jij. Wanneer je het wilt wijzigen, moet je contact opnemen met een Beheerder.';
$lang['PS_security_locked']      = 'Sorry, met deze gebruikersnaam is het aantal login pogingen overschreden. <br /><br />De gebruikersnaam is nu geblokkeerd. <br /><br />Wanneer je de rechtmatige gebruiker bent, klik dan hieronder voor een pagina om je account te de-blokkeren.<br><br><a href="login_security.'. $phpEx .'?phpBBSecurity=retreive&sid='. $userdata['session_id'] .'">Klik Hier</a> om je gebruikersnaam te de-blokkeren.';
$lang['PS_security_force']      = 'Sorry, het is je eerste bezoek sinds de invoering van extra beveiligings maatregelen. Je kunt alleen je profiel pas bekijken, wanneer je de extra verplichte velden hebt ingevuld. <a href="profile.'. $phpEx .'?mode=register&sub=registering&sid='. $userdata['session_id'] .'">Klik hier</a> Bedankt!';
$lang['PS_admin_one']        = 'Login Pogingen';
$lang['PS_admin_one_exp']      = '<br>Dit is het aantal keren dat iemand een wachtwoord verkeerd mag invoeren, voordat de account geblokkeerd wordt.';
$lang['PS_admin_two']        = 'Licht Beheerder in';
$lang['PS_admin_two_exp']      = '<br>Als dit is \'Ingeschakeld\', bepaal dan hieronder op welke manier(en) de Beheerder moet worden ingelicht.';
$lang['PS_admin_three']        = 'Beheerder';
$lang['PS_admin_three_exp']      = '<br>Dit is de Beheerder die u wilt inlichten wanneer hierboven \'Ingeschakeld\' geselecteerd is.';
$lang['PS_admin_err_one']      = 'De login limiet moet groter zijn dan 0. Ga terug en probeer het opnieuw.';
$lang['PS_admin_err_two']      = 'U heeft ervoor gekozen om een Beheerder in te lichten. Kies daarom alstublieft een Beheerder ID. Ga terug en probeer het opnieuw.';
$lang['PS_admin_error_three']    = 'Het Beheerder ID moet een getal zijn. Ga terug en probeer het opnieuw.';
$lang['PS_admin_error_four']    = 'Het Beheerder ID moet een waarde hebben die groter is dan 0. Ga terug en probeer het opnieuw.';
$lang['PS_admin_error_five']    = 'De login limiet moet een getal zijn. Ga terug en probeer het opnieuw.';
$lang['PS_admin_current']      = 'Huidige Beheerder: %A%';
$lang['PS_admin_default']      = 'Kies een Beheerder';
$lang['PS_login_title']        = 'phpBB Beveiliging';
$lang['PS_login_header']      = 'phpBB Beveiliging';
$lang['PS_login_username']      = 'Vul je gebruikersnaam in';
$lang['PS_login_email']        = 'Vul het e-mail adres in dat aan deze gebruikersnaam is verbonden';
$lang['PS_login_step_one']      = 'Stap 1: Bevestig Account Info ';
$lang['PS_login_step_two']      = 'Stap 2: Bevestig Veiligheids vraag';
$lang['PS_login_step_failed']    = 'Sorry, de informatie die je invulde is onjuist.';
$lang['PS_login_button']      = 'Bevestig';
$lang['PS_login_validated']      = 'Bedankt voor het Deblokkeren van je account. Je kunt nu inloggen.';
$lang['PS_profile_explain']      = 'Het is belangrijk dat je even goed nadenkt voordat je dit invult. Je kunt dit later niet zomaar even aanpassen. Om veiligheidsredenen heb je toestemming nodig van een Beheerder om het aan te passen. Zodra deze zijn ingesteld, kun je ze alleen nog maar bekijken.';
$lang['PS_forgot_sq']        = '<a href="login_security.'. $phpEx .'?phpBBSecurity=forgot&sid='. $userdata['session_id'] .'">Veiligheids vraag Vergeten?</a>';
$lang['PS_forgot_exp']        = 'Als u uw veiligheids antwoord vergeten bent, zult u een Beheerder moeten vragen uw beveiligingsinformatie te resetten. Het emailadres van de Beheerder is '. $board_config['board_email'] .'. Wanneer u de Beheerder niet kunt bereiken op dat adres, kijk dan op de Beheerder profielen voor emailadressen. Wanneer u het update, gebruik dan informatie die u kunt onthouden om dit in de toekomst te voorkomen.';
$lang['PS_user_lock']        = 'Blokkeer status';
$lang['PS_user_lock_exp']      = 'Als de account geblokkeerd is, zal men elke keer dat men probeert in te loggen hun beveiligingsinformatie moeten invoeren.';
$lang['PS_user_reset']        = 'Reset de Beveiligings Informatie';
$lang['PS_user_reset_exp']      = 'Waarschuwing: Als u dit aanvinkt, moet de gebruiker zijn/haar beveiligingsinformatie invoeren. Dit zal hun huidige beveiligingsinstellingen wijzigen.';
$lang['PS_user_status_l']      = 'Deze account is momenteel geblokkeerd. Wanneer u deze aanvinkt wordt de account <b>gedeblokkeerd</b>.';
$lang['PS_user_status_u']      = 'Deze account is momenteel niet geblokkeerd. Wanneer u deze aanvinkt wordt de account <b>geblokkeerd</b>.';
$lang['PS_pm_subject']        = 'Er is een account geblokkeerd.';
$lang['PS_pm_message']        =
'Er is zojuist een account geblokkeerd. Zie hieronder de details.

Geblokkeerde account: %U%
IP adres van degene die deze account blokkeerde: %I%

Dit is een automatisch bericht, stuur geen bericht terug. Wanneer u een IP tracker heeft, vergelijk het bovenstaande IP adres met die in de database.';
$lang['PS_auto_message']      = 'Het lijkt er op dat u van deze website bent gebanned. Wanneer dit een fout is of u niet weet waarom u werd gebanned, neem dan contact op met de beheerder.<br /><br /><b>Beheerder:</b> ';
$lang['PS_admin_ban']        = 'Auto Ban';
$lang['PS_admin_ban_exp']      = '<br>Dit zal automatisch elk IP-adres bannen wanneer deze een list probeerd. Deze optie zal alle persoonlijke opties overschrijven. Als u de persoonlijke opties wilt gebruiken zet deze dan op \'Disabled\' en stel uw persoonlijke instellingen in.';
$lang['PS_admin_sessions']      = 'Maximum aantal toegestane sessies';
$lang['PS_admin_sessions_exp']    = '<br>Wanneer de "sessions" tabel groter wordt dan dit getal, zal deze mod hem automatisch onder dit aantal houden.';
$lang['PS_clike']          = 'Clike Poging';
$lang['PS_union']          = 'Union Poging';
$lang['PS_sql']            = 'SQL Injectie Poging';
$lang['PS_ddos']          = 'DDoS Poging';
$lang['PS_caught_left']        = 'IP';
$lang['PS_caught_c_left']      = 'Betrapt voor';
$lang['PS_caught_c_right']      = 'Betrapt op';
$lang['PS_caught_right']      = 'Pogingen';
$lang['PS_caught_msg']        = 'Er zijn geen hack pogingen gedaan door script-kiddies op deze site.';
$lang['PS_special']          = 'phpBB Beveiliging:: Speciale opties';
$lang['PS_special_admins']      = 'Aantal toegestane Beheerders';
$lang['PS_special_admins_exp']    = '<br>Dit is het maximum aantal toegestane Beheerders op uw site. Zodat niemand een Beheerder account kan toevoegen.';
$lang['PS_special_admins_total']  = '<br>U heeft %X% gebruikers de \'Beheerder\' status gegeven.';
$lang['PS_special_admins_offset']  = '<font color="red"> Het blijkt dat je meer Beheerders hebt dan is toegestaan!</font>';
$lang['PS_special_mods']      = 'Aantal toegestane moderators';
$lang['PS_special_mods_exp']    = '<br>Dit is het maximum aantal toegestane Moderators op uw site. Zodat niemand een Beheerder account kan toevoegen.';
$lang['PS_special_mods_total']    = '<br>Je hebt %X% gebruikers de \'Moderator\' status gegeven.';
$lang['PS_special_mods_offset']    = '<font color="red">Het blijkt dat je meer Moderators hebt dan is toegestaan!</font>';
$lang['PS_use_special']        = 'Beveilig Beheerder & moderator accounts';
$lang['PS_use_special_exp']      = '<br>Wanneer dit is uitgeschakeld, is het aantal Beheerder en Moderator accounts niet meer beveiligd, en kunnen er onbeperkt accounts worden toegevoegd.';
$lang['PS_fopen_fwrite']      = 'File Writing Poging';
$lang['PS_system']          = 'Perl Execution Poging';
$lang['PS_chr']            = 'Encoded Characters Poging';
$lang['PS_cback']          = 'CBACK Worm Poging';
$lang['PS_allow_user_change']    = 'Gebruikers toestaan hun SQ info te veranderen. <b>Niet aanbevolen!</b>';
$lang['PS_notify_admin_by_pm']    = 'Priv&eacute; Bericht';
$lang['PS_notify_admin_by_em']    = 'E-mail';
$lang['PS_option_ban']        = 'Ban';
$lang['PS_option_block']      = 'Blokkeer';
$lang['PS_option_ignore']      = 'Negeer';
$lang['PS_option_warning']      = '<b>Waarschuwing:</b> Wanneer u &eacute;&eacute;n van de onderstaande opties op \'Negeer\' instelt, zal iedereen op uw site deze trucs kunnen gebruiken. U bent gewaarschuwd!';
$lang['PS_list_choice_one']      = 'Ja';
$lang['PS_list_choice_two']      = 'Nee';
$lang['PS_list_one']        = 'Actie te ondernemen bij een <b>DDoS</b> poging?';
$lang['PS_list_two']        = 'Actie te ondernemen bij een <b>Clike</b> poging?';
$lang['PS_list_three']        = 'Actie te ondernemen bij een <b>UNION</b> poging?';
$lang['PS_list_four']        = 'Actie te ondernemen bij een <b>CBACK Worm</b> poging?';
$lang['PS_list_five']        = 'Actie te ondernemen bij een <b>SQL Injection</b> poging?';
$lang['PS_list_six']        = 'Actie te ondernemen bij een <b>Perl Script</b> poging?';
$lang['PS_list_seven']        = 'Actie te ondernemen bij een <b>Encoded Characters</b> poging?';
$lang['PS_list_eight']        = 'Actie te ondernemen bij een <b>File Write/Open</b> poging?';
$lang['PS_blocked_line']      = '<b>&nbsp;phpBB Security &copy;&nbsp;</b> heeft %T% hack pogingen geblokkeerd.';
$lang['PS_blocked_line2']      = '<a href="login_security.php?phpBBSecurity=caught" class="copyright">Protected</a> by phpBB Security © <a href="http://phpbb-amod.com" class="copyright" target="_blank">phpBB-Amod</a>';


#==== Added in 1.0.2
$lang['PS_die_msg_cookies']      = 'Er is een cookie mis-match met jouw account. Verwijder je cookies en log opnieuw in.';
$lang['PS_die_msg_banned']      = 'Je bent gebanned op deze site.';
$lang['PS_die_msg_ddos']      = 'Je bent geblokt omdat we denken dat je een DDoS poging bent. Dit kan ook veroorzaakt worden omdat je een firewall of iets soortgelijks hebt draaien.';
$lang['PS_die_msg_encoded']      = 'Je bent geblokt omdat je geprobeerd hebt gecodeerde tekens naar deze site te sturen &amp; dit is mogelijk een poging om ongeoorloofd toegang te verkrijgen.';
$lang['PS_die_msg_union']      = 'Je bent geblokt omdat je geprobeerd hebt een union type script naar deze site te sturen &amp; dit is mogelijk een poging om ongeoorloofd toegang te verkrijgen.';
$lang['PS_die_msg_clike']      = 'Je bent geblokt omdat je geprobeerd hebt een clike type script uit te voeren op deze site &amp; dit is mogelijk een poging om ongeoorloofd toegang te verkrijgen.';
$lang['PS_die_msg_sql']        = 'Je bent geblokt omdat je geprobeerd hebt SQL in te voeren op deze site &amp; dit is mogelijk een poging om ongeoorloofd toegang te verkrijgen.';
$lang['PS_die_msg_fwrite']      = 'Je bent geblokt omdat je geprobeerd hebt een bestand schrijf type script naar deze site te sturen &amp; dit is mogelijk een poging om ongeoorloofd toegang te verkrijgen.';
$lang['PS_die_msg_perl']      = 'Je bent geblokt omdat je geprobeerd hebt een Perl uitvoerend type script naar deze site te sturen &amp; dit is mogelijk een poging om ongeoorloofd toegang te verkrijgen.';
$lang['PS_die_msg_cback']      = 'Je bent geblokt omdat je geprobeerd hebt een sanity mix worm type script naar deze site te sturen &amp; dit is mogelijk een poging om ongeoorloofd toegang te verkrijgen.';
$lang['PS_die_msg_agent']      = 'Je bent geblokt omdat je User Agent overeenkomt met &eacute;&eacute;n die we hebben geblokt.';
$lang['PS_die_msg_referer']      = 'Je bent geblokt omdat je Referer overeenkomt met &eacute;&eacute;n die we hebben geblokt.';
$lang['PS_die_msg_staff']      = 'Je bent geblokt omdat je tot het Site Team behoort, maar &eacute;&eacute;n van de beheerders de rechten nog niet heeft ingevoerd in het Beveiligings Paneel.';

$lang['PS_die_msg_email']      = 'Wanneer je het gevoel hebt dat dit bericht een fout is van de site, neem dan contact op met een beheerder door een e-mail te sturen naar %email%.';

$lang['PS_admin_submit']      = 'Configuratie opslaan';
$lang['PS_admin_submit_special']  = 'Speciale configuratie opslaan';
$lang['PS_admin_config_saved']    = 'Configuratie bijwerken.';
$lang['PS_admin_special_saved']    = 'Speciale instellingen bijwerken.';
$lang['PS_return_config']      = '%s<b>Klik hier</b>%s om terug te gaan naar de Configuratie pagina.';
$lang['PS_return_special']      = '%s<b>Klik hier</b>%s om terug te gaan naar de Speciale configuratie pagina.';
$lang['PS_admin_not_authed']    = 'Sorry, je hebt niet de bevoegdheid om de instellingen te zien of te wijzigen.';
$lang['PS_admin_grant_access']    = 'Hier kun je Beheerders selecteren, om bevoegdheid te geven, om deze pagina te kunnen zien.';
$lang['PS_admin_deny_access']    = 'Hier kun je Beheerders selecteren, om de bevoegdheid in te trekken, om deze pagina te kunnen zien.';
$lang['PS_block_agents']      = 'Blokkeer User Agents';
$lang['PS_block_agents_exp']    = 'Je moet zeker weten wat je doet voordat je dit gebruikt. Je kunt hier bijvoorbeeld <b>Firefox</b> toevoegen. Iedereen die een firefox browser gebruikt, wordt dan geblokkeerd.';
$lang['PS_unblock_agents']      = 'De-blokkeer User Agents';
$lang['PS_block_referers']      = 'Blokkeer Referers';
$lang['PS_block_referers_exp']    = 'Je moet zeker weten wat je doet voordat je dit gebruikt. Je kunt hier bijvoorbeeld <b>search.yahoo.com</b> toevoegen. Iedereen die via deze site hier komt, wordt dan geblokkeerd.';
$lang['PS_unblock_referers']    = 'De-blokkeer Referers';
$lang['PS_per_page']        = 'Hoeveel pogingen moeten er op een pagina worden weergegeven';
$lang['PS_ddos_level']        = 'DDoS beschermings niveau:';
$lang['PS_ddos_high']        = 'Hoog';
$lang['PS_ddos_medium']        = 'Gemiddeld';
$lang['PS_ddos_low']        = 'Laag';

$lang['PS_members_title']      = 'Hieronder zal een lijst verschijnen van gebruikers die betrapt zijn op een poging deze site te misbruiken.';
$lang['PS_members_pt_check']    = 'Gecontroleerd [b]Site Berichten[/b] Tabel, Resultaten:';
$lang['PS_members_pt_check_yc']    = 'Berichten Tabel heeft iets gevonden:';
$lang['PS_members_pt_check_nc']    = 'De Berichten Tabel vond geen IP overeenkomsten.';
$lang['PS_user_exploits']      = 'Hun misbruik pogingen';

$lang['PS_users_tries']        = '%N%\'s misbruik pogingen';
$lang['PS_users_id']        = 'Id';
$lang['PS_users_ip']        = 'Ip';
$lang['PS_users_link']        = 'Link';
$lang['PS_users_reason']      = 'Reden';
$lang['PS_users_date']        = 'Datum';

$lang['PS_search_title']      = 'Zoek in de database';
$lang['PS_search_ip']        = 'Vul een IP adres in';
$lang['PS_search_submit']      = ' Start zoeken ';
$lang['PS_search_partial']      = 'Gedeeltelijk Gelijk';
$lang['PS_search_exact']      = 'Exact Gelijk';
$lang['PS_search_unban']      = 'Unban deze IP';
$lang['PS_search_banned']      = 'Momenteel gebanned';

$lang['PS_backup_on']        = 'Dagelijkse Database Backup';
$lang['PS_backup_folder']      = 'Directorie om de backups in op te slaan';
$lang['PS_backup_folder_exp']    = 'Deze directorie <b>MOET</b> in je forum root directorie zitten, en <b>MOET</b> <i>CHMOD</i> -> 777 rechten hebben';
$lang['PS_backup_filename']      = 'Naam voor de Database Backups';
$lang['PS_backup_filename_exp']    = '<i>Bijvoorbeeld:</i> backup';
$lang['PS_backup_time']        = 'Tijdstip om de dagelijkse Backup te maken';
$lang['PS_backup_total']      = 'Verwijder beschikbare backups: %N%';
$lang['PS_backup_remove']			= 'Verwijder back-upbestand';

#==== Added in 1.0.3
$lang['PS_modcp_verify']			= 'Please verify your password.';
$lang['PS_modcp_verify_fail']		= 'Your Password Was Incorrect, Please Press Back &amp; Try Again.';
$lang['PS_guest_max']				= 'Max allowed sessions per guest IP.';
$lang['PS_guest_max_exp']			= 'This is helpful for people who DDoS sites &amp; get through. With alot of programs, all the guests will have the same IP. This will eliminate that problem.';
$lang['PS_pass_match']				= 'Password Match';
$lang['PS_pass_match_exp']			= 'If this is set to enabled, users passwords will not be allowed to be the same as their usernames when they make accounts.';
$lang['PS_pass_min_length']			= 'Minimum Pass Length';
$lang['PS_pass_min_length_exp']		= 'If this is set to enabled, then users will have to make passwords longer than what you set it to below.';
$lang['PS_pass_length']				= 'Minimum Characters Allowed';
$lang['PS_pass_force']				= 'It appears this is your first visit since the admins have forced all users to change their passwords. So please click %shere%s and update your password. Thanks.';
$lang['PS_pass_force_error']		= 'You <b>have</b> to update your password. Please press back &amp; try again.';
$lang['PS_pass_length_error']		= 'Sorry, there is a %s minimum character requirement for passwords.';
$lang['PS_pass_match_error']		= 'Sorry, your password can not be the same as your username.';
$lang['PS_pass_error']				= 'You cant force a minimum password length and not have a minimum length set.';
#====
#==== Author: aUsTiN [austin@phpbb-amod.com] [http://phpbb-amod.com] === |
#==== End: ==== phpBB Security ========================================= |
#======================================================================= |


$lang['Avatar'] = 'Avatar';
$lang['Avatar_explain'] = 'Geeft een afbeelding weer onder je naam bij je berichten. Deze mag niet groter dan %d pixels hoog en %d pixels breed, en niet groter dan %d KB zijn.';
$lang['Upload_Avatar_file'] = 'Upload Avatar vanaf je computer';
$lang['Upload_Avatar_URL'] = 'Upload Avatar URL';
$lang['Upload_Avatar_URL_explain'] = 'Geef de URL op waar de Avatar staat, deze zal gecopieerd worden naar de site.';
$lang['Pick_local_Avatar'] = 'Selecteer een Avatar uit de gallery';
$lang['Link_remote_Avatar'] = 'Link naar een andere site waar de Avatar staat';
$lang['Link_remote_Avatar_explain'] = 'Geef de URL op waar de Avatar staat.';
$lang['Avatar_URL'] = 'URL van de Avatar';
$lang['Select_from_gallery'] = 'Selecteer een Avatar uit de gallery';
$lang['View_avatar_gallery'] = 'Toon de gallery';

$lang['Select_avatar'] = 'Selecteer Avatar';
$lang['Return_profile'] = 'Annuleer Avatar';
$lang['Select_category'] = 'Selecteer Categorie';

$lang['Delete_Image'] = 'Verwijder Avatar';
$lang['Current_Image'] = 'Huidige Avatar';

$lang['Notify_on_privmsg'] = 'Informeer me over nieuwe Priv&eacute; Berichten';
$lang['Popup_on_privmsg'] = 'Pop up venster als er een nieuw Priv&eacute; Bericht is';
$lang['Popup_on_privmsg_explain'] = 'Sommige stijlen geven altijd een popup venster.';
$lang['Hide_user'] = 'Verberg je online status';

$lang['Profile_updated'] = 'Je profiel is aangepast';

$lang['Password_mismatch'] = 'De opgegeven wachtwoorden komen niet met elkaar overeen.';
$lang['Current_password_mismatch'] = 'Het opgegeven wachtwoord komt niet overeen met het wachtwoord in de database.';
$lang['Password_long'] = 'Je wachtwoord mag niet langer dan 32 tekens zijn.';
$lang['Username_taken'] = 'Sorry, deze gebruikersnaam wordt al gebruikt.';
$lang['Username_invalid'] = 'Sorry, in deze gebruikersnaam zitten niet toegestane tekens zoals \'.';
$lang['Username_disallowed'] = 'Sorry, deze gebruikersnaam kan niet worden gebruikt.';
$lang['Username_numeric'] = 'Sorry, de gebruikersnaam mag geen getal zijn.';
$lang['Email_taken'] = 'Sorry, dit e-mail adres wordt al gebruikt.';
$lang['Email_banned'] = 'Sorry, dit e-mail adres wordt niet toegestaan.';
$lang['Email_invalid'] = 'Sorry, dit e-mail adres is niet geldig.';
$lang['Signature_too_long'] = 'Je ondertekening is te lang.';
$lang['Fields_empty'] = 'Je moet alle verplichte velden invullen.';
$lang['Avatar_filetype'] = 'De avatar moet van het bestandstype .jpg, .gif of .png zijn';
$lang['Avatar_filesize'] = 'De avatar moet kleiner zijn dan %d KB'; // De avatar moet kleiner zijn dan 6 KB
$lang['Avatar_imagesize'] = 'De avatar mag maximaal %d pixels breed en %d pixels hoog zijn';

$lang['Welcome_subject'] = 'Welkom op %s Forums'; // Welcome to my.com forums
$lang['New_account_subject'] = 'Nieuwe gebruikers account';
$lang['Account_activated_subject'] = 'Account is Geactiveerd';

$lang['Account_added'] = 'Bedankt voor het registreren. Je kunt nu inloggen met je gebruikersnaam en wachtwoord.';
$lang['Account_inactive'] = 'Je account is aangemaakt. MAAR, voordat je kunt inloggen, moet je je account echter nog activeren. Er is een activeringsmail verstuurd naar het e-mail adres dat je hebt opgegeven. Controleer je e-mail voor verdere details.';
$lang['Account_inactive_admin'] = 'Je account is aangemaakt. MAAR, voordat je kunt inloggen, moet je account nog geactiveerd worden door een Beheerder. Hiervoor is een e-mail verstuurd naar de Beheerder en je krijgt een e-mail zodra je account is geactiveerd';
$lang['Account_active'] = 'Je account is nu geactiveerd. Je kunt nu inloggen met je gebruikersnaam en wachtwoord. Bedankt voor het registreren!';
$lang['Account_active_admin'] = 'De account is nu geactiveerd';
$lang['Reactivate'] = 'Activeer je account opnieuw!';
$lang['Already_activated'] = 'Je account is al geactiveerd. Je kunt gewoon inloggen met je gebruikersnaam en wachtwoord.';
$lang['COPPA'] = 'Je account moet eerst goedgekeurd worden. Controleer je e-mail voor verdere details.';

$lang['Wrong_activation'] = 'De activeringscode komt niet overeen met die in de database.';
$lang['Send_password'] = 'Stuur me een nieuw wachtwoord';
$lang['Password_updated'] = 'Er is een nieuw wachtwoord aangemaakt. Controleer je e-mail om deze te activeren.';
$lang['No_email_match'] = 'Het opgegeven e-mail adres komt niet overeen met die in de database.';
$lang['New_password_activation'] = 'Nieuw wachtwoord activering';
$lang['Password_activated'] = 'Je account werd opnieuw geactiveerd. Om nu in te loggen gebruik je het wachtwoord dat je net is toegestuurd via e-mail.';

$lang['Send_email_msg'] = 'Verstuur een e-mail bericht';
$lang['No_user_specified'] = 'Geen gebruiker opgegeven';
$lang['User_prevent_email'] = 'Deze gebruiker wenst geen e-mail te ontvangen. Je kunt proberen een PB te sturen.';
$lang['User_not_exist'] = 'Die gebruikersnaam bestaat niet in de database';
$lang['CC_email'] = 'Stuur een kopie naar jezelf';
$lang['Email_message_desc'] = 'Dit zal verzonden worden als platte tekst, voeg dus geen HTML of BBCode in. Het retour adres van dit bericht is jouw e-mail adres.';
$lang['Flood_email_limit'] = 'Je kunt op dit moment niet nog een e-mail versturen. Probeer het later nog eens.';
$lang['Recipient'] = 'Ontvanger';
$lang['Email_sent'] = 'De e-mail is verzonden.';
$lang['Send_email'] = 'Verstuur e-mail';
$lang['Empty_subject_email'] = 'Je moet een onderwerp invullen.';
$lang['Empty_message_email'] = 'Je moet een bericht invullen.';


//
// Visual confirmation system strings
//
$lang['Confirm_code_wrong'] = 'De bevestigingscode die je hebt ingevuld is onjuist.';
$lang['Too_many_registers'] = 'Je hebt te vaak geprobeerd je te registreren. Probeer het later nog eens!';
$lang['Confirm_code_impaired'] = 'Wanneer het niet lukt en je hulp nodig hebt met de code, kun je kontact opnemen met %sAdministrator%s.';
$lang['Confirm_code'] = 'Bevestigingscode';
$lang['Confirm_code_explain'] = 'Vul de code exact hetzelfde in. De code is HoOfDlEtTeR GeVoElIg en in een Nul staat een diagonale lijn.';



//
// Memberslist
//
$lang['Select_sort_method'] = 'Selecteer sorteer methode';
$lang['Sort'] = 'Sorteer';
$lang['Sort_Top_Ten'] = 'Top Tien Plaatsers';
$lang['Sort_Joined'] = 'Registratie Datum';
$lang['Sort_Username'] = 'Gebruikersnaam';
$lang['Sort_Location'] = 'Woonplaats';
$lang['Sort_Posts'] = 'Aantal berichten';
$lang['Sort_Email'] = 'E-mail';
$lang['Sort_Website'] = 'Website';
$lang['Sort_Ascending'] = 'Oplopend';
$lang['Sort_Descending'] = 'Aflopend';
$lang['Order'] = 'Sorteer';


//
// Group control panel
//
$lang['Remove_selected'] = 'Verwijder geselecteerde';
$lang['Add_member'] = 'Lid toevoegen';
$lang['None'] = 'Geen';

//
// Search
//
$lang['Sort_by'] = 'Sorteer op';
//
$lang['No_search_match'] = 'Geen onderwerpen of berichten volgens opgegeven criteria gevonden';
$lang['Close_window'] = 'Venster Sluiten';

//
// Auth related entries
//
// Note the %s will be replaced with one of the following 'user' arrays
$lang['Sorry_auth_announce'] = 'Sorry, alleen %s kunnen aankondigingen plaatsen in dit forum.';
$lang['Sorry_auth_sticky'] = 'Sorry, alleen %s kunnen sticky berichten plaatsen in dit forum.';
$lang['Sorry_auth_read'] = 'Sorry, alleen %s kunnen berichten lezen in dit forum.';
$lang['Sorry_auth_post'] = 'Sorry, alleen %s kunnen berichten plaatsen in dit forum.';
$lang['Sorry_auth_reply'] = 'Sorry, alleen %s kunnen antwoorden in dit forum.';
$lang['Sorry_auth_edit'] = 'Sorry, alleen %s kunnen berichten bewerken in dit forum.';
$lang['Sorry_auth_delete'] = 'Sorry, alleen %s kunnen berichten verwijderen uit dit forum.';
$lang['Sorry_auth_vote'] = 'Sorry, alleen %s kunnen stemmen in dit forum.';

// These replace the %s in the above strings
$lang['Auth_Anonymous_Users'] = '<b>anonieme gebruikers</b>';
$lang['Auth_Registered_Users'] = '<b>geregistreerde gebruikers</b>';
$lang['Auth_Users_granted_access'] = '<b>gebruikers met speciale toegang</b>';
$lang['Auth_Moderators'] = '<b>moderators</b>';
$lang['Auth_Administrators'] = '<b>beheerders</b>';

$lang['Not_Moderator'] = 'Je bent geen moderator van dit forum.';
$lang['Not_Authorised'] = 'Niet gemachtigd';
$lang['Admin_reauthenticate'] = 'Om naar de beheer modules te kunnen, moet je je opnieuw autoriseren.';

$lang['You_been_banned'] = 'Je bent gebanned van dit forum.<br />Je kunt contact opnemen met de beheerder voor meer info.';


//
// Viewonline
//
$lang['Online_explain'] = 'Deze data is gebaseerd op de laatste 5 minuten';

$lang['Forum_Location'] = 'Forum Locatie';
$lang['Last_updated'] = 'Laatst bijgewerkt';

$lang['Forum_index'] = 'Forum index';
$lang['Logging_on'] = 'Inloggen';
$lang['Viewing_profile'] = 'Profiel bekijken';

//
// Moderator Control Panel
//

$lang['Select'] = 'Selecteer';
$lang['Move'] = 'Verplaats';
$lang['Lock'] = 'Sluiten';
$lang['Unlock'] = 'Openen';

$lang['Topics_Moved'] = 'De geselecteerde berichten zijn verplaatst.';

//
// Timezones ... for display on each page
//
$lang['All_times'] = 'Alle tijden zijn %s'; // eg. All times are GMT - 12 uur (times from next block)

$lang['-12']     = 'GMT - 12 uur';
$lang['-11']     = 'GMT - 11 uur';
$lang['-10']     = 'GMT - 10 uur';
$lang['-9']     = 'GMT - 9 uur';
$lang['-8']     = 'GMT - 8 uur';
$lang['-7']     = 'GMT - 7 uur';
$lang['-6']     = 'GMT - 6 uur';
$lang['-5']     = 'GMT - 5 uur';
$lang['-4']     = 'GMT - 4 uur';
$lang['-3.5']     = 'GMT - 3.5 uur';
$lang['-3']     = 'GMT - 3 uur';
$lang['-2']     = 'GMT - 2 uur';
$lang['-1']     = 'GMT - 1 uur';
$lang['0']     = 'GMT';
$lang['1']     = 'GMT + 1 uur';
$lang['2']     = 'GMT + 2 uur';
$lang['3']     = 'GMT + 3 uur';
$lang['3.5']     = 'GMT + 3.5 uur';
$lang['4']     = 'GMT + 4 uur';
$lang['4.5']     = 'GMT + 4.5 uur';
$lang['5']     = 'GMT + 5 uur';
$lang['5.5']     = 'GMT + 5.5 uur';
$lang['6']     = 'GMT + 6 uur';
$lang['6.5']     = 'GMT + 6.5 uur';
$lang['7']     = 'GMT + 7 uur';
$lang['8']     = 'GMT + 8 uur';
$lang['9']     = 'GMT + 9 uur';
$lang['9.5']     = 'GMT + 9.5 uur';
$lang['10']     = 'GMT + 10 uur';
$lang['11']     = 'GMT + 11 uur';
$lang['12']     = 'GMT + 12 uur';
$lang['13']     = 'GMT + 13 uur';

// These are displayed in the timezone select box
$lang['tz']['-12']   = 'GMT - 12 uur';
$lang['tz']['-11']   = 'GMT - 11 uur';
$lang['tz']['-10']   = 'GMT - 10 uur';
$lang['tz']['-9']   = 'GMT - 9 uur';
$lang['tz']['-8']   = 'GMT - 8 uur';
$lang['tz']['-7']   = 'GMT - 7 uur';
$lang['tz']['-6']   = 'GMT - 6 uur';
$lang['tz']['-5']   = 'GMT - 5 uur';
$lang['tz']['-4']   = 'GMT - 4 uur';
$lang['tz']['-3.5']   = 'GMT - 3.5 uur';
$lang['tz']['-3']   = 'GMT - 3 uur';
$lang['tz']['-2']   = 'GMT - 2 uur';
$lang['tz']['-1']   = 'GMT - 1 uur';
$lang['tz']['0']   = 'GMT';
$lang['tz']['1']   = 'GMT + 1 uur';
$lang['tz']['2']   = 'GMT + 2 uur';
$lang['tz']['3']   = 'GMT + 3 uur';
$lang['tz']['3.5']   = 'GMT + 3.5 uur';
$lang['tz']['4']   = 'GMT + 4 uur';
$lang['tz']['4.5']   = 'GMT + 4.5 uur';
$lang['tz']['5']   = 'GMT + 5 uur';
$lang['tz']['5.5']   = 'GMT + 5.5 uur';
$lang['tz']['6']   = 'GMT + 6 uur';
$lang['tz']['6.5']   = 'GMT + 6.5 uur';
$lang['tz']['7']   = 'GMT + 7 uur';
$lang['tz']['8']   = 'GMT + 8 uur';
$lang['tz']['9']   = 'GMT + 9 uur';
$lang['tz']['9.5']   = 'GMT + 9.5 uur';
$lang['tz']['10']   = 'GMT + 10 uur';
$lang['tz']['11']   = 'GMT + 11 uur';
$lang['tz']['12']   = 'GMT + 12 uur';
$lang['tz']['13']   = 'GMT + 13 uur';

$lang['datetime']['Sunday'] = 'Zondag';
$lang['datetime']['Monday'] = 'Maandag';
$lang['datetime']['Tuesday'] = 'Dinsdag';
$lang['datetime']['Wednesday'] = 'Woensdag';
$lang['datetime']['Thursday'] = 'Donderdag';
$lang['datetime']['Friday'] = 'Vrijdag';
$lang['datetime']['Saturday'] = 'Zaterdag';
$lang['datetime']['Sun'] = 'Zo';
$lang['datetime']['Mon'] = 'Ma';
$lang['datetime']['Tue'] = 'Di';
$lang['datetime']['Wed'] = 'Wo';
$lang['datetime']['Thu'] = 'Do';
$lang['datetime']['Fri'] = 'Vr';
$lang['datetime']['Sat'] = 'Za';
$lang['datetime']['January'] = 'Januari';
$lang['datetime']['February'] = 'Februari';
$lang['datetime']['March'] = 'Maart';
$lang['datetime']['April'] = 'April';
$lang['datetime']['May'] = 'Mei';
$lang['datetime']['June'] = 'Juni';
$lang['datetime']['July'] = 'Juli';
$lang['datetime']['August'] = 'Augustus';
$lang['datetime']['September'] = 'September';
$lang['datetime']['October'] = 'Oktober';
$lang['datetime']['November'] = 'November';
$lang['datetime']['December'] = 'December';
$lang['datetime']['Jan'] = 'Jan';
$lang['datetime']['Feb'] = 'Feb';
$lang['datetime']['Mar'] = 'Mar';
$lang['datetime']['Apr'] = 'Apr';
$lang['datetime']['May'] = 'Mei';
$lang['datetime']['Jun'] = 'Jun';
$lang['datetime']['Jul'] = 'Jul';
$lang['datetime']['Aug'] = 'Aug';
$lang['datetime']['Sep'] = 'Sep';
$lang['datetime']['Oct'] = 'Okt';
$lang['datetime']['Nov'] = 'Nov';
$lang['datetime']['Dec'] = 'Dec';

// calendar pcp stuff
$lang['Sunday'] = 'Zondag';
$lang['Monday'] = 'Maandag';

//
// Errors (not related to a
// specific failure on a page)
//
$lang['Information'] = 'Informatie';
$lang['Critical_Information'] = 'Kritieke informatie';

$lang['General_Error'] = 'Algemene Fout';
$lang['Critical_Error'] = 'Kritieke Fout';
$lang['An_error_occured'] = 'Er is een fout opgetreden';
$lang['A_critical_error'] = 'Er is een kritieke fout opgetreden';

$lang['Topic_description'] = 'Omschrijving van je bericht';
$lang['Description'] = 'Onderwerp omschrijving';

//
// Begin Approve_Posts_Mod Block : 22
//

//stuff user sees
$lang['approve_topic_has_awaiting'] = 'Onderwerp bevat berichten die wachten op goedkeuring';
$lang['approve_topic_is_awaiting'] = 'Onderwerp wacht op goedkeuring';
$lang['approve_post_is_awaiting'] = 'Bericht wacht op goedkeuring';

$lang['approve_posts_error_obtain'] = 'Kon geen forum goedkeuring informatie verkrijgen';
$lang['approve_posts_error_delete'] = 'Kon geen forum goedkeuring informatie verwijderen';
$lang['approve_posts_error_insert'] = 'Kon geen forum goedkeuring informatie invoegen';

$lang['approve_notify_subject'] = 'Goedgekeurd bericht/onderwerp';
$lang['approve_notify_link'] = 'Er wacht een bericht op goedkeuring van de moderator. Klik hier om het bericht te bekijken: ';
$lang['approve_notify_approve_link'] = 'Klik hier om het bericht goed te keuren: ';
$lang['approve_notify_message'] = 'Het bericht is hieronder toegevoegd.';
$lang['approve_notify_message_exceeded'] = '...vervolg van bericht';
$lang['approve_notify_poster'] = '*** Dit bericht moet wachten op goedkeuring. Tot die tijd kan het niet bekeken worden. ***';
$lang['approve_notify_user_link'] = 'Je bericht is goedgekeurd. Klik hier om het bericht te bekijken:';
$lang['approve_notify_user_topic'] = 'Al jouw berichten in dit onderwerp zijn goedgekeurd.';
$lang['approve_notify_auto_app'] = 'Auto-Goedkeuring Bericht.';
$lang['approve_notify_auto_app_msg'] = 'De berichten die je in gemodereerde forums plaatst worden automatisch goedgekeurd.';
$lang['approve_notify_auto_app_rem'] = 'Verwijder Auto-Goedkeuring Bericht.';
$lang['approve_notify_auto_app_rem_msg'] = 'De berichten die je in gemodereerde forums plaatst worden niet langer automatisch goedgekeurd.';
$lang['approve_notify_moderation'] = 'Bericht Moderatie.';
$lang['approve_notify_moderation_msg'] = 'De berichten die je in gemodereerde forums plaatst worden gemodereerd.';
$lang['approve_notify_moderation_rem'] = 'Verwijder Bericht Moderatie.';
$lang['approve_notify_moderation_rem_msg'] = 'De berichten die je in gemodereerde forums plaatst worden niet langer gemodereerd.';
$lang['approve_notify_post_approved'] = 'Je bericht is goedgekeurd!.';

$lang['approve_topic_all_current'] = 'Goedkeuring voor alle huidige berichten in dit onderwerp';
$lang['approve_topic_all_future'] = 'Auto-Goedkeuring voor alle toekomstige berichten in dit onderwerp';
$lang['approve_topic_all_future_rem'] = 'Verwijder Auto-Goedkeuring voor alle toekomstige berichten in dit onderwerp';
$lang['approve_topic_moderate'] = 'Modereer dit onderwerp en alle toekomstige antwoorden';
$lang['approve_topic_moderate_rem'] = 'Verwijder Onderwerp Moderatie';
$lang['approve_post_approve'] = 'Bericht goedkeuren';
$lang['approve_topic_approve'] = 'Onderwerp goedkeuren';
$lang['approve_user_auto_approve'] = 'Auto-Goedkeuring voor deze gebruiker';
$lang['approve_user_auto_approve_rem'] = 'Verwijder Auto-Goedkeuring';
$lang['approve_user_moderate'] = 'Modereer deze gebruiker';
$lang['approve_user_moderate_rem'] = 'Verwijder Moderatie';

//stuff admin sees
$lang['approve_admin_enable'] = 'Goedkeuring Systeem Inschakelen:';
$lang['approve_admin_posts'] = 'Berichten goedkeuren';
$lang['approve_admin_users_enable'] = 'Stel moderatie in voor:';
$lang['approve_admin_users_all'] = 'Alle gebruikers & onderwerpen';
$lang['approve_admin_users_mod'] = 'Geselecteerde gebruikers & onderwerpen';
$lang['approve_admin_posts_topics'] = 'Stel moderatie in voor:';
$lang['approve_admin_posts_enable'] = 'Nieuwe berichten';
$lang['approve_admin_poste_enable'] = 'Bericht bewerkingen';
$lang['approve_admin_topics_enable'] = 'Nieuwe onderwerpen';
$lang['approve_admin_topice_enable'] = 'Onderwerp bewerkingen';
$lang['approve_admin_hide_topics_enable'] = 'Verberg afgekeurde onderwerpen:';
$lang['approve_admin_hide_posts_enable'] = 'Verberg afgekeurde berichten:';
$lang['approve_admin_button_find'] = 'Zoek gebruikers';
$lang['approve_admin_button_add'] = 'Gebruikers toevoegen';
$lang['approve_admin_button_rem'] = 'Verwijder gebruiker';
$lang['approve_admin_moderators'] = 'Moderater(s):';
$lang['approve_admin_forums'] = 'Forums';
$lang['approve_admin_users'] = 'Gebruikers';
$lang['approve_admin_author'] = 'Autheur';
$lang['approve_admin_subject'] = 'Onderwerp';
$lang['approve_admin_empty'] = '--leeg--';
$lang['approve_admin_remove'] = 'Verwijder';
$lang['approve_admin_approve'] = 'Goedkeuren';
$lang['approve_admin_add_approved_submit'] = 'Auto-Goedkeuring';
$lang['approve_admin_add_moderated_submit'] = 'Modereer';
$lang['approve_admin_page'] = 'Pagina: ';
$lang['approve_admin_remove_moderation'] = 'Verwijder moderatie';
$lang['approve_admin_remove_approval'] = 'Verwijder goedkeuring';

//Admin menu titles moved to lang_admin.php';

$lang['approve_admin_notify_user_enable'] = 'PB gebruiker bij goedkeuring:';
$lang['approve_admin_notify_admin_enable'] = 'Informeer moderator:';
$lang['approve_admin_notify_type'] = 'Informeren via: ';
$lang['approve_admin_notify_pm_enable'] = 'Priv&eacute; Bericht';
$lang['approve_admin_notify_email_enable'] = 'E-mail';
$lang['approve_admin_notify_message_enable'] = 'Bericht toevoegen bij informeren: ';
$lang['approve_admin_notify_message_length'] = 'Max. lengte (0 = alles)';
$lang['approve_admin_notify_posts_topics'] = 'Informeren bij:';
$lang['approve_admin_notify_posts_enable'] = 'Nieuwe berichten';
$lang['approve_admin_notify_poste_enable'] = 'Bericht bewerkingen';
$lang['approve_admin_notify_topics_enable'] = 'Nieuwe onderwerpen';
$lang['approve_admin_notify_topice_enable'] = 'Onderwerp bewerkingen';
$lang['approve_admin_notify_user_invalid'] = 'Ga terug en wijzig de instellingen.<br/>De volgende gebruiker is ongeldig: ';
$lang['approve_admin_notify_user_empty'] = 'Ga terug en wijzig de instellingen.<br/>Je moet minstens 1 moderator kiezen om te informeren.';

$lang['approve_admin_username'] = 'Gebruikersnaam';
$lang['approve_admin_users_moderated_users'] = 'Gemodereerde gebruikers';
$lang['approve_admin_users_auto_approved'] = 'Auto-Goedkeuring gebruikers';
$lang['approve_admin_users_of'] = 'Gebruikers <b>%d</b>-<b>%d</b> van <b>%d</b>'; // Replaces with: Users 1-2 of 2 for example
$lang['approve_admin_users_id_remove_error'] = 'De gekozen gebuikers-ID is ongeldig.';
$lang['approve_admin_users_moderation_removed'] = 'De gebruiker "%s" wordt niet langer gemodereerd.';
$lang['approve_admin_users_approval_removed'] = 'De gebruiker "%s" is verwijderd uit auto-goedkeuring.';
$lang['approve_admin_users_approval_added'] = 'De gebruiker "%s" is toegevoegd aan auto-goedkeuring.';
$lang['approve_admin_users_moderated_added'] = 'De gebruiker "%s" wordt vanaf nu gemodereerd.';
$lang['approve_admin_add_approved_user'] = 'Auto-Goedgekeurde gebruiker toevoegen';
$lang['approve_admin_add_moderated_user'] = 'Gemodereerde gebruiker toevoegen';

$lang['approve_admin_topics_title'] = 'Onderwerp titel';
$lang['approve_admin_approve_topic'] = 'Onderwerp goedkeuren';
$lang['approve_admin_topics_moderated_topics'] = 'Gemodereerde onderwerpen';
$lang['approve_admin_topics_awaiting'] = 'Onderwerpen wachtend op goedkeuring';
$lang['approve_admin_topics_auto_approved'] = 'Auto-goedgekeurde onderwerpen';
$lang['approve_admin_topics_of'] = 'Onderwerpen <b>%d</b>-<b>%d</b> van <b>%d</b>'; // Replaces with: Topics 1-2 of 2 for example
$lang['approve_admin_topics_id_remove_error'] = 'De gekozen onderwerp-ID is ongeldig.';
$lang['approve_admin_topics_moderation_removed'] = 'Het onderwerp "%s" wordt niet langer gemodereerd.';
$lang['approve_admin_topics_approval_removed'] = 'Het onderwerp "%s" is verwijderd uit auto-goedkeuring.';
$lang['approve_admin_topics_approval_added'] = 'Het onderwerp "%s" is toegevoegd aan auto-goedkeuring.';
$lang['approve_admin_topics_moderated_added'] = 'Het onderwerp "%s" wordt vanaf nu gemodereerd.';
$lang['approve_admin_topics_approved'] = 'Het onderwerp "%s" is goedgekeurd.';

$lang['approve_admin_approve_post'] = 'Bericht goedkeuren';
$lang['approve_admin_posts_awaiting'] = 'Berichten wachtend op goedkeuring';
$lang['approve_admin_posts_of'] = 'Bericht <b>%d</b>-<b>%d</b> van <b>%d</b>'; // Replaces with: Posts 1-2 of 2 for example
$lang['approve_admin_posts_id_remove_error'] = 'De gekozen bericht-ID is ongeldig.';
$lang['approve_admin_posts_approved'] = 'Het bericht "%s" van "%s" is goedgekeurd.'; //Replaces with: The post "blah" by "mr.man" has been approved.

$lang['approve_admin_forums_moderated'] = 'Gemodereerde Forums';
$lang['approve_admin_Stored_replacement'] = $lang['Stored'] . '<br/><br/> Het bericht kan gelezen worden zodra een moderator het heeft goedgekeurd. <br/> Plaats je bericht slechts eenmaal.';
//
// End Approve_Posts_Mod Block : 22
//

$lang['Home'] = 'Home';

// Start add - Fully integrated shoutbox MOD
$lang['Shoutbox'] = 'ShoutBox';
$lang['Shoutbox_date'] = ' D G:i \\s\c\h\r\e\e\f ';
$lang['Shout_censor'] = 'Shout verwijderd!';
$lang['Shout_refresh'] = 'Vernieuwen';
$lang['Shout_text'] = 'Tekst';
$lang['Viewing_Shoutbox']= 'Bekijkt Shoutbox';
$lang['Censor'] ='Censuur';
$lang['This_posts_IP'] = 'IP adres van dit bericht';
$lang['Other_IP_this_user'] = 'Andere IP adressen van deze gebruiker';
$lang['Users_this_IP'] = 'Gebruikers die dit IP adres gebruiken';
$lang['IP_info'] = 'IP Informatie';
$lang['Lookup_IP'] = 'IP adres opzoeken';
$lang['Disable_HTML_post'] = 'HTML uitschakelen in dit bericht';
$lang['Disable_BBCode_post'] = 'BBCode uitschakelen in dit bericht';
$lang['Disable_Smilies_post'] = 'Smilies uitschakelen in dit bericht';
$lang['Smilies'] = 'Smilies';

// End add - Fully integrated shoutbox MOD

$lang['Message_preview'] = 'Preview bericht';

// Start add - Yellow card admin MOD
$lang['Rules_ban_can'] = '<b>kun</b> je andere gebruikers bannen';
$lang['Rules_greencard_can'] = '<b>kun</b> je gebruikers un-bannen';
$lang['Rules_bluecard_can'] = '<b>kun</b> je een bericht melden bij de moderators';

$lang['Viewing_RULES'] = 'Regels bekijken';
$lang['Forum_Rules'] = 'Regels';

$lang['cookies_link'] = 'Mijn Cookies Beheer';

// RATING MOD
$lang['Rating'] = 'Waardering';
$lang['No_rating'] = 'Niet gewaardeerd';
$lang['Ratings_by'] = 'Bericht gewaardeerd door %s';
$lang['Rated_posts_by'] = 'Berichten die door %s gewaardeerd zijn';
$lang['Latest_ratings'] = 'Laatste waardering';
$lang['Highest_ranked_topics'] = 'Hoogst gewaardeerde onderwerpen';
$lang['Highest_ranked_posts'] = 'Hoogst gewaardeerde berichten';
$lang['Highest_ranked_posters'] = 'Hoogst gewaardeerde plaatsers';

$lang['Staff'] = 'Forum Team Pagina';

//
// Bookmark Mod
//
$lang['More_bookmarks'] = 'Meer bladwijzers...'; // For mozilla navigation bar

//-----------------------------------------------------------------------------
// MOD: Delayed Topics
$lang['Delayed_Post_Alt'] = 'Onderwerp vertraagd (door %s)';   // %s replaced by delivery date
$lang['Sorry_auth_delayedpost'] = 'Sorry, alleen %s kan berichten plaatsen met vertraging';

// MOD: Delayed Topics {end}
//-----------------------------------------------------------------------------
// Logo Selector MOD
$lang['Logo_settings'] = 'Logo Instellingen';
$lang['Logo_explain'] = 'Hier kun je het path naar de map voor forumlogo\'s opgeven, het te gebruiken logo selecteren en de hoogte en breedte ervan opgeven.';
$lang['Logo_path'] = 'Logo opslag path';
$lang['Logo_path_explain'] = 'Path in je phpbb-map (bijv. images/logo)';
$lang['Logo'] = 'Selecteer een Logo';
$lang['Logo_dimensions'] = 'Logo afmetingen';
$lang['Logo_dimensions_explain'] = '(Hoogte x Breedte in pixels) ';
$lang['PS_admin_ban']				= 'Auto Ban';
$lang['PS_admin_ban_exp']			= '<br>This will automatically ban any IP that tries to use a Clike, SQL Injection, DDoS or UNION trick.';
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
///
$lang['LW_USER_ACCT_ERROR'] = 'Gebruiker met ID = %d bestaat niet.';
$lang['LW_WELCOME_REGISTERED'] = 'Bedankt voor uw registratie. Uw account is aangemaakt.';
$lang['LW_TRANSACTION_RECORDS'] = 'Transacties';
$lang['LW_EXPIRE_MEMBER_REMINDER'] = 'Je gebruikersperiode zal eindigen op <b>%s</b>';
$lang['LW_EXPIRE_TRIAL_REMINDER'] = 'Je  testperiode duurt nog <b>%d</b> dag(en)';
$lang['LW_WELCOME_REGIST_TRIAIL'] = 'Welkom %s, je kunt nu %d dag(en) surfen op deze website. <br>Als je hierna nog gebruik wilt blijven maken van al onze services, zul je ons € %s inschrijvingsgeld moeten betalen.';
$lang['LW_AMOUNT_TO_PAY_EXPLAIN'] = 'Wanneer je betaling geaccordeerd is, zul je toegang krijgen tot alle forums.';
$lang['LW_TRIAL_PERIOD'] = 'De lengte van de testperiode waarin de gebruiker je site kan bezoeken, <br>uitgedrukt in dagen (moet groter of gelijk aan nul zijn): ';
$lang['LW_OUR_SUBSCRIPTION_FEE'] = 'Inschrijvingsgeld: ';
$lang['LW_OUR_PAYPAL_CURRENCY_CODE'] = 'De munteenheid code die door je PayPal account wordt ondersteund: ';
$lang['LW_OUR_PAYPAL_ACCT'] = 'Je PayPal account om betalingen te ontvangen van gebruikers: ';
$lang['LW_PAYPAL_ACCT_SETTINGS_TITLE'] = 'PayPal IPN Instellingen';
$lang['LW_ACCT_DISPLAY_FROM'] = 'Toon de laatste transactierecords: ';
$lang['LW_ALL_RECORDS'] = 'Alle records';
$lang['LW_NO_RECORDS'] = 'Geen records beschikbaar';
$lang['LW_ACCT_CREDIT'] = 'Creditsaldo';
$lang['LW_ACCT_DEBIT'] = 'Debetsaldo';
$lang['NP_DATE'] = 'Datum';
$lang['LW_ACCT_CURRENCY'] = 'Munteenheid';
$lang['LW_ACCT_AMOUNT'] = 'Aantal';
$lang['LW_ACCT_PLUS_MINUS'] = 'Creditsaldo / Debetsaldo';
$lang['LW_ACCT_TXNID'] = 'PayPal TXN ID';
$lang['LW_ACCT_STATUS'] = 'Status';
$lang['LW_ACCT_COMMENT'] = 'Opmerkingen';
$lang['LW_NO_PRIVILEGE'] = 'Je hebt onvoldoende rechten om deze pagina te bekijken.';
$lang['LW_Click_view_ACCT_RECORDS'] = 'Klik %shier%s om uw transactierecords te bekijken';
$lang['LW_PAYMENT_DONE'] = 'Betaling voor inschrijving succesvol beëindigd.';
$lang['LW_PAYMENT_PENDDING'] = 'Bedankt! Je account zal automatisch upgraden wanneer de beheerder je betaling accepteert. <br>De notitie van de betaling zal verzonden worden naar het volgende emailadres: %s door PayPal.';
$lang['LW_PAYMENT_DENIED'] = 'De betaling van je account is afgewezen, voor vragen kun je contact opnemen met de beheerder.';
$lang['LW_PAYMENT_FAILED'] = 'De betaling van je account is mislukt, je kunt het later nog eens proberen.';
$lang['LW_UPDATE_USER_ACCT_ERROR'] = 'Fout bij het bijwerken van de gebruikersaccount, neem alsjeblieft contact op met de beheerder.';
$lang['LW_AMOUNT_TO_PAY'] = 'Te betalen bedrag: ';
$lang['LW_ACCT_DEPOSIT_INTO'] = 'Betaling';
$lang['LW_TOPUP_CONFIRM_TITLE'] = 'Bevestig je betaling';
$lang['Account_not_exist_lw'] = 'Het account dat je hebt opgegeven bestaat niet.';
$lang['Account_activated_lw'] = 'Je account kan reeds alle forums bezoeken.';
$lang['Click_return_login_lw'] = 'Klik %shier%s om nu in te loggen.';
$lang['Click_return_activate_lw'] = 'Klik %shier%s om het inschrijvingsgeld te betalen om uw account te upgraden.';
$lang['Disabled_account_lw'] = 'Je account is nog niet geactiveerd.';
$lang['LW_PAYPAL_ACCT_ERROR'] = 'De PayPal account van deze website is nog niet opgezet om bedragen te ontvangen. Neem hiervoor alsjeblieft contact op met de beheerder.';
$lang['LW_PAYMENT_DATA_ERROR'] = 'U heeft een verkeerd bedrag ingevuld voor het inschrijvingsgeld.';
$lang['LW_YOU_ARE_VIP'] = 'Welkom %s, je behoort nu tot onze <b>VIP</b>.';
$lang['L_LW_PAYMENTS'] = 'Subscriptie';
$lang['LW_LOGIN_TO_PAY'] = 'Gelieve in te loggen met je gebruikersnaam en wachtwoord. Je zult doorgestuurd worden naar de betalingspagina wanneer u dit nog niet heeft gedaan. ';
$lang['LW_PAY_FOR_WHICH_MONTH'] = 'Voor subscriptie van <b>%s</b> naar <b>%s</b>';
///
$lang['Sorry_auth_paid_read'] = 'Sorry, maar alleen <b>betalende gebruikers</b> kunnen dit forum bekijken.';
$lang['LW_Welcome_Nopaid_Member'] = 'Welkom %s, je bent onze gemeenschappelijke gebruiker.';
$lang['Sorry_auth_paid_post'] = 'Sorry, maar alleen <b>betalende gebruikers</b> kunnen berichten plaatsen op dit forum.';
$lang['L_LW_PAID_GROUP_NAME'] = 'De groepsnaam waar betalende gebruikers lid van worden: ';
$lang['LW_SELECT_A_GROUP'] = 'Selecteer een groep waar je lid van wilt worden';
$lang['L_LW_GROUP_TO_PAY'] = 'De groep waarvan je lid wilt worden: ';
$lang['LW_TOPUP_TITLE'] = 'Wordt lid van de Payment-Groep';
$lang['L_LW_GROUP_DESCRIPTION'] = 'Groep Beschrijving: ';
$lang['L_LW_FOR_JOIN_GROUP'] = 'Groep: ';
$lang['L_LW_FOR_UPGRADE_GROUP'] = 'Upgrade naar groep: ';
$lang['L_LW_FOR_EXTEND_GROUP'] = 'Verleng je lidmaatschap voor de groep: ';
$lang['L_LW_USER_EXTEND_SAME_GROUP'] = 'Je gaat je lidmaatschap verlengen.';
$lang['L_LW_USER_JOIN_GROUP'] = 'Je gaat je inschrijven bij deze groep.';
$lang['L_LW_USER_UPGRADE_GROUP'] = 'Je zal je huidige lidmaatschap upgraden.';
$lang['L_LW_USER_DOWNGRADE_GROUP'] = 'Je kunt je lidmaatschap niet downgraden. Wacht tot je huidige lidmaatschap verloopt.';
$lang['L_LW_UPGRADE_REMIND'] = 'Inschrijving Details: ';
///
$lang['Click_return_subscribe_lw'] = 'Klik %shier%s om een groep te selecteren waarvan je lid wilt worden. Je zult hiervoor lidmaatschapsgeld moeten betalen.';
$lang['L_LW_GROUP_ALREADY_JOIN'] = 'De groep waar je nu lid van bent: ';
$lang['L_LW_GROUP_VIEW_DETAIL'] = 'Toon de lidmaatschapsdetails van de groep: ';
$lang['LW_PAYMENT_SUBSCRIPTION'] = 'Je inschrijving is verzonden.';
///
$lang['LW_ANONYMOUS_DONOR'] = 'Anoniem';
$lang['LW_MORE_DONORS'] = 'Toon alle Donors';
$lang['LW_CURRENT_DONORS'] = 'Toon Donors voor het huidige doel';
$lang['L_LW_LAST_DONORS'] = 'Laaste %s Donors';
$lang['L_LW_TOP_DONORS_TITLE'] = 'Top %s Donors';
$lang['L_LW_DONORS_NAME'] = 'Donor\'s Naam';
$lang['LW_DONORS_DISPLAY_FROM'] = 'Toon donors van de laatste: ';
$lang['LW_NO_DONORS_YET'] = 'Op dit moment nog geen donors';
$lang['LW_WE_HAVE_COLLECT'] = 'We hebben  <b>%.2f</b> ontvangen van ons doel van <b>%s</b>.';
$lang['LW_WANT_ANONYMOUS'] = 'Ik wil anoniem zijn.';
$lang['L_LW_DONATE_WAY'] = 'Je status als donor: ';
$lang['LW_DONATION_TO_POINTS'] = 'Bedankt voor je donatie! Je punten zullen vermeerderd worden tot %d';
$lang['LW_DONATION_TO_WHO'] = 'Doneer aan %s , Bedankt!';
$lang['LW_DONATE_TITLE'] = 'Donatie';
$lang['LW_DONATE_EXPLAIN'] = 'Klik hier om deze site financieel te ondersteunen';
$lang['LW_AMOUNT_TO_DONATE'] = 'Bedrag dat je wilt doneren: ';
$lang['LW_AMOUNT_TO_DONATE_EXPLAIN'] = 'Bedankt voor je donatie, wij kunnen hierdoor betere ondersteuning geven aan onze gebruikers.';
$lang['LW_DONATE_CONFIRM_TITLE'] = 'Bevestig het te Doneren Bedrag';
$lang['LW_ACCT_DONATE_INTO'] = 'Doneer';
$lang['LW_DONATE_DONE'] = 'Bedankt voor je donatie, wij kunnen hierdoor betere ondersteuning geven aan onze gebruikers.';
$lang['LW_DONATE_PENDDING'] = 'Bedankt voor je donatie, wij kunnen hierdoor betere ondersteuning geven aan onze gebruikers.';
$lang['LW_DONATE_DENIED'] = 'Onze excuses, donatie is om onbepaalde redenen niet mogelijk, voor vragen kun je contact opnemen met de beheerder.';
$lang['LW_DONATE_FAILED'] = 'Donatie mislukt, probeer het later nog eens. Bedankt!';
$lang['LW_ACCT_DONATE_US'] = 'Doneer';
$lang['LW_CURRENCY_TO_PAY'] = 'Selecteer de munteenheid: ';
$lang['LW_CURRENCY_TO_PAY_EXPLAIN'] = 'Op dit moment accepteren we alleen %s .';
$lang['LW_PAYMENT_DATA_ERROR'] = 'De munteenheid of het bedrag dat je hebt opgegeven is onjuist.';
$lang['LW_DONATION_TO_POSTS'] = 'Bedankt voor uw donatie! Je berichten zullen vermeerderd worden tot  %d';
$lang['LW_DONATION_TO_HELP'] = 'Help ons alsjeblieft bij de ontwikkeling van de site!';
$lang['L_LW_MONEY'] = 'Geld gedoneerd';
$lang['L_LW_DATE'] = 'Donatie datum';
///
// Please note: %sHERE%s is used to dynamically building the A HREF tag, do not remove the percent signs (%) around HERE!
$lang['dhtml_faq_noscript'] = 'Het blijkt dat je browser geen javascript ondersteunt.<br /><br />Klik %sHIER%s om een HTML versie te zien van deze FAQ.';
// added by edwin :: required fields
$lang['Required_force'] = 'Sorry, het blijkt dat dit je eerste bezoek is sinds we enkele verplichte velden aan je account hebben toegevoegd. <br />Wanneer je de velden gemarkeerd met %s invult, zul je onze hele site weer kunnen bekijken. <br />Bedankt!<br /> <br />Klik op de veldnamen hieronder en vul ze in:<br />%s';
// added by edwin :: registration
$lang['Profile_updated_inactive'] = 'Je profiel is bijgewerkt. Omdat je echter belangrijke informatie hebt veranderd, is je account op dit moment niet actief. Controleer je e-mail om te zien hoe je je account opnieuw kan activeren.';
$lang['Profile_updated_inactive_admin'] = 'Je profiel is bijgewerkt. Omdat je echter belangrijke informatie hebt veranderd, is je account op dit moment niet actief. Wacht op de beheerder die je account opnieuw zal activeren.';
$lang['Click_return_portal'] = 'Klik %sHier%s om terug te gaan naar de portaalpagina';
$lang['PS_security_a_exp_empty'] = 'Het antwoord dat je invoert, zal gecodeerd worden, zodat niemand het weet behalve jij. Onthoud het goed (schrijf het op), want deze informatie kan je niet meer terughalen.';
$lang['PS_security_a_exp_submitted'] = 'Dit is de gecodeerde versie van het antwoord dat je invoerde, zodat niemand het weet behalve jij. Wanneer je het wilt wijzigen, moet je contact opnemen met een Beheerder.';

// BEGIN Style Select MOD
$lang['Style_select_manage'] = 'Stijlselectie Beheer';
$lang['Style_select_explain'] = 'Hiermee kun je het Stijlselectie block beheren';
$lang['Style_select_author'] = 'Auteur';
$lang['Style_select_version'] = 'Versie';
$lang['Style_select_website'] = 'Website';
$lang['Style_select_viewings'] = 'Bekeken';
$lang['Style_select_dlurl'] = 'Bestand URL';
$lang['Style_select_dls'] = 'Download totaal';
$lang['Style_select_loaclurl'] = 'Lokalisatie URL';
$lang['Style_select_ludls'] = 'Download totaal';
$lang['Click_return_style_sel_admin'] = 'Klik %sHier%s om terug te gaan naar Stijlselectie beheer';
$lang['Style_select_update'] = 'Informatie is succesvol bijgewerkt';
// END Style Select MOD

// FIND - newsfeeds
$lang['Check_All'] = 'Selecteer Alles';
$lang['UnCheck_All'] = 'De-Selecteer Alles';
$lang['News_Read_More'] = 'Lees meer...';
$lang['News_source'] = 'Bron: ';
// end FIND - newsfeeds

$lang['Portal'] = 'Portaal';

$lang['By'] = 'van'; // picture {By} user :: Topic {By} user
$lang['Country'] = 'Land';

$lang['No_r_click'] = 'Rechts klikken is niet toegestaan';
$lang['No_copy'] = 'Kopiëren is niet toegestaan';

$lang['Day_users'] = '%d Geregistreerde gebruikers hebben onze website bezocht in de laatste %d uur:';
$lang['Not_day_users'] = '%d Geregistreerde gebruikers hebben onze website <span style="color:red">NIET</span> bezocht in de laatste %d uur:';

$lang['Login_attempts_exceeded'] = 'The maximum number of %s login attempts has been exceeded. You are not allowed to login for the next %s minutes.';
$lang['Please_remove_install'] = 'Please ensure that the install/ directory is deleted';
$lang['Please_remove_prill'] = 'Please ensure that the prill_install/ directory is deleted';
$lang['Please_remove_both'] = 'Please ensure both the install/ and prill_install/ directories are deleted';
$lang['Session_invalid'] = 'Invalid Session. Please resubmit the form.';

//====================================================================== |
//==== Start Advanced BBCode Box MOD =================================== |
//==== v5.0.0 ========================================================== |
//====
$lang['BBCode_box_hidden'] = 'Spoilers';
$lang['BBcode_box_view'] = 'Click to View Content';
$lang['BBcode_box_hide'] = 'Click to Hide Content';
//====
//==== Author: Disturbed One [http://hvmdesign.com] =================== |
//==== End Advanced BBCode Box MOD ==================================== |
//===================================================================== |

// Mighty Gorgon - Full Album Pack - BEGIN
$lang['Album'] = 'Album';
$lang['Personal_Gallery_Of_User'] = 'Personal Gallery Of %s';
$lang['Personal_Gallery_Of_User_Profile'] = 'Personal Gallery of %s (%d Pictures)';
$lang['Show_All_Pic_View_Mode_Profile'] = 'Show All Pictures In The Personal Gallery of %s (without sub cats)';
$lang['Not_allowed_to_view_album'] = 'Sorry, you are not allowed to view the album.';
$lang['Not_allowed_to_upload_album'] = 'Sorry, you are not allowed to upload new pic to the album. Please contact the album administrator for more information.';
$lang['Album_empty'] = 'There are no pics in the album<br />Click on the <b>Upload New Pic</b> link on this page to post one.';
$lang['Upload_New_Pic'] = 'Upload New Pic.';
$lang['Pic_Title'] = 'Pic Title';
$lang['Pic_Title_Explain'] = 'It is very important to give your pic a good title. It could be a name, a subject to make others know what it is without see it.';
$lang['Pic_Upload'] = 'Pic Upload';
$lang['Pic_Upload_Explain'] = 'Allowed types are JPG, GIF and PNG. Maximum file size is %s bytes. Maximum image dimensions are %sx%s pixels.';
$lang['Album_full'] = 'Sorry, the album has reached the maximum number of uploaded pics. Please contact the album administrator for more information.';
$lang['Album_upload_successful'] = 'Thank you, your pic has been uploaded successfully.';
$lang['Click_return_album'] = 'Click %shere%s to return to the Album.';
$lang['Invalid_upload'] = 'Invalid Upload<br /><br />Your pic is too big or its type is not allowed.';
$lang['Image_too_big'] = 'Sorry, your image dimensions is too large.';
$lang['Uploaded_by'] = 'Uploaded by';
$lang['Category_locked'] = 'Sorry, you cannot upload because this category was locked by an admin. Please contact the album administrator for more information.';
$lang['View_Album_Index'] = 'Album Index';
$lang['View_Album_Personal'] = 'Viewing Personal Album of a user';
$lang['View_Pictures'] = 'Viewing Pictures or Posting/Reading comments in the Album';
$lang['Album_Search'] = 'Searching the Album';
$lang['Pic_Name'] = 'Picture Name';
$lang['Description'] = 'Description';
$lang['Search_Contents'] = ' that contains: ';
$lang['Search_Found'] = 'Search found ';
$lang['Search_Matches'] = 'Matches:';
// Mighty Gorgon - Full Album Pack - END

$lang['profilcp_photo_shortcut'] = 'Photo';
$lang['profilcp_photo_pagetitle'] = 'Photo';
$lang['Public_view_photo'] = 'Display photos';
$lang['User_allowphoto'] = 'Can display photo';
$lang['Photo_panel'] = 'Photo control panel';
$lang['Photo_gallery'] = 'Photo gallery';
$lang['Only_one_photo'] = 'Only one type of photo can be specified';
$lang['Wrong_remote_photo_format'] = 'The URL of the remote photo is not valid';
$lang['Photo'] = 'Photo';
$lang['Photo_explain'] = 'Displays a small graphic image in your profile. Only one image can be displayed at a time, its width can be no greater than %d pixels, the height no greater than %d pixels, and the file size no more than %d KB.';
$lang['Upload_Photo_file'] = 'Upload Photo from your machine';
$lang['Upload_Photo_URL'] = 'Upload Photo from a URL';
$lang['Upload_Photo_URL_explain'] = 'Enter the URL of the location containing the Photo image, it will be copied to this site.';
$lang['Pick_local_Photo'] = 'Select Photo from the gallery';
$lang['Link_remote_Photo'] = 'Link to off-site Photo';
$lang['Link_remote_Photo_explain'] = 'Enter the URL of the location containing the Photo image you wish to link to.';
$lang['Photo_URL'] = 'URL of Photo Image';
$lang['Select_from_gallery'] = 'Select Photo from gallery';
$lang['View_photo_gallery'] = 'Show gallery';
$lang['Select_photo'] = 'Select photo';
$lang['Photo_filetype'] = 'The photo filetype must be .jpg, .gif or .png';
$lang['Photo_filesize'] = 'The photo image file size must be less than %d KB';
$lang['Photo_imagesize'] = 'The photo must be less than %d pixels wide and %d pixels high'; 

//Begin Lo-Fi Mod
$lang['Lofi'] = 'Lo-Fi Version';
$lang['Full_Version'] = 'Full Version';
$lang['quote_lofi'] = 'Quote';
$lang['edit_lofi'] = 'Edit';
$lang['ip_lofi'] = 'IP';
$lang['del_lofi'] = 'Delete';
$lang['profile_lofi'] = 'Profile';
$lang['pm_lofi'] = 'PM';
$lang['email_lofi'] = 'E-mail';
$lang['website_lofi'] = 'Website';
$lang['icq_lofi'] = 'ICQ';
$lang['aim_lofi'] = 'AIM';
$lang['yim_lofi'] = 'YIM';
$lang['msnm_lofi'] = 'MSN';
$lang['quick_lofi'] = 'Quick Reply';
$lang['new_pm_lofi'] = 'Send a PM';
//End Lo-Fi Mod

//
// That's all, Folks!
// -------------------------------------------------