<script language="JavaScript" src="{U_IM_PATH}main.js"></script>
<div class="prill_mainlogo">
	<a href="http://www.phpbbsmith.com/" target="_blank"><!--img src="{IMG_LOGO}" border="0" alt="{L_PRILLIAN}" width="145" height="24" vspace="3" /-->{L_PRILLIAN}</a>
	
<!-- BEGIN switch_controls_images -->
	<div class="prill_mainctrlimg">
		<a href="{U_RELOAD}" target="prillmain"><img src="{IMG_REFRESH}" border="0" alt="{L_ALT_REFRESH}" title="{L_ALT_REFRESH}" width="15" height="15" /></a>

		<a href="{U_SEND_IM}" target="newmessage" onClick="javascript:parent.new_message('{U_SEND_IM}', '{SEND_WIDTH}', '{SEND_HEIGHT}'); return false"><img src="{IMG_MESSAGE}" border="0" alt="{L_ALT_MESSAGE}" title="{L_ALT_MESSAGE}" width="19" height="15" /></a>

		<a href="{U_CONTACT_MAN}" target="phpbbmain"><img src="{IMG_CONTACT}" border="0" alt="{L_ALT_CONTACT}" title="{L_ALT_CONTACT}" width="19" height="15" /></a>

		<a href="{U_INDEX}" target="phpbbmain"><img src="{IMG_HOME}" border="0" alt="{L_ALT_HOME}" title="{L_ALT_HOME}" width="16" height="15" /></a>

		<a href="javascript:parent.kill_spawn()"><img src="{IMG_CLOSE_WINDOWS}" border="0" alt="{L_ALT_CLOSE_WINDOWS}" title="{L_ALT_CLOSE_WINDOWS}" width="19" height="15" /></a>

		<a href="{U_MESSAGE_LOG}" target="prill_log" onclick="javascript:parent.open_log('{U_MESSAGE_LOG}'); return false"><img src="{IMG_MESSAGE_LOG}" title="{L_ALT_MESSAGE_LOG}" border="0" alt="{L_ALT_MESSAGE_LOG}" width="19" height="15" /></a>

	<!-- BEGIN switch_prefs -->
		<a href="{U_PREFS}" onClick="javascript:parent.open_prefs('{U_PREFS}', '{PREFS_WIDTH}', '{PREFS_HEIGHT}')" target="im_prefs"><img src="{IMG_PREFS}" border="0" alt="{L_ALT_PREFS}" title="{L_ALT_PREFS}" width="16" height="15" /></a>
	<!-- END switch_prefs -->

		<a href="{U_LOGIN_LOGOUT}" target="phpbbmain" onClick="javascript:parent.shut_down('{U_LOGIN_LOGOUT}')"><img src="{IMG_LOGOUT}" border="0" alt="{L_ALT_LOGOUT}" title="{L_ALT_LOGOUT}" width="16" height="15" /></a>

		<a href="{U_HELP}" target="phpbbmain"><img src="{IMG_HELP}" border="0" alt="{L_ALT_HELP}" title="{L_ALT_HELP}" width="17" height="15" /></a>
	</div>
	<!-- BEGIN switch_mode -->
	<div class="prill_mainctrlimg">
		<a href="{U_MODE1}" target="prillian" onClick="javascript:parent.mode_switch('{U_MODE1}', '{MODE1_HEIGHT}', '{MODE1_WIDTH}')"><!--img src="{IMG_MODE1}" border="0" alt="{L_ALT_MODE1}" title="-->{L_ALT_MODE1}<!--" width="17" height="15" /--></a>
		<a href="{U_MODE2}" target="prillian" onClick="javascript:parent.mode_switch('{U_MODE2}', '{MODE2_HEIGHT}', '{MODE2_WIDTH}')"><!--img src="{IMG_MODE2}" border="0" alt="{L_ALT_MODE2}" title="-->{L_ALT_MODE2}<!--" width="17" height="15" /--></a>
		<!--a href="{U_MODE3}" target="prillian" onClick="javascript:parent.mode_switch('{U_MODE3}', '{MODE3_HEIGHT}', '{MODE3_WIDTH}')"><img src="{IMG_MODE3}" border="0" alt="{L_ALT_MODE3}" title="{L_ALT_MODE3}" width="17" height="15" /--></a>
	</div>
	<!-- END switch_mode -->
<!-- END switch_controls_images -->
</div>
<!-- BEGIN switch_controls_text -->
<table width="98%" cellpadding="2" cellspacing="1" border="0" class="forumline">
	<tr>
		<th colspan="2" class="thTop" height="25" nowrap="nowrap">{L_CONTROLS}</th>
	</tr>
	<tr>
		<td class="row1" valign="middle" width="50%"><span class="genmed"><a href="{U_RELOAD}" target="prillmain">{L_CHECK_IMS}</a></span></td>
		<td class="row1" valign="middle" width="50%"><span class="genmed"><a href="{U_LOGIN_LOGOUT}" target="phpbbmain" onClick="javascript:parent.shut_down('{U_LOGIN_LOGOUT}')">{L_LOGOUT}</a></span></td>
	</tr>
	<tr>
		<td class="row1" valign="middle" width="50%"><span class="genmed"><a href="{U_MESSAGE_LOG}" target="phpbblog" onclick="javascript:parent.open_log('{U_MESSAGE_LOG}'); return false">{L_MESSAGE_LOG}</a></span></td>
		<td class="row1" valign="middle" width="50%"><span class="genmed"><a href="{U_HELP}" target="phpbbmain">{L_ALT_HELP}</a></span></td>
	</tr>
	<tr>
		<td class="row1" valign="middle" colspan="2"><span class="genmed"><a href="javascript:parent.kill_spawn()">{L_CLOSE_WINDOWS}</a></span></td>
	</tr>
	<tr>
		<td class="row1" colspan="2" valign="middle"><span class="genmed"><a href="{U_SEND_IM}" target="newmessage" onClick="javascript:parent.new_message('{U_SEND_IM}', '{SEND_WIDTH}', '{SEND_HEIGHT}'); return false">{L_SEND_IM}</a></span></td>
	</tr>
	<tr>
		<td class="row1" colspan="2" valign="middle"><span class="genmed"><a href="{U_CONTACT_MAN}" target="phpbbmain">{L_CONTACT_MAN}</a></span></td>
	</tr>
<!-- BEGIN switch_prefs -->
	<tr>
		<td class="row1" colspan="2" valign="middle"><span class="genmed"><a href="{U_PREFS}" onClick="javascript:parent.open_prefs('{U_PREFS}', '{PREFS_WIDTH}', '{PREFS_HEIGHT}')" target="im_prefs">{L_PREFS}</a></span></td>
	</tr>
<!-- END switch_prefs -->
	<tr>
		<td class="row1" colspan="2" valign="middle"><span class="genmed"><a href="{U_INDEX}" target="phpbbmain">{SITENAME}</a></span></td>
	</tr>
</table>
<!-- END switch_controls_text -->