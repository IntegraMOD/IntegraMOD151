<?php
/***************************************************************************
 *                            lang_main.php [German]
 *                              -------------------
 *     begin                : Sat Dec 16 2000
 *     copyright            : (C) 2001 The phpBB Group
 *     email                : support@phpbb.com
 *
 *     Land_main aktualisiert  : 09.2004 by schnulli
 *     email                   : dajudge@gmx.de 
 *
 ****************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

//
// CONTRIBUTORS:
//	 Add your details here if wanted, e.g. Name, username, email address, website
// 2002-08-27  Philip M. White        - fixed many grammar problems
//

/***************************************************************************
 * German Translation by:
 * Joel Ricardo Zick (Rici) webmaster@rpg-inn.de || http://www.sdc-forum.de
 * Assistance: Philipp Kordowich, Ingo Köhler
 *
 * Release date: 2003-10-09
 ***************************************************************************/

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
$lang['RIGHT'] = 'rechts';
$lang['DATE_FORMAT'] = 'd.m.Y'; // This should be changed to the default date format for your language, php date() format
$lang['Ignore'] = 'Ignore';

// This is optional, if you would like a _SHORT_ message output
// along with our copyright message indicating you are the translator
// please add it here.(ADDED TO CLEAR OTHER LANG INFO)
$lang['TRANSLATION_INFO'] = '';

//
// Common, these terms are used
// extensively on several pages
//
$lang['Forum'] = 'Forum';
$lang['Category'] = 'Kategorie';
$lang['Topic'] = 'Thema';
$lang['Topics'] = 'Themen';
$lang['Replies'] = 'Antworten';
$lang['Views'] = 'Aufrufe';
$lang['Post'] = 'Beitrag';
$lang['Posts'] = 'Beiträge';
$lang['Posted'] = 'Verfasst am';
$lang['Username'] = 'Benutzername';
$lang['Password'] = 'Passwort';
$lang['Email'] = 'E-Mail';
$lang['Poster'] = 'Poster';
$lang['Author'] = 'Autor';
$lang['Time'] = 'Zeit';
$lang['Hours'] = 'Stunden';
$lang['Message'] = 'Nachricht';

$lang['1_Day'] = '1 Tag';
$lang['7_Days'] = '7 Tage';
$lang['2_Weeks'] = '2 Wochen';
$lang['1_Month'] = '1 Monat';
$lang['3_Months'] = '3 Monate';
$lang['6_Months'] = '6 Monate';
$lang['1_Year'] = '1 Jahr';

$lang['Go'] = 'Los';
$lang['Jump_to'] = 'Gehe zu';
$lang['Submit'] = 'Absenden';
$lang['Reset'] = 'Zurücksetzen';
$lang['Cancel'] = 'Abbrechen';
$lang['Preview'] = 'Vorschau';
$lang['Confirm'] = 'Bestätigen';
$lang['Spellcheck'] = 'Rechtschreibprüfung';
$lang['Yes'] = 'Ja';
$lang['No'] = 'Nein';
$lang['Enabled'] = 'Aktiviert';
$lang['Disabled'] = 'Deaktiviert';
$lang['Error'] = 'Fehler';

$lang['Next'] = 'Weiter';
$lang['Previous'] = 'Zurück';
$lang['Goto_page'] = 'Gehe zu Seite';
$lang['Joined'] = 'Registriert';
$lang['IP_Address'] = 'IP-Adresse';

$lang['Select_forum'] = 'Forum auswählen';
$lang['View_latest_post'] = 'Letzten Beitrag anzeigen';
$lang['View_newest_post'] = 'Neuesten Beitrag anzeigen';
$lang['Page_of'] = 'Seite <b>%d</b> von <b>%d</b>'; // Replaces with: Page 1 of 2 for example

$lang['ICQ'] = 'ICQ-Nummer';
$lang['AIM'] = 'AIM-Name';
$lang['MSNM'] = 'MSN Messenger';
$lang['YIM'] = 'Yahoo Messenger';

$lang['Forum_Index'] = '%s Foren-Übersicht'; // eg. sitename Forum Index, %s can be removed if you prefer
//
$lang['Post_new_topic'] = 'Neues Thema eröffnen';
$lang['Reply_to_topic'] = 'Neue Antwort erstellen';
$lang['Reply_with_quote'] = 'Antworten mit Zitat';

$lang['Click_return_topic'] = '%sHier klicken%s, um zum Thema zurückzukehren'; // %s's here are for uris, do not remove!
$lang['Click_return_login'] = '%sHier klicken%s, um es noch einmal zu versuchen';
$lang['Click_return_forum'] = '%sHier klicken%s, um zum Forum zurückzukehren';
$lang['Click_view_message'] = '%sHier klicken%s, um deine Nachricht anzuzeigen';
$lang['Click_return_modcp'] = '%sHier klicken%s, um zur Moderatorenkontrolle zurückzukehren';
$lang['Click_return_group'] = '%sHier klicken%s, um zur Gruppeninfo zurückzukehren';

$lang['Admin_panel'] = 'Administrations-Bereich';

$lang['Board_disable'] = 'Sorry, aber dieses Board ist im Moment nicht verfügbar. Probier es bitte später wieder.';
$lang['View_post'] = 'View Post';
$lang['Acronym'] = 'Acronym';

$lang['Total_votes'] = 'Total Votes : ';
$lang['Voted_show'] = 'Voted : '; // it means :  users that voted  (the number of voters will follow)
$lang['Results_after'] = 'Results will be visible after the poll expires';
$lang['Poll_expires'] = 'Poll expires in : ';
$lang['Minutes'] = 'Minutes';
$lang['Max_vote'] = 'Maximum selections';
$lang['Max_vote_explain'] = '[ Enter 1 or leave blank to allow only one selection ]';
$lang['Max_voting_1_explain'] = 'Please select only ';
$lang['Max_voting_2_explain'] = ' answers';
$lang['Max_voting_3_explain'] = ' (selections above limit will be ignored)';
$lang['Vhide'] = 'Hide';
$lang['Hide_vote'] = 'Results';
$lang['Tothide_vote'] = 'Sum of votes';
$lang['Hide_vote_explain'] = '[ Hide until poll expires ]';

//
// Global Header strings
//
$lang['Registered_users'] = 'Registrierte Benutzer:';
$lang['Browsing_forum'] = 'Benutzer in diesem Forum:';
$lang['Online_users_zero_total'] = 'Insgesamt sind <b>0</b> Benutzer Online :: ';
$lang['Online_users_total'] = 'Insgesamt sind <b>%d</b> Benutzer Online :: ';
$lang['Online_user_total'] = 'Insgesamt ist <b>%d</b> Benutzer Online :: ';
$lang['Reg_users_zero_total'] = '0 registrierter, ';
$lang['Reg_users_total'] = '%d registrierte, ';
$lang['Reg_user_total'] = '%d registrierter, ';
$lang['Hidden_users_zero_total'] = '0 versteckter und ';
$lang['Hidden_users_total'] = '%d versteckte und ';
$lang['Hidden_user_total'] = '%d versteckter und ';
$lang['Guest_users_zero_total'] = '0 Gäste.';
$lang['Guest_users_total'] = '%d Gäste.';
$lang['Guest_user_total'] = '%d Gast.';
$lang['Record_online_users'] = 'Der Rekord liegt bei <b>%s</b> Benutzern am %s.'; // first %s = number of users, second %s is the date.

$lang['Admin_online_color'] = '%sAdministrator%s';
$lang['Mod_online_color'] = '%sModerator%s';

$lang['You_last_visit'] = 'Dein letzter Besuch war am: %s'; // %s replaced by date/time
$lang['Current_time'] = 'Aktuelles Datum und Uhrzeit: %s'; // %s replaced by time

$lang['Search_new'] = 'Beiträge seit dem letzten Besuch anzeigen';
$lang['Search_your_posts'] = 'Eigene Beiträge anzeigen';
$lang['Search_unanswered'] = 'Unbeantwortete Beiträge anzeigen';

$lang['Register'] = 'Registrieren';
$lang['Profile'] = 'Profil';
$lang['Edit_profile'] = 'Profil bearbeiten';
$lang['Search'] = 'Suchen';
$lang['Memberlist'] = 'Mitgliederliste';
$lang['FAQ'] = 'FAQ';
$lang['KB_title'] = 'Knowledge Base';
$lang['BBCode_guide'] = 'BBCode-Hilfe';
$lang['Usergroups'] = 'Benutzergruppen';
$lang['Last_Post'] = 'Letzter&nbsp;Beitrag';
$lang['Moderator'] = '<b>Moderator</b>';
$lang['Moderators'] = '<b>Moderatoren</b>';


//
// Stats block text
//
$lang['Posted_articles_zero_total'] = 'Unsere Benutzer haben <b>noch keine</b> Beiträge geschrieben.'; // Number of posts
$lang['Posted_articles_total'] = 'Unsere Benutzer haben insgesamt <b>%d</b> Beiträge geschrieben.'; // Number of posts
$lang['Posted_article_total'] = 'Unsere Benutzer haben <b>%d</b> Beitrag geschrieben.'; // Number of posts
$lang['Registered_users_zero_total'] = 'Wir haben <b>0</b> registrierten Benutzer.'; // # registered users
$lang['Registered_users_total'] = 'Wir haben <b>%d</b> registrierte Benutzer.'; // # registered users
$lang['Registered_user_total'] = 'Wir haben <b>%d</b> registrierten Benutzer.'; // # registered users
$lang['Newest_user'] = 'Der neueste Benutzer ist <b>%s%s%s</b>.'; // a href, username, /a

$lang['No_new_posts_last_visit'] = 'Keine neuen Beiträge seit deinem letzten Besuch';
$lang['No_new_posts'] = 'Keine neuen Beiträge';
$lang['New_posts'] = 'Neue Beiträge';
$lang['New_post'] = 'Neuer Beitrag';
$lang['No_new_posts_hot'] = 'Keine neuen Beiträge [ Top-Thema ]';
$lang['New_posts_hot'] = 'Neue Beiträge [ Top-Thema ]';
$lang['No_new_posts_locked'] = 'Keine neuen Beiträge [ Gesperrt ]';
$lang['New_posts_locked'] = 'Neue Beiträge [ Gesperrt ]';
$lang['Forum_is_locked'] = 'Forum ist gesperrt';


