<h1>{L_AUTOLANG_TITLE}</h1>
<p>{L_AUTOLANG_EXPLAIN}</p>
<form method="post" action="{S_AUTOLANG_ACTION}">
<table cellspacing="1" cellpadding="4" border="0" align="center" class="forumline" width="70%">
	<tr>
		<th class="thHead">{L_AUTOLANG_CODE}</th>
		<th class="thHead">{L_AUTOLANG_SELECT}</th>
		<th class="thHead">{L_AUTOLANG_CHECK}</th>
	</tr>
	<!-- BEGIN row -->
	<tr>
		<td class="row1" align="center"><input type="hidden" name="auto_lang_list[]" value="{row.S_AUTOLANG_CNT}" /><span class="gen"><strong>{row.S_AUTOLANG_CODE}</strong></span></td>
		<td class="row1" align="center">{row.S_AUTOLANG_SELECT}</td>
		<td class="row2" align="center"><input type="checkbox" name="auto_lang_check[{row.S_AUTOLANG_CNT}]" value="{row.S_AUTOLANG_CHECK}" /></td>
	</tr>
	<!-- END row -->
	<tr>
		<td class="catbottom" colspan="3" align="center"><input type="submit" class="liteoption" name="edit" value=" {L_AUTOLANG_EDIT_SELECTED} " /> &nbsp; <input type="submit" class="liteoption" name="delete" value="{L_AUTOLANG_REMOVE_SELECTED}" /></td>
	</tr>
</table>
<br />
<table cellspacing="1" cellpadding="4" border="0" align="center" class="forumline" width="70%">
	<tr>
		<th class="thHead" colspan="2" align="center">{L_AUTOLANG_NEW}</th>
	</tr>
	<tr>
		<td class="row1">{L_AUTOLANG_CODE}</td>
		<td class="row2"><input type="text" maxlength="10" size="5" name="auto_lang_new_entry" value="{U_AUTO_LANG_CODE}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_AUTOLANG_SELECT}</td>
		<td class="row2">{S_AUTOLANG_SELECT}</td>
	</tr>
	<tr>
		<td class="catBottom" align="center" colspan="2">{S_HIDDEN_FIELDS}<input type="submit" class="liteoption" name="new" value="{L_AUTOLANG_NEW}" /></td>
	</tr>
</table>
</form>
