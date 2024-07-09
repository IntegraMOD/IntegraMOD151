<?php

/***************************************************************************
 *							admin_lang_validate.php
 *							---------------------
 *	begin				: 16/07/2005
 *	copyright		: The Integramod Team
 *	website			: www.integramod.com
 *
 *	version			: v 1.0.0 - 16/07/2005
 *
 ***************************************************************************/

define('IN_PHPBB', true);

if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['Languages']['Lang_validate'] = $file;
	return;
}

//
// functions
//

function validate_language(){
	global $phpbb_root_path, $phpEx, $board_config;
	echo '<hr>';
	// get installed langauges
	$installed_languages = array();
	$dir = @opendir($phpbb_root_path . 'language');
	while( $file = @readdir($dir) )
	{
		if(substr($file,0,5) == 'lang_' && is_dir($phpbb_root_path . 'language/'.$file)){
			$installed_languages[] = substr($file,5);
		}
	}
	@closedir($dir);
	// get all language files
	$language_files = array();
	for($i = 0; $i < count($installed_languages); $i++){
		$dir = @opendir($phpbb_root_path . 'language/lang_'.$installed_languages[$i]);
		while( $file = @readdir($dir) )
		{
			if(! is_dir($phpbb_root_path . 'language/lang_'.$installed_languages[$i].'/'.$file) 
					&& substr($file,-4) == '.'.$phpEx
					&& substr($file,0,5) == 'lang_'
					&& !in_array($file,$language_files)){
				$language_files[] = $file;
			}
		}
		@closedir($dir);
	}
	/* loop trough the lang files, 
			make a big array of each key found in each language
			include each file again and find the missing links compared to the big array */
	for($l = 0; $l < count($language_files); $l++){
		$language_file = $language_files[$l];
		// make union of each lang file
		$lang_union = array();
		for($i = 0; $i < count($installed_languages); $i++){
			$file = $phpbb_root_path . 'language/lang_'.$installed_languages[$i].'/'.$language_file;
			if(! file_exists($file)){
				echo '<hr> <font color="red">The file '.$language_file.' does not exist in language '.$installed_languages[$i].'</font>';
			} else {
				// reset lang
				$lang=array();
				include($file);
				$lang_union = array_merge($lang_union,$lang);
			}
		}
		// compare the union with each file in each language
		for($i = 0; $i < count($installed_languages); $i++){
			$lang_diff=array();
			$file = $phpbb_root_path . 'language/lang_'.$installed_languages[$i].'/'.$language_file;
			if(! file_exists($file)){
				echo '<hr> <font color="red">The file '.$language_file.' does not exist in language '.$installed_languages[$i].'</font>';
			} else {
				// reset lang
				$lang=array();
				include($file);
				// reset
				foreach ($lang_union as $key => $dummy)
				{
					if(!array_key_exists($key,$lang)){
						$lang_diff[] = $key;
					}
				}
				if(count($lang_diff)){
					echo '<hr><b>language keys missing for file '.$file.' :</b>';
					echo '<pre>';
					print_r($lang_diff);
					echo '</pre>';
				}
			}
		}
	}
	echo '<hr><pre>';
	print_r($installed_languages);
	print_r($language_files);
	echo '</pre>';
}

//
// Let's set the root dir for phpBB
//
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

// start
validate_language();

// dump
//$template->pparse('body');
include('./page_footer_admin.'.$phpEx);

?>
