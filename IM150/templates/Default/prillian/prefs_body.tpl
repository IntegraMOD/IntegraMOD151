<div class="prill_widelogo">
<!-- BEGIN switch_controls_images -->
	<div class="prill_widectrlimg">
		<a href="{U_RELOAD}" target="prillian"><img src="{IMG_REFRESH}" border="0" alt="{L_ALT_REFRESH}" title="{L_ALT_REFRESH}" width="15" height="15" /></a>
		<a href="{U_CONTACT_MAN}" target="phpbbmain"><img src="{IMG_CONTACT}" border="0" alt="{L_ALT_CONTACT}" title="{L_ALT_CONTACT}" width="19" height="15" /></a>
		<a href="{U_INDEX}" target="phpbbmain"><img src="{IMG_HOME}" border="0" alt="{L_ALT_HOME}" title="{L_ALT_HOME}" width="16" height="15" /></a>
		<a href="{U_LOGIN_LOGOUT}" target="phpbbmain" onClick="javascript:opener.shut_down('{U_LOGIN_LOGOUT}')"><img src="{IMG_LOGOUT}" title="{L_ALT_LOGOUT}" border="0" alt="{L_ALT_LOGOUT}" width="16" height="15" /></a>
		<a href="{U_HELP}" target="phpbbmain"><img src="{IMG_HELP}" border="0" alt="{L_ALT_HELP}" title="{L_ALT_HELP}" width="17" height="15" /></a>
	</div>
<!-- END switch_controls_images -->

	<a href="http://darkmods.sourceforge.net" target="_blank"><!--img src="{IMG_LOGO}" border="0" alt="{L_PRILLIAN}" width="145" height="24" vspace="3" /-->{L_PRILLIAN}</a>
</div>

{ERROR_BOX}

<form action="{S_PREFS_ACTION}" method="post">
<div class="prill_header">
	{L_PRILLIAN} {L_PREFS}
</div>
<script language="JavaScript" type="text/javascript"> DrawTabs(); </script>

