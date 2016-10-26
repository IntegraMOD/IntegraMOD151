<script language="JavaScript" type="text/javascript">
function insertText_{NAME}(fieldname, text)
{
	var field;
	if (document.getElementById)
	{
		field = document.getElementById(fieldname);
	}
	else if (document.all)
	{
		field = eval('document.all.' + fieldname);
	}

	if (field.createTextRange)
	{
		field.focus(field.caretPos);
		field.caretPos = document.selection.createRange().duplicate();
		field.caretPos.text = text;
	}
	else field.value += text;
}
</script>

<textarea rows="5" cols="60" wrap="virtual" name="{NAME}" class="post" onKeyUp="javascript:storeCaret(this);" onClick="javascript:storeCaret(this);" onChange="javascript:storeCaret(this);">{VALUE}</textarea>
<table cellpadding="2" cellspacing="0" border="0" class="bodyline" width="100%">
<tr>
	<td class="row1"><span class="genmed" valign="top" align="center">&nbsp;{L_SYSTEM_VALUES}&nbsp;</span></td>
</tr>
<tr>
	<td class="row3">
		<table cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td nowrap="nowrap" align="right"><span class="genmed">&nbsp;{L_TABLES_LINKED}:&nbsp;</span></td>
			<td><select name="tables_{NAME}" onChange="javascript:insertText_{NAME}('{NAME}', this.form.tables_{NAME}.options[this.form.tables_{NAME}.selectedIndex].value); this.form.tables_{NAME}.selectedIndex=0; this.form.{NAME}.focus();">{S_TABLES_OPT}</select></td>
		</tr>
		<tr>
			<td nowrap="nowrap" align="right"><span class="genmed">&nbsp;{L_CFG_VALUES}:&nbsp;</span></td>
			<td><select name="cfg_values_{NAME}" onChange="javascript:insertText_{NAME}('{NAME}', this.form.cfg_values_{NAME}.options[this.form.cfg_values_{NAME}.selectedIndex].value); this.form.cfg_values_{NAME}.selectedIndex=0; this.form.{NAME}.focus();">{S_CFG_VALUES}</select></td>
		</tr>
		<tr>
			<td nowrap="nowrap" align="right"><span class="genmed">&nbsp;{L_VIEWED_USER}:&nbsp;</span></td>
			<td><select name="viewed_user_{NAME}" onChange="javascript:insertText_{NAME}('{NAME}', this.form.viewed_user_{NAME}.options[this.form.viewed_user_{NAME}.selectedIndex].value); this.form.viewed_user_{NAME}.selectedIndex=0; this.form.{NAME}.focus();">{S_VIEWED_USER}</select></td>
		</tr>
		<tr>
			<td nowrap="nowrap" align="right"><span class="genmed">&nbsp;{L_ACTING_USER}:&nbsp;</span></td>
			<td><select name="acting_user_{NAME}" onChange="javascript:insertText_{NAME}('{NAME}', this.form.acting_user_{NAME}.options[this.form.acting_user_{NAME}.selectedIndex].value); this.form.acting_user_{NAME}.selectedIndex=0; this.form.{NAME}.focus();">{S_ACTING_USER}</select></td>
		</tr>
		</table>
	</td>
</tr>
</table>