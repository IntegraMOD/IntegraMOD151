<?php
/***************************************************************************
 *						def_tree_def.php
 *						----------------
 *	begin			: 12/11/2003
 *	copyright		: Ptirhiik
 *	email			: admin@rpgnet-fr.com
 *
 *	version			: 1.0.0 - 12/11/2003
 *
 *	last update		: 2012-05-25 11:40:02 (GMT) by HelterSkelter *
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
// $tree : designed to get all the hierarchy
// ------
//
//	indexes :
//		- id : full designation : ie Root, f3, c20
//		- idx : rank order
//
//	$tree['keys'][id]			=> idx,
//	$tree['type'][idx]			=> type of the row, can be 'c' for categories or 'f' for forums,
//	$tree['id'][idx]			=> value of the row id : cat_id for cats, forum_id for forums,
//	$tree['data'][idx]			=> db table row,
//	$tree['main'][idx]			=> parent id,
//	$tree['sub'][id]			=> array of sub-level ids,
//--------------------------------------------------------------------------------------------------

$tree = array(
			'keys'	=> array('c1' => 0, 'f1' => 1),
			'type'	=> array('c', 'f'),
			'id'	=> array('1', '1'),
			'data'	=> array(
								array(
										'cat_id'	=> '1',
										'cat_title'	=> 'Test category 1',
										'cat_order'	=> '9000010',
										'cat_main_type'	=> 'c',
										'cat_main'	=> '0',
										'cat_desc'	=> '',
										'icon'	=> '',
										'main'	=> 'Root',
									),
								array(
										'forum_id'	=> '1',
										'cat_id'	=> '1',
										'forum_name'	=> 'Test Forum 1',
										'forum_desc'	=> 'This is just a test forum.',
										'forum_status'	=> '0',
										'forum_order'	=> '20',
										'forum_posts'	=> '1',
										'forum_topics'	=> '1',
										'forum_last_post_id'	=> '1',
										'prune_next'	=> '',
										'prune_enable'	=> '0',
										'auth_view'	=> '0',
										'auth_read'	=> '0',
										'auth_post'	=> '0',
										'auth_reply'	=> '0',
										'auth_edit'	=> '1',
										'auth_delete'	=> '1',
										'auth_sticky'	=> '3',
										'auth_announce'	=> '3',
										'auth_global_announce'	=> '0',
										'auth_vote'	=> '1',
										'auth_pollcreate'	=> '1',
										'auth_attachments'	=> '3',
										'auth_download'	=> '0',
										'auth_news'	=> '2',
										'forum_link'	=> '',
										'forum_link_internal'	=> '0',
										'forum_link_hit_count'	=> '0',
										'forum_link_hit'	=> '0',
										'icon'	=> '',
										'main_type'	=> '',
										'auth_cal'	=> '0',
										'auth_ban'	=> '3',
										'auth_greencard'	=> '5',
										'auth_bluecard'	=> '1',
										'auth_delayedpost'	=> '3',
										'main'	=> 'c1',
									),
							),
			'main'	=> array('Root', 'c1'),
			'sub'	=> array(
								'Root'	=> array('c1'),
								'c1'	=> array('f1'),
							),
			'mods'	=> array(
							),
);
?>