<h1>{L_TITLE}</h1>

<p>{L_TITLE_EXPLAIN}</p>

<form action="{S_ACTION}" method="post">
<table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
<tr>
	<th nowrap="nowrap" colspan="2">{L_TITLE}</th>
</tr>
<tr>
	<td class="row1"><span class="gen">{L_NAME}</span><span class="gensmall"><br />{L_NAME_EXPLAIN}</span></td>
	<td class="row2"><input type="text" name="name" value="{NAME}" size="60" /></td>
</tr>
<tr>
	<td class="row1"><span class="gen">{L_FUNC}</span><span class="gensmall"><br />{L_FUNC_EXPLAIN}</span></td>
	<td class="row2"><input type="text" name="func" value="{FUNC}" size="60" /></td>
</tr>
<tr>
	<td class="row1"><span class="gen">{L_TABLE}</span><span class="gensmall"><br />{L_TABLE_EXPLAIN}</span></td>
	<td class="row2"><select name="main" onChange="javascript:if (this.form.main.selectedIndex != 0) {if (document.post.keyfield.value.length==0) {document.post.keyfield.value='['+this.form.main.options[this.form.main.selectedIndex].value+'].'}; if (document.post.txtfield.value.length==0) {document.post.txtfield.value='['+this.form.main.options[this.form.main.selectedIndex].value+'].'}; if (document.post.imgfield.value.length==0) {document.post.imgfield.value='['+this.form.main.options[this.form.main.selectedIndex].value+'].'};}">{S_TABLES_OPT}</select></td>
</tr>
<tr>
	<td class="row1" align="right"><span class="gen">{L_KEYFIELD}</span><span class="gensmall"><br />{L_KEYFIELD_EXPLAIN}</span></td>
	<td class="row2"><input type="text" name="keyfield" value="{KEYFIELD}" size="60" /></td>
</tr>
<tr>
	<td class="row1" align="right"><span class="gen">{L_TXTFIELD}</span><span class="gensmall"><br />{L_TXTFIELD_EXPLAIN}</span></td>
	<td class="row2"><input type="text" name="txtfield" value="{TXTFIELD}" size="60" /></td>
</tr>
<tr>
	<td class="row1" align="right"><span class="gen">{L_IMGFIELD}</span><span class="gensmall"><br />{L_IMGFIELD_EXPLAIN}</span></td>
	<td class="row2"><input type="text" name="imgfield" value="{IMGFIELD}" size="60" /></td>
</tr>
<tr>
	<td class="cat" align="center" colspan="2"><span class="cattitle">{L_VALUES}</span></td>
</tr>
<tr>
	<td class="row3" colspan="2">
		<table cellpadding="2" cellspacing="1" border="0" class="bodyline" width="100%">
		<tr>
			<th colspan="3">{L_ITEM}</td>
			<th>{L_TXT}</td>
			<th>{L_IMG}</td>
			<th width="5%" nowrap="nowrap">&nbsp;{L_DELETE}&nbsp;</th>
		</tr>
		<!-- BEGIN row -->
		<tr>
			<td class="{row.COLOR}" align="center"><input type="submit" name="moveup_{row.ITEM_ROW}" value="{L_UP}" class="liteoption" style="width:18;" /></td>
			<td class="{row.COLOR}" align="center"><input type="text" name="item_key_{row.ITEM_ROW}" value="{row.ITEM_KEY}" size="10" /></td>
			<td class="{row.COLOR}" align="center"><input type="submit" name="movedw_{row.ITEM_ROW}" value="{L_DOWN}" class="liteoption" style="width:18;" /></td>
			<td class="{row.COLOR}" align="center"><input type="text" name="item_txt_{row.ITEM_ROW}" value="{row.ITEM_TXT}" size="30" /></td>
			<td class="{row.COLOR}" align="center"><input type="text" name="item_img_{row.ITEM_ROW}" value="{row.ITEM_IMG}" size="30" /></td>
			<td class="{row.COLOR}" align="center">
				<input type="hidden" name="item_rows[]" value="{row.ITEM_ROW}" />
				<input type="checkbox" name="item_chk_{row.ITEM_ROW}" value="{row.ITEM_ROW}" {row.ITEM_CHK} />
			</td>
		</tr>
		<!-- END row -->
		<!-- BEGIN empty -->
		<tr>
			<td class="row1" align="center" colspan="6"><span class="gen">{L_EMPTY}</span></td>
		</tr>
		<!-- END empty -->
		<tr>
			<td class="cat" align="center" colspan="6">
				<input type="submit" name="add_selection" value="{L_ADD_ITEM}" class="liteoption" />
				<input type="submit" name="delete_selection" value="{L_DELETE_SELECTION}" class="liteoption" />
			</td>
		</tr>
		</table>
	</td>
</tr>
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