//
// Login
//
$lang['Enter_password'] = 'Gib bitte deinen Benutzernamen und dein Passwort ein, um dich einzuloggen!';
$lang['Login'] = 'Login';
$lang['Logout'] = 'Logout';

$lang['Forgotten_password'] = 'Ich habe mein Passwort vergessen!';

$lang['Log_me_in'] = 'Bei jedem Besuch automatisch einloggen';

$lang['Error_login'] = 'Du hast einen falschen oder inaktiven Benutzernamen oder ein falsches Passwort eingegeben.';


//
// Index page
//
$lang['Index'] = 'Index';
$lang['No_Posts'] = 'Keine Beiträge';
$lang['No_forums'] = 'Dieses Board hat keine Foren.';

$lang['Private_Message'] = 'Private Nachricht';
$lang['Private_Messages'] = 'Private Nachrichten';
$lang['Who_is_Online'] = 'Wer ist Online?';

$lang['Mark_all_forums'] = 'Alle Foren als gelesen markieren';
$lang['Forums_marked_read'] = 'Alle Foren wurden als gelesen markiert.';


//
// Viewforum
//
$lang['Topic_Announcement'] = '<b>Ankündigungen:</b>';
$lang['Topic_Sticky'] = '<b>Wichtig:</b>';
$lang['Topic_Moved'] = '<b>Verschoben:</b>';
$lang['Topic_Poll'] = '<b>[Umfrage]</b>';

//
// Viewtopic
//

$lang['Guest'] = 'Gast';
$lang['Post_subject'] = 'Titel';
$lang['Submit_vote'] = 'Stimme absenden';
$lang['View_results'] = 'Ergebnis anzeigen';
$lang['View_Topic'] = 'Thema anzeigen';

$lang['No_newer_topics'] = 'Es gibt keine neueren Themen in diesem Forum.';
$lang['No_older_topics'] = 'Es gibt keine älteren Themen in diesem Forum.';
$lang['Topic_post_not_exist'] = 'Das gewählte Thema oder der Beitrag existiert nicht.';
$lang['No_posts_topic'] = 'Es existieren keine Beiträge zu diesem Thema.';

$lang['Display_posts'] = 'Beiträge der letzten Zeit anzeigen';
$lang['All_Posts'] = 'Alle Beiträge';
$lang['Newest_First'] = 'Die neusten zuerst';
$lang['Oldest_First'] = 'Die ältesten zuerst';

$lang['Back_to_top'] = 'Nach oben';

$lang['Read_profile'] = 'Benutzer-Profile anzeigen';
$lang['Send_email'] = 'E-Mail an diesen Benutzer senden';
$lang['Visit_website'] = 'Website dieses Benutzers besuchen';
$lang['ICQ_status'] = 'ICQ-Status';
$lang['Edit_delete_post'] = 'Beitrag bearbeiten oder löschen';
$lang['View_IP'] = 'IP-Adresse zeigen';
$lang['Delete_post'] = 'Beitrag löschen';

$lang['wrote'] = 'hat folgendes geschrieben'; // proceeds the username and is followed by the quoted text
$lang['Quote'] = 'Zitat'; // comes before bbcode quote output.
$lang['Code'] = 'Code'; // comes before bbcode code output.
$lang['PHPCode'] = 'PHP'; // PHP MOD

$lang['Edited_time_total'] = 'Zuletzt bearbeitet von %s am %s, insgesamt einmal bearbeitet'; // Last edited by me on 12 Oct 2001, edited 1 time in total
$lang['Edited_times_total'] = 'Zuletzt bearbeitet von %s am %s, insgesamt %d-mal bearbeitet'; // Last edited by me on 12 Oct 2001, edited 2 times in total

//
// Posting/Replying (Not private messaging!)
//
$lang['Message_body'] = 'Nachrichtentext';

$lang['Options'] = 'Optionen';

$lang['Post_Announcement'] = 'Ankündigung';
$lang['Post_Sticky'] = 'Wichtig';

$lang['Flood_Error'] = 'Du kannst einen Beitrag nicht so schnell nach deinem letzten absenden, bitte warte einen Augenblick.';
$lang['Empty_subject'] = 'Bei einem neuen Thema musst du einen Titel angeben.';
$lang['Empty_message'] = 'Du musst zu deinem Beitrag einen Text eingeben.';
$lang['Forum_locked'] = 'Dieses Forum ist gesperrt, du kannst keine Beiträge editieren, schreiben oder beantworten.';
$lang['Topic_locked'] = 'Dieses Thema ist gesperrt, du kannst keine Beiträge editieren oder beantworten.';

$lang['Button_locked'] = 'gesperrt';

$lang['No_post_id'] = 'Du musst einen Beitrag zum editieren auswählen.';
$lang['Edit_own_posts'] = 'Du kannst nur deine eigenen Beiträge bearbeiten.';
$lang['Empty_poll_title'] = 'Du musst einen Titel für die Umfrage eingeben.';
$lang['To_few_poll_options'] = 'Du musst mindestens zwei Antworten für die Umfrage angeben.';
$lang['To_many_poll_options'] = 'Du hast zu viele Antworten für die Umfrage angegeben';

$lang['Update'] = 'Aktualisieren';
$lang['Delete'] = 'Löschen';
$lang['Days'] = 'Tage'; // This is used for the Run poll for ... Days + in admin_forums for pruning

$lang['HTML_is_ON'] = 'HTML ist <u>an</u>';
$lang['HTML_is_OFF'] = 'HTML ist <u>aus</u>';
$lang['BBCode_is_ON'] = '%sBBCode%s ist <u>an</u>'; // %s are replaced with URI pointing to FAQ
$lang['BBCode_is_OFF'] = '%sBBCode%s ist <u>aus</u>';
$lang['Smilies_are_ON'] = 'Smilies sind <u>an</u>';
$lang['Smilies_are_OFF'] = 'Smilies sind <u>aus</u>';

$lang['Attach_signature'] = 'Signatur anhängen (Signatur kann im Profil geändert werden)';
$lang['Delete_post'] = 'Diesen Beitrag löschen';

$lang['Stored'] = 'Deine Nachricht wurde erfolgreich eingetragen.';
$lang['Deleted'] = 'Deine Nachricht wurde erfolgreich gelöscht.';
$lang['Poll_delete'] = 'Deine Umfrage wurde erfolgreich gelöscht.';
$lang['Vote_cast'] = 'Deine Stimme wurde gezählt.';

$lang['Topic_reply_notification'] = 'Benachrichtigen bei Antworten';

$lang['bbcode_b_help'] = 'Text in fett: [b]Text[/b] (alt+b)';
$lang['bbcode_i_help'] = 'Text in kursiv: [i]Text[/i] (alt+i)';
$lang['bbcode_u_help'] = 'Unterstrichener Text: [u]Text[/u] (alt+u)';
$lang['bbcode_q_help'] = 'Zitat: [quote]Text[/quote] (alt+q)';
$lang['bbcode_c_help'] = 'Code anzeigen: [code]Code[/code] (alt+c)';
$lang['bbcode_l_help'] = 'Liste: [list]Text[/list] (alt+l)';
$lang['bbcode_o_help'] = 'Geordnete Liste: [list=]Text[/list] (alt+o)';
$lang['bbcode_p_help'] = 'Bild einfügen: [img]http://URL_des_Bildes[/img] (alt+p)';
$lang['bbcode_w_help'] = 'URL einfügen: [url]http://URL[/url] oder [url=http://url]URL Text[/url] (alt+w)';
$lang['bbcode_a_help'] = 'Alle offenen BBCodes schließen';
$lang['bbcode_s_help'] = 'Schriftfarbe: [color=red]Text[/color] Tipp: Du kannst ebenfalls color=#FF0000 benutzen';
$lang['bbcode_f_help'] = 'Schriftgröße: [size=x-small]Kleiner Text[/size]';

$lang['Emoticons'] = 'Smilies';
$lang['More_emoticons'] = 'Weitere Smilies ansehen';

$lang['Font_color'] = 'Schriftfarbe';
$lang['color_default'] = 'Standard';
$lang['color_dark_red'] = 'Dunkelrot';
$lang['color_red'] = 'Rot';
$lang['color_orange'] = 'Orange';
$lang['color_brown'] = 'Braun';
$lang['color_yellow'] = 'Gelb';
$lang['color_green'] = 'Grün';
$lang['color_olive'] = 'Oliv';
$lang['color_cyan'] = 'Cyan';
$lang['color_blue'] = 'Blau';
$lang['color_dark_blue'] = 'Dunkelblau';
$lang['color_indigo'] = 'Indigo';
$lang['color_violet'] = 'Violett';
$lang['color_white'] = 'Weiß';
$lang['color_black'] = 'Schwarz';

$lang['Font_size'] = 'Schriftgröße';
$lang['font_tiny'] = 'Winzig';
$lang['font_small'] = 'Klein';
$lang['font_normal'] = 'Normal';
$lang['font_large'] = 'Groß';
$lang['font_huge'] = 'Riesig';

$lang['Close_Tags'] = 'Tags schließen';
$lang['Styles_tip'] = 'Tipp: Styles können schnell zum markierten Text hinzugefügt werden.';

//
// CBACK SupportTicket System
//
$lang['cst_phpbbversion'] = 'Deine phpBB Version:';

$lang['cst_errmessage'] = 'Du hast keinen Titel für Deinen Post eingegeben! Bitte drücke die Zurück-Taste Deines Browsers um die falschen Angaben zu korrigieren!';
$lang['cst_phpbbtype'] = 'Typ Deines phpBB Forums:';
$lang['cst_standard'] = 'Standard phpBB ';
$lang['cst_premod'] = 'Integramod 132';
$lang['cst_premod1'] = 'Integramod 140';
$lang['cst_premod2'] = 'Integramod 141';
$lang['cst_anddist'] = 'phpBB / IMPortal';

$lang['cst_mods'] = 'Hast Du MODs (Modifikationen) zu Deinem Board hinzugef&uuml;gt?';
$lang['cst_yes'] = 'Ja';
$lang['cst_no'] = 'Nein';

$lang['cst_knowledge'] = 'Dein Wissensstand:';
$lang['cst_beginner'] = 'Einsteiger';
$lang['cst_basicknow'] = 'Grundwissen';
$lang['cst_extended'] = 'Fortgeschritten';
$lang['cst_profi'] = 'Profi';

