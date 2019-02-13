<?php
/**************************************************************
*
*  MOD Title:   Complete banner
*  MOD Version: 1.2.0.
*  Translation: English
*  Rev date:    10/12/2003
*
*  Translator:  Niels < ncr@db9.dk > (Niels Chr. Rød) http://mods.db9.dk
*
***************************************************************/

// this is the text showen in admin panel, depending on your template layout,
// you may change the text, so this reflect the placement in the templates
// these are only exampels, you may add more or remove some of them.

$lang['Banner_spot']['0'] = "Kopf-Banner"; // used for {BANNER_0_IMG} tag in the template files
$lang['Banner_spot']['1'] = "Oben links 1"; // used for {BANNER_1_IMG} tag in the template files
$lang['Banner_spot']['2'] = "Oben links 2"; // used for {BANNER_2_IMG} tag in the template files
$lang['Banner_spot']['3'] = "Oben mitte 1"; // used for {BANNER_3_IMG} tag in the template files
$lang['Banner_spot']['4'] = "Oben mitte 2"; // used for {BANNER_4_IMG} tag in the template files
$lang['Banner_spot']['5'] = "Oben rechts 1"; // used for {BANNER_5_IMG} tag in the template files
$lang['Banner_spot']['6'] = "Oben rechts 2"; // used for {BANNER_6_IMG} tag in the template files
$lang['Banner_spot']['7'] = "Unten links 1"; // used for {BANNER_7_IMG} tag in the template files
$lang['Banner_spot']['8'] = "Unten links 2"; // used for {BANNER_8_IMG} tag in the template files
$lang['Banner_spot']['9'] = "Unten mitte 1"; // used for {BANNER_9_IMG} tag in the template files
$lang['Banner_spot']['10'] = "Unten mitte 2"; // used for {BANNER_10_IMG} tag in the template files
$lang['Banner_spot']['11'] = "Unten rechts 1"; // used for {BANNER_11_IMG} tag in the template files
$lang['Banner_spot']['12'] = "Unten rechts 2"; // used for {BANNER_12_IMG} tag in the template files
$lang['Banner_spot']['13'] = "Forumansicht oben"; // used for {BANNER_13_IMG} tag in the template files
$lang['Banner_spot']['14'] = "Themenansicht oben"; // used for {BANNER_14_IMG} tag in the template files
$lang['Banner_spot']['15'] = "Themenansicht unten"; // used for {BANNER_15_IMG} tag in the template files
$lang['Banner_spot']['16'] = "Portal Oben"; // used for {BANNER_16_IMG} tag in the template files
$lang['Banner_spot']['17'] = "Portal Unten"; // used for {BANNER_17_IMG} tag in the template files
$lang['Banner_spot']['18'] = "Index Oben"; // used for {BANNER_18_IMG} tag in the template files
$lang['Banner_spot']['19'] = "Index Unten"; // used for {BANNER_19_IMG} tag in the template files
$lang['Banner_spot']['20'] = "Portal Link Block 1"; // used for {BANNER_20_IMG} tag in the template files
$lang['Banner_spot']['21'] = "Portal Link Block 2"; // used for {BANNER_21_IMG} tag in the template files
$lang['Banner_spot']['22'] = "Portal Link Block 3"; // used for {BANNER_22_IMG} tag in the template files
$lang['Banner_spot']['23'] = "Portal Link Block 4"; // used for {BANNER_23_IMG} tag in the template files

//
// please do not modify the text below (except if you are translating)
//
$lang['Banner_title'] = "Banner Administration";
$lang['Banner_text'] = "Hier kannst du deine Banner verwalten und sie zu einer bestimmten Zeit einblenden lassen.";
$lang['Add_new_banner'] = "Neuer Banner";
$lang['Banner_add_text'] = "Hier kannst du einen Banner hinzufügen oder bearbeiten";

$lang['Banner_example']="Beispiel";
$lang['Banner_example_explain'] ="Dies solte wie die Banneranzeige sein";
$lang['Banner_type_text'] = "Art";
$lang['Banner_type_explain'] = "Wähle die Art des Banners";
//pre-defined types
$lang['Banner_type'][0] = "Banner-Bild Link";
$lang['Banner_type'][2] = "Text link";
$lang['Banner_type'][4] = "Kunde HTML code";
$lang['Banner_type'][6] = "Flash Datei";

$lang['Banner_name'] = "Bild Pfad/Text/Code";
$lang['Banner_name_explain'] = "Der Pfad muss der Relativepfad zum phpbb2 sein oder die gesamte URL (mit http://)";
$lang['Banner_size'] = "Bildgröße";
$lang['Banner_size_explain'] = "Wenn das Bild bereits die optimale Größe hat, geben sie eine 0 ein. - Angaben in Pixel";
$lang['Banner_width'] = "Breite";
$lang['Banner_height'] = "Höhe";

$lang['Banner_activated'] = "Aktiviert";
$lang['Banner_activate'] = "Banner aktivieren";
$lang['Banner_comment'] = "Komentar";
$lang['Banner_description'] = "Bildbeschreibung";
$lang['Banner_description_explain'] = "Dieser Text erscheind wenn du die Maus über das Banner hältst.";
$lang['Banner_url'] = "Url weiterleiten";
$lang['Banner_url_explain'] ="Die url zu der bei Mausklick weitergeleitet werden soll, beginnt mit HTTP://<br />(Die Umleitung ist nur aktiviert wenn es eine Bild- oder Textlink ist.)";
$lang['Banner_owner']="Moderator des Banner";
$lang['Banner_owner_explain']="Dieser Bunutzer darf das Banner verwalten - (not implemented jet)";
$lang['Banner_placement'] = "Plazierung";
$lang['Banner_clicks'] = "Klicks";
$lang['Banner_clicks_explain'] = "(Die Zählung ist nur aktiviert wenn es eine Bild- oder Textlink ist.)";
$lang['Banner_view'] = "Aufrufe";
$lang['Banner_weigth'] = "Einblendung des Banner";
$lang['Banner_weigth_explain'] = "Wie offt dieser Banner sichtbar sein soll, verglichen mit anderen aktiven Bannern zur gegenwärtigen Zeit. (1-99)";
$lang['Show_to_users'] ='Sichtbar für User';
$lang['Show_to_users_explain'] ='Wähle welcher Typ von Benutzer dieses Banner sehen soll';
$lang['Show_to_users_select'] = 'Benutzer kann %s zu einen %s sein'; //%s are supstituded with dropdown selections
$lang['Banner_level']['-1'] = 'Gast';
$lang['Banner_level']['0'] = 'Registrierte';
$lang['Banner_level']['1'] = 'Moderator';
$lang['Banner_level']['2'] = 'Admin';
$lang['Banner_level_type']['0'] = 'gleichrangig';
$lang['Banner_level_type']['1'] = 'mindestens oder gleichrangig';
$lang['Banner_level_type']['2'] = 'höher oder gleichranging';
$lang['Banner_level_type']['3'] = 'nichts';

$lang['Time_interval'] = "Zeitintervall";
$lang['Time_interval_explain'] = "Wende nur ein Datum, einen Tag der Woche oder/und eine Zeit aus";
$lang['Start'] = "Start";
$lang['End'] = "Ende";
$lang['Year'] = "Jahr";
$lang['Month'] = "Monat";
$lang['Date'] = "Date";
$lang['Weekday'] = "Wochentag";
$lang['Hour'] = "Stunde";
$lang['Min'] = "Minute";
$lang['Time_type'] = "Zu welcher Zeit";
$lang['Time_type_explain'] = "Wählen Sie, ob es ein Zeitintervall oder ein Datumsintervall ist <i>(Du kannst immer noch ein Zeitintervall anwenden, wenn du die Datums Regel wählst)</i>";
$lang['Not_specify'] = "Nicht angegeben";
$lang['No_time'] = "Keine Zeit";
$lang['By_time'] = "Nach Zeit";
$lang['By_week'] = "Nach Wochentag";
$lang['By_date'] = "Nach Datum";

// messages
$lang['Missing_banner_id'] = "Die ID vom Banner fehlt";
$lang['Missing_banner_owner'] = "Du must einen Bannereigentümer wählen";
$lang['Missing_time'] = "Wenn du einen Banner definierst der zu einer bestimmten Zeit laufen soll, musst du das Zeitintervall festlegen";
$lang['Missing_date'] = "Wenn du einen Banner definierst der an einen bestimmten Tag laufen soll, musst du das Datumsintervall festlegen";
$lang['Missing_week'] ="Wenn du einen Banner definierst der an einen Wochentag laufen soll, musst du das Wochentagintervall festlegen";

$lang['Banner_removed'] = "Das Banner wurde gelöscht";
$lang['Banner_updated'] = "Das Banner wurde geändert";
$lang['Banner_added'] = "Das Banner wurde hinzugefügt";
$lang['Click_return_banneradmin'] = 'Klick %sHier%s um zur Banner Administration zurück zukehren';

$lang['No_redirect_error'] = 'Wenn du nicht automatisch weitergeleitet wirst, klick bitte <b><a href="%s" id="jumplink" name="jumplink">hier<a></b> um zurück zukehren';
$lang['Left_via_banner'] = 'Links über Banner';

$lang['Banner_filter'] = 'Bannerfilter';
$lang['Banner_filter_explain'] = 'Verstecken Sie dieses Banner nach dem User ihn geklickt haben';
$lang['Banner_filter_time'] = 'Inaktive Klickzeit';
$lang['Banner_filter_time_explain'] = 'Zahl der Sek. nach die das Banner noch sichtbar sein soll, nachdem ein User drauf geklickt hat wenn der Bannerfilter aktiviert ist.';

?>