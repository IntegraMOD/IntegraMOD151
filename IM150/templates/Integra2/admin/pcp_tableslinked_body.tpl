<h1>{L_TITLE}</h1>

<p>{L_TITLE_EXPLAIN}</p>

<form action="{S_ACTION}" name="post" method="post">
<table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
<tr>
	<th nowrap="nowrap">{L_TABLE_NAME}</th>
	<th nowrap="nowrap">&nbsp;{L_TABLE_ID}&nbsp;</th>
	<th nowrap="nowrap">{L_TABLE_SQL_DESC}</th>
</tr>
<!-- BEGIN row -->
<tr>
	<td class="{row.COLOR}"><a href="{row.U_TABLE}" class="gen">{row.TABLE_NAME}</a></td>
	<td class="{row.COLOR}" align="center"><span class="gen">{row.TABLE_ID}</span></td>
	<td class="{row.COLOR}">
		<span class="gensmall">
			<b>{L_TABLE_JOIN}:</b><br />{row.TABLE_JOIN}<hr />
			<b>{L_TABLE_WHERE}:</b><br />{row.TABLE_WHERE}<hr />
			<b>{L_TABLE_ORDER}:</b><br />{row.TABLE_ORDER}
		</span>
	</td>
</tr>
<!-- END row -->
<tr>
	<td class="cat" align="center" colspan="3">{S_HIDDEN_FIELDS}
		<input type="submit" name="create" value="{L_ADD_TABLE}" class="mainoption" />
	</td>
</tr>
</table>
</form>