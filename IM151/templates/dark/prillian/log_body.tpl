<script language="JavaScript" type="text/javascript">
<!--
// Used to check or uncheck a list of check boxes
function select_switch(status)
{
	for (i = 0; i < document.newmsg_list.length; i++)
	{
		document.newmsg_list.elements[i].checked = status;
	}
}
//-->
</script>
<div class="prill_widelogo">
<!-- BEGIN switch_controls_images -->
	<div class="prill_widectrlimg">
		<a href="{U_SEND_IM}" target="newmessage" onClick="javascript:opener.new_message('{U_SEND_IM}'); return false"><img src="{IMG_MESSAGE}" border="0" alt="{L_ALT_MESSAGE}" width="19" height="15" /></a>
		<a href="{U_CONTACT_MAN}" target="phpbbmain"><img src="{IMG_CONTACT}" border="0" alt="{L_ALT_CONTACT}" width="19" height="15" /></a>
		<a href="{U_INDEX}" target="phpbbmain"><img src="{IMG_HOME}" border="0" alt="{L_ALT_HOME}" width="16" height="15" /></a>
		<a href="javascript:opener.kill_spawn()"><img src="{IMG_CLOSE_WINDOWS}" border="0" alt="{L_ALT_CLOSE_WINDOWS}" width="19" height="15" /></a>
		<a href="{U_LOGIN_LOGOUT}" target="phpbbmain" onClick="javascript:opener.shut_down('{U_LOGIN_LOGOUT}')"><img src="{IMG_LOGOUT}" border="0" alt="{L_ALT_LOGOUT}" width="16" height="15" /></a>
		<a href="{U_HELP}" target="phpbbmain"><img src="{IMG_HELP}" border="0" alt="{L_ALT_HELP}" width="17" height="15" /></a>
	</div>
<!-- END switch_controls_images -->

	<a href="http://www.phpbbsmith.com/" target="_blank"><!--img src="{IMG_LOGO}" border="0" alt="{L_PRILLIAN}" width="145" height="24" vspace="3" /-->PRILLIAN</a>
</div>

<form name="newmsg_list" method="post" action="{S_FORM_ACTION}">
	<table width="98%" cellpadding="2" cellspacing="1" border="0" class="forumline">
		<tr>
			<td class="bodyline" width="15%"><a href="{U_RECEIVED}" class="nav">{L_RECEIVED}</a></td>
			<td class="bodyline" width="15%"><a href="{U_SENT}" class="nav">{L_SENT}</a></td>
			<td class="bodyline" width="30%"><a href="{U_OFF_RECEIVED}" class="nav">{L_OFF_RECEIVED}</a></td>
<!--
			<td class="bodyline" width="25%"><a href="{U_OFF_SENT}" class="nav">{L_OFF_SENT}</a></td>
-->
			<td class="row3" align="right">&nbsp;</td>
		</tr>
	</table>

<table width="98%" cellpadding="2" cellspacing="1" border="0" class="forumline">
	<tr>
		<th colspan="5" class="thTop" height="25" nowrap="nowrap">{MESSAGES}</th>
	</tr>
<!-- BEGIN switch_msg_list -->
	<tr>
		<td class="row2" align="center" valign="middle"><span class="genmed">{switch_msg_list.L_SUBJECT}</span></td>
		<td class="row2" align="center" valign="middle"><span class="genmed">{switch_msg_list.L_FROM}</span></td>
		<td class="row2" align="center" valign="middle"><span class="genmed">{switch_msg_list.L_TO}</span></td>
		<td class="row2" align="center" valign="middle"><span class="genmed">{switch_msg_list.L_DATE}</span></td>
		<td class="row2" align="center" valign="middle"><span class="genmed">{switch_msg_list.L_DELETE}</span></td>
	</tr>
