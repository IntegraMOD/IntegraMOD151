<?php
/***************************************************************************
 *                          lang_multiple_album.php [German]
 *                          ------------------------------------------------
 *     begin                : Wednesday, July 28, 2004
 *     copyright            : (C) 2004 IdleVoid
 *     email                : idlevoid@slater.dk
 *
 *     version              : 1.0.3 28/07/2004
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
//übersetzt von clanpunisher
//--- Admin configuration
//--- version : 1.0.0
$lang['Max_Files_To_Upload'] = 'Maximale Anzahl an Bilder die ein Benutzer auf einmal hochladen kann';
//--- version : 1.0.3
$lang['Album_upload_settings'] = 'Album Upload Einstellungen';
$lang['Max_pregenerated_fields'] = 'Maximale Anzahl der Felder die vorgeneriert werden';
$lang['Dynamic_field_generation'] = 'Dynamisches hinzufügen der Upload Felder';
$lang['Pre_generate_fields'] = 'Upload Felder vorgenerieren lassen';
$lang['Propercase_pic_title'] = 'Wortanfang im Titel in Grossbuchstaben z.b. <i>\'Das Ist Ein Cooles Bild\'</i><br>Das setzen auf \'Nein\' bewirkt :<i>\'Das ist ein cooles bild\'</i>';


//--- Upload page
//--- version : 1.0.1
$lang['Add_File'] = 'Datei hinzufügen';
//--- version : 1.0.2
//--- NOTE : keep the <br> part of the messages PLEASE !
$lang['File_thumbnail_count_mismatch'] = 'Die Anzahl der hochgeladenen Bilder und der Thumbnails stimmen nicht überein';
$lang['No_thumbnail_for_picture_found'] = 'Es wurde kein Thumbnail für das hochgeladene Bild (namens : %s) gefunden';
$lang['No_picture_for_thumbnail_found'] = 'Es wurde kein Bild zu dem hochgeladenen Thumbnail (namens : %s) gefunden';
$lang['Unknown_file_and_thumbnail_error_mismatch'] = 'Unbekannter Fehler ist beim hochladen eines Bildes und Thumbnails aufgetreten<br>Bildname : %s und Thumbnailname : %s<br>';
$lang['Picture_exceeded_maximum_size_INI'] = 'Das Bild namens \'%s\' ist zu gross. Der upload des Bildes wurde übersprungen.<br>';
$lang['Thumbnail_exceeded_maximum_size_INI'] = 'Das Thumbnail namens \'%s\' ist zu gross. Der upload des Bildes und des Thubmnails wurde übersprungen.<br>'; ;
$lang['Execution_time_exceeded_skipping'] = 'Die erlaubte Zeit zur Ausführung des Scripts wurde überschritten. Die folgenden Dateien wurden übersprungen:<br>';
$lang['Skipping_uploaded_picture_file'] = '%s<br/>';
$lang['Skipping_uploaded_picture_and_thumbnail_file'] = '%s (Thumbnail: %s)<br/>';
$lang['Album_upload_not_successful'] = 'Keines deiner Bilder wurde erfolgreich übertragen<br/><br/>';
$lang['Album_upload_partially_successful'] = 'Nur ein Teil deiner Bilder wurde erfolgreich übertragen<br/><br/>';
$lang['No_pictures_selected_for_upload'] = 'Unbekannter Fehler ist aufgetreten oder du hast keine Bilder zum hochladen ausgewählt';

$lang['Bad_upload_file_size'] = 'Die hochgeladene Datei (%s) ist entweder zu gross oder beschädigt';

$lang['Album_upload_successful'] = 'Dein(e) Bild(er) wurde(n) erfolgreich übertragen';
$lang['Album_upload_need_approval'] = 'Dein(e) Bild(er) wurde(n) erfolgreich übertragen.<br /><br />Die Bilder werden erst gepostet nachdem sie ein Administrator oder Moderator genehmigt hat';

//--------------------
?>