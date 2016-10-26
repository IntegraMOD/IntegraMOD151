<h1>{L_TITLE}</h1>

<p>{L_TITLE_EXPLAIN}</p>

<form action="{S_ACTION}" name="post" method="post">
<table width="99%" cellpadding="0" cellspacing="0" border="0" align="center">
<tr>
	<!-- BEGIN catmenu -->
	<!-- BEGIN flat -->
	<td nowrap="nowrap" width="150">
		<table border="0" cellpadding="1" cellspacing="1" width="100%" style="border-left : 1px solid Black; border-top : 1px solid Black; border-right : 1px solid Black; ">
		<tr>
			<td class="row2" align="center"><span class="genmed"><b>{catmenu.L_CAT_NAME}</b></span></td>
		</tr>
		</table>
	</td>
	<!-- END flat -->
	<!-- BEGIN input -->
	<td align="center" nowrap="nowrap"><input type="submit" name="select_field_cat_{catmenu.CAT_NAME}" value="{catmenu.L_CAT_NAME}" class="liteoption" style="width:150;" /></td>
	<!-- END input -->
	<!-- END catmenu -->
	<td width="100%"><span class="genmed">&nbsp;</span></td>
</tr>
<tr>
	<td colspan="{SPAN}">

<table width="100%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
<tr>
	<th colspan="2">{L_TITLE}</th>
</tr>
<!-- BEGIN row -->
<!-- BEGIN cat -->
<tr>
	<td class="cat" colspan="2"><span class="cattitle">{row.cat.L_CAT}</span></td>
</tr>
<!-- END cat -->
<tr>
	<td class="row1" width="40%"><span class="gen">{row.L_FIELD}</span><span class="gensmall"><br />{row.L_FIELD_EXPLAIN}</span></td>
	<td class="row2" width="60%"><span class="gen">{row.FIELD}</span></td>
</tr>
<!-- END row -->
<tr>
	<td class="cat" align="center" colspan="2">{S_HIDDEN_FIELDS}
		<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;
		<input type="submit" name="refresh" value="{L_REFRESH}" class="liteoption" />&nbsp;
		<input type="submit" name="delete" value="{L_DELETE}" class="liteoption" />&nbsp;
		<input type="submit" name="cancel" value="{L_CANCEL}" class="liteoption" />
	</td>
</tr>
</table>

	</td>
</tr>
</table>
</form>