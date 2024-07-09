<?php

/***************************************************************************
 *							admin_lang_extend.php
 *							---------------------
 *	begin				: 29/09/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: v 1.0.0 - 29/09/2003
 *
 ***************************************************************************/

define('IN_PHPBB', true);

if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['Languages']['Lang_management'] = $file;
	return;
}

$value_maxlength = 250;

//
// functions
//
function lang_extend_get_lang($key)
{
	global $lang;
	return ( (!empty($key) && isset($lang[$key])) ? $lang[$key] : $key );
}

function lang_extend_get_countries()
{
	global $phpbb_root_path, $phpEx;

	// get all countries installed
	$countries = array();
	$dir = @opendir($phpbb_root_path . './language');
	while ( $file = @readdir($dir) )
	{
		if ( preg_match('#^lang_#i', $file) && !is_file($phpbb_root_path . './language/' . $file) && !is_link($phpbb_root_path . './language/' . $file) )
		{
			$filename = trim( str_replace('lang_', '', $file) );
			$displayname = preg_replace("/^(.*?)_(.*)$/", "\\1 [ \\2 ]", $filename);
			$displayname = preg_replace("/\[(.*?)_(.*)\]/", "[ \\1 - \\2 ]", $displayname);
			$countries[$file] = ucfirst($displayname);
		}
	}
	@closedir($dir);
	@asort($countries);

	return $countries;
}

function lang_extend_get_packs()
{
	global $phpbb_root_path, $phpEx;
	global $countries;

	// get all the extensions installed
	$packs = array();
	foreach ($countries as $country_dir => $country_name)
	{
		$dir = @opendir( $phpbb_root_path . './language/' . $country_dir );
		while ( $file = @readdir($dir) )
		{
			if( preg_match("/^lang_extend_.*?\." . $phpEx . "$/", $file) )
			{
				$displayname = trim( str_replace(".$phpEx", '', str_replace('lang_extend_', '', $file)) );
				$packs[$file] = $displayname;
			}
		}
		@closedir($dir);
	}
	$packs['lang'] = '_phpBB';
	$packs['custom'] = '_custom';
	@asort($packs);

	return $packs;
}

function lang_extend_read_one_pack($country_dir, $pack_file, &$entries)
{
	global $phpbb_root_path, $phpEx;
	global $countries, $packs;

	// get filename
	$file = $phpbb_root_path . './language/' . $country_dir . '/' . $pack_file;

	// process first admin then standard keys
	for ( $i=0; $i < 2; $i++ )
	{
		$lang_extend_admin = ($i==0);

		// fix the filename for standard keys
		if ($pack_file == 'lang')
		{
			$file = $phpbb_root_path . './language/' . $country_dir . '/' . ($lang_extend_admin ? 'lang_admin.' : 'lang_main.') . $phpEx;
		}
		// fix the filename for custom keys
		if ($pack_file == 'custom')
		{
			$file = $phpbb_root_path . './language/' . $country_dir . '/' . 'lang_extend.' . $phpEx;
		}

		// process
		$lang = array();
		@include($file);
		foreach ($lang as $key_main => $data)
		{
			$custom = ($pack_file == 'custom');
			$first = !is_array($data);
			while ( ( is_array($data) && $data[0] ) || $first )
			{
				$key_sub = $data[0];
				$value = $data[1];
				$first = false;
				if ( !is_array($data) )
				{
					$key_sub = '';
					$value = $data;
				}
				$pack = $pack_file;
				$original = '';
				if ( $custom && isset($entries['pack'][$key_main][$key_sub]) )
				{
					$pack = $entries['pack'][$key_main][$key_sub];
					$original = $entries['pack'][$key_main][$key_sub][$country_dir];
				}
				$entries['pack'][$key_main][$key_sub] = $pack;
				$entries['value'][$key_main][$key_sub][$country_dir] = $value;
				$entries['original'][$key_main][$key_sub][$country_dir] = $original;
				$entries['admin'][$key_main][$key_sub] = $lang_extend_admin;
				// status : 0=original, 1=modified, 2=added
				$entries['status'][$key_main][$key_sub][$country_dir] = ( !$custom ? 0 : ( ($pack != $pack_file) ? 1 : 2 ) );
			}
		}
	}
}