$lang['cst_beforeerr'] = 'Was hast Du gemacht, bevor das Problem aufgetreten ist?';
$lang['cst_selfsolution'] = 'Was hast Du bereits versucht um das Problem zu lösen?';
$lang['cst_boardlink'] = 'Link zu Deinem Forum:';
$lang['cst_phpver'] = 'PHP Version:';
$lang['cst_sqlver'] = 'MySQL Version:';

$lang['cst_head_msg'] = 'Fehlerbeschreibung und Nachricht';
$lang['cst_optional'] = 'optional';
$lang['cst_head'] = 'Dieser Assistent hilft Dir, den Supportern alle notwendigen Informationen zu geben, die sie ben&ouml;tigen um Dir schnell und kompetent weiterzuhelfen. Bitte f&uuml;lle so viele Felder wie m&ouml;glich aus! Nur so kann Dir effizient geholfen werden!';
//
//
//

//
// Private Messaging
//
$lang['Private_Messaging'] = 'Private Nachrichten (PM)';

$lang['Login_check_pm'] = 'Einloggen, um private Nachrichten zu lesen';
$lang['New_pms'] = 'Du hast %d neue Nachrichten'; // You have 2 new messages
$lang['New_pm'] = 'Du hast 1 neue Nachricht'; // You have 1 new message
$lang['No_new_pm'] = 'Du hast keine neuen Nachrichten';
$lang['Unread_pms'] = 'Du hast %d ungelesene Nachrichten';
$lang['Unread_pm'] = 'Du hast 1 ungelesene Nachricht';
$lang['No_unread_pm'] = 'Du hast keine ungelesenen Nachrichten';
$lang['You_new_pm'] = 'Eine neue private Nachricht befindet sich in deinem Posteingang';
$lang['You_new_pms'] = 'Es befinden sich neue private Nachrichten in deinem Posteingang';
$lang['You_no_new_pm'] = 'Es sind keine neuen privaten Nachrichten vorhanden';

$lang['Unread_message'] = 'ungelesene Nachricht';
$lang['Read_message'] = 'gelesene Nachricht';

$lang['Read_pm'] = 'Nachricht lesen';
$lang['Post_new_pm'] = 'Nachricht schreiben';
$lang['Post_reply_pm'] = 'Auf Nachricht antworten';
$lang['Post_quote_pm'] = 'Nachricht zitieren';
$lang['Edit_pm'] = 'Nachricht bearbeiten';

$lang['Inbox'] = 'Posteingang';
$lang['Outbox'] = 'Postausgang';
$lang['Savebox'] = 'Archiv';
$lang['Sentbox'] = 'Gesendete Nachrichten';
$lang['Flag'] = 'Flag';
$lang['Subject'] = 'Titel';
$lang['From'] = 'Von';
$lang['To'] = 'An';
$lang['Date'] = 'Datum';
$lang['Mark'] = 'Markiert';
$lang['Sent'] = 'Gesendet';
$lang['Saved'] = 'Gespeichert';
$lang['Delete_marked'] = 'Markierte löschen';
$lang['Delete_all'] = 'Alle löschen';
$lang['Save_marked'] = 'Markierte speichern';
$lang['Save_message'] = 'Nachricht speichern';
$lang['Delete_message'] = 'Nachricht löschen';

$lang['Display_messages'] = 'Nachrichten anzeigen der letzten'; // Followed by number of days/weeks/months
$lang['All_Messages'] = 'Alle Nachrichten';

$lang['No_messages_folder'] = 'Es sind keine weiteren Nachrichten in diesem Ordner.';

$lang['PM_disabled'] = 'Private Nachrichten wurden in diesem Board deaktiviert.';
$lang['Cannot_send_privmsg'] = 'Der Administrator hat private Nachrichten für dich gesperrt.';
$lang['No_to_user'] = 'Du musst einen Benutzernamen angeben, um diese Nachricht zu senden.';
$lang['No_such_user'] = 'Es existiert kein Benutzer mit diesem Namen.';

$lang['Disable_HTML_pm'] = 'HTML in dieser Nachricht deaktivieren';
$lang['Disable_BBCode_pm'] = 'BBCode in dieser Nachricht deaktivieren';
$lang['Disable_Smilies_pm'] = 'Smilies in dieser Nachricht deaktivieren';

$lang['Message_sent'] = 'Deine Nachricht wurde gesendet.';

$lang['Click_return_inbox'] = 'Klick %shier%s um zum Posteingang zurückzukehren';
$lang['Click_return_index'] = 'Klick %shier%s um zum Index zurückzukehren';

$lang['Send_a_new_message'] = 'Neue Nachricht senden';
$lang['Send_a_reply'] = 'Auf private Nachricht antworten';
$lang['Edit_message'] = 'Private Nachricht bearbeiten';

$lang['Notification_subject'] = 'Eine neue private Nachricht ist eingetroffen!';

$lang['Find_username'] = 'Benutzernamen finden';
$lang['Find'] = 'Finden';
$lang['No_match'] = 'Keine Ergebnisse gefunden.';

$lang['No_post_id'] = 'Es wurde keine Beitrags-ID angegeben.';
$lang['No_such_folder'] = 'Es existiert kein solcher Ordner.';
$lang['No_folder'] = 'Kein Ordner ausgewählt';

$lang['Mark_all'] = 'Alle markieren';
$lang['Unmark_all'] = 'Markierungen aufheben';

$lang['Confirm_delete_pm'] = 'Diese Nachricht wirklich löschen?';
$lang['Confirm_delete_pms'] = 'Diese Nachrichten wirklich löschen?';

$lang['Inbox_size'] = 'Dein Posteingang ist zu %d%% voll'; // eg. Your Inbox is 50% full
$lang['Sentbox_size'] = 'Deine gesendeten Nachrichten sind zu %d%% voll';
$lang['Savebox_size'] = 'Dein Archiv ist zu %d%% voll';

$lang['Click_view_privmsg'] = 'Klick %shier%s, um deinen Posteingang aufzurufen';


//
// Profiles/Registration
//
$lang['Viewing_user_profile'] = 'Profil anzeigen : %s'; // %s is username
$lang['About_user'] = 'Alles über %s';

$lang['Preferences'] = 'Einstellungen';
$lang['Items_required'] = 'Mit * markierte Felder sind erforderlich';
$lang['Registration_info'] = 'Registrierungs-Informationen';
$lang['Profile_info'] = 'Profil-Informationen';
$lang['Profile_info_warn'] = 'Diese Informationen sind öffentlich abrufbar!';
$lang['Avatar_panel'] = 'Avatar-Steuerung';
$lang['Avatar_gallery'] = 'Avatar-Galerie';

$lang['Website'] = 'Website';
$lang['Location'] = 'Wohnort';
$lang['Contact'] = 'Kontakt';
$lang['Email_address'] = 'E-Mail-Adresse';
$lang['Email'] = 'E-Mail';
$lang['Send_private_message'] = 'Private Nachricht senden';
$lang['Hidden_email'] = '[ Versteckt ]';
//$lang['Search_user_posts'] = 'Nachrichten von diesem Benutzer anzeigen';
$lang['Interests'] = 'Interessen';
$lang['Occupation'] = 'Beruf';
$lang['Poster_rank'] = 'Rang';

$lang['Total_posts'] = 'Beiträge insgesamt';
$lang['User_post_pct_stats'] = '%.2f%% aller Beiträge'; // 1.25% of total
$lang['User_post_day_stats'] = '%.2f Beiträge pro Tag'; // 1.5 posts per day
$lang['Search_user_posts'] = 'Alle Beiträge von %s anzeigen'; // Find all posts by username

$lang['No_user_id_specified'] = 'Dieser Benutzer existiert nicht.';
$lang['Wrong_Profile'] = 'Du kannst nur dein eigenes Profil bearbeiten.';

$lang['Only_one_avatar'] = 'Es kann nur ein Avatar ausgewählt werden';
$lang['File_no_data'] = 'Die angegebene Datei enthält keine Daten';
$lang['No_connection_URL'] = 'Es konnte keine Verbindung zur angegebenen Datei hergestellt werden';
$lang['Incomplete_URL'] = 'Die angegebene URL ist unvollständig';
$lang['Wrong_remote_avatar_format'] = 'Das Format des Avatars ist nicht gültig';
$lang['No_send_account_inactive'] = 'Sorry, aber ein neues Passwort kann im Moment nicht gesendet werden, da dein Account derzeit noch inaktiv ist. Bitte kontaktiere den Administrator für weitere Informationen.';

$lang['Always_smile'] = 'Smilies immer aktivieren';
$lang['Always_spellcheck'] = 'Controleer altijd de Spelling voor plaatsen';
$lang['Always_html'] = 'HTML immer aktivieren';
$lang['Always_bbcode'] = 'BBCode immer aktivieren';
$lang['Always_add_sig'] = 'Signatur immer anhängen';
$lang['Always_notify'] = 'Bei Antworten immer benachrichtigen';
$lang['Always_notify_explain'] = 'Sendet dir eine E-Mail, wenn jemand auf einen deiner Beiträge antwortet. Kann für jeden Beitrag geändert werden.';

$lang['Board_style'] = 'Board-Style';
$lang['Board_lang'] = 'Board-Sprache';
$lang['No_themes'] = 'Keine Themes in der Datenbank';
$lang['Timezone'] = 'Zeitzone';
$lang['Date_format'] = 'Datums-Format';
$lang['Date_format_explain'] = 'Die Syntax ist identisch mit der PHP-Funktion <a href=\'http://www.php.net/date\' target=\'_other\'>date()</a>';
$lang['Signature'] = 'Signatur';
$lang['Signature_explain'] = 'Dies ist ein Text, der an jeden Beitrag von dir angehängt werden kann. Es besteht eine Limit von %d Buchstaben.';
$lang['Public_view_email'] = 'Zeige meine E-Mail-Adresse immer an';

$lang['Current_password'] = 'Altes Passwort';
$lang['New_password'] = 'Neues Passwort';
$lang['Confirm_password'] = 'Passwort bestätigen';
$lang['Confirm_password_explain'] = 'Du musst dein Passwort angeben, wenn du dein Passwort oder deine Mailadresse ändern möchtest.';

