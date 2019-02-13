<?php
/****************************************************************
 *             lang_smilies_upload.php [Nederlands]
 *             -----------------------
 *   begin                : Tuesday, Aug 19, 2003
 *   version              : 1.1.0
 *   date                 : 2003/08/27 19:12
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

$lang['SU_Upload_Smilies'] = 'Upload Smilies';
$lang['SU_Upload_Explain'] = 'U mag deze voorziening gebruiken om een klein plaate te uploaden om als smilie te gebruiken. Er kan alleen ייn plaatje per keer ge-uploadt worden, en de bestandsgrootte mag niet groter zijn dan %s KB. De maximum wijdte en hoogte is %s bij %s.';
$lang['SU_File'] = 'Upload een bestand van uw computer';
$lang['SU_Sorry'] = 'Sorry, u kunt geen bestanden uploaden.';
$lang['SU_Upload_Name'] = 'Naam voor de upload';
$lang['SU_Default_Name'] = 'Gebruik originele bestandsnaam';
$lang['SU_Name_Explain'] = 'Voer een naam in voor de upload. Voeg geen bestands extensie toe (bijv., gebruik "appel", niet "appel.gif").';
$lang['SU_Upload_Succesful'] = 'Upload succesvol!';
$lang['SU_Upload_Failed'] = 'Uploaden mislukt! Wees er zeker van dat de permissies van de smilies directory toestaan dat er geschreven kan worden naar bestanden.';
$lang['SU_Auto_Add'] = 'Voeg automatisch toe aan forum Smilies';
$lang['SU_Add_Successful'] = 'Succesvol aan smilies database tabel toegevoegd!';
$lang['SU_Add_Failed'] = 'Kan niets toevoegen aan de smilies database tabel.';
$lang['SU_filetype'] = 'Alleen JPEG, GIF, of PNG plaatjes mogen worden ge-uploadt.';
$lang['SU_filesize'] = 'Alleen bestanden die kleiner zijn dan %s KB mogen worden ge-uploadt.';
$lang['SU_File_Already'] = 'Een bestand met die naam bestaat al in de smilies directory.';
$lang['SU_CC_Fail'] = 'Kan niet controleren op bestaande smilies code.';
$lang['SU_CC_Found'] = 'Er is al een smilie met de automatisch bepaalde code.';
$lang['SU_Filename_failed'] = 'Kan nieuwe bestandsnaam niet bepalen.';
$lang['SU_open_basedir'] = 'open_basedir is geselecteerd en uw PHP versie staat move_uploaded_file niet toe.';
$lang['SU_Uploaded'] = 'Ge-uploadde Smilies ';
$lang['SU_Sorry_None'] = 'U heeft geen ge-uploadde plaatjes.';
$lang['SU_Delete_Successful'] = 'Bestand %s verwijderd!';
$lang['SU_Delete_Failed'] = 'Kan bestand %s niet verwijderen!';
$lang['SU_Select_file'] = 'Selecteer alstublieft een bestand om te uploaden.';
$lang['SU_CD_Fail'] = 'Kan geen smilies uit de database verwijderen.';
$lang['SU_CD_Successful'] = 'Smilies uit database verwijderd.';
$lang['SU_Width_height'] = 'Dit bestand heeft de maximum bestandsgrootte overschreden. Plaatjes mogen niet wijder zijn dan %s en niet hoger dan %s.';
$lang['SU_No_Name'] = 'U heeft geen naam ingevoerd voor het ge-uploadde bestand.';

?>