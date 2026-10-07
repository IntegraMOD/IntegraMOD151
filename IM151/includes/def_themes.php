<?php
/***************************************************************************
 *						def_themes.php
 *						--------------
 *	begin			: 12/11/2003
 *	copyright		: Ptirhiik
 *	email			: admin@rpgnet-fr.com
 *
 *	version			: 1.0.1 - 15/12/2003
 *
 *	last update		: 2026-07-29 13:03:05 (GMT) by Helter *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 *
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
	exit;
}

//--------------------------------------------------------------------------------------------------
//
// $themes_style : templates
// --------------
//--------------------------------------------------------------------------------------------------

$themes_style = array(
		'1' => array('themes_id' => '1', 'template_name' => 'fisubice', 'style_name' => 'fisubice', 'head_stylesheet' => 'css/fisubice.css', 'body_background' => '', 'body_bgcolor' => '', 'body_text' => '', 'body_link' => '', 'body_vlink' => '', 'body_alink' => '', 'body_hlink' => '', 'tr_color1' => '', 'tr_color2' => '', 'tr_color3' => '', 'tr_class1' => '', 'tr_class2' => '', 'tr_class3' => '', 'th_color1' => '', 'th_color2' => '', 'th_color3' => '', 'th_class1' => '', 'th_class2' => '', 'th_class3' => '', 'td_color1' => '', 'td_color2' => '', 'td_color3' => '', 'td_class1' => 'row1', 'td_class2' => 'row2', 'td_class3' => '', 'fontface1' => '', 'fontface2' => '', 'fontface3' => '', 'fontsize1' => '0', 'fontsize2' => '0', 'fontsize3' => '0', 'fontcolor1' => '', 'fontcolor2' => '006600', 'fontcolor3' => 'ff0000', 'span_class1' => '', 'span_class2' => '', 'span_class3' => '', 'img_size_poll' => '0', 'img_size_privmsg' => '0'),
		'2' => array('themes_id' => '2', 'template_name' => 'CS', 'style_name' => 'CS', 'head_stylesheet' => 'CS.css', 'body_background' => '', 'body_bgcolor' => '', 'body_text' => '', 'body_link' => '', 'body_vlink' => '', 'body_alink' => '', 'body_hlink' => '', 'tr_color1' => '', 'tr_color2' => '', 'tr_color3' => '', 'tr_class1' => '', 'tr_class2' => '', 'tr_class3' => '', 'th_color1' => '', 'th_color2' => 'cccccc', 'th_color3' => '', 'th_class1' => '', 'th_class2' => '', 'th_class3' => '', 'td_color1' => '', 'td_color2' => '292929', 'td_color3' => '', 'td_class1' => 'row1', 'td_class2' => 'row2', 'td_class3' => '', 'fontface1' => '', 'fontface2' => '', 'fontface3' => '', 'fontsize1' => '0', 'fontsize2' => '0', 'fontsize3' => '0', 'fontcolor1' => '', 'fontcolor2' => '006600', 'fontcolor3' => 'ff0000', 'span_class1' => '000000', 'span_class2' => '', 'span_class3' => '', 'img_size_poll' => '0', 'img_size_privmsg' => '0'),
		'3' => array('themes_id' => '3', 'template_name' => 'HL2', 'style_name' => 'HL2', 'head_stylesheet' => 'HL2.css', 'body_background' => '', 'body_bgcolor' => '', 'body_text' => '', 'body_link' => '', 'body_vlink' => '', 'body_alink' => '', 'body_hlink' => '', 'tr_color1' => '', 'tr_color2' => '', 'tr_color3' => '', 'tr_class1' => '', 'tr_class2' => '', 'tr_class3' => '', 'th_color1' => '', 'th_color2' => '', 'th_color3' => '', 'th_class1' => '', 'th_class2' => '', 'th_class3' => '', 'td_color1' => '', 'td_color2' => '', 'td_color3' => '', 'td_class1' => 'row1', 'td_class2' => 'row2', 'td_class3' => '', 'fontface1' => '', 'fontface2' => '', 'fontface3' => '', 'fontsize1' => '0', 'fontsize2' => '0', 'fontsize3' => '0', 'fontcolor1' => '', 'fontcolor2' => '006600', 'fontcolor3' => 'ff0000', 'span_class1' => '000000', 'span_class2' => '', 'span_class3' => '', 'img_size_poll' => '0', 'img_size_privmsg' => '0'),
		'4' => array('themes_id' => '4', 'template_name' => 'prosilver', 'style_name' => 'prosilver', 'head_stylesheet' => 'theme/stylesheet.css', 'body_background' => '', 'body_bgcolor' => '', 'body_text' => '', 'body_link' => '', 'body_vlink' => '', 'body_alink' => '', 'body_hlink' => '', 'tr_color1' => '', 'tr_color2' => '', 'tr_color3' => 'cadceb', 'tr_class1' => '', 'tr_class2' => '', 'tr_class3' => '', 'th_color1' => '', 'th_color2' => '', 'th_color3' => '', 'th_class1' => '', 'th_class2' => '', 'th_class3' => '', 'td_color1' => '', 'td_color2' => '', 'td_color3' => '', 'td_class1' => 'row1', 'td_class2' => 'row2', 'td_class3' => '', 'fontface1' => '', 'fontface2' => '', 'fontface3' => '', 'fontsize1' => '0', 'fontsize2' => '0', 'fontsize3' => '0', 'fontcolor1' => '', 'fontcolor2' => '006600', 'fontcolor3' => 'ff0000', 'span_class1' => '', 'span_class2' => '', 'span_class3' => '', 'img_size_poll' => '0', 'img_size_privmsg' => '0'),
		'5' => array('themes_id' => '5', 'template_name' => 'Integrastyle', 'style_name' => 'Integrastyle', 'head_stylesheet' => 'css/stylesheet.css', 'body_background' => '', 'body_bgcolor' => '', 'body_text' => '', 'body_link' => '', 'body_vlink' => '', 'body_alink' => '', 'body_hlink' => '', 'tr_color1' => '', 'tr_color2' => '', 'tr_color3' => 'FFF', 'tr_class1' => '', 'tr_class2' => '', 'tr_class3' => '', 'th_color1' => '', 'th_color2' => '', 'th_color3' => '', 'th_class1' => '', 'th_class2' => '', 'th_class3' => '', 'td_color1' => '', 'td_color2' => '', 'td_color3' => '', 'td_class1' => 'row1', 'td_class2' => 'row2', 'td_class3' => '', 'fontface1' => '', 'fontface2' => '', 'fontface3' => '', 'fontsize1' => '0', 'fontsize2' => '0', 'fontsize3' => '0', 'fontcolor1' => '', 'fontcolor2' => '006600', 'fontcolor3' => 'ff0000', 'span_class1' => '', 'span_class2' => '', 'span_class3' => '', 'img_size_poll' => '0', 'img_size_privmsg' => '0'),
		'6' => array('themes_id' => '6', 'template_name' => 'fisub', 'style_name' => 'fisub_ice', 'head_stylesheet' => 'css/fisub_ice.css', 'body_background' => '', 'body_bgcolor' => '', 'body_text' => '', 'body_link' => '', 'body_vlink' => '', 'body_alink' => '', 'body_hlink' => '', 'tr_color1' => '', 'tr_color2' => '', 'tr_color3' => '', 'tr_class1' => '', 'tr_class2' => '', 'tr_class3' => '', 'th_color1' => '', 'th_color2' => '', 'th_color3' => '', 'th_class1' => '', 'th_class2' => '', 'th_class3' => '', 'td_color1' => '', 'td_color2' => '', 'td_color3' => '', 'td_class1' => 'row1', 'td_class2' => 'row2', 'td_class3' => '', 'fontface1' => '', 'fontface2' => '', 'fontface3' => '', 'fontsize1' => '0', 'fontsize2' => '0', 'fontsize3' => '0', 'fontcolor1' => '', 'fontcolor2' => '006600', 'fontcolor3' => 'ff0000', 'span_class1' => '', 'span_class2' => '', 'span_class3' => '', 'img_size_poll' => '0', 'img_size_privmsg' => '0'),
	);
?>