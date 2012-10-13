<h1>{L_TITLE}</h1>

<p>{L_TITLE_EXPLAIN}</p>

<form action="{S_ACTION}" name="post" method="post">
<table width="99%" cellpadding="2" cellspacing="1" border="0" align="center">
<tr>
	<td align="right"><span class="gen">{L_SORT}:&nbsp;{S_SORT}{S_ORDER}&nbsp;<input type="submit" name="sort_by" value="{L_GO}" class="liteoption" /></span></td>
</tr>
</table>

<table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
<tr>
	<th nowrap="nowrap">{L_NAME}</th>
	<th nowrap="nowrap">{L_DESC}</th>
	<th nowrap="nowrap">{L_CLASS} & {L_TYPE}</th>
	<th nowrap="nowrap">{L_MAP_USAGE}</th>
	<th nowrap="nowrap">{L_SQL_ACTIONS}</th>
</tr>
<!-- BEGIN fields -->
<tr>
	<td class="{fields.COLOR}"><a href="{fields.U_NAME}" class="genmed">{fields.NAME}</a></td>
	<td class="{fields.COLOR}"><span class="genmed">{fields.LANG_KEY}</span><span class="gensmall">{fields.EXPLAIN}<br />{fields.IMAGE}</span></td>
	<td class="{fields.COLOR}" align="center"><span class="genmed"><a href="{fields.U_CLASS}" class="genmed">{fields.CLASS}</a><br />{fields.TYPE}<br />{fields.GET_MODE}</span></td>
	<td class="{fields.COLOR}">
		<span class="genmed">
			<!-- BEGIN maps -->
			<a href="{fields.maps.U_NAME}" class="genmed">{fields.maps.NAME}</a><br />
			<!-- END maps -->
		</span>
	</td>
	<td class="{fields.COLOR}" align="center">
		<!-- BEGIN sql_actions -->
		<span class="genmed">{fields.SQL_ACTIONS}</span>
		<!-- END sql_actions -->
	</td>
</tr>
<!-- END fields -->
<tr>
	<td class="cat" align="center" colspan="5">{S_HIDDEN_FIELDS}
		<input type="submit" name="create" value="{L_ADD_FIELD}" class="mainoption" />
	</td>
</tr>
</table>
</form>