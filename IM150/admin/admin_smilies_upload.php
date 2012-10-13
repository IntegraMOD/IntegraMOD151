<?php
/***************************************************************************
 *                           admin_smiles_upload.php
 *                            -------------------
 *   begin                : Tuesday, Aug 19, 2003
 *   version              : 1.1.0
 *   date                 : 2003/08/27 19:23
 ***************************************************************************/

define('IN_PHPBB', 1);

if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['General']['Upload_Smilies'] = $filename;
	return;
}

$phpbb_root_path = './../';
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

include_once($phpbb_root_path . 'includes/lite.'.$phpEx);
$options = array(
    'cacheDir' => $phpbb_root_path . 'var_cache/',
);

$var_cache = new Cache_Lite($options);

$var_cache->clean('smilies');

/* CONFIGURATION VARIABLES */

// Number of columns in image table
$cfg['table_columns'] = 5;

// Maximum filesize allowed (in bytes)
$cfg['max_filesize'] = 6144;

// Maximum width and height allowed of images
$cfg['max_width'] = 30;
$cfg['max_height'] = 30;

/* END CONFIGURATION VARIABLES */

$smilies_path = $phpbb_root_path . $board_config['smilies_path'];
$max_filesize_kb = round($cfg['max_filesize'] / 1024);
include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_smilies_upload.' . $phpEx);

$mode = ( isset($_POST['mode']) ) ? $_POST['mode'] : '';

$error_msg = '';
$new_filename = '';

if ( isset($_POST['submit']) )
{
	if( $mode == 'upload' )
	{
		if( smilies_upload() && !empty($_POST['autoadd']) )
		{
			if( !smilies_auto_add($new_filename) )
			{
				error_msg('SU_Add_Failed');
			}
			else
			{
				error_msg('SU_Add_Successful');
			}
		}
	}
	elseif( $mode == 'delete' )
	{
		if( isset($_POST['delete_smilies']) && is_array($_POST['delete_smilies']) )
		{
			$delete_smilies = $_POST['delete_smilies'];
			foreach($delete_smilies as $val)
			{
				if( file_exists($smilies_path . '/' . $val) )
				{
					if( @unlink($smilies_path . '/' . $val) )
					{
						error_msg(sprintf($lang['SU_Delete_Successful'], $val));
						$sql = 'DELETE FROM ' . SMILIES_TABLE . ' WHERE smile_url = \'' . str_replace("\'", "''", $val) . '\'';
						$result = $db->sql_query($sql);
						$numrows = $db->sql_affectedrows($sql);
						if( !$result || !$numrows )
						{
							error_msg('SU_CD_Fail');
						}
						else
						{
							error_msg('SU_CD_Successful');
						}
					}
					else
					{
						error_msg(sprintf($lang['SU_Delete_Failed'], $val));
					} // unlink
				}
			} //foreach
		} //if POST
	} // mode delete

}

$s_hidden_fields = '<input type="hidden" name="mode" value="upload" />';
$s_hidden_fields1 = '<input type="hidden" name="mode" value="delete" />';

if ( !empty($error_msg) )
{
	$template->set_filenames(array(
		'reg_header' => 'error_body.tpl')
	);
	$template->assign_vars(array(
		'ERROR_MESSAGE' => $error_msg)
	);
	$template->assign_var_from_handle('ERROR_BOX', 'reg_header');
}

$template->set_filenames(array(
	'body' => 'admin/smilies_upload_body.tpl')
);

$ini_val = ( phpversion() >= '4.0.0' ) ? 'ini_get' : 'get_cfg_var';
$form_enctype = ( @$ini_val('file_uploads') == '0' || strtolower(@$ini_val('file_uploads') == 'off') || phpversion() == '4.0.4pl1' || ( phpversion() < '4.0.3' && @$ini_val('open_basedir') != '' ) ) ? '' : 'enctype="multipart/form-data"';

if( !empty($form_enctype) )
{
	$template->assign_block_vars('switch_uploads', array());
}
else
{
	$template->assign_block_vars('switch_no_uploads', array(
		'L_SORRY' => $lang['SU_Sorry']
	));
}

