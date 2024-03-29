<?php
/***************************************************************************
 *                            lang_album_admin.php [English]
 *                              -------------------
 *     begin                : Sunday, February 02, 2003
 *     copyright            : (C) 2003 Smartor
 *     email                : smartor_xp@hotmail.com
 *
 *     $Id: lang_album_admin.php,v 1.0.6 2003/03/05 00:21:55 ngoctu Exp $
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

// Configuration
$lang['Album_config'] = 'Album';
$lang['Album_config_explain'] = 'You can change the Photo Album settings here.<br />';
$lang['Album_config_updated'] = 'Album Configuration has been updated successfully';
$lang['Click_return_album_config'] = 'Click %sHere%s to return to the Album Configuration';
$lang['Max_pics'] = 'Maximum pics for each Category (-1 = unlimited)';
$lang['User_pics_limit'] = 'Pics limit per category for each user (-1 = unlimited)';
$lang['Moderator_pics_limit'] = 'Pics limit per category for each moderator (-1 = unlimited)';
$lang['Pics_Approval'] = 'Pics Approval';
$lang['Rows_per_page'] = 'Number of rows on thumbnail page';
$lang['Cols_per_page'] = 'Number of columns on thumbnail page';
$lang['Thumbnail_quality'] = 'Thumbnail quality (1-100)';
$lang['Thumbnail_cache'] = 'Thumbnail cache';
$lang['Manual_thumbnail'] = 'Manual thumbnail';
$lang['GD_version'] = 'Optimize for the version of GD';
$lang['Pic_Desc_Max_Length'] = 'Pic Description/Comment Max Length (bytes)';
$lang['Hotlink_prevent'] = 'Hotlink Prevention';
$lang['Hotlink_allowed'] = 'Allowed domains for hotlink (separated by a comma)';
$lang['Personal_gallery'] = 'Allowed to create personal gallery for users';
$lang['Personal_gallery_limit'] = 'Pics limit for each personal gallery (-1 = unlimited)';
$lang['Personal_gallery_view'] = 'Who can view personal galleries by default';
$lang['Rate_system'] = 'Enable rating system';
$lang['Rate_Scale'] ='Rating Scale';
$lang['Comment_system'] = 'Enable comment system';
$lang['Thumbnail_Settings'] = 'Thumbnail Settings';
$lang['Extra_Settings'] = 'Extra Settings';
$lang['Default_Sort_Method'] = 'Default Sort Method';
$lang['Default_Sort_Order'] = 'Default Sort Order';
$lang['Fullpic_Popup'] = 'View full pic as a popup';
$lang['Email_Notification'] = 'Enable email notification on new images on album (only to admins)';
$lang['Show_Download'] = 'Show DOWNLOAD button (which enables the downloading of pictures in ZIP format) only to those who have UPLOAD permissions in the Album (if you choose ALWAYS the button will be always available even if the users has no UPLOAD permissions)';
$lang['Show_Slideshow'] = 'Enable Slideshow feature';
$lang['Show_Slideshow_Script'] = 'Enable transition effects for Slideshow';
$lang['Show_Pic_Size'] = 'Show the pic size on thumbnail';
$lang['Show_IMG_No_GD'] = 'Show GIF thumbnails without using GD libraries (full images are loaded and then just shown resized).';
$lang['Show_GIF_MidThumb'] = 'Show full GIF images if Mid Thumb is enabled.';
$lang['Show_Pics_Nav'] = 'Show Picture Navigation Box in Show Page';
$lang['Show_Inline_Copyright'] = 'Show Copyrights Info on a single line';
$lang['Enable_Nuffimage'] = 'Enable Pictures Special Effects page based on Nuffmon Images Class';
$lang['Enable_Sepia_BW'] = 'Enable Sepia and B&W in Special Effects page (disable this function if you want no to load server\'s CPU)';
$lang['Show_EXIF_Info'] = 'Show picture EXIF informations';

// Multiple Uploads Admin configuration
$lang['Upload_Settings'] = 'Upload';
$lang['Max_Files_To_Upload'] = 'Maximum number of files user can upload at a time';
$lang['Album_upload_settings'] = 'Album Upload Settings';
$lang['Max_pregenerated_fields'] = 'Maximum number of fields to pre-generate';
$lang['Dynamic_field_generation'] = 'Enable dynamic adding of upload fields';
$lang['Pre_generate_fields'] = 'Pre generate the upload fields';
$lang['Propercase_pic_title'] = 'Propercase picture title e.g. <i>\'This Is A Picture Title\'</i><br />Setting it to \'NO\' will result in this <i>\'This is a picture title\'</i>';
$lang['Pic_Resampling'] = 'Enabling this option, each image will be resized on the fly if needed (to keep image properties respecting the album settings in ACP).';
$lang['Max_file_size_resampling'] = 'Maximum file size before resampling (bytes)';

// Nuffload
$lang['Nuffload_Config'] = 'Nuffload Configuration';
$lang['Enable_Nuffload'] = 'Enable Nuffload';
$lang['Enable_Nuffload_Explain'] = 'Enabling this option, Nuffload will be used instead of standard upload form.';
$lang['progress_bar_configuration'] = 'Nuffload - Progress Bar Configuration';
$lang['perl_uploader'] = 'Enable Perl uploader';
$lang['path_to_bin'] = 'Path from phpBB root to cgi-bin (i.e. <b>./cgi-bin/</b> if you have phpBB in a sub folder)';
$lang['show_progress_bar'] = 'Show progress bar on upload';
$lang['close_progress_bar'] = 'Close progress bar on finish';
$lang['activity_timeout'] = 'Activity timeout (secs)';
$lang['simple_format'] = 'Use simple formatting for progress bar';
$lang['multiple_uploads_configuration'] = 'Nuffload - Multiple Uploads Configuration';
$lang['multiple_uploads'] = 'Enable multiple uploads';
$lang['max_uploads'] = 'Maximum upload fields';
$lang['zip_uploads'] = 'Enable zip uploads';
$lang['image_resizing_configuration'] = 'Nuffload - Image Resizing Configuration';
$lang['image_resizing'] = 'Enable image resizing';
$lang['image_width'] = 'Image width';
$lang['image_height'] = 'Image height';
$lang['image_quality'] = 'Image quality';

// Personal Gallery Page
$lang['Personal_Galleries'] = 'Personal Galleries';
$lang['Album_personal_gallery_title'] = 'Personal Gallery';
$lang['Album_personal_gallery_explain'] = 'On this page, you can choose which usergroups have right to create and view personal galleries. These settings only affect when you set "PRIVATE" for "Allowed to create personal gallery for users" or "Who can view personal galleries" in Album Configuration screen';
$lang['Album_personal_successfully'] = 'The setting has been updated successfully';
$lang['Click_return_album_personal'] = 'Click %sHere%s to return to the Personal Gallery Settings';
$lang['Allow_Album_Avatars'] = 'Allow users to use own posted images in Album as Avatar';

// Categories
$lang['Categories'] = 'Album Categories';
$lang['Album_Categories_Title'] = 'Album Categories';
$lang['Album_Categories_Explain'] = 'On this screen you can manage your categories: create, alter, delete, sort, etc.';
$lang['Category_Permissions'] = 'Category Permissions';
$lang['Category_Title'] = 'Category Title';
$lang['Category_Desc'] = 'Category Description';
$lang['View_level'] = 'View Level';
$lang['Upload_level'] = 'Upload Level';
$lang['Rate_level'] = 'Rate Level';
$lang['Comment_level'] = 'Comment Level';
$lang['Edit_level'] = ' Edit Level';
$lang['Delete_level'] = 'Delete Level';
$lang['New_category_created'] = 'New category has been created successfully';
$lang['Click_return_album_category'] = 'Click %sHere%s to return to the Album Categories Manager';
$lang['Category_updated'] = 'This category has been updated successfully';
$lang['Delete_Category'] = 'Delete Category';
$lang['Delete_Category_Explain'] = 'The form below will allow you to delete a category and decide where you want to put pics it contained';
$lang['Delete_all_pics'] = 'Delete all pics';
$lang['Category_deleted'] = 'This category has been deleted successfully';
$lang['Category_changed_order'] = 'This category has been changed order successfully';

// Permissions
$lang['Album_Auth_Title'] = 'Album Permissions';
$lang['Album_Auth_Explain'] = 'Here you can choose which usergroup(s) can be the moderators for each album category or just has the private access';
$lang['Select_a_Category'] = 'Select a Category';
$lang['Look_up_Category'] = 'Look up Category';
$lang['Album_Auth_successfully'] = 'Auth has been updated successfully';
$lang['Click_return_album_auth'] = 'Click %sHere%s to return to the Album Permissions';

$lang['Upload'] = 'Upload';
$lang['Rate'] = 'Rate';
$lang['Comment'] = 'Comment';

// Clear Cache
$lang['Clear_Cache_Tab'] = 'Cache';
$lang['Clear_Cache'] = 'Clear Cache';
$lang['Album_clear_cache_confirm'] = 'If you use the Thumbnail Cache feature you must clear your thumbnail cache after changing your thumbnail settings in Album Configuration to make them re-generated.<br /><br /> Do you want to clear them now?';
$lang['Thumbnail_cache_cleared_successfully'] = '<br />Your thumbnail cache has been cleared successfully<br />&nbsp;';

// CLowN
$lang['SP_Album_config'] = 'CLowN SP';
$lang['SP_Album_config_explain'] = 'Here you can configure some options for the Album Service Pack';
$lang['SP_Album_sp_general'] = 'General Config';
$lang['SP_Album_sp_watermark'] = 'WaterMark Config';
$lang['SP_Album_sp_hotornot'] = 'Hot or Not Config';
$lang['SP_Rate_type'] = 'Select picture rating display';
$lang['SP_Rate_type_0'] = 'Images only';
$lang['SP_Rate_type_1'] = 'Numbers only';
$lang['SP_Rate_type_2'] = 'Numbers and Images';
$lang['SP_Display_latest'] = 'Display latest submited pictures block';
$lang['SP_Display_highest'] = 'Display highest rated pictures block';
$lang['SP_Display_most_viewed'] = 'Display most viewed pictures block';
$lang['SP_Display_random'] = 'Display random pictures block';
$lang['SP_Pic_row'] = 'Number of rows on thumbnail blocks';
$lang['SP_Pic_col'] = 'Number of columns on thumbnail blocks';
$lang['SP_Midthumb_use'] = 'Use mid-thumbnail';
$lang['SP_Midthumb_cache'] = 'Enable caching of mid-thumbnail';
$lang['SP_Midthumb_high'] = 'Height of mid-thumbnail (pixel)';
$lang['SP_Midthumb_width'] = 'Width of mid-thumbnail (pixel)';
$lang['SP_Watermark'] = 'Use WaterMark';
$lang['SP_Watermark_users'] = 'Show WaterMark for all users, if \'No\' only display to unregistered users';
$lang['SP_Watermark_placent'] = 'WaterMark position on the picture';
$lang['SP_Hon_already_rated'] = 'Unlimited rating on Hot or Not page';
$lang['SP_Hon_sep_rating'] = 'Store Hot or Not rating in a separate table';
$lang['SP_Hon_where'] = 'Display pictures on hot or not from what categories? (leave blank to use pictures from all of the categories, if more then one category, separate by commas)';
$lang['SP_Hon_users'] = 'Can unregistered users rate';

$lang['SP_Disabled'] = 'Disabled';
$lang['SP_Enabled'] = 'Enabled';
$lang['SP_Yes'] = 'Yes';
$lang['SP_No'] = 'No';
$lang['SP_Always'] = 'Always';
$lang['SP_Submit'] = 'Submit';
$lang['SP_Reset'] = 'Reset';

/***************************************************************************
 * Album Hierarchy Administration                                          *
 ***************************************************************************/

