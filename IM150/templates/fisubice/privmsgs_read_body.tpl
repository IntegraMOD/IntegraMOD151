<br />
<table cellpadding="0" cellspacing="10" border="0" width="100%">
<form method="post" action="{S_PRIVMSGS_ACTION}">
<tr>
	<td valign="top" align="center">
<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr>
<td>{REPLY_PM_IMG}</td>
</tr>
</table>
<table border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
<tr>
<th colspan="2">{BOX_NAME} :: {L_MESSAGE}</th>
</tr>
<tr>
<td align="right" class="row2"><span class="explaintitle">{L_FROM}:</span></td>
<td class="row2"><span class="name">{AUTHOR_PANEL}</span></td>
</tr>
<tr>
<td align="right" class="row2"><span class="explaintitle">{L_TO}:</span></td>
<td class="row2"><span class="name">{DEST_PANEL}</span></td>
</tr>
<tr>
<td align="right" class="row2"><span class="explaintitle">{L_POSTED}:</span></td>
<td class="row2"><span class="genmed">{POST_DATE}</span></td>
</tr>
<tr>
<td align="right" class="row2"><span class="explaintitle">&nbsp;&nbsp;{L_SUBJECT}:</span></td>
<td width="100%" class="row2"><table width="100%" border="0" cellspacing="1" cellpadding="0">
	<tr>
		<td class="genmed">{POST_SUBJECT}</td>
		<td align="right">{QUOTE_PM_IMG}{EDIT_PM_IMG}</td>
	</tr>
</table></td>
</tr>
<tr>
<td valign="top" colspan="2" class="row1"><span class="postbody">{MESSAGE}</span>
<!-- BEGIN postrow -->
	{ATTACHMENTS}
<!-- END postrow -->
<br />&nbsp;</td>
</tr>
<tr>
<td height="28" valign="bottom" colspan="2" class="row1"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td>{BUTTONS_PANEL}</td><td width="100%">&nbsp;</td></tr></table></td>
</tr>
<tr>
<td class="cat" colspan="2" align="right">{S_HIDDEN_FIELDS}
<input type="submit" name="save" value="{L_SAVE_MSG}" class="button" />
&nbsp; 
<input type="submit" name="delete" value="{L_DELETE_MSG}" class="button" />
<!-- BEGIN switch_attachments -->
		&nbsp; 
		<input type="submit" name="pm_delete_attach" value="{L_DELETE_ATTACHMENTS}" class="liteoption" />
<!-- END switch_attachments -->
</td>
</tr>
</table>
<table width="100%" cellspacing="2" border="0" cellpadding="2">
<tr>
<td>{REPLY_PM_IMG}</td>
<td class="nav">&nbsp;<a href="{U_INDEX}">{L_INDEX}</a></td>
</tr>
</table>
</td>
</tr>
</form>
</table>