function lang_extend_get_entries($modified=true)
{
	global $phpbb_root_path, $phpEx, $board_config;
	global $countries, $packs;

	// init
	$entries = array();

	// process by countries first
	foreach ($countries as $country_dir => $country_name)
	{
		// phpBB lang keys
		$pack_file = 'lang';
		lang_extend_read_one_pack($country_dir, $pack_file, $entries);
	}

	// process other packs except custom one
	@reset($countries);
	while ( list($country_dir, $country_name) = @each($countries) )
	{
		@reset($packs);
		while ( list($pack_file, $pack_name) = @each($packs) )
		{
			if ( ($pack_file != 'lang') && ($pack_file != 'custom') )
			{
				lang_extend_read_one_pack($country_dir, $pack_file, $entries);
			}
		}
	}

	// process the added/modified keys
	if ( $modified )
	{
		@reset($countries);
		while ( list($country_dir, $country_name) = @each($countries) )
		{
			$pack_file = 'custom';
			lang_extend_read_one_pack($country_dir, $pack_file, $entries);
		}

		// add the missing keys in a language
		$default_lang = 'lang_' . $board_config['default_lang'];
		$english_lang = 'lang_english';
		@reset($entries['pack']);
		while ( list($key_main, $data) = @each($entries['pack']) )
		{
			@reset($data);
			while ( list($key_sub, $pack_file) = @each($data) )
			{
				// add the key to the default lang if missing by using the english one
				if ( !isset($entries['value'][$key_main][$key_sub][$default_lang]) )
				{
					// add the key to english lang if missing
					if ( !isset($entries['value'][$key_main][$key_sub][$english_lang]) )
					{
						// find the first not empty value
						$found = false;
						$new_value = '';
						@reset($entries['value'][$key_main][$key_sub]);
						while ( list($country_dir, $value) = @each($entries['value'][$key_main][$key_sub]) )
						{
							$found = !empty($value);
							if ( $found )
							{
								$new_value = $value;
							}
						}
						// add it (even if empty)
						$entries['value'][$key_main][$key_sub][$english_lang] = $new_value;
						$entries['status'][$key_main][$key_sub][$english_lang] = 2; // 2=added
					}

					// fill the default lang
					if ( $default_lang!= $english_lang )
					{
						$entries['value'][$key_main][$key_sub][$default_lang] = $entries['value'][$key_main][$key_sub][$english_lang];
						$entries['status'][$key_main][$key_sub][$default_lang] = 2; // 2=added
					}
				}

				// process all langs for this key
				@reset($countries);
				while ( list($country_dir, $country_name) = @each($countries) )
				{
					if ( !isset($entries['value'][$key_main][$key_sub][$country_dir]) )
					{
						$entries['value'][$key_main][$key_sub][$country_dir] = $entries['value'][$key_main][$key_sub][$default_lang];
						$entries['status'][$key_main][$key_sub][$country_dir] = 2; // 2=added
					}
				}
			}
		}
	}

	// all is done : return the result
	return $entries;
}

function lang_extend_write($entries)
{
	global $template, $userdata, $phpbb_root_path, $phpEx, $lang;
	global $countries, $packs;

	// read old values
	$old_entries = lang_extend_get_entries(false);

	// regenerate each file (per country then per pack)
	$edittime = date('Y/m/d H:i:s', time());
	@reset($countries);
	while ( list( $country_dir, $country_name ) = each($countries) )
	{
		// init
		$local = array();

		// read packs
		@reset($packs);
		while ( list($pack_file, $pack_name) = @each($packs) )
		{
			// read keys
			@reset($entries['admin']);
			while ( list( $key_main, $data ) = @each($entries['admin']) )
			{
				@reset($data);
				while ( list($key_sub, $admin) = @each($data) )
				{
					// get original pack if entry exists
					$pack = 'custom';
					if ( isset($old_entries['pack'][$key_main][$key_sub]) )
					{
						$pack = $old_entries['pack'][$key_main][$key_sub];
					}
					if ($pack == $pack_file)
					{
						// is it a new entry ?
						$modified_added = false;
						if ( !isset($old_entries['value'][$key_main][$key_sub][$country_dir]) || ($entries['value'][$key_main][$key_sub][$country_dir] != $old_entries['value'][$key_main][$key_sub][$country_dir]) )
						{
							$modified_added = true;
						}

						// if modified or new entry, get it
						if ( $modified_added || ($pack == 'custom') )
						{
							$std = !$entries['admin'][$key_main][$key_sub];
							$local[$std][$pack][$key_main][$key_sub] = $entries['value'][$key_main][$key_sub][$country_dir];
						}
					}
				}
			}
		}
		@ksort($local);

		// save template state
		$sav_tpl = $template->_tpldata;

		// template
		$template->set_filenames(array(
			'_outfile' => 'admin/lang_extend_def.tpl')
		);

		$template->assign_vars(array(
			'COUNTRY_NAME'	=> $country_name,
			'EDITTIME'		=> $edittime,
			'USERNAME'		=> $userdata['username'],
			)
		);

		// read admin/standard type of key
		$admin_processed = false;
		@reset( $local );
		while ( list($std, $pack_data) = @each($local) )
		{
			$prefix = $std ? 'normal' : 'admin';
			if ($std && !$admin_processed)
			{
				$template->assign_block_vars('admin', array());
			}

			// start the block
			$template->assign_block_vars($prefix, array());
			$admin_processed = true;
			$first = true;

			// read pack
			@reset($pack_data);
			while ( list($pack_file, $key_data) = @each($pack_data) )
			{
				// send comment of the pack
				$template->assign_block_vars($prefix . '.pack', array(
					'TITLE'	=> $pack_file . ' - ' . $lang[ 'Lang_extend_' . $packs[$pack_file] ],
					)
				);
				if ( !$first )
				{
					// linefeed
					$template->assign_block_vars($prefix . '.pack.linefeed', array());
				}
				$first = false;

				// read key main
				@reset($key_data);
				while ( list($key_main, $sub_data) = @each($key_data) )
				{
					// read key sub
					@reset($sub_data);
					while ( list($key_sub, $value) = @each($sub_data) )
					{
						$template->assign_block_vars($prefix . '.pack.entry', array(
							'KEY_MAIN'	=> str_replace("'", "\'", str_replace("''", "'", stripslashes($key_main))),
							'KEY_SUB'	=> str_replace("'", "\'", str_replace("''", "'", stripslashes($key_sub))),
							'VALUE'		=> str_replace("'", "\'", str_replace("''", "'", stripslashes($value))),
							)
						);
						$n_sub = intval($key_sub);
						if ( !empty($key_sub) || ($key_sub == "$n_sub") )
						{
							$template->assign_block_vars($prefix . '.pack.entry.switch_double', array());
						}
						else
						{
							$template->assign_block_vars($prefix . '.pack.entry.switch_simple', array());
						}
					}
				}
			}
		}

		// generate a var for the content
		$template->assign_var_from_handle('_def', '_outfile');
		$res = $template->_tpldata['.'][0]['_def'];

		// ouput to the profilcp/def_user_vlists.php
		$filename = $phpbb_root_path . './language/' . $country_dir . '/lang_extend.' . $phpEx;
		@CHMOD($filename, 0666);
		@unlink($filename);
		$f = @fopen($filename, 'w' );
		$texte  = "<?php\n$res\n?>";
		@fputs( $f, $texte );
		@ftruncate( $f );
		@fclose( $f );

		// restore template
		$template->_tpldata = $sav_tpl;
	}
}

