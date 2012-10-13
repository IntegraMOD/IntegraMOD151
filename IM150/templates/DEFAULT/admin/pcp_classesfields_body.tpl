<h1>{L_TITLE}</h1>

<p>{L_TITLE_EXPLAIN}</p>

<form action="{S_ACTION}" name="post" method="post">
<table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
<tr>
	<th nowrap="nowrap">{L_NAME}</th>
	<th nowrap="nowrap">{L_CONFIG}</th>
	<th nowrap="nowrap">{L_ADMIN}</th>
	<th nowrap="nowrap">{L_USER}</th>
</tr>
<!-- BEGIN row -->
<tr>
	<td class="{row.COLOR}" rowspan="2"><a href="{row.U_NAME}" class="gen">{row.NAME}</a></td>
	<td class="{row.COLOR}"><span class="gen">{row.CONFIG}<br /></span></td>
	<td class="{row.COLOR}"><span class="gen">{row.ADMIN}</span></td>
	<td class="{row.COLOR}"><span class="gen">{row.USER}</span></td>
</tr>
<tr>
	<td class="{row.COLOR}" colspan="3"><span class="genmed">{row.SQL_DEF}<br /></span></td>
</tr>
<!-- END row -->
<tr>
	<td class="cat" align="center" colspan="5">{S_HIDDEN_FIELDS}
		<input type="submit" name="create" value="{L_ADD_CLASS}" class="mainoption" />
	</td>
</tr>
</table>
</form>