// Configuration
$lang['Album_config_notice'] = 'If you change the current Photo Album settings and then select another tab, you will be prompted to save your changes.<br />The system will <b>not save</b> the changes for you automatically.';
$lang['Save_sucessfully_confimation'] = '%s was saved successfully';

$lang['Show_Recent_In_Subcats'] = 'Show recent pictures in sub categories';
$lang['Show_Recent_Instead_of_NoPics'] = 'Show recent pictures instead of no picture message';

$lang['Album_Index_Settings'] = 'Album Index';
$lang['Show_Index_Subcats'] = 'Show sub categories in index table';
$lang['Show_Index_Thumb'] = 'Show category thumbnails in index table';
$lang['Show_Index_Pics'] = 'Show the number of pictures in current category in index table';
$lang['Show_Index_Comments'] = 'Show the number of comments in current category in index table';
$lang['Show_Index_Total_Pics'] = 'Show the number of total pictures for current categories and all it\'s sub categories in index table';
$lang['Show_Index_Total_Comments'] = 'Show the number of total comments for current categories and all it\'s sub categories in index table';
$lang['Show_Index_Last_Comment'] = 'Show last comments for current categories and all it\'s sub categories in index table';
$lang['Show_Index_Last_Pic'] = 'Show last picture info for current categories and all it\'s sub categories in index table';
$lang['Line_Break_Subcats'] = 'Show each sub cat on a new line';

