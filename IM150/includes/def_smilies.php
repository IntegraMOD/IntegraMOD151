<?php
/***************************************************************************
 *						def_smilies.php
 *						---------------
 *	begin			: 15/12/2003
 *	copyright		: Ptirhiik
 *	email			: admin@rpgnet-fr.com
 *
 *	version			: 1.0.1 - 16/01/2004
 *
 *	last update		: 2016-03-01 18:51:31 (GMT) by Admin *
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
// $smilies : templates
// ---------
//--------------------------------------------------------------------------------------------------

$smilies = array(
		'1' => array('smilies_id' => '1', 'code' => ':D', 'smile_url' => 'icon_biggrin.gif', 'emoticon' => 'Very Happy'),
		'2' => array('smilies_id' => '2', 'code' => ':-D', 'smile_url' => 'icon_biggrin.gif', 'emoticon' => 'Very Happy'),
		'3' => array('smilies_id' => '3', 'code' => ':grin:', 'smile_url' => 'icon_biggrin.gif', 'emoticon' => 'Very Happy'),
		'4' => array('smilies_id' => '4', 'code' => ':)', 'smile_url' => 'icon_smile.gif', 'emoticon' => 'Smile'),
		'5' => array('smilies_id' => '5', 'code' => ':-)', 'smile_url' => 'icon_smile.gif', 'emoticon' => 'Smile'),
		'6' => array('smilies_id' => '6', 'code' => ':smile:', 'smile_url' => 'icon_smile.gif', 'emoticon' => 'Smile'),
		'7' => array('smilies_id' => '7', 'code' => ':(', 'smile_url' => 'icon_sad.gif', 'emoticon' => 'Sad'),
		'8' => array('smilies_id' => '8', 'code' => ':-(', 'smile_url' => 'icon_sad.gif', 'emoticon' => 'Sad'),
		'9' => array('smilies_id' => '9', 'code' => ':sad:', 'smile_url' => 'icon_sad.gif', 'emoticon' => 'Sad'),
		'10' => array('smilies_id' => '10', 'code' => ':o', 'smile_url' => 'icon_surprised.gif', 'emoticon' => 'Surprised'),
		'11' => array('smilies_id' => '11', 'code' => ':-o', 'smile_url' => 'icon_surprised.gif', 'emoticon' => 'Surprised'),
		'12' => array('smilies_id' => '12', 'code' => ':eek:', 'smile_url' => 'icon_surprised.gif', 'emoticon' => 'Surprised'),
		'13' => array('smilies_id' => '13', 'code' => ':shock:', 'smile_url' => 'icon_eek.gif', 'emoticon' => 'Shocked'),
		'14' => array('smilies_id' => '14', 'code' => ':?', 'smile_url' => 'icon_confused.gif', 'emoticon' => 'Confused'),
		'15' => array('smilies_id' => '15', 'code' => ':-?', 'smile_url' => 'icon_confused.gif', 'emoticon' => 'Confused'),
		'16' => array('smilies_id' => '16', 'code' => ':???:', 'smile_url' => 'icon_confused.gif', 'emoticon' => 'Confused'),
		'17' => array('smilies_id' => '17', 'code' => '8)', 'smile_url' => 'icon_cool.gif', 'emoticon' => 'Cool'),
		'18' => array('smilies_id' => '18', 'code' => '8-)', 'smile_url' => 'icon_cool.gif', 'emoticon' => 'Cool'),
		'19' => array('smilies_id' => '19', 'code' => ':cool:', 'smile_url' => 'icon_cool.gif', 'emoticon' => 'Cool'),
		'20' => array('smilies_id' => '20', 'code' => ':lol:', 'smile_url' => 'icon_lol.gif', 'emoticon' => 'Laughing'),
		'21' => array('smilies_id' => '21', 'code' => ':x', 'smile_url' => 'icon_mad.gif', 'emoticon' => 'Mad'),
		'22' => array('smilies_id' => '22', 'code' => ':-x', 'smile_url' => 'icon_mad.gif', 'emoticon' => 'Mad'),
		'23' => array('smilies_id' => '23', 'code' => ':mad:', 'smile_url' => 'icon_mad.gif', 'emoticon' => 'Mad'),
		'24' => array('smilies_id' => '24', 'code' => ':P', 'smile_url' => 'icon_razz.gif', 'emoticon' => 'Razz'),
		'25' => array('smilies_id' => '25', 'code' => ':-P', 'smile_url' => 'icon_razz.gif', 'emoticon' => 'Razz'),
		'26' => array('smilies_id' => '26', 'code' => ':razz:', 'smile_url' => 'icon_razz.gif', 'emoticon' => 'Razz'),
		'27' => array('smilies_id' => '27', 'code' => ':oops:', 'smile_url' => 'icon_redface.gif', 'emoticon' => 'Embarassed'),
		'28' => array('smilies_id' => '28', 'code' => ':cry:', 'smile_url' => 'icon_cry.gif', 'emoticon' => 'Crying or Very sad'),
		'29' => array('smilies_id' => '29', 'code' => ':evil:', 'smile_url' => 'icon_evil.gif', 'emoticon' => 'Evil or Very Mad'),
		'30' => array('smilies_id' => '30', 'code' => ':twisted:', 'smile_url' => 'icon_twisted.gif', 'emoticon' => 'Twisted Evil'),
		'31' => array('smilies_id' => '31', 'code' => ':roll:', 'smile_url' => 'icon_rolleyes.gif', 'emoticon' => 'Rolling Eyes'),
		'32' => array('smilies_id' => '32', 'code' => ':wink:', 'smile_url' => 'icon_wink.gif', 'emoticon' => 'Wink'),
		'33' => array('smilies_id' => '33', 'code' => ';)', 'smile_url' => 'icon_wink.gif', 'emoticon' => 'Wink'),
		'34' => array('smilies_id' => '34', 'code' => ';-)', 'smile_url' => 'icon_wink.gif', 'emoticon' => 'Wink'),
		'35' => array('smilies_id' => '35', 'code' => ':!:', 'smile_url' => 'icon_exclaim.gif', 'emoticon' => 'Exclamation'),
		'36' => array('smilies_id' => '36', 'code' => ':?:', 'smile_url' => 'icon_question.gif', 'emoticon' => 'Question'),
		'37' => array('smilies_id' => '37', 'code' => ':idea:', 'smile_url' => 'icon_idea.gif', 'emoticon' => 'Idea'),
		'38' => array('smilies_id' => '38', 'code' => ':arrow:', 'smile_url' => 'icon_arrow.gif', 'emoticon' => 'Arrow'),
		'39' => array('smilies_id' => '39', 'code' => ':|', 'smile_url' => 'icon_neutral.gif', 'emoticon' => 'Neutral'),
		'40' => array('smilies_id' => '40', 'code' => ':-|', 'smile_url' => 'icon_neutral.gif', 'emoticon' => 'Neutral'),
		'41' => array('smilies_id' => '41', 'code' => ':neutral:', 'smile_url' => 'icon_neutral.gif', 'emoticon' => 'Neutral'),
		'42' => array('smilies_id' => '42', 'code' => ':mrgreen:', 'smile_url' => 'icon_mrgreen.gif', 'emoticon' => 'Mr. Green'),
	);
?>