if($userdata['session_logged_in']){ 
    $lang['password_if_changed'] = 'You only need to supply a password if you want to change it'; 
    $lang['password_confirm_if_changed'] = 'You only need to confirm your password if you changed it above.'; 
} else { 
    $lang['password_if_changed'] = 'Remember it is CaSe SeNsItIvE.'; 
    $lang['password_confirm_if_changed'] = ''; 
} 


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
$lang['PS_security_force']			= 'Sorry, it appears this is your first visit since we added the security questions to accounts. You will only be able to view your profile until you update it and add a question and answer. Thanks!<br><br>Click <b><a href="profile.'. $phpEx .'?mode=register&sub=registering&sid='. $userdata['session_id'] .'">here</a></b> to goto your profile.';
$lang['PS_admin_one']				= 'Login Attempts';
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
$lang['PS_auto_message']			= 'It appears you have been banned from this website.  If this is a mistake or you are not sure why you are banned, please contact the board administrator.<br /><br /><b>Board Administrator:</b> ';
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
$lang['PS_cback']					= 'Sanity Mix Worm Attempt';
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
$lang['PS_list_four']				= 'Action to take in a <b>Sanity Mix Worm</b> attempt?';
$lang['PS_list_five']				= 'Action to take in an <b>SQL Injection</b> attempt?';
$lang['PS_list_six']				= 'Action to take in a <b>Perl Script</b> attempt?';
$lang['PS_list_seven']				= 'Action to take in an <b>Encoded Characters</b> attempt?';
$lang['PS_list_eight']				= 'Action to take in a <b>File Write/Open</b> attempt?';
$lang['PS_blocked_line']			= '<b>&nbsp;phpBB Security &copy;&nbsp;</b> Has Blocked %T% Exploit Attempts.';
$lang['PS_blocked_line2']			= '<a href="login_security.php?phpBBSecurity=caught" class="copyright">Protected</a> by phpBB Security © <a href="http://phpbb-amod.com" class="copyright" target="_blank">phpBB-Amod</a>';


#==== Added in 1.0.2
$lang['PS_die_msg_cookies']			= 'There is a cookie mis-match with your account. Please clear your cookies & log back in.';
$lang['PS_die_msg_banned']			= 'You have been banned from this site.';
$lang['PS_die_msg_ddos']			= 'You have been blocked because we think you are a DDoS attempt. If you are running a firewall or similar that can also cause this.';
$lang['PS_die_msg_encoded']			= 'You have been blocked because you have tried to pass encoded characters to this site &amp; that is a potential malicious attempt to gain un-authorized access.';
$lang['PS_die_msg_union']			= 'You have been blocked because you have tried to pass a union type script to this site &amp; that is a potential malicious attempt to gain un-authorized access.';
$lang['PS_die_msg_clike']			= 'You have been blocked because you have tried to a clike type script to this site &amp; that is a potential malicious attempt to gain un-authorized access.';
$lang['PS_die_msg_sql']				= 'You have been blocked because you have tried to an sql injection to this site &amp; that is a potential malicious attempt to gain un-authorized access.';
$lang['PS_die_msg_fwrite']			= 'You have been blocked because you have tried to pass a file write type script to this site &amp; that is a potential malicious attempt to gain un-authorized access.';
$lang['PS_die_msg_perl']			= 'You have been blocked because you have tried to pass a perl execution type script to this site &amp; that is a potential malicious attempt to gain un-authorized access.';
$lang['PS_die_msg_cback']			= 'You have been blocked because you have tried to pass a sanity mix worm type script to this site &amp; that is a potential malicious attempt to gain un-authorized access.';
$lang['PS_die_msg_agent']			= 'You have been blocked because your user agent matches one we have blocked.';
$lang['PS_die_msg_referer']			= 'You have been blocked because your referer matches one we have blocked.';
$lang['PS_die_msg_staff']			= 'You have been blocked because you have permission to be staff, but the admins did not grant you permission in the security panel.';

$lang['PS_die_msg_email']			= 'If you feel you have reached this message in an error due to the site, please contact the admin at %email%.';

$lang['PS_admin_submit']			= 'Save Configuration';
$lang['PS_admin_submit_special']	= 'Save Special Configuration';
$lang['PS_admin_config_saved']		= 'Configuration Updated.';
$lang['PS_admin_special_saved']		= 'Special Settings Updated.';
$lang['PS_return_config']			= 'Click %s<b>here</b>%s to return to the configuration page.';
$lang['PS_return_special']			= 'Click %s<b>here</b>%s to return to the special settings page.';
$lang['PS_admin_not_authed']		= 'Sorry, you\'re not authorized to view/change these settings.';
$lang['PS_admin_grant_access']		= 'Here you can select admins to grant them access to view this page.';
$lang['PS_admin_deny_access']		= 'Here you can select admins to deny them access to view this page.';
$lang['PS_block_agents']			= 'Block User Agents';
$lang['PS_block_agents_exp']		= 'You should know what you\'re doing before using this. An example of what you can do is add <b>Firefox</b> here, and anyone using a Firefox browser will be blocked.';
$lang['PS_unblock_agents']			= 'Un-Block User Agents';
$lang['PS_block_referers']			= 'Block Referers';
$lang['PS_block_referers_exp']		= 'You should know what you\'re doing before using this. An example of what you can do is add <b>search.yahoo.com</b> here, and anyone using that site to get to here will be blocked.';
$lang['PS_unblock_referers']		= 'Un-Block Referers';
$lang['PS_per_page']				= 'How many exploits per page to display on the caught page';
$lang['PS_ddos_level']				= 'DDoS Protection Level:';
$lang['PS_ddos_high']				= 'Strong';
$lang['PS_ddos_medium']				= 'Medium';
$lang['PS_ddos_low']				= 'Low';

$lang['PS_members_title']			= 'Below Will Dump A List Of Any Member Who Was Caught Trying To Exploit This Site.';
$lang['PS_members_pt_check']		= 'Checked [b]Site Posts[/b] Table, Result:';
$lang['PS_members_pt_check_yc']		= 'Posts Table Has Found Something:';
$lang['PS_members_pt_check_nc']		= 'The Posts Table Found No IP Matches.';
$lang['PS_user_exploits']			= 'Their Exploit Attempts';

$lang['PS_users_tries']				= '%N%\'s Exploit Attempts';
$lang['PS_users_id']				= 'Id';
$lang['PS_users_ip']				= 'Ip';
$lang['PS_users_link']				= 'Link';
$lang['PS_users_reason']			= 'Reason';
$lang['PS_users_date']				= 'Date';

$lang['PS_search_title']			= 'Search The Database';
$lang['PS_search_ip']				= 'Please enter an IP';
$lang['PS_search_submit']			= ' Begin Search ';
$lang['PS_search_partial']			= 'Partial Match';
$lang['PS_search_exact']			= 'Exact Match';
$lang['PS_search_unban']			= 'Unban This IP';
$lang['PS_search_banned']			= 'Currently Banned';

$lang['PS_backup_on']				= 'Daily Database Backup';
$lang['PS_backup_folder']			= 'Folder To Put Backups In';
$lang['PS_backup_folder_exp']		= 'This folder <b>MUST</b> be in your forum root directory, it <b>MUST</b> be <i>CHMOD</i> -> 777';
$lang['PS_backup_filename']			= 'Name To Use For DB Backups';
$lang['PS_backup_filename_exp']		= '<i>Example:</i> backup';
$lang['PS_backup_time']				= 'Time Every Day To Complete Backup';
$lang['PS_backup_total']			= 'Clean Avaliable Backups: %N%';
$lang['PS_backup_remove']			= 'Delete Backup File';

$lang['Avatar'] = 'Avatar';
$lang['Avatar_explain'] = 'Zeigt eine kleine Grafik neben deinen Details zu jedem deiner Beiträge an. Es kann immer nur ein Avatar angezeigt werden, seine Breite darf nicht größer als %d Pixel sein, die Höhe nicht größer als %d Pixel, und die Dateigröße darf maximal %d KB betragen.';
$lang['Upload_Avatar_file'] = 'Avatar von deinem Computer hochladen';
$lang['Upload_Avatar_URL'] = 'Avatar von URL hochladen';
$lang['Upload_Avatar_URL_explain'] = 'Gib die URL des gewünschten Avatars an, dieser wird dann kopiert';
$lang['Pick_local_Avatar'] = 'Avatar aus der Galerie auswählen';
$lang['Link_remote_Avatar'] = 'Zu einem externen Avatar linken';
$lang['Link_remote_Avatar_explain'] = 'Gib die URL des Avatars ein, der gelinkt werden soll';
$lang['Avatar_URL'] = 'URL des Avatars';
$lang['Select_from_gallery'] = 'Avatar aus der Galerie auswählen';
$lang['View_avatar_gallery'] = 'Galerie anzeigen';

$lang['Select_avatar'] = 'Avatar auswählen';
$lang['Return_profile'] = 'Avatar abbrechen';
$lang['Select_category'] = 'Kategorie auswählen';

$lang['Delete_Image'] = 'Bild löschen';
$lang['Current_Image'] = 'Aktuelles Bild';

$lang['Notify_on_privmsg'] = 'Bei neuen Privaten Nachrichten benachrichtigen';
$lang['Popup_on_privmsg'] = 'PopUp-Fenster bei neuen Privaten Nachrichten';
$lang['Popup_on_privmsg_explain'] = 'Einige Templates öffnen neue Fenster, um dich über neue private Nachrichten zu benachrichtigen.';
$lang['Hide_user'] = 'Online-Status verstecken';

$lang['Profile_updated'] = 'Dein Profil wurde aktualisiert';

$lang['Password_mismatch'] = 'Du musst zweimal das gleiche Passwort eingeben.';
$lang['Current_password_mismatch'] = 'Das aktuelle Passwort stimmt nicht mit dem in der Datenbank überein.';
$lang['Password_long'] = 'Dein Passwort kann nicht länger als 32 Zeichen sein.';
$lang['Username_taken'] = 'Der gewünschte Benutzername ist leider bereits belegt.';
$lang['Username_invalid'] = 'Der gewünschte Benutzername enthält ein ungültiges Sonderzeichen (z.B. \').';
$lang['Username_disallowed'] = 'Der gewünschte Benutzername wurde vom Administrator gesperrt.';
$lang['Username_numeric'] = 'Der gewünschte Benutzername kann nicht eine Zahl sein.';
$lang['Email_taken'] = 'Die angegebene Mailadresse wird bereits von einem anderen Benutzer verwendet.';
$lang['Email_banned'] = 'Die angegebene Mailadresse wurde vom Administrator gesperrt.';
$lang['Email_invalid'] = 'Die angegebene Mailadresse ist ungültig.';
$lang['Signature_too_long'] = 'Deine Signatur ist zu lang.';
$lang['Fields_empty'] = 'Du musst alle benötigten Felder ausfüllen.';
$lang['Avatar_filetype'] = 'Der Avatar muss im GIF-, JPG- oder PNG-Format sein.';
$lang['Avatar_filesize'] = 'Die Dateigröße muss kleiner als %d kB sein.'; // followed by xx kB, xx being the size
$lang['Avatar_imagesize'] = 'Der Avatar muss weniger als %d Pixel breit und %d Pixel hoch sein.';

