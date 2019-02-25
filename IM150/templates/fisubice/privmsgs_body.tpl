<script>
	//
	// Should really check the browser to stop this whining ...
	//
	function select_switch(status)
	{
		for (i = 0; i < document.privmsg_list.length; i++)
		{
			document.privmsg_list.elements[i].checked = status;
		}
	}
</script>
<table cellspacing="2" cellpadding="2" border="0" align="center">
<tr>
<td>{INBOX_IMG}</td>
<td class="nav">{INBOX} &nbsp;</td>
<td>{SENTBOX_IMG}</td>
<td class="nav">{SENTBOX} &nbsp;</td>
<td>{OUTBOX_IMG}</td>
<td class="nav">{OUTBOX} &nbsp;</td>
<td>{SAVEBOX_IMG}</td>
<td class="nav">{SAVEBOX} &nbsp;</td>
</tr>
</table>
<br />
<form method="post" name="privmsg_list" action="{S_PRIVMSGS_ACTION}">
<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr>
<td>{POST_PM_IMG}</td>
<td class="nav" width="100%">&nbsp;<a href="{U_INDEX}">{L_INDEX}</a>
<!-- BEGIN switch_box_size_notice -->
{NAV_SEPARATOR}{BOX_SIZE_STATUS}
<!-- END switch_box_size_notice -->
</td>
<td nowrap="nowrap" class="nav">{PAGINATION}</td>
</tr>
</table>
<table border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
<tr>
<th colspan="2">{L_SUBJECT}</th>
<th>{L_FROM_OR_TO}</th>
<th>{L_DATE}</th>
<th>{L_MARK}</th>
</tr>
<!-- BEGIN listrow -->
<tr>
<td class="{listrow.ROW_CLASS}" align="center" height="30"><a href="{listrow.U_READ}"><img src="{listrow.PRIVMSG_FOLDER_IMG}" alt="{listrow.L_PRIVMSG_FOLDER_ALT}" title="{listrow.L_PRIVMSG_FOLDER_ALT}" /></a></td>
<td width="100%" class="{listrow.ROW_CLASS}"><a href="{listrow.U_READ}" class="topictitle">{listrow.SUBJECT}</a></td>
<td align="center" class="{listrow.ROW_CLASS}">&nbsp;<a href="{listrow.U_FROM_USER_PROFILE}" class="genmed">{listrow.FROM}</a>&nbsp;</td>
<td nowrap="nowrap" width="15%" align="center" class="{listrow.ROW_CLASS}"><span class="gensmall">&nbsp;{listrow.DATE}&nbsp;</span></td>
<td width="5%" align="center" class="{listrow.ROW_CLASS}">
<input type="checkbox" name="mark[]2" value="{listrow.S_MARK_ID}" /></td>
</tr>
<!-- END listrow -->
<!-- BEGIN switch_no_messages -->
<tr>
<td height="40" colspan="5" align="center" class="row1">{L_NO_MESSAGES}</td>
</tr>
<!-- END switch_no_messages -->
<tr> 
<td height="28" colspan="5" align="right" class="row3"> {S_HIDDEN_FIELDS} 
<input type="submit" name="save" value="{L_SAVE_MARKED}" class="catbutton" />
<input type="submit" name="delete" value="{L_DELETE_MARKED}" class="catbutton" />
<input type="submit" name="deleteall" value="{L_DELETE_ALL}" class="catbutton" />
<input type="button" name="markall" value="{L_MARK_ALL}" onclick="javascript:select_switch(true);" class="catbutton" />
<input type="button" name="unmarkall" value="{L_UNMARK_ALL}" onclick="javascript:select_switch(false);" class="catbutton" />
</td>
</tr>
<tr align="center">
	<td class="cat" colspan="5"><table border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="gensmall" nowrap="nowrap">{L_DISPLAY_MESSAGES}:&nbsp;</td>
<td><select name="msgdays">{S_SELECT_MSG_DAYS}</select>&nbsp;</td>
<td><input type="submit" value="{L_GO}" name="submit_msgdays" class="catbutton" /></td>
</tr>
</table></td>
</tr>
</table>
<table width="100%" cellspacing="2" border="0" cellpadding="2">
<tr>
<td>{POST_PM_IMG}</td>
<td class="nav" width="100%">&nbsp;<a href="{U_INDEX}">{L_INDEX}</a>
<!-- BEGIN switch_box_size_notice -->
{NAV_SEPARATOR}{BOX_SIZE_STATUS}
<!-- END switch_box_size_notice -->
</td>
<td align="right" nowrap="nowrap" class="nav">{PAGINATION}
</td>
</tr>
</table>
</form>
<table width="100%" cellspacing="2" border="0" cellpadding="2">
<tr>
<td><br />{JUMPBOX}</td>
</tr>
</table>