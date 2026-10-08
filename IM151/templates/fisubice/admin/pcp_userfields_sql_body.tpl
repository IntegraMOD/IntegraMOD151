
<h1>{L_TITLE}</h1>

<p>{L_TITLE_EXPLAIN}</p>

<form action="{S_ACTION}" name="post" method="post">
<table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
<tr>
	<th colspan="2">{L_SQL_TITLE}</th>
</tr>
<tr>
	<td class="row1" width="40%"><span class="gen">{L_NAME}</span><span class="gensmall"><br />{L_NAME_EXPLAIN}</span></td>
	<td class="row2" width="60%"><span class="genmed">{NAME}</span></td>
</tr>
<tr>
	<td class="row1"><span class="gen">{L_TYPE}</span><span class="gensmall"><br />{L_TYPE_EXPLAIN}</span></td>
	<td class="row2">{S_TYPES}</td>
</tr>
<tr>
	<td class="row1"><span class="gen">{L_LENGTH}</span><span class="gensmall"><br />{L_LENGTH_EXPLAIN}</span></td>
	<td class="row2"><input type="text" name="length" value="{LENGTH}" size="5" />&nbsp;,&nbsp;<input type="text" name="decimal" value="{DECIMAL}" size="2" /></td>
</tr>
<tr>
	<td class="row1"><span class="gen">{L_UNSIGNED}</span><span class="gensmall"><br />{L_UNSIGNED_EXPLAIN}</span></td>
	<td class="row2"><span class="genmed"><input type="radio" name="unsigned" value="0" {UNSIGNED_NO} />{L_NO}&nbsp;<input type="radio" name="unsigned" value="1" {UNSIGNED_YES} />{L_YES}</span></td>
</tr>
<tr>
	<td class="row1"><span class="gen">{L_NULL}</span></td>
	<td class="row2"><span class="genmed"><input type="radio" name="not_null" value="1" {NULL_NO} />{L_NO}</span>&nbsp;<input type="radio" name="not_null" value="0" {NULL_YES} />{L_YES}</td>
</tr>
<tr>
	<td class="row1"><span class="gen">{L_DEFAULT}</span></td>
	<td class="row2"><span class="genmed"><input type="text" name="default" value="{DEFAULT}" size="40" />&nbsp;<input type="checkbox" name="default_null" {DEFAULT_NULL} />{L_DEFAULT_NULL}</span></td>
</tr>
<tr>
	<td class="cat" align="center" colspan="2">{S_HIDDEN_FIELDS}
		<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;
		<input type="submit" name="refresh" value="{L_REFRESH}" class="liteoption" />&nbsp;
		<input type="submit" name="cancel" value="{L_CANCEL}" class="liteoption" />
	</td>
</tr>
</table>
</form>