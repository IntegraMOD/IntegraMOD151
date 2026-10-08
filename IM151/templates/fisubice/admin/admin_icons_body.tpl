
<h1>{L_TITLE}</h1>

<p>{L_TITLE_EXPLAIN}</p>

<form action="{S_ACTION}" method="post">
<table width="100%" cellpadding="2" cellspacing="0">
<tr>
	<td><span class="nav"><a href="{S_ACTION}" class="nav">{L_TITLE}</a></span></td>
</tr>
</table>

<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline">
<tr>
	<th align="center" colspan="2">{L_TITLE}</th>
	<th align="center">{L_PERMISSIONS}</th>
	<th align="center">{L_DEFAULT}</th>
	<th align="center">{L_USAGE}</th>
	<th align="center" colspan="2">{L_ACTION}</th>
</tr>
<!-- BEGIN row -->
<tr>
	<td class="row1" width="20" align="center"><span class="genmed">{row.ICON}</span></td>
	<td class="row1"><span class="gen">{row.L_LANG}</span><span class="gensmall">{row.LANG_KEY}</span></td>
	<td class="row2" align="center"><span class="gen">{row.L_AUTH}</span></td>
	<td class="row2" align="center">
		<span class="gen">
			<!-- BEGIN default -->
			{row.default.L_DEFAULT}<br />
			<!-- END default -->
		</span>
	</td>
	<td class="row2" align="center">{row.USAGE}</td>
	<td class="row3" align="center">
		<span class="genmed">
			<a href="{row.U_EDIT}" alt="{L_EDIT}" class="genmed">{L_EDIT}</a>&nbsp;&nbsp;
			<a href="{row.U_DELETE}" alt="{L_DELETE}" class="genmed">{L_DELETE}</a>
		</span>
	</td>
	<td class="row3" align="center">
		<span class="genmed">
			<a href="{row.U_MOVEUP}" alt="{L_MOVEUP}" class="genmed">{L_MOVEUP}</a><br />
			<a href="{row.U_MOVEDW}" alt="{L_MOVEDW}" class="genmed">{L_MOVEDW}</a>
		</span>
	</td>
</tr>
<!-- END row -->
<tr>
	<td class="cat" colspan="7" align="center">{S_HIDDEN_FIELDS}
		<input type="submit" name="create" class="mainoption" value="{L_CREATE}" />
	</td>
</tr>
</table>
</form>