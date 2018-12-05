<?php
/***************************************************************************
 *						def_usermaps.php
 *						----------------
 *	begin			: 04/10/2003
 *	copyright		: Ptirhiik
 *	email			: admin@rpgnet-fr.com
 *
 *	version			: 1.0.2 - 23/10/2003
 *
 *	last update		: 2016-11-20 22:27:56 by Helter *
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
// $user_maps array
//
//		key = name of the map,
//			order	: order,
//			split	: split the display in a new column
//			custom	: use a dedicated program or a standard program : 0: dedicated, 1: standard input, 2: standard output
//			title	: title or set of fields
//			fields	: set of fields
//
//			title and fields :
//				field_name  : Field name//				lang_key    : Legend of the field//				explain     : Explanation of the field//				image       : Image//				title       : Image title//				class       : Class//				type        : Type//				link        : Link//				dsp_func    : Display function//				leg         : Display the legend//				txt         : Display the text value//				img         : Display the image value//				crlf        : Text to next line//				lnk         : Use the link//				style       : Span display//				user_only   : Not a config value//				system      : System field//				required    : Required field//				visibility  : Show Visibility//				get_mode    : Get mode//				get_func    : Get function//				chk_func    : Check function//				default     : Default value//				values      : Values list//				inputstyle  : Input Template style//				auth        : Auth level//				ind         : Option address//				dft         : Checked by default//				rqd         : Force the selection//				hidden      : Add the field as hidden//				sql_def     : SQL definition//
//--------------------------------------------------------------------------------------------------
$user_maps = array(
	
	'PCP' => array(
										'title'		=> 'Profile',
					),
	
	'PCP.viewprofile' => array(
										'title'		=> 'profilcp_public_shortcut',
					),
	
	'PCP.viewprofile.base' => array(
								'custom'	=> 2,
						'title'		=> 'profilcp_public_base_shortcut',
					),
	
	'PCP.viewprofile.base.avatar' => array(
						'split'		=> true,
								'title'		=> 'Avatar',
						'fields'	=> array(
						'user_avatar' => array(
								'img'          => true,
							),
						'user_rank_title' => array(
								'txt'          => true,
								'img'          => true,
								'crlf'         => true,
								'style'        => '<span class="gensmall">%s</span>',
							),
						'user_warnings' => array(
								'txt'          => true,
								'img'          => true,
								'crlf'         => true,
								'style'        => '<span class="gensmall">%s</span>',
							),
					),
			),
	
	'PCP.viewprofile.base.messengers' => array(
				'order'		=> 20,
												'title'	=> array(
						'[leg]contact' => array(
								'lang_key'     => 'Contact',
								'leg'          => true,
								'style'        => '%s&nbsp;',
							),
						'username' => array(
								'txt'          => true,
								'style'        => '%s&nbsp;',
							),
						'user_online' => array(
								'img'          => true,
							),
					),
				'fields'	=> array(
						'[lf]0' => array(
							),
						'user_my_friend' => array(
								'leg'          => true,
								'img'          => true,
							),
						'user_my_ignore' => array(
								'leg'          => true,
								'img'          => true,
							),
						'user_email' => array(
								'leg'          => true,
								'img'          => true,
							),
						'user_pm' => array(
								'leg'          => true,
								'img'          => true,
							),
						'[lf]1' => array(
							),
						'user_msnm' => array(
								'leg'          => true,
								'img'          => true,
							),
						'user_skype' => array(
								'leg'          => true,
								'img'          => true,
							),
						'user_icq' => array(
								'leg'          => true,
								'img'          => true,
								'style'        => '<table cellpadding="0" cellspacing="0" border="0" width="60"><tr><td valign="middle" nowrap="nowrap"><span class="gensmall">%s</span></td></tr></table>',
							),
						'user_aim' => array(
								'leg'          => true,
								'img'          => true,
							),
						'user_yim' => array(
								'leg'          => true,
								'img'          => true,
							),
						'[lf]2' => array(
							),
					),
			),
	
	'PCP.viewprofile.base.groups' => array(
				'order'		=> 30,
										'title'		=> 'Usergroups',
						'fields'	=> array(
						'user_groups' => array(
								'txt'          => true,
							),
					),
			),
	
	'PCP.viewprofile.base.international' => array(
				'order'		=> 40,
										'title'		=> 'Profile_control_panel_i18n',
						'fields'	=> array(
						'user_timezone' => array(
								'img'          => true,
							),
						'user_lang' => array(
								'txt'          => true,
								'style'        => '<b>%s</b>',
							),
					),
			),
	
	'PCP.viewprofile.base.webinfo' => array(
				'order'		=> 50,
						'split'		=> true,
										'title'	=> array(
						'username' => array(
								'txt'          => true,
								'style'        => 'About_user',
							),
					),
				'fields'	=> array(
						'[lf]0' => array(
							),
						'user_regdate' => array(
								'leg'          => true,
								'txt'          => true,
							),
						'user_lastvisit' => array(
								'leg'          => true,
								'txt'          => true,
							),
						'[lf]1' => array(
							),
						'user_style' => array(
								'txt'          => true,
							),
						'user_posts_stat' => array(
								'leg'          => true,
								'txt'          => true,
								'crlf'         => true,
								'style'        => '<span class="genmed">%s</span>',
							),
						'user_topics_stat' => array(
								'leg'          => true,
								'txt'          => true,
								'img'          => true,
								'crlf'         => true,
							),
						'user_forums_stat' => array(
								'leg'          => true,
								'txt'          => true,
								'img'          => true,
								'crlf'         => true,
							),
						'[lf]2' => array(
							),
						'user_website' => array(
								'leg'          => true,
								'img'          => true,
							),
						'user_album' => array(
								'leg'          => true,
								'txt'          => true,
							),
						'[lf]3' => array(
							),
						'user_cashpr' => array(
								'txt'          => true,
								'img'          => true,
								'style'        => '<div class="gensmall">%s</div>',
							),
					),
			),
	
	'PCP.viewprofile.base.real' => array(
				'order'		=> 60,
										'title'		=> 'Real_info',
						'fields'	=> array(
						'[lf]0' => array(
							),
						'user_realname' => array(
								'leg'          => true,
								'txt'          => true,
							),
						'user_gender' => array(
								'leg'          => true,
								'img'          => true,
							),
						'user_birthday' => array(
								'leg'          => true,
								'txt'          => true,
								'img'          => true,
							),
						'user_country' => array(
								'leg'          => true,
								'img'          => true,
							),
						'user_state' => array(
								'leg'          => true,
								'img'          => true,
							),
						'[lf]1' => array(
							),
						'user_from' => array(
								'leg'          => true,
								'txt'          => true,
							),
						'user_occ' => array(
								'leg'          => true,
								'txt'          => true,
							),
						'user_holidays' => array(
								'leg'          => true,
								'txt'          => true,
							),
						'user_interests' => array(
								'leg'          => true,
								'txt'          => true,
							),
						'[lf]2' => array(
							),
						'user_home_phone' => array(
								'leg'          => true,
								'txt'          => true,
							),
						'user_home_fax' => array(
								'leg'          => true,
								'txt'          => true,
							),
						'user_work_phone' => array(
								'leg'          => true,
								'txt'          => true,
							),
						'user_work_fax' => array(
								'leg'          => true,
								'txt'          => true,
							),
						'user_cellular' => array(
								'leg'          => true,
								'txt'          => true,
							),
						'user_pager' => array(
								'leg'          => true,
								'txt'          => true,
							),
						'[lf]3' => array(
							),
					),
			),
	
	'PCP.viewprofile.base.signature' => array(
				'order'		=> 70,
										'title'		=> 'Signature',
						'fields'	=> array(
						'user_sig' => array(
								'txt'          => true,
								'style'        => '<div align="left" class="postbody">%s</span>',
							),
					),
			),
	
	'PCP.viewprofile.photo' => array(
				'order'		=> 10,
								'custom'	=> 2,
						'title'		=> 'profilcp_photo_shortcut',
					),
	
	'PCP.viewprofile.photo.pic' => array(
						'split'		=> true,
								'title'		=> 'Photo',
						'fields'	=> array(
						'user_photo' => array(
								'img'          => true,
								'style'        => '<div align="center" class="gensmall">%s</div>',
							),
					),
			),
	
	'PCP.home' => array(
				'order'		=> 10,
										'title'		=> 'profilcp_index_shortcut',
					),
	
	'PCP.profil' => array(
				'order'		=> 20,
										'title'		=> 'profilcp_profil_shortcut',
					),
	
	'PCP.profil.profile_prefer' => array(
								'custom'	=> 1,
						'title'		=> 'profilcp_prefer_shortcut',
					),
	
	'PCP.profil.profile_prefer.Registering_info' => array(
										'title'		=> 'profilcp_register_pagetitle',
						'fields'	=> array(
						'username' => array(
							),
						'user_realname' => array(
							),
						'user_birthday' => array(
							),
						'user_gender' => array(
							),
						'user_country' => array(
							),
						'user_state' => array(
							),
						'user_email' => array(
							),
						'user_email_confirm' => array(
							),
						'confirm_code' => array(
							),
						'user_password' => array(
							),
						'user_password_confirm' => array(
							),
						'phpBBSecurity_question' => array(
							),
						'phpBBSecurity_answer' => array(
							),
						'user_notify' => array(
							),
						'user_attachsig' => array(
							),
						'user_notify_pm' => array(
							),
						'user_popup_pm' => array(
							),
						'user_style' => array(
							),
						'user_rules' => array(
							),
					),
			),
	
	'PCP.profil.profile_prefer.base' => array(
				'order'		=> 10,
										'title'		=> 'profilcp_profil_base_shortcut',
					),
	
	'PCP.profil.profile_prefer.base.Real_info' => array(
										'title'		=> 'Real_info',
						'fields'	=> array(
						'user_from' => array(
							),
						'user_occ' => array(
							),
						'user_holidays' => array(
							),
						'user_interests' => array(
							),
					),
			),
	
	'PCP.profil.profile_prefer.base.Contact' => array(
				'order'		=> 10,
										'title'		=> 'Contact',
						'fields'	=> array(
						'user_home_phone' => array(
							),
						'user_home_fax' => array(
							),
						'user_work_phone' => array(
							),
						'user_work_fax' => array(
							),
						'user_cellular' => array(
							),
						'user_pager' => array(
							),
					),
			),
	
	'PCP.profil.profile_prefer.base.Messengers' => array(
				'order'		=> 20,
										'title'		=> 'Messengers',
						'fields'	=> array(
						'user_msnm' => array(
							),
						'user_skype' => array(
							),
						'user_icq' => array(
							),
						'user_aim' => array(
							),
						'user_yim' => array(
							),
					),
			),
	
	'PCP.profil.profile_prefer.base.Web_info' => array(
				'order'		=> 30,
										'title'		=> 'Web_info',
						'fields'	=> array(
						'user_website' => array(
							),
					),
			),
	
	'PCP.profil.profile_prefer.PCP' => array(
				'order'		=> 10,
										'title'		=> 'Profile_control_panel',
					),
	
	'PCP.profil.profile_prefer.PCP.i18n' => array(
										'title'		=> 'Profile_control_panel_i18n',
						'fields'	=> array(
						'user_lang' => array(
							),
						'user_timezone' => array(
							),
						'user_summer_time' => array(
							),
						'user_dateformat' => array(
							),
						'user_fdow' => array(
							),
					),
			),
	
	'PCP.profil.profile_prefer.PCP.privacy' => array(
				'order'		=> 10,
										'title'		=> 'Profile_control_panel_privacy',
						'fields'	=> array(
						'user_allow_viewonline' => array(
							),
						'user_viewemail' => array(
							),
						'user_viewpm' => array(
							),
						'user_viewwebsite' => array(
							),
						'user_viewmessenger' => array(
							),
						'user_viewreal' => array(
							),
					),
			),
	
	'PCP.profil.profile_prefer.PCP.notification' => array(
				'order'		=> 20,
										'title'		=> 'Profile_control_panel_notification',
					),
	
	'PCP.profil.profile_prefer.PCP.posting' => array(
				'order'		=> 30,
										'title'		=> 'Profile_control_panel_posting',
						'fields'	=> array(
						'user_setbm' => array(
							),
						'user_allowbbcode' => array(
							),
						'user_allowhtml' => array(
							),
						'user_allowsmile' => array(
							),
					),
			),
	
	'PCP.profil.profile_prefer.PCP.home' => array(
				'order'		=> 40,
										'title'		=> 'Profile_control_panel_home',
						'fields'	=> array(
						'user_buddy_friend_display' => array(
							),
						'user_buddy_ignore_display' => array(
							),
						'user_buddy_friend_of_display' => array(
							),
						'user_buddy_ignored_by_display' => array(
							),
						'user_privmsgs_per_page' => array(
							),
						'user_watched_topics_per_page' => array(
							),
						'user_topics_last_per_page' => array(
							),
					),
			),
	
	'PCP.profil.profile_prefer.PCP.reading' => array(
				'order'		=> 50,
										'title'		=> 'Profile_control_panel_reading',
						'fields'	=> array(
						'user_viewavatar' => array(
							),
						'user_viewphoto' => array(
							),
						'user_viewsig' => array(
							),
						'user_viewimg' => array(
							),
					),
			),
	'PCP.profil.profile_prefer.PCP.group_color' => array(
				'order'		=> 55,
										'title'		=> 'Color_options',
						'fields'	=> array(
						'user_group_id' => array(
								'txt'          => true,
							),
					),
			),
	
	'PCP.profil.profile_prefer.PCP.system' => array(
				'order'		=> 50,
										'title'		=> 'Profile_control_panel_system',
						'fields'	=> array(
						'icon_per_row' => array(
							),
						'summer_time' => array(
							),
						'summer_time_auto' => array(
							),
						'board_fdow' => array(
							),
						'mini_cal_calendar_version' => array(
							),
						'mini_cal_limit' => array(
							),
						'mini_cal_days_ahead' => array(
							),
						'mini_cal_date_search' => array(
							),
						'mini_cal_link_class' => array(
							),
						'mini_cal_today_class' => array(
							),
						'mini_cal_auth' => array(
							),
					),
			),
	
	'PCP.profil.profile_prefer.admin' => array(
				'order'		=> 20,
										'title'		=> 'profilcp_admin_shortcut',
						'fields'	=> array(
						'user_active' => array(
							),
						'user_allow_email' => array(
							),
						'user_allow_pm' => array(
							),
						'user_allow_website' => array(
							),
						'user_allow_messenger' => array(
							),
						'user_allow_real' => array(
							),
						'user_allowavatar' => array(
							),
						'user_allowphoto' => array(
							),
						'user_allowsignature' => array(
							),
						'user_extra' => array(
							),
						'user_posts' => array(
							),
						'user_warnings' => array(
							),
						'user_rank' => array(
							),
						'force_security' => array(
							),
						'reset_security' => array(
							),
						'clear_security' => array(
							),
						'delete_user' => array(
							),
					),
			),
	
	'PCP.profil.Preferences' => array(
				'order'		=> 10,
								'custom'	=> 1,
						'title'		=> 'Preferences',
					),
	
	'PCP.profil.Preferences.home' => array(
										'title'		=> 'Preferences',
					),
	
	'PCP.profil.avatar' => array(
				'order'		=> 20,
										'title'		=> 'profilcp_avatar_shortcut',
					),
	
	'PCP.profil.signature' => array(
				'order'		=> 30,
										'title'		=> 'profilcp_signature_shortcut',
					),
	
	'PCP.profil.digests' => array(
				'order'		=> 40,
										'title'		=> 'profilcp_digests_pagetitle',
					),
	
	'PCP.register' => array(
				'order'		=> 30,
										'title'		=> 'profilcp_register_shortcut',
					),
	
	'PCP.buddy' => array(
				'order'		=> 40,
										'title'		=> 'profilcp_buddy_shortcut',
						'fields'	=> array(
						'user_my_visible' => array(
							),
						'user_friend' => array(
							),
						'user_ignore' => array(
							),
						'user_my_ignore' => array(
							),
						'user_online' => array(
								'img'          => true,
							),
						'username' => array(
								'dsp_func'     => 'pcp_output_username_linked',
							),
						'user_pm' => array(
								'img'          => true,
							),
						'user_email' => array(
								'img'          => true,
							),
						'user_icq' => array(
								'img'          => true,
								'style'        => '<table cellpadding="0" cellspacing="0" border="0" width="60"><tr><td valign="middle" nowrap="nowrap"><span class="gensmall">%s</span></td></tr></table>',
							),
						'user_aim' => array(
								'img'          => true,
							),
						'user_skype' => array(
								'img'          => true,
							),
						'user_msnm' => array(
								'img'          => true,
							),
						'user_regdate' => array(
							),
						'user_yim' => array(
								'img'          => true,
							),
						'user_lastvisit' => array(
							),
						'user_posts' => array(
							),
						'user_timezone' => array(
							),
						'user_lang' => array(
							),
						'user_website' => array(
								'img'          => true,
							),
						'user_realname' => array(
							),
						'user_gender' => array(
								'img'          => true,
							),
						'user_birthday' => array(
								'txt'          => true,
								'img'          => true,
							),
						'user_from' => array(
							),
						'user_occ' => array(
							),
						'user_interests' => array(
							),
						'user_home_phone' => array(
							),
						'user_home_fax' => array(
							),
						'user_work_phone' => array(
							),
						'user_work_fax' => array(
							),
						'user_cellular' => array(
							),
						'user_pager' => array(
							),
						'user_my_friend' => array(
								'img'          => true,
							),
						'user_rank_title' => array(
								'img'          => true,
							),
						'user_holidays' => array(
							),
						'user_flag' => array(
							),
						'user_warnings' => array(
								'txt'          => true,
								'img'          => true,
								'crlf'         => true,
							),
						'user_visible' => array(
							),
					),
			),
	
	'PCP.privmsg' => array(
				'order'		=> 50,
										'title'		=> 'Private_Messaging',
					),
	
	'PHPBB' => array(
				'order'		=> 10,
										'title'		=> 'phpBB',
					),
	
	'PHPBB.privmsgs' => array(
										'title'		=> 'Privmsgs',
					),
	
	'PHPBB.privmsgs.buttons' => array(
										'title'		=> 'Buttons',
						'fields'	=> array(
						'username' => array(
								'img'          => true,
								'style'        => '<td valign="absbottom" nowrap="nowrap"><span class="genbtn fa fa-user">&nbsp;%s</span></td>',
							),
						'user_birthday' => array(
								'img'          => true,
								'style'        => '<td valign="absbottom" nowrap="nowrap"><span class="gensmall">%s</span></td>',
							),
						'user_my_friend' => array(
								'img'          => true,
								'style'        => '<td valign="absbottom" nowrap="nowrap"><span class="gensmall">%s</span></td>',
							),
						'user_my_ignore' => array(
								'img'          => true,
								'style'        => '<td valign="absbottom" nowrap="nowrap"><span class="gensmall">%s</span></td>',
							),
						'user_pm' => array(
								'img'          => true,
								'style'        => '<td valign="absbottom" nowrap="nowrap"><span class="genbtn fa fa-envelope-square">&nbsp;%s</span></td>',
							),
						'user_album' => array(
								'img'          => true,
								'style'        => '<td valign="absbottom" nowrap="nowrap"><span class="genbtn fa fa-picture-o">&nbsp;%s</span></td>',
							),
						'user_email' => array(
								'img'          => true,
								'style'        => '<td valign="absbottom" nowrap="nowrap"><span class="genbtn fa fa-user">&nbsp;%s</span></td>',
							),
						'user_website' => array(
								'img'          => true,
								'style'        => '<td valign="absbottom" nowrap="nowrap">&nbsp;<span class="genbtn">%s</span></td>',
							),
						'user_aim' => array(
								'img'          => true,
								'style'        => '<td valign="absbottom" nowrap="nowrap"><span class="gensmall">&nbsp;%s</span></td>',
							),
						'user_yim' => array(
								'img'          => true,
								'style'        => '<td valign="absbottom" nowrap="nowrap"><span class="gensmall">&nbsp;%s</span></td>',
							),
						'user_msnm' => array(
								'img'          => true,
								'style'        => '<td valign="absbottom" nowrap="nowrap"><span class="gensmall">&nbsp;%s</span></td>',
							),
						'user_skype' => array(
								'img'          => true,
								'style'        => '<td valign="absbottom" nowrap="nowrap" title="%s">&nbsp;%s</td>',
							),
						'user_icq' => array(
								'img'          => true,
								'style'        => '<td valign="absbottom" nowrap="nowrap"><span class="gensmall">&nbsp;%s</span></td>',
							),
					),
			),
	
	'PHPBB.privmsgs.buttons.ignore' => array(
										'title'		=> 'Ignore',
						'fields'	=> array(
						'user_my_ignore' => array(
								'img'          => true,
								'style'        => '<td valign="absbottom" nowrap="nowrap"><span class="gensmall">%s </span></td>',
							),
					),
			),
	
	'PHPBB.privmsgs.left' => array(
				'order'		=> 10,
										'title'		=> 'Left',
						'fields'	=> array(
						'username' => array(
								'dsp_func'     => 'pcp_output_username_linked',
								'txt'          => true,
								'style'        => '<span class="name">%s</span>',
							),
						'user_online' => array(
								'img'          => true,
								'style'        => '%s',
							),
					),
			),
	
	'PHPBB.privmsgs.left.ignore' => array(
										'title'		=> 'Ignore',
						'fields'	=> array(
						'username' => array(
								'txt'          => true,
								'style'        => '<span class="name">%s</span>',
							),
					),
			),
	
	'PHPBB.viewcomment' => array(
				'order'		=> 10,
										'title'		=> '',
					),
	
	'PHPBB.viewcomment.buttons' => array(
										'title'		=> 'Buttons',
						'fields'	=> array(
						'username' => array(
								'img'          => true,
								'style'        => '<td valign="absbottom" nowrap="nowrap"><span class="gensmall">%s </span></td>',
							),
						'user_pm' => array(
								'img'          => true,
								'style'        => '<td valign="absbottom" nowrap="nowrap"><span class="genbtn fa fa-envelope-square">&nbsp;%s</span></td>',
							),
						'user_album' => array(
								'img'          => true,
								'style'        => '<td valign="absbottom" nowrap="nowrap"><span class="genbtn fa fa-picture-o">&nbsp;%s</span></td>',
							),
						'user_email' => array(
								'img'          => true,
								'style'        => '<td valign="absbottom" nowrap="nowrap"><span class="genbtn fa fa-user">&nbsp;%s</span></td>',
							),
						'user_website' => array(
								'img'          => true,
								'style'        => '<td valign="absbottom" nowrap="nowrap">&nbsp;<span class="genbtn">%s</span></td>',
							),
						'user_aim' => array(
								'img'          => true,
								'style'        => '<td valign="absbottom" nowrap="nowrap"><span class="gensmall">&nbsp;%s</span></td>',
							),
						'user_yim' => array(
								'img'          => true,
								'style'        => '<td valign="absbottom" nowrap="nowrap"><span class="gensmall">&nbsp;%s</span></td>',
							),
						'user_msnm' => array(
								'img'          => true,
								'style'        => '<td valign="absbottom" nowrap="nowrap"><span class="gensmall">&nbsp;%s</span></td>',
							),
						'user_icq' => array(
								'img'          => true,
								'style'        => '<td valign="absbottom" nowrap="nowrap"><span class="gensmall">&nbsp;%s</span></td>',
							),
					),
			),
	
	'PHPBB.viewcomment.album' => array(
				'order'		=> 10,
										'title'		=> 'Album',
						'fields'	=> array(
						'username' => array(
								'txt'          => true,
								'style'        => '<div align="center" class="name">%s</div>',
							),
						'user_online' => array(
								'img'          => true,
								'style'        => '<div align="center">%s</div>',
							),
						'user_rank_title' => array(
								'txt'          => true,
								'img'          => true,
								'crlf'         => true,
								'style'        => '<div align="center" class="gensmall"><center>%s</center></div>',
							),
						'user_avatar' => array(
								'img'          => true,
								'style'        => '<div align="center">%s</div>',
							),
						'user_from' => array(
								'leg'          => true,
								'txt'          => true,
								'style'        => '<div align="center" class="gensmall">%s</div>',
							),
						'user_regdate' => array(
								'leg'          => true,
								'txt'          => true,
								'style'        => '<div align="center" class="gensmall">%s</div>',
							),
						'user_gender' => array(
								'leg'          => true,
								'img'          => true,
								'style'        => '<br /><div align="center" class="gensmall">%s</div>',
							),
						'user_age' => array(
								'leg'          => true,
								'txt'          => true,
								'style'        => '<div align="center" class="gensmall">%s</div>',
							),
						'user_posts' => array(
								'leg'          => true,
								'txt'          => true,
								'style'        => '<div align="center" class="gensmall">%s</div>',
							),
						'user_cashtp' => array(
								'txt'          => true,
								'style'        => '<div align="center" class="gensmall">%s</div>',
							),
						'user_holidays' => array(
								'txt'          => true,
								'style'        => '<div align="center" class="gensmall"><span class="alert">%s</span></div>',
							),
						'user_country' => array(
								'img'          => true,
								'style'        => '<br /><div align="center">%s ',
							),
						'user_state' => array(
								'img'          => true,
								'style'        => '%s</div>',
							),
						'user_warnings' => array(
								'txt'          => true,
								'img'          => true,
								'crlf'         => true,
								'style'        => '<div align="center" class="gensmall">%s</div>',
							),
					),
			),
	
	'PHPBB.viewtopic' => array(
				'order'		=> 20,
										'title'		=> 'View Topic',
					),
	
	'PHPBB.viewtopic.buttons' => array(
										'title'		=> 'Buttons',
						'fields'	=> array(
						'username' => array(
								'img'          => true,
								'style'        => '<li class="pcpvt"><span class="genbtn fa fa-user">&nbsp;%s</span></li>',
							),
						'user_birthday' => array(
								'img'          => true,
								'style'        => '<li class="pcpvt"><span class="gensmall">%s</span></li>',
							),
						'user_my_friend' => array(
								'img'          => true,
								'style'        => '<li class="pcpvt"><span class="gensmall">%s</span></li>',
							),
						'user_my_ignore' => array(
								'img'          => true,
								'style'        => '<li class="pcpvt"><span class="gensmall">%s</span></li>',
							),
						'user_pm' => array(
								'img'          => true,
								'style'        => '<li class="pcpvt"><span class="genbtn fa fa-envelope-square">&nbsp;%s</span></li>',
							),
						'user_album' => array(
								'img'          => true,
								'style'        => '<li class="pcpvt"><span class="genbtn fa fa-picture-o">&nbsp;%s</span></li>',
							),
						'user_email' => array(
								'img'          => true,
								'style'        => '<li class="pcpvt"><span class="genbtn fa fa-envelope-o">&nbsp;%s</span></li>',
							),
						'user_website' => array(
								'img'          => true,
								'style'        => '<li class="pcpvt"><span class="genbtn">%s</span></li>',
							),
						'user_aim' => array(
								'img'          => true,
								'style'        => '<li class="pcpvt">%s</li>',
							),
						'user_yim' => array(
								'img'          => true,
								'style'        => '<li class="pcpvt">%s</li>',
							),
						'user_msnm' => array(
								'img'          => true,
								'style'        => '<li class="pcpvt">%s</li>',
							),
						'user_skype' => array(
								'img'          => true,
								'style'        => '<li class="pcpvt">%s</li>',
							),
						'user_icq' => array(
								'img'          => true,
								'style'        => '<li class="pcpvt">%s</li>',
							),
					),
			),
	
	'PHPBB.viewtopic.buttons.ignore' => array(
										'title'		=> '',
						'fields'	=> array(
						'user_my_ignore' => array(
								'img'          => true,
								'style'        => '<td valign="absbottom" nowrap="nowrap"><span class="gensmall">%s&nbsp;</span></td>',
							),
					),
			),
	
	'PHPBB.viewtopic.left' => array(
				'order'		=> 10,
										'title'		=> 'Left',
						'fields'	=> array(
						'username' => array(
								'txt'          => true,
								'style'        => '<div align="center" class="name">%s</div>',
							),
						'user_online' => array(
								'img'          => true,
								'style'        => '<div class="fa fa-user-circle-o" align="center">%s</div>',
							),
						'user_rank_title' => array(
								'txt'          => true,
								'img'          => true,
								'crlf'         => true,
								'style'        => '<div align="center" class="gensmall"><center>%s</center></div>',
							),
						'user_avatar' => array(
								'img'          => true,
								'style'        => '<div align="center">%s</div>',
							),
						'user_from' => array(
								'leg'          => true,
								'txt'          => true,
								'style'        => '<div align="center" class="gensmall">%s</div>',
							),
						'user_regdate' => array(
								'leg'          => true,
								'txt'          => true,
								'style'        => '<div align="center" class="gensmall">%s</div>',
							),
						'user_gender' => array(
								'leg'          => true,
								'img'          => true,
								'style'        => '<br /><div align="center" class="gensmall">%s</div>',
							),
						'user_age' => array(
								'leg'          => true,
								'txt'          => true,
								'style'        => '<div align="center" class="gensmall">%s</div>',
							),
						'user_posts' => array(
								'leg'          => true,
								'txt'          => true,
								'style'        => '<div align="center" class="gensmall">%s</div>',
							),
						'user_cashtp' => array(
								'txt'          => true,
								'style'        => '<div align="center" class="gensmall">%s</div>',
							),
						'user_holidays' => array(
								'txt'          => true,
								'style'        => '<div align="center" class="gensmall"><span class="alert">%s</span></div>',
							),
						'user_country' => array(
								'img'          => true,
								'style'        => '<br /><div align="center">%s ',
							),
						'user_state' => array(
								'img'          => true,
								'style'        => '%s</div>',
							),
						'user_warnings' => array(
								'txt'          => true,
								'img'          => true,
								'crlf'         => true,
								'style'        => '<div align="center" class="gensmall">%s</div>',
							),
					),
			),
	
	'PHPBB.viewtopic.left.ignore' => array(
										'title'		=> '',
						'fields'	=> array(
						'username' => array(
								'txt'          => true,
								'style'        => '<span class="name">%s</span>',
							),
					),
			),
	
	'PHPBB.staff' => array(
				'order'		=> 20,
										'title'		=> 'Staff',
					),
	
	'PHPBB.staff.info' => array(
										'title'		=> 'Info',
						'fields'	=> array(
						'username' => array(
								'txt'          => true,
								'style'        => '<div align="center" class="name">%s</div>',
							),
						'user_online' => array(
								'img'          => true,
								'style'        => '<div align="center">%s</div>',
							),
						'user_rank_title' => array(
								'txt'          => true,
								'img'          => true,
								'crlf'         => true,
								'style'        => '<div align="center" class="gensmall"><center>%s</center></div>',
							),
						'user_avatar' => array(
								'img'          => true,
								'style'        => '<div align="center">%s</div><br />',
							),
						'user_gender' => array(
								'img'          => true,
								'style'        => '<div align="center" class="gensmall">%s</div>',
							),
					),
			),
	
	'PHPBB.staff.statistics' => array(
				'order'		=> 10,
						'split'		=> true,
								'title'		=> 'Statistics',
						'fields'	=> array(
						'user_regdate' => array(
								'leg'          => true,
								'txt'          => true,
								'style'        => '%s<br /><br />',
							),
						'user_lastvisit' => array(
								'leg'          => true,
								'txt'          => true,
								'style'        => '%s<br /><br />',
							),
						'user_posts_stat' => array(
								'leg'          => true,
								'txt'          => true,
								'crlf'         => true,
								'style'        => '%s<br /><br />',
							),
						'user_topics_stat' => array(
								'leg'          => true,
								'txt'          => true,
								'img'          => true,
								'crlf'         => true,
								'style'        => '%s<br /><br />',
							),
						'user_forums_stat' => array(
								'leg'          => true,
								'txt'          => true,
								'img'          => true,
								'crlf'         => true,
								'style'        => '%s<br /><br />',
							),
					),
			),
	
	'PHPBB.staff.contact' => array(
				'order'		=> 20,
						'split'		=> true,
								'title'		=> 'Contact',
						'fields'	=> array(
						'username' => array(
								'img'          => true,
								'style'        => '<span valign="absbottom" class="gensmall clearfix">%s&nbsp;</span><br />',
							),
						'user_pm' => array(
								'img'          => true,
								'style'        => '<span valign="absbottom" class="gensmall clearfix">%s&nbsp;</span><br />',
							),
						'user_email' => array(
								'img'          => true,
								'style'        => '<span valign="absbottom" class="gensmall clearfix">%s&nbsp;</span><br />',
							),
						'user_website' => array(
								'img'          => true,
								'style'        => '<span valign="absbottom" class="gensmall clearfix">%s&nbsp;</span><br />',
							),
						'user_aim' => array(
								'img'          => true,
								'style'        => '<span class="pcpvt">%s</span><br />',
							),
						'user_yim' => array(
								'img'          => true,
								'style'        => '<span class="pcpvt">%s</span><br />',
							),
						'user_msnm' => array(
								'img'          => true,
								'style'        => '<span class="pcpvt">%s</span><br />',
							),
						'user_skype' => array(
								'img'          => true,
								'style'        => '<span class="pcpvt">%s</span><br />',
							),
						'user_icq' => array(
								'img'          => true,
								'style'        => '<span class="pcpvt">%s</span><br />',
							),
						'user_birthday' => array(
								'img'          => true,
								'style'        => '<span valign="absbottom" class="gensmall clearfix">%s&nbsp;</span><br />',
							),
						'user_my_friend' => array(
								'img'          => true,
								'style'        => '<span valign="absbottom" class="gensmall clearfix">%s&nbsp;</span><br />',
							),
						'user_my_ignore' => array(
								'img'          => true,
								'style'        => '<span valign="absbottom" class="gensmall clearfix">%s&nbsp;</span><br />',
							),
					),
			),
	
	'PHPBB.groupcp' => array(
				'order'		=> 30,
										'title'		=> 'Usergroups',
						'fields'	=> array(
						'username' => array(
								'dsp_func'     => 'pcp_output_username_linked',
								'txt'          => true,
							),
						'user_online' => array(
								'img'          => true,
							),
						'user_pm' => array(
								'img'          => true,
							),
						'user_email' => array(
								'img'          => true,
							),
						'user_website' => array(
								'img'          => true,
							),
					),
			),
	
	'PHPBB.viewonline' => array(
				'order'		=> 40,
										'title'		=> 'Who_is_Online',
						'fields'	=> array(
						'username' => array(
								'dsp_func'     => 'pcp_output_username_linked',
								'txt'          => true,
								'style'        => '<td class="{CLASS}" nowrap align="center">%s</td>',
							),
						'user_session_time' => array(
								'txt'          => true,
								'style'        => '<td class="{CLASS}" nowrap align="center">%s</td>',
							),
						'user_session_page' => array(
								'txt'          => true,
								'style'        => '<td class="{CLASS}" nowrap align="center">%s</td>',
							),
					),
			),
	
	'PHPBB.viewonline.contact' => array(
										'title'		=> 'Contact',
						'fields'	=> array(
						'username' => array(
								'img'          => true,
								'style'        => ' %s',
							),
						'user_pm' => array(
								'img'          => true,
								'style'        => ' %s',
							),
						'user_email' => array(
								'img'          => true,
								'style'        => ' %s',
							),
						'user_website' => array(
								'img'          => true,
								'style'        => ' %s',
							),
						'user_aim' => array(
								'img'          => true,
								'style'        => ' %s',
							),
						'user_yim' => array(
								'img'          => true,
								'style'        => ' %s',
							),
						'user_msnm' => array(
								'img'          => true,
								'style'        => ' %s',
							),
						'user_skype' => array(
								'img'          => true,
								'style'        => ' %s',
							),
						'user_icq' => array(
								'img'          => true,
								'style'        => ' %s',
							),
						'user_birthday' => array(
								'img'          => true,
								'style'        => ' %s',
							),
						'user_my_friend' => array(
								'img'          => true,
								'style'        => ' %s',
							),
						'user_my_ignore' => array(
								'img'          => true,
								'style'        => ' %s',
							),
					),
			),
	);
?>