$lang['Welcome_subject'] = 'Willkommen auf %s';
$lang['New_account_subject'] = 'Neuer Benutzeraccount';
$lang['Account_activated_subject'] = 'Account aktiviert';

$lang['Account_added'] = 'Danke für die Registrierung, dein Account wurde erstellt. Du kannst dich jetzt mit deinem Benutzernamen und deinem Passwort einloggen.';
$lang['Account_inactive'] = 'Dein Account wurde erstellt. Dieses Forum benötigt aber eine Aktivierung, daher wurde ein Activation-Key an deine E-Mail-Adresse gesendet. Bitte überprüfe deine Mailbox für weitere Informationen.';
$lang['Account_inactive_admin'] = 'Dein Account wurde erstellt. Dieser muss noch durch den Administrator freigeschaltet werden. Du wirst benachrichtigt, wenn dies geschehen ist.';
$lang['Account_active'] = 'Dein Account wurde aktiviert. Danke für die Registrierung.';
$lang['Account_active_admin'] = 'Dein Account wurde jetzt aktiviert.';
$lang['Reactivate'] = 'Account wieder aktivieren!';
$lang['Already_activated'] = 'Dein Account ist bereits aktiv';
$lang['COPPA'] = 'Dein Account wurde erstellt, muss aber zuerst überprüft werden. Mehr Details dazu wurden dir per E-Mail gesendet.';

$lang['Wrong_activation'] = 'Der Aktivierungsschlüssel aus dem Link stimmt nicht mit dem in der Datenbank überein. Bitte überprüfe die URL, und versuche es erneut.';
$lang['Send_password'] = 'Schickt mir ein neues Passwort.';
$lang['Password_updated'] = 'Ein neues Passwort wurde erstellt, es wurde eine E-Mail mit weiteren Anweisungen verschickt.';
$lang['No_email_match'] = 'Die angegebene E-Mail-Adresse stimmt nicht mit dem Benutzernamen überein.';
$lang['New_password_activation'] = 'Aktivierung des neuen Passwortes';
$lang['Password_activated'] = 'Dein Account wurde wieder aktiviert. Um dich einzuloggen, benutze das Passwort, welches du per E-Mail erhalten hast.';

$lang['Send_email_msg'] = 'E-Mail senden';
$lang['No_user_specified'] = 'Es wurde kein Benutzer ausgewählt';
$lang['User_prevent_email'] = 'Dieser Benutzer hat den E-Mail-Empfang deaktiviert. Bitte versuche es mit einer privaten Nachricht.';
$lang['User_not_exist'] = 'Dieser Benutzer existiert nicht.';
$lang['CC_email'] = 'Eine Kopie dieser E-Mail an dich senden';
$lang['Email_message_desc'] = 'Diese Nachricht wird als Text versendet, verwende bitte deshalb kein HTML oder BBCode. Als Antwort-Adresse der E-Mail wird deine Adresse angegeben.';
$lang['Flood_email_limit'] = 'Im Moment kannst du keine weiteren E-Mails versenden. Versuch es später noch einmal.';
$lang['Recipient'] = 'Empfänger';
$lang['Email_sent'] = 'E-Mail wurde gesendet';
$lang['Send_email'] = 'E-Mail senden';
$lang['Empty_subject_email'] = 'Du musst einen Titel für diese E-Mail angeben.';
$lang['Empty_message_email'] = 'Du musst einen Text zur E-Mail angeben.';


//
// Visual confirmation system strings
//
//$lang['Confirm_code_wrong'] = 'Der eingegebene Bestätigungs-Code war nicht richtig';
//$lang['Too_many_registers'] = 'Du hast die zulässige Zahl von Registrierungs-Versuchen für diese Sitzung überschritten. Bitte versuche es später erneut.';
//$lang['Confirm_code_impaired'] = 'Wenn du optisch beeinträchtigt bist oder aus einem anderen Grund den Code nicht lesen kannst, kontaktiere bitte den %sAdministrator%s für Hilfe.';
//$lang['Confirm_code'] = 'Bestätigungs-Code';
//$lang['Confirm_code_explain'] = 'Gebe den Code exakt so ein, wie du ihn siehst. Der Code unterscheidet zwischen Groß- und Kleinschreibung, die Null hat im Inneren einen schrägen Strich.';



//
// Memberslist
//
$lang['Select_sort_method'] = 'Sortierungs-Methode auswählen';
$lang['Sort'] = 'Sortieren';
$lang['Sort_Top_Ten'] = 'Top-Ten-Autoren';
$lang['Sort_Joined'] = 'Anmeldungsdatum';
$lang['Sort_Username'] = 'Benutzername';
$lang['Sort_Location'] = 'Ort';
$lang['Sort_Posts'] = 'Beiträge total';
$lang['Sort_Email'] = 'E-Mail';
$lang['Sort_Website'] = 'Website';
$lang['Sort_Ascending'] = 'Aufsteigend';
$lang['Sort_Descending'] = 'Absteigend';
$lang['Order'] = 'Ordnung';


//
// Group control panel
//
$lang['Remove_selected'] = 'Ausgewählte entfernen';
$lang['Add_member'] = 'Mitglied hinzufügen';
$lang['None'] = 'Keine';

//
// Search
//
$lang['Sort_by'] = 'Sortieren nach';

$lang['No_search_match'] = 'Keine Beiträge entsprechen deinen Kriterien.';
$lang['Close_window'] = 'Fenster schliessen';

//
// Auth related entries
//
// Note the %s will be replaced with one of the following 'user' arrays
$lang['Sorry_auth_announce'] = 'Ankündigungen können in diesem Forum nur von %s erstellt werden.';
$lang['Sorry_auth_sticky'] = 'Wichtige Nachrichten können in diesem Forum nur von %s erstellt werden.';
$lang['Sorry_auth_read'] = 'Nur %s haben die Berechtigung, in diesem Forum Beiträge zu lesen.';
$lang['Sorry_auth_post'] = 'Nur %s haben die Berechtigung, in diesem Forum Beiträge zu erstellen.';
$lang['Sorry_auth_reply'] = 'Nur %s haben die Berechtigung, in diesem Forum auf Beiträge zu antworten.';
$lang['Sorry_auth_edit'] = 'Nur %s haben die Berechtigung, in diesem Forum Beiträge zu bearbeiten.';
$lang['Sorry_auth_delete'] = 'nur %s haben die Berechtigung, in diesem Forum Beiträge zu löschen.';
$lang['Sorry_auth_vote'] = 'In diesem Forum können sich nur %s an Abstimmungen beteiligen.';

// These replace the %s in the above strings
$lang['Auth_Anonymous_Users'] = '<b>anonyme Benutzer</b>';
$lang['Auth_Registered_Users'] = '<b>registrierte Benutzer</b>';
$lang['Auth_Users_granted_access'] = '<b>Benutzer mit speziellen Rechten</b>';
$lang['Auth_Moderators'] = '<b>Moderatoren</b>';
$lang['Auth_Administrators'] = '<b>Administratoren</b>';

$lang['Not_Moderator'] = 'Du bist nicht Moderator dieses Forums.';
$lang['Not_Authorised'] = 'Nicht berechtigt';
$lang['Admin_reauthenticate'] = 'To administer the board you must re-authenticate yourself.';

$lang['You_been_banned'] = 'Du wurdest von diesem Forum verbannt.<br />Kontaktiere den Administrator, um mehr Informationen zu erhalten.';


//
// Viewonline
//
$lang['Online_explain'] = 'Diese Daten zeigen an, wer in den letzten 5 Minuten online war.';
//
$lang['Forum_Location'] = 'Welche Seite';
$lang['Last_updated'] = 'Zuletzt aktualisiert';
//
$lang['Forum_index'] = 'Forum-Index';
$lang['Logging_on'] = 'Einloggen';
$lang['Viewing_profile'] = 'Profil anzeigen';

//
// Moderator Control Panel
//

$lang['Select'] = 'Auswählen';
$lang['Move'] = 'Verschieben';
$lang['Lock'] = 'Sperren';
$lang['Unlock'] = 'Entsperren';

$lang['Topics_Moved'] = 'Die gewählten Themen wurden verschoben.';

//
// Timezones ... for display on each page
//
$lang['All_times'] = 'Alle Zeiten sind %s'; // eg. All times are GMT - 12 Hours (times from next block)

$lang['-12'] = 'GMT - 12 Stunden';
$lang['-11'] = 'GMT - 11 Stunden';
$lang['-10'] = 'GMT - 10 Stunden';
$lang['-9'] = 'GMT - 9 Stunden';
$lang['-8'] = 'GMT - 8 Stunden';
$lang['-7'] = 'GMT - 7 Stunden';
$lang['-6'] = 'GMT - 6 Stunden';
$lang['-5'] = 'GMT - 5 Stunden';
$lang['-4'] = 'GMT - 4 Stunden';
$lang['-3.5'] = 'GMT - 3.5 Stunden';
$lang['-3'] = 'GMT - 3 Stunden';
$lang['-2'] = 'GMT - 2 Stunden';
$lang['-1'] = 'GMT - 1 Stunden';
$lang['0'] = 'GMT';
$lang['1'] = 'GMT + 1 Stunde';
$lang['2'] = 'GMT + 2 Stunden';
$lang['3'] = 'GMT + 3 Stunden';
$lang['3.5'] = 'GMT + 3.5 Stunden';
$lang['4'] = 'GMT + 4 Stunden';
$lang['4.5'] = 'GMT + 4.5 Stunden';
$lang['5'] = 'GMT + 5 Stunden';
$lang['5.5'] = 'GMT + 5.5 Stunden';
$lang['6'] = 'GMT + 6 Stunden';
$lang['6.5'] = 'GMT + 6.5 Stunden';
$lang['7'] = 'GMT + 7 Stunden';
$lang['8'] = 'GMT + 8 Stunden';
$lang['9'] = 'GMT + 9 Stunden';
$lang['9.5'] = 'GMT + 9.5 Stunden';
$lang['10'] = 'GMT + 10 Stunden';
$lang['11'] = 'GMT + 11 Stunden';
$lang['12'] = 'GMT + 12 Stunden';
$lang['13'] = 'GMT + 13 Stunden';

