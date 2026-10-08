
<form action="{FORM_ACTION}" method="post"><input type="hidden" name="export" value="{EXPORT_TEMPLATE}" /><table width="100%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
	<tr>
	  <th class="thHead" colspan="2">Export Template "{EXPORT_TEMPLATE}"</th>
	</tr>
	<tr>
		<td class="row1">Export as (template name):</td>
		<td class="row2"><input type="text" class="post" name="export_template" value="{EXPORT_TEMPLATE}" size="30" /></td>
	</tr>
	<!-- BEGIN switch_select_style -->
	<tr>
		<td class="row1">Select style(s) to export:</td>
		<td class="row2" nowrap="nowrap">
			<!-- BEGIN style -->
			<input type="hidden" name="export_style_id_{switch_select_style.style.NUM}" value="{switch_select_style.style.ID}" />
			<input type="checkbox" name="export_style_{switch_select_style.style.NUM}" checked="checked" />
			<input type="text" class="post" name="export_style_name_{switch_select_style.style.NUM}" value="{switch_select_style.style.NAME}" title="{switch_select_style.style.NAME}" size="30" /><br />
			<!-- END style -->
		</td>
	</tr>
	<!-- END switch_select_style -->
	<!-- BEGIN switch_select_nostyle -->
	<tr>
		<td class="row1">Style to export (style name):</td>
		<td class="row2" nowrap="nowrap">
			<input type="hidden" name="export_style_id_0" value="{STYLE_ID}" />
			<input type="hidden" name="export_style_0" value="checked" />
			<input type="text" class="post" name="export_style_name_0" value="{STYLE_NAME}" title="{STYLE_NAME}" size="30" />
		</td>
	</tr>
	<!-- END switch_select_nostyle -->
	<tr>
		<td class="row1">Comment:</td>
		<td class="row2"><input type="text" class="post" name="export_comment" maxlength="250" size="50" value="" /></td>
	</tr>
	<tr>
		<td class="row1">Where to export:</td>
		<td class="row2" nowrap="nowrap"><table width="100%" cellspacing="0" cellpadding="1">
		<tr>
			<td colspan="2"><input type="radio" name="export_to" value="save" {SEND_METHOD_SAVE} /> Save as file</td>
		</tr>
		<tr><td colspan="2"><br /></td></tr>
		<tr>
			<td colspan="2"><input type="radio" name="export_to" value="file" {SEND_METHOD_FILE} /> Store as file on server</td>
		</tr>
		<tr>
			<td width="20%" nowrap="nowrap">&nbsp;&nbsp;Directory:</td>
			<td width="60%"><input class="post" type="text" name="export_to_dir" value="{SEND_DATA_DIR}" size="30" /></td>
		</tr>
		<tr><td colspan="2"><br /></td></tr>
		<tr>
			<td colspan="2"><input type="radio" name="export_to" value="ftp" {SEND_METHOD_FTP} /> Upload via FTP</td>
		</tr>
		<tr>
			<td nowrap="nowrap">&nbsp;&nbsp;Host:</td>
			<td><input class="post" type="text" name="export_to_ftp_host" value="{SEND_DATA_HOST}" size="30" /></td>
		</tr>
		<tr>
			<td nowrap="nowrap">&nbsp;&nbsp;Login:</td>
			<td><input class="post" type="text" name="export_to_ftp_login" value="{SEND_DATA_LOGIN}" size="30" /></td>
		</tr>
		<tr>
			<td nowrap="nowrap">&nbsp;&nbsp;Password:</td>
			<td><input class="post" type="text" name="export_to_ftp_pass" value="" size="30" /></td>
		</tr>
		<tr>
			<td nowrap="nowrap">&nbsp;&nbsp;Directory:</td>
			<td><input class="post" type="text" name="export_to_ftp_dir" value="{SEND_DATA_FTPDIR}" size="30" /></td>
		</tr>
		</table></td>
	</tr>
	<tr>
		<td class="row1">Export filename:</td>
		<td class="row2"><input class="post" type="text" name="export_filename" value="{EXPORT_TEMPLATE}.style" size="30" /></td>
	</tr>
	<input type="hidden" name="total" value="{TOTAL}" />
	<tr>
		<td class="cat" colspan="2" align="center">{S_HIDDEN_FIELDS}<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" /></td>
	</tr>
</table></form>
