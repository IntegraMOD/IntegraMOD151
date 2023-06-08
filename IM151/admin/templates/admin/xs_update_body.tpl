
<form action="{UPDATE_URL}" method="post">
<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline">
	<tr>
		<th colspan="4" class="thHead" align="center">{MESSAGE_TITLE}</th>
	</tr>
	<tr>
		<td colspan="4" class="row1" width="100%" align="left"><span class="gen">{L_XS_UPDATE_INFO1}</span></td>
	</tr>
	<tr>
		<th class="thCornerL" colspan="2" align="center" nowrap="nowrap">{L_XS_UPDATE_NAME}</th>
		<th class="thTop" align="center" nowrap="nowrap">{L_XS_UPDATE_TYPE}</th>
		<th class="thCornerR" align="center" nowrap="nowrap">{L_XS_UPDATE_CURRENT_VERSION}</th>
	</tr>
	<!-- BEGIN row -->
	<input type="hidden" name="{row.var}item" value="{row.item}" />
	<tr>
		<td class="{row.ROW_CLASS}"><?php if(!empty($row_item['url'])) { ?><input type="checkbox" name="{row.var}checked" checked="checked" /><?php }else echo '<input type="hidden" name="', $row_item['var'], 'checked" value="0" />'; ?></td>
		<td class="{row.ROW_CLASS}" width="100%"><span class="gen">{row.name}</span></td>
		<td class="{row.ROW_CLASS}" align="center" nowrap="nowrap"><span class="gen">{row.type}</span></td>
		<td class="{row.ROW_CLASS}" align="center" nowrap="nowrap"><span class="gen">{row.version}</span></td>
	</tr>
	<!-- END row -->
	<tr>
		<td colspan="4" class="row3" align="left" valign="middle"><span class="gen">{L_XS_UPDATE_TIMEOUT} <input type="text" name="timeout" value="180" size="6" /></span></td>
	</tr>
	<tr>
		<td class="cat" colspan="4" align="center">{S_HIDDEN_FIELDS}<input type="submit" name="submit" value="{L_XS_CONTIUNE}" class="mainoption" /></td>
	</tr>
</table>
</form>

<br />
