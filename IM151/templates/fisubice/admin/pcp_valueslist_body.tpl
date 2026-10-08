<h1>{L_TITLE}</h1>

<p>{L_TITLE_EXPLAIN}</p>

<form action="{S_ACTION}" name="post" method="post">
<table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
<tr>
	<th nowrap="nowrap">{L_NAME}</th>
	<th nowrap="nowrap">{L_FUNC}</th>
	<th nowrap="nowrap">{L_TABLE}</th>
	<th nowrap="nowrap">{L_VALUES}</th>
</tr>
<!-- BEGIN row -->
<tr>
	<td class="{row.COLOR}"><a href="{row.U_VLIST}" class="gen">{row.NAME}</a></td>
	<td class="{row.COLOR}" align="center"><span class="gen">{row.FUNC}</span></td>
	<td class="{row.COLOR}" align="center"><a href="{row.U_MAIN}" class="gen">{row.MAIN}</a></span></td>
	<td class="{row.COLOR}">
		<!-- BEGIN items -->
		<table cellpadding="2" cellspacing="1" border="0" class="bodyline" width="100%">
		<tr>
			<td class="row3" width="10%"><span class="gensmall">{L_ITEM}</span></td>
			<td class="row3" width="45%"><span class="gensmall">{L_TXT}</span></td>
			<td class="row3" width="45%"><span class="gensmall">{L_IMG}</span></td>
		</tr>
		<!-- BEGIN list -->
		<tr>
			<td class="{row.items.list.COLOR}" align="center"><span class="gensmall">{row.items.list.VAL}</span></td>
			<td class="{row.items.list.COLOR}"><span class="gensmall">{row.items.list.TXT}</span></td>
			<td class="{row.items.list.COLOR}"><span class="gensmall">{row.items.list.IMG}</span></td>
		</tr>
		<!-- END list -->
		<!-- BEGIN more -->
		<tr>
			<td class="row3" align="center" colspan="3"><span class="gensmall">{L_MORE}</span></td>
		</tr>
		<!-- END more -->
		</table>
		<!-- END items -->
	</td>
</tr>
<!-- END row -->
<tr>
	<td class="cat" align="center" colspan="4">{S_HIDDEN_FIELDS}
		<input type="submit" name="create" value="{L_ADD_TABLE}" class="mainoption" />
	</td>
</tr>
</table>
</form>