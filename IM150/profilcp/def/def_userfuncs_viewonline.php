<?php

/***************************************************************************
 *							def_userfuncs_viewonline.php
 *							----------------------------
 *	begin				: 05/12/2004
 *	copyright		: Edwin Bekarty
 *	email				: edwin@ednique.com
 *
 *	version			: 1.0.0 - 05/12/2004
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

function pcp_output_session_page($field_name, $view_userdata, $map_name='') 
{ 
    global $board_config, $images, $lang, $phpEx, $phpbb_root_path, $tree; 
     
    if ( !$view_userdata['session_logged_in'] ) { 
        $value = $view_userdata['session_page']; 
    }    else { 
        $value = $view_userdata[$field_name] ; 
    } 
    if ( $value < 1 ) { 
        // non forum page 
        switch($value) { 
            case PAGE_INDEX: 
                $location = $lang['Index']; 
                $location_url = "index.$phpEx"; 
                break; 
            case PAGE_PORTAL: 
                $location = $lang['Home']; 
                $location_url = "portal.$phpEx"; 
                break; 
            case PAGE_POSTING: 
                $location = $lang['Posting_message']; 
                $location_url = "index.$phpEx"; 
                break; 
            case PAGE_LOGIN: 
                $location = $lang['Logging_on']; 
                $location_url = "index.$phpEx"; 
                break; 
            case PAGE_SEARCH: 
                $location = $lang['Searching_forums']; 
                $location_url = "search.$phpEx"; 
                break; 
            case PAGE_PROFILE: 
                $location = $lang['Viewing_profile']; 
                $location_url = "index.$phpEx"; 
                break; 
            case PAGE_VIEWONLINE: 
                $location = $lang['Viewing_online']; 
                $location_url = "viewonline.$phpEx"; 
                break; 
            case PAGE_VIEWMEMBERS: 
                $location = $lang['Viewing_member_list']; 
                $location_url = "memberlist.$phpEx"; 
                break; 
            case PAGE_PRIVMSGS: 
                $location = $lang['Viewing_priv_msgs']; 
                $location_url = "privmsg.$phpEx"; 
                break;
            case PAGE_FAQ: 
                $location = $lang['Viewing_FAQ']; 
                $location_url = "faq.$phpEx"; 
                break; 
			// Mighty Gorgon - Full Album Pack - BEGIN
			case PAGE_ALBUM:
				$location = $lang['View_Album_Index'];
				$location_url = "album.$phpEx";
				break;
			case PAGE_ALBUM_PERSONAL:
				$location = $lang['View_Album_Personal'];
				$location_url = "album_personal_index.$phpEx";
				break;
			case PAGE_ALBUM_PICTURE:
				$location = $lang['View_Pictures'];
				$location_url = "album.$phpEx";
				break;
			case PAGE_ALBUM_SEARCH:
				$location = $lang['Album_Search'];
				$location_url = "album.$phpEx";
				break;
			// Mighty Gorgon - Full Album Pack - END
            case PAGE_RULES: 
                $location = $lang['Viewing_RULES']; 
                $location_url = "rules.$phpEx"; 
                break; 
            case PAGE_KB: 
                $location = $lang['Viewing_KB']; 
                $location_url = "kb.$phpEx"; 
                break; 
            case PAGE_SHOUTBOX: 
                $location = $lang['Shoutbox']; 
                $location_url = "shoutbox_max.$phpEx"; 
                break; 
            case PAGE_REDIRECT: 
                require_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_banner.' . $phpEx); 
                if ($view_userdata['session_topic']) 
                { 
                    $sql = "SELECT banner_description FROM " . BANNERS_TABLE . " WHERE banner_id=" . $view_userdata['session_topic']; 
                    if ( $result2 = $db->sql_query($sql) ) 
                    { 
                        $banner_data = $db->sql_fetchrow($result2); 
                    } 
                    else 
                    {     
                        message_die(GENERAL_ERROR, 'Could not obtain redirect online information', '', __LINE__, __FILE__, $sql); 
                    } 
                    $location_url = append_sid("redirect.$phpEx?banner_id=" . $view_userdata['session_topic']); 
                    $location = $lang['Left_via_banner'] .' --> '.$banner_data['banner_description']; 
                } else { 
                    $location_url = ""; 
                    $location = $lang['Left_via_banner']; 
                } 
                break; 
            case PAGE_PRILLIAN: 
                include_once(PRILL_PATH . 'prill_common.' . $phpEx); 
                if ( empty($im_userdata) ) 
                { 
                    $im_userdata = init_imprefs($view_userdata['user_id'], false, true); 
                } 
                $location = $lang['Prillian']; 
                $location_url = PRILL_URL . $im_userdata['mode_string']; 
                break; 
            case PAGE_CONTACT: 
                $location = $lang['Contact_Management']; 
                $location_url = CONTACT_URL; 
                break; 
            case PAGE_MYCOOKIES: 
                $location = $lang['cookies_link']; 
                $location_url = "mycookies.$phpEx"; 
                break; 
            case PAGE_STAFF: 
                $location = $lang['Staff']; 
                $location_url = "staff.$phpEx"; 
                break; 
            case (PAGE_UACP): 
                $location = $lang['User_acp_title']; 
                $location_url = "index.$phpEx"; 
                break; 
            case (PAGE_RULES): 
                $location = $lang['Rules_page']; 
                $location_url = "rules.$phpEx"; 
                break; 
            default: 
                $location = $lang['Home']; 
                $location_url = "portal.$phpEx"; 
        } 
    } else { 
        // forum page 
        $is_auth = $tree['auth'][POST_FORUM_URL . $value]; 
        if($is_auth['auth_view']){ 
            $location_url = append_sid("viewforum.$phpEx?" . POST_FORUM_URL . '=' . $value); 
        } 
        $location = get_object_lang(POST_FORUM_URL . $value, 'name'); 
    } 
    if($location_url){ 
        $txt = '<a href="'.$location_url.'">'.$location.'</a>'; 
    } else { 
        $txt = $location; 
    } 
    $res = pcp_output_format($field_name, $txt, $img, $map_name); 
    return $res; 
} 

function pcp_output_session_time($field_name, $view_userdata, $map_name='') 
{ 
    global $board_config; 
    if (!$view_userdata['session_logged_in']){ 
        if($view_userdata['session_time']){ 
            $sesstime = $view_userdata['session_time']; 
        }else{ 
            $sesstime = $board_config['guest_lastvisit']; 
        } 
        $txt = create_date('H:i:s', $sesstime, $board_config['board_timezone']); 
    } else { 
        $txt = create_date('H:i:s', $view_userdata[$field_name], $board_config['board_timezone']); 
    } 
    $res = pcp_output_format($field_name, $txt, $img, $map_name); 
    return $res; 
}
?>