<?php
/***************************************************************************
 *                            clown_functions.php
 *                           -------------------
 *   started            : Saturday, January 18, 2004
 *   copyright          : © 2003 Volodymyr (CLowN) Skoryk
 *   email              : blaatimmy72@yahoo.com
 *
 *   some of the code was taken from phpbb forum (generate_smilies function)
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

function ImageRating($rating, $css_style = 'border-style: none')
{
//Pre: returns what type of rating style to display

	global $db, $album_config, $lang;
	
	//decide how user wants to show their rating
	if ($album_config['rate_type'] == 0) //display only images
	{
		if ( !$rating )
		{
			return $lang['Not_rated'];
		}
		else
		{
			$r = "";
			for ($temp = 1; $temp <= $rating; $temp++)
			{
				//$r .= '<img src="album_mod/rank.gif" style="' . $css_style . '" align="absmiddle" />&nbsp;';
				$r .= '<img src="album_mod/rating_star.png" style="' . $css_style . '" align="absmiddle" />&nbsp;';
			}
			return ($r);
		}
	}	
	elseif ($album_config['rate_type'] == 1) //display just text
	{
		if ( !$rating )
		{
			return $lang['Not_rated'];
		}
		else
		{
			return (round($rating, 2));
		}
	}
	else //display both images and text
	{
		if ( !$rating )
		{
			return $lang['Not_rated'];
		}
		else
		{
			$r = "";
			for ($temp = 1; $temp <= $rating; $temp++)
			{
				//$r .= '<img src="album_mod/rank.gif" style="' . $css_style . '" align="absmiddle" />&nbsp;';
				$r .= '<img src="album_mod/rating_star.png" style="' . $css_style . '" align="absmiddle" />&nbsp;';
			}
		}
		return (round($rating, 2) . '&nbsp;' . $r);
	}
}

//to have smilies window popup
function generate_smilies_album($mode, $page_id) //borrowed from phpbbforums...modified to work with album
{
	global $db, $board_config, $template, $lang, $images, $theme, $phpEx, $phpbb_root_path;
	global $user_ip, $session_length, $starttime;
	global $userdata;
	global $agcm_color;
	// Vars needed for CH 2.1.4
	global $config, $user, $censored_words, $icons, $navigation, $themes, $smilies;

	$inline_columns = 4;
	$inline_rows = 5;
	$window_columns = 8;

	if ($mode == 'window')
	{
		$userdata = session_pagestart($user_ip, $page_id);
		init_userprefs($userdata);

		$gen_simple_header = true;

		$page_title = "Smilies";
		include($phpbb_root_path . 'includes/page_header.' . $phpEx);

		$template->set_filenames(array(
			'smiliesbody' => 'album_posting_smilies.tpl')
		);
	}

	$sql = "SELECT emoticon, code, smile_url
		FROM " . SMILIES_TABLE . "
		ORDER BY smilies_id";
	if ($result = $db->sql_query($sql))
	{
		$num_smilies = 0;
		$rowset = array();
		while ($row = $db->sql_fetchrow($result))
		{
			if (empty($rowset[$row['smile_url']]))
			{
				$rowset[$row['smile_url']]['code'] = str_replace("'", "\\'", str_replace('\\', '\\\\', $row['code']));
				$rowset[$row['smile_url']]['emoticon'] = $row['emoticon'];
				$num_smilies++;
			}
		}

		if ($num_smilies)
		{
			$smilies_count = ($mode == 'inline') ? min(19, $num_smilies) : $num_smilies;
			$smilies_split_row = ($mode == 'inline') ? $inline_columns - 1 : $window_columns - 1;

			$s_colspan = 0;
			$row = 0;
			$col = 0;

			while (list($smile_url, $data) = @each($rowset))
			{
				if (!$col)
				{
					$template->assign_block_vars('smilies_row', array());
				}

				$template->assign_block_vars('smilies_row.smilies_col', array(
					'SMILEY_CODE' => $data['code'],
					'SMILEY_IMG' => $board_config['smilies_path'] . '/' . $smile_url,
					'SMILEY_DESC' => $data['emoticon'])
				);

				$s_colspan = max($s_colspan, $col + 1);

				if ($col == $smilies_split_row)
				{
					if ( ($mode == 'inline') && ($row == $inline_rows - 1) )
					{
						break;
					}
					$col = 0;
					$row++;
				}
				else
				{
					$col++;
				}
			}

			if ( ($mode == 'inline') && ($num_smilies > $inline_rows * $inline_columns) )
			{
				$template->assign_block_vars('switch_smilies_extra', array());

				$template->assign_vars(array(
					'L_MORE_SMILIES' => $lang['More_emoticons'],
					'U_MORE_SMILIES' => append_sid("posting.$phpEx?mode=smilies"))
				);
			}

			$template->assign_vars(array(
				'L_EMOTICONS' => $lang['Emoticons'],
				'L_CLOSE_WINDOW' => $lang['Close_window'],
				'S_SMILIES_COLSPAN' => $s_colspan)
			);
		}
	}

	if ($mode == 'window')
	{
		$template->pparse('smiliesbody');

		include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
	}
}

function CanRated ($picID, $userID)
{
//PRE: deside if user can rate things on hot or not
	global $db, $album_config, $userdata;
	
	if (! $userdata['session_logged_in'] && $album_config['hon_rate_users'] == 1)
	{
		$alowed = true;
	}
	elseif ($userdata['session_logged_in'] && $album_config['hon_rate_times'] == 0)
	{
		$sql = "SELECT *
					FROM ". ALBUM_RATE_TABLE ."
					WHERE rate_pic_id = $picID
						AND rate_user_id = $userID
					LIMIT 1";

		if( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not query rating information', '', __LINE__, __FILE__, $sql);
		}

		if ($db->sql_numrows($result) > 0)
		{
			$alowed = false;			
		}
		else
		{
			$alowed =  true;	
		}
	}
	else
	{
		$alowed = true;
	}
	
	return ($alowed);
}

?>