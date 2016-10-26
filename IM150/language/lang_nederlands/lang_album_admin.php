<?php
/***************************************************************************
 *                            lang_album_admin.php [Nederlands]
 *                              -------------------
 *     begin                : Sunday, February 02, 2003
 *     copyright            : (C) 2003 Smartor
 *     email                : smartor_xp@hotmail.com
 *
 *   Nederlandse vertaling: Maart 2005
 *   The Dutch Team        : http://www.integramod.nl
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
$lang['Album_config'] = 'Album Configuratie';
$lang['Album_config_explain'] = 'Hier kun je de algemene instellingen van je Foto Album aanpassen';
$lang['Album_config_updated'] = 'Album Configuratie is gewijzigd';
$lang['Click_return_album_config'] = 'Terug naar de Album Configuratie Klik %sHier%s';
$lang['Max_pics'] = 'Maximum aantal Fotos voor elke Categorie (-1 = Onbeperkt)';
$lang['User_pics_limit'] = 'Limiet per categorie voor elke gebruiker (-1 = Onbeperkt)';
$lang['Moderator_pics_limit'] = 'Limiet per categorie voor elke moderator (-1 = Onbeperkt)';
$lang['Pics_Approval'] = 'Foto keuring';
$lang['Rows_per_page'] = 'Aantal rijen Fotos op thumbnail pagina';
$lang['Cols_per_page'] = 'Aantal kolummen op thumbnail pagina';
$lang['Thumbnail_quality'] = 'Thumbnail kwaliteit (1-100)';
$lang['Thumbnail_cache'] = 'Thumbnail cache';
$lang['Manual_thumbnail'] = 'Handmatig thumbnail';
$lang['GD_version'] = 'Optimaliseer voor de versie van GD';
$lang['Pic_Desc_Max_Length'] = 'Maximale Lengte (bytes) voor Foto Omschrijving/Commentaar';
$lang['Hotlink_prevent'] = 'Hotlink Preventie';
$lang['Hotlink_allowed'] = 'Toegestane domeinen voor hotlink (gescheiden door een komma)';
$lang['Personal_gallery'] = 'Wie mag Persoonlijk Album voor gebruikers maken';
$lang['Personal_gallery_limit'] = 'Foto limiet voor elk persoonlijk Album (-1 = Onbeperkt)';
$lang['Personal_gallery_view'] = 'Persoonlijk Album bekijken toestaan voor';
$lang['Rate_system'] = 'Enable Waardering systeem';
$lang['Rate_Scale'] ='Waardering Schaal';
$lang['Comment_system'] = 'Enable commentaar systeem';
$lang['Thumbnail_Settings'] = 'Thumbnail instellingen';
$lang['Extra_Settings'] = 'Extra instellingen';
$lang['Default_Sort_Method'] = 'Standaard Sorteer Methode';
$lang['Default_Sort_Order'] = 'Standaard Sorteer Volgorde';
$lang['Fullpic_Popup'] = 'Bekijk volledige Foto in een popup';

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
$lang['Personal_Galleries'] = 'Persoonlijke foto Albums';
$lang['Album_personal_gallery_title'] = 'Persoonlijk Album';
$lang['Album_personal_gallery_explain'] = 'Op deze pagina, kun je kiezen welke gebruikersgroepen persoonlijke Foto Albums kunnen maken en bekijken. Deze instellingen hebben alleen effect wanneer je ze op "PRIVATE" zet voor "Persoonlijk Foto Album maken voor gebruikers" of "Persoonlijk Foto Album bekijken" in Album Configuratie';
$lang['Album_personal_successfully'] = 'De instellingen zijn aangepast';
$lang['Click_return_album_personal'] = 'Terug naar de Persoonlijke Album Instellingen Klik %sHier%s';
$lang['Allow_Album_Avatars'] = 'Allow users to use own posted images in Album as Avatar';

// Categories
$lang['Categories'] = 'Album Categorie';
$lang['Album_Categories_Title'] = 'Album Categorie Beheer';
$lang['Album_Categories_Explain'] = 'Op deze pagina kun je de instellingen regelen om categorieën te: maken, aanpassen, verwijderen, sorteren, etc.';
$lang['Category_Permissions'] = 'Categorie Rechten';
$lang['Category_Title'] = 'Categorie Titel';
$lang['Category_Desc'] = 'Categorie Omschrijving';
$lang['View_level'] = 'Bekijken';
$lang['Upload_level'] = 'Uploaden';
$lang['Rate_level'] = 'Waarderen';
$lang['Comment_level'] = 'Becommentariëren';
$lang['Edit_level'] = 'Wijzigen';
$lang['Delete_level'] = 'Verwijderen';
$lang['New_category_created'] = 'De nieuwe categorie is gemaakt';
$lang['Click_return_album_category'] = 'Terug naar Album Categorie Beheer Klik %sHier%s';
$lang['Category_updated'] = 'De  categorie is aangepast';
$lang['Delete_Category'] = 'Verwijder Categorie';
$lang['Delete_Category_Explain'] = 'Met het formulier hieronder kun je een categorie verwijderen en de Fotos verplaatsen die er in zitten';
$lang['Delete_all_pics'] = 'Verwijder alle Fotos';
$lang['Category_deleted'] = 'De categorie is verwijderd';
$lang['Category_changed_order'] = 'De categorie is verplaatst';

// Permissions
$lang['Album_Auth_Title'] = 'Album Rechten';
$lang['Album_Auth_Explain'] = 'Hier kun je kiezen welke gebruikersgroep(en) moderator kan zijn voor elke Album categorie of alleen via Private toegangkelijk is';
$lang['Select_a_Category'] = 'Selecteer een Categorie';
$lang['Look_up_Category'] = 'Bekijk Categorie';
$lang['Album_Auth_successfully'] = 'De rechten zijn aangepast';
$lang['Click_return_album_auth'] = 'Terug naar Album Rechten Klik %sHier%s';

$lang['Upload'] = 'Upload';
$lang['Rate'] = 'Waardeer';
$lang['Comment'] = 'Commentaar';


// Clear Cache
$lang['Clear_Cache_Tab'] = 'Cache';
$lang['Clear_Cache'] = 'Cache legen';
$lang['Album_clear_cache_confirm'] = 'Wanneer je Thumbnail Cache gebruikt moet je, nadat je de instellingen hebt aangepast in Album Configuratie, de thumbnail cache legen ze worden dan opnieuw gegenereerd.<br /><br /> Wil je de cache nu legen?';
$lang['Thumbnail_cache_cleared_successfully'] = '<br />Je thumbnail cache is geleegd<br />&nbsp;';

// CLowN
$lang['SP_Album_config'] = 'CLowN SP Configuratie'; 
$lang['SP_Album_config_explain'] = 'Hier kun je een aantal opties voor het Album Service Pack instellen'; 
$lang['SP_Album_sp_general'] = 'Algemene Configuratie'; 
$lang['SP_Album_sp_watermark'] = 'WaterMerk Configuratie'; 
$lang['SP_Album_sp_hotornot'] = 'Hot or Not Configuratie'; 
$lang['SP_Rate_type'] = 'Selecteer hier hoe je de foto waardering wilt laten zien'; 
$lang['SP_Rate_type_0'] = 'Alleen Iconen'; 
$lang['SP_Rate_type_1'] = 'Alleen Numbers'; 
$lang['SP_Rate_type_2'] = 'Nummers en Iconen'; 
$lang['SP_Display_latest'] = 'Laat block met nieuwste foto\'s zien'; 
$lang['SP_Display_highest'] = 'Laat block hoogst gewaardeerde foto\'s zien'; 
$lang['SP_Display_most_viewed'] = 'Display most viewed pictures block';
$lang['SP_Display_random'] = 'Laat block met willekeurige foto\'s zien'; 
$lang['SP_Pic_row'] = 'Aantal regels met thumbnails in block laten zien'; 
$lang['SP_Pic_col'] = 'Aantal kolommen met thumbnails in block laten zien'; 
$lang['SP_Midthumb_use'] = 'Gebruik mid-thumbnail'; 
$lang['SP_Midthumb_cache'] = 'Laat het chach van mid-thumbnail toe'; 
$lang['SP_Midthumb_high'] = 'Hoogte van mid-thumbnail (pixel)'; 
$lang['SP_Midthumb_width'] = 'Breedte van mid-thumbnail (pixel)'; 
$lang['SP_Watermark'] = 'Gebruik watermerk'; 
$lang['SP_Watermark_users'] = 'Watermerk laten zien aan alle gebruikers, wanneer \'No\' (Nee) is ingesteld wordt het watermerk alleen aan niet geregisteerde gebruikers getoond'; 
$lang['SP_Watermark_placent'] = 'Watermerk positie op de foto'; 
$lang['SP_Hon_already_rated'] = 'Ongelimiteerd waarderen op Hot or Not pagina?'; 
$lang['SP_Hon_sep_rating'] = 'Hot or Not waarderingen in een apparte tabel opslaan'; 
$lang['SP_Hon_where'] = 'Uit welke categorieën moeten foto\'s worden getoond op hot or not pagina? (laat leeg voor foto\'s uit alle categorieën, bij meer dan één categorie, scheiden door komma’s)';
$lang['SP_Hon_users'] = 'Kunnen niet geregistreerde gebruikers waarderen?'; 

$lang['SP_Disabled'] = 'Uitgeschakeld'; 
$lang['SP_Enabled'] = 'Ingeschakeld'; 
$lang['SP_Yes'] = 'Ja'; 
$lang['SP_No'] = 'Nee'; 
$lang['SP_Always'] = 'Always';
$lang['SP_Submit'] = 'Opslaan'; 
$lang['SP_Reset'] = 'Wissen'; 

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
