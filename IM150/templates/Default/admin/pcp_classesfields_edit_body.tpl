<script>
function storeCaret(text)
{
}

function insertText(text)
{
	if (document.post.sql_def.createTextRange)
	{
		document.post.sql_def.focus(document.post.sql_def.caretPos);
		document.post.sql_def.caretPos = document.selection.createRange().duplicate();
		document.post.sql_def.caretPos.text = text;
	}
	else document.post.sql_def.value += text;
}
</script>

<h1>{L_TITLE}</h1>

<p>{L_TITLE_EXPLAIN}</p>

<form action="{S_ACTION}" name="post" method="post">
<table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
<tr>
	<th nowrap="nowrap" colspan="2">{L_TITLE}</th>
</tr>
<tr>
	<td class="row1"><span class="gen">{L_NAME}</span><span class="gensmall"><br />{L_NAME_EXPLAIN}</span></td>
	<td class="row2"><input type="text" name="name" value="{NAME}" size="60" /></td>
</tr>
<tr>
	<td class="row1"><span class="gen">{L_CONFIG}</span><span class="gensmall"><br />{L_CONFIG_EXPLAIN}</span></td>
	<td class="row2"><input type="text" name="config_field" value="{CONFIG_FIELD}" size="40" /></td>
</tr>
<tr>
	<td class="row1"><span class="gen">{L_ADMIN}</span><span class="gensmall"><br />{L_ADMIN_EXPLAIN}</span></td>
	<td class="row2"><input type="text" name="admin_field" value="{ADMIN_FIELD}" size="40" /></td>
</tr>
<tr>
	<td class="row1"><span class="gen">{L_USER}</span><span class="gensmall"><br />{L_USER_EXPLAIN}</span></td>
	<td class="row2"><input type="text" name="user_field" value="{USER_FIELD}" size="40" /></td>
</tr>
<tr>
	<td class="row1" valign="top"><span class="gen">{L_SQL_DEF}</span><span class="gensmall"><br />{L_SQL_DEF_EXPLAIN}</span></td>
	<td class="row2">
		<input type="submit" name="suggest" value="{L_SUGGEST}" class="liteoption" /><br />
		<textarea rows="8" cols="70" wrap="virtual" name="sql_def" class="post" onKeyUp="javascript:storeCaret(this);" onClick="javascript:storeCaret(this);" onChange="javascript:storeCaret(this);">{SQL_DEF}</textarea>
		<table cellpadding="2" cellspacing="0" border="0" class="bodyline" width="100%">
		<tr>
			<td class="row1"><span class="genmed" valign="top" align="center">&nbsp;{L_SYSTEM_VALUES}&nbsp;</span></td>
		</tr>
		<tr>
			<td class="row3">
				<table cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td nowrap="nowrap" align="right"><span class="genmed">&nbsp;{L_TABLES_LINKED}:&nbsp;</span></td>
					<td><select name="tables" onChange="javascript:insertText(this.form.tables.options[this.form.tables.selectedIndex].value); this.form.tables.selectedIndex=0; this.form.sql_def.focus();">{S_TABLES_OPT}</select></td>
				</tr>
				<tr>
					<td nowrap="nowrap" align="right"><span class="genmed">&nbsp;{L_CFG_VALUES}:&nbsp;</span></td>
					<td><select name="cfg_values" onChange="javascript:insertText(this.form.cfg_values.options[this.form.cfg_values.selectedIndex].value); this.form.cfg_values.selectedIndex=0; this.form.sql_def.focus();">{S_CFG_VALUES}</select></td>
				</tr>
				<tr>
					<td nowrap="nowrap" align="right"><span class="genmed">&nbsp;{L_VIEWED_USER}:&nbsp;</span></td>
					<td><select name="viewed_user" onChange="javascript:insertText(this.form.viewed_user.options[this.form.viewed_user.selectedIndex].value); this.form.viewed_user.selectedIndex=0; this.form.sql_def.focus();">{S_VIEWED_USER}</select></td>
				</tr>
				<tr>
					<td nowrap="nowrap" align="right"><span class="genmed">&nbsp;{L_ACTING_USER}:&nbsp;</span></td>
					<td><select name="acting_user" onChange="javascript:insertText(this.form.acting_user.options[this.form.acting_user.selectedIndex].value); this.form.acting_user.selectedIndex=0; this.form.sql_def.focus();">{S_ACTING_USER}</select></td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
	</td>
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