// These are displayed in the timezone select box
$lang['tz']['-12'] = 'GMT - 12 Stunden';
$lang['tz']['-11'] = 'GMT - 11 Stunden';
$lang['tz']['-10'] = 'GMT - 10 Stunden';
$lang['tz']['-9'] = 'GMT - 9 Stunden';
$lang['tz']['-8'] = 'GMT - 8 Stunden';
$lang['tz']['-7'] = 'GMT - 7 Stunden';
$lang['tz']['-6'] = 'GMT - 6 Stunden';
$lang['tz']['-5'] = 'GMT - 5 Stunden';
$lang['tz']['-4'] = 'GMT - 4 Stunden';
$lang['tz']['-3.5'] = 'GMT - 3.5 Stunden';
$lang['tz']['-3'] = 'GMT - 3 Stunden';
$lang['tz']['-2'] = 'GMT - 2 Stunden';
$lang['tz']['-1'] = 'GMT - 1 Stunden';
$lang['tz']['0'] = 'GMT';
$lang['tz']['1'] = 'GMT + 1 Stunde';
$lang['tz']['2'] = 'GMT + 2 Stunden';
$lang['tz']['3'] = 'GMT + 3 Stunden';
$lang['tz']['3.5'] = 'GMT + 3.5 Stunden';
$lang['tz']['4'] = 'GMT + 4 Stunden';
$lang['tz']['4.5'] = 'GMT + 4.5 Stunden';
$lang['tz']['5'] = 'GMT + 5 Stunden';
$lang['tz']['5.5'] = 'GMT + 5.5 Stunden';
$lang['tz']['6'] = 'GMT + 6 Stunden';
$lang['tz']['6.5'] = 'GMT + 6.5 Stunden';
$lang['tz']['7'] = 'GMT + 7 Stunden';
$lang['tz']['8'] = 'GMT + 8 Stunden';
$lang['tz']['9'] = 'GMT + 9 Stunden';
$lang['tz']['9.5'] = 'GMT + 9.5 Stunden';
$lang['tz']['10'] = 'GMT + 10 Stunden';
$lang['tz']['11'] = 'GMT + 11 Stunden';
$lang['tz']['12'] = 'GMT + 12 Stunden';
$lang['tz']['13'] = 'GMT + 13 Stunden';

$lang['datetime']['Sunday'] = 'Sonntag';
$lang['datetime']['Monday'] = 'Montag';
$lang['datetime']['Tuesday'] = 'Dienstag';
$lang['datetime']['Wednesday'] = 'Mittwoch';
$lang['datetime']['Thursday'] = 'Donnerstag';
$lang['datetime']['Friday'] = 'Freitag';
$lang['datetime']['Saturday'] = 'Samstag';
$lang['datetime']['Sun'] = 'So';
$lang['datetime']['Mon'] = 'Mo';
$lang['datetime']['Tue'] = 'Di';
$lang['datetime']['Wed'] = 'Mi';
$lang['datetime']['Thu'] = 'Do';
$lang['datetime']['Fri'] = 'Fr';
$lang['datetime']['Sat'] = 'Sa';
$lang['datetime']['January'] = 'Januar';
$lang['datetime']['February'] = 'Februar';
$lang['datetime']['March'] = 'März';
$lang['datetime']['April'] = 'April';
$lang['datetime']['May'] = 'Mai';
$lang['datetime']['June'] = 'Juni';
$lang['datetime']['July'] = 'Juli';
$lang['datetime']['August'] = 'August';
$lang['datetime']['September'] = 'September';
$lang['datetime']['October'] = 'Oktober';
$lang['datetime']['November'] = 'November';
$lang['datetime']['December'] = 'Dezember';
$lang['datetime']['Jan'] = 'Jan';
$lang['datetime']['Feb'] = 'Feb';
$lang['datetime']['Mar'] = 'März';
$lang['datetime']['Apr'] = 'Apr';
$lang['datetime']['May'] = 'Mai';
$lang['datetime']['Jun'] = 'Jun';
$lang['datetime']['Jul'] = 'Jul';
$lang['datetime']['Aug'] = 'Aug';
$lang['datetime']['Sep'] = 'Sep';
$lang['datetime']['Oct'] = 'Okt';
$lang['datetime']['Nov'] = 'Nov';
$lang['datetime']['Dec'] = 'Dez';

// calendar pcp stuff
$lang['Sunday'] = 'Sonntag';
$lang['Monday'] = 'Montag';

//
// Photo Album Addon v2.x.x by Smartor
//
$lang['Album'] = 'Album';
$lang['Personal_Gallery_Of_User'] = 'Personal Gallery of %s';

//
// Errors (not related to a
// specific failure on a page)
//
$lang['Information'] = 'Information';
$lang['Critical_Information'] = 'Kritische Information';

$lang['General_Error'] = 'Allgemeiner Fehler';
$lang['Critical_Error'] = 'Kritischer Fehler';
$lang['An_error_occured'] = 'Ein Fehler ist aufgetreten.';
$lang['A_critical_error'] = 'Ein kritischer Fehler ist aufgetreten.';

$lang['Topic_description'] = 'Description of your topic';
$lang['Description'] = 'Topic Description';

// 
// Begin Approve_Posts_Mod Block : 22
// 

//stuff user sees
$lang['approve_topic_has_awaiting'] = 'Topic has posts awaiting approval';
$lang['approve_topic_is_awaiting'] = 'Topic is awaiting approval';
$lang['approve_post_is_awaiting'] = 'Post is awaiting approval';

$lang['approve_posts_error_obtain'] = 'Could not obtain forum approval information';
$lang['approve_posts_error_delete'] = 'Could not delete forum approval information';
$lang['approve_posts_error_insert'] = 'Could not insert forum approval information';

$lang['approve_notify_subject'] = 'Approve Post';
$lang['approve_notify_link'] = 'There is a new post awaiting moderator approval. To view this post click here: ';
$lang['approve_notify_approve_link'] = 'To approve this post click here: ';
$lang['approve_notify_message'] = 'The message has been included below.';
$lang['approve_notify_message_exceeded'] = '...post continued';
$lang['approve_notify_poster'] = '*** This post will be moderated upon posting and unviewable until approved. ***';
$lang['approve_notify_user_link'] = 'Your post has been approved. To view this post, click here:';
$lang['approve_notify_user_topic'] = 'All posts of yours in this topic have been approved.';
$lang['approve_notify_auto_app'] = 'Auto-Approval Notification.';
$lang['approve_notify_auto_app_msg'] = 'You are now being automatically approved while posting in moderated forums.';
$lang['approve_notify_auto_app_rem'] = 'Auto-Approval Removal Notification.';
$lang['approve_notify_auto_app_rem_msg'] = 'You are no longer being automatically approved while posting in moderated forums.';
$lang['approve_notify_moderation'] = 'Moderation Notification.';
$lang['approve_notify_moderation_msg'] = 'You are now being moderated while posting in moderated forums.';
$lang['approve_notify_moderation_rem'] = 'Moderation Removal Notification.';
$lang['approve_notify_moderation_rem_msg'] = 'You are no longer being moderated while posting in moderated forums.';
$lang['approve_notify_post_approved'] = 'Your post has been approved!.';

$lang['approve_topic_all_current'] = 'Approve all current posts in this topic';
$lang['approve_topic_all_future'] = 'Auto-Approve all future posts in this topic';
$lang['approve_topic_all_future_rem'] = 'Remove Auto-Approve of all future posts in this topic';
$lang['approve_topic_moderate'] = 'Moderate this topic and all future replies';
$lang['approve_topic_moderate_rem'] = 'Remove topic moderation';
$lang['approve_post_approve'] = 'Approve this post';
$lang['approve_topic_approve'] = 'Approve this topic';
$lang['approve_user_auto_approve'] = 'Auto-Approve this user';
$lang['approve_user_auto_approve_rem'] = 'Remove Auto-Approve';
$lang['approve_user_moderate'] = 'Moderate this user';
$lang['approve_user_moderate_rem'] = 'Remove Moderation';

//stuff admin sees
$lang['approve_admin_enable'] = 'Enable Approval System:';
$lang['approve_admin_posts'] = 'Approve Posts';
$lang['approve_admin_users_enable'] = 'Moderate:';
$lang['approve_admin_users_all'] = 'All Users & Topics';
$lang['approve_admin_users_mod'] = 'Selected Users & Topics only';
$lang['approve_admin_posts_topics'] = 'Moderate on:';
$lang['approve_admin_posts_enable'] = 'New Posts';
$lang['approve_admin_poste_enable'] = 'Post edits';
$lang['approve_admin_topics_enable'] = 'New Topics';
$lang['approve_admin_topice_enable'] = 'Topic edits';
$lang['approve_admin_hide_topics_enable'] = 'Hide Unapproved Topics:';
$lang['approve_admin_hide_posts_enable'] = 'Hide Unapproved Posts:';
$lang['approve_admin_button_find'] = 'Find Users';
$lang['approve_admin_button_add'] = 'Add User';
$lang['approve_admin_button_rem'] = 'Remove User';
$lang['approve_admin_moderators'] = 'Moderator(s):';
$lang['approve_admin_forums'] = 'Forums';
$lang['approve_admin_users'] = 'Users';
$lang['approve_admin_author'] = 'Author';
$lang['approve_admin_subject'] = 'Subject';
$lang['approve_admin_empty'] = '--empty--';
$lang['approve_admin_remove'] = 'remove';
$lang['approve_admin_approve'] = 'approve';
$lang['approve_admin_add_approved_submit'] = 'Auto-Approve';
$lang['approve_admin_add_moderated_submit'] = 'Moderate';
$lang['approve_admin_page'] = 'Page: ';
$lang['approve_admin_remove_moderation'] = 'Remove Moderation';
$lang['approve_admin_remove_approval'] = 'Remove Approval';