<!-- BEGIN switch_msg_row -->
	<tr>
		<td class="{switch_msg_list.switch_msg_row.ROW_CLASS}" valign="middle"><span class="genmed"><a href="{switch_msg_list.switch_msg_row.U_IMMSGS}" target="read[{switch_msg_list.switch_msg_row.IMNUM}]" onClick="javascript:opener.launch_spawn('{switch_msg_list.switch_msg_row.U_IMMSGS}', '{switch_msg_list.switch_msg_row.LEFT_PX}', '{switch_msg_list.switch_msg_row.TOP_PX}', '{READ_WIDTH}', '{READ_HEIGHT}'); return false" title="{switch_msg_list.switch_msg_row.SUBJECT}">{switch_msg_list.switch_msg_row.SUBJECT}</a></span></td>
		<td class="{switch_msg_list.switch_msg_row.ROW_CLASS}" align="center" valign="middle"><span class="genmed"><a href="{switch_msg_list.switch_msg_row.U_SENDER}" target="phpbbmain" title="{switch_msg_list.switch_msg_row.SENDER}">{switch_msg_list.switch_msg_row.SENDER}</a></span></td>
		<td class="{switch_msg_list.switch_msg_row.ROW_CLASS}" align="center" valign="middle"><span class="genmed"><a href="{switch_msg_list.switch_msg_row.U_RECEIVER}" target="phpbbmain" title="{switch_msg_list.switch_msg_row.RECEIVER}">{switch_msg_list.switch_msg_row.RECEIVER}</a></span></td>
		<td class="{switch_msg_list.switch_msg_row.ROW_CLASS}" align="center" valign="middle"><span class="genmed">{switch_msg_list.switch_msg_row.DATE}</span></td>
		<td class="{switch_msg_list.switch_msg_row.ROW_CLASS}" align="center" valign="middle"><span class="genmed">
			<input type="checkbox" name="mark[]" value="{switch_msg_list.switch_msg_row.S_MARK_ID}"></span>
		</td>
	</tr>
<!-- END switch_msg_row -->
	<tr>
		<td class="catbottom" colspan="5" align="center" valign="middle"><span class="genmed">{switch_msg_list.S_HIDDEN_FIELDS}<a href="javascript:select_switch(true);">{switch_msg_list.L_MARK_ALL}</a> <a href="javascript:select_switch(false);">{switch_msg_list.L_UNMARK_ALL}</a> <input type="submit" name="delete" value="{switch_msg_list.L_DELETE}" class="liteoption"></span></td>
	</tr>
<!-- END switch_msg_list -->
<!-- BEGIN switch_no_msg -->
	<tr>
		<td class="row2" colspan="5" align="center" valign="middle"><span class="genmed">{switch_no_msg.NO_MSG}</span></td>
	</tr>
<!-- END switch_no_msg -->
</table>
</form>

<table width="100%" cellspacing="0" cellpadding="0" border="0">
	<tr>
		<td><span class="nav">{PAGE_NUMBER}</span></td>
		<td align="right"><span class="nav">{PAGINATION}</span></td>
	</tr>
</table>
<br />

<!-- BEGIN switch_controls_text -->
<table width="98%" cellpadding="2" cellspacing="1" border="0" class="forumline">
	<tr>
		<th colspan="2" class="thTop" height="25" nowrap="nowrap">{L_CONTROLS}</th>
	</tr>
	<tr>
		<td class="row1" valign="middle" width="50%"><span class="genmed"><a href="{U_LOGIN_LOGOUT}" target="phpbbmain" onClick="javascript:opener.shut_down('{U_LOGIN_LOGOUT}')">{L_LOGOUT}</a></span></td>
		<td class="row1" valign="middle"><span class="genmed"><a href="javascript:opener.kill_spawn()">{L_CLOSE_WINDOWS}</a></span></td>
	</tr>
	<tr>
		<td class="row1" valign="middle" width="50%"><span class="genmed"><a href="{U_SEND_IM}" target="newmessage" onClick="javascript:opener.new_message('{U_SEND_IM}'); return false">{L_SEND_IM}</a></span></td>
		<td class="row1" valign="middle" width="50%"><span class="genmed"><a href="{U_CONTACT_MAN}" target="phpbbmain">{L_CONTACT_MAN}</a></span></td>
	</tr>
	<tr>
		<td class="row1" colspan="2" valign="middle" width="50%"><span class="genmed"><a href="{U_HELP}" target="phpbbmain">{L_ALT_HELP}</a></span></td>
	</tr>
	<tr>
		<td colspan="2" class="row1" valign="middle" width="50%"><span class="genmed"><a href="{U_INDEX}" target="phpbbmain">{SITENAME}</a></span></td>
	</tr>
</table>
<!-- END switch_controls_text -->