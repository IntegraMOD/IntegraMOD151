/***************************************************************************
 *						def_words_def.php
 *						-----------------
 *	begin			: 12/11/2003
 *	copyright		: Ptirhiik
 *	email			: admin@rpgnet-fr.com
 *
 *	version			: 1.0.0 - 12/11/2003
 *
 *	last update		: {TIME} by {USERNAME}
 *
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
// $word_replacement : words/replacements
// -----------------
//--------------------------------------------------------------------------------------------------

$word_replacement = array();
<!-- BEGIN word -->
$word_replacement['{word.WORD}'] = '{word.REPLACEMENT}';
<!-- END word -->