//
// Let's set the root dir for phpBB
//
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

// get languages installed
$countries = lang_extend_get_countries();

// get packs installed
$packs = lang_extend_get_packs();

// get entries (all lang keys)
$entries = lang_extend_get_entries();

//  get parameters
$mode = '';
if (isset($_POST['mode']) || isset($_GET['mode']) )
{
	$mode = isset($_POST['mode']) ? $_POST['mode'] : $_GET['mode'];
}
if ( !in_array($mode, array('pack', 'key')) )
{
	$mode = '';
}

// level
$level = 'normal';
if ( isset($_POST['level']) || isset($_GET['level']) )
{
	$level = isset($_POST['level']) ? urldecode($_POST['level']) : urldecode($_GET['level']);
}
if ( !in_array($level, array('normal', 'admin')) )
{
	$level = 'normal';
}

// pack file
$pack_file = '';
if ( isset($_POST['pack_file']) || isset($_GET['pack']) )
{
	$pack_file = isset($_POST['pack_file']) ? urldecode($_POST['pack_file']) : urldecode($_GET['pack']);
}
if ( !isset($packs[$pack_file]) )
{
	$pack_file = '';
	$mode = '';
}

// keys
$key_main = '';
if ( isset($_POST['key_main']) || isset($_GET['key']) )
{
	$key_main = isset($_POST['key_main']) ? urldecode($_POST['key_main']) : urldecode($_GET['key']);
}
$key_sub = '';
if ( isset($_POST['key_sub']) || isset($_GET['sub']) )
{
	$key_sub = isset($_POST['key_sub']) ? urldecode($_POST['key_sub']) : urldecode($_GET['sub']);
}
if ( empty($key_main) )
{
	$key_sub = '';
}
if ( !isset($entries['admin'][$key_main][$key_sub]) )
{
	$key_main = '';
	$key_sub = '';
}

// buttons
$submit = isset($_POST['submit']);
$delete = isset($_POST['delete']);
$cancel = isset($_POST['cancel']);
$add = isset($_POST['add']);
if ($add || $delete)
{
	$mode = 'key';
}
if ( ($mode == 'key') && ($pack_file == '') )
{
	$mode = '';
}

if ( ($mode == '') && $submit )
{
	$mode = 'search';
}

