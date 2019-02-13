<?php

function chmodlist()
{
// -------- FILES TO PROCESS ------------------------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------------------------------------------------
// The original script has been modified here
// Arrays are used to enable the use of more than one function on them
// The CHMOD mode has been changed to 3 numbers, because that's the way it works for the FTP method
// For the normal method '0' will be added by the chmod_routine function
// --------------------------------------------------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------------
// Chmod Settings array for pre-install and installed  ----------------------------------------------------------------------------
global $relpath, $preinstall_list, $afterinstall_list;
//---------------------------------------------------------------------------------------------------------------------------------
$file_list = array(
  "../album_mod/upload" => 777,
  "../album_mod/upload/cache" => 777 ,
  "../album_mod/upload/med_cache" => 777 ,
  "../album_mod/upload/wm_cache" => 777 ,
  "../backups" => 777 ,
  "../cache" => 777 ,
  "../ctracker/logfiles/logfile_attempt_counter.txt" => 666 , 
  "../ctracker/logfiles/logfile_blocklist.txt" => 666 ,
  "../ctracker/logfiles/logfile_debug_mode.txt" => 666 ,
  "../ctracker/logfiles/logfile_malformed_logins.txt" => 666 ,
  "../ctracker/logfiles/logfile_spammer.txt" => 666 ,
  "../ctracker/logfiles/logfile_worms.txt" => 666 , 
  "../files" => 777 ,
  "../files/thumbs" => 777 ,
  "../images/avatars" => 777 ,
  "../images/photos" => 777 ,
  "../images/smiles" => 777 ,
  "../includes/cache_tpls" => 777 , 
  "../includes/def_auth.php" => 666 ,
  "../includes/def_icons.php" => 666 ,
  "../includes/def_qbar.php" => 666 ,
  "../includes/def_themes.php" => 666 ,
  "../includes/def_tree.php" => 666 ,
  "../includes/def_words.php" => 666 ,

  "../language/lang_english/lang_contact_faq.php" => 666 ,
  "../language/lang_english/lang_extend.php" => 666 ,
  "../language/lang_english/lang_extend_announces.php" => 666 ,
  "../language/lang_english/lang_extend_categories_hierarchy.php" => 666 ,
  "../language/lang_english/lang_extend_group_moderatorz.php" => 666 ,
  "../language/lang_english/lang_extend_lang_extend.php" => 666 ,
  "../language/lang_english/lang_extend_last_topics_from.php" => 666 ,
  "../language/lang_english/lang_extend_merge.php" => 666 ,
  "../language/lang_english/lang_extend_meta_tags.php" => 666 ,
  "../language/lang_english/lang_extend_mods_settings.php" => 666 ,
  "../language/lang_english/lang_extend_pcp_addons.php" => 666 ,
  "../language/lang_english/lang_extend_pcp_management.php" => 666 ,
  "../language/lang_english/lang_extend_pcp_wiz.php" => 666 ,
  "../language/lang_english/lang_extend_post_icons.php" => 666 ,
  "../language/lang_english/lang_extend_profile_control_panel.php" => 666 ,
  "../language/lang_english/lang_extend_qbar.php" => 666 ,
  "../language/lang_english/lang_extend_ranks.php" => 666 ,
  "../language/lang_english/lang_extend_split_topic_type.php" => 666 ,
  "../language/lang_english/lang_extend_sub_template.php" => 666 ,
  "../language/lang_english/lang_extend_topic_calendar.php" => 666 ,
  "../language/lang_english/lang_faq.php" => 666 ,
  "../language/lang_english/lang_faq_attach.php" => 666 ,
  "../language/lang_english/lang_prillian_faq.php" => 666 ,

  "../language/lang_deutsch/lang_contact_faq.php" => 666 ,
  "../language/lang_deutsch/lang_extend.php" => 666 ,
  "../language/lang_deutsch/lang_extend_announces.php" => 666 ,
  "../language/lang_deutsch/lang_extend_categories_hierarchy.php" => 666 ,
  "../language/lang_deutsch/lang_extend_group_moderatorz.php" => 666 ,
  "../language/lang_deutsch/lang_extend_lang_extend.php" => 666 ,
  "../language/lang_deutsch/lang_extend_last_topics_from.php" => 666 ,
  "../language/lang_deutsch/lang_extend_merge.php" => 666 ,
  "../language/lang_deutsch/lang_extend_meta_tags.php" => 666 ,
  "../language/lang_deutsch/lang_extend_mods_settings.php" => 666 ,
  "../language/lang_deutsch/lang_extend_pcp_addons.php" => 666 ,
  "../language/lang_deutsch/lang_extend_pcp_management.php" => 666 ,
  "../language/lang_deutsch/lang_extend_pcp_wiz.php" => 666 ,
  "../language/lang_deutsch/lang_extend_post_icons.php" => 666 ,
  "../language/lang_deutsch/lang_extend_profile_control_panel.php" => 666 ,
  "../language/lang_deutsch/lang_extend_qbar.php" => 666 ,
  "../language/lang_deutsch/lang_extend_ranks.php" => 666 ,
  "../language/lang_deutsch/lang_extend_split_topic_type.php" => 666 ,
  "../language/lang_deutsch/lang_extend_sub_template.php" => 666 ,
  "../language/lang_deutsch/lang_extend_topic_calendar.php" => 666 ,
  "../language/lang_deutsch/lang_faq.php" => 666 ,
  "../language/lang_deutsch/lang_faq_attach.php" => 666 ,
  "../language/lang_deutsch/lang_prillian_faq.php" => 666 ,

  "../language/lang_francais/lang_contact_faq.php" => 666 ,
  "../language/lang_francais/lang_extend.php" => 666 ,
  "../language/lang_francais/lang_extend_announces.php" => 666 ,
  "../language/lang_francais/lang_extend_categories_hierarchy.php" => 666 ,
  "../language/lang_francais/lang_extend_group_moderatorz.php" => 666 ,
  "../language/lang_francais/lang_extend_lang_extend.php" => 666 ,
  "../language/lang_francais/lang_extend_last_topics_from.php" => 666 ,
  "../language/lang_francais/lang_extend_merge.php" => 666 ,
  "../language/lang_francais/lang_extend_meta_tags.php" => 666 ,
  "../language/lang_francais/lang_extend_mods_settings.php" => 666 ,
  "../language/lang_francais/lang_extend_pcp_addons.php" => 666 ,
  "../language/lang_francais/lang_extend_pcp_management.php" => 666 ,
  "../language/lang_francais/lang_extend_pcp_wiz.php" => 666 ,
  "../language/lang_francais/lang_extend_post_icons.php" => 666 ,
  "../language/lang_francais/lang_extend_profile_control_panel.php" => 666 ,
  "../language/lang_francais/lang_extend_qbar.php" => 666 ,
  "../language/lang_francais/lang_extend_ranks.php" => 666 ,
  "../language/lang_francais/lang_extend_split_topic_type.php" => 666 ,
  "../language/lang_francais/lang_extend_sub_template.php" => 666 ,
  "../language/lang_francais/lang_extend_topic_calendar.php" => 666 ,
  "../language/lang_francais/lang_faq.php" => 666 ,
  "../language/lang_francais/lang_faq_attach.php" => 666 ,
  "../language/lang_francais/lang_prillian_faq.php" => 666 ,

  "../language/lang_hebrew/lang_contact_faq.php" => 666 ,
  "../language/lang_hebrew/lang_extend.php" => 666 ,
  "../language/lang_hebrew/lang_extend_announces.php" => 666 ,
  "../language/lang_hebrew/lang_extend_categories_hierarchy.php" => 666 ,
  "../language/lang_hebrew/lang_extend_group_moderatorz.php" => 666 ,
  "../language/lang_hebrew/lang_extend_lang_extend.php" => 666 ,
  "../language/lang_hebrew/lang_extend_last_topics_from.php" => 666 ,
  "../language/lang_hebrew/lang_extend_merge.php" => 666 ,
  "../language/lang_hebrew/lang_extend_meta_tags.php" => 666 ,
  "../language/lang_hebrew/lang_extend_mods_settings.php" => 666 ,
  "../language/lang_hebrew/lang_extend_pcp_addons.php" => 666 ,
  "../language/lang_hebrew/lang_extend_pcp_management.php" => 666 ,
  "../language/lang_hebrew/lang_extend_pcp_wiz.php" => 666 ,
  "../language/lang_hebrew/lang_extend_post_icons.php" => 666 ,
  "../language/lang_hebrew/lang_extend_profile_control_panel.php" => 666 ,
  "../language/lang_hebrew/lang_extend_qbar.php" => 666 ,
  "../language/lang_hebrew/lang_extend_ranks.php" => 666 ,
  "../language/lang_hebrew/lang_extend_split_topic_type.php" => 666 ,
  "../language/lang_hebrew/lang_extend_sub_template.php" => 666 ,
  "../language/lang_hebrew/lang_extend_topic_calendar.php" => 666 ,
  "../language/lang_hebrew/lang_faq.php" => 666 ,
  "../language/lang_hebrew/lang_faq_attach.php" => 666 ,
  "../language/lang_hebrew/lang_prillian_faq.php" => 666 ,

  "../language/lang_nederlands/lang_contact_faq.php" => 666 ,
  "../language/lang_nederlands/lang_extend.php" => 666 ,
  "../language/lang_nederlands/lang_extend_announces.php" => 666 ,
  "../language/lang_nederlands/lang_extend_categories_hierarchy.php" => 666 ,
  "../language/lang_nederlands/lang_extend_group_moderatorz.php" => 666 ,
  "../language/lang_nederlands/lang_extend_lang_extend.php" => 666 ,
  "../language/lang_nederlands/lang_extend_last_topics_from.php" => 666 ,
  "../language/lang_nederlands/lang_extend_merge.php" => 666 ,
  "../language/lang_nederlands/lang_extend_meta_tags.php" => 666 ,
  "../language/lang_nederlands/lang_extend_mods_settings.php" => 666 ,
  "../language/lang_nederlands/lang_extend_pcp_addons.php" => 666 ,
  "../language/lang_nederlands/lang_extend_pcp_management.php" => 666 ,
  "../language/lang_nederlands/lang_extend_pcp_wiz.php" => 666 ,
  "../language/lang_nederlands/lang_extend_post_icons.php" => 666 ,
  "../language/lang_nederlands/lang_extend_profile_control_panel.php" => 666 ,
  "../language/lang_nederlands/lang_extend_qbar.php" => 666 ,
  "../language/lang_nederlands/lang_extend_ranks.php" => 666 ,
  "../language/lang_nederlands/lang_extend_split_topic_type.php" => 666 ,
  "../language/lang_nederlands/lang_extend_sub_template.php" => 666 ,
  "../language/lang_nederlands/lang_extend_topic_calendar.php" => 666 ,
  "../language/lang_nederlands/lang_faq.php" => 666 ,
  "../language/lang_nederlands/lang_faq_attach.php" => 666 ,
  "../language/lang_nederlands/lang_prillian_faq.php" => 666 ,

  "../modules" => 777 ,
  "../modules/cache" => 777 ,
  "../modules/cache/explain" => 777 ,
  "../pafiledb/cache" => 777 ,
  "../pafiledb/cache/data_global.php" => 666 ,
  "../pafiledb/cache/templates" => 777 ,

  "../pafiledb/images/ss" => 777 ,
  "../pafiledb/uploads" => 777 ,
  "../profilcp/functions_profile.php" => 666 ,
  "../profilcp/def" => 777 ,
  "../profilcp/def/def_userfields.php" => 666 ,
  "../profilcp/def/def_userfields_phpbb.php" => 666 ,
  "../profilcp/def/def_userfuncs.php" => 666 ,
  "../profilcp/def/def_userfuncs_album.php" => 666 ,
  "../profilcp/def/def_userfuncs_bhere.php" => 666 ,
  "../profilcp/def/def_userfuncs_cash.php" => 666 ,
  "../profilcp/def/def_userfuncs_custom.php" => 666 ,
  "../profilcp/def/def_userfuncs_skype.php" => 666 ,
  "../profilcp/def/def_userfuncs_std.php" => 666 ,
  "../profilcp/def/def_userfuncs_viewonline.php" => 666 ,
  "../profilcp/def/def_userfuncs_vlist.php" => 666 ,
  "../profilcp/def/def_userfuncs_warning.php" => 666 ,
  "../profilcp/def/def_usermaps.php" => 666 ,
  "../templates/Default/sub_templates.cfg" => 666 ,
  "../var_cache" => 777
);

//---------------------------------------------------------------------------------------------------------------------------------
// Chmod Settings array for pafile templates
$pafiledb_list = array();
$dir = @opendir($relpath.'pafiledb/cache/templates');
while( $file = @readdir($dir) )
{
	if(is_dir($relpath.'language/'.$file) && substr($file,0,1) != '.' ){

                $pafiledb_list = array(
                "../pafiledb/cache/templates/".$file => 777 ,
                "../pafiledb/cache/templates/".$file."/admin" => 777
                );
	}
}
@closedir($dir);

//---------------------------------------------------------------------------------------------------------------------------------
// Chmod Settings array for Pre-install package ONLY
$preinstall_only_list = array(
  "../includes/phpbb_security.php" => '666' ,
  "../config.php" => '666'
);

//---------------------------------------------------------------------------------------------------------------------------------
// Chmod Settings array for Completely Installed package ONLY
$installed_only_list = array(
  "../includes/phpbb_security.php" => '644' ,
  "../config.php" => '644'
);



$preinstall_list = $file_list + $pafiledb_list + $preinstall_only_list;
$afterinstall_list = $file_list + $pafiledb_list + $installed_only_list;


}
?>