<script language="JavaScript" src="{U_IM_PATH}main.js"></script>
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

<h1>{L_ML_TITLE}</h1>

<p>{L_ML_EXPLAIN}</p>


<form name="newmsg_list" method="post" action="{S_FORM_ACTION}">
<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
	<tr>
		<td class="bodyline" width="15%"><a href="{U_RECEIVED}" class="nav">{L_RECEIVED}</a></td>
		<td class="bodyline" width="15%"><a href="{U_SENT}" class="nav">{L_SENT}</a></td>
		<td class="bodyline" width="30%"><a href="{U_OFF_RECEIVED}" class="nav">{L_OFF_RECEIVED}</a></td>
		<td class="bodyline" width="25%"><a href="{U_OFF_SENT}" class="nav">{L_OFF_SENT}</a></td>
		<td class="row3" align="right">&nbsp;</td>
	</tr>
</table>

<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
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
		<td class="{switch_msg_list.switch_msg_row.ROW_CLASS}" valign="middle"><span class="genmed"><a href="{switch_msg_list.switch_msg_row.U_IMMSGS}" target="read[{switch_msg_list.switch_msg_row.IMNUM}]" onClick="javascript:launch_spawn('{switch_msg_list.switch_msg_row.U_IMMSGS}', '{switch_msg_list.switch_msg_row.LEFT_PX}', '{switch_msg_list.switch_msg_row.TOP_PX}', '{READ_WIDTH}', '{READ_HEIGHT}', '{switch_msg_list.switch_msg_row.IMNUM}'); return false" title="{switch_msg_list.switch_msg_row.SUBJECT}">{switch_msg_list.switch_msg_row.SUBJECT}</a></span></td>
		<td class="{switch_msg_list.switch_msg_row.ROW_CLASS}" align="center" valign="middle"><span class="genmed"><a href="{switch_msg_list.switch_msg_row.U_SENDER}" target="_profile" title="{switch_msg_list.switch_msg_row.SENDER}">{switch_msg_list.switch_msg_row.SENDER}</a></span></td>
		<td class="{switch_msg_list.switch_msg_row.ROW_CLASS}" align="center" valign="middle"><span class="genmed"><a href="{switch_msg_list.switch_msg_row.U_RECEIVER}" target="_profile" title="{switch_msg_list.switch_msg_row.RECEIVER}">{switch_msg_list.switch_msg_row.RECEIVER}</a></span></td>
		<td class="{switch_msg_list.switch_msg_row.ROW_CLASS}" align="center" valign="middle"><span class="genmed">{switch_msg_list.switch_msg_row.DATE}</span></td>
		<td class="{switch_msg_list.switch_msg_row.ROW_CLASS}" align="center" valign="middle"><input type="checkbox" name="mark[]" value="{switch_msg_list.switch_msg_row.S_MARK_ID}"></td>
	</tr>
<!-- END switch_msg_row -->
	<tr>
		<td class="row2" colspan="5" align="center" valign="middle"><span class="genmed">{switch_msg_list.S_HIDDEN_FIELDS}<a href="javascript:select_switch(true);">{switch_msg_list.L_MARK_ALL}</a> <a href="javascript:select_switch(false);">{switch_msg_list.L_UNMARK_ALL}</a> <input type="submit" name="delete" value="{switch_msg_list.L_DELETE}" class="liteoption"></span></td>
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