$lang['Show_Personal_Gallery_Link'] = 'Show Personal Gallery and Users Personal Gallery link in Sub Categories';

$lang['Album_Personal_Auth_Explain'] = 'Here you can choose which usergroup(s) can be the moderators for <b>all</b> personal album categories or just has the private access to them';

$lang['Album_debug_mode'] = 'Enable the hierarchy debug mode.<br /><span class="gensmall">This will generate alot of extra output on the page and also some header warnings, which are all ok.<br />This option should <b>only</b> be used when having problems.</span>';

$lang['New_Pic_Check_Interval'] = 'The time to use to see if a picture is new or not.<br /><span class="gensmall"><b>Format</b> : &lt;number&gt;&lt;type&gt; Where type is either h, d, w or m (hour, day, week or month)<br /> e.g. 12H = 12 hours and 12D = 12 days and 12W = 12 weeks and 12M = 12 months<br />If no type is specified the system will use <b>days</b></span>';
$lang['New_Pic_Check_Interval_Desc'] = '<span class="gensmall">H = HOURS, D = DAYS, W = WEEKS, M = MONTHS</span>';
$lang['New_Pic_Check_Interval_LV'] = 'Enabling this option the new pics counter is based on users last visit time.';
$lang['Enable_Show_All_Pics'] = 'Enable toggling of personal gallery view mode (all pictures or only selected category).<br /> When set to <b>no</b>, only selected category is shown.';
$lang['Enable_Index_Supercells'] = 'Enable super cells in the index table. <br /><span class="gensmall">This will enable the mouseover effects on the columns, also knows as the supercell effect.</span>';

