<?php
/***************************************************************************
 *							lang_admin_captcha.php (english)
 *                         ------------------------
 *   copyright            : (C) 2006 AmigaLink
 *   website              : www.amigalink.de
 *
 ***************************************************************************/ 

$lang['VC_Captcha_Config'] = 'CAPTCHA Config';
$lang['captcha_config_explain'] = 'Here you can change the appearance of the picture, which represents the registration code on activated visual confirmation.';
$lang['VC_active'] = 'Visual Confirmation is active!';
$lang['VC_inactive'] = 'Visual Confirmation is not active!';
$lang['background_configs'] = 'Background';
$lang['Click_return_captcha_config'] = 'Click %sHere%s to return to CAPTCHA Configuration';

$lang['example_code'] = 'Example code';
$lang['example_code_explain'] = 'Up to 10 characters which are shown here in the ACP as code.<br />(The CAPTCHA uses 4 to 6)';
$lang['CAPTCHA_width'] = 'CAPTCHA width';
$lang['CAPTCHA_height'] = 'CAPTCHA height';
$lang['background_color'] = 'Background color';
$lang['background_color_explain'] = 'Indication in hexadecimal (eg. #0000FF for blue).';
$lang['pre_letters'] = 'Number of shade letters';
$lang['pre_letters_explain'] = 'How many letters will appear behind each letter as shade letters.';
$lang['great_pre_letters'] = 'Shade letter increase';
$lang['great_pre_letters_explain'] = 'Increases the distance between shade letters.';
$lang['Random'] = 'Random';
$lang['random_font_per_letter'] = 'Random font per letter';
$lang['random_font_per_letter_explain'] = 'Each letter uses a random font.';
$lang['trans_letters'] = 'Character transparency';
$lang['trans_letters_explain'] = '(Only takes effect if a background picture is used.)';

$lang['back_image'] = 'Background image';
$lang['back_image_explain'] = 'A picture used as background.<br /> (Supported image formats: %s)';
$lang['bg_transition'] = 'Transparency';
$lang['bg_transition_explain'] = 'Changes the transparency of the background image.<br / > 0% - Completely Transparent<br /> 100% - Completely Opaque';
$lang['back_chess'] = 'Chess sample';
$lang['back_chess_explain'] = 'Fill the complete background with 16 rectangles.';
$lang['back_ellipses'] = 'Ellipses';
$lang['back_arcs'] = 'Curved lines';
$lang['back_lines'] = 'Lines';

$lang['foreground_lattice'] = 'Foreground lattice';
$lang['foreground_lattice_explain'] = '(width x height)<br />Generate a white lattice over the CAPTCHA.';
$lang['foreground_lattice_color'] = 'Lattice color';
$lang['foreground_lattice_color_explain'] = $lang['background_color_explain'];
$lang['gammacorrect'] = 'Contrast correction';
$lang['gammacorrect_explain'] = '(0 = off)<br />NOTE!!! Changing this value has a direct effect on the legibility of the CAPTCHA!';
$lang['generate_jpeg'] = 'Imagetype';
$lang['generate_jpeg_explain'] = 'The JPEG format has a higher compression than png, and has through the quality setting (max 95%), a direct influence on the legibility of the CAPTCHA.';
$lang['generate_jpeg_quality'] = 'Quality';

$lang['no_one'] = 'none.';
?>