// key edition
if ($mode == 'key')
{
	if ($delete)
	{
		$new_entries = array();
		@reset( $entries['admin'] );
		while ( list( $new_main, $subs ) = @each( $entries['admin'] ) )
		{
			@reset($subs);
			while ( list( $new_sub, $admin ) = @each( $subs ) )
			{
				if ( ($new_main != $key_main) || ($new_sub != $key_sub) )
				{
					$new_entries['admin'][$new_main][$new_sub] = $entries['admin'][$new_main][$new_sub];
					$new_entries['pack'][$new_main][$new_sub] = $entries['pack'][$new_main][$new_sub];
					$new_entries['value'][$new_main][$new_sub] = $entries['value'][$new_main][$new_sub];
				}
			}
		}

		// write the result
		lang_extend_write($new_entries);

		// send message
		$pack_url = append_sid("./admin_lang_extend.$phpEx?mode=pack&pack=" . urlencode($pack_file) . "&level=" . urlencode(($level == 'normal') ? 'normal' : 'admin') );
		message_die(GENERAL_MESSAGE, sprintf($lang['Lang_extend_delete_done'], '<a href="' . $pack_url . '">', '</a>'));

		// back to the liset
		$mode = 'pack';
		$delete = false;
	}
	else if ( $cancel )
	{
		// back to list
		$mode = 'pack';
		$cancel = false;
	}
	else if ( $submit )
	{
		// get formular
		$new_main = $_POST['new_main'];
		$new_sub = $_POST['new_sub'];
		$new_level = $_POST['new_level'];
		$new_values = $_POST['new_values'];
		$new_pack = $_POST['new_pack'];

		// force
		if ( !in_array($new_level, array('normal', 'admin')) )
		{
			$new_level = 'normal';
		}

		// check values
		$error = false;
		$error_msg = false;
		$dft_country = 'lang_' . $board_config['default_language'];
		@reset($countries);
		while ( list($country_dir, $country_name) = @each($countries) )
		{
			if ( empty($new_values[$country_dir]) )
			{
				$new_values[$country_dir] = $new_values[$dft_country];
			}
			if ( empty($new_values[$country_dir]) && ($dft_country != 'lang_english') )
			{
				$new_values[$country_dir] = $new_values['lang_english'];
			}
			if ( empty($new_values[$country_dir]) && !$error )
			{
				$error = true;
				$error_msg .= ( empty($error_msg) ? '' : '<br /><br />' ) . $lang['Lang_extend_missing_value'];
			}
		}

		// empty key
		if ( empty($new_main) )
		{
			$error = true;
			$error_msg .= ( empty($error_msg) ? '' : '<br /><br />' ) . $lang['Lang_extend_key_missing'];
		}

		// we changed the key or create a new one
		if ( !empty($new_main) && ( ($new_main != $key_main) || ($new_sub != $key_sub) ) )
		{
			// does the new key already exists ?
			if ( isset($entries['admin'][$new_key][$new_sub]) )
			{
				$error = true;
				$error_msg .= ( empty($error_msg) ? '' : '<br /><br />' ) . sprintf( $lang['Lang_extend_duplicate_entry'], lang_extend_get_lang($entries['pack'][$new_key][$new_sub]) );
			}
		}

		// error
		if ( $error )
		{
			message_die(GENERAL_MESSAGE, '<br />' . $error_msg . '<br /><br />');
			exit;
		}

		// perform the update
		$entries['pack'][$new_main][$new_sub] = $new_pack;
		$entries['admin'][$new_main][$new_sub] = ($new_level == 'admin');
		@reset($new_values);
		while ( list($new_country, $new_value) = @each($new_values) )
		{
			if ( !empty($new_value) )
			{
				$entries['value'][$new_main][$new_sub][$new_country] = $new_value;
			}
		}
		lang_extend_write($entries);

		// send message
		$key_url = append_sid("./admin_lang_extend.$phpEx?mode=key&pack=" . urlencode($new_pack) . "&key=" . urlencode($new_main) . "&sub=" . urlencode($new_sub) . "&level=" . urlencode(($new_level == 'normal') ? 'normal' : 'admin') );
		$pack_url = append_sid("./admin_lang_extend.$phpEx?mode=pack&pack=" . urlencode($new_pack) . "&level=" . urlencode(($new_level == 'normal') ? 'normal' : 'admin') );
		message_die(GENERAL_MESSAGE, sprintf($lang['Lang_extend_update_done'], '<a href="' . $key_url . '">','</a>', '<a href="' . $pack_url . '">', '</a>'));
	}
	else
	{
		// template
		$template->set_filenames(array(
			'body' => 'admin/lang_extend_key_body.tpl')
		);

		// header
		$template->assign_vars(array(
			'L_TITLE'			=> $lang['Lang_extend'],
			'L_TITLE_EXPLAIN'	=> $lang['Lang_extend_explain'],
			'L_KEY'				=> $lang['Lang_extend_entry'],
			'L_LANGUAGES'		=> $lang['Languages'],

			'L_SUBMIT'			=> $lang['Submit'],
			'L_DELETE'			=> $lang['Delete'],
			'L_CANCEL'			=> $lang['Cancel'],
			)
		);

		// pack list
		$s_packs = '';
		@reset($packs);
		while ( list($file, $name) = @each($packs) )
		{
			$selected = ($file == $pack_file) ? ' selected="selected"' : '';
			$s_packs .= '<option value="' . $pack . '"' . $selected . '">' . lang_extend_get_lang('Lang_extend_' . $name) . '</option>';
		}
		if ( !empty($s_packs) )
		{
			$s_packs = sprintf( '<select name="new_pack">%s</select>', $s_packs );
		}

		// vars
		$template->assign_vars(array(
			'L_KEY_MAIN'			=> $lang['Lang_extend_key_main'],
			'L_KEY_MAIN_EXPLAIN'	=> $lang['Lang_extend_key_main_explain'],
			'KEY_MAIN'				=> $key_main,
			'L_KEY_SUB'				=> $lang['Lang_extend_key_sub'],
			'L_KEY_SUB_EXPLAIN'		=> $lang['Lang_extend_key_sub_explain'],
			'KEY_SUB'				=> $key_sub,

			'L_PACK'				=> $lang['Lang_extend_pack'],
			'L_PACK_EXPLAIN'		=> $lang['Lang_extend_pack_explain'],
			'S_PACKS'				=> $s_packs,

			'L_LEVEL'				=> $lang['Lang_extend_level'],
			'L_LEVEL_EXPLAIN'		=> $lang['Lang_extend_level_explain'],
			'LEVEL_NORMAL'			=> 'normal',
			'S_LEVEL_NORMAL'		=> ($level == 'normal') ? 'checked="checked"' : '',
			'L_LEVEL_NORMAL'		=> ucfirst($lang['Lang_extend_level_normal']),
			'LEVEL_ADMIN'			=> 'admin',
			'S_LEVEL_ADMIN'			=> ($level != 'normal') ? 'checked="checked"' : '',
			'L_LEVEL_ADMIN'			=> ucfirst($lang['Lang_extend_level_admin']),

			'L_PACKS'				=> $lang['Lang_extend_pack'],
			'L_PACKS'				=> $lang['Lang_extend_pack_explain'],
			)
		);

		// get all language values
		@reset($countries);
		while ( list($country_dir, $country_name) = each($countries) )
		{
			$value = $entries['value'][$key_main][$key_sub][$country_dir];
			$status = $entries['status'][$key_main][$key_sub][$country_dir];
			$l_status = '';
			switch ( $status )
			{
				case 1:
					$l_status = $lang['Lang_extend_modified'];
					break;
				case 2:
					$l_status = $lang['Lang_extend_added'];
					break;
				default:
					$l_status = '';
					break;
			}
			$template->assign_block_vars('row', array(
				'L_COUNTRY'	=> $country_name,
				'COUNTRY'	=> $country_dir,
				'VALUE'		=> $value,
				'L_STATUS'	=> $l_status,
				)
			);
		}

		// footer
		$s_hidden_fields = '';
		$s_hidden_fields .= '<input type="hidden" name="mode" value="' . $mode . '" />';
		$s_hidden_fields .= '<input type="hidden" name="pack_file" value="' . urlencode($pack_file) . '" />';
		$s_hidden_fields .= '<input type="hidden" name="key_main" value="' . urlencode($key_main) . '" />';
		$s_hidden_fields .= '<input type="hidden" name="key_sub" value="' . urlencode($key_sub) . '" />';
		$s_hidden_fields .= '<input type="hidden" name="level" value="' . urlencode($level) . '" />';
		$template->assign_vars(array(
			'S_ACTION'			=> append_sid("./admin_lang_extend.$phpEx"),
			'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
			)
		);
	}
}

