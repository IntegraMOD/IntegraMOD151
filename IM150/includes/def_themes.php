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
 *	last update		: 2016-03-15 18:12:27 (GMT) by Admin *
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
		'1' => array('themes_id' => '1', 'template_name' => 'Default', 'style_name' => 'Default', 'head_stylesheet' => 'stylesheet.css', 'body_background' => '', 'body_bgcolor' => '', 'body_text' => '', 'body_link' => '', 'body_vlink' => '', 'body_alink' => '', 'body_hlink' => '', 'tr_color1' => '', 'tr_color2' => '', 'tr_color3' => '', 'tr_class1' => '', 'tr_class2' => '', 'tr_class3' => '', 'th_color1' => '', 'th_color2' => '', 'th_color3' => '', 'th_class1' => '', 'th_class2' => '', 'th_class3' => '', 'td_color1' => '', 'td_color2' => '', 'td_color3' => '', 'td_class1' => 'row1', 'td_class2' => 'row2', 'td_class3' => '', 'fontface1' => '', 'fontface2' => '', 'fontface3' => '', 'fontsize1' => '0', 'fontsize2' => '0', 'fontsize3' => '0', 'fontcolor1' => '', 'fontcolor2' => '006600', 'fontcolor3' => 'ff0000', 'span_class1' => '', 'span_class2' => '', 'span_class3' => '', 'img_size_poll' => '0', 'img_size_privmsg' => '0'),
		'2' => array('themes_id' => '2', 'template_name' => 'Integra2', 'style_name' => 'Integra2', 'head_stylesheet' => 'Integra2.css', 'body_background' => '', 'body_bgcolor' => 'E5E5E5', 'body_text' => '000000', 'body_link' => '006699', 'body_vlink' => '5493B4', 'body_alink' => '', 'body_hlink' => 'DD6900', 'tr_color1' => 'EFEFEF', 'tr_color2' => 'DEE3E7', 'tr_color3' => 'D1D7DC', 'tr_class1' => '', 'tr_class2' => '', 'tr_class3' => '', 'th_color1' => '98AAB1', 'th_color2' => '006699', 'th_color3' => 'FFFFFF', 'th_class1' => 'cellpic1.gif', 'th_class2' => 'cellpic3.gif', 'th_class3' => 'cellpic2.jpg', 'td_color1' => 'FAFAFA', 'td_color2' => 'FFFFFF', 'td_color3' => '', 'td_class1' => 'row1', 'td_class2' => 'row2', 'td_class3' => '', 'fontface1' => 'Verdana, Arial, Helvetica, sans-serif', 'fontface2' => 'Trebuchet MS', 'fontface3' => 'Courier, \'Courier New\', sans-serif', 'fontsize1' => '10', 'fontsize2' => '11', 'fontsize3' => '12', 'fontcolor1' => '444444', 'fontcolor2' => '006600', 'fontcolor3' => 'FFA34F', 'span_class1' => '', 'span_class2' => '', 'span_class3' => '', 'img_size_poll' => '0', 'img_size_privmsg' => '0'),
		'3' => array('themes_id' => '3', 'template_name' => 'fisubice', 'style_name' => 'fisubblack', 'head_stylesheet' => 'fisubblack.css', 'body_background' => 'black', 'body_bgcolor' => '', 'body_text' => '', 'body_link' => '', 'body_vlink' => '', 'body_alink' => '', 'body_hlink' => '', 'tr_color1' => '', 'tr_color2' => '', 'tr_color3' => '', 'tr_class1' => '', 'tr_class2' => '', 'tr_class3' => '', 'th_color1' => '', 'th_color2' => '', 'th_color3' => '', 'th_class1' => '', 'th_class2' => '', 'th_class3' => '', 'td_color1' => '', 'td_color2' => '', 'td_color3' => '', 'td_class1' => 'row1', 'td_class2' => 'row2', 'td_class3' => '', 'fontface1' => '', 'fontface2' => '', 'fontface3' => '', 'fontsize1' => '0', 'fontsize2' => '0', 'fontsize3' => '0', 'fontcolor1' => '', 'fontcolor2' => '006600', 'fontcolor3' => 'ff0000', 'span_class1' => '', 'span_class2' => '', 'span_class3' => '', 'img_size_poll' => '0', 'img_size_privmsg' => '0'),
		'4' => array('themes_id' => '4', 'template_name' => 'fisubice', 'style_name' => 'fisubblue', 'head_stylesheet' => 'fisubblue.css', 'body_background' => 'blue', 'body_bgcolor' => '', 'body_text' => '', 'body_link' => '', 'body_vlink' => '', 'body_alink' => '', 'body_hlink' => '', 'tr_color1' => '', 'tr_color2' => '', 'tr_color3' => '', 'tr_class1' => '', 'tr_class2' => '', 'tr_class3' => '', 'th_color1' => '', 'th_color2' => '', 'th_color3' => '', 'th_class1' => '', 'th_class2' => '', 'th_class3' => '', 'td_color1' => '', 'td_color2' => '', 'td_color3' => '', 'td_class1' => 'row1', 'td_class2' => 'row2', 'td_class3' => '', 'fontface1' => '', 'fontface2' => '', 'fontface3' => '', 'fontsize1' => '0', 'fontsize2' => '0', 'fontsize3' => '0', 'fontcolor1' => '', 'fontcolor2' => '006600', 'fontcolor3' => 'ff0000', 'span_class1' => '', 'span_class2' => '', 'span_class3' => '', 'img_size_poll' => '0', 'img_size_privmsg' => '0'),
		'5' => array('themes_id' => '5', 'template_name' => 'fisubice', 'style_name' => 'fisubgreen', 'head_stylesheet' => 'fisubgreen.css', 'body_background' => 'green', 'body_bgcolor' => '', 'body_text' => '', 'body_link' => '', 'body_vlink' => '', 'body_alink' => '', 'body_hlink' => '', 'tr_color1' => '', 'tr_color2' => '', 'tr_color3' => '', 'tr_class1' => '', 'tr_class2' => '', 'tr_class3' => '', 'th_color1' => '', 'th_color2' => '', 'th_color3' => '', 'th_class1' => '', 'th_class2' => '', 'th_class3' => '', 'td_color1' => '', 'td_color2' => '', 'td_color3' => '', 'td_class1' => 'row1', 'td_class2' => 'row2', 'td_class3' => '', 'fontface1' => '', 'fontface2' => '', 'fontface3' => '', 'fontsize1' => '0', 'fontsize2' => '0', 'fontsize3' => '0', 'fontcolor1' => '', 'fontcolor2' => '006600', 'fontcolor3' => 'ff0000', 'span_class1' => '', 'span_class2' => '', 'span_class3' => '', 'img_size_poll' => '0', 'img_size_privmsg' => '0'),
		'6' => array('themes_id' => '6', 'template_name' => 'fisubice', 'style_name' => 'fisubgrey', 'head_stylesheet' => 'fisubgrey.css', 'body_background' => 'grey', 'body_bgcolor' => '', 'body_text' => '', 'body_link' => '', 'body_vlink' => '', 'body_alink' => '', 'body_hlink' => '', 'tr_color1' => '', 'tr_color2' => '', 'tr_color3' => '', 'tr_class1' => '', 'tr_class2' => '', 'tr_class3' => '', 'th_color1' => '', 'th_color2' => '', 'th_color3' => '', 'th_class1' => '', 'th_class2' => '', 'th_class3' => '', 'td_color1' => '', 'td_color2' => '', 'td_color3' => '', 'td_class1' => 'row1', 'td_class2' => 'row2', 'td_class3' => '', 'fontface1' => '', 'fontface2' => '', 'fontface3' => '', 'fontsize1' => '0', 'fontsize2' => '0', 'fontsize3' => '0', 'fontcolor1' => '', 'fontcolor2' => '006600', 'fontcolor3' => 'ff0000', 'span_class1' => '', 'span_class2' => '', 'span_class3' => '', 'img_size_poll' => '0', 'img_size_privmsg' => '0'),
		'7' => array('themes_id' => '7', 'template_name' => 'fisubice', 'style_name' => 'fisubice', 'head_stylesheet' => 'fisubice.css', 'body_background' => '', 'body_bgcolor' => '', 'body_text' => '', 'body_link' => '', 'body_vlink' => '', 'body_alink' => '', 'body_hlink' => '', 'tr_color1' => '', 'tr_color2' => '', 'tr_color3' => '', 'tr_class1' => '', 'tr_class2' => '', 'tr_class3' => '', 'th_color1' => '', 'th_color2' => '', 'th_color3' => '', 'th_class1' => '', 'th_class2' => '', 'th_class3' => '', 'td_color1' => '', 'td_color2' => '', 'td_color3' => '', 'td_class1' => 'row1', 'td_class2' => 'row2', 'td_class3' => '', 'fontface1' => '', 'fontface2' => '', 'fontface3' => '', 'fontsize1' => '0', 'fontsize2' => '0', 'fontsize3' => '0', 'fontcolor1' => '', 'fontcolor2' => '006600', 'fontcolor3' => 'ff0000', 'span_class1' => '', 'span_class2' => '', 'span_class3' => '', 'img_size_poll' => '0', 'img_size_privmsg' => '0'),
		'8' => array('themes_id' => '8', 'template_name' => 'fisubice', 'style_name' => 'fisuborange', 'head_stylesheet' => 'fisuborange.css', 'body_background' => 'orange', 'body_bgcolor' => '', 'body_text' => '', 'body_link' => '', 'body_vlink' => '', 'body_alink' => '', 'body_hlink' => '', 'tr_color1' => '', 'tr_color2' => '', 'tr_color3' => '', 'tr_class1' => '', 'tr_class2' => '', 'tr_class3' => '', 'th_color1' => '', 'th_color2' => '', 'th_color3' => '', 'th_class1' => '', 'th_class2' => '', 'th_class3' => '', 'td_color1' => '', 'td_color2' => '', 'td_color3' => '', 'td_class1' => 'row1', 'td_class2' => 'row2', 'td_class3' => '', 'fontface1' => '', 'fontface2' => '', 'fontface3' => '', 'fontsize1' => '0', 'fontsize2' => '0', 'fontsize3' => '0', 'fontcolor1' => '', 'fontcolor2' => '006600', 'fontcolor3' => 'ff0000', 'span_class1' => '', 'span_class2' => '', 'span_class3' => '', 'img_size_poll' => '0', 'img_size_privmsg' => '0'),
	);
?>