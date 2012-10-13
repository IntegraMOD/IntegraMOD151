
<h1>{L_TITLE}</h1>

<p>{L_TITLE_EXPLAIN}</p>

<form method="post" name="post" action="{S_ACTION}">
<table width="100%" cellpadding="4" cellspacing="1" border="0"><tr><td class="nav">{S_NAV_DESC}</td></tr></table>

<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline" align="center">
<tr>
	<th align="center" colspan="2">{L_TITLE}</th>
</tr>
<tr>
	<td class="row2" width="40%"><span class="gen">{L_NAME}</span><span class="gensmall"><br />{L_NAME_EXPLAIN}</span></td>
	<td class="row1" width="60%"><span class="gen"><input type="text" name="panel_name" value="{NAME}" /></span></td>
</tr>
<tr>
	<td class="row2" width="40%"><span class="gen">{L_CLASS}</span><span class="gensmall"><br />{L_CLASS_EXPLAIN}</span></td>
	<td class="row1" width="60%"><span class="gen">{S_CLASS}</td>
</tr>
<tr>
	<td class="row2" width="40%"><span class="gen">{L_DISPLAY}</span><span class="gensmall"><br />{L_DISPLAY_EXPLAIN}</span></td>
	<td class="row1" width="60%">
		<span class="gen">
			<input type="radio" name="panel_display" value="1" {DISPLAY_YES} />{L_YES}&nbsp;
			<input type="radio" name="panel_display" value="0" {DISPLAY_NO} />{L_NO}
		</span>
	</td>
</tr>
<tr>
	<td class="row2" width="40%"><span class="gen">{L_CELLS}</span><span class="gensmall"><br />{L_CELLS_EXPLAIN}</span></td>
	<td class="row1" width="60%"><span class="gen"><input type="text" size="4" name="panel_cells" value="{CELLS}" /></span></td>
</tr>
<tr>
	<td class="row2" width="40%"><span class="gen">{L_IN_TABLE}</span><span class="gensmall"><br />{L_IN_TABLE_EXPLAIN}</span></td>
	<td class="row1" width="60%">
		<span class="gen">
			<input type="radio" name="panel_in_table" value="1" {IN_TABLE_YES} />{L_YES}&nbsp;
			<input type="radio" name="panel_in_table" value="0" {IN_TABLE_NO} />{L_NO}
		</span>
	</td>
</tr>
<tr>
	<td class="row2" width="40%"><span class="gen">{L_STYLE}</span><span class="gensmall"><br />{L_STYLE_EXPLAIN}</span></td>
	<td class="row1" width="60%"><span class="gen">{S_STYLE}&nbsp;<input type="submit" name="refresh" value="{L_REFRESH}" class="liteoption" /></td>
</tr>
<!-- BEGIN sub_template -->
<tr>
	<td class="row2" width="40%"><span class="gen">{L_SUB_TEMPLATE}</span><span class="gensmall"><br />{L_SUB_TEMPLATE_EXPLAIN}</span></td>
	<td class="row1" width="60%"><span class="gen">{S_SUB_TEMPLATE}</td>
</tr>
<!-- END sub_template -->
<tr>
	<td class="cat" colspan="2" align="center">{S_HIDDEN_FIELDS}
		<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;
		<input type="submit" name="cancel" value="{L_CANCEL}" class="liteoption" />
	</td>
</tr>
</table>
</form>