// pack
if ($mode == 'pack')
{
	if ( $cancel )
	{
		// back to the main list
		$mode = '';
		$cancel = false;
	}
	else
	{
		// template
		$template->set_filenames(array(
			'body' => 'admin/lang_extend_pack_body.tpl')
		);

		// header
		$template->assign_vars(array(
			'L_TITLE'			=> $lang['Lang_extend'],
			'L_TITLE_EXPLAIN'	=> $lang['Lang_extend_explain'],
			'LEVEL'				=> ($level == 'admin') ? $lang['Lang_extend_level_admin'] : $lang['Lang_extend_level_normal'],

			'L_PACK'			=> $lang['Lang_extend_pack'],
			'U_PACK'			=> append_sid("./admin_lang_extend.$phpEx"),
			'PACK'				=> lang_extend_get_lang('Lang_extend_' . $packs[$pack_file]),

			'L_LEVEL_NEXT'		=> ($level == 'admin') ? 'normal' : 'admin',
			'U_LEVEL_NEXT'		=> append_sid("./admin_lang_extend.$phpEx?mode=pack&pack=" . urlencode($pack_file) . "&level=" . urlencode(($level == 'admin') ? 'normal' : 'admin') ),

			'L_KEYS'			=> $lang['Lang_extend_entries'],
			'L_NONE'			=> $lang['None'],
			'L_ADD'				=> $lang['Lang_extend_add_entry'],
			'L_CANCEL'			=> $lang['Cancel'],
			)
		);

		// dump
		$color = false;
		$i = 0;
		@reset($entries['pack']);
		while ( list($key_main, $data) = @each($entries['pack']) )
		{
			@reset($data);
			while ( list($key_sub, $pack) = @each($data) )
			{
				if ( ($pack == $pack_file) && ( ($entries['admin'][$key_main][$key_sub] && ($level == 'admin')) || (!$entries['admin'][$key_main][$key_sub] && ($level == 'normal')) ) )
				{
					$value = trim( ( empty($key_sub) ? $lang[$key_main] : $lang[$key_main][$key_sub] ) );
					if ( strlen($value) > $value_maxlength )
					{
						$value = substr($value, 0, $value_maxlength-3) . '...';
					}
					$value = htmlspecialchars($value);

					// get the status
					$modified_added = false;
					if ($pack != 'custom')
					{
						$found = false;
						@reset($entries['status'][$key_main][$key_sub]);
						while ( list($country_dir, $status) = @each($entries['status'][$key_main][$key_sub]) )
						{
							$found = ($status > 0);
							if ( $found )
							{
								$modified_added = true;
								break;
							}
						}
					}

					$i++;
					$color = !$color;
					$template->assign_block_vars('row', array(
						'CLASS'		=> $color ? 'row1' : 'row2',
						'KEY_MAIN'	=> "['" . $key_main . "']",
						'KEY_SUB'	=> empty($key_sub) ? '' : "['" . $key_sub . "']",
						'U_KEY'		=> append_sid("./admin_lang_extend.$phpEx?mode=key&pack=" . urlencode($pack_file) . "&level=" . urlencode($level) . "&key=" . urlencode($key_main) . "&sub=" . urlencode($key_sub)),
						'VALUE'		=> $value,
						'STATUS'	=> $modified_added ? $lang['Lang_extend_added_modified'] : '',
						)
					);
				}
			}
		}
		if ( $i == 0 )
		{
			$template->assign_block_vars('none', array());
		}

		// footer
		$s_hidden_fields = '';
		$s_hidden_fields .= '<input type="hidden" name="mode" value="' . $mode . '" />';
		$s_hidden_fields .= '<input type="hidden" name="pack_file" value="' . urlencode($pack_file) . '" />';
		$s_hidden_fields .= '<input type="hidden" name="level" value="' . urlencode($level) . '" />';
		$template->assign_vars(array(
			'S_ACTION'			=> append_sid("./admin_lang_extend.$phpEx"),
			'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
			)
		);
	}
}

