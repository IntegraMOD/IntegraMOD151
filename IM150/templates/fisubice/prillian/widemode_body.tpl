<script language="JavaScript" type="text/javascript">
<!--
<!-- BEGIN switch_im_popups -->
	parent.launch_spawn('{switch_im_popups.U_IMMSGS_POPUP}', '{switch_im_popups.LEFT_PX}', '{switch_im_popups.TOP_PX}', '{READ_WIDTH}', '{READ_HEIGHT}');
<!-- END switch_im_popups -->
//-->
</script>
<!-- BEGIN switch_newmsg_list -->
<form name="newmsg_list" method="post" action="{switch_newmsg_list.S_FORM_ACTION}">
{switch_newmsg_list.S_HIDDEN_FIELDS}
<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
	<tr>
		<th colspan="3" class="thTop" height="25" nowrap="nowrap">{switch_newmsg_list.L_NEW_MESSAGES}</th>
	</tr>
	<tr>
		<td class="row2" align="center" valign="middle"><span class="genmed">{switch_newmsg_list.L_SUBJECT}</span></td>
		<td class="row2" align="center" valign="middle"><span class="genmed">{switch_newmsg_list.L_FROM}</span></td>
	</tr>
<!-- BEGIN switch_newmsg_row -->
	<tr>
		<td class="row1" valign="middle"><span class="genmed"><a href="{switch_newmsg_list.switch_newmsg_row.U_IMMSGS}" target="read[{switch_newmsg_list.switch_newmsg_row.IMNUM}]" onClick="javascript:parent.launch_spawn('{switch_newmsg_list.switch_newmsg_row.U_IMMSGS}', '{switch_newmsg_list.switch_newmsg_row.LEFT_PX}', '{switch_newmsg_list.switch_newmsg_row.TOP_PX}', '{READ_WIDTH}', '{READ_HEIGHT}'); return false" title="{switch_newmsg_list.switch_newmsg_row.SUBJECT_FULL}">{switch_newmsg_list.switch_newmsg_row.SUBJECT_SHORT}</a></span></td>
		<td class="row2" align="center" valign="middle"><span class="genmed"><a href="{switch_newmsg_list.switch_newmsg_row.U_PROFILE}" target="phpbbmain" title="{switch_newmsg_list.switch_newmsg_row.SENDER_FULL}">{switch_newmsg_list.switch_newmsg_row.SENDER_SHORT}</a></span></td>
	</tr>
<!-- END switch_newmsg_row -->
</table>
</form>
<!-- END switch_newmsg_list -->

<!-- BEGIN switch_users_online -->
<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
	<tr>
		<th colspan="3" class="thTop" height="25" nowrap="nowrap">{switch_users_online.L_USERS_ONLINE}</th>
	</tr>
<!-- BEGIN switch_user_list -->
	<tr>
		<td class="row1" valign="middle"><span class="genmed">{switch_users_online.switch_user_list.ONLINE_USER_SITE}&nbsp;<a href="{switch_users_online.switch_user_list.ONLINE_USER_URL}" target="phpbbmain"{switch_users_online.switch_user_list.ONLINE_USER_STYLE}>{switch_users_online.switch_user_list.ONLINE_USER}</a></span></td>
		<td class="row1" align="center" valign="middle"><span class="genmed"><a href="{switch_users_online.switch_user_list.U_MESSAGE_USER}" target="newmessage" onClick="javascript:parent.new_message('{switch_users_online.switch_user_list.U_MESSAGE_USER}', '{SEND_WIDTH}', '{SEND_HEIGHT}'); return false">{L_IM}</a></span></td>
		<td class="row1" align="center" valign="middle"><span class="genmed"><a href="{switch_users_online.switch_user_list.U_PMESSAGE_USER}" target="phpbbmain">{L_PM}</a></span></td>
	</tr>
<!-- END switch_user_list -->
	<tr>
		<td colspan="3" class="row1" align="left"><span class="gensmall">{TOTAL_USERS_ONLINE} &nbsp; [ {L_WHOSONLINE_ADMIN} ] &nbsp; [ {L_WHOSONLINE_MOD} ]<br />{RECORD_USERS}<br />{L_ONLINE_EXPLAIN}</span></td>
	</tr>
</table>
<!-- END switch_users_online -->

<!-- BEGIN switch_network_boxes -->
<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
	<tr>
		<th colspan="2" class="thTop" height="25" nowrap="nowrap">{switch_network_boxes.L_NETWORK_TITLE}</th>
	</tr>
	{USER_BOX}
</table>
<!-- END switch_network_boxes -->

<!-- BEGIN switch_sound -->
<embed src="{switch_sound.SOUND_NAME}" height="0" width="0"></embed>
<!-- END switch_sound -->