$template->assign_vars(array(
	'SMILIES_SIZE' => $cfg['max_filesize'],
	'SMILIES_PATH' => $smilies_path,
	'COL_NUMBER' => $cfg['table_columns'],

	'L_SUBMIT' => $lang['Submit'],
	'L_RESET' => $lang['Reset'],
	'L_UNMARK_ALL' => $lang['Unmark_all'],
	'L_MARK_ALL' => $lang['Mark_all'],
	'L_DELETE_MARKED' => $lang['Delete_marked'],
	'L_SMILIES_UPLOAD' => $lang['SU_Upload_Smilies'],
	'L_UPLOAD_EXPLAIN' => sprintf($lang['SU_Upload_Explain'], $max_filesize_kb, $cfg['max_width'], $cfg['max_height']),
	'L_UPLOAD_FILE' => $lang['SU_File'],
	'L_UPLOAD_NAME' => $lang['SU_Upload_Name'],
	'L_DEFAULT_NAME' => $lang['SU_Default_Name'],
	'L_NAME_EXPLAIN' => $lang['SU_Name_Explain'],
	'L_UPLOADED_SMILIES' => $lang['SU_Uploaded'],
	'L_AUTO_ADD' => $lang['SU_Auto_Add'],

	'S_HIDDEN_FIELDS' => $s_hidden_fields,
	'S_HIDDEN_DELETE' => $s_hidden_fields1,
	'S_FORM_ENCTYPE' => $form_enctype,
	'S_PROFILE_ACTION' => append_sid('admin_smilies_upload.' . $phpEx))
);

// Show uploaded images for deleting
$smilies_dir = opendir($smilies_path);
$smilies_files = array();
while ( false !== ($smilies = readdir($smilies_dir)) )
{ 
	if( preg_match('/(.*)\.(jpg|jpeg|gif|png)$/i', $smilies) )
	{
		$smilies_files[] = $smilies;
	}
}
$smilies_count = count($smilies_files);
if( $smilies_count )
{
	sort($smilies_files);
	$smilies_rows = ceil($smilies_count/$cfg['table_columns']);
	$jj=0;
	for($ii=0; $ii<$smilies_rows; $ii++)
	{
		$first_smilie = $jj;
		if( $smilies_rows == 1 )
		{
			$last_smilie = $smilies_count;
		}
		else
		{
			$last_smilie = $jj + $cfg['table_columns'];
		}
		$template->assign_block_vars('uploaded_row', array());
		for($jj=$first_smilie; $jj<$last_smilie; $jj++)
		{
			if( $smilies_files[$jj] )
			{
				$template->assign_block_vars('uploaded_row.uploaded_cell', array(
					'SMILIES_NAME' => $smilies_files[$jj]
				));
			}
			else
			{
				$template->assign_block_vars('uploaded_row.empty_cell', array());
			}
		}
	}
}
else
{
	$template->assign_block_vars('none_uploaded', array(
		'L_SORRY_NONE' => $lang['SU_Sorry_None']
	));
}

$template->pparse('body');

include('./page_footer_admin.'.$phpEx);