//Admin menu titles moved to lang_admin.php'; 

$lang['approve_admin_notify_user_enable'] = 'PM User on Approval:';
$lang['approve_admin_notify_admin_enable'] = 'Moderator Notification:';
$lang['approve_admin_notify_type'] = 'Notify Via: ';
$lang['approve_admin_notify_pm_enable'] = 'Private Message';
$lang['approve_admin_notify_email_enable'] = 'E-Mail';
$lang['approve_admin_notify_message_enable'] = 'Include Post in Notification: ';
$lang['approve_admin_notify_message_length'] = 'Max Length (0 = all)';
$lang['approve_admin_notify_posts_topics'] = 'Notify on:';
$lang['approve_admin_notify_posts_enable'] = 'New posts';
$lang['approve_admin_notify_poste_enable'] = 'Post edits';
$lang['approve_admin_notify_topics_enable'] = 'New Topics';
$lang['approve_admin_notify_topice_enable'] = 'Topic edits';
$lang['approve_admin_notify_user_invalid'] = 'Please go back and edit your entry.<br/>The following user user is invalid: ';
$lang['approve_admin_notify_user_empty'] = 'Please go back and edit your entry.<br/>You must choose at least one moderator to notify.';

$lang['approve_admin_username'] = 'Username';
$lang['approve_admin_users_moderated_users'] = 'Moderated Users';
$lang['approve_admin_users_auto_approved'] = 'Auto-Approved Users';
$lang['approve_admin_users_of'] = 'Users <b>%d</b>-<b>%d</b> of <b>%d</b>'; // Replaces with: Users 1-2 of 2 for example
$lang['approve_admin_users_id_remove_error'] = 'The chosen user id is invalid.';
$lang['approve_admin_users_moderation_removed'] = 'The user "%s" has been removed from moderation.';
$lang['approve_admin_users_approval_removed'] = 'The user "%s" has been removed from auto-approval.';
$lang['approve_admin_users_approval_added'] = 'The user "%s" has been added to auto-approval.';
$lang['approve_admin_users_moderated_added'] = 'The user "%s" has been added to moderation.';
$lang['approve_admin_add_approved_user'] = 'Add Auto-Approved User';
$lang['approve_admin_add_moderated_user'] = 'Add Moderated User';

$lang['approve_admin_topics_title'] = 'Topic Title';
$lang['approve_admin_approve_topic'] = 'Approve Topic';
$lang['approve_admin_topics_moderated_topics'] = 'Moderated Topics';
$lang['approve_admin_topics_awaiting'] = 'Topics Awaiting Approval';
$lang['approve_admin_topics_auto_approved'] = 'Auto-Approved Topics';
$lang['approve_admin_topics_of'] = 'Topics <b>%d</b>-<b>%d</b> of <b>%d</b>'; // Replaces with: Topics 1-2 of 2 for example
$lang['approve_admin_topics_id_remove_error'] = 'The chosen topic id is invalid.';
$lang['approve_admin_topics_moderation_removed'] = 'The topic "%s" has been removed from moderation.';
$lang['approve_admin_topics_approval_removed'] = 'The topic "%s" has been removed from auto-approval.';
$lang['approve_admin_topics_approval_added'] = 'The topic "%s" has been added to auto-approval.';
$lang['approve_admin_topics_moderated_added'] = 'The topic "%s" has been added to moderation.';
$lang['approve_admin_topics_approved'] = 'The topic "%s" has been approved.';

$lang['approve_admin_approve_post'] = 'Approve Post';
$lang['approve_admin_posts_awaiting'] = 'Posts Awaiting Approval';
$lang['approve_admin_posts_of'] = 'Posts <b>%d</b>-<b>%d</b> of <b>%d</b>'; // Replaces with: Posts 1-2 of 2 for example
$lang['approve_admin_posts_id_remove_error'] = 'The chosen post id is invalid.';
$lang['approve_admin_posts_approved'] = 'The post "%s" by "%s" has been approved.'; //Replaces with: The post "blah" by "mr.man" has been approved.

$lang['approve_admin_forums_moderated'] = 'Forums Under Moderation';
$lang['approve_admin_Stored_replacement'] = $lang['Stored'] . '<br/><br/> It will become viewable as soon as a moderator approves of it. <br/> Please do not submit your message more than once.';
// 
// End Approve_Posts_Mod Block : 22
//

$lang['Home'] = 'Home';

// Start add - Fully integrated shoutbox MOD
$lang['Shoutbox'] = 'Shoutbox';
$lang['Shoutbox_date'] = ' d m Y h:i:s';
$lang['Shout_censor'] = 'shout removed !';
$lang['Shout_refresh'] = 'Refresh';
$lang['Shout_text'] = 'Your text';
$lang['Viewing_Shoutbox']= 'Viewing shoutbox';
$lang['Censor'] ='Censor';
$lang['This_posts_IP'] = 'IP address of this message';
$lang['Other_IP_this_user'] = 'Other IP addresses of this user';
$lang['Users_this_IP'] = 'Users using this IP address';
$lang['IP_info'] = 'IP Information';
$lang['Lookup_IP'] = 'Search IP address';
$lang['Disable_HTML_post'] = 'Disable HTML in this message';
$lang['Disable_BBCode_post'] = 'Disable BBCode in this message';
$lang['Disable_Smilies_post'] = 'Disable Smilies in this post';
$lang['Smilies'] = 'Smilies';

// End add - Fully integrated shoutbox MOD

$lang['Message_preview'] = 'Message Received Preview';

// Start add - Yellow card admin MOD
$lang['Rules_ban_can'] = 'You <b>can</b> ban other users in this forum'; 
$lang['Rules_greencard_can'] = 'You <b>can</b> un-ban users in this forum'; 
$lang['Rules_bluecard_can'] = 'You <b>can</b> report post to moderators in this forum'; 

$lang['Viewing_RULES'] = 'Viewing the Rules';
$lang['Forum_Rules'] = 'Rules';

$lang['cookies_link'] = 'MyCookies Manager';

// RATING MOD
$lang['Rating'] = 'Rating';
$lang['No_rating'] = 'No rating';
$lang['Ratings_by'] = 'Posts rated by %s';
$lang['Rated_posts_by'] = 'Posts by %s that have been rated';
$lang['Latest_ratings'] = 'Latest ratings';
$lang['Highest_ranked_topics'] = 'Highest-ranked topics';
$lang['Highest_ranked_posts'] = 'Highest-ranked posts';
$lang['Highest_ranked_posters'] = 'Highest-ranked posters';

$lang['Staff'] = 'Staff Site';

//
// Bookmark Mod
//
$lang['More_bookmarks'] = 'More bookmarks...'; // For mozilla navigation bar

//-----------------------------------------------------------------------------
// MOD: Delayed Topics
$lang['Delayed_Post_Alt'] = 'Delayed Topic (due %s)';	// %s replaced by delivery date
$lang['Sorry_auth_delayedpost'] = 'Sorry but only %s can post delayed topics';

