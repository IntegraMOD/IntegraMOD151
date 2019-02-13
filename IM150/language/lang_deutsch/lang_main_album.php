<?php
/***************************************************************************
 *                          lang_main_album.php [English]
 *                              -------------------
 *     begin                : Sunday, February 02, 2003
 *     copyright            : (C) 2003 Smartor
 *     email                : smartor_xp@hotmail.com
 *
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

//--- Multiple File Upload mod : begin
//--- version : 1.0.3
include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_multiple_album.' . $phpEx);
//--- Multiple File Upload mod : end

$lang['PICVIEWPREVIOUS'] = '&laquo; Previous';
$lang['PICVIEWALBUMNEXT'] = 'Next &raquo;';

//
// Album Index
//übersetzt von clanpunisher
$lang['Photo_Album'] = 'Foto Album';
$lang['Pics'] = 'Fotos';
$lang['Last_Pic'] = 'Letztes Bild';
$lang['Public_Categories'] = 'Allgemeine Kategorien';
$lang['No_Pics'] = 'Keine Fotos';
$lang['Users_Personal_Galleries'] = 'Benutzer-Galerien';
$lang['Your_Personal_Gallery'] = 'Deine eigene Galerie';
$lang['Recent_Public_Pics'] = 'Neue öffentliche Fotos';

$lang['Poster'] = 'Poster';
$lang['Posted'] = '<b>Posted</b>';
$lang['View'] = 'Ansehen';

//
// Category View
//
$lang['Category_not_exist'] = 'Diese Kategorie existiert nicht!';
$lang['Upload_Pic'] = 'Foto Upload';
$lang['Pic_Title'] = 'Foto Titel';

$lang['Album_upload_can'] = '<b>Berechtigt für:</b> Bilderupload in diese Kategorie';
$lang['Album_upload_cannot'] = '<b>Nicht berechtigt für:</b> Bilderupload in diese Kategorie';
$lang['Album_rate_can'] = '<b>Berechtigt für:</b> Bilder in dieser Kategorie bewerten';
$lang['Album_rate_cannot'] = '<b>Nicht berechtigt für:</b> Bilder in dieser Kategorie bewerten';
$lang['Album_comment_can'] = '<b>Berechtigt für:</b> Kommentar zu diesem Bild abgeben';
$lang['Album_comment_cannot'] = '<b>Nicht berechtigt für:</b> Kommentar zu diesem Bild abgeben';
$lang['Album_edit_can'] = '<b>Berechtigt für:</b> Eigene Bilder und Kommentare in dieser Kategorie bearbeiten';
$lang['Album_edit_cannot'] = '<b>Nicht berechtigt für:</b> Eigene Bilder und Kommentare in dieser Kategorie bearbeiten';
$lang['Album_delete_can'] = '<b>Berechtigt für:</b> Eigene Bilder und Kommentare in dieser Kategorie löschen';
$lang['Album_delete_cannot'] = '<b>Nicht berechtigt für:</b> Eigene Bilder und Kommentare in dieser Kategorie löschen';
$lang['Album_moderate_can'] = '<b>Berechtigt für:</b> %smoderate%s diese Kategorie ?????????';

$lang['Edit_pic'] = 'Bearbeiten';
$lang['Delete_pic'] = 'löschen';
$lang['Rating'] = 'Bewertung';
$lang['Comments'] = 'Kommentare';
$lang['New_Comment'] = 'Neuer Kommentar';

$lang['Not_rated'] = '<i>nicht bewertet</i>';

//
// Upload
//
$lang['Pic_Desc'] = 'Bildbeschreibung';
$lang['Plain_text_only'] = 'Nur Text';
$lang['Max_length'] = 'Max Länge in (bytes)';
$lang['Upload_pic_from_machine'] = 'Lade ein Bild hoch';
$lang['Upload_to_Category'] = 'Lade es in die Kategorie';
$lang['Upload_thumbnail_from_machine'] = 'Lade das passende Thumbnail hoch (muss der gleiche Dateityp wie das Bild sein)';
$lang['Upload_thumbnail'] = 'Thumbnail Upload';
$lang['Upload_thumbnail_explain'] = 'Es muss der gleich Dateityp gewählt werden';
$lang['Thumbnail_size'] = 'Thumbnailgrösse in (pixel)';
$lang['Filetype_and_thumbtype_do_not_match'] = 'Dein Bild und das Thumbnail müssen vom gleichen Dateityp sein';

$lang['Upload_no_title'] = 'Du musst einen Titel für das Bild angeben';
$lang['Upload_no_file'] = 'Du musst einen Pfad und einen Dateinamen eingeben';
$lang['Desc_too_long'] = 'Deine Beschreibung ist zu lang';

$lang['Max_file_size'] = 'Maximale Dateigrösse in (bytes)';
$lang['Max_width'] = 'Maximale Bildbreite in (pixel)';
$lang['Max_height'] = 'Maximale Bildhöhe in (pixel)';

$lang['JPG_allowed'] = 'Berechtigt JPG Dateien hochzuladen';
$lang['PNG_allowed'] = 'Berechtigt PNG Dateien hochzuladen';
$lang['GIF_allowed'] = 'Berechtigt GIF Dateien hochzuladen';

$lang['Album_reached_quota'] = 'Diese Kategorie hat die Bilderquote erreicht. Jetzt kannst du keine Bilder mehr hochladen. Für Fragen wende dich an die Administratoren';
$lang['User_reached_pics_quota'] = 'Du hast deine Bilderquote erreicht. Jetzt kannst du keine Bilder mehr hochladen. Für Fragen wende dich an die Administratoren';

$lang['Bad_upload_file_size'] = 'Die hochgelade Datei ist zu gross oder beschädigt';
$lang['Not_allowed_file_type'] = 'Der Dateityp ist nicht erlaubt';
$lang['Upload_image_size_too_big'] = 'Die Grösse des Bildes ist zu gross';
$lang['Upload_thumbnail_size_too_big'] = 'Die Grösse für das Thumbnail ist zu gross';

$lang['Missed_pic_title'] = 'Du musst einen Titel für das Bild angeben';

$lang['Album_upload_successful'] = 'Dein Bild wurde erfolgreich hochgeladen';
$lang['Album_upload_need_approval'] = 'Your pic has been uploaded successfully.<br /><br />But the feature Pic Approval has been enabled so your pic must be approved by an administrator or a moderator before posting';
$lang['Click_return_category'] = 'Klicke %shier%s um zu der Kategorie zurückzukehren';
$lang['Click_return_album_index'] = 'Klicke %shier%s um zum Admin-Index zurückzukehren';

// View Pic
$lang['Pic_not_exist'] = 'Dieses Bild existiert nicht';

// Edit Pic
$lang['Edit_Pic_Info'] = 'Bearbeite Bildinformation';
$lang['Pics_updated_successfully'] = 'Deine Bildinformation wurde erfolgreich aktualsiert';

// Delete Pic
$lang['Album_delete_confirm'] = 'Bist du dir sicher, dass du das/die Bild(er) löschen möchtest?';
$lang['Pics_deleted_successfully'] = 'Das/die Bild(er) wurde(n) erfolgreich gelöscht.';

//
// ModCP
//
$lang['Approval'] = 'Bewilligung';
$lang['Approve'] = 'Bewilligt';
$lang['Unapprove'] = 'Noch nicht bewilligt';
$lang['Status'] = 'Status';
$lang['Locked'] = 'Gesperrt';
$lang['Not_approved'] = 'Nicht bewilligt';
$lang['Approved'] = 'Bewilligt';
$lang['Move_to_Category'] = 'Verschiebe in Kategorie';
$lang['Pics_moved_successfully'] = 'Dein(e) Bild(er) wurde(n) erfolgreich verschoben';
$lang['Pics_locked_successfully'] = 'Dein(e) Bild(er) wurde(n) erfolgreich gesperrt';
$lang['Pics_unlocked_successfully'] = 'Dein(e) Bild(er) wurde(n) erfolgreich zugelassen';
$lang['Pics_approved_successfully'] = 'Dein(e) Bild(er) wurde(n) erfolgreich auf bewilligt gesetzt';
$lang['Pics_unapproved_successfully'] = 'Dein(e) Bild(er) wurde(n) erfolgreich auf nicht bewilligt gesetzt';

//
// Rate
//
$lang['Current_Rating'] = 'Jetzige Bewertung';
$lang['Please_Rate_It'] = 'Bitte bewerten';
$lang['Already_rated'] = 'Du hast bereits diese Bild bewertet';
$lang['Album_rate_successfully'] = 'Deine Bewertung für das Bild wurde erfolgreich übernommen';

//
// Comment
//
$lang['Comment_no_text'] = 'Bitte geb dein Kommentar ab';
$lang['Comment_too_long'] = 'Dein Kommentar ist zu lang';
$lang['Comment_delete_confirm'] = 'Bist du dir sicher, dass du den Kommentar löschen möchtest?';
$lang['Pic_Locked'] = 'Sorry, aber dieses Bild wurde gesperrt. Deswegen kannst du keine Kommentare zu diesem Bild abgeben.';

//
// Personal Gallery
//
$lang['Personal_Gallery_Explain'] = 'Du kannst die Benutzer-Gallerien anderer Mitglieder betrachten, in dem du auf den link in ihrem profil klickst';
$lang['Personal_gallery_not_created'] = 'Die Benutzer-Gallerie von %s ist leer oder wurde noch nicht erstellt';
$lang['Not_allowed_to_create_personal_gallery'] = 'Sorry, aber die Administratoren dieses Forums erlauben keine Benutzer-Gallerie';
$lang['Click_return_personal_gallery'] = 'Klicke %shier%s um zur Benutzer-Gallerie zurückzukehren';

//
// Search
//
$lang['Search_for'] = 'Suche nach';
$lang['That_contains'] = 'behinhaltet';
$lang['Name'] = 'Name';
$lang['Image_description'] = 'Beschreibung';
$lang['Highest_rated'] = 'Höchstbewertete Bilder';
$lang['Random_pic'] = 'Zufallsbild';
$lang['Album_sub_categories'] = 'Album Unter-Katergorie';
$lang['Pic_Category'] = 'Foto Album Kategorie';
$lang['Search_found'] = 'Suche gefunden';
$lang['Matches'] = 'Treffer';
$lang['Posted_at'] = 'Gepostet am';
$lang['Submitted_by'] = 'Gesendet von';
$lang['Submitted_on'] = 'Gesendet am';
$lang['Click_pic'] = 'Klicke aufs Bild für eine grössere Ansicht';

$lang['Last_Comments'] = 'Letzter Kommentar';
$lang['No_Comment_Info'] = "Keine Kommentare";
$lang['Mod_CP'] = 'Album - Moderator Kontrolle';

$lang['Post_your_comment'] = 'Poste dein Kommentar';
?>
