<h1>{L_TITLE}</h1>

<p>{L_TITLE_EXPLAIN}</p>

<form action="{S_ACTION}" name="post" method="post">
<table width="100%" cellpadding="2" cellspacing="0" border="0" align="center"><tr><td>{MAP_NAV_DESC}</td></tr></table>

<table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
<tr>
	<th colspan="2">{L_TITLE}</th>
</tr>
<tr>
	<td class="row1"><span class="gen">{L_NAME}</span><span class="gensmall"><br />{L_NAME_EXPLAIN}</span></td>
	<td class="row2"><input type="text" name="name" value="{NAME}" size="60" /></td>
</tr>
<tr>
	<td class="row1"><span class="gen">{L_PARENT}</span><span class="gensmall"><br />{L_PARENT_EXPLAIN}</span></td>
	<td class="row2"><select name="parent">{S_PARENT}</select></td>
</tr>
<tr>
	<td class="row1"><span class="gen">{L_SPLIT}</span><span class="gensmall"><br />{L_SPLIT_EXPLAIN}</span></td>
	<td class="row2">{S_SPLIT}</td>
</tr>
<tr>
	<td class="row1"><span class="gen">{L_CUSTOM}</span><span class="gensmall"><br />{L_CUSTOM_EXPLAIN}</span></td>
	<td class="row2">{S_CUSTOM}</td>
</tr>
<!-- BEGIN block -->
<!-- BEGIN single -->
<tr>
	<td class="row1"><span class="gen">{block.L_TITLE}</span><span class="gensmall"><br />{block.L_TITLE_EXPLAIN}</span></td>
	<td class="row2">
		<span class="gen">
			<input type="text" name="title_single" value="{block.TITLE}" size="60" />
			<!-- BEGIN button -->
			<div align="center"><input type="submit" name="add_{block.BUTTON}" value="{block.L_BUTTON}" class="liteoption" /></div>
			<!-- END button -->
		</span>
	</td>
</tr>
<!-- END single -->
<!-- BEGIN multi -->
<tr>
	<td class="cat" colspan="2" align="center"><span class="cattitle">{block.L_TITLE}</span></td>
</tr>
<tr>
	<td class="row3" colspan="2">
		<table cellpadding="4" cellspacing="1" border="0" class="bodyline" width="100%">
		<tr>
			<!-- BEGIN col -->
			<th>{block.multi.col.TITLE}</th>
			<!-- END col -->
			<th width="5%" nowrap="nowrap">{L_ACTION}</th>
		</tr>
		<!-- BEGIN row -->
		<tr>
			<!-- BEGIN col -->
			<td class="{block.multi.row.COLOR}" align="{block.multi.row.col.ALIGN}"><span class="genmed">{block.multi.row.col.VALUE}</span></td>
			<!-- END col -->
			<td class="{block.multi.row.COLOR}" align="center" nowrap="nowrap">
				<input type="submit" name="moveup_{block.BUTTON}_{block.multi.row.ROW_ID}" value="{L_UP}" class="liteoption" style="width:18;" />
				<input type="submit" name="edit_{block.BUTTON}_{block.multi.row.ROW_ID}" value="{L_EDIT}" class="liteoption" />
				<input type="submit" name="movedw_{block.BUTTON}_{block.multi.row.ROW_ID}" value="{L_DW}" class="liteoption" style="width:18;" />
			</td>
		</tr>
		<!-- END row -->
		<!-- BEGIN none -->
		<tr>
			<td class="row1" align="center" colspan="{block.SPAN}"><span class="gen">{L_NONE}</span></td>
		</tr>
		<!-- END none -->
		<tr>
			<td class="cat" align="center" colspan="{block.SPAN}"><input type="submit" name="add_{block.BUTTON}" value="{block.L_BUTTON}" class="liteoption" /></td>
		</tr>
		</table>
	</td>
</tr>
<!-- END multi -->
<!-- END block -->
<tr>
	<td class="cat" align="center" colspan="2">{S_HIDDEN_FIELDS}
		<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;
		<input type="submit" name="refresh" value="{L_REFRESH}" class="liteoption" />&nbsp;
		<input type="submit" name="delete" value="{L_DELETE}" class="liteoption" />&nbsp;
		<input type="submit" name="cancel" value="{L_CANCEL}" class="liteoption" />
	</td>
</tr>
</table>

</form>