// search
if ( $mode == 'search' )
{
	if ($cancel)
	{
		$cancel = '';
		$mode = '';
	}
	else
	{
		// formular
		$search_words = str_replace("\'", "'", str_replace("''", "'", trim($_POST['search_words'])));
		$search_logic = intval($_POST['search_logic']);
		$search_in = intval($_POST['search_in']);
		$search_country = $_POST['search_language'];
		$search_admin = intval($_POST['search_admin']);

		// results
		$results = array();

		// get all the words to search
		if ( empty($search_words) )
		{
			$main_url = append_sid("./admin_lang_extend.$phpEx");
			message_die(GENERAL_MESSAGE, sprintf($lang['Lang_extend_search_no_words'], '<a href="' . $main_url . '">', '</a>') );
			exit;
		}
		$w_words = explode(' ', strtolower( str_replace('_', ' ', str_replace("\'", "'", str_replace("''", "'", $search_words))) ));
		for ($i = 0; $i < count($w_words); $i++)
		{
			if ( !empty($w_words[$i]) )
			{
				$words[] = $w_words[$i];
			}
		}

		// check each entry
		@reset($entries['pack']);
		while ( list($key_main, $subs) = @each($entries['pack']) )
		{
			@reset($subs);
			while ( list( $key_sub, $pack_dir ) = @each( $subs ) )
			{
				$admin = $entries['admin'][$key_main][$key_sub];
				if ( ( $admin && ($search_admin != 1) ) || ( !$admin && ($search_admin != 0) ) )
				{
					$w_key = strtolower(str_replace('_', ' ', str_replace("\'", "'", str_replace("''", "'", $key_main)) ));
					$w_key .=  ' ' . strtolower(str_replace('_', ' ', str_replace("\'", "'", str_replace("''", "'", $key_sub)) ));
					$w_words = explode(' ', $w_key);

					$words_key = array();
					for ($i = 0; $i < count($w_words); $i++)
					{
						if ( !empty($w_words[$i]) )
						{
							$words_key[] = $w_words[$i];
						}
					}

					$words_val = array();
					@reset($countries);
					while ( list( $country, $country_name ) = @each($countries) )
					{
						if ( empty($search_country) || ($country == $search_country) )
						{
							$w_words_val = explode(' ', strtolower( str_replace("\'", "'", str_replace("''", "'", $entries['value'][$key_main][$key_sub][$country])) ));
							for ($i = 0; $i < count($w_words_val); $i++)
							{
								if ( !empty($w_words_val[$i]) )
								{
									if ( empty($words_val) || !in_array($w_words_val[$i], $words_val) )
									{
										$words_val[] = $w_words_val[$i];
									}
								}
							}
						}
					}

					// is this key convenient ?
					$ok = ($search_logic == 0);
					for ($i = 0; $i < count($words); $i++)
					{
						$found = ( ( ($search_in != 1) && in_array($words[$i], $words_key) ) || ( ($search_in != 0) && in_array($words[$i], $words_val) ) );
						if ( ($search_logic == 1) && $found )
						{
							$ok = true;
							break;
						}
						if ( ($search_logic == 0) && !$found )
						{
							$ok = false;
							break;
						}
					}
					if ($ok)
					{
						$results[] = array('main' => $key_main, 'sub' => $key_sub);
					}
				}
			}
		}

		// template
		$template->set_filenames(array(
			'body' => 'admin/lang_extend_search_body.tpl')
		);

		// header
		$template->assign_vars(array(
			'L_TITLE'			=> $lang['Lang_extend'],
			'L_TITLE_EXPLAIN'	=> $lang['Lang_extend_explain'],
			'L_SEARCH_RESULTS'	=> $lang['Lang_extend_search_results'],
			'L_PACK'			=> $lang['Lang_extend_pack'],
			'L_KEY'				=> $lang['Lang_extend_entries'],
			'L_VALUE'			=> $lang['Lang_extend_value'],
			'L_LEVEL'			=> $lang['Lang_extend_level_leg'],
			'L_NONE'			=> $lang['None'],
			'L_CANCEL'			=> $lang['Cancel'],
			)
		);

		$color = false;
		for ($i = 0; $i < count($results); $i++)
		{
			// get data
			$key_main	= $results[$i]['main'];
			$key_sub	= $results[$i]['sub'];
			$pack_file	= $entries['pack'][$key_main][$key_sub];
			$pack_name	= $packs[$pack_file];
			$admin		= $entries['admin'][$key_main][$key_sub];

			// value
			$value = trim( ( empty($key_sub) ? $lang[$key_main] : $lang[$key_main][$key_sub] ) );
			if ( strlen($value) > $value_maxlength )
			{
				$value = substr($value, 0, $value_maxlength-3) . '...';
			}
			$value = htmlspecialchars($value);

			// status
			$modified_added = false;
			if ($pack_file != 'custom')
			{
				$found = false;
				@reset($entries['status'][$key_main][$key_sub]);
				while ( list($country_dir, $status) = @each($entries['status'][$key_main][$key_sub]) )
				{
					$found = ($status > 0);
					if ( $found )
					{
						$modified_added = true;
						break;
					}
				}
			}

			$color = !$color;
			$template->assign_block_vars('row', array(
				'CLASS'		=> $color ? 'row1' : 'row2',
				'PACK'		=> lang_extend_get_lang('Lang_extend_' . $pack_name),
				'KEY_MAIN'	=> "['" . $key_main . "']",
				'KEY_SUB'	=> empty($key_sub) ? '' : "['" . $key_sub . "']",
				'VALUE'		=> $value,
				'LEVEL'		=> $admin ? $lang['Lang_extend_level_admin'] : $lang['Lang_extend_level_normal'],
				'STATUS'	=> $modified_added ? $lang['Lang_extend_added_modified'] : '',

				'U_PACK'	=> append_sid("./admin_lang_extend.$phpEx?mode=pack&pack=" . urlencode($pack_file) . "&level=" . urlencode($admin ? 'admin' : 'normal')),
				'U_KEY'		=> append_sid("./admin_lang_extend.$phpEx?mode=key&pack=" . urlencode($pack_file) . "&level=" . urlencode($admin ? 'admin' : 'normal') . "&key=" . urlencode($key_main). "&sub=" . urlencode($key_sub)),
				)
			);
		}

		if ( count($results) == 0 )
		{
			$template->assign_block_vars('none', array() );
		}

		// footer
		$s_hidden_fields = '';
		$s_hidden_fields .= '<input type="hidden" name="mode" value="' . $mode . '" />';
		$s_hidden_fields .= '<input type="hidden" name="search_words" value="' . urlencode(str_replace("'", "\'", $search_words)) . '" />';
		$s_hidden_fields .= '<input type="hidden" name="search_logic" value="' . $search_logic . '" />';
		$s_hidden_fields .= '<input type="hidden" name="search_in" value="' . $search_in . '" />';
		$s_hidden_fields .= '<input type="hidden" name="search_language" value="' . urlencode($search_language) . '" />';
		$s_hidden_fields .= '<input type="hidden" name="search_admin" value="' . $search_admin . '" />';

		$template->assign_vars(array(
			'S_ACTION'			=> append_sid("./admin_lang_extend.$phpEx"),
			'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
			)
		);
	}
}

