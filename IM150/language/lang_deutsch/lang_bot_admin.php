<?php

/***************************************************************************
 *                        lang_bot_admin.php 
 *                        --------------------
 *   begin                : Thursday, June 03, 2004
 *   copyright            : (C) 2004 Adam Marcus
 *   email                : adam_marcus@btinternet.com
 *
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

// übersetzt von clanpunisher
$lang['Manage_Bots'] = "Bots organisieren";
$lang['Bot_Explain'] = "Bots (auch Crawlers genannt) sind Programme die für Suchmaschinen Informationen sammeln und diese indizieren. Leider gibt es auch einige Bots die keine sessions unterstützen, so dass es vorkommen kann, dass die Webseite nicht richtig indiziert wird. Um das Problem zu umgehen kannst du hier diesen Bots eine session zu weisen lassen.";

$lang['Pending_Bots'] = "Schwebende Bots";
$lang['Pending_Explain'] = "Nachstehend aufgeführte Benutzer, sind Benutzer die den BOT-Kriterien teilweise, jedoch nicht im vollen Umfang entsprachen. Mit anderen Worten gab es entweder eine Übereinstimmung im Benutzer-Agenten oder bei der IP. Diese Unstimmigkeiten sind neben dem BOT-Namem zu sehen. Du kannst hier bestimmen ob diese Unstimmkeiten als Teil der BOT-Kriterien aufgelistet oder ob diese ignoriert werden sollen.";

$lang['Bot_Ip_Or_Agent'] = "BOT-IP/Agent";
$lang['Bot_Name'] = "BOT-Name";
$lang['Bots'] = "BOTS"; 
$lang['Agent_Match'] = "Agent-Treffer";
$lang['Bot_Ip'] = "BOT-IP";

$lang['Last_Visit'] = "Letzter Besuch";
$lang['Visits'] = "Besuche";
$lang['Pages'] = "Seiten";
$lang['Never'] = "Nie";
$lang['Options'] = "Optionen";
$lang['Result'] = "Ergebnis";
$lang['Ok'] = "Ok";
$lang['Mark'] = "Markiere";
$lang['Ignore'] = "Ignorire";
$lang['Add'] = "Hinzufügen";

$lang['Submit'] = "Senden";
$lang['Delete'] = "Löschen";
$lang['Reset'] = "Zurücksetzen";
$lang['Edit'] = "Bearbeiten";

$lang['ip'] = "IP";
$lang['agent'] = "Agent";

$lang['No_Bots'] = "Sorry, aber derzeit sind noch keine Bots in der Datenbank eingetragen!";
$lang['No_Pending_Bots'] = "Sorry, es gibt derzeit keine benutzbare Bots in der Datenbank!";
$lang['Bot_Added_Or_Modified'] = "BOT Informationen wurden erfolgreich hinzugefügt/ignoriert."; 
$lang['Bot_Result_Explain'] = "Hier kannst du das Resultat deiner Frage sehen.";
$lang['Bot_Settings_Changed'] = "BOT Einstellungen wurde erfolgreich geändert/hinzugefügt.";

$lang['Bot_Edit_Or_Add_Explain'] = "Hier kannst du eine BOT-Eintragung hinzufügen oder bearbeiten. Du kannst entweder einen passenden Benutzer-Agent oder ein IP-Raum bestimmen.";
$lang['Bot_Name_Explain'] = "Nur für deinen Gebrauch.";
$lang['Bot_Agent_Explain'] = "Ein passender Benutzer-Agent. Teilweise übereinstimmende werden erlaubt. Trenne die Agenten mit einem einzelnen '|'.";
$lang['Bot_Ip_Explain'] = "Ähnliche Treffer sind erlaubt. Trenne die IP-Adressen mit einem einzelnen '|'.";

$lang['Error_No_Agent_Or_Ip'] = "Du hast keinen gültigen Bot-IP/Agent angegeben.";
$lang['Error_No_Bot_Name'] = "Du hast keinen BOT-Namen angegeben.";

?>