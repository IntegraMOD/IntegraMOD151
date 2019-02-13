<?php
/***************************************************************************
 *                          lang_album_main.php [English]
 *                              -------------------
 *     begin                : Sunday, February 02, 2003
 *     copyright            : (C) 2003 Smartor
 *     email                : smartor_xp@hotmail.com
 *
 *   Nederlandse vertaling: Maart 2005
 *   The Dutch Team        : http://www.integramod.nl
 *
 *     $Id: lang_album_main.php,v 1.0.6 2003/03/05 20:12:38 ngoctu Exp $
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
// Album Index
//
$lang['Photo_Album'] = 'Foto Albums';
$lang['Pics'] = 'Fotos';
$lang['Last_Pic'] = 'Laatste Fotos';
$lang['Public_Categories'] = 'Publieke Album Categorieën';
$lang['No_Pics'] = 'Geen Foto\'s';
$lang['Users_Personal_Galleries'] = 'Persoonlijke Gebruikers Albums';
$lang['Your_Personal_Gallery'] = 'Jou Persoonlijke Album';

$lang['Nav_Separator'] = '&nbsp;&raquo;&nbsp;';

// Category View
$lang['Category_not_exist'] = 'Je bent niet ingelogt,<br /> of<br>je hebt niet de vereiste rechten,<br /> of <br />deze categorie bestaat niet.';
$lang['Upload_Pic'] = 'Upload';
$lang['Pic_Title'] = '<b>Titel</B>';
$lang['View'] = 'Bekeken';
$lang['Pic_Poster'] = 'Plaatser';
$lang['Pic_Image'] = 'Image';

$lang['Album_upload_can'] = '<b>In deze categorie,</b> <br /><b>kun</b> je nieuwe fotos uploaden';
$lang['Album_upload_cannot'] = '<b>In deze categorie,</b> <br />kun je <b>geen</b> nieuwe fotos uploaden';
$lang['Album_rate_can'] = '<b>kun</b> je fotos waarderen';
$lang['Album_rate_cannot'] = 'kun je <b>geen</b> fotos waarderen';
$lang['Album_comment_can'] = '<b>kun</b> je commentaar geven bij fotos';
$lang['Album_comment_cannot'] = 'kun je <b>geen</b> commentaar geven bij fotos';
$lang['Album_edit_can'] = '<b>kun</b> je fotos en commentaar bewerken';
$lang['Album_edit_cannot'] = 'kun je <b>geen</b> fotos en commentaar bewerken';
$lang['Album_delete_can'] = '<b>kun</b> je fotos en commentaar verwijderen';
$lang['Album_delete_cannot'] = 'kun je <b>geen</b> fotos en commentaar verwijderen';
$lang['Album_moderate_can'] = 'Je <b>kunt</b> %sdeze categorie moderaten%s';

$lang['Edit_pic'] = 'Bewerken';
$lang['Delete_pic'] = 'Verwijderen';
$lang['Rating'] = '<b>Waardering</b>';
$lang['Comments'] = '<b>Commentaren</b>';
$lang['Last_Comment'] = 'Last Commentaar';
$lang['New_Comment'] = 'Nieuw Commentaar';
$lang['Not_rated'] = '<i>Niet gewaardeerd</i>';
$lang['Random_Pictures'] = 'Random Pictures';
$lang['Highest_Rated_Pictures'] = 'Highest Rated Pictures';
$lang['Most_Viewed_Pictures'] = 'Most Viewed Pictures';

$lang['Avatar_Set'] = 'Set as Avatar';
$lang['BBCode_Copy'] = 'Copy BBCode';

// Upload
$lang['Pic_Desc'] = 'Omschrijving';
$lang['Plain_text_only'] = 'Alleen pure text';
$lang['Max_length'] = 'Max lengte (bytes)';
$lang['Upload_pic_from_machine'] = 'Upload een foto van je machine';
$lang['Upload_to_Category'] = 'Upload naar Categorie';
$lang['Upload_thumbnail_from_machine'] = 'Upload de thumbnail van je machine (moet hetzelfde type zijn)';
$lang['Upload_thumbnail'] = 'Upload een thumbnail';
$lang['Upload_thumbnail_explain'] = 'Het moet hetzelfde file type als jou foto zijn';
$lang['Thumbnail_size'] = 'Thumbnail grote (pixel)';
$lang['Filetype_and_thumbtype_do_not_match'] = 'Je foto en thumbnail zijn niet van hetzelfde type';

$lang['Upload_no_title'] = 'Je moet een Titel voor je foto invullen';
$lang['Upload_no_file'] = 'Je moet het path invullen voor je bestand';
$lang['Desc_too_long'] = 'Je omschrijving is te lang';

$lang['JPG_allowed'] = 'Upload JPG bestanden toegestaan';
$lang['PNG_allowed'] = 'Upload PNG bestanden toegestaan';
$lang['GIF_allowed'] = 'Upload GIF bestanden toegestaan';

$lang['Album_reached_quota'] = 'Dit album heeft het maximum aantal fotos. Je kunt niet meer uploaden. Vraag de beheerders voor meer informatie';
$lang['User_reached_pics_quota'] = 'Je hebt het maximum aantal fotos berijkt. Je kunt niet meer uploaden. Vraag de beheerders voor meer informatie';

$lang['No_valid_category_selected'] = 'No valid album category selected';
$lang['No_category_to_upload'] = 'Unfortunately currently there are no categories you can upload to.';
$lang['Not_allowed_file_type'] = 'Dit bestands type is niet toegestaan';
$lang['Upload_image_size_too_big'] = 'De afmeting van deze foto is te groot';
$lang['Upload_thumbnail_size_too_big'] = 'De afmeting van de thumbnail is te groot';

$lang['Missed_pic_title'] = 'Je moet een Titel invullen';

$lang['Click_return_category'] = 'Click %shere%s to return to the category';
$lang['Click_return_album_index'] = 'Click %shere%s to return to the Album Index';

$lang['Add_File'] = 'Add File';
$lang['File_thumbnail_count_mismatch'] = 'The number of uploaded pictures and thumbnails doesn\'t match';
$lang['No_thumbnail_for_picture_found'] = 'There was no thumbnail found for the uploaded picture (named: %s)';
$lang['No_picture_for_thumbnail_found'] = 'There was no picture found for the uploaded thumbnail (named: %s)';
$lang['Unknown_file_and_thumbnail_error_mismatch'] = 'Uknown error got raised when uploading the picture and thumbnail<br />Picture named: %s and Thumbnail named: %s<br />';
$lang['Picture_exceeded_maximum_size_INI'] = 'Picture named \'%s\' is too big. Picture is skipped.<br />';
$lang['Thumbnail_exceeded_maximum_size_INI'] = 'Thumbnail named \'%s\' is too big. Picture and thubmnail are skipped.<br />';
$lang['Execution_time_exceeded_skipping'] = 'The maximum time alllowed for script execution has been exceeded. The following files was skipped:<br />';
$lang['Skipping_uploaded_picture_file'] = '%s<br/>';
$lang['Skipping_uploaded_picture_and_thumbnail_file'] = '%s (thumbnail: %s)<br/>';
$lang['Album_upload_not_successful'] = 'None of your pictures has been uploaded successfully<br/><br/>';
$lang['Album_upload_partially_successful'] = 'Only a part of your pictures has been uploaded successfully<br/><br/>';
$lang['No_pictures_selected_for_upload'] = 'No pictures selected for upload or unknow error';

//$lang['Bad_upload_file_size'] = 'Dit bestand is te groot of beschadigd';
//$lang['Album_upload_successful'] = 'Your pic has been uploaded successfully';
//$lang['Album_upload_need_approval'] = 'Your pic has been uploaded successfully.<br /><br />But the feature Pic Approval has been enabled so your pic must be approved by a administrator or a moderator before posting';

$lang['Bad_upload'] = 'Bad upload';
$lang['Bad_upload_file_size'] = 'Your uploaded file (%s) is too large or corrupted';
$lang['Album_upload_successful'] = 'Je foto is succesvol geupload';
$lang['Album_upload_need_approval'] = 'Je foto is succesvol geupload.<br /><br />Maar de eigenschap foto Goedkeuring staat aan, zodat je foto eerst door een beheerder of een moderator moet worden goedgekeurd voordat hij zichtbaar is voor iedereen.';

$lang['Rotation'] = 'Rotate (Anti-Clockwise) - Degrees';

$lang['Max_file_size'] = 'Maximum grote (bytes)';
$lang['Max_width'] = 'Maximum breedte (pixel)';
$lang['Max_height'] = 'Maximum hoogte (pixel)';

// Album Nuffload
$lang['time_elapsed'] = 'Time Elapsed';
$lang['time_remaining'] = 'Time Remaining';
$lang['upload_in_progress'] = 'Upload In Progress';
$lang['please_wait'] = 'Please Wait...';
$lang['uploaded'] = 'Uploaded %multi_id% of %multi_max% images.';
$lang['no_file_received'] = 'No image file received';
$lang['no_thumbnail_file_received'] = 'No thumbnail file received';
$lang['file_too_big'] = 'Image file size too big';
$lang['thumbnail_too_big'] = 'Thumbnail file size too big';
$lang['image_res_too_high'] = 'Image resolution too high';
$lang['add_field'] = 'Add file upload field';
$lang['remove_field'] = 'Remove file upload field';
$lang['ZIP_allowed'] = 'Allowed to upload ZIP files';

// View Pic
$lang['Pic_ID'] = 'ID';
$lang['Pic_Details'] = 'Image Details';
$lang['Pic_Size'] = 'Size';
$lang['Pic_Type'] = 'Image Type';
$lang['Pic_BBCode'] = 'BBCode';
$lang['Pic_not_exist'] = 'Je hebt geen rechten om deze foto te bekijken (of de foto bestaat niet)';
$lang['Click_enlarge'] = 'Click on image to view larger image';
$lang['Prev_Pic'] = 'View Previous Picture';
$lang['Next_Pic'] = 'View Next Picture';
$lang['Slideshow'] = 'Slide Show';
$lang['Slideshow_Delay'] = 'Slide Show Delay';
$lang['Slideshow_On'] = 'Slide Show';
$lang['Slideshow_Off'] = 'Stop Slide Show';
$lang['Pics_Nav'] = 'Pictures Navigation';
$lang['Pics_Nav_Next'] = 'Next Pictures';
$lang['Pics_Nav_Prev'] = 'Previous Pictures';

// Edit Pic
$lang['Edit_Pic_Info'] = 'Bewerk Foto Informatie';
$lang['Pics_updated_successfully'] = 'Foto informatie succesvol aangepast';

// Delete Pic
$lang['Album_delete_confirm'] = 'Weet je zeker dat je deze foto(s) wilt verwijderen?';
$lang['Pics_deleted_successfully'] = 'Deze foto(s) zijn verwijderd';

// ModCP
$lang['Approval'] = 'Keuren';
$lang['Approve'] = 'Goedkeuren';
$lang['Unapprove'] = 'Afkeuren';
$lang['Status'] = 'Status';
$lang['Locked'] = 'Geblokkeerd';
$lang['Not_approved'] = 'Niet Goedgekeurd';
$lang['Approved'] = 'Goedgekeurd';
$lang['Move_to_Category'] = 'Verplaatsen naar Categorie';
$lang['Pics_moved_successfully'] = 'Je foto(s) zijn verplaatst';
$lang['Pics_locked_successfully'] = 'Je foto(s) zijn gesloten';
$lang['Pics_unlocked_successfully'] = 'Je foto(s) zijn geopend';
$lang['Pics_approved_successfully'] = 'Je foto(s) zijn Goedgekeurd';
$lang['Pics_unapproved_successfully'] = 'Je foto(s) zijn Afgekeurd';

// Rate
$lang['Current_Rating'] = 'Huidige waardering';
$lang['Please_Rate_It'] = 'Geef waardering';
$lang['Login_To_Vote'] = 'Please Login To Vote';
$lang['Already_rated'] = 'Je hebt deze foto al gewaardeerd';
$lang['Album_rate_successfully'] = 'Je waardering is ingevoerd';

// Comment
$lang['Comment_no_text'] = 'Voeg eerst commentaar toe';
$lang['Comment_too_long'] = 'Je commentaar is te lang';
$lang['Comment_delete_confirm'] = 'Weet je zeker dat je dit commentaar wilt verwijderen?';
$lang['Pic_Locked'] = 'Sorry, deze foto is locked. Je kunt geen comment meer toevoegen voor deze foto';
$lang['Post_your_comment'] = 'Voeg commentaar toe';

// Personal Gallery
$lang['Personal_Gallery_Explain'] = 'Je kunt Persoonlijke Albums van andere leden bekijken door op de link in hun profiel te klikken';
$lang['Personal_gallery_not_created'] = 'Het Persoonlijke Album van %s is leeg of is nog niet gemaakt';
$lang['Not_allowed_to_create_personal_gallery'] = 'Sorry, de beheerders van deze site staan je niet toe een persoonlijk Album te maken';
$lang['Click_return_personal_gallery'] = 'Terug naar je persoonlijke Album Klik %shier%s';

// Download Archive
$lang['Download_pics'] = 'Download Pics (ZIP)';
$lang['Download_page'] = 'Download Pics In This Page (ZIP)';
$lang['No_Download_auth'] = 'You are not authorized to archive photos from this album!';

// Email Notification
$lang['Email_Notification'] = 'Album Email Notification';
$lang['Email_Notification_Explain'] = 'This setting allow admins to receive a notification when a new picture is posted in the album';
$lang['Approvation_OK'] = 'Approved';
$lang['Approvation_NO'] = 'To Be Approved';

// Album Hierarchy Index Table
$lang['Last_Comments'] = 'Laatste Commentaar';
$lang['No_Comment_Info'] = 'Geen Commentaar';
$lang['No_Pictures_In_Cat']= 'No Pictures In Category';
$lang['Total_Pics'] = 'Total Pics';
$lang['Total_Comments'] = 'Total Comments';
$lang['Last_Index_Thumbnail'] = 'Last Pic';
$lang['One_Sub_Total_Pics'] = '%d Pic';
$lang['Multiple_Sub_Total_Pics'] = '%d Pics';
$lang['Album_sub_categories'] = 'Sub Categories';
$lang['No_Public_Galleries'] = 'No Public Galleries';
$lang['One_new_picture'] = '%d new picture';
$lang['Multiple_new_pictures'] = '%d new pictures';

// Personal Album Hierarchy Index Table
$lang['Personal_Categories'] = 'Personal Gallery';
$lang['Create_Personal_Categories'] = 'Create Personal Gallery';
$lang['Personal_Cat_Admin'] = 'Personal Gallery Category Admin';
$lang['Recent_Personal_Pics'] = 'Recent Pictures From the Personal Gallery of %s';

// Album Moderator Control Panel
$lang['Modcp_check_all'] = 'Check All';
$lang['Modcp_uncheck_all'] = 'Uncheck All';
$lang['Modcp_inverse_selection'] = 'Inverse Selection';

$lang['Show_selected_pic_view_mode'] = 'Show Only The Selected Personal Gallery Category';
$lang['Show_all_pic_view_mode'] = 'Show All Pictures In this Personal Gallery';

// Access language strings
$lang['Album_Can_Manage_Categories'] = 'You <b>can</b> %smanage%s the categories in the gallery';
$lang['No_Personal_Category_admin'] = 'You are not allowed to manage your personal gallery categories';

// The picture list of a member (album_mod/album_memberlist.php)
$lang['Pic_Cat'] = 'Category';
$lang['Picture_List_Of_User'] = 'All Pictures by %s';
$lang['Member_Picture_List_Explain'] = 'You can view the complete list of picture contributed by other members by clicking on the link in their profiles';
$lang['Comment_List_Of_User'] = 'All Comments by %s';
$lang['Rating_List_Of_User'] = 'All Ratings by %s';
$lang['Show_All_Pictures_Of_user'] = 'Show All Pictures by %s';
$lang['Show_All_Comments_Of_user'] = 'Show All Comments by %s';
$lang['Show_All_Ratings_Of_user'] = 'Show All Ratings by %s';

// The pictures list
$lang['All_Picture_List_Of_User'] = 'All Pictures';
$lang['All_Comment_List_Of_User'] = 'All Comments';
$lang['All_Rating_List_Of_User'] = 'All Ratings';
$lang['All_Show_All_Pictures_Of_user'] = 'Show All Pictures';
$lang['All_Show_All_Comments_Of_user'] = 'Show All Comments';
$lang['All_Show_All_Ratings_Of_user'] = 'Show All Ratings';

$lang['Not_commented'] = '<i>Geen Commentaar</i>';

// Nuff's Stuff
$lang['Nuff_Click'] = 'Click here to apply Special Effects';
$lang['Nuff_UnClick'] = 'Click here for normal visualization';
$lang['Nuff_Title'] = 'Special Effects';
$lang['Nuff_Explain'] ='Using this page you can apply multiple effects to the pictures.<br />Remember that this is a <i><b>very heavy operation on server CPU load</b></i>, so please do not abuse it. Some effects will automatically resize the output image so to not charge too much server CPU.';
$lang['Nuff_Normal'] = 'Normal Image';
$lang['Nuff_Normal_Explain'] = 'No effects applied';
$lang['Nuff_BW'] = 'Black & White';
$lang['Nuff_BW_Explain'] = 'This effect will transform the image into Black and White';
$lang['Nuff_Sepia'] = 'Sepia Tone';
$lang['Nuff_Sepia_Explain'] = 'This effect will apply sepia toning to the picture';
$lang['Nuff_Flip'] = 'Flip';
$lang['Nuff_Flip_Explain'] = 'Using this function you can flip the image';
$lang['Nuff_Mirror'] = 'Mirror';
$lang['Nuff_Mirror_Explain'] = 'Using this function you can mirror the image';
$lang['Nuff_Flip_H'] = 'Horizontal';
$lang['Nuff_Flip_V'] = 'Vertical';
$lang['Nuff_Rotate'] = 'Picture Rotation (Anti Clockwise)';
$lang['Nuff_Rotate_Explain'] = 'Rotates the images anti clockwise';
$lang['Nuff_Resize'] = 'Resize';
$lang['Nuff_Resize_Explain'] = 'This function is for image resizing';
$lang['Nuff_Resize_W'] = 'Width';
$lang['Nuff_Resize_H'] = 'Height';
$lang['Nuff_Resize_No_Resize'] = 'No Resize';
$lang['Nuff_Watermark'] = 'Watermark';
$lang['Nuff_Watermark_Explain'] = 'Apply a watermark to the image';
$lang['Nuff_Recompress'] = 'Recompress';
$lang['Nuff_Recompress_Explain'] = 'This function can recompress the image';
$lang['Nuff_Alpha'] = 'Alpha';
$lang['Nuff_Alpha_Explain'] = 'This effect will overlay an alpha channel to the image';
$lang['Nuff_Blur'] = 'Blur';
$lang['Nuff_Blur_Explain'] = 'This effect will apply a blur filter to the image';
$lang['Nuff_Pixelate'] = 'Pixelate';
$lang['Nuff_Pixelate_Explain'] = 'This effect will apply a pixelate filter to the image';
$lang['Nuff_Scatter'] = 'Scatter';
$lang['Nuff_Scatter_Explain'] = 'This effect will apply a scatter filter to the image';
$lang['Nuff_Infrared'] = 'Infrared';
$lang['Nuff_Infrared_Explain'] = 'This effect will apply an infrared filter to the image';
$lang['Nuff_Tint'] = 'Tint';
$lang['Nuff_Tint_Explain'] = 'This effect will apply a red tint to the image';
$lang['Nuff_Interlace'] = 'Interlace (Horizontal Lines)';
$lang['Nuff_Interlace_Explain'] = 'This effect will overlay an interlace channel to the image';
$lang['Nuff_Screen'] = 'Screen (Hor Ver Lines)';
$lang['Nuff_Screen_Explain'] = 'This effect will overlay a screen channel to the image';
$lang['Nuff_Stereogram'] = 'Stereogram';
$lang['Nuff_Stereogram_Explain'] = 'This effect will convert the image to a stereogram (BW 16 bit required)';


?>