<div class="tabbodyholder">
&nbsp;
	<div id="T11" class="tab-body">
	<table width="100%" cellpadding="4" cellspacing="1" border="0" align="center">
		<tr>
			<td class="row1">
				<span class="genmed">{L_ALLOW_IMS}:</span>
			</td>
		</tr>
		<tr>
			<td class="row2" align="right">
				<span class="genmed"><input type="radio" name="user_allow_ims" value="1" {ALLOW_IMS_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="user_allow_ims" value="0" {ALLOW_IMS_NO} /> {L_NO}</span>
	<input type="hidden" name="user_allow_shout" value="1" />
	<input type="hidden" name="user_allow_chat" value="1" />
			</td>
		</tr>

	<!-- BEGIN switch_network -->
		<tr>
			<td class="row1">
				<span class="genmed">{switch_network.L_ALLOW_NETWORK}:</span>
			</td>
		</tr>
		<tr>
			<td class="row2" align="right">
				<span class="genmed"><input type="radio" name="user_allow_network" value="1" {switch_network.ALLOW_NETWORK_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="user_allow_network" value="0" {switch_network.ALLOW_NETWORK_NO} /> {L_NO}</span>
			</td>
		</tr>
	<!-- END switch_network -->
		<tr>
			<td class="row1">
				<span class="genmed">{L_AUTO_DELETE}:</span>
			</td>
		</tr>
		<tr>
			<td class="row2" align="right">
				<span class="genmed"><input type="radio" name="auto_delete" value="1" {AUTO_DELETE_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="auto_delete" value="0" {AUTO_DELETE_NO} /> {L_NO}</span>
			</td>
		</tr>
		<tr>
			<td class="row1">
				<span class="genmed">{L_AUTO_LAUNCH}:</span>
			</td>
		</tr>
		<tr>
			<td class="row2" align="right">
				<span class="genmed"><input type="radio" name="auto_launch" value="1" {AUTO_LAUNCH_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="auto_launch" value="0" {AUTO_LAUNCH_NO} /> {L_NO}</span>
			</td>
		</tr>
	</table>
	</div>

	<div id="T12" class="tab-body">
	<table width="100%" cellpadding="4" cellspacing="1" border="0" align="center">

		<tr>
			<td class="row1">
				<span class="genmed">{L_POPUP_IMS}:</span>
			</td>
		</tr>
		<tr>
			<td class="row2" align="right">
				<span class="genmed"><input type="radio" name="popup_ims" value="1" {POPUP_IMS_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="popup_ims" value="0" {POPUP_IMS_NO} /> {L_NO}</span>
			</td>
		</tr>

		<tr>
			<td class="row1">
				<span class="genmed">{L_LIST_IMS}:</span>
			</td>
		</tr>
		<tr>
			<td class="row2" align="right">
				<span class="genmed"><input type="radio" name="list_ims" value="1" {LIST_IMS_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="list_ims" value="0" {LIST_IMS_NO} /> {L_NO}</span>
			</td>
		</tr>

		<tr>
			<td class="row1">
				<span class="genmed">{L_OPEN_PMS}:</span>
			</td>
		</tr>
		<tr>
			<td class="row2" align="right">
				<span class="genmed"><input type="radio" name="open_pms" value="1" {OPEN_PMS_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="open_pms" value="0" {OPEN_PMS_NO} /> {L_NO}</span>
			</td>
		</tr>

	</table>
	</div>

	<div id="T13" class="tab-body">
	<table width="100%" cellpadding="4" cellspacing="1" border="0" align="center">
		<tr>
			<td class="row1">
				<span class="genmed">{L_SUCCESS_CLOSE}:</span>
			</td>
		</tr>
		<tr>
			<td class="row2" align="right">
				<span class="genmed"><input type="radio" name="success_close" value="1" {SUCCESS_CLOSE_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="success_close" value="0" {SUCCESS_CLOSE_NO} /> {L_NO}</span>
			</td>
		</tr>

		<tr>
			<td class="row1">
				<span class="genmed">{L_ALWAYS_ADD_SIGNATURE}:</span><br />
				<span class="gensmall">{L_ALWAYS_ADD_SIGNATURE_EXPLAIN}</span>
			</td>
		</tr>
		<tr>
			<td class="row2" align="right">
				<span class="genmed"><input type="radio" name="attach_sig" value="1" {ALWAYS_ADD_SIGNATURE_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="attach_sig" value="0" {ALWAYS_ADD_SIGNATURE_NO} /> {L_NO}</span>
			</td>
		</tr>
	</table>
	</div>

	<div id="T14" class="tab-body">
	<table width="100%" cellpadding="4" cellspacing="1" border="0" align="center">

	<!-- BEGIN switch_style -->
		<tr>
			<td class="row1">
				<span class="genmed">{switch_style.L_IM_STYLE}:</span>
			</td>
		</tr>
		<tr>
			<td class="row2" align="right">
				{switch_style.STYLE_SELECT}
			</td>
		</tr>
	<!-- END switch_style -->


		<tr>
			<td class="row1">
				<span class="genmed">{L_SHOW_CONTROLS}:</span>
			</td>
		</tr>
		<tr>
			<td class="row2" align="right">
				{SHOW_CONTROLS}
			</td>
		</tr>
	</table>
	</div>

	<div id="T21" class="tab-body">
	<table width="100%" cellpadding="4" cellspacing="1" border="0" align="center">
		<tr>
			<td class="row1">
				<span class="genmed">{L_REFRESH_RATE}:</span><br />
				<span class="gensmall">{L_REFRESH_RATE_EXPLAIN}</span>
			</td>
		</tr>
		<tr>
			<td class="row2" align="right">
				{REFRESH_RATE}
			</td>
		</tr>

		<tr>
			<td class="row1">
				<span class="genmed">{L_REFRESH_METHOD}:</span><br />
				<span class="gensmall">{L_REFRESH_METHOD_EXPLAIN}</span>
			</td>
		</tr>
		<tr>
			<td class="row2" align="right">
				<span class="genmed"><input type="radio" name="refresh_method" value="1" {REFRESH_METHOD_YES} /> {L_JAVASCRIPT} <input type="radio" name="refresh_method" value="0" {REFRESH_METHOD_NO} /> {L_META} <input type="radio" name="refresh_method" value="2" {REFRESH_METHOD_BOTH} /> {L_BOTH}</span>
			</td>
		</tr>

		<tr>
			<td class="row1">
				<span class="genmed">{L_WHO_TO_LIST}:</span>
			</td>
		</tr>
		<tr>
			<td class="row2" align="right">
				{LIST_ALL_ONLINE}
			</td>
		</tr>

	<!-- BEGIN switch_networkusers -->
		<tr>
			<td class="row1">
				<span class="genmed">{switch_networkusers.L_NETWORK_USER_SELECT}:</span>
			</td>
		</tr>
		<tr>
			<td class="row2" align="right">
				{switch_networkusers.NETWORK_USER_SELECT}
			</td>
		</tr>
	<!-- END switch_networkusers -->

		<tr>
			<td class="row1">
				<span class="genmed">{L_USE_FRAMES}</span><br />
				<span class="gensmall">{L_USE_FRAMES_EXPLAIN}</span>
			</td>
		</tr>
		<tr>
			<td class="row2" align="right">
				<span class="genmed"><input type="radio" name="use_frames" value="1" {USE_FRAMES_YES} /> {L_YES} <input type="radio" name="use_frames" value="0" {USE_FRAMES_NO} /> {L_NO}</span>
			</td>
		</tr>
		<!-- BEGIN mode_switch -->
		<tr>
			<td class="row1">
				<span class="genmed">{L_DEFAULT_MODE}:</span>
			</td>
		</tr>
		<tr>
			<td class="row2" align="right">
				{DEFAULT_MODE_SELECT}
			</td>
		</tr>
		<!-- END mode_switch -->

	</table>
	</div>

	<div id="T22" class="tab-body">
	<table width="100%" cellpadding="4" cellspacing="1" border="0" align="center">
		<tr>
			<td class="row2" align="center">
				<span class="genmed">{L_SET_WINDOW_SIZES}:</span><br />
				<span class="gensmall">{L_SET_WINDOW_SIZES_EXPLAIN}</span>
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
				<input type="text" size="4" maxlength="4" name="mode1_width" value="{NORMAL_WIDTH}" /> <span class="gensmall">
			</td>
			<td class="row2" align="center">
				<input type="text" size="4" maxlength="4" name="mode1_height" value="{NORMAL_HEIGHT}" />
			</td>
		</tr>

		<tr>
			<td class="row1" align="center">
				<span class="genmed">{L_WIDE_WINDOW}:</span>
			</td>
			<td class="row2" align="center">
				<input type="text" size="4" maxlength="4" name="mode2_width" value="{WIDE_WIDTH}" /> <span class="gensmall">
			</td>
			<td class="row2" align="center">
				<input type="text" size="4" maxlength="4" name="mode2_height" value="{WIDE_HEIGHT}" />
			</td>
		</tr>

		<!-- tr>
			<td class="row1" align="center">
				<span class="genmed">{L_MINI_WINDOW}:</span>
			</td>
			<td class="row2" align="center">
				<input type="text" size="4" maxlength="4" name="mode3_width" value="{MINI_WIDTH}" /> <span class="gensmall">
			</td>
			<td class="row2" align="center">
				<input type="text" size="4" maxlength="4" name="mode3_height" value="{MINI_HEIGHT}" />
			</td>
		</tr -->

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
	</table>
	</div>

	<div id="T23" class="tab-body">
	<table width="100%" cellpadding="4" cellspacing="1" border="0" align="center">

		<tr>
			<td class="row1">
				<span class="genmed">{L_PLAY_SOUND}:</span>
			</td>
		</tr>
		<tr>
			<td class="row2" align="right">
				<span class="genmed"><input type="radio" name="play_sound" value="1" {PLAY_SOUND_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="play_sound" value="0" {PLAY_SOUND_NO} /> {L_NO}</span>
			</td>
		</tr>

		<tr>
			<td class="row1">
				<span class="genmed">{L_DEFAULT_SOUND}:</span>
			</td>
		</tr>
		<tr>
			<td class="row2" align="right">
				<span class="genmed"><input type="radio" name="default_sound" value="1" {DEFAULT_SOUND_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="default_sound" value="0" {DEFAULT_SOUND_NO} /> {L_NO}</span>
			</td>
		</tr>

		<tr>
			<td class="row1">
				<span class="genmed">{L_SOUND_NAME}:</span>
			</td>
		</tr>
		<tr>
			<td class="row2" align="right">
				<input type="hidden" name="current_sound_name" value="{SOUND_NAME}" />
				<span class="genmed">{L_CURRENT_SOUND}: {SOUND_NAME}<br />
				<input type="file" name="sound_name" /></span>
			</td>
		</tr>
	</table>
	</div>
	<div id="T24" class="tab-body">
	</div>
</div>

<div class="prill_catbottom">
	{S_HIDDEN_FIELDS}
	<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />
	<input type="reset" value="{L_RESET}" name="reset" class="liteoption" />
</div>
</form>

<!-- BEGIN switch_controls_text -->
<div class="prill_widefooter">
	&nbsp;
	<a href="{U_RELOAD}" target="prillian" class="genmed">{L_CHECK_IMS}</a> ::
	<a href="{U_CONTACT_MAN}" target="phpbbmain" class="genmed">{L_CONTACT_MAN}</a> ::
	<a href="{U_LOGIN_LOGOUT}" target="phpbbmain" onClick="javascript:opener.shut_down('{U_LOGIN_LOGOUT}')" class="genmed">{L_LOGOUT}</a> ::
	<a href="{U_HELP}" target="phpbbmain" class="genmed">{L_ALT_HELP}</a> ::
	<a href="{U_INDEX}" target="phpbbmain" class="genmed">{SITENAME}</a>
</div>
<!-- END switch_controls_text -->