// Sorting
$lang['Album_Category_Sorting'] = 'Sorting of the album categories';
$lang['Album_Category_Sorting_Id'] = 'ID';
$lang['Album_Category_Sorting_Name'] = 'Name';
$lang['Album_Category_Sorting_Order'] = 'Sort Order (default)';
$lang['Album_Category_Sorting_Direction'] = 'Sorting direction (only valid for ID and Name sorting)';
$lang['Album_Category_Sorting_Asc'] = 'Ascending';
$lang['Album_Category_Sorting_Desc'] = 'Descending';

// Personal Gallery
$lang['Album_Personal_Settings'] = 'Personal Galleries';
$lang['Show_Personal_Sub_Cats'] = 'Show personal sub categories in index table';
$lang['Personal_Gallery_Approval'] = 'Personal gallery pics must be approved by admins';
$lang['Personal_Gallery_MOD'] = 'Personal gallery can be moderated by owner';
$lang['Personal_Sub_Cat_Limit'] = 'Maximum number of sub categories (-1 = unlimited)';
$lang['User_Can_Create_Personal_SubCats'] = 'Users can create sub categories in own personal gallery';

$lang['Click_return_personal_gallery_index'] = 'Click %shere%s to return to the personal gallery index';

$lang['Show_Recent_In_Personal_Subcats'] = 'Show recent pictures in personal sub categories';
$lang['Show_Recent_Instead_of_Personal_NoPics'] = 'Show recent pictures instead of no picture message in personal gallery';

// Categories
$lang['Personal_Root_Gallery'] = 'Personal Gallery Root Category';
$lang['Parent_Category'] = 'Parent Category (for this category)';
$lang['Child_Category_Moved'] = 'Seleted category had child categories. The child categories got moved to the <B>%s</B> category.';
$lang['No_Self_Refering_Cat'] = 'You cannot set a category\'s parent to itself';
$lang['Can_Not_Change_Main_Parent'] = 'You cannot change to parent of the main category of your personal gallery';

// ACP - Javascript text
$lang['acp_ask_save_changes'] = 'Do you want to save the changes ?\n(OK = Yes, Cancel = No)';
$lang['acp_nothing_to_save'] = 'Nothing to save!';
$lang['acp_settings_changed_ask_save'] = 'You have changed the settings. Do you want to save them?\n(OK = Yes, Cancel = No)';

// GD Info
$lang['GD_Info'] = 'GD Info';
$lang['GD_Title'] = 'GD Info';
$lang['GD_Description'] = 'Here you can retrieve information about the currently installed GD library';
$lang['GD_Version'] = 'Version:';
$lang['GD_Freetype_Support'] = 'Freetype Fonts Support:';
$lang['GD_Freetype_Linkage'] = 'Freetype Link Type:';
$lang['GD_T1lib_Support'] = 'T1lib Support:';
$lang['GD_Gif_Read_Support'] = 'Gif Read Support:';
$lang['GD_Gif_Create_Support'] = 'Gif Create Support:';
$lang['GD_Jpg_Support'] = 'Jpg/Jpeg Support:';
$lang['GD_Png_Support'] = 'Png Support:';
$lang['GD_Wbmp_Support'] = 'WBMP Support:';
$lang['GD_XBM_Support'] = 'XBM Support:';
$lang['GD_Jis_Mapped_Support'] = 'Japanese Font Support:';
$lang['GD_True'] = 'Yes';
$lang['GD_False'] = 'No';

?>