<?php
/***************************************************************************
 *						lang_extend_split_topic_type.php [French]
 *						--------------------------------
 *	begin				: 28/09/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 1.0.0 - 21/10/2003
 *
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
	die("Hacking attempt");
}

// admin part
if ( $lang_extend_admin )
{
	$lang['Lang_extend_split_topic_type'] = 'Séparation de sujets par type';
}

$lang['Split_settings']			= 'Séparer les sujets par type';
$lang['split_global_announce']	= 'Séparer les annonces globales';
$lang['split_announce']			= 'Séparer les annonces standards';
$lang['split_sticky']			= 'Séparer les sujets permanents';
$lang['split_topic_split']		= 'Séparer dans des boîtes différentes chaque type de sujets';

?>