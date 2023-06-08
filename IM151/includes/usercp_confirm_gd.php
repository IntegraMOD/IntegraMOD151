<?php
/***************************************************************************
 *                            usercp_confirm.php
 *                            -------------------
 *   begin                : Feb 23, 2006
 *   copyright            : (C) 2006 AmigaLink
 *   website              : www.AmigaLink.de
 *
 *   $Id: usercp_confirm.php,v 2.0.18.5 2006/11/03 23:48:00 AmigaLink Exp $
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
	exit;
}

// Do we have an id? No, then just exit
if (empty($_GET['id']))
{
	exit;
}

$confirm_id = htmlspecialchars($_GET['id']);

#if (!preg_match('/^[A-Za-z0-9]+$/', $confirm_id))
if (!preg_match('/^[[:alnum:]]+$/', $confirm_id))
{
	$confirm_id = '';
}

if ($confirm_id === 'Admin')
{
	if ( !$userdata['session_logged_in'] )
	{
		die('Hacking attempt');
		exit;
	}
	$code = '';
	$font_debug = true;
	$bg_img_debug = true;
}
else
{
	// Try and grab code for this id and session
	$sql = 'SELECT code  
		FROM ' . CONFIRM_TABLE . " 
		WHERE session_id = '" . $userdata['session_id'] . "' 
			AND confirm_id = '$confirm_id'";
	$result = $db->sql_query($sql);

	// If we have a row then grab data else create a new id
	if ($row = $db->sql_fetchrow($result))
	{
		$db->sql_freeresult($result);
		$code = $row['code'];
	}
	else
	{
		exit;
	}
}

srand((double)microtime()*1000000);
mt_srand((double)microtime()*1000000);
#include($phpbb_root_path.'includes/functions_captcha.'.$phpEx);

// Define allowed bg-image types
$bg_image_activetype_allow = array();
(imagetypes() & IMG_PNG) ? $bg_image_activetype_allow[] = 'png' : ''; 
(imagetypes() & IMG_JPEG) ? $bg_image_activetype_allow[] = 'jpg' : ''; 

// For better compatibility with some servers which need absolut path
$phpbb_root_path = str_replace('index.'.$phpEx, '', realpath($phpbb_root_path.'index.'.$phpEx));

// Read the config table
$sql = "SELECT *
	FROM " . CAPTCHA_CONFIG_TABLE;
if( !($result = $db->sql_query($sql)) )
{
	message_die(CRITICAL_ERROR, "Could not query captcha config information", "", __LINE__, __FILE__, $sql);
}
while ( $row = $db->sql_fetchrow($result) )
{
	$captcha_config[$row['config_name']] = $row['config_value'];
}
$db->sql_freeresult($result);

// Prefs
$code = ($confirm_id === 'Admin') ? $captcha_config['exsample_code'] : $code;

$total_width = ($captcha_config['width'] < (strlen($code)*15)+10) ? (strlen($code)*15)+10 : $captcha_config['width'];
$total_height = ($captcha_config['height'] < 30 ) ? 30 : $captcha_config['height'];

$hex_bg_color = hex_to_rgb($captcha_config['background_color']);
$bg_color = array();
$bg_color = explode(",", $hex_bg_color);
$bg_image_active = $captcha_config['image'];
$bg_transition = $captcha_config['bg_transition'];
$trans_letters = $captcha_config['trans_letters'];

$jpeg = $captcha_config['jpeg'];
$img_quality = $captcha_config['jpeg_quality']; // Max quality is 95

$pre_letters = $captcha_config['pre_letters'];
$pre_letter_great = $captcha_config['pre_letters_great'];
$rnd_font = $captcha_config['font'];

$chess = $captcha_config['chess'];
$ellipses = $captcha_config['ellipses'];
$arcs = $captcha_config['arcs'];
$lines = $captcha_config['lines'];

$gammacorrect = $captcha_config['gammacorrect'];

$foreground_lattice_y = $captcha_config['foreground_lattice_y'];
$foreground_lattice_x = $captcha_config['foreground_lattice_x'];
$hex_lattice_color = hex_to_rgb($captcha_config['lattice_color']);
$rgb_lattice_color = array();
$rgb_lattice_color = explode(",", $hex_lattice_color);

$bg_image_file = '';

// Images init
if ($bg_image_active)
{
	$bg_imgs = array();
	if ($img_dir = opendir($phpbb_root_path.'captcha/pics/'))
	{
		while (true == ($file = @readdir($img_dir))) 
		{ 
			if (array_search(substr(strtolower($file), -3), $bg_image_activetype_allow) !== false)
			{         
				$bg_imgs[] = $file; 
			}
		}
		closedir($img_dir);
	}
	// Grab a random Background Image or set Error if none was found
	$bg_img = rand(0, (count($bg_imgs)-1));
	$bg_err = ($bg_imgs[$bg_img] != '') ? false : true;

	if (!$bg_err)
	{
		// Get image size and check type
		$bg_img_data = array();
		$bg_img_data = @getimagesize($phpbb_root_path.'captcha/pics/'.$bg_imgs[$bg_img]);
		switch($bg_img_data[2])
		{
			case '1': # GIF
				$bg_img_type = 'gif';
				break;
			case '2':	# JPG
				$bg_img_type = 'jpg';
				break;
			case '3':	# PNG
				$bg_img_type = 'png';
				break;
			case '4':	# SWF
				$bg_img_type = 'swf';
				break;
			case '5':	# PSD
				$bg_img_type = 'psd';
				break;
			case '6':	# BMP
				$bg_img_type = 'bmp';
				break;
			case '7':	# TIFF (intel byte order)
				$bg_img_type = 'tiff';
				break;
			case '8':	# TIFF (motorola byte order)
				$bg_img_type = 'tiff';
				break;
			case '9':	# JPC
				$bg_img_type = 'jpc';
				break;
			case '10':	# JP2
				$bg_img_type = 'jp2';
				break;
			case '11':	# JPX
				$bg_img_type = 'jpx';
				break;
			case '12':	# JB2
				$bg_img_type = 'jb2';
				break;
			case '13':	# SWC
				$bg_img_type = 'swc';
				break;
			case '14':	# IFF
				$bg_img_type = 'iff';
				break;
			case '15':	# WBMP
				$bg_img_type = 'wbmp';
				break;
			case '16':	# XBM
				$bg_img_type = 'xbm';
				break;
			default:
				$bg_img_type = 'unknown';
		}
		(array_search($bg_img_type, $bg_image_activetype_allow) !== false) ? '' : $bg_err = 2;
	}
	$bg_image_file = (!$bg_err) ? $phpbb_root_path.'captcha/pics/'.$bg_imgs[$bg_img] : '';
}

// Fonts init
$fonts = array();
if ($fonts_dir = opendir($phpbb_root_path.'captcha/fonts/'))
{
	while (true == ($file = @readdir($fonts_dir))) 
	{ 
		if ((substr(strtolower($file), -3) == 'ttf'))
		{         
			$fonts[] = $file; 
		}     
	}
	closedir($fonts_dir);
}
$font = rand(0, (count($fonts)-1));

// Generate image
$image = (gdVersion() >= 2) ? imagecreatetruecolor($total_width, $total_height) : imagecreate($total_width, $total_height);
$background_color = imagecolorallocate($image, $bg_color[0], $bg_color[1], $bg_color[2]);
imageinterlace($image, 1);
imagecolortransparent($image, $background_color);
imagefill($image, 0, 0, $background_color);

// Backgrund
if ($chess == '1' || $chess == '2' && rand(0,1))
{
	// Draw rectangles
	$rec_size = round(rand(25, 50));
	$x_rec = ceil($total_width / $rec_size);
	$y_rec = ceil($total_height / $rec_size);
	$rest_x = rand(0, round($total_width - (($x_rec - 1) * $rec_size)));
	$rest_y = rand(0, round($total_height - (($y_rec - 1) * $rec_size)));

	for ($y = 0; $y <= $y_rec; $y++)
	{
		$y1 = ($y == 0) ? 0 : ($y * $rec_size) + $rest_y; 
		($y != 0) ? $y1 = $y1 - $rec_size : '';
		$y2 = ($y == 0) ? $rest_y : $y1 + $rec_size + $rest_y; 

		for ($x = 0; $x <= $x_rec; $x++)
		{
			$x1 = ($x == 0) ? 0 : ($x * $rec_size) + $rest_x;
			($x != 0) ? $x1 = $x1 - $rec_size : '';
			$x2 = ($x == 0) ? $rest_x : $x1 + $rec_size + $rest_x;

			$rectanglecolor = imagecolorallocate($image, rand(100,200),rand(100,200),rand(100,200));
			imagefilledrectangle($image, $x1, $y1, $x2, $y2, $rectanglecolor);
		}
	}
}
if ($ellipses == '1' || $ellipses == '2' && rand(0,1))
{
	// Draw random ellipses
	for ($i = 1; $i <= 60; $i++)
	{
		$ellipsecolor = imagecolorallocate($image, rand(100,250),rand(100,250),rand(100,250));
		imagefilledellipse($image, round(rand(0, $total_width)), round(rand(0, $total_height)), round(rand(0, $total_width/8)), round(rand(0, $total_height/4)), $ellipsecolor);	
	}
}
if ($arcs == '1' || $arcs == '2' && rand(0,1))
{
	// Draw random partial ellipses
	for ($i = 0; $i <= 30; $i++)
	{
		$linecolor = imagecolorallocate($image, rand(120,255),rand(120,255),rand(120,255));
		$cx = round(rand(1, $total_width));
		$cy = round(rand(1, $total_height));
		$int_w = round(rand(1, $total_width/2));
		$int_h = round(rand(1, $total_height));
		imagearc($image, $cx, $cy, $int_w, $int_h, round(rand(0, 190)), round(rand(191, 360)), $linecolor);
		imagearc($image, $cx-1, $cy-1, $int_w, $int_h, round(rand(0, 190)), round(rand(191, 360)), $linecolor);
	}
}
if ($lines == '1' || $lines == '2' && rand(0,1))
{
	// Draw random lines
	for ($i = 0; $i <= 50; $i++)
	{
		$linecolor = imagecolorallocate($image, rand(120,255),rand(120,255),rand(120,255));
		imageline($image, round(rand(1, $total_width*3)), round(rand(1, $total_height*5)), round(rand(1, $total_width/2)), round(rand(1, $total_height*2)), $linecolor);
	}
}
//

// Merge with background image?
if ($bg_image_active && !$bg_err && !$trans_letters)
{
	@mergeimages($image, $total_height, $total_width, $bg_image_file, $bg_img_data[0], $bg_img_data[1], $bg_img_type, $bg_transition);
}


// Letters
$text_color_array = array('255,51,0', '51,77,255', '204,51,102', '0,153,0', '255,166,2', '255,0,255', '255,0,0', '0,255,0', '0,0,255', '0,255,255');
shuffle($text_color_array);
$pre_text_color_array = array('255,71,20', '71,20,224', '224,71,122', '20,173,20', '255,186,22', '25,25,25');
shuffle($pre_text_color_array);
$white = imagecolorallocate($image, 255, 255, 255);
$gray = imagecolorallocate($image, 100, 100, 100);
$black = imagecolorallocate($image, 0, 0, 0);
$lattice_color = imagecolorallocate($image, $rgb_lattice_color[0], $rgb_lattice_color[1], $rgb_lattice_color[2]);

$code_area_width = floor($total_width - rand((strlen($code) * 2), (strlen($code) * 4))) - 10;
$code_walk = rand(0, ($total_width - ($code_area_width + 10)));
$min_char_size = (floor($total_height / 4.5) < 12) ? 12 : floor($total_height / 4.5);
$max_char_size = (ceil($total_height / 2.5) > ($code_area_width / (strlen($code) + 2))) ? ($code_area_width / (strlen($code) + 2)) : ceil($total_height / 2.5);
$tc_light = mt_rand(180, 220);
$tc_dark = mt_rand(55, 85);

for ($i = 0; $i < strlen($code); $i++)
{
	mt_srand((double)microtime()*1000000);

	$char = $code{$i};
	$size = mt_rand($min_char_size, $max_char_size);
	$font = ($rnd_font) ? mt_rand(0, (count($fonts)-1)) : $font;
	$angle = mt_rand(-35, 30);

	$x_char_position = rand( round((($code_area_width - (strlen($code) * 2)) / strlen($code))), round((($code_area_width - (strlen($code) * 4)) / strlen($code))) );

	$char_pos = array();
	$char_pos = imagettfbbox($size, $angle, $phpbb_root_path.'captcha/fonts/'.$fonts[$font], $char);
	$letter_width = abs($char_pos[0]) + abs($char_pos[4]);
	$letter_height = abs($char_pos[1]) + abs($char_pos[5]);

	$x_pos = floor(($x_char_position - ($letter_width / 2)) + ($i * $x_char_position)) + $code_walk;
	($i == strlen($code)-1 && $x_pos >= ($total_width - ($letter_width + 5))) ? $x_pos = ($total_width - ($letter_width + 5)) : '';
	$y_pos = mt_rand(($size * 1.4 ), $total_height - ($size * 0.5));

//	Pre letters
	$size = ($pre_letter_great) ? $size + (2 * $pre_letters) : $size - (2 * $pre_letters);
	for ($count = 1; $count <= $pre_letters; $count++)
	{
		$pre_angle = $angle + mt_rand(-20, 20);

		$text_color = $pre_text_color_array[mt_rand(0, count($pre_text_color_array)-1)];
		$text_color = explode(",", $text_color);
		$textcolor = imagecolorallocate($image, $text_color[0], $text_color[1], $text_color[2]);
		$textcolor_light = imagecolorallocate($image, $tc_light, $tc_light, $tc_light);
		$textcolor_dark = imagecolorallocate($image, $tc_dark, $tc_dark, $tc_dark);

		imagettftext($image, $size, $pre_angle, $x_pos, $y_pos-2, $textcolor_light, $phpbb_root_path.'captcha/fonts/'.$fonts[$font], $char);
		imagettftext($image, $size, $pre_angle, $x_pos+2, $y_pos, $textcolor_dark, $phpbb_root_path.'captcha/fonts/'.$fonts[$font], $char);
		imagettftext($image, $size, $pre_angle, $x_pos+1, $y_pos-1, $textcolor, $phpbb_root_path.'captcha/fonts/'.$fonts[$font], $char);

		$size = ($pre_letter_great) ? $size - 2 : $size + 2;
	}

//	Final letters
	$text_color = $text_color_array[mt_rand(0, count($text_color_array)-1)];
	$text_color = explode(",", $text_color);
	$textcolor = imagecolorallocate($image, $text_color[0], $text_color[1], $text_color[2]);
	$textcolor_light = imagecolorallocate($image, $tc_light, $tc_light, $tc_light);
	$textcolor_dark = imagecolorallocate($image, $tc_dark, $tc_dark, $tc_dark);

	imagettftext($image, $size, $angle, $x_pos, $y_pos-2, $textcolor_light, $phpbb_root_path.'captcha/fonts/'.$fonts[$font], $char);
	imagettftext($image, $size, $angle, $x_pos+2, $y_pos, $textcolor_dark, $phpbb_root_path.'captcha/fonts/'.$fonts[$font], $char);
	imagettftext($image, $size, $angle, $x_pos+1, $y_pos-1, $textcolor, $phpbb_root_path.'captcha/fonts/'.$fonts[$font], $char);
}


// Merge with background image?
if ($bg_image_active && !$bg_err && $trans_letters)
{
	@mergeimages($image, $total_height, $total_width, $bg_image_file, $bg_img_data[0], $bg_img_data[1], $bg_img_type, $bg_transition);
}

($gammacorrect) ? imagegammacorrect($image, 1.0, $gammacorrect) : '';

// Generate a lattice in foreground
if ($foreground_lattice_y)
{
	// x lines
	$ih = round($total_height / $foreground_lattice_y);
	for ($i = 0; $i <= $ih; $i++)
	{
		imageline($image, 0, $i*$foreground_lattice_y, $total_width, $i*$foreground_lattice_y, $lattice_color);
	}
}
if ($foreground_lattice_x)
{
	// y lines
	$iw = round($total_width / $foreground_lattice_x);
	for ($i = 0; $i <= $iw; $i++)
	{
		imageline($image, $i*$foreground_lattice_x, 0, $i*$foreground_lattice_x, $total_height, $lattice_color);
	}
}

// Font debug
if ($font_debug && !$rnd_font)
{
	imagestring($image, 4, 2, 0, ($font + 1).'/'.count($fonts).': '.$fonts[$font], $white);
	imagestring($image, 4, 5, 0, ($font + 1).'/'.count($fonts).': '.$fonts[$font], $white);
	imagestring($image, 4, 3, 3, ($font + 1).'/'.count($fonts).': '.$fonts[$font], $white);
	imagestring($image, 4, 4, 2, ($font + 1).'/'.count($fonts).': '.$fonts[$font], $gray);
	imagestring($image, 4, 3, 1, ($font + 1).'/'.count($fonts).': '.$fonts[$font], $black);
}
// Bg-image debug
if ($bg_img_debug && $bg_image_active)
{
	$lang['AVC_bg-error'][0] = ($bg_img + 1).'/'.count($bg_imgs).': '.$bg_imgs[$bg_img];
	$lang['AVC_bg-error'][1] = 'No picture available';
	$lang['AVC_bg-error'][2] = 'Wrong datatype';
	$lang['AVC_bg-error'][3] = $bg_imgs[$bg_img].' corrupt';

	$bg_img_type = ($bg_img_type && $bg_err) ? ' ('.$bg_img_type.')' : '';
	imagestring($image, 4, 2, $total_height-15, $lang['AVC_bg-error'][$bg_err].$bg_img_type, $white);
	imagestring($image, 4, 5, $total_height-15, $lang['AVC_bg-error'][$bg_err].$bg_img_type, $white);
	imagestring($image, 4, 3, $total_height-18, $lang['AVC_bg-error'][$bg_err].$bg_img_type, $white);
	imagestring($image, 4, 4, $total_height-17, $lang['AVC_bg-error'][$bg_err].$bg_img_type, $gray);
	imagestring($image, 4, 3, $total_height-16, $lang['AVC_bg-error'][$bg_err].$bg_img_type, $black);
}

// Display
header("Last-Modified: " . gmdate("D, d M Y H:i:s") ." GMT"); 
header("Pragma: no-cache"); 
header("Cache-Control: no-store, no-cache, max-age=0, must-revalidate");
(!$jpeg) ? header("Content-Type: image/png") : header("Content-Type: image/jpeg");

(!$jpeg) ? imagepng($image) : imagejpeg($image, '', $img_quality);
imagedestroy($image);
exit;

///////////////
// Functions //
///////////////
function mergeimages($image, $total_height, $total_width, $bg_image_file, $bg_image_width, $bg_image_height, $bg_img_type, $bg_transition)
{
	switch( $bg_img_type )
	{
		case 'jpg':
			$bg_image = imageCreateFromJPEG($bg_image_file);
			break;
		case 'png':
			$bg_image = imageCreateFromPNG($bg_image_file);
			break;
		default:
			$bg_err = true;
			break;
	}
	if (!$bg_err)
	{
		imageinterlace($bg_image, 1);
		$source_x = ($bg_image_width > $total_width) ? rand(0, $bg_image_width - $total_width) : 0;
		$source_y = ($bg_image_height > $total_height) ? rand(0, $bg_image_height - $total_height) : 0;
		$dest_x1 = ($bg_image_width < $total_width) ? rand(0, $total_width - $bg_image_width) : 0;
		$dest_y1 = ($bg_image_height < $total_height) ? rand(0, $total_height - $bg_image_height) : 0;
		$dest_x2 = ($bg_image_width < $total_width) ? $bg_image_width : $total_width;
		$dest_y2 = ($bg_image_height < $total_height) ? $bg_image_height : $total_height;

		imageCopyMerge($image, $bg_image, $dest_x1, $dest_y1, $source_x, $source_y, $dest_x2, $dest_y2, $bg_transition);
		ImageDestroy($bg_image);
	}
}

function hex_to_rgb($hex)
{
    $hex = str_replace('#', '', strtoupper($hex)); 
	if (strlen($hex) != 6)
	{
		if (strlen($hex) == 3)
		{
			$hex = $hex{0}.$hex{0}.$hex{1}.$hex{1}.$hex{2}.$hex{2};
		} else {
			return '239,239,239';
		}
	}

	$rgb = array();
    $rgb['r'] = hexdec($hex{0}.$hex{1}); 
    $rgb['g'] = hexdec($hex{2}.$hex{3}); 
    $rgb['b'] = hexdec($hex{4}.$hex{5});

    return $rgb['r'].','.$rgb['g'].','.$rgb['b']; 
}

// Function  gdVersion by Hagan Fox
// http://de3.php.net/manual/en/function.gd-info.php#52481
function gdVersion($user_ver = 0)
{
	if (! extension_loaded('gd')) { return; }
	static $gd_ver = 0;
	// Just accept the specified setting if it's 1.
	if ($user_ver == 1) { $gd_ver = 1; return 1; }
	// Use the static variable if function was called previously.
	if ($user_ver !=2 && $gd_ver > 0 ) { return $gd_ver; }
	// Use the gd_info() function if possible.
	if (function_exists('gd_info'))
	{
		$ver_info = gd_info();
		preg_match('/\d/', $ver_info['GD Version'], $match);
		$gd_ver = $match[0];
		return $match[0];
	}
	// If phpinfo() is disabled use a specified / fail-safe choice...
	if (preg_match('/phpinfo/', ini_get('disable_functions')))
	{
		if ($user_ver == 2) {
			$gd_ver = 2;
			return 2;
		} else {
			$gd_ver = 1;
			return 1;
		}
	}
	// ...otherwise use phpinfo().
	ob_start();
	phpinfo(8);
	$info = ob_get_contents();
	ob_end_clean();
	$info = stristr($info, 'gd version');
	preg_match('/\d/', $info, $match);
	$gd_ver = $match[0];
	return $match[0];
} // End gdVersion()
?>
