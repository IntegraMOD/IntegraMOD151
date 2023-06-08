<h1>{L_TITLE}</h1>

<p>{L_TITLE_EXPLAIN}</p>

<form action="{S_ACTION}" name="post" method="post">
<table width="100%" cellpadding="2" cellspacing="0" border="0" align="center"><tr><td>{MAP_NAV_DESC}</td></tr></table>

<table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
<tr>
	<th>{L_NAME}</th>
	<th>{L_MAP_TITLE}</th>
	<th width="5%" nowrap="nowrap">{L_ACTION}</th>
</tr>
<!-- BEGIN sub -->
<tr>
	<td class="cat" colspan="3"><span class="cattitle">{L_SUB_MAPS}</span></td>
</tr>
<!-- BEGIN row -->
<tr>
	<td class="{sub.row.COLOR}"><a href="{sub.row.U_NAME}" class="gen">{sub.row.NAME}</a></td>
	<td class="{sub.row.COLOR}"><span class="gen">{sub.row.MAP_TITLE}</span></td>
	<td class="{sub.row.COLOR}" nowrap="nowrap">
		<input type="submit" name="moveup_map_{sub.row.MAP_ID}" value="{L_UP}" class="liteoption" style="width:18px;" />
		<input type="submit" name="edit_map_{sub.row.MAP_ID}" value="{L_EDIT}" class="liteoption" />
		<input type="submit" name="movedw_map_{sub.row.MAP_ID}" value="{L_DW}" class="liteoption" style="width:18px;" />
	</td>
</tr>
<!-- END row -->
<!-- BEGIN none -->
<tr>
	<td class="row1" colspan="3" align="center"><span class="gen">{L_NONE}</span></td>
</tr>
<!-- END none -->
<!-- END sub -->
<tr>
	<td class="cat" align="center" colspan="3">{S_HIDDEN_FIELDS}
		<input type="submit" name="create" value="{L_ADD_MAP}" class="liteoption" />
	</td>
</tr>
</table>
<br class="gensmall" />

<!-- BEGIN details -->
<table width="99%" cellpadding="0" cellspacing="1" border="0" align="center" class="forumline">
<tr>
	<th colspan="4">{MAP_NAME}</th>
</tr>
<tr>
	<td class="row3">
		<!-- BEGIN block -->
		<table cellpadding="4" cellspacing="1" border="0" width="100%" class="bodyline">
		<!-- BEGIN text -->
		<tr>
			<td class="cat" align="center" colspan="{details.block.SPAN}"><span class="cattitle">{details.block.L_TITLE}</span></td>
		</tr>
		<tr>
			<td class="row1" align="center" colspan="{details.block.SPAN}"><span class="gen">{details.block.TITLE}</span></td>
		</tr>
		<!-- END text -->
		<!-- BEGIN multi -->
		<tr>
			<!-- BEGIN col -->
			<td class="cat" align="center" width="{details.block.multi.col.WIDTH}"><span class="cattitle">{details.block.multi.col.TITLE}</span></td>
			<!-- END col -->
		</tr>
		<!-- BEGIN row -->
		<tr>
			<!-- BEGIN col -->
			<td class="{details.block.multi.row.COLOR}" align="{details.block.multi.row.col.ALIGN}"><span class="genmed">{details.block.multi.row.col.VALUE}</span></td>
			<!-- END col -->
		</tr>
		<!-- END row -->
		<!-- END multi -->
		</table>
		<br style="font-size:2" />
		<!-- END block -->
	</td>
</tr>
<tr>
	<td class="cat" align="center" colspan="4">{S_HIDDEN_FIELDS}
		<input type="submit" name="edit" value="{L_EDIT}" class="liteoption" />
	</td>
</tr>
</table>
<!-- END details -->

</form>