function smilies_upload()
{
	global $board_config, $db, $lang, $phpbb_root_path, $error_msg, $new_filename, $smilies_path, $cfg, $max_filesize_kb;

	$upload_name = ( !empty($_FILES['imagefile']['name']) ) ? $_FILES['imagefile']['name'] : '';
	$tmp_name = ( $_FILES['imagefile']['tmp_name'] != 'none') ? $_FILES['imagefile']['tmp_name'] : '';
	$filesize = ( !empty($_FILES['imagefile']['size']) ) ? $_FILES['imagefile']['size'] : 0;
	$filetype = ( !empty($_FILES['imagefile']['type']) ) ? $_FILES['imagefile']['type'] : '';
	$image_name = ( !empty($_POST['imagename']) ) ? trim($_POST['imagename']) : '';
	$default_name = ( isset($_POST['defaultname']) ) ? true : false;

	if ( !$upload_name )
	{
		error_msg('SU_Select_file');
		return false;
	}

	$ini_val = ( @phpversion() >= '4.0.0' ) ? 'ini_get' : 'get_cfg_var';

	if ( $filesize <= $cfg['max_filesize'] && $filesize > 0 )
	{
		preg_match('#image\/[x\-]*([a-z]+)#', $filetype, $filetype);
	}
	else
	{
		error_msg(sprintf($lang['SU_filesize'], $max_filesize_kb));
		return false;
	}

	$size = getimagesize($tmp_name);

	if( $size[0] > $cfg['max_width'] || $size[1] > $cfg['max_height'] )
	{
		error_msg(sprintf($lang['SU_Width_height'], $cfg['max_width'], $cfg['max_height']));
		return false;
	}

	if ( !($imgtype = check_image_type($filetype[1])) )
	{
		return false;
	}

	$new_filename = '';
	if( !$default_name )
	{
		if( empty($image_name) )
		{
			error_msg('SU_No_Name');
			return false;
		}
		$new_filename = $image_name;
	}
	else
	{
		preg_match('/(.*)\.(jpg|jpeg|gif|png)$/i', $upload_name, $filename);
		$new_filename = $filename[1];
	}
	$new_filename = str_replace(' ', '_', urldecode($new_filename)) . $imgtype;
	if( empty($new_filename) )
	{
		error_msg('SU_Filename_failed');
		return false;
	}

	if( file_exists($smilies_path . '/' . $new_filename) )
	{
		error_msg('SU_File_Already');
		return false;
	}

	if ( @$ini_val('open_basedir') != '' )
	{
		if ( @phpversion() < '4.0.3' )
		{
			error_msg('SU_open_basedir');
			return false;
		}
		$move_file = 'move_uploaded_file';
	}
	else
	{
		$move_file = 'copy';
	}

	$file_moved = $move_file($tmp_name, $smilies_path . '/' . $new_filename);

	if( $file_moved )
	{
		@chmod($smilies_path . '/' . $new_filename, 0777);

		error_msg('SU_Upload_Succesful');
		return true;
	}

	error_msg('SU_Upload_Failed');
	return false;
}

function check_image_type($type)
{
	global $lang, $error_msg;

	$ext = false;

	switch( $type )
	{
		case 'jpeg':
		case 'pjpeg':
		case 'jpg':
			$ext = '.jpg';
			break;
		case 'gif':
			$ext = '.gif';
			break;
		case 'png':
			$ext = '.png';
			break;
		default:
			error_msg('SU_filetype');
			break;
	}

	return $ext;
}

function smilies_auto_add($new_filename)
{
	global $db, $error_msg, $lang;

	// First, build the code and emotion for the new smiley
	$smilies_name = explode('.', $new_filename);
	$name_count = count($smilies_name);
	$code = '';
	$emotion = '';
	if( $name_count > 2 )
	{
		for($ii=0; $ii<$name_count-1; $ii++)
		{
			$code .= $smilies_name[$ii];
			$emotion .= $smilies_name[$ii] . ' ';
		}
	}
	else
	{
		$code = $smilies_name[0];
		$emotion = $smilies_name[0];
	}
	$code = ':' . $code . ':';
	$emotion = ucfirst(trim($emotion));

	// Replace < & > in the code & emotion for HTML purposes
	// $final[0] will be the final code, $final[1] will be the final emotion
	$final = str_replace(array('<', '>'), array('&lt;', '&gt;'), array($code, $emotion));

	// Check for existing smiley with the same code
	$sql = 'SELECT COUNT(*) as total FROM ' . SMILIES_TABLE . ' WHERE code = \'' . str_replace("\'", "''", $final[0]) . '\'';
	$row = array();

	if( !$result = $db->sql_query($sql) )
	{
		error_msg('SU_CC_Fail');
		return false;
	}
	$row = $db->sql_fetchrow($result);
	if( $row['total'] )
	{
		error_msg('SU_CC_Found');
		return false;
	}

	// Save the data to the smiley table.
	$sql = 'INSERT INTO ' . SMILIES_TABLE . " (code, smile_url, emoticon)
		VALUES ('" . str_replace("\'", "''", $final[0]) . "', '" . str_replace("\'", "''", $new_filename) . "', '" . str_replace("\'", "''", $final[1]) . "')";

	if( !$db->sql_query($sql) )
	{
		return false;
	}

	// If we make it here, then it was added into the database.
	return true;
}

function error_msg($str)
{
	global $lang, $error_msg;

	$error_msg .= ( !empty($error_msg) ) ? '<br />' : '';
	$error_msg .= ( $lang[$str] ) ? $lang[$str] : $str;
}
?>