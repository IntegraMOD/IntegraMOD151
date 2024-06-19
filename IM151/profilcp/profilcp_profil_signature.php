<?php
/***************************************************************************
 *							profilcp_profil_signature.php
 *							-----------------------------
 *	begin				: 08/05/2003
 *	copyright			: Ptirhiik
 *	email				: admin@rpgnet-fr.com
 *
 *	version				: 1.0.3 - 17/10/2003
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
if ( !empty($setmodules) )
{
	if ($board_config['allow_sig'])
	{
		pcp_set_sub_menu('profil', 'signature', 30, __FILE__, 'profilcp_signature_shortcut', 'profilcp_signature_pagetitle' );
	}
	return;
}

// check access
if ( ($userdata['user_id'] != $view_userdata['user_id']) && (!is_admin($userdata) || ($level_prior[get_user_level($userdata)] <= $level_prior[get_user_level($view_userdata)])) ) return;

// Start add - Signatures control MOD
if ( !file_exists(@phpbb_realpath($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_sig_control.' . $phpEx)) ) 
{ 
	include_once($phpbb_root_path . 'language/lang_english/lang_sig_control.' . $phpEx); 
} else 
{ 
	include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_sig_control.' . $phpEx); 
} 
// End add - Signatures control MOD

//
// template file
$template->set_filenames(array(
	'body' => 'profilcp/profil_signature_body.tpl')
);

if ($submit || $preview)
{
	if ($submit)
    {
		$signature = (isset($_POST['message'])) ? str_replace('<br />', "\n", $_POST['message']) : '';
	}
	else
    {
		$signature = str_replace( '<br />', "\n", trim(str_replace("\'", "'", str_replace("\\\"", "\"", $_POST['message']))) );
    }

	$signature_bbcode_uid = $view_userdata['user_sig_bbcode_uid'];
	if ( $signature != '' && $userdata['user_allowsignature'] == 1 )
	{
		// Start replacement - Signatures control MOD
		$signature_no_bbcode = preg_replace("#\[img\].*?\[/img\]|\[\/?(size.*?|b|i|u|color.*?|quote.*?|code|list.*?|url.*?)\]#si", "", $signature);
		if ( strlen($signature_no_bbcode) > $board_config['max_sig_chars'] && $board_config['max_sig_chars'] )
		// End replacement - Signatures control MOD
		{
			$error = true;
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Signature_too_long'];
		}
		// Start add - Signatures control MOD
		$sig_error_list = '';

		// BBCodes control
		$bbcode_error_list = '';
		$bbcode_error_list .= ( !$board_config['sig_allow_font_sizes'] && substr_count(strtolower($signature), '[/size]') > 0 ) ? '[size]' : '';
		$bbcode_error_list .= ( !$board_config['sig_allow_bold'] && substr_count(strtolower($signature), '[/b]') > 0 ) ? '[b]' : '';
		$bbcode_error_list .= ( !$board_config['sig_allow_italic'] && substr_count(strtolower($signature), '[/i]') > 0 ) ? '[i]' : '';
		$bbcode_error_list .= ( !$board_config['sig_allow_underline'] && substr_count(strtolower($signature), '[/u]') > 0 ) ? '[u]' : '';
		$bbcode_error_list .= ( !$board_config['sig_allow_colors'] && substr_count(strtolower($signature), '[/color]') > 0 ) ? '[color]' : '';
		$bbcode_error_list .= ( !$board_config['sig_allow_quote'] && substr_count(strtolower($signature), '[/quote]') > 0 ) ? '[quote]' : '';
		$bbcode_error_list .= ( !$board_config['sig_allow_code'] && substr_count(strtolower($signature), '[/code]') > 0 ) ? '[code]' : '';
		$bbcode_error_list .= ( !$board_config['sig_allow_list'] && substr_count(strtolower($signature), '[/list]') > 0 ) ? '[list]' : '';
		$bbcode_error_list .= ( !$board_config['sig_allow_url'] && substr_count(strtolower($signature), '[/url]') > 0 ) ? '[url]' : '';
		$bbcode_error_list .= ( !$board_config['sig_allow_images'] && substr_count(strtolower($signature), '[/img]') > 0 ) ? '[img]' : '';

		$exotic_bbcodes_list = explode(",", $board_config['sig_exotic_bbcodes_disallowed']);
		while ( list($bbckey, $exotic_bbcode) = @each($exotic_bbcodes_list) )
		{
			$exotic_bbcode = trim(strtolower($exotic_bbcode));
			if ( $exotic_bbcode != '' )
			{
				$bbcode_error_list .= ( substr_count(strtolower($signature), '[/'.$exotic_bbcode.']') > 0 ) ? '['.$exotic_bbcode.']' : '';
			}
		}

		if ( $bbcode_error_list != '' )
		{
			$error = TRUE;
			$sig_error_list .= '<br />' . sprintf($lang['sig_error_bbcode'], '<span style="color: #800000">' . $bbcode_error_list . '</span>');
		}

		// Number of lines control
		if ( $board_config['sig_max_lines'] )
		{
			if ( count(explode("\n", $signature)) > $board_config['sig_max_lines'] ) 
			{ 
				$error = TRUE;
				$sig_error_list .= '<br />' . sprintf($lang['sig_error_max_lines'], count(explode("\n", $signature)), $board_config['sig_max_lines']);
			}
		}

		// Wordwrap control
		if ( $board_config['sig_wordwrap'] )
		{
			$signature_no_bbcode = preg_replace("#\[img\].*?\[/img\]|\[\/?(size.*?|b|i|u|color.*?|quote.*?|code|list.*?|url.*?)\]#si", "", $signature);
			$signature_splited = preg_split("/[\s,]+/", $signature_no_bbcode);

			foreach($signature_splited as $key => $word)
			{
				$length = strlen($word);
				if( $length > $board_config['sig_wordwrap'] )
				{
					$words[$key] = $word;
				}
			}

			if ( count($words) ) 
			{ 
				$error = TRUE;
				$sig_error_list .= '<br />' . sprintf($lang['sig_error_wordwrap'], count($words), $board_config['sig_wordwrap']);
			}
		}

		// Font size limit control (imposed font size is managed in viewtopic.php)
		if ( $board_config['sig_allow_font_sizes'] == 2 )
		{
			if( preg_match_all("#\[size=([0-9]+?)\](.*?)\[/size\]#si", $signature, $sig_sizes_list) )
			{
				if ( $board_config['sig_min_font_size'] && min($sig_sizes_list[1]) < $board_config['sig_min_font_size'] )
				{
					$error = TRUE;
					$sig_error_list .= '<br />' . sprintf($lang['sig_error_font_size_min'], min($sig_sizes_list[1]), $board_config['sig_min_font_size']);
				}
				if ( $board_config['sig_max_font_size'] && max($sig_sizes_list[1]) > $board_config['sig_max_font_size'] )
				{
					$error = TRUE;
					$sig_error_list .= '<br />' . sprintf($lang['sig_error_font_size_max'], max($sig_sizes_list[1]), $board_config['sig_max_font_size']);
				}
			}
		}

		// Images control (except file the size error message)
		$total_image_files_size = 0;

		if( 
		$board_config['sig_allow_images'] && preg_match_all("#\[img\]((http|ftp|https|ftps)://)([^\r\n\t<\"]*?)\[/img\]#sie", $signature, $sig_images_list) ||
		$board_config['sig_allow_images'] && preg_match_all("#\[img=left\]((http|ftp|https|ftps)://)([^\r\n\t<\"]*?)\[/img\]#sie", $signature, $sig_images_list) ||
		$board_config['sig_allow_images'] && preg_match_all("#\[img=right\]((http|ftp|https|ftps)://)([^\r\n\t<\"]*?)\[/img\]#sie", $signature, $sig_images_list) ||
		$board_config['sig_allow_images'] && preg_match_all("#\[img=center\]((http|ftp|https|ftps)://)([^\r\n\t<\"]*?)\[/img\]#sie", $signature, $sig_images_list) ||
		$board_config['sig_allow_images'] && preg_match_all("#\[img=justify\]((http|ftp|https|ftps)://)([^\r\n\t<\"]*?)\[/img\]#sie", $signature, $sig_images_list)
		)
		{
			if( count($sig_images_list[0]) > $board_config['sig_max_images'] && $board_config['sig_max_images'] != 0 )
			{
				$error = TRUE;
				$sig_error_list .= '<br />' . sprintf($lang['sig_error_num_images'], count($sig_images_list[0]), $board_config['sig_max_images']);
			}

			for( $i = 0; $i < count($sig_images_list[0]); $i++ )
			{
				$image_url = $sig_images_list[1][$i].$sig_images_list[3][$i];

				preg_match('/^(http:\/\/)?([\w\-\.]+)\:?([0-9]*)\/(.*)$/', $image_url, $image_url_ary);

				if ( empty($image_url_ary[4]) )
				{
					$error = true;
					$sig_error_list .= '<br />' . $lang['Incomplete_URL'] . ': ' . '<span style="color: #800000">' . $image_url . '"</span>';
				} else
				{
					$image_size_control = false;
					if ( $board_config['sig_max_img_height'] != 0 || $board_config['sig_max_img_width'] != 0 )
					{
						usleep(1500);
						if ( list($image_width, $image_height) = @getimagesize($image_url) )
						{
							$image_size_control = true;
							if( ($board_config['sig_max_img_height'] != 0 && $image_height > $board_config['sig_max_img_height']) ||
								($board_config['sig_max_img_width'] != 0 && $image_width > $board_config['sig_max_img_width']) )
							{
								$error = TRUE;
								$sig_error_list .= '<br />' . sprintf($lang['sig_error_images_size'], '<span style="color: #800000">' . $image_url . '"</span>', $image_height, $image_width, ( $board_config['sig_max_img_height'] ) ? $board_config['sig_max_img_height'] : $lang['sig_unlimited'], ( $board_config['sig_max_img_width'] ) ? $board_config['sig_max_img_width'] : $lang['sig_unlimited']);
							}
						}
					}
	
					$image_data = '';
					$image_file_size_control = 0;
					if( $board_config['sig_max_img_files_size'] != 0 || $board_config['sig_max_img_av_files_size'] != 0 ||
						(($board_config['sig_max_img_height'] != 0 || $board_config['sig_max_img_width'] != 0) && $image_size_control == false) )
					{
						if( $image_fd = @fopen($image_url, "rb") )
						{
							while (!feof($image_fd))
							{
								$image_data .= fread($image_fd, 1024);
							}
							fclose($image_fd);

							$total_image_files_size += strlen($image_data);
							$image_file_size_control = 3;
						} else		
						{
							$base_get = '/' . $image_url_ary[4];
							$port = ( !empty($image_url_ary[3]) ) ? $image_url_ary[3] : 80;

							if ( !($image_fsock = @fsockopen($image_url_ary[2], $port, $errno, $errstr)) )
							{
								$error = true;
								$sig_error_list .= '<br />' . $lang['No_connection_URL'] . ': ' . '<span style="color: #800000">' . $image_url . '"</span>';
							} else
							{
								@fputs($image_fsock, "GET $base_get HTTP/1.1\r\n");
								@fputs($image_fsock, "HOST: " . $image_url_ary[2] . "\r\n");
								@fputs($image_fsock, "Connection: close\r\n\r\n");

								while( !@feof($image_fsock) )
								{
									$image_data .= @fread($image_fsock, 1024);
								}
								@fclose($image_fsock);		

								if ( preg_match('#Content-Length\: ([0-9]+)[^ /][\s]+#i', $image_data, $image_file_data) )
								{
									$total_image_files_size += $image_file_data[1]; 
									$image_file_size_control = 2;
								} else
								{
									$total_image_files_size += strlen($image_data)-307; 
									$image_file_size_control = 1;
								}
							}
						}
					}

					if( ($board_config['sig_max_img_height'] != 0 || $board_config['sig_max_img_width'] != 0) && $image_size_control == false )
					{
						if( $image_file_size_control == 2 )
						{
							$image_data = substr($image_data, strlen($image_data) - $image_file_data[1], $image_file_data[1]);
						}

						if( function_exists('ImageCreateFromString') )
						{
							if( $image_string = ImageCreateFromString($image_data) )
							{
								$image_width = ImageSX($image_string);
								$image_height = ImageSY($image_string);

								if( ($board_config['sig_max_img_height'] != 0 && $image_height > $board_config['sig_max_img_height']) ||
									($board_config['sig_max_img_width'] != 0 && $image_width > $board_config['sig_max_img_width']) )
								{
									$error = TRUE;
									$sig_error_list .= '<br />' . sprintf($lang['sig_error_images_size'], '<span style="color: #800000">' . $image_url . '"</span>', $image_height, $image_width, ( $board_config['sig_max_img_height'] ) ? $board_config['sig_max_img_height'] : $lang['sig_unlimited'], ( $board_config['sig_max_img_width'] ) ? $board_config['sig_max_img_width'] : $lang['sig_unlimited']);
								}

								ImageDestroy($image_string);
							} else
							{
								if( $board_config['sig_allow_on_max_img_size_fail'] == 0 )
								{
									$error = TRUE;
									$sig_error_list .= '<br />' . sprintf($lang['sig_error_images_size_control'], '<span style="color: #800000">' . $image_url . '"</span>');
								}
							}
						}else
						{
							if( $board_config['sig_allow_on_max_img_size_fail'] == 0 )
							{
								$error = TRUE;
								$sig_error_list .= '<br />' . sprintf($lang['sig_error_images_size_control'], '<span style="color: #800000">' . $image_url . '"</span>');
							}
						}
					}
				}
			}
		}
	}

	if ( $signature != '' )
	{
	// End add - Signatures control MOD
		if ( !isset($signature_bbcode_uid) || $signature_bbcode_uid == '' )
		{
			$signature_bbcode_uid = ( $view_userdata['user_allowbbcode'] ) ? make_bbcode_uid() : '';
		}
		$signature = prepare_message($signature, $view_userdata['user_allowhtml'], $view_userdata['user_allowbbcode'], $view_userdata['user_allowsmile'], $signature_bbcode_uid);

		$view_userdata['user_sig'] = $signature;
		$view_userdata['user_sig_bbcode_uid'] = $signature_bbcode_uid; 
	}

	// Start add - Signatures control MOD
	if ( $board_config['sig_max_img_av_files_size'] != 0 && ($board_config['allow_avatar_upload'] || $board_config['allow_avatar_remote'] || $board_config['allow_avatar_local']) )
	{
		if ( !empty($user_avatar_name) && $board_config['allow_avatar_upload'] )
		{
			$avatar_file_size = $user_avatar_size;
		} else
		{
			if ( !empty($user_avatar_upload) && $board_config['allow_avatar_upload'] )
			{
				$avatar_url = $user_avatar_upload;
			} elseif ( !empty($user_avatar_remoteurl) && $board_config['allow_avatar_remote'] )
			{
				$avatar_url = $user_avatar_remoteurl;
			} elseif ( !empty($user_avatar_local) && $board_config['allow_avatar_local'] )
			{
				$avatar_url = $board_config['avatar_gallery_path'] . '/' . $user_avatar_local;
			} elseif ( $user_avatar_type && !isset($_POST['avatardel']) )
			{
				switch( $user_avatar_type )
				{
					case USER_AVATAR_UPLOAD:
						$avatar_url = ( $board_config['allow_avatar_upload'] ) ? $board_config['avatar_path'] . '/' . $user_avatar : '';
						break;
					case USER_AVATAR_REMOTE:
						$avatar_url = ( $board_config['allow_avatar_remote'] ) ? $user_avatar : '';
						break;
					case USER_AVATAR_GALLERY:
						$avatar_url = ( $board_config['allow_avatar_local'] ) ? $board_config['avatar_gallery_path'] . '/' . $user_avatar : '';
						break;
				}
			} else
			{
				$avatar_url = '';	
			}

			if ( $avatar_url != '' )
			{
				preg_match('/^(http:\/\/)?([\w\-\.]+)\:?([0-9]*)\/(.*)$/', $avatar_url, $avatar_url_ary);

				if ( empty($avatar_url_ary[4]) )
				{
					$error = true;
					$sig_error_list .= '<br />' . $lang['Incomplete_URL'] . ': ' . '<span style="color: #800000">' . $avatar_url . '"</span>';
				} else
				{
					$avatar_data = '';

					if( $avatar_fd = @fopen($avatar_url, "rb") )
					{
						while (!feof($avatar_fd))
						{
							$avatar_data .= fread($avatar_fd, 1024);
						}
						fclose($avatar_fd);

						$avatar_file_size = strlen($avatar_data);
					} else
					{
						$base_get = '/' . $avatar_url_ary[4];
						$port = ( !empty($avatar_url_ary[3]) ) ? $avatar_url_ary[3] : 80;

						if ( !($avatar_fsock = @fsockopen($avatar_url_ary[2], $port, $errno, $errstr)) )
						{
							$error = true;
							$sig_error_list .= '<br />' . $lang['No_connection_URL'] . ': ' . '<span style="color: #800000">' . $avatar_url . '"</span>';
						} else
						{
							@fputs($avatar_fsock, "GET $base_get HTTP/1.1\r\n");
							@fputs($avatar_fsock, "HOST: " . $avatar_url_ary[2] . "\r\n");
							@fputs($avatar_fsock, "Connection: close\r\n\r\n");

							while( !@feof($avatar_fsock) )
							{
								$avatar_data .= @fread($avatar_fsock, 1024);
							}
							@fclose($avatar_fsock);		

							if ( preg_match('#Content-Length\: ([0-9]+)[^ /][\s]+#i', $avatar_data, $avatar_file_data) )
							{
								$avatar_file_size = $avatar_file_data[1]; 
							} else
							{
								$avatar_file_size = strlen($avatar_data)-307; 
							}
						}
					}
				}
			}
		}		

		if( round(($total_image_files_size+$avatar_file_size)/1024, 2) > $board_config['sig_max_img_av_files_size'] )
		{
			$error = TRUE;
			$sig_error_list .= '<br />' . sprintf($lang['sig_error_img_av_files_size'], round($total_image_files_size/1024, 2), round($avatar_file_size/1024, 2), $board_config['sig_max_img_av_files_size']);
			$user_avatar_local = '';
		}
	} else
	{
		if( $board_config['sig_max_img_files_size'] != 0 && (round($total_image_files_size/1024, 2) > $board_config['sig_max_img_files_size']) )
		{
			$error = TRUE;
			$sig_error_list .= '<br />' . sprintf($lang['sig_error_img_files_size'], round($total_image_files_size/1024, 2), $board_config['sig_max_img_files_size']);
		}
	}

	if ( $error == TRUE && $sig_error_list )
	{
		$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['sig_error'] . '<br />' . $sig_error_list;
	}
	// End add - Signatures control MOD

	if ( $error )
	{
		message_die(GENERAL_ERROR, $error_msg);
	}
	if (!$error && !$preview)
	{
		// Start add - Signatures control MOD
		if ( $board_config['allow_sig'] && $userdata['user_allowsignature'] != 0 )
		{
			$sig_update = "user_sig = '" . str_replace("\'", "''", $signature) . "', user_sig_bbcode_uid = '".$signature_bbcode_uid."'";
		} else
		{
			$sig_update = "";
		}
		// End add - Signatures control MOD

		$sql = "UPDATE " . USERS_TABLE . " 
				SET " . $sig_update . "
				WHERE user_id = " . $view_userdata['user_id'];
		if ( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not update user table', '', __LINE__, __FILE__, $sql);
		}
	}
}
	// Start replacement - Signatures control MOD
	if ( $board_config['sig_max_lines'] )
	{
		$sig_explain_max_lines = sprintf($lang['sig_explain_max_lines'], $board_config['sig_max_lines']);
	} else
	{
		$sig_explain_max_lines = '';
	}

	if ( $board_config['sig_allow_font_sizes'] == 2 && !(!$board_config['sig_min_font_size'] && !$board_config['sig_max_font_size']) )
	{
		if ( $board_config['sig_min_font_size'] )
		{
			if ( $board_config['sig_max_font_size'] )
			{
				$sig_explain_font_size_limit = sprintf($lang['sig_explain_font_size_limit'], $board_config['sig_min_font_size'], $board_config['sig_max_font_size']);
			} else
			{
				$sig_explain_font_size_limit = sprintf($lang['sig_explain_font_size_limit'], $board_config['sig_min_font_size'], '29');
			}
		} else
		{
			$sig_explain_font_size_limit = sprintf($lang['sig_explain_font_size_max'], $board_config['sig_max_font_size']);
		}
	} else
	{
		$sig_explain_font_size_limit = '';
	}

	if ( $board_config['sig_allow_images'] )
	{
		if ( $board_config['sig_max_images'] )
		{
			$sig_explain_images_limit = sprintf($lang['sig_explain_images_limit'], $board_config['sig_max_images'], ( $board_config['sig_max_img_height'] ) ? $board_config['sig_max_img_height'] : $lang['sig_explain_unlimited'], ( $board_config['sig_max_img_width'] ) ? $board_config['sig_max_img_width'] : $lang['sig_explain_unlimited'], ( $board_config['sig_max_img_av_files_size'] ) ? $board_config['sig_max_img_av_files_size'] : $board_config['sig_max_img_files_size']);
		} else
		{
			$sig_explain_images_limit = sprintf($lang['sig_explain_unlimited_images'] , ( $board_config['sig_max_img_height'] ) ? $board_config['sig_max_img_height'] : $lang['sig_explain_unlimited'], ( $board_config['sig_max_img_width'] ) ? $board_config['sig_max_img_width'] : $lang['sig_explain_unlimited'], ( $board_config['sig_max_img_av_files_size'] ) ? $board_config['sig_max_img_av_files_size'] : $board_config['sig_max_img_files_size']);
		}
	} else
	{
		$sig_explain_images_limit = $lang['sig_explain_no_image'];
	}

	if ( $board_config['sig_max_img_av_files_size'] )
	{
		$sig_explain_images_limit .= $lang['sig_explain_avatar_included'];
	}

	$signature_explain = $lang['sig_explain'];

	if ( $userdata['user_allowsignature'] != 2 )
	{
		$signature_explain .= ' ' . sprintf($lang['sig_explain_limits'], $board_config['max_sig_chars'], $sig_explain_font_size_limit, $sig_explain_max_lines, $sig_explain_images_limit);

		if ( $board_config['sig_wordwrap'] )
		{
			$signature_explain .= ' ' . sprintf($lang['sig_explain_wordwrap'], $board_config['sig_wordwrap']);
		}
	}
	if ( $userdata['user_allowbbcode'] && $board_config['allow_bbcode']  )
	{
		if (($board_config['sig_allow_font_sizes'] &&
			$board_config['sig_allow_bold'] &&
			$board_config['sig_allow_italic'] &&
			$board_config['sig_allow_underline'] &&
			$board_config['sig_allow_colors'] &&
			$board_config['sig_allow_quote'] &&
			$board_config['sig_allow_code'] &&
			$board_config['sig_allow_list'] &&
			$board_config['sig_allow_url'] &&
			$board_config['sig_allow_images'] &&
			$board_config['sig_exotic_bbcodes_disallowed']=='') || $userdata['user_allowsignature'] == 2)
		{
			$lang['sig_bbcodes_off'] .= $lang['sig_none'];
			$lang['sig_bbcodes_on'] .= $lang['sig_all'];
			$bbcode_status = sprintf($lang['sig_bbcodes_on'], '<a href="' . append_sid("faq.$phpEx?mode=bbcode") . '" target="_phpbbcode">', '</a>') . '<br />' . sprintf($lang['sig_bbcodes_off'], '', '');
		} else
		{
			$lang['sig_bbcodes_off'] .= '<span style="color: #800000">';
			$lang['sig_bbcodes_off'] .= ( !$board_config['sig_allow_font_sizes'] ) ? '[size]' : '';
			$lang['sig_bbcodes_off'] .= ( !$board_config['sig_allow_bold'] ) ? '[b]' : '';
			$lang['sig_bbcodes_off'] .= ( !$board_config['sig_allow_italic'] ) ? '[i]' : '';
			$lang['sig_bbcodes_off'] .= ( !$board_config['sig_allow_underline'] ) ? '[u]' : '';
			$lang['sig_bbcodes_off'] .= ( !$board_config['sig_allow_colors'] ) ? '[color]' : '';
			$lang['sig_bbcodes_off'] .= ( !$board_config['sig_allow_quote'] ) ? '[quote]' : '';
			$lang['sig_bbcodes_off'] .= ( !$board_config['sig_allow_code'] ) ? '[code]' : '';
			$lang['sig_bbcodes_off'] .= ( !$board_config['sig_allow_list'] ) ? '[list]' : '';
			$lang['sig_bbcodes_off'] .= ( !$board_config['sig_allow_url'] ) ? '[url]' : '';
			$lang['sig_bbcodes_off'] .= ( !$board_config['sig_allow_images'] ) ? '[img]' : '';

			$exotic_bbcodes_list = explode(",", $board_config['sig_exotic_bbcodes_disallowed']);
      foreach ($exotic_bbcodes_list as $bbckey => $exotic_bbcode)
			{
				$exotic_bbcode = trim(strtolower($exotic_bbcode));
				if ( $exotic_bbcode != '' )
				{
					$lang['sig_bbcodes_off'] .= '['.$exotic_bbcode.']';
				}
			}

			$lang['sig_bbcodes_off'] .= '</span>';
			$bbcode_status = sprintf($lang['sig_bbcodes_off'], '<a href="' . append_sid("faq.$phpEx?mode=bbcode") . '" target="_phpbbcode">', '</a>');
		}
	} else
	{
		$bbcode_status = $lang['sig_BBCodes_are_OFF'];
	}

	if ( $board_config['allow_sig'] && $userdata['user_allowsignature'] )
	{
		$template->assign_block_vars('switch_signature_allowed', array());
	}
// End replacement - Signatures control MOD

if (!$submit)
{
	$template->assign_vars(array(
		'L_SIGNATURE'			=> $lang['Signature'],
		// Start replacement - Signatures control MOD
		'L_SIGNATURE_EXPLAIN' 	=> $signature_explain,
		// End replacement - Signatures control MOD

		'L_SIG_PREVIEW'			=> $lang['profilcp_sig_preview'],

		'L_SUBMIT'				=> $lang['Submit'],
		'L_PREVIEW'				=> $lang['Preview'],
		'L_RESET'				=> $lang['Reset'],

		'L_BBCODE_B_HELP'		=> $lang['bbcode_b_help'], 
		'L_BBCODE_I_HELP'		=> $lang['bbcode_i_help'], 
		'L_BBCODE_U_HELP'		=> $lang['bbcode_u_help'], 
		'L_BBCODE_Q_HELP'		=> $lang['bbcode_q_help'], 
		'L_BBCODE_C_HELP'		=> $lang['bbcode_c_help'], 
		'L_BBCODE_L_HELP'		=> $lang['bbcode_l_help'], 
		'L_BBCODE_O_HELP'		=> $lang['bbcode_o_help'], 
		'L_BBCODE_P_HELP'		=> $lang['bbcode_p_help'], 
		'L_BBCODE_W_HELP'		=> $lang['bbcode_w_help'], 
		'L_BBCODE_A_HELP'		=> $lang['bbcode_a_help'], 
		'L_BBCODE_S_HELP'		=> $lang['bbcode_s_help'], 
		'L_BBCODE_F_HELP'		=> $lang['bbcode_f_help'], 
		'L_EMPTY_MESSAGE'		=> $lang['Empty_message'],

		'L_FONT_COLOR'			=> $lang['Font_color'], 
		'L_COLOR_DEFAULT'		=> $lang['color_default'], 
		'L_COLOR_DARK_RED'		=> $lang['color_dark_red'], 
		'L_COLOR_RED'			=> $lang['color_red'], 
		'L_COLOR_ORANGE'		=> $lang['color_orange'], 
		'L_COLOR_BROWN'			=> $lang['color_brown'], 
		'L_COLOR_YELLOW'		=> $lang['color_yellow'], 
		'L_COLOR_GREEN'			=> $lang['color_green'], 
		'L_COLOR_OLIVE'			=> $lang['color_olive'], 
		'L_COLOR_CYAN'			=> $lang['color_cyan'], 
		'L_COLOR_BLUE'			=> $lang['color_blue'], 
		'L_COLOR_DARK_BLUE'		=> $lang['color_dark_blue'], 
		'L_COLOR_INDIGO'		=> $lang['color_indigo'], 
		'L_COLOR_VIOLET'		=> $lang['color_violet'], 
		'L_COLOR_WHITE'			=> $lang['color_white'], 
		'L_COLOR_BLACK'			=> $lang['color_black'], 

		'L_FONT_SIZE'			=> $lang['Font_size'], 
		'L_FONT_TINY'			=> $lang['font_tiny'], 
		'L_FONT_SMALL'			=> $lang['font_small'], 
		'L_FONT_NORMAL'			=> $lang['font_normal'], 
		'L_FONT_LARGE'			=> $lang['font_large'], 
		'L_FONT_HUGE'			=> $lang['font_huge'],

		'L_BBCODE_CLOSE_TAGS'	=> $lang['Close_Tags'],
		'L_STYLES_TIP'			=> $lang['Styles_tip'],
		)
	);

	$signature_bbcode_uid	= $view_userdata['user_sig_bbcode_uid'];
	$signature				= htmlspecialchars(stripslashes($view_userdata['user_sig']));
	$preview_sig			= prepare_signature( $signature, $view_userdata );

	$signature 				= ($signature_bbcode_uid != '') ? preg_replace('/:(([a-z0-9]+:)?)' . preg_quote($signature_bbcode_uid, '/') . '(=|\])/si', '\\3', $userdata['user_sig']) : $userdata['user_sig'];

	$html_status			= ( $view_userdata['user_allowhtml'] && $board_config['allow_html'] ) ? $lang['HTML_is_ON'] : $lang['HTML_is_OFF'];

	$smilies_status			= ( $view_userdata['user_allowsmile'] && $board_config['allow_smilies'] && $board_config['sig_allow_smilies']  ) ? $lang['Smilies_are_ON'] : $lang['Smilies_are_OFF'];

	// Generate smilies listing for page output
	generate_smilies('inline', PAGE_POSTING);

	$template->assign_vars(array(
		'MESSAGE'			=> str_replace('<br />', "\n", $signature),
		'SIG_PREVIEW'		=> $preview_sig,
		'HTML_STATUS'		=> $html_status,
		// Start replacement - Signatures control MOD
		'BBCODE_STATUS' 	=> $bbcode_status,
		// End replacement - Signatures control MOD
		'SMILIES_STATUS'	=> $smilies_status,
		)
	);

	$template->assign_vars(array(
		'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
		'S_PROFILCP_ACTION'	=> append_sid("profile.$phpEx"),
		)
	);

	// page
	$template->pparse('body');
}

?>
