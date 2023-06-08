
{ERROR_BOX}

<form action="{S_PREFS_ACTION}" method="post">
<table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
	<tr>
	  <th class="thHead" colspan="3">{L_PRILLIAN} {L_PREFS}</th>
	</tr>
	<tr>
		<td class="row1"><span class="gen">{L_ALLOW_IMS}:</span></td>
		<td class="row2" width="35%" colspan="2"><input type="radio" name="admin_allow_ims" value="1" {ALLOW_IMS_YES} /> <span class="gen">{L_YES}</span>&nbsp;&nbsp;<input type="radio" name="admin_allow_ims" value="0" {ALLOW_IMS_NO} /> <span class="gen">{L_NO}</span></td>
	</tr>
	<tr>
		<td class="row1"><span class="gen">{L_ALLOW_SHOUT}:</span></td>
		<td class="row2" colspan="2"><input type="radio" name="admin_allow_shout" value="1" {ALLOW_SHOUT_YES} /> <span class="gen">{L_YES}</span>&nbsp;&nbsp;<input type="radio" name="admin_allow_shout" value="0" {ALLOW_SHOUT_NO} /> <span class="gen">{L_NO}</span></td>
	</tr>
	<tr>
		<td class="row1"><span class="gen">{L_ALLOW_CHAT}:</span></td>
		<td class="row2" colspan="2"><input type="radio" name="admin_allow_chat" value="1" {ALLOW_CHAT_YES} /> <span class="gen">{L_YES}</span>&nbsp;&nbsp;<input type="radio" name="admin_allow_chat" value="0" {ALLOW_CHAT_NO} /> <span class="gen">{L_NO}</span></td>
	</tr>
	<tr>
		<td class="row1"><span class="gen">{L_ALLOW_NETWORK}:</span></td>
		<td class="row2" colspan="2"><input type="radio" name="admin_allow_network" value="1" {ALLOW_NETWORK_YES} /> <span class="gen">{L_YES}</span>&nbsp;&nbsp;<input type="radio" name="admin_allow_network" value="0" {ALLOW_NETWORK_NO} /> <span class="gen">{L_NO}</span></td>
	</tr>
	<tr> 
		<td class="row1"><span class="gen">{L_ALWAYS_ADD_SIGNATURE}:</span><br />
		<span class="gen"><em>{L_ALWAYS_ADD_SIGNATURE_EXPLAIN}</em></span></td>
		<td class="row2" colspan="2"> <input type="radio" name="attach_sig" value="1" {ALWAYS_ADD_SIGNATURE_YES} /> <span class="gen">{L_YES}</span>&nbsp;&nbsp;<input type="radio" name="attach_sig" value="0" {ALWAYS_ADD_SIGNATURE_NO} /> <span class="gen">{L_NO}</span></td>
	</tr>
	<tr>
		<td class="row1"><span class="gen">{L_REFRESH_RATE}:</span> <br /><span class="gen"><em>{L_REFRESH_RATE_EXPLAIN}</em></span></td>
		<td class="row2" colspan="2"><input type="text" size="5" maxlength="5" name="refresh_rate" value="{REFRESH_RATE}" /></span></td>
	</tr>
	<tr>
		<td class="row1"><span class="gen">{L_REFRESH_METHOD}:</span><br /><span class="gen"><em>{L_REFRESH_METHOD_EXPLAIN}</em></span></td>
		<td class="row2" colspan="2"><span class="gen"><input type="radio" name="refresh_method" value="1" {REFRESH_METHOD_YES} /> {L_JAVASCRIPT}&nbsp;&nbsp;<input type="radio" name="refresh_method" value="0" {REFRESH_METHOD_NO} /> {L_META}<br /><input type="radio" name="refresh_method" value="2" {REFRESH_METHOD_BOTH} /> {L_BOTH}
		</span></td>
	</tr>
	<tr>
		<td class="row1"><span class="gen">{L_AUTO_LAUNCH}:</span></td>
		<td class="row2" colspan="2"><input type="radio" name="auto_launch" value="1" {AUTO_LAUNCH_YES} /> <span class="gen">{L_YES}</span>&nbsp;&nbsp;<input type="radio" name="auto_launch" value="0" {AUTO_LAUNCH_NO} /> <span class="gen">{L_NO}</span></td>
	</tr>
	<tr>
		<td class="row1"><span class="gen">{L_POPUP_IMS}:</span></td>
		<td class="row2" colspan="2"><input type="radio" name="popup_ims" value="1" {POPUP_IMS_YES} /> <span class="gen">{L_YES}</span>&nbsp;&nbsp;<input type="radio" name="popup_ims" value="0" {POPUP_IMS_NO} /> <span class="gen">{L_NO}</span></td>
	</tr>
	<tr>
		<td class="row1"><span class="gen">{L_LIST_IMS}:</span></td>
		<td class="row2" colspan="2"><input type="radio" name="list_ims" value="1" {LIST_IMS_YES} /> <span class="gen">{L_YES}</span>&nbsp;&nbsp;<input type="radio" name="list_ims" value="0" {LIST_IMS_NO} /> <span class="gen">{L_NO}</span></td>
	</tr>
	<tr>
		<td class="row1"><span class="gen">{L_OPEN_PMS}:</span></td>
		<td class="row2" colspan="2"><input type="radio" name="open_pms" value="1" {OPEN_PMS_YES} /> <span class="gen">{L_YES}</span>&nbsp;&nbsp;<input type="radio" name="open_pms" value="0" {OPEN_PMS_NO} /> <span class="gen">{L_NO}</span></td>
	</tr>
	<tr>
		<td class="row1"><span class="gen">{L_AUTO_DELETE}:</span></td>
		<td class="row2" colspan="2"><input type="radio" name="auto_delete" value="1" {AUTO_DELETE_YES} /> <span class="gen">{L_YES}</span>&nbsp;&nbsp;<input type="radio" name="auto_delete" value="0" {AUTO_DELETE_NO} /> <span class="gen">{L_NO}</span></td>
	</tr>
	<tr>
		<td class="row1"><span class="gen">{L_USE_FRAMES}:</span><br />
			<span class="gensmall">{L_USE_FRAMES_EXPLAIN}</span></td>
		<td class="row2" colspan="2"><input type="radio" name="use_frames" value="1" {USE_FRAMES_YES} /> <span class="gen">{L_YES}</span>&nbsp;&nbsp;<input type="radio" name="use_frames" value="0" {USE_FRAMES_NO} /> <span class="gen">{L_NO}</span></td>
	</tr>
	<tr>
		<td class="row1"><span class="gen">{L_DEFAULT_MODE}:</span></td>
		<td class="row2" colspan="2">{DEFAULT_MODE_SELECT}</td>
	</tr>
	<tr>
		<td class="row1"><span class="gen">{L_PLAY_SOUND}:</span></td>
		<td class="row2" colspan="2"><input type="radio" name="play_sound" value="1" {PLAY_SOUND_YES} /> <span class="gen">{L_YES}</span>&nbsp;&nbsp;<input type="radio" name="play_sound" value="0" {PLAY_SOUND_NO} /> <span class="gen">{L_NO}</span></td>
	</tr>
	<tr>
		<td class="row1"><span class="gen">{L_DEFAULT_SOUND}:</span></td>
		<td class="row2" colspan="2"><input type="radio" name="default_sound" value="1" {DEFAULT_SOUND_YES} /> <span class="gen">{L_YES}</span>&nbsp;&nbsp;<input type="radio" name="default_sound" value="0" {DEFAULT_SOUND_NO} /> <span class="gen">{L_NO}</span></td>
	</tr>
	<tr>
		<td class="row1"><span class="gen">{L_SOUND_NAME}:</span></td>
		<td class="row2" colspan="2"><input type="hidden" name="current_sound_name" value="{SOUND_NAME}" /><span class="gen">{L_CURRENT_SOUND}: {SOUND_NAME}</span><br /><input type="file" name="sound_name" /></td>
	</tr>
	<tr> 
		<td class="row1"><span class="gen">{L_IM_STYLE}:</span></td>
		<td class="row2" colspan="2"><span class="gen">{STYLE_SELECT}</span></td>
	</tr>
	<tr>
		<td class="row1"><span class="gen">{L_SUCCESS_CLOSE}:</span></td>
		<td class="row2" colspan="2"><input type="radio" name="success_close" value="1" {SUCCESS_CLOSE_YES} /> <span class="gen">{L_YES}</span>&nbsp;&nbsp;<input type="radio" name="success_close" value="0" {SUCCESS_CLOSE_NO} /> <span class="gen">{L_NO}</span></td>
	</tr>
	<tr>
		<td class="row1"><span class="gen">{L_SHOW_CONTROLS}:</span></td>
		<td class="row2" colspan="2">{SHOW_CONTROLS}</td>
	</tr>
	<tr>
		<td class="row1"><span class="gen">{L_WHO_TO_LIST}:</span></td>
		<td class="row2" colspan="2">{LIST_ALL_ONLINE}</td>
	</tr>

	<tr>
		<td class="row1"><span class="gen">{L_NETWORK_USER_SELECT}:</span></td>
		<td class="row2" colspan="2">{NETWORK_USER_SELECT}</td>
	</tr>

	<tr>
		<td class="row1" colspan="3" align="center">
			<span class="genmed">{L_SET_WINDOW_SIZES}:</span><br />
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
		<td class="catBottom" colspan="3" align="center" height="28">{S_HIDDEN_FIELDS}<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" name="reset" class="liteoption" /></td>
	</tr>
</table></form>

<br clear="all" />