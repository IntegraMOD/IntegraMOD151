<form method="post" action="{S_MODCP_ACTION}">
<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr>
	<td colspan="2" class="maintitle">{L_MOD_CP}</td>
</tr>
<tr>
<td class="nav"><a href="{U_INDEX}">{L_INDEX}</a>{NAV_CAT_DESC}{NAV_SEPARATOR}{L_MOD_CP}</td>
<td align="right" class="nav">{PAGINATION}</td>
</tr>
</table>
<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline">
<tr>
<td class="cat" colspan="5" align="center">{L_MOD_CP}</td>
</tr>
<tr>
<td class="row1" colspan="5" align="center"><span class="genmed">{L_MOD_CP_EXPLAIN}</span></td>
</tr>
<tr>
<th colspan="2">{L_TOPICS}</th>
<th>{L_REPLIES}</th>
<th>{L_LASTPOST}</th>
<th>{L_SELECT}</th>
</tr>
<!-- BEGIN topicrow -->
<tr>
<td class="row1"><img src="{topicrow.TOPIC_FOLDER_IMG}" alt="{topicrow.L_TOPIC_FOLDER_ALT}" title="{topicrow.L_TOPIC_FOLDER_ALT}" /></td>
<td width="100%" class="row1">&nbsp;<span class="topictitle">{topicrow.TOPIC_ATTACHMENT_IMG}{topicrow.TOPIC_TYPE}<a href="{topicrow.U_VIEW_TOPIC}">{topicrow.TOPIC_TITLE}</a></span></td>
<td class="row2" align="center"><span class="gensmall">{topicrow.REPLIES}</span></td>
<td align="center" nowrap="nowrap" class="row1"><span class="gensmall">{topicrow.LAST_POST_TIME}</span></td>
<td class="row2" align="center"><input type="checkbox" name="topic_id_list[]" value="{topicrow.TOPIC_ID}" /></td>
</tr>
<!-- END topicrow -->
<tr> 
<td colspan="5" align="right" class="cat"> {S_HIDDEN_FIELDS} 
<input type="submit" name="delete" class="catbutton" value="{L_DELETE}" />
&nbsp; 
<input type="submit" name="move" class="catbutton" value="{L_MOVE}" />
&nbsp; 
<input type="submit" name="lock" class="catbutton" value="{L_LOCK}" />
&nbsp; 
<input type="submit" name="unlock" class="catbutton" value="{L_UNLOCK}" />
</td>
</tr>
</table>
</form>
<table width="100%" cellspacing="2" cellpadding="2" border="0">
	<tr>
		<td class="nav"><a href="{U_INDEX}">{L_INDEX}</a>{NAV_CAT_DESC}{NAV_SEPARATOR}{L_MOD_CP}</td>
		<td align="right" class="nav">{PAGINATION}</td>
	</tr>
</table>
