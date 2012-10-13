<?php
/***************************************************************************
 *                        lang_smilies_upload.php [English]
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

$lang['SU_Upload_Smilies'] = 'Upload Smilies';
$lang['SU_Upload_Explain'] = 'You may use this utility to upload a small graphic image for use as a smilie or emoticon. Only one image can be uploaded at a time, and the file size of that image may be no more than %s KB. The maximum width and height allowed is %s by %s.';
$lang['SU_File'] = 'Upload image from your machine';
$lang['SU_Sorry'] = 'Sorry, you cannot upload files.';
$lang['SU_Upload_Name'] = 'Name for Uploaded File';
$lang['SU_Default_Name'] = 'Use original file name';
$lang['SU_Name_Explain'] = 'Specify a name for the uploaded file. Do not include a file extension (e.g., use "apple", not "apple.gif").';
$lang['SU_Upload_Succesful'] = 'File uploaded successfully!';
$lang['SU_Upload_Failed'] = 'File upload failed! Make sure the permissions of the smilies directory allow writing to files.';
$lang['SU_Auto_Add'] = 'Automatically add to forum Smilies';
$lang['SU_Add_Successful'] = 'Added to smilies database table succesfully!';
$lang['SU_Add_Failed'] = 'Could not add to smilies database table.';
$lang['SU_filetype'] = 'Only JPEG, GIF, or PNG images may be uploaded.';
$lang['SU_filesize'] = 'Only files smaller than %s KB may be uploaded.';
$lang['SU_File_Already'] = 'A file with that name already exists in the smilies directory.';
$lang['SU_CC_Fail'] = 'Could not check for existing smilies code.';
$lang['SU_CC_Found'] = 'There is already a smiley with the automatically determined code.';
$lang['SU_Filename_failed'] = 'Could not determine new filename';
$lang['SU_open_basedir'] = 'open_basedir is set and your PHP version does not allow move_uploaded_file.';
$lang['SU_Uploaded'] = 'Uploaded Smilies Images';
$lang['SU_Sorry_None'] = 'You have no uploaded smilies images.';
$lang['SU_Delete_Successful'] = 'File %s deleted!';
$lang['SU_Delete_Failed'] = 'Could not delete file %s!';
$lang['SU_Select_file'] = 'Please select a file to upload.';
$lang['SU_CD_Fail'] = 'Could not delete any entries in smilies database.';
$lang['SU_CD_Successful'] = 'Deleted entries in smilies database.';
$lang['SU_Width_height'] = 'That file exceeds the maximum size allowed. Images must be no more than %s wide and %s high.';
$lang['SU_No_Name'] = 'You did not specify a name for the uploaded file.';

?>