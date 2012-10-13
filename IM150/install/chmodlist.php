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
  "album_mod/upload" => 777,
  "album_mod/upload/cache" => 777 ,
  "album_mod/upload/med_cache" => 777 ,
  "album_mod/upload/wm_cache" => 777 ,
  "backups" => 777 ,
  "cache" => 777 ,
  "cgi-bin/tmp" => 777 ,
  "cgi-bin/nuffload.cgi" => 666 , 
  "ctracker/logfiles/logfile_attempt_counter.txt" => 666 , 
  "ctracker/logfiles/logfile_blocklist.txt" => 666 ,
  "ctracker/logfiles/logfile_debug_mode.txt" => 666 ,
  "ctracker/logfiles/logfile_malformed_logins.txt" => 666 ,
  "ctracker/logfiles/logfile_spammer.txt" => 666 ,
  "ctracker/logfiles/logfile_worms.txt" => 666 , 
  "files" => 777 ,
  "files/thumbs" => 777 ,
  "images/avatars" => 777 ,
  "images/photos" => 777 ,
  "images/smiles" => 777 ,
  "includes/cache_tpls" => 777 , 
  "includes/def_auth.php" => 666 ,
  "includes/def_icons.php" => 666 ,
  "includes/def_qbar.php" => 666 ,
  "includes/def_themes.php" => 666 ,
  "includes/def_tree.php" => 666 ,
  "includes/def_words.php" => 666 ,

  "modules" => 777 ,
  "modules/cache" => 777 ,
  "modules/cache/explain" => 777 ,
  "pafiledb/cache" => 777 ,
  "pafiledb/cache/data_global.php" => 666 ,
  "pafiledb/cache/templates" => 777 ,

  "pafiledb/images/ss" => 777 ,
  "pafiledb/uploads" => 777 ,
  "profilcp/functions_profile.php" => 666 ,
  "profilcp/def" => 777 ,
  "profilcp/def/def_userfields.php" => 666 ,
  "profilcp/def/def_userfields_phpbb.php" => 666 ,
  "profilcp/def/def_userfuncs.php" => 666 ,
  "profilcp/def/def_userfuncs_album.php" => 666 ,
  "profilcp/def/def_userfuncs_bhere.php" => 666 ,
  "profilcp/def/def_userfuncs_cash.php" => 666 ,
  "profilcp/def/def_userfuncs_custom.php" => 666 ,
  "profilcp/def/def_userfuncs_skype.php" => 666 ,
  "profilcp/def/def_userfuncs_std.php" => 666 ,
  "profilcp/def/def_userfuncs_viewonline.php" => 666 ,
  "profilcp/def/def_userfuncs_vlist.php" => 666 ,
  "profilcp/def/def_userfuncs_warning.php" => 666 ,
  "profilcp/def/def_usermaps.php" => 666 ,
  "var_cache" => 777
);

//---------------------------------------------------------------------------------------------------------------------------------
// Chmod Settings array for languages
$installed_languages = array();
$language_list = array();
$dir = @opendir($relpath.'language');
while( $file = @readdir($dir) )
{
	if(substr($file,0,5) == 'lang_' && is_dir($relpath.'language/'.$file)){
		$installed_languages[] = substr($file,5);
	}
}
@closedir($dir);
for($i = 0; $i < count($installed_languages); $i++){
        $language_list1 = array(
        "language/lang_".$installed_languages[$i]."/lang_contact_faq.php" => 666
        );
	$lang_extend = array();
	$dir = @opendir($relpath.'language/lang_'.$installed_languages[$i]);
	while( $file = @readdir($dir) )
	{
		if(substr($file,0,11) == 'lang_extend' ){
			$lang_extend[] = $file;
		}
	}
	@closedir($dir);
	for($e = 0; $e < count($lang_extend); $e++){
                        $language_list2 = array(
                        "language/lang_".$installed_languages[$i]."/".$lang_extend[$e] => 666
                        );
	}

        $language_list3 = array(
        "language/lang_".$installed_languages[$i]."/lang_faq.php" => 666 ,
        "language/lang_".$installed_languages[$i]."/lang_faq_attach.php" => 666 ,
        "language/lang_".$installed_languages[$i]."/lang_prillian_faq.php" => 666
        );

}
$language_list = $language_list1 + $language_list2 + $language_list3;

//---------------------------------------------------------------------------------------------------------------------------------
// Chmod Settings array for pafile templates
$pafiledb_list = array();
$dir = @opendir($relpath.'pafiledb/cache/templates');
while( $file = @readdir($dir) )
{
	if(is_dir($relpath.'language/'.$file) && substr($file,0,1) != '.' ){

                $pafiledb_list = array(
                "pafiledb/cache/templates/".$file => 777 ,
                "pafiledb/cache/templates/".$file."/admin" => 777
                );
	}
}
@closedir($dir);

//---------------------------------------------------------------------------------------------------------------------------------
// Chmod Settings array for templates
$templates_list = array();
$dir = @opendir($relpath.'templates');
while( $file = @readdir($dir) )
{
	if(is_dir('templates/'.$file) && substr($file,0,1) != '.'){
                $templates_list = array(
                "templates/".$file."/sub_templates.cfg" => 666
                );
	}
}
@closedir($dir);

//---------------------------------------------------------------------------------------------------------------------------------
// Chmod Settings array for Pr�-install package ONLY
$preinstall_only_list = array(
  "includes/phpbb_security.php" => '666' ,
  "config.php" => '666'
);

//---------------------------------------------------------------------------------------------------------------------------------
// Chmod Settings array for Completely Installed package ONLY
$installed_only_list = array(
  "includes/phpbb_security.php" => '644' ,
  "config.php" => '644'
);



$preinstall_list = $file_list + $language_list + $templates_list + $pafiledb_list + $preinstall_only_list;
$afterinstall_list = $file_list + $language_list + $templates_list + $pafiledb_list + $installed_only_list;


}
?>