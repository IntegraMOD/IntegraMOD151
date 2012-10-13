<div class="maintitle">{L_CONFIGURATION_TITLE}</div>
<br />
<div class="genmed">{L_CONFIGURATION_EXPLAIN}</div>
<script language="javascript" type="text/javascript">
<!--
function update_logo(newlogo)
{
	document.logo_image.src = "{LOGO_IMAGE_DIR}/" + newlogo;
}
//-->
</script>
<br />
<form action="{S_CONFIG_ACTION}" method="post">
<table width="99%" cellpadding="3" cellspacing="1" border="0" align="center" class="forumline">
	<tr> 
		<th colspan="2">{L_GENERAL_SETTINGS}</th>
	</tr>
	<tr> 
		<td class="row1" width="38%">{L_SERVER_NAME}</td>
		<td class="row2" width="62%"> 
		<input type="text" maxlength="255" size="40" name="server_name" value="{SERVER_NAME}" class="post" />
		</td>
	</tr>
	<tr> 
		<td class="row1">{L_SERVER_PORT}<br />
		<span class="gensmall">{L_SERVER_PORT_EXPLAIN}</span></td>
		<td class="row2"> 
		<input type="text" maxlength="5" size="5" name="server_port" value="{SERVER_PORT}" class="post" />
		</td>
	</tr>
	<tr> 
		<td class="row1">{L_SCRIPT_PATH}<br />
		<span class="gensmall">{L_SCRIPT_PATH_EXPLAIN}</span></td>
		<td class="row2"> 
		<input type="text" maxlength="255" name="script_path" value="{SCRIPT_PATH}" class="post" />
		</td>
	</tr>
	<tr> 
		<td class="row1">{L_SITE_NAME}<br />
		<span class="gensmall">{L_SITE_NAME_EXPLAIN}</span></td>
		<td class="row2"> 
		<input type="text" size="25" maxlength="100" name="sitename" value="{SITENAME}" class="post" />
		</td>
	</tr>
	<tr> 
		<td class="row1">{L_SITE_DESCRIPTION}</td>
		<td class="row2"> 
		<input type="text" size="40" maxlength="255" name="site_desc" value="{SITE_DESCRIPTION}" class="post" />
		</td>
	</tr>
	<tr> 
		<td class="row1">{L_DISABLE_BOARD}<br />
		<span class="gensmall">{L_DISABLE_BOARD_EXPLAIN}</span></td>
		<td class="row2"> 
		<input type="radio" name="board_disable" value="1" {S_DISABLE_BOARD_YES} />
		{L_YES}&nbsp;&nbsp; 
		<input type="radio" name="board_disable" value="0" {S_DISABLE_BOARD_NO} />
		{L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_DISABLE_BOARD_MSG}<br /><span class="gensmall">{L_DISABLE_BOARD_MSG_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" maxlength="255" size="40" name="board_disable_msg" value="{DISABLE_BOARD_MSG}" /></td></td>
	</tr>
	<tr> 
		<td class="row1">{L_ACCT_ACTIVATION}</td>
		<td class="row2"> 
		<input type="radio" name="require_activation" value="{ACTIVATION_NONE}" {ACTIVATION_NONE_CHECKED} />
		{L_NONE}&nbsp; &nbsp; 
		<input type="radio" name="require_activation" value="{ACTIVATION_USER}" {ACTIVATION_USER_CHECKED} />
		{L_USER}&nbsp; &nbsp; 
		<input type="radio" name="require_activation" value="{ACTIVATION_ADMIN}" {ACTIVATION_ADMIN_CHECKED} />
		{L_ADMIN}</td>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_AUTOLOGIN}<br /><span class="gensmall">{L_ALLOW_AUTOLOGIN_EXPLAIN}</span></td>
		<td class="row2"><input type="radio" name="allow_autologin" value="1" {ALLOW_AUTOLOGIN_YES} />{L_YES}&nbsp; &nbsp;<input type="radio" name="allow_autologin" value="0" {ALLOW_AUTOLOGIN_NO} />{L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_AUTOLOGIN_TIME} <br /><span class="gensmall">{L_AUTOLOGIN_TIME_EXPLAIN}</span></td>
	    <td class="row2"><input class="post" type="text" size="3" maxlength="4" name="max_autologin_time" value="{AUTOLOGIN_TIME}" /></td>
	</tr>
	<tr> 
		<td class="row1">{L_BOARD_EMAIL_FORM}<br />
		<span class="gensmall">{L_BOARD_EMAIL_FORM_EXPLAIN}</span></td>
		<td class="row2"> 
		<input type="radio" name="board_email_form" value="1" {BOARD_EMAIL_FORM_ENABLE} />
		{L_ENABLED}&nbsp;&nbsp; 
		<input type="radio" name="board_email_form" value="0" {BOARD_EMAIL_FORM_DISABLE} />
		{L_DISABLED}</td>
	</tr>
	<tr> 
		<td class="row1">{L_FLOOD_INTERVAL} <br />
		<span class="gensmall">{L_FLOOD_INTERVAL_EXPLAIN}</span></td>
		<td class="row2"> 
		<input type="text" size="3" maxlength="4" name="flood_interval" value="{FLOOD_INTERVAL}" class="post" />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_SEARCH_FLOOD_INTERVAL} <br /><span class="gensmall">{L_SEARCH_FLOOD_INTERVAL_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="3" maxlength="4" name="search_flood_interval" value="{SEARCH_FLOOD_INTERVAL}" /></td>
	</tr>
	<tr> 
		<td class="row1">{L_TOPICS_PER_PAGE}</td>
		<td class="row2"> 
		<input type="text" name="topics_per_page" size="3" maxlength="4" value="{TOPICS_PER_PAGE}" class="post" />
		</td>
	</tr>
	<tr> 
		<td class="row1">{L_POSTS_PER_PAGE}</td>
		<td class="row2"> 
		<input type="text" name="posts_per_page" size="3" maxlength="4" value="{POSTS_PER_PAGE}" class="post" />
		</td>
	</tr>
	<tr> 
		<td class="row1">{L_HOT_THRESHOLD}</td>
		<td class="row2"> 
		<input type="text" name="hot_threshold" size="3" maxlength="4" value="{HOT_TOPIC}" class="post" />
		</td>
	</tr>
	<tr> 
		<td class="row1">{L_DEFAULT_STYLE}</td>
		<td class="row2">{STYLE_SELECT}</td>
	</tr>
	<tr> 
		<td class="row1">{L_OVERRIDE_STYLE}<br />
		<span class="gensmall">{L_OVERRIDE_STYLE_EXPLAIN}</span></td>
		<td class="row2"> 
		<input type="radio" name="override_user_style" value="1" {OVERRIDE_STYLE_YES} />
		{L_YES}&nbsp;&nbsp; 
		<input type="radio" name="override_user_style" value="0" {OVERRIDE_STYLE_NO} />
		{L_NO}</td>
	</tr>
	<tr> 
		<td class="row1">{L_DEFAULT_LANGUAGE}</td>
		<td class="row2">{LANG_SELECT}</td>
	</tr>
	<tr> 
		<td class="row1">{L_DATE_FORMAT}<br />
		<span class="gensmall">{L_DATE_FORMAT_EXPLAIN}</span></td>
		<td class="row2"> 
		<input type="text" name="default_dateformat" value="{DEFAULT_DATEFORMAT}" class="post" />
		</td>
	</tr>
	<tr> 
		<td class="row1">{L_SYSTEM_TIMEZONE}</td>
		<td class="row2">{TIMEZONE_SELECT}</td>
	</tr>
	<tr> 
		<td class="row1">{L_ENABLE_GZIP}</td>
		<td class="row2"> 
		<input type="radio" name="gzip_compress" value="1" {GZIP_YES} />
		{L_YES}&nbsp;&nbsp; 
		<input type="radio" name="gzip_compress" value="0" {GZIP_NO} />
		{L_NO}</td>
	</tr>
	<tr> 
		<td class="row1">{L_ENABLE_PRUNE}</td>
		<td class="row2"> 
		<input type="radio" name="prune_enable" value="1" {PRUNE_YES} />
		{L_YES}&nbsp;&nbsp; 
		<input type="radio" name="prune_enable" value="0" {PRUNE_NO} />
		{L_NO}</td>
	</tr>
	<tr>
		<th class="thHead" colspan="2">{L_LOGO_SETTINGS}</th>
	</tr>
	<tr>
		<td class="row2" colspan="2"><span class="gensmall">{L_LOGO_EXPLAIN}</span></td>
	</tr>
	<tr> 
	  <td class="row1">{L_LOGO_PATH}<br /><span class="gensmall">{L_LOGO_PATH_EXPLAIN}</span></td>
	  <td class="row2"><input class="post" type="text" size="20" maxlength="255" name="logo_image_path" value="{LOGO_PATH}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_LOGO_DIMENSIONS}<br /><span class="gensmall">{L_LOGO_DIMENSIONS_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="3" maxlength="4" name="logo_image_h" value="{LOGO_HEIGHT}" /> x <input class="post" type="text" size="3" maxlength="4" name="logo_image_w" value="{LOGO_WIDTH}"></td>
	</tr>
	<tr> 
	  <td class="row1">{L_LOGO}</td>
	  <td class="row2"><select name="logo_image" onchange="update_logo(this.options[selectedIndex].value);">{LOGO_LIST}</select> &nbsp; <img name="logo_image" src="{LOGO_IMAGE}" border="0" width="{LOGO_WIDTH}" height="{LOGO_HEIGHT}"/> &nbsp;</td>
	</tr>
	<tr> 
		<th colspan="2">{L_COOKIE_SETTINGS}</th>
	</tr>
	<tr> 
		<td class="row2" colspan="2"><span class="gensmall">{L_COOKIE_SETTINGS_EXPLAIN}</span></td>
	</tr>
	<tr> 
		<td class="row1">{L_COOKIE_DOMAIN}</td>
		<td class="row2"> 
		<input type="text" maxlength="255" name="cookie_domain" value="{COOKIE_DOMAIN}" class="post" />
		</td>
	</tr>
	<tr> 
		<td class="row1">{L_COOKIE_NAME}</td>
		<td class="row2"> 
		<input type="text" maxlength="16" name="cookie_name" value="{COOKIE_NAME}" class="post" />
		</td>
	</tr>
	<tr> 
		<td class="row1">{L_COOKIE_PATH}</td>
		<td class="row2"> 
		<input type="text" maxlength="255" name="cookie_path" value="{COOKIE_PATH}" class="post" />
		</td>
	</tr>
	<tr> 
		<td class="row1">{L_COOKIE_SECURE}<br />
		<span class="gensmall">{L_COOKIE_SECURE_EXPLAIN}</span></td>
		<td class="row2"> 
		<input type="radio" name="cookie_secure" value="0" {S_COOKIE_SECURE_DISABLED} />
		{L_DISABLED}&nbsp; &nbsp; 
		<input type="radio" name="cookie_secure" value="1" {S_COOKIE_SECURE_ENABLED} />
		{L_ENABLED}</td>
	</tr>
	<tr> 
		<td class="row1">{L_SESSION_LENGTH}</td>
		<td class="row2"> 
		<input type="text" maxlength="5" size="5" name="session_length" value="{SESSION_LENGTH}" class="post" />
		</td>
	</tr>
	<tr> 
		<th colspan="2">{L_PRIVATE_MESSAGING}</th>
	</tr>
	<tr> 
		<td class="row1">{L_DISABLE_PRIVATE_MESSAGING}</td>
		<td class="row2"> 
		<input type="radio" name="privmsg_disable" value="0" {S_PRIVMSG_ENABLED} />
		{L_ENABLED}&nbsp; &nbsp; 
		<input type="radio" name="privmsg_disable" value="1" {S_PRIVMSG_DISABLED} />
		{L_DISABLED}</td>
	</tr>
	<tr> 
		<td class="row1">{L_INBOX_LIMIT}</td>
		<td class="row2"> 
		<input type="text" maxlength="4" size="4" name="max_inbox_privmsgs" value="{INBOX_LIMIT}" class="post" />
		</td>
	</tr>
	<tr> 
		<td class="row1">{L_SENTBOX_LIMIT}</td>
		<td class="row2"> 
		<input type="text" maxlength="4" size="4" name="max_sentbox_privmsgs" value="{SENTBOX_LIMIT}" class="post" />
		</td>
	</tr>
	<tr> 
		<td class="row1">{L_SAVEBOX_LIMIT}</td>
		<td class="row2"> 
		<input type="text" maxlength="4" size="4" name="max_savebox_privmsgs" value="{SAVEBOX_LIMIT}" class="post" />
		</td>
	</tr>
	<tr> 
		<th colspan="2">{L_ABILITIES_SETTINGS}</th>
	</tr>
	<tr> 
		<td class="row1">{L_MAX_POLL_OPTIONS}</td>
		<td class="row2"> 
		<input type="text" name="max_poll_options" size="4" maxlength="4" value="{MAX_POLL_OPTIONS}" class="post" />
		</td>
	</tr>
	<tr> 
		<td class="row1">{L_ALLOW_HTML}</td>
		<td class="row2"> 
		<input type="radio" name="allow_html" value="1" {HTML_YES} />
		{L_YES}&nbsp;&nbsp; 
		<input type="radio" name="allow_html" value="0" {HTML_NO} />
		{L_NO}</td>
	</tr>
	<tr> 
		<td class="row1">{L_ALLOWED_TAGS}<br />
		<span class="gensmall">{L_ALLOWED_TAGS_EXPLAIN}</span></td>
		<td class="row2"> 
		<input type="text" size="30" maxlength="255" name="allow_html_tags" value="{HTML_TAGS}" class="post" />
		</td>
	</tr>
	<tr> 
		<td class="row1">{L_ALLOW_BBCODE}</td>
		<td class="row2"> 
		<input type="radio" name="allow_bbcode" value="1" {BBCODE_YES} />
		{L_YES}&nbsp;&nbsp; 
		<input type="radio" name="allow_bbcode" value="0" {BBCODE_NO} />
		{L_NO}</td>
	</tr>
	<tr> 
		<td class="row1">{L_ALLOW_SMILIES}</td>
		<td class="row2"> 
		<input type="radio" name="allow_smilies" value="1" {SMILE_YES} />
		{L_YES}&nbsp;&nbsp; 
		<input type="radio" name="allow_smilies" value="0" {SMILE_NO} />
		{L_NO}</td>
	</tr>
	<tr> 
		<td class="row1">{L_SMILIES_PATH} <br />
		<span class="gensmall">{L_SMILIES_PATH_EXPLAIN}</span></td>
		<td class="row2"> 
		<input type="text" size="20" maxlength="255" name="smilies_path" value="{SMILIES_PATH}" class="post" />
		</td>
	</tr>
	<tr>
			<td class="row1">{L_ALLOW_NAME_CHANGE}</td>
			<td class="row2"><input type="radio" name="allow_namechange" value="1" {NAMECHANGE_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_namechange" value="0" {NAMECHANGE_NO} /> {L_NO}</td>
	</tr>
	<tr> 
		<td class="row1">{L_BLUECARD_LIMIT_2}<br /><span class="gensmall">{L_BLUECARD_LIMIT_2_EXPLAIN}</span></td> 
		<td class="row2"><input class="post" type="text" size="4" maxlength="4" name="bluecard_limit_2" value="{BLUECARD_LIMIT_2}" /></td> 
	</tr> 
	<tr> 
		<td class="row1">{L_BLUECARD_LIMIT}<br /><span class="gensmall">{L_BLUECARD_LIMIT_EXPLAIN}</span></td> 
		<td class="row2"><input class="post" type="text" size="4" maxlength="4" name="bluecard_limit" value="{BLUECARD_LIMIT}" /></td> 
	</tr> 
	<tr> 
		<td class="row1">{L_MAX_USER_BANCARD}<br /><span class="gensmall">{L_MAX_USER_BANCARD_EXPLAIN}</span></td> 
		<td class="row2"><input class="post" type="text" size="4" maxlength="4" name="max_user_bancard" value="{MAX_USER_BANCARD}" /></td> 
	</tr> 
	<tr> 
		<td class="row1">{L_REPORT_FORUM}<br /><span class="gensmall">{L_REPORT_FORUM_EXPLAIN}</span></td> 
		<td class="row2">{S_REPORT_FORUM}</td> 
	</tr>
	<!-- Start add - Fully integrated shoutbox MOD -->
	<tr> 
		<td class="row1">{L_PRUNE_SHOUTS}<br /><span class="gensmall">{L_PRUNE_SHOUTS_EXPLAIN}</span></td> 
		<td class="row2"><input type="text" size="6" maxlength="6" name="prune_shouts" value="{PRUNE_SHOUTS}" /></td> 
		</tr>
	<!-- End add - Fully integrated shoutbox MOD -->
	<!-- Start add - Signatures control MOD -->
	<tr>
		<th class="thHead" colspan="2">{L_SIG_SETTINGS}</th>
	</tr>

	<tr>
		<td class="row2" colspan="2"><span class="gensmall">{L_SIG_SETTINGS_EXPLAIN}</span></td>
	</tr>
	<!-- End add - Signatures control MOD -->
	<tr> 
		<td class="row1">{L_ALLOW_SIG}</td>
		<td class="row2"> 
		<input type="radio" name="allow_sig" value="1" {SIG_YES} />
		{L_YES}&nbsp;&nbsp; 
		<input type="radio" name="allow_sig" value="0" {SIG_NO} />
		{L_NO}</td>
	</tr>
	<tr> 
		<td class="row1">{L_MAX_SIG_LENGTH}<br />
		<span class="gensmall">{L_MAX_SIG_LENGTH_EXPLAIN}</span></td>
		<td class="row2"> 
		<input type="text" size="5" maxlength="4" name="max_sig_chars" value="{SIG_SIZE}" class="post" />
		</td>
	</tr>
	<!-- Start replacement - Signatures control MOD -->
	<tr>
		<td class="row1">{L_SIG_MAX_LINES}</td>
		<td class="row2"><input type="text" name="sig_max_lines" value="{SIG_MAX_LINES}" maxlength="2" size="3" class="post" /></td>
	</tr>
	<tr>
		<td class="row1">{L_SIG_WORDWRAP}</td>
		<td class="row2"><input type="text" name="sig_wordwrap" value="{SIG_WORDWRAP}" maxlength="3" size="3" class="post" /></td>
	</tr>
	<tr> 
		<td class="row1">{L_SIG_ALLOW_FONT_SIZES}</td>
		<td class="row2"><input type="radio" name="sig_allow_font_sizes" value="1" {SIG_ALLOW_FONT_SIZES_YES} /> {L_SIG_ALLOW_FONT_SIZES_YES}&nbsp; &nbsp;<input type="radio" name="sig_allow_font_sizes" value="2" {SIG_ALLOW_FONT_SIZES_MAX} /> {L_SIG_ALLOW_FONT_SIZES_MAX}&nbsp; &nbsp;<input type="radio" name="sig_allow_font_sizes" value="0" {SIG_ALLOW_FONT_SIZES_IMPOSED} /> {L_SIG_ALLOW_FONT_SIZES_IMPOSED}</td>
	</tr>
	<tr>
		<td class="row1">{L_SIG_FONT_SIZE_LIMIT}<br /><span class="gensmall">{L_SIG_FONT_SIZE_LIMIT_EXPLAIN}</td>
		<td class="row2"><input type="text" name="sig_min_font_size" value="{SIG_MIN_FONT_SIZE}" maxlength="2" size="3" class="post" /> {L_SIG_MIN_FONT_SIZE} <input type="text" name="sig_max_font_size" value="{SIG_MAX_FONT_SIZE}" maxlength="2" size="3" class="post" /> {L_SIG_MAX_FONT_SIZE}</td>
	</tr>
	<tr>
		<td class="row1">{L_SIG_TEXT_ENHANCEMENT}</td>
		<td class="row2"><input style="text-indent: 0px" type="checkbox" name="sig_allow_bold" value="1" {SIG_ALLOW_BOLD_YES}> {L_SIG_ALLOW_BOLD}<br />
			 <input type="checkbox" name="sig_allow_italic" value="1" {SIG_ALLOW_ITALIC_YES}> {L_SIG_ALLOW_ITALIC}<br />
			 <input type="checkbox" name="sig_allow_underline" value="1" {SIG_ALLOW_UNDERLINE_YES}> {L_SIG_ALLOW_UNDERLINE}<br />
			 <input type="checkbox" name="sig_allow_colors" value="1" {SIG_ALLOW_COLORS_YES}> {L_SIG_ALLOW_COLORS}</td>
	</tr>
	<tr>
		<td class="row1">{L_SIG_TEXT_PRESENTATION}</td>
		<td class="row2"><input style="text-indent: 0px" type="checkbox" name="sig_allow_quote" value="1" {SIG_ALLOW_QUOTE_YES} /> {L_SIG_ALLOW_QUOTE}<br />
			 <input type="checkbox" name="sig_allow_code" value="1" {SIG_ALLOW_CODE_YES} /> {L_SIG_ALLOW_CODE}<br />
			 <input type="checkbox" name="sig_allow_list" value="1" {SIG_ALLOW_LIST_YES} /> {L_SIG_ALLOW_LIST}</td>
	</tr>
	<tr>
		<td class="row1">{L_SIG_ALLOW_URL}</td>
		<td class="row2"><input type="radio" name="sig_allow_url" value="1" {SIG_ALLOW_URL_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="sig_allow_url" value="0" {SIG_ALLOW_URL_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_SIG_ALLOW_IMAGES}</td>
		<td class="row2"><input type="radio" name="sig_allow_images" value="1" {SIG_ALLOW_IMAGES_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="sig_allow_images" value="0" {SIG_ALLOW_IMAGES_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_SIG_MAX_IMAGES}</td>
		<td class="row2"><input type="text" name="sig_max_images" value="{SIG_MAX_IMAGES}" maxlength="2" size="3" class="post" /></td>
	</tr>
	<tr>
		<td class="row1">{L_SIG_MAX_IMG_SIZE}<br /><span class="gensmall">{L_SIG_MAX_IMG_SIZE_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="3" maxlength="4" name="sig_max_img_height" value="{SIG_MAX_IMG_HEIGHT}" /> x <input class="post" type="text" size="3" maxlength="4" name="sig_max_img_width" value="{SIG_MAX_IMG_WIDTH}"> {L_SIG_IMG_SIZE_LEGEND}<br />
			 <input type="checkbox" name="sig_allow_on_max_img_size_fail" value="1" {SIG_ALLOW_ON_MAX_IMG_SIZE_FAIL_YES} /> {L_SIG_ALLOW_ON_MAX_IMG_SIZE_FAIL}</td>
	</tr>
	<tr>
		<td class="row1">{L_SIG_MAX_IMG_FILES_SIZE}</td>
		<td class="row2"><input type="text" name="sig_max_img_files_size" value="{SIG_MAX_IMG_FILES_SIZE}" maxlength="3" size="3" class="post" /> {L_SIG_KBYTES}</td>
	</tr>
	<tr>
		<td class="row1">{L_SIG_MAX_IMG_AV_FILES_SIZE}<br /><span class="gensmall">{L_SIG_MAX_IMG_AV_FILES_SIZE_EXPLAIN}</span></td>
		<td class="row2"><input type="text" name="sig_max_img_av_files_size" value="{SIG_MAX_IMG_AV_FILES_SIZE}" maxlength="3" size="3" class="post" /> {L_SIG_KBYTES}</td>
	</tr>
	<tr>
		<td class="row1">{L_SIG_EXOTIC_BBCODES_DISALLOWED}<br /><span class="gensmall">{L_SIG_EXOTIC_BBCODES_DISALLOWED_EXPLAIN}</span></td>
		<td class="row2"><input type="text" name="sig_exotic_bbcodes_disallowed" value="{SIG_EXOTIC_BBCODES_DISALLOWED}" maxlength="255" size="40" class="post" /></td>
	</tr>
	<tr>
		<td class="row1">{L_SIG_ALLOW_SMILIES}</td>
		<td class="row2"><input type="radio" name="sig_allow_smilies" value="1" {SIG_ALLOW_SMILIES_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="sig_allow_smilies" value="0" {SIG_ALLOW_SMILIES_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_SIG_RESET}<br /><span class="gensmall">{L_SIG_RESET_EXPLAIN}</span></td>
		<td class="row2"><input type="button" name="sig_reset" value="{L_RESET}" class="liteoption" onClick="window.open('{U_SIG_RESET}', '_phpbbsig_reset', 'HEIGHT=155,resizable=no,WIDTH=350');return false;" /></td>
	<!-- End replacement - Signatures control MOD -->
	<tr>
		<td class="row1">{L_MAX_LINK_BOOKMARKS}<br /><span class="gensmall">{L_MAX_LINK_BOOKMARKS_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="4" maxlength="3" name="max_link_bookmarks" value="{LINK_BOOKMARKS}" /></td>
	</tr>
	<tr> 
		<th colspan="2">{L_AVATAR_SETTINGS}</th>
	</tr>
	<tr> 
		<td class="row1">{L_ALLOW_LOCAL}</td>
		<td class="row2"> 
		<input type="radio" name="allow_avatar_local" value="1" {AVATARS_LOCAL_YES} />
		{L_YES}&nbsp;&nbsp; 
		<input type="radio" name="allow_avatar_local" value="0" {AVATARS_LOCAL_NO} />
		{L_NO}</td>
	</tr>
	<tr> 
		<td class="row1">{L_ALLOW_REMOTE} <br />
		<span class="gensmall">{L_ALLOW_REMOTE_EXPLAIN}</span></td>
		<td class="row2"> 
		<input type="radio" name="allow_avatar_remote" value="1" {AVATARS_REMOTE_YES} />
		{L_YES}&nbsp;&nbsp; 
		<input type="radio" name="allow_avatar_remote" value="0" {AVATARS_REMOTE_NO} />
		{L_NO}</td>
	</tr>
	<tr> 
		<td class="row1">{L_ALLOW_UPLOAD}</td>
		<td class="row2"> 
		<input type="radio" name="allow_avatar_upload" value="1" {AVATARS_UPLOAD_YES} />
		{L_YES}&nbsp;&nbsp; 
		<input type="radio" name="allow_avatar_upload" value="0" {AVATARS_UPLOAD_NO} />
		{L_NO}</td>
	</tr>
	<tr> 
		<td class="row1">{L_MAX_FILESIZE}<br />
		<span class="gensmall">{L_MAX_FILESIZE_EXPLAIN}</span></td>
		<td class="row2"> 
		<input type="text" size="4" maxlength="10" name="avatar_filesize" value="{AVATAR_FILESIZE}" class="post" />
		Bytes</td>
	</tr>
	<tr> 
		<td class="row1">{L_MAX_AVATAR_SIZE} <br />
		<span class="gensmall">{L_MAX_AVATAR_SIZE_EXPLAIN}</span> </td>
		<td class="row2"> 
		<input type="text" size="3" maxlength="4" name="avatar_max_height" value="{AVATAR_MAX_HEIGHT}" class="post" />
		x 
		<input type="text" size="3" maxlength="4" name="avatar_max_width" value="{AVATAR_MAX_WIDTH}" class="post" />
		</td>
	</tr>
	<tr> 
		<td class="row1">{L_AVATAR_STORAGE_PATH} <br />
		<span class="gensmall">{L_AVATAR_STORAGE_PATH_EXPLAIN}</span></td>
		<td class="row2"> 
		<input type="text" size="20" maxlength="255" name="avatar_path" value="{AVATAR_PATH}" class="post" />
		</td>
	</tr>
	<tr> 
		<td class="row1">{L_AVATAR_GALLERY_PATH} <br />
		<span class="gensmall">{L_AVATAR_GALLERY_PATH_EXPLAIN}</span></td>
		<td class="row2"> 
		<input type="text" size="20" maxlength="255" name="avatar_gallery_path" value="{AVATAR_GALLERY_PATH}" class="post" />
		</td>
	</tr>
	<tr>
		<th class="thHead" colspan="2">{L_PHOTO_SETTINGS}</th>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_LOCAL_PHOTO}</td>
		<td class="row2"><input type="radio" name="allow_photo_local" value="1" {PHOTOS_LOCAL_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_photo_local" value="0" {PHOTOS_LOCAL_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_REMOTE_PHOTO} <br /><span class="gensmall">{L_ALLOW_REMOTE_PHOTO_EXPLAIN}</span></td>
		<td class="row2"><input type="radio" name="allow_photo_remote" value="1" {PHOTOS_REMOTE_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_photo_remote" value="0" {PHOTOS_REMOTE_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_UPLOAD_PHOTO}</td>
		<td class="row2"><input type="radio" name="allow_photo_upload" value="1" {PHOTOS_UPLOAD_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_photo_upload" value="0" {PHOTOS_UPLOAD_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_MAX_FILESIZE_PHOTO}<br /><span class="gensmall">{L_MAX_FILESIZE_PHOTO_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="4" maxlength="10" name="photo_filesize" value="{PHOTO_FILESIZE}" /> Bytes</td>
	</tr>
	<tr>
		<td class="row1">{L_MAX_PHOTO_SIZE} <br />
		<span class="gensmall">{L_MAX_PHOTO_SIZE_EXPLAIN}</span>
		</td>
		<td class="row2"><input class="post" type="text" size="3" maxlength="4" name="photo_max_height" value="{PHOTO_MAX_HEIGHT}" /> x <input class="post" type="text" size="3" maxlength="4" name="photo_max_width" value="{PHOTO_MAX_WIDTH}"></td>
	</tr>
	<tr>
		<td class="row1">{L_PHOTO_STORAGE_PATH} <br /><span class="gensmall">{L_PHOTO_STORAGE_PATH_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="20" maxlength="255" name="photo_path" value="{PHOTO_PATH}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_PHOTO_GALLERY_PATH} <br /><span class="gensmall">{L_PHOTO_GALLERY_PATH_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="20" maxlength="255" name="photo_gallery_path" value="{PHOTO_GALLERY_PATH}" /></td>
	</tr>
	<tr> 
		<th colspan="2">{L_COPPA_SETTINGS}</th>
	</tr>
	<tr> 
		<td class="row1">{L_COPPA_FAX}</td>
		<td class="row2"> 
		<input type="text" size="25" maxlength="100" name="coppa_fax" value="{COPPA_FAX}" class="post" />
		</td>
	</tr>
	<tr> 
		<td class="row1">{L_COPPA_MAIL}<br />
		<span class="gensmall">{L_COPPA_MAIL_EXPLAIN}</span></td>
		<td class="row2"> 
		<textarea name="coppa_mail" rows="5" cols="30" style="width: 300px" class="post">{COPPA_MAIL}</textarea>
		</td>
	</tr>
	<tr> 
		<th colspan="2">{L_EMAIL_SETTINGS}</th>
	</tr>
	<tr> 
		<td class="row1">{L_ADMIN_EMAIL}</td>
		<td class="row2"> 
		<input type="text" size="25" maxlength="100" name="board_email" value="{EMAIL_FROM}" class="post" />
		</td>
	</tr>
	<tr> 
		<td class="row1">{L_EMAIL_SIG}<br />
		<span class="gensmall">{L_EMAIL_SIG_EXPLAIN}</span></td>
		<td class="row2"> 
		<textarea name="board_email_sig" rows="5" cols="30" style="width: 300px" class="post">{EMAIL_SIG}</textarea>
		</td>
	</tr>
	<tr> 
		<td class="row1">{L_USE_SMTP}<br />
		<span class="gensmall">{L_USE_SMTP_EXPLAIN}</span></td>
		<td class="row2"> 
		<input type="radio" name="smtp_delivery" value="1" {SMTP_YES} />
		{L_YES}&nbsp;&nbsp; 
		<input type="radio" name="smtp_delivery" value="0" {SMTP_NO} />
		{L_NO}</td>
	</tr>
	<tr> 
		<td class="row1">{L_SMTP_SERVER}</td>
		<td class="row2"> 
		<input type="text" name="smtp_host" value="{SMTP_HOST}" size="25" maxlength="50" class="post" />
		</td>
	</tr>
	<tr> 
		<td class="row1">{L_SMTP_USERNAME}<br />
		<span class="gensmall">{L_SMTP_USERNAME_EXPLAIN}</span></td>
		<td class="row2"> 
		<input type="text" name="smtp_username" value="{SMTP_USERNAME}" size="25" maxlength="255" class="post" />
		</td>
	</tr>
	<tr> 
		<td class="row1">{L_SMTP_PASSWORD}<br />
		<span class="gensmall">{L_SMTP_PASSWORD_EXPLAIN}</span></td>
		<td class="row2"> 
		<input type="password" name="smtp_password" value="{SMTP_PASSWORD}" size="25" maxlength="255" class="post" />
		</td>
	</tr>
	<tr>
	  <th class="thHead" colspan="2">{L_LW_PAYPAL_SETTINGS}</th>
	</tr>
	<tr>
		<td class="row1">{L_LW_OUR_PAYPAL_ACCT}</td>
		<td class="row2"><input class="post" type="text" size="25" maxlength="255" name="paypal_p_acct" value="{LW_PAYPAL_P_ACCT}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_LW_PAYPAL_CURRENCY_CODE}</td>
		<td class="row2"><input class="post" type="text" size="25" maxlength="100" name="paypal_currency_code" value="{LW_PAYPAL_CURRENCY_CODE}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_LW_TRIAL_PERIOD}</td>
		<td class="row2"><input class="post" type="text" size="25" maxlength="100" name="lw_trial_period" value="{LW_TRIAL_PERIOD}" /></td>
	</tr>
	<tr>
	  <th class="thHead" colspan="2">{L_DONATION_SETTINGS}</th>
	</tr>
	<tr>
		<td class="row1">{L_LW_PERSONAL_PAYPAL_ACCT}<br /><span class="gensmall">{L_LW_PERSONAL_PAYPAL_ACCT_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="25" maxlength="255" name="paypal_p_acct" value="{LW_PERSONAL_PAYPAL_ACCT}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_LW_BUSINESS_PAYPAL_ACCT}<br /><span class="gensmall">{L_LW_BUSINESS_PAYPAL_ACCT_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="25" maxlength="255" name="paypal_b_acct" value="{LW_BUSINESS_PAYPAL_ACCT}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_LW_PAYPAL_CURRENCY_CODE}<br /><span class="gensmall">{L_LW_PAYPAL_CURRENCY_CODE_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="25" maxlength="100" name="paypal_currency_code" value="{LW_PAYPAL_CURRENCY_CODE}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_LW_DISPLAY_X_DONORS}<br /><span class="gensmall">{L_LW_DISPLAY_X_DONORS_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="25" maxlength="100" name="dislay_x_donors" value="{LW_DISPLAY_X_DONORS}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_LW_TOP_DONORS}<br /><span class="gensmall">{L_LW_TOP_DONORS_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="25" maxlength="100" name="list_top_donors" value="{LW_TOP_DONORS}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_LW_DONATION_DESCRIPTION}<br /><span class="gensmall">{L_LW_DONATION_DESCRIPTION_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="25" maxlength="100" name="donate_description" value="{LW_DONATION_DESCRIPTION}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_LW_DONATION_GOAL}<br /><span class="gensmall">{L_LW_DONATION_GOAL_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="25" maxlength="100" name="donate_cur_goal" value="{LW_DONATION_GOAL}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_LW_DONATION_START}<br /><span class="gensmall">{L_LW_DONATION_START_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="25" maxlength="100" name="donate_start_time" value="{LW_DONATION_START}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_LW_DONATION_END}<br /><span class="gensmall">{L_LW_DONATION_END_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="25" maxlength="100" name="donate_end_time" value="{LW_DONATION_END}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_LW_DONATION_POINTS}<br /><span class="gensmall">{L_LW_DONATION_POINTS_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="25" maxlength="100" name="donate_to_points" value="{LW_DONATION_POINTS}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_LW_POSTS_COUNTS}<br /><span class="gensmall">{L_LW_POSTS_COUNTS_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="25" maxlength="100" name="donate_to_posts" value="{LW_POSTS_COUNTS}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_LW_DONATE_TOGRP_ONE}<br /><span class="gensmall">{L_LW_DONATE_TOGRP_ONE_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="25" maxlength="100" name="donate_to_grp_one" value="{LW_DONATE_TOGRP_ONE}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_LW_TOGRPONE_AMOUNT}<br /><span class="gensmall">{L_LW_TOGRPONE_AMOUNT_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="25" maxlength="100" name="to_grp_one_amount" value="{LW_TOGRPONE_AMOUNT}" /></td>
	</tr>

	<tr>
		<td class="row1">{L_LW_DONATE_TOGRP_TWO}<br /><span class="gensmall">{L_LW_DONATE_TOGRP_TWO_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="25" maxlength="100" name="donate_to_grp_two" value="{LW_DONATE_TOGRP_TWO}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_LW_TOGRPTWO_AMOUNT}<br /><span class="gensmall">{L_LW_TOGRPTWO_AMOUNT_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="25" maxlength="100" name="to_grp_two_amount" value="{LW_TOGRPTWO_AMOUNT}" /></td>
	</tr>

	<tr>
		<td class="row1">{L_LW_TORANK_ID}<br /><span class="gensmall">{L_LW_TORANK_ID_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" size="25" maxlength="100" name="donor_rank_id" value="{LW_TORANK_ID}" /></td>
	</tr>
	<tr> 
		<td class="cat" colspan="2" align="center">{S_HIDDEN_FIELDS} 
		<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />
		&nbsp;&nbsp; 
		<input type="reset" value="{L_RESET}" class="button" />
		</td>
	</tr>
</table>
</form>
<br clear="all" />