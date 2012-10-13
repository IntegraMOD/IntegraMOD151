
<h1>{L_CONFIGURATION_TITLE}</h1>

<p>{L_CONFIGURATION_EXPLAIN}</p>

<form action="{S_CONFIG_ACTION}" method="post"><table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">	
	<tr>
	  <th class="thHead" colspan="3">{L_PRILLIAN} {PRILLIAN_VERSION}</th>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_IMS}</td>
		<td class="row2" width="35%" colspan="2"><input type="radio" name="allow_ims" value="1" {ALLOW_IMS_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_ims" value="0" {ALLOW_IMS_NO} /> {L_NO}</td>
<input type="hidden" name="allow_shout" value="1" />
<input type="hidden" name="allow_chat" value="1" />
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_NETWORK}</td>
		<td class="row2" colspan="2"><input type="radio" name="allow_network" value="1" {ALLOW_NETWORK_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_network" value="0" {ALLOW_NETWORK_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_NETWORK_PROFILE}<br /><span class="gensmall">{L_NETWORK_PROFILE_EXPLAIN}</span></td>
		<td class="row2" colspan="2"><input class="post" type="text" size="20" maxlength="255" name="network_profile" value="{NETWORK_PROFILE}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_OPEN_PMS}</td>
		<td class="row2" colspan="2"><input type="radio" name="open_pms" value="1" {OPEN_PMS_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="open_pms" value="0" {OPEN_PMS_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_ENABLE_FLOOD}</td>
		<td class="row2" colspan="2"><input type="radio" name="enable_flood" value="1" {ENABLE_FLOOD_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="enable_flood" value="0" {ENABLE_FLOOD_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_FLOOD_INTERVAL}<br /><span class="gensmall">{L_FLOOD_INTERVAL_EXPLAIN}</span></td>
		<td class="row2" colspan="2"><input class="post" type="text" size="3" maxlength="4" name="flood_interval" value="{FLOOD_INTERVAL}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_AUTO_DEL}</td>
		<td class="row2" colspan="2"><input type="radio" name="auto_delete" value="1" {AUTO_DELETE_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="auto_delete" value="0" {AUTO_DELETE_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_ENABLE_LIMIT}</td>
		<td class="row2" colspan="2"><input type="radio" name="enable_im_limit" value="1" {ENABLE_IM_LIMIT_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="enable_im_limit" value="0" {ENABLE_IM_LIMIT_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_BOX_LIMIT}<br /></td>
		<td class="row2" colspan="2"><input class="post" type="text" size="4" maxlength="4" name="box_limit" value="{BOX_LIMIT}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_OVERRIDE_USERS}<br /><span class="gensmall">{L_OVERRIDE_USERS_EXPLAIN}</span></td>
		<td class="row2" colspan="2"><input type="radio" name="override_users" value="1" {OVERRIDE_USERS_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="override_users" value="0" {OVERRIDE_USERS_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_REFRESH_DROP}</td>
		<td class="row2" colspan="2"><input type="radio" name="refresh_drop" value="1" {REFRESH_DROP_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="refresh_drop" value="0" {REFRESH_DROP_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_REFRESH_RATE}<br /><span class="gensmall">{L_REFRESH_RATE_EXPLAIN}</span></td>
		<td class="row2" colspan="2"><input class="post" type="text" size="5" maxlength="5" name="refresh_rate" value="{REFRESH_RATE}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_SESS_LEN}<br /><span class="gensmall">{L_SESS_LEN_EXPLAIN}</span></td>
		<td class="row2" colspan="2"><input class="post" type="text" size="5" maxlength="5" name="session_length" value="{SESSION_LENGTH}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_REFRESH_METHOD}<br /><span class="gensmall">{L_REFRESH_METHOD_EXPLAIN}</span></td>
		<td class="row2" colspan="2"><input type="radio" name="refresh_method" value="1" {REFRESH_METHOD_YES} /> {L_JAVASCRIPT}&nbsp;&nbsp;<input type="radio" name="refresh_method" value="0" {REFRESH_METHOD_NO} /> {L_META}<br /><input type="radio" name="refresh_method" value="2" {REFRESH_METHOD_BOTH} /> {L_BOTH}
		</td>
	</tr>
	<tr>
		<td class="row1">{L_USE_FRAMES}<br /><span class="gensmall">{L_USE_FRAMES_EXPLAIN}</span></td>
		<td class="row2" colspan="2"><input type="radio" name="use_frames" value="1" {USE_FRAMES_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="use_frames" value="0" {USE_FRAMES_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_DEFAULT_MODE}</td>
		<td class="row2" colspan="2">{DEFAULT_MODE_SELECT}</td>
	</tr>
	<tr>
		<td class="row1">{L_ALLOW_MODE_SWITCH}</td>
		<td class="row2" colspan="2"><input type="radio" name="allow_mode_switch" value="1" {ALLOW_MODE_SWITCH_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_mode_switch" value="0" {ALLOW_MODE_SWITCH_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_AUTO_LAUNCH}</td>
		<td class="row2" colspan="2"><input type="radio" name="auto_launch" value="1" {AUTO_LAUNCH_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="auto_launch" value="0" {AUTO_LAUNCH_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_POPUP_IMS}</td>
		<td class="row2" colspan="2"><input type="radio" name="popup_ims" value="1" {POPUP_IMS_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="popup_ims" value="0" {POPUP_IMS_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_LIST_IMS}</td>
		<td class="row2" colspan="2"><input type="radio" name="list_ims" value="1" {LIST_IMS_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="list_ims" value="0" {LIST_IMS_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_PLAY_SOUND}</td>
		<td class="row2" colspan="2"><input type="radio" name="play_sound" value="1" {PLAY_SOUND_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="play_sound" value="0" {PLAY_SOUND_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_SOUND_NAME}</td>
		<td class="row2" colspan="2"><input class="post" type="text" size="25" maxlength="100" name="sound_name" value="{SOUND_NAME}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_DEFAULT_SOUND}</td>
		<td class="row2" colspan="2"><input type="radio" name="default_sound" value="1" {DEFAULT_SOUND_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="default_sound" value="0" {DEFAULT_SOUND_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_STYLE_ALLOW}</td>
		<td class="row2" colspan="2"><input type="radio" name="themes_allow" value="1" {THEMES_ALLOW_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="themes_allow" value="0" {THEMES_ALLOW_NO} /> {L_NO}</td>
	</tr>
	<tr> 
		<td class="row1">{L_STYLE}</td>
		<td class="row2" colspan="2"><span class="gensmall">{STYLE_SELECT}</span></td>
	</tr>
	<tr>
		<td class="row1">{L_SUCCESS_CLOSE}</td>
		<td class="row2" colspan="2"><input type="radio" name="success_close" value="1" {SUCCESS_CLOSE_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="success_close" value="0" {SUCCESS_CLOSE_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_SHOW_CONTROLS}</td>
		<td class="row2" colspan="2">{SHOW_CONTROLS}</td>
	</tr>
	<tr>
		<td class="row1">{L_WHO_TO_LIST}</td>
		<td class="row2" colspan="2">{LIST_ALL_ONLINE}</td>
	</tr>
	<tr>
		<td class="row1">{L_NETWORK_USER_SELECT}</td>
		<td class="row2" colspan="2">{NETWORK_USER_SELECT}</td>
	</tr>

	<tr>
	  <th class="thHead" colspan="3">{L_SET_WINDOW_SIZES}</th>
	</tr>
	<tr>
		<td class="row1" colspan="3">
			<span class="gensmall">{L_SET_WINDOW_SIZES_EXPLAIN}</span>
		</td>
	</tr>
	<tr>
		<td class="row2" align="center">
			&nbsp;
		</td>
		<td class="row2" align="center">
			<span class="genmed">{L_WIDTH}:</span>
		</td>
		<td class="row2" align="center">
			<span class="genmed">{L_HEIGHT}:</span>
		</td>
	</tr>
	<tr>
		<td class="row1" align="center">
			<span class="genmed">{L_MAIN_WINDOW}:</span>
		</td>
		<td class="row2" align="center">
			<input type="text" size="4" maxlength="4" name="mode1_width" value="{MODE1_WIDTH}" /> <span class="gensmall">
		</td>
		<td class="row2" align="center">
			<input type="text" size="4" maxlength="4" name="mode1_height" value="{MODE1_HEIGHT}" />
		</td>
	</tr>

	<tr>
		<td class="row1" align="center">
			<span class="genmed">{L_WIDE_WINDOW}:</span>
		</td>
		<td class="row2" align="center">
			<input type="text" size="4" maxlength="4" name="mode2_width" value="{MODE2_WIDTH}" /> <span class="gensmall">
		</td>
		<td class="row2" align="center">
			<input type="text" size="4" maxlength="4" name="mode2_height" value="{MODE2_HEIGHT}" />
		</td>
	</tr>
	<tr>
		<td class="row1" align="center">
			<span class="genmed">{L_MINI_WINDOW}:</span>
		</td>
		<td class="row2" align="center">
			<input type="text" size="4" maxlength="4" name="mode3_width" value="{MODE3_WIDTH}" /> <span class="gensmall">
		</td>
		<td class="row2" align="center">
			<input type="text" size="4" maxlength="4" name="mode3_height" value="{MODE3_HEIGHT}" />
		</td>
	</tr>
	<tr>
		<td class="row1" align="center">
			<span class="genmed">{L_PREFS}:</span>
		</td>
		<td class="row2" align="center">
			<input type="text" size="4" maxlength="4" name="prefs_width" value="{PREFS_WIDTH}" /> <span class="gensmall">
		</td>
		<td class="row2" align="center">
			<input type="text" size="4" maxlength="4" name="prefs_height" value="{PREFS_HEIGHT}" />
		</td>
	</tr>

	<tr>
		<td class="row1" align="center">
			<span class="genmed">{L_READ_WINDOW}:</span>
		</td>
		<td class="row2" align="center">
			<input type="text" size="4" maxlength="4" name="read_width" value="{READ_WIDTH}" /> <span class="gensmall">
		</td>
		<td class="row2" align="center">
			<input type="text" size="4" maxlength="4" name="read_height" value="{READ_HEIGHT}" />
		</td>
	</tr>

	<tr>
		<td class="row1" align="center">
			<span class="genmed">{L_SEND_WINDOW}:</span>
		</td>
		<td class="row2" align="center">
			<input type="text" size="4" maxlength="4" name="send_width" value="{SEND_WIDTH}" /> <span class="gensmall">
		</td>
		<td class="row2" align="center">
			<input type="text" size="4" maxlength="4" name="send_height" value="{SEND_HEIGHT}" />
		</td>
	</tr>
	
	<tr>
		<td class="catBottom" colspan="3" align="center">{S_HIDDEN_FIELDS}<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" class="liteoption" />
		</td>
	</tr>
</table></form>

<br clear="all" />