// default entry
if ( $mode == '' )
{
	// search
	$search_words = isset($_POST['search_words']) ? str_replace("\'", "'", urldecode($_POST['search_words'])) : '';
	$search_logic = isset($_POST['search_logic']) ? intval($_POST['search_logic']) : 0;
	$search_in = isset($_POST['search_in']) ? intval($_POST['search_in']) : 2;
	$search_country = isset($_POST['search_language']) ? str_replace("\'", "'", urldecode($_POST['search_language'])) : 'lang_' . $board_config['default_language'];
	$search_admin = isset($_POST['search_admin']) ? intval($_POST['search_admin']) : 2;

	// template
	$template->set_filenames(array(
		'body' => 'admin/lang_extend_body.tpl')
	);

	// header
	$template->assign_vars(array(
		'L_TITLE'					=> $lang['Lang_extend'],
		'L_TITLE_EXPLAIN'			=> $lang['Lang_extend_explain'],
		'L_PACK'					=> $lang['Lang_extend_pack'],
		'L_ADMIN'					=> $lang['Lang_extend_level_admin'],
		'L_NORMAL'					=> $lang['Lang_extend_level_normal'],

		'L_NONE'					=> $lang['None'],
		'L_SUBMIT'					=> $lang['Submit'],
		)
	);

	// display packs
	$i = 0;
	$color = false;
	@reset($packs);
	while ( list($pack_file, $pack_name) = @each($packs) )
	{
		$i++;
		$color = !$color;
		$template->assign_block_vars('row', array(
			'COLOR'			=> $color ? 'row1' : 'row2',
			'PACK'			=> lang_extend_get_lang('Lang_extend_' . $pack_name),
			'U_PACK_ADMIN'	=> append_sid("./admin_lang_extend.$phpEx?mode=pack&pack=" . urlencode($pack_file) . "&level=admin"),
			'U_PACK_NORMAL'	=> append_sid("./admin_lang_extend.$phpEx?mode=pack&pack=" . urlencode($pack_file) . "&level=normal"),
			)
		);
	}
	if ( $i == 0 )
	{
		$template->assign_block_vars('none', array());
	}

	// search form
	$template->assign_vars(array(
		'L_SEARCH'					=> $lang['Lang_extend_search'],
		'L_SEARCH_WORDS'			=> $lang['Lang_extend_search_words'],
		'L_SEARCH_WORDS_EXPLAIN'	=> $lang['Lang_extend_search_words_explain'],
		'L_SEARCH_ALL'				=> $lang['Lang_extend_search_all'],
		'L_SEARCH_ONE'				=> $lang['Lang_extend_search_one'],
		'L_SEARCH_IN'				=> $lang['Lang_extend_search_in'],
		'L_SEARCH_IN_EXPLAIN'		=> $lang['Lang_extend_search_in_explain'],
		'L_SEARCH_IN_KEY'			=> $lang['Lang_extend_search_in_key'],
		'L_SEARCH_IN_VALUE'			=> $lang['Lang_extend_search_in_value'],
		'L_SEARCH_IN_BOTH'			=> $lang['Lang_extend_search_in_both'],
		'L_SEARCH_LEVEL_ADMIN'		=> $lang['Lang_extend_level_admin'],
		'L_SEARCH_LEVEL_NORMAL'		=> $lang['Lang_extend_level_normal'],
		'L_SEARCH_LEVEL_BOTH'		=> $lang['Lang_extend_search_in_both'],
		)
	);

	// list of lang installed
	$selected = empty($search_country) ? ' selected="selected"' : '';
	$s_languages = '<option value=""' . $selected . '>' . $lang['Lang_extend_search_all_lang'] . '</option>';
	@reset($countries);
	while ( list( $country_dir, $country_name ) = @each($countries) )
	{
		$selected = ( $country_dir == $search_country ) ? ' selected="selected"' : '';
		$s_languages .= '<option value="' . $country_dir . '"' . $selected . '>' . $country_name . '</option>';
	}
	$s_languages = sprintf('<select name="search_language">%s</select>', $s_languages);

	$template->assign_vars(array(
		'SEARCH_WORDS'			=> $search_words,
		'SEARCH_ALL'			=> ($search_logic == 0) ? 'checked="checked"' : '',
		'SEARCH_ONE'			=> ($search_logic == 1) ? 'checked="checked"' : '',
		'SEARCH_IN_KEY'			=> ($search_in == 0) ? 'checked="checked"' : '',
		'SEARCH_IN_VALUE'		=> ($search_in == 1) ? 'checked="checked"' : '',
		'SEARCH_IN_BOTH'		=> ($search_in == 2) ? 'checked="checked"' : '',
		'SEARCH_LEVEL_ADMIN'	=> ($search_in == 0) ? 'checked="checked"' : '',
		'SEARCH_LEVEL_NORMAL'	=> ($search_in == 1) ? 'checked="checked"' : '',
		'SEARCH_LEVEL_BOTH'		=> ($search_in == 2) ? 'checked="checked"' : '',
		'S_LANGUAGES'			=> $s_languages,
		)
	);

	// footer
	$s_hidden_fields = '';
	$template->assign_vars(array(
		'S_ACTION'			=> append_sid("./admin_lang_extend.$phpEx"),
		'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
		)
	);
}

// dump
$template->pparse('body');
include('./page_footer_admin.'.$phpEx);

?>
