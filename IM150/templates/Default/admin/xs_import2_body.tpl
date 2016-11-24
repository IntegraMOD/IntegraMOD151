
<form action="{FORM_ACTION}" method="post"><input type="hidden" name="import" value="{IMPORT_FILENAME}" /><table width="100%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
	<tr>
		<th class="thHead" colspan="2">Import Template "{STYLE_TEMPLATE}"</th>
	</tr>
	<tr>
		<td class="row1" align="left" colspan="2"><span class="gensmall">This feature will upload template to your forum. If template with this name already exists on your forum this feature will automatically overwrite old files so it can also be used to update styles.<br /><br />This feature can also automatically install styles. If you want to install style after importing it then select one or more styles below.<br /><br />Filename: {STYLE_FILENAME}<br />Template name: {STYLE_TEMPLATE}<br />Comment: {STYLE_COMMENT}<br /></span></td>
	</tr>
	<!-- BEGIN switch_select_style -->
	<tr>
		<td class="row1"><span class="gen">Select style(s) to install:</span></td>
		<td class="row2" nowrap="nowrap"><table border="0" cellspacing="0" cellpadding="1">
			<!-- BEGIN style -->
			<tr>
				<td nowrap="nowrap"><span class="gen"><input type="checkbox" name="import_install_{switch_select_style.style.NUM}" /> {switch_select_style.style.NAME}</span></td>
				<td nowrap="nowrap"><span class="gen">&nbsp;&nbsp;&nbsp;&nbsp;(<input type="radio" name="import_default_{switch_select_style.style.NUM}" /> make default forum style)</span></td>
			</tr>
			<!-- END style -->
		</table></td>
	</tr>
	<!-- END switch_select_style -->
	<!-- BEGIN switch_select_nostyle -->
	<tr>
		<td class="row1"><span class="gen">Install style:</span></td>
		<td class="row2" nowrap="nowrap"><span class="gen"><input type="checkbox" name="import_install_0" /> {STYLE_NAME} &nbsp;&nbsp;&nbsp;&nbsp;(<input type="radio" name="import_default_0" /> make default forum style)</span></td>
	</tr>
	<!-- END switch_select_nostyle -->
	<input type="hidden" name="total" value="{TOTAL}" />
	<tr>
		<td class="cat" colspan="2" align="center">{S_HIDDEN_FIELDS}<input type="submit" name="submit" value="Import" class="mainoption" /></td>
	</tr>
</table></form>
