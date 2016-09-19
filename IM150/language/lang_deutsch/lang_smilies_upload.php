<?php
/***************************************************************************
 *                        lang_smilies_upload.php [German]
 *                            -------------------
 *   begin                : Tuesday, Aug 19, 2003
 *   version              : 1.1.0
 *   date                 : 2003/08/27 19:12
 ***************************************************************************/

//
// CONTRIBUTORS:
//	 Add your details here if wanted, e.g. Name, username, email address, website
//

//
// The format of this file is ---> $lang['message'] = 'text';
//
// This is optional, if you would like a _SHORT_ message output
// along with our copyright message indicating you are the translator
// please add it here.
// $lang['TRANSLATION'] .= '';

if ( defined('IN_SMILIESUPLOAD_LANG') )
{
	return;
}
define('IN_SMILIESUPLOAD_LANG', true);

$lang['SU_Upload_Smilies'] = 'Smilies hochladen';
$lang['SU_Upload_Explain'] = 'Du kannst dieses Programm verwenden um ein kleines Bild als Smilie oder Emoticon hochzuladen. Es kann nur eine Datei (Bild) aufeinmal hochgeladen werden und die Dateigröße (das Bild) darf nicht größer als %s KB sein. Die Maximalhöhe und Breite beträgt %s x %s.';
$lang['SU_File'] = 'Bild von deinem Rechner hochladen';
$lang['SU_Sorry'] = 'Sorry, du kannst keine Dateien hochladen.';
$lang['SU_Upload_Name'] = 'Name für die hochgeladene Datei';
$lang['SU_Default_Name'] = 'Original Dateinamen verwenden';
$lang['SU_Name_Explain'] = 'Gib einen Namen für die hochgeladene Datei an. Füge bitte keine Dateiendung mit an! (benutze z.B. "apfel", nicht "apfel.gif").';
$lang['SU_Upload_Succesful'] = 'Datei erfolgreich hochgeladen!';
$lang['SU_Upload_Failed'] = 'Datei hochladen fehlgeschlagen! Vergewissern Sie sich, dass die Rechte vom smilies Verzeichnis, auf Akten zu schreiben, erlaubt sind. (chmod 777)';
$lang['SU_Auto_Add'] = 'Automatisch hinzufügen zum Forum Smilies';
$lang['SU_Add_Successful'] = 'Smilies erfolgreich in die Datenbanktabelle eingefügt!';
$lang['SU_Add_Failed'] = 'Die Smilies konnten nicht in der Datenbanktabelle eingefügt werden!';
$lang['SU_filetype'] = 'Nur Dateien mit der endung JPEG, GIF oder PNG können hochgeladen werden.';
$lang['SU_filesize'] = 'Nur Dateien die kleiner als %s KB sind können hochgeladen werden.';
$lang['SU_File_Already'] = 'Eine Datei mit diesem Namen existiert bereits im Smilie Verzeichnis';
$lang['SU_CC_Fail'] = 'Konnte nicht überprüfen ob dieser Smiliecode schon existiert.';
$lang['SU_CC_Found'] = 'Es gibt schon einen Smilie mit dem automatisch entschlossen code.';
$lang['SU_Filename_failed'] = 'Konnte keinen neuen Dateinamen bestimmen';
$lang['SU_open_basedir'] = 'open_basedir ist gesetzt und deine PHP Version ermöglicht move_uploaded_file nicht.';
$lang['SU_Uploaded'] = 'Hochgeladene Smilies';
$lang['SU_Sorry_None'] = 'Du hast keine Smilies hochgeladen.';
$lang['SU_Delete_Successful'] = 'Datei %s gelöscht!';
$lang['SU_Delete_Failed'] = 'Konnte die Datei %s nicht löschen!';
$lang['SU_Select_file'] = 'Bitte wähle eine Datei zum hochladen!';
$lang['SU_CD_Fail'] = 'Konnte keine Einträge in der Smilie-Datenbank löschen';
$lang['SU_CD_Successful'] = 'Gelöschte Einträge in der Smilie-Datenbank';
$lang['SU_Width_height'] = 'Diese Datei überschreitet die Maximalgröße. Die Bilder dürfen nicht breiter als %s und höher als %s sein.';
$lang['SU_No_Name'] = 'Du hast keinen Namen für die hochgeladene Datei angegeben.';

?>