// MOD: Delayed Topics {end}
//-----------------------------------------------------------------------------
// Logo Selector MOD
$lang['Logo_settings'] = 'Logo Setting';
$lang['Logo_explain'] = 'Here you can set the folder path to your forum logos, the logo to be used and it\'s display height and width.';
$lang['Logo_path'] = 'Logo Storage Path';
$lang['Logo_path_explain'] = 'Path under your phpBB root dir, e.g. images/logo';
$lang['Logo'] = 'Choose a Logo';
$lang['Logo_dimensions'] = 'Logo Dimensions';
$lang['Logo_dimensions_explain'] = '(Height x Width in pixels) ';
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
$lang['LW_USER_ACCT_ERROR'] = 'Member with ID = %d doesnot exist.';
$lang['LW_WELCOME_REGISTERED'] = 'Thank you for registering. Your account has been created.';
$lang['LW_TRANSACTION_RECORDS'] = 'Transactions';
$lang['LW_EXPIRE_MEMBER_REMINDER'] = 'Your membership will be expired on <b>%s</b>';
$lang['LW_EXPIRE_TRIAL_REMINDER'] = 'Your trial period has <b>%d</b> day(s) left';
$lang['LW_WELCOME_REGIST_TRIAIL'] = 'Welcome %s, now you can surf our website for %d day(s) trial period. <br>After that if you want to continue accessing all our services, you will need to pay us subscription fee %s.';
$lang['LW_AMOUNT_TO_PAY_EXPLAIN'] = 'Upon confirmation of payment you will receive access to all the forums, be listed in the directory.';
$lang['LW_TRIAL_PERIOD'] = 'The trial period for member to access your site, <br>based on days, greater or equal to zero: ';
$lang['LW_OUR_SUBSCRIPTION_FEE'] = 'Subscription fee: ';
$lang['LW_OUR_PAYPAL_CURRENCY_CODE'] = 'The currency code your PayPal account supported: ';
$lang['LW_OUR_PAYPAL_ACCT'] = 'Your PayPal account to receive payment from members: ';
$lang['LW_PAYPAL_ACCT_SETTINGS_TITLE'] = 'PayPal IPN Settings';
$lang['LW_ACCT_DISPLAY_FROM'] = 'Display transaction records for last: ';
$lang['LW_ALL_RECORDS'] = 'All Records';
$lang['LW_NO_RECORDS'] = 'There is no record';
$lang['LW_ACCT_CREDIT'] = 'Credit';
$lang['LW_ACCT_DEBIT'] = 'Debit';
$lang['NP_DATE'] = 'Date';
$lang['LW_ACCT_CURRENCY'] = 'Currency';
$lang['LW_ACCT_AMOUNT'] = 'Amount';
$lang['LW_ACCT_PLUS_MINUS'] = 'Credit / Debit';
$lang['LW_ACCT_TXNID'] = 'PayPal TXN ID';
$lang['LW_ACCT_STATUS'] = 'Status';
$lang['LW_ACCT_COMMENT'] = 'Remarks';
$lang['LW_NO_PRIVILEGE'] = 'You donot have the privilege to view this page.';
$lang['LW_Click_view_ACCT_RECORDS'] = 'Click %shere%s to view your acount transaction records';
$lang['LW_PAYMENT_DONE'] = 'Payment for subscription fee done successfully.';
$lang['LW_PAYMENT_PENDDING'] = 'Thank you! Your payment is still pendding, your account will be automatically upgraded after our administrator accept your payment. <br>The notice of acceptance of the payment will be sent to your following email account: %s by PayPal.';
$lang['LW_PAYMENT_DENIED'] = 'Payment from your account is denied, please contact our administrator if you have any question.';
$lang['LW_PAYMENT_FAILED'] = 'Payment from your account failed, please try again later.';
$lang['LW_UPDATE_USER_ACCT_ERROR'] = 'Update member account error, please contact our administrator.';
$lang['LW_AMOUNT_TO_PAY'] = 'Amount to pay: ';
$lang['LW_ACCT_DEPOSIT_INTO'] = 'Payment';
$lang['LW_TOPUP_CONFIRM_TITLE'] = 'Confirm Your Payment';
$lang['Account_not_exist_lw'] = 'The account you specified doesnot exist.';
$lang['Account_activated_lw'] = 'Your account has already been set to access all forums.';
$lang['Click_return_login_lw'] = 'Click %sHere%s to login now.';
$lang['Click_return_activate_lw'] = 'Click %shere%s to pay subscription fee to upgrade your account.';
$lang['Disabled_account_lw'] = 'Your account has not been activated.';
$lang['LW_PAYPAL_ACCT_ERROR'] = 'Website PayPal account has not been set up to receive funds, please contact our administrator to report this issue.';
$lang['LW_PAYMENT_DATA_ERROR'] = 'The amount of subscription fee is wrong.';
$lang['LW_YOU_ARE_VIP'] = 'Welcome %s, you are our <b>VIP</b>.';
$lang['L_LW_PAYMENTS'] = 'Subscription';
$lang['LW_LOGIN_TO_PAY'] = 'Please login with your account name and password, you will be re-directed to payment page if you have not done so. Thanks!';
$lang['LW_PAY_FOR_WHICH_MONTH'] = 'For subscription from <b>%s</b> to <b>%s</b>';
///
$lang['Sorry_auth_paid_read'] = 'Sorry, but only <b>paid members</b> can read topics in this forum.'; 
$lang['LW_Welcome_Nopaid_Member'] = 'Welcome %s, you are our common member.'; 
$lang['Sorry_auth_paid_post'] = 'Sorry, but only <b>paid members</b> can post topics in this forum.'; 
$lang['L_LW_PAID_GROUP_NAME'] = 'The group name for paid member to join: '; 
$lang['LW_SELECT_A_GROUP'] = 'Please select a group to join'; 
$lang['L_LW_GROUP_TO_PAY'] = 'The group you want to join: '; 
$lang['LW_TOPUP_TITLE'] = 'Join Payment-Group';
$lang['L_LW_GROUP_DESCRIPTION'] = 'Group Description: ';
$lang['L_LW_FOR_JOIN_GROUP'] = 'to join group: ';
$lang['L_LW_FOR_UPGRADE_GROUP'] = 'to upgrade to group: ';
$lang['L_LW_FOR_EXTEND_GROUP'] = 'to extend membership in group: ';
$lang['L_LW_USER_EXTEND_SAME_GROUP'] = 'You are going to extend your current membership.';
$lang['L_LW_USER_JOIN_GROUP'] = 'You are going to subscribe this group.';
$lang['L_LW_USER_UPGRADE_GROUP'] = 'You are going to upgrade your current membership.';
$lang['L_LW_USER_DOWNGRADE_GROUP'] = 'You cannot downgrade your membership, please wait your current membership to expire.';
$lang['L_LW_UPGRADE_REMIND'] = 'Subscription Detailes: ';
///
$lang['Click_return_subscribe_lw'] = 'Click %shere%s to select a group to join. You will need to pay a subscription fee.';
$lang['L_LW_GROUP_ALREADY_JOIN'] = 'The group you are currently in: '; 
$lang['L_LW_GROUP_VIEW_DETAIL'] = 'View this group subscription detailes: '; 
$lang['LW_PAYMENT_SUBSCRIPTION'] = 'Your group subscription has been submitted.'; 
///
$lang['LW_ANONYMOUS_DONOR'] = 'Anonymous';
$lang['LW_MORE_DONORS'] = 'View All Donors';
$lang['LW_CURRENT_DONORS'] = 'View Donors For Current Goal';
$lang['L_LW_LAST_DONORS'] = 'Last %s Donors';
$lang['L_LW_TOP_DONORS_TITLE'] = 'Top %s Donors';
$lang['L_LW_DONORS_NAME'] = 'Donor\'s Name';
$lang['LW_DONORS_DISPLAY_FROM'] = 'Display donors for last: ';
$lang['LW_NO_DONORS_YET'] = 'Currently no donor yet';
$lang['LW_WE_HAVE_COLLECT'] = 'We have collected <b>%.2f</b> out of our goal of <b>%s</b>.';
$lang['LW_WANT_ANONYMOUS'] = 'I want to be anonymous.';
$lang['L_LW_DONATE_WAY'] = 'Your status as donor: ';
$lang['LW_DONATION_TO_POINTS'] = 'Thanks for your donation! In return, we are glad to increase your total points by %d';
$lang['LW_DONATION_TO_WHO'] = 'Donate to %s , Thanks!';
$lang['LW_DONATE_TITLE'] = 'Donation';
$lang['LW_AMOUNT_TO_DONATE'] = 'Amount to donate: ';
$lang['LW_AMOUNT_TO_DONATE_EXPLAIN'] = 'Thanks for your donation, it will greatly help us to support our members better. Thanks!';
$lang['LW_DONATE_CONFIRM_TITLE'] = 'Confirm Your Donate Amount';
$lang['LW_ACCT_DONATE_INTO'] = 'Donate';
$lang['LW_DONATE_DONE'] = 'Thank you for your donation. It will help us to bring better service to our valued members.';
$lang['LW_DONATE_PENDDING'] = 'Thank you for your donation. It will help us to bring better service to our valued members.';
$lang['LW_DONATE_DENIED'] = 'Sorry donation is denied for some reason, please contact our administrator if you have any question. Thanks!';
$lang['LW_DONATE_FAILED'] = 'Donation failed, please try again later. Thanks!';
$lang['LW_ACCT_DONATE_US'] = 'Donate';
$lang['LW_CURRENCY_TO_PAY'] = 'Select the currency type: ';
$lang['LW_CURRENCY_TO_PAY_EXPLAIN'] = 'Currently we only accpet %s.';
$lang['LW_PAYMENT_DATA_ERROR'] = 'The amount or the currency you entered is wrong.';
$lang['LW_DONATION_TO_POSTS'] = 'Thanks for your donation! In return, we are glad to increase your total posts count by %d';
$lang['LW_DONATION_TO_HELP'] = 'Please help us to develop!';
$lang['L_LW_MONEY'] = 'Money donated'; 
$lang['L_LW_DATE'] = 'Date donated';
$lang['LW_DONATE_EXPLAIN'] = 'Click here to support us'; 
///
// Please note: %sHERE%s is used to dynamically building the A HREF tag, do not remove the percent signs (%) around HERE!
$lang['dhtml_faq_noscript'] = "It appears that your browser does not support javascript or it has been disabled in your browser's settings.<br /><br />Please, click %sHERE%s to view a plain HTML version of this FAQ.";
// added by edwin :: required fields
$lang['Required_force']	= 'Sorry, it appears this is your first visit since we added some required fields to the system. <br />Once you update the fields marked with %s, you will be able to enjoy the whole site. <br />Thanks!<br /> <br />Click on the fieldnames below to complete them:<br />%s';
// added by edwin :: registration
$lang['Profile_updated_inactive'] = 'Your profile has been updated. However, you have changed vital details, thus your account is now inactive. Check your e-mail to find out how to reactivate your account.';
$lang['Profile_updated_inactive_admin'] = 'Your profile has been updated. However, you have changed vital details, thus your account is now inactive. Wait for the administrator to reactivate it.';
$lang['Click_return_portal'] = 'Click %sHere%s to return to the Portal';
$lang['PS_security_a_exp_empty'] = 'This answer will be hashed once submitted, so no one can know it but you. Please remember or write this down as you might need it again and it cannot be changed.';
$lang['PS_security_a_exp_submitted'] = 'This is the hashed version of your answer you submitted before, so no one can know it but you. If you want to change it, you will have to contact the admin of this site.';

// BEGIN Style Select MOD
$lang['Style_select_manage'] = 'Style select manage';
$lang['Style_select_explain'] = 'Using this facility you can manage style select info table';
$lang['Style_select_author'] = 'Author';
$lang['Style_select_version'] = 'Version';
$lang['Style_select_website'] = 'Web Site';
$lang['Style_select_viewings'] = 'Viewings';
$lang['Style_select_dlurl'] = 'File URL';
$lang['Style_select_dls'] = 'Download Total';
$lang['Style_select_loaclurl'] = 'Localization URL';
$lang['Style_select_ludls'] = 'Localization Download Total';
$lang['Click_return_style_sel_admin'] = 'Click %sHere%s to return to Style Select Administration';
$lang['Style_select_update'] = 'Data was successfully updated';
// END Style Select MOD

// FIND - newsfeeds
$lang['Check_All'] = 'Select All';
$lang['UnCheck_All'] = 'De-Selecte All';
$lang['News_Read_More'] = 'Read more...';
$lang['News_source'] = 'Source: ';
// end FIND - newsfeeds

$lang['Portal'] = 'Portal';

$lang['By'] = 'von'; // picture {By} user :: Topic {By} user
$lang['Country'] = 'Land';

$lang['No_r_click'] = 'Kein Rechtes Klicken Wird Erlaubt'; 
$lang['No_copy'] = 'Copy Wird Nicht Erlaubt';
//+MOD: DHTML Collapsible Forum Index MOD
$lang['CFI_options'] = "C.F.I.";
$lang['CFI_options_ex'] = "Collapsible Forum Index Options";
$lang['CFI_close'] = "Close";
$lang['CFI_delete'] = "Delete Saved State";
$lang['CFI_restore'] = "Restore Saved State";
$lang['CFI_save'] = "Save State";
$lang['CFI_Expand_all'] = "Expand All";
$lang['CFI_Collapse_all'] = "Collapse All";
//-MOD: DHTML Collapsible Forum Index MOD
//
// That's all, Folks!
// -------------------------------------------------

?>