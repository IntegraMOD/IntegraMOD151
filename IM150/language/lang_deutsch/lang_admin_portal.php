<?php
/***************************************************************************
 *                       lang_admin_portal.php [German]
 *                            -------------------
 *   begin                : Saturday, July 10, 2004
 *   copyright            : (C) 2004 masterdavid - Ronald John David
 *   website              : http://www.integramod.com
 *   email                : webmaster@integramod.com
 *
 *   note: removing the original copyright is illegal even you have modified
 *         the code.  Just append yours if you have modified it.
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/
//übersetzt von clanpunisher
//
// IM Portal http://www.integramod.com
//
$lang['BP_Title'] = 'Blockposition per Tag bestimmen';
$lang['BP_Explain'] = 'Auf dieser Seite kannst du Blockpositionen hinzufügen, bearbeiten oder löschen die vom IM Portal ausgeführt werden sollen.  Die Standard Positionen der Blöcke sind \'header\', \'footer\', \'right\' und \'center\'.  Diese Positionen beziehen sich auf das Layout einer bestimmten Portalseite. Nur bereits vorhandene Positionen pro Portalseite, dürfen hier hinzugefügt werden. Positions-Tags die nicht in dem bestimmten Layout vorkommen, werden auch nicht auf der Portalseite dargstellt. Jeder Positions-Tag und Positions-Zeichen müssen auf jeder Portalseite eindeutig sein.';
$lang['BP_Position'] = 'Positions-Zeichen';
$lang['BP_Key'] = 'Positions-Tag';
$lang['BP_Layout'] = 'Portalseite';
$lang['BP_Add_Position'] = 'Eine neue Position hinzufügen';
$lang['No_bp_selected'] = 'Keine Position zum bearbeiten ausgewählt';
$lang['BP_Edit_Position'] = 'Bearbeite Blockposition';
$lang['Must_enter_bp'] = 'Du musst ein Positions-Tag, Positions-Zeichen und die dazugehörige Portalseite angeben.';
$lang['BP_updated'] = 'Blockposition aktualsiert';
$lang['BP_added'] = 'Blockposition hinzugefügt';
$lang['Click_return_bpadmin'] = 'Klick %shier%s um zu der Administration der Block Positionen zurückzukehren';
$lang['BP_removed'] = 'Blockposition gelöscht';
$lang['Portal_wide'] = 'Portal übergreifend';

$lang['No_layout_selected'] = 'Keine Portalseite zum bearbeiten ausgewählt';
$lang['Layout_Title'] = 'Portalseite';
$lang['Layout_Explain'] = 'Auf dieser Seite kannst du Informationen zum Layout deiner Portalseite hinzufügen, bearbeiten oder löschen. Mehrere Portalseiten können das gleiche Layout benutzen. Die ausgewählte Layout-Template-Datei muss im Layout Verzeichnis unter deinem Forum-Template-Verzeichnis befinden. Du solltest unter gar keinen Umständen die Standard Portalseite löschen. Das löschen einer Portalseite, löscht alle dazugehörigen Blockpositionen und alle Blöcke die im Zusammenhang mit der Portalseite stehen.';
$lang['Layout_Name'] = 'Name';
$lang['Layout_Template'] = 'Template-Datei';
$lang['Layout_Edit'] = 'Bearbeite Portalseite';
$lang['Layout_Page'] = 'Seiten ID';
$lang['Layout_View'] = 'Betrachtet von';
$lang['Layout_Forum_wide'] = 'Forum-übergreifende Blöcke?';
$lang['Must_enter_layout'] = 'Du musst einen Namen und eine Template-Datei angeben';
$lang['Layout_updated'] = 'Portalseite wurde aktualsisert';
$lang['Click_return_layoutadmin'] = 'Klicke %shier%s um zu der Administration der Portalseite zurückzukehren';
$lang['Layout_added'] = 'Portalseite wurde hinzugefügt';
$lang['Layout_removed'] = 'Portalseite wurde gelöscht';
$lang['Layout_Add'] = 'Portalseite hinzufügen';
$lang['Layout_BP_added'] = 'Layout-Konfigurations-Datei vorhanden: Block Positions-Tags wurden automatisch eingetragen';
$lang['Layout_default'] = 'Standard';
$lang['Layout_make_default'] = 'Als Standard definieren';

$lang['Blocks_Title'] = 'Konfiguration der Blöcke';
$lang['Blocks_Explain'] = 'Auf dieser Seite kannst du Blöcke für jede einzelne Portalseite hinzufügen, bearbeiten, verschieben oder löschen. Das Block-Template muss für jede Block-Datei die hinzugefügt werden soll, vorhanden sein. Wenn eine Block-Datei ausgewählt wurde, wird das Inhalts-Feld von IM Portal nicht beachtet.';
$lang['Choose_Layout'] = 'Portalseite auswählen';
$lang['B_Title'] = 'Block Titel';
$lang['B_Position'] = 'Block Position';
$lang['B_Active'] = 'Aktiv?';
$lang['B_Display'] = 'Inhalt';
$lang['B_HTML'] = 'HTML';
$lang['B_BBCode'] = 'BBCode';
$lang['B_Type'] = 'Typ';
$lang['B_Border'] = 'Rahmen anzeigen';
$lang['B_Titlebar'] = 'Titel anzeigen';
$lang['B_Background'] = 'Hintergrund anzeigen';
$lang['B_Local'] = 'Titel lokalisieren';
$lang['B_Cache'] = 'Cache?';
$lang['B_Cachetime'] = 'Cache Dauer';
$lang['B_Groups'] = 'Benutzergruppen';
$lang['B_All'] = 'Alle';
$lang['B_Guests'] = 'Nur Gäste';
$lang['B_Reg'] = 'Registrierte Benutzer';
$lang['B_Mod'] = 'Moderatoren';
$lang['B_Admin'] = 'Administratoren';
$lang['B_None'] = 'Keiner';
$lang['B_Layout'] = 'Portalseite';
$lang['B_Page'] = 'Seiten ID';
$lang['B_Add'] = 'Blöcke hinzufügen';
$lang['Yes'] = 'Ja';
$lang['No'] = 'Nein';
$lang['B_Text'] = 'Text';
$lang['B_File'] = 'Block-Datei';
$lang['B_Move_Up'] = 'Nach oben';
$lang['B_Move_Down'] = 'Nach unten';
$lang['B_View'] = 'Betrachtet von';
$lang['No_blocks_selected'] = 'Keinen Block ausgewählt';
$lang['B_Content'] = 'Inhalt';
$lang['B_Blockfile'] = 'Block-Datei';
$lang['Block_Edit'] = 'Block bearbeiten';
$lang['Block_updated'] = 'Block aktualsiert';
$lang['Must_enter_block'] = 'Du musst einen Titel für den Block angeben';
$lang['Block_added'] = 'Block hinzugefügt';
$lang['Click_return_blocksadmin'] = 'Klicke %shier%s um zu der Konfiguration der Blöcke zurückzukehren';
$lang['Block_removed'] = 'Block gelöscht';
$lang['B_BV_added'] = 'Block Konfigurations-Datei vorhanden: Block Variablen wurde automatisch eingetragen';

$lang['BV_Title'] = 'Blocks Variablen';
$lang['BV_Explain'] = 'Auf dieser Seite kannst du Block Variablen die in den Blöcken von IM Portal verwendet werden hinzufügen, bearbeiten oder löschen. Diese Variablen können dann auf der Portal Konfigurations-Seite auf dein Portal angepasst werden.';
$lang['BV_Label'] = 'Feld Name';
$lang['BV_Sub_Label'] = 'Feld Info';
$lang['BV_Name'] = 'Konfig. Name';
$lang['BV_Options'] = 'Optionen';
$lang['BV_Values'] = 'Feld Werte';
$lang['BV_Type'] = 'Kontroltyp';
$lang['BV_Block'] = 'Block';
$lang['BV_Add_Variable'] = 'Block Variable hinzufügen';
$lang['No_bv_selected'] = 'Keine Block Variable ausgewählt';
$lang['BV_Edit_Variable'] = 'Block Variable bearbeiten';
$lang['Must_enter_bv'] = 'Du musst einen Feld Namen und einen Konfig. Namen angeben';
$lang['BV_updated'] = 'Block Variable aktualisiert';
$lang['BV_added'] = 'Block Variable hinzugefügt';
$lang['Click_return_bvadmin'] = 'Klicke %shier%s um zu der Administration der Block Variable zurückzukehren';
$lang['Config_Name_Explain'] = 'Es darf kein Leerraum vorhanden sein';
$lang['Field_Options_Explain'] = 'Zwingend erforderlich für die Dropdown Liste und<br />radio buttons (Komma begrentzt).';
$lang['Field_Values_Explain'] = 'Zwingend erforderlich für die Dropdown Liste und<br />radio buttons (Komma begrentzt).';
$lang['BV_removed'] = 'Block-Variablen gelöscht';
 
$lang['Config_updated'] = 'Portal Konfiguration aktualisiert';
$lang['Click_return_config'] = 'Klicke %shier%s um zu der Portal Konfiguration zurückzukehren';
$lang['Portal_Config'] = 'IM Portal Konfiguration';
$lang['Portal_Explain'] = 'Auf dieser Seite kannst du alle nötigen Einstellungen die für dein Portal benötigt werden bearbeiten. Die hier aufgelisteten Block Variablen können erstellt/aktualisiert werden auf der Block Variablen Konfigurations-Seite.';
$lang['Portal_General_Config'] = 'Allgemeine Einstellungen';
$lang['Default_Portal'] = 'Standard Portalseite';
$lang['Default_Portal_Explain'] = 'Homepage des Forums';
$lang['Cache_Enabled'] = 'Aktviere Caching';
$lang['Cache_Enabled_Explain'] = 'Für das schnellere Laden Portalbezogener Informationen';
$lang['Portal_Header'] = 'Aktviere System übergreifenden Portal header';
$lang['Portal_Header_Explain'] = 'Zeige immer das linke Block Panel';
$lang['Portal_Tail'] = 'Aktviere System übergreifenden Portal footer';
$lang['Portal_Tail_Explain'] = 'Zeige immer das rechte Block Panel';
$lang['Confirm_delete_item'] = 'Bist du dir sicher, dass du diese Artikel löschen möchtest?';
$lang['Cache_cleared'] = 'Cache Dateien gelsöcht';

$lang['bbcode_b_help'] = 'Text (fett): [b]text[/b]  (alt+b)';
$lang['bbcode_i_help'] = 'Text (kursiv): [i]text[/i]  (alt+i)';
$lang['bbcode_u_help'] = 'Text (unterstrichen): [u]text[/u]  (alt+u)';
$lang['bbcode_q_help'] = 'Text (zitieren): [quote]text[/quote]  (alt+q)';
$lang['bbcode_c_help'] = 'Code anzeigen: [code]code[/code]  (alt+c)';
$lang['bbcode_l_help'] = 'Liste: [list]text[/list] (alt+l)';
$lang['bbcode_o_help'] = 'Liste sortieren: [list=]text[/list]  (alt+o)';
$lang['bbcode_p_help'] = 'Bild eintragen: [img]http://image_url[/img]  (alt+p)';
$lang['bbcode_w_help'] = 'URL eintragen: [url]http://url[/url] oder [url=http://url]URL text[/url]  (alt+w)';
$lang['bbcode_a_help'] = 'Alle offenen bbCode-tags schliessen';
$lang['bbcode_s_help'] = 'Schriftfarbe: [color=red]Rot[/color]  Hinweis: Du kannst den Farbwert auch als HEXwert eintragen, z.b. color=#FF0000';
$lang['bbcode_f_help'] = 'Schriftgrösse: [size=x-small]Kleine Schriftgrösse[/size]';

$lang['Emoticons'] = 'Emoticons';
$lang['More_emoticons'] = 'Mehr Emoticons anzeigen';

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
$lang['color_white'] = 'Weiss';
$lang['color_black'] = 'Schwarz';

$lang['Font_size'] = 'Font size';
$lang['font_tiny'] = 'Winzig';
$lang['font_small'] = 'Klein';
$lang['font_normal'] = 'Normal';
$lang['font_large'] = 'Gross';
$lang['font_huge'] = 'Riesig';

$lang['Close_Tags'] = 'Tags schliessen';
$lang['Styles_tip'] = 'Hinweis: Styles können auf den ausgewählten Text schnell angewedet werden .';
?>