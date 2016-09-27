<h1>{L_TITLE}</h1>

<p>{L_TITLE_EXPLAIN}</p>

<form action="{S_ACTION}" name="post" method="post">
<table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
<tr>
	<th nowrap="nowrap" colspan="2">{L_TITLE}</th>
</tr>
<tr>
	<td class="row1"><span class="gen"><b>{L_NAME}</b></span><span class="gensmall"><br />{L_NAME_EXPLAIN}</span></td>
	<td class="row2"><input type="text" name="name" value="{NAME}" size="60" /></td>
</tr>
<tr>
	<td class="row1"><span class="gen"><b>{L_SQL_ID}</b></span><span class="gensmall"><br />{L_SQL_ID_EXPLAIN}</span></td>
	<td class="row2"><input type="text" name="sql_id" value="{SQL_ID}" size="5" /></td>
</tr>
<tr>
	<td class="row1" valign="top"><span class="gen"><b>{L_SQL_JOIN}</b></span><span class="gensmall"><br />{L_SQL_JOIN_EXPLAIN}</span></td>
	<td class="row2"><textarea rows="8" cols="70" wrap="virtual" name="sql_join" class="post">{SQL_JOIN}</textarea></td>
</tr>
<tr>
	<td class="row1" valign="top"><span class="gen"><b>{L_SQL_WHERE}</b></span><span class="gensmall"><br />{L_SQL_WHERE_EXPLAIN}</span></td>
	<td class="row2"><textarea rows="8" cols="70" wrap="virtual" name="sql_where" class="post">{SQL_WHERE}</textarea></td>
</tr>
<tr>
	<td class="row1" valign="top"><span class="gen"><b>{L_SQL_ORDER}</b></span><span class="gensmall"><br />{L_SQL_ORDER_EXPLAIN}</span></td>
	<td class="row2"><textarea rows="8" cols="70" wrap="virtual" name="sql_order" class="post">{SQL_ORDER}</textarea></td>
</tr>
<tr>
	<td class="cat" align="center" colspan="2">{S_HIDDEN_FIELDS}
		<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;
		<input type="submit" name="refresh" value="{L_REFRESH}" class="liteoption" />&nbsp;
		<input type="submit" name="delete" value="{L_DELETE}" class="liteoption" />&nbsp;
		<input type="submit" name="cancel" value="{L_CANCEL}" class="liteoption" />
	</td>